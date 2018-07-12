<?php

class CouponLayout extends AppModel{

	var $name	= 'CouponLayout'; 
	var $useTable	= 'coupon_layouts'; // table name
	
	var $validate = array(
	  					
	  					'layout_name' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide layout Name.'
    										),
						'description' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide description.'
    										)	
					   );
}
?>