	<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="blue bolder">DMS </span>
						Document Management System &copy; <?php echo date("Y"); ?>
					</span>

					&nbsp; &nbsp;
					<span class="action-buttons">
						<?php
							$socialMedias = $generalClass->getActiveSM(TBL_SM);
							if(sizeof($socialMedias) > 0):
							foreach($socialMedias as $socialMedia):
						?>
						<a href="<?php echo $socialMedia['link']; ?>" target="_blank" title="<?php echo $socialMedia['name']; ?>">
							<i class="ace-icon fa fa-<?php echo $socialMedia['icon']; ?> bigger-150"></i>
						</a>
						<?php 
							endforeach; 
							endif;
						?>
					</span>
				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

		<!--[if !IE]> -->
		<script src="../js/jquery.min.js"></script>

		<!-- <![endif]-->
		
		<!--[if IE]>
		<script src="../assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../js/notify/bootstrap-notify.js"></script>
		
		<!-- // For All Notification -->
		<script type="text/javascript">
			<?php 
				$message = $_SESSION['message'];
				$type = $_SESSION['type'];
				
				if(!empty($message) && isset($message)):
			?>
				$.notify({
					// options
					message: '<?php echo $message; ?>', 
				},{
					// settings
					type: '<?php echo $type; ?>',
					animate: {
						enter: 'animated fadeInDown',
						exit: 'animated fadeOutUp'
					},
				});
			<?php 
				$_SESSION['message'] = '';
				$_SESSION['type'] = '';
				endif; 
			?>
		</script>
		<!-- // For SideBar -->
		<script type="text/javascript">
			$(".nav li").on("click", function() {
				$(".nav li").removeClass("active");
				$(this).addClass("active");
			});
		</script>
		
		<!--[if lte IE 8]>
		<script src="../assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.index.min.js"></script>
		<script src="../assets/js/jquery.flot.min.js"></script>
		<script src="../assets/js/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		
		<!-- form validator scripts -->
		
