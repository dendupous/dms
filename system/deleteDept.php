<?php	
	include('../includes/config.php');
	include('../includes/session.php');
	
	$deptID = $_GET['id'];
	$deleteDept = $generalClass->deleteData(TBL_DEPT, $deptID);
	
	if($deleteDept){
		$_SESSION['message'] = "Department successfully deleted from System.";
		$_SESSION['type'] = "success";
		$url=BASE_URL."system/dept.php";
		header("Location: $url"); 
	}else{
		$_SESSION['message'] = "Error deleting dept from the System.";
		$_SESSION['type'] = "danger";
		$url=BASE_URL.'system/dept.php';
		header("Location: $url"); 
	}
?>
