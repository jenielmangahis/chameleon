<?php
class PlacementType extends AppModel{

	var $name	= 'PlacementType'; 
	//var $useTable	= 'Placements';// table name
	
	
	public $validate = array(
       'name' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        )
		
		
    );
}
?>