<style>
.rightbotimg{
background: none repeat scroll 0% 0% rgb(255, 255, 255); text-align: center; padding: 10px 0;
}
.rightbotimg li{
float: left; padding:7px;
}
.ulclass{
list-style:none;
}

.loadCls{
    background: url("../../../img/enq-loading.gif") top center no-repeat;padding-top:52px;
}
</style>
<div class="rightbotimg" id="sumanTest">
<?php 
          if($project_id && $formtypeid && $this->data['FormType']){
              
                $project_name=ucfirst($project['Project']['project_name']);     
      ?>
      <div class="boxBor">
        <div class="boxPad">
         <!--   <h2 style="margin-left:-30px;">< ?php  echo $project_name." - ".$this->data['FormType']['formtype_name'];  ?></h2>     -->
     
	
	  <div class="rightbotimg">
       <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span>
       <div class="clear"></div>
       </div>
       
         <?php echo  $form->create('Company',array('action'=>'iframeforms/'.$project_id.'/'.$formtypeid,'id'=>'InquiryForm',"onsubmit"=>"return validate_form();"  ));?> 
         <table cellpadding='3' cellspacing='0' align='center' width='100%'>
         <tbody>
         
             
        <?php $statehtml="";
              $ziphtml="";
             foreach($this->data['FormType'] as $key=>$val){
                        $fld=$key;
                        $fldname= explode("_", $fld);
                        if($val==1 && $fldname[0]=="fld" &&  $fld!="fld_list1_label" &&  $fld!="fld_list1_options" &&  $fld!="fld_list2_label" &&  $fld!="fld_list2_options" ){
                            $fldnm= $fldname[1];
                            if($fldnm!="" && $fldnm!=NULL){  
                            // Required filed name
                            $req_fldnm="req_".$fldnm;         
                        ?>
                           
                       <?php     if($fldnm=="message"){   
                                    if($ziphtml!=""){
                                           echo $ziphtml;
                                           $ziphtml=""; 
                                       }
                           ?>
                                 <tr><td width='30%' align='right' valign='top'>
                                 <label class='frmLbls frmLbl2' style='width:auto;'><?php echo ucfirst($fldnm); ?>
                                 <?php if($this->data['FormType'][$req_fldnm]=='1'){   ?>
                                        <span style="color: red;">*</span>   
                                        <?php }?>
                                 </label>
                                 <input type="hidden" name="<?php echo $req_fldnm;?>" id="<?php echo $req_fldnm;?>" value="<?php echo $this->data['FormType'][$req_fldnm];?>">
                                 </td>
                                <td width='70%' align="left"><span class='txtArea_top'><span class='newtxtArea_bot'> 
                                <textarea id='<?php echo $fld; ?>' name='<?php echo $fld; ?>' class='noBg'   row='7' style='height: 100px; width:296px; margin-top:-4px;'></textarea> 
                                </span></span></td>
                                </tr>
                          <?php  }else if($fldnm=="country"){   ?>
                                <tr> <td width='30%' align='right' valign='top'>
                                 <label class='frmLbls frmLbl2' style='width:auto;'><?php echo ucfirst($fldnm); ?>
                                 <?php if($this->data['FormType'][$req_fldnm]=='1'){   ?>
                                        <span style="color: red;">*</span>   
                                        <?php }?>
                                 </label>
                                 <input type="hidden" name="<?php echo $req_fldnm;?>" id="<?php echo $req_fldnm;?>" value="<?php echo $this->data['FormType'][$req_fldnm];?>">
                                 </td>
                                <td width='70%' align="left">
                                <span class='intpSpan'><span class='inptSpn_rht'>
                                <select name='<?php echo $fld?>' id='<?php echo $fld; ?>' empty='' class='inpt_sel_fld' onchange="javascript: getstateoptions(this.value,'Sponsor')">
                                <?php foreach($countrydropdown as $key=>$val){ 
                                    $selected='' ;
                                    if($key=='254' && $val=='United States')
                                        $selected='selected="selected"';
                                    ?>
                                           <option  value='<?php echo $key; ?>' <?php echo $selected;?>><?php echo $val; ?></option>
                                <?php }?>
                                  </select></span><span></td>
                                </tr>
                                <?php if($statehtml!=""){
                                    echo $statehtml;
                                } ?>
                          <?php  }else if($fldnm=="stprovince"){   $fldnm_lbl="ST/Province";
                               $statehtml="<tr> <td width='30%' align='right' valign='top'> <label class='frmLbls frmLbl2' style='width:auto;'>".ucfirst($fldnm_lbl); ?>
                              
                                 <?php if($this->data['FormType'][$req_fldnm]=='1'){   
                                        $statehtml.="<span style='color: red;'>*</span>  ";
                                         }
                                 $statehtml.="</label>"; 
                                 $statehtml.="<input type='hidden' name='".$req_fldnm."' id='".$req_fldnm."' value='".$this->data['FormType'][$req_fldnm]."'></td>";
                                 $statehtml.="<td width='70%' align='left'><span class='intpSpan'><span class='inptSpn_rht'>"; 
                                 $statehtml.="<select name='".$fld."' id='".$fld."' empty='' class='inpt_sel_fld' >  <option value=''>--Select--</option>";
                                 $statehtml.="</select></span><span></td>   </tr>";
                                    if($ziphtml!=""){
                                           echo $ziphtml;
                                           $ziphtml="";
                                       }
                                  
                          }else if($fldnm=="zippostalcode"){   $fldnm_lbl="Zip/Postal Code";
                               $ziphtml="<tr><td width='30%' align='right' valign='top'><label class='frmLbls frmLbl2' style='width:auto;'>".ucfirst($fldnm_lbl); ?>
                              
                                 <?php if($this->data['FormType'][$req_fldnm]=='1'){   
                                        $ziphtml.="<span style='color: red;'>*</span>  ";
                                         }
                                 $ziphtml.="</label>"; 
                                 $ziphtml.="<input type='hidden' name='".$req_fldnm."' id='".$req_fldnm."' value='".$this->data['FormType'][$req_fldnm]."'></td>";
                                 $ziphtml.="<td width='70%' align='left'><span class='intpSpan'>"; 
                                 $ziphtml.="<input type='text' name='".$fld."' id='".$fld."' class='inpt_txt_fld'  maxlength='200'> </span></td></tr>";
                                 
                                  ?>
                              
                          <?php  }else if($fldnm=="list1" || $fldnm=="list2"){     
                                     if($ziphtml!=""){
                                           echo $ziphtml;
                                           $ziphtml="";
                                       }
                                       $fld_label=  $this->data['FormType']['fld_'.$fldnm.'_label'];
                                       $order   = array("\r\n", "\n", "\r"); 
                                       $lst_fld_options= str_replace($order, "#", $this->data['FormType']['fld_'.$fldnm.'_options']); 
                                       $option_lines = explode("#",$lst_fld_options);    ?>
                                       
                                     <tr>   <td width='30%' align='right' valign='top' >
                                        <label class='frmLbls frmLbl2' style='width:auto;' ><?php echo  ucfirst($fld_label); ?>
                                         <?php if($this->data['FormType'][$req_fldnm]=='1'){   ?>
                                        <span style="color: red;">*</span>   
                                        <?php }?>
                                        </label>
                                        <input type="hidden" name="<?php echo $req_fldnm;?>" id="<?php echo $req_fldnm;?>" value="<?php echo $this->data['FormType'][$req_fldnm];?>">
                                        </td>
                                        <td width='70%' align="left"> <span class='intpSpan'><span class='inptSpn_rht'>
                                        <select name='fld_<?php echo $fldnm?>' id='fld_<?php echo $fldnm; ?>' empty='' class='inpt_sel_fld'>
                                        <option value=''>Select Options</option>
                                    <?php     for($l=0; $l < sizeof($option_lines); $l++){    ?>
                                                 <option value='<?php echo $option_lines[$l]; ?>'><?php echo $option_lines[$l]; ?></option>
                                    <?php     } ?>
                                          </select></span><span></td>
                                          
                                    </tr>
                              <?php  }else {
                                    if($fldnm=="firstname") {
                                        $fldnm_lbl="First Name";
                                    }else if($fldnm=="lastname") {
                                            $fldnm_lbl="Last Name";
                                    }else if($fldnm=="zippostalcode") {
                                            $fldnm_lbl="Zip/Postal Code";
                                     }else{
                                            $fldnm_lbl=ucfirst($fldnm);
                                    }  ?>
                                   <tr> 
                                    <td width='30%' align='right' valign='top'><label class='frmLbls frmLbl2' style='width:auto;'><?php echo $fldnm_lbl; ?>
                                    <?php if($this->data['FormType'][$req_fldnm]=='1'){   ?>
                                        <span style="color: red;">*</span>   
                                        <?php }?>
                                    </label>
                                    <input type="hidden" name="<?php echo $req_fldnm;?>" id="<?php echo $req_fldnm;?>" value="<?php echo $this->data['FormType'][$req_fldnm];?>">
                                    </td>
                                    <td width='70%' align="left"><span class='intpSpan'><input type='text' id='<?php echo $fld; ?>' name='<?php echo $fld; ?>' class='inpt_txt_fld'  maxlength='200'> </span></td>
                                    </tr>
                         <?php   } 
                                   
                          ?>
                      
                            
                       <?php  }     
                        } 
                    }
                     if($ziphtml!=""){
                                           echo $ziphtml;
                                           $ziphtml="";
                                       }
         ?>
           <tr>  
           <td width='40%' align='right' valign='top'>  </td>
           <td width='60%' align="left"> <span>
                         <span class="flx_button_lft ">
                         <?php echo $form->submit('Submit', array('div'=>false,"class"=>"flx_flexible_btn", "name"=>'send'));?> 
                         </span>
                         
                     </span></td>
         </tbody></table>       
                
         <div align="center">
             <?php  //echo $strFormHtml; //$this->data['FormType']['form_html'];  ?>
         </div>
        <?php echo $form->end();?> 
	  <div class="clear"></div>
	  </div>
          
        </div>
    </div>
	  <?php 
} else{
    ?>
    <div style=" text-align: center; ">
     Could not complete the operation. <br/> One or more parameter values are not valid OR  required parameter is missing. 
    </div>
    <?php
}?>
</div>

