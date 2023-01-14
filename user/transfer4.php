<?php

$is_float = is_float(($all - 40)/2);
 
 
$divider34 = ceil(($all - 40)/2);
 
				$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center"><tr><td style="width: 50%; vertical-align: top; ">');
        
		
		
		
                $mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; font-size: 9px; text-align: center">   
                                        <tr>
                                                <th style="border: 1px solid black; width: 30px">'.$is_float.'Kode<br/><i>Code</i></th>
                                                <th style="border: 1px solid black;">Mata Kuliah<br/><i>Course</i></th>
                                                <th style="border: 1px solid black; width: 20px">K<br/><i>C</i></th>
                                                <th style="border: 1px solid black; width: 20px">N<br/><i>G</i></th>
                                                <th style="border: 1px solid black; width: 20px">B<br/><i>W</i></th>
                                                <th style="border: 1px solid black; width: 20px">KxB<br/><i>CxW</i></th>
                                        </tr>');
                for ($i=0; $i < 20; $i++) { 
					


					$cre_hour = explode(",",$cre_hour_all[$i])[0];



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

                
					for ($i=20; $i < 40; $i++) { 
						


						$cre_hour = explode(",",$cre_hour_all[$i])[0];



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
						
						
						if($i !=39){
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







$mpdf->AddPage();




 









 
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
					for ($i=40; $i < (40+$divider34); $i++) { 
						


						$cre_hour = explode(",",$cre_hour_all[$i])[0];



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
						
						
						if($i !=(39+$divider34)){
							
							
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








				for ($i=(40+$divider34); $i < $all; $i++) { 
						
						
				 


						$cre_hour = explode(",",$cre_hour_all[$i])[0];



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
						
						
						if($i !=($all-1)){
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
							
							
							
							
							
						if($is_float == "1"){
							
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
													<td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial"></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Calibri; text-align: left">'.$subject_eng[$subject_code[$i]].'</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black;  "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black;  "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black;  "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black;  "></td>
											</tr>
											
											');		
							
							
									$mpdf->WriteHTML('
											<tr>
													<td style="border-left: 1px solid black; border-right: 1px solid black; font-family: Arial">&nbsp;</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black;  text-align: left"><b></b></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; "></td>
											</tr>
											<tr>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;font-family: Arial">&nbsp;</td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; font-family: Calibri; text-align: left"></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; "></td>
													<td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; "></td>
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

				 




				}

                
					 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 

$mpdf->WriteHTML('</table>');



		$mpdf->WriteHTML('</td></tr></table>');


