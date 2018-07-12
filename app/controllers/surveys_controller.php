<?php 
    
   /* Project		  :-  Image coin website
    * Controller Name :-  admins_contoller.php
    * Created  On     :-  15-02-10 (10:00am)
    * Description     :-  This controller contains all the methods for tasks that will be 
    *                     managed by admin of website                        
    */

    class SurveysController extends AppController 
    {
        var $name = 'Surveys';
        //var $uses = 'CoinsHolder';
        var $layout = 'new_admin_layout';
        var $helpers = array('Tinymce','Pagination','Html', 'Form','Session','Qrcode','Javascript','Fck','Csv','csv','Common','Calendar');
        var $components = array('Email','Backup','EmailTemplates', 'ForceDownload', 'Cookie','Pagination','File','Sendemail','RequestHandler');
        var $uses  = array('Route','Point','Sponsor','Coinset','Holder','ProjectType','MailFooter','Content','SystemVersion','SystemPricing','PriceTypeOption','UserAgreement','SpamPolicy','Term','NonProfitType','MemberNonProfit','MemberCoin','TimeZone','Survey','SurveyQuestion','WpPost','SurveyResponse');

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
                $fields=array('project_name','system_name','url');
                $data=$this->Project->find("first",array("fields"=>$fields,"conditions"=>array("Project.id"=>$projectid)));
                $this->Session->write("projectwebsite_name_admin",$data['Project']['project_name']);
				$this->Session->write("projectwebsite_name",$data['Project']['system_name']);
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
        * Function name          : index()
        * Description            : This function redirect the admin to login page 
        * @session_check_admin() : This function is defined in app_controller to check the session expiration. 
        * Created On             : 15-02-11 (09:00pm)          
        */
        function index()
        {
			##check active session
			// $check = $this->session_check_usertype();
            $this->session_check_admin();
            $project_name=$this->Session->read("projectwebsite_name_admin");  
            //$this->set('current_project_name',$project_name);
            $this->set('page_url','index');
            ##set default selected
            $this->Session->delete('sessionprojectid');
            $this->set("selectedprojectid",'0');
            
            # set help condition
            $this->set("hlpdata",$getHelpContent('54'));
            # set help condition   
            
            $this->redirect(array('controller' => 'suerveys','action'=>'surveys_history'));
        }             
        
        /*
        * Function name   : changestatus()
        * Arguments : $recid,$modelname,$status,$methodname
        * Description : This function used to change status as active or deactive
        * Created On      : 16-02-11 (03:45am)
        *
        */ 
         function changestatus($recid=null,$status=null,$modalname=null,$redircturl=null,$action='cngstatus',$othermodel='',$otherid='',$param=''){


		if($status==2)
			$status =0;
		$this->session_check_admin();
		
		App::import("Model", $modalname);
		$this->$modalname =   & new $modalname();	
			
		 $allcompanyid=str_replace('*', ',',$recid);
		$cidArr = explode(',',$allcompanyid);
		$allid=str_replace('*', ' or id = ',$recid);
		$where="id=$allid";
			if(count(explode('*',$recid))==1){
				$this->data["$modelname"]['id'] = $recid;
			}
			$res = Set::enum('yes', array('no' => 0, 'yes' => 1));
 
			if($action =='delete'){
				$i=$this->$modalname->updateAll(array('delete_status'=>"'".$res."'"),$where);
				}
			else{
				$i=$this->$modalname->updateAll(array('active_status'=>"'".$status."'"),$where);
				}

			if($i){
				$this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));
			}

		$this->redirect(array('controller'=>'surveys','action'=>$redircturl));
	}//


        //*for  delete  content this is make seperate due to management of parent n child\

        function deletecontent($recid){
            App::import("Model", 'Content');
            $this->Content =   & new Content();    
            ##set the record for updation

            $alldeid=str_replace('*', ' or parent_id = ',$recid);              
            $parcond="parent_id=$alldeid and (delete_status='0' )"; 
            if(count(explode('*',$recid))==1){
                $parcond="parent_id=$alldeid and (delete_status='0' )"; 
            }
            $ptdata = $this->Content->find('all',array("conditions"=>$parcond));
            if(!empty($ptdata))
            {
                $this->Session->setFlash('Page to be deleted is Parent page for some pages. So manage them first.','default', array('class' => 'successmsg'));
                $this->redirect("contentlist/");
            }
            else
            {
                $allid=str_replace('*', ' or id = ',$recid);              
                $where="id=$allid";
                if(count(explode('*',$recid))==1){
                    $where="id=$recid"; 
                }

                if(count(explode('*',$recid))==1){
                    $this->data["Content"]['id'] = $recid;
                    $this->data["Content"]['delete_status'] = 1;

                    $i=$this->Content->Save($this->data["Content"]);
                }else{
                    $res = Set::enum('yes', array('no' => 0, 'yes' => 1));
                    $i=$this->Content->updateAll(array('delete_status'=>"'".$res."'"),$where);
                }

                if($i){
                    //print_r($i);exit;
                    $this->Session->setFlash('Database updated successfully.','default', array('class' => 'successmsg'));

                }else{
                    $this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
                }


                $this->redirect("contentlist/");

            }


        }


        /*
         *function name : surveylist()
        *description   : to do function show new enquiry listing
        */

        function surveylist(){
        		
        	$this->session_check_admin();
        	
        	$project_id = '1';
        	App::import("Model", "Survey");
        	$this->Survey =  & new Survey();
        	
        	if(isset($this->data['Surveys']['searchkey']) && $this->data['Surveys']['searchkey']){
        		$searchkeyword = $this->data['Surveys']['searchkey'];
        		$condition = " (Survey.survey_name LIKE '%".$searchkeyword."%' OR Survey.description LIKE '%".$searchkeyword."%')";
        	}else{
        		$condition = " Survey.delete_status = '0'  ";
        	}
        	
        	$this->Pagination->sortByClass    = 'Survey'; ##initaite pagination
        	
        	$this->Pagination->total= count($this->Survey->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition);
        	
        	$surveydata = $this->Survey->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

        	$this->set("surveydata",$surveydata);
        	$this->set("hlpdata",$this->getHelpContent(14));
        }
        
        
        function add_survey($recid=''){
        	
        	##check user session live or not
        	$this->session_check_admin();
        	##project id for each project
        	$project_id = '1';
        	$projectid = $project_id;
        	$this->set('projectid',$projectid);
        	$this->set("hlpdata",$this->getHelpContent(20));
        	 
        	App::import("Model", "Survey");
        	$this->Survey =  & new Survey();
        	
        	App::import("Model", "SurveyQuestion");
        	$this->SurveyQuestion =  & new SurveyQuestion();
        	
        	##check empty data
        	if(!empty($this->data)) {
        		
        		$this->Survey->set($this->data);
        		
        		if($this->Survey->Save($this->data['Survey'])){
        			
        			if($this->data['Survey']['id']){
        				 $lastsurveyid = $this->data['Survey']['id'];
        			}else{
        				 $lastsurveyid = $this->Survey->getLastInsertId();
        			}
        			
        			$strFormHtml="";
        			$strFormHtml="<table cellpadding='3' align='center' width='100%' style='background:#".$this->data['Survey']['bgcolor']."; color:#".$this->data['Survey']['textcolor']."'><tbody>";
        			$this->SurveyQuestion->deleteAll(array('SurveyQuestion.survey_id' => $lastsurveyid), false);
        			
        			for($i=0; $i<6; $i++){
        				
        				$SurveryQuestion =  array();
        				$SurveryQuestion['survey_id'] = $lastsurveyid;
        				$SurveryQuestion['include'] = $this->data['SurveyQuestion'][$i]['include'];
        				$SurveryQuestion['required'] = $this->data['SurveyQuestion'][$i]['required'];
        				$SurveryQuestion['question'] = $this->data['SurveyQuestion'][$i]['question'];
        				$SurveryQuestion['text'] = $this->data['SurveyQuestion'][$i]['text'];
        				$SurveryQuestion['list'] = $this->data['SurveyQuestion'][$i]['list'];
        				$SurveryQuestion['answer_option'] = $this->data['SurveyQuestion'][$i]['answer_option'];
						        				
        				$this->SurveyQuestion->create();
        				$this->SurveyQuestion->save($SurveryQuestion);        				
        				$lastsurveyquestionid = $this->SurveyQuestion->getLastInsertId();        				
        				$fld_req_html ='';
        				if($SurveryQuestion['include']){        					
        					$strFormHtml.="<tr>";
        					$fld_req_html = ($SurveryQuestion['required'])? "<span style='color: red;'>*</span>" : "";
        					$required = ($SurveryQuestion['required'])? "required" : "";
        					$strFormHtml.=" <td width='40%' align='right' valign='top'><label class='boldlabel'>".$SurveryQuestion['question'].$fld_req_html."</label></td>";
        					if($SurveryQuestion['text']){
        						$strFormHtml.="<td width='60%'><span class='intpSpan'> ";
        						$strFormHtml.="<input type='text' id='".$i."' name='".$i."' class='inpt_txt_fld ".$required."' /></span></td>";
							}
        					if($SurveryQuestion['list']){
        						$strFormHtml.="<td width='60%'><span class='intpSpan'><span class='inptSpn_rht'>";
        						$strFormHtml.="<select name='".$i."' id='".$i."' empty='' class='inpt_sel_fld dropdown_class multi ".$required."'>";
        						$strFormHtml.="<option value=''>Select Options</option>";
        						
        						$order   = array("\r\n", "\n", "\r");
        						$lst_fld_options= str_replace($order, "#", $SurveryQuestion['answer_option']);
        						$option_lines = explode("#",$lst_fld_options);
        						for($l=0; $l < sizeof($option_lines); $l++){
        							$strFormHtml.="  <option value='".$option_lines[$l]."'>".$option_lines[$l]."</option>";
        						}
        						$strFormHtml.="</select></span><span></td>";
        					}
        					$strFormHtml.="</tr>";
        				}
        			}
        			$strFormHtml.="</tbody></table>";
        			$this->data['SurveyForm']['form_html'] =$strFormHtml;
        			$this->Survey->id = $lastsurveyid;
        			if($this->Survey->save($this->data['SurveyForm'])){
        				if($this->data['Survey']['id']){
        					$this->Session->setFlash('Survey Form Modified Successfully.','default', array('class' => 'successmsg'));
        				}else{
        					$this->Session->setFlash('Survey Form Added Successfully.','default', array('class' => 'successmsg'));
        				}
        				
        				if(isset($this->data['Action']['redirectpage'])){
        					$this->redirect("/surveys/surveylist");
        				}else{
        					$this->redirect("/surveys/add_survey");
        				}	 
        			}	
        		}	
        	}
        	
        	$this->set('selectedtemplateresponce',"");
        	$this->set('selectedstatustype',"");
        	$this->set('selectedtemplateproj',"");
        	$this->set('sel_responder','');
        	$this->set('sel_webpage','');
        	$this->set('sel_template','');
        	$this->set('sel_type','email');
        	$this->set('sel_included', '');
        	$this->set('sel_required', '');
        	$this->set('sel_text', '');
        	$this->set('sel_list', '');
        	$this->set('respondar', '');
        	$this->set('template', '');
        	$this->set('webpage', '');
        	
        	if($recid){ // Read form type data and set it
        		$this->Survey->id = $recid;
        		
        		$this->Survey->bindModel(array('hasMany'=>array(
        				'SurveyQuestion'=>array(
        						'foreignKey'=>'survey_id'
        		))));
        		
        		$this->data = $this->Survey->read(); 
        		$this->set('sel_responder',$this->data['Survey']['responder']);
        		$this->set('sel_template',$this->data['Survey']['template']);
        		$this->set('sel_webpage',$this->data['Survey']['webpage']);
        		$this->set('sel_type',$this->data['Survey']['survey_type']);
        	}

        	// GET ALL CUSTOM EMAIL TEMPLATES
        	$this->getRespondorlist();
        	$this->customtemplatelisting();
        	$this->getWebPageFromWP();
        }
        
        
        function surveyactionlist($recid=0){
        
        	$this->session_check_admin();
        	
        	$project_id = '1';
        	App::import("Model", "SurveyAction");
        	$this->SurveyAction =  & new SurveyAction();
        	
        	if(isset($this->data['Surveys']['searchkey']) && $this->data['Surveys']['searchkey']){
        		$searchkeyword = $this->data['Surveys']['searchkey'];
        		$condition = " (SurveyAction.action_title LIKE '%".$searchkeyword."%')";
        	}else{
        		$condition = " SurveyAction.delete_status = '0'  ";
        	}
        	
        	$this->Pagination->sortByClass    = 'SurveyAction'; ##initaite pagination
        	
        	$this->Pagination->total= count($this->SurveyAction->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition);
        	
        	$surveyactiondata = $this->SurveyAction->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));

        	$this->set("surveyactiondata",$surveyactiondata);
        	$this->set("hlpdata",$this->getHelpContent(14));
        				 
        }
        
        function survey_action($recid=0){

        	##check user session live or not
        	$this->session_check_admin();
        	##project id for each project
        	$project_id = '1';
        	$projectid = $project_id;
        	$this->set('projectid',$projectid);
        	$this->set("hlpdata",$this->getHelpContent(20));
        	
        	App::import("Model", "SurveyAction");
        	$this->SurveyAction =  & new SurveyAction();
        	 
        	##check empty data
        	if(!empty($this->data)) {
        		
        		$this->SurveyAction->set($this->data);
        		
        		$this->SurveyAction->invalidFields();
        		
        		if(!empty($this->data['SurveyAction']['id'])){
        			$this->SurveyAction->id =$this->data['SurveyAction']['id']; 
        		}
        		
        		if($this->SurveyAction->save($this->data['SurveyAction'])){
        			if(empty($this->data['SurveyAction']['id']))
        				$this->Session->setFlash('Action added Successfully.','default', array('class' => 'successmsg'));
        			else
        				$this->Session->setFlash('Action updated Successfully.','default', array('class' => 'successmsg'));
        			$this->redirect('/surveys/surveyactionlist');
        		}else{
        			$this->Session->setFlash('Error in processing. Please try again','default',array('class' => 'msgTXt'));
        			$this->redirect('/surveys/survey_action');
        		}
        	}
        	
        	if(!empty($recid)){
        		$this->SurveyAction->id = $recid;
        		$this->data = $this->SurveyAction->read();
        	}
        }
        
        
        function survey_history(){
        
        	$this->session_check_admin();
        	 
        	$project_id = '1';
        	App::import("Model", "Survey");
        	$this->Survey =  & new Survey();
        	 
        	if(isset($this->data['Surveys']['searchkey']) && $this->data['Surveys']['searchkey']){
        		$searchkeyword = $this->data['Surveys']['searchkey'];
        		$condition = " (Survey.survey_name LIKE '%".$searchkeyword."%' OR Survey.description LIKE '%".$searchkeyword."%' OR EmailTemplate.email_template_name LIKE '%".$searchkeyword."%' ) AND  Survey.delete_status = '0' ";
        	}else{
        		$condition = " Survey.delete_status = '0'  ";
        	}
        	 
        	$this->Pagination->sortByClass    = 'Survey'; ##initaite pagination
        	 
        	

        	$this->Survey->bindModel(array('belongsTo'=>array(
        			'EmailTemplate'=>array(
        					'foreignKey'=>'template'
        			),
        			'WpPost'=>array(
        					'foreignKey'=>'webpage'
        			)
        	)));
        	
        	$this->Pagination->total= count($this->Survey->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition);

        	$this->Survey->bindModel(array('belongsTo'=>array(
        			'EmailTemplate'=>array(
        					'foreignKey'=>'template'
        			),
        			'WpPost'=>array(
        					'foreignKey'=>'webpage'
        			)
        	)));

        	$surveyhistorydata = $this->Survey->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        	$this->set("surveyhistorydata",$surveyhistorydata);
        	$this->set("hlpdata",$this->getHelpContent(14));
        }
        
        function download_survey_history(){
        
        	$this->session_check_admin();
        
        	$project_id = '1';
        	$this->layout = null;
        	$this->autoLayout = false;
        	App::import("Model", "Survey");
        	$this->Survey =  & new Survey();
        
        	if(isset($this->data['Surveys']['searchkey']) && $this->data['Surveys']['searchkey']){
        		$searchkeyword = $this->data['Surveys']['searchkey'];
        		$condition = " (Survey.survey_name LIKE '%".$searchkeyword."%' OR Survey.description LIKE '%".$searchkeyword."%') AND  Survey.delete_status = '0' ";
        	}else{
        		$condition = " Survey.delete_status = '0'  ";
        	}
       
        
        	$this->Survey->bindModel(array('belongsTo'=>array(
        			'EmailTemplate'=>array(
        					'foreignKey'=>'template'
        			),
        			'WpPost'=>array(
        					'foreignKey'=>'webpage'
        			)
        	)));
        	 
        	$surveyhistorydata = $this->Survey->find('all',array("conditions"=>$condition));
        	$this->set("surveyhistorydata",$surveyhistorydata);
        }
        
        
        function survey_response($recid = 0){
        
        	$this->session_check_admin();
        	
        	$project_id = '1';
        	App::import("Model", "SurveyResponse");
        	$this->SurveyResponse =  & new SurveyResponse();
        
        	if(isset($this->data['Surveys']['searchkey']) && $this->data['Surveys']['searchkey']){
        		$searchkeyword = $this->data['Surveys']['searchkey'];
        		$condition = " (Survey.survey_name LIKE '%".$searchkeyword."%' OR Survey.description LIKE '%".$searchkeyword."%') AND  SurveyResponse.delete_status = '0' ";
        	}else{
        		$condition = " SurveyResponse.delete_status = '0'  ";
        	}
        	
        	$condition .= " AND SurveyResponse.survey_id = '".$recid."'";
        
        	$this->Pagination->sortByClass    = 'SurveyResponse'; ##initaite pagination
        
        	$this->SurveyResponse->bindModel(array('belongsTo'=>array(
        			'Holder'=>array(
        					'foreignKey'=>'member_id'
        			),
        			'Survey'=>array(
        					'foreignKey'=>'survey_id'
        			)
        	)));
        	
        	$this->Pagination->total= count($this->SurveyResponse->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition);
        
        	$this->SurveyResponse->bindModel(array('belongsTo'=>array(
        			'Holder'=>array(
        					'foreignKey'=>'member_id'
        			),
        			'Survey'=>array(
        					'foreignKey'=>'survey_id'
        			)
        	)));
        		
        	
        	$surveyresponse = $this->SurveyResponse->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        	$this->set("surveyresponsedata",$surveyresponse);
        	$this->set("survey_id",$recid);
        	$this->set("hlpdata",$this->getHelpContent(14));
        }
        
        
        function download_survey_response($recid = 0){
        
        	$this->session_check_admin();
        	 
        	$project_id = '1';
        	$this->layout = null;
        	$this->autoLayout = false;
        	App::import("Model", "SurveyResponse");
        	$this->SurveyResponse =  & new SurveyResponse();
        
        	if(isset($this->data['Surveys']['searchkey']) && $this->data['Surveys']['searchkey']){
        		$searchkeyword = $this->data['Surveys']['searchkey'];
        		$condition = " (Survey.survey_name LIKE '%".$searchkeyword."%' OR Survey.description LIKE '%".$searchkeyword."%') AND  SurveyResponse.delete_status = '0' ";
        	}else{
        		$condition = " SurveyResponse.delete_status = '0'  ";
        	}
        	 
        	$condition .= " AND SurveyResponse.survey_id = '".$recid."'";
        	        
        	$this->SurveyResponse->bindModel(array('belongsTo'=>array(
        			'Holder'=>array(
        					'foreignKey'=>'member_id'
        			),
        			'Survey'=>array(
        					'foreignKey'=>'survey_id'
        			)
        	)));
        
        	$surveyresponse = $this->SurveyResponse->find('all',array("conditions"=>$condition));
        	$this->set("surveyresponsedata",$surveyresponse);
        }
        
        
        function surveyresponse($recid = 0){
        
        	$this->session_check_admin();
        
        	$project_id = '1';
        	App::import("Model", "SurveyResponse");
        	$this->SurveyResponse =  & new SurveyResponse();

        	if(!empty($this->data)){
        		$this->SurveyResponse->set($this->data);
        		if($this->SurveyResponse->save($this->data)){
        			$this->Session->setFlash('Survey action updated Successfully.','default', array('class' => 'successmsg'));
        		}else{
        			$this->Session->setFlash('Error In Processing.','default', array('class' => 'msgTXt'));
        		}
        	}
        	
        	$condition = " SurveyResponse.id = '".$recid."'";        
        	$this->Pagination->sortByClass    = 'SurveyResponse'; ##initaite pagination
        	
        	$this->SurveyResponse->bindModel(array('belongsTo'=>array(
		        	'Holder'=>array(
		        	'foreignKey'=>'member_id'
		        	),
        			'Survey'=>array(
        			'foreignKey'=>'survey_id'
        			)
        					 
        	)));
        	 
        	$this->Pagination->total= count($this->SurveyResponse->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition);
        
        	$this->SurveyResponse->bindModel(array('belongsTo'=>array(
        			'Holder'=>array(
        					'foreignKey'=>'member_id'
        			),
        			'Survey'=>array(
        					'foreignKey'=>'survey_id'
        			)
        	)));
        	
        	$this->Survey->bindModel(array('hasMany'=>array(
        			'SurveyQuestion'=>array(
        				'foreignKey'=>'survey_id'
        	))));
        	
        	$this->SurveyResponse->recursive = 2;
        	
        	$surveyresponse = $this->SurveyResponse->find('first',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        	$this->data = $surveyresponse; 
        	$this->getSurveyActions();
        	$this->set("survey_id",$this->data['SurveyResponse']['survey_id']);
        	$this->set("hlpdata",$this->getHelpContent(14));
        }
        
        function surveybyaction($recid = 0){
        	$this->session_check_admin();
        	$project_id = '1';
        	App::import("Model", "SurveyResponse");
        	$this->SurveyResponse =  & new SurveyResponse();

        	if(isset($this->data['Surveys']['searchkey']) && $this->data['Surveys']['searchkey']){
        		$searchkeyword = $this->data['Surveys']['searchkey'];
        		$condition = " (SurveyAction.action_title LIKE '%".$searchkeyword."%' OR Holder.firstname LIKE '%".$searchkeyword."%' OR Holder.lastnameshow LIKE '%".$searchkeyword."%' OR Holder.city LIKE '%".$searchkeyword."%') AND  SurveyResponse.delete_status = '0' ";
        	}else{
        		$condition = " SurveyResponse.delete_status = '0'  ";
        	}
        	
        	$condition .= " AND SurveyResponse.action != '0'  ";        
        	$this->Pagination->sortByClass    = 'SurveyResponse'; ##initaite pagination
        
        	$this->SurveyResponse->bindModel(array('belongsTo'=>array(
        			'Holder'=>array(
        					'foreignKey'=>'member_id'
        			),
        			'Survey'=>array(
        					'foreignKey'=>'survey_id'
        			),
        			'SurveyAction'=>array(
        					'foreignKey'=>'action'
        			)
        	)));
        	
        	$this->Pagination->total= count($this->SurveyResponse->find('all',array("conditions"=>$condition)));
        	list($order,$limit,$page) = $this->Pagination->init($condition);
        
        	$this->SurveyResponse->bindModel(array('belongsTo'=>array(
        			'Holder'=>array(
        					'foreignKey'=>'member_id'
        			),
        			'Survey'=>array(
        					'foreignKey'=>'survey_id'
        			),
        			'SurveyAction'=>array(
        					'foreignKey'=>'action'
        			)
        	)));
        		
        	
        	$surveyresponse = $this->SurveyResponse->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page));
        	$this->set("surveyresponsedata",$surveyresponse);
        	$this->set("survey_id",$recid);
        	$this->set("hlpdata",$this->getHelpContent(14));
        }
        
    }
?>