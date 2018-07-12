<?php
	 /* Project		   :-  Image coin website
    * Controller Name :-  setups_contoller.php
    * Created  On     :-  20-04-12             
    */
	class SetupsController extends AppController 
    {
		 var $name = 'Setups';
       //var $uses = 'Setup';
        var $layout = 'new_admin_layout';
        var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
        var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
        var $uses = array('Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term');

        function pagenotavailable(){
            $this->layout = "";
        }

        function beforeFilter() {
				 /*permission code start*/	
			 if($this->Session->check("UserLoginDetails"))
			 {
			  	$admin =  $this->Session->read("UserLoginDetails");
				$permissions = array();
				$subpermissions = array();
				if(!empty($admin))
				{
					//if($admin['Admin']['username']!='admin')
					//{
            			$permissions 	= $this->check_user_permissions($admin['Admin']['user_type'],'yes');
						$subpermissions = $this->check_user_permissions($admin['Admin']['user_type'],'no');
					//}
				}
				if(!empty($permissions))
				{
					$this->set('hideMenuPermission',$permissions);	
				}
				if(!empty($subpermissions))
				{
					$this->set('hideSubMenuPermission',$subpermissions);
					$this->set('c_name',$this->params['controller']);
					$this->set('f_name',$this->params['action']);
				}
			}
			/*permission code end*/
			
            $projectid = $this->Session->Read('sessionprojectid');
            if($projectid) {
                App::import("Model", "Project");
                $this->Project =   & new Project();
                $fields=array('project_name','url');
                $data=$this->Project->find("first",array("fields"=>$fields,"conditions"=>array("Project.id"=>$projectid)));
                $this->Session->write("projectwebsite_name_admin",$data['Project']['project_name']);
                $this->set('data',$data);
                if(!empty($data['Project']['url'])){
                    $redirect=$data['Project']['url'];
                    $this->set('redirect',"http://".$redirect); 
                }
                else{

                    $current_domain= $_SERVER['HTTP_HOST'];    
                    $redirect="http://".$current_domain.'/'.$data['Project']['project_name'];
                    $this->set('redirect',$redirect);     
                }
            }
        }

		/* ----------------------------------------BEG OF CHANGE PASSWORD INFO ------------------------------------------------ */ 
        /*
        * Function name   : changePassword()
        * Description : This function used to update password
        * Created On      : 20-04-2012
        */ 
        function super_admin_changepassword()
        {
            ##check admin session live or not
            $this->session_check_admin();
            ##import admin model for processing
            App::import("Model", "Admin");
            $this->Admin =   & new Admin();
             $passwd=md5($this->data['Admin']['password']);
            $adminSess = $this->Session->read("Admin");
			$this->Admin->id = $adminSess['Admin']['id']; //$_SESSION['Admin']['id'];          
            if(!empty($this->data)) 
            { 
                if($this->Admin->saveField('password',$passwd))
                {
                    $this->Session->setFlash('Password changed Successfully. Please login with new password.','default', array('class' => 'successmsg'));
                    //$this->logout();
					$this->redirect(array("controller"=>"admins" , "action"=>"logout"));
					//$this->redirect("/admins/logout/");

                }
                else
                {
                    $this->Session->setFlash('There is problem while changing password.','default');
                } 
            }
            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '65'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition


        }//End super adnmin change password controller
        /* ----------------------------------------  END OF CHANGE PASSWORD INFO ------------------------------------------------ */ 

			 /*    
        *     function    : ajaxpwdcheck($pwd)
        *     params      : $pwd :this contain the password entered the admin.
        *     Description : This function checks whether the password  entered by user already exists in database or not.
        *     Created On   : 20-04-2012
        */

        function ajaxpwdcheck($pwd)
        {
			App::import("Model", "Admin");
		    $this->Admin =  & new Admin();
			$this->layout=false;
            $pass = md5($pwd);
			echo $count = $this->Admin->findCount("password ='$pass'") ;
	        $this->set('paswd', $count);    
            if($count == 1)            {
				//$this->Session->setFlash('Admin Password is Matched','default',array('class' => 'successmsg'));

            }
			exit;
        }//end ajaxpwdcheck controller
	/**
		* function    : getstarted()
        * params      : None.
        * Created On   : 20-04-2012
		*
	**/
	function getstarted(){
		
		App::import('Model','GetStart');
		$this->GetStart = new GetStart();
		$dt=$this->GetStart->find("all");
		$this->set("value",$dt);
		if((!empty($this->data/*['GetStart']['getdata']))&&isset($this->data)*/)))
		{    
			$errormsg = $this->GetStart->invalidFields();
			//$errormsg="Please provide Get Started Name";
			$this->Session->setFlash($errormsg,'default',array('class' => 'msgTXt'));
			//print_r($errormsg);die;
			if(!$errormsg){
				$this->data['GetStart']['id']=1;
				if($this->GetStart->save($this->data))
				{
					$this->Session->setFlash('Get Started Updated successfully.','default', array('class' => 'successmsg'));
					if(isset($this->data['Action']['redirectpage'])){
						$this->redirect(array('controller'=>'setups' , 'action'=>'getstarted'));
					}else
					{
						$this->redirect(array('controller'=>'setups' , 'action'=>'getstarted'));
					}
				} 
				else
				{
					$this->Session->setFlash("Please provide Get Started",'default',array('class' => 'msgTXt'));
				}
			}    
         } 
			# set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '67'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end getStart controller
		/**
		* function    : help_list
        * params      : None.
        * Created On  : 20-04-2012
		* Description : function show list of all help 	
		**/
		 function help_list()
        {
            if(isset($_SERVER['QUERY_STRING']))
            {
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);    

            }
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();          
            $field='';
            $condition = "";
            if(isset($this->data['setups']['searchkey']) && $this->data['setups']['searchkey']){
                $searchkeyword = $this->data['setups']['searchkey'];
                $condition .= "   (name LIKE '%".$searchkeyword."%' OR content  LIKE '%".$searchkeyword."%' OR section  LIKE '%".$searchkeyword."%' )";
            }                
            $this->Pagination->sortByClass  = 'HelpContent'; ##initaite pagination            
            $this->Pagination->total= count($this->HelpContent->find('all',array("conditions"=>$condition)));
            list($order,$limit,$page) = $this->Pagination->init($condition,$field);                
            $hlpdata1 = $this->HelpContent->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));             
            $this->set("hlpdata1",$hlpdata1);


            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '66'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end Help_List Controller
		/**
		* function    : edithelp
        * params      : helpid.
        * Created On  : 20-04-2012
		* Description : function show edit of specific help 	
		**/
		function edithelp($recid){
            $this->session_check_admin();
            ##import project type model for processing
            App::import("Model", "HelpContent");
            $this->HelpContent =   & new HelpContent();
            ##check empty data
            if(!empty($this->data)) {
                #set the posted data
                $this->HelpContent->set($this->data);
                #check server side validation
                $this->HelpContent->invalidFields();
                #save data in project type table
                $recid  = $this->data['HelpContent']['id'];
                if($recid !=''){                                                
                    if($this->HelpContent->Save($this->data)){
                        $this->Session->setFlash('Database updated successfully.','default',array('class' => 'successmsg'));
                        if(isset($this->data['Action']['redirectpage'])){

                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                        }else
                        {
                            $this->redirect("/admins/help_list");
                        }                                        

                    }
                }
            }
            $this->HelpContent->id = $recid;
            $this->data = $this->HelpContent->read();
            $this->set("HelpContent", $recid);
        }//end edithelp controller function  
		/**
		* function    : mail_footer
		*Links		  : SPAM Footer	
        * params      : None.
        * Created On  : 21-04-2012
		**/
		function mail_footer(){
          
            App::import('Model','MailFooter');
            $this->MailFooter = new MailFooter();
            $dt=$this->MailFooter->find("first");
            
            $footer_content=$dt['MailFooter']['footer_content'];
            $this->set("footer_content",$footer_content);
            
            if(!empty($this->data))
            {    
                
                $errormsg = $this->MailFooter->invalidFields();
                //$errormsg="Please provide Get Started Name";
                $this->Session->setFlash($errormsg,'default',array('class' => 'msgTXt'));
                //print_r($errormsg);die;
                if(!$errormsg){
                    $this->data['MailFooter']['id']=1;
                    if($this->MailFooter->save($this->data))
                    {
                        $this->Session->setFlash('Mail Footer Updated successfully.','default', array('class' => 'successmsg'));
                        if(isset($this->data['Action']['redirectpage'])){
                            $this->redirect('/setups/mail_footer');
                        }else
                        {
                            $this->redirect('/setups/mail_footer');
                        }
                    } 
                    else
                    {
                        $this->Session->setFlash("Please provide Mail Footer",'default',array('class' => 'msgTXt'));
                    }
                }    
            } 

            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '67'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        } //End mail footer function

		/**
		* function    : border_footer_list
		*Links		  : Border Footer	
        * params      : None.
        * Created On  : 21-04-2012
		**/
		function border_footer_list(){

            ##check admin session live or not
            $this->session_check_admin();
            
			##import project type model for processing
            App::import("Model", "BorderFooter");
            $this->BorderFooter =   & new BorderFooter();
			$condition = 'delete_status=0';
			$field='';
            if(isset($this->data['BorderFooter']['searchkey']) && $this->data['BorderFooter']['searchkey']){
                $searchkeyword = $this->data['BorderFooter']['searchkey'];
                $condition .= "  BorderFooter.border_footer_name LIKE '%".$searchkeyword."%' OR BorderFooter.border_footer_name  LIKE '%".$searchkeyword."%' ";
            }

            $this->Pagination->sortByClass    = 'BorderFooter'; ##initaite pagination 

            $this->Pagination->total= count($this->BorderFooter->find('all',array("conditions"=>$condition)));

            list($order,$limit,$page) = $this->Pagination->init($condition,$field);

            $border_footer_list = $this->BorderFooter->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            ##set project type data in variable
         
            $this->set("border_footer_list",$border_footer_list);  	
            
        }  //End border footer list function
		
		/**
		* function    : border_footer
		*Links		  : Border Footer save	
        * params      : None.
        * Created On  : 22-04-2012
		**/
		function border_footer($id=null) {

			##check admin session live or not
            $this->session_check_admin();
			
			##import project type model for processing
            App::import("Model", "BorderFooter");
            $this->BorderFooter =   & new BorderFooter();
			//pr($this->StatusType);
			##check empty data
            if(!empty($this->data)) {
			
				//$this->BorderFooter->create();
				if($this->BorderFooter->save($this->data)) {
					$id = $this->BorderFooter->id;
					if($this->data['BorderFooter']['is_default'] == 1) {
						$this->BorderFooter->updateAll(array('BorderFooter.is_default'=> 1,'BorderFooter.active_status'=> 1), array('BorderFooter.id' => $id));
						$this->BorderFooter->updateAll(array('BorderFooter.is_default'=> 0), array('BorderFooter.id !=' => $id));
					}
					if(isset($this->data['Action']['redirectpage'])){
						$msg='Border footer Added Successfully.';
						$this->Session->setFlash($msg,'default', array('class' => 'successmsg'));
					   $this->redirect(array('controller' =>'setups', 'action' =>'border_footer_list'));
					}
					else if(isset($this->data['Action']['noredirection'])){				
						$msg='Border footer saved Successfully.';
						$this->Session->setFlash($msg,'default', array('class' => 'successmsg'));
						$this->redirect(array("controller"=>"setups" , "action"=>"border_footer",$id)); 			
					}
				} else
				{
					$this->validateErrors();
				}
			}
			
			if (empty($this->data)) {
            $this->data = $this->BorderFooter->read(null, $id);
			}
			
		} 
		
		//End border footer function
		
				
		/*
        * Function name   : changestatus()
        * Arguments : $recid,$modelname,$status,$methodname
        * Description : This function used to change status as active or deactive
        * Implemented On      : 27-04-12 (03:45am)
        *
        */ 
        function changestatus($recid=null,$status=null,$modalname=null,$redircturl=null,$action='cngstatus',$othermodel='',$otherid='',$param=''){

		if($status==2)
			$status =0;
		$this->session_check_admin();
		App::import("Model", $modalname);
		$this->$modalname =   & new $modalname();
		$allcompanyid=str_replace('*', ',',$recid);
		$cidArr = explode(',',$allcompanyid);
		$allid=str_replace('*', ' or id = ',$recid);
		$where="id=$allid";
			if(count(explode('*',$recid))==1){
				$this->data["$modelname"]['id'] = $recid;
			}
			$res = Set::enum('yes', array('no' => 0, 'yes' => 1));
 
			if($action =='delete'){
				$i=$this->$modalname->updateAll(array('delete_status'=>"'".$res."'"),$where);
				}
			else{
				$i=$this->$modalname->updateAll(array('active_status'=>"'".$status."'"),$where);
				}

			if($i){
				$this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));
			}
		$this->redirect(array('controller'=>'setups','action'=>$redircturl));
	}//end changestatus function

		
		function border_footer_delete($recid=null){
            ##check user session live or not
            $this->session_check_admin();
			
            ##import dynamic model for processing
            App::import("Model", 'BorderFooter');
            $this->BorderFooter =   & new BorderFooter(); 
			//print_r($recid);
			$allid=str_replace('*', ' or id = ',$recid);
            $where="id=$allid";  
            if(count(explode('*',$recid))==1){
                $this->data['BorderFooter']['id'] = $recid;
            }
			$ww = explode('*',$recid);
			//print_r($ww);
			$id_data=$this->BorderFooter->find('first',array('conditions'=>array('BorderFooter.is_default'=>1),'fields'=>array('id')));
			
			if(isset($id_data['BorderFooter']['id']) && $id_data['BorderFooter']['id'] != '' && in_array($id_data['BorderFooter']['id'],$ww)) {
				//print_r($id_data);
				$this->Session->setFlash('You cannot delete Border Footer default Status.','default', array('class' => 'successmsg'));
				$this->redirect(array('controller'=>'setups','action'=>'border_footer_list'));
			}

            ##set the record for updation
            
            $this->BorderFooter->updateAll(array('delete_status'=>1),$where);
            $this->Session->setFlash('Border footer deleted successfully.','default', array('class' => 'successmsg'));

            $this->redirect(array('controller'=>'setups','action'=>'border_footer_list	'));
        }
		
		/*
        * Function name   : producttype()
        * Description : This function used to add product type
        * data        : 25-Apr-2012 			
        */  
        function producttype(){

            ##check admin session live or not
            $this->session_check_admin();

            ##fetch data from project type table for listing
            $field='';
            $condition = "delete_status = '0'";
            if(isset($this->data['setups']['searchkey']) && $this->data['setups']['searchkey']){
                $searchkeyword = $this->data['setups']['searchkey'];
                $condition .= "  and (product_type_name LIKE '%".$searchkeyword."%' OR notes  LIKE '%".$searchkeyword."%' )";
            }

            $this->Pagination->sortByClass    = 'ProductType'; ##initaite pagination 

            $this->Pagination->total= count($this->ProductType->find('all',array("conditions"=>$condition)));

            list($order,$limit,$page) = $this->Pagination->init($condition,$field);

            $producttypedata = $this->ProductType->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            ##set project type data in variable

            $this->set("producttypedata",$producttypedata);    
        }   //end producttype
		/*
        * Function name   : producttype()
        * Description : This function used to add product type
        * data        : 25-Apr-2012 			
        */  
		 function editproducttype($recid = null){
            //Configure::write('debug', 2);
            ##check admin session live or not
            $this->session_check_admin();


            ##check empty data
            if(!empty($this->data)) {
				#set the posted data
                $this->ProductType->set($this->data);
                #check server side validation
                $this->ProductType->invalidFields();
                #save data in project type table
                $recid  = $this->data['ProductType']['id'];
                $ptname  = $this->data['ProductType']['product_type_name'];
                $condition = "product_type_name = '".$ptname."' AND id !=$recid AND  delete_status = '0'";
                $ptdata = $this->ProductType->find('all',array("conditions"=>$condition));
                if(!$ptdata){
                    if($recid !=''){

                        if($this->ProductType->Save($this->data)){

                            $this->Session->setFlash('Product Type updated Successfully.','default', array('class' => 'successmsg'));

                        }else{
                            $this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'errormsg'));

                        }
                    }else{
                        $this->Session->setFlash('Invalid attempt for update.','default',array('class' => 'errormsg'));
                    }
                }else{

                    $this->Session->setFlash('Product Type with same name already exists.','default',array('class' => 'errormsg'));
                }
                if(isset($this->data['Action']['redirectpage'])){
                   
					$this->redirect(array("controller"=>"setups" , "action"=>"producttype")); 
				}
                else
				{
					//$recid = $this->ProductType->id;
					$recid = $this->data['ProductType']['id'];
					$this->redirect(array("controller"=> "setups" , "action" => "editproducttype",$recid));
					//$this->redirect('setups/editproducttype/'.$recid);

				}
            }
            $this->ProductType->id = $recid;
            $this->data = $this->ProductType->read();
            $this->set("ProductTypeId", $recid);
        }//end editproducttype    

		/*
        * Function name   : producttype()
        * Description : This function used to add product type
        * data        : 25-Apr-2012 			
        */  
	
		function addproducttype(){

            ##check admin session live or not
            $this->session_check_admin();

            ##check empty data
            if(!empty($this->data)) {
                #set the posted data
                $this->ProductType->set($this->data);
                #check server side validation
                $this->ProductType->invalidFields();

                $err="";

                if($this->data['ProductType']['product_type_name']=="" || $this->data['ProductType']['product_type_name']==NULL )
                {
                    $err.="Product type name is empty.<br>";
                }

                if($this->data['ProductType']['size_mm']=="" || $this->data['ProductType']['size_mm']==NULL )
                {
                    $err.="Product type size(mm) is empty.<br>";
                }
                if($this->data['ProductType']['size_inch']=="" || $this->data['ProductType']['size_inch']==NULL )
                {
                    $err.="Product type size(inch) is empty.<br>";
                }
                if($this->data['ProductType']['delivery_days']=="" || $this->data['ProductType']['delivery_days']==NULL )
                {
                    $err.="Product type delivery_days is empty.<br>";
                }

                if($err=="")
                {

                    $ptname = $this->data['ProductType']['product_type_name'];

                    $condition = "product_type_name = '".$ptname."'    AND  delete_status = '0'";
                    $ptdata = $this->ProductType->find('all',array("conditions"=>$condition));

                    if(!$ptdata)
                    {
                        #save data in project type table
                        $this->ProductType->Save($this->data);

                        $this->Session->setFlash('Product Type added Successfully.','default', array('class' => 'successmsg'));
                        if(isset($this->data['Action']['redirectpage']))
                            $this->redirect(array("controller"=>"setups" , "action"=>"producttype")); 
                        else
                           $this->redirect(array("controller"=>"setups" , "action"=>"addproducttype")); 

                    }
                    else
                    {
                        $this->Session->setFlash('Product Type with same name already exists.','default',array('class' => 'msgTXt'));
                        $this->redirect('/admins/addproducttype/');
                    }



                }
                else
                {
                    $this->Session->setFlash($err,'default',array('class' => 'errormsg'));
                }
            }

        } //end addproducttype
		
		
		function setAsDefault($recid=null){

            ##check user session live or not
            $this->session_check_admin();

            ##import dynamic model for processing
            App::import("Model", 'BorderFooter');
            $this->BorderFooter =   & new BorderFooter();       
            ##set the record for updation
            $this->BorderFooter->updateAll(array('BorderFooter.is_default'=> 1,'BorderFooter.active_status'=> 1), array('BorderFooter.id' => $recid));
            $this->BorderFooter->updateAll(array('BorderFooter.is_default'=> 0), array('BorderFooter.id !=' => $recid));
			
            $this->Session->setFlash('Default Status updated successfully.','default', array('class' => 'successmsg'));

            $this->redirect(array('controller'=>'setups','action'=>'border_footer_list'));
        }
        
        
        function settings(){
        	##check user session live or not
        	$this->session_check_admin();
        	$admin_id =  $_SESSION['Admin']['Admin']['id'];
        	$this->layout= 'new_admin_layout';
        	
        	//for active menu display
        	$project_id = '1';
        	$this->set('projectid',$project_id);
        	//for active menu display
        	$this->set('page_url','edit_project_detail');
        
        	App::import("Model", "Project");
        	$this->Project =   & new Project();
        	
        	App::import("Model", "Admin");
        	$this->Admin =   & new Admin();
        	
        	App::import("Model", "User");
        	$user =   & new User();
        	
        	$this->countrydroupdown();
        	$this->statedroupdown();
        	
        	  
        	# set help condition
        	$this->set("hlpdata",$this->getHelpContent('53'));
        	# set help condition
        
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	
        	$userid = $this->Session->read("User.User.id");
        	
        	##check empty data
        	if(!empty($this->data)) {
        
        		#set the posted data
				//$this->pl($this->data);
        		$this->Project->set($this->data);
        		#check server side validation
        		$errormsg = $this->Project->invalidFields();
        		if(!$errormsg){
        			
        			$this->Project->id = $project_id;
        			$this->data['Project']['id'] = $project_id;
				//	$this->pl($this->data);

        			if($this->Project->Save($this->data)){
        				
        				if(!empty($this->data['Admin']['username']) || (!empty($this->data['Admin']['npassword']) && !empty($this->data['Admin']['cpassword']) && ($this->data['Admin']['npassword'] == $this->data['Admin']['cpassword']))){
        					
        					if(empty($this->data['Admin']['username'])){
        						unset($this->data['Admin']['username']);
        					}
        					if(empty($this->data['Admin']['npassword']) || empty($this->data['Admin']['cpassword'] )){
        						unset($this->data['Admin']['npassword']);
        						unset($this->data['Admin']['cpassword']);
        					}else{
        						$this->data['Admin']['password'] = MD5($this->data['Admin']['npassword']);
        					}
        					$this->Admin->id =$admin_id;
        					$this->Admin->Save($this->data);
        				}
        				$this->Session->setFlash('Setting has been modified.','default', array('class' => 'successmsg'));
        				if(isset($this->data['Action']['redirectpage'])){
        					$this->redirect('settings');
        				}else{
        					$this->redirect('settings');
        				}
        			}else{
        				$this->Session->setFlash("Error in Processing",'default',array('class' => 'msgTXt'));
        				$this->redirect('settings');
        			}
        			
        		}else{
	        		$this->Session->setFlash("Please enter required field.",'default',array('class' => 'msgTXt'));
	        		$this->redirect('settings');
        		}
        	}
        
        	//for theme details
        	$this->Admin->id =$admin_id;
        	$admin = $this->Admin->read();
        	
        	$this->Project->id = $project_id;
        	$project  = $this->Project->read();
        	
        	$this->data = array_merge($project, $admin);
        	
        	$this->set('sellocation',$this->data['Project']['locations'] );
        	$this->set('selectedcountry',$this->data['Project']['country'] );
        	$this->set('selectedstate', $this->data['Project']['state']);
        	$this->set('project_id',$this->data['Project']['id']);
        	$this->set('is_wordpress_page',$this->data['Project']['is_wordpress_page']);
        	
        }
        
        
        
        function iframes(){

        	##import ProjectGraphic  model for processing
        	$projectid = $this->Session->read("sessionprojectid");
        	$this->set("projectid",$projectid);
        	$prodtl = $this->getprojectdetails($projectid);
        	$projectname = $prodtl[0]['Project']['project_name'];
        	$this->set("projectname",$projectname);
        	$this->set('current_project_name',$projectname);     // used in project_name element file
        	App::import("Model", "ProjectGraphic");
        	$this->ProjectGraphic =   & new ProjectGraphic();
        	#set the posted data
        	##check empty data
        	if(!empty($this->data)) {
        		##Show Option Page Graphic:
        		$conditions = "ProjectGraphic.project_id = '".$projectid."' AND  ProjectGraphic.delete_status = '0'";
        		$proj_grap_arr =  $this->ProjectGraphic->find("all",array('conditions'=>$conditions));
        		if(count($proj_grap_arr) > 0)
        		{
        			$this->ProjectGraphic->deleteAll($conditions, $cascade = true);
        		}

        		// For linkedin
        		if((isset($this->data['Admins']['imagenameold_link']['name']) && $this->data['Admins']['imagenameold_link']['name'] !='') || (isset($this->data['ProjectGraphic']['image_link']) && $this->data['ProjectGraphic']['image_link'] !='' && $this->data['Admins']['activestatus_link']==1)){
        			if(isset($this->data['Admins']['imagenameold_link']['name']) && $this->data['Admins']['imagenameold_link']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_link']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_link']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_link'];
        			}

        			$this->data1['ProjectGraphic']['project_id'] = $projectid;
        			$this->data1['ProjectGraphic']['title'] = $this->data['Admins']['title_link'];
        			$this->data1['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data1['ProjectGraphic']['address'] = $this->data['Admins']['address_link'];

        			if(isset($this->data['Admins']['activestatus_link']) && $this->data['Admins']['activestatus_link']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;

        			$this->ProjectGraphic->Save($this->data1['ProjectGraphic']);
        			$this->Session->setFlash('Social network added successfully.','default', array('class' => 'successmsg'));




        		}
        		// For Facebook
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();
        		if((isset($this->data['Admins']['imagenameold_face']['name']) && $this->data['Admins']['imagenameold_face']['name'] !='') || (isset($this->data['ProjectGraphic']['image_face']) && $this->data['ProjectGraphic']['image_face'] !='' && $this->data['Admins']['activestatus_face']==1)){
        			if(isset($this->data['Admins']['imagenameold_face']['name']) && $this->data['Admins']['imagenameold_face']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_face']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_face']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_face'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_face'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_face'];

        			if(isset($this->data['Admins']['activestatus_face']) && $this->data['Admins']['activestatus_face']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;

        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}
        		// For Twitter
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();
        		if((isset($this->data['Admins']['imagenameold_twit']['name']) && $this->data['Admins']['imagenameold_twit']['name'] !='') || (isset($this->data['ProjectGraphic']['image_twit']) && $this->data['ProjectGraphic']['image_twit'] !='' && $this->data['Admins']['activestatus_twit']==1)){
        			if(isset($this->data['Admins']['imagenameold_twit']['name']) && $this->data['Admins']['imagenameold_twit']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_twit']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_twit']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_twit'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_twit'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_twit'];

        			if(isset($this->data['Admins']['activestatus_twit']) && $this->data['Admins']['activestatus_twit']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;

        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}
        		//For Donation
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don']['name']) && $this->data['Admins']['imagenameold_don']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don']) && $this->data['ProjectGraphic']['image_don'] !='' && $this->data['Admins']['activestatus_don']==1)){
        			if(isset($this->data['Admins']['imagenameold_don']['name']) && $this->data['Admins']['imagenameold_don']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don'];

        			if(isset($this->data['Admins']['activestatus_don']) && $this->data['Admins']['activestatus_don']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;


        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}

        		//For Donation1
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don1']['name']) && $this->data['Admins']['imagenameold_don1']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don1']) && $this->data['ProjectGraphic']['image_don1'] !='' && $this->data['Admins']['activestatus_don1']==1)){
        			if(isset($this->data['Admins']['imagenameold_don1']['name']) && $this->data['Admins']['imagenameold_don1']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don1']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don1']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don1'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don1'];

        			if(isset($this->data['Admins']['activestatus_don1']) && $this->data['Admins']['activestatus_don1']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;


        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}
        		//For Donation2
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don2']['name']) && $this->data['Admins']['imagenameold_don2']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don2']) && $this->data['ProjectGraphic']['image_don2'] !='' && $this->data['Admins']['activestatus_don2']==1)){
        			if(isset($this->data['Admins']['imagenameold_don2']['name']) && $this->data['Admins']['imagenameold_don2']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don2']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don2']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don2'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don2'];

        			if(isset($this->data['Admins']['activestatus_don2']) && $this->data['Admins']['activestatus_don2']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;


        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}
        		//For Donation3
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don3']['name']) && $this->data['Admins']['imagenameold_don3']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don3']) && $this->data['ProjectGraphic']['image_don3'] !='' && $this->data['Admins']['activestatus_don3']==1)){
        			if(isset($this->data['Admins']['imagenameold_don3']['name']) && $this->data['Admins']['imagenameold_don3']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don3']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don3']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don3'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don3'];

        			if(isset($this->data['Admins']['activestatus_don3']) && $this->data['Admins']['activestatus_don3']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;
        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}

        		//For Donation3
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don4']['name']) && $this->data['Admins']['imagenameold_don4']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don4']) && $this->data['ProjectGraphic']['image_don4'] !='' && $this->data['Admins']['activestatus_don4']==1)){
        			if(isset($this->data['Admins']['imagenameold_don4']['name']) && $this->data['Admins']['imagenameold_don4']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don4']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don4']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don4'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don4'];

        			if(isset($this->data['Admins']['activestatus_don4']) && $this->data['Admins']['activestatus_don4']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;
        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}

        		//For Donation4
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don5']['name']) && $this->data['Admins']['imagenameold_don5']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don5']) && $this->data['ProjectGraphic']['image_don5'] !='' && $this->data['Admins']['activestatus_don4']==1)){
        			if(isset($this->data['Admins']['imagenameold_don5']['name']) && $this->data['Admins']['imagenameold_don5']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don5']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don5']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don5'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don5'];

        			if(isset($this->data['Admins']['activestatus_don5']) && $this->data['Admins']['activestatus_don5']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;
        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}

        		//For Donation5
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don6']['name']) && $this->data['Admins']['imagenameold_don6']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don6']) && $this->data['ProjectGraphic']['image_don6'] !='' && $this->data['Admins']['activestatus_don4']==1)){
        			if(isset($this->data['Admins']['imagenameold_don6']['name']) && $this->data['Admins']['imagenameold_don6']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don6']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don6']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don6'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don6'];

        			if(isset($this->data['Admins']['activestatus_don6']) && $this->data['Admins']['activestatus_don6']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;
        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}
        		//For Donation6
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don7']['name']) && $this->data['Admins']['imagenameold_don7']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don7']) && $this->data['ProjectGraphic']['image_don7'] !='' && $this->data['Admins']['activestatus_don4']==1)){
        			if(isset($this->data['Admins']['imagenameold_don7']['name']) && $this->data['Admins']['imagenameold_don7']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don7']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don7']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don7'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don7'];

        			if(isset($this->data['Admins']['activestatus_don7']) && $this->data['Admins']['activestatus_don7']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;
        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}
        		//For Donation7
        		unset($this->ProjectGraphic);
        		App::import('Model','ProjectGraphic');
        		$this->ProjectGraphic = new ProjectGraphic();

        		if((isset($this->data['Admins']['imagenameold_don8']['name']) && $this->data['Admins']['imagenameold_don8']['name'] !='') || (isset($this->data['ProjectGraphic']['image_don8']) && $this->data['ProjectGraphic']['image_don8'] !='' && $this->data['Admins']['activestatus_don4']==1)){
        			if(isset($this->data['Admins']['imagenameold_don8']['name']) && $this->data['Admins']['imagenameold_don8']['name'] !='') {
        				$filePath =  'img' . DS . $projectname . DS.'uploads' ;
        				$this->File->setDestPath($filePath);

        				$file_name1 = $this->File->setFileName($this->data['Admins']['imagenameold_don8']['name']);
        				$tmp1 = $this->data['Admins']['imagenameold_don8']['tmp_name'];
        				$fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'33x33');
        			} else {
        				$fileNamesidea = $this->data['ProjectGraphic']['image_don'];
        			}

        			$this->data['ProjectGraphic']['project_id'] = $projectid;
        			$this->data['ProjectGraphic']['title'] = $this->data['Admins']['title_don8'];
        			$this->data['ProjectGraphic']['imagename'] = $fileNamesidea;
        			$this->data['ProjectGraphic']['address'] = $this->data['Admins']['address_don8'];

        			if(isset($this->data['Admins']['activestatus_don8']) && $this->data['Admins']['activestatus_don8']==1)
        				$this->data1['ProjectGraphic']['active_status'] = 1;
        			else
        				$this->data1['ProjectGraphic']['active_status'] = 0;
        			$this->ProjectGraphic->Save($this->data['ProjectGraphic']);
        		}

        	}
        	$conditiongra = "ProjectGraphic.project_id='$projectid' AND  ProjectGraphic.delete_status='0'";
        	//$conditiongra = "ProjectGrap$socialiconshic.project_id='$projectid' AND  ProjectGraphic.delete_status='0'";
        	$graphicarr = $this->ProjectGraphic->find('all',array("conditions"=>$conditiongra,'order'=>'ProjectGraphic.id ASC'));
        	$this->set('graphiclist',$graphicarr);


        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '52'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition


        	App::import("Model", "Event");
        	$this->Event =   & new Event();

        	$condition = "Event.project_id = '$projectid' and Event.active_status='1' and Event.delete_status='0'";

        	$event_data= $this->Event->find('all',array("conditions"=>$condition,'fields'=>array('Event.id','Event.title')));

        	$event_titles ="";
        	foreach($event_data as $eachrow)
        	{
        		$event_titles[$eachrow['Event']['id']]=$eachrow['Event']['title'];
        	}
        	$this->set("event_titles",$event_titles);
        }
        
        function  change_password(){

        	##check user session live or not
        	$this->session_check_admin();

        	$this->layout= 'new_admin_layout';

        	//for active menu display
        	$this->set('page_url','forgot_password');
        	$project_id = 1;
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	 
        	# set help condition
        	$this->set("hlpdata",$this->getHelpContent('18'));

        	if(!empty($this->data)) {

        		App::import("Model", "Admin");
        		$this->Admin =   & new Admin();

        		$old_pass = md5(trim($this->data['Setups']['oldpassword']));
        		$condition = " id = ".$_SESSION['Admin']['Admin']['id']." ";
        		$userArray = $this->Admin->find('first',array('conditions' => $condition ));
        		$this->set('userArray',$userArray);
				
        		if($this->data['Setups']['reset_password'])             //if reset password is checked
        		{
        			$condition = " id = ".$_SESSION['Admin']['Admin']['id']." ";
        			$userArray = $this->Admin->find('first',array('conditions' => $condition ));

        			$new_password = rand(10000, 99999);
        			$this->data['Admin']['id']=$userArray['Admin']['id'];
        			$this->data['Admin']['password']=md5($new_password);

        			##import EmailTemplate  model for processing
        			App::import("Model", "EmailTemplate");
        			$this->EmailTemplate =   & new EmailTemplate();

        			if(!empty($projectDetails['Project']['url']))
        				$homepagepath=str_replace('http://', '', $projectDetails['Project']['url']);
        			else
        				$homepagepath=HTTP_PATH.'/'.$projectDetails['Project']['project_name'];

        			$condition = " EmailTemplate.email_template_name= 'RESET PASSWORD' and  EmailTemplate.is_sytem='1' and EmailTemplate.active_status='1' and EmailTemplate.delete_status='0' ";
        			$mailMessage = $this->EmailTemplate->find('first',array('conditions' => $condition));
        			//print_r($mailMessage);exit;
        			if(is_array($mailMessage) && !empty($mailMessage))
        			{
        				/**
        				 * OLD CODE
        				 * if(!empty($projectDetails['Project']['system_name']))
        				 	$pt_new_name=$projectDetails['Project']['system_name'];
        				 else
        				 	$pt_new_name=$projectDetails['Project']['project_name'];
        				 $keyStringArray = array('[[EMAIL_ADDRESS]]'=>$sponsorArray['Sponsor']['sponsor_name'],
        				 '[[USER_NAME]]'=>$userArray['User']['username'],
        				 '[[USER_PASSWORD]]'=>$new_password,
        				 '[[PROJECT_NAME]]'=>$pt_new_name,
        				 '[[PROJECT_HOMEPAGE_URL]]'=>$homepagepath);
        				 *  if(!empty($keyStringArray)){
        				 foreach($keyStringArray as $key=>$val){
        					$mailBody = str_replace($key,$val,$mailBody);
        					}
        				}
        			*/
        				$subject  = $mailMessage['EmailTemplate']['subject'];
        				$from = $mailMessage['EmailTemplate']['sender'];      //$projectDetails['Project']['fromemail'];
        				$fromname = $mailMessage['EmailTemplate']['sender'];      //$projectDetails['Project']['fromname'];
        				$to = $sponsorArray['Sponsor']['email'];
        				$mailBody=$mailMessage['EmailTemplate']['content'];
        				/** As Per discussion 12-29-2011  - Remove Mail Footer from live untile add 'Opt Out' button   **/
        				///////////////////////////////// append mail footer set by super admin /////////////////////////
        				$condition = "id='1'";
        				$mailfooter_data = $this->MailFooter->find('first',array('conditions' => $condition));
        				$mailfooter=$mailfooter_data['MailFooter']['footer_content'];
        				$mailBody.=$mailfooter;
        				///////////////////////////////// append mail footer set by super admin /////////////////////////

        				// Set path to inserted image
        				$mailBody = $this->replaceImgPathInEmailContent($mailBody);


        				/**
        				 * New Email Temp replacement code for data Elements
        				*/
        				//STEP: INIT EMAIL TEMPLATES DATA ELEMENTS
        				$dataEleValuesArray=$this->EmailTemplates->initEmailTemplDataElemntsArray($project_id, $projectDetails, $to);
        				//STEP : SET VALUES TO REQUIRED DATA ELEMENTS
        				$dataEleValuesArray[DATA_ELEMENT_USER_NAME]= $userArray['Admin']['username'];
        				$dataEleValuesArray[DATA_ELEMENT_USER_PASSWORD]= $new_password;
        				$this->EmailTemplates->setEmailTempDataElementValuesArray($dataEleValuesArray);

        				//STEP : INSERT VALUES AT DATA ELEMETNS FOR EMAIL SUBJECT AND EMAIL MESSAGE
        				$subject=$this->EmailTemplates->insertDataElementValuesToContent($subject);
        				$mailBody=$this->EmailTemplates->insertDataElementValuesToContent($mailBody);

        				$result = $this->Sendemail->sendMailContentWithCC($to,$from,$subject,$mailBody,$fromname, $mailMessage['EmailTemplate']['send_cc_email_to']);
        			}
        			if($result)
        			{
        				$this->Admin->save($this->data);
        				$this->Session->setFlash("Password has been send to email id.",'default',array('class' => 'successmsg'));
        			}
        			else
        			{
        				$this->Session->setFlash("Error in Processing",'default',array('class' => 'msgTXt'));
        			}

        			if(isset($this->data['Action']['redirectpage'])){
        				$this->redirect('/setups/change_password');
        			}else{
        				$this->redirect('/setups/change_password');
        			}
        		}

        		$errorString ='';

        		if(trim($this->data['Setups']['oldpassword']) == ''){
        			$errorString .="Please insert old password.<br/>";
        		}

        		if(md5(trim($this->data['Setups']['oldpassword'])) != $userArray['Admin']['password']){
        			$errorString .="Please insert correct old password.<br/>";
        		}

        		if(trim($this->data['Setups']['password']) == ''){
        			$errorString .="Password must have atleast 6 character.<br/>";
        		}


        		if(trim($this->data['Setups']['password']) != '' || trim($this->data['Setups']['confirm_password']) != ''){
        			if(trim($this->data['Setups']['password']) != trim($this->data['Setups']['confirm_password'])){
        				$errorString .="Password & confirm password must be same<br/>";
        			}else{
        				if(strlen($this->data['Setups']['password']) < 3 ){
        					$errorString .="Password must have atleast 6 character.";
        				}else{
        					$password =$this->data['Setups']['password'];
        					$this->data['Setups']['password'] = md5($password);
        				}
        			}
        		}else{
        			$this->data['Setups']['password'] = $userArray['Admin']['password'] ;
        		}

        		if(trim($errorString) !=''){
        			$this->Session->setFlash($errorString,'default',array('class' => 'msgTXt'));
        		}else{
        			$this->data['Admin']['id']=$userArray['Admin']['id'];
        			$this->data['Admin']['password']=$this->data['Setups']['password'];

        			$this->Admin->save($this->data);

        			$this->data['Setups']['oldpassword']="";
        			$this->data['Setups']['password']="";
        			$this->data['Setups']['confirm_password']="";
					$this->Session->setFlash("Password has been changed.",'default',array('class' => 'successmsg'));
        			if(isset($this->data['Action']['redirectpage'])){
        				$this->redirect('/setups/change_password');
        			}else{
        				$this->redirect('/setups/change_password');
        			}

        		}

        	}else{
        		$userArray = array();
        		$this->data = $userArray;
        	}
        }
        
        
        
        function locationlist(){
        	
        	##check admin session live or not
        	$this->session_check_admin();
        	
        	App::import("Model", "Location");
        	$this->Location =   & new Location();
        	
        	##fetch data from project type table for listing
        	$field='';
        	$condition = "delete_status = '0'";
			if(isset($this->data['setups']['searchkey']) && $this->data['setups']['searchkey']){
        		 $searchkeyword = $this->data['setups']['searchkey'];
        		$condition .= "  and (location_name LIKE '%".$searchkeyword."%' )";
            }
        	
			$this->Pagination->sortByClass    = 'Location'; ##initaite pagination
        	$this->Pagination->total= count($this->Location->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        	$locations = $this->Location->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        	##set project type data in variable
        	$this->set("locations",$locations);
        }
        
        
        function addlocation($recid='0'){
        	
        	##check user session live or not
        	$this->session_check_admin();
        	$admin_id =  $_SESSION['Admin']['Admin']['id'];
        	$this->layout= 'new_admin_layout';
        	 
        	//for active menu display
        	$project_id = '1';
        	$this->set('projectid',$project_id);
        	//for active menu display
        	$this->set('page_url','addlocation');
        	
        	App::import("Model", "Location");
        	$this->Location =   & new Location();
        	 
        	
        	$this->countrydroupdown();
        	$this->statedroupdown();
        	 
        	 
        	# set help condition
        	$this->set("hlpdata",$this->getHelpContent('53'));
			# set help condition
        	
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	 
        	$userid = $this->Session->read("User.User.id");
        	 
        	##check empty data
        	if(!empty($this->data)) {
        	
        	#set the posted data
        	$this->Location->set($this->data);
        	
        	#check server side validation
        	$errormsg = $this->Location->invalidFields();
        	if(!$errormsg){
        		 
        		$this->Location->id = $this->data['Location']['id'];
        	
        		if($this->Location->Save($this->data)){
	
        			if($this->data['Location']['id']){
        				$this->Session->setFlash('Location has been modified.','default', array('class' => 'successmsg'));
        			}else{
        				$this->Session->setFlash('Location has been added.','default', array('class' => 'successmsg'));
        			}
        				if(isset($this->data['Action']['redirectpage'])){
        					$this->redirect('locationlist');
        				}else{
        				$this->redirect('locationlist');
        				}
        				}else{
        				$this->Session->setFlash("Error in Processing",'default',array('class' => 'msgTXt'));
        				$this->redirect('locationlist');
        				}
      
        		}else{
        	        				$this->Session->setFlash("Please enter required field.",'default',array('class' => 'msgTXt'));
        					$this->redirect('locationlist');
        				}
        				}
        	
        				//for theme details
        				$this->set('selectedstate','' );
        				$this->set('selectedcountry','' );
        	if($recid){
        			$this->Location->id =$recid;
        			$this->data = $this->Location->read();
        			$this->set('selectedcountry',$this->data['Location']['country'] );
        	       	$this->set('selectedstate', $this->data['Location']['state']);
        	}
        	
        }
        
        
        function backup(){
        	

        	$this->session_check_admin();
        	##project id for each project
        	$project_id = '1';
        	//for active menu display
        	$this->set('page_url','backup');
        	$userArray = array();
        	
        	//    if(empty($project_name)) $this->redirect('/companies/session_expired');
        	
        	# set help condition
        	$this->set("hlpdata",$this->getHelpContent('18'));
        	# set help condition

        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	
        	$filename='';
        	$filepath =  'backup';
        	if(!empty($this->data)) {
        		if(isset($this->data['Setup']['generate'])){
        			//pr($this->data); die("in generate pr");
        			$errorString ='';
        			ini_set('max_execution_time', 7200);
        			ini_set('memory_limit','300M');
        	
        			//$filename=$this->Backup->getProjectBackup($project_id, $project_name);
        			$filename=$this->Backup->getDatabaseBackUP($filepath, $project_id);
        			//pr($this->data); die;
        			if($filename){
        				//   $filename=$this->Backup->getDatabaseBackUP($filepath, $project_id);
        				$this->Session->setFlash("Backup generated successfully!.",'default',array('class' => 'successmsg'));
        			}else{
        				$this->Session->setFlash("Opps! There seems to some problem. Please try later.",'default',array('class' => 'errormsg'));
        			}
        		}
        	
        		if(isset($this->data['Setup']['download'])){
        			$filename= $this->data['Setup']['filename'];
        			$filepath =  'backup/'.$filename.".zip" ;
        			$this->ForceDownload->forceDownload($filepath, 'ProjectBackup.zip');
        			$this->Session->setFlash("Backup downloaded successfully!.",'default',array('class' => 'successmsg'));
        			$this->redirect('/setups/projectbackup');
        		}
        	}else{
        		$this->data = $userArray;
        	}
        	
        	$this->set('filepath',$filepath);
        	$this->set('filename',$filename);
        }
		
		function coinsetlist(){
            
			$this->session_check_admin();
			
            $project_id = '1';
            //$project_name=$this->Session->read("projectwebsite_name_admin");  
            //$this->set('current_project_name',$project_name);
            if(isset($_SERVER['QUERY_STRING']))
            {
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);    

            }
            $this->set('page_url',"coinsetlist");
            $projectDetails=$this->getprojectdetails($project_id);
            $project_name=$projectDetails['Project']['project_name'];                // 
            $this->set("hlpdata",$this->getHelpContent('43'));
			$this->set('project_name',$project_name);
            $projectDetails = $this->getprojectdetails($project_id);    
            $this->set('project',$projectDetails);            
            ##fetch data from Coinset table for listing
            App::import("Model", "Coinset");
            $this->Coinset =   & new Coinset();
            ##checking search key

            if(isset($this->data['Setup']['searchkey']) && $this->data['Setup']['searchkey']){
                $searchkeyword = $this->data['Setup']['searchkey'];
                 $condition = "Coinset.project_id = '$project_id' AND Coinset.delete_status='0' and Coinset.coinset_name LIKE '%".$searchkeyword."%' OR Coinset.verifycode LIKE '%".$searchkeyword."%' OR Coinset.numunits LIKE '%".$searchkeyword."%' OR Coinset.startserialnum LIKE '%".$searchkeyword."%' OR Coinset.endserialnum LIKE '%".$searchkeyword."%'";

            }else{
               $condition = "Coinset.project_id = '$project_id' AND Coinset.delete_status='0'";
            }        

            $field='';

            $this->Pagination->sortByClass    = 'Coinset'; ##initaite pagination 

            $this->Pagination->total= count($this->Coinset->find('all',array("conditions"=>$condition)));
            list($order,$limit,$page) = $this->Pagination->init($condition,$field);
            $coinsetdtlarr = $this->Coinset->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
	          ##set Coinset data in variable
           $this->set("coinsetdetail",$coinsetdtlarr);
        }
		
		function addcoinset($coinsetid=''){

             $this->session_check_admin();
	         $projectid = '1';
			 $this->set('page_url',"coinsetlist");
             ##import EmailTemplate  model for processing
             App::import("Model", "Coinset");
             $this->Coinset =   & new Coinset();    
            //STEP: Set curretn url
            $current_url= $_SERVER['HTTP_HOST'];
            $this->set('current_url',$current_url);
            //STEP:  get previous artwork details
            $pre_artwork = $this->Coinset->query("select * from coinsets where project_id=$projectid order by id desc limit 1");
			if(!empty($pre_artwork)){
				$has_pre_artwork=count($pre_artwork);
				$this->set("has_pre_artwork",$has_pre_artwork);
				$sidea_image=$pre_artwork['0']['coinsets']['sidea'];
				$sideb_image=$pre_artwork['0']['coinsets']['sideb'];
				$edge_image=$pre_artwork['0']['coinsets']['edge'];

				$this->set("sidea_image",$sidea_image);
				$this->set("sideb_image",$sideb_image);
				$this->set("edge_image",$edge_image);
			}
			$this->set("hlpdata",$this->getHelpContent('44'));
            $projectDetails = $this->getprojectdetails($projectid);
            $project_name = $projectDetails['Project']['project_name'];
            $this->set('project',$projectDetails);    
            $this->set('project_name',$projectDetails['Project']['project_name']);
            $consetdata = $this->Coinset->find('first',array('fields' => array('MAX(Coinset.id) as max_id'),'conditions'=>array("delete_status = '0' AND  project_id  ='".$projectid."'")));

			 $sid=$consetdata['0']['max_id'];
            $singlearr = array("0","1","2","3","4","5","6","7","8","9");
			if(!empty($sid)){
	            $condition1 = "project_id = '".$projectid."'  AND id=$sid";
			}else{
				$condition1 = "project_id = '".$projectid."'";
			}
			$consetdata1 = $this->Coinset->find('all',array("conditions"=>$condition1));
			if(!empty($consetdata1)){
			$totcount = $consetdata1['0']['Coinset']['coinset_name'];
		    if(preg_match('/[A-Z]{3}/', $totcount)==1){
                $coinsname= preg_split('/[A-Z]{3}/', $totcount);
                $totcount=$coinsname[1];
            }
            $nexval = ($totcount+1);
            if(in_array($nexval,$singlearr)){
                $newcoinsetname ='0'.$nexval;
            }else{
                $newcoinsetname = $nexval;
			}
			$this->set('coinsetname',$newcoinsetname);
			   $this->set('totalreccount',$totcount);
		}
            
            $condition2 = "Project.id = '".$projectid."'";
            $project_type = $this->Project->find('first',array("conditions"=>$condition2));		
            $selectedprojecttype=$project_type['Project']['project_type_id'];
            $this->set('selectedprojecttype',$selectedprojecttype);
            ##check submit
			if(empty($newcoinsetname)){
				$newcoinsetname='01';
			}
            if(!empty($this->data)){

				$this->data['Coinset']['coinset_name']=$newcoinsetname;        
                $this->Coinset->set($this->data);
                #check server side validation
                $errormsg = $this->Coinset->invalidFields();
			   if(!is_numeric(trim($this->data['Coinset']['verifycode']))&& ($this->data['Coinset']['verifycode'] != ''))
                {
                    $errormsg="Verification Code should be numeric.";                
                    $this->Session->setFlash($errormsg,'default',array('class' => 'msgTXt'));
                }

                if($this->data['Coinset']['verifycode'] != '')
                {    
                    $verifycode = $this->Coinset->find('first',array("conditions"=>"Coinset.verifycode='".$this->data['Coinset']['verifycode']."' and Coinset.project_id='".$projectid."' and Coinset.delete_status='0'"));

                    if(is_array($verifycode) and !empty($verifycode))

                    {
						$errormsg="Verification Code is already used."; 
                        $this->Session->setFlash($errormsg,'default',array('class' => 'msgTXt'));
					}
                }
                if(!$errormsg){
                    // $this->session_check_admin();
                    //$projectid = $this->Session->read("sessionprojectid");
                    $this->data['Coinset']['project_id'] = $projectid;
                    $this->File = & new FileComponent;
					
                     $filePath =  'img' . DS . 'cckiller'. DS.'upload' ;
					
					
                    $this->File->setDestPath($filePath);

                    $ch=$this->data['Coinset'];
                    $checked_pricing=array();
					if(isset($this->data['Coinset']['use_pre_artwork'])==1)        //if previous artwork selected
                    {
                        $this->data['Coinset']['sidea'] =$sidea_image;
                        $this->data['Coinset']['sideb'] =$sideb_image;
                        $this->data['Coinset']['edge'] =$edge_image;
                    }
                    else    //if no previous artwork selected
                    {
                        if($this->data['Coinset']['coinsidea']['name'] !=''){
                            $file_name1 = $this->File->setFileName($this->data['Coinset']['coinsidea']['name']); 
                            $tmp1 = $this->data['Coinset']['coinsidea']['tmp_name'];
                            $fileNamesidea = $this->File->uploadcoin($file_name1,$tmp1,true);
                            $this->data['Coinset']['sidea'] =$fileNamesidea;
                        }
                        if($this->data['Coinset']['coinsideb']['name'] !=''){
                            $file_name2 = $this->File->setFileName($this->data['Coinset']['coinsideb']['name']); 
                            $tmp2 = $this->data['Coinset']['coinsideb']['tmp_name'];
                            $file_namesideb = $this->File->uploadcoin($file_name2,$tmp2,true);
                            $this->data['Coinset']['sideb'] =$file_namesideb;
                        }
                        if($this->data['Coinset']['coinedge']['name'] !=''){
                            $file_name4 = $this->File->setFileName($this->data['Coinset']['coinedge']['name']); 
                            $tmp4 = $this->data['Coinset']['coinedge']['tmp_name'];
                            $file_nameedge = $this->File->uploadlogo($file_name4,$tmp4,true,'300x12');
                            $this->data['Coinset']['edge'] =$file_nameedge;
                        }
                    }
					if(!empty($this->data['Coinset']['datesubmitchipco'])){
	                    $data = explode("-", $this->data['Coinset']['datesubmitchipco']);
						$date = new DateTime();
			            $date->setDate($data['2'], $data['0'], $data['1']);
						$this->data['Coinset']['datesubmitchipco']= $date->format("Y-m-d");
					}
                    
                    if($this->Coinset->Save($this->data['Coinset'])){
						//$this->pl($this->data['Coinset']);
						//$lastId = $this->Coinset->getLastInsertId();
                        $this->Session->setFlash('Coinset added successfully.','default', array('class' => 'successmsg'));
                        if(isset($this->data['Action']['redirectpage'])){
                            $sessdata=$this->Session->read('newsortingby');
							$this->redirect(array('controller'=>'setups','action'=>'coinsetlist'));
                        }else{
                            $this->redirect(array('controller'=>'setups','action'=>'addcoinset'));
                        }
                    }else{
                        $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));                  
						}
                }

                $prodectarr = $this->projectdetailbyid($projectid);
                $serialprefix = $prodectarr[0]['Project']['serialprefix'];$pref=$serialprefix."01";
                $state = $this->Coinset->find('count',array("conditions"=>"Coinset.coinset_name='$pref' and Coinset.project_id='".$projectid."' and Coinset.delete_status='0'"));
                if($state>0){$state="new";}
                $this->set('state',$state);
                $projectdtltype = $prodectarr[0]['Project']['project_type_id'];
                if($this->data['Coinset']['ship_type_id']){
                    $this->set("selectedshippingtype",$this->data['Coinset']['ship_type_id']);
                }else{
                    $this->set("selectedshippingtype","");
                }
                if(isset($this->data['Company']['project_type_id']) || $projectdtltype){
                    if($projectdtltype){
                        $projectdtltype = $projectdtltype;    
                    }else{
                        $projectdtltype = $this->data['Company']['project_type_id'];
                    }
                    $this->set("selectedprojecttype",$projectdtltype);
                }else{
                    $this->set("selectedprojecttype","");
					}
                $this->shippingtypedropdown();
                $this->projecttypedropdown();
                //======================================================//

                //======================================================//
                $condition = "project_id = '".$projectid."' AND  delete_status = '0' ";
                ##check already exists company name
                //$consetdata = $this->Coinset->find('all',array("conditions"=>$condition));
                $this->set('coinsetname',$newcoinsetname);
                $this->set('serialpre',$serialprefix);
            }
            ##start serial numbering

            $consetdata1 = $this->Coinset->find('first',array('fields' => array('MAX(Coinset.endserialnum) as max_ser'),'conditions'=>array("delete_status = '0' AND  project_id  ='".$projectid."'")));
			$sid=$consetdata1['0']['max_ser'];          
            if($consetdata1){
                $lastserno = ($consetdata1[0]['max_ser']+1);
                $strlength = strlen($lastserno);
                $looplen = (7 -  $strlength);
                $finalres="";
                for($i=0; $i < $looplen; $i++){
                    $finalres = "0".$finalres;
                }
                $lastserial = $finalres.$lastserno;
                //echo $lastserial;
            }else{
                $lastserial = "0000001";
				}
            $this->set('lastserno',$lastserial);
			if($coinsetid!=''){
                // To edit coinset - get coinset details by $coinsetid
                $coinsetData = $this->Coinset->find('first',array('conditions'=>array("delete_status = '0' AND  id  ='".$coinsetid."'")));
                $this->set('',$lastserial);
            }
        }
		function projectdetailbyid($projectid=''){

            App::import("Model", "Project");
            $this->Project =   & new Project();    

            $this->Project->bindModel(array('belongsTo'=>array(
            'Sponsor'=>array(
            'foreignKey'=>false,
            'conditions'=>'Sponsor.id = Project.sponsor_id'
            )
            )));

            $condition = "Project.id = '".$projectid."'";
            $ptdata = $this->Project->find('all',array("conditions"=>$condition));

            if($ptdata){
                return $ptdata;
            }else{
                return false;
            }
        }    
		/*
        * Function name   : editcoinset()
        * Description : This function used to edit coinset for related projects
        * Created On      : 24-02-11 (05:45am)
        *
        */ 
			
		function editcoinset($recid){
            $current_url= $_SERVER['HTTP_HOST'];
            $this->set('current_url',$current_url);
            $this->session_check_admin();
			$projectid = '1';
          	$p_id = $this->Coinset->query("select project_id from coinsets where id=$recid");
            $projectid=$p_id['0']['coinsets']['project_id'];			
            $this->set('projectid',$projectid); 
            $this->set('recid',$recid);   
            //get project name
            $p_name = $this->Project->query("select project_name from projects where id=$projectid");		
            $project_name = $p_name['0']['projects']['project_name']; 
            $this->set('current_project_name',$project_name);
			
            ##import EmailTemplate  model for processing
            App::import("Model", "Coinset");
            $this->Coinset =   & new Coinset();
			//for active menu display
            $this->set('page_url',"coinsetlist");
           	
			$sid=$consetdata[0]['max_id'];
            $singlearr = array("0","1","2","3","4","5","6","7","8","9");
            $condition1 = "project_id = '".$projectid."'  AND id=$sid";
            ##check already exists company name
            $consetdata1 = $this->Coinset->find('all',array("conditions"=>$condition1));
            $totcount = $consetdata1[0]['Coinset']['coinset_name'];
            if(preg_match('/[A-Z]{3}/', $totcount)==1){
                $coinsname= preg_split('/[A-Z]{3}/', $totcount);
                $totcount=$coinsname[1];
            }
            $nexval = ($totcount+1);
            if(in_array($nexval,$singlearr)){
                $newcoinsetname ='0'.$nexval;
            }else{
                $newcoinsetname = $nexval;
            }

            $this->set('coinsetname',$newcoinsetname);


            //get project type id
            $condition2 = "project_id = '".$projectid."'";
            $project_type = $this->Project->find('first',array("conditions"=>$condition2));
            $selectedprojecttype=$project_type['Project']['project_type_id'];
            $this->set('selectedprojecttype',$selectedprojecttype);

            //get previous artwork details
            $pre_artwork= $this->Coinset->query("select * from coinsets where project_id=$projectid order by id desc limit 1");
            $sidea_image=$pre_artwork['0']['coinsets']['sidea'];
            $sideb_image=$pre_artwork['0']['coinsets']['sideb'];
            $edge_image=$pre_artwork['0']['coinsets']['edge'];

            $this->set("sidea_image",$sidea_image);
            $this->set("sideb_image",$sideb_image);
            $this->set("edge_image",$edge_image);
            if(!empty($this->data)){

                $condition3 = "id = '".$this->data['Coinset']['id']."'";
                $existing_coinset = $this->Coinset->find('first',array("conditions"=>$condition3));

				
                $this->Coinset->set($this->data);

                #check server side validation

                $errormsg = $this->Coinset->invalidFields();

                if(!is_numeric(trim($this->data['Coinset']['verifycode']))&& ($this->data['Coinset']['verifycode'] != ''))
                {
                    $errormsg="Verification Code should be numeric.";                
                    $this->Session->setFlash($errormsg,'default',array('class' => 'msgTXt'));
                }

                if($this->data['Coinset']['verifycode'] != '')
                {    
                    $verifycode = $this->Coinset->find('first',array("conditions"=>"Coinset.verifycode='".$this->data['Coinset']['verifycode']."' and Coinset.project_id='".$projectid."' and Coinset.delete_status='0'"));



                    if(is_array($verifycode) and !empty($verifycode))

                    {
                        if($verifycode['Coinset']['id']!=$this->data['Coinset']['id'])
                        {
							$errormsg="Verification Code is already used.";                
                            $this->Session->setFlash($errormsg,'default',array('class' => 'msgTXt'));
                        }
                    }
                }


                if(!$errormsg){
                    $this->File = & new FileComponent;
                     $filePath =  'img' . DS . 'cckiller'. DS.'upload' ;
                    $this->File->setDestPath($filePath);
                       if(isset($this->data['Coinset']['use_pre_artwork'])==1)        //if previous artwork selected
                    {
                        $this->data['Coinset']['sidea'] =$sidea_image;
                        $this->data['Coinset']['sideb'] =$sideb_image;
                        $this->data['Coinset']['edge'] =$edge_image;
                    }
                    else    //if no previous artwork selected
                    {
                        if($this->data['Coinset']['coinsidea']['name'] !=''){
                            $file_name1 = $this->File->setFileName($this->data['Coinset']['coinsidea']['name']); 
                            $tmp1 = $this->data['Coinset']['coinsidea']['tmp_name'];
                            $fileNamesidea = $this->File->uploadcoin($file_name1,$tmp1,true);
                            $this->data['Coinset']['sidea'] =$fileNamesidea;
                        }
                        if($this->data['Coinset']['coinsideb']['name'] !=''){
                            $file_name2 = $this->File->setFileName($this->data['Coinset']['coinsideb']['name']); 
                            $tmp2 = $this->data['Coinset']['coinsideb']['tmp_name'];
                            $file_namesideb = $this->File->uploadcoin($file_name2,$tmp2,true);
                            $this->data['Coinset']['sideb'] =$file_namesideb;
                        }
                        if($this->data['Coinset']['coinedge']['name'] !=''){
                            $file_name4 = $this->File->setFileName($this->data['Coinset']['coinedge']['name']); 
                            $tmp4 = $this->data['Coinset']['coinedge']['tmp_name'];
                            $file_nameedge = $this->File->uploadlogo($file_name4,$tmp4,true,'300x12');
                            $this->data['Coinset']['edge'] =$file_nameedge;
							}
                    }     

                    if($this->Coinset->Save($this->data['Coinset'])){

                        $this->Session->setFlash('Coinset added successfully.','default', array('class' => 'successmsg'));


                        if(isset($this->data['Action']['redirectpage'])){

                            //$sessdata=$this->Session->read('newsortingby');
                            $this->redirect(array('controller'=>'setups','action'=>'coinsetlist'));

                        }else{
                            $this->redirect(array('controller'=>'setups','action'=>'editcoinset',$this->data['Coinset']['id']));
                        }
                    }else{
                        $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
                    }
                }
            }

            
            //get product andd pricing details
            $condition = "project_id = '".$projectid."' AND  delete_status = '0' ";
			 $this->set('coinsetname',$newcoinsetname);
            $this->set('totalreccount',$totcount);
            $this->Coinset->id = $recid;
            $this->data = $this->Coinset->read();
			//$this->pl($this->data);
			 $this->set("Coinset", $recid);
            
            $sides=array();
            $sides['A']="A";
            $sides['B']="B";
            $this->set("sides",$sides);     
			
        }
		
		
		// index 
		   function index(){
        	##check user session live or not
        	$this->session_check_admin();
        	$admin_id =  $_SESSION['Admin']['Admin']['id'];
        	$this->layout= 'new_admin_layout';
        	
        	//for active menu display
        	$project_id = '1';
        	$this->set('projectid',$project_id);
        	//for active menu display
        	$this->set('page_url','edit_project_detail');
        
        	App::import("Model", "Project");
        	$this->Project =   & new Project();
        	
        	App::import("Model", "Admin");
        	$this->Admin =   & new Admin();
        	
        	App::import("Model", "User");
        	$user =   & new User();
        	
        	$this->countrydroupdown();
        	$this->statedroupdown();
        	
        	  
        	# set help condition
        	$this->set("hlpdata",$this->getHelpContent('53'));
        	# set help condition
        
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	
        	$userid = $this->Session->read("User.User.id");
        	
        	##check empty data
        	if(!empty($this->data)) {
        
        		#set the posted data
				//$this->pl($this->data);
        		$this->Project->set($this->data);
        		#check server side validation
        		$errormsg = $this->Project->invalidFields();
        		if(!$errormsg){
        			
        			$this->Project->id = $project_id;
        			$this->data['Project']['id'] = $project_id;
				//	$this->pl($this->data);

        			if($this->Project->Save($this->data)){
        				
        				if(!empty($this->data['Admin']['username']) || (!empty($this->data['Admin']['npassword']) && !empty($this->data['Admin']['cpassword']) && ($this->data['Admin']['npassword'] == $this->data['Admin']['cpassword']))){
        					
        					if(empty($this->data['Admin']['username'])){
        						unset($this->data['Admin']['username']);
        					}
        					if(empty($this->data['Admin']['npassword']) || empty($this->data['Admin']['cpassword'] )){
        						unset($this->data['Admin']['npassword']);
        						unset($this->data['Admin']['cpassword']);
        					}else{
        						$this->data['Admin']['password'] = MD5($this->data['Admin']['npassword']);
        					}
        					$this->Admin->id =$admin_id;
        					$this->Admin->Save($this->data);
        				}
        				$this->Session->setFlash('Setting has been modified.','default', array('class' => 'successmsg'));
        				if(isset($this->data['Action']['redirectpage'])){
        					$this->redirect('settings');
        				}else{
        					$this->redirect('settings');
        				}
        			}else{
        				$this->Session->setFlash("Error in Processing",'default',array('class' => 'msgTXt'));
        				$this->redirect('settings');
        			}
        			
        		}else{
	        		$this->Session->setFlash("Please enter required field.",'default',array('class' => 'msgTXt'));
	        		$this->redirect('settings');
        		}
        	}
        
        	//for theme details
        	$this->Admin->id =$admin_id;
        	$admin = $this->Admin->read();
        	
        	$this->Project->id = $project_id;
        	$project  = $this->Project->read();
        	
        	$this->data = array_merge($project, $admin);
        	
        	$this->set('sellocation',$this->data['Project']['locations'] );
        	$this->set('selectedcountry',$this->data['Project']['country'] );
        	$this->set('selectedstate', $this->data['Project']['state']);
        	$this->set('project_id',$this->data['Project']['id']);
        	$this->set('is_wordpress_page',$this->data['Project']['is_wordpress_page']);
        	
        }
	}	
?>