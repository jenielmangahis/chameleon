<?php echo  $form->create('temp_pass',array('action'=>'/companies/temporary_password','id'=>'temp_pass','url'=>$this->here,'onsubmit' => 'return forgotpvalidateemail("add");'));?>

<div class="boxBg1">
  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  

  <div class="boxPad">
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Reset Your Password</font>
    
    
  <div style="float:right;">&nbsp;&nbsp;&nbsp;<span class="flx_button_lft">
     <?php echo $form->submit('Save', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
     </span>
     <?php // echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/'.$project_name.'"'));?>
    </div>
    
    
    <br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
&nbsp;&nbsp;&nbsp;Your temporary password was sent to your email,enter it below , then enter your new password.<br /><br />

<div style="float:left; width: auto;height:auto !important;height:200px;min-height:200px;">

     <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div><div class="clear"></div>
        



<table border="0" width="100%">
<tr>
<td colspan="2">&nbsp;</td>
</tr>



<tr>
<td colspan="2">&nbsp;</td>
</tr>

<tr>
<td widht="60%">
<div class="updat">
<label class='boldlabel'>Temporary Password</label><span style="color: red;">*</span>
</div>
<span class="intpSpan">
<?php echo $form->input('cur_pass',array('label'=>false,'div'=>false,'type'=>"password",'id'=>"cur_pass",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
</span>
</td>
<td widht="40%">
<div class="updat1">
<label class='boldlabel'>New Password</label><span style="color: red;">*</span>
</div>
<span class="intpSpan">
<?php echo $form->input('new_pass',array('label'=>false,'div'=>false,'type'=>"password",'id'=>"new_pass",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
</span>
</td>
</tr>

<tr>
<td widht="40%">
&nbsp;
</td>
<td widht="50%">
<div class="updat1">
<label class='boldlabel'>Confirm Password</label><span style="color: red;">*</span>
</div>
<span class="intpSpan">
<?php echo $form->input('confirm_pass',array('label'=>false,'div'=>false,'type'=>"password",'id'=>"confirm_pass",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
</span>
</td>
</tr>

<tr>
<td><br /><br /><br /><span class="red">*</span><b>Required Field</b>    </td>
</tr>

</table>

</div>
   
  </div>
  </div><p class="boxBot1">
  <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

      <?php echo $form->end();?>