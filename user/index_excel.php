<?php
    include('../config/lib/common.php');
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
			SELECT 
			ua.username, 
			ua.image,
			ua.cover,	
			p.name,
			p.bio,
			p.address_ic,
			p.address_now,
			p.city,
			p.state,
			p.country,
			p.email,
			p.phone,
			p.zip_code,
			p.pob,
			p.dob,
			p.district,
			p.sub_district
			FROM users ua
			LEFT JOIN profile p ON p.id_user = ua.id
    ";
    $query = $db->query($sql);
      
    if($query->num_rows > 0) {
        $i = 2;
        while($row = mysqli_fetch_array($query)) {
            $activeSheet->setCellValue('A'.$i , $row['username']);
            $activeSheet->setCellValue('B'.$i , $row['name']);
            $activeSheet->setCellValue('C'.$i , $row['country']);
            $activeSheet->setCellValue('D'.$i , $row['state']);
            $activeSheet->setCellValue('E'.$i , $row['city']);
            $activeSheet->setCellValue('F'.$i , $row['district']);
            $activeSheet->setCellValue('G'.$i , $row['sub_district']);
            $activeSheet->setCellValue('H'.$i , $row['pob']);
            $activeSheet->setCellValue('I'.$i , $row['dob']);
            $activeSheet->setCellValue('J'.$i , $row['email']);
            $activeSheet->setCellValue('K'.$i , $row['phone']);
            $activeSheet->setCellValue('L'.$i , $row['address_ic']);
            $activeSheet->setCellValue('M'.$i , $row['address_now']);
            $activeSheet->setCellValue('N'.$i , $row['bio']);
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