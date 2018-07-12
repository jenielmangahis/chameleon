<?php

$datatoload='';
if($project_list){ 

               foreach($project_list as $eachrow){
                   
              
                
               $recid = $eachrow['Project']['id'];
               $project_name = $eachrow['Project']['project_name'];
               $version=$eachrow['SystemVersion']['system_version_name'];
               $sys_price=$eachrow['SystemPricing']['system_pricing_name'];
               $billing = $eachrow['Project']['total_no_of_billing'];
               $mo_charge = $eachrow['Project']['system_monthly_charge'];
               $numunits = $eachrow['Project']['numunits'];
               
               $modelname = "Project";
               $redirectionurl = "projectlist_by_sys_price";
               $notetext = "";
               
               
               
               $crtdate = $eachrow['Project']['created'];
               $commentdate = AppController::usdateformat($crtdate,1);
               
               $datatoload.=$project_name.','.$version.','.$sys_price.','.$billing.','.$mo_charge.','.$numunits.','.$commentdate."\n";

               }
}
else{
                $datatoload='There is no data to export.';

                }

   
                
   
    
$filename = "export_".date("Y-m-d_H-i",time());
    // We'll be outputting a PDF
    header('Content-type: application/csv');
   
    // It will be called downloaded.pdf
    $filename=$filename.".csv";
    header('Content-Disposition:attachment; filename='.$filename.'');
   
    // The PDF source is in original.pdf
    readfile($filename);
   
       
   
   
    //     header("Content-Transfer-Encoding: binary");
    //     header("Content-Length: ".$fsize);
    //     ob_clean();
    //     flush();
   
   
   
   
    // header("Content-type: application/vnd.ms-excel");
    // header("Content-disposition: csv" . date("Y-m-d") . ".csv");
    // header("Content-disposition: filename=".$filename.".csv");
   
    print $datatoload;
    //
    //
    exit;

?>