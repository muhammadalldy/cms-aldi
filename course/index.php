<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

 

if(isset($_POST["action"]) && $_POST["action"]=="submit_profile"){

	$sql = "
		   
			   UPDATE profile 
			   SET 
			   name='".addslashes($_POST['name'])."', 
			   address='".$_POST['address']."',
			   city='".$_POST['city']."',
			   state='".$_POST['state']."',
			   country='".$_POST['country']."',
			   email='".$_POST['email']."',
			   phone='".$_POST['phone']."',
			   zip_code='".$_POST['zip_code']."'
			   WHERE id_user='".$_SESSION['id_user']."'
		   "; 
   $db->query($sql);





   $image_size = $_FILES['image']['size'];
   if ($image_size > 0) {


	   //$date2 = date_format(Carbon::now(), "Ymd");
	   $date2       = date("YmdHis");
	
	   $filename = (basename($_FILES["image"]["name"]));
	   $filename = explode(".", $filename);
	   $ext 	  = $filename[1];
	   $filename = $filename[0];
	   $filename = $filename."_".$date2;
	   $filename = $filename.".".$ext;
	   $target_dir = "../files/image/";
	   $target_file = $target_dir . $filename;
	   $uploadOk = 1;
	   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	   
	   if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	   && $imageFileType != "gif") {
		   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		   $uploadOk = 0;
	   } else {
		   move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		   $sql	 		= "UPDATE users SET 
							   image = '$filename'
							   WHERE id='".$_SESSION['id_user']."'";
		   $db->query($sql);
	   }
   }
   














   echo("<script>window.location.href = '../profile'; </script>");
}

 

if(isset($_POST["action"]) && $_POST["action"]=="submit_account"){

	$sql = "
			   UPDATE 
			   users 
			   SET 
			   username='".$_POST['username']."', 
			   password='".md5($_POST['new_password'])."'
			   WHERE id='".$_SESSION['id_user']."'
		   ";



  $db->query($sql);
   echo("<script>window.location.href = '../profile'; </script>");
}


if(isset($_POST["action"]) && $_POST["action"]=="submit_bio"){

	$sql = "
			   UPDATE 
			   profile 
			   SET 
			   bio='".$_POST['bio']."'
			   WHERE id='".$_SESSION['id_user']."'
		   ";



  $db->query($sql);
   echo("<script>window.location.href = '../profile'; </script>");
}





if(isset($_POST["action"]) && $_POST["action"]=="submit_cover"){



	$image_size = $_FILES['cover']['size'];
	if ($image_size > 0) {
 
 
		//$date2 = date_format(Carbon::now(), "Ymd");
		$date2       = date("YmdHis");
	 
		$filename = (basename($_FILES["cover"]["name"]));
		$filename = explode(".", $filename);
		$ext 	  = $filename[1];
		$filename = $filename[0];
		$filename = $filename."_".$date2;
		$filename = $filename.".".$ext;
		$target_dir = "../files/cover/";
		$target_file = $target_dir . $filename;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		} else {
			move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);
			$sql	 		= "UPDATE users SET 
								cover = '$filename'
								WHERE id='".$_SESSION['id_user']."'";
			$db->query($sql);
		}
	}
	
 
	echo("<script>window.location.href = '../profile'; </script>");



}




$sql = "
	SELECT 
	ua.username, 
	ua.image,
	ua.cover,	
	p.name,
	p.bio,
	p.address,
	p.city,
	p.state,
	p.country,
	p.email,
	p.phone,
	p.zip_code
	FROM users ua
	LEFT JOIN profile p ON p.id_user = ua.id
	WHERE ua.id='".$_SESSION['id_user']."'
";
$data = $db->query($sql)->fetchArray();
?>
</head>

