<?php

class SurveyHistory extends AppModel{
	
	var $name	= 'SurveyHistory'; 
	var $useTable	= 'survey_histories';// table name
	
	var $belongsTo = array(
					'Survey'=>array(
							'foreignKey'=>'survey_id'
					),
					'Holder'=>array(
							'foreignKey'=>'member_id'
					)
			); 
}
?>