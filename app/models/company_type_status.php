<?php
class CompanyTypeStatus extends AppModel{

	var $name	= 'CompanyTypeStatus'; 
	var $useTable	= 'company_type_status';// table name
 	var $validate = array(
		'company_type_status_name' => array(
			'rule' => VALID_NOT_EMPTY,
			'message' => 'Please provide Company Type Status.'
		)								
	);
}
?>