<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../main_resource.php'); ?>
<?php

if(isset($_POST["action"]) && $_POST["action"]=="delete"){

	//$sql = "DELETE FROM user_role WHERE id='".$_POST['id']."'";
	//$db->query($sql);
	//echo("<script>window.location.href = 'index.php'; </script>");
}

$std_type = getValue('student', 'std_type', 'matrix_no', $_GET['id']);	
$nim = getValue('student', 'rel_mat_no', 'matrix_no', $_GET['id']);	


$grand_sbj = 0;
$grand_ch = 0;
$grand_gpa = 0;
$n = 0;
?>


</head>

<body>


	<?php include('../main_navbar.php'); ?>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg shadow-sm">

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

			<?php include('../page_header.php');?>

				<!-- Content area -->
				<div class="content">

					<!-- Main charts -->
					<div class="row">

  



 



<?php


										 	$sql = "
											SELECT MAX(session_id) AS sess
											FROM std_clearance sc 
											WHERE sc.matrix_no = '".$_GET['id']."'
											AND lab='1' 
											AND fin='1' 
											AND lpm='1' 
											AND (exam='0' OR exam='1')
											AND (baak='0' OR baak='1')
											";
											$datas = $db->query($sql)->fetchArray();
											$sess = $datas['sess'];


										 	$sql = "
											SELECT MAX(session_id) AS sess
											FROM std_clearance sc 
											WHERE sc.matrix_no = '".$_GET['id']."'
											AND lab='1' 
											AND fin='1' 
											AND lpm='1' 
											AND (exam='0' OR exam='1')
											AND (baak='0' OR baak='1')
											";
											$datas = $db->query($sql)->fetchArray();
											$sess = $datas['sess'];


		$sqlGPA_all=" 
SELECT 'f' AS ctg, s.matrix_no, s.name AS student_name, sf.kode_mata_kuliah AS subject_code, sbj.subject_eng, sbj.sub_desc AS subject_id, 
sf.id_semester AS semester_id, sf.nilai_huruf AS grade, 
sf.sks_mata_kuliah AS cre_hour, gt.grade_index AS grade_index,
(gt.grade_index*sf.sks_mata_kuliah) AS weight,
sbj.sub_desc, 
COUNT(sf.kode_mata_kuliah) AS total_subject,
SUM(sbj.cre_hour) AS all_cre,
sf.id_semester,
ss.semester_jgu,
ROUND((SUM(IF(sf.nilai_huruf='A',4,IF(sf.nilai_huruf='B',3,IF(sf.nilai_huruf='C',2,IF(sf.nilai_huruf='D',1,IF(sf.nilai_huruf='E',0,0)))))*sbj.cre_hour))/(SUM(sbj.cre_hour)),2) AS cgpa
FROM student s
LEFT JOIN score_feeder sf ON sf.nim = s.rel_mat_no
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_mata_kuliah
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf
LEFT JOIN semester_feeder ss ON ss.semester = sf.id_semester
WHERE s.matrix_no='".$_GET['id']."'
AND ss.semester_jgu <= '".$sess."'
AND sf.nama_mata_kuliah != '' 
GROUP BY s.matrix_no 	
ORDER BY sf.kode_mata_kuliah, sf.id_semester


			
		"; 
		
		
		$rs = $db->query($sqlGPA_all);
		$dt = $rs->fetchArray();
		$gpann = $dt['cgpa'];
		$all_cre = $dt['all_cre'];
?>


					

                    <div class="col-md-12">
 
							<!-- Basic datatable -->
							<div class="card shadow-sm">
							
								<div class="card-header header-elements-inline">
									<h6 class="card-title"> <?=getValue('student', 'name', 'matrix_no', $_GET['id'])?> (<?=$_GET['id']?>)   </h6>
