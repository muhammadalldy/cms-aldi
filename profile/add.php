<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["button"]) && $_POST["button"]=="submit"){

	foreach($_POST as $key=>$value)
	{
		$varTableValue[$varModuleTableList[getTableInd($key)]][getDBFieldPost($key)]=$value;
	}
	foreach($varTableValue as $key=>$value) 
	{
		if(strlen($key)>0)
		{   
            $sql = genInsertSQL($key,$value);
			$db->query($sql);
		}
	}

    
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
									<h6 class="card-title">Add <?=ucfirst($title)?></h6>
									<div class="header-elements">
									<a href="index.php" class="btn btn-primary"><i class="icon-backward  mr-2"></i> Back</a>
									</div>
								</div>
								<div class="card-body">
 				                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

										<div class="form-group">
											<label>Username:</label>
											<input type="text" name="txt02_username" class="form-control" placeholder="Username" required>
										</div>

										<div class="form-group">
											<label>Password:</label>
											<input type="text" name="txt02_password" class="form-control" placeholder="Password" required>
										</div>

										<div class="form-group">
											<label>Full Name:</label>
											<input type="text" name="txt02_fullname" class="form-control" placeholder="Full Name" required>
										</div>
 

                                        <div class="form-group">
											<label>Status:</label>
                                            <select name="txt02_is_active" class="custom-select" required>
                                                <?=dd_menu('lookup_active', 'id', 'id', 'asc', '')?>
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
