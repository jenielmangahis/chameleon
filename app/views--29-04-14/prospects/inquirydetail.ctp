<script type="text/javascript">
$(document).ready(function() {
$('#prosMnu').removeClass("butBg");
$('#prosMnu').addClass("butBgSelt");
}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl=$base_url.'prospects/inquirylist/'.$enqtype;
echo $javascript->link('jqdialog');
echo $html->css('jqdialog');

?>
<div class="titlCont1" style="height:90px;">
    <div class="myclass">
        <div align="center" id="toppanel" >
            <?php 
                # set help condition
                App::import("Model", "HelpContent");
                $this->HelpContent =  & new HelpContent();
                $condition = "HelpContent.id = '47'";  
                $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
                $this->set("hlpdata",$hlpdata);
                # set help condition   
                echo $this->renderElement('new_slider'); 
            ?>
        </div>
       <!-- <span class="titlTxt1"><?php echo $current_project_name  ?>:&nbsp;</span>  -->					
					
        <span class="titlTxt">Submitted inquries : <?php    echo ucfirst($enqtype); ?> </span>

        <?php echo $form->create("prospects", array("action" => "inquirydetail",'type' => 'file','enctype'=>'multipart/form-data','name' => 'formtype_add', 'id' => "formtype_add"));  
      
            echo $form->hidden("FormSubmit.id", array('id' => 'formtype_id', 'div' => false, 'label' => '', "class" => "inpt_txt_fld","maxlength" => "200"));
		
		echo $form->hidden("enqtype", array('id' => 'enqtype','value'=>$enqtype));
		echo $form->hidden("is_editable", array('id' => 'is_editable','value'=>'0'));	
		if($nochange){
			echo $form->hidden("nochange", array('id' => 'nochange','value'=>'1'));	
		}		
       ?>
	<?php if($enqtype!='history'){?>
        <div class="topTabs">
            <ul>
                <li><button id="btndailog" type="button" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button id="btndailog" type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
            </ul>
        </div>
		<?php } ?>
		<div class="clear"></div>    
		 <div style="margin-left:5px;">
		 	      <?php
			 		if($enqtype ==trim('new')){
						$subtabsel = "newinquiry";
					}else if($enqtype ==trim('open')){
						$subtabsel = "openinquiry";
					}else{
						$subtabsel = "historylist";
					}
					$this->loginarea="prospects";    $this->subtabsel=$subtabsel;
                    echo $this->renderElement('prospect_submenus');  
			?>
		 </div>
	   
</div>
    </div>
</div>
<!--titlCont1 ends here-->


<!--inner-container starts here-->
<div class="centerPage">
   <div class="">
    
        <div class="">
            <div class="top-bar" style="border-left:0px;">  </div>
            <div class="">	
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>       
                <div class="clear"></div>
            </div>
                <div style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar" id="addcnttab"></div>
           <table border="1px solid red"  cellpadding="5" cellspacing="8" align="center" width="100%" >
                    <tbody>
                        <tr>
                            <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } ?>    </td>
                        </tr>
                        <tr>
                            <td width="50%" valign="top"> 
                                <table  cellpadding="5" cellspacing="8" align="center" width="100%" >
                                <tbody>
                                    <tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Name of Form</label>   </td>
                                        <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("formtype_name", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200", "value" => $this->data['FormType']['formtype_name']));?></span> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">Current Status</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
<?php 
$statustypedropdown = $common->getStatusTypeDropdown();
echo $form->select('FormSubmit.statustype_id',$statustypedropdown, $selectedstatustype,array('id'=>'current_status','empty'=>false,'class'=>'multilist multi'),"--Status Types--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
									
									<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">First name</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_firstname.", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
                                    
									<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Last name</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_lastname.", array('id' => 'lastname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
										<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Title</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_title.", array('id' => 'title', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
									
										<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Company</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_company.", array('id' => 'company', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
											<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Phone</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_phone.", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
								<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Email</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_email.", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>

<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Address1</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_address1.", array('id' => 'Address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>

<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Address2</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_address2.", array('id' => 'Address2', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>

<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">City</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_city.", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">ST/Province</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                            <?php echo $form->select('FormSubmit.fld_stprovince',$statedropdown, $selectedstate,array('id'=>'state','empty'=>false ,'class'=>'multilist multi'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
									
<tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">ZIP/Postal Code</label>   </td>
                                  <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("FormSubmit.fld_zippostalcode.", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
									
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">Country</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
      <?php if(!isset($this->data['FormSubmit']['fld_country']))
	  		{$countrydropdown = '--Select--';} echo $form->select('FormSubmit.fld_country',$countrydropdown,$selectedcountry,array('id'=>'country','empty'=>false , 'class'=>'multilist multi'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
                                    
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">How Did You Find Us</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                            <?php $formstatustypedropdown = array(); echo $form->select('FormSubmit.fld_country',$formstatustypedropdown, $selectedstatustype,array('id'=>'hdufu','empty'=>false,'class'=>'multilist multi'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
									
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">How Can We Help You</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                            <?php $formstatustypedropdown = array(); echo $form->select('FormSubmit.fld_country',$formstatustypedropdown, $selectedstatustype,array('id'=>'hcwhy','empty'=>false,'class'=>'multilist multi'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
                                    
<tr>	 
		<td valign='top' align="right"><label class="boldlabel">Message<span style="color:red">*</span></label></td>
		<td>
			<div class="large">
			<span class="txtArea_top">
				<span class="newtxtArea_bot">
					<?php echo $form->textarea("FormSubmit.fld_message", array('id' => 'message', 'div' => false, 'label' => '',
							'cols' => '35', 'rows' => '4',"class" => "multilist", 'style'=>'width:370px'));?>
				</span>
			</span>
			</div>
		</td>
	</tr>

                 
                                </table>
                            </td>
                            <td width="50%" valign="top"> 
                                                            <table border="1"  cellpadding="5" cellspacing="8" align="center" width="100%" >
                                <tbody>
                                     <tr>
                                        <td width="50%" valign="top" align="right"  style="padding-top: 2px;"> <label class="boldlabel">Date Submitted</label>   </td>
                                        <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("submit_created_show", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'DISABLED'=>'DISABLED',"maxlength" => "200","value" => date("m-d-Y H:i:s",strtotime($this->data['FormSubmit']['created'])) ));?></span> </td>
                                    </tr>
                                    
                                     <tr>
                                        <td width="50%" valign="top" align="right"  style="padding-top: 2px;"> <label class="boldlabel">Date of Status</label>   </td>
                                        <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("status_modified_show", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'DISABLED'=>'DISABLED',"maxlength" => "200","value" => date("m-d-Y H:i:s",strtotime($this->data['FormSubmit']['modified']))));?></span> </td>
                                    </tr>                                    
                                    <tr>
                            <td  align="right" valign="top"  style="padding-top: 4px;"> <label class="boldlabel">Company Type</label></td>
                            <td >
                                      <span class="txtArea_top">
                                <span class="txtArea_bot">
                                      <?php echo $form->select('company_type',$companytypedropdown, $selectedcompanytype,array('id'=>'company_type','empty'=>false,'class'=>'multilist multi'), "-- Select --");?>
                                </span>     </span>  &nbsp;
                        </td>
                           
                        </tr>
                        
                         <tr>
                            <td  align="right" valign="top"  style="padding-top: 4px;"> <label class="boldlabel">Contact Type</label></td>
                            <td  >
                                      <span class="txtArea_top">
                                <span class="txtArea_bot">
                                      <?php echo $form->select('contact_type',$contacttypedropdown, $selectedcontacttype,array('id'=>'contact_type','empty'=>false,'class'=>'multilist multi'), "-- Select --");?>
                                </span>     </span> &nbsp;
                          </td>
                          
                        </tr>
						<tr>	 
		<td valign='top' align="right"><label class="boldlabel">Inquiry Notes<span style="color:red">*</span></label></td>
		<td>
			<div class="large">
			<span class="txtArea_top_enq">
				<span class="newtxtArea_bot">
					<?php echo $form->textarea("FormSubmit.fld_notes", array('id' => 'note', 'div' => false, 'label' => '',
							'cols' => '75', 'rows' => '7',"class" => "multilist", "style" =>"width:325px;"));?>
				</span>
			</span>
			<div  style="margin-top:7px;">
				<span class="btnLft"><input type="button" value="Enter Date & time" tabindex=14 id="enterdate" class="btnRht" name="enterdate" onclick="enterCurrentDate();"  /></span>
					</div>
			</div>
		</td>
	</tr>
                                    
                                </tbody>
                                </table>
                            </td>
                        </tr>
                       
                    </tbody>
                    </table>
               <!-- ADD Sub Admin  FORM EOF -->

        </div>
        

<!--inner-container ends here-->

<?php echo $form->end();?>

<div class="top-bar" style="margin-bottom: 10px; text-align: left; padding-top: 5px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>

  
<div class="clear"></div>
</div></div>


<div class="clear"></div>
<script type="text/javascript">
  function getformstateoptions(countryid,modelname) {   
       
        countryid=$("#countrykey").val();
        modelname="Sponsor";
       var statekey=$("#statekey").val();
       jQuery.ajax({
             type: "GET",
             url: '/companies/selectstateoptions/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                   
                     jQuery('#state').html(rText);
                     $("#state option[value='"+statekey+"']").attr('selected', 'selected');
             }
     });
      
}
   
   function enterCurrentDate(){
   		var now = new Date();
		    dateStr = now.toDateString()+' '+now.getHours()+' : '+now.getMinutes();
		$("#note").val($("#note").val()+dateStr+'\n');

   }
 //getformstateoptions('254',"Sponsor");  
 var status = $('#is_editable').val();
 $('#formtype_name,#firstname,#lastname,#title,#company,#phone,#email,#Address1,#Address2,#city,#state,#zipcode,#current_status,#state,#country,#hdufu,#hcwhy,#message,#company_type,#contact_type,#note').change(function() {
  $('#is_editable').val('1');
 });

$("#btndailog").click(function() {
var enqtype = $('#enqtype').val(); 
var isedit = $('#is_editable').val(); 
 if(isedit == '0'){
 	//var status = confirm("Did you forget to change the Current Status?");
	$.jqDialog.confirm("Did you forget to change the Current Status?",
			function() { 
				return false;
			 },		// callback function for 'YES' button
			function() { 
				location.href = baseUrl+"prospects/inquirylist/"+enqtype;
			 }, 1		// callback function for 'NO' button
		);	
}
else{
		//alert('Do you really want to change data');
			$.jqDialog.confirm("Do you really want to change data?",
			function() { 
				//location.href = baseUrl+"prospects/inquirydetail/";
				$('#formtype_add').submit();
				//return false;
			 },		// callback function for 'YES' button
			function() { 
				return false;
			 },2		// callback function for 'NO' button
		);	
 }
});
 </script>