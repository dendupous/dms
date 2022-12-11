	
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
				
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<i class="ace-icon fa fa-angle-double-right"></i> Error 404 - Not Auhtorized Page</small></h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<!-- #section:pages/error -->
										<div class="error-container">
											<div class="well">
												<h1 class="grey lighter smaller">
													<span class="red bigger-125">
														<i class="ace-icon fa fa-sitemap"></i>
														404
													</span>
													You are not authorized to view this page. <i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125 red"></i>
												</h1>
												<hr />
												<h3 class="lighter smaller">Please contact the following for further inquries.</h3>
												<div>
													<h4 class="smaller">Contact Details:</h4>
													<ul class="list-unstyled spaced inline bigger-110 margin-15">
														<li>
															<i class="ace-icon fa fa-user blue"></i>
															<?php echo ADMIN_NAME; ?>
														</li>
														<li>
															<i class="ace-icon fa fa-envelope-o blue"></i>
															<?php echo ADMIN_EMAIL; ?>
														</li>
														<li>
															<i class="ace-icon fa fa-mobile blue"></i>
															<?php echo ADMIN_MOBILE; ?>
														</li>
													</ul>
												</div>

												<hr />
												<div class="space"></div>

												<div class="center">
													<a href="javascript:history.back()" class="btn btn-grey">
														<i class="ace-icon fa fa-arrow-left"></i>
														Go Back
													</a>

													<a href="../main/" class="btn btn-primary">
														<i class="ace-icon fa fa-tachometer"></i>
														Dashboard
													</a>
												</div>
											</div>
										</div>

										<!-- /section:pages/error -->
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