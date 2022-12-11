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
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group"> 
				<input type="file" name="userPhotoUpload" id="userPhotoUpload" class="btn btn-primary" required/>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label"></label>
				<div class="col-sm-9 col-md-8 col-lg-10">
					<div class="pull-right">
						<input type="hidden" name="userPhotoID" value="<?php echo $id; ?>">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<button type="submit" class="btn btn-success" name="changeUserPhoto">Change Photo <span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$(document).ready(function () {
		var validator = $("#genericFormForAll").bootstrapValidator({
			framework: 'bootstrap',
			excluded: ':disabled',
			message: 'Please select photo.',
			fields : {
				userPhotoUpload :{
					validators : {
						file : {
							extension: 'jpg, png',
							type: 'image/jpeg,image/png',
							message : "Please select JPEG or PNG File."
						},
					}
				},
			}
		});				
	});
</script>