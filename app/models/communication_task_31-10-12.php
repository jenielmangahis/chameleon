<?php
/*
Purpose: User model class
#
Model class names are singular.
#
Model class names are Capitalized for single-word models, and UpperCamelCased for multi-word models.
      Examples: Person, Monkey, GlassDoor, LineItem, ReallyNiftyThing
#
Model filenames use a lower-case underscored syntax.
      Examples: person.php, monkey.php, glass_door.php, line_item.php, really_nifty_thing.php
#

#     Model name: Set var $name in your model definition.


      Model-related database tables: Set var $useTable in your model definition.

*/

class CommunicationTask extends AppModel{

	var $name	= 'CommunicationTask'; 
	var $useTable	= 'communication_tasks';// table name
    
    
    
 	var $validate = array(
	  
	  					'task_name' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Task Name.'
    										)								
					   );
                       
         
    /**
    * To Save Task details to database
    * 
    * @param mixed $taskArrary
    * @param mixed $projectid
    * @param mixed $is_temp
    */
    function saveEmailTask($taskArrary, $projectid, $is_temp=0){
               
				    if(!isset($taskArrary['id']) || $taskArrary['id']==""){
                      //if its new task then last execution date is not available
                      $taskArrary['task_last_execution_date']="0000-00-00";
                      $rec_id=""; 
                  }else{
                      $rec_id=$taskArrary['id'];
                  }
                
                	 $taskArrary['project_id'] = $projectid;
                	 
                   // All contact related parameters should be null
                   $taskArrary['company_type']="";
                   $taskArrary['contact_type']="";
                   
                    if(isset($taskArrary['member_agefrom']) && $taskArrary['member_agefrom']!="" && $taskArrary['member_agefrom']!="00-00-0000"){
                          $agefrom=explode("-",$taskArrary['member_agefrom']);
                          $newagefrom=$agefrom[2]."-".$agefrom[0]."-".$agefrom[1];
                          $taskArrary['member_agefrom']=date("Y-m-d", strtotime( $newagefrom));
                     }else{
                         $taskArrary['member_agefrom']="0000-00-00";
                     }
                     
                      if(isset($taskArrary['member_ageto']) && $taskArrary['member_ageto']!="" &&  $taskArrary['member_ageto']!="00-00-0000"){
                          $ageto=explode("-",$taskArrary['member_ageto']);
                          $newageto=$ageto[2]."-".$ageto[0]."-".$ageto[1];
                          $taskArrary['member_ageto']=date("Y-m-d", strtotime( $newageto));
                     }else{
                         $taskArrary['member_ageto']="0000-00-00";
                     }
                     
                     if(!$taskArrary['member_birthday']){
                         $taskArrary['member_birthday']='0';
                     }
                     if(!isset($taskArrary['member_anniversary_monthly'])){
                         $taskArrary['member_anniversary_monthly']='0';
                     }
                     
                     if(!isset($taskArrary['member_anniversary_annual'])){
                         $taskArrary['member_anniversary_annual']='0';
                     }
               
                    $sdata = explode("-", $taskArrary['task_startdate']);
                    $date = new DateTime();
                    $date->setDate($sdata[2], $sdata[0], $sdata[1]);
                    $sdate= $date->format("Y-m-d");
                    $new_sdate=date("Y-m-d H:i:s", strtotime($sdate));
                    $taskArrary['task_startdate']=$sdate;

                 
                 $end_by_date = '0000-00-00';
              
                 if($taskArrary['task_end'] == 'after_accurrences'){
                 		
                 	switch($taskArrary['recur_pattern']){
                 		case 'Daily':
                 			if($taskArrary['daily_pattern']=='everyday'){
                 				$days = $taskArrary['daily_every_noof_days'] * $taskArrary['task_end_after_occurrences'];
                 				$end_by_date = date('Y-m-d', strtotime($sdate . ' + '.$days.' day'));
                 			}else{
                 				$days = 7 * ($taskArrary['task_end_after_occurrences']-1);
                 				$end_by_date = date('Y-m-d', strtotime($sdate . ' + '.$days.' day'));
                 			}
                 			break;
                 		case 'Weekly':
                 			$d = 1;
                 			$days = 0;
                 			$end_by_date_flag = date('Y-m-d', strtotime($sdate));
                 				
                 			while(true) {
                 					
                 				if($taskArrary['weekly_monday']==1){
                 					if( $d > $taskArrary['task_end_after_occurrences'] ){
                 						break;
                 					}
                 					$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' monday this week '));
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$d++;
                 				}
                 
                 				if($taskArrary['weekly_tuesday']==1){
                 					if( $d > $taskArrary['task_end_after_occurrences'] ){
                 						break;
                 					}
                 					$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' tuesday this week '));
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$d++;
                 				}
                 
                 				if($taskArrary['weekly_wednesday']==1){
                 					if( $d > $taskArrary['task_end_after_occurrences'] ){
                 						break;
                 					}
                 					$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' wednesday this week '));
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$d++;
                 				}
                 
                 				if($taskArrary['weekly_thursday']==1){
                 					if( $d > $taskArrary['task_end_after_occurrences'] ){
                 						break;
                 					}
                 					$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' thursday this week '));
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$d++;
                 				}
                 
                 				if($taskArrary['weekly_friday']==1){
                 					if( $d > $taskArrary['task_end_after_occurrences'] ){
                 						break;
                 					}
                 					$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' friday this week '));
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$d++;
                 				}
                 
                 				if($taskArrary['weekly_saturday']==1){
                 					if( $d > $taskArrary['task_end_after_occurrences'] ){
                 						break;
                 					}
                 					$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' saturday this week '));
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$d++;
                 				}
                 
                 				if($taskArrary['weekly_sunday']){
                 					if( $d > $taskArrary['task_end_after_occurrences'] ){
                 						break;
                 					}
                 					$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' sunday this week '));
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$d++;
                 				}
                 
                 				$days = 7 * $taskArrary['weekly_every_noof_weeks'];
                 				$end_by_date_flag = date('Y-m-d', strtotime($end_by_date_flag . ' +'.$days.' day'));
                 					
                 			}
                 				
                 			break;
                 
                 		case 'Monthly':
                 				
                 			list($year, $month, $day) = explode('-', $sdate);
                 
                 			if($taskArrary['monthly_pattern']=='dayofeverymonth'){
                 				$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $month, $taskArrary['monthly_onof_day'], $year));
                 					
                 				$md = 1;
                 				while(true) {
                 					if($md > $taskArrary['task_end_after_occurrences']){
                 						break;
                 					}
                 					$end_by_date = $end_by_date_flag;
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$md++;
                 						
                 					list($y, $m, $d) = explode('-', $end_by_date_flag);
                 					$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m + $taskArrary['monthly_every_noof_months'], $d, $y));
                 				}
                 			}else{
                 				$end_by_date_flag = date('Y-m-d', strtotime($taskArrary['monthly_weeknumber'].' '.strtolower($taskArrary['monthly_weekday'].' of '.date('F', strtotime($sdate)).' '.$year)));
                 				$mc = 1;
                 				while(true) {
                 					if($mc > $taskArrary['task_end_after_occurrences']){
                 						break;
                 					}
                 					$end_by_date = $end_by_date_flag;
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$mc++;
                 					list($y, $m, $d) = explode('-', $end_by_date_flag);
                 					$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m + $taskArrary['monthly_every_noof_months'], $d, $y));
                 					$end_by_date_flag = date('Y-m-d', strtotime($taskArrary['monthly_weeknumber'].' '.strtolower($taskArrary['monthly_weekday'].' of '.date('F', strtotime($end_by_date_flag)).' '.date('Y',strtotime($end_by_date_flag)))));
                 				}
                 			}
                 				
                 			break;
                 
                 		case 'Yearly':
                 			list($year, $month, $day) = explode('-', $sdate);
                 			if($taskArrary['yearly_pattern']=='everynoofmonths'){
                 				$end_by_date_flag = date('Y-m-d', strtotime( $taskArrary['yearly_everymonth_date'].' '.$taskArrary['yearly_everymonth'].' '. $year));
                 				$yc = 1;
                 				while(true) {
                 					if($yc > $taskArrary['task_end_after_occurrences']){
                 						break;
                 					}
                 					$end_by_date = $end_by_date_flag;
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$yc++;
                 
                 					list($y, $m, $d) = explode('-', $end_by_date_flag);
                 					$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m, $d, $y+1));
                 					$end_by_date_flag = date('Y-m-d', strtotime( $taskArrary['yearly_everymonth_date'].' '.$taskArrary['yearly_everymonth'].' '.date('Y',strtotime($end_by_date_flag))));
                 				}
                 			}else{
                 					
                 				$end_by_date_flag = date('Y-m-d', strtotime($taskArrary['yearly_weeknumber'].' '.$taskArrary['yearly_weekday'].' of '.$taskArrary['yearly_weekof_month'].' '. $year));
                 				$yc = 1;
                 				while(true) {
                 					if($yc > $taskArrary['task_end_after_occurrences']){
                 						break;
                 					}
                 					$end_by_date = $end_by_date_flag;
                 					if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )
                 						$yc++;
                 						
                 					list($y, $m, $d) = explode('-', $end_by_date_flag);
                 					$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m, $d, $y+1));
                 					$end_by_date_flag = date('Y-m-d', strtotime($taskArrary['yearly_weeknumber'].' '.$taskArrary['yearly_weekday'].' of '.$taskArrary['yearly_weekof_month'].' '.date('Y',strtotime($end_by_date_flag))));
                 				}
                 			}
                 			break;
                 		default:
                 				
                 	}
                 }else{
                 	if($taskArrary['task_end'] == 'by_date' && !empty($taskArrary['task_end_by_date'])) {
                 		$data = explode("-", $taskArrary['task_end_by_date']);
                 		$date = new DateTime();
                 		$date->setDate($data['2'], $data['0'], $data['1']);
                 		$end_by_date= $date->format("Y-m-d");
                 	}
                 }
               
                 $taskArrary['task_end_by_date']= $end_by_date;
                 
                 
                 
                $taskArrary['is_temp']=$is_temp; 
                if($is_temp==0) {				
                     $taskArrary=$this->initTaskOccurreceDetails($taskArrary);
                }
                   #set the posted data
                $this->set($taskArrary);
                #check server side validation
                $this->invalidFields();
                #save data in project type table
				//echo '<pre>';print_r($taskArrary);exit;
				
                if($this->Save($taskArrary)){ 
			        if(isset($taskArrary['id'])){
                        $taskid=$taskArrary['id'];
                    }else{
                        $taskid=$this->getLastInsertID();   
                    }
                    
                     return $taskid;
                }else{
								
                       return 0;
                }
    }
    

    
    function initTaskOccurreceDetails($taskArray){
     
       // STEP: TASK RECUR PATTERN
       $taskRecurPattern=$taskArray['recur_pattern'];      
       
        
        switch ($taskRecurPattern) {
                case "Yearly":
                      $taskArray=$this->initYearlyRecurPattern($taskArray);  
                      break;
                case "Monthly":
                      $taskArray=$this->initMonthlyRecurPattern($taskArray);  
                      break;
                case "Weekly":
                      $taskArray=$this->initWeeklyRecurPattern($taskArray);  
                      break;
                case "Daily":
                      $taskArray=$this->initDailyRecurPattern($taskArray);
                      break;
        }
        
        return $taskArray;
    }
    
    
    /**
    * put your comment there...
    * 
    * @param mixed $taskArray
    */    
    function initDailyRecurPattern($taskArray){
        // STEP : TASK INIT OCCURRENCE PARAMETERS
        $taskStartOccurenceDate="0000-00-00";
        $taskLastOccurenceDate="0000-00-00";
        $taskLastExecutionDate="0000-00-00";
        $taskTotalOccurenceCount=0;
        $taskNextOccurenceDate="0000-00-00";
        $task_is_done=0;

        // STEP : TASK START AND EDN PARAMATERS 
        $taskStartDate=$taskArray['task_startdate'];
        $taskEndBy=$taskArray['task_end'];
        if($taskEndBy=="after_accurrences"){
             $taskTaskEndAfterOccurrences=$taskArray['task_end_after_occurrences']; 
             $taskTaskEndByDate="0000-00-00";
       }else  if($taskEndBy=="by_date"){
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate=$taskArray['task_end_by_date'];    
       }else{
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate="0000-00-00";       
       }
       $today=date('Y-m-d');
       // STEP: TASK RECUR PATTERN
       $taskRecurPattern=$taskArray['recur_pattern']; 
       $taskDailyPattern=$taskArray['daily_pattern'];       // everyday  everyweek
       $taskDailyEveryNumofDays=$taskArray['daily_every_noof_days'];
       
       if($taskStartDate < $today){     
            if($taskDailyPattern=="everyday"){
                /*  if($taskStartOccurenceDate=="0000-00-00"){
                        $taskStartOccurenceDate= $taskStartDate;
                  }
                  $daysDiff= $this->datediff($taskStartDate,$today,$format='d'); 
                  $taskTotalOccurenceCount= ceil($daysDiff / $taskDailyEveryNumofDays);  
                  $taskDayInterval= ($taskTotalOccurenceCount - 1) *  $taskDailyEveryNumofDays; 
                  $taskLastOccurenceDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($taskStartDate))." +".$taskDayInterval." day"));*/
                  if($taskStartOccurenceDate=="0000-00-00"){
                        $taskStartOccurenceDate= $taskStartDate;
                  }
                  $exeDate=$taskStartDate;
                  
                  while($exeDate < $today)
                  {
                        if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1;break;
                           }else if($taskTaskEndByDate!="0000-00-00" &&  $taskLastOccurenceDate > $taskTaskEndByDate){               
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1; break;
                           }
                        $taskTotalOccurenceCount++;
                        $taskLastOccurenceDate=$exeDate;    
                        $exeDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($exeDate))." +".$taskDailyEveryNumofDays." day")); 
                  
                  }
                 
            }else{  // 52  weeks in year   
                       
                     $exeDate=$taskStartDate;
                      while($exeDate < $today)
                      {
                           if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1;break;
                           }else if($taskTaskEndByDate!="0000-00-00" &&  $taskLastOccurenceDate > $taskTaskEndByDate){               
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1; break;
                           }
                           
                        $dateWkDayNum=date("N",strtotime($exeDate)); 
                        if($dateWkDayNum< 6) 
                        {   
                            $taskTotalOccurenceCount++;
                            $taskLastOccurenceDate=$exeDate;
                             if($taskStartOccurenceDate=="0000-00-00"){
                                $taskStartOccurenceDate= $taskLastOccurenceDate;
                             }
                        }
                         $exeDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($exeDate))." +1 day"));           
                        
                         
                      }
           
            /*     $currDateWkNum=date("W",strtotime($today));
                 $currDateWkDayNum=date("N",strtotime($today));     
                 $startDateWkNum_Chk=date("W",strtotime($taskStartDate));
                 $startDateWkDayNum=date("N",strtotime($taskStartDate)); 
                 if($startDateWkDayNum==7) {
                   if($startDateWkNum_Chk==52){
                             $startDateWkNum=1;
                     }else{
                          $startDateWkNum= $startDateWkNum_Chk;
                     }
                 }
                  $startDateYear=date("Y",strtotime($taskStartDate)); 
                  $currDateYear=date("Y",strtotime($today)); 
                   if($startDateYear < $currDateYear){     // echo "<br/> currDateYear ".$currDateYear;       echo "<br/> startDateYear ".$startDateYear;      
                     $yearDiff= ($currDateYear - $startDateYear);    // echo "<br/> Y Diff ".$yearDiff;
                     $totalWeeks=(($yearDiff * 52)- $startDateWkNum  )+ $currDateWkNum;
                     
                 } else{
                      $totalWeeks=  $currDateWkNum -  $startDateWkNum; 
                 }
  
                 $taskTotalOccurenceCount = (5 *($totalWeeks));
                 // Substract start date week passed dates
                 if($startDateWkDayNum >5 && $startDateWkNum_Chk!=52 ) {   
                           $taskTotalOccurenceCount =   $taskTotalOccurenceCount -5;
                            if($taskStartOccurenceDate=="0000-00-00"){
                                $taskStartOccurenceDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($taskStartDate))." +".(7-$startDateWkDayNum)." day"));           ;
                            }
                 }else{
                        $taskTotalOccurenceCount =  $taskTotalOccurenceCount - ($startDateWkDayNum -1);  
                         if($taskStartOccurenceDate=="0000-00-00"){
                                $taskStartOccurenceDate=$startDateWkDayNum;
                            } 
                 } 
                  // add current date week passed dates      
                 if($currDateWkDayNum < 7) {
                         $taskTotalOccurenceCount = $taskTotalOccurenceCount + ($currDateWkDayNum -1 );
                         $taskLastOccurenceDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($today))." -1 day"));          
                  }else{
                        $taskLastOccurenceDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($today))." -2 day"));  
                  }
                                          
               //  echo "<br/> taskTotalOccurenceCount ".$taskTotalOccurenceCount;    
              
                */

            }
            
       }
       
       if($task_is_done==0){          
           // STEP: CALCULATE NEXT OCCURENCE DATE FOR TASK
          $taskNextOccurenceDate= $this->calculateDailyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskDailyPattern, $taskDailyEveryNumofDays, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
              if($taskNextOccurenceDate=="0000-00-00"){
                     $task_is_done=1;
              }
       }else{
           // STEP : TASK IS COMPLETED , SO NEXT EXECUTION DATE IS NOT AVAILABLE
           $taskNextOccurenceDate="0000-00-00";
       } 
       
       $taskArray['task_last_execution_date']=$taskLastExecutionDate;   
       $taskArray['task_execution_count']=0;
       $taskArray['task_start_occurrence_date']=$taskStartOccurenceDate;
       $taskArray['task_last_occurrence_date']=$taskLastOccurenceDate;
       $taskArray['task_occurrences_count']=$taskTotalOccurenceCount;
       $taskArray['task_next_execution_date']=$taskNextOccurenceDate;
       $taskArray['task_is_done']=$task_is_done;
       
        return $taskArray;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $taskLastOccurenceDate
    * @param mixed $taskTotalOccurenceCount
    * @param mixed $taskStartDate
    * @param mixed $taskDailyPattern
    * @param mixed $taskDailyEveryNumofDays
    * @param mixed $taskTaskEndAfterOccurrences
    * @param mixed $taskTaskEndByDate
    * @return string
    */
    function calculateDailyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskDailyPattern, $taskDailyEveryNumofDays, $taskTaskEndAfterOccurrences, $taskTaskEndByDate){    
         $taskNextOccurenceDate="0000-00-00"; 
         $today=date("Y-m-d");
         $exeDate = date('Y-m-d', strtotime($taskStartDate));
         if($taskDailyPattern=="everyday"){
                if($taskLastOccurenceDate!="0000-00-00"){   //echo "<br/> after #dasy ".$taskDailyEveryNumofDays;
                      $taskNextExeChkDate= $taskLastOccurenceDate; 
                       $date = strtotime(date("Y-m-d", strtotime($taskLastOccurenceDate)) . " +".$taskDailyEveryNumofDays." day");  
                       $taskNextOccurenceDate= date('Y-m-d', $date);   
                      //$taskNextOccurenceDate=date("Y-m-d",strtotime($taskLastOccurenceDate))." +".$taskDailyEveryNumofDays." day";  
                     // echo "<br/> nxt chk date ".$taskNextOccurenceDate;  
                      if($taskNextOccurenceDate < $today)    {
                              $daysDiff= datediff($taskNextOccurenceDate,$today,$format='d');
                              $reminds= $daysDiff % $taskDailyEveryNumofDays;
                              $taskNextOccurenceDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($today))." +".$reminds." day"));         
                          }
             }else{
                  $taskNextOccurenceDate= $taskStartDate; 
                  
             }
         
         }else{
                if($taskLastOccurenceDate!="0000-00-00"){ 
                        $tasklastDate= $taskLastOccurenceDate;
                }else{
                        $tasklastDate= date("Y-m-d",strtotime(date("Y-m-d",strtotime($taskStartDate))." -1 day"));    
                }
                $lastExeDateWeekDayNum=  date("N",strtotime($tasklastDate));    
                if($lastExeDateWeekDayNum < 5 ){
                       $taskNextOccurenceDate= date("Y-m-d",strtotime(date("Y-m-d",strtotime($tasklastDate))." +1 day"));    
                }else{
                       $taskNextOccurenceDate= date("Y-m-d",strtotime(date("Y-m-d",strtotime($tasklastDate))." +".(8 - $lastExeDateWeekDayNum)." day"));     
                }
         }
        
           if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                 $taskNextOccurenceDate="0000-00-00";
           }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){               
                 $taskNextOccurenceDate="0000-00-00";
           }
         
         return $taskNextOccurenceDate;
  }
  
 
    
    /**
    * put your comment there...
    * 
    * @param mixed $taskArray
    */         
    function initWeeklyRecurPattern($taskArray){
         // STEP : TASK INIT OCCURRENCE PARAMETERS
        $taskStartOccurenceDate="0000-00-00";
        $taskLastOccurenceDate="0000-00-00";
        $taskLastExecutionDate="0000-00-00";
        $taskTotalOccurenceCount=0;
        $taskNextOccurenceDate="0000-00-00";
        $task_is_done=0;
        $today=date('Y-m-d');
        // STEP : TASK START AND EDN PARAMATERS 
        $taskStartDate=$taskArray['task_startdate'];
        $taskEndBy=$taskArray['task_end'];
        if($taskEndBy=="after_accurrences"){
             $taskTaskEndAfterOccurrences=$taskArray['task_end_after_occurrences']; 
             $taskTaskEndByDate="0000-00-00";
       }else  if($taskEndBy=="by_date"){
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate=$taskArray['task_end_by_date'];    
       }else{
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate="0000-00-00";       
       }
      
       // STEP: TASK RECUR PATTERN
        $taskRecurPattern=$taskArray['recur_pattern']; 
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
       
       $is_exe_this_week=1;
       $taskExeNumOfTimesInWeek=0;
       for($i=1; $i<=7; $i++){
           if($taskWeekDayArray[$i]==1){
               $taskExeNumOfTimesInWeek++;
           }
       }
       $week_exe_count=0; 
              // DebugBreak();
         if($taskStartDate < $today){
          //   echo "<br/> Start in in past ...so calculate past occurrences of task up to today";

              $wkintervalday=  $taskExeNumOfTimesInWeek * ($taskEveryNumofWeeks -1);
             $date = strtotime($taskStartDate);  
             $exeDate= date('Y-m-d', $date);
          //   echo "<br/>TASK EXE ON : ";
             while($exeDate < $today){                      
             //  echo "<br/>  Chk Date  ---> ".$exeDate."  : ";  
                $exeDateDay=  date("N",$date);
                if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                    $task_is_done=1;  break;
                }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){
                    $task_is_done=1;  break;
                }
                
                if($taskWeekDayArray[$exeDateDay]==1){
                            $is_executed=1;
                }else{
                            $is_executed=0;  
                }     
                
              //  $is_executed=isWeekDayExecution($exeDateDay);
             
                 if($is_executed==1){ 
                     if($is_exe_this_week==1){
                             if($taskStartOccurenceDate=="0000-00-00"){
                              $taskStartOccurenceDate= $exeDate;
                          }
                        $taskLastOccurenceDate=$exeDate;
                        $taskTotalOccurenceCount=$taskTotalOccurenceCount+1;
                       //  echo " | ".$exeDate." | ";  
                         $week_exe_count++;
                         if($week_exe_count == $taskExeNumOfTimesInWeek){
                             if($wkintervalday==0)  {
                                  $is_exe_this_week=1;     
                             }else{
                                 $is_exe_this_week=0;     
                             }
                           
                            $week_exe_count=0; 
                         }
               
                     }else{
                          $week_exe_count++; 
                          if($week_exe_count >= $wkintervalday){
                            $is_exe_this_week=1;
                            $week_exe_count=0; 
                         } 

                     }  
                      
                 }  
                 $exeDayN=date("N", strtotime($exeDate)); 
                 if($exeDayN==7 && $is_exe_this_week==1 && $week_exe_count!=0){
                        if($wkintervalday==0)  {
                                  $is_exe_this_week=1; 
                        }else{
                                 $is_exe_this_week=0;     
                             }
                             $week_exe_count=0;     
                  }
                 
                 $date = strtotime(date("Y-m-d", strtotime($exeDate)) . " +1 day");  
                 $exeDate= date('Y-m-d', $date);   
             }
             
             // $taskNextExeChkDate= $taskLastOccurenceDate;       
         }
        
       if($task_is_done==0){
           // STEP: CALCULATE NEXT OCCURENCE DATE FOR TASK
             $taskNextOccurenceDate=$this->calculateWeeklyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskEveryNumofWeeks, $taskWeekDayArray, $taskExeNumOfTimesInWeek, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);    
              if($taskNextOccurenceDate=="0000-00-00"){
                     $task_is_done=1;
              }
       }else{
           // STEP : TASK IS COMPLETED , SO NEXT EXECUTION DATE IS NOT AVAILABLE
           $taskNextOccurenceDate="0000-00-00";
       } 
       
       $taskArray['task_last_execution_date']=$taskLastExecutionDate;   
       $taskArray['task_execution_count']=0;
       $taskArray['task_start_occurrence_date']=$taskStartOccurenceDate;
       $taskArray['task_last_occurrence_date']=$taskLastOccurenceDate;
       $taskArray['task_occurrences_count']=$taskTotalOccurenceCount;
       $taskArray['task_next_execution_date']=$taskNextOccurenceDate;
       $taskArray['task_is_done']=$task_is_done;
       
        return $taskArray;
    }
    
    /**
 * Fucntion to calculate next occurence date by Last Occurrence date or start date using following paramerters
 * 
 * @param mixed $taskLastOccurenceDate          -     Task Last Occurrence Date
 * @param mixed $taskTotalOccurenceCount        -     Task TotalOccurrence Count
 * @param mixed $taskStartDate                  -     Task Start Date    
 * @param mixed $taskEveryNumofWeeks            -     Task Recur on Every # Number of week    
 * @param mixed $taskWeekDayArray               -     Task Recur on Every Weekday Array 
 * @param mixed $taskExeNumOfTimesInWeek        -     Task Recur on Every Week # number of times 
 * @param mixed $taskTaskEndAfterOccurrences    -     Task End After # number of occurrences OR
 * @param mixed $taskTaskEndByDate              -     Task End After END Date
 * @return string   $taskNextOccurenceDate      -     Task Next Occurence Date                      - 
 */
  function calculateWeeklyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskEveryNumofWeeks, $taskWeekDayArray, $taskExeNumOfTimesInWeek, $taskTaskEndAfterOccurrences, $taskTaskEndByDate){    
         $today=date("Y-m-d");   // DebugBreak();
         $wkintervalday=  $taskExeNumOfTimesInWeek * ($taskEveryNumofWeeks -1);

         if($taskLastOccurenceDate!="0000-00-00"){
              $taskNextExeChkDate= $taskLastOccurenceDate;       
         }else{
              $taskNextExeChkDate= $taskStartDate;   
         }
         $taskNextOccurenceDate="0000-00-00";
         $datetime=  strtotime($taskNextExeChkDate);
                     $nxtChkDtWkNum= date("W",$datetime);
                     $currWkNum= date("W");
                      $nxtChkDtYear= date("Y",$datetime);   
                      $currYear= date("Y");         
                   //  echo "<br/> CHK DATE WK NUM : ".$nxtChkDtWkNum;
                   //  echo "<br/> CURR DATE WK NUM : ".$currWkNum;
                         if(($nxtChkDtWkNum >= $currWkNum && $nxtChkDtYear==$currYear) || ( $nxtChkDtYear > $currYear) ){ 
                               $is_exe_this_week=1;
                               $week_exe_count=0; 
                               if($nxtChkDtNum==7){
                                   $stWknum=$nxtChkDtWkNum+($taskEveryNumofWeeks);
                                    if($stWknum < 10){
                                        $stWknum="0".$stWknum;
                                    }
                                   $taskNextExeChkDate=date("Y-m-d",strtotime(date("Y-m-d", strtotime($nxtChkDtYear.'W'.$stWknum)))) ;
                               }else{
                                   $taskNextExeChkDate=date("Y-m-d",strtotime(date("Y-m-d", strtotime($nxtChkDtYear.'W'.$nxtChkDtWkNum)))) ; 
                               } 
                               
                        }else{
                            $wkdiff= $currWkNum- $nxtChkDtWkNum;
                            $stWknum=$nxtChkDtWkNum+($taskEveryNumofWeeks);
                       //      echo "<br/> NXT DATE WK NUM : ".$stWknum;  
                             if($stWknum < 10){
                                 $stWknum="0".$stWknum;
                             }
                            $taskNextExeChkDate=date("Y-m-d",strtotime(date("Y-m-d", strtotime(date("Y").'W'.$stWknum))));
                            $is_exe_this_week=1; 
                            $week_exe_count=0;    
                        }
                        
                     //   echo "<br/> ** TASK START WK DATE : ".$taskNextExeChkDate;
                        
                   for($i=0; $i<= (7*$taskEveryNumofWeeks*2); $i++){
                         $date = strtotime(date("Y-m-d", strtotime($taskNextExeChkDate)) . " +".$i." day");  
                         $exeDate= date('Y-m-d', $date);  
                         $exeDateDay=  date("N",$date); 
                         if($taskWeekDayArray[$exeDateDay]==1){
                            $is_executed=1;
                         }else{
                            $is_executed=0;  
                         }     
                       //  $is_executed=isWeekDayExecution($exeDateDay); 
                       //     echo "<br/>  Chk Date  ---> ".$exeDate."  : ";
                         if($is_executed==1){ 
                               if($is_exe_this_week==1 ){   $week_exe_count++; 
                               
                                 
                               if($week_exe_count == $taskExeNumOfTimesInWeek){
                                     if($wkintervalday==0)  {
                                          $is_exe_this_week=1;     
                                     }else{
                                         $is_exe_this_week=0;     
                                     }
                                   
                                    $week_exe_count=0; 
                               }
                               
                                if($exeDate<= $taskLastOccurenceDate)  {
                                 continue;
                                } 
                               
                               if($exeDate >= $today && $exeDate >= $taskStartDate) {  $taskNextOccurenceDate=$exeDate;          
                                     if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                           // $task_is_done=1;  
                                            $taskNextOccurenceDate="0000-00-00";
                                      }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){               
                                         $taskNextOccurenceDate="0000-00-00";
                                     }
                                     break; 
                               } 

                         //     echo "<br/> ====> IS exe in this ".$is_exe_this_week." wk count ".$week_exe_count;         
                             
                             }else{
                                  $week_exe_count++; 
                                  if($week_exe_count >= $wkintervalday){
                                    $is_exe_this_week=1;
                                    $week_exe_count=0; 
                                    }  
                       //             echo "<br/> ====> IS exe in this ".$is_exe_this_week." wk count ".$week_exe_count;    
                             }
                              
                         } 
                         
                   }  
                   
                   return $taskNextOccurenceDate;
  }
  
  
    
    /**
    * put your comment there...
    * 
    * @param mixed $taskArray
    */    
    function initMonthlyRecurPattern($taskArray){
         // STEP : TASK INIT OCCURRENCE PARAMETERS
        $taskStartOccurenceDate="0000-00-00";
        $taskLastOccurenceDate="0000-00-00";
        $taskLastExecutionDate="0000-00-00";
        $taskTotalOccurenceCount=0;
        $taskNextOccurenceDate="0000-00-00";
        $task_is_done=0;
        $today=date('Y-m-d');
        // STEP : TASK START AND EDN PARAMATERS 
        $taskStartDate=$taskArray['task_startdate'];
        $taskEndBy=$taskArray['task_end'];
        if($taskEndBy=="after_accurrences"){
             $taskTaskEndAfterOccurrences=$taskArray['task_end_after_occurrences']; 
             $taskTaskEndByDate="0000-00-00";
       }else  if($taskEndBy=="by_date"){
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate=$taskArray['task_end_by_date'];    
       }else{
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate="0000-00-00";       
       }
      
       // STEP: TASK RECUR PATTERN
      
       $taskMonthlyPattern=$taskArray['monthly_pattern']; 
       $taskMonthDate=$taskArray['monthly_onof_day'];
       $taskMonthEveryNumofMonth=$taskArray['monthly_every_noof_months'];
       $taskMonthWeekNumber=strtolower($taskArray['monthly_weeknumber']);
       $taskMonthWeekDayName=$taskArray['monthly_weekday'];
       $taskMonthWeekEveryNumofMonth=$taskArray['monthly_weekof_noof_months']; 
      
       if($taskStartDate < $today){
              $today=date("Y-m-d");
             
              if($taskMonthlyPattern=="dayofeverymonth") {
                  $nthDayOfMonthPattern=$taskMonthDate;   
                  $taskEveryNumOfMonth=$taskMonthEveryNumofMonth; 
              }else if($taskMonthlyPattern=="weekdayofeverymonth"){
                  //$nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;    
                   if($taskMonthWeekNumber=="first"){$wknm="0";}else if($taskMonthWeekNumber=="second"){$wknm="1";}else if($taskMonthWeekNumber=="third"){$wknm="2";}else if($taskMonthWeekNumber=="fourth"){$wknm="3";}else{  $wknm="5"; }
                  $nthDayOfMonthPattern= "+".$wknm." week ".$taskMonthWeekDayName;    
                  
                  $taskEveryNumOfMonth=$taskMonthWeekEveryNumofMonth;    
              }
               //echo "<br/>  Every ".$nthDayOfMonthPattern; 
                $taskNextExeChkDate=$taskStartDate;
                $taskNxtDateYear=  date("Y", strtotime($taskNextExeChkDate));
                $taskNxtDateMon=  date("F", strtotime($taskNextExeChkDate));
                $month =$taskNxtDateMon;
                $year=$taskNxtDateYear;
                if($taskMonthWeekNumber=="last" && $taskMonthlyPattern=="weekdayofeverymonth"){
                    if(strtolower($month)=="december"){
                        $year=$year+1;
                        $month="january";
                    }else{
                         $result = strtotime("01 ".$month." ".$year);        
                        $month = date('F', strtotime('+1 month', $result)); 
                    }
                    $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;          
                }else if($taskMonthlyPattern=="dayofeverymonth"){ 
                        // selected date will not come in some month then it will take last date of month 
                         $nthDayOfMonthPattern=$taskMonthDate;   
                        $lastDayofMonth = date('t',strtotime("1 ".$month." ".$year));   
                        if($lastDayofMonth < $taskMonthDate) {
                            $nthDayOfMonthPattern=$lastDayofMonth;   
                        }
                }
                $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$taskNxtDateMon." ".$taskNxtDateYear);   
                $taskExeDate=date("Y-m-d", $utNthDateOfMonth); 
                
                
                 if($taskExeDate < $today){
                       while($taskExeDate < $today){
                                if($taskExeDate < $taskStartDate ){
                                    $taskExeDate=date("Y-m-d", strtotime(date("Y-m-d", strtotime($taskExeDate))." +1 month" ));  
                                }
                                $taskNxtDateYear=  date("Y", strtotime($taskExeDate));
                                $taskNxtDateMon=  date("F", strtotime($taskExeDate));
                                $month =$taskNxtDateMon;
                                $year=$taskNxtDateYear;
                                if($taskMonthWeekNumber=="last" && $taskMonthlyPattern=="weekdayofeverymonth"){
                                    if(strtolower($month)=="december"){
                                        $year=$year+1;
                                        $month="january";
                                    }else{
                                         $result = strtotime("01 ".$month." ".$year);        
                                        $month = date('F', strtotime('+1 month', $result)); 
                                    }
                                    $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;          
                                }else if($taskMonthlyPattern=="dayofeverymonth"){      
                                        // selected date will not come in some month then it will take last date of month 
                                         $nthDayOfMonthPattern=$taskMonthDate;   
                                        $lastDayofMonth = date('t',strtotime("1 ".$month." ".$year));   
                                        if($lastDayofMonth < $taskMonthDate) {
                                            $nthDayOfMonthPattern=$lastDayofMonth;   
                                        }
                                }
                                $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$month." ".$year);   
                                $taskExeDate=date("Y-m-d", $utNthDateOfMonth);
                                if($taskExeDate < $today){
                                     $taskTotalOccurenceCount++;
                                    $taskLastOccurenceDate= $taskExeDate;   //echo "<br/> Last ".$taskTotalOccurenceCount." Occurence : ".$taskLastOccurenceDate;

                                    $lastYear=  date("Y", strtotime($taskExeDate));
                                    $lastMon=  date("F", strtotime($taskExeDate));
                                    $lastStrTime=strtotime("01 ".$lastMon." ".$lastYear);  
                                    $taskExeDate=date("Y-m-d", strtotime(date("Y-m-d", $lastStrTime)." +".$taskEveryNumOfMonth." month" ));  
                                }else{
                                    break;
                                }
                                


                       }
                 }else{
                        $taskTotalOccurenceCount=0;
                        $taskLastOccurenceDate="0000-00-00";
                    //    echo "<br/> Last ".$taskTotalOccurenceCount." Occurence : ".$taskLastOccurenceDate;  
                 }
          }
       
       if($task_is_done==0){
           // STEP: CALCULATE NEXT OCCURENCE DATE FOR TASK
              $taskNextOccurenceDate= $this->calculateMonthlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskMonthlyPattern, $taskMonthDate,$taskMonthEveryNumofMonth,$taskMonthWeekNumber,$taskMonthWeekDayName, $taskMonthWeekEveryNumofMonth,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
              if($taskNextOccurenceDate=="0000-00-00"){
                     $task_is_done=1;
              }
       }else{
           // STEP : TASK IS COMPLETED , SO NEXT EXECUTION DATE IS NOT AVAILABLE
           $taskNextOccurenceDate="0000-00-00";
       } 
       
       $taskArray['task_last_execution_date']=$taskLastExecutionDate;   
       $taskArray['task_execution_count']=0;
       $taskArray['task_start_occurrence_date']=$taskStartOccurenceDate;
       $taskArray['task_last_occurrence_date']=$taskLastOccurenceDate;
       $taskArray['task_occurrences_count']=$taskTotalOccurenceCount;
       $taskArray['task_next_execution_date']=$taskNextOccurenceDate;
       $taskArray['task_is_done']=$task_is_done;
       
        return $taskArray;
       
    }
    
    
    
   function calculateMonthlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskMonthlyPattern, $taskMonthDate,$taskMonthEveryNumofMonth,$taskMonthWeekNumber,$taskMonthWeekDayName, $taskMonthWeekEveryNumofMonth,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate){
             $today=date("Y-m-d");
              $taskMonthWeekNumber=strtolower($taskMonthWeekNumber);
              if($taskMonthlyPattern=="dayofeverymonth") {
                  $nthDayOfMonthPattern=$taskMonthDate;   
                  $taskEveryNumOfMonth=$taskMonthEveryNumofMonth; 
              }else if($taskMonthlyPattern=="weekdayofeverymonth"){
                  if($taskMonthWeekNumber=="first"){$wknm="0";}else if($taskMonthWeekNumber=="second"){$wknm="1";}else if($taskMonthWeekNumber=="third"){$wknm="2";}else if($taskMonthWeekNumber=="fourth"){$wknm="3";}else{  $wknm="5"; }
                  $nthDayOfMonthPattern="+".$wknm." week ".$taskMonthWeekDayName;    
                  $taskEveryNumOfMonth=$taskMonthWeekEveryNumofMonth;    
              }
               //echo "<br/>  Every ".$nthDayOfMonthPattern; 
          if($taskLastOccurenceDate=="0000-00-00"){
                 $taskNextExeChkDate=$taskStartDate;
                 $taskNxtDateYear=  date("Y", strtotime($taskNextExeChkDate));
                 $taskNxtDateMon=  date("F", strtotime($taskNextExeChkDate));
                  $month =$taskNxtDateMon;
                  $year=$taskNxtDateYear;
                        if($taskMonthWeekNumber=="last" && $taskMonthlyPattern=="weekdayofeverymonth"){
                            if(strtolower($month)=="december"){
                                $year=$year+1;
                                $month="january";
                            }else{
                                $result = strtotime("01 ".$month." ".$year);        
                                $month = date('F', strtotime('+1 month', $result)); 
                            }
                             $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;          
                   }else if($taskMonthlyPattern=="dayofeverymonth"){
                        // selected date will not come in some month then it will take last date of month 
                       $nthDayOfMonthPattern=$taskMonthDate;   
                       $lastDayofMonth = date('t',strtotime("1 ".$month." ".$year));   
                       if($lastDayofMonth < $taskMonthDate) {
                            $nthDayOfMonthPattern=$lastDayofMonth;   
                       }
                   }
                    
                 $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$month." ".$year);   
                 $taskExeDate=date("Y-m-d", $utNthDateOfMonth);
                // echo "<br/> EXe date".$taskExeDate;
                 if($taskExeDate < $taskStartDate || $taskExeDate < $today){
                         $lastYear=  date("Y", strtotime($taskExeDate));
                         $lastMon=  date("F", strtotime($taskExeDate));
                         $lastStrTime=strtotime("01 ".$lastMon." ".$lastYear);
                         
                        $taskNextExeChkDate=date("Y-m-d", strtotime(date("Y-m-d", $lastStrTime)." +".$taskEveryNumOfMonth." month" ));  
                        $taskNxtDateYear=  date("Y", strtotime($taskNextExeChkDate));
                        $taskNxtDateMon=  date("F", strtotime($taskNextExeChkDate));
                          $month =$taskNxtDateMon;
                          $year=$taskNxtDateYear;
                          if($taskMonthWeekNumber=="last" && $taskMonthlyPattern=="weekdayofeverymonth"){
                                if(strtolower($month)=="december"){
                                    $year=$year+1;
                                    $month="january";
                                }else{
                                    $result = strtotime("01 ".$month." ".$year);        
                                    $month = date('F', strtotime('+1 month', $result)); 
                                }
                                 $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;          
                       }else if($taskMonthlyPattern=="dayofeverymonth"){
                        // selected date will not come in some month then it will take last date of month 
                            $nthDayOfMonthPattern=$taskMonthDate;   
                           $lastDayofMonth = date('t',strtotime("1 ".$month." ".$year));   
                           if($lastDayofMonth < $taskMonthDate) {
                                $nthDayOfMonthPattern=$lastDayofMonth;   
                           }
                     }
                        $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$month." ".$year);   
                        $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);
                        
                 }else{
                        $taskNextOccurenceDate= $taskExeDate; 
                 } 
                
             }else{
                  $taskNextExeChkDate=$taskLastOccurenceDate; 
                  
                  $lastYear=  date("Y", strtotime($taskNextExeChkDate));
                  $lastMon=  date("F", strtotime($taskNextExeChkDate));
                  $lastStrTime=strtotime("01 ".$lastMon." ".$lastYear);
                  $taskNextExeChkDate=date("Y-m-d", strtotime(date("Y-m-d", $lastStrTime)." +".$taskEveryNumOfMonth." month" ));   
                  $taskNxtDateYear=  date("Y", strtotime($taskNextExeChkDate));
                  $taskNxtDateMon=  date("F", strtotime($taskNextExeChkDate));
                  $month =$taskNxtDateMon;
                  $year=$taskNxtDateYear;
                          if($taskMonthWeekNumber=="last" && $taskMonthlyPattern=="weekdayofeverymonth"){
                                if(strtolower($month)=="december"){
                                    $year=$year+1;
                                    $month="january";
                                }else{
                                    $result = strtotime("01 ".$month." ".$year);        
                                    $month = date('F', strtotime('+1 month', $result)); 
                                }
                                 $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;          
                        }else if($taskMonthlyPattern=="dayofeverymonth"){
                            // selected date will not come in some month then it will take last date of month 
                            $nthDayOfMonthPattern=$taskMonthDate;    
                           $lastDayofMonth = date('t',strtotime("1 ".$month." ".$year));   
                           if($lastDayofMonth < $taskMonthDate) {
                                $nthDayOfMonthPattern=$lastDayofMonth;   
                           }
                   }
                 
                  $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$month." ".$year);   
                  $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);  
                 
                  if($taskNextOccurenceDate < $today) {     // echo "is less .....";
                         $lastYear=  date("Y", strtotime($taskNextOccurenceDate));
                         $lastMon=  date("F", strtotime($taskNextOccurenceDate));
                         $lastStrTime=strtotime("01 ".$lastMon." ".$lastYear);
                         
                        $taskNextExeChkDate=date("Y-m-d", strtotime(date("Y-m-d", $lastStrTime)." +".$taskEveryNumOfMonth." month" ));  
                        $taskNxtDateYear=  date("Y", strtotime($taskNextExeChkDate));
                        $taskNxtDateMon=  date("F", strtotime($taskNextExeChkDate));
                        $month =$taskNxtDateMon;
                        $year=$taskNxtDateYear;
                          if($taskMonthWeekNumber=="last" && $taskMonthlyPattern=="weekdayofeverymonth"){
                                if(strtolower($month)=="december"){
                                    $year=$year+1;
                                    $month="january";
                                }else{
                                     $result = strtotime("01 ".$month." ".$year);        
                                    $month = date('F', strtotime('+1 month', $result)); 
                                }
                                 $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;          
                        }else if($taskMonthlyPattern=="dayofeverymonth"){
                                // selected date will not come in some month then it will take last date of month 
                               $nthDayOfMonthPattern=$taskMonthDate;   
                               $lastDayofMonth = date('t',strtotime("1 ".$month." ".$year));   
                               if($lastDayofMonth < $taskMonthDate) {
                                    $nthDayOfMonthPattern=$lastDayofMonth;   
                               }
                       }
                        $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$month." ".$year);   
                        $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);
                  }
             }
             
             if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                 $taskNextOccurenceDate="0000-00-00";
            }else if($taskTaskEndByDate!="0000-00-00" &&  $taskNextOccurenceDate > $taskTaskEndByDate){               
                 $taskNextOccurenceDate="0000-00-00";
            }
               
            //  echo " <br/>  2nd  taskNextOccurenceDate : ".$taskNextOccurenceDate;
             return $taskNextOccurenceDate;
  }
  
  
    
    /**
    * put your comment there...
    * 
    * @param mixed $taskArray
    */
    function initYearlyRecurPattern($taskArray){
         // STEP : TASK INIT OCCURRENCE PARAMETERS
        $taskStartOccurenceDate="0000-00-00";
        $taskLastOccurenceDate="0000-00-00";
        $taskLastExecutionDate="0000-00-00";
        $taskTotalOccurenceCount=0;
        $taskNextOccurenceDate="0000-00-00";
        $task_is_done=0;

        // STEP : TASK START AND EDN PARAMATERS 
        $taskStartDate=$taskArray['task_startdate'];
        $taskEndBy=$taskArray['task_end'];
        if($taskEndBy=="after_accurrences"){
             $taskTaskEndAfterOccurrences=$taskArray['task_end_after_occurrences']; 
             $taskTaskEndByDate="0000-00-00";
       }else  if($taskEndBy=="by_date"){
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate=$taskArray['task_end_by_date'];    
       }else{
            $taskTaskEndAfterOccurrences=0;    
            $taskTaskEndByDate="0000-00-00";       
       }
      
       // STEP: TASK RECUR PATTERN
       $taskRecurPattern=$taskArray['recur_pattern']; 
       $taskYearlyPattern=$taskArray['yearly_pattern'];    // everynoofmonths  theweekofmonths
       $taskYearEveryMonth=$taskArray['yearly_everymonth'];
       $taskYearEveryMonthDate=$taskArray['yearly_everymonth_date'];
       $taskYearWeekNumber=$taskArray['yearly_weeknumber'];  // first, last , third ect
       $taskYearWeekDayName=$taskArray['yearly_weekday'];     //Friday
       $taskYearWeekMonthName=$taskArray['yearly_weekof_month'];  // May, June etc
        
       $today=date("Y-m-d"); 
       
       // STEP : CHECK IF $taskStartDate <  $today     -   then Calcute Task Past Occurrences Date and total count  
       if($taskStartDate < $today){
            // STEP : SET TASK nth DAy of Month based on yearly pattern 
            if($taskYearlyPattern=="everynoofmonths"){
                    $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;    
            }else if($taskYearlyPattern=="theweekofmonths"){
                   // $nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$taskYearWeekMonthName;    
                     if($taskYearWeekNumber=="first"){$wknm="0";}else if($taskYearWeekNumber=="second"){$wknm="1";}else if($taskYearWeekNumber=="third"){$wknm="2";}else if($taskYearWeekNumber=="fourth"){$wknm="3";}else{  $wknm="5"; }
                      $nthDayOfMonthPattern="+".$wknm." week ".$taskYearWeekDayName." ".$taskYearWeekMonthName;    
            }
            // STEP: GET Years of $taskStartDateYear &  $currDateYear
            $taskStartDateYear=  date("Y", strtotime($taskStartDate));
            $currDateYear=  date("Y", strtotime($today));
            
            if($taskStartDateYear==$currDateYear){  
                
                    $year=$taskStartDateYear;  
                    if($taskYearWeekNumber=="last" && $taskYearlyPattern=="theweekofmonths"){
                            if(strtolower($taskYearWeekMonthName)=="december"){
                                $year=$taskStartDateYear+1;
                                $month="january";
                                // echo "New Month ".$month." ".$year;    
                            }else{
                               // $year=$taskStartDateYear;  
                                 $result = $result =strtotime("1 ".$taskYearWeekMonthName." ".$taskStartDateYear); // $result = strtotime("{$taskStartDateYear}-{$taskYearWeekMonthName}-01"); 
                                 $month = date('F', strtotime('+1 month', $result)); 
                            }
                             $nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$month;          
                    }else if($taskYearlyPattern=="everynoofmonths"){
                          // selected date will not come in some month then it will take last date of month 
                        $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;     
                        $lastDayofMonth = date('t',strtotime("1 ".$taskYearEveryMonth." ".$year));   
                        if($lastDayofMonth < $taskYearEveryMonthDate) {
                             $nthDayOfMonthPattern=$lastDayofMonth." ".$taskYearEveryMonth;     
                        }
                    }
                     
                     
                    // STEP: if stratYear and cuurYear are same, then task is same year so calculate exeDate
                     $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$year);   
                     $exeDate=date("Y-m-d", $utNthDateOfMonth); 
                     
                     // STEP : CHK if exe date or total occurences are exceeds edndate or end occurrences, if yes the task is completed.
                     if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                        $task_is_done=1; 
                     }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){
                        $task_is_done=1;  
                     }else{
                             if($exeDate < $today) {    
                                if($taskStartOccurenceDate=="0000-00-00"){
                                    $taskStartOccurenceDate= $exeDate;
                                }
                                $taskLastOccurenceDate= $exeDate;
                                $taskTotalOccurenceCount=$taskTotalOccurenceCount+1;        
                             }else{
                                $taskLastOccurenceDate="0000-00-00";   
                             } 
                     }
           }else if($taskStartDateYear < $currDateYear){    // echo  "<br/> pre year";
                     // STEP: if stratYear < cuurYear  then task is start previous year so calculate exeDate 
                     $yearDiff= ($currDateYear - $taskStartDateYear);
                     for($i =0; $i<= $yearDiff; $i++){
                            $year=$taskStartDateYear+$i;   /// echo  "<br/> year ".$year; 
                            if($taskYearWeekNumber=="last" && $taskYearlyPattern=="theweekofmonths"){
                                if(strtolower($taskYearWeekMonthName)=="december"){
                                    $year=$year+1;
                                    $month="january";
                                    // echo "New Month ".$month." ".$year;    
                                }else{
                                   // $year=$taskStartDateYear;  
                                      $result = $result =strtotime("1 ".$taskYearWeekMonthName." ".$year); //$result = strtotime("{$year}-{$taskYearWeekMonthName}-01"); 
                                    $month = date('F', strtotime('+1 month', $result)); 
                                }
                                 $nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$month;          
                            }else if($taskYearlyPattern=="everynoofmonths"){
                                      // selected date will not come in some month then it will take last date of month 
                                    $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;     
                                    $lastDayofMonth = date('t',strtotime("1 ".$taskYearEveryMonth." ".$year));   
                                    if($lastDayofMonth < $taskYearEveryMonthDate) {
                                         $nthDayOfMonthPattern=$lastDayofMonth." ".$taskYearEveryMonth;     
                                    }
                            }  
                            $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$year);   
                            $exeDate=date("Y-m-d", $utNthDateOfMonth); 
                            if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                $task_is_done=1;     break;
                            }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){
                                $task_is_done=1;    break;
                            }
                            if($exeDate < $taskStartDate && $i==0  ) {
                                $taskLastOccurenceDate="0000-00-00";    
                            }else if($exeDate < $today){   
                                if($taskStartOccurenceDate=="0000-00-00"){
                                    $taskStartOccurenceDate= $exeDate;
                                }
                                $taskLastOccurenceDate= $exeDate;
                                $taskTotalOccurenceCount=$taskTotalOccurenceCount+1;        
                            }
                      //  echo  "<br/> for $i Exe date  ".$taskLastOccurenceDate;   
                       
                }  
        }
             
     }
       
       if($task_is_done==0){
           // STEP: CALCULATE NEXT OCCURENCE DATE FOR TASK
              $taskNextOccurenceDate= $this->calculateYearlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskYearlyPattern, $taskYearEveryMonth,$taskYearEveryMonthDate,$taskYearWeekNumber,$taskYearWeekDayName, $taskYearWeekMonthName,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
              if($taskNextOccurenceDate=="0000-00-00"){
                     $task_is_done=1;
              }
       }else{
           // STEP : TASK IS COMPLETED , SO NEXT EXECUTION DATE IS NOT AVAILABLE
           $taskNextOccurenceDate="0000-00-00";
       } 
       
       $taskArray['task_last_execution_date']=$taskLastExecutionDate;   
       $taskArray['task_execution_count']=0;
       $taskArray['task_start_occurrence_date']=$taskStartOccurenceDate;
       $taskArray['task_last_occurrence_date']=$taskLastOccurenceDate;
       $taskArray['task_occurrences_count']=$taskTotalOccurenceCount;
       $taskArray['task_next_execution_date']=$taskNextOccurenceDate;
       $taskArray['task_is_done']=$task_is_done;
       
        return $taskArray;
    }
   
   /**
   * Function to get next execution date for Yearly Recur Pattern
   * 
   * @param mixed $taskLastOccurenceDate
   * @param mixed $taskTotalOccurenceCount
   * @param mixed $taskStartDate
   * @param mixed $taskYearlyPattern
   * @param mixed $taskYearEveryMonth
   * @param mixed $taskYearEveryMonthDate
   * @param mixed $taskYearWeekNumber
   * @param mixed $taskYearWeekDayName
   * @param mixed $taskYearWeekMonthName
   * @param mixed $taskTaskEndAfterOccurrences
   * @param mixed $taskTaskEndByDate
   * @return string     - Next execution date
   */
   
   function calculateYearlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskYearlyPattern, $taskYearEveryMonth,$taskYearEveryMonthDate,$taskYearWeekNumber,$taskYearWeekDayName, $taskYearWeekMonthName,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate){    
              $today=date("Y-m-d");
              $taskNextOccurenceDate="0000-00-00"; 
              if($taskYearlyPattern=="everynoofmonths") {
                  $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;    
              }else if($taskYearlyPattern=="theweekofmonths"){
                 // $nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$taskYearWeekMonthName;    
                   if($taskYearWeekNumber=="first"){$wknm="0";}else if($taskYearWeekNumber=="second"){$wknm="1";}else if($taskYearWeekNumber=="third"){$wknm="2";}else if($taskYearWeekNumber=="fourth"){$wknm="3";}else{  $wknm="5"; }
                      $nthDayOfMonthPattern="+".$wknm." week ".$taskYearWeekDayName." ".$taskYearWeekMonthName;    
              }
              
             if($taskLastOccurenceDate=="0000-00-00"){
                 $taskNextExeChkDate=$taskStartDate;
                     
                 $taskNxtDateYear=  date("Y", strtotime($taskNextExeChkDate));
                 $currDateYear=  date("Y", strtotime($today));
                 $year=$taskNxtDateYear;
                 if($taskYearWeekNumber=="last" && $taskYearlyPattern=="theweekofmonths"){
                            if(strtolower($taskYearWeekMonthName)=="december"){
                                $year=$taskNxtDateYear+1;
                                $month="january";
                                // echo "New Month ".$month." ".$year;    
                            }else{
                               // $year=$taskStartDateYear;  
                                $result = $result =strtotime("1 ".$taskYearWeekMonthName." ".$taskNxtDateYear);  //$result = strtotime("{$taskNxtDateYear}-{$taskYearWeekMonthName}-01"); 
                                $month = date('F', strtotime('+1 month', $result)); 
                            }
                             $nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$month;          
                 }else if($taskYearlyPattern=="everynoofmonths"){
                          // selected date will not come in some month then it will take last date of month 
                        $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;     
                        $lastDayofMonth = date('t',strtotime("1 ".$taskYearEveryMonth." ".$year));   
                        if($lastDayofMonth < $taskYearEveryMonthDate) {
                             $nthDayOfMonthPattern=$lastDayofMonth." ".$taskYearEveryMonth;     
                        }
                    }
                    
                 $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$year);   
                 $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);  
                
                 if($taskNextOccurenceDate < $today || $taskNextOccurenceDate < $taskStartDate) {     // echo "is less .....";
                        $taskNxtDateYear=$currDateYear+1;   ///echo "   so Year is  less .....patter ".$nthDayOfMonthPattern." ".$taskNxtDateYear; 
                        $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$taskNxtDateYear);   
                        $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);  
                  }
             }else{
                  $taskNextExeChkDate=$taskLastOccurenceDate; 
                  $taskNxtDateYear=  date("Y", strtotime($taskNextExeChkDate)) +1;
                  $currDateYear=  date("Y", strtotime($today));
                  
                  $year=$taskNxtDateYear;
                  if($taskYearWeekNumber=="last" && $taskYearlyPattern=="theweekofmonths"){
                            if(strtolower($taskYearWeekMonthName)=="december"){
                                $year=$taskNxtDateYear+1;
                                $month="january";
                                // echo "New Month ".$month." ".$year;    
                            }else{
                               // $year=$taskStartDateYear; 
                                $result = $result =strtotime("1 ".$taskYearWeekMonthName." ".$taskNxtDateYear); 
                               // $result = strtotime("{$taskNxtDateYear}-{$taskYearWeekMonthName}-01"); 
                                $month = date('F', strtotime('+1 month', $result)); 
                            }
                             $nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$month;          
                    }else if($taskYearlyPattern=="everynoofmonths"){
                          // selected date will not come in some month then it will take last date of month 
                        $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;     
                        $lastDayofMonth = date('t',strtotime("1 ".$taskYearEveryMonth." ".$year));   
                        if($lastDayofMonth < $taskYearEveryMonthDate) {
                             $nthDayOfMonthPattern=$lastDayofMonth." ".$taskYearEveryMonth;     
                        }
                    }
                 
                 
                  $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$year);   
                  $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);  
                 
                  if($taskNextOccurenceDate < $today ) {     // echo "is less .....";
                        $taskNxtDateYear=$currDateYear+1;   ///echo "   so Year is  less .....patter ".$nthDayOfMonthPattern." ".$taskNxtDateYear; 
                        $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$taskNxtDateYear);   
                        $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);  
                  }
             }
             
             if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                 $taskNextOccurenceDate="0000-00-00";
            }else if($taskTaskEndByDate!="0000-00-00" &&  $taskNextOccurenceDate > $taskTaskEndByDate){               
                 $taskNextOccurenceDate="0000-00-00";
            }
               
            return $taskNextOccurenceDate;
  }
  
   
    
   /**
   * Fucntion to get Task Matching list of Members or Contact Depends on parameters
   *  
   * @param mixed $tempTaskId
   * @param mixed $projectid
   */
    function getEmailTaskMatchingMembersOrContacts($tempTaskId, $projectid) {    
            $exe_query = " Call getEmailTaskMatchingMembersOrContacts(".$tempTaskId.", ".$projectid.") ";  
            $result = $this->query($exe_query);
            return $result;
    }
    
 /**
 * Function to get difference between dates
 *    
 * @param mixed $date1
 * @param mixed $date2
 * @param mixed $format
 * @return float
 */
                                              
