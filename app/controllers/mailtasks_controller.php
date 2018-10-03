<?php

/*

 *created by	   : Puneet

*Project		   :-  Image coin website

* Controller Name  :-  setups_contoller.php

* Created  On      :-  20-04-12

*/

class MailtasksController extends AppController

{



	var $name = 'mailtasks';

	//var $uses = 'Setup';

	var $layout = 'new_admin_layout';

	var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');

	var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');

	var $uses     = array('Admin', 'Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term','CommunicationTask','EmailTemplate');



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

	/**

		* Function name   : mail_task_list()

		* Description	  : This function used to set mail task list

		* Created On      : 24-04-2012

		**/



	function mail_task_list(){



			

		##check admin session live or not

		$this->session_check_admin();



		##fetch data from project type table for listing

		App::import("Model", "SystemVersion");

		$this->Project =   & new SystemVersion();

		$field='';

		$condition = "delete_status = '0'";

		if(isset($this->data['mailtasks']['searchkey']) && $this->data['mailtasks']['searchkey']){

			$searchkeyword = $this->data['mailtasks']['searchkey'];

			$condition .= "  and (system_version_name LIKE '%".$searchkeyword."%' OR note  LIKE '%".$searchkeyword."%' )";

		}



		$this->Pagination->sortByClass    = 'SystemVersion'; ##initaite pagination

			

		$this->Pagination->total= count($this->SystemVersion->find('all',array("conditions"=>$condition)));



		list($order,$limit,$page) = $this->Pagination->init($condition,$field);



		$sys_ver_data = $this->SystemVersion->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		##set project type data in variable

		$this->set("sys_ver_data",$sys_ver_data);







	}



	function mailtask_list(){



		$this->session_check_admin();

		$projectid = '0';

		$project_name='0';

		$this->set('current_project_name',$project_name);



		if(isset($_SERVER['QUERY_STRING']))

		{

			$this->Session->delete("newsortingby");

			$strloc=strpos($_SERVER['QUERY_STRING'],'=');

			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);

			$this->Session->write("newsortingby",$strdata);



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

		if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey']){

			$searchkeyword = $this->data['Admins']['searchkey'];

			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND (CommunicationTask.task_name LIKE '%".$searchkeyword."%' OR CommunicationTask.notes LIKE '%".$searchkeyword."%')";

		}else{

			$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'";

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



	}





	/*

	 * Function name   : supermailtemplatelist()

	* Description : This function used to list Email Templates of super admin

	* Created On      : 12-12-11 (04:20pm)

	*

	*/

	function supermailtemplatelist(){



		##check admin session live or not

		$this->session_check_admin();
		echo 4;exit;



		##import EmailTemplate  model for processing

		App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();

		##fetch data from EmailTemplate table for listing

		$field='';



		if(!empty($this->data))

		{

			//print_r($this->data);

			$searchkey=$this->data['mailtasks']['searchkey'];

			$varsearch='%'.$searchkey.'%';

			$condition = "EmailTemplate.project_id = '0' AND EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='1'";

			//echo $condition;

		}

		else

		{

			$condition = "EmailTemplate.project_id = '0' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='1'";

		}



		$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination



		$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		##set EmailTemplate data in variable



		$this->set("emailtemplates",$emailtempdtlarr);

	}



	/*

	 * Function name   : addsupermailcontent()

	* Description : This function used to add new mail template by super admin

	* Created On      : 24-12-2012

	*

	*/

