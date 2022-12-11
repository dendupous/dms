	
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
				
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> User Pending Tasks</small></h1>
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
													<th><i class="ace-icon fa fa-bell bigger-110"></i>Task Remarks</th>
													<th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Sent on</th>
													<th class="hidden-480">Status</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php
													$tasks = $generalClass->getAllTasks($userDetails->id);
													$sl = 1;
													foreach($tasks as $tasksDtls):
														$link = BASE_URL.$tasksDtls['route']."/".$tasksDtls['action']."?id=".$tasksDtls['key'];
												?>
												<tr>
													<td><?php echo $sl; ?></td>
													<td><?php echo $tasksDtls['remarks']; ?></td>
													<td class="hidden-480">
														<?php echo date('jS F, Y', strtotime($tasksDtls['created'])); ?>
														<?php echo date('g:i A', strtotime($tasksDtls['created'])); ?>
													</td>
													<td class="hidden-480">
														<?php if($tasksDtls['pending'] == 1): ?>
															<span class="label label-danger arrowed-right">Task Pending</span>
														<?php else: ?>
															<span class="label label-success arrowed-right">Task Completed</span>
														<?php endif; ?>
													</td>
													<td>
														<?php if($tasksDtls['pending'] == 1): ?>
															<a href="<?php echo $link; ?>" class="btn btn-minier btn-primary">Complete Task</a>
														<?php else: ?>
															<span class="label label-success arrowed-right">Task Completed</span>
														<?php endif; ?>
														<a href="<?php echo $link; ?>"><span class="label label-warning arrowed-right">Check Task</span></a>
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