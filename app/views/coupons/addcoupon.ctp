<?php  
$base_url_admin = Configure::read('App.base_url_admin');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'coupons/couponlist';
echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
echo $html->css('/css/jquery_ui_datepicker');
echo $html->css('timepicker_plug/css/style');

// echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
// echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');


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
	if($sel_stime==$convertval){
		$sel_st='selected="selected"';
	}
	$sel_et='';
	if($sel_etime==$convertval){
		$sel_et='selected="selected"';
	}
	//   echo "<br/> ".$i." -- > ".$convertshow." -->".$convertval;
	$option_stime.='<option value="'.$convertval.'" '.$sel_st.'>'.$convertshow.'</option>';
	$option_etime.='<option value="'.$convertval.'" '.$sel_et.'>'.$convertshow.'</option>';
	$timeopt[$convertval]  = $convertshow;
	$stime  =  strtotime("+30 minutes", $stime);
}
?>
<script language="javascript" type="text/javascript">

$('#CouponMenu').removeClass("butBg");
		$('#CouponMenu').addClass("butBgSelt");

var formChanged = false;

$(document).ready(function() {
	
		

     $('#addoffer input[type=text].editable, #addoffer textarea.editable').each(function (i) {
          $(this).data('initial_value', $(this).val());
     });

     $('#addoffer input[type=text].editable, #addoffer textarea.editable').keyup(function() {
          if ($(this).val() != $(this).data('initial_value')) {
               handleFormChanged();
          }
     });

     $('#addoffer .editable').bind('change paste', function() {
          handleFormChanged();
     });
/*
     $('.navigation_link').bind("click", function () {
          return confirmNavigation();
     });
     */
});

function handleFormChanged() {
     //$('#save_or_update').attr("disabled", false);
     formChanged = true;
     alert("changed");
}

function confirmNavigation() {
     if (formChanged) {
          return confirm('Are you sure? Your changes will be lost!');
     } else {
          return true;
     }
}

  
        
function update_content_page_list()
{
    //alert("In");
   var current_domain=$("#current_domain").val();
            $('.show_content_page_list').load(baseUrlAdmin+'update_content_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_content_page_list').fadeIn(1000); 

            }); 
         
}

function update_email_page_list()
{
    
   var current_domain=$("#current_domain").val();
        /*    $('.show_email_page_list').load('http://'+current_domain+'/admins/update_email_page_list/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('.show_email_page_list').fadeIn(1000); 

            }); 
            */
        var url=baseUrlAdmin+'update_email_page_list/';
            $.ajax({
          type: 'GET',
          url: url,
          dataType: "html",
          success: function(data){
                $('#rsvp_email').html(data);
              }
        });
         
}

function create_csv()
{
    //alert("in");
    var current_domain=$("#current_domain").val();
    var selected_for_invitations=$("#selected_for_invitations").val();
    var url=baseUrlAdmin+'create_invitation_csv/';
    //console.log(url);
    $.ajax({
          type: 'GET',
          url: url,
          data: 'selected_for_invitations='+selected_for_invitations,
          dataType: "json",
          success: function(data){
                //alert("success");
                window.open("http://localhost:9090/output.csv");
              }
        });
}
</script>

<style type="text/css">

.ui-datepicker-trigger {
	position: absolute;
	background: none;
	margin-left: 5px;
}

.updat {
	display: inline-block;
	margin-bottom: 10px;
	margin-right: 16px;
	text-align: right;
	vertical-align: top;
	width: 190px;
}
</style>

