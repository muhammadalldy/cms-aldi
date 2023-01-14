 
 <?php  

 include '../config/lib/common.php';

 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  

      if($_POST["matrix_no"] != '')  
      {  
           $query = "  
           UPDATE student
           SET name='".addslashes($_POST["name"])."',   
           ic_passport='".addslashes($_POST["ic_passport"])."',   
           p_o_b='".addslashes($_POST["p_o_b"])."',   
           d_o_b = '".addslashes($_POST["d_o_b"])."', 
           xgender = '".addslashes($_POST["xgender"])."',   
           religion = '".addslashes($_POST["religion"])."', 
           national = '".addslashes($_POST["national"])."',   
           state_b = '".addslashes($_POST["state_b"])."',   
           city_b = '".addslashes($_POST["city_b"])."',   
           district_b = '".addslashes($_POST["district_b"])."',   
           address_aa = '".addslashes($_POST["address_aa"])."',   
           address_ba = '".addslashes($_POST["address_ba"])."', 
           id_concentration = '".addslashes($_POST["id_concentration"])."',   
           student_status = '".addslashes($_POST["student_status"])."',   
           mentor_id = '".addslashes($_POST["mentor_id"])."',   
           email = '".addslashes($_POST["email"])."',   
           is_foster = '".addslashes($_POST["is_foster"])."',   
           is_kip = '".addslashes($_POST["is_kip"])."',   
           handphone = '".addslashes($_POST["handphone"])."'  
           WHERE matrix_no='".$_POST["matrix_no"]."'";  
           $message = 'Data Updated';  
           $output .= '<label class="text-success">' . $message . '</label>';  
           mysqli_query($con, $query);
           echo json_encode($_POST);  
      }
 }  
 ?>