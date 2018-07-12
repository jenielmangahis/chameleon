<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class AppController extends Controller {

function session_check(){
		$USER   = $this->Session->read('User');
		if(empty($USER)){
			$this->redirect('/users/index');
		
		}
	}	

	function session_check_admin()
	{
	   $ADMIN   = $this->Session->read('Admin');
	   if(empty($ADMIN))
		{
		  $this->redirect('/admins/login');
 		}
	}
	function userTypeDropDown()
	{
       App::import("Model", "Usertype");
       $this->Usertype  =    &new Usertype();
   	   $UsertypeDropDown  =  $this->Usertype->find("all",array('fields'=>array("DISTINCT Usertype.usertype","Usertype.id"),'order'=>'Usertype.Usertype ASC')); 
       $UsertypeDropDown = Set::combine($UsertypeDropDown, '{n}.Usertype.id', '{n}.Usertype.usertype');
	   $this->set("Usertype", $UsertypeDropDown);
	 
    }
	function countryDropDown()
	{
      App::import("Model", "Country");
      $this->Country   =  &new Country();
   	  $countryDropDown =  $this->Country->find("all",array('fields'=>array("DISTINCT Country.country_name","Country.id"),'order'=>'Country.country_name ASC'));  //echo $countryDropDown; //exit;
      $countryDropDown = Set::combine($countryDropDown, '{n}.Country.id', '{n}.Country.country_name');
	  $this->set("countryDropDown", $countryDropDown);
	 //$this->State->
      }

}
?>