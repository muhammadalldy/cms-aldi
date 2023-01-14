<?php
require_once '../vendor/autoload.php';

include('../config/lib/common.php');
ini_set("pcre.backtrack_limit", "5000000");
session_start();

$_GET['id'] = $_GET['matrix_no'];
$matrix_no = addslashes($_GET['id']);

$total_all_gpa_now = 0;
$total_all_gpa_should = 0;
$total_sks = 0;

$session_id = $_GET['session_id'];


function month_id($key){

    switch ($key) {
        case "January":
            return "Januari";
            break;

        case "February":
            return "Februari";
            break;

        case "March":
            return "Maret";
            break;

        case "April":
            return "April";
            break;
                        
        case "May":
            return "Mei";
            break;
    
        case "June":
            return "Juni";
            break;

        case "July":
            return "Juli";
            break;
                
        case "August":
            return "Agustus";
            break;
                
        case "September":
            return "September";
            break;
                
        case "October":
            return "Oktober";
            break;
                
        case "November":
            return "Nopember";
            break;
                
        case "December":
            return "Desember";
            break;
                            
        default:
          echo("");
      } 
}


		
 if($_GET['transfer'] == "1"){
	
$sql = "

SELECT 
s.matrix_no,  s.name AS student_name,  sf.kode_matkul_diakui AS subject_code,  sbj.subject_eng,  sf.nama_mata_kuliah_diakui AS subject_id,  sf.id_periode_masuk AS semester_id, 
sf.nilai_huruf_asal AS grade,  sf.sks_mata_kuliah_diakui AS cre_hour,  gt.grade_index AS grade_index, (gt.grade_index * sf.sks_mata_kuliah_diakui) AS weight 
FROM 
student s  
LEFT JOIN transfer_score_feeder sf ON sf.nim = s.rel_mat_no 
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_matkul_diakui 
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf_asal 
WHERE 
s.matrix_no='".addslashes($_GET['id'])."'
ORDER BY  sf.kode_matkul_diakui, sf.id_periode_masuk, sbj.subject_eng

";

 } elseif($_GET['combined'] == "1"){
	
 $sql = "
SELECT GROUP_CONCAT(ctg ORDER BY ctg) AS ctg, matrix_no, student_name, 
GROUP_CONCAT(grade ORDER BY ctg) as grade,
GROUP_CONCAT(grade_index ORDER BY ctg) as grade_index,
GROUP_CONCAT(cre_hour ORDER BY ctg) as cre_hour,
subject_code, subject_eng, subject_id, semester_id,
weight, sub_desc
FROM
(
SELECT 'k' AS ctg, rs.matrix_no, st.name AS student_name, rs.subject_code, s.subject_eng, s.sub_desc AS subject_id, rs.semester_id, IF(MIN(ag.grade)!='',MIN(ag.grade),'E') AS grade,  s.cre_hour,  MAX(gt.grade_index) AS grade_index, (MAX(gt.grade_index)*s.cre_hour) AS weight,
s.sub_desc
FROM reg_subj rs
LEFT JOIN student st ON st.matrix_no = rs.matrix_no
LEFT JOIN `subject` s ON s.subject_code = rs.subject_code
LEFT JOIN `subject_class` sc ON sc.classid = rs.classid 
LEFT JOIN `asess_grade` ag ON (ag.classid = rs.classid AND ag.matrix_no = rs.matrix_no)
LEFT JOIN grade_type gt ON gt.grade = ag.grade
WHERE rs.matrix_no='".$_GET['id']."'
GROUP BY s.subject_code
UNION
SELECT 'f' AS ctg, s.matrix_no, s.name AS student_name, sf.kode_mata_kuliah AS subject_code, sbj.subject_eng, sbj.sub_desc AS subject_id, 
sf.id_semester AS semester_id, sf.nilai_huruf AS grade, 
sf.sks_mata_kuliah AS cre_hour, gt.grade_index AS grade_index,
(gt.grade_index*sf.sks_mata_kuliah) AS weight,
sbj.sub_desc
FROM student s
LEFT JOIN score_feeder sf ON sf.nim = s.rel_mat_no
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_mata_kuliah
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf
WHERE s.matrix_no='".addslashes($_GET['id'])."'
AND sf.nama_mata_kuliah != ''
) tbl
GROUP BY subject_code
ORDER BY subject_code, semester_id	

";




$sql = "
SELECT * FROM
( 
SELECT GROUP_CONCAT(ctg ORDER BY ctg) AS ctg, matrix_no, student_name,  subject_code, subject_eng,  nama_mata_kuliah as subject_id, semester_id, 
GROUP_CONCAT(grade ORDER BY ctg) AS grade, GROUP_CONCAT(grade_index ORDER BY ctg) AS grade_index, GROUP_CONCAT(cre_hour ORDER BY ctg) AS cre_hour,  weight
FROM
( 
SELECT 'k' AS ctg, rs.matrix_no, st.name AS student_name, rs.subject_code, s.subject_eng, s.sub_desc as nama_mata_kuliah, rs.semester_id, 
IF(MIN(ag.grade)!='',MIN(ag.grade),'E') AS grade, MAX(gt.grade_index) AS grade_index,  s.cre_hour,  (MAX(gt.grade_index)*s.cre_hour) AS weight 
FROM reg_subj rs
LEFT JOIN student st ON st.matrix_no = rs.matrix_no
LEFT JOIN `subject` s ON s.subject_code = rs.subject_code
LEFT JOIN `subject_class` sc ON sc.classid = rs.classid 
LEFT JOIN `asess_grade` ag ON (ag.classid = rs.classid AND ag.matrix_no = rs.matrix_no)
LEFT JOIN grade_type gt ON gt.grade = ag.grade
WHERE rs.matrix_no='".addslashes($_GET['id'])."'
GROUP BY s.subject_code 
UNION 
SELECT * FROM
(SELECT 'f' AS ctg, tbl.matrix_no, tbl.student_name, tbl.subject_code, tbl.subject_eng, tbl.nama_mata_kuliah,
tbl.semester_id, tbl.grade, tbl.grade_index,  tbl.cre_hour, tbl.weight
 FROM
((SELECT 
s.matrix_no,  s.name AS student_name,  sf.kode_matkul_diakui AS subject_code,  sbj.subject_eng,  sf.nama_mata_kuliah_diakui AS nama_mata_kuliah,  sf.id_periode_masuk AS semester_id, 
sf.nilai_huruf_asal AS grade,  sf.sks_mata_kuliah_diakui AS cre_hour,  gt.grade_index AS grade_index, (gt.grade_index * sf.sks_mata_kuliah_diakui) AS weight 
FROM 
student s  
LEFT JOIN transfer_score_feeder sf ON sf.nim = s.rel_mat_no 
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_matkul_diakui 
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf_asal 
WHERE 
s.matrix_no='".addslashes($_GET['id'])."'
ORDER BY  sf.id_periode_masuk, sbj.subject_eng) 
UNION 
(SELECT s.matrix_no, s.name AS student_name, sf.kode_mata_kuliah AS subject_code, sbj.subject_eng, sf.nama_mata_kuliah,
sf.id_semester AS semester_id, sf.nilai_huruf AS grade, sf.sks_mata_kuliah AS cre_hour, gt.grade_index AS grade_index, (gt.grade_index*sf.sks_mata_kuliah) AS weight
FROM student s
LEFT JOIN score_feeder sf ON sf.nim = s.rel_mat_no
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_mata_kuliah
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf
WHERE s.matrix_no='".addslashes($_GET['id'])."'
ORDER BY sf.id_semester, sbj.subject_eng)) tbl
WHERE tbl.subject_code !=''
GROUP BY tbl.semester_id, tbl.subject_code
ORDER BY tbl.semester_id, tbl.subject_code) 
ww2 
) tbl
GROUP BY subject_code
ORDER BY subject_code)
ww1
";







} else {
	$sql = "
	SELECT 'f' AS ctg, s.matrix_no, s.name AS student_name, sf.kode_mata_kuliah AS subject_code, sbj.subject_eng, sbj.sub_desc AS subject_id, 
sf.id_semester AS semester_id, sf.nilai_huruf AS grade, 
sf.sks_mata_kuliah AS cre_hour, gt.grade_index AS grade_index,
(gt.grade_index*sf.sks_mata_kuliah) AS weight,
sbj.sub_desc
FROM student s
LEFT JOIN score_feeder sf ON sf.nim = s.rel_mat_no
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_mata_kuliah
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf
WHERE s.matrix_no='".addslashes($_GET['id'])."'
AND sf.nama_mata_kuliah != ''
ORDER BY sf.kode_mata_kuliah, sf.id_semester

	";
	
}

 	$sql = "
	SELECT 'f' AS ctg, s.matrix_no, s.name AS student_name, sf.kode_mata_kuliah AS subject_code, sbj.subject_eng, sbj.sub_desc AS subject_id, 
