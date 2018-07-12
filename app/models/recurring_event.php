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

class RecurringEvent extends AppModel{

    var $name    = 'RecurringEvent'; 
    var $useTable    = 'recurring_events';// table name
 
          
    function initDailyRecurPattern($taskArray){
        // STEP : TASK INIT OCCURRENCE PARAMETERS
        $taskStartOccurenceDate="0000-00-00";
        $taskLastOccurenceDate="0000-00-00";
        $taskLastExecutionDate="0000-00-00";
        $taskTotalOccurenceCount=0;
        $taskNextOccurenceDate="0000-00-00";
        $task_is_done=0;
        $today=date('Y-m-d');
        $pastArray=array();
        // STEP : TASK START AND EDN PARAMATERS 
        $taskStartDate=$taskArray['starttime'];
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
       $taskDailyPattern=$taskArray['daily_pattern'];       // everyday  everyweek
       $taskDailyEveryNumofDays=$taskArray['daily_every_noof_days'];
       
       if($taskStartDate < $today){
           
            if($taskDailyPattern=="everyday"){
                  if($taskStartOccurenceDate=="0000-00-00"){
                        $taskStartOccurenceDate= $taskStartDate;
                  }
                  //$taskLastExecutionDate=$taskStartDate;
                  $exeDate=$taskStartDate;
                  
                  while($exeDate<$today)
                  {
                        if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1;break;
                           }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){               
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1; break;
                           }
                           
                    $newArray=$taskArray;
                    $taskTotalOccurenceCount++;
                    $taskLastExecutionDate=$exeDate; 
                    
                    $newArray['task_last_execution_date']=$taskLastExecutionDate;   
                    $newArray['task_execution_count']=$taskTotalOccurenceCount;
                    $newArray['task_is_done']=$task_is_done;
                    array_push($pastArray, $newArray);
                    
                    $exeDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($exeDate))." +".$taskDailyEveryNumofDays." day")); 
                  
                  }
                  
                 /* $daysDiff=$this->datediff($taskStartDate,$today,$format='d'); 
                  $taskTotalOccurenceCount= ceil($daysDiff / $taskDailyEveryNumofDays);  
                  $taskDayInterval= ($taskTotalOccurenceCount - 1) *  $taskDailyEveryNumofDays; 
                  $taskLastOccurenceDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($taskStartDate))." +".$taskDayInterval." day"));*/
                 
            }else{  // 52  weeks in year    
           
                    //$taskLastExecutionDate=$taskStartDate;
                    $exeDate=$taskStartDate;
                      while($exeDate<$today)
                      {
                           if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1;break;
                           }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){               
                                $taskNextOccurenceDate="0000-00-00";  $task_is_done=1; break;
                           }
                          
                        $dateWkDayNum=date("N",strtotime($exeDate)); 
                        if($dateWkDayNum< 6) 
                        {   $newArray=$taskArray;
                            $taskTotalOccurenceCount++;
                            $taskLastExecutionDate=$exeDate;
                            $newArray['task_last_execution_date']=$taskLastExecutionDate;   
                            $newArray['task_execution_count']=$taskTotalOccurenceCount;
                            $newArray['task_is_done']=$task_is_done;
                           
                             
                            array_push($pastArray, $newArray);
                        }
                         $exeDate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($exeDate))." +1 day")); 
                      }
              /*   $currDateWkNum=date("W",strtotime($today));
                 $currDateWkDayNum=date("N",strtotime($today));     
                 $startDateWkNum=date("W",strtotime($taskStartDate));
                 $startDateWkDayNum=date("N",strtotime($taskStartDate)); 
                 if($startDateWkDayNum==7) {
                   if($startDateWkNum==52){
                             $startDateWkNum=1;
                     }else{
                          $startDateWkNum= $startDateWkNum;
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
                 if($startDateWkDayNum >5) {   
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
                 */                         
               //  echo "<br/> taskTotalOccurenceCount ".$taskTotalOccurenceCount;    
              


            }
            
       }
       
       if($task_is_done==0){
           if(!empty($newArray))
                $taskLastOccurenceDate=$newArray['task_last_execution_date'];
                
           // STEP: CALCULATE NEXT OCCURENCE DATE FOR TASK
          $taskNextOccurenceDate= $this->calculateDailyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskDailyPattern, $taskDailyEveryNumofDays, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);
              if($taskNextOccurenceDate=="0000-00-00"){
                     $task_is_done=1;
              }
               $newArray=$taskArray;
               $taskTotalOccurenceCount++;
               $newArray['task_last_execution_date']=$taskNextOccurenceDate;   
               $newArray['task_execution_count']=$taskTotalOccurenceCount;
               $newArray['task_is_done']=$task_is_done;
               array_push($pastArray, $newArray);
       }else{
           // STEP : TASK IS COMPLETED , SO NEXT EXECUTION DATE IS NOT AVAILABLE
           $taskNextOccurenceDate="0000-00-00";
           $newArray['task_last_execution_date']=$taskNextOccurenceDate;   
           $newArray['task_execution_count']=$taskTotalOccurenceCount;
           $newArray['task_is_done']=$task_is_done;
           array_push($pastArray, $newArray);
       } 
       
     /*  $taskArray['task_last_execution_date']=$taskLastExecutionDate;   
       $taskArray['task_execution_count']=0;
       $taskArray['task_start_occurrence_date']=$taskStartOccurenceDate;
       $taskArray['task_last_occurrence_date']=$taskLastOccurenceDate;
       $taskArray['task_occurrences_count']=$taskTotalOccurenceCount;
       $taskArray['task_next_execution_date']=$taskNextOccurenceDate;
       $taskArray['task_is_done']=$task_is_done;*/
       
        return $pastArray;
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
         $taskStartDate=date('Y-m-d', strtotime($taskStartDate));        
         if($taskDailyPattern=="everyday"){
                if($taskLastOccurenceDate!="0000-00-00"){   //echo "<br/> after #dasy ".$taskDailyEveryNumofDays;
                      $taskNextExeChkDate= $taskLastOccurenceDate; 
                       $date = strtotime(date("Y-m-d", strtotime($taskLastOccurenceDate)) . " +".$taskDailyEveryNumofDays." day");  
                       $taskNextOccurenceDate= date('Y-m-d', $date);   
                      //$taskNextOccurenceDate=date("Y-m-d",strtotime($taskLastOccurenceDate))." +".$taskDailyEveryNumofDays." day";  
                     // echo "<br/> nxt chk date ".$taskNextOccurenceDate;  
                      if($taskNextOccurenceDate < $today)    {
                              $daysDiff= $this->datediff($taskNextOccurenceDate,$today,$format='d');
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
           }else if($taskTaskEndByDate!="0000-00-00" &&  $taskNextOccurenceDate > $taskTaskEndByDate){               
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
        $today= date('Y-m-d');
        $pastArray=array();
        
        // STEP : TASK START AND EDN PARAMATERS 
        $taskStartDate=$taskArray['starttime'];
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
       
         if($taskStartDate < $today){
          //   echo "<br/> Start in in past ...so calculate past occurrences of task up to today";

              $wkintervalday=  $taskExeNumOfTimesInWeek * ($taskEveryNumofWeeks -1);
             $date = strtotime($taskStartDate);  
             $exeDate= date('Y-m-d', $date);
          //   echo "<br/>TASK EXE ON : ";
             while($exeDate < $today){                      
             //  echo "<br/>  Chk Date  ---> ".$exeDate."  : ";  
                $exeDateDay=  date("N",$date);
              
                 if($taskWeekDayArray[$exeDateDay]==1){
                    $is_executed=1;
                 }else{
                    $is_executed=0;  
                 }     
               // $is_executed=isWeekDayExecution($exeDateDay);
             
                 if($is_executed==1){ 
                     if($is_exe_this_week==1){
                             if($taskStartOccurenceDate=="0000-00-00"){
                              $taskStartOccurenceDate= $exeDate;
                          }
                        $taskLastOccurenceDate=$exeDate;
                        $taskTotalOccurenceCount=$taskTotalOccurenceCount+1;
                         //echo " | ".$exeDate." | ";  
                         $newArray=$taskArray;
                         //$taskTotalOccurenceCount++;
                         $newArray['task_last_execution_date']=$exeDate;   
                         $newArray['task_execution_count']=$taskTotalOccurenceCount;
                         
                           if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                            $task_is_done=1;  
                            }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){
                                $task_is_done=1; 
                                }
                         $newArray['task_is_done']=$task_is_done;
                         array_push($pastArray, $newArray);
                         
                         if($task_is_done==1)
                            break;
                         
                         $week_exe_count++;
                         if($week_exe_count == $taskExeNumOfTimesInWeek){
                             if($wkintervalday==0)  {
                                  $is_exe_this_week=1;     
                             }else{
                                 $is_exe_this_week=0;     
                             }
                           
                            $week_exe_count=0; 
                         }
                      //  echo "<br/> ====> IS exe in this ".$is_exe_this_week." wk count ".$week_exe_count;
                     }else{
                          $week_exe_count++; 
                          if($week_exe_count >= $wkintervalday){
                            $is_exe_this_week=1;
                            $week_exe_count=0; 
                         }  
                       // echo "<br/> ====> IS exe in this ".$is_exe_this_week." wk count ".$week_exe_count; 
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
    /*    
       if($task_is_done==0){
           // STEP: CALCULATE NEXT OCCURENCE DATE FOR TASK
            $taskNextOccurenceDate=$this->calculateWeeklyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskEveryNumofWeeks, $taskWeekDayArray, $taskExeNumOfTimesInWeek, $taskTaskEndAfterOccurrences, $taskTaskEndByDate);    
              if($taskNextOccurenceDate=="0000-00-00"){
                     $task_is_done=1;
                }      
                     $newArray=$taskArray;
                     //$taskTotalOccurenceCount++;
                     $newArray['task_last_execution_date']=$taskNextOccurenceDate;   
                     $newArray['task_execution_count']=$taskTotalOccurenceCount;
                     $newArray['task_is_done']=$task_is_done;
                     array_push($pastArray, $newArray);
             
       }else{
           // STEP : TASK IS COMPLETED , SO NEXT EXECUTION DATE IS NOT AVAILABLE
           $taskNextOccurenceDate="0000-00-00";
           
           $newArray['task_last_execution_date']=$taskNextOccurenceDate;   
           $newArray['task_execution_count']=$taskTotalOccurenceCount;
           $newArray['task_is_done']=$task_is_done;
           array_push($pastArray, $newArray);
       } 
       */
       
    /*   
       $taskArray['task_last_execution_date']=$taskLastExecutionDate;   
       $taskArray['task_execution_count']=0;
       $taskArray['task_start_occurrence_date']=$taskStartOccurenceDate;
       $taskArray['task_last_occurrence_date']=$taskLastOccurenceDate;
       $taskArray['task_occurrences_count']=$taskTotalOccurenceCount;
       $taskArray['task_next_execution_date']=$taskNextOccurenceDate;
       $taskArray['task_is_done']=$task_is_done;
      */
       
        return $pastArray;
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
         $today=date("Y-m-d");
         $wkintervalday=  $taskExeNumOfTimesInWeek * ($taskEveryNumofWeeks -1);
         $taskStartDate=date('Y-m-d', strtotime($taskStartDate));
      //  $taskLastOccurenceDate=date('Y-m-d', strtotime($taskLastOccurenceDate));
          
           
         if($taskLastOccurenceDate!="0000-00-00"){
              $taskNextExeChkDate= $taskLastOccurenceDate;       
         }else{
              $taskNextExeChkDate= $taskStartDate;   
         }
         $taskNextOccurenceDate="0000-00-00";
         $datetime=  strtotime($taskNextExeChkDate);
                     $nxtChkDtYear= date("Y",$datetime);
                     $nxtChkDtWkNum= date("W",$datetime);
                     $nxtChkDtNum= date("N",$datetime);
                     $exdate=date("d-m",$datetime);   
                     
                     $currWkNum= date("W");
                     $currYear= date("Y");
                  
                 
                   //  echo "<br/> CHK DATE WK NUM : ".$nxtChkDtWkNum;
                   //  echo "<br/> CURR DATE WK NUM : ".$currWkNum;
                        if(($nxtChkDtWkNum >= $currWkNum && $nxtChkDtYear==$currYear) || ( $nxtChkDtYear > $currYear) || ($nxtChkDtWkNum == 1)){
                               $is_exe_this_week=1;
                               $week_exe_count=0; 
                               if(($exdate=="31-12" || $exdate=="30-12" || $exdate=="29-12" || $exdate=="28-12" || $exdate=="27-12" || $exdate=="26-12") && $nxtChkDtNum==1 && $taskLastOccurenceDate!="0000-00-00"){
                                      $nxtChkDtYear=$nxtChkDtYear+1;
                               }
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
                            $taskNextExeChkDate=date("Y-m-d",strtotime(date("Y-m-d", strtotime(date("Y").'W'.$stWknum)))) ;
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
                               if($exeDate >= $today && $exeDate >= $taskStartDate) {
                                 $taskNextOccurenceDate=$exeDate;          
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
        $taskStartDate=$taskArray['starttime'];
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
       $pastArray=array();
         
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
                                        if(strtolower($month)=="december" ){
                                            $year=$year+1;
                                            $month="january";
                                        }else{
                                             $result = strtotime("01 ".$month." ".$year);     
                                            $month = date('F', strtotime('+1 month', $result)); 
                                        }
                                       //  $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;
                                         $nthDayOfMonthPattern="-1 week ".$taskMonthWeekDayName;                           
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
                                  //  $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName; 
                                    $nthDayOfMonthPattern="-1 week ".$taskMonthWeekDayName;                          
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

                                        $newArray=$taskArray;
                                        //$taskTotalOccurenceCount++;
                                        $newArray['task_last_execution_date']=$taskLastOccurenceDate;   
                                        $newArray['task_execution_count']=$taskTotalOccurenceCount;                                
                                        $newArray['task_is_done']=$task_is_done;
                                        array_push($pastArray, $newArray);      

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
       
       /*
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
       */
        return $pastArray;
       
    }
    
    
    
   function calculateMonthlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskMonthlyPattern, $taskMonthDate,$taskMonthEveryNumofMonth,$taskMonthWeekNumber,$taskMonthWeekDayName, $taskMonthWeekEveryNumofMonth,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate){
             $today=date("Y-m-d");
             
             $taskStartDate=date('Y-m-d', strtotime($taskStartDate));     
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
                           //  $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;   
                           //strtotime('-1 week sun nov 2009'); // last sunday in oct 2009 
                           $nthDayOfMonthPattern="-1 week ".$taskMonthWeekDayName;         
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
                 //echo "<br/> EXe date".$taskExeDate;
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
                                if(strtolower($month)=="december" ){
                                    $year=$year+1;
                                    $month="january";
                                }else{
                                     $result = strtotime("01 ".$month." ".$year);      
                                    $month = date('F', strtotime('+1 month', $result)); 
                                }
                                // $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;
                                 $nthDayOfMonthPattern="-1 week ".$taskMonthWeekDayName;                            
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
                  $lastYear=  date("Y", strtotime($taskLastOccurenceDate));
                  $lastMon=  date("F", strtotime($taskLastOccurenceDate));
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
                                // $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;
                                 $nthDayOfMonthPattern="-1 week ".$taskMonthWeekDayName;  
                        }else if($taskMonthlyPattern=="dayofeverymonth"){
                                // selected date will not come in some month then it will take last date of month 
                               $lastDayofMonth = date('t',strtotime("1 ".$month." ".$year));   
                               if($lastDayofMonth < $taskMonthDate) {
                                    $nthDayOfMonthPattern=$lastDayofMonth;   
                               }
                       }
                 
                  $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$month." ".$year);   
                  $taskNextOccurenceDate=date("Y-m-d", $utNthDateOfMonth);  
                // $taskNextOccurenceDate= $taskLastOccurenceDate;
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
                             //    $nthDayOfMonthPattern=$taskMonthWeekNumber." ".$taskMonthWeekDayName;
                                 $nthDayOfMonthPattern="-1 week ".$taskMonthWeekDayName;                            
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
        $taskStartDate=$taskArray['starttime'];
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
       $taskYearWeekMonthName=strtolower($taskArray['yearly_weekof_month']);  // May, June etc

       $today=date("Y-m-d"); 
       $pastArray=array();
                 
       // STEP : CHECK IF $taskStartDate <  $today     -   then Calcute Task Past Occurrences Date and total count  
       if($taskStartDate < $today){
            // STEP : SET TASK nth DAy of Month based on yearly pattern 
            if($taskYearlyPattern=="everynoofmonths"){
                    $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;    
            }else if($taskYearlyPattern=="theweekofmonths"){
                    //$nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$taskYearWeekMonthName;    
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
                                $year=$taskStartDateYear;  
                                $result = $result =strtotime("1 ".$taskYearWeekMonthName." ".$taskStartDateYear); //$result = strtotime("{$taskStartDateYear}-{$taskYearWeekMonthName}-01"); 
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
                    // $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$year);   
                     
                    // STEP: if stratYear and cuurYear are same, then task is same year so calculate exeDate
                     $utNthDateOfMonth = strtotime( $nthDayOfMonthPattern." ".$year);   
                     $exeDate=date("Y-m-d", $utNthDateOfMonth); 
                     // STEP : CHK if exe date or total occurences are exceeds edndate or end occurrences, if yes the task is completed.
                    
                     if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                        $task_is_done=1; 
                     }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){
                        $task_is_done=1;  
                     } else{
                             if($exeDate < $today) {    
                                if($taskStartOccurenceDate=="0000-00-00"){
                                    $taskStartOccurenceDate= $exeDate;
                                }
                                $taskLastOccurenceDate= $exeDate;
                                $taskTotalOccurenceCount=$taskTotalOccurenceCount+1; 
                                
                                $newArray=$taskArray;
                                 //$taskTotalOccurenceCount++;
                                 $newArray['task_last_execution_date']=$exeDate;   
                                 $newArray['task_execution_count']=$taskTotalOccurenceCount;                                
                                 $newArray['task_is_done']=$task_is_done;
                                 array_push($pastArray, $newArray);       
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
                                       $result = $result =strtotime("1 ".$taskYearWeekMonthName." ".$year);// $result = strtotime("{$year}-{$taskYearWeekMonthName}-01"); 
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
                          /*  if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                $task_is_done=1;     break;
                            }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){
                                $task_is_done=1;    break;
                            }
                          */
                          
                          $newArray=$taskArray;
                         //$taskTotalOccurenceCount++;
                         $newArray['task_last_execution_date']=$exeDate;   
                         $newArray['task_execution_count']=$taskTotalOccurenceCount;
                         
                           if($taskTaskEndAfterOccurrences!=0 && $taskTotalOccurenceCount >= $taskTaskEndAfterOccurrences){
                                $task_is_done=1;  
                            }else if($taskTaskEndByDate!="0000-00-00" &&  $exeDate > $taskTaskEndByDate){
                                $task_is_done=1; 
                            }
                         $newArray['task_is_done']=$task_is_done;
                         array_push($pastArray, $newArray);
                         
                         if($task_is_done==1) break;
                          
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
     
     /*  
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
       
       
         $newArray['task_last_execution_date']=$taskNextOccurenceDate;   
         $newArray['task_execution_count']=$taskTotalOccurenceCount;                                                
         $newArray['task_is_done']=$task_is_done;
         array_push($pastArray, $newArray);
       */
       
        return $pastArray;
    }
  
   
   function calculateYearlyNextExecutionDate($taskLastOccurenceDate,$taskTotalOccurenceCount,$taskStartDate, $taskYearlyPattern, $taskYearEveryMonth,$taskYearEveryMonthDate,$taskYearWeekNumber,$taskYearWeekDayName, $taskYearWeekMonthName,  $taskTaskEndAfterOccurrences, $taskTaskEndByDate){    
       $taskYearWeekMonthName=strtolower($taskYearWeekMonthName);
       $taskStartDate=date('Y-m-d', strtotime($taskStartDate));    

              $today=date("Y-m-d");
              $taskNextOccurenceDate="0000-00-00"; 
              if($taskYearlyPattern=="everynoofmonths") {
                  $nthDayOfMonthPattern=$taskYearEveryMonthDate." ".$taskYearEveryMonth;    
              }else if($taskYearlyPattern=="theweekofmonths"){
                  //$nthDayOfMonthPattern=$taskYearWeekNumber." ".$taskYearWeekDayName." ".$taskYearWeekMonthName; 
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
                                
                                $result =strtotime("1 ".$taskYearWeekMonthName." ".$taskNxtDateYear); // strtotime("{$taskNxtDateYear}-{$taskYearWeekMonthName}-01"); 
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
                              //  $year=$taskStartDateYear;  
                                $result = $result =strtotime("1 ".$taskYearWeekMonthName." ".$taskNxtDateYear); //strtotime("{$taskNxtDateYear}-{$taskYearWeekMonthName}-01"); 
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
                 
                  if($taskNextOccurenceDate < $today) {     // echo "is less .....";
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
 
}
?>
