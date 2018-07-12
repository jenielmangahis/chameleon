<?php 
	$base_url = Configure::read('App.base_url');
	$lgrt = $base_url.$session->read('newsortingby');
?>
<div class="titlCont1"><div class="myclass">
<div align="center" id="toppanel" >
	 <?php 

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '47'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   

 echo $this->renderElement('new_slider');  ?>


</div>

<span class="titlTxt">
 <?php if($this->data['Contact']['id']){
                                                $act = 'edit';
                                                echo "Edit  Contact Detail";
                                         }else{
                                                $act = 'add';
                                                echo "Add New Contact ";
                                         }      
                ?>
</span>
<?php echo $form->create("Company", array("action" => "addcontacts",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addcontacts', 'id' => "addcontacts","onsubmit"=>"return validatecontacts('$act');"))?>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $lgrt;?>')"><span> Cancel</span></button></li>
</ul>
</div>

</div>

</div><!--rightpanel ends here-->

                            <!--inner-container starts here--><div style="width:990px; margin:0 auto">

<div class="">

<div class="">
	
		<div class="top-bar" style="border-left:0px;">
	
	
		</div>
		
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

<div class="">	
		 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



<div style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar" id="addcnttab">
</div>


<table  cellpadding="0" align="center" width="815px">
  <tbody>
    <tr>
      <td colspan="5"><?php if($session->check('Message.flash')){ $session->flash(); } 
      				 echo $form->error('Contact.company_id', array('class' => 'errormsg')); 
      				 echo $form->error('Contact.contact_type_id', array('class' => 'errormsg'));
      				 echo $form->error('Contact.firstname', array('class' => 'errormsg'));
      				 echo $form->error('Contact.lastname', array('class' => 'errormsg'));
      				 echo $form->hidden("Contact.id", array('id' => 'contactid'));
      	?>
      			
      		</td>
      	
    </tr>


<tr>
		<td width="15%" align="right"><label class="boldlabel">Company <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php 
						if($selectedcompany){
							echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
						}else{
									if($companydropdown){
										foreach($companydropdown as $key => $value){
												$firstid = $key;
												break;
										}
										$selectedcompany = $firstid;
										echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
									}
									//$selectedcompany = '';
							}
						
						echo $form->select("Contact.company_id",$companydropdown,$selectedcompany,array('id' => 'company_id','class'=>'multilist',"onchange"=>"getcompanyaddress(this.value);"),"---Select---"); ?>
				</span>
				</span>
                  <span id='companydata' style="display: none;"></span>    
                </td>
		    </tr>    
			<tr>
			     <td width="15%" align="right"><label class="boldlabel">Contact Type <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php echo $form->select("Contact.contact_type_id",$contacttypedropdown,null,array('id' => 'contact_type_id','class'=>'multilist'),"---Select---"); ?>
				</span>
				</span></td>
		    </tr>
     
    
<tr>
		<td width="15%" align="right"><label class="boldlabel">Title <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.jobtitle", array('id' => 'jobtitle', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>    
    
<tr>
		<td width="15%" align="right"><label class="boldlabel">First Name <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.firstname", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>    
    
<tr>
		<td width="15%" align="right"><label class="boldlabel">Last Name <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.lastname", array('id' => 'lastname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>
 
<tr>
		<td width="15%" align="right"><label class="boldlabel">Phone<span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.busphone", array('id' => 'busphone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>

<tr>
		<td width="15%" align="right"><label class="boldlabel">Fax<span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>   
   
<tr>
		<td width="15%" align="right"><label class="boldlabel">Cell Phone <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.mobile", array('id' => 'mobile', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>     
     
<tr>
		<td width="15%" align="right"><label class="boldlabel">Email <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>     
   
    
    
    

<?php if(!$this->data['Contact']['id']){ ?>

<tr>
		<td width="15%" align="right" valign="top"><span style="color: red;"></span></td>
			<td width="85%">
			<?php echo $form->input('sameascompany', array('type'=>'checkbox', 'label' => ' Check if same as Company Address','id'=>'sameascompany','onclick'=>'return putcountryaddress();')); ?>
			
			</td>
		</tr>
<?php } ?> 


<tr>
		<td width="15%" align="right"><label class="boldlabel">Address <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>


<tr>
		     <td width="15%" align="right"><label class="boldlabel">Country <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php echo $form->select("Contact.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return 	getstateoptions(this.value,"Contact")'),array('254'=>'United States')); ?>
				</span>
				</span></td>
		    </tr> 
  
 

<tr>
		     <td width="15%" align="right"><label class="boldlabel">State <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<span id="statediv"><?php echo $form->select("Contact.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); ?></span>
				</span>
				</span></td>
		    </tr>    
    

<tr>
		<td width="15%" align="right"><label class="boldlabel">City <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.city", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>

<tr>
		<td width="20%" align="right"><label class="boldlabel">Zip/Postal Code <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
		</tr>   

  </tbody>
</table>				
					<!-- ADD Sub Admin  FORM EOF -->

			</div></div><div></div>

 
<!--inner-container ends here-->

<?php echo $form->end();?>

<div class="top-bar" style="margin-bottom: 10px; text-align: left; padding-top: 5px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>

  
<div class="clear"></div></div></div>
<script language='javascript'>
<?php if(!($this->data['Contact']['id'])) { ?>
getstateoptions('254',"Contact"); 
<?php } ?>
</script>
<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcnttab").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