sf.id_semester AS semester_id, sf.nilai_huruf AS grade, 
sf.sks_mata_kuliah AS cre_hour, gt.grade_index AS grade_index,
(gt.grade_index*sf.sks_mata_kuliah) AS weight,
sbj.sub_desc
FROM student s
LEFT JOIN score_feeder sf ON sf.nim = s.rel_mat_no
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_mata_kuliah
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf
WHERE s.matrix_no='".addslashes($_GET['id'])."'
AND sf.nama_mata_kuliah != ''
ORDER BY sf.kode_mata_kuliah, sf.id_semester

	";

$sql= "
SELECT 'f' AS ctg, s.matrix_no, s.name AS student_name, sf.kode_mata_kuliah AS subject_code, sbj.subject_eng, sbj.sub_desc AS subject_id, 
sf.id_semester AS semester_id, sf.nilai_huruf AS grade, 
sf.sks_mata_kuliah AS cre_hour, gt.grade_index AS grade_index,
(gt.grade_index*sf.sks_mata_kuliah) AS weight,
sbj.sub_desc,
sf.id_semester,
ss.semester_jgu
FROM student s
LEFT JOIN score_feeder sf ON sf.nim = s.rel_mat_no
LEFT JOIN `subject` sbj ON sbj.subject_code = sf.kode_mata_kuliah
LEFT JOIN grade_type gt ON gt.grade = sf.nilai_huruf
LEFT JOIN semester_feeder ss ON ss.semester = sf.id_semester
WHERE s.matrix_no='".addslashes($_GET['id'])."'
AND ss.semester_jgu='".addslashes($_GET['session_id'])."'
AND sf.nama_mata_kuliah != ''
ORDER BY sf.kode_mata_kuliah, sf.id_semester
";

