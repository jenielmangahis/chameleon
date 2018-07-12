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

class UserAgreement extends AppModel{

    var $name    = 'UserAgreement'; 
    var $useTable    = 'user_agreements';// table name
    
    
    function user_agreement($opr,$id="",$data)
    {
        
        if($opr=="add" || $opr=="edit")
        {

            ##check empty data
            if(!empty($data)) {

                #set the posted data
                $this->set($data);
                #check server side validation
                $this->invalidFields();
               
                $agr_name  = $data['UserAgreement']['agreement_name'];
                
                
                if($data['UserAgreement']['agreement_content']=="")
                {
                    $msg='User Agreement Content should not be empty.';
                    $success=0;                          
               
                    $status['msg']=$msg;
                    $status['success']=$success;
                    
                    return $status;
                }
                
                /*
				if($data['UserAgreement']['default_new_projects']==1)
                {                    
                    $update_agr=$this->query("update user_agreements set default_new_projects='0' where default_new_projects='1'");
				}
				*/
                
                if($opr=="add")
                {
                
                    if($data['UserAgreement']['agreement_name']!="")
                    {
                        $condition = "agreement_name = '".$agr_name."' AND  delete_status = '0'";
                        $vdata = $this->find('all',array("conditions"=>$condition));                 
                    }
                }
                else
                if($opr=="edit")
                {
                    $data['UserAgreement']['id']=$id;
                    if($data['UserAgreement']['agreement_name']!="")
                    {
                        $condition = "agreement_name = '".$agr_name."' AND  delete_status = '0' and id!='".$id."'";
                        $vdata = $this->find('all',array("conditions"=>$condition));                 
                    }
                }
                
                $msg="";
                $success=0;
                
                if(empty($vdata)){
                        if($this->Save($data)){
							$id = $this->id;
							if($data['UserAgreement']['default_new_projects'] == 1) {
								//$update_agr=$this->query("update user_agreements set default_new_projects='1' where id = $id");
								$update_agr=$this->query("update user_agreements set default_new_projects='0' where id != $id AND delete_status ='0'");
							}
                            $msg='User Agreement updated Successfully.';
                            $success=1;

                        }else{
                            $msg='Error in processing. Please try again.';
                            $success=0;                          
                        }
                   
                }else{

                    $msg='User Agreement with same name already exists.';
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