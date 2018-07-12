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

class EventInvitation extends AppModel{

	var $name	= 'EventInvitation'; 
	var $useTable	= 'event_invitations';// table name
 
	
   
 function getEventsByHolderCondition($holderid, $project_id, $searchkey=""){
 		//echo $holderid .'/'.$project_id;
	 if($holderid && $project_id==0){
             $condition=" EventInvitation.invite_to_holder_id='".$holderid."' and EventInvitation.project_id='".$project_id."' and  EventInvitation.rec_event_id!='' and EventInvitation.active_status='1' and EventInvitation.delete_status='0' ";          
            if($searchkey!=""){
                $condition .= " AND ( RecurringEvent.event_title like '%".$searchkey."%' OR RecurringEvent.location like '%".$searchkey."%'  ) ";             
            }
			
             return $condition;  
     }else{
         return "";
     }
    
 }
 
 function getEventsByHolder($condition="", $order="", $limit="", $page=""){
    $resultArray=null;    
    $this->bindModel(array('belongsTo'=>array(
            'RecurringEvent'=>array(
            'foreignKey'=>false,
            'conditions'=>'RecurringEvent.id = EventInvitation.rec_event_id'
            ) )));
     
      /** if($order=="" || $limit=="" || $page==""){
            $resultArray= $this->find('all',array("conditions"=>$condition));  
        }else{  *************/
		
             $resultArray = $this->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
      //  }
     
  
     return $resultArray;
 } 
    
}
?>