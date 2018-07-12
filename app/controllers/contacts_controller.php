<?php
	/* Project		   :-  Image coin website
    * Controller Name :-  contacts_contoller.php
    * Created  On     :-  17-05-12             
	* Created By	  :- Vidhur
    */
	class contactsController extends AppController 
    {
		var $name = 'contacts';
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
                $subpermissions = array();
                if(!empty($admin))
                {
                    //if($admin['Admin']['username']!='admin')
                    //{
                        $permissions    = $this->check_user_permissions($admin['Admin']['user_type'],'yes');
                        $subpermissions = $this->check_user_permissions($admin['Admin']['user_type'],'no');
                    //}
                }
                /*echo "<pre>";
                print_r($permissions);
                print_r($subpermissions);die();*/
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
		/*
        * Function name   : contacts replace with sa_contactlist() 
        * Description : This function used to list contacts of related companies
        * Created On      : 17-05-12
        * Modified By	  Puneet
        */ 
        function sa_contactlist(){
            ##Configure::write('debug',3);
            ##check admin session live or not
            $this->session_check_admin();

            if(isset($_SERVER['QUERY_STRING']))
            {
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);    
            }
            ##import Company  model for processing
            App::import("Model", "Contact");
            $this->Contact =   & new Contact();    
            ##fetch data from Contact table for listing
            $field='';
            $condition = "Contact.delete_status = '0' AND Contact.project_id = '0'";
            if(isset($this->data['contacts']['searchkey']) && $this->data['contacts']['searchkey']){
                $searchkeyword = $this->data['contacts']['searchkey'];
                $condition .= "  and (Contact.firstname LIKE '%".$searchkeyword."%' OR Contact.lastname LIKE '%".$searchkeyword."%' OR Contact.email LIKE '%".$searchkeyword."%' OR ContactType.contact_type_name LIKE '%".$searchkeyword."%' OR Contact.mobile LIKE '%".$searchkeyword."%'  )";
            }

            if(isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']=='company_name'){
                $this->Pagination->sortByClass    = 'Company'; ##initaite pagination
            }else if(isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']=='contact_type_name'){
                    $this->Pagination->sortByClass    = 'ContactType'; ##initaite pagination
                }else{
                    $this->Pagination->sortByClass    = 'Contact'; ##initaite pagination 
            }
            ##relation ship with contact type and company table with contacts
            $this->Contact->bindModel(array('belongsTo'=>array(
            'ContactType'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.contact_type_id = ContactType.id'
            ),'Company'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.company_id = Company.id'
            )
            )));

            $this->Pagination->total= count($this->Contact->find('all',array("conditions"=>$condition)));
            list($order,$limit,$page) = $this->Pagination->init($condition,$field);

            $this->Contact->bindModel(array('belongsTo'=>array(
            'ContactType'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.contact_type_id = ContactType.id'
            ),'Company'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.company_id = Company.id'
            )
            )));

            $contactdtlarr = $this->Contact->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

            ##set project type data in variable
            $this->set("contactdata",$contactdtlarr);
            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '63'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end of sa_contactlist()

		/*
        * Function name   : changestatus()
        * Arguments : $recid,$modelname,$status,$methodname
        * Description : This function used to change status as active or deactive
        * Created On      : 15-05-12
        * Modified By	  : Vidhur	
        */ 
        function changestatus($recid,$modelname,$status,$methodname,$action='cngstatus',$othermodel='',$otherid='',$param=''){

			##check user session live or not
			$this->session_check_admin();
            ##import dynamic model for processing
            App::import("Model", $modelname);
            $this->$modelname =   & new $modelname(); 
            ##set the record for updation 
			 $allcompanyid=str_replace('*', ',',$recid); 			
			 $cidArr = explode(',',$allcompanyid);
			 //get company id exist in project_owner table or not
			##import ProjectOwner model for processing
			
				if($modelname=='Company'){
					App::import("Model", "ProjectOwner");
					$this->ProjectOwner =   & new ProjectOwner(); 
					$importModalName="ProjectOwner";
					$fieldName="owner_id";
					 $projectOwnerdatas = $this->ProjectOwner->find('all', array('conditions' => array('owner_id' =>$cidArr ),'group' =>array('ProjectOwner.owner_id'),'fields'=>'ProjectOwner.owner_id'));
				}
				else{
				
					App::import("Model", "Project");
					$this->Project =   & new Project();
					$importModalName="Project";
					$fieldName="project_contact_admin_id";
					 $projectOwnerdatas = $this->Project->find('all', array('conditions' => array('delete_status'=>'0','active_status'=>'1','project_contact_admin_id' =>$cidArr ),'group' =>array('Project.project_contact_admin_id'),'fields'=>'Project.project_contact_admin_id'));				
				} 
				 if(!empty($projectOwnerdatas) && count($projectOwnerdatas) > 0 ){
//					   echo "dfdd";exit;
					   $projectOwnerArr = array();
				 	   foreach($projectOwnerdatas as $projectOwnerdata){
						  $projectOwnerArr[] = 	$projectOwnerdata[$importModalName][$fieldName];
					   }
					$diffArr = array_diff($cidArr,$projectOwnerArr);
					$commonArrValue=array_intersect($cidArr,$projectOwnerArr);
					$commonValueStr=implode(',',$commonArrValue);
					//get common value in array
		            $res = Set::enum('yes', array('no' => 0, 'yes' => 1));
 
                    $i=$this->$modelname->updateAll(array('delete_status'=>"'".$res."'"), array('id'=>$diffArr));
					//die('ddd');
					if($i){
						$this->Session->setFlash("Database updated successfully and you can not delete record id $commonValueStr",'default', array('class' => 'successmsg'));
					}
					if(count($diffArr)==0){
						$this->Session->setFlash("You can not delete this recored.",'default', array('class' => 'successmsg'));
					}
				 }else{				 
					 
					  $allid=str_replace('*', ' or id = ',$recid);  
				      $where="id=$allid";		 
		             if(count(explode('*',$recid))==1){
						 $this->data["$modelname"]['id'] = $recid;
					 }
					 $res = Set::enum('yes', array('no' => 0, 'yes' => 1));
					 $i=$this->$modelname->updateAll(array('delete_status'=>"'".$res."'"),$where);
					 if($i){
						 $this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));
					}
				 }
      

			//$methodname="admins/".$methodname;exit;
            $this->redirect("$methodname/");

        }//end of changestatus()
		

		   /*
        * Function name   : sa_addcontacts()
        * Description : This function used to add contacts for companies
        * Created On      : 17-05-12
        * Modified By     : Puneet
        */     
        function sa_addcontacts($contactid='',$companyid=''){
			##check admin session live or not
            $this->session_check_admin();
        	//echo "<pre>";
			//print_r();
		    
			##import Company  model for processing
			$referSet = false;	
			//echo $this->referer();
			//echo "<br>";
			//echo $this->referer(null, true);
			//if($this->referer() == Router::url(array('controller' => 'admins', 'action' => 'addproject'))) {
			//if($this->referer() == "/admins/editproject/") {
			
			$pos = strpos($this->referer(),"admins/editproject/");
			$referelProject_id = '';
			if($pos != false) {
				$referSet = true;
				$referelProject_id = end((explode('/', $this->referer())));
			}
			//echo 'af g  '.$referelProject_id;
			$PageHeading = '';
			if($contactid){
				$PageHeading = 'Edit Contact Detail';
			} else {
				$PageHeading = 'Add New Contact';
			}
			
			if($contactid && $referSet == true ){
				$PageHeading = 'Edit Project Owner Contact';
			}else if($referSet == true ) {
				$PageHeading = 'Add Project Owner Contact';
			}
			
			$realetedProjects = array();
			$realetedProjects = $this->projectsRealted_to_contact($contactid);
			$realeted_projects_flag = false;
			if($referSet == true && count($realetedProjects) >= 0) {
			
			// show "Related to projects" in contact section
				$realeted_projects_flag = true;
			}
			//print_r($realetedProjectsC);
			$this->set("referelProject_id",$referelProject_id);
			
			$this->set("realetedProjects",$realetedProjects);
			$this->set("realeted_projects_flag",$realeted_projects_flag);
			$this->set("PageHeading",$PageHeading);
			
            App::import("Model", "Contact");
            $this->Contact =   & new Contact();    
            $this->set("selectedcountry",'');
            $this->set("selectedstate",'');

            ##check empty data
            if(!empty($this->data)) {
				//print_r($this->data);die;
                $this->data['Contact']['project_id'] = 0;

                #set the posted data
                $this->Contact->set($this->data);
                #check server side validation
                $errormsg = $this->Contact->invalidFields();
                if(!$errormsg){
                    $cid = "";
                    $fname = $this->data['Contact']['firstname'];
                    $lname = $this->data['Contact']['lastname'];
                    $jobtitle = $this->data['Contact']['jobtitle'];
                    $address1 = $this->data['Contact']['address1'];
                    $country = $this->data['Contact']['country'];
                    $state = $this->data['Contact']['state'];
                    $city = $this->data['Contact']['city'];
                    $zipcode = $this->data['Contact']['zipcode'];

                    if($this->data['Contact']['id']){
                        $cid = $this->data['Contact']['id'];
                        // Check Contact already exists with same firstname, last name. title, address, city state, country, zip 
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0'    AND  delete_status = '0' AND id !='".$cid."'";

                    }else{
                        // Check Contact already exists with same firstname, last name. title, address, city state, country, zip 
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0' AND  delete_status = '0'";
                    }    
                    ##check already exists company name
                    $ctdata = $this->Contact->find('all',array("conditions"=>$condition));
					
                    if(!$ctdata){

                        if($this->Contact->Save($this->data)){
                            if($cid){
                                $this->Session->setFlash('Contact updated Successfully.','default', array('class' => 'successmsg'));
                            }else{
                                $this->Session->setFlash('Contact Added Successfully.','default', array('class' => 'successmsg'));
                            }
							if(!empty($this->data['Contact']['referelProject_id']) && $this->Contact->id) {
							
							##import ProjectContact model for processing
							App::import("Model", "ProjectContact");
							$this->ProjectContact =   & new ProjectContact();
							
							$pContacts['contact_id'] = $this->Contact->id;
							$pContacts['project_id'] = $this->data['Contact']['referelProject_id'];
							$this->ProjectContact->Save($pContacts);
							$this->Session->setFlash('Contact Added Successfully for selected project.','default', array('class' => 'successmsg'));
							}
							
                        }else{
                            $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));    
                        }

                        if(isset($this->data['Action']['redirectpage'])){

                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                        }
						else
                        {
						
						if($this->data['Contact']['customer']==='customer')
                        {
						
                            $this->redirect(array('controller'=>'relationships','action'=>'customers'));
                        }else{				
							
                            $this->redirect(array('controller'=>'contacts','action'=>'sa_contactlist'));
                       }
					    }

                    }else{
                        $this->Session->setFlash('Contact with same name and location already exists.','default',array('class' => 'msgTXt'));
                    }
                }
            }
            if($contactid && $contactid !=='addcontact'){

				$this->Contact->id = $contactid;
                $this->data = $this->Contact->read();	
				
				$projectid=$this->data['Contact']['project_id'];
			  }else{
					$projectid=0;
			  }
			
			if(empty($this->data))
			$this->set("selectedcompany",$companyid);
			else
			$this->set("selectedcompany",$this->data['Contact']['company_id']);

           /*if($companyid && $contactid !=='addcontact'){

				$this->set("selectedcompany",$companyid);
            }else{
                $this->set("selectedcompany",1);
            }*/
            //$this->set("selectedcontacttype","");
            //$this->set("selectedcontacttype",$this->data['Contact']['contact_type_id']);
			$default_contactType = $this->get_defaultProjectLead_id();
			$this->set("default_contactType",$default_contactType);
            $contacttypedropdown = $this->contacttypedropdown(0);//$projectid
            //pr($contacttypedropdown);
			//$this->set("contacttypedropdown",$contacttypedropdown);
			$this->companydropdown('0');

            ##country drop down
            $this->countrydroupdown();
            $this->statedroupdown();

            ##check default dropdowns        
            if($this->data['Contact']['country']){
                $conid = $this->data['Contact']['country'];
                $this->set("selectedcountry",$conid);
                ##state drop down
                $this->statedroupdown($conid);
                if($this->data['Contact']['state']){
                    $statid = $this->data['Contact']['state'];
                    $this->set("selectedstate",$statid);

                }
            }

            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '64'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end of sa_addcontacts

		/*
        * Function name   : sa_companylist()
        * Description : This function used to list companies 
        * Created On      : 17-05-12 
        * Modified By : Puneet
        */ 
        function sa_companylist(){

            ##check admin session live or not
            $this->session_check_admin();
            $projectid = $this->Session->read("sessionprojectid");
            if(isset($_SERVER['QUERY_STRING']))
            {
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);    
                if(isset($_GET['sortBy'])) $sortby=$_GET['sortBy'];
                if(isset($_GET['direction'])) $sorttype=$_GET['direction'];
            }
            ##import Company  model for processing
            App::import("Model", "Company");
            $this->Company =   & new Company();    
            ##fetch data from Company table for listing
            $field='';
            //$condition = "Company.delete_status = '0' AND Company.project_id = '0'";
            $condition = "Company.delete_status = '0' AND Company.project_id = '0' ";
            if(isset($this->data['contacts']['searchkey']) && $this->data['contacts']['searchkey']){
                $searchkeyword = $this->data['contacts']['searchkey'];
                $condition .= "  and (CompanyType.company_type_name LIKE '%".$searchkeyword."%' OR Company.company_name LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%' OR Company.website LIKE '%".$searchkeyword."%'  )";
            }
            $this->Pagination->sortByClass    = 'Company'; ##initaite pagination 
            $this->Company->bindModel(array('belongsTo'=>array(
            'CompanyType'=>array(
            'foreignKey'=>false,
            'conditions'=>'Company.company_type_id = CompanyType.id'
            )
            )));

            $this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));

            list($order,$limit,$page) = $this->Pagination->init($condition,$field);

            // if sort by company type name
            if(isset($sortby) && $sortby=="company_type_name"){
                $order="CompanyType.company_type_name ";
                if(isset($sorttype)){
                    $order.=" ".$sorttype;
                }else{
                    $order.=" ASC";  
                }
            }
            $this->Company->bindModel(array('belongsTo'=>array(
            'CompanyType'=>array(
            'foreignKey'=>false,
            'conditions'=>'Company.company_type_id = CompanyType.id'
            )
            )));


            $companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            ##set project type data in variable

            $this->set("companydata",$companydtlarr);

            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '62'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end of sa_companylist

		    /*
        * Function name   : addcompany1()
        * Description : This function used to add company - for Super admin DASHBOARD
        * Created On      : 17-05-12
		* Modified By : Puneet
        */     
        function sa_addcompany($companyid=''){

            //Configure::write('debug', 2);    
            ##check admin session live or not
            $this->session_check_admin();
			
			$referSet = false;
			//if($this->referer() == Router::url(array('controller' => 'admins', 'action' => 'addproject'))) {
			$pos = strpos($this->referer(),"admins/addproject");
			if($pos != false) {
				$referSet = true;
			}
			
			$PageHeading = '';
			if($companyid){
				$PageHeading = 'Edit Company Detail';
			} else {
				$PageHeading = 'Add New Company Detail';
			}
			
			if($companyid && $referSet == true ){
				$PageHeading = 'Edit Owner Detail';
			}else if($referSet == true ) {
				$PageHeading = 'Add New Company Detail';
			}
			$realetedProjectsC = array();
			$realetedProjectsC = $this->projectsRealted_to_company($companyid);
			$realeted_projectsC_flag = false;
			if($referSet == true && count($realetedProjectsC) > 0) {
			
			// show "Related to projects" in contact section
				$realeted_projectsC_flag = true;
			}
			
			//print_r($realetedProjectsC);
			$this->set("realetedProjectsC",$realetedProjectsC);
			$this->set("realeted_projects_flag",$realeted_projectsC_flag);
			$this->set("PageHeading",$PageHeading);
			
            ##project id for each project
            //$projectid = $this->Session->read("sessionprojectid");
            //$project_name=$this->Session->read("projectwebsite_name_admin");  
            //$this->set('current_project_name',$project_name);
            ##import Company  model for processing
            App::import("Model", "Company");
            $this->Company =   & new Company();    
            $this->set("selectedcountry",'');
            $this->set("selectedstate",'');

            ##check empty data
            if(!empty($this->data)){

				$this->data['Company']['project_id'] = 0;
                #set the posted data
                $this->Company->set($this->data);
                #check server side validation        
                $errormsg = $this->Company->invalidFields();
                if(!$errormsg){
                    ##uploading company logo
                    if($this->data['Company']['complogo']['name'] !=''){                         
                        $filePath =  'img/uploads' ;
                        $this->File->setDestPath($filePath);

                        $file_name1 = $this->File->setFileName($this->data['Company']['complogo']['name']); 
                        $tmp1 = $this->data['Company']['complogo']['tmp_name'];
                        $fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'250x250');

                        $this->data['Company']['logo'] = $fileNamesidea;
                    }

                    $cid = "";
					 $this->data['Company']['company_name'] = trim($this->data['Company']['company_name']);
                    $cname = $this->data['Company']['company_name'];
					
                    $address1 = $this->data['Company']['address1'];
                    $country = $this->data['Company']['country'];
                    $state = $this->data['Company']['state'];
                    $city = $this->data['Company']['city'];
                    $zipcode = $this->data['Company']['zipcode'];

                    if($this->data['Company']['id']){
                        $cid = $this->data['Company']['id'];
                         // for update - check company already exist with same company name & same address, city ,state, country , zip
                        $condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."'
                        AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0'    AND  delete_status = '0' AND id !='".$cid."'";

                    }else{
                         // check company already exist with same company name & same address, city ,state, country , zip
                        $condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."'
                        AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0' AND  delete_status = '0'";
                    }    
                    ##check already exists company name
                    $ctdata = $this->Company->find('all',array("conditions"=>$condition));
                    if(!$ctdata){
                        if($this->Company->Save($this->data)){
                            if($cid){
                                $this->Session->setFlash('Company updated Successfully.','default', array('class' => 'successmsg'));
                            }else{
                                $this->Session->setFlash('Company Added Successfully.','default', array('class' => 'successmsg'));
                            }
                        }else{
                            $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));    
                        }
                        if(isset($this->data['Action']['redirectpage'])){

                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                        }else
                        {
                            $this->redirect(array('controller'=>'contacts','action'=>'sa_companylist'));
                        }
                    }else{
                        $this->Session->setFlash('Company with same name and same location already exists.','default',array('class' => 'msgTXt'));
                    }
                }
            }

            if($companyid){
                $this->Company->id = $companyid;
                $this->data = $this->Company->read();
				//pr($this->data);
                $contactname="";



                ##import Contacts  model for processing
                App::import("Model", "Contact");
                $this->Contact =   & new Contact();    
                //contact box
                ##relation with company
                $this->Contact->bindModel(array('belongsTo'=>array(
                'ContactType'=>array(
                'foreignKey'=>false,
                'conditions'=>'Contact.contact_type_id = ContactType.id'
                ),'Company'=>array(
                'foreignKey'=>false,
                'conditions'=>'Contact.company_id = Company.id'
                )
                )));

                $condition2 = "Contact.company_id = '".$companyid."' AND  Contact.delete_status = '0'";
                $condata = $this->Contact->find('all',array("conditions"=>$condition2));

                //print_r($condata);
				if($condata){
                    //$contactname = Set::combine($condata,'{n}.Contact.id' , array('%s %s','{n}.Contact.firstname', '{n}.Contact.lastname'),'{n}.Contact.jobtitle'); 
                    $contactname = Set::combine($condata, array('%s %s','{n}.Contact.firstname', '{n}.Contact.lastname'),'{n}.Contact.jobtitle'); 
                }
				//print_r($contactname);die;
				//$contactname = $condata;
				//print_r($contactname);
                //$this->data['Admins']['contacts'] = $contactname ;
                $this->set('contacts',$contactname);        
            }    

            $this->set("selectedcompanytype","");

            $this->set("selectedcompanytype",$this->data['Company']['company_type_id']);
            $this->companytypedropdown(0);

            ##country drop down
            $this->countrydroupdown();
            $this->statedroupdown();

            ##check default dropdowns

            if($this->data['Company']['country']){
                $conid = $this->data['Company']['country'];
                $this->set("selectedcountry",$conid);
                ##state drop down
                $this->statedroupdown($conid);

                if($this->data['Company']['state']>0){
                    $statid = $this->data['Company']['state'];
                    $this->set("selectedstate",$statid);                
                }
            }
            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            if ($companyid) {
                $condition = "HelpContent.id = '61'";  
            } else {
                $condition = "HelpContent.id = '60'";  
            }
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end of sa_addcompany
		/**************** 18 -05-2012 ***********************/
		 /*
        * Function name   : companylist()
        * Description : This function used to list companies of related project
        * Created On      : 18-04-12
        * Modified By	  : Puneet	
        */ 

        function projectcompanylist(){
            //Configure::write('debug', 2); 
			##check user session live or not
            $this->session_check_admin();
            $project_id = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");  
            $this->set('current_project_name',$project_name);
            if(isset($_SERVER['QUERY_STRING']))
            {
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);   
            }
            //for active menu display
            $this->set('page_url','companylist');
             # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '41'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);

            # set help condition   
            $projectDetails=$this->getprojectdetails($project_id);   
            $this->set('project',$projectDetails);            
            $project_name=$projectDetails['Project']['project_name'];
            $this->set('project_name',$project_name);
            $projectid = $project_id;
            ##fetch data from Company table for listing
			$field='';
			App::import("Model", "Company");
            $this->Company =   & new Company();
            if(isset($this->data['contacts']['searchkey']) && $this->data['contacts']['searchkey']){
                $searchkeyword = $this->data['contacts']['searchkey'];
                $condition = "Company.delete_status = '0' AND Company.project_id = '$project_id' and (Company.company_name LIKE '%".$searchkeyword."%' OR CompanyType.company_type_name  LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%')";

            }else{
                $condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
            }
            $this->Pagination->sortByClass    = 'Company'; ##initaite pagination 
            $this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
				'foreignKey'=>false,
				'conditions'=>'Company.company_type_id = CompanyType.id'
            )
            )));
            $this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));
            list($order,$limit,$page) = $this->Pagination->init($condition,$field);
            $this->Company->bindModel(array('belongsTo'=>array(
            'CompanyType'=>array(
            'foreignKey'=>false,
            'conditions'=>'Company.company_type_id = CompanyType.id'
            )
            )));
            $companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            ##set project type data in variable
            $this->set("companydata",$companydtlarr);
        }//end projectcompanylist()

		 /*
        * Function name		: addcompany()
        * Description		: This function used to add company for project
        * Created On		: 18-02-11 (02:20am)
        *
        */     

        function addcompany($companyid=''){
            //Configure::write('debug', 2);
            ##check user session live or not
            $this->session_check_admin();
            ##project id for each project
            $project_id = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");  
            $this->set('current_project_name',$project_name);
            ##import Company  model for processing
            App::import("Model", "Company");
            $this->Company =   & new Company();
           
			//for active menu display
            $this->set('page_url','editsponsordesc');
            $current_domain= $_SERVER['HTTP_HOST']; 
            $this->set('current_domain',$current_domain);
            
			# set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '46'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            
			# set help condition   
            $projectDetails=$this->getprojectdetails($project_id);    
            $this->set('project',$projectDetails);            
            $projectid = $project_id;
            $this->set('project_name',$projectDetails['Project']['project_name']);
            $this->set("selectedcountry",'');
            $this->set("selectedstate",'');
           
			##check empty data
            if(!empty($this->data)) {
                $this->data['Company']['project_id'] = $projectid;
                #set the posted data
                $this->Company->set($this->data);
                #check server side validation
                $errormsg = $this->Company->invalidFields();
                if(!$errormsg){
                    ##uploading Sponsor logo
                    if($this->data['Company']['complogo']['name'] !=''){
                        $ptname = $projectDetails['Project']['project_name'];
                        $filePath =  'img' . DS . $ptname . DS.'uploads' ;
                        $this->File->setDestPath($filePath);
                        $file_name1 = $this->File->setFileName($this->data['Company']['complogo']['name']);
                        $tmp1 = $this->data['Company']['complogo']['tmp_name'];
                        $fileNamesidea = $this->File->uploadlogo($file_name1,$tmp1,true,'250x250');
                        $this->data['Company']['logo'] = $fileNamesidea;
                    }
                    $cid = "";                    
                    $cname = $this->data['Company']['company_name'];
                    $address1 = $this->data['Company']['address1'];
                    $country = $this->data['Company']['country'];
                    $state = $this->data['Company']['state'];
                    $city = $this->data['Company']['city'];
                    $zipcode = $this->data['Company']['zipcode'];
                    if($this->data['Company']['id']){
                        $cid = $this->data['Company']['id'];
                        // for update - check company already exist with same company name & same address, city ,state, country , zip
                        $condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."'
                        AND country = '".$country."' AND zipcode = '".$zipcode."'    AND project_id = '".$projectid."'    AND  delete_status = '0' AND id !='".$cid."'";
                    }else{
                       // check company already exist with same company name & same address, city ,state, country , zip  
                       $condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."'
                        AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '".$projectid."' AND  delete_status = '0'";
                    }    
                    ##check already exists company name
                    $ctdata = $this->Company->find('all',array("conditions"=>$condition));
                    if(!$ctdata){
                        if($this->Company->Save($this->data)){
                            if($cid){
                                $this->Session->setFlash('Company updated Successfully.','default', array('class' => 'successmsg'));
                                if(isset($this->data['Action']['redirectpage'])){
                                    $sessdata=$this->Session->read('newsortingby');
                                    $this->redirect('/'.$sessdata);
                                }else{
                                    $this->redirect(array('controller'=>'contacts','action' =>'addcompany',$cid));
								}
                            }else{
                                $this->Session->setFlash('Company Added Successfully.','default', array('class' => 'successmsg'));
                                if(isset($this->data['Action']['redirectpage'])){
                                    $sessdata=$this->Session->read('newsortingby');
                                    $this->redirect('/'.$sessdata);
                                }else{
                                   $this->redirect(array('controller'=>'contacts','action' =>'addcompany'));
									}
                            }
                        }else{
                            $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));            
							}
                    }else{
                        $this->Session->setFlash('Company with same name already exists.','default',array('class' => 'msgTXt'));
                    }
                }
			}
            if($companyid){
                $this->Company->id = $companyid;
                $this->data = $this->Company->read();

                $contactname="";
                ##import Contacts  model for processing
                App::import("Model", "Contact");
                $this->Contact =   & new Contact();    
                //contact box

                ##relation with company
                $this->Contact->bindModel(array('belongsTo'=>array(
                'ContactType'=>array(
                'foreignKey'=>false,
                'conditions'=>'Contact.contact_type_id = ContactType.id'
                ),'Company'=>array(
                'foreignKey'=>false,
                'conditions'=>'Contact.company_id = Company.id'
                )
                )));
                $condition2 = "Contact.company_id = '".$companyid."' AND  Contact.delete_status = '0'";
                $condata = $this->Contact->find('all',array("conditions"=>$condition2));
                //print_r($condata); exit;
                if($condata){
                    $contactname = Set::combine($condata, '{n}.Contact.id', array('%s %s','{n}.Contact.firstname', '{n}.Contact.lastname')); 
                 }
                $this->set('contacts',$contactname);
            }
			$this->set("selectedcompanytype","");
            $this->set("selectedcompanytype",$this->data['Company']['company_type_id']);
            $this->companytypedropdown($project_id);
            ##country drop down
            $this->countrydroupdown();
            $this->statedroupdown();
            ##check default dropdowns
            if($this->data['Company']['country']){
                $conid = $this->data['Company']['country'];
                $this->set("selectedcountry",$conid);
                ##state drop down
                $this->statedroupdown($conid);
                if($this->data['Company']['state']){
                    $statid = $this->data['Company']['state'];
                    $this->set("selectedstate",$statid);
                }
            }
          $prodtl = $this->projectdetailbyid($projectid);
            $sponname = $this->getsponsornamebyprojectid($projectid);
            $this->set('sponorname',$sponname);
            $projectname = $prodtl[0]['Project']['project_name'];
            $this->set('projectname',$projectname);
        }//end addcompany();

		
		/*
        * Function name   : projectdetailbyid()
        * Description : This function used to get project detail
		*params			: projectid
        * Created On      : 18-05-12 (02:20am)
        * Modified by	:Puneet
        */     

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
        }   //end projectdetailbyid();

		 function getsponsornamebyprojectid($projectid){

            ##import coinset  model for processing
            App::import("Model", "Sponsor");
            $this->Sponsor =   & new Sponsor();    
            $coinsetname="";
            $unitcount=0;
            //Coinset box

            $condition3 = "Sponsor.project_id = '".$projectid."' AND  Sponsor.delete_status = '0'";
            $sponsordata = $this->Sponsor->find('all',array("conditions"=>$condition3));

            if($sponsordata){
                $sponsorname = $sponsordata[0]['Sponsor']['sponsor_name'];
            }

            return $sponsorname;
            exit;
        }//end

		   /*
        * Function name   : addcontacts()
        * Description : This function used to add contacts for companies
        * Created On      : 21-02-11 (10:25am)
        *
        */     

        function addcontacts($contactid='',$companyid=''){
            ##check user session live or not
            $this->session_check_admin();
            ##project id for each project
            $project_id = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");  
            $this->set('current_project_name',$project_name);
            ##import Company  model for processing
            App::import("Model", "Contact");
            $this->Contact =   & new Contact();    
            //for active menu display
            $this->set('page_url',"coinsetlist");           
			# set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '47'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);

            # set help condition       
            $projectDetails=$this->getprojectdetails($project_id);    
            $this->set('project',$projectDetails);    
            $this->set('project_name',$projectDetails['Project']['project_name']);
            $projectid=$project_id;        
            $this->set("selectedcountry",'');
            $this->set("selectedstate",'');

            ##check empty data
            if(!empty($this->data)) {
                $this->data['Contact']['project_id'] = $projectid;
                #set the posted data
                $this->Contact->set($this->data);
                #check server side validation
                $errormsg = $this->Contact->invalidFields();
                if(!$errormsg){
                    $cid = "";
                    $fname = $this->data['Contact']['firstname'];
                    $lname = $this->data['Contact']['lastname'];
                    $jobtitle = $this->data['Contact']['jobtitle'];
                    $address1 = $this->data['Contact']['address1'];
                    $country = $this->data['Contact']['country'];
                    $state = $this->data['Contact']['state'];
                    $city = $this->data['Contact']['city'];
                    $zipcode = $this->data['Contact']['zipcode'];                   

                    if($this->data['Contact']['id']){
                        $cid = $this->data['Contact']['id'];
                       // Check Contact already exists with same firstname, last name. title, address, city state, country, zip 
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '".$projectid."'    AND  delete_status = '0' AND id !='".$cid."'";
                    }else{
                        // Check Contact already exists with same firstname, last name. title, address, city state, country, zip      
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '".$projectid."' AND  delete_status = '0'";
                    }    
                    ##check already exists company name
                    $ctdata = $this->Contact->find('all',array("conditions"=>$condition));
                    if(!$ctdata){
                       if($this->Contact->Save($this->data)){
                            if($cid){
                                $this->Session->setFlash('Contact updated Successfully.','default', array('class' => 'successmsg'));
                                if(isset($this->data['Action']['redirectpage'])){
                                    $sessdata=$this->Session->read('newsortingby');
                                    $this->redirect('/'.$sessdata);
                                }else{
                                    $this->redirect(array('controller'=>'contacts','action'=>'addcontacts',$cid));
                                }
                            }else{
                                $this->Session->setFlash('Contact Added Successfully.','default', array('class' => 'successmsg'));
                                if(isset($this->data['Action']['redirectpage'])){
                                    $sessdata=$this->Session->read('newsortingby');
                                    $this->redirect('/'.$sessdata);
                                }else{
                                     $this->redirect(array('controller'=>'contacts','action'=>'addcontacts'));
                                }
                            }
                        }else{
                            $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));    
                        }
						$this->redirect(array('controller'=>'contacts','action'=>'contactlist'));
                    }else{
                        $this->Session->setFlash('Contact with same name already exists.','default',array('class' => 'msgTXt'));
                    }
                }
            }
			if($contactid && $contactid !=='addcontact'){
                $this->Contact->id = $contactid;
                $this->data = $this->Contact->read();
//				echo '<pre>';print_r($this->data);
            }
            if($companyid && $contactid =='addcontact'){
                $this->set("selectedcompany",$companyid);
            }else{
                $this->set("selectedcompany","");
                $this->set("selectedcompany",$this->data['Contact']['company_id']);
            }
            $this->set("selectedcontacttype","");
            $this->set("selectedcontacttype",$this->data['Contact']['contact_type_id']);
            $this->contacttypedropdown($projectid);
            $this->companydropdown($projectid);
            ##country drop down
            $this->countrydroupdown();
            $this->statedroupdown();
            ##check default dropdowns
            if($this->data['Contact']['country']){
                $conid = $this->data['Contact']['country'];
                $this->set("selectedcountry",$conid);
                ##state drop down
                $this->statedroupdown($conid);
                if($this->data['Contact']['state']){
					$statid = $this->data['Contact']['state'];
                    $this->set("selectedstate",$statid);
                }
            }
        }//end addcontacts

		  /*
        * Function name   : contactlist()
        * Description : This function used to list contacts of related companies
        * Created On  : 18-04-12
        * Modified By : Puneet
        */ 

        function contactlist(){
            //Configure::write('debug', 2);
            ##check user session live or not
            $this->session_check_admin();
            $project_id = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");  
            $this->set('current_project_name',$project_name);
            if(isset($_SERVER['QUERY_STRING']))            {
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);    
            }
            //for active menu display
            $this->set('page_url',"coinsetlist");
            $project_name=$this->Session->read("projectwebsite_name_admin"); 
            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '40'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition   
            App::import("Model", "Contact");
            $this->Contact =   & new Contact();    
            $projectDetails=$this->getprojectdetails($project_id);    
            $this->set('project',$projectDetails);    
            $this->set('project_name',$projectDetails['Project']['project_name']);
            $projectid=$project_id;
			
			##fetch data from Contact table for listing
            $field='';
            if(isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']=='company_name'){
                $this->Pagination->sortByClass    = 'Company'; ##initaite pagination
            }else if(isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']=='contact_type_name'){
                    $this->Pagination->sortByClass    = 'ContactType'; ##initaite pagination
                }else{
                    $this->Pagination->sortByClass    = 'Contact'; ##initaite pagination 
				}
            ##checking search key
            if(isset($this->data['contacts']['searchkey']) && $this->data['contacts']['searchkey']){
                $searchkeyword = $this->data['contacts']['searchkey'];
                $condition = "Contact.delete_status = '0' AND Contact.project_id = '$project_id' and (Contact.firstname LIKE '%".$searchkeyword."%' OR Contact.lastname  LIKE '%".$searchkeyword."%' OR Contact.mobile  LIKE '%".$searchkeyword."%' OR Contact.email LIKE '%".$searchkeyword."%' OR Company.company_name LIKE '%".$searchkeyword."%' OR ContactType.contact_type_name LIKE '%".$searchkeyword."%')";
            }else{
                $condition = "Contact.delete_status = '0' AND Contact.project_id = '$projectid'";
            }
            ##relation ship with contact type and company table with contacts

            $this->Contact->bindModel(array('belongsTo'=>array(
            'ContactType'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.contact_type_id = ContactType.id'
            ),'Company'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.company_id = Company.id'
            )
            )));
            $this->Pagination->total= count($this->Contact->find('all',array("conditions"=>$condition)));
            list($order,$limit,$page) = $this->Pagination->init($condition,$field);
            $this->Contact->bindModel(array('belongsTo'=>array(
            'ContactType'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.contact_type_id = ContactType.id'
            ),'Company'=>array(
            'foreignKey'=>false,
            'conditions'=>'Contact.company_id = Company.id'
            )
            )));
            $contactdtlarr = $this->Contact->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            ##set project type data in variable
            $this->set("contactdata",$contactdtlarr);
        }//end contactlist();

		/*
        * Function name   : projectcompanytypes()
        * Description : This function used to list all company list of related project
        * Created On      : 6th Dec 2011 - Project Company and contact type Enhancemnt - QUAD(UA)
        *
        */ 

        function projectcompanytypes(){
            //STEP : Check Session
            $this->session_check_admin();            
            //STEP : Get session project id and its details
            $project_id = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");  
            $this->set('current_project_name',$project_name);
            $projectDetails=$this->getprojectdetails($project_id);    
            $this->set('project',$projectDetails);             
            //for active menu display
            $this->set('page_url',"projectcompanytypes");            
            //STEP : Get Query string
            if(isset($_SERVER['QUERY_STRING']))
			{
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);   
            }                      
             //STEP :    Impost company type model
            App::import("Model", "CompanyType");
            $this->CompanyType =   & new CompanyType();                
             //STEP :    fetch data from project type table for listing
            $field='';
            $condition = "delete_status = '0' and project_id='".$project_id."' ";            
            if(isset($this->data['contacts']['searchkey']) && $this->data['contacts']['searchkey']){
                $searchkeyword = $this->data['contacts']['searchkey'];
                $condition .= "  and (company_type_name LIKE '%".$searchkeyword."%'  )";
            }
             //STEP :    Pagination
            $this->Pagination->sortByClass    = 'CompanyType'; ##initaite pagination 
            $this->Pagination->total= count($this->CompanyType->find('all',array("conditions"=>$condition)));
            list($order,$limit,$page) = $this->Pagination->init($condition,$field);            
             //STEP :    Get company type records
            $companytypedata = $this->CompanyType->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            $this->set("companytypedata",$companytypedata);
            //STEP :    set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '62'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end projectcompanytype();

		 /**
        * Fucntion to add/ edit company type to project
        * 
        * @param mixed $companytypeid
        */
        function projectcompanytypes_add($companytypeid='', $returnurl=""){
             //STEP : Check admin session
            $this->session_check_admin(); 
            //STEP : Chekc project session and get project details
            $projectid = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");
            $projectDetails=$this->getprojectdetails($projectid);                    
            // STEP : import company type model for processing
            App::import("Model", "CompanyType");
            $this->CompanyType =   & new CompanyType();            
            // STEP :  If isset data , save contact type
            if(!empty($this->data)) {   
				//pr($this->data);
               //$returnurl=$this->data['Admins']['returnurl'];        
                $ctid= $this->data['CompanyType']['id'];  
                #set the posted data
                $this->CompanyType->set($this->data);
                #check server side validation
                $this->CompanyType->invalidFields();
                $ptname = $this->data['CompanyType']['company_type_name'];

                if($ctid > 0)  {
                    $condition = "company_type_name = '".$ptname."'    AND  delete_status = '0' and project_id='".$projectid."' and id!='".$ctid."'";
                    $ptdata = $this->CompanyType->find('all',array("conditions"=>$condition));
                }else{
                   $condition = "company_type_name = '".$ptname."'    AND  delete_status = '0' and project_id='".$projectid."'";
                   $ptdata = $this->CompanyType->find('all',array("conditions"=>$condition)); 
                }
                if(!$ptdata){
                    $this->data['CompanyType']['project_id']=$projectid; 
                    #save data in contact type table
                    if($this->CompanyType->Save($this->data['CompanyType'])){
                          if($returnurl!=""){  // if its pop-up window from addformtype
                          //   $gotourl=str_replace("_id_", "/", $returnurl);
                             $this->set("closeit","yes");
                          }else{
                               if($ctid > 0){
                                    $this->Session->setFlash('Company Type updated Successfully.','default', array('class' => 'successmsg'));
                                    if(isset($this->data['Action']['redirectpage'])){
                                        $this->redirect(array('controller'=>'contacts','action'=>'projectcompanytypes'));
                                    }else{
										 $this->redirect(array('controller'=>'contacts','action'=>'projectcompanytypes_add',$ctid));
									}
                               }else{
                                    $this->Session->setFlash('Company Type Added Successfully.','default', array('class' => 'successmsg'));
                                    if(isset($this->data['Action']['redirectpage'])){

										  $this->redirect(array('controller'=>'contacts','action'=>'projectcompanytypes'));
                                    }else{
										 $this->redirect(array('controller'=>'contacts','action'=>'projectcompanytypes_add'));
                                    }
								}
                          }

                    }else{
                        $this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
                          if(isset($this->data['Action']['redirectpage'])){
                                $sessdata=$this->Session->read('newsortingby');
                                $this->redirect('/'.$sessdata);
                            }else{
                                $this->redirect(array('controller'=>'contacts','action'=>'projectcompanytypes_add'));
                            }                         
                    }

                }else{
                    $this->Session->setFlash('Contact Type with same name already exists.','default',array('class' => 'msgTXt'));
                      if(isset($this->data['Action']['redirectpage'])){
                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                        }else{
                            $this->redirect(array('controller'=>'contacts','action'=>'projectcompanytypes_add'));
                        }
                }              
            }
            //STEP : if $contacttypeid is not 0 then read data
            if($companytypeid){
                $this->CompanyType->id = $companytypeid;
                $this->set('companytypeid', $companytypeid);  
                $this->set('pageactionname', "Edit");    
                $this->data = $this->CompanyType->read();
            }else{
                $this->set('companytypeid', 0); 
                $this->set('pageactionname', "Add"); 
            }            
            //STEP : Set Variables
            $this->set('page_url','projectcontacttypes');
            $this->set('current_project_name',$project_name); 
            $this->set('project',$projectDetails);            
            $this->set('project_name',$projectDetails['Project']['project_name']);        

            //STEP : Set Help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '57'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition            
            $this->set("returnurl",$returnurl);   
        }//end projectcompanytypes_add();

		/**
        * Function name : projectcontacttypes()
        * Description : This function used to dispaly list of all contact types of related project
        * Created On : 6th Dec 2011 (QUAD-U)
        *  
        */
        function projectcontacttypes(){
            //STEP : Check admin session
            $this->session_check_admin(); 
            //STEP : Chekc project session and get project details
            $projectid = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");
            $projectDetails=$this->getprojectdetails($projectid);    

            //STEP : Get contact types data for selected project
            // STEP : IMPORT Contact TYpe Model
            App::import("Model", "ContactType");
            $this->ContactType =   & new ContactType(); 

            // STEP : Get Query String for sorting
            if(isset($_SERVER['QUERY_STRING']))
            {
                $this->Session->delete("newsortingby");
                $strloc=strpos($_SERVER['QUERY_STRING'],'=');
                $strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);    
                $this->Session->write("newsortingby",$strdata);    

            }
            // STEP : Set filter condition  
            $field='';
            $condition = "delete_status = '0' and project_id='".$projectid."'";

            // STEP : Add Search Key condition to filter 
            if(isset($this->data['contacts']['searchkey']) && $this->data['contacts']['searchkey']){
                $searchkeyword = $this->data['contacts']['searchkey'];
                $condition .= "  and (contact_type_name LIKE '%".$searchkeyword."%'  )";
            }

            // STEP : Pagination
            $this->Pagination->sortByClass    = 'ContactType'; ##initaite pagination 
            $this->Pagination->total= count($this->ContactType->find('all',array("conditions"=>$condition)));
            list($order,$limit,$page) = $this->Pagination->init($condition,$field);

            // STEP : Get all contact types records for project
            $contacttypedata = $this->ContactType->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));  

            // STEP : Help Content
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '39'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);

            //STEP : Set Variables
            $this->set('page_url','projectcontacttypes');
            $this->set('current_project_name',$project_name); 
            $this->set('project',$projectDetails);            
            $this->set('project_name',$projectDetails['Project']['project_name']);    
            $this->set("contacttypedata",$contacttypedata); 
        }//end projectcontacttypes();

		 /**
        * Function to add or edit contact type for proejct
        *   
        * @param mixed $contacttypeid
        */
        function projectcontacttypes_add($contacttypeid=0, $returnurl=""){ 
            //STEP : Check admin session
            $this->session_check_admin(); 

            //STEP : Chekc project session and get project details
            $projectid = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin");
            $projectDetails=$this->getprojectdetails($projectid);    

            // STEP : Import Contact Type Model
            App::import("Model", "ContactType");
            $this->ContactType =   & new ContactType();

            // STEP :  If isset data , save contact type
            if(!empty($this->data)) {  
             //	$returnurl=$this->data['Admins']['returnurl'];       
                $ctid= $this->data['ContactType']['id'];  
                #set the posted data
                $this->ContactType->set($this->data);

                #check server side validation
                $this->ContactType->invalidFields();
                $ptname = $this->data['ContactType']['contact_type_name'];

                if($ctid > 0)  {
                    $condition = "contact_type_name = '".$ptname."'    AND  delete_status = '0' and project_id='".$projectid."' and id!='".$ctid."'";
                    $ptdata = $this->ContactType->find('all',array("conditions"=>$condition));
                }else{
                   $condition = "contact_type_name = '".$ptname."'    AND  delete_status = '0' and project_id='".$projectid."'";
                   $ptdata = $this->ContactType->find('all',array("conditions"=>$condition)); 
                }

                if(!$ptdata){

                    $this->data['ContactType']['project_id']=$projectid; 
                    #save data in contact type table
                    if($this->ContactType->Save($this->data['ContactType'])){
                           if($returnurl!=""){  // if its pop-up window from addformtype
                          //   $gotourl=str_replace("_id_", "/", $returnurl);
                             $this->set("closeit","yes");
                          }else{
                                if($ctid > 0){

                                    $this->Session->setFlash('Contact Type updated Successfully.','default', array('class' => 'successmsg'));

                                    if(isset($this->data['Action']['redirectpage'])){

                                        $this->redirect(array('controller'=>'contacts','action'=>'projectcontacttypes'));

                                    }else{

                                        $this->redirect(array('controller'=>'contacts','action'=>'projectcontacttypes_add',$ctid));

                                    }

                                }else{

                                        $this->Session->setFlash('Contact Type Added Successfully.','default', array('class' => 'successmsg'));

                                        if(isset($this->data['Action']['redirectpage'])){

                                            $this->redirect(array('controller'=>'contacts','action'=>'projectcontacttypes'));

                                        }else{

                                              $this->redirect(array('controller'=>'contacts','action'=>'projectcontacttypes_add'));
                                        }
									}
								}                          
                    }else{
                        $this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
                         if(isset($this->data['Action']['redirectpage'])){
                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                         }else{
                               $this->redirect(array('controller'=>'contacts','action'=>'projectcontacttypes_add'));
                         } 
                    }

                }else{
                    $this->Session->setFlash('Contact Type with same name already exists.','default',array('class' => 'msgTXt'));
                     if(isset($this->data['Action']['redirectpage'])){
                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                     }else{
                          $this->redirect(array('controller'=>'contacts','action'=>'projectcontacttypes_add'));
                     } 
                }         
            }
            //STEP : if $contacttypeid is not 0 then read data
            if($contacttypeid){
                $this->ContactType->id = $contacttypeid;
                $this->set('contacttypeid', $contacttypeid);  
                $this->set('pageactionname', "Edit");    
                $this->data = $this->ContactType->read();
            }else{
                $this->set('contacttypeid', 0); 
                $this->set('pageactionname', "Add"); 
            }            
            //STEP : Set Variables
            $this->set('page_url','projectcontacttypes');
            $this->set('current_project_name',$project_name); 
            $this->set('project',$projectDetails);            
            $this->set('project_name',$projectDetails['Project']['project_name']);    
            $this->set("contacttypeid",$contacttypeid); 

            //STEP : Set Help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '57'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
             $this->set("returnurl",$returnurl);      

        }//end projectcontacttypes_add();
		
		function getcontact_projectLead_ajax() {
			if(isset($_REQUEST['id'])) {
				$id = ($_REQUEST['id'])?$_REQUEST['id']:null;
				
				##import Contacts  model for processing
				App::import("Model", "ContactType");
				$this->ContactType =   & new ContactType();
				$cdata = $this->ContactType->findById($id); 
				if(!empty($cdata)) {
				echo $cdata['ContactType']['project_lead'];
				} else {
				echo 0;
				}
			}
			exit(0);
		}

           function addlos($contactid='',$companyid=''){
            ##check admin session live or not
            $this->session_check_admin();
            ##import Company  model for processing
            $referSet = false;  
            //echo $this->referer();
            //echo "<br>";
            //echo $this->referer(null, true);
            //if($this->referer() == Router::url(array('controller' => 'admins', 'action' => 'addproject'))) {
            //if($this->referer() == "/admins/editproject/") {
            
            $pos = strpos($this->referer(),"admins/editproject/");
            $referelProject_id = '';
            if($pos != false) {
                $referSet = true;
                $referelProject_id = end((explode('/', $this->referer())));
            }
            //echo 'af g  '.$referelProject_id;
            $PageHeading = '';
            if($contactid){
                $PageHeading = 'Edit Contact Detail';
            } else {
                $PageHeading = 'Add New Contact';
            }
            
            if($contactid && $referSet == true ){
                $PageHeading = 'Edit Project Owner Contact';
            }else if($referSet == true ) {
                $PageHeading = 'Add Project Owner Contact';
            }
            
            $realetedProjects = array();
            $realetedProjects = $this->projectsRealted_to_contact($contactid);
            $realeted_projects_flag = false;
            if($referSet == true && count($realetedProjects) >= 0) {
            
            // show "Related to projects" in contact section
                $realeted_projects_flag = true;
            }
            //print_r($realetedProjectsC);
            $this->set("referelProject_id",$referelProject_id);
            
            $this->set("realetedProjects",$realetedProjects);
            $this->set("realeted_projects_flag",$realeted_projects_flag);
            $this->set("PageHeading",$PageHeading);
            
            App::import("Model", "Contact");
            $this->Contact =   & new Contact();    
            $this->set("selectedcountry",'');
            $this->set("selectedstate",'');
             // STEP SUBSCRIPTION TYPE ARRAY
            $userSubscriptionTypes= $this->getSubscriptionTypesArray();
            $this->set("userSubscriptionTypes",$userSubscriptionTypes);
            ##check empty data
            if(!empty($this->data)) {
               // echo "<pre>";
               // print_r($this->data);die();
                 $this->data['Contact']['project_id'] = 0;
                #set the posted data
                $this->Contact->set($this->data);
                #check server side validation
                $errormsg = $this->Contact->invalidFields();
                if(!$errormsg){
                    $cid = "";
                    $fname = $this->data['Contact']['firstname'];
                    $lname = $this->data['Contact']['lastname'];
                    $jobtitle = $this->data['Contact']['jobtitle'];
                    $address1 = $this->data['Contact']['address1'];
                    $country = $this->data['Contact']['country'];
                    $state = $this->data['Contact']['state'];
                    $city = $this->data['Contact']['city'];
                    $zipcode = $this->data['Contact']['zipcode'];

                    if($this->data['Contact']['id']){
                        $cid = $this->data['Contact']['id'];
                        // Check Contact already exists with same firstname, last name. title, address, city state, country, zip 
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0'    AND  delete_status = '0' AND id !='".$cid."'";

                    }else{
                        // Check Contact already exists with same firstname, last name. title, address, city state, country, zip 
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0' AND  delete_status = '0'";
                    }    
                    ##check already exists company name
                    $ctdata = $this->Contact->find('all',array("conditions"=>$condition));
                    $this->data['Contact']['company_id'] = 0;
                    if(!$ctdata){
                        //echo "<pre>";print_r($this->data);die();
                        if($this->Contact->Save($this->data)){
                            if($cid){
                                $this->Session->setFlash('Contact updated Successfully.','default', array('class' => 'successmsg'));
                            }else{
                                $this->Session->setFlash('Contact Added Successfully.','default', array('class' => 'successmsg'));
                            }
                           
                        $image = "";
                        if(isset($this->data['Contact']['avatar']['name'])&&$this->data['Contact']['avatar']['name']!="")
                        {
                            if($this->data['Contact']['avatar']['type']=="image/jpeg"||$this->data['Contact']['avatar']['type']=="image/jpg"||$this->data['Contact']['avatar']['type']=="image/png"||$this->data['Video']['video_file']['type']=="image/gif")
                            {
                                $fileName = date('Y-m-d-His').$this->data['Contact']['avatar']['name'];
                                $full_url = WWW_ROOT.'uploads/'.$fileName;
                                move_uploaded_file($this->data['Contact']['avatar']['tmp_name'], $full_url);
                                $image   =   $fileName; 
                            }
                        }





                            App::import("Model", "ContactLo");
                            $this->ContactLo =   & new ContactLo();
                            $emailSubscription = "";
                            if(isset($this->data['Contact']['subscription_type_id'])&&!empty($this->data['Contact']['subscription_type_id']))
                            {
                                    for($i = 0; $i<count($this->data['Contact']['subscription_type_id']);$i++)
                                     {
                                        if($i==0)
                                        {
                                                 $emailSubscription = $this->data['Contact']['subscription_type_id'][$i];
                                        }
                                        else
                                        {
                                                 $emailSubscription .= ",".$this->data['Contact']['subscription_type_id'][$i];
                                        }
                                     }   
                                   
                            }
                            $lo['id'] = '';
                            $lo['contact_id'] = $this->Contact->id;
                            $lo['address2'] = $this->data['Contact']['address2'];
                            $lo['facebook'] = $this->data['Contact']['facebook'];
                            $lo['twitter'] = $this->data['Contact']['twitter'];
                            $lo['google'] = $this->data['Contact']['google'];
                            $lo['linkedin'] = $this->data['Contact']['linkedin'];
                            $lo['pinterest'] = $this->data['Contact']['pinterest'];
                            $lo['plevel'] = $this->data['Contact']['production_level'];
                            $lo['mnls'] = $this->data['Contact']['nmls'];
                            $lo['image'] = $image;
                            $lo['email_subscription'] = $emailSubscription;
                            $lo['jobtype'] = $this->data['Contact']['jobtype'];


                            $this->ContactLo->Save($lo);
                             $this->redirect(array('controller'=>'relationships','action'=>'los'));
                            
                        }else{
                            $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));    
                        }

                        if(isset($this->data['Action']['redirectpage'])){

                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                        }

                    }else{
                        $this->Session->setFlash('Contact with same name and location already exists.','default',array('class' => 'msgTXt'));
                    }
                }
            }
            if($contactid && $contactid !=='addcontact'){

                $this->Contact->id = $contactid;
                $this->data = $this->Contact->read();   
                
                $projectid=$this->data['Contact']['project_id'];
              }else{
                    $projectid=0;
              }
            


            ##country drop down
            $this->countrydroupdown();
            $this->statedroupdown();

            ##check default dropdowns        
            if($this->data['Contact']['country']){
                $conid = $this->data['Contact']['country'];
                $this->set("selectedcountry",$conid);
                ##state drop down
                $this->statedroupdown($conid);
                if($this->data['Contact']['state']){
                    $statid = $this->data['Contact']['state'];
                    $this->set("selectedstate",$statid);

                }
            }

            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '64'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata); 
        }

         function editlos($contactid='',$companyid=''){
             ##check admin session live or not
            $this->session_check_admin();
            ##import Company  model for processing
            $referSet = false;  
            //echo $this->referer();
            //echo "<br>";
            //echo $this->referer(null, true);
            //if($this->referer() == Router::url(array('controller' => 'admins', 'action' => 'addproject'))) {
            //if($this->referer() == "/admins/editproject/") {
            
            $pos = strpos($this->referer(),"admins/editproject/");
            $referelProject_id = '';
            if($pos != false) {
                $referSet = true;
                $referelProject_id = end((explode('/', $this->referer())));
            }
            //echo 'af g  '.$referelProject_id;
            $PageHeading = '';
            if($contactid){
                $PageHeading = 'Edit Contact Detail';
            } else {
                $PageHeading = 'Add New Contact';
            }
            
            if($contactid && $referSet == true ){
                $PageHeading = 'Edit Project Owner Contact';
            }else if($referSet == true ) {
                $PageHeading = 'Add Project Owner Contact';
            }
            
            $realetedProjects = array();
            $realetedProjects = $this->projectsRealted_to_contact($contactid);
            $realeted_projects_flag = false;
            if($referSet == true && count($realetedProjects) >= 0) {
            
            // show "Related to projects" in contact section
                $realeted_projects_flag = true;
            }
            //print_r($realetedProjectsC);
            $this->set("referelProject_id",$referelProject_id);
            
            $this->set("realetedProjects",$realetedProjects);
            $this->set("realeted_projects_flag",$realeted_projects_flag);
            $this->set("PageHeading",$PageHeading);
            
            App::import("Model", "Contact");
            $this->Contact =   & new Contact();    
            $this->set("selectedcountry",'');
            $this->set("selectedstate",'');
             // STEP SUBSCRIPTION TYPE ARRAY
            $userSubscriptionTypes= $this->getSubscriptionTypesArray();
            $this->set("userSubscriptionTypes",$userSubscriptionTypes);
            ##check empty data
            if(!empty($this->data)) {
               // echo "<pre>";
               // print_r($this->data);die();
                 $this->data['Contact']['project_id'] = 0;
                #set the posted data
                $this->Contact->set($this->data);
                #check server side validation
                $errormsg = $this->Contact->invalidFields();
                if(!$errormsg){
                    $cid = "";
                    $fname = $this->data['Contact']['firstname'];
                    $lname = $this->data['Contact']['lastname'];
                    $jobtitle = $this->data['Contact']['jobtitle'];
                    $address1 = $this->data['Contact']['address1'];
                    $country = $this->data['Contact']['country'];
                    $state = $this->data['Contact']['state'];
                    $city = $this->data['Contact']['city'];
                    $zipcode = $this->data['Contact']['zipcode'];

                    if($this->data['Contact']['id']){
                        $cid = $this->data['Contact']['id'];
                        // Check Contact already exists with same firstname, last name. title, address, city state, country, zip 
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0'    AND  delete_status = '0' AND id !='".$cid."'";

                    }else{
                        // Check Contact already exists with same firstname, last name. title, address, city state, country, zip 
                        $condition = "firstname = '".$fname."' AND lastname = '".$lname."' AND jobtitle = '".$jobtitle."' AND address1 = '".$address1."' AND city = '".$city."'  
                        AND state = '".$state."'  AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '0' AND  delete_status = '0'";
                    }    
                    ##check already exists company name
                    $ctdata = $this->Contact->find('all',array("conditions"=>$condition));
                    $this->data['Contact']['company_id'] = 0;
                    if(!$ctdata){
                        //echo "<pre>";print_r($this->data);die();
                        if($this->Contact->Save($this->data)){
                            if($cid){
                                $this->Session->setFlash('Contact updated Successfully.','default', array('class' => 'successmsg'));
                            }else{
                                $this->Session->setFlash('Contact Added Successfully.','default', array('class' => 'successmsg'));
                            }
                           
                        $image = "";
                        if(isset($this->data['Contact']['avatar']['name'])&&$this->data['Contact']['avatar']['name']!="")
                        {
                            if($this->data['Contact']['avatar']['type']=="image/jpeg"||$this->data['Contact']['avatar']['type']=="image/jpg"||$this->data['Contact']['avatar']['type']=="image/png"||$this->data['Video']['video_file']['type']=="image/gif")
                            {
                                $fileName = date('Y-m-d-His').$this->data['Contact']['avatar']['name'];
                                $full_url = WWW_ROOT.'uploads/'.$fileName;
                                move_uploaded_file($this->data['Contact']['avatar']['tmp_name'], $full_url);
                                $lo['image'] = $fileName; 
                            }
                        }





                            App::import("Model", "ContactLo");
                            $this->ContactLo =   & new ContactLo();
                            $emailSubscription = "";
                            if(isset($this->data['Contact']['subscription_type_id'])&&!empty($this->data['Contact']['subscription_type_id']))
                            {
                                    for($i = 0; $i<count($this->data['Contact']['subscription_type_id']);$i++)
                                     {
                                        if($i==0)
                                        {
                                                 $emailSubscription = $this->data['Contact']['subscription_type_id'][$i];
                                        }
                                        else
                                        {
                                                 $emailSubscription .= ",".$this->data['Contact']['subscription_type_id'][$i];
                                        }
                                     }   
                                    $lo['email_subscription'] = $emailSubscription;
                            }
                            $lo['id'] = $this->data['Contact']['ContactLo_id'];
                            $lo['contact_id'] = $this->data['Contact']['id'];
                            $lo['address2'] = $this->data['Contact']['address2'];
                            $lo['facebook'] = $this->data['Contact']['facebook'];
                            $lo['twitter'] = $this->data['Contact']['twitter'];
                            $lo['google'] = $this->data['Contact']['google'];
                            $lo['linkedin'] = $this->data['Contact']['linkedin'];
                            $lo['pinterest'] = $this->data['Contact']['pinterest'];
                            $lo['plevel'] = $this->data['Contact']['production_level'];
                            $lo['mnls'] = $this->data['Contact']['nmls'];
                            $lo['jobtype'] = $this->data['Contact']['jobtype'];



                            $this->ContactLo->Save($lo);
                             $this->redirect(array('controller'=>'relationships','action'=>'los'));
                            
                        }else{
                            $this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));    
                        }

                        if(isset($this->data['Action']['redirectpage'])){

                            $sessdata=$this->Session->read('newsortingby');
                            $this->redirect('/'.$sessdata);
                        }

                    }else{
                        $this->Session->setFlash('Contact with same name and location already exists.','default',array('class' => 'msgTXt'));
                    }
                }
            }
            if($contactid && $contactid !=='addcontact'){

                $this->Contact->id = $contactid;
                $this->data = $this->Contact->read(); 

                App::import("Model", "ContactLo");
                $this->ContactLo =   & new ContactLo();
                $relatedDio = $this->ContactLo->find('first',array('conditions' => array('ContactLo.contact_id ' => $contactid)));
                $this->data['Contact']['image'] = $relatedDio['ContactLo']['image'];
                $this->data['Contact']['address2'] = $relatedDio['ContactLo']['address2'];
                $this->data['Contact']['production_level'] = $relatedDio['ContactLo']['plevel']; 
                $this->data['Contact']['facebook'] = $relatedDio['ContactLo']['facebook'];                               
                $this->data['Contact']['twitter'] = $relatedDio['ContactLo']['twitter'];
                $this->data['Contact']['google'] = $relatedDio['ContactLo']['google'];
                $this->data['Contact']['linkedin'] = $relatedDio['ContactLo']['linkedin']; 
                $this->data['Contact']['pinterest'] = $relatedDio['ContactLo']['pinterest'];
                $this->data['Contact']['nmls'] = $relatedDio['ContactLo']['mnls'];
                $this->data['Contact']['email_subscription'] = $relatedDio['ContactLo']['email_subscription']; 
                $this->data['Contact']['ContactLo_id'] = $relatedDio['ContactLo']['id']; 
                $this->data['Contact']['jobtype'] = $relatedDio['ContactLo']['jobtype'];             
               /*echo "<pre>";
                print_r($this->data);
                print_r($relatedDio);*/
                $projectid=$this->data['Contact']['project_id'];
              }else{
                    $projectid=0;
              }
            


            ##country drop down
            $this->countrydroupdown();
            $this->statedroupdown();

            ##check default dropdowns        
            if($this->data['Contact']['country']){
                $conid = $this->data['Contact']['country'];
                $this->set("selectedcountry",$conid);
                ##state drop down
                $this->statedroupdown($conid);
                if($this->data['Contact']['state']){
                    $statid = $this->data['Contact']['state'];
                    $this->set("selectedstate",$statid);

                }
            }

            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '64'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata); 
        }

