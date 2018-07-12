<?php
ob_start();
/*Project		  :-
 * Controller Name :-  players_contoller.php
* Created  On     :-  17-05-12
* Created By	  :-  Vidhur
*/
class PlayersController extends AppController
{
	var $name = 'players';
	//var $uses = 'Setup';
	var $layout = 'new_admin_layout';
	var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
	var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
	var $uses     = array('Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term','Category','Offer','CompanyToCategory','OfferToCategory','NonProfitType', 'RelatedProject', 'RelatedNonProfit','ProspectNonProfit','CompanyToContact','RelatedProject');
	
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

	/**
	 * Function name : playerslist()
	 * Description   : This function used get list of players
	 * Created On    : 05 September 2012
	 * Created By    : Vidur
	 */

	function playerslist($option='company'){
		
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
		
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}
			
		//for active menu display
		$this->set('page_url','playerslist');
			
		$companytypecategoryid = $this->getCompanyCategory($option) ;
		
			
		$this->set('companytypecategoryid',$companytypecategoryid);
		$this->set('option',$option);
			
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
		
		$this->Company->bindModel(array('hasAndBelongsToMany'=>array(
				'Category'=>array(
						'joinTable'              => 'company_to_categories',
						'foreignKey'             => 'company_id',
						'associationForeignKey'  => 'category_id'
		))));
		
		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
						'foreignKey'=>'company_type_id'
		))));
		
		$this->CompanyType->bindModel(array('belongsTo'=>array(
				'CompanyTypeCategory'=>array(
						'foreignKey'=>'company_type_category_id'
		))));
		
		$this->Company->bindModel(array('belongsTo'=>array(
				'NonProfitType'=>array(
						'foreignKey'=>'non_profit_type_id'
		))));
		
		$this->Company->recursive = 2;
		
		if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
			$searchkeyword = $this->data['players']['searchkey'];
			
			$condition = "Company.delete_status = '0' AND Company.project_id = '$project_id' and (Company.company_name LIKE '%".$searchkeyword."%' OR CompanyType.company_type_name  LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%' OR Company.city LIKE '%".$searchkeyword."%' OR Company.website LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%' OR Company.state LIKE '%".$searchkeyword."%' )";
			/*$searchkeywordlocation ='';
			if(strcmp($searchkeyword, 'hq')){
				$searchkeywordlocation = 0;
			}else { 	
				if(strcmp($searchkeyword, 'branch'))
					$searchkeywordlocation = 1 ;
			}
			
			switch($companytypecategoryid){
				case 7:
					$condition = "Company.delete_status = '0' AND Company.project_id = '$project_id' and (Company.company_name LIKE '%".$searchkeyword."%' OR CompanyType.company_type_name  LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%' OR Company.city LIKE '%".$searchkeyword."%' OR Company.website LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%' OR Company.state LIKE '%".$searchkeyword."%' )";
					break;
				case 2:
					$condition = "Company.delete_status = '0' AND Company.project_id = '$project_id' and (Company.company_name LIKE '%".$searchkeyword."%' OR CompanyType.company_type_name  LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%' OR Company.city LIKE '%".$searchkeyword."%' OR Company.website LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%' OR Company.state LIKE '%".$searchkeyword."%' OR Company.location_type_id LIKE '%".$searchkeywordlocation."%' )";
					break;
			}*/
		}else{
			$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
		}

	   $this->Pagination->sortByClass    = 'Company'; ##initaite pagination
		
	    $this->Company->bindModel(array('hasAndBelongsToMany'=>array(
				'Category'=>array(
				'joinTable'              => 'company_to_categories',
				'foreignKey'             => 'company_id',
				'associationForeignKey'  => 'category_id'		
		))));
		
		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
				'foreignKey'=>'company_type_id'
		))));
		
		$this->CompanyType->bindModel(array('belongsTo'=>array(
				'CompanyTypeCategory'=>array(
				'foreignKey'=>'company_type_category_id'
		))));
		
		$this->Company->bindModel(array('belongsTo'=>array(
				'NonProfitType'=>array(
						'foreignKey'=>'non_profit_type_id'
		))));
		
		$this->Company->recursive = 2;
		
        if($companytypecategoryid != '7')
			$condition .=' AND CompanyType.company_type_status_id IN (3,5) AND CompanyType.company_type_category_id ='.$companytypecategoryid ;
        else
            $condition .=' AND CompanyType.company_type_status_id IN (3,5) AND CompanyType.company_type_category_id NOT IN(1,2,3,4,5,6)';

		$this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$this->Company->bindModel(array('hasAndBelongsToMany'=>array(
				'Category'=>array(
						'joinTable'              => 'company_to_categories',
						'foreignKey'             => 'company_id',
						'associationForeignKey'  => 'category_id'
		))));
		
		$this->Company->bindModel(array('belongsTo'=>array(
				'CompanyType'=>array(
				 'foreignKey'=>'company_type_id'
		))));
		
		
		
		$this->CompanyType->bindModel(array('belongsTo'=>array(
				'CompanyTypeCategory'=>array(
				'foreignKey'=>'company_type_category_id'
		))));
		
		$this->Company->bindModel(array('belongsTo'=>array(
				'NonProfitType'=>array(
						'foreignKey'=>'non_profit_type_id'
		))));


		$this->Company->recursive = 2;
		
		$companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
					
		//$this->pl($companydtlarr);
		##set project type data in variable
		$this->set("companydata",$companydtlarr);
				
		$this->Session->delete('current_company');
				
	}//end playerslist()
	
	

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


	function changestatus($recid,$modelname,$status,$methodname,$action='cngstatus',$param=''){
			
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
			$i=$this->$modelname->delete($recid);
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
		$this->redirect("$methodname/$param");

	}//end of changestatus()
 
	/*
	 * Function name	: adddetail()
	 * Description      : This function used to add company for project
	 * Created On       : 06-September-2012
	 */
	 
	function adddetail($option='company', $companyid='', $hqid=0){
		
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
				$project_id = $this->Session->read("sessionprojectid");
				$project_name=$this->Session->read("projectwebsite_name_admin");
				$this->set('current_project_name',$project_name);
				$this->set('project_id',$project_id);
				$projectid = $project_id;
				$this->set('project_name',$projectDetails['Project']['project_name']);
			}
			##import Company  model for processing
			App::import("Model", "Company");
			$this->Company =   & new Company();
			$flagbranch = $companyid;
			//echo '<pre>';print_r($this->params);die;
			if(isset($this->params['params']['0'])){
				 $str_type =$this->params['params']['0'];
				if($str_type==trim('company')){
					$this->set('selectedcompanytype','3');
				}
			}		
		if($companyid !='branch' && $companyid !='' ){
			$this->Session->write("current_company", $companyid);
			$this->set('current_company', $this->Session->read("current_company"));
		}else{
			if($companyid =='branch'){
				$this->set('current_company', $this->Session->read("current_company"));
			}else{
				$this->set('current_company', '-1');
			}
		}
		
		$flag_branch = '';
		$this->set('editbranch', '');
		if(strpos($option, '-branch')){
			$strary  = split('-',$option);
			$option = $strary[0];
			$flagbranch = $strary[1];
			$flag_branch ='branch';
			$this->set('showbranch', FALSE);
			$this->set('editbranch', '/'.$option.'-branch');
		}
				
		$branchurl ='';
		if($companyid =='branch'){
			$this->set('isbranch', '/'.$option.'/branch');
			$branchurl = '/branch';
		}else{
			$this->set('isbranch', '');
		}
		
		if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
			$currentcompany = $this->Company->findById($this->Session->read("current_company"));
			$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
		}else{
			$this->set('current_company_name', '');
		}

		$option = (isset($this->data['players']['option']))?$this->data['players']['option']:$option;
		
		$companytypecategoryid = $this->getCompanyCategory($option);

		$this->set('option',$option);
		$this->set('companytypecategoryid',$companytypecategoryid);

		##project id for each project
		
		 
		
		
		//for active menu display
		$this->set('page_url','adddetail/'.$option.'/'.$companyid);
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
		
		$this->set("selectedcountry",'');
		$this->set("selectedstate",'');
		$this->set("location_type_id",'0');
		$relatedproductid = array();
		$relatednonprofitid = array();
	  //$prospectnonprofitsids = array();
		$companytocontact = array();
		
		#Targets/Related Project (Merchant)
		if($companytypecategoryid == 2 || $companytypecategoryid == 4) {
			$this->CompanyType->bindModel(array('hasMany'=>array(
						'Project'=>array(
						'foreignKey'=>'project_type_id'
			))));
			$targetconditions = array('Project.project_type_id' =>'38');
			$targetProject = $this->Project->find('all',array('conditions' => $targetconditions));
			$this->set('targetProject',$targetProject);
		}//End
		
		##check empty data
		if(!empty($this->data)) {
				$this->data['Company']['project_id'] = $projectid;
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
						
						unset($this->data['Company']['category_id']);
						
						if(isset($this->data['Company']['non_profit_type_id']) && $companytypecategoryid == 4 )
								$nonprofittypeid = $this->data['Company']['non_profit_type_id'];
						
						if($companytypecategoryid == 2 || $companytypecategoryid == 4) {
							if(!empty($this->data['RelatedProject']['ids']))
									$relatedprojectids = $this->data['RelatedProject']['ids'];
											
							if(!empty($this->data['RelatedNonProfit']['ids']))
									$relatednonprofitids = $this->data['RelatedNonProfit']['ids'];
						}
		
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
		
								if(!$this->data['Company']['location_type_id']){
										unset($this->data['Company']['hq_id']);
								}
								if($this->Company->Save($this->data)){
										## insert company and category
										$company_id = $this->Company->getLastInsertID();
										
										if($company_id ==''){
											$company_id = $this->data['Company']['id'];
										}
								
										//Category (Merchant)
										if($company_id && ($companytypecategoryid == 2) ){
											$this->CompanyToCategory->deleteAll( array('CompanyToCategory.company_id'=>$company_id));
											foreach($this->data['Category']['category_id'] as $key=>$val ){
												$categorydata[] = array('company_id' =>$company_id,'category_id' => $val);
											}
											$flag = $this->CompanyToCategory->saveAll($categorydata); 																											                                
										}//End
										
										//Related Project (Mercahant and Non-Profit )
										if(!empty($this->data['Project']['ids']) && ($companytypecategoryid == 2 || $companytypecategoryid == 4)){
											$this->RelatedProject->deleteAll( array('RelatedProject.company_id'=>$company_id));
											foreach($this->data['Project']['ids'] as $key=>$proval){
												$relatedprojectdata[] = array( 'project_id'=>$proval,'company_id'=>$company_id);
											}
											$flag = $this->RelatedProject->saveAll($relatedprojectdata);
										}//End
										
										//Related Non Profit ( Merchant )
										if(!empty($this->data['RelatedNonProfit']['ids']) && ($companytypecategoryid == 2) ){
													$this->RelatedNonProfit->deleteAll( array('RelatedNonProfit.company_id'=>$company_id));
													foreach($this->data['RelatedNonProfit']['ids'] as $key=>$rnpval){
														$relatednonprofitprojectdata[] = array( 'nonprofit_id'=>$rnpval,'company_id'=>$company_id);
													}
													$flag = $this->RelatedNonProfit->saveAll($relatednonprofitprojectdata);
										}//End
		
										//Prospect Non-Profit
										/*if(!empty($this->data['ProspectNonProfit']['ids'])){
												$this->ProspectNonProfit->deleteAll( array('ProspectNonProfit.company_id'=>$company_id));
												foreach($this->data['ProspectNonProfit']['ids'] as $key=>$rnpval){
														$relatedprospectdata[] = array( 'prospect_non_profit_id'=>$rnpval,'company_id'=>$company_id);
												}
												$flag = $this->ProspectNonProfit->saveAll($relatedprospectdata);
										}*/
										//end
										
										//Contact
										if(isset($this->data['Contact']['id'])){
												$this->CompanyToContact->deleteAll(array('CompanyToContact.company_id'=>$company_id));
												foreach($this->data['Contact']['id'] as $key=>$val ){
														$contactdata[] = array('contact_id'=>$val, 'company_id' =>$company_id,'project_id'=>$projectid);
												}
												$flag = $this->CompanyToContact->saveAll($contactdata);
										}//end
								}
								
								if($cid){
										
										if(isset($this->data['Action']['redirectpage'])){
												//$sessdata=$this->Session->read('newsortingby');
												//$this->redirect('/'.$sessdata);
												if($flagbranch == 'branch'){
													$this->Company->id = $this->Session->read("current_company");
													$hqcompany = $this->Company->read();
													$this->Session->setFlash(ucfirst($option).' Branch updated Successfully.','default', array('class' => 'successmsg'));
													$this->redirect('/players/branchlist/'.$option.'/'.$hqcompany['Company']['hq_id']);
												}else{
													$this->Session->setFlash(ucfirst($option).' updated Successfully.','default', array('class' => 'successmsg'));
													$this->redirect('/players/playerslist/'.$option);
												}
										}else{
											if($flagbranch == 'branch'){
												$this->redirect(array('controller'=>'players','action' =>'adddetail', $option.$branchurl ,$cid));
											}else{
												$this->redirect(array('controller'=>'players','action' =>'adddetail', $option ,$cid));
											}
										}
								}else{
										App::import("Model", "Content");
										$this->Content = & new Content();
										$this->Content->save_content($projectid, ucfirst($option).' Web Page', ucfirst($option).' Home', $option.'-page', WEBPAGE , '0', $company_id);
										$this->Content->getLastInsertID();
									
										
										if(isset($this->data['Action']['redirectpage'])){
												//$sessdata=$this->Session->read('newsortingby');
												//$this->redirect('/'.$sessdata);
												if($flagbranch == 'branch'){
													$this->Session->setFlash(ucfirst($option).' Branch Added Successfully.','default', array('class' => 'successmsg'));
													$this->redirect('/players/branchlist/'.$option.'/'.$this->Session->read("current_company"));
												}else{
													$this->Session->setFlash(ucfirst($option).' Added Successfully.','default', array('class' => 'successmsg'));
													$this->redirect('/players/playerslist/'.$option);
												}
										}else{
												$this->redirect(array('controller'=>'players','action' =>'adddetail', $option.$branchurl));
										}
								}
						}else{
								$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
						}
					}else{
						$this->Session->setFlash(ucfirst($option).' with same name already exists.','default',array('class' => 'msgTXt'));
					}
				}
				
				if($companyid && $companyid !=$option){
						$this->Company->bindModel(array('hasMany'=>array(
							'CompanyToCategory'=>array(
							'foreignKey'=>'company_id'
						))));
		
						if($companytypecategoryid == 2 || $companytypecategoryid == 4){
							$this->Company->bindModel(array('hasMany'=>array(
									'RelatedProject'=>array(
									'foreignKey'=>'company_id'
							))));
						}
						
						if($companytypecategoryid == 2){
							$this->Company->bindModel(array('hasMany'=>array(
									'RelatedNonProfit'=>array(
									'foreignKey'=>'company_id'
							))));
						}
		
						/*$this->Company->bindModel(array('hasMany'=>array(
							'ProspectNonProfit'=>array(
							'foreignKey'=>'company_id'
						)))); */
										
						$this->Company->bindModel(array('hasMany'=>array(
								'CompanyToContact'=>array(
								'foreignKey'=>'company_id'
						))));
						
						if($this->Session->check("current_company") && $companyid=='branch'){
							$companyid = $this->Session->read("current_company");
						}
						
						$this->Company->id = $companyid;
						$this->data = $this->Company->read();
						
						#Categories (Merchant)
						if($companytypecategoryid == 2){
							$categories =  $this->data['CompanyToCategory'];
							for($j=0; $j< count($categories); $j++){
								$categoryids[$j]=$categories[$j]['category_id'];
							}
						}#End
						
						#Company To Contact
						$companytocontact =  $this->data['CompanyToContact'];
						for($j=0; $j< count($companytocontact); $j++){
								$companytocontact[$j]=$companytocontact[$j]['contact_id'];
						}

						#Related Project(Merchant and Non-Profit)
						if($companytypecategoryid == 2 || $companytypecategoryid == 4){
								$relatedproducts =  $this->data['RelatedProject'];
								for($j=0; $j< count($relatedproducts); $j++){
										$relatedproductid[$j]=$relatedproducts[$j]['project_id'];
								}
						}
		
						#Related Non-Profit(Merchant)
						if($companytypecategoryid == 2){
							$relatednonprofits =  $this->data['RelatedNonProfit'];
							for($j=0; $j< count($relatednonprofits); $j++){
									$relatednonprofitid[$j]=$relatednonprofits[$j]['nonprofit_id'];
							}
						}

						#Prospect Non-Profit
						/*
						$prospectnonprofits =  $this->data['ProspectNonProfit'];
						for($j=0; $j< count($prospectnonprofits); $j++){
							$prospectnonprofitsids[$j]=$prospectnonprofits[$j]['prospect_non_profit_id'];
						}*/

						$contactname="";
						##import Contacts  model for processing
						App::import("Model", "Contact");
						$this->Contact =   & new Contact();
						
						##Relation with Company
						$this->Contact->bindModel(array('belongsTo'=>array(
										'ContactType'=>array(
												'foreignKey'=>false,
												'conditions'=>'Contact.contact_type_id = ContactType.id'
										),
										'Company'=>array(
												'foreignKey'=>false,
												'conditions'=>'Contact.company_id = Company.id'
										)
						)));
		
						$condition2 = "Contact.company_id = '".$companyid."' AND  Contact.delete_status = '0'";
						$condata = $this->Contact->find('all',array("conditions"=>$condition2));
						
						if($condata){
								$contactname = Set::combine($condata, '{n}.Contact.id', array('%s %s','{n}.Contact.firstname', '{n}.Contact.lastname'));
						}
						$this->set('contacts',$contactname);
													
						$other_locations = $this->otherLocations($this->data['Company']['id'], $this->data['Company']['hq_id'],$this->data['Company']['location_type_id']);
						$this->set('other_locations',$other_locations);
					}
													
		
					//if($companyid && $companyid == $option){
					if($flagbranch && $flagbranch == 'branch'){
							$this->set("location_type_id",'1');
							if($flag_branch =='branch'){
								$this->set("hq_id", $this->data['Company']['hq_id']);
							}else {
								$this->set("hq_id", $this->Session->read("current_company") );
							}
           		 	}else{
		            		$this->set("location_type_id", $this->data['Company']['location_type_id']);
           		 	}
           		 

					if($this->data['Company']['company_type_id']){
							$this->set("selectedcompanytype",$this->data['Company']['company_type_id']);
					}else{
            				//$this->set("selectedcompanytype","");
					}
			
					if($this->data['Company']['non_profit_type_id']){
						$this->set("selectednonprofittype",$this->data['Company']['non_profit_type_id']);
					}else{
						$this->set("selectednonprofittype","");
					}
													
					$this->getCompanyTypeDropdown($project_id, $companytypecategoryid, array(3,5));
					
					$contactdatadropdown = $this->getprojectcontact($project_id);
					$this->set("contactdatadropdown", $contactdatadropdown);
						
					if($companytypecategoryid == 4)
							$this->getnonprofittype();

					if($companytypecategoryid == 2){
							$releatednonprofitdata = $this->releatednonprofit($project_id,5);
							$this->set("releatednonprofit", $releatednonprofitdata);
					}
					
					
							
					//$prospectnonprofit = $this->releatednonprofit($project_id,2);
					//$this->set("prospectnonprofit", $prospectnonprofit);

					#Country Dropdown
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

					## Categry Dropdown
					if($companytypecategoryid == 2) {
							$this->categorydropdown();
							$this->set("selectedcategory",'');
							if(!empty($categoryids)){
									$this->set("selectedcategory",$categoryids);
							}
					}
						
					if(!empty($relatedproductid) && ($companytypecategoryid == 2 || $companytypecategoryid == 4) ){
							$this->set("checkedrelproject",$relatedproductid);
					}
														
					$prodtl = $this->projectdetailbyid($projectid);

					//$sponname = $this->getsponsornamebyprojectid($projectid);
					//$this->set('sponorname',$sponname);
							
					$projectname = $prodtl[0]['Project']['project_name'];
					$this->set('projectname',$projectname);
					$this->set('projectdata' , $prodtl);
		
			
					#Related Project
					/*if($companytypecategoryid == 2 || $companytypecategoryid == 4){
							$this->getProjectList($relatedproductid);
					}*/

					#Related Non Profit (Merchant)
						
					if($companytypecategoryid == 2){
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
					}
						
					//$this->set("prospectnonprofitid",$prospectnonprofitsids);
					$this->set("companytocontact",$companytocontact);
      }//End adddetail();


      /**
       * Function name : branchlist()
       * Description   : This function used get list of players
       * Created On    : 07 September 2012
       * Created By    : Vidur
       */
      
      function branchlist($option='company', $companyid ='-1'){
      		
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
		      		$this->set('current_company', $this->Session->read("current_company"));      		
		      		$project_id = $this->Session->read("sessionprojectid");
		      		$project_name=$this->Session->read("projectwebsite_name_admin");
      				$this->set('current_project_name',$project_name);
			}		
      		$projectDetails=$this->getprojectdetails($project_id);
      		$this->set('project',$projectDetails);
      		$project_name=$projectDetails['Project']['project_name'];
      		$this->set('project_name',$project_name);
      		$projectid = $project_id;
			
      		$this->set('isbranchlist','1');
      		$this->set('showbranch', TRUE);
      		if(isset($_SERVER['QUERY_STRING'])){
      				$this->Session->delete("newsortingby");
      				$strloc=strpos($_SERVER['QUERY_STRING'],'=');
      				$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
      				$this->Session->write("newsortingby",$strdata);
      		}

      		//for active menu display
      		$this->set('page_url','branchlist');
      		
      		$companytypecategoryid = $this->getCompanyCategory($option) ;
      		
      		$this->set('companytypecategoryid',$companytypecategoryid);
      		$this->set('option',$option);
      		
	      	//set help condition
	      	App::import("Model", "HelpContent");
	      	$this->HelpContent =  & new HelpContent();
	      	$condition = "HelpContent.id = '41'";
	      	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
	      	$this->set("hlpdata",$hlpdata);
	      	//set help condition
	      		
	      	
	      	##fetch data from Company table for listing
	      	$field='';
	      	App::import("Model", "Company");
	      	$this->Company =   & new Company();
	      	if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
	      		$searchkeyword = $this->data['players']['searchkey'];
	      		$condition = "Company.delete_status = '0' AND Company.project_id = '$project_id' and (Company.company_name LIKE '%".$searchkeyword."%' OR CompanyType.company_type_name  LIKE '%".$searchkeyword."%' OR Company.website  LIKE '%".$searchkeyword."%' OR Company.email LIKE '%".$searchkeyword."%' OR Company.phone LIKE '%".$searchkeyword."%')";
	      	}else{
	      		$condition = "Company.delete_status = '0' AND Company.project_id = '$projectid'";
	      	}
	      
	      	$this->Pagination->sortByClass    = 'Company'; ##initaite pagination
	      	$this->Company->bindModel(array('belongsTo'=>array(
	      			'CompanyType'=>array(
	      			'foreignKey'=>false,
	      			'conditions'=>'Company.company_type_id = CompanyType.id'
	      	))));
	      	$condition .=' AND Company.hq_id ="'.$companyid.'" AND CompanyType.company_type_status_id IN (3,5) AND CompanyType.company_type_category_id ='.$companytypecategoryid ;
	      	$this->Pagination->total= count($this->Company->find('all',array("conditions"=>$condition)));
	      	list($order,$limit,$page) = $this->Pagination->init($condition,$field);
	      	$this->Company->bindModel(array('belongsTo'=>array(
	      			'CompanyType'=>array(
	      			'foreignKey'=>false,
	      			'conditions'=>'Company.company_type_id = CompanyType.id '
	      	))));
	      	
	      	$companydtlarr = $this->Company->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
	      				
	      	##set project type data in variable
	      	$this->set("companydata",$companydtlarr);
	      	
	      	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
	      		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
	      		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
	      	}else{
	      		$this->set('current_company_name', '');
	      	}
	      	
      }//end branchlist()
      
      
      
      function addgraphic($option='company', $companyid=''){
      
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
	      	$companytypecategoryid = $this->getCompanyCategory($option) ;      
	      	$this->set('option',$option);
	      	$this->set('companytypecategoryid',$companytypecategoryid);
    	  	$this->set('companyid',$companyid);
      		$this->set('current_company', $this->Session->read("current_company"));
      	
      	App::import("Model", "Company");
      	$this->Company =   & new Company();
      	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
      		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
      		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
      	}else{
      		$this->set('current_company_name', '');
      	}

      	
      	
      	
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
      		
      		if($this->Company->Save($this->data)){
      			$this->Session->setFlash('Graphic added successfully.','default',array('class' => 'successmsg'));
      			$this->redirect(array('controller'=>'players','action' =>'addgraphic', $option ,$this->data['Company']['id']));
      		}else{
      			$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
      			$this->redirect(array('controller'=>'players','action' =>'addgraphic', $option));
      		}
      		
      		
      	}
      	
      	if($companyid && $companyid !=$option ){	
      		$this->Company->id = $companyid;
      		$this->data = $this->Company->read();
      	}
      	
      	
      }
      
      
      function addwebpage($option='company', $companyid=''){
       	
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
	      	$companytypecategoryid = $this->getCompanyCategory($option) ;
	      	
	      	$this->set('option',$option);
	      	$this->set('companytypecategoryid',$companytypecategoryid);
	      	$this->set('companyid',$companyid);
	       	$current_company = $this->Session->read("current_company");
	      	$this->set('current_company', $current_company );
	      	
	      	App::import("Model", "Company");
	      	$this->Company =   & new Company();
	      	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
	      		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
	      		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
	      	}else{
	      		$this->set('current_company_name', '');
	      	}
	      	
	      	//for active menu display
	      	$this->set('page_url','webpagelist');	      	 
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
	      	
	      	App::import("Model", "Content");
	      	$this->Content =  & new Content();
	      	
	      	if(!empty($this->data)) {
	      		$this->Content->id = $this->data['Content']['id'];
	      		if($this->Content->Save($this->data)){
	      				$this->Session->setFlash('Web updated successfully.','default',array('class' => 'successmsg'));
	      				$this->redirect(array('controller'=>'players','action' =>'addwebpage', $option));
	      		}else{
	      				$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
	      				$this->redirect(array('controller'=>'players','action' =>'addwebpage', $option));
	      		}
	      	}
	      	
	      	if($current_company){
	      		$condition = ' Content.project_id = "'.$project_id.'" AND Content.company_id = "'.$current_company.'" ';
	      		$this->data = $this->Content->find($condition);
	      		$this->set('selectedwebpage', $this->data['Content']['id']);
	      		$this->getCompanyWebPageList($project_id, $current_company);
	      	}else{
	      		$this->getCompanyWebPageList($project_id);
	      	}
	      	
	      	
      }
      
      function offerlist($option='company', $companyid ='-1'){
      	
		##check user session live or not
		$this->session_check_admin();
		$this->set('current_company', $this->Session->read("current_company"));      		
		$project_id = $this->Session->read("sessionprojectid");
		$project_name=$this->Session->read("projectwebsite_name_admin");
		$this->set('current_project_name',$project_name);
		
		$projectDetails=$this->getprojectdetails($project_id);
		$this->set('project',$projectDetails);
		$project_name=$projectDetails['Project']['project_name'];
		$this->set('project_name',$project_name);
		$projectid = $project_id;
		
		##fetch data from Company table for listing	
		//$current_date=date('Y-m-d');
		
		App::import("Model", "Offer");
		$this->Offer =   & new Offer();
				
		if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){
			 echo $searchkeyword = $this->data['Offer']['searchkey'];exit;
			 $condition = "Offer.project_id = '".$project_id."' and Company.id = '".$companyid."' and Offer.delete_status ='0' and (Company.company_name LIKE '%".$searchkeyword."%' OR Category.category_name LIKE '%".$searchkeyword."%' OR Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' OR OfferTypeTemplate.offer_type_template_name LIKE '%".$searchkeyword."%' )";
		}else{
			  $condition = "Offer.project_id = '".$project_id."' and Company.id = '".$companyid."' and Offer.delete_status ='0' ";
		}

		if(!isset($_GET["sortBy"]) || $_GET["sortBy"]==""){
			$_GET["sortBy"]="task_startdate";
			$_GET["direction"]="ASC";
		}
		/*App::import("Model", "Offer");
		$this->Offer =   & new Offer();*/
		
		$this->Offer->bindModel(array('belongsTo'=>array(
				'Company'=>array(
				'foreignKey'=>false,
				'conditions'=>'Offer.merchant_id  = Company.id'
        ))));
		
		$this->Offer->bindModel(array('belongsTo'=>array(
				'Category'=>array(
				'foreignKey'=>false,
				'conditions'=>'Offer.category_id  = Category.id'
        ))));
		
		$this->Offer->bindModel(array('belongsTo'=>array(
				'OfferTypeTemplate'=>array(
				'foreignKey'=>false,
				'conditions'=>'Offer.offer_type  = OfferTypeTemplate.id'
        ))));
			
	/*	$this->Offer->bindModel(array('hasMany'=>array(
				'RelatedNonProfit'=>array(
						'foreignKey'=>false,
						'conditions'=>'RelatedNonProfit.company_id = Offer.merchant_id'
		)))); */
		
		$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination
		$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition);
		
		$this->Offer->bindModel(array('belongsTo'=>array(
				'Company'=>array(
						'foreignKey'=>false,
						'conditions'=>'Offer.merchant_id  = Company.id'
		))));
			
		$this->Offer->bindModel(array('belongsTo'=>array(
				'Category'=>array(
						'foreignKey'=>false,
						'conditions'=>'Offer.category_id  = Category.id'
		))));
			
		$this->Offer->bindModel(array('belongsTo'=>array(
				'OfferTypeTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'Offer.offer_type  = OfferTypeTemplate.id'
		))));
			

	/*	$this->Offer->bindModel(array('hasMany'=>array(
				'RelatedNonProfit'=>array(
						'foreignKey'=>false,
						'conditions'=>'RelatedNonProfit.company_id = Offer.merchant_id'
		))));*/
		
		
		//$this->Offer->recursive = 2;
		
	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));
	
	//$this->pl($offerArray); 
	$this->set("offerdata",$offerArray);
	$this->set('option',$option);
		
		
		App::import("Model", "Company");
	    $this->Company =   & new Company();
			
		if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
			$currentcompany = $this->Company->findById($this->Session->read("current_company"));
			$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
		}else{
			$this->set('current_company_name', '');
		}
	  }
	  
	  /**
       * Function name : addnote()
       * Description   : This function used get list of players
       * Created On    : 17 September 2012
       * Created By    : Vidur
       */
      
      function addnote($option='company', $companyid=''){
      
		$usertype = $this->session_check_usertype();
		$this->set('correspondentRedirect','0');
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
      	$companytypecategoryid = $this->getCompanyCategory($option) ;
      
      	$this->set('option',$option);
      	$this->set('companytypecategoryid',$companytypecategoryid);
		if($companyid!='')
		{
			$current_company =$companyid;
		}
		else if(isset($this->data['players']['company_id'])&&$this->data['players']['company_id']!='')
		{
			$current_company =$this->data['players']['company_id'];
		}
		else
		{
			$current_company ="";
		}
      	$this->set('companyid',$companyid);
		
      	$this->set('current_company', $current_company);

      	App::import("Model", "Company");
      	$this->Company =   & new Company();
      	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
      		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
      		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
      	}else{
      		$this->set('current_company_name', '');
      	}
      	
      	App::import("Model", "Note");
      	$this->Note =   & new Note();
		$projectDetails=$this->getprojectdetails($project_id);
      	$this->set('project',$projectDetails);
      	$project_name=$projectDetails['Project']['project_name'];
      	$this->set('projectname',$project_name);
      	$this->set('project_id',$project_id);
      	 
      	
      	//set help condition
      	App::import("Model", "HelpContent");
      	$this->HelpContent =  & new HelpContent();
      	$condition = "HelpContent.id = '41'";
      	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
      	$this->set("hlpdata",$hlpdata);
      	//set help condition
      	
      	//for active menu display
      	$this->set('page_url','notelist');
      
	   	 
      	 
      	if(!empty($this->data)) {
      		
      		if($this->data['Note']['id']){
      			$this->Note->id = $this->data['Note']['id'];
      		}
      		if($project_id==""){$project_id = 0;}
      		//$this->data['Note']['company_id'] = $current_company;
			$this->data['Note']['company_id'] = 0;
      		$this->data['Note']['project_id'] = $project_id;
      		$this->data['Note']['type']  = 'notes';
      		$current_company = $this->Session->read("current_company");
			$this->set('current_company', $current_company);      	
			$this->set('companytypecategoryid',$companytypecategoryid);
			$this->set('option',$option);
	
      		if($this->Note->Save($this->data)){
			
      			$this->Session->setFlash('Note added successfully.','default',array('class' => 'successmsg'));
				if( $this->Session->check('correspondentRedirect')&& $this->Session->read('correspondentRedirect'))
				{
					//$this->set('correspondentRedirect','1');
					$this->redirect(array('controller'=>'players','action' =>'notelist','0'));
					$this->Session->write("correspondentNotesRedirect",'1');
				}
				else
				{
      				$this->redirect(array('controller'=>'players','action' =>'notelist', $option));
				}
      		}else{
			
      			$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
      			$this->redirect(array('controller'=>'players','action' =>'addnote', $option));
      		}
      	}
      	 
      	if($companyid && $companyid !=$option ){
      		$this->Note->id = $companyid;
      		$this->data = $this->Note->read();
      	}
      	 
      	 
      }
      

      /**
       * Function name : notelist()
       * Description   : This function used get list of players
       * Created On    : 17 September 2012
       * Created By    : Vidur
       */
      
      
      function notelist($option='company', $companyid=''){
      	
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
      	
      	$companytypecategoryid = $this->getCompanyCategory($option) ;
      	
      	$current_company = $this->Session->read("current_company");
      	$this->set('current_company', $current_company);      	
      	$this->set('companytypecategoryid',$companytypecategoryid);
      	$this->set('option',$option);
      	
      	App::import("Model", "Company");
      	$this->Company =   & new Company();
      	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
      		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
      		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
      	}else{
      		$this->set('current_company_name', '');
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
      	
      	if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
      		$searchkeyword = $this->data['players']['searchkey'];
      		$condition = "Note.company_id = '$current_company' AND Note.project_id = '$projectid' and (Note.subject LIKE '%".$searchkeyword."%' OR Note.note  LIKE '%".$searchkeyword."%' OR Note.author '%".$searchkeyword."%')";
      	}else{
      		$condition = "Note.company_id = '$current_company' AND Note.project_id = '$projectid' ";
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
      
      
      
     
      
      function getCompanyCategory($option){
      	
      	$companytypecategoryid = 7 ;
      	
      	switch($option){
      		case 'company':
      			$companytypecategoryid = 7 ;
	
				$this->set("selectedcompanytype",'3');
				
      			break;
      		case 'merchant':
      			$companytypecategoryid = 2 ;
							//2 for local and 6
				$this->set("selectedcompanytype",'6');
      			break;
      		case 'nonprofit':
      			$companytypecategoryid = 4 ;
				//16 for local and 18
				$this->set("selectedcompanytype",'18');
      			break;
      		case 'vendor':
      			$companytypecategoryid = 1 ;
				//17 for local and 65
				$this->set("selectedcompanytype",'65');
      			break;
      		case 'sale':
      			$companytypecategoryid = 3 ;
				//21 for local and 65
				$this->set("selectedcompanytype",'19');
      			break;
      		case 'advertiser':
      			$companytypecategoryid = 5 ;
				//22 for local and 89
				$this->set("selectedcompanytype",'89');
      			break;
      		case 'other':
      			$companytypecategoryid = 6 ;
				//23 for local and 90
				$this->set("selectedcompanytype",'90');
      			break;
      		case 'branch':
      			$companytypecategoryid = -1 ;
      			break;
      	}
	      	return $companytypecategoryid;
      }
      
      
     /*
      * Function name   : historylist()
      * Description : This function used to view communication task execution history list
      * Created On      : 19-Sept-2012
      *
      */
      function historylist($option, $companyid='-1'){
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
      	$companytypecategoryid = $this->getCompanyCategory($option) ;
      	$current_company = $this->Session->read("current_company");
      	$this->set('current_company', $current_company);
      	$this->set('companytypecategoryid',$companytypecategoryid);
      	$this->set('option',$option);
      	
      	App::import("Model", "Company");
      	$this->Company =   & new Company();
      	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
      		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
      		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
      	}else{
      		$this->set('current_company_name', '');
      	}
		$projectDetails=$this->getprojectdetails($projectid);
      	$this->set('project',$projectDetails);
      	$project_name=$projectDetails['Project']['project_name'];
      	$this->set('project_name',$project_name);
      	
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
      					'foreignKey'=>false,
      					'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
      	))));
      	
      	##fetch data from project type table for listing
      	$field='';
      	##checking search key
        if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey']){
      		$searchkeyword = $this->data['Admins']['searchkey'];
      		$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";
        }else{
            $condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";
        }
            
        $condition .= " AND CommunicationTaskHistory.company_id = '".$current_company."'";
        $this->Pagination->sortByClass    = 'CommunicationTaskHistory'; ##initaite pagination
        $this->Pagination->total= count($this->CommunicationTaskHistory->find('all',array("conditions"=>$condition)));
      
      	list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        /*	$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
      			'EmailTemplate'=>array(
      			'foreignKey'=>false,
      			'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
      	    ))));
        */
         	//$taskdata = $this->CommunicationTaskHistory->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
         	
         	$taskdata = $this->CommunicationTaskHistory->QUERY("SELECT *FROM ( SELECT cth.id AS id, cth.project_id AS projectid, cth.company_id AS companyid, cth.created AS date,cth.email_subject as subject,cth.task_note as note,cth.task_name as type FROM `communication_task_histories` AS cth WHERE cth.company_id =".$current_company." UNION ALL SELECT n.id AS id, n.project_id AS projectid, n.company_id AS companyid, n.created AS date, n.subject as subject,n.note as note,n.type as type FROM notes AS n WHERE n.company_id =".$current_company." ) AS CommunicationTaskHistory ORDER BY CommunicationTaskHistory.date desc");

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
        * Function name		: sendmail()
        * Description		: This function used to send mail for related merchant
        * Created On		: 19-Sept-2012
        * Created By		: Vidur
        */
        
        function sendmail($option='company', $tempid=null){
			
			$usertype = $this->session_check_usertype();
			$this->set('usertype',$usertype);
			if($usertype==trim("user")){
				$this->session_check_user();				
				$usertype = $this->Session->read("User.User.usertype");
           		$userid = $this->Session->read("User.User.id");            
				$project_id = $this->Session->read("projectwebsite_id");
				 $projectid = $project_id   ;
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
		        	$this->set('project_id',$projectid);	
		        	$project_name=$this->Session->read("projectwebsite_name_admin");
		        	$this->set('current_project_name',$project_name);     	
			}		
        	$companytypecategoryid = $this->getCompanyCategory($option) ;
        	//print_r($companytypecategoryid);
        	$current_company = $this->Session->read("current_company");
        	$this->set('current_company', $current_company);
        	$this->set('companytypecategoryid',$companytypecategoryid);
        	$this->set('option',$option);
        	
        	App::import("Model", "Company");
        	$this->Company =   & new Company();
        	
        	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
        		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
        		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
        	}else{
        		$this->set('current_company_name', '');
        	}
        	
        	
        	$this->Company->id = $current_company;
        	$company = $this->Company->read();
        	//$this->pl($company);        	
        	App::import("Model", "Project");
        	$this->Project =   & new Project();
        	$condition = "id=$projectid";
        	$dt=$this->Project->find('all',array("conditions"=>$condition,'fields'=>array('fromemail')));
        	$this->set("dt",$dt);
        	$current_domain= $_SERVER['HTTP_HOST'];
        	$this->set("current_domain",$current_domain);
        	$projectDetails= array($this->getprojectdetails($projectid));
        
        	##import EmailTemplate  model for processing
        	App::import("Model", "EmailTemplate");
        	$this->EmailTemplate =   & new EmailTemplate();
        	$tomail = implode(',', $this->getRelatedCompany($companytypecategoryid));
        	$checkempty =true;
        	 
        	if(!empty($this->data)){
        	//  echo '<pre>';print_r($this->data);die;
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
        			 
        			/**
        	 		* STEP : Email Sent By Send mail , save it as Executed Task with 'Sedn Mail' as task name in task history table
        	 		*/
        			App::import("Model", "CommunicationTask");
        			$this->CommunicationTask =   & new CommunicationTask();

        			$taskHistoryId = $this->CommunicationTask->saveSendMailCompanyTask($this->data['EmailTemplate'], $projectid, $current_company);

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

        				/*if($templatearr['EmailTemplate']['send_cc_email_to']!=""){
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
        					 $this->EmailTemplates->setEmailTempDataElementValuesArray($dataEleValuesArray);
        					 
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
        				$taskHistoryArray['company_id']=$current_company;
        				$this->CommunicationTaskHistory->save($taskHistoryArray);

        				if($sendflag==true){
        					$this->Session->setFlash('Mail sent successfully.','default', array('class' => 'successmsg'));
        				}else{
        					$this->Session->setFlash("Error in Mail sending with email id $errorwith. Please try again",'default',array('class' => 'msgTXt'));
        				}

        				##setting action for save & apply
        				if(isset($this->data['Action']['redirectpage'])){
        					$this->redirect('/players/sendmail/'.$option);
        				}else{
        					$this->redirect("/players/sendmail/".$option."/".$tempid);
        				}

        			}else{
        				$this->Session->setFlash("Error in Send Mail processing. Please try again",'default',array('class' => 'msgTXt'));
        			}
        		}
        	}

        	if($tempid || isset($this->data['EmailTemplate']['id'])){
        		if($this->data['EmailTemplate']['id']){
        			$tempid = $this->data['EmailTemplate']['id'];
        		}
        		$this->EmailTemplate->id = $tempid;
        		$this->data = $this->EmailTemplate->read();
        	}

        	$chekret = $this->projectdetailbyid($projectid);
        	$this->set('frmid',$chekret[0]['Sponsor']['email']);
        	$this->set('toid',$tomail);
			
        	$this->set('projectid',$projectid);
        	$this->getmailtemplates($projectid,'1');
			
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
        	$this->set('member_type', $this->getMemberTypesListByProject($projectid, true));

        }
        	
        	
        	
        	/**
        	 * Function name : types()
        	 * Description   : This function used get list of players
        	 * Created On    : 20 September 2012
        	 * Created By    : Vidur
        	 */
        	
        	function types($option='company'){
        		
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
        			$usertype = $this->session_check_admin();
					$projectid = $this->Session->read("sessionprojectid");
        			$this->set('project_id',$projectid);
        			$project_name=$this->Session->read("projectwebsite_name_admin");
        			$this->set('current_project_name',$project_name);
				}
        		$this->set('usertype',$usertype);
        		if(isset($_SERVER['QUERY_STRING']))
        		{
        			$this->Session->delete("newsortingby");
        			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
        			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
        			$this->Session->write("newsortingby",$strdata);        		
        		}
        		
        		
        		$projectDetails=$this->getprojectdetails($projectid);
        		$this->set('project',$projectDetails);
        		$project_name=$projectDetails['Project']['project_name'];
        		$this->set('project_name',$project_name);

        		switch($option){
        			case 'contact':
        				##import contact type model for processing
        				App::import("Model", "ContactType");
        				$this->ContactType =   & new ContactType();
        				##fetch data from contact type table for listing
        				$field='';
        				$condition = "delete_status = '0' and project_id='0'";
            			if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey']){
        				            $searchkeyword = $this->data['Admins']['searchkey'];
        				            $condition .= "  and (contact_type_name LIKE '%".$searchkeyword."%'  )";
            			}
        				$this->Pagination->sortByClass    = 'ContactType'; ##initaite pagination
        				$this->Pagination->total= count($this->ContactType->find('all',array("conditions"=>$condition)));
        				list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        				$contacttypedata = $this->ContactType->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        				##set project type data in variable
        				$this->set("contacttypedata",$contacttypedata);
        				$this->set("page_title",'Contact Type List');
        				break;
        		
        			case 'category':
        				App::import("Model", "CategoryDetail");
        				$this->CategoryDetail =   & new CategoryDetail();
        				App::import("Model", "Category");
        				$this->Category =   & new Category();
        				 
        				$this->Category->bindModel( array('hasOne' => array(
        						'CategoryDetail' => array(
        						'foreignKey' => false,
        						'conditions'=> array('CategoryDetail.category_id= Category.id')
        				))));
        				
        				$this->Category->bindModel(array('hasAndBelongsToMany'=>array(
        						'Company'=>array(
        								'joinTable'              => 'company_to_categories',
        								'foreignKey'             => 'category_id',
        								'associationForeignKey'  => 'company_id'
        				))));
        				
        				##fetch data from Category table for listing
        				$field='';
        				
        				$this->Pagination->sortByClass    = 'Category'; ##initaite pagination
        				
        				##checking search key
        				if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
        					$searchkeyword = $this->data['players']['searchkey'];
        					$condition = "Category.delete_status = '0' AND Category.category_name LIKE '%".$searchkeyword."%' OR CategoryDetail.description  LIKE '%".$searchkeyword."%' ";
            			}else{
        					$condition = "Category.delete_status = '0' ";
        				}
        				 $condition .= " AND Category.parent_category = '0' AND CategoryDetail.category_id = Category.id ";
        							
        				
        				$this->Category->bindModel( array('hasOne' => array(
        								'CategoryDetail' => array(
        								'foreignKey' => false,
        								'conditions'=> array('CategoryDetail.category_id= Category.id')
        				))));
        							
		   				$this->Pagination->total= count($this->Category->find('all',array("conditions"=>$condition)));
        				list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        				
						##relation ship with companytocategories table with categories
        				$this->Category->bindModel( array('hasOne' => array(
        						'CategoryDetail' => array(
        						'foreignKey' => false,
        						'conditions'=> array('CategoryDetail.category_id= Category.id')
        				))));
        				
        				$this->Category->bindModel(array('hasAndBelongsToMany'=>array(
        						'Company'=>array(
        								'joinTable'              => 'company_to_categories',
        								'foreignKey'             => 'category_id',
        								'associationForeignKey'  => 'company_id'
        				))));
        				
        				$contegorydtlarr = $this->Category->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        				//$this->pl($contegorydtlarr); die;
        				##set project type data in variable
        				$this->set("categorydata",$contegorydtlarr);
        				$this->set("page_title",'Categories List');
        				break;
        		  case 'nonprofit':
        		  		##fetch data from Non Profit Type table for listing
        		  		$field='';
        		  		
        		  		$this->Pagination->sortByClass    = 'NonProfitType'; ##initaite pagination
        		  		
        		  		##checking search key
        		  		if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
        		  			$searchkeyword = $this->data['players']['searchkey'];
        		  			$condition = "NonProfitType.delete_status = '0' AND NonProfitType.non_profit_type_name LIKE '%".$searchkeyword."%' OR NonProfitType.description  LIKE '%".$searchkeyword."%' ";
            			}else{
        		  			$condition = "NonProfitType.delete_status = '0' ";
        		  		}
        		  	
        		  		$this->Pagination->total= count($this->NonProfitType->find('all',array("conditions"=>$condition)));
        		  		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        		  		$nonprofittypedata = $this->NonProfitType->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        		  		##set project type data in variable
        		  		$this->set("nonprofittypedata",$nonprofittypedata);
        		  		$this->set("page_title",'Non-Profit Type List');
        		  		break;
        		  default:
        		  		##import company type model for processing
        		  		App::import("Model", "CompanyType");
        		  		$this->CompanyType =   & new CompanyType();
        		  		$this->CompanyType->bindModel(array('belongsTo' => array(
        		  				'CompanyTypeStatus' => array(
        		  						'className' => 'CompanyTypeStatus',
        		  						'foreignKey'=> 'company_type_status_id'),
        		  				'CompanyTypeCategory' => array(
        		  						'className' => 'CompanyTypeCategory',
        		  						'foreignKey'	=> 'company_type_category_id')
        		  		)));
        		  			
        		  		##fetch data from project type table for listing
        		  		$field='';
        		  		$condition = "delete_status = '0'  and project_id='0'";
        		  		
        		  		if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
        		  			$searchkeyword = $this->data['players']['searchkey'];
        		  			$condition .= "  and (CompanyTypeCategory.company_type_category_name LIKE '%".$searchkeyword."%' OR CompanyTypeStatus.company_type_status_name LIKE '%".$searchkeyword."%'  )";
        		  		}
        		  		
        		  		$this->CompanyType->bindModel(array('belongsTo' => array(
        		  				'CompanyTypeStatus' => array(
        		  						'className' => 'CompanyTypeStatus',
        		  						'foreignKey'=> 'company_type_status_id'),
        		  				'CompanyTypeCategory' => array(
        		  						'className' => 'CompanyTypeCategory',
        		  						'foreignKey'	=> 'company_type_category_id')
        		  		)));
        		  	    
        		  		$this->Pagination->sortByClass = 'CompanyType'; ##initaite pagination
        		  		$this->Pagination->total= count($this->CompanyType->find('all',array("conditions"=>$condition)));
        		  		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        		  		$this->CompanyType->bindModel(array('belongsTo' => array(
        		  				'CompanyTypeStatus' => array(
			        		  				'className' => 'CompanyTypeStatus',
			        		  				'foreignKey'=> 'company_type_status_id'),
		        		  		'CompanyTypeCategory' => array(
			        		  				'className' => 'CompanyTypeCategory',
			        		  				'foreignKey'	=> 'company_type_category_id')
        		  		)));
        		  		
        		  		$companytypedata = $this->CompanyType->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        		  		##set project type data in variable
        		  		$this->set("companytypedata",$companytypedata);
        		  		$this->set("page_title",'Company Type List');
        		}
        		$this->set("option",$option);
        		
      			# set help condition
        		App::import("Model", "HelpContent");
        		$this->HelpContent =  & new HelpContent();
        		$condition = "HelpContent.id = '62'";
        		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        		$this->set("hlpdata",$hlpdata);
        		# set help condition
        		
        		
        	}//end types()
        	
        	
        	
          /*
        	* Function name   : addcompanytype()
        	* Description     : This function used to add company type
        	* Created On      : 27-Sept-2012
        	*
        	*/
        	
        	function addcompanytype($recid=''){
        		
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
    	    		$this->set('project_id',$projectid);
        			$project_name=$this->Session->read("projectwebsite_name_admin");
        			$this->set('current_project_name',$project_name);
			}		
        			$projectDetails=$this->getprojectdetails($projectid);
        		$this->set('project',$projectDetails);
        		$project_name=$projectDetails['Project']['project_name'];
        		$this->set('project_name',$project_name);
        		
        		App::import("Model", "CompanyType");
        		$this->CompanyType =   & new CompanyType();
        		
        		##check empty data
        		if(!empty($this->data)) {
        			#set the posted data
        			if($this->data['CompanyTypeCategory']['hidctc'] =='company_type_category_name_text'){
        				App::import("Model", "CompanyTypeCategory");
        				$this->CompanyTypeCategory =   & new CompanyTypeCategory();
        				$this->data['CompanyTypeCategory']['company_type_category_name'] = $this->data['CompanyTypeCategory']['company_type_category_name_text'];
        				if(!empty($this->data['CompanyTypeCategory'])) {
        					$this->CompanyTypeCategory->Save($this->data['CompanyTypeCategory']);
        				}
        				$this->data['CompanyType']['company_type_category_id'] = $this->CompanyTypeCategory->getLastInsertId();
        			}else{
        				$this->data['CompanyType']['company_type_category_id'] = $this->data['CompanyTypeCategory']['company_type_category_name'];
        			}
        	
        			if($this->data['CompanyTypeStatus']['hidcts'] =='company_type_status_name_text'){
        	
        				App::import("Model", "CompanyTypeStatus");
        				$this->CompanyTypeStatus =   & new CompanyTypeStatus();
        				$this->data['CompanyTypeStatus']['company_type_status_name'] = $this->data['CompanyTypeStatus']['company_type_status_name_text'];
        				if(!empty($this->data['CompanyTypeStatus'])) {
        					$this->CompanyTypeStatus->Save($this->data['CompanyTypeStatus']);
        				}
        				$this->data['CompanyType']['company_type_status_id'] = $this->CompanyTypeStatus->getLastInsertId();
        			}else{
        				$this->data['CompanyType']['company_type_status_id'] = $this->data['CompanyType']['company_type_status_name'];
        			}
        			$this->CompanyType->set($this->data);
        			#check server side validation
        			$this->CompanyType->invalidFields();
        			//echo '<pre>';print_r($this->data);die;
        			$categoryTypeId = $this->data['CompanyType']['company_type_category_id'];
        			$categoryStatusId = $this->data['CompanyType']['company_type_status_id'];
        			$condition = "company_type_category_id = '".$categoryTypeId."' AND company_type_status_id ='".$categoryStatusId."'   AND  delete_status = '0'  AND  project_id='0' AND active_status = '1'";
        			$ptdata = $this->CompanyType->find('all',array("conditions"=>$condition));
        			if(empty($ptdata)){
        				#save data in company type table
        				//echo '<pre>';print_r($this->data['CompanyType']);die;
        				if($this->data['CompanyType']['id'])
        					
        				if($this->CompanyType->Save($this->data)){
        					if(!isset($this->data['CompanyType']['id'])){
        						$this->Session->setFlash('Company Type added Successfully.','default', array('class' => 'successmsg'));
        					}else{
        						$this->Session->setFlash('Company Type edited Successfully.','default', array('class' => 'successmsg'));
        					}
        				}else{
        					$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
        	
        				}
        	
        			}else{
        				$this->Session->setFlash('Company Type with same name already exists.','default',array('class' => 'msgTXt'));
        			}
        			if(isset($this->data['Action']['redirectpage'])){
        	
        				$sessdata=$this->Session->read('newsortingby');
        				$this->redirect('/'.$sessdata);
        			}else
        			{
        				$this->redirect('/admins/addcompanytype/');
        				//	$this->redirect("/admins/editprojecttype/$recid");
        			}
        		}
        		
        		$this->set("selectedcompanytypecategory", '');
        		$this->set("selectedcompanytypestatus", '');
        		
        		if($recid){
	        		$this->CompanyType->id = $recid;
	        		$this->CompanyType->bindModel(array('belongsTo' => array(
	        				'CompanyTypeStatus' => array(
	        						'className' => 'CompanyTypeStatus',
	        						'foreignKey'=> 'company_type_status_id'),
	        				'CompanyTypeCategory' => array(
	        						'className' => 'CompanyTypeCategory',
	        						'foreignKey'	=> 'company_type_category_id')
	        		)));
	        		
	        		$this->data = $this->CompanyType->read();
	        		
	        		$this->set("selectedcompanytypecategory", $this->data['CompanyType']['company_type_category_id']);
	        		$this->set("selectedcompanytypestatus", $this->data['CompanyType']['company_type_status_id']);
        		}
        	
        		# set help condition
        		App::import("Model", "HelpContent");
        		$this->HelpContent =  & new HelpContent();
        		$condition = "HelpContent.id = '60'";
        		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        		$this->set("hlpdata",$hlpdata);
        		# set help condition
        		
        		$companytypecategorydropdown = $this->getCompanyTypeCategoryDropdown();
        		$this->set("companytypecategorydropdown", $companytypecategorydropdown);
        		
		
        		$companytypestatusdropdown = $this->getCompanyTypeStatusDropdown();
				$this->set("companytypestatusdropdown", $companytypestatusdropdown);
        		
        	}
        	
        	
        	/*
        	 * Function name   : editcompanytype()
        	 * Description 	   : This function used to add company type
        	 * Created On      : 27-09-2012
        	 * 
        	 */
        	  
        	/*function editcompanytype($recid){

        		##check admin session live or not
        		$this->session_check_admin();
        		$project_id = $this->Session->read("sessionprojectid");
        		$project_name=$this->Session->read("projectwebsite_name_admin");
        		$this->set('current_project_name',$project_name);
        		$projectDetails=$this->getprojectdetails($project_id);
        		$this->set('project',$projectDetails);
        		$this->set('project_name',$projectDetails['Project']['project_name']);
        		$projectid=$project_id;
        		
        		##import company type model for processing
        		App::import("Model", "CompanyType");
        		$this->CompanyType =   & new CompanyType();
        		$this->set("recid",$recid);

        		$companytypecategorydropdown = $this->getCompanyTypeCategoryDropdown();
        		$this->set("companytypecategorydropdown", $companytypecategorydropdown);
        		$this->set("selectedcompanytypecategory", '');
        		$companytypestatusdropdown = $this->getCompanyTypeStatusDropdown();
        		$this->set("companytypestatusdropdown", $companytypestatusdropdown);
        		$this->set("selectedcompanytypestatus", '');
        		 
        		##check empty data
        		if(!empty($this->data)) {
        			if($this->data['CompanyTypeCategory']['hidctc'] =='company_type_category_name_text'){
        				App::import("Model", "CompanyTypeCategory");
        				$this->CompanyTypeCategory =   & new CompanyTypeCategory();
        				 
        				$id = $this->data['CompanyTypeCategory']['company_type_category_name'];
        				$this->data['CompanyTypeCategory']['company_type_category_name'] = "'".$this->data['CompanyTypeCategory']['company_type_category_name_text']."'";
        				unset($this->data['CompanyTypeCategory']['company_type_category_name_text']);
        				unset($this->data['CompanyTypeCategory']['hidctc']);
        				if(!empty($this->data['CompanyTypeCategory'])) {
        					$conditions = array('CompanyTypeCategory.id'=>$id);
        					$this->CompanyTypeCategory->updateAll($this->data['CompanyTypeCategory'],$conditions);
        				}
        				$this->data['CompanyType']['company_type_category_id'] = $id;
        			}else{
        				$this->data['CompanyType']['company_type_category_id'] = $this->data['CompanyTypeCategory']['company_type_category_name'];
        			}
        			 
        			if($this->data['CompanyTypeStatus']['hidcts'] =='company_type_status_name_text'){
        				App::import("Model", "CompanyTypeStatus");
        				$this->CompanyTypeStatus =   & new CompanyTypeStatus();
        				$id = $this->data['CompanyTypeStatus']['company_type_status_name'];
        				$this->data['CompanyTypeStatus']['company_type_status_name'] = "'".$this->data['CompanyTypeStatus']['company_type_status_name_text']."'";
        				unset($this->data['CompanyTypeStatus']['company_type_status_name_text']);
        				unset($this->data['CompanyTypeStatus']['hidcts']);
        				if(!empty($this->data['CompanyTypeStatus'])) {
        					$conditions = array('CompanyTypeStatus.id'=>$id);
        					$this->CompanyTypeStatus->updateAll($this->data['CompanyTypeStatus'],$conditions);
        				}
        				$this->data['CompanyType']['company_type_status_id'] = $id;
        			}else{
        				$this->data['CompanyType']['company_type_status_id'] = $this->data['CompanyTypeStatus']['company_type_status_name'];
        			}
        			 
        			#set the posted data\
        			$this->CompanyType->set($this->data);
        			#check server side validation
        			$this->CompanyType->invalidFields();
        			#save data in company type table
        			$this->data['CompanyType']['id']=$recid;
        			$ptname  = $this->data['CompanyType']['company_type_name'];
        			$condition = "company_type_name = '".$ptname."' AND id !=$recid AND  delete_status = '0'  and project_id='0'";
        			$ptdata = $this->CompanyType->find('all',array("conditions"=>$condition));
        			if(!$ptdata){
        				if($recid !=''){
        					 
        					if($this->CompanyType->Save($this->data)){
        						$this->Session->setFlash('Company Type updated Successfully.','default', array('class' => 'successmsg'));
        						 
        					}else{
        						$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
        						 
        					}
        				}else{
        					$this->Session->setFlash('Invalid attempt for update.','default',array('class' => 'msgTXt'));
        				}
        			}else{
        				 
        				$this->Session->setFlash('Company Type with same name already exists.','default',array('class' => 'msgTXt'));
        			}
        			if(isset($this->data['Action']['redirectpage'])){
        				 
        				$sessdata=$this->Session->read('newsortingby');
        				$this->redirect('/'.$sessdata);
        			}else
        			{
        				$this->redirect("/admins/editcompanytype/$recid");
        			}
        			 
        		}
        		 
        		$this->CompanyType->id = $recid;
        		$this->data = $this->CompanyType->read();
        		$this->set("selectedcompanytypecategory", $this->data['CompanyType']['company_type_category_id']);
        		$this->set("selectedcompanytypestatus", $this->data['CompanyType']['company_type_status_id']);
        		 
        		# set help condition
        		App::import("Model", "HelpContent");
        		$this->HelpContent =  & new HelpContent();
        		$condition = "HelpContent.id = '61'";
        		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        		$this->set("hlpdata",$hlpdata);
        		# set help condition
        		 
        	}*/
        	
        	
           /*
        	* Function name  : addcontacttype()
        	* Description 	 : This function used to add contact type
        	* Created On     : 28-09-2012
        	*
        	*/
        	
        	function addcontacttype($recid=''){
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
    	    		$this->set('project_id',$projectid);
        			$project_name=$this->Session->read("projectwebsite_name_admin");
        			$this->set('current_project_name',$project_name);
				}	
        		$projectDetails=$this->getprojectdetails($projectid);
        		$this->set('project',$projectDetails);
        		$project_name=$projectDetails['Project']['project_name'];
        		$this->set('project_name',$project_name);
        		
        		##import contact type model for processing
        		App::import("Model", "ContactType");
        		$this->ContactType =   & new ContactType();
        		##check empty data
        		
        		if(!empty($this->data)) {
        			#set the posted data
        			$this->ContactType->set($this->data);
        			#check server side validation
        			$this->ContactType->invalidFields();
        			$ptname = $this->data['ContactType']['contact_type_name'];
        	
        			$condition = "contact_type_name = '".$ptname."' AND delete_status = '0' and project_id='0'";
        			$ptdata = $this->ContactType->find('all',array("conditions"=>$condition));
        	
        			if(!$ptdata){
        				#save data in contact type table
        					$this->data['ContactType']['active_status'] = "1";
        	
        				if($this->ContactType->Save($this->data)){
        					if($this->data['ContactType']['project_lead'] == 1) {
        						$this->ContactType->updateAll(array('ContactType.project_lead'=> '0'), array('ContactType.id !=' => $this->ContactType->id,'ContactType.delete_status' => '0','ContactType.project_id' => '0'));
        					}
        					$this->Session->setFlash('Contact Type added Successfully.','default', array('class' => 'successmsg'));
        				}else{
        					$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
        	
        				}
        	
        			}else{
        				$this->Session->setFlash('Contact Type with same name already exists.','default',array('class' => 'msgTXt'));
        			}
        	
        			if(isset($this->data['Action']['redirectpage'])){
        	
        				$sessdata=$this->Session->read('newsortingby');
        				$this->redirect('/players/types/contact');
        			}else
        			{
        				$this->redirect('/players/types/contact');
        			}
        	
        		}
        		# set help condition
        		App::import("Model", "HelpContent");
        		$this->HelpContent =  & new HelpContent();
        		$condition = "HelpContent.id = '57'";
        		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        		$this->set("hlpdata",$hlpdata);
        		# set help condition
        		
        		if($recid){
	        		$this->ContactType->id = $recid;
	        		$this->data = $this->ContactType->read();
        		}
        	}
        	
        	
        	
        	/**
        	 * Function name : addnonprofittype()
        	 * Description : This function used to add and edit non profit
        	 * Created On : 28-Sept-2012
        	 *
        	 */
        	 
        	function addnonprofittype($nonprofittypeid='',$companyid=''){
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
					$this->set('project_id',$projectid);
					$project_name=$this->Session->read("projectwebsite_name_admin");
					$this->set('current_project_name',$project_name);
			}	
        		$projectDetails=$this->getprojectdetails($projectid);
        		$this->set('project',$projectDetails);
        		$project_name=$projectDetails['Project']['project_name'];
        		$this->set('project_name',$project_name);
        		$projectid=$project_id;
        		
        		# set help condition
        		App::import("Model", "HelpContent");
        		$this->HelpContent =  & new HelpContent();
        		$condition = "HelpContent.id = '47'";
        		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        		$this->set("hlpdata",$hlpdata);
        		# set help condition
        		
        		$this->set("selectedcountry",'');
        		$this->set("selectedstate",'');
        		 
        		##check empty data
        		if(!empty($this->data)) {
        			$this->data['NonProfitType']['project_id'] = $projectid;
        			#set the posted data
        			$this->NonProfitType->set($this->data);
        			#check server side validation
        			$errormsg = $this->NonProfitType->invalidFields();
        			if(!$errormsg){
        				$cid = "";
        				$non_profit_type_name 	 = $this->data['NonProfitType']['non_profit_type_name'];
        				$description = $this->data['NonProfitType']['description'];

        				if($this->data['NonProfitType']['id']){
        					$cid = $this->data['NonProfitType']['id'];
        					// Check NonProfitType already exists with same firstname, last name. title, address, city state, country, zip
        					$condition = "	NonProfitType.non_profit_type_name= '".$non_profit_type_name 	."' AND NonProfitType.description = '".$description."' AND NonProfitType.delete_status = '0' AND id !='".$cid."'";
        				}else{
        					// Check NonProfitType already exists with same firstname, last name. title, address, city state, country, zip
        					$condition = "	NonProfitType.non_profit_type_name= '".$non_profit_type_name 	."' AND NonProfitType.description = '".$description."' AND  NonProfitType.delete_status = '0'";
        				}
        				##check already exists company name
        				$ctdata = $this->NonProfitType->find('all',array("conditions"=>$condition));
        				if(!$ctdata){
        					 
        					if($this->NonProfitType->Save($this->data)){
        						if($cid){
        							$this->Session->setFlash('Non-Profit Type updated Successfully.','default', array('class' => 'successmsg'));
        							if(isset($this->data['Action']['redirectpage'])){
        								$sessdata=$this->Session->read('newsortingby');
        								$this->redirect('/'.$sessdata);
        							}else{
        								$this->redirect(array('controller'=>'players','action'=>'addnonprofittype',$cid));
        							}
        						}else{
        							$this->Session->setFlash('Non-Profit Type Added Successfully.','default', array('class' => 'successmsg'));
        							if(isset($this->data['Action']['redirectpage'])){
        								$sessdata=$this->Session->read('newsortingby');
        								$this->redirect('/'.$sessdata);
        							}else{
        								$this->redirect(array('controller'=>'players','action'=>'addnonprofittype'));
        							}
        						}
        					}else{
        						$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
        					}
        					$this->redirect(array('controller'=>'players','action'=>'types/nonprofit'));
        				}else{
        					$this->Session->setFlash('Non-Profit Type with same name already exists.','default',array('class' => 'msgTXt'));
        				}
        			}else{
        				if($errormsg['category_name']!='')
        					$this->Session->setFlash($errormsg['category_name'],'default',array('class' => 'msgTXt'));
        				else{
        					if($errormsg['description']!='')
        						$this->Session->setFlash($errormsg['description'],'default',array('class' => 'msgTXt'));
        				}
        			}
        		}

        		if($nonprofittypeid && $nonprofittypeid !=='addnonprofittype'){
        			$this->NonProfitType->id = $nonprofittypeid;
        			$this->data = $this->NonProfitType->read();
        		}
        		 
        	}//end addnonprofittypes()
        	
        	
        	/*
        	* Function name: contactlist()
        	* Description  : This function used to list contact of related companies
        	* Created On   : 20-Sept-12
        	* Created By  : Vidur
        	*/
        	
        	function contactlist($option =''){
        		
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
        		$projectDetails=$this->getprojectdetails($project_id);
        		$this->set('project',$projectDetails);
        		$this->set('project_name',$projectDetails['Project']['project_name']);
        		$projectid=$project_id;
        		
        		
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
		        	    ))));
            	
            	$this->Contact->bindModel(array('hasMany'=>array(
            			'CompanyToContact'=>array(
            			'foreignKey'=>'contact_id'
            	))));
        		
            	$contactdtlarr = $this->Contact->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
            	
        		##set project type data in variable
        		$this->set("contactdata",$contactdtlarr);
        		
        }//end contactlist();
        
        
        
       /*
        * Function name   : addcontacts()
        * Description     : This function used to add contacts for companies
        * Created On      : 20-Sept-12
        *
        */
        
        function addcontacts($contactid='',$companyid=''){
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
			}	
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
			if($projectid==''){$projectid=0;}
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
        						$this->redirect(array('controller'=>'players','action'=>'addcontacts',$cid));
        						}
        				}else{
        				$this->Session->setFlash('Contact Added Successfully.','default', array('class' => 'successmsg'));
        				if(isset($this->data['Action']['redirectpage'])){
        				$sessdata=$this->Session->read('newsortingby');
        					$this->redirect('/'.$sessdata);
        				}else{
        				$this->redirect(array('controller'=>'players','action'=>'addcontacts'));
        				}
        				}
        				}else{
        						$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
        				}
        						$this->redirect(array('controller'=>'players','action'=>'contactlist'));
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
        	}//end addcontacts()
        	
        	  
        	    
        	      
        	        
        	/**
        	 * Function name : addcategories()
        	 * Description : This function used to add and edit category
        	 * Created On : 9th July 2012
        	 *
        	 */
        	 
        	function addcategories($categorydetailsid='',$companyid=''){
        		
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
        		##import Category Detail  model for processing
        		App::import("Model", "CategoryDetail");
        		$this->CategoryDetail =   & new CategoryDetail();
        		 
        		App::import("Model", "Category");
        		$this->Category =   & new Category();
        		 
        		//for active menu display
        		$this->set('page_url',"addcategories");
        		 
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
        		$this->set("selectedcategory",'');
        		$this->set("selectedsubcategory",'');
        		 
        		##check empty data
        		if(!empty($this->data)) {
        			$parentDirPath =  'img' . DS;
        			$filePath1 =  $parentDirPath.'categories' . DS .'square' ;
        			$this->File = & new FileComponent;
        			$this->File->setDestPath($filePath1);
        			$this->data['Project']['id']=$project_id;
        			if(isset($this->data['CategoryDetail']['square_graphic']['name']) && $this->data['CategoryDetail']['square_graphic']['name'] !=''){
        				##upload image
        				$file_name1 = $this->File->setFileName($this->data['CategoryDetail']['square_graphic']['name']);
        				$tmp1 = $this->data['CategoryDetail']['square_graphic']['tmp_name'];
        				$file_namesquare = $this->File->uploadImageCategory($file_name1,$tmp1,true,'210X210');

        				if(!empty($file_namesquare)){
        					$this->data['CategoryDetail']['square_graphic'] = $file_namesquare;
        				}
        				else{
        					unset($this->data['CategoryDetail']['square_graphic']);
        				}
        			}else{
        				unset($this->data['CategoryDetail']['square_graphic']);
        			}
        			 
        			 
        			$filePath2 =  $parentDirPath.'categories/wide' ;
        			$this->File->setDestPath($filePath2);
        			$this->data['Project']['id']=$project_id;
        			if(isset($this->data['CategoryDetail']['wide_graphic']['name']) && $this->data['CategoryDetail']['wide_graphic']['name'] !=''){
        				##upload image
        				$file_name2 = $this->File->setFileName($this->data['CategoryDetail']['wide_graphic']['name']);
        				$tmp2 = $this->data['CategoryDetail']['wide_graphic']['tmp_name'];
        				$file_name_wide = $this->File->uploadImageCategory($file_name2,$tmp2,true,'350X220');
        					
        				if(!empty($file_name_wide)){
        					$this->data['CategoryDetail']['wide_graphic'] = $file_name_wide;
        				}
        				else{
        					unset($this->data['CategoryDetail']['wide_graphic']);
        				}
        			}else{
        				unset($this->data['CategoryDetail']['wide_graphic']);
        			}
        			 
        			$filePath3 =  $parentDirPath.'categories/tall' ;
        			$this->File->setDestPath($filePath3);
        			$this->data['Project']['id']=$project_id;
        			if(isset($this->data['CategoryDetail']['tall_graphic']['name']) && $this->data['CategoryDetail']['tall_graphic']['name'] !=''){
        				##upload image
        				$file_name3 = $this->File->setFileName($this->data['CategoryDetail']['tall_graphic']['name']);
        				$tmp3 = $this->data['CategoryDetail']['tall_graphic']['tmp_name'];
        				$file_name_tall = $this->File->uploadImageCategory($file_name3,$tmp3,true,'350X336');
        				 
        				if(!empty($file_name_tall)){
        					$this->data['CategoryDetail']['tall_graphic'] = $file_name_tall;
        				}
        				else{
        					unset($this->data['CategoryDetail']['tall_graphic']);
        				}
        			}else{
        				unset($this->data['CategoryDetail']['tall_graphic']);
        			}
        			 
        			 
        			#set the posted data
        			$this->CategoryDetail->set($this->data);
        			#check server side validation
        			//echo '<pre>';	print_r($this->data);
        			$errormsg = $this->CategoryDetail->invalidFields();
        			 
        			if(empty($errormsg)){
        				$cid = "";
        				$category_id = $this->data['CategoryDetail']['category_id'];
        				$sub_category_id = $this->data['CategoryDetail']['sub_category_id'];
        				$description = $this->data['CategoryDetail']['description'];

        				if($this->data['CategoryDetail']['id']){
        					$cid = $this->data['CategoryDetail']['id'];
        					// Check Contact already exists with same firstname, last name. title, address, city state, country, zip
        					$condition = "category_id = '".$category_id."' sub_category_id = '".$sub_category_id."' AND description = '".$description."' AND delete_status = '0' AND id !='".$cid."'";
        				}else{
        					// Check Contact already exists with same firstname, last name. title, address, city state, country, zip
        					$condition = "category_id = '".$category_id."' sub_category_id = '".$sub_category_id."' AND description = '".$description."' AND  delete_status = '0'";
        				}

        				##check already exists company name
        				$ctdata = $this->CategoryDetail->find('all',array("conditions"=>$condition));
        					
        				if(!$ctdata){
        					 
        					if($this->data['Category']['category_name_text']){
        						$dataCategory['category_name'] =  $this->data['Category']['category_name_text'];
        						$this->Category->Save($dataCategory);
        						$this->data['CategoryDetail']['category_id'] = $this->Category->getLastInsertId();
        					}
        					 
        					if($this->data['Category']['sub_category_name_text']){
        						$this->Category->create();
        						$dataSubCategory['category_name']   =  $this->data['Category']['sub_category_name_text'];
        						$dataSubCategory['parent_category'] =  $this->data['CategoryDetail']['category_id'];
        						$this->Category->Save($dataSubCategory);
        						$this->data['CategoryDetail']['sub_category_id'] = $this->Category->getLastInsertId();
        					}
        					if($this->CategoryDetail->Save($this->data)){
        						if($cid){
        							$this->Session->setFlash('Category updated Successfully.','default', array('class' => 'successmsg'));
        							if(isset($this->data['Action']['redirectpage'])){
        								$sessdata=$this->Session->read('newsortingby');
        								$this->redirect('/'.$sessdata);
        							}else{
        								$this->redirect(array('controller'=>'admins','action'=>'addcategories',$cid));
        							}
        						}else{
        							$this->Session->setFlash('Category Added Successfully.','default', array('class' => 'successmsg'));
        							if(isset($this->data['Action']['redirectpage'])){
        								$sessdata=$this->Session->read('newsortingby');
        								$this->redirect('/'.$sessdata);
        							}else{
        								$this->redirect(array('controller'=>'admins','action'=>'addcategories'));
        							}
        						}
        					}else{
        						$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));
        					}
        					$this->redirect(array('controller'=>'admins','action'=>'categorylist'));
        				}else{
        					$this->Session->setFlash('Category with same name already exists.','default',array('class' => 'msgTXt'));
        				}
        			}else{
        				if($errormsg['category_id']!='')
        					$this->Session->setFlash($errormsg['category_id'],'default',array('class' => 'msgTXt'));
        				else{
        					if($errormsg['description']!='')
        						$this->Session->setFlash($errormsg['description'],'default',array('class' => 'msgTXt'));
        				}
        			}
        		}
        		if($categorydetailsid){        			 
        			$this->CategoryDetail->id = $categorydetailsid;
        			$condition = array('id' => $categorydetailsid);
        			$this->data = $this->CategoryDetail->find('all',array('conditions' =>$condition));
        			$this->data = $this->data[0];
        			$this->set("selectedcategory",$this->data['CategoryDetail']['category_id']);
        			$this->set("selectedsubcategory",$this->data['CategoryDetail']['sub_category_id']);
        		}
        		$this->set("categorydropdown", $this->getCategoryDropdown());
        		$this->set("subcategorydropdown", $this->getSubCategoryDropdown($this->data['CategoryDetail']['category_id']));
        		 
        	}//end addcategories();
        	 
        	 
        	 
        	 
        	 
        	 
        	
        	
        	
        	function getRelatedCompany($categoryid){
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
        		$condition .=' AND CompanyType.company_type_status_id IN (3,5) AND CompanyType.company_type_category_id = "'.$categoryid.'" AND Company.id NOT IN('.$current_company.')' ;
        		$fields = 'email';
        		$companydtlarr = $this->Company->find('all',array("conditions"=>$condition,'fields'=>$fields ));
        		
        		$emailarray = array();
        		foreach($companydtlarr as $company){
        			$emailarray[] = $company['Company']['email'];
        		}
        		return $emailarray;
        	}
        	
        	
        	
        	/**
        	 * Function name : addcategories()
        	 * Description : This function used to add and edit category
        	 * Created On : 9th July 2012
        	 *
        	 */
        	
        	function viewcategory($categorydetailsid ='0'){
        	
        		$this->session_check_admin();
        	
        		##project id for each project
        		$project_id = $this->Session->read("sessionprojectid");
        		$project_name=$this->Session->read("projectwebsite_name_admin");
        		$this->set('current_project_name',$project_name);
        		 
        		##import Category Detail  model for processing
        		App::import("Model", "CategoryDetail");
        		$this->CategoryDetail =   & new CategoryDetail();
        		 
        		App::import("Model", "Category");
        	        		$this->Category =   & new Category();
        		 
        		//for active menu display
        				$this->set('page_url',"viewcategory");
        				 
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
        	
        		if($categorydetailsid){
        		$this->CategoryDetail->id = $categorydetailsid;
        		$condition = array('id' => $categorydetailsid);
        				$this->data = $this->CategoryDetail->find('all',array('conditions' =>$condition));
        		if(isset($this->data[0]))
        			$this->data = $this->data[0];
        			else
        			$this->data = array();
        		$this->set("selectedcategory",$this->data['CategoryDetail']['category_id']);
        		$this->set("selectedsubcategory",$this->data['CategoryDetail']['sub_category_id']);
        	}
        	
        	
        		$this->set("categorydropdown", $this->getCategoryDropdown());
        		$this->set("subcategorydropdown", $this->getSubCategoryDropdown($this->data['CategoryDetail']['category_id']));
     
        	}//end viewcategory();
        	
        	
        	
		#########################################< Email Tab >########################################## 
        	
        	
        	/**
        	 * Function name : tasklist()
        	 * Description   : This function used get list of players
        	 * Created On    : 07 September 2012
        	 * Created By    : Vidur
        	 */
        	
        	function tasklist($taskid =''){
        		
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
        		$projectDetails=$this->getprojectdetails($project_id);
        		$this->set('project',$projectDetails);

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
        		if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
        			$searchkeyword = $this->data['players']['searchkey'];
        			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND CommunicationTask.project_id In (0,$project_id) AND CommunicationTask.email_template_type ='1' AND  (CommunicationTask.task_name LIKE '%".$searchkeyword."%')";
        		}else{
        			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'  AND CommunicationTask.project_id In (0, $project_id) AND CommunicationTask.email_template_type ='1'";
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
					
        		 ##set project type data in variable
        		 $this->set("taskdata",$taskdata);
        		 $this->set("current_company",'0');
        		 $this->set("option",'0');
        		 
				# set help condition
        		App::import("Model", "HelpContent");
        		$this->HelpContent =  & new HelpContent();
        		$condition = "HelpContent.id = '13'";
        		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        		$this->set("hlpdata",$hlpdata);
        		# set help condition
        }//end tasklist()
        
       
       
       /*
        * Function name   : addtask()
        * Description 	  : This function used to add task
        * Created On      : 24-09-12
        */
        
        function addtask($opr=null,$recid=''){ 
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
        		$this->set('projectname',$project_name);
        		$this->set('project_id',$project_id);
			}	
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);

        	##import project type model for processing
        	App::import("Model", "CommunicationTask");
        	$this->CommunicationTask =   & new CommunicationTask();
        	
        	##check empty data
            if(!empty($this->data)) {
               $task_id=null;
               if($this->data['CommunicationTask']['id']){
                      $task_id=$this->data['CommunicationTask']['id']; 
               }

               ##import Email Template model for processing
               App::import("Model", "EmailTemplate");
               $this->EmailTemplate =   & new EmailTemplate();
               
               $this->EmailTemplate->id= $this->data['CommunicationTask']['email_template_id'];
               $emaltemplate = $this->EmailTemplate->read(array("fields"=>'email_template_type'));
           
               $this->data['CommunicationTask']['email_template_type'] = $emaltemplate['EmailTemplate']['email_template_type'];
               
              $uniqueTaskName = $this->CommunicationTask->isUniqueTaskName($this->data['CommunicationTask']['task_name'],$project_id,$task_id );  
              if ($uniqueTaskName == false) {
                    $this->Session->setFlash('Communication Task  with same name already exists.','default',array('class' => 'msgTXt'));
              }else{
              	
              		if(isset($this->data['CommunicationTask']['id'])){
              			$_project_id =  $this->data['CommunicationTask']['project_id'];
              		}else{
              			$_project_id = $project_id;
              		}
                  //STEP : SAVE COMMUNICATION TASK
                  $rec_id = $this->CommunicationTask->saveEmailTask($this->data['CommunicationTask'], $_project_id, '0');
                  if($rec_id > 0 ){
                       $this->Session->setFlash('Communication Task added Successfully.','default', array('class' => 'successmsg'));        
                       if(isset($this->data['Action']['redirectpage'])){
                           $this->redirect('/players/tasklist'); 
                       }else{
                           $this->redirect('/players/addtask/'.$rec_id);
                       }
                  }else{
                       $this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));     
                  }
             }   
              
            }
        	
        	if($recid!=''){
        		$this->CommunicationTask->id = $recid;
        		$this->set('taskrecid', $recid);
        		$this->data = $this->CommunicationTask->read();
        		$this->set('project_id',$this->data['CommunicationTask']['project_id']);
        		//echo "<pre>"; print_r($this->data); exit;
        		$this->data['CommunicationTask']['task_startdate']=date("m-d-Y", strtotime($this->data['CommunicationTask']['task_startdate']));
        			
        		if($this->data['CommunicationTask']['task_end_by_date']!="" && $this->data['CommunicationTask']['task_end']=="by_date"){
        			$this->data['CommunicationTask']['task_end_by_date']=date("m-d-Y", strtotime($this->data['CommunicationTask']['task_end_by_date']));
        		}
        	
        		if($this->data['CommunicationTask']['company_type']=="" && $this->data['CommunicationTask']['contact_type']==""){
        			$is_contactdisabled="1";
        			$is_memebrdisabled="0";
        		}else{
        			$is_contactdisabled="0";
        			$is_memebrdisabled="0";
        		}
        		$sel_email_temp=$this->data['CommunicationTask']['email_template_id'];
        		$sel_subscription_types=$this->data['CommunicationTask']['subscription_type'];
        		$sel_member_types=$this->data['CommunicationTask']['member_type'];
        		$sel_donation_levels=$this->data['CommunicationTask']['donation_level'];
        		$sel_days_since=$this->data['CommunicationTask']['member_days_since'];
        		$sel_country=$this->data['CommunicationTask']['member_country'];
        		$sel_state=$this->data['CommunicationTask']['member_state'];
        		$sel_event=$this->data['CommunicationTask']['event_id'];
        		$sel_event_rsvp=$this->data['CommunicationTask']['event_rsvp_type'];
        		$sel_comment_typeid=$this->data['CommunicationTask']['relatesto_commenttype_id'];
        		$sel_social_networks=$this->data['CommunicationTask']['social_network_members'];
        		$sel_non_networks=$this->data['CommunicationTask']['non_network_members'];
        		$sel_companytypeid=$this->data['CommunicationTask']['company_type'];
        		$sel_contactypeid=$this->data['CommunicationTask']['contact_type'];
        		$sel_recur_pattern=$this->data['CommunicationTask']['recur_pattern'];
        		$selectedtemplatetype = $this->data['CommunicationTask']['email_template_type'];
        		$sel_category = $this->data['CommunicationTask']['category_id'];
        		$sel_sub_category = $this->data['CommunicationTask']['sub_category_id'];
        		$sel_nonprofittype = $this->data['CommunicationTask']['non_profit_type_id'];
        		$sel_offer = $this->data['CommunicationTask']['offer_id'];
        		$email_from = $this->data['CommunicationTask']['email_from'];
        	}else{
        		$sel_email_temp="";
        		$sel_subscription_types="0";
        		$sel_member_types="";
        		$sel_donation_levels="";
        		$sel_days_since="";
        		$sel_country="254";
        		
        		$sel_event="";
        		$sel_event_rsvp="";
        		$sel_comment_typeid="0";
        		$sel_social_networks="";
        		$sel_non_networks="";
        		$sel_companytypeid="";
        		$sel_contactypeid="";
        		$sel_recur_pattern="--Select--";
        		$is_contactdisabled="0";
        		$is_memebrdisabled="0";
        		$selectedtemplatetype = '0';
        		$sel_category='';
        		$sel_sub_category ='0';
        		$sel_nonprofittype ='';
        		$sel_offer ='';
        		$email_from ='';
        		$sdate = '';
        	
        	}
        	$this->set('sel_email_temp',$sel_email_temp);
        	$this->set('email_from',$email_from);
        	$this->set('sel_subscription_types',$sel_subscription_types);
        	$this->set('sel_member_types',$sel_member_types);
        	$this->set('sel_donation_levels',$sel_donation_levels);
        	$this->set('sel_days_since',$sel_days_since);
        	$this->set('sel_country',$sel_country);
        	$this->set('sel_event',$sel_event);
        	$this->set('sel_event_rsvp',$sel_event_rsvp);
        	$this->set('sel_comment_typeid',$sel_comment_typeid);
        	$this->set('sel_social_networks',$sel_social_networks);
        	$this->set('sel_non_networks',$sel_non_networks);
        	$this->set('sel_companytypeid',$sel_companytypeid);
        	$this->set('sel_contactypeid',$sel_contactypeid);
        	$this->set('sel_recur_pattern',$sel_recur_pattern);
        	$this->set('is_contactdisabled',$is_contactdisabled);
        	$this->set('is_memebrdisabled',$is_memebrdisabled);
        	$this->set('sel_category',$sel_category);
        	$this->set('sel_sub_category',$sel_sub_category);
        	$this->set('sel_nonprofittype', $sel_nonprofittype);
        	$this->set('sel_offer',$sel_offer);
        	$this->set('selectedtemplatetype',$selectedtemplatetype);
        	$this->set('sdate',$sdate);
        	$this->set('sel_country', $sel_country) ;
        	$this->set('sel_state',$sel_state);
			  
        	# set help condition
        	
        	// Set memeber types array
			
        	//$this->set('member_types',$this->getMemberTypesListByProject($project_id, true));
        	
        	// Set Dasy Since  array
        	$this->set('days_since',$this->getDaysSinceArray());
        	
        	// Set Event RSVP array
        	$this->set('event_rsvp',$this->getEventRSVPArray());
        	
        	//Set Social Naetworks Array
        	$this->set('social_networks',$this->getSocialNetworkArray());
        	
        	//Set Recur Pattern Array
        	$this->set('recur_pattern',$this->getRecurPatternkArray());
        	
        	//Get Event Drop Down
        	$this->getEventDropDownListByProjetcID($project_id);
        	
        	//Get Company Type Drop Down
        	$this->getCompanyTypeDropdown($project_id, "", array(3,5));
        	
        	//Get Templates Drop Down
        	$this->getmailtemplates($project_id, '1');        	

        	##country drop down
        	$this->countrydroupdown();
        	$this->statedroupdown();
        	$this->set('categorydropdown',$this->getCategoryDropdown());
        	$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));
        	$this->nonprofittypedropdown();
        	$this->getOfferTypeDropdown();
        	//$this->customtemplatelisting();
        	$companytypestatusdropdown = $this->getCompanyTypeStatusDropdown();
        	$this->set("companytypestatusdropdown", $companytypestatusdropdown);
        	//$this->set("selectedcompanytypestatus", '');
        	$this->contacttypedropdown(0);
        	
        	# set help condition
        	App::import("Model", "HelpContent");
        	$this->HelpContent =  & new HelpContent();
        	$condition = "HelpContent.id = '46'";
        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        	$this->set("hlpdata",$hlpdata);
        	# set help condition
        	
        	
        }//addtask()
        

        /*
         * 	function    : getCompanyTypeDropdown()
        * 	params      : $projectid
        * 	Description : This function is used to get company type
        *  Created On  : 24-09-2012
        */
        
       /* function getCompanyTypeDropdown($projectid='')
        {
        	App::import("Model", "CompanyType");
        	$this->CompanyType  =    &new CompanyType();
        	$this->CompanyType->bindModel(array('belongsTo'=>array(
        			'CompanyTypeCategory'=>array(
        					'foreignKey'=>'company_type_category_id'
        			))));
        	$typecond = $projectid ? " AND CompanyType.project_id in('0','".$projectid."')" : '';
        	$companytypedata  =  $this->CompanyType->find("all", array('conditions' => "CompanyType.active_status='1' AND  CompanyType.company_type_status_id in(3,5) AND CompanyType.delete_status='0' ".$typecond,'order'=>'CompanyType.created ASC'),array('fields'=>array("DISTINCT CompanyType.company_type_name","CompanyType.id")));
        	$ctdata = Set::combine($companytypedata, '{n}.CompanyType.id', '{n}.CompanyTypeCategory.company_type_category_name');
        	asort($ctdata);
        	$this->set("ct_drpdwn", $ctdata);
        }*/
        
        
        /*
         * 	function    : getTemplateName()
         * 	params      : $projectid
         * 	Description : This function is used for custom template listing
         *  Created On  : 24-09-2012
         */
        function getTemplateByProjectId($project_id =''){
        	App::import("Model", "EmailTemplate");
        	$this->EmailTemplate  =    &new EmailTemplate();
            $condition = "EmailTemplate.project_id IN(0,$project_id) AND EmailTemplate.delete_status='0' AND EmailTemplate.active_status='1' AND EmailTemplate.email_template_type ='1'" ;
        	$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition));
        	//echo '<pre>******************';print_r($emailtempdtlarr);
        	$emailtemplates = Set::combine($emailtempdtlarr, '{n}.EmailTemplate.id', '{n}.EmailTemplate.email_template_name');
        	asort($emailtemplates);
        	//$this->pl($emailtemplates);
        	$this->set("templatedropdown", $emailtemplates);
        	
        }
        
        
        function ajax_get_sub_category($categoryid=''){
        	$subcategorydropdown = $this->getSubCategoryDropdown($categoryid);
        	echo "<option value='' >--Select--</option>";
        	foreach($subcategorydropdown as $key=>$val){
        		echo "<option value='".$key."' >".$val."</option>";
        	}        
        	die();
        }//ajax_get_sub_category
        
        
        
        function templatelist(){

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
				$this->set('projectname',$project_name);
				$this->set('project_id',$project_id);
			}	
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	$project_name=$projectDetails['Project']['project_name'];
        	$this->set('project_name',$project_name);
        	$projectid = $project_id;
        	
        	if(isset($_SERVER['QUERY_STRING'])){      	
        		$this->Session->delete("newsortingby");
        		$strloc=strpos($_SERVER['QUERY_STRING'],'=');
        		$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
        		$this->Session->write("newsortingby",$strdata);
        	}
        	      	
        	# set help condition
        	App::import("Model", "HelpContent");
        	$this->HelpContent =  & new HelpContent();
        	$condition = "HelpContent.id = '41'";
        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        	$this->set("hlpdata",$hlpdata);
        	# set help condition
        
        	
        	
        	##import EmailTemplate  model for processing
        	App::import("Model", "EmailTemplate");
        	$this->EmailTemplate =   & new EmailTemplate();
        	##fetch data from EmailTemplate table for listing

        	$field='';
        	if(!empty($this->data)){
			
        		$searchkey=$this->data['players']['searchkey'];
        		$varsearch='%'.$searchkey.'%';
        		
        		$condition = "EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0' AND EmailTemplate.active_status='1'  AND EmailTemplate.is_sytem ='1' AND EmailTemplate.is_event_temp='0' AND EmailTemplate.email_template_type ='1' " ;
        	}else{
        		$condition = "EmailTemplate.delete_status='0' AND EmailTemplate.active_status='1' AND EmailTemplate.is_sytem ='1' AND EmailTemplate.is_event_temp='0' AND EmailTemplate.email_template_type = '1' ";
        	}
        	
        	$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination
        	$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        	$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

        	##set EmailTemplate data in variable
        	$this->set("emailtemplates",$emailtempdtlarr);
        }
       
        /*
        * Function name   : addtemplate()
        * Description 	  : This function used to add new mail template
        * Created On      : 25-Sept-2012
        *
        */
        function addtemplate($templateid=0,$returnurl=""){
        
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
				$this->set('projectname',$project_name);
				$this->set('project_id',$project_id);
			}				
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	$project_name=$projectDetails['Project']['project_name'];
        	$this->set('project_name',$project_name);
        	$projectid = $project_id;
        		
        	##import EmailTemplate  model for processing
        	App::import("Model", "EmailTemplate");
        	$this->EmailTemplate =   & new EmailTemplate();
        	 
        	// if $returnurl is popup then its need to close else no need to close
        	$this->set("closeit","no");

        	##check empty data
		    if(!empty($this->data)){
		        	#set the posted data
		        	$this->EmailTemplate->set($this->data);
		        	
		        	#check server side validation
		        	$errormsg = $this->EmailTemplate->invalidFields();
	        		$templname = $this->data['EmailTemplate']['email_template_name'];
	        		$templateid = $this->data['EmailTemplate']['id'];
	        		if($templateid==0)
	        		{
						$this->data['EmailTemplate']['is_sytem'] = '1';
	        		}
		        	$this->data['EmailTemplate']['project_id'] = '0';
		        	$this->data['EmailTemplate']['is_inherit'] = '1';
		        	
		        	if(!$errormsg){
		        		$templname = $this->data['EmailTemplate']['email_template_name'];
		        		if($templateid> 0)   {
		        			$condition = "email_template_name = '".$templname."' AND project_id = '0' AND  delete_status = '0' AND id !='".$templateid."'";
		        			
		        		}else{
		        			$condition = "email_template_name = '".$templname."' AND project_id = '0' AND  delete_status = '0'";
		        		}
		         
		        	##check already exists EmailTemplate name
		        	$ctdata = $this->EmailTemplate->find('all',array("conditions"=>$condition));
				    if(!$ctdata){
				    	if($this->data['EmailTemplate']['id']){
				    		$this->EmailTemplate->id = $this->data['EmailTemplate']['id'];
				    	}
				    	
				    	$this->data['EmailTemplate']['email_template_type']="1";
				    	$this->data['EmailTemplate']['project_id']= $projectid;
				    	
				    	if(isset($this->data['EmailTemplate']['id'])){
				    		unset($this->data['EmailTemplate']['project_id']);
				    	}
				    	
				        if($this->EmailTemplate->Save($this->data['EmailTemplate'])){
				        	$mailtempid = $this->EmailTemplate->getLastInsertId();
				        	if($returnurl!=""){	 
				        		$gotourl=str_replace("_id_", "/", $returnurl);
				        		$this->set("closeit","yes");
				        	}else{
				        		if($this->data['EmailTemplate']['id'])
				        			$this->Session->setFlash('Template updated Successfully.','default', array('class' => 'successmsg'));
				        		else 	
				        			$this->Session->setFlash('Template added Successfully.','default', array('class' => 'successmsg'));
				        		if(isset($this->data['Action']['redirectpage'])){
				        			$sessdata=$this->Session->read('newsortingby');
				        			$this->redirect(array('controller' => 'players', 'action' =>'templatelist'));
				        		}else{
				        			$this->redirect(array('controller' => 'players', 'action' =>'templatelist', $mailtempid));
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
        	$selectedtemplatetype = '';
        	if($templateid>0){
        		$this->EmailTemplate->id = $templateid;
        		$this->data = $this->EmailTemplate->read();
        		//$isreadonly=($this->data['EmailTemplate']['project_id']==0)?'1':'0';
        		$isreadonly= (isset($this->data['EmailTemplate']['project_id']) &&  ($this->data['EmailTemplate']['project_id'] != '0' || $usertype =='admin')) ? '0': '1';
        		$this->set("isreadonly",$isreadonly);
        		if(!empty($errormsg)){
        			$this->data['EmailTemplate']['content']="";
        		}
        	}
        	
        	# set help condition
        	App::import("Model", "HelpContent");
        	$this->HelpContent =  & new HelpContent();
        	$condition = "HelpContent.id = '11'";
        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
        	$this->set("hlpdata",$hlpdata);
        	$this->set("returnurl",$returnurl);
        	$this->set("selectedtemplatetype",$selectedtemplatetype);
        	# set help condition
        	
        	
        }
        
        
        
        
        /**
         * Function name : tasklist()
         * Description   : This function used get list of players
         * Created On    : 07 September 2012
         * Created By    : Vidur
         */
         
        function activelist($taskid =''){
        
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
			$projectDetails=$this->getprojectdetails($project_id);
			$this->set('project',$projectDetails);
    				
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
           if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey']){
           		$searchkeyword = $this->data['Admins']['searchkey'];
           		$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND CommunicationTask.project_id In (0,$project_id) AND CommunicationTask.email_template_type ='1' AND  (CommunicationTask.task_name LIKE '%".$searchkeyword."%' OR CommunicationTask.notes LIKE '%".$searchkeyword."%') AND CommunicationTask.task_is_done = '0' ";
           }else{
                $condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'  AND CommunicationTask.project_id In (0, $project_id) AND CommunicationTask.email_template_type ='1' AND CommunicationTask.task_is_done = '0' ";
           }
           
           // $condition = "CommunicationTask.delete_status = '0' and CommunicationTask.project_id='".$projectid."'";
           $this->Pagination->sortByClass    = 'CommunicationTask'; ##initaite pagination                				
           $this->Pagination->total= count($this->CommunicationTask->find('all',array("conditions"=>$condition)));     				
           list($order,$limit,$page) = $this->Pagination->init($condition,$field);     				
		   $this->CommunicationTask->bindModel(array('belongsTo'=>array(
           				'EmailTemplate'=>array(
                		'foreignKey'=>false,
                		'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
           ))));
                				
		   $taskdata = $this->CommunicationTask->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		   
		   ##set project type data in variable
		   $this->set("taskdata",$taskdata);
		   
		   # set help condition
		   App::import("Model", "HelpContent");
		   $this->HelpContent =  & new HelpContent();
		   $condition = "HelpContent.id = '13'";
		   $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		   $this->set("hlpdata",$hlpdata);
		   # set help condition

        }//end activelist()
        
        
        
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
			}	
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);

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
        					'foreignKey'=>false,
        					'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
        	))));

        	##fetch data from project type table for listing
        	$field='';
        	##checking search key
        	if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
        		$searchkeyword = $this->data['players']['searchkey'];
        		$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";
        	}else{
        		$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";
        	}
			
        	$condition .= " AND EmailTemplate.email_template_type = '1' ";
        	
        	
        	$this->Pagination->sortByClass    = 'CommunicationTaskHistory'; ##initaite pagination
        	$this->Pagination->total= count($this->CommunicationTaskHistory->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition,$field);
        	$this->CommunicationTaskHistory->bindModel(array('belongsTo'=>array(
        			'EmailTemplate'=>array(
        					'foreignKey'=>false,
        					'conditions'=>'EmailTemplate.id = CommunicationTaskHistory.email_template_id'
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
			}	
			
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);

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
        	##fetch data from EmailTemplate table for listing
        	$field='';

        	if(!empty($this->data))
        	{
        		//print_r($this->data);
        		$searchkey=$this->data['Admins']['searchkey'];
        		$varsearch='%'.$searchkey.'%';
        		$condition = "EmailTemplate.project_id IN(0, '$projectid') AND EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='0'  and (EmailTemplate.is_event_temp='0' or is_event_temp='' or is_event_temp is NULL)";
        		//echo $condition;
        	}
        	else
        	{
        		$condition = "EmailTemplate.project_id IN (0,'$projectid') AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='0' and (EmailTemplate.is_event_temp='0' or is_event_temp='' or is_event_temp is NULL)";
        	}
        	
        	$condition .= " AND (EmailTemplate.responder_type ='player' OR EmailTemplate.override_all ='1')  " ;
        	
        	$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination
        	$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition,$field);
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
        		$project_name=$this->Session->read("projectwebsite_name_admin");
        		$this->set('current_project_name',$project_name);
			}	
        	
        	
        	##import EmailTemplate  model for processing
        	App::import("Model", "EmailTemplate");
        	$this->EmailTemplate =   & new EmailTemplate();
        
        	$this->set("templateid",$templateid);
        	$current_domain= $_SERVER['HTTP_HOST'];
        	##check empty data
        	if(!empty($this->data)) {
        		//$extra=$this->data['Company']['extra'];
        		#set the posted data
        		
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
        								$this->redirect('/players/addresponder/edit/'.$templateid);
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
        		/*
        		if($this->data['EmailTemplate']['is_sytem']=='0'){
        			$this->set("isreadonly",'0');
        		}*/
        		
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
        			$project_id = $this->Session->read("sessionprojectid");
					$project_name=$this->Session->read("projectwebsite_name_admin");
					$this->set('current_project_name',$project_name);
					$this->set('project_id',$project_id);
			}		
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);
        	$projectid = $project_id;
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
        	if(isset($this->data['players']['searchkey']) && $this->data['players']['searchkey']){
        		$searchkeyword = $this->data['players']['searchkey'];
        		$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";
        	}else{
        		$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";
        	}
			
        	$condition .= " AND (EmailTemplate.responder_type ='offer' OR EmailTemplate.override_all ='1')  " ;
        	
        	
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
        
        
        #########################################</  Email Tab  >##########################################
        
        
        
        /*
         * Function name	: addoffer()
        * Description      : This function used to add company for project
        * Created On       : 06-September-2012
        */
        
        function addoffer($option='company', $companyid='', $hqid=0){
        
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
			}	
        	##import Company  model for processing
        	App::import("Model", "Company");
        	$this->Company =   & new Company();
        	
        	if($this->Session->check("current_company") && $this->Session->read("current_company") !='-1' ){
        		$currentcompany = $this->Company->findById($this->Session->read("current_company"));
        		$this->set('current_company', $this->Session->read("current_company"));
        		$this->set('current_company_name', 	$currentcompany['Company']['company_name']);
        	}else{
        		$this->set('current_company_name', '');
        	}
        
        	$companytypecategoryid = $this->getCompanyCategory($option);        
        	$this->set('option',$option);
        	$this->set('companytypecategoryid',$companytypecategoryid);        	
        	$projectDetails=$this->getprojectdetails($project_id);
        	$this->set('project',$projectDetails);        	
        
        }
		
		 /**
       * Function to show list of Members or contacts who falls within given communication task set-up parametes
       * This function is called at addcommtask 
       *  
       */
        function commtask_get_report_list_by_ajax(){
            #get record from global funtion for ajax calling
			//echo "fdfdF";exit;
            $this->layout="ajax";
            ##check admin session live or not
            $this->session_check_admin();
           
               
            ##import communication Task model for processing
            App::import("Model", "CommunicationTask");
            $this->CommunicationTask =   & new CommunicationTask();    

            $projectid = $this->Session->read("sessionprojectid");
            $project_name=$this->Session->read("projectwebsite_name_admin"); 

			//print_r($_POST);
            if($projectid)
            {      
                $taskArray=$_POST['data']['CommunicationTask']; 
                
                if($taskArray['id']){
                    //STEP : Task is talready saved so 
                     $is_temp=1;
                     $taskArray['id']="";
                     $taskArray['task_name']= trim($taskArray['task_name'])."_temp";
                }else{
                     //STEP : Task is temporary so 
                     $is_temp=1; 
                     $taskArray['task_name']= trim($taskArray['task_name'])."_temp"; 
                }

               // STEP : Save Task Temporary  & get temp  Task id
                $tempTaskId= $this->CommunicationTask->saveEmailTask($taskArray,$projectid, $is_temp);  
               // STEP : Call Stored Procedure to get matching members or contacts list records 
               if($tempTaskId > 0){ 
                         
                        $result= $this->CommunicationTask->getEmailTaskMatchingMembersOrContacts($tempTaskId, $projectid);
                        if(isset($result['0']['Contact']) ){
                           $this->set('showlist',"contact");  
                           $this->set('contactdetails',$result);        
                        }else{
                            $this->set('showlist',"member");  
                            $this->set('userdetails',$result);
                        }
                      //  echo "<pre>"; print_r($result); echo "</pre>";
     
                     
               }else{
                    $this->set('userdetails',false); 
               }
               
            
            }else{
                 $this->set('userdetails',false);
            }
            
             

        }
        
        
        
        function getRelatedNonProfit($companyid, $sel_np){
        	
        	$this->layout='';
        	App::import("Model", "Company");
        	$this->Company =   & new Company();
        	
			$this->Company->bindModel(array('hasAndBelongsToMany'=>array(
				'Company'=>array(
						'joinTable'              => 'related_non_profits',
						'foreignKey'             => 'company_id',
						'associationForeignKey'  => 'nonprofit_id'
			))));
			
			$projectid = $this->Session->read("sessionprojectid");
			$condition = 'Company.id= '.$companyid.' AND Company.project_id = '.$projectid;
        	$releatednonprofitdata =  $this->Company->find('all',array("conditions"=>$condition));
        	
        	foreach($releatednonprofitdata as $nonprofit){
        	
        	}
        	exit;
        
        }
		
        
        
}


?>