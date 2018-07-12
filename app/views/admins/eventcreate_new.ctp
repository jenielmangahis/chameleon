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
            $('#contactemails').load('http://'+current_domain+'/admins/get_members_details_by_ajax/'+member_type, function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('#contactemails').fadeIn(1000); 

            }); 
        
        }
        
        
function update_content_page_list()
{
    //alert("In");
   var current_domain=$("#current_domain").val();
            $('.show_content_page_list').load('http://'+current_domain+'/admins/update_content_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_content_page_list').fadeIn(1000); 

            }); 
         
}

function update_email_page_list()
{
    //alert("In");
   var current_domain=$("#current_domain").val();
            $('.show_email_page_list').load('http://'+current_domain+'/admins/update_email_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_email_page_list').fadeIn(1000); 

            }); 
         
}

function create_csv()
{
    //alert("in");
    var current_domain=$("#current_domain").val();
    var selected_for_invitations=$("#selected_for_invitations").val();
    var url='http://'+current_domain+'/admins/create_invitation_csv/';
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

    
    <link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
    <link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">   
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
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    yearRange: currDate+':'+rangeDate 
                });
                
                $('#endtime').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                     yearRange: currDate+':'+rangeDate 
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
              
             if(trim($('#max_tickets_per_member').val()) == ''){
                 inlineMsg('max_tickets_per_member','<strong>This field is required.</strong>',2);
                 return false; 
             }
             else
             if(isNaN(trim($('#max_tickets_per_member').val()))){
                 inlineMsg('max_tickets_per_member','<strong>Only numbers are accepted.</strong>',2);
                 return false; 
             }
             if(trim($('#max_attendees').val()) != ''){
                 if(isNaN(trim($('#max_attendees').val()))){
                     inlineMsg('max_attendees','<strong>Only numbers are accepted.</strong>',2);
                     return false; 
                 }
             }
             if(trim($('#max_attendees_start').val()) != ''){
             
                 if(isNaN(trim($('#max_attendees_start').val()))){
                     inlineMsg('max_attendees_start','<strong>Only numbers are accepted.</strong>',2);
                     return false; 
                 }
             }
             
              if(trim($('#location').val()) == '')
             {
                 inlineMsg('location','<strong>Event location required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#location').val()) == true){
                 inlineMsg('location','<strong>Please dont use script tags.</strong>',2);
                 return false; 
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
                     }
                   
               }else if(sap=="pm" && eap=="am"){     
                   inlineMsg('etime','<strong>End time cannot be before strat time.</strong>',2);
                   return false;
               } 
              
              
              if ($("#Daily").is(':checked'))
              {
                  //alert($('#DailyCronJob_select').val());
                  if($('#DailyCronJob_select').val()=="every_#days")
                  {
                      if(trim($('#recur_on').val()) == '')
                      {                        
                            inlineMsg('recur_on','<strong>This field is required.</strong>',2);
                            return false;
                      }
                  }
                    
              }
              
              if ($("#Weekly").is(':checked'))
              {
                  var tmp=document.getElementById('recur_#weeks').value;
              
                      if(trim(tmp) == '')
                      {                        
                            inlineMsg('recur_#weeks','<strong>This field is required.</strong>',2);
                            return false;
                      }                 
                    
              }
              
              if ($("#Monthly").is(':checked'))
              {
                  //alert($('#MonthlyCronJob_select').val());
                  if($('#MonthlyCronJob_select1').is(':checked'))
                  {
                      if(trim(document.getElementById('day#').value) == '')
                      {                        
                            inlineMsg('day#','<strong>This field is required.</strong>',2);
                            return false;
                      }
                      if(trim(document.getElementById('every#month').value) == '')
                      {                        
                            inlineMsg('every#month','<strong>This field is required.</strong>',2);
                            return false;
                      }
                  }
                  
                  if($('#MonthlyCronJob_select2').is(':checked'))
                  {
                      //alert("i am here");
                      //alert(document.getElementById('#every#month1').value);
                      if(trim(document.getElementById('every#month1').value) == '')
                      {                        
                            inlineMsg('every#month1','<strong>This field is required.</strong>',2);
                            return false;
                      }
                  }
                  
                    
              }
              if($('.end_after').is(':checked'))
              {                                  
                  if(trim($('#recur_range_occ').val()) == '')
                  {                        
                        inlineMsg('recur_range_occ','<strong>This field is required.</strong>',2);
                        return false;
                  }
                                            
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
<div class="titlCont1">
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
        <?php 
            if($this->data['Event']['id']){
                $act = 'edit';
                echo "Edit Event Detail";
            }else{
                $act = 'add';
                echo "Create an Event ";
            }    
        ?>
    </span>
    
    <?php echo $form->create("Admin", array("action" => "eventcreate",'type' => 'file','enctype'=>'multipart/form-data','name' => 'eventcreate', 'id' => "eventcreate","onsubmit"=>"return validateevent('$act');"))?>
    <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
    <div class="topTabs">
        <ul>
        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
        <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/eventlist')"><span> Cancel</span></button></li>
        </ul>
    </div>
    
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
                    echo $form->error('Event.title', array('class' => 'msgTXt'));
                //    echo $form->error('Event.company_type_id', array('class' => 'msgTXt'));  ?> 
                </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
        </div>
</div>
                                            <?php }?>
