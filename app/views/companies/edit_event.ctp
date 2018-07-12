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
    
   var current_domain=$("#current_domain").val();
        /*    $('.show_email_page_list').load('http://'+current_domain+'/companies/update_email_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_email_page_list').fadeIn(1000); 

            }); 
            */
        var url=baseUrl+'companies/update_email_page_list/';
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
             
             if(trim($('#show_attendees_start').val()) == '')
              {
                    inlineMsg('show_attendees_start','<strong>Attendees Start is required.</strong>',2);
                    return false; 
              }
              else
             if(trim($('#show_attendees_start').val()) != ''){
             
                 if(isNaN(trim($('#show_attendees_start').val()))){
                     inlineMsg('show_attendees_start','<strong>Only numbers are accepted.</strong>',2);
                     return false; 
                 }
             /*  var start_max=$('#max_attendees_start').val();
                 var max=$('#max_attendees').val();
                 
                 if(start_max > max ){
                     inlineMsg('max_attendees_start','<strong>Attendees Start should be less than Maximum Attendees.</strong>',2);
                     return false; 
                 }*/
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
            /*  
              if(trim($('#rsvp_email').val()) == '')
              {
                 inlineMsg('rsvp_email','<strong>RSVP Response Email required.</strong>',2);
                 return false;
              }
              if(trim($('#waitlist_email').val()) == '')
              {
                 inlineMsg('waitlist_email','<strong>Wait List Email  required.</strong>',2);
                 return false;
              }
              */
        
        
                  
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
             var max_at_start=Number(trim($('#show_attendees_start').val()));
             var max_tick=Number(trim($('#max_tickets_per_member').val()));

             if(max_tick > max_at)
             {
                 inlineMsg('max_tickets_per_member','<strong>Max tickets per member should not exceed maximum attendees.</strong>',2);
                 return false; 
             }
             
             if(max_at_start > max_at)
             {
                 inlineMsg('show_attendees_start','<strong>Max Attendeed start should not exceed maximum attendees.</strong>',2);
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
                         inlineMsg('eventlogo','<strong>Please upload Event logo.</strong>',2);
                          return false;
                         }
             }
             
 
             
           return true;
       }
        
    </script>
    
  <?php 
            if($this->data['RecurringEvent']['id']){
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
	<span class="titlTxt">
		<?php  echo $header_text;?>
	</span>
	
	<?php echo $form->create("Company", array("action" => "edit_event",'type' => 'file','enctype'=>'multipart/form-data','name' => 'edit_event', 'id' => "edit_event","onsubmit"=>"return validateevent('$act');"))?>
    <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
	<div class="topTabs">
		<ul>
		<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location=baseUrl+'companies/eventlist')"><span> Cancel</span></button></li>
		</ul>
	</div>
    <?php if ($show_sub_menus==1)
    {
        ?>
    <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
        <div style="height: 30px; clear:both;">
            <?php echo $form->hidden("selectedtab", array('id' => 'selectedtab')); ?>
                <div id="tab-container-1">
                <ul id="tab-container-1-nav" class="topTabs2">
    
                  <!--<li><a href="/companies/eventcreate/<?php// echo $this->data['RecurringEvent']['id']; ?>" class="tabSelt"><span>Edit RecurringEvent</span></a></li>-->
                  <li>
				<?php
					e($html->link(
					$html->tag('span', 'RSVP'),
					array('controller'=>'companies','action'=>'rsvp_sponsor',$this->data['RecurringEvent']['id']),
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
					array('controller'=>'companies','action'=>'rsvp_sponsor',$this->data['RecurringEvent']['id']),
					array('escape' => false)
					)
				);
			?>

				</li>
                  <?php
                   }
                    ?>
                    <li><a href="/companies/send_invite/<?php // echo $this->data['RecurringEvent']['id']; ?>"><span>Send Invite</span></a></li>
                   <li><a href="/companies/eventtasklist/<?php echo $this->data['RecurringEvent']['id']; ?>"><span>Event Task</span></a></li>
                   <li><a href="/companies/eventinvitationhistory/<?php echo $this->data['RecurringEvent']['id']; ?>"><span>Invites</span></a></li>
                   <li><a href="/companies/event_donations/<?php echo $this->data['RecurringEvent']['id'];; ?>" ><span>Donations</span></a></li>
                   <li><a href="/companies/event_volunteers/<?php echo $this->data['RecurringEvent']['id'];; ?>"><span>Volunteers</span></a></li>
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
				//	echo $form->error('RecurringEvent.company_type_id', array('class' => 'msgTXt'));  ?> 
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
      				 echo $form->hidden("RecurringEvent.id", array('id' => 'rec_eventid','value'=>"$rec_eventid"));
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
              //$event_title = preg_match("/\d{2}\/\d{2}\/\d{4}$/",'',$this->data['RecurringEvent']['event_title']);
            $event_title = preg_replace("/\d{2}\-\d{2}\-\d{4}$/",'',$eventdata['event_title']);      
            $event_title=trim($event_title);     
             echo $form->input("RecurringEvent.event_title", array('id' => 'title','value'=>$event_title, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
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
                        echo $form->select("RecurringEvent.event_type",$event_type,$data['RecurringEvent']['event_type'], array('id' => 'event_type', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

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
                        echo $form->select("RecurringEvent.member_type",$member_type,$data['RecurringEvent']['member_type'], array('id' => 'member_type','onchange'=>"loadMemberEmails()", 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

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
            <td valign="top">
            <table width="auto" border="0">
            <tr>
            <td><span class="intpSpan"><?php echo $form->input("RecurringEvent.max_attendees", array('id' => 'max_attendees', 'value'=>$eventdata['RecurringEvent']['max_attendees'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;'));?></span> </td>
            <td valign="top" style="width: 44px; padding: 3px 6px 9px 16px;">Start #</td>
            <td> <span class="intpSpan"><?php 
                //if($act=="edit")    $read_only="readonly";                
                 echo $form->input("RecurringEvent.show_attendees_start", array('id' => 'show_attendees_start', 'value'=>$eventdata['RecurringEvent']['show_attendees_start'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;'));?></span>
            </tr>
            </table>
            <!--<div style="margin-bottom: 10px;">
                <span class="intpSpan"><?php // echo $form->input("RecurringEvent.max_attendees", array('id' => 'max_attendees', 'value'=>$eventdata['RecurringEvent']['max_attendees'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;'));?></span> 
                <div style="width: 50px;display: inline-block; margin-top: 3px;text-align: right;vertical-align: top;">Start #</div>
                <span class="intpSpan"><?php 
                //if($act=="edit")    $read_only="readonly";                
                // echo $form->input("RecurringEvent.show_attendees_start", array('id' => 'show_attendees_start', 'value'=>$eventdata['RecurringEvent']['show_attendees_start'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;'));?></span>
                 
            </div>-->
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
            
       <!-- <tr>
           
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
           
           <tr>
        <td>
         <div class="updat">
        <label class="boldlabel">RSVP Response Email </label>
        </div>
        </td>
        <td>
            <span class="txtArea_top">
                <span class="txtArea_bot">
                <?php echo $form->select("RecurringEvent.rsvp_email",$templatedropdown,$data['RecurringEvent']['rsvp_email'],array('id' => 'rsvp_email','class'=>'multilist'),array(''=>'--Select--')); ?>
                </span>
            </span>
            <span class="btnLft"><input type="button"  class="btnRht" value="Add" name="Add" onclick="addEmailTempforRSVP();" /></span>

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
                        <?php echo $form->select("RecurringEvent.waitlist_email",$templatedropdown,$data['RecurringEvent']['waitlist_email'],array('id' => 'waitlist_email','class'=>'multilist'),array(''=>'--Select--')); ?>
                    </span>
                </span>
                <span class="btnLft"><input type="button"  class="btnRht" value="Add" name="Add" onclick="addEmailTempforWaitList();" /></span>
                </td>
            </tr>
        
                        
      
           <!--<tr>
           <td valign="top"><br />
            <div class="updat">
            <label class="boldlabel">Recurrence Range </label>
            </div>
            </td>
            <td>            
            <input type="radio" value="no_end_date" class="no_end_date"  id="recur_range" name="data[RecurringEvent][recur_range]" <?php echo $no_end_date;?>> No End Date &nbsp;
            
            <br /><br />
            <input type="radio" value="end_after" class="end_after"   id="recur_range" name="data[RecurringEvent][recur_range]" <?php echo $end_after;?>> End After &nbsp;
            &nbsp;<?php // echo $form->input("RecurringEvent.recur_range_occ", array('id' => 'recur_range_occ','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Occurences
            <br /><br />
            </td>
           </tr>-->
           
           
		<tr><td colspan="2" style="text-align: left; padding-top: 5px;" class="top-bar">
                            <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
                            </td></tr>


			</table>
</td>
<td width="50%" valign="top">


            
            <table cellspacing="5" cellspacing="0">
            <!--<tr>
            <td>
            <div class="updat">
            <label class="boldlabel">RecurringEvent Logo <span style="color: red;">*</span></label>
            </div>
            </td>
                <td>
                <?php //  echo $form->file('RecurringEvent.eventlogo',array('id'=> 'eventlogo',"class" => "contactInput"));?><br>
                
                <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please upload files with .jpg,.jpeg,.gif and .png extension only.</span><br/
                <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250.</span>

                </td>
            </tr> -->
            
<!-- <tr>
            <td colspan="2">
                <p ><label class="boldlabel">1. Select the email id you want to send the mail</label></p>
                <div id="contactemails" style=" background: none repeat scroll 0 0 #EBEBEB;  border: 1px solid #D3D3D3; display: block; font-size: 10px; height: 175px; overflow: auto; width: 100%;" > 

                </div>
                
                <br />

                <p><label class="boldlabel">2. Click the Add Recipients button to add the selected names as recipients</label></p>                    
                <span><br />
                    <button type="button"  id="addrecipients" class="button"><span>Add Recipients</span> </button>            
                </span>

            </td>
        </tr>-->
        
        <!--<tr>
        <td><br />
        
        <p><label class="boldlabel">3. Selected for Invitations</label></p>
        <span class="txtArea_top">
            <span class="newtxtArea_bot">
                <?php // echo $form->input("RecurringEvent.selected_for_invitations", array('id' => 'selected_for_invitations', 'div' => false, 'label' => '','rows'=>'7','cols'=>'65','style' =>'width:230px;',"class" => "noBg",'value'=>$toid));?>
            </span>
        </span>
        </td>
        <td><span><br />
                    <button type="button"  id="create_csv" class="button"><span>Create CSV File</span> </button>            
                </span></td>
        </tr>
        
        <tr>
        <td colspan="2">
        <br />
        <p><label class="boldlabel">4. Pick Email Template</label></p>
       
                  <span class="txtArea_top">
                    <span class="txtArea_bot">
                    <div class="show_email_page_list">
                    <?php // echo $form->select("RecurringEvent.email_template",$templatedropdown,$selectedtemplate,array('id' => 'templateid','class'=>'multilist'),"---Select---"); ?>
                    </div>
                </span>
                </span>&nbsp;&nbsp;&nbsp;
                <span>
                    <button type="button"  id="add_email_template" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>-->
            
       <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Location <span style="color: red;">*</span></label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.location", array('id' => 'location', 'value'=>$eventdata['RecurringEvent']['location'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
        </tr>
        
         <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Address  </label>
        </div>
       </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.address", array('id' => 'address', 'value'=>$eventdata['RecurringEvent']['address'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span>
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
                <span class="txtArea_bot"><?php echo $form->textarea("RecurringEvent.eventdescription", array('id' => 'eventdescription', 'value'=>$eventdata['RecurringEvent']['eventdescription'], 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
        </tr> 
        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Meta Description  </label>
        </div>
       </td>
            <td>
            <span class="txtArea_top">
                <span class="txtArea_bot"><?php echo $form->textarea("RecurringEvent.meta_description", array('id' => 'meta_description', 'value'=>$eventdata['RecurringEvent']['meta_description'], 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
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
        
        <!--<tr>
        <td>
        <div class="updat">
        <label style="padding-right: 16px;">Coin Holders Only </label>
        </div>
       
        </td>
            <td valign="top">
            <?php // echo $form->input("RecurringEvent.coin_holders_only", array('type'=>'checkbox','id' => 'coin_holders_only','label'=>false,'div'=>false));?></td>
        </tr>-->
        
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
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.member_price", array('id' => 'member_price', 'value'=>$eventdata['RecurringEvent']['member_price'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Non-Member Price Ticket </label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.non_member_price", array('id' => 'non_member_price', 'value'=>$eventdata['RecurringEvent']['non_member_price'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Max. Tickets Per Member </label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("RecurringEvent.max_tickets_per_member", array('id' => 'max_tickets_per_member', 'value'=>$eventdata['RecurringEvent']['max_tickets_per_member'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
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
                        <?php echo $form->select("RecurringEvent.event_detail_page",$submenu,$data['RecurringEvent']['event_detail_page'],array('id' => 'event_detail_page','class'=>'multilist'),array(''=>'--Select--')); ?>
                    </span>
                </span>
                <span class="btnLft"><input type="button"  class="btnRht" value="Edit" id="event_detail_btn" name="Add" onclick="addContentforEventDetails();" /></span>

                
                
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
                                            <?php echo $form->select("RecurringEvent.sponsor_detail_page",$submenu,$data['RecurringEvent']['sponsor_detail_page'],array('id' => 'sponsor_detail_page','class'=>'multilist'),array(''=>'--Select--')); ?>
                                          </span>
                                          </span>
                                          <span class="btnLft"><input type="button"  class="btnRht" value="Edit" id="sponsor_detail_btn" name="Add" onclick="addContentforSponsorDetails();" /></span>

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
                                            <?php echo $form->select("RecurringEvent.inquiry_detail_page",$submenu,$data['RecurringEvent']['inquiry_detail_page'],array('id' => 'inquiry_detail_page','class'=>'multilist'),array(''=>'--Select--')); ?>
                                          </span>
                                          </span>
                                          <span class="btnLft"><input type="button"  class="btnRht" value="Edit" id="inquiry_detail_btn" name="Add" onclick="addContentforInquiryDetails();" /></span>
                                               </td>
            </tr>
        
        
 
       
         <!--<tr>
           
        <td colspan="2">
        <br />
        <p><label class="boldlabel">7. Task Start Date</label></p>
        <?php 
            if($eventdata['task_startdate']) 
                $task_startdate=date('m-d-Y',strtotime($eventdata['task_startdate']));
            else
                $task_startdate="";
            ?>
        
                <span class="intpSpan middle"><?php // echo $form->text("RecurringEvent.task_startdate", array('id' => 'task_startdate','value'=>$task_startdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span>
                </td>
            </tr>
         
          <tr>
           
        <td colspan="2">
        <br />
        <p><label class="boldlabel">8. Task Start Time</label></p>
        
                <span class="txtArea_top">
                    <span class="txtArea_bot">        <select id="task_starttime" name="data[RecurringEvent][task_starttime]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;"> 
                    <?php // echo $option_stime; ?>
                    </select>
                    <?php //echo $form->select("RecurringEvent.stime",$timedropdown,$sel_stime,array('id' => 'country','class'=>'multilist',"---Select---"); ?>
                </span>
                </span>
                </td>
            </tr>   
            
            
        
            
            <tr>
            <td colspan="2"><span>
                    <button type="button"  id="submit_event" class="button"><span>Submit</span> </button>            
                </span></td>
            </tr>-->
        
            
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

var h=screen.height;
var w=screen.width;

$('#endtime').val($('#starttime').val());

$("#starttime").change(function(){
           
$('#endtime').val($('#starttime').val());
});


 /**
         * Funtion addnew email template in pop-up
         */
         function addEmailTempforRSVP() {   
                      $('#rsvp_email').focus();
             var resWindow=  window.open (baseUrl+'companies/addmailtemplate/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
             resWindow.focus();
           }
           
        /**
         * Funtion addnew email template in pop-up
         */
         function addEmailTempforWaitList() {    
         
             $('#waitlist_email').focus();
             var resWindow=  window.open (baseUrl+'companies/addmailtemplate/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
             resWindow.focus();
           }
           
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
                        
               jQuery.ajax({
                     type: "GET",
                     url: baseUrl+'companies/get_lastinsertedID/'+modelname,
                     cache: false,
                     datatype:'text',
                     success: function(selectedid){
                            var focus=$("*:focus").attr("id");
                            if(focus=="rsvp_email")
                                getemailtemplatesbyajax(pid,'rsvp_email',selectedid,'1' );    
                            else
                                getemailtemplatesbyajax(pid, 'waitlist_email', selectedid,'2' );    
                     }
             });
      
      }
        
           /**
         * Funtion addnew RecurringEvent details page in pop-up
         */
         function addContentforEventDetails() {      
             if(validateevent("edit"))
             {
                 
                 var select_box_cnt=$('#event_detail_page option').size();
                 
                 if(select_box_cnt<=1)
                 {
                      var event_title=$('#title').val()+" "+$('#starttime').val();
                 
                     $('#event_detail_page').focus();
                     var resWindow=  window.open (baseUrl+'companies/addcontentpage/popup/detail/'+event_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                     resWindow.focus();
                 }
                 else
                 {
                 
                     var content_id=$('#event_detail_page').val();
                     
                     if(content_id=="")
                     {
                        alert("Please Select a Item");
                        return false;
                     }
                     
                     $('#event_detail_page').focus();
                      var resWindow=  window.open ('/companies/editcontent/'+content_id+'/popup/detail/', 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                     resWindow.focus();
                 }
             }
           }
           
            /**
         * Funtion addnew sponsor detail page in pop-up
         */
         function addContentforSponsorDetails() {  
             if(validateevent("edit"))
             {
                 var select_box_cnt=$('#sponsor_detail_page option').size();
                 
                 if(select_box_cnt<=1)
                 {
                     var event_title=$('#title').val()+" "+$('#starttime').val();    
             
                     $('#sponsor_detail_page').focus();
                     var resWindow=  window.open ('/companies/addcontentpage/popup/sponsor/'+event_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                     resWindow.focus();
                 }
                 else
                 {
                     var content_id=$('#sponsor_detail_page').val();
                     
                     if(content_id=="")
                     {
                        alert("Please Select a Item");
                        return false;
                     }
                 
                     $('#sponsor_detail_page').focus();
                     var resWindow=  window.open (baseUrl+'companies/editcontent/'+content_id+'/popup/sponsor/', 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                     resWindow.focus();
                 }
             }
           }
           
            /**
         * Funtion addnew inquiry details page in pop-up
         */
         function addContentforInquiryDetails() {    
             
             if(validateevent("edit"))
             {
                 
                 var select_box_cnt=$('#inquiry_detail_page option').size();
                 
                 if(select_box_cnt<=1)
                 {
                     var event_title=$('#title').val()+" "+$('#starttime').val();  
             
                     $('#inquiry_detail_page').focus();
                     var resWindow=  window.open (baseUrl+'companies/addcontentpage/popup/inquiry/'+event_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                     resWindow.focus();
                 }
                 else
                 {
                 
                     var content_id=$('#inquiry_detail_page').val();
                     
                     if(content_id=="")
                     {
                        alert("Please Select a Item");
                        return false;
                     }
                 
                     $('#inquiry_detail_page').focus();
                     var resWindow=  window.open (baseUrl+'companies/editcontent/'+content_id+'/popup/inquiry/', 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                     resWindow.focus();
                 }
             }
           }
           
          // This function is called after closing of child window ie. on page addmailtemplate.ctp 
        function GetContentRefresh(){
            
            var pid='<?php  echo $projectid;?>';  
            //alert("Refresh content temp dorp dwon"+pid);
            var selectedid=$("#event_detail_page").val();
            getcontentsbyajax(pid, 'event_detail_page', selectedid );   
             
            selectedid=$("#sponsor_detail_page").val();
            getcontentsbyajax(pid, 'sponsor_detail_page', selectedid ); 
            
            selectedid=$("#inquiry_detail_page").val();
            getcontentsbyajax(pid, 'inquiry_detail_page', selectedid );    
            
            //get_lastinsertedID_content("Content"); 
            
        }
        
        function get_lastinsertedID_content(modelname) {    
               if(modelname==""){
                  return false;
               }
               var event=1;
               var pid='<?php echo $projectid;?>';
                        
               jQuery.ajax({
                     type: "GET",
                     url: baseUrl+'companies/get_lastinsertedID/'+modelname,
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
               
               if(selectedid=="")
                selectedid=0;
               
               if(eleid=="event_detail_page")
                    temp_type="event_detail";
               if(eleid=="sponsor_detail_page")
                    temp_type="event_sponsor";
               if(eleid=="inquiry_detail_page")
                    temp_type="event_inquiry";
                        
               jQuery.ajax({
                     type: "GET",
                     url: baseUrl+'companies/getcontentpagesbyajax/'+projectid+'/'+selectedid+'/'+temp_type,
                     cache: false,
                     success: function(rText){
                            jQuery('#'+eleid).html(rText);
                            
                            if(eleid=="event_detail_page")
                           {
                               
                                var event_box_cnt=$('#event_detail_page option').size();
                                if(event_box_cnt<=1)
                                    $('#event_detail_btn').val("Add");
                                else
                                    $('#event_detail_btn').val("Edit");
                           }
                           if(eleid=="sponsor_detail_page")
                           {
                               
                                var sponsor_box_cnt=$('#sponsor_detail_page option').size();
                                if(sponsor_box_cnt<=1)
                                    $('#sponsor_detail_btn').val("Add");
                                else
                                    $('#sponsor_detail_btn').val("Edit");
                           }
                                
                           if(eleid=="inquiry_detail_page")
                           {
                               
                               var inquiry_box_cnt=$('#inquiry_detail_page option').size();
                               if(inquiry_box_cnt<=1)
                                    $('#inquiry_detail_btn').val("Add");
                                else
                                    $('#inquiry_detail_btn').val("Edit");
                                                 
                           }
                     }
             });
      
      }
       



     $(document).ready(function() { 
        // alert("dom");
        
       getcontentsbyajax("<?php echo $projectid;?>","event_detail_page","<?php echo $rec_event_data['RecurringEvent']['event_detail_page'];?>");
        getcontentsbyajax("<?php echo $projectid;?>","sponsor_detail_page", "<?php echo $rec_event_data['RecurringEvent']['sponsor_detail_page'];?>");
        getcontentsbyajax("<?php echo $projectid;?>","inquiry_detail_page", "<?php echo $rec_event_data['RecurringEvent']['inquiry_detail_page'];?>");
        
        getemailtemplatesbyajax("<?php echo $projectid;?>",'rsvp_email',"<?php echo $rec_event_data['RecurringEvent']['rsvp_email'];?>",'1');    
        getemailtemplatesbyajax("<?php echo $projectid;?>",'waitlist_email',"<?php echo $rec_event_data['RecurringEvent']['waitlist_email'];?>",'2'); 
        
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