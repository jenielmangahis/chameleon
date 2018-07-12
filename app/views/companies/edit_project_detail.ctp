
<?php
   echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
   echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
   //echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
   echo $javascript->link('datetimepicker/timepicker_plug/jquery.timepicker.js');
?>

<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">


<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				  $('#dateartrecieved').datetime({
									  userLang : 'en',
									  americanMode: false, 
								});	
				  $('#dateartapproval').datetime({
					  userLang : 'en',
					  americanMode: false, 
				});	
				  $('#datearttochipco').datetime({
					  userLang : 'en',
					  americanMode: false, 
				});	
				  $('#dateartproofsponsor').datetime({
					  userLang : 'en',
					  americanMode: false, 
				});					
			});
	/* ]]> */
	
	
	
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
	</script> 
<!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p>
  <div class="boxBor">
  <div class="boxPad">
  <?php echo $this->element("leftmenubar");?>  
   <p>&nbsp;</p>
  </div>
  </div><p class="boxBot">
 <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
  </div>
    <div class="bdyCont">
  <div class="boxBg1">
  <p class="boxTop1"><!--<img src="/img/<?php echo $project_name?>/rhtBox_top.gif" alt="" class="right" />--></p>
  <div class="boxBor1">
  <div class="boxPad1">
    <h2> Edit Project Detail</h2>  
<b>Any item with a</b>"<span class="red">*</span>"<b>requires an entry.</b>
<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
	 <div><p>&nbsp;</p></div>	
 <div><p>&nbsp;</p></div>	
		<!-- ADD Sub Admin FORM BOF -->
		 <!-- ADD FIELD BOF -->
		<?php echo $form->create("Company", array("action" => "edit_project_detail",'type' => 'file','enctype'=>'multipart/form-data','name' => 'edit_project_detail', 'id' => "edit_project_detail"))?>
		
		<?php echo $form->hidden("selectedtab", array('id' => 'selectedtab')); ?>		
