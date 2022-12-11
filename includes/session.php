<?php
	if(!empty($_SESSION['id'])){
		$time_now = time();
		$timeout_duration = 3600; //60*60 = 1 hour
		if (isset($_SESSION['LAST_ACTIVITY']) && ($time_now - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
			session_unset();
			session_destroy();
			$url = BASE_URL.'auth/';
			header("Location: $url");
		}else{
			$session_uid = $_SESSION["id"];
			$_SESSION["LAST_ACTIVITY"] = $time_now;
			include('userClass.php');
			include('generalClass.php');
			$userClass = new userClass();
			$generalClass = new generalClass();			
		}
	}else{
		$url = BASE_URL.'auth/';
		header("Location: $url");
	}
?>