<?php
		echo $javascript->link('fullcalendar.min');
	echo $html->css('fullcalendar');
		echo $html->css('fullcalendar.print');
 ?>
<script type='text/javascript'>

$(document).ready(function() {	

$('#OfferMnu').removeClass("butBg");
$('#OfferMnu').addClass("butBgSelt");
  
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

<?php //$pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
            	<h2>Calendar</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Offer", array("action" => "contactlist",'name' => 'contactlist', 'id' => "contactlist")) ?>
					<script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>
					<?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
            <?php /*?><?php if($usertype==trim("admin")){ ?>
			<?php  echo $this->renderElement('project_name');  ?> 
            <?php } ?>	
            <span style="padding-top:19px !important" class="titlTxt1">&nbsp;</span>	   
            <span class="titlTxt">Calendar</span><?php */?>
            
            <!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			
			</div>-->
            
        </div>
   
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="offers";    $this->subtabsel="calendar";
        if($_GET['url']==='offers/calendar/1'){
          echo $this->renderElement('offers_submenus'); 
        }
        else{        
         echo $this->renderElement('offersecondlevel_submenus'); } ?>   
    </div>
</div>

<div class="midCont">

<br /><br />
<div id='calendar' class="centerPage"></div>
  
</div>

<div class="clear"></div>