<div id="tabs">
	
    <ul>
        <li><a href="#Detail"><span>Detail</span></a></li>
        <li><a href="#Images"><span>Images</span></a></li>
        <li><a href="#Tracking"><span>Tracking</span></a></li>
    </ul>
    <div id="Detail">
       <table cellspacing="10" cellpadding="0" align="center" width="100%">
  <tbody>
    
    <tr>
      <td width="20%"><label class="boldlabel">Project Name:</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Project.project_name", array('id' => 'project_name', 'div' => false, 'label' => '',"class" => "inptBox","maxlength" => "200",'readonly'=>'readonly'));?></td>
      <td>&nbsp;</td>
      <td width="20%"><label class="boldlabel">Date Entered:</label></td>
      <td width="30%"><?php echo $form->text("createddate", array('id' => 'created', 'div' => false, 'label' => '',"class" => "inptBox","maxlength" => "200",'readonly'=>'readonly'));?></td>
    </tr>
    <tr>
      <td><label class="boldlabel">Serial # Prefix: <span class="red">*</span></label></td>
      <td><label for="serialprefix"></label>
        <?php echo $form->input("Project.serialprefix", array('id' => 'serialprefix', 'div' => false, 'label' => '',"class" => "inptBox","maxlength" => "3"));?></td>
      <td>&nbsp;</td>
      <td><label class="boldlabel"># of Units:</label></td>
      <td><?php echo $form->hidden('Project.numunits',array('value'=>$totalnumunits));
      	echo $totalnumunits; ?></td>
    </tr>
    <tr>
      <td><label class="boldlabel">Project Type:</label></td>
      <td><?php echo $form->select("project_type_id",$projectypedropdown,$selectedprojecttype,array('id' => 'project_type_id','disabled'=>'disabled'),"---Select---"); ?></td>
      <td></td>
      <td><label class="boldlabel">Sponsor:</label></td>
      <td><?php echo $form->input("sponsorname", array('id' => 'sponsorname', 'div' => false, 'label' => '',"class" => "inptBox","maxlength" => "200",'readonly'=>'readonly'));?></td>
    </tr>
    <tr>
      <td valign="middle"><label class="boldlabel">Project Coinsets: </label></td>
      <td>
      <?php echo $form->select('coinsetsdisplay',$coinsetsdisplay, null,array('multiple'=>'multiple','id'=>'emaillists','size'=>'10','empty'=>false,'style'=>'width:186px;','disabled'=>'disabled'));?> 
      
      	<?php //echo $form->textarea("coinsetsdisplay", array('id' => 'coinsetsdisplay', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inptBox",'readonly'=>'readonly'));?><br />
        <br />
        <input type="button" value="View"  class="btn"  name="view" ONCLICK="javascript:(window.location='/admins/coinsetlist')" />
        &nbsp;&nbsp;
        <input type="button" value="Add"  class="btn"  name="Add" ONCLICK="javascript:(window.location='/admins/addcoinset')" /></td>
      <td></td>
      <td><label class="boldlabel">Company:</label></td>
       <td>
       <?php echo $form->select('companies',$companies, null,array('multiple'=>'multiple','id'=>'companies','size'=>'10','empty'=>false,'style'=>'width:186px;','disabled'=>'disabled'));?>
       <?php //echo $form->textarea("companies", array('id' => 'companies', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inptBox",'readonly'=>'readonly'));?><br />
        <br />
        <input type="button" value="View"  class="btn"  name="view" ONCLICK="javascript:(window.location='/admins/companylist')" />
        &nbsp;&nbsp;
        <input type="button" value="Add"  class="btn"  name="Add"  ONCLICK="javascript:(window.location='/admins/addcompany')" /></td>
    </tr>
    

    <tr>
      <td><label class="boldlabel">Contacts:</label></td>
      <td>
      <?php echo $form->select('contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','empty'=>false,'style'=>'width:186px;','disabled'=>'disabled'));?>
      <?php //echo $form->textarea("contacts", array('id' => 'contacts', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inptBox",'readonly'=>'readonly'));?><br />
        <br />
        <input type="button" value="View"  class="btn"  name="view" ONCLICK="javascript:(window.location='/admins/contactlist')" />
        &nbsp;&nbsp;
        <input type="button" value="Add"  class="btn"  name="Add" ONCLICK="javascript:(window.location='/admins/addcontacts')" /></td>
      <td></td>
      <td><label class="boldlabel">Website:</label></td>
      <td><?php echo $form->input("Project.url", array('id' => 'url', 'div' => false, 'label' => '',"class" => "inptBox","maxlength" => "250"));?></td>
    </tr>
    
     <tr>
      <td><label class="boldlabel">View Content Pages:</label></td>
      <td><input type="button" value="View"   class="btn"  name="view" ONCLICK="javascript:(window.location='/admins/contentlist')" /></td>
      <td></td>
      <td><label class="boldlabel">Notes:</label></td>
      <td><?php echo $form->textarea("Project.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "inptBox"));?></td>
    </tr>
    
    <tr><td colspan='5'>&nbsp;</td></tr>
    <tr><td colspan='5'>
    			 <button type="submit" id="Submit" class="btn" onclick='settabinfo("0"); return validateprojectdetail("0"); '> Save </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/edit_project_desc')"> Go to Description Page </button>
    		
	</td></tr>
  </tbody>
</table>
    </div>
    
    
    <div id="Images">
    
        <table cellspacing="10" cellpadding="0" align="center" width="100%">
  <tbody>
   
    <tr>
      <td><label class="boldlabel">Side A Image:</label></td>
      <td><?php  echo $form->file('Project.coinsidea',array('id'=> 'sidea',"class" => "inptBox"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 107x109.</span>
      <br />&nbsp; <?php if($this->data['Project']['sidea'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['sidea']; ?>"> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/sideA.png'><?php } ?></td>    
      <td> <label class="boldlabel">Side A Description:</label></td>
      <td><?php echo $form->textarea("Project.sideadesc", array('id' => 'sideadesc', 'div' => false, 'label' => '','cols' => '22', 'rows' => '8',"class" => "inptBox"));?></td>
      <tr>
      
    <tr>
      <td><label class="boldlabel">Side B Image:</label></td>
       <td><?php  echo $form->file('Project.coinsideb',array('id'=> 'sideb',"class" => "inptBox"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 107x109.</span>
       <br />&nbsp; <?php if($this->data['Project']['sideb'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['sideb']; ?>"> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/sideB.png'><?php } ?></td>   
      <td> <label class="boldlabel">Side B Description:</label></td>
      <td><?php echo $form->textarea("Project.sidebdesc", array('id' => 'sidebdesc', 'div' => false, 'label' => '','cols' => '22', 'rows' => '8',"class" => "inptBox"));?></td>
       </tr>
    
    
    <tr>
     <td><label class="boldlabel">Project Logo:</label></td>
      <td><?php  echo $form->file('Project.coinlogo',array('id'=> 'logo',"class" => "inptBox"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 300x50.</span>
       <br />&nbsp; <?php if($this->data['Project']['logo'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['logo']; ?>"> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/nologo.jpg'><?php } ?></td>   
      <td><label class="boldlabel">Edge Description:</label></td>
      <td><?php echo $form->textarea("Project.edgedesc", array('id' => 'edgedesc', 'div' => false, 'label' => '','cols' => '22', 'rows' => '8',"class" => "inptBox"));?></td>
   
    </tr>
    
    <tr><td colspan='4'>&nbsp;</td></tr>
    <tr><td colspan='4'>
  
    			 <button type="submit" id="Submit" class="btn" onclick='settabinfo("1"); return validateprojectdetail("1"); '> Save </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/edit_project_desc')"> Go to Description Page </button>
    		
	</td></tr>
  </tbody>
</table>
    </div>
   

     <div id="Tracking">
        <table cellspacing="10" cellpadding="0" align="center" width="100%">
  <tbody>
   
     <tr>
      <td><label class="boldlabel">Artwork Received:</label></td>
      <td><?php echo $form->text("Project.dateartrecieved", array('id' => 'dateartrecieved', 'div' => false, 'label' => '',"class" => "inptBox",'readonly'=>'readonly'));?></td>
      <td></td>
      <td><label class="boldlabel">Artwork Approval:</label></td>
     <td><?php echo $form->text("Project.dateartapproval", array('id' => 'dateartapproval', 'div' => false, 'label' => '',"class" => "inptBox",'readonly'=>'readonly'));?></td>
    </tr>
    <tr>
      <td><label class="boldlabel">Artwork to Chipcol:</label></td>
      <td><?php echo $form->text("Project.datearttochipco", array('id' => 'datearttochipco', 'div' => false, 'label' => '',"class" => "inptBox",'readonly'=>'readonly'));?></td>
      <td></td>
      <td><label class="boldlabel">Chipco Start Date:</label></td>
      <td><?php echo $form->text("Project.dateartproofsponsor", array('id' => 'dateartproofsponsor', 'div' => false, 'label' => '',"class" => "inptBox",'readonly'=>'readonly'));?></td>
    </tr>
   
    
    <tr><td colspan='5'>&nbsp;</td></tr>
    <tr><td colspan='5'>
  
    			 <button type="submit" id="Submit" class="btn" onclick='settabinfo("2")';> Save </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/edit_project_desc')"> Go to Description Page </button>
    		
	</td></tr>
  </tbody>
</table>
    </div>
    <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:send href="http://192.168.1.225:8219/comments" font=""></fb:send>
</div>		
<?php echo $form->end();?>
<div class="clear"></div>
  </div>
  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 


