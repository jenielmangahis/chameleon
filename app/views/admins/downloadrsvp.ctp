<?php

$datatoload='';
if(!empty($eventdata)){
        foreach($eventdata as $eachrow)
                   {
                $recid = $eachrow['Event']['id'];
                $userid = $eachrow['Holder']['user_id'];
                $modelname = "Event";
                $othermodelname = "EventInvitation";
                $redirectionurl = "rsvp";

                $event_name = $eachrow['Event']['title'];
                $starttime = date('F j, Y, g:i a', strtotime($eachrow['Event']['starttime'])); 
                
                
                $holder_id = $eachrow['EventInvitation']['invite_to_holder_id'];
                $holder_name=AppController::getholdernamebyid($holder_id);
                
                App::import("Model", "Holder");
                $this->Holder =  & new Holder();   
                
                $condition= "Holder.id = '".$holder_id."'";
                $holder_data = $this->Holder->find('first',array("conditions"=>$condition));
                
                $holder_city=$holder_data['Holder']['city'];
                $holder_state=AppController::getstatename($holder_data['Holder']['state']);
                $holder_country=AppController::getcountryname($holder_data['Holder']['country']);
                
                
                if($holder_city=="")
                    $holder_city="NA";

                if($holder_state=="")
                    $holder_state="NA";
                
                $rsvp_date = $eachrow['EventInvitation']['created'];
                $no_of_tickets = $eachrow['EventInvitation']['tickets_booked'];
                $rsvp_status = $eachrow['EventInvitation']['invite_status'];
                
                if($rsvp_status==0)
                   $rsvp_status="Pending" ;
                if($rsvp_status==1)
                   $rsvp_status="Attending" ;
                if($rsvp_status==2)
                   $rsvp_status="May be Attending" ;
                 if($rsvp_status==3)
                   $rsvp_status="Not Attending" ;
                
            
                $datatoload.=$holder_city.','.$holder_state.','.$holder_name.','.$rsvp_date.','.$no_of_tickets.','.$rsvp_status."\n";
                

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