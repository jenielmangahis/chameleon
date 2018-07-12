<?php if($this->data['Company']['id']){
                                                $act = 'edit';
                                                $head= " Edit  Company Detail</h1>";
                                         }else{
                                                $act = 'add';
                                                $head= " Add New Company </h1>";
                                         }      
?>
<div class="titlCont1"><div style="width:960px; margin:0 auto;">
<?php echo $form->create("Admins", array("action" => "addcompany1",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addcompany', 'id' => "addcompany1","onsubmit"=>"return validatecompany('$act');"))?>
       <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt"><?php echo $head; ?> </span>
        <div class="topTabs">
                <ul>
                <li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><a href="#." class=""><span>Apply</span></a></li>
                <li><a href="/admins/companylist1"><span>Cancel</span></a></li>
                </ul>
        </div>
</div>
</div>
<br>
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar">
    
   </div>
<div class="" style="padding-left:200px">	


<div class="frmbox mgrt60">

		<table cellspacing="10" cellpadding="0" align="center" width="450px" class='left'>
		
  <tbody>
    <tr>
      <td colspan="5"><?php if($session->check('Message.flash')){ $session->flash(); } 
      				echo $form->error('Company.company_name', array('class' => 'errormsg'));
      				echo $form->error('Company.company_type_id', array('class' => 'errormsg'));
      				 echo $form->hidden("Company.id", array('id' => 'companyid'));
      				 echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
      	?></td>
    </tr>
    
    <tr>
      <td width="25%" align="right"><label class="boldlabel">Company Type <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
      <span class="txtArea_top"><span class="txtArea_bot"><?php echo $form->select("Company.company_type_id",$companytypedropdown,$selectedcompanytype,array('id' => 'company_type_id','class'=>'multilist'),"---Select---"); ?></span>
     
    </tr>
    
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Company Name <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"><?php echo $form->input("Company.company_name", array('id' => 'company_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
     
    </tr>
    
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Address 1 <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"><?php echo $form->input("Company.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
     
    </tr>
    
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Address 2 </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"><?php echo $form->input("Company.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
     
    </tr>
    
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Country <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
      <span class="txtArea_top"><span class="txtArea_bot"> <?php echo $form->select("Company.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return findgetstates(this.value,"Company")'),array('254'=>'United States')); ?></span></td>
     
    </tr>
    
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">State <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
          <span id="statediv"> <span class="txtArea_top"><span class="txtArea_bot"><?php echo $form->select("Company.state",$statedropdown,$selectedstate,array('id' => 'state',"class" => "multilist"),"---Select---"); ?></span></td>
      
    </tr>
    
    <tr>
      <td width="20%" align="right"><label class="boldlabel">City <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"><?php echo $form->input("Company.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150")); ?></span></td>
     
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Zip/Postal Code <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"><?php echo $form->input("Company.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
      
    </tr>

			<tr>
					<?php if($this->data['Company']['id']) { ?>
				      <td  valign='top' align="right"><label class="boldlabel">Contacts </label></td>
				      <td>
				      	<div style="width: 186px; overflow: auto; border: solid 1px #ccc"><span class="txtArea_top">
<span class="txtArea_bot">
				      	<?php echo $form->select('contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','class'=>'multilist','size'=>'10','empty'=>false,'style'=>'width:365px;','disabled'=>'disabled'));?></span></span>
				      	</div>
				      	<br />
				        <input type="button" value="View" name="view" ONCLICK="javascript:(window.location='/admins/contactlist1')" />
				        &nbsp;&nbsp;
				        <input type="button" value="Add" name="Add" ONCLICK="javascript:(window.location='/admins/addcontacts/addcontact1/<?php echo $this->data['Company']['id'];?>')" /></td>
				        <?php } ?>
				   
				        
		        </tr>


 <tr><td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
                             <?php  echo $this->renderElement('bottom_message');  ?>
                            </td></tr>
 </table></div>

<div class="frmbox mgrt115">
<table cellspacing="10" cellpadding="0">
    
      <tr>
      <td width="20%" align="right"><label class="boldlabel">Email <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"><?php echo $form->input("Company.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
     
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Phone </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
       <span class="intpSpan"> <?php echo $form->input("Company.phone", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
     
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Fax </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
         <span class="intpSpan"> <?php echo $form->input("Company.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
     
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Website </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
        <span class="intpSpan"> <?php echo $form->input("Company.website", array('id' => 'website', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
     
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Note </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
       <span class="txtArea_top"><span class="txtArea_bot"><?php echo $form->textarea("Company.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "noBg"));?></span></span></td>
     
    </tr>
    
     <tr>
     
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      
     </tr>
     
     <tr>
     
      <td valign='top'  align="right" width="30%"><label class="boldlabel">Company Logo </label>&nbsp;</td>
      <td><?php  echo $form->file('Company.complogo',array('id'=> 'logo',"class" => "contactInput"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250.</span>
       <br />&nbsp; <?php if($this->data['Company']['logo'] !=''){  ?> <img src="/img/uploads/<?php echo $this->data['Company']['logo']; ?>"> <?php }else { ?><img src='/img/nologo.jpg'><?php } ?>
       </td>
     
     </tr>
    
    

  </tbody>
</table>






		

					
					<!-- ADD Sub Admin  FORM EOF -->

	
 
<!--inner-container ends here-->

<?php echo $form->end();?>




</div>
</div>
  

<script language='javascript'>
<?php if(!($this->data['Company']['id'])) { ?>
findgetstates('254',"Company"); 
<?php } ?>
</script>
<div class="clear"></div>