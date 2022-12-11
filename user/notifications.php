	
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
				
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> User Notifications</small></h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th>SL No</th>
													<th><i class="ace-icon fa fa-bell bigger-110"></i>Notifcation</th>
													<th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Sent on</th>
													<th class="hidden-480">Status</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php
													$notify = $generalClass->getAllNotifications($userDetails->id);
													$sl = 1;
													foreach($notify as $notifyDtls):
														$link = BASE_URL.$notifyDtls['route']."/".$notifyDtls['action']."?id=".$notifyDtls['key']."-".$notifyDtls['id'];
														$link_check = BASE_URL.$notifyDtls['route']."/".$notifyDtls['action']."?id=".$notifyDtls['key'];
												?>
												<tr>
													<td><?php echo $sl; ?></td>
													<td><?php echo $notifyDtls['remarks']; ?></td>
													<td class="hidden-480">
														<?php echo date('jS F, Y', strtotime($notifyDtls['created'])); ?>
														<?php echo date('g:i A', strtotime($notifyDtls['created'])); ?>
													</td>
													<td class="hidden-480">
														<?php if($notifyDtls['flag'] == 0): ?>
															<span class="label label-danger arrowed-right">Not Seen</span>
														<?php else: ?>
															<span class="label label-success arrowed-right">Seen</span>
														<?php endif; ?>
													</td>
													<td>
														<?php if($notifyDtls['flag'] == 0): ?>
															<a href="<?php echo $link; ?>" class="btn btn-minier btn-primary">Read Notification</a>
														<?php else: ?>
															<span class="label label-success arrowed-right">Seen</span>
															<a href="<?php echo $link_check; ?>"><span class="label label-warning arrowed-right">Check Notification</span></a>
														<?php endif; ?>
													</td>
												</tr>
												<?php $sl++; endforeach; ?>
											</tbody>
										</table>	
									</div><!-- /.row -->
								</div><!-- /.row -->
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		<!-- /.ends in footer-->
		<?php include("../inc/inc_footer.php"); ?>
	<?php include("../inc/footer.php"); ?>