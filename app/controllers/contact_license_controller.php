<?php

	/* Project		   :-  Image coin website

    * Controller Name :-  contacts_contoller.php

    * Created  On     :-  17-05-12             

	* Created By	  :- Vidhur

    */

	class ContactLicenseController extends AppController 

    {

		var $name = 'contact_license';
        var $layout = 'new_admin_layout';
        var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
        var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
        var $uses     = array('Route','Point','ProductType','PricingType','CoinsHolder','Sponsor','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','RecurringEvent','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term');

        function pagenotavailable(){
            $this->layout = "";
        }

		function beforeFilter() {
             /*permission code start*/  
             if($this->Session->check("UserLoginDetails")){
                $admin =  $this->Session->read("UserLoginDetails");
                $permissions = array();
                $subpermissions = array();
                if(!empty($admin)){
                    $permissions    = $this->check_user_permissions($admin['Admin']['user_type'],'yes');
                    $subpermissions = $this->check_user_permissions($admin['Admin']['user_type'],'no');
                }

                if(!empty($permissions)){
                    $this->set('hideMenuPermission',$permissions); 
                }

                if(!empty($subpermissions)){
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
        * Function name   : contact license list() 
        * Description : This function used to list contacts licenses
        * Created On      : 02-19-2019
        * Created By	  : Jeniel Mangahis
        */ 

        function license_list( $holder_id ){
            App::import("Model", "ContactLicense");
            App::import("Model", "Holder");
            $this->ContactLicense =   & new ContactLicense();
            $this->Holder = & new Holder();
            $holder = $this->Holder->find('first', array('conditions' => 'Holder.id = ' . $holder_id));
            $this->ContactLicense->bindModel(array('belongsTo'=>array(
            'Holder'=>array(
            'foreignKey'=>false,
            'conditions'=>'Holder.id = ContactLicense.holder_id'
            )
            )));
            $condition = 'ContactLicense.holder_id = ' . $holder_id;
            $contactLicenses = $this->ContactLicense->find('all',array('conditions' => $condition));
            $this->set('holder', $holder);
            $this->set('page_url',"contactlicense");
            $this->set("hlpdata",$this->getHelpContent(3));  
            $this->Pagination->sortByClass = 'ContactLicense';
            $this->Pagination->total = count($contactLicenses);
            $this->set('holder_id', $holder_id);
            $this->set("contactLicenses",$contactLicenses);
        }

        /*
        * Function name   : add contact license () 
        * Description : for adding contact license
        * Created On      : 02-19-2019
        * Created By      : Jeniel Mangahis
        */ 

        function addlicense( $holder_id ){
            App::import("Model", "ContactLicense");
            $this->ContactLicense =   & new ContactLicense();

            if(!empty($this->data)) {
                $this->ContactLicense->Save($this->data['ContactLicense']);
                $this->Session->setFlash('Contact License added successfully.','default', array('class' => 'successmsg'));
                $this->redirect('/contact_license/license_list/' . $this->data['ContactLicense']['holder_id']);
            }

            $license_status = array('NA' => 'NA', 'Pending' => 'Pending', 'Registered' => 'Registered', 'Licensed' => 'Licensed');
            $license_types  = array('National Exempt' => 'National Exempt', 'Multi-State-Exempt' => 'Multi-State-Exempt', 'Multi-State-Tested' => 'Multi-State-Tested', 'State-Tested' => 'State-Tested');
            $testing_types  = array('Multi-State-Test' => 'Multi-State-Test', 'State-Specific-Test' => 'State-Specific-Test');
            $paid_by = array('User A' => 'User A', 'User B' => 'User B');
            $this->statedroupdown();

            $this->set('license_status', $license_status);
            $this->set('license_types', $license_types);
            $this->set('holder_id', $holder_id);
            $this->set('testing_types', $testing_types);
            $this->set('paid_by', $paid_by);
        }	
    }

?>