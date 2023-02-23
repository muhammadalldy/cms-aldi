
		            <!-- Large modal -->
					<div id="modal_large" class="modal fade" tabindex="-1">
					<form id="update_form" method="post" enctype="multipart/form-data">

					<input type="hidden" id="id_user" name="id_user" > 

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
											<div class="col-md-2">	
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Place of Birth:</label>
													<input type="text" id="pob" name="pob" class="form-control form-control-sm" placeholder="Place of Birth">
												</div>	
											</div>
											<div class="col-md-2">	
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Date of Birth:</label>
													<input type="date" id="dob"  name="dob" class="form-control form-control-sm" placeholder="Date of Birth">
												</div>
											</div> 

								 
											<div class="col-md-2">
							                            <label style="font-size: 12px; margin-bottom: 3px">Country</label>
							                            <select id="country"  name="country"   class="form-control form-control-sm" >
							                                <?=dd_menu('region', 'id_wil', 'nm_wil','-- Please Choose --', 'WHERE id_level_wil=0' ,'ASC', $profile['country'])?>
							                            </select>
													</div>



											<div class="col-md-12">
										<div class="row">
 



													<div class="col-md-3">
														<label style="font-size: 12px; margin-bottom: 3px">State/Province</label>
							                            <select id="state" name="state"   class="form-control form-control-sm" >
							                                <?=dd_menu('region', 'id_wil', 'nm_wil','-- Please Choose --', 'WHERE id_level_wil=1' ,'ASC', $profile['state'])?>
							                            </select> 
													</div>
													<div class="col-md-3">
														<label style="font-size: 12px; margin-bottom: 3px">City</label>
							                            <select id="city" name="city"  class="form-control form-control-sm" >
							                                <?=dd_menu('region', 'id_wil', 'nm_wil','-- Please Choose --', 'WHERE id_level_wil=2' ,'ASC', $profile['city'])?>
							                            </select>

													</div>

													<div class="col-md-3">
														<label style="font-size: 12px; margin-bottom: 3px">District</label>
							                            <select id="district" name="district"  class="form-control form-control-sm" >
							                                <?=dd_menu('region', 'id_wil', 'nm_wil','-- Please Choose --', 'WHERE id_level_wil=3' ,'ASC', $profile['district'])?>
							                            </select>
													</div>
													<div class="col-md-3">									
														<div class="form-group">
															<label style="font-size: 12px; margin-bottom: 3px">Sub District <i>(Kelurahan)</i>: <i style="font-size: 10px">	</i></label>
															<input id="sub_district" type="text" name="sub_district" value="<?=$data['sub_district']?>" class="form-control form-control-sm" placeholder="Sub District" >
														</div>
													</div>											
										</div>
									</div>



									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Address <i style="font-size: 10px">(Sesuai KTP)</i>:</label> 
													<input type="text" id="address_ic" name="address_ic" class="form-control form-control-sm" placeholder="Address"> 
												</div>
											</div>											 
											<div class="col-md-6">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Address <i style="font-size: 10px">(Alamat Saat Ini)</i>:</label>
													<input type="text" id="address_now" name="address_now" class="form-control form-control-sm" placeholder="Address" >  
												</div>
											</div>
										</div>
									</div>

 
									<div class="col-md-12">
										<div class="row">


											<div class="col-md-3">									 
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Email:</label> 
													<input type="text" id="email" name="email" class="form-control form-control-sm" placeholder="Email" >
												</div>
											</div>
											<div class="col-md-3">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Phone:</label> 
													<input type="text" id="phone" name="phone" class="form-control form-control-sm" placeholder="Phone">
												</div>
											</div> 										
											<div class="col-md-3">									
												<div class="form-group">
													<label style="font-size: 12px; margin-bottom: 3px">Zip Code:</label> 
													<input type="text" id="zip_code" name="zip_code" class="form-control form-control-sm" placeholder="Zip Code">
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