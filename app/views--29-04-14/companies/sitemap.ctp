<style type="text/css">

.sitemap_div{
    float: left; position: relative; width: 180px; padding: 2px; margin: 20px;
}

</style>

<div style="float: left; position: relative; margin-left: 20px; margin-right: 20px; width: 897px;">

<div class="clear"></div>

    <div style="font-family:arial; font-size: 17px; margin-left: 5px; color: grey;">
    <?php
    //debugbreak();

        if($project['Project']['url']!=="")
            $project_header=$project['Project']['url'];
        else
            $project_header=$project_name;

        echo $project_header." Site Map";
    ?>
    </div>
    <div class="clear"><hr style="border: 1px solid grey;"></div>
    <div class="clear" style="padding-bottom: 50px;"></div>

    <div>
    <ul>
    <?php /*
    $globalcondition="";    

        if(empty($_SESSION['User']['User']['id'])) $globalcondition="and Content.is_global='1'";

        $showcommenttab="";
        if($project['ProjectType']['coin_verification']=="1")
        {
            if($project['ProjectType']['showcommentbutton']=="1")
                {        $showcommenttab="";    }
            else{
                    if(empty($_SESSION['User']['User']['id'])) 
                         $showcommenttab="and Content.internal_alias !='comments'";
                    else
                    {
                        if(AppController::iscoinholder($_SESSION['User']['User']['id'])=="false")
                        {            
                            $showcommenttab="and Content.internal_alias !='comments'";
                        }    
                    }
            }
        }
        else
        {
            if($project['ProjectType']['showcommentbutton']=="1")
            {        $showcommenttab="";    }
            else
            {        $showcommenttab="";    }

        } 

        App::import("Model", "Content");
        $this->Content =   & new Content();
        $contentcount = $this->Content->find('count', array('conditions' => "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and parent_id='0' and Content.delete_status='0' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' and Content.internal_alias !='home_page' and Content.internal_alias !='home-page' and Content.internal_alias !='contact' ".$globalcondition." ".$showcommenttab,'fields'=>'id'));
        $url="/";

        if($_SERVER['HTTP_HOST']=="coins4promo.com" || $_SERVER['HTTP_HOST']=="www.coins4promo.com" || $_SERVER['HTTP_HOST']=="test.coins4promo.com" || $_SERVER['HTTP_HOST']=="192.168.1.225:8219" || $_SERVER['HTTP_HOST']=="75.125.190.162:9085")
        {
            $url="/$project_name";
        }


            // For Home menu link
             $conditionhome = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and (Content.internal_alias ='home_page' or Content.internal_alias ='home-page') ".$globalcondition." ".$showcommenttab;
                $homedetails = $this->Content->find('first', array('conditions' => $conditionhome)); 

        ?>

            <li><a href="<?php echo $url; ?>" <?php if($page_url=="home_page" || $page_url=="home-page") echo 'class="active"' ;  ?>><span><?php
                 $titlehome =$homedetails['Content']['title'];
                if($titlehome){$titlehome =AppController::WordLimiter($titlehome,20);}
                 echo $titlehome;
                ?></span></a>
            </li>
            <li>|</li>
            
        <?php     
        $condition = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and (is_sytem!='2') and `Content`.`internal_alias` !='home-page'  ".$globalcondition." ".$showcommenttab;
                $contentdetails = $this->Content->find('all', array('conditions' => $condition,'order'=>'file_sequence'));
        //echo "<pre>"; print_r($contentdetails); echo "</pre>"; exit;
            foreach($contentdetails as $convalue)
            {  // DebugBreak();
                if($convalue['Content']['alias']=="events" || $convalue['Content']['alias']=="chat" || $convalue['Content']['alias']=="blogs"){
                        $menulink="/companies/".$convalue['Content']['alias'];
                    }else{
                         $menulink="/".$convalue['Content']['alias'];
                    }
        ?>       
                <li><a href="<?php echo $menulink;?>" <?php if($page_url== $convalue['Content']['alias']) echo 'class="active"' ;  ?>> <span><?php
                 $title =$convalue['Content']['title'];
                if($title){$title =AppController::WordLimiter($title,20);}
                 echo $title;
                ?></span></a>
               
                
                <?php $parentid=$convalue['Content']['id'];  
                //$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
                $condition2 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$parentid' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='home_page' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' ".$globalcondition." ".$showcommenttab;
                $submenus = $this->Content->find('all', array('conditions' =>$condition2,'order'=>'file_sequence'));
                if ($submenus && $submenus!="" && !empty($submenus))
                
                    {?>    
                     <ul>
                        <?php foreach($submenus as $submenu)
                        {
                            $submenulink="/".$submenu['Content']['alias'];
                               if($submenu['Content']['alias']=="pastevents" ){
                                    $submenulink="/companies/".$submenu['Content']['alias'];
                                }
                         ?> 
                        
                            <li  class="sub" >
                            <a href="<?php echo $submenulink;?>" <?php if($page_url== $submenu['Content']['alias']) echo 'class="active"' ;  ?>><?php 
                            $title1=$submenu['Content']['title'];
                            if($title1){$title1 =AppController::WordLimiter($title1,20);}
                             echo $title1;
                            ?></a>

                            

                            
                        <?php $subparentid=$submenu['Content']['id'];  
                        //$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
                        $condition3 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$subparentid' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='home_page' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' ".$globalcondition." ".$showcommenttab;
                        $subsubmenus = $this->Content->find('all', array('conditions' =>$condition3,'order'=>'file_sequence'));
                        if ($subsubmenus && $subsubmenus!="" && !empty($subsubmenus))
                        {?>    
                        <ul>
                                    <?php foreach($subsubmenus as $subsubmenu)
                                    { ?>
                                            <li>
                                                <a href="/<?php echo $subsubmenu['Content']['alias'];?>" <?php if($page_url== $subsubmenu['Content']['alias']) echo 'class="active"' ;  ?>><?php $title2=$subsubmenu['Content']['title'];
                                                if($title2){$title2 =AppController::WordLimiter($title2,20);}
                                                 echo $title2;
                                                ?></a>
                                            </li>
                                            
                      <?php } ?>
                        </ul>
                        <?php
                        } ?>







                            </li>
                        
                        <?php }?>
                         </ul>
                    <?php } ?>
                    
            
                    
                </li><li>|</li>
            <?php 
            } 
            */
            ?>
    
    </ul>
    </div>
    
    
    <div class="sitemap_div " align="left">
    <?php
        App::import("Model", "Content");
            $this->Content =   & new Content();
            $contentcount = $this->Content->find('count', array('conditions' => "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and parent_id='0' and Content.delete_status='0' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' and Content.internal_alias !='home_page' and Content.internal_alias !='home-page' and Content.internal_alias !='contact' ".$globalcondition." ".$showcommenttab,'fields'=>'id'));
            $url="/";

            if($_SERVER['HTTP_HOST']=="coins4promo.com" || $_SERVER['HTTP_HOST']=="www.coins4promo.com" || $_SERVER['HTTP_HOST']=="test.coins4promo.com" || $_SERVER['HTTP_HOST']=="192.168.1.225:8219" || $_SERVER['HTTP_HOST']=="75.125.190.162:9085")
            {
                $url="/$project_name";
            }


            // For Home menu link
             $conditionhome = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and (Content.internal_alias ='home_page' or Content.internal_alias ='home-page') ".$globalcondition." ".$showcommenttab;
                $homedetails = $this->Content->find('first', array('conditions' => $conditionhome)); 

        ?>

            <a href="<?php echo $url; ?>" <?php if($page_url=="home_page" || $page_url=="home-page") echo 'class="active"' ;  ?>><span style="font-weight: bolder;"><?php
                 $titlehome =$homedetails['Content']['title'];
                if($titlehome){$titlehome =AppController::WordLimiter($titlehome,20);}
                 echo $titlehome;
                ?></span></a>

    </div>
    
          
    
    <?php     
        $condition = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and (is_sytem!='2') and `Content`.`internal_alias` !='home-page'  ".$globalcondition." ".$showcommenttab;
                $contentdetails = $this->Content->find('all', array('conditions' => $condition,'order'=>'file_sequence'));
        //echo "<pre>"; print_r($contentdetails); echo "</pre>"; exit;
        $cnt=1;
            foreach($contentdetails as $convalue)
            {  // DebugBreak();
                if($convalue['Content']['alias']=="events" || $convalue['Content']['alias']=="chat" || $convalue['Content']['alias']=="blogs"){
                        $menulink="/companies/".$convalue['Content']['alias'];
                    }else{
                         $menulink="/".$convalue['Content']['alias'];
                    }
                    
               if($cnt%4==0)
               {
                   ?>
                   <div class="clear" style="border-bottom: 1px solid #CCCCCC"></div>
                   <?php
               }
               
               $cnt++;
                    
                    
        ?>       
                <div class="sitemap_div"  align="left">
                <div class="" style="padding: 0px; margin: 0px;">
                <a href="<?php echo $menulink;?>" <?php if($page_url== $convalue['Content']['alias']) echo 'class="active"' ;  ?>> <span style="font-weight: bolder;"><?php
                 $title =$convalue['Content']['title'];
                if($title){$title =AppController::WordLimiter($title,20);}
                 echo $title;
                ?></span></a>
               </div>
                
                <?php $parentid=$convalue['Content']['id'];  
                //$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
                $condition2 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$parentid' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='home_page' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' ".$globalcondition." ".$showcommenttab;
                $submenus = $this->Content->find('all', array('conditions' =>$condition2,'order'=>'file_sequence'));
                if ($submenus && $submenus!="" && !empty($submenus))
                
                    {?>    

                        <?php foreach($submenus as $submenu)
                        {
                            $submenulink="/".$submenu['Content']['alias'];
                               if($submenu['Content']['alias']=="pastevents" ){
                                    $submenulink="/companies/".$submenu['Content']['alias'];
                                }
                         ?> 
                        
                            <div style="margin-top: 5px; font-size: 12px; margin-left: 2px;">
                            <a href="<?php echo $submenulink;?>" <?php if($page_url== $submenu['Content']['alias']) echo 'class="active"' ;  ?>><?php 
                            $title1=$submenu['Content']['title'];
                            if($title1){$title1 =AppController::WordLimiter($title1,20);}
                             echo $title1;
                            ?></a>
                            </div>
                            

                            
                        <?php $subparentid=$submenu['Content']['id'];  
                        //$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
                        $condition3 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$subparentid' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='home_page' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' ".$globalcondition." ".$showcommenttab;
                        $subsubmenus = $this->Content->find('all', array('conditions' =>$condition3,'order'=>'file_sequence'));
                        if ($subsubmenus && $subsubmenus!="" && !empty($subsubmenus))
                        {?>    
                        
                                    <?php foreach($subsubmenus as $subsubmenu)
                                    { ?>
                                            <div style="margin-top: 5px; font-size: 11px; margin-left: 5px;">
                                                <a href="/<?php echo $subsubmenu['Content']['alias'];?>" <?php if($page_url== $subsubmenu['Content']['alias']) echo 'class="active"' ;  ?>><?php $title2=$subsubmenu['Content']['title'];
                                                if($title2){$title2 =AppController::WordLimiter($title2,20);}
                                                 echo $title2;
                                                ?></a>
                                            </div>
                                            
                      <?php } ?>

                        <?php
                        } ?>








                        
                        <?php }?>

                    <?php } ?>
                    
            
                    
                </div>
            <?php 
            } 
            
            if($cnt%4==0)
               {
                   ?>
                   <div class="clear" style="border-bottom: 1px solid #CCCCCC"></div>
                   <?php
               }
               
               $cnt++;
            
            ?>
            
             <div class="sitemap_div" align="left">
             
                <a class="rhtNav" href="/companies/registeruser"><span><b>Register</b></span></a>
             
             </div>
             
             <?php
                if($cnt%4==0)
               {
                   ?>
                   <div class="clear" style="border-bottom: 1px solid #CCCCCC"></div>
                   <?php
               }
               
               $cnt++;
?>
             
             <div class="sitemap_div" align="left">
             
                <a class="rhtNav" href="/companies/login"><span><b>Login</b></span></a>
             
             </div>
             
             <?php
                if($cnt%4==0)
               {
                   ?>
                   <div class="clear" style="border-bottom: 1px solid #CCCCCC"></div>
                   <?php
               }
               
               $cnt++;
               ?>
             
             <div class="sitemap_div" align="left">
             
                <a class="rhtNav" href="/companies/show_terms/Terms"><span><b>Terms Of Use</b></span></a>
             
             </div>
             
             <?php
                if($cnt%4==0)
               {
                   ?>
                   <div class="clear" style="border-bottom: 1px solid #CCCCCC"></div>
                   <?php
               }
               
               $cnt++;
               ?>
             
             <div class="sitemap_div" align="left">
             
                <a class="rhtNav" href="/companies/show_terms/Policy"><span><b>Privacy Statement</b></span></a>
             
             </div>
    


</div>
