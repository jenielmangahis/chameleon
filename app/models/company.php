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

class Company extends AppModel{

	var $name	= 'Company'; 
	var $useTable	= 'companies';// table name
 
	  	var $validate = array(
	  					
	  					'company_type_id' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Company Type.'
    									),
	  					'company_name' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Company Name.'
    									),
						
						array('condition' => '$data[\'Company\'][\'company_type_id\'] == "66"', 
							'validate' => array( 'ein' => array(
					        								'rule' => '([0-9]{2}[-]{1}[0-9]{7})',
	    													'message' => 'Please provide EIN like xx-1234567.'
    									))),
						array('condition' => '$data[\'Company\'][\'company_type_id\'] == "67"',
						'validate' => array( 'non_profit_type_id' => array( 
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Non-profit Type.'
    									)))														
											
					   );
}
?>