<?php

class SiteDetail extends AppModel
{
var $name='SiteDetail';
var $useTable="site_details";

var $validate = array(		
	  			'company_name' => array(
        				'rule' => VALID_NOT_EMPTY,
	    				'message' => 'Please provide Comapny Name.'
    			),
				'notification_email' => array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Please provide Notification Email.'
				),
				'address1' => array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Please provide Address.'
				),
				'country' => array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Please select Country.'
				),
				'state' => array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Please select State.'
				),
				'zipcode' => array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Please provide zipcode.'
				),
				'city' => array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Please provide City.'
				)
		     );	
}
?>