<script type="text/javascript">

     /* <![CDATA[ */
     var dateobj = new Date();
    var currDate  = dateobj.getFullYear();
    var rangeDate=parseInt(currDate+10);
        $(function() {
                    
                    $('#starttime').datepicker({
                    showOn: "button",

					buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    minDate:0
                    //yearRange: currDate+':'+rangeDate 
                });
                
                $('#endtime').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    minDate:0
                     //yearRange: currDate+':'+rangeDate 
                });
                
                $('#end_by_date').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    minDate:0
                     //yearRange: currDate+':'+rangeDate 
                });
                $('#coupon_startdate').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    minDate:0
                     //yearRange: currDate+':'+rangeDate 
                });
               
          });
      /* ]]> */

       function validateoffer(){
           //alert("validateoffer");
             
             if(trim($('#offer_type').val()) == "")
             {
                 inlineMsg('offer_type','<strong>Coupon Type required.</strong>',2);
                 return false;
             }

            
			 if(trim($('#offer_title').val()) == '')
             {
                 inlineMsg('offer_title','<strong>Coupon title required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#offer_title').val()) == true){
                 inlineMsg('offer_title','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             }

            var ot = $('#offer_type').val();
            if((trim($('#coupon_cost').val()) == '' && trim($('#coupon_value').val()) == '') && (ot==1 || ot==2 || ot==3 || ot==4 || ot==5 || ot==6 ))
	        {
	               inlineMsg('coupon_value','<strong>Coupon Cost/Value required.</strong>',2);
	               return false;
	        }
            
			 
             
             if(trim($('#starttime').val()) == '')
             {
                 inlineMsg('starttime','<strong>Coupon starttime required.</strong>',2);
                 return false;
             }
             
             if(tagValidate($('#starttime').val()) == true){
                 inlineMsg('starttime','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
			 
			 
			 if(trim($('#endtime').val()) == '')
             {
                 inlineMsg('endtime','<strong>Coupon starttime required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#endtime').val()) == true){
                 inlineMsg('endtime','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
             
              
              
             //alert($("#recur_pattern").val());
             
              if ($("#recur_pattern").val()=="Daily")
              {
                  
                  if ($("#everyday").is(':checked'))
                  {
                      if(trim($('#daily_every_noof_days').val()) == "" || trim($('#daily_every_noof_days').val()) == 0)
                      {                        
                            inlineMsg('daily_every_noof_days','<strong>This field is required.</strong>',2);
                            return false;
                      }
                  }
                    
              }
              
              if ($("#recur_pattern").val()=="Weekly")
              {
         
                  if(trim($('#weekly_every_noof_weeks ').val()) == "" || trim($('#weekly_every_noof_weeks').val()) == 0)
                  {                        
                        inlineMsg('weekly_every_noof_weeks','<strong>This field is required.</strong>',2);
                        return false;
                  }
                  if($('#weekly_monday').is(':checked')==false && $('#weekly_monday').is(':checked')==false && $('#weekly_tuesday').is(':checked')==false && $('#weekly_wednesday').is(':checked')==false && $('#weekly_thursday').is(':checked')==false && $('#weekly_friday').is(':checked')==false && $('#weekly_saturday').is(':checked')==false && $('#weekly_sunday').is(':checked')==false)
                  {
                      inlineMsg('recur_pattern','<strong>Please select atleast one weekday from below.</strong>',2);
                      return false;
                  }
                    
              }
              
              if ($("#recur_pattern").val()=="Monthly")
              {
                  
                  if ($("#dayofeverymonth").is(':checked'))
                  {
                      if(trim($('#monthly_onof_day').val()) == "" || trim($('#monthly_onof_day').val()) == 0 || trim($('#monthly_onof_day').val())>31 )
                      {                        
                            inlineMsg('monthly_onof_day','<strong>This field is required.Use Day between 1 and 31</strong>',2);
                            return false;
                      }
                      if(trim($('#monthly_every_noof_months').val()) == "" || trim($('#monthly_every_noof_months').val()) == 0 )
                      {                        
                            inlineMsg('monthly_every_noof_months','<strong>This field is required.</strong>',2);
                            return false;
                      }
                      if(trim($('#monthly_onof_day').val()) == "30" || trim($('#monthly_onof_day').val()) == "31")
                      {                        
                            alert("For the month where there is no 30th or 31st,offer will occur on last day of month");
                      }
                  }
                  if ($("#weekdayofeverymonth").is(':checked'))
                  {
                      if(trim($('#monthly_weekof_noof_months').val()) == "" || trim($('#monthly_weekof_noof_months').val()) == 0 )
                      {                        
                            inlineMsg('monthly_weekof_noof_months','<strong>This field is required.</strong>',2);
                            return false;
                      }
                  }
                    
              }
              if ($("#recur_pattern").val()=="Yearly")
              {
                  
                  if ($("#everynoofmonths").is(':checked'))
                  {
                      if(trim($('#yearly_everymonth_date').val()) == "" || trim($('#yearly_everymonth_date').val()) == 0 || trim($('#yearly_everymonth_date').val())>31 )
                      {                        
                            inlineMsg('yearly_everymonth_date','<strong>This field is required.Use Day between 1 and 31</strong>',2);
                            return false;
                      }   
                  }                  
                    
              }
              
              if ($("#recur_pattern").val()=="Yearly" || $("#recur_pattern").val()=="Monthly" || $("#recur_pattern").val()=="Weekly" || $("#recur_pattern").val()=="Daily")
              {
                  if($('#recur_range').is(':checked'))
                  {                                  
                      $('#end_by_date').val('');
                      $('#coupon_end_after_occurrences').val('');                      
                                                
                  }
                  
                  if($('#after_accurrences').is(':checked'))
                  {                                  
                      if(trim($('#coupon_end_after_occurrences').val()) == "" || trim($('#coupon_end_after_occurrences').val()) <=0 || trim($('#coupon_end_after_occurrences').val())>30)
                      {                        
                            inlineMsg('coupon_end_after_occurrences','<strong>This field is required.Max 30 are allowed</strong>',2);
                            return false;
                      }
                                                
                  }
                  if($('#by_date').is(':checked'))
                  {                                  
                      if(trim($('#end_by_date').val()) == "" || trim($('#end_by_date').val()) =="0000-00-00")
                      {                        
                            inlineMsg('end_by_date','<strong>This field is required.</strong>',2);
                            return false;
                      }
                      
                      var sdate= ($('#starttime').val()).split("-");
                      var edate= ($('#end_by_date').val()).split("-");   
                      var startDate = new Date(sdate[2], sdate[0], sdate[1]); 
                      var endDate = new Date(edate[2], edate[0], edate[1]);
                  
                   
                      if (endDate < startDate) {
                          inlineMsg('end_by_date','<strong>The end date must come equal or after start date.</strong>',2);
                         return false; 
                      }
                      
                      
                          var stime= ($('#stime').val()).split(" ");
                          var etime= ($('#etime').val()).split(" ");
                          var sap=stime[1];
                          var eap=etime[1];
                           
                           if(sap=="am" && eap=="pm"){      
                                // return true;
                           }else if((sap=="am" && eap=="am") || (sap=="pm" && eap=="pm")){  
                                 var shr=(stime[0]).split(":");
                                 var ehr=(etime[0]).split(":");  
                                 //alert(startDate.toDateString()+" "+endDate);
                                 if(startDate.toDateString()===endDate.toDateString())
                                 {
                                     if(ehr[0]< shr[0] && shr[0]!=12 )
                                     {  
                                        inlineMsg('etime','<strong>End time cannot be before start time for same date.</strong>',2);
                                        return false; 
                                     }else if(ehr[0]==shr[0])
                                     {   
                                           if(ehr[1]<= shr[1] )
                                           {              
                                                    inlineMsg('etime','<strong>End time cannot be before or equal to start time for same date.</strong>',2);
                                                    return false; 
                                           }
                                     }
                                 }
                               
                           }else if(sap=="pm" && eap=="am"){     
                               inlineMsg('etime','<strong>End time cannot be before strat time.</strong>',2);
                               return false;
                           } 
                                  
                      
                                                
                  }
                  
                  
                  
              }
           
        
        if ($("#recur_pattern").val()!="Yearly" && $("#recur_pattern").val()!="Monthly" && $("#recur_pattern").val()!="Weekly" && $("#recur_pattern").val()!="Daily")
              {
                  
                   if(trim($('#endtime').val()) == '')
                     {
                         inlineMsg('endtime','<strong>Offer endtime required.</strong>',2);
                         return false;
                     }
                     if(tagValidate($('#endtime').val()) == true){
                         inlineMsg('endtime','<strong>Please dont use script tags.</strong>',2);
                         return false; 
                     }
             
                  
                 var sdate= ($('#starttime').val()).split("-");
                 var edate= ($('#endtime').val()).split("-");   
                 var startDate = new Date(sdate[2], sdate[0], sdate[1]); 
                 var endDate = new Date(edate[2], edate[0], edate[1]);
               
                  if (endDate < startDate) {
                      inlineMsg('endtime','<strong>The end date must come equal or after start date.</strong>',2);
                     return false; 
                  }
              
              
                   
              var stime= ($('#stime').val()).split(" ");
              var etime= ($('#etime').val()).split(" ");
               var sap=stime[1];
               var eap=etime[1];
               
               if(sap=="am" && eap=="pm"){      
                    // return true;
               }else if((sap=="am" && eap=="am") || (sap=="pm" && eap=="pm")){  
                     var shr=(stime[0]).split(":");
                     var ehr=(etime[0]).split(":");  
                     //alert(startDate.toDateString()+" "+endDate);
                     if(startDate.toDateString()===endDate.toDateString())
                     {
                         if(ehr[0]< shr[0] && shr[0]!=12 )
                         {  
                            inlineMsg('etime','<strong>End time cannot be before start time for same date.</strong>',2);
                            return false; 
                         }else if(ehr[0]==shr[0])
                         {   
                               if(ehr[1]<= shr[1] )
                               {              
                                        inlineMsg('etime','<strong>End time cannot be before or equal to start time for same date.</strong>',2);
                                        return false; 
                               }
                         }
                     }
                   
               }else if(sap=="pm" && eap=="am"){     
                   inlineMsg('etime','<strong>End time cannot be before strat time.</strong>',2);
                   return false;
               } 
               }          
           return true;
       }
        
    </script>

<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Coupon Add/Edit</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Coupon", array("action" => "addcoupon",'type' => 'file', "onsubmit"=>"return validateoffer('$act');"));
				echo $form->hidden("Coupon.id");
				?>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
				<?php e($html->image('save.png')); ?></button>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
				<?php e($html->image('apply.png')); ?></button>
				<button type="button" id="saveForm" class="sendBut" onclick="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
				</button>
				<?php  echo $this->renderElement('new_slider');  ?>	
            </div>
                <input type="hidden"
                id="current_domain" name="current_domain"
                value="<?php echo $current_domain; ?>">
            <?php if(!empty($params)) echo $form->hidden("params", array('id' => 'params','value'=>"$params"));?>
        </div>
    </div>

</div>

<!--rightpanel ends here-->

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="coupons";    $this->subtabsel="couponlist";
             echo $this->renderElement('coupons_submenus');  ?>
    </div>
</div> 

<!--inner-container starts here-->
<!-- ADD Sub Admin FORM BOF -->
<!-- ADD FIELD BOF -->
<br>
<!--<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar"></div>-->

<div class="midCont clearfix">
	<?php if($session->check('Message.flash')){ ?>
	<div id="blck">
		<div class="msgBoxTopLft">
			<div class="msgBoxTopRht">
				<div class="msgBoxTopBg"></div>
			</div>
		</div>
		<div class="msgBoxBg">
			<div class="">
				<a href="#." onclick="hideDiv();"><img src="/img/close.png" alt=""
					style="margin-left: 945px; position: absolute; z-index: 11;" /> </a>
				<?php  $session->flash(); echo $form->error('Coupon.title', array('class' => 'msgTXt'));?>
			</div>
			<div class="msgBoxBotLft">
				<div class="msgBoxBotRht">
					<div class="msgBoxBotBg"></div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
    
    <div class="frmbox">
    	<table cellspacing="5" cellpadding="0">

					<tr>
						<td colspan="5"><?php if($session->check('Message.flash')){ 
							$session->flash();
						}
						echo $form->hidden("Project.projectname", array('id' => 'projectname','value'=>"$projectname"));
						?>
						</td>
					</tr>


					<tr id="row_offername">
						<td>
							<div class="updat">
								<label class="boldlabel">Coupon Name<span style="color: red;">*</span>
								</label>
							</div>
						</td>
						<td><span class="intp-Span"><?php echo $form->input("title", array('id' => 'offer_title','div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
						</span></td>
					</tr>

					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Coupon Type <span style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php 
						echo $form->select("type",$coupontypedropdown,$selectedcoupontype, array('div' => false, 'label' => '','style' =>' margin-bottom: 6px; width:100%;',"class" =>"form-control","maxlength" => "250"),"---Select---");
						?>
							</span>
						</span></td>
					</tr>


					<tr class="row_coupon">
						<td>
							<div class="updat">
								<label class="boldlabel">#Coupons<span style="color: red;">*</span>
								</label>
							</div>
						</td>
						<td>
							<table align="center" style="vertical-align: middle;">
								<tr>
									<td><span class="intp-Span"> <?php echo $form->input("coupons", array('div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
									</span></td>
									<td style="vertical-align:top"><label class="boldlabel">&nbsp;#Start</label>
									</td>
									<td><span class="intp-Span"> <?php echo $form->input("start", array('id' => 'coupon_value', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
									</span></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr class="row_coupon">
						<td>
							<div class="updat">
								<label class="boldlabel">Coupon Cost<span style="color: red;">*</span>
								</label>
							</div>
						</td>
						<td>
							<table align="center" style="vertical-align: middle;">
								<tr>
									<td><span class="intp-Span"> <?php echo $form->input("coupon_cost", array('id' => 'coupon_cost', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
									</span></td>
									<td><label class="boldlabel" style="padding-right:1px;vertical-align: middle;">&nbsp;$ Value<span style="color: red;">*</span>
									</label></td>
									<td><span class="intp-Span"> <?php echo $form->input("coupon_value", array('id' => 'coupon_value', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
									</span></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr class="row_discount">
						<td>
							<div class="updat">
								<label class="boldlabel">Discount % </label>
							</div>
						</td>
						<td>
							<table align="center" style="vertical-align: middle;">
								<tr>
									<td><span class="intp-Span"><?php echo $form->input("percent_discount", array('id' => 'percent_discount', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
									</span></td>

									<td><label class="boldlabel" style="vertical-align: middle;">&nbsp;OR&nbsp;$&nbsp;</label></td>
									<td><span class="intp-Span"><?php echo $form->input("fixed_discount", array('id' => 'fixed_discount', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
									</span></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr class="row_min_pur">
						<td>
							<div class="updat">
								<label class="boldlabel">Minimum Purchase</label>
							</div>
						</td>
						<td><span class="intp-Span"><?php echo $form->input("minimum_purchase", array('id' => 'minimum_purchase', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
						</span></td>
					</tr>



					<tr id="row_recurpattern">
						<td>
							<div class="updat">
								<label class="boldlabel">Recur Pattern </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"> <span
									id="countrydiv"> <?php echo $form->select("recur_pattern",$recur_pattern,null,array('id' => 'recur_pattern',"class"=>"multi-list form-control"),"--Select--"); ?>
								</span>
							</span>
						</span></td>
					</tr>

					<tr id="row_startdate">
						<td>
							<div class="updat">
								<label class="boldlabel">Start Date <span style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td><span class="intp-Span middle"><?php echo $form->text("starttime", array('id' => 'starttime', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly'));?>
						</span></td>
					</tr>

					<tr id="row_enddate">

						<td>
							<div class="updat" id="end_date_name" style="display: none;">
								<label class="boldlabel">End Date <span style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td>
							<div id="end_date_field" style="display: none;">
								<span class="intp-Span middle"><?php echo $form->text("endtime", array('id' => 'endtime', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly'));?>
								</span>
							</div>
						</td>
					</tr>

					<tr id="row_recurpatterns" style="display: none;">
						<td>&nbsp;</td>
						<td>
							<div id="daily_recur_pattern" style="display: none;">
								<table>
									<tbody>
										<tr>
											<td><?php if($this->data['Coupon']['daily_every_noof_days']!=""){  
												$daily_every_noof_days=$this->data['Coupon']['daily_every_noof_days'];
											}
											else{ $daily_every_noof_days=1;
}?>
												<div>
													<input type="radio" name='data[Coupon][daily_pattern]'
														checked="checked" id="everyday" value='everyday'
														<?php if($this->data['Coupon']['daily_pattern']=='everyday'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Every
													<?php echo $form->text("daily_every_noof_days", array('id' => 'daily_every_noof_days', 'div' => false, 'label' => '','value' => $daily_every_noof_days,"style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?>
													<span></span> Day(s)
												</div> <br />
												<div>
													<input type='radio' name='data[Coupon][daily_pattern]'
														id="everyweek" value='everyweek'
														<?php if($this->data['Coupon']['daily_pattern']=='everyweek'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Every
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

											<td><?php if($this->data['Coupon']['weekly_every_noof_weeks']!=""){  
												$weekly_every_noof_weeks=$this->data['Coupon']['weekly_every_noof_weeks'];
											}else{ $weekly_every_noof_weeks=1;
}?> Recur every <?php echo $form->text("weekly_every_noof_weeks", array('id' => 'weekly_every_noof_weeks', 'div' => false, 'label' => '', 'value' => $weekly_every_noof_weeks, "style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?>
												week(s) on: <?php echo $form->input('weekly_monday', array('type'=>'checkbox','id'=>'weekly_monday', 'label' => ' Monday')); ?>
												<?php echo $form->input('weekly_tuesday', array('type'=>'checkbox','id'=>'weekly_tuesday', 'label' => ' Tuesday')); ?>
												<?php echo $form->input('weekly_wednesday', array('type'=>'checkbox','id'=>'weekly_wednesday', 'label' => ' Wednesday')); ?>
												<?php echo $form->input('weekly_thursday', array('type'=>'checkbox','id'=>'weekly_thursday', 'label' => ' Thursday')); ?>
												<?php echo $form->input('weekly_friday', array('type'=>'checkbox','id'=>'weekly_friday', 'label' => ' Friday')); ?>
												<?php echo $form->input('weekly_saturday', array('type'=>'checkbox','id'=>'weekly_saturday', 'label' => ' Saturday')); ?>
												<?php echo $form->input('weekly_sunday', array('type'=>'checkbox','id'=>'weekly_sunday', 'label' => ' Sunday')); ?>

											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div id="monthly_recur_pattern" style="display: none;">
								<table>
									<tbody>
										<tr>

											<td>
												<div>
													<input type="radio" name='data[Coupon][monthly_pattern]'
														checked="checked" id="dayofeverymonth"
														value='dayofeverymonth'
														<?php if($this->data['Coupon']['monthly_pattern']=='dayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Day
													<?php 
													if($this->data['Coupon']['monthly_onof_day']!=""){
$monthly_onof_day=$this->data['Coupon']['monthly_onof_day'];
}else{ $monthly_onof_day=date('d');
}
if($this->data['Coupon']['monthly_every_noof_months']!=""){
$monthly_every_noof_months=$this->data['Coupon']['monthly_every_noof_months'];
}else{ $monthly_every_noof_months=1;
}
?>
													<?php echo $form->text("monthly_onof_day", array('id' => 'monthly_onof_day', 'div' => false, 'label' => '','value' => $monthly_onof_day,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?>
													of every
													<?php echo $form->text("monthly_every_noof_months", array('id' => 'monthly_every_noof_months', 'div' => false, 'label' => '','value' => $monthly_every_noof_months,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?>
													month(s)
												</div> <br />
												<div>
													<input type='radio' name='data[Coupon][monthly_pattern]'
														id="weekdayofeverymonth" value='weekdayofeverymonth'
														<?php if($this->data['Coupon']['monthly_pattern']=='weekdayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;
													The &nbsp; <select style="border: 1px solid black;"
														name="data[Coupon][monthly_weeknumber]">
														<option value="first"
														<?php if($this->data['Coupon']['monthly_weeknumber']=='first'){  echo ' selected="selected" ';}else{ echo ' ';}?>>first</option>
														<option value="second"
														<?php if($this->data['Coupon']['monthly_weeknumber']=='second'){  echo ' selected="selected" ';}else{ echo ' ';}?>>second</option>
														<option value="third"
														<?php if($this->data['Coupon']['monthly_weeknumber']=='third'){  echo ' selected="selected" ';}else{ echo ' ';}?>>third</option>
														<option value="fourth"
														<?php if($this->data['Coupon']['monthly_weeknumber']=='fourth'){  echo ' selected="selected" ';}else{ echo ' ';}?>>fourth</option>
														<option value="last"
														<?php if($this->data['Coupon']['monthly_weeknumber']=='last'){  echo ' selected="selected" ';}else{ echo ' ';}?>>last</option>
													</select> <select style="border: 1px solid black;"
														name="data[Coupon][monthly_weekday]">
														<option value="Monday"
														<?php if($this->data['Coupon']['monthly_weekday']=='Monday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Monday</option>
														<option value="Tuesday"
														<?php if($this->data['Coupon']['monthly_weekday']=='Tuesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Tuesday</option>
														<option value="Wednesday"
														<?php if($this->data['Coupon']['monthly_weekday']=='Wednesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Wednesday</option>
														<option value="Thursday"
														<?php if($this->data['Coupon']['monthly_weekday']=='Thursday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Thursday</option>
														<option value="Friday"
														<?php if($this->data['Coupon']['monthly_weekday']=='Friday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Friday</option>
														<option value="Saturday"
														<?php if($this->data['Coupon']['monthly_weekday']=='Saturday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Saturday</option>
														<option value="Sunday"
														<?php if($this->data['Coupon']['monthly_weekday']=='Sunday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Sunday</option>
													</select> <br /> <br />&nbsp; &nbsp; of every &nbsp;
													<?php 
													if($this->data['Coupon']['monthly_weekof_noof_months']!=""){
$monthly_weekof_noof_months=$this->data['Coupon']['monthly_weekof_noof_months'];
}else{ $monthly_weekof_noof_months=1;
}
echo $form->input("monthly_weekof_noof_months", array('id' => 'monthly_weekof_noof_months','div' => false, 'label' => '','value' => $monthly_weekof_noof_months,'style'=>'border: 1px solid black;width:30px;'));?>
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

											<td><?php if($this->data['Coupon']['yearly_everymonth_date']!=""){  
												$yearly_everymonth_date=$this->data['Coupon']['yearly_everymonth_date'];
											}else{ $yearly_everymonth_date=date('d');
}?> <input type="radio" value="everynoofmonths" id="everynoofmonths"
												checked="checked" name="data[Coupon][yearly_pattern]"
												<?php if($this->data['Coupon']['yearly_pattern']=='everynoofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
												Every &nbsp; <select id="yearly_everymonth"
												name="data[Coupon][yearly_everymonth]"
												style="border: 1px solid black;">
													<option value="January"
													<?php if($this->data['Coupon']['yearly_everymonth']=='January'){  echo ' selected="selected" ';}else{ echo ' ';}?>>January</option>
													<option value="February"
													<?php if($this->data['Coupon']['yearly_everymonth']=='February'){  echo ' selected="selected" ';}else{ echo ' ';}?>>February</option>
													<option value="March"
													<?php if($this->data['Coupon']['yearly_everymonth']=='March'){  echo ' selected="selected" ';}else{ echo ' ';}?>>March</option>
													<option value="April"
													<?php if($this->data['Coupon']['yearly_everymonth']=='April'){  echo ' selected="selected" ';}else{ echo ' ';}?>>April</option>
													<option value="May"
													<?php if($this->data['Coupon']['yearly_everymonth']=='May'){  echo ' selected="selected" ';}else{ echo ' ';}?>>May</option>
													<option value="June"
													<?php if($this->data['Coupon']['yearly_everymonth']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
													<option value="July"
													<?php if($this->data['Coupon']['yearly_everymonth']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
													<option value="August"
													<?php if($this->data['Coupon']['yearly_everymonth']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
													<option value="September"
													<?php if($this->data['Coupon']['yearly_everymonth']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
													<option value="October"
													<?php if($this->data['Coupon']['yearly_everymonth']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
													<option value="November"
													<?php if($this->data['Coupon']['yearly_everymonth']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
													<option value="December"
													<?php if($this->data['Coupon']['yearly_everymonth']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>
											</select> &nbsp;<?php echo $form->input("yearly_everymonth_date", array('id' => 'yearly_everymonth_date','div' => false, 'label' => '', 'value' => $yearly_everymonth_date,'style'=>'border: 1px solid black;width:30px;'));?><br />
												<br /> <input type="radio" value="theweekofmonths"
												id="theweekofmonths" name="data[Coupon][yearly_pattern]"
												<?php if($this->data['Coupon']['yearly_pattern']=='theweekofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
												The &nbsp; <select id="yearly_weeknumber"
												name="data[Coupon][yearly_weeknumber]"
												style="border: 1px solid black;">
													<option value="first"
													<?php if($this->data['Coupon']['yearly_weeknumber']=='first'){  echo ' selected="selected" ';}else{ echo ' ';}?>>first</option>
													<option value="second"
													<?php if($this->data['Coupon']['yearly_weeknumber']=='second'){  echo ' selected="selected" ';}else{ echo ' ';}?>>second</option>
													<option value="third"
													<?php if($this->data['Coupon']['yearly_weeknumber']=='third'){  echo ' selected="selected" ';}else{ echo ' ';}?>>third</option>
													<option value="fourth"
													<?php if($this->data['Coupon']['yearly_weeknumber']=='fourth'){  echo ' selected="selected" ';}else{ echo ' ';}?>>fourth</option>
													<option value="last"
													<?php if($this->data['Coupon']['yearly_weeknumber']=='last'){  echo ' selected="selected" ';}else{ echo ' ';}?>>last</option>
											</select> <select id="yearly_weekday"
												name="data[Coupon][yearly_weekday]"
												style="border: 1px solid black;">
													<option value="Monday"
													<?php if($this->data['Coupon']['yearly_weekday']=='Monday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Monday</option>
													<option value="Tuesday"
													<?php if($this->data['Coupon']['yearly_weekday']=='Tuesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Tuesday</option>
													<option value="Wednesday"
													<?php if($this->data['Coupon']['yearly_weekday']=='Wednesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Wednesday</option>
													<option value="Thursday"
													<?php if($this->data['Coupon']['yearly_weekday']=='Thursday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Thursday</option>
													<option value="Friday"
													<?php if($this->data['Coupon']['yearly_weekday']=='Friday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Friday</option>
													<option value="Saturday"
													<?php if($this->data['Coupon']['yearly_weekday']=='Saturday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Saturday</option>
													<option value="Sunday"
													<?php if($this->data['Coupon']['yearly_weekday']=='Sunday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Sunday</option>
											</select> <br /> <br /> &nbsp;&nbsp;&nbsp;&nbsp;of <select
												id="yearly_weekof_month"
												name="data[Coupon][yearly_weekof_month]"
												style="border: 1px solid black;">
													<option value="January"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='January'){  echo ' selected="selected" ';}else{ echo ' ';}?>>January</option>
													<option value="February"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='February'){  echo ' selected="selected" ';}else{ echo ' ';}?>>February</option>
													<option value="March"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='March'){  echo ' selected="selected" ';}else{ echo ' ';}?>>March</option>
													<option value="April"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='April'){  echo ' selected="selected" ';}else{ echo ' ';}?>>April</option>
													<option value="May"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='May'){  echo ' selected="selected" ';}else{ echo ' ';}?>>May</option>
													<option value="June"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
													<option value="July"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
													<option value="August"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
													<option value="September"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
													<option value="October"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
													<option value="November"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
													<option value="December"
													<?php if($this->data['Coupon']['yearly_weekof_month']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>
											</select></td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>

					<tr id="row_recurrencerange" style="display: none;">
						<td valign="top">
							<div class="updat" id="recur_range_name" style="display: none;">
								<label class="boldlabel">Recurrence Range <span
									style="color: red;">*</span>
								</label>
							</div>
						</td>
						<td>
							<div id="recur_pattern_range" style="display: none;">
								<?php 
								if(isset($this->data['Coupon']['coupon_end']) && $this->data['Coupon']['coupon_end'] =="by_no_date")
									$no_end_date="checked='checked'";
								if(isset($this->data['Coupon']['coupon_end'])&& $this->data['Coupon']['coupon_end']=="after_accurrences")
									$end_after="checked='checked'";
								if(isset($this->data['Coupon']['coupon_end'])&& $this->data['Coupon']['coupon_end']=="by_date")
									$end_by="checked='checked'";
								?>

								<input type="radio" value="by_no_date" id="recur_range"
									name="data[Coupon][coupon_end]" checked="checked"
									<?php echo (isset($no_end_date))?$no_end_date:''?>> No End Date
								&nbsp; <br /> <br /> <input type="radio"
									value="after_accurrences" id="after_accurrences"
									name="data[Coupon][coupon_end]"
									<?php echo (isset($end_after))?$end_after:''?>> End After
								&nbsp; &nbsp;
								<?php echo $form->input("coupon_end_after_occurrences", array('id' => 'coupon_end_after_occurrences','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>
								&nbsp;Occurences <br /> <br />
								<?php 
								if(isset($offerdata['coupon_end'])=="by_date")
								{
									if($offerdata['coupon_end_by_date']!=NULL && $offerdata['coupon_end_by_date']!="" && $offerdata['coupon_end_by_date']!="0000-00-00")
										$ed=date('m-d-Y',strtotime($offerdata['coupon_end_by_date']));
									else
										$ed="";
								}
								else
									$ed="";
								?>
								<input type="radio" value="by_date" id="by_date"
									name="data[Coupon][coupon_end]"
									<?php echo (isset($end_by))?$end_by:'';?>> End by &nbsp; &nbsp;
									<br /> <br />
								<span class="intp-Span middle"><?php echo $form->text("end_by_date", array('id' => 'end_by_date', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly','value'=>$end_by_date));?>
								</span>

							</div>
						</td>
					</tr>
					<tr id="row_starttime">
						<td>
							<div class="updat">
								<label class="boldlabel">Start Time </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"> <select
									id="stime" name="data[Coupon][stime]" class="noBg form-control"
									style="width: 100%; margin-bottom: 7px;">
										<?php echo $option_stime; ?>
								</select> <?php //echo $form->select("stime",$timedropdown,$sel_stime,array('id' => 'country','class'=>'multi-list form-control',"---Select---"); ?>
							</span>
						</span></td>
					</tr>
					<tr id="row_endtime">
						<td>
							<div class="updat">
								<label class="boldlabel">End Time </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"> <select
									id="etime" name="data[Coupon][etime]" class="noBg form-control"
									style="width: 100%; margin-bottom: 7px;">
										<?php echo $option_etime; ?>
								</select> <?php //echo $form->select("etime",$timedropdown,$sel_etime,array('id' => 'country','class'=>'multi-list form-control',"---Select---"); ?>
							</span>
						</span></td>
					</tr>
					<tr id="row_responderoffer">
						<td>
							<div class="updat">
								<label class="boldlabel">Auto Respond Email </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php echo $form->select("auto_responder_email",$responderdropdown,$sel_responder,array('id' => 'auto_respond_offer_email','class'=>'multi-list form-control'),array(''=>'--Select--')); ?>
							</span>
						</span> <span class="btn-Lft"><input type="button" class="btn-Rht btn btn-primary btn-sm"
								value="Add" name="Add" onclick="addEmailTempforAutoRespond();" />
						</span></td>
					</tr>
					 <?php if($isWordPress=='0'){ ?>
					<tr id="row_merchantdetail">
						<td>
							<div class="updat">
								<label class="boldlabel">Inquiry Detail Page </label>
							</div>
						</td>
						<td><span class="intp-Span">
						<?php echo $form->input("coupon_detail_page", array('div' => false, 'label' => '','class' => 'inpt-txt-fld form-control','maxlength' => '150')); ?>
				
						</span> </td>
					</tr>
		
        <tr>
			<td>
			<div class="updat">
			<label class="boldlabel">Inquiry Detail Page </label>
			</div>
			</td>
			 <td>
				<span class="intp-Span">
				<?php echo $form->input("inquiry_detail_page", array('div' => false, 'label' => '','class' => 'inpt-txt-fld form-control','maxlength' => '150')); ?> </span>
			</td>
          </tr>
		
		<?php } else{ ?>
        <tr class="row_event_detail">
						<td>
							<div class="updat">
								<label class="boldlabel">Coupon Detail Page </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php  
				echo $form->select("coupon_detail_page",$webpages,$coupon_detail_page,array('class'=>'multi-list form-control'),array(''=>'--Select--')); ?>
							</span>
						</span> </td>
					</tr>

					<tr id="row_merchantdetail">
						<td>
							<div class="updat">
								<label class="boldlabel">Inquiry Detail Page </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php  echo $form->select("inquiry_detail_page",$webpages,$inquiry_detail_page,array('class'=>'multi-list form-control'),array(''=>'--Select--')); ?>
							</span>
						</span></td>
					</tr>
	<?php } ?>	 	
				</table>
    </div>
    <div class="frmbox2">
    	<table cellspacing="5" cellspacing="0">
					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Good at location(s)</label>
							</div>

						</td>
						<td>


							<div class="large">
								<span class="txtArea-top"> <span class="newtxtArea-bot">
										<div class="scrolldown form-control" id="location"></div>
								</span>
								</span>
							</div>

						</td>
					</tr>

					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Short Description </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"><?php echo $form->textarea("short_description", array('div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg form-control",'style'=>'width:231px;'));?>
							</span>
						</span></td>
					</tr>

					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Meta Description </label>
							</div>
						</td>
						<td><span class="txtArea-top"> <span class="txtArea-bot"><?php echo $form->textarea("meta_description", array('id' => 'meta_description', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg form-control",'style'=>'width:231px;'));?>
							</span>
						</span>
						</td>
					</tr>

					<tr>
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Square Graphics</label>
							</div>
						</td>
						<td><?php  echo $form->file('square_graphic_img',array("class" => "contactInput"));?><br>
							<span
							style="color: LightSlateGray; font-size: 11px; font-style: italic;">Used
								for 210x210px format or image formtted appropriately. </span> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php 
							if(isset($this->data['Coupon']['square_graphic']) && $this->data['Coupon']['square_graphic'] !=''){
						echo $html->image('coupon/square/'.$this->data['Coupon']['square_graphic'],array('width'=>'210','height'=>'210','alt'=>''));
					} else {
						echo $html->image('coupon/square/210X210.png');
					} ?>
						</td>
					</tr>
					<tr>
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Tall Graphics</label>
							</div>
						</td>
						<td><?php  echo $form->file('tall_graphic_img',array("class" => "contactInput"));?><br>

							<span
							style="color: LightSlateGray; font-size: 11px; font-style: italic;">Used
								for 350x220px format or image formtted appropriately. </span> <?php 
								if(isset($this->data['Coupon']['tall_graphic']) && $this->data['Coupon']['tall_graphic'] !=''){
		echo $html->image('coupon/tall/'.$this->data['Coupon']['tall_graphic'],array('width'=>'210','height'=>'210','alt'=>''));
		}
		else { echo $html->image('coupon/wide/350X220.png');
}?>
						</td>
					</tr>

					<tr>
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Wide Graphics</label>
							</div>
						</td>
						<td><?php  echo $form->file('wide_graphic_img',array("class" => "contactInput"));?><br>

							<span
							style="color: LightSlateGray; font-size: 11px; font-style: italic;">Used
								for 220x350px format or image formtted appropriately. </span> <br/><?php 
				    if(isset($this->data['Coupon']['wide_graphic']) && $this->data['Coupon']['wide_graphic'] !=''){
						echo $html->image('coupon/wide/'.$this->data['Coupon']['wide_graphic'],array('width'=>'210','height'=>'210','alt'=>''));
					}else{
						echo $html->image('company/tall/210X336.png');
					}
					?>
						</td>
					</tr>
				</table>
    </div>
    
	<span style="text-align: left; padding-top: 5px;" class="top-bar"><b>Any
			item with a "<span style="color: red;">*</span>" requires an entry.
	</b><br /> </span>
	<!-- ADD Sub Admin  FORM EOF -->
	<!--inner-container ends here-->
	<?php echo $form->end();?>
</div>


<div class="clear"></div>
<script type="text/javascript">
var h=screen.height;
var w=screen.width;
if($('#endtime').val==''){
	$('#endtime').val($('#starttime').val());
}
$("#starttime").change(function(){         
	$('#endtime').val($('#starttime').val());
});
 /**
         * Funtion addnew email template in pop-up
         */
         function addEmailTempforAutoRespond() {   
              $('#rsvp_email').focus();
             var resWindow=  window.open (baseUrlAdmin+'addmailtemplate/popup/offer', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
             resWindow.focus();
           }
           
        
           
          // This function is called after closing of child window ie. on page addmailtemplate.ctp 
        function GetEmailTempRefresh(){          
            get_lastinsertedID_email("EmailTemplate");            
        }        
        function get_lastinsertedID_email(modelname) {    
               if(modelname==""){
                  return false;
               }
               var offer=1;
               var pid='<?php echo $projectid;?>';
                        
               jQuery.ajax({
                     type: "GET",
                     url: baseUrlAdmin+'get_lastinsertedID/'+modelname,
                     cache: false,
                     datatype:'text',
                     success: function(selectedid){
                            var focus=$("*:focus").attr("id");
                            if(focus=="rsvp_email")
                                getemailtemplatesbyajax(pid,'rsvp_email',selectedid,'1');    
                            else
                                getemailtemplatesbyajax(pid, 'waitlist_email', selectedid,'2');    
                     }
             });     
      }        
         
          // This function is called after closing of child window ie. on page addmailtemplate.ctp 
       /* function GetContentRefresh(){
            
            //var pid='<?php // echo $projectid;?>';  
            //alert("Refresh content temp dorp dwon"+pid);
            //var selectedid=$("#event_detail_page").val();
            //getcontentsbyajax(pid, 'event_detail_page', selectedid );   
             
            //selectedid=$("#merchant_detail_page").val();
            //getcontentsbyajax(pid, 'merchant_detail_page', selectedid ); 
            
            //selectedid=$("#inquiry_detail_page").val();
            //getcontentsbyajax(pid, 'inquiry_detail_page', selectedid );    
            
            get_lastinsertedID_content("Content"); 
		
			
            
        }*/
        
    /*    function get_lastinsertedID_content(modelname) { 
               if(modelname==""){
                  return false;
               }
               var offer=1;
               var pid='<?php echo $projectid;?>';
			    var selectedid ='<?php echo $merchant_detail_page;?>';
				jQuery.ajax({
                     type: "GET",
                     url: '/admins/get_lastinsertedID/'+modelname,
                     cache: false,
                     datatype:'text',
                     success: function(selectedid){
                            var focus=$("*:focus").attr("id");
                          //alert(selectedid);
                            if(focus=="event_detail_page")
                                getcontentsbyajax(pid, 'event_detail_page', selectedid );    
                            else
                            if(focus=="merchant_detail_page")
                                getcontentsbyajax(pid, 'merchant_detail_page', selectedid );      
                            else
                            if(focus=="offer_inquiry_page")
                                getcontentsbyajax(pid, 'offer_inquiry_page', selectedid );      
                     }
             });
      
      }*/
        
               /**
        * REfresh Comment type dropdown
        */
        function getcontentsbyajax(projectid,eleid, selectedid) {   
					//alert(projectid);
					//alert(selectedid);
               if(projectid==""){
                  return false;
               }
               var temp_type="";
               
               if(eleid=="event_detail_page")
                    temp_type="offer_detail";
               if(eleid=="merchant_detail_page")
                    temp_type="offer_merchant";
               if(eleid=="offer_inquiry_page")
                    temp_type="offer_inquiry";
                        
               jQuery.ajax({
                     type: "GET",
                     url: baseUrl+'offers/getcontentpagesbyajax/'+projectid+'/'+selectedid+'/'+temp_type,
					 
                     cache: false,
                     success: function(rText){
					 		
                            jQuery('#'+eleid).html(rText);
                     }
             });
      
      }


        
       $(document).ready(function() { 
       
        getcontentsbyajax("<?php echo $projectid;?>","event_detail_page","<?php echo $event_detail_page;?>");
        getcontentsbyajax("<?php echo $projectid;?>","merchant_detail_page", "<?php echo $merchant_detail_page;?>");
        getcontentsbyajax("<?php echo $projectid;?>","offer_inquiry_page", "<?php echo $offer_inquiry_page;?>");
        getemailtemplatesbyajax("<?php echo $projectid;?>",'rsvp_email',"0",'1');    
        getemailtemplatesbyajax("<?php echo $projectid;?>",'waitlist_email',"0",'2');           
               
        var current_domain=$("#current_domain").val();
        
        $("#addrecipients").click(function(){
            addrecipients();  
        });

        $("#create_csv").click(function(){
            create_csv();  
        });
        
        $(document).ready(function()
        {
            $('#checkall').bind('change',function(){
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                    {
                    $('.checkid').each(function()
                    {
                        $(this).attr('checked',true);
                    });
                }else{
                    $('.checkid').each(function()
                    {
                        $(this).attr('checked',false);

                    });
                }        
            })
        });
        
        $(document).ready(function()
        {   
            $('.checkid').bind('change',function()
            {   
                //offer.stopPropagation();
                var i=0;
                var j=0;
                $('.checkid').each(function(){
                    i++;
                    var check = $(this).attr('checked')?1:0;
                    if(check ==1)
                        {            
                        j++;
                    }
                });

                if(i==j)
                    $('#checkall').attr('checked',true);
                else
                    $('#checkall').attr('checked',false);
            });
        });
        
        function addrecipients()
        {    
            var counter=0;
            var existlist = document.getElementById('selected_for_invitations').value;
            var existlistarr = existlist.split(",");
            var str ='';
            var chk = '';
            var id="";
            $('.checkid').each(function(){        
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                    {            
                    chk = ''; 
                    id=$(this).val(); 

                    for(j=0;j<existlistarr.length;j++){

                        if(existlistarr[j]==id){
                            chk ='set'; 
                            break;
                        }
                    }

                    if(chk==''){
                        str += id+',';    
                    }
                    counter=counter +1;
                }
            });    
            if(counter==0)
                {
                alert("Please select at least one recipient");
                return false;
            }else{    
                str = trim(str,",");
                document.getElementById('selected_for_invitations').value = trim(trim(document.getElementById('selected_for_invitations').value,',')+","+str,","); 

            }
        } 
    }); 

     $(document).ready(function() {
         
         showRecurPatternOptions();  
     
     $("#recur_pattern").change(function(){
        showRows();    
        showRecurPatternOptions();  
     }); 
     
     function showRecurPatternOptions(){
             var recur_pattern=$("#recur_pattern").val();
             $("#daily_recur_pattern").hide();    
             $("#weekly_recur_pattern").hide();    
             $("#monthly_recur_pattern").hide();    
             $("#yearly_recur_pattern").hide();    
             $("#recur_pattern_range").hide();
             $("#recur_range_name").hide();
             
            if(recur_pattern=='Yearly'){
                   $("#yearly_recur_pattern").show();  
                   $("#recur_pattern_range").show();  
                   $("#recur_range_name").show();
                   $("#end_date_name").hide();
                   $("#end_date_field").hide();
            }else if(recur_pattern=='Monthly'){
                    $("#monthly_recur_pattern").show();
                    $("#recur_pattern_range").show();
                    $("#recur_range_name").show();  
                    $("#end_date_name").hide();
                    $("#end_date_field").hide();
            }else if(recur_pattern=='Weekly'){
                  $("#weekly_recur_pattern").show();   
                  $("#recur_pattern_range").show(); 
                  $("#recur_range_name").show();  
                  $("#end_date_name").hide();
                $("#end_date_field").hide();
            }else if(recur_pattern=='Daily'){
                //recur_pattern=='Daily'
                $("#daily_recur_pattern").show();  
                $("#recur_pattern_range").show(); 
                $("#recur_range_name").show();   
                $("#end_date_name").hide();
                $("#end_date_field").hide();
            } else {       //if none
             $("#daily_recur_pattern").hide();    
             $("#weekly_recur_pattern").hide();    
             $("#monthly_recur_pattern").hide();    
             $("#yearly_recur_pattern").hide();    
             $("#recur_pattern_range").hide();  
             $("#recur_range_name").hide();
             $("#end_date_name").show();
             $("#end_date_field").show();
            }
        }
	 function showRows() {
	 $("#row_recurpatterns").show();
	 $("#row_recurrencerange").show();
	 }	
	}); 
	
	
	
	function ajax_getLocations(){
		var url=baseUrl+'coupons/update_location/<?php echo $sel_mer ?>';
		//alert(url);
		$.ajax({
			type: 'GET',
			url: url,
			dataType: "html",
			success: function(data){
				$('#location').html(data);
			}
		});
	}			
	
function getOfferNOnPofit(){
	var url = baseUrl+'offers/getRelatedNonProfit/'+$('#merchant_id').val()+'/<?php echo $sel_mer_non_profit ?>';

	$.ajax({
	type: "GET",
	url: url,
	dataType: "html",
	success: function(data){
		$('#charity').html(data);
		}
	});
}
			
$('#merchant_id').live('change',function(){	
	getOfferNOnPofit();	
});
					
	
	$(function(){
		//getOfferTypeData();
	//	getMerchantLocations();
	//	getOfferNOnPofit();
		ajax_getLocations();
	});
	
	$('#offer_type').live('change', function(){		
		getOfferTypeData();
	});
	
	
	
	$('#merchant_id').live('change', function(){
		getMerchantLocations();
	});

	$('input[id="nonprofitcheckall"]').live('change', function(){
		if($(this).is(':checked')){
			$('input[id^="nonprofitcheck"]').each( function(){
				$(this).attr('checked',true);
			});
		}else{
			$('input[id^="nonprofitcheck"]').each( function(){
				$(this).attr('checked',false);
			});
		}
	})
	
	$('input[id="locationall"]').live('change', function(){
		if($(this).is(':checked')){
			$('input[id^="location"]').each( function(){
				$(this).attr('checked',true);
			});
		}else{
			$('input[id^="location"]').each( function(){
				$(this).attr('checked',false);
			});
		}
	})
	
</script>
