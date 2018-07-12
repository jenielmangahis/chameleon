<?php

$datatoload='';
if($offerdata){ 
               foreach($offerdata as $eachrow){
                   
               
                
               $recid = $eachrow['Offer']['id'];
               $modelname = "Offer";
               $redirectionurl = "offerlist";
               $notetext = "";               
               $merchantName=$eachrow['Company']['company_name'];
               $categoryName=$eachrow['Category']['category_name'];
               $subCategoryData = $common->getSubCategoryName($cid);
			   $sub_category_name = $subCategoryData['0']['Category']['category_name'];               
               $controlled_by = $eachrow['Offer']['controlled_by'];	
						if($controlled_by=='0'){
							$controlled_by = "Member";
						}else if($controlled_by=='1'){
							$controlled_by = "Merchant";
						}else if($controlled_by=='2'){
							$controlled_by = "Non Profit";
						}
						$offer_type_name = $eachrow['OfferTypeTemplate']['offer_type_template_name'];											
                        $offer_name = $eachrow['Offer']['offer_title'];
                        if($offer_name) $offer_name = AppController::WordLimiter($offer_name,25); 
						$startDate = date('m/d/Y',strtotime($eachrow['Offer']['starttime']));
						if($eachrow['Offer']['task_end_by_date']!="0000-00-00"){
							$endDate = date('m/d/Y',strtotime($eachrow['Offer']['task_end_by_date']));						
						}else{ $endDate ="N/A";}	
               
               $datatoload.=$merchantName.','.$categoryName.','.$subCategoryData.','.$controlled_by.','.$offer_type_name.','.$offer_name.','.$startDate.','.$endDate."\n";
               
              }

}
else{
                $datatoload='There is no data to export.';

                }

   
                
   
    
$filename = "export_offer_list_".date("Y-m-d_H-i",time());
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