<script type="text/javascript">
	$(document).ready(function() {
		$('#FormtLst').removeClass("butBg");
		$('#FormtLst').addClass("butBgSelt");
	}); 
</script> 
<?php
	echo $javascript->link('colorpicker/js/eye.js');
	echo $javascript->link('colorpicker/js/colorpicker.js');
	echo $javascript->link('colorpicker/js/utils.js');
	echo $html->css('colorpicker/colorpicker.css');
	$lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
?>
<script type="text/javascript">
        var clip = null;        
        function init() {
           /* clip = new ZeroClipboard.Client();
            clip.setHandCursor( true );
            clip.addEventListener('load', function (client) {
            debugstr("Flash movie loaded and ready.");
            });
            clip.addEventListener('mouseOver', function (client) {
            // update the text on mouse over
            clip.setText( $('codeval').value );
            });
            clip.addEventListener('complete', function (client, text) {
            debugstr("Copied text to clipboard: " + text );
            });
            clip.glue( 'd_clip_button', 'd_clip_container' );  */
            } 
</script>    
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Form Add/Edit</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php 
					# set help condition
					App::import("Model", "HelpContent");
					$this->HelpContent =  & new HelpContent();
					$condition = "HelpContent.id = '47'";  
					$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
					$this->set("hlpdata",$hlpdata);
					# set help condition   
				  
				?>
				
				
				<?php echo $form->create("Admins", array("action" => "formtype_add",'type' => 'file','enctype'=>'multipart/form-data','name' => 'formtype_add', 'id' => "formtype_add", "onsubmit"=>"return validate_formadd();" ));
				if(isset($formtypeid)){
				echo $form->hidden("FormType.id", array('id' => 'formtype_id', 'div' => false, 'label' => '', 'value' => $formtypeid, "class" => "inpt-txt-fld form-control","maxlength" => "200"));
				
				}
				if(isset($redirect)&&$redirect!=null){
				echo $form->hidden("Newredirect", array('id' => 'Newredirect', 'div' => false, 'label' => '', 'value' => $redirect, "class" => "inpt-txt-fld form-control","maxlength" => "200"));
				}
				?>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
				<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>formtypelist')"><?php e($html->image('cancle.png')); ?></button>
				<?php echo $this->renderElement('new_slider'); ?> 
            </div>
        </div>
    </div>

</div>
<!--titlCont1 ends here-->


