
		            <!-- Large modal -->
					<div id="modal_large" class="modal fade" tabindex="-1">
					<form id="update_form" method="post" enctype="multipart/form-data">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"><span type="text" id="title" > </h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
								
							
							
							
							
							
							
							
							 
						

						<div class="row">
							<div class="col-md-12 pl-3 pr-3 pb-3">
								<div class="row">
									<div class="col-md-12">
										<div class="row">




									<div class="col-md-12">
										<div class="row">
											<div class="col-md-3">									
												<div class="form-group">
													
													<img id="image" name="image" style="height: 150px">
												
													
												</div>
											</div>
										</div>
									</div>

											<div class="col-md-6">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Name:</label>
													<input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Name"> 
												</div>
											</div>
											<div class="col-md-3">	
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Place of Birth:</label>
													<input type="text" id="pob" name="pob" class="form-control form-control-sm" placeholder="Place of Birth">
												</div>	
											</div>
											<div class="col-md-3">	
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Date of Birth:</label>
													<input type="date" id="dob"  name="dob" class="form-control form-control-sm" placeholder="Date of Birth">
												</div>
											</div> 

								 




											<div class="col-md-12">
										<div class="row">
 


													<div class="col-md-3">
							                            <label>Country</label>
							                            <select name="country"  class="custom-select">
							                                <?=dd_menu('region', 'id_wil', 'nm_wil','-- Please Choos --', 'WHERE id_level_wil=0' ,'ASC', $profile['country'])?>
							                            </select>
													</div>
													<div class="col-md-3">
														<label>State/Province</label>
							                            <select name="state"  class="custom-select">
							                                <?=dd_menu('region', 'id_wil', 'nm_wil','-- Please Choos --', 'WHERE id_level_wil=1' ,'ASC', $profile['state'])?>
							                            </select> 
													</div>
													<div class="col-md-3">
														<label>City</label>
							                            <select name="city"  class="custom-select">
							                                <?=dd_menu('region', 'id_wil', 'nm_wil','-- Please Choos --', 'WHERE id_level_wil=2' ,'ASC', $profile['city'])?>
							                            </select>

													</div>



											
											<div class="col-md-3">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Sub District <i>(Kelurahan)</i>: <i style="font-size: 10px">	</i></label>
													<input type="text" name="txt05_sub_district_b" value="<?=$data['sub_district_b']?>" class="form-control form-control-sm" placeholder="Sub District" <?=($_SESSION['userrole'] == '805' ? "required" : "");?> >
												</div>

											</div>											
											
										</div>
									</div>



									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Address <i style="font-size: 10px">(Sesuai KTP)</i>:</label> 
													<input type="text" id="address_aa" name="address_aa" class="form-control form-control-sm" placeholder="Address"> 
												</div>
											</div>											 
											<div class="col-md-6">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Address <i style="font-size: 10px">(Alamat Saat Ini)</i>:</label>
													<input type="text" id="address_ba" name="address_ba" class="form-control form-control-sm" placeholder="Address" >  
												</div>
											</div>
										</div>
									</div>

 
									<div class="col-md-12">
										<div class="row">


											<div class="col-md-3">									 
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Email:</label> 
													<input type="text" id="email" name="email" class="form-control form-control-sm" placeholder="Email" <?=($_SESSION['userrole'] == '805' ? "required" : "");?> >
												</div>
											</div>
											<div class="col-md-3">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Handphone:</label> 
													<input type="text" id="handphone" name="handphone" class="form-control form-control-sm" placeholder="Handphone" <?=($_SESSION['userrole'] == '805' ? "required" : "");?> >
												</div>
											</div> 										

										
										</div>
									</div>



								







 

										</div>
									 </div>


								</div>
							</div>
						</div>


 


			
										
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
								</div>

								<div class="modal-footer">
									
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" id="submit" name="button" style="background: #2980b9; color: #fff; border: none" value="edit" class="btn btn-primary">Save</button>
								</div>
							</div>
						</div>
					 </form>
					</div>
					<!-- /large modal -->