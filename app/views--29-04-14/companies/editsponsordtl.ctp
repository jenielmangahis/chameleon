<!-- Body Panel starts -->

  <div class="navigation">
  <div class="boxBg">
  <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p> -->
  <div class="boxBor">
  <div class="boxPad">
  <?php echo $this->element("leftmenubar");?>  


    <p>&nbsp;</p>
  </div>
  </div>
<!--<p class="boxBot">
 <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  -->
  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg">
  <!--<p class="boxTop"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
  <div class="boxB1or">
  <div class="boxPad">
    <h2>Edit Sponsor Detail </h2>
<b>Any item with a</b>"<span class="red">*</span>"<b>requires an entry.</b>. 

		
 <?php if($userid) { 
         		$act = "edit";
         	}
       	 echo $form->create("Companies", array("action" => "editsponsordtl",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editsponsordtl', 'id' => "editsponsordtl",'onsubmit'=>"return validatesponsordtl('$act');"))?>
		
		<table cellspacing="10" cellpadding="0" align="center" width="400px" class='left'>
  <tbody>
   <tr>
      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } 
      				
      				echo $form->error('User.username', array('class' => 'errormsg'));
      				echo $form->error('User.password', array('class' => 'errormsg'));
      				echo $form->error('Sponsor.sponsor_name', array('class' => 'errormsg'));
      				echo $form->error('Sponsor.email', array('class' => 'errormsg'));
      				echo $form->hidden("Sponsor.id", array('id' => 'sponsorid'));
      				echo $form->hidden("User.id", array('id' => 'userid','value'=>"$userid"));
      				echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$project_name"));
      	?></td>
    </tr>
    <tr>
      <?php if($userid) { ?>
      <td width=""><label class="boldlabel">User name:</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150","value"=>"$username","readonly"=>"readonly"));?></td>
      <?php }else{ ?>
      <td width=""><label class="boldlabel">User name: <span class="red">*</span></label></td>
      <td width=""><label for="project_name"></label>
      <?php echo $form->input("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      <?php }?>
      
    </tr>
    
    <tr>
    <?php if($userid) { ?>
      <td width=""><label class="boldlabel">Password:</label></td>
       <?php }else{ ?>
      <td width=""><label class="boldlabel">Password: <span class="red">*</span>
</label></td>
       <?php }?>
      <td width=""><label for="project_name"></label>
        <?php echo $form->password("User.password", array('id' => 'password', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
     
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Sponsor Name: <span class="red">*</span>
</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.sponsor_name", array('id' => 'sponsor_name', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Sponsor Email: <span class="red">*</span>
</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
    
    </tr>
    
   	<tr>
      <td width=""><label class="boldlabel">Address 1: <span class="red">*</span>
</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "200"));?></td>
       
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Address 2:</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "200"));?></td>
     
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Country : <span class="red">*</span>
</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->select("Sponsor.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'width:186px','onchange'=>'return getstates(this.value,"Sponsor")'),"---Select---"); ?></td>
      
    </tr>
    
    
     <tr>
      <td width=""><label class="boldlabel">State : <span class="red">*</span>
</label></td>
      <td width=""><label for="project_name"></label>
        <span id="statediv"><?php echo $form->select("Sponsor.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'width:186px'),"---Select---"); ?></span></td>
      
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">City : <span class="red">*</span>
</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150")); ?></td>
    
    </tr>
    
     <tr>
      <td width=""><label class="boldlabel">Zip/Postal Code : <span class="red">*</span>
</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "10"));?></td>
     
    </tr>
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr>
		        	<td  valign='top'><label class="boldlabel">Sponsor Logo:</label></td>
				      <td><?php  echo $form->file('Sponsor.sponlogo',array('id'=> 'logo',"class" => "contactInput"));?><br>
				      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250.</span>
				        <br /><br />&nbsp; <?php if($this->data['Sponsor']['logo'] !=''){  ?> <img src="/img/<?php echo $project_name.'/uploads/'.$this->data['Sponsor']['logo']; ?>"> <?php }else { ?><img src='/img/<?php echo $project_name; ?>/nologo.jpg'><?php } ?></td>
		        	
		        </tr>
   
   
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr><td colspan='2'>
  
    			 <button type="submit" id="Submit" class="btn">  Save  </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button>
    		     
    		
	</td></tr>
  </tbody>
</table>

<table class='left' width="200px">
				<tr>
				<td  valign='top'><label class="boldlabel">Company:</label></td>
		       <td>
		       <div style="width:186px; overflow:auto">
		       	<?php echo $form->select('companies',$companies, null,array('multiple'=>'multiple','id'=>'companies','size'=>'7','empty'=>false,'style'=>'width:365px;','disabled'=>'disabled'));?>
		        </div>
		       	<br />
		        <input type="button" class="btn" value="View" name="view" ONCLICK="javascript:(window.location='/companies/companylist')" />
		        &nbsp;&nbsp;
		        <input type="button" class="btn" value="Add" name="Add"  ONCLICK="javascript:(window.location='/companies/addcompany')" /></td>
		        </tr>
		        <tr>
		         <tr><td colspan='2'>&nbsp;</td></tr>
		         <td  valign='top'><label class="boldlabel">Contacts:</label></td>
			      <td>
			      <div style="width:186px; overflow:auto">
			      	<?php echo $form->select('contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','empty'=>false,'style'=>'width:365px;','disabled'=>'disabled'));?>
			        </div>
			      	<br />
			        <input type="button" class="btn" value="View" name="view" ONCLICK="javascript:(window.location='/companies/contactlist')" />
			        &nbsp;&nbsp;
			        <input type="button" class="btn" value="Add" name="Add" ONCLICK="javascript:(window.location='/companies/addcontacts')" /></td>
		        </tr>
		         <tr><td colspan='2'>&nbsp;</td></tr>
		        
		        
			</table>
<?php echo $form->end();?>
<div class="clear"></div>
  </div>
  </div>
  </div><!--<p class="boxBot"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>-->
</p>
  
  </div>

  <div class="clear"></div>
  <!-- Body Panel ends --> 


