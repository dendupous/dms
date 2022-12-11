<?php	
	include('../includes/config.php');
	include('../includes/session.php');
	
	$divID = $_GET['id'];
	$deleteDept = $generalClass->deleteData(TBL_DIV, $divID);
	
	if($deleteDept){
		$_SESSION['message'] = "Division successfully deleted from the System.";
		$_SESSION['type'] = "success";
		$url=BASE_URL."system/division.php";
		header("Location: $url"); 
	}else{
		$_SESSION['message'] = "Error deleting Division from the System.";
		$_SESSION['type'] = "danger";
		$url=BASE_URL.'system/division.php';
		header("Location: $url"); 
	}
?>
