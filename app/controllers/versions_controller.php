<?php
	 /* Project		   :-  Image coin website
    * Controller Name :-  versions_contoller.php
    * Created  On     :-  25-04-12             
    */
	class versionsController extends AppController 
    {
		 var $name = 'versions';
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
        }
		/**
		* function    : system_version_list		
        * params      : None.
        * Created On  : 22-04-2012
		**/
		function system_version_list(){

            ##check admin session live or not
            $this->session_check_admin();
              
            ##fetch data from project type table for listing
            $field='';
            $condition = "delete_status = '0'";
            if(isset($this->data['versions']['searchkey']) && $this->data['versions']['searchkey']){
                $searchkeyword = $this->data['versions']['searchkey'];
                $condition .= "  and (system_version_name LIKE '%".$searchkeyword."%' OR note  LIKE '%".$searchkeyword."%' )";
            }

            $this->Pagination->sortByClass    = 'SystemVersion'; ##initaite pagination 

            $this->Pagination->total= count($this->SystemVersion->find('all',array("conditions"=>$condition)));

            list($order,$limit,$page) = $this->Pagination->init($condition,$field);

            $sys_ver_data = $this->SystemVersion->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            ##set project type data in variable
         
            $this->set("sys_ver_data",$sys_ver_data);  
        } //End system_version_list function.  

		/**
		* function    : system_version
		*Links		  : Border Footer/edit	
        * params      : None.
        * Created On  : 22-04-2012
		**/
		function system_version($opr=null,$id=null)
		{

			App::import("Model", "SystemVersion");
            $this->SystemVersion =   & new SystemVersion();
			
			if(!empty($this->data)){
				if($this->SystemVersion->save($this->data)) {
					if(isset($this->data['Action']['redirectpage'])){
						$msg='System Version updated Successfully.';
						$this->Session->setFlash($msg,'default', array('class' => 'successmsg'));
					   $this->redirect(array('controller' =>'versions', 'action' =>'system_version_list'));
					}
					else{					
						$id=$this->data['SystemVersion']['id'];
						$opr=$id==""?'add':'edit';
						$msg='System Version updated Successfully.';
						$this->Session->setFlash($msg,'default', array('class' => 'successmsg'));
						$this->redirect(array("controller"=>"versions" , "action"=>"system_version",$opr,$id)); 			
					}
				} else
				{
					
					//$this->redirect(array('controller' =>'versions', 'action' =>'system_version','add'));
					$this->validateErrors();
				}
			}       			
			//pr($this->data);
			/*$status=$this->SystemVersion->system_version($opr,$id,$this->data);

            if($status)
            {
                if($status['success']==1)             
                    $this->Session->setFlash($status['msg'],'default', array('class' => 'successmsg'));
                else           
                    $this->Session->setFlash($status['msg'],'default',array('class' => 'msgTXt'));
               
                if($this->data['Action']['redirectpage'])
                    $this->redirect(array("controller"=>"setups" , "action"=>"system_version_list")); 
                    else
                    $this->redirect(array('controller'=>'setups' , 'action'=>'system_version',$opr,$id));
            }*/
            
            if($opr=="edit")
            {
               $this->SystemVersion->id = $id;
                $this->data = $this->SystemVersion->read();
				$this->set("data", $this->data);
            }       
        }//end system_version function

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
			  App::import("Model", "SystemVersion");
            $this->SystemVersion =   & new SystemVersion();
		 
			$this->SystemVersion->updateAll(array('SystemVersion.active_status'=> $status), array('SystemVersion.id' => $recid));
			
			$this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));
			
			$this->redirect(array("controller"=>"versions","action"=>"system_version_list"));

        }//end changestatus function
	}
?>