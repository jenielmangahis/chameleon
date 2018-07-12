<?php
   echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
      //echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
    echo $javascript->link('datetimepicker/timepicker_plug/jquery.timepicker.js');
		echo $javascript->link('facebox.js');
	    echo $html->css('facebox.css','stylesheet');



	echo $javascript->link('colorpicker/js/eye.js');
		echo $javascript->link('colorpicker/js/colorpicker.js');
		echo $javascript->link('colorpicker/js/utils.js');
		echo $javascript->link('colorpicker/js/layout.js?ver=1.0.2');
		
		 echo $javascript->link('yetii.js');
?>

	<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
	<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">


	
	<link rel="stylesheet" type="text/css" href="/js/colorpicker/css/colorpicker.css">

<script type="text/javascript">	
	





	
	 $(document).ready(function() {
    		//$("#tabs").tabs();
    		
    		$('#tabs').tabs(  {
    	        selected: <?php echo $selectedtab; ?>,     // which tab to start on when page loads
    	        select: function(e, ui) {
    	            var t = $(e.target);
    	           
    	            // This gives a numeric index...
    	            //alert( "selected is " + t.data('selected.tabs') )
    	            // ... but it's the index of the PREVIOUSLY selected tab, not the
    	            // one the user is now choosing.  
    	            return true;

    	            // eventual goal is: 
    	            // ... document.location= extract-url-from(something); return false;
    	        }
    	});
    	    		
    		
  });


	function settabinfo(tbid){
		 $('#selectedtab').val(tbid);
		}


		/* <![CDATA[ */
			$(function() {
				$('#dateartrecievedBP').datetime({
					userLang : 'en',
					americanMode: false, 
								});	
				$('#dateartapprovalBP').datetime({
					userLang : 'en',
					americanMode: false, 
				});	
				$('#datearttochipcoBP').datetime({
					userLang : 'en',
					americanMode: false, 
				});	
				$('#dateartproofsponsorBP').datetime({
					userLang : 'en',
					americanMode: false, 
				});					
			});
			/* ]]> */
					
	


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
  <?php /*print_r($project);*/ $idns=$project['Project']['id'];?>
  
  <!-- div align="center" class="slider" id="toppanel" style="margin:0px;">
	<div id="panel">
			<div class="content clearfix">
				<h1>Welcome to Web-Kreation</h1>
				<h2>Sliding login panel Demo with jQuery</h2>		
				<p class="grey">You can put anything you want in this sliding panel: videos, audio, images, forms... The only limit is your imagination!</p>
				<h2>Download</h2>
				<p class="grey">To download this script go back to <a href="#." title="Download">article &raquo;</a></p>
			</div>
			
	</div> 

	
	<div class="tab">
		<ul class="login">
			<li id="toggle">
            <a id="open" class="open" href="#."><span>Click Here to Open Help Box</span></a>

				<a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>		
			</li>
		</ul> 
	</div>



</div-->

<!-- Body Panel starts -->
  <div class="titlCont">





