 
 <?php  

include '../config/lib/common.php';
session_start();
if(!empty($_POST))  
{  
     $output = '';  
     $message = '';  

     if($_POST["modal_id_user2"] != '')  
     {  
        $query = "  
        UPDATE friend
        SET 
        approval_status='2',
        approved_date=NOW()
        WHERE
        id_requester='".addslashes($_SESSION["id_user"])."' AND
        id_approver='".addslashes($_POST["modal_id_user2"])."'
        ";  
        mysqli_query($con, $query);

        $query = "  
        UPDATE friend
        SET 
        approval_status='2',
        approved_date=NOW()
        WHERE
        id_approver='".addslashes($_SESSION["id_user"])."' AND
        id_requester='".addslashes($_POST["modal_id_user2"])."'
        ";  
        mysqli_query($con, $query);

          echo json_encode($_POST);  
     }
}  
?>