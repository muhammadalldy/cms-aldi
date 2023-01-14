<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

 
 
 

if(isset($_POST["action"]) && $_POST["action"]=="submit_course"){


		   $created_date   = date("Y-m-d H:i:s");
	


		   $image_size = $_FILES['ebook']['size'];
		   if ($image_size > 0) {
		
		
			   //$date2 = date_format(Carbon::now(), "Ymd");
			   $date2       = date("YmdHis");
			
			   $filename = (basename($_FILES["ebook"]["name"]));
			   $filename = explode(".", $filename);
			   $ext 	  = $filename[1];
			   $filename = $filename[0];
			   $filename = $filename."_".$date2;
			   $filename = $filename.".".$ext;
			   $target_dir = "../files/reference/";
			   $target_file = $target_dir . $filename;
			   $uploadOk = 1;
			   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			   
			   if ($imageFileType != "pdf") {
				   echo "Sorry, only PDF file is allowed.";
				   $uploadOk = 0;
			   } else {
				   move_uploaded_file($_FILES["ebook"]["tmp_name"], $target_file);
				   $sql	 		= "INSERT INTO course_reference SET 
									   ebook = '$filename',
									   created_date='".$created_date."',
									   created_by='".$_SESSION['id_user']."',
									   id_course='".$_POST['id_course']."'";
				   $db->query($sql);
			   }
		   }
		   



 
   echo("<script>window.location.href = '../course/view.php?id=".addslashes($_POST['id_course'])."'; </script>");
}


 


$sql = "
SELECT c.id, c.title, p.name as teacher_name, c.overview, c.start_date, c.objective, u.image as teacher_image,
p.bio as teacher_bio
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
								<span class="breadcrumb-item active">Add Topic</span>
							 
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
									<h6 class="card-title">Add Topic</h6>
									<div class="header-elements">
									<a href="view.php?id=<?=$_GET['id'];?>" > [ back ]</a>
									</div> 
								</div>
								<div class="card-body">
 				                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data">
									 <input type="hidden" name="action" value="submit_course">
									 <input type="hidden" name="id_course" value="<?=$_GET['id']?>">
									 

										 <div class="form-group">
											<label>Course Title:</label>
											<input type="text" name="course_name" class="form-control" placeholder="Name" value="<?=$data['title']?>" disabled>
										</div>

										<div class="form-group">
											<label>Ebook:</label>
											<input type="file" name="ebook" class="form-control" placeholder="Topic Title" required>
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
