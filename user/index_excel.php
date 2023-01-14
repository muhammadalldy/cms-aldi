<?php
    include('../config_klas2/lib/common.php');
    require '../vendor/autoload.php';
    

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
   
    
   
    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);
      
    $spreadsheet->setActiveSheetIndex(0);
    $activeSheet = $spreadsheet->getActiveSheet();

    


    $activeSheet->setCellValue('A1', 'Nama');
    $activeSheet->setCellValue('B1', 'Matric No');
    $activeSheet->setCellValue('C1', 'NIM');
    $activeSheet->setCellValue('D1', 'Gender');
    $activeSheet->setCellValue('E1', 'Campus Name');
    $activeSheet->setCellValue('F1', 'Campus ID');
    $activeSheet->setCellValue('G1', 'Religion');
    $activeSheet->setCellValue('H1', 'Date of Birth');
    $activeSheet->setCellValue('I1', 'Semester ID');
    $activeSheet->setCellValue('J1', 'Program');
    $activeSheet->setCellValue('K1', 'Student Status');
    $activeSheet->setCellValue('L1', 'Kategori');
    $activeSheet->setCellValue('M1', 'Email');
    $activeSheet->setCellValue('N1', 'Place of Birth');
      


    if($_GET['status_filter']!=''){
        $filter = " WHERE c.status='".$_GET['status_filter']."' ";
    } else {
        $filter = " WHERE c.status !='x'";
    }
     

    $sql = "
    SELECT s.name, s.matrix_no, s.rel_mat_no, lg.title AS gender, cmp.title as campus_name, s.campus_code as campus_id, st.title as std_type,
    lr.title AS religion_nm,
     s.d_o_b, 
    sp.semester_id, po.code,
    s.student_status,
	s.email,
	s.p_o_b
    FROM student s
    LEFT JOIN student_program sp ON sp.matrix_no = s.matrix_no
    LEFT JOIN lookup_gender lg ON lg.id = s.xgender
    LEFT JOIN lookup_religion lr ON lr.id = s.religion
    LEFT JOIN program p ON p.programid = sp.program_code
    LEFT JOIN pro_off po ON p.programid = po.code 
	LEFT JOIN lookup_campus_sttj cmp ON cmp.id = s.campus_code 
	LEFT JOIN lookup_std_type st ON st.id = s.std_type 
    WHERE sp.program_code NOT LIKE '%PNJ%' 
    ";
    $query = $db->query($sql);
      
    if($query->num_rows > 0) {
        $i = 2;
        while($row = mysqli_fetch_array($query)) {
            $activeSheet->setCellValue('A'.$i , $row['name']);
            $activeSheet->setCellValue('B'.$i , $row['matrix_no']);
            $activeSheet->setCellValue('C'.$i , $row['rel_mat_no']);
            $activeSheet->setCellValue('D'.$i , $row['gender']);
            $activeSheet->setCellValue('E'.$i , $row['campus_name']);
            $activeSheet->setCellValue('F'.$i , $row['campus_id']);
            $activeSheet->setCellValue('G'.$i , $row['religion_nm']);
            $activeSheet->setCellValue('H'.$i , $row['d_o_b']);
            $activeSheet->setCellValue('I'.$i , $row['semester_id']);
            $activeSheet->setCellValue('J'.$i , $row['code']);
            $activeSheet->setCellValue('K'.$i , $row['student_status']);
            $activeSheet->setCellValue('L'.$i , $row['std_type']);
            $activeSheet->setCellValue('M'.$i , $row['email']);
            $activeSheet->setCellValue('M'.$i , $row['p_o_b']);
            $i++; 
        }
    }

// Auto-size columns for all worksheets
foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
    foreach ($worksheet->getColumnIterator() as $column) {
        $worksheet
            ->getColumnDimension($column->getColumnIndex())
            ->setAutoSize(true);
    } 
}    

    $created_date   = date("Y-m-d H:i:s");
    $filename = "Student_Profile".$created_date.".xlsx";
      
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');

    //echo "<script>window.close();</script>";