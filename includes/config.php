<?php
	/**
	AUTHOR: Tshering Wangchuk
	EMAIL: twanghcuk@nlcs.gov.bt
	CONTACT #: 17521273
	OFFICE: National Land Commission Secretariat
	**/
	
	session_start();
	
	//Turn off all errors
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);
	
	/* DATABASE SERVER CONFIGURATION */
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root'); 
	define('DB_PASSWORD', 'root');
	define('DB_DATABASE', 'dms_new');
	define("BASE_URL", "http://localhost/dms/"); 
	
	//SMS SERVER
	define('SMS_SERVER', '');
	define('SMS_USERNAME', ''); 
	define('SMS_PASSWORD', ''); 
	define('SMS_DATABASE', '');

	/*GLOBAL MESSAGE*/
	define('CS_FORWARD', 'You have pending task in DMS. Thank You'); 
	define('DR_FORWARD', 'You have received a letter DMS. Thank You');
	define('DR_COPY', 'You have received a copy(cc) in DMS. Thank You');
	
	/*FILE SIZE*/
	define('KB', 1024);
	define('MB', 1048576);
	define('GB', 1073741824);
	define('TB', 1099511627776);
	
	/* ADMIN DETAILS */
	define('ADMIN_NAME', 'Tshering Wangchuk'); 
	define('ADMIN_EMAIL', 'twangchuk@nlcs.gov.bt');
	define('ADMIN_MOBILE', '+975-17521273'); 
	
	/* DATABASE TABLE LIST */
	define('TBL_USER', 'sys_users');
	define('TBL_MENU', 'sys_menu');
	define('TBL_SUB_MENU', 'sys_sub_menu');
	define('TBL_OFFICE', 'sys_office');
	define('TBL_DEPT', 'sys_departments');
	define('TBL_DIV', 'sys_divisions');
	define('TBL_SEC', 'sys_sections');
	define('TBL_ROLE', 'sys_roles');
	define('TBL_NOTIFY', 'app_notify');
	define('TBL_TASKS', 'app_tasks');
	define('TBL_DRNUM', 'sys_dispatch_num');
	define('TBL_DISPATCH', 'app_dispatch');
	define('TBL_RECEIPT', 'app_receipt');
	define('TBL_DACTION', 'app_dispatch_actions');
	define('TBL_RACTION', 'app_receipt_actions');
	define('TBL_RSTATUS', 'sys_receipt_status');
	define('TBL_DSTATUS', 'sys_dispatch_status');
	define('TBL_SMSL', 'sms_log');
	define('TBL_SM', 'app_social_media');
	
	date_default_timezone_set('Asia/Thimphu');
	
	$created = date('Y-m-d H:i:s');
	$modified = date('Y-m-d H:i:s');
	$today = date('Y-m-d H:i:s');
	
	
	function getDB(){
		$dbhost=DB_SERVER;
		$dbuser=DB_USERNAME;
		$dbpass=DB_PASSWORD;
		$dbname=DB_DATABASE;
		try {
			$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); 
			$dbConnection->exec("set names utf8");
			$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConnection;
		}
		catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}

	
	function getSMSDB(){
		// $dbhost2=DB2_SERVER;
		// $dbuser2=DB2_USERNAME;
		// $dbpass2=DB2_PASSWORD;
		// $dbname2=DB2_DATABASE;
		
		try {
			$dbConnection2 = new PDO("mysql:host=$dbhost2;dbname=$dbname2", $dbuser2, $dbpass2); 
			$dbConnection2->exec("set names utf8");
			$dbConnection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConnection2;
		}
		catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
?>
