<?php
    /*
    Purpose: User model class
    #
    Model class names are singular.
    #
    Model class names are Capitalized for single-word models, and UpperCamelCased for multi-word models.
    Examples: Person, Monkey, GlassDoor, LineItem, ReallyNiftyThing
    #
    Model filenames use a lower-case underscored syntax.
    Examples: person.php, monkey.php, glass_door.php, line_item.php, really_nifty_thing.php
    #

    #     Model name: Set var $name in your model definition.


    Model-related database tables: Set var $useTable in your model definition.

    */

    class ProjectShoppingCart extends AppModel{

        var $name	= 'ProjectShoppingCart'; 
        var $useTable	= 'project_shopping_carts';// table name
        var $useDbConfig = 'default'; 


        /**
        * Function to create new shopping cart for project, if already exists shooping cart then enabled the cart 
        * 
        * @param mixed $cartData
        */
        function createShoppingCart($projectID,$cartData,$installData ){        
            //  echo "<pre>";   print_r($installData); echo "<pre/>";  
            //   echo "<pre>"; print_r($cartData); echo "<pre/>";  
            // echo "<pre>"; print_r($useDbConfig); echo "<pre/>";  
            $db =& ConnectionManager::getInstance();
            
			/*
			$dbhost = "localhost"; //$db->config->default['host'];
            $dbuser ="jaxboys_ocar124"; // $db->config->default['login'];
            $dbpass = "ycSrwj577P"; //$db->config->default['password']; 
			*/
			
			$dbhost = Configure::read('Cart.dbhost');
			$dbuser = Configure::read('Cart.dbuser');
			$dbpass = Configure::read('Cart.dbpass');
            
            //  echo " DB == > ".$dbhost." ".$dbuser." ".$dbpass;  
            // exit;  
            if($projectID && $cartData && $installData) {
                // STEP : Check already exists shopping cart for a given project
                $isCart=$this->isExistsShoppingCartForProject($projectID,$cartData['shop_name']);
                if($isCart == 0){
                    // STEP : IF NOT EXISTIS - Create New Shopping Cart For project 
                    $installationURL=$installData['InstallURL'];
                    $openCart_HTTP=$installData['HTTP'];
                    $openCart_DIR=$installData['DIR'];
                    $shopfronurl=$openCart_HTTP.$cartData['shop_name']."/index.php";
                    $shopadminurl=$openCart_HTTP.$cartData['shop_name']."/admin/index.php"; 

                    if($installationURL!="" && $openCart_HTTP!="" && $openCart_DIR!=""){
                        // STEP: Call CURL to auto install the OPenCart Setup
                        $ch = curl_init();
                        $data = array(  'pname'        =>  $cartData['shop_name'],
                        'admin'        =>  $cartData['shop_adminuser'],
                        'adminpass'    =>  $cartData['shop_adminpassword'],
                        'adminemail'   =>  $cartData['shop_adminemail'],
                        'db_host'      =>  $dbhost, 
                        'db_name'      =>  $cartData['shop_dbname'],
                        'db_user'      =>  $dbuser,
                        'db_pass'      =>  $dbpass,
                        'cart_http'    => $openCart_HTTP,
                        'cart_dir'     =>  $openCart_DIR
                        );  

                        curl_setopt($ch, CURLOPT_URL, $installationURL);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_exec($ch);  
                    }
                    // STEP : Add New Shopping Cart Details into Database 
                    $data['ProjectShoppingCart']['project_id']=$projectID; 
                    $data['ProjectShoppingCart']['shop_dbname']=$cartData['shop_dbname'];
                    $data['ProjectShoppingCart']['shop_name']=$cartData['shop_name'];
                    $data['ProjectShoppingCart']['shop_fronturl']=$shopfronurl;
                    $data['ProjectShoppingCart']['shop_adminurl']=$shopadminurl;
                    $data['ProjectShoppingCart']['shop_adminuser']=$cartData['shop_adminuser'];
                    $data['ProjectShoppingCart']['shop_adminpassword']=$cartData['shop_adminpassword'];
                    $data['ProjectShoppingCart']['shop_adminemail']=$cartData['shop_adminemail'];
                    $this->save($data['ProjectShoppingCart']);
                    $newCartID= $this->getLastInsertID();
                    
                    //STEP : ADD SHopping Cart Pages to project 
                    $this->addProjectShoppingCartPages($projectID);
                    
                    return $newCartID;

                }else if($isCart > 0){
                        // STEP : IF EXISTIS - Update Existing Shopping Cart active status on into Database  
                        $this->enableProjectShoppingCart($isCart, $projectID);
                        
                        return $isCart;
                    }else{
                        // STEP : There is some error
                        return false;     
                }

            }else{
                return false;
            }
        }

        /**
        * check wether project shopping cart already exists
        * 
        * @param mixed $projectID
        * @param mixed $shopName
        * @return mixed
        */
        function isExistsShoppingCartForProject($projectID, $shopName=''){ 
            if($projectID) {

                if($shopName!=''){
                    $conditions = array("ProjectShoppingCart.shop_name" => $shopName,"ProjectShoppingCart.project_id"=>$projectID,"ProjectShoppingCart.delete_status"=>"0");
                }else{
                    $conditions = array("ProjectShoppingCart.project_id"=>$projectID,"ProjectShoppingCart.delete_status"=>"0"); 
                }

                $getCartDetail  =  $this->find("first", array('conditions' => $conditions)); 
                if($getCartDetail){
                    return $getCartDetail['ProjectShoppingCart']['id'];             
                }else{
                    return 0;
                }

            }else{
                return false;
            }  

        }

       

        /**
        * Enable project shopping cart    
        *     
        * @param mixed $cartID
        * @param mixed $projectID
        */
        function enableProjectShoppingCart($cartID,$projectID){
          	 $isCart='1';
			$data['ProjectShoppingCart']['id']=$isCart;
            $data['ProjectShoppingCart']['active_status']='1';
            $chk=$this->save($data['ProjectShoppingCart']);
            if($chk){
                $this->enableProjectShoppingCartPages($projectID);  
                return true;
            }else{
                return false;
            }
        }

        /**
        * Disable project shopping cart 
        * 
        * @param mixed $cartID
        * @param mixed $projectID
        */
        function disableProjectShoppingCart($projectID, $cartID=''){
            if($cartID==''){
                 $isCart=$this->isExistsShoppingCartForProject($projectID);
                 if($isCart > 0){
                    $cartID  =$isCart;
                 }else{
                     return false;
                 }
            }
            
            $data['ProjectShoppingCart']['id']=$cartID;
            $data['ProjectShoppingCart']['active_status']='0';
            $chk=$this->save($data['ProjectShoppingCart']);
            if($chk){
                $this->disableProjectShoppingCartPages($projectID); 
                return true;
            }else{
                 return false;
            }
            
        }



        function addProjectShoppingCartPages($projectID){
            ##import Content  model for processing
            App::import("Model", "Content");
            $this->Content =   & new Content();
            /**
            * Shopping Cart Enhancement - Add ‘Add Item’ as parent page. Add ‘Shopping Cart’ & ‘Check Out’ as child page at WebPages for each project.
            */                          
            $this->data['Content']['id'] = "";
            $this->data['Content']['project_id'] = $projectID;
            $this->data['Content']['file_sequence'] = '10';
            $this->data['Content']['title'] = 'Shopping Cart';
            $this->data['Content']['metatitle'] = 'Shopping Cart';
            $this->data['Content']['alias'] = 'shopping-cart';
            $this->data['Content']['internal_alias'] = 'shopping-cart';
            $this->data['Content']['is_sytem'] = '1';
            $this->data['Content']['active_status'] = '0';
            $this->data['Content']['content'] =' ' ;
            $additemchk=$this->Content->Save($this->data['Content']);
            unset($this->data['Content']);
          /*  if($additemchk){ // Add child ‘Shopping Cart’ & ‘Check Out’ page to ‘Add Item’ menus 
                $additemid = $this->Content->getLastInsertId();
                $this->data['Content']['id'] = "";
                $this->data['Content']['project_id'] = $projectID;
                $this->data['Content']['parent_id'] = $additemid;
                $this->data['Content']['file_sequence'] = '0';
                $this->data['Content']['title'] = 'Shopping Cart';
                $this->data['Content']['metatitle'] = 'Shopping Cart';
                $this->data['Content']['alias'] = 'shopping-cart';
                $this->data['Content']['internal_alias'] = 'shopping-cart';
                $this->data['Content']['is_sytem'] = '1';
                $this->data['Content']['active_status'] = '0';
                $this->data['Content']['content'] =' ' ;
                $cartchk=$this->Content->Save($this->data['Content']);
                unset($this->data['Content']);

                //add ‘Check Out’ page as child 
                $this->data['Content']['id'] = "";
                $this->data['Content']['project_id'] = $projectID;
                $this->data['Content']['parent_id'] = $additemid;
                $this->data['Content']['file_sequence'] = '1';
                $this->data['Content']['title'] = 'Check Out';
                $this->data['Content']['metatitle'] = 'Check Out';
                $this->data['Content']['alias'] = 'checkout';
                $this->data['Content']['internal_alias'] = 'checkout';
                $this->data['Content']['is_sytem'] = '1';
                $this->data['Content']['active_status'] = '0';
                $this->data['Content']['content'] =' ' ;
                $checkoutchk=$this->Content->Save($this->data['Content']);
                unset($this->data['Content']);
            }     */
        }

        function enableProjectShoppingCartPages($projectID){
             ##import Content  model for processing
             App::import("Model", "Content");
             $this->Content =   & new Content();
             
             $query1="UPDATE `contents` AS `Content`  SET `Content`.`active_status` = '0', `Content`.`delete_status` = '0'   
              WHERE `Content`.`alias` = 'checkout' AND `Content`.`project_id` = '".$projectID."'";
             $this->Content->query($query1);
           
             $query2="UPDATE `contents` AS `Content`  SET `Content`.`active_status` = '0', `Content`.`delete_status` = '0'   
              WHERE `Content`.`alias` = 'shopping-cart' AND `Content`.`project_id` = '".$projectID."'";
             $this->Content->query($query2);
             
             $query3="UPDATE `contents` AS `Content`  SET `Content`.`active_status` = '0', `Content`.`delete_status` = '0'   
              WHERE `Content`.`alias` = 'add-to-cart' AND `Content`.`project_id` = '".$projectID."'";
             $this->Content->query($query3);
        }

        function disableProjectShoppingCartPages($projectID){
                             ##import Content  model for processing
             App::import("Model", "Content");
             $this->Content =   & new Content();
             
             $query1="UPDATE `contents` AS `Content`  SET `Content`.`active_status` = '0', `Content`.`delete_status` = '1'   
              WHERE `Content`.`alias` = 'checkout' AND `Content`.`project_id` = '".$projectID."'";
             $this->Content->query($query1);
           
             $query2="UPDATE `contents` AS `Content`  SET `Content`.`active_status` = '0', `Content`.`delete_status` = '1'   
              WHERE `Content`.`alias` = 'shopping-cart' AND `Content`.`project_id` = '".$projectID."'";
             $this->Content->query($query2);
             
             $query3="UPDATE `contents` AS `Content`  SET `Content`.`active_status` = '0', `Content`.`delete_status` = '1'   
              WHERE `Content`.`alias` = 'add-to-cart' AND `Content`.`project_id` = '".$projectID."'";
             $this->Content->query($query3);
             
           
            /* $this->Content->updateAll(
             array('Content.active_status' => "'0'",'Content.delete_status' => "'1'"),     
             array('Content.alias =' => "add-to-cart", 'Content.project_id ' => $projectID)); */
        }
        
         function getShoppingCartByProject($projectID){
            if($projectID) {
                $cartConditions = array("ProjectShoppingCart.project_id"=>$projectID,"ProjectShoppingCart.delete_status"=>"0"); 
                $getCartDetail  =  $this->find("first", array('conditions' => $cartConditions)); 
                if($getCartDetail){
                    return $getCartDetail;             
                }else{
                    return false;
                }

            }else{
                return false;
            }
        }

    }
?>