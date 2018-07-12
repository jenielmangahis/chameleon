                        <table width="100%" border="0" cellspacing="3" cellpadding="3" > 
                            <tr><td colspan="2" class="paddBot orangeTextBold" width="100%" height="100%" align="left">Chat Active List</td></tr>
                            <?php 
                                if($memberdetails){


                                    foreach($memberdetails as $member){
                                        if($member['User']['avatar_url'] !=''){
                                            $avatarurl= $member['User']['avatar_url']; 
                                             $str=explode("/",$avatarurl);
                                             if($str[0]=="img"){ 
                                                 if(file_exists($avatarurl))  {
                                                       $avatarurl= $this->webroot.$avatarurl;
                                                 }else{
                                                     $avatarurl= $this->webroot.'img/avatar/image-not-available.jpg'; 
                                                 }
                                                 
                                             }else{
                                                   $avatarurl= $avatarurl;
                                             }   
                                        }else{
                                            $avatarurl= $this->webroot.'img/avatar/image-not-available.jpg';
                                        } 

                                    ?>
                                    <tr>
                                        <td width="10%" align="left" valign="top">
                                              <img alt="" src="<?php echo $avatarurl; ?>" style="border: 1px solid #CCCCCC; padding: 2px;" height="40px" width="40px" />
                                        </td>
                                        <td class="forName grayText coinlist" align="left" valign="top">
                                            <a href="javascript:void(0);" class="grayText" > <strong><?php echo ucfirst($member['Holder']['screenname']); ?></strong></a>
                                        </td>
                                    </tr>
                                    <?php } }else{
                                ?>
                                <tr>
                                    <td class="forName " colspan="2" align="center"> No member joined.</td></tr>
                                <?php
                            }?>
                        </table>