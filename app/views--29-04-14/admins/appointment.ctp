<?php
	$base_url_admin = Configure::read('App.base_url_admin');
	$base_url = Configure::read('App.base_url');
	$backUrl = $base_url_admin.'memberlist';
    echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
	echo $html->css('/css/jquery_ui_datepicker');
	echo $html->css('timepicker_plug/css/style');
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
var formChanged = false;

$(document).ready(function() {
     $('#eventcreate input[type=text].editable, #eventcreate textarea.editable').each(function (i) {
          $(this).data('initial_value', $(this).val());
     });

     $('#eventcreate input[type=text].editable, #eventcreate textarea.editable').keyup(function() {
          if ($(this).val() != $(this).data('initial_value')) {
               handleFormChanged();
          }
     });

     $('#eventcreate .editable').bind('change paste', function() {
          handleFormChanged();
     });

});

function handleFormChanged() {
     //$('#save_or_update').attr("disabled", false);
     formChanged = true;
     alert("changed");
}

function confirmNavigation() {
     if (formChanged) {
          return confirm('Are you sure? Your changes will be lost!');
     } else {
          return true;
     }
}


function loadMemberEmails()
{

    member_type=$("#member_type").val();
               
    var current_domain=$("#current_domain").val();
    $('#contactemails').load(baseUrlAdmin+'get_members_details_by_ajax/'+member_type, function(){
            //  $("#comment_start").val(commnet_offset);
            $('#contactemails').fadeIn(1000); 

    }); 

}

        
function update_content_page_list()
{
    //alert("In");
   var current_domain=$("#current_domain").val();
            $('.show_content_page_list').load(baseUrlAdmin+'update_content_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_content_page_list').fadeIn(1000); 

            }); 
         
}

function update_email_page_list()
{
    
   var current_domain=$("#current_domain").val();
        var url=baseUrlAdmin+'update_email_page_list/';
            $.ajax({
          type: 'GET',
          url: url,
          dataType: "html",
          success: function(data){
                $('#rsvp_email').html(data);
          }
        });
         
}

