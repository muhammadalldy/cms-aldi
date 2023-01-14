<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if (isset($_POST["action"]) && $_POST["action"]=="takeCourse") {



	$sql = "
		SELECT count(*) as total_dt
		FROM student
		WHERE 
		id_user='".addslashes($_POST['id_user'])."' AND
		id_course='".addslashes($_POST['id_course'])."'
	";
	$data = $db->query($sql)->fetchArray();

	if($data['total_dt'] == 0){
		$created_date   = date("Y-m-d H:i:s");
		$sql = "
				   INSERT INTO student
				   SET 
				   id_user='".addslashes($_POST['id_user'])."',
				   id_course='".addslashes($_POST['id_course'])."',
				   created_date='".$created_date."'
			   ";
	  $db->query($sql);
	
	} else {
		echo("<script>alert('You already take this course.')</script>");
	}
  echo("<script>window.location.href = '../course/view.php?id=".addslashes($_POST['id_course'])."'; </script>");
}

if(isset($_POST["action"]) && $_POST["action"]=="delete"){

	$sql = "
			  DELETE FROM course
			   WHERE id='".$_GET['id']."'
		   ";
  $db->query($sql);


  $sql = "
  DELETE FROM course_detail
   WHERE id_course='".$_GET['id']."'
";
$db->query($sql);



   echo("<script>window.location.href = '../course/index.php'; </script>");
}
 


