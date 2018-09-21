<?php

/* Project		  :-  Image coin website

 * Controller Name :-  players_contoller.php

* Created  On     :-  17-05-12

* Created By	  :-  Vidhur

*/

class OffersController extends AppController

{

	var $name = 'offers';

	//var $uses = 'Setup';

	var $layout = 'new_admin_layout';

	var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');

	var $components = array('Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');

	var $uses     = array('Route','Point','ProductType','PricingType','CoinsHolder','Company','Coinset','Holder','ProjectType','PointArchiveUser','MailFooter','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term','Category','Offer','CompanyToCategory','OfferToCategory','NonProfitType', 'RelatedProject', 'RelatedNonProfit','OfferToNonProfit', 'OfferToLocation', 'Folder','EmailTemplate');





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





	/*

	 * Function name   : projectdetailbyid()

	* Description     : This function used to get project detail

	* params		  : projectid

	* Created On      : 18-05-12 (02:20am)

	* Modified by	  : Puneet

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



	function getmerchantnamebyprojectid($projectid){/*



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

		*/

	}//end







	/*

	 * Function name   : changestatus()

	* Arguments : $recid,$modelname,$status,$methodname

	* Description : This function used to change status as active or deactive

	* Created On      : 15-05-12

	* Modified By	  : Vidhur

	*/

	function changestatus($recid,$modelname,$status,$methodname,$action='cngstatus',$othermodel='',$otherid='',$param=''){

		//Configure::write('debug',2);

		//	echo $action;

		if($status==2)

			$status =0;

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

				

			if($action =='delete')

				$i=$this->$modelname->updateAll(array('delete_status'=>"'".$res."'"), array('id'=>$diffArr));

			else

				$i=$this->$modelname->updateAll(array('active_status'=>"'".$status."'"), array('id'=>$diffArr));



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



			if($action == 'delete')

				$i=$this->$modelname->updateAll(array('delete_status'=>"'".$res."'"),$where);

			else

				$i=$this->$modelname->updateAll(array('active_status'=>"'".$status."'"),$where);



			if($i){

				$this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));

			}

		}



		//$methodname="admins/".$methodname;exit;

		$this->redirect("$methodname/");



	}//end of changestatus()



	/**

		* Function name : offerlist()

		* Description : This function used to dispaly list of all offer list

		* Created On : 17th July 2012

		*

		*/



	function offerlist(){

		//Configure::write('debug', 2);

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

			}	

		//for active menu display

		$this->set('page_url','offerlist');

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '20'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition

		 

		$projectDetails=$this->getprojectdetails($project_id);

		$this->set('project',$projectDetails);

			

		$project_name=$projectDetails['Project']['project_name'];

		$this->set('project_name',$project_name);

		$projectid = $project_id;

		##fetch data from Company table for listing	

			$current_date=date('Y-m-d');

			App::import("Model", "Offer");

			$this->Offer =   & new Offer();

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

			



		if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

			 echo $searchkeyword = $this->data['Offer']['searchkey'];exit;

			 $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0' and (Company.company_name LIKE '%".$searchkeyword."%' OR Category.category_name LIKE '%".$searchkeyword."%' OR Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' OR OfferTypeTemplate.offer_type_template_name LIKE '%".$searchkeyword."%' )";

		}else{

			  $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0'";

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

		$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

		$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition);

		//echo '***'.$condition;

	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

		$this->set("offerdata",$offerArray);	

		//$this->pl($offerArray);	

	}//end offerlist();









	/**

		* Function name : addoffer()

		* Description : This function used to add & edit offer

		* Created On : 17th July 2012

		*

		*/

		



	function addoffer($offerid='') {

		$usertype = $this->session_check_usertype();

			$this->set('usertype',$usertype);

			if($usertype==trim("user")){
				echo 4;exit;

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}	

		##import Company  model for processing

		App::import("Model", "Offer");

		$this->Offer =  & new Offer();

		//for active menu display

		$this->set('page_url','editoffer');

		$current_domain= $_SERVER['HTTP_HOST'];

		$this->set('current_domain',$current_domain);

		# set help condition

		

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '20'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);



		# set help condition

		$projectDetails=$this->getprojectdetails($project_id);

		$this->set('project',$projectDetails);

		$projectid = $project_id;

		$this->set('project_name',$projectDetails['Project']['project_name']);

		$this->set('projectid',$projectid);



		$this->set("selectedcategory",'');

		$this->getCategoryForOffer();

			

		$this->set("selectedmerchant",'');

		$this->getMerchantListForOffer($project_id);

		

		$this->set("selectedevent",'');

		$this->getEventDropDownListByProjetcID($project_id);

		 

		$this->set("selectedoffertypetemp",'');

		//$this->offertypedropdown();

		$this->offertypetempdropdown();

		$this->set("merchantlocationdropdown",array());

		$this->set("templatedropdown",array());		

		##get Offer Auto Responder

		$this->getOfferResponders($project_id);

		$this->set('sel_responder' ,'');		

		$this->set('recur_pattern',$this->getRecurPatternkArray());

		##check empty data

		 if(isset($this->params['pass']['1'])){

		 	$this->set('params',$this->params['pass']['1']);

		 

		 }

		if(!empty($this->data)) {

			$this->data['Offer']['project_id'] = $projectid;

			#set the posted data

			$this->Offer->set($this->data);

			#check server side validation

			$errormsg = $this->Offer->invalidFields();



			if(!$errormsg){

				

				$parentDirPath =  'img' . DS;

				$ptname = $projectDetails['Project']['project_name']; 

				$this->File = & new FileComponent;

				$dir = new Folder();

				

				if(isset($this->data['Offer']['square_graphic_img']['name']) && $this->data['Offer']['square_graphic_img']['name'] !=''){

					

					$filePath_square =  $parentDirPath. $ptname . DS .'offers'. DS .'square'; 

					$dir->create($filePath_square, true, 0755);

					$this->File->setDestPath($filePath_square);

					##upload image

					$file_square = $this->File->setFileName($this->data['Offer']['square_graphic_img']['name']);

					$tmp_square = $this->data['Offer']['square_graphic_img']['tmp_name'];

					$file_namesquare = $this->File->uploadOfferGraphic($file_square,$tmp_square,true,'210x210','square');

					if(!empty($file_namesquare)){

						$this->data['Offer']['square_graphic'] = $file_namesquare;

					}

					else{

						unset($this->data['Offer']['square_graphic_img']);

					}

				}else{

						unset($this->data['Offer']['square_graphic_img']);

				}

				

				if(isset($this->data['Offer']['tall_graphic_img']['name']) && $this->data['Offer']['tall_graphic_img']['name'] !=''){

					

					$filePath_tall =  $parentDirPath. $ptname . DS .'offers'.DS.'tall' ;

					$dir->create($filePath_tall, true, 0755);

					$this->File->setDestPath($filePath_tall);

					##upload image

					$file_tall = $this->File->setFileName($this->data['Offer']['tall_graphic_img']['name']);

					$tmp_tall = $this->data['Offer']['tall_graphic_img']['tmp_name'];

					$file_nametall = $this->File->uploadOfferGraphic($file_tall, $tmp_tall, true,'350x220','tall');

					if(!empty($file_nametall)){

						$this->data['Offer']['tall_graphic'] = $file_nametall;

					}

					else{

						unset($this->data['Offer']['tall_graphic_img']);

					}

				}else{

					unset($this->data['Offer']['tall_graphic_img']);

				}

				

				if(isset($this->data['Offer']['wide_graphic_img']['name']) && $this->data['Offer']['wide_graphic_img']['name'] !=''){

					

					$filePath_wide =  $parentDirPath. $ptname . DS .'offers'.DS.'wide' ;

					$dir->create($filePath_wide, true, 0755);

					$this->File->setDestPath($filePath_wide);

					##upload image

					$file_wide = $this->File->setFileName($this->data['Offer']['wide_graphic_img']['name']);

					$tmp_wide = $this->data['Offer']['wide_graphic_img']['tmp_name'];

					$file_namewide = $this->File->uploadOfferGraphic($file_wide, $tmp_wide,true,'220x350','wide');

					if(!empty($file_namewide)){

						$this->data['Offer']['wide_graphic'] = $file_namewide;

					}

					else{

						unset($this->data['Offer']['wide_graphic_img']);

					}

				}else{

					unset($this->data['Offer']['wide_graphic_img']);

				}

				

				$eid = "";

				$etitle = $this->data['Offer']['offer_title'];

				

				$data = explode("-", $this->data['Offer']['starttime']);

				$date = new DateTime();

				$date->setDate($data['2'], $data['0'], $data['1']);

				$sdt= $date->format("Y-m-d");			

				$sdate=  $sdt." ".$this->data['Offer']['stime'];

				$new_sdate=date("Y-m-d H:i:s", strtotime($sdate));

				$this->data['Offer']['starttime']=$new_sdate; // $date->format("Y-m-d H:i:s");



				// $etitle = $this->data['Offer']['endtime'];

				$data = explode("-", $this->data['Offer']['endtime']);

				$date = new DateTime();

				$date->setDate($data['2'], $data['0'], $data['1']);

				$edt= $date->format("Y-m-d");



				$edate=  $edt." ".$this->data['Offer']['etime'];

				$new_edate=date("Y-m-d H:i:s", strtotime($edate));

				$this->data['Offer']['endtime']= $new_edate;



				$end_by_date = '0000-00-00';



				if($this->data['Offer']['task_end'] == 'after_accurrences'){

					switch($this->data['Offer']['recur_pattern']){

						case 'Daily':

									if($this->data['Offer']['daily_pattern']=='everyday'){

										$days = $this->data['Offer']['daily_every_noof_days'] * $this->data['Offer']['task_end_after_occurrences'];

										$end_by_date = date('Y-m-d', strtotime($sdate . ' + '.$days.' day'));

									}else{

										$days = 7 * ($this->data['Offer']['task_end_after_occurrences']-1);

										$end_by_date = date('Y-m-d', strtotime($sdate . ' + '.$days.' day'));

									}

								break;

						case 'Weekly':

									$d = 1;

									$days = 0;

									$end_by_date_flag = date('Y-m-d', strtotime($sdate));

									

									while(true) {

									

										if($this->data['Offer']['weekly_monday']==1){

											if( $d > $this->data['Offer']['task_end_after_occurrences'] ){

												break;

											}

											$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' monday this week '));

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												$d++;

										}

										

										if($this->data['Offer']['weekly_tuesday']==1){

											if( $d > $this->data['Offer']['task_end_after_occurrences'] ){

												break;

											}

											$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' tuesday this week '));

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												$d++;

										}

										

										if($this->data['Offer']['weekly_wednesday']==1){

											if( $d > $this->data['Offer']['task_end_after_occurrences'] ){

												break;

											}

											$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' wednesday this week '));

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												$d++;

										}

										

										if($this->data['Offer']['weekly_thursday']==1){

											if( $d > $this->data['Offer']['task_end_after_occurrences'] ){

												break;

											}

											$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' thursday this week '));

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												$d++;

										}

										

										if($this->data['Offer']['weekly_friday']==1){

											if( $d > $this->data['Offer']['task_end_after_occurrences'] ){

												break;

											}

											$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' friday this week '));

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												$d++;

										}

										

										if($this->data['Offer']['weekly_saturday']==1){

											if( $d > $this->data['Offer']['task_end_after_occurrences'] ){

												break;

											}

											$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' saturday this week '));

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												$d++;

										}

										

										if($this->data['Offer']['weekly_sunday']){

											if( $d > $this->data['Offer']['task_end_after_occurrences'] ){

												break;

											}

											$end_by_date = date('Y-m-d', strtotime($end_by_date_flag.' sunday this week '));

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												$d++;

										}

										

										$days = 7 * $this->data['Offer']['weekly_every_noof_weeks'];

										$end_by_date_flag = date('Y-m-d', strtotime($end_by_date_flag . ' +'.$days.' day'));

											

									}

									

								break;

								

						case 'Monthly':

							

								list($year, $month, $day) = explode('-', $sdate);

								

								if($this->data['Offer']['monthly_pattern']=='dayofeverymonth'){

									$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $month, $this->data['Offer']['monthly_onof_day'], $year));

									

									$md = 1;

									while(true) {

											if($md > $this->data['Offer']['task_end_after_occurrences']){

												break;

											}

											$end_by_date = $end_by_date_flag;

											if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

												 $md++;

											

											list($y, $m, $d) = explode('-', $end_by_date_flag);

											$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m + $this->data['Offer']['monthly_every_noof_months'], $d, $y));

									}

								}else{

									$end_by_date_flag = date('Y-m-d', strtotime($this->data['Offer']['monthly_weeknumber'].' '.strtolower($this->data['Offer']['monthly_weekday'].' of '.date('F', strtotime($sdate)).' '.$year)));

									$mc = 1;

									while(true) {

										if($mc > $this->data['Offer']['task_end_after_occurrences']){

											break;

										}

										$end_by_date = $end_by_date_flag;

										if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

											$mc++;

										list($y, $m, $d) = explode('-', $end_by_date_flag);

										$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m + $this->data['Offer']['monthly_every_noof_months'], $d, $y));

										$end_by_date_flag = date('Y-m-d', strtotime($this->data['Offer']['monthly_weeknumber'].' '.strtolower($this->data['Offer']['monthly_weekday'].' of '.date('F', strtotime($end_by_date_flag)).' '.date('Y',strtotime($end_by_date_flag)))));

									}

								}

							

								break;

								

						case 'Yearly':

								list($year, $month, $day) = explode('-', $sdate);

								if($this->data['Offer']['yearly_pattern']=='everynoofmonths'){

									$end_by_date_flag = date('Y-m-d', strtotime( $this->data['Offer']['yearly_everymonth_date'].' '.$this->data['Offer']['yearly_everymonth'].' '. $year));

									$yc = 1;

									while(true) {

										if($yc > $this->data['Offer']['task_end_after_occurrences']){

											break;

										}

										$end_by_date = $end_by_date_flag;

										if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

											$yc++;

										

										list($y, $m, $d) = explode('-', $end_by_date_flag);

										$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m, $d, $y+1));

										$end_by_date_flag = date('Y-m-d', strtotime( $this->data['Offer']['yearly_everymonth_date'].' '.$this->data['Offer']['yearly_everymonth'].' '.date('Y',strtotime($end_by_date_flag))));

									}

								}else{

									

									$end_by_date_flag = date('Y-m-d', strtotime($this->data['Offer']['yearly_weeknumber'].' '.$this->data['Offer']['yearly_weekday'].' of '.$this->data['Offer']['yearly_weekof_month'].' '. $year));

									$yc = 1;

									while(true) {

										if($yc > $this->data['Offer']['task_end_after_occurrences']){

											break;

										}

										$end_by_date = $end_by_date_flag;

										if((strtotime($end_by_date)- strtotime($sdate)) >= -86400 )

											$yc++;

									

										list($y, $m, $d) = explode('-', $end_by_date_flag);

										$end_by_date_flag = date('Y-m-d', mktime(0, 0, 0, $m, $d, $y+1));

										$end_by_date_flag = date('Y-m-d', strtotime($this->data['Offer']['yearly_weeknumber'].' '.$this->data['Offer']['yearly_weekday'].' of '.$this->data['Offer']['yearly_weekof_month'].' '.date('Y',strtotime($end_by_date_flag))));

									}

								}

								break;

						default:

																									

					}

				}else{

					if($this->data['Offer']['task_end'] == 'by_date' && !empty($this->data['Offer']['end_by_date'])) {

						$data = explode("-", $this->data['Offer']['end_by_date']);

						$date = new DateTime();

						$date->setDate($data['2'], $data['0'], $data['1']);

						$end_by_date= $date->format("Y-m-d");

					}

				}

				

			$this->data['Offer']['task_end_by_date']= $end_by_date;

			

				

				$recur_arr=array();

				$offer_arr=array();

				

				//echo '<pre>';print_r($this->data);die;

				if($this->Offer->Save($this->data['Offer'])){					

					$offer_id=$this->Offer->getLastInsertID();

					if($offer_id==''){

						$offer_id = $offerid;

					}

					 

					//NonProfit

					$this->OfferToNonProfit->deleteAll(array('OfferToNonProfit.offer_id'=>$offer_id));

					if(isset($this->data['OfferToNonProfit']) && !empty($this->data['OfferToNonProfit'])){

						

						foreach($this->data['OfferToNonProfit']['nonprofit_id'] as $key=>$val ){

							$nonprofitdata[] = array('offer_id' =>$offer_id, 'nonprofit_id' => $val);

						}

						$flag = $this->OfferToNonProfit->saveAll($nonprofitdata);

					}//End

					

					//Merchants To Location

					$this->OfferToLocation->deleteAll( array('OfferToLocation.offer_id'=>$offer_id));

					if(isset($this->data['OfferToLocation']) && !empty($this->data['OfferToLocation'])){						

						foreach($this->data['OfferToLocation']['merchant_id'] as $key=>$val ){

							$locationdata[] = array('offer_id' =>$offer_id, 'merchant_id' => $val);

						}

						$flag = $this->OfferToLocation->saveAll($locationdata);

					}//End

										

					if($this->data['Offer']['id']=="" || $this->data['Offer']['id']==NULL || $this->data['Offer']['id']=="0")

					{

						$offer_id=$this->Offer->getLastInsertID();

						$create_unique_offers=1;

			

					}

					else

					{

						$offer_id=$this->data['Offer']['id'];

						$create_unique_offers=0;

						

					}

					 

					unset($this->data['Offer']['square_graphic_img']);

					unset($this->data['Offer']['tall_graphic_img']);

					unset($this->data['Offer']['wide_graphic_img']);

					$recur_arr = $this->data['Offer'];

					$recur_arr['offer_id']=$offer_id;

					$recur_arr['offer_title']=$this->data['Offer']['offer_title'];

					$current_day=date('Y-m-d');

					$start_time=date('Y-m-d',strtotime($this->data['Offer']['stime']));

					$end_time=strtotime($this->data['Offer']['etime']);

					$start_time=date("H:i:s", $start_time);

					$end_time=date("H:i:s", $end_time);

					//#############################################################

					if($offer_id){

						$this->Session->setFlash('Offer updated Successfully.','default', array('class' => 'successmsg'));

						

						if(isset($this->data['Offer']['params'])=='email'){

							if(isset($this->data['Action']['redirectpage'])){

							$this->redirect(array('controller'=>'offers','action'=>'offeremail'));

						}else{

							$this->redirect(array('controller'=>'offers','action'=>'addoffer',$offer_id));

							}

						}else{

							if(isset($this->data['Action']['redirectpage'])){

								$this->redirect(array('controller'=>'offers','action'=>'offerlist'));

							}else{

								$this->redirect(array('controller'=>'offers','action'=>'addoffer',$offer_id));

							  }

						}	

					}else{



						$this->Session->setFlash('Offer Added Successfully.','default', array('class' => 'successmsg'));



						if(isset($this->data['Action']['redirectpage'])){



							$this->redirect('/offers/offerlist');



						}else{

							$this->redirect('/offers/addoffer/'.$this->data['Offer']['id']);



						}

					}

				}else{

					$this->Session->setFlash('Error in processing.','default',array('class' => 'msgTXt'));

				}

			}		

	}

	

		if(!empty($offerid)){



			$this->Offer->id = $offerid;

			$this->set('offerid', $offerid);

			$this->data = $this->Offer->read();

			//$this->pl($this->data);

			$this->data['Offer']['starttime'] = date('m-d-Y', strtotime($this->data['Offer']['starttime']));

			//$this->pl($this->data);

			//Get Offer Location Data

			App::import("Model", "OfferToLocation");

            $this->OfferToLocation =   & new OfferToLocation();

			$merchantloc = array();

			$conditions = ' OfferToLocation.offer_id='.$offerid;

			$offerlocation = $this->OfferToLocation->find('all',array('conditions' => $conditions));

			foreach($offerlocation as $val){

				$merchantloc[] = 	$val['OfferToLocation']['merchant_id'];		

			}

			$this->set('sel_mer',implode(',',$merchantloc));

			//Get Offer Non Profit Data

			

			/*App::import("Model", "OfferToNonProfit");

            $this->OfferToNonProfit =   & new OfferToNonProfit();*/

			$offernonprofit = array();

			$conditions = ' OfferToNonProfit.offer_id='.$offerid;

			$offerlocation = $this->OfferToNonProfit->find('all',array('conditions' => $conditions));

			foreach($offerlocation as $val){

				$offernonprofit[] = 	$val['OfferToNonProfit']['nonprofit_id'];		

			}

			$this->set('sel_mer_non_profit',implode(',',$offernonprofit));			

			if(isset($this->data['Offer']['merchant_id'])){

				$this->set('selectedmerchant',$this->data['Offer']['merchant_id']);

			}

			if(isset($this->data['Offer']['category_id'])){

				$this->set('selectedcategory',$this->data['Offer']['category_id']);

			}

			if(isset($this->data['Offer']['offer_type'])){

				$this->set('selectedoffertypetemp',$this->data['Offer']['offer_type']);

			}

			//echo '<pre>';print_r($this->data);die;

			 $offer_sdate=strtotime($this->data['Offer']['starttime']);

			 $sel_stime=date("h:i a", $offer_sdate);

			 $this->set('sel_stime',$sel_stime);

			

			$offer_edate = strtotime($this->data['Offer']['endtime']);

			$sel_etime=date("h:i a", $offer_edate);

			$this->set('sel_etime',$sel_etime);

			

			if(isset($this->data['Offer']['auto_respond_offer_email'])){

				$this->set('sel_responder',$this->data['Offer']['auto_respond_offer_email']);

			}

			if(isset($this->data['Offer']['event_detail_page'])){

			

				$this->set('event_detail_page',$this->data['Offer']['event_detail_page']);

			}

			if(isset($this->data['Offer']['merchant_detail_page'])){

				$this->set('merchant_detail_page',$this->data['Offer']['merchant_detail_page']);

			}

			if(isset($this->data['Offer']['offer_inquiry_page'])){

				$this->set('offer_inquiry_page',$this->data['Offer']['offer_inquiry_page']);

			}

			if(isset($this->data['Offer']['task_end_by_date'])){

			

				$this->set('end_by_date',$this->data['Offer']['task_end_by_date']);

			}

			if(isset($this->data['Offer']['event_id'])){

				$this->set('selectedevent',$this->data['Offer']['event_id']);

			}

			$this->set('sdate', date("m-d-Y", $offer_sdate));

			$this->set('edate', date("m-d-Y", $offer_edate));

			//$this->set('offerdata', $this->data['Offer']);

		}



	}//end addoffer()





	

	function update_merchantlocation($merchantid, $sel_m=''){

		 $sel_m = explode(',',$sel_m);

		//$this->pl($sel_m);

		$this->layout="";

		if($merchantid){

			$merchantcondition = 'Company.id ="'. $merchantid.'"';

			$merchant = $this->Company->find("first", array('conditions' => $merchantcondition));

			$mechantdata =  $this->getMerchantLocationsForOffer($merchantid, $merchant['Company']['hq_id']);	

		}		

		if(!empty($mechantdata)) {

		echo '<table cellpadding="5" cellspacing="5" width="100%" ><tr align="left"><th width="10%"><input type="checkbox" id="merchantlocationall" /></th>';

		echo '<th width="40%">Name</th><th width="25%">City</th><th width="25%">State</th></tr>';

		foreach($mechantdata as $mer){

			echo '<tr><td><input type="checkbox" id="merchantlocation'.$mer['Company']['id'].'" name="data[OfferToLocation][merchant_id][]" value="'.$mer['Company']['id'].'" ';

			

			echo (!empty($sel_m) && in_array($mer['Company']['id'],$sel_m))?'checked="checked"' :'';

			

			echo ' /></td> <td>'.$mer['Company']['address1'].' '.$mer['Company']['address2'].'</td><td>'.$mer['Company']['city'].'</td><td>'. $this->getstatename($mer['Company']['state']).'</td></tr>';

		}

		echo '</table>';

		}

		exit;

		

	}

	

	function getRelatedNonProfit($companyid="", $sel_np=""){

		$sel_np = explode(',',$sel_np);

		$this->layout='';		

		App::import("Model", "RelatedNonProfit");

		$this->RelatedNonProfit =   & new RelatedNonProfit();

		 

		$condition = 'RelatedNonProfit.company_id = '.$companyid;

		$releatednonprofits = $this->RelatedNonProfit->find('all',array("conditions"=>$condition));

		

		$nonprofitarray = array();

		foreach($releatednonprofits as $nonprofitids){

			$nonprofitarray[] = $nonprofitids['RelatedNonProfit']['nonprofit_id'];

		}

		App::import("Model", "Company");

		$this->Company =   & new Company();

		

		$projectid = $this->Session->read("sessionprojectid");

		

		$condition = 'Company.id IN ('.implode($nonprofitarray, ',').') AND Company.project_id = "'.$projectid.'" ';

		$releatednonprofitdata =  $this->Company->find('all',array("conditions"=>$condition));

		if(!empty($releatednonprofitdata)) {

		echo '<table cellpadding="5" cellspacing="5" width="100%" ><tr align="left"><th width="10%"><input type="checkbox" id="nonprofitcheckall" /></th>';

		echo '<th width="40%"><b>Name</b></th><th width="25%"><b>City</b></th><th width="25%"><b>State</b></th></tr>';

		foreach($releatednonprofitdata as $nonprofit){

			echo '<tr><td><input type="checkbox" id="nonprofitcheck'.$nonprofit['Company']['id'].'" name="data[OfferToNonProfit][nonprofit_id][]" value="'.$nonprofit['Company']['id'].'" ';

			echo (!empty($sel_np) && in_array($nonprofit['Company']['id'],$sel_np))?'checked="checked"' :'';

			echo ' /></td> <td>'.$nonprofit['Company']['company_name'].'</td><td>'.$nonprofit['Company']['city'].'</td><td>'. $this->getstatename($nonprofit['Company']['state']).'</td></tr>';

		}

		echo '</table>';

		}

		exit;

	}

	

	/**

		* Function name : categories()

		* Description : This function used to dispaly list of all offer list

		* Created On : 15th OCT 2012

		*

		*/



	function category(){

		//Configure::write('debug', 2);

		

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}	

		//for active menu display

		$this->set('page_url','offerlist');

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '20'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition

		 

		$projectDetails = $this->getprojectdetails($project_id);

		

		$this->set('project',$projectDetails);

			

		$project_name=$projectDetails['Project']['project_name'];

		$this->set('project_name',$project_name);

		$projectid = $project_id;

		##fetch data from Company table for listing	

			$current_date=date('Y-m-d');

			App::import("Model", "Offer");

			$this->Offer =   & new Offer();

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

			$this->Offer->bindModel(array('belongsTo'=>array(

				'Event'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.event_id  = Event.id'

            ))));

			

		if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

			$searchkeyword = $this->data['Offer']['searchkey'];

			$condition = " Offer.project_id = '".$project_id."'  and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

		}else{

			  $condition = "Offer.project_id = '".$project_id."'  and Offer.delete_status ='0'";

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

			$this->Offer->bindModel(array('belongsTo'=>array(

				'Event'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.event_id  = Event.id'

            ))));

		$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

		$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition);

		//echo '***'.$condition;

		$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

		$this->set("offerdata",$offerArray);	

		//$this->pl($offerArray);	

		

	}//end category();

	

	/**

		* Function name : addcategories()

        * Description : This function used to add and edit category 

        * Created On : 15th IC 2012

		*

		*/

		

		 function viewcategory($categorydetailsid='',$companyid=''){

		 

			#check user session live or not

			//Configure::write('debug','2');

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

						

            

			//$this->data['CategoryDetail']['category_id'] ='-1';

			if($categorydetailsid){

				

                $this->CategoryDetail->id = $categorydetailsid;

                $condition = array('category_id' => $categorydetailsid);

                $this->data = $this->CategoryDetail->find('all',array('conditions' =>$condition));

                $this->data = $this->data[0];

             

			 	$this->set("selectedcategory",$this->data['CategoryDetail']['category_id']);

				$this->set("selectedsubcategory",$this->data['CategoryDetail']['sub_category_id']);

				

            }

			

			$this->set("categorydropdown", $this->getCategoryDropdown());

			$this->set("subcategorydropdown", $this->getSubCategoryDropdown($this->data['CategoryDetail']['category_id']));

			

			 }//end addcategories();

			

	 function calendar($year = null, $month = null)

        {

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

					$this->set('current_project_name',$project_name);     // used in project_name element file             

			}

            $current_domain= $_SERVER['HTTP_HOST'];           

            //$current_domain=$current_domain."/gosocialsolutions/";

			$current_domain=$current_domain;

			

            App::import("Model", "Offer");

            $this->Offer =   & new Offer();

            

            $current_date=date('Y-m-d');

            

             

           // get all the events from the database.

            $offers = $this->Offer->find('all',array('conditions' => "Offer.project_id='".$project_id."' and Offer.active_status='1' and Offer.delete_status='0'"));

			



            // insert rows to an array.

            for ($a=0; count($offers)> $a; $a++){

              //echo "offer.id='".$offers[$a]['Offer']['id']."' and Offer.active_status='1' and Offer.delete_status='0'";

            $validate_event = $this->Offer->find('all',array('conditions' => "Offer.id='".$offers[$a]['Offer']['id']."' and Offer.active_status='1' and Offer.delete_status='0'"));

			

            //echo '<pre>';print_r($validate_event);die;

                if(!empty($validate_event))

                {

                    

                $starttime=date('Y-m-d H:i:s', strtotime($offers[$a]['Offer']['starttime']));

                $endtime=date('Y-m-d H:i:s', strtotime($offers[$a]['Offer']['endtime']));

                

                //$event_startdate=$offers[$a]['Offer']['starttime'];

                

                 if($starttime >= $current_date)

                        $url="http://".$current_domain."/offers/calendar/";

                    else

                        $url="http://".$current_domain."/admins/pasteventcreated/";   

                

                



                $rows[]= '{"id":'.$offers[$a]['Offer']['id'].', "title":"'.$offers[$a]['Offer']['offer_title'].'", "start":"'.$starttime.'","end":"'.$endtime.'","url":"'.$url.$offers[$a]['Offer']['id'].'", "className":"'.$offers[$a]['Offer']['offer_type'].'","type":"'.$offers[$a]['Offer']['offer_type'].'"}';

                }



            }



            // convert the array to a string.

            if (isset($rows)){



				$convertojson = implode(",", $rows);

            }else{

					$convertojson ="";

			}

			//$this->pl($convertojson);



            // pass the string to the json variable. this will then be passed  and printed to the javascript code.

			

            $this->set('json',$convertojson); 

        }

			



        

        /**

         * Function name : taken()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function taken(){

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

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        		

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        		

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        		

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.task_startdate>='".$current_date."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0'";

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

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end taken();



        

        /**

         * Function name : used_unpaid()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function used_unpaid(){

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}	

		   	//for active menu display

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.task_startdate>='".$current_date."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0'";

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

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end used_unpaid();

        

        

        /**

         * Function name : used_paid()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function used_paid(){

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}

        	//for active menu display

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.task_startdate>='".$current_date."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0'";

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

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end used_paid();

        

        

        

        /**

         * Function name : expired()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function expired(){

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}

        	//for active menu display

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.delete_status ='0'";

        	}

        	

        	$condition .= " AND Offer.task_end_by_date < ".$current_date." ";

        

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

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end expired();

        

        

        /**

         * Function name : bymember()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function bymember(){

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

					$this->set('current_project_name',$project_name);     // used in project_name element file]

			}

        	//for active menu display

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.delete_status ='0'";

        	}

        

        	$condition .= " AND Offer.controlled_by =0 ";

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

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end bymember();

        

        

        /**

         * Function name : bymerchant()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function bymerchant(){

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}

        	//for active menu display

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.delete_status ='0'";

        	}

        

        	$condition .= " AND Offer.controlled_by = 1 ";

        	

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

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end bymerchant();

        

        

        /**

         * Function name : by_pledge_discount()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function by_pledge_discount(){

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}	

        	//for active menu display

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        

        

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.delete_status ='0'";

        	}

        

        	$condition .= " AND Offer.offer_type IN(7, 8, 9, 10, 11) ";

        	 

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

        	

        	

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end by_pledge_discount();

        

        

        /**

         * Function name : coupons()

         * Description : This function used to dispaly list of all taken offers

         * Created On : 17th October 2012

         *

         */

        

        function coupons(){

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}

	       	//for active menu display

        	$this->set('page_url','offerlist');

        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '20'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        

        	$projectDetails=$this->getprojectdetails($project_id);

        	$this->set('project',$projectDetails);

        

        	$project_name=$projectDetails['Project']['project_name'];

        	$this->set('project_name',$project_name);

        	$projectid = $project_id;

        	##fetch data from Company table for listing

        	$current_date=date('Y-m-d');

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();

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

        	$this->Offer->bindModel(array('belongsTo'=>array(

        			'Event'=>array(

        					'foreignKey'=>'event_id'

        			))));

        

        	if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

        		$searchkeyword = $this->data['Offer']['searchkey'];

        		$condition = " Offer.project_id = '".$project_id."' and Offer.task_startdate>='".$current_date."' and Offer.delete_status ='0' and (Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' )";

        	}else{

        		$condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0'";

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

        	$this->Offer->bindModel(array('belongsTo'=>array(

        			'Event'=>array(

        					'foreignKey'=>'event_id'

        			))));

        	$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

        	$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	//echo '***'.$condition;

        	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

        	$this->set("offerdata",$offerArray);

        }//end coupons();

		

		/**

		* Function name : offeremail()

		* Description : This function used to dispaly list of all offer list that hace auto responder id

		* Created On : 18th OCT 2012

		*

		*/



	function offeremail(){

		//Configure::write('debug', 2);

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}	

		//for active menu display

		$this->set('page_url','offerlist');

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '20'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition

		 

		$projectDetails=$this->getprojectdetails($project_id);

		$this->set('project',$projectDetails);

			

		$project_name=$projectDetails['Project']['project_name'];

		$this->set('project_name',$project_name);

		$projectid = $project_id;

		##fetch data from Company table for listing	

			$current_date=date('Y-m-d');

			App::import("Model", "Offer");

			$this->Offer =   & new Offer();

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

			$this->Offer->bindModel(array('belongsTo'=>array(

				'EmailTemplate'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.auto_respond_offer_email = EmailTemplate.id'

            ))));

			

		if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

			$searchkeyword = $this->data['Offer']['searchkey'];

			 $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0' and (Company.company_name LIKE '%".$searchkeyword."%' OR Offer.offer_title LIKE '%".$searchkeyword."%'  OR EmailTemplate.email_template_name LIKE '%".$searchkeyword."%' OR EmailTemplate.subject LIKE '%".$searchkeyword."%' OR EmailTemplate.sender LIKE '%".$searchkeyword."%')";

		}else{

			  $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0' AND Offer.auto_respond_offer_email > 0";

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

			$this->Offer->bindModel(array('belongsTo'=>array(

				'EmailTemplate'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.auto_respond_offer_email = EmailTemplate.id'

            ))));

		$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

		$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition);

		//echo '***'.$condition;

	$offerEmailArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

		$this->set("offerdata",$offerEmailArray);		

		//echo '<pre>';print_r($offerEmailArray);

	}//end offerlist();

	

	

	function download_offer_list()

        {



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

					$this->set('current_project_name',$project_name);     // used in project_name element file

			}		

		//for active menu display

		$this->set('page_url','offerlist');

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '20'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition

		 

		$projectDetails=$this->getprojectdetails($project_id);

		$this->set('project',$projectDetails);

			

		$project_name=$projectDetails['Project']['project_name'];

		$this->set('project_name',$project_name);

		$projectid = $project_id;

		##fetch data from Company table for listing	

			$current_date=date('Y-m-d');

			App::import("Model", "Offer");

			$this->Offer =   & new Offer();

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

			

		if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

			 $searchkeyword = $this->data['Offer']['searchkey'];

			 $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0' and (Company.company_name LIKE '%".$searchkeyword."%' OR Category.category_name LIKE '%".$searchkeyword."%' OR Offer.offer_title LIKE '%".$searchkeyword."%' OR Offer.offer_type  LIKE '%".$searchkeyword."%' OR OfferTypeTemplate.offer_type_template_name LIKE '%".$searchkeyword."%' )";

		}else{

			  $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0'";

		}



		if(!isset($_GET["sortBy"]) || $_GET["sortBy"]==""){

			$_GET["sortBy"]="starttime";

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

		$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

		$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition);

		//echo '***'.$condition;

	$offerArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

		$this->set("offerdata",$offerArray);	

		//$this->pl($offerArray);	

		}

		

		function download_offer_email_list(){

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

				$this->set('current_project_name',$project_name);     // used in project_name element file

			}	

		//for active menu display

		$this->set('page_url','offerlist');

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '20'";

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition

		 

		$projectDetails=$this->getprojectdetails($project_id);

		$this->set('project',$projectDetails);

			

		$project_name=$projectDetails['Project']['project_name'];

		$this->set('project_name',$project_name);

		$projectid = $project_id;

		##fetch data from Company table for listing	

			$current_date=date('Y-m-d');

			App::import("Model", "Offer");

			$this->Offer =   & new Offer();

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

			$this->Offer->bindModel(array('belongsTo'=>array(

				'EmailTemplate'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.auto_respond_offer_email = EmailTemplate.id'

            ))));

			

		if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

			$searchkeyword = $this->data['Offer']['searchkey'];

			 $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0' and (Company.company_name LIKE '%".$searchkeyword."%' OR Offer.offer_title LIKE '%".$searchkeyword."%'  OR EmailTemplate.email_template_name LIKE '%".$searchkeyword."%' OR EmailTemplate.subject LIKE '%".$searchkeyword."%' OR EmailTemplate.sender LIKE '%".$searchkeyword."%')";

		}else{

			  $condition = "Offer.project_id = '".$project_id."' and Offer.starttime >='".$current_date."' and Offer.delete_status ='0' AND Offer.auto_respond_offer_email > 0";

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

			$this->Offer->bindModel(array('belongsTo'=>array(

				'EmailTemplate'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.auto_respond_offer_email = EmailTemplate.id'

            ))));

		$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

		$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition);

		//echo '***'.$condition;

	$offerEmailArray = $this->Offer->find('all',array("conditions"=>$condition,'order'=>$order,'limit' => $limit, 'page' => $page));

		$this->set("offerdata",$offerEmailArray);		

		//echo '<pre>';print_r($offerEmailArray);

	}//end offerlist();

	

	/*

		@Function Name :  tasklist

		@Description   :  This function show the task list releated the offer

		@params        :  email_template_type

		@Created By    :  Brijesh

		@Created ON    :  19 oct 2012

	*/

	function tasklist(){

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

				}	    // used in project_name element file		

		 App::import("Model", "HelpContent");

		 $this->HelpContent =  & new HelpContent();

		 $condition = "HelpContent.id = '13'";

		 $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		 $this->set("hlpdata",$hlpdata);

		 

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

	         if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

	           $searchkeyword = $this->data['Offer']['searchkey'];

	          $condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND CommunicationTask.project_id IN('0', $project_id ) AND CommunicationTask.email_template_type ='3' AND  (CommunicationTask.task_name LIKE '%".$searchkeyword."%'  OR EmailTemplate.email_template_name  LIKE '%".$searchkeyword."%' OR CommunicationTask. 	recur_pattern LIKE '%".$searchkeyword."%')";

            }else{

				$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'  AND CommunicationTask.project_id IN('0', $project_id) AND CommunicationTask.email_template_type ='3'";

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

			 //$this->pl($taskdata);

	         $this->set("taskdata",$taskdata);

           

        }//end prospectemaillist

		

		/*

		* Function name : addprospectemail()

        * Description   : This function used add new  prospect emails tasks

        * Created On    : 06 Sep 2012

		*Created by 	: Puneet

	*/



	function addoffertask($recid = ''){



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

				

				//$this->data['CommunicationTask']['project_id'] = $project_id;

				$this->data['CommunicationTask']['email_template_type'] = '3';	

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

					//$this->pl($this->data);

					if(isset($this->data['CommunicationTask']['id'])){

              			$_project_id =  $this->data['CommunicationTask']['project_id'];

              		}else{

              			$_project_id = $project_id;

              		}

					$rec_id = $this->CommunicationTask->saveEmailTask($this->data['CommunicationTask'],$_project_id,'0');

				if($rec_id > 0 ){

						$this->Session->setFlash('Communication Task added Successfully.','default', array('class' => 'successmsg'				 						));

						if(isset($this->data['Action']['redirectpage'])){

							$this->redirect('/offers/tasklist');

						}else{

							$this->redirect('/offers/addoffertask/edit/'.$rec_id);

						}

					}else{

						$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));										 						}

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

			

			$this->getmailtemplates($projectid,'3');

			if(!empty($params)){

				$this->CommunicationTask->id = $params;

            	$this->data = $this->CommunicationTask->read();

				

		}

			//echo '<pre>';print_r($this->data);

			$this->set('project_id',$this->data['CommunicationTask']['project_id']);

			if($this->data['CommunicationTask']['task_startdate']){				

				 $this->data['CommunicationTask']['task_startdate'] = date("d-m-Y",strtotime($this->data['CommunicationTask']['task_startdate']));

					

				    //$this->set("sel_offerid",$offer_id_arr['0']);							

            }

			$this->set('event_rsvp',$this->getEventRSVPArray());

		    //Set Social Naetworks Array

			$this->set('social_networks',$this->getSocialNetworkArray());

            $this->set('recur_pattern',$this->getRecurPatternkArray());

		    //Get Event Drop Down

			if($this->data['CommunicationTask']['member_country']){

                $conid = $this->data['CommunicationTask']['member_country'];

                $this->set("selectedcountry",$conid);

                ##state drop down

				$this->statedroupdown($conid);

                if($this->data['CommunicationTask']['member_state']){

                    $statid = $this->data['CommunicationTask']['member_state'];

                    $this->set("selectedstate",$statid);

				}

            }

			//$this->set('sel_email_temp','');    

			//$this->pl($this->data);



			 if($this->data['CommunicationTask']['email_template_id]]']){

                   $this->set('sel_email_temp',$this->data['CommunicationTask']['email_template_id']);                   

			}

			$this->set('sel_nonprofittype','');    

			 if($this->data['CommunicationTask']['non_profit_type_id']){

			  $this->data['CommunicationTask']['non_profit_type_id'];

                   $this->set('sel_nonprofittype',$this->data['CommunicationTask']['non_profit_type_id']);                   

			}

				$this->set('sel_event','');    

			 if($this->data['CommunicationTask']['event_id']){

			  $this->data['CommunicationTask']['event_id'];

                   $this->set('sel_event',$this->data['CommunicationTask']['event_id']);                   

			}

			 if($this->data['CommunicationTask']['company_type]']){

                   $this->set('sel_companytypeid',$this->data['CommunicationTask']['company_type']);                   

			}

			$this->set('selectedcategory',''); 

			if($this->data['CommunicationTask']['category_id']){

                $conid = $this->data['CommunicationTask']['category_id'];

                $this->set("selectedcategory",$conid);

                ##category drop down

                $subcatid = $this->getcondSubCategoryDropdown($conid);

            }

			$this->set("sub_categories_drpdwn","");

			$this->set("selected_sub_category","");

			if($this->data['CommunicationTask']['sub_category_id']){

				##sub category drop down

				$this->set("sub_categories_drpdwn", $this->getSubCategoryDropdown($this->data['CommunicationTask']['category_id']));

				$this->set("selected_sub_category",$this->data['CommunicationTask']['sub_category_id']);

							

            }

			if($this->data['CommunicationTask']['offer_id']){				

					 $offer_id =  $this->data['CommunicationTask']['offer_id'];

					$offer_id_arr = explode('-',$offer_id);

				    $this->set("sel_offerid",$offer_id_arr['0']);							

            }

		}//end addprospectemail

	

	/*

	* Function name   : supermailtemplatelist()

	* Description : This function used to list Email Templates of super admin

	* Created On      : 12-12-11 (04:20pm)

	*

	*/

	function offertemplatelist(){			

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

		$field='';

		if(!empty($this->data))

		{

			//print_r($this->data);

			$searchkeyword=$this->data['offers']['searchkey'];

			

			 $condition = "EmailTemplate.project_id IN('0',$project_id) AND (EmailTemplate.email_template_name LIKE '%".$searchkeyword."%' OR EmailTemplate.subject LIKE '%".$searchkeyword."%') AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='1' AND email_template_type='3'";

			//echo $condition;

		}

		else

		{

			 $condition = "EmailTemplate.project_id IN('0','$project_id') AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem='1' AND email_template_type='3'";

		}



		$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination

		$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));

		list($order,$limit,$page) = $this->Pagination->init($condition,$field);

		$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

		##set EmailTemplate data in variable



		$this->set("emailtemplates",$emailtempdtlarr);

	}		

	

	/*

	 * Function name   : addoffertemplate()

	* Description : This function used to add new mail template by super admin

	* Created On      : 19-10-2012

	*

	*/

	function addoffertemplate($templateid=0,$returnurl=""){

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

				$projectDetails = $this->getprojectdetails($project_id);   

				$this->set('project',$projectDetails);          

				//$this->pl($projectDetails);

				$this->set('project',$projectDetails);         

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

				$projectDetails = $this->getprojectdetails($project_id);    

				//$this->pl($projectDetails);

				$this->set('project',$projectDetails);         

			}	   

		##import EmailTemplate  model for processing

		App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();		 

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

			if(isset($this->data['EmailTemplate']['id'])){

			}else{

				$this->data['EmailTemplate']['project_id'] = $project_id ;

			}

			$this->data['EmailTemplate']['is_inherit'] = '1';

			$this->data['EmailTemplate']['email_template_type'] = '3';

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

						//$this->pl($this->data);

					if($this->EmailTemplate->Save($this->data['EmailTemplate'])){



						$mailtempid = $this->EmailTemplate->getLastInsertId();



						if($returnurl!=""){						 

							$gotourl=str_replace("_id_", "/", $returnurl);					

						}else{

							$this->Session->setFlash('Template added Successfully.','default', array('class' => 'successmsg'));

							if(isset($this->data['Action']['redirectpage'])){

								$sessdata=$this->Session->read('newsortingby');

								$this->redirect(array('controller' => 'offers', 'action' =>'offertemplatelist'));

							}else{

								$this->redirect(array('controller' => 'offers', 'action' =>'addoffertemplate', $mailtempid));

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

		

		if($templateid > 0){

			$this->EmailTemplate->id = $templateid;

			$this->data = $this->EmailTemplate->read();

			$pid = $this->data['EmailTemplate']['project_id'];

			$this->set('pid',$pid);

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

	         if(isset($this->data['offers']['searchkey']) && $this->data['offers']['searchkey']){

	          $searchkeyword = $this->data['offers']['searchkey'];

	           $condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1' AND CommunicationTask.project_id IN('0','$project_id') AND CommunicationTask.email_template_type ='3' AND  (CommunicationTask.task_name LIKE '%".$searchkeyword."%' OR CommunicationTask.recur_pattern LIKE '%".$searchkeyword."%')";

            }else{

				$condition = "CommunicationTask.delete_status = '0' AND CommunicationTask.is_temp = '0'  AND CommunicationTask.send_event_invitation != '1'  AND CommunicationTask.project_id IN('0','$project_id') AND CommunicationTask.email_template_type ='3'";

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

			// $this->pl($this->data);

	         $this->set("taskdata",$taskdata);

            App::import("Model", "HelpContent");

	         $this->HelpContent =  & new HelpContent();

	         $condition = "HelpContent.id = '13'";

	         $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

	         $this->set("hlpdata",$hlpdata);

        }//end prospectemaillist

		

		

		function offertaskhistory(){

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

				$this->set('project_id',$projectid);

				$projectDetails=$this->getprojectdetails($projectid);

				$this->set('project',$projectDetails);

			}	

				# set help condition

				App::import("Model", "HelpContent");

				$this->HelpContent =  & new HelpContent();

				$condition = "HelpContent.id = '13'";

				$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

				$this->set("hlpdata",$hlpdata);

				# set help condition

		

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

        	if(isset($this->data['prospects']['searchkey']) && $this->data['prospects']['searchkey']){

        		$searchkeyword = $this->data['prospects']['searchkey'];

        		$condition = " EmailTemplate.email_template_type='3' AND CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."' AND (CommunicationTaskHistory.task_name LIKE '%".$searchkeyword."%' OR CommunicationTaskHistory.notes LIKE '%".$searchkeyword."%')";

        	}else{

        		  $condition = "EmailTemplate.email_template_type='3' AND CommunicationTaskHistory.delete_status = '0' and CommunicationTaskHistory.project_id='".$projectid."'";

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

			//$this->pl($taskdata);

        	##set project type data in variable

        	$this->set("taskdata",$taskdata);        	

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

			}	

           

               

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

        

        

        

       /*

        * Function name		: offerresponderlist()

        * Description 		: This function used to list Auto Responder of super admin

        * Created On		: 22-Oct-2012

        */

        

        function offerresponderlist(){

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

        	$field='';

        	if(!empty($this->data))

        	{

        		$searchkeyword=$this->data['offers']['searchkey'];

        		$condition = "EmailTemplate.project_id IN('0',$project_id) AND (EmailTemplate.email_template_name LIKE '%".$searchkeyword."%' OR EmailTemplate.subject LIKE '%".$searchkeyword."%') AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem = '0'  AND EmailTemplate.responder_type ='offer' ";

        	}

        	else

        	{

        		$condition = "EmailTemplate.project_id IN('0','$project_id') AND EmailTemplate.delete_status='0' AND EmailTemplate.is_sytem = '0' AND EmailTemplate.responder_type ='offer'";

        	}

        

        	$this->Pagination->sortByClass    = 'EmailTemplate'; ##initaite pagination

        	$this->Pagination->total= count($this->EmailTemplate->find('all',array("conditions"=>$condition)));

        	list($order,$limit,$page) = $this->Pagination->init($condition,$field);

        	$emailtempdtlarr = $this->EmailTemplate->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

        	##set EmailTemplate data in variable

        

        	$this->set("emailtemplates",$emailtempdtlarr);

        }

        

       

        /*

        * Function name		: addofferresponder()

        * Description 		: This function used to ADD Auto Responder of super admin

        * Created On		: 22-Oct-2012

        */

        

        function addofferresponder($templateid=0,$returnurl=""){

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

        	##import EmailTemplate  model for processing

        	App::import("Model", "EmailTemplate");

		$this->EmailTemplate =   & new EmailTemplate();

        		##check empty data

        	if(!empty($this->data)){

        		

        		$this->data['EmailTemplate']['subject'] = str_replace($project_name, "[[PROJECT_NAME]]",  $this->data['EmailTemplate']['subject']);

        		$this->data['EmailTemplate']['sender'] = str_replace($project_name.'.com', "[[Project Website Address]]",  $this->data['EmailTemplate']['sender']);

        		

        		

        	#set the posted data

        		$this->EmailTemplate->set($this->data);

        		#check server side validation

        		$errormsg = $this->EmailTemplate->invalidFields();

        		$templname = $this->data['EmailTemplate']['email_template_name'];

			$templateid = $this->data['EmailTemplate']['id'];

			if($templateid==0)

        			{

        			$this->data['EmailTemplate']['is_sytem'] = '0';

			}

			if(isset($this->data['EmailTemplate']['id'])){

				unset($this->data['EmailTemplate']['project_id']);	

			}else{

	        	$this->data['EmailTemplate']['project_id'] = $project_id ;

			}	

			$this->data['EmailTemplate']['is_inherit'] = '1';

			$this->data['EmailTemplate']['email_template_type'] = '3';

			// $returnurl=$this->data['Admins']['returnurl'];

        		if(!$errormsg){

        		$templname = $this->data['EmailTemplate']['email_template_name'];

        		if($templateid> 0)   {

        			$condition = "email_template_name = '".$templname."' AND project_id = '0' AND  delete_status = '0' AND id !='".$templateid."'  AND is_sytem = '0' AND responder_type ='offer' ";

				}else{

        			$condition = "email_template_name = '".$templname."' AND project_id = '0' AND  delete_status = '0' AND is_sytem = '0' AND responder_type ='offer'";

				}

			

				

				##check already exists EmailTemplate name

        			$ctdata = $this->EmailTemplate->find('all',array("conditions"=>$condition));

        			if(!$ctdata){

        

        			if($this->EmailTemplate->Save($this->data['EmailTemplate'])){

        

        			$mailtempid = $this->EmailTemplate->getLastInsertId();

        

        			if($returnurl!=""){

        			$gotourl=str_replace("_id_", "/", $returnurl);

        			}else{

        			$this->Session->setFlash('Template added Successfully.','default', array('class' => 'successmsg'));

							if(isset($this->data['Action']['redirectpage'])){

        									$sessdata=$this->Session->read('newsortingby');

        											$this->redirect(array('controller' => 'offers', 'action' =>'offerresponderlist'));

        											}else{

        													$this->redirect(array('controller' => 'offers', 'action' =>'addofferresponder', $mailtempid));

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

        						$pid = $this->data['EmailTemplate']['project_id'];

        						$this->set('pid',$pid);

			$isreadonly=(!empty($this->data))?'1':'0';

        			$this->set("isreadonly",$isreadonly);

        					if(!empty($errormsg)){

				$this->data['EmailTemplate']['content']="";

        			}

        				$selectedtemplatetype = $this->data['EmailTemplate']['email_template_type'];

        				

        				$this->data['EmailTemplate']['subject'] = str_replace("[[PROJECT_NAME]]", $project_name ,  	$this->data['EmailTemplate']['subject']);

        				$this->data['EmailTemplate']['sender'] = str_replace("[[Project Website Address]]", $project_name.".com", $this->data['EmailTemplate']['sender']);

        				

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

		

        //	$condition .= " AND (EmailTemplate.responder_type ='offer' OR EmailTemplate.override_all ='1')  " ;

			$condition .= " AND (EmailTemplate.responder_type ='offer')  " ;

     

     

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

        

        

        

        

        /*

         * Function name   : offerpages()

        * Description 	   : This function used to list content of Offer

        * Created On      : 22-Oct-2012

        */

        function offerpages(){

        	##check admin session live or not

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

			##import content  model for processing

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();							

			

			$this->Offer->bindModel(array('belongsTo'=>array(

				'Company'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.merchant_id  = Company.id'

            ))));

			

			   	if(!empty($this->data['Offers']['searchkey'])){

        		$val=$this->data['Offers']['searchkey'];				

        		$condition1 = "Offer.projectid = '$projectid' AND Offer.delete_status='0' AND (Offer. id =	offer_title LIKE '%".$val."%') AND (Offer.event_detail_page > 0 OR Offer.merchant_detail_page > 0  OR Offer.offer_inquiry_page > 0)";

        	}else{

        		$condition1 = "Offer.project_id = '$projectid' AND Offer.delete_status='0' AND ( Offer.event_detail_page > 0 OR Offer.merchant_detail_page > 0  OR Offer.offer_inquiry_page > 0)";

        	}					

			

				$this->Offer->bindModel(array('belongsTo'=>array(

				'Company'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.merchant_id  = Company.id'

            ))));

			

			$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

			$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition1)));

			list($order,$limit,$page) = $this->Pagination->init($condition1,$field);

		//	$limit = 100;

			

			

			$offerdtlarr = $this->Offer->find('all',array("conditions"=>$condition1, 'order' =>$order, 'limit' => $limit, 'page' => $page));

			$this->set("contentdata",$offerdtlarr);

			//$this->pl($offerdtlarr);





        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '15'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        }

		

	function otherpages(){

        	##check admin session live or not

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

			##import content  model for processing

			//$this->pl($this->params['pass']);

			if(isset($this->params['pass'])){				

					 $paramsVal = $this->params['pass']['0'];

					$this->set('paramsVal',$paramsVal);

			}

			

        	App::import("Model", "Offer");

        	$this->Offer =   & new Offer();							

			

			$this->Offer->bindModel(array('belongsTo'=>array(

				'Company'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.merchant_id  = Company.id'

            ))));

			

			

			if($paramsVal == "merchant"){

				 $fid = "merchant_detail_page";	

				 					

			}else if($paramsVal == "inquiry"){

				$fid = "offer_inquiry_page";						

			}else if($paramsVal == "event"){

				 $fid = "event_detail_page";						

			}

			$this->Offer->bindModel(array('belongsTo'=>array(

				'Content'=>array(

				'foreignKey'=>$fid

            ))));

			

			//$this->pl($this->data)

			

				if(isset($this->data['Offer']['searchkey']) && $this->data['Offer']['searchkey']){

			   		 $val=$this->data['Offer']['searchkey']; 

        		 $condition1 = "Offer.project_id = '$projectid' AND Offer.delete_status='0' AND (Content.title LIKE '%".$val."%' OR	Offer.offer_title LIKE '%".$val."%') AND ";

				//$this->set('paramsVal' ,$this->data['Offer']['paramsVal']);

        	}else{

        		$condition1 = "Offer.project_id = '$projectid' AND Offer.delete_status='0' AND ";

        	}

			

			if($paramsVal == trim("merchant")){

				 $condition1.= " Offer.merchant_detail_page > 0 ";						

			}else if($paramsVal == trim("inquiry")){

				 $condition1.= " Offer.offer_inquiry_page > 0 ";						

			}else if($paramsVal == trim("event")){

				 $condition1.= " Offer.event_detail_page > 0 ";						

			}

			

			$this->Offer->bindModel(array('belongsTo'=>array(

				'Company'=>array(

				'foreignKey'=>false,

				'conditions'=>'Offer.merchant_id  = Company.id'

            ))));

			$this->Offer->bindModel(array('belongsTo'=>array(

				'Content'=>array(

				'foreignKey'=>$fid

//				'conditions'=>'"'.$fid.'" = Content.id'

            ))));

			$this->Pagination->sortByClass    = 'Offer'; ##initaite pagination

			$this->Pagination->total= count($this->Offer->find('all',array("conditions"=>$condition1)));

			list($order,$limit,$page) = $this->Pagination->init($condition1,$field);

		//	$limit = 100;

			

			

			$offerdtlarr = $this->Offer->find('all',array("conditions"=>$condition1, 'order' =>$order, 'limit' => $limit, 'page' => $page));

			$this->set("contentdata",$offerdtlarr);

			//$this->pl($offerdtlarr);





        	# set help condition

        	App::import("Model", "HelpContent");

        	$this->HelpContent =  & new HelpContent();

        	$condition = "HelpContent.id = '15'";

        	$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

        	$this->set("hlpdata",$hlpdata);

        	# set help condition

        }

		

		

		function getcontentpagesbyajax($projectid, $selectedid='',$temp_type=''){ 

			

            $this->layout = false;

            

            $this->set("selectedid",$selectedid);

            

            if($temp_type=="event_detail" || $temp_type=="event_sponsor" || $temp_type=="event_inquiry")

            {

                $conditionsubmenu= "project_id = $projectid and delete_status='0' and parent_id='0' and ( alias!='blogs' AND  alias!='chat' AND  alias!='comments') and type='".$temp_type."'";

            }

            else

            {

            

            $conditionsubmenu= "project_id = $projectid and delete_status='0' and parent_id='0' and is_sytem!='2' and (   alias!='blogs' AND  alias!='chat' AND  alias!='comments')";

            }

            

            App::import("Model", 'Content');

            $this->Content =   & new Content();    

            $contentpages = $this->Content->find('all',array('fields' => array('Content.title','Content.id'),"conditions"=>$conditionsubmenu));

            $this->set('contentpages',$contentpages);           

        }       

	  

}

	

?>