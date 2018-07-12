<!-- Body Panel starts -->
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>


</div>
<?php 
	echo $form->create("Company", array("action" => "settings",'name' => 'settings', 'id' => "settings","enctype"=>'multipart/form-data')); 
	echo $form->hidden('Project.facebookkey',array('value'=>''));
?>
<span class="titlTxt">
Settings
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

<li><a href="/companies/settingthemes" ><span>Themes</span></a></li>
<li><a href="/companies/settings" class="tabSelt"><span>Settings</span></a></li>
<li><a href="/companies/loginterms"><span>Terms &amp; Privacy</span></a></li>
< ?php if($project['Project']['url']!="" || $project['Project']['url']!=null ) {?> <li><a href="/companies/iframes"><span>iFrames</span></a></li>  < ?php } ?>
<li><a href="/companies/projectcontrols"><span>Controls</span></a></li>
<li><a href="/companies/change_password" ><span>Change Password</span></a></li>   
</ul>
</div>
<div class="clear"></div>  -->
 <?php  $this->loginarea="companies";    
        $this->subtabsel="settings";
        echo $this->renderElement('setup_submenus');  ?> 
</div></div>

<div class="midPadd" id="settingtabnew">
 <!-- <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
<div class="">	
	
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



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
      
      <table cellspacing="10" cellpadding="0" align="center" style="float:left; width:424px;">
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Title Tag <span style="color: red;"></span></label></td>
              <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.sitename',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
          </tr>

      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Website URL <span style="color: red;"></span></label></td>
              <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.url',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
          </tr>

      <tr>
          <td width="30%"  align="right"><label class="boldlabel">Favicon <span style="color: red;"></span></label></td>
              <td width="70%"><?php  echo $form->file('Project.favoriteicon',array('id'=> 'favicon',"class" => "inpt_txt_fld"));?></td>
          </tr>

      <tr>
          <td width="40%" class="lbltxtarea" align="right"><label class="boldlabel">Logout Redirect <span style="color: red;"></span></label></td>
              <td width="70%"><span class="txtArea_top">
                          <span class="txtArea_bot">
                          <?php echo $form->select("Project.logoutredirect",$options,null,array('id' => 'additionalcomment','class'=>"multilist"),"---Select---"); ?></span></span></td>
          </tr>
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Coins Link Page<span style="color: red;"></span></label></td>
              <td width="70%"><span class="txtArea_top">
                          <span class="txtArea_bot">
                          <?php echo $form->select("Project.coin_redirect",$options,null,array('id' => 'coin_redirect','class'=>"multilist"),"---Select---"); ?></span></span></td>
          </tr>
      <tr>
        <td>
            <label>GEO<span style="color: red;"></span></label>
        </td>
      </tr>
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Longitude <span style="color: red;"></span></label></td>
              <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.longitude',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
          </tr>

      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Latitude <span style="color: red;"></span></label></td>
              <td width="70%"><span class="intpSpan"><?php echo $form->input('Project.latitude',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
          </tr>
      </table>
      <table cellspacing="10" cellpadding="0" align="center" style="float:left; width:514px;">
      <tr>
          <td width="36%" align="right" class="lbltxtarea"><label class="boldlabel">Site Meta Description <span style="color: red;"></span></label>
          <i style="font-size: 11px;">(Recommended 100 characters)</i>
          </td>
              <td width="70%"><span class="txtArea_top">
                          <span class="newtxtArea_bot"><?php echo $form->textarea("Project.sitemetadescription", array('id' => 'sideadesc', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg",'style'=>'width:230px'));?></span></span>
                          <span id="charCount_sideadesc"></span>
                          </td>
          </tr>

      <tr>
          <td width="70%" align="right" class="lbltxtarea"><label class="boldlabel">Site Meta Keywords <span style="color: red;"></span></label>
          <i style="font-size: 11px;">(Recommended 100 characters)</i>
          </td>
              <td width="70%"><span class="txtArea_top">
                          <span class="newtxtArea_bot"><?php echo $form->textarea('Project.sitemetakeyword',array('id'=>'sitemetakeyword','cols' => '31', 'rows' => '2',"class" => "noBg",'div'=>false,'label'=>false,'style'=>'width:230px')); ?></span></span>
                          <span id="charCount_sitemetakeyword"></span>
                          </td>
          </tr>
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Google Analytics <span style="color: red;"></span></label></td>
              <td width="70%">
                  <span class="intpSpan"><?php echo $form->input('Project.googleanalytics',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span>
              </td>
             <td><img src="/img/google.gif"></td>
          </tr>
      <tr>
          <td width="41%" class="lbltxtarea" align="right"><label class="boldlabel">Canonical Location(URL) <span style="color: red;"></span></label></td>
              <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.canonicalurl',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
          </tr>
    </table>


    <table cellspacing="5" cellpadding="0" align="center" style="float:left; width:935px;">
      <tr>
        <td>Site Verification</td>
      </tr>
      <!--<tr>
          <td class="lbltxtarea" align="right"><label class="boldlabel">Google Site Verification<span style="color: red;"></span></label></td>
          <td><span class="intpSpan"><?php // echo $form->input('Project.meta_gsverification',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
          <td><img src="/img/google.gif"></td>
          </tr>
          <tr>-->
                  <td class="lbltxtarea" align="right"><label class="boldlabel">Google Meta Tag<span style="color: red;"></span></label></td>
                      <td ><span class="intpSpan"><?php echo $form->text('Project.google_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
                       </td>
          <td><a href="http://www.google.com/webmasters/" target="_blank"><img src="/img/google.gif"></a></td>
              </tr>
          <tr>
          <!--<tr>
          <td class="lbltxtarea" align="right"><label class="boldlabel">Yahoo Site Verification<span style="color: red;"></span></label></td>
          <td ><span class="intpSpan"><?php // echo $form->input('Project.meta_y_key',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
          <td><img src="/img/yahoo.gif"></td>
        
          </tr>-->
          <tr>
                  <td class="lbltxtarea" align="right"><label class="boldlabel">Yahoo Meta Tag<span style="color: red;"></span></label></td>
                      <td ><span class="intpSpan"><?php echo $form->text('Project.yahoo_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
                       <td><img src="/img/yahoo.gif"></td>
              </tr>
          <!--<tr>
          <td class="lbltxtarea" align="right"><label class="boldlabel">Bing Site Verification<span style="color: red;"></span></label></td>
          <td><span class="intpSpan"><?php echo $form->input('Project.meta_msvalidate',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
          <td><img src="/img/bing.gif"></td>
      
          </tr>-->
          <tr>
                  <td class="lbltxtarea" align="right"><label class="boldlabel">Bing Meta Tag<span style="color: red;"></span></label></td>
                      <td ><span class="intpSpan"><?php echo $form->text('Project.bing_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
                       <td><img src="/img/bing.gif"></td>
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


      <table cellspacing="10" cellpadding="0" align="center" width="921px">
        <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Google Maps<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.googlemapskey',array('style'=>'width:650px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
          <td><img src="/img/google.gif"></td>
        </tr>
        <tr>
          <td width="30%" valign="top"  align="right"><label class="boldlabel">Facebook <span style="color: red;"></span></label></td>
          <td width="70%">
              <table cellpadding=0 cellspacing=0 border=0>
                  <tr>
                    <td class="lbltxtarea" align="right">App ID/API Key<span style="display:inline-block;width:16px"></span></td>
                    <td class="lbltxtarea" align="right"><span class="intpSpan"><?php echo $form->text('Project.facebookappkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
                    <td rowspan="2"><span>&nbsp;&nbsp;&nbsp;<img src="/img/facebook.gif"></span></td>
                    
                  </tr>
                  <tr>
                    <td class="lbltxtarea">App Secret Key<span style="display:inline-block;width:16px"></span></td>
                    <td valign="top"><span class="intpSpan"><?php echo $form->text('Project.facebooksecretkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
                  </tr>
              </table>
            
            </td>
            
          </tr>
          <tr>
              <td width="35%" class="lbltxtarea" align="right"><label class="boldlabel">Twitter <span style="color: red;"></span></label></td>
              <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.twitterkey',array('style'=>'width:650px','class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
              <td><img src="/img/twitter.gif"></td>    
              </tr>

          </table>
      </fieldset>
      <fieldset style="border: 1px solid rgb(204, 204, 204); padding: 10px;">
          <legend style="color: #4d4d4d; font-weight: bold; padding: 0pt 5px;">Mail Settings</legend>
            <table cellspacing="10" cellpadding="0" align="center" width="415px">
              <tr>
                  <td width="35%" class="lbltxtarea" align="right"><label class="boldlabel">From Email <span style="color: red;"></span></label></td>
                      <td width="70%"><span class="intpSpan"><?php echo $form->text('Project.fromemail',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
              </tr>
              <tr>
                  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">From Name<span style="color: red;"></span></label></td>
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
		document.getElementById("settingtabnew").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
    
    $('#sitemetakeyword').keyup(function() {
        var charLength = $(this).val().length;
        // Displays count
        $('span#charCount_sitemetakeyword').html(charLength + ' of 100 characters used');
        // Alerts when 250 characters is reached
        if($('#sitemetakeyword').val().length > 100)
        $('span#charCount_sitemetakeyword').html('<strong>Recommended 100 characters.</strong>');
        }); 


    $('#sideadesc').keyup(function() {
        var charLength = $(this).val().length;
        // Displays count
        $('span#charCount_sideadesc').html(charLength + ' of 150 characters used');
        // Alerts when 250 characters is reached
        if($('#sideadesc').val().length > 150)
        $('span#charCount_sideadesc').html('<strong>Recommended 150 characters.</strong>');
        }); 
    
    
</script>
