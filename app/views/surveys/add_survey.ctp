<script type="text/javascript">
	$(document).ready(function() {
		$('#SurveyMnu').removeClass("butBg");
		$('#SurveyMnu').addClass("butBgSelt");

		var clip1 = null;
		$(function() {
			clip1 = new ZeroClipboard.Client();
			clip1.addEventListener('mousedown',function() {
  				clip1.setText(document.getElementById('codeval').value);
				$("#codeval").focus().select();
			});
			clip1.glue('d_clip_button'); 
		});
		$("#ZeroClipboardMovie_1").live("click",function(){
			$("#codeval").focus().select();
		});
	}); 
</script> 
<?php
	echo $javascript->link('colorpicker/js/eye.js');
	echo $javascript->link('colorpicker/js/colorpicker.js');
	echo $javascript->link('colorpicker/js/utils.js');
	echo $html->css('colorpicker/colorpicker.css');
	$lgrt = $session->read('newsortingby');
	$base_url = Configure::read('App.base_url').'surveys/survey_history';
	echo $javascript->link('ZeroClipboard');
?>   
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-4">
            <h2>Survey Add/Edit</h2>
        </div>
        <div class="slider-dashboard col-sm-8">
        	<div class="icon-container">
            	<?php echo $form->create("Survey", array("action" => "add_survey", "onsubmit"=>"return validate_survey();" ));
				echo $form->hidden("Survey.id"); ?>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
				<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url ?>')"><?php e($html->image('cancle.png')); ?></button>
				<?php echo $this->renderElement('new_slider');   ?>
            </div>
        </div>
    </div>

</div>
<!--titlCont1 ends here-->

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="surveys";    $this->subtabsel="survey_history";
             echo $this->renderElement('survey_submenus');  ?>  
    </div>
</div> 