<body>


	<?php include('../main_navbar.php'); ?>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg  shadow-sm">

			<!-- Sidebar content -->
			<div class="sidebar-content">


                
                <?php include('../main_navigation.php');?>

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">




				<!-- Page header -->
				<div class="page-header page-header-light">


					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="index.php" class="breadcrumb-item active"> Course</a>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">
								<a href="index_add.php" class="breadcrumb-elements-item">
									<i class="icon-user-plus mr-2"></i>
									Add Course
								</a>

							</div>
						</div>
					</div>
				</div>
				<!-- /page header -->



                
                <!-- Content area -->
                <div class="content">

                    <!-- Horizontal cards -->
                    <div class="row"  id="myDIV">

						<?php

							$sql = "
								SELECT c.id, c.title, p.name as teacher_name, c.overview, c.start_date, c.price, c.thumbnail, count(st.id) as total_student
								FROM course c
								LEFT JOIN teacher t ON t.id_course = c.id
								LEFT JOIN `profile` p ON p.id_user = t.id_user
								LEFT JOIN `student` st ON st.id_course = c.id
								GROUP BY c.id
								";
							$datas = $db->query($sql)->fetchAll();

						?>
 
						<?php foreach ($datas as $data) {  ?>
						<?php
							$sql = "
							SELECT count(*) as total_dt FROM student WHERE id_user='".$_SESSION['id_user']."' AND id_course='".$data['id']."' 
							";
							$is_joined = $db->query($sql)->fetchArray();
							$is_joined = $is_joined['total_dt'];

							$sql = "
							SELECT count(*) as total_dt FROM course_detail WHERE id_course='".$data['id']."' 
							";
							$total_topic = $db->query($sql)->fetchArray();
							$total_topic = $total_topic['total_dt'];


							$sql = "
							SELECT count(*) as total_dt FROM course_reference WHERE id_course='".$data['id']."' 
							";
							$total_ebook = $db->query($sql)->fetchArray();
							$total_ebook = $total_ebook['total_dt'];

							 
						?>
                        <div class="col-xl-4">
                            <div class="card blog-horizontal">
                                <div class="card-body">
                                    <!--div class="card-img-actions mr-sm-3 mb-3 mb-sm-0">
                                        <a href="view.php?id=<?=$data['id']?>" >
                                            <img src="../files/thumbnail/<?=$data['thumbnail']?>" class="img-fluid card-img" alt="">
                                        </a>
                                    </div-->
                                    <div class="mb-1">
                                        <h7 class="d-flex font-weight-semibold flex-nowrap my-1">
                                            <a href="view.php?id=<?=$data['id']?>" class="text-body mr-2 content_title"><?=$data['title']?></a>
                                            <span class="text-success ml-auto"><?=$price?></span>
                                        </h7>
                                    </div>
									
									<?php
										$maxLength = 100;
										$yourString = substr($data['overview'], 0, $maxLength);
										echo($yourString);
									?>
									<a href="view.php?id=<?=$data['id']?>">
                                     </a>
                                </div>
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center" style="padding-top: 6px;padding-bottom: 6px;">
                                    <ul class="list-inline list-inline-dotted mb-0">

                                        <li class="list-inline-item">
											<?php if($is_joined == 1){?>
											<span class="badge badge-success">Taken</span>
											<?php } else {?>
												<!--span class="badge badge-success">Taken</span-->
											<?php } ?>

										</li>                                       

                                    </ul>
                                    <div class="mt-2 mt-sm-0">
										<li class="list-inline-item"><i class="icon-file-pdf mr-2"></i> <?=$total_ebook?></li>
										<li class="list-inline-item"><i class="icon-file-text2 mr-2"></i> <?=$total_topic?></li>
										<li class="list-inline-item"><i class="icon-users mr-2"></i> <?=$data['total_student']?></li>
									</div>
                                </div>
                            </div>
                        </div>


						<?php } ?>
 
                    </div>

                    <!-- /horizontal cards -->
 
                    </div>
                    <!-- /content area -->

	 



				<?php include('../main_footer.php');?>

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

		<?php include('index_right_sidebar.php');?>
 
 

	</div>
	<!-- /page content -->

<script>

$('#search_bar').keyup(function(){

	
		var value = $(this).val().toLowerCase();
        $("#myDIV .col-xl-4").filter(function () {
			$(this).toggle($(this).find('.card-body').text().toLowerCase().indexOf(value) > -1)
		}).fadeIn("slow");


});

$(document).on('change', 'input[name="course_owner"]:radio', function(){
	
	//var value = '<?=$_SESSION['username']?>';
	value = ($(this).val());

	if(value == "me"){
		console.log(value);
		$("#myDIV .col-xl-4").filter(function () {
			$(this).toggle($(this).find('.card-footer').text().toLowerCase().indexOf("taken") > -1)
		}).fadeIn("slow");	

	} else {
		console.log(value);

		$("#myDIV .col-xl-4").filter(function () {
			$(this).toggle($(this).find('.card-footer').text().toLowerCase().indexOf("") > -1)
		}).fadeIn("slow");	


	}

	//$("#myDIV .col-xl-6").filter(function () {
	//		$(this).toggle($(this).find('.card-body').text().toLowerCase().indexOf(value) > -1)
	//}).fadeIn("slow");	

});

</script>


</body>
</html>
