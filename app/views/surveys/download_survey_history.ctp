<?php
if($surveyhistorydata){
$alt=0;
$i=1;
foreach($surveyhistorydata as $eachrow){
			$surveytypearray = array('Both','Email','WebPage');
			$alt++;
			$recid = $eachrow['Survey']['id'];
			$modelname = "Survey";
			$redirectionurl = "survey_history";
			$datesent = date("m-d-Y", strtotime($eachrow['Survey']['created']));
			$survey_name = $eachrow['Survey']['survey_name'];
			$survey_type = $surveytypearray[$eachrow['Survey']['survey_type']];
			$template_webpage = '';
			 
			if($eachrow['Survey']['template']!="" &&  $eachrow['Survey']['webpage']!=""){
				$template_webpage = $eachrow['EmailTemplate']['email_template_name'].'/'.$eachrow['WpPost']['post_title'];
			}else{
				if($eachrow['Survey']['template']!="")				
					$template_webpage = $eachrow['EmailTemplate']['email_template_name'];
				else 
					$template_webpage = $eachrow['WpPost']['post_title'];
			}
				
			$sent = $eachrow['Survey']['sent'];
			$received =$eachrow['Survey']['received'];
			$opt_out =  $eachrow['Survey']['opt_out'];
			$bounce	 = $eachrow['Survey']['bounce'];
			
			
			$datatoload .= $i++.','.$datesent.','.$survey_name.','.$survey_type.','.$template_webpage.','.$sent.','.$received.','.$opt_out.','.$bounce."\n";
			} 
}else{ 
					$datatoload = 'No Surveys found.';
} 
	
				
   
    
$filename = "survey_history".date("Y-m-d_H-i",time());
    // We'll be outputting a PDF
    header('Content-type: application/csv');
   
    $filename=$filename.".csv";
    header('Content-Disposition:attachment; filename='.$filename.'');
  
    readfile($filename);
   print $datatoload;

?>