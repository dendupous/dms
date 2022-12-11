	
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
						<?php
							$uRoles = explode(',', $userDetails->role);
							if(in_array(4, $uRoles)){
						?>
						<!-- PAGE CONTENT BEGINS -->
						<div class="row">
							<div class="col-xs-12">
								<div class="tabbable">
									<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
										<li><a href="office.php"><i class="blue ace-icon fa fa-bank bigger-120"></i>Office</a></li>
										<li class="active"><a href="dept.php"><i class="blue ace-icon fa fa-home bigger-120"></i>Departments</a></li>
										<li><a href="division.php"><i class="blue ace-icon fa fa-th-large bigger-120"></i>Divisions</a></li>
										<li><a href="section.php"><i class="blue ace-icon fa fa-th bigger-120"></i>Sections</a></li>
										<li><a href="socialmediasetup.php"><i class="blue ace-icon fa fa-heart bigger-120"></i>Socail Media</a></li>
									</ul>

									<div class="tab-content no-border padding-24">
										<div class="tab-pane fade in active">
											<h3 class="blue">Departments</h3>
											<div class="clearfix">
												<div class="pull-right">
													<a href="addNewDept.php" type="button" class="addDeptModal btn btn-success">Add New <i class="ace-icon fa fa-plus"></i></a></div>
											</div>
											<div class="space-6"></div>
											<div>
												<table id="dynamic-table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>SL No.</th>
															<th>Office</th>
															<th>Name</th>
															<th>Description</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php 
															$allDepts = $generalClass->getAll(TBL_DEPT); 
															$sl = 1;
															foreach($allDepts as $deptDtls):
														?>
														<tr>
															<td><?php echo $sl; ?></td>
															<td><?php echo $generalClass->getColumn('name', TBL_OFFICE, $deptDtls['office']); ?></td>
															<td><?php echo $deptDtls['name']; ?></td>
															<td><?php echo $deptDtls['description']; ?></td>
															<td>
																<div class="action-buttons">
																	<a class="green editDeptModal" href="editDept.php?id=<?php echo $deptDtls['id']; ?>" title="Edit Department Info.">
																		<i class="ace-icon fa fa-pencil bigger-130"></i>
																	</a>
																	<a class="red" href="deleteDept.php?id=<?php echo $deptDtls['id']; ?>" onclick="return confirm('Are you sure you want to delete?')" title="Delete Department Info.">
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
															<h3 class="modal-title">Add New Department</h3>
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
															<h3 class="modal-title">Edit Department</h3>
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
						<?php } else {?>
						<div class="alert alert-danger">
							You don't have permission to create new user.
						</div>
						<a href="javascript:history.back()" class="btn btn-grey"><i class="ace-icon fa fa-arrow-left"></i> Go Back</a>
						<?php }?>
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