<script type="text/javascript">
  function getstateoptions(countryid,modelname) {   
       if(countryid==""){
          return false;
       }

       jQuery.ajax({
             type: "GET",
             url: baseUrl+'companies/selectstateoptions/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                     jQuery('#fld_stprovince').html(rText);
             }
     });
      
}
   
 getstateoptions('254',"Sponsor"); 
 
      function validate_form(){
         
          
           if($('#req_firstname') && $('#req_firstname').val() == '1')
             {
                if(trim($('#fld_firstname').val()) == '')
                 {
                     inlineMsg('fld_firstname','<strong>Firstname Name required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_firstname').val()) == true){
                     inlineMsg('fld_firstname','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
             if($('#req_lastname') && $('#req_lastname').val() == '1')
             {
                if(trim($('#fld_lastname').val()) == '')
                 {
                     inlineMsg('fld_lastname','<strong>Lastname Name required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_lastname').val()) == true){
                     inlineMsg('fld_lastname','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
              if($('#req_title') && $('#req_title').val() == '1')
             {
                if(trim($('#fld_title').val()) == '')
                 {
                     inlineMsg('fld_title','<strong>Title required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_title').val()) == true){
                     inlineMsg('fld_title','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
             
              if($('#req_company') && $('#req_company').val() == '1')
             {
                if(trim($('#fld_company').val()) == '')
                 {
                     inlineMsg('fld_company','<strong>Company required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_company').val()) == true){
                     inlineMsg('fld_company','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }      
             
              if($('#req_phone') && $('#req_phone').val() == '1')
             {
                if(trim($('#fld_phone').val()) == '')
                 {
                     inlineMsg('fld_phone','<strong>Phone required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_phone').val()) == true){
                     inlineMsg('fld_phone','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 }
                 
                   var inpVal = parseInt(trim($('#fld_phone').val()), 10);
                    if (isNaN(inpVal)) {
                         inlineMsg('fld_phone','<strong>Please enter a number only.</strong>',2);
                         return false;
                    }
                
             }
             
              if($('#req_email') && $('#req_email').val() == '1')
             {
                if(trim($('#fld_email').val()) == '')
                 {
                     inlineMsg('fld_email','<strong>Email required.</strong>',2);
                     return false;
                 }
                 
                  if(!validateemail($('#fld_email').val()))
                 {
                     inlineMsg('fld_email','<strong>Please enter valid email address.</strong>',2);
                     return false;
                 }
         
                 if(tagValidate($('#fld_email').val()) == true){
                     inlineMsg('fld_email','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                 
                
             }
             
              if($('#req_address1') && $('#req_address1').val() == '1')
             {
                if(trim($('#fld_address1').val()) == '')
                 {
                     inlineMsg('fld_address1','<strong>Address1 required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_address1').val()) == true){
                     inlineMsg('fld_address1','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
              if($('#req_address2') && $('#req_address2').val() == '1')
             {
                if(trim($('#fld_address2').val()) == '')
                 {
                     inlineMsg('fld_address2','<strong>Address2 required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_address2').val()) == true){
                     inlineMsg('fld_address2','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
               if($('#req_city') && $('#req_city').val() == '1')
             {
                if(trim($('#fld_city').val()) == '')
                 {
                     inlineMsg('fld_city','<strong>City required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_city').val()) == true){
                     inlineMsg('fld_city','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
              if($('#req_stprovince') && $('#req_stprovince').val() == '1')
             {
                if(trim($('#fld_stprovince').val()) == '')
                 {
                     inlineMsg('fld_stprovince','<strong>St/Province required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_stprovince').val()) == true){
                     inlineMsg('fld_stprovince','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
               if($('#req_zippostalcode') && $('#req_zippostalcode').val() == '1')
             {
                if(trim($('#fld_zippostalcode').val()) == '')
                 {
                     inlineMsg('fld_zippostalcode','<strong>Zip/Postal Code required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_zippostalcode').val()) == true){
                     inlineMsg('fld_zippostalcode','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
               if($('#req_country') && $('#req_country').val() == '1')
             {
                if(trim($('#fld_country').val()) == '')
                 {
                     inlineMsg('fld_country','<strong>Country required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_country').val()) == true){
                     inlineMsg('fld_country','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
              if($('#req_list1') && $('#req_list1').val() == '1')
             {
                if(trim($('#fld_list1').val()) == '')
                 {
                     inlineMsg('fld_list1','<strong>List1 required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_list1').val()) == true){
                     inlineMsg('fld_list1','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
              if($('#req_list2') && $('#req_list2').val() == '1')
             {
                if(trim($('#fld_list2').val()) == '')
                 {
                     inlineMsg('fld_list2','<strong>List2 required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_list2').val()) == true){
                     inlineMsg('fld_list2','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
             
              if($('#req_message') && $('#req_message').val() == '1')
             {
                if(trim($('#fld_message').val()) == '')
                 {
                     inlineMsg('fld_message','<strong>Message required.</strong>',2);
                     return false;
                 }
                 if(tagValidate($('#fld_message').val()) == true){
                     inlineMsg('fld_message','<strong>Please dont use script tags.</strong>',2);
                     return false; 
                 } 
                
             }
          return true;
      }   
        
    function validateemail(email) { 
        var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
       
        
         if(email=="")
         {
             
             return false;
         }
         if(!email.match(emailRegex))
          {
           
            return false;
          }
         
        return true;
    }
	
//$('.rightbotimg').css('background', 'url("img/ajax-pageloader.gif")');
$('#sumanTest').addClass('loadCls');
$(window).load(function() {
  //$('.sumanTest').css('opacity', 1);
  $('#sumanTest').removeClass('loadCls');
});
</script>