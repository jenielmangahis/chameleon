<?php

$datatoload='';
if($coupondata){ 
               foreach($coupondata as $eachrow){
                   
               
                
               $recid = $eachrow['Coupon']['id'];
               $coupon_name =  $eachrow['Coupon']['title'];
						if($coupon_name) $coupon_name = AppController::WordLimiter($coupon_name,25);
						$cost =  $eachrow['Coupon']['coupon_cost'];
						$value =  $eachrow['Coupon']['coupon_value'];
                      
						$start_date = date('m/d/Y',strtotime($eachrow['Coupon']['starttime']));
						if($eachrow['Coupon']['coupon_end_by_date']!="0000-00-00"){
							$end_date = date('m/d/Y',strtotime($eachrow['Coupon']['coupon_end_by_date']));						
						}else{ $end_date ="N/A";}	
						
               $na = 'N/A';
               $datatoload .= $start_date.','.$end_date.','.$coupon_name.','.$na.','.$cost.','.$value.','.$na."\n";
               
              }

}
else{
                $datatoload='There is no data to export.';

                }

              
$filename = "export_coupon_list_".date("Y-m-d_H-i",time());
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