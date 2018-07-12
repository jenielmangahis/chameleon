 <script type="text/javascript">   
             
 </script>
 
 <?php
          
    $server_path=$_SERVER['REQUEST_URI'];
    $server_para=explode('/',$server_path);
    $show_all=0;
    if($server_para[3]=="all")
    {
        $show_all=1;
    }
?>

      
<!-- Body Panel starts -->
 <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>">

<div class="navigation">
    <div class="boxBg">

       
    </div>
</div>
<div class="bdyCont">
    <div class="boxBg1">

        <div class="boxBor1">
            <div class="boxPad">
            <img src="/<?php echo $avatar_url;?>" width="55" height="55" align="left">
                <h2 style="float:left;">Welcome <br /><?php echo $screenname;?>!</h2>

                <div style="float: left; position: relative;width: 700px;margin-left:198px; margin-top:-30px;">     
                    <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow" id="leftmenubar_bg">

                        <?php
                        if(isset($_SESSION['iframe_session']))
                            echo $this->element("iframe_menubar"); 
                        else
                            echo $this->element("leftmenubar");
                        
                        ?>  
                    </div>

                </div>
             
             <div style="position: relative;float: left; padding-top: 50px; width: 895px;">
                
                    <div style="width: 700px;position: relative;float: left; padding-left: 50px;">
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border_shadow">
                    <tr>
                      <!--  <td width="5%" class="forName frmTitles" ></td>   -->
                      <td width="5%" class="forName frmTitles">#</td> 
                        <td width="30%" class="forName frmTitles">Top Points Awarded to Members</td> 
                        <td width="20%" class="forName frmTitles">Points</td> 
                        <td width="20%" class="forName frmTitles">Points to be #1</td> 
                        
                  </tr>
                    <?php  
                        if($top_points_arr){ 
                           
                            $alt=0;  
                            $user_in_top10=0;
                        foreach($top_points_arr as $eachrow){
                            
                            if($show_all==0)
                            {
                                if($alt==5)
                                    break;
                            }
                                                        
                            
                           if($alt%2==0)
                                $class="style='background-color:#FFF;'";
                           else
                                $class="style='background-color:#E8E8E8;'"; 
                             $alt++;     
                        
                        
                        $userid = $eachrow['PointArchiveUser']['member_id'];
                        $points = $eachrow[0]['points'];
                        $modelname = "PointArchiveUser";
                        $othermodelname = "User";
                        $redirectionurl = "top_points";
                        $member_name = AppController::getmembername($userid);
                        
                        $point_tobe_no1=$top_points_arr[0][0]['points']-$points;
                        
                        
                        if($session_userid==$userid)
                        {
                            $member_name="You";
                            $bold_class="style='font-weight: bold;font-size: 15px;color:red;'";
                            $user_in_top10=1;
                        }
                        else
                           $bold_class="" ;
                        
                        ?>
                        <tr <?php echo $class; ?> >
                        <td class="forName" <?php echo $bold_class;?> ><?php echo $alt;?></td>                      
                        <td class="forName" <?php echo $bold_class;?>><?php echo $member_name?$member_name:"N/A"; ?></td> 
                        <td class="forName" <?php echo $bold_class;?>><?php echo $points?$points:"N/A"; ?></td> 
                        <td class="forName" <?php echo $bold_class;?>><?php echo $point_tobe_no1;?></td> 
                       
                        </tr>
                            
                        <?php    
                        } 
                          
                        if($user_in_top10==0)
                        {
                            if($alt%2==0)
                                $class="style='background-color:#FFF;'";
                           else
                                $class="style='background-color:#E8E8E8;'"; 
                             $alt++;                                                            
                             
                             if($top_points_arr){ 
                                 $i=1;
                            
                                foreach($top_points_arr as $eachrow)
                                {
                                     $rank=$i;
                                     $userid = $eachrow['PointArchiveUser']['member_id'];
                                     
                                     if($session_userid==$userid)
                                     {
                                        
                                         $points = $eachrow[0]['points'];
                                         $modelname = "PointArchiveUser";
                                         $othermodelname = "User";
                                         $redirectionurl = "top_points";
                                         $member_name = AppController::getmembername($userid);
                                        
                                         $member_name="You";
                                         $bold_class="style='font-weight: bold;font-size: 15px;color:red;'";
                                        
                                         $point_tobe_no1=$top_points_arr[0][0]['points']-$points;
                                         break;
                                     }
                                     
                                     $i++;
                                }
                             }
                             
                            ?>
                        <tr <?php echo $class; ?>>
                        <td class="forName" <?php echo $bold_class;?> ><?php echo $rank;?></td>                      
                        <td class="forName" <?php echo $bold_class;?>><?php echo $member_name?$member_name:"N/A"; ?></td> 
                        <td class="forName" <?php echo $bold_class;?>><?php echo $points?$points:"N/A"; ?></td> 
                        <td class="forName" <?php echo $bold_class;?>><?php echo $point_tobe_no1;?></td> 
                       
                        </tr>
                            
                        <?php 
                        }  
                          
                          
                        }else {

                        ?>
                            <tr><td colspan="4" class="forName" align=center>No Members Found.</td></tr>

                    
                        <?php }?>
                </table>
                 
                   
                </div>
                
                    <div style="position: relative;float: left; padding-left: 25px;">
                    <a href="/companies/dashboard"><font size="+1"><b>Close</b></font></a><br />
                    <a href="/companies/showtop10points/all"><font size="+1"><b>View Details</b></font></a>
                    </div>
                
             </div>
                
            </div>
           
        </div>


    </div>
</div>

<div class="clear"></div>
<!-- Body Panel ends --> 



