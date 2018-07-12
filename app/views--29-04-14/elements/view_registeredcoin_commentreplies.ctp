
<?php 
    // $coinholderid=62;     
  //   DebugBreak();
    $commentid=$comment_id;    
    $coinholderArray=  $this->requestAction('/companies/get_coindetails/'.$coinholderid);    
    $commentReplyArray = $this->requestAction('/companies/view_registeredcoin_commentreplies/'.$coinholderid.'/'.$comment_id."/".$reply_id);
    $serialnum = $coinholderArray['CoinsHolder']['serialnum'];
    if(preg_match('/[A-Z]{3}/', $serialnum)==1){
        $coinsname= preg_split('/[A-Z]{3}/', $serialnum);
        $serialnum=$coinsname[1];
    }   $cnt=0; 
     foreach($commentReplyArray as $commentreply){   
        $reply_id= $commentreply['CommentReply']['id'];
        $reply= $commentreply['CommentReply']['reply'];
       if($cnt==1){ ?>
        <tr>  <td></td> <td  class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr>    
      <?php }else{ $cnt=1; }     ?>
      <tr>
        <td  class="forName " >&nbsp;</td>
        <td class="forName "> 
            <strong>Reply</strong> <br/>
           <span class="grayText"> <?php echo $reply; ?></span>
        </td>
    </tr>
    <tr>
        <td  class="forName " >&nbsp;</td>
        <td  class="forName grayText">  
            <table width="100%" border="" cellspacing="3" cellpadding="3" >
                <tr>
                    <td width="25%">  <?php  if($holder_id!=$commentreply['CommentReply']['holder_id']) {  ?>
                            <span class="flx_button_lft " id="replycomment_<?php echo $commentreply['CommentReply']['comment_id']; ?>_<?php echo $commentreply['CommentReply']['id'];?>">
                                <?php echo $form->button('Reply', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                            </span>   
                        <?php } ?></td> 
                    <td width="35%"><?php  if($holder_id!=$commentreply['CommentReply']['holder_id']) {  ?>
                            By: <span class="orangeTextBold"><?php echo $commentreply['Holder']['screenname'];  ?></span>
                        <?php } ?></td>
                    <td width="20%" align="right">
                    <?php  if($commentreply['CommentReply']['coin_holder_id']!=0) {  ?>
                    Coin: <span class="orangeTextBold"><?php echo $serialnum;  ?></span>
                     <?php } ?></td>
                    <td width="20%" align="right"><?php  echo $common->dateDiffer($commentreply['CommentReply']['created'], $commentreply[0]['currentdate']); 
                    //echo date("Y-m-d", strtotime($commentreply['CommentReply']['created']));  ?></td>
                </tr>     
            </table>
            <div id="replyto_<?php echo $commentreply['CommentReply']['comment_id']?>_<?php echo $commentreply['CommentReply']['id'];?>" style="display: none;"> 
                <br/>
                <form action="/companies/save_comment_reply" id="replyform_<?php echo $commentreply['CommentReply']['comment_id'];?>_<?php echo $commentreply['CommentReply']['id'];?>" name="replyform_<?php echo $commentreply['CommentReply']['comment_id']?>_<?php echo $commentreply['CommentReply']['id'];?>" method="post">
                    <input type="hidden" name="comment_id" value="<?php echo $commentreply['CommentReply']['comment_id'];?>" />
                    <input type="hidden" name="reply_id" value="<?php echo $commentreply['CommentReply']['id'];?>" />
                    <input type="hidden" name="coin_holder_id" value="<?php echo $commentreply['CommentReply']['coin_holder_id'];?>" />
                    <input type="hidden" name="comment_type_id" value="<?php echo $commentreply['CommentReply']['comment_type_id'];?>" />

                    <span class="txtArea_top">   <span class="txtArea_bot"> 
                            <textarea cols="45" rows="3" name="reply" id="reply"  class="noBg border_shadow" style="border: none;"></textarea>  
                        </span>
                    </span>
                    <br/>
                    <span class="flx_button_lft " id="savereply_<?php echo $commentreply['CommentReply']['comment_id'];?>_<?php echo $commentreply['CommentReply']['id'];?>">
                        <?php echo $form->button('Save', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                    </span>  &nbsp; 
                    <span class="flx_button_lft " id="cancelreply_<?php echo $commentreply['CommentReply']['comment_id'];?>_<?php echo $commentreply['CommentReply']['id'];?>">
                        <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                    </span>
                </form>
            </div>
        </td>
    </tr> 
      
    <?php 
      $comm_reply_id=$commentreply['CommentReply']['id'];
      $commentReplyReplyArray = $this->requestAction('/companies/view_registeredcoin_commentreplies/'.$coinholderid.'/'.$comment_id."/".$comm_reply_id); 
         foreach($commentReplyReplyArray as $replyreply){   
        $reply_reply_id= $replyreply['CommentReply']['id'];
        $reply_reply= $replyreply['CommentReply']['reply'];

    ?>
     <tr>  <td ></td> <td   class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr>  
    <tr>
        <td  class="forName " >&nbsp;</td>
        <td class="forName "> 
         <!--   <strong>Reply</strong> <br/> -->
            <span class="grayText"><?php echo $reply_reply; ?> </span>
        </td>
    </tr>
       <tr>
        <td  class="forName " >&nbsp;</td>
        <td  class="forName grayText">  
            <table width="100%" border="" cellspacing="3" cellpadding="3" >
                <tr>
                    <td width="25%">&nbsp;</td> 
                    <td width="35%"><?php  if($holder_id!=$replyreply['CommentReply']['holder_id']) {  ?>
                            By: <span class="orangeTextBold"><?php echo $replyreply['Holder']['screenname'];  ?></span>
                        <?php } ?></td>
                    <td width="20%" align="right">
                       <?php  if($replyreply['CommentReply']['coin_holder_id']!=0) {  ?>
                       Coin: <span class="orangeTextBold"><?php echo $serialnum;  ?></span>
                       <?php  } ?></td>
                    <td width="20%" align="right"><?php //echo date("Y-m-d", strtotime($replyreply['CommentReply']['created'])); 
                     echo $common->dateDiffer($replyreply['CommentReply']['created'], $replyreply[0]['currentdate']);
                     ?></td>
                </tr>     
            </table>   
        </td>
    </tr> 
  
    <?php } 
    
     }?>
<!-- </table>   -->
<script type="text/javascript" language="javascript">
    /*$(document).ready(function() {    

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


    });   */
</script>