<?php //echo"<pre>";print_r($userArray);
$pwd=$userArray['User']['password'];
?>

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
  <div class="bdyCont">
  <div class="boxBg1">

  <div class="boxBor1">
  <div class="boxPad">
    <h2>Change Password</h2>
<b>Any item with a</b>"<span class="red">*</span>"<b>requires an entry.</b>


<div style="margin: 0pt auto; width: 360px;">
<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>

     
<?php echo  $form->create('User',array('action'=>'/companies/changeuserpassword','id'=>'','url'=>$this->here,));?>

<p>&nbsp;</p>  
<br/><br/>
<?php if($pwd==md5('')) {?>
<div><lable class='lbl'>Set New Password<span class="red">*</span></lable> <?php echo $form->input('setpassword',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"setpassword",'size'=>'40','maxlength'=>'20', 'class'=>'inptBox')) ?></div>
<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>

<div><lable class='lbl'>Confirm Password:<span class="red">*</span></lable> <?php echo $form->input('confirm_password',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"confirm_password",'size'=>'40','maxlength'=>'20', 'class'=>'inptBox' )) ?></div>



<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>



<?php }else{?>
<div><lable class='lbl'>Old Password:<span class="red">*</span></lable> <?php echo $form->input('oldpassword',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"oldpassword",'size'=>'40','maxlength'=>'20', 'class'=>'inptBox','onblur'=>'hidemessage()' )) ?></div>
<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>

<div><lable class='lbl'>New Password:<span class="red">*</span></lable> <?php echo $form->input('setpassword',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"setpassword",'size'=>'40','maxlength'=>'20', 'class'=>'inptBox','value'=>'' )) ?></div>

<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>

<div><lable class='lbl'>Confirm Password:<span class="red">*</span></lable> <?php echo $form->input('confirm_password',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"confirm_password",'size'=>'40','maxlength'=>'20', 'class'=>'inptBox' )) ?></div>

<?php }?>

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

<script language='javascript'>
function hidemessage(){
if(document.getElementById("flashMessage")!=null)
document.getElementById("flashMessage").style.display="none";

}
</script>




