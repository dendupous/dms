<?php
	$deptId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$social = $generalClass->get(TBL_SM, $deptId);
	foreach($social as $socialDtl);
?>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 col-sm-12">
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll">
		<fieldset>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Social Media Name</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-heart"></i></span>
						<input name="smname" id="smname" placeholder="Social Media Name" value="<?php echo $socialDtl['name']; ?>" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Social Media URL</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
						<input name="smurl" id="smurl" placeholder="Social Media URL" value="<?php echo $socialDtl['link']; ?>" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Social Media Icon [<small>Eg: facebook</small>]</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
						<input name="smicon" id="smicon" placeholder="Social Media Icon [Eg: facebook]" value="<?php echo $socialDtl['icon']; ?>"class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Status</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-off"></i></span>
						<select name="smstatus" id="smstatus" class="form-control selectpicker" required>
							<option value=" " >Select Status</option>
							<option value="1" <?php echo ($socialDtl['status'] == 1)?'selected':''; ?>>Enabled</option>
							<option value="0" <?php echo ($socialDtl['status'] == 0)?'selected':''; ?>>Disabled</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-5 col-lg-3 control-label"></label>
				<div class="col-sm-9 col-md-7 col-lg-9">
					<div class="pull-right">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<input type="hidden" name="smEditID" value="<?php echo $socialDtl['id']; ?>">
						<button type="submit" class="btn btn-success" name="editSocialMedia">Edit Social Media <span class="glyphicon glyphicon-ok"></span></button>
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
			message: 'Please enter a value.',
			fields : {
				office :{
					validators : {
						notEmpty : {
							message : "Please select office for the department."
						}
					}
				},
				department :{
					validators : {
						notEmpty : {
							message : "Please enter department name."
						}
					}
				},
				ddesc :{
					validators : {
						notEmpty : {
							message : "Please enter department description."
						}
					}
				},
			}
		});				
	});
</script>