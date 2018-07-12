
<div class="boxBg1">
  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
       <div class="boxPad">
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Reset Your Password</font><br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
&nbsp;&nbsp;&nbsp;Enter Your email address and we will mail you a link to reset your password.<br /><br />
<div style="float:left;margin: 0pt auto; width: 360px;height:auto !important;height:200px;min-height:200px;">
     <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div><div class="clear"></div>
        
<?php echo  $form->create('User',array('action'=>'/companies/forgot_password','id'=>'SignupForm','url'=>$this->here,'onsubmit' => 'return forgotpvalidateemail("add");'));?>


 
<div>
    <label class="boldlabel">&nbsp;&nbsp;&nbsp;Email Address </label>
</div><br />
&nbsp;&nbsp;
    <span class="intpSpan"> 
    <?php echo $form->input('email',array('id'=>'email','label'=>'','div'=>false,'type'=>"text", 'size'=>'40','maxlength'=>'150' , 'class'=>'inptBox')) ?></span> <span style="color:red">
    </span>



<div>&nbsp;&nbsp;&nbsp;<span class="flx_button_lft">
 <?php echo $form->submit('Submit', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
 </span>
 <?php // echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/'.$project_name.'"'));?>
</div>

    <?php echo $form->end();?>
</div>
    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
  <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
