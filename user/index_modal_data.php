<?php
	
	include('../config/lib/common.php');
	$id = $_POST["id"];
	$sql = "
			SELECT u.username, u.id, p.name, p.email, u.image,
			p.pob, p.dob
			FROM users u
			LEFT JOIN profile p ON p.id_user = u.id
			WHERE u.id='".$id."'

			";
	$result = $db->query($sql);
	$rows_all = $result->fetchArray();
	
	$output['username'] 	= $rows_all['username']; 
	$output['name'] 		= $rows_all['name'];
	$output['email'] 		= $rows_all['email'];
	$output['image'] 		= $rows_all['image'];

	$output['pob'] 		= $rows_all['pob'];
	$output['dob'] 		= $rows_all['dob'];

	echo json_encode($output);

?>