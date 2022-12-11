<?php
	include("../includes/config.php");
	$officeID = $_GET['choice'];
	
	$db = getDB();
	$stmt = $db->prepare("SELECT * FROM sys_departments WHERE office=:dID"); 
	$stmt->bindParam("dID", $officeID,PDO::PARAM_INT) ;
	$stmt->execute();
	$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<option value="">Select Department</option>
<?php 
	foreach ($datas as $data):
?>      
	<option value="<?php echo $data['id']; ?>"><?php echo $data['name'].' - '.$data['description']; ?></option>
<?php 
	endforeach;  
?>