<!--inner-container starts here-->
<div class="midCont clearfix">
   <div class="">
    
        <div class="">
            <div class="top-bar" style="border-left:0px;">  </div>
            <div class="">	
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>       
                <div class="clear"></div>
            </div>
                <div style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar" id="addcnttab"></div>
                <table  cellpadding="5" cellspacing="8" align="center" width="100%" >
                    <tbody>
                        <tr>
                            <td colspan="3"><?php if($session->check('Message.flash')){ $session->flash(); } 
                                 /*   echo $form->error('Contact.company_id', array('class' => 'errormsg')); 
                                    echo $form->error('Contact.contact_type_id', array('class' => 'errormsg'));
                                    echo $form->error('Contact.firstname', array('class' => 'errormsg'));
                                    echo $form->error('Contact.lastname', array('class' => 'errormsg'));
                                    echo $form->hidden("Contact.id", array('id' => 'contactid'));         */
                                ?>

                            </td>

                        </tr>
                        
                        <tr>
                            <td colspan="5" width="100%"> 
                            <table  width="100%">
                                <tr>
                                    <td width="16%" style="padding-bottom: 12px;">
                                  <label class="boldlabel">Name of Form Type <span style="color: red;">*</span></label></td>
                                    <td width="24%" align="left"> <span class="intp-Span"><?php echo $form->input("FormType.formtype_name", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
                                    <?php if(isset($formtypeid)){ 
                                        $addemailtempurl="/admins/addmailtemplate/formtype_add_id_".$formtypeid;
                                        ?> 
                                    <td width="30%" align="right" valign="top" style="padding-top: 2px;"> <label class="boldlabel">Created Date </label></td>  
                                    <td width="30%" align="left" valign="top">
                                      <span class="intp-Span"><?php echo $form->input("createddate", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200", 'value'=>date("m-d-Y", strtotime($this->data['FormType']['created']))));?></span> </td>
                                   </td> 
                                   <?php }else{   $addemailtempurl="/admins/addmailtemplate/formtype_add"; ?>
                                       <!--<td colspan="2"  >&nbsp;</td>-->
                                  <?php } ?>   
                                </tr> 
								
						
	
			 </table>
           </td>
        </tr>
		
		<tr  valign="top" >
			<td  colspan="4">
				&nbsp;&nbsp;<label>Background Color</label>
				# <span class="intp-Span"><?php echo $form->input('FormType.backcolor',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span> &nbsp;&nbsp;
				<label >Text Color</label>
				# <span class="intp-Span"><?php echo $form->input('FormType.textcolor',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span>
			</td>
			
		</tr>  
                       
                        
                        <tr>
                            <td width="7%"  align="left" valign="top"> <label class="boldlabel">Include</label></td>
                            <td width="8%" align="left" valign="top"> <label class="boldlabel">Required</label></td>  
                            <td width="85%" colspan="3" align="left" valign="top">&nbsp; </td>  
                        </tr>
                      <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_title" name="chkfld[]" value="fld_title" class="checkid" <?php if($this->data['FormType']['fld_title']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_title" name="reqfld[]" value="req_title" class="checkid" <?php if($this->data['FormType']['req_title']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="left" width="25%"><label class="boldlabel">Title</label></td>
                             <td width="60%" colspan="2">&nbsp;  </td>  
                        </tr>
                        
                      <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_company" name="chkfld[]" value="fld_company" class="checkid" <?php if($this->data['FormType']['fld_company']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_company" name="reqfld[]" value="req_company" class="checkid" <?php if($this->data['FormType']['req_company']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="left" width="25%"><label class="boldlabel">Company</label></td>
                            <td width="60%" colspan="2" >&nbsp;  </td>  
                        </tr>
                        
                      <tr  valign="top">
                            <td align="center" width="7%"><input type="checkbox" id="chk_phone" name="chkfld[]" value="fld_phone" class="checkid" <?php if($this->data['FormType']['fld_phone']==1){ echo 'checked="checked"'; }?>></td>       
                            <td align="center" width="8%"><input type="checkbox" id="req_phone" name="reqfld[]" value="req_phone" class="checkid" <?php if($this->data['FormType']['req_phone']==1){ echo 'checked="checked"'; }?>></td>       
                            <td align="left" width="25%"><label class="boldlabel">Phone</label></td>
                            <td width="60%" colspan="2" >&nbsp;  </td>  
                        </tr>
                        

                        
                      <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_addr1" name="chkfld[]" value="fld_address1" class="checkid"  <?php if($this->data['FormType']['fld_address1']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_addr1" name="reqfld[]" value="req_address1" class="checkid"  <?php if($this->data['FormType']['req_address1']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="left" width="25%"><label class="boldlabel">Address 1</label></td>
                            <td width="60%" colspan="2" >&nbsp;  </td>
                        </tr>
                        
                      <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_addr2" name="chkfld[]" value="fld_address2" class="checkid"  <?php if($this->data['FormType']['fld_address2']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_addr2" name="reqfld[]" value="req_address2" class="checkid" style="display: none;" ></td>       
                            <td  align="left" width="25%"><label class="boldlabel">Address 2</label></td>
                            <td width="60%" colspan="2" >&nbsp;  </td>
                        </tr> 
                      
                        <tr  valign="top">
                            <td width="7%" align="center"><input type="checkbox" id="chk_city" name="chkfld[]" value="fld_city" class="checkid"  <?php if($this->data['FormType']['fld_city']==1){ echo 'checked="checked"'; }?>></td>       
                            <td width="8%" align="center"><input type="checkbox" id="req_city" name="reqfld[]" value="req_city" class="checkid"  <?php if($this->data['FormType']['req_city']==1){ echo 'checked="checked"'; }?>></td>       
                            <td width="25%" align="left"><label class="boldlabel">City</label></td>
                           <td width="60%"  colspan="2" >&nbsp;  </td>
                        </tr>
                        
                    
                      
                        
                      <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_country" name="chkfld[]" value="fld_country" class="checkid" <?php if($this->data['FormType']['fld_country']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_country" name="reqfld[]" value="req_country" class="checkid" <?php if($this->data['FormType']['req_country']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="left" width="25%"><label class="boldlabel">Country</label></td>
                            <td width="60%" colspan="2" >&nbsp;  </td>
                        </tr> 
                        
                        <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_state" name="chkfld[]" value="fld_stprovince" class="checkid"  <?php if($this->data['FormType']['fld_stprovince']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_state" name="reqfld[]" value="req_stprovince" class="checkid"  <?php if($this->data['FormType']['req_stprovince']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="left" width="25%"><label class="boldlabel">St/Province</label></td>
                            <td width="60%" colspan="2" >&nbsp;  </td>
                        </tr>
                        
                          
                      <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_zip" name="chkfld[]" value="fld_zippostalcode" class="checkid" <?php if($this->data['FormType']['fld_zippostalcode']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_zip" name="reqfld[]" value="req_zippostalcode" class="checkid" <?php if($this->data['FormType']['req_zippostalcode']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="left" width="25%"><label class="boldlabel">Zip/Postal Code</label></td>
                            <td width="60%" colspan="2">&nbsp;  </td>
                        </tr>
                        
                       <tr valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_list1" name="chkfld[]" value="fld_list1" class="checkid" <?php if($this->data['FormType']['fld_list1']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_list1" name="reqfld[]" value="req_list1" class="checkid"  <?php if($this->data['FormType']['req_list1']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="left" width="25%"> <span class="intp-Span"><?php echo $form->input("FormType.fld_list1_label", array('id' => 'fld_list1_label', 'div' => false,  'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span>
                           <small>(Please enter label)</small>    
                            </td>
                            <td width="35%">
                                  <div id="list1_opts" >
                                 <span class="txtArea-top">
                                            <span class="newtxtArea-bot">
                                                <?php echo $form->input("FormType.fld_list1_options", array('id' => 'fld_list1_options', 'div' => false, 'label' => '','rows'=>'5',"class" => "noBg form-control",  "style" => "width:100%; ", "value"=> $this->data['FormType']['fld_list1_options']));?>
                                            </span>
                                        </span> <br/>
                                        <small>(Please Enter options)</small>  
                               </div>  

                            </td>
                             <td  width="25%">&nbsp;  </td>
                        </tr>
                          
                         <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_list2" name="chkfld[]" value="fld_list2" class="checkid" <?php if($this->data['FormType']['fld_list2']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_list2" name="reqfld[]" value="req_list2" class="checkid" <?php if($this->data['FormType']['req_list2']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="left" width="25%"> <span class="intp-Span">
                            <?php echo $form->input("FormType.fld_list2_label", array('id' => 'fld_list2_label', 'div' => false,  'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span>
                             <small>(Please enter label for list)</small>    
                            </td>
                            <td width="35%">     
                               <div id="list2_opts" > 
                                 <span class="txtArea-top">
                                            <span class="newtxtArea-bot">
                                                <?php echo $form->input("FormType.fld_list2_options", array('id' => 'fld_list2_options', 'div' => false, 'label' => '','rows'=>'5', "style" => "width:100%; ","class" => "noBg form-control", "value"=> $this->data['FormType']['fld_list2_options']));?>
                                            </span>
                                        </span>   <br/>
                                      <small>(Please Enter options)</small>   
                               </div>    
                            </td>
                             <td  width="25%">&nbsp;  </td>
                        </tr>
                        
                        <tr  valign="top">
                            <td  align="center" width="7%"><input type="checkbox" id="chk_message" name="chkfld[]" value="fld_message" class="checkid" <?php if($this->data['FormType']['fld_message']==1){ echo 'checked="checked"'; }?>></td>       
                            <td  align="center" width="8%"><input type="checkbox" id="req_message" name="reqfld[]" value="req_message" class="checkid" <?php if($this->data['FormType']['req_message']==1){ echo 'checked="checked"'; }?> ></td>       
                            <td  align="left" width="25%"><label class="boldlabel">Message</label></td>
                             <td width="55%" colspan="2" >&nbsp;  </td> 
                        </tr> 
                        
                          <tr  valign="top" >  <td colspan="4" width="100%" >&nbsp;  </td>   </tr> 
                         <tr>
                            <td  colspan="3" align="right" valign="top" width="40%" style="padding-top: 4px;"> <label class="boldlabel">Email Template Response </label></td>
                            <td width="60%">
                                      <span class="txtArea-top">
                                <span class="txtArea_bot">
                                      <?php echo $form->select('FormType.emailtemplate_toresponce',$respondaremail, $selectedtemplateresponce,array('id'=>'emailtemplate_toresponce','empty'=>false,'class'=>'multi-list form-control'),"---Select---");?>
                                </span>     </span> &nbsp;
                                <span class="btn-Lft">
                             <input type="button" onclick="addEmailTempforResponse();" name="Add" value="Add" class="btn-Rht btn btn-primary btn-sm">
                             </span>
                         </td>                               
                        </tr>
						
						<tr>
                            <td  colspan="3" align="right" valign="top" width="40%" style="padding-top: 2px;"> <label class="boldlabel">CC Email <!--<span style="color: red;">*</span>--></label></td>
                            <td colspan="2" width="60%">
                            <span class="txtArea-topform" style ="width:250px;">
                                            <span class="txtArea-botform">
                                        <?php echo $form->textarea("FormType.fld_ccemail", array('id' => 'ccmail', 'div' => false, 'label' => '','cols' => '40', 'rows' => '3',"class" => "socialtxt-Area1 form-control", "style" => "width:100%;"));?>
                                    </span></span>
                         </td>
                        </tr>
						
						                        
                          <tr>
                            <td  colspan="3" align="right" valign="top" width="40%" style="padding-top: 4px;"> <label class="boldlabel">Company Type</label></td>
                            <td width="60%" colspan="2"> 
                                      <span class="txtArea-top">
                                <span class="txtArea_bot">
                                      <?php echo $form->select('FormType.company_type',$companytypedropdown, null,array('id'=>'company_type','empty'=>false,'class'=>'multi-list form-control'), "-- Select --");?>
                                </span>     </span>  &nbsp;
  <span class="btn-Lft" >
                             <input type="button" onclick="addNewCompanyType();"  name="Add" value="Add" class="btn-Rht btn btn-primary btn-sm">  
                           
                             </span>        
                         </td>
                           
                        </tr> 
                        
                         <tr>
                            <td  colspan="3" align="right" valign="top" width="40%" style="padding-top: 4px;"> <label class="boldlabel">Contact Type</label></td>
                            <td  width="60%">
                                      <span class="txtArea-top">
                                <span class="txtArea_bot">
                                      <?php echo $form->select('FormType.contact_type',$contacttypedropdown, null,array('id'=>'contact_type','empty'=>false,'class'=>'multi-list form-control'), "-- Select --");?>
                                </span>     </span> &nbsp;
                               <span class="btn-Lft">
                             <input type="button" onclick="addNewContactType();"  name="Add" value="Add" class="btn-Rht btn btn-primary btn-sm">  
                             </span>   
                         </td>
                          
                        </tr> 
                        
                         <tr>
                            <td  colspan="3" align="right" valign="top" width="40%" style="padding-top: 2px;"> <label class="boldlabel">Form Description <!--<span style="color: red;">*</span>--></label></td>
                            <td colspan="2" width="60%">
                            <span class="txtArea-topform">
                                            <span class="txtArea-botform">
                                        <?php echo $form->textarea("FormType.form_description", array('id' => 'form_description', 'div' => false, 'label' => '','cols' => '200', 'rows' => '5',"class" => "socialtxt-Area1 form-control", "style" => "width: 100%;"));?>
                                    </span></span>
                         </td>
                        </tr>
                        
                        <?php if(isset($formtypeid)){ ?>
                         <tr>
                            <td width="40%" colspan="3" align="right">&nbsp;</td>
                            <td width="60%" colspan="2" >
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td width="66%">  
                                        <div>
                                        <span class="txtArea-topform">
                                            <span class="txtArea-botform">
                                                <textarea id="codeval" style="width: 100%;" class="socialtxt-Area1 form-control" cols="2000" rows="5"></textarea>
                                                </span></span></div></td>
                                        <td width="34%"> <div style="padding-left: 5px;">
                                        <ul style="list-style:none;">
                                        <li><button type="button" value="Getsource" id="getiframesource" class="button" name="Getsource"    ><span>Get iFrame Source</span></button></li>
                                    <li><span>&nbsp;</span></li>
                                        <li id="d_clip_container"><button type="button" id="d_clip_button" value="Copy" class="newblue" name="copyb" onclick="this.form.codeval.focus();this.form.codeval.select();"><span>Copy</span></button></li>
                                        </ul>
                                        </div></td>
                                    </tr>
                                    </tbody>
                                    </table>
                         </td>
                        </tr>  
                        <?php }?>
                        
                    </tbody>
                </table>                                <!-- ADD Sub Admin  FORM EOF -->

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



statechecktoggle();

	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcnttab").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
    function addEmailTempforResponse() {   
         $('#emailtemplate_toresponce').focus();
         var resWindow=  window.open (baseUrlAdmin+'addmailtemplate/popup', 'AddTemp','location=1,status=1,scrollbars=1, width=950,height=650');
          resWindow.focus();
    }
    
    function addEmailTempforAlter() {  
         $('#emailtemplate_toalert_mgr').focus();
         var alertWindow= window.open (baseUrlAdmin+'addmailtemplate/popup', 'AddTemp','location=1,status=1,scrollbars=1, width=950,height=650'); 
          alertWindow.focus();
    }
    
    function addNewCompanyType() {  
         $('#company_type').focus();
         var compWindow= window.open (baseUrlAdmin+'projectcompanytypes_add/0/popup', 'AddTemp','location=1,status=1,scrollbars=1, width=950,height=650');
         compWindow.focus();
    }
    
    function addNewContactType() {  
         $('#contact_type').focus();
         var contWindow= window.open (baseUrlAdmin+'projectcontacttypes_add/0/popup', 'AddTemp','location=1,status=1,scrollbars=1, width=950,height=650');
          contWindow.focus();   
    }
   
   // This function is called after closing of child window ie. on page addmailtemplate.ctp 
    function GetEmailTempRefresh(){
       // alert("Refresh EMail temp dorp dwon");
        var pid='<?php echo $projectid;?>';
        var selectedid=$("#emailtemplate_toresponce").val();
        getemailtemplatesbyajax(pid, 'emailtemplate_toresponce', selectedid );
        
        var alert_selectedid=$("#emailtemplate_toalert_mgr").val();
        getemailtemplatesbyajax(pid, 'emailtemplate_toalert_mgr', alert_selectedid );
    }
    
    function GetCompanyTypeRefresh(){
          var pid='<?php echo $projectid;?>';
          var selectedid=$("#company_type").val();
          getcompanytypesbyajax(pid, 'company_type', selectedid );                      
    }
    
    function GetContactTypeRefresh(){
           var pid='<?php echo $projectid;?>';
          var selectedid=$("#contact_type").val();
          getcontacttypesbyajax(pid, 'contact_type', selectedid );                      
    }
	
	
     function validate_formadd(){
		if(trim($('#formtype_name').val()) == '')
		{
		 inlineMsg('formtype_name','<strong>Formtype Name required.</strong>',2);
		 return false;
		}
		if(tagValidate($('#formtype_name').val()) == true){
		inlineMsg('formtype_name','<strong>Please dont use script tags.</strong>',2);
		return false; 
		} 
		if($('#releationship_type').val() == '')
		{
		 inlineMsg('releationship_type','<strong>Releationship Type Name required.</strong>',2);
		 return false;
		} 
		//checkid
        var boxes_checked = $("input[@name=chkfld[]]:checked").length; 
		if( boxes_checked == '0' || boxes_checked == 0) {
			inlineMsg('chk_title','<strong>Please select at least one checkbox.</strong>',2);
			return false;
		}
		
		if($("#chk_list1").attr('checked')){ 
			 
			  if(trim($('#fld_list1_label').val()) == '')
			 {
				 inlineMsg('fld_list1_label','<strong>List1 Label required.</strong>',2);
				 return false;
			 }
			 
			  if(trim($('#fld_list1_options').val()) == '')
			 {
				 inlineMsg('fld_list1_options','<strong>List1 options required.</strong>',2);
				 return false;
			 }
		}

		if($("#chk_list2").attr('checked')){

		 if(trim($('#fld_list2_label').val()) == '')
			 {
				 inlineMsg('fld_list2_label','<strong>List2 Label required.</strong>',2);
				 return false;
			 }
			 
		 if(trim($('#fld_list2_options').val()) == '')
			 {
				 inlineMsg('fld_list2_options','<strong>List2 options required.</strong>',2);
				 return false;
			 }
		}
            
        return true;     
    }
    
    function statechecktoggle(){ 
        if($("#chk_country").attr('checked')){ 
             $("#chk_state").removeAttr("disabled");
             $("#req_state").removeAttr("disabled");
           
        }else{ 
             $("#chk_state").attr("disabled", true);
             $("#req_state").attr("disabled", true);
             $("#chk_state").removeAttr("checked");
             $("#req_state").removeAttr("checked");
        }
        
        if($("#chk_list1").attr('checked')){ 
                 $("#fld_list1_label").removeAttr("disabled");
                 $("#fld_list1_options").removeAttr("disabled");
               
            }else{ 
                
                 $("#fld_list1_label").attr("disabled", true);
                 $("#fld_list1_label").val('');
                 $("#fld_list1_options").attr("disabled", true);
                 $("#fld_list1_options").val('');
            }
        
         if($("#chk_list2").attr('checked')){ 
                     $("#fld_list2_label").removeAttr("disabled");
                     $("#fld_list2_options").removeAttr("disabled");
                   
                }else{ 
                     $("#fld_list2_label").attr("disabled", true);
                     $("#fld_list2_label").val('');
                     $("#fld_list2_options").attr("disabled", true);
                      $("#fld_list2_options").val('');
                }
        
    }
    
    $(document).ready(function(){
        $("#getiframesource").click(function(){            
        var counter=0;
        var id="";
        $('.checkid').each(function(){        
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
            {    
                    id=$(this).val();
                    counter=counter +1;
            }
           });            

        if(counter== 0)
        {
            alert("please include at least one field to form.");
            return false;
            }else{    
              var onloadfun="adjustMyFrameHeight('formiframe'); ";
              var code='<script type="text/javascript" src="'+baseUrl+'js/myiFrame.js"></'+'script>';
              var pid='<?php echo $projectid;?>';
              var fid='<?php echo $formtypeid;?>';
                  code += "<iframe id='formiframe' scrolling='no' frameborder='0' src='"+baseUrl+"companies/iframeforms/"+pid+"/"+fid+"' style='border:none; width:900px;' onload='"+onloadfun+"' ></"+"iframe>";
                  document.getElementById("codeval").value=code;
            }
      });    
        
       $("#chk_country").click(function(){
         if($("#chk_country").attr('checked')){ 
             $("#chk_state").removeAttr("disabled");
             $("#req_state").removeAttr("disabled");
           
        }else{ 
             $("#chk_state").attr("disabled", true);
             $("#req_state").attr("disabled", true);
             $("#chk_state").removeAttr("checked");
             $("#req_state").removeAttr("checked");
        }
       });
       
         $("#chk_list1").click(function(){ 
             if($("#chk_list1").attr('checked')){ 
                 $("#fld_list1_label").removeAttr("disabled");
                 $("#fld_list1_options").removeAttr("disabled");
               
            }else{ 
                
                 $("#fld_list1_label").attr("disabled", true);
                 $("#fld_list1_label").val('');
                 $("#fld_list1_options").attr("disabled", true);
                 $("#fld_list1_options").val('');
            }
         });
         
          $("#chk_list2").click(function(){
                      if($("#chk_list2").attr('checked')){ 
                     $("#fld_list2_label").removeAttr("disabled");
                     $("#fld_list2_options").removeAttr("disabled");
                   
                }else{ 
                     $("#fld_list2_label").attr("disabled", true);
                     $("#fld_list2_label").val('');
                     $("#fld_list2_options").attr("disabled", true);
                      $("#fld_list2_options").val('');
                }
         });
          
         $("#fld_list2_options").blur(function(){
            //  generate_list_opts("fld_list2_options", "list2", "");
         });
          
         function toggle_list_opts(chk_fldname, list_opt_fld_name) {
                  var check =  $("#"+chk_fldname).attr('checked')?1:0;
                  if(check ==1)
                    {
                        $("#"+list_opt_fld_name).show();
                    }else{

                         $("#"+list_opt_fld_name).hide();    
                    }        
         }  
         
         function generate_list_opts(list_opt_fld_name, list_fld_name, selectedOption){
                   var fld_list_options =    $("#"+list_opt_fld_name).val();
                   
                   $("#"+list_fld_name)
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Options</option>')
                    .val("");
                   var select = $("#"+list_fld_name);
                   var options = select.attr('options');
                   

                  var option_lines = fld_list_options.split(/\r\n|\r|\n/);  
                    $.each(option_lines, function(){
                        if(this!=""){
                                 options[options.length] = new Option(this, this);  
                        }
                             
                     });
                    if(selectedOption && selectedOption!=""){
                          select.val(selectedOption);   
                    }
         }
    }); 
</script>
<script type="text/javascript" language="javascript">    
    $('#FormTypeBackcolor,#FormTypeTextcolor').ColorPicker({
                onSubmit: function(hsb, hex, rgb, el) {
                    $(el).val(hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            })
            $('pincolor').bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });
			
			
</script>