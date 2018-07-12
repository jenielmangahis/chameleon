<?php  echo $this->element("admin_css"); ?>

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">        
      
                                    <tr>
                                        <td width="25%" class="new_forName frmTitles" >Suggested Comment</td>
                                        <td width="75%" class="new_forName frmTitles">Comments & Replies</td>
                                    </tr>
                                    <?php if(sizeof($commentArray)==0){?> 
                                        <tr><td colspan="2" class="new_forName" align=center>No comment(s) posted coin by any member.</td></tr>
                                        <?php }else{    //DebugBreak();
                                            foreach($commentArray as $commentData){

                                            ?>
                                            <tr>
                                                <td  class="new_forName grayText" ><?php if($commentData['CommentType']['comment_type_name']=="") {
                                                     echo "Misc. Comment";
                                                }else{ 
                                                   echo $commentData['CommentType']['comment_type_name'];  }?></td>
                                                <td  class="new_forName ">
                                                <strong><?php 
                                                 if($holder_id==$commentData['Comment']['holder_id']) {
                                                    echo "My Comment";
                                                }else{
                                                   echo "Member Comment";  
                                                }
                                                ?></strong> 
                                                <span style="float: right;" id="favorite_<?php echo $commentData['Comment']['id'];?>"> 
                                                  <?php 
                                                       //DebugBreak();             
                                                   if($holder_id!=$commentData['Comment']['holder_id'] ) { 
                                                  if($followingCommnets && in_array($commentData['Comment']['id'], $followingCommnets)) {  ?>
                                                      <!-- if comment id already in favorite then remove it form favorite -->
                                                      <a href="javascript:void(0);" title="Unfollow Comment" id="unfollowcomment_<?php echo $commentData['Comment']['id'];?>" class="orangeTextBold">  
                                                     Unfollow
                                                      </a> 
                                                <?php  }else{
                                                      // else  add comment ot favorite   ?>
                                                       <a href="javascript:void(0);" title="Follow Comment" id="followcomment_<?php echo $commentData['Comment']['id'];?>" class="orangeTextBold">  
                                                       Follow 
                                                        </a>
                                               <?php   }?> 
                                              
                                                <?php } ?>
                                                </span>
                                                <br/>
                                                <span class="grayText">
                                                <?php  if($holder_id!=$commentData['Comment']['holder_id'] || $commentData['Comment']['locked']=="1") {  ?>
                                                <?php echo stripslashes($commentData['Comment']['comment']);  ?>  
                                                <?php }else {    ?>
                                                <a href="javascript:void(0);" id="editcomment_<?php echo $commentData['Comment']['id'];?>" title="Double click to Update comment"><?php echo stripslashes($commentData['Comment']['comment']);  ?></a>
                                                <div id="updatecommenttdesc_<?php echo $commentData['Comment']['id'];?>" style="display: none;" >
                                                        <form action="/companies/save_comment" id="upcommentform_<?php echo $commentData['Comment']['id'];?>" name="upcommentform_<?php echo $commentData['Comment']['id']?>" method="post">
                                                                <input type="hidden" name="comment_id" value="<?php echo $commentData['Comment']['id'];?>" />
                                                                <input type="hidden" name="coin_holder_id" value="<?php echo $commentData['Comment']['coin_holder_id'];?>" />
                                                                <input type="hidden" name="comment_type_id" value="<?php echo $commentData['Comment']['comment_type_id'];?>" />
                                                                
                                                              <span class="txtArea_top" style="margin-bottom: 8px;">   <span class="txtArea_bot"> 
                                                                 <textarea cols="35" rows="3" name="comment"   class="noBg border_shadow" style="border: none;"><?php echo $commentData['Comment']['comment'];  ?></textarea>  
                                                              </span>
                                                              </span>
                                                              <br/>
                                                              <span class="flx_button_lft marginRight4px" id="updatecomment_<?php echo $commentData['Comment']['id']?>_0">
                                                                <?php echo $form->button('Update', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                                                             </span>  &nbsp; 
                                                             <span class="flx_button_lft marginRight4px" id="cancelupdate_<?php echo $commentData['Comment']['id']?>_0">
                                                                <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                                                             </span>
                                                              </form>
                                                </div>
                                                <?php } ?>
                                                </span>
                                                </td>
                                            </tr> 

                                            <tr>
                                                <td  class="new_forName " >&nbsp;</td>
                                                <td  class="new_forName grayText">  
                                                    <table width="100%" border="0" cellspacing="3" cellpadding="3" >
                                                        <tr>
                                                            <td width="25%"> <?php  if($holder_id!=$commentData['Comment']['holder_id']) {  ?>
                                                             <span class="flx_button_lft " id="replycomment_<?php echo $commentData['Comment']['id']?>_0">
                                                                <?php echo $form->button('Reply', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                                                             </span>   
                                                              <?php }  ?></td> 
                                                            <td width="35%"><?php  if($holder_id!=$commentData['Comment']['holder_id']) {  ?>
                                                                    By: <span class="orangeTextBold"><?php echo $commentData['Holder']['screenname'];  ?></span>
                                                             <?php } ?></td>
                                                            <td width="20%" align="right">
                                                            <?php  if($commentData['Comment']['coin_holder_id']!=0) {  ?>
                                                            Coin: <span class="orangeTextBold"><?php echo $commentData['CoinHolder']['coin'];  ?></span>
                                                            <?php } ?></td>
                                                            <td width="20%" align="right">
                                                             <?php // echo $this->Common->date_differ($commentData['Comment']['created'], $commentData[0]['currentdate']);
                                                             
                                                             echo $common->dateDiffer($commentData['Comment']['created'], $commentData[0]['currentdate']); ?>
                                                             </td>
                                                        </tr>     
                                                    </table>
                                                      <div id="replyto_<?php echo $commentData['Comment']['id']?>_0" style="display: none;"> 
                                                      <br/>
                                                                <form action="/companies/save_comment_reply" id="replyform_<?php echo $commentData['Comment']['id'];?>_0" name="replyform_<?php echo $commentData['Comment']['id']?>_0" method="post">
                                                                <input type="hidden" name="comment_id" value="<?php echo $commentData['Comment']['id'];?>" />
                                                                <input type="hidden" name="reply_id" value="0" />
                                                                <input type="hidden" name="coin_holder_id" value="<?php echo $commentData['Comment']['coin_holder_id'];?>" />
                                                                <input type="hidden" name="comment_type_id" value="<?php echo $commentData['Comment']['comment_type_id'];?>" />
                                                                
                                                              <span class="txtArea_top" style="margin-bottom: 8px;">   <span class="txtArea_bot"> 
                                                                 <textarea cols="35" rows="3" name="reply" id="reply_<?php echo $commentData['Comment']['id']?>"  class="replybox noBg border_shadow" style="border: none;">Reply to comment...</textarea>  
                                                              </span>
                                                              </span>
                                                              <br/>
                                                              <span class="flx_button_lft marginRight4px" id="savereply_<?php echo $commentData['Comment']['id']?>_0">
                                                                <?php echo $form->button('Save', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                                                             </span>  &nbsp; 
                                                             <span class="flx_button_lft marginRight4px" id="cancelreply_<?php echo $commentData['Comment']['id']?>_0">
                                                                <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                                                             </span>
                                                              </form>
                                                        </div>
                                                </td>
                                            </tr> 
                                                                                                                               
                                            <?php 
                                                 echo $this->element('view_registeredcoin_commentreplies', array("coinholderid" => $commentData['Comment']['coin_holder_id'], 
                                                 "comment_id" => $commentData['Comment']['id'],
                                                 "reply_id" => 0 )); 
                                            ?>
                                            
                                             <tr><td colspan="2" class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr> 
                                            <?php //echo $this->element('view_registeredcoin_commentreplies', array("comment_id" => $commentData['Comment']['id']));  ?>
                                             


                                            <?php } }?>
                                      </table>

<script type="text/javascript" language="javascript">



/* $(document).ready(function() {    

    $("a[id^='plzcomment_']").dblclick(function(){

  
  var $this = $(this);
  var idarr = $this.attr('id').split('_');
 
  var commentbox="addcomment_"+idarr[1]+"_"+idarr[2];
   var default_comment = $("#comment_purpose_"+idarr[1]+"_"+idarr[2]).val();

   $("#comment_"+idarr[1]+"_"+idarr[2]).val(default_comment);
   $this.hide();
   $("#"+commentbox).show();
});

 $("input[id^='cancelcomment_']").click(function(){ 
      var $this = $(this);
      var idarr = $this.attr('id').split('_');
      var commentbox=idarr[1]+"_"+idarr[2];
      $("#comment_"+idarr[1]+"_"+idarr[2]).val(''); 
      $("#addcomment_"+commentbox).hide();
       $("#plzcomment_"+commentbox).show();   

 });  


}); */
</script>