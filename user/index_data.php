<?php
include '../config/lib/common.php';


 
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; 
$columnIndex = $_POST['order'][0]['column']; 
$columnName = $_POST['columns'][$columnIndex]['data']; 
$columnSortOrder = $_POST['order'][0]['dir']; 
$searchValue = $_POST['search']['value']; 

## Custom Field value
$searchByName = $_POST['searchByName'];
 


## Search 
$searchQuery = " ";

if($searchByName != ''){
    $searchQuery .= " and (name like '%".$searchByName."%' OR matrix_no like '%".$searchByName."%') ";
}
 


if($searchQuery == ""){
	$searchQuery = " and name='x'";
}


if($searchValue != ''){
	$searchQuery .= " and (name like '%".$searchValue."%' or 
    matrix_no like '%".$searchValue."%' or 
    rel_mat_no like'%".$searchValue."%' ) ";
}


## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from (
    SELECT u.id, p.name, u.image, p.email
    FROM `users` u 
    LEFT JOIN `profile` p ON p.id_user = u.id
    ) tbl");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from (
    SELECT u.id, p.name, u.image, p.email
    FROM `users` u 
    LEFT JOIN `profile` p ON p.id_user = u.id
    ) tbl WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from (
    SELECT u.id, p.name, u.image, p.email
    FROM `users` u 
    LEFT JOIN `profile` p ON p.id_user = u.id
    ) tbl WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "id"=>$row['id'],
        "name"=>ucwords(strtolower($row['name'])),  
        "image"=>$row['image'],
        "email"=>$row['email'],
		
    );
}
## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
