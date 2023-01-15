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
			{ data: null, title: '', wrap: true, "render": function (item) { return '<a data-popup="tooltip" title="Student Score" target="_blank" href="grade.php?id=' + item.id + '" class="badge"  style="background: #2980b9; color: #fff"><i class="icon-stats-bars2 "></i></a>' } }, 
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
                    $('#username').val(data.username);  
                    $('#name').val(data.name);  
                    $('#email').val(data.email);   
                    $('#phone').val(data.phone);   

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
});


</script> 