<?php
	include("../includes/config.php");
	include('../includes/generalClass.php');
	
	$generalClass = new generalClass();
	$statusId = $_GET['s'];
	$userId = $_GET['uid'];
	
	if(isset($statusId)){
		$data = array(
			'user_status' => $statusId,
		);
		$changeStatus = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$userId'");
		if($statusId == 0){ $statusMessage = "Status successfully changed to Invisible."; }
		if($statusId == 1){ $statusMessage = "Status successfully changed to Available."; }
		if($statusId == 2){ $statusMessage = "Status successfully changed to Busy."; }
		if($changeStatus){
			$_SESSION['message'] = $statusMessage;
			$_SESSION['type'] = "success";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url"); // Page redirecting to home.php 
		}else{
			$_SESSION['message'] = "Error changing the status. Please try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url"); // Page redirecting to home.php
		}
	}
?>
