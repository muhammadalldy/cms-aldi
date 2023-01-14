<?php
	
	include('../config/lib/common.php');
	$id = $_POST["id"];
	$sql = "
			  SELECT u.username, p.name, u.id 
              FROM users u
              LEFT JOIN profile p ON p.id_user = u.id
			  WHERE u.id = '".$id."'	
			";
	$result = $db->query($sql);
	$rows_all = $result->fetchArray();
	
	$output['id'] 	        = $rows_all['id'];
	$output['username'] 	= $rows_all['username'];
	$output['name'] 		= $rows_all['name'];


	echo json_encode($output);

?>