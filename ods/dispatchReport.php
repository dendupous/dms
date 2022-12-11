	
	<?php include("../inc/header.php"); ?>
	
		<div class="main-container ace-save-state" id="main-container">
			
			<?php include("../inc/sidebar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
				
					<?php include("../inc/breadcrumb.php"); ?>
					
					<div class="page-content">
						
						<?php include("../inc/app_setting.php"); ?>
					
						<div class="page-header">
							<h1>Dispatch Report<small><i class="ace-icon fa fa-angle-double-right"></i> Official Letters Dispatched Report </small></h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<div class="clearfix">
									<div class="pull-right tableTools-container"></div>
								</div>
								<div class="table-header">
									Official Letters Dispatched Report
								</div>
								<!-- div.dataTables_borderWrap -->
								<div>
									<table id="dynamic-table" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>From</th>
												<th>To</th>
												<th>Subject</th>
												<th class="hidden-480">Reference Number.</th>
												<th class="hidden-480">Dispatched On</th>
												<th class="hidden-480">Fiscal Year / Dispatch No</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$uRoles = $userDetails->role;							
												$uRolesInArray = explode(",", $uRoles);
												if(in_array(3, $uRolesInArray) || in_array(4, $uRolesInArray)){
													$allDisptach = $generalClass->getAll(TBL_DISPATCH);
												}else{
													$allDisptach = $generalClass->getDispatchedLettersByUser($userDetails->id); 
												}
												
												$sl = 1;
												foreach($allDisptach as $allDDtls):
											?>
											<tr>
												<td><a href="#"><?php 
														echo $generalClass->getColumn('name', TBL_DEPT, $allDDtls['fDept']);
														echo ", "; 														
														echo $generalClass->getColumn('description', TBL_DIV, $allDDtls['fDiv']);
													?></a></td>
												<td><?php echo $allDDtls['rOffice'].", ".$allDDtls['rDept'].", ".$allDDtls['rDiv'];?></td>
												<td class="hidden-480"><?php echo $allDDtls['rSubject']; ?></td>
												<td><?php echo $allDDtls['rRefNum']; ?></td>
												<td><?php echo date('jS F Y', strtotime($allDDtls['dateOfIssue'])); ?></td>
												<td class="hidden-480"><?php echo $allDDtls['fiscalYear']." / ".$allDDtls['dispatchNum']; ?></td>
												<td>
													<div class="hidden-sm hidden-xs action-buttons">
														<a class="blue viewDDetails" href="viewDispatchDetails.php?id=<?php echo $allDDtls['id']; ?>" title="View Dispatch Details.">
															<i class="ace-icon fa fa-search-plus bigger-130"></i>
														</a>
														<a class="orange" href="dLetterAction.php?id=<?php echo $allDDtls['id']; ?>" target="_blank" title="View Receipt Details.">
															<i class="ace-icon fa fa-eye bigger-130"></i>
														</a>
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
															</ul>
														</div>
													</div>
												</td>
											</tr>
											<?php $sl++; endforeach; ?>
										</tbody>
									</table>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						<div class="modal fade" id="ddmodal">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h3 class="modal-title">Viewing Dispatch Details</h3>
									</div>
									<div class="modal-body">
										
									</div>
									<div class="modal-footer">
										<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</a>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		<!-- /.ends in footer-->
		<?php include("../inc/inc_footer.php"); ?>
		
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = $('#dynamic-table')
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
						{ "bSortable": false },
							null, null,null, null, null,
						{ "bSortable": false }
					],
					"aaSorting": [],
					select: {
						style: 'multi'
					}
			    });
			
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
		$('.viewDDetails').on('click', function(e){
			e.preventDefault();
			$('#ddmodal').modal('show').find('.modal-body').load($(this).attr('href'));
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
		
	<?php include("../inc/footer.php"); ?>