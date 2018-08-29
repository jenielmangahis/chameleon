<?php
	echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
	echo $javascript->link('colorpicker/js/eye.js');
	echo $javascript->link('colorpicker/js/colorpicker.js');
	echo $javascript->link('colorpicker/js/utils.js');
	echo $html->css('colorpicker/colorpicker.css');
    echo $javascript->link('ZeroClipboard');
?>

<script type="text/javascript">

		var clip1 = null;
		var clip2 = null;
		var clip3 = null;
						
		$(function() {
			clip1 = new ZeroClipboard.Client();
			clip1.addEventListener('mousedown',function() {
  				clip1.setText(document.getElementById('codeval1').value);
				$("#codeval1").focus().select();
			});
			clip1.glue('coins_clip_button');

			clip2 = new ZeroClipboard.Client();
			clip2.addEventListener('mousedown',function() {
  				clip2.setText(document.getElementById('codeval2').value);
				$("#codeval2").focus().select();
			});
			clip2.glue('register_clip_button');
			
			clip3 = new ZeroClipboard.Client();
			clip3.addEventListener('mousedown',function() {
  				clip3.setText(document.getElementById('codeval3').value);
				$("#codeval3").focus().select();
			});
			clip3.glue('comment_clip_button');
			
		});
		
		$("#ZeroClipboardMovie_1").live("click",function(){
			$("#codeval1").focus().select();
		});
		
	    $("#ZeroClipboardMovie_2").live("click",function(){
			$("#codeval2").focus().select();
		});
		
	    $("#ZeroClipboardMovie_3").live("click",function(){
			$("#codeval3").focus().select();
		});

</script>
<style>
.themeTblData button {
  position: relative;
  top: 3px;
}
.theme_menutext {
  padding-left: 16px !important;
  padding-right: 2px !important;
}
.inOne{ width:231px;}
 .dashBorad .box1 label {
  width: 119px !important;
}
</style>
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'contentlist';
?>

<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
		   <?php  //echo $this->renderElement('project_name');  ?>
            <h2>Themes</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Admins", array("action" => "settingthemes",'type' => 'file','enctype'=>'multipart/form-data','name' => 'settingthemes', 'id' => "settingthemes")); ?>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            	
        </div>
        <!--<span class="titlTxt1"><?php //echo $project_name;  ?>&nbsp;</span> <span class="titlTxt"> Themes </span>-->
    </div>
  
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    
			$this->loginarea="admins";
			$this->subtabsel="settingthemes";
             echo $this->renderElement('setting_submenus');  
		?>
    </div>
</div>

