<?php

 





 

 

$mpdf->WriteHTML('<table style="width: 100%; font-size: 12px">
                    <tr>
                        <td>
							<th align="center">');
							
							


 
					$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 50%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black; width: 30px">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black;">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black; width: 20px">SKS<br/><i>CH</i></th>
                                                <th style="border: 1px solid black; width: 20px">Nilai<br/><i>Grade</i></th>
                                                <th style="border: 1px solid black; width: 20px">Bobot<br/><i>Weight</i></th>
                                                <th style="border: 1px solid black; width: 20px">Total<br/><i>Total</i></th>
                                        </tr>');











					$all_cre_hour 	= 0;
					$all_weight 	= 0;
					$ideal_weight = 0;

                
					for ($i=0; $i < $all; $i++) { 
					
					
					
					
						




						$cre_hour = explode(",",$cre_hour_all[$i])[0];

						$all_cre_hour = $all_cre_hour + $cre_hour;

						$sf = explode(",",$grades[$i])[0];
						$sk = explode(",",$grades[$i])[1];
						$sfi = explode(",",$grade_index[$i])[0];
						$ski = explode(",",$grade_index[$i])[1];



						if($sfi > $ski){ $gg = $sf; } else { $gg = $sk; } 

						$idx = 0;
						if($sfi > $ski){ 
						$idx = ($sfi); 
						} else { 
						$idx = ($ski); 
						} 

						$weight = $idx * $cre_hour;					
						$all_weight = $all_weight + $weight;
						$ideal_weight = $ideal_weight + (4 * $cre_hour);
						
						if($i !=$all-1){
							$mpdf->WriteHTML('
											<tr>
													<td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">'.$subject_code[$i].'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b>'.$subject_name[$subject_code[$i]].'</b></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.str_replace(".00","",$cre_hour).'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$gg.'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($idx).'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($weight).'</td>
											</tr>
											<tr>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Arial"></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ; font-family: Calibri; text-align: left">'.$subject_eng[$subject_code[$i]].'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
											</tr>
											
											');
											
						} else {
							
							$mpdf->WriteHTML('
											<tr>
													<td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">'.$subject_code[$i].'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b>'.$subject_name[$subject_code[$i]].'</b></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.str_replace(".00","",$cre_hour).'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.$gg.'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($idx).'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; ">'.intval($weight).'</td>
											</tr>
											<tr>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; font-family: Arial"></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;  font-family: Calibri; text-align: left">'.$subject_eng[$subject_code[$i]].'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;  "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;  "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;  "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;  "></td>
											</tr>
											
											');						
							
							
						}




					}
	 
	 
	 $mpdf->WriteHTML('</table>');

	 
	 
$mpdf->WriteHTML(

'</h3></th>
</td>

</tr>

</table>');

	 
//$mpdf->AddPage();



	 
	 
	 
	  