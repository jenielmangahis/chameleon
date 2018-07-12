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

class ShippingType extends AppModel{

	var $name	= 'ShippingType'; 
	var $useTable	= 'shipping_types';// table name
	
	 	var $validate = array(
	  
	  					'shipping_type_name' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Shipping Type.'
    										),
    					'shipdays' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Shipping Days.'
    										)														
					   );
	
 
}
?>