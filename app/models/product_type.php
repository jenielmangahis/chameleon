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

class ProductType extends AppModel{

    var $name    = 'ProductType'; 
    var $useTable    = 'product_types';// table name
    
 /*
 var $validate = array(
      
                          'product_type_name' => array(
                                        'rule' => VALID_NOT_EMPTY,
                                        'message' => 'Please provide Project Type.'
                                            )                                
                       );
 */
 
 
  /***************
* function use in admin view(pricingtype) to get product name with ref to product id
*/

    function getproductname($product_id)
    {
        
         $condition = "id ='$product_id' AND  delete_status = '0'";
         $productdata = $this->ProductType->find('first',array("conditions"=>$condition));
         
         return $productdata['ProductType']['product_type_name'];
    }

}
?>