<?php ?>

<div class="titlCont">
<?php $this->changePassword="tabSelt";

echo $form->create("Admins", array("action" => "changePassword",'name' => 'adduser', 'id' => "adduser", 'class' => 'adduser', 'enctype' => "multipart/form-data",'onsubmit' => 'return validatepassword();'))?>
       <div align="center" id="toppanel" >
        <div id="panel">
                        <div class="content clearfix">
                        <H1> Help</h1>
                                <p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
        </div>
                        
        </div> <!-- /login -->  

        <!-- The tab on top --> 
        <div class="tab">
                <ul class="login">
                        <li id="toggle">
            <a id="open" class="open" href="#."><span>Click Here to Open Help Box</span></a>

                                <a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>               
                        </li>
                </ul> 
        </div>
</div>

  <span class="titlTxt">Change Password  </span>
        <div class="topTabs">
                <ul>
                <li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><a href="#." class=""><span>Apply</span></a></li>
                <li><a href="/admins/"><span>Cancel</span></a></li>
                </ul>
            
        </div>           <div class="clear"></div>
               <ul class="topTabs2" id="tab-container-1-nav" style=" padding-left: 40px;">
        <li><a class="<?php echo (empty($this->changePassword)) ? '' : $this->changePassword; ?>" href="/admins/changePassword"><span>Change Password</span></a></li>
        <li><a class="<?php echo (empty($this->help_list)) ? '' : $this->help_list; ?>" href="/admins/help_list"><span>Help List</span></a></li>
       
</ul>
  
</div>
<div class="rightpanel">

<div id="center-column">

		
			<table class="listing" cellpadding="0" cellspacing="0" style='float:left'>
		<!-- ADD USER FORM -->
	<?php if($session->check('Message.flash')){ $session->flash();} ?>
	
		<table width="750px" align="center" cellpadding="1" cellspacing="1">
		
		<tr>
		<td colspan="2">
		<?php 
		/*    SERVER SIDE VALIDATION MESSAGES */
		
	
	     echo $form->error('Admin.Opassword', 'Old Password is required', array('class' => 'errormsg'));
	    
	     echo $form->error('Admin.password', 'New Password is required', array('class' => 'errormsg'));
	     
	     echo $form->error('Admin.Cpassword', 'Please confirm Password', array('class' => 'errormsg'));
	   
	
		if($session->check('Message.flash')){ $session->flash();}

		/*   END  SERVER SIDE VALIDATION MESSAGES */

		?>
		
			</td>
		</tr>
		
	   
		<tr> 
			<td style='width:20%'><label class="boldlabel">Old Password <span class="red">*</span></label></td>
			<td><?php echo $form->input("Admin.Opassword", array('id' => 'Opassword', 'div' => false, 'label' => '', 'type' => 'password', "class" => "contactInput",'onchange' => 'ajaxpwdcheck(this.value)')); ?>
			<span id="updatediv1"></span><div id="loadingdivimg" style="display:none">Loading..<img src="/img/ajax-loader.gif"></div>
			</td>
		</tr>	
		
	  	
		<tr> 
			<td><label class="boldlabel">New Password <span class="red">*</span></label></td>
			<td><?php echo $form->input("Admin.password", array('id' => 'password', 'div' => false, 'label' => '','value' => '', 'type' => 'password', "class" => "contactInput")); ?>
			
			</td>
		</tr>	
		
		<tr> 
			<td><label class="boldlabel">Confirm Password <span class="red">*</span></label></td>
			<td><?php echo $form->input("Admin.Cpassword", array('id' => 'Cpassword', 'div' => false, 'label' => '', 'type' => 'password', "class" => "contactInput")); ?>
			
			</td>
		</tr>	
				
		
	<tr> 
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>	
<tr>
<td width="110px">&nbsp;</td>
<td>

	</td></tr>
</table>
<?php echo $form->end();?>
				<b>Any item with a</b>  "<span class="red">*</span>"  <b>requires an entry.</b> 	
					<!-- END FORM -->
					
					
				</table>
				
			</div>

 
</div><!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->


