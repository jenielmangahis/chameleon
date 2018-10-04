
<script type="text/javascript">
$(document).ready(function() {
$('#LinkMnu').removeClass("butBg");
$('#LinkMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'links/activelinklist';
?>
<?php
echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');  
echo $html->css('/css/jquery_ui_datepicker');
echo $html->css('timepicker_plug/css/style');
echo $html->css('timepicker_plug/css/style');

	$defaultSTime = $oldData['Link']['stime'];
	$defaultETime = $oldData['Link']['etime'];
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
        if(trim($defaultSTime)==trim($convertval)){    
            $sel_st='selected="selected"';
        }
         $sel_et='';   
        if(trim($defaultETime)==trim($convertval)){    
            $sel_et='selected="selected"';
        }
     //   echo "<br/> ".$i." -- > ".$convertshow." -->".$convertval;
    	$option_stime.='<option value="'.$convertval.'" '.$sel_st.'>'.$convertshow.'</option>'; 
	  	$option_etime.='<option value="'.$convertval.'" '.$sel_et.'>'.$convertshow.'</option>'; 
        $timeopt[$convertval]  = $convertshow;    
        $stime  =  strtotime("+30 minutes", $stime);        
    }
	
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
changeYear:true,
//yearRange:-90:+20   
// yearRange: currDate+':'+rangeDate 
});

$('#member_ageto').datepicker({
showOn: "button",
buttonImage: baseUrl+"/img/calendar_new.png",
dateFormat: 'mm-dd-yy',
changeMonth: true,
changeYear:true,
 
//  yearRange: currDate+':'+rangeDate 
});


$('#startdate').datepicker({
showOn: "button",
buttonImage: baseUrl+"/img/calendar_new.png",
dateFormat: 'mm-dd-yy',
changeMonth: true,
changeYear:true,

// yearRange: currDate+':'+rangeDate 
});

$('#enddate').datepicker({
showOn: "button",
buttonImage: baseUrl+"/img/calendar_new.png",
dateFormat: 'mm-dd-yy',
changeMonth: true,
changeYear:true,

//  yearRange: currDate+':'+rangeDate 
});

});
/* ]]> */

$('#btn_relate_to_comment').live('click',function(){
	alert('123');
	//addCommentTypeforTask();
});

</script>
<?php 
	$editLink = "editlink/".$id;
?>

<div class="container"> 
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-4">
                <h2>Edit Link</h2>
            </div>
            <div class="slider-dashboard col-sm-8">
            	<div class="icon-container">
                	<?php echo $form->create("links", array("action" => $editLink,'name' => 'addlink', 'id' => "addlink", 'class' => 'adduser'));
					?>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png')); ?>	</button>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
					</button>
					<?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
        </div>
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="links";    $this->subtabsel="activelinklist";
				 echo $this->renderElement('links_submenus');  ?> 
		<div class="clear"></div>
		<?php $this->mail_tasks="tabSelt"; ?>   
    </div>
</div> 

<div class="midCont clearfix" id="addcmp">

<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          

<br />

<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
<table cellspacing="0" cellpadding="0" align="left" width="90%">
	<tbody>
		<tr>
			<td width="50%" valign="top">
				<table cellspacing="10" cellpadding="0" align="left" width="100%">
					<tbody>
					
					

