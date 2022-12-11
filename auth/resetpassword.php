<?php
	include('../includes/config.php');
	if(!empty($_SESSION['id'])){
		$session_uid = $_SESSION['id'];
		$url = BASE_URL.'main/';
		header("Location: $url");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>National Land Commission Secretariat Systems</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
		<link href="../css/login.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../js/notify/animate.css" />
		<link rel="shortcut icon" href="../images/dms.png" type="image">
	</head>

	<body class="login_background">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-sm-0 col-xs-0"></div>
				<div class="col-lg-8 col-sm-12 col-xs-12">
					<div class="login_wrapper">
						<div class="login_header">
							<div id="nlcs_logo_header" class="text-center img-responsive"><img src="../images/dms_logo.png"></div>
							<div id="nlcs_login_header" class="text-center"><h2></h2></div>
						</div>
						<div class="login_form_wrapper">
						<form class="form-horizontal" action="../includes/process.php" method="post" id="loginForm">
							<div class="form-group">
								<div class="col-md-12  inputGroupContainer">
									<div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  id="userNameInput" name="userNameInput" placeholder="Enter your Mobile Number" class="form-control"  type="text">
								</div>
								</div>
							</div>
							<!-- Button -->
							<div class="form-group">
								<div class="col-md-12">
									<button type="submit" name="resetPassword" class="btn btn-warning btn-block" >Reset Password <span class="glyphicon glyphicon-lock"></span></button>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="right"><a href="index.php">Back to Login?</a></div>
								</div>
							</div>
							
						</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-0 col-xs-0"></div>
			</div>
		</div>
		
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/bootstrapvalidator.min.js"></script>

		<script src="../js/notify/bootstrap-notify.js"></script>
		
		<script type="text/javascript">
			<?php 
				$message = $_SESSION['message'];
				$type = $_SESSION['type'];
				
				if(!empty($message) && isset($message)):
			?>
				$.notify({
					// options
					message: '<?php echo $message; ?>', 
				},{
					// settings
					type: '<?php echo $type; ?>',
					animate: {
						enter: 'animated fadeInDown',
						exit: 'animated fadeOutUp'
					},
				});
			<?php 
				$_SESSION['message'] = '';
				$_SESSION['type'] = '';
				endif; 
			?>
		
			$(document).ready(function() {
				$('#loginForm').bootstrapValidator({
					// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						userNameInput: {
							validators: {
								notEmpty: {
									message: 'Please enter your mobile number.'
								}
							}
						},
					}
				})
				.on('success.form.bv', function(e) {
					$('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
						$('#loginForm').data('bootstrapValidator').resetForm();

					// Prevent form submission
					e.preventDefault();
 
					// Get the form instance
					var $form = $(e.target);

					// Get the BootstrapValidator instance
					var bv = $form.data('bootstrapValidator');

				});
			});
		</script>
	</body>
</html>
