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

class MemberType extends AppModel{

	var $name	= 'MemberType'; 
	var $useTable	= 'member_types';// table name
	
  	var $validate = array(
	  
	  					'member_type' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Member Type.'
    										)								
					   );
                       
                       
    const MEMBER_TYPE_HOLDER = 'Holder'; 
    const MEMBER_TYPE_NON_HOLDER = 'Non Holder'; 
    const MEMBER_TYPE_NON_MEMBER = 'Non Member'; 
    
    
        
 function getMemberTypesByProjectCondition($searchkey=""){
     
            $condition=" MemberType.delete_status='0' ";          
            if($searchkey!=""){
                $condition .= " AND ( MemberType.member_type like '%".$searchkey."%' ) ";             
            }
             return $condition;  
     }   

 function getMemberTypesByProject($condition="", $order="", $limit="", $page=""){
    $resultArray=null;    
   
             $resultArray = $this->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
      //  }
     
  
     return $resultArray;
 } 
    
                           
}
?>