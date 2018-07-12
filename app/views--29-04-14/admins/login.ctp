<?php ?><div id="container">

<div class="info">
	<h2>
	<?php
	e(	
		$html->image('register_icon.gif',array('style'=>'float:left'))
	);
	?>
	&nbsp;&nbsp;<?php echo SITENAME; ?> Site Administrator Login</h2>
</div>
<b>Any item with a  "<span style="color:red">*</span>"  requires an entry.</b>

<?php echo $form->create("Admin", array("action" => "login",'id' => "adminlogin",'name' => "adminlogin",'class' => "wufoo  page",'onsubmit' => 'return validatelogin();'))?>

<ul>

	<?php 
	$uerror = $form->error('Admin.username', 'Username is required', array('class' => 'errormsg'));
	if($session->check('Message.flash') || $uerror != '') {
		/*    SERVER SIDE VALIDATION MESSAGES */
		echo "<li>";
		$session->flash();
		if($uerror)
		echo $uerror;
		else
		echo $form->error('Admin.password', array('password-1' => __('Password is required', true)), array('class' => 'errormsg', 'div' => ''));
		echo "</li>";
		/* END  SERVER SIDE VALIDATION MESSAGES */
	} 
	?>		

	<li id="foli1" class="    ">
		<label class="desc" id="title1">Username<span class="req">*</span>
			</label>
		<div>
			<?php echo $form->input("username", array('id' => 'Field1', 'div' => false, 'label' => false,"class" => "field text large", "tabindex" => "1"));?>
		</div>
		<p class="instruct" id="instruct1"><small>This field is required.</small></p>
	</li>
	<li id="foli2" class="">
	<label class="desc" id="title2">Password<span id="req_1" class="req">*</span></label>
	<div>
		<?php echo $form->input("password", array('id' => 'Field2', 'div' => false, 'label' => false, 'type' => 'password', "class" => "field text large", "tabindex" => "2")); ?>
	</div>
		<p class="instruct" id="instruct2"><small>This field is required.</small></p>
	</li>
	
<li class="">
	<button type="submit" id="saveForm" class="button">  Login </button>
	<button type="button" class="button" onclick="document.adminlogin.reset();"> Reset </button>
	<button type="button" class="button" onclick="window.location.href='../admins/forgotpassword/';"> Forgot Password </button>
	</li>
</ul>
 <?php echo $form->end();?>

</div><!--container-->

<!--<img id="bottom" src="/img/bottom.png" alt="" />-->