<!--inner-container starts here-->
<div class="midCont">
        <div class="clearfix add_survery">
        	<div class="frmbox">
            	<table  width="90%">
                	<tbody>
                            	<tr>
                                	<td width="16%" style="padding-bottom: 12px;">
                                		<label class="boldlabel">Survey Name<span style="color: red;">*</span>
                                		</label>
                                	</td>
                                    <td width="24%" align="left">
                                    	<span class="intp-Span">
                                    		<?php echo $form->input("Survey.survey_name", array("class" => "inpt-txt-fld form-control","maxlength" => "200",'label'=>false));?>
                                    	</span>
                                    </td> 
                                    
                                    <?php if(isset($this->data['Survey']['created'])){ ?> 
                                   <td width="30%" align="right" valign="top" style="padding-top: 2px;">
                                    	<label class="boldlabel">Created Date </label>
                                    </td>  
                                    <td align="left" valign="top">
                                        <span class="intp-Span">
                                        	<?php echo $form->input("Survey.createddate", array("class" => "inpt-txt-fld form-control","maxlength" => "200", 'value'=>date("m-d-Y", strtotime($this->data['Survey']['created'])),'label'=>false));?>
                                       	</span>
                                    </td> 
                                   <?php }else{ ?>
                                       
                                  <?php } ?>   
                                </tr> 
                                <tr>
                                    <td colspan="6"><?php if($session->check('Message.flash')){ $session->flash(); } ?></td>
                                </tr>
                                <tr valign="top" >
                                    <td  colspan="4">
                                        <label>Background Color</label>
                                        # <span class="intp-Span"><?php echo $form->input('Survey.bgcolor',array('class'=>'inpt-txt-fld1 form-control','div'=>false,'label'=>false,'value'=>'FFFFFF')); ?></span>
                                        <label >Text Color</label>
                                        # <span class="intp-Span"><?php echo $form->input('Survey.textcolor',array('class'=>'inpt-txt-fld1 form-control','div'=>false,'label'=>false,'value'=>'000000')); ?></span>
                                    </td>
                                    
                                </tr>
                              
                            </tbody>    
			 				</table>
            </div>
        
            <div class="frmbox2">	
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>       
                <div class="clear"></div>
                <table  cellpadding="5" cellspacing="8" align="center">
                    <tbody>
                    <tr>
                         <td width="1%"  align="left" valign="top"> <label class="boldlabel">Include</label></td>
                         <td width="1%"  align="left" valign="top"> <label class="boldlabel">Required</label></td>  
                         <td  align="left" valign="top">&nbsp; </td>
                         <td width="1%" align="left" valign="top"> <label class="boldlabel">Text</label></span></td>
                         <td width="1%" align="left" valign="top"> <label class="boldlabel">List</label></span></td>
                         <td  align="left" valign="top">&nbsp; </td>  
                    </tr>
                    <?php for($i=0; $i<6 ; $i++ ){                   	?>
                    <tr  valign="top">
                            <td  align="center" >
                             <?php $options = array('value' => '1'); 
                             	   //$selected = array(($this->data['SurveyQuestion']['0']['include'])? 1 : 0 );  
                             	   $selected= array(1);
                             	   echo $form->checkbox('SurveyQuestion.'.$i.'.include', $options, $selected); ?>
                            </td>       
                            <td  align="center" >
                            	<?php $optionsrequired = array(1 => '1'); $selectedrequired= (isset($this->data['SurveyQuestion'][$i]['required'])) ? array($this->data['SurveyQuestion'][$i]['required']) :''; 
                            	echo $form->checkbox('SurveyQuestion.'.$i.'.required', $optionsrequired, $selectedrequired); ?>
                            </td>       
                            
							
							<td  align="left" ><span class="intp-Span"><?php echo $form->input('SurveyQuestion.'.$i.'.question', array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false,"maxlength" => "200")); ?></span>
                            	<small>(Please enter label)</small>    
                            </td>
							
                             <td  align="center" >
                             <?php 
							 $optionstext = array(1 => '1','onclick'=>"toggleCheckbox('Text',$i)");
							 $selectedtext= (isset($this->data['SurveyQuestion'][$i]['text']))? array($this->data['SurveyQuestion'][$i]['text']) : ''; 
                             echo $form->checkbox('SurveyQuestion.'.$i.'.text', $optionstext, $selectedtext); ?></td>
							 
							 
                             <td><?php $optionslist = array(1 => '1','onclick'=>"toggleCheckbox('List',$i)"); $selectedlist= (isset($this->data['SurveyQuestion'][$i]['text']))?  array($this->data['SurveyQuestion'][$i ]['list']) :''; 
                             echo $form->checkbox('SurveyQuestion.'.$i.'.list', $optionslist, $selectedlist); ?>
                             </td>
                            <td  align="left" >
                             <div id="list2_opts" > 
                                 <span class="txtArea-top">
                                    <span class="newtxtArea-bot">
                                    	<?php echo $form->input('SurveyQuestion.'.$i.'.answer_option',  array('div' => false, 'label' => '','rows'=>'3', "style" => "width:100%;margin-top:0px;","class" => "noBg form-control"));?>
                                	</span>
                                 </span>
                              </div>    
                            </td>  
                        </tr>
                     <?php } ?>
				<tr>
					<td align="left" colspan="2" valign="top">
						<label class="boldlabel">Survey	Type</label></td>
					<td align="left" valign="top" id="surveytype">
