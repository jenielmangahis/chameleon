                                    <table width="100%" border="0" cellspacing="5" cellpadding="5">        
      
                                    <tr style="margin-bottom: 8px;">
                                        <td class="forName frmTitles" style="background:#509CD9;  color: white;   font-size: 12px;   font-weight: bold;  padding: 3px 12px;"><strong><?php echo sizeof($msgReplyArray);?> Replies</strong></td>
                                    </tr>
                                    <?php if(sizeof($msgReplyArray)==0){?> 
                                        <tr><td  class="forName" align=center>No replies added.</td></tr>
                                        <?php }else{    //DebugBreak();
                                            foreach($msgReplyArray as $replyData){

                                            ?>
                                            <tr>
                                                <td  class="forName grayText" > By
                                                <?php  echo ucfirst($replyData['MessageReply']['holdername']);  ?> | <?php  echo date("M d, Y", strtotime($replyData['MessageReply']['created']));  ?>
                                                </td>
                                              </tr>
                                            <tr>
                                             <td  class="forName" >    
                                                <span class=""><?php echo $replyData['MessageReply']['reply_content'];  ?>  </span></td>
                                            </tr> 
                                            <tr><td class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr> 
                                          
                                            <?php } }?>
                                      </table>