<tr>
	<td align="right">
		<input type="hidden" id="current_domain" name="current_domain" value="">
		<?php echo $form->input("Link.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
		
		<label class="boldlabel">Link Name <span style="color: red;">*</span>
		</label>
	</td>
	<td>
	<span class="intp-Span"><?php echo $form->input("Link.links_name", array('id' => 'links_name', 'div' => false, 'label' => '','style' =>'width:231px;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
	</span>
	</td>
</tr>
						

<tr>
<td align="right">
<label class="boldlabel">Link Group<span
style="color: red;">*</span>
</label></td>
<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php 
if(isset($InsertGroupId))
{
	$gselected = $InsertGroupId;
}
else
{
	$gselected = $oldData['Link']['linkgroup'];
}
echo $form->select("Link.linkgroup",$groupdata,$gselected,array('id' => 'linkgroup','class'=>'multi-list form-control','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>
</span>
</span>
<span class="btn-Lft"><input type="button" class="btn-Rht btn btn-primary btn-sm"
									value="Add" name="Add" onclick="addgrouplink();" />
							</span>

 </td>
</tr>




<tr>
<td align="right"><label class="boldlabel">Link Placement<span
style="color: red;">*</span>
</label></td>
<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php 
if(isset($InsertPlacementId))
{
	$lpselected = $InsertPlacementId;
}
else
{
	$lpselected = $oldData['Link']['link_placement'];
}
//$option = array('Brochure'=>'Brochure' ,'Emails'=>'Emails', 'SMS'=>'SMS', 'Web_Page'=>'Web Page' , 'Video'=>'Video');
echo $form->select("Link.link_placement",$placementdata,$lpselected,array('id' => 'link_placement','class'=>'multi-list form-control','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>
</span>
</span> 
<span class="btn-Lft"><input type="button" class="btn-Rht btn btn-primary btn-sm"
									value="Add" name="Add" onclick="addplacementlink();" />
							</span>
</td>
</tr>


<tr> 
<td align="right"><label class="boldlabel">Link Address<span style="color: red;">*</span>
</label></td>
<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php 
//$option = array('test'=>'test', 'testone'=>'testone', 'testthree'=>'testthree');
if(isset($InsertLinkAddressId))
{
	$laselected = $InsertLinkAddressId;
}
else
{
	$laselected = $oldData['Link']['link_address'];
}
echo $form->select("Link.link_address",$addressdata,$laselected,array('id' => 'link_address','class'=>'multi-list form-control','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>
								</span>
							</span> 
							<span class="btn-Lft"><input type="button" class="btn-Rht btn btn-primary btn-sm"
									value="Add" name="Add" onclick="addaddresslink();" />
							</span>
							</td>
						</tr>
						
<tr> 
	<td align="right"><label class="boldlabel">Related Form
							</label></td>
							<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php 
				if(isset($InsertRelatedFormId))
				{	
					$lrselected = $InsertRelatedFormId;
				}
				else
				{
					$lrselected = $oldData['Link']['related_form'];
				}			
			echo $form->select("Link.related_form",$formtypedata,$lrselected,array('id' => 'related_form','class'=>'multi-list form-control','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>
								</span>
							</span>
							<span class="btn-Lft">
							<input type="button" class="btn-Rht btn btn-primary btn-sm"
									value="Add" name="Add" onclick="addforum();" />
							</span>
							</td>
						</tr>
						
<tr> 
	<td align="right"><label class="boldlabel">Related Survey<span
									style="color: red;">*</span>
							</label></td>
							<td>
							
							<span class="txtArea-top"> <span class="txtArea-bot"> 
<?php
$option = array('Email'=>'Email' ,'Web_Page'=>'Web Page','PDF'=>'PDF','other'=>'Others');
$rsselected = $oldData['Link']['survey'];	
echo $form->select("Link.survey",$option,$rsselected,array('id' => 'survey','class'=>'multi-list form-control','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>

</span>
	</span> </td>
	</tr>						
											
						<tr>
							<td align="right"><label class="boldlabel">Enter Visual Text<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="intp-Span" style="vertical-align: top"> <?php echo $form->input("Link.visual_text", array('id' => 'visual_text', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control"));?>
							</span>
							</td>
						</tr>
						
						
						<tr>
							<td align="right"><label class="boldlabel">Created Link<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="intp-Span" style="vertical-align: top"> <?php echo $form->input("Link.created_link", array('id' => 'created_link', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control",'readonly' =>'readonly'));?>
							</span>
							<span class="btn-Lft" id="btn1">
							<input type="button" value="Update link" class="btn-Rht btn btn-primary btn-sm"
									value="Add" name="Getsource"  onclick="getsource1();" />
							</span>

							<span class="btn-Lft" style="display:none;" id="btn2">
							<input type="button" value="Copy" class="btn-Rht btn btn-primary btn-sm"
									 name="copysort" onclick="copysortcode();" id="copysort" />
							</span>
							</td>
						</tr>

						<tr>
							<td align="right" width="140px"><label class="boldlabel">Html Sort Code</label>
							</td>
							<td>
							<span class="txtArea-top" id="txtHtmlSort"> <span class="txtArea-bot"><?php echo $form->input("Link.html_sortcode", array('id' => 'html_sortcode', 'div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg form-control noBg form-controlNew','readonly' => 'readonly'));?>
								</span>
							</span>
							<p id="spanHtmlSort" style="display:none;">
									<span id="spanHtmlSort1"></span>
									<span id="spanHtmlMsg"><br/>Please copy this text and paste in the ms-doc and save in the pdf format. </span>
							</p>	

						</td>
						</tr>
						
								
						<tr>
							<td align="right"><label class="boldlabel">Link Redirect
							</label></td>
							<td><span class="intp-Span" style="vertical-align: top"> <?php echo $form->input("Link.redirect_link", array('id' => 'redirect_link', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control"));?>
							</span>
							</td>
						</tr>						
					
						<tr>
							<td align="right" width="140px"><label class="boldlabel">Start Date
							</label>
							</td>
							<td><span class="intp-Span"><?php
					if($this->data['Link']['startdate']!=""){
							$startdate= $this->data['Link']['startdate'];
					}else{
						   $startdate= date('m-d-Y');
					}
		   echo $form->text("Link.startdate", array('id' => 'startdate', 'div' => false, 'label' => '',"class"=>"inpt-txt-fld form-control","maxlength" => "200","style" => "width:231px", 'value'=>$startdate,'readonly'=>'readonly'));?>
							</span></td>
						</tr>



		<tr>
        <td>
        <div class="updat">
        <label class="boldlabel">Start Time <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
                                      <span class="txtArea-top">
                    <span class="txtArea-bot">        <select id="stime" name="data[Link][stime]" class="noBg form-control" style="width: 230px; margin-bottom: 7px;"> 
                    <?php echo $option_stime; ?>
                    </select>
                   
                </span>
                </span>
               </td>
            </tr>
 							<tr>
							<td align="right" width="140px"><label class="boldlabel">End Date
							</label>
							</td>
							<td><span class="intp-Span"><?php
					if($this->data['Link']['startdate']!=""){
							$startdate= $this->data['Link']['startdate'];
					}else{
						   $startdate= date('m-d-Y');
					}
		 echo $form->text("Link.enddate", array('id' => 'enddate', 'div' => false, 'label' => '',"class"=>"inpt-txt-fld form-control","maxlength" => "200","style" => "width:231px",'readonly'=>'readonly'));?>
							</span></td>
						</tr>

				 <tr>
        <td>
        <div class="updat">
        <label class="boldlabel">End Time <span style="color: red;">*</span></label>
        </div>
        </td>
            <td>
                  <span class="txtArea-top">
                    <span class="txtArea-bot">
                    <select id="etime" name="data[Link][etime]" class="noBg form-control" style="width: 230px; margin-bottom: 7px;">
                    <?php echo $option_etime; ?> 
                    </select>
                  
                </span>
                </span></td>
            </tr>   
						


<tr>
       <td>
       <div class="updat">
        <label class="boldlabel">Recur Pattern</label>
        </div>
        </td>
        <td>                            
                  <span class="txtArea-top">
        <span class="txtArea-bot">
            <span id="countrydiv">
                <?php echo $form->select("Link.recur_pattern",$recur_pattern,null,array('id' => 'recur_pattern',"class"=>"multi-list form-control"),"None"); ?></span></span></span>
             </td>
        </tr>



	<tr>
							<td align="right" width="140px"><label class="boldlabel">Discription</label>
							</td>
							<td><span class="txtArea-top"> <span class="txtArea-bot"><?php echo $form->input("Link.discription", array('id' => 'discription', 'div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg form-control'));?>
								</span>
							</span></td>
						</tr>
								
		
<tr>
<td align="right">
<label class="boldlabel">Status<span
style="color: red;">*</span>
</label></td>
<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php 
$sselected = $oldData['Link']['status'];
$option = array('a'=>'Active', 'd'=>'Deactive');
echo $form->select("Link.status",$option,$sselected,array('id' => 'status','class'=>'multi-list form-control'),array('0'=>'--Select--')); ?>
</span>
</span> </td>
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
