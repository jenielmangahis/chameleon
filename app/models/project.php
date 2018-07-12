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

class Project extends AppModel{

	var $name	= 'Project'; 
	var $useTable	= 'projects';// table name
	
	
	var $validate = array(
	  
	  					'project_name' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Project Name.'
    										),
//     					'serialprefix' => array(
//         								'rule' => VALID_NOT_EMPTY,
// 	    								'message' => 'Please provide Serial Prefix.'
//     										),
    					'project_type_id' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Project Type.'
    										)																								
					   );
	
 
}
?>