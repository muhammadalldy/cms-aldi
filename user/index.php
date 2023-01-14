<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('../main_resource.php'); ?>
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
	<div class="page-content">
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg shadow-sm">
			<div class="sidebar-content">
                <?php include('../main_navigation.php');?>
			</div>
		</div>
		<div class="content-wrapper">
			<div class="content-inner"> 
				<div class="content" style="padding-bottom: 0px">
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow-sm">
								<div class="card-header header-elements-inline">
									<h5 class="card-title" style="color: #47b1d7">
										User
									</h5>
									<div class="header-elements">
									<?php if ($_SESSION['userrole']!='900') { ?>
									<a href="index_excel.php" target="_blank" class="badge ml-2" style="background: #2980b9; color: #fff; font-size: 10px">Export to Excel</a>
									<?php } ?>
									</div>
								</div>
								<div class="card-body">	
									<div>
										<table style="margin-bottom: 12px">
											<tr>
												<td>
													<input type='text' id='searchByName' class="form-control form-control-sm" placeholder='Search User'>
												</td>
										
												<td>
													<select id='searchByRole' class="form-control form-control-sm" >
														<?=dd_menu('role', 'id', 'name'," -- Role --", '' ,'ASC', '')?>
													</select>
												</td>
											</tr>


										</table> 
										<table id='dataTable' class="table table-hover" > 
											<thead>
												<tr>
													<th style="width: 100px;"  data-orderable="false"></th> 
													<th style="width: 250px;" data-orderable="false">Name</th> 
													<th data-orderable="false">Role</th> 
													<th data-orderable="false">Email</th> 
												</tr>
											</thead> 
										</table>
									</div>						
								</div>
							</div>
                        </div>
                    </div>
				</div>
				<?php include('../main_footer.php');?>
			</div>
		</div>
	</div>
	<?php include('index_modal_view.php');?>
	<?php include('index_script.php');?>
</body>
</html>
