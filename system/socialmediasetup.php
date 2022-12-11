	
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
					
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> Office Details (Department, Division and Section) </small></h1>
						</div><!-- /.page-header -->

							<!-- PAGE CONTENT BEGINS -->
							<div class="row">
								<div class="col-xs-12">
									<div class="tabbable">
										<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
											<li><a href="office.php"><i class="blue ace-icon fa fa-bank bigger-120"></i>Office</a></li>
											<li><a href="dept.php"><i class="blue ace-icon fa fa-home bigger-120"></i>Departments</a></li>
											<li><a href="division.php"><i class="blue ace-icon fa fa-th-large bigger-120"></i>Divisions</a></li>
											<li><a href="section.php"><i class="blue ace-icon fa fa-th bigger-120"></i>Sections</a></li>
											<li class="active"><a href="socialmediasetup.php"><i class="blue ace-icon fa fa-heart bigger-120"></i>Socail Media</a></li>
										</ul>

										<div class="tab-content no-border padding-24">
											<div class="tab-pane fade in active">
												<h3 class="blue">Socail Media Details</h3>
												<div class="clearfix">
													<div class="pull-right">
														<a href="addNewSocialMedia.php" type="button" class="addDeptModal btn btn-success">Add New <i class="ace-icon fa fa-plus"></i></a></div>
												</div>
												<div class="space-6"></div>
												<div>
													<table id="dynamic-table" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>SL No.</th>
																<th>Social Media</th>
																<th>Link URL</th>
																<th>Icon</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<?php 
																$socialMedia = $generalClass->getAll(TBL_SM); 
																$sl = 1;
																foreach($socialMedia as $smDtl):
															?>
															<tr>
																<td><?php echo $sl; ?></td>
																<td><?php echo $smDtl['name']; ?></td>
																<td><a href="<?php echo $smDtl['link']; ?>"><?php echo $smDtl['link']; ?></a></td>
																<td><?php echo ($smDtl['status'] == 1)?'Enabled':'Disabled'; ?></td>
																<td><i class="blue ace-icon fa fa-<?php echo $smDtl['icon']; ?> bigger-120"></i></td>
																<td>
																	<div class="action-buttons">
																		<a class="green editDeptModal" href="editSM.php?id=<?php echo $smDtl['id']; ?>" title="Edit Social Media Details.">
																			<i class="ace-icon fa fa-pencil bigger-130"></i>
																		</a>
																		<a class="red" href="deleteSM.php?id=<?php echo $smDtl['id']; ?>" onclick="return confirm('Are you sure you want to delete?')" title="Delete Socail Media Details.">
																			<i class="ace-icon fa fa-trash-o bigger-130"></i>
																		</a>
																	</div>
																</td>
															</tr>
															<?php $sl++; endforeach; ?>
														</tbody>
													</table>
												</div>
												<div class="modal fade" id="deptAddmodal">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h3 class="modal-title">Add New Socail Media</h3>
															</div>
															<div class="modal-body">
																
															</div>
															<div class="modal-footer">
															</div>
														</div>
													</div>
												</div>
												<div class="modal fade" id="deptEditmodal">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h3 class="modal-title">Edit Socail Media</h3>
															</div>
															<div class="modal-body">
																
															</div>
															<div class="modal-footer">
															</div>
														</div>
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
		<script type="text/javascript">
			$('.addDeptModal').on('click', function(e){
				e.preventDefault();
				$('#deptAddmodal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			$('.editDeptModal').on('click', function(e){
				e.preventDefault();
				$('#deptEditmodal').modal('show').find('.modal-body').load($(this).attr('href'));
			});
			
		</script>
		
		<script src="../assets/formValidate/bootstrapValidator.js"></script>
		
	<?php include("../inc/footer.php"); ?>