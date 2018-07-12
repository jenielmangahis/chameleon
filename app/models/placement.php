<?php
class Placement extends AppModel{

	var $name	= 'Placement'; 
	var $useTable	= 'Placements';// table name
	
	public $validate = array(
       'place_name' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'The username has already been taken.',
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        )
    );
}
?>