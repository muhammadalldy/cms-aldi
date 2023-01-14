<?php

 
				$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center"><tr><td>');
        
		
		
		
                $mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black">KxB<br/><i>CxW</i></th>
                                        </tr>');
                for ($i=0; $i < 20; $i++) { 

                        $mpdf->WriteHTML('
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">'.$subject_code[$i].ceil($all/20).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b>'.$subject_name[$i].'</b></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$credits[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$grades[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($weights[$i]).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($credits[$i])*intval($weights[$i]).'</td>
                                        </tr>
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Arial"></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Calibri; text-align: left">'.$subject_name[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                        </tr>
										
										');

                }
 

		$mpdf->WriteHTML('</table>'); 
		$mpdf->WriteHTML('</td><td>');






		
					$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black">KxB<br/><i>CxW</i></th>
                                        </tr>');

                
                for ($i=0; $i < 20; $i++) { 

                        $mpdf->WriteHTML('
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">'.$subject_code[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b>'.$subject_name[$i].'</b></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$credits[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$grades[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($weights[$i]).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($credits[$i])*intval($weights[$i]).'</td>
                                        </tr>
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Arial"></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Calibri; text-align: left">'.$subject_name[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                        </tr>
										
										');

                }
 

$mpdf->WriteHTML('</table>');



		$mpdf->WriteHTML('</td></tr></table>');






 











 
				$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center"><tr><td>');
        
		
		
		
                $mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black">KxB<br/><i>CxW</i></th>
                                        </tr>');
                for ($i=0; $i < 20; $i++) { 

                        $mpdf->WriteHTML('
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">'.$subject_code[$i].ceil($all/20).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b>'.$subject_name[$i].'</b></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$credits[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$grades[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($weights[$i]).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($credits[$i])*intval($weights[$i]).'</td>
                                        </tr>
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Arial"></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Calibri; text-align: left">'.$subject_name[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                        </tr>
										
										');

                }
 

		$mpdf->WriteHTML('</table>'); 
		$mpdf->WriteHTML('</td><td>');






		
					$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black">KxB<br/><i>CxW</i></th>
                                        </tr>');

                
                for ($i=0; $i < 20; $i++) { 

                        $mpdf->WriteHTML('
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">'.$subject_code[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b>'.$subject_name[$i].'</b></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$credits[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$grades[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($weights[$i]).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($credits[$i])*intval($weights[$i]).'</td>
                                        </tr>
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Arial"></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Calibri; text-align: left">'.$subject_name[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                        </tr>
										
										');

                }
 

$mpdf->WriteHTML('</table>');



		$mpdf->WriteHTML('</td></tr></table>');

















 
				$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 50%; font-size: 9px; text-align: center"><tr><td>');
        
		
		
		
                $mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black">KxB<br/><i>CxW</i></th>
                                        </tr>');
                for ($i=0; $i < 20; $i++) { 

                        $mpdf->WriteHTML('
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">'.$subject_code[$i].ceil($all/20).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b>'.$subject_name[$i].'</b></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$credits[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$grades[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($weights[$i]).'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($credits[$i])*intval($weights[$i]).'</td>
                                        </tr>
										<tr>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Arial"></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Calibri; text-align: left">'.$subject_name[$i].'</td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                                <td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
                                        </tr>
										
										');

                }
 

		$mpdf->WriteHTML('</table>'); 
		$mpdf->WriteHTML('</td><td>');





 


		$mpdf->WriteHTML('</td></tr></table>');




