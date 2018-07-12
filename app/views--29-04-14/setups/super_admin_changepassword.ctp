<div class="titlCont">
<div class="myclass">
<?php $this->changePassword="tabSelt";
echo $form->create("Setups", array("action" => "super_admin_changePassword",'name' => 'adduser', 'id' => "adduser", 'class' => 'adduser', 'enctype' => "multipart/form-data",'onsubmit' => 'return validatepassword();'))?>
       <div align="center" id="toppanel">
         <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt">Change Password  </span>
        <div class="topTabs">
                <ul>
                <li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><button class="button" id="Submit1" name="noredirection" type="submit"><span> Apply</span> </button>&nbsp;</li>

               
                <li>
				<?php
				e($html->link(
					$html->tag('span', 'Cancel'),
					array('controller'=>'admins','action'=>'index'),
					array('escape' => false)
					)
				);
				?>
				</li>
                </ul>
            
        </div>           <div class="clear"></div>
        
         <?php $this->changePassword="tabSelt"; echo $this->renderElement('super_admin_config_types'); ?>

</div></div>
  <div id="changesuper">
  <div class="boxBg1">
 
  <div class="boxBor1">
  <div class="boxPad">
  <div class="">
		 
<div style="border-left: 0px none; text-align: right;  color: rgb(255, 255, 255);" class="top-bar">
    
   </div>
<div class="top-bar" style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);">
    
   </div>

<div style="width: 960px; height:330px; margin: 0pt auto; align:left;">   
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<div class="clear"></div>


<div style="height:270px;">
<table width="70%" align='left'>
		
		
		<?php 
		/*    SERVER SIDE VALIDATION MESSAGES */
		
	
	   echo $form->error('Admin.Opassword', 'Old Password is required', array('class' => 'errormsg'));
	    
	   echo $form->error('Admin.password', 'New Password is required', array('class' => 'errormsg'));
	     
	  echo $form->error('Admin.Cpassword', 'Please confirm Password', array('class' => 'errormsg'));
	   
	
		if($session->check('Message.flash')){ $session->flash();}

		/*   END  SERVER SIDE VALIDATION MESSAGES */

		?>
		
		
	   
		<tr> 
		<td align="right" width="22%" style="padding-bottom: 10px;"><label class="boldlabel">Old Password <span style="color: red;">*</span></label>		
		</td>
		<td>
            <span class="intpSpan"><?php echo $form->input("Admin.Opassword", array('id' => 'Opassword', 'div' => false, 'label' => '', 'type' => 'password', "class" => "inpt_txt_fld",'onchange' => 'ajaxpwdcheck(this.value)')); ?>
			</td><td><span id="updatediv1"></span><div id="loadingdivimg" style="display:none">Loading..<img src="img/ajax-loader.gif"></div></td>
		</tr>	
		
	  	
		<tr> 
		<td align="right" style="padding-bottom: 10px;"><label class="boldlabel">New Password <span style="color: red;">*</span></label></td>
			<td><span class="intpSpan"><?php echo $form->input("Admin.password", array('id' => 'password', 'div' => false, 'label' => '','value' => '', 'type' => 'password', "class" => "inpt_txt_fld")); ?>
			
			</td>
		</tr>	
		
		<tr> 
			<td align="right" style="padding-bottom: 10px;"><label class="boldlabel">Confirm Password <span style="color: red;">*</span></label></td>
			<td><span class="intpSpan"><?php echo $form->input("Admin.Cpassword", array('id' => 'Cpassword', 'div' => false, 'label' => '', 'type' => 'password', "class" => "inpt_txt_fld")); ?>
			
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
<tr><td colspan='5' style="border-left: 0px none; text-align: left; padding-top: 5px; " class="top-bar">
   </td></tr>
</table>

				
	</div> <div class="top-bar">
                          		<?php  echo $this->renderElement('bottom_message');  ?>	 

                            </div><br>   
</div></div>
				<!-- END FORM -->
					
					
			
<?php echo $form->end();?>


				
			</div>
</div>
 
</div><!--inner-container ends here-->
</div><!--container ends here-->

<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("changesuper").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
