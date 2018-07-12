<?php
class Link extends AppModel{

	var $name	= 'Link'; 
	var $useTable	= 'links';// table name
	
	public $validate = array(
        'links_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),
		'linkgroup' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
		
		 'link_placement' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
		 'link_address' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
		
		 'visual_text' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
        'created_link' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
        'stime' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
        'etime' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
        'redirect_link' => array(
            'url' => array(
                            'rule' => 'url',
                            'allowEmpty' => true,
                            'message' => 'This field cannot be left blank.',
                        )
        ),
		
    );
}	
?>