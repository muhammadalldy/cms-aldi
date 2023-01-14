<?php
	
	include('../config/lib/common.php');
	$id = $_POST["id"];
	$sql = "
			  SELECT p.bio FROM profile p WHERE p.id = '".$id."'	
			";
	$result = $db->query($sql);
	$rows_all = $result->fetchArray();
	
	$output['bio'] 	        = $rows_all['bio']; 


	echo json_encode($output);

?>