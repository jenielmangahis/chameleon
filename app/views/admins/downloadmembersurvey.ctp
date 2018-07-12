<?php
$datatoload='';
if($surveyData){ 
               foreach($surveyData as $eachrow){
                        $firstname = $eachrow['Holder']['firstname'];
						$phone = $eachrow['Holder']['phone'];
						$city = $eachrow['Holder']['city'];
						$state = AppController::getstatename($eachrow['Holder']['state']);
                        if($firstname) $firstname = AppController::WordLimiter($firstname,25);
                        $lastnameshow = $eachrow['Holder']['lastnameshow'];
                        if($lastnameshow) $lastnameshow = AppController::WordLimiter($lastnameshow,25);                        

					   //survey data
					   $surveyCreatedDate = AppController::usdateformat($eachrow['SurveyResponse']['created']);
					   $survey_id = $eachrow['SurveyResponse']['survey_id'];
					   $survey_name = $eachrow['Survey']['survey_name'];
               
               $datatoload.=$surveyCreatedDate.','.$survey_name.','.$firstname.','.$lastnameshow.','.$phone.','.$city.','.$state."\n";
}

}
else{
                $datatoload='There is no data to export.';

                }

$filename = "export_survey_data_".date("Y-m-d_H-i",time());
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