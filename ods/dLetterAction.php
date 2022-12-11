
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">

			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">

					<?php include("../inc/breadcrumb.php"); ?>

					<div class="page-content">

						<?php include("../inc/app_setting.php"); ?>

						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> Dispatch Letter Actions </small></h1>
						</div><!-- /.page-header -->
							
						<?php
							$lID = $_GET['id'];
							$lDetails = $generalClass->get(TBL_DISPATCH, $lID);
							
							if(sizeof($lDetails) > 0){
						?>
					
						<!-- PAGE CONTENT BEGINS -->
						<div class="row">
							<div class="col-xs-12">
								<div class="col-sm-5">
									<div class="widget-box transparent">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title lighter">
												<i class="ace-icon fa fa-home green"></i> <b>From Details (Letter Source)</b>
											</h4>
										</div>
										<div class="widget-body">
											<div class="widget-main no-padding">
												<?php
													foreach($lDetails as $lDtls); extract($lDtls);
													$uploadDate = $generalClass->getColumn('created', TBL_DISPATCH, $id);
													$finalDirName = date('Ymd', strtotime($uploadDate));
													$directoryPath = "../uploads/dispatchedLetter/".$finalDirName."/";
												?>
												<div>
													<ul class="list-unstyled spaced">
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> 
															<?php echo $generalClass->getColumn('name', TBL_OFFICE, $fOffice); ?> -
															<?php echo $generalClass->getColumn('description', TBL_OFFICE, $fOffice); ?>
														</li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b>
															<?php echo $generalClass->getColumn('name', TBL_DEPT, $fDept); ?> -
															<?php echo $generalClass->getColumn('description', TBL_DEPT, $fDept); ?>
														</li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b>
															<?php echo $generalClass->getColumn('name', TBL_DIV, $fDiv); ?> -
															<?php echo $generalClass->getColumn('description', TBL_DIV, $fDiv); ?>
														</li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Section :</b>
															<?php echo $generalClass->getColumn('name', TBL_SEC, $fSec); ?> -
															<?php echo $generalClass->getColumn('description', TBL_SEC, $fSec); ?>
														</li>
													</ul>
												</div>
											</div><!-- /.widget-main -->
										</div><!-- /.widget-body -->
									</div><!-- /.widget-box -->

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
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name (Ministry/Angecy) :</b> <?php echo $rOffice; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> <?php echo $rDept; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> <?php echo $rDiv; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Place :</b> <?php echo $rPlace; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Reference Number :</b> <?php echo $rRefNum; ?></li>
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
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Addressed To :</b> <?php echo $adressedTo; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Subject :</b> <?php echo $rSubject; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Copy To :</b> <?php echo $rCopyTo; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Number :</b> <?php echo $dispatchNum; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Date of Issue :</b> <?php echo date('d/m/Y', strtotime($dateOfIssue)); ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Time of Issue :</b> <?php echo date('h:i A', strtotime($timeOfIssue)); ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Fiscal Year :</b> <?php echo $fiscalYear; ?></li>
														<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Copy :</b> <?php echo $file_name; ?>
															<a href="../uploads/download.php?file=<?php echo $filePath; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue" title="Download File"><i class="ace-icon fa fa-download blue"></i> DOWNLOAD FILE</a>
															&nbsp;&nbsp;&nbsp;<a href="<?php echo $directoryPath.$filePath; ?>" target="_blank" class="blue" title="View File"><i class="ace-icon fa fa-eye blue"></i> VIEW FILE</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
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
								<hr class="hr-double">
								</div><!-- /.col -->
								<div class="col-sm-7">
									<div class="modal fade" id="writeRemarkDispatchModal">
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
									<div class="modal fade" id="statusDispatchModal">
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
									<div class="modal fade" id="forwardDispatchModal">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h3 class="modal-title">Forward dispatched copy to another official</h3>
												</div>
												<div class="modal-body"></div>
												<div class="modal-footer"></div>
											</div>
										</div>
									</div>
									<div class="modal fade" id="forwardDispatchModalToAll">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h3 class="modal-title">Forward to All Employees</h3>
												</div>
												<div class="modal-body"></div>
												<div class="modal-footer"></div>
											</div>
										</div>
									</div>
									
									<div class="widget-box transparent">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title lighter">
												<i class="ace-icon fa fa-gavel red"></i>
												<b>Actions taken on dispatched letter</b>
											</h4>
											<div class="btn-group clearfix pull-right">
												<button data-toggle="dropdown" class="btn btn-success btn dropdown-toggle">Take Action<i class="ace-icon fa fa-angle-down icon-on-right"></i></button>
												<ul class="dropdown-menu dropdown-success dropdown-menu-right">
													<li><a href="writeRemarkDispatch.php?id=<?php echo $id; ?>" class="writeRemarkLoad"><span class="ace-icon fa fa-commenting-o"></span> Write remarks</a></li>
													<li class="divider"></li>
													<li><a href="changeStatusDispatch.php?id=<?php echo $id; ?>" class="changeStatusLoad"><span class="ace-icon fa fa-signal"></span> Change Status</a></li>
													<li class="divider"></li>
													<li><a href="forwardDispatch.php?id=<?php echo $id; ?>" class="forwardLoad"><span class="ace-icon fa fa-send"></span> Send Copy</a></li>
													<li class="divider"></li>
													<li><a href="forwardDispatchToAll.php?id=<?php echo $id; ?>" class="forwardLoadToAll"><span class="ace-icon fa fa-send"></span> Send copy to All Staff</a></li>
												</ul>
											</div>
										</div>
										<div class="widget-body">
											<div class="timeline-container">
												<?php
													$receiptDtls = $generalClass->getDispatchAction(TBL_DACTION, $id);
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
																		if($actionTaken == "2"){?>
																	<span class="grey"> wrote following remarks.</span>
																	<?php } if($actionTaken == "3"){?>
																	<span class="grey"> changed the status.</span>
																	<?php } if($actionTaken == "5"){?>
																	<span class="grey"> forwarded to </span><span class="blue"><?php echo $generalClass->getColumn('name', TBL_USER, $sDtls['reciever']);?>.</span>
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
																	<?php  if($actionTaken == "2"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																	<?php } ?>
																	<?php  if($actionTaken == "3"){ ?>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_DSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "5"){ ?>
																		<b class="blue">Remarks &raquo;</b>
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
																	<a href="#" class="blue"><?php echo $auhtorDtls['name']; ?></a>
																	<?php
																		$actionTaken = $sDtls['type'];;
																		if($actionTaken == "2"){?>
																	<span class="grey"> wrote following remarks.</span>
																	<?php } if($actionTaken == "3"){?>
																	<span class="grey"> changed the status.</span>
																	<?php } if($actionTaken == "5"){?>
																	<span class="grey"> forwarded to </span><span class="blue"><?php echo $generalClass->getColumn('name', TBL_USER, $sDtls['reciever']);?>.</span>
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
																	<?php  if($actionTaken == "2"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																	<?php } ?>
																	<?php  if($actionTaken == "3"){ ?>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_DSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "5"){ ?>
																		<b class="blue">Remarks &raquo;</b>
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
																	<a href="#" class="blue"><?php echo $auhtorDtls['name']; ?></a>
																	<?php
																		$actionTaken = $sDtls['type'];;
																		if($actionTaken == "2"){?>
																	<span class="grey"> wrote following remarks.</span>
																	<?php } if($actionTaken == "3"){?>
																	<span class="grey"> changed the status.</span>
																	<?php } if($actionTaken == "5"){?>
																	<span class="grey"> forwarded to </span><span class="blue"><?php echo $generalClass->getColumn('name', TBL_USER, $sDtls['reciever']);?>.</span>
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
																	<?php  if($actionTaken == "2"){ ?>
																		<b class="blue">Remarks &raquo;</b> <?php echo $sDtls['remarks']; ?>
																		<div class="space-6"></div>
																	<?php } ?>
																	<?php  if($actionTaken == "3"){ ?>
																		<b class="blue">Status changed to &raquo;</b> <span class="label label-<?php echo $generalClass->getColumn('color', TBL_RSTATUS, $sDtls['status']); ?> arrowed-right">
																		<?php echo $generalClass->getColumn('status', TBL_DSTATUS, $sDtls['status']); ?></span>
																	<?php } ?>
																	<?php  if($actionTaken == "5"){ ?>
																		<b class="blue">Remarks &raquo;</b>
																		<?php echo $sDtls['remarks']; ?>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php endif; ?>
												<?php $preDate = date('Y-m-d',strtotime($latestDate)); endforeach;?>
											</div>
										</div>
									</div>
								</div>
							</div>
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

			$('.uploadDocumentLoad').on('click', function(e){
				e.preventDefault();
				$('#uploadFileModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.writeRemarkLoad').on('click', function(e){
				e.preventDefault();
				$('#writeRemarkDispatchModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.changeStatusLoad').on('click', function(e){
				e.preventDefault();
				$('#statusDispatchModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.forwardLoad').on('click', function(e){
				e.preventDefault();
				$('#forwardDispatchModal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.forwardLoadToAll').on('click', function(e){
				e.preventDefault();
				$('#forwardDispatchModalToAll').modal('show').find('.modal-body').load($(this).attr('href'));
			});

		</script>

		<!--// Form Validation -->
		<script src="../assets/formValidate/bootstrapValidator.js"></script>

		<!--// date and time picker -->
		<script src="../assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js//bootstrap-timepicker.min.js"></script>
	<?php include("../inc/footer.php"); ?>
