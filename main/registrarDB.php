<?php 
	$noOfVisitors = $generalClass->getAll(TBL_VISITOR);
	$numOfVisitors = sizeof($noOfVisitors);
	$todayDate = date('Y-m-d');
	$count = 0;
	foreach($noOfVisitors as $noOfV){
		$checkDate = date('Y-m-d', strtotime($noOfV['visit_date']));
		if($checkDate == $todayDate){
			$count += 1;
		}
	}
  
	$uRoles = $userDetails->role;							
	$uRolesInArray = explode(",", $uRoles);
	foreach($uRolesInArray as $userRoles){
		if($userRoles == 5){
			$giveAccessToRegisterCustomer = 1;
		}
		if($userRoles == 3 || $userRoles == 14){
			$giveAccessToODS = 1;
		}
	}
 if($userDetails->division > 20){
	include("../ods/dispatch_user_dashboard.php");
 
  }else{
	if($giveAccessToRegisterCustomer): 
?>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../visitor/addVisitor.php">
			<div class="circle-tile-heading dark-blue-custom">
				<i class="fa fa-user-plus fa-fw fa-3x"></i>
			</div>
		</a>
		<div class="circle-tile-content dark-blue-custom">
			<div class="circle-tile-description text-faded">
				Visitors
			</div>
			<div class="circle-tile-number text-faded">
				<?php
					echo $count;
				?>
				<span id="sparklineA"></span>
			</div>
			<a href="../visitor/addVisitor.php" class="circle-tile-footer">Add New <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>
<?php endif; ?>
<?php	
	if($giveAccessToODS): 
?>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../ods/">
			<div class="circle-tile-heading dark-blue-custom">
				<i class="fa fa-envelope-o fa-fw fa-3x"></i>
			</div>
		</a>
		<div class="circle-tile-content dark-blue-custom">
			<div class="circle-tile-description text-faded">
				Online Dispatch/Receive
			</div>
			<div class="circle-tile-number text-faded">
				ODS
				<span id="sparklineA"></span>
			</div>
			<a href="../ods/" class="circle-tile-footer">Dispatch/Recieve <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>
<?php endif; ?>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../visitor/">
			<div class="circle-tile-heading green-custom">
				<i class="fa fa-users fa-fw fa-3x"></i>
			</div>
		</a>
		<div class="circle-tile-content green-custom">
			<div class="circle-tile-description text-faded">
				Visitors
			</div>
			<div class="circle-tile-number text-faded">
				<?php echo $count; ?>
			</div>
			<a href="../visitor/" class="circle-tile-footer">View All <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../user/notifications.php">
			<div class="circle-tile-heading orange-custom">
				<i class="fa fa-bell-o fa-fw fa-3x icon-animated-bell"></i>
			</div>
		</a>
		<div class="circle-tile-content orange-custom">
			<div class="circle-tile-description text-faded">
				Alerts
			</div>
			<div class="circle-tile-number text-faded">
				<?php echo ($numOfNotify > 0)?$numOfNotify:"0";?>
			</div>
			<a href="../user/notifications.php" class="circle-tile-footer">View All <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../user/tasks.php">
			<div class="circle-tile-heading blue-custom">
				<i class="fa fa-tasks fa-fw fa-3x"></i>
			</div>
		</a>
		<div class="circle-tile-content blue-custom">
			<div class="circle-tile-description text-faded">
				Tasks
			</div>
			<div class="circle-tile-number text-faded">
				<?php echo ($numOfTasks > 0)?$numOfTasks:"0";?>
				<span id="sparklineB"></span>
			</div>
			<a href="../user/tasks.php" class="circle-tile-footer">View All <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>

<?php if($userDetails->division < 20){?>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../visitor/trackService.php">
			<div class="circle-tile-heading red-custom">
				<i class="fa fa-search fa-fw fa-3x"></i>
			</div>
		</a>
		<div class="circle-tile-content red-custom">
			<div class="circle-tile-description text-faded">
				Track
			</div>
			<div class="circle-tile-number text-faded">
				<?php echo $numOfVisitors; ?>
				<span id="sparklineC"></span>
			</div>
			<a href="../visitor/trackService.php" class="circle-tile-footer">Track Service <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../user/inbox.php">
			<div class="circle-tile-heading purple-custom">
				<i class="fa fa-comments-o fa-fw fa-3x icon-animated-vertical"></i>
			</div>
		</a>
		<div class="circle-tile-content purple-custom">
			<div class="circle-tile-description text-faded">
				Messages
			</div>
			<div class="circle-tile-number text-faded">
				<?php echo ($numOfMsgs > 0)?$numOfMsgs:"0";?>
				<span id="sparklineD"></span>
			</div>
			<a href="../user/inbox.php" class="circle-tile-footer">View All <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>
<?php }?>
<?php
	$accountsUsers = $generalClass->getAll(TBL_AFD);
	$aUsers = array();
	foreach($accountsUsers as $accountsUser){
		array_push($aUsers, $accountsUser['user_id']);
	}
	$loginID = $_SESSION['id'];
	if(in_array($loginID, $aUsers)):
	
	$paymentRequired = $generalClass->getPendingTADAPayment(TBL_TRAVELA);
	$paymentRequiredCount = sizeof($paymentRequired);
?>
<div class="col-lg-2 col-sm-6">
	<div class="circle-tile">
		<a href="../otada/pendingTADAClaimPayment.php">
			<div class="circle-tile-heading orange-custom">
				<i class="fa fa-money fa-fw fa-3x"></i>
			</div>
		</a>
		<div class="circle-tile-content orange-custom">
			<div class="circle-tile-description text-faded">
				TADA Claims
			</div>
			<div class="circle-tile-number text-faded">
				<?php echo ($paymentRequiredCount > 0)?$paymentRequiredCount:"0";?>
			</div>
			<a href="../otada/pendingTADAClaimPayment.php" class="circle-tile-footer">View All <i class="fa fa-chevron-circle-right"></i></a>
		</div>
	</div>
</div>
<?php endif; }?>