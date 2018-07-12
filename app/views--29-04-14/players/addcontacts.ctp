<?php
	$base_url = Configure::read('App.base_url');
	$backUrl = $base_url.'players/contactlist';

?><div class="titlCont"><div style="width:960px; margin:0 auto;">

 <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">	<?php echo $form->create("players", array("action" => "addcontacts",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addcontacts', 'id' => "addcontacts","onsubmit"=>"return validatecontacts('$act');"))?>
<?php  echo $form->hidden("Contact.id", array('id' => 'contactid'));?>	
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
	 <?php  echo $this->renderElement('new_slider');  ?>



</div>
<?php  echo $this->renderElement('project_name');  ?>   
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

<div class="topTabs" style="height:25px;">
<?php /*?><ul>
<li></li>
</ul><?php */?>
</div>

</div>

</div><!--rightpanel ends here-->

                            <!--inner-container starts here-->
<div id="addcnt" >    
	<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

<div class="">	
	 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


  

<table cellspacing="5" cellpadding="0" align="left" width="815px" style="margin-left: 50px;">
  <tbody>
    <?php if($session->check('Message.flash')){ ?>	
    <tr>
      <td colspan="5"><?php      $session->flash(); 
      				 echo $form->error('Contact.company_id', array('class' => 'msgTXt')); 
      				 echo $form->error('Contact.contact_type_id', array('class' => 'msgTXt'));
      				 echo $form->error('Contact.firstname', array('class' => 'msgTXt'));
      				 echo $form->error('Contact.lastname', array('class' => 'msgTXt'));
      				
      	?>
	
      			
      		</td>
      	
    </tr>
    <?php }?>	


    <!--  
    <tr>
		<td width="30%" align="right"><label class="boldlabel">Company <span style="color: red;">*</span></label></td>
                            <td width="70%">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php 
						if($selectedcompany){
							echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
						}else{
									/*if($companydropdown){
										foreach($companydropdown as $key => $value){
												$firstid = $key;
												break;
										}
										$selectedcompany = $firstid;
										echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
									}*/
									$selectedcompany = '';
							}
						
						echo $form->select("Contact.company_id",$companydropdown,$selectedcompany,array('id' => 'company_id','class'=>'multilist',"onchange"=>"getcompanyaddress(this.value);"),"---Select---"); ?>
				</span>
				</span>
                 <span id='companydata' style="display: none;"></span>  
                </td>
		    </tr>
-->
    
<tr>
		     <td width="30%" align="right"><label class="boldlabel">Contact Type <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php echo $form->select("Contact.contact_type_id",$contacttypedropdown,$selectedcontacttype,array('id' => 'contact_type_id','class'=>'multilist'),"---Select---"); ?>
				</span>
				</span></td>
		    </tr>
     
    
<tr>
		<td width="15%"  align="right"><label class="boldlabel">Title <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.jobtitle", array('id' => 'jobtitle', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>    
    
<tr>
		<td width="15% " align="right" ><label class="boldlabel">First Name <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.firstname", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>    
    
<tr>
		<td width="15%"  align="right"><label class="boldlabel">Last Name <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.lastname", array('id' => 'lastname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>
 
<tr>
		<td width="15%"  align="right"><label class="boldlabel">Phone <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.busphone", array('id' => 'busphone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>

<tr>
		<td width="15%"  align="right"><label class="boldlabel">Fax <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>   
   
<tr>
		<td width="15%"  align="right"><label class="boldlabel">Cell Phone <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.mobile", array('id' => 'mobile', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>     
     
<tr>
		<td width="15%"  align="right"><label class="boldlabel">Email <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>     
   
    
    
    

<?php if(!$this->data['Contact']['id']){ ?>

<tr>
		<td align="right" valign="top" width="15%"> </td>
			
			<td>
			<?php echo $form->input('sameascompany', array('type'=>'checkbox', 'label' => ' Check if same as Company Address','id'=>'sameascompany','onclick'=>'return putcountryaddress();')); ?>
			
			</td>
		</tr>
<?php } ?> 


<tr>
		<td width="15%"  align="right" style="padding-top:10px;"><label class="boldlabel">Address <span style="color: red;">*</span></label></td>
			<td width="85%" style="padding-top:10px;">
			<span class="intpSpan"><?php echo $form->input("Contact.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>


<tr>
		     <td width="15%" align="right"><label class="boldlabel">Country <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php echo $form->select("Contact.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Contact")'),array('254'=>'United States')); ?>
				</span>
				</span></td>
		    </tr> 
			<tr>
		     <td width="15%" align="right"><label class="boldlabel">State <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span id="statediv"><span class="txtArea_top">
					<span class="txtArea_bot"> <span id="statediv"> <?php echo $form->select("Contact.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); ?>
                    </span>
                    </span>
                    </span>
				</td>
		    </tr>       

<tr>
		<td width="15%" align="right"><label class="boldlabel">City <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.city", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>

<tr>
		<td width="15%" align="right"><label class="boldlabel">Zip/Postal Code <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Contact.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
		</tr>
     <tr>
        <td>   

    <div class="top-bar" style="margin-bottom: 10px; text-align: left; padding: 20px 5px 5px 60px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div>
       </td>
    </tr>
  </tbody>
</table>

					<!-- ADD Sub Admin  FORM EOF -->
<!--inner-container ends here-->

<?php echo $form->end();?>	
<br>
</div>
</div>
</div>
</div>
<div class="clear"></div>
<script language='javascript'>
<?php if((!$this->data['Contact']['id'])) { ?>
getstateoptions('254',"Contact"); <?php } ?>
</script>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcnt").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
