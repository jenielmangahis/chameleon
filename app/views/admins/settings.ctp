<!-- Body Panel starts -->
<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
?>
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>	
</div>
<?php 
	echo $form->create("Admins", array("action" => "settings",'name' => 'settings', 'id' => "settings","enctype"=>'multipart/form-data')); 
	echo $form->hidden('Project.facebookkey',array('value'=>''));
?>


<span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>&nbsp;</span>  
<span class="titlTxt">
Settings
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>projectdashboard')"><span> Cancel</span></button></li>
</ul>
</div>

 <?php    $this->loginarea="admins";    $this->subtabsel="settings";
                    echo $this->renderElement('setting_submenus');  ?> 

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
			  <td width="70%"><span class="intpSpan"><?php  echo $form->file('Project.favoriteicon',array('id'=> 'favicon',"class" => "inpt_txt_fld"));?></span></td>
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
          <i style="font-size: 11px;">(Recommended 150 characters)</i>
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
						  <span class="newtxtArea_bot"><?php echo $form->textarea('Project.sitemetakeyword',array('id'=>'sitemetakeyword','cols' => '31', 'rows' => '2',"class" => "noBg",'div'=>false,'label'=>false,'style'=>'width:230px','onkeypress'=>'check_char(100)')); ?></span></span>
                          <span id="charCount_sitemetakeyword"></span>
                          </td>
		  </tr>
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Google Analytics <span style="color: red;"></span></label></td>
			  <td width="70%">
				  <span class="intpSpan"><?php echo $form->input('Project.googleanalytics',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span>
			  </td>
			 <td><a href="http://www.google.com/analytics/" target="_blank"><img src="/img/google.gif"></a></td>
		  </tr>
	  <tr>
		  <td width="70%" class="lbltxtarea" align="right"><label class="boldlabel">Canonical Location(URL)<span style="color: red;"></span></label></td>
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
		  <td><a href="http://www.google.com/webmasters/" target="_blank"><img src="/img/google.gif"></a></td>
		  </tr>-->
          <tr>
                  <td class="lbltxtarea" align="right"><label class="boldlabel">Google Meta Tag<span style="color: red;"></span></label></td>
                      <td ><span class="intpSpan"><?php echo $form->text('Project.google_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
                       <td><a href="http://www.google.com/webmasters/" target="_blank"><img src="/img/google.gif"></a></td>
              </tr>
		  <!--<tr>
		  <td class="lbltxtarea" align="right"><label class="boldlabel">Yahoo Site Verification<span style="color: red;"></span></label></td>
		  <td ><span class="intpSpan"><?php // echo $form->input('Project.meta_y_key',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
		  <td><a href="http://siteexplorer.search.yahoo.com/" target="_blank"><img src="/img/yahoo.gif"></a></td>
		
		  </tr>-->
          <tr>
                  <td class="lbltxtarea" align="right"><label class="boldlabel">Yahoo Meta Tag<span style="color: red;"></span></label></td>
                      <td ><span class="intpSpan"><?php echo $form->text('Project.yahoo_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
                       <td><a href="http://siteexplorer.search.yahoo.com/" target="_blank"><img src="/img/yahoo.gif"></a></td>
              </tr>
          
		  <!--<tr>
		  <td class="lbltxtarea" align="right"><label class="boldlabel">Bing Site Verification<span style="color: red;"></span></label></td>
		  <td><span class="intpSpan"><?php echo $form->input('Project.meta_msvalidate',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
		  <td><a href="http://www.bing.com/toolbox/webmaster/" target="_blank"><img src="/img/bing.gif"><a></a></td>
	  
		  </tr>-->
          <tr>
                  <td class="lbltxtarea" align="right"><label class="boldlabel">Bing Meta Tag<span style="color: red;"></span></label></td>
                      <td ><span class="intpSpan"><?php echo $form->text('Project.bing_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
                       <td><a href="http://www.bing.com/toolbox/webmaster/" target="_blank"><img src="/img/bing.gif"><a></a></td>
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
		  <td><a href="http://www.google.com/local/add?hl=en&gl=us" target="_blank"><img src="/img/google.gif"></a></td>
		</tr>
		<tr>
		  <td width="30%" valign="top"  align="right"><label class="boldlabel">Facebook <span style="color: red;"></span></label></td>
		  <td width="70%">
			  <table cellpadding=0 cellspacing=0 border=0>
				  <tr>
					<td class="lbltxtarea" align="right">App ID/API Key<span style="display:inline-block;width:16px"></span></td>
					<td class="lbltxtarea" align="right"><span class="intpSpan"><?php echo $form->text('Project.facebookappkey',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
					<td rowspan="2"><span>&nbsp;&nbsp;&nbsp;<a href="http://developers.facebook.com/" target="_blank"><img src="/img/facebook.gif"></a></span></td>
					
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
			  <td><a href="https://dev.twitter.com/" target="_blank"><img src="/img/twitter.gif"></a></td>	
			  </tr>

		  </table>
	  </fieldset>
      
      <!--<fieldset style="border: 1px solid rgb(204, 204, 204); padding: 10px;">
          <legend style="color: #4d4d4d; font-weight: bold; padding: 0pt 5px;">Add a meta tag to your site's home page</legend>
            <table cellspacing="10" cellpadding="0" align="center" width="415px">
              <tr>
                  <td width="35%" class="lbltxtarea" align="right"><label class="boldlabel">Google <span style="color: red;"></span></label></td>
                      <td width="70%"><span class="intpSpan"><?php //echo $form->text('Project.google_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
              </tr>
              <tr>
                  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Yahoo<span style="color: red;"></span></label></td>
                      <td width="70%"><span class="intpSpan"><?php // echo $form->text('Project.yahoo_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
              </tr>        
              <tr>
                  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Bing<span style="color: red;"></span></label></td>
                      <td width="70%"><span class="intpSpan"><?php //echo $form->text('Project.bing_metatag',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false,'style'=>'width:650px;')); ?></span></td>
              </tr>        
            </table>
        </fieldset>-->
      
      
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
		document.getElementById("newsetttab").style.paddingTop = '24px';
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
