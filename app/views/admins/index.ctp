<script type="text/javascript">
	$(document).ready(function() {
		$('#hoMe').removeClass("butBg");
		$('#hoMe').addClass("butBgSelt");
	}); 
</script>

<!--container starts here-->
<?php //$pagination->setPaging($paging); ?>
<div class="titlCont container-fluid">
    <div class="slider-centerpage clearfix">
        												        
        <div class="center-Page col-sm-6">            
            <h2>Dashboard - Latest Actions</h2>
            <!--<div class="topTabs"></div>-->
        </div>        
        <div class="slider-dashboard col-sm-6 clearfix"> <!--<div class="slider col-sm-6" id="toppanel">-->
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>
        
    </div>
</div>
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
	<div class="dashboard_actions clearfix">
    	<div class="row">
            <div class="box new_members col-xs-4">
                <h4>New Member Registered</h4>
                <ul>
                    <?php if($memberlist){
                        foreach($memberlist as $memberlistrow){
                            $countryId = $memberlistrow['Holder']['country'];
                            $countryName = AppController::getcountryname($countryId);
                            $createdDate = date('m/d/Y',strtotime($memberlistrow['Holder']['created']));					
                            $memberType = $memberlistrow['MemberType']['member_type'];
                            $screenName = $memberlistrow['Holder']['screenname'];
                            $zipCode = $memberlistrow['Holder']['zipcode'];
                            $memberdata = '<li>'. $createdDate.' , '.$memberType.' , '. $screenName.' , '.$countryName .' , '.$zipCode .'</li>';
                            echo $memberdata ;	
                        }
                    
                    } ?>
                </ul>
            </div>
            <div class="box events col-xs-4">
                <h4>Events</h4>
                <ul>             
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
                                
                            
                            $eventdata = '<li>'. $createdDate.' , '.$title.' , Start from '. $start_date.' to '.$end_date .'</li>';
                            echo $eventdata ;	
                        }
                    
                    } ?>
                </ul>
            </div>
            <div class="box mail_task col-xs-4">
                <h4>Mail Task Sent</h4>
                <ul>
                    <?php if($CommunicationTaskHistory){
                        foreach($CommunicationTaskHistory as $CommunicationTaskHistory){
                            $taskName = $CommunicationTaskHistory['CommunicationTaskHistory']['task_name'];
                            $tmpId = $CommunicationTaskHistory['CommunicationTaskHistory']['email_template_id'];
                            $tmpname = $common->getTempName($tmpId);
                            $createdDate = date('m/d/Y',strtotime($CommunicationTaskHistory['CommunicationTaskHistory']['created']));					
                            $rec_pattern = $CommunicationTaskHistory['CommunicationTaskHistory']['recur_pattern'];
                            $CommunicationTaskHistory = '<li>'. $createdDate.' , '.$taskName.' , '. $tmpname.' , '.$rec_pattern .'</li>';
                            echo $CommunicationTaskHistory ;	
                        }
                    
                    } ?>
                </ul>
            </div>
            <div class="box forms col-xs-4">
                <h4>Forms Completed</h4>
                <ul>
                    <?php if($newinquirydata){
                        foreach($newinquirydata as $newinquiry){
                            $createdDate = date('m/d/Y',strtotime($newinquiry['FormSubmit']['created']));					
                            $company_name =   ucfirst($newinquiry['FormSubmit']['fld_company']);  
                            $first_name	  =   ucfirst($newinquiry['FormSubmit']['fld_firstname']);  
                            $last_name    =   ucfirst($newinquiry['FormSubmit']['fld_lastname']);  
                            $city_name    =   ucfirst($newinquiry['FormSubmit']['fld_city']);
                            
                            $newinquirydata = '<li>'. $createdDate.' , '.$first_name.' , '. $last_name.' , '.$company_name .' , '.$city_name .'</li>';
                            echo $newinquirydata ;	
                        }
                    
                    } ?>
                </ul>
            </div>
            <div class="box message col-xs-4">
                <h4>New Messages</h4>
                <ul>
                    <?php if($newMsgs){
                        foreach($newMsgs as $newMsg){
                            $createdDate = date('m/d/Y',strtotime($newMsg['MessageHolder']['created']));					
                            $memberType = ucfirst($newMsg['MessageHolder']['usertype']);
                            $holdernames = ucfirst($newMsg['Message']['from_holdername'])."-".ucfirst($newMsg['Message']['to_holdername']);
                    
                            $msgdata = '<li>'. $createdDate.' , '.$memberType.' , '. $holdernames.'</li>';
                            echo $msgdata ;	
                        }
                    
                    } ?>
                </ul>                
            </div>
            <div class="box coupons col-xs-4">
                <h4>Coupons</h4>
                <ul>
                    <?php if($coupondata){
                        foreach($coupondata as $coupon){
                            $createdDate = date('m/d/Y',strtotime($coupon['Coupon']['created']));					
                            $title = $coupon['Coupon']['title'];
                            $start_date = date('m/d/Y',strtotime($coupon['Coupon']['starttime']));
                            if($coupon['Coupon']['coupon_end_by_date']!="0000-00-00"){
                                $end_date = date('m/d/Y',strtotime($coupon['Coupon']['coupon_end_by_date']));						
                            }else{ $end_date ="N/A";}	
                                
                            
                            $coupondata = '<li>'. $createdDate.' , '.$title.' , Start from '. $start_date.' to '.$end_date .'</li>';
                            echo $coupondata ;	
                        }
                    
                    } ?>
                </ul>
            </div>
		</div> <!--ROW-->
	</div>
</div>
