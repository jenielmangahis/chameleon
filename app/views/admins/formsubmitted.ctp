<?php $lgrt = $session->read('newsortingby');
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl=$base_url_admin.'formsubmitlist';
?>
<div class="titlCont1">
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
        <span class="titlTxt1"><?php echo $current_project_name  ?>:&nbsp;</span>  
        <span class="titlTxt">
            <?php    echo "Submitted Form"; ?>
        </span>

        <?php echo $form->create("Admin", array("action" => "formsubmitted/$formubmittedid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'formtype_add', 'id' => "formtype_add" , "onsubmit"=>""));  //"onsubmit"=>"return validate_form('$act');" 
        if(isset($formtypeid)){
            echo $form->hidden("FormType.id", array('id' => 'formtype_id', 'div' => false, 'label' => '', 'value' => $formtypeid, "class" => "inpt_txt_fld","maxlength" => "200"));
        }  ?>

        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
            </ul>
        </div>

    </div>

</div>
<!--titlCont1 ends here-->


<!--inner-container starts here-->
<div style="width:990px; margin:0 auto">
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
                            <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } ?>    </td>
                        </tr>
                        <tr>
                            <td width="50%" valign="top"> 
                                <table  cellpadding="5" cellspacing="8" align="center" width="100%" >
                                <tbody>
                                    <tr>
                                        <td width="50%" valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Name of Form</label>   </td>
                                        <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("formtype_name", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200","disabled" => "disabled", "value" => $this->data['FormType']['formtype_name']));?></span> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">Current Status</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                            <?php echo $form->select('FormSubmit.statustype_id',$formstatustypedropdown, $selectedstatustype,array('id'=>'emailtemplate_toalert_mgr','empty'=>false,'class'=>'multilist multi'),"--Status Types--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
                                    
                                    <?php
                                    $countrykey='254';
                                    $statehtml="";
                                    $msghtml="";
                                    
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
                                          $msghtml.="<tr>  <td width='23%'  align='right' valign='top' style='padding-top: 2px;'> <label class='boldlabel'>".ucfirst($fldnm); 
                                         if($this->data['FormType'][$req_fldnm]=='1'){   
                                               $msghtml.="<span style='color: red;'>*</span>";  
                                               }
                                         $msghtml.="</label><input type='hidden' name='".$req_fldnm."' id='".$req_fldnm."' value='".$this->data['FormType'][$req_fldnm]."'></td>";
                                        $msghtml.="<td   width='75%'   align='left'><span class='txtArea_topform' style='width:500px'><span class='txtArea_botform'> ";
                                         $msghtml.="<textarea id='".$fld."' name='".$fld."' class='noBg' disabled='disabled'  cols='35' row='7' style='height: 100px;'>".trim($this->data['FormSubmit'][$fld])."</textarea></span></span></td> </tr>"; 
                                         
                                      }else if($fldnm=="country"){   ?>
                                <tr> <td align='right' valign='top' style="padding-top: 4px;">
                                 <label class='boldlabel'><?php echo ucfirst($fldnm); ?>
                                 <?php if($this->data['FormType'][$req_fldnm]=='1'){   ?>
                                        <span style="color: red;">*</span>   
                                        <?php }?>
                                 </label>
                                 <input type="hidden" name="<?php echo $req_fldnm;?>" id="<?php echo $req_fldnm;?>" value="<?php echo $this->data['FormType'][$req_fldnm];?>">
                                 <input type="hidden" name="countrykey" id="countrykey" value="<?php echo $this->data['FormSubmit'][$fld];?>">
                                 </td>
                                <td width='60%' align="left">
                                <span class='txtArea_top'><span class='txtArea_bot'>
                                <select disabled='disabled' name='<?php echo $fld?>' id='<?php echo $fld; ?>' empty='' class='multilist multi' onchange="javascript: getstateoptions(this.value,'Sponsor')">    
                                <?php  $countrykey=$this->data['FormSubmit'][$fld];
                                
                                foreach($countrydropdown as $key=>$val){ 
                                    $selected='' ;
                                   
                                    if($key==$countrykey )
                                        $selected='selected="selected"';
                                    ?>
                                           <option  value='<?php echo $key; ?>' <?php echo $selected;?>><?php echo $val; ?></option>
                                <?php }?>
                                  </select></span><span></td>
                                </tr>
                                <?php if($statehtml!=""){
                                    echo $statehtml;
                                } ?>
                          <?php  }else if($fldnm=="stprovince"){   $fldnm_lbl="ST/Province"; ?>
                          
                          <?php
                               $statehtml="<tr> <td  align='right' valign='top' style='padding-top: 4px;'> <label class='boldlabel'>".ucfirst($fldnm_lbl); ?>
                              
                                 <?php if($this->data['FormType'][$req_fldnm]=='1'){   
                                        $statehtml.="<span style='color: red;'>*</span>  ";
                                         }
                                 $statehtml.="</label>"; 
                                 $statehtml.="<input type='hidden' name='".$req_fldnm."' id='".$req_fldnm."' value='".$this->data['FormType'][$req_fldnm]."'>";
                                 $statehtml.="<input type='hidden' name='statekey' id='statekey' value='".$this->data['FormSubmit'][$fld]."'></td>";
                                 $statehtml.="<td  align='left'><span class='txtArea_top'><span class='txtArea_bot'>"; 
                                 $statehtml.="<select disabled='disabled' name='".$fld."' id='state' empty='' class='multilist multi' >  <option value=''>--Select--</option>";
                                 $statehtml.="</select></span><span></td>   </tr>";
                                  ?>
                              
                          <?php  }else if($fldnm=="list1" || $fldnm=="list2"){     
                                       
                                       $fld_label=  $this->data['FormType']['fld_'.$fldnm.'_label'];
                                       $order   = array("\r\n", "\n", "\r"); 
                                       $lst_fld_options= str_replace($order, "#", $this->data['FormType']['fld_'.$fldnm.'_options']); 
                                       $option_lines = explode("#",$lst_fld_options);    ?>
                                         <tr> 
                                        <td  align='right' valign='top' style="padding-top: 4px;">
                                        <label class='boldlabel' ><?php echo  ucfirst($fld_label); ?>
                                         <?php if($this->data['FormType'][$req_fldnm]=='1'){   ?>
                                        <span style="color: red;">*</span>   
                                        <?php }?>
                                        </label>
                                        <input type="hidden" name="<?php echo $req_fldnm;?>" id="<?php echo $req_fldnm;?>" value="<?php echo $this->data['FormType'][$req_fldnm];?>">
                                        </td>
                                        <td  align="left"> <span class='txtArea_top'><span class='txtArea_bot'>
                                        <select name='fld_<?php echo $fldnm?>' id='fld_<?php echo $fldnm; ?>' empty='' class='multilist multi' disabled="disabled" >
                                        <option value='' >Select Options</option>
                                    <?php     for($l=0; $l < sizeof($option_lines); $l++){ 
                                                $selected="";
                                                if($option_lines[$l]==$this->data['FormSubmit'][$fld]){
                                                    $selected='selected="selected"';
                                                }
                                       ?>
                                                 <option value='<?php echo $option_lines[$l]; ?>'  <?php echo $selected; ?>><?php echo $option_lines[$l]; ?></option>
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
                                    <td  align='right' valign='top' style="padding-top: 2px;"><label class='boldlabel'><?php echo $fldnm_lbl; ?>
                                    <?php if($this->data['FormType'][$req_fldnm]=='1'){   ?>
                                        <span style="color: red;">*</span>   
                                        <?php }?>
                                    </label>
                                    <input type="hidden" name="<?php echo $req_fldnm;?>" id="<?php echo $req_fldnm;?>" value="<?php echo $this->data['FormType'][$req_fldnm];?>">
                                    </td>
                                    <td  align="left"><span class='intpSpan'>
                                    <input type='text' id='<?php echo $fld; ?>' name='<?php echo $fld; ?>' value='<?php echo $this->data['FormSubmit'][$fld];?>' class='inpt_txt_fld'  maxlength='200' disabled="disabled">
                                     </span></td>
                                     </tr> 
                         <?php   }  ?>
                           
                            
                           <?php  }     
                            } 
                        }
                        ?>
                                </tbody>
                                </table>
                            </td>
                            <td width="50%" valign="top"> 
                                                            <table  cellpadding="5" cellspacing="8" align="center" width="100%" >
                                <tbody>
                                     <tr>
                                        <td width="50%" valign="top" align="right"  style="padding-top: 2px;"> <label class="boldlabel">Date Submitted</label>   </td>
                                        <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("submit_created_show", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200","disabled" => "disabled","value" => date("m-d-Y H:i:s",strtotime($this->data['FormSubmit']['created'])) ));?></span> </td>
                                    </tr>
                                    
                                     <tr>
                                        <td width="50%" valign="top" align="right"  style="padding-top: 2px;"> <label class="boldlabel">Date of Status</label>   </td>
                                        <td width="50%" valign="top" align="left"> <span class="intpSpan"><?php echo $form->input("status_modified_show", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200","disabled" => "disabled","value" => date("m-d-Y H:i:s",strtotime($this->data['FormSubmit']['modified']))));?></span> </td>
                                    </tr>
                                    
                                      <tr>
                            <td  align="right" valign="top"  style="padding-top: 4px;"> <label class="boldlabel">Company Type</label></td>
                            <td >
                                      <span class="txtArea_top">
                                <span class="txtArea_bot">
                                      <?php echo $form->select('company_type',$companytypedropdown, $selectedcompanytype,array('id'=>'company_type','empty'=>false,"disabled" => "disabled",'class'=>'multilist multi'), "-- Select --");?>
                                </span>     </span>  &nbsp;
                             <!--   <span class="btnLft" >
                             <input type="button" onclick="javascript:(window.location='/admins/addcompany')" name="Add" value="Add" class="btnRht">
                             </span>  -->
                         </td>
                           
                        </tr>
                        
                         <tr>
                            <td  align="right" valign="top"  style="padding-top: 4px;"> <label class="boldlabel">Contact Type</label></td>
                            <td  >
                                      <span class="txtArea_top">
                                <span class="txtArea_bot">
                                      <?php echo $form->select('contact_type',$contacttypedropdown, $selectedcontacttype,array('id'=>'contact_type','empty'=>false,'class'=>'multilist multi',"disabled" => "disabled"), "-- Select --");?>
                                </span>     </span> &nbsp;
                            <!--    <span class="btnLft">
                             <input type="button" onclick="javascript:(window.location='/admins/addcontacts')" name="Add" value="Add" class="btnRht">
                             </span>   -->
                         </td>
                          
                        </tr>
                                    
                                </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php if($msghtml!="") { ?>
                            
                        
                        <tr>
                            <td colspan="2" width="100%"> 
                            <table width="100%" cellpadding="5" cellspacing="8" align="center"  >
                            <?php echo $msghtml;?>
                            </table>
                            </td>
                        </tr>
                        <?php }?>
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
   
 getformstateoptions('254',"Sponsor"); 
 

 </script>