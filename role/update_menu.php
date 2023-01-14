<?php
    include('../config/lib/common.php');
//    session_start();




    $sql = "DELETE FROM menu_role WHERE role_id='".$_GET['role_id']."'";
    $db->query($sql);
    foreach ($_POST['mergeDT'] as $data){

        $updated_date   = date("Y-m-d H:i:s");

        if ($data != "") {


            $sql = "
                    INSERT INTO menu_role 
                    SET menu_id='".$data."', 
                    role_id='".$_GET['role_id']."' ";
            $db->query($sql);

 
        }

    }




?>