<?php
class Category extends AppModel{

	var $name		= 'Category'; 
	var $useTable	= 'categories'; // table name
	
	
			 /* var $hasMany = array(
				'CompanyToCategory' => array(
					'className' => 'CompanyToCategory',
					'foreignKey' => 'category_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			));
				
			 var $hasOne = array(
				'OfferToCategory' => array(
					'className' => 'OfferToCategory',
					'foreignKey' => 'category_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			));
			*/
	
			
	
	var $validate = array(	  					
		'category_name' => array(
				'rule' => VALID_NOT_EMPTY,
				'message' => 'Please provide Category Name.'
		),
		'description' => array(
				'rule' => VALID_NOT_EMPTY,
				'message' => 'Please provide Description.'
		)							
	);
}
?>