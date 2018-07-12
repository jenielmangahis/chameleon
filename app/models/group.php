<?php
class Group extends AppModel{

	var $name	= 'Group'; 
	var $useTable	= 'groups';// table name
	
	
	public $validate = array(
       'groupname' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'The username has already been taken.',
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),
		 'discription' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        )
    );
}
?>