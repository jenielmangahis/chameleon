<div id="container">

<div class="info">
	<h2>
	<?php
	e(	
		$html->image('register_icon.gif',array('border'=>'0','style'=>'float:left'))
	);
	?>
	&nbsp;&nbsp;Forgot Password</h2>
	 <div>
			
			
	</div>
</div>
<b>Any item with a  "<span style="color:red">*</span>"  requires an entry.</b>
<?php echo $form->create("Admin", array("action" => "forgotpassword", "onsubmit" => "return  checkadminpasswordform();", 'name' => 'adminpassword','class' => "wufoo  page"))?>
<ul>
<li>
<p><?php if($session->check('Message.flash')) $session->flash();
		/*    SERVER SIDE VALIDATION MESSAGES */
		
		echo $form->error('Admin.email', 'Email is required', array('class' => 'errormsg'));
		

		/* END  SERVER SIDE VALIDATION MESSAGES */
		
	 ?></p>
</li>
	<li id="foli1" class="    ">
		<label class="desc" id="title1" for="username">Email<span id="req_1" class="req">*</span>
			</label>
		<div>
		
			<?php echo $form->input("email", array('id' => 'Field1', 'div' => false, 'label' => '',"class" => "field text large", "tabindex" => "1"))?>	
		</div>
		<p class="instruct" id="instruct1"><small>This field is required.</small></p>
	</li>
	
	
<li class="">
	<button type="submit" id="saveForm" class="button"> Submit </button>
	<button type="button" id="saveForm" class="button" onclick="history.go(-1);"> Back </button>
	
	</li>

</ul>
 <?php echo $form->end();?>
</div><!--container-->
<!--<img id="bottom" src="/img/bottom.png" alt="" />-->
