<?php
		echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
		echo $javascript->link('colorpicker/js/eye.js');
		echo $javascript->link('colorpicker/js/colorpicker.js');
		echo $javascript->link('colorpicker/js/utils.js');
	//	echo $javascript->link('colorpicker/js/layout.js?ver=1.0.2');
	
?>
	<link rel="stylesheet" type="text/css" href="/js/colorpicker/css/colorpicker.css">


<div class="titlCont"><div class="myclass">
<div align="center" id="toppanel" >
	 <?php  echo $this->renderElement('new_slider');  ?>



</div>
<?php echo $form->create("Companies", array("action" => "settingthemes",'type' => 'file','enctype'=>'multipart/form-data','name' => 'settingthemes', 'id' => "settingthemes")); ?>
<span class="titlTxt">
Themes
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/dashboard')"><span> Cancel</span></button></li>
</ul>
</div>

<!-- <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both;">
<ul class="topTabs2">
 
<li><a href="/companies/settingthemes" class="tabSelt"><span>Themes</span></a></li>
<li><a href="/companies/settings" ><span>Settings</span></a></li>
<li><a href="/companies/loginterms"><span>Terms &amp; Privacy</span></a></li>
< ?php if($project['Project']['url']!="" || $project['Project']['url']!=null ) {?> <li><a href="/companies/iframes"><span>iFrames</span></a></li>  < ?php } ?>   
<li><a href="/companies/projectcontrols"><span>Controls</span></a></li>
<li><a href="/companies/change_password" ><span>Change Password</span></a></li>
</ul>
</div>
<div class="clear"></div>    -->
 <?php  $this->loginarea="companies";    
        $this->subtabsel="settingthemes";
        echo $this->renderElement('websites_submenus');  ?> 
 
</div></div>

<!--rightpanel ends here-->

