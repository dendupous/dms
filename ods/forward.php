<?php
	$recId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$recInfo = $generalClass->get(TBL_RECEIPT, $recId);
	foreach($recInfo as $recDtls); extract($recDtls);
?>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 col-sm-12">
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label">Department</label>
				<div class="col-sm-9 col-md-8 col-lg-10 selectContainer">
					<div class="input-group">
						<span class="input-group-addon" required><i class="glyphicon glyphicon-home"></i></span>
						<select name="fdepartment" id="fdepartment" class="form-control selectpicker" required>
							<option value=" ">Select Department</option>
							<?php 
								$dDetail = $generalClass->getAll(TBL_DEPT); 
								foreach($dDetail as $dDtls):
							?>
							<option value="<?php echo $dDtls['id']; ?>"><?php echo $dDtls['name']." - ".$dDtls['description']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label">Division</label>
				<div class="col-sm-9 col-md-8 col-lg-10 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
						<select name="fdivision" id="fdivision" class="form-control selectpicker" required>
							<option value="">Select Division</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label">Section</label>
				<div class="col-sm-9 col-md-8 col-lg-10 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						<select name="fsection" id="fsection" class="form-control selectpicker" required>
							<option value="">Select Section</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label">Official</label>
				<div class="col-sm-9 col-md-8 col-lg-10 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<select name="fofficial" id="fofficial" class="form-control selectpicker" required>
							<option value="">Select Official</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-4 col-lg-2 control-label">Remarks</label>  
				<div class="col-sm-9 col-md-8 col-lg-10 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
						<textarea name="fRemarks" id="fRemarks" placeholder="Write a remarks to will help the official what you are trying to request." class="form-control" required /></textarea>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label"></label>
				<div class="col-sm-9 col-md-8 col-lg-10">
					<div class="pull-right">
						<input type="hidden" name="recID" value="<?php echo $id; ?>">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<button type="submit" class="btn btn-success" name="forwardReceipt">Forward <span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$('#fdepartment').change(function() { 	
		$('#fdivision').load("../system/selectDivision.php?choice="+ $('#fdepartment').val(), function() {
			$('#fdivision').trigger('chosen:updated');
		});
	});
	
	$('#fdivision').change(function() { 	
		$('#fsection').load("../system/selectSection.php?choice="+ $('#fdivision').val(), function() {
			$('#fsection').trigger('chosen:updated');
		});
	});
	
	$('#fsection').change(function() { 			
		$('#fofficial').load("selectOfficial.php?choice="+ $('#fsection').val(), function() {
			$('#fofficial').trigger('chosen:updated');
		});
	});
	$(document).ready(function () {
		var validator = $("#genericFormForAll").bootstrapValidator({
			framework: 'bootstrap',
			excluded: ':disabled',
			fields : {
				fdepartment :{
					validators : {
						notEmpty : {
							message : "Please select Department."
						}
					}
				},
				fdivision :{
					validators : {
						notEmpty : {
							message : "Please select Division."
						}
					}
				},
				fsection :{
					validators : {
						notEmpty : {
							message : "Please select Section."
						}
					}
				},
				fofficial :{
					validators : {
						notEmpty : {
							message : "Please select Official to whom you are forwarding."
						}
					}
				},
				fRemarks :{
					validators : {
						notEmpty : {
							message : "Please Enter the remarks so that other officials will know what to do."
						}
					}
				},
			}
		});				
	});
</script>