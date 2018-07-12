
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
<?php
   echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
   echo $html->css('/css/jquery_ui_datepicker');
   echo $html->css('timepicker_plug/css/style');
?>
<script type="text/javascript">
            /* <![CDATA[ */
            var dateobj = new Date();
            var currDate  = dateobj.getFullYear();
            $(function() {
                $('#birthday').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    yearRange: '1890:'+ currDate
                });
            });
            /* ]]> */
        </script>
<script type="text/javascript">
$(document).ready(function() {
$('#LinkMnu').removeClass("butBg");
$('#LinkMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/donation';
?>
<?php
	
</script>
<?php 
	$editLink = "edit_donation/".$id;
?>

<div class="container"> 
<div class="titlCont">
<div class="myclass">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
<?php echo $form->create("admins", array("action" => $editLink,'name' => 'add_donations', 'id' => "add_donation", 'class' => 'adduser'));
     ?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png', array('alt' => 'Save'))); ?></button>

<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png', array('alt' => 'Apply'))); ?> </button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?>
</button>
	<?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt">Edit Donation type</span>
<div class="topTabs" style="height:25px;">
<?php /*?><ul class="dropdown">
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

</ul><?php */?>
</div> 
<?php    $this->loginarea="links";    $this->subtabsel="activelinklist";
            echo $this->renderElement('donation_submenus');  ?>
<div class="clear"></div>
<?php $this->mail_tasks="tabSelt"; ?>   
</div>

</div>
<div class="midPadd" id="addcmp">

<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          

<br />

<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
<table cellspacing="0" cellpadding="0" align="left" width="100%">
	<tbody>
		<tr>
			<td width="50%" valign="top">
				<table cellspacing="10" cellpadding="0" align="left" width="100%">
					<tbody>
					
					<tr>
							<td align="right"><label class="boldlabel">Donation Source<span
									style="color: red;">*</span>
							</label></td>
							<td><?php 
						$options=array('Individual'=>'Individual','Company'=>'Company');
						$attributes=array('legend'=>false,'class'=>'donationsource','readonly'=>'true');
						echo $form->radio('Donation.donationsource',$options,$attributes);
						?>
							</td>
						</tr>
						<tr>
							<td align="right"><label class="boldlabel">Donation Name<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="intpSpan" style="vertical-align: top"> 
							<?php echo $form->input("Donation.donationname", array('id' => 'note', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?>
							</span>
							</td>
						</tr>
						<tr>
                 <td align="right"><label class="boldlabel"> Donator Company <span class="red">*</span></label></td>
                  <td ><label for="project_name"></label>
                    <span class="txtArea_top"><span class="txtArea_bot">
                   
			  <?php 
			  
			  $donationcmp= $this->data['Donation']['donatorcompany']; ?>
<select onchange="getcompanyaddress(this.value);" class="multilist" id="company_id" name="data[Donation][donatorcompany]">
<option value="">---Select---</option>
<?php

foreach($selectedcompany as $c_name){
?>

<option value="<?php echo $c_name['Company']['company_name']; ?>" <?php if($c_name['Company']['company_name']===$donationcmp){ echo "selected";}?>><?php echo $c_name['Company']['company_name']; ?></option>

<?php
}
?>

</select>
</span></span> </td>
 <td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
 </tr>

<tr id="row_startdate" >
						<td align="right"><label class="boldlabel"> Donator Date<span class="red">*</span></label></td>
						
						<td><span class="intpSpan" style="vertical-align: top"> 
							<?php echo $form->text("Donation.created", array('id' => 'birthday', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?>
							</span>
							</td>
					</tr>		
		
						
						<tr>
						<?php 
			  
			  $donationtype= $this->data['Donation']['donationtype']; ?>
							<td align="right"><label class="boldlabel">Donation Type<span style="color: red;">*</span>
							</label></td>
							
							
							<td> <span class="txtArea_top"><span class="txtArea_bot">
							
<select class="multilist" id="company_id" name="data[Donation][donationtype]">
<option value="">---Select---</option>
<?php

foreach($selectedtype as $t_name){
?>

<option value="<?php echo $t_name['DonationType']['type']; ?>" <?php if($t_name['DonationType']['type']===$donationtype){ echo "selected";}?>><?php echo $t_name['DonationType']['type']; ?></option>

<?php
}
?>

</select></span>
							</span>
							</td>
						</tr>
						
						<tr>
							<td align="right"><label class="boldlabel">Donation Amount<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="intpSpan" style="vertical-align: top"> 
							<?php echo $form->input("Donation.donationammount", array('id' => 'note', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?>
							</span>
							</td>
						</tr>
						<tr>
							<td align="right"><label class="boldlabel">Related Event<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="intpSpan" style="vertical-align: top"> 
							<?php echo $form->input("Donation.relatedevent", array('id' => 'note', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?>
							</span>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		
						</tr>

					

		
		
	</tbody>
</table>
<?php 
$baseUrl = Configure::read('App.base_url'); 
?>
<script type="text/javascript" src="<?php echo $baseUrl;?>js/ZeroClipboard.js"></script>
<script type="text/javascript">
    function getsource1() {
		
		var linkRedirect = document.getElementById("redirect_link").value;
		var e = document.getElementById("link_address");
		var strUser = e.options[e.selectedIndex].text;
		var gettext =   Date.now();
		var text = document.getElementById("visual_text").value;
		var vtext = text;
		if(linkRedirect==''&&strUser=='--Select--')
		{
			alert('Please select Link Address or enter Link Redirect');
			return false;
		}
		if(text=='')
		{
			alert('Please enter visual text');
			return false;
		}
		if(linkRedirect!='')
		{
			if(!(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(linkRedirect)))
			{
				alert('Please enter valid Link Redirect');
				return false;
			}
		}
		copysortcode();

		text   = text.replace(/ /g,"_");
        var code = "{@_@}="+text+'_'+gettext+"={@_@}";
		$('#created_link').removeAttr("readonly");
        document.getElementById("created_link").value = code;
		$('#created_link').attr("readonly");

		$('#html_sortcode').removeAttr("readonly");
		
		var aredirect = strUser;
		if(linkRedirect!=''){aredirect=linkRedirect;}
		
		var typeSurvey = document.getElementById("survey").value;
		if(typeSurvey =="Email")
		{
			var fcode = '<img src="'+baseUrl+'links/add_history/'+vtext+'/email" />';
			var str_html_code = '<a target=\"_blank\" href=\"'+aredirect+'\">'+vtext+'</a>';
			str_html_code += fcode;
		}
		else if(typeSurvey =="PDF")
		{
			aredirect = baseUrl+'links/add_history/'+vtext+'/pdf';
			var str_html_code = '<a href=\"'+aredirect+'\">'+vtext+'</a>';	
			$('#spanHtmlSort1').html('');
			$('#spanHtmlSort1').append(str_html_code);
		}
		else if(typeSurvey =="other")
		{
			aredirect = baseUrl+'links/add_history/'+encodeURIComponent(vtext)+'/other';
			var str_html_code = aredirect;	
			$('#spanHtmlSort1').html('');
			$('#spanHtmlSort1').text(str_html_code);
		}	
		else
		{
			var fcode = 'function saveClickInfo(str){var currentUrl = window.location.href; var urlToSend = "'+baseUrl+'links/add_history/"+str;$.ajax({type: "POST",url: urlToSend, data:{passUrl:currentUrl},success:  function(data){}});}';
			var str_html_code = '<a onclick=\"saveClickInfo(\''+vtext+'\')\" target=\"_blank\" href=\"'+aredirect+'\">'+vtext+'</a>';
			str_html_code += '<script  src=\"http://code.jquery.com/jquery-1.10.1.min.js\"><\/script>';
			str_html_code += '<script type=\"text/javascript\">';
			str_html_code += fcode;
			str_html_code += '<\/script>';
		}	
  		$('#html_sortcode').val(str_html_code);					
		$('#html_sortcode').attr("readonly");
		if(typeSurvey.trim() !="PDF" && typeSurvey.trim() != "other")
		{	
			$('#btn1').css('display','none');
			$('#btn2').css('display','block');
			$('#btn2').removeAttr('style');
		}
		if($('#ZeroClipboardMovie_1').length)
    	{
    		$('#ZeroClipboardMovie_1').css('display','none');	
    	}	
    }
</script>
<script type="text/javascript">
/* <![CDATA[ */
var dateobj = new Date();

$(function() {

	$('#startdateBP').datetime({
		userLang : 'en',
		americanMode: false, 
	});
	
	$('#enddateBP').datetime({
		userLang : 'en',
		americanMode: false, 
	});
		
	$('#member_agefrom').datepicker({
		showOn: "button",
		buttonImage: baseUrl+"/img/calendar_new.png",
		dateFormat: 'mm-dd-yy',
		changeMonth: true,
		changeYear:true 
	});
	
	$('#member_ageto').datepicker({
		showOn: "button",
		buttonImage: baseUrl+"/img/calendar_new.png",
		dateFormat: 'mm-dd-yy',
		changeMonth: true,
		changeYear:true 
	});
	
	
	$('#startdate').datepicker({
		showOn: "button",
		buttonImage: baseUrl+"/img/calendar_new.png",
		dateFormat: 'mm-dd-yy',
		changeMonth: true,
		changeYear:true 
	});
	
	$('#enddate').datepicker({
		showOn: "button",
		buttonImage: baseUrl+"/img/calendar_new.png",
		dateFormat: 'mm-dd-yy',
		changeMonth: true,
		changeYear:true
	});
});
/* ]]> */
 
 
 function addaddresslink() {   
             $('#email_template_id').focus();
//             var resWindow=  window.open (baseUrl+'links/add_address');
//             resWindow.focus();
 				window.location = baseUrl+'links/add_address/@<?php echo $id;?>';

           }


function addgrouplink() {   
             $('#email_template_id').focus();
             //var resWindow=  window.open (baseUrl+'links/add_group');
             //resWindow.focus();
             window.location = baseUrl+'links/add_group/@<?php echo $id;?>';
           }
		   
function addplacementlink() {   
             $('#email_template_id').focus();
             //var resWindow=  window.open (baseUrl+'links/add_placement');
             //resWindow.focus();
             window.location = baseUrl+'links/add_placement/@<?php echo $id;?>';
           }

function addforum() {   
             $('#email_template_id').focus();
             //var resWindow=  window.open (baseUrl+'admins/formtype_add');
             //resWindow.focus();
             window.location = baseUrl+'admins/formtype_add/rl:@<?php echo $id;?>';
           }			   		   
		 
function getEmailTemplate(la)
{
	var typeSurvey = document.getElementById("survey").value;
	if(typeSurvey.trim() =="PDF" ||typeSurvey.trim() == "other")
	{
		$('#txtHtmlSort').css('display','none');
		$('#spanHtmlSort').css('display','block');
	}	
	else
	{
		$('#spanHtmlSort').css('display','none');
		$('#txtHtmlSort').css('display','block');
	}	

	$('#btn2').css('display','none');
	$('#btn1').css('display','block');
	if($('#ZeroClipboardMovie_1').length)
    {
    	$('#ZeroClipboardMovie_1').css('display','none');	
    }	
    $('#btn1').removeAttr('style');



}		   	


function copysortcode()
{

		var fieldNameTemp ="html_sortcode";
        var buttonNameTemp ="copysort";
        var val = "";
        try{
            val = navigator.userAgent.toLowerCase();
        }catch(e){}
        var swfurl = baseUrl+"js/ZeroClipboard.swf";
        setTimeout(function () {
            ZeroClipboard.setMoviePath(swfurl);
            var clip = new ZeroClipboard.Client();
            clip.addEventListener('mousedown', function () {
            	clip.setText(document.getElementById(fieldNameTemp).value);	
            });
            clip.addEventListener('complete', function (client, text) {
            	$("#html_sortcode").focus();
        		$("#html_sortcode").select();
        		$('#btn2').css('display','none');
        		$('#btn1').css('display','block');
        		if($('#ZeroClipboardMovie_1').length)
        		{
        			$('#ZeroClipboardMovie_1').css('display','none');	
        		}	
        		$('#btn1').removeAttr('style');

            });
            clip.glue(buttonNameTemp);
        }, 2000);
}		
</script>
</div>

<div class="clear"></div>
</div>
<div id="showtaskreport" title="Task Report" style=" display: none;">          
    <p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
<div class="clear"></div>
</div>
<?php echo $form->end(); ?> 
<!--inner-container ends here-->
<!--container ends here-->