$result = $db->query($sql);

$datas = $result->fetchAll();

$ch_all = 0;
$wh_all = 0;

/*
foreach($datas as $data){
	
	 if($data['grade'] !="E"){ 
	 

	if($data['grade_index'] !=""){
		$ch_all  = $ch_all  + $data['cre_hour'];
		$wh_all  = $wh_all  + $data['weight'];
	}											

	 
        $subject_code[] = $data['subject_code'];
        $subject_name[] = $data['sub_desc'];
        $subject_eng[] = $data['subject_eng'];
        $credits[] = $data['cre_hour'];
        $grades[] = $data['grade'];
        $weights[] = $data['grade_pointer'];
		
	 }
}
*/

$klasfeeder= [];
$crall = 0;
$wall = 0;
foreach($datas as $data){
	




	$sf = explode(",",$data['grade'])[0];
	$sk = explode(",",$data['grade'])[1];
	$sfi = explode(",",$data['grade_index'])[0];
	$ski = explode(",",$data['grade_index'])[1];



	if($sfi > $ski){ $gg = $sf; } else { $gg = $sk; } 


	//if($gg !="E"){
	$idx = 0;

	$ctg[] = $data['ctg'];
	$cre_hour_all[] = $data['cre_hour'];
	$semester_id[] = $data['semester_id'];

	$matrix_no  = $data['matrix_no'];
	$student_name = $data['student_name'];


	$subject_code[] 						= $data['subject_code'];
	$subject_eng[$data['subject_code']] 	= $data['subject_eng'];
	$subject_name[$data['subject_code']] 	= $data['subject_id'];
	$klasfeeder[$data['subject_code']] 		= $data['ctg']; 
	$grades[] 								= $data['grade'];
	$grade_index[] 							= $data['grade_index']; 
	$cre_hour 								= explode(",",$data['cre_hour'])[0];
  
	if($sfi > $ski){ 
		$idx = ($sfi); 
	} else { 
		$idx = ($ski); 
	} 

	$weight = $idx * $cre_hour;					
	$crall 	=  $crall + $cre_hour;		
	$wall = $wall + $weight;
	//}
}


  				 									
										
										 
$total_cre_hours = $ch_all;
 
$gpann = number_format((float)($wall/$crall), 2, '.', '');
 
 
 
 
 
 
 

$sql = "
        SELECT s.name, s.rel_mat_no, s.d_o_b, s.ic_passport, s.p_o_b, ls.english as level_en, ls.indonesia as level_id, p.degree_lower as degree, du.desc_acad,
        s.graduation_pin, s.graduation_date, s.id_concentration, s.thesis_title_id, s.thesis_title_en,
       lc.title_en as conc_title_en, lc.title_bm as conc_title_id, 
    
        po.program_e as program_en, po.program_m as program_id,
		ne.name as dean_name, ne.postfix as dean_title 		
        FROM student s
        LEFT JOIN student_program sp ON sp.matrix_no = s.matrix_no
        LEFT JOIN feeder_prodi fp ON fp.program_code = sp.program_code
        LEFT JOIN program p ON p.programid = sp.program_code       
        LEFT JOIN lookup_stage ls ON ls.id = p.stage  
        LEFT JOIN pro_off po ON po.code = p.programid 
		LEFT JOIN new_employee ne ON ne.empid = du.empid 
		LEFT JOIN lookup_concentration lc ON lc.id = s.id_concentration		
        WHERE s.matrix_no='".addslashes($_GET['id'])."'
        ";
