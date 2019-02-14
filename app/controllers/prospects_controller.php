<?php
ob_start();
/* Project		  :-  Image coin website
 * Controller Name :-  players_contoller.php
* Created  On     :-  17-05-12
* Created By	  :-  Vidhur
*/
class ProspectsController extends AppController
{
	var $name = 'prospects';
	//var $uses = 'Setup';
	var $layout = 'new_admin_layout';
	var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
	var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
	var $uses     = array('Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term','Category','Offer','CompanyToCategory','OfferToCategory','NonProfitType','CompanyType', 'RelatedProject', 'RelatedNonProfit','ProspectNonProfit','CompanyToContact','RelatedProject');

	function pagenotavailable(){
		$this->layout = "";
	}
	/*function __construct(){
	  
	}*/

	function beforeFilter() {

		 /*permission code start*/	
			
			
			 if($this->Session->check("UserLoginDetails"))
			 {
			  	$admin =  $this->Session->read("UserLoginDetails");
				$permissions = array();
				$subpermissions = array();
				if(!empty($admin))
				{
						$permissions 	= $this->check_user_permissions($admin['Admin']['user_type'],'yes');
						$subpermissions = $this->check_user_permissions($admin['Admin']['user_type'],'no');
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

	/*Add by puneet on 29-08-12*/
	/**
		* Function name : projectmerchantlist()
		* Description : This function used get list of merchants
		* Created On : 10th July 2012
		*
		*/
	function projectmerchant(){
		Configure::write('debug', 0);
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
		$field='';
		App::import("Model", "Company");
		$this->Company =   & new Company();
		$this->Pagination->sortByClass    = 'Company'; ##initaite pagination
			
		$this->Company->bindModel(array('belongsTo'=>array(
		'CompanyType'=>array(
		'foreignKey'=>false,
		'conditions'=>'Company.company_type_id = CompanyType.id'
				))));
				if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
					$searchkeyword = $this->data['prospects']['searchkey'];
					$condition = "Company.delete_status = '0' AND Company.project_id = '$project_id' and (Company.company_name LIKE '%".$searchkeyword."%' OR CompanyType.company_type_name  LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%')";
				}else{
					$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
				}

				//			$condition .=" AND Company.company_type_id = 68";

				$this->Pagination->sortByClass    = 'Company'; ##initaite pagination
				$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
				'foreignKey'=>false,
				'conditions'=>'Company.company_type_id = CompanyType.id'
						))));
						$condition .=' AND CompanyType.company_type_status_id IN (2,4) AND CompanyType.company_type_category_id =2';
						$this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));
						list($order,$limit,$page) = $this->Pagination->init($condition,$field);
						$this->Company->bindModel(array('belongsTo'=>array(
								'CompanyType'=>array(
										'foreignKey'=>false,
										'conditions'=>'Company.company_type_id = CompanyType.id '
								))));
						//echo $condition;
						//$companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
						$companydtlarr = $this->Company->find('all',array('order' =>$order, 'limit' => $limit, 'page' => $page));
						//echo '<pre>';print_r($companydtlarr);
		    ##set project type data in variable
						$this->set("companydata",$companydtlarr);
	}//end projectmerchantlist()



	function addmerchant($companyid='', $hqid=0){
		Configure::write('debug', 0);
		$usertype = $this->session_check_usertype();
		$project_id = $this->Session->read("sessionprojectid");    
		$this->set('usertype',$usertype);
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

		if(isset($this->params['pass']['0']) && $this->params['pass']['1'] && $this->params['pass']['2']){
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
				if(!empty($this->data['RelatedProject']['ids']))
					$relatedprojectids = $this->data['RelatedProject']['ids'];
				if(!empty($this->data['RelatedNonProfit']['ids']))



					$relatednonprofitids = $this->data['RelatedNonProfit']['ids'];
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
						//releated project
						if(!empty($this->data['Project']['ids'])){
							$this->RelatedProject->deleteAll( array('RelatedProject.company_id'=>$company_id));
							foreach($this->data['Project']['ids'] as $key=>$proval){
								$relatedprojectdata[] = array( 'project_id'=>$proval,'company_id'=>$company_id);
							}
							$flag = $this->RelatedProject->saveAll($relatedprojectdata);
						}//end
						if(!empty($this->data['RelatedNonProfit']['ids'])){
							$this->RelatedNonProfit->deleteAll( array('RelatedNonProfit.company_id'=>$company_id));
							foreach($this->data['RelatedNonProfit']['ids'] as $key=>$rnpval){
								$relatednonprofitprojectdata[] = array( 'nonprofit_id'=>$rnpval,'company_id'=>$company_id);
							}
							$flag = $this->RelatedNonProfit->saveAll($relatednonprofitprojectdata);
						}//end

						if(!empty($this->data['ProspectNonProfit']['ids'])){
							$this->ProspectNonProfit->deleteAll( array('ProspectNonProfit.company_id'=>$company_id));
							foreach($this->data['ProspectNonProfit']['ids'] as $key=>$rnpval){
								$relatedprospectdata[] = array( 'prospect_non_profit_id'=>$rnpval,'company_id'=>$company_id);
							}
							$flag = $this->ProspectNonProfit->saveAll($relatedprospectdata);
						}//end
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
							$this->redirect(array('controller'=>'prospects','action'=>'projectmerchant'));
						}else{

							$this->redirect(array('controller'=>'prospects','action' =>'addmerchant',$cid,$this->data['prospects']['addtype']));
						}
					}else{
						$this->Session->setFlash('Company Added Successfully.','default', array('class' => 'successmsg'));
						if(isset($this->data['Action']['redirectpage'])){
							$sessdata=$this->Session->read('newsortingby');
							$this->redirect('/'.$sessdata);
						}else{

							$this->redirect(array('controller'=>'prospects','action' =>'addmerchant',$company_id,$this->data['prospects']['addtype']));
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
			if(isset($this->params['pass']['0']) && $this->params['pass']['1'] && $this->params['pass']['2'] && $this->params['pass']['3']){
				$this->Company->id= $this->params['pass']['0'];
				$this->data = $this->Company->read();
				$this->set('addtypecategory',$this->params['pass']['3']);
					
			}
			else if(isset($this->params['pass']['0']) && $this->params['pass']['1'] && $this->params['pass']['2']){
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
		$this->merchantcompanytypedropdown($project_id);
		$contactdatadropdown = $this->getprojectcontact($project_id);
		$releatednonprofitdata = $this->releatednonprofit($project_id,5);
		$prospectnonprofit = $this->releatednonprofit($project_id,2);
		$this->set("releatednonprofit", $releatednonprofitdata);
		$this->set("prospectnonprofit", $prospectnonprofit);
		$this->set("contactdatadropdown", $contactdatadropdown);
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

		App::import("Model", "CommunicationTaskHistory");
        $this->CommunicationTaskHistory =   & new CommunicationTaskHistory(); 
        $this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
        'EmailTemplate'=>array(
        'foreignKey'=>false,
        'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
        ))));
        $condition = "CommunicationTaskHistory.project_id=" . $project_id;
        $communicationTaskHistories = $this->CommunicationTaskHistory->find('all', array('conditions' => $condition));
        $this->set('communicationTaskHistories', $communicationTaskHistories);

        App::import("Model", "Event");
        $this->Event = & new Event();
        $condition = "Event.project_id=" . $project_id;
        $events = $this->Event->find('all', array('conditions' => $condition));
        $this->set('events', $events);

		## Categry Drop down
		$this->categorydropdown();
		$this->set("selectedcategory",'');
		if(!empty($categoryids)){
			$this->set("selectedcategory",$categoryids);
		}####################
		if(!empty($relatedproductid)){
			$this->set("checkedrelproject",$relatedproductid);
		}
		$prodtl = $this->projectdetailbyid($projectid);
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
		$this->set("companydata",$companydtlarr);
		#Selected Non Profit List
		$this->set("relatednonprofitid",$relatednonprofitid);
		$this->set("prospectnonprofitid",$prospectnonprofitsids);
		$this->set("companytocontact",$companytocontact);
	}//end addmerchant();


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

	function getlatestcontactbypros(){
		$this->layout = "ajax";
		$this->session_check_admin();
		$project_id = $this->Session->read("sessionprojectid");
		$contactajaxdata = $this->getprojectcontact($project_id);
		foreach($contactajaxdata as $key => $val){
			echo '<option value = "'.$key.'">'.$val.'</option>';
		}
		exit;
	}//end getlatestcontactbypros

	function prospectnonprofit(){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		$searchkey="";
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
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid' and (Company.company_name LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
		}
		$this->Pagination->sortByClass    = 'Company'; ##initaite pagination
		$this->Company->bindModel(array('belongsTo'=>array(
		'CompanyType'=>array(
		'foreignKey'=>'company_type_id'
				))));
				$this->Company->bindModel(array('belongsTo'=>array(
						'NonProfitType'=>array(
								'foreignKey'=>'non_profit_type_id'
						))));
				$condition .= " AND CompanyType.company_type_status_id IN (2,4) AND CompanyType.delete_status = '0' AND CompanyType.active_status = '1' AND CompanyType.company_type_category_id =4";
				$this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));
				list($order,$limit,$page) = $this->Pagination->init($condition,$field);
				$this->Company->bindModel(array('belongsTo'=>array(
						'NonProfitType'=>array(
								'foreignKey'=>false,
								'conditions'=>'Company.non_profit_type_id = NonProfitType.id'
						))));
				$companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
				##set project type data in variable
				$this->set("companydata",$companydtlarr);
	}//end prospectnonprofit()







	function addprospectnonprofit($companyid='', $hqid=0){
		Configure::write('debug', 0);
		if(isset($this->params['pass']['0']) && $this->params['pass']['1'] && $this->params['pass']['2']){
			$cid = $this->params['pass']['1'];
			$this->set('cid' , $cid);
			$this->set('addtype',$this->params['pass']['2']);
			$company_name = $this->Session->read('companyName');
			$this->set('current_company_name',$company_name);

		}
		else if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$this->set('cid' , $this->params['pass']['0']);
			$cid = $this->params['pass']['0'];
			$addtype = $this->params['pass']['1'];
			$this->set('addtype',$this->params['pass']['1']);
			App::import("Model", "Company");
			$this->Company =   & new Company();
			$companydata = $this->Company->findById($cid);
			$this->Session->write('companyName',$companydata['Company']['company_name']);
			$this->set('current_company_name',$companydata['Company']['company_name']);
		}else{
			$this->set('cid' , $this->params['pass']['0']);
		}
		$usertype = $this->session_check_usertype();
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
		}
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
		$this->set("location_type_id",'0');
		$relatedproductid = array();
		$companytocontact = array();
		//$relatednonprofitid = array();
		##check empty data
		if(isset($this->params['pass']['1'])){
			//$this->data['Company']['hq_id'] = $this->params['pass']['1'];
			$hq_id = $this->params['pass']['1'];
			$this->set('hq_id',$hq_id);
		}
		if(!empty($this->data)) {
			$this->data['Company']['project_id'] = $projectid;
			#set the posted data
			#check server side validation
			$errormsg = $this->Company->invalidFields();
			$cname = $this->data['Company']['company_name'];
			$cid = $this->data['Company']['company_type_id'];
			$address1 = $this->data['Company']['address1'];
			$address2 = $this->data['Company']['address2'];
			$country = $this->data['Company']['country'];
			$state = $this->data['Company']['state'];
			$city = $this->data['Company']['city'];
			$zipcode = $this->data['Company']['zipcode'];
			$ein = $this->data['Company']['ein'];
			$email = $this->data['Company']['email'];
			$fax = $this->data['Company']['fax'];
			$phone = $this->data['Company']['phone'];
			if(isset($this->data['Company']['non_profit_type_id'])){
				$nonprofittypeid = $this->data['Company']['non_profit_type_id'];
			}
			if($this->data['Company']['hq_id']==0){
				$this->data['Company']['location_type_id']=0;
			}else{
				$this->data['Company']['location_type_id']=1;
			}
			//echo '<pre>';print_r($this->data);die;
			if($this->Company->Save($this->data)){
				##Get last insert id
				$company_id = $this->Company->getLastInsertID();
				if($company_id ==''){
					$company_id = $this->data['Company']['id'];
				}
				if($company_id){
					$this->CompanyToContact->deleteAll( array('CompanyToContact.company_id'=>$company_id));
					foreach($this->data['Contact']['contact_id'] as $key=>$val ){
						$contactdata[] = array('contact_id'=>$val, 'company_id' =>$company_id,'project_id'=>$projectid);
					}
					//echo '<pre>';print_r($contactdata);die;
					$flag = $this->CompanyToContact->saveAll($contactdata);
					if(isset($this->data['Project']['ids'])){
						foreach($this->data['Project']['ids'] as $key=>$val ){
							$projectdata[] = array('project_id'=>$val, 'company_id' =>$company_id);
						}
						$flag = $this->RelatedProject->saveAll($projectdata);
					}
				}
			}
			if(isset($this->data['Action']['redirectpage'])){
				$msg='Non Profit Prospect  Added Successfully.';
				$this->Session->setFlash($msg,'default', array('class' => 'successmsg'));
				$sessdata=$this->Session->read('newsortingby');
				$this->redirect(array('controller'=>'prospects','action'=>'prospectnonprofit'));
			}
			else if(isset($this->data['Action']['noredirection'])){
				$msg='Non Profit Prospect saved Successfully.';
				$this->Session->setFlash($msg,'default', array('class' => 'successmsg'));
				$this->redirect(array("controller"=>"prospects" , "action"=>"addprospectnonprofit",$company_id,$this->data['prospects']['addtype']));
			}
		}//and check empty
		$this->Company->bindModel(array('hasMany'=>array(
				'RelatedProject'=>array(
						'foreignKey'=>'company_id'
				))));
		$this->Company->bindModel(array('hasMany'=>array(
				'CompanyToContact'=>array(
						'foreignKey'=>'company_id'
				))));
		if(isset($this->params['pass']['0']) && $this->params['pass']['1'] && $this->params['pass']['2'] && $this->params['pass']['3']){
			$this->Company->id= $this->params['pass']['0'];
			$this->data = $this->Company->read();
			$this->set('addtypecategory',$this->params['pass']['3']);
		}
		else if(isset($this->params['pass']['0']) && $this->params['pass']['1'] && $this->params['pass']['2']){
			$this->Company->id= $this->params['pass']['1'];
			$this->data = $this->Company->read();
			//echo '<pre>';print_r($this->data);die;
			unset($this->data['Company']['id']);

		}else{
			$this->Company->id = $companyid;
			$this->data = $this->Company->read();
			$this->set('hq_id',$this->data['Company']['hq_id']);
			$this->set('selectedcompanytype',$this->data['Company']['company_type_id']);
		}
		//echo '<pre>';print_r($this->data);

		/* Related Project List */
		$relatedproducts =  $this->data['RelatedProject'];
		for($j=0; $j< count($relatedproducts); $j++){
			$relatedproductid[$j]=$relatedproducts[$j]['project_id'];
		}
		/* Company to contact data */
		$companytocontact =  $this->data['CompanyToContact'];
		for($j=0; $j< count($companytocontact); $j++){
			$companytocontact[$j]=$companytocontact[$j]['contact_id'];
		}
		$this->nonprofitcompanytypedropdown($project_id);
		$this->getnonprofittype();
		$contactdatadropdown = $this->getprojectcontact($project_id);
		//$this->pl($contactdatadropdown);
		$this->set("contactdatadropdown", $contactdatadropdown);
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
		## Categry Drop down
		$this->categorydropdown();
		$this->set("selectedcategory",'');
		if(!empty($categoryids)){
			$this->set("selectedcategory",$categoryids);
		}
		$prodtl = $this->projectdetailbyid($projectid);
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
		$this->set("companydata",$companydtlarr);
		#Selected Non Profit List
		$this->set("relatedproductid",$relatedproductid);
		$this->set("companytocontact",$companytocontact);
	}//end addprospectnonprofit();







	function changestatus($recid,$modelname,$status,$methodname,$action='cngstatus',$othermodel='',$otherid='',$param='',$cid,$addtype){


		//echo '<pre>';print_r($this->params);die;

		if(isset($this->params['pass']['5']) && isset($this->params['pass']['6'])){
			$redirctstring = $this->params['pass']['5'].'/'.$this->params['pass']['6'];
		}else if(isset($this->params['pass']['5'])){
			$redirctstring = $this->params['pass']['4'];
		}



		##check user session live or not



		$this->session_check_admin();



		##import dynamic model for processing



		App::import("Model", $modelname);



		$this->$modelname =   & new $modelname();



		##set the record for updation







		$allid=str_replace('*', ' or id = ',$recid);



		$where="id=$allid";







		if(count(explode('*',$recid))==1){



			$this->data["$modelname"]['id'] = $recid;



		}



		if($action !='delete'){



			$this->data["$modelname"]['active_status'] = $status;



		}else{



			$this->data["$modelname"]['delete_status'] = 1;



		}



		if(count(explode('*',$recid))==1){



			$i=$this->$modelname->Save($this->data["$modelname"]);







		}else{



			if($action!="delete")



				$i=$this->$modelname->updateAll(array('active_status'=>"'".$status."'"),$where);



			else{



				$res = Set::enum('yes', array('no' => 0, 'yes' => 1));



				$i=$this->$modelname->updateAll(array('delete_status'=>"'".$res."'"),$where);







			}



		}



		if($i){



			$this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));







		}else{



			$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));



		}







		//$methodname="admins/".$methodname;exit;



		$this->redirect("$methodname/$redirctstring");







	}//end of changestatus()







	//#######################################03 -SEP -2012###########VENDOR SECTION##############################



	/*Add by puneet on 29-08-12*/



	/**



	* Function name : projectvendorslist()



	* Description : This function used get list of merchants



	* Created On : 10th July 2012



	*



	*/











	function prospectlist(){

		Configure::write('debug',0);
		$str_type = $this->params['pass']['0'];
		$this->set('str_type' ,$str_type);
		if($str_type == trim('Vendor')){
			$ct_id = '1';
		}else if($str_type == trim('Sales')){
			$ct_id = '3';
		}
		else if($str_type == trim('Advertiser')){
			$ct_id = '5';
		}
		else if($str_type == trim('Other')){
			$ct_id = '6';
		}
		$this->set('ct_id' ,$ct_id);
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
		}
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
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "Company.delete_status = '0' AND Company.project_id = '$project_id' and (Company.company_name LIKE '%".$searchkeyword."%' OR Company.city  LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.state LIKE '%".$searchkeyword."%' )";
		}else{
			$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
		}
		//			$condition .=" AND Company.company_type_id = 68";
		$this->Pagination->sortByClass    = 'Company'; ##initaite pagination
		$this->Company->bindModel(array('belongsTo'=>array(
		'CompanyType'=>array(
		'foreignKey'=>false,
		'conditions'=>'Company.company_type_id = CompanyType.id'
				))));
			
		$this->CompanyType->bindModel(array('belongsTo'=>array(
				'CompanyTypeCategory'=>array(
						'foreignKey'=>false,
						'conditions'=>'CompanyType.company_type_category_id = CompanyTypeCategory.id'
				))));
		$condition .=' AND CompanyType.company_type_status_id IN (2,4) AND CompanyType.company_type_category_id ="'.$ct_id.'"';
		$this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
						'foreignKey'=>false,
						'conditions'=>'Company.company_type_id = CompanyType.id '
				))));
		$this->CompanyType->bindModel(array('belongsTo'=>array(
				'CompanyTypeCategory'=>array(
						'foreignKey'=>false,
						'conditions'=>'CompanyType.company_type_category_id = CompanyTypeCategory.id'
				))));
		$companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		//echo '<pre>';print_r($companydtlarr);die;
		$this->set("companydata",$companydtlarr);
	}//end prospectlist()

	//Add vendor code start here

	function addprospect($companyid=''){
		if(isset($this->params['pass']['0'])  && isset($this->params['pass']['1'])){
			$companyid = $this->params['pass']['1'];
			$this->set('cid' , $companyid);
			App::import("Model", "Company");
			$this->Company =   & new Company();
			$companydata = $this->Company->findById($companyid);
			$this->Session->write('companyName',$companydata['Company']['company_name']);
			$this->set('company_name',$companydata['Company']['company_name']);
		}else if($this->params['pass']['0']){
			$str_type = $this->params['pass']['0'];
			if($str_type == trim('Vendor')){
				$this->set('selectedcompanytype',84);
			}else if($str_type == trim('Sales')){
				$this->set('selectedcompanytype',85);
			}
			else if($str_type == trim('Advertiser')){
				$this->set('selectedcompanytype',86);
			}
			else if($str_type == trim('Other')){
				$this->set('selectedcompanytype',87);
			}

		}
			
		Configure::write('debug', 0);
		$params = $this->params['pass']['0'];
		$this->set('params',$params);
		##check user session live or not
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
		}
		##import Company  model for processing
		App::import("Model", "Company");
		$this->Company =   & new Company();
		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '46'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		# set help condition
		$this->vendorcompanytype($project_id,$params);
		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$projectid = $project_id;
		$this->set('project_name',$projectDetails['Project']['project_name']);
		$this->set("selectedcountry",'');
		$this->set("selectedstate",'');
		##check empty data
		if(!empty($this->data)) {
			//echo '<pre>';print_r($this->data);die;
			$this->data['Company']['project_id'] = $projectid;
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
				if($this->data['Company']['id']){
					$cid = $this->data['Company']['id'];
					$condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."' AND country = '".$country."' AND zipcode = '".$zipcode."'    AND project_id = '".$projectid."'    AND  delete_status = '0' AND id !='".$cid."'";
				}else{
					$condition = "company_name = '".$cname."' AND address1 = '".$address1."'  AND city = '".$city."' AND state = '".$state."'
							AND country = '".$country."' AND zipcode = '".$zipcode."' AND project_id = '".$projectid."' AND  delete_status = '0'";
				}
				##check already exists company name
				$ctdata = $this->Company->find('all',array("conditions"=>$condition));
				if(empty($ctdata)){
					if($this->Company->Save($this->data)){
						## insert company and category
						$company_id = $this->Company->getLastInsertID();
						if($company_id ==''){
							$company_id = $this->data['Company']['id'];
						}
						if(isset($this->data['Contact']['id'])){
							$this->CompanyToContact->deleteAll( array('CompanyToContact.company_id'=>$company_id));
							foreach($this->data['Contact']['id'] as $key=>$val ){
								$contactdata[] = array('contact_id'=>$val, 'company_id' =>$company_id,'project_id'=>$projectid);
							}
							$flag = $this->CompanyToContact->saveAll($contactdata);
						}//end
					}

					if($cid){
						$this->Session->setFlash('Vendor updated Successfully.','default', array('class' => 'successmsg'));
						if(isset($this->data['Action']['redirectpage'])){
							$sessdata=$this->Session->read('newsortingby');
							$this->redirect(array('controller' =>'prospects','action' =>'prospectlist',$this->data['prospects']['params']));
						}else{
							$str_cat = $this->data['prospects']['params'];
							$this->redirect(array('controller'=>'prospects','action' =>'addprospect',$str_cat,$cid));
						}
					}else{
						$this->Session->setFlash('Company Added Successfully.','default', array('class' => 'successmsg'));
						if(isset($this->data['Action']['redirectpage'])){
							$this->redirect(array('controller' =>'prospects','action' =>'prospectlist',$this->data['prospects']['params']));
						}else{
							$this->redirect(array('controller'=>'prospects','action' =>'addprospect'));
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
		 		'CompanyToContact'=>array(
		 				'foreignKey'=>'company_id'
		 		))));
		 $this->Company->id = $companyid;
		 $this->data = $this->Company->read();
		 if($this->data['Company']['country']){
		 	$conid = $this->data['Company']['country'];
		 	$this->set("selectedcountry",$conid);
		 	$this->statedroupdown($conid);
		 	if($this->data['Company']['state']){
		 		$statid = $this->data['Company']['state'];
		 		$this->set("selectedstate",$statid);
		 	}
		 }
		 $companytocontact =  $this->data['CompanyToContact'];
		 for($j=0; $j< count($companytocontact); $j++){
		 	$companytocontact[$j]=$companytocontact[$j]['contact_id'];
		 }
		}
		$contactdatadropdown = $this->getprojectcontact($project_id);
		$this->set("contactdatadropdown", $contactdatadropdown);
		$this->countrydroupdown();
		$this->statedroupdown();
		if($this->data['CommunicationTask']['country']){
			$conid = $this->data['CommunicationTask']['country'];
			$this->set("selectedcountry",$conid);
			$this->statedroupdown($conid);
			if($this->data['Company']['state']){
				$statid = $this->data['Company']['state'];
				$this->set("selectedstate",$statid);
			}
		}
		$this->set("companytocontact",$companytocontact);
	}//end addvendor();







	//#######################################06 -SEP -2012###########Mail SECTION##############################



	/*Add by puneet on 29-08-12*/



	/*



	* Function name : prospectemaillist()



	* Description : This function used get list of prospect emails



	* Created On : 06 Sep 2012



	*



	*/











	function prospectemaillist(){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
			$projectDetails=$this->getprojectdetails($project_id);
			$this->set('project',$projectDetails);
		}
		##import project type model for processing
		App::import("Model", "CommunicationTask");
		$this->CommunicationTask =   & new CommunicationTask();
		$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
				))));
		##fetch data from project type table for listing
		$field='';
		##checking search key
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND CommunicationTask.project_id IN ('0', $project_id) AND CommunicationTask.email_template_type ='2' AND  (CommunicationTask.task_name LIKE '%".$searchkeyword."%'  OR EmailTemplate.email_template_name  LIKE '%".$searchkeyword."%' OR CommunicationTask. 	recur_pattern LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'  AND CommunicationTask.project_id IN ('0', $project_id) AND CommunicationTask.email_template_type ='2'";
		}
		$this->Pagination->sortByClass    = 'CommunicationTask'; ##initaite pagination
		$this->Pagination->total= count($this->CommunicationTask->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
				))));

		$taskdata = $this->CommunicationTask->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("taskdata",$taskdata);
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '13'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
	}//end prospectemaillist
	/*



	* Function name : addprospectemail()
	* Description   : This function used add new  prospect emails tasks
	* Created On    : 06 Sep 2012
	*Created by 	: Puneet
	*/



	function addprospectemail($recid = ''){

		if(isset($this->params['pass']['1'])){
			$params = $this->params['pass']['1'];
		}
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
		if($usertype==trim("user")){
			$this->session_check_user();
			$usertype = $this->Session->read("User.User.usertype");
			$userid = $this->Session->read("User.User.id");
			$project_id = $this->Session->read("projectwebsite_id");
			$project_name=$this->Session->read("projectwebsite_name_admin");
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
			$this->session_check_admin();
			##project id for each project
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
		
			
		}
		$this->set('current_project_name',$project_name);
		$this->set('project_id',$project_id);
		
		##import Company  model for processing
		App::import("Model", "CommunicationTask");
		$this->CommunicationTask =   & new CommunicationTask();
		#set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '46'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$this->set('dataprojects',$projectDetails);
		$projectid = $project_id;
		$this->set('project_name',$projectDetails['Project']['project_name']);
		##country drop down
		$this->countrydroupdown();
		$this->statedroupdown();
		if(!empty($this->data)){
			//echo '<pre>';print_r($this->data);
			if(isset($this->data['CommunicationTask']['offer_id'])){
				$offer_id =  $this->data['CommunicationTask']['offer_id'];
				$offer_id_arr = explode('-',$offer_id);
				$this->data['CommunicationTask']['offer_id'] = $offer_id_arr['0'];
			}
			
			$this->data['CommunicationTask']['email_template_type'] = '2';
			if($rec_id == ''){
				$task_id=null;
				//echo '<pre>';print_r($this->data);die;
				if(isset($this->data['CommunicationTask']['id']) && $this->data['CommunicationTask']['id']){
					$task_id=$this->data['CommunicationTask']['id'];
				}
				$uniqueTaskName = $this->CommunicationTask->isUniqueTaskName($this->data['CommunicationTask']['task_name'], $project_id, $task_id );
				if ($uniqueTaskName == false) {
					$this->Session->setFlash('Communication Task  with same name already exists.','default',array('class' => 'msgTXt'));
				}else{
					
					if(isset($this->data['CommunicationTask']['id'])){
						$_project_id =  $this->data['CommunicationTask']['project_id'];
					}else{
						$_project_id = $project_id;
						$this->data['CommunicationTask']['project_id'] = $project_id;
					}
					
					$rec_id = $this->CommunicationTask->saveEmailTask($this->data['CommunicationTask'],$_project_id,'0');
					if($rec_id > 0 ){
						
						if(isset($this->data['CommunicationTask']['id'])){
							$this->Session->setFlash('Communication Task edited Successfully.','default', array('class' => 'successmsg'));
						}else{
							$this->Session->setFlash('Communication Task added Successfully.','default', array('class' => 'successmsg'));
						}
						
						
						if(isset($this->data['Action']['redirectpage'])){
							$this->redirect('/prospects/prospectemaillist');
						}else{
							$this->redirect('/prospects/addprospectemail/'.$rec_id);
						}
					}else{
						$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
					}
				}
			}
			else{
				if(isset($this->data['CommunicationTask']['id']) && $this->data['CommunicationTask']['id']){
					$this->CommunicationTask->id=$this->data['CommunicationTask']['id'];
				}
				if($this->data['CommunicationTask']['recur_pattern']=="W")
				{
					$this->data['CommunicationTask']['monday']=0;
					$this->data['CommunicationTask']['tuesday']=0;
					$this->data['CommunicationTask']['wednesday']=0;
					$this->data['CommunicationTask']['thursday']=0;
					$this->data['CommunicationTask']['friday']=0;
					$this->data['CommunicationTask']['saturday']=0;
					$this->data['CommunicationTask']['sunday']=0;
				}
				if($this->data['CommunicationTask']['end_after']=="O")
					$this->data['CommunicationTask']['enddate']='0000-00-00';
				if($this->data['CommunicationTask']['end_after']=="E"){
					if($this->data['CommunicationTask']['enddate']=="0000-00-00")
					{
						$this->Session->setFlash('Please enter end date','default',array('class' => 'msgTXt'));
						$this->redirect('/prospects/addprospectemail/'.$this->data['CommunicationTask']['id']);
					}
				}
				$this->data['CommunicationTask']['project_id']=$projectid;
				
				
				#set the posted data
				$this->CommunicationTask->set($this->data);
				#check server side validation
				$this->CommunicationTask->invalidFields();
				#save data in project type table
				
				
				if($this->CommunicationTask->Save($this->data)){
					$this->Session->setFlash('Communication Task updated Successfully.','default', array('class' => 'successmsg'));
				}else{
					$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
				}
				if(isset($this->data['Action']['redirectpage'])){
					$sessdata=$this->Session->read('newsortingby');
					$this->redirect('/'.$sessdata);
				}else
				{
					$this->redirect("/prospects/addprospectemail/edit/$recid");
				}
			}
		}//end check empty data

		$this->getCompanyTypeDropdown($project_id, "", array(2,4));
		//$this->getprospectemailcompanydropdown($projectid);
		$this->categorydropdown();
		//$this->getSubCategoryDropdown();
		$this->contacttypedropdown($projectid);
		$this->nonprofittypedropdown();
		$this->offertypedropdown();
		$this->set('days_since',$this->getDaysSinceArray());
		$this->getEventDropDownListByProjetcID($projectid);
		//#################################################

		$this->getmailtemplates($projectid,'2');
		if(!empty($params)){
			$this->CommunicationTask->id = $params;
			$this->data = $this->CommunicationTask->read();
			$isreadonly= (isset($this->data['CommunicationTask']['project_id']) &&  ($this->data['CommunicationTask']['project_id'] != '0' || $usertype =='admin')) ? '0': '1';
			$this->set("isreadonly",$isreadonly);
			$this->set('sel_companytypeid',$this->data['CommunicationTask']['company_type']);
			$this->set("selectedcategory",$this->data['CommunicationTask']['category_id']);
			$subcatid = $this->getcondSubCategoryDropdown($this->data['CommunicationTask']['category_id']);
			$this->set("sub_categories_drpdwn", $this->getSubCategoryDropdown($this->data['CommunicationTask']['category_id']));
			$this->set("selected_sub_category",$this->data['CommunicationTask']['sub_category_id']);
			$offer_id =  $this->data['CommunicationTask']['offer_id'];
			$offer_id_arr = explode('-',$offer_id);
			$this->set("sel_offerid",$offer_id_arr['0']);
			
			$this->set('sel_email_temp',$this->data['CommunicationTask']['email_template_id']);
			$this->set('sel_nonprofittype',$this->data['CommunicationTask']['non_profit_type_id']);
			$this->data['CommunicationTask']['task_startdate'] = date("d-m-Y",strtotime($this->data['CommunicationTask']['task_startdate']));
			//Get Event Drop Down
			if($this->data['CommunicationTask']['member_country']){
				$this->set("selectedcountry",$this->data['CommunicationTask']['member_country']);
				##state drop down
				$this->statedroupdown($this->data['CommunicationTask']['member_country']);
				if($this->data['CommunicationTask']['member_state']){
					$statid = $this->data['CommunicationTask']['member_state'];
					$this->set("selectedstate",$statid);
				}
			}
			
			$this->set('sel_event',$this->data['CommunicationTask']['event_id']);
			$this->set('sel_event_rsvp',$this->data['CommunicationTask']['event_rsvp_type']);
			$this->set('sel_social_networks',$this->data['CommunicationTask']['social_network_members']);
			$this->set('sel_recur_pattern',$this->data['CommunicationTask']['recur_pattern']);
			$this->set('selectedstate',$this->data['CommunicationTask']['member_state']);
			$this->set('selectedcountry', $this->data['CommunicationTask']['member_country']);
			$this->set('sel_days_since',$this->data['CommunicationTask']['member_days_since']);
			$this->set('sel_contactypeid',$this->data['CommunicationTask']['contact_type']);
			$this->set('selectedtemplatetype', $this->data['CommunicationTask']['email_template_type']);
			$this->set('sel_non_networks', $this->data['CommunicationTask']['non_network_members']);
		
			
			if($this->data['CommunicationTask']['company_type']=="" && $this->data['CommunicationTask']['contact_type']==""){
				$this->set('is_contactdisabled', '1');
				$this->set('is_memebrdisabled', '0');
			}else{
				$this->set('is_contactdisabled', '0');
				$this->set('is_memebrdisabled', '0');
			}
			
			$isreadonly= (isset($this->data['CommunicationTask']['project_id']) &&  ($this->data['CommunicationTask']['project_id'] != '0' || $usertype =='admin')) ? '0': '1';
			$this->set("isreadonly",$isreadonly);
			
			$this->set('project_id',$this->data['CommunicationTask']['project_id']);
			
		}else{
			$this->set('sel_companytypeid','');
			$this->set("selectedcategory",'');
			$this->set("selected_sub_category","0");
			$this->set("sel_offerid",'');
			$this->set('sel_email_temp', '');
			$this->set('sel_nonprofittype','');
			$this->set('sel_event','');
			$this->set('sel_event_rsvp','');
			$this->set('is_contactdisabled','0');
			$this->set('is_memebrdisabled','0');
			$this->set('selectedtemplatetype','0');
			$this->set('sel_social_networks','');
			$this->set('sel_non_networks', '');
			$this->set('sel_recur_pattern','');
			$this->set('selectedstate','254');
			$this->set('selectedcountry','');
			$this->set('sel_days_since','');
			$this->set('sel_contactypeid','');
			
		}

		
		$this->set('event_rsvp',$this->getEventRSVPArray());
		//Set Social Naetworks Array
		$this->set('social_networks',$this->getSocialNetworkArray());
		$this->set('recur_pattern',$this->getRecurPatternkArray());
		
		
		//$this->set('sel_email_temp','');
		//$this->pl($this->data);

		
		
	}//end addprospectemail


	function ajax_get_sub_category($categoryid=''){
		$subcategorydropdown = $this->getSubCategoryDropdown($categoryid);
		echo "<option value='' >--Select--</option>";
		foreach($subcategorydropdown as $key=>$val){
			echo "<option value='".$key."' >".$val."</option>";
		}
		die();
	}//ajax_get_sub_category



	/*
	 * Function name   : prospectemailtemplate()
	* Description : This function used to list Email Templates of super admin
	* Created On      : 06-09-12(04:20pm)
	*
	*/
	function prospectemailtemplate(){
		Configure::write('debug', 0);
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
		}
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
		App::import("Model", "EmailTemplate");
		$this->EmailTemplate =   & new EmailTemplate();
		$field='';
		if(!empty($this->data))
		{
			$searchkey=$this->data['prospects']['searchkey'];
			$varsearch='%'.$searchkey.'%';
			$condition = "EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0'   AND EmailTemplate.is_sytem in('0','1') AND EmailTemplate.is_event_temp='0' AND EmailTemplate.email_template_type ='2'" ;
			//echo $condition;
		}else {
			$condition = "EmailTemplate.delete_status='0'  AND EmailTemplate.is_sytem IN('0','1') AND EmailTemplate.is_event_temp='0' AND EmailTemplate.email_template_type ='2'" ;
		}
		$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination
		$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("emailtemplates",$emailtempdtlarr);
	}  //prospectemailtemplate


	/*
	* Function name   : addprospectmailtmp()
	* Description 	  : This function used to add new mail template by projectadmin
	* Created On      : 06-09-2012
	*/

	function addprospectmailtmp($mailtempid = ''){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$projectid = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$projectdetails= $this->getprojectdetails($projectid);
			$this->set('project',$projectdetails);
		}
		##import EmailTemplate  model for processing
		App::import("Model", "EmailTemplate");
		$this->EmailTemplate =   & new EmailTemplate();
		// if $returnurl is popup then its need to close else no need to close
		$this->set("closeit","no");
		$current_domain= $_SERVER['HTTP_HOST'];
		##check empty data
		if(!empty($this->data)){
			#set the posted data
			$this->data['EmailTemplate']['email_template_type']=2;
			$this->EmailTemplate->set($this->data);
			#check server side validation
			$errormsg = $this->EmailTemplate->invalidFields();
			$this->data['EmailTemplate']['project_id'] = $projectid;
			$this->data['EmailTemplate']['is_sytem'] = '1';
			if(!$errormsg){
				$templname = $this->data['EmailTemplate']['email_template_name'];
				$condition = "email_template_name = '".$templname."' AND project_id = '".$projectid."' AND  delete_status = '0'";
				##check already exists EmailTemplate name
				$ctdata = $this->EmailTemplate->find('all',array("conditions"=>$condition));
				$this->data['EmailTemplate']['content']=str_replace("../img","http://".$current_domain."/img",$this->data['EmailTemplate']['content']);
				if(!$ctdata){
					if($returnurl=="event" || $extra=="event")
					{
						$this->data['EmailTemplate']['is_sytem']=0;
					}
					
					if(isset($this->data['EmailTemplate']['id'])){
						unset($this->data['EmailTemplate']['project_id']);
					}
					
					//echo '<pre>';print_r($this->data);die;
					
					if($this->EmailTemplate->Save($this->data['EmailTemplate'])){
						$mailtempid = $this->EmailTemplate->getLastInsertId();
						if($mailtempid==''){
							$mailtempid = $this->data['EmailTemplate']['id'];
						}
						if($mailtempid > 0){
							$this->Session->setFlash('Template added Successfully.','default', array('class' => 'successmsg'));
							if(isset($this->data['Action']['redirectpage'])){
								$this->redirect(array('controller' =>'prospects','action'=>'prospectemailtemplate'));
							}else{
								$this->redirect(array('controller' => 'prospects','action'=>'addprospectmailtmp',$this->data['EmailTemplate']['id']));
							}
						}
					}else{
						$this->Session->setFlash('Error in processing. Please try again.','default',array('class' => 'msgTXt'));
					}
				}else{
					$this->Session->setFlash('Template with same name already exists.','default',array('class' => 'msgTXt'));
				}
			}else{
				$this->Session->setFlash('Please provide email content.','default',array('class' => 'msgTXt'));
			}
		}
		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '11'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		if($mailtempid!=''){
			$this->EmailTemplate->id = $mailtempid;
			$this->data = $this->EmailTemplate->read();
			$isreadonly= (isset($this->data['EmailTemplate']['project_id']) &&  ($this->data['EmailTemplate']['project_id'] != '0' || $usertype =='admin')) ? '0': '1';
			$this->set("isreadonly",$isreadonly);
		}
		
		$this->set("returnurl",$returnurl);
		$this->set("extra",$extra);
		# set help condition
	}

	//#################################### 19 - 03 - 2012 #############################################

	/**
	 * Function name : branchlist()
	 * Description   : This function used get list of players
	 * Created On    : 07 September 2012
	 * Created By    : Vidur
	 */


	function branchlist($companyid =''){

		$usertype = $this->session_check_usertype();
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
			$this->session_check_admin();
			$this->set('current_company', $this->Session->read("current_company"));
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			if(isset($_SERVER['QUERY_STRING'])){
				$this->Session->delete("newsortingby");
				$strloc=strpos($_SERVER['QUERY_STRING'],'=');
				$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
				$this->Session->write("newsortingby",$strdata);
			}
		}
		//echo '<pre>';print_r($this->params);
		if($companyid > 0 ){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$cid = $this->params['pass']['0'];
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('addtype',$this->params['pass']['1']);
			$company_name = $this->Session->read('companyName');
			$this->set('company_name',$company_name);
		}
		if(isset($this->params['pass']['1']) && $this->params['pass']['1']=="Marchant"){
			$companyTypeCatId = '2';
		}
		else if(isset($this->params['pass']['1']) && $this->params['pass']['1']=="Nonprofit"){
			$companyTypeCatId = '4';
		}



		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition
			
		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('project_name',$project_name);
		$projectid = $project_id;
		##fetch data from Company table for listing
		$field='';
		App::import("Model", "Company");
		$this->Company =   & new Company();
		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
						'foreignKey'=>false,
						'conditions'=>'Company.company_type_id = CompanyType.id'
				))));
			
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){

			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid' and (Company.address1 LIKE '%".$searchkeyword."%' OR Company.address2  LIKE '%".$searchkeyword."%' OR Company.city  LIKE '%".$searchkeyword."%'  )";
		}else{
			$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
		}
			
		$this->Pagination->sortByClass    = 'Company'; ##initaite pagination
		$this->Company->bindModel(array('belongsTo'=>array(
		'CompanyType'=>array(
		'foreignKey'=>false,
		'conditions'=>'Company.company_type_id = CompanyType.id'
				))));

		$condition .=' AND Company.hq_id ="'.$companyid.'" AND CompanyType.company_type_status_id IN (2,4) AND CompanyType.company_type_category_id ="'.$companyTypeCatId.'"' ;

		// echo 	$condition .=' AND Company.hq_id ="'.$companyid.'" AND CompanyType.company_type_status_id IN (3,5)';


		$this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));


		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
						'foreignKey'=>false,
						'conditions'=>'Company.company_type_id = CompanyType.id '
				))));


		$companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		//echo '<pre>';print_r($companydtlarr);
			
		##set project type data in variable
		$this->set("companydata",$companydtlarr);
			



	}//end branchlist()

	function addgraphic($companyid=''){

		$usertype = $this->session_check_usertype();
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
			$this->session_check_admin();
			$this->set('companyid',$companyid);
			$this->set('current_company', $this->Session->read("current_company"));
		}
		if($companyid > 0 ){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('addtype',$this->params['pass']['1']);
		}


			
		App::import("Model", "Company");
		$this->Company =   & new Company();
			
		$project_id = $this->Session->read("sessionprojectid");
		$project_name=$this->Session->read("projectwebsite_name_admin");
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);
		$this->set('current_project_name',$project_name);
			
		//for active menu display
		$this->set('page_url','addgraphic');
			
		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition

		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('projectname',$project_name);
		$this->set('project_id',$project_id);
			

		if(!empty($this->data)) {

			//echo '<pre>';print_r($this->data);die;
			$parentDirPath =  'img' . DS;

			$filePath1 =  $parentDirPath.'company' . DS .'square' ;
			$this->File = & new FileComponent;
			$this->File->setDestPath($filePath1);
			if(isset($this->data['Company']['square_graphic']['name']) && $this->data['Company']['square_graphic']['name'] !=''){
				##upload image
				$file_name1 = $this->File->setFileName($this->data['Company']['square_graphic']['name']);
				$tmp1 = $this->data['Company']['square_graphic']['tmp_name'];
				$file_namesquare = $this->File->uploadCompanyGraphic($file_name1,$tmp1,true,'210X210','square');
				if(!empty($file_namesquare)){
					$this->data['Company']['square_graphic'] = $file_namesquare;
				}
				else{
					unset($this->data['Company']['square_graphic']);
				}
			}else{
				unset($this->data['Company']['square_graphic']);
			}


			$filePath2 =  $parentDirPath.'company/wide' ;
			$this->File->setDestPath($filePath2);
			if(isset($this->data['Company']['wide_graphic']['name']) && $this->data['Company']['wide_graphic']['name'] !=''){
				##upload image
				$file_name2 = $this->File->setFileName($this->data['Company']['wide_graphic']['name']);
				$tmp2 = $this->data['Company']['wide_graphic']['tmp_name'];
				$file_name_wide = $this->File->uploadCompanyGraphic($file_name2,$tmp2,true,'350X210','wide');

				if(!empty($file_name_wide)){
					$this->data['Company']['wide_graphic'] = $file_name_wide;
				}
				else{
					unset($this->data['Company']['wide_graphic']);
				}
			}else{
				unset($this->data['Company']['wide_graphic']);
			}

			$filePath3 =  $parentDirPath.'company/tall' ;
			$this->File->setDestPath($filePath3);
			if(isset($this->data['Company']['tall_graphic']['name']) && $this->data['Company']['tall_graphic']['name'] !=''){
				##upload image
				$file_name3 = $this->File->setFileName($this->data['Company']['tall_graphic']['name']);
				$tmp3 = $this->data['Company']['tall_graphic']['tmp_name'];
				$file_name_tall = $this->File->uploadCompanyGraphic($file_name3,$tmp3,true,'210X350','tall');
				if(!empty($file_name_tall)){
					$this->data['Company']['tall_graphic'] = $file_name_tall;
				}
				else{
					unset($this->data['Company']['tall_graphic']);
				}
			}else{
				unset($this->data['Company']['tall_graphic']);
			}
			$this->Company->id = $this->data['Company']['id'];
			//print_r($this->data);die;
			if($this->Company->Save($this->data)){
				$this->Session->setFlash('Graphic added successfully.','default',array('class' => 'successmsg'));
				$this->redirect(array('controller'=>'prospects','action' =>'addgraphic', $this->data['Company']['id'],$this->data['prospects']['addtype']));
			}else{
				$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
				$this->redirect(array('controller'=>'prospects','action' =>'addgraphic', $this->data['Company']['id'],$this->data['prospects']['addtype']));
			}


		}
			
		if($companyid ){
			$this->Company->id = $companyid;
			$this->data = $this->Company->read();
		}
			
	}//end addgraphic


	/*
	 * Function name		: sendmail()
	* Description		: This function used to send mail for related merchant
	* Created On		: 20-Sept-2012
	* Created By		: Brijesh
	*/

	function sendmail($companyid =''){

		##check admin session live or not
		$usertype = $this->session_check_usertype();
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
			$this->session_check_admin();
			$current_company = $this->Session->read("current_company");
			$this->set('current_company', $current_company);
			$projectid = $this->Session->read("sessionprojectid");
			$this->set('project_id',$projectid);
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);
		App::import("Model", "Project");
		$this->Project =   & new Project();
		$condition = "id=$projectid";
		$dt=$this->Project->find('all',array("conditions"=>$condition,'fields'=>array('fromemail')));
		$this->set("dt",$dt);
		$current_domain= $_SERVER['HTTP_HOST'];
		$this->set("current_domain",$current_domain);
		$projectDetails=$this->getprojectdetails($projectid);
		##import EmailTemplate  model for processing
		App::import("Model", "EmailTemplate");
		$this->EmailTemplate =   & new EmailTemplate();
		$tomail = implode(',', $this->getRelatedCompany(2,$companyid));
		$checkempty =true;
			
		if($companyid > 0 ){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('addtype',$this->params['pass']['1']);
		}
			
		if(!empty($this->data)){
			//$this->pl($this->data);
			if($this->data['EmailTemplate']['subject']=="" || $this->data['EmailTemplate']['content']=="" || $this->data['EmailTemplate']['toid']=="" || $this->data['EmailTemplate']['fromid']==""){
				$this->Session->setFlash("All the fields are mandatory.",'default',array('class' => 'msgTXt'));
				$checkempty = false;
			}

			if($checkempty== true){
				$sendflag = true;
				$errorwith="";
				$mailtempid = $this->data['EmailTemplate']['id'];
				$mailsubject = $this->data['EmailTemplate']['subject'];
				$mailcontent = $this->data['EmailTemplate']['content'];
				$frommail = $this->data['EmailTemplate']['fromid'];
				$cid = $this->data['Company']['id'];
				//$this->data['EmailTemplate']['id'] = $companyid;
					
				/**
				 * STEP : Email Sent By Send mail , save it as Executed Task with 'Sedn Mail' as task name in task history table
				 */
				App::import("Model", "CommunicationTask");
				$this->CommunicationTask =   & new CommunicationTask();
				$this->data['EmailTemplate']['company_id'] = $companyid ;

				$taskHistoryId = $this->CommunicationTask->saveSendMailTask($this->data['EmailTemplate'], $projectid);

				if($taskHistoryId > 0){

					/** As Per discussion 12-29-2011  - Remove Mail Footer from live untile add 'Opt Out' button   **/
					///////////////////////////////// append mail footer set by super admin -U /////////////////////////
					$condition = "id='1'";
					$mailfooter_data = $this->MailFooter->find('first',array('conditions' => $condition));
					$mailfooter=$mailfooter_data['MailFooter']['footer_content'];
					$mailcontent.=$mailfooter;
					///////////////////////////////// append mail footer set by super admin /////////////////////////


					//STEP : GET EMAIL TEMP DETAILS
					$conditiontemp = "EmailTemplate.project_id = '$projectid' AND EmailTemplate.delete_status='0' AND EmailTemplate.id = '$mailtempid'";
					$templatearr = $this->EmailTemplate->find('first',array("conditions"=>$conditiontemp));
					/*  if($templatearr['EmailTemplate']['send_cc_email_to']!=""){
					 $sendCCEmail=true;
					$ccemails= $templatearr['EmailTemplate']['send_cc_email_to'];
					$ccemailtoids = explode(",",$ccemails);
					}   */

					// Set path to inserted image

					$mailcontent=$this->replaceImgPathInEmailContent($mailcontent);

					$task_email_sent_count=0;
					$task_email_senterror_count=0;
					$fromname = $projectDetails['Project']['fromname'];
					$tomail = $this->data['EmailTemplate']['toid'];
					$toids = explode(",",$tomail);

					App::import("Model", "CommunicationTaskExecutionReport");
					$this->CommunicationTaskExecutionReport =   & new CommunicationTaskExecutionReport();
					foreach($toids as $eachid){
						/**
						 * New Email Temp replacement code for data Elements
						 */
						//STEP: INIT EMAIL TEMPLATES DATA ELEMENTS
						$dataEleValuesArray=$this->EmailTemplates->initEmailTemplDataElemntsArray($projectid, $projectDetails, $eachid);
						//STEP : SET VALUES TO REQUIRED DATA ELEMENTS
						//   $this->EmailTemplates->setEmailTempDataElementValuesArray($dataEleValuesArray);
						//STEP : INSERT VALUES AT DATA ELEMETNS FOR EMAIL SUBJECT AND EMAIL MESSAGE
							
						$mailsubject1=$this->EmailTemplates->insertDataElementValuesToContent($mailsubject);
						$mailcontent1=$this->EmailTemplates->insertDataElementValuesToContent($mailcontent);

						if(!$this->Sendemail->sendMailContentWithCC($eachid,$frommail,$mailsubject1,$mailcontent1,$fromname, $templatearr['EmailTemplate']['send_cc_email_to'])){
							$sendflag = false;
							$errorwith = $eachid.','.$errorwith;
							$task_email_senterror_count++;
							$email_status="not sent";
						}else{
							$task_email_sent_count++;
							$email_status="sent";

							//STEP : CC EMAIL TO : Check cc email to of selected email template, and send cc email to that email ids
							/* if($sendCCEmail==true){
							 foreach($ccemailtoids as $eachccid){
							$this->Sendemail->sendMailContent($eachccid,$frommail,$mailsubject1,$mailcontent1,$fromname);
							}
							}   */

						}

						$errorwith = substr($errorwith,0,-1);

						//STEP : toemail holder details
						$conditionhold = "Holder.project_id = '$projectid' AND Holder.delete_status='0' AND Holder.email = '$eachid'";
						$hldarr = $this->Holder->find('first',array("conditions"=>$conditionhold));

							
						// STEP :  ADD TASK SENT EMAIL DETAILS TO COMMUNICATION_TASK_SENT_REPORT TABLE
						$taskReport['CommunicationTaskExecutionReport']['id']='';
						$taskReport['CommunicationTaskExecutionReport']['task_id']='0';
						$taskReport['CommunicationTaskExecutionReport']['task_execution_id']=$taskHistoryId;
						$taskReport['CommunicationTaskExecutionReport']['project_id']=$projectid;
						$taskReport['CommunicationTaskExecutionReport']['email_template_id']=$mailtempid;
						$taskReport['CommunicationTaskExecutionReport']['sent_to_holderid']=$hldarr['Holder']['id'];
						$taskReport['CommunicationTaskExecutionReport']['sent_to_email']=$eachid;
						$taskReport['CommunicationTaskExecutionReport']['sent_to_firstname']=$hldarr['Holder']['firstname'];
						$taskReport['CommunicationTaskExecutionReport']['sent_to_lastname']=$hldarr['Holder']['lastnameshow'];
						$taskReport['CommunicationTaskExecutionReport']['sent_to_company']='';
						$taskReport['CommunicationTaskExecutionReport']['sent_to_matching']=$sent_to_matching;
						$taskReport['CommunicationTaskExecutionReport']['email_subject']=$mailsubject1;
						$taskReport['CommunicationTaskExecutionReport']['email_content']=$mailcontent1;
						$taskReport['CommunicationTaskExecutionReport']['email_from']=$frommail;
						$taskReport['CommunicationTaskExecutionReport']['email_status']=$email_status;
						$taskReport['CommunicationTaskExecutionReport']['company_id']=$current_company;
							
						$this->CommunicationTaskExecutionReport->save($taskReport['CommunicationTaskExecutionReport']);
							
					}

					// STEP : UPDATE TASK History ARRAY
					App::import("Model", "CommunicationTaskHistory");
					$this->CommunicationTaskHistory =   & new CommunicationTaskHistory();
					$taskHistoryArray['id']=$taskHistoryId;
					$taskHistoryArray['task_sent_count']=$task_email_sent_count;
					$taskHistoryArray['task_not_sent_count']=$task_email_senterror_count;
					$taskHistoryArray['company_id']=$companyid;
					//$this->pl($taskHistoryArray);
					$this->CommunicationTaskHistory->save($taskHistoryArray);
					if($sendflag==true){
						$this->Session->setFlash('Mail sent successfully.','default', array('class' => 'successmsg'));
					} else {
						$this->Session->setFlash("Error in Mail sending with email id $errorwith. Please try again",'default',array('class' => 'msgTXt'));
					}

					##setting action for save & apply
					if(isset($this->data['Action']['redirectpage'])){

						$this->redirect(array('controller'=>'prospects','action'=>'sendmail',$cid,$this->data['prospects']['addtype']));
					}else{
						$this->redirect(array('controller'=>'prospects','action'=>'sendmail',$cid,$this->data['prospects']['addtype']));
					}

				}else{
					$this->Session->setFlash("Error in Send Mail processing. Please try again",'default',array('class' => 'msgTXt'));
				}
			}
		}

		if(isset($this->data['EmailTemplate']['id'])){
			$tempid = $this->data['EmailTemplate']['id'];
			$this->EmailTemplate->id = $tempid;
			$this->data = $this->EmailTemplate->read();
		}
		$chekret = $this->projectdetailbyid($projectid);
		$this->set('frmid',$chekret[0]['Sponsor']['email']);
		$this->set('toid',$tomail);
		$this->set('projectid',$projectid);
		$$site_type_id = '';
		$this->getmailtemplates($projectid,'2');
		$get_site_type_id=$this->Project->query("select site_type_id from project_types where id=".$chekret[0]['Project']['project_type_id']);
		$site_type_id=$get_site_type_id[0]['project_types']['site_type_id'];
		$this->set('currentprojectid',$site_type_id);
		// Get Project Types
		$this->projecttypedropdown();
		//Get Company Type Drop Down
		$companytypedropdown=$this->companytypedropdown($projectid);
		$this->set('companytypedropdown',$companytypedropdown);
		//Get Company Type Drop Down
		$contacttypedropdown= $this->contacttypedropdown($projectid);
		$this->set('contacttypedropdown',$contacttypedropdown);
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '12'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		$this->set('member_type', $this->getMemberTypesListByProject($projectid, true));
	}//end sendmail

	function getRelatedCompany($categoryid,$companyid){
		$current_company = $this->Session->read("current_company");
		$projectid = $this->Session->read("sessionprojectid");
		$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
		App::import("Model", "Company");
		$this->Company =   & new Company();
		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
						'foreignKey'=>false,
						'conditions'=>'Company.company_type_id = CompanyType.id '
				))));
		$condition .=' AND CompanyType.company_type_status_id IN (2,4) AND CompanyType.company_type_category_id = "'.$categoryid.'" AND Company.id !="'.$companyid.'" ' ;
		$fields = 'email';
		$companydtlarr = $this->Company->find('all',array("conditions"=>$condition,'fields'=>$fields ));

		$emailarray = array();
		foreach($companydtlarr as $company){
			$emailarray[] = $company['Company']['email'];
		}
		return $emailarray;
	}

	/**
	 * Function name : notelist()
	 * Description   : This function used get list of players
	 * Created On    : 20 September 2012
	 * Created By    : Brijesh
	 */


	function notelist($companyid=''){
			
		$usertype = $this->session_check_usertype();
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);
		if($companyid > 0 ){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('addtype',$this->params['pass']['1']);
		}
			
			
		if(isset($_SERVER['QUERY_STRING'])){
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}

		//for active menu display
		$this->set('page_url','notelist');

			
			
		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition

		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('project_name',$project_name);
		$projectid = $project_id;
		##fetch data from Company table for listing
		$field='';
			
		App::import("Model", "Note");
		$this->Note =   & new Note();
			
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$companyid = $this->data['prospects']['company_id'];
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "Note.company_id = '$companyid' AND Note.project_id = '$projectid' and (Note.subject LIKE '%".$searchkeyword."%' OR Note.note  LIKE '%".$searchkeyword."%' )";
		}else{
			$condition = "Note.company_id = '$companyid' AND Note.project_id = '$projectid' ";
		}

		$this->Pagination->sortByClass    = 'Note'; ##initaite pagination
		//	echo $condition .=' AND Note.company_id ="'.$current_company.'" AND Note.project_id ='.$projectid ;
			
		$this->Pagination->total= count($this->Note->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
			
		$notedtlarr = $this->Note->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		//print_r($notedtlarr); exit;
		##set project type data in variable
		$this->set("notedata",$notedtlarr);
	}

	/**
	 * Function name : addnote()
	 * Description   : This function used get list of players
	 * Created On    : 20 September 2012
	 * Created By    : Vidur
	 */

	function addnote($noteid=''){

		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		App::import("Model", "Note");
		$this->Note =   & new Note();
		//echo '<pre>';print_r($this->params);

		if($noteid > 0 ){
			$this->set('noteid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
		}

		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1']) && isset($this->params['pass']['2'])){
			$this->set('noteid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('company_id',$this->params['pass']['1']);
			$this->set('company_id',$this->params['pass']['1']);
			$this->set('addtype',$this->params['pass']['2']);
		}
		else if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$this->set('company_id',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('addtype',$this->params['pass']['1']);
		}
			
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);

		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition
			
		//for active menu display
		$this->set('page_url','notelist');

		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('projectname',$project_name);
		$this->set('project_id',$project_id);


		if(!empty($this->data)) {

			if($this->data['Note']['id']){
				$this->Note->id = $this->data['Note']['id'];
			}
			$cid =$this->data['prospects']['company_id'];
			$this->data['Note']['company_id'] = $this->data['prospects']['company_id'];
			$this->data['Note']['project_id'] =  $this->data['prospects']['project_id'];
			$this->data['Note']['type']  = 'notes';
			//echo '<pre>';print_r($this->data);die;
			if($this->Note->Save($this->data)){
				$lastid = $this->Note->getLastInsertID();
				if($lastid==''){
					$lastid = $this->data['Note']['id'];
				}

				$this->Session->setFlash('Note added successfully.','default',array('class' => 'successmsg'));
					
				if(isset($this->data['Action']['redirectpage'])){
					$this->redirect(array('controller'=>'prospects','action' =>'notelist',$cid,$this->data['prospects']['addtype']));
				} else if(isset($this->data['Action']['noredirection'])){
					$this->redirect(array('controller'=>'prospects','action' =>'addnote',$lastid,$cid,$this->data['prospects']['addtype']));
				}
					
			}else{
				$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
				$this->redirect(array('controller'=>'prospects','action' =>'addnote',$cid));
			}
		}

		if($noteid){

			$this->Note->id = $noteid;
			$this->data = $this->Note->read();
		}

	}

	/*
	 * Function name : history()
	* Description   : This function used get history list of notes and send mails
	* Created On    : 20 September 2012
	*/

	function history($companyid){

		$usertype = $this->session_check_usertype();
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
			
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);
		//echo '<pre>';print_r($this->params);
		if($companyid > 0 ){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('addtype',$this->params['pass']['1']);
		}
			
			
		if(isset($_SERVER['QUERY_STRING'])){
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}

		//for active menu display
		$this->set('page_url','history');

		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition

		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('project_name',$project_name);
		$projectid = $project_id;
			
		##import project type model for processing
		App::import("Model", "CommunicationTaskHistory");
		$this->CommunicationTaskHistory =   & new CommunicationTaskHistory();

		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
				))));

		##fetch data from Company table for listing
		$field='';
			
		##checking search key
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['Admins']['searchkey'];
			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";
		}

		// $condition .= " AND CommunicationTaskHistory.company_id = '".$companyid."'";
		//  $this->Pagination->sortByClass    = 'CommunicationTaskHistory'; ##initaite pagination
			
		// echo  "SELECT *FROM ( SELECT cth.id AS id, cth.project_id AS projectid, cth.company_id AS companyid, CTH.created AS date,cth.email_subject as subject,cth.task_note as note,cth.task_name as type FROM `communication_task_histories` AS cth WHERE cth.company_id =".$companyid." UNION ALL SELECT n.id AS id, n.project_id AS projectid, n.company_id AS companyid, n.created AS date, n.subject as subject,n.note as note,n.type as type FROM notes AS n WHERE n.company_id =".$companyid." ) AS CommunicationTaskHistory ORDER BY CommunicationTaskHistory.date desc";

		$history_Data1 = $this->CommunicationTaskHistory->QUERY("SELECT * FROM (SELECT cth.id AS id, cth.project_id AS projectid, cth.company_id AS companyid,cth.created AS date,cth.email_subject as subject,cth.task_note as note,cth.task_name as type FROM `communication_task_histories` AS cth WHERE cth.company_id =".$companyid." UNION ALL SELECT n.id AS id, n.project_id AS projectid, n.company_id AS companyid, n.created AS date, n.subject as subject,n.note as note,n.type as type FROM notes AS n WHERE n.company_id =".$companyid." ) AS CommunicationTaskHistory ORDER BY CommunicationTaskHistory.date desc");
			

		$this->Pagination->total= count($history_Data1);
		$this->Pagination->show = 5;
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
				))));

			
		//$taskdata = $this->CommunicationTaskHistory->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		##set project type data in variable
		//echo '<pre>';print_r($taskdata);
		//echo  $rows = $page * $limit;
		//echo '--'.  $offset = $rows - $limit ;
		$history_Data = $this->CommunicationTaskHistory->QUERY("SELECT *FROM ( SELECT cth.id AS id, cth.project_id AS projectid, cth.company_id AS companyid, cth.created AS date,cth.email_subject as subject,cth.task_note as note,cth.task_name as type FROM `communication_task_histories` AS cth WHERE cth.company_id =".$companyid." UNION ALL SELECT n.id AS id, n.project_id AS projectid, n.company_id AS companyid, n.created AS date, n.subject as subject,n.note as note,n.type as type FROM notes AS n WHERE n.company_id =".$companyid." ) AS CommunicationTaskHistory ORDER BY CommunicationTaskHistory.date desc");
		//echo '<pre>dd';print_r($history_Data);
		$this->set("taskdata",$history_Data);
	}
	/**
	 * Function name : notelist()
	 * Description   : This function used get list of players
	 * Created On    : 20 September 2012
	 * Created By    : Brijesh
	 */


	function notelists($companyid=''){
			
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();

			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}

		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1']) && isset($this->params['pass']['2'])){
			$params =  $this->params['pass']['2'];
			$this->set('params' , $this->params['pass']['2']);
			$this->set('cid' , $this->params['pass']['1']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){

			$params =  $this->params['pass']['1'];
			$this->set('params' , $this->params['pass']['1']);
			$this->set('cid' , $this->params['pass']['0']);
			$company_name = $this->Session->read('companyName');
			$this->set('current_company_name',$company_name);

		}else if($this->params['pass']['0']){
			$companyid =  $this->params['pass']['0'];
			$this->set('cid' , $this->params['pass']['0']);

		}
			
			
		if(isset($_SERVER['QUERY_STRING'])){
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}

		//for active menu display
		$this->set('page_url','notelist');

			
			
		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition

		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('project_name',$project_name);
		$projectid = $project_id;
		##fetch data from Company table for listing
		$field='';
			
		App::import("Model", "Note");
		$this->Note =   & new Note();
			
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$companyid = $this->data['prospects']['company_id'];
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "Note.company_id = '$companyid' AND Note.project_id = '$projectid' and (Note.subject LIKE '%".$searchkeyword."%' OR Note.note  LIKE '%".$searchkeyword."%' )";
		}else{
			$condition = "Note.company_id = '$companyid' AND Note.project_id = '$projectid' ";
		}

		$this->Pagination->sortByClass    = 'Note'; ##initaite pagination
		//	echo $condition .=' AND Note.company_id ="'.$current_company.'" AND Note.project_id ='.$projectid ;
			
		$this->Pagination->total= count($this->Note->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
			
		$notedtlarr = $this->Note->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		//print_r($notedtlarr); exit;
		##set project type data in variable
		$this->set("notedata",$notedtlarr);
	}

	/**
	 * Function name : addnote()
	 * Description   : This function used get list of players
	 * Created On    : 20 September 2012
	 * Created By    : Vidur
	 */

	function addnewnote($companyid=''){
			
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		App::import("Model", "Note");
		$this->Note =   & new Note();
		//echo '<pre>';print_r($this->params['pass']);die;
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);
		if(isset($this->params['pass']['0'])){
			$companyid =  $this->params['pass']['0'];
			$this->set('cid' , $this->params['pass']['0']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$cid =  $this->params['pass']['0'];
			$this->set('cid' , $this->params['pass']['0']);
			$params =  $this->params['pass']['1'];
			$this->set('params' , $this->params['pass']['1']);

		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1']) && isset($this->params['pass']['2'])){
			$params =  $this->params['pass']['2'];
			$this->set('params' , $this->params['pass']['2']);
			$this->set('cid' , $this->params['pass']['1']);
			$comid =  $this->params['pass']['0'];
		}
		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition
			
		//for active menu display
		$this->set('page_url','notelist');

		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('projectname',$project_name);
		$this->set('project_id',$project_id);


		if(!empty($this->data)) {
			//echo '<pre>';print_r($this->data);die;
			if($this->data['Note']['id']){
				$this->Note->id = $this->data['Note']['id'];
			}
			$cid =$this->data['prospects']['company_id'];
			$this->data['Note']['company_id'] = $this->data['prospects']['company_id'];
			$this->data['Note']['project_id'] =  $this->data['prospects']['project_id'];

			if($this->Note->Save($this->data)){
				$lastid = $this->Note->getLastInsertID();
				if($lastid==''){
					$lastid = $this->data['Note']['id'];
				}
				$this->Session->setFlash('Note added successfully.','default',array('class' => 'successmsg'));
					
				if(isset($this->data['Action']['redirectpage'])){



					$this->redirect(array('controller'=>'prospects','action' =>'notelists',$cid,$this->data['prospects']['params']));


				} else if(isset($this->data['Action']['noredirection'])){

					$this->redirect(array('controller'=>'prospects','action' =>'addnewnote',$lastid,$cid,$this->data['prospects']['params'] ));

				}
					
					
			}else{
				$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
				$this->redirect(array('controller'=>'prospects','action' =>'addnewnote',$cid,$this->data['prospects']['params']));
			}
		}

		if($cid){

			$this->Note->id = $cid;
			$this->data = $this->Note->read();
		}

	}
	/*
	 * Function name		: sendmail()
	* Description		: This function used to send mail for related merchant
	* Created On		: 20-Sept-2012
	* Created By		: Brijesh
	*/

	function sendmailcat($companyid =''){

		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$current_company = $this->Session->read("current_company");
			$this->set('current_company', $current_company);

			$projectid = $this->Session->read("sessionprojectid");
			$this->set('project_id',$projectid);
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		App::import("Model", "Project");
		$this->Project =   & new Project();
		$condition = "id=$projectid";
		$dt=$this->Project->find('all',array("conditions"=>$condition,'fields'=>array('fromemail')));
		$this->set("dt",$dt);
		$current_domain= $_SERVER['HTTP_HOST'];
		$this->set("current_domain",$current_domain);
		$projectDetails=$this->getprojectdetails($projectid);
		##import EmailTemplate  model for processing
		App::import("Model", "EmailTemplate");
		$this->EmailTemplate =   & new EmailTemplate();
		$tomail = implode(',', $this->getRelatedCompany(2,$companyid));
		$checkempty =true;
		//print_r($this->params['pass']);
		$this->set('companyid',$this->params['pass']['0']);
		$this->set('cid',$this->params['pass']['0']);
		$this->set('params',$this->params['pass']['1']);
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);
		if(!empty($this->data)){

			if($this->data['EmailTemplate']['subject']=="" || $this->data['EmailTemplate']['content']=="" || $this->data['EmailTemplate']['toid']=="" || $this->data['EmailTemplate']['fromid']==""){
				$this->Session->setFlash("All the fields are mandatory.",'default',array('class' => 'msgTXt'));
				$checkempty = false;
			}

			if($checkempty== true){
				$sendflag = true;
				$errorwith="";
				$mailtempid = $this->data['EmailTemplate']['id'];
				$mailsubject = $this->data['EmailTemplate']['subject'];
				$mailcontent = $this->data['EmailTemplate']['content'];
				$frommail = $this->data['EmailTemplate']['fromid'];
				$cid = $this->data['Company']['id'];
				//$this->data['EmailTemplate']['id'] = $companyid;
					
				/**
				 * STEP : Email Sent By Send mail , save it as Executed Task with 'Sedn Mail' as task name in task history table
				 */
				App::import("Model", "CommunicationTask");
				$this->CommunicationTask =   & new CommunicationTask();
				$this->data['EmailTemplate']['company_id'] = $companyid ;
				$params = $this->data['prospects']['params'];
				//echo '<pre>';print_r($this->data);die;

				$taskHistoryId = $this->CommunicationTask->saveSendMailTask($this->data['EmailTemplate'], $projectid);

				if($taskHistoryId > 0){

					/** As Per discussion 12-29-2011  - Remove Mail Footer from live untile add 'Opt Out' button   **/
					///////////////////////////////// append mail footer set by super admin -U /////////////////////////
					$condition = "id='1'";
					$mailfooter_data = $this->MailFooter->find('first',array('conditions' => $condition));
					$mailfooter=$mailfooter_data['MailFooter']['footer_content'];
					$mailcontent.=$mailfooter;
					///////////////////////////////// append mail footer set by super admin /////////////////////////


					//STEP : GET EMAIL TEMP DETAILS
					$conditiontemp = "EmailTemplate.project_id = '$projectid' AND EmailTemplate.delete_status='0' AND EmailTemplate.id = '$mailtempid'";
					$templatearr = $this->EmailTemplate->find('first',array("conditions"=>$conditiontemp));

					/*  if($templatearr['EmailTemplate']['send_cc_email_to']!=""){
					 $sendCCEmail=true;
					$ccemails= $templatearr['EmailTemplate']['send_cc_email_to'];
					$ccemailtoids = explode(",",$ccemails);
					}   */

					// Set path to inserted image
					$mailcontent=$this->replaceImgPathInEmailContent($mailcontent);

					$task_email_sent_count=0;
					$task_email_senterror_count=0;
					$fromname = $projectDetails['Project']['fromname'];
					$tomail = $this->data['EmailTemplate']['toid'];
					$toids = explode(",",$tomail);

					App::import("Model", "CommunicationTaskExecutionReport");
					$this->CommunicationTaskExecutionReport =   & new CommunicationTaskExecutionReport();
					foreach($toids as $eachid){

						/**
						 * New Email Temp replacement code for data Elements
						 */
						//STEP: INIT EMAIL TEMPLATES DATA ELEMENTS
						$dataEleValuesArray=$this->EmailTemplates->initEmailTemplDataElemntsArray($projectid, $projectDetails, $eachid);
						//STEP : SET VALUES TO REQUIRED DATA ELEMENTS
						//   $this->EmailTemplates->setEmailTempDataElementValuesArray($dataEleValuesArray);
						//STEP : INSERT VALUES AT DATA ELEMETNS FOR EMAIL SUBJECT AND EMAIL MESSAGE
						$mailsubject1=$this->EmailTemplates->insertDataElementValuesToContent($mailsubject);
						$mailcontent1=$this->EmailTemplates->insertDataElementValuesToContent($mailcontent);

						if(!$this->Sendemail->sendMailContentWithCC($eachid,$frommail,$mailsubject1,$mailcontent1,$fromname, $templatearr['EmailTemplate']['send_cc_email_to'])){
							$sendflag = false;
							$errorwith = $eachid.','.$errorwith;
							$task_email_senterror_count++;
							$email_status="not sent";
						}else{
							$task_email_sent_count++;
							$email_status="sent";

							//STEP : CC EMAIL TO : Check cc email to of selected email template, and send cc email to that email ids
							/* if($sendCCEmail==true){
							 foreach($ccemailtoids as $eachccid){
							$this->Sendemail->sendMailContent($eachccid,$frommail,$mailsubject1,$mailcontent1,$fromname);
							}
							}   */

						}
						$errorwith = substr($errorwith,0,-1);

						//STEP : toemail holder details
						$conditionhold = "Holder.project_id = '$projectid' AND Holder.delete_status='0' AND Holder.email = '$eachid'";
						$hldarr = $this->Holder->find('first',array("conditions"=>$conditionhold));

							
						// STEP :  ADD TASK SENT EMAIL DETAILS TO COMMUNICATION_TASK_SENT_REPORT TABLE
						$taskReport['CommunicationTaskExecutionReport']['id']='';
						$taskReport['CommunicationTaskExecutionReport']['task_id']='0';
						$taskReport['CommunicationTaskExecutionReport']['task_execution_id']=$taskHistoryId;
						$taskReport['CommunicationTaskExecutionReport']['project_id']=$projectid;
						$taskReport['CommunicationTaskExecutionReport']['email_template_id']=$mailtempid;
						$taskReport['CommunicationTaskExecutionReport']['sent_to_holderid']=$hldarr['Holder']['id'];
						$taskReport['CommunicationTaskExecutionReport']['sent_to_email']=$eachid;
						$taskReport['CommunicationTaskExecutionReport']['sent_to_firstname']=$hldarr['Holder']['firstname'];
						$taskReport['CommunicationTaskExecutionReport']['sent_to_lastname']=$hldarr['Holder']['lastnameshow'];
						$taskReport['CommunicationTaskExecutionReport']['sent_to_company']='';
						$taskReport['CommunicationTaskExecutionReport']['sent_to_matching']=$sent_to_matching;
						$taskReport['CommunicationTaskExecutionReport']['email_subject']=$mailsubject1;
						$taskReport['CommunicationTaskExecutionReport']['email_content']=$mailcontent1;
						$taskReport['CommunicationTaskExecutionReport']['email_from']=$frommail;
						$taskReport['CommunicationTaskExecutionReport']['email_status']=$email_status;
						$taskReport['CommunicationTaskExecutionReport']['company_id']=$current_company;
							
						$this->CommunicationTaskExecutionReport->save($taskReport['CommunicationTaskExecutionReport']);
							
					}

					// STEP : UPDATE TASK History ARRAY
					App::import("Model", "CommunicationTaskHistory");
					$this->CommunicationTaskHistory =   & new CommunicationTaskHistory();
					$taskHistoryArray['id']=$taskHistoryId;
					$taskHistoryArray['task_sent_count']=$task_email_sent_count;
					$taskHistoryArray['task_not_sent_count']=$task_email_senterror_count;
					$taskHistoryArray['company_id']=$companyid;
					$this->CommunicationTaskHistory->save($taskHistoryArray);

					if($sendflag==true){
						$this->Session->setFlash('Mail sent successfully.','default', array('class' => 'successmsg'));
					} else {
						$this->Session->setFlash("Error in Mail sending with email id $errorwith. Please try again",'default',array('class' => 'msgTXt'));
					}

					##setting action for save & apply
					if(isset($this->data['Action']['redirectpage'])){
						$this->redirect(array('controller'=>'prospects','action'=>'sendmailcat',$cid,$params));
					}else{
						$this->redirect(array('controller'=>'prospects','action'=>'sendmailcat',$cid,$params));
					}

				}else{
					$this->Session->setFlash("Error in Send Mail processing. Please try again",'default',array('class' => 'msgTXt'));
				}
			}
		}

		if(isset($this->data['EmailTemplate']['id'])){

			$tempid = $this->data['EmailTemplate']['id'];

			$this->EmailTemplate->id = $tempid;
			$this->data = $this->EmailTemplate->read();
		}

		$chekret = $this->projectdetailbyid($projectid);
		$this->set('frmid',$chekret[0]['Sponsor']['email']);
		$this->set('toid',$tomail);

		$this->set('projectid',$projectid);
		$this->customtemplatelisting($projectid);


		$get_site_type_id=$this->Project->query("select site_type_id from project_types where id=".$chekret[0]['Project']['project_type_id']);
		$site_type_id=$get_site_type_id[0]['project_types']['site_type_id'];

		// Set Current project id
		$this->set('currentprojectid',$site_type_id);
		// Get Project Types
		$this->projecttypedropdown();
		//Get Company Type Drop Down
		$companytypedropdown=$this->companytypedropdown($projectid);
		$this->set('companytypedropdown',$companytypedropdown);

		//Get Company Type Drop Down
		$contacttypedropdown= $this->contacttypedropdown($projectid);
		$this->set('contacttypedropdown',$contacttypedropdown);

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '12'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition
		// Set memeber types
		//$this->set('member_type', $this->getMemberTypesListByProject($projectid, true));
	}

	function historylist($companyid){

		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();

			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		$company_name = $this->Session->read('companyName');
		$this->set('current_company_name',$company_name);
		if($companyid > 0 ){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
		}
		if(isset($this->params['pass']['0']) && isset($this->params['pass']['1'])){
			$this->set('companyid',$this->params['pass']['0']);
			$this->set('cid',$this->params['pass']['0']);
			$this->set('params',$this->params['pass']['1']);
		}
			
			
		if(isset($_SERVER['QUERY_STRING'])){
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}

		//for active menu display
		$this->set('page_url','history');

		//set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '41'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		//set help condition

		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('project_name',$project_name);
		$projectid = $project_id;
			
		##import project type model for processing
		App::import("Model", "CommunicationTaskHistory");
		$this->CommunicationTaskHistory =   & new CommunicationTaskHistory();

		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
				))));

		##fetch data from Company table for listing
		$field='';
			
		##checking search key
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['Admins']['searchkey'];
			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";
		}

		// $condition .= " AND CommunicationTaskHistory.company_id = '".$companyid."'";
		//  $this->Pagination->sortByClass    = 'CommunicationTaskHistory'; ##initaite pagination
		$history_Data1 = $this->CommunicationTaskHistory->QUERY("SELECT *FROM ( SELECT cth.id AS id, cth.project_id AS projectid, cth.company_id AS companyid, cth.created AS date,cth.email_subject as subject,cth.task_note as note,cth.task_name as type FROM `communication_task_histories` AS cth WHERE cth.company_id =".$companyid." UNION ALL SELECT n.id AS id, n.project_id AS projectid, n.company_id AS companyid, n.created AS date, n.subject as subject,n.note as note,n.type as type FROM notes AS n WHERE n.company_id =".$companyid." ) AS CommunicationTaskHistory ORDER BY CommunicationTaskHistory.date desc");
			

		$this->Pagination->total= count($history_Data1);
		$this->Pagination->show = 5;
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
				))));

			
		//$taskdata = $this->CommunicationTaskHistory->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		##set project type data in variable
		//echo '<pre>';print_r($taskdata);
		//echo  $rows = $page * $limit;
		//echo '--'.  $offset = $rows - $limit ;
		$history_Data = $this->CommunicationTaskHistory->QUERY("SELECT *FROM ( SELECT cth.id AS id, cth.project_id AS projectid, cth.company_id AS companyid, cth.created AS date,cth.email_subject as subject,cth.task_note as note,cth.task_name as type FROM `communication_task_histories` AS cth WHERE cth.company_id =".$companyid." UNION ALL SELECT n.id AS id, n.project_id AS projectid, n.company_id AS companyid, n.created AS date, n.subject as subject,n.note as note,n.type as type FROM notes AS n WHERE n.company_id =".$companyid." ) AS CommunicationTaskHistory ORDER BY CommunicationTaskHistory.date desc");
		//echo '<pre>dd';print_r($history_Data);
		$this->set("taskdata",$history_Data);
	}

	function activetask(){

		Configure::write('debug',0);
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			##project id for each project
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
			$projectDetails=$this->getprojectdetails($project_id);
			$this->set('project',$projectDetails);
		}
		##import project type model for processing
		App::import("Model", "CommunicationTask");
		$this->CommunicationTask =   & new CommunicationTask();
		$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
				))));
		##fetch data from project type table for listing
		$field='';
		##checking search key
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND CommunicationTask.project_id = $project_id AND CommunicationTask.email_template_type ='2' AND  (CommunicationTask.task_name LIKE '%".$searchkeyword."%'  OR EmailTemplate.email_template_name  LIKE '%".$searchkeyword."%' OR CommunicationTask. 	recur_pattern LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'  AND CommunicationTask.project_id = $project_id AND CommunicationTask.email_template_type ='2'";
		}

		$condition .= " AND CommunicationTask.task_is_done = '0' ";

		$this->Pagination->sortByClass    = 'CommunicationTask'; ##initaite pagination
		$this->Pagination->total= count($this->CommunicationTask->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
				))));
		$taskdata = $this->CommunicationTask->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("taskdata",$taskdata);
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '13'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
	}//end prospectemaillist

	/*
	 * Function name   : taskhistory()
	* Description 	  : This function used to view communication task execution history list
	* Created On      : 01-Oct-2012
	*
	*/

	function taskhistory(){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
		if($usertype==trim("user")){
			$this->session_check_user();
			$usertype = $this->Session->read("User.User.usertype");
			$userid = $this->Session->read("User.User.id");
			$projectid = $this->Session->read("projectwebsite_id");
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
			$this->session_check_admin();
			$projectid = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
			$projectDetails=$this->getprojectdetails($project_id);
			$this->set('project',$projectDetails);
		}
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}

		##set current domain
		$current_domain= $_SERVER['HTTP_HOST'];
		$this->set("current_domain",$current_domain);

		##import project type model for processing
		App::import("Model", "CommunicationTaskHistory");
		$this->CommunicationTaskHistory =   & new CommunicationTaskHistory();

		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>'email_template_id'
				))));

		##fetch data from project type table for listing
		$field='';
		##checking search key
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = " EmailTemplate.email_template_type='2' AND CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "EmailTemplate.email_template_type='2' AND CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";
		}
		$this->Pagination->sortByClass    = 'CommunicationTaskHistory'; ##initaite pagination
		$this->Pagination->total= count($this->CommunicationTaskHistory->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>'email_template_id'

				))));
		$taskdata = $this->CommunicationTaskHistory->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		##set project type data in variable
		$this->set("taskdata",$taskdata);

		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '13'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		# set help condition
	}
	/*
	 *function name : newinquiry()
	*description   : to do function show new enquiry listing
	*/
	function inquirylist(){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
			$projectDetails=$this->getprojectdetails($project_id);
			$this->set('project',$projectDetails);
		}
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}
		##import project type model for processing
		App::import("Model", "FormSubmit");
		$this->FormSubmit =  & new FormSubmit();
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = " FormSubmit.project_id='".$project_id."'  AND (FormSubmit.fld_firstname LIKE '%".$searchkeyword."%' OR FormSubmit.fld_lastname LIKE '%".$searchkeyword."%' OR FormSubmit. 	fld_company LIKE '%".$searchkeyword."%')";
		}else{
			$condition = " FormSubmit.project_id='".$project_id."' AND FormSubmit.delete_status = '0'  ";
		}
		if(isset($this->params['pass']['0'])){
			$this->set('enqtype',$this->params['pass']['0']);
			if($this->params['pass']['0']==trim("new")){
				$condition .= " AND FormSubmit.statustype_id = '0'";
			}else if($this->params['pass']['0']==trim("open")){
				$condition .= " AND FormSubmit.statustype_id = '1'";
			}else{
				$condition .= " AND FormSubmit.statustype_id IN(0,1,2,3,4,5,6,7)";
			}

		}
			
			
		$this->Pagination->sortByClass    = 'FormSubmit'; ##initaite pagination
		$this->Pagination->total= count($this->FormSubmit->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$newinquirydata = $this->FormSubmit->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("newinquirydata",$newinquirydata);

		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '13'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		# set help condition
	}//end of newinquiry listing

	/*
	 * Function name   : inquirydetail()
	* Description : This function used to add form types  for selected project
	* Created On      : 27-10-11 (Quad)
	*/
	function inquirydetail($enquiryid = '',$enqtype){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		//for active menu display
		$this->set('page_url',"inquirydetail");
		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '20'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		# check form submitted id
		$this->set('project_name',$project_name);
		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);

		$projectid=$project_id;
		$this->set('projectid',$projectid);
		App::import("Model", "FormType");
		$this->FormType =  & new FormType();

		App::import("Model", "FormSubmit");
		$this->FormSubmit =  & new FormSubmit();
		$this->set('enqtype',$enqtype);
		if(!empty($this->data)){
			//$this->pl($this->data);
			//if($this->data['prospects']['is_editable']=='1'){
			//echo "hi";exit;
			if($this->FormSubmit->Save($this->data['FormSubmit'])){
				if(isset($this->data['FormSubmit']['id'])){
					$lastinsertid = $this->data['FormSubmit']['id'];
				}else{
					$lastinsertid = $this->FormType->getLastInsertId();
				}
				$this->Session->setFlash('Form sumbitted updated successfully.','default', array('class' => 'successmsg'));
				//if($this->data['Action']['redirectpage']){
				$this->redirect(array('controller' => 'prospects','action'=>'inquirylist',$this->data['prospects']['enqtype']));
				//}
			}
			//}
			//else{
			//echo "bye";exit;
			//$this->set('nochange','nochange');
			//}

			//   echo "<pre>";  print_r($this->data['FormType']);  echo "</pre>";



		}
		$this->set('selectedtemplateresponce',"");
		$this->set('selectedtemplateproj',"");
		if($enquiryid){        // Read form type data and set it

			$this->FormSubmit->bindModel(array('belongsTo'=>array(
					'FormType'=>array(
							'foreignKey'=>false,
							'conditions'=>'FormSubmit.formtype_id = FormType.id'
					)
			)));
			$this->FormSubmit->id = $enquiryid;
			$this->data = $this->FormSubmit->read();
			$this->set('formsubmitid',$this->data['FormSubmit']['id']);
			$this->countrydroupdown();
			$this->statedroupdown();
			if($this->data['FormSubmit']['fld_country']){
				$conid = $this->data['FormSubmit']['fld_country'];
				$this->set("selectedcountry",$conid);
				##state drop down
				$this->statedroupdown($conid);
				if($this->data['FormSubmit']['fld_stprovince']){
					$statid = $this->data['FormSubmit']['fld_stprovince'];
					$this->set("selectedstate",$statid);
				}
			}
			//$this->pl($this->data);
			if($this->data['FormSubmit']){
				$this->set('formubmittedid',$enquiryid);
				$this->set('selectedtemplateresponce',$this->data['FormType']['emailtemplate_toresponce']);
				$this->set('selectedtemplateproj',$this->data['FormType']['emailtemplate_toalert_mgr']);
				$this->set('selectedcompanytype',$this->data['FormType']['company_type']);
				$this->set('selectedcontacttype',$this->data['FormType']['contact_type']);
				$this->set('selectedstatustype',$this->data['FormSubmit']['statustype_id']);
			}else{
				$this->redirect("/admins/formsubmitlist/");
			}
		}

		// GET ALL CUSTOM EMAIL TEMPLATES
		$this->customtemplatelisting($project_id);

		// GET ALL Company Types
		$this->companytypedropdown($project_id);

		// GET ALL Contact Types
		$this->contacttypedropdown($project_id);
			
		// GEt ALl Form Status types
		$this->formstatustypedropdown($project_id);

		$this->countrydroupdown();

	} //end of inquirydetailopeninquiry



	/*
	 * Function name   : responders()
	* Description : This function used to list all system auto reposnder Email Templates of related project
	* Created On      : 10-Oct-2012
	*
	*/
	function responders(){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
		if($usertype==trim("user")){
			$this->session_check_user();
			$usertype = $this->Session->read("User.User.usertype");
			$userid = $this->Session->read("User.User.id");
			$project_id = $this->Session->read("projectwebsite_id");
			$projectid = $project_id;
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
			$this->session_check_admin();
			$projectid = $this->Session->read("sessionprojectid");
			$project_id = $projectid;
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
			$projectDetails=$this->getprojectdetails($project_id);
			$this->set('project',$projectDetails);
		}

		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}

		##import EmailTemplate  model for processing
		App::import("Model", "EmailTemplate");
		$this->EmailTemplate =   & new EmailTemplate();
			
		App::import("Model", "FormType");
		$this->FormType =   & new FormType();
		##fetch data from EmailTemplate table for listing
		$field='';

		if(!empty($this->data))
		{
			//print_r($this->data);
			$searchkey=$this->data['Admins']['searchkey'];
			$varsearch='%'.$searchkey.'%';
			$condition = " EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='0'  and (EmailTemplate.is_event_temp='0' or is_event_temp='' or is_event_temp is NULL)";
		}
		else
		{
			$condition = " EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='0' and (EmailTemplate.is_event_temp='0' or is_event_temp='' or is_event_temp is NULL)";
		}
			
		$condition .= " AND (FormType.project_id IN ('0', '$projectid') || ((EmailTemplate.responder_type ='prospect' OR EmailTemplate.override_all ='1'))  )";
		
		$this->EmailTemplate->bindModel(array('belongsTo'=>array(
				'FormType'=>array(
						'foreignKey'=>false,
						'conditions'=>'FormType.emailtemplate_toresponce = EmailTemplate.id '
		))));
		

		$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination
		$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$this->EmailTemplate->bindModel(array('belongsTo'=>array(
				'FormType'=>array(
						'foreignKey'=>false,
						'conditions'=>'FormType.emailtemplate_toresponce = EmailTemplate.id'
		))));
		
		

		$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		##set EmailTemplate data in variable
		$this->set("emailtemplates",$emailtempdtlarr);

		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '10'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		# set help condition
	}


	/*
	 * Function name  : responders()
	* Description 	  : This function used to add/edit responders
	* Created On      : 03-Oct-2012
	*
	*/

	function addresponder($por=null, $templateid=''){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
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
			$this->session_check_admin();
			$projectid = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
		}
		App::import("Model", "EmailTemplate");
		$this->EmailTemplate =   & new EmailTemplate();
		$this->set("templateid",$templateid);
		$current_domain= $_SERVER['HTTP_HOST'];
		if(!empty($this->data)) {
			$this->data['EmailTemplate']['subject'] = str_replace($project_name, "[[PROJECT_NAME]]",  $this->data['EmailTemplate']['subject']);
			$this->data['EmailTemplate']['sender'] = str_replace($project_name.'.com', "[[Project Website Address]]",  $this->data['EmailTemplate']['sender']);
			if(!isset($this->data['EmailTemplate']['override_all'])){
				$this->data['EmailTemplate']['override_all'] = 0;
			}

			$this->EmailTemplate->set($this->data);
			#check server side validation
			$errormsg = $this->EmailTemplate->invalidFields();
			$templname = $this->data['EmailTemplate']['email_template_name'];
			if($por=='edit'){
				$templateid = $this->data['EmailTemplate']['id'];
			}
			if(!$errormsg){
				$condition = "email_template_name = '".$templname."' AND project_id = 0 AND  delete_status = '0' ";
				if($por=='edit'){
					$condition .= "AND id !='".$templateid."'";
				}
				##check already exists company name
				$ctdata = $this->EmailTemplate->find('all',array("conditions"=>$condition));
				$this->data['EmailTemplate']['content']=str_replace("../img","http://".$current_domain."/img",$this->data['EmailTemplate']['content']);

				if(!$ctdata){
					
					$this->data['EmailTemplate']['project_id'] = $projectid;
					
					if(isset($this->data['EmailTemplate']['id'])){
						unset($this->data['EmailTemplate']['project_id']);
					}
					
					if($this->EmailTemplate->Save($this->data['EmailTemplate'])){

						if($por=='edit'){
							$this->Session->setFlash('Template updated Successfully.','default', array('class' => 'successmsg'));
						}else{
							$this->Session->setFlash('Template added Successfully.','default', array('class' => 'successmsg'));
						}
						if(isset($this->data['Action']['redirectpage'])){
							$sessdata=$this->Session->read('newsortingby');
							$this->redirect('/'.$sessdata);
						}else{
							$this->redirect('/prospects/addresponder/edit/'.$templateid);
						}
						//$this->redirect('/admins/mailtemplatelist');

					}else{
						$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
					}
				}else{
					$this->Session->setFlash('Template with same name already exists.','default',array('class' => 'msgTXt'));
				}
			}else{
				$this->Session->setFlash('Please provide email content.','default',array('class' => 'msgTXt'));
			}
			if(isset($errormsg)){
				$this->data['EmailTemplate']['content']="";
			}
		}

		$this->set("override_all", 0);
		$this->set("isreadonly",'1');
		$this->set("relationshiptype",'');
		if($templateid != ""){
			$this->set("templateid",$templateid);
			$this->EmailTemplate->id = $templateid;
			$this->data = $this->EmailTemplate->read();
			$this->set("override_all", $this->data['EmailTemplate']['override_all']);
			$this->set("relationshiptype", $this->data['EmailTemplate']['relationship_type'] );
			
			$isreadonly= (isset($this->data['EmailTemplate']['project_id']) &&  ($this->data['EmailTemplate']['project_id'] != '0' || $usertype =='admin')) ? '0': '1';
        	$this->set("isreadonly",$isreadonly);
			
			$this->data['EmailTemplate']['subject'] = str_replace("[[PROJECT_NAME]]", $project_name ,  	$this->data['EmailTemplate']['subject']);
			$this->data['EmailTemplate']['sender'] = str_replace("[[Project Website Address]]", $project_name.".com", $this->data['EmailTemplate']['sender']);
		}

		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '22'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		# set help condition

		//$this->set("respondertype",$respondertype);

	}


	/*
	 * Function name   : responderhistory()
	* Description 	   : This function used to list of reposnder Email Templates of related project
	* Created On       : 04-Oct-2012
	*
	*/
	function responderhistory(){
		$usertype = $this->session_check_usertype();
		$this->set('usertype',$usertype);
		if($usertype==trim("user")){
			$this->session_check_user();
			$usertype = $this->Session->read("User.User.usertype");
			$userid = $this->Session->read("User.User.id");
			$project_id = $this->Session->read("projectwebsite_id");
			$projectid  = $project_id ;
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
			$this->session_check_admin();
			$project_id = $this->Session->read("sessionprojectid");
			$project_name=$this->Session->read("projectwebsite_name_admin");
			$this->set('current_project_name',$project_name);
			$this->set('project_id',$project_id);
			$projectDetails=$this->getprojectdetails($project_id);
			$this->set('project',$projectDetails);
			$projectid = $project_id;
		}
		##import project type model for processing
		App::import("Model", "EmailTemplate");
		$this->EmailTemplate =   & new EmailTemplate();

		##import project type model for processing
		App::import("Model", "CommunicationTaskHistory");
		$this->CommunicationTaskHistory =   & new CommunicationTaskHistory();

		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
				))));

		##fetch data from project type table for listing
		$field='';
		##checking search key
		if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){
			$searchkeyword = $this->data['prospects']['searchkey'];
			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";
		}
			
		$condition .= " AND (EmailTemplate.responder_type ='player' OR EmailTemplate.override_all ='1')  " ;
			
			
		$this->Pagination->sortByClass    = 'CommunicationTaskHistory'; ##initaite pagination
		$this->Pagination->total= count($this->CommunicationTaskHistory->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
				))));
		$responderhistorydata = $this->CommunicationTaskHistory->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));


		##set project type data in variable
		$this->set("responderhistorydata",$responderhistorydata);

		# set help condition
		App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '13'";
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);
		# set help condition

		$current_domain= $_SERVER['HTTP_HOST'];
		$this->set('current_domain',$current_domain);
	}


}
?>