<table cellspacing="0" cellpadding="0" align="left" width="100%">
	<tbody>
		<tr>
			<td width="50%" valign="top">
				<table cellspacing="10" cellpadding="0" align="left" width="100%">
					<tbody>

						<tr>
							<td align="right"><input type="hidden" id="current_domain"
								name="current_domain" value=""> <label class="boldlabel">Task
									Name <span style="color: red;">*</span>
							</label></td>
							<td><span class="intpSpan"><?php echo $form->input("CommunicationTask.task_name", array('id' => 'task_name', 'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250", 'value'=>$task_name));?>
							</span></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Select Template</label>
							</td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php 
			echo $form->select("CommunicationTask.email_template_id",$templatedropdown,$sel_email_temp,array('id' => 'email_template_id','class'=>'multilist','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>
								</span>
							</span> <span class="btnLft"><input type="button" class="btnRht"
									value="Add" name="Add" onclick="addEmailTempforTask();" />
							</span></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Subject </label></td>
							<td><span class="intpSpan" style="vertical-align: top"> <?php echo $form->input("CommunicationTask.email_subject", array('id' => 'email_subject', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld","maxlength" => "250"));?>
							</span></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Email from </label></td>
							<td><span class="intpSpan" style="vertical-align: top"> <?php echo $form->input("CommunicationTask.email_from", array('id' => 'email_from', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld",'value'=>$email_from));?>
							</span>
							</td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Company Type</label></td>
							<td><input type="hidden" name="is_memberdisabled"
								id="is_memberdisabled" value="<?php echo $is_memebrdisabled;?>">
								<input type="hidden" name="is_contactdisabled"
								id="is_contactdisabled"
								value="<?php echo $is_contactdisabled;?>"> <span
								class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.company_type",$companytypedropdown,$sel_companytypeid,array('id' => 'companytypeid','class'=>'multilist'),"---Select---"); ?>
								</span>
							</span></td>
						</tr>
						
						<tr>
							<td align="right"><label class="boldlabel">Company Status Type</label></td>
							<td><span
								class="txtArea_top"> <span class="txtArea_bot"> 
		<?php  echo $form->select("CommunicationTask.company_type_status",$companytypestatusdropdown,null,array('id' => 'company_type_status_name','class'=>'multilist'),"---Select---"); ?></span></td>
						</tr>
						<tr>


						<tr>
							<td align="right"><label class="boldlabel">Category Type</label>
							</td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.category_id",$categorydropdown,$sel_category,array('id' => 'category_id','class'=>'multilist'),"---Select---"); ?>
								</span>
							</span></td>
						</tr>


						<tr>
							<td align="right"><label class="boldlabel">Sub Category Type</label>
							</td>
							<td><script type="text/javascript">
			//$('#sub_category_id').load(baseUrl+'mailtasks/ajax_get_sub_category/'+$('#category_id').val());
			$('#category_id').live('change', function(){
				$('#sub_category_id').load(baseUrl+'mailtasks/ajax_get_sub_category/'+$(this).val());
			});
		</script> <span class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.sub_category_id",$subcategorydropdown,$sel_sub_category,array('id' => 'sub_category_id','class'=>'multilist'),"---Select---"); ?>
								</span>
							</span></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Non Profit Type</label>
							</td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.non_profit_type_id",$nonprofittypedropdown,$sel_nonprofittype,array('id' => 'non_profit_type_id','class'=>'multilist'),"---Select---"); ?>
								</span>
							</span></td>
						</tr>


						<tr>
							<td align="right"><label class="boldlabel">Contact Type</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.contact_type",$contacttypedropdown,$sel_contactypeid,array('id' => 'contactypeid','class'=>'multilist'),"---Select---"); ?>
								</span>
							</span></td>
						</tr>


						<tr>
							<td align="right"><label class="boldlabel">Offer Type</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.offer_type",$offertypetempdropdown,$sel_offer,array('id' => 'offer_type','class'=>'multilist'),"---Select---"); ?>
								</span>
							</span></td>
						</tr>


						<tr>
							<td align="right" valign="top"><label class="boldlabel">Days
									Since</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php 
							echo $form->select("CommunicationTask.member_days_since",$days_since,$sel_days_since, array('id' => 'member_days_since', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
							?>
								</span>
							</span>
								</td>
						</tr>
						
						<tr>
							<td align="right"></td>
							<td>
								<div id="div_days_ago">
									<label class="boldlabel"> &nbsp;&nbsp;&nbsp; Days Ago :</label><span
										class="intpSpan" style="vertical-align: top"> <?php echo $form->input("CommunicationTask.member_noof_days_since", array('id' => 'member_noof_days_since', 'div' => false, 'label' => '','style' =>'width:125px;',"class" => "inpt_txt_fld","maxlength" => "250"));?>
									</span>
								</div>
							</td>
						</tr>
						
						<tr>
							<td align="right"><label class="boldlabel">Country</label></td>
							<td><span class="txtArea_top"> <span class="newtxtArea_bot"> <?php echo $form->select("CommunicationTask.member_country",$countrydropdown,$sel_country,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Company")'),'--Select--'); ?>
								</span>
							</span></td>
						</tr>
						<tr>
							<td align="right"><label class="boldlabel">Select State</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
										id="statediv"> <?php echo $form->select("CommunicationTask.member_state",$statedropdown,$sel_state,array('id' => 'state','class'=>'multilist'),"---Select---"); ?>
									</span>
								</span>
							</span></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Zip/Postal Code Range</label>
							</td>
							<td><?php
							$sdate = '';
							?> <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_zipcode_from", array('id' => 'member_zipcode_from',  'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:125px","maxlength" => "200"));?>
							</span>&nbsp; to &nbsp; <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_zipcode_to", array('id' => 'member_zipcode_to', 'value'=>$sdate, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:125px","maxlength" => "200"));?>
							</span></td>
						</tr>
					</tbody>
				</table>
			</td>
			<td width="50%" valign="top">
				<table cellspacing="10" cellpadding="0" align="center" width="100%">
					<tbody>
						<tr>
							<td align="right" width="140px"><label class="boldlabel">Status</label>
							</td>
							<td><?php 
							$eachrow['CommunicationTask']['active_status'] = 0;
							$recid = 1;
							$modelname = '';
							$redirectionurl = '';
							$project_name = '';
							if($eachrow['CommunicationTask']['active_status']=='0'){
		e($html->link(
		$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate ')),
		array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
		array('escape' => false)
		)
		);
}else{
	e($html->link(
	$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate ')),
	array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
	array('escape' => false)
	)
	);
}
?></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Event</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
										id="statediv"> 
<?php 
$eventdropdown = array();
echo $form->select("CommunicationTask.event_id",$eventdropdown,$sel_event,array('id' => 'event_id','class'=>'multilist'),"---Select---"); ?>
									</span>
								</span>
							</span></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">RSVP Type</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
										id="statediv"> <?php echo $form->select("CommunicationTask.event_rsvp_type",$event_rsvp,$sel_event_rsvp,array('id' => 'event_rsvp_type','class'=>'multilist'),"---Select---"); ?>
									</span>
								</span>
							</span></td>
						</tr>


						<tr>
							<td align="right"><label class="boldlabel">Social Network Members</label>
							</td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
										id="countrydiv"> <?php echo $form->select("CommunicationTask.social_network_members",$social_networks,$sel_social_networks,array('id' => 'social_network_members',"class"=>"multilist"),array(''=>'--Select--')); ?>
									</span>
								</span>
							</span></td>
						</tr>

						<tr>
							<td align="right"><label class="boldlabel">Non-Network Members</label>&nbsp;</td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
										id="countrydiv"> <?php echo $form->select("CommunicationTask.non_network_members",$social_networks,$sel_non_networks,array('id' => 'non_network_members',"class"=>"multilist"),array(''=>'--Select--')); ?>
									</span>
								</span>
							</span>&nbsp;&nbsp;</td>
						</tr>

						<tr>
							<td align="right" width="140px"><label class="boldlabel">Recur Pattern</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
										id="countrydiv"> <?php echo $form->select("CommunicationTask.recur_pattern",$recur_pattern,$sel_recur_pattern,array('id' => 'recur_pattern',"class"=>"multilist"),false); ?>
										<script type="text/javascript">
										 	$(function() { showRecurPatternOptions(); });
										</script>
									</span>
								</span>
							</span></td>
						</tr>

						<tr>
							<td colspan="2">
								<div id="daily_recur_pattern" style="display: none;">
									<table>
										<tbody>
											<tr>
												<td align="right" width="150px">&nbsp;</td>
												<td><?php if($this->data['CommunicationTask']['daily_every_noof_days']!=""){  
													$daily_every_noof_days=$this->data['CommunicationTask']['daily_every_noof_days'];
												}else{ $daily_every_noof_days=1;
}?>
													<div>
														<input type="radio"
															name='data[CommunicationTask][daily_pattern]'
															checked="checked" id="everyday" value='everyday'
															<?php if($this->data['CommunicationTask']['daily_pattern']=='everyday'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Every
														<?php echo $form->text("CommunicationTask.daily_every_noof_days", array('id' => 'daily_every_noof_days', 'div' => false, 'label' => '','value' => $daily_every_noof_days,"style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?>
														</span> Day(s)
													</div> <br />
												<div>
														<input type='radio'
															name='data[CommunicationTask][daily_pattern]'
															id="everyweek" value='everyweek'
															<?php if($this->data['CommunicationTask']['daily_pattern']=='everyweek'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Every
														Weekday
													</div></td>
											</tr>
										</tbody>
									</table>
								</div>

								<div id="weekly_recur_pattern" style="display: none;">
									<table>
										<tbody>
											<tr>
												<td align="right" width="150px">&nbsp;</td>
												<td><?php if($this->data['CommunicationTask']['weekly_every_noof_weeks']!=""){  
													$weekly_every_noof_weeks=$this->data['CommunicationTask']['weekly_every_noof_weeks'];
												}else{ $weekly_every_noof_weeks=1;
}?> Recur every <?php echo $form->text("CommunicationTask.weekly_every_noof_weeks", array('id' => 'weekly_every_noof_weeks', 'div' => false, 'label' => '', 'value' => $weekly_every_noof_weeks, "style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?>
													week(s) on: <?php echo $form->input('CommunicationTask.weekly_monday', array('type'=>'checkbox','id'=>'weekly_monday', 'label' => ' Monday')); ?>
													<?php echo $form->input('CommunicationTask.weekly_tuesday', array('type'=>'checkbox','id'=>'weekly_tuesday', 'label' => ' Tuesday')); ?>
													<?php echo $form->input('CommunicationTask.weekly_wednesday', array('type'=>'checkbox','id'=>'weekly_wednesday', 'label' => ' Wednesday')); ?>
													<?php echo $form->input('CommunicationTask.weekly_thursday', array('type'=>'checkbox','id'=>'weekly_thursday', 'label' => ' Thursday')); ?>
													<?php echo $form->input('CommunicationTask.weekly_friday', array('type'=>'checkbox','id'=>'weekly_friday', 'label' => ' Friday')); ?>
													<?php echo $form->input('CommunicationTask.weekly_saturday', array('type'=>'checkbox','id'=>'weekly_saturday', 'label' => ' Saturday')); ?>
													<?php echo $form->input('CommunicationTask.weekly_sunday', array('type'=>'checkbox','id'=>'weekly_sunday', 'label' => ' Sunday')); ?>

												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div id="monthly_recur_pattern" style="display: none;">
									<table>
										<tbody>
											<tr>
												<td align="right" width="150px">&nbsp;</td>
												<td>
													<div>
														<input type="radio"
															name='data[CommunicationTask][monthly_pattern]'
															checked="checked" id="dayofeverymonth"
															value='dayofeverymonth'
															<?php if($this->data['CommunicationTask']['monthly_pattern']=='dayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Day
														<?php 
														if($this->data['CommunicationTask']['monthly_onof_day']!=""){
$monthly_onof_day=$this->data['CommunicationTask']['monthly_onof_day'];
}else{ $monthly_onof_day=date('d');
}
if($this->data['CommunicationTask']['monthly_every_noof_months']!=""){
$monthly_every_noof_months=$this->data['CommunicationTask']['monthly_every_noof_months'];
}else{ $monthly_every_noof_months=1;
}
?>
														<?php echo $form->text("CommunicationTask.monthly_onof_day", array('id' => 'monthly_onof_day', 'div' => false, 'label' => '','value' => $monthly_onof_day,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?>
														of every
														<?php echo $form->text("CommunicationTask.monthly_every_noof_months", array('id' => 'monthly_every_noof_months', 'div' => false, 'label' => '','value' => $monthly_every_noof_months,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?>
														month(s)
													</div> <br />
													<div>
														<input type='radio'
															name='data[CommunicationTask][monthly_pattern]'
															id="weekdayofeverymonth" value='weekdayofeverymonth'
															<?php if($this->data['CommunicationTask']['monthly_pattern']=='weekdayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;
														The &nbsp; <select style="border: 1px solid black;"
															name="data[CommunicationTask][monthly_weeknumber]">
															<option value="first"
															<?php if($this->data['CommunicationTask']['monthly_weeknumber']=='first'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>first</option>
															<option value="second"
															<?php if($this->data['CommunicationTask']['monthly_weeknumber']=='second'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>second</option>
															<option value="third"
															<?php if($this->data['CommunicationTask']['monthly_weeknumber']=='third'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>third</option>
															<option value="fourth"
															<?php if($this->data['CommunicationTask']['monthly_weeknumber']=='fourth'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>fourth</option>
															<option value="last"
															<?php if($this->data['CommunicationTask']['monthly_weeknumber']=='last'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>last</option>
														</select> <select style="border: 1px solid black;"
															name="data[CommunicationTask][monthly_weekday]">
															<option value="Monday"
															<?php if($this->data['CommunicationTask']['monthly_weekday']=='Monday'){  echo 'selected="selected"  ';}else{ echo ' ';}?>>Monday</option>
															<option value="Tuesday"
															<?php if($this->data['CommunicationTask']['monthly_weekday']=='Tuesday'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>Tuesday</option>
															<option value="Wednesday"
															<?php if($this->data['CommunicationTask']['monthly_weekday']=='Wednesday'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>Wednesday</option>
															<option value="Thursday"
															<?php if($this->data['CommunicationTask']['monthly_weekday']=='Thursday'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>Thursday</option>
															<option value="Friday"
															<?php if($this->data['CommunicationTask']['monthly_weekday']=='Friday'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>Friday</option>
															<option value="Saturday"
															<?php if($this->data['CommunicationTask']['monthly_weekday']=='Saturday'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>Saturday</option>
															<option value="Sunday"
															<?php if($this->data['CommunicationTask']['monthly_weekday']=='Sunday'){  echo 'selected="selected"  ';}else{ echo ' ';}?>>Sunday</option>
														</select> <br />
														<br />&nbsp; &nbsp; of every &nbsp;
														<?php 
														if($this->data['CommunicationTask']['monthly_weekof_noof_months']!=""){
$monthly_weekof_noof_months=$this->data['CommunicationTask']['monthly_weekof_noof_months'];
}else{ $monthly_weekof_noof_months=1;
}
echo $form->input("CommunicationTask.monthly_weekof_noof_months", array('id' => 'monthly_weekof_noof_months','div' => false, 'label' => '','value' => $monthly_weekof_noof_months,'style'=>'border: 1px solid black;width:30px;'));?>
														&nbsp;Month(s)
													</div>

												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div id="yearly_recur_pattern" style="display: none;">
									<table>
										<tbody>
											<tr>
												<td align="right" width="150px">&nbsp;</td>
												<td><?php if($this->data['CommunicationTask']['yearly_everymonth_date']!=""){  
													$yearly_everymonth_date=$this->data['CommunicationTask']['yearly_everymonth_date'];
												}else{ $yearly_everymonth_date=date('d');
}?> <input type="radio" value="everynoofmonths" id="everynoofmonths"
													checked="checked"
													name="data[CommunicationTask][yearly_pattern]"
													<?php if($this->data['CommunicationTask']['yearly_pattern']=='everynoofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
													Every &nbsp; <select id="yearly_everymonth"
													name="data[CommunicationTask][yearly_everymonth]"
													style="border: 1px solid black;">
														<option value="January"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='January'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>January</option>
														<option value="February"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='February'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>February</option>
														<option value="March"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='March'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>March</option>
														<option value="April"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='April'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>April</option>
														<option value="May"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='May'){  echo ' selected="selected"  ';}else{ echo ' ';}?>>May</option>
														<option value="June"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
														<option value="July"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
														<option value="August"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
														<option value="September"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
														<option value="October"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
														<option value="November"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
														<option value="December"
														<?php if($this->data['CommunicationTask']['yearly_everymonth']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>
												</select> &nbsp;<?php echo $form->input("CommunicationTask.yearly_everymonth_date", array('id' => 'yearly_everymonth_date','div' => false, 'label' => '', 'value' => $yearly_everymonth_date,'style'=>'border: 1px solid black;width:30px;'));?><br />
												<br /> <input type="radio" value="theweekofmonths"
													id="theweekofmonths"
													name="data[CommunicationTask][yearly_pattern]"
													<?php if($this->data['CommunicationTask']['yearly_pattern']=='theweekofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
													The &nbsp; <select id="yearly_weeknumber"
													name="data[CommunicationTask][yearly_weeknumber]"
													style="border: 1px solid black;">
														<option value="first"
														<?php if($this->data['CommunicationTask']['yearly_weeknumber']=='first'){  echo ' selected="selected" ';}else{ echo ' ';}?>>first</option>
														<option value="second"
														<?php if($this->data['CommunicationTask']['yearly_weeknumber']=='second'){  echo ' selected="selected" ';}else{ echo ' ';}?>>second</option>
														<option value="third"
														<?php if($this->data['CommunicationTask']['yearly_weeknumber']=='third'){  echo ' selected="selected" ';}else{ echo ' ';}?>>third</option>
														<option value="fourth"
														<?php if($this->data['CommunicationTask']['yearly_weeknumber']=='fourth'){  echo ' selected="selected" ';}else{ echo ' ';}?>>fourth</option>
														<option value="last"
														<?php if($this->data['CommunicationTask']['yearly_weeknumber']=='last'){  echo ' selected="selected" ';}else{ echo ' ';}?>>last</option>
												</select> <select id="yearly_weekday"
													name="data[CommunicationTask][yearly_weekday]"
													style="border: 1px solid black;">
														<option value="Monday"
														<?php if($this->data['CommunicationTask']['yearly_weekday']=='Monday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Monday</option>
														<option value="Tuesday"
														<?php if($this->data['CommunicationTask']['yearly_weekday']=='Tuesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Tuesday</option>
														<option value="Wednesday"
														<?php if($this->data['CommunicationTask']['yearly_weekday']=='Wednesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Wednesday</option>
														<option value="Thursday"
														<?php if($this->data['CommunicationTask']['yearly_weekday']=='Thursday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Thursday</option>
														<option value="Friday"
														<?php if($this->data['CommunicationTask']['yearly_weekday']=='Friday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Friday</option>
														<option value="Saturday"
														<?php if($this->data['CommunicationTask']['yearly_weekday']=='Saturday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Saturday</option>
														<option value="Sunday"
														<?php if($this->data['CommunicationTask']['yearly_weekday']=='Sunday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Sunday</option>
												</select> <br />
												<br /> &nbsp;&nbsp;&nbsp;&nbsp;of <select
													id="yearly_weekof_month"
													name="data[CommunicationTask][yearly_weekof_month]"
													style="border: 1px solid black;">
														<option value="January"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=="January"){  echo ' selected="selected" ';}else{ echo ' ';}?>>January</option>
														<option value="February"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=="February"){  echo ' selected="selected" ';}else{ echo ' ';}?>>February</option>
														<option value="March"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=="March"){  echo ' selected="selected" ';}else{ echo ' ';}?>>March</option>
														<option value="April"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='April'){  echo ' selected="selected" ';}else{ echo ' ';}?>>April</option>
														<option value="May"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='May'){  echo 'selected="selected" ';}else{ echo ' ';}?>>May</option>
														<option value="June"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
														<option value="July"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
														<option value="August"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
														<option value="September"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
														<option value="October"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
														<option value="November"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
														<option value="December"
														<?php if($this->data['CommunicationTask']['yearly_weekof_month']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>
												</select></td>
											</tr>
										</tbody>
									</table>
								</div>

							</td>
						</tr>

						<tr>
							<td align="right" width="140px"><label class="boldlabel">Start <span
									class="red">*</span>
							</label>
							</td>
							<td><span class="intpSpan"><?php
							if($this->data['CommunicationTask']['task_startdate']!=""){
							$task_startdate= $this->data['CommunicationTask']['task_startdate'];
					}else{
						   $task_startdate= date('m-d-Y');
					}
		   echo $form->text("CommunicationTask.task_startdate", array('id' => 'task_startdate', 'div' => false, 'label' => '',"class"=>"inpt_txt_fld","maxlength" => "200","style" => "width:200px", 'value'=>$task_startdate,'readonly'=>'readonly'));?></span>
							</td>
						</tr>

						<tr>
							<td align="right" width="140px"><label class="boldlabel">End <span
									class="red">*</span>
							</label></td>
							<td><?php if($this->data['CommunicationTask']['task_end_after_occurrences']!=""){
			$taskEndafterOccrrences=$this->data['CommunicationTask']['task_end_after_occurrences'];
		}else{
			  $taskEndafterOccrrences=1;
		}?> <input type='radio' name='data[CommunicationTask][task_end]'
								checked="checked" id="after_accurrences"
								value='after_accurrences'
								<?php if($this->data['CommunicationTask']['task_end']=='after_accurrences'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
								After: <?php echo $form->select("CommunicationTask.task_end_after_occurrences",array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30'),$taskEndafterOccrrences,array('id' => 'task_end_after_occurrences','style'=>'width:40px',"class"=>"",'label'=>'Occurrences'),false); ?>
								Occurrences<br />
							<br /> <input type='radio'
								name='data[CommunicationTask][task_end]' id="by_date"
								value='by_date'
								<?php if($this->data['CommunicationTask']['task_end']=='by_date'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
								By: <span class="intpSpan"><?php echo $form->text("CommunicationTask.task_end_by_date", array('id' => 'task_end_by_date', 'div' => false, 'label' => '',"class"=>"inpt_txt_fld","maxlength" => "200","style" => "width:160px",'readonly'=>'readonly'));?>
							</span></td>
						</tr>
						<tr>
							<td align="right" width="140px"><label class="boldlabel">Note</label>
							</td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"><?php echo $form->input("CommunicationTask.task_note", array('id' => 'task_note', 'div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg'));?>
								</span>
							</span></td>
						</tr>
						<tr>
							<td align="right" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" colspan="2">&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
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
	
	
	$('#task_startdate').datepicker({
		showOn: "button",
		buttonImage: baseUrl+"/img/calendar_new.png",
		dateFormat: 'mm-dd-yy',
		changeMonth: true,
		changeYear:true 
	});
	
	$('#task_end_by_date').datepicker({
		showOn: "button",
		buttonImage: baseUrl+"/img/calendar_new.png",
		dateFormat: 'mm-dd-yy',
		changeMonth: true,
		changeYear:true
	});
});
/* ]]> */
</script>