<!--inner-container starts here-->
<div>
<div class="midPadd" id="settingthm">
<div class="tblData" style="border:none;">
  <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		
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
                                <div style="float: left; width: 265px; vertical-align: middle;">
                                <label class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Page Menu & Border</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.backcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span><br>
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Page Background</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.bodycolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Site Background</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.bodybgcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span><br>
                
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Dropdown Menu</label>
                                    
                                    # <span class="intpSpan"><?php echo $form->input('Theme.copyrighttextcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Around Coins</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.bgaroundcoins',array('id'=>'bgaroundcoins','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                </div>

                                <div style="float: left; width: 440px; ">
                                <label class="boldlabel" style="display: inline-block; width: 182px; text-align: right; margin-bottom: 18px;">Site Background Image </label>
                                <span class="intpSpan">
                                <?php echo $form->file('Theme.sitebackgroundimage',array('id'=> 'backgroundimage',"class" => "inpt_txt_fld1","size"=>"0", 'style' => 'width: 225px; vertical-align: middle;'));?></span>
                                <br/>
                                <label for="clearbackimage" class="boldlabel" style="display: inline-block; width: 182px; text-align: right; margin-bottom: 10px;">Remove Background Image </label>
                                <span style="display: inline-block; vertical-align: middle;">
                                <?php echo $form->input('clearbackimage', array('type'=>'checkbox','id'=>'clearbackimage','value'=>'1','label' => false, 'div' => false)); ?>
                                </span>
                                
                                </div>
                                
                                <div  style="float: left; width: 220px;vertical-align: middle;">
                                <label class="boldlabel" style="display: inline-block; width: 120px; text-align: right; margin-bottom: 10px;">Header Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.headercolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 120px; text-align: right; margin-bottom: 10px;">Header Separator</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.headerseperator',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 120px; text-align: right; margin-bottom: 10px;">Footer Separator</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.footerseprator',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span>
                                
                            </div>
                            
                            </fieldset>
                                    <div class="clear">&nbsp;</div>
            
                                            </td>
                                        </tr>
                                        <tr>    
                                        <td valign='top'>

                            <fieldset style="border: 1px solid #d2d2d2; padding: 10px;">
                                    <legend style="font-weight: bold; padding: 0pt 5px;">Text Color</legend>
                                    <div style="float: left; width: 265px; vertical-align: middle;">
                                    <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Menu</label>
                                    # <span class="intpSpan"><?php echo $form->input('Theme.menucolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
    
                                    <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Active Menu</label>
                                    # <span class="intpSpan"><?php echo $form->input('Theme.menuactive',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    <br/>
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Register &amp; Login</label>
                                    # <span class="intpSpan"><?php echo $form->input('Theme.menuspecial',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    <br/>
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Body Text</label>
                                    # <span class="intpSpan"><?php echo $form->input('Theme.bodytextcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    <br/>
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Links</label>
                                    # <span class="intpSpan"><?php echo $form->input('Theme.linkcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    <br/>
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Dropdown Text Color</label>
                                    # <span class="intpSpan"><?php echo $form->input('Theme.dropdowntextcolor',array('id'=>'dropdowntextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    
                                    
                                    </div >


                                    <div style="float: left; width: 440px;">
                                    <label  class="boldlabel" style="display: inline-block; width: 182px; text-align: right; margin-bottom: 10px;">Website Header </label>
                                         <span class="intpSpan"><?php echo $form->file('Project.coinlogo',array('id'=> 'logo',"class" => "inpt_txt_fld", 'style' => 'width: 225px;'));?></span><br>
                                                                  <span style="color: LightSlateGray;font-size: 11px;font-style: italic;margin-left:200px;">Recommended image width 960px.</span><br>
                                                      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;margin-left:200px;">Format:Transparent PNG or GIF.</span><br>
                                    </div>



                                    <div style="float: left; width: 220px; vertical-align: middle;">
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 120px; text-align: right; margin-bottom: 10px;">Header 1</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.headercolor1',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 120px; text-align: right; margin-bottom: 10px;">Header 2</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.headercolor2',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
                                
                                    <label  class="boldlabel" style="display: inline-block; width: 120px; text-align: right; margin-bottom: 10px;">Header 3</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.headercolor3',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
                                    
                                    
                                    </div >


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
                             <!--<br />
                            <input type="button" value="Show Advanced Options" name="toogle_btn" id="toogle_btn"> 
                            <br />
                            <br />-->
                            <div id="toggle_options" style="">
                            <!--------------------------------new code------------------------------------------ -->
                            
                            <fieldset style="border: 1px solid #d2d2d2; padding: 10px;">
                                <legend style="font-weight: bold; padding: 0pt 5px;">System Pages Options (For Register and Login Page)</legend>
                                <div style="float: left; width: 265px; vertical-align: middle;">
                                
                                <label class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Label Text Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.labeltextcolor',array('id'=>'labeltextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span><br>
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Text Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.systemtextcolor',array('id'=>'systemtextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Links Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.systemlinkcolor',array('id'=>'systemlinkcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>

                                
                                </div>
                          
                            </fieldset>
                            
                            <fieldset style="border: 1px solid #d2d2d2; padding: 10px;">
                                <legend style="font-weight: bold; padding: 0pt 5px;">Member Dashboard Options (For dashboard Pages)</legend>
                                <div style="float: left; width: 250px; vertical-align: middle;">
                                
                                 <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Label Text Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardlabelcolor',array('id'=>'dashboardlabelcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Special Text Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardspecialtextcolor',array('id'=>'dashboardtextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 150px; text-align: right; margin-bottom: 10px;">Links Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardlinkcolor',array('id'=>'dashboardlinkcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                               
                                
                                </div>
                                
                                <div  style="float: left; width: 360px;vertical-align: middle;">
                                <label class="boldlabel" style="display: inline-block; width: 260px; text-align: right; margin-bottom: 10px;">Dashboard Menu Text Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardmenutextcolor',array('id'=>'dashboardmenutextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 260px; text-align: right; margin-bottom: 10px;">Dashboard Menu Background Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardmenubgcolor',array('id'=>'dashboardmenubgcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 260px; text-align: right; margin-bottom: 10px;">Dashboard Menu Hover Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardmenuhovercolor',array('id'=>'dashboardmenuhovercolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 260px; text-align: right; margin-bottom: 10px;">Dashboard Selected Menu Tab Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardselectmenucolor',array('id'=>'dashboardselectmenucolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span>
                                <br>
                                <label  class="boldlabel" style="display: inline-block; width: 260px; text-align: right; margin-bottom: 10px;">Dashboard Menu Separator Color</label>
                                # <span class="intpSpan"><?php echo $form->input('Theme.dashboardmenuseparatorcolor',array('id'=>'dashboardmenuseparatorcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span>
                                
                                
                            </div>
                            
                            
                                    <div style="float: left; width: 306px; vertical-align: middle;">
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 208px; text-align: right; margin-bottom: 10px;">Profile Progress bar Color</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.progressbarcolor',array('id'=>'progressbarcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
                                    
                                    <label  class="boldlabel" style="display: inline-block; width: 208px; text-align: right; margin-bottom: 10px;">Save & Appy Button Background</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.saveapplybg',array('id'=>'saveapplybg','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
                                
                                    <label  class="boldlabel" style="display: inline-block; width: 208px; text-align: right; margin-bottom: 10px;">Save & Appy Button Hover Color</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.saveapplyhover',array('id'=>'saveapplyhover','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> <br/>
                                    <label  class="boldlabel" style="display: inline-block; width: 208px; text-align: right; margin-bottom: 10px;">Save & Appy Separator Color</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.saveapplyseparator',array('id'=>'saveapplyseparator','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    <br/>
                                    <label  class="boldlabel" style="display: inline-block; width: 208px; text-align: right; margin-bottom: 10px;">Save & Appy Text Color</label>

                                    # <span class="intpSpan"><?php echo $form->input('Theme.saveapplytextcolor',array('id'=>'saveapplytextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> 
                                    
                                    
                                    </div >
                            
                            
                          
                            </fieldset>
                            
                             <!--------------------------------new code------------------------------------------ -->
                             </div>
                            
                            
                            
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

