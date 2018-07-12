<?php		 
	echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
   // echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
   // echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');
    
    
    $timeopt ['']= 'Select time';  
    $strat_time= "00:00:00";
    $stime =  strtotime($strat_time);
              $option_stime='<option value="">Select Time</option>';
              $option_etime='<option value="">Select Time</option>';
    for($i=0; $i< 48; $i++){
        //echo "<br/> ".$i." -- > ". 
        $convertshow = date("h:i a",$stime); 
        $convertval = date("h:i a",$stime);  
        $sel_st='';
        if($sel_stime==$convertval){    
            $sel_st='selected="selected"';
        }
         $sel_et='';   
        if($sel_etime==$convertval){    
            $sel_et='selected="selected"';
        }
     //   echo "<br/> ".$i." -- > ".$convertshow." -->".$convertval;
      $option_stime.='<option value="'.$convertval.'" '.$sel_st.'>'.$convertshow.'</option>'; 
      $option_etime.='<option value="'.$convertval.'" '.$sel_et.'>'.$convertshow.'</option>'; 
        $timeopt[$convertval]  = $convertshow;    
        $stime  =  strtotime("+30 minutes", $stime); 
       
    }   
?>

<script language="javascript">
function loadMemberEmails()
        {
        
            member_type=$("#member_type").val();
                       
            var current_domain=$("#current_domain").val();
            $('#contactemails').load(baseUrl+'companies/get_members_details_by_ajax/'+member_type, function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('#contactemails').fadeIn(1000); 

            }); 
        
        }
        
        
function update_content_page_list()
{
    //alert("In");
   var current_domain=$("#current_domain").val();
            $('.show_content_page_list').load(baseUrl+'companies/update_content_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_content_page_list').fadeIn(1000); 

            }); 
         
}

function update_email_page_list()
{
    //alert("In");
   var current_domain=$("#current_domain").val();
            $('.show_email_page_list').load(baseUrl+'companies/update_email_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_email_page_list').fadeIn(1000); 

            }); 
         
}

function create_csv()
{
    //alert("in");
    var current_domain=$("#current_domain").val();
    var selected_for_invitations=$("#selected_for_invitations").val();
    var url=baseUrl+'companies/create_invitation_csv/';
    //console.log(url);
    $.ajax({
          type: 'GET',
          url: url,
          data: 'selected_for_invitations='+selected_for_invitations,
          dataType: "json",
          success: function(data){
                //alert("success");
                window.open("http://localhost:9090/output.csv");
              }
        });
    
    
}
</script>
	<?php
		echo $html->css('/css/jquery_ui_datepicker');
		echo $html->css('timepicker_plug/css/style');
	?>
    <style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
    
    .updat {
    display: inline-block;
    margin-bottom: 10px;
    margin-right: 16px;
    text-align: right;
    vertical-align: top;
    width: 190px;
}
    
