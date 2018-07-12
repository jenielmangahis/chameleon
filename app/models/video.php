<?php
class Video extends AppModel{

	var $name	= 'Video'; 
	var $useTable	= 'videos';// table name
	
	
	public $validate = array(
       'video_name' => array(
          'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ), 
          'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This field cannot be left blank.',
            ),                     
        ),
		 'video' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        ),
        'video_link_address' => array(
          
                    'notEmpty' => array('rule' => 'notEmpty',
                                'message' => 'This field cannot be left blank.',
                                ),
                    'url' => array('rule' => 'url',
                                'message' => 'Please supply valid link address.',
                                ),
             
        ),
		 'description' => array(
            'rule' => 'notEmpty',
            'message' => 'This field cannot be left blank.',
        )
    );
}
?>