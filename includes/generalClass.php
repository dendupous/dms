<?php
	class generalClass{
		public function get($tableName, $id){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `id` =:dataID");
				$stmt->bindParam("dataID", $id,PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getAll($tableName){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName`"); 
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function saveData($tableName, $data){
			try{
				$db = getDB();
				$fields = array_keys($data);
				
				$stmt = $db->prepare("INSERT INTO ".$tableName."(`".implode('`,`', $fields)."`) VALUES('".implode("','", $data)."')");
				
				$check = $stmt->execute();
				$new_id = $db->lastInsertId();
				$db = null;
				$returnValue = $check.'-'.$new_id;
				return $returnValue;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function updateData($tableName, $data, $where_clause=''){
			try{
				$db = getDB();
				
				//check for optional where clause
				$whereSQL = '';
				if(!empty($where_clause)){
					//check to see if the 'where' keyword exists
					if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
						//not found, add key word
						$whereSQL = " WHERE ".$where_clause;
					} else{
						$whereSQL = " ".trim($where_clause);
					}
				}
				//start the actual SQL statement
				$sql = "UPDATE ".$tableName." SET ";

				//loop and build the column /
				$sets = array();
				foreach($data as $column => $value){
					 $sets[] = "`".$column."` = '".$value."'";
				}
				$sql .= implode(', ', $sets);

				//append the where statement
				$sql .= $whereSQL;
				
				//run and return the query result
				$stmt = $db->prepare($sql);
				$check = $stmt->execute();
				$db = null;
				return $check;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function deleteData($tableName, $id){
			try{
				$db = getDB();
				$stmt = $db->prepare("DELETE FROM `$tableName` WHERE `id`=:dataID");
				$stmt->bindParam("dataID", $id,PDO::PARAM_INT) ;
				$stmt->execute();
				$count = $stmt->rowCount();				
				$db = null;
				return $count;
				
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getColumn($column, $tableName, $id){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT `$column` FROM `$tableName` WHERE `id` =:dataID");
				$stmt->bindParam("dataID", $id,PDO::PARAM_INT) ;			
				$stmt->execute();
				$colData = $stmt->fetchColumn();
				$db = null;
				return $colData;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getNotifications($tableName, $userid){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `user` =:dataID AND `flag` ='0' ORDER BY `id` DESC");
				$stmt->bindParam("dataID", $userid, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getTasks($tableName, $userid){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `user` =:dataID AND `pending` ='1'");
				$stmt->bindParam("dataID", $userid, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function checkForwarded($vId){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `app_visitor_action` WHERE `visitor_id` = :visID");
				$stmt->bindParam("visID", $vId,PDO::PARAM_INT);			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getSubMenu($tableName, $id){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `main_menu` =:dataID");
				$stmt->bindParam("dataID", $id,PDO::PARAM_INT);			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function sendSMS($mobileNum, $message){
			try{	
				$smswebserviceuser = "smsServerUser";;
				$smswebservicepass = "smsServerPass";;
				
				$sms = urlencode($message);
				$IP = $_SERVER['REMOTE_ADDR'];
				$smsServerIP = "";
				$smsserver = "http://".$smsServerIP.":13131/cgi-bin/sendsms?username=".$smswebserviceuser."&password=".$smswebservicepass."&to=+975".$mobileNum."&text=".$sms;

				$ch= curl_init();
				curl_setopt($ch,CURLOPT_URL, $smsserver);
				 
				$result = curl_exec($ch);			
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getDepartments($tableName, $officeId){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `office` =:dataID");
				$stmt->bindParam("dataID", $officeId,PDO::PARAM_INT);			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		public function getDivisions($tableName, $deptId){
				try{
					$db = getDB();
					$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `department` =:dataID");
					$stmt->bindParam("dataID", $deptId, PDO::PARAM_INT);			
					$stmt->execute();
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$db = null;
					return $data;
				}
				catch(PDOException $e) {
					echo '{"error":{"text":'. $e->getMessage() .'}}';
				}
			}
			
			public function getAllNotifications($userid){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `app_notify` WHERE `user` =:dataID ORDER BY `created` DESC");
				$stmt->bindParam("dataID", $userid, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getAllTasks($userid){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `app_tasks` WHERE `user`=:dataID ORDER BY `created` DESC");
				$stmt->bindParam("dataID", $userid, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getActiveSM($tablename){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM $tablename WHERE `status`=1");
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getDispatchNum($column, $year, $type){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT `$column` FROM `sys_dispatch_num` WHERE `year` =:YEAR AND `dORr` =:TYPE");
				$stmt->bindParam("YEAR", $year,PDO::PARAM_INT) ;			
				$stmt->bindParam("TYPE", $type,PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetch(PDO::FETCH_OBJ);
				$colData = $data->$column;
				$db = null;
				return $colData;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function updateDRUnumber($type, $year, $updatedDNum){
			try{
				$db = getDB();
				$stmt = $db->prepare("UPDATE `sys_dispatch_num` SET `dr_num` =:dnum WHERE `dORr` =:dr AND `year` =:yr");
				$stmt->bindParam("dnum", $updatedDNum, PDO::PARAM_INT) ;			
				$stmt->bindParam("dr", $type, PDO::PARAM_INT) ;			
				$stmt->bindParam("yr", $year, PDO::PARAM_INT) ;			
				$stmt->execute();
				$db = null;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function removeSpace($filename){  
			return str_replace(" ", "_s", $filename);
		}
		
		public function getReceiptAction($tableName, $id){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `receipt_id` =:dataID ORDER BY created DESC");
				$stmt->bindParam("dataID", $id,PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getTaskIdForRLetter($tableName, $letterId, $userId){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT `id` FROM `$tableName` WHERE `key`=:keyID AND `user`=:userID AND `pending` = '1'");
				$stmt->bindParam("keyID", $letterId, PDO::PARAM_INT) ;			
				$stmt->bindParam("userID", $userId, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetch(PDO::FETCH_OBJ);
				$colData = $data->id;
				$db = null;
				return $colData;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getUsersByDivision($tableName, $divID){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `division` =:dataID");
				$stmt->bindParam("dataID", $divID, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getDispatchAction($tableName, $id){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `$tableName` WHERE `dispatch_id` =:dataID ORDER BY created DESC");
				$stmt->bindParam("dataID", $id,PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getDispatchedLettersByUser($user){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT DISTINCT (a.id), a.fOffice, a.fDept, a.fDiv, a.fSec, a.fiscalYear, a.dispatchNum, a.dateOfIssue, a.adressedTo, a.rOffice, a.rDept, a.rDiv, a.rSubject, a.rRefNum FROM app_dispatch AS a INNER JOIN app_dispatch_actions AS b ON a.id= b.dispatch_id WHERE a.author=:userID OR b.reciever=:userID ORDER BY a.id DESC");
				$stmt->bindParam("userID", $user,PDO::PARAM_INT);	
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getReceiptLettersByUser($user){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT DISTINCT (a.id), a.fOffice, a.fDept, a.fDiv, a.fSubject, a.fRefNum, a.rOffice, a.rDept, a.rDiv, a.rSec, a.recieptNum, a.dateOfReciept FROM app_receipt AS a INNER JOIN app_receipt_actions AS b ON a.id = b.receipt_id WHERE a.author=:userID OR b.reciever=:userID ORDER BY a.id DESC");
				$stmt->bindParam("userID", $user,PDO::PARAM_INT);	
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getDispatchedLetter($drNum, $year){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `app_dispatch` WHERE `dispatchNum` =:numR AND `year` =:dYear");
				$stmt->bindParam("numR", $drNum, PDO::PARAM_STR) ;			
				$stmt->bindParam("dYear", $year, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getRecievedLetter($drNum, $year){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `app_receipt` WHERE `recieptNum` =:numR AND `year` =:dYear");
				$stmt->bindParam("numR", $drNum, PDO::PARAM_STR) ;			
				$stmt->bindParam("dYear", $year, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getDispatchedLetterByRef($drNum, $year){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `app_dispatch` WHERE `rRefNum` LIKE '%$drNum%' AND `year` =:dYear");
				$stmt->bindParam("dYear", $year, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function getRecievedLetterByRef($drNum, $year){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `app_receipt` WHERE `fRefNum` LIKE '%$drNum%' AND `year` =:dYear");
				$stmt->bindParam("dYear", $year, PDO::PARAM_INT) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
		public function checkUserPermission($fileName){
			try{
				$db = getDB();
				$stmt = $db->prepare("SELECT * FROM `sys_acl` WHERE `file_name` =:fName");
				$stmt->bindParam("fName", $fileName, PDO::PARAM_STR) ;			
				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$db = null;
				return $data;
			}
			catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}
		
	}
?>