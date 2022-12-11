<?php
	$userId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$userInfo = $generalClass->get(TBL_USER, $userId);
	foreach($userInfo as $userDtl);
?>
<div class="clearfix"></div>
<div class="col-lg-6 col-md-6 col-sm-12">
	<ul class="list-unstyled spaced">
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Name :</b> <?php echo $userDtl['name']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Email Id :</b> <?php echo $userDtl['email']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Mobile No :</b> <?php echo $userDtl['mobile']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>CID No :</b> <?php echo $userDtl['cid']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Emp. ID No :</b> <?php echo $userDtl['empid']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Designation :</b> <?php echo $userDtl['designation']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>User Roles :</b> 
			<?php 
				$roles = explode(',', $userDtl['role']);
				$i = 0;
				foreach($roles as $uRoles){
					$role = $generalClass->get(TBL_ROLE, $uRoles[$i]);
					foreach($role as $roleDtls);
					echo '<b>'.$roleDtls['role'].'</b>, ';
				}
			?>
		</li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Status :</b> 
			<?php if($userDtl['status ']== 1): ?>
				<span class="label label-sm label-success arrowed-right">Active</span>
			<?php else: ?>
				<span class="label label-sm label-danger arrowed-right">Blocked</span>
			<?php endif; ?>
		</li>
	</ul>
</div>
<div class="col-lg-6 col-md-6 col-sm-12"> 
	<ul class="list-unstyled spaced">
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> <?php echo $generalClass->getColumn('name', TBL_DEPT, $userDtl['department']); ?>, <?php echo $generalClass->getColumn('name', TBL_OFFICE, $userDtl['office']); ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> <?php echo $generalClass->getColumn('name', TBL_DIV, $userDtl['division']); ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Section :</b> <?php echo $generalClass->getColumn('name', TBL_SEC, $userDtl['section']); ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Last Login :</b> <?php echo date('jS F Y', strtotime($userDtl['last_login'])); ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Last Logout :</b> <?php echo date('jS F Y', strtotime($userDtl['last_logout'])); ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>Last Access IP :</b> <?php echo $userDtl['last_access_ip']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>No. of Logins :</b> <?php echo $userDtl['logins']; ?></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><b>user_status :</b> 
			<?php if($userDtl['user_status'] == '0'):?>
			<span class="label label-sm label-default arrowed-right">Invisible</span>
			<?php endif; ?>
			<?php if($userDtl['user_status'] == '1'):?>
			<span class="label label-sm label-success arrowed-right">Available</span>
			<?php endif; ?>
			<?php if($userDtl['user_status'] == '2'):?>
			<span class="label label-sm label-danger arrowed-right">Busy</span>
			<?php endif; ?>
		</li>
	</ul>
</div>
<div class="clearfix"></div>