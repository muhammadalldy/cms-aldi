<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if($_SESSION['userrole']==900){
	header("Location: ../student/view.php");
	echo("<script>window.location.href = '../student/view.php'; </script>");
}


	$id = $_GET['id'];
	$access_page = (in_array($check, $AccessUser) && ($id == $_SESSION['username']));

	$sql = "
	SELECT count(*) as total_dt 
	FROM menu bm 
	LEFT JOIN menu_role bml ON bml.menu_id = bm.id
	WHERE bm.is_active='ACTIVE' 
	AND bml.menu_id IS NOT NULL
	AND bml.role_id='".$_SESSION['userrole']."'
	AND bm.id='14'
	ORDER BY bm.ordering ASC";
	$AccessEmployee = $db->query($sql)->fetchArray();
 
	if(($AccessEmployee['total_dt']) == 0 && ($id == $_SESSION['username'])){
	//	echo("1");
	} else if(($AccessEmployee['total_dt'] == 0) && ($id != $_SESSION['username'])){
		header("Location: ../dashboard/");
	} else {}
	
?>

</head>

<body>


	<?php include('../main_navbar.php'); ?>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg shadow-sm">

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

			<?php include('../page_header.php');?>

				<!-- Content area -->
				<div class="content">

					<!-- Main charts -->
					<div class="row">
						<div class="col-md-12">
 
							<!-- Basic datatable -->
							<div class="card shadow-sm">
								<div class="card-header header-elements-inline">
									<h6 class="card-title"><?=$fn?> <?=ucwords(str_replace("_"," ",$title))?></h6>
									<?php if($_GET['a'] == 1){?>
									<div class="header-elements">
									<a href="index.php" class="btn btn-sm btn-primary"> Back</a>
									</div>
									<?php } ?>
								</div>
                                <?php
                          
							
									$sql = "
										SELECT ne.empid, ne.name, es.title as user_status, ur.role as role_name, ur.id as role_id, ne.mobile,
										ne.xemployee_status, ne.unit_id, ne.sub_unit_id, ne.emp_type, ne.email
										FROM profile ne 
										LEFT JOIN employee_status es ON es.code = ne.xemployee_status
										LEFT JOIN users ua ON ua.username = ne.empid
										LEFT JOIN roles ur ON ur.id = ua.id_role
										WHERE ne.empid = '".$_GET['id']."'
									";
									$data = $db->query($sql)->fetchArray();
                                ?>
								<div class="card-body">
 				                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data">
									 <input type="hidden" name="id" value="<?=$_GET['id']?>">                                     
									 <input type="hidden" name="e" value="<?=$_GET['e']?>">                                     
									<input type="hidden" name="a" value="<?=$_GET['a']?>">                                     


									 <div class="form-group">

									<img src="../img/<?=$data['empid']?>.png" height="150" >
									<?php if($_SESSION['username'] == $_GET['id']){?>
									<!--input type="file" name="image_employee"-->
									<?php } ?>
									</div>

									 <div class="form-group">
											<label>Staff ID:</label>
											<input type="text" name="txt02_empid" value="<?=$data['empid']?>" class="form-control" placeholder="Staff ID" readonly required>
										</div>

										<div class="form-group">
											<label>Name:</label>
											<input type="text" name="txt02_name" value="<?=$data['name']?>" class="form-control" placeholder="Username"  required>
										</div>

  
 
										<div class="form-group">
											<label>Email:</label> 
											<input type="text" name="txt02_email" value="<?=$data['email']?>" class="form-control" placeholder="Email"  >
                                        </div>
  
										<div class="form-group">
											<label>Mobile Phone Number:</label> 
											<input type="text" name="txt02_mobile" value="<?=$data['mobile']?>" class="form-control" placeholder="Mobile Phone Number"  >
                                        </div>
 
 
 
										<?php if(($_SESSION['username'] == $_GET['id']) || $_SESSION['userrole']=='832' ){?>

                                        <div class="text-right">
											<button type="submit" name="button" value="edit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
										</div>
										<?php } ?>


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
