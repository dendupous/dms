<?php
	include("../includes/config.php");
	$divisionID = $_GET['choice'];
	
	$db = getDB();
	$stmt = $db->prepare("SELECT * FROM sys_sections WHERE division=:dID"); 
	$stmt->bindParam("dID", $divisionID,PDO::PARAM_INT) ;
	$stmt->execute();
	$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<option value="">Select Section</option>
<?php 
	foreach ($datas as $data):
?>      
	<option value="<?php echo $data['id']; ?>"><?php echo $data['name'].' - '.$data['description']; ?></option>
<?php 
	endforeach;  
?>