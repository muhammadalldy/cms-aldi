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
SELECT c.id, c.id as id_course, c.title, cd.title as topic_name, p.name as teacher_name, c.overview, c.start_date, c.objective, u.image as teacher_image,
p.bio as teacher_bio
FROM course c
LEFT JOIN course_detail cd ON cd.id_course = c.id
LEFT JOIN teacher t ON t.id_course = c.id
LEFT JOIN `profile` p ON p.id_user = t.id_user
LEFT JOIN `users` u ON p.id_user = u.id
WHERE cd.id='".$_GET['id']."'
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
								<a href="index.php" class="breadcrumb-item "> Course</a>
								<span class="breadcrumb-item "><a style="color: #333333" href="view.php?id=<?=$data['id_course'];?>"><?=$data['title'];?></a></span>
								<span class="breadcrumb-item active"><?=$data['topic_name'];?></span>
								
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>

						</div>

						<div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">
								<a href="#" class="breadcrumb-elements-item">
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

					<!-- Course overview -->
					<div class="card">
						<div class="card-header header-elements-lg-inline">
							<h5 class="card-title"><b><?=$data['title'];?></b> - <?=$data['topic_name'];?></h5>

							<div class="header-elements">
								<a href="view.php?id=<?=$data['id_course'];?>">[ back ]</a>
		                	</div>
						</div>

						<div class="nav-tabs-responsive bg-light border-top">
							<ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
								<li class="nav-item"><a href="#course-overview" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Overview</a></li>
								<li class="nav-item"><a href="#course-attendees" class="nav-link" data-toggle="tab"><i class="icon-people mr-2"></i> Attendees</a></li>
								<li class="nav-item"><a href="#course-schedule" class="nav-link" data-toggle="tab"><i class="icon-calendar3 mr-2"></i> Schedule</a></li>
							</ul>
						</div>

						<div class="tab-content">
							<div class="tab-pane fade show active" id="course-overview">
								<div class="card-body">
									<div class="mt-1 mb-3">
										<h6 class="font-weight-semibold">Course overview</h6>
										
                                        <?=$data['overview'];?>

                                        
									</div>

									<div class="mt-1 mb-3">
										<h6 class="font-weight-semibold">What you will learn</h6>
										
                                        <?=$data['objective'];?>

                                        
									</div>									

								 
				                    <h6 class="font-weight-semibold">Course program</h6>
									

 
									<table class="table datatable-responsive table-bordered table-hover table-striped">
										<thead>
											<tr>
												<th>Lessons</th>
												<th>Name</th>
												<th>Duration</th>
												<th>Status</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>

											<?php									
												$sql = "
													SELECT c.id, c.title, p.name as teacher_name, c.start_date, cd.objective,
													cd.title as course_title, cd.order_no, cd.duration,
													cd.start_date
													FROM course c
													LEFT JOIN course_detail cd ON cd.id_course = c.id
													LEFT JOIN teacher t ON t.id_course = c.id
													LEFT JOIN `profile` p ON p.id_user = t.id_user
													WHERE c.id='".$_GET['id']."'
													ORDER BY `order_no`
												";

												$courses = $db->query($sql)->fetchAll();
											?>
											<?php foreach ($courses as $course) { ?>
											<tr>
												<td><?=$course['order_no']?></td>
												<td><a href="#"><?=$course['course_title']?></a></td>
											
												<td><?=$course['duration']?> hours</td>
												<td><span class="badge badge-secondary">Closed</span></td>
												<td><?=date("d M Y", strtotime($course['start_date']));?></td>
											</tr>
											<?php } ?>
											
										</tbody>
									</table>
								 










                                    
								</div>


							</div>

							<div class="tab-pane fade" id="course-attendees">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Hanna Dorman</h6>
														<span class="text-muted">UX/UI designer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Benjamin Loretti</h6>
														<span class="text-muted">Network engineer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Vanessa Aurelius</h6>
														<span class="text-muted">Front end guru</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">William Brenson</h6>
														<span class="text-muted">Chief officer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">James Alexander</h6>
														<span class="text-muted">Lead developer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Nathan Jacobson</h6>
														<span class="text-muted">Lead UX designer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Margo Baker</h6>
														<span class="text-muted">Sales manager</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Barbara Walden</h6>
														<span class="text-muted">SEO specialist</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Lucy North</h6>
														<span class="text-muted">UX/UI designer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Vicky Barna</h6>
														<span class="text-muted">Network engineer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Hugo Bills</h6>
														<span class="text-muted">Front end guru</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Tony Gurrano</h6>
														<span class="text-muted">CEO and Founder</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Jeremy Victorino</h6>
														<span class="text-muted">Marketing specialist</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Monica Smith</h6>
														<span class="text-muted">Financial officer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Bastian Miller</h6>
														<span class="text-muted">Web developer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Jordana Mills</h6>
														<span class="text-muted">Designer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Buzz Brenson</h6>
														<span class="text-muted">Business developer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Zachary Willson</h6>
														<span class="text-muted">Network engineer</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">William Miles</h6>
														<span class="text-muted">Front end dev</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0">Freddy Walden</h6>
														<span class="text-muted">Marketing specialist</span>
													</div>

													<div class="ml-3 align-self-center">
														<div class="list-icons">
									                    	<div class="dropdown">
										                    	<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										                    	<div class="dropdown-menu dropdown-menu-right">
																	<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
																	<a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
																	<a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
																	<div class="dropdown-divider"></div>
																	<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
																</div>
									                    	</div>
								                    	</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="d-flex justify-content-center my-2">
										<ul class="pagination">
											<li class="page-item disabled"><a href="#" class="page-link"><i class="icon-arrow-left8"></i></a></li>
											<li class="page-item active"><a href="#" class="page-link">1</a></li>
											<li class="page-item"><a href="#" class="page-link">2</a></li>
											<li class="page-item"><a href="#" class="page-link">3</a></li>
											<li class="page-item"><a href="#" class="page-link">4</a></li>
											<li class="page-item"><a href="#" class="page-link">5</a></li>
											<li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-right8"></i></a></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="course-schedule">
								<div class="card-body">
									<div class="schedule"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- /course overview -->


					<!-- About author -->
					<div class="card">
						<div class="card-header header-elements-sm-inline">
							<h5 class="card-title">About the author</h5>

							<div class="header-elements">
								<div class="list-icons list-icons-extended">
			                    	<a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Google Drive"><i class="icon-google-drive"></i></a>
			                    	<a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Twitter"><i class="icon-twitter"></i></a>
			                    	<a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Github"><i class="icon-github"></i></a>
			                    	<a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Linked In"><i class="icon-linkedin"></i></a>
		                    	</div>
							</div>
						</div>

						<div class="media card-body flex-column flex-lg-row m-0">
							<div class="mr-lg-3 mb-2 mb-lg-0">
								<a href="#">
									<img src="../files/image/<?=$data['teacher_image'];?>" class="rounded-circle" width="64" height="64" alt="">
								</a>
							</div>

							<div class="media-body">
								<h6 class="media-title font-weight-semibold"><?=$data['teacher_name'];?></h6>
								<p><?=$data['teacher_bio'];?></p>

								<ul class="list-inline list-inline-dotted mb-0">
									<li class="list-inline-item"><a href="#">Author profile</a></li>
									<li class="list-inline-item"><a href="#">All courses by James</a></li>
									<li class="list-inline-item"><a href="#">https://website.com</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /about author -->


					<!-- Discussion -->
					<div class="card">
						<div class="card-header header-elements-sm-inline">
							<h6 class="card-title font-weight-semibold">Discussion</h6>
							<div class="header-elements">
								<ul class="list-inline list-inline-dotted text-muted mb-0">
									<li class="list-inline-item">42 comments</li>
									<li class="list-inline-item">75 pending review</li>
								</ul>
		                	</div>
						</div>

						<div class="card-body">
							<ul class="media-list">
								<li class="media flex-column flex-lg-row">
									<div class="mr-lg-3 mb-2 mb-lg-0">
										<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="38" height="38" alt=""></a>
									</div>

									<div class="media-body">
										<div class="media-title">
											<a href="#" class="font-weight-semibold">William Jennings</a>
											<span class="text-muted ml-3">Just now</span>
										</div>

										<p>He moonlight difficult engrossed an it sportsmen. Interested has all devonshire difficulty gay assistance joy. Unaffected at ye of compliment alteration to.</p>

										<ul class="list-inline list-inline-dotted font-size-sm">
											<li class="list-inline-item">114 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
											<li class="list-inline-item"><a href="#">Reply</a></li>
											<li class="list-inline-item"><a href="#">Edit</a></li>
										</ul>
									</div>
								</li>

								<li class="media flex-column flex-lg-row">
									<div class="mr-lg-3 mb-2 mb-lg-0">
										<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="38" height="38" alt=""></a>
									</div>

									<div class="media-body">
										<div class="media-title">
											<a href="#" class="font-weight-semibold">Margo Baker</a>
											<span class="text-muted ml-3">5 minutes ago</span>
										</div>

										<p>Place voice no arise along to. Parlors waiting so against me no. Wishing calling are warrant settled was luckily. Express besides it present if at an opinion visitor.</p>

										<ul class="list-inline list-inline-dotted font-size-sm">
											<li class="list-inline-item">90 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
											<li class="list-inline-item"><a href="#">Reply</a></li>
											<li class="list-inline-item"><a href="#">Edit</a></li>
										</ul>
									</div>
								</li>

								<li class="media flex-column flex-lg-row">
									<div class="mr-lg-3 mb-2 mb-lg-0">
										<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="38" height="38" alt=""></a>
									</div>

									<div class="media-body">
										<div class="media-title">
											<a href="#" class="font-weight-semibold">James Alexander</a>
											<span class="text-muted ml-3">7 minutes ago</span>
										</div>

										<p>Savings her pleased are several started females met. Short her not among being any. Thing of judge fruit charm views do. Miles mr an forty along as he.</p>

										<ul class="list-inline list-inline-dotted font-size-sm">
											<li class="list-inline-item">70 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
											<li class="list-inline-item"><a href="#">Reply</a></li>
											<li class="list-inline-item"><a href="#">Edit</a></li>
										</ul>

										<div class="media flex-column flex-lg-row">
											<div class="mr-lg-3 mb-2 mb-lg-0">
												<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="38" height="38" alt=""></a>
											</div>

											<div class="media-body">
												<div class="media-title">
													<a href="#" class="font-weight-semibold">Jack Cooper</a>
													<span class="text-muted ml-3">10 minutes ago</span>
												</div>

												<p>She education get middleton day agreement performed preserved unwilling. Do however as pleased offence outward beloved by present. By outward neither he so covered.</p>

												<ul class="list-inline list-inline-dotted font-size-sm">
													<li class="list-inline-item">67 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
													<li class="list-inline-item"><a href="#">Reply</a></li>
													<li class="list-inline-item"><a href="#">Edit</a></li>
												</ul>

												<div class="media flex-column flex-lg-row">
													<div class="mr-lg-3 mb-2 mb-lg-0">
														<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="38" height="38" alt=""></a>
													</div>

													<div class="media-body">
														<div class="media-title">
															<a href="#" class="font-weight-semibold">Natalie Wallace</a>
															<span class="text-muted ml-3">1 hour ago</span>
														</div>

														<p>Juvenile proposal betrayed he an informed weddings followed. Precaution day see imprudence sympathize principles. At full leaf give quit to in they up.</p>

														<ul class="list-inline list-inline-dotted font-size-sm">
															<li class="list-inline-item">54 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
															<li class="list-inline-item"><a href="#">Reply</a></li>
															<li class="list-inline-item"><a href="#">Edit</a></li>
														</ul>
													</div>
												</div>

												<div class="media flex-column flex-lg-row">
													<div class="mr-lg-3 mb-2 mb-lg-0">
														<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="38" height="38" alt=""></a>
													</div>

													<div class="media-body">
														<div class="media-title">
															<a href="#" class="font-weight-semibold">Nicolette Grey</a>
															<span class="text-muted ml-3">2 hours ago</span>
														</div>

														<p>Although moreover mistaken kindness me feelings do be marianne. Son over own nay with tell they cold upon are. Cordial village and settled she ability law herself.</p>

														<ul class="list-inline list-inline-dotted font-size-sm">
															<li class="list-inline-item">41 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
															<li class="list-inline-item"><a href="#">Reply</a></li>
															<li class="list-inline-item"><a href="#">Edit</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>

								<li class="media flex-column flex-lg-row">
									<div class="mr-lg-3 mb-2 mb-lg-0">
										<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="38" height="38" alt=""></a>
									</div>

									<div class="media-body">
										<div class="media-title">
											<a href="#" class="font-weight-semibold">Victoria Johnson</a>
											<span class="text-muted ml-3">3 hours ago</span>
										</div>

										<p>Finished why bringing but sir bachelor unpacked any thoughts. Unpleasing unsatiable particular inquietude did nor sir.</p>

										<ul class="list-inline list-inline-dotted font-size-sm">
											<li class="list-inline-item">32 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
											<li class="list-inline-item"><a href="#">Reply</a></li>
											<li class="list-inline-item"><a href="#">Edit</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</div>

						<div class="card-body">
							<div class="mb-3">
								<div id="add-comment">Get his declared appetite distance his together now families. Friends am himself at on norland it viewing. Suspected elsewhere you belonging continued commanded she...</div>
							</div>
							
							<div class="text-right">
								<button type="button" class="btn btn-primary"><i class="icon-plus22 mr-1"></i> Add comment</button>
							</div>
						</div>
					</div>
					<!-- /discussion -->

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
