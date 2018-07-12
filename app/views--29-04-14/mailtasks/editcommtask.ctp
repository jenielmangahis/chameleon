<script type="text/javascript">
$(document).ready(function() {
$('#EmailMnu').removeClass("butBg");
$('#EmailMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'mailtasks/mailtask_list';
?>
<?php
echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');  
echo $html->css('/css/jquery_ui_datepicker');
echo $html->css('timepicker_plug/css/style');
?>
<!--<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">-->
<script type="text/javascript">
/* <![CDATA[ */
$(function() {
$('#startdateBP').datetime({
userLang : 'en',
americanMode: false, 
});
$('#enddateBP').datetime({
userLang : 'en',
americanMode: false, 
});
});


var dateobj = new Date();

$(function() {

$('#member_agefrom').datepicker({
showOn: "button",
buttonImage: baseUrl+"/img/calendar_new.png",
dateFormat: 'mm-dd-yy',
changeMonth: true,
changeYear:true
// yearRange: currDate+':'+rangeDate 
});

$('#member_ageto').datepicker({
showOn: "button",
buttonImage: baseUrl+"/img/calendar_new.png",
dateFormat: 'mm-dd-yy',
changeMonth: true,
changeYear:true
//  yearRange: currDate+':'+rangeDate 
});


$('#task_startdate').datepicker({
showOn: "button",
buttonImage: baseUrl+"/img/calendar_new.png",
dateFormat: 'mm-dd-yy',
changeMonth: true,
changeYear:true
// yearRange: currDate+':'+rangeDate 
});

$('#task_end_by_date').datepicker({
showOn: "button",
buttonImage: baseUrl+"/img/calendar_new.png",
dateFormat: 'mm-dd-yy',
changeMonth: true,
changeYear:true
//  yearRange: currDate+':'+rangeDate 
});

});
/* ]]> */

</script>
<?php echo $form->create("mailtasks", array("action" => "addcommtask",'name' => 'addcommtask', 'id' => "addcommtask", 'class' => 'adduser'))?>
<div class="container"> 
<div class="titlCont">


<div class="myclass">
<div align="center" id="toppanel" >
	<?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt">Mail Tasks </span>
<div class="topTabs">
<ul class="dropdown">
<li>
<button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"> <span> Save </span>	</button>
</li>
<li>
<button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span> </button>
</li>
<li>
<button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span>
</button>
</li>

</ul>
</div> 
<div class="clear"></div>
<?php $this->mail_tasks="tabSelt"; ?>   
</div>

</div>
<div class="midPadd" id="sndmail">
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          



<!--<table id="loading"  width="100%" style="height: 100%;"><tr style="height: 540px;" ><td align="center"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></td></tr></table> --><br />
<table class="tbltemptpye">
	<tr>
	<td align="right"><label class="boldlabel">Template Type <span class="red">*</span></label></td>	
	<td valign="top">
	<span class="txtArea_top"><span class="txtArea_bot"><span id="compdiv">	
	<?php echo $form->select("CommunicationTask.email_template_type",$templatetypedropdown,$selectedtemplatetype, array('id' => 'email_template_type', 'div' => false, 'label' => '',"class" =>"multilist","maxlength" => "250"),"---Select---"); ?>
	</span></span></span>
	</td>
	</tr>
</table>


<div id="addcomm"></div>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<?php echo $form->end(); ?> 
<!--inner-container ends here-->
<!--container ends here-->
<script>
function addEmailTempforTask() {   
$('#email_template_id').focus();
var resWindow=  window.open (baseUrl+'mailtasks/addsupermailcontent');
//resWindow.focus();
}
</script>


<script type="text/javascript">
		$url= baseUrl+'mailtasks/mail_task_member/';
		$(function(){
			ajax_call();
		});
		
		$('#email_template_type').live('change',function(){	
			ajax_call();
		});
		
		function ajax_call(){

			switch($('#email_template_type').val())
			{
				case '0':
						$url = baseUrl+'mailtasks/mail_task_member/';
						break;
				case '1':
						$url = baseUrl+'mailtasks/mail_task_player/';
						break;
				case '2':
						$url = baseUrl+'mailtasks/mail_task_prospect/';
						break;
				case '3':
						$url = baseUrl+'mailtasks/mail_task_offer/';
						break;
			}
			
			$.ajax({
				 type: "GET",
				 url: $url,
				 cache: false,
				 datatype:'html',
				 success: function(responsehtml){
						$('#addcomm').html(responsehtml);
				 }
			});
		}
		
</script>

