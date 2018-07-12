<?php
	 /* 
	*Modified by	   :-	Puneet Gupta
	*Project		   :-  Image coin website
    * Controller Name  :-  legals_contoller.php
    * Created  On      :-  26-04-12             
    */
	class legalsController extends AppController 
    {
		 var $name = 'legals';
       //var $uses = 'Setup';
        var $layout = 'new_admin_layout';
        var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
        var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
        var $uses     = array('Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term');

        function pagenotavailable(){
            $this->layout = "";
        }

        function beforeFilter() {
				 /*permission code start*/	
			 if($this->Session->check("UserLoginDetails"))
			 {
			  	$admin =  $this->Session->read("UserLoginDetails");
				$permissions = array();
				if(!empty($admin))
				{
					//if($admin['Admin']['username']!='admin')
					//{
            			$permissions = $this->check_user_permissions($admin['Admin']['user_type']);
					//}
				}
				if(!empty($permissions))
				{
					$this->set('hideMenuPermission',$permissions);	
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
        }//end beforefilter function
		/*
			@Auther			Suman Singh
			@Type			Modified
			@Email			suman.singh@dotsqares.com				
			@Date			April 13, 2012
			@Link			Setup => Legal => Agreements by projects
			@Prams	
			@Return			
			@Description	user agreements by project basis
		*/
		function user_agreement_list_by_project(){

            ##check admin session live or not
            $this->session_check_admin();
            
            App::import("Model", "Project");
            $this->Project =   & new Project();
			
            ##fetch data from project type table for listing
            $field=array('UserAgreement.*','Project.project_name','Project.created','Project.id');
            $condition = "UserAgreement.delete_status = '0'";
            if(isset($this->data['legals']['searchkey']) && $this->data['legals']['searchkey']){
				$searchkeyword = $this->data['legals']['searchkey'];
                $condition .= "  and (agreement_name LIKE '%".$searchkeyword."%')";
            }

            $joins = array();
            $joins[] =  array(
                        'table' => 'projects', 
                        'alias' => 'Project', 
                        'type' => 'INNER',
                        'conditions' => array('UserAgreement.id = Project.user_agreement_id',"UserAgreement.delete_status = '0'","UserAgreement.active_status = '1'")
            );
			//pr($joins);
            
            $this->Pagination->sortByClass    = 'UserAgreement'; ##initaite pagination 

            $this->Pagination->total= count($this->UserAgreement->find('all',array('joins'=>$joins)));

            list($order,$limit,$page) = $this->Pagination->init($condition,$field);
            
            if(isset($_GET['sortBy']) && $_GET['sortBy']=="project_name"){
                 if(isset($_GET['direction'])){	
					$order=" Project.project_name ".$_GET['direction'];
				 }else{
					$order="";
				 }
            }
            if(isset($_GET['sortBy']) && $_GET['sortBy']=="created"){
					if(isset($_GET['direction'])){				
					  $order=" Project.created ".$_GET['direction'];
					}
            }

            $user_agr_data = $this->UserAgreement->find('all',array('conditions'=>$condition,"fields"=>$field,'order' =>$order, 'limit' => $limit, 'page' => $page,"joins" => $joins));



			 $this->set("user_agr_data",$user_agr_data);  
			//get spam policy adn terms & cond status.
            
			/*
				@Auther			Suman Singh
				@Type			Modified
				@Variable name	$spam_policy_url,$terms_url
				@Date			April 13, 2012
			*/
			
			$condition="SpamPolicy.created_by='1' and SpamPolicy.active_status='1'";
            $spam_policy_dts = $this->SpamPolicy->find('first',array("conditions"=>$condition));
            if(empty($spam_policy_dts))
               
                $spam_policy_url = array('controller'=>'legals','action'=>'spam_policy','add');
            else
               
				$spam_policy_url = array('controller'=>'legals','action'=>'spam_policy','edit',$spam_policy_dts['SpamPolicy']['id']);
                
            $this->set("spam_policy_url", $spam_policy_url);
            
            ##check exist sponsor for particular project
            $condition = "Term.project_id = '0'";
            $ttdata = $this->Term->find('all',array("conditions"=>$condition));
            
            //$terms_url="/admins/terms_by_admin/add/";
			$terms_url = array('controller'=>'legals','action'=>'terms_by_admin','add');
			if($ttdata){
                if($ttdata[0]['Term']['id'] !=''){

                    $termid = $ttdata[0]['Term']['id'];
                    //$terms_url="/admins/terms_by_admin/edit/".$termid;
					$terms_url = array('controller'=>'legals','action'=>'terms_by_admin','edit',$termid);
                }
            }
                
            $this->set("terms_url", $terms_url);
        }//End user_agreement_list_by_project()
		
		/*
				@Auther			Suman Singh
				@Type			Modified
				@Param			$operation,$id
				@Date			April 26, 2012
			*/
		function user_agreement($opr='',$id='')
        {

			##check admin session live or not
            $this->session_check_admin();
			
            $status=$this->UserAgreement->user_agreement($opr,$id,$this->data);
            
            if($status)
            {
                if($status['success']==1)             
                    $this->Session->setFlash($status['msg'],'default', array('class' => 'successmsg'));
                else           
                    $this->Session->setFlash($status['msg'],'default',array('class' => 'msgTXt'));
                           
                
                if(isset($this->data['Action']['redirectpage']))
                        $this->redirect(array("controller" =>"legals","action" =>"user_agreement_list")); 
                    else
                        $this->redirect(array("controller" =>"legals","action" =>"user_agreement",$opr,$id));
            }
            
            if($opr=="edit")
            {
                $this->UserAgreement->id = $id;
                $this->data = $this->UserAgreement->read();
                $this->set("data", $this->data);
            }
			
			if(empty($this->data) && $opr == 'add')
			$this->set("data", $this->data);
			
			$this->set("opr", $opr);
			$this->set("id", $id);
                  
        }//End user_agreement function


		 function user_agreement_list(){

            ##check admin session live or not
            $this->session_check_admin();
            
            App::import("Model", "Project");
            $this->Project =   & new Project();

    
            ##fetch data from project type table for listing
            $field=array('UserAgreement.*');
            $condition = "UserAgreement.delete_status = '0'";
            if(isset($this->data['legals']['searchkey']) && $this->data['legals']['searchkey']){
                $searchkeyword = $this->data['legals']['searchkey'];
                $condition .= "  and (agreement_name LIKE '%".$searchkeyword."%')";
            }

            $this->Pagination->sortByClass    = 'UserAgreement'; ##initaite pagination 

            $this->Pagination->total= count($this->UserAgreement->find('all'));

            list($order,$limit,$page) = $this->Pagination->init($condition,$field);
            
            if(isset($_GET['sortBy']) && $_GET['sortBy']=="project_name"){
                  $order=" Project.project_name ".$_GET['direction'];
            }
            if(isset($_GET['sortBy']) && $_GET['sortBy']=="created"){
                  $order=" Project.created ".$_GET['direction'];
            }

            $user_agr_data = $this->UserAgreement->find('all',array('conditions'=>$condition,"fields"=>$field,'order' =>$order, 'limit' => $limit, 'page' => $page));
            ##set project type data in variable
            
         
            $this->set("user_agr_data",$user_agr_data);  
            
			//get spam policy adn terms & cond status.
            
			/*
				@Auther			Suman Singh
				@Type			Modified
				@Variable name	$spam_policy_url,$terms_url
				@Date			April 13, 2012
			*/
			
			$condition="SpamPolicy.created_by='1' and SpamPolicy.active_status='1'";
            $spam_policy_dts = $this->SpamPolicy->find('first',array("conditions"=>$condition));
            if(empty($spam_policy_dts))
                
                $spam_policy_url = array('controller'=>'admins','action'=>'spam_policy','add');
            else
                
				$spam_policy_url = array('controller'=>'legals','action'=>'spam_policy','edit',$spam_policy_dts['SpamPolicy']['id']);
                
            $this->set("spam_policy_url", $spam_policy_url);
            
            ##check exist sponsor for particular project
            $condition = "Term.project_id = '0'";
            $ttdata = $this->Term->find('all',array("conditions"=>$condition));
           	$terms_url = array('controller'=>'legals','action'=>'terms_by_admin','add');
			if($ttdata){
                if($ttdata[0]['Term']['id'] !=''){

                    $termid = $ttdata[0]['Term']['id'];
                    //$terms_url="/admins/terms_by_admin/edit/".$termid;
					$terms_url = array('controller'=>'legals','action'=>'terms_by_admin','edit',$termid);
                }
            }
                
            $this->set("terms_url", $terms_url);
        }//End user_agreement_list

		/*
        * Function name   : changestatus()
        * Arguments : $recid,$modelname,$status,$methodname
        * Description : This function used to change status as active or deactive
        * Created On      : 16-02-11 (03:45am)
        *
        */
		function changestatus($recid=null,$status=null){
		if($status == 2 )
		$status = 0;
            ##check user session live or not
			$this->session_check_admin();
            
			##import dynamic model for processing
			App::import("Model", "UserAgreement");
            $this->UserAgreement =   & new UserAgreement();
			$data = $this->UserAgreement->read(null, $recid);
			//var_dump($status);
			//pr($data);
			//die;
			if($status == 0 && $data['UserAgreement']['default_new_projects'] == 1) {
			$this->Session->setFlash('you can not deactivate this record.','default', array('class' => 'successmsg'));
			} else {
			$this->UserAgreement->updateAll(array('UserAgreement.active_status'=> $status), array('UserAgreement.id' => $recid));
			$this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));
			}
			$this->redirect(array("controller"=>"legals","action"=>"user_agreement_list"));

        }//end changestatus function
      
		/*
			@Auther			Suman Singh
			@Type			Modified
			@Email			suman.singh@dotsqares.com				
			@Date			April 13, 2012
			@Link			Setup => Legal => Agreement History
			@Prams	
			@Return			
			@Description	user agreements by project basis
		*/
		function user_agreehistory(){

            ##check admin session live or not
            $this->session_check_admin();
            
            App::import("Model", "Project");
            $this->Project =   & new Project();
			
			// suman here
			
			$this->Project->recursive = 3;
			$this->Project->bindModel(
											array(
											'hasOne'=>array(
																'User' => array(
																'className' =>'User',
																'fields'   	=> array(
																				'User.id',
																				'User.username',
																				'User.last_login',
																				'User.project_id'
																				)
																)
															),
											'belongsTo'=>array(
															'UserAgreement' => array(
																'className' =>'UserAgreement',
																'fields'   	=> array(
																				'UserAgreement.id',
																				'UserAgreement.agreement_name',
																				'UserAgreement.active_status',
																				'UserAgreement.created',
																				'UserAgreement.modified',
																				'UserAgreement.delete_status'
																				)
																)
															),
											)
			);
			
		    ##fetch data from project type table for listing
            
			$fields = array('Project.id,Project.sponsor_id,Project.project_name,Project.created,Project.user_agreement_id');
            //$condition = "UserAgreement.delete_status = '0'";
            $condition = "UserAgreement.delete_status = '0'";
            $condition .= " AND User.last_login > UserAgreement.modified";
			
			
            if(isset($this->data['legals']['searchkey']) && $this->data['legals']['searchkey']){
                $searchkeyword = $this->data['legals']['searchkey'];
                $condition .= "  AND (UserAgreement.agreement_name LIKE '%".$searchkeyword."%')";
            }


            
            $this->Pagination->sortByClass = 'UserAgreement'; ##initaite pagination 

            $this->Pagination->total= count($this->Project->find('all',array('conditions'=>$condition)));

            list($order,$limit,$page) = $this->Pagination->init($condition,$fields);
            
            if(isset($_GET['sortBy']) && $_GET['sortBy']=="project_name"){
                  $order=" Project.project_name ".$_GET['direction'];
            }
            if(isset($_GET['sortBy']) && $_GET['sortBy']=="created"){
                  $order=" Project.created ".$_GET['direction'];
            }

            //$user_agr_data = $this->UserAgreement->find('all',array('conditions'=>$condition,"fields"=>$field,'order' =>$order, 'limit' => $limit, 'page' => $page,"joins" => $joins));
			$this->Project->bindModel(
											array(
											'hasOne'=>array(
																'User' => array(
																'className' =>'User',
																'fields'   	=> array(
																				'User.id',
																				'User.username',
																				'User.last_login',
																				'User.project_id'
																				)
																)
															),
											'belongsTo'=>array(
															'UserAgreement' => array(
																'className' =>'UserAgreement',
																'fields'   	=> array(
																				'UserAgreement.id',
																				'UserAgreement.agreement_name',
																				'UserAgreement.active_status',
																				'UserAgreement.created',
																				'UserAgreement.modified',
																				'UserAgreement.delete_status'
																				)
																)
															),
											)
			);
			$user_agr_data = $this->Project->find('all',array('conditions'=>$condition,'fields'=>$fields,'order' =>'UserAgreement.id DESC'));
			//$user_agr_data = $this->Project->find('all');
			
            ##set project type data in variable
            
			//pr($user_agr_data); die;
            $this->set("user_agr_data",$user_agr_data);   
            
			//get spam policy adn terms & cond status.
            
			/*
				@Auther			Suman Singh
				@Type			Modified
				@Variable name	$spam_policy_url,$terms_url
				@Date			April 13, 2012
			*/
			
			$condition="SpamPolicy.created_by='1' and SpamPolicy.active_status='1'";
            $spam_policy_dts = $this->SpamPolicy->find('first',array("conditions"=>$condition));
            if(empty($spam_policy_dts))
                $spam_policy_url = array('controller'=>'legals','action'=>'spam_policy','add');
            else
				$spam_policy_url = array('controller'=>'legals','action'=>'spam_policy','edit',$spam_policy_dts['SpamPolicy']['id']);
                
            $this->set("spam_policy_url", $spam_policy_url);
            
            ##check exist sponsor for particular project
            $condition = "Term.project_id = '0'";
            $ttdata = $this->Term->find('all',array("conditions"=>$condition));
            
            //$terms_url="/admins/terms_by_admin/add/";
			$terms_url = array('controller'=>'legals','action'=>'terms_by_admin','add');
			if($ttdata){
                if($ttdata[0]['Term']['id'] !=''){

                    $termid = $ttdata[0]['Term']['id'];
                    //$terms_url="/admins/terms_by_admin/edit/".$termid;
					$terms_url = array('controller'=>'legals','action'=>'terms_by_admin','edit',$termid);
                }
            }
                
            $this->set("terms_url", $terms_url);
        } //end of user_agreehistory()
		
		function getUsernameByproject($pid = null) {
			App::import("Model", "User");
            $this->User =   & new User();
			$fd = $this->User->find('first',array('conditions'=>array('User.project_id'=>$pid),'fields'=>'User.username'));
			return $fd['User']['username'];
		}


		//get spam policy adn terms & cond status.
            
			/*
				@Auther			Puneet Gupta
				@Type			Modified
				@Date			April 27, 2012
			*/
		function terms_by_admin($opr,$id){
            ##check admin session live or not
            $this->session_check_admin();
            
            App::import("Model", "Term");
            $this->Term =  & new Term();
            
            $status=$this->Term->terms_by_admin($opr,$id,$this->data);            
            if($status)
            {
                if($status['success']==1)             
                    $this->Session->setFlash($status['msg'],'default', array('class' => 'successmsg'));
                else           
                    $this->Session->setFlash($status['msg'],'default',array('class' => 'msgTXt'));
                           
                
                if(isset($this->data['Action']['redirectpage']))
                        $this->redirect(array("controller" =>"legals" , "action" =>"terms_by_admin", $opr,$id));
                    else
                        $this->redirect(array("controller" =>"legals" , "action" =>"terms_by_admin", $opr,$id));
            }
            
           
            ##check exist sponsor for particular project
            $condition = "Term.project_id = '0'";
            $ttdata = $this->Term->find('all',array("conditions"=>$condition));

            if($ttdata){
                if($ttdata[0]['Term']['id'] !=''){

                    $termid = $ttdata[0]['Term']['id'];

                    $this->Term->id = $termid;
                    $this->data = $this->Term->read();
                    $this->set("data", $this->data);
                    
                    $terms_url="/legals/terms_by_admin/edit/".$termid;
                }
            }
            else
                $terms_url="/legals/terms_by_admin/add/";
            
            $this->set("terms_url", $terms_url);         
            
            //get spam policy adn terms & cond status.
            $condition="SpamPolicy.created_by='1' and SpamPolicy.active_status='1'";
            $spam_policy_dts = $this->SpamPolicy->find('first',array("conditions"=>$condition));
            if(empty($spam_policy_dts))
                $spam_policy_url="/legals/spam_policy/add";
            else
                $spam_policy_url="/legals/spam_policy/edit/".$spam_policy_dts['SpamPolicy']['id'];
                
            $this->set("spam_policy_url", $spam_policy_url);
            
            
            # set help condition

            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '17'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition   
        }//end terms_by_admin();

		/*
				@Auther			Puneet Gupta
				@Type			Modified
				@Date			April 27, 2012
			*/

		function spam_policy($opr,$id)
        {
            ##check admin session live or not

            $this->session_check_admin();
			$status = array();
			
			if(!empty($this->data)) {
			$status=$this->SpamPolicy->spam_policy($opr,$id,$this->data);
			// Update modified date of all agreements
			// Date 7 may 2012 by suman
			$mdDate = date("Y-m-d H:i:s");
			$this->UserAgreement->query("UPDATE user_agreements SET modified = '$mdDate' WHERE delete_status = '0'");
			}
			if($status)
            {
                if($status['success']==1)             
                    $this->Session->setFlash($status['msg'],'default', array('class' => 'successmsg'));
                else           
                    $this->Session->setFlash($status['msg'],'default',array('class' => 'msgTXt'));
                           
                
                if(isset($this->data['Action']['redirectpage'])){

	
						$this->redirect(array("controller" => "legals" ,"action" =>"spam_policy",$opr,$id));
				}
                 else{
						 $this->redirect(array("controller" => "legals" ,"action" =>"spam_policy",$opr,$id));
				 }
            }
            
			if($opr=="edit")
            {
	
				$this->SpamPolicy->id = $id;
                $this->data = $this->SpamPolicy->read();
			//	pr($this->data);die;
                $this->set("data", $this->data);
            }

            //get spam policy adn terms & cond status.
            $condition="SpamPolicy.created_by='1' and SpamPolicy.active_status='1'";
            $spam_policy_dts = $this->SpamPolicy->find('first',array("conditions"=>$condition));
			 if(empty($spam_policy_dts)){
				$spam_policy_url=$this->redirect(array("controller" => "legals" ,"action" => "spam_policy","add"));
			}
            else{
              
			$spam_policy_url=array("controller" =>"legals","action"=>"spam_policy","edit",$spam_policy_dts['SpamPolicy']['id']);
			}
	            $this->set("spam_policy_url", $spam_policy_url);            
	            ##check exist sponsor for particular project
		      
				$condition = "Term.project_id = '0'";
			    $ttdata = $this->Term->find('all',array("conditions"=>$condition));            
				//pr($ttdata);die;
            if($ttdata){
                if($ttdata[0]['Term']['id'] !=''){

                    $termid = $ttdata[0]['Term']['id'];
              		$terms_url=array("controller"=>"legals" , "action" =>"terms_by_admin","edit",$termid);
				}
            }
            else
                $terms_url=array("controller"=>"legals" , "action" =>"terms_by_admin","add");
	            $this->set("terms_url", $terms_url);      
				
		} //end of spam_policy();    

		function setAsDefault($recid=null){

            ##check user session live or not
            $this->session_check_admin();

            ##import dynamic model for processing
            App::import("Model", 'UserAgreement');
            $this->UserAgreement =   & new UserAgreement();       
            ##set the record for updation
            $this->UserAgreement->updateAll(array('UserAgreement.default_new_projects'=> 1,'UserAgreement.active_status'=> 1), array('UserAgreement.id' => $recid));
            $this->UserAgreement->updateAll(array('UserAgreement.default_new_projects'=> 0), array('UserAgreement.delete_status' =>'0','UserAgreement.id !=' => $recid));
			
            $this->Session->setFlash('Default Status updated successfully.','default', array('class' => 'successmsg'));

            $this->redirect(array('controller'=>'legals','action'=>'user_agreement_list'));
        }

	}//end class 
?>