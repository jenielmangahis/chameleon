<script type="text/javascript">
$(document).ready(function() {
	
$('#playMnu').removeClass("butBg");
$('#playMnu').addClass("butBgSelt");
}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/tasklist';
?>
<?php 
echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');
echo $html->css('/css/jquery_ui_datepicker');
echo $html->css('timepicker_plug/css/style');
?>
<script type="text/javascript">
		var h=screen.height;
			w=screen.width;
			resWindow1 = null;
			viewotherid =0;
		var cid,pid;

		function addEmailTempforTask() {   
			$('#email_template_id').focus();
			var resWindow=  window.open (baseUrl+'players/addtemplate');
		}

		$('.otherlocationclass').live('click', function(){
				viewotherid = $(this).attr('id');
				$(this).parent().find('tr.otherlocationclass').css({'background':'#EBEBEB', 'color':'#000'});
				$(this).css({'background':'#3399FF', 'color':'#FFF'});
		});
		 
		function viewEmailTempforRSVP() {   
				 cid = $('#contact_id').val();	
				 pid = $('#projectid').val();
				 $('#addmerchant').focus();
		    	 resWindow1=  window.open (baseUrl+'players/addcontacts/'+cid+'/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
		         resWindow1.focus();
        }
		   
		$(resWindow1).live('unload', function() {
				resWindow1=null; 
					$.ajax({
						type: "GET",
						url: baseUrl+'players/getlatestcontactbypros/'+pid,
						complete: function(response){
						$('#contact_id').html(response.responseText); 				
						}
				});
		 });
			 
		function addnewcontact(){
			 resWindow1=  window.open (baseUrl+'players/addcontacts/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
		}
		
</script>

<!-- Body Panel starts -->
<div class="container">
	<div class="titlCont1" style="height: 91px;">
		<div class="centerPage">
			<div align="center" id="toppanel">
				<?php  echo $this->renderElement('new_slider');  ?>
			</div>

			<?php if($usettype==trim("admin")){  echo $this->renderElement('project_name'); } ?>
			<span class="titlTxt"> <?php 
			if($this->data['CommunicationTask']['id']){
				$act = 'edit';
				echo "Edit Email Task Detail";
			}else{
				$act = 'add';
				echo "Add New Task";
			}
			?>
			</span>

			<?php echo $form->create("players", array("action" => "addtask",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addtask', 'id' => "addtask","onsubmit"=>"return validateTaskForm();"));
			echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
			echo $form->hidden("CommunicationTask.project_id", array('id' => 'project_id','value'=>"$project_id"));
			echo $form->hidden("CommunicationTask.id", array('id' => 'id'));
			?>
			<!--<div id="addcomm" class="midform"></div>-->
			<div id="showtaskreport" title="Task Report" style="display: none;">
		<p>This is an animated dialog which is useful for displaying
			information. The dialog window can be moved, resized and closed with
			the 'x' icon.</p>
	</div>
			<div class="topTabs">
				<ul class="dropdown">
				<?php 
				if(isset($this->data['CommunicationTask']['project_id']) &&  ($this->data['CommunicationTask']['project_id'] != '0' || $usertype =='admin') ) { ?>
					<li><button type="submit" value="Submit" class="button"
							name="data[Action][redirectpage]">
							<span>Save</span>
						</button></li>
					<li><button type="submit" value="Submit" class="button"
							name="data[Action][noredirection]">
							<span>Apply</span>
						</button></li>
			 <?php } ?>
					<li><button type="button" id="saveForm" class="button"
							ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')">
							<span> Cancel</span>
						</button></li>
				</ul>
			</div>
			<div class="clear"></div>
			<div>
				<?php $this->loginarea="players";$this->subtabsel="tasklist";
				echo $this->renderElement('players/player_email_submenu');  ?>
			</div>	
		</div>
	</div>


	<div id="addcmp" class="midCont">


		<?php if($session->check('Message.flash')) { 
			echo $this->renderElement('error_message');
} ?>
		<div class="midform">

			<table cellspacing="0" cellpadding="0" align="left" width="100%">
				<tbody>
					<tr>
						<td width="50%" valign="top">
							<table cellspacing="10" cellpadding="0" align="left" width="100%">
								<tbody>

									<tr>
										<td align="right"><input type="hidden" id="current_domain"
											name="current_domain" value=""> <label class="boldlabel">Task Name <span style="color: red;">*</span>
										</label></td>
										<td><span class="intpSpan"><?php echo $form->input("CommunicationTask.task_name", array('id' => 'task_name', 'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
										</span></td>
									</tr>

									<tr>
										<td align="right"><label class="boldlabel">Select Template <span style="color: red;">*</span></label>
										</td>
										<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php 
			echo $form->select("CommunicationTask.email_template_id",$templatedropdown,$sel_email_temp,array('id' => 'email_template_id','class'=>'multilist','onchange'=>'getEmailTemplate(this.value)'),array('0'=>'--Select--')); ?>
											</span>
										</span> <span class="btnLft"><input type="button"
												class="btnRht" value="Add" name="Add"
												onclick="addEmailTempforTask();" /> </span></td>
									</tr>

									<tr>
										<td align="right"><label class="boldlabel">Subject <span style="color: red;">*</span></label></td>
										<td><span class="intpSpan" style="vertical-align: top"> <?php echo $form->input("CommunicationTask.email_subject", array('id' => 'email_subject', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld","maxlength" => "250"));?>
										</span></td>
									</tr>

									<tr>
										<td align="right"><label class="boldlabel">Email from <span style="color: red;">*</span></label>
										</td>
										<td><span class="intpSpan" style="vertical-align: top"> <?php echo $form->input("CommunicationTask.email_from", array('id' => 'email_from', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld",'value'=>$email_from));?>
										</span>
										</td>
									</tr>

									<tr>
										<td align="right"><label class="boldlabel">Company Type</label>
										</td>
										<td><input type="hidden" name="is_memberdisabled"
											id="is_memberdisabled"
											value="<?php echo $is_memebrdisabled;?>"> <input
											type="hidden" name="is_contactdisabled"
											id="is_contactdisabled"
											value="<?php echo $is_contactdisabled;?>"> <span
											class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.company_type",$companytypedropdown,$sel_companytypeid,array('id' => 'companytypeid','class'=>'multilist'),"---Select---"); ?>
											</span>
										</span></td>
									</tr>


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
				$('#sub_category_id').load(baseUrl+'players/ajax_get_sub_category/'+$(this).val());
			});
		</script> <span class="txtArea_top"> <span class="txtArea_bot"> <?php $selectedsubcategory; echo $form->select("CommunicationTask.sub_category_id",$subcategorydropdown,$sel_sub_category,array('id' => 'sub_category_id','class'=>'multilist'),"---Select---"); ?>
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
										<td align="right"><label class="boldlabel">Contact Type</label>
										</td>
										<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.contact_type",$contacttypedropdown,$sel_contactypeid,array('id' => 'contactypeid','class'=>'multilist'),"---Select---"); ?>
											</span>
										</span></td>
									</tr>

									<tr>
										<td align="right"><label class="boldlabel">Offer Type</label>
										</td>
										<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php echo $form->select("CommunicationTask.offer_id",$offertypedropdown,$sel_offer,array('id' => 'offer_id','class'=>'multilist'),"---Select---"); ?>
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
										<td><span class="txtArea_top"> <span class="newtxtArea_bot"> <?php echo $form->select("CommunicationTask.member_country",$countrydropdown,$sel_country,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Company")'),array('254'=>'United States')); ?>
											</span>
										</span></td>
									</tr>
									<tr>
										<td align="right"><label class="boldlabel">Select State</label>
										</td>
										<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
													id="statediv"> <?php echo $form->select("CommunicationTask.member_state",$statedropdown,$sel_state,array('id' => 'state','class'=>'multilist'),"---Select---"); ?>
												</span>
											</span>
										</span></td>
									</tr>

									<tr>
										<td align="right"><label class="boldlabel">Zip/Postal Code
												Range</label>
										</td>
										<td><?php
										$sdate = '';
										?> <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_zipcode_from", array('id' => 'member_zipcode_from',  'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:125px","maxlength" => "200"));?>
										</span>&nbsp; to &nbsp; <span class="intpSpan middle"><?php echo $form->text("CommunicationTask.member_zipcode_to", array('id' => 'member_zipcode_to',  'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:125px","maxlength" => "200"));?>
										</span></td>
									</tr>

									</tr>
								</tbody>
							</table>
						</td>
						<td width="50%" valign="top">
							<table cellspacing="10" cellpadding="0" align="center"
								width="100%">
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
?>
										</td>
									</tr>

									<tr>
										<td align="right"><label class="boldlabel">Event</label></td>
										<td><span class="txtArea_top"> <span class="txtArea_bot"> <span
													id="statediv"> <?php echo $form->select("CommunicationTask.event_id",$eventdropdown,$sel_event,array('id' => 'event_id','class'=>'multilist'),"---Select---"); ?>
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
										<td align="right"><label class="boldlabel">Social Network
												Members</label>
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
										<td align="right" width="140px"><label class="boldlabel">Recur
												Pattern</label></td>
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
																	</select> <br /> <br />&nbsp; &nbsp; of every &nbsp;
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
															</select> <br /> <br /> &nbsp;&nbsp;&nbsp;&nbsp;of <select
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
										<td align="right" width="140px"><label class="boldlabel">Start
												<span class="red">*</span>
										</label>
										</td>
										<td><span class="intpSpan"><?php
										if($this->data['CommunicationTask']['task_startdate']!=""){
							$task_startdate= $this->data['CommunicationTask']['task_startdate'];
					}else{
						   $task_startdate= date('m-d-Y');
					}
		   echo $form->text("CommunicationTask.task_startdate", array('id' => 'task_startdate', 'div' => false, 'label' => '',"class"=>"inpt_txt_fld","maxlength" => "200","style" => "width:200px", 'value'=>$task_startdate,'readonly'=>'readonly'));?>
										</span></td>
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
											Occurrences<br /> <br /> <input type='radio'
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

									<tr>
										<td align="right" width="140px">&nbsp;</td>
										<td><span class="btnLft">
												<button name="runreport" id="runreport" class="btnRht"
													value="RunReport" type="button">Run Report</button>
										</span></td>
									</tr>



								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
<div id="loading" ></div>
			<script type="text/javascript">
var dateobj = new Date();
$(function() {
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


		</div>
	</div>


	<script language='javascript'>
<?php if(!($this->data['CommunicationTask']['id'])) { ?>
getstateoptions('254',"Company"); 
<?php } ?>
</script>

	<div class="clear"></div>
</div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}
	$(function() { 
            showRecurPatternOptions();
        });

        $("#recur_pattern").live('change', function(){
           showRecurPatternOptions();  
        });
        
        /**
          * Function to Show Recurr Patter's options depends of selected Recurre Pattern
          */
        
        function showRecurPatternOptions(){           
		 
			 var recur_pattern=$("#recur_pattern").val();
				 $("#daily_recur_pattern").hide();    
				 $("#weekly_recur_pattern").hide();    
				 $("#monthly_recur_pattern").hide();    
				 $("#yearly_recur_pattern").hide();    
					
				if(recur_pattern=='Yearly'){
					   $("#yearly_recur_pattern").show();    
				}else if(recur_pattern=='Monthly'){
						$("#monthly_recur_pattern").show();
				}else if(recur_pattern=='Weekly'){
					  $("#weekly_recur_pattern").show();    
				}else{
					$("#daily_recur_pattern").show();    
				}
        }
		
		
function validateTaskForm(){
	var task_name 			= 	$('#task_name').val();
	var email_template_id 	= 	$('#email_template_id').val();
	var email_subject 		= 	$('#email_subject').val();
	var email_from 			= 	$('#email_from').val();
	
	if(task_name == '')
	{
		 inlineMsg('task_name','<strong>Please provide Task Name</strong>',2);
		 return false;
	}

	 if(email_template_id == '0'){
		 inlineMsg('email_template_id','<strong>Please Select Email Template</strong>',2);
		 return false;
	}

	 if(email_subject == ''){
		 inlineMsg('email_subject','<strong>Please provide Email Subject</strong>',2);
		 return false;
	}
	if(email_from == ''){
		 inlineMsg('email_from','<strong>Please provide Email From</strong>',2);
		 return false;
	}
	return true;
}
</script>


<script type="text/javascript" language="JavaScript">
<?php if(!($this->data['CommunicationTask']['id'])) { ?>
getstateoptions('254',"Company");
 $("#zip_postal").show();     
<?php } ?>


</script>
<script type="text/javascript">
    // increase the default animation speed to exaggerate the effect
    $.fx.speeds._default = 1000;
    $(function() {
        $( "#showtaskreport" ).dialog({
            autoOpen: false,
            modal: true,
            width: 560,
            show: "blind",
            hide: "blind"
        });

       $( "#runreport" ).click(function() {  // runTaskReport();
        $.ajax({
                            type: "POST",  
                            data:  $("#addcommtask").serialize() ,
                            url: baseUrl+'players/commtask_get_report_list_by_ajax/',
							
                            cache: false,
                            success: function(result){    
                                   //  alert(result);
									  $("#showtaskreport").html(result); 
                                         $( "#showtaskreport" ).dialog( "open" );
                                      return false; 
                            }
              });
           
          
        });
    });
        
        /**
         * Funtion addnew email template in pop-up
         */
         function addEmailTempforTask() {   
             $('#email_template_id').focus();
             var resWindow=  window.open (baseUrl+'mailtask/addsupermailcontent');
             resWindow.focus();
           }
           
          // This function is called after closing of child window ie. on page addmailtemplate.ctp 
        function GetEmailTempRefresh(){
           // alert("Refresh EMail temp dorp dwon");
            var pid='<?php echo $projectid;?>';
            var selectedid=$("#email_template_id").val();
            getemailtemplatesbyajax(pid, 'email_template_id', selectedid );
        }
        
        
         /**
         * Funtion addnew comment type in pop-up
         */
         function addCommentTypeforTask() {
             $('#relatesto_commenttype_id').focus();
             var resWindow=  window.open (baseUrlAdmin+'addcommenttype/popup', 'AddCommentType','location=1,status=1,scrollbars=1, width=950,height=650');
             resWindow.focus();
           }
           
          // This function is called after closing of child window ie. on page addcommenttype.ctp 
        function GetCommentTypeRefresh(){
            
            var pid='<?php echo $projectid;?>';
            var selectedid=$("#relatesto_commenttype_id").val();
           getcommenttypesbyajax(pid, 'relatesto_commenttype_id', selectedid );
        }
        /**
        * REfresh Comment type dropdown
        */
        function getcommenttypesbyajax(projectid,eleid, selectedid) {    
               if(projectid==""){
                  return false;
               }
                    
               jQuery.ajax({
                     type: "GET",
                     url: baseUrlAdmin+'getcommenttypesbyajax/'+projectid+'/'+selectedid,
                     cache: false,
                     success: function(rText){
                            jQuery('#'+eleid).html(rText);
                     }
             });
      
      }
        
        function runTaskReport(){
		    var current_domain=$("#current_domain").val();  
                     //location = "/admins/sendtempmail/"+id;
              $.ajax({
                            type: "GET",  
                            url: baseUrl+'players/commtask_get_report_list_by_ajax/all',
                            cache: false,
                            success: function(result){      
                                     

									  $("#showtaskreport").html(result); 
                                    //   $( "#showtaskreport" ).dialog( "open" );  
                            }
              });
        }
        
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcomm").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
    
function getEmailTemplate(id){
        var current_domain=$("#current_domain").val();  

    //location = "/admins/sendtempmail/"+id;
      $.ajax({
                    url: 'http://'+current_domain+'/admins/get_email_template_details_by_ajax/'+id,
                    dataType:'json',
                    cache: false,
                    success: function(result){
                              $("#email_subject").val(result.subject);
                              $("#email_from").val(result.sender);
                    }
      });

}     

        $(document).ready(function() { 
            

       //     $("#addcomm").slideDown();
       //     $("#showtaskreport").show();
           
              
            showRecurPatternOptions();
            toggleZipPostal();
            initToggleDaySinceAndEvent();       
           
            if($("#isedit").val()=="1"){ 
                  if($("#companytypeid").val()=="" &&  $("#contactypeid").val()=="")
                {
                    toggleContactAndMemberFields();  
                }else{
                      toggleMemberFields();
                }
            }
             
               
            $("#country").change(function(){
            
              toggleZipPostal();  
           });
           
            $("#subscription_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#member_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
             $("#donation_level").change(function(){
                 toggleContactAndMemberFields();  
            });
            
                      
            $("#member_days_since").change(function(){ 
               toggleContactAndMemberFields(); 
               // alert("days since "+$("#member_days_since").val());
                // Do for days ago box =enable and disable logic
                   toggleDaySinceAndEvent();
                   
            });
            
             $("#state").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            
            $("#event_id").change(function(){    toggleDaySinceAndEvent();
               
                if($("#event_id").val()==""){
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                }else{
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").removeAttr('disabled');
                }
                     toggleContactAndMemberFields(); 
            });
            
            $("#event_rsvp_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#relatesto_commenttype_id").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#social_network_members").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#non_network_members").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#companytypeid,#contactypeid").change(function(){
                 toggleMemberFields();  
            });

            $("#recur_pattern").change(function(){
            
              showRecurPatternOptions();  
            });
        
        
          function initToggleDaySinceAndEvent(){   
                               
             if($("#member_days_since").val()=="" && $("#event_id").val()==""){    
                     $("#member_noof_days_since").val("");
                     $("#member_days_since").removeAttr('disabled'); 
                     $("#member_noof_days_since").attr("disabled","disabled");
                     
                    $("#event_id").removeAttr('disabled'); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
             }else if($("#member_days_since").val()!=""){         
                    // $("#member_noof_days_since").val("");
                    $("#member_noof_days_since").removeAttr('disabled');
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled"); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");   
             }else if($("#event_id").val()!=""){   
                  
                    $("#member_noof_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    $("#member_noof_days_since").attr("disabled","disabled");
                  //  $("#event_id").val("");
                    $("#event_id").removeAttr('disabled'); 
                   //
                   if($("#event_rsvp_type").val()==""){
                  		 $("#event_rsvp_type").val("");    
                       $("#event_rsvp_type").attr("disabled","disabled");
                   }
                   
                    
                }
        } 
        
            function toggleDaySinceAndEvent(){   
                               
             if($("#member_days_since").val()=="" && $("#event_id").val()==""){    
                     $("#member_noof_days_since").val("");
                     $("#member_days_since").removeAttr('disabled'); 
                     $("#member_noof_days_since").attr("disabled","disabled");
                     
                    $("#event_id").removeAttr('disabled'); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
             }else if($("#member_days_since").val()!=""){         
                    // $("#member_noof_days_since").val("");
                    $("#member_noof_days_since").removeAttr('disabled');
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled"); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");   
             }else if($("#event_id").val()!=""){   
                                                            
                    $("#member_noof_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    $("#member_noof_days_since").attr("disabled","disabled");
                  //  $("#event_id").val("");
                    $("#event_id").removeAttr('disabled'); 
                   // $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                }
        } 
        /**
        * Fuction to hide and show Zip/Postal Code Range fields depends on selected country 
        * If United States or India country is selected the show Zip/Postal Code Range field
        * Other wise hide Zip/Postal Code Range field
        */
        function toggleZipPostal(){
            var country=$("#country").val(); 
            if(country=='254' || country=='113') {
                 $("#zip_postal").show();
                  $("#member_zipcode_from").val("");
                  $("#member_zipcode_to").val("");
            }else{
                 $("#zip_postal").hide();
                  $("#member_zipcode_from").val("");
                  $("#member_zipcode_to").val("");
            }
        }
        
        /**
        * Function to Show Recurr Patter's options depends of selected   Recurre Pattern
        */
        function showRecurPatternOptions(){
            var recur_pattern=$("#recur_pattern").val();
             $("#daily_recur_pattern").hide();    
             $("#weekly_recur_pattern").hide();    
             $("#monthly_recur_pattern").hide();    
             $("#yearly_recur_pattern").hide();    
                
            if(recur_pattern=='Yearly'){
                   $("#yearly_recur_pattern").show();    
            }else if(recur_pattern=='Monthly'){
                    $("#monthly_recur_pattern").show();
            }else if(recur_pattern=='Weekly'){
                  $("#weekly_recur_pattern").show();    
            }else{
                //recur_pattern=='Daily'
                $("#daily_recur_pattern").show();    
            }
        }
        
        function toggleContactAndMemberFields(){ 
                                                   
                  // alert("relatesto_commenttype_id ="+$("#relatesto_commenttype_id").val()); 
            if($("#subscription_type").val()!="" || $("#member_type").val()!="" ||  $("#donation_level").val()!="" || $("#member_agefrom").val()!="00-00-0000" || $("#member_ageto").val()!="00-00-0000" || $("#member_days_since").val()!=""  || $("#state").val()!=""  || $("#member_zipcode_from").val()!=""  || $("#member_zipcode_to").val()!=""  || $("#event_id").val()!=""  || $("#event_rsvp_type").val()!="" || $("#relatesto_commenttype_id").val()!="" || $("#social_network_members").val()!="" || $("#non_network_members").val()!="" || $("#member_points_rangefrom").val()!="" || $("#member_points_rangeto").val()!="" )
            {
                disableContactInfo();
            }
            else
            {
                //alert("enableContactInfo");  
                enableContactInfo();
            }
            
        }
        
        function toggleMemberFields(){ 
       // alert("is_contactdisabled "+$("#is_contactdisabled").val());
                  //
            if($("#companytypeid").val()!="" ||  $("#contactypeid").val()!="")
            {
               disableMemeberInfo();
            }
            else
            {
                enableMemebrInfo();
            }
            
        }
        
        function disableMemeberInfo(){                              
             // Disable Member related Items 
                    $("#member_type").val("");
                    $("#member_type").attr("disabled","disabled");
                    
                     $("#donation_level").val("");
                    $("#donation_level").attr("disabled","disabled");
                    
                    $("#subscription_type").val("");
                    $("#subscription_type").attr("disabled","disabled");
                    
                    $("#member_agefrom").val("00-00-0000");
                    $("#member_agefrom").attr("disabled","disabled");
                    
                    $("#member_ageto").val("00-00-0000");
                    $("#member_ageto").attr("disabled","disabled");
                    
                    $("#member_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    
                    $("#state").val("");
                    $("#state").removeAttr('disabled');
                    
                    $("#member_zipcode_from").val("");
                    $("#member_zipcode_from").attr("disabled","disabled");
                        
                    $("#member_zipcode_to").val("");
                    $("#member_zipcode_to").attr("disabled","disabled");
                    
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled");
                    
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                    
                    $("#relatesto_commenttype_id").val("");
                    $("#relatesto_commenttype_id").attr("disabled","disabled");
                    
                    $("#social_network_members").val("");
                    $("#social_network_members").attr("disabled","disabled");
                    
                    $("#non_network_members").val("");
                    $("#non_network_members").attr("disabled","disabled");
                    
                    
                    
                    $("#member_points_rangefrom").val("");
                    $("#member_points_rangefrom").attr("disabled","disabled");
                    
                    $("#member_points_rangeto").val("");
                    $("#member_points_rangeto").attr("disabled","disabled");
        }
        
        function enableMemebrInfo(){   
            // Enable Member related Items 
               // $("#subscription_type").val("");
                $("#subscription_type").removeAttr('disabled');
                
                $("#member_type").removeAttr('disabled');
                
                $("#donation_level").removeAttr('disabled');
                
              //  $("#member_agefrom").val("");
                $("#member_agefrom").removeAttr('disabled');
                
              //  $("#member_ageto").val("");
                $("#member_ageto").removeAttr('disabled');
                
              //  $("#member_days_since").val("");
                $("#member_days_since").removeAttr('disabled');
                
              //  $("#state").val("");
                $("#state").removeAttr('disabled');
                
                //$("#member_zipcode_from").val("");
                $("#member_zipcode_from").removeAttr('disabled');
                    
              //  $("#member_zipcode_to").val("");
                $("#member_zipcode_to").removeAttr('disabled');
                
              //  $("#event_id").val("");
                $("#event_id").removeAttr('disabled');
                
               // $("#event_rsvp_type").val("");
               // $("#event_rsvp_type").removeAttr('disabled');
                
               // $("#relatesto_commenttype_id").val("");
                $("#relatesto_commenttype_id").removeAttr('disabled');
                
               // $("#social_network_members").val("");
                $("#social_network_members").removeAttr('disabled');
                
              //  $("#non_network_members").val("");
                $("#non_network_members").removeAttr('disabled');
                
              //  $("#relatesto_commenttype_id").val("");
                $("#relatesto_commenttype_id").removeAttr('disabled');
                
               // $("#member_points_rangefrom").val("");
                $("#member_points_rangefrom").removeAttr('disabled');
                
               // $("#member_points_rangeto").val("");
                $("#member_points_rangeto").removeAttr('disabled');  
        }
        
        
        function disableContactInfo(){      
                $("#companytypeid").val("");
                $("#companytypeid").attr("disabled","disabled");
                $("#contactypeid").val("");
                $("#contactypeid").attr("disabled","disabled");
        }
        
        function enableContactInfo(){       
                // $("#companytypeid").val("");
                    $("#companytypeid").removeAttr('disabled');
                  //  $("#contactypeid").val("");
                    $("#contactypeid").removeAttr('disabled');
        }
});


</script>
 
<script>
var ld=(document.all);
var Idaddcomm=(document.all);  
var Idshowtaskreport=(document.all);  
 
var ns4=document.layers;
var ns6=document.getElementById&&!document.all;
var ie4=document.all;

if (ns4) {
    ld=document.loading;
    Idaddcomm=document.addcomm;
    Idshowtaskreport=document.showtaskreport;
}else if (ns6)  {
    ld=document.getElementById("loading").style;
    Idaddcomm=document.getElementById("addcomm").style;
    Idshowtaskreport=document.getElementById("showtaskreport").style;
}else if (ie4) {
    ld=document.all.loading.style;
    Idaddcomm=document.all.addcomm.style;
    Idshowtaskreport=document.all.showtaskreport.style;
}
function init()
{
    if(ns4){
         ld.visibility="hidden";
            Idaddcomm.visibility="";
            Idshowtaskreport.visibility="";
    }
    else if (ns6||ie4) { 
     ld.display="none";
    Idaddcomm.display="block";
    Idshowtaskreport.display="block";
    }
}
</script><script type="text/javascript" language="JavaScript">
<?php if(!($this->data['CommunicationTask']['id'])) { ?>
getstateoptions('254',"Company");
 $("#zip_postal").show();     
<?php } ?>


</script>
<script type="text/javascript">
    // increase the default animation speed to exaggerate the effect
    $.fx.speeds._default = 1000;
    $(function() {
        $( "#showtaskreport" ).dialog({
            autoOpen: false,
            modal: true,
            width: 560,
            show: "blind",
            hide: "blind"
        });

       $( "#runreport" ).click(function() {  // runTaskReport();
                      
            $.ajax({
                            type: "POST",  
                            data:  $("#addcommtask").serialize() ,
                            url: baseUrlAdmin+'commtask_get_report_list_by_ajax/',
                            cache: false,
                            success: function(result){    
                                      $("#showtaskreport").html(result); 
                                         $( "#showtaskreport" ).dialog( "open" );
                                      return false; 
                            }
              });
           
          
        });
    });
        
        /**
         * Funtion addnew email template in pop-up
         */
         function addEmailTempforTask() {   
             $('#email_template_id').focus();
             var resWindow=  window.open (baseUrl+'mailtask/addsupermailcontent');
             resWindow.focus();
           }
           
          // This function is called after closing of child window ie. on page addmailtemplate.ctp 
        function GetEmailTempRefresh(){
           // alert("Refresh EMail temp dorp dwon");
            var pid='<?php echo $projectid;?>';
            var selectedid=$("#email_template_id").val();
            getemailtemplatesbyajax(pid, 'email_template_id', selectedid );
        }
        
        
         /**
         * Funtion addnew comment type in pop-up
         */
         function addCommentTypeforTask() {
             $('#relatesto_commenttype_id').focus();
             var resWindow=  window.open (baseUrlAdmin+'addcommenttype/popup', 'AddCommentType','location=1,status=1,scrollbars=1, width=950,height=650');
             resWindow.focus();
           }
           
          // This function is called after closing of child window ie. on page addcommenttype.ctp 
        function GetCommentTypeRefresh(){
            
            var pid='<?php echo $projectid;?>';
            var selectedid=$("#relatesto_commenttype_id").val();
           getcommenttypesbyajax(pid, 'relatesto_commenttype_id', selectedid );
        }
        /**
        * REfresh Comment type dropdown
        */
        function getcommenttypesbyajax(projectid,eleid, selectedid) {    
               if(projectid==""){
                  return false;
               }
                    
               jQuery.ajax({
                     type: "GET",
                     url: baseUrlAdmin+'getcommenttypesbyajax/'+projectid+'/'+selectedid,
                     cache: false,
                     success: function(rText){
                            jQuery('#'+eleid).html(rText);
                     }
             });
      
      }
        
        function runTaskReport(){
            var current_domain=$("#current_domain").val();  
                     //location = "/admins/sendtempmail/"+id;
              $.ajax({
                            type: "GET",  
                            url: 'http://'+current_domain+'/admins/commtask_get_report_list_by_ajax/all',
                            cache: false,
                            success: function(result){      
                                      $("#showtaskreport").html(result); 
                                    //   $( "#showtaskreport" ).dialog( "open" );  
                            }
              });
        }
        
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcomm").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
    
function getEmailTemplate(id){
        var current_domain=$("#current_domain").val();  

    //location = "/admins/sendtempmail/"+id;
      $.ajax({
                    url: 'http://'+current_domain+'/admins/get_email_template_details_by_ajax/'+id,
                    dataType:'json',
                    cache: false,
                    success: function(result){
                              $("#email_subject").val(result.subject);
                              $("#email_from").val(result.sender);
                    }
      });

}     

        $(document).ready(function() { 
            

       //     $("#addcomm").slideDown();
       //     $("#showtaskreport").show();
           
              
            showRecurPatternOptions();
            toggleZipPostal();
            initToggleDaySinceAndEvent();       
           
            if($("#isedit").val()=="1"){ 
                  if($("#companytypeid").val()=="" &&  $("#contactypeid").val()=="")
                {
                    toggleContactAndMemberFields();  
                }else{
                      toggleMemberFields();
                }
            }
             
               
            $("#country").change(function(){
            
              toggleZipPostal();  
           });
           
            $("#subscription_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#member_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
             $("#donation_level").change(function(){
                 toggleContactAndMemberFields();  
            });
            
                      
            $("#member_days_since").change(function(){ 
               toggleContactAndMemberFields(); 
               // alert("days since "+$("#member_days_since").val());
                // Do for days ago box =enable and disable logic
                   toggleDaySinceAndEvent();
                   
            });
            
             $("#state").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            
            $("#event_id").change(function(){    toggleDaySinceAndEvent();
               
                if($("#event_id").val()==""){
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                }else{
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").removeAttr('disabled');
                }
                     toggleContactAndMemberFields(); 
            });
            
            $("#event_rsvp_type").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#relatesto_commenttype_id").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#social_network_members").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#non_network_members").change(function(){
                 toggleContactAndMemberFields();  
            });
            
            $("#companytypeid,#contactypeid").change(function(){
                 toggleMemberFields();  
            });

            $("#recur_pattern").change(function(){
            
              showRecurPatternOptions();  
            });
        
        
          function initToggleDaySinceAndEvent(){   
                               
             if($("#member_days_since").val()=="" && $("#event_id").val()==""){    
                     $("#member_noof_days_since").val("");
                     $("#member_days_since").removeAttr('disabled'); 
                     $("#member_noof_days_since").attr("disabled","disabled");
                     
                    $("#event_id").removeAttr('disabled'); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
             }else if($("#member_days_since").val()!=""){         
                    // $("#member_noof_days_since").val("");
                    $("#member_noof_days_since").removeAttr('disabled');
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled"); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");   
             }else if($("#event_id").val()!=""){   
                  
                    $("#member_noof_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    $("#member_noof_days_since").attr("disabled","disabled");
                  //  $("#event_id").val("");
                    $("#event_id").removeAttr('disabled'); 
                   //
                   if($("#event_rsvp_type").val()==""){
                  		 $("#event_rsvp_type").val("");    
                       $("#event_rsvp_type").attr("disabled","disabled");
                   }
                   
                    
                }
        } 
        
            function toggleDaySinceAndEvent(){   
                               
             if($("#member_days_since").val()=="" && $("#event_id").val()==""){    
                     $("#member_noof_days_since").val("");
                     $("#member_days_since").removeAttr('disabled'); 
                     $("#member_noof_days_since").attr("disabled","disabled");
                     
                    $("#event_id").removeAttr('disabled'); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
             }else if($("#member_days_since").val()!=""){         
                    // $("#member_noof_days_since").val("");
                    $("#member_noof_days_since").removeAttr('disabled');
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled"); 
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");   
             }else if($("#event_id").val()!=""){   
                                                            
                    $("#member_noof_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    $("#member_noof_days_since").attr("disabled","disabled");
                  //  $("#event_id").val("");
                    $("#event_id").removeAttr('disabled'); 
                   // $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                }
        } 
        /**
        * Fuction to hide and show Zip/Postal Code Range fields depends on selected country 
        * If United States or India country is selected the show Zip/Postal Code Range field
        * Other wise hide Zip/Postal Code Range field
        */
        function toggleZipPostal(){
            var country=$("#country").val(); 
            if(country=='254' || country=='113') {
                 $("#zip_postal").show();
                  $("#member_zipcode_from").val("");
                  $("#member_zipcode_to").val("");
            }else{
                 $("#zip_postal").hide();
                  $("#member_zipcode_from").val("");
                  $("#member_zipcode_to").val("");
            }
        }
        
        /**
        * Function to Show Recurr Patter's options depends of selected   Recurre Pattern
        */
        function showRecurPatternOptions(){
            var recur_pattern=$("#recur_pattern").val();
             $("#daily_recur_pattern").hide();    
             $("#weekly_recur_pattern").hide();    
             $("#monthly_recur_pattern").hide();    
             $("#yearly_recur_pattern").hide();    
                
            if(recur_pattern=='Yearly'){
                   $("#yearly_recur_pattern").show();    
            }else if(recur_pattern=='Monthly'){
                    $("#monthly_recur_pattern").show();
            }else if(recur_pattern=='Weekly'){
                  $("#weekly_recur_pattern").show();    
            }else{
                //recur_pattern=='Daily'
                $("#daily_recur_pattern").show();    
            }
        }
        
        function toggleContactAndMemberFields(){ 
                                                   
                  // alert("relatesto_commenttype_id ="+$("#relatesto_commenttype_id").val()); 
            if($("#subscription_type").val()!="" || $("#member_type").val()!="" ||  $("#donation_level").val()!="" || $("#member_agefrom").val()!="00-00-0000" || $("#member_ageto").val()!="00-00-0000" || $("#member_days_since").val()!=""  || $("#state").val()!=""  || $("#member_zipcode_from").val()!=""  || $("#member_zipcode_to").val()!=""  || $("#event_id").val()!=""  || $("#event_rsvp_type").val()!="" || $("#relatesto_commenttype_id").val()!="" || $("#social_network_members").val()!="" || $("#non_network_members").val()!="" || $("#member_points_rangefrom").val()!="" || $("#member_points_rangeto").val()!="" )
            {
                disableContactInfo();
            }
            else
            {
                //alert("enableContactInfo");  
                enableContactInfo();
            }
            
        }
        
        function toggleMemberFields(){ 
       // alert("is_contactdisabled "+$("#is_contactdisabled").val());
                  //
            if($("#companytypeid").val()!="" ||  $("#contactypeid").val()!="")
            {
               disableMemeberInfo();
            }
            else
            {
                enableMemebrInfo();
            }
            
        }
        
        function disableMemeberInfo(){                              
             // Disable Member related Items 
                    $("#member_type").val("");
                    $("#member_type").attr("disabled","disabled");
                    
                     $("#donation_level").val("");
                    $("#donation_level").attr("disabled","disabled");
                    
                    $("#subscription_type").val("");
                    $("#subscription_type").attr("disabled","disabled");
                    
                    $("#member_agefrom").val("00-00-0000");
                    $("#member_agefrom").attr("disabled","disabled");
                    
                    $("#member_ageto").val("00-00-0000");
                    $("#member_ageto").attr("disabled","disabled");
                    
                    $("#member_days_since").val("");
                    $("#member_days_since").attr("disabled","disabled");
                    
                    $("#state").val("");
                    $("#state").removeAttr('disabled');
                    
                    $("#member_zipcode_from").val("");
                    $("#member_zipcode_from").attr("disabled","disabled");
                        
                    $("#member_zipcode_to").val("");
                    $("#member_zipcode_to").attr("disabled","disabled");
                    
                    $("#event_id").val("");
                    $("#event_id").attr("disabled","disabled");
                    
                    $("#event_rsvp_type").val("");
                    $("#event_rsvp_type").attr("disabled","disabled");
                    
                    $("#relatesto_commenttype_id").val("");
                    $("#relatesto_commenttype_id").attr("disabled","disabled");
                    
                    $("#social_network_members").val("");
                    $("#social_network_members").attr("disabled","disabled");
                    
                    $("#non_network_members").val("");
                    $("#non_network_members").attr("disabled","disabled");
                    
                    
                    
                    $("#member_points_rangefrom").val("");
                    $("#member_points_rangefrom").attr("disabled","disabled");
                    
                    $("#member_points_rangeto").val("");
                    $("#member_points_rangeto").attr("disabled","disabled");
        }
        
        function enableMemebrInfo(){   
            // Enable Member related Items 
               // $("#subscription_type").val("");
                $("#subscription_type").removeAttr('disabled');
                
                $("#member_type").removeAttr('disabled');
                
                $("#donation_level").removeAttr('disabled');
                
              //  $("#member_agefrom").val("");
                $("#member_agefrom").removeAttr('disabled');
                
              //  $("#member_ageto").val("");
                $("#member_ageto").removeAttr('disabled');
                
              //  $("#member_days_since").val("");
                $("#member_days_since").removeAttr('disabled');
                
              //  $("#state").val("");
                $("#state").removeAttr('disabled');
                
                //$("#member_zipcode_from").val("");
                $("#member_zipcode_from").removeAttr('disabled');
                    
              //  $("#member_zipcode_to").val("");
                $("#member_zipcode_to").removeAttr('disabled');
                
              //  $("#event_id").val("");
                $("#event_id").removeAttr('disabled');
                
               // $("#event_rsvp_type").val("");
               // $("#event_rsvp_type").removeAttr('disabled');
                
               // $("#relatesto_commenttype_id").val("");
                $("#relatesto_commenttype_id").removeAttr('disabled');
                
               // $("#social_network_members").val("");
                $("#social_network_members").removeAttr('disabled');
                
              //  $("#non_network_members").val("");
                $("#non_network_members").removeAttr('disabled');
                
              //  $("#relatesto_commenttype_id").val("");
                $("#relatesto_commenttype_id").removeAttr('disabled');
                
               // $("#member_points_rangefrom").val("");
                $("#member_points_rangefrom").removeAttr('disabled');
                
               // $("#member_points_rangeto").val("");
                $("#member_points_rangeto").removeAttr('disabled');  
        }
        
        
        function disableContactInfo(){      
                $("#companytypeid").val("");
                $("#companytypeid").attr("disabled","disabled");
                $("#contactypeid").val("");
                $("#contactypeid").attr("disabled","disabled");
        }
        
        function enableContactInfo(){       
                // $("#companytypeid").val("");
                    $("#companytypeid").removeAttr('disabled');
                  //  $("#contactypeid").val("");
                    $("#contactypeid").removeAttr('disabled');
        }
});


</script>
 
<script>
var ld=(document.all);
var Idaddcomm=(document.all);  
var Idshowtaskreport=(document.all);  
 
var ns4=document.layers;
var ns6=document.getElementById&&!document.all;
var ie4=document.all;

if (ns4) {
    ld=document.loading;
    Idaddcomm=document.addcomm;
    Idshowtaskreport=document.showtaskreport;
}else if (ns6)  {
    ld=document.getElementById("loading").style;
    Idaddcomm=document.getElementById("addcomm").style;
    Idshowtaskreport=document.getElementById("showtaskreport").style;
}else if (ie4) {
    ld=document.all.loading.style;
    Idaddcomm=document.all.addcomm.style;
    Idshowtaskreport=document.all.showtaskreport.style;
}
function init()
{
    if(ns4){
         ld.visibility="hidden";
            Idaddcomm.visibility="";
            Idshowtaskreport.visibility="";
    }
    else if (ns6||ie4) { 
     ld.display="none";
    Idaddcomm.display="block";
    Idshowtaskreport.display="block";
    }
}
</script>