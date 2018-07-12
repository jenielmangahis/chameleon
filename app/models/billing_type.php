<?php
class BillingType extends AppModel{

    var $name    = 'BillingType'; 
    var $useTable    = 'billing_types'; // table name
    
    var $components = array('Pagination');

     
 var $validate = array(
      
                        'billing_type' => array(
										'notEmpty' =>array(
                                        'rule' => 'notEmpty',
                                        'message' => 'Please Enter billing type name.'
                                         ),
										'isUnique' => array(
                                        'rule' => 'isUnique',
                                        'message' => 'Billing type with same name already exists.'
                                         )
									),
						'payment_type' => array(
										'notEmpty' =>array(
                                        'rule' => 'notEmpty',
                                        'message' => 'Please select payment type.'
                                         )
									)						
				);
}
?>