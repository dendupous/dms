	
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
				
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dispatch<small><i class="ace-icon fa fa-angle-double-right"></i> Dispatch Official Letters</small></h1>
						</div><!-- /.page-header -->
						<?php
							$year = date('Y');
							$drNumber = $generalClass->getDispatchNum('dr_num', $year, 1); 
							$officeId = $generalClass->getColumn('office', TBL_USER, $userDetails->id); 
						?>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll" enctype="multipart/form-data">
										<div class="col-xs-12 col-md-6 col-lg-6">
										<fieldset>
											<legend>From Address</legend>
											<input type="hidden" name="oname" id="oname" value="<?php echo $officeId; ?>" class="form-control" readonly="true"/>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Department</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon" required><i class="ace-icon fa fa-home"></i></span>
														<select name="adepartment" id="adepartment" class="form-control selectpicker" required>
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
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Division</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-th-large"></i></span>
														<select name="adivision" id="adivision" class="form-control selectpicker" required>
															<option value="">Select Division</option>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Section</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-th"></i></span>
														<select name="asection" id="asection" class="form-control selectpicker" required>
															<option value="">Select Section</option>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Fiscal Year</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<?php
															$year = date("Y");
															$month = date("m");
															if($month < 6):
																$pre_year = $year - 1;
																$fiscal_year = $pre_year.'-'.$year;
															else:
																$next_year = $year + 1;
																$fiscal_year = $year.'-'.$next_year;
															endif;
														?>
														<span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
														<input type="text" name="fyear" id="fyear" value="<?php echo $fiscal_year; ?>" class="form-control" readonly="true" />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Dispatch Number</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-sort-numeric-asc"></i></span>
														<input type="text" name="dnumber" id="dnumber" value="<?php echo $drNumber+1; ?>" class="form-control" readonly="true" />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Date of Issue</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-calendar-check-o"></i></span>
														<input data-date-format="yyyy-mm-dd" type="text" name="adate" id="adate" placeholder="Select date of Dispatch." class="form-control date-picker" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Time</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-clock-o"></i></span>
														<input type="text" name="atime" id="atime" placeholder="Select appointment time." class="form-control" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Letter Copy</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-file-pdf-o"></i></span>
														<input type="file" name="letterCopy" id="letterCopy" class="btn btn-primary" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Rack Number</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-square"></i></span>
														<input type="text" name="racknum" id="racknum" placeholder="Rack Number" class="form-control" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">File Number</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-file-pdf-o"></i></span>
														<input type="text" name="filenum" id="filenum" placeholder="File Number" class="form-control" required />
													</div>
												</div>
											</div>
										</fieldset>
										</div>
										<div class="col-xs-12 col-md-6 col-lg-6">
										<fieldset>
											<legend>Recipient Address</legend>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Address To</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-envelope-open"></i></span>
														<input type="text" name="address" id="address" placeholder="Letter is Addressed to" class="form-control" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Ministry/Agency/Office</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-home"></i></span>
														<input type="text" name="doffice" id="doffice" placeholder="Name of Ministry/Agency/Office" class="form-control" />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Dept/Agency/Office</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-th-large"></i></span>
														<input type="text" name="dodept" id="dodept" placeholder="Name of Dept/Agency/Office" class="form-control" />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Division/Agency/Office</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-th"></i></span>
														<input type="text" name="dodivision" id="dodivision" placeholder="Name of Division/Agency/Office" class="form-control" />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Destination (Place)</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-map-marker"></i></span>
														<input type="text" name="doplace" id="doplace" placeholder="Place" class="form-control" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Subject of Letter</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-pencil-square-o"></i></span>
														<input type="text" name="subject" id="subject" placeholder="Subject." class="form-control" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Reference Number</label>
												<div class="col-sm-6 col-md-7 col-lg-8 selectContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-file-text-o"></i></span>
														<input type="text" name="refNum" id="refNum" placeholder="Reference Number." class="form-control" required />
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-6 col-md-5 col-lg-3 control-label">Copy To</label>  
												<div class="col-sm-6 col-md-7 col-lg-8 inputGroupContainer">
													<div class="input-group">
														<span class="input-group-addon"><i class="ace-icon fa fa-copy"></i></span>
														<input type="text" name="copyTo" id="copyTo" placeholder="Copy To" class="form-control" required />
													</div>
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-sm-6 col-md-5 col-lg-3 control-label"></label>
												<div class="col-sm-6 col-md-7 col-lg-8">
													<div class="pull-right">
														<a href="javascript:history.back()" class="btn btn-grey"><i class="ace-icon fa fa-arrow-left"></i> Go Back</a>
														<button type="submit" class="btn btn-success" name="dispatchLetter">Dispatch Letter <span class="glyphicon glyphicon-ok"></span></button>
													</div>
												</div>
											</div>
										</fieldset>
										</div>
										<div class="clearfix"></div>
										<hr class="hr-dotted"/>
									</form>
								</div><!-- /.row -->
							</div><!-- /.row -->
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		
		<!-- /.ends in footer-->
		<?php include("../inc/inc_footer.php"); ?>
		
		<!--// Form Validation -->
		<script src="../assets/formValidate/bootstrapValidator.js"></script>
		
		<!--// date and time picker -->
		<script src="../assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js//bootstrap-timepicker.min.js"></script>
		
		<script type="text/javascript">
			$('#adepartment').change(function() { 	
				$('#adivision').load("../system/selectDivision.php?choice="+ $('#adepartment').val(), function() {
					$('#adivision').trigger('chosen:updated');
				});
			});
			
			$('#adivision').change(function() { 	
				$('#asection').load("../system/selectSection.php?choice="+ $('#adivision').val(), function() {
					$('#asection').trigger('chosen:updated');
				});
			});
			
			$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			});
			
			$('#atime').timepicker({
				minuteStep: 1,
				showSeconds: false,
				showMeridian: true
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
						
			$(document).ready(function () {
				var validator = $("#genericFormForAll").bootstrapValidator({
					framework: 'bootstrap',
					excluded: ':disabled',
					fields : {
						adepartment :{
							validators : {
								notEmpty : {
									message : "Please select Department."
								}
							}
						},
						adivision :{
							validators : {
								notEmpty : {
									message : "Please select Division."
								}
							}
						},
						asection :{
							validators : {
								notEmpty : {
									message : "Please select Section."
								}
							}
						},
						fyear :{
							validators : {
								notEmpty : {
									message : "Please enter fiscal year."
								}
							}
						},
						adate :{
							validators : {
								notEmpty : {
									message : "Please select the dispatch date."
								}
							}
						},
						atime :{
							validators : {
								notEmpty : {
									message : "Please select the appointment time."
								}
							}
						},
						address :{
							validators : {
								notEmpty : {
									message : "Please Enter the name of person to whom the letter is addressed."
								}
							}
						},
						doffice :{
							validators : {
								notEmpty : {
									message : "Please Enter the name of Office where the letter is sent."
								}
							}
						},
						dodept :{
							validators : {
								notEmpty : {
									message : "Please Enter the name of Dept. where the letter is sent."
								}
							}
						},
						dodivision :{
							validators : {
								notEmpty : {
									message : "Please Enter the name of division where the letter is sent."
								}
							}
						},
						doplace :{
							validators : {
								notEmpty : {
									message : "Please Enter the place where the letter is sent."
								}
							}
						},
						subject :{
							validators : {
								notEmpty : {
									message : "Please Enter the subject of the letter."
								}
							}
						},
						refNum :{
							validators : {
								notEmpty : {
									message : "Please Enter the reference number."
								}
							}
						},
						copyTo :{
							validators : {
								notEmpty : {
									message : "Please Enter the names of person to whom the letter is copied."
								}
							}
						},
						letterCopy :{
							validators : {
								notEmpty : {
									message : "Please upload scanned copy of the letter."
								}
							}
						},
					}
				});				
			});
		</script>
		
	<?php include("../inc/footer.php"); ?>