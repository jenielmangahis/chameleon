<?php  echo $this->element("admin_css"); ?>
<span class="flx_button_lft">
<?php  echo $form->button('Back', array('type'=>'Button','div'=>false,"class"=>"flx_flexible_btn",'onclick'=>'window.location="/companies/comments"')); ?>
</span>

<div style="margin-left: 20px; margin-top: 10px" >
<p class="srNo">
Coin Serial : <?php echo $coin_serial; ?>
</p>
</div>

<div style="margin-top: 15px;">

<table width="100%" border="0" cellspacing="5" cellpadding="5">        
<tr>
<td><b>Holders:</b></th>
<td>Comments</th>
</tr>

<?php
    if(!empty($coin_holder_ids))
    {
            foreach($coin_holder_ids as $coin_holder_id)
            {
            App::import("Model", "Holder");
            $this->Holder =   & new Holder();
            
            $condition = "Holder.project_id='".$project_id."' and Holder.id='". $coin_holder_id."' and  Holder.delete_status='0'";
            $holder_details = $this->Holder->find('first', array('conditions' => $condition));            
            
            $holder_name=$holder_details['Holder']['screenname'];
?>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp; 1. <?php echo $holder_name;?></td>
<td align="left"><?php
    if(!empty($comment_details))
        echo"<img src='/img/active.gif' alt=''>";
?></td>
</tr>
<?php
            }
    }
    else
    {
        ?>
        <tr>
        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No Holder(s) Found</b></td>
        </tr>
        <?php
    }
?>

</table>
<?php
if(!empty($coin_holder_ids))
{
        ?>
(Click on Holder to view Comments and Replies)
<?php
}
    ?>

</div>
<br />
<hr style="background-color: black; width: auto; height: 1px;">

<div id="comments_replies_div">

<?php
if(!empty($coin_holder_ids))
{ ?>
<div style="margin-left: 10px;"><b>Comments</b></div>
<?php
}
?>


<?php
if(!empty($comment_details))
{
    foreach($comment_details as $comment_detail)
    {
        if($comment_detail['Comment']['comment_type_id']==0)
            $comment_type_name="Misc.Additional Comment";
        else
            $comment_type_name=AppController::getcommenttypename($comment_detail['Comment']['comment_type_id']); 
        
        App::import("Model", "CommentReply");
        $this->CommentReply =   & new CommentReply();
       
        $condition = "CommentReply.project_id='".$project_id."' and CommentReply.comment_id='". $comment_detail['Comment']['id']."'";
        $reply_details = $this->CommentReply->find('all', array('conditions' => $condition));            

        
        ?>
        <span class="postedby">Posted by:</span> <?php echo  $holder_name;    ?><br />
        <!--<span class="dateSpn"><?php // echo AppController::usdateformat($comment_detail['Comment']['created'],1)  ; ?></span>-->
        <span class="dateSpn"><?php echo $comment_type_name; ?></span>
        <div class="commtBox">
            <p><?php echo $comment_detail['Comment']['comment']; ?></p>
            
        <br /><b>Replies</b><br />
        
        <?php
            if(!empty($reply_details))
            {
                foreach($reply_details as $reply_detail)
                {
                    
                    ?>
                    <span class="postedby">Posted by:</span> <?php echo  $holder_name;    ?><br />
                    <p><?php echo $reply_detail['CommentReply']['reply']; ?></p>
                    
                    <?php
                }
            }
            else
            {
                echo"No Replies";
            }
            ?>
        </div>
        <?php

    }
}
else
{
    if(!empty($coin_holder_ids))
    echo"No Comments";
}
    
?>

</div>