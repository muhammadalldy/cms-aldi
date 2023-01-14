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
                    <div class="row">

 
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

							$price = ($data['price']==0) ? "" : "Rp. ".number_format(($data['price']), 0, ',', ',');

						?>
                        <div class="col-xl-4">
                            <div class="card blog-horizontal">
                                <div class="card-body">
                                    <div class="card-img-actions mr-sm-3 mb-3 mb-sm-0">
                                        <a href="view.php?id=<?=$data['id']?>" >
                                            <img src="../files/thumbnail/<?=$data['thumbnail']?>" class="img-fluid card-img" alt="">
                                        </a>
                                    </div>

                                    <div class="mb-1">
                                        <h6 class="d-flex font-weight-semibold flex-nowrap my-1">
                                            <a href="view.php?id=<?=$data['id']?>" class="text-body mr-2"><?=$data['title']?></a>
                                        

                                            <span class="text-success ml-auto"><?=$price?></span>
                                        </h6>

                                        <!--ul class="list-inline list-inline-dotted text-muted mb-0"-->
                                            <!--li class="list-inline-item">By <a href="#" class="text-muted"><?=$data['teacher_name']?></a></li-->
                                            <!--li class="list-inline-item"><?=date("d M Y", strtotime($data['start_date']));?></li-->
                                        <!--/ul-->
                                    </div>
									<?php
										$maxLength = 100;
										$yourString = substr($data['overview'], 0, $maxLength);
										echo($yourString);
									?>

                                     <a href="view.php?id=<?=$data['id']?>">[...]</a>
                                </div>

                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <ul class="list-inline list-inline-dotted mb-0">
                                        <!--li class="list-inline-item"><i class="icon-users mr-2"></i> 382</li-->
                                        <li class="list-inline-item"><a href="#" style="color: #333"><?=$data['teacher_name']?></a></li>                                       
                                    </ul>

                                    <div class="mt-2 mt-sm-0">
										<!--a href="#">
											<i class="icon-checkmark3 font-size-base mr-2"></i> Take course
										</a-->
                                        <!--a href="#" style="color: #333">
											 Take Course
										</a-->
										<!--li class="list-inline-item">   
											<a href="#">
												Take Course
											</a>										
										</li-->
										<li class="list-inline-item"><i class="icon-users mr-2"></i> <?=$data['total_student']?></li>
									</div>
                                </div>
                            </div>
                        </div>


						<?php } ?>
 
                    </div>

                    <!-- /horizontal cards -->


                    <!-- Pagination -->
                    <!--div class="d-flex justify-content-center mt-3 mb-3">
                        <ul class="pagination">
                            <li class="page-item disabled"><a href="#" class="page-link"><i class="icon-arrow-left8"></i></a></li>
                            <li class="page-item active"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-right8"></i></a></li>
                        </ul>
                    </div-->
                    <!-- /pagination -->

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

</body>
</html>
