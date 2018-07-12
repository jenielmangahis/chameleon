<script type="text/javascript">
	$(document).ready(function() {
		$('#hoMe').removeClass("butBg");
		$('#hoMe').addClass("butBgSelt");
	}); 
</script>
<style>
.dashboard_actions{
	
}

.dashboard_actions .box{
	height:100px;
	width:400px;
	border: 2px groove gray;
	float: left;
	margin:0 30px 20px 10px;
}

.dashboard_actions .box h5{
	display: block;
	height: 15px;
	padding: 0 5px;
}

.dashboard_actions .new_members h5{
	background-color: #0600ff;
	color: #FFF;
}
.dashboard_actions .events h5{
	background-color: #edc959;
}
.dashboard_actions .mail_task h5{
	background-color: #f6ed0c;
}
.dashboard_actions .forms h5{
	background-color: #f29a99;
}
.dashboard_actions .message h5{
	background-color: #faaa00;
	color: #FFF;
}
.dashboard_actions .coupons h5{
	background-color: #4e9106;
	color: #FFF;
}

</style>

<!--container starts here-->
<?php //$pagination->setPaging($paging); ?>
<div class="titlCont">
<div style="width:960px;margin:0 auto">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
			<?php  echo $this->renderElement('new_slider');  ?>
		</div>
	<div class="centerPage">
		
		<span class="newtitlTxt">Dashboard - Latest Actions</span>
		<div class="topTabs"></div>
	</div>
</div>
</div>
<div class="midCont">

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
	<div class="dashboard_actions">
		<div class="box new_members">
			<h5>New Member Registered</h5>
			<?php if($memberlist){
				foreach($memberlist as $memberlistrow){
					$countryId = $memberlistrow['Holder']['country'];
					$countryName = AppController::getcountryname($countryId);
					$createdDate = date('m/d/Y',strtotime($memberlistrow['Holder']['created']));					
					$memberType = $memberlistrow['MemberType']['member_type'];
					$screenName = $memberlistrow['Holder']['screenname'];
					$zipCode = $memberlistrow['Holder']['zipcode'];
					$memberdata = $createdDate.' , '.$memberType.' , '. $screenName.' , '.$countryName .' , '.$zipCode .'<br />';
					echo $memberdata ;	
				}
			
			} ?>
		</div>
		<div class="box events">
			<h5>Events</h5>
			<?php if($eventArray){
				foreach($eventArray as $event){
					$createdDate = date('m/d/Y',strtotime($event['Event']['created']));					
					
					$title		 = 	(strlen($event['Event']['title']) > 11)?substr($event['Event']['title'],0,11).'...':$event['Event']['title'];
					//$location		 = 	(strlen($event['Event']['location']) > 5)?substr($event['Event']['location'],0,6):$event['Event']['location'];
					
					$title = ucfirst($title);
					
					//$location 	 =  ucfirst($location);
					$start_date  = date('m/d/Y',strtotime($event['Event']['starttime']));
					if($event['Event']['endtime']!="0000-00-00"){
						$end_date = date('m/d/Y',strtotime($event['Event']['endtime']));						
					}else{ $end_date ="N/A";}	
						
					
					$eventdata = $createdDate.' , '.$title.' , Start from '. $start_date.' to '.$end_date .'<br />';
					echo $eventdata ;	
				}
			
			} ?>
		</div>
		<div class="box mail_task">
			<h5>Mail Task Sent</h5>
			<?php if($CommunicationTaskHistory){
				foreach($CommunicationTaskHistory as $CommunicationTaskHistory){
					$taskName = $CommunicationTaskHistory['CommunicationTaskHistory']['task_name'];
					$tmpId = $CommunicationTaskHistory['CommunicationTaskHistory']['email_template_id'];
					$tmpname = $common->getTempName($tmpId);
					$createdDate = date('m/d/Y',strtotime($CommunicationTaskHistory['CommunicationTaskHistory']['created']));					
					$rec_pattern = $CommunicationTaskHistory['CommunicationTaskHistory']['recur_pattern'];
					$CommunicationTaskHistory = $createdDate.' , '.$taskName.' , '. $tmpname.' , '.$rec_pattern .' <br />';
					echo $CommunicationTaskHistory ;	
				}
			
			} ?>
		</div>
		<div class="box forms">
			<h5>Forms Completed</h5>
			<?php if($newinquirydata){
				foreach($newinquirydata as $newinquiry){
					$createdDate = date('m/d/Y',strtotime($newinquiry['FormSubmit']['created']));					
					$company_name =   ucfirst($newinquiry['FormSubmit']['fld_company']);  
					$first_name	  =   ucfirst($newinquiry['FormSubmit']['fld_firstname']);  
					$last_name    =   ucfirst($newinquiry['FormSubmit']['fld_lastname']);  
					$city_name    =   ucfirst($newinquiry['FormSubmit']['fld_city']);
					
					$newinquirydata = $createdDate.' , '.$first_name.' , '. $last_name.' , '.$company_name .' , '.$city_name .'<br />';
					echo $newinquirydata ;	
				}
			
			} ?>
		</div>
		<div class="box message">
			<h5>New Messages</h5>
			<?php if($newMsgs){
				foreach($newMsgs as $newMsg){
					$createdDate = date('m/d/Y',strtotime($newMsg['MessageHolder']['created']));					
					$memberType = ucfirst($newMsg['MessageHolder']['usertype']);
					$holdernames = ucfirst($newMsg['Message']['from_holdername'])."-".ucfirst($newMsg['Message']['to_holdername']);

					$msgdata = $createdDate.' , '.$memberType.' , '. $holdernames.'<br />';
					echo $msgdata ;	
				}
			
			} ?>
			
		</div>
		<div class="box coupons">
			<h5>Coupons</h5>
			<?php if($coupondata){
				foreach($coupondata as $coupon){
					$createdDate = date('m/d/Y',strtotime($coupon['Coupon']['created']));					
					$title = $coupon['Coupon']['title'];
					$start_date = date('m/d/Y',strtotime($coupon['Coupon']['starttime']));
					if($coupon['Coupon']['coupon_end_by_date']!="0000-00-00"){
						$end_date = date('m/d/Y',strtotime($coupon['Coupon']['coupon_end_by_date']));						
					}else{ $end_date ="N/A";}	
						
					
					$coupondata = $createdDate.' , '.$title.' , Start from '. $start_date.' to '.$end_date .'<br />';
					echo $coupondata ;	
				}
			
			} ?>
		</div>

	</div>
</div>
