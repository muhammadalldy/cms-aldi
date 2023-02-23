<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

require '../vendor/autoload.php';
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
 
$max_token = 100;



$sql = "SELECT id, LOWER(title) AS title FROM `user_sys_menu` ORDER BY title";

$sql = "
SELECT um.id, LOWER(md.module_name) AS module, LOWER(um.title) AS submodule
FROM `user_sys_menu` um 
LEFT JOIN `user_sys_module` md ON md.module_id = um.module
LEFT JOIN `robot` r ON r.id_parent = um.id
WHERE r.id IS NULL
ORDER BY um.title
";

$datas = $db->query($sql)->fetchAll();
 
						 
foreach ($datas as $data) { 
	
	$_POST['question'] = "write me a brief one-sentence description for the ".addslashes($data['submodule'])." sub-module in the context of ".addslashes($data['module'])." module ";

	echo("<br/>");

 
	$created_date = date("Y-m-d H:i:s");
	$date_id = date("YmdHis");
	$sql = "
			   INSERT INTO robot 
			   SET 
			   role='".$_SESSION['userrole']."',
			   question='".addslashes($_POST['question'])."', 
			   id_parent='".$data['id']."', 
			   date_id='".$date_id."', 
			   created_date='".$created_date."',
			   id_ownership='0',
			   created_by='".$_SESSION['id_user']."'
		   "; 
  $db->query($sql);
  

 
  $client = OpenAI::client('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');

  $result = $client->completions()->create([
	  'model' => 'text-davinci-003',
	  'prompt' => addslashes($_POST['question']),
	  'max_tokens' => $max_token,
	]);


  
  $answer = ($result['choices'][0]['text']);
   
	$sql = "
		UPDATE robot 
		SET answer='".addslashes($answer)."'
		WHERE date_id='".$date_id."'
	"; 
	$db->query($sql);
 
}

 

if (isset($_POST["action"]) && $_POST["action"]=="delete_feed") {
    $created_date = date("Y-m-d H:i:s");
    $date_id = date("YmdHis");
    $sql = "
			   DELETE FROM robot WHERE id='".$_POST['id_feed']."'
		   ";
    $db->query($sql);
	echo("<script>window.location.href = '../robot/'; </script>");
}
 



$sql = "
	SELECT 
	ua.username, 
	ua.image,
	ua.cover,	
	p.name,
	p.bio,
	p.address,
	p.city,
	p.state,
	p.country,
	p.email,
	p.phone,
	p.zip_code
	FROM users ua
	LEFT JOIN profile p ON p.id_user = ua.id
	WHERE ua.id='".$_SESSION['id_user']."'
";
//$data = $db->query($sql)->fetchArray();
?>

<style>


#upload_link{
    text-decoration:none;
}
#upload{
    display:none
}










