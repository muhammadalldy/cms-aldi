<?php

 
				$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center"><tr><td style="width: 50%; vertical-align: top; ">');
        
		
		
		
                $mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black; width: 30px">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black;">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black; width: 20px">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black; width: 20px">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black; width: 20px">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black; width: 20px">KxB<br/><i>CxW</i></th>
                                        </tr>');
										
										
										
					$all_cre_hour 	= 0;
					$all_weight 	= 0;
					$ideal_weight = 0;

										
                for ($i=0; $i < 20; $i++) { 
					
		
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
					

		
					if($i !=19){
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
		$mpdf->WriteHTML('</td><td style="width: 50%; vertical-align: top; ">');






		
					$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black; width: 30px">Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black;">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black; width: 20px">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black; width: 20px">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black; width: 20px">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black; width: 20px">KxB<br/><i>CxW</i></th>
                                        </tr>');

                
					for ($i=20; $i < $all; $i++) { 
						
						
						




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



		$mpdf->WriteHTML('</td></tr></table>');










 





 
	 
	 
	 
	 
	  