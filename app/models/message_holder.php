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

class MessageHolder extends AppModel{

	var $name	= 'MessageHolder'; 
	var $useTable	= 'message_holders';// table name
 
	
 function getMessagesByHolderCondition($holderid, $project_id, $searchkey=""){
     if($holderid && $project_id){
            $condition=" MessageHolder.holderid='".$holderid."' and MessageHolder.project_id='".$project_id."' and MessageHolder.active_status='1' and MessageHolder.delete_status='0' ";          
            if($searchkey!=""){
                $condition .= " AND ( Message.to_holdername like '%".$searchkey."%' OR Message.from_holdername like '%".$searchkey."%' OR  Message.msg_subject  like '%".$searchkey."%' ) ";             
            }
             return $condition;  
     }else{
         return "";
     }
    
 }
 
 function getMessagesByHolder($condition="", $order="", $limit="", $page=""){
    $resultArray=null;    
    $this->bindModel(array('belongsTo'=>array(
            'Message'=>array(
            'foreignKey'=>false,
            'conditions'=>'Message.id = MessageHolder.msgid'
            )       )));
     
      /** if($order=="" || $limit=="" || $page==""){
            $resultArray= $this->find('all',array("conditions"=>$condition));  
        }else{  *************/
             $resultArray = $this->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
      //  }
     
  
     return $resultArray;
 }
}
?>