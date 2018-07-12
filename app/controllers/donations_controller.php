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
	var $uses     = array('Admin', 'Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter', 'DonationType');

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

/*
	function addtype(){
			
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
	function edittype($id = null){
			
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
*/

		

	
	
	
	
	

}
?>