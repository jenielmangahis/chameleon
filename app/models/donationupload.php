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

    class Donationupload extends AppModel{

        var $name	= 'Donationupload'; 
        var $useTable	= 'donation_uploades';// table name

 var $validate = array(

        'type' => array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please Provide Donations.'
        )								
        );
		
		
		 function getdonationList($searchkey="",$order="", $limit="", $page=""){
            $resultArray=null;        
            
                $holderCond=" Donationupload.delete_status='0' ";				
				

                if($searchkey){
                    $holderCond.=" AND ( Donationupload.name like '%".$searchkey."%' OR Donationupload.loginname like '%".$searchkey."%' OR Donationupload.filename like '%".$searchkey."%'   )";    //OR Holder.email  like '%".$searchkey."%'
                }


               
               
               /* 'DonationLevel'=>array(
                'foreignKey'=>false,
                'conditions'=>'DonationLevel.id = Holder.donation_level'
                )    */
			
                $fields=" Donationupload.*,(select sum(points) from point_archive_users where id=Donationupload.id) as totalpoints";
                $resultArray = $this->find('all',array("conditions"=>$holderCond, 'fields'=>$fields, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
            	return $resultArray;
        }
		
		
		
    }
?>