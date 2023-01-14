<?php
	
	include('../config/lib/common.php');
	$id = $_POST["id"];
	$sql = "
			SELECT u.username, u.id, p.name, p.email 
			FROM users u
			LEFT JOIN profile p ON p.id_user = u.id
			WHERE u.id='".$id."'

			";
	$result = $db->query($sql);
	$rows_all = $result->fetchArray();
	
	$output['username'] 	= $rows_all['username']; 
	$output['name'] 		= $rows_all['name'];
	$output['email'] 		= $rows_all['email'];

	echo json_encode($output);

?>