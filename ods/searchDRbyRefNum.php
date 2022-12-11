	
	<?php include("../inc/header.php"); ?>

		<?php

			if(isset($_POST['searchDispatchReceipt'])){
				$option = $_POST['drselect'];
				$drNumber = $_POST['dr_number'];
				$year = $_POST['year'];
				
				$valuesR = array(
					'selectedOption'=> $option,
					'dr_Num'		=> $drNumber,
					'year'			=> $year,
				);
				
				if($option == 1){
					$dDetials = $generalClass->getDispatchedLetterByRef($drNumber, $year);
				}  
				if($option == 2){
					$dDetials = $generalClass->getRecievedLetterByRef($drNumber, $year);
					//echo "<pre>"; print_r($dDetials); exit;
				}
			}
		?>
	
		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
				
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Online Dispatch System<small><i class="ace-icon fa fa-angle-double-right"></i> Search Dispatch or Receipt Letters by Reference Number </small></h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<div class="row">
											<form method="post" action="<?php echo $PHP_SELF; ?>"  enctype="multipart/form-data" id="genericFormForAll">
												<div class="form-group col-sm-6 col-md-3 col-lg-2">
													<label class="control-label" for="transaction_status">Select Dispatch or Receipt</label>
													<select name="drselect" id="drselect" class="form-control selectpicker" required>
														<option value="">Select Dispatch/Receipt</option>
														<option value="1" <?php echo ($valuesR['selectedOption'] == 1)?"selected":""; ?>>Dispatch Search</option>
														<option value="2" <?php echo ($valuesR['selectedOption'] == 2)?"selected":""; ?>>Receipt Search</option>
													</select>
												</div>

												<div class="form-group  col-lg-2">
												<label class="control-label" for="transaction_status">Displatc/Receipt YEAR</label>
												<select name="year" id="year" class="form-control selectpicker" required>
													<option value=" ">Select Year</option>
														<?php 
															$year = date("Y"); 
															for($i = $year; $i>=2020; $i--){
																$selectedYear = ($valuesR['year'] == $i)?'selected':'';
														?>
															<option value="<?=$i?>" <?php echo $selectedYear; ?>><?=$i;?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-lg-3">
													<label class="control-label" for="transaction_status"> Dispatch/Receipt Reference Number</label>
													<input type="text" name="dr_number" id="dr_number" class="form-control" value="<?php echo $valuesR['dr_Num']; ?>" placeholder="Enter Dispatch/Receipt Number" onkeypress="return event.keyCode != 13;" required />
												</div>
												<div class="form-group col-sm-6 col-md-3 col-lg-3">
													<div class="space-14"></div>
													<button type="submit" name="searchDispatchReceipt" class="btn btn-sm btn-success">Search</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-xs-12">	
									<?php 
										//echo count($dDetials); 
										//echo "<pre>"; print_r($dDetials); exit; 
									?>
									<?php if (isset($valuesR['dr_Num'])): ?>
										<?php if(sizeof($dDetials) > 0): ?>
											<?php if($valuesR['selectedOption'] == 1): ?>
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>SL</th>
															<th>From</th>
															<th>To</th>
															<th>Subject</th>
															<th>Reference No</th>
															<th>Dispatch No</th>
															<th>Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php 
														$sl = 1;
														foreach($dDetials as $dDetial):
													?>
														<tr>
															<td><?php echo $sl++; ?></td>
															<td>
																<?php echo $generalClass->getColumn('name', TBL_DEPT, $dDetial['fDept']); ?>,&nbsp;
																<?php echo $generalClass->getColumn('name', TBL_DIV, $dDetial['fDiv']); ?>,&nbsp; 
																<?php echo $generalClass->getColumn('name', TBL_SEC, $dDetial['fSec']); ?>		
															</td>
															<td>
																<?php echo $dDetial['rDept'].', '.$dDetial['rDiv'].', '.$dDetial['rSec']; ?>
															</td>
															<td><?php echo $dDetial['rSubject']; ?></td>
															<td><?php echo $dDetial['rRefNum']; ?></td>
															<td><?php echo $dDetial['dispatchNum']; ?></td>
															<td><?php date('jS F Y', strtotime($dDetial['dateOfIssue'])); ?></td>
															<td>
																<a href="<?php echo BASE_URL.'ods/dLetterAction.php?id='.$dDetial['id'];?>" target="_blank" class="blue" title="View Detail"><i class="ace-icon fa fa-eye orange"></i> VIEW</a>
															</td>
														</tr>
													<?php endforeach; ?>
													</tbody>
												</table>
											<?php endif; ?>	
											<?php if($valuesR['selectedOption'] == 2): ?>
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>SL</th>
															<th>From</th>
															<th>To</th>
															<th>Subject</th>
															<th>Reference No</th>
															<th>Receipt No</th>
															<th>Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php 
														$sl = 1;
														foreach($dDetials as $dDetial):
													?>
														<tr>
															<td><?php echo $sl++; ?></td>
															<td>
																<?php echo $dDetial['fOffice'].', '.$dDetial['fDept'].', '.$dDetial['fDiv'].', '.$dDetial['fSec']; ?>
															</td>
															<td>
																<?php echo $generalClass->getColumn('name', TBL_DEPT, $dDetial['rDept']); ?>,&nbsp;
																<?php echo $generalClass->getColumn('name', TBL_DIV, $dDetial['rDiv']); ?>,&nbsp; 
																<?php echo $generalClass->getColumn('name', TBL_SEC, $dDetial['rSec']); ?>		
															</td>
															<td><?php echo $dDetial['fSubject']; ?></td>
															<td><?php echo $dDetial['fRefNum']; ?></td>
															<td><?php echo $dDetial['recieptNum']; ?></td>
															<td><?php date('jS F Y', strtotime($dDetial['dateOfReciept'])); ?></td>
															<td>
																<a href="<?php echo BASE_URL.'ods/rLetterAction.php?id='.$dDetial['id'];?>" target="_blank" class="blue" title="View Detail"><i class="ace-icon fa fa-eye orange"></i> VIEW</a>
															</td>
														</tr>
													<?php endforeach; ?>
													</tbody>
												</table>
											<?php endif; ?>
										<?php else: ?>
											<div class="alert alert-danger">
												There is no Dispatch/Receipt for the option you have selected.
											</div>
										<?php endif; ?>
									<?php else: ?>
										<div class="alert alert-info col-lg-12">
											Please select Option and Enter Dispatch/Receipt Number to Search Details.
										</div>
									<?php endif; ?>
								</div>
							</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		<!-- /.ends in footer-->
		<?php include("../inc/inc_footer.php"); ?>
		
		<!--// Form Validation -->
		<script src="../assets/formValidate/bootstrapValidator.js"></script>
		
		<!--// date and time picker -->
		<script src="../assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js//bootstrap-timepicker.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function () {
				var validator = $("#genericFormForAll").bootstrapValidator({
					framework: 'bootstrap',
					excluded: ':disabled',
					fields : {
						drselect :{
							validators : {
								notEmpty : {
									message : "Please select Dispatch or Receipt."
								}
							}
						},
						dr_number :{
							validators : {
								notEmpty : {
									message : "Please enter Dispatch/Receipt Reference Number."
								}
							}
						},
						year :{
							validators : {
								notEmpty : {
									message : "Please select year."
								}
							}
						},
					}
				});				
			});
		</script>
		
	<?php include("../inc/footer.php"); ?>