function datediff($date1,$date2,$format='d'){
$difference = abs(strtotime($date2) - strtotime($date1));
switch (strtolower($format)){
case 'd':
$days = round((($difference/60)/60)/24,0);
break;
case 'm':
$days = round(((($difference/60)/60)/24)/30,0);
break;
case 'y':
$days = round(((($difference/60)/60)/24)/365,0);
break;
}

return $days;
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  /* CREATE TABLE `communication_tasks` (                                                                                                            
                       `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented task id',                                                                      
                       `project_id` int(11) NOT NULL COMMENT 'project id',                                                                                           
                       `task_name` varchar(255) NOT NULL,                                                                                                            
                       `email_template_id` int(11) DEFAULT NULL COMMENT 'template id',                                                                               
                       `email_subject` varchar(255) NOT NULL,                                                                                                        
                       `email_from` varchar(255) NOT NULL,                                                                                                           
                       `email_content` text NOT NULL,                                                                                                                
                       `subscription_type` varchar(255) DEFAULT NULL COMMENT 'member newsletter subscription type ',                                                 
                       `member_type` varchar(255) DEFAULT NULL COMMENT 'member type like holder, non-holders etc',                                                   
                       `member_gender` varchar(150) DEFAULT NULL,                                                                                                    
                       `member_agefrom` date DEFAULT NULL,                                                                                                           
                       `member_ageto` date DEFAULT NULL,                                                                                                             
                       `member_birthday` enum('1','0') DEFAULT '0',                                                                                                  
                       `member_anniversary_monthly` enum('1','0') DEFAULT '0',                                                                                       
                       `member_anniversary_annual` enum('1','0') DEFAULT '0',                                                                                        
                       `member_days_since` varchar(255) DEFAULT NULL COMMENT 'days since member registratio or coin registration or last login ',                    
                       `member_noof_days_since` int(5) DEFAULT NULL COMMENT 'number of days since',                                                                  
                       `member_country` int(11) DEFAULT NULL,                                                                                                        
                       `member_state` int(11) DEFAULT NULL,                                                                                                          
                       `member_zipcode_from` varchar(150) DEFAULT NULL,                                                                                              
                       `member_zipcode_to` varchar(150) DEFAULT NULL,                                                                                                
                       `event_id` int(11) DEFAULT NULL,                                                                                                              
                       `event_rsvp_type` enum('3','2','1','0') DEFAULT NULL COMMENT 'event rsvp type like attending, not attending , may be attending,no responce',  
                       `relatesto_commenttype_id` int(11) DEFAULT NULL COMMENT 'suggested comment type id',                                                          
                       `social_network_members` varchar(255) DEFAULT NULL COMMENT 'social networks like facebook, twitter etc',                                      
                       `non_network_members` varchar(255) DEFAULT NULL COMMENT 'non social networks like facebook, twitter etc',                                     
                       `member_points_rangefrom` int(11) DEFAULT NULL,                                                                                               
                       `member_points_rangeto` int(11) DEFAULT NULL,                                                                                                 
                       `company_type` int(11) DEFAULT NULL,                                                                                                          
                       `contact_type` int(11) DEFAULT NULL,                                                                                                          
                       `recur_pattern` enum('Daily','Weekly','Monthly','Yearly') DEFAULT 'Daily',                                                                    
                       `daily_pattern` enum('everyday','everyweek') DEFAULT NULL,                                                                                    
                       `daily_every_noof_days` int(5) DEFAULT NULL COMMENT 'Daily every number of days',                                                             
                       `weekly_every_noof_weeks` int(3) DEFAULT NULL COMMENT 'Weekly every number of weeks',                                                         
                       `weekly_monday` enum('1','0') DEFAULT '0',                                                                                                    
                       `weekly_tuesday` enum('1','0') DEFAULT '0',                                                                                                   
                       `weekly_wednesday` enum('1','0') DEFAULT '0',                                                                                                 
                       `weekly_thursday` enum('1','0') DEFAULT '0',                                                                                                  
                       `weekly_friday` enum('1','0') DEFAULT '0',                                                                                                    
                       `weekly_saturday` enum('1','0') DEFAULT '0',                                                                                                  
                       `weekly_sunday` enum('1','0') DEFAULT '0',                                                                                                    
                       `monthly_pattern` enum('dayofeverymonth','weekdayofeverymonth') DEFAULT NULL,                                                                 
                       `monthly_onof_day` int(5) DEFAULT NULL COMMENT 'Monthly number of days ',                                                                     
                       `monthly_every_noof_months` int(5) DEFAULT NULL COMMENT 'Every number of months',                                                             
                       `monthly_weeknumber` varchar(100) DEFAULT NULL COMMENT 'Week number - first, second , third, fourth or last',                                 
                       `monthly_weekday` varchar(100) DEFAULT NULL COMMENT 'Week Day- Monday, Tuesday etc.',                                                         
                       `monthly_weekof_noof_months` int(5) DEFAULT NULL,                                                                                             
                       `yearly_pattern` enum('everynoofmonths','theweekofmonths') DEFAULT NULL,                                                                      
                       `yearly_everymonth` varchar(100) DEFAULT NULL COMMENT 'Every Month- Jan, Feb and so on',                                                      
                       `yearly_every_noof_months` int(5) DEFAULT NULL,                                                                                               
                       `yearly_weeknumber` varchar(100) DEFAULT NULL COMMENT 'Week number - first, second , third, fourth or last',                                  
                       `yearly_weekday` varchar(100) DEFAULT NULL COMMENT 'Week Day- Monday, Tuesday etc.',                                                          
                       `yearly_weekof_month` varchar(100) DEFAULT NULL COMMENT 'Month- Jan, Feb and so on',                                                          
                       `task_startdate` date DEFAULT NULL,                                                                                                           
                       `task_end` enum('after_accurrences','by_date') DEFAULT NULL,                                                                                  
                       `task_end_after_occurrences` int(5) DEFAULT NULL,                                                                                             
                       `task_end_by_date` date DEFAULT NULL,                                                                                                         
                       `task_note` text,                                                                                                                             
                       `task_last_execution_date` datetime DEFAULT NULL,                                                                                             
                       `task_next_execution_date` datetime DEFAULT NULL,                                                                                             
                       `task_execution_count` int(11) DEFAULT '0',                                                                                                   
                       `active_status` enum('1','0') DEFAULT '1',                                                                                                    
                       `delete_status` enum('1','0') DEFAULT '0',                                                                                                    
                       `created` datetime DEFAULT NULL,                                                                                                              
                       `modified` datetime DEFAULT NULL,                                                                                                             
                       PRIMARY KEY (`id`)                                                                                                                            
                     ) ENGINE=MyISAM DEFAULT CHARSET=latin1                                                                                                          
            */
            
  function getNextExecutionDate($startDate, $startTime, $startTimeZone, $lastExecutionDate, $endDate, $endOccurenceNumber, $total){
      $nextExecutionDate="0000-00-00";
      
      return $nextExecutionDate;
  }
  
  
  function getTaskDailyPastOccurenceDetails($taskArray){
      
  }
  
   function intiTaskWeeklyPastOccurenceDetails($taskArray){
           /**
           * $userTimezone = new DateTimeZone('America/New_York');
           $gmtTimezone = new DateTimeZone('GMT');
           $myDateTime = new DateTime('2009-03-21 13:14', $gmtTimezone);
           $offset = $userTimezone->getOffset($myDateTime);
           echo $offset;
           */
        
       $today=date("Y-m-d");
       $taskStartDate=$taskArray['task_startdate'];
       $taskTaskEndBy=$taskArray['task_end'];
       $taskTaskEndByNoDate=$taskArray['task_end_by_no_date'];
       $taskTaskEndByDate=$taskArray['task_end_by_date'];
       $taskTaskEndAfterOccurrences=$taskArray['task_end_after_occurrences'];
       
       $taskStartOccurenceDate=$taskArray['task_start_occurrence_date'];
       $taskLastOccurenceDate=$taskArray['task_last_occurrence_date'];
       $taskTotalOccurenceCount=$taskArray['task_occurrences_count'];
       
       $taskTaskRecurPattern=$taskArray['recur_pattern'];
       if($taskTaskRecurPattern=="Weekly"){
            $taskEveryNumofWeeks=$taskArray['weekly_every_noof_weeks'];
            $taskWeekMonday=$taskArray['weekly_monday'];
            $taskWeekTuesday=$taskArray['weekly_tuesday'];
            $taskWeekWednesday=$taskArray['weekly_wednesday'];
            $taskWeekThursday=$taskArray['weekly_thursday'];
            $taskWeekFriday=$taskArray['weekly_friday'];
            $taskWeekSaturday=$taskArray['weekly_saturday'];
            $taskWeekSunday=$taskArray['weekly_sunday'];   
            
            if($taskStartDate < $today){
                
            }
                          
       }else{
           return false;
       }
      
  }
  
  
  function saveSendMailTask($sendMailTask, $projectid,$rec_event_id=0){
       ##import Communication Task History  model for processing

                    $mailtempid = $sendMailTask['id'];    
                    $mailsubject = $sendMailTask['subject'];    
                    $mailcontent = $sendMailTask['content'];
                    $taskExedate=date('Y-m-d h:i:s');
                    $frommail = $sendMailTask['fromid'];  
                    
                    App::import("Model", "CommunicationTaskHistory");
                    $this->CommunicationTaskHistory =   & new CommunicationTaskHistory();  
                    
                   // $data['CommunicationTaskHistory'] =$taskArray;
                    $data['CommunicationTaskHistory']['id'] ='';
                    $data['CommunicationTaskHistory']['task_id'] ='0'; 
                    $data['CommunicationTaskHistory']['project_id'] =$projectid; 
					

                    if($rec_event_id!="" || $rec_event_id!=0)
                    {
                        $data['CommunicationTaskHistory']['task_name'] ='Send Event Invitation';
                        $data['CommunicationTaskHistory']['send_event_invitation'] ='1';
                        $data['CommunicationTaskHistory']['rec_event_id'] =$rec_event_id;
                    }
                    else
                     $data['CommunicationTaskHistory']['company_id'] = $sendMailTask['company_id'];
					 $data['CommunicationTaskHistory']['task_name'] ='Send Mail';
                    $data['CommunicationTaskHistory']['email_template_id'] =$mailtempid; 
                    $data['CommunicationTaskHistory']['email_subject'] =$mailsubject; 
                    $data['CommunicationTaskHistory']['email_from'] =$frommail; 
                    $data['CommunicationTaskHistory']['email_content'] =$mailcontent; 
                    
                    $data['CommunicationTaskHistory']['subscription_type']="";
                    $data['CommunicationTaskHistory']['member_gender']="";
                    $data['CommunicationTaskHistory']['member_agefrom']="0000-00-00";
                    $data['CommunicationTaskHistory']['member_ageto']="0000-00-00";
                    $data['CommunicationTaskHistory']['member_birthday']="0";
                    $data['CommunicationTaskHistory']['member_anniversary_monthly']="0";
                    $data['CommunicationTaskHistory']['member_anniversary_annual']="0";
                    $data['CommunicationTaskHistory']['member_days_since']="";
                    $data['CommunicationTaskHistory']['member_country']="";
                    $data['CommunicationTaskHistory']['member_state']="";
                    $data['CommunicationTaskHistory']['member_zipcode_from']="";
                    $data['CommunicationTaskHistory']['member_zipcode_to']="";
                    $data['CommunicationTaskHistory']['event_id']="";
                    $data['CommunicationTaskHistory']['event_rsvp_type']="";
                    $data['CommunicationTaskHistory']['relatesto_commenttype_id']="";
                    $data['CommunicationTaskHistory']['social_network_members']="";
                    $data['CommunicationTaskHistory']['non_network_members']="";
                    $data['CommunicationTaskHistory']['member_points_rangefrom']="";
                    $data['CommunicationTaskHistory']['member_points_rangeto']="";
                  
                  if( $sendMailTask['company_type']!="" || $sendMailTask['contact_type']!=""){ 
                          $data['CommunicationTaskHistory']['company_type']=$sendMailTask['company_type'];
                          $data['CommunicationTaskHistory']['contact_type']=$sendMailTask['contact_type']; 
                          $data['CommunicationTaskHistory']['member_type']=""; 
                          $sent_to_matching="contact";
                    }else{
                          $data['CommunicationTaskHistory']['member_type']=$sendMailTask['member_type'];
                          $data['CommunicationTaskHistory']['contact_type']=""; 
                          $data['CommunicationTaskHistory']['contact_type']="";
                          $sent_to_matching="member";
                    }
                    
                    
                    $data['CommunicationTaskHistory']['recur_pattern']="Daily"; 
                    $data['CommunicationTaskHistory']['daily_pattern']="everyday"; 
                    $data['CommunicationTaskHistory']['daily_every_noof_days']="1"; 
                    $data['CommunicationTaskHistory']['contact_type']=""; 
                    
                    $data['CommunicationTaskHistory']['task_startdate']=$taskExedate;
                    $data['CommunicationTaskHistory']['task_end']=  'after_accurrences';
                    $data['CommunicationTaskHistory']['task_end_after_occurrences']=  '1';
                    $data['CommunicationTaskHistory']['task_note']=  'Send Mail Task Execution';
                    $data['CommunicationTaskHistory']['is_temp']='0';
                    
                    $data['CommunicationTaskHistory']['task_execution_date'] = $taskExedate;
					//echo '<pre>';print_r($data);die;
                    if($this->CommunicationTaskHistory->save($data['CommunicationTaskHistory'])){
                        $taskHistoryId=  $this->CommunicationTaskHistory->getLastInsertID(); 
                    }else{
                        $taskHistoryId=0;
                    }
                    
                    return $taskHistoryId;
  }
  
/**
* Fucntion to check unique Task Name
*   
* @param mixed $taskName     - Task Name
* @param mixed $project_id   - Project Id
* @param mixed $task_id      - Task Id , optional
*/
  function isUniqueTaskName($taskName, $project_id, $task_id = null)
{		
		//echo $task_id;exit; 
     if ($task_id == null) {
        $conditions = array("CommunicationTask.task_name = '$taskName'" , "CommunicationTask.project_id IN('0',$project_id)");
    }
    else {
        $conditions = array("CommunicationTask.task_name = '$taskName'" , "CommunicationTask.id != $task_id", "CommunicationTask.project_id IN('0', $project_id)");
    }
    $taskData = $this->find('first', array('conditions' => $conditions));

    if (isset($taskData) && $taskData !== false) {
        return false;
    }

    return true;
}


function saveSendMailCompanyTask($sendMailTask, $projectid){
				##import Communication Task History  model for processing
				 
				$mailtempid = $sendMailTask['id'];
				$mailsubject = $sendMailTask['subject'];
				$mailcontent = $sendMailTask['content'];
				$taskExedate=date('Y-m-d h:i:s');
				$frommail = $sendMailTask['fromid'];
			
				App::import("Model", "CommunicationTaskHistory");
				$this->CommunicationTaskHistory =   & new CommunicationTaskHistory();
			
				// $data['CommunicationTaskHistory'] =$taskArray;
				$data['CommunicationTaskHistory']['id'] ='';
				$data['CommunicationTaskHistory']['task_id'] ='0';
				$data['CommunicationTaskHistory']['project_id'] =$projectid;
				 $data['CommunicationTaskHistory']['company_id'] =$companyid;
				if($rec_event_id!="" || $rec_event_id!=0)
				{
					$data['CommunicationTaskHistory']['task_name'] ='Send Event Invitation';
					$data['CommunicationTaskHistory']['send_event_invitation'] ='1';
					$data['CommunicationTaskHistory']['rec_event_id'] =$rec_event_id;
				}
				else
					$data['CommunicationTaskHistory']['task_name'] ='Send Mail';
					$data['CommunicationTaskHistory']['email_template_id'] =$mailtempid;
					$data['CommunicationTaskHistory']['email_subject'] =$mailsubject;
					$data['CommunicationTaskHistory']['email_from'] =$frommail;
					$data['CommunicationTaskHistory']['email_content'] =$mailcontent;
				
					$data['CommunicationTaskHistory']['subscription_type']="";
					$data['CommunicationTaskHistory']['member_gender']="";
					$data['CommunicationTaskHistory']['member_agefrom']="0000-00-00";
					$data['CommunicationTaskHistory']['member_ageto']="0000-00-00";
					$data['CommunicationTaskHistory']['member_birthday']="0";
					$data['CommunicationTaskHistory']['member_anniversary_monthly']="0";
					$data['CommunicationTaskHistory']['member_anniversary_annual']="0";
					$data['CommunicationTaskHistory']['member_days_since']="";
					$data['CommunicationTaskHistory']['member_country']="";
					$data['CommunicationTaskHistory']['member_state']="";
					$data['CommunicationTaskHistory']['member_zipcode_from']="";
					$data['CommunicationTaskHistory']['member_zipcode_to']="";
					$data['CommunicationTaskHistory']['event_id']="";
					$data['CommunicationTaskHistory']['event_rsvp_type']="";
					$data['CommunicationTaskHistory']['relatesto_commenttype_id']="";
					$data['CommunicationTaskHistory']['social_network_members']="";
					$data['CommunicationTaskHistory']['non_network_members']="";
					$data['CommunicationTaskHistory']['member_points_rangefrom']="";
					$data['CommunicationTaskHistory']['member_points_rangeto']="";
					$data['CommunicationTaskHistory']['contact_type']="";
					$data['CommunicationTaskHistory']['contact_type']="";
					$data['CommunicationTaskHistory']['member_type'] ="";
					
					$data['CommunicationTaskHistory']['recur_pattern']="Daily";
					$data['CommunicationTaskHistory']['daily_pattern']="everyday";
					$data['CommunicationTaskHistory']['daily_every_noof_days']="1";
				
					$data['CommunicationTaskHistory']['task_startdate']=$taskExedate;
					$data['CommunicationTaskHistory']['task_end']=  'after_accurrences';
					$data['CommunicationTaskHistory']['task_end_after_occurrences']=  '1';
					$data['CommunicationTaskHistory']['task_note']=  'Send Mail Task Execution';
					$data['CommunicationTaskHistory']['is_temp']='0';
				
					$data['CommunicationTaskHistory']['task_execution_date'] = $taskExedate;
					
				if($this->CommunicationTaskHistory->save($data['CommunicationTaskHistory'])){
					$taskHistoryId=  $this->CommunicationTaskHistory->getLastInsertID();
				}else{
					$taskHistoryId=0;
				}
			
				return $taskHistoryId;
			}
    
}
?>