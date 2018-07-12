<?php //$lgrt = $session->read('newsortingby');?>
<?php
echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
//echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');  
?>
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">

<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				  $('#startdateBP').datetime({
									  userLang : 'en',
									  americanMode: false, 
								});
 					$('#enddateBP').datetime({
									  userLang : 'en',
									  americanMode: false, 
								});
			});
            
            var dateobj = new Date();
   
        $(function() {
                    
                    $('#member_agefrom').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   // yearRange: currDate+':'+rangeDate 
                });
                
                $('#member_ageto').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   //  yearRange: currDate+':'+rangeDate 
                });
               
               
                 $('#task_startdate').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   // yearRange: currDate+':'+rangeDate 
                });
                
                $('#task_end_by_date').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   //  yearRange: currDate+':'+rangeDate 
                });
               
          });
          
	/* ]]> */	
	</script>
    
    
    
  

 <div class="container">
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel" style="height: 15px;">
     <?php  echo $this->renderElement('new_slider');  ?>   
</div>

       <?php echo $form->create("Company", array("action" => "event_task/".$rec_event_id,'name' => 'event_task', 'id' => "event_task",'onsubmit'=>'return validatecommtask();')); 
    
    
 if($taskrecid){
     echo $form->hidden("CommunicationTask.id", array('id' => 'taskid', 'div' => false, 'label' => '', 'value'=>$taskrecid));
      echo $form->hidden("isedit", array('id' => 'isedit', 'div' => false, 'label' => '', 'value'=>'1'));
 }else{
    echo $form->hidden("isedit", array('id' => 'isedit', 'div' => false, 'label' => '', 'value'=>'0')); 
 }
 
 echo $form->hidden("CommunicationTask.send_event_invitation", array('id' => 'send_event_invitation', 'div' => false, 'label' => '', 'value'=>'1'));
 
 if($taskrecid!="")
 $head="Edit Event Task";
 else
 $head="Add Event Task";
 ?>

 <span class="titlTxt"> <?php echo $head;?></span>


<div class="topTabs">
<ul>
<?php
                if($taskrecid!="")
                {
                    if($tdata['CommunicationTask']['task_is_done']==0)
                    {
                        $allow_save=1;
                    }
                    else
                        $allow_save=0;
                }
                else
                    $allow_save=1;    
                
                if( ($taskrecid!="" && $allow_save==1) || $allow_save==1)
                {
                ?>
                             <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                              <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
              <?php
                }
?>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/eventtasklist/<?php echo $rec_event_id; ?>')"><span> Cancel</span></button></li>
</ul>
</div>


<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; ">
<div id="tab-container-1">
                    <ul id="tab-container-1-nav" class="topTabs2">
                            <!--<li><a href="/companies/rsvp_sponsor/<?php // echo $rec_event_id; ?>"><span>RSVP</span></a></li>
                  <?php
     if($waiting_list==1)  
                   {
                    ?>
                  <li><a href="/companies/waitlist/<?php // echo $rec_event_id; ?>"><span>Wait List</span></a></li>
                  <?php
                   }
                   ?>
                   <li><a href="/companies/send_invite/<?php // echo $rec_event_id; ?>" ><span>Send Invite</span></a></li>
                   <li><a href="/companies/event_task/<?php // echo $rec_event_id; ?>" class="tabSelt"><span>Event Task</span></a></li>
                   <li><a href="/companies/eventinvitationhistory/<?php // echo $rec_event_id; ?>"><span>Invites</span></a></li>-->
</ul>
                    </ul>
                </div>
</div>
<div class="clear"></div>

</div>
</div>
 
 

