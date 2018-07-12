<?php
class BorderFooter extends AppModel{

    var $name    = 'BorderFooter'; 
    var $useTable    = 'border_footer';// table name
    
    var $components = array('Pagination');

     
	var $validate = array(
      
                        'border_footer_name' => array(
										'notEmpty' =>array(
                                        'rule' => 'notEmpty',
                                        'message' => 'Please enter Border Footer name.'
                                        ),
										'isUnique' => array(
                                        'rule' => 'isUnique',
                                        'message' => 'Border Footer name with same name already exists.'
                                        )
									)			
				);
}
?>