$sql = "
SELECT c.id, c.title, p.name as teacher_name, c.overview, c.start_date, c.objective, u.image as teacher_image,
p.bio as teacher_bio, u.id as id_teacher
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
								<span class="breadcrumb-item active"><?=$data['title'];?></span>
							 
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">
								<!--a href="view_add.php?id=<?=$_GET['id']?>" class="breadcrumb-elements-item ml-2">
									<i class="icon-user-plus mr-2"></i>
									Add Topic
								</a-->
								<a href="index_edit.php?id=<?=$_GET['id']?>" class="breadcrumb-elements-item ml-2">
									<i class="icon-user-plus mr-2"></i>
									Edit Course
								</a>
								<!--form id="myForm" action="view.php?id=<?=$_GET['id']?>" method="post">
								<input type="hidden" name="action" value="delete">
								<a href="#" class="breadcrumb-elements-item ml-2" onclick="if (confirm('Are you sure?')){ document.getElementById('myForm').submit();  }else{event.stopPropagation(); event.preventDefault();};" >
									<i class="icon-user-plus mr-2"></i>
									Delete Course
								</a>
								</form-->

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
							<h5 class="card-title"><?=$data['title'];?></h5>
							<div class="header-elements">
								<?php
									$sql = "
									SELECT count(*) as total_dt FROM student WHERE id_user='".$_SESSION['id_user']."' AND id_course='".$data['id']."' 
									";
									$is_joined = $db->query($sql)->fetchArray();
									$is_joined = $is_joined['total_dt'];
								?>
											<?php if($is_joined == 1){?>
												<a style="margin-right: 6px" href="#">[ this course is taken ] </a>
											<?php } else {?>
												<a style="margin-right: 6px" href="javascript:takeCourse();">[ study this course ] </a>
											<?php } ?>
								
								<a style="margin-right: 6px" href="index.php">[ back ]</a>
		                	</div>
						</div>

						<div class="nav-tabs-responsive bg-light border-top">
							<ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
								<li class="nav-item"><a href="#course-overview" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Content</a></li>
								<li class="nav-item"><a href="#course-schedule" class="nav-link" data-toggle="tab"><i class="icon-calendar3 mr-2"></i> Reference</a></li>
								<li class="nav-item"><a href="#course-attendees" class="nav-link" data-toggle="tab"><i class="icon-people mr-2"></i> Student</a></li>
								<li class="nav-item"><a href="#course-teacher" class="nav-link" data-toggle="tab"><i class="icon-people mr-2"></i> Teacher</a></li>
							</ul>
						</div>

						<div class="tab-content">
							<div class="tab-pane fade show active" id="course-overview">
								<div class="card-body">
									<div class="mt-1 mb-3">
										<h6 class="font-weight-semibold">Overview</h6>
										
                                        <?=$data['overview'];?>

                                        
									</div>

									<div class="mt-1 mb-3">
										<h6 class="font-weight-semibold">Objective</h6>
										
                                        <?=$data['objective'];?>

                                        
									</div>									

								 
				                    <h6 class="font-weight-semibold">Topics &nbsp;<a href="view_add.php?id=<?=$_GET['id']?>" style="font-size: 12px; font-weight: normal" > [ add ] </a></h6>
									
									
									<?php									
												$sql = "
													SELECT c.id, cd.id as id_topic, p.name as teacher_name, c.start_date, cd.objective,
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
 
									<?php if($courses[0]['course_title'] !=''){?>
									<!--table class="table datatable-responsive table-bordered table-hover table-striped"-->
									<table class="table table-bordered table-hover table-striped" style="width: 900px">
										<thead>
											<tr>
												<th style="text-align: center">No</th>
												<th style="text-align: center">Name</th>
												<th style="text-align: center">#</th>
											</tr>
										</thead>
										<tbody>

											<?php $x = 1; ?>
											<?php foreach ($courses as $course) { ?>
											<tr>
												<td style="text-align: center"><?=$x++?></td>
												<td><?=$course['course_title']?></td>
												<td>
													<!--a href="view_detail.php?id=<?=$course['id_topic']?>"--><a>View</a> /
													<a href="view_edit.php?id=<?=$_GET['id']?>&id_topic=<?=$course['id_topic']?>">Edit</a>
												</td>											
											</tr>
											<?php } ?>
											
										</tbody>
									</table>
									<?php } ?>
								 










                                    
								</div>


							</div>

							<div class="tab-pane fade" id="course-attendees">
								<div class="card-body">
									<div class="row">

									<?php									
												$sql = "
													SELECT u.username, p.name, p.bio, u.image
													FROM student st
													LEFT JOIN users u ON u.id = st.id_user
													LEFT JOIN profile p ON u.id = p.id_user													
													LEFT JOIN course c ON c.id = st.id_course	
													WHERE c.id='".$_GET['id']."'												
												";

												$students = $db->query($sql)->fetchAll();
											?>
											<?php foreach ($students as $student) { ?>
										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="../files/image/<?=$student['image']?>" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0"><?=$student['name']?></h6>
														<span class="text-muted"><?=$student['bio']?></span>
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
										<?php } ?>

									</div>


								</div>
							</div>




							<div class="tab-pane fade" id="course-teacher">
								<div class="card-body">
									<div class="row">

									<?php									
												$sql = "
													SELECT u.username, p.name, p.bio, u.image
													FROM student st
													LEFT JOIN users u ON u.id = st.id_user
													LEFT JOIN profile p ON u.id = p.id_user													
													LEFT JOIN course c ON c.id = st.id_course	
													WHERE c.id='".$_GET['id']."'												
												";

												$students = $db->query($sql)->fetchAll();
											?>
											<?php foreach ($students as $student) { ?>
										<div class="col-xl-3 col-lg-6">
											<div class="card card-body">
												<div class="media">
													<div class="mr-3">
														<a href="#">
															<img src="../files/image/<?=$student['image']?>" class="rounded-circle" width="42" height="42" alt="">
														</a>
													</div>

													<div class="media-body">
														<h6 class="mb-0"><?=$student['name']?></h6>
														<span class="text-muted"><?=$student['bio']?></span>
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
										<?php } ?>

									</div>


								</div>
							</div>


							<div class="tab-pane fade" id="course-schedule">
								<div class="card-body">
									<div class="schedule">









								 
									<h6 class="font-weight-semibold">Reference &nbsp;<a href="reference_add.php?id=<?=$_GET['id']?>" style="font-size: 12px; font-weight: normal" > [ add ] </a></h6>

									
									<?php									
												$sql = "
													SELECT c.id, cd.ebook, cd.id as id_topic, p.name as teacher_name, c.start_date, cd.objective,
													cd.ebook as course_title, cd.order_no, cd.duration,
													cd.start_date
													FROM course c
													LEFT JOIN course_reference cd ON cd.id_course = c.id
													LEFT JOIN teacher t ON t.id_course = c.id
													LEFT JOIN `profile` p ON p.id_user = t.id_user
													WHERE c.id='".$_GET['id']."'
													ORDER BY `order_no`
												";

												$courses = $db->query($sql)->fetchAll();
											?>
 
									<?php if($courses[0]['course_title'] !=''){?>
									<!--table class="table datatable-responsive table-bordered table-hover table-striped"-->
									<table class="table table-bordered table-hover table-striped" style="width: 900px">
										<thead>
											<tr>
												<th style="text-align: center">No</th>
												<th style="text-align: center">Name</th>
												<th style="text-align: center">#</th>
											</tr>
										</thead>
										<tbody>

											<?php $x = 1; ?>
											<?php foreach ($courses as $course) { ?>
											<tr>
												<td style="text-align: center"><?=$x++?></td>
												<td><?=$course['course_title']?></td>
												<td>
													<a target="_blank" href="../files/reference/<?=$course['ebook']?>">Download</a>
												</td>											
											</tr>
											<?php } ?>
											
										</tbody>
									</table>
									<?php } ?>
								 










									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /course overview -->


					<!-- About author -->
					<!--div class="card">
						<div class="card-header header-elements-sm-inline">
							<h5 class="card-title">Teacher</h5>

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
									<li class="list-inline-item"><a href="../profile/index.php?id=<?=$data['id_teacher'];?>">Teacher profile</a></li>
									<li class="list-inline-item"><a href="#">All courses by <?=$data['teacher_name'];?></a></li>
									<li class="list-inline-item"><a href="#">https://website.com</a></li>
								</ul>
							</div>
						</div>
					</div-->
					<!-- /about author -->


					<!-- Discussion -->
					<!--div class="card">
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
					</div-->
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



<form id="takeCourse" action="view.php?id=<?=$_GET['id']?>" method="post">
	<input type="hidden" name="action" value="takeCourse">
	<input type="hidden" name="id_course" value="<?=$_GET['id']?>">
	<input type="hidden" name="id_user" value="<?=$_SESSION['id_user']?>">
</form>



<form id="teachCourse" action="view.php?id=<?=$_GET['id']?>" method="post">
	<input type="hidden" name="action" value="teachCourse">
	<input type="hidden" name="id_course" value="<?=$_GET['id']?>">
	<input type="hidden" name="id_user" value="<?=$_SESSION['id_user']?>">
</form>


<script>

function takeCourse(){
    if (confirm('Are you sure you want to study this course?')) {
        document.getElementById('takeCourse').submit();
    } else {

	}
}

function teachCourse(){
    if (confirm('Are you sure you want to teach this course?')) {
        document.getElementById('teachCourse').submit();
    } else {

	}
}

</script>





</body>
</html>
