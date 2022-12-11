	
	<?php include("../inc/header.php"); ?>
	
		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
					
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> Receipt Letter Actions </small></h1>
						</div><!-- /.page-header -->

						<?php
							$lID = $_GET['id'];
							$lDetails = $generalClass->get(TBL_RECEIPT, $lID);
							
							if(sizeof($lDetails) > 0){
						?>

						<!-- PAGE CONTENT BEGINS -->
						<div class="row">
							<div class="col-xs-12">
								<div class="col-sm-5">
									<div class="widget-box transparent">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title lighter">
												<i class="ace-icon fa fa-bank orange"></i> <b>From Details (Letter Source)</b>
											</h4>
										</div>
										<div class="widget-body">
											<div class="widget-main no-padding">
												<?php
													foreach($lDetails as $lDtls); extract($lDtls);
													$uploadDate = $generalClass->getColumn('dateOfReciept', TBL_RECEIPT, $id);
													$finalDirName = date('Ymd', strtotime($uploadDate));
													$directoryPath = "../uploads/receiptLetter/".$finalDirName."/";
												?>
												<div>
													<ul class="list-unstyled spaced">
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name (Ministry/Angecy) :</b> <?php echo $fOffice; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> <?php echo $fDept; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> <?php echo $fDiv; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Place :</b> <?php echo $fPlace; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Reference Number :</b> <?php echo $fRefNum; ?></li>
													</ul>
												</div>
											</div><!-- /.widget-main -->
										</div><!-- /.widget-body -->
									</div><!-- /.widget-box -->
									<div class="widget-box transparent">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title lighter">
												<i class="ace-icon fa fa-home green"></i> <b>To Details (Destination)</b>
											</h4>
										</div>
										<div class="widget-body">
											<div class="widget-main no-padding">
												<div>
													<ul class="list-unstyled spaced">
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> 
															<?php echo $generalClass->getColumn('name', TBL_OFFICE, $rOffice); ?> - 
															<?php echo $generalClass->getColumn('description', TBL_OFFICE, $rOffice); ?>
														</li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> 
															<?php echo $generalClass->getColumn('name', TBL_DEPT, $rDept); ?> - 
															<?php echo $generalClass->getColumn('description', TBL_DEPT, $rDept); ?>
														</li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> 
															<?php echo $generalClass->getColumn('name', TBL_DIV, $rDiv); ?> - 
															<?php echo $generalClass->getColumn('description', TBL_DIV, $rDiv); ?>
														</li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Section :</b> 
															<?php echo $generalClass->getColumn('name', TBL_SEC, $rSec); ?> - 
															<?php echo $generalClass->getColumn('description', TBL_SEC, $rSec); ?>
														</li>
													</ul>
												</div>
											</div><!-- /.widget-main -->
										</div><!-- /.widget-body -->
									</div><!-- /.widget-box -->
									
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
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Addressed To :</b> <?php echo $addressedTo; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Subject :</b> <?php echo $fSubject; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Copy To :</b> <?php echo $fCopyTo; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Dak Number :</b> <?php echo $recieptNum; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Date of Receipt :</b> <?php echo $dateOfReciept; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Time of Receipt :</b> <?php echo $timeOfReciept; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Fiscal Year :</b> <?php echo $fiscalYear; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Copy :</b> <?php echo $fileName; ?>&nbsp;
															<a href="../uploads/download.php?file=<?php echo $filePath; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue" title="Download File"><i class="ace-icon fa fa-download blue"></i> DOWNLOAD FILE</a>	
															&nbsp;&nbsp;&nbsp;<a href="<?php echo $directoryPath.$filePath; ?>" target="_blank" class="blue" title="View File"><i class="ace-icon fa fa-eye blue"></i> VIEW FILE</a>	
														</li>
														<li><i class="ace-icon fa fa-caret-right blue"></i>
															<b>Upload File :</b> 
															<a href="uploadDocument.php?id=<?php echo $id; ?>" class="uploadDocumentLoad"><span class="ace-icon fa fa-upload"></span> Upload Document</a>	
														</li>
													</ul>
												</div>
											</div><!-- /.widget-main -->
										</div><!-- /.widget-body -->
									</div><!-- /.widget-box -->
									
									<div class="widget-box transparent">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title lighter">
												<i class="ace-icon fa fa-file-pdf-o red"></i>
												<b>Letter Physical Location</b>
											</h4>
										</div>

										<div class="widget-body">
											<div class="widget-main padding-4">
												<div>
													<ul class="list-unstyled spaced">
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Rack Number :</b> <?php echo $rack_number; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>File Number :</b> <?php echo $file_number; ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								<hr class="hr-double">
								</div><!-- /.col -->
								<div class="col-sm-7">
									<div class="widget-box transparent">
										<div class="modal fade" id="uploadDocumentModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Upload Document</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="uploadFileModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Upload Document</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="writeRemarkModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Write Remarks</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="changeStatusModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Change Status</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="visitorActionModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Take Action on Letter</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="forwardLoadModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Forward to Another Official</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="forwardReceiptToDivisionModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Forward to officials of a Division</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="forwardReceiptToAllModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Forward to all Official</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="setAppointmentLoadModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Set Appointment</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="visitorLoadModal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Save Reason</h3>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer"></div>
												</div>
											</div>
										</div>
									</div><!-- /.widget-box -->
									
									<div class="widget-box transparent">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title lighter">
												<i class="ace-icon fa fa-gavel red"></i>
												<b>Actions taken on the receipt letter</b>
											</h4>
											<div class="btn-group clearfix pull-right">
												<button data-toggle="dropdown" class="btn btn-success btn dropdown-toggle" aria-expanded="false">Take Action<i class="ace-icon fa fa-angle-down icon-on-right"></i></button>
												<ul class="dropdown-menu dropdown-success dropdown-menu-right">
													<li><a href="uploadFile.php?id=<?php echo $id; ?>" class="uploadFileLoad"><span class="ace-icon fa fa-paperclip"></span> Upload Document</a></li>
													<li class="divider"></li>
													<li><a href="writeRemark.php?id=<?php echo $id; ?>" class="writeRemarkLoad"><span class="ace-icon fa fa-commenting-o"></span> Write a remark</a></li>
													<li class="divider"></li>
													<li><a href="changeStatus.php?id=<?php echo $id; ?>" class="changeStatusLoad"><span class="ace-icon fa fa-signal"></span> Change Status</a></li>
													<li class="divider"></li>
													<li><a href="forward.php?id=<?php echo $id; ?>" class="forwardLoad"><span class="ace-icon fa fa-send"></span> Forward Receipt to a official</a></li>
													<li class="divider"></li>
													<li><a href="forwardReceiptToDivision.php?id=<?php echo $id; ?>" class="forwardReceiptToDivision"><span class="ace-icon fa fa-send"></span> Forward Receipt to Division</a></li>
													<li class="divider"></li>
													<li><a href="forwardReceiptToAll.php?id=<?php echo $id; ?>" class="forwardReceiptToAll"><span class="ace-icon fa fa-send"></span> Forward Receipt to All</a></li>
													
												</ul>
											</div>
										</div>
										<div class="widget-body">
											<div class="timeline-container">
												<?php
													$receiptDtls = $generalClass->getReceiptAction(TBL_RACTION, $id);
													foreach($receiptDtls as $sDtls):
														$latestDate = $sDtls['created'];
														$lDate = date('Y-m-d', strtotime($latestDate));
														$lDated = date(strtotime($lDate));
														$tDate = date('Y-m-d', strtotime($today));
														$tDated = date(strtotime($tDate));
														$check = ($tDated - $lDated);
														$days = $check/(60 * 60 * 24);
														$auhtorDetails = $generalClass->get(TBL_USER, $sDtls['author']);
														
														$newDate = date('Y-m-d', strtotime($latestDate));
														
														$dirDate = date('Ymd', strtotime($latestDate));
														$finalDirName = $dirDate;
														$directoryPath = "../uploads/receiptLetter/".$finalDirName."/";
														foreach($auhtorDetails as $auhtorDtls); 
													if($days <= 1):
														//echo $newDate."<br />";
														//echo $preDate;
														if($newDate != $preDate){
												?>
												<div class="timeline-label">
													<span class="label label-primary arrowed-in-right label-lg">
														<b>Today</b>
													</span>
												</div>
													<?php } ?>
												<div class="timeline-items">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<?php if(empty($auhtorDtls['photo'])){ $uImage = "default.jpg"; }else{ $uImage = $auhtorDtls['photo']; } ?>
															<img src="<?php echo BASE_URL.'images/user/'.$uImage; ?>" width="40" height="42" />
														</div>

														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title smaller">
																	<span class="blue"><?php echo $auhtorDtls['name']; ?></span>
																	<?php 
																		$actionTaken = $sDtls['type'];;
																		if($actionTaken == "4"){
																	?><span class="grey"> took action on Letter.</span>
																	<?php } if($actionTaken == "1"){?>
																	<span class="grey"> uploaded the document below.</span>
																	<?php } if($actionTaken == "2"){?>
																	<span class="grey"> wrote following remarks.</span>
																	<?php } if($actionTaken == "3"){?>
																	<span class="grey"> changed the status.</span>
																	<?php } if($actionTaken == "5"){?>
																	<span class="grey"> forwarded to </span><span class="blue"><?php echo $generalClass->getColumn('name', TBL_USER, $sDtls['reciever']);?>.</span>
																	<?php }?>
																	<?php if($actionTaken == "6"){?>
																	<span class="grey"> forwared the letter to all.</span>
																	<?php }?>
																</h5>

																<span class="widget-toolbar">
																	<i class="ace-icon fa fa-calendar-check-o bigger-110"></i>
																	<?php echo date('jS F Y', strtotime($sDtls['created'])); ?>
																	<i class="ace-icon fa fa-clock-o bigger-110"></i>
																	<?php echo date('H:i', strtotime($sDtls['created'])); ?>
																</span>
															</div>

															<div class="widget-body">
																<div class="widget-main">
																	<?php  if($actionTaken == "4"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																		<b class="blue">Document Attached &raquo;</b> 
																			<a href="../uploads/download.php?file=<?php echo $sDtls['filepath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue">
																				<?php echo $sDtls['file_name']; ?>
																			</a>
																		<div class="space-6"></div>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_RSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "1"){ ?>
																		<b class="blue">Document Attached &raquo;</b> 
																			<a href="../uploads/download.php?file=<?php echo $sDtls['filepath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue"><?php echo $sDtls['file_name']; ?></a>
																	<?php } ?>
																	<?php  if($actionTaken == "2"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																	<?php } ?>
																	<?php  if($actionTaken == "3"){ ?>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_RSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "5"){ ?>
																		<b class="blue">Remarks &raquo;</b> 
																		<?php echo $sDtls['remarks']; ?>
																	<?php } ?>
																	<?php  if($actionTaken == "6"){ ?>
																		<b class="blue">Forwared To All &raquo;</b> 
																		<?php echo $sDtls['remarks']; ?>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php 
													elseif($days <= 2 && $days > 1): 
														if($newDate != $preDate){
												?>
												<div class="timeline-label">
													<span class="label label-success arrowed-in-right label-lg">
														<b>Yesterday</b>
													</span>
												</div>
												<?php } ?>
												<div class="timeline-items">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<?php if(empty($auhtorDtls['photo'])){ $uImage = "default.jpg"; }else{ $uImage = $auhtorDtls['photo']; } ?>
															<img src="<?php echo BASE_URL.'images/user/'.$uImage; ?>" width="40" height="42" />
														</div>

														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title smaller">
																	<span class="blue"><?php echo $auhtorDtls['name']; ?></span>
																	<?php 
																		$actionTaken = $sDtls['type'];;
																		if($actionTaken == "4"){
																	?><span class="grey"> took action on Letter.</span>
																	<?php } if($actionTaken == "1"){?>
																	<span class="grey"> uploaded the document below.</span>
																	<?php } if($actionTaken == "2"){?>
																	<span class="grey"> wrote following remarks.</span>
																	<?php } if($actionTaken == "3"){?>
																	<span class="grey"> changed the status.</span>
																	<?php } if($actionTaken == "5"){?>
																	<span class="grey"> forwarded to </span><span class="blue"><?php echo $generalClass->getColumn('name', TBL_USER, $sDtls['reciever']);?>.</span>
																	<?php }?>
																	<?php if($actionTaken == "6"){?>
																	<span class="grey"> forwared the letter to all.</span>
																	<?php }?>
																</h5>

																<span class="widget-toolbar">
																	<i class="ace-icon fa fa-calendar-check-o bigger-110"></i>
																	<?php echo date('jS F Y', strtotime($sDtls['created'])); ?>
																	<i class="ace-icon fa fa-clock-o bigger-110"></i>
																	<?php echo date('H:i', strtotime($sDtls['created'])); ?>
																</span>
															</div>

															<div class="widget-body">
																<div class="widget-main">
																	<?php  if($actionTaken == "4"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																		<b class="blue">Document Attached &raquo;</b> 
																			<a href="../uploads/download.php?file=<?php echo $sDtls['filepath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue">
																				<?php echo $sDtls['file_name']; ?>
																			</a>
																		<div class="space-6"></div>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_RSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "1"){ ?>
																		<b class="blue">Document Attached &raquo;</b> 
																			<a href="../uploads/download.php?file=<?php echo $sDtls['filepath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue"><?php echo $sDtls['file_name']; ?></a>
																	<?php } ?>
																	<?php  if($actionTaken == "2"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																	<?php } ?>
																	<?php  if($actionTaken == "3"){ ?>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_RSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "5"){ ?>
																		<b class="blue">Remarks &raquo;</b> 
																		<?php echo $sDtls['remarks']; ?>
																	<?php } ?>
																	<?php  if($actionTaken == "6"){ ?>
																		<b class="blue">Forwared To All &raquo;</b> 
																		<?php echo $sDtls['remarks']; ?>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php 
													else: 
													if($newDate != $preDate){
												?>
												<div class="timeline-label">
													<span class="label label-warning arrowed-in-right label-lg">
														<b><?php $todayDate= date('jS F Y', strtotime($latestDate));  echo $todayDate; ?></b>
													</span>
												</div>
												<?php } ?>
												<div class="timeline-items">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<?php if(empty($auhtorDtls['photo'])){ $uImage = "default.jpg"; }else{ $uImage = $auhtorDtls['photo']; } ?>
															<img src="<?php echo BASE_URL.'images/user/'.$uImage; ?>" width="40" height="42" />
														</div>

														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title smaller">
																	<span class="blue"><?php echo $auhtorDtls['name']; ?></span>
																	<?php 
																		$actionTaken = $sDtls['type'];;
																		if($actionTaken == "4"){
																	?><span class="grey"> took action on Letter.</span>
																	<?php } if($actionTaken == "1"){?>
																	<span class="grey"> uploaded the document below.</span>
																	<?php } if($actionTaken == "2"){?>
																	<span class="grey"> wrote following remarks.</span>
																	<?php } if($actionTaken == "3"){?>
																	<span class="grey"> changed the status.</span>
																	<?php } if($actionTaken == "5"){?>
																	<span class="grey"> forwarded to </span><span class="blue"><?php echo $generalClass->getColumn('name', TBL_USER, $sDtls['reciever']);?>.</span>
																	<?php }?>
																	<?php if($actionTaken == "6"){?>
																	<span class="grey"> forwared the letter to all.</span>
																	<?php }?>
																</h5>

																<span class="widget-toolbar">
																	<i class="ace-icon fa fa-calendar-check-o bigger-110"></i>
																	<?php echo date('jS F Y', strtotime($sDtls['created'])); ?>
																	<i class="ace-icon fa fa-clock-o bigger-110"></i>
																	<?php echo date('H:i', strtotime($sDtls['created'])); ?>
																</span>
															</div>

															<div class="widget-body">
																<div class="widget-main">
																	<?php  if($actionTaken == "4"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																		<b class="blue">Document Attached &raquo;</b> 
																			<a href="../uploads/download.php?file=<?php echo $sDtls['filepath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue">
																				<?php echo $sDtls['file_name']; ?>
																			</a>
																		<div class="space-6"></div>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_RSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "1"){ ?>
																		<b class="blue">Document Attached &raquo;</b> 
																			<a href="../uploads/download.php?file=<?php echo $sDtls['filepath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue"><?php echo $sDtls['file_name']; ?></a>
																	<?php } ?>
																	<?php  if($actionTaken == "2"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																	<?php } ?>
																	<?php  if($actionTaken == "3"){ ?>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_RSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "5"){ ?>
																		<b class="blue">Remarks &raquo;</b> 
																		<?php echo $sDtls['remarks']; ?>
																	<?php } ?>
																	<?php  if($actionTaken == "6"){ ?>
																		<b class="blue">Forwared To All &raquo;</b> 
																		<?php echo $sDtls['remarks']; ?>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php endif; ?>
												<?php $preDate = date('Y-m-d',strtotime($latestDate)); endforeach;?>
											</div><!-- Timeline End -->
										</div><!-- Widget Body End -->									
									</div><!-- Widget Body End -->
								</div><!-- col -->
							</div><!-- /.row -->
						</div>
						<?php }else{ ?>
							<div class='alert alert-block alert-danger'>There is no letter with given ID</div>
							<a href='javascript:history.back()' class='btn btn-grey'><i class='ace-icon fa fa-arrow-left'></i> Go Back</a>
						<?php	
							}
						?>
					</div>
				</div><!-- /.main-content -->
			</div><!-- /.main-content -->
		<!-- /.ends in footer-->
		<?php include("../inc/inc_footer.php"); ?>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$('.uploadFileLoad').on('click', function(e){
				e.preventDefault();
				$('#uploadFileModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.uploadDocumentLoad').on('click', function(e){
				e.preventDefault();
				$('#uploadDocumentModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.writeRemarkLoad').on('click', function(e){
				e.preventDefault();
				$('#writeRemarkModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.changeStatusLoad').on('click', function(e){
				e.preventDefault();
				$('#changeStatusModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.visitorActionLoad').on('click', function(e){
				e.preventDefault();
				$('#visitorActionModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.forwardLoad').on('click', function(e){
				e.preventDefault();
				$('#forwardLoadModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.setAppointmentLoad').on('click', function(e){
				e.preventDefault();
				$('#setAppointmentLoadModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.visitorLoad').on('click', function(e){
				e.preventDefault();
				$('#visitorLoadModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.forwardReceiptToDivision').on('click', function(e){
				e.preventDefault();
				$('#forwardReceiptToDivisionModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.forwardReceiptToAll').on('click', function(e){
				e.preventDefault();
				$('#forwardReceiptToAllModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
		</script>
		
		<!--// Form Validation -->
		<script src="../assets/formValidate/bootstrapValidator.js"></script>
		
		<!--// date and time picker -->
		<script src="../assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js//bootstrap-timepicker.min.js"></script>
	<?php include("../inc/footer.php"); ?>
