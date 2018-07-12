<?php

$datatoload='';
if($offerdata){ 
               foreach($offerdata as $eachrow){
                   
               
                
               $recid = $eachrow['Offer']['id'];
               $modelname = "Offer";
               $redirectionurl = "offerlist";
               $notetext = "";               
			   $offer_name = $eachrow['Offer']['offer_title'];
			   $email_temp_name = $eachrow['EmailTemplate']['email_template_name'];
               $merchantName=$eachrow['Company']['company_name'];
          	   $email_subject = $eachrow['EmailTemplate']['subject'];
			   $email_sender  = $eachrow['EmailTemplate']['sender'];     
               $datatoload.=$offer_name.','.$email_temp_name.','.$merchantName.','.$email_subject.','.$email_sender."\n";
              }
		}
		else{
              $datatoload='There is no data to export.';
            }
$filename = "export_offer_email_".date("Y-m-d_H-i",time());
    // We'll be outputting a PDF
    header('Content-type: application/csv');
   
    // It will be called downloaded.pdf
    $filename=$filename.".csv";
    header('Content-Disposition:attachment; filename='.$filename.'');
   
    // The PDF source is in original.pdf
    readfile($filename);   
    print $datatoload;
    exit;

?>