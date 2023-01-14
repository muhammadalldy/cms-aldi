<!-- User menu -->
<div class="sidebar-section sidebar-user my-1">
    <div class="sidebar-section-body shadow-sm">
        <div class="media">
            <a href="#" class="mr-3">
			
					<?php
					
						$sql = "
								SELECT u.image, p.bio 
                                FROM profile p
                                LEFT JOIN users u ON u.id = p.id_user 
                                WHERE u.username='".$_SESSION['username']."'								
								";								
								$rs = $db->query($sql);
								$dt = $rs->fetchArray();
								$imgnew = $dt['image'];
								$bio = $dt['bio'];
						
								
					?>			
				<img src="../files/image/<?=$imgnew?>" class="rounded-circle" width="122" height="147" >
    


			</a> 

            <div class="media-body">
                <div class="font-weight-semibold">
				
				<?=getValue('profile', 'name', 'id_user', $_SESSION['id_user'])?>
				
				</div>
                <div class="font-size-sm line-height-sm opacity-50">
				<?=$bio?>
                 
 
                </div>
            </div>

            <div class="ml-3 align-self-center">
                <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                    <i class="icon-transmission"  style="color: #263238; background: white"></i>
                </button>

                <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                    <i class="icon-cross2" style="color: #263238; background: black"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- /user menu -->

<!-- Main navigation -->
<div class="sidebar-section">
    <ul class="nav nav-sidebar" data-nav-type="accordion">

        <!-- Main -->
        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
        <?php
            $sql = "
                    SELECT bm.* 
                    FROM menu bm 
                    LEFT JOIN menu_role bml ON bml.menu_id = bm.id
                    WHERE bm.id_parent='0' 
                    AND bm.is_active='ACTIVE' 
                    AND bml.menu_id IS NOT NULL
                    AND bml.role_id='".$_SESSION['userrole']."'
                    ORDER BY bm.ordering ASC";
            $menus = $db->query($sql)->fetchAll();
        ?>
        <?php foreach($menus as $menu){ ?>

<?php //if($menu['id'] != 1){ ?> 

        <?php
            $display_submenu = 0;
            $checkmenu = explode("/", substr($_SERVER['REQUEST_URI'], 1))[0];
            //nav-item-open
        ?>
            <?php if($menu['filename'] == "#"){ 
                    $sql = "
                            SELECT bm.* 
                            FROM menu bm
                            LEFT JOIN menu_role bml ON bml.menu_id = bm.id
                            WHERE bm.id_parent='".$menu['id']."'  
                            AND bm.is_active='ACTIVE' 
                            AND bml.menu_id IS NOT NULL
                            AND bml.role_id='".$_SESSION['userrole']."'
                            ORDER BY bm.ordering ASC";
                    $submenus = $db->query($sql)->fetchAll();
                    
					$nav_item_open = 0;
                    foreach ($submenus as $submenu) {
                        if (strtolower(str_replace(" ","_",$submenu['title']))==$checkmenu) {
                            $nav_item_open = $nav_item_open + 1;
                        } else {
                            $nav_item_open = $nav_item_open + 0;
                        }
						
						
                    }
					
                }
             ?>
        
        <li class="nav-item <?php echo($nav_item_open == 1) ? "nav-item-open" : "" ?>  <?php echo($menu['filename']=="#") ? "nav-item-submenu" : "" ?>" >
            <a href="/<?=$menu['filename']?>" class="nav-link <?php echo(strtolower(str_replace(" ","_",$menu['title']))==$checkmenu) ? "active" : "" ?>">
                <i class="<?=$menu['icon']?>"></i>
                <span>                                
                    <?=$menu['title']?>  
                </span>
            </a>
            <?php if($menu['filename'] == "#"){ ?>
            <?php 
                $sql = "
                SELECT bm.* 
                FROM menu bm
                LEFT JOIN menu_role bml ON bml.menu_id = bm.id
                WHERE bm.id_parent='".$menu['id']."'  
                AND bm.is_active='ACTIVE' 
                AND bml.menu_id IS NOT NULL
                AND bml.role_id='".$_SESSION['userrole']."'
                ORDER BY bm.ordering ASC";

                $submenus = $db->query($sql)->fetchAll();
                foreach($submenus as $submenu){
                    if(strtolower(str_replace(" ","_",$submenu['title']))==$checkmenu){
                        $display_submenu = 1;
                    }  
                }
                //var_dump(in_array(strtolower(str_replace(" ","_",$menu['title'])), $submenus));

                ?>
            <ul class="nav nav-group-sub" <?php echo($display_submenu==1) ? "style='display:block'" : "" ?>  <?php //echo("style='display:block'") ?>  data-submenu-title="ECharts library">
                <?php foreach($submenus as $submenu){ ?>

			 
                    <li class="nav-item "><a href="/<?=$submenu['filename']?>" class="nav-link <?php echo(strtolower(str_replace(" ","_",$submenu['title']))==$checkmenu) ? "active" : "" ?>">
                    <?=$submenu['title']?></a></li>
			 
                <?php } ?>
            </ul>
            <?php $display_submenu = 0; ?>
            <?php } ?>
        </li>
		
	
        <?php //}?> 	
		
        <?php }?> 
    </ul>
</div>
<!-- /main navigation -->
 