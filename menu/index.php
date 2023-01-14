<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["action"]) && $_POST["action"]=="delete"){

	//$sql = "DELETE FROM menu WHERE id='".$_POST['id']."'";
	//$db->query($sql);
	//echo("<script>window.location.href = 'index.php'; </script>");
}


?>
	<style>
	.dataTables_filter,  .dataTables_length 
    { 
     display: none;
    }	
	.datatable-footer, .datatable-header {
  padding: 0;
    padding-right: 1.25rem;
    padding-left: 1.25rem;
}
	</style>

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
								<h5 class="card-title" style="color: #47b1d7"><?=ucwords(str_replace("_"," ",$title))?></h5>
									<div class="header-elements">
									<a href="add.php" class="btn btn-sm btn-primary">Add Data</a>
									</div>
								</div>
								<div class="card-body">

								<table id='dataTable' class="table table-hover" > 
										<thead>
											<tr>
												<th>Title</th>
												<th>File Name</th>
												<th>Parent</th>
												<th>Ordering</th>
												<th>Icon</th>
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead> 
										<tbody>
											<?php
												$sql = "SELECT * FROM menu ORDER BY ordering ASC";
												$menus = $db->query($sql)->fetchAll();
											?>	
											<?php foreach($menus as $menu){ ?>										
												<tr>
													<td><?=$menu['title']?></td>
													<td><?=$menu['filename']?></td>
													<td><?=$menu['id_parent']?></td>
													<td><?=$menu['ordering']?></td>
													<td><?=$menu['icon']?></td>
													<td>
														<?php if($menu['is_active']=="ACTIVE"){?>
															<span class="badge badge-success">Active</span>
														<?php } else { ?>
															<span class="badge badge-danger">Inactive</span>
														<?php }  ?>

													</td>
													<td class="text-center">
														<div class="list-icons">
															<div class="dropdown">
																<a href="#" class="list-icons-item" data-toggle="dropdown">
																	<i class="icon-menu9"></i>
																</a>

																<div class="dropdown-menu dropdown-menu-right">
																	<a href="view.php?id=<?=$menu['id']?>" class="dropdown-item">View</a>
																	<a href="view.php?id=<?=$menu['id']?>&e=1" class="dropdown-item">Edit</a>
																	
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

	<script>


$(document).ready(function(){
    var dataTable = $('#dataTable').DataTable({
        'pageLength' : 10,
	 
		"info": false, 
        'searching': false, 
	    "language": { processing: '<i class="icon-spinner2 spinner"></i><span class="sr-only">Loading...</span> '},		
		 
		  "scrollY": "340px",
		  "scrollCollapse": true,
		 
       

 
	
    });
	
	 
  
    



});



 					
					
    




</script> 
</body>
</html>