<div class="header-elements">
										<!--a href="excel_grade.php?id=<?=$_GET['id']?>" class="badge mr-1"  style="background: #2980b9; color: #fff; float: right;"> Print</a-->
										<a href="javascript:close();" class="badge ml-2" style="background: #2980b9; color: #fff">Close</a>
									</div>
								</div>
								<div class="card-body">
								
									
								<table id='empTable2' class="table-bordered table-hover table-striped">
									
										<thead>
												<tr> 
													<th>Session</th> 
													<th>Subject Taken</th> 
													<th>Credit Hours Taken</th> 
													<th>Grade Point Average (GPA)</th>  
													<th>#</th> 
												</tr>
										</thead> 
										<tbody>
											<?php
											if($_SESSION['userrole']=='900'){
												$whereby = " WHERE sc.matrix_no='".$_GET['id']."' ";
											} else {
												$whereby =" WHERE sc.session_id='202203' ";
												
											}

											$sql = "SELECT semester_id FROM semester WHERE clearance_sess='".$datas['sess']."'
											";
											$datas = $db->query($sql)->fetchArray();
											$semester_id = $datas['semester_id'];
 
											
				$sql="
SELECT rs.semester_id, rs.sem_no, ag.grade, s.cre_hour,COUNT(rs.subject_code) AS total_subject,rs.sem_no,
ROUND((SUM(IF(ag.grade='A',4,IF(ag.grade='B',3,IF(ag.grade='C',2,IF(ag.grade='D',1,IF(ag.grade='E',0,0)))))*s.cre_hour))/(SUM(s.cre_hour)),2) AS cgp
FROM reg_subj rs
LEFT JOIN `subject` s ON s.subject_code = rs.subject_code
LEFT JOIN `asess_grade` ag ON (ag.classid = rs.classid AND ag.matrix_no = rs.matrix_no)
WHERE rs.matrix_no='".$_GET['id']."'
AND rs.semester_id <= '".$sess."'
GROUP BY semester_id 			
				";				


$sql = "
SELECT 'f' AS ctg, s.matrix_no, s.name AS student_name, sf.kode_mata_kuliah AS subject_code, sbj.subject_eng, sbj.sub_desc AS subject_id, 
sf.id_semester AS semester_id, sf.nilai_huruf AS grade, 
sf.sks_mata_kuliah AS cre_hour, gt.grade_index AS grade_index,
(gt.grade_index*sf.sks_mata_kuliah) AS weight,
sbj.sub_desc, COUNT(sf.kode_mata_kuliah) AS total_subject,
sf.id_semester,
ss.semester_jgu,
s.std_type,
ROUND((SUM(IF(sf.nilai_huruf='A',4,IF(sf.nilai_huruf='B',3,IF(sf.nilai_huruf='C',2,IF(sf.nilai_huruf='D',1,IF(sf.nilai_huruf='E',0,0)))))*sbj.cre_hour))/(SUM(sbj.cre_hour)),2) AS cgp
FROM student s
LEFT JOIN score_feeder sf ON sf.nim = s.rel_mat_no
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_mata_kuliah
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf
LEFT JOIN semester_feeder ss ON ss.semester = sf.id_semester
WHERE s.matrix_no='".$_GET['id']."'
AND ss.semester_jgu <= '".$sess."'
AND sf.nama_mata_kuliah != ''
GROUP BY sf.id_semester 	
ORDER BY sf.kode_mata_kuliah, sf.id_semester

