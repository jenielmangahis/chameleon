<?php

$datatoload='';
if(!empty($formsubmitdata)){
        $datatoload.="Sr.No., Form Type Name,Submitted Date, Status,First Name, Last Name, Email, Title,Company,Phone,Address1, Address2,City, Zip/Postal Code,Country, St/Province,List1,List2, Message\n";
        $srno=0;
        foreach($formsubmitdata as $eachrow)
           {
            # initialize all fields
            $form_type_name=$submitted_date=$status=$first_name=$last_name=$email=$title=$company=$phone=$address1=$address2=$city=$zipcode="";
            $country=$stateprovince=$list1=$list2=$message="";
            
                $recid = $eachrow['FormSubmit']['id'];
                $userid = $eachrow['FormSubmit']['user_id'];
                $modelname = "FormSubmit";
                $othermodelname = "FormType";
                $redirectionurl = "formsubmitlist";
                
                $srno++;
                $form_type_name = $eachrow['FormType']['formtype_name'];
                
                if($eachrow['FormSubmit']['created'] !='0000-00-00'){
                    $submitted_date = date("m-d-Y", strtotime($eachrow['FormSubmit']['created']));
                }
                if($eachrow['FormSubmitStatustype']['statustype_name'] !="" && $eachrow['FormSubmitStatustype']['statustype_name'] !=null){ 
                    $status = $eachrow['FormSubmitStatustype']['statustype_name'];
                }else{
                      $status="New Submission";
                    }
                    
                if($eachrow['FormSubmit']['fld_firstname'] !="" && $eachrow['FormSubmit']['fld_firstname'] !=null)
                        $first_name = $eachrow['FormSubmit']['fld_firstname'];
                        
                if($eachrow['FormSubmit']['fld_lastname'] !="" && $eachrow['FormSubmit']['fld_lastname'] !=null)
                        $last_name = $eachrow['FormSubmit']['fld_lastname'];
                        
                if($eachrow['FormSubmit']['fld_email'] !="" && $eachrow['FormSubmit']['fld_email'] !=null)
                        $email = $eachrow['FormSubmit']['fld_email'];
                        
                if($eachrow['FormSubmit']['fld_title'] !="" && $eachrow['FormSubmit']['fld_title'] !=null)
                        $title = $eachrow['FormSubmit']['fld_title'];
                        
                if($eachrow['FormSubmit']['fld_company'] !="" && $eachrow['FormSubmit']['fld_company'] !=null)
                        $company = $eachrow['FormSubmit']['fld_company'];
                        
                if($eachrow['FormSubmit']['fld_phone'] !="" && $eachrow['FormSubmit']['fld_phone'] !=null)
                        $phone = $eachrow['FormSubmit']['fld_phone'];
                        
                if($eachrow['FormSubmit']['fld_address1'] !="" && $eachrow['FormSubmit']['fld_address1'] !=null)
                        $address1 = $eachrow['FormSubmit']['fld_address1'];
                        
                if($eachrow['FormSubmit']['fld_address2'] !="" && $eachrow['FormSubmit']['fld_address2'] !=null)
                        $address2 = $eachrow['FormSubmit']['fld_address2'];
                        
                if($eachrow['FormSubmit']['fld_city'] !="" && $eachrow['FormSubmit']['fld_city'] !=null)
                        $city = $eachrow['FormSubmit']['fld_city'];
                        
                if($eachrow['FormSubmit']['fld_zippostalcode'] !="" && $eachrow['FormSubmit']['fld_zippostalcode'] !=null)
                        $zipcode = $eachrow['FormSubmit']['fld_zippostalcode'];   
                                     
                if($eachrow['Country']['country_name'] !="" && $eachrow['Country']['country_name'] !=null)
                        $country = $eachrow['Country']['country_name'];
                        
                if($eachrow['State']['state_name'] !="" && $eachrow['State']['state_name'] !=null)
                        $state = $eachrow['State']['state_name'];
                        
                if($eachrow['FormSubmit']['fld_list1'] !="" && $eachrow['FormSubmit']['fld_list1'] !=null)
                        $list1 = $eachrow['FormSubmit']['fld_list1'];
                        
                if($eachrow['FormSubmit']['fld_list2'] !="" && $eachrow['FormSubmit']['fld_list2'] !=null)
                        $list2 = $eachrow['FormSubmit']['fld_list2'];  
                         
                 if($eachrow['FormSubmit']['fld_message'] !="" && $eachrow['FormSubmit']['fld_message'] !=null)
                        $message = $eachrow['FormSubmit']['fld_message'];
                

                 $datatoload.=$srno.','.$form_type_name.','.$submitted_date.','.$status.','.$first_name.','.$last_name.','.$email.','.$title.','.$company.','.$phone.','.$address1.','.$address2.','.$city.','.$zipcode.','.$country.','.$stateprovince.','.$list1.','.$list2.','.$message."\n";
        }
    }else{
                
        $datatoload.='There is no data to export.';

    }
    
                
   
    
    $filename = "Forms_Sumitted_".date("m_d_Y",time());
    // We'll be outputting a PDF
    header('Content-type: application/csv');
   
    // It will be called downloaded.pdf
    $filename=$filename.".csv";
    header('Content-Disposition:attachment; filename='.$filename.'');
   
    // The PDF source is in original.pdf
    readfile($filename);
 
    print $datatoload;


?>