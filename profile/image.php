<?php
include('../config/lib/common.php');
error_reporting(E_ERROR | E_PARSE);
//$sql="select mime_type, pic_contents from student_pic where matrix_no = '".addslashes($_GET['id'])."'";
 $sql="select mime_type, pic_contents from profile_pic where empid = '".addslashes($_GET['id'])."'";
$dbemppic=$db;
$dbemppic->query($sql);
$data = $dbemppic->fetchArray();
$mime_Type = $data["mime_type"];

if(!is_null($mime_Type)){
    header("Content-Type: $mime_Type");
    echo $data["pic_contents"];    
}


    
	 
?>