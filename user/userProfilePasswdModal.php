<?php
	$userId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$userInfo = $generalClass->get(TBL_USER, $userId);
	foreach($userInfo as $uDtls); extract($uDtls);
?>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 col-sm-12">
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="userAddForm">
		<fieldset>
			<div class="form-group">
				<label class="col-sm-3 col-md-4 col-lg-2 control-label">New Password</label>  
				<div class="col-sm-9 col-md-8 col-lg-10 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input name="newpassword" id="newpassword" placeholder="Password" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);"/>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label"></label>
				<div class="col-sm-9 col-md-8 col-lg-10">
					<div class="pull-right">
						<input type="hidden" name="userPassID" value="<?php echo $id; ?>">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<button type="submit" class="btn btn-success" name="changeUserProfilePassword">Change Password <span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$(document).ready(function () {
		var validator = $("#userAddForm").bootstrapValidator({
			framework: 'bootstrap',
			excluded: ':disabled',
			message: 'Please enter a value.',
			fields : {
				newpassword :{
					validators : {
						notEmpty : {
							message : "Please enter new Password."
						},
						callback: {
							message: 'Passowrd must be minium of 8 characters',
							callback: function(value, validator, $field){
								return value.length >= 8;
							}
						},
					}
				},
			}
		});				
	});
</script>