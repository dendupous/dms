<?php
	include("../includes/config.php");
	$available = true;
	if(isset($_POST['mailID'])){
		$emailID = $_POST['mailID'];
		$db = getDB();
		$stmt = $db->prepare("SELECT id FROM sys_users WHERE email=:mailID"); 
		$stmt->bindParam("mailID", $emailID,PDO::PARAM_STR) ;
		$stmt->execute();
		$count=$stmt->rowCount();
		$db = null;
		
		if($count > 0){
			$available = false;
		}else{
			$available =  true;
		} 
		echo json_encode(array('valid' => $available));
	} 
?>