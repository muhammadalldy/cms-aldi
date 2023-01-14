<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

 if($_GET['id'] ==''){
	$_GET['id'] = $_SESSION['id_user']; 
	$is_editable = 1;
} else {
	$is_editable = 0;
}
 
if(isset($_POST["action"]) && $_POST["action"]=="submit_profile"){

	$sql = "
		   
			   UPDATE profile 
			   SET 
			   name='".addslashes($_POST['name'])."', 
			   address='".addslashes($_POST['address'])."',
			   city='".addslashes($_POST['city'])."',
			   state='".addslashes($_POST['state'])."',
			   country='".addslashes($_POST['country'])."',
			   email='".addslashes($_POST['email'])."',
			   phone='".addslashes($_POST['phone'])."',
			   zip_code='".addslashes($_POST['zip_code'])."'
			   WHERE id_user='".$_SESSION['id_user']."'
		   "; 
   $db->query($sql);



$sql = "
   UPDATE 
   users 
   SET 
   username='".addslashes($_POST['username'])."'
   WHERE id='".$_SESSION['id_user']."'
";

$db->query($sql);

	$_SESSION['username'] = addslashes($_POST['username']);



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
			   WHERE id_user='".$_SESSION['id_user']."'
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
	p.zip_code,
	f.approval_status
	FROM users ua
	LEFT JOIN profile p ON p.id_user = ua.id
	LEFT JOIN `friend` f ON (f.id_requester = '".$_SESSION['id_user']."' AND ua.id = f.id_approver)
	WHERE ua.id='".$_GET['id']."'
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
								<a href="../friend_suggestion" class="breadcrumb-item">Friend</a>
                                <span class="breadcrumb-item active"><?=$data['name']?><?php echo('&nbsp;');?></span>
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
						 

				<!-- Cover area -->
				<div class="profile-cover">
					<div class="profile-cover-img" style="background-image: url(../files/cover/<?=$data['cover']?>)"></div>
					<div class="media align-items-center text-center text-lg-left flex-column flex-lg-row m-0">
						<div class="mr-lg-3 mb-2 mb-lg-0">
							<a href="#" class="profile-thumb">
								<img src="../files/image/<?=$data['image']?>" class="border-white rounded-circle" width="48" height="48" alt="">
							</a>
						</div>

						<div class="media-body text-white">
				    		<h1 class="mb-0"><?=$data['name']?></h1>
				    		<span class="d-block"><?=$data['bio']?></span>
						</div>
						<div class="ml-lg-3 mt-2 mt-lg-0">
							<ul class="list-inline list-inline-condensed mb-0">
								<?php if($is_editable == 1){ ?>
									<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent" data-toggle="modal" data-target="#modal_cover_image"><i class="icon-file-picture mr-2"></i> Cover image</a></li>
									<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent" data-toggle="modal" data-target="#modal_bio" ><i class="icon-file-stats mr-2"></i> Biography</a></li>
								<?php } else {?>

									<?php
										$sql = "
											SELECT count(*) as total_data 
											FROM friend 
											WHERE id_requester='".$_SESSION['id_user']."'
											AND id_approver='".$_GET['id']."'
											
										"; 
										$friendcheck = $db->query($sql)->fetchArray();
									
										?>
									<?php if($data['approval_status'] == null){ ?>
										<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent edit_data" id="<?=$_GET['id']?>" data-toggle="modal" data-target="#modal_addfriend" ><i class="icon-user-plus mr-2"></i> Add Friend</a></li>
									<?php } elseif($data['approval_status'] == '9'){ ?>
										<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent disabled" ><i class="icon-user-plus mr-2"></i> Friend Request has Been Sent</a></li>
									<?php } elseif($data['approval_status'] == '1'){ ?>
										<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent confirm_data" id="<?=$_GET['id']?>"  data-toggle="modal" data-target="#modal_confirmfriend" ><i class="icon-user-plus mr-2"></i> Confirm Friend</a></li>
									<?php } elseif($data['approval_status'] == '2'){ ?>
										<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent edit_data" id="<?=$_GET['id']?>" ><i class="icon-envelope mr-2"></i> Direct Message</a></li>
									<?php } else {?> 
									<?php } ?> 

								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<!-- /cover area -->


				<!-- Profile navigation -->
				<div class="navbar navbar-expand-lg navbar-light">
					<div class="text-center d-lg-none w-100">
						<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-second">
							<i class="icon-menu7 mr-2"></i>
							Profile navigation
						</button>
					</div>

					<div class="navbar-collapse collapse" id="navbar-second">
						<ul class="nav navbar-nav">
							<li class="nav-item">
								<a href="#activity" class="navbar-nav-link active" data-toggle="tab">
									<i class="icon-menu7 mr-2"></i>
									Activity
								</a>
							</li>

							<li class="nav-item">
								<a href="#profile" class="navbar-nav-link" data-toggle="tab">
									<i class="icon-user mr-2"></i>
									Profile
								</a>
							</li>

							<li class="nav-item">
								<a href="#schedule" class="navbar-nav-link" data-toggle="tab">
									<i class="icon-collaboration mr-2"></i>
									Friend
									<!--span class="badge badge-success badge-pill position-static align-top ml-auto ml-lg-2">32</span-->
								</a>
							</li>

						</ul>

						<ul class="navbar-nav ml-lg-auto">
							<li class="nav-item">
								<a href="#" class="navbar-nav-link">
									<i class="icon-stack-text mr-2"></i>
									Notes
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="navbar-nav-link">
									<i class="icon-collaboration mr-2"></i>
									Friends
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="navbar-nav-link">
									<i class="icon-images3 mr-2"></i>
									Photos
								</a>
							</li>
							<li class="nav-item dropdown">
								<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear"></i>
									<span class="d-lg-none ml-2">Settings</span>
								</a>

								<div class="dropdown-menu dropdown-menu-right">
									<a href="#" class="dropdown-item"><i class="icon-image2"></i> Update cover</a>
									<a href="#" class="dropdown-item"><i class="icon-clippy"></i> Update info</a>
									<a href="#" class="dropdown-item"><i class="icon-make-group"></i> Manage sections</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item"><i class="icon-three-bars"></i> Activity log</a>
									<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Profile settings</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- /profile navigation -->


				<!-- Content area -->
				<div class="content">

					<!-- Inner container -->
					<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

						<!-- Left content -->
						<div class="tab-content w-100 order-2 order-lg-1">
							<div class="tab-pane fade active show" id="activity">





							<!-- Share your thoughts -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h6 class="card-title">Share your thoughts</h6>

									<div class="header-elements">
										<div class="list-icons">
					                    	<div class="dropdown">
						                    	<a href="#" class="list-icons-item" data-toggle="dropdown">
						                    		<i class="icon-arrow-down12"></i>
					                    		</a>

						                    	<div class="dropdown-menu dropdown-menu-right">
													<a href="#" class="dropdown-item"><i class="icon-popout"></i> Notifications</a>
													<a href="#" class="dropdown-item"><i class="icon-embed"></i> Embed video</a>
													<a href="#" class="dropdown-item"><i class="icon-pin-alt"></i> Show location</a>
													<div class="dropdown-divider"></div>
													<a href="#" class="dropdown-item"><i class="icon-cog3"></i> Settings</a>
												</div>
					                    	</div>
				                    	</div>
									</div>
								</div>

								<div class="card-body">
									<form action="#">
				                    	<textarea name="enter-message" class="form-control mb-3" rows="4" cols="1" placeholder="Enter your message..."></textarea>

				                    	<div class="d-flex align-items-center">
											<div class="d-inline-flex">
												<a href="#" class="btn btn-light btn-icon btn-sm border-transparent rounded-pill mr-2" data-popup="tooltip" title="Add photo"><i class="icon-images2 position-static"></i></a>
												<a href="#" class="btn btn-light btn-icon btn-sm border-transparent rounded-pill mr-2" data-popup="tooltip" title="Add video"><i class="icon-film2 position-static"></i></a>
												<a href="#" class="btn btn-light btn-icon btn-sm border-transparent rounded-pill mr-2" data-popup="tooltip" title="Add event"><i class="icon-calendar2 position-static"></i></a>
											</div>

				                    		<button type="button" class="btn btn-primary btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> Share</button>
				                    	</div>
									</form>
								</div>
							</div>
							<!-- /share your thoughts -->







								<!-- Sales stats -->
								<div class="card">
									<div class="card-header header-elements-sm-inline">
										<h6 class="card-title">Activity</h6>
										<div class="header-elements">
											<span><i class="icon-history mr-2 text-success"></i> Updated 3 hours ago</span>

											<div class="list-icons ml-3">
						                		<a class="list-icons-item" data-action="reload"></a>
						                	</div>
					                	</div>
									</div>

									<div class="card-body">





ddd


									
									</div>
								</div>
								<!-- /sales stats -->




						    </div>

						    <div class="tab-pane fade" id="schedule">

					    		


								<!-- Schedule -->
								<div class="card">
									<div class="card-header">
										<h6 class="card-title">Friend</h6>
									</div>

									<div class="card-body">
										<div class="my-schedule"></div>
									</div>
								</div>
								<!-- /schedule -->

					    	</div>

						    <div class="tab-pane fade" id="profile">

								<!-- Profile info -->
								<div class="card">
									<div class="card-header">
										<h6 class="card-title">Profile information</h6>
									</div>

									<div class="card-body">
										<form action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
											<input type="hidden" name="action" value="submit_profile"> 
											<div class="form-group">
												<div class="row">
													<div class="col-lg-6">
														<label>Username</label>
														<input type="text" name="username" value="<?=$data['username'];?>" class="form-control">
													</div>
													<div class="col-lg-6">
														<label>Full name </label>
														<input type="text" name="name" value="<?=$data['name'];?>" class="form-control">
													</div>
												</div>
											</div>



											<div class="form-group">
												<div class="row">


													<div class="col-lg-4">
							                            <label>Country</label>
							                            <select name="country"  class="custom-select">
							                                <?=dd_menu('region', 'id_wil', 'nm_wil', 'WHERE id_level_wil=0' ,'ASC', $data['country'])?>
							                            </select>
													</div>
													<div class="col-lg-4">
														<label>State/Province</label>
							                            <select name="state"  class="custom-select">
							                                <?=dd_menu('region', 'id_wil', 'nm_wil', 'WHERE id_level_wil=1' ,'ASC', $data['state'])?>
							                            </select> 
													</div>
													<div class="col-lg-4">
														<label>City</label>
							                            <select name="city"  class="custom-select">
							                                <?=dd_menu('region', 'id_wil', 'nm_wil', 'WHERE id_level_wil=2' ,'ASC', $data['city'])?>
							                            </select>

													</div>


												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-lg-12">
														<label>Address line</label>
														<input type="text" name="address" value="<?=$data['address'];?>" class="form-control">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-lg-6">
														<label>Email</label>
														<input type="text" name="email" value="<?=$data['email'];?>"  class="form-control">
													</div>
													<div class="col-lg-6">
														<label>ZIP code</label>
														<input type="text" name="zip_code" value="<?=$data['zip_code'];?>" class="form-control">
													</div>
												</div>
											</div>

					                        <div class="form-group">
					                        	<div class="row">
					                        		<div class="col-lg-6">
														<label>Phone #</label>
														<input type="text" name="phone" value="<?=$data['phone'];?>" class="form-control">
														<span class="form-text text-muted">+99-99-9999-9999</span>
					                        		</div>

													<div class="col-lg-6">
														<label>Upload profile image</label>
														<div class="custom-file">
															<input type="file"  name="image"  class="custom-file-input" id="customFile">
															<label class="custom-file-label" for="customFile">Choose file</label>
														</div>
					                                    <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
													</div>
					                        	</div>
					                        </div>
											<?php if($is_editable == 1){ ?>
					                        <div class="text-right">
					                        	<button type="submit" class="btn btn-primary">Save changes</button>
					                        </div>
											<?php } ?>
										</form>
									</div>
								</div>
								<!-- /profile info -->


								<!-- Account settings -->
								<div class="card">
									<div class="card-header">
										<h6 class="card-title">Account settings</h6>
									</div>

									<div class="card-body">
										<form action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
											<input type="hidden" name="action" value="submit_account">
											<div class="form-group">
												<div class="row">
													<div class="col-lg-6">
														<label>Username</label>
														<input type="text" name="username" value="<?=$data['username'];?>" class="form-control">
													</div>

													<div class="col-lg-6">
														<label>Current password</label>
														<input type="password" name="current_password" class="form-control" placeholder="Enter current password">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-lg-6">
														<label>New password</label>
														<input type="password" name="new_password" placeholder="Enter new password" class="form-control" required>
													</div>

													<div class="col-lg-6">
														<label>Repeat password</label>
														<input type="password" name="repeat_password" placeholder="Repeat new password" class="form-control">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-lg-6">
														<label>Profile visibility</label>

														<label class="custom-control custom-radio mb-2">
															<input type="radio" name="visibility" class="custom-control-input" checked>
															<span class="custom-control-label">Visible to everyone</span>
														</label>

														<label class="custom-control custom-radio mb-2">
															<input type="radio" name="visibility" class="custom-control-input">
															<span class="custom-control-label">Visible to friends only</span>
														</label>

														<label class="custom-control custom-radio mb-2">
															<input type="radio" name="visibility" class="custom-control-input">
															<span class="custom-control-label">Visible to my connections only</span>
														</label>

														<label class="custom-control custom-radio">
															<input type="radio" name="visibility" class="custom-control-input">
															<span class="custom-control-label">Visible to my colleagues only</span>
														</label>
													</div>

													<div class="col-lg-6">
														<label>Notifications</label>

														<label class="custom-control custom-checkbox mb-2">
															<input type="checkbox" class="custom-control-input" checked>
															<span class="custom-control-label">Password expiration notification</span>
														</label>

														<label class="custom-control custom-checkbox mb-2">
															<input type="checkbox" class="custom-control-input" checked>
															<span class="custom-control-label">New message notification</span>
														</label>

														<label class="custom-control custom-checkbox mb-2">
															<input type="checkbox" class="custom-control-input" checked>
															<span class="custom-control-label">New task notification</span>
														</label>

														<label class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input">
															<span class="custom-control-label">New contact request notification</span>
														</label>
													</div>
												</div>
											</div>
											<?php if($is_editable == 1){ ?>
					                        <div class="text-right">
					                        	<button type="submit" class="btn btn-primary">Save changes</button>
					                        </div>
											<?php } ?>
				                        </form>
									</div>
								</div>
								<!-- /account settings -->

					    	</div>
						</div>
						<!-- /left content -->


						<!-- Right sidebar component -->
						<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-none order-1 order-lg-2 sidebar-expand-lg">

							<!-- Sidebar content -->
							<div class="sidebar-content">

								<!-- Navigation -->
								<div class="card">
									<div class="card-header bg-transparent">
										<span class="card-title font-weight-semibold">My Study</span>
									</div>

									<ul class="nav nav-sidebar">

										<?php

										$sql = "
											SELECT c.id, c.title, p.name as teacher_name, c.overview, c.start_date, c.price, c.thumbnail
											FROM course c
											LEFT JOIN teacher t ON t.id_course = c.id
											LEFT JOIN `profile` p ON p.id_user = t.id_user
											LEFT JOIN `student` st ON st.id_course = c.id
											WHERE st.id_user = '".$_GET['id']."'
											";
										$datas = $db->query($sql)->fetchAll();

										?>

										<?php foreach ($datas as $data) {  ?>

										<li class="nav-item">
											<a href="#" class="nav-link">
												 <?=$data['title']?>
											</a>
										</li>

										<?php } ?>
									
									</ul>
								</div>
								<!-- /navigation -->



								<!-- Navigation -->
								<div class="card">
									<div class="card-header bg-transparent">
										<span class="card-title font-weight-semibold">My Teaching</span>
									</div>

									<ul class="nav nav-sidebar">

										<?php

										$sql = "
											SELECT c.id, c.title, p.name as teacher_name, c.overview, c.start_date, c.price, c.thumbnail
											FROM course c
											LEFT JOIN teacher t ON t.id_course = c.id
											LEFT JOIN `profile` p ON p.id_user = t.id_user
											LEFT JOIN `student` st ON st.id_course = c.id
											WHERE t.id_user = '".$_GET['id']."'
											";
										$datas = $db->query($sql)->fetchAll();

										?>

										<?php foreach ($datas as $data) {  ?>

										<li class="nav-item">
											<a href="#" class="nav-link">
												 <?=$data['title']?>
											</a>
										</li>

										<?php } ?>
									
									</ul>
								</div>
								<!-- /navigation -->



							</div>
							<!-- /sidebar content -->

						</div>
						<!-- /right sidebar component -->

					</div>
					<!-- /inner container -->

				</div>
				<!-- /content area -->







		            <!-- Cover modal -->
					<div id="modal_cover_image" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Upload Cover Image</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="submit_cover"> 
								<div class="modal-body">
									
 
 

					                        <div class="form-group">
					                        	<div class="row">

													<div class="col-lg-12">
														<label>Upload cover image</label>
														<div >
															<input type="file"  name="cover" >
														
														</div>
					                                    <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
													</div>
					                        	</div>
					                        </div>




								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>

								</form>
							</div>
						</div>
					</div>
					<!-- /basic modal -->




		            <!-- Bio modal -->
					<div id="modal_bio" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Update Bio</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="submit_bio"> 
								<div class="modal-body">
									
 
 

					                        <div class="form-group">
					                        	<div class="row">

													<div class="col-lg-12">
														<label>Bio</label>
														<textarea name="bio" rows="3" cols="3" class="form-control" placeholder="Enter your bio"><?=$data['bio'];?></textarea>
													</div>
					                        	</div>
					                        </div>




								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>

								</form>
							</div>
						</div>
					</div>
					<!-- /basic modal -->




		            <!-- Bio modal -->
					<div id="modal_addfriend" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Friend</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form id="update_form" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="submit_bio"> 
								<div class="modal-body">
									
 
 

					                        <div class="form-group">
					                        	<div class="row">

													<div class="col-lg-12">
														
														<input type="hidden" id="modal_id_user" name="modal_id_user" readonly> 
														Add <span id="modal_name" style="font-weight: bold"></span> as a friend?
													</div>
					                        	</div>
					                        </div>




								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" id="submit" name="button" style="background: #2980b9; color: #fff; border: none" value="edit" class="btn btn-primary">Add Friend</button>
								</div>

								</form>
							</div>
						</div>
					</div>
					<!-- /basic modal -->



				<?php include('../main_footer.php');?>

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->




 

	</div>
	<!-- /page content -->

	











		            <!-- Bio modal -->
					<div id="modal_confirmfriend" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Confirm Friend</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form id="confirm_form" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="submit_bio"> 
								<div class="modal-body">
									
 
 

					                        <div class="form-group">
					                        	<div class="row">

													<div class="col-lg-12">
														
														<input type="hidden" id="modal_id_user2" name="modal_id_user2" readonly> 
														Confirm <span id="modal_name2" style="font-weight: bold"></span> as a friend?
													</div>
					                        	</div>
					                        </div>




								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" id="submit" name="button" style="background: #2980b9; color: #fff; border: none" value="edit" class="btn btn-primary">Confirm Friend</button>
								</div>

								</form>
							</div>
						</div>
					</div>
					<!-- /basic modal -->
















<script>




$(document).ready(function(){
     
	
 				

    $(document).on('click', '.edit_data', function(){  
        var id = $(this).attr("id"); 
        $.ajax({  
            url:"friend_modal_data.php",  
            method:"POST",  
            data:{id:id},  
            dataType:"json",  
            success:function(data){ 	
                console.log(data);							
                    $('#modal_id_user').val(data.id);  
                    $('#modal_name').html(data.name);  
            
				
				 

            }  
        });  
    }); 	 
    
    


    $('#update_form').on("submit", function(event){  
           event.preventDefault();  
           
                $.ajax({  
                     url:"profile_addfriend.php",  
                     method:"POST",  
                     data:$('#update_form').serialize(),  
                     beforeSend:function(){  
                          //$('#insert').val("Inserting");  
                     },  
                     success:function(data){  
						window.location.reload();
                        $('.toast').toast('show');
                        console.log(data);
                          //$('#update_form')[0].reset();  
                        $('#modal_addfriend').modal('hide');  
                         // $('#employee_table').html(data);  
                     }  
                });  
          
      });  


	  $(document).on('click', '.confirm_data', function(){  
        var id = $(this).attr("id"); 
        $.ajax({  
            url:"friend_modal_data.php",  
            method:"POST",  
            data:{id:id},  
            dataType:"json",  
            success:function(data){ 	
                console.log(data);							
                    $('#modal_id_user2').val(data.id);  
                    $('#modal_name2').html(data.name);   
            }  
        });  
    }); 	 





	$('#confirm_form').on("submit", function(event){  
           event.preventDefault();  
           
                $.ajax({  
                     url:"profile_confirmfriend.php",  
                     method:"POST",  
                     data:$('#confirm_form').serialize(),  
                     beforeSend:function(){  
                          //$('#insert').val("Inserting");  
                     },  
                     success:function(data){  
						window.location.reload();
                        $('.toast').toast('show');
                        console.log(data);
                          //$('#update_form')[0].reset();  
                        $('#modal_confirmfriend').modal('hide');  
                         // $('#employee_table').html(data);  
                     }  
                });  
          
      });  














	

});


</script>


</body>
</html>
