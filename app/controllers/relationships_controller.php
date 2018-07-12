<?php
/*
 *created by	   : Puneet
*Project		   :-  Image coin website
* Controller Name  :-  setups_contoller.php
* Created  On      :-  20-04-12
*/
class RelationshipsController extends AppController
{

	var $name = 'relationships';
	//var $uses = 'Setup';
	var $layout = 'new_admin_layout';
	var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
	var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
	var $uses     = array('Admin', 'Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term','CommunicationTask','EmailTemplate' ,'Link','LinkAddress','Placement','Group','Video','History','HistoryClick','Company','CompanyToCategory','OfferToCategory','NonProfitType','CompanyType', 'RelatedProject', 'RelatedNonProfit','ProspectNonProfit','CompanyToContact','RelatedProject');
	
	

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

	public function index()
	{
		$this->session_check_admin();
		$projectid = '1';
	}
	public function contacts()
	{
		$this->session_check_admin();
		$projectid = '1';
	}
	public function customers()
	{
		$this->session_check_admin();
		$projectid = '1';
		
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
            if(isset($this->data['Relationship']['searchkey']) && $this->data['Relationship']['searchkey']){
                $searchkeyword = $this->data['Relationship']['searchkey'];
                $condition .= "  and (Contact.firstname LIKE '%".$searchkeyword."%' OR Contact.lastname LIKE '%".$searchkeyword."%' OR Contact.email LIKE '%".$searchkeyword."%' OR ContactType.contact_type_name LIKE '%".$searchkeyword."%' OR Contact.mobile LIKE '%".$searchkeyword."%'  )";
            }

            if(isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']=='company_name'){
                $this->Pagination->sortByClass    = 'Company'; ##initaite pagination
            }
            else if(isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']=='company_type')
            {
            	 $this->Pagination->sortByClass    = 'Company'; ##initaite pagination
            }	
            else if(isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']=='contact_type_name'){
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
            $this->set("contactdata",$contactdtlarr);
            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '63'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition


	}
	public function prospects()
	{
		$this->session_check_admin();
		$projectid = '1';
         
	}
	public function branches()
	{
		$this->session_check_admin();
		$projectid = '1';
            ##fetch data from Company table for listing
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
            $field='';
            //$condition = "Company.delete_status = '0' AND Company.project_id = '0'";
            $condition = "Company.delete_status = '0' AND Company.project_id = '0' ";
            if(isset($this->data['Relationship']['searchkey']) && $this->data['Relationship']['searchkey']){
                $searchkeyword = $this->data['Relationship']['searchkey'];
                $condition .= "  and (CompanyType.state LIKE '%".$searchkeyword."%' OR Company.city LIKE '%".$searchkeyword."%' OR Company.address1 LIKE '%".$searchkeyword."%' OR Company.address2 LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%'  )";
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
            //echo "<pre>";
            //print_r($companydtlarr);die();
            $this->set("companydata",$companydtlarr);
	}
	public function los()
	{
		$this->session_check_admin();
		$projectid = '1';

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
            $condition = "Contact.delete_status = '0' AND Contact.project_id = '0' AND Contact.contact_type_id = '262'";
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
	}
	public function employees()
	{
			$this->session_check_admin();
			$projectid = '1';

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
            $condition = "Contact.delete_status = '0' AND Contact.project_id = '0' AND Contact.contact_type_id = '263'";
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
	}
	
	public function addcorrespondent($companyid='', $hqid=0){
		Configure::write('debug', 0);
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
		$this->Session->write("correspondentRedirect",'1');
		if( $this->Session->check('correspondentNotesRedirect')&& $this->Session->read('correspondentNotesRedirect'))
		{
			$this->Session->delete('correspondentNotesRedirect');
			$this->Session->delete('correspondentRedirect');
		}
		
		if($usertype==trim("user")){
			$this->session_check_user();
			$usertype = $this->Session->read("User.User.usertype");
			$userid = $this->Session->read("User.User.id");
			$project_id = $this->Session->read("projectwebsite_id");
			$condition="User.id=".$userid;
			$last_login= $this->User->find($condition,NULL,NULL,NULL,NULL,1);
			$last_login=$last_login['User']['modified'];
			$this->set('last_login',$last_login);
			$this->layout= 'internal_layout';
			if($usertype=="holder"){
				$this->layout= 'internal_layout';
			}
			else {
				$this->layout= 'new_sponsor_layout';
			}
		}else{
			$this->Session->delete('current_company');
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
			$this->set('page_url','companylist');
		}
			
		##import Company  model for processing
		if(isset($this->params['pass']['3'])){
			$this->set('edit','edit');
		}

		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1']) && isset($this->params['pass']['2'])){
			$cid = $this->params['pass']['1'];
			$this->set('cid' , $cid);
			$this->set('addtype',$this->params['pass']['2']);
			//App::import("Model", "Company");
			//$this->Company =   & new Company();
			//$companydata = $this->Company->findById($cid);
			//$this->set('company_name',$companydata['Company']['company_name']);
			$company_name = $this->Session->read('companyName');
			$this->set('current_company_name',$company_name);
			$this->set('addtypecat','add');
		}
		elseif(isset($this->params['pass']['0']) && $this->params['pass']['1']){
		
			$cid = $this->params['pass']['0'];
			$this->set('cid' , $cid);
			$this->set('addtype',$this->params['pass']['1']);
			App::import("Model", "Company");
			$this->Company =   & new Company();
			$companydata = $this->Company->findById($cid);
			$this->Session->write('companyName',$companydata['Company']['company_name']);
			$this->set('current_company_name',$companydata['Company']['company_name']);
			$this->set('addtypecat','edit');
		}
		else if(isset($this->params['pass']['0'])){
		
			$cid = $this->params['pass']['0'];
			$this->set('cid' , $cid);
		}

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
		$this->set("location_type_id",'0');
		$relatedproductid = array();
		$relatednonprofitid = array();

		$this->CompanyType->bindModel(array('hasMany'=>array(

				'Project'=>array(

						'foreignKey'=>false,

						'conditions'=>'Company.company_type_id = CompanyType.id'

				))));
		$targetconditions = array('Project.project_type_id' =>'38');

		$targetProject = $this->Project->find('all',array('conditions' => $targetconditions));

		$this->set('targetProject',$targetProject);
		//End
		##check empty data
		if(isset($this->params['pass']['1'])){
			//$this->data['Company']['hq_id'] = $this->params['pass']['1'];
			$hq_id = $this->params['pass']['1'];
			$this->set('hq_id',$hq_id);
		}
		if(!empty($this->data)) {
			if($projectid==''){$projectid = 0;}
			$this->data['Company']['project_id'] = $projectid;
			//echo '<pre>';print_r($this->data);die;
			#set the posted data
			$this->Company->set($this->data);
			#check server side validation
			$errormsg = $this->Company->invalidFields();
			if(!$errormsg){
				$cid = "";
				$cname = $this->data['Company']['company_name'];
				$address1 = $this->data['Company']['address1'];
				$country = $this->data['Company']['country'];
				$state = $this->data['Company']['state'];
				$city = $this->data['Company']['city'];
				$zipcode = $this->data['Company']['zipcode'];
				if(isset($this->data['Company']['category_id']))
					$categoryids = $this->data['Company']['category_id'];
				if(isset($this->data['Company']['non_profit_type_id']))
					$nonprofittypeid = $this->data['Company']['non_profit_type_id'];
				unset($this->data['Company']['category_id']);
				/*if(!empty($this->data['RelatedProject']['ids']))
					$relatedprojectids = $this->data['RelatedProject']['ids'];
				if(!empty($this->data['RelatedNonProfit']['ids']))



					$relatednonprofitids = $this->data['RelatedNonProfit']['ids'];*/
				if($this->data['Company']['id']){
					$cid = $this->data['Company']['id'];
					$condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."' AND country = '".$country."' AND zipcode = '".$zipcode."'    AND project_id = '".$projectid."'    AND  delete_status = '0' AND id !='".$cid."'";

				}else{
					$condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."' AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '".$projectid."' AND  delete_status = '0'";
				}
				$ctdata = $this->Company->find('all',array("conditions"=>$condition));
				if(!$ctdata){
					if($this->data['Company']['hq_id']==0){
						$this->data['Company']['location_type_id']=0;
					}else{
						$this->data['Company']['location_type_id']=1;
					}
					if(!isset($this->data['Company']['location_type_id'])){
						unset($this->data['Company']['hq_id']);
						$this->data['Company']['location_type_id'] = '1';
					}
					//echo '<pre>';print_r($this->data);die;
					if($this->Company->Save($this->data)){  
						## insert company and category
						$company_id = $this->Company->getLastInsertID();
						if($company_id ==''){
							$company_id = $this->data['Company']['id'];
						}
						if($company_id){
							$this->CompanyToCategory->deleteAll( array('CompanyToCategory.company_id'=>$company_id));
							foreach($this->data['Category']['category_id'] as $key=>$val ){
								$categorydata[] = array('company_id' =>$company_id,'category_id' => $val);
							}
							$flag = $this->CompanyToCategory->saveAll($categorydata);
						}
						
						if(isset($this->data['Contact']['id'])){
							foreach($this->data['Contact']['id'] as $key=>$val ){
								$contactdata[] = array('contact_id'=>$val, 'company_id' =>$company_id,'project_id'=>$projectid);
							}
							$flag = $this->CompanyToContact->saveAll($contactdata);
						}//end
					}
					if($cid){
						$this->Session->setFlash('Company updated Successfully.','default', array('class' => 'successmsg'));
						if(isset($this->data['Action']['redirectpage'])){
							$sessdata=$this->Session->read('newsortingby');
							$this->redirect(array('controller'=>'relationships','action'=>'correspondents'));
						}else{

							$this->redirect(array('controller'=>'relationships','action' =>'addcorrespondent',$cid,$this->data['prospects']['addtype']));
						}
					}else{
						$this->Session->setFlash('Company Added Successfully.','default', array('class' => 'successmsg'));
						if(isset($this->data['Action']['redirectpage'])){
							$sessdata=$this->Session->read('newsortingby');
							$this->redirect(array('controller'=>'relationships','action'=>'correspondents'));
						}else{

							$this->redirect(array('controller'=>'relationships','action' =>'addcorrespondent',$company_id,$this->data['prospects']['addtype']));
						}
					}
				}else{
					$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
				}
			}else{
				$this->Session->setFlash('Company with same name already exists.','default',array('class' => 'msgTXt'));
			}
		}

		if($companyid && $companyid !='addmerchant' ){
		
			$this->Company->bindModel(array('hasMany'=>array(
					'CompanyToCategory'=>array(
							'foreignKey'=>'company_id'
					))));
			$this->Company->bindModel(array('hasMany'=>array(
					'RelatedProject'=>array(
							'foreignKey'=>'company_id'
					))));
			$this->Company->bindModel(array('hasMany'=>array(
					'RelatedNonProfit'=>array(
							'foreignKey'=>'company_id'
					))));
			$this->Company->bindModel(array('hasMany'=>array(
					'ProspectNonProfit'=>array(
							'foreignKey'=>'company_id'
					))));
			$this->Company->bindModel(array('hasMany'=>array(
					'CompanyToContact'=>array(
							'foreignKey'=>'company_id'
					))));
			// echo '<pre>';print_r($this->params);
			if(isset($this->params['pass']['0']) && isset($this->params['pass']['1']) && isset($this->params['pass']['2']) && isset($this->params['pass']['3'])){
				$this->Company->id= $this->params['pass']['0'];
				$this->data = $this->Company->read();
				$this->set('addtypecategory',$this->params['pass']['3']);
					
			}
			else if(isset($this->params['pass']['0']) && isset($this->params['pass']['1']) && isset($this->params['pass']['2'])){
				$this->Company->id= $this->params['pass']['1'];
				$this->data = $this->Company->read();
					
				unset($this->data['Company']['id']);
			}else{
				$this->Company->id = $companyid;
				$this->data = $this->Company->read();
				$this->set('hq_id',$this->data['Company']['hq_id']);
			}

			/* Merchant Categories List */
			$categories =  $this->data['CompanyToCategory'];
			for($j=0; $j< count($categories); $j++){
				$categoryids[$j]=$categories[$j]['category_id'];
			}
			/* Merchant Categories List */
			/* Company to contact data */
			$companytocontact =  $this->data['CompanyToContact'];
			for($j=0; $j< count($companytocontact); $j++){
				$companytocontact[$j]=$companytocontact[$j]['contact_id'];
			}
			/* Company to contact data */
			/* Related Project List */
			$relatedproducts =  $this->data['RelatedProject'];
			for($j=0; $j< count($relatedproducts); $j++){
				$relatedproductid[$j]=$relatedproducts[$j]['project_id'];
			}
			/* Related Project List */
			/* Related Non Profit List */
			$relatednonprofits =  $this->data['RelatedNonProfit'];
			for($j=0; $j< count($relatednonprofits); $j++){
				$relatednonprofitid[$j]=$relatednonprofits[$j]['nonprofit_id'];
			}
			/* Related Non Profit  List */
			/* Prospect Non Profit List */
			//echo '<pre>';print_r($this->data);
			$prospectnonprofits =  $this->data['ProspectNonProfit'];
			$prospectnonprofitsids = array();
			for($j=0; $j< count($prospectnonprofits); $j++){
				$prospectnonprofitsids[$j]=$prospectnonprofits[$j]['prospect_non_profit_id'];
			}
			/* Related Non Profit  List */
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
			// print_r($condata); exit;
			if($condata){
				$contactname = Set::combine($condata, '{n}.Contact.id', array('%s %s','{n}.Contact.firstname', '{n}.Contact.lastname'));
			}
			$this->set('contacts',$contactname);
			$other_locations = $this->otherLocations($this->data['Company']['id'], $this->data['Company']['hq_id'],$this->data['Company']['location_type_id']);
			$this->set('other_locations',$other_locations);
		}
		if($companyid && $companyid =='addmerchant'){
			$this->set("location_type_id",'1');
			$this->set("hq_id" ,$hqid );

		}else{
			$this->set("location_type_id", $this->data['Company']['location_type_id']);
		}

		if($this->data['Company']['company_type_id']){
			$this->set("selectedcompanytype",$this->data['Company']['company_type_id']);
		}
		else{
			// 5 for local and 82 for live
			$this->set("selectedcompanytype",'82');
		}
		
		$this->correspondentcompanytypedropdown($project_id);
		$contactdatadropdown = $this->getprojectcontact($project_id);
		if($companyid!='')
		{
			$contactdatadropdown = $this->getprojectcontactbycompany($companyid);
		}	
		$this->set("contactdatadropdown", $contactdatadropdown);		
		
		$notedatadropdown = $this->getprojectnotebycompany($companyid);
		
		$this->set("notedatadropdown", $notedatadropdown);
		$this->countrydroupdown();
		$this->statedroupdown();
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
		
		## Categry Drop down
		$this->categorydropdown();
		$this->set("selectedcategory",'');
		if(!empty($categoryids)){
			$this->set("selectedcategory",$categoryids);
		}####################
		if(!empty($relatedproductid)){
			$this->set("checkedrelproject",$relatedproductid);
		}
		/*$prodtl = $this->projectdetailbyid($projectid);
		$sponname = $this->getsponsornamebyprojectid($projectid);
		$this->set('sponorname',$sponname);
		$projectname = $prodtl[0]['Project']['project_name'];
		$this->set('projectname',$projectname);
		$this->set('projectdata' , $prodtl);
		#Related Project
		$this->getProjectList($relatedproductid);
		#Related Non Profit
		$conditionnonprofit = "Company.delete_status = '0' AND Company.project_id = '$projectid' AND Company.company_type_id = 35";
		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
						'foreignKey'=>false,
						'conditions'=>'Company.company_type_id = CompanyType.id'
				))));
		$companydtlarr = $this->Company->find('all',array("conditions"=>$conditionnonprofit));
		$this->set("companydata",$companydtlarr);*/
		#Selected Non Profit List
		$this->set("companytocontact",$companytocontact);
		$this->set('companyid',$companyid);
	}//end addmerchant();
	
	 function correspondents(){
	        ##check admin session live or not
            $this->session_check_admin();
            $projectid = $this->Session->read("sessionprojectid");
            $merchantcompanytypedropdown = $this->correspondentcompanytypedropdown($projectid);
			//echo '<pre>';print_r($merchantcompanytypedropdown);die;
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
			$strCompType = "";
			if(count($merchantcompanytypedropdown))
			{
				foreach($merchantcompanytypedropdown as $key=>$value)
				{
					if($strCompType =="")
					{
						$strCompType = $key;
					}
					else
					{
						$strCompType .=",". $key;
					}
				}
			}
            $condition = "Company.delete_status = '0' AND Company.company_type_id IN(".$strCompType.")";
            if(isset($this->data['Relationship']['searchkey']) && $this->data['Relationship']['searchkey']){
                $searchkeyword = $this->data['Relationship']['searchkey'];
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
			//echo "<pre>";
			//print_r($companydtlarr);die();
            $this->set("companydata",$companydtlarr);

            # set help condition
            App::import("Model", "HelpContent");
            $this->HelpContent =  & new HelpContent();
            $condition = "HelpContent.id = '62'";  
            $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
            $this->set("hlpdata",$hlpdata);
            # set help condition
        }//end of sa_companylist
	
	public function brokers()
	{
		$this->session_check_admin();
		$projectid = '1';
		

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
            $condition = "Contact.delete_status = '0' AND Contact.project_id = '0' AND Contact.contact_type_id = '264'";
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
	
	}
	public function others()
	{
			$this->session_check_admin();
			$projectid = '1';
		

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
            $condition = "Contact.delete_status = '0' AND Contact.project_id = '0' AND Contact.contact_type_id = '265'";
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
	
	
	}

	public function maps($type = 1)
	{
		$this->session_check_admin();
		$projectid = '1';
        
        $newCmpData = array();
        //company or branch lat long code        
        if($type == 1 || $type == 4)
        {    
            App::import("Model", "Company");
            $this->Company =   & new Company();    
            $conditions = array(
                                'Company.delete_status' => '0',
                                'Company.project_id' => '0',
                                'Company.lat <>' => '',
                                'Company.long <>' => ''
                            );
            $cmpData = $this->Company->find('all',array("conditions"=>array('Company.delete_status' => '0','Company.project_id' => '0','Company.lat <>' => '','Company.long <>' => '')));
			//ignore null values lang latitude    
            foreach ($cmpData as $row) {
                if($row['Company']['lat']!='' && $row['Company']['long']!='' ) 
                {    
                    $newCmpData[] = array($row['Company']['lat'],$row['Company']['long'],$row['Company']['company_name']); 
                }
            }
        }
        else if($type == 2||$type == 3||$type == 5||$type == 6||$type == 7||$type == 8||$type == 9)
        {
            App::import("Model", "Contact");
            $this->Contact =   & new Contact();  

            if($type==5)
            {    //Los lat long code
				$cmpData = $this->Contact->find('all',array('conditions' => array('Contact.active_status' => 1,'Contact.delete_status' => 0,'Contact.contact_type_id' => 262)));                            			
            }
			else if($type==6)
            {     //Employees lat long code
				$cmpData = $this->Contact->find('all',array('conditions' => array('Contact.active_status' => 1,'Contact.delete_status' => 0,'Contact.contact_type_id' => 263)));                            			
            }
			else if($type==7)
            {     //Correspondents lat long code
				$cmpData = $this->Contact->find('all',array('conditions' => array('Contact.active_status' => 1,'Contact.delete_status' => 0,'Contact.contact_type_id' => 48)));                            			
            }
			else if($type==8)
            {     //Brokers lat long code
				$cmpData = $this->Contact->find('all',array('conditions' => array('Contact.active_status' => 1,'Contact.delete_status' => 0,'Contact.contact_type_id' => 264)));                            			
            }
			else if($type==9)
            {   //Others lat long code  
				$cmpData = $this->Contact->find('all',array('conditions' => array('Contact.active_status' => 1,'Contact.delete_status' => 0,'Contact.contact_type_id' => 265)));                            			
            }
            else
            {	 //default lat long code
				$cmpData = $this->Contact->find('all',array('conditions' => array('Contact.active_status' => 1,'Contact.delete_status' => 0)));
			}
            //echo "<pre>";print_r( $cmpData);die();
            //ignore null values lang latitude    
            foreach ($cmpData as $row) {
                if($row['Contact']['lat']!='' && $row['Contact']['long']!='' ) 
                {    
                    $name = $row['Contact']['firstname'].' '.$row['Contact']['lastname'];
                    $newCmpData[] = array($row['Contact']['lat'],$row['Contact']['long'],$name); 
                }
            }
        }    
        $this->set('cmpData',$newCmpData);
        $this->set('chkSelected',$type);

	}

	public function sendmail()
	{
		$this->session_check_admin();
		$projectid = '1';
	}
}
?>