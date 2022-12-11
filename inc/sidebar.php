<div id="sidebar" class="sidebar responsive ace-save-state compact">
	<script type="text/javascript">
		try{ace.settings.loadState('sidebar')}catch(e){}
	</script>
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button>
			<button class="btn btn-info"><i class="ace-icon fa fa-pencil"></i></button>
			<button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button>
			<button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button>
		</div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>
			<span class="btn btn-info"></span>
			<span class="btn btn-warning"></span>
			<span class="btn btn-danger"></span>
		</div>
	</div><!-- /.sidebar-shortcuts -->
	<ul class="nav nav-list">
		<?php
			$menuDetail = $generalClass->getAll(TBL_MENU);
			
			foreach($menuDetail as $mDtls):
				$subMenuDetail = $generalClass->getSubMenu(TBL_SUB_MENU, $mDtls['id']);
				$currentURL = $_SERVER['REQUEST_URI'];
				$arrayURL = explode('/', $currentURL);
				$routeName = $arrayURL[1];
				$pageName = $arrayURL[2];
				
				$menuAllowedRoles = explode(',', $mDtls['role']);
				$userAssignedRoles = explode(',', $userDetails->role);
				
				// $userDzongkhag = $userDetails->dzongkhag;
				// echo "cc=".$userDzongkhag;
				
				$menuAllowed = false;
				foreach($userAssignedRoles as $UARoles):
					if(in_array($UARoles, $menuAllowedRoles)){
						$menuAllowed = true;
					}
			endforeach; 
			if($menuAllowed):
			?>
			<li class="<?php echo ($routeName == $mDtls['route'])?"active":"";?> highlight hover">
				<a href="<?php echo BASE_URL.$mDtls['route'].'/'; ?>" class="<?php if (sizeof($subMenuDetail) > 0){ echo 'dropdown-toggle'; }?>">
					<i class="menu-icon fa fa-<?php echo $mDtls['icon']; ?>"></i>
					<span class="menu-text"><?php echo $mDtls['menu_name']; ?></span>
					<?php if(sizeof($subMenuDetail) > 0): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
				</a>
				<?php
					if(sizeof($subMenuDetail) > 0):
				?>
				<b class="arrow"></b>
				<ul class="submenu">
					<?php 
						foreach($subMenuDetail as $smDtls): 
						$subMenuAllowedRoles = explode(',', $smDtls['role']);
						$subMenuAllowed = false;
						foreach($userAssignedRoles as $UARoles):
							if(in_array($UARoles, $subMenuAllowedRoles)){
								$subMenuAllowed = true;
							}
						endforeach; 
						if($subMenuAllowed):
					?>
					<li class="<?php echo ($pageName == $smDtls['action'])?"active":"";?> hover">
						<a href="<?php echo BASE_URL.$smDtls['route'].'/'.$smDtls['action']?>">
							<i class="menu-icon fa fa-caret-right"></i>
							<?php echo $smDtls['sub_menu_name']; ?>
						</a>
						<b class="arrow"></b>
					</li>
					<?php 
						endif; 
						endforeach; 
					?>
				</ul>
				<?php endif; ?>
			</li>
		<?php 
			endif; 
			endforeach; 
		?>
	</ul>
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-right" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
	<script type="text/javascript">
		try{ace.settings.check('sidebar','collapsed')}catch(e){}
	</script>
</div>