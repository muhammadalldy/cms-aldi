<?php
include '../config/lib/common.php';
session_start();

 
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
    $searchQuery .= " and (name like '%".$searchByName."%' OR username like '%".$searchByName."%') ";
}
 


if($searchQuery == ""){
	$searchQuery = " and name='x'";
}


if($searchValue != ''){
	$searchQuery .= " and (name like '%".$searchValue."%' or 
    username like '%".$searchValue."%' ) ";
}


## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from ( 
    SELECT u.id, p.name, u.image, p.email, u.username, f.approval_status
    FROM `users` u 
    LEFT JOIN `profile` p ON p.id_user = u.id
    LEFT JOIN `friend` f ON (f.id_requester = '".$_SESSION['id_user']."' AND u.id = f.id_approver)
    WHERE u.id!='".$_SESSION['id_user']."'  AND (f.approval_status IS NULL OR f.approval_status !='2' )
    ) tbl");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from (
    SELECT u.id, p.name, u.image, p.email, u.username, f.approval_status
    FROM `users` u 
    LEFT JOIN `profile` p ON p.id_user = u.id
    LEFT JOIN `friend` f ON (f.id_requester = '".$_SESSION['id_user']."' AND u.id = f.id_approver)
    WHERE u.id!='".$_SESSION['id_user']."' AND (f.approval_status IS NULL OR f.approval_status !='2' )
    ) tbl WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from (
    SELECT u.id, p.name, u.image, p.email, u.username, f.approval_status
    FROM `users` u 
    LEFT JOIN `profile` p ON p.id_user = u.id
    LEFT JOIN `friend` f ON (f.id_requester = '".$_SESSION['id_user']."' AND u.id = f.id_approver)
    WHERE u.id!='".$_SESSION['id_user']."' AND (f.approval_status IS NULL OR f.approval_status !='2' )
    ) tbl WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "id"=>$row['id'],
        "name"=>ucwords(strtolower($row['name'])),  
        "image"=>$row['image'],
        "email"=>$row['email'],
        "username"=>$row['username'],
        "approval_status"=>$row['approval_status'],
		
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
