
		            <!-- Bio modal -->
					<div id="modal_addfriend" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Friend</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form id="update_form" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="submit_bio"> 
								<div class="modal-body">
									
 
 

					                        <div class="form-group">
					                        	<div class="row">

													<div class="col-lg-12">
														
														<input type="hidden" id="modal_id_user" name="modal_id_user" readonly> 
														Add <span id="modal_name" style="font-weight: bold"></span> as a friend?
													</div>
					                        	</div>
					                        </div>




								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" id="submit" name="button" style="background: #2980b9; color: #fff; border: none" value="edit" class="btn btn-primary">Add Friend</button>
								</div>

								</form>
							</div>
						</div>
					</div>
					<!-- /basic modal -->




		            <!-- Bio modal -->
					<div id="modal_confirmfriend" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Confirm Friend</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form id="confirm_form" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="submit_bio"> 
								<div class="modal-body">
									
 
 

					                        <div class="form-group">
					                        	<div class="row">

													<div class="col-lg-12">
														
														<input type="hidden" id="modal_id_user2" name="modal_id_user2" readonly> 
														Confirm <span id="modal_name2" style="font-weight: bold"></span> as a friend?
													</div>
					                        	</div>
					                        </div>




								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" id="submit" name="button" style="background: #2980b9; color: #fff; border: none" value="edit" class="btn btn-primary">Confirm Friend</button>
								</div>

								</form>
							</div>
						</div>
					</div>
					<!-- /basic modal -->







<script>


$(document).ready(function(){
    var dataTable = $('#dataTable').DataTable({
        'pageLength' : 10,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
		"info": false, 
        
        'searching': false, 
	    "language": { processing: '<i class="icon-spinner2 spinner"></i><span class="sr-only">Loading...</span> '},		
		  "scrollY": "300px",
		  "scrollCollapse": true,
        'ajax': {
            'url':'friend_list_data.php',
            'data': function(data){
                var name = $('#searchByName').val();
				
				
                data.searchByName = name;
            }
        }, 
        'columns': [
			            
	        { data: 'name', name: 'id' , width: '100px', class: 'text-center'}, 
	        { data: 'name' }, 
	        { data: 'email' }, 
			{ data: null, title: '' }, 
			
 
			
        ],


        columnDefs: [
            {

                render: function (data, type, row) {
					
					if(row.image == ''){
						pic = 'profile.png';
					} else {
						pic = row.image;						
					}
					<?php if($_SESSION['userrole'] !='900'){?>
					return '<a id="'+row.id+'" href="../profile/index.php?id='+row.id+'"  >'+data+'</a>';
					<?php } else {?>
					return data;
					<?php } ?>
                },
                targets: 1,
            },
            {

                render: function (data, type, row) {
					
					if(row.image == ''){
						pic = 'profile.png';
					} else {
						pic = row.image;						
					}
	
					return '<img src="../files/image/'+pic+'"  style="height: 40px">';
                },
                targets: 0,
				"className": "text-center",
            },
            {

                render: function (data, type, row) {
					
					if(row.approval_status == '2'){
						return '<a data-popup="tooltip" title="Friend"  class="badge disabled"  style="background: #27ae60; color: #fff"><i class="icon-envelope "></i></a>';
					} else if(row.approval_status == '1'){
						return '<a data-popup="tooltip" title="Confirm Friend" id="'+row.id+'" href="#" class="badge confirm_data"  data-toggle="modal" data-target="#modal_confirmfriend"  class="badge"  style="background: #27ae60; color: #fff"><i class="icon-user-plus "></i></a>';
					} else if(row.approval_status == '9'){
						return '<a data-popup="tooltip" title="Request Sent" href="#" class="badge disabled"  style="background: #064670; color: #fff"><i class="icon-user "></i></a>';
					} else {
						return '<a data-popup="tooltip" title="Add Friend" id="'+row.id+'" href="#" class="badge edit_data"  data-toggle="modal" data-target="#modal_addfriend"  class="badge"  style="background: #2980b9; color: #fff"><i class="icon-user-plus "></i></a>';
					}
	
                },
                targets: 3,
				"className": "text-center",
            },


        ],
	
    });
	
	   
    $('#searchByName').keyup(function(){
        dataTable.draw();
    });
    
    $(document).on('click', '.edit_data', function(){  
        var id = $(this).attr("id"); 
        $.ajax({  
            url:"friend_modal_data.php",  
            method:"POST",  
            data:{id:id},  
            dataType:"json",  
            success:function(data){ 	
                console.log(data);							
                    $('#modal_id_user').val(data.id);  
                    $('#modal_name').html(data.name);  
            
				
				 

            }  
        });  
    }); 	 
    
    
    $(document).on('click', '.confirm_data', function(){  
        var id = $(this).attr("id"); 
        $.ajax({  
            url:"friend_modal_data.php",  
            method:"POST",  
            data:{id:id},  
            dataType:"json",  
            success:function(data){ 	
                console.log(data);							
                    $('#modal_id_user2').val(data.id);  
                    $('#modal_name2').html(data.name);   
            }  
        });  
    }); 	 

    $('#update_form').on("submit", function(event){  
           event.preventDefault();  
           
                $.ajax({  
                     url:"profile_addfriend.php",  
                     method:"POST",  
                     data:$('#update_form').serialize(),  
                     beforeSend:function(){  
                          //$('#insert').val("Inserting");  
                     },  
                     success:function(data){  
						window.location.reload();
                        $('.toast').toast('show');
                        console.log(data);
                          //$('#update_form')[0].reset();  
                        $('#modal_addfriend').modal('hide');  
                         // $('#employee_table').html(data);  
                     }  
                });  
          
      });  


	  $('#confirm_form').on("submit", function(event){  
           event.preventDefault();  
           
                $.ajax({  
                     url:"profile_confirmfriend.php",  
                     method:"POST",  
                     data:$('#confirm_form').serialize(),  
                     beforeSend:function(){  
                          //$('#insert').val("Inserting");  
                     },  
                     success:function(data){  
						window.location.reload();
                        $('.toast').toast('show');
                        console.log(data);
                          //$('#update_form')[0].reset();  
                        $('#modal_confirmfriend').modal('hide');  
                         // $('#employee_table').html(data);  
                     }  
                });  
          
      });  


});



 					
					
    




</script> 