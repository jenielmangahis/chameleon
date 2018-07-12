<!--container starts here-->
<div class="container">

<!--rightpanel starts here--><div class="leftpanel">

<?php echo $this->renderElement('new_admin_leftpanel'); ?>


<?php
   echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
      //echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
    echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');
?>

	<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
	<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
	
</div><!--rightpanel ends here-->

<!--inner-container starts here--><div class="rightpanel">

<div id="center-column">
	<div class="top-bar" style="border-left:0px;">
		<h1> Edit Holder Infomation </h1>
		<b>Any item with a  "<span style="color:red">*</span>"  requires an entry.</b>
		</div><br />
		
		<div class="left">
		
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->
		<?php 
		//,"onsubmit"=>"return validateholder('add');"
		echo $form->create("Admins", array("action" => "noneditholder",'type' => 'file','enctype'=>'multipart/form-data','name' => 'noneditholder', 'id' => "noneditholder"))?>

<script type="text/javascript">


	/* <![CDATA[ */
		$(function() {
				  $('#birthdayBP').datetime({
									  userLang : 'en',
									  americanMode: false, 
								});	
							
			});
	/* ]]> */

	
		
	</script>
			
		<table cellspacing="10" cellpadding="0" align="center" width="815px">
  <tbody>
   <tr>
      <td colspan="5"><?php if($session->check('Message.flash')){ $session->flash(); } 
      				echo $form->hidden("Holder.id", array('id' => 'holderid'));
      				echo $form->hidden("User.id", array('id' => 'userid','value'=>"$userid"));
			?></td>
    </tr>
    
      <tr>
      <td width="20%"><label class="boldlabel">Email: <span style="color:red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $this->data['Holder']['email']; ?></td>
       <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
    
    <tr>
      <td width="20%"><label class="boldlabel">Password: <span style="color:red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->password("User.password", array('id' => 'password', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      <td><?php echo $form->error('User.password', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td width="20%"><label class="boldlabel">Screen Name: <span style="color:red">*</span></label></td>
     
      <td width="30%"><label for="project_name"></label>
      <?php echo $form->input("Holder.screenname", array('id' => 'screenname', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
   
      <td><?php echo $form->error('Holder.screenname', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
    
  
    
    <tr>
      <td width="20%"><label class="boldlabel">First Name (Private): <span style="color:red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.firstname", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      <td><?php echo $form->error('Holder.firstname', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td width="20%"><label class="boldlabel">Last Name: <span style="color:red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.lastnameshow", array('id' => 'lastnameshow', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      <td><?php echo $form->error('Holder.lastnameshow', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td width="20%"><label class="boldlabel">Address1: </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      <td><?php //echo $form->error('Holder.address2', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr>
      <td width="20%"><label class="boldlabel">Address2: </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      <td><?php //echo $form->error('Holder.lastnameshow', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   
    
    <tr>
      <td width="20%"><label class="boldlabel">Country : <span style="color:red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->select("Holder.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'width:186px','onchange'=>'return getstates(this.value,"Holder")'),"---Select---"); ?></td>
       <td><?php echo $form->error('Holder.country', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
     <tr>
      <td width="20%"><label class="boldlabel">State : </label></td>
      <td width="30%"><label for="project_name"></label>
        <span id="statediv"><?php echo $form->select("Holder.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'width:186px'),"---Select---"); ?></span></td>
      <td><?php //echo $form->error('Holder.state', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td width="20%"><label class="boldlabel">City : </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150")); ?></td>
       <td><?php //echo $form->error('Holder.city', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%"><label class="boldlabel">Zip/Postal Code : <span style="color:red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "10"));?></td>
      <td><?php echo $form->error('Holder.zipcode', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
      <tr>
      <td width="20%"><label class="boldlabel">Phone : </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.phone", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "10"));?></td>
      <td><?php //echo $form->error('Holder.zipcode', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
      <tr>
      <td width="20%"><label class="boldlabel">Birthday : </label></td>
      <td width="40%"><label for="project_name"></label>
        <?php echo $form->text("Holder.birthday", array('id' => 'birthday', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "10"));?>  &nbsp; <input type="button" class="calendarcls" id="birthdayBP"></td>
      <td><?php //echo $form->error('Holder.zipcode', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
      <tr>
      <td width="20%"><label class="boldlabel">Facebook : </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.facebook", array('id' => 'facebook', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "10"));?></td>
      <td><?php //echo $form->error('Holder.zipcode', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
      <tr>
      <td width="20%"><label class="boldlabel">Twitter : </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Holder.twitter", array('id' => 'twitter', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "10"));?></td>
      <td><?php //echo $form->error('Holder.zipcode', array('class' => 'errormsg')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
     <tr>
      <td width="20%"><?php echo $form->input('Holder.shownamelast', array('type'=>'checkbox', 'label' => '','div'=>false)); ?> <label class="boldlabel">Show Last name</label></td>
      <td><?php echo $form->input('Holder.showcity', array('type'=>'checkbox', 'label' => '','div'=>false)); ?><label class="boldlabel"> Show City</label></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%"><?php echo $form->input('Holder.showaddress1', array('type'=>'checkbox', 'label' => '','div'=>false)); ?> <label class="boldlabel">Show Address1</label></td>
      <td><?php echo $form->input('Holder.showaddress2', array('type'=>'checkbox', 'label' => '','div'=>false)); ?><label class="boldlabel"> Show Address2</label></td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
     <tr>
      <td colspan='5'><?php echo $form->input('Holder.eligible_for_gift', array('type'=>'checkbox', 'label' => '','div'=>false)); ?> <label class="boldlabel">Eligible to win gifts and prizes</label></td>
     
    </tr>
    
     <tr>
      <td width="20%"><?php echo $form->input('Holder.inform_by_email', array('type'=>'checkbox', 'label' => '','div'=>false)); ?> <label class="boldlabel">Informed by email</label></td>
      <td width="20%"><?php echo $form->input('Holder.newsletter_subscription', array('type'=>'checkbox', 'label' => '','div'=>false)); ?><label class="boldlabel"> Send Me Newsletter</label></td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    

    
    

    <tr><td colspan='5'>&nbsp;</td></tr>
    <tr><td colspan='5'>
    			 <button type="submit" id="Submit" class="button">  Save  </button>&nbsp;
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/holderslist')"> Cancel </button>&nbsp;
				 <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/editprojectdtl')"> Project Detail </button>		
	</td></tr>
  </tbody>
</table>
<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>


</div><!--container ends here-->
