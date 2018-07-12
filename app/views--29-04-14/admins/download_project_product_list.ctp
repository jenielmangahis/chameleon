<?php $datatoload='';
if($coinset_orders){ 
               foreach($coinset_orders as $eachrow){
                
               $recid = $eachrow['Coinset']['id'];
               $modelname = "Coinset";
               $redirectionurl = "projectlist_by_product";
               $notetext = "";
               
               $project_name=$eachrow['Project']['project_name'];
               $no_of_coins=$eachrow['Coinset']['numunits'];
               $coinset=$eachrow['Coinset']['coinset_name'];
               
               $total_units=$eachrow['Coinset']['total_per_unit'];
               $grand_total=$eachrow['Coinset']['grand_total'];
               $product_type=$eachrow['ProductType']['product_type_name'];
               
               $order_date=date('m-d-Y',strtotime($eachrow['Coinset']['datesubmitchipco']));
               $ship_date=date('m-d-Y',strtotime($eachrow['Coinset']['dateestship']));
               
               $datatoload.=$project_name.','.$coinset.','.$product_type.','.$no_of_coins.','.$grand_total.','.$order_date.','.$ship_date."\n";
               
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