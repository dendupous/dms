<?php
	$rId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$rdInfo = $generalClass->get(TBL_RECEIPT, $rId);
	foreach($rdInfo as $rDtls);
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
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> <?php echo $rDtls['fOffice']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> <?php echo $rDtls['fDept']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> <?php echo $rDtls['fDiv']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Place :</b> <?php echo $rDtls['fPlace']; ?></li>
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
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Office Name :</b> <?php echo $rDtls['rOffice']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Department :</b> 
						<?php echo $generalClass->getColumn('name', TBL_DEPT, $rDtls['rDept']); ?> - 
						<?php echo $generalClass->getColumn('description', TBL_DEPT, $rDtls['rDept']); ?>
					</li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Division :</b> 
						<?php echo $generalClass->getColumn('name', TBL_DIV, $rDtls['rDiv']); ?> - 
						<?php echo $generalClass->getColumn('description', TBL_DIV, $rDtls['rDiv']); ?>
					</li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Section :</b> 
						<?php echo $generalClass->getColumn('name', TBL_SEC, $rDtls['rSec']); ?> - 
						<?php echo $generalClass->getColumn('description', TBL_SEC, $rDtls['rSec']); ?>
					</li>
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
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Addressed To :</b> <?php echo $rDtls['addressedTo']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Letter Subject :</b> <?php echo $rDtls['fSubject']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Reference Number :</b> <?php echo $rDtls['fRefNum']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Copy To :</b> <?php echo $rDtls['fCopyTo']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Dak Number :</b> <?php echo $rDtls['recieptNum']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Date of Dispatch :</b> <?php echo $rDtls['dateOfReciept']; ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Time of Dispatch :</b> <?php echo date('jS F Y', strtotime($rDtls['timeOfReciept'])); ?></li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><b>Fiscal Year :</b> <?php echo $rDtls['fiscalYear']; ?></li>
				</ul>
			</div>
		</div><!-- /.widget-main -->
	</div><!-- /.widget-body -->
</div><!-- /.widget-box -->
<div class="clearfix"></div>