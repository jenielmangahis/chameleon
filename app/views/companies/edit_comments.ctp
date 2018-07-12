
<!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project['Project']['project_name'].'/rhtBox_top.gif', array('class'=>'right'));?> </p>
  <div class="boxBor">
  <div class="boxPad">
<ul>
<li><a href="/companies/register_coin" ><span>Register coin</span></a></li>
<li><a href="/companies/update_profile" >Update Profile</a></li>
<li><a href="/companies/change_password" >Change Password</a></li>
<li><a href="/companies/view_registeredcoins"><span>View Registered coins</span></a></li>
<li><a href="/companies/logout"><span>Logout</span></a></li>
<li>&nbsp;</li>
<li>&nbsp;</li>
</ul>

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
 <?php //echo $html->image('/img/'.$project['Project']['project_name'].'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg1">
  <p class="boxTop1"><?php echo $html->image('/img/'.$project['Project']['project_name'].'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    <h2>Add Comments</h2>
<b>Any item with a</b>"<span class="red">*</span>"<b>requires an entry.</b>  
     <?php
		    if($session->check('Message.error')||$session->check('Message.success')){
		    ?>
			<!-- div for error message start--> 
		    <div class="msgdiv" align="center">                 
		    <?php
		    if($session->check('Message.error')){
		    ?>
		    <div class="msgcontainer error left" style="min-width:345px;margin-left:175px">        
		    <?php   
			    echo $html->image('exclam.gif');
			    $session->flash('error');                      
		    ?>       
		    <div class="clear"></div>
		    </div>
		    <?php
		    }
		    ?>
		    </div>
		    <!-- div for error message end--> 
    
		    <!-- div for success message start--> 
		    <div class="msgdiv" align="center">                 
		    <?php
		    if($session->check('Message.success')){
		    ?>
		    <div class="msgcontainer success left" style="min-width:345px;margin-left:175px">        
		    <?php   
			    echo $html->image('success.gif');
			    $session->flash('success');                      
		    ?>       
		    <div class="clear"></div>
		    </div>
		    <?php
		    }
		    ?>
		    </div><br /><br />	
		<?php }?>
<?php echo  $form->create('Coinset',array('action'=>'/companies/add_comments','id'=>'','url'=>$this->here,'onsubmit' => 'return validatecomment("add");'));?>
<?php echo $form->input('coinset',array('value'=>$coinset,'type'=>"hidden"  )) ?>
<?php echo $form->input('coin_id',array('value'=>$coin_id,'type'=>"hidden"  )) ?>
<?php echo $form->input('comment_id',array('value'=>$comment_id,'type'=>"hidden" )) ?>
<p>&nbsp;</p>  

<div><lable class='lbl'>Coin Serial Number:</lable> <?php echo $form->input('coinserial',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"coinserial",'value'=>$coinserial,'readonly'=>'readonly', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Comments:<span class="red">*</span></lable> <?php echo $form->textarea("comments", array('id' => 'comments', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4', 'class'=>'inptBox','value'=>$comment));?></div>
<div class="clear">&nbsp;</div>
<div><lable style="width:150px; margin-right:5px;display:inline-block;">&nbsp;</lable> <?php echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?> 
</div>
	<?php echo $form->end();?>
  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project['Project']['project_name'].'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 


