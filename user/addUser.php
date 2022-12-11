	
	<?php include("../inc/header.php"); ?>
		
		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
					
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> Add New User </small></h1>
						</div><!-- /.page-header -->
						<?php
							$uRoles = explode(',', $userDetails->role);
							if(in_array(4, $uRoles)){
						?>
						<!-- PAGE CONTENT BEGINS -->
						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll">
									<fieldset>
										<legend>Add New User</legend>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Full Name</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
													<input name="fullName" id="fullName" placeholder="Full Name" class="form-control" type="text" required />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Email</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
													<input name="emailID" id="emailID" placeholder="Email ID" class="form-control" type="text" required />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Mobile No</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
													<input name="mobNum" id="mobNum" placeholder="Mobile Number" class="form-control" type="text" required />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">CID No</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
													<input name="cidNum" id="cidNum" placeholder="CID Number" class="form-control" type="text" required />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Employee ID No</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
													<input name="empNum" id="empNum" placeholder="Employee ID Number" class="form-control" type="text" required />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Designation</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
													<input name="designation" id="designation" placeholder="Designation" class="form-control" type="text" required />
												</div>
											</div>
										</div>
										<div class="form-group"> 
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Select Office</label>
											<div class="col-sm-9 col-md-6 col-lg-4 selectContainer">
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
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Select Department</label>
											<div class="col-sm-9 col-md-6 col-lg-4 selectContainer">
												<div class="input-group">
													<span class="input-group-addon" required><i class="glyphicon glyphicon-home"></i></span>
													<select name="department" id="department" class="form-control selectpicker" required>
														<option value=" ">Select Department</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group"> 
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Select Division</label>
											<div class="col-sm-9 col-md-6 col-lg-4 selectContainer">
												<div class="input-group">
													<span class="input-group-addon" required><i class="glyphicon glyphicon-home"></i></span>
													<select name="division" id="division" class="form-control selectpicker" required>
														<option value=" ">Select Division</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group"> 
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Select Section</label>
											<div class="col-sm-9 col-md-6 col-lg-4 selectContainer">
												<div class="input-group">
													<span class="input-group-addon" required><i class="glyphicon glyphicon-home"></i></span>
													<select name="section" id="section" class="form-control selectpicker" required>
														<option value=" ">Select Section</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Office No.</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
													<input name="officePhone" id="officePhone" placeholder="office Phone No." class="form-control" type="text" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Extension No.</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
													<input name="extNum" id="extNum" placeholder="Extension Number" class="form-control" type="text" />
												</div>
											</div>
										</div>
										<div class="form-group"> 
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Assign Roles</label>
											<div class="col-sm-7 col-md-6 col-lg-4 selectContainer">
												<div class="input-group">
													<?php 
														$rDetail = $generalClass->getAll(TBL_ROLE); 
														foreach($rDetail as $rDtls):
													?>
													<label class="inline col-lg-6">
														<input type="checkbox" id="id-toggle-<?php echo $rDtls['id'];?>" name="uRoles[]" value="<?php echo $rDtls['id'];?>" class="ace" />
														<span class="lbl"><?php echo " ".$rDtls['role'];?></span>
													</label>
													<?php endforeach; ?>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label">Password</label>  
											<div class="col-sm-7 col-md-6 col-lg-4 inputGroupContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
													<input name="password" id="password" placeholder="Password" class="form-control" type="text" required onkeydown="return (event.keyCode!=13);"/>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-4 col-lg-2 control-label"></label>
											<div class="col-sm-7 col-md-6 col-lg-4">
												<button type="reset" class="btn btn-default" >Reset <span class="glyphicon glyphicon-refresh"></span></button>
												<button type="submit" class="btn btn-success" name="addNewUser">Add User <span class="glyphicon glyphicon-ok"></span></button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
						<?php } else {?>
						<div class="alert alert-danger">
							You don't have permission to create new user.
						</div>
						<a href="javascript:history.back()" class="btn btn-grey"><i class="ace-icon fa fa-arrow-left"></i> Go Back</a>
						<?php }?>
					</div>
				</div>
			</div><!-- /.main-content -->
		<!-- /.ends in footer-->
		<?php include("../inc/inc_footer.php"); ?>
		<!-- inline scripts related to this page -->
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
								remote: {
									url: 'checkMail.php',
									type: 'POST',
									data: function(validator) {
									   return {
										   mailID: $('[name="emailID"]').val(),
									   };
									},
									message: 'This Email ID is already used. Please contact Admin.',
								}
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
								remote: {
									url: 'checkMobile.php',
									type: 'POST',
									data: function(validator) {
									   return {
										   mobNo: $('[name="mobNum"]').val(),
									   };
									},
									message: 'This Mobile No. is already used. Please contact Admin.',
								}
								
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
						password :{
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
		<script src="../assets/formValidate/bootstrapValidator.js"></script>
	<?php include("../inc/footer.php"); ?>
