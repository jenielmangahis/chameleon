<script type='text/javascript'>
$(document).ready(function() {	 
	$('#EventLst').removeClass("butBg");
	$('#EventLst').addClass("butBgSelt");
	
$('#calendar').fullCalendar({
        header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
        },
    events:[ <?php echo $json; ?> ] ,// this is where we call the php variable
    weekMode: 'variable'
    });
        
    });
</script>

<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container clearfix">
   <div class="titlCont">
   		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
                <h2>Calendar</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Admin", array("action" => "contactlist",'name' => 'contactlist', 'id' => "contactlist")) ?>
					<script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>
                </div>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <!--<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
            </div>
           <span class="titlTxt1" style="padding-top:18px;">Calendar</span>-->
        </div>
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="admins";    $this->subtabsel="calendar";
             echo $this->renderElement('events_submenus');  ?>
    </div>
</div>

<div class="midCont">

<br /><br />
<div id='calendar' style='width: 900px; margin: 0 auto;'></div>
  
</div>

<div class="clear"></div>
