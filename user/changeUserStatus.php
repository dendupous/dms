<?php	
	include('../includes/config.php');
	include('../includes/session.php');
	
	$params = explode('-', $_GET['id']);
	$userID = $params['0'];
	$userStatus = $params['1'];
	
	if($userStatus == 1){
		$data = array(
			'status' => '0'
		);
		$updateStatus = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$userID'");
		$url=BASE_URL."user/index.php";
		header("Location: $url");
	}else{
		$data = array(
			'status' => '1'
		);
		$updateStatus = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$userID'");
		$url=BASE_URL."user/index.php";
		header("Location: $url");
	}
?>
