<?php
	include('config.php');
	
	try{
		$db = getDB();
		$todayDateTime = date("Y-m-d H:i:s");
		$address = $_SERVER['REMOTE_ADDR'];
		$stmt = $db->prepare("UPDATE sys_users SET user_status='0', last_logout=:today, last_access_ip=:ipadd WHERE id=:userID"); 
		$stmt->bindParam("today", $todayDateTime,PDO::PARAM_STR) ;
		$stmt->bindParam("ipadd", $address,PDO::PARAM_STR) ;
		$stmt->bindParam("userID", $_SESSION['id'],PDO::PARAM_INT) ;
		$stmt->execute();
		$db = null;
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
	
	$_SESSION['id']=''; 
	
	if(empty($_SESSION['id'])){
		$_SESSION['message'] = "Successfully logged out of the System.";
		$_SESSION['type'] = "success";
		$url=BASE_URL.'auth/';
		header("Location: $url");
	}
?>