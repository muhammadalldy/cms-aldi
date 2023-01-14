<div class="card shadow-sm">
    <div class="card-body">
        <div>
            <table style="margin-bottom: 12px">
                <tr>
                    <td>
                        <input type='text' id='searchByName' class="form-control form-control-sm" placeholder='Search Friend'>
                    </td>
                        
                </tr>
            </table> 
            
            <table id='dataTable' class="table table-hover" > 
                <thead>
                    <tr>
                        <th   data-orderable="false"></th> 
                        <th data-orderable="false">Name</th> 
                        <th data-orderable="false">Email</th> 											 
                        <th data-orderable="false">Email</th> 											 
                    </tr>
                </thead> 
            </table>
        </div>						
    </div>
</div>



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
			{ data: null, title: '', width: '50px', wrap: true, "render": function (item) { return '<a data-popup="tooltip" title="Student Score" target="_blank" href="grade.php?id=' + item.matrix_no + '" class="badge"  style="background: #2980b9; color: #fff"><i class="icon-envelope "></i></a>' } }, 
		

			
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
					return '<a id="'+row.id+'" href="profile.php?id='+row.id+'"  >'+data+'</a>';
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
	
	   
    $('#searchByName').keyup(function(){
        dataTable.draw();
    });
    



});



 					
					
    




</script> 