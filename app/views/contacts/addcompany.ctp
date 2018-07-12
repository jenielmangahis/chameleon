<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'contacts/sa_companylist';
?>
   <!-- Body Panel starts -->
   <div class="container">
<div class="titlCont"><div style="width:960px; margin:0 auto;">
	<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">		
	<?php echo $form->create("contacts", array("action" => "addcompany",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addcompany', 'id' => "addcompany","onsubmit"=>"return validatecompany('$act');"));
	 echo $form->hidden("Company.id", array('id' => 'companyid'));
	 echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
	?>
	<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
	 <?php e($html->image('save.png')) ?></button>
		<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
		 <?php e($html->image('apply.png')) ?></button>
		<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"> <?php e($html->image('cancle.png')) ?></button>
<?php
//e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));
echo $this->renderElement('new_slider'); 
?>
</div>
<div class="myclass">
			

<?php  echo $this->renderElement('project_name');  ?>     
<span class="titlTxt">
		<?php 
			if($this->data['Company']['id']){
				$act = 'edit';
				echo " Edit  Company Detail";
			}else{
				$act = 'add';
				echo "Add New Company ";
			}	
		?>
	</span>

	
		
	<div class="topTabs" style="height:25px;">
		<?php /*?><ul class="dropdown">   
		<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
		</ul><?php */?>
	</div>
    <div class="clear"></div>    
</div>
</div>

</div>
<div id="addcmp"  class="midCont">	


<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<div class="frmbox mgrt60">
<table cellspacing="5" cellpadding="0">
		
  <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"><?php $session->flash(); 
      				//echo $form->error('Company.company_name', array('class' => 'msgTXt'));
      				//echo $form->error('Company.company_type_id', array('class' => 'msgTXt'));
      				
      	?></td>
    </tr>
    <?php }?>
  

	<tr>
		<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Type <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
					<?php echo $form->select("Company.company_type_id",$companytypedropdown,$selectedcompanytype,array('id' => 'company_type_id','class'=>'multilist'),"---Select---"); ?>
				</span>
				</span></td>
		    </tr>	

     <?php if($this->data['Company']['id']) { ?>

	<tr>
			<td align="right" width="40%" ><label class="boldlabel" style="display:inline-block;margin-bottom:5px;">Sponsor<span style="color: red;"></span></label></td>
                            <td width="60%">
				<span style="display: inline-block; height: 22px;"><?php echo $sponorname?$sponorname:"N/A"; ?></span>
			</td>
		    </tr>
     <?php } ?>

	
	<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Name <span style="color: red;">*</span></label></td>
			<td width="60%">
			<span class="intpSpan"><?php echo $form->input("Company.company_name", array('id' => 'company_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>

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
					<?php echo $form->select("Company.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Company")'),array('254'=>'United States')); ?>
				</span>
				</span></td>
		    </tr>	

   
<tr>
		     	<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">State <span style="color: red;">*</span></label></td>
                            <td width="85%">
                                   <span class="txtArea_top">
                                <span class="txtArea_bot">
                                  <span id="statediv"> 
                            <?php echo $form->select("Company.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); ?></span>
				</span>
				</span></td>
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
					<?php if($this->data['Company']['id']) { ?>

					<td class="lbltxtarea" align="right"><label class="boldlabel">Contacts</label></td>
					      <td>
					      <div >
					      <span class="txtArea_top">
						<span class="newtxtArea_bot"><?php echo $form->select('contacts',$contacts, null,array('multilist'=>'multilist','id'=>'contacts','size'=>'10','empty'=>false,'class'=>'multilist multi'));?></span></span>
					      </div>

					         <span class="btnLft">
                             <input type="hidden" id="current_domain" value="<?php echo $current_domain; ?>" name="current_domain">
                             
							 <input type="button" class="btnRht" value="View" name="view" id="view_contact" ONCLICK="javascript:(window.location=baseUrl+'contacts/contactlist')"  -->
                             </span><span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button"  class="btnRht" value="Add" name="Add" ONCLICK="javascript:(window.location=baseUrl+'contacts/addcontacts/addcontact/<?php echo $this->data['Company']['id'];?>')" /></span></td>
				        <?php }else{ ?>
						<td valign="top">&nbsp;</td>
					<?php } ?>
		        </tr>

 <tr><td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
                             <?php  echo $this->renderElement('bottom_message');  ?>
                            </td></tr>
 </table></div>

<div class="frmbox">
<table cellspacing="5" cellpadding="0">


<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Email <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>   

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Phone <span style="color: red;"></span></label></td>
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
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Note <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="txtArea_top">
				<span class="newtxtArea_bot"><?php echo $form->textarea("Company.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?></span></span></td>
		</tr>      
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Logo <span style="color: red;"></span></label></td>
			<td width="85%">
			<?php  echo $form->file('Company.complogo',array('id'=> 'logo',"class" => "contactInput"));?><br>
			<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250.</span>
			

			</td>
		</tr>   
     
    
<tr>
			<td align="right" width="40%"></td>
			<td width="85%">
			
		<?php 
		if($this->data['Company']['logo'] !=''){
			echo $html->image($project_name.'/uploads/'.$this->data['Company']['logo'],array('width'=>'100','height'=>'100','alt'=>'')); 
		}else{
			echo $html->image('nologo.jpg',array('width'=>'100','height'=>'100','alt'=>'')); 
		}
		?> 
		
	</td>
		</tr> 
    


				

		

			</table>
	<!-- ADD Sub Admin  FORM EOF -->

<!--inner-container ends here-->

<?php echo $form->end();?>

</div>
</div>
  

<script language='javascript'>
<?php if(!($this->data['Company']['id'])) { ?>
getstateoptions('254',"Company"); 
<?php } ?>
</script>

<div class="clear"></div>
  </div>    
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
        $("#view_contact").click(function(){   
        var current_domain=$("#current_domain").val();
            var contactid=$("#contacts").val();
            if(contactid==null || contactid==""){
                return false;
            }else{
                var url=baseUrl+"contacts/addcontacts/"+contactid;


                window.location=url;
            }
            
      
    });
</script>
