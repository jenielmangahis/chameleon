<?php
/*
 *created by	   : Puneet
*Project		   :-  Image coin website
* Controller Name  :-  setups_contoller.php
* Created  On      :-  20-04-12
*/
class LinksController extends AppController
{

	var $name = 'links';
	//var $uses = 'Setup';
	var $layout = 'new_admin_layout';
	var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
	var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
	var $uses     = array('Admin', 'Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term','CommunicationTask','EmailTemplate' ,'Link','LinkAddress','Placement','Group','Video','History','HistoryClick');

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




	/*
		* Function name  : addmailtask()
	* Description 	  : This function used to add commom task
	* Created On      : 31-Aug-2012
	* Created By	  : Vidur
	*
	*/

	function addlink(){
			
		$this->session_check_admin();
		$projectid = '1';
	App::import("Model", "FormType");
    $this->FormType =  & new FormType();   
	$formtypeArray = $this->FormType->find('list'   , array('fields' => array('FormType.id', 'FormType.formtype_name')));
	$this->set("formtypedata",$formtypeArray);




	App::import("Model", "Group");
    $this->Group =  & new Group();   
	$groupArray = $this->Group->find('list'   , array('fields' => array('Group.id', 'Group.groupname')));
	$this->set("groupdata",$groupArray);


	App::import("Model", "LinkAddress");
    $this->LinkAddress =  & new LinkAddress();   
	$addressArray = $this->LinkAddress->find('list'   , array('fields' => array('LinkAddress.id', 'LinkAddress.link_address')));
	$this->set("addressdata",$addressArray);
	
	App::import("Model", "Placement");
    $this->Placement =  & new Placement();   
	$placementArray = $this->Placement->find('list'   , array('fields' => array('Placement.id', 'Placement.place_name')));
	$this->set("placementdata",$placementArray);	

	
		   if (!empty($this->data)) {
            $this->Link->create();
            if ($this->Link->save($this->data)) {
			
                $this->Session->setFlash(__('The Link has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('controller'=>'links','action'=>'activelinklist'));
            } else {
                $this->Session->setFlash(__('The Link could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
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
		$this->set('categorydropdown',$this->getCategoryDropdown());
		$this->set('subcategorydropdown',$this->getSubCategoryDropdown($sel_category));
		$this->nonprofittypedropdown();
		$this->offertypetempdropdown();

		if($this->Session->check('InsertGroupId'))
	{
		$this->set('InsertGroupId',$this->Session->read('InsertGroupId'));
		$this->Session->delete('InsertGroupId');
	}
	if($this->Session->check('InsertPlacementId'))
	{
		$this->set('InsertPlacementId',$this->Session->read('InsertPlacementId'));
		$this->Session->delete('InsertPlacementId');
	}
	if($this->Session->check('InsertLinkAddressId'))
	{
		$this->set('InsertLinkAddressId',$this->Session->read('InsertLinkAddressId'));
		$this->Session->delete('InsertLinkAddressId');
	}
	if($this->Session->check('InsertRelatedFormId'))
	{
		$this->set('InsertRelatedFormId',$this->Session->read('InsertRelatedFormId'));
		$this->Session->delete('InsertRelatedFormId');
	}
	}
	
	
	function editlink($id = null){
			
		$this->session_check_admin();
		$projectid = '1';
	App::import("Model", "FormType");
	$this->FormType =  & new FormType();   
	$formtypeArray = $this->FormType->find('list'   , array('fields' => array('FormType.id', 'FormType.formtype_name')));
	$this->set("formtypedata",$formtypeArray);
		   

	App::import("Model", "Group");
    $this->Group =  & new Group();   
	$groupArray = $this->Group->find('list'   , array('fields' => array('Group.id', 'Group.groupname')));
	$this->set("groupdata",$groupArray);


	App::import("Model", "LinkAddress");
    $this->LinkAddress =  & new LinkAddress();   
	$addressArray = $this->LinkAddress->find('list'   , array('fields' => array('LinkAddress.id', 'LinkAddress.link_address')));
	$this->set("addressdata",$addressArray);
	
	App::import("Model", "Placement");
    $this->Placement =  & new Placement();   
	$placementArray = $this->Placement->find('list'   , array('fields' => array('Placement.id', 'Placement.place_name')));
	$this->set("placementdata",$placementArray);
	if($this->Session->check('InsertGroupId'))
	{
		$this->set('InsertGroupId',$this->Session->read('InsertGroupId'));
		$this->Session->delete('InsertGroupId');
	}
	if($this->Session->check('InsertPlacementId'))
	{
		$this->set('InsertPlacementId',$this->Session->read('InsertPlacementId'));
		$this->Session->delete('InsertPlacementId');
	}
	if($this->Session->check('InsertLinkAddressId'))
	{
		$this->set('InsertLinkAddressId',$this->Session->read('InsertLinkAddressId'));
		$this->Session->delete('InsertLinkAddressId');
	}
	if($this->Session->check('InsertRelatedFormId'))
	{
		$this->set('InsertRelatedFormId',$this->Session->read('InsertRelatedFormId'));
		$this->Session->delete('InsertRelatedFormId');
	}	
			   
		   
		   if (!empty($this->data)) {
            $this->Link->id = $id;
            if ($this->Link->save($this->data)) {
			
                $this->Session->setFlash(__('The Link has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('controller'=>'links','action'=>'activelinklist'));
            } else {
                $this->Session->setFlash(__('The Link could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
        }
		
		if(empty($this->data))
		{
			$this->data = $this->Link->find('first',array('conditions' => array('Link.id' => $id)));
			$this->set('oldData',$this->data);
		}
		$this->set('id',$id);
		

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
		##country drop down
		$this->countrydroupdown();
		$this->statedroupdown();

		$this->nonprofittypedropdown();
		$this->offertypetempdropdown();
		
	}
	
	function add_address($redirect = null){
		$projectid = '1';
		if (!empty($this->data)) {
            $this->LinkAddress->create();
            if ($this->LinkAddress->save($this->data)) {
                if($redirect == null)
                {	
                	$this->redirect(array('controller'=>'links','action'=>'addresslink'));
                	$this->Session->setFlash(__('The Address has been saved', true), 'default', array('class' => 'success'));
                }
                else
                {
                	$editLinkId = $redirect;
                	$editLinkId = str_replace("@","", $editLinkId);

                	$lId = $this->LinkAddress->getLastInsertID();
                	$this->Session->write('InsertLinkAddressId',$lId);
                		
                	if($editLinkId=="")
                	{	
                		$this->redirect(array('controller'=>'links','action'=>'addlink'));                		
                	}
                	else
                	{
                		$this->redirect(array('controller'=>'links','action'=>'editlink',$editLinkId));
                	}	
                }	
            } else {
                $this->Session->setFlash(__('The Address could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
        }
        $this->set('redirect',$redirect);
	 }
	 
	 function add_placement($redirect = null){
	
	



		$projectid = '1';
		if (!empty($this->data)) {
            $this->Placement->create();
            $this->data['Placement']['enddate'] = date('Y-m-d');
            if ($this->Placement->save($this->data)) {
            	 if($redirect == null)
                {	
                	$this->Session->setFlash(__('The Placement has been saved', true), 'default', array('class' => 'success'));
                	$this->redirect(array('controller'=>'links','action'=>'palcementlink'));
                }
                else
                {
                	$editLinkId = $redirect;
                	$editLinkId = str_replace("@","", $editLinkId);
                	$lId = $this->Placement->getLastInsertID();
                	$this->Session->write('InsertPlacementId',$lId);
                		
                	if($editLinkId=="")
                	{	
                		$this->redirect(array('controller'=>'links','action'=>'addlink'));                		
                	}
                	else
                	{
                		$this->redirect(array('controller'=>'links','action'=>'editlink',$editLinkId));
                	}	
                } 	

            } else {
                $this->Session->setFlash(__('The Placement could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
        }
         $this->set('redirect',$redirect);
	 }
	 
	 function add_group($redirect = null){
		$projectid = '1';
		if (!empty($this->data)) {
            $this->Group->create();
            if ($this->Group->save($this->data)) {
            	if($redirect == null)
                {
                	$this->Session->setFlash(__('The Group has been saved', true), 'default', array('class' => 'success'));
                	$this->redirect(array('controller'=>'links','action'=>'groupslink'));
                }
                else
                {
                	$editLinkId = $redirect;
                	$editLinkId = str_replace("@","", $editLinkId);
                	$lId = $this->Group->getLastInsertID();
                	$this->Session->write('InsertGroupId',$lId);

                	if($editLinkId=="")
                	{	
                		$this->redirect(array('controller'=>'links','action'=>'addlink'));                		
                	}
                	else
                	{
                		$this->redirect(array('controller'=>'links','action'=>'editlink',$editLinkId));
                	}	
                } 
            } else {
                $this->Session->setFlash(__('The Group could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
        }
        $this->set('redirect',$redirect);
	 }
	 function add_video(){
		$projectid = '1';
		if (!empty($this->data)) {
            $this->Video->create();
			if(isset($this->data['Video']['video_file']['name'])&&$this->data['Video']['video_file']['name']!="")
        	{
				if($this->data['Video']['video_file']['type']=="video/x-ms-wmv"||$this->data['Video']['video_file']['type']=="video/mp4")
        		{
					$fileName = date('Y-m-d-His').$this->data['Video']['video_file']['name'];
            		$full_url = WWW_ROOT.'video/'.$fileName;
					move_uploaded_file($this->data['Video']['video_file']['tmp_name'], $full_url);
            		$this->data['Video']['video_file'] =   $fileName;
					if ($this->Video->save($this->data)) {
                		$this->Session->setFlash(__('The Video has been saved', true), 'default', array('class' => 'success'));
                		$this->redirect(array('controller'=>'links','action'=>'videoslink'));
            		} else {
                		$this->Session->setFlash(__('The Video could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            		}
				}
				else
				{
					$this->Session->setFlash(__('The Video could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
				}
			}
			else
			{
			    $this->Session->setFlash(__('The Video could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
			}
           
        }
	 }
	 function edit_address($id = null){
		$projectid = '1';
		if (!empty($this->data)) {
            $this->LinkAddress->id = $id;
            if ($this->LinkAddress->save($this->data)) {
                $this->Session->setFlash(__('The Address has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('controller'=>'links','action'=>'addresslink'));
            } else {
                $this->Session->setFlash(__('The Address could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
        }
		if(empty($this->data))
		{
			$this->data = $this->LinkAddress->find('first',array('conditions' => array('LinkAddress.id' => $id)));
		}
		$this->set('id',$id);
	 }
	 
	 function edit_placement($id = null){
		$projectid = '1';
		if (!empty($this->data)) {
            $this->Placement->id = $id;
            $this->data['Placement']['enddate'] = date('Y-m-d');
            if ($this->Placement->save($this->data)) {
                $this->Session->setFlash(__('The Placement has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('controller'=>'links','action'=>'palcementlink'));
            } else {
                $this->Session->setFlash(__('The Placement could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
        }
		if(empty($this->data))
		{
			$this->data = $this->Placement->find('first',array('conditions' => array('Placement.id' => $id)));
			$this->set('oldData',$this->data);
		}
		$this->set('id',$id);
	 }
	 
	 function edit_group($id = null){
		$projectid = '1';
		if (!empty($this->data)) {
            $this->Group->id = $id;
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('The Group has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('controller'=>'links','action'=>'groupslink'));
            } else {
                $this->Session->setFlash(__('The Group could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            }
        }
		if(empty($this->data))
		{
			$this->data = $this->Group->find('first',array('conditions' => array('Group.id' => $id)));
		}
		$this->set('id',$id);
	 }
	 function edit_video($id = null){
		$projectid = '1';
		if (!empty($this->data)) {
           
		   	$this->Video->id = $id;
			if(isset($this->data['Video']['video_file']['name'])&&$this->data['Video']['video_file']['name']!="")
        	{
				if($this->data['Video']['video_file']['type']=="video/x-ms-wmv"||$this->data['Video']['video_file']['type']=="video/mp4")
        		{
					$data = $this->Video->find('first',array('conditions' => array('Video.id' => $id)));
					$pathVideo = WWW_ROOT.'video/'.$data['Video']['video_file'];
					$fileName = date('Y-m-d-His').$this->data['Video']['video_file']['name'];
            		$full_url = WWW_ROOT.'video/'.$fileName;
					move_uploaded_file($this->data['Video']['video_file']['tmp_name'], $full_url);
					if(file_exists($pathVideo))
					{
            			unlink($pathVideo);
					}
					$this->data['Video']['video_file'] =   $fileName;
					if ($this->Video->save($this->data)) {
						$this->Session->setFlash(__('The Video has been saved', true), 'default', array('class' => 'success'));
                		$this->redirect(array('controller'=>'links','action'=>'videoslink'));
            		} else {
                		$this->Session->setFlash(__('The Video could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            		}
				}
				else
				{
					$this->Session->setFlash(__('The Video could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
				}
			}
			else if(isset($this->data['Video']['video_file']['name'])&&$this->data['Video']['video_file']['name']=="")
			{
					$data = $this->Video->find('first',array('conditions' => array('Video.id' => $id)));
					$this->data['Video']['video_file'] =   $data['Video']['video_file'];
					if ($this->Video->save($this->data)) {
                		$this->Session->setFlash(__('The Video has been saved', true), 'default', array('class' => 'success'));
                		$this->redirect(array('controller'=>'links','action'=>'videoslink'));
            		} else {
                		$this->Session->setFlash(__('The Video could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
            		}
			}
			else
			{
			    $this->Session->setFlash(__('The Video could not be saved. Please, fill the requir fields.', true), 'default', array('class' => 'error'));
			}
           
        }
		if(empty($this->data))
		{
			$this->data = $this->Video->find('first',array('conditions' => array('Video.id' => $id)));
			$this->set('oldData',$this->data);
		}
		$this->set('id',$id);
	 }
		function addresslink(){
		$this->session_check_admin();
		$projectid = '1';
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}
		App::import("Model", "CommunicationTask");
		$this->CommunicationTask =   & new CommunicationTask();
		$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
				))));
		$field='';
		if(isset($this->data['LinkAddress']['searchkey']) && $this->data['LinkAddress']['searchkey']){
			$searchkeyword = $this->data['LinkAddress']['searchkey'];
			$condition = "LinkAddress.status = 'a' and LinkAddress.project_id='".$projectid."' AND (LinkAddress.link_address LIKE '%".$searchkeyword."%' OR LinkAddress.description LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "LinkAddress.status = 'a' and LinkAddress.project_id='".$projectid."'";
		}
		$this->Pagination->sortByClass    = 'LinkAddress'; ##initaite pagination
		$this->Pagination->total= count($this->LinkAddress->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$taskdata = $this->LinkAddress->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("taskdata",$taskdata);
		$this->set("hlpdata",$this->getHelpContent('13'));
		}
	
		function palcementlink(){
		
		
		$this->session_check_admin();
		$projectid = '1';
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}
		App::import("Model", "CommunicationTask");
		$this->CommunicationTask =   & new CommunicationTask();
		$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
				))));
		$field='';
		if(isset($this->data['Placement']['searchkey']) && $this->data['LinkAddress']['searchkey']){
			$searchkeyword = $this->data['Placement']['searchkey'];
			$condition = "Placement.status = 'a' and Placement.project_id='".$projectid."' AND (Placement.placementtype LIKE '%".$searchkeyword."%' OR Placement.place_name LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "Placement.status = 'a' and Placement.project_id='".$projectid."'";
		}
		$this->Pagination->sortByClass    = 'Placement'; ##initaite pagination
		$this->Pagination->total= count($this->Placement->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$taskdata = $this->Placement->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("taskdata",$taskdata);
		$this->set("hlpdata",$this->getHelpContent('13'));
		
		}
		
		function groupslink(){
		
		
		$this->session_check_admin();
		$projectid = '1';
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}
		App::import("Model", "CommunicationTask");
		$this->CommunicationTask =   & new CommunicationTask();
		$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
				))));
		$field='';
		if(isset($this->data['Group']['searchkey']) && $this->data['Group']['searchkey']){
			$searchkeyword = $this->data['Group']['searchkey'];
			$condition = "Group.status = 'a' and Group.project_id='".$projectid."' AND (Group.groupname LIKE '%".$searchkeyword."%' OR Group.description LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "Group.status = 'a' and Group.project_id='".$projectid."'";
		}
		$this->Pagination->sortByClass    = 'Group'; ##initaite pagination
		$this->Pagination->total= count($this->Group->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$taskdata = $this->Group->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("taskdata",$taskdata);
		$this->set("hlpdata",$this->getHelpContent('13'));
		
		}
		

 public function videoslink(){
		$this->session_check_admin();
		$projectid = '1';
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}
		$field='';
		if(isset($this->data['Video']['Video']) && $this->data['Video']['searchkey']){
			$searchkeyword = $this->data['Video']['searchkey'];
			$condition = "Video.status = 'a' and Video.project_id='".$projectid."' AND (Video.video_name LIKE '%".$searchkeyword."%' OR Video.description LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "Video.status = 'a' and Video.project_id='".$projectid."'";
		}
		$this->Pagination->sortByClass    = 'Video'; ##initaite pagination
		$this->Pagination->total= count($this->Video->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$taskdata = $this->Video->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("taskdata",$taskdata);
		$this->set("hlpdata",$this->getHelpContent('13'));
		
		}

	
	
	
	
	/**
	 * Function name : activelinklist()
	 * Description   : This function used get list of Active Task
	 * Created On    : 24 Dec 2013
	 * Created By    : Vidur
	 */
	 
	function activelinklist(){


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
			$condition = "Link.status = 'a' and Link.project_id='".$projectid."' AND (Link.links_name LIKE '%".$searchkeyword."%' OR Link.redirect_link LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "Link.status = 'a' and Link.project_id='".$projectid."'";
		}

		// $condition = "CommunicationTask.delete_status = '0' and CommunicationTask.project_id='".$projectid."'";
		$this->Pagination->sortByClass    = 'Link'; ##initaite pagination

		$this->Pagination->total= count($this->Link->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		/*$this->CommunicationTask->bindModel(array('belongsTo'=>array(
				'EmailTemplate'=>array(
						'foreignKey'=>false,
						'conditions'=>'EmailTemplate.id = CommunicationTask.email_template_id'
		))));
		*/
		
		$taskdata = $this->Link->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		##set project type data in variable
		$this->set("taskdata",$taskdata);

		# set help condition
		$this->set("hlpdata",$this->getHelpContent('13'));
		# set help condition



	}//end activetasklist()
	
	
	public function inactivelinklist(){
		
		$this->session_check_admin();
		$projectid = '1';
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);

		}
		$field='';
		if(isset($this->data['Mailtasks']['searchkey']) && $this->data['Mailtasks']['searchkey']){
			$searchkeyword = $this->data['Mailtasks']['searchkey'];
			$condition = "Link.status = 'd' and Link.project_id='".$projectid."' AND (Link.links_name LIKE '%".$searchkeyword."%' OR Link.redirect_link LIKE '%".$searchkeyword."%')";
		}else{
			$condition = "Link.status = 'd' and Link.project_id='".$projectid."'";
		}
		$this->Pagination->sortByClass    = 'Link'; ##initaite pagination

		$this->Pagination->total= count($this->Link->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$taskdata = $this->Link->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		$this->set("taskdata",$taskdata);
		$this->set("hlpdata",$this->getHelpContent('13'));
	
	}
	
 	public function activelink_delete($id = null,$redirect = null){ 
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for record', true), 'default', array('class' => 'error'));
            $this->redirect(array('controller'=>'links','action' => 'activelinklist'));
        }
    
		$ids = explode("*", $id);
		if(count($ids))
		{
			for($i =0 ;$i<count($ids);$i++)
			{
				if ($ids[$i]!='')
				{
					$this->Link->delete($ids[$i]);
				}
			}
		}
		
		$this->Session->setFlash(__('Record deleted', true), 'default', array('class' => 'success'));
		if($redirect==null)
		{
            $this->redirect(array('controller'=>'links','action' => 'activelinklist'));
		}
		else
		{
			$this->redirect(array('controller'=>'links','action' => 'inactivelinklist'));
		}
 	}
	
	
	public function addresslink_delete($id = null){
	
 		if (!$id) 
		{
            $this->Session->setFlash(__('Invalid id for record', true), 'default', array('class' => 'error'));
            $this->redirect(array('controller'=>'links','action' => 'addresslink'));
        }
		
		$ids = explode("*", $id);
		if(count($ids))
		{
			for($i =0 ;$i<count($ids);$i++)
			{
				if ($ids[$i]!='')
				{
					$this->LinkAddress->delete($ids[$i]);
				}
			}
		}
		$this->Session->setFlash(__('Record deleted', true), 'default', array('class' => 'success'));
        $this->redirect(array('controller'=>'links','action' => 'addresslink'));
	}

	
	

	public function palcementlink_delete($id = null){
	
	 		if (!$id) {
				$this->Session->setFlash(__('Invalid id for record', true), 'default', array('class' => 'error'));
				$this->redirect(array('controller'=>'links','action' => 'palcementlink'));
			}
			
			$ids = explode("*", $id);
			if(count($ids))
			{
				for($i =0 ;$i<count($ids);$i++)
				{
					
					if ($ids[$i]!='')
					{
						$this->Placement->delete($ids[$i]);
					}
				}
			}
			
			$this->Session->setFlash(__('Record deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('controller'=>'links','action' => 'palcementlink'));
	}



	public function groupslink_delete($id = null){
	
	 		if (!$id) {
				$this->Session->setFlash(__('Invalid id for record', true), 'default', array('class' => 'error'));
				$this->redirect(array('controller'=>'links','action' => 'groupslink'));
			}
			$ids = explode("*", $id);
			if(count($ids))
			{
				for($i =0 ;$i<count($ids);$i++)
				{
					
					if ($ids[$i]!='')
					{
						$this->Group->delete($ids[$i]);
					}
				}
			}
			
			$this->Session->setFlash(__('Record deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('controller'=>'links','action' => 'groupslink'));
	}

	
	
	public function videoslink_delete($id = null){
	 		if (!$id) 
			{
				$this->Session->setFlash(__('Invalid id for record', true), 'default', array('class' => 'error'));
				$this->redirect(array('controller'=>'links','action' => 'videoslink'));
			}
			
			$ids = explode("*", $id);
			if(count($ids))
			{
				for($i =0 ;$i<count($ids);$i++)
				{
					
					if ($ids[$i]!='')
					{
						$data = $this->Video->find('first',array('conditions' => array('Video.id' => $ids[$i])));
						$pathVideo = WWW_ROOT.'video/'.$data['Video']['video_file'];
						if(file_exists($pathVideo))
						{
							unlink($pathVideo);
						}
						$this->Video->delete($ids[$i]);
					}
				}
			}
			
			$this->Session->setFlash(__('Record deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('controller'=>'links','action' => 'videoslink'));
	}

	public function add_history($links_name = "",$type =""){

		$client  = @$_SERVER['HTTP_CLIENT_IP'];
    	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    	$remote  = @$_SERVER['REMOTE_ADDR'];
    	$result  = array('country'=>'', 'city'=>'');
    	if(filter_var($client, FILTER_VALIDATE_IP)){
        	$ip = $client;
    	}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        	$ip = $forward;
    	}else{
        	$ip = $remote;
    	}
    	$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
    	if($ip_data && $ip_data->geoplugin_countryName != null){
        	$result['country'] = $ip_data->geoplugin_countryCode;
    	}
    	$country  	= $result['country'];
		$url = "";
		if($type == "email")
		{
			$url = "By Email";
		}	
		else if($type == "pdf")
		{
			$url = "By Pdf";	
		}
		else if($type == "other")
		{
			$url = "By Other";	
		}

    	if(isset($_REQUEST['passUrl']))
    	{	
			$url = $_REQUEST['passUrl'];
		}
		$this->data['History']['links_name'] = $links_name ;
		$this->data['History']['ip'] = $ip ;
		$this->data['History']['country'] = $country ;
		$this->data['History']['url'] = $url ;
		$todayDate = date('Y-m-d');	
		$previousRecord = $this->History->find('all',array('conditions' => array('History.links_name' => $links_name,'History.ip' => $ip,'DATE(History.created)' => $todayDate)));
		if(!count($previousRecord))
		{	
			$this->History->create();
        	if ($this->History->save($this->data)) {  
        		$this->data['HistoryClick']['clicks'] = 1;
        		$this->data['HistoryClick']['history_id'] = 	$this->History->getLastInsertId();
        		$this->HistoryClick->create();
        		if ($this->HistoryClick->save($this->data)) {
        			echo "added";	
        		}
        		else
        		{
        			echo "not added";
        		}
        	}
        }
        else
        {
        	//HistoryClick
        	$lastHistoryCount = $this->HistoryClick->find('first',array('conditions' => array('HistoryClick.history_id' => $previousRecord[0]['History']['id'])));        	
        	$this->data['HistoryClick']['clicks'] = $lastHistoryCount['HistoryClick']['clicks']+1;
        	$this->data['HistoryClick']['history_id'] = $lastHistoryCount['HistoryClick']['history_id'];
			
			$this->HistoryClick->id =$lastHistoryCount['HistoryClick']['id'];
        	if ($this->HistoryClick->save($this->data)) {
        		echo "updated";	
        	}
        	else
        	{
        		echo "not updated";
        	}
        }	

        if($type == "pdf" || $type == "other")
		{
			$links = $this->Link->find('first',array('conditions' => array('Link.visual_text' => $links_name)));
			$redirect = "";
			if(count($links)&&isset($links['Link']))
        	{ 
          		$checkRedirect = $links['Link']['redirect_link'];
          		$redirect = $checkRedirect; 
          		if($checkRedirect=='')
          		{
            		$linkAddress = $links['Link']['link_address'];
            		$LinkAddress = $this->LinkAddress->find('first',array('conditions' => array('LinkAddress.id' => $linkAddress)));
            		$redirect = $LinkAddress['LinkAddress']['link_address'];
          		}
        	} 
        	if($redirect!='')
        	{	
				$this->redirect($redirect);
			}
		}
		
        die();
	}
	


public function history(){
		$this->session_check_admin();
		$projectid = '1';
		if(isset($_SERVER['QUERY_STRING']))
		{
			$this->Session->delete("newsortingby");
			$strloc=strpos($_SERVER['QUERY_STRING'],'=');
			$strdata=substr($_SERVER['QUERY_STRING'],$strloc+1);
			$this->Session->write("newsortingby",$strdata);
		}
		$field='';
		if( $this->data['Links']['searchkey']){
			$searchkeyword = $this->data['Links']['searchkey'];
			$condition = "History.links_name LIKE '%".$searchkeyword."%'";
		}else{
			$condition = "";
		}
		$this->Pagination->sortByClass    = 'History'; ##initaite pagination
		$this->Pagination->total= count($this->History->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);
		$taskdata = $this->History->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
		
		$this->set("taskdata",$taskdata);
		$this->set("hlpdata",$this->getHelpContent('13'));

}

public function historyclick(){
		$this->session_check_admin();
		$projectid = '1';
		
		$condition = "";
		$this->Pagination->sortByClass    = 'History'; ##initaite pagination
		$this->Pagination->total= count($this->History->find('all',array("conditions"=>$condition)));
		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$taskdata = $this->History->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page,  'group'=>array("DATE_FORMAT(created, '%Y-%m-%d')","ip","links_name")));
		$this->set("taskdata",$taskdata);
		$this->set("hlpdata",$this->getHelpContent('13'));

}
	public function history_delete($id = null){
	 		if (!$id) 
			{
				$this->Session->setFlash(__('Invalid id for record', true), 'default', array('class' => 'error'));
				$this->redirect(array('controller'=>'links','action' => 'history'));
			}
			
			$ids = explode("*", $id);
			if(count($ids))
			{
				for($i =0 ;$i<count($ids);$i++)
				{
					
					if ($ids[$i]!='')
					{
						$this->History->delete($ids[$i]);
					}
				}
			}
			
			$this->Session->setFlash(__('Record deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('controller'=>'links','action' => 'history'));
	}


	// Add Placement type  function 

	



}
?>