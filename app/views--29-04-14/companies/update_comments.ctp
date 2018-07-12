<?php ?>
 <!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">

  <div class="boxBor">
  <div class="boxPad">
  <?php echo $this->element("leftmenubar");?>  

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
 <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
  </div>
  <div class="bdyCont1">
  <div class="boxBg1">
  <p class="boxTop1"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    <h2>Update Comments</h2>
     <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
<?php echo  $form->create('Coinset',array('action'=>'/companies/update_comments','id'=>'','url'=>$this->here,'onsubmit' => 'return validatecomment("add");'));?>

<?php echo $form->input('coin_holder_id',array('value'=>$coin_holder_id,'type'=>"hidden"  )) ?>
<?php echo $form->input('comment_id',array('value'=>$comment_id,'type'=>"hidden" )) ?>
 
<b> <span style="color:red">* </span>Required Field.</b>
<?php if($maxnumbercomment>1) {?>
<br><div><br><lable class='lbl' style="font-family: status-bar;width:178px">Comment Type:</lable> <?php echo $commenttypename; ?><br></div>

<?php if($commenttypepurpose!=""){?>
<div><lable class='lbl' style="font-family: status-bar;width:178px">Comment Type Purpose:</lable> <?php echo $commenttypepurpose; ?><br></div>

<?php }?>
<?php }?>
<?php if($project['ProjectType']['is_rsvp']==1) {
if($commenttypename!="Misc. Additional Comment"){
?>
<div><br><lable class='lbl' style="font-family: status-bar;width:178px">Are you going to attend this event?:</lable> <?php  if($rsvp==1) echo "Yes"; else echo "No"; ?></div>

<?php }}?>
<br/><br/>
<div><lable class='lbl' style="font-family: status-bar;width:178px">Comment: <span style="color:red">*</span></lable><br/><br/> <?php echo $form->textarea("comments", array('id' => 'comments', 'div' => false, 'label' => '','cols' => '50', 'rows' => '4', 'class'=>'top','style'=>'border: 1px solid rgb(190, 218, 229);','value'=>$comment));?></div>
<div class="clear"></div><br>
<div style="margin-left:200px;"> <?php echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?>&nbsp; <?php  echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/companies/view_comments/'.$coin_holder_id.'"'));?>
</div>
	<?php echo $form->end();?>
  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 


