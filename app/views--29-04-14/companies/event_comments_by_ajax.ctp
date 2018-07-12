<?php  echo $this->element("admin_css"); ?>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">        
      
                                    <tr>
                                        <td class="frmTitles"><?php echo sizeof($eventcommentArray);?> Comments</td>
                                    </tr>
                                    <?php if(sizeof($eventcommentArray)==0){?> 
                                        <tr><td  class="forName" align=center>No comments added.</td></tr>
                                        <?php }else{    //DebugBreak();
                                            foreach($eventcommentArray as $commentData){

                                            ?>
                                            <tr>
                                                <td  class="grayText" style="padding:5px 12px; vertical-align:top; font-size:12px;" > By
                                                <?php  echo ucfirst($commentData['EventComment']['holder_screenname']);  ?> | <?php  echo date("F d, Y", strtotime($commentData['EventComment']['created']));  ?>
                                                </td>
                                              </tr>
                                            <tr>
                                             <td  class="" style="padding:5px 12px; vertical-align:top; font-size:12px;" >    
                                                <span class=""><?php echo $commentData['EventComment']['comment'];  ?>  </span></td>
                                            </tr> 
                                            <tr><td class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr> 
                                          
                                            <?php } }?>
                                      </table>