";				
											
											$datas = $db->query($sql)->fetchAll();
											?>	
											
											<?php if($std_type == "7"){ ?>
											
											
																								<?php
													
 $sql = "													
SELECT SUM(rs.sks_mata_kuliah_diakui) AS total_sks, count(rs.kode_matkul_diakui) as total_mk,
ROUND((SUM(IF(rs.nilai_huruf_diakui='A',4,IF(rs.nilai_huruf_diakui='B',3,IF(rs.nilai_huruf_diakui='C',2,IF(rs.nilai_huruf_diakui='D',1,IF(rs.nilai_huruf_diakui='E',0,0)))))*s.cre_hour))/(SUM(s.cre_hour)),2) AS cgp
FROM transfer_score_feeder rs 
LEFT JOIN score_feeder sf ON (sf.kode_mata_kuliah = rs.kode_matkul_diakui AND sf.nim = rs.nim)
LEFT JOIN `subject` s ON s.subject_code = rs.kode_matkul_diakui 
WHERE rs.nim='".$nim."' 
AND sf.nim IS NULL



";
													
		$rsv = $dbf->query($sql);
		$dtz = $rsv->fetchArray();
	
		$sks_transfer = $dtz['total_sks'];													
		$total_mk = $dtz['total_mk'];			
		$cgp_transfer = $dtz['cgp'];			



$grand_sbj = $grand_sbj + $total_mk;
$grand_ch = $grand_ch + $sks_transfer;
$grand_gpa = 0;

		
			 											
													?>
													
											
											
											
											
											
											
												<tr> 
													<td>Score Transfer</td>
													<td><?=$total_mk?></td>
													<td><?=$sks_transfer?></td>
													<td align="center"><?=round($cgp_transfer, 2)?></td> 
												
													<td  style="width: 10px">
														
													<a target="_blank" href="transfer.php" > Print</a>
														 

													</td>
												 

												</tr>											
											
											<?php } ?>
											
											
											<?php foreach($datas as $data){ ?>										
												<tr> 
													<td><?=$data['semester_jgu']?></td>
													<td><?=$data['total_subject']?></td>
													<td>
													
													
													
													
													
													<?php
													
$sql = "													
SELECT SUM(s.cre_hour) AS total_sks
FROM reg_subj rs
LEFT JOIN `subject` s ON s.subject_code = rs.subject_code
WHERE rs.matrix_no='".$_GET['id']."' AND rs.semester_id='".$data['semester_jgu']."'
";
													
		$rsv = $dbf->query($sql);
		$dtz = $rsv->fetchArray();
	echo	$total_sks = $dtz['total_sks'];													
			 									


												
													?></td>
													<td align="center"><?=round($data['cgp'], 2)?></td> 
												
													<td  style="width: 10px">
														
													<a target="_blank" href="transcript.php?session_id=<?=$data['semester_jgu']?>&matrix_no=<?=$_GET['id']?>" > Print</a>
														 

													</td>
												 

												</tr>
<?php

$grand_sbj = $grand_sbj + $data['total_subject'];
$grand_ch = $grand_ch + $total_sks;
$grand_gpa = $grand_gpa + $data['cgp'];
$n++;
?>


											<?php } ?>
											
 				 
												<tr> 
													<td><b>Total All</b></td>
													<td><b><?=$grand_sbj?></b></td>
													<td><b><?=$grand_ch?></b></td>
													<td align="center"><b><?=round($grand_gpa/$n, 2)?></b></td> 
												
													<td  style="width: 10px">
														
												 
														 

													</td>
												 

												</tr>											
											
										</tbody>
									</table>

								</div>
							</div>
							<!-- /basic datatable -->


                        </div>
                    </div>






				</div>
				<!-- /content area -->

				<?php include('../main_footer.php');?>

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


	<script>

$(document).ready(function() {



 						

	$('#empTable2').dataTable( {
  "scrollY": "300px",
  "scrollCollapse": true,
  "paging": false
} );

	$("button").click(function() {
    

		






	if ($('input[type=checkbox]').is(':checked')){
 

	var data = $(":checkbox:checked").map(function(i,n){
            return $(n).val();
        }).get();

		
		var role_id = "<?=$_GET['id']?>";
				 
        $.post("update_menu.php?role_id="+role_id, { 'mergeDT[]': data },
        function(){
            $(".case_product:checked").each(function() {
                //$(this).parent().parent().remove();
            });
        })  .done(function() {
            


       	 window.location.href = "menu.php?id=<?=$_GET['id']?>";


         
        });







	}




		
	
	
	});


	});

</script>
 


</body>
</html>