<?php
  // echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
   		echo $javascript->link('facebox.js');
	    echo $html->css('facebox.css','stylesheet');
?>

<script type="text/javascript">	

	 jQuery(document).ready(function($) {
			$('a[rel*=coina]').facebox();
		})
	 jQuery(document).ready(function($) {
			$('a[rel*=coinb]').facebox();
		})	

	 jQuery(document).ready(function($) {
			$('a[rel*=uploadedlogo]').facebox();
		})
	</script>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("settingthm").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>

<script type="text/javascript">    

        $('#ThemeBackcolor,#ThemeBodycolor,#ThemeBodybgcolor,#ThemeHeadercolor,#ThemeHeaderseperator,#ThemeFooterseprator,#ThemeMenucolor,#ThemeMenuactive,#ThemeMenuspecial,#ThemeBodytextcolor,#ThemeCopyrighttextcolor,#ThemeHeadercolor1,#ThemeHeadercolor2,#ThemeHeadercolor3,#ThemeLinkcolor,#bgaroundcoins,#systemtextcolor,#labeltextcolor,#systemlinkcolor,#dashboardlabelcolor,#dashboardtextcolor,#dashboardlinkcolor,#dashboardmenutextcolor,#dashboardmenubgcolor,#dashboardmenuhovercolor,#dashboardselectmenucolor,#progressbarcolor,#saveapplybg,#saveapplyhover,#dashboardmenuseparatorcolor,#saveapplyseparator,#saveapplytextcolor,#dropdowntextcolor').ColorPicker({
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


<script>
    $("#toogle_btn").click(function () {

        if($("#toogle_btn").val() == "Hide Advanced Options" ){
              $("#toogle_btn").val("Show Advanced Options");
          }else{
              $("#toogle_btn").val("Hide Advanced Options");
          }
      $("#toggle_options").slideToggle("slow");               
      
     
    });
</script>
