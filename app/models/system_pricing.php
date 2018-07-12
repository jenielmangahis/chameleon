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

class SystemPricing extends AppModel{

    var $name    = 'SystemPricing'; 
    var $useTable    = 'system_pricings';// table name
    

     
 var $validate = array(
      
                          'system_pricing_name' => array(
                                        'rule' => VALID_NOT_EMPTY,
                                        'message' => 'Please provide System Pricing name.'
                                            )                                
                       );
 
 
 


    function system_pricing($opr,$id="",$data)
    {
        
        if($opr=="add" || $opr=="edit")
        {
            ##check empty data
            if(!empty($data)) {
                #set the posted data
                $this->set($data);
				//print_r($data); die;
                #check server side validation
                $this->invalidFields();
               
                $sys_ver_name=AppController::getsystemversionnamebyID($data['SystemPricing']['system_version_id']);
                $price_type=$data['SystemPricing']['pricing_type']; 
                              
                $sys_pricing_name = $sys_ver_name." ".$price_type;
                $data['SystemPricing']['system_pricing_name']=$sys_pricing_name;
                
                $data['SystemPricing']['setup_fee'] = substr($data['SystemPricing']['setup_fee'], 1);
                
                if($opr=="add")
                {
                
                    if($data['SystemPricing']['system_pricing_name']!="")
                    {
                        $condition = "system_pricing_name = '".$sys_pricing_name."' AND  delete_status = '0'";
                        $vdata = $this->find('all',array("conditions"=>$condition));                 
                    }
                }
                else
                if($opr=="edit")
                {
                    $data['SystemPricing']['id']=$id;
                    if($data['SystemPricing']['system_pricing_name']!="")
                    {
                        $condition = "system_pricing_name = '".$sys_pricing_name."' AND  delete_status = '0' and id!='".$id."'";
                        $vdata = $this->find('all',array("conditions"=>$condition));                 
                    }
                }
                
                $msg="";
                $success=0;
                
                if(empty($vdata)){

                        if($this->Save($data)){
                            
                            if($opr="add")
                            {
                                $id = $this->id;
                                $sys_pricing_id=$this->getInsertID();
                            }
                            
                            if($opr="edit")
                            {
                                $this->query("delete from system_monthly_pricings where system_pricing_id=$id"); 
                                $sys_pricing_id=$id;
                            }
                          
                             $mp=$data['SystemPricing']['monthly_price'];
   
                             $nom=$data['SystemPricing']['no_of_members'];
                             
                              for($i=0;$i<count($mp);$i++)
                              {
                                    $monthly_price=$mp[$i];
                                    $monthly_price = substr($monthly_price, 1);
                                    
                                    $member_nos=$nom[$i];
                                    
                                    if($monthly_price!="" && $monthly_price!="0.00" && $member_nos!=0)
                                        $this->query("insert into system_monthly_pricings values('',$sys_pricing_id,'$monthly_price',$member_nos)"); 
                              }
				  
                            $msg='System Pricing updated Successfully.';
                            $success=1;

                        }else{
                            $msg='Error in processing. Please try again.';
                            $success=0;                          
                        }
                   
                }else{

                    $msg='System Pricing with same name already exists.';
                    $success=0;                          
                }
                
                $status['msg']=$msg;
                $status['success']=$success;
                
                return $status;
              
            }
            
         
        }      
        
        return false;
        
    }
    


}
?>