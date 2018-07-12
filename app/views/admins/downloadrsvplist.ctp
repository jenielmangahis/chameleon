<?php


if(!empty($commentlist)){
		foreach($commentlist as $eachrow)
   				{
				
   			$recid = $eachrow['Comment']['id'];
   			
   			$rsvp = $eachrow['Comment']['rsvp'];
			$comment = $eachrow['Comment']['comment'];
   			$active_status = $eachrow['Comment']['active_status'];
   			if($comment){
   				$commentnew = AppController::WordLimiter($comment,30);
   			}
   			$var=($rsvp=="1")?"Yes":"No";
   			
   			$commentdate = $eachrow['Comment']['created'];
   			$coinno = $eachrow['CoinsHolder']['serialnum'];
   			$commentdate = AppController::usdateformat($commentdate,1);
   			$firstname = $eachrow['Holder']['firstname'];
   			$lastnameshow = $eachrow['Holder']['lastnameshow'];
   			$fullname = $firstname.' '.$lastnameshow;
			if($fullname)  				$fullname = AppController::WordLimiter($fullname,20);
   			$commenttypename="";
			if($eachrow['Comment']['comment_type_id']>0)
			$commenttypename=AppController::getcommenttypename($eachrow['Comment']['comment_type_id']);
		
				$datatoload.=$coinno.','.$var.','.$commentnew.','.$commenttypename.','.$fullname.','.$commentdate."\n";
				

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