<div class="midPadd" id="sndmail">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          
        
        <div class="top-bar" style="border-left:0px;">
        
        </div>         
        <div id="addcomm" class="" style="border:none;">  
            <!-- START:  Task Setup Design as per Requirement --> 
            <table cellspacing="5" cellpadding="0" align="left" width="100%">
            <tbody>               
                <tr>
                    <td width="55%" valign="top">     
                        <table cellspacing="5" cellpadding="0" align="left" width="100%">
                        <tbody> 
                                <tr>
                                    <td align="right">     <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">                                    
                                           <label class="boldlabel">Task Name <span style="color: red;">*</span></label>
    
                                    </td>
                                    <td>
                                    <span class="intpSpan"><?php echo $form->input("CommunicationTask.task_name", array('id' => 'task_name', 'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?></span>
                                    </td>
                                </tr>
                               
                                 <tr>
                                    <td align="right" >
                                        <label class="boldlabel">Event </label>
                                    </td>
                                    <td>
                                     <span class="txtArea_top">
                                        <span class="txtArea_bot">
                                          <span id="statediv"> 
                                    <?php echo $form->select("CommunicationTask.rec_event_id",$eventdropdown,$sel_event,array('id' => 'rec_event_id','class'=>'multilist'),"---Select---"); ?></span>
                                    </span>
                                    </span>  
                                    </td>
                                </tr>
                                 
                                <tr>
                                    <td  align="right"> 
                                        
                                            <label class="boldlabel">Select Email Template <span style="color: red;">*</span></label>

                                         
                                    </td>
                                    <td>
                                          <span class="txtArea_top">
                                          <span class="txtArea_bot">
                                            <?php echo $form->select("CommunicationTask.email_template_id",$templatedropdown,$sel_email_temp,array('id' => 'email_template_id','class'=>'multilist','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>
                                          </span>
                                          </span>
                                          <span class="btnLft"><input type="button"  class="btnRht" value="Add" name="Add" onclick="addEmailTempforTask();" /></span>
                                   </td>
                                </tr>

                                <tr>
                                    <td align="right">                                        
                                           <label class="boldlabel">Subject <span style="color: red;">*</span></label>
    
                                    </td>
                                    <td>
                                    <span class="intpSpan" style="vertical-align: top"> 
                                            <?php echo $form->input("CommunicationTask.email_subject", array('id' => 'email_subject', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld","maxlength" => "250"));?>
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right"> <label class="boldlabel">Email from <span style="color: red;">*</span></label>  </td>
                                    <td><span class="intpSpan" style="vertical-align: top">
                                            <?php echo $form->input("CommunicationTask.email_from", array('id' => 'email_from', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld",'value'=>$fromemail));?>
                                    </span></td>
                                </tr>
                                
                                <!--<tr>
                                    <td width="174px" align="right"> <label class="boldlabel">Subscription Type </label>  </td>
                                    <td>
                                          <span class="txtArea_top">
                                          <span class="txtArea_bot">
                                            <?php // echo $form->select("CommunicationTask.subscription_type",$subscription_types,$sel_subscription_types,array('id' => 'subscription_type',"class"=>"multilist"),array(''=>'--Select--')); ?>
                                          </span>
                                          </span>
                                    </td>
                                </tr>-->
                                
                                <tr>
                                    <td align="right" >
                                        <label class="boldlabel">Member Type</label>
                                    </td>
                                    <td>
                                    <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                                <?php 
                                                    echo $form->select("CommunicationTask.member_type",$member_types,$sel_member_types, array('id' => 'member_type', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
                                                ?>
                                            </span>
                                        </span>
                                        
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td align="right" >
                                        <label class="boldlabel">Donator Level</label>
                                    </td>
                                    <td>
                                    <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                                <?php 
                                                    echo $form->select("CommunicationTask.donation_level",$donation_levels,$sel_donation_level, array('id' => 'donation_level', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
                                                ?>
                                            </span>
                                        </span>
                                        
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td align="right"> <label class="boldlabel">Gender </label>  </td>
                                    <td>
                                     <div style="width:60px;float:left"><input  type="radio" name='data[CommunicationTask][member_gender]' id="male" value='male' <?php if($this->data['CommunicationTask']['member_gender']=='male'){  echo ' checked="checked" ';}else{ echo ' ';}?> >&nbsp;Male</div>
                                     <div style="width:70px;float:left"><input type='radio' name='data[CommunicationTask][member_gender]' id="female" value='female' <?php if($this->data['CommunicationTask']['member_gender']=='female'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Female</div>
                                      <div style="width:55px;float:left"><input type="radio" name='data[CommunicationTask][member_gender]' id="both" value='both' <?php if($this->data['CommunicationTask']['member_gender']=='both'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Both</div>
                                     <div style="width:100px;float:left"><input type='radio' name='data[CommunicationTask][member_gender]' id="not_disclosed" value='not_disclosed'<?php if($this->data['CommunicationTask']['member_gender']=='not_disclosed'){  echo ' checked="checked" ';}else{ echo ' ';}?> >&nbsp;Not Disclosed</div>
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td align="right"> <label class="boldlabel">Age Range </label>  </td>
                                    <td>
                                    <?php
                                    $agefrom="00-00-0000";
                                     if(isset($this->data['CommunicationTask']['member_agefrom']) && $this->data['CommunicationTask']['member_agefrom']!='0000-00-00'){ 
                                         $agefrom= date('m-d-Y', strtotime($this->data['CommunicationTask']['member_agefrom']));
                                     } 
                                     $ageto="00-00-0000"; 
                                     if(isset($this->data['CommunicationTask']['member_ageto'])  && $this->data['CommunicationTask']['member_ageto']!='0000-00-00'){ 
                                         $ageto= date('m-d-Y', strtotime($this->data['CommunicationTask']['member_ageto'])); 
                                     } ?> 
                                    <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_agefrom", array('id' => 'member_agefrom', 'value'=>$agefrom, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:75px","maxlength" => "200",'readonly'=>'readonly'));?></span>&nbsp; to  &nbsp;
                                    <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_ageto", array('id' => 'member_ageto', 'value'=>$ageto, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:75px","maxlength" => "200",'readonly'=>'readonly'));?></span>
                                    </td>
                                </tr>
                                
                                   <!--<tr>
                                     <td align="right"> <label class="boldlabel">Birthday </label>&nbsp;</td>
                                     <td ><?php /*
                                     if($this->data['CommunicationTask']['member_birthday']=='1'){
                                         $chked="checked";
                                     }else{
                                          $chked="";
                                     }
                                     echo $form->input('CommunicationTask.member_birthday', array('id'=>'member_birthday','type'=>'checkbox', 'label' => '', 'checked' => $chked)); */?></td>
                                    </tr>-->
                                    
                                      <tr>
                                     <td align="right"> <label class="boldlabel">Anniversary </label>&nbsp;</td>
                                     <td >
                                     <div style="width:90px;float:left">
                                     <input type="checkbox"  name='data[CommunicationTask][member_anniversary_monthly]' id="member_anniversary_monthly" value='1' 
                                     <?php if($this->data['CommunicationTask']['member_anniversary_monthly']=='1'){  echo ' checked="checked" ';}else{ echo ' ';}?> >&nbsp;1 month
                                     </div>
                                     <div style="width:70px;float:left">
                                     <input type='checkbox' name='data[CommunicationTask][member_anniversary_annual]' id="member_anniversary_annual" value='1' 
                                     <?php if($this->data['CommunicationTask']['member_anniversary_annual']=='1'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Annual
                                     </div>
                                     </td>
                                    </tr>

                                      <tr>
                                    <td align="right" valign="top">
                                        <label class="boldlabel">Days Since</label>
                                    </td>
                                    <td>
                                    <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                                <?php 
                                                    echo $form->select("CommunicationTask.member_days_since",$days_since,$sel_days_since, array('id' => 'member_days_since', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
                                                ?>
                                            </span>
                                        </span>
                                     <div id="div_days_ago">
                                        <label class="boldlabel">Dasys Ago : </label>    &nbsp;&nbsp; <span class="intpSpan" style="vertical-align: top"> 
                                            <?php echo $form->input("CommunicationTask.member_noof_days_since", array('id' => 'member_noof_days_since', 'div' => false, 'label' => '','style' =>'width:125px;',"class" => "inpt_txt_fld","maxlength" => "250"));?>
                                        </span>
                                     </div>   
                                    </td>
                                </tr>
                                

                                
                                  <tr>
                                    <td align="right" >
                                        <label class="boldlabel">Country</label>
                                    </td>
                                    <td>
                                    <span class="txtArea_top">
                                        <span class="newtxtArea_bot">
                                        <?php echo $form->select("CommunicationTask.member_country",$countrydropdown,$sel_country,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Company")')); ?>
                                    </span>
                                    </span>  
                                    </td>
                                </tr>
                                  <tr>
                                    <td align="right" >
                                        <label class="boldlabel">Select State</label>
                                    </td>
                                    <td>
                                     <span class="txtArea_top">
                                        <span class="txtArea_bot">
                                          <span id="statediv"> 
                                    <?php echo $form->select("CommunicationTask.member_state",$statedropdown,$sel_state,array('id' => 'state','class'=>'multilist'),"---Select---"); ?></span>
                                    </span>
                                    </span>  
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td colspan="2" >
                                    <div id="zip_postal" style="display: block;">
                                    <table width="100%">
                                        <tbody>
                                                <tr>
                                                <td width="174px" align="right" >
                                                    <label class="boldlabel">Zip/Postal Code Range</label>
                                                </td>
                                                 <td>
                                                <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_zipcode_from", array('id' => 'member_zipcode_from', 'value'=>$sdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:125px","maxlength" => "200"));?></span>&nbsp; to  &nbsp;
                                                <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_zipcode_to", array('id' => 'member_zipcode_to', 'value'=>$sdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:125px","maxlength" => "200"));?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    </td>
                                </tr>
                            
                            <!--     <tr>
                                    <td align="right" >
                                        <label class="boldlabel">RSVP Type </label>
                                    </td>
                                    <td>
                                     <span class="txtArea_top">
                                        <span class="txtArea_bot">
                                          <span id="statediv"> 
                                    <?php // echo $form->select("CommunicationTask.event_rsvp_type",$event_rsvp,$sel_event_rsvp,array('id' => 'event_rsvp_type','class'=>'multilist'),"---Select---"); ?></span>
                                    </span>
                                    </span>  
                                    </td>
                                </tr>-->
                                
                                <!--<tr> 
                                <td align="right" >     
                                        <label class="boldlabel">Relates to comment </label>&nbsp;</td>
                                <td>
                                <span class="txtArea_top">
                                <span class="txtArea_bot">
                                    <span id="countrydiv">
                                        <?php //echo $form->select("CommunicationTask.relatesto_commenttype_id",$commenttypedropdown,$sel_comment_typeid,array('id' => 'relatesto_commenttype_id',"class"=>"multilist"),array(''=>'--Select--')); ?></span></span></span>&nbsp;&nbsp;
                                        <span class="btnLft"><input type="button"  class="btnRht" value="Add" name="Add" onclick="addCommentTypeforTask();" /></span> 
                                        <input type="button"  class="btnRht" value="Add" name="Add" ONCLICK="javascript:(window.location='/companies/addcommenttype')" /></span>
                                       </td>
                                </tr>-->
                                
                                  <tr> 
                                <td align="right" >     
                                        <label class="boldlabel">Social Network Members </label>&nbsp;</td>
                                <td>
                                <span class="txtArea_top">
                                <span class="txtArea_bot">
                                    <span id="countrydiv">
                                        <?php echo $form->select("CommunicationTask.social_network_members",$social_networks,$sel_social_networks,array('id' => 'social_network_members',"class"=>"multilist"),array(''=>'--Select--')); ?></span></span></span>
                                      </td>
                                </tr>
                                
                                  <tr> 
                                <td align="right" >     
                                        <label class="boldlabel">Non-Network Members </label>&nbsp;</td>
                                <td>
                                <span class="txtArea_top">
                                <span class="txtArea_bot">
                                    <span id="countrydiv">
                                        <?php echo $form->select("CommunicationTask.non_network_members",$social_networks,$sel_non_networks,array('id' => 'non_network_members',"class"=>"multilist"),array(''=>'--Select--')); ?></span></span></span>&nbsp;&nbsp;
                                        </td>
                                </tr>
                                
                                  <tr>
                                    <td align="right" >
                                        <label class="boldlabel">Points Range</label>
                                    </td>
                                     <td>
                                    <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_points_rangefrom", array('id' => 'member_points_rangefrom', 'value'=>$sdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:100px","maxlength" => "200"));?></span>&nbsp; to  &nbsp;
                                    <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_points_rangeto", array('id' => 'member_points_rangeto', 'value'=>$sdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:100px","maxlength" => "200"));?></span>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td align="right">
                                        <label class="boldlabel">Company Type</label>
                                    </td>
                                    <td>
                                    <input type="hidden" name="is_memberdisabled" id="is_memberdisabled" value="<?php echo $is_memebrdisabled;?>">
                                    <input type="hidden" name="is_contactdisabled" id="is_contactdisabled" value="<?php echo $is_contactdisabled;?>">
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                                <?php echo $form->select("CommunicationTask.company_type",$companytypedropdown,$sel_companytypeid,array('id' => 'companytypeid','class'=>'multilist'),"---Select---"); ?>
                                                </span>
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right"> 
                                        <label class="boldlabel">Contact Type</label>
                                    </td>
                                    <td>
                                        <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                                <?php echo $form->select("CommunicationTask.contact_type",$contacttypedropdown,$sel_contactypeid,array('id' => 'contactypeid','class'=>'multilist'),"---Select---"); ?>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                    
                            </tbody>
                         </table>  
                    </td>
                    <td width="45%" valign="top">
                        <table cellspacing="10" cellpadding="0" align="center" width="100%">
                                                        <tbody>
                                <tr>
                                    <td align="right" width="140px">   <label class="boldlabel">Status </label>  </td>
                                    <td>
                                    <?php if($eachrow['CommunicationTask']['active_status']=='0'){ ?>
                                    <a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate <?php echo $tempname; ?>" /></a>
                                     <?php }else{ ?>
                                      <a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate <?php echo $tempname; ?>" /></a>
                                    <?php } ?>
                                    </td>
                                </tr>

                                 <tr>
                                      <td align="right" width="140px"> <label class="boldlabel">Send Date <span class="red">*</span></label></td>
                                        <td>
                                          <span class="intpSpan"><?php
                                                    if($this->data['CommunicationTask']['task_startdate']!=""){
                                                            $task_startdate= $this->data['CommunicationTask']['task_startdate'];
                                                    }else{
                                                           $task_startdate= date('m-d-Y');
                                                    }
                                           echo $form->text("CommunicationTask.task_startdate", array('id' => 'task_startdate', 'div' => false, 'label' => '',"class"=>"inpt_txt_fld","maxlength" => "200","style" => "width:200px", 'value'=>$task_startdate,'readonly'=>'readonly'));?></span>
                                     </td>
                                </tr>
                                
                                 
                                  <tr>
                                       <td align="right" width="140px"> <label class="boldlabel">Note</label></td>
                                        <td>
                                             <span class="txtArea_top">
                                <span class="txtArea_bot"><?php echo $form->input("CommunicationTask.task_note", array('id' => 'task_note', 'div' => false, 'label' => '','rows'=>'8','cols'=>'26','class' =>'noBg'));?></span></span>
                                     </td>
                                </tr>
                                  <tr>   <td align="right" colspan="2"> &nbsp;</td></tr>
                                  <tr>   <td align="right" colspan="2"> &nbsp;</td></tr>
                              
                                  <tr>
                                  <td align="right" width="140px"> &nbsp; </td>
                                  <td>               
                                   <span class="btnLft">   <button name="runreport" id="runreport" class="btnRht" value="RunReport" type="button"  >Run Report</button>  </span>
                                    </td>
                                </tr>
                                
                                 
                               
                                </tbody>
                        </table>      
                    </td>
                </tr>
             </tbody>
        </table> 
           <!-- END : Task Setup Design -->  
     
    </div>

        <div id="showtaskreport" title="Task Report">
    <p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
  <div class="clear"></div>


</div>
  <?php echo $form->end();?>


<div class="clear"></div> 


</div><!--inner-container ends here-->
    <!-- Body Panel ends --> 

<script type="text/javascript" language="JavaScript">
<?php if(!($this->data['CommunicationTask']['id'])) { ?>
getstateoptions('254',"Company");
 $("#zip_postal").show();     
<?php } ?>


</script>
<script type="text/javascript">
    // increase the default animation speed to exaggerate the effect
    $.fx.speeds._default = 1000;
    $(function() {
        $( "#showtaskreport" ).dialog({
            autoOpen: false,
            modal: true,
            width: 560,
            show: "blind",
            hide: "blind"
        });

       $( "#runreport" ).click(function() {  // runTaskReport();
            var current_domain=$("#current_domain").val(); 

            
            $.ajax({
                            type: "POST",  
                            data:  $("#event_task").serialize() ,
                            url: 'http://'+current_domain+'/companies/commtask_get_report_list_by_ajax/',
                            cache: false,
                            success: function(result){    
                                      $("#showtaskreport").html(result); 
                                         $( "#showtaskreport" ).dialog( "open" );
                                      return false; 
                            }
              });
           
          
        });
    });  
 /**          
         * Funtion addnew email template in pop-up
         */
         function addEmailTempforTask() {   
             $('#email_template_id').focus();
             var resWindow=  window.open ('/companies/addmailtemplate/popup', 'AddTemp','location=1,status=1,scrollbars=1, width=950,height=650');
             resWindow.focus();
           }
           
          // This function is called after closing of child window ie. on page addmailtemplate.ctp 
        function GetEmailTempRefresh(){
           // alert("Refresh EMail temp dorp dwon");
            var pid='<?php echo $projectid;?>';
            var selectedid=$("#email_template_id").val();
            getemailtemplatesbyajax(pid, 'email_template_id', selectedid );
        }
        
        /**
         * Funtion addnew comment type in pop-up
         */
         function addCommentTypeforTask() { 
             $('#relatesto_commenttype_id').focus();
             var resWindow=  window.open ('/companies/addcommenttype/popup', 'AddCommentType','location=1,status=1,scrollbars=1, width=950,height=650');
             resWindow.focus();
           }
           
          // This function is called after closing of child window ie. on page addcommenttype.ctp 
        function GetCommentTypeRefresh(){
           
            var pid='<?php echo $projectid;?>';
            var selectedid=$("#relatesto_commenttype_id").val();     
            getcommenttypesbyajax(pid, 'relatesto_commenttype_id', selectedid );
        }
        
        /**
        * REfresh Comment type dropdown
        */
        function getcommenttypesbyajax(projectid,eleid, selectedid) {    
               if(projectid==""){
                  return false;
               }
                        
               jQuery.ajax({
                     type: "GET",
                     url: '/companies/getcommenttypesbyajax/'+projectid+'/'+selectedid,
                     cache: false,
                     success: function(rText){
                            jQuery('#'+eleid).html(rText);
                     }
             });
      
      }
        
        function runTaskReport(){
            var current_domain=$("#current_domain").val();  
                     //location = "/companies/sendtempmail/"+id;
              $.ajax({
                            type: "GET",  
                            url: 'http://'+current_domain+'/companies/commtask_get_report_list_by_ajax/all',
                            cache: false,
                            success: function(result){      
                                      $("#showtaskreport").html(result); 
                                    //   $( "#showtaskreport" ).dialog( "open" );  
                            }
              });
        }
        
    if(document.getElementById("flashMessage")==null)
        document.getElementById("addcomm").style.paddingTop = '24px';
    else
    {
            document.getElementById("blck").style.paddingTop = '10px';
    }    
    
    
function getEmailTemplate(id){
        var current_domain=$("#current_domain").val();  

    //location = "/companies/sendtempmail/"+id;
      $.ajax({
                    url: 'http://'+current_domain+'/companies/get_email_template_details_by_ajax/'+id,
                    dataType:'json',
                    cache: false,
                    success: function(result){
                              $("#email_subject").val(result.subject);
                              $("#email_from").val(result.sender);
                    }
      });

}      

        $(document).ready(function() { 
            
            showRecurPatternOptions();
            toggleZipPostal();
             toggleDaySinceAndEvent();       
           
            if($("#isedit").val()=="1"){ 
                  if($("#companytypeid").val()=="" &&  $("#contactypeid").val()=="")
                {
                    toggleContactAndMemberFields();  
                }else{
                      toggleMemberFields();
                }
            }
             
               
            $("#country").change(function(){
            
              toggleZipPostal();  
           });
           
            $("#subscription_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#member_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            
            $("#member_days_since").change(function(){ 
               toggleContactAndMemberFields(); 
               // alert("days since "+$("#member_days_since").val());
                // Do for days ago box =enable and disable logic
                   toggleDaySinceAndEvent();
                   
            });
            
             $("#state").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            
            $("#event_id").change(function(){    toggleDaySinceAndEvent();
               
                if($("#event_id").val()==""){
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                }else{
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").removeAttr('disabled');
                }
                     toggleContactAndMemberFields(); 
            });
            
            $("#event_rsvp_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#relatesto_commenttype_id").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#social_network_members").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#non_network_members").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#companytypeid,#contactypeid").change(function(){
                 toggleMemberFields();  
            });

            $("#recur_pattern").change(function(){
            
              showRecurPatternOptions();  
            });
        
        
          function toggleDaySinceAndEvent(){
                               
             if($("#member_days_since").val()=="" && $("#event_id").val()==""){    
                     $("#member_noof_days_since").val("");
                     $("#member_days_since").removeAttr('disabled'); 
                     $("#member_noof_days_since").attr("disabled","disabled");
                     
                    $("#event_id").removeAttr('disabled'); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
             }else if($("#member_days_since").val()!=""){         
                    // $("#member_noof_days_since").val("");
                    $("#member_noof_days_since").removeAttr('disabled');
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled"); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");   
             }else if($("#event_id").val()!=""){   
                  
                    $("#member_noof_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    $("#member_noof_days_since").attr("disabled","disabled");
                  //  $("#event_id").val("");
                    $("#event_id").removeAttr('disabled'); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                }
        } 
        /**
        * Fuction to hide and show Zip/Postal Code Range fields depends on selected country 
        * If United States or India country is selected the show Zip/Postal Code Range field
        * Other wise hide Zip/Postal Code Range field
        */
        function toggleZipPostal(){
            var country=$("#country").val(); 
            if(country=='254' || country=='113') {
                 $("#zip_postal").show();
                  $("#member_zipcode_from").val("");
                  $("#member_zipcode_to").val("");
            }else{
                 $("#zip_postal").hide();
                  $("#member_zipcode_from").val("");
                  $("#member_zipcode_to").val("");
            }
        }
        
        /**
        * Function to Show Recurr Patter's options depends of selected   Recurre Pattern
        */
        function showRecurPatternOptions(){
            var recur_pattern=$("#recur_pattern").val();
             $("#daily_recur_pattern").hide();    
             $("#weekly_recur_pattern").hide();    
             $("#monthly_recur_pattern").hide();    
             $("#yearly_recur_pattern").hide();    
                
            if(recur_pattern=='Yearly'){
                   $("#yearly_recur_pattern").show();    
            }else if(recur_pattern=='Monthly'){
                    $("#monthly_recur_pattern").show();
            }else if(recur_pattern=='Weekly'){
                  $("#weekly_recur_pattern").show();    
            }else{
                //recur_pattern=='Daily'
                $("#daily_recur_pattern").show();    
            }
        }
        
        function toggleContactAndMemberFields(){ 
     
                  // alert("relatesto_commenttype_id ="+$("#relatesto_commenttype_id").val()); 
            if($("#subscription_type").val()!="" || $("#member_type").val()!="" || $("#member_agefrom").val()!="00-00-0000" || $("#member_ageto").val()!="00-00-0000" || $("#member_days_since").val()!=""  || $("#state").val()!=""  || $("#member_zipcode_from").val()!=""  || $("#member_zipcode_to").val()!=""  || $("#event_id").val()!=""  || $("#event_rsvp_type").val()!="" || $("#relatesto_commenttype_id").val()!="" || $("#social_network_members").val()!="" || $("#non_network_members").val()!="" || $("#member_points_rangefrom").val()!="" || $("#member_points_rangeto").val()!="" )
            {
                disableContactInfo();
            }
            else
            {
                //alert("enableContactInfo");  
                enableContactInfo();
            }
            
        }
        
        function toggleMemberFields(){ 
       // alert("is_contactdisabled "+$("#is_contactdisabled").val());
                  //
            if($("#companytypeid").val()!="" ||  $("#contactypeid").val()!="")
            {
               disableMemeberInfo();
            }
            else
            {
                enableMemebrInfo();
            }
            
        }
        
        function disableMemeberInfo(){      
             // Disable Member related Items 
                    $("#member_type").val("");
                    $("#member_type").attr("disabled","disabled");
                    
                    $("#subscription_type").val("");
                    $("#subscription_type").attr("disabled","disabled");
                    
                    $("#member_agefrom").val("00-00-0000");
                    $("#member_agefrom").attr("disabled","disabled");
                    
                    $("#member_ageto").val("00-00-0000");
                    $("#member_ageto").attr("disabled","disabled");
                    
                    $("#member_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    
                    $("#state").val("");
                    $("#state").removeAttr('disabled');
                    
                    $("#member_zipcode_from").val("");
                    $("#member_zipcode_from").attr("disabled","disabled");
                        
                    $("#member_zipcode_to").val("");
                    $("#member_zipcode_to").attr("disabled","disabled");
                    
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled");
                    
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                    
                    $("#relatesto_commenttype_id").val("");
                    $("#relatesto_commenttype_id").attr("disabled","disabled");
                    
                    $("#social_network_members").val("");
                    $("#social_network_members").attr("disabled","disabled");
                    
                    $("#non_network_members").val("");
                    $("#non_network_members").attr("disabled","disabled");
                    
                    
                    
                    $("#member_points_rangefrom").val("");
                    $("#member_points_rangefrom").attr("disabled","disabled");
                    
                    $("#member_points_rangeto").val("");
                    $("#member_points_rangeto").attr("disabled","disabled");
        }
        
        function enableMemebrInfo(){   
            // Enable Member related Items 
               // $("#subscription_type").val("");
                $("#subscription_type").removeAttr('disabled');
                
                $("#member_type").removeAttr('disabled');
                
              //  $("#member_agefrom").val("");
                $("#member_agefrom").removeAttr('disabled');
                
              //  $("#member_ageto").val("");
                $("#member_ageto").removeAttr('disabled');
                
              //  $("#member_days_since").val("");
                $("#member_days_since").removeAttr('disabled');
                
              //  $("#state").val("");
                $("#state").removeAttr('disabled');
                
                //$("#member_zipcode_from").val("");
                $("#member_zipcode_from").removeAttr('disabled');
                    
              //  $("#member_zipcode_to").val("");
                $("#member_zipcode_to").removeAttr('disabled');
                
              //  $("#event_id").val("");
                $("#event_id").removeAttr('disabled');
                
               // $("#event_rsvp_type").val("");
               // $("#event_rsvp_type").removeAttr('disabled');
                
               // $("#relatesto_commenttype_id").val("");
                $("#relatesto_commenttype_id").removeAttr('disabled');
                
               // $("#social_network_members").val("");
                $("#social_network_members").removeAttr('disabled');
                
              //  $("#non_network_members").val("");
                $("#non_network_members").removeAttr('disabled');
                
              //  $("#relatesto_commenttype_id").val("");
                $("#relatesto_commenttype_id").removeAttr('disabled');
                
               // $("#member_points_rangefrom").val("");
                $("#member_points_rangefrom").removeAttr('disabled');
                
               // $("#member_points_rangeto").val("");
                $("#member_points_rangeto").removeAttr('disabled');  
        }
        
        
        function disableContactInfo(){      
                $("#companytypeid").val("");
                $("#companytypeid").attr("disabled","disabled");
                $("#contactypeid").val("");
                $("#contactypeid").attr("disabled","disabled");
        }
        
        function enableContactInfo(){
                // $("#companytypeid").val("");
                    $("#companytypeid").removeAttr('disabled');
                  //  $("#contactypeid").val("");
                    $("#contactypeid").removeAttr('disabled');
        }
});


</script>
