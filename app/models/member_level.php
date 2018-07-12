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

    class MemberLevel extends AppModel{

        var $name	= 'MemberLevel'; 
        var $useTable	= 'member_levels';// table name

        var $validate = array(

        'level_name' => array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please provide Member Level Name.'
        )								
        );



       /**
       * Function to get all donation levles of project, filter with search key if given
       * 
       * @param mixed $project_id
       * @param mixed $searchkey
       * @param mixed $order
       * @param mixed $limit
       * @param mixed $page
       */

        function getDonationLevelsByProject($project_id='0', $searchkey="", $order="", $limit="", $page=""){
            	$resultArray=null;    
				$condition=" MemberLevel.project_id='".$project_id."' and MemberLevel.delete_status='0' ";        
                if($searchkey!=""){
                    $condition .= " AND ( MemberLevel.level_name like '%".$searchkey."%' ) ";             
    	            }
		           $resultArray = $this->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));          
	  return $resultArray;
				   
        } 

        /**
        * Function to get last donation level of project
        * 
        * @param mixed $project_id
        */
        function getLastDonationLevelOfProject($project_id='0'){
			$condition=" MemberLevel.project_id=0 and MemberLevel.delete_status='0' ";  			
            $order="MemberLevel.id desc";
            $limit="1";
            $resultArray=null;    
			$page='';
            $resultArray = $this->find('first',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page			
			));
            return $resultArray;   
        }
		
		/**
        * Function to get last donation level of project
        * 
        * @param mixed $project_id
        */
        function getLastDonationLevelforsa(){
            $condition=" DonationLevel.project_id=0  and DonationLevel.delete_status='0'";  
            $order="DonationLevel.id desc";
            $limit="1";
            $resultArray=null;    
			$page='';
            $resultArray = $this->find('first',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            return $resultArray;   
        }

    }
?>