<?php
		
	include("config.php");
	include('userClass.php');
	include('generalClass.php');

	$userClass = new userClass();
	$generalClass = new generalClass();

	$author = $_SESSION['id'];
	
	if (isset($_POST["loginSubmit"])) {
		$userName = trim($_POST['userNameInput']);
		$userPass = trim($_POST['userPassInput']);
			
		if(strlen(trim($userName))>1 && strlen(trim($userPass))>1 ){
			$uid = $userClass->userLogin($userName, $userPass);
			
			if($uid){
				$url=BASE_URL.'main/';
				header("Location: $url");
			}else{
				$_SESSION['message'] = "Error logging in. Please check your credentials and try again.";
				$_SESSION['type'] = "danger";
				$url=BASE_URL.'auth/';
				header("Location: $url");
			}
		}
	}
	
	if (isset($_POST["resetPassword"])) {
		$mobile = trim($_POST['userNameInput']);
		
		$check = $generalClass->checkUser(TBL_USER, $mobile);
		foreach($check as $userDtls);
		$userId = $userDtls['id'];
		$userCheck = sizeof($check);

		if($userCheck == 1){
			$a = rand(1111, 9999);
			$b = chr(rand(97,122));
			$c = chr(rand(97,122));
			$d = chr(rand(97,122));
			$e = chr(rand(97,122));
			$password = $a.$b.$c.$d.$e;
			$userPassword = SHA1(SHA1($password));

			$data = array(
				'password' 	=>$userPassword
			);
			
			$message = "Your new password for my NLCS is $password \nThank You.";
			$sendPassword = $generalClass->sendSMS($mobile, $message);
			$saveuserPass = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$userId'");

			$_SESSION['message'] = "Password sent to your mobile as SMS. Please check your mobile and login.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'auth/';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "This user do not exist in my NLCS. Please check your mobile number or contact Administrator.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'auth/';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['changeUserPhoto'])){
		$userPhotoID = $_POST['userPhotoID'];
		$file_name = $_FILES['userPhotoUpload']['name'];
		$file_size =$_FILES['userPhotoUpload']['size'];
		$file_tmp =$_FILES['userPhotoUpload']['tmp_name'];
		$file_type=$_FILES['userPhotoUpload']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['userPhotoUpload']['name'])));

		$a= rand(0,10);
		$b=chr(rand(97,122));
		$c=chr(rand(97,122));
		$d= rand(0,11000);
		$e=chr(rand(97,122));
		$f= rand(0,10);
		$date = date('ymd',strtotime(date('Y-m-d')));
		$filename = $userPhotoID.'_'.$date.$a.$b.$c.$d.$e.$f.'.' . $file_ext;

		$data = array(
			'photo' 		=> $filename,
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$expensions= array("jpeg","jpg","png");

		if(in_array($file_ext,$expensions)=== false){
			$_SESSION['message'] = "Extension not allowed, please choose a JPEG or PNG file.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}

		if($file_size > 8388608){
			$_SESSION['message'] = "File size must be less than or equal to 8MB.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}

		$directory = BASE_URL."images/user/";
		
		$userOldImageName = $generalClass->getColumn('photo', TBL_USER, $userPhotoID);
		$oldDirectory = $directory.$userOldImageName;
		unlink($oldDirectory);

		$changeUserPhoto = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$userPhotoID'");
		$rValue = explode("-", $changeUserPhoto);
		$uUserPhoto = $rValue['0'];
		if($uUserPhoto){
			move_uploaded_file($file_tmp, $directory.$filename);
			$_SESSION['message'] = "Your Photo has been successfully changed.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error changing your photo. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['changeUserProfilePassword'])){
		$uEditId = $_POST['userPassID'];
		$uNewPass = $_POST['newpassword'];
		$uPassword = SHA1(SHA1($uNewPass));
		$data = array(
			'password' 		=> $uPassword,
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$changeUserPasswd = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$uEditId'");
		$rValue = explode("-", $changeUserPasswd);
		$uPwUser = $rValue['0'];
		if($uPwUser){
			$_SESSION['message'] = "Your password successfully changed.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error changing your password. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['editUserProfile'])){
		$uPEditId = $_POST['userProfileEditID'];
		
		$data = array(
			'name' 			=> $_POST['fullName'],
			'email' 		=> $_POST['emailID'],
			'mobile' 		=> $_POST['mobNum'],
			'cid' 			=> $_POST['cidNum'],
			'empid' 		=> $_POST['empNum'],
			'department' 	=> $_POST['department'],
			'division' 		=> $_POST['division'],
			'section' 		=> $_POST['section'],
			'office_num' 	=> $_POST['officePhone'],
			'ext_num' 	    => $_POST['extNum'],
			'designation' 	=> $_POST['designation'],
			'author' 		=> $author,
			'modified' 		=> $today
		);
		
		$updateUserProfile = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$uPEditId'");
		$rValue = explode("-", $updateUserProfile);
		$uUserProfile = $rValue['0'];
		if($uUserProfile){
			$_SESSION['message'] = "Your profile info. successfully edited in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error editing your profile. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/userProfile.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['addNewOffice'])){
		$data = array(
			'name' 			=> $_POST['office'],
			'description' 	=> $_POST['office_desc'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);
		
		$insertOffice = $generalClass->saveData(TBL_OFFICE, $data);
		
		$rValue = explode("-", $insertOffice);
		$addOffice = $rValue['0'];
		$newID = $rValue['1'];
		if($addOffice){
			$_SESSION['message'] = "New office details successfully added in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/office.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error adding new office details. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/office.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['editOffice'])){
		$deptOfficeID = $_POST['deptOfficeID'];
		$data = array(
			'name' 			=> $_POST['office'],
			'description' 	=> $_POST['office_desc'],
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$updateOffice = $generalClass->updateData(TBL_OFFICE, $data, "WHERE id = '$deptOfficeID'");
		$rValue = explode("-", $updateOffice);
		$updatedOffice = $rValue['0'];
		$newID = $rValue['1'];
		if($updatedOffice){
			$_SESSION['message'] = "Office details edited successfully in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/office.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error editing office details. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/office.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['addNewDept'])){
		$data = array(
			'office' 		=> $_POST['office'],
			'name' 			=> $_POST['department'],
			'description' 	=> $_POST['ddesc'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$insertDept = $generalClass->saveData(TBL_DEPT, $data);
		$rValue = explode("-", $insertDept);
		$addDept = $rValue['0'];
		$newID = $rValue['1'];
		if($addDept){
			$_SESSION['message'] = "New Department successfully added for the office in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/dept.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error adding new deparment for the office. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/dept.php';
			header("Location: $url");
		}
	}

	if(isset($_POST['editDept'])){
		$deptEditId = $_POST['deptEditID'];
		$data = array(
			'office' 		=> $_POST['office'],
			'name' 			=> $_POST['department'],
			'description' 	=> $_POST['ddesc'],
			'author' 		=> $author,
			'modified' 		=> $today
		);
		
		$updateDeptt = $generalClass->updateData(TBL_DEPT, $data, "WHERE id = '$deptEditId'");
		$rValue = explode("-", $updateDeptt);
		$updateDept = $rValue['0'];
		$newID = $rValue['1'];
		if($updateDept){
			$_SESSION['message'] = "Department successfully edited in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/dept.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error editing deparment. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/dept.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['addNewDiv'])){
		$data = array(
			'department' 	=> $_POST['department'],
			'name' 			=> $_POST['division'],
			'description' 	=> $_POST['ddesc'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$insertDiv = $generalClass->saveData(TBL_DIV, $data);
		$rValue = explode("-", $insertDiv);
		$addDiv = $rValue['0'];
		$newID = $rValue['1'];
		if($addDiv){
			$_SESSION['message'] = "New Division successfully added in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/division.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error adding new division. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/division.php';
			header("Location: $url");
		}
	}

	if(isset($_POST['editDiv'])){
		$divID = $_POST['divEditID'];
		$data = array(
			'department' 	=> $_POST['department'],
			'name' 			=> $_POST['division'],
			'description' 	=> $_POST['ddesc'],
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$updateDivision = $generalClass->updateData(TBL_DIV, $data, "WHERE id = '$divID'");
		$rValue = explode("-", $updateDivision);
		$updateDiv = $rValue['0'];
		$newID = $rValue['1'];
		if($updateDiv){
			$_SESSION['message'] = "Division successfully edited in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/division.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error editing division. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/division.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['addNewSec'])){
		$data = array(
			'division' 		=> $_POST['division'],
			'name' 			=> $_POST['section'],
			'description' 	=> $_POST['sdesc'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$insertSec = $generalClass->saveData(TBL_SEC, $data);
		$rValue = explode("-", $insertSec);
		$addSec = $rValue['0'];
		$newID = $rValue['1'];
		if($addSec){
			$_SESSION['message'] = "New Section successfully added in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/section.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error adding new section. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/section.php';
			header("Location: $url");
		}
	}

	if(isset($_POST['editSec'])){
		$secID = $_POST['secEditID'];
		$data = array(
			'division' 		=> $_POST['division'],
			'name' 			=> $_POST['section'],
			'description' 	=> $_POST['sdesc'],
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$updateSection = $generalClass->updateData(TBL_SEC, $data, "WHERE id = '$secID'");
		$rValue = explode("-", $updateSection);
		$updateSec = $rValue['0'];
		$newID = $rValue['1'];
		if($updateSec){
			$_SESSION['message'] = "Section successfully edited in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/section.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error editing Section. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/section.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['addNewUser'])){
		$pass = $_POST['password'];
		$oLocation = $_POST['uoffice'];
		$roles = $_POST['uRoles'];

		$userRoles = implode(',', $roles);

		$data = array(
			'name' 			=> $_POST['fullName'],
			'email' 		=> $_POST['emailID'],
			'mobile' 		=> $_POST['mobNum'],
			'cid' 			=> $_POST['cidNum'],
			'empid' 		=> $_POST['empNum'],
			'office' 		=> $_POST['office'],
			'department' 	=> $_POST['department'],
			'division' 		=> $_POST['division'],
			'section' 		=> $_POST['section'],
			'designation' 	=> $_POST['designation'],
			'office_num' 	=> $_POST['officePhone'],
			'ext_num' 		=> $_POST['extNum'],
			'role' 			=> $userRoles,
			'status' 		=> "1",
			'user_status' 	=> "1",
			'photo' 		=> "",
			'last_login' 	=> "",
			'last_logout' 	=> "",
			'last_access_ip'=> "",
			'logins' 		=> "0",
			'password' 		=> SHA1(SHA1($pass)),
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);
		$insertUser = $generalClass->saveData(TBL_USER, $data);
		$rValue = explode("-", $insertUser);
		$addUser = $rValue['0'];
		if($addUser){
			$_SESSION['message'] = "User successfully created in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'user/';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error creating user. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/adduser.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['editUser'])){
		$uEditId = $_POST['userEditID'];
		
		$roles = $_POST['uRoles'];
		$userRoles = implode(',', $roles);
		
		$data = array(
			'name' 			=> $_POST['fullName'],
			'email' 		=> $_POST['emailID'],
			'mobile' 		=> $_POST['mobNum'],
			'cid' 			=> $_POST['cidNum'],
			'empid' 		=> $_POST['empNum'],
			'office' 		=> $_POST['office'],
			'department' 	=> $_POST['department'],
			'division' 		=> $_POST['division'],
			'section' 		=> $_POST['section'],
			'office_num' 	=> $_POST['officePhone'],
			'ext_num' 	    => $_POST['extNum'],
			'designation' 	=> $_POST['designation'],
			'role' 			=> $userRoles,
			'author' 		=> $author,
			'modified' 		=> $today
		);
		
		$updateUser = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$uEditId'");
		$rValue = explode("-", $updateUser);
		$uUser = $rValue['0'];
		if($uUser){
			$_SESSION['message'] = "User successfully edited in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'user/';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error editing user. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['changeUserPassword'])){
		$uEditId = $_POST['userPassID'];
		$uNewPass = $_POST['newpassword'];
		$uPassword = SHA1(SHA1($uNewPass));
		$data = array(
			'password' 		=> $uPassword,
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$changeUserPasswd = $generalClass->updateData(TBL_USER, $data, "WHERE id = '$uEditId'");
		$rValue = explode("-", $changeUserPasswd);
		$uPwUser = $rValue['0'];
		if($uPwUser){
			$_SESSION['message'] = "Password successfully changed for the user.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'user/';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error changing password for the user. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'user/';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['addNewSocialMedia'])){
		$data = array(
			'name' 			=> $_POST['smname'],
			'link' 			=> $_POST['smurl'],
			'status' 		=> '1',
			'icon' 			=> $_POST['smicon'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);
		$insertSM = $generalClass->saveData(TBL_SM, $data);
		$rValue = explode("-", $insertSM);
		$addedSM = $rValue['0'];
		if($addedSM){
			$_SESSION['message'] = "Media successfully added in the System.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/socialmediasetup.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error adding social media. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/socialmediasetup.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['editSocialMedia'])){
		$smId = $_POST['smEditID'];
		
		$data = array(
			'name' 			=> $_POST['smname'],
			'link' 			=> $_POST['smurl'],
			'status' 		=> $_POST['smstatus'],
			'icon' 			=> $_POST['smicon'],
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$updateSM = $generalClass->updateData(TBL_SM, $data, "WHERE id = '$smId'");
		$rValue = explode("-", $updateSM);
		$updatedSM = $rValue['0'];
		if($updatedSM){
			$_SESSION['message'] = "Social media details edited successfully.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'system/socialmediasetup.php';
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error changing editing social media details. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'system/socialmediasetup.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['dispatchLetter'])){
		$file_name = $generalClass->removeSpace($_FILES['letterCopy']['name']);
		$file_size =$_FILES['letterCopy']['size'];
		$file_tmp =$_FILES['letterCopy']['tmp_name'];
		$file_type=$_FILES['letterCopy']['type'];
		$file_ext=strtolower(end(explode('.', $_FILES['letterCopy']['name'])));
		
		$a= rand(0,10);
		$b=chr(rand(97,122));
		$c=chr(rand(97,122));
		$d= rand(0,11000);
		$e=chr(rand(97,122));
		$f= rand(0,10);
		$date = date('ymd',strtotime(date('Y-m-d')));
		$filename = $date.$a.$b.$c.$d.$e.$f.'.' . $file_ext;

		if($file_size > 8388608){
			$_SESSION['message'] = "File size must be less than or equal to 8 MB.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/dispatchLetter.php';
			header("Location: $url");
		}
		$directory = BASE_URL."uploads/dispatchedLetter/";
		
		$drNumber = $_POST['dnumber'];
		if(strlen($drNumber) == 6){
			$drNumber = $_POST['dnumber'];
		}else if(strlen($drNumber) == 5){
			$drNumber = '0'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 4){
			$drNumber = '00'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 3){
			$drNumber = '000'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 2){
			$drNumber = '0000'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 1){
			$drNumber = '00000'.$_POST['dnumber'];
		}
		
		$year = date('Y', strtotime($_POST['adate']));
		$month = date('n', strtotime($_POST['adate']));
		$data = array(
			'fOffice'		=> $_POST['oname'],
			'fDept' 		=> $_POST['adepartment'],
			'fDiv' 			=> $_POST['adivision'],
			'fSec' 			=> $_POST['asection'],
			'fiscalYear' 	=> $_POST['fyear'],
			'dispatchNum' 	=> $drNumber,
			'dateOfIssue' 	=> $_POST['adate'],
			'year' 			=> $year,
			'month' 		=> $month,
			'timeOfIssue' 	=> $_POST['atime'],
			'adressedTo' 	=> addslashes($_POST['address']),
			'rack_number' 	=> $_POST['racknum'],
			'file_number' 	=> $_POST['filenum'],
			'rOffice' 		=> $_POST['doffice'],
			'rDept' 		=> $_POST['dodept'],
			'rDiv' 			=> $_POST['dodivision'],
			'rPlace' 		=> $_POST['doplace'],
			'rSubject' 		=> addslashes($_POST['subject']),
			'rRefNum' 		=> $_POST['refNum'],
			'rCopyTo' 		=> addslashes($_POST['copyTo']),
			'fileName' 		=> $file_name,
			'filePath' 		=> $filename,
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);
		
		$insertDispatch = $generalClass->saveData(TBL_DISPATCH, $data);
		$rValue = explode("-", $insertDispatch);
		$addDispatch = $rValue['0'];
		$newID = $rValue['1'];

		if($addDispatch){
			$updatedDNum = $_POST['dnumber'];
			$type = 1;
			$year = date("Y");
			$updateDNUM = $generalClass->updateDRUnumber($type, $year, $updatedDNum);

			$directoryName = date('Ymd', strtotime($today));
			$checkDir = $directory.$directoryName;
			if(!file_exists($checkDir)){
				mkdir($checkDir, 0755, true);
			}
			move_uploaded_file($file_tmp, $checkDir."/".$filename);

			$_SESSION['message'] = "Letter successfully dispatched.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$newID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error dispatching Letter. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/dispatchLetter.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['recieveLetter'])){
		$file_name = $generalClass->removeSpace($_FILES['letterCopy']['name']);
		$file_size = $_FILES['letterCopy']['size'];
		$file_tmp = $_FILES['letterCopy']['tmp_name'];
		$file_type = $_FILES['letterCopy']['type'];
		$file_ext = strtolower(end(explode('.',$_FILES['letterCopy']['name'])));

		$a = rand(0,10);
		$b = chr(rand(97,122));
		$c = chr(rand(97,122));
		$d = rand(0,11000);
		$e = chr(rand(97,122));
		$f = rand(0,10);
		$date = date('ymd',strtotime(date('Y-m-d')));
		$filename = $date.$a.$b.$c.$d.$e.$f.'.' . $file_ext;

		if($file_size > 8388608){
			$_SESSION['message'] = "File size must be less than or equal to 8 MB.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/dispatchLetter.php';
			header("Location: $url");
		}
		$directoryPath = BASE_URL."uploads/receiptLetter/";

		$year = date('Y', strtotime($_POST['adate']));
		$month = date('n', strtotime($_POST['adate']));
		
		$drNumber = $_POST['dnumber'];
		if(strlen($drNumber) == 6){
			$drNumber = $_POST['dnumber'];
		}else if(strlen($drNumber) == 5){
			$drNumber = '0'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 4){
			$drNumber = '00'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 3){
			$drNumber = '000'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 2){
			$drNumber = '0000'.$_POST['dnumber'];
		}else if(strlen($drNumber) == 1){
			$drNumber = '00000'.$_POST['dnumber'];
		}
		
		$data = array(
			'addressedTo' 	=> addslashes($_POST['address']),
			'fOffice'		=> $_POST['doffice'],
			'fDept' 		=> $_POST['dodept'],
			'fDiv' 			=> $_POST['dodivision'],
			'fPlace' 		=> $_POST['doplace'],
			'fSubject' 		=> addslashes($_POST['subject']),
			'fRefNum' 		=> $_POST['refNum'],
			'fCopyTo' 		=> addslashes($_POST['copyTo']),
			'rack_number' 	=> $_POST['racknum'],
			'file_number' 	=> $_POST['filenum'],
			'fileName' 		=> $file_name,
			'filePath' 		=> $filename,
			'rOffice' 		=> $_POST['oname'],
			'rDept' 		=> $_POST['adepartment'],
			'rDiv' 			=> $_POST['adivision'],
			'rSec' 			=> $_POST['asection'],
			'fiscalYear' 	=> $_POST['fyear'],
			'recieptNum' 	=> $drNumber,
			'dateOfReciept' => $_POST['adate'],
			'year' 			=> $year,
			'month' 		=> $month,
			'timeOfReciept' => $_POST['atime'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);
		//echo "<pre>"; print_r($data); exit;
		$insertReceipt = $generalClass->saveData(TBL_RECEIPT, $data);
		$rValue = explode("-", $insertReceipt);
		$addReceipt = $rValue['0'];
		$newID = $rValue['1'];

		if($addReceipt){
			$updatedDNum = $_POST['dnumber'];
			$type = 2;
			$year = date("Y");
			$updateDNUM = $generalClass->updateDRUnumber($type, $year, $updatedDNum);

			$directoryName = date('Ymd', strtotime($today));
			$checkDir = $directoryPath.$directoryName;
			if(!file_exists($checkDir)){
				mkdir($checkDir, 0755, true);
			}
			move_uploaded_file($file_tmp, $checkDir."/".$filename);

			$_SESSION['message'] = "Letter successfully receieved.";
			$_SESSION['type'] = "success";
			$url = BASE_URL.'ods/rLetterAction.php?id='.$newID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error receieving Letter. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/recieveLetter.php';
			header("Location: $url");
		}
	}
	
	if(isset($_POST['uploadReceiptDocument'])){
		$rID = $_POST['recID'];

		$checkDate = $generalClass->getColumn('dateOfReciept', TBL_RECEIPT, $rID);
		$directoryName =  date('Ymd', strtotime($checkDate));
		
		$file_name = $generalClass->removeSpace($_FILES["recDocument"]["name"]);
		$file_size = $_FILES["recDocument"]["size"];
		$file_tmp = $_FILES["recDocument"]["tmp_name"];
		
		$file_type = $_FILES["recDocument"]["type"];
		$file_ext = strtolower(end(explode('.', $_FILES["recDocument"]["name"])));
		$a= rand(0,10);
		$b=chr(rand(97,122));
		$c=chr(rand(97,122));
		$d= rand(0,11000);
		$e=chr(rand(97,122));
		$f= rand(0,10);
		$date = date('ymd',strtotime(date('Y-m-d')));
		$filename = $date.$a.$b.$c.$d.$e.$f.'.'.$file_ext;

		$data = array(
			'fileName'		=> $file_name,
			'filePath' 		=> $filename,
			'author' 		=> $author,
			'modified' 		=> $today
		);

		$expensions= array("jpeg","jpg","png", "tif", "pdf", "doc");

		if(in_array($file_ext,$expensions)=== false){
			$_SESSION['message'] = "Extension not allowed, please choose a JPEG, PNG, PDF or DOC file.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
      
		if($file_size > 8388608){
			$_SESSION['message'] = "File size must be less than or equal to 8 MB.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
		
		$directoryPath = "../uploads/receiptLetter/";

		$checkDir = $directoryPath.$directoryName;
		
		if(!file_exists($checkDir)){
			mkdir($checkDir, 0755, true);
		}
		
		$uploadRecFile = $generalClass->updateData(TBL_RECEIPT, $data, "WHERE id = '$rID'");
		$rValue = explode("-", $uploadRecFile);
		$uRecFile = $rValue['0'];
		if($uRecFile){
			move_uploaded_file($file_tmp, $checkDir."/".$filename);
			$_SESSION['message'] = "Document has been successfully uploaded.";
			$_SESSION['type'] = "success";
			$url = BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error uploading the document. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url = BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['uploadReceiptFile'])){
		$rID = $_POST['recID'];

		$file_name = $generalClass->removeSpace($_FILES['recFile']['name']);
		$file_size =$_FILES['recFile']['size'];
		$file_tmp =$_FILES['recFile']['tmp_name'];
		$file_type=$_FILES['recFile']['type'];
		$file_ext=strtolower(end(explode('.', $_FILES['recFile']['name'])));

		$a= rand(0,10);
		$b=chr(rand(97,122));
		$c=chr(rand(97,122));
		$d= rand(0,11000);
		$e=chr(rand(97,122));
		$f= rand(0,10);
		$date = date('ymd',strtotime(date('Y-m-d')));
		$filename = $date.$a.$b.$c.$d.$e.$f.'.' . $file_ext;

		$data = array(
			'receipt_id' 	=> $rID,
			'type' 			=> "1",
			'filepath' 		=> $filename,
			'file_name'		=> $file_name,
			'remarks' 		=> "",
			'status' 		=> "",
			'reciever' 		=> "",
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$expensions= array("jpeg","jpg","png", "pdf", "doc");

		if(in_array($file_ext,$expensions)=== false){
			$_SESSION['message'] = "Extension not allowed, please choose a JPEG, PNG, PDF or DOC file.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}

		if($file_size > 8388608){
			$_SESSION['message'] = "File size must be less than or equal to 8 MB.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}

		$directory = "../uploads/receiptLetter/";
		$date = date('Ymd');

		$checkDir = $directory.$date;
		if(!file_exists($checkDir)){
			mkdir($checkDir, 0755, true);
		}

		$uploadRecFile = $generalClass->saveData(TBL_RACTION, $data);
		$rValue = explode("-", $uploadRecFile);
		$uRecFile = $rValue['0'];
	
		if($uRecFile){
			move_uploaded_file($file_tmp, $checkDir."/".$filename);
			$_SESSION['message'] = "Document has been successfully uploaded.";
			$_SESSION['type'] = "success";
			$url = BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error uploading the document. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url = BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['writeReceiptRemarks'])){
		$rID = $_POST['recID'];
		$data = array(
			'receipt_id' 	=> $rID,
			'type' 			=> "2",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> addslashes($_POST['remarks']),
			'status' 		=> "",
			'reciever' 		=> "",
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$writeRemarks = $generalClass->saveData(TBL_RACTION, $data);
		$rValue = explode("-", $writeRemarks);
		$wRemark = $rValue['0'];
		$newID = $rValue['1'];

		if($wRemark){
			$_SESSION['message'] = "Your remarks successfully added.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error adding remarks. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['changeReceiptStatus'])){
		$rID = $_POST['recID'];
		$data = array(
			'receipt_id' 	=> $rID,
			'type' 			=> "3",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> "",
			'status' 		=> $_POST['status'],
			'reciever' 		=> "",
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$writeRemarks = $generalClass->saveData(TBL_RACTION, $data);
		$rValue = explode("-", $writeRemarks);
		$wRemark = $rValue['0'];
		$newID = $rValue['1'];

		if($wRemark){
			if($_POST['status'] == 2){
				$taskId = $generalClass->getTaskIdForRLetter(TBL_TASKS, $rID, $author);
				$taskData = array(
					'pending' 		=> "0",
					'author' 		=> $author,
					'modified' 		=> $today
				);
				$updateTask = $generalClass->updateData(TBL_TASKS, $taskData, "WHERE id = '$taskId'");
			}
			$_SESSION['message'] = "Status successfully changed.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error changing status. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['forwardReceipt'])){
		$rID = $_POST['recID'];
		$data = array(
			'receipt_id' 	=> $rID,
			'type' 			=> "5",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> addslashes($_POST['fRemarks']),
			'status' 		=> "",
			'reciever' 		=> $_POST['fofficial'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$insertReceiptAction = $generalClass->saveData(TBL_RACTION, $data);
		$rValue = explode("-", $insertReceiptAction);
		$addVA = $rValue['0'];
		$newID = $rValue['1'];

		if($addVA){
			$taskId = $generalClass->getTaskIdForRLetter(TBL_TASKS, $rID, $author);
			$taskData = array(
				'pending' 		=> "0",
				'author' 		=> $author,
				'modified' 		=> $today
			);
			$updateTask = $generalClass->updateData(TBL_TASKS, $taskData, "WHERE id = '$taskId'");

			$user = $_POST['fofficial'];
			$notifyData = array(
				'route' 		=> "ods",
				'action' 		=> "rLetterAction.php",
				'key' 			=> $rID,
				'user' 			=> $user,
				'flag' 			=> "0",
				'remarks' 		=> addslashes($_POST['fRemarks']),
				'author' 		=> $author,
				'created' 		=> $today,
				'modified' 		=> $today
			);
			$insertNotification = $generalClass->saveData(TBL_NOTIFY, $notifyData);

			$taskDataAdd = array(
				'route' 		=> "ods",
				'action' 		=> "rLetterAction.php",
				'key' 			=> $rID,
				'user' 			=> $user,
				'flag' 			=> "0",
				'pending' 		=> "1",
				'remarks' 		=> "Official letter in the system needs your attention.",
				'author' 		=> $author,
				'created' 		=> $today,
				'modified' 		=> $today
			);
			$insertTask = $generalClass->saveData(TBL_TASKS, $taskDataAdd);

			$userName = $generalClass->getColumn('name', TBL_USER, $user);

			$userMobile = $generalClass->getColumn('mobile', TBL_USER, $user);
			//$smsNotify = $generalClass->sendSMS($userMobile, DR_FORWARD);

			$_SESSION['message'] = "Receipt information successfully forwarded to $userName.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error forwarding receipt info. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['forwardReceiptToDivision'])){
		$rID = $_POST['recID'];
		$rDiv = $_POST['fdivision'];
		$divisioName = $generalClass->getColumn('name', TBL_DIV, $_POST['fdivision']);
		$divUsers = $generalClass->getUsersByDivision(TBL_USER, $rDiv);
		
		foreach($divUsers as $divUser){
			$data = array(
				'receipt_id' 	=> $rID,
				'type' 			=> "5",
				'filepath' 		=> "",
				'file_name'		=> "",
				'remarks' 		=> addslashes($_POST['fRemarks']),
				'status' 		=> "",
				'reciever' 		=> $divUser['id'],
				'author' 		=> $author,
				'created' 		=> $today,
				'modified' 		=> $today
			);
			$insertReceiptAction = $generalClass->saveData(TBL_RACTION, $data);
			$rValue = explode("-", $insertReceiptAction);
			$addVA = $rValue['0'];
			$newID = $rValue['1'];
			if($addVA){
				$notifyData = array(
					'route' 		=> "ods",
					'action' 		=> "rLetterAction.php",
					'key' 			=> $rID,
					'user' 			=> $divUser['id'],
					'flag' 			=> "0",
					'remarks' 		=> addslashes($_POST['fRemarks']),
					'author' 		=> $author,
					'created' 		=> $today,
					'modified' 		=> $today
				);
				$insertNotification = $generalClass->saveData(TBL_NOTIFY, $notifyData);
			}
		}
		
		$taskId = $generalClass->getTaskIdForRLetter(TBL_TASKS, $rID, $author);
		$taskData = array(
			'pending' 		=> "0",
			'author' 		=> $author,
			'modified' 		=> $today
		);
		$updateTask = $generalClass->updateData(TBL_TASKS, $taskData, "WHERE id = '$taskId'");

		$_SESSION['message'] = "Receipt information successfully forwarded to $divisioName.";
		$_SESSION['type'] = "success";
		$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
		header("Location: $url");
	}
	
	if(isset($_POST['forwardReceiptToAll'])){
		$rID = $_POST['recID'];
		$data = array(
			'receipt_id' 	=> $rID,
			'type' 			=> "6",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> addslashes($_POST['fRemarks']),
			'status' 		=> "",
			'reciever' 		=> "",
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$insertReceiptAction = $generalClass->saveData(TBL_RACTION, $data);
		$rValue = explode("-", $insertReceiptAction);
		$addVA = $rValue['0'];
		$newID = $rValue['1'];

		$allUsers = $generalClass->getAll(TBL_USER);

		if($addVA){
			foreach($allUsers as $hqUsers){
				$official = $hqUsers['id'];
				$officialMobile = $hqUsers['mobile'];
				$notifyData = array(
					'route' 		=> "ods",
					'action' 		=> "rLetterAction.php",
					'key' 			=> $rID,
					'user' 			=> $official,
					'flag' 			=> "0",
					'remarks' 		=> addslashes($_POST['fRemarks']),
					'author' 		=> $author,
					'created' 		=> $today,
					'modified' 		=> $today
				);
				$insertNotification = $generalClass->saveData(TBL_NOTIFY, $notifyData);
				//$smsNotify = $generalClass->sendSMS($officialMobile, DR_COPY);
			}
			$_SESSION['message'] = "Receipt letter successfully forwarded to all officials.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error forwarding receipt to officials. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/rLetterAction.php?id='.$rID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['writeDispatchRemarks'])){
		$dID = $_POST['disID'];
		$data = array(
			'dispatch_id' 	=> $dID,
			'type' 			=> "2",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> addslashes($_POST['remarks']),
			'status' 		=> "",
			'reciever' 		=> "",
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$writeRemarks = $generalClass->saveData(TBL_DACTION, $data);
		$rValue = explode("-", $writeRemarks);
		$wRemark = $rValue['0'];
		$newID = $rValue['1'];

		if($wRemark){
			$_SESSION['message'] = "Your remarks successfully added.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error adding remarks. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['changeDispatchStatus'])){
		$dID = $_POST['disID'];
		$data = array(
			'dispatch_id' 	=> $dID,
			'type' 			=> "3",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> "",
			'status' 		=> $_POST['status'],
			'reciever' 		=> "",
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$writeRemarks = $generalClass->saveData(TBL_DACTION, $data);
		$rValue = explode("-", $writeRemarks);
		$wRemark = $rValue['0'];
		$newID = $rValue['1'];

		if($wRemark){
			$_SESSION['message'] = "Status successfully changed.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error changing status. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['forwardDispactch'])){
		$dID = $_POST['disID'];
		$data = array(
			'dispatch_id' 	=> $dID,
			'type' 			=> "5",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> addslashes($_POST['fRemarks']),
			'status' 		=> "",
			'reciever' 		=> $_POST['fofficial'],
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$insertReceiptAction = $generalClass->saveData(TBL_DACTION, $data);
		$rValue = explode("-", $insertReceiptAction);
		$addVA = $rValue['0'];
		$newID = $rValue['1'];

		if($addVA){
			$user = $_POST['fofficial'];
			$notifyData = array(
				'route' 		=> "ods",
				'action' 		=> "dLetterAction.php",
				'key' 			=> $dID,
				'user' 			=> $user,
				'flag' 			=> "0",
				'remarks' 		=> addslashes($_POST['fRemarks']),
				'author' 		=> $author,
				'created' 		=> $today,
				'modified' 		=> $today
			);
			$insertNotification = $generalClass->saveData(TBL_NOTIFY, $notifyData);

			$userName = $generalClass->getColumn('name', TBL_USER, $user);

			$userMobile = $generalClass->getColumn('mobile', TBL_USER, $user);
			//$sendSMS = $generalClass->sendSMS($userMobile, DR_COPY);

			$_SESSION['message'] = "Dispatch copy shared to $userName successfully.";
			$_SESSION['type'] = "success";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
			header("Location: $url");
		}else{
			$_SESSION['message'] = "Error sending dispatch copy to $userName. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
			header("Location: $url");
		}
	}
	
	if(isset($_POST['forwardDispactchToAll'])){
		$dID = $_POST['disID'];
		$data = array(
			'dispatch_id' 	=> $dID,
			'type' 			=> "6",
			'filepath' 		=> "",
			'file_name'		=> "",
			'remarks' 		=> addslashes($_POST['fRemarks']),
			'status' 		=> "",
			'reciever' 		=> "",
			'author' 		=> $author,
			'created' 		=> $today,
			'modified' 		=> $today
		);

		$insertReceiptAction = $generalClass->saveData(TBL_DACTION, $data);
		$rValue = explode("-", $insertReceiptAction);
		$addVA = $rValue['0'];
		$newID = $rValue['1'];

		$allUsers = $generalClass->getAll(TBL_USER);

		if($addVA){
			foreach($allUsers as $hqUsers){
				$officeLocation = $hqUsers['office'];
				$official = $hqUsers['id'];
				$officialMobile = $hqUsers['mobile'];
				
				
				$notifyData = array(
					'route' 		=> "ods",
					'action' 		=> "dLetterAction.php",
					'key' 			=> $dID,
					'user' 			=> $official,
					'flag' 			=> "0",
					'remarks' 		=> addslashes($_POST['fRemarks']),
					'author' 		=> $author,
					'created' 		=> $today,
					'modified' 		=> $today
				);
				$insertNotification = $generalClass->saveData(TBL_NOTIFY, $notifyData);

				//$sendSMS = $generalClass->sendSMS($officialMobile, DR_COPY);

				$_SESSION['message'] = "Dispatch copied to all employees successfully.";
				$_SESSION['type'] = "success";
				$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
				header("Location: $url");
			}
		}else{
			$_SESSION['message'] = "Error copying dispatch to all employees. Please check and try again.";
			$_SESSION['type'] = "danger";
			$url=BASE_URL.'ods/dLetterAction.php?id='.$dID;
			header("Location: $url");
		}
	}
?>