</style>
 
    <script type="text/javascript">
     /* <![CDATA[ */
     var dateobj = new Date();
    var currDate  = dateobj.getFullYear();
    var rangeDate=parseInt(currDate+10);
        $(function() {
                    
                    $('#starttime').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    //yearRange: currDate+':'+rangeDate 
                });
                
                $('#endtime').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                     //yearRange: currDate+':'+rangeDate 
                });
                
                $('#end_by_date').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                     //yearRange: currDate+':'+rangeDate 
                });
                $('#task_startdate').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                     //yearRange: currDate+':'+rangeDate 
                });
               
          });
      /* ]]> */

       function validateevent(){
           //alert("validateevent");
             if(trim($('#title').val()) == '')
             {
                 inlineMsg('title','<strong>RecurringEvent title required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#title').val()) == true){
                 inlineMsg('title','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             }
             
             if(trim($('#event_type').val()) == "")
             {
                 inlineMsg('event_type','<strong>RecurringEvent Type required.</strong>',2);
                 return false;
             }
             
             if(trim($('#member_type').val()) == "")
             {
                 inlineMsg('member_type','<strong>RecurringEvent Type required.</strong>',2);
                 return false;
             }
             
             if(trim($('#max_attendees').val()) == '')
              {
                  inlineMsg('max_attendees','<strong>Max Attendees are required.</strong>',2);
                  return false; 
              }
              else
             if(trim($('#max_attendees').val()) != ''){
                 if(isNaN(trim($('#max_attendees').val()))){
                     inlineMsg('max_attendees','<strong>Only numbers are accepted.</strong>',2);
                     return false; 
                 }
             }
             
             if(trim($('#max_attendees_start').val()) == '')
              {
                    inlineMsg('max_attendees_start','<strong>Attendees Start is required.</strong>',2);
                    return false; 
              }
              else
             if(trim($('#max_attendees_start').val()) != ''){
             
                 if(isNaN(trim($('#max_attendees_start').val()))){
                     inlineMsg('max_attendees_start','<strong>Only numbers are accepted.</strong>',2);
                     return false; 
                 }
                 if($('#max_attendees_start').val()>$('#max_attendees').val()){
                     inlineMsg('max_attendees_start','<strong>Attendees Start should be less than Maximum Attendees.</strong>',2);
                     return false; 
                 }
             }
                          
             
              if(trim($('#starttime').val()) == '')
             {
                 inlineMsg('starttime','<strong>RecurringEvent starttime required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#starttime').val()) == true){
                 inlineMsg('starttime','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
         
        
            if ($("#recur_pattern").val()=="Daily")
              {
                  
                  if ($("#everyday").is(':checked'))
                  {
                      if(trim($('#daily_every_noof_days').val()) == "" || trim($('#daily_every_noof_days').val()) == 0)
                      {                        
                            inlineMsg('daily_every_noof_days','<strong>This field is required.</strong>',2);
                            return false;
                      }
                  }
                    
              }
              
              if ($("#recur_pattern").val()=="Weekly")
              {
         
                  if(trim($('#weekly_every_noof_weeks ').val()) == "" || trim($('#weekly_every_noof_weeks').val()) == 0)
                  {                        
                        inlineMsg('weekly_every_noof_weeks','<strong>This field is required.</strong>',2);
                        return false;
                  }
                    
              }
              
              if ($("#recur_pattern").val()=="Monthly")
              {
                  
                  if ($("#dayofeverymonth").is(':checked'))
                  {
                      if(trim($('#monthly_onof_day').val()) == "" || trim($('#monthly_onof_day').val()) == 0 || trim($('#monthly_onof_day').val())>31 )
                      {                        
                            inlineMsg('monthly_onof_day','<strong>This field is required.Use Day between 1 and 31</strong>',2);
                            return false;
                      }
                      if(trim($('#monthly_every_noof_months').val()) == "" || trim($('#monthly_every_noof_months').val()) == 0 )
                      {                        
                            inlineMsg('monthly_every_noof_months','<strong>This field is required.</strong>',2);
                            return false;
                      }
                      if(trim($('#monthly_onof_day').val()) == "30" || trim($('#monthly_onof_day').val()) == "31")
                      {                        
                            alert("For the month where there is no 30th or 31st,RecurringEvent will occur on last day of month");
                      }
                  }
                  if ($("#weekdayofeverymonth").is(':checked'))
                  {
                      if(trim($('#monthly_weekof_noof_months').val()) == "" || trim($('#monthly_weekof_noof_months').val()) == 0 )
                      {                        
                            inlineMsg('monthly_weekof_noof_months','<strong>This field is required.</strong>',2);
                            return false;
                      }
                  }
                    
              }
              if ($("#recur_pattern").val()=="Yearly")
              {
                  
                  if ($("#everynoofmonths").is(':checked'))
                  {
                      if(trim($('#yearly_everymonth_date').val()) == "" || trim($('#yearly_everymonth_date').val()) == 0 || trim($('#yearly_everymonth_date').val())>31 )
                      {                        
                            inlineMsg('yearly_everymonth_date','<strong>This field is required.Use Day between 1 and 31</strong>',2);
                            return false;
                      }   
                  }                  
                    
              }
              
              if($('#after_accurrences').is(':checked'))
              {                                  
                  if(trim($('#task_end_after_occurrences').val()) == "" || trim($('#task_end_after_occurrences').val()) <=0 || trim($('#task_end_after_occurrences').val())>30)
                  {                        
                        inlineMsg('task_end_after_occurrences','<strong>This field is required.Max 30 are allowed</strong>',2);
                        return false;
                  }
                                            
              }
        
                    
              var stime= ($('#stime').val()).split(" ");
              var etime= ($('#etime').val()).split(" ");
               var sap=stime[1];
               var eap=etime[1];
               
               if(sap=="am" && eap=="pm"){      
                    // return true;
               }else if((sap=="am" && eap=="am") || (sap=="pm" && eap=="pm")){  
                     var shr=(stime[0]).split(":");
                     var ehr=(etime[0]).split(":");  
                     //alert(startDate.toDateString()+" "+endDate);
                     //if(startDate.toDateString()===endDate.toDateString())
                    // {
                         if(ehr[0]< shr[0] && shr[0]!=12 )
                         {  
                            inlineMsg('etime','<strong>End time cannot be before start time.</strong>',2);
                            return false; 
                         }else if(ehr[0]==shr[0])
                         {   
                               if(ehr[1]<= shr[1] )
                               {              
                                        inlineMsg('etime','<strong>End time cannot be before or equal to start time.</strong>',2);
                                        return false; 
                               }
                         }
                    // }
                   
               }else if(sap=="pm" && eap=="am"){     
                   inlineMsg('etime','<strong>End time cannot be before strat time.</strong>',2);
                   return false;
               } 
        
              if(trim($('#location').val()) == '')
             {
                 inlineMsg('location','<strong>RecurringEvent location required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#location').val()) == true){
                 inlineMsg('location','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
             
             if(trim($('#max_tickets_per_member').val()) == ''){
                 inlineMsg('max_tickets_per_member','<strong>This field is required.</strong>',2);
                 return false; 
             }
             else
             if(isNaN(trim($('#max_tickets_per_member').val()))){
                 inlineMsg('max_tickets_per_member','<strong>Only numbers are accepted.</strong>',2);
                 return false; 
             }
                          
              
              
              if(trim($('#eventlogo').val()) != '')
             {
                    //alert($('#eventlogo').val());
                    var  ext = $('#eventlogo').val().split('.').pop().toLowerCase();
                  //  alert(ext);
                    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                        inlineMsg('eventlogo','<strong>Please only upload files with .jpg,.jpeg,.gif and .png extension.</strong>',2);
                        return false;
                    }
             }else{
                    if($('#eventid').val()=="0"){
                         inlineMsg('eventlogo','<strong>Please upload RecurringEvent logo.</strong>',2);
                          return false;
                         }
             }
           return true;
       }
        
    </script>
    
     <?php 
            if($this->data['RecurringEvent']['id']){
                $act = 'edit';
                $header_text= "Past Event";
                $show_sub_menus=1;
                $div_class="titlCont";
            }else{
                $act = 'add';
                $header_text= "Create an Event ";
                $show_sub_menus=0;
                $div_class="titlCont1";
            }    
        ?>  
    
<div class="<?php echo $div_class;?> ">
<div style="width:960px; margin:0 auto;">
    <div align="center" id="toppanel" >
        <div id="panel">
            <div class="content clearfix">
                <H1> Help</h1>
                <p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
            </div>
            
        </div> <!-- /login -->    

        <!-- The tab on top -->    
        <div class="tab">
            <ul class="login">
                <li id="toggle">
                    <a id="open" class="open" href="#."><span>Open Help Box</span></a>
                    <a id="close" style="display: none;" class="close" href="#"><span>Close Help Box</span></a>        
                </li>
            </ul> 
        </div>
    </div>

    <span class="titlTxt">
        <?php  echo $header_text;?>
    </span>
    
    <?php echo $form->create("Companies", array("action" => "eventcreate",'type' => 'file','enctype'=>'multipart/form-data','name' => 'eventcreate', 'id' => "eventcreate","onsubmit"=>"return validateevent('$act');"))?>
    <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
    <div class="topTabs">
        <ul>
      
        <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location=baseUrl+'Companies/eventlist')"><span> Cancel</span></button></li>
        </ul>
    </div>
    <?php if ($show_sub_menus==1)
    {
        ?>
    <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
        <div style="height: 30px; clear:both;">
            <?php //echo $form->hidden("selectedtab", array('id' => 'selectedtab')); ?>
                <div id="tab-container-1">
                <ul id="tab-container-1-nav" class="topTabs2">
    
                  <!--<li><a href="/companies/eventcreate/<?php //echo $this->data['RecurringEvent']['id']; ?>" class="tabSelt"><span>Edit RecurringEvent</span></a></li>-->
                  <li>
						<?php
							e($html->link(
								$html->tag('span', 'RSVP'),
								array('controller'=>'companies','action'=>'rsvp',$this->data['RecurringEvent']['id']),
								array('escape' => false)
								)
							);
						?>
					</li>
                  <?php
                   if($waiting_list==1)  
                   {
                    ?>
                  <li>
					<?php
							e($html->link(
								$html->tag('span', 'Wait List'),
								array('controller'=>'companies','action'=>'waitlist',$this->data['RecurringEvent']['id']),
								array('escape' => false)
								)
							);
						?>
				</li>
                  <?php
                   }
                    ?>
                     <li>
						<?php
							e($html->link(
								$html->tag('span', 'Invites'),
								array('controller'=>'companies','action'=>'eventinvitationhistory',$this->data['RecurringEvent']['id']),
								array('escape' => false)
								)
							);
						?>

					</li>
               </ul>
                </div>
        </div>
    <?php
    }
?>
    
</div></div>

</div><!--rightpanel ends here-->

                            <!--inner-container starts here--><div class="" style="width:990px; margin:0 auto">


    
        
    
    
        </div>
        
        <!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->
<br>

<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar">
    
   </div>
<div class="" style="padding-left:110px">    


    <?php if($session->check('Message.flash')){ ?>
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;position: absolute; z-index: 11;" /></a>
              
                  <?php  $session->flash(); 
                    echo $form->error('RecurringEvent.title', array('class' => 'msgTXt'));
                //    echo $form->error('RecurringEvent.company_type_id', array('class' => 'msgTXt'));  ?> 
                </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
        </div>
</div>
                                            <?php }?>
<table>
<tr>
<td width="50%" valign="top">
<table cellspacing="5" cellpadding="0" >
        
  
    <tr>
      <td colspan="5"><?php if($session->check('Message.flash')){ $session->flash(); } 
                      //echo $form->error('Company.company_name', array('class' => 'msgTXt'));
                      //echo $form->error('Company.company_type_id', array('class' => 'msgTXt'));
                       echo $form->hidden("RecurringEvent.id", array('id' => 'eventid','value'=>"$eventid"));
                       echo $form->hidden("Project.projectname", array('id' => 'projectname','value'=>"$projectname"));
          ?></td>
    </tr>
    
  

    
    <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Event Title <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
            <span class="intpSpan"><?php
             $event_title = preg_replace("/\d{2}\-\d{2}\-\d{4}$/",'',$eventdata['event_title']); 
             echo $form->input("RecurringEvent.title", array('id' => 'title','value'=>$event_title, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
        </tr>
        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Event Type <span style="color: red;">*</span></label>
        </div>
        
        </td>
            <td>
                <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <!--<select id="stime" name="data[RecurringEvent][event_type]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">  
                    <option value="At Location">At Location</option>               
                    <option value="Video Conference">Video Conference</option>
                    <option value="Webinar">Webinar</option>
                    <option value="Conference Call">Conference call</option>
                    <option value="At Location & Live Broadcast">At Location & Live Broadcast</option>
                    </select>-->
                    <?php 
                        echo $form->select("RecurringEvent.event_type",$event_type,null, array('id' => 'event_type', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

            ?>
                    
                </span>
                </span></td>
            </tr>
            
            <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Member Type <span style="color: red;">*</span></label>
        </div>
        
        </td>
            <td>
                <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <!--<select id="member_type" name="data[RecurringEvent][member_type]" onchange="loadMemberEmails()" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">
                    <option value="all">All</option>                  
                    <option value="coin_holders">Coin Holders</option>                  
                    <option value="non_coin_holders">Non Coin Holders</option>                  
                    <option value="non_members">Non Members</option>                  
                    </select>-->
                    <?php 
                        echo $form->select("RecurringEvent.member_type",$member_type,null, array('id' => 'member_type','onchange'=>"loadMemberEmails()", 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

                        ?>
                    
                </span>
                </span></td>
            </tr>
            
            <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Maximum # Attendees <span style="color: red;">*</span></label>
        </div>
        
        </td>
            <td>
            <div style="margin-bottom: 10px;">
                <span class="intpSpan"><?php echo $form->input("RecurringEvent.max_attendees", array('id' => 'max_attendees', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;'));?></span> 
                <div style="width: 50px;display: inline-block; margin-top: 3px;text-align: right;vertical-align: top;">Start #</div>
                
                <span class="intpSpan"><?php
                 if($act=="edit")    $read_only="readonly";
                 echo $form->input("RecurringEvent.max_attendees_start", array('id' => 'max_attendees_start', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;','readonly'=>$read_only));?></span>
                </div>
                </td>
            </tr>
            
            <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Start Time <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
                                      <span class="txtArea_top">
                    <span class="txtArea_bot">        <select id="stime" name="data[RecurringEvent][stime]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;"> 
                    <?php echo $option_stime; ?>
                    </select>
                    <?php //echo $form->select("RecurringEvent.stime",$timedropdown,$sel_stime,array('id' => 'country','class'=>'multilist',"---Select---"); ?>
                </span>
                </span>
               </td>
            </tr>
    
           
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">End Time <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <select id="etime" name="data[RecurringEvent][etime]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">
                    <?php echo $option_etime; ?> 
                    </select>
                    <?php //echo $form->select("RecurringEvent.etime",$timedropdown,$sel_etime,array('id' => 'country','class'=>'multilist',"---Select---"); ?>
                </span>
                </span></td>
            </tr>    
            
        <!--<tr>
           
        <td>
        <div class="updat">
        <label class="boldlabel">Select Time Zone <span style="color: red;">*</span></label>
        </div>
        </td>
        <td>
                <span class="intpSpan middle"><?php // echo $form->text("RecurringEvent.task_timezone", array('id' => 'task_timezone','value'=>'', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span>
                </td>
            </tr>-->
            
            <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Start Date <span style="color: red;">*</span></label>
        </div>
        
        </td>
            <td>
                <span class="intpSpan middle"><?php echo $form->text("RecurringEvent.starttime", array('id' => 'starttime', 'value'=>$sdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
            </tr>      
            
          <tr>
           
        <td>
        <div class="updat">
        <label class="boldlabel">End Date <span style="color: red;">*</span></label>
        </div>
        
        </td>       
            <td>

                <span class="intpSpan middle"><?php echo $form->text("RecurringEvent.endtime", array('id' => 'endtime','value'=>$edate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span>
            </td>
                
        
        </tr>
        
        <?php
   
    ?>
           
           <tr>
        <td>
         <div class="updat">
        <label class="boldlabel">RSVP Response Email </label>
        </div>
        </td>
        <td>
       
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <div class="show_email_page_list">
                    <?php  echo $form->select("RecurringEvent.rsvp_email",$templatedropdown,null,array('id' => 'rsvp_email','class'=>'multilist'),"---Select---"); ?>
                    </div>
                </span>
                </span>&nbsp;&nbsp;&nbsp;
                <span>
                    <button type="button"  id="add_rsvp_email_template" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>
            
            <tr>
        <td>
         <div class="updat">
        <label class="boldlabel">Wait List Email </label>
        </div>
        </td>
        <td>
       
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <div class="show_email_page_list">
                    <?php  echo $form->select("RecurringEvent.waitlist_email",$templatedropdown,null,array('id' => 'waitlist_email','class'=>'multilist'),"---Select---"); ?>
                    </div>
                </span>
                </span>&nbsp;&nbsp;&nbsp;
                <span>
                    <button type="button"  id="add_wait_email_template" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>
        
                        
      
         
 
                   
        <tr><td colspan="2" style="text-align: left; padding-top: 5px;" class="top-bar">
                            <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
                            </td></tr>


            </table>
</td>
<td width="50%" valign="top">


            
            <table cellspacing="5" cellspacing="0">
           
            
       <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Location <span style="color: red;">*</span></label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.location", array('id' => 'location', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
        </tr>
        
         <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Address  </label>
        </div>
       </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.address", array('id' => 'address','div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span>
           </td>
        </tr> 
        
        <tr>
            <td>
            <div class="updat">
            <label class="boldlabel">Country </label>
            </div>
            </td>
            <td><span class="txtArea_top"><span class="txtArea_bot">
            <?php echo $form->select("RecurringEvent.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;','onchange'=>'return getstateoptions(this.value,"RecurringEvent")'),array('254'=>'United States')); ?>
            <?php echo $form->error('RecurringEvent.country', array('class' => 'errormsg')); ?> </span>
            </td>
        </tr>


        <tr>
            <td>
            <div class="updat">
            <label class="boldlabel">State</label>
            </div>
            </td>
            <td><span class="txtArea_top"><span class="txtArea_bot">
                <span id="statediv"><?php echo $form->select("RecurringEvent.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;'),"---Select---"); ?></span> </span></td>
            
        </tr>


        <tr>
            <td>
            <div class="updat">
            <label class="boldlabel">City</label>
            </div>
            </td>
            <td>
            <label for="project_name"></label><span class="intpSpan">
                <?php echo $form->input("RecurringEvent.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150")); ?></span></td>

        </tr>

        <tr>
            <td>
            <div class="updat">
            <label class="boldlabel">Zip/Postal Code </label>
            </div>
            </td>
            <td >
            <label for="project_name"></label><span class="intpSpan">
            <?php echo $form->input("RecurringEvent.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>

        </tr>
        
        
           <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Short Description  </label>
        </div>
       </td>
            <td>
            <span class="txtArea_top">
                <span class="txtArea_bot"><?php echo $form->textarea("RecurringEvent.eventdescription", array('id' => 'eventdescription', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
        </tr> 
        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Meta Description  </label>
        </div>
       </td>
            <td>
            <span class="txtArea_top">
                <span class="txtArea_bot"><?php echo $form->textarea("RecurringEvent.meta_description", array('id' => 'meta_description', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
        </tr> 
        
           
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel" style="padding-right: 16px;">RSVP Required </label>
        </div>
       
        </td>
            <td valign="top">
            <?php echo $form->input("RecurringEvent.rsvp_required", array('type'=>'checkbox','id' => 'rsvp_required','label'=>false,'div'=>false));?></td>
        </tr>        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel" style="padding-right: 16px;">Show to Invitees Only </label>
        </div>
       
        </td>
            <td valign="top">
            <?php echo $form->input("RecurringEvent.show_to_invitees_only", array('type'=>'checkbox','id' => 'show_to_invitees_only','label'=>false,'div'=>false));?></td>
        </tr>
        
        
        
            
       <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Member Price Ticket </label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.member_price", array('id' => 'member_price', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Non-Member Price Ticket </label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.non_member_price", array('id' => 'non_member_price', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Max. Tickets Per Member </label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.max_tickets_per_member", array('id' => 'max_tickets_per_member', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        
        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Event Logo <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
            <?php  echo $form->file('RecurringEvent.eventlogo',array('id'=> 'eventlogo',"class" => "contactInput"));?><br>
            
            <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please upload files with .jpg,.jpeg,.gif and .png extension only.</span><br/>
            <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250.</span>

            </td>
        </tr> 
        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Event Detail Page </label>
        </div>
        </td>
            <td>
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <!--<select id="detail_page" name="data[RecurringEvent][event_detail_page]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">                  
                    </select>-->
                    <div class="show_content_page_list">
                    <?php 
                        echo $form->select("RecurringEvent.event_detail_page",$submenu,null, array('id' => 'event_detail_page', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");		
            ?>
            </div>
                    
                </span>
                </span>
                <span>
                    <button type="button"  id="add_event_detail_page" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>
            
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Sponsor Detail Page </label>
        </div>
        </td>
            <td>
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <div class="show_content_page_list1">
                    
                    <?php 
                        echo $form->select("RecurringEvent.sponsor_detail_page",$submenu,null, array('id' => 'sponsor_detail_page', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

            ?>
                </div>
                </span>
                </span>
                <span>
                    <button type="button"  id="add_sponsor_detail_page" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>
            
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Inquiry Detail Page </label>
        </div>
        </td>
            <td>
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <div class="show_content_page_list2">
                    
                    <?php 
                        echo $form->select("RecurringEvent.inquiry_detail_page",$submenu,null, array('id' => 'inquiry_detail_page', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

            ?>
                </div>
                </span>
                </span>
                <span>
                    <button type="button"  id="add_inquiry_detail_page" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>
        </table>
</td>
</tr>
</table>
                    
                    <!-- ADD Sub Admin  FORM EOF -->

    
 
<!--inner-container ends here-->

<?php echo $form->end();?>

</div>
</div>
  
<div class="clear"></div>


<script type="text/javascript">
     $(document).ready(function() { 
        // alert("dom");
        loadMemberEmails(); 
        var current_domain=$("#current_domain").val();
        
        $("#add_event_detail_page").click(function(){           
            window.open(baseUrl+"companies/addcontentpage/0","Add Content Page",'width=850, height=550,resizable=no,scrollbars=1') 
        }); 
         $("#add_sponsor_detail_page").click(function(){           
            window.open(baseUrl+"companies/addcontentpage/0","Add Content Page",'width=850, height=550,resizable=no,scrollbars=1') 
        }); 
        $("#add_inquiry_detail_page").click(function(){           
            window.open(baseUrl+"companies/addcontentpage/0","Add Content Page",'width=850, height=550,resizable=no,scrollbars=1') 
        }); 
        
        $("#add_rsvp_email_template").click(function(){           
            window.open(baseUrl+"companies/addmailtemplate/0","Add Email Page",'width=850, height=550,resizable=no,scrollbars=1') 
        });
        
        $("#add_wait_email_template").click(function(){           
            window.open(baseUrl+"companies/addmailtemplate/0","Add Email Page",'width=850, height=550,resizable=no,scrollbars=1') 
        });
        
        $("#addrecipients").click(function(){
            addrecipients();  
        });
        $("#create_csv").click(function(){
            create_csv();  
        });
        
        $(document).ready(function()
        {
            $('#checkall').bind('change',function(){
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                    {
                    $('.checkid').each(function()
                    {
                        $(this).attr('checked',true);

                    });


                }else{

                    $('.checkid').each(function()
                    {
                        $(this).attr('checked',false);

                    });
                }        

            })

        });
        $(document).ready(function()
        {   
            $('.checkid').bind('change',function()
            {   
                //RecurringEvent.stopPropagation();
                var i=0;
                var j=0;
                $('.checkid').each(function(){
                    i++;
                    var check = $(this).attr('checked')?1:0;
                    if(check ==1)
                        {            
                        j++;
                    }


                });

                if(i==j)
                    $('#checkall').attr('checked',true);
                else
                    $('#checkall').attr('checked',false);
            });
        });
        
        function addrecipients()
        {    
            var counter=0;
            var existlist = document.getElementById('selected_for_invitations').value;
            var existlistarr = existlist.split(",");
            var str ='';
            var chk = '';

            var id="";
            $('.checkid').each(function(){        
                var check = $(this).attr('checked')?1:0;

                if(check ==1)
                    {            
                    chk = ''; 
                    id=$(this).val(); 

                    for(j=0;j<existlistarr.length;j++){

                        if(existlistarr[j]==id){
                            chk ='set'; 
                            break;
                        }
                    }

                    if(chk==''){
                        str += id+',';    
                    }
                    counter=counter +1;
                }
            });    

            if(counter==0)
                {
                alert("Please select at least one recipient");
                return false;
            }else{    
                str = trim(str,",");
                document.getElementById('selected_for_invitations').value = trim(trim(document.getElementById('selected_for_invitations').value,',')+","+str,","); 

            }
        } 
    }); 
</script>


<script type="text/javascript">
     $(document).ready(function() {
         
         showRecurPatternOptions();  
     
     $("#recur_pattern").change(function(){
            
              showRecurPatternOptions();  
     }); 
     
     
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
         
         
    }); 
</script>       
         