function create_csv()
{
    //alert("in");
    var current_domain=$("#current_domain").val();
    var selected_for_invitations=$("#selected_for_invitations").val();
    var url=baseUrlAdmin+'create_invitation_csv/';
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

	<style type="text/css">
    .ui-datepicker-trigger{position:relative !important;background:none;margin-left:5px;}
    
    .updat {
    display: inline-block;
    margin-bottom: 10px;
    margin-right: 16px;
    text-align: right;
    vertical-align: top;
    width: 190px;
}
.dateBut button{ right:0 !important}
    
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
                    minDate:0
                    //yearRange: currDate+':'+rangeDate 
                });
                
                $('#endtime').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    minDate:0
                     //yearRange: currDate+':'+rangeDate 
                });
                
                $('#end_by_date').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    minDate:0
                     //yearRange: currDate+':'+rangeDate 
                });
                $('#task_startdate').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    minDate:0
                     //yearRange: currDate+':'+rangeDate 
                });
               
          });
      /* ]]> */

       function validateevent(){
           //alert("validateevent");
          
             if(trim($('#title').val()) == '')
             {
                 inlineMsg('title','<strong>Event title required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#title').val()) == true){
                 inlineMsg('title','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             }
             
             if(trim($('#event_type').val()) == "")
             {
                 inlineMsg('event_type','<strong>Event Type required.</strong>',2);
                 return false;
             }
             
             if(trim($('#member_type').val()) == "")
             {
                 inlineMsg('member_type','<strong>Event Type required.</strong>',2);
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
           
             }
              
             
                          
              if(trim($('#starttime').val()) == '')
             {
                 inlineMsg('starttime','<strong>Event starttime required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#starttime').val()) == true){
                 inlineMsg('starttime','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
             
              
              
             //alert($("#recur_pattern").val());
             
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
                  if($('#weekly_monday').is(':checked')==false && $('#weekly_monday').is(':checked')==false && $('#weekly_tuesday').is(':checked')==false && $('#weekly_wednesday').is(':checked')==false && $('#weekly_thursday').is(':checked')==false && $('#weekly_friday').is(':checked')==false && $('#weekly_saturday').is(':checked')==false && $('#weekly_sunday').is(':checked')==false)
                  {
                      inlineMsg('recur_pattern','<strong>Please select atleast one weekday from below.</strong>',2);
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
                            alert("For the month where there is no 30th or 31st,event will occur on last day of month");
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
              
              if ($("#recur_pattern").val()=="Yearly" || $("#recur_pattern").val()=="Monthly" || $("#recur_pattern").val()=="Weekly" || $("#recur_pattern").val()=="Daily")
              {
                  if($('#recur_range').is(':checked'))
                  {                                  
                      $('#end_by_date').val('');
                      $('#task_end_after_occurrences').val('');                      
                                                
                  }
                  
                  if($('#after_accurrences').is(':checked'))
                  {                                  
                      if(trim($('#task_end_after_occurrences').val()) == "" || trim($('#task_end_after_occurrences').val()) <=0 || trim($('#task_end_after_occurrences').val())>30)
                      {                        
                            inlineMsg('task_end_after_occurrences','<strong>This field is required.Max 30 are allowed</strong>',2);
                            return false;
                      }
                                                
                  }
                  if($('#by_date').is(':checked'))
                  {                                  
                      if(trim($('#end_by_date').val()) == "" || trim($('#end_by_date').val()) =="0000-00-00")
                      {                        
                            inlineMsg('end_by_date','<strong>This field is required.</strong>',2);
                            return false;
                      }
                      
                      var sdate= ($('#starttime').val()).split("-");
                      var edate= ($('#end_by_date').val()).split("-");   
                      var startDate = new Date(sdate[2], sdate[0], sdate[1]); 
                      var endDate = new Date(edate[2], edate[0], edate[1]);
                  
                   
                      if (endDate < startDate) {
                          inlineMsg('end_by_date','<strong>The end date must come equal or after start date.</strong>',2);
                         return false; 
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
                                 if(startDate.toDateString()===endDate.toDateString())
                                 {
                                     if(ehr[0]< shr[0] && shr[0]!=12 )
                                     {  
                                        inlineMsg('etime','<strong>End time cannot be before start time for same date.</strong>',2);
                                        return false; 
                                     }else if(ehr[0]==shr[0])
                                     {   
                                           if(ehr[1]<= shr[1] )
                                           {              
                                                    inlineMsg('etime','<strong>End time cannot be before or equal to start time for same date.</strong>',2);
                                                    return false; 
                                           }
                                     }
                                 }
                               
                           }else if(sap=="pm" && eap=="am"){     
                               inlineMsg('etime','<strong>End time cannot be before strat time.</strong>',2);
                               return false;
                           } 
                                  
                      
                                                
                  }
                  
                  
                  
              }
            
        if ($("#recur_pattern").val()!="Yearly" && $("#recur_pattern").val()!="Monthly" && $("#recur_pattern").val()!="Weekly" && $("#recur_pattern").val()!="Daily")
              {
                  
                   if(trim($('#endtime').val()) == '')
                     {
                         inlineMsg('endtime','<strong>Event endtime required.</strong>',2);
                         return false;
                     }
                     if(tagValidate($('#endtime').val()) == true){
                         inlineMsg('endtime','<strong>Please dont use script tags.</strong>',2);
                         return false; 
                     }
             
                  
                 var sdate= ($('#starttime').val()).split("-");
                 var edate= ($('#endtime').val()).split("-");   
                 var startDate = new Date(sdate[2], sdate[0], sdate[1]); 
                 var endDate = new Date(edate[2], edate[0], edate[1]);
               
                  if (endDate < startDate) {
                      inlineMsg('endtime','<strong>The end date must come equal or after start date.</strong>',2);
                     return false; 
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
                     if(startDate.toDateString()===endDate.toDateString())
                     {
                         if(ehr[0]< shr[0] && shr[0]!=12 )
                         {  
                            inlineMsg('etime','<strong>End time cannot be before start time for same date.</strong>',2);
                            return false; 
                         }else if(ehr[0]==shr[0])
                         {   
                               if(ehr[1]<= shr[1] )
                               {              
                                        inlineMsg('etime','<strong>End time cannot be before or equal to start time for same date.</strong>',2);
                                        return false; 
                               }
                         }
                     }
                   
               }else if(sap=="pm" && eap=="am"){     
                   inlineMsg('etime','<strong>End time cannot be before strat time.</strong>',2);
                   return false;
               } 
               
               }
              
          if(trim($('#location').val()) == '')
             {
                 inlineMsg('location','<strong>Event location required.</strong>',2);
                 return false;
             }
             /*
              if(trim($('#max_tickets_per_member').val()) == ''){
                 inlineMsg('max_tickets_per_member','<strong>This field is required.</strong>',2);
                 return false; 
             }
             else*/
              if(trim($('#max_tickets_per_member').val()) != '')
              {
                 if(isNaN(trim($('#max_tickets_per_member').val()))){
                     inlineMsg('max_tickets_per_member','<strong>Only numbers are accepted.</strong>',2);
                     return false; 
                 }
              }
             
             var max_at=Number(trim($('#max_attendees').val()));
             var max_at_start=Number(trim($('#max_attendees_start').val()));
             var max_tick=Number(trim($('#max_tickets_per_member').val()));

             if(max_tick > max_at)
             {
                 inlineMsg('max_tickets_per_member','<strong>Max tickets per member should not exceed maximum attendees.</strong>',2);
                 return false; 
             }
             
             if(max_at_start > max_at)
             {
                 inlineMsg('max_attendees_start','<strong>Max Attendeed start should not exceed maximum attendees.</strong>',2);
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
                         inlineMsg('eventlogo','<strong>Please upload event logo.</strong>',2);
                          return false;
                         }
             }
             
 
             
           return true;
       }
        
    </script>
    
  <?php 
            if($this->data['Event']['id']){
                $act = 'edit';
                $header_text= "Edit Event Detail";
                $show_sub_menus=1;
                $div_class="titlCont";
            }else{
                $act = 'add';
                $header_text= "Create an Event ";
                $show_sub_menus=0;
                $div_class="titlCont1";
            }    
        ?>  
<div class="container"> 
<div class="titlCont">
<div class="centerPage">
	<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
	<?php echo $form->create("Admin", array("action" => "eventcreate",'type' => 'file','enctype'=>'multipart/form-data','name' => 'eventcreate', 'id' => "eventcreate","onsubmit"=>"return validateevent('$act');"))?>
	<input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
	<?php
$ids = $this->params['pass'][0]; 
e($html->link($html->image('call.png') . ' ' . __(''), $base_url_admin."call/1",array('escape' => false)));

e($html->link($html->image('email.png') . ' ' . __(''), $base_url_admin."sendtempmail/".$ids,array('escape' => false)));

e($html->link($html->image('sms.png') . ' ' . __(''), $base_url_admin."sendsms/1",array('escape' => false)));


e($html->link($html->image('message.png') . ' ' . __(''), $base_url_admin."messagenew",array('escape' => false)));

e($html->link($html->image('note.png') . ' ' . __(''), "../players/notelist/2",array('escape' => false)));

e($html->link($html->image('take.png') . ' ' . __(''), $base_url_admin."coming_soon/task",array('escape' => false))); ?>

	
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
	<?php e($html->image('save.png')) ?>
</button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
	<?php e($html->image('send.png')) ?>
</button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')">
<?php e($html->image('back.png')) ?>
</button>
		 <?php  echo $this->renderElement('new_slider');  ?>

	</div>

	<span class="titlTxt">
		Appointment/Event Details Add/Edit
	</span>
	
	<div class="topTabs" style="height:25px;">
		<?php /*?><ul>
		<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
		</ul><?php */?>
	</div>
   <?php   //if($eid>0){ $this->loginarea="admins";    $this->subtabsel="eventlist";
                    //echo $this->renderElement('eventlist_submenus'); } ?>
					 <?php    $this->loginarea="admins";    $this->subtabsel="eventlist";
		 
			if($_GET['url'] === 'admins/appointment'){
             //echo $this->renderElement('memberlistsecondlevel_submenus');
			 echo $this->renderElement('events_submenus'); 
				}
				else{
				
             echo $this->renderElement('events_submenus'); } ?>    
</div>
</div>
<div class="" style="width:990px; margin:0 auto">
</div>
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
					echo $form->error('Event.title', array('class' => 'msgTXt'));
				//	echo $form->error('Event.company_type_id', array('class' => 'msgTXt'));  ?> 
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
      				 echo $form->hidden("Event.id", array('id' => 'eventid','value'=>"$eventid"));
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
			<span class="intpSpan"><?php echo $form->input("Event.title", array('id' => 'title', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
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
					
                   <?php  echo $form->select("Event.event_type",$event_type,null, array('id' => 'event_type', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
					?>                    
                </span>
                </span></td>
            </tr>

			<tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Start Time <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
                                      <span class="txtArea_top">
                    <span class="txtArea_bot">        <select id="stime" name="data[Event][stime]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;"> 
                    <?php echo $option_stime; ?>
                    </select>
                    <?php //echo $form->select("Event.stime",$timedropdown,$sel_stime,array('id' => 'country','class'=>'multilist',"---Select---"); ?>
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
                    <select id="etime" name="data[Event][etime]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">
                    <?php echo $option_etime; ?> 
                    </select>
                    <?php //echo $form->select("Event.etime",$timedropdown,$sel_etime,array('id' => 'country','class'=>'multilist',"---Select---"); ?>
                </span>
                </span></td>
            </tr>
			
			
			
            
      <tr>
           
        <td>
        <div class="updat">
        <label class="boldlabel">Time Zone <span style="color: red;">*</span></label>
        </div>
        </td>
        <td>
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <?php echo $form->select("Event.timezone_id",$timeZoneDropDown,null,array('id' => 'timezone_id','class'=>'multilist'),array(''=>"---Select---")); ?>
                   
                </span>
                </span></td>
            </tr>
            
              	<tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Start Date <span style="color: red;">*</span></label>
        </div>
        
        </td>
            <td>
                <span class="intpSpan middle dateBut"><?php echo $form->text("Event.starttime", array('id' => 'starttime', 'value'=>(isset($sdate))?$sdate:'', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
            </tr>      
        
   
                                
       
             <tr>
           
        <td>		
        <div class="updat" id="end_date_name"  style="display: none;">
        <label class="boldlabel">End Date <span style="color: red;">*</span></label>
        </div>
        
        </td>       
            <td>
            <div id="end_date_field" style="display: none;">
                <span class="intpSpan middle"><?php echo $form->text("Event.endtime", array('id' => 'endtime','value'=>(isset($edate))?$edate:'', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></div>
            </td>
                
        
        </tr>
		
		
		 <tr>
              <td>&nbsp;</td>
              <td> 
              <div id="">   
                  <table>
                  <tbody>
                        <tr>                          
                            <td>   
								<?php if($this->data['Event']['daily_every_noof_days']!=""){  
										$daily_every_noof_days=$this->data['Event']['daily_every_noof_days'];}
									else{ $daily_every_noof_days=1;}?>
										<div><input type="radio" name='data[Event][daily_pattern]' checked="checked" id="everyday" value='everyday' <?php if($this->data['Event']['daily_pattern']=='everyday'){  echo ' checked="checked" ';}else{ echo ' ';}?> >&nbsp;Every 
                                <?php echo $form->text("Event.daily_every_noof_days", array('id' => 'daily_every_noof_days', 'div' => false, 'label' => '','value' => $daily_every_noof_days,"style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?></span> Day(s) </div>
                                <br/><div><input type='radio' name='data[Event][daily_pattern]' id="everyweek" value='everyweek' <?php if($this->data['Event']['daily_pattern']=='everyweek'){  echo ' checked="checked" ';}else{ echo ' ';}?> >&nbsp;Every Weekday</div>
                           </td>
                        </tr>
                  </tbody></table> 
              </div>       
              
              <div id="weekly_recur_pattern" style="display: none;"> 
                  <table>
                  <tbody>
                           <tr>
                        
                            <td>   <?php if($this->data['Event']['weekly_every_noof_weeks']!=""){  $weekly_every_noof_weeks=$this->data['Event']['weekly_every_noof_weeks'];}else{ $weekly_every_noof_weeks=1;}?>
                                 Recur every <?php echo $form->text("Event.weekly_every_noof_weeks", array('id' => 'weekly_every_noof_weeks', 'div' => false, 'label' => '', 'value' => $weekly_every_noof_weeks, "style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?> week(s) on:
                                <?php echo $form->input('Event.weekly_monday', array('type'=>'checkbox','id'=>'weekly_monday', 'label' => ' Monday')); ?>
                                <?php echo $form->input('Event.weekly_tuesday', array('type'=>'checkbox','id'=>'weekly_tuesday', 'label' => ' Tuesday')); ?>
                                <?php echo $form->input('Event.weekly_wednesday', array('type'=>'checkbox','id'=>'weekly_wednesday', 'label' => ' Wednesday')); ?>
                                <?php echo $form->input('Event.weekly_thursday', array('type'=>'checkbox','id'=>'weekly_thursday', 'label' => ' Thursday')); ?>
                                <?php echo $form->input('Event.weekly_friday', array('type'=>'checkbox','id'=>'weekly_friday', 'label' => ' Friday')); ?>
                                <?php echo $form->input('Event.weekly_saturday', array('type'=>'checkbox','id'=>'weekly_saturday', 'label' => ' Saturday')); ?>
                                <?php echo $form->input('Event.weekly_sunday', array('type'=>'checkbox','id'=>'weekly_sunday', 'label' => ' Sunday')); ?>
                            
                         </td>
                    </tr>
                  </tbody></table> 
              </div>       
              
               <div id="monthly_recur_pattern" style="display: none;">  
                  <table>
                  <tbody>
                           <tr>
                         
                            <td>
                                <div><input type="radio" name='data[Event][monthly_pattern]' checked="checked" id="dayofeverymonth" value='dayofeverymonth' <?php if($this->data['Event']['monthly_pattern']=='dayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?> >&nbsp;Day 
                                 <?php 
                                 if($this->data['Event']['monthly_onof_day']!=""){  $monthly_onof_day=$this->data['Event']['monthly_onof_day'];}else{ $monthly_onof_day=date('d');}
                                 if($this->data['Event']['monthly_every_noof_months']!=""){  $monthly_every_noof_months=$this->data['Event']['monthly_every_noof_months'];}else{ $monthly_every_noof_months=1;}
                                 ?>
                                <?php echo $form->text("Event.monthly_onof_day", array('id' => 'monthly_onof_day', 'div' => false, 'label' => '','value' => $monthly_onof_day,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?> of every 
                                <?php echo $form->text("Event.monthly_every_noof_months", array('id' => 'monthly_every_noof_months', 'div' => false, 'label' => '','value' => $monthly_every_noof_months,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?> month(s) </div>
                                <br/>
                                <div><input type='radio' name='data[Event][monthly_pattern]' id="weekdayofeverymonth" value='weekdayofeverymonth' <?php if($this->data['Event']['monthly_pattern']=='weekdayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp; The &nbsp;

                                 <select style="border: 1px solid black;" name="data[Event][monthly_weeknumber]">
                                   <option value="first"  <?php if($this->data['Event']['monthly_weeknumber']=='first'){  echo ' selected="selected" ';}else{ echo ' ';}?> >first</option>
                                     <option value="second" <?php if($this->data['Event']['monthly_weeknumber']=='second'){  echo ' selected="selected" ';}else{ echo ' ';}?> >second</option>
                                     <option value="third" <?php if($this->data['Event']['monthly_weeknumber']=='third'){  echo ' selected="selected" ';}else{ echo ' ';}?> >third</option>
                                     <option value="fourth" <?php if($this->data['Event']['monthly_weeknumber']=='fourth'){  echo ' selected="selected" ';}else{ echo ' ';}?> >fourth</option>
                                     <option value="last" <?php if($this->data['Event']['monthly_weeknumber']=='last'){  echo ' selected="selected" ';}else{ echo ' ';}?> >last</option>
                                 </select>

                                 <select style="border: 1px solid black;" name="data[Event][monthly_weekday]">
                                            <option value="Monday"  <?php if($this->data['Event']['monthly_weekday']=='Monday'){  echo ' selected="selected" ';}else{ echo ' ';}?> >Monday</option>
                                             <option value="Tuesday"  <?php if($this->data['Event']['monthly_weekday']=='Tuesday'){  echo ' selected="selected" ';}else{ echo ' ';}?> >Tuesday</option>
                                             <option value="Wednesday" <?php if($this->data['Event']['monthly_weekday']=='Wednesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Wednesday</option>
                                             <option value="Thursday" <?php if($this->data['Event']['monthly_weekday']=='Thursday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Thursday</option>
                                             <option value="Friday" <?php if($this->data['Event']['monthly_weekday']=='Friday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Friday</option>
                                             <option value="Saturday" <?php if($this->data['Event']['monthly_weekday']=='Saturday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Saturday</option>
                                             <option value="Sunday" <?php if($this->data['Event']['monthly_weekday']=='Sunday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Sunday</option>
                                 </select> <br/><br/>&nbsp; &nbsp;
                                 of every &nbsp;<?php 
                                  if($this->data['Event']['monthly_weekof_noof_months']!=""){  $monthly_weekof_noof_months=$this->data['Event']['monthly_weekof_noof_months'];}else{ $monthly_weekof_noof_months=1;}
                                 echo $form->input("Event.monthly_weekof_noof_months", array('id' => 'monthly_weekof_noof_months','div' => false, 'label' => '','value' => $monthly_weekof_noof_months,'style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Month(s)
                                 </div>
                            
                         </td>
                    </tr>
                  </tbody></table> 
              </div>       
              
              <div id="yearly_recur_pattern" style="display: none;">  
                  <table>
                  <tbody>
                           <tr>
                         
                            <td>
                                      <?php if($this->data['Event']['yearly_everymonth_date']!=""){  $yearly_everymonth_date=$this->data['Event']['yearly_everymonth_date'];}else{ $yearly_everymonth_date=date('d');}?>
                                     <input type="radio" value="everynoofmonths" id="everynoofmonths" checked="checked"  name="data[Event][yearly_pattern]" <?php if($this->data['Event']['yearly_pattern']=='everynoofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?> > Every &nbsp;
                                        <select id="yearly_everymonth" name="data[Event][yearly_everymonth]"  style="border: 1px solid black;">
                                         <option value="January" <?php if($this->data['Event']['yearly_everymonth']=='January'){  echo ' selected="selected" ';}else{ echo ' ';}?> >January</option>
                                         <option value="February" <?php if($this->data['Event']['yearly_everymonth']=='February'){  echo ' selected="selected" ';}else{ echo ' ';}?>>February</option>
                                         <option value="March" <?php if($this->data['Event']['yearly_everymonth']=='March'){  echo ' selected="selected" ';}else{ echo ' ';}?>>March</option>
                                         <option value="April" <?php if($this->data['Event']['yearly_everymonth']=='April'){  echo ' selected="selected" ';}else{ echo ' ';}?>>April</option>
                                         <option value="May" <?php if($this->data['Event']['yearly_everymonth']=='May'){  echo ' selected="selected" ';}else{ echo ' ';}?>>May</option>
                                         <option value="June" <?php if($this->data['Event']['yearly_everymonth']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
                                         <option value="July" <?php if($this->data['Event']['yearly_everymonth']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
                                         <option value="August" <?php if($this->data['Event']['yearly_everymonth']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
                                         <option value="September" <?php if($this->data['Event']['yearly_everymonth']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
                                         <option value="October" <?php if($this->data['Event']['yearly_everymonth']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
                                         <option value="November" <?php if($this->data['Event']['yearly_everymonth']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
                                         <option value="December" <?php if($this->data['Event']['yearly_everymonth']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>                                                                   
                                         </select>
                                        &nbsp;<?php echo $form->input("Event.yearly_everymonth_date", array('id' => 'yearly_everymonth_date','div' => false, 'label' => '', 'value' => $yearly_everymonth_date,'style'=>'border: 1px solid black;width:30px;'));?><br /><br />
                                         
                                         <input type="radio" value="theweekofmonths" id="theweekofmonths"  name="data[Event][yearly_pattern]" <?php if($this->data['Event']['yearly_pattern']=='theweekofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?>> The &nbsp;
                                         
                                         <select id="yearly_weeknumber" name="data[Event][yearly_weeknumber]"style="border: 1px solid black;">
                                         <option value="first"  <?php if($this->data['Event']['yearly_weeknumber']=='first'){  echo ' selected="selected" ';}else{ echo ' ';}?> >first</option>
                                         <option value="second" <?php if($this->data['Event']['yearly_weeknumber']=='second'){  echo ' selected="selected" ';}else{ echo ' ';}?> >second</option>
                                         <option value="third" <?php if($this->data['Event']['yearly_weeknumber']=='third'){  echo ' selected="selected" ';}else{ echo ' ';}?> >third</option>
                                         <option value="fourth" <?php if($this->data['Event']['yearly_weeknumber']=='fourth'){  echo ' selected="selected" ';}else{ echo ' ';}?> >fourth</option>
                                         <option value="last" <?php if($this->data['Event']['yearly_weeknumber']=='last'){  echo ' selected="selected" ';}else{ echo ' ';}?> >last</option>
                                         </select>
                                         
                                         <select id="yearly_weekday" name="data[Event][yearly_weekday]" style="border: 1px solid black;">
                                             <option value="Monday"  <?php if($this->data['Event']['yearly_weekday']=='Monday'){  echo ' selected="selected" ';}else{ echo ' ';}?> >Monday</option>
                                             <option value="Tuesday"  <?php if($this->data['Event']['yearly_weekday']=='Tuesday'){  echo ' selected="selected" ';}else{ echo ' ';}?> >Tuesday</option>
                                             <option value="Wednesday" <?php if($this->data['Event']['yearly_weekday']=='Wednesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Wednesday</option>
                                             <option value="Thursday" <?php if($this->data['Event']['yearly_weekday']=='Thursday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Thursday</option>
                                             <option value="Friday" <?php if($this->data['Event']['yearly_weekday']=='Friday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Friday</option>
                                             <option value="Saturday" <?php if($this->data['Event']['yearly_weekday']=='Saturday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Saturday</option>
                                             <option value="Sunday" <?php if($this->data['Event']['yearly_weekday']=='Sunday'){  echo ' selected="selected" ';}else{ echo ' ';}?>  >Sunday</option>
                                         </select>
                                         <br /><br />
                                         &nbsp;&nbsp;&nbsp;&nbsp;of 
                                         <select id="yearly_weekof_month" name="data[Event][yearly_weekof_month]" style="border: 1px solid black;">
                                          <option value="January" <?php if($this->data['Event']['yearly_weekof_month']=='January'){  echo ' selected="selected" ';}else{ echo ' ';}?> >January</option>
                                         <option value="February" <?php if($this->data['Event']['yearly_weekof_month']=='February'){  echo ' selected="selected" ';}else{ echo ' ';}?>>February</option>
                                         <option value="March" <?php if($this->data['Event']['yearly_weekof_month']=='March'){  echo ' selected="selected" ';}else{ echo ' ';}?>>March</option>
                                         <option value="April" <?php if($this->data['Event']['yearly_weekof_month']=='April'){  echo ' selected="selected" ';}else{ echo ' ';}?>>April</option>
                                         <option value="May" <?php if($this->data['Event']['yearly_weekof_month']=='May'){  echo ' selected="selected" ';}else{ echo ' ';}?>>May</option>
                                         <option value="June" <?php if($this->data['Event']['yearly_weekof_month']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
                                         <option value="July" <?php if($this->data['Event']['yearly_weekof_month']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
                                         <option value="August" <?php if($this->data['Event']['yearly_weekof_month']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
                                         <option value="September" <?php if($this->data['Event']['yearly_weekof_month']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
                                         <option value="October" <?php if($this->data['Event']['yearly_weekof_month']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
                                         <option value="November" <?php if($this->data['Event']['yearly_weekof_month']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
                                         <option value="December" <?php if($this->data['Event']['yearly_weekof_month']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>                                                                   
                                         </select>
                            
                         </td>
                    </tr>
                  </tbody></table> 
              </div>       
              <br />
             </td>
        </tr>
        
        <tr>        
           <td valign="top">
           <div class="updat">
        <label class="boldlabel">Recurrence Range <span style="color: red;">*</span></label>
        </div>
        </td>
        <td>
        <div >   
        <?php
        if(isset($eventdata['task_end'])=="by_no_date")
            $no_end_date="checked='checked'";   
        if(isset($eventdata['task_end'])=="after_accurrences")
            $end_after="checked='checked'";
        if(isset($eventdata['task_end'])=="by_date")
            $end_by="checked='checked'";
        ?>
            
            <input type="radio" value="by_no_date" id="recur_range" name="data[Event][task_end]" checked="checked" <?php echo (isset($no_end_date))?$no_end_date:''?>> No End Date &nbsp;
            
            <br /><br />
            <input type="radio" value="after_accurrences" id="after_accurrences" name="data[Event][task_end]" <?php echo (isset($end_after))?$end_after:''?>> End After &nbsp;
            &nbsp;<?php echo $form->input("Event.task_end_after_occurrences", array('id' => 'task_end_after_occurrences','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Occurences
            <br /><br />
            <?php 
            if(isset($eventdata['task_end'])=="by_date")
            {
                if($eventdata['task_end_by_date']!=NULL && $eventdata['task_end_by_date']!="" && $eventdata['task_end_by_date']!="0000-00-00")
                    $ed=date('m-d-Y',strtotime($eventdata['task_end_by_date']));
                else
                    $ed="";
            }
            else
                $ed="";
            ?>
            <input type="radio" value="by_date"  id="by_date" name="data[Event][task_end]" <?php echo (isset($end_by))?$end_by:'';?>> End by &nbsp;
            &nbsp;<?php echo $form->input("Event.end_by_date", array('id' => 'end_by_date','div' => false, 'label' => '','style'=>'border: 1px solid black;width:100px;','value'=>$ed));?>
            <br /><br />
            
            </div>
            </td>

           </tr>
           
		 <tr>
        <td>
         <div class="updat">
        <label class="boldlabel">Send Email Template </label>
		
		<div style="margin:7px 5px 0 0;">
							       <span class="btnLft"><input type="button"  class="btnRht" value="Add" name="Add" onclick="addEmailTempforRSVP();" /></span>					
						</div>
						
						
        </div>
		
        </td>
 
	  
	    <td style=" vertical-align: top;">
            <span class="txtArea_top">
                <span class="txtArea_bot">
			
				<?php  $template = $this->data['EmailTemplate']['email_template_name']; 
				
				?>
										
<select onchange="showselecttemplate(this.value)" class="multilist" id="templateid" name="data[EmailTemplate][id]">
<option value="select">---Select---</option>
<?php
foreach($email_templates as $key =>$temp){
?> 
<option value="<?php echo $key; ?>"><?php echo $temp['EmailTemplate']['email_template_name']; ?></option>
<?php
}
?>
</select>
				
				
				
				
				
				
				
				
				
				 <?php //echo $form->select("EmailTemplate.id",isset($templatedropdown)?$templatedropdown:'',null,array('id' => 'templateid','class'=>'multilist','onchange'=>'showselecttemplate(this.value)'),"---Select---"); ?>
				
                <?php //echo $form->select("Event.rsvp_email",$respondaremail,null,array('id' => 'rsvp_email','class'=>'multilist'),array(''=>'--Select--')); ?>
                </span>
            </span>
     
                </td>
            </tr>  
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
         


			</table>
</td>
<td width="50%" valign="top">


            
            <table cellspacing="5" cellspacing="0">
			
			
			
			<tr>
        <td>
         <div class="updat">
        <label class="boldlabel">Branch </label>
        </div>
        </td>
        <td>
            <span class="txtArea_top">
                <span class="txtArea_bot">
                <?php echo $form->select("Event.branch",$respondarbranch,null,array('id' => 'branch','class'=>'multilist'),array(''=>'--Select--')); ?>
                </span>
            </span>
            
                </td>
            </tr>
			
               <tr>
				<td>
				<div class="updat">
				<label class="boldlabel"> Other Location <span style="color: red;">*</span></label>
				</div>
			   
				</td>
				<td>
					<span class="intpSpan"><?php echo $form->input("Event.location", array('id' => 'location', 'div' => false, 'label' => 
					'',"class" => "inpt_txt_fld","maxlength" => "150"));?></span>
				</td>
				</tr>
				
				 <tr>
				<td>
				<div class="updat">
				<label class="boldlabel">Address  </label>
				</div>
			   </td>
					<td>
					<span class="intpSpan"><?php echo $form->input("Event.address", array('id' => 'address', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span>
				   </td>
				</tr> 
				
				<tr>
					<td>
					<div class="updat">
					<label class="boldlabel">Country </label>
					</div>
					</td>
					<td><span class="txtArea_top"><span class="txtArea_bot">
					<?php echo $form->select("Event.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;','onchange'=>'return getstateoptions(this.value,"Event")'),array('254'=>'United States')); ?>
					<?php echo $form->error('Event.country', array('class' => 'errormsg')); ?> </span>
					</td>
					</tr>
					<tr>
						<td>
						<div class="updat">
						<label class="boldlabel">State</label>
						</div>
						</td>
						<td><span class="txtArea_top"><span class="txtArea_bot">
							<span id="statediv"><?php echo $form->select("Event.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;'),"---Select---"); ?></span> </span></td>
            		</tr>
					<tr>
						<td>
						<div class="updat">
						<label class="boldlabel">City</label>
						</div>
						</td>
						<td>
						<label for="project_name"></label><span class="intpSpan">
							<?php echo $form->input("Event.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150")); ?></span></td>
				</tr>

				<tr>
					<td>
					<div class="updat">
					<label class="boldlabel">Zip/Postal Code </label>
					</div>
					</td>
					<td >
					<label for="project_name"></label><span class="intpSpan">
					<?php echo $form->input("Event.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
				</tr>       
           <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Short Description  </label>
        </div>
       </td>
            <td>
            <span class="txtArea_top">
                <span class="txtArea_bot"><?php echo $form->textarea("Event.eventdescription", array('id' => 'eventdescription', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
        </tr> 
        
		
		
		
		
		
        
        
        <tr>
        <td>
        
        </td>
			<?php if(!empty($logo)){?>
			<td>				
          			 <img src="<?php echo $base_url.'img/project/uploads/'.$logo ?>" width="50px" height="50px" >
            </td>
		<?php } ?>	
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

<div class="clear"></div></div>  
<script type="text/javascript">
var h=screen.height;
var w=screen.width;
$('#endtime').val($('#starttime').val());

$("#starttime").change(function(){
           
$('#endtime').val($('#starttime').val());
});
 /**
         * Funtion addnew email template in pop-up
         */
		 var resWindow1 = null;
         function addEmailTempforRSVP() {   
                      $('#rsvp_email').focus();
             resWindow1=  window.open (baseUrlAdmin+'addmailtemplate/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
             resWindow1.focus();
           }
		   
	
           
        /**
         * Funtion addnew email template in pop-up
         */
		 var resWindow2 = null;
         function addEmailTempforWaitList() {    
             $('#waitlist_email').focus();
             resWindow2=  window.open (baseUrlAdmin+'addmailtemplate/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
             resWindow2.focus();
          }
		   
		 $(window).focus(function() {
		 	
			if(resWindow1!=null && resWindow1.closed){
				resWindow1=null; 
				getemailtemplatesbyajax("<?php echo $projectid;?>",'rsvp_email',"0",'1');  
			}
		 
			if(resWindow2!=null && resWindow2.closed){
					resWindow2=null; 
				//	getemailtemplatesbyajax("<?php echo $projectid;?>",'waitlist_email',"0",'2');  
			}
		});
           
         // This function is called after closing of child window ie. on page addmailtemplate.ctp 
        function GetEmailTempRefresh(){
            
           // var pid='<?php // echo $projectid;?>';  //alert("Refresh EMail temp dorp dwon"+pid);  
           // var selectedid=$("#rsvp_email").val();
            //svar event=1;
            get_lastinsertedID_email("EmailTemplate");
            //alert(selectedid);
            //getemailtemplatesbyajax(pid,'rsvp_email',selectedid,event );    
            //var selectedid=$("#waitlist_email").val();
            //getemailtemplatesbyajax(pid, 'waitlist_email', selectedid,event );    
            
        }
        
        function get_lastinsertedID_email(modelname) {    
               if(modelname==""){
                  return false;
               }
               var event=1;
               var pid='<?php echo $projectid;?>';
                alert(pid);        
               jQuery.ajax({
                     type: "GET",
                     url: baseUrlAdmin+'get_lastinsertedID/'+modelname,
                     cache: false,
                     datatype:'text',
					 
                     success: function(selectedid){
                            var focus=$("*:focus").attr("id");
                            //if(focus=="rsvp_email")
                              //  getemailtemplatesbyajax(pid,'rsvp_email',selectedid,'1');    
                            //else
                               // getemailtemplatesbyajax(pid, 'waitlist_email', selectedid,'2');    
                     }
             });
      
      }
       
        
          /**
         * Funtion addnew RecurringEvent details page in pop-up
         */
         function addContentforEventDetails() {      
             if(validateevent("add"))
             {
                 var event_title=$('#title').val()+" "+$('#starttime').val();

                 
                 $('#event_detail_page').focus();
                 var resWindow=  window.open (baseUrlAdmin+'addcontentpage/popup/detail/'+event_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                 resWindow.focus();
             }
           }
           
            /**
         * Funtion addnew sponsor detail page in pop-up
         */
         function addContentforSponsorDetails() {  
             if(validateevent("add"))
             {
                 var event_title=$('#title').val()+" "+$('#starttime').val();    
             
                 $('#sponsor_detail_page').focus();
                 var resWindow=  window.open (baseUrlAdmin+'addcontentpage/popup/sponsor/'+event_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                 resWindow.focus();
             }
           }
           
            /**
         * Funtion addnew inquiry details page in pop-up
         */
		
         function addContentforInquiryDetails() {    
             
             if(validateevent("add"))
             {
                 var event_title=$('#title').val()+" "+$('#starttime').val();  
             
                 $('#inquiry_detail_page').focus();
                 var resWindow=  window.open (baseUrlAdmin+'addcontentpage/popup/inquiry/'+event_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                 resWindow.focus();
             }
           }
		   
		   
		
		   
          // This function is called after closing of child window ie. on page addmailtemplate.ctp 
        function GetContentRefresh(){
            
            //var pid='<?php // echo $projectid;?>';  
            //alert("Refresh content temp dorp dwon"+pid);
            //var selectedid=$("#event_detail_page").val();
            //getcontentsbyajax(pid, 'event_detail_page', selectedid );   
             
            //selectedid=$("#sponsor_detail_page").val();
            //getcontentsbyajax(pid, 'sponsor_detail_page', selectedid ); 
            
            //selectedid=$("#inquiry_detail_page").val();
            //getcontentsbyajax(pid, 'inquiry_detail_page', selectedid );    
            
            get_lastinsertedID_content("Content"); 
            
        }
        
        function get_lastinsertedID_content(modelname) {    
               if(modelname==""){
                  return false;
               }
               var event=1;
               var pid='<?php echo $projectid;?>';
                        
               jQuery.ajax({
                     type: "GET",
                     url: '/admins/get_lastinsertedID/'+modelname,
                     cache: false,
                     datatype:'text',
                     success: function(selectedid){
                            var focus=$("*:focus").attr("id");
                            //alert(selectedid);
                            if(focus=="event_detail_page")
                                getcontentsbyajax(pid, 'event_detail_page', selectedid );    
                            else
                            if(focus=="sponsor_detail_page")
                                getcontentsbyajax(pid, 'sponsor_detail_page', selectedid );      
                            else
                            if(focus=="inquiry_detail_page")
                                getcontentsbyajax(pid, 'inquiry_detail_page', selectedid );      
                     }
             });
      
      }
        
               /**
        * REfresh Comment type dropdown
        */
        function getcontentsbyajax(projectid,eleid, selectedid) {   
        
               if(projectid==""){
                  return false;
               }
               var temp_type="";
               
               if(eleid=="event_detail_page")
                    temp_type="event_detail";
               if(eleid=="sponsor_detail_page")
                    temp_type="event_sponsor";
               if(eleid=="inquiry_detail_page")
                    temp_type="event_inquiry";
                        
               jQuery.ajax({
                     type: "GET",
                     url: baseUrlAdmin+'getcontentpagesbyajax/'+projectid+'/'+selectedid+'/'+temp_type,
                     cache: false,
                     success: function(rText){
                            jQuery('#'+eleid).html(rText);
                     }
             });
      
      }
       $(document).ready(function() { 
        // alert("dom");
        
        getcontentsbyajax("<?php echo $projectid;?>","event_detail_page","0");
        getcontentsbyajax("<?php echo $projectid;?>","sponsor_detail_page", "0");
        getcontentsbyajax("<?php echo $projectid;?>","inquiry_detail_page", "0");
               
        getemailtemplatesbyajax("<?php echo $projectid;?>",'rsvp_email',"0",'1');    
        getemailtemplatesbyajax("<?php echo $projectid;?>",'waitlist_email',"0",'2');           
               
        loadMemberEmails(); 
        var current_domain=$("#current_domain").val();
        
        
        
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
                //event.stopPropagation();
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
             $("#recur_pattern_range").hide();
             $("#recur_range_name").hide();
            if(recur_pattern=='Yearly'){
                   $("#yearly_recur_pattern").show();  
                   $("#recur_pattern_range").show();  
                   $("#recur_range_name").show();
                   $("#end_date_name").hide();
                   $("#end_date_field").hide();
            }else if(recur_pattern=='Monthly'){
                    $("#monthly_recur_pattern").show();
                    $("#recur_pattern_range").show();
                    $("#recur_range_name").show();  
                    $("#end_date_name").hide();
                    $("#end_date_field").hide();
            }else if(recur_pattern=='Weekly'){
                  $("#weekly_recur_pattern").show();   
                  $("#recur_pattern_range").show(); 
                  $("#recur_range_name").show();  
                  $("#end_date_name").hide();
                $("#end_date_field").hide();
            }else
            if(recur_pattern=='Daily'){
                //recur_pattern=='Daily'
                $("#daily_recur_pattern").show();  
                $("#recur_pattern_range").show(); 
                $("#recur_range_name").show();   
                $("#end_date_name").hide();
                $("#end_date_field").hide();
            }
            else{       //if none
            $("#daily_recur_pattern").hide();    
             $("#weekly_recur_pattern").hide();    
             $("#monthly_recur_pattern").hide();    
             $("#yearly_recur_pattern").hide();    
             $("#recur_pattern_range").hide();  
             $("#recur_range_name").hide();
             
             $("#end_date_name").show();
             $("#end_date_field").show();
                         
            }
        }
         
         
    }); 
</script>       
         