	
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
					
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> User Profile </small></h1>
						</div><!-- /.page-header -->

							<!-- PAGE CONTENT BEGINS -->
							<div class="row">
								<div class="col-xs-12">
									<div class="clearfix">
										<div class="pull-left alert alert-success no-margin alert-dismissable">
											<i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
											Following are your profile information in the Document Management System. You may change the information as and when it requires.
										</div>
									</div>
									<div class="hr dotted"></div>

									<div>
										<div id="user-profile-1" class="user-profile row">
											<div class="col-xs-12 col-sm-3 center">
												<div>
													<span class="profile-picture">
														<?php if(empty($userDetails->photo) || $userDetails->photo == ''){ $uImage = "default.jpg"; }else{ $uImage = $userDetails->photo; } ?>
														<img class="img-responsive" alt="<?php echo $userDetails->name; ?>" src="<?php echo BASE_URL.'images/user/'.$uImage; ?>" width="180" height="200"/>
													</span>

													<div class="space-4"></div>

													<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
														<div class="inline position-relative">
															<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
																<?php if($userDetails->user_status == '0'):?>
																<i class="ace-icon fa fa-circle light-grey"></i>
																<?php endif; ?>
																<?php if($userDetails->user_status == '1'):?>
																<i class="ace-icon fa fa-circle light-green"></i>
																<?php endif; ?>
																<?php if($userDetails->user_status == '2'):?>
																<i class="ace-icon fa fa-circle light-red"></i>
																<?php endif; ?>
																&nbsp;<span class="white"><?php echo $userDetails->name; ?></span>
															</a>

															<ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
																<li class="dropdown-header"> Change Status </li><li>
																	<a href="updateUserStatus.php?uid=<?php echo $userDetails->id; ?>&s=1">
																		<i class="ace-icon fa fa-circle green"></i>&nbsp;
																		<span class="green">Available</span>
																	</a>
																</li>
																<li>
																	<a href="updateUserStatus.php?uid=<?php echo $userDetails->id; ?>&s=2">
																		<i class="ace-icon fa fa-circle red"></i>&nbsp;
																		<span class="red">Busy</span>
																	</a>
																</li>
																<li>
																	<a href="updateUserStatus.php?uid=<?php echo $userDetails->id; ?>&s=0">
																		<i class="ace-icon fa fa-circle grey"></i>&nbsp;
																		<span class="grey">Invisible</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>

												<div class="space-6"></div>

												<div class="profile-contact-info">
													<div class="profile-contact-links align-left">
														<a href="userPhotoChange.php?id=<?php echo $userDetails->id; ?>" class="btn btn-link userPhotoChange">
															<i class="ace-icon fa fa-refresh bigger-120 green"></i>
															Change Photo
														</a>

														<a href="userProfilePasswdModal.php?id=<?php echo $userDetails->id; ?>" class="btn btn-link userProfilePasswd">
															<i class="ace-icon fa fa-lock bigger-120 pink"></i>
															Change Password
														</a>
														<a href="userProfileEditModal.php?id=<?php echo $userDetails->id; ?>" class="btn btn-link userProfileEdit">
															<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
															Edit Information
														</a>
													</div>
													<div class="space-6"></div>
												</div>
											</div>

											<div class="col-xs-12 col-sm-9">
												<div class="widget-box transparent">
													<div class="widget-header widget-header-small">
														<h4 class="widget-title blue smaller">
															<i class="ace-icon fa fa-user orange"></i>
															User Information
														</h4>

														<div class="widget-toolbar action-buttons">
															<a href="userProfileEditModal.php?id=<?php echo $userDetails->id; ?>" class="userProfileEdit">
																<i class="ace-icon fa fa-pencil blue"></i>
															</a>
														</div>
													</div>
													<div class="widget-body">
														<div class="widget-main padding-8">
															<div class="profile-user-info profile-user-info-striped">
																<div class="profile-info-row">
																	<div class="profile-info-name"> Roles Assigned </div>
																	<div class="profile-info-value">
																		<ol>
																			<?php 
																				$uRoles = $userDetails->role;
																				
																				$uRolesInArray = explode(",", $uRoles);
																				foreach($uRolesInArray as $userRoles){
																					$roleName = $generalClass->getColumn('role', TBL_ROLE, $userRoles);
																					$roleDesc = $generalClass->getColumn('description', TBL_ROLE, $userRoles);
																					echo '<li><b>'.$roleName.'</b> - '.$roleDesc.'</li>';
																				}
																				
																			?>
																		</ol>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Status </div>
																	<div class="profile-info-value">
																		<span>
																			<?php if($userDetails->status == '1'){ ?>
																					<span class="label label-lg label-success arrowed-right">Active</span>
																			<?php }else{ ?>
																					<span class="label label-lg label-danger arrowed-right">Blocked</span>
																			<?php }?>
																		</span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Designation </div>
																	<div class="profile-info-value">
																		<span><?php echo $userDetails->designation; ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Email </div>
																	<div class="profile-info-value">
																		<span><?php echo $userDetails->email; ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Mobile </div>
																	<div class="profile-info-value">
																		<span><?php echo $userDetails->mobile; ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> CID Number </div>
																	<div class="profile-info-value">
																		<span><?php echo $userDetails->cid; ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Emp ID Number </div>
																	<div class="profile-info-value">
																		<span><?php echo $userDetails->empid; ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Office No. </div>
																	<div class="profile-info-value">
																		<span><?php echo $userDetails->office_num; ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Extension No. </div>
																	<div class="profile-info-value">
																		<span><?php echo $userDetails->ext_num; ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Office </div>
																	<div class="profile-info-value">
																		<span>
																			<?php 
																				$office = $generalClass->get(TBL_OFFICE, $userDetails->office);
																				foreach($office as $officeDtls);
																				extract($officeDtls);
																				echo $name.' - '.$description;
																			?>
																		</span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Department </div>
																	<div class="profile-info-value">
																		<span>
																			<?php 
																				$dept = $generalClass->get(TBL_DEPT, $userDetails->department);
																				foreach($dept as $deptDtls);
																				extract($deptDtls);
																				echo $name.' - '.$description;
																			?>
																		</span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Division </div>
																	<div class="profile-info-value">
																		<span>
																			<?php 
																				$div = $generalClass->get(TBL_DIV, $userDetails->division);
																				foreach($div as $divDtls);
																				extract($divDtls);
																				echo $name.' - '.$description;
																			?>
																		</span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Section </div>
																	<div class="profile-info-value">
																		<span>
																			<?php 
																				$sec = $generalClass->get(TBL_SEC, $userDetails->section);
																				foreach($sec as $secDtls);
																				extract($secDtls);
																				echo $name.' - '.$description;
																			?>
																		</span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Joined </div>
																	<div class="profile-info-value">
																		<span class="editable" id="signup"><?php echo date('jS F Y', strtotime($userDetails->created)); ?></span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Last Logged In </div>
																	<div class="profile-info-value">
																		<span class="editable" id="login"><?php echo date('jS F Y', strtotime($userDetails->last_login)); ?></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="hr dotted"></div>
										<div class="modal fade" id="uProfileEditmodal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Edit User Profile</h3>
													</div>
													<div class="modal-body">
														
													</div>
													<div class="modal-footer">
													</div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="uProfilePasswdmodal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Change Your Password</h3>
													</div>
													<div class="modal-body">
														
													</div>
													<div class="modal-footer">
													</div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="uPhotodmodal">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Change Your Photo</h3>
													</div>
													<div class="modal-body">
														
													</div>
													<div class="modal-footer">
														Recommended Size (width = 180px X height = 200px)
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- /.container -->
							</div><!-- /.row -->	
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		<!-- /.ends in footer-->
		<?php include("../inc/inc_footer.php"); ?>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$('.userProfileEdit').on('click', function(e){
				e.preventDefault();
				$('#uProfileEditmodal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			
			$('.userProfilePasswd').on('click', function(e){
				e.preventDefault();
				$('#uProfilePasswdmodal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			
			$('.userPhotoChange').on('click', function(e){
				e.preventDefault();
				$('#uPhotodmodal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
		</script>
		<script src="../assets/formValidate/bootstrapValidator.js"></script>
	<?php include("../inc/footer.php"); ?>