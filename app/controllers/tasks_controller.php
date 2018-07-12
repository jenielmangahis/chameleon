<?php
    /* Project           :-  imagecoin website
    * Controller Name :-  companies_contoller.php
    * Created  On     :-  15-02-10 (10:00am)
    * Description     :-  This controller contains all the methods for tasks that will be 
    *                     managed by project website                        
    */
    class TasksController extends AppController {

        var $name = 'Companies';
        var $uses     = array('Project','Sponsor','Comment','Subcomment','Content','CoinsHolder','Coinset','Holder','EmailTemplate','User','UserSession','Country','Company','CompanyType','Contact','Term','CoinTransferRequest','ProjectGraphic','CommentType','ProjectCommentType','Point','Invitation', 'ProductType','PricingType','PointArchiveUser','MailFooter');
        var $helpers = array('Common','Pagination','Html', 'Form','Session','Qrcode','Javascript','Tinymce','Recaptcha','Fck','Csv','csv','Ajax','Calendar');
        var $components = array('Backup', 'EmailTemplates', 'ForceDownload','Session','Cookie','Pagination','File','Sendemail','Mpdf', 'Progress','Payment','RequestHandler','Recaptcha','Filegenerator','Imageresizing');
        var $layout = 'layout';

        ####################################
        # Function Name:requestData

        # Parameter    :NA
        ####################################

        function beforeFilter() {
				 /*permission code start*/	
			 if($this->Session->check("UserLoginDetails"))
			 {
			  	$admin =  $this->Session->read("UserLoginDetails");
				$permissions = array();
				if(!empty($admin))
				{
					//if($admin['Admin']['username']!='admin')
					//{
            			$permissions = $this->check_user_permissions($admin['Admin']['user_type']);
					//}
				}
				if(!empty($permissions))
				{
					$this->set('hideMenuPermission',$permissions);	
				}
			}
			/*permission code end*/	


        }

        function taskcron(){
            ##import project type model for processing
            App::import("Model", "CommunicationTask");
            $this->CommunicationTask =   & new CommunicationTask();    
               
            // STEP : FETCH TASK TO EXECUTE - WHOSE EXECUTION DATE IS TODAY AND TASK IS NOT DONE YET
            $field='';
            $condition = "CommunicationTask.delete_status = '0' and CommunicationTask.task_is_done='0' and CommunicationTask.is_temp = '0' and DATE(CommunicationTask.task_next_execution_date)=CURRENT_DATE";
            $taskdata = $this->CommunicationTask->find('all',array("conditions"=>$condition));
            if($taskdata){     // echo "<br/>  Task Data ";
                // STEP : EXECUTE  EACH SELECTED TASK  
                foreach($taskdata as $taskdetail){ 
                        //     echo "<pre>"; print_r($taskdetail); echo "</pre>";   
                  // echo "<br/>  Task NAME :  ".$taskdetail['CommunicationTask']['id']." ".$taskdetail['CommunicationTask']['task_name'];  
                    // STEP : ADD TASK TO TASK HISTORY TABLE AND GET TASK EXECUTION HISTORY ID
                    $taskHistoryId=$this->saveTaskHistorybyTaskArray($taskdetail['CommunicationTask']);
                    // STEP : EXECUTE TASK USING  TASK DETAIL, TASK HISTORY ID
                    if($taskHistoryId > 0){   // echo "<br/> Execute Task ";  
                        $this->taskexecute($taskdetail['CommunicationTask'], $taskHistoryId);
                    }

                   // exit;      
                }



               
             //   
            }else{
             //   echo "No Task executes today!!!";
            }
            
            exit;

        }


        function saveTaskHistorybyTaskArray($taskArray){      // echo "<br/> Task History "; 
            ##import project type model for processing
            App::import("Model", "CommunicationTaskHistory");
            $this->CommunicationTaskHistory =   & new CommunicationTaskHistory();  
            $data['CommunicationTaskHistory'] =$taskArray;
            $data['CommunicationTaskHistory']['id'] ='';
            $data['CommunicationTaskHistory']['task_id'] =$taskArray['id'];
            $data['CommunicationTaskHistory']['task_execution_date'] =  date('Y-m-d h:i:s');
            $data['CommunicationTaskHistory']['created'] =''; 
            $data['CommunicationTaskHistory']['modified'] =''; 
            if($this->CommunicationTaskHistory->save($data['CommunicationTaskHistory'])){
                $history_id=  $this->CommunicationTaskHistory->getLastInsertID(); 
                // echo " Saved "; 
            }else{
                $history_id =0;    
                //  echo "Save Error "; 
            }

            return $history_id; 
        }

        function taskexecute($taskArray, $taskHistoryId) {
            ##import project type model for processing
            App::import("Model", "CommunicationTask");
            $this->CommunicationTask =   & new CommunicationTask();    

            // STEP : GET TASK MATCHING LIST OF MEMBERS OR CONTACTS   
            $taskid=$taskArray['id']; 
            $projectid=$taskArray['project_id']; 
            $projectDetails=$this->getprojectdetails($projectid); 
            // echo "<br/>  Task Matching List : ";      
            $matchingList=$this->CommunicationTask->getEmailTaskMatchingMembersOrContacts($taskid, $projectid);
           // echo "<pre>"; print_r($matchingList); echo "</pre>";    //exit;  
            if($matchingList) {        //echo "<br/>  Email Temp  : ";  
                // STEP : SEND RELATED EMAIL TEMPLATE OF TASK TO EACH EMAIL OF MATCHING LIST
                $taskEmailTempId=$taskArray['email_template_id'];
                $taskEmailSubject=$taskArray['email_subject'];
                 $taskEmailFromEmail=$taskArray['email_from'];

                App::import("Model", "EmailTemplate");
                $this->EmailTemplate =   & new EmailTemplate();
                $emailcond = "EmailTemplate.delete_status = '0' and EmailTemplate.id='".$taskEmailTempId."' ";
                $emailTempData = $this->EmailTemplate->find('first',array("conditions"=>$emailcond));
                $taskEmailContent =  $emailTempData['EmailTemplate']['content'];
                
                
                 /** As Per discussion 12-29-2011  - Remove Mail Footer from live untile add 'Opt Out' button   **/   
                        ///////////////////////////////// append mail footer set by super admin -U /////////////////////////
                          App::import("Model", "MailFooter");
                          $this->MailFooter =   & new MailFooter();
                            $condition = "id='1'";
                            $mailfooter_data = $this->MailFooter->find('first',array('conditions' => $condition));
                            $mailfooter=$mailfooter_data['MailFooter']['footer_content'];                            
                            $taskEmailContent.=$mailfooter;
                        ///////////////////////////////// append mail footer set by super admin /////////////////////////

                //STEP: INIT EMAIL TEMPLATES DATA ELEMENTS    
                $dataEleValuesArray=$this->EmailTemplates->initEmailTemplDataElemntsArray($projectid, $projectDetails);   
                $task_email_sent_count=0; 
                $task_email_senterror_count=0; 
                App::import("Model", "CommunicationTaskExecutionReport");
                $this->CommunicationTaskExecutionReport =   & new CommunicationTaskExecutionReport();
                foreach($matchingList as  $matchingItem) {
                    $email_subject="";
                    $email_content="";
                    $sent_to_email="";
                    $sent_to_holderid=0;
                    $sent_to_firstname="";
                    $sent_to_lastname="";
                    $email_status="";
                    if(isset($matchingItem['Contact']) ){
                        $sent_to_email=$matchingItem['Contact']['email'];     
                        $sent_to_firstname=$matchingItem['Contact']['firstname'];     
                        $sent_to_lastname=$matchingItem['Contact']['lastname'];     
                        $sent_to_company=$matchingItem['Company']['companyname'];  
                        $sent_to_matching="contact"; 
                        $sent_to_holderid=0;
                        //STEP : SET VALUES TO REQUIRED DATA ELEMENTS   
                        $dataEleValuesArray[DATA_ELEMENT_MEMBER_FIRSTNAME]= $mailserial;
                        $this->EmailTemplates->setEmailTempDataElementValuesArray($dataEleValuesArray);  
                    }else{
                        $sent_to_holderid=$matchingItem['Holder']['id'];     
                        $sent_to_email=$matchingItem['Holder']['email'];     
                        $sent_to_firstname=$matchingItem['Holder']['firstname'];     
                        $sent_to_lastname=$matchingItem['Holder']['lastname'];     
                        $sent_to_company="";
                        $sent_to_matching="member";
                    } 

                    //STEP : SET VALUES TO REQUIRED DATA ELEMENTS  
                    $dataEleValuesArray[DATA_ELEMENT_MEMBER_FIRSTNAME]= $sent_to_firstname;
                    $dataEleValuesArray[DATA_ELEMENT_MEMBER_LASTNAME]= $sent_to_lastname;
                    $dataEleValuesArray[DATA_ELEMENT_TO_MEMEBR_EMAIL]= $sent_to_email;
                    $dataEleValuesArray[DATA_ELEMENT_TO_MEMBER_NAME]= $sent_to_firstname;

                    $dataEleValuesArray[DATA_ELEMENT_CONTACT_FIRSTNAME]= $sent_to_firstname;
                    $dataEleValuesArray[DATA_ELEMENT_CONTACT_LASTNAME]= $sent_to_lastname;
                    $dataEleValuesArray[DATA_ELEMENT_CONTACT_EMAIL]= $sent_to_email;
                    $dataEleValuesArray[DATA_ELEMENT_CONTACT_COMPANY]= $sent_to_firstname;
                    $this->EmailTemplates->setEmailTempDataElementValuesArray($dataEleValuesArray);        
                    //STEP : INSERT VALUES AT DATA ELEMETNS FOR EMAIL SUBJECT AND EMAIL MESSAGE
                    $email_subject=$this->EmailTemplates->insertDataElementValuesToContent($taskEmailSubject);
                    $email_content=$this->EmailTemplates->insertDataElementValuesToContent($taskEmailContent);

                   if(!$this->Sendemail->sendMailContent($sent_to_email,$taskEmailFromEmail,$email_subject,$email_content,$taskEmailFromEmail)){
                        $task_email_senterror_count++;
                        $email_sent="0";
                    }else{
                        $task_email_sent_count++;
                        $email_sent="1";
                    }  
                    // STEP :  ADD TASK SENT EMAIL DETAILS TO COMMUNICATION_TASK_SENT_REPORT TABLE  
                       $taskReport['CommunicationTaskExecutionReport']['id']='';
                       $taskReport['CommunicationTaskExecutionReport']['task_id']=$taskid;
                       $taskReport['CommunicationTaskExecutionReport']['task_execution_id']=$taskHistoryId;
                       $taskReport['CommunicationTaskExecutionReport']['project_id']=$projectid;
                       $taskReport['CommunicationTaskExecutionReport']['email_template_id']=$taskEmailTempId;
                       $taskReport['CommunicationTaskExecutionReport']['sent_to_holderid']=$sent_to_holderid;
                       $taskReport['CommunicationTaskExecutionReport']['sent_to_email']=$sent_to_email;
                       $taskReport['CommunicationTaskExecutionReport']['sent_to_firstname']=$sent_to_firstname;
                       $taskReport['CommunicationTaskExecutionReport']['sent_to_lastname']=$sent_to_lastname;
                       $taskReport['CommunicationTaskExecutionReport']['sent_to_company']=$sent_to_company;
                       $taskReport['CommunicationTaskExecutionReport']['sent_to_matching']=$sent_to_matching;
                       $taskReport['CommunicationTaskExecutionReport']['email_subject']=$email_subject;
                       $taskReport['CommunicationTaskExecutionReport']['email_content']=$email_content;
                       $taskReport['CommunicationTaskExecutionReport']['email_from']=$taskEmailFromEmail;
                       $taskReport['CommunicationTaskExecutionReport']['email_sent']=$email_sent;
                       $this->CommunicationTaskExecutionReport->save($taskReport['CommunicationTaskExecutionReport']);
                       
                      //send event invitation if it is an event task
                      if($taskArray['send_event_invitation']=='1' && $taskArray['rec_event_id']!="")
                      {
                          App::import("Model", "EventInvitation");
                          $this->EventInvitation =   & new EventInvitation();
                          
                          $event_inv['EventInvitation']['id']='';
                          $event_inv['EventInvitation']['project_id']=$taskArray['project_id'];
                          $event_inv['EventInvitation']['event_id']='';
                          $event_inv['EventInvitation']['rec_event_id']=$taskArray['rec_event_id'];
                          $event_inv['EventInvitation']['invite_status']='0';
                          $event_inv['EventInvitation']['active_status']='1';
                          $event_inv['EventInvitation']['delete_status']='0';
                          
                          if($taskArray['company_type']!="" && $taskArray['contact_type']!="")
                          {
                              $event_inv['EventInvitation']['invite_to_contact_id']=$matchingItem['Contact']['id'];
                              $event_inv['EventInvitation']['is_contact']='1';
                          }
                          else
                          {
                              $event_inv['EventInvitation']['invite_to_holder_id']=$matchingItem['Holder']['id'];
                          }
                          
                          $this->EventInvitation->save($event_inv['EventInvitation']);
                       
                      } 
                    
                }


            }

            
            // STEP : UPDATE TASK task_execution_count AND task_occurrences_count
            $taskArray['task_execution_count']=$taskArray['task_execution_count']+1;  
            $taskArray['task_occurrences_count']=$taskArray['task_occurrences_count']+1;
                 
            
            // STEP :  SET TASK ARRAY LAST EXECUTION DATE = CURRENT DATE
            $taskArray['task_last_execution_date']=date('Y-m-d h:i:s');
            $taskArray['task_last_occurrence_date']=date('Y-m-d h:i:s');
            
            // STEP : CALCULATE TASK NEXT ECECUTION DATE  AND UPDATE TASK ARRAY NEXT EXECUTIOND DATE = CALCULATED DATE
            $exeTask=$this->resetTaskForNextExecution($taskArray);

           // echo "<br/>  Update History Array : ";                
            // STEP : UPDATE TASK History ARRAY
            $taskHistoryArray['id']=$taskHistoryId;
            $taskHistoryArray['task_sent_count']=$task_email_sent_count;
            $taskHistoryArray['task_not_sent_count']=$task_email_senterror_count;
          
            App::import("Model", "CommunicationTaskHistory");
            $this->CommunicationTaskHistory =   & new CommunicationTaskHistory();  
            if($this->CommunicationTaskHistory->save($taskHistoryArray)){
              // echo  $taskHistory="Updated";
            }else{
              // echo $taskHistory="Error";  
            }
        }

        function resetTaskForNextExecution($taskArray){
            App::import("Model", "CommunicationTask");
            $this->CommunicationTask =   & new CommunicationTask();  
                
            // STEP: TASK RECUR PATTERN
            $taskRecurPattern=$taskArray['recur_pattern'];      
            // STEP : TASK INIT OCCURRENCE PARAMETERS
            $taskStartOccurenceDate=$taskArray['task_start_occurrence_date'];
            $taskLastOccurenceDate=$taskArray['task_last_occurrence_date'];
            $taskLastExecutionDate=$taskArray['task_last_execution_date'];
            $taskTotalOccurenceCount=$taskArray['task_occurrences_count'];
            $taskNextOccurenceDate="0000-00-00";
            $task_is_done=0;

            // STEP : TASK START AND EDN PARAMATERS 
            $taskStartDate=$taskArray['task_startdate'];
            $taskEndBy=$taskArray['task_end'];
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate="0000-00-00";       

            if($taskEndBy=="after_accurrences"){
                $taskTaskEndAfterOccurrences=$taskArray['task_end_after_occurrences']; 
                $taskTaskEndByDate="0000-00-00";
            }else if($taskEndBy=="by_date"){
                    $taskTaskEndAfterOccurrences=0;    
                    $taskTaskEndByDate=$taskArray['task_end_by_date'];    
                }else{
                    $taskTaskEndAfterOccurrences=0;    
                    $taskTaskEndByDate="0000-00-00";       
            }
            $today=date('Y-m-d');
           // echo "<br/>  Reset Task NExt Exe  : ".$taskRecurPattern;
            // echo "<br/>  LasttExe Date  : ".$taskLastOccurenceDate;          
            switch ($taskRecurPattern) {
                case "Yearly":        
                    $taskYearlyPattern=$taskArray['yearly_pattern'];    // everynoofmonths  theweekofmonths
                    $taskYearEveryMonth=$taskArray['yearly_everymonth'];
                    $taskYearEveryMonthDate=$taskArray['yearly_everymonth_date'];
                    $taskYearWeekNumber=$taskArray['yearly_weeknumber'];  // first, last , third ect
                    $taskYearWeekDayName=$taskArray['yearly_weekday'];     //Friday
                    $taskYearWeekMonthName=$taskArray['yearly_weekof_month'];  // May, June etc
                    $taskNextOccurenceDate=$this->CommunicationTask->calculateYearlyNextExecutionDate($taskLastOccurenceDate, $taskTotalOccurenceCount,$taskStartDate,$taskYearlyPattern, $taskYearEveryMonth, $taskYearEveryMonthDate,$taskYearWeekNumber, $taskYearWeekDayName, $taskYearWeekMonthName, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                    break;
                case "Monthly":
                    $taskMonthlyPattern=$taskArray['monthly_pattern']; 
                    $taskMonthDate=$taskArray['monthly_onof_day'];
                    $taskMonthEveryNumofMonth=$taskArray['monthly_every_noof_months'];
                    $taskMonthWeekNumber=$taskArray['monthly_weeknumber'];
                    $taskMonthWeekDayName=$taskArray['monthly_weekday'];
                    $taskMonthWeekEveryNumofMonth=$taskArray['monthly_weekof_noof_months']; 
                    //$taskNextOccurenceDate=$this->CommunicationTask->calculateYearlyNextExecutionDate($taskLastOccurenceDate, $taskTotalOccurenceCount,$taskStartDate);
                    break;
                case "Weekly":
                    $taskEveryNumofWeeks=$taskArray['weekly_every_noof_weeks'];
                    $taskWeekMonday=$taskArray['weekly_monday'];
                    $taskWeekTuesday=$taskArray['weekly_tuesday'];
                    $taskWeekWednesday=$taskArray['weekly_wednesday'];
                    $taskWeekThursday=$taskArray['weekly_thursday'];
                    $taskWeekFriday=$taskArray['weekly_friday'];
                    $taskWeekSaturday=$taskArray['weekly_saturday'];
                    $taskWeekSunday=$taskArray['weekly_sunday'];                 
                    $taskWeekDayArray= array(
                    "1"=> $taskWeekMonday,
                    "2"=> $taskWeekTuesday,
                    "3"=> $taskWeekWednesday,
                    "4"=> $taskWeekThursday,
                    "5"=> $taskWeekFriday,
                    "6"=> $taskWeekSaturday,
                    "7"=> $taskWeekSunday,
                    );

                    $taskExeNumOfTimesInWeek=0;
                    for($i=1; $i<=7; $i++){
                        if($taskWeekDayArray[$i]==1){
                            $taskExeNumOfTimesInWeek++;
                        }
                    }
                    $taskNextOccurenceDate=$this->CommunicationTask->calculateWeeklyNextExecutionDate($taskLastOccurenceDate, $taskTotalOccurenceCount,$taskStartDate, $taskEveryNumofWeeks, $taskWeekDayArray, $taskExeNumOfTimesInWeek, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);  
                    break;
                case "Daily":
                    $taskDailyPattern=$taskArray['daily_pattern'];       // everyday  everyweek
                    $taskDailyEveryNumofDays=$taskArray['daily_every_noof_days'];
                    $taskNextOccurenceDate=$this->CommunicationTask->calculateDailyNextExecutionDate($taskLastOccurenceDate, $taskTotalOccurenceCount,$taskStartDate,$taskDailyPattern, $taskDailyEveryNumofDays,$taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                    break;
            }
            //  echo "<br/>  NextExe Date  : ".$taskNextOccurenceDate;          
            if($taskNextOccurenceDate=="0000-00-00"){
                $task_is_done=1;
            }
            /*   $taskArray['task_last_execution_date']=$taskLastExecutionDate;   
            $taskArray['task_execution_count']=$taskL;
            $taskArray['task_start_occurrence_date']=$taskStartOccurenceDate;
            $taskArray['task_last_occurrence_date']=$taskLastOccurenceDate;
            $taskArray['task_occurrences_count']=$taskTotalOccurenceCount;   */
            $taskArray['task_next_execution_date']=$taskNextOccurenceDate;
            $taskArray['task_is_done']=$task_is_done; 
           // echo "<br/>  New Task Array : ";                
            //echo "<pre>"; print_r($taskArray); echo "</pre>"; 
            if($this->CommunicationTask->save($taskArray)){
                return true;
            }else{
                return false;
            }

        }


    }//end class

?>