/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
   .modal_loading {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal_loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal_loading {
    display: block;
}










</style>

</head>

<body>


	<?php include('../main_navbar.php'); ?>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg  shadow-sm">

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


				<!-- Page header -->
				<div class="page-header page-header-light">


					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="#" class="breadcrumb-item active">Home</a>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<!--div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">
								<a href="#" class="breadcrumb-elements-item">
									<i class="icon-user-plus mr-2"></i>
									Add Course
								</a>

							</div>
						</div-->
					</div>
				</div>
				<!-- /page header -->
		

				<!-- Content area -->
				<div class="content">

					<!-- Search field -->
					<div class="card">
						<div class="card-body">
							<form id="formRobot" action="#" method="post">
								<input type="hidden" name="action" value="submit">
								<input type="hidden" name="id_parent" value="0">
								<div class="d-sm-flex">
									<div class="form-group-feedback form-group-feedback-left flex-grow-1 mb-3 mb-sm-0">
										<input id="question" type="text" name="question" class="form-control form-control-lg" placeholder="Ask the robot...">
										<div class="form-control-feedback form-control-feedback-lg">
											<i class="icon-search4 text-muted"></i>
										</div>
									</div>

									<!--div class="dropdown ml-sm-3 mb-3 mb-sm-0">
										<select class="custom-select custom-select-lg">
											<option value="0">All categories</option>
											<option value="1">Getting started</option>
											<option value="2">Registration</option>
											<option value="3">General info</option>
											<option value="4">Your settings</option>
											<option value="5">Copyrights</option>
											<option value="6">Contacting authors</option>
										</select>
									</div-->

									<div class="ml-sm-3">
										<button id="submitButton"  class="btn btn-primary btn-lg w-100 w-sm-auto">Ask</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /search field -->


					








 						<?php
							$dtold = "";
						

							$sql = "

							SELECT fc.file_extension, fc.img, fc.id, s.id_user AS userid, LOWER(s.name) AS name, 
							fc.question, fc.answer, fc.created_date, u.image, '' AS back_title,
							fc.id_ownership, LOWER(r.name) AS rname, r.id_user as rid
							FROM `robot` fc 
							LEFT JOIN `profile` s ON fc.created_by = s.id_user
							LEFT JOIN `profile` r ON fc.id_ownership = r.id_user
							LEFT JOIN `users` u ON u.id = s.id_user
							WHERE fc.id_parent='0' 
							ORDER BY fc.created_date DESC

							";

							$datas = $db->query($sql)->fetchAll();

						?>
 
						<?php foreach ($datas as $data) {  ?>
									 
						 
						 

							<!-- Tasks -->
							<div class="timeline-row">
							
								<div id="robot_content">
								</div>
								<div>
								<?php
									$newDate = date("d-m-Y H:i:s", strtotime($data['created_date']));
								?>	

								<div class="row">
									<div class="col-lg-12" >
										<!--div class="card border-left-3 border-left-primary rounded-left-0"-->
										<div class="card shadow-sm">
										<div class="card-header  header-elements-sm-inline" style="padding-top: 15px; padding-bottom: 5px; ">
											<h6 style="margin: 0px">
												<a href="../profile/index.php<?=($data['userid']!=$_SESSION['id_user'])?"?id=".$data['userid']:""?>"><?=ucwords($data['name'])?></a>
											<?php if($data['id_ownership'] != "0" && ($data['userid'] != $data['rid'])){ ?>
												> <a href="../profile/index.php<?=($data['rid']!=$_SESSION['id_user'])?"?id=".$data['rid']:""?>"><?=ucwords($data['rname'])?></a>
											<?php } ?>
											<span style="font-size: 10px"><?=$newDate?></span>	
											</h6>
											
											<div class="header-elements">
											<?php if($data['userid']==$_SESSION['id_user']){?> 
												<button type="button" class="close delete_feed" id="<?=$data['id']?>" data-toggle="modal" data-target="#modal_delete_feed">×</button>
											<?php } ?>
											</div>
										</div>

											<div class="card-body" style="padding-bottom: 9px">
												<div>
													<div>

														<p>
														 
															<b><?=$data['question']?></b> <br/> <?=$data['answer']?>
													 
														</p>
														
														
													<?php
														$sql = "
														SELECT fc.file_extension, fc.img, fc.id, s.id_user AS userid, LOWER(s.name) AS name, 
														fc.question, fc.answer, fc.created_date, u.image, '' AS back_title
														FROM `robot` fc 
														LEFT JOIN `profile` s ON fc.created_by = s.id_user
														LEFT JOIN `users` u ON u.id = s.id_user
														WHERE fc.id_parent='".$data['id']."'
														ORDER BY fc.created_date ASC
														";
														$subdatas = $db->query($sql)->fetchAll();
													?>
 
													<?php foreach ($subdatas as $subdata) {  ?>
															<span style="font-size: 11px; "><a style="color: #2196f3"><?=ucwords($subdata['name']);?></a> - <b><?=($subdata['question']);?></b><br/> <i><?=($subdata['answer']);?> </i>  </span><br/>
													<?php } ?>
														
													</div>
											 
												</div>
													<form action="#" method="post">
													
													<table style="width: 100%">
													<tr>
													<td style="width: 100%"> 
														<textarea style="font-size: 10px; padding-bottom: 3px; padding-top: 3px;" name="question" class="form-control mb-1" rows="1" cols="1" placeholder="Enter your comment..." required></textarea>
														<input type="hidden" name="id_parent" value="<?=$data['id']?>">
														<input type="hidden" name="action" value="submit">
													</td>
													<td style="width: 20%">
															<button type="submit" name="button" class="badge badge-sm" style="background: #2980b9; color: #fff; float: right">Submit</button>
													</td>



													</tr>
													
													</table>
															 
															
														 
													 

														 
													</form>												
											</div>

										 
										</div>
									</div>

								</div> 
								</div>
							</div>
							<!-- /tasks -->
			
						<?php } ?>



















				</div>
				<!-- /content area -->





				<?php include('../main_footer.php');?>

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->



















		            <!-- Bio modal -->
					<div id="modal_delete_feed" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Delete Feed</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="delete_feed"> 
								<input type="hidden" id="id_feed" name="id_feed"> 
								<div class="modal-body">
									
 
 

					                        <div class="form-group">
					                        	<div class="row">

													<div class="col-lg-12">
														Are you sure want to delete this feed?
													</div>
					                        	</div>
					                        </div>




								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Delete</button>
								</div>

								</form>
							</div>
						</div>
					</div>
					<!-- /basic modal -->
























<script>
$(function(){
$("#upload_link").on('click', function(e){
    e.preventDefault();
    $("#upload:hidden").trigger('click');
});
});





$(document).ready(function(){


	$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});


$(document).on('click', '.delete_feed', function(){  

        var id = $(this).attr("id"); 
		console.log(id);
		$('#id_feed').val(id);    
    }); 	 
    	





	$('#submitButton22').click( function() {
		 
		 
		var name = '<?=getValue('profile', 'name', 'id_user', $_SESSION['id_user'])?>';
		var question = $('#question').val();
		var settings = {
		"url": "https://api.openai.com/v1/completions",
		"method": "POST",
		"timeout": 0,
		"headers": {
			"Authorization": "Bearer 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",
			"Content-Type": "application/json"
		},
		"data": JSON.stringify({
			"prompt": question,
			"max_tokens": <?=$max_token?>,
			"model": "text-davinci-003"
		}),
		};

		$.ajax(settings).done(function (response) {
			answer = (response.choices[0].text);
			console.log(response);

			$.ajax({
				type: "POST",
				url: "insert.php",
				data: { question: question, answer: answer , id_parent: 0 },
				success: function(data) {
					console.log("Data inserted successfully!");
					 
					var card = '<div class="row"><div class="col-lg-12"><div class="card shadow-sm">' +
					  '<div class="card-header  header-elements-sm-inline" style="padding-top: 15px; padding-bottom: 5px; "><h6 style="margin: 0px"><a style="color: #2196f3;text-decoration: none; background-color: transparent; ">'+ name +'</a></h6></div>' +
                      '<div class="card-body" style="padding-bottom: 9px; "><b>' + question + '</b> <br/> ' + answer + '</div>' +
                  '</div></div>';
			        $('#robot_content').append(card);
				 
				}
			});

			 
			
		});

	});












});	





function file_changed(){
	var link = document.getElementById('picture_name');
	link.type = 'text'; //or
	link.style.display = 'show'; //or
	link.style.visibility = 'visible';
	
	var fileName = document.getElementById('upload').files[0].name;
	document.getElementById('picture_name').value = fileName;
	console.log(fileName);

	var link = document.getElementById('text_area');
	link.style.display = 'none'; //or
	link.style.visibility = 'hidden';


}





</script>
 

	</div>
	<!-- /page content -->
	<div class="modal_loading"><!-- Place at bottom of page --></div>
</body>
</html>
