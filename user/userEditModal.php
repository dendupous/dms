<?php
	$userId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$userInfo = $generalClass->get(TBL_USER, $userId);
	foreach($userInfo as $userDtl);
?>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 col-sm-12">
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll">
		<fieldset>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Full Name</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input name="fullName" id="fullName" value="<?php echo $userDtl['name']; ?>" placeholder="Full Name" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Email</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input name="emailID" id="emailID" value="<?php echo $userDtl['email']; ?>" placeholder="Email ID" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Mobile No</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
						<input name="mobNum" id="mobNum" value="<?php echo $userDtl['mobile']; ?>" placeholder="Mobile Number" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">CID No</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
						<input name="cidNum" id="cidNum" value="<?php echo $userDtl['cid']; ?>" placeholder="CID Number" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Employee ID No</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
						<input name="empNum" id="empNum" value="<?php echo $userDtl['empid']; ?>" placeholder="Employee ID Number" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Designation</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
						<input name="designation" id="designation" value="<?php echo $userDtl['designation']; ?>" placeholder="Designation" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Office No</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input name="officePhone" id="officePhone" value="<?php echo $userDtl['office_num']; ?>" placeholder="Office Phoe Number" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Extension No</label>  
				<div class="col-sm-8 col-md-7 col-lg-8 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input name="extNum" id="extNum" value="<?php echo $userDtl['ext_num']; ?>" placeholder="Extension Number" class="form-control" type="text" required />
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Select Office</label>
				<div class="col-sm-8 col-md-7 col-lg-8 selectContainer">
					<div class="input-group">
						<span class="input-group-addon" required><i class="glyphicon glyphicon-home"></i></span>
						<select name="office" id="office" class="form-control selectpicker" required>
							<option value=" ">Select Office</option>
							<?php 
								$oDetails = $generalClass->getAll(TBL_OFFICE);
								foreach($oDetails as $oDetail):
								$selectedOffice = ($oDetail['id'] == $userDtl['office'])?'selected':'';
							?>
							<option value="<?php echo $oDetail['id']; ?>" <?php echo $selectedOffice; ?>><?php echo $oDetail['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Select Department</label>
				<div class="col-sm-8 col-md-7 col-lg-8 selectContainer">
					<div class="input-group">
						<span class="input-group-addon" required><i class="glyphicon glyphicon-home"></i></span>
						<select name="department" id="department" class="form-control selectpicker" >
							<option value=" "></option>
							<?php 
								$dDetail = $generalClass->getAll(TBL_DEPT); 
								foreach($dDetail as $dDtls):
								$selected = ($dDtls['id'] == $userDtl['department'])?"selected":"";
							?>
							<option value="<?php echo $dDtls['id']; ?>"<?php echo $selected;?>><?php echo $dDtls['name']." - ".$dDtls['description']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Select Division</label>
				<div class="col-sm-8 col-md-7 col-lg-8 selectContainer" required>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
						<select name="division" id="division" class="form-control selectpicker" >
							<option value="">Select Division</option>
							<?php 
								$dDetail = $generalClass->getAll(TBL_DIV); 
								foreach($dDetail as $dDtls):
								$selected = ($dDtls['id'] == $userDtl['division'])?"selected":"";
							?>
							<option value="<?php echo $dDtls['id']; ?>"<?php echo $selected;?>><?php echo $dDtls['name']." - ".$dDtls['description']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Select Section</label>
				<div class="col-sm-8 col-md-7 col-lg-8 selectContainer" required>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						<select name="section" id="section" class="form-control selectpicker" >
							<option value="">Select Section</option>
							<?php 
								$dDetail = $generalClass->getAll(TBL_SEC); 
								foreach($dDetail as $dDtls):
								$selected = ($dDtls['id'] == $userDtl['section'])?"selected":"";
							?>
							<option value="<?php echo $dDtls['id']; ?>"<?php echo $selected;?>><?php echo $dDtls['name']." - ".$dDtls['description']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-4 col-md-5 col-lg-3 control-label">Assign Roles</label>
				<div class="col-sm-8 col-md-7 col-lg-8 selectContainer" required>
					<div class="input-group">
						<?php 
							$rDetail = $generalClass->getAll(TBL_ROLE); 
							$rolesAssigned = explode(',', $userDtl['role']);
							foreach($rDetail as $rDtls):
								$checked = (in_array($rDtls['id'], $rolesAssigned))?'checked':'';
						?>
						<label class="inline col-lg-6">
							<input type="checkbox" id="id-toggle-<?php echo $rDtls['id'];?>" name="uRoles[]" value="<?php echo $rDtls['id'];?>" class="ace" <?php echo $checked;?> />
							<span class="lbl"><?php echo " ".$rDtls['role'];?></span>
						</label>
						<?php endforeach; ?>
						
						
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-4 col-md-5 col-lg-3 control-label"></label>
				<div class="col-sm-8 col-md-7 col-lg-8">
					<div class="pull-right">
						<input type="hidden" name="userEditID" value="<?php echo $userDtl['id']; ?>">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<button type="submit" class="btn btn-success" name="editUser">Edit User <span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$('#office').change(function() { 	
		$('#department').load("../system/selectDepartment.php?choice="+ $('#office').val(), function() {
			$('#department').trigger('chosen:updated');
		});
	});
	
	$('#department').change(function() { 	
		$('#division').load("../system/selectDivision.php?choice="+ $('#department').val(), function() {
			$('#division').trigger('chosen:updated');
		});
	});
	
	$('#division').change(function() { 	
		$('#section').load("../system/selectSection.php?choice="+ $('#division').val(), function() {
			$('#section').trigger('chosen:updated');
		});
	});

	$(document).ready(function () {
		var validator = $("#genericFormForAll").bootstrapValidator({
			framework: 'bootstrap',
			excluded: ':disabled',
			message: 'Please enter a value.',
			fields : {
				fullName :{
					validators : {
						notEmpty : {
							message : "Please enter fullname."
						}
					}
				},
				emailID :{
					validators : {
						notEmpty : {
							message : "Please enter Email ID."
						},
						emailAddress: {
							message: 'The value is not a valid email address.'
						},
					}
				},
				mobNum :{
					validators : {
						notEmpty : {
							message : "Please enter Mobile No."
						},
						integer: {
							message: 'Mobile No. must be integer.'
						},
						stringLength: {
							min: 8,
							max: 8,
							message: 'Mobile No. must be 8 digit.'
						},
					}
				},
				cidNum :{
					validators : {
						notEmpty : {
							message : "Please enter CID No."
						},
						integer: {
							message: 'CID No. must be integer.'
						},
						stringLength: {
							min: 11,
							max: 11,
							message: 'CID No. must be 11 digit.'
						},
					}
				},
				empNum :{
					validators : {
						notEmpty : {
							message : "Please enter Emp. ID No."
						}
					}
				},
				designation :{
					validators : {
						notEmpty : {
							message : "Please enter Designation."
						}
					}
				},
				department :{
					validators : {
						notEmpty : {
							message : "Please select Department."
						}
					}
				},
				division :{
					validators : {
						notEmpty : {
							message : "Please select Division."
						}
					}
				},
				section :{
					validators : {
						notEmpty : {
							message : "Please select Section."
						}
					}
				},
				uRole :{
					validators : {
						notEmpty : {
							message : "Please select Role."
						}
					}
				},
			}
		});				
	});
</script>