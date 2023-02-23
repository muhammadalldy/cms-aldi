<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["action"]) && $_POST["action"]=="delete"){

	//$sql = "DELETE FROM roles WHERE id='".$_POST['id']."'";
	//$db->query($sql);
	//echo("<script>window.location.href = 'index.php'; </script>");
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
									<h5 class="card-title" style="color: #47b1d7">
										Role
									</h5> 
								</div>
								<div class="card-body">
								
									<table class="table datatable-responsive table-bordered table-hover table-striped">
										<thead>
											<tr>
												<th>Username</th>
												<th>Full Name</th> 
												<th>Total Staff</th>
												<th>Total Menu</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead> 
										<tbody>
											<?php
												$sql = "
												SELECT ur.id, ur.name as role, COUNT(bml.menu_id) AS total_menu
												FROM role ur
												LEFT JOIN `menu_role` bml ON ur.id = bml.role_id
												LEFT JOIN `menu` bm ON bm.id = bml.menu_id
												GROUP BY ur.id												";
												$datas = $db->query($sql)->fetchAll();
											?>	
											<?php foreach($datas as $data){ ?>										
												<tr>
													<td><?=$data['id']?></td>
													<td><?=$data['role']?></td> 
													<td>
													<?php
														$sql = "SELECT count(*) as total_dt 
														FROM users ua
														LEFT JOIN `profile` ne ON ne.id_user = ua.id
														WHERE  ua.id_role='".$data['id']."'";
														
													?>
													<a href="user.php?id=<?=$data['id']?>"><?=($db->query($sql)->fetchArray()['total_dt'])?></a>											
													</td> 
													<td>
													<?php
														$sql = "
															SELECT count(ua.*) as total_dt 
															FROM users ua
															LEFT JOIN profile ne ON ne.id_user = ua.id
															WHERE ne.xemployee_status = 'AC' 
															AND  ua.id_role='".$data['id']."'";
														
													?>
													<a href="menu.php?id=<?=$data['id']?>"><?=$data['total_menu']?></a>											
													</td> 
													<td class="text-center">
														<div class="list-icons">
															<div class="dropdown">
																<a href="#" class="list-icons-item" data-toggle="dropdown">
																	<i class="icon-menu9"></i>
																</a>

																<div class="dropdown-menu dropdown-menu-right">
																	<a href="view.php?id=<?=$data['id']?>" class="dropdown-item">View</a>
																	<a href="view.php?id=<?=$data['id']?>&e=1" class="dropdown-item">Edit</a>
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
