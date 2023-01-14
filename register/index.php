<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["action"]) && $_POST["action"]=="submit"){

	$sql = "SELECT count(*) as total_dt FROM users WHERE username='".addslashes($_POST['username'])."'  ";
    $users = $db->query($sql)->fetchArray();

  
	if($users['total_dt'] == 0){

		$sql = "INSERT INTO users SET username='".addslashes($_POST['username'])."', 
											password='".md5($_POST['password'])."' ";		
		$db->query($sql);


        $sql = "SELECT id, username FROM users WHERE username='".addslashes($_POST['username'])."'  ";
        $users = $db->query($sql)->fetchArray();



		$sql = "INSERT INTO `profile` SET id_user='".$users['id']."', 
											name='".addslashes($_POST['name'])."' ";		
		$db->query($sql);




        $_SESSION['is_login'] = 1;
        $_SESSION['id_user']  = $users['id'];
        $_SESSION['username'] = $users['username'];
        $_SESSION['userrole'] = '2';
        $_SESSION['timestamp']=time();

        $sql = "INSERT INTO login_tracking SET created_date='".date("Y-m-d H:i:s")."', username='".addslashes($_POST['username'])."'  ";
        $db->query($sql);        


		echo("<script>window.location.href = '../dashboard/'; </script>");
	} else {

		echo("<script>alert('Username sudah digunakan.'); </script>");

	}
	/*
	$users = $db->query($sql)->fetchArray();
	if(count($users) > 0){
		$_SESSION['is_login'] = 1;
		$_SESSION['username'] = $users['username'];
		echo("<script>window.location.href = '../dashboard/'; </script>");
	}
	*/	
}
?>
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-lg navbar-dark navbar-static shadow-sm">
		<div class="navbar-brand ml-2 ml-lg-0">
			<a href="index.html" class="d-inline-block">
				<img src="global_assets/images/logo_light.png" alt="">
			</a>
		</div>

		<div class="d-flex justify-content-end align-items-center ml-auto">
			<ul class="navbar-nav flex-row">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link">
						<i class="icon-lifebuoy"></i>
						<span class="d-none d-lg-inline-block ml-2">Support</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="/register" class="navbar-nav-link">
						<i class="icon-user-plus"></i>
						<span class="d-none d-lg-inline-block ml-2">Register</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="/login" class="navbar-nav-link">
						<i class="icon-user-lock"></i>
						<span class="d-none d-lg-inline-block ml-2">Login</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login form -->
					<form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<input type="hidden" name="action" value="submit">
						<div class="card mb-0">
                            <div class="card-body shadow">
								<div class="text-center mb-3">
									<i class="icon-reading icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
									<h5 class="mb-0">Register to your account</h5>
									<span class="d-block text-muted">Enter your credentials below</span>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left  shadow-sm">
									<input type="text" name="username" class="form-control" placeholder="Username">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left  shadow-sm">
									<input type="text" name="name" class="form-control" placeholder="Full Name">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left  shadow-sm">
									<input type="password" name="password" class="form-control" placeholder="Password">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>

								<div class="form-group  shadow-sm">
									<button type="submit" class="btn btn-primary btn-block">Sign up</button>
								</div>

								<!--div class="text-center">
									<a href="login_password_recover.html">Forgot password?</a>
								</div-->
							</div>
						</div>
					</form>
					<!-- /login form -->

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
