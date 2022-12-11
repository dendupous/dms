<?php
	$officeId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$officeInfo = $generalClass->get(TBL_OFFICE, $officeId);
	foreach($officeInfo as $officeDtls); extract($officeDtls);
?>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 col-sm-12">
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll">
		<fieldset>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Office Name</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input name="office" id="office" value="<?php echo $name; ?>" placeholder="Office Name" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Office Description</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<input name="office_desc" id="office_desc" value="<?php echo $description; ?>" placeholder="Office Description" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-5 col-lg-3 control-label"></label>
				<div class="col-sm-9 col-md-7 col-lg-9">
					<div class="pull-right">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<input type="hidden" name="deptOfficeID" value="<?php echo $id; ?>">
						<button type="submit" class="btn btn-success" name="editOffice">Edit Office <span class="glyphicon glyphicon-ok"></span></button>
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