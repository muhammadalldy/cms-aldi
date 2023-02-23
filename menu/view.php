<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php


if(isset($_POST["button"]) && $_POST["button"]=="edit"){
	
    $created_by = $_SESSION['username'];
    $created_date = date("Y-m-d H:i:s");
	 $sql = "
			UPDATE menu
			SET 
			title='".$_POST['title']."',
			id_parent='".$_POST['id_parent']."',
			filename='".$_POST['filename']."',
			is_active='".$_POST['is_active']."',
			ordering='".$_POST['ordering']."',
			icon='".$_POST['icon']."'
			WHERE id='".$_POST['id']."'
	";
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
									<h6 class="card-title">View <?=ucfirst($title)?></h6>
									<div class="header-elements">
									<a href="index.php" class="badge ml-2" style="background: #2980b9; color: #fff; font-size: 10px">  Back</a>

									
									</div>
								</div>
                                <?php
                                    $sql = "SELECT * FROM menu WHERE id = '".$_GET['id']."'";
                                    $data = $db->query($sql)->fetchArray();
                                ?>
								<div class="card-body">
 				                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									 <input type="hidden" name="e" value="<?=$_GET['e']?>">
									 <input type="hidden" name="id" value="<?=$_GET['id']?>">
									 <input type="hidden" name="id" value="<?=$_GET['id']?>">

										<div class="form-group">
											<label>Title:</label>
											<input type="text" name="title" value="<?=$data['title']?>" class="form-control" placeholder="Title" >
										</div>

										<div class="form-group">
											<label>File Name:</label>
											<input type="text" name="filename" value="<?=$data['filename']?>" class="form-control" placeholder="File name" >
										</div>

                                        <div class="form-group">
											<label>ID Parent:</label>
											<input type="number" name="id_parent" value="<?=$data['id_parent']?>" class="form-control" placeholder="ID Parent" >
										</div>

                                        <div class="form-group">
											<label>Ordering:</label>
											<input type="number" name="ordering" value="<?=$data['ordering']?>" class="form-control" placeholder="Ordering" >
										</div>


 
                                        <div class="form-group">
											<label>Icon:</label>
                                            <select name="icon" class="custom-select" required> 
												<?=dd_menu('lookup_icon', 'icon_data', 'icon_data'," -- Please Choose --", '' ,'ASC', $data['icon'])?>
                                            </select>
										</div>

                                        <div class="form-group">
											<label>Status:</label>
                                            <select name="is_active" class="custom-select" required> 
												<?=dd_menu('lookup_active', 'id', 'id'," -- Please Choose --", '' ,'ASC', $data['is_active'])?>
                                            </select>
                                        </div>


										<?php if($_GET['e'] == 1){?>
                                        <div class="text-right">
											<button type="submit" name="button" class="badge ml-2" style="background: #2980b9; color: #fff; font-size: 10px">Submit </button>
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
