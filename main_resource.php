<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	date_default_timezone_set("Asia/Jakarta");
	include("config/lib/common.php");
	
	
	
 
	if(isset($_POST["action"]) && $_POST["action"]=="logout"){


			$sql = "UPDATE users SET online_status='0', last_session='".date("Y-m-d H:i:s")."' WHERE username='".$_SESSION['username']."' ";
		
		$db->query($sql);
		session_unset();
		session_destroy();
		
	}	
	
	
	$title = explode("/", substr($_SERVER['REQUEST_URI'], 1))[0];
	$fn0 = basename($_SERVER["SCRIPT_FILENAME"]);
	$fn = ucfirst(basename($_SERVER["SCRIPT_FILENAME"], '.php')); 
	if($fn == "Index"){
		$fn = "Home";
	} 
	 $fn = ($_GET['e'] == 1) ? "Edit" : $fn;

	$check = explode("/", substr($_SERVER['REQUEST_URI'], 1))[0];
	$bypass = array('login','register');




	$sql = "
	SELECT bm.filename 
	FROM menu bm 
	LEFT JOIN menu_role bml ON bml.menu_id = bm.id
	WHERE bm.is_active='ACTIVE' 
	AND bml.menu_id IS NOT NULL
	AND bml.role_id='".$_SESSION['userrole']."'
	ORDER BY bm.ordering ASC";
	$AccessMenus = $db->query($sql)->fetchAll();
	$AccessUser = array();
	foreach($AccessMenus as $AccessMenu){
		$AccessUser[] = explode("/",$AccessMenu['filename'])[0];
		
	}
	
 	if ($_SESSION['is_login'] == 1) {

		$AccessUser[] = "dashboard";
		$AccessUser[] = "account";

		if($_SESSION['userrole'] != "900"){
			$AccessUser[] = "account";	
			$AccessUser[] = "class_registration";	
		}

		if($check == "profile" && $fn == "Edit"){
			
		} else if ($check == "student" && $fn == "View") {
		} else if (!in_array($check, $AccessUser) && count($_SESSION) > 0) {
			echo("<script>alert('You dont have access for this module.'); </script>");
			echo("<script>window.location.href = '../dashboard/'; </script>");
		} else {}

	}
	

 
	if (!in_array($check,$bypass) && count($_SESSION) == 0) {

		echo("<script>window.location.href = '../login/'; </script>");
		session_unset();
		session_destroy();
	}





 



	 
 




?>
<link rel="icon" href="../icon_jgu.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>CMS Aldi | <?=ucfirst($title)?> - <?=$fn?></title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="../config/assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
<link href="../config/assets/css/all.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- JS files -->
<script src="../config/assets/js/main/jquery.min.js"></script>
<script src="../config/assets/js/main/bootstrap.bundle.min.js"></script>
<script src="../config/assets/js/app.js"></script>
<script src="../config/assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="../config/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script src="../config/assets/js/pages/datatables_basic.js"></script>
<script src="../config/assets/js/pages/datatables_responsive.js"></script>
<!-- /JS files -->


 
 
 



<style>

.table td, .table th {
  padding: .15rem .15rem;
  vertical-align: top;
  border-top: 1px solid #ddd;
}
.btn-group-sm > .btn, .btn-sm {
  padding: 0 .75rem;
  font-size: .8125rem;
  line-height: 1.6924;
  border-radius: .1875rem;
}
 

.btn-primary {
  color: #fff;
  background-color: #263238;
  border-color: #263238;
}
.btn-primary:hover {
  color: #fff;
  background-color: #263238;
  border-color: #263238;
}
</style>
  
<?php

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	$device = 1;
} else {
	$device = 0;	
}

 

?>

<style>

.navbar-dark {
  color: #1e272e;
  background-color: #fff;
  border-bottom-color: rgba(255,255,255,.1);
}

.navbar-dark .navbar-nav > li > a {
    color: #000; 
}
.nav > li > a:hover,
.nav > li > a:focus {
    text-decoration: none;
    background-color: #000;
}

.navbar-dark .navbar-nav-link:focus, .navbar-dark .navbar-nav-link:hover {
  color: #1e272e;
  background-color: #F5F5F5;
}



.sidebar-dark {
  background-color: #fff;
  color: #1e272e;
}

.sidebar-dark .nav-sidebar .nav-item-header {
   color: #1e272e;
}

.sidebar-dark .nav-sidebar .nav-item-header {
   color: #1e272e;
}

.sidebar-dark .nav-sidebar .nav-link:not(.disabled):hover {
  color: #1e272e;
  background-color: #f2f2f2;
}

.sidebar-dark .nav-sidebar .nav-link {
   color: #1e272e;
}
.sidebar-dark .nav-sidebar .nav-item-open > .nav-link:not(.disabled), .sidebar-dark .nav-sidebar > .nav-item-expanded:not(.nav-item-open) > .nav-link {
  background-color: #E5E5E5;
   color: #1e272e;
}

.sidebar-dark .nav-sidebar .nav-item > .nav-link.active {
  background-color: #F5F5F5;
  color: #1e272e;
}

.sidebar-dark .nav-sidebar > .nav-item-submenu > .nav-group-sub {
  background-color: #fff;
}

.nav > li > a:hover, .nav > li > a:focus {
  text-decoration: none;
  background-color: #F5F5F5;
}


.icon-cross2 {
	color: #1e272e;
}

.dataTables_paginate .paginate_button.current, .dataTables_paginate .paginate_button.current:focus, .dataTables_paginate .paginate_button.current:hover {
  color: #fff;
  background-color: #2980b9;
}


.navbar-dark .active > .navbar-nav-link, .navbar-dark .navbar-nav-link.active, .navbar-dark .navbar-nav-link.show, .navbar-dark .show > .navbar-nav-link {
  color: #000;
  background-color: rgba(255,255,255,.1);
}
</style>