<?php 
class Admin extends AppModel
{
   // INITIATING TABLE IN DATABASE
	  var $name='Admin';

const ADMIN_EMAIL ='vidur@dotsquares.com' ;

// LOGIN FORM - SERVER SIDE VALIDATION 


 
var $validate = array(
	  
	  					'username' => array(
        								'rule' => VALID_NOT_EMPTY
	    								//'message' => 'Username is required'
    										),
    					'password' => array(
        								'rule' => VALID_NOT_EMPTY
	    								//'message' => 'Password is required'
    										),
    					'Opassword' => array(
        								'rule' => VALID_NOT_EMPTY
	    								//'message' => 'Old Password is required'
    										),
    					'Cpassword' => array(
        								'rule' => VALID_NOT_EMPTY
	    								//'message' => 'Please Confirm Password'
    										)										
					   );
					   

}
?>