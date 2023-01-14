<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

 
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

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

 

if(isset($_POST["action"]) && $_POST["action"]=="submit"){
	$created_date = date("Y-m-d H:i:s");
	$date_id = date("YmdHis");
	$sql = "
			   INSERT INTO posting 
			   SET 
			   role='".$_SESSION['userrole']."',
			   content='".addslashes($_POST['content'])."', 
			   id_parent='".addslashes($_POST['id_parent'])."', 
			   date_id='".$date_id."', 
			   created_date='".$created_date."',
			   id_ownership='0',
			   created_by='".$_SESSION['id_user']."'
		   "; 
  $db->query($sql);
  
  
  
  
  
  
  
  
  
	
	$image_size = $_FILES['img']['size'];
	if ($image_size > 0) {
 
 
		$path = $_FILES['img']['name'];
		$file_extension = pathinfo($path, PATHINFO_EXTENSION);
  
		$date2       = date("YmdHis");
	 
		$filename = (basename($_FILES["img"]["name"]));
		$filename = explode(".", $filename);
		$ext 	  = $filename[1];
		$filename = $filename[0];
		$filename = $filename."_".$date2;
		$filename = $filename.".".$ext;
		$target_dir = "../announcement/img/";
		$target_file = $target_dir . $filename;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" && $imageFileType != "pdf") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
			$sql = "DELETE FROM posting WHERE date_id='".$date_id."'";
			$db->query($sql);
		} else {



	$sql = "
		SELECT ne.empid AS userid, lower(ne.name) as name, ne.image_staff as image, ne.back_title
		FROM `new_employee` ne
		WHERE ne.empid='".$_SESSION['username']."'
	";
	$datas = $db->query($sql)->fetchArray();
	$sender_name = ucwords($datas['name']).", ".$datas['back_title'];

 
	$sql = "
		SELECT lower(s.name) as name, s.email 
		FROM  `student` s
		LEFT JOIN student_program sp ON sp.matrix_no = s.matrix_no
		WHERE s.student_status='ACTIVE' 
		AND s.email !='' AND s.email IS NOT NULL
	";
	
	$allstudent = $db->query($sql)->fetchAll();
  
			move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
			$sql	 		= "UPDATE posting SET 
								img = '$filename',
								file_extension = '".$file_extension."'
								WHERE date_id='".$date_id."'";
			$db->query($sql);
		}





 










	
	





	}
	
   
  
  
  
  
   echo("<script>window.location.href = '../home/'; </script>");
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
//$data = $db->query($sql)->fetchArray();
?>

<style>


#upload_link{
    text-decoration:none;
}
#upload{
    display:none
}

