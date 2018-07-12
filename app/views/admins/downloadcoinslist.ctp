<?php

 if($coinlist){
   	$dispflag = false;
   			foreach($coinlist as $eachrow){
   			
   			$recid = $eachrow['CoinsHolder']['id'];
   			$modelname = "CoinsHolder";
   			$redirectionurl = "registercoinlist";
   			
   			$serialnum = $eachrow['CoinsHolder']['serialnum'];
   			
			$coinset_name = $eachrow['Coinset']['coinset_name'];
			if(preg_match('/[A-Z]{3}/', $coinset_name)==1){
			$coinsname= preg_split('/[A-Z]{3}/', $coinset_name);
			$coinset_name=$coinsname[1];
   			}
   			$firstname = $eachrow['Holder']['firstname'];
   			$lastnameshow = $eachrow['Holder']['lastnameshow'];
   			$fullname = $firstname.' '.$lastnameshow;
			if($fullname) $fullname = AppController::WordLimiter($fullname,50);   			
			
			$created = $eachrow['CoinsHolder']['created'];
   			if($eachrow['CoinsHolder']['created'] !='0000-00-00'){
   				$created = AppController::usdateformat($eachrow['CoinsHolder']['created']);
   			}
				$datatoload.=$serialnum.','.$created.','.$coinset_name.','.$fullname."\n";   			
   		
   			}
	}else{

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
    // exit;

?>