<?php
	
	include('../config/lib/common.php');
	$id = $_POST["id"];
	$sql = "
			SELECT u.username, u.id, u.id as id_user, p.name, p.email, u.image, p.phone,
			p.pob, p.dob,
			p.zip_code, 
			p.country, 
			p.state,
			p.district,
			p.city,
			p.address_ic,
			p.address_now,
			p.district,
			p.sub_district			
			FROM users u
			LEFT JOIN profile p ON p.id_user = u.id
			WHERE u.id='".$id."'

			";
	$result = $db->query($sql);
	$rows_all = $result->fetchArray();
	$output['id_user'] 	= $rows_all['id_user']; 
	
	$output['username'] 	= $rows_all['username']; 
	$output['name'] 		= $rows_all['name'];
	$output['email'] 		= $rows_all['email'];
	$output['phone'] 		= $rows_all['phone'];
	$output['image'] 		= $rows_all['image'];

	$output['zip_code'] 		= $rows_all['zip_code'];
	$output['pob'] 		= $rows_all['pob'];
	$output['dob'] 		= $rows_all['dob'];

	$output['country'] 		= $rows_all['country'];
	$output['state'] 		= $rows_all['state'];
	$output['city'] 		= $rows_all['city'];
	$output['district'] 		= $rows_all['district'];
	$output['sub_district'] 		= $rows_all['sub_district'];

	$output['address_ic'] 		= $rows_all['address_ic'];
	$output['address_now'] 		= $rows_all['address_now'];

	echo json_encode($output);

?>