</style>

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
								<a href="#" class="breadcrumb-item active">Announcement</a>
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



					<!-- Timeline -->
					<div class="timeline timeline-left">
						<div class="timeline-container">

						 
						 				<?php if($_SESSION['userrole'] != '900'){ ?>

 							<!-- Tasks -->
							<div class="timeline-row">
								

								<div class="row">
									<div class="col-lg-6">
										<div class="card border-left-3 border-left-primary rounded-left-0">
										<!-- Share your thoughts -->
										
												<div class="card-header header-elements-inline" style="padding-bottom: 12px; padding-top: 12px; ">
													<h7 class="card-title">Announcement</h7>
												</div>

												<div class="card-body" style="padding-bottom: 12px; padding-top: 0px; ">
													<form action="index.php" method="post" enctype="multipart/form-data">
														
														<textarea id="text_area" name="content" class="form-control mb-2" rows="3" cols="1" placeholder="Enter your announcement..." ></textarea>
														<input id="picture_name" type="hidden" class="form-control mb-2" placeholder="Picture" readonly>
														
														<input type="hidden" name="action" value="submit">
														<input type="hidden" name="id_parent" value="0">
														<div class="d-flex align-items-center">
															<div class="d-inline-flex">
																<input name="img" onchange="file_changed(this)" id="upload" type="file"/>
																<a href="#" id="upload_link" class="btn btn-light btn-icon btn-sm border-transparent rounded-pill mr-2" data-popup="tooltip" title="Add photo or PDF"><i class="icon-images2 position-static"></i></a>
																<!--
																<a href="#" class="btn btn-light btn-icon btn-sm border-transparent rounded-pill mr-2" data-popup="tooltip" title="Add video"><i class="icon-film2 position-static"></i></a>
																<a href="#" class="btn btn-light btn-icon btn-sm border-transparent rounded-pill mr-2" data-popup="tooltip" title="Add event"><i class="icon-calendar2 position-static"></i></a>
																!-->
															</div>

													
															
															<button type="submit" name="button" class="btn btn-primary btn-labeled btn-labeled-right ml-auto" style="background: #2980b9; color: #fff; border: none"><b><i class="icon-paperplane"></i></b>Share</button>
														</div>
													</form>
												</div>
										
											<!-- /share your thoughts -->

										</div>
									</div>

								 
								</div>
							</div>
							<!-- /tasks -->
										<?php } ?>

 						<?php
							$dtold = "";
						

							$sql = "

							SELECT fc.file_extension, fc.img, fc.id, s.id_user AS userid, LOWER(s.name) AS name, 
							fc.content, fc.created_date, u.image, '' AS back_title
							FROM `posting` fc 
							LEFT JOIN `profile` s ON fc.created_by = s.id_user
							LEFT JOIN `users` u ON u.id = s.id_user
							WHERE fc.id_parent='0' 
							ORDER BY fc.created_date DESC

							";

							$datas = $db->query($sql)->fetchAll();

						?>
 
						<?php foreach ($datas as $data) {  ?>
													<?php
														$ts   = strtotime($data['created_date']);
													?>
	


							 <?php 
								$datelabel = date('d F Y', $ts);
								$dtnow = $datelabel;
							 ?>
							
							<?php if($dtnow != $dtold){ ?>
							<!-- Date stamp -->
							<div class="timeline-date text-muted" style="padding-bottom: 0.5rem; margin-bottom: 0.5rem;">	
								<?=$dtnow;?>
							</div>
							<!-- /date stamp -->
							<?php } ?>
							<?php
								$dtold = $dtnow;
							?>

							<?php
								$image = $data['image'];
								if($image == ""){
									$image = "../files/image/profile.png";
								}
							?>

							<!-- Tasks -->
							<div class="timeline-row">
								<div class="timeline-icon">
									<img src="../files/image/<?=$image?>" alt="">
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="card border-left-3 border-left-primary rounded-left-0">
											<div class="card-body" style="padding-bottom: 9px">
												<!--div class="d-sm-flex align-item-sm-center flex-sm-nowrap mb-1"-->
												<div>
													<div>
														<h6><a href="../profile/index.php<?=($data['userid']!=$_SESSION['id_user'])?"?id=".$data['userid']:""?>"><?=ucwords($data['name'])?></a></h6>
														<p>
														
														<?php if($data['img'] !=''){ ?>



														<?php
														if ( $data['file_extension'] =="pdf") { 
														

														?>
														<iframe src="../announcement/img/<?=$data['img']?>" style="height: 350px;width: <?=($device == 1 ? "100%" : "75%")?>"></iframe><br/>



															<a href="../announcement/img/<?=$data['img']?>" > Download </a>

														<?php 

														} else { ?>
															<img src="../announcement/img/<?=$data['img']?>" style="width: <?=($device == 1 ? "100%" : "50%")?>">
														
														<?php } ?>









														<?php } else {?>
															<?=$data['content']?>
														<?php } ?>
														</p>
														
														
 						<?php
						 

							$sql = "

							SELECT fc.file_extension, fc.img, fc.id, s.id_user AS userid, LOWER(s.name) AS name, 
							fc.content, fc.created_date, u.image, '' AS back_title
							FROM `posting` fc 
							LEFT JOIN `profile` s ON fc.created_by = s.id_user
							LEFT JOIN `users` u ON u.id = s.id_user
							WHERE fc.id_parent='".$data['id']."'
							ORDER BY fc.created_date ASC

							";

							$subdatas = $db->query($sql)->fetchAll();

						?>
 
						<?php foreach ($subdatas as $subdata) {  ?>
								<span style="font-size: 11px; "><?=ucwords($subdata['name']);?> - <?=($subdata['content']);?><br/></span>
						<?php } ?>
														
													</div>
													
													
													<!--ul class="list list-unstyled mb-0 mt-3 mt-sm-0 ml-auto">
														<li><span class="text-muted" style="font-size:12px"><?=date('H:i', $ts)?></span></li>
													</ul-->
												</div>
													<form action="#" method="post">
													
													<table style="width: 100%">
													<tr>
													<td style="width: 100%"> 
														<textarea style="font-size: 10px; padding-bottom: 3px; padding-top: 3px;" name="content" class="form-control mb-1" rows="1" cols="1" placeholder="Enter your comment..." required></textarea>
														<input type="hidden" name="id_parent" value="<?=$data['id']?>">
														<input type="hidden" name="action" value="submit">
													</td>
													<td style="width: 20%">
															<button type="submit" name="button" class="badge badge-sm" style="background: #2980b9; color: #fff; float: right">Submit</button>
													</td>



													</tr>
													
													</table>
															 
															
														 
													 

														 
													</form>												
											</div>

										 
										</div>
									</div>

								 
								</div>
							</div>
							<!-- /tasks -->
			
						<?php } ?>
						</div>
				    </div>
				    <!-- /timeline -->

				</div>
				<!-- /content area -->





				<?php include('../main_footer.php');?>

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->



<script>
$(function(){
$("#upload_link").on('click', function(e){
    e.preventDefault();
    $("#upload:hidden").trigger('click');
});
});

function file_changed(){
	var link = document.getElementById('picture_name');
	link.type = 'text'; //or
	link.style.display = 'show'; //or
	link.style.visibility = 'visible';
	
	var fileName = document.getElementById('upload').files[0].name;
	document.getElementById('picture_name').value = fileName;
	console.log(fileName);

	var link = document.getElementById('text_area');
	link.style.display = 'none'; //or
	link.style.visibility = 'hidden';


}

</script>
 

	</div>
	<!-- /page content -->

</body>
</html>
