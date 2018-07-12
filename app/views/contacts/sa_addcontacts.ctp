<script type="text/javascript">
$(document).ready(function() {
$('#coNtact').removeClass("butBg");
$('#coNtact').addClass("butBgSelt");
}); 
</script>
<?php 
        if($this->data['Contact']['id']){
			$act = 'edit';
		}else{
			$act = 'add';
		}
	$head = $PageHeading;		
	//print_r($this->data);
?>

<div class="titlCont">
  <div style="width:960px;margin:0 auto">

	<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width: 545px !important; text-align:right;"> 
    <?php echo $form->create("contacts", array("action" => "sa_addcontacts",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addcontacts', 'id' => "addcontacts1","onsubmit"=>"return validatecontacts('$act');"))?>
	<?php
$ids = $this->params['pass'][0]; 
e($html->link($html->image('call.png') . ' ' . __(''), array('controller'=>'admins','action'=>'call',$ids),array('escape' => false)));

e($html->link($html->image('email.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendtempmail',$ids),array('escape' => false)));

e($html->link($html->image('sms.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendsms','1'),array('escape' => false)));


e($html->link($html->image('message.png') . ' ' . __(''), array('controller'=>'admins','action'=>'messagenew',$ids),array('escape' => false)));

e($html->link($html->image('event.png') . ' ' . __(''), array('controller'=>'admins','action'=>'appointment',$ids),array('escape' => false)));

e($html->link($html->image('note.png') . ' ' . __(''), "../players/notelist/2",array('escape' => false)));

e($html->link($html->image('take.png') . ' ' . __(''), array('controller'=>'admins','action'=>'coming_soon','task'),array('escape' => false))); ?>
	<button class="sendBut" id="Submit" name="redirectpage" type="submit">
	<?php e($html->image('save.png')) ?>
	</button>
	<button class="sendBut" id="Submit" name="noredirection" type="submit">
	<?php e($html->image('apply.png')) ?>
	</button>
	<?php
	if($this->params['pass'][2]==='customer')
	{
e($html->link($html->image('cancle.png') . ' ' . __(''), array('controller'=>'relationships','action'=>'customers'),array('escape' => false)));
}
else
{
e($html->link($html->image('cancle.png') . ' ' . __(''), array('controller'=>'relationships','action'=>'sa_contactlist'),array('escape' => false)));
} 

echo $this->renderElement('new_slider');
?>

	</div>
	<span class="titlTxt"><?php echo $head; ?> </span>
    <div class="topTabs" style="height:25px;">
      <?php /*?><ul>
        <li>
          <button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>
        </li>
        <li>
          <button class="button" id="Submit" name="noredirection" type="submit"><span> Apply</span> </button>
        </li>
        <li>
          <?php
						e($html->link(
						$html->tag('span', 'Cancel'),
						array('controller'=>'contacts','action'=>'sa_contactlist'),
						array('escape' => false)
						)
					  );
					?>
        </li>
      </ul><?php */?>
    </div>
	 <?php    //$this->loginarea="contacts";    $this->subtabsel="sa_contactlist";
            // echo $this->renderElement('relationships_submenus');  ?> 
			<?php    $this->loginarea="contacts";    $this->subtabsel="sa_contactlist";
             echo $this->renderElement('memberlistsecondlevel_submenus');  ?> 
  </div>
</div>
<div class="rightpanel">
  <div id="center-column">
    <?php if($session->check('Message.flash')){ ?>
    <div id="blck">
      <div class="msgBoxTopLft">
        <div class="msgBoxTopRht">
          <div class="msgBoxTopBg"></div>
        </div>
      </div>
      <div class="msgBoxBg">
        <div class="">
          <?php
						e($html->link(
								$html->image('close.png',array('style'=>'margin-left: 945px; position: absolute; z-index: 11;','alt'=>'Close')),
								'javascript:void ',
								array('escape' => false,'onclick' => "hideDiv()")
								)
							);	
					?>
          <?php  $session->flash();    ?>
        </div>
        <div class="msgBoxBotLft">
          <div class="msgBoxBotRht">
            <div class="msgBoxBotBg"></div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="left">
      <!-- ADD Sub Admin FORM BOF -->
      <!-- ADD FIELD BOF -->
      <table width="100%">
        <tr>
          <td>
		  <?php
	
		  
		  if($this->params['pass'][2] === 'customer')
		  {
		  $customer = $this->params['pass'][2]; 
		echo $form->input("Contact.customer", array('id' => 'customer', 'value'=>$customer, 'type'=>'hidden', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));
		  }
		  ?>
		  
		  <?php if($session->check('Message.flash')){ $session->flash(); } 
      				 echo $form->error('Contact.company_id', array('class' => 'errormsg')); 
      				 echo $form->error('Contact.contact_type_id', array('class' => 'errormsg'));
      				 echo $form->error('Contact.firstname', array('class' => 'errormsg'));
      				 echo $form->error('Contact.lastname', array('class' => 'errormsg'));
      				 echo $form->hidden("Contact.id", array('id' => 'contactid'));
      				 echo $form->hidden("Contact.referelProject_id", array('value' => $referelProject_id));

      	?>
            <span id='companydata'></span>
		</td>
        </tr>
        <tr>
          <td valign="top"><table cellspacing="10" cellpadding="0" align="center">
              <tbody>
                <tr>
                  <td width="37%" align="right"><label class="boldlabel">Company <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="txtArea_top"><span class="txtArea_bot">
                    <?php 
			//var_dump($selectedcompany);
			//print_r($companydropdown);
			/*
			if($selectedcompany){
				echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
			}else{
				if($companydropdown){
							foreach($companydropdown as $key => $value){
									$firstid = $key;
									break;
							}
							echo $selectedcompany = $firstid;
							echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
						  }
				}
			*/
			echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
			echo $form->select("Contact.company_id",$companydropdown,$selectedcompany,array('id' => 'company_id','class'=>'multilist',"onchange"=>"getcompanyaddress(this.value);"),"---Select---"); ?>
                    </span></span> </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
				<?php
				if($this->data['Contact']['id'] && $realeted_projects_flag == true) {
				?>
				<tr>
                  <td width="35%" align="right" valign="top"><label class="boldlabel">Related to Project(s)</label></td>
				  <td>
				<?php
				 //$realetedProjects = array();
				 echo $form->select('ProjectOwner.owners',$realetedProjects, null,array('multiple'=>'multiple','id'=>'companies_bb','size'=>'4','empty'=>false,'class'=>'multilist','tabindex'=>2,'style'=>'min-height:32px;','disabled'=>'disabled'));
				?>
				</td>
				  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
				<?php
				}
				?>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">First Name <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"><?php echo $form->input("Contact.firstname", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Last Name <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"><?php echo $form->input("Contact.lastname", array('id' => 'lastname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Title <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.jobtitle", array('id' => 'jobtitle', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></span></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                </tr>
                <?php if(!$this->data['Contact']['id']){ ?>
                <tr>
				  <td></td>
				  <td align='left' colspan="2"><?php echo $form->input('sameascompany', array('type'=>'checkbox', 'label' => '','id'=>'sameascompany','onclick'=>'return putcountryaddress();','div'=>false )); ?> Check if same as Company Address</td>
				  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <?php } ?>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Address <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"><?php echo $form->input("Contact.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Country <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="txtArea_top"><span class="txtArea_bot"> <?php echo $form->select("Contact.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Contact")'),array('254'=>'United States')); ?> </span></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">State <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="txtArea_top"><span class="txtArea_bot"> <span id="statediv"> <?php echo $form->select("Contact.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); ?> </span></span> </span> </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">City <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150")); ?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Zip/Postal Code <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="5"><b>Any item with a</b> "<span class="red">*</span>" <b>requires an entry.</b></td>
                </tr>
              </tbody>
            </table></td>
          <td valign="top"><table cellspacing="10" cellpadding="0" align="center">
              <tbody>
                <tr>
                  <td width="32%" align="right">
				  <label class="boldlabel">Contact Type <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="txtArea_top"><span class="txtArea_bot"> 
					<?php 
					
					echo $form->select("Contact.contact_type_id",$contacttypedropdown,null,array('id' => 'contact_type_id','class'=>'multilist'),"---Select---");
					echo $form->hidden("default_contactType",array('value'=>$default_contactType,'id'=>'defaultContactType'));
					?></span></span>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Phone </label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.busphone", array('id' => 'busphone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "12",'onblur' =>'USPhoneNumberFormat(this.value)'));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Fax </label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "12",'onblur' =>'USFaxNumberFormat(this.value)'));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Cell Phone </label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.mobile", array('id' => 'mobile', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "12",'onblur' =>'USCellphoneNumberFormat(this.value)'));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Email <span class="red">*</span></label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr>
				<td colspan="5" align="center">
					<table style="display:none;" id="ProjectLoginDet">
						<?php
						if($this->data['Contact']['id'] && $realeted_projects_flag == true) {
						?>
						<tr>
							<td colspan="2" align="center"><strong>Project Name</strong></td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
						  <td width="20%" align="right"><label class="boldlabel">Username</label></td>
						  <td width="30%">
						   <span class="intpSpan"><?php echo $form->input("Sponsor.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'onchange' => 'ajaxuniquesponsorname(this.value)'));?>
						 </span></td>
						 
						</tr>
						<tr>
						  <td width="20%" align="right"><label class="boldlabel">Password</label></td>
						  <td width="30%">
						  <span class="intpSpan"><?php echo $form->password("Sponsor.password", array('id' => 'password', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
						  
						</tr>
					</table>
				
				</td>
				</tr>
				
				<?php
				
				?>
              </tbody>
            </table></td>
        </tr>
      </table>
      <?php echo $form->end();?>
      <!-- ADD Sub Admin  FORM EOF -->
    </div>
    <br>
  </div>
</div>
<!--inner-container ends here-->
<div class="clear"></div>
</div>
<!--container ends here-->
<script language='javascript'>
<?php if((!$this->data['Contact']['id'])) { ?>
getstateoptions('254',"Contact"); <?php } ?>

	$("#contact_type_id").change(function () {
		var str;
		str = $("#contact_type_id").val();
        //alert(str);
		loadContactLoginDetails(str);
		
	});
	
	function loadContactLoginDetails(str) {
		var cid = {id : str};
        $.ajax({
			type:"POST",
			url: baseUrl+"contacts/getcontact_projectLead_ajax",
			cache:false,
			data:cid,
			success: function(output){
				//alert(output);
				if(output == 1) 
				$("#ProjectLoginDet").show();
				else
				$("#ProjectLoginDet").hide();
			}
		});
	}
	
	var cID = $("#contact_type_id").val();
	var dID = $("#defaultContactType").val();
	if(cID == dID)
	$("#ProjectLoginDet").show();
	
	
	
/*function USPhoneNumberFormat(PhoneNumberInitialString)
  {
    var FmtStr="";
    var index = 0;
    var LimitCheck;

    LimitCheck = PhoneNumberInitialString.length;
    while (index != LimitCheck)
      {
        if (isNaN(parseInt(PhoneNumberInitialString.charAt(index))))
          { }
        else
          { FmtStr = FmtStr + PhoneNumberInitialString.charAt(index); }
        index = index + 1;
      }
    if (FmtStr.length == 10)
      {
        FmtStr = FmtStr.substring(0,3) + "-" + FmtStr.substring(3,6) + "-" + FmtStr.substring(6,10);
		$('#busphone').val(FmtStr);
      }
    else
      {
        FmtStr=PhoneNumberInitialString;
        inlineMsg('busphone','<strong>United States phone numbers must have exactly ten digits.</strong>',2);
		 return false; 
      }
    return FmtStr;
  }*/

 function USPhoneNumberFormat(PhoneNumberInitialString){
	var oRex = /^\(?([0-9]{3})+\)?[\-\s]?([0-9]{3})+[\-\s]?([0-9]{4})+$/; 
	if($('#busphone').val() ==''){
		return true;
	}else if($('#busphone').val() !=''){
		if(oRex.test(PhoneNumberInitialString)){
			return true;
		}else{
			inlineMsg('busphone','<strong>Please use valid phone format.</strong>',2);
			document.getElementById('busphone').focus();	
			return false;
		}
	}
	
  }
 function USFaxNumberFormat(PhoneNumberInitialString){
	var oRex = /^\(?([0-9]{3})+\)?[\-\s]?([0-9]{3})+[\-\s]?([0-9]{4})+$/; 
	if($('#fax').val() ==''){
		return true;
	}else if($('#fax').val() !=''){
		if(oRex.test(PhoneNumberInitialString)){
			return true;
		}else{
			inlineMsg('fax','<strong>Please use valid fax format.</strong>',2);
			this.focus();
			return false;
		}
	}

  } 
  function USCellphoneNumberFormat(PhoneNumberInitialString){
	var oRex = /^\(?([0-9]{3})+\)?[\-\s]?([0-9]{3})+[\-\s]?([0-9]{4})+$/; 
	if($('#mobile').val() ==''){
		return true;
	}else if($('#mobile').val() !=''){
		if(oRex.test(PhoneNumberInitialString)){
			return true;
		}else{
			inlineMsg('mobile','<strong>Please use valid Cell Phone number format.</strong>',2);
			document.getElementById('mobile').focus();	
			return false;
		}
	}	
  }
/*  function USFaxNumberFormat(PhoneNumberInitialString)
  {
    var FmtStr="";
    var index = 0;
    var LimitCheck;

    LimitCheck = PhoneNumberInitialString.length;
    while (index != LimitCheck)
      {
        if (isNaN(parseInt(PhoneNumberInitialString.charAt(index))))
          { }
        else
          { FmtStr = FmtStr + PhoneNumberInitialString.charAt(index); }
        index = index + 1;
      }
    if (FmtStr.length == 10)
      {
        FmtStr = FmtStr.substring(0,3) + "-" + FmtStr.substring(3,6) + "-" + FmtStr.substring(6,10);
		$('#fax').val(FmtStr);
      }
    else
      {
        FmtStr=PhoneNumberInitialString;
        inlineMsg('fax','<strong>United States fax numbers must have exactly ten digits.</strong>',2);
		 return false; 
      }
    return FmtStr;
  }*/
</script>
