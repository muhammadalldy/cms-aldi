<!-- Main navbar -->
<div class="navbar navbar-expand-lg navbar-dark navbar-static shadow-sm" style="color: #000">
    <div class="d-flex flex-1 d-lg-none">
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3" style="color: #1e272e"></i>
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-gift"></i>
        </button>
    </div>

    <div class="navbar-brand text-center text-lg-left" style="padding-top: 1rem; padding-bottom: 1rem; ">
        <a href="/" class="d-inline-block">
            <img src="../logo_light2.png" class="d-none d-sm-block" alt="" style="height: 2rem;">
            <img src="../../global_assets/images/logo_icon_light.png" class="d-sm-none" alt="">
        </a>
    
    </div>

    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link" data-toggle="dropdown">
                    <i class="icon-gift"></i>
                    <span class="d-lg-none ml-3">Birthday This Month</span>
                    <!--span class="badge badge-warning badge-pill ml-auto ml-lg-0">9</span-->
                </a>

                <div class="dropdown-menu dropdown-content wmin-lg-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Birthday This Month</span>
                        <a href="#" class="text-body"><i class="icon-gift"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
						
											<?php
                                                $this_month = date("m");

											$sql = "
													SELECT  ne.name, ne.id_user as user_id, ne.dob, ne.unit_id  
													FROM profile ne 
													WHERE SUBSTRING(ne.dob, 6,2) = '".$this_month."'
													ORDER BY SUBSTRING(ne.dob, 9,2) ASC
												";

											$datas = $db->query($sql)->fetchAll();
											?>	
											<?php foreach ($datas as $data) { ?>									
						
						
							<li class="media">
                                <div class="mr-3">
								 
                                    <img src="../profile/profile.png" width="36" height="36" class="rounded-circle" alt="">
							 
								
                                </div>
                                <div class="media-body">
                                    <a href="../message/chat.php?id=<?=$data['user_id']?>" class="media-title font-weight-semibold"><?=strtoupper($data['name'])?></a>
                                    <span class="d-block text-muted font-size-sm">
										<?=date("d F", strtotime($data['dob']));?> - 
									<?=$data['unit_id']?>
									</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
                            </li>
											<?php } ?>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer bg-light">
                        <a href="#" class="text-body mr-auto">&nbsp;</a>
                        <div>
                            <a href="#" class="text-body" data-popup="tooltip" title="Mark all as read"><i class="icon-radio-unchecked"></i></a>
                            <!--a href="#" class="text-body ml-2" data-popup="tooltip" title="Bug tracker"><i class="icon-bug2"></i></a-->
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <span class="my-3 my-lg-0 ml-lg-3" style="background: #fff"><span id="total_online"></span>&nbsp;</span>
    </div>


    <?php
        $sql = "
            SELECT COUNT(*) AS total_dt
            FROM message 
            WHERE receiver='".$_SESSION['username']."'
            AND is_read='0'
        ";
        $onchat = $db->query($sql);
        $allchats = $onchat->fetchArray();
    ?>


    <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">
        <li class="nav-item nav-item-dropdown-lg dropdown">
            <a href="#" class="navbar-nav-link navbar-nav-link-toggler" data-toggle="dropdown">
               <i class="icon-people"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-350">
                <div class="dropdown-content-header">
                    <span class="font-weight-semibold">Users Online</span>
                    <!--a href="#" class="text-body"><i class="icon-compose"></i></a-->
                </div>
                <div class="dropdown-content-body dropdown-scrollable">
                         <ul id="user_login_status" class="media-list">
						                  
					 
						 
					
											<?php



											                                            $sql = "
															SELECT id, name, imgnow, title  FROM
															( 
															SELECT ua.id, ne.name, 
															ne.image_user AS imgnow, ne.unit_id as title
															FROM users ua
															LEFT JOIN profile ne ON ne.id_user = ua.id 
															WHERE ua.last_session > DATE_SUB(NOW(), INTERVAL 100 SECOND) 
															GROUP BY ua.id 
														
															) tbl 
															GROUP BY id
															ORDER BY name
											
											";
											$onchat = $db->query($sql);
											$allchats = $onchat->fetchAll();





											?>	
											
											
									 
												<?php foreach ($allchats as $data) { ?>		 
													
													
							
													<li class="media">
														<div class="mr-3">

															 
															<img src="../img/<?=$data['imgnow'];?>" width="36" height="36" class="rounded-circle" alt="">
															
														 

														</div>
														<div class="media-body">
															<a href="../message/chat.php?id=<?=$data['username']?>" class="media-title font-weight-semibold"><?=ucwords(strtolower($data['name']))?></a>
															<span class="d-block text-muted font-size-sm"><?=$data['sub_unit'];?> - <?=$data['title'];?></span>
														</div>
														<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
													</li>
												<?php } ?>                      
										                  
                     










					
                    </ul>
                </div>

					<div class="dropdown-content-footer bg-light" style="text-align: center">
                        <a href="../message/chat.php?id=S092021030024" class="text-body ml-auto">Help Desk</a>
                        <!--a href="#" class="text-body"><i class="icon-gear"></i></a-->
                    </div>
            </div>
        </li>