<table>
<tr>
<td width="50%">
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
            <span class="intpSpan"><?php echo $form->input("Event.title", array('id' => 'title','value'=>$eventdata['Event']['title'], 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
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
                    <!--<select id="stime" name="data[Event][event_type]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">  
                    <option value="At Location">At Location</option>               
                    <option value="Video Conference">Video Conference</option>
                    <option value="Webinar">Webinar</option>
                    <option value="Conference Call">Conference call</option>
                    <option value="At Location & Live Broadcast">At Location & Live Broadcast</option>
                    </select>-->
                    <?php 
                        echo $form->select("Event.event_type",$event_type,$data['Event']['event_type'], array('id' => 'event_type', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

            ?>
                    
                </span>
                </span></td>
            </tr>
            <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Member Price Ticket </label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("Event.member_price", array('id' => 'member_price', 'value'=>$eventdata['Event']['member_price'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Non-Member Price Ticket </label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("Event.non_member_price", array('id' => 'non_member_price', 'value'=>$eventdata['Event']['non_member_price'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Max. Tickets Per Member <span style="color: red;">*</span></label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("Event.max_tickets_per_member", array('id' => 'max_tickets_per_member', 'value'=>$eventdata['Event']['max_tickets_per_member'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:100px;'));?></span></td>
        </tr>
        
        <tr>
        <td>
        <div class="updat">
        <label style="padding-right: 16px;">RSVP Required </label>
        </div>
       
        </td>
            <td valign="top">
            <?php echo $form->input("Event.rsvp_required", array('type'=>'checkbox','id' => 'rsvp_required','label'=>false,'div'=>false));?></td>
        </tr>
        
        <tr>
        <td>
        <div class="updat">
        <label style="padding-right: 16px;">Coin Holders Only </label>
        </div>
       
        </td>
            <td valign="top">
            <?php echo $form->input("Event.coin_holders_only", array('type'=>'checkbox','id' => 'coin_holders_only','label'=>false,'div'=>false));?></td>
        </tr>
        
        <tr>
        <td>
        <div class="updat">
        <label style="padding-right: 16px;">Show to Invitees Only </label>
        </div>
       
        </td>
            <td valign="top">
            <?php echo $form->input("Event.show_invitees_only", array('type'=>'checkbox','id' => 'show_invitees_only','label'=>false,'div'=>false));?></td>
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
                    <!--<select id="member_type" name="data[Event][member_type]" onchange="loadMemberEmails()" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">
                    <option value="all">All</option>                  
                    <option value="coin_holders">Coin Holders</option>                  
                    <option value="non_coin_holders">Non Coin Holders</option>                  
                    <option value="non_members">Non Members</option>                  
                    </select>-->
                    <?php 
                        echo $form->select("Event.member_type",$member_type,$data['Event']['member_type'], array('id' => 'member_type','onchange'=>"loadMemberEmails()", 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

                        ?>
                    
                </span>
                </span></td>
            </tr>
            
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Maximum # Attendees </label>
        </div>
        
        </td>
            <td>
                <span class="intpSpan"><?php echo $form->input("Event.max_attendees", array('id' => 'max_attendees', 'value'=>$eventdata['Event']['max_attendees'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;'));?>Start #</span> 
                
                <span class="intpSpan"><?php echo $form->input("Event.max_attendees_start", array('id' => 'max_attendees_start', 'value'=>$eventdata['Event']['max_attendees_start'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'style'=>'width:70px;'));?></span>
                </td>
            </tr>
        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Short Description  </label>
        </div>
       </td>
            <td>
            <span class="txtArea_top">
                <span class="txtArea_bot"><?php echo $form->textarea("Event.eventdescription", array('id' => 'eventdescription', 'value'=>$eventdata['Event']['eventdescription'], 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
        </tr> 
        
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Meta Description  </label>
        </div>
       </td>
            <td>
            <span class="txtArea_top">
                <span class="txtArea_bot"><?php echo $form->textarea("Event.meta_description", array('id' => 'meta_description', 'value'=>$eventdata['Event']['meta_description'], 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
        </tr> 
        
             <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Location <span style="color: red;">*</span></label>
        </div>
       
        </td>
            <td>
            <span class="intpSpan"><?php echo $form->input("Event.location", array('id' => 'location', 'value'=>$eventdata['Event']['location'],'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
        </tr>
        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Address  </label>
        </div>
       </td>
            <td>
            <span class="txtArea_top">
                <span class="txtArea_bot"><?php echo $form->textarea("Event.address", array('id' => 'meta_description', 'value'=>$eventdata['Event']['address'], 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?></span></span></td>
        </tr> 

        <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Start Date <span style="color: red;">*</span></label>
        </div>
        
        </td>
            <td>
                <span class="intpSpan middle"><?php echo $form->text("Event.starttime", array('id' => 'starttime', 'value'=>$sdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
            </tr>
    
           <tr>
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
           <td valign="top">
            <div class="updat">
            <label class="boldlabel">Recurrence </label>
            </div>
            </td>
            <td> 
            <?php //debugbreak();
            if($eventdata['recur']=="Daily")
            {
                $daily="checked='checked'";
            }
            else
            if($eventdata['recur']=="Yearly")
            {
                $yearly="checked='checked'";
            }
            else
            if($eventdata['recur']=="Monthly")
            {
                $monthly="checked='checked'";
            }
            else
            //if($eventdata['recur']=="Weekly")
            {
                $weekly="checked='checked'";
            }
            
            if($eventdata['recur_range']=="no_end_date")
            {
                $no_end_date="checked='checked'";
            }
            else
            if($eventdata['recur_range']=="end_after")
            {
                $end_after="checked='checked'";
            }
            ?>
            <div style="position: relative; float: left; width: auto; height: 130px;">
                 <div id="recur_left_div" style="position: relative; float: left; width: 75px;border-right: 2px solid gray;height: 115px; ">
                     <input type="radio" value="Daily" id="Daily" class="recur" name="data[Event][recur]" <?php echo $daily;?>> Daily &nbsp;<br /><br />
                     <input type="radio" value="Weekly" id="Weekly" class="recur" name="data[Event][recur]" <?php echo $weekly;?>> Weekly &nbsp;<br /><br />
                     <input type="radio" value="Monthly" id="Monthly" class="recur" name="data[Event][recur]" <?php echo $monthly;?>> Monthly &nbsp;<br /><br />
                     <input type="radio" value="Yearly" id="Yearly" class="recur" name="data[Event][recur]" <?php echo $yearly;?>> Yearly &nbsp;<br /><br />
                 </div>
                 
                 <div id="recur_right_div" style="position: relative; float: left; width: 250px;padding-left: 5px;">
                 
                 <div id="daily_div">
                 <?php
                    
                        if($daily_data['every_days']!="" || $daily_data['every_days']!=NULL)
                            $check_every_days="checked";
                        else
                            $check_every_weekdays="checked"; 
                ?>

                <input type="radio" id="DailyCronJob_select" value="every_#days" class="recur" name="data[DailyCronJob][select]" <?php echo $check_every_days;?>> Every <?php echo $form->input("DailyCronJob.every_days_value", array('id' => 'recur_on','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;','value'=>$daily_data['every_days']));?>&nbsp; day(s)<br /><br />
                <input type="radio" id="DailyCronJob_select" value="every_weekdays" class="recur" name="data[DailyCronJob][select]" <?php echo $check_every_weekdays;?>> Every weekday
                
                </div>
                <div id="weekly_div">
               <?php
              //debugbreak();
               $week_arr=explode(',',$weekly_data['on_#days']);
               
               if(in_array("Sunday",$week_arr))
                    $Sunday="checked='yes'";
               if(in_array("Monday",$week_arr))
                    $Monday="checked='yes'";
               if(in_array("Tuesday",$week_arr))
                    $Tuesday="checked='yes'";
               if(in_array("Wednesday",$week_arr))
                    $Wednesday="checked='yes'";
               if(in_array("Thursday",$week_arr))
                    $Thursday="checked='yes'";
               if(in_array("Friday",$week_arr))
                    $Friday="checked='yes'";
               if(in_array("Saturday",$week_arr))
                    $Saturday="checked='yes'";
               
                ?>
                Recur On &nbsp;<?php echo $form->input("WeeklyCronJob.recur_#weeks", array('id' => 'recur_#weeks','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;','value'=>$weekly_data['recur_#weeks']));?>&nbsp;Week(s) on:
                                  <br /><br />          
                                    <input type="checkbox" value="Sunday" <?php echo $Sunday;?> name="data[WeeklyCronJob][on_#days][]"> Sunday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" value="Monday" <?php echo $Monday;?> name="data[WeeklyCronJob][on_#days][]"> Monday &nbsp;
                                    <input type="checkbox" value="Tuesday" <?php echo $Tuesday;?> name="data[WeeklyCronJob][on_#days][]"> Tuesday &nbsp;
                                    <br /><br />
                                    <input type="checkbox" value="Wednesday" <?php echo $Wednesday;?> name="data[WeeklyCronJob][on_#days][]"> Wednesday &nbsp;
                                    <input type="checkbox" value="Thursday" <?php echo $Thursday;?> name="data[WeeklyCronJob][on_#days][]"> Thursday
                                    <input type="checkbox" value="Friday" <?php echo $Friday;?> name="data[WeeklyCronJob][on_#days][]"> Friday &nbsp;
                                    <br /><br />
                                    <input type="checkbox" value="Saturday" <?php echo $Saturday;?> name="data[WeeklyCronJob][on_#days][]"> Saturday &nbsp;
               
                </div>
               
                <div id="montly_div">
                <?php
                //debugbreak();
                    if($monthly_data['day#_of_every#month']==1)
                    {
                        $m_day=$monthly_data['day#'];
                        $m_every_month1=$monthly_data['every#month'];
                        $select1="checked";
                    }
                    else
                    {
                        $m_every_month2=$monthly_data['every#month'];
                        $select2="checked";
                        $m_week=explode(',',$monthly_data['day#']);
                        $weekday_no=$m_week[0];
                        $weekday=$m_week[1];
                        
                        if($weekday_no=="first")
                            $first="Selected";
                        if($weekday_no=="second")
                            $second="Selected";
                        if($weekday_no=="third")
                            $third="Selected";
                        if($weekday_no=="fourth")
                            $fourth="Selected";
                        if($weekday_no=="last")
                            $last="Selected";
                            
                        if($weekday=="Sunday")
                            $w_Sunday="Selected";
                        if($weekday=="Monday")
                            $w_Monday="Selected";
                        if($weekday=="Tuesday")
                            $w_Tuesday="Selected";
                        if($weekday=="Wednesday")
                            $w_Wednesday="Selected'";
                        if($weekday=="Thursday")
                            $w_Thursday="Selected";
                        if($weekday=="Friday")
                            $w_Friday="Selected";
                        if($weekday=="Saturday")
                            $w_Saturday="Selected";
                       
                    }
                ?>        
                <input type="radio" id="MonthlyCronJob_select1" value="day#_of_every#month" name="data[MonthlyCronJob][select]" <?php echo $select1;?> > Day &nbsp; <?php echo $form->input("MonthlyCronJob.day#", array('id' => 'day#','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;','value'=>$m_day));?>&nbsp;
                of every &nbsp;<?php echo $form->input("MonthlyCronJob.every#month", array('id' => 'every#month','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;','value'=>$m_every_month1));?>&nbsp;Month(s)<br /><br />
                 
                 <input type="radio" id="MonthlyCronJob_select2" value="the_#day_of_every#month" name="data[MonthlyCronJob][select]" <?php echo $select2;?> > The &nbsp;
                 
                 <select style="border: 1px solid black;" name="data[MonthlyCronJob][weekday_no]">
                 <option value="first" <?php echo $first;?> >first</option>
                 <option value="second" <?php echo $second;?>>second</option>
                 <option value="third" <?php echo $third;?>>third</option>
                 <option value="fourth" <?php echo $fourth;?>>fourth</option>
                 <option value="last" <?php echo $last;?>>last</option>
                 </select>
                 
                 <select style="border: 1px solid black;" name="data[MonthlyCronJob][weekday]">
                 <option value="Monday" <?php echo $w_Monday;?>>Monday</option>
                 <option value="Tuesday" <?php echo $w_Tuesday;?>>Tuesday</option>
                 <option value="Wednesday" <?php echo $w_Wednesday;?>>Wednesday</option>
                 <option value="Thursday" <?php echo $w_Thursday;?>>Thursday</option>
                 <option value="Friday" <?php echo $w_Friday;?>>Friday</option>
                 <option value="Saturday" <?php echo $w_Saturday;?>>Saturday</option>
                 <option value="Sunday" <?php echo $w_Sunday;?>>Sunday</option>
                 </select>
                 <br /><br />
                 &nbsp;&nbsp;&nbsp;&nbsp;of every &nbsp;<?php echo $form->input("MonthlyCronJob.every#month1", array('id' => 'every#month1','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;','value'=>$m_every_month2));?>&nbsp;Month(s)
                                  
                
                </div>
                <div id="yearly_div">

                
                <input type="radio" value="Daily" id="recur" class="recur" name="data[Event][recur1]" <?php echo $daily;?>> Every &nbsp;
                <select style="border: 1px solid black;">
                 <option>January</option>
                 <option>February</option>
                 <option>March</option>
                 <option>April</option>
                 <option>May</option>
                 </select>
                &nbsp;<?php echo $form->input("Event.recur_on", array('id' => 'recur_on','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Month(s)<br /><br />
                 
                 <input type="radio" value="Daily" id="recur" class="recur" name="data[Event][recur1]" <?php echo $daily;?>> The &nbsp;
                 
                 <select style="border: 1px solid black;">
                 <option>first</option>
                 <option>second</option>
                 <option>third</option>
                 <option>fourth</option>
                 <option>last</option>
                 </select>
                 
                 <select style="border: 1px solid black;">
                 <option>Monday</option>
                 <option>Tuesday</option>
                 <option>Wednesday</option>
                 <option>Thursday</option>
                 <option>Friday</option>
                 <option>Saturday</option>
                 </select>
                 <br /><br />
                 &nbsp;&nbsp;&nbsp;&nbsp;of 
                 <select style="border: 1px solid black;">
                 <option>January</option>
                 <option>February</option>
                 <option>March</option>
                 <option>April</option>
                 <option>May</option>
                 </select>
                                  
                
                </div>
                 
                </div>
                
          </div>   

            </td>
           </tr>
           
           <tr>
           <td valign="top"><br />
            <div class="updat">
            <label class="boldlabel">Recurrence Range </label>
            </div>
            </td>
            <td>            
            <input type="radio" value="no_end_date" class="no_end_date"  id="recur_range" name="data[Event][recur_range]" <?php echo $no_end_date;?>> No End Date &nbsp;
            
            <br /><br />
            <input type="radio" value="end_after" class="end_after"   id="recur_range" name="data[Event][recur_range]" <?php echo $end_after;?>> End After &nbsp;
            &nbsp;<?php echo $form->input("Event.recur_range_occ", array('id' => 'recur_range_occ','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Occurences
            <br /><br />
            </td>
           </tr>
           
           <tr>
           
        <td>
        <div class="updat">
        <label class="boldlabel">End Date </label>
        </div>
        
        </td>
            <td >
                <span class="intpSpan middle"><?php echo $form->text("Event.endtime", array('id' => 'endtime','value'=>$edate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
            </tr>

   
    
     
<!--    
<tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Event Logo <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
            <?php // echo $form->file('Event.eventlogo',array('id'=> 'eventlogo',"class" => "contactInput"));?><br>
            
            <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please upload files with .jpg,.jpeg,.gif and .png extension only.</span><br/>
            <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250.</span>

            </td>
        </tr> -->
        
    
    

      

                   
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
            <label class="boldlabel">Event Logo <span style="color: red;">*</span></label>
            </div>
            </td>
                <td>
                <?php  echo $form->file('Event.eventlogo',array('id'=> 'eventlogo',"class" => "contactInput"));?><br>
                
                <!--<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please upload files with .jpg,.jpeg,.gif and .png extension only.</span><br/>-->
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
                    <!--<select id="detail_page" name="data[Event][event_detail_page]" class="noBg" style="border: none; width: 230px; margin-bottom: 7px;">                  
                    </select>-->
                    <div class="show_content_page_list">
                    <?php 
                        echo $form->select("Event.event_detail_page",$submenu,$data['Event']['event_detail_page'], array('id' => 'event_detail_page', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

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
                        echo $form->select("Event.sponsor_detail_page",$submenu,$data['Event']['sponsor_detail_page'], array('id' => 'sponsor_detail_page', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

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
                        echo $form->select("Event.inquiry_detail_page",$submenu,$data['Event']['sponsor_detail_page'], array('id' => 'inquiry_detail_page', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

            ?>
                </div>
                </span>
                </span>
                <span>
                    <button type="button"  id="add_inquiry_detail_page" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>
            
        
        
        <tr>
            <td colspan="2">
                <p ><label class="boldlabel">1. Select the email id you want to send the mail</label></p>
                <div id="contactemails" style=" background: none repeat scroll 0 0 #EBEBEB;  border: 1px solid #D3D3D3; display: block; font-size: 10px; height: 175px; overflow: auto; width: 100%;" > 
                <!-- Contact Email list comes here --->
                </div>
                
                <br />
                <!-- <p ><i>Hint: Use the Ctrt or Shift keys to select multiple names</i> </p> -->
                <p><label class="boldlabel">2. Click the Add Recipients button to add the selected names as recipients</label></p>                    
                <span><br />
                    <button type="button"  id="addrecipients" class="button"><span>Add Recipients</span> </button>            
                </span>

            </td>
        </tr>
        
        <tr>
        <td><br />
        
        <p><label class="boldlabel">3. Selected for Invitations</label></p>
        <span class="txtArea_top">
            <span class="newtxtArea_bot">
                <?php echo $form->input("Event.selected_for_invitations", array('id' => 'selected_for_invitations', 'div' => false, 'label' => '','rows'=>'7','cols'=>'65','style' =>'width:230px;',"class" => "noBg",'value'=>$toid));?>
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
                    <?php echo $form->select("Event.email_template",$templatedropdown,$selectedtemplate,array('id' => 'templateid','class'=>'multilist'),"---Select---"); ?>
                    </div>
                </span>
                </span>&nbsp;&nbsp;&nbsp;
                <span>
                    <button type="button"  id="add_email_template" class="button"><span>Add</span> </button>            
                </span>
                </td>
            </tr>
        
         <tr>
           
        <td colspan="2">
        <br />
        <p><label class="boldlabel">5. Send Date and Time</label></p>
        
                <span class="intpSpan middle"><?php echo $form->text("Event.send_date_time", array('id' => 'send_date_time','value'=>'', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span>
                 <button type="button" class="ui-datepicker-trigger"><img src="/img/calendar_new.png" alt="..." title="..."></button>
                </td>
            </tr>
            
            <tr>
            <td colspan="2"><span>
                    <button type="button"  id="submit_event" class="button"><span>Submit</span> </button>            
                </span></td>
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
     var current_domain=$("#current_domain").val();
     var eventid=$("#eventid").val();
     
     $("#daily_div").hide();
     $("#montly_div").hide();
     $("#weekly_div").hide();
     $("#yearly_div").hide();
     
     
    
     if ($("#Daily").is(':checked')) 
     {
         $("#daily_div").show();
         $("#montly_div").hide();
        $("#weekly_div").hide();
        $("#yearly_div").hide();
        
     }
     else
     if ($("#Monthly").is(':checked')) 
     {
        $("#montly_div").show();
        $("#daily_div").hide();

         $("#weekly_div").hide();
         $("#yearly_div").hide();
     }
     else
     if ($("#Yearly").is(':checked')) 
     {
        $("#yearly_div").show();
         $("#daily_div").hide();
         $("#montly_div").hide();
         $("#weekly_div").hide();

     }
     else
     //if ($("#Weekly").is(':checked')) 
     {
        $("#weekly_div").show();
         $("#daily_div").hide();
         $("#montly_div").hide();   
         $("#yearly_div").hide();
     }
     
     
     
     $(".recur").click(function(){ 
                var set=$(this).val();
                //$('#recur_right_div').html("");
            /*    $('#recur_right_div').load('http://'+current_domain+'/admins/set_recur_flow/'+set,function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('#recur_right_div').fadeIn(1000); 

                    }); 
            
            $.post('http://'+current_domain+'/admins/set_recur_flow/'+set+'/'+eventid, function(data) {
              $('#recur_right_div').html(data);
              $("#eventcreate").serialize();
            });
            */
            //alert(set);
            if(set=="Daily")
            {               
                $("#weekly_div").hide();
                $("#montly_div").hide();
                $("#yearly_div").hide();
                $("#daily_div").show();
            }
            if(set=="Weekly")
            {               
                $("#daily_div").hide();
                $("#montly_div").hide();
                $("#yearly_div").hide();
                $("#weekly_div").show();
            }
            if(set=="Monthly")
            {               
                $("#weekly_div").hide();
                $("#daily_div").hide();
                $("#yearly_div").hide();
                $("#montly_div").show();
            }
            if(set=="Yearly")
            {               
                $("#weekly_div").hide();
                $("#montly_div").hide();
                $("#daily_div").hide();
                $("#yearly_div").show();
            }
            
     });
     
         
         
         
    }); 
</script>       



<script type="text/javascript">
     $(document).ready(function() { 
        // alert("dom");
        loadMemberEmails(); 
        var current_domain=$("#current_domain").val();
        
        $("#add_event_detail_page").click(function(){           
            window.open("http://"+current_domain+"/admins/addcontentpage/0","Add Content Page") 
        }); 
        
        $("#add_email_template").click(function(){           
            window.open("http://"+current_domain+"/admins/addmailtemplate/0","Add Email Page") 
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