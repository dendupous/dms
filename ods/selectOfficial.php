<?php
	include("../includes/config.php");
	$secID = $_GET['choice'];
	
	$db = getDB();
	$stmt = $db->prepare("SELECT * FROM sys_users WHERE section=:dID AND status='1'"); 
	$stmt->bindParam("dID", $secID,PDO::PARAM_INT) ;
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //User data
?>
<option value="">Select Official</option>
<?php 
	foreach ($data as $datas):
?>      
	<option value="<?php echo $datas['id']; ?>"><?php echo $datas['name'].' - '.$datas['designation']; ?></option>
<?php endforeach;  ?>

