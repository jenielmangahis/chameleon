<?php 
    echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
    echo $html->css('/css/jquery_ui_datepicker');
    echo $html->css('timepicker_plug/css/style');
?>  
<script type="text/javascript">
$(document).ready(function() {
$('#coNtact').removeClass("butBg");
$('#coNtact').addClass("butBgSelt");
$('#task_startdate').datepicker({
      showOn: "button",
      buttonImage: baseUrl+"img/calendar_new.png",
      dateFormat: 'mm-dd-yy',
      changeMonth: true,
      changeYear:true
    });
});
</script>
<?php 
        if($this->data['Contact']['id']){
			$act = 'edit';
		}else{
			$act = 'add';
		}
	$head = $PageHeading;		
	//print_r($this->data);
?>

<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-4">
            <h2><?php echo $head; ?></h2>
        </div>
        <div class="slider-dashboard col-sm-8">
        	<div class="icon-big-container">
            	<?php echo $form->create("contacts", array("action" => "sa_addcontacts",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addcontacts', 'id' => "addcontacts1","onsubmit"=>"return validatecontacts('$act');"))?>
				<?php
                $ids = $this->params['pass'][0]; 
                e($html->link($html->image('call.png') . ' ' . __(''), array('controller'=>'admins','action'=>'call',$ids),array('escape' => false)));
                
                e($html->link($html->image('email.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendtempmail',$ids),array('escape' => false)));
                
                e($html->link($html->image('sms.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendsms','1'),array('escape' => false)));
                
                
                e($html->link($html->image('message.png') . ' ' . __(''), array('controller'=>'admins','action'=>'messagenew',$ids),array('escape' => false)));
                
                e($html->link($html->image('event.png') . ' ' . __(''), array('controller'=>'admins','action'=>'appointment',$ids),array('escape' => false)));
                
                e($html->link($html->image('note.png') . ' ' . __(''), "../players/notelist/2",array('escape' => false)));
                
                e($html->link($html->image('take.png') . ' ' . __(''), array('controller'=>'admins','action'=>'coming_soon','task'),array('escape' => false))); ?>
                <button class="sendBut" id="Submit" name="redirectpage" type="submit">
                <?php e($html->image('save.png')) ?>
                </button>
                <button class="sendBut" id="Submit" name="noredirection" type="submit">
                <?php e($html->image('apply.png')) ?>
                </button>
                <?php
                if($this->params['pass'][2]==='customer')
                {
                e($html->link($html->image('cancle.png') . ' ' . __(''), array('controller'=>'relationships','action'=>'customers'),array('escape' => false)));
                }
                else
                {
                e($html->link($html->image('cancle.png') . ' ' . __(''), array('controller'=>'relationships','action'=>'sa_contactlist'),array('escape' => false)));
                } 
                
                echo $this->renderElement('new_slider');
                ?>

            </div>
        </div>
        <div class="topTabs" style="height:25px;">
      <?php /*?><ul>
        <li>
          <button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>
        </li>
        <li>
          <button class="button" id="Submit" name="noredirection" type="submit"><span> Apply</span> </button>
        </li>
        <li>
          <?php
						e($html->link(
						$html->tag('span', 'Cancel'),
						array('controller'=>'contacts','action'=>'sa_contactlist'),
						array('escape' => false)
						)
					  );
					?>
        </li>
      </ul><?php */?>
    </div>
    </div>
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont">
        <?php    $this->loginarea="contacts";    $this->subtabsel="sa_contactlist";
         echo $this->renderElement('memberlistsecondlevel_submenus');  ?> 
    </div>
</div>


<div class="midCont clearfix">
  <div id="center-column" class="clearfix">
    <?php if($session->check('Message.flash')){ ?>
    <div id="blck">
      <div class="msgBoxTopLft">
        <div class="msgBoxTopRht">
          <div class="msgBoxTopBg"></div>
        </div>
      </div>
      <div class="msgBoxBg">
        <div class="">
          <?php
						e($html->link(
								$html->image('close.png',array('style'=>'margin-left: 945px; position: absolute; z-index: 11;','alt'=>'Close')),
								'javascript:void ',
								array('escape' => false,'onclick' => "hideDiv()")
								)
							);	
					?>
          <?php  $session->flash();    ?>
        </div>
        <div class="msgBoxBotLft">
          <div class="msgBoxBotRht">
            <div class="msgBoxBotBg"></div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="responsive clearfix">
      <!-- ADD Sub Admin FORM BOF -->
      <!-- ADD FIELD BOF -->
      <table class="sa_addcontacts table table-borderless" width="100%">
        <tr>
          <td>
		  <?php
	
		  
		  if($this->params['pass'][2] === 'customer')
		  {
		  $customer = $this->params['pass'][2]; 
		echo $form->input("Contact.customer", array('id' => 'customer', 'value'=>$customer, 'type'=>'hidden', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));
		  }
		  ?>
		  
		  <?php if($session->check('Message.flash')){ $session->flash(); } 
      				 echo $form->error('Contact.company_id', array('class' => 'errormsg')); 
      				 echo $form->error('Contact.contact_type_id', array('class' => 'errormsg'));
      				 echo $form->error('Contact.firstname', array('class' => 'errormsg'));
      				 echo $form->error('Contact.lastname', array('class' => 'errormsg'));
      				 echo $form->hidden("Contact.id", array('id' => 'contactid'));
      				 echo $form->hidden("Contact.referelProject_id", array('value' => $referelProject_id));

      	?>
            <span id='companydata'></span>
		</td>
        </tr>
        
      </table>
    
    <div class="frmbox">
        <table cellspacing="10" cellpadding="0" align="center">
              <tbody>
                <tr>
                  <td align="right"><label class="boldlabel">Company <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="txtArea-top"><span class="txtArea-bot">
                    <?php 
            //var_dump($selectedcompany);
            //print_r($companydropdown);
            /*
            if($selectedcompany){
                echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
            }else{
                if($companydropdown){
                            foreach($companydropdown as $key => $value){
                                    $firstid = $key;
                                    break;
                            }
                            echo $selectedcompany = $firstid;
                            echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
                          }
                }
            */
            echo "<script type='text/javascript'>getcompanyaddress($selectedcompany);</script>";
            echo $form->select("Contact.company_id",$companydropdown,$selectedcompany,array('id' => 'company_id','class'=>'multi-list form-control',"onchange"=>"getcompanyaddress(this.value);"),"---Select---"); ?>
                    </span></span> </td>
                  
                </tr>
                <?php
                if($this->data['Contact']['id'] && $realeted_projects_flag == true) {
                ?>
                <tr>
                  <td align="right" valign="top"><label class="boldlabel">Related to Project(s)</label></td>
                  <td>
                <?php
                 //$realetedProjects = array();
                 echo $form->select('ProjectOwner.owners',$realetedProjects, null,array('multiple'=>'multiple','id'=>'companies_bb','size'=>'4','empty'=>false,'class'=>'multi-list form-control','tabindex'=>2,'style'=>'min-height:32px;','disabled'=>'disabled'));
                ?>
                </td>
                  
                </tr>
                <?php
                }
                ?>
                <tr>
                  <td align="right"><label class="boldlabel">First Name <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="intp-Span"><?php echo $form->input("Contact.firstname", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span></td>                 
                </tr>
                <tr>
                  <td align="right"><label class="boldlabel">Last Name <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="intp-Span"><?php echo $form->input("Contact.lastname", array('id' => 'lastname', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span></td>                  
                </tr>
                <tr>
                  <td align="right"><label class="boldlabel">Title <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="intp-Span"> <?php echo $form->input("Contact.jobtitle", array('id' => 'jobtitle', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></span></td>                    
                </tr>
                <?php if(!$this->data['Contact']['id']){ ?>
                <tr>
                  <td></td>
                  <td align='left' colspan="2"><?php echo $form->input('sameascompany', array('type'=>'checkbox', 'label' => '','id'=>'sameascompany','onclick'=>'return putcountryaddress();','div'=>false )); ?> Check if same as Company Address</td>
                </tr>
                <?php } ?>
                <tr>
                  <td align="right"><label class="boldlabel">Address <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="intp-Span"><?php echo $form->input("Contact.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>                
                </tr>
                <tr>
                  <td align="right"><label class="boldlabel">Country <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="txtArea-top"><span class="txtArea-bot"> <?php echo $form->select("Contact.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multi-list form-control','onchange'=>'return getstateoptions(this.value,"Contact")'),array('254'=>'United States')); ?> </span></span></td>
                </tr>
                <tr>
                  <td align="right"><label class="boldlabel">State <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="txtArea-top"><span class="txtArea-bot"> <span id="statediv"> <?php echo $form->select("Contact.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multi-list form-control'),"---Select---"); ?> </span></span> </span> </td>
                </tr>
                <tr>
                  <td align="right"><label class="boldlabel">City <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="intp-Span"> <?php echo $form->input("Contact.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150")); ?></span></td>
                </tr>
                <tr>
                  <td align="right"><label class="boldlabel">Zip/Postal Code <span class="red">*</span></label></td>
                  <td><label for="project_name"></label>
                    <span class="intp-Span"> <?php echo $form->input("Contact.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "10"));?></span></td>
                </tr>
                <tr>
                  <td colspan="5"><b>Any item with a</b> "<span class="red">*</span>" <b>requires an entry.</b></td>
                </tr>
              </tbody>
            </table>
    </div>
    <div class="frmbox2">
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
							<td align="right" width="140px"><label class="boldlabel">Recur Pattern</label></td>
							<td><span class="txtArea-top"> <span class="txtArea-bot"> <span
										id="countrydiv">
										 <?php echo $form->
										 select("CommunicationTask.recur_pattern",$recur_pattern,$sel_recur_pattern,array('id' => 
										 'recur_pattern',"class"=>"multi-list form-control"),false); ?>
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
							<td><span class="intp-Span"><?php
							if($this->data['CommunicationTask']['task_startdate']!=""){
							$task_startdate= $this->data['CommunicationTask']['task_startdate'];
					}else{
						   $task_startdate= date('m-d-Y');
					}
		   echo $form->text("CommunicationTask.task_startdate", array('id' => 'task_startdate', 'div' => false, 'label' => '',"class"=>"inpt-txt-fld form-control","maxlength" => "200","style" => "width:200px", 'value'=>$task_startdate,'readonly'=>'readonly'));?></span>
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
								By: <span class="intp-Span"><?php echo $form->text("CommunicationTask.task_end_by_date", array('id' => 'task_end_by_date', 'div' => false, 'label' => '',"class"=>"inpt-txt-fld form-control","maxlength" => "200","style" => "width:160px",'readonly'=>'readonly'));?>
							</span></td>
						</tr>
						<tr>
							<td align="right" width="140px"><label class="boldlabel">Note</label>
							</td>
							<td><span class="txtArea-top"> <span class="txtArea-bot"><?php echo $form->input("CommunicationTask.task_note", array('id' => 'task_note', 'div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'form-control noBg'));?>
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
							<td><span class="btn-Lft">
									<button name="runreport" id="runreport" class="btn-Rht btn btn-primary btn-sm"
										value="RunReport" type="button">Run Report</button>
							</span></td>
						</tr>



					</tbody>
				</table>
    </div>
      
      <?php echo $form->end();?>
      <!-- ADD Sub Admin  FORM EOF -->
    </div>
    <br>
  </div>
</div>
<!--inner-container ends here-->
<div class="clear"></div>
</div>
<!--container ends here-->
<script language='javascript'>
<?php if((!$this->data['Contact']['id'])) { ?>
getstateoptions('254',"Contact"); <?php } ?>

	$("#contact_type_id").change(function () {
		var str;
		str = $("#contact_type_id").val();
        //alert(str);
		loadContactLoginDetails(str);
		
	});
	
	function loadContactLoginDetails(str) {
		var cid = {id : str};
        $.ajax({
			type:"POST",
			url: baseUrl+"contacts/getcontact_projectLead_ajax",
			cache:false,
			data:cid,
			success: function(output){
				//alert(output);
				if(output == 1) 
				$("#ProjectLoginDet").show();
				else
				$("#ProjectLoginDet").hide();
			}
		});
	}
	
	var cID = $("#contact_type_id").val();
	var dID = $("#defaultContactType").val();
	if(cID == dID)
	$("#ProjectLoginDet").show();
	
	
	
/*function USPhoneNumberFormat(PhoneNumberInitialString)
  {
    var FmtStr="";
    var index = 0;
    var LimitCheck;

    LimitCheck = PhoneNumberInitialString.length;
    while (index != LimitCheck)
      {
        if (isNaN(parseInt(PhoneNumberInitialString.charAt(index))))
          { }
        else
          { FmtStr = FmtStr + PhoneNumberInitialString.charAt(index); }
        index = index + 1;
      }
    if (FmtStr.length == 10)
      {
        FmtStr = FmtStr.substring(0,3) + "-" + FmtStr.substring(3,6) + "-" + FmtStr.substring(6,10);
		$('#busphone').val(FmtStr);
      }
    else
      {
        FmtStr=PhoneNumberInitialString;
        inlineMsg('busphone','<strong>United States phone numbers must have exactly ten digits.</strong>',2);
		 return false; 
      }
    return FmtStr;
  }*/

 function USPhoneNumberFormat(PhoneNumberInitialString){
	var oRex = /^\(?([0-9]{3})+\)?[\-\s]?([0-9]{3})+[\-\s]?([0-9]{4})+$/; 
	if($('#busphone').val() ==''){
		return true;
	}else if($('#busphone').val() !=''){
		if(oRex.test(PhoneNumberInitialString)){
			return true;
		}else{
			inlineMsg('busphone','<strong>Please use valid phone format.</strong>',2);
			document.getElementById('busphone').focus();	
			return false;
		}
	}
	
  }
 function USFaxNumberFormat(PhoneNumberInitialString){
	var oRex = /^\(?([0-9]{3})+\)?[\-\s]?([0-9]{3})+[\-\s]?([0-9]{4})+$/; 
	if($('#fax').val() ==''){
		return true;
	}else if($('#fax').val() !=''){
		if(oRex.test(PhoneNumberInitialString)){
			return true;
		}else{
			inlineMsg('fax','<strong>Please use valid fax format.</strong>',2);
			this.focus();
			return false;
		}
	}

  } 
  function USCellphoneNumberFormat(PhoneNumberInitialString){
	var oRex = /^\(?([0-9]{3})+\)?[\-\s]?([0-9]{3})+[\-\s]?([0-9]{4})+$/; 
	if($('#mobile').val() ==''){
		return true;
	}else if($('#mobile').val() !=''){
		if(oRex.test(PhoneNumberInitialString)){
			return true;
		}else{
			inlineMsg('mobile','<strong>Please use valid Cell Phone number format.</strong>',2);
			document.getElementById('mobile').focus();	
			return false;
		}
	}	
  }
/*  function USFaxNumberFormat(PhoneNumberInitialString)
  {
    var FmtStr="";
    var index = 0;
    var LimitCheck;

    LimitCheck = PhoneNumberInitialString.length;
    while (index != LimitCheck)
      {
        if (isNaN(parseInt(PhoneNumberInitialString.charAt(index))))
          { }
        else
          { FmtStr = FmtStr + PhoneNumberInitialString.charAt(index); }
        index = index + 1;
      }
    if (FmtStr.length == 10)
      {
        FmtStr = FmtStr.substring(0,3) + "-" + FmtStr.substring(3,6) + "-" + FmtStr.substring(6,10);
		$('#fax').val(FmtStr);
      }
    else
      {
        FmtStr=PhoneNumberInitialString;
        inlineMsg('fax','<strong>United States fax numbers must have exactly ten digits.</strong>',2);
		 return false; 
      }
    return FmtStr;
  }*/
</script>
