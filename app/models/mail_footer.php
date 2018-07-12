<?php
/*
Purpose: Get statrted model class
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

class MailFooter extends AppModel{

    var $name    = 'MailFooter'; 
    var $useTable    = 'mail_footer';// table name

    var $validate = array(
                          
                          'footer_content' => array(
                                        'rule' => VALID_NOT_EMPTY,
                                        'message' => 'Please provide mail Footer .'
                                        )
                                 );

    
 
}
?>