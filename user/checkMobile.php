<?php
	include("../includes/config.php");
	$available = true;
	if(isset($_POST['mobNo'])){
		$mobMum = $_POST['mobNo'];
		$db = getDB();
		$stmt = $db->prepare("SELECT id FROM sys_users WHERE mobile=:mNum"); 
		$stmt->bindParam("mNum", $mobMum,PDO::PARAM_INT) ;
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