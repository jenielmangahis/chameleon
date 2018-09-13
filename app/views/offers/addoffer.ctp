<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$base_url = Configure::read('App.base_url');
if(!empty($params)){
	$backUrl = $base_url.'offers/offeremail';
}else{
	$backUrl = $base_url.'offers/offerlist';
}	
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

$('#OfferMnu').removeClass("butBg");
		$('#OfferMnu').addClass("butBgSelt");

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
                $('#task_startdate').datepicker({
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
                 inlineMsg('offer_type','<strong>Offer Type required.</strong>',2);
                 return false;
             }

            
			 if(trim($('#offer_title').val()) == '')
             {
                 inlineMsg('offer_title','<strong>Offer title required.</strong>',2);
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
                 inlineMsg('starttime','<strong>Offer starttime required.</strong>',2);
                 return false;
             }
             
             if(tagValidate($('#starttime').val()) == true){
                 inlineMsg('starttime','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
			 
			 
			 if(trim($('#endtime').val()) == '')
             {
                 inlineMsg('endtime','<strong>Offer starttime required.</strong>',2);
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
                      $('#task_end_after_occurrences').val('');                      
                                                
                  }
                  
                  if($('#after_accurrences').is(':checked'))
                  {                                  
                      if(trim($('#task_end_after_occurrences').val()) == "" || trim($('#task_end_after_occurrences').val()) <=0 || trim($('#task_end_after_occurrences').val())>30)
                      {                        
                            inlineMsg('task_end_after_occurrences','<strong>This field is required.Max 30 are allowed</strong>',2);
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
              
        /* if(trim($('#offerlogo').val()) != '')
             {
                    //alert($('#offerlogo').val());
                    var  ext = $('#offerlogo').val().split('.').pop().toLowerCase();
                  //  alert(ext);
                    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                        inlineMsg('offerlogo','<strong>Please only upload files with .jpg,.jpeg,.gif and .png extension.</strong>',2);
                        return false;
                    }
             }else{
                    if($('#offerid').val()=="0"){
                         inlineMsg('offerlogo','<strong>Please upload offer logo.</strong>',2);
                          return false;
                         }
             }*/
             
 
             
           return true;
       }
        
    </script>

<?php 
if($this->data['Offer']['id']){
                $act = 'edit';
                $header_text= "Edit Offer Detail";
                $show_sub_menus=1;
                $div_class="titlCont";
            }else{
                $act = 'add';
                $header_text= "Create an Offer ";
                $show_sub_menus=0;
                $div_class="titlCont1";
            }
            ?>

<div class="container">  		     
    <div class="titlCont<?php //echo $div_class;?> ">
        <div class="slider-centerpage clearfix">
            <div class="center-Page col-sm-6">
                <h2><?php  echo $header_text;?></h2>
            </div>
            <div class="slider-dashboard col-sm-6">
                <div class="icon-container">
                    <?php echo $form->create("Offer", array("action" => "addoffer",'type' => 'file', 'id' => "addoffer","onsubmit"=>"return validateoffer('$act');"))?>
                    <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
                                <?php e($html->image('save.png', array('alt' => 'Save'))); ?>
                            </button>
                    <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
                                <?php e($html->image('apply.png', array('alt' => 'Apply'))); ?>
                            </button>
                        <button type="button" id="saveForm" class="sendBut" onclick="javascript:(window.location='<?php echo $backUrl ?>')">
                                <?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?>
                            </button>
                    <?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
            <input type="hidden" id="current_domain" name="current_domain"
                value="<?php echo $current_domain; ?>">
                
                <?php if(!empty($params)) echo $form->hidden("params", array('id' => 'params','value'=>"$params"));?>
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul>
                    <li><button type="submit" value="Submit" class="button"
                            name="data[Action][redirectpage]">
                            <span>Save</span>
                        </button></li>
                    <li><button type="submit" value="Submit" class="button"
                            name="data[Action][noredirection]">
                            <span>Apply</span>
                        </button></li>
                    <li><button type="button" id="saveForm" class="button"
                            onclick="javascript:(window.location='<?php echo $backUrl ?>')">
                            <span> Cancel</span>
                        </button></li>
                </ul><?php */?>
            </div>
        </div>             
    </div>
</div>


<div class="clearfix nav-submenu-container">
    <div class="midCont submenu-Cont">
        <?php    
			$this->loginarea="offers";    $this->subtabsel="offerlist";
			if(isset($this->params['pass'][0])&&$this->params['pass'][0]=="secondlevel")
			{
				echo $this->renderElement('offersecondlevel_submenus');  
			}  
			else
			{  
				echo $this->renderElement('offers_submenus');  
			}
		
		 ?>
    </div>
</div>
<!--rightpanel ends here-->

<!--inner-container starts here-->

<!--<div class="centerPage"></div>-->

<!-- ADD Sub Admin FORM BOF -->

<!-- ADD FIELD BOF -->

<!--<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar"></div>-->
<div class="midCont table-responsive">


	<?php if($session->check('Message.flash')){ ?>
	<div id="blck">
		<div class="msgBoxTopLft">
			<div class="msgBoxTopRht">
				<div class="msgBoxTopBg"></div>
			</div>
		</div>
		<div class="msgBoxBg">
			<div class="">
				<a href="#." onclick="hideDiv();"><img src="/img/close.png"
					alt="" style="margin-left: 945px; position: absolute; z-index: 11;" />
				</a>

				<?php  $session->flash(); 
				echo $form->error('Offer.offer_title', array('class' => 'msgTXt'));
				//	echo $form->error('Offer.company_type_id', array('class' => 'msgTXt'));  ?>
			</div>
			<div class="msgBoxBotLft">
				<div class="msgBoxBotRht">
					<div class="msgBoxBotBg"></div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
	<table class="table table-borderless">
		<tr>
			<td width="50%" valign="top" style="display:inline-block;">
				<table cellspacing="5" cellpadding="0">

					<tr>
						<td colspan="5"><?php if($session->check('Message.flash')){ 
							$session->flash();
						}
						echo $form->hidden("Offer.id", array('id' => 'offerid','value'=>"$offerid"));
						echo $form->hidden("Project.projectname", array('id' => 'projectname','value'=>"$projectname"));
						?>
						</td>
					</tr>

					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Merchant<span
									style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> <?php echo $form->select("Offer.merchant_id",$merchantdropdown,$selectedmerchant, array('id' => 'merchant_id', 'style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"sample-class","maxlength" => "250"),"---Select---"); ?>
							</span>
						</span></td>
					</tr>

					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Offer Category <span
									style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> <?php 
						echo $form->select("Offer.category_id",$categorydropdown,$selectedcategory, array('id' => 'category_id', 'style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"sample-class","maxlength" => "250"),"---Select---");
						?>
							</span>
						</span></td>
					</tr>


					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Offer Type <span
									style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> <?php 
						echo $form->select("Offer.offer_type",$offertypetempdropdown,$selectedoffertypetemp, array('id' => 'offer_type', 'style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"sample-class","maxlength" => "250"),"---Select---");
						?>
							</span>
						</span></td>
					</tr>

					<tr id="row_controlled">
						<td>
							<div class="updat">
								<label class="boldlabel">Controlled By<span
									style="color: red;">*</span>
								</label>
							</div>

						</td>
						<style type="text/css">
							.floatright * {
								float: left;
							}
							.floatright label {
								padding-right: 8px;
								padding-left: 3px;
							}
						</style>
						<td class="floatright">
						<?php 
						$options=array('0'=>'Member ','1'=>'Merchant ');
						$attributes=array('legend'=>false,'class'=>'radiolocation','readonly'=>'true');
						echo $form->radio('Offer.controlled_by',$options,$attributes);
						?>
							<input class="radio_nonprofit" id="OfferControlledBy2"
							readonly='true' type="radio" value="2"
							name="data[Offer][controlled_by]" /><label
							class="radio_nonprofit" for="OfferControlledBy2">No
								Non-Profit</label></td>
					</tr>

					<tr id="row_offername" >
						<td>
							<div class="updat">
								<label class="boldlabel">Offer Name<span
									style="color: red;">*</span>
								</label>
							</div>
						</td>
						<td><span class="intpSpan"><?php echo $form->input("Offer.offer_title", array('id' => 'offer_title','div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
						</span></td>
					</tr>



					<tr class="row_coupon">
						<td>
							<div class="updat">
								<label class="boldlabel">Coupon Cost<span
									style="color: red;">*</span>
								</label>
							</div>
						</td>
						<td>
							<table align="center" style="vertical-align: middle;">
								<tr>
									<td><span class="intpSpan"> <?php echo $form->input("Offer.coupon_cost", array('id' => 'coupon_cost', 'div' => false, 'label' => '',"class" => "inpt_txt_fld_small","maxlength" => "150"));?>
									</span></td>
									<td width="165px"><label class="boldlabel">&nbsp;OR&nbsp;&nbsp;Coupon
											Value<span style="color: red;">*</span></label></td>
									<td><span class="intpSpan"> <?php echo $form->input("Offer.coupon_value", array('id' => 'coupon_value', 'div' => false, 'label' => '',"class" => "inpt_txt_fld_small","maxlength" => "150"));?>
									</span></td>
								</tr>
							</table>
						</td>
					</tr>



					<tr class="row_pledge">
						<td>
							<div class="updat">
								<label class="boldlabel">Pledge %
								</label>
							</div>
						</td>
						<td>
							<table align="center" style="vertical-align: middle;">
								<tr>
									<td><span class="intpSpan"> <?php echo $form->input("Offer.percent_pledge", array('id' => 'percent_pledge', 'div' => false, 'label' => '',"class" => "inpt_txt_fld_small","maxlength" => "150"));?>
									</span></td>
									<td width="165px"><label class="boldlabel">&nbsp;OR&nbsp;&nbsp;Pledge
											$</label></td>
									<td><span class="intpSpan"><?php echo $form->input("Offer.fixed_pledge", array('id' => 'fixed_pledge', 'div' => false, 'label' => '',"class" => "inpt_txt_fld_small","maxlength" => "150"));?>
									</span></td>
								</tr>
							</table>
						</td>
					</tr>


					<tr class="row_discount">
						<td>
							<div class="updat">
								<label class="boldlabel">Discount %
								</label>
							</div>
						</td>
						<td>
							<table align="center" style="vertical-align: middle;">
								<tr>
									<td><span class="intpSpan"><?php echo $form->input("Offer.percent_discount", array('id' => 'percent_discount', 'div' => false, 'label' => '',"class" => "inpt_txt_fld_small","maxlength" => "150"));?>
									</span></td>

									<td width="165px"><label class="boldlabel">&nbsp;OR&nbsp;&nbsp;Discount
											$</label></td>
									<td><span class="intpSpan"><?php echo $form->input("Offer.fixed_discount", array('id' => 'fixed_discount', 'div' => false, 'label' => '',"class" => "inpt_txt_fld_small","maxlength" => "150"));?>
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
						<td><span class="intpSpan"><?php echo $form->input("Offer.minimum_purchase", array('id' => 'minimum_purchase', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
						</span></td>
					</tr>				

					<tr class="row_charity">
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Non-Profit <span style="color: red;">*</span>
								</label>
							</div>
						</td>
						<td>
							<div class="large">
								<span class="txtArea_top">
									<span class="newtxtArea_bot">
										<div class="scrolldown" id="charity">
										
										</div>
									</span>
								</span>
							</div>	
						</td>
					</tr>

					
					<tr class="row_related_event">
						<td>
							<div class="updat">
								<label class="boldlabel">Related Event</label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span class="txtArea_bot"> <span id="countrydiv"> <?php echo $form->select("Offer.event_id",$eventdropdown,$selectedevent,array('id' => 'event_id',"class"=>"multilist"),"None"); ?>
								</span>
							</span>
						</span></td>
					</tr>
					
					<tr class="row_max_coupon">
						<td>
							<div class="updat">
								<label class="boldlabel">Maximum Coupon</label>
							</div>
						</td>
						<td><span class="intpSpan"><?php echo $form->input("Offer.maximum_coupon", array('id' => 'maximum_coupon', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
						</span></td>
					</tr>
					

					<tr id="row_recurpattern" >
						<td>
							<div class="updat">
								<label class="boldlabel">Recur Pattern </label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> <span id="countrydiv"> <?php echo $form->select("Offer.recur_pattern",$recur_pattern,null,array('id' => 'recur_pattern',"class"=>"multilist"),"--Select--"); ?>
								</span>
							</span>
						</span></td>
					</tr>

					<tr id="row_startdate">
						<td>
							<div class="updat">
								<label class="boldlabel">Start Date <span
									style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td><span class="intpSpan middle"><?php echo $form->text("Offer.starttime", array('id' => 'starttime', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?>
						</span></td>
					</tr>

					<tr  id="row_enddate">

						<td>
							<div class="updat" id="end_date_name" style="display: none;">
								<label class="boldlabel">End Date <span
									style="color: red;">*</span>
								</label>
							</div>

						</td>
						<td>
							<div id="end_date_field" style="display: none;">
								<span class="intpSpan middle"><?php echo $form->text("Offer.endtime", array('id' => 'endtime', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?>
								</span>
							</div>
						</td>
					</tr>

					<tr  id="row_recurpatterns" >
						<td>&nbsp;</td>
						<td>
							<div id="daily_recur_pattern" style="display: none;">
								<table>
									<tbody>
										<tr>
											<td><?php if($this->data['Offer']['daily_every_noof_days']!=""){  
												$daily_every_noof_days=$this->data['Offer']['daily_every_noof_days'];
											}
											else{ $daily_every_noof_days=1;
}?>
												<div>
													<input type="radio" name='data[Offer][daily_pattern]'
														checked="checked" id="everyday" value='everyday'
														<?php if($this->data['Offer']['daily_pattern']=='everyday'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Every
													<?php echo $form->text("Offer.daily_every_noof_days", array('id' => 'daily_every_noof_days', 'div' => false, 'label' => '','value' => $daily_every_noof_days,"style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?>
													<span></span> Day(s)
												</div> <br />
												<div>
													<input type='radio' name='data[Offer][daily_pattern]'
														id="everyweek" value='everyweek'
														<?php if($this->data['Offer']['daily_pattern']=='everyweek'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Every
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

											<td><?php if($this->data['Offer']['weekly_every_noof_weeks']!=""){  
												$weekly_every_noof_weeks=$this->data['Offer']['weekly_every_noof_weeks'];
											}else{ $weekly_every_noof_weeks=1;
}?>
												Recur every <?php echo $form->text("Offer.weekly_every_noof_weeks", array('id' => 'weekly_every_noof_weeks', 'div' => false, 'label' => '', 'value' => $weekly_every_noof_weeks, "style" => "width:50px; border: 1px solid #000;","maxlength" => "200"));?>
												week(s) on: <?php echo $form->input('Offer.weekly_monday', array('type'=>'checkbox','id'=>'weekly_monday', 'label' => ' Monday')); ?>
												<?php echo $form->input('Offer.weekly_tuesday', array('type'=>'checkbox','id'=>'weekly_tuesday', 'label' => ' Tuesday')); ?>
												<?php echo $form->input('Offer.weekly_wednesday', array('type'=>'checkbox','id'=>'weekly_wednesday', 'label' => ' Wednesday')); ?>
												<?php echo $form->input('Offer.weekly_thursday', array('type'=>'checkbox','id'=>'weekly_thursday', 'label' => ' Thursday')); ?>
												<?php echo $form->input('Offer.weekly_friday', array('type'=>'checkbox','id'=>'weekly_friday', 'label' => ' Friday')); ?>
												<?php echo $form->input('Offer.weekly_saturday', array('type'=>'checkbox','id'=>'weekly_saturday', 'label' => ' Saturday')); ?>
												<?php echo $form->input('Offer.weekly_sunday', array('type'=>'checkbox','id'=>'weekly_sunday', 'label' => ' Sunday')); ?>

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
													<input type="radio" name='data[Offer][monthly_pattern]'
														checked="checked" id="dayofeverymonth"
														value='dayofeverymonth'
														<?php if($this->data['Offer']['monthly_pattern']=='dayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;Day
													<?php 
													if($this->data['Offer']['monthly_onof_day']!=""){
$monthly_onof_day=$this->data['Offer']['monthly_onof_day'];
}else{ $monthly_onof_day=date('d');
}
if($this->data['Offer']['monthly_every_noof_months']!=""){
$monthly_every_noof_months=$this->data['Offer']['monthly_every_noof_months'];
}else{ $monthly_every_noof_months=1;
}
?>
													<?php echo $form->text("Offer.monthly_onof_day", array('id' => 'monthly_onof_day', 'div' => false, 'label' => '','value' => $monthly_onof_day,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?>
													of every
													<?php echo $form->text("Offer.monthly_every_noof_months", array('id' => 'monthly_every_noof_months', 'div' => false, 'label' => '','value' => $monthly_every_noof_months,"style" => "width:35px; border: 1px solid #000;","maxlength" => "200"));?>
													month(s)
												</div> <br />
												<div>
													<input type='radio' name='data[Offer][monthly_pattern]'
														id="weekdayofeverymonth" value='weekdayofeverymonth'
														<?php if($this->data['Offer']['monthly_pattern']=='weekdayofeverymonth'){  echo ' checked="checked" ';}else{ echo ' ';}?>>&nbsp;
													The &nbsp; <select style="border: 1px solid black;"
														name="data[Offer][monthly_weeknumber]">
														<option value="first"
															<?php if($this->data['Offer']['monthly_weeknumber']=='first'){  echo ' selected="selected" ';}else{ echo ' ';}?>>first</option>
														<option value="second"
															<?php if($this->data['Offer']['monthly_weeknumber']=='second'){  echo ' selected="selected" ';}else{ echo ' ';}?>>second</option>
														<option value="third"
															<?php if($this->data['Offer']['monthly_weeknumber']=='third'){  echo ' selected="selected" ';}else{ echo ' ';}?>>third</option>
														<option value="fourth"
															<?php if($this->data['Offer']['monthly_weeknumber']=='fourth'){  echo ' selected="selected" ';}else{ echo ' ';}?>>fourth</option>
														<option value="last"
															<?php if($this->data['Offer']['monthly_weeknumber']=='last'){  echo ' selected="selected" ';}else{ echo ' ';}?>>last</option>
													</select> <select style="border: 1px solid black;"
														name="data[Offer][monthly_weekday]">
														<option value="Monday"
															<?php if($this->data['Offer']['monthly_weekday']=='Monday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Monday</option>
														<option value="Tuesday"
															<?php if($this->data['Offer']['monthly_weekday']=='Tuesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Tuesday</option>
														<option value="Wednesday"
															<?php if($this->data['Offer']['monthly_weekday']=='Wednesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Wednesday</option>
														<option value="Thursday"
															<?php if($this->data['Offer']['monthly_weekday']=='Thursday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Thursday</option>
														<option value="Friday"
															<?php if($this->data['Offer']['monthly_weekday']=='Friday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Friday</option>
														<option value="Saturday"
															<?php if($this->data['Offer']['monthly_weekday']=='Saturday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Saturday</option>
														<option value="Sunday"
															<?php if($this->data['Offer']['monthly_weekday']=='Sunday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Sunday</option>
													</select> <br /> <br />&nbsp; &nbsp; of every &nbsp;
													<?php 
													if($this->data['Offer']['monthly_weekof_noof_months']!=""){
$monthly_weekof_noof_months=$this->data['Offer']['monthly_weekof_noof_months'];
}else{ $monthly_weekof_noof_months=1;
}
echo $form->input("Offer.monthly_weekof_noof_months", array('id' => 'monthly_weekof_noof_months','div' => false, 'label' => '','value' => $monthly_weekof_noof_months,'style'=>'border: 1px solid black;width:30px;'));?>
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

											<td><?php if($this->data['Offer']['yearly_everymonth_date']!=""){  
												$yearly_everymonth_date=$this->data['Offer']['yearly_everymonth_date'];
											}else{ $yearly_everymonth_date=date('d');
}?>
												<input type="radio" value="everynoofmonths"
												id="everynoofmonths" checked="checked"
												name="data[Offer][yearly_pattern]"
												<?php if($this->data['Offer']['yearly_pattern']=='everynoofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
												Every &nbsp; <select id="yearly_everymonth"
												name="data[Offer][yearly_everymonth]"
												style="border: 1px solid black;">
													<option value="January"
														<?php if($this->data['Offer']['yearly_everymonth']=='January'){  echo ' selected="selected" ';}else{ echo ' ';}?>>January</option>
													<option value="February"
														<?php if($this->data['Offer']['yearly_everymonth']=='February'){  echo ' selected="selected" ';}else{ echo ' ';}?>>February</option>
													<option value="March"
														<?php if($this->data['Offer']['yearly_everymonth']=='March'){  echo ' selected="selected" ';}else{ echo ' ';}?>>March</option>
													<option value="April"
														<?php if($this->data['Offer']['yearly_everymonth']=='April'){  echo ' selected="selected" ';}else{ echo ' ';}?>>April</option>
													<option value="May"
														<?php if($this->data['Offer']['yearly_everymonth']=='May'){  echo ' selected="selected" ';}else{ echo ' ';}?>>May</option>
													<option value="June"
														<?php if($this->data['Offer']['yearly_everymonth']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
													<option value="July"
														<?php if($this->data['Offer']['yearly_everymonth']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
													<option value="August"
														<?php if($this->data['Offer']['yearly_everymonth']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
													<option value="September"
														<?php if($this->data['Offer']['yearly_everymonth']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
													<option value="October"
														<?php if($this->data['Offer']['yearly_everymonth']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
													<option value="November"
														<?php if($this->data['Offer']['yearly_everymonth']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
													<option value="December"
														<?php if($this->data['Offer']['yearly_everymonth']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>
											</select> &nbsp;<?php echo $form->input("Offer.yearly_everymonth_date", array('id' => 'yearly_everymonth_date','div' => false, 'label' => '', 'value' => $yearly_everymonth_date,'style'=>'border: 1px solid black;width:30px;'));?><br />
												<br /> <input type="radio" value="theweekofmonths"
												id="theweekofmonths" name="data[Offer][yearly_pattern]"
												<?php if($this->data['Offer']['yearly_pattern']=='theweekofmonths'){  echo ' checked="checked" ';}else{ echo ' ';}?>>
												The &nbsp; <select id="yearly_weeknumber"
												name="data[Offer][yearly_weeknumber]"
												style="border: 1px solid black;">
													<option value="first"
														<?php if($this->data['Offer']['yearly_weeknumber']=='first'){  echo ' selected="selected" ';}else{ echo ' ';}?>>first</option>
													<option value="second"
														<?php if($this->data['Offer']['yearly_weeknumber']=='second'){  echo ' selected="selected" ';}else{ echo ' ';}?>>second</option>
													<option value="third"
														<?php if($this->data['Offer']['yearly_weeknumber']=='third'){  echo ' selected="selected" ';}else{ echo ' ';}?>>third</option>
													<option value="fourth"
														<?php if($this->data['Offer']['yearly_weeknumber']=='fourth'){  echo ' selected="selected" ';}else{ echo ' ';}?>>fourth</option>
													<option value="last"
														<?php if($this->data['Offer']['yearly_weeknumber']=='last'){  echo ' selected="selected" ';}else{ echo ' ';}?>>last</option>
											</select> <select id="yearly_weekday"
												name="data[Offer][yearly_weekday]"
												style="border: 1px solid black;">
													<option value="Monday"
														<?php if($this->data['Offer']['yearly_weekday']=='Monday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Monday</option>
													<option value="Tuesday"
														<?php if($this->data['Offer']['yearly_weekday']=='Tuesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Tuesday</option>
													<option value="Wednesday"
														<?php if($this->data['Offer']['yearly_weekday']=='Wednesday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Wednesday</option>
													<option value="Thursday"
														<?php if($this->data['Offer']['yearly_weekday']=='Thursday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Thursday</option>
													<option value="Friday"
														<?php if($this->data['Offer']['yearly_weekday']=='Friday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Friday</option>
													<option value="Saturday"
														<?php if($this->data['Offer']['yearly_weekday']=='Saturday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Saturday</option>
													<option value="Sunday"
														<?php if($this->data['Offer']['yearly_weekday']=='Sunday'){  echo ' selected="selected" ';}else{ echo ' ';}?>>Sunday</option>
											</select> <br /> <br /> &nbsp;&nbsp;&nbsp;&nbsp;of <select
												id="yearly_weekof_month"
												name="data[Offer][yearly_weekof_month]"
												style="border: 1px solid black;">
													<option value="January"
														<?php if($this->data['Offer']['yearly_weekof_month']=='January'){  echo ' selected="selected" ';}else{ echo ' ';}?>>January</option>
													<option value="February"
														<?php if($this->data['Offer']['yearly_weekof_month']=='February'){  echo ' selected="selected" ';}else{ echo ' ';}?>>February</option>
													<option value="March"
														<?php if($this->data['Offer']['yearly_weekof_month']=='March'){  echo ' selected="selected" ';}else{ echo ' ';}?>>March</option>
													<option value="April"
														<?php if($this->data['Offer']['yearly_weekof_month']=='April'){  echo ' selected="selected" ';}else{ echo ' ';}?>>April</option>
													<option value="May"
														<?php if($this->data['Offer']['yearly_weekof_month']=='May'){  echo ' selected="selected" ';}else{ echo ' ';}?>>May</option>
													<option value="June"
														<?php if($this->data['Offer']['yearly_weekof_month']=='June'){  echo ' selected="selected" ';}else{ echo ' ';}?>>June</option>
													<option value="July"
														<?php if($this->data['Offer']['yearly_weekof_month']=='July'){  echo ' selected="selected" ';}else{ echo ' ';}?>>July</option>
													<option value="August"
														<?php if($this->data['Offer']['yearly_weekof_month']=='August'){  echo ' selected="selected" ';}else{ echo ' ';}?>>August</option>
													<option value="September"
														<?php if($this->data['Offer']['yearly_weekof_month']=='September'){  echo ' selected="selected" ';}else{ echo ' ';}?>>September</option>
													<option value="October"
														<?php if($this->data['Offer']['yearly_weekof_month']=='October'){  echo ' selected="selected" ';}else{ echo ' ';}?>>October</option>
													<option value="November"
														<?php if($this->data['Offer']['yearly_weekof_month']=='November'){  echo ' selected="selected" ';}else{ echo ' ';}?>>November</option>
													<option value="December"
														<?php if($this->data['Offer']['yearly_weekof_month']=='December'){  echo ' selected="selected" ';}else{ echo ' ';}?>>December</option>
											</select></td>
										</tr>
									</tbody>
								</table>
							</div> <br />
						</td>
					</tr>

					<tr  id="row_recurrencerange">
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
								if(isset($this->data['Offer']['task_end']) && $this->data['Offer']['task_end'] =="by_no_date") 
									$no_end_date="checked='checked'";
								if(isset($this->data['Offer']['task_end'])&& $this->data['Offer']['task_end']=="after_accurrences")
									$end_after="checked='checked'";
								if(isset($this->data['Offer']['task_end'])&& $this->data['Offer']['task_end']=="by_date")
									$end_by="checked='checked'";
								?>

								<input type="radio" value="by_no_date" id="recur_range"
									name="data[Offer][task_end]" checked="checked"
									<?php echo (isset($no_end_date))?$no_end_date:''?>> No
								End Date &nbsp; <br /> <br /> <input type="radio"
									value="after_accurrences" id="after_accurrences"
									name="data[Offer][task_end]"
									<?php echo (isset($end_after))?$end_after:''?>> End
								After &nbsp; &nbsp;
								<?php echo $form->input("Offer.task_end_after_occurrences", array('id' => 'task_end_after_occurrences','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>
								&nbsp;Occurences <br /> <br />
								<?php 
								if(isset($offerdata['task_end'])=="by_date")
								{
									if($offerdata['task_end_by_date']!=NULL && $offerdata['task_end_by_date']!="" && $offerdata['task_end_by_date']!="0000-00-00")
										$ed=date('m-d-Y',strtotime($offerdata['task_end_by_date']));
									else
										$ed="";
								}
								else
									$ed="";
								?>
								<input type="radio" value="by_date" id="by_date"
									name="data[Offer][task_end]"
									<?php echo (isset($end_by))?$end_by:'';?>> End by
								&nbsp; &nbsp;
								<span class="intpSpan middle"><?php echo $form->text("Offer.end_by_date", array('id' => 'end_by_date', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly','value'=>$end_by_date));?>
						</span>
								<br /> <br />

							</div>
						</td>

					</tr>


					
					<tr  id="row_starttime">
						<td>
							<div class="updat">
								<label class="boldlabel">Start Time </label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> 
								<select id="stime"
									name="data[Offer][stime]" class="noBg"
									style="border: none; width: 230px; margin-bottom: 7px;">
										<?php echo $option_stime; ?>
								</select> <?php //echo $form->select("Offer.stime",$timedropdown,$sel_stime,array('id' => 'country','class'=>'multilist',"---Select---"); ?>
							</span>
						</span></td>
					</tr>


					<tr  id="row_endtime">
						<td>
							<div class="updat">
								<label class="boldlabel">End Time </label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> <select id="etime"
									name="data[Offer][etime]" class="noBg"
									style="border: none; width: 230px; margin-bottom: 7px;">
										<?php echo $option_etime; ?>
								</select> <?php //echo $form->select("Offer.etime",$timedropdown,$sel_etime,array('id' => 'country','class'=>'multilist',"---Select---"); ?>
							</span>
						</span></td>
					</tr>


					<tr  id="row_responderoffer">
					<td > 
						<div class="updat">
							<label class="boldlabel">Auto Respond Offer Email </label>
						</div>
					</td>
					<td><span class="txtArea_top"> <span
							class="txtArea_bot"> <?php echo $form->select("Offer.auto_respond_offer_email",$responderdropdown,$sel_responder,array('id' => 'auto_respond_offer_email','class'=>'multilist'),array(''=>'--Select--')); ?>
						</span>
					</span> <span class="btnLft"><input type="button" class="btnRht"
							value="Add" name="Add" onclick="addEmailTempforAutoRespond();" />
					</span></td>
					</tr>



					<tr class="row_event_detail">
						<td>
							<div class="updat">
								<label class="boldlabel">Event Detail Page </label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> 
				<?php  
				echo $form->select("Offer.event_detail_page",$submenu,$event_detail_page,array('id' => 'event_detail_page','class'=>'multilist'),array(''=>'--Select--')); ?>
							</span>
						</span> <span class="btnLft"><input type="button" class="btnRht"
								value="Add" name="Add" onclick="addContentforEventDetails();" />
						</span></td>
					</tr>

				

					<tr id="row_merchantdetail" >
						<td>
							<div class="updat">
								<label class="boldlabel">Merchant Detail Page </label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> 
								
					<?php  echo $form->select("Offer.merchant_detail_page",null,$merchant_detail_page,array('id' => 'merchant_detail_page','class'=>'multilist'),array(''=>'--Select--')); ?>
							</span>
						</span> <span class="btnLft"><input type="button" class="btnRht"
								value="Add" name="Add" onclick="addContentforMerchantDetails();" />
						</span></td>
					</tr>
					
						<tr class="row_offer_detail">
						<td>
							<div class="updat">
								<label class="boldlabel">Offer Inquiry Page </label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"> <?php echo $form->select("Offer.offer_inquiry_page",$submenu,null,array('id' => 'offer_inquiry_page','class'=>'multilist'),array(''=>'--Select--')); ?>
							</span>
						</span> <span class="btnLft"><input type="button" class="btnRht"
								value="Add" name="Add" onclick="addContentforOfferDetails();" />
						</span></td>
					</tr>

					
				</table>



			</td>
			<td width="50%" valign="top" style="display:inline;">

				<table cellspacing="5" cellspacing="0">
					<tr>
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Merchant(location(s))</label>
							</div>

						</td>
						<td>
						
					
							<div class="large" >
							<span class="txtArea_top">
					  		<span class="newtxtArea_bot">
								<div class="scrolldown" id="merchant_location">
								
					  			
								</div>
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
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"><?php echo $form->textarea("Offer.offerdescription", array('id' => 'offerdescription', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?>
							</span>
						</span></td>
					</tr>

					<tr>
						<td>
							<div class="updat">
								<label class="boldlabel">Meta Description </label>
							</div>
						</td>
						<td><span class="txtArea_top"> <span
								class="txtArea_bot"><?php echo $form->textarea("Offer.meta_description", array('id' => 'meta_description', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg",'style'=>'width:231px;'));?>
							</span>
						</span></td>
					</tr>




					<tr>
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Square Graphics</label>
							</div>
						</td>
						<td>
							<?php  echo $form->file('Offer.square_graphic_img',array('id'=> 'square_graphic',"class" => "contactInput"));?><br>
						<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Used
								for 210x210px format or image formtted appropriately.
						</span>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				   <?php 
				   if(isset($this->data['Offer']['square_graphic']) && $this->data['Offer']['square_graphic'] !=''){
				   $src = $current_project_name.'/offers/square/';
					echo $html->image($src.$this->data['Offer']['square_graphic'],array('width'=>'210','height'=>'210','alt'=>'')); } else {echo $html->image('company/square/210X210.png');} ?>
					</td>
				</tr>

					<tr>
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Tall Graphics</label>
							</div>
						</td>
						<td><?php  echo $form->file('Offer.tall_graphic_img',array('id'=> 'tall_graphic',"class" => "contactInput"));?><br>

							<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Used
								for 350x220px format or image formtted appropriately.
							</span>
	<?php 
	   if(isset($this->data['Offer']['tall_graphic']) && $this->data['Offer']['tall_graphic'] !=''){
	   $src = $current_project_name.'/offers/tall/';
		echo $html->image($src.$this->data['Offer']['tall_graphic'],array('width'=>'210','height'=>'210','alt'=>'')); 	
		}
		else { echo $html->image('company/wide/350X220.png');  }?>
							</td>
					</tr>

					<tr>
						<td valign="top">
							<div class="updat">
								<label class="boldlabel">Wide Graphics</label>
							</div>
						</td>
						<td><?php  echo $form->file('Offer.wide_graphic_img',array('id'=> 'wide_graphic',"class" => "contactInput"));?><br>

							<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Used
								for 220x350px format or image formtted appropriately.
							</span>
					<?php 
				   if(isset($this->data['Offer']['wide_graphic']) && $this->data['Offer']['wide_graphic'] !=''){
				   $src = $current_project_name.'/offers/wide/';
					echo $html->image($src.$this->data['Offer']['wide_graphic'],array('width'=>'210','height'=>'210','alt'=>'')); 		                 } else{ echo $html->image('company/tall/210X336.png');}
					?>
					
							</td>
					</tr>


				</table>
			</td>
		</tr>
	</table>
		<span style="text-align:left; padding-top: 5px;" class="top-bar"><b>Any item with a "<span style="color: red;">*</span>" requires an entry.</b><br/></span>
	<!-- ADD Sub Admin  FORM EOF -->
	<!--inner-container ends here-->
	<?php echo $form->end();?>
</div>


<div class="clear"></div>
<script type="text/javascript">
var h=screen.height;
var w=screen.width;
$('#endtime').val($('#starttime').val());

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
           
        /**
         * Funtion addnew email template in pop-up
         */
         function addEmailTempforWaitList() {    
         
             $('#waitlist_email').focus();
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
          /**
         * Funtion addnew RecurringEvent details page in pop-up
         */
         function addContentforEventDetails() {      
			 if(validateoffer("add"))
             {
                 var offer_title=$('#offer_title').val()+" "+$('#starttime').val();

                 
                 $('#event_detail_page').focus();
                 var resWindow=  window.open (baseUrlAdmin+'addcontentpage/popup/event/'+offer_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                 resWindow.focus();
             }
           }
           
		   
		   
          /**
         * Funtion addnew RecurringOffer details page in pop-up
         */
         function addContentforOfferDetails() {      
             if(validateoffer("add"))
             {
                 var offer_title=$('#offer_title').val()+" "+$('#starttime').val();

                 
                 $('#offer_detail_page').focus();
                 var resWindow=  window.open (baseUrlAdmin+'addcontentpage/popup/detail/'+offer_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                 resWindow.focus();
             }
           }
           
            /**
         * Funtion addnew merchant detail page in pop-up
         */
         function addContentforMerchantDetails() {  
             if(validateoffer("add"))
             {
                 var offer_title=$('#offer_title').val()+" "+$('#starttime').val();    
             
                 $('#merchant_detail_page').focus();
                 var resWindow=  window.open (baseUrlAdmin+'addcontentpage/popup/merchant/'+offer_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                 resWindow.focus();
             }
           }
           
            /**
         * Funtion addnew inquiry details page in pop-up
         */
         function addContentforInquiryDetails() {    
             
             if(validateoffer("add"))
             {
                 var offer_title=$('#offer_title').val()+" "+$('#starttime').val();  
             
                 $('#inquiry_detail_page').focus();
                 var resWindow=  window.open (baseUrlAdmin+'addcontentpage/popup/inquiry/'+offer_title, 'AddContent','location=1,status=1,scrollbars=1, width='+w+',height='+h);
                 resWindow.focus();
             }
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
            }else
            if(recur_pattern=='Daily'){
                //recur_pattern=='Daily'
                $("#daily_recur_pattern").show();  
                $("#recur_pattern_range").show(); 
                $("#recur_range_name").show();   
                $("#end_date_name").hide();
                $("#end_date_field").hide();
            }
            else{       //if none
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
    }); 
	
	function getOfferTypeData(){
	
		offertype =  $('#offer_type').val(); 
		$('#OfferControlledBy0').removeAttr('checked');
		$('#OfferControlledBy1').removeAttr('checked');
		$('#OfferControlledBy2').removeAttr('checked');
		
		$('.row_coupon').css('display','none');
		$('.row_discount').css('display','none');
		$('.row_pledge').css('display','none');			
		$('.row_charity').css('display','none');
		$('.radio_nonprofit').css('display','none');
		$('.row_min_pur').css('display','none');
		$('.row_max_coupon').css('display','none');
		$('#row_endtime').css('display','none');
		$('#row_starttime').css('display','none');
		$('#row_recurrencerange').css('display','none');
		$('#row_recurpatterns').css('display','none');
		$('#row_enddate').css('display','none');
		$('#row_startdate').css('display','none');
		$('.row_max_coupon').css('display','none');
		$('.row_min_pur').css('display','none');	
		$('#row_offername').css('display','none');
		$('#row_controlled').css('display','none');
		$('#row_recurpattern').css('display','none');
		$('.row_related_event').css('display','none');	
		$('.row_event_detail').css('display','none');	
		$('.row_offer_detail').css('display','none');
		$('#row_merchantdetail').css('display','none');
		$('#row_responderoffer').css('display','none');		
		
		switch(offertype){
			case '1':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy2').css('display','table-row');
				$('#OfferControlledBy2').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy2').val());
				$('.radio_nonprofit').css('display','block');	
				$('#row_offername').css('display','table-row');
				$('.row_coupon').css('display','table-row');	
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');
				$('.row_max_coupon').css('display','table-row');
				$('.row_related_event').css('display','table-row');				
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');		
				break;
			case '2':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy2').css('display','table-row');
				$('#OfferControlledBy2').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy2').val());
				$('.radio_nonprofit').css('display','block');	
				$('#row_offername').css('display','table-row');
				$('.row_coupon').css('display','table-row');	
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');												 
				break;
			case '3':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy0').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy0').val());	
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');
				$('.row_coupon').css('display','table-row');	
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');
				$('.row_max_coupon').css('display','table-row');
				$('.row_related_event').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');														 
				break;
			case '4':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy1').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy1').val());	
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');
				$('.row_coupon').css('display','table-row');	
				$('.row_charity').css('display','table-row');
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');
				$('.row_max_coupon').css('display','table-row');
				$('.row_related_event').css('display','table-row');	
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');													 
				break;
			case '5':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy0').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy0').val());	
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');
				$('.row_coupon').css('display','table-row');	
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');										 							
				break;
			case '6':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy1').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy1').val());	
				
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');
				$('.row_coupon').css('display','table-row');	
				$('.row_charity').css('display','table-row');
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');										 
				break;				
			case '7':
				$('#OfferControlledBy_').val('0');	
				$('#row_offername').css('display','table-row');
				$('.row_discount').css('display','table-row');	
				$('.row_min_pur').css('display','table-row');
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');										
				break;
			case '8':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy0').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy0').val());	
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');
				$('.row_discount').css('display','table-row');	
				$('.row_min_pur').css('display','table-row');
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				$('.row_offer_detail').css('display','table-row');							
				break;
			case '9':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy1').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy1').val());	
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');
				$('.row_discount').css('display','table-row');	
				$('.row_min_pur').css('display','table-row');
				$('.row_charity').css('display','table-row');
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				break;
			case '10':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy0').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy0').val());	
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');
				$('.row_discount').css('display','table-row');	
				$('.row_min_pur').css('display','table-row');
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('.row_offer_detail').css('display','table-row');
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');
				break;
			case '11':
				$('#row_controlled').css('display','table-row');
				$('#OfferControlledBy1').attr('checked','checked');
				$('#OfferControlledBy_').val($('#OfferControlledBy1').val());	
				$('#row_offername').css('display','table-row');
				$('.row_pledge').css('display','table-row');	
				$('.row_min_pur').css('display','table-row');
				$('.row_charity').css('display','table-row');
				$('#row_endtime').css('display','table-row');
				$('#row_starttime').css('display','table-row');
				$('#row_recurrencerange').css('display','table-row');
				$('#row_recurpattern').css('display','table-row');
				$('#row_recurpatterns').css('display','table-row');
				$('#row_enddate').css('display','table-row');
				$('#row_startdate').css('display','table-row');		
				$('.row_event_detail').css('display','table-row');	
				$('.row_offer_detail').css('display','table-row');
				$('#row_merchantdetail').css('display','table-row');
				$('#row_responderoffer').css('display','table-row');			
				break;						 											 				
		}
	}
	
	function getMerchantLocations(){
		var url=baseUrl+'offers/update_merchantlocation/'+$('#merchant_id').val()+'/<?php echo $sel_mer ?>';
		//alert(url);
		$.ajax({
			type: 'GET',
			url: url,
			dataType: "html",
			success: function(data){
				$('#merchant_location').html(data);
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
		getOfferTypeData();
		getMerchantLocations();
		getOfferNOnPofit();
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
	
	$('input[id="merchantlocationall"]').live('change', function(){
		if($(this).is(':checked')){
			$('input[id^="merchantlocation"]').each( function(){
				$(this).attr('checked',true);
			});
		}else{
			$('input[id^="merchantlocation"]').each( function(){
				$(this).attr('checked',false);
			});
		}
	})
	
</script>
