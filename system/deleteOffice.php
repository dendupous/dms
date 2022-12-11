<?php	
	include('../includes/config.php');
	include('../includes/session.php');
	
	$officeID = $_GET['id'];
	
	$deletedOffice = $generalClass->deleteData(TBL_OFFICE, $officeID);
	
	if($deletedOffice){
		$_SESSION['message'] = "Office details deleted successfully from System.";
		$_SESSION['type'] = "success";
		$url=BASE_URL."system/office.php";
		header("Location: $url"); 
	}else{
		$_SESSION['message'] = "Error deleting office details from the System.";
		$_SESSION['type'] = "danger";
		$url=BASE_URL.'system/office.php';
		header("Location: $url");
	}
?>
