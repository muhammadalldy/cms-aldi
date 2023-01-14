 
 <?php  

include '../config/lib/common.php';
session_start();
if(!empty($_POST))  
{  
     $output = '';  
     $message = '';  

     if($_POST["modal_id_user"] != '')  
     {  
          $query = "  
          INSERT INTO friend
          SET 
          id_requester='".addslashes($_SESSION["id_user"])."',   
          id_approver='".addslashes($_POST["modal_id_user"])."',
          approval_status='9',
          first_req='".addslashes($_SESSION["id_user"])."',
          created_date=NOW()
          ";  
          mysqli_query($con, $query);

          $query = "  
          INSERT INTO friend
          SET 
          id_approver='".addslashes($_SESSION["id_user"])."',   
          id_requester='".addslashes($_POST["modal_id_user"])."',
          approval_status='1',
          first_req='".addslashes($_SESSION["id_user"])."',
          created_date=NOW()
          ";  
          mysqli_query($con, $query);


          echo json_encode($_POST);  
     }
}  
?>