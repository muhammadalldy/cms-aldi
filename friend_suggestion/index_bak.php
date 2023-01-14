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
								<a href="#" class="breadcrumb-item active"> Friend</a>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<!--div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">
								<a href="#" class="breadcrumb-elements-item">
									<i class="icon-user-plus mr-2"></i>
									Add Course
								</a>

							</div>
						</div-->
					</div>
				</div>
				<!-- /page header -->
		

				<!-- Content area -->
				<div class="content">

					<!-- Search field -->
					<div class="card">
						<div class="card-body">
							<form action="#">
								<div class="d-sm-flex">
									<div class="form-group-feedback form-group-feedback-left flex-grow-1 mb-3 mb-sm-0">
										<input type="text" class="form-control form-control-lg" value="" placeholder="Search">
										<div class="form-control-feedback form-control-feedback-lg">
											<i class="icon-search4 text-muted"></i>
										</div>
									</div>

									<div class="ml-sm-3">
										<select class="custom-select custom-select-lg wmin-sm-200 mb-3 mb-sm-0">
											<option value="1">Getting started</option>
											<option value="2">Registration</option>
											<option value="3">General info</option>
											<option value="4">Your settings</option>
											<option value="5">Copyrights</option>
											<option value="6">Contacting sellers</option>
										</select>
									</div>

									<div class="ml-sm-3">
										<button type="submit" class="btn btn-primary btn-lg w-100 w-sm-auto">Search</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /search field -->


                    <div class="row">

                    <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="media-list">
                                        <li class="media font-weight-semibold py-1">My Friend</li>

                                        <li class="media">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <div class="media-title font-weight-semibold">James Alexander</div>
                                                <span class="text-muted">Development</span>
                                            </div>

                                            <div class="align-self-center ml-3">
                                                <div class="list-icons list-icons-extended">
                                                    <a href="#" class="list-icons-item" data-popup="tooltip" title="Chat" data-toggle="modal" data-trigger="hover" data-target="#chat"><i class="icon-comment"></i></a>
                                                </div>
                                            </div>
                                        </li>


                                    </ul>

                                    <br/>
                                    <!-- Pagination -->
                                    <!--div class="d-flex justify-content-center pt-3 mb-3">
                                        <ul class="pagination pagination-flat">
                                            <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-left8"></i></a></li>
                                            <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                                            <li class="page-item align-self-center"><span class="mx-2">...</span></li>
                                            <li class="page-item"><a href="#" class="page-link">58</a></li>
                                            <li class="page-item"><a href="#" class="page-link">59</a></li>
                                            <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-right8"></i></a></li>
                                        </ul>
                                    </div-->
                                    <!-- /pagination -->

                                </div> 
					        </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="media-list">
                                        <li class="media font-weight-semibold py-1">Friend Suggestion</li>

                                    <?php

                                        $sql = "
                                                SELECT u.id, p.name, u.id, u.image, p.bio 
                                                FROM users u
                                                LEFT JOIN profile p ON p.id_user = u.id
                                                WHERE u.id !='".$_SESSION['id_user']."'
                                            ";
                                        $datas = $db->query($sql)->fetchAll();
                                           

                                            ?>

                                            <?php foreach ($datas as $data) {  ?>
                                        <li class="media">
                                            <div class="mr-3">
                                                <a href="profile.php?id=<?=$data['id']?>">
                                                    <img src="../files/image/<?=$data['image']?>" class="rounded-circle" width="40" height="40" alt="">
                                                </a>
                                            </div>
                                            
                                            <div class="media-body">
                                            <a href="profile.php?id=<?=$data['id']?>">
                                                <div class="media-title font-weight-semibold"><?=$data['name']?></div>
                                                <span class="text-muted"><?=$data['bio']?></span>
                                                </a>
                                            </div>

                                            <div class="align-self-center ml-3">
                                                <div class="list-icons list-icons-extended">
                                                    <a href="#" class="list-icons-item" data-popup="tooltip" title="Add Friend" data-toggle="modal" data-trigger="hover" data-target="#add_friend"><i class="icon-user-plus"></i></a>
                                                    <a href="#" class="list-icons-item" data-popup="tooltip" title="Chat" data-toggle="modal" data-trigger="hover" data-target="#chat"><i class="icon-comment"></i></a>
                                                </div>
                                            </div>
                                        </li>

                                        <?php } ?>


                                    </ul>

                                    <br/>
                            

                                </div> 
					        </div>
                        </div>




                    </div>

			




				</div>
				<!-- /content area -->
               




				<?php include('../main_footer.php');?>

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->




 

	</div>
	<!-- /page content -->

</body>
</html>
