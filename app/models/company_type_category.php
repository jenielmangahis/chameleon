<?php
class CompanyTypeCategory extends AppModel{

	var $name	= 'CompanyTypeCategory'; 
	var $useTable	= 'company_type_categories';// table name
 	var $validate = array(
		'company_type_category_name' => array(
			'rule' => VALID_NOT_EMPTY,
			'message' => 'Please provide Company Type Category.'
		)								
    );
}
?>