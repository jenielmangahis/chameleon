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

class SpamPolicy extends AppModel{

    var $name    = 'SpamPolicy'; 
    var $useTable    = 'spam_policy';// table name
	
    function spam_policy($opr='',$id="",$data=null)
    {
      
	   // $this->session_check_admin();
	   if($opr=="add" || $opr=="edit")
        {

            ##check empty data
            
			if(!empty($data)) {
				
				#set the posted data
                $this->set($data);
                #check server side validation
                $this->invalidFields();
				
                $policy_content  = $data['SpamPolicy']['policy_content'];
                $data['SpamPolicy']['created_by']=1;    //admin
                
                if($data['SpamPolicy']['policy_content']=="")
                {
                    $msg='Spam Policy Content should not be empty.';
                    $success=0;               
                    $status['msg']=$msg;
                    $status['success']=$success;                    
                    return $status;
                }
				else{
//					
					if($this->Save($data)){
                            $msg='Spam Policy updated Successfully.';
                            $success=1;

                        }else{
                            $msg='Error in processing. Please try again.';
                            $success=0;                          
                        }
				}
			    /*if($opr=="edit")
                    $data['SpamPolicy']['id']=$id;
                               
                $msg="";
                $success=0;
                $vdata="";
                 if(empty($data)){
                        if($this->Save($data)){
                            $msg='Spam Policy updated Successfully.';
                            $success=1;

                        }else{
                            $msg='Error in processing. Please try again.';
                            $success=0;                          
                        }
                   
                }else{

                    $msg='Spam Policy with same name already exists.';
                    $success=0;                          
                }*/
                
                $status['msg']=$msg;
                $status['success']=$success;                
                return $status;              
            }           
         
        } 
        
        return false;
        
    }
 
         
}
?>