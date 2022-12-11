<?php
	$dId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$author = $_SESSION['id'];
	
	$ddInfo = $generalClass->get(TBL_DISPATCH, $dId);
	foreach($ddInfo as $dDtls);
?>
<div class="clearfix"></div>
<div class="widget-box transparent">
	<div class="widget-header widget-header-flat">
		<h4 class="widget-title lighter">
			<i class="ace-icon fa fa-home green"></i> <b>From Details (Source)</b>
		</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main no-padding">
			<div>
				<ul class="list-unstyled spaced">
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> 
						<?php echo $generalClass->getColumn('name', TBL_OFFICE, $dDtls['fOffice']); ?> - 
						<?php echo $generalClass->getColumn('description', TBL_OFFICE, $dDtls['fOffice']); ?>
					</li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> 
						<?php echo $generalClass->getColumn('name', TBL_DEPT, $dDtls['fDept']); ?> - 
						<?php echo $generalClass->getColumn('description', TBL_DEPT, $dDtls['fDept']); ?>
					</li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> 
						<?php echo $generalClass->getColumn('name', TBL_DIV, $dDtls['fDiv']); ?> - 
						<?php echo $generalClass->getColumn('description', TBL_DIV, $dDtls['fDiv']); ?>
					</li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Section :</b> 
						<?php echo $generalClass->getColumn('name', TBL_SEC, $dDtls['fSec']); ?> - 
						<?php echo $generalClass->getColumn('description', TBL_SEC, $dDtls['fSec']); ?>
					</li>
				</ul>
			</div>
		</div><!-- /.widget-main -->
	</div><!-- /.widget-body -->
</div><!-- /.widget-box -->

<div class="widget-box transparent">
	<div class="widget-header widget-header-flat">
		<h4 class="widget-title lighter">
			<i class="ace-icon fa fa-bank orange"></i> <b>To Details (Destination)</b>
		</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main no-padding">
			<div>
				<ul class="list-unstyled spaced">
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> <?php echo $dDtls['rOffice']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> <?php echo $dDtls['rDept']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> <?php echo $dDtls['rDiv']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Place :</b> <?php echo $dDtls['rPlace']; ?></li>
				</ul>
			</div>
		</div><!-- /.widget-main -->
	</div><!-- /.widget-body -->
</div><!-- /.widget-box -->

<div class="widget-box transparent">
	<div class="widget-header widget-header-flat">
		<h4 class="widget-title lighter">
			<i class="ace-icon fa fa-bullseye"></i>
			<b>Letter Details</b>
		</h4>
	</div>

	<div class="widget-body">
		<div class="widget-main padding-4">
			<div>
				<ul class="list-unstyled spaced">
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Addressed To :</b> <?php echo $dDtls['adressedTo']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Subject :</b> <?php echo $dDtls['rSubject']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Reference Number :</b> <?php echo $dDtls['rRefNum']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Copy To :</b> <?php echo $dDtls['rCopyTo']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Dak Number :</b> <?php echo $dDtls['dispatchNum']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Date of Dispatch :</b> <?php echo date('jS F Y', strtotime($dDtls['dateOfIssue'])); ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Time of Dispatch :</b> <?php echo date('h:i A', strtotime($dDtls['timeOfIssue'])); ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Fiscal Year :</b> <?php echo $dDtls['fiscalYear']; ?></li>
					<?php 
						$rolesAssigned = $generalClass->getColumn('role', TBL_USER, $author);
						$uRolesInArray = explode(",", $rolesAssigned);
						foreach($uRolesInArray as $userRoles){
							if($userRoles == 3 || $userRoles == 11 || $userRoles == 12){
								$giveAccess = 1;
							}
						}
						if($giveAccess):
					?>
						<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Copy :</b> 
							<?php
								$day = date('d', strtotime($dDtls['dateOfIssue']));
								$month = date('m', strtotime($dDtls['dateOfIssue']));
								$year = date('Y', strtotime($dDtls['dateOfIssue']));
								$folderName = $year.$month.$day;
								$directoryPath = '../uploads/dispatchedLetter/'.$folderName.'/';
							?>
							
							<a href="../uploads/download.php?file=<?php echo $dDtls['filePath']; ?>&path=<?php echo $directoryPath; ?>" target="_blank" class="blue" title="Download File"><i class="ace-icon fa fa-download blue"></i> DOWNLOAD FILE</a>	
							&nbsp;&nbsp;&nbsp;<a href="<?php echo $directoryPath.$dDtls['filePath']; ?>" target="_blank" class="blue" title="View File"><i class="ace-icon fa fa-eye blue"></i> VIEW FILE</a>	
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div><!-- /.widget-main -->
	</div><!-- /.widget-body -->
</div><!-- /.widget-box -->
<div class="clearfix"></div>