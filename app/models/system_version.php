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

class SystemVersion extends AppModel{

    var $name    = 'SystemVersion'; 
    var $useTable    = 'system_versions';// table name
    
    var $components = array('Pagination');

     
 var $validate = array(
      
                          'system_version_name' => array(
										'notEmpty' =>array(
                                        'rule' => 'notEmpty',
                                        'message' => 'Please provide System Version name.'
                                         ),
						 'isUnique' => array(
                                        'rule' => 'isUnique',
                                        'message' => 'System Version with same name already exists.'
                                         )
								)			 
				);


      
                         							
			

/* function system_version($opr,$id="",$data=array())
    {      

		if($opr=="add" || $opr=="edit")
        {
			##check empty data
           if(!empty($data)){
			     #set the posted data
				 $this->set($data);
                #check server side validation
                $this->invalidFields();
				$ver_name  = $data['SystemVersion']['system_version_name'];                
                if($opr=="add")
                {
                
                    if($data['SystemVersion']['system_version_name']!="")
                    {
                        $condition = "system_version_name = '".$ver_name."' AND  delete_status = '0'";
                        $vdata = $this->find('all',array("conditions"=>$condition));                 
                    }
                }
                else
                if($opr=="edit")
                {
                    $data['SystemVersion']['id']=$id;
                    if($data['SystemVersion']['system_version_name']!="")
                    {
                        $condition = "system_version_name = '".$ver_name."' AND  delete_status = '0' and id!='".$id."'";
                        $vdata = $this->find('all',array("conditions"=>$condition));                 
                    }
                }                
                $msg="";
                $success=0;
                
                if(empty($vdata)){

                        if($this->Save($data)){

                            $msg='System Version updated Successfully.';
                            $success=1;

                        }else{
                            $msg='Error in processing. Please try again.';
                            $success=0;                          
                        }
                   
                }else{

                    $msg='System Version with same name already exists.';
                    $success=0;                          
                }
                
                $status['msg']=$msg;
                $status['success']=$success;
                
                return $status;
              
            }
            
         
        }      
        
        return false;
        
    }*/
    


}
?>