function changestatuslo($recid,$modelname,$status,$methodname,$action='cngstatus',$othermodel='',$otherid='',$param=''){

            ##check user session live or not
            $this->session_check_admin();
            ##import dynamic model for processing
            App::import("Model", $modelname);
            $this->$modelname =   & new $modelname(); 
            ##set the record for updation 
             $allcompanyid=str_replace('*', ',',$recid);            
             $cidArr = explode(',',$allcompanyid);
             //get company id exist in project_owner table or not
            ##import ProjectOwner model for processing
            
                if($modelname=='Company'){
                    App::import("Model", "ProjectOwner");
                    $this->ProjectOwner =   & new ProjectOwner(); 
                    $importModalName="ProjectOwner";
                    $fieldName="owner_id";
                     $projectOwnerdatas = $this->ProjectOwner->find('all', array('conditions' => array('owner_id' =>$cidArr ),'group' =>array('ProjectOwner.owner_id'),'fields'=>'ProjectOwner.owner_id'));
                }
                else{
                
                    App::import("Model", "Project");
                    $this->Project =   & new Project();
                    $importModalName="Project";
                    $fieldName="project_contact_admin_id";
                     $projectOwnerdatas = $this->Project->find('all', array('conditions' => array('delete_status'=>'0','active_status'=>'1','project_contact_admin_id' =>$cidArr ),'group' =>array('Project.project_contact_admin_id'),'fields'=>'Project.project_contact_admin_id'));              
                } 
                 if(!empty($projectOwnerdatas) && count($projectOwnerdatas) > 0 ){
//                     echo "dfdd";exit;
                       $projectOwnerArr = array();
                       foreach($projectOwnerdatas as $projectOwnerdata){
                          $projectOwnerArr[] =  $projectOwnerdata[$importModalName][$fieldName];
                       }
                    $diffArr = array_diff($cidArr,$projectOwnerArr);
                    $commonArrValue=array_intersect($cidArr,$projectOwnerArr);
                    $commonValueStr=implode(',',$commonArrValue);
                    //get common value in array
                    $res = Set::enum('yes', array('no' => 0, 'yes' => 1));
 
                    $i=$this->$modelname->updateAll(array('delete_status'=>"'".$res."'"), array('id'=>$diffArr));
                    //die('ddd');
                    if($i){
                        $this->Session->setFlash("Database updated successfully and you can not delete record id $commonValueStr",'default', array('class' => 'successmsg'));
                    }
                    if(count($diffArr)==0){
                        $this->Session->setFlash("You can not delete this recored.",'default', array('class' => 'successmsg'));
                    }
                 }else{              
                     
                      $allid=str_replace('*', ' or id = ',$recid);  
                      $where="id=$allid";        
                     if(count(explode('*',$recid))==1){
                         $this->data["$modelname"]['id'] = $recid;
                     }
                     $res = Set::enum('yes', array('no' => 0, 'yes' => 1));
                     $i=$this->$modelname->updateAll(array('delete_status'=>"'".$res."'"),$where);
                     if($i){
                         $this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));
                    }
                 }
      

            //$methodname="admins/".$methodname;exit;
             $this->redirect(array('controller'=>'relationships','action'=>'los'));

        }//end of changestatus()

	}
?>