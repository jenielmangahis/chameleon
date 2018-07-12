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

class Term extends AppModel{

	var $name	= 'Term'; 
	var $useTable	= 'terms';// table name

    function terms_by_admin($opr,$id="",$data)
    {
        

            $checkempty = true;
            ##check empty data
            if(!empty($data)) {
                $projectid=0;
                $data['Term']['project_id']=$projectid;
                
                if($data['Term']['id']=="" ||  $data['Term']['termscontent']=="" || $data['Term']['privacycontent']==""){
                   	$msg="All the fields are mandatory.";
                    $checkempty = false;
                    $success=0;
                }
                if($checkempty==true){
                    if($this->Save($data)){
                        $msg='Terms and Privacy updated Successfully.';
                        $success=1;
                    }else{
                        $msg='Error in processing.';
                        $status=0;
                    }
                }
                
                $status['msg']=$msg;
                $status['success']=$success;
                return $status;

            }

    }
	
}
?>