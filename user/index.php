	
	<?php include("../inc/header.php"); ?>

		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
					
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> User List </small></h1>
						</div><!-- /.page-header -->
						<?php
							$uRoles = explode(',', $userDetails->role);
							if(in_array(4, $uRoles)){
						?>
						<!-- PAGE CONTENT BEGINS -->
						<div class="row">
							<div class="col-xs-12">
								<div class="clearfix">
									<div class="pull-right tableTools-container"></div>
								</div>
								<div class="table-header">
									Results for Registered Users
								</div>
								<!-- div.dataTables_borderWrap -->
								<div>
									<table id="dynamic-table" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>SL No.</th>
												<th>Name</th>
												<th>Mobile No.</th>
												<th>Email</th>
												<th class="hidden-480">CID No.</th>
												<th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Last Login</th>
												<th class="hidden-480">Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$allUser = $generalClass->getAll(TBL_USER); 
												$sl = 1;
												foreach($allUser as $allUserDtls):
											?>
											<tr>
												<td><?php echo $sl; ?></td>
												<td><a href="#"><?php echo $allUserDtls['name']; ?></a></td>
												<td><?php echo $allUserDtls['mobile']; ?></td>
												<td><?php echo $allUserDtls['email']; ?></td>
												<td class="hidden-480"><?php echo $allUserDtls['cid']; ?></td>
												<td>
													<?php 
														if($allUserDtls['last_login'] == '0000-00-00 00:00:00'){
															echo "Never Logged In";
														}else{
															echo date('jS F Y', strtotime($allUserDtls['last_login'])); 
														}
													?>
												</td>
												<td class="hidden-480">
													<?php if($allUserDtls['status'] == 1): ?>
														<span class="label label-sm label-success">Active</span>
													<?php else: ?>
														<span class="label label-sm label-danger">Blocked</span>
													<?php endif; ?>
												</td>
												<td>
													<div class="hidden-sm hidden-xs action-buttons">
														<a class="blue userViewLoadModal" href="userViewModal.php?id=<?php echo $allUserDtls['id']; ?>" title="View user Info.">
															<i class="ace-icon fa fa-search-plus bigger-130"></i>
														</a>
														<a class="green userEditLoadModal" href="userEditModal.php?id=<?php echo $allUserDtls['id']; ?>" title="Edit user Info.">
															<i class="ace-icon fa fa-pencil bigger-130"></i>
														</a>
														<a class="green userPasswdLoadModal" href="userPasswdModal.php?id=<?php echo $allUserDtls['id']; ?>" title="Reset Password.">
															<i class="ace-icon fa fa-unlock-alt bigger-130"></i>
														</a>
														<?php if($allUserDtls['status'] == 1): ?>
														<a class="red" href="changeUserStatus.php?id=<?php echo $allUserDtls['id'].'-'.$allUserDtls['status']; ?>" title="Block User." onclick="return confirm('Are you sure you want to block the user?')"  >
															<i class="ace-icon fa fa-times-circle bigger-130"></i>
														</a>
														<?php else: ?>
														<a class="blue" href="changeUserStatus.php?id=<?php echo $allUserDtls['id'].'-'.$allUserDtls['status']; ?>" title="Un-Block User." onclick="return confirm('Are you sure you want to un-block the user?')"  >
															<i class="ace-icon fa fa-unlock bigger-130"></i>
														</a>
														<?php endif; ?>
													</div>
													<div class="hidden-md hidden-lg">
														<div class="inline pos-rel">
															<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
															</button>
															<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																<li>
																	<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																		<span class="blue">
																			<i class="ace-icon fa fa-search-plus bigger-120"></i>
																		</span>
																	</a>
																</li>
																<li>
																	<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																		<span class="green">
																			<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																		</span>
																	</a>
																</li>
																<li>
																	<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																		<span class="red">
																			<i class="ace-icon fa fa-trash-o bigger-120"></i>
																		</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</td>
											</tr>
											<?php $sl++; endforeach; ?>
										</tbody>
									</table>
								</div>
								<div class="modal fade" id="uvmodal">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title">View User Information</h3>
											</div>
											<div class="modal-body">
												
											</div>
											<div class="modal-footer">
												<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</a>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="uemodal">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title">Edit User Information</h3>
											</div>
											<div class="modal-body">
												
											</div>
											<div class="modal-footer">
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="uPassmodal">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title">Change User Password</h3>
											</div>
											<div class="modal-body">
												
											</div>
											<div class="modal-footer">
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
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = $('#dynamic-table').DataTable( {});
			
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}			
			})
		</script>
		<script type="text/javascript">
		//JS script
		$('.userViewLoadModal').on('click', function(e){
			e.preventDefault();
			$('#uvmodal').modal('show').find('.modal-body').load($(this).attr('href'));
		});
		
		$('.userEditLoadModal').on('click', function(e){
			e.preventDefault();
			$('#uemodal').modal('show').find('.modal-body').load($(this).attr('href'));
		});
		
		$('.userPasswdLoadModal').on('click', function(e){
			e.preventDefault();
			$('#uPassmodal').modal('show').find('.modal-body').load($(this).attr('href'));
		});
		</script>
		<!-- page specific plugin scripts -->
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="../assets/js/dataTables.buttons.min.js"></script>
		<script src="../assets/js/buttons.flash.min.js"></script>
		<script src="../assets/js/buttons.html5.min.js"></script>
		<script src="../assets/js/buttons.print.min.js"></script>
		<script src="../assets/js/buttons.colVis.min.js"></script>
		<script src="../assets/js/dataTables.select.min.js"></script>
		
		<script src="../assets/formValidate/bootstrapValidator.js"></script>
		
	<?php include("../inc/footer.php"); ?>