<?php 
								$optionstype=array('0'=>'Email    ','1'=>'Webpage    ', '2'=>'Both');
								  	  $attributestype=array('value'=>$sel_type,'legend'=>false,'onclick'=>'return getSurveyType()');
									  echo $form->radio('Survey.survey_type',$optionstype,$attributestype); 
							    ?>
					</td>
					<td colspan="3">
						<table>
							<tr>
								<td><label class="boldlabel">Email Template</label>
								</td>
								<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php  echo $form->select("Survey.template",$templatedropdown, $sel_template, array('div' => false, 'label' => '','style' =>' margin-bottom: 6px; width:100%;',"class" =>"form-control","maxlength" => "250"),"---Select---");
								?></span>
								</span>
								</td>
								<td><label class="boldlabel">Webpages</label>
								</td>
								<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php  echo $form->select("Survey.webpage",$webpages, $sel_webpage, array('div' => false, 'label' => '','style' =>' margin-bottom: 6px; width:100%;',"class" =>"form-control","maxlength" => "250"),"---Select---");
								?></span>
								</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="left" colspan="2" valign="top">
						<label class="boldlabel">Email Responder</label>
					</td>
					<td align="left" colspan="4" valign="top">
						<span class="txtArea-top">
							<span class="txtArea-bot">
								<?php  echo $form->select("Survey.responder",$respondaremail, $sel_responder, array('div' => false, 'label' => '','style' =>' margin-bottom: 6px; width:100%;',"class" =>"form-control","maxlength" => "250"),"---Select---");?>
							</span>
						</span> &nbsp;
						<span class="btn-Lft">
                             <input type="button" onclick="addEmailTempforResponse();" name="Add" value="Add" class="btn-Rht btn btn-primary btn-sm">
                             </span>
					</td>
				</tr>
			<tr>
					<td align="left" colspan="2" valign="top">
						<label class="boldlabel">Survey Description</label>
					</td>
					<td align="left" colspan="4" valign="top">
						<div>
							<span class="txtArea-topform">
								<span class="txtArea-botform">
								<textarea name="data[Survey][description]" style="width: 100%;" class="form-control" rows="5"><?php echo (isset($this->data['Survey']['description']))? $this->data['Survey']['description'] :''; ?></textarea>
							</span>
							</span>
						</div>
					</td>
				</tr>

				


				<?php if(isset($this->data['Survey']['id'])){ ?>
                         <tr>
                            <td width="40%" colspan="2" align="right">&nbsp;</td>
                            <td width="60%" colspan="6" >
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td width="66%">  
                                        <div>
                                        <span class="txtArea-topform">
                                            <span class="txtArea-botform">
                                                <textarea id="codeval" style="width: 100%;" class="form-control" cols="2000" rows="5"></textarea>
                                                </span></span></div></td>
                                        <td width="34%"> <div style="padding-left: 5px;">
                                        <ul style="list-style:none;">
                                        <li><button type="button" value="Getsource" id="getiframesource" class="btn btn-primary btn-sm" name="Getsource" ><span>Get iFrame Source</span></button></li>
                                    <li><span>&nbsp;</span></li>
                                        <li id="d_clip_container"><button type="button" id="d_clip_button" value="Copy" class="newblue" name="copyb" onclick="this.form.codeval.focus();this.form.codeval.select();"><span>Copy</span></button></li>
                                        </ul>
                                        </div></td>
                                    </tr>
                                    </tbody>
                                    </table>
                         </td>
                        </tr>  
                        <?php }?>
                        
                    </tbody>
                </table>
            </div>
            
                <div class="clearfix" style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar clearfix" id="addcnttab"></div>
                                                <!-- ADD Sub Admin  FORM EOF -->

        </div>
        
<!--inner-container ends here-->

<?php echo $form->end();?>

