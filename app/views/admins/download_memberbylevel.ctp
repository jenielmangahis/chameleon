<?php $datatoload ='';             
            if($memberlist){
            	$datatoload .= "'Register Date', 'First Name', 'Last Name', 'Screen Name', 'Member Type', 'Member Level', Points, Status \n";
                    foreach($memberlist as $eachrow){

                        $recid = $eachrow['Holder']['id'];
                        $userid = $eachrow['Holder']['user_id'];
                        $screenname=$eachrow['Holder']['screenname'];
                        $firstname = $eachrow['Holder']['firstname'];
                        $lastnameshow = $eachrow['Holder']['lastnameshow'];
                        $email = $eachrow['Holder']['email'];
                        $created = $eachrow['Holder']['created'];
                        if($eachrow['Holder']['created'] !='0000-00-00'){
                            $created = AppController::usdateformat($eachrow['Holder']['created']);
                        }
                        $membertype=$eachrow['MemberType']['member_type'];   
						$memberlevel = $eachrow['MemberLevel']['level_name'];
						$status = ($eachrow['Holder']['active_status']==1) ? 'Active' : 'Inactive';
                        $points=$eachrow[0]['totalpoints'];  
                           
                        $datatoload  .= $created.','.$firstname.','.$lastnameshow.','.$screenname.','.$memberlevel.','.$points.','.$status.' '. "\n"; 
                   }
            }else{
              		$datatoload .= "No member(s) found.";
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