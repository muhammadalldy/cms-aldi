 
 <?php  

 include '../config/lib/common.php';

 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  

      if($_POST["id_user"] != '')  
      {  
 


           $query = "
           UPDATE profile 
           SET 
           name='".addslashes($_POST['name'])."', 
           address_ic='".addslashes($_POST['address_ic'])."',
           address_now='".addslashes($_POST['address_now'])."',
           city='".addslashes($_POST['city'])."',
           pob='".addslashes($_POST['pob'])."',
           dob='".addslashes($_POST['dob'])."',
           state='".addslashes($_POST['state'])."',
           country='".addslashes($_POST['country'])."',
           email='".addslashes($_POST['email'])."',
           phone='".addslashes($_POST['phone'])."',
           district='".addslashes($_POST['district'])."',
           sub_district='".addslashes($_POST['sub_district'])."',
           zip_code='".addslashes($_POST['zip_code'])."'
           WHERE id_user='".$_POST['id_user']."'
      "; 

           $message = 'Data Updated';  
           $output .= '<label class="text-success">' . $message . '</label>';  
           mysqli_query($con, $query);
           echo json_encode($_POST);  
      }
 }  
 ?>