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

    class Holder extends AppModel{

        var $name	= 'Holder'; 
        var $useTable	= 'holders';// table name


        var $validate = array(

        'firstname' => array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please provide First Name.'
        ),
        'lastnameshow' => array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please provide Last Name.'
        ),
        'email' => array( array(
        'rule' => email,
        'message' => 'Please provide valid Email Address.'
        ),
        'email' => array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please provide Email Address.'
        )	
        ),
        'screenname' => array(
        'notempty' =>array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please provide Screen Name.',
        'last'    => true
        )
        ),
        'country' => array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please provide Country.'
        ),
        'zipcode' => array(
        'rule' => VALID_NOT_EMPTY,
        'message' => 'Please provide Zip/Postal Code.'
        )
		//'phone' => array(
//        'rule' => '^(\+|\+ )?\d+([ -]?\d+)*$',
//        'message' => 'Please provide Valid Phone Number.'
//        ),												
        );

        function isUniqueScreenName($screen_name,  $holder_id = null)
        {

            //echo 	$screen_name.$project_id.$holder_id."<br/>";
            if ($holder_id == null) {
                $conditions = array("Holder.screenname = '$screen_name'" );
            }
            else {
                $conditions = array("Holder.screenname = '$screen_name'" , "Holder.id != $holder_id");
            }

            $holder = $this->find('first', array('conditions' => $conditions));

            if (isset($holder) && $holder !== false) {
                return false;
            }

            return true;
        }

        /**
        * Function to get all members of given project with given member type , filter result by search key and sor list with $order, $page , $limit parameters
        * 
        * @param mixed $project_id
        * @param mixed $member_type
        * @param mixed $searchkey
        * @param mixed $order
        * @param mixed $limit
        * @param mixed $page
        */
        function getMemberListByProject($member_type ="",$searchkey="",$order="", $limit="", $page=""){
            $resultArray=null;        
            
                $holderCond=" Holder.delete_status='0' ";				
				App::import("Model", "MemberType");  
           		$this->MemberType =  & new MemberType();				
                if($member_type){
                   $holderCond.=" AND MemberType.member_type = '".$member_type."' ";
                }

                if($searchkey){
                    $holderCond.=" AND ( Holder.screenname like '%".$searchkey."%' OR Holder.firstname like '%".$searchkey."%' OR Holder.lastnameshow like '%".$searchkey."%'   )";    //OR Holder.email  like '%".$searchkey."%'
                }


                $this->bindModel(array('belongsTo'=>array(
                'MemberType'=>array(
                'foreignKey'=>false,
                'conditions'=>'MemberType.id = Holder.member_type'
                )
               /* 'DonationLevel'=>array(
                'foreignKey'=>false,
                'conditions'=>'DonationLevel.id = Holder.donation_level'
                )    */
				  )));
                $fields=" Holder.*, MemberType.*,  (select sum(points) from point_archive_users where member_id=Holder.user_id) as totalpoints";
                $resultArray = $this->find('all',array("conditions"=>$holderCond, 'fields'=>$fields, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
            	return $resultArray;
        }
		
		function getMemberListBylevels($member_type ="",$searchkey="",$order="", $limit="", $page=""){
            $resultArray=null;        
            
                $holderCond=" Holder.delete_status='0' ";				
				App::import("Model", "MemberType");  
				App::import("Model", "MemberLevel");  
           		$this->MemberType =  & new MemberType();				
                if($member_type){
                   $holderCond.=" AND MemberType.member_type = '".$member_type."' ";
                }

                if($searchkey){
                    $holderCond.=" AND ( Holder.screenname like '%".$searchkey."%' OR Holder.firstname like '%".$searchkey."%' OR Holder.lastnameshow like '%".$searchkey."%'   )";    //OR Holder.email  like '%".$searchkey."%'
                }


                $this->bindModel(
								array(
									'belongsTo'=>array(
											'MemberType'=>array(
												'foreignKey'=>false,
												'conditions'=>'MemberType.id = Holder.member_type'
											),
											'MemberLevel'=>array(
											    'foreignKey'=>false,
												'conditions'=>'MemberLevel.id = Holder.member_level'
											)
									)
								)
								);
                $fields=" Holder.*, MemberType.*,MemberLevel.id,MemberLevel.level_name,  (select sum(points) from point_archive_users where member_id=Holder.user_id) as totalpoints";
                $resultArray = $this->find('all',array("conditions"=>$holderCond, 'fields'=>$fields, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
           // echo '<pre>';print_r($resultArray);die;
            return $resultArray;
        }
		
		
		/*Created on 21/11/2012*/
		function getMemberListByCoinHolder($member_type ="",$searchkey="",$order="", $limit="", $page=""){
            	$resultArray=null;                    
                $holderCond=" Holder.delete_status='0' ";				
				App::import("Model", "MemberType");  
				$this->MemberType =  & new MemberType();		
				
				App::import("Model", "CoinsHolder");  
           		$this->CoinsHolder =  & new CoinsHolder();	
                if($member_type){
                   $holderCond.=" AND MemberType.member_type = '".$member_type."'";
                }

                if($searchkey){
                    $holderCond.=" AND ( Holder.screenname like '%".$searchkey."%' OR Holder.firstname like '%".$searchkey."%' OR Holder.lastnameshow like '%".$searchkey."%'   )";    //OR Holder.email  like '%".$searchkey."%'
                }
                
				$this->bindModel(array('belongsTo'=> array(
						'MemberType'=>array(
							'foreignKey'=>'member_type'
				))));
				
				$this->bindModel(array('hasMany'=>array(
	                'CoinsHolder'=>array(
	                'conditions'=>array('CoinsHolder.holder_id' => 'Holder.user_id')
				))));
				
                $fields=" Holder.*, MemberType.*, (select sum(points) from point_archive_users where member_id=Holder.user_id) as totalpoints";
				//$holderCond.=' AND CoinsHolder.holder_id = Holder.user_id';
                $resultArray = $this->find('all',array("conditions"=>$holderCond, 'fields'=>$fields, 'order' =>$order, 'page' => $page)); 

				for($l=0;$l<count($resultArray);$l++){
					if(empty($resultArray[$l]['CoinsHolder'])){
						unset($resultArray[$l]);
					}
				}
				return $resultArray;
        }
    }
?>