	function addsupermailcontent($templateid=0,$returnurl=""){



		##check admin session live or not

			

		$this->session_check_admin();

			

		##import EmailTemplate  model for processing

		App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();

		 

		// if $returnurl is popup then its need to close else no need to close

		$this->set("closeit","no");



		##check empty data

		if(!empty($this->data)){

			#set the posted data

			//$this->pl($this->data);

			$this->EmailTemplate->set($this->data);

			#check server side validation

			$errormsg = $this->EmailTemplate->invalidFields();

			$templname = $this->data['EmailTemplate']['email_template_name'];

			$templateid = $this->data['EmailTemplate']['id'];

			if($templateid==0)

			{

				//$this->data['EmailTemplate']['is_sytem'] = '1';

				//  Changed By Suman

				// Date 3 May 2011

					

				$this->data['EmailTemplate']['is_sytem'] = '1';

			}

			$this->data['EmailTemplate']['project_id'] = '0';

			$this->data['EmailTemplate']['is_inherit'] = '1';

			// $returnurl=$this->data['Admins']['returnurl'];

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



					if($this->EmailTemplate->Save($this->data['EmailTemplate'])){



						$mailtempid = $this->EmailTemplate->getLastInsertId();



						if($returnurl!=""){

							// $gotourl=explode("_id_",$this->data['Admins']['returnurl']);

							 

							$gotourl=str_replace("_id_", "/", $returnurl);



							$this->set("closeit","yes");

							//$this->redirect('/admins/'.$gotourl);

						}else{

							$this->Session->setFlash('Template added Successfully.','default', array('class' => 'successmsg'));

							if(isset($this->data['Action']['redirectpage'])){

								$sessdata=$this->Session->read('newsortingby');

								$this->redirect(array('controller' => 'mailtasks', 'action' =>'supermailtemplatelist'));

							}else{

								$this->redirect(array('controller' => 'mailtasks', 'action' =>'supermailtemplatelist', $mailtempid));

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

			$isreadonly=(!empty($this->data))?'1':'0';

			$this->set("isreadonly",$isreadonly);

			if(!empty($errormsg)){

				$this->data['EmailTemplate']['content']="";

			}

			$selectedtemplatetype = $this->data['EmailTemplate']['email_template_type'];

		}

		# set help condition

		App::import("Model", "HelpContent");



		$this->HelpContent =  & new HelpContent();



		$condition = "HelpContent.id = '11'";



		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));



		$this->set("hlpdata",$hlpdata);



		$this->set("returnurl",$returnurl);

			

		$templatetypedropdown = array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers');

		$this->set("templatetypedropdown",$templatetypedropdown);

		$this->set("selectedtemplatetype",$selectedtemplatetype);

			



		# set help condition

	}



	/*

	 * Function name   : changestatus()

	* Arguments : $recid,$modelname,$status,$methodname

	* Description : This function used to change status as active or deactive

	* Created On      : 25-04 2012

	*

	*/

	 

	function changestatus($recid,$modelname,$status,$methodname,$action='cngstatus',$othermodel='',$otherid='',$param=''){

			

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

		//$this->redirect("$methodname/");

		$this->redirect("activetasklist");

	}//end of changestatus()





	function mail_task($opr,$id=null)

	{

		##check admin session live or not

		$this->session_check_admin();

			

		App::import("Model", "SystemVersion");

		$this->SystemVersion =   & new SystemVersion();

			

		$projectid = $this->Session->read("sessionprojectid");

		if(empty($projectid)){

			$projectid='0';

		}

		$projectDetails=$this->getprojectdetails($projectid);

		$this->set('fromemail',$projectDetails['Sponsor']['email']);

		$sel_email_temp="";

		$sel_subscription_types="0";

		$sel_member_types="";

		$sel_donation_levels="";

		$sel_days_since="";

		$sel_country="254";

		$sel_state="";

		$sel_event="";

		$sel_event_rsvp="";

		$sel_comment_typeid="0";

		$sel_social_networks="";

		$sel_non_networks="";

		$sel_companytypeid="";

		$sel_contactypeid="";

		$is_contactdisabled="0";

		$is_memebrdisabled="0";

		$sel_recur_pattern="--Select--";

			

		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());

			

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

			

		//Set donation levles array

		$this->set('donation_levels',$this->getDonationLevelsListByProject($projectid));

			

		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());

			

		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());

		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);



		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);

			

		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());



		//Get Company Type Drop Down

		$this->contacttypedropdown($projectid);

		$this->set('contacttypedropdown',$contacttypedropdown);

			

		//country drop down

		$this->countrydroupdown();

			

		//State drop down

		$this->statedroupdown();

			

		//custome Template drop down

		$this->customtemplatelisting();

			

		$this->set('sel_recur_pattern',$sel_recur_pattern);

		$this->set('is_contactdisabled',$is_contactdisabled);

		$this->set('is_memebrdisabled',$is_memebrdisabled);

		$this->set('sel_companytypeid',$sel_companytypeid);

		$this->set('sel_contactypeid',$sel_contactypeid);

		$this->set('sel_non_networks',$sel_non_networks);

		$this->set('sel_social_networks',$sel_social_networks);

		$this->set('sel_event',$sel_event);

		$this->set('sel_event_rsvp',$sel_event_rsvp);

		$this->set('sel_comment_typeid',$sel_comment_typeid);

		$this->set('sel_country',$sel_country);

		$this->set('sel_state',$sel_state);

		$this->set('sel_days_since',$sel_days_since);

		$this->set('sel_donation_levels',$sel_donation_levels);

		$this->set('sel_member_types',$sel_member_types);

		$this->set('sel_subscription_types',$sel_subscription_types);

		$this->set('sel_email_temp',$sel_email_temp);

		$templatetypedropdown = array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers');

		$this->set("templatetypedropdown",$templatetypedropdown);

		$selectedtemplatetype = '';



			

		if($opr=="edit")

		{

			$this->SystemVersion->id = $id;

			$this->data = $this->SystemVersion->read();

			$this->set("data", $this->data);

			$selectedtemplatetype = $this->data['CommunicationTask']['email_template_type'];

		}

		$this->set("selectedtemplatetype",$selectedtemplatetype);

	}//end of mail_task();





	function mail_task_member($recid=''){

			

		//Configure::write('debug',2);

		##check admin session live or not

		$this->session_check_admin();

			

		App::import("Model", "SystemVersion");

		$this->SystemVersion =   & new SystemVersion();

			

		$projectid = $this->Session->read("sessionprojectid");

		if(empty($projectid)){

			$projectid='0';

		}

		$projectDetails=$this->getprojectdetails($projectid);

			

			

		if($recid!=''){

			$this->CommunicationTask->id = $recid;

			$this->set('taskrecid', $recid);

			$this->data = $this->CommunicationTask->read();

				

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

			$sel_category= $this->data['CommunicationTask']['category_id'];

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

			$sel_state="";

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

		$this->set('sel_state',$sel_state);

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

		$this->set('sdate',$sdate);

		$this->set('selectedtemplatetype',$selectedtemplatetype);

		# set help condition

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

		//Set donation levles array

		$this->set('donation_levels',$this->getDonationLevelsListByProject($projectid));

		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());

		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());

		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());

		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());

		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);

		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);

		//Get Company Type Drop Down

		$contacttypedropdown =$this->contacttypedropdown($projectid);

		$this->set('contacttypedropdown',$contacttypedropdown);

		##country drop down

		$this->countrydroupdown();

		$this->statedroupdown();

		$this->set("templatetypedropdown",array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers'));

		$this->set('categorydropdown',$this->getCategoryDropdown());

		$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));

		$this->nonprofittypedropdown();

		$this->offertypetempdropdown();

		$this->customtemplatelisting();

		$companytypestatusdropdown = $this->getCompanyTypeStatusDropdown();



		$this->set("companytypestatusdropdown", $companytypestatusdropdown);

		//$this->set("selectedcompanytypestatus", '');

		$this->contacttypedropdown(0);

		$this->commenttypelisting($projectid);









	}





	function mail_task_player($recid=''){



		//Configure::write('debug',2);

		##check admin session live or not

		$this->session_check_admin();

			

		$projectid = $this->Session->read("sessionprojectid");

		if(empty($projectid)){

			$projectid='0';

		}

		$projectDetails=$this->getprojectdetails($projectid);

			

		if($recid!=''){

			$this->CommunicationTask->id = $recid;

			$this->set('taskrecid', $recid);

			$this->data = $this->CommunicationTask->read();

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

			$sel_state="";

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

		$this->set('sel_state',$sel_state);

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

		# set help condition

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

		//Set donation levles array

		$this->set('donation_levels',$this->getDonationLevelsListByProject($projectid));

		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());

		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());

		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());

		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());

		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);

		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);

		//Get Company Type Drop Down

		//  $contacttypedropdown =$this->contacttypedropdown($projectid);

		// $this->set('contacttypedropdown',$contacttypedropdown);

		##country drop down

		$this->countrydroupdown();

		$this->statedroupdown();

		$this->set("templatetypedropdown",array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers'));

		$this->set('categorydropdown',$this->getCategoryDropdown());



		$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));



		$this->nonprofittypedropdown();

		$this->offertypetempdropdown();

		$this->customtemplatelisting();

		$companytypestatusdropdown = $this->getCompanyTypeStatusDropdown();



		$this->set("companytypestatusdropdown", $companytypestatusdropdown);

		//$this->set("selectedcompanytypestatus", '');

		$this->contacttypedropdown(0);

	}





	function mail_task_prospect($recid=''){

		##check admin session live or not

		$this->session_check_admin();

			

		App::import("Model", "SystemVersion");

		$this->SystemVersion =   & new SystemVersion();

			

		$projectid = $this->Session->read("sessionprojectid");

		if(empty($projectid)){

			$projectid='0';

		}

		$projectDetails=$this->getprojectdetails($projectid);

			

		if($recid!=''){

			$this->CommunicationTask->id = $recid;

			$this->set('taskrecid', $recid);

			$this->data = $this->CommunicationTask->read();

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

			$sel_state="";

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

		$this->set('sel_state',$sel_state);

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

		$this->set('sdate',$sdate);

		$this->set('selectedtemplatetype',$selectedtemplatetype);

		# set help condition

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

		//Set donation levles array

		$this->set('donation_levels',$this->getDonationLevelsListByProject($projectid));

		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());

		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());

		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());

		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());

		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);

		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);

		//Get Company Type Drop Down

		// $contacttypedropdown =$this->contacttypedropdown($projectid);

		//$this->set('contacttypedropdown',$contacttypedropdown);

		##country drop down

		$this->countrydroupdown();

		$this->statedroupdown();

		$this->set("templatetypedropdown",array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers'));

		$this->set('categorydropdown',$this->getCategoryDropdown());

		$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));

		$this->nonprofittypedropdown();

		$this->offertypetempdropdown();

		$this->customtemplatelisting();

		$companytypestatusdropdown = $this->getCompanyTypeStatusDropdown();



		$this->set("companytypestatusdropdown", $companytypestatusdropdown);

		//$this->set("selectedcompanytypestatus", '');

		$this->contacttypedropdown(0);

	}



	function mail_task_offer($recid=''){



		##check admin session live or not

		$this->session_check_admin();

			

		App::import("Model", "SystemVersion");

		$this->SystemVersion =   & new SystemVersion();

			

		$projectid = $this->Session->read("sessionprojectid");

		if(empty($projectid)){

			$projectid='0';

		}

			

		$projectDetails=$this->getprojectdetails($projectid);

		$this->set('fromemail',$projectDetails['Sponsor']['email']);

			

		if($recid!=''){

			$this->CommunicationTask->id = $recid;

			$this->set('taskrecid', $recid);

			$this->data = $this->CommunicationTask->read();

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

			$sel_category= $this->data['CommunicationTask']['category_id'];

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

			$sel_state="";

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

		$this->set('sel_state',$sel_state);

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

		$this->set('sdate',$sdate);

		$this->set('selectedtemplatetype',$selectedtemplatetype);

		# set help condition

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

		//Set donation levles array

		$this->set('donation_levels',$this->getDonationLevelsListByProject($projectid));

		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());

		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());

		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());

		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());

		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);

		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);

		//Get Company Type Drop Down

		// $contacttypedropdown =$this->contacttypedropdown($projectid);

		//$this->set('contacttypedropdown',$contacttypedropdown);

		##country drop down

		$this->countrydroupdown();

		$this->statedroupdown();

		$this->set("templatetypedropdown",array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers'));

		$this->set('categorydropdown',$this->getCategoryDropdown());

		$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));

		$this->nonprofittypedropdown();

		$this->offertypetempdropdown();

		$this->customtemplatelisting();

		$companytypestatusdropdown = $this->getCompanyTypeStatusDropdown();



		$this->set("companytypestatusdropdown", $companytypestatusdropdown);

		//$this->set("selectedcompanytypestatus", '');

		$this->contacttypedropdown(0);

	}



	function ajax_get_sub_category($categoryid=''){

			

		$subcategorydropdown = $this->getSubCategoryDropdown($categoryid);

		echo "<option value='' >--Select--</option>";

		foreach($subcategorydropdown as $key=>$val){

			echo "<option value='".$key."' >".$val."</option>";

		}

			

			

		die();

	}





	/*

		* Function name  : addmailtask()

	* Description 	  : This function used to add commom task

	* Created On      : 31-Aug-2012

	* Created By	  : Vidur

	*

	*/



	function addmailtask($opr=null,$recid=''){

			

		//Configure::write('debug', 2);

		//pr($this->data); exit;

		##check admin session live or not

		$this->session_check_admin();

		//$projectid = $this->Session->read("sessionprojectid");

		$projectid = '1';

		$this->set('projectid',$projectid);

		

		##import communication Task model for processing*/

		App::import("Model", "CommunicationTask");

		$this->CommunicationTask =   & new CommunicationTask();

		

		##check empty data

		$current_domain= $_SERVER['HTTP_HOST'];

		$this->set("current_domain",$current_domain);

		$this->set("email_from" , Admin::ADMIN_EMAIL);

		//$projectDetails=$this->getprojectdetails($projectid);

		//$this->set('fromemail',$projectDetails['Sponsor']['email']);

		if(!empty($this->data)){

		

			if($recid =='') {

				$task_id=null;

				if(isset($this->data['CommunicationTask']['id']) && $this->data['CommunicationTask']['id']){

					$task_id=$this->data['CommunicationTask']['id'];

					$this->CommunicationTask->id = $this->data['CommunicationTask']['id'];

				}

				//$uniqueTaskName = $this->CommunicationTask->isUniqueTaskName($this->data['CommunicationTask']['task_name'],$projectid,$task_id );

				$uniqueTaskName = $this->CommunicationTask->isUniqueTaskName($this->data['CommunicationTask']['task_name'], 0, $task_id );

				if ($uniqueTaskName == false) {

					$this->Session->setFlash('Communication Task  with same name already exists.','default',array('class' => 'msgTXt'));

					$this->redirect("/mailtasks/addmailtask/edit/$recid");

				}else{

					// STEP : SAVE COMMUNICATION TASK

					//$rec_id = $this->CommunicationTask->saveEmailTask($this->data['CommunicationTask'], $projectid, '0');

					$rec_id = $this->CommunicationTask->saveEmailTask($this->data['CommunicationTask'], $projectid, '0');

					if($rec_id > 0 ){

						if(isset($this->data['CommunicationTask']['id'])){

							$this->Session->setFlash('Communication Task updated Successfully.','default', array('class' => 'successmsg'));

						}else{

							$this->Session->setFlash('Communication Task added Successfully.','default', array('class' => 'successmsg'));

						}

						if(isset($this->data['Action']['redirectpage'])){

							

							$this->redirect('/mailtasks/activetasklist');

						}else

						{	

							$this->redirect('/mailtasks/addmailtask/edit/'.$rec_id);

						}

					}else{

						$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));

					}

				}

			}else{



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

						$this->redirect('/mailtasks/addmailtask/'.$this->data['CommunicationTask']['id']);

					}

				}



				

				$this->data['CommunicationTask']['project_id']=$projectid;

				#set the posted data

				$this->CommunicationTask->set($this->data);

				#check server side validation

				$this->CommunicationTask->invalidFields();

					

				#save data in project type table



				if($this->CommunicationTask->Save($this->data)){

					$this->Session->setFlash('Communication Task updated Successfullydddd.','default', array('class' => 'successmsg'));

				}else{

					$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));

				}

					

				if(isset($this->data['Action']['redirectpage'])){

					$sessdata=$this->Session->read('newsortingby');

					$this->redirect('/'.$sessdata);

				}else

				{

					$this->redirect("/mailtasks/addmailtask/edit/$recid");

				}

			}

		}

			

		$this->customtemplatelisting($projectid);

		$this->commenttypelisting($projectid);

 		$this->set("hlpdata",$this->getHelpContent(14));

 		if($recid!=''){

			$this->CommunicationTask->id = $recid;

			$this->set('taskrecid', $recid);

			$this->data = $this->CommunicationTask->read();

			//echo '<pre>';print_r($this->data);die;

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

			$sel_category= $this->data['CommunicationTask']['category_id'];

			$sel_sub_category = $this->data['CommunicationTask']['sub_category_id'];

			$sel_nonprofittype = $this->data['CommunicationTask']['non_profit_type_id'];

			$sel_offer = $this->data['CommunicationTask']['offer_id'];

		}else{

			$sel_email_temp="";

			$sel_subscription_types="0";

			$sel_member_types="";

			$sel_donation_levels="";

			$sel_days_since="";

			$sel_country="254";

			$sel_state="";

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

		}

		

		$this->set('sel_email_temp',$sel_email_temp);

		$this->set('sel_subscription_types',$sel_subscription_types);

		$this->set('sel_member_types',$sel_member_types);

		$this->set('sel_donation_levels',$sel_donation_levels);

		$this->set('sel_days_since',$sel_days_since);

		$this->set('sel_country',$sel_country);

		$this->set('sel_state',$sel_state);

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

		# set help condition

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

		//Set donation levles array

		$this->set('donation_levels',$this->getDonationLevelsListByProject(0));

		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());

		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());

		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());

		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());

		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);

		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);

		//Get Company Type Drop Down

		$contacttypedropdown =$this->contacttypedropdown($projectid);

		$this->set('contacttypedropdown',$contacttypedropdown);

		##country drop down

		$this->countrydroupdown();

		$this->statedroupdown();

		$this->set("templatetypedropdown",array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers'));

		$this->set('categorydropdown',$this->getCategoryDropdown());

		$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));

		$this->nonprofittypedropdown();

		$this->offertypetempdropdown();

		if($opr=='edit'){

			$this->set('recid',$recid);

		}

	}



	/*

		* Function name   : editcommtask()

	* Description     : This function used to add commom task

	* Created On      : 31-August-2012

	* Created By	  : Vidur

	*/

		

	function editcommtask($opt='', $recid){

		//Configure::write('debug', 2);

		##check admin session live or not

		$this->session_check_admin();

		//$projectid = $this->Session->read("sessionprojectid");

		$projectid ='0';

		//$project_name=$this->Session->read("projectwebsite_name_admin");

		$project_name='';

		$this->set('current_project_name',$project_name);



		##import project type model for processing

		App::import("Model", "CommunicationTask");

		$this->CommunicationTask =   & new CommunicationTask();

		##check empty data



		if(!empty($this->data)) {



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

					$this->redirect('/admins/editcommtask/'.$this->data['CommunicationTask']['id']);

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

				$this->redirect("/admins/editcommtask/$recid");

			}



			//$this->redirect('/admins/commtasklist');

		}



		$this->customtemplatelisting($projectid);

		$this->commenttypelisting($projectid);



		# set help condition



		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '14'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		if($recid!=''){

			$this->CommunicationTask->id = $recid;

			$this->set('taskrecid', $recid);

			$this->data = $this->CommunicationTask->read();

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

			$sel_category= $this->data['CommunicationTask']['category_id'];

			$sel_sub_category = $this->data['CommunicationTask']['sub_category_id'];

			$sel_nonprofittype = $this->data['CommunicationTask']['non_profit_type_id'];

			$sel_offer = $this->data['CommunicationTask']['offer_id'];

			$task_name= $this->data['CommunicationTask']['task_name'];

				

		}else{

			$sel_email_temp="";

			$sel_subscription_types="0";

			$sel_member_types="";

			$sel_donation_levels="";

			$sel_days_since="";

			$sel_country="254";

			$sel_state="";

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

			$task_name= '';

		}

		$this->set('sel_email_temp',$sel_email_temp);

		$this->set('sel_subscription_types',$sel_subscription_types);

		$this->set('sel_member_types',$sel_member_types);

		$this->set('sel_donation_levels',$sel_donation_levels);

		$this->set('sel_days_since',$sel_days_since);

		$this->set('sel_country',$sel_country);

		$this->set('sel_state',$sel_state);

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

		# set help condition

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

		//Set donation levles array

		$this->set('donation_levels',$this->getDonationLevelsListByProject($projectid));

		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());

		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());

		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());

		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());

		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);

		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);

		//Get Company Type Drop Down

		$contacttypedropdown =$this->contacttypedropdown($projectid);

		$this->set('contacttypedropdown',$contacttypedropdown);

		##country drop down

		$this->countrydroupdown();

		$this->statedroupdown();

		$this->set("templatetypedropdown",array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers'));

		$this->set('categorydropdown',$this->getCategoryDropdown());

		$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));

		$this->nonprofittypedropdown();

		$this->offertypetempdropdown();

	}



	/*

	 * Function name   : mailautoresponderlist()

	* Description : This function used to list all system auto reposnder Email Templates

	* Created On      : 17th SEP 2012

	*

	*/

	function mailresponderlist($respondertype="member"){

		

		##check admin session live or not

		$this->session_check_admin();

		$projectid = '1';

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

		

		App::import("Model", "EventMasterTemplate");

		$this->EventMasterTemplate =   & new EventMasterTemplate();

		

		##fetch data from EmailTemplate table for listing

		$field='';

		if(!empty($this->data['mailtasks']['searchkey'])){

			$searchkey=$this->data['mailtasks']['searchkey'];

			$varsearch='%'.$searchkey.'%';

			$condition = "EmailTemplate.project_id = '".$projectid."' AND EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='0'  and (EmailTemplate.is_event_temp='0' or is_event_temp='' or is_event_temp is NULL)";

		}

		else{

			$condition = "EmailTemplate.project_id =  '".$projectid."' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='0' and (EmailTemplate.is_event_temp='0' or is_event_temp='' or is_event_temp is NULL)";

		}

		$this->Pagination->sortByClass    = 'EmailTemplate'; 

		

		##initaite pagination

		$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition,$field);



		$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		

		##set EmailTemplate data in variable

		$this->set("emailtemplates",$emailtempdtlarr);

		

		# set help condition

		$this->set("hlpdata",$this->getHelpContent('10'));

		# set help condition



	}	//end mailresponderlist

	

	

	

   /*

	* Function name   : responders()

	* Description 	  : This function used to add/edit responders

	* Created On      : 03-Oct-2012

	*

	*/

	

	function responders($por=null, $templateid=''){

		##check admin session live or not

		$this->session_check_admin();

		$projectid ='1';

		##import EmailTemplate  model for processing

		App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();

		

		$this->set("templateid",$templateid);

		$this->set("adminemail",Admin::ADMIN_EMAIL);

		$current_domain= $_SERVER['HTTP_HOST'];

		##check empty data

		if(!empty($this->data)) {

			//$extra=$this->data['Company']['extra'];

			#set the posted data

			

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



				$condition = "email_template_name = '".$templname."' AND project_id =  '".$projectid."' AND  delete_status = '0' ";

				if($por=='edit'){

					$condition .= "AND id !='".$templateid."'";

				}

				

				##check already exists company name

				$ctdata = $this->EmailTemplate->find('all',array("conditions"=>$condition));



				$this->data['EmailTemplate']['content']=str_replace("../img","http://".$current_domain."/img",$this->data['EmailTemplate']['content']);



				if(!$ctdata){

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

							$this->redirect('/mailtasks/responders/edit/'.$templateid);

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

		if($templateid){

			$this->set("templateid",$templateid);

			$this->EmailTemplate->id = $templateid;

			$this->data = $this->EmailTemplate->read();

			$this->set("override_all", $this->data['EmailTemplate']['override_all']);

			$this->set("relationshiptype", $this->data['EmailTemplate']['relationship_type'] );

			if($this->data['EmailTemplate']['is_sytem']=='0'){

				$this->set("isreadonly",'0');

			}

		}

		# set help condition

		$this->set("hlpdata",$this->getHelpContent('22'));

		# set help condition

		

	}

	

	

	

	/*

	 * Function name   : editmailcontent()

	* Description : This function used to edit mail template contents of related projects

	* Created On      : 22-02-11 (09:27pm)

	*

	*/

	function editmailcontent($por=null,$templateid='',$extra=''){

		##check admin session live or not

		$this->session_check_admin();

		$projectid ='1';

		##import EmailTemplate  model for processing

		App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();

		$this->set("templateid",$templateid);



		$current_domain= $_SERVER['HTTP_HOST'];



		##check empty data

		if(!empty($this->data)) {

			//$extra=$this->data['Company']['extra'];

			#set the posted data

			$this->EmailTemplate->set($this->data);

			#check server side validation

			$errormsg = $this->EmailTemplate->invalidFields();

			$templname = $this->data['EmailTemplate']['email_template_name'];

			$templateid = $this->data['EmailTemplate']['id'];

			if(!$errormsg){



				$condition = "email_template_name = '".$templname."' AND project_id =  '".$projectid."' AND  delete_status = '0' AND id !='".$templateid."'";



				##check already exists company name

				$ctdata = $this->EmailTemplate->find('all',array("conditions"=>$condition));



				$this->data['EmailTemplate']['content']=str_replace("../img","http://".$current_domain."/img",$this->data['EmailTemplate']['content']);



				if(!$ctdata){

					if($this->EmailTemplate->Save($this->data['EmailTemplate'])){

						$this->Session->setFlash('Template updated Successfully.','default', array('class' => 'successmsg'));



						if(isset($this->data['Action']['redirectpage'])){

							$sessdata=$this->Session->read('newsortingby');

							$this->redirect('/'.$sessdata);

						}else{

							$this->redirect('/mailtasks/editmailcontent'/$tttid);

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

		}



		$this->EmailTemplate->id = $templateid;

		$this->data = $this->EmailTemplate->read();

		$this->set("isreadonly",'1');

		if($this->data['EmailTemplate']['is_sytem']=='0'){

			$this->set("isreadonly",'0');

		}

		if(isset($errormsg)){

			$this->data['EmailTemplate']['content']="";

		}



		# set help condition



		App::import("Model", "HelpContent");



		$this->HelpContent =  & new HelpContent();



		$condition = "HelpContent.id = '22'";



		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));



		$this->set("hlpdata",$hlpdata);



		$this->set("extra",$extra);

		# set help condition

	}



	function eventresponders(){

		##Configure::write('debug',3);

		##check admin session live or not

		$this->session_check_admin();

		$projectid = '1';

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



		App::import("Model", "EventMasterTemplate");

		$this->EventMasterTemplate =   & new EventMasterTemplate();



		$field='';



		if(!empty($this->data))

		{

			$searchkey=$this->data['mailtasks']['searchkey'];

			$varsearch='%'.$searchkey.'%';

			$condition = "EmailTemplate.project_id = '".$projectid."' AND EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0' and ( EmailTemplate.is_event_temp='1' or EmailTemplate.is_event_temp='2' or EmailTemplate.is_event_temp='3')";

		}

		else

		{	

			$condition = "EmailTemplate.project_id =  '".$projectid."' AND EmailTemplate.delete_status='0' AND ( EmailTemplate.is_event_temp='1' or EmailTemplate.is_event_temp='2' or EmailTemplate.is_event_temp='3' )";

		}



		$this->EmailTemplate->bindModel(array('belongsTo'=>array(

				'EventMasterTemplate'=>array(

						'foreignKey'=>false,

						'conditions'=>'EmailTemplate.is_event_temp = EventMasterTemplate.id'

				)

		)));



		$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination



		$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));



		list($order,$limit,$page) = $this->Pagination->init($condition,$field);





		$this->EmailTemplate->bindModel(array('belongsTo'=>array(

				'EventMasterTemplate'=>array(

						'foreignKey'=>false,

						'conditions'=>'EmailTemplate.is_event_temp = EventMasterTemplate.id'

				)

		)));



		if($order=="EmailTemplate.is_event_temp ASC")

		{

			$order="EventMasterTemplate.event_temp_name ASC";

		}

		if($order=="EmailTemplate.is_event_temp DESC")

		{

			$order="EventMasterTemplate.event_temp_name DESC";

		}



		$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		##set EmailTemplate data in variable

		$this->set("emailtemplates",$emailtempdtlarr);

		# set help condition



		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '10'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

	}

	 

	

	

	/**

	 * Function name : activetasklist()

	 * Description   : This function used get list of Active Task

	 * Created On    : 07 September 2012

	 * Created By    : Vidur

	 */

	 

	function activetasklist(){





		##check admin session live or not

		$this->session_check_admin();



		$projectid = '1';

		if(isset($_SERVER['QUERY_STRING']))

		{

			$this->Session->delete("newsortingby");

			$strloc=strpos($_SERVER['QUERY_STRING'],'=');

			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);

			$this->Session->write("newsortingby",$strdata);



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

		if(isset($this->data['Mailtasks']['searchkey']) && $this->data['Mailtasks']['searchkey']){

			$searchkeyword = $this->data['Mailtasks']['searchkey'];

			$condition = "CommunicationTask.delete_status = '0' and CommunicationTask.project_id='".$projectid."' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND (CommunicationTask.task_name LIKE '%".$searchkeyword."%' OR EmailTemplate.email_template_name LIKE '%".$searchkeyword."%')";

		}else{

			$condition = "CommunicationTask.delete_status = '0' and CommunicationTask.project_id='".$projectid."' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'";

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

		$this->set("hlpdata",$this->getHelpContent('13'));

		# set help condition







	}//end activetasklist()

	

	

	/*

	 * Function name   : addtask()

	* Description 	  : This function used to add task

	* Created On      : 24-09-12

	*/

	

	function addtask($opr=null,$recid=''){







		//Configure::write('debug', 2);

		##check admin session live or not



		$this->session_check_admin();

		$projectid = '1';

		$this->set("project_id",$projectid);

		##import communication Task model for processing

		App::import("Model", "CommunicationTask");

		$this->CommunicationTask =   & new CommunicationTask();



		##check empty data

		$current_domain= $_SERVER['HTTP_HOST'];

		$this->set("current_domain",$current_domain);



		$this->set("fromemail",Admin::ADMIN_EMAIL);

		if(!empty($this->data)) {

			$task_id=null;

			if(isset($this->data['CommunicationTask']['id'])){

				$task_id=$this->data['CommunicationTask']['id'];

			}



			$uniqueTaskName = $this->CommunicationTask->isUniqueTaskName($this->data['CommunicationTask']['task_name'],$projectid,$task_id );

			if ($uniqueTaskName == false) {

				$this->Session->setFlash('Communication Task  with same name already exists.','default',array('class' => 'msgTXt'));

			}else{

				// STEP : SAVE COMMUNICATION TASK

				$rec_id = $this->CommunicationTask->saveEmailTask($this->data['CommunicationTask'], $projectid, '0');



				if($rec_id > 0 ){

					$this->Session->setFlash('Communication Task added Successfully.','default', array('class' => 'successmsg'));



					if(isset($this->data['Action']['redirectpage'])){

						$this->redirect('/mailtasks/activetask');

					}else

					{

						$this->redirect('/mailtasks/addtask/'.$rec_id);

					}



				}else{

					$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));

				}

			}



		}



		$this->customtemplatelisting($projectid);

		$this->commenttypelisting($projectid);



		# set help condition

		$this->set("hlpdata",$this->getHelpContent('14'));

		$this->set("member_anniversary_annual","");

		

		if($recid!=''){

			$this->CommunicationTask->id = $recid;

			$this->set('taskrecid', $recid);

			$this->data = $this->CommunicationTask->read();

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



		}else{

			$sel_email_temp="";

			$sel_subscription_types="0";

			$sel_member_types="";

			$sel_donation_levels="";

			$sel_days_since="";

			$sel_country="254";

			$sel_state="";

			$sel_event="";

			$sel_event_rsvp="";

			$sel_comment_typeid="0";

			$sel_social_networks="";

			$sel_non_networks="";

			$sel_companytypeid="";

			$sel_contactypeid="";

			$sel_recur_pattern="Daily";

			$is_contactdisabled="0";

			$is_memebrdisabled="0";

		}



		$this->set('sel_email_temp',$sel_email_temp);

		$this->set('sel_subscription_types',$sel_subscription_types);

		$this->set('sel_member_types',$sel_member_types);

		$this->set('sel_donation_levels',$sel_donation_levels);

		$this->set('sel_days_since',$sel_days_since);

		$this->set('sel_country',$sel_country);

		$this->set('sel_state',$sel_state);

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



		# set help condition

		// Set memeber types array

		$this->set('member_types',$this->getMemberTypes());

		 



		// Set Subscription Type array

		$this->set('subscription_types',$this->getSubscriptionTypesArray());



		// Set Dasy Since  array

		$this->set('days_since',$this->getDaysSinceArray());



		// Set Event RSVP array

		$this->set('event_rsvp',$this->getEventRSVPArray());

		//Set Social Naetworks Array

		$this->set('social_networks',$this->getSocialNetworkArray());



		//Set Recur Pattern Array

		$this->set('recur_pattern',$this->getRecurPatternkArray());



		//Get Event Drop Down

		$this->getEventDropDownListByProjetcID($projectid);



		//Get Company Type Drop Down

		$this->companytypedropdown($projectid);



		//Get Company Type Drop Down

		$contacttypedropdown =$this->contacttypedropdown($projectid);

		$this->set('contacttypedropdown',$contacttypedropdown);



		##country drop down



		$this->countrydroupdown();



		$this->statedroupdown();



	}//addtask()



	

	function taskhistorylist(){



		##check admin session live or not

		$this->session_check_admin();

		$projectid = '1';

		$project_name='';

		$this->set('current_project_name',$project_name);



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

		if(isset($this->data['mailtasks']['searchkey']) && $this->data['mailtasks']['searchkey']){

			$searchkeyword = $this->data['mailtasks']['searchkey'];

			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR EmailTemplate.email_template_name LIKE '%".$searchkeyword."%')";

		}else{

			$condition = "CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";

		}

		



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

		$this->set("hlpdata",$this->getHelpContent('13'));

		# set help condition

	}

	

	

	/*

	 * Function name   : mailtemplatelist()

	* Description : This function used to list Email Templates of related project

	* Created On      : 22-02-11 (04:20pm)

	*

	*/

	function mailtemplatelist(){

	

		##check admin session live or not

		$this->session_check_admin();

		$projectid = '1';

		##import EmailTemplate  model for processing

		App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();

		##fetch data from EmailTemplate table for listing

		$field='';

	

		if(!empty($this->data['mailtasks']['searchkey']))

		{

			$searchkey = $this->data['mailtasks']['searchkey'];

			$varsearch = '%'.$searchkey.'%';

			$condition = "EmailTemplate.project_id = '$projectid' AND EmailTemplate.email_template_name like '$varsearch' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem != '0' ";

		}

		else

		{

			$condition = "EmailTemplate.project_id = '$projectid' AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem != '0' ";

		}

		$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination

		$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		##set EmailTemplate data in variable

		$this->set("emailtemplates",$emailtempdtlarr);

	}

	

	

	/*

	 * Function name   : addmailtemplate()

	* Description : This function used to add new mail template by super admin

	* Created On      : 24-12-2012

	*

	*/

	function addmailtemplate($templateid=0,$returnurl=""){



		##check admin session live or not

			

		$this->session_check_admin();

		$projectid = '1';

		##import EmailTemplate  model for processing

		App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();

		$this->set("adminemail", Admin::ADMIN_EMAIL);

		// if $returnurl is popup then its need to close else no need to close

		$this->set("closeit","no");



		##check empty data

		if(!empty($this->data)){

			#set the posted data

			//$this->pl($this->data);

			$this->EmailTemplate->set($this->data);

			#check server side validation

			$errormsg = $this->EmailTemplate->invalidFields();

			$templname = $this->data['EmailTemplate']['email_template_name'];

			

			if(isset($this->data['EmailTemplate']['id'])){

				$templateid = $this->data['EmailTemplate']['id'];

			}

			

			if($templateid==0)

			{

				//$this->data['EmailTemplate']['is_sytem'] = '1';

				//  Changed By Suman

				// Date 3 May 2011

					

				$this->data['EmailTemplate']['is_sytem'] = '1';

			}

			$this->data['EmailTemplate']['project_id'] = '1';

			$this->data['EmailTemplate']['is_inherit'] = '1';

			// $returnurl=$this->data['Admins']['returnurl'];

			if(!$errormsg){

				$templname = $this->data['EmailTemplate']['email_template_name'];

				if($templateid> 0)   {

					$condition = "email_template_name = '".$templname."' AND project_id = '".$projectid."' AND  delete_status = '0' AND id !='".$templateid."'";

				}else{

					$condition = "email_template_name = '".$templname."' AND project_id =  '".$projectid."' AND  delete_status = '0'";

				}

					

				##check already exists EmailTemplate name

				$ctdata = $this->EmailTemplate->find('all',array("conditions"=>$condition));

				if(!$ctdata){



					if($this->EmailTemplate->Save($this->data['EmailTemplate'])){



						$mailtempid = $this->EmailTemplate->getLastInsertId();



						if($returnurl!=""){

							$gotourl=str_replace("_id_", "/", $returnurl);

							$this->set("closeit","yes");

						}else{

							if(isset($this->data['EmailTemplate']['id'])){

								$this->Session->setFlash('Template updated Successfully.','default', array('class' => 'successmsg'));

							}else{

								$this->Session->setFlash('Template added Successfully.','default', array('class' => 'successmsg'));

							}

							

							if(isset($this->data['Action']['redirectpage'])){

								$sessdata=$this->Session->read('newsortingby');

								$this->redirect(array('controller' => 'mailtasks', 'action' =>'mailtemplatelist'));

							}else{

								$this->redirect(array('controller' => 'mailtasks', 'action' =>'mailtemplatelist', $mailtempid));

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

			$isreadonly=(!empty($this->data))?'1':'0';

			$this->set("isreadonly",$isreadonly);

			if(!empty($errormsg)){

				$this->data['EmailTemplate']['content']="";

			}

			$selectedtemplatetype = $this->data['EmailTemplate']['email_template_type'];

		}

		# set help condition

		$this->set("hlpdata",$this->getHelpContent('11'));



		$this->set("returnurl",$returnurl);



		$templatetypedropdown = array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers');

		$this->set("templatetypedropdown",$templatetypedropdown);

		$this->set("selectedtemplatetype",$selectedtemplatetype);





		# set help condition

	}//addmailtemplate();

	

	

	

   /*

    * Function name   : maildefaults()

	* Description : This function used to add new mail template by super admin

	* Created On      : 31-Oct-2012

	*

	*/

	function maildefaults(){

	

		##check admin session live or not

		$this->session_check_admin();

		$projectid = '1';

		##import EmailTemplate  model for processing

		App::import("Model", "Project");

		$this->Project =   & new Project();



		##check empty data

		if(!empty($this->data)){

			$errormsg = $this->Project->invalidFields();

			#set the posted data

			$this->Project->set($this->data['Project']);

			$this->data['Project']['id'] = $projectid;

			

			if($this->Project->updateAll(array('Project.fromemail' =>'"'.$this->data['Project']['fromemail'].'"' , 'Project.fromname'=>'"'.$this->data['Project']['fromname'].'"'), array('Project.id' => $projectid))){

				$this->Session->setFlash('Template updated Successfully.','default', array('class' => 'successmsg'));

			}else{

				$this->Session->setFlash('Error in processing. Please try again.','default',array('class' => 'msgTXt'));

			}

			

			$this->redirect(array('controller' => 'mailtasks', 'action' =>'maildefaults'));

		}

		

		if($projectid=='1'){

			$this->Project->id = $projectid;

			$this->data = $this->Project->read();

		}



		# set help condition

		$this->set("hlpdata",$this->getHelpContent('11'));

		# set help condition

		

	}//maildefaults();

	

	

	

	/**

	 * function    : mail_footer

	 * params      : None.

	 * Created On  : Nov-01-2012

	 **/

	function mail_footer(){

	



		$this->session_check_admin();

		$projectid = '1';

		

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

						$this->redirect('/mailtasks/mail_footer');

					}else

					{

						$this->redirect('/mailtasks/mail_footer');

					}

				}

				else

				{

					$this->Session->setFlash("Please provide Mail Footer",'default',array('class' => 'msgTXt'));

				}

			}

		}

	

		# set help condition

		$this->set("hlpdata",$this->getHelpContent('11'));

				# set help condition

	} //End mail footer function

	

	

	function opt_out_history(){



		##check admin session live or not

		$this->session_check_admin();

		

		$projectid = '1';

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

		App::import("Model", "Holder");

		$this->Holder =   & new Holder();



		$this->Holder->bindModel(array('belongsTo'=>array(

				'MemberType'=>array(

						'foreignKey'=>'member_type'

		))));

		

		##fetch data from project type table for listing

		$field='';

		##checking search key

		if(isset($this->data['mailtasks']['searchkey']) && $this->data['mailtasks']['searchkey']){

			$searchkeyword = $this->data['mailtasks']['searchkey'];

			$condition = "Holder.delete_status = '0' AND (MemberType.member_type  LIKE '%".$searchkeyword."%' OR Holder.firstname LIKE '%".$searchkeyword."%' OR Holder.lastnameshow LIKE '%".$searchkeyword."%')";

		}else{

			$condition = "Holder.delete_status = '0' ";

		}

		

		$condition .= " AND Holder.dateoptout != '0000-00-00' ";



		$this->Pagination->sortByClass    = 'Holder'; ##initaite pagination

		$this->Pagination->total= count($this->Holder->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$this->Holder->bindModel(array('belongsTo'=>array(

				'MemberType'=>array(

						'foreignKey'=>'member_type'

		))));

		$optoutdata = $this->Holder->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		 

		##set project type data in variable

		$this->set("optoutdata",$optoutdata);



		# set help condition

		$this->set("hlpdata",$this->getHelpContent('13'));

		# set help condition

	}

	

}

?>