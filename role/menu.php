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
									<h5 class="card-title"><?=ucwords(str_replace("_"," ",$title))?></h5>
									<div class="header-elements">
										<button id="some_id1" class="btn btn-sm btn-primary mr-1">Update</button>
										<a href="index.php" class="btn btn-sm btn-primary mr-1">Back</a>
									</div>
								</div>
								<div class="card-body">
								
									
								<table id='empTable2' class="table-bordered table-hover table-striped">
									
										<thead>
											<tr>
												<th>Title</th>
												<th>File Name</th>
												<th>Parent</th>
												<th>Ordering</th>
												<th>Icon</th>
												<th>Status</th> 
												<th style="width: 10px">#</th>
											</tr>
										</thead> 
										<tbody>
											<?php
										$sql = "
										
											SELECT COUNT(bml.menu_id) AS is_ticked,bm.*
											FROM `menu` bm 
											LEFT JOIN `menu_role` bml ON (bm.id = bml.menu_id AND bml.role_id = ".$_GET['id'].")
											GROUP BY bm.id
											ORDER BY bm.ordering ASC
											
																								
											";
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

													<td>
														<?php 

															if($menu['is_ticked'] == 1){
																$ticked = "checked";
															} else {
																$ticked = "";
															}

														?>

														<input type="checkbox" name="mergeDT[]" class="case_product" value="<?=$menu['id']?>" <?=$ticked?> />
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

$(document).ready(function() {



 						

	$('#empTable2').dataTable( {
  "scrollY": "300px",
  "scrollCollapse": true,
  "paging": false
} );

	$("button").click(function() {
 
		if ($('input[type=checkbox]').is(':checked')){


			var data = $(":checkbox:checked").map(function(i,n){
			return $(n).val();
			}).get();


			var role_id = "<?=$_GET['id']?>";

			$.post("update_menu.php?role_id="+role_id, { 'mergeDT[]': data },
			function(){
			$(".case_product:checked").each(function() {
			//$(this).parent().parent().remove();
			});
			})  .done(function() {



			window.location.href = "menu.php?id=<?=$_GET['id']?>";



			});
	 
		}
 
	});


	});

</script>
 


</body>
</html>
