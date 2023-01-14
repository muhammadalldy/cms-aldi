<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

 
 
 

if(isset($_POST["action"]) && $_POST["action"]=="submit_course"){

  
	$sql = "
			   UPDATE course_detail
			   SET 
			   title='".addslashes($_POST['title'])."'
               WHERE id='".$_POST['id_topic']."'
		   ";
  $db->query($sql);
   echo("<script>window.location.href = '../course/view.php?id=".addslashes($_POST['id'])."'; </script>");
}


 


$sql = "
SELECT c.id, c.title, cd.title as topic_name, p.name as teacher_name, c.overview, c.start_date, c.objective, u.image as teacher_image,
p.bio as teacher_bio
FROM course c
LEFT JOIN course_detail cd ON cd.id_course = c.id
LEFT JOIN teacher t ON t.id_course = c.id
LEFT JOIN `profile` p ON p.id_user = t.id_user
LEFT JOIN `users` u ON p.id_user = u.id
WHERE cd.id='".$_GET['id_topic']."'
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
								<span class="breadcrumb-item active">Edit Topic</span>
							 
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
									<h6 class="card-title">Edit Topic</h6>
									<div class="header-elements">
									<a href="view.php?id=<?=$_GET['id'];?>" > [ back ]</a>
									</div> 
								</div>
								<div class="card-body">
 				                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									 <input type="hidden" name="action" value="submit_course">
									 <input type="hidden" name="id_topic" value="<?=$_GET['id_topic']?>">
									 <input type="hidden" name="id" value="<?=$_GET['id']?>">
									 

										 <div class="form-group">
											<label>Course Title:</label>
											<input type="text" name="course_name" class="form-control" placeholder="Name" value="<?=$data['title']?>" disabled>
										</div>

										<div class="form-group">
											<label>Topic Title:</label>
											<input type="text" name="title" class="form-control" placeholder="Topic Title" value="<?=$data['topic_name']?>" required>
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
