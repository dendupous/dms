<?php	
	include('../includes/config.php');
	include('../includes/session.php');
	
	$secID = $_GET['id'];
	$deleteSec = $generalClass->deleteData(TBL_SEC, $secID);
	
	if($deleteSec){
		$_SESSION['message'] = "Section successfully deleted from the System.";
		$_SESSION['type'] = "success";
		$url=BASE_URL."system/section.php";
		header("Location: $url"); 
	}else{
		$_SESSION['message'] = "Error deleting section from the System.";
		$_SESSION['type'] = "danger";
		$url=BASE_URL.'system/section.php';
		header("Location: $url");
	}
?>