<div class="top-bar" style="margin-bottom: 10px; text-align: left; padding-top: 5px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>

  
<div class="clear"></div>
</div>
<div class="clear"></div>
<script type="text/javascript">

	function checksurveytype(){
		switch($('input[name *="survey_type"]:checked').val()){
			case '0':
					$('#SurveyTemplates').removeAttr('disabled');
					$('#SurveyWebpages').attr('disabled','disabled');
					break;
			case '1':
					$('#SurveyTemplates').attr('disabled','disabled');
					$('#SurveyWebpages').removeAttr('disabled');
					break;
			case '2':
					$('#SurveyTemplates').removeAttr('disabled');
					$('#SurveyWebpages').removeAttr('disabled');
					break;
		}
	}

	$('input[name *="survey_type"]:checked').live('click', function(){
		checksurveytype();
	});

	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcnttab").style.paddingTop = '24px';
	else
		document.getElementById("blck").style.paddingTop = '10px';
    
    function addEmailTempforResponse() {   
         $('#emailtemplate_toresponce').focus();
         var resWindow=  window.open (baseUrlAdmin+'addmailtemplate/popup', 'AddTemp','location=1,status=1,scrollbars=1, width=950,height=650');
          resWindow.focus();
    }
    
    function addEmailTempforAlter() {  
         $('#emailtemplate_toalert_mgr').focus();
         var alertWindow= window.open (baseUrlAdmin+'addmailtemplate/popup', 'AddTemp','location=1,status=1,scrollbars=1, width=950,height=650'); 
          alertWindow.focus();
    }

   // This function is called after closing of child window ie. on page addmailtemplate.ctp 
    function GetEmailTempRefresh(){
       // alert("Refresh EMail temp dorp dwon");
        var pid='<?php echo $projectid;?>';
        var selectedid=$("#emailtemplate_toresponce").val();
        getemailtemplatesbyajax(pid, 'emailtemplate_toresponce', selectedid );
        
        var alert_selectedid=$("#emailtemplate_toalert_mgr").val();
        getemailtemplatesbyajax(pid, 'emailtemplate_toalert_mgr', alert_selectedid );
    }
    	
    function validate_survey(){
		var SurveyTemplate = $('#SurveyTemplate').val();
		
		var SurveyWebpage = $('#SurveyWebpage').val();
		 if(trim($('#SurveySurveyName').val()) == '')
                 {
                     inlineMsg('SurveySurveyName','<strong>Survey Name required.</strong>',2);
                     return false;
                 }
				 var Val = $('input:radio[name=data[Survey]]:checked').val();
				if(Val=='0' && SurveyTemplate==''){
					inlineMsg('SurveyTemplate','<strong>Please Select Survey Template.</strong>',2);
                    return false;
				}
				else if(Val=='1' && SurveyWebpage==''){
			
					inlineMsg('SurveyWebpage','<strong>Please Select Survey Webpage.</strong>',2);
                    return false;	
				}
				else if(Val=='2'){
						if(SurveyTemplate=='' || SurveyTemplate==0 ){
							inlineMsg('SurveyTemplate','<strong>Please Select Survey Template.</strong>',2);
		                    return false;
						}
						if(SurveyTemplate!=0 && SurveyWebpage==''){
							inlineMsg('SurveyWebpage','<strong>Please Select Survey Webpage.</strong>',2);
		                    return false;
						}
				}
				 
           return true;     
    }
    
    
    $(document).ready(function(){
	$("#SurveyWebpage").attr("disabled", true);
    	checksurveytype();
        
        $("#getiframesource").click(function(){            
        var counter=0;
        var id="";
        $('input[name *="include"]:checked').each(function(){        
                    counter=counter +1;
        });            
        if(counter== 0)
        {
            alert("please include at least one field to Survey.");
            return false;
            }else{    
              var onloadfun="adjustMyFrameHeight('surveyiframe'); ";
              var code='<script type="text/javascript" src="'+baseUrl+'js/myiFrame.js"></'+'script>';
              var pid='1';
              var fid='<?php echo $this->data['Survey']['id']; ?>';
                  code += "<iframe id='surveyiframe' scrolling='no' frameborder='0' src='"+baseUrl+"companies/iframesurvey/"+fid+"' style='border:none; width:900px;' onload='"+onloadfun+"' ></"+"iframe>";
                  document.getElementById("codeval").value=code;
              }
       });    
                
    }); 
</script>
<script type="text/javascript" language="javascript">    
    $('#SurveyBgcolor,#SurveyTextcolor').ColorPicker({
                onSubmit: function(hsb, hex, rgb, el) {
                    $(el).val(hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            })
            $('pincolor').bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });
</script>
<script type="text/javascript" language="javascript">  
function getSurveyType(){
	var Val = $('input:radio[name=data[Survey]]:checked').val();
	if(Val=='0'){
		$("#SurveyWebpage").attr("disabled", true);
		$("#SurveyTemplate").attr("disabled", false);
	}
	else if(Val=='1'){
			$("#SurveyTemplate").attr("disabled", true);
			$("#SurveyWebpage").attr("disabled", false);
	}
	else{
		$("#SurveyWebpage").attr("disabled", false);
		$("#SurveyTemplate").attr("disabled", false);
	}
}

function toggleCheckbox(type,number){
	var clickId = 'SurveyQuestion'+number+type;
	var secondId;
	var textaredId;
	if(type == 'List'){
		secondId = 'SurveyQuestion'+number+'Text';
		textaredId = 'SurveyQuestion'+number+'AnswerOption';
		//alert(textaredId);
		$('#'+textaredId).attr("readonly", false);
	}
	if(type == 'Text'){
		secondId = 'SurveyQuestion'+number+'List';
		textaredId = 'SurveyQuestion'+number+'AnswerOption';
		$('#'+textaredId).val('');
		$('#'+textaredId).attr("readonly", "readonly");
	}
	
	var isChecked = $('#'+clickId).is(':checked');
	if(isChecked)
	$("#"+secondId).removeAttr('checked');
}
	
</script>