$result = $db->query($sql);

$data = $result->fetchArray();



$name = $data['name'];
$npm = $data['rel_mat_no'];
$dob = new DateTime($data['d_o_b']);
$pob = $data['p_o_b'];
$ic = $data['ic_passport'];

$degree_en = $data['level_en'];
$degree_id = $data['level_id'];

$faculty_en = $data['faculty_en'];
$faculty_id = $data['faculty_id'];
$faculty_wf = $data['desc_acad'];


$dean_name = ucwords(strtolower($data['dean_name']));
$dean_title = $data['dean_title'];


$graduation_date = $data['graduation_date'];
$graduation_date = new DateTime($data['graduation_date']);

$senate_grad_date = $data['senate_grad_date'];
$senate_grad_date = new DateTime($data['senate_grad_date']);



$dept_en = $data['dept_en'];
$dept_id = $data['dept_id'];

$program_en = $data['program_en'];
$program_id = $data['program_id'];

$degree = $data['degree'];
$graduation_pin = $data['graduation_pin'];

$thesis_title_id = $data['thesis_title_id'];
$thesis_title_en = $data['thesis_title_en'];
$conc_title_id = $data['conc_title_id'];
$conc_title_en = $data['conc_title_en'];


//$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
$mpdf = new \Mpdf\Mpdf(['format' => [235, 335]]);

$mpdf->WriteHTML('<img style="float:left; width: 100px" src="../../config/image/logo-jgu.png" />');


$mpdf->WriteHTML('<table style="width: 100%; font-size: 12px">
                    <tr>
                        <td>
							<th align="center"> <h3><strong>STATEMENT OF RESULTS</strong></h3></th>
						</td>
                  
                    </tr>
                  
                    </table>');
$mpdf->WriteHTML('<br/><br/>');
$mpdf->WriteHTML('<br/><br/>');
$mpdf->WriteHTML('<br/>');
$mpdf->WriteHTML('<table style="width: 100%; font-size: 12px"><tr><td style="vertical-align: top; width: 27%; text-align: center" align="center">');

 
$mpdf->WriteHTML('</td><td>');



$mpdf->WriteHTML('<table style="width: 60%; font-size: 12px">
                    <tr>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>Matric No</b></td>
                    <td style="width:5px;font-size: 9px; font-family: Arial"><b>:</b></td>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>'.$matrix_no.'</b></td>
                    </tr>
                    <tr>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>Name</b></td>
                    <td style="width:5px;font-size: 9px; font-family: Arial"><b>:</b></td>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>'.ucwords(strtolower($name)).'</b></td>
                    </tr>
                    <tr>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>Program</b></td>
                    <td style="width:5px;font-size: 9px; font-family: Arial"><b>:</b></td>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>'.$program_en.'</b></td>
                    </tr>
                    <tr>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>Session</b></td>
                    <td style="width:5px;font-size: 9px; font-family: Arial"><b>:</b></td>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>'.$session_id.'</b></td>
                    </tr> 
                    </table>');




$mpdf->WriteHTML('</td></tr></table>');
            

 



$div = 20;



$all = count($subject_code); 

$div4 = 80;
$div5 = 100;

$totalsquare = ceil($all/20); 
 
 
 
 

$mpdf->WriteHTML('<br/>');
 
 
include('transcript1.php');




 
$mpdf->WriteHTML('<br/>');


 
$final_score = number_format((float)($all_weight/$all_cre_hour), 2, '.', '');





$mpdf->WriteHTML('<table style="width: 100%; font-size: 12px"><tr><td style="vertical-align: top; width: 35%; text-align: center" align="center">');

 
$mpdf->WriteHTML('</td><td>');


$mpdf->WriteHTML('<table style="width: 60%; font-size: 12px">
                    <tr>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>Total Number of Subject Taken</b></td>
                    <td style="width:5px;font-size: 9px; font-family: Arial"><b>:</b></td>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>'.$i.'</b></td>
                    </tr>
                    <tr>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>Total Credit Hour</b></td>
                    <td style="width:5px;font-size: 9px; font-family: Arial"><b>:</b></td>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>'.ucwords(strtolower($all_cre_hour)).'</b></td>
                    </tr>
                    <tr>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>Grade Point Average (GPA)</b></td>
                    <td style="width:5px;font-size: 9px; font-family: Arial"><b>:</b></td>
                    <td style="width:40%;font-size: 9px; font-family: Arial"><b>'.$final_score.'</b></td>
                    </tr>
            
                    </table>');




$mpdf->WriteHTML('</td></tr></table>');
            




 



                        
$mpdf->Output();

