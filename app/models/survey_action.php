<?php

class SurveyAction extends AppModel{
	
	var $name	= 'SurveyAction'; 
	var $useTable	= 'survey_actions';// table name
	
	var $validate = array(
			'action_title' => array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'Please provide Survey Action.'
			));
}
?>