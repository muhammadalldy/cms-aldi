<script>
$(document).ready(function(){
    var dataTable = $('#dataTable').DataTable({
        'pageLength' : 10,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'searching': false, 
	    "language": { processing: '<i class="icon-spinner2 spinner"></i><span class="sr-only">Loading...</span> '},		
		"scrollY": "340px",
		"scrollCollapse": true,
        'ajax': {
            'url':'index_data.php',
            'data': function(data){
                var name = $('#searchByName').val();
                var role = $('#searchByRole').val();
                data.searchByRole = role;
                data.searchByName = name;
            }
        },
        'columns': [
	        { data: 'name' }, 
	        { data: 'name' }, 
	        { data: 'role' }, 
	        { data: 'created_date', width: '200px' }, 
        ],
        columnDefs: [
            {
                render: function (data, type, row) {
					
					if(row.image == ''){
						pic = 'profile.png';
					} else {
						pic = row.image;						
					}
					<?php if ($_SESSION['userrole'] !='900') {?>
					return '<a id="'+row.id+'" href="#"  class=" edit_data"   data-toggle="modal" data-target="#modal_large">'+data+'</a>';
					<?php } else {?>
					return data;
					<?php } ?>
                },
                targets: 1
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
                width: "20px"
            },
            

        ],
	
    });
	
    $('#searchByName').keyup(function(){
        dataTable.draw();
    });	 

    $('#searchByRole').change(function(){
        dataTable.draw();
    });

    $(document).on('click', '.edit_data', function(){  
        var id = $(this).attr("id"); 
        $.ajax({  
            url:"index_modal_data.php",  
            method:"POST",  
            data:{id:id},  
            dataType:"json",  
            success:function(data){ 	
                console.log(data);							
                    $('#id_user').val(data.id_user);  
                    $('#username').val(data.username);  
                    $('#name').val(data.name);  
                    $('#email').val(data.email);   
                    $('#phone').val(data.phone);   
                    $('#zip_code').val(data.zip_code);   

                    $('#pob').val(data.pob);   
                    $('#dob').val(data.dob);   

                    $('#address_ic').val(data.address_ic);   
                    $('#address_now').val(data.address_now);   

                    $('#country').val(data.country);   
                    $('#state').val(data.state);   
                    $('#city').val(data.city);   


                    $('#district').val(data.district);   
                    $('#sub_district').val(data.sub_district);   

                    image = '../files/image/'+data.image;
					console.log(image);
					console.log(image);
                    $('#image').attr('src',image); 
				 

            }  
        });  
    }); 
    
    






    $('#update_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#name').val() == "")  
           {  
                alert("Name is required");  
           }  
           else if($('#address').val() == '')  
           {  
                alert("Address is required");  
           }  
           else if($('#designation').val() == '')  
           {  
                alert("Designation is required");  
           }  
           else if($('#age').val() == '')  
           {  
                alert("Age is required");  
           }  
           else  
           {  
                $.ajax({  
                     url:"index_modal_update.php",  
                     method:"POST",  
                     data:$('#update_form').serialize(),  
                     beforeSend:function(){  
                          //$('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                        $('.toast').toast('show');
                        console.log(data);
                          //$('#update_form')[0].reset();  
                        $('#modal_large').modal('hide');  
                        $('#dataTable').DataTable().ajax.reload();
                         // $('#employee_table').html(data);  
                     }  
                });  
           }  
      });  









});


</script> 