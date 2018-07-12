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

class CommunicationTaskExecutionReport extends AppModel{

	var $name	= 'CommunicationTaskExecutionReport'; 
	var $useTable	= 'communication_task_execution_reports';// table name
	
 
 function getEmailsListByHolderCondition($holderid,  $email="", $searchkey=""){
 
	 if($holderid ){
            $condition = "CommunicationTaskExecutionReport.memberid='".$holderid."' ";              
            if($email!=""){
                 $condition .= " AND CommunicationTaskExecutionReport.sent_to_email = '".$email."' ";              
            } 
            if($searchkey!=""){
                 $condition .= " AND (CommunicationTaskHistory.task_name like '%".$searchkey."%' OR EmailTemplate.email_template_name  like '%".$searchkey."%') ";             
            }
             return $condition;  
     }else{
         return "";
     }
    
 }
 
 function getEmailsListByHolder($condition="", $order="", $limit="", $page=""){
    $resultArray=null;    
    $this->bindModel(array('belongsTo'=>array(
            'CommunicationTaskHistory'=>array(
            'foreignKey'=>false,
            'conditions'=>'CommunicationTaskHistory.id = CommunicationTaskExecutionReport.task_execution_id'
            ),'EmailTemplate'=>array(
            'foreignKey'=>false,
            'conditions'=>'EmailTemplate.id = CommunicationTaskExecutionReport.email_template_id'
            )
     )));
     
     /*  if($order=="" || $limit=="" || $page==""){
            $resultArray= $this->find('all',array("conditions"=>$condition));  
        }else{   */
             $resultArray = $this->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
       // }
     
  
     return $resultArray;
 }
 
}
?>