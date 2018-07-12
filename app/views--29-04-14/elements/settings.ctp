<!-- Body Panel starts -->
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>


</div>
<?php echo $form->create("Admins", array("action" => "settings",'name' => 'settings', 'id' => "settings","enctype"=>'multipart/form-data')); ?>


 <?php  echo $this->renderElement('project_name');  ?>
<span class="titlTxt">
Settings
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/projectdashboard')"><span> Cancel</span></button></li>
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; ">
<ul class="topTabs2">
<li><a href="/admins/contentlist"><span>Webpages</span></a></li>
<li><a href="/admins/socialnetwork"><span>Social Networks</span></a></li>
<li><a href="/admins/settingthemes"><span>Themes</span></a></li>
<li><a href="/admins/settings" class="tabSelt"><span>Settings</span></a></li>
<li><a href="/admins/loginterms"><span>Terms &amp; Privacy</span></a></li>

</ul>
</div>
<div class="clear"></div>

</div></div>
<div class="midPadd" id="newsetttab">
 <!-- <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
<div class="">	
	

<?php  
foreach($valofdd as $details){
$options[$details['Content']['id']]=$details['Content']['title'];
}
?>

<!--Settings-->
<div id="Setting">
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar">
    
   </div>
						    <fieldset style="border: 1px solid rgb(204, 204, 204); padding: 10px;">
								<legend style="color: #4d4d4d; font-weight: bold; padding: 0pt 5px;">Site Setting</legend>
								
								<table cellspacing="10" cellpadding="0" align="center" style="float:left; width:455px;">
								<tr>
									<td width="30%"  align="right"><label class="boldlabel">Site Name <span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->input('Project.sitename',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>

								<tr>
									<td width="30%"  align="right"><label class="boldlabel">Website URL <span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->input('Project.url',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>

								<tr>
									<td width="30%"  align="right"><label class="boldlabel">Favicon <span style="color: red;"></span></label></td>
										<td width="70%"><?php  echo $form->file('Project.favoriteicon',array('id'=> 'favicon',"class" => "inpt_txt_fld"));?></td>
									</tr>

								<tr>
									<td width="30%"  align="right"><label class="boldlabel">Logout Redirect <span style="color: red;"></span></label></td>
										<td width="70%"><span class="txtArea_top">
													<span class="txtArea_bot">
													<?php echo $form->select("Project.logoutredirect",$options,null,array('id' => 'additionalcomment','class'=>"multilist"),"---Select---"); ?></span></span></td>
									</tr>
								<tr>
									<td width="30%" align="right"><label class="boldlabel">Coins Link Page<span style="color: red;"></span></label></td>
										<td width="70%"><span class="txtArea_top">
													<span class="txtArea_bot">
													<?php echo $form->select("coin_redirect",$options,null,array('id' => 'additionalcomment','class'=>"multilist"),"---Select---"); ?></span></span></td>
									</tr>
								<tr>
								  <td>
								      <label>GEO<span style="color: red;"></span></label>
								  </td>
								</tr>
							 	<tr>
									<td width="30%"  align="right"><label class="boldlabel">Longitude <span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->input('Project.longitude',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>
   
							  	<tr>
									<td width="30%"  align="right"><label class="boldlabel">Latitude <span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->input('Project.latitude',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>
								
									


								</table>
								<table cellspacing="10" cellpadding="0" align="center" style="float:left; width:480px;">
								<tr>
									<td width="30%"  align="right"><label class="boldlabel">Site Meta description <span style="color: red;"></span></label></td>
										<td width="70%"><span class="txtArea_top">
													<span class="newtxtArea_bot"><?php echo $form->textarea("Project.sitemetadescription", array('id' => 'sideadesc', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg",'style'=>'width:230px'));?></span></span></td>
									</tr>

								<tr>
									<td width="30%" align="right"><label class="boldlabel">Site Meta keywords <span style="color: red;"></span></label></td>
										<td width="70%"><span class="txtArea_top">
													<span class="newtxtArea_bot"><?php echo $form->textarea('Project.sitemetakeyword',array('cols' => '31', 'rows' => '2',"class" => "noBg",'div'=>false,'label'=>false,'style'=>'width:230px')); ?></span></span></td>
									</tr>
								<tr>
									<td width="30%"  align="right"><label class="boldlabel">Google Analytics <span style="color: red;"></span></label></td>
										<td width="70%">
											<span class="intpSpan"><?php echo $form->input('Project.googleanalytics',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span>



												<!--<span class="txtArea_top">
													<span class="txtArea_bot"><?php //echo $form->textarea('Project.googleanalytics',array('cols' => '31', 'rows' => '8',"class" => "noBg",'div'=>false,'label'=>false,'style'=>'width:230px')); ?></span></span>--></td>
									</tr>
								<tr>
									<td width="50%"  align="right"><label class="boldlabel">Canonical Location(URL) <span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->text('Project.canonicalurl',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>

								<tr>
									<td width="50%"  align="right"><label class="boldlabel">Google site verification<span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->input('Project.meta_gsverification',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>
									<tr>
									<td width="50%"  align="right"><label class="boldlabel">y-key<span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->input('Project.meta_y_key',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>
									<tr>
									<td width="50%"  align="right"><label class="boldlabel">msvalidate<span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->input('Project.meta_msvalidate',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>
								</table>

								
								</fieldset>
									<div class="clear">&nbsp;</div>
			
											</td>
										</tr>
										<tr>	
										<td valign='top'>

								<fieldset style="border: 1px solid rgb(204, 204, 204); padding: 10px;">
									<legend style="color: #4d4d4d; font-weight: bold; padding: 0pt 5px;">API Keys</legend>


							<table cellspacing="10" cellpadding="0" align="center" width="920">
									<td width="30%"  align="right"><label class="boldlabel">Google Maps<span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->text('Project.googlemapskey',array('style'=>'width:750px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>
								<tr>
									<td width="30%" valign="top"  align="right"><label class="boldlabel">Facebook <span style="color: red;"></span></label></td>
										<td width="70%">
											<table cellpadding=0 cellspacing=0 border=0>
												<tr>
												<td valign="top">API Key</td>
												<td valign="top"><span class="intpSpan"><?php echo $form->text('Project.facebookkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
												</tr>
												<tr>
												<td valign="top">APP Id</td>
												<td valign="top"><span class="intpSpan"><?php echo $form->text('Project.facebookappkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
												</tr>
												<tr>
												<td valign="top">APP Secret Key &nbsp;&nbsp;</td>
												<td valign="top"><span class="intpSpan"><?php echo $form->text('Project.facebooksecretkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
												</tr>
											</table>



<!--<span class="intpSpan"><?php //echo $form->text('Project.facebookkey',array('style'=>'width:750px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span>--></td>
									</tr>

								<tr>
									<td width="35%"  align="right"><label class="boldlabel">Twitter <span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->text('Project.twitterkey',array('style'=>'width:750px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>

								</table>
								
									
							</fieldset>
							<fieldset style="border: 1px solid rgb(204, 204, 204); padding: 10px;">
									<legend style="color: #4d4d4d; font-weight: bold; padding: 0pt 5px;">Mail Settings</legend>




							<table cellspacing="10" cellpadding="0" align="center" width="415">
								<tr>
									<td width="35%"  align="right"><label class="boldlabel">From Email <span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->text('Project.fromemail',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
									</tr>
								<tr>
									<td width="30%"  align="right"><label class="boldlabel">From Name<span style="color: red;"></span></label></td>
										<td width="70%"><span class="intpSpan"><?php echo $form->text('Project.fromname',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
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
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>