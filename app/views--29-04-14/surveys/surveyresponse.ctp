<script type="text/javascript">
	$(document).ready(function() {
		$('#SurveyMnu').removeClass("butBg");
		$('#SurveyMnu').addClass("butBgSelt");
	}); 
</script> 
<?php
	$lgrt = $session->read('newsortingby');
	$base_url = Configure::read('App.base_url').'surveys';
?>   
<div class="titlCont">
    <div class="myclass">
        <div align="center" id="toppanel" >
            <?php echo $this->renderElement('new_slider');   ?>
        </div>
        <span class="titlTxt">
            Survey Completed
        </span>
        <?php echo $form->create("Surveys", array("action" => "surveyresponse/".$this->data['SurveyResponse']['id'], "onsubmit"=>"return validate_surveyresponse();" ));
              echo $form->hidden("SurveyResponse.id");
        ?>
        <div class="topTabs">
            <ul>
            	<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $base_url.'/survey_response/'.$this->data['SurveyResponse']['survey_id'] ?>')"><span> Cancel</span></button></li>
            </ul>
        </div>
        <?php    $this->loginarea="surveys";    $this->subtabsel="survey_response";
             echo $this->renderElement('survey_response_submenus');  ?>
    </div>
    
</div>
<!--titlCont1 ends here-->

<!--inner-container starts here-->
<div class="centerPage">
        <div class="">
            <div class="top-bar" style="border-left:0px;"></div>
            <div class="">	
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>       
                <div class="clear"></div>
            </div>
                <div style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar" id="addcnttab"></div>
                <table  cellpadding="5" cellspacing="8" align="center" width="70%" >
                    <tbody>
                        <tr>
                            <td colspan="6"><?php if($session->check('Message.flash')){ $session->flash(); } ?></td>
                        </tr>
                        <tr>
                           <td colspan="6" width="100%"> 
                            <table  width="100%">
                            	<tr>
                                   <td width="20%" style="padding-bottom: 12px;">
                                		<label class="boldlabel">Survey Name</label>
                                   </td>
                                   <td width="30%" align="left">
                                    	<span class="intpSpan">
                                    		<?php echo $form->input("Survey.survey_name", array("class" => "inpt_txt_fld","maxlength" => "200",'label'=>false));?>
                                    	</span>
                                   </td> 
                                   
                                   <td width="20%" align="right" valign="top" style="padding-top: 2px;">
                                    	<label class="boldlabel">Date Submitted</label>
                                   </td>  
                                   <td width="30%" align="left" valign="top">
                                        <span class="intpSpan">
                                        	<?php echo $form->input("Survey.createddate", array("class" => "inpt_txt_fld","maxlength" => "200", 'value'=>date("m-d-Y", strtotime($this->data['SurveyResponse']['created'])),'label'=>false));?>
                                       	</span>
                                   </td> 
                                </tr> 
                                <tr>
                                	<td style="padding-bottom: 12px;">
                                		<label class="boldlabel">Survey Action</label>
                                	</td>
                                    <td align="left">
                                    	<span class="intpSpan">
                                    		<?php echo $form->select("SurveyResponse.action",$actions, $this->data['SurveyResponse']['action'],array('class'=>'multilist'),array('0'=>'--Select--')); ?>
                                    	</span>
                                   </td> 
                                   <td align="right" valign="top" style="padding-top: 2px;">
                                    	<label class="boldlabel">Action Date</label>
                                    </td>  
                                    <td align="left" valign="top">
                                        <span class="intpSpan">
                                        	<?php echo $form->input("Survey.modifieddate", array("class" => "inpt_txt_fld","maxlength" => "200", 'value'=>date("m-d-Y", strtotime($this->data['SurveyResponse']['modified'])),'label'=>false));?>
                                       	</span>
                                    </td> 
                                </tr> 
                                <tr>
                                   <td style="padding-bottom: 12px;">
                                		<label class="boldlabel">First Name</label>
                                   </td>
                                   <td align="left">
                                    	<span class="intpSpan">
                                    		<?php echo $form->input("Holder.firstname", array("class" => "inpt_txt_fld","maxlength" => "200",'label'=>false));?>
                                    	</span>
                                   </td> 
                                   <td align="right" valign="top" style="padding-top: 2px;"></td>  
                                   <td align="left" valign="top"></td> 
                                </tr>
                                
                                 <tr>
                                	<td style="padding-bottom: 12px;">
                                		<label class="boldlabel">Last Name </label>
                                	</td>
                                   <td align="left">
                                    	<span class="intpSpan">
                                    		<?php echo $form->input("Holder.lastnameshow", array("class" => "inpt_txt_fld","maxlength" => "200",'label'=>false));?>
                                    	</span>
                                    </td> 
                                   <td align="right" valign="top" style="padding-top: 2px;"></td>  
                                   <td align="left" valign="top"></td> 
                                </tr>
                                <tr>
                                	<td colspan="4">
                                	</td>
                                </tr>
			 				</table>
           				</td>
        			</tr>
        			 <?php 	$i = 1; foreach($this->data['Survey']['SurveyQuestion'] as $survey) {   ?>
                                  <tr>
                                	<td width="20%" style="padding-bottom: 12px;">
                                		<label class="boldlabel">Question <?php echo $i; ?></label>
                                	</td>
                                   <td width="30%"  align="left">
                                    	<label class="boldlabel"><?php // echo $survey['question']; ?>
                                    		Question created in Survey Setup.
                                    	</label>
                                    </td> 
                                   <td width="20%"  align="right" valign="top" style="padding-top: 2px;"><label class="boldlabel">Response <?php echo $i ?> </label></td>  
                                   <td width="30%"  align="left" valign="top"><label class="boldlabel"><?php echo $this->data['SurveyResponse']['response'.$i]; ?></label></td> 
                                </tr>
                                <?php  $i++; } ?>
				<tr>
					<td align="left" valign="top">
						<label class="boldlabel">Comment</label>
					</td>
					<td align="left" valign="top">
						<div>
							<span class="txtArea_topform">
								<span class="txtArea_botform">
									<textarea name="data[SurveyResponse][comment]" style="background: none repeat scroll 0% 0% transparent; width: 420px;" class="socialtxtArea1" rows="5"><?php echo (isset($this->data['SurveyResponse']['comment']))? $this->data['SurveyResponse']['comment'] :''; ?></textarea>
								</span>
							</span>
						</div>
					</td>
					<td>
					</td>
					<td>
					</td>
				</tr>
                </tbody>
                </table>                                <!-- ADD Sub Admin  FORM EOF -->
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
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcnttab").style.paddingTop = '24px';
	else
		document.getElementById("blck").style.paddingTop = '10px';

	function validate_surveyresponse(){
		return true;
	}
    
</script>