<?php

											$sql = "
											
												SELECT COUNT(*) AS total_dt
												FROM message 
												WHERE receiver='".$_SESSION['username']."'
												AND is_read='0'
											
											
											";
											$onchat = $db->query($sql);
											$aaa = $onchat->fetchArray();


											?>




        <li class="nav-item nav-item-dropdown-lg dropdown">
            <a href="#" class="navbar-nav-link navbar-nav-link-toggler" data-toggle="dropdown">
                <i class="icon-bubbles4"></i>
                <span class="badge badge-warning badge-pill ml-auto ml-lg-0"><?=$aaa['total_dt'];?></span>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-350">
                <div class="dropdown-content-header">
                    <span class="font-weight-semibold">Message</span>
                    <!--a href="#" class="text-body"><i class="icon-compose"></i></a-->
                </div>

                <div class="dropdown-content-body dropdown-scrollable">
                 
                         <ul class="media-list">
						
						
					
											<?php



											                                            $sql = "
											
												SELECT sender, chat, COUNT(*) AS total_dt
												FROM message 
												WHERE receiver='".$_SESSION['username']."'
												AND is_read='0'
												GROUP BY sender
											
											";
											$onchat = $db->query($sql);
											$allchats = $onchat->fetchAll();
											//$total_data = $onchat->numRows();





											?>	
											
											
									 
												<?php foreach ($allchats as $data) { ?>		
													<?php $types = substr($data['sender'], 0, 1); ?>											
													<?php if ($types == "S") { ?>
														<?php $name = ucwords(strtolower(getValue('profile', 'name', 'empid', $data['sender']))); ?> 
													<?php } else { ?>
														<?php $name = ucwords(strtolower(getValue('student', 'name', 'matrix_no', $data['sender'])));?> 
													<?php } ?>						
													
													
							
													<li class="media">
														<div class="mr-3">

															 
															<?php if ($types == "S") { ?>
															<img src="../profile/image.php?id=<?=$data['sender']?>" width="36" height="36" class="rounded-circle" alt="">
															<?php } else { ?>
															<img src="../student_profile/image.php?id=<?=$data['sender']?>" width="36" height="36" class="rounded-circle" alt="">
															
															<?php } ?>

														</div>
														<div class="media-body">
															<a href="../message/chat.php?id=<?=$data['sender']?>" class="media-title font-weight-semibold"><?=$name?> (<?=$data['total_dt']?>)</a>
															<span class="d-block text-muted font-size-sm"><?=$data['chat']?></span>
														</div>
														<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
													</li>
												<?php } ?>                      
										                  
                    </ul>
                </div>

					<div class="dropdown-content-footer bg-light" style="text-align: center">
                        <a href="../message" class="text-body ml-auto">My Message</a>
                        <!--a href="../message/chat.php?id=S1" class="text-body ml-auto">Help Desk</a-->
                        <!--a href="#" class="text-body"><i class="icon-gear"></i></a-->
                    </div>
            </div>
        </li>

        <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
            <a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
            <i class="icon-user"></i>
                <img src="../../global_assets/images/placeholders/placeholder.jpg" class="rounded-pill mr-lg-2" height="34" alt="">
                <span class="d-none d-lg-inline-block"><?=$_SESSION['username']?></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">

																
                <a href="../../account/" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="logout">
                    <input type="hidden" name="id" value="<?=$menu['id']?>">
                    <button type="submit" class="dropdown-item"><i class="icon-switch2"></i> Logout</button>
                </form>
                
            </div>
        </li>
    </ul>
</div>
<!-- /main navbar -->