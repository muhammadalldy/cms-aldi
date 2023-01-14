<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

 
 
  

if(isset($_POST["action"]) && $_POST["action"]=="submit_course"){

	 $sql = "
			   UPDATE course
			   SET 
			   title='".addslashes($_POST['title'])."',
			   overview='".addslashes($_POST['overview'])."',
			   objective='".addslashes($_POST['objective'])."'
               WHERE id='".$_GET['id']."'
			   	   
		   ";
  $db->query($sql);





  $image_size = $_FILES['thumbnail']['size'];
  if ($image_size > 0) {


	  //$date2 = date_format(Carbon::now(), "Ymd");
	  $date2       = date("YmdHis");
   
	  $filename = (basename($_FILES["thumbnail"]["name"]));
	  $filename = explode(".", $filename);
	  $ext 	  = $filename[1];
	  $filename = $filename[0];
	  $filename = $filename."_".$date2;
	  $filename = $filename.".".$ext;
	  $target_dir = "../files/thumbnail/";
	  $target_file = $target_dir . $filename;
	  $uploadOk = 1;
	  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	  
	  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	  && $imageFileType != "gif") {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
	  } else {
		  move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file);
		  $sql	 		= "UPDATE course SET 
							  thumbnail = '$filename'
							  WHERE course_code='".$_POST['course_code']."'";
		  $db->query($sql);
	  }
  }
  





   echo("<script>window.location.href = '../course/view.php?id=".$_GET['id']."'; </script>");
}


 

$sql = "
SELECT u.id as id_teacher, c.id, c.title, p.name as teacher_name, c.overview, c.start_date, c.objective, u.image as teacher_image,
p.bio as teacher_bio, c.course_code
FROM course c
LEFT JOIN teacher t ON t.id_course = c.id
LEFT JOIN `profile` p ON p.id_user = t.id_user
LEFT JOIN `users` u ON p.id_user = u.id
WHERE c.id='".$_GET['id']."'
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
                                <span class="breadcrumb-item "><a style="color: #333333" href="view.php?id=<?=$_GET['id'];?>"><?=$data['title'];?></a></span>
								<span class="breadcrumb-item active">Edit Course</span>
							 
							</div> 

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<!--div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">
								<a href="#" class="breadcrumb-elements-item">
									<i class="icon-user-plus mr-2"></i>
									Add Topic
								</a>

							</div>
						</div-->
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Main charts -->
					<div class="row">
						<div class="col-md-12">
 
							<!-- Basic datatable -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h6 class="card-title">Edit <?=ucfirst($title)?></h6>
									<div class="header-elements">
									<a href="view.php?id=<?=$_GET['id'];?>" > [ back ]</a>
									</div>
								</div>
								<div class="card-body">
 				                	<form action="index_edit.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
									 <input type="hidden" name="action" value="submit_course">
									 <input type="hidden" name="course_code" value="<?=$data['course_code']?>">
										<div class="form-group">
											<label>Title:</label>
											<input type="text" name="title" class="form-control" placeholder="Name" value="<?=$data['title']?>" required >
										</div>

                                        <!--div class="form-group">
											<label>Teacher:</label>
                                            <select name="id_teacher" class="custom-select" required>
                                                <?php
														$sql = "
														SELECT t.id_user, p.name, t.id
														FROM teacher t
														LEFT JOIN users u ON u.id = t.id_user
														LEFT JOIN `profile` p ON p.id_user = u.id														
														";
														$rs = $db->query($sql);
														$teachers = $db->query($sql)->fetchAll(); 
												?>
													<option value=""> -- Select -- </option>
												<?php foreach ($teachers as $teacher) { ?>

													<option value="<?=$teacher['id']?>" <?=($teacher['id']==$data['id_teacher']) ? "selected" : ""; ?>> <?=$teacher['name']?> </option>



													<?php }?>
                                            </select>
                                        </div-->


										<div class="form-group">
											<label>Overview:</label>
											<textarea name="overview" rows="3" cols="3" class="form-control" placeholder="Overview" ><?=$data['overview']?></textarea>
										</div>

										<div class="form-group">
											<label>Objective:</label>
											<textarea name="objective" rows="3" cols="3" class="form-control" placeholder="Objective" ><?=$data['objective']?></textarea>
										</div>




										<div class="form-group">
											<label>Thumbnail:</label>
											<input type="file" name="thumbnail" class="form-control" placeholder="Thumbnail" >
										</div>



                                
                                    
                                        <div class="text-right">
											<button type="submit" name="button" value="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
										</div>
									</form>
								</div>
							</div>
							<!-- /basic datatable -->


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
