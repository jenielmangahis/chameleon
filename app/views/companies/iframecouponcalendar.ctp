<?php
    echo $html->css('fullcalendar.css','stylesheet');
    echo $html->css('fullcalendar.print.css','stylesheet', array('media'=>'print'));
    echo $javascript->link('jquery-1.5.2.min.js');
    echo $javascript->link('jquery-ui-1.8.11.custom.min.js');
    echo $javascript->link('fullcalendar.min.js');    
    echo $javascript->link('jquery.blockUI.js');
?>
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
<div class="boxBg1">
  <p class="boxTop1">
  <div class="boxBor1">
  <div class="boxPad">    
	<br /><br />
	<div id='calendar' class="centerPage" ></div>       
  </div>
  </div>
  </div>

