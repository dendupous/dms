<?php	
	include('../includes/config.php');
	include('../includes/session.php');
?>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 col-sm-12">
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll">
		<fieldset>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Select Office</label>
				<div class="col-sm-9 col-md-7 col-lg-9 selectContainer">
					<div class="input-group">
						<span class="input-group-addon" required><i class="glyphicon glyphicon-home"></i></span>
						<select name="office" id="office" class="form-control selectpicker" required>
							<option value=" ">Select Office</option>
							<?php 
								$oDetails = $generalClass->getAll(TBL_OFFICE);
								foreach($oDetails as $oDetail):
							?>
							<option value="<?php echo $oDetail['id']; ?>"><?php echo $oDetail['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Department Name</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input name="department" id="department" placeholder="Department Name" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Department Description</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<input name="ddesc" id="ddesc" placeholder="Department Description" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-5 col-lg-3 control-label"></label>
				<div class="col-sm-9 col-md-7 col-lg-9">
					<div class="pull-right">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<button type="submit" class="btn btn-success" name="addNewDept">Add Dept <span class="glyphicon glyphicon-ok"></span></button>
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