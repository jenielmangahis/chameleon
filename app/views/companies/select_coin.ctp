<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p>
  <div class="boxBor">
  <div class="boxPad">
  <?php echo $this->element("leftmenubar");?>  

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
 <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg1">
  <p class="boxTop1"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">

    <h2>Please click on serial</h2>
<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
      <div style="border:1px solid #bdbcbd;">
     
    <p class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="forName frmTitles" >Serial</td>     
  </tr>
<?php
if(sizeof($coinholderArray)==0){
?>
 <tr><td  class="forName" align=center>Please register coin for adding comments.</td></tr>

<?php	}else {
foreach($coinholderArray as $convalue){

		$requestdisplay="";
		$commentdisplay="";


		App::import("Model", "Comment");
      		$this->Comment =   & new Comment();
		$commentdisplay=" ";
		$condition = "Comment.coin_holder_id = '".$convalue['CoinsHolder']['id']."' and  Comment.project_id='".$project_id."' ";
		$commentcount = $this->Comment->find('count', array('conditions' => $condition,'fields'=>'id'));
		if($commentcount>0)
		$commentdisplay="yes";


		App::import("Model", "CoinTransferRequest");
      		$this->CoinTransferRequest =   & new CoinTransferRequest();

		$condition1 = "CoinTransferRequest.serialnum  = '".$convalue['CoinsHolder']['serialnum']."' and  CoinTransferRequest.project_id='".$project_id."' and  CoinTransferRequest.to_holder_id='".$holder_id."'  and CoinTransferRequest.request_status='0'  and CoinTransferRequest.active_status='1' and CoinTransferRequest.delete_status='0'";
		$cointranferrequest = $this->CoinTransferRequest->find('first', array('conditions' => $condition1));
		if(!empty($cointranferrequest))  $requestdisplay="yes";

 if($convalue['CoinsHolder']['is_current_holder']=="1") { 

if($project['ProjectType']['additional_comment']=="0"){
if($project['ProjectType']['maxnumbercomment']> $commentcount){ ?>
  <tr> 
    <td class="forDate" ><a href="/companies/add_comments/<?php echo $convalue['CoinsHolder']['id'];?>"><?php echo $convalue['CoinsHolder']['serialnum']; ?></a> </td>    
  </tr>
 <tr><td  class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr>
<?php }   } else{?>
  <tr> 
    <td class="forDate" ><a href="/companies/add_comments/<?php echo $convalue['CoinsHolder']['id'];?>"><?php echo $convalue['CoinsHolder']['serialnum']; ?></a> </td>    
  </tr>
 <tr><td  class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr>
<?php
}
 }}
}?>
 
</table>
    <p class="clear"></p>
    </div>
<p><?php if(sizeof($coinholderArray)>0) echo $this->renderElement('pagination');?></p>   
  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 

<script language='javascript'>
	function showrequestwindow(holder_id,project_id,coin_serial){
		var url = '/companies/show_request/'+holder_id+'/'+project_id+'/'+coin_serial;			
			jQuery.facebox({ ajax: url });
	}
function closewindow(){
 jQuery(document).trigger('close.facebox');
}
	

</script>
