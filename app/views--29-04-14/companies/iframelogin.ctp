<div class="boxBg" align="center">
 			<?php		
			$site_logoutUrl='/companies/logout/';
		?>
			
				

	<div class="boxBor">
		<div class="boxPad">
			<h2 style="margin-left:-30px;"><?php  echo $project['Project']['system_name']; ?>- Login</h2>
			<div style="margin: 0pt auto; width: auto;height:auto !important;height:200px;min-height:200px;">
				<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
				<?php echo  $form->create('User',array('action'=>'/companies/iframelogin'/$frid/$prname,'id'=>'SignupForm','url'=>$this->here ,'onsubmit' => 'return validatelogin("add");'));?>
				
				<p>&nbsp;</p> 
                
                <label class="frmLbls frmLbl2">Email <span style="color:red">*</span></label>
             <span class="intpSpan"><?php echo $form->input('username',array('label'=>false,'id'=>'username','div'=>false,'type'=>"text", 'size'=>'40','maxlength'=>'150' , 'class'=>'inptBox')) ?></span><span style="color:red"></span>
             <br />    
             
             
             <label class="frmLbls frmLbl2">Password  <span style="color:red">*</span></label> 
             <span class="intpSpan"> <?php echo $form->input('password',array('label'=>false,'div'=>false,'type'=>"password", 'id'=>"password",'size'=>'40', 'class'=>'inptBox' )) ?></span>
             <br/>
             
             <label class="frmLbls frmLbl2">&nbsp;  </label>
             <span>
                 <span class="flx_button_lft ">
                 <?php echo $form->submit('Login', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
                 </span>
                 
             </span>
                
				<!--<div style="width:150px; clear:right; float:left; padding-right:5px;">Username/Email:<span style="color:red">*</span></div>
				<div style="width:200px; clear:right; float:left"> <span class="intpSpan"><?php // echo $form->input('username',array('label'=>false,'id'=>'username','div'=>false,'type'=>"text", 'size'=>'40','maxlength'=>'150' , 'class'=>'inptBox')) ?><span style="color:red"></span></span></div>-->
                
				<!--<div class="clear"> <?php //echo $html->image('/img/'.$project_name.'/spacer.gif', array('height'=>'12','width'=>'1'));?></div>-->
                
				<!--<div style="width:150px; clear:right; float:left; padding-right:5px;">Password:<span style="color:red">*</span></div>
				<div style="width:200px; clear:right; float:left"> <span class="intpSpan"> <?php //echo $form->input('password',array('label'=>false,'div'=>false,'type'=>"password", 'id'=>"password",'size'=>'40', 'class'=>'inptBox' )) ?></span></div>-->
                
				<div class="clear"> <?php echo $html->image('/img/'.$project_name.'/spacer.gif', array('height'=>'12','width'=>'1'));?></div>
                
				<!--<div style="width:150px; clear:right; float:left; padding-right:5px;">&nbsp;</div>
				<div style="width:200px; clear:right; float:left"><a href="/companies/forgot_password"><span>Forgot Password?</span></a></div>-->
                
				<div class="clear"> <?php echo $html->image('/img/'.$project_name.'/spacer.gif', array('height'=>'12','width'=>'1'));?></div>
                
				<!--<div style="width:150px; clear:right; float:left; padding-right:5px;">&nbsp;</div>
                
				<div style="width:200px; clear:right; float:left"> <?php // echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?> <?php  //echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/'.$project_name.'"'));?></div>-->
                
				
				<?php echo $form->end();?>
                <span style="color:red">*</span><b> Required</b>  
				
			</div>
			
		</div>
	</div>
	
</div>

 
