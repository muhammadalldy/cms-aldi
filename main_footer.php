



<!--script>


function update_user_online()
{
	var action_activity_update = 'fetch_data';
	$.ajax({
	url:"../online.php",
	method:"POST",
	data:{action_activity_update:action_activity_update},
	success:function(data)
	{
		$('#user_login_status').html(data); 
	}
	});
}
setInterval(function(){ 
 update_user_online();
}, 10000);

function update_user_activity()
{
	var action_activity_update = 'update_time';
	$.ajax({
	url:"../action.php",
	method:"POST",
	data:{action_activity_update:action_activity_update},
	success:function(data)
	{
	 
	}
	});
}
setInterval(function(){ 
 update_user_activity();
}, 10000);

</script-->



 

<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top shadow-sm">
	<div class="text-center d-lg-none w-100">
		<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
			<i class="icon-unfold mr-2"></i>
			&copy; 2022. <a href="#">CMS Aldi</a> 
		</button>
	</div>

	<div class="navbar-collapse collapse" id="navbar-footer">
		<span class="navbar-text">
			&copy; 2022. <a href="#">CMS Aldi</a> 
		</span>

		<ul class="navbar-nav ml-lg-auto">
			<li class="nav-item"><a target="_blank" href="https://helpdesk.jgu.ac.id/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
			<li class="nav-item"><a target="_blank" href="https://docs.jgu.ac.id/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
			<?php if($_SESSION['userrole'] !='900'){?>
			<li class="nav-item"><a target="_blank" href="https://aims.jgu.ac.id" class="navbar-nav-link font-weight-semibold"><span class="text-pink"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>
			<?php } ?>
		</ul>
	</div>
</div>
<!-- /footer -->