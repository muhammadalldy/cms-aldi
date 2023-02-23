<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["action"]) && $_POST["action"]=="delete"){

	$sql = "DELETE FROM users WHERE id='".$_POST['id']."'";
	$db->query($sql);
	echo("<script>window.location.href = 'index.php'; </script>");
}
?>
</head>

<body>


	<?php include('../main_navbar.php'); ?>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

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
							<div class="card">
							
								<div class="card-header header-elements-inline">
									<h5 class="card-title"><?=ucfirst($title)?></h5>
									<div class="header-elements">
										<a href="index.php" class="badge ml-2" style="background: #2980b9; color: #fff; font-size: 10px">Back</a>
									</div>
								</div>
								<div class="card-body">
								
									<table class="table datatable-responsive">
										<thead>
											<tr>
												<th>Username</th>
												<th>Full Name</th> 
												<th>Role</th> 
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead> 
										<tbody>
											<?php
												$sql = "
													SELECT ne.id_user as id, ne.name, ur.name as role
													FROM profile ne 
													LEFT JOIN users ua ON ua.id = ne.id_user
													LEFT JOIN role ur ON ur.id = ua.id_role
                                                    WHERE ua.id_role='".$_GET['id']."'

												";
												$menus = $db->query($sql)->fetchAll();
											?>	
											<?php foreach($menus as $menu){ ?>										
												<tr>
													<td><?=$menu['id']?></td>
													<td><?=$menu['name']?></td> 
													<td><?=$menu['role']?></td> 
													<td><?=$menu['user_status']?></td> 
													<td class="text-center">
														<div class="list-icons">
															<div class="dropdown">
																<a href="#" class="list-icons-item" data-toggle="dropdown">
																	<i class="icon-menu9"></i>
																</a>

																<div class="dropdown-menu dropdown-menu-right">
																	<a href="../user/view.php?id=<?=$menu['empid']?>" class="dropdown-item">View</a>
																	<a href="../user/view.php?id=<?=$menu['empid']?>&e=1" class="dropdown-item">Edit</a>
																
																</div>
															</div>
														</div>
													</td>
												</tr>
											<?php } ?>
 
										</tbody>
									</table>

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
