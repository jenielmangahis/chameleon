<?php

$datatoload='';
if(!empty($dholderlists)){
		foreach($dholderlists as $eachrow)
   				{
				$recid = $eachrow['Holder']['id'];
				$userid = $eachrow['Holder']['user_id'];
				$modelname = "Holder";
				$othermodelname = "User";
				$redirectionurl = "holderslist";
				$firstname = $eachrow['Holder']['firstname'];
				if($firstname) $firstname = AppController::WordLimiter($firstname,25);
				$lastnameshow = $eachrow['Holder']['lastnameshow'];
				if($lastnameshow) $lastnameshow = AppController::WordLimiter($lastnameshow,25);
				$email = $eachrow['Holder']['email'];
				if($email) $email = AppController::WordLimiter($email,30);
				$created = $eachrow['Holder']['created'];
				if($eachrow['Holder']['created'] !='0000-00-00'){
				$created = AppController::usdateformat($eachrow['Holder']['created']);
   				
                                 }
			
				$datatoload.=$email.','.$firstname.','.$lastnameshow.','.$created."\n";
				

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