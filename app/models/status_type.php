<?php
class StatusType extends AppModel{

    var $name    = 'StatusType'; 
    var $useTable    = 'status_types';// table name
    
    var $components = array('Pagination');

     
 var $validate = array(
      
                         'status_type' => array(
										'notEmpty' =>array(
                                        'rule' => 'notEmpty',
                                        'message' => 'Please provide Status Type name.'
                                         ),
										'isUnique' => array(
                                        'rule' => 'isUnique',
                                        'message' => 'Status Type with same name already exists.'
                                         )
									)			 
				);
}
?>