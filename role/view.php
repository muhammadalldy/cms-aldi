<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["button"]) && $_POST["button"]=="submit"){
	$primaries = array();
	foreach ($_POST as $key=>$value) {
		$index = getTableInd($key);
		$primary_key = getValue('db_list', 'primary_key', 'id', $index);	
		$field = (getDBFieldPost($key));
		if($primary_key != $field){
			$fieldName[] = $field;
			$tableName[] = getValue('db_list', 'title', 'id', $index);
			$valueName[] = $value; 
		} else {
			$primaries[$field] = $value;
		}
	}
	$i = 0;
	foreach($tableName as $table){
		$pk = getValue('db_list', 'primary_key', 'title', $table);
		 $sql = "UPDATE $table SET $fieldName[$i]='".$valueName[$i]."' WHERE $pk='".$primaries[$pk]."'";
		 $db->query($sql);
		$i++;
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
									<h6 class="card-title"><?=$fn?> <?=ucwords(str_replace("_"," ",$title))?></h6>
									<div class="header-elements">
									<a href="index.php" class="btn btn-primary"><i class="icon-backward  mr-2"></i> Back</a>
									</div>
								</div>
                                <?php
                          
									$sql = "
											SELECT ne.id, ne.role
											FROM roles ne 
											WHERE ne.id = '".$_GET['id']."'
									";

									$data = $db->query($sql)->fetchArray();
                                ?>
								<div class="card-body">
 				                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?=$_GET['id']?>">

										<div class="form-group">
											<label>Role ID:</label>
											<input type="text" name="txt04_id" value="<?=$data['id']?>" class="form-control" placeholder="Role ID" readonly required>
										</div>

										<div class="form-group">
											<label>Role:</label>
											<input type="text" name="txt04_role" value="<?=$data['role']?>" class="form-control" placeholder="Role Name"  required>
										</div>
 

										<?php if($_GET['e'] == "1"){?>
                                        <div class="text-right">
											<button type="submit" name="button" value="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
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
