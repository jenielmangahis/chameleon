<?php
    /* SVN FILE: $Id$ */
    /**
    * Short description for file.
    *
    * In this file, you set up routes to your controllers and their actions.
    * Routes are very important mechanism that allows you to freely connect
    * different urls to chosen controllers and their actions (functions).
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
    * @subpackage    cake.app.config
    * @since         CakePHP(tm) v 0.2.9
    * @version       $Revision$
    * @modifiedby    $LastChangedBy$
    * @lastmodified  $Date$
    * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
    */
    /**
    * Here, we are connecting '/' (base path) to controller called 'Pages',
    * its action called 'display', and we pass a param to select the view file
    * to use (in this case, /app/views/pages/home.ctp)...
    */

    
    Router::connect('/', array('controller' => 'companies', 'action' =>  'index'));
	Router::connect('/players/companytype/company', array('controller' => 'players', 'action' =>  'types','company'));
	
	Router::connect('players/emailtask', array('controller' => 'players', 'action' =>  'tasklist'));
	Router::connect('/players/types/companies', array('controller' => 'players', 'action' =>  'types','company'));
		Router::connect('prospects/list', array('controller' => 'prospects', 'action' =>  'projectmerchant'));
	Router::connect('/relationships', array('controller' => 'contacts', 'action' =>  'sa_companylist'));
	
	Router::connect('/offers/current', array('controller' => 'offers', 'action' =>  'offerlist','secondlevel'));

     $current_domain = $_SERVER['HTTP_HOST'];
    
    //if($current_domain == 'www.gocitiescms.com' || $current_domain == 'gocitiescms.com' )
   // {
        //echo "I am here";die;
        $request_url=$_SERVER['REQUEST_URI'];
        $temp = $request_url;
        //$temp = '/abc/contact.html';
        preg_match('/^(.*)\/(.*)/', $temp, $matches);
        $index1=$matches[0];
        $url_array=explode("/",$index1);
		//print_r($url_array); die;
        $temp1 =$url_array[1];

        mysql_connect('localhost','root','');
        mysql_select_db('gocities_cckiller');
		
        $rs = mysql_query("select project_name from projects where system_name='".$temp1."'");
        $count = mysql_num_rows($rs);
		
		 Router::connect('contacts/memberlist', array('controller' => 'admins', 'action' =>  'memberlist'));
		
        if($temp1=="comments"){
            //echo "i am here..".$temp1;
            Router::connect('/'.$temp1, array('controller' => 'companies', 'action' =>  'comments'));
        }
        else if($temp1=="signup"){
                //echo "i am here..".$temp1;
                Router::connect('/'.$temp1, array('controller' => 'companies', 'action' =>  'signup'));
            }
            else  if($temp1=="login"){
                    //echo "i am here..".$temp1;
                    Router::connect('/'.$temp1, array('controller' => 'companies', 'action' =>  'index'));
                } 
                else if($temp1=="register"){
                    //echo "i am here..".$temp1;
                    Router::connect('/'.$temp1, array('controller' => 'companies', 'action' =>  'index'));
                }
                else  if($temp1=="admins"){
                        //echo "i am here..".$temp1;
                        Router::connect('/'.$temp1, array('controller' => 'admins', 'action' =>  ''));
						
                    }
                    else if($count==0)
                        {
                            //echo "i am here..".$temp1;
                            Router::connect('/'.$temp1, array('controller' => 'companies', 'action' =>  'pages',$temp1 ));
                        }
                        else{
                            Router::connect('/(?i)'.$temp1, array('controller' => 'companies', 'action' => 'index'));
						}
  //  }
 /*   
    else
    {
        //echo "I am here in else";die;
        $request_url=$_SERVER['REQUEST_URI'];
        $temp = $request_url;
        //$temp = '/abc/contact.html';
        preg_match('/^(.*)\/(.*)/', $temp, $matches);
        //print_r($matches);
        //echo "test";
        Router::connect('/'.$matches[2], array('controller' => 'companies', 'action' =>  'pages',$matches[2] ));

    }
 */   
    
    /**
    * ...and connect the rest of 'Pages' controller's urls.
    */
    //Router::connect('/*', array('controller' => 'companies', 'action' => 'index'));
    Router::connect('/(?i)testproject', array('controller' => 'companies', 'action' => 'index'));
    
    if($count>=1)
    {
       //echo "select route_content from routes where project_name='".$temp1."'";
	   $query = mysql_query("select route_content from routes where project_name='".$temp1."'");               //get route content of perticular project from DB
       $rs=mysql_fetch_assoc($query);
       echo $rs['route_content'];
       
    }  

?>
