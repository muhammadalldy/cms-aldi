<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["button"]) && $_POST["button"]=="submit"){

	foreach($_POST as $key=>$value)
	{
        if($key != "id"){
            $varTableValue[$varModuleTableList[getTableInd($key)]][getDBFieldPost($key)]=$value;
        }
	}
	foreach($varTableValue as $key=>$value) 
	{
		if(strlen($key)>0)
		{   
            $sql = genUpdateSQL($key,$value,$_POST['id']);
			$db->query($sql);
		}
	}
    echo("<script>window.location.href = 'edit.php?id=".$_POST['id']."'; </script>");
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
									<h6 class="card-title">Edit <?=ucfirst($title)?></h6>
									<div class="header-elements">
									<a href="index.php" class="btn btn-primary"><i class="icon-backward  mr-2"></i> Back</a>
									</div>
								</div>
                                <?php
                                    $sql = "SELECT * FROM menu WHERE id = '".$_GET['id']."'";
                                    $data = $db->query($sql)->fetchArray();
                                ?>
								<div class="card-body">
 				                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?=$_GET['id']?>">

										<div class="form-group">
											<label>Title:</label>
											<input type="text" name="txt01_title" value="<?=$data['title']?>" class="form-control" placeholder="Title" required>
										</div>

										<div class="form-group">
											<label>File Name:</label>
											<input type="text" name="txt01_filename" value="<?=$data['filename']?>" class="form-control" placeholder="File name" required>
										</div>

                                        <div class="form-group">
											<label>ID Parent:</label>
											<input type="number" name="txt01_id_parent" value="<?=$data['id_parent']?>" class="form-control" placeholder="ID Parent" required>
										</div>

                                        <div class="form-group">
											<label>Ordering:</label>
											<input type="number" name="txt01_ordering" value="<?=$data['ordering']?>" class="form-control" placeholder="Ordering" required>
										</div>


                                        <div class="form-group">
											<label>Icon:</label>
                                            <select name="txt01_icon" class="custom-select" required>
                                                <?=dd_menu('lookup_icon', 'icon_data', 'icon_data', 'asc', $data['icon'])?>
                                            </select>
										</div>

                                        <div class="form-group">
											<label>Status:</label>
                                            <select name="txt01_is_active" class="custom-select" required>
                                                <?=dd_menu('lookup_active', 'id', 'id', 'asc', $data['is_active'])?>
                                            </select>
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
