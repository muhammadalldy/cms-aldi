

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
		 
		  "scrollY": "340px",
		  "scrollCollapse": true,
		 
        'ajax': {
            'url':'index_data.php',
            'data': function(data){
                var name = $('#searchByName').val();
                var intake = $('#searchByIntake').val();
                var dept_unit = $('#searchByFaculty').val();
                var code = $('#searchByProgram').val();
                var status = $('#searchByStatus').val();
                var mentor = $('#searchByMentor').val();
				
				
				
                var current = $('#searchByCurrent').val();
				
                data.searchByCurrent = current;
                data.searchByName = name;
                data.searchByIntake = intake;
                data.searchByFaculty = dept_unit;
                data.searchByProgram = code;
                data.searchByStatus = status;
                data.searchByMentor = mentor;
            }
        },
        'columns': [
			            
	        { data: 'name' }, 
	        { data: 'name' }, 
	        { data: 'id' }, 

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
					<?php if($_SESSION['userrole'] !='900'){?>
					return '<a id="'+row.id+'" href="#"  class=" edit_data"   data-toggle="modal" data-target="#modal_large">'+data+'</a>';
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
            

        ],
	
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
                    $('#email').html(data.email);   
					
					if(data.image_student == ""){
						imgdata = '../img/profile.png';
					} else {
						imgdata = '../img/'+data.image_student;
					}
					
                    $('#image_student').attr('src',imgdata); 
				 

            }  
        });  
    }); 	 
    
    



});



 					
					
    




</script> 