<!--rightpanel ends here--> 
<!--inner-container starts here-->
<div class="centerPage" id="newsettab">
  <?php if($session->check('Message.flash')){ ?>
  <div id="blck">
    <div class="msgBoxTopLft">
      <div class="msgBoxTopRht">
        <div class="msgBoxTopBg"></div>
      </div>
    </div>
    <div class="msgBoxBg">
      <div class=""><a href="#." onClick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;  position: absolute;   z-index: 11;" /></a>
        <?php  $session->flash();    ?>
      </div>
      <div class="msgBoxBotLft">
        <div class="msgBoxBotRht">
          <div class="msgBoxBotBg"></div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="themeTblData table-responsive">
    <div id="Themes">
    <table class="table table-borderless" width="100%" align="center" cellpadding="0" cellspacing="0">
      <?php if($session->check('Message.flash')){ ?>
      <tr>
        <td align="center">
          <?php $session->flash(); ?>
        </td>
      </tr>
      <?php } ?>
      <tr>
        <td>
          <input type="hidden" value="<?php echo $this->data['Theme']['id'] ?>" id="themeid" name="data[Theme][themeid]"/>
          <table class="themetbl1 table table-borderless" width="100%" cellpadding="0" cellspacing="10">
            <tr class="clearfix">
              <td class="col-sm-6 themetbl1-td1" >
                <fieldset>
                  <legend>Page Layout</legend>
                  <ul class="form-style">
                    <li>
                      <label>Reset Theme</label>
                      <span ><?php echo $form->checkbox('reset', array('value' => 1,'div'=>false,'label'=>false));  ?></span> </li>
                    <li>
                      <label>Page Width</label>
                      <span class="inline-form">
                      <?php $options=array('960'=>'960px  ','1080'=>'1080px  ','1200'=>'1200px  ');
												$attributes=array('legend'=>false,'value' =>'1200');
											echo $form->radio('Theme.pagewidth',$options,$attributes); ?>
                      </span></li>
                    <li>
                      <label>Page Border</label>
                      <span class="inline-form">
                      <?php $optionsborder=array('1'=>'Yes','0'=>'No');
												$attributesborder=array('legend'=>false);
											echo $form->radio('Theme.ispageborder',$optionsborder,$attributesborder); ?>
                    </span></li>
                    <li>
                      <label>Border Color</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.bordercolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
					 
							  
                      <label>Border Width px</label>
                      <span class="intpSpan"><?php echo $form->input('Theme.borderwidth',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                      <label>Menu Color </label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.menubgcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                      <label>Menu Height px</label>
                      <span class="intpSpan"><?php echo $form->input('Theme.menuheight',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                      <label>Dropdown Menu</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dropdowntextcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                  </ul>
                </fieldset>              </td>
              <td class="col-sm-6 themetbl1-td2" >
                <fieldset>
                  <legend>Coins &minus; Register &minus; Comments &minus; Component</legend>
                  <ul class="form-style">
                    <li>
                      <label class="themetbl1_td2_lbl">Around Coins</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.bgaroundcoins',array('id'=>'bgaroundcoins','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                      <textarea class="form-control" id="codeval1" cols="200" rows="2"></textarea>
                      <button type="button" value="Getsource1" class="btn btn-sm btn-primary" name="Getsource" onClick="getsource1();"><span>Get iFrame Source</span></button>
					                       <button type="button" id="coins_clip_button" value="Copy" class="new-blue btn btn-sm btn-success" name="copyb" ><span>Copy</span></button>
                    </li>
                    <li>
                      <label class="themetbl1_td2_lbl" >Register Button</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.bgregisterbtn',array('id'=>'bgregisterbtn','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                      <textarea class="form-control" id="codeval2" cols="200" rows="2"  ></textarea>
                      <button type="button" value="Getsource2" class="btn btn-sm btn-primary" name="Getsource" onClick="getsource2();"><span>Get iFrame Source</span></button>
                      <button type="button" id="register_clip_button" value="Copy" class="new-blue btn btn-sm btn-success" name="copyb" ><span>Copy</span></button>
					 
					</li>
                    <li>
                      <label class="themetbl1_td2_lbl" >Comment Button</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.bgcommentbtn',array('id'=>'bgcommentbtn','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                      <textarea class="form-control"  id="codeval3" cols="200" rows="2"></textarea>
                      <button type="button" value="Getsource3" class=" btn btn-sm btn-primary" name="Getsource" onClick="getsource3();"><span>Get iFrame Source</span></button>
                      <button type="button" id="comment_clip_button" value="Copy" class="new-blue btn btn-sm btn-success" name="copyb" ><span>Copy</span></button>
                    </li>
                  </ul>
                </fieldset>              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table class="themetbl2 table table-borderless" width="100%" cellpadding="0" cellspacing="8">
            <tr>
              <td class="themetbl2_td1">
                <fieldset style="border: 1px solid #d2d2d2; padding: 10px;">
                  <legend style="font-weight: bold; padding: 0pt 5px;">Header & Footer Color</legend>
                  <ul class="form-style">
                    <li>
                      <label>Website Header </label>
                      <?php echo $form->file('Project.coinlogo',array('id'=> 'logo',"class" => "input-file"));?>
                      <div style="color: LightSlateGray; font-size: 11px;font-style: italic; padding-left:135px;"> Recommended width 960px or 1020px depending on page width. </div>
                      
					  <?php if(!empty($existingHeaderImages) && false) { ?>
                      <div id="websiteHeader">
                        <style>
				#websiteHeader {height:123px; margin-left: 190px; overflow-x:scroll; padding:2px; width:400px;float:left}
				#websiteHeader li {height:80px; width:100px;float:left;margin-right:10px;list-style:none;}
				#websiteHeader li img { padding:2px;}
				#websiteHeader li img:hover{border:2px solid #4F9BD7;padding:0px;}
				#websiteHeader li img.imgAcrive{border:2px solid #4F9BD7;padding:0px;}
				</style>
                        <ul>
                          <?php foreach($existingHeaderImages as $existingHeaderImage) { ?>
                          <?php
	if($existingHeaderImage !=''){
	$imgHCLL = '';
	if($this->data['Project']['logo'] == $existingHeaderImage)
	$imgHCLL = 'imgAcrive';
	?>
                          <li>
                            <?php	
		echo $html->image($project_name.'/uploads/siteHeader_images/'.$existingHeaderImage,array('width'=>'100','height'=>'100','alt'=>'Logo','id'=>'siteHeaderImages','class'=>"$imgHCLL"));
	?>
                          </li>
                          <?php } ?>
                          <?php } ?>
                        </ul>
                        <?php echo $form->hidden("Project.logo", array('id' => 'Project_logo'));?> </div>
                      <div class="clear"></div>
                      <div> <?php echo $form->input('clearHeaderimage', array('type'=>'checkbox','id'=>'clearHeaderimage','value'=>'1','label' => false, 'div' => false)); ?>
                        <label for="clearbackimage"> Remove Header Image</label>
                      </div>
                      <?php } ?>
                    </li>
                    <li>
                      <label>No Header Image</label>
                      <span ><?php echo $form->checkbox('Theme.no_header_img', array('value' => 1,'div'=>false,'label'=>false));  ?></span> </li>
                    <li>
                      <label>Header Color</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.headercolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                    <li>
                      <label>Header Separator</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.headerseperator',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                    <li>
                      <label>Footer Separator</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.footerseprator',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span> </li>
                  </ul>
                </fieldset>
              </td>
              <td class="themetbl2_td2" >
                <fieldset>
                  <legend>Page Text</legend>
                  <ul class="form-style">
                    <li>
                      <label class="inline">Font</label>
                      <span class="intpSpan">
                      <?php
				 //$optionsfont = array('0' => 'Arial', '1' => 'TNR');
				 echo $form->select('Theme.pagefont',$fontdropdown, $selectedfontpage ,array('id'=>'pagefont','empty'=>false,'class'=>'multilist multi'), "-- Select --");  ?>
                      </span> </li>
                    <li>
                      <label>Body Text</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.bodytextcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                      <label>Links</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.linkcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                    <li>
                      <label>html &lt;h1&gt; tag</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.headercolor1',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                      <label> html &lt;h2&gt; tag </label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.headercolor2',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                      <label> html &lt;h3&gt; tag </label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.headercolor3',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                  </ul>
                </fieldset>
              </td>
              <td class="themetbl2_td3" >
                <fieldset class="theme_menutext">
                  <legend>Menu Text</legend>
                  <ul class="form-style">
                    <li>
                      <label class="inline">Font</label>
                      <span class="intpSpan"><?php echo $form->select('Theme.menufont',$fontdropdown, $selectedfontmenu ,array('id'=>'menufont','class'=>'multilist multi'), "-- Select --"); ?></span></li>
                   <li>
				   	<label class="inline">Size</label>
				 <?php	$sizearray = range(8, 30); ?>
					<span class="intpSpan"><?php echo $form->select('Theme.fontsize',$sizearray, $selectedfontsize ,array('id'=>'fontsize','class'=>'multilist multi sizeselect'), "- Size -"); ?></span>
					<script type="text/javascript">
					
						
						
						$('#bold').live('click', function(){
							
							$(this).toggleClass('boldselected');
							$('#boldtext').click();
							if($('#boldtext').attr('checked')){
								$('#boldtext_').val('1');
							}else{
								$('#boldtext_').val('0');
							}
							
						});
						
						$('#italic').live('click', function(){
							$(this).toggleClass('italicselected');
							$('#italictext').click();
							if($('#italictext').attr('checked')){
								$('#italictext_').val('1');
							}else{
								$('#italictext_').val('0');
							}
						});
						
						$(function(){
							if($('#boldtext').attr('checked'))
							$('#bold').addClass('boldselected');	
						
						if($('#italictext').attr('checked'))
							$('#italic').addClass('italicselected');
						});
					</script>
					
				<span class="boldspan" ><a href="javascript:void(0);" id="bold" ></a>
				<?php echo $form->input('Theme.boldtext', array('type'=>'checkbox','id'=>'boldtext','value'=>'1','label' => false, 'div' => false)); ?>
				</span>
				<span class="italicspan" ><a href="javascript:void(0);" id="italic" class="italicnotselected" ></a>
				
				<?php echo $form->input('Theme.italictext', array('type'=>'checkbox','id'=>'italictext','value'=>'1','label' => false, 'div' => false)); ?>
				</span>
					
				   </li>
				   
				   
				   
				    <li>
                      <label>Menu</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.menucolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                      <label>Hover Menu</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.menuhover',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                    <li>
                      <label>Active Menu</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.menuactive',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                    <li>
                      <label>Register &amp; Login</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.menuspecial',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                  </ul>
                </fieldset>
              </td>
              <td class="themetbl2_td4" >
                <fieldset>
                  <legend>Background Color</legend>
                  <ul class="form-style">
                    <li>
                      <label class="block">Site Background Image </label>
                      <?php echo $form->file('Theme.sitebackgroundimage',array('id'=> 'backgroundimage', 'class'=>'input-file'));?>
                      <?php if(!empty($existingBgImages) && false) { ?>
                      <div id="siteBkImage">
                        <style>
 #siteBkImage {height:123px; position:relative; overflow-x:scroll; padding:2px; width:400px;float:left}
 #siteBkImage li {height:80px; width:100px;float:left;margin-right:10px;list-style:none;}
  #siteBkImage li img { padding:2px;}
 #siteBkImage li img:hover{border:2px solid #4F9BD7;padding:0px;}
 #siteBkImage li img.imgAcrive{border:2px solid #4F9BD7;padding:0px;}
</style>
                        <ul>
                          <?php foreach($existingBgImages as $existingBgImage) { ?>
                          <?php
	if($existingBgImage !=''){
	$imgCLL = '';
	if($this->data['Theme']['backgroundimage'] == $existingBgImage)
	$imgCLL = 'imgAcrive';
	?>
                          <li>
                            <?php	
		echo $html->image($project_name.'/uploads/siteBackground_images/'.$existingBgImage,array('width'=>'100','height'=>'100','alt'=>'bgImage','id'=>'siteBackgroundImages','class'=>"$imgCLL"));
	?>
                          </li>
                          <?php } ?>
                          <?php } ?>
                        </ul>
                        <?php echo $form->hidden("Theme.backgroundimage", array('id' => 'Theme_backgroundimage'));?> </div>
                      <div class="clear"></div>
                      <div > <?php echo $form->input('clearbackimage', array('type'=>'checkbox','id'=>'clearbackimage','value'=>'1','label' => false, 'div' => false)); ?>
                        <label for="clearbackimage"> Remove Background Image</label>
                      </div>
                      <?php } ?>
					  
                    </li>
                    <li>
                      <label>Site Background</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.bodybgcolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                    <li>
                      <label class="block">Page Background Image </label>
                      <?php echo $form->file('Theme.pagebackgroundimage',array('id'=> 'pagebackgroundimage',"class" => "input-file"));?>
                      <?php if(!empty($existingPageBgImages)&& false) { ?>
                      <div id="siteBkImage">
                        <style>
 #siteBkImage {height:123px; position:relative; overflow-x:scroll; padding:2px; width:400px;float:left}
 #siteBkImage li {height:80px; width:100px;float:left;margin-right:10px;list-style:none;}
  #siteBkImage li img { padding:2px;}
 #siteBkImage li img:hover{border:2px solid #4F9BD7;padding:0px;}
 #siteBkImage li img.imgAcrive{border:2px solid #4F9BD7;padding:0px;}

</style>
                        <ul>
                          <?php foreach($existingPageBgImages as $existingPageBgImage) { ?>
                          <?php
	if($existingPageBgImage !=''){
	$imgCLL = '';
	if($this->data['Theme']['pagebackgroundimage'] == $existingPageBgImage)
	$imgCLL = 'imgAcrive';
	?>
                          <li>
                            <?php	
		echo $html->image($project_name.'/uploads/pageBackground_images/'.$existingPageBgImage,array('width'=>'100','height'=>'100','alt'=>'bgImage','id'=>'pageBackgroundImages','class'=>"$imgCLL"));
	?>
                          </li>
                          <?php } ?>
                          <?php } ?>
                        </ul>
                        <?php echo $form->hidden("Theme.pagebackgroundimage", array('id' => 'Themepagebackgroundimage'));?> </div>
                      <div class="clear"></div>
                      <div> <?php echo $form->input('clearpagebackimage', array('type'=>'checkbox','id'=>'clearpagebackimage','value'=>'1','label' => false, 'div' => false)); ?>
                        <label for="clearpagebackimage"> Remove Page Background Image</label>
                      </div>
                      <?php } ?>
                   
                    </li>
                    <li>
                      <label>Page Background</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.bodycolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                    <li>
                      <label>Forms Background</label>
                      <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.formscolor',array('class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li>
                  </ul>
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table class="themetbl3 table table-borderless" width="100%" cellpadding="0" cellspacing="8" id="toggle_options">
            <tr>
              <td class="themetbl3_td1 col-sm-3">
                <fieldset class="theme_menutext inOne">
                  <legend>For Register and Login Page</legend>
                  <ul class="form-style"><li>
                    <label>Label Text Color</label>
                     <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.labeltextcolor',array('id'=>'labeltextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                     <li>
                    <label>Text Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.systemtextcolor',array('id'=>'systemtextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label>Links Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.systemlinkcolor',array('id'=>'systemlinkcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span> </li></ul>
                </fieldset>
              </td>
              <td class="themetbl3_td2 col-sm-7" >
                <fieldset class="theme_menutext dashBorad">
                  <legend>Member Dashboard &amp; Pages</legend>
                  <ul class="form-style box1"><li>
                    <label>Label Text Color</label>
                     <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardlabelcolor',array('id'=>'dashboardlabelcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span>
                     </li>
                     <li>
                    <label>Special Text Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardspecialtextcolor',array('id'=>'dashboardtextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label>Links Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardlinkcolor',array('id'=>'dashboardlinkcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                  </ul>
                  <ul class="form-style box2">
                  <li>
                    <label>Menu Text Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardmenutextcolor',array('id'=>'dashboardmenutextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label>Menu Background Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardmenubgcolor',array('id'=>'dashboardmenubgcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label  class="boldlabel" style="display: inline-block;  text-align: right; margin-bottom: 10px;">Menu Hover Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardmenuhovercolor',array('id'=>'dashboardmenuhovercolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span></li>
                    <li>
                    <label>Selected Menu Tab Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardselectmenucolor',array('id'=>'dashboardselectmenucolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span></li>
                    <li>
                    <label>Menu Separator Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.dashboardmenuseparatorcolor',array('id'=>'dashboardmenuseparatorcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?> </span></li></ul>
                    
                    
                  <ul class="form-style box3"><li>  <label>Profile Progress bar Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.progressbarcolor',array('id'=>'progressbarcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label>Save &amp; Apply Button Background</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.saveapplybg',array('id'=>'saveapplybg','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label>Save &amp; Apply Button Hover Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.saveapplyhover',array('id'=>'saveapplyhover','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label>Save &amp; Apply Separator Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.saveapplyseparator',array('id'=>'saveapplyseparator','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li>
                    <li>
                    <label>Save &amp; Apply Text Color</label>
                    <span class="intpSpan"><em>#</em><?php echo $form->input('Theme.saveapplytextcolor',array('id'=>'saveapplytextcolor','class'=>'inpt_txt_fld1','div'=>false,'label'=>false)); ?></span></li></ul>
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <?php echo $form->end(); ?> 
  <!-- ADD Sub Admin  FORM EOF --> 
</div>
</div>
<!--inner-container ends here-->
<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null) {
		document.getElementById("newsettab").style.paddingTop = '24px';
	} else {
			document.getElementById("blck").style.paddingTop = '10px';
	}

// By Suman date 25 April 2012
	/*
	//if($("#existing_sitebackgroundimage").val() != '')
	//$("input#backgroundimage").attr('disabled',true);
	
	$("#existing_sitebackgroundimage").change(function () {
		//alert($(this).val());
		var furl = $('#siteBackgroundImages').attr('src');
		var filename = furl.substring(0,furl.lastIndexOf('/')+1);
		//alert(filename);
		if($(this).val() == '') {
		filename = filename+$(this).val();
		//$('div#siteBackgroundImages_container > img').remove();
		$('#siteBackgroundImages').attr('src',filename);
		$('#siteBackgroundImages').hide();
		$("input#backgroundimage").attr('disabled',false)
		} else {
		$('#siteBackgroundImages').show();
		filename = filename+$(this).val();
		$('#siteBackgroundImages').attr('src',filename);
		$("input#backgroundimage").attr('disabled',true)
		}
    }); 
	
	if($("#existing_siteheaderimage").val() != '')
	$("input#logo").attr('disabled',true);
	
	$("#existing_siteheaderimage").change(function () {
		//alert($(this).val());
		if($(this).val() == '')
		$("input#logo").attr('disabled',false)
		else
		$("input#logo").attr('disabled',true)
		
    }); 	
	*/
	
	$('div#siteBkImage ul > li').click(function() {
	   var li_img = $('img', this);
	   var filename = li_img.attr('src');
	   var filename = filename.substring(filename.lastIndexOf('/')+1);
	   //alert(filename);
	   $('#Theme_backgroundimage').val(filename);
	   
	   $('#siteBkImage ul > li').each(function(index) {
			$('img', this).attr('class','')
		});
		li_img.attr('class','imgAcrive');
	});
	
	$('div#websiteHeader ul > li').click(function() {
	   var li_img = $('img', this);
	   var filename = li_img.attr('src');
	   var filename = filename.substring(filename.lastIndexOf('/')+1);
	   //alert(filename);
	   $('#Project_logo').val(filename);
	   
	   $('#websiteHeader ul > li').each(function(index) {
			$('img', this).attr('class','')
		});
		li_img.attr('class','imgAcrive');
	});
</script> 
<script type="text/javascript" language="javascript">    
    // On bottom of page many variables are showing so to disable them commnet below code
	// Suman Singh
	
	/**/
        $('#ThemeBackcolor, #ThemeBodycolor, #ThemeBodybgcolor, #ThemeBordercolor, #ThemeMenubgcolor, #ThemeHeadercolor, #ThemeHeaderseperator, #ThemeFooterseprator, #ThemeMenucolor, #ThemeMenuactive, #ThemeMenuspecial, #ThemeBodytextcolor, #ThemeCopyrighttextcolor, #ThemeHeadercolor1, #ThemeHeadercolor2, #ThemeHeadercolor3, #ThemeLinkcolor, #bgaroundcoins, #systemtextcolor, #labeltextcolor, #systemlinkcolor, #dashboardlabelcolor, #dashboardtextcolor, #dashboardlinkcolor, #dashboardmenutextcolor, #dashboardmenubgcolor, #dashboardmenuhovercolor, #dashboardselectmenucolor, #progressbarcolor, #saveapplybg, #saveapplyhover, #dashboardmenuseparatorcolor, #saveapplyseparator, #saveapplytextcolor, #dropdowntextcolor, #ThemeBorderColor, #ThemeDropdowntextcolor, #bgregisterbtn, #bgcommentbtn, #ThemeMenuhover, #ThemeFormscolor').ColorPicker({
                onSubmit: function(hsb, hex, rgb, el) {
                    $(el).val(hex);
					$(el).next().css('background', '#'+hex );
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
<script type="text/javascript" language="javascript">

	

    /* <![CDATA[ */      
    $("#toogle_btn").click(function () {

        if($("#toogle_btn").val() == "Hide Advanced Options" ){
              $("#toogle_btn").val("Show Advanced Options");
          }else{
              $("#toogle_btn").val("Hide Advanced Options");
          }
		$("#toggle_options").slideToggle("slow");               
    });
	
	

      /* ]]> */   

	function getsource1()
    {
        var code="<iframe width='auto' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/gosocialcms/companies/iframeshowcoins/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval1").value=code;
    }
	
    function getsource2()
    {
        var code="<iframe width='170px' style='height: 55px; border:none' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/gosocialcms/companies/iframeregisterbtn/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval2").value=code;
    }
    function getsource3()
    {
        var code="<iframe width='170px' style='height: 55px; border:none' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/gosocialcms/companies/iframecommentbtn/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval3").value=code;
    } 
	
	</script> 
<?php	echo $javascript->link('colorpicker/js/showcolorbox.js'); ?>