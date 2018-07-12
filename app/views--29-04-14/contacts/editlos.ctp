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
    <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
	<?php
        $editUrl = "editlos/".$this->data['Contact']['id']; 
        echo $form->create("contacts", array("action" => $editUrl,'type' => 'file','enctype'=>'multipart/form-data','name' => 'editlos', 'id' => "editlos","onsubmit"=>"return validatecontactslos('$act');"))?>
	  <button class="sendBut" id="Submit" name="redirectpage" type="submit">
	 <?php e($html->image('save.png')); ?> </button>
      <button class="sendBut" id="Submit" name="noredirection" type="submit">
	   <?php e($html->image('apply.png')); ?></button>
	   <?php e($html->link($html->image('cancle.png') . ' ' . __(''), "editlos",array('escape' => false))); 
	   ?>
	  <?php  echo $this->renderElement('new_slider');  ?>
    </div>
     <span class="titlTxt"><?php echo $head; 

      ?> </span>
	 
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
            array('controller'=>'contacts','action'=>'editlos'),
            array('escape' => false)
            )
            );
          ?>
        </li>
      </ul><?php */?>
    </div>
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
          <td><?php if($session->check('Message.flash')){ $session->flash(); } 
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
                  <td width="37%" align="right"><label class="boldlabel">Job Type</label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="txtArea_top"><span class="txtArea_bot">
                    <?php 

                      echo $form->input("Contact.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));

                      echo $form->input("Contact.contact_type_id", array('id' => 'contact_type_id', 'type'=>'hidden', 'value'=>'262' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));

                       echo $form->input("Contact.ContactLo_id", array('id' => 'ContactLo_id', 'type'=>'hidden', 'value'=> $this->data['Contact']['ContactLo_id']  ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));

                    ?>

                    <?php
                      $jobtypedropdown = array(
                                    'type1' => 'Type1',
                                    'type2' => 'Type2'
                                  );
  
            echo $form->input('Contact.jobtype', array('options'=>$jobtypedropdown,'id' => 'jobtype', 'class'=>'multilist','label' => false,
                                  'empty'=>'------ Select ------'));


            ?>
                    </span></span> </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
        
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
                                        <td width="20%" align="right"><label class="boldlabel">Avatar </label></td>
                                         <td width="30%">
                                         <div style="float: left; width: 80%;">
                                           <span class="intpSpan">
                                            
                                            <?php echo $form->input("Contact.avatar", array('div' => false, 'label' => '',"class"=>"inpt_txt_fld1",'type'=>'file', 'style' => 'width: 165px; vertical-align: middle;'));?>
                                </span>

                                    </div> 
                                        <div style="float: right; width: 20%;"> <!-- style="margin-left: 160px;" -->
                                        <?php
                                            if( $this->data['Contact']['image']!='')
                                            {
                                               ?>
                                            <!-- if no avatr image- show defailt -->  
                                            <img src="<?php echo $this->webroot."uploads/".$this->data['Contact']['image']; ?>" width="50px" height="50px" >   
                                            <?php 

                                            }else{       ?>
                                            <!-- if no avatr image- show defailt -->  
                                            <img src="<?php echo $this->webroot."img/avatar/image-not-available.png"; ?>" width="50px" height="50px" >   
                                            <?php    }    
                                            if(isset($badge)) {      ?>
                                            <img src="<?php echo $this->webroot."img/avatar/image-not-available.png"; ?>" width="30px" height="30px" >   
                                            <!-- <img src="<?php echo $this->webroot.$badge; ?>" width="30px" height="30px">-->
                                        <?php }?>
                                     </div>
                                     <br/>
                                        </td>
        </tr>

                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Title </label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.jobtitle", array('id' => 'jobtitle', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></span></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
                </tr>

                <tr>
                  <td width="20%" align="right"><label class="boldlabel">MNLS#</label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.nmls", array('id' => 'nmls', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></span></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
                </tr>



               
                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Address1</label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"><?php echo $form->input("Contact.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>


                <tr>
                  <td width="20%" align="right"><label class="boldlabel">Address2</label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"><?php echo $form->input("Contact.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
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
                  <td width="20%" align="right"><label class="boldlabel">City</label></td>
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
                  <td width="20%" align="right"><label class="boldlabel">Phone </label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="intpSpan"> <?php echo $form->input("Contact.busphone", array('id' => 'busphone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "12",'onblur' =>'USPhoneNumberFormat(this.value)'));?></span></td>
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

<tr>          
          <td width="20%" align="right">
          <label class="boldlabel">Emails Sent</label>
         </td>
         <td width="30%">
            <div class="small" >
              <span class="txtArea_top">
                <span class="newtxtArea_bot">
                  <div class="scrolldown">
                <table cellpadding="5" cellspacing="5" width="100%" >
                  <tr align="left">
                    <th width="10%">
                      <input type="checkbox" id="emailsentcheckall" />
                    </th>
                    <th width="20%">
                      Date
                    </th>
                    <th width="20%">
                      Subject
                    </th>
                    <th width="25%">
                      Templates
                    </th>
                   </tr>
                <?php                   
                      foreach($targetProject as $projectdata):                                
                          echo '<tr><td><input type="checkbox" id="emailsentcheck'.$projectdata['Project']['id'].'" name="data[Project][ids][]" value="'.$projectdata['Project']['id'].'" ';
                      
echo (!empty($checkedrelproject) && in_array($projectdata['Project']['id'],$checkedrelproject))?'checked="checked"' :'';                      
                    
                     echo ' /></td> <td>'.$projectdata['Project']['project_name'].'</td><td>'.$projectdata['Sponsor']['city'].'</td><td>'. AppController::getstatename($projectdata['Sponsor']['state']).'</td></tr>';
                    endforeach; ?>
                </table>
                </div>
              </span>
            </span>
            </div> 
        </td>
        
         </tr>

                <tr>
                  <td colspan="5"><b>Any item with a</b> "<span class="red">*</span>" <b>requires an entry.</b></td>
                </tr>
              </tbody>
            </table></td>
          <td valign="top"><table cellspacing="10" cellpadding="0" align="center">
              <tbody>

                    </tr>   
    
        
        
                <tr>
                  <td width="32%" align="right">
          <label class="boldlabel">Production Level</label></td>
                  <td width="30%"><label for="project_name"></label>
                    <span class="txtArea_top"><span class="txtArea_bot"> 
          <?php 
          $plevel = array('1' => 'PLevel1','2' => 'PLevel2');
          echo $form->select("Contact.production_level",$plevel,null,array('id' => 'production_level','class'=>'multilist'),"---Select---");
          ?></span></span>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
               
<tr>          
          <td width="32%" align="right">
          <label class="boldlabel">Licences</label>
         </td>
         <td width="30%">
            <div class="small" >
              <span class="txtArea_top">
                <span class="newtxtArea_bot">
                  <div class="scrolldown">
                <table cellpadding="5" cellspacing="5" width="100%" >
                  <tr align="left">
                    <th width="10%">
                      <input type="checkbox" id="licensecheckall" />
                    </th>
                    <th width="20%">
                      State
                    </th>
                    <th width="20%">
                      Expire
                    </th>
                    <th width="25%">
                      Type
                    </th>
                      <th width="25%">
                      Status
                    </th>
                   </tr>
                <?php                   
                      foreach($targetProject as $projectdata):                                
                          echo '<tr><td><input type="checkbox" id="licensecheck'.$projectdata['Project']['id'].'" name="data[Project][ids][]" value="'.$projectdata['Project']['id'].'" ';
                      
echo (!empty($checkedrelproject) && in_array($projectdata['Project']['id'],$checkedrelproject))?'checked="checked"' :'';                      
                    
                     echo ' /></td> <td>'.$projectdata['Project']['project_name'].'</td><td>'.$projectdata['Sponsor']['city'].'</td><td>'. AppController::getstatename($projectdata['Sponsor']['state']).'</td></tr>';
                    endforeach; ?>
                </table>
                </div>
              </span>
            </span>
            </div> 
        </td>
        
         </tr>

         <tr>         
          <td width="32%" align="right">
          <label class="boldlabel">Notes</label>
         </td>
         <td width="30%">
            <div class="small" >
              <span class="txtArea_top">
                <span class="newtxtArea_bot">
                  <div class="scrolldown">
                <table cellpadding="5" cellspacing="5" width="100%" >
                  <tr align="left">
                    <th width="10%">
                      <input type="checkbox" id="notescheckall" />
                    </th>
                    <th width="40%">
                      Date
                    </th>
                    <th width="50%">
                      Subject
                    </th>               
                   </tr>
                <?php                   
                      foreach($targetProject as $projectdata):                                
                          echo '<tr><td><input type="checkbox" id="notescheck'.$projectdata['Project']['id'].'" name="data[Project][ids][]" value="'.$projectdata['Project']['id'].'" ';
                      
echo (!empty($checkedrelproject) && in_array($projectdata['Project']['id'],$checkedrelproject))?'checked="checked"' :'';                      
                    
                     echo ' /></td> <td>'.$projectdata['Project']['project_name'].'</td><td>'.$projectdata['Sponsor']['city'].'</td><td>'. AppController::getstatename($projectdata['Sponsor']['state']).'</td></tr>';
                    endforeach; ?>
                </table>
                </div>
              </span>
            </span>
            </div> 
        </td>
        
         </tr>

        <tr><td colspan="5">&nbsp;</td></tr>
          <tr>
                                        <td align="right" ><label class="boldlabel">Facebook</label></td>
                                        <td ><label for="project_name"></label><span class="intpSpan">
                                            <?php echo $form->input("Contact.facebook", array('id' => 'facebook', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>

                                    </tr>

                                    <tr>
                                        <td align="right" ><label class="boldlabel">Twitter</label>&nbsp;</td>
                                        <td ><label for="project_name"></label><span class="intpSpan">
                                            <?php echo $form->input("Contact.twitter", array('id' => 'twitter', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>

                                    </tr>

                                    <tr>
                                        <td align="right" ><label class="boldlabel">Google</label>&nbsp;</td>
                                        <td ><label for="project_name"></label><span class="intpSpan">
                                            <?php echo $form->input("Contact.google", array('id' => 'google', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>

                                    </tr>

                                    <tr>
                                        <td align="right" ><label class="boldlabel">LinkedIn</label>&nbsp;</td>
                                        <td ><label for="project_name"></label><span class="intpSpan">
                                            <?php echo $form->input("Contact.linkedin", array('id' => 'linkedin', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>

                                    </tr>
                   <tr>
                                        <td align="right" ><label class="boldlabel">Pinterest</label>&nbsp;</td>
                                        <td ><label for="project_name"></label><span class="intpSpan">
                                            <?php echo $form->input("Contact.pinterest", array('id' => 'pinterest', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>

                                    </tr>

                                <tr>
                                    <td colspan="2" align="center"><font size="3px"><b>Email Subscriptions</b></font></td>
                  
                                </tr>
                                <?php 
                                    if($userSubscriptionTypes) { $itemCnt=0;
                                        $selectedTypes=array();
                                        $selectedTypes=explode(",", $this->data['Contact']['email_subscription']);
                                    ?>
                                    <tr>
                                        <?php    foreach($userSubscriptionTypes as $typeid=>$type){
                                                if(in_array($typeid, $selectedTypes)){
                                                    $chk='checked="checked" ';
                                                }else{
                                                    $chk='';
                                                }
                                                if($itemCnt==2) {
                                                    echo " </td></tr><tr>";
                                                    $itemCnt=0;
                                                }
                                                if($itemCnt==0){
                                                ?>          
                                                <td  align="right">
                          <label class="boldlabel"> <?php echo $type;  ?>  </label>
                        </td>
                                                <td> <div style="width: 10px; float: left; text-align: left;">
                          <input class="subscription_type_checks" type="checkbox" <?php echo $chk;?> name="data[Contact][subscription_type_id][]" value="<?php echo $typeid;?>" >
                                               </div>
                                                <?php  }else if($itemCnt==1){ ?> <div style="width: 220px; float: right; text-align: right;"> <label class="boldlabel" style="padding-right: 2px"><?php echo $type;  ?> </label>
                                                        <input type="checkbox" class="subscription_type_checks" <?php echo $chk;?> name="data[Contact][subscription_type_id][]" value="<?php echo $typeid;?>" >                                                        
                                               </div>
                               <?php  } ?>  <?php    $itemCnt++;   } ?>
                                    </tr>
                                    <?php  }?>

        
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
</script>
