<?php
class DeclineSuspendType extends AppModel{

    var $name    = 'DeclineSuspendType'; 
    var $useTable    = 'decline_suspend_types'; // table name
    
    var $components = array('Pagination');

     
 var $validate = array(
      
                        'type_name' => array(
										'notEmpty' =>array(
                                        'rule' => 'notEmpty',
                                        'message' => 'Please provide Decline/Suspend Type name.'
                                         ),
										'isUnique' => array(
                                        'rule' => 'isUnique',
                                        'message' => 'Decline/Suspend Type with same name already exists.'
                                         )
									),
						'type_category' => array(
										'notEmpty' =>array(
                                        'rule' => 'notEmpty',
                                        'message' => 'Please select Decline/Suspend Type category.'
                                         )
									)						
				);
}
?>