<!-- Body Panel starts -->

<style type="text/css">
.forName{ padding:3px 5px; }
</style>

  <div class="navigation">
  <div class="boxBg">
  <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p> -->
  <div class="boxBor">
  <div class="boxPad">
  <?php echo $this->element("leftmenubar");?>  

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
 <!--<?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>-->
  
  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg1">
  <!--<p class="boxTop1"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
  <div class="boxBor1">
  <div class="boxPad" style="width: 717px;">


    <h2>Comments - <?php echo $coinserno; ?></h2>
<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
      <div style="border:1px solid #bdbcbd;">
     
    <p class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="forName frmTitles" style="width:90px">Comment Type</td>
	<td class="forName frmTitles" style="width:190px">Comments</td>
    <td class="forName frmTitles" style="width:120px">Date</td>
	<!--<td class="forName frmTitles" style="width:10%">Status</td>-->
    <td class="forName frmTitles" style="width:85px">Share</td>    
	<td class="forName frmTitles" style="width:20px">Edit</td>  
</tr>
<?php
if(sizeof($commentArray)==0){
?>
 <tr><td colspan="4" class="forName" align='center'>No comment found.</td></tr>

<?php	}else {
foreach($commentArray as $convalue){
	$commentType = $convalue['CommentType']['comment_type_name'];
	$comment = $convalue['Comment']['comment'];
/*if($comment)	$commentnew = AppController::WordLimiter($comment,40);*/

?>
<tr><!--forDate-->
	<!--<td class="forName" style=""><?php 	
		//echo  $convalue['CoinsHolder']['serialnum'];
		//echo $convalue['CommentType']['comment_type_name'];
		?>
	</td>-->

<td class="forName" style="">
		<?php echo $commentType?$commentType:"N/A";?>
	</td>

	<td class="forName" style="">
<?php //$commentnew1 = wordwrap($commentnew, 25, "<br/>"); ?>
		<!--<textarea style="width: 407px; height: 57px; width:300px" ROWS="10" COLS="25" readonly="readonly" >--><?php echo $comment?$comment:"N/A";?><!--</textarea>-->
	</td>
		 <td class="forName" style="width:17%"><?php 
		echo  AppController::usdateformat1($convalue['Comment']['created'],1) ;?></td>
		<!--<td class="forName" style="width:10%"><?php if($convalue['Comment']['active_status']=="1") echo "Verified"; else echo  "Not Verified";?></td>-->
	<td class="forName" style="">
		
		&nbsp;&nbsp;&nbsp;<span  class='st_sharethis' displayText='ShareThis'></span> 
	</td>
	<td class="forName" style="">
		<?php if($convalue['Comment']['locked']=="0" ) { if($convalue['CoinsHolder']['is_current_holder']=="1") {?><a href="/companies/update_comments/<?php echo $convalue['Comment']['id'];?>">Edit</a><?php } }?> 
	</td>
</tr>
 <tr><td colspan="5" class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr>
<?php }
}?>
 
</table>

    <p class="clear"></p>
    </div>

  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 
<script language='javascript'>
function showcontentwindow(comment_id,coin_holder_id){

	var url = '/companies/showcomment/'+comment_id;			
		jQuery.facebox({ ajax: url });
}
</script>
