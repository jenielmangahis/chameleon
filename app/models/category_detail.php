<?php
class CategoryDetail extends AppModel{

	var $name		= 'CategoryDetail'; 
	var $useTable	= 'category_details';
	 
	var $validate = array(	  					
		'category_id' => array(
				'rule' => array('checkCategoryName', 'category_name_text'),
				'message' => 'Please provide Category Name.'
		),
		'sub_category_id' => array(
					'rule' => array('checkSubCategoryName', 'sub_category_name_text'),
					'message' => 'Please provide Sub Category Name.'
		),
		'description' => array(
				'rule' => VALID_NOT_EMPTY,
				'message' => 'Please provide Description.'
		)
	/*	,
		'square_graphic' => array(
            'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Invalid file'
        ),
		'wide_graphic' => array(
            'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Invalid file'
        ),
		'tall_graphic' => array(
            'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Invalid file'
        )*/
	);
	
	 function checkCategoryName( $field=array(), $compare_field=null ) 
    { 
    	$flag = TRUE;
    	$v1 = $field['category_id'];
    	$v2 = $this->data['Category']['category_name_text'];
    	if(trim($v1)=='' && trim($v2) == ''){
    		$flag = FALSE;
    	}
    	return $flag;
    }
    
    function checkSubCategoryName( $field=array(), $compare_field=null )
    {
    	$flag = TRUE;
    	$v1 = $field['sub_category_id'];
    	$v2 = $this->data['Category']['sub_category_name_text'];
    	if(trim($v1)=='' && trim($v2) == ''){
    		$flag = FALSE;
    	}
    	return $flag;
    }
}
?>