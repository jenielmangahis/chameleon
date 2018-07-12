<div id="addcmp"  class="midCont">	
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<div class="frmbox">
<table cellspacing="10" cellpadding="0">
		
  <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"><?php $session->flash(); 
      				//echo $form->error('Company.company_name', array('class' => 'msgTXt'));
      				//echo $form->error('Company.company_type_id', array('class' => 'msgTXt'));
      				
      	?></td>
    </tr>
    <?php }?>
  
  
  <tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Name <span style="color: red;">*</span></label></td>
			<td width="60%">
			<span class="intpSpan"><?php echo $form->input("Company.company_name", array('id' => 'company_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>


	<tr>
		<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Type <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
					<?php echo $form->select("Company.company_type_id",$companytypedropdown,$selectedcompanytype,array('id' => 'company_type_id','class'=>'multilist'),"---Select---"); ?>
					<!--<input type="hidden" name="data[Company][company_type_id]" id="company_type_id" value="<?php echo $selectedcompanytype; ?> " />-->
				</span>				</span></td>
		 </tr>	
			
		<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Categories<span style="color: red;">*</span></label></td>
			<td width="85%">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
						<?php echo $form->select("Category.category_id",$categorydropdown,$selectedcategory,array('id' => 'category_id','class'=>'multilist','multiple'=>'multiple'),"---Select---"); ?>					</span>				</span>			</td>
		</tr>	

	<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">EIN # </label></td>
			<td width="60%">
			<span class="intpSpan"><?php echo $form->input("Company.ein", array('id' => 'ein', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Location Type</label></td>
			<td width="85%">
			<span class="radiolocation" >
			<?php 
			$options=array('0'=>'HQ','1'=>'Branch');
			$attributes=array('legend'=>false, 'value'=>isset($location_type_id)?$location_type_id:0);
			echo $form->radio('Company.location_type_id',$options,$attributes);
			?>
			<input type="hidden" name="data[Company][hq_id]" id="hq_id" value="<?php echo (isset($hq_id) && $hq_id)? $hq_id :'0'; ?>" />
			</span></td>
		</tr>
<tr>
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Address 1 <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Address 2 <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>    
   
    

<tr>
		     	<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Country <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
				<?php echo $form->select("Company.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Company")'),array('254'=>'United States')); ?>				</span>				</span></td>
		    </tr>	

   
<tr>
		     	<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">State <span style="color: red;">*</span></label></td>
                            <td width="85%">
                                   <span class="txtArea_top">
                                <span class="txtArea_bot">
                                  <span id="statediv"> 
                <?php echo $form->select("Company.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); ?></span>				</span>				</span></td>
		    </tr>    
    

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">City <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.city", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>     

<tr>
		<td width="32%" align="right" class="lbltxtarea"><label class="boldlabel">Zip/Postal Code <span style="color: red;">*</span></label></td>
			<td width="68%">
			<span class="intpSpan"><?php echo $form->input("Company.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
		</tr>

  <tr>
  <tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Contacts</label></td>
			<td width="85%">
			<div class="contactbox">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
						<?php echo $form->select("Contact.id",$contactdatadropdown,$companytocontact,array('id' => 'contact_id','class'=>'multilist','multiple'=>'multiple','size'=>7)); ?>					</span>				</span>				</div>
				<span class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
				<span class="btnLft"><input type="button" value="Add" name="Add" tabindex=15 class="btnRht" ONCLICK="addnewcontact()"/>
				</span>			</td>
		</tr>	
  


 <tr><td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
                             <?php  echo $this->renderElement('bottom_message');  ?>
                            </td></tr>
 </table>
</div>

<div class="frmbox2">
<table cellspacing="10" cellpadding="0">


<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Notify Email <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>   

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Main Phone <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.phone", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>       

    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Fax <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Website <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.website", array('id' => 'website', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>    
   
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Facebook Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.fbpage", array('id' => 'fbpage', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>      
    
<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Twitter Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.twitterpage", array('id' => 'twitterp', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>   
		
	<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Google+ Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.gpluspage", array('id' => 'gplus', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>  
		
		<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Linkedin Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.linkdinpage", array('id' => 'linkdin', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>  
		
		
		<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Pinterest Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.pintrestpage", array('id' => 'pintrest', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>   
		<!------------------------->
		<tr>			   	
				<td valign="top" align="right">
					<label class="boldlabel">Related Projects</label>
				</td>
				<td>
					  <div class="large" >
					  	<span class="txtArea_top">
					  		<span class="newtxtArea_bot">
					  			<div class="scrolldown">
								<table cellpadding="5" cellspacing="5" width="100%" >
									<tr align="left">
										<th width="10%">
											<input type="checkbox" id="targetprojectcheckall" />
										</th>
										<th width="40%">
											Name
										</th>
										<th width="25%">
											City
										</th>
									    <th width="25%">
											State
										</th>
									 </tr>
								<?php 									
											foreach($targetProject as $projectdata):																
					   				  		echo '<tr><td><input type="checkbox" id="targetprojectcheck'.$projectdata['Project']['id'].'" name="data[Project][ids][]" value="'.$projectdata['Project']['id'].'" ';
											
echo (!empty($checkedrelproject) && in_array($projectdata['Project']['id'],$checkedrelproject))?'checked="checked"' :'';											
										
										 echo	' /></td> <td>'.$projectdata['Project']['project_name'].'</td><td>'.$projectdata['Sponsor']['city'].'</td><td>'. AppController::getstatename($projectdata['Sponsor']['state']).'</td></tr>';
									  endforeach; ?>
								</table>
								</div>
							</span>
						</span>
						</div> 
				</td>
				
			   </tr>
			   <tr>
			   <td>
			   </td>
			   <td width="85%">
			<div>
			
				<span class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
						</td></tr>
			  
			   <!----------------------------->
		
	
		
		
		   <tr>			   	
				<td valign="top" align="right">
					<label class="boldlabel">Related Non-Profits</label>
				</td>
				<td>
					  <div class="large" >
					  	<span class="txtArea_top">
					  		<span class="newtxtArea_bot">
							
								<div class="scrolldown">
					  			<table cellpadding="5" cellspacing="5" width="100%" >
									<tr align="left">
										<th width="10%">
											<input type="checkbox" id="nonprofitcheckall" />
										</th>
										<th width="40%">
											Name
										</th>
										<th width="25%">
											City
										</th>
									    <th width="25%">
											State
										</th>
									 </tr>
								<?php 
									//print_r($releatednonprofit);
								foreach($releatednonprofit as $nonprofit):
					   				  		echo '<tr><td><input type="checkbox" id="nonprofitcheck'.$nonprofit['CompanyType']['id'].'" name="data[RelatedNonProfit][ids][]" value="'.$nonprofit['Company']['id'].'" ';
echo (!empty($relatednonprofitid) && in_array($nonprofit['Company']['id'],$relatednonprofitid))?'checked="checked"' :'';											
										
										 echo	' /></td> <td>'.$nonprofit['Company']['company_name'].'</td><td>'.$nonprofit['Company']['city'].'</td><td>'. AppController::getstatename($nonprofit['Company']['state']).'</td></tr>';
									  endforeach; ?>
								</table>
								</div>
							</span>
						</span>
						</div> 
				</td>
			   </tr>
			   <tr>
			   <td>
			   </td>
			   <td width="85%">
			<div>
			
				<span class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
						</td></tr>
			   
				
			</table>
	<!-- ADD Sub Admin  FORM EOF -->

<!--inner-container ends here-->

<?php echo $form->end();?>

</div>
</div>
  
