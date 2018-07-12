
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
    <h2>Send Coin Transfer Request</h2>
<b>Any item with a</b>"<span class="red">*</span>"<b>requires an entry.</b> 
<div style="margin: 0pt auto; width: 360px;">
     <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
<?php echo  $form->create('Coinset',array('action'=>'/companies/transfer_request','id'=>'','url'=>$this->here,'onsubmit' => 'return validatecoinserial("add");'));?>

<p>&nbsp;</p>  

<div><lable class='lbl'>Coin Serial #:<span class="red">*</span></lable> <?php echo $form->input('coinserial',array('label'=>'','div'=>false,'type'=>"text", 'id'=>"coinserial",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?></div>
<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<div><lable class='lbl'>Verification Code:<span class="red">*</span></lable> <?php echo $form->input('code',array('label'=>'','div'=>false,'type'=>"text", 'id'=>"code",'size'=>'40','maxlength'=>'3', 'class'=>'inptBox' )) ?></div>
<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<div><lable class='lbl'>Message:</lable> <?php echo $form->textarea("message", array('id' => 'message', 'div' => false, 'label' => '','cols' => '25', 'rows' => '4', 'class'=>'top','style'=>'border:1px solid #BEDAE5;'));?></div>
<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<div><lable style="width:150px; margin-right:5px;display:inline-block;">&nbsp;</lable> <?php echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?> 
</div>
	<?php echo $form->end();?>
</div>
  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 


