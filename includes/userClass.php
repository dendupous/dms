<?php
class userClass{
			
	/* User Login */
	public function userLogin($userName, $userPass){
		try{
			$db = getDB();
			$hashPassword= SHA1(SHA1($userPass)); //Password encryption 
			$stmt = $db->prepare("SELECT `id` FROM `sys_users` WHERE (`email`=:userNameEmail or `mobile`=:userNameMobile) AND `password`=:hashPassword AND status='1'"); 
			$stmt->bindParam("userNameEmail", $userName,PDO::PARAM_STR) ;
			$stmt->bindParam("userNameMobile", $userName,PDO::PARAM_STR) ;
			$stmt->bindParam("hashPassword", $hashPassword,PDO::PARAM_STR) ;
			$stmt->execute();
			$count=$stmt->rowCount();
			$data=$stmt->fetch(PDO::FETCH_OBJ);
			$db = null;
			
			if($count > 0){
				$_SESSION['id'] = $data->id; // Storing user session value
				$_SESSION["LAST_ACTIVITY"] = time();
				$action = "userLoginHDC";
				$this->userUpdate($_SESSION['id'], $action);
				return true;
			}else{
				return false;
			} 
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
	
	/* User Update */
	public function userUpdate($uID, $action){
		if($action == 'userLoginHDC'){
			try{
				$db = getDB();
				$userDetails = $this->userDetails($uID);
				$numLogin = $userDetails->logins + 1;
				$todayDateTime = date("Y-m-d H:i:s");
				$address = $_SERVER['REMOTE_ADDR'];
				$stmt = $db->prepare("UPDATE `sys_users` SET `user_status`='1', `last_login`=:today, `last_access_ip`=:ipadd, `logins`=:noLogin WHERE `id`=:userID"); 
				$stmt->bindParam("today", $todayDateTime,PDO::PARAM_STR) ;
				$stmt->bindParam("ipadd", $address,PDO::PARAM_STR) ;
				$stmt->bindParam("noLogin", $numLogin,PDO::PARAM_INT) ;
				$stmt->bindParam("userID", $uID,PDO::PARAM_INT) ;
				$stmt->execute();
				$db = null;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
	}

	/* User Details */
	public function userDetails($uid){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT * FROM `sys_users` WHERE `id`=:uid"); 
			$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
			$db = null;
			return $data;
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
}
?>
