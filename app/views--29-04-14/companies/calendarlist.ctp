<script type='text/javascript'>

$(document).ready(function() {

$('#calendar').fullCalendar({

    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
        },
    events:[ <?php echo $json; ?> ], // this is where we call the php variable
    weekMode: 'variable'
    });
        
    });
</script>

<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
  <div class="container">
<div class="titlCont"><div class="myclass">

<div align="center" class="slider" id="toppanel">
     <?php  echo $this->renderElement('new_slider');  ?>

</div>
               <?php echo $form->create("Company", array("action" => "eventlist",'name' => 'eventlist', 'id' => "eventlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
<span class="titlTxt">  Events</span>
<div class="topTabs">
<ul class="dropdown">
<li><a href="/companies/eventcreate"><span>New</span></a></li>   
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
                       <li><a href="javascript:void(0)" onclick="invitetoevent();" id="linkinvite">Invite</a></li>  
                        <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                     <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
                </ul>
</li>
 <li><a href="javascript:void(0)" onclick="editevent();" id="linkedit"><span>Edit</span></a></li>         
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both;">
<ul class="topTabs2">
<li><a href="/companies/eventlist" ><span>Current Events</span></a></li>    
                <li><a href="/companies/pasteventlist" ><span>Past Events</span></a></li>
                  <li><a href="/companies/calendarlist" class="tabSelt"><span>Calendar</span></a></li>    
                  <li><a href="/companies/eventautoresponders"  ><span>AutoResponse</span></a></li>  
                  <li><a href="/companies/event_pages/detail"><span>Event Pages</span></a></li>    
                  <li><a href="/companies/event_pages/sponsor"><span>Sponsor Pages</span></a></li>    
                  <li><a href="/companies/event_pages/inquiry"><span>Inquiry Pages</span></a></li>    
                  <li><a href="/companies/event_types" ><span>Types</span></a></li>  

 
</div>
<div class="clear"></div>

</div>
</div>
<div class="midCont">

<br /><br />
<div id='calendar' style='width: 900px; margin: 0 auto;'></div>    
    
</div>

<div class="clear"></div>
