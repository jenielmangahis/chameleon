<div id="addcmp"  class="midCont clearfix">	


<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<div class="frmbox">
<table width="100%" cellspacing="10" cellpadding="0">
		
  <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"><?php $session->flash(); 
      				//echo $form->error('Company.company_name', array('class' => 'msgTXt'));
      				//echo $form->error('Company.company_type_id', array('class' => 'msgTXt'));
      				
      	?></td>
    </tr>
    <?php }?>  
  
   
  <tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Company Name <span style="color: red;">*</span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.company_name", array('id' => 'company_name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span></td>
		</tr>


	<tr>
		<td align="right" class="lbltxtarea"><label class="boldlabel">Company Type <span style="color: red;">*</span></label></td>
                            <td width="76%">
				<div class="contactbox" >
				<span class="txtArea-top">
					<span class="newtxtArea-bot">
					<?php //echo $form->select("Company.company_type_id",$companytypedropdown,$selectedcompanytype,array('id' => 'company_type_id','class'=>'multi-list form-control'),"---Select---"); ?>
					
					<?php echo $form->select("Company.company_type_id",$companytypedropdown,$selectedcompanytype,array('id' => 'company_type_id','class'=>'multi-list form-control','multiple'=>'multiple', 'size'=>'7',"---Select---")); ?>
					<!--<input type="hidden" name="data[Company][company_type_id]" id="company_type_id" value="<?php //echo $selectedcompanytype; ?> " />-->
				</span>				</span></div></td>
		 </tr>	
			
		
<tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Address 1 <span style="color: red;">*</span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>
		</tr>
    
<tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Address 2 <span style="color: red;"></span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>
		</tr>    
   
    

<tr>
		     	<td align="right" class="lbltxtarea"><label class="boldlabel">Country <span style="color: red;">*</span></label></td>
                            <td width="76%">
				<span class="txtArea-top">
					<span class="newtxtArea-bot">
				<?php echo $form->select("Company.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multi-list form-control','onchange'=>'return getstateoptions(this.value,"Company")'),array('254'=>'United States')); ?>				</span>				</span></td>
		    </tr>	

   
<tr>
		     	<td align="right" class="lbltxtarea"><label class="boldlabel">State <span style="color: red;">*</span></label></td>
                            <td width="76%">
                                   <span class="txtArea-top">
                                <span class="txtArea_bot">
                                  <span id="statediv"> 
                <?php echo $form->select("Company.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multi-list form-control'),"---Select---"); ?></span>				</span>				</span></td>
		    </tr>    
    

<tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">City <span style="color: red;">*</span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.city", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span></td>
		</tr>     

<tr>
		<td width="32%" align="right" class="lbltxtarea"><label class="boldlabel">Zip/Postal Code <span style="color: red;">*</span></label></td>
			<td width="68%">
			<span class="intp-Span"><?php echo $form->input("Company.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "10"));?></span></td>
		</tr>

  <tr>
  <tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Contacts</label>
			<div style="margin:7px 5px 0 0;">
			<span class="btn-Lft"><input type="button" value="View" tabindex=14 id="view_contact" class="btn-Rht btn btn-primary btn-small" name="view" onclick="viewEmailTempforRSVP();"  /></span>
				<span class="btn-Lft"><input type="button" value="Add" name="Add" tabindex=15 class="btn-Rht btn btn-primary btn-small" ONCLICK="addnewcontact()"/>
				</span>
				</div>
			</td>
			<td width="76%">
			<div class="contactbox" >
				<span class="txtArea-top">
					<span class="newtxtArea-bot">
						<?php echo $form->select("Contact.id",$contactdatadropdown,$companytocontact,array('id' => 'contact_id','class'=>'multi-list form-control','multiple'=>'multiple', 'size'=>'7')); ?>					</span>				</span>				</div>
							</td>
		</tr>	
  


 <tr><td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
                             <?php  echo $this->renderElement('bottom_message');  ?>
                            </td></tr>
 </table>
</div>

<div class="frmbox2">
<table width="100%" cellspacing="10" cellpadding="0">
<tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Notify Email <span style="color: red;">*</span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>
		</tr>   

<tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Main Phone <span style="color: red;"></span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.phone", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "15"));?></span></td>
		</tr>       

    
<tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Fax <span style="color: red;"></span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "15"));?></span></td>
		</tr>

<tr>
			<td align="right" class="lbltxtarea"><label class="boldlabel">Website <span style="color: red;"></span></label></td>
			<td width="76%">
			<span class="intp-Span"><?php echo $form->input("Company.website", array('id' => 'website', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
		</tr>    
			</table>
	<!-- ADD Sub Admin  FORM EOF -->

<!--inner-container ends here-->
<?php echo $form->end();?>
</div>
</div>
