<?php

class EmailTemplatesComponent {

   var $emailtempname="";
   var $dataElementArray=array();
   var $dataElementValuesArray=array();
   const EMAIL_UNSUBSCRIPTION_LINK_HTML ='<a href="[[EMAIL_UNSUBSCRIPTION_URL]]"> Email Subscription Setting </a> ';
   
   
   
     
     function initEmailTemplDataElemntsArray($projectId='', $projectDetails='', $toHolderEmailAddress='', $userType="Holder") {  
         //STEP : DEFINE CONSTANTS FOR EACH DATA ELEMENT 
         //NOTE : WHENEVER ADD NEW CONSTANT, ADD THE SAME AT   $dataElementArray ARRAY and   $dataValuesArray ARRAY
           // BASIC DATA ELEMENTS 
           define("DATA_ELEMENT_PROJECT_NAME","PROJECT_NAME");                  //b Element
           define("DATA_ELEMENT_PROJECT_HOMEPAGE_URL","PROJECT_HOMEPAGE_URL");  //b Element  
           define("DATA_ELEMENT_PROJECT_PRIVACYPAGE_URL","PROJECT_PRIVACYPAGE_URL");  //b Element   - privacy page url 
           define("DATA_ELEMENT_PROJECT_ADDRESS1","PROJECT_ADDRESS1");  //b Element        - project address 1
           define("DATA_ELEMENT_PROJECT_ADDRESS2","PROJECT_ADDRESS2");  //b Element         - project address 2
           define("DATA_ELEMENT_PROJECT_CITY","PROJECT_CITY");  //b Element                 - project city
           define("DATA_ELEMENT_PROJECT_STATE","PROJECT_STATE");  //b Element               - project state 
           define("DATA_ELEMENT_PROJECT_ZIP","PROJECT_ZIP");  //b Element                   - project zip
           define("DATA_ELEMENT_SENT_TO_ADDRESSEE_EMAIL","SENT_TO_ADDRESSEE_EMAIL");              //b Element   for sent to addressee email address
           //define("DATA_ELEMENT_SENT_BY_EMAIL","SENT_BY_EMAIL");              //b Element   for sent by email address
             
           define("DATA_ELEMENT_CONFIRM_SIGN_UP_LINK","CONFIRM_SIGN_UP_LINK");               
           define("DATA_ELEMENT_TO_MEMBER_NAME","TO_MEMBER_NAME");              //b Element   
           define("DATA_ELEMENT_TO_MEMEBR_EMAIL","TO_MEMEBR_EMAIL");            //b Element   
           define("DATA_ELEMENT_OTHER_MEMEBR_NAME","OTHER_MEMEBR_NAME");  
           define("DATA_ELEMENT_OTHER_MEMEBR_EMAIL","OTHER_MEMEBR_EMAIL");  
           define("DATA_ELEMENT_PROJECT_OWNER_NAME","PROJECT_OWNER_NAME");      //b Element   
           define("DATA_ELEMENT_PROJECT_OWNER_EMAIL","PROJECT_OWNER_EMAIL");    //b Element   
           define("DATA_ELEMENT_USER_NAME","USER_NAME");  
           define("DATA_ELEMENT_USER_PASSWORD","USER_PASSWORD");  
           define("DATA_ELEMENT_COIN_SERIAL","COIN_SERIAL");  
           define("DATA_ELEMENT_COMMENT","COMMENT");  
           define("DATA_ELEMENT_COMMENT_LINK","COMMENT_LINK");  
           define("DATA_ELEMENT_REPLY","REPLY");  
           define("DATA_ELEMENT_MESSAGE","MESSAGE");  
           define("DATA_ELEMENT_COIN_REGISTRATION_DATE","COIN_REGISTRATION_DATE");  
           //MEMBER DATA ELEMENTS    //b Element  
           define("DATA_ELEMENT_MEMBER_FIRSTNAME","MEMBER_FIRSTNAME");  
           define("DATA_ELEMENT_MEMBER_LASTNAME","MEMBER_LASTNAME");  
           define("DATA_ELEMENT_MEMBER_ADDRESS1","MEMBER_ADDRESS1");  
           define("DATA_ELEMENT_MEMBER_ADDRESS2","MEMBER_ADDRESS2");  
           define("DATA_ELEMENT_MEMBER_CITY","MEMBER_CITY");  
           define("DATA_ELEMENT_MEMBER_STATE","MEMBER_STATE");  
           define("DATA_ELEMENT_MEMBER_ZIP","MEMBER_ZIP");  
           define("DATA_ELEMENT_MEMBER_COUNTRY","MEMBER_COUNTRY");  
           define("DATA_ELEMENT_MEMBER_PHONE","MEMBER_PHONE");  
           // CONTACT DATA ELEMENTS    //iframe form  Element  
           define("DATA_ELEMENT_CONTACT_FIRSTNAME","CONTACT_FIRSTNAME");
           define("DATA_ELEMENT_CONTACT_LASTNAME","CONTACT_LASTNAME");
           define("DATA_ELEMENT_CONTACT_ADDRESS1","CONTACT_ADDRESS1");
           define("DATA_ELEMENT_CONTACT_ADDRESS2","CONTACT_ADDRESS2");
           define("DATA_ELEMENT_CONTACT_CITY","CONTACT_CITY");
           define("DATA_ELEMENT_CONTACT_STATE","CONTACT_STATE");
           define("DATA_ELEMENT_CONTACT_ZIP","CONTACT_ZIP");
           define("DATA_ELEMENT_CONTACT_COUNTRY","CONTACT_COUNTRY");
           define("DATA_ELEMENT_CONTACT_PHONE","CONTACT_PHONE");
           define("DATA_ELEMENT_CONTACT_EMAIL","CONTACT_EMAIL");
           define("DATA_ELEMENT_CONTACT_COMPANY","CONTACT_COMPANY");
           define("DATA_ELEMENT_CONTACT_TITLE","CONTACT_TITLE");
           
           // EMAIL UN_SUBSCRIPTION BUTTON 
           define("DATA_ELEMENT_EMAIL_UNSUBSCRIPTION_LINK","EMAIL_UNSUBSCRIPTION_LINK");      
           define("DATA_ELEMENT_INVITE_LINK_BACK","INVITE_LINK_BACK");      
           define("DATA_ELEMENT_INVITE_SENDER_NAME","SENDER_NAME");      
        //   define("DATA_ELEMENT_EMAIL_UNSUBSCRIPTION_URL","EMAIL_UNSUBSCRIPTION_URL");      
           
           
           //STEP : INIT DATA ELEMENTS ARRAY   
           $this->dataElementArray=array(
                DATA_ELEMENT_PROJECT_NAME           =>  '[['.DATA_ELEMENT_PROJECT_NAME.']]',
                DATA_ELEMENT_PROJECT_HOMEPAGE_URL   =>  '[['.DATA_ELEMENT_PROJECT_HOMEPAGE_URL.']]',
                DATA_ELEMENT_PROJECT_PRIVACYPAGE_URL   =>  '[['.DATA_ELEMENT_PROJECT_PRIVACYPAGE_URL.']]',
                DATA_ELEMENT_PROJECT_ADDRESS1   =>  '[['.DATA_ELEMENT_PROJECT_ADDRESS1.']]',
                DATA_ELEMENT_PROJECT_ADDRESS2   =>  '[['.DATA_ELEMENT_PROJECT_ADDRESS2.']]',
                DATA_ELEMENT_PROJECT_CITY   =>  '[['.DATA_ELEMENT_PROJECT_CITY.']]',
                DATA_ELEMENT_PROJECT_STATE   =>  '[['.DATA_ELEMENT_PROJECT_STATE.']]',
                DATA_ELEMENT_PROJECT_ZIP   =>  '[['.DATA_ELEMENT_PROJECT_ZIP.']]',
                DATA_ELEMENT_SENT_TO_ADDRESSEE_EMAIL   =>  '[['.DATA_ELEMENT_SENT_TO_ADDRESSEE_EMAIL.']]',
                DATA_ELEMENT_CONFIRM_SIGN_UP_LINK   =>  '[['.DATA_ELEMENT_CONFIRM_SIGN_UP_LINK.']]',
                DATA_ELEMENT_TO_MEMBER_NAME         =>  '[['.DATA_ELEMENT_TO_MEMBER_NAME.']]',
                DATA_ELEMENT_TO_MEMEBR_EMAIL        =>  '[['.DATA_ELEMENT_TO_MEMEBR_EMAIL.']]',
                DATA_ELEMENT_OTHER_MEMEBR_NAME      =>  '[['.DATA_ELEMENT_OTHER_MEMEBR_NAME.']]',
                DATA_ELEMENT_OTHER_MEMEBR_EMAIL     =>  '[['.DATA_ELEMENT_OTHER_MEMEBR_EMAIL.']]',
                DATA_ELEMENT_PROJECT_OWNER_NAME     =>  '[['.DATA_ELEMENT_PROJECT_OWNER_NAME.']]',
                DATA_ELEMENT_PROJECT_OWNER_EMAIL    =>  '[['.DATA_ELEMENT_PROJECT_OWNER_EMAIL.']]',
                DATA_ELEMENT_USER_NAME              =>  '[['.DATA_ELEMENT_USER_NAME.']]',
                DATA_ELEMENT_USER_PASSWORD          =>  '[['.DATA_ELEMENT_USER_PASSWORD.']]',
                DATA_ELEMENT_COIN_SERIAL            =>  '[['.DATA_ELEMENT_COIN_SERIAL.']]',
                DATA_ELEMENT_COMMENT                =>  '[['.DATA_ELEMENT_COMMENT.']]',
                DATA_ELEMENT_COMMENT_LINK           =>  '[['.DATA_ELEMENT_COMMENT_LINK.']]',
                DATA_ELEMENT_REPLY                  =>  '[['.DATA_ELEMENT_REPLY.']]',
                DATA_ELEMENT_MESSAGE                =>  '[['.DATA_ELEMENT_MESSAGE.']]',
                DATA_ELEMENT_COIN_REGISTRATION_DATE =>  '[['.DATA_ELEMENT_COIN_REGISTRATION_DATE.']]',
                DATA_ELEMENT_MEMBER_FIRSTNAME       =>  '[['.DATA_ELEMENT_MEMBER_FIRSTNAME.']]',
                DATA_ELEMENT_MEMBER_LASTNAME        =>  '[['.DATA_ELEMENT_MEMBER_LASTNAME.']]' ,
                DATA_ELEMENT_MEMBER_ADDRESS1        =>  '[['.DATA_ELEMENT_MEMBER_ADDRESS1.']]' ,
                DATA_ELEMENT_MEMBER_ADDRESS2        =>  '[['.DATA_ELEMENT_MEMBER_ADDRESS2.']]' ,
                DATA_ELEMENT_MEMBER_CITY            =>  '[['.DATA_ELEMENT_MEMBER_CITY.']]' ,
                DATA_ELEMENT_MEMBER_STATE           =>  '[['.DATA_ELEMENT_MEMBER_STATE.']]' ,
                DATA_ELEMENT_MEMBER_ZIP             =>  '[['.DATA_ELEMENT_MEMBER_ZIP.']]' ,
                DATA_ELEMENT_MEMBER_COUNTRY         =>  '[['.DATA_ELEMENT_MEMBER_COUNTRY.']]' ,
                DATA_ELEMENT_MEMBER_PHONE           =>  '[['.DATA_ELEMENT_MEMBER_PHONE.']]' ,
                DATA_ELEMENT_CONTACT_FIRSTNAME      =>  '[['.DATA_ELEMENT_CONTACT_FIRSTNAME.']]',
                DATA_ELEMENT_CONTACT_LASTNAME       =>  '[['.DATA_ELEMENT_CONTACT_LASTNAME.']]' ,
                DATA_ELEMENT_CONTACT_ADDRESS1       =>  '[['.DATA_ELEMENT_CONTACT_ADDRESS1.']]' ,
                DATA_ELEMENT_CONTACT_ADDRESS2       =>  '[['.DATA_ELEMENT_CONTACT_ADDRESS2.']]' ,
                DATA_ELEMENT_CONTACT_CITY           =>  '[['.DATA_ELEMENT_CONTACT_CITY.']]' ,
                DATA_ELEMENT_CONTACT_STATE          =>  '[['.DATA_ELEMENT_CONTACT_STATE.']]' ,
                DATA_ELEMENT_CONTACT_ZIP            =>  '[['.DATA_ELEMENT_CONTACT_ZIP.']]' ,
                DATA_ELEMENT_CONTACT_COUNTRY        =>  '[['.DATA_ELEMENT_CONTACT_COUNTRY.']]' ,
                DATA_ELEMENT_CONTACT_PHONE          =>  '[['.DATA_ELEMENT_CONTACT_PHONE.']]' ,
                DATA_ELEMENT_CONTACT_EMAIL          =>  '[['.DATA_ELEMENT_CONTACT_EMAIL.']]' ,
                DATA_ELEMENT_CONTACT_COMPANY        =>  '[['.DATA_ELEMENT_CONTACT_COMPANY.']]' ,
                DATA_ELEMENT_CONTACT_TITLE          =>  '[['.DATA_ELEMENT_CONTACT_TITLE.']]'  ,
                DATA_ELEMENT_EMAIL_UNSUBSCRIPTION_LINK          =>  '[['.DATA_ELEMENT_EMAIL_UNSUBSCRIPTION_LINK.']]' ,
                DATA_ELEMENT_INVITE_LINK_BACK          =>  '[['.DATA_ELEMENT_INVITE_LINK_BACK.']]', 
                DATA_ELEMENT_INVITE_SENDER_NAME          =>  '[['.DATA_ELEMENT_INVITE_SENDER_NAME.']]' 
                
           );
           
           //STEP : INIT DATA ELEMENT VALUES ARRAY WITH NULL('')  VALUE
           $this->dataElementValuesArray=array(
           
                DATA_ELEMENT_PROJECT_NAME           =>  '' ,
                DATA_ELEMENT_PROJECT_HOMEPAGE_URL   =>  '' ,
                DATA_ELEMENT_PROJECT_PRIVACYPAGE_URL   =>  '' ,
                DATA_ELEMENT_PROJECT_ADDRESS1   =>  '' ,
                DATA_ELEMENT_PROJECT_ADDRESS2   =>  '' ,
                DATA_ELEMENT_PROJECT_CITY   =>  '' ,
                DATA_ELEMENT_PROJECT_STATE   =>  '' ,
                DATA_ELEMENT_PROJECT_ZIP   =>  '' ,
                DATA_ELEMENT_SENT_TO_ADDRESSEE_EMAIL=>  '' ,            //DATA_ELEMENT_SENT_BY_EMAIL   =>  '' ,       it is replaces at sendMailContentWithCC function
                DATA_ELEMENT_CONFIRM_SIGN_UP_LINK   =>  '' ,          
                DATA_ELEMENT_TO_MEMBER_NAME         =>  '' ,
                DATA_ELEMENT_TO_MEMEBR_EMAIL        =>  '' ,
                DATA_ELEMENT_OTHER_MEMEBR_NAME      =>  '' ,
                DATA_ELEMENT_OTHER_MEMEBR_EMAIL     =>  '' ,
                DATA_ELEMENT_PROJECT_OWNER_NAME     =>  '' ,
                DATA_ELEMENT_PROJECT_OWNER_EMAIL    =>  '' ,
                DATA_ELEMENT_USER_NAME              =>  '' ,
                DATA_ELEMENT_USER_PASSWORD          =>  '' ,
                DATA_ELEMENT_COIN_SERIAL            =>  '' ,
                DATA_ELEMENT_COMMENT                =>  '' ,
                DATA_ELEMENT_COMMENT_LINK           =>  '' ,
                DATA_ELEMENT_REPLY                  =>  '' ,
                DATA_ELEMENT_MESSAGE                =>  '' ,
                DATA_ELEMENT_COIN_REGISTRATION_DATE =>  '' ,
                DATA_ELEMENT_MEMBER_FIRSTNAME       =>  '' ,
                DATA_ELEMENT_MEMBER_LASTNAME        =>  '' ,
                DATA_ELEMENT_MEMBER_ADDRESS1        =>  '' ,
                DATA_ELEMENT_MEMBER_ADDRESS2        =>  '' ,
                DATA_ELEMENT_MEMBER_CITY            =>  '' ,
                DATA_ELEMENT_MEMBER_STATE           =>  '' ,
                DATA_ELEMENT_MEMBER_ZIP             =>  '' ,
                DATA_ELEMENT_MEMBER_COUNTRY         =>  '' ,
                DATA_ELEMENT_MEMBER_PHONE           =>  '' ,
                DATA_ELEMENT_CONTACT_FIRSTNAME      =>  '' ,
                DATA_ELEMENT_CONTACT_LASTNAME       =>  '' ,
                DATA_ELEMENT_CONTACT_ADDRESS1       =>  '' ,
                DATA_ELEMENT_CONTACT_ADDRESS2       =>  '' ,
                DATA_ELEMENT_CONTACT_CITY           =>  '' ,
                DATA_ELEMENT_CONTACT_STATE          =>  '' ,
                DATA_ELEMENT_CONTACT_ZIP            =>  '' ,
                DATA_ELEMENT_CONTACT_COUNTRY        =>  '' ,
                DATA_ELEMENT_CONTACT_PHONE          =>  '' ,
                DATA_ELEMENT_CONTACT_EMAIL          =>  '' ,
                DATA_ELEMENT_CONTACT_COMPANY        =>  '' ,
                DATA_ELEMENT_CONTACT_TITLE          =>  ''  ,
                DATA_ELEMENT_EMAIL_UNSUBSCRIPTION_LINK => ''  ,
                DATA_ELEMENT_INVITE_LINK_BACK => ''  ,
                DATA_ELEMENT_INVITE_SENDER_NAME => '' 
                
                   
           );
           $this->setEmailTempDataElementValuesForProjectHolder($projectId,$projectDetails,$toHolderEmailAddress, $userType);
           
           return $this->dataElementValuesArray;
     }
     
