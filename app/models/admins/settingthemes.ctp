<?php
		echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
		echo $javascript->link('colorpicker/js/eye.js');
		echo $javascript->link('colorpicker/js/colorpicker.js');
		echo $javascript->link('colorpicker/js/utils.js');
		echo $javascript->link('colorpicker/js/layout.js?ver=1.0.2');
	
?>
	<link rel="stylesheet" type="text/css" href="/js/colorpicker/css/colorpicker.css">

<script type="text/javascript">	
		$('#ThemeBackcolor,#ThemeBodycolor, #ThemeBodybgcolor,#ThemeHeadercolor,#ThemeHeaderseperator,#ThemeFooterseprator,#ThemeMenucolor,#ThemeMenuspecial,#ThemeBodytextcolor,#ThemeCopyrighttextcolor,#ThemeHeadercolor1,#ThemeHeadercolor2,#ThemeHeadercolor3,#ThemeLinkcolor').ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(this.value);
				}
			})
			$('#backcolor').bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
			});
</script>
<div class="titlCont"><div class="myclass">
<div align="center" id="toppanel" >
	
 <?php  echo $this->renderElement('new_slider');  ?>


</div>
<?php echo $form->create("Admins", array("action" => "settingthemes",'type' => 'file','enctype'=>'multipart/form-data','name' => 'settingthemes', 'id' => "settingthemes")); ?>
 <?php  echo $this->renderElement('project_name');  ?>
<span class="titlTxt">
Themes
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/projectdashboard')"><span> Cancel</span></button></li>
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; padding-left: 40px;">
<ul class="topTabs2" style="margin-left: -40px;">
<!--<li><a href="/admins/loginterms"><span>Terms &amp; Privacy</span></a></li>
<li><a href="/admins/change_password"><span>Change Password</span></a></li>
<li><a href="/admins/settingthemes" class="tabSelt"><span>Themes</span></a></li>
<li><a href="/admins/settings"><span>Settings</span></a></li>-->
<li><a href="/admins/contentlist"><span>Webpages</span></a></li>
<li><a href="/admins/socialnetwork"><span>Social Networks</span></a></li>
<li><a href="/admins/settingthemes" class="tabSelt"><span>Themes</span></a></li>
<li><a href="/admins/settings" ><span>Settings</span></a></li>
<li><a href="/admins/loginterms"><span>Terms &amp; Privacy</span></a></li>

</ul>
</div>
<div class="clear"></div>

</div></div>

<!--rightpanel ends here-->

<!--inner-container starts here--><div class="rightpanel">



  <div class="midPadd">
	<br />


		 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div> <?php } ?>

		

		<div class="tblData" style="border:none;">
		
		  <div id="Themes">

						<table width="600px" align="center" cellpadding="1" cellspacing="1">
							<?php if($session->check('Message.flash')){ ?>
								<tr>
								<td colspan="2" align="center">
								<?php $session->flash(); ?>
								</td>
								</tr>
								<?php } ?>
							<tr>
								<td valign="top">
							<input type="hidden" value="<?php echo $this->data['Theme']['id'] ?>" id="themeid" name="data[Theme][themeid]"/>

						    <fieldset style="border: 1px solid #d2d2d2; padding: 10px;">
								<legend style="font-weight: bold; padding: 0pt 5px;">Background Color</legend>
								<div style="float: left; width: 275px;">
								<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Page Menu & Border</label>
								#<span class="intpSpan"><?php echo $form->input('Theme.backcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span><br>
								<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Page Background</label>
								#<span class="intpSpan"><?php echo $form->input('Theme.bodycolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
								<br>
								<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Site Background</label>
								#<span class="intpSpan"><?php echo $form->input('Theme.bodybgcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span><br>
								
								</div>
								<div style="float: right;">
								
								<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Header Color</label>
								#<span class="intpSpan"><?php echo $form->input('Theme.headercolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
								<br>
								<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Header Seprator</label>
								#<span class="intpSpan"><?php echo $form->input('Theme.headerseperator',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
								<br>
								<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Footer Seprator</label>
								#<span class="intpSpan"><?php echo $form->input('Theme.footerseprator',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span>
								
								</div>
								
								<div> <label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Site Backrgound Image:</label>
								<?php  echo $form->file('Theme.sitebackgroundimage',array('id'=> 'backgroundimage',"class" => "inpt_txt_fld1","size"=>"0"));?>
								
								<div>								
								<br/><?php echo $form->input('clearbackimage', array('type'=>'checkbox','id'=>'clearbackimage','value'=>'1','label' => 'Remove BackgroundImage')); ?>	</div></fieldset>
									<div class="clear">&nbsp;</div>
			
											</td>
										</tr>
										<tr>	
										<td valign='top'>

							<fieldset style="border: 1px solid #d2d2d2; padding: 10px;">
									<legend style="font-weight: bold; padding: 0pt 5px;">Text Color</legend>
									<div style="float: left; width: 275px;">
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Menu</label>
									
									#<span class="intpSpan"><?php echo $form->input('Theme.menucolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Register &amp; Login</label>
									#<span class="intpSpan"><?php echo $form->input('Theme.menuspecial',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
									
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Body Text</label>
									#<span class="intpSpan"><?php echo $form->input('Theme.bodytextcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
									
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Copyright Text </label>
									
									#<span class="intpSpan"><?php echo $form->input('Theme.copyrighttextcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
									
									</div >
									<div style="float: right; " >
									
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Header 1</label>

									#<span class="intpSpan"><?php echo $form->input('Theme.headercolor1',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
									
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Header 2</label>

									#<span class="intpSpan"><?php echo $form->input('Theme.headercolor2',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
								
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Header 3 </label>

									#<span class="intpSpan"><?php echo $form->input('Theme.headercolor3',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
									
									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Links </label>
									
									#<span class="intpSpan"><?php echo $form->input('Theme.linkcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
									
									</div >


									<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;">Website Header </label>
									
     							    <?php  echo $form->file('Project.coinlogo',array('id'=> 'logo',"class" => "inpt_txt_fld"));?><br>
                                                                  <span style="color: LightSlateGray;font-size: 11px;font-style: italic;margin-left:200px;">Recommended file size 960x92.</span><br>
			                                          <span style="color: LightSlateGray;font-size: 11px;font-style: italic;margin-left:200px;">Format:Transparent PNG or GIF.</span><br>


							<!-- this portion is working correctly  only you have to uncomment it-->

                                                                <!--  <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Click over the image for Original view.</span>
                                                                 <br />&nbsp; <?php if($this->data['Project']['logo'] !=''){  ?> <a href="#divimageview" rel='uploadedlogo' title='Click here to view Full view.'><img src="/img/<?php //echo $project_name.'/uploads/'.$this->data['Project']['logo']; ?>" style="max-height: 92px; max-width: 270px" ></a> <?php }else { ?><img src='/img/<?php //echo $project_name; ?>/nologo.jpg'><?php } ?>
								<span style='display: none;' id="divimageview">
										<div align='center'><img src="/img/<?php// echo $project_name.'/uploads/'.$this->data['Project']['logo']; ?>"></div>
								</span>

      
									<span style='display: none;' id="divimageview">
									<div align='center'><img src="/img/<?php //echo $project_name.'/uploads/'.$this->data['Project']['logo']; ?>"></div>
	  								</span>-->
      
    							<!--end comment -->
							</fieldset>
							</td>
							</tr>
							
						</table>
					</div>
		
		<!--div class="top-bar" style="text-align: left; padding-top: 5px; ">
                            <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
                            </div-->
	
		<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>
