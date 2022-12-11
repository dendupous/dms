<?php
	include("../includes/config.php");
	$deptID = $_GET['choice'];
	
	$db = getDB();
	$stmt = $db->prepare("SELECT * FROM sys_divisions WHERE department=:dID"); 
	$stmt->bindParam("dID", $deptID,PDO::PARAM_INT) ;
	$stmt->execute();
	$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<option value="">Select Division</option>
<?php 
	foreach ($datas as $data):
?>      
	<option value="<?php echo $data['id']; ?>"><?php echo $data['name'].' - '.$data['description']; ?></option>
<?php 
	endforeach;  
?>