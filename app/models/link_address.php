<?php
class LinkAddress extends AppModel{

	var $name	= 'LinkAddress'; 
	var $useTable	= 'link_addresses';// table name
	
	public $validate = array(
       'link_address' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
		 'description' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        )
    );
}	
?>