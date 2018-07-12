<?php
    /* Project           :-  imagecoin website
    * Controller Name :-  companies_contoller.php
    * Created  On     :-  15-02-10 (10:00am)
    * Description     :-  This controller contains all the methods for tasks that will be 
    *                     managed by project website                        
    */
    class EventcronController extends AppController {

        var $name = 'Eventcron';
        var $uses     = array('Event','EventInvitation','RecurringEvent');
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
           
            $condition = "Event.active_status = '1' and Event.delete_status = '0' and (Event.stop_recur = '0' or Event.stop_recur is NULL)";  
            $events_data= $this->Event->find('all',array("conditions"=>$condition));
            
            if(!empty($events_data))           
            {
                foreach($events_data as $event_rec)
                {
                    $event_id=$event_rec['Event']['id'];
                    
                    $condition = "RecurringEvent.event_id =".$event_id;  
                    $order="RecurringEvent.id desc";
                    $limit="10";
                    $recur_event_data= $this->RecurringEvent->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit));
                    
                    $tasklastdate=$recur_event_data[0]['RecurringEvent']['start_date'];                   
                    //$checkdate=$recur_event_data[9]['RecurringEvent']['start_date'];
                    $lastrec= count($recur_event_data)-1;                    
                    $checkdata=$recur_event_data[$lastrec];
                    $check_date=$checkdata['RecurringEvent']['start_date'];
                    
                    $check_date=  date("Y-m-d", strtotime($check_date));
                    $today=date("Y-m-d");
                    
                    if($checkdate==$today)
                    {
                    
                        $recur_arr=array();
                        $event_arr=array();
                        
                        $recur_arr=$event_rec['Event'];
                        $recur_arr['event_id']=$event_id;
                        $recur_arr['event_title']=$this->data['Event']['title'];
                        
                        if($event_rec['Event']['recur_pattern']=="Daily")
                        {
                                                            
                                $today=date('Y-m-d');
                                
                                if($tasklastdate)
                                {
                                  
                                    $taskStartDate=$event_rec['Event']['start_time'];;
                                    $taskDailyPattern=$event_rec['Event']['daily_pattern'];
                                    $taskDailyEveryNumofDays=$event_rec['Event']['daily_every_noof_days'];
                                    $taskTaskEndByDate="0000-00-00";
                                    
                                    if($event_rec['Event']['task_end']=="by_no_date")
                                    {
                                        $taskTaskEndByDate="0000-00-00";
                                        $taskTotalOccurenceCount=0;                                    
                                                                           
                                        $taskLastOccurenceDate=$tasklastdate;
                                         
                                        
                                        for($i=0;$i<60;$i++)
                                        {
                                            $next_date=$this->RecurringEvent->calculateDailyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskDailyPattern, $taskDailyEveryNumofDays, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                            $taskLastOccurenceDate=$next_date;
                                            
                                            $recur_arr['start_date']=$next_date;
                                            $recur_arr['end_date']=$next_date; 
                                            $recur_arr['id']="";                               
                                            $this->RecurringEvent->Save($recur_arr);
                                                                                    
                                        }
                                        $event_arr['id']=$event_id;
                                        $event_arr['stop_recur']=0;
                                        $this->Event->Save($event_arr);
                                        
                                    }
                                    else
                                    if($event_rec['Event']['task_end']=="by_date")
                                    {
                                        
                                        $taskTaskEndByDate=$event_rec['Event']['task_end_by_date'];                       
                                        $taskTotalOccurenceCount=0;
                                        
                                        
                                        $taskLastOccurenceDate=$tasklastdate;
                                        
                                        $diff = abs(strtotime($taskLastOccurenceDate) - strtotime($taskTaskEndByDate));

                                        $years = floor($diff / (365*60*60*24));
                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                        if($months<=3)
                                        {  
                                            $complete_all=1;
                                            $event_arr['stop_recur']=1;
                                        }
                                        else
                                        {
                                            $complete_all=0;
                                            $a=0;
                                            $event_arr['stop_recur']=0;
                                        }                                  
                                                                          
                                            do{
                                               
                                                   if($complete_all==0)
                                                   {
                                                       if($a>=60)
                                                        break;
                                                       $a++;
                                                   }
                                                                                               
                                                   $next_date=$this->RecurringEvent->calculateDailyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskDailyPattern, $taskDailyEveryNumofDays, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                                   
                                                   $taskLastOccurenceDate= $next_date;
                                                   
                                                   if($next_date>$taskTaskEndByDate || $next_date=="0000-00-00")
                                                        break;
                                                   
                                                   $recur_arr['start_date']=$next_date;
                                                   $recur_arr['end_date']=$next_date;   
                                                   $recur_arr['id']="";                             
                                                   $this->RecurringEvent->Save($recur_arr);                                              
                                               
                                            }while($next_date<=$taskTaskEndByDate);
                                            
                                            $event_arr['id']=$event_id;                                       
                                            $this->Event->Save($event_arr);
                                        
                                    }
                                }
                                
                            }
                            
                        if($event_rec['Event']['recur_pattern']=="Weekly")
                        {
                                          
                                if($tasklastdate)
                                {
                                   
                                    //$total_rem_occ=$this->data['Event']['task_end_after_occurrences']-$weekly_arr['task_execution_count'];                                 
                                    //$taskTotalOccurenceCount=$weekly_arr['task_execution_count'];
                                    $taskTaskEndAfterOccurrences=0;
                                    $taskStartDate=$event_rec['Event']['starttime'];
                                    //$taskDailyPattern=$event_rec['Event']['daily_pattern'];
                                    $taskEveryNumofWeeks=$event_rec['Event']['weekly_every_noof_weeks'];
                                    $taskTaskEndByDate="0000-00-00";
                                    
                                    $taskWeekDayArray= array(
                                       "1"=> $event_rec['Event']['weekly_monday'],
                                       "2"=> $event_rec['Event']['weekly_tuesday'],
                                       "3"=> $event_rec['Event']['weekly_wednesday'],
                                       "4"=> $event_rec['Event']['weekly_thursday'],
                                       "5"=> $event_rec['Event']['weekly_friday'],
                                       "6"=> $event_rec['Event']['weekly_saturday'],
                                       "7"=> $event_rec['Event']['weekly_sunday'],
                                    );
                                    
                                     $taskExeNumOfTimesInWeek=0;
                                       for($i=1; $i<=7; $i++){
                                           if($taskWeekDayArray[$i]==1){
                                               $taskExeNumOfTimesInWeek++;
                                           }
                                       }
                                       
                                       
                                    if($event_rec['Event']['task_end']=="by_no_date")
                                    {
                                        $taskTaskEndByDate="0000-00-00";
                                        $taskTotalOccurenceCount=0;
                                                                           
                                        $taskLastOccurenceDate=$tasklastdate;
                                       
                                        for($i=0;$i<60;$i++)
                                        {
                                            $next_date=$this->RecurringEvent->calculateWeeklyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskEveryNumofWeeks, $taskWeekDayArray, $taskExeNumOfTimesInWeek, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                            $taskLastOccurenceDate=$next_date;
                                            
                                            $recur_arr['start_date']=$next_date;
                                            $recur_arr['end_date']=$next_date;   
                                            $recur_arr['id']="";
                                            $this->RecurringEvent->Save($recur_arr);
                                        }
                                        $event_arr['id']=$event_id;
                                        $event_arr['stop_recur']=0;
                                        $this->Event->Save($event_arr);
                                        
                                    }
                                    else
                                    if($event_rec['Event']['task_end']=="by_date")
                                    {
                                        
                                        $taskTaskEndByDate=$event_rec['Event']['task_end_by_date'];
                                       
                                        $taskLastOccurenceDate=$tasklastdate;
                                                                                                                                                           
                                        $taskTotalOccurenceCount=0;
                                        
                                        $diff = abs(strtotime($taskLastOccurenceDate) - strtotime($taskTaskEndByDate));

                                        $years = floor($diff / (365*60*60*24));
                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                        if($months<=3)
                                        {  
                                            $complete_all=1;
                                            $event_arr['stop_recur']=1;
                                        }
                                        else
                                        {
                                            $complete_all=0;
                                            $b=0;
                                            $event_arr['stop_recur']=0;
                                        }                                  
                                                                          
                                        do{
                                            
                                            if($complete_all==0)
                                            {
                                                if($b>=60)
                                                    break;
                                                $b++;
                                            }
                                                                                       
                                           $next_date=$this->RecurringEvent->calculateWeeklyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskEveryNumofWeeks, $taskWeekDayArray, $taskExeNumOfTimesInWeek, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                           
                                           $taskLastOccurenceDate= $next_date;
                                           
                                           if($next_date>$taskTaskEndByDate || $next_date=="0000-00-00")
                                                break;
                                           
                                           $recur_arr['start_date']=$next_date;
                                           $recur_arr['end_date']=$next_date;   
                                           $recur_arr['id']="";                             
                                           $this->RecurringEvent->Save($recur_arr);                                       
                                           
                                        }while($next_date<=$taskTaskEndByDate);
                                        
                                        $event_arr['id']=$event_id;                                  
                                        $this->Event->Save($event_arr);
                                    }
                                }
                                
                                
                                
                            }
                            
                        if($event_rec['Event']['recur_pattern']=="Monthly")
                        {                                                                                   
                                                    
                            if($tasklastdate)
                            {
                               
                                //$total_rem_occ=$this->data['Event']['task_end_after_occurrences']-$monthly_arr['task_execution_count'];                                 
                                //$taskTotalOccurenceCount=$monthly_arr['task_execution_count'];
                                $taskTaskEndAfterOccurrences=0;
                                $taskStartDate=$event_rec['Event']['starttime'];
                                $taskMonthlyPattern=$event_rec['Event']['monthly_pattern'];
                                $taskMonthDate=$event_rec['Event']['monthly_onof_day'];
                                $taskMonthEveryNumofMonth=$event_rec['Event']['monthly_every_noof_months'];
                                $taskMonthWeekNumber=$event_rec['Event']['monthly_weeknumber'];
                                $taskMonthWeekDayName=$event_rec['Event']['monthly_weekday'];
                                $taskMonthWeekEveryNumofMonth=$event_rec['Event']['monthly_weekof_noof_months'];                                                        
                                $taskTaskEndByDate="0000-00-00";
                                
                                                                  
                                                                
                                if($event_rec['Event']['task_end']=="by_no_date")
                                {
                                    $taskTaskEndByDate="0000-00-00";
                                    $taskTotalOccurenceCount=0;
                                    
                                    $taskLastOccurenceDate=$tasklastdate;

                                    for($i=0;$i<24;$i++)
                                    {
                                        $next_date=$this->RecurringEvent->calculateMonthlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskMonthlyPattern, $taskMonthDate,$taskMonthEveryNumofMonth,$taskMonthWeekNumber,$taskMonthWeekDayName, $taskMonthWeekEveryNumofMonth,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                        $taskLastOccurenceDate=$next_date;
                                        
                                        $recur_arr['start_date']=$next_date;
                                        $recur_arr['end_date']=$next_date;   
                                        $recur_arr['id']="";
                                        $this->RecurringEvent->Save($recur_arr);
                                    }
                                    $event_arr['id']=$event_id;
                                    $event_arr['stop_recur']=0;
                                    $this->Event->Save($event_arr);
                                    
                                }                               
                                else
                                if($event_rec['Event']['task_end']=="by_date")
                                {
                                    
                                    $taskTaskEndByDate=$event_rec['Event']['task_end_by_date'];
                                   
                                    $taskLastOccurenceDate=$tasklastdate;
                                                                                                            
                                    $taskTotalOccurenceCount=0;
                                    
                                    $diff = abs(strtotime($taskLastOccurenceDate) - strtotime($taskTaskEndByDate));

                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                    if($months<=24)
                                    {  
                                        $complete_all=1;
                                        $event_arr['stop_recur']=1;
                                    }
                                    else
                                    {
                                        $complete_all=0;
                                        $c=0;
                                        $event_arr['stop_recur']=0;
                                    }                                  
                                                                      
                                    do{
                                        
                                        if($complete_all==0)
                                        {
                                            if($c>=24)
                                                break;
                                            $c++;
                                        }
                                                                                   
                                       $next_date=$this->RecurringEvent->calculateMonthlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskMonthlyPattern, $taskMonthDate,$taskMonthEveryNumofMonth,$taskMonthWeekNumber,$taskMonthWeekDayName, $taskMonthWeekEveryNumofMonth,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                       
                                       $taskLastOccurenceDate= $next_date;
                                       
                                       if($next_date>$taskTaskEndByDate || $next_date=="0000-00-00")
                                            break;
                                       
                                       $recur_arr['start_date']=$next_date;
                                       $recur_arr['end_date']=$next_date;   
                                       $recur_arr['id']="";                             
                                       $this->RecurringEvent->Save($recur_arr);                                      
                                       
                                    }while($next_date<=$taskTaskEndByDate);
                                    
                                    $event_arr['id']=$event_id;
                                    $this->Event->Save($event_arr);
                                }
                            }
                            
                           
                            
                        }
                        
                        if($event_rec['Event']['recur_pattern']=="Yearly")
                        {
                                                                                  
                                                      
                            if($tasklastdate)
                            {
                               
                                //$total_rem_occ=$this->data['Event']['task_end_after_occurrences']-$yearly_arr['task_execution_count'];                                 
                                //$taskTotalOccurenceCount=$yearly_arr['task_execution_count'];
                                $taskTaskEndAfterOccurrences=$event_rec['Event']['task_end_after_occurrences'];
                                $taskStartDate=$event_rec['Event']['starttime'];
                                $taskYearlyPattern=$event_rec['Event']['yearly_pattern'];
                                $taskYearEveryMonth=$event_rec['Event']['yearly_everymonth'];
                                $taskYearEveryMonthDate=$event_rec['Event']['yearly_everymonth_date'];
                                $taskYearWeekNumber=$event_rec['Event']['yearly_weeknumber'];
                                //if($taskYearWeekNumber=="last") $taskYearWeekNumber="fifth";
                                $taskYearWeekDayName=$event_rec['Event']['yearly_weekday'];
                                $taskYearWeekMonthName=$event_rec['Event']['yearly_weekof_month'];
                                
                                $taskEveryNumofWeeks=$event_rec['Event']['weekly_every_noof_weeks'];
                                $taskTaskEndByDate="0000-00-00";
                                
                                                                  
                                                                
                                if($event_rec['Event']['task_end']=="by_no_date")
                                {
                                    $taskTaskEndByDate="0000-00-00";
                                    $taskTotalOccurenceCount=0;
  
                                    $taskLastOccurenceDate=$tasklastdate;
                                    
                                    for($i=0;$i<10;$i++)
                                    {
                                        $next_date=$this->RecurringEvent->calculateYearlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskYearlyPattern, $taskYearEveryMonth,$taskYearEveryMonthDate,$taskYearWeekNumber,$taskYearWeekDayName, $taskYearWeekMonthName,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                        $taskLastOccurenceDate=$next_date;
                                        
                                        $recur_arr['start_date']=$next_date;
                                        $recur_arr['end_date']=$next_date;   
                                        $recur_arr['id']="";
                                        $this->RecurringEvent->Save($recur_arr);
                                    }
                                    $event_arr['id']=$event_id;
                                    $event_arr['stop_recur']=0;
                                    $this->Event->Save($event_arr);
                                    
                                }                               
                                else
                                if($event_rec['Event']['task_end']=="by_date")
                                {
                                    
                                    $taskTaskEndByDate=$event_rec['Event']['task_end_by_date'];
                                   
                                    $taskLastOccurenceDate=$tasklastdate;
                                                                            
                                    $taskTotalOccurenceCount=0;
                                    
                                    $diff = abs(strtotime($taskLastOccurenceDate) - strtotime($taskTaskEndByDate));

                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                    if($years<=10)
                                    {  
                                        $complete_all=1;
                                        $event_arr['stop_recur']=1;
                                    }
                                    else
                                    {
                                        $complete_all=0;
                                        $d=0;
                                        $event_arr['stop_recur']=0;
                                    }                                  
                                                                      
                                    do{
                                        
                                        if($complete_all==0)
                                        {
                                            if($d>10)
                                                break;
                                            $d++;
                                        }
                                                                                   
                                       $next_date=$this->RecurringEvent->calculateYearlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskYearlyPattern, $taskYearEveryMonth,$taskYearEveryMonthDate,$taskYearWeekNumber,$taskYearWeekDayName, $taskYearWeekMonthName,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
                                       
                                       $taskLastOccurenceDate= $next_date;
                                       
                                       if($next_date>$taskTaskEndByDate || $next_date=="0000-00-00")
                                            break;
                                       
                                       $recur_arr['start_date']=$next_date;
                                       $recur_arr['end_date']=$next_date;   
                                       $recur_arr['id']="";                             
                                       $this->RecurringEvent->Save($recur_arr);
                                       
                                    }while($next_date<=$taskTaskEndByDate);
                                    
                                    $event_arr['id']=$event_id;
                                    $this->Event->Save($event_arr);
                                }
                            }
                            
                            
                            
                        }
                        
                    }
                    
                }
            }
            
            
            exit;

        }


      

    }//end class

?>