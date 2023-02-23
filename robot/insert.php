<?php
include('../config/lib/common.php');
date_default_timezone_set('Asia/Jakarta');
session_start();
$question       = $_POST["question"];
$answer         = $_POST["answer"];
$created_date   = date("Y-m-d H:i:s");
$created_by     = $_SESSION['id_user'];

$id_parent      = $_POST["id_parent"];

$sql = "INSERT INTO robot (question, answer, id_parent, id_ownership, created_by, created_date) 
            VALUES ('$question', '$answer', '$id_parent','$created_by','$created_by','$created_date')";
$db->query($sql);

?>
