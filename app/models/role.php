<?php
/**
 * Role
 * PHP version 5
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author   Vidur
 */
class Role extends AppModel {
/**
 * Model name
 *
 * @var string
 * @access public
 */
    public $name = 'Role';
/**
 * Behaviors used by the Model
 *
 * @var array
 * @access public
 */
   
/**
 * Validation
 *
 * @var array
 * @access public
 */
    public $validate = array(
        'title' => array(
            'rule' => array('minLength', 1),
            'message' => 'Title cannot be empty.',
        )
       
    );

   

	


}
?>