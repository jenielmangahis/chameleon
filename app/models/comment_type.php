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

class CommentType extends AppModel{

	var $name	= 'CommentType'; 
	var $useTable	= 'comment_types';// table name
	
 	var $validate = array(
	  
	  					'	comment_type_name' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Comment Type.'
    										)								
					   );
}
?>