   /**
   * Function to get Email Template all Data Elements Array
   *   
   */
   function getEmailTempDataElementValuesArray(){
        return $this->dataElementValuesArray;
    } 
   
   /**
   * Funtion to set Email Template all Data Elements 
   *  
   * @param mixed $dataEleArray   - Array of all Data Element NAME => VALUE pair array
   */
    function setEmailTempDataElementValuesArray($dataEleArray){
               $this->dataElementValuesArray  = $dataEleArray;
    }
    
    /**
    * Funtion to set Email Template single Data Element
    * 
    * @param mixed $dataelement    - Data Elemnt Name
    * @param mixed $datavalue      -  Data Element Value
    */
    function setEmailTempDataElementValue($dataelement, $datavalue){
            $this->dataElementValuesArray[$dataelement] = $datavalue;
    }
    
    /**
    * Fuction to set Email Templates member and contact elements by given holder and project id  
    * 
    * @param mixed $holderid      - Mail receiver holder id
    * @param mixed $projectid     - Selected proejct id
    */
   function setEmailTempDataElementValuesForProjectHolder($projectId,$projectDetails, $toHolderEmailAddress, $userType="Holder"){           
        // STEP :  Initialization of variables
          $project_name='';
          $project_home_url='';
          $project_sponsor_name='';
          $project_sponsor_email='';
          
         // STEP : If project id , then get project details and set to data element value   
        if($projectDetails!='' && $projectDetails!=null){  
                        
            if(!empty($projectDetails['Project']['url'])) {
                             $pos = strpos($projectDetails['Project']['url'],"http://");
                             if ($pos === false) {
                                 $project_home_url="http://".$projectDetails['Project']['url'];
                             }else{
                                 $project_home_url=$projectDetails['Project']['url']; 
                             }
                             
                              // Set DATA_ELEMENT_EMAIL_UNSUBSCRIPTION_LINK  vlaue      EMAIL_UNSUBSCRIPTION_LINK_HTML
                              $email_unsubscription_url=$project_home_url."?email_subscriptions=1";  
                              $email_unsubscription_link_html=str_replace("[[EMAIL_UNSUBSCRIPTION_URL]]", $email_unsubscription_url, EmailTemplatesComponent::EMAIL_UNSUBSCRIPTION_LINK_HTML);
                              $this->dataElementValuesArray[DATA_ELEMENT_EMAIL_UNSUBSCRIPTION_LINK]=$email_unsubscription_link_html;    
                              
                              
                        }else {
                             $project_home_url='http://'.HTTP_PATH.'/'.$projectDetails['Project']['project_name'];
                        }
            $project_name=  $projectDetails['Project']['system_name'];   
            if($projectDetails['Project']['system_name']==""){
                $project_name=  ucfirst($projectDetails['Project']['project_name']);   
            }
                            
        //    $project_home_url_html= str_replace("http://", "",$project_home_url);
        
            $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_NAME]=$project_name;   
            $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_HOMEPAGE_URL]=$project_home_url;
            $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_OWNER_NAME]=$projectDetails['Sponsor']['sponsor_name'];
            $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_OWNER_EMAIL]=$projectDetails['Sponsor']['email'];
            //3rd March 2012: SET PROJECT PRIVACY PAGE LINK
            $project_privacy_page_link = $project_home_url."?destinationpage=privacy";
            $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_PRIVACYPAGE_URL]=$project_privacy_page_link;   
            // 3rd March 2012: For now we don't have values for PROJECT ADDRESS1, ADDRESS2, CITY,  STATE, ZIP   so can't set values 
            // 3rd March 2012: As per John reply on this , we have to replace project sponosr ADDRESS1, ADDRESS2, CITY,  STATE, ZIP   for these element 
            $statename="";
            if($projectDetails['Sponsor']['state']){
                  $statename=AppController::getstatename($projectDetails['Sponsor']['state']);       
            }
           
           $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_ADDRESS1]=$projectDetails['Sponsor']['address1'];    
           $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_ADDRESS2]=$projectDetails['Sponsor']['address2'];    
           $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_CITY]=$projectDetails['Sponsor']['city'];    
           $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_STATE]=$statename;    
           $this->dataElementValuesArray[DATA_ELEMENT_PROJECT_ZIP]=$projectDetails['Sponsor']['zipcode'];  
           
           
        }             
        
        if($toHolderEmailAddress!='' && $toHolderEmailAddress!=null && $projectId!='' && $projectId!=null){  
            //3rd March 2012: SET SENT TO ADDRESSEE EMAIL 
            $this->dataElementValuesArray[DATA_ELEMENT_SENT_TO_ADDRESSEE_EMAIL]=$toHolderEmailAddress; 
            
            if($userType=="Sponsor") {  
                // Check if email is for sponsor
                 App::import('Model','Sponsor');
                 $this->Sponsor = new Sponsor();
                 $this->Sponsor->bindModel(array('belongsTo'=>array(
                    'Country'=>array('foreignKey'=>false, 'conditions'=>'Sponsor.country = Country.country_id'  ),
                    'State'=>array('foreignKey'=>false, 'conditions'=>'Sponsor.state = State.state_id'  )
                    )));
                    $sponrCondition = "Sponsor.project_id = '$projectId' AND Sponsor.email='$toHolderEmailAddress' AND Sponsor.delete_status='0'"; 
                    $sponsorDetails=$this->Sponsor->find('first',array("conditions"=>$sponrCondition)); 
                    if($sponsorDetails){
                         $this->dataElementValuesArray[DATA_ELEMENT_TO_MEMBER_NAME]= $sponsorDetails['Sponsor']['sponsor_name'];      
                         $this->dataElementValuesArray[DATA_ELEMENT_TO_MEMEBR_EMAIL]=$sponsorDetails['Sponsor']['email'];      
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_FIRSTNAME]=$sponsorDetails['Sponsor']['sponsor_name'];      
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_LASTNAME]='';
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_ADDRESS1]=$sponsorDetails['Sponsor']['address1'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_ADDRESS2]=$sponsorDetails['Sponsor']['address2'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_CITY]=$sponsorDetails['Sponsor']['city'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_STATE]=$sponsorDetails['State']['state_name'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_COUNTRY]=$sponsorDetails['Country']['country_name'];
                       //  $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_PHONE]=$sponsorDetails['Sponsor']['phone'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_ZIP]=$sponsorDetails['Sponsor']['zipcode'];
                    }
            }else{
                 // STEP : If holder id , then get holder details and set to data element value   
                
                     App::import('Model','Holder');
                     $this->Holder = new Holder();
                     $this->Holder->bindModel(array('belongsTo'=>array(
                            'Country'=>array('foreignKey'=>false, 'conditions'=>'Holder.country = Country.country_id'  ),
                            'State'=>array('foreignKey'=>false, 'conditions'=>'Holder.state = State.state_id'  )
                            )));
                    $condition = "Holder.project_id = '$projectId' AND Holder.email='$toHolderEmailAddress' AND delete_status='0'"; 
                    $holderDetails=$this->Holder->find('first',array("conditions"=>$condition)); 
                    if($holderDetails){
                         $this->dataElementValuesArray[DATA_ELEMENT_TO_MEMBER_NAME]= $holderDetails['Holder']['screenname'];      
                         $this->dataElementValuesArray[DATA_ELEMENT_TO_MEMEBR_EMAIL]=$holderDetails['Holder']['email'];      
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_FIRSTNAME]=$holderDetails['Holder']['firstname'];      
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_LASTNAME]=$holderDetails['Holder']['lastnameshow'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_ADDRESS1]=$holderDetails['Holder']['address1'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_ADDRESS2]=$holderDetails['Holder']['address2'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_CITY]=$holderDetails['Holder']['city'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_STATE]=$holderDetails['State']['state_name'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_COUNTRY]=$holderDetails['Country']['country_name'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_PHONE]=$holderDetails['Holder']['phone'];
                         $this->dataElementValuesArray[DATA_ELEMENT_MEMBER_ZIP]=$holderDetails['Holder']['zipcode'];
                    }
                
           } 

        }
        
    }
   /**
   * Funtion to get email template by temaplate name and proejct id
   *  
   * @param mixed $templateName     - Name of template
   * @param mixed $project_id       - Proejct Id
   */
    function getEmailTemplateByName($templateName,$project_id, $insertDataEle=false){
            App::import('Model','EmailTemplate');
            $this->EmailTemplate = new EmailTemplate();
            $condition = " EmailTemplate.email_template_name= '".$templateName."' and  EmailTemplate.project_id='".$project_id."' and EmailTemplate.active_status='1' and EmailTemplate.delete_status='0' ";
            $mailMessage = $this->EmailTemplate->find('first',array('conditions' => $condition));
             if(is_array($mailMessage) && !empty($mailMessage))
             {
                 if($insertDataEle){
                     $mailMessage['EmailTemplate']['content']= $this->insertDataElementValuesToContent($mailMessage['EmailTemplate']['content']);
                 }
                 return $mailMessage;
             }else{
                 return false;
             }
    }
    
    /**
    * Funstion to insert all data elements by its value   at any provided content 
    * 
    * @param mixed $content    - Content message to replace data elements
    */
    function insertDataElementValuesToContent($content){
           $content= str_replace($this->dataElementArray, $this->dataElementValuesArray,$content);
           return $content;
    }
    
    
}
?>