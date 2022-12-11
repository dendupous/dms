<?php
	$recId = $_GET['id'];
	
	include("../includes/config.php");
	include('../includes/userClass.php');
	include('../includes/generalClass.php');
	
	$userClass = new userClass();
	$generalClass = new generalClass();
	
	$recInfo = $generalClass->get(TBL_DISPATCH, $recId);
	foreach($recInfo as $recDtls); extract($recDtls);
?>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 col-sm-12">
	<form class="form-horizontal" action="../includes/process.php" method="post"  id="genericFormForAll" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group">
				<label class="col-sm-3 col-md-4 col-lg-2 control-label">Remarks</label>  
				<div class="col-sm-9 col-md-8 col-lg-10 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
						<textarea name="fRemarks" id="fRemarks" placeholder="Write your remarks here." class="form-control" required /></textarea>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-3 col-md-4 col-lg-2 control-label"></label>
				<div class="col-sm-9 col-md-8 col-lg-10">
					<div class="pull-right">
						<input type="hidden" name="disID" value="<?php echo $id; ?>">
						<a href="" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
						<button type="submit" class="btn btn-success" name="forwardDispactchToAll">Forward <span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
		$(document).ready(function () {
		var validator = $("#genericFormForAll").bootstrapValidator({
			framework: 'bootstrap',
			excluded: ':disabled',
			fields : {
				fRemarks :{
					validators : {
						notEmpty : {
							message : "Please Enter the remarks."
						}
					}
				},
			}
		});				
	});
</script>