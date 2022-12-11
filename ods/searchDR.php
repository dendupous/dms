	
	<?php include("../inc/header.php"); ?>

		<?php

			if(isset($_POST['searchDispatchReceipt'])){
				$option = $_POST['drselect'];
				$drNumber = $_POST['dr_number'];
				if(strlen($drNumber) == 6){
					$drNumber = $_POST['dr_number'];
				}else if(strlen($drNumber) == 5){
					$drNumber = '0'.$_POST['dr_number'];
				}else if(strlen($drNumber) == 4){
					$drNumber = '00'.$_POST['dr_number'];
				}else if(strlen($drNumber) == 3){
					$drNumber = '000'.$_POST['dr_number'];
				}else if(strlen($drNumber) == 2){
					$drNumber = '0000'.$_POST['dr_number'];
				}else if(strlen($drNumber) == 1){
					$drNumber = '00000'.$_POST['dr_number'];
				}
				$year = $_POST['year'];
				
				$valuesR = array(
					'selectedOption'=> $option,
					'dr_Num'		=> $drNumber,
					'year'			=> $year,
				);
				
				if($option == 1){
					$dDetials = $generalClass->getDispatchedLetter($drNumber, $year);
				}  
				if($option == 2){
					$dDetials = $generalClass->getRecievedLetter($drNumber, $year);
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
							<h1>Online Dispatch System<small><i class="ace-icon fa fa-angle-double-right"></i> Search Dispatch or Receipt Letters by Dak Number </small></h1>
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
													<label class="control-label" for="transaction_status"> Dispatch/Receipt Number</label>
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
										<?php if(sizeof($dDetials) > 1): ?>
											<?php if($valuesR['selectedOption'] == 1): ?>
												<div class="widget-box transparent">
													<div class="widget-header widget-header-flat">
														<h4 class="widget-title lighter">
															<i class="ace-icon fa fa-home green"></i> <b>From Details (Source)</b>
														</h4>
													</div>
													<div class="widget-body">
														<div class="widget-main no-padding">
															<div>
																<ul class="list-unstyled spaced">
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_OFFICE, $dDetials['fOffice']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_OFFICE, $dDetials['fOffice']); ?>
																	</li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_DEPT, $dDetials['fDept']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_DEPT, $dDetials['fDept']); ?>
																	</li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_DIV, $dDetials['fDiv']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_DIV, $dDetials['fDiv']); ?>
																	</li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Section :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_SEC, $dDetials['fSec']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_SEC, $dDetials['fSec']); ?>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												
												<div class="widget-box transparent">
													<div class="widget-header widget-header-flat">
														<h4 class="widget-title lighter">
															<i class="ace-icon fa fa-bank orange"></i> <b>To Details (Destination)</b>
														</h4>
													</div>
													<div class="widget-body">
														<div class="widget-main no-padding">
															<div>
																<ul class="list-unstyled spaced">
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> <?php echo $dDetials['rOffice']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> <?php echo $dDetials['rDept']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> <?php echo $dDetials['rDiv']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Place :</b> <?php echo $dDetials['rPlace']; ?></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												
												<div class="widget-box transparent">
													<div class="widget-header widget-header-flat">
														<h4 class="widget-title lighter">
															<i class="ace-icon fa fa-bullseye"></i>
															<b>Letter Details</b>
														</h4>
													</div>

													<div class="widget-body">
														<div class="widget-main padding-4">
															<div>
																<ul class="list-unstyled spaced">
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Addressed To :</b> <?php echo $dDetials['adressedTo']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Subject :</b> <?php echo $dDetials['rSubject']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Reference Number :</b> <?php echo $dDetials['rRefNum']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Copy To :</b> <?php echo $dDetials['rCopyTo']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Dak Number :</b> <?php echo $dDetials['dispatchNum']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Date of Dispatch :</b> <?php date('jS F Y', strtotime($dDetials['dateOfIssue'])); ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Time of Dispatch :</b> <?php echo date('h:i A', strtotime($dDetials['timeOfIssue'])); ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Fiscal Year :</b> <?php echo $dDetials['fiscalYear']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Copy :</b> 
																		<?php
																			$day = date('d', strtotime($dDetials['dateOfIssue']));
																			$month = date('m', strtotime($dDetials['dateOfIssue']));
																			$year = date('Y', strtotime($dDetials['dateOfIssue']));
																			$folderName = $year.$month.$day;
																			$directoryPath = '../uploads/dispatchedLetter/'.$folderName."/";
																		?>
																		<a href="../uploads/download.php?file=<?php echo $dDetials['filePath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue" title="Download File"><i class="ace-icon fa fa-download blue"></i> DOWNLOAD FILE</a>	
																		&nbsp;&nbsp;&nbsp;<a href="<?php echo $directoryPath.$dDetials['filePath']; ?>" target="_blank" class="blue" title="View File"><i class="ace-icon fa fa-eye blue"></i> VIEW FILE</a>	
																		&nbsp;&nbsp;&nbsp;<a href="<?php echo BASE_URL.'ods/dLetterAction.php?id='.$dDetials['id'];?>" target="_blank" class="blue" title="View Detail"><i class="ace-icon fa fa-eye orange"></i> VIEW DETAIL</a>	
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												<hr class="hr-double">
											<?php endif; ?>	
											<?php if($valuesR['selectedOption'] == 2): ?>
												<div class="widget-box transparent">
													<div class="widget-header widget-header-flat">
														<h4 class="widget-title lighter">
															<i class="ace-icon fa fa-home green"></i> <b>From Details (Destination)</b>
														</h4>
													</div>
													<div class="widget-body">
														<div class="widget-main no-padding">
															<div>
																<ul class="list-unstyled spaced">
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> <?php echo $dDetials['fOffice']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> <?php echo $dDetials['fDept']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> <?php echo $dDetials['fDiv']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Place :</b> <?php echo $dDetials['fPlace']; ?></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												
												<div class="widget-box transparent">
													<div class="widget-header widget-header-flat">
														<h4 class="widget-title lighter">
															<i class="ace-icon fa fa-bank orange"></i> <b>To Details (Source)</b>
														</h4>
													</div>
													<div class="widget-body">
														<div class="widget-main no-padding">
															<div>
																<ul class="list-unstyled spaced">
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_OFFICE, $dDetials['rOffice']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_OFFICE, $dDetials['rOffice']); ?>
																	</li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_DEPT, $dDetials['rDept']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_DEPT, $dDetials['rDept']); ?>
																	</li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_DIV, $dDetials['rDiv']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_DIV, $dDetials['rDiv']); ?>
																	</li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Section :</b> 
																		<?php echo $generalClass->getColumn('name', TBL_SEC, $dDetials['rSec']); ?> - 
																		<?php echo $generalClass->getColumn('description', TBL_SEC, $dDetials['rSec']); ?>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												
												<div class="widget-box transparent">
													<div class="widget-header widget-header-flat">
														<h4 class="widget-title lighter">
															<i class="ace-icon fa fa-bullseye"></i>
															<b>Letter Details</b>
														</h4>
													</div>

													<div class="widget-body">
														<div class="widget-main padding-4">
															<div>
																<ul class="list-unstyled spaced">
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Addressed To :</b> <?php echo $dDetials['addressedTo']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Subject :</b> <?php echo $dDetials['fSubject']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Reference Number :</b> <?php echo $dDetials['fRefNum']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Copy To :</b> <?php echo $dDetials['fCopyTo']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Dak Number :</b> <?php echo $dDetials['recieptNum']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Date of Dispatch :</b> <?php echo date('jS F Y', strtotime($dDetials['dateOfReciept'])); ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Time of Dispatch :</b> <?php echo date('h:i A', strtotime($dDetials['timeOfReciept'])); ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Fiscal Year :</b> <?php echo $dDetials['fiscalYear']; ?></li>
																	<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Copy :</b> 
																		<?php
																			$day = date('d', strtotime($dDetials['dateOfReciept']));
																			$month = date('m', strtotime($dDetials['dateOfReciept']));
																			$year = date('Y', strtotime($dDetials['dateOfReciept']));
																			$folderName = $year.$month.$day;
																			$directoryPath = '../uploads/receiptLetter/'.$folderName."/";
																		?>
																		<a href="../uploads/download.php?file=<?php echo $dDetials['filePath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue" title="Download File"><i class="ace-icon fa fa-download blue"></i> DOWNLOAD FILE</a>	
																		&nbsp;&nbsp;&nbsp;<a href="<?php echo $directoryPath.$dDetials['filePath']; ?>" target="_blank" class="blue" title="View File"><i class="ace-icon fa fa-eye blue"></i> VIEW FILE</a>	
																		&nbsp;&nbsp;&nbsp;<a href="rLetterAction.php?id=<?php echo $dDetials['id']; ?>" target="_blank" class="blue" title="View Details"><i class="ace-icon fa fa-plus blue"></i> VIEW DETAILS</a>	
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												<hr class="hr-double">
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
									message : "Please enter Dispatch/Receipt Number."
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