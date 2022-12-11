<?php	
	include('../includes/config.php');
	include('../includes/session.php');
	
	$smID = $_GET['id'];
	
	$deletedSM = $generalClass->deleteData(TBL_SM, $smID);
	
	if($deletedSM){
		$_SESSION['message'] = "Social media details deleted successfully from System.";
		$_SESSION['type'] = "success";
		$url=BASE_URL.'system/socialmediasetup.php';
		header("Location: $url"); 
	}else{
		$_SESSION['message'] = "Error deleting social media details from the System.";
		$_SESSION['type'] = "danger";
		$url=BASE_URL.'system/socialmediasetup.php';
		header("Location: $url");
	}
?>