<span class="titlTxt">
Edit Project Details
</span>
<div class="topTabs" style="height: 44px;">
<ul>
<li><a href="#."><span>Save</span></a></li>
<li><a href="#."><span>Apply</span></a></li>
<li><a href="#."><span>Cancel</span></a></li>
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear:both;">
	<?php echo $form->create("Company", array("action" => "editprojectdtl",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editprojectdtl', 'id' => "editprojectdtl"))?>
		
		<?php echo $form->hidden("selectedtab", array('id' => 'selectedtab')); ?>
<div id="tab-container-1">
	<ul id="tab-container-1-nav" class="topTabs2">
        <li><a href="#Detail"><span>Details</span></a></li>
        <li><a href="#Images"><span>Images</span></a></li>
		<li><a href="#Tracking"><span>Tracking</span></a></li>
		<!-- li><a href="#Themes"><span>Themes</span></a></li-->
		<li><a href="#ProjectType"><span>Controls</span></a></li>
		<li><a href="#Sponsor"><span>Sponsor</span></a></li>
		<li><a href="#Coinsetstab"><span>Coinsets</span></a></li>
		<li><a href="#Companiestab"><span>Companies</span></a></li>
		<li><a href="#Contactstab"><span>Contacts</span></a></li>
		
		<?php //} ?>     
    </ul>
   
    
    <div class='newtab' id="Detail" style="padding-top: 58px;">
    
    <div class='left' style="width:915px;" >	
<div class="frmbox mgrt115">
<table cellspacing="5" cellpadding="0" align="center" width="425px" class='left'>
  <tbody>
    
    <tr>
      <td width="32%"><label class="boldlabel">Project Name:</label></td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"><?php echo $form->input("Project.project_name", array('id' => 'project_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
      
    </tr>
    <tr>
      <td><label class="boldlabel">Serial # Prefix:<span class="red">*</span></label></td>
      <td><label for="serialprefix"></label>
	<span class="intpSpan">
        <?php echo $form->input("Project.serialprefix", array('id' => 'serialprefix', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3"));?></span></td>
      
    </tr>
    <tr>
	
      <td><label class="boldlabel">Project Type:</label></td>
      <td>
	<span class="txtArea_top" style="width:0px">
<span class="txtArea_bot"><?php echo $form->select("project_type_id",$projectypedropdown,$selectedprojecttype,array('id' => 'project_type_id','disabled'=>'disabled'),"---Select---"); ?></span></span></td>
      	
    </tr>
    <tr>
      <td valign="top"><label class="boldlabel">Project Coinsets: </label></td>
      <td><span class="txtArea_top" style="width:0px">
<span class="txtArea_bot">
      <?php echo $form->select('coinsetsdisplay',$coinsetsdisplay, null,array('multiple'=>'multiple','id'=>'emaillists','empty'=>false,'style'=>'width:150px;','disabled'=>'disabled'));?></span></span></td> 
      </tr>
      <tr>
<td>&nbsp;</td>
	<td><span class="btnLft">
        <input type="button"  class="btnRht" value="View" name="view" ONCLICK="javascript:(window.location='/companies/coinsetlist')" /></span>
        &nbsp;&nbsp;

	<span class="btnLft">
        <input type="button"  class="btnRht" value="Add" name="Add" ONCLICK="javascript:(window.location='/companies/addcoinset')" /></span></td>
      </td>
    </tr>
    

    <tr>
      
     
      <td><label class="boldlabel">Website:</label></td>
      <td>
		<span class="intpSpan">
	<?php echo $form->input("Project.url", array('id' => 'url', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
    	 
    </tr>
    
     <tr>
      <td><label class="boldlabel">View Content Pages:</label></td>
      <td>	<span class="btnLft"><input type="button"  class="btnRht" value="View" name="view" ONCLICK="javascript:(window.location='/companies/contentlist')" /></td>
      
    </tr>
     <tr>
      <td valign="top"><label class="boldlabel">Notes:</label></td>
      <td><span class="txtArea_top">
<span class="txtArea_bot"><?php echo $form->textarea("Project.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg"));?></span></span></td>
      
    </tr>
<tr>
      <td valign="top"><label class="boldlabel">Registration with Confirmation:</label></td>
      <td><?php echo $form->input('Project.registration_confirmation', array('type'=>'checkbox', 'label' => '')); ?></td>
    </tr> 
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr><td colspan='2'>
    			 <span class="btnLft"><button type="submit" id="Submit" class="btnRht" onclick='settabinfo("0"); return validateprojectdetail("0"); '> Save </button>&nbsp;</span>
    		       <span class="btnLft"><button type="button" id="saveForm" class="btnRht"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button></span>
	
	</td></tr>
  </tbody>
</table>

</div>
<div class="frmbox">
<table class='left' width="425px">
				<tr>
					<td ><label class="boldlabel">Date Entered:</label></td>
		      		<td ><span class="intpSpan"><?php echo $form->text("Project.created", array('id' => 'created', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
		        </tr>
		        <tr>
					<td><label class="boldlabel"># of Units:</label></td>
      				<td><?php echo $form->hidden('Project.numunits',array('value'=>$totalnumunits));echo $totalnumunits; ?></td>
      			</tr>
		         <tr><td colspan='2'>&nbsp;</td></tr>
		        <tr>
					<td><label class="boldlabel">Sponsor:</label></td>
     				 <td><span class="intpSpan"><?php echo $form->input("sponsorname", array('id' => 'sponsorname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
		        </tr>
		        
		        <tr>
					<td valign="top"><label class="boldlabel">Company:</label></td>
			       <td>
			       <div >
			       <span class="txtArea_top" style="width:0px">
<span class="txtArea_bot"><?php echo $form->select('companies',$companies, null,array('multiple'=>'multiple','id'=>'companies','size'=>'7','empty'=>false,'style'=>'width:150px;','disabled'=>'disabled'));?></span></span>
			       </div>
			        <br />
			        <span class="btnLft"><input type="button" value="View"  class="btnRht" name="view" ONCLICK="javascript:(window.location='/companies/companylist')" /><span>
			        &nbsp;&nbsp;
			        <span class="btnLft"><input type="button" value="Add"   class="btnRht" name="Add"  ONCLICK="javascript:(window.location='/companies/addcompany')" /></span> </td>
		        </tr>
		         <tr><td colspan='2'>&nbsp;</td></tr>
		        <tr>
		        	<td valign="top"><label class="boldlabel">Contacts:</label></td>
					      <td>
					      <div style="width:186px; overflow:auto">
					      <?php echo $form->select('contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','empty'=>false,'style'=>'width:150px;','disabled'=>'disabled'));?></span>
					      </div>
					        <br />
					         <span class="btnLft"><input type="button"  class="btnRht" value="View" name="view" ONCLICK="javascript:(window.location='/companies/contactlist')" /></span>
					        &nbsp;&nbsp;
					        <span class="btnLft"><input type="button"  class="btnRht" value="Add" name="Add" ONCLICK="javascript:(window.location='/companies/addcontacts')" /></span></td>
					</tr>
		        
			</table>
			
	</div>
	</div>
	<div class='clear'></div>

    </div>
    
    
    <div class='newtab' id="Images" style="padding-top: 58px;">
    <div style="width:668px;" class="left">	
  <table cellspacing="5" cellpadding="0" align="center" width="600">
  <tbody>
   
    <tr>
      <td width="10%"  valign='top'><label class="boldlabel">Side A Image:</label></td>
      <td width="50%">
	<?php  echo $form->file('Project.coinsidea',array('id'=> 'sidea',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250 pixels</span><br>
		      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>
			 <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Click over the image for Original view.</span>
      <br />&nbsp; <?php if($this->data['Project']['sidea'] !=''){  ?> <a href="#divimagecoina" rel='coinb' title='Click here to view Full view.'><img style="width:107px; height:109px;" src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sidea']; ?>"></a> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/sideA.png'><?php } ?>
       <span style='display: none;' id="divimagecoina">
	  		<div align='center'><img src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sidea']; ?>"></div>
	  		</span>
	</td>

      <td width="10%"  valign='top'> <label class="boldlabel">Side A Description:</label></td>
      <td width="30%" valign='top'><span class="txtArea_top">
<span class="txtArea_bot">
<?php echo $form->textarea("Project.sideadesc", array('id' => 'sideadesc', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg"));?></div></div></td>
      <tr>
      
    <tr>
      <td  valign='top'><label class="boldlabel">Side B Image:</label></td>
       <td><?php  echo $form->file('Project.coinsideb',array('id'=> 'sideb',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250 pixels</span><br>
	<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>

      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Click over the image for Original view.</span>
       <br />&nbsp; <?php if($this->data['Project']['sideb'] !=''){  ?> <a href="#divimagecoinb" rel='coinb' title='Click here to view Full view.'><img style="width:107px; height:109px;" src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sideb']; ?>"></a> <?php }else { ?><img src='/img/<?php echo $project_name; ?>/sideB.png'><?php } ?>
 <span style='display: none;' id="divimagecoinb">
	  		<div align='center'><img src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sideb']; ?>"></div>
	  		</span>
</td>
 
      <td  valign='top'> <label class="boldlabel">Side B Description:</label></td>
      <td><span class="txtArea_top">
<span class="txtArea_bot"><?php echo $form->textarea("Project.sidebdesc", array('id' => 'sidebdesc', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg"));?></span></span></td>
       </tr>
    
    <tr>
      <td  valign='top'><label class="boldlabel">Edge Image:</label></td>
       <td valign='top'><?php  echo $form->file('Project.coinedge',array('id'=> 'coinedge',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 300x12.</span>
       <br />&nbsp; <?php if($this->data['Project']['edge'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['edge']; ?>" style=" max-width: 270px"> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/noimage.png' style=" max-width: 270px"><?php } ?></td>
 
      <td  valign='top'>
      <label class="boldlabel">Edge Description:</label></td>
      <td>  <span class="txtArea_top">
<span class="txtArea_bot">   <?php echo $form->textarea("Project.edgedesc", array('id' => 'edgedesc', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg"));?></span></span></td>
       </tr>
    <tr>
      <td valign="top"><label class="boldlabel">Serial on side</label></td>
      <td><span class="txtArea_top" style="width:0px;">
<span class="txtArea_bot"><?php echo $form->select("Project.serialdisplayside",array("A"=>"Side A","B"=>"Side B"),$serialdisplayside,array('label'=>'','id' => 'serialdisplayside','style'=>'width:200px; border:1px solid #BEDAE5;'),false); ?></span></span></td>
       <td></td>
 	<td></td>
    </tr>
    <tr>
     <td  valign='top'><label class="boldlabel">Project Logo/Header:</label></td>
      <td><?php  echo $form->file('Project.coinlogo',array('id'=> 'logo',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 960x92.</span><br>
			      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>

      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Click over the image for Original view.</span>
       <br />&nbsp; <?php if($this->data['Project']['logo'] !=''){  ?> <a href="#divimageview" rel='uploadedlogo' title='Click here to view Full view.'><img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['logo']; ?>" style="max-height: 92px; max-width: 270px" ></a> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/nologo.jpg'><?php } ?>
	<span style='display: none;' id="divimageview">
	  		<div align='center'><img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['logo']; ?>"></div>
	  		</span>
</td>
      
			<span style='display: none;' id="divimageview">
	  		<div align='center'><img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['logo']; ?>"></div>
	  		</span>
      
    
      <td></td>
      <td></td>
   
    </tr>
    
    <tr><td colspan='4'>&nbsp;</td></tr>
    <tr><td colspan='4'>
  			 <span class="btnLft">
    			 <button type="submit" id="Submit" class="btnRht" onclick='settabinfo("1"); return validateprojectdetail("1"); '> Save </button></span>&nbsp;
    		   <span class="btnLft"><button type="btnRht" id="saveForm" class="btnRht"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button></span>
    		
	</td></tr>
  </tbody>
</table>
</div>
<div class='clear'></div>

    </div>
    
    
    
    
    <div class='newtab' id="Tracking" style="padding-top: 58px;">
    <div style="width:668px;" class="left">	 
    
    
    <table cellspacing="10" cellpadding="0" align="center" width="633px">
							<tbody>
							
							<tr>
							<td><label class="boldlabel" style='font-size:10px;'>Artwork Received:</label></td>
							<td><span class="intpSpan">
							<?php echo $form->text("Project.dateartrecieved", array('id' => 'dateartrecieved', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'style'=>'width:133px','readonly'=>'readonly'));?></span>  &nbsp; <input type="button" class="calendarcls" id="dateartrecievedBP"></td>
							<td></td>
							<td><label class="boldlabel" style='font-size:10px;'>Artwork Approval:</label></td>
							<td><span class="intpSpan"><?php echo $form->text("Project.dateartapproval", array('id' => 'dateartapproval', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'style'=>'width:133px','readonly'=>'readonly'));?> </span> &nbsp; <input type="button" class="calendarcls" id="dateartapprovalBP"></td>
							</tr>
							<tr>
							<td><label class="boldlabel" style='font-size:10px;'>Artwork to Chipco:</label></td>
							<td><span class="intpSpan"><?php echo $form->text("Project.datearttochipco", array('id' => 'datearttochipco', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'style'=>'width:133px','readonly'=>'readonly'));?></span>  &nbsp; <input type="button" class="calendarcls" id="datearttochipcoBP"></td>
							<td></td>
							<td><label class="boldlabel" style='font-size:10px;'>Chipco Start Date:</label></td>
							<td><span class="intpSpan"><?php echo $form->text("Project.dateartproofsponsor", array('id' => 'dateartproofsponsor', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'style'=>'width:133px','readonly'=>'readonly'));?><span class="intpSpan">  &nbsp; <input type="button" class="calendarcls" id="dateartproofsponsorBP"></td>
							</tr>
							
							
							<tr><td colspan='5'>&nbsp;</td></tr>
							<tr><td colspan='5'>
										<span class="btnLft">
										<button type="submit" id="Submit" class="btnRht" onclick='settabinfo("2")'> Save </button></span>&nbsp;
									<span class="btnLft"><button type="button" id="saveForm" class="btnRht" ONCLICK="javascript:(window.location='/companies/index')"> Cancel </button></span>
									
								</td></tr>
							</tbody>
						</table>
    
    </div>
<div class='clear'></div>

    </div>
    
    
    
    
    <div class='newtab' id="ProjectType" style="padding-top: 58px;">
    <div style="width:715px;" class="left">
    
    <table width="712px" align="center" cellpadding="1" cellspacing="1">
							<tr>
								<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
													echo $form->error('ProjectType.project_type_name', array('class' => 'errormsg'));
												echo $form->hidden("ProjectType.id", array('id' => 'typeid'));
											?></td>
							</tr>
							<tr><td><!--<label class="boldlabel">Project Type <span style="color:red">*</span></label>--></td>
									<td><?php echo $form->hidden("ProjectType.project_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></td>
							</tr>

							<tr><td valign='top'><!--<label class="boldlabel">Note </label>--></td>
									<td><?php echo $form->hidden("ProjectType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inpt_txt_fld"));?></td>
							</tr>
								<tr><td><label class="boldlabel">Registration with Coin # Required?</label></td>
										<td colspan="2"><?php echo $form->input('ProjectType.coin_verification', array('type'=>'checkbox', 'label' => '')); ?></td>
							</tr>

							<tr>
								<td valign="top"><label class="boldlabel">Registration with Confirmation:</label></td>
								<td><?php echo $form->input('Project.registration_confirmation', array('type'=>'checkbox', 'label' => '')); ?></td>
								</tr>  
							
								
								<tr><td width="288px"><label class="boldlabel">Coins Held By Multiple Holders ?</label></td>
										<td colspan="2"><?php echo $form->input('ProjectType.istransferable', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
							</tr>
								<tr><td><label class="boldlabel">Simple Coin Transfer</label></td>
										<td colspan="2"><?php echo $form->input('ProjectType.simple_cointransfer', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
							</tr>
								
								<tr><td><label class="boldlabel">RegistrationBox on Home page</label></td>
										<td colspan="2"><?php echo $form->input('ProjectType.registrationbox_verification', array('type'=>'checkbox', 'label' => '')); ?></td>
							</tr>
							<tr><td><label class="boldlabel">Show Coins Under Register Box:</label></td>
										<?php if($this->data['Project']['is_showcoins']==1){?>
										<td colspan="2"><?php echo $form->input('Project.is_showcoins', array('type'=>'checkbox', 'label' => '','value'=>'1','checked'=>'checked')); ?>

										<?php }else{ ?>
										
										<td colspan="2"><?php echo $form->input('Project.is_showcoins', array('type'=>'checkbox', 'label' => '','value'=>'1')); ?>
										<?php }?>
										</td>
								</tr>
								<tr><td><label class="boldlabel">Show Comments Navigation Button</label></td>
										<td colspan="2"><?php echo $form->input('ProjectType.showcommentbutton', array('type'=>'checkbox', 'label' => '')); ?></td>
							</tr>
								<tr><td><label class="boldlabel">Show Comments to everyone</label></td>
										<td colspan="2"><?php echo $form->input('ProjectType.iscommentpublic', array('type'=>'checkbox', 'label' => '')); ?></td>
							</tr>
							<tr><td><label class="boldlabel">Suggested Comment Types<!--Maximum # of comments per Holder--></label></td>
										<td colspan="2" align="center"><?php
										App::import("Model", "CommentType");
										$this->CommentType =   & new CommentType();


										$maxnumbercomment= $this->CommentType->find('count',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0'", 'order' =>"id"));

										$maxcomarr=array();
										for($j=1;$j<$maxnumbercomment;$j++)
										$maxcomarr[$j]=$j;
							?>
							</td></tr>
							<tr><td>&nbsp;</td><td>
													<?php
										echo $form->select("ProjectType.maxnumbercomment",$maxcomarr,$selectedend_after,array('id' => 'maxnumbercomment','style'=>'width:40px','onchange'=>'hidetextboxes()'),false); ?>
									</td></tr>
									<tr><td>&nbsp;</td>
										<td colspan="2" style="height:200px;">
										<?php
										App::import("Model", "CommentType");
										$this->CommentType =   & new CommentType();

										$i=0;
										$commenttypedata = $this->CommentType->find('all',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0' and CommentType.project_id=$idns", 'order' =>"id"));
										$commenttypedropdown = Set::combine($commenttypedata, '{n}.CommentType.id', '{n}.CommentType.comment_type_name');

										//foreach($commenttypedata as $eachrow){
										$i++;
											App::import("Model", "ProjectCommentType");
											$this->ProjectCommentType =   & new ProjectCommentType();

											$comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>"ProjectCommentType.project_type_id=$ProjectTypeId and ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));
											echo $form->input("ProjectType.commenttype".$i, array('id' => 'commenttype'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:20px","maxlength" => "3",'value'=>$i));
											echo $form->select("ProjectType.commenttypeoption".$i,$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'commenttypevalue'.$i, 'div' => false, 'label' => ''),array('0'=>'--Select--'));
											echo "<br/>";
										//}
										?></td>
							</tr>
							<tr><td><label class="boldlabel">Additional Comments allowed:</label></td>
										<td width="70px"><?php echo $form->input('ProjectType.additional_comment', array('type'=>'checkbox', 'label' => '','div'=>false,'onclick'=>'show_value()'));?>
											</td>
								<td>
								<?php 
										
											App::import("Model", "ProjectCommentType");
											$this->ProjectCommentType =   & new ProjectCommentType();

											$comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>"ProjectCommentType.project_type_id=$ProjectTypeId and ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));

											echo $form->select("additionalcomment",$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'additionalcomment'.$i, 'div' => false, 'label' => ''),array('0'=>'--Select--'));
								
										?>
								<?php //echo $form->select("additionalcomment",array('0'=>'Misc.Additional Comment'),0,array('id' => 'additionalcomment'),false); ?></td>
							</tr>
								<tr><td><label class="boldlabel">RSVP Required</label></td>
										<td colspan="2"><?php echo $form->input('ProjectType.is_rsvp', array('type'=>'checkbox', 'label' => '')); ?></td>
							
							<tr><td><!--<label class="boldlabel">Default Delivery Days After Order Date</label>--></td>
										<td colspan="2"><?php echo $form->hidden("ProjectType.defaultdeliverydays", array('id' => 'defaultdeliverydays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3"));?></td>
							</tr>
								<!-- ADD FIELD EOF -->
								<!-- BUTTON SECTION BOF -->
							<tr><td colspan="3">&nbsp;</td></tr>

							<tr><td>&nbsp;</td>
							<td colspan="2">
							<span class="btnLft">
							<button type="submit" id="Submit" class="btnRht" onclick='settabinfo("4")'> Submit </button></span>&nbsp;<span class="btnLft"><button type="button" id="saveForm" class="btnRht" ONCLICK="javascript:(window.location='/admins/projecttype')"> Cancel </button></span>
							</td></tr>
						</table>
					</div>

					
<div class='clear'></div>

    </div>
    
    
    
    <div class='newtab' id="Sponsor" style="padding-top: 58px;">
    <div style="width:715px;" class="left">
    
    <table width="712px" align="center" cellpadding="1" cellspacing="1">
							<?php echo $form->hidden('Sponsor.user_id',array('value'=>$userid)) ?>
							<?php echo $form->hidden("Sponsor.id",array('value'=>$spondtl['Sponsor']['id'])) ?>
							<tr>
								<td width=""><label class="boldlabel">Sponsor Name: <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
									<?php echo $form->hidden("Sponsor.id",array('value'=>$spondtl['Sponsor']['id'])) ?>
									<span class="intpSpan"><?php echo $form->input("Sponsor.sponsor_name", array('id' => 'sponsor_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'value'=>$spondtl['Sponsor']['sponsor_name']));?></span></td>
								<td rowspan="10">
									<table class='left' width="361px">
										<tr>
											<td  valign='top'><label class="boldlabel">Company:</label></td>
											<td>
												<div style="width:186px; overflow:auto">
													<span class="txtArea_top">
													<span class="txtArea_bot"><?php echo $form->select('Sponsor.companies',$companies, null,array('multiple'=>'multiple','id'=>'companies','size'=>'7','empty'=>false,'style'=>'width:186px;'));?></span></span>
												</div>
												<?php if($spondtl['Sponsor']['id']==0) { ?>
													<br />
													<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added companies</span>
													<br />
													<span class="btnLft"><input type="button" value="View" class="btnRht" name="view" ONCLICK="viewcompanys()" /></span>
													&nbsp;&nbsp;
													<span class="btnLft"><input type="button" value="Add" name="Add" class="btnRht" ONCLICK="copycompanys()"  /></span>
													<br/>
													<?php echo $form->select('companies1',$companies1, null,array('multiple'=>'multiple','id'=>'companies1','size'=>'7','empty'=>false,'style'=>'width:186px;display:none;'));?>      
												<?php }?>  
											</td>
										</tr>
										<tr>
										<tr><td colspan='2'>&nbsp;</td></tr>
											<td  valign='top'><label class="boldlabel">Contacts:</label></td>
											<td>
												<div style="width:186px; overflow:auto">
													<span class="txtArea_top">
													<span class="txtArea_bot"><?php echo $form->select('Sponsor.contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','empty'=>false,'style'=>'width:186px;'));?></span></span>
												</div>
												<?php if($spondtl['Sponsor']['id']==0) { ?>
													<br />
													<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added contacts</span>
													<br />
													<span class="btnLft"><input type="button" value="View" class="btnRht" name="view" ONCLICK="viewcontact()" /></span>
													&nbsp;&nbsp;
													<span class="btnLft"><input type="button" value="Add" name="Add" class="btnRht" ONCLICK="copycontact()"  /></span>
													<br/>			
												<?php }?><span id="gridTable"></span>
											</td>
										</tr>
										<tr><td colspan='2'>&nbsp;</td></tr>
									</table>
								</td>
							</tr>
								
							<tr>
								<td width=""><label class="boldlabel">Sponsor Email: <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'value'=>$spondtl['Sponsor']['email']));?></span></td>
								
							</tr>
								
							<tr>
								<td width=""><label class="boldlabel">Address 1: <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$spondtl['Sponsor']['address1']));?></span></td>
								
							</tr>
								
							<tr>
								<td width=""><label class="boldlabel">Address 2:</label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$spondtl['Sponsor']['address2']));?></span></td>
								
							</tr>
								
							<tr>
								<td width=""><label class="boldlabel">Country : <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
									<?php echo $form->select("Sponsor.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'width:186px','onchange'=>'return getstates(this.value,"Sponsor")'),"---Select---"); ?></td>
								
							</tr>
								
								
							<tr>
								<td width=""><label class="boldlabel">State : <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
									<span id="statediv"><?php echo $form->select("Sponsor.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'width:186px'),"---Select---"); ?></span></td>
								
							</tr>
								
							<tr>
								<td width=""><label class="boldlabel">City : <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
									<?php echo $form->input("Sponsor.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'value'=>$spondtl['Sponsor']['city'])); ?></td>
								
							</tr>
								
							<tr>
								<td width=""><label class="boldlabel">Zip/Postal Code : <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10",'value'=>$spondtl['Sponsor']['zipcode']));?></span></td>
								
							</tr>
							<tr><td colspan='2'>&nbsp;</td></tr>
							<tr>
								<td  valign='top'><label class="boldlabel">Sponsor Logo:</label></td>
								<td><?php  echo $form->file('Sponsor.sponlogo',array('id'=> 'logo',"class" => "inpt_txt_fld"));?><br>
								<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250 Pixels</span>
										      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>

								<br /><br />&nbsp; <?php if($spondtl['Sponsor']['logo'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$spondtl['Sponsor']['logo']; ?>"> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/nologo.jpg'><?php } ?></td>
												
							</tr>
							<tr><td colspan='2'>
								<span class="btnLft"><button type="submit" id="Submit" class="btnRht" onclick='settabinfo("5");'> Save </button></span>&nbsp;
								
								<span class="btnLft"><button type="button" id="saveForm" class="btnRht" ONCLICK="javascript:(window.location='/companies/index')"> Cancel </button>
									</span>
								</td>
							</tr>
						</table>
    
    
    </div>
<div class='clear'></div>

    </div>
    
    
    
    <div class='newtab' id="Coinsetstab" style="padding-top: 58px;">
    <div style="width:715px;" class="left">
    
    Coinsetstab tab
    
    
    </div>
<div class='clear'></div>

    </div>
    
    
    
    
    <div class='newtab' id="Companiestab" style="padding-top: 58px;">
    <div style="width:715px;" class="left">
    
    Companiestab tab
    
    
    </div>
<div class='clear'></div>

    </div>
    
    
    
    <div class='newtab' id="Contactstab" style="padding-top: 58px;">
    <div style="width:715px;" class="left">
    
    Contactstab tab
    
    
    </div>
<div class='clear'></div>

    </div>
    
    
    <!-- main tab -->
    </div>
    
    <?php echo $form->end();?>
</div>

<div class='clear'></div>
</div>
<div class="midPadd">
	
		<div class="top-bar" style="border-left:0px;">

		</div><br />


</div>
<div class="clear"></div>
<div class="gryBot">
	 <script type="text/javascript">
var tabber1 = new Yetii({
id: 'tab-container-1'
});
</script> 
	</div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 


