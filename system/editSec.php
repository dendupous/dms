<?php
	$secId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$secInfo = $generalClass->get(TBL_SEC, $secId);
	foreach($secInfo as $secDtl); 
	$deptId = $generalClass->getColumn('department', TBL_DIV, $secDtl['division']);
	$officeId = $generalClass->getColumn('office', TBL_DEPT, $deptId);	
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
								$selectedOffice = ($officeId == $oDetail['id'])?'selected':'';
							?>
							<option value="<?php echo $oDetail['id']; ?>" <?php echo $selectedOffice; ?>><?php echo $oDetail['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Select Department</label>
				<div class="col-sm-9 col-md-7 col-lg-9 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<select name="department" id="department" class="form-control selectpicker" required>
							<option value=" ">Select Department</option>
							<?php 
								$dDetail = $generalClass->getDepartments(TBL_DEPT, $officeId); 
								foreach($dDetail as $dDtls):
								$selected = ($dDtls['id'] == $deptId)?"selected":"";
							?>
							<option value="<?php echo $dDtls['id']; ?>"<?php echo $selected; ?>><?php echo $dDtls['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Division</label>
				<div class="col-sm-9 col-md-7 col-lg-9 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<select name="division" id="division" class="form-control selectpicker" required>
							<option value=" ">Select Division</option>
							<?php 
								$dDetail = $generalClass->getDivisions(TBL_DIV, $deptId); 
								foreach($dDetail as $dDtls):
								$selected = ($dDtls['id'] == $secDtl['division'])?"selected":"";
							?>
							<option value="<?php echo $dDtls['id']; ?>"<?php echo $selected; ?>><?php echo $dDtls['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Section Name</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input name="section" id="section" value="<?php echo $secDtl['name']; ?>" placeholder="Section Name" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-5 col-lg-3 control-label">Section Description</label>  
				<div class="col-sm-9 col-md-7 col-lg-9 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<input name="sdesc" id="sdesc" value="<?php echo $secDtl['description']; ?>" placeholder="Section Description" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);" />
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-5 col-lg-3 control-label"></label>
				<div class="col-sm-9 col-md-7 col-lg-9">
					<div class="pull-right">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<input type="hidden" name="secEditID" value="<?php echo $secDtl['id']; ?>">
						<button type="submit" class="btn btn-success" name="editSec">Edit Section <span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$('#office').change(function() { 	
		$('#department').load("selectDepartment.php?choice="+ $('#office').val(), function() {
			$('#department').trigger('chosen:updated');
		});
	});
	
	$('#department').change(function() { 	
		$('#division').load("selectDivision.php?choice="+ $('#department').val(), function() {
			$('#division').trigger('chosen:updated');
		});
	});
	
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
							message : "Please select department."
						}
					}
				},
				division :{
					validators : {
						notEmpty : {
							message : "Please select division."
						}
					}
				},
				section :{
					validators : {
						notEmpty : {
							message : "Please enter section name."
						}
					}
				},
				sdesc :{
					validators : {
						notEmpty : {
							message : "Please enter section description."
						}
					}
				},
			}
		});				
	});
</script>