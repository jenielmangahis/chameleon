	<?php if($surveyresponsedata){ 
					$alt=0;
					$i=1;
 					foreach($surveyresponsedata as $eachrow){

			$surveytypearray = array('Both','Email','WebPage');
			$alt++;
			$recid = $eachrow['SurveyResponse']['id'];
			$modelname = "SurveyResponse";
			$redirectionurl = "survey_response";
			$datesent = date("m-d-Y", strtotime($eachrow['SurveyResponse']['created']));
			$survey_name = $eachrow['Survey']['survey_name'];
			$firstname = $eachrow['Holder']['firstname'];
			$lastname = $eachrow['Holder']['lastnameshow'];
			$phone= $eachrow['Holder']['phone'];
			$city= $eachrow['Holder']['city'];
			$state = AppController::getstatename($eachrow['Holder']['state']);
			$datatoload .= $i++.','.$datesent.','.$survey_name.','.$firstname.','.$lastname.','.$phone.','.$city.','.$state." \n";
		 } 
}else{
			$datatoload = 'No Surveys found.';

}    
    
$filename = "survey_response".date("Y-m-d_H-i",time());
    // We'll be outputting a PDF
    header('Content-type: application/csv');
   
    $filename=$filename.".csv";
    header('Content-Disposition:attachment; filename='.$filename.'');
  
    readfile($filename);
   print $datatoload;

?>