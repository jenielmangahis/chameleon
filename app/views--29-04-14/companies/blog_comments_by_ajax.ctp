<?php  echo $this->element("admin_css"); ?>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">        
      
                                    <tr>
                                        <td class="frmTitles"><?php echo sizeof($blogcommentArray);?> Comments</td>
                                    </tr>
                                    <?php if(sizeof($blogcommentArray)==0){?> 
                                        <tr><td  class="" align=center>No comments added.</td></tr>
                                        <?php }else{    //DebugBreak();
                                            foreach($blogcommentArray as $commentData){

                                            ?>
                                            <tr>
                                                <td  class="grayText" style="padding:5px 12px; vertical-align:top; font-size:12px;">By
                                                <?php  echo ucfirst($commentData['BlogComment']['holder_screenname']);  ?> | <?php  echo date("F d, Y", strtotime($commentData['BlogComment']['created']));  ?>
                                                </td>
                                              </tr>
                                            <tr>
                                             <td  class="" style="padding:5px 12px; vertical-align:top; font-size:12px;">    
                                                <span class=""><br /><?php echo $commentData['BlogComment']['comment'];  ?>  </span></td>
                                            </tr> 
                                            <tr><td class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr> 
                                          
                                            <?php } }?>
                                      </table>
