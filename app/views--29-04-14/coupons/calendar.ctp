<?php  	
$base_url= Configure::read('App.base_url');
$csvUrl = $base_url.'coupons/download_coupon_list/current';
?> 
<?php
	echo $javascript->link('fullcalendar.min');
	echo $html->css('fullcalendar');
	echo $html->css('fullcalendar.print');
 ?>
<script type='text/javascript'>

$(document).ready(function() {	
$('#CouponMenu').removeClass("butBg");
$('#CouponMenu').addClass("butBgSelt");

  
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

<!-- Body Panel starts -->
<div class="container">

   <div class="titlCont">
   <div class="myclass">

			<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			
<?php  echo $this->renderElement('new_slider');  ?>			
</div>
            <span class="titlTxt1" style="padding-top:18px;"> Coupon Calendar  </span>
          
          <?php    $this->loginarea="coupons";    $this->subtabsel="calendar";
             echo $this->renderElement('coupons_submenus');  ?>    
        </div>
        </div>


<div class="midCont">

<br /><br />
<div id='calendar' class="centerPage"></div>
  
</div>

<div class="clear"></div>
