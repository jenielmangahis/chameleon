<!-- Body Panel starts -->
<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
$base_url = Configure::read('App.base_url');
?>
<div class="titlCont">
<div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>	
</div>

<?php 

	echo $form->create("setups", array("action" => "settings",'name' => 'settings', 'id' => "settings",'onsubmit'=>'return validsetting();'));?> 
	
<span class="titlTxt">Setup</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
</ul>
</div>

 <?php    $this->loginarea="setups";    $this->subtabsel="settings";
                    echo $this->renderElement('setup_submenus'); 
?> 

</div></div>
<div class="centerPage" id="newsetttab">
<div class="">	
	
<!--Settings-->
<div id="Setting">
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar">
    
   </div>

   <table cellspacing="10" cellpadding="0" align="center" style="float:left; width:424px;">
	  <tr>
		  <td width="40%" class="lbltxtarea" align="right"><label class="boldlabel">Company Name<span style="color: red;">*</span></label></td>
			  <td width="60%"><span class="intpSpan"><?php echo $form->input('Project.project_name',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
			   <?php 
			   echo $form->input("Project.id", array('id' => 'project_id', 'div' => false, 'label' => '', 'value'=>$project_id));?>
		  </tr>

	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Notification Email<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Admin.email',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  
	   <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Locations</label></td>
			  <td width="70%">
			   <span class="inline-form">
                      <?php $options=array('one'=>'One  ','multiple'=>'Multiple ');
												$attributes=array('legend'=>false,'value' =>$sellocation);
											echo $form->radio('Project.locations',$options,$attributes); ?>
                      </span>
			  </td>
	  </tr>
	  
	  
	  
	  
	 
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Addresss1<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.address1',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Addresss2<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.address2',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>

	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Country<span style="color: red;">*</span></label></td>
			<td width="70%">
			<span class="txtArea_top"><span class="txtArea_bot">
					<?php echo $form->select("Project.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;','onchange'=>'return getstateoptions(this.value,"Event")'),array('254'=>'United States')); ?>
					<?php echo $form->error('Project.country', array('class' => 'errormsg')); ?> 
			</span>
			</td>
	  </tr>

	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">State<span style="color: red;">*</span></label></td>
			<td width="70%">
			<span class="txtArea_top"><span class="txtArea_bot">
							<span id="statediv"><?php echo $form->select("Project.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;'),"---Select---"); ?></span> </span>
			</td>
	  </tr>
	  
	  
	    <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Zipcode<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.zipcode',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">City<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.city',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  </tr>
	  
	    <tr>
		  <td colspan="2" class="lbltxtarea" align="center"><label class="boldlabel">Use Wordpress Page Database</label>
			   <span class="inline-form">
			   <?php 
						$options = array(1 => '1');
						$selected= array($is_wordpress_page);
						echo $form->checkbox('Project.is_wordpress_page',$options, $selected); 
			   ?>
               </span>
		  </td>
	  </tr>
	  </table>
	  <table cellspacing="10" cellpadding="0" align="center" style="float:left; width:514px;">
	 
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">LoginId<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Admin.username',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">New Password<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Admin.npassword',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Confirm Password<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Admin.cpassword',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	 
	 
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Main Phone<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.main_phone',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	    <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Fax<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.fax',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	    <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Website<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.website',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Facebook Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.facebook',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Twitter Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.twitter',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Google+ Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.googleplus',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Linkedin Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.linkedin',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Pinterest Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.pinterest',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	       
	  </table>

	<div class="clear">&nbsp;</div>
			
	  </td>
  </tr>
  <tr>	
  <td valign='top'>

  <fieldset style="border: 1px solid rgb(204, 204, 204); padding: 10px;">
	  <legend style="color: #4d4d4d; font-weight: bold; padding: 0pt 5px;">API Keys</legend>


	  <table cellspacing="10" cellpadding="0" align="center" width="921px">
		<tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Google Maps<span style="color: red;"></span></label></td>
		  <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.googlemapskey',array('style'=>'width:650px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
		  <td><a href="http://www.google.com/local/add?hl=en&gl=us" target="_blank"><img src="<?php echo $base_url ?>img/google.gif"></a></td>
		</tr>
		
		<tr>
		  <td width="30%" valign="top"  align="right"><label class="boldlabel">Google Plus <span style="color: red;"></span></label></td>
		  <td width="70%">
			  <table cellpadding=0 cellspacing=0 border=0>
				  <tr>
					<td class="lbltxtarea" align="right">Client ID<span style="display:inline-block;width:16px"></span></td>
					<td class="lbltxtarea" align="right"><span class="intpSpan"><?php echo $form->text('Project.googleplusclientid',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
					<td rowspan="2"><span>&nbsp;&nbsp;&nbsp;<a href="http://console.google.com/" target="_blank">
					<img src="<?php echo $base_url ?>img/gplus_icon.png"></a></span></td>
					
				  </tr>
				  <tr>
					<td class="lbltxtarea">App Secret Key<span style="display:inline-block;width:16px"></span></td>
					<td valign="top"><span class="intpSpan"><?php echo $form->text('Project.googleplussecretkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
				  </tr>
			  </table>
			</td>
		  </tr>
		<tr>
		  <td width="30%" valign="top"  align="right"><label class="boldlabel">Facebook <span style="color: red;"></span></label></td>
		  <td width="70%">
			  <table cellpadding=0 cellspacing=0 border=0>
				  <tr>
					<td class="lbltxtarea" align="right">App ID/API Key<span style="display:inline-block;width:16px"></span></td>
					<td class="lbltxtarea" align="right"><span class="intpSpan"><?php echo $form->text('Project.facebookappkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
					<td rowspan="2"><span>&nbsp;&nbsp;&nbsp;<a href="http://developers.facebook.com/" target="_blank"><img src="<?php echo $base_url ?>/img/facebook.gif"></a></span></td>
					
				  </tr>
				  <tr>
					<td class="lbltxtarea">App Secret Key<span style="display:inline-block;width:16px"></span></td>
					<td valign="top"><span class="intpSpan"><?php echo $form->text('Project.facebooksecretkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
				  </tr>
			  </table>
			
			</td>
			
		  </tr>
		  <tr>
			  <td width="35%" class="lbltxtarea" align="right"><label class="boldlabel">Twitter Consumer Key <span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.twitterkey',array('style'=>'width:650px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
			  <td><a href="https://dev.twitter.com/" target="_blank"><img src="<?php echo $base_url ?>img/twitter.gif"></a></td>	
			  </tr>
			  
			  <tr>
			  <td width="35%" class="lbltxtarea" align="right"><label class="boldlabel">Twitter Consumer Secret <span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.twittersecretkey',array('style'=>'width:650px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
			   </tr>
			  
			  <tr>
			  <td width="35%" class="lbltxtarea" align="right"><label class="boldlabel">Token <span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.twittertoken',array('style'=>'width:650px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
			   </tr>
			  
			  <tr>
			  <td width="35%" class="lbltxtarea" align="right"><label class="boldlabel">Twitter Secret <span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.twitterSecret',array('style'=>'width:650px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
			   </tr>

		  </table>
	  </fieldset>
      
      
	</div>
<!--settings end-->
<p>&nbsp;</p>
	
		<?php echo $form->end();?>
</div></div> </div>
 
<!--inner-container ends here-->

<div></div>
  
<div class="clear"></div>

  <!-- Body Panel ends --> 
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newsetttab").style.paddingTop = '24px';
	else
		document.getElementById("blck").style.paddingTop = '10px';
</script>
