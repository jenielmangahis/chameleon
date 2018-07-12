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
   <div class="myclass">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("Offer", array("action" => "contactlist",'name' => 'contactlist', 'id' => "contactlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
<?php if($usertype==trim("admin")){ ?>
           <?php  echo $this->renderElement('project_name');  ?> 
<?php } ?>		   
            <span class="titlTxt">Calendar</span>

           
          <?php    $this->loginarea="offers";    $this->subtabsel="calendar";
             echo $this->renderElement('offers_submenus');  ?>    

        </div>
        </div>


<div class="midCont">

<br /><br />
<div id='calendar' class="centerPage"></div>
  
</div>

<div class="clear"></div>
