<?php

class ProgressComponent extends Object {

	

var $components = array('Session');
		
			
			
			function code2utf($num){
			 //Returns the utf string corresponding to the unicode value
			 //courtesy - romans@void.lv
			 if($num<128)return chr($num);
			 if($num<2048)return chr(($num>>6)+192).chr(($num&63)+128);
			 if($num<65536)return chr(($num>>12)+224).chr((($num>>6)&63)+128).chr(($num&63)+128);
			 if($num<2097152)return chr(($num>>18)+240).chr((($num>>12)&63)+128).chr((($num>>6)&63)+128). chr(($num&63)+128);
			 return '';
			} 
			
			/*	
				 * 	function    : showprogressthermometer()
				 * 	params      : $goalset,$currentamt,$groupid,$eventid
				 * 	Description : This function is used to create thermometer dynamically
				 *  Created On   : 08-07-10 (07:00pm)
 	 		*/

			function showprogressthermometer($goalset,$currentamt,$groupid='',$eventid=''){
				$filename="";
				$persentage='';
				$ybars="";
				$httppath ='http://'.$_SERVER['HTTP_HOST'];
				
				
	
				$font = "1";
				
				$unit ="none";
				$t_unit = ($unit == 'none') ? '' : $this->code2utf($unit);
				
				$t_max = $goalset;
				$t_current = $currentamt;
				
				
				$finalimagewidth = max(strlen($t_max),strlen($t_current));
				$finalimage = imagecreateTrueColor(60+$finalimagewidth,175);
				
				$white = imagecolorallocate ($finalimage, 255, 242, 247);
				$black = imagecolorallocate ($finalimage, 0, 0, 0);
				$red = imagecolorallocate ($finalimage, 255, 0, 0);
				
				imagefill($finalimage,0,0,$white);
				ImageAlphaBlending($finalimage, true); 
				
				$thermImage = imagecreatefromjpeg("img/thermometer_test.jpg");
				$tix = ImageSX($thermImage);
				$tiy = ImageSY($thermImage);
				ImageCopy($finalimage,$thermImage,0,0,0,0,$tix,$tiy);
				
				/*
					thermbar pic courtesy http://www.rosiehardman.com/
				*/
				$thermbarImage = ImageCreateFromjpeg("img/part.jpg"); 
				$barW = ImageSX($thermbarImage); 
				$barH = ImageSY($thermbarImage); 
				
				//echo $barW.'==>';
				
				//echo $barH.'==>'; exit;
				
				
				$xpos = 23;
				$ypos = 124;
				$ydelta = 1;
				$fsize = 20;
				
				
				// Set number of $ybars to use, calculated as a factor of current / max.
				if ($t_current > $t_max) {
					$ybars = 100;
				} elseif ($t_current > 0) {
					$ybars = $t_max ? round(100 * ($t_current / $t_max)) : 0;
				}
				$persentage = $ybars;
				//echo $ybars; exit;
				
				// Draw each ybar (filled red bar) in successive shifts of $ydelta.
				while ($ybars--) {
					ImageCopy($finalimage, $thermbarImage, $xpos, $ypos, 0, 0, $barW, $barH); 
					$ypos = $ypos - $ydelta;
				}
												
				if ($t_current == $t_max) {
					
						$ybars = $t_max ? round(100 * ($t_current / $t_max)) : 0;
						// Draw each ybar (filled red bar) in successive shifts of $ydelta.
						while ($ybars--) {
							ImageCopy($finalimage, $thermbarImage, $xpos, $ypos, 0, 0, $barW, $barH); 
							$ypos = $ypos - $ydelta;
						}
				} 
												
												
				
				if ($t_current > $t_max) {
					$burstImg = ImageCreateFromjpeg('img/thermometer_top.jpg');
					$burstW = ImageSX($burstImg);
					$burstH = ImageSY($burstImg);
					ImageCopy($finalimage, $burstImg, 0,0,0,0,$burstW, $burstH);
				}
				
				if($groupid !=""){
				
								$filename = "thermometer/progresstherma_group_$groupid.jpg";
								
				}
				if($eventid !=""){
					
								$filename = "thermometer/progresstherma_event_$eventid.jpg";
								
							}
							
				//Header("Content-Type: image/jpeg"); 
				if(Imagejpeg($finalimage,$filename)){
				
				
							Imagedestroy($finalimage);
							Imagedestroy($thermImage);
							Imagedestroy($thermbarImage);

				
				}
				if($persentage==""){
							$persentage ='0';
					}
				
					return $persentage;
				
			
												

			}
			
			function getLast12MonthsDetails(){

			        $month = date('m');
			        $year  = date('Y');
			        $i = 1;
			        $date = array();
			        while($i<=12){
			          $timestamp = mktime(0,0,0,$month,1,$year);
			          $date[$i]['month']      = date('F', $timestamp);
			          $date[$i]['monthCount'] = date('m', $timestamp);
			          $date[$i]['monthShort'] = date('M', $timestamp);
			          $date[$i]['daysInMonth'] = date('t', $timestamp);
			          $date[$i]['year']      = date('Y', $timestamp);
			          $date[$i]['yearShort']  = date('y', $timestamp);
			          $month--;
			          $i++;
			        }
			        return $date;
			    }	
			
			/*	
				 * 	function    : showprogresschart()
				 * 	params      : $groupid='',$eventid=''
				 * 	Description : This function is used to create progress chart dynamically
				 *  Created On   : 21-07-10 (03:25pm)
 	 		*/

			function showprogresschart($groupid='',$eventid=''){
			
			
					App::import('Model','Donation');
					$this->Donation = new Donation();
					$mothvar = $this->getLast12MonthsDetails();
					
					$str = "";
					$totraised="";
					$dtus = "";
					$datebetween="";
					$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
					//$todate = Date("Y-m-d");
					$todate = date("Y-m-d", $tomorrow);
					$last12month = $mothvar[12]['year'].'-'.$mothvar[12]['monthCount'].'-'.$mothvar[12]['daysInMonth'];
					
					$displayd1 = "Last 12 months";
					if(!empty($groupid)){
							$datebetween  = 'Donation.donation_mode !="4" AND Donation.status=1 AND Donation.group_id = '.$groupid.' AND Donation.date BETWEEN "'.$last12month.'" AND "'.$todate.'"';
					
							$geteventsbygroupid = $this->Donation->find('all',array("conditions"=>array($datebetween),"order"=>array('Donation.id ASC')));
						
							//$str .= "<graph caption='Group Progress' subcaption='' xAxisName='Total Raised Amount: $$totraised' yAxisMinValue='0'  yAxisName='Donations' decimalPrecision='0' formatNumberScale='0' numberPrefix='$' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
					
							if($geteventsbygroupid){
							
								foreach($geteventsbygroupid as $eachgroupid){
												$totraised =  $totraised + $eachgroupid['Donation']['amount'];
									}
									
										$str .= "<graph caption='Group Progress ($displayd1)' subcaption='' xAxisName='Total Raised Amount: $$totraised' yAxisMinValue='0'  yAxisName='Donations' decimalPrecision='0' formatNumberScale='0' numberPrefix='$' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
												foreach($geteventsbygroupid as $eachgroupid){
																	$dt = explode(' ',$eachgroupid['Donation']['date']);
																	
																	$dtus = AppController::usdateformat($dt[0]);
															
															$str .= "<set name='".$dtus."' value='".$eachgroupid['Donation']['amount']."' hoverText='".$dtus."'/>\n";
													}
							}else{
										$dtus = date('Y');
										$str .= "<graph caption='Group Progress ($dtus)' subcaption='' xAxisName='Total Raised Amount: $0' yAxisMinValue='0'  yAxisName='Donations' decimalPrecision='0' formatNumberScale='0' numberPrefix='$' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
										$str .= "<set name='".$dtus."' value='00' hoverText='".$dtus."'/>\n";
							}
							
							
									$str .="</graph>";
						}
					if(!empty($eventid)){
							$datebetween="";
							$geteventsbyeventid="";
							$totraised ='';
							$str="";
							$dtus="";
							$dt="";
							$datebetween  = 'Donation.donation_mode !="4" AND Donation.status=1 AND Donation.event_id = '.$eventid.' AND Donation.date BETWEEN "'.$last12month.'" AND "'.$todate.'"';
							
							$geteventsbyeventid = $this->Donation->find('all',array("conditions"=>array($datebetween),"order"=>array('Donation.id ASC')));
						   
							if($geteventsbyeventid){
								
									foreach($geteventsbyeventid as $eacheventid){
												$totraised =  $totraised + $eacheventid['Donation']['amount'];
									}
									$str .= "<graph caption='My Progress ($displayd1)' subcaption='' xAxisName='Total Raised Amount: $$totraised' yAxisMinValue='0'  yAxisName='Donations' decimalPrecision='0' formatNumberScale='0' numberPrefix='$' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
									foreach($geteventsbyeventid as $eacheventid){
											$dt = explode(' ',$eacheventid['Donation']['date']);
											$dtus = AppController::usdateformat($dt[0]);
											$str .= "<set name='".$dtus."' value='".$eacheventid['Donation']['amount']."' hoverText='".$dtus."'/>\n";
									}
							}else{
								$dtus = date('Y');
								$str .= "<graph caption='My Progress ($dtus)' subcaption='' xAxisName='Total Raised Amount: $0' yAxisMinValue='0'  yAxisName='Donations' decimalPrecision='0' formatNumberScale='0' numberPrefix='$' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
								$str .= "<set name='".$dtus."' value='00' hoverText='".$dtus."'/>\n";
							}
							
							
									$str .="</graph>";
					
						}	
					
					
					
					

				

					
					//this is the path of XML file
					$fpath    = $_SERVER['DOCUMENT_ROOT']."/app/webroot/charts";
					
					if(!empty($groupid)){
							$filename = $fpath."/group_".$groupid.".xml";
							
							$fhandler=fopen($filename,"w+");
							$str = trim($str," ");
							fwrite($fhandler,$str);
						}
					if(!empty($eventid)){
					
							$filenameevent = $fpath."/event_".$eventid.".xml";
							
							$fhandlerevent=fopen($filenameevent,"w+");
							$str = trim($str," ");
							fwrite($fhandlerevent,$str);
						}	
					

						
	
					return true;				
												

			}


	/*	
	* 	function    : showdonorprogresschar()
	* 	params      : $groupid='',$type=''
	* 	Description : This function is used to create donor progress chart with respect to week,month,year
	*  Created On   : 30-09-10 (10:15 am)
	*/
	
	function showdonorprogresschart($type='',$groupid=''){
	
	
		App::import('Model','Donation');
		$this->Donation = new Donation();
		App::import('Model','User');
		

		$this->User = new User();
		$curyear = Date("Y");
		
		$str = "";
		$totraised="";
		$dtus = "";
		
			$curdate = date('y-m-d');
				
			$condition ='';
			//$startdate = $arr[0];
			//$enddate = $arr[1];

				
			if($type=='week'){
				
				$arr = $this->x_week_range($curdate);
				$startdate = $arr[0];
				$enddate = $arr[1];
				$condition = ' and created_date BETWEEN "'.$startdate.'" and "'.$enddate.'" ';


				if($groupid!=''){
					$this->User->bindModel(array(
								'belongsTo' => array(
									'Donation' => array(
									'foreignKey' => '',
									'conditions' => 'User.id = Donation.user_id',
										),
								),
								
							));
					$condition .=' and Donation.group_id='.$groupid;

				}	
				$getdonordata = $this->User->find('all',array('conditions'=>'User.user_type="1" and User.status="1" and User.delete_status="0"'.$condition,'fields'=>'User.id,User.created_date','group'=>'User.id'));

				
					$eachdatearr = array();
					for($i = 1; $i<=7; $i++){
						//$eachdate = date('Y-m-d',strtotime($startdate).'+ 1 day');
						$eachdate =date('Y-m-d',strtotime(date("Y-m-d", strtotime($startdate)) . " +1 day"));
						$startdate =$eachdate ;
						$eachdatearr[$eachdate] = $weekday = date('l', strtotime($eachdate));
					}
					//print_r($eachdatearr);
					$weekarr = array();
					$totuser = 0;
					$totuser = count($getdonordata);	
					foreach($getdonordata  as $ddata){
						if(!array_key_exists($ddata['User']['created_date'],$weekarr)){
							$weekarr[date('Y-m-d',strtotime($ddata['User']['created_date']))] = 1;
						}else{
							$weekarr[date('Y-m-d',strtotime($ddata['User']['created_date']))] = $weekarr[$ddata[0]['dmonth']]+1;
						}	
	
						
						
					}
					//print_r($weekarr);
					$str .= "<graph caption='Donor Progress' subcaption='' xAxisName='Total Number of Donar: $totuser' yAxisMinValue='0'  yAxisName='No of Donors' decimalPrecision='0' formatNumberScale='0' numberPrefix='' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
					//$str .='<graph caption="Donor Statistics" subCaption="Add To Favorites (% of unique visitors)" yAxisMaxValue="0" bgColor="406181, 6DA5DB" bgAlpha="100" baseFontColor="FFFFFF" canvasBgAlpha="0" canvasBorderColor="FFFFFF" divLineColor="FFFFFF" divLineAlpha="100" numVDivlines="10" vDivLineisDashed="1" showAlternateVGridColor="1" lineColor="BBDA00" anchorRadius="4" anchorBgColor="BBDA00" anchorBorderColor="FFFFFF" anchorBorderThickness="2" showValues="0" numberSuffix="%" toolTipBgColor="406181" toolTipBorderColor="406181" alternateHGridAlpha="5">';
					//print_r($dmotharr);
				if(!empty($getdonordata)){
					foreach($eachdatearr as $key=>$val){
									//$dt = explode(' ',$ddata['User']['created_date']);
									
									//$dtus = AppController::usdateformat($dt[0]);
	
								//$datetotarr[]]
							if(!isset($weekarr[$key])){
								$weekarr[$key] ='0';	
							}	
							$str .= "<set name = '".$val."' label='".$val."' value='".$weekarr[$key]."' />\n";
						
					}
						
				}
				$str .= "</graph>";
			}
			if($type=='year'){
				$montharr = array('1'=>'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				$condition =' and YEAR(created_date)="'.date('Y').'"';
				if($groupid!=''){
					$this->User->bindModel(array(
								'belongsTo' => array(
									'Donation' => array(
									'foreignKey' => '',
									'conditions' => 'User.id = Donation.user_id',
										),
								),
								
							));
					$condition .=' and Donation.group_id='.$groupid;

				}	
				$getdonordata = $this->User->find('all',array('conditions'=>'User.user_type="1" and User.status="1" and User.delete_status="0"'.$condition,'fields'=>'User.id,MONTH(created_date) as dmonth ,User.created_date','group'=>'User.id'));		
				
				$dmotharr = array();
				$totuser = 0;
				foreach($getdonordata as $ddata){
					if(!array_key_exists($ddata[0]['dmonth'],$dmotharr)){
						$dmotharr[$ddata[0]['dmonth']] = 1;
					}else{
						$dmotharr[$ddata[0]['dmonth']] = $dmotharr[$ddata[0]['dmonth']]+1;
					}	

					$totuser++;
				}
				$str .= "<graph caption='Donor Progress' subcaption='' xAxisName='Total Number of Donar: $totuser' yAxisMinValue='0'  yAxisName='No of Donors' decimalPrecision='0' formatNumberScale='0' numberPrefix='' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
				//$str .='<chart caption="Donor Statistics" subCaption="Add To Favorites (% of unique visitors)" yAxisMaxValue="0" bgColor="406181, 6DA5DB" bgAlpha="100" baseFontColor="FFFFFF" canvasBgAlpha="0" canvasBorderColor="FFFFFF" divLineColor="FFFFFF" divLineAlpha="100" numVDivlines="10" vDivLineisDashed="1" showAlternateVGridColor="1" lineColor="BBDA00" anchorRadius="4" anchorBgColor="BBDA00" anchorBorderColor="FFFFFF" anchorBorderThickness="2" showValues="0" numberSuffix="%" toolTipBgColor="406181" toolTipBorderColor="406181" alternateHGridAlpha="5">';
				//print_r($dmotharr);
				if(!empty($getdonordata)){
					foreach($montharr as $key=>$val){
									//$dt = explode(' ',$ddata['User']['created_date']);
									
									//$dtus = AppController::usdateformat($dt[0]);
	
								//$datetotarr[]]
							if(!isset($dmotharr[$key])){
								$dmotharr[$key] ='0';	
							}	
							$str .= "<set name = '".$val."' label='".$val."' value='".$dmotharr[$key]."' />\n";
						
					}
				}
					$str .= "</graph>";

			}

			if($type=='month'){
				$noofdays = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
				$eachdatearr = array();
				//echo $noofdays;
				$startdate = date('Y-m').'-01';
				$strdateuse =$startdate;
				for($i = 1; $i<=$noofdays; $i++){
					//$eachdate = date('Y-m-d',strtotime($startdate).'+ 1 day');
					$eachdatearr[$startdate] = AppController::usdateformat($startdate);								
					$eachdate =date('Y-m-d',strtotime(date("Y-m-d", strtotime($startdate)) . " +1 day"));
					$startdate = $eachdate ;
											
				}
				$enddate = date('Y-m').'-'.$noofdays;


				$condition =' and MONTH(created_date)="'.date('m').'"';
				if($groupid!=''){
					$this->User->bindModel(array(
								'belongsTo' => array(
									'Donation' => array(
									'foreignKey' => '',
									'conditions' => 'User.id = Donation.user_id',
										),
								),
								
							));
					$condition .=' and Donation.group_id='.$groupid;

				}	
				$getdonordata = $this->User->find('all',array('conditions'=>'User.user_type="1" and User.status="1" and User.delete_status="0"'.$condition,'fields'=>'User.id,User.created_date ,User.created_date','group'=>'User.id'));		
				//print_r($getdonordata);
				$totuser = 0;
				$dmotharr = array();
				$totuser = count($getdonordata);
				foreach($getdonordata as $ddata){
					if(!array_key_exists($ddata['User']['created_date'],$dmotharr)){
						$dmotharr[date('Y-m-d',strtotime($ddata['User']['created_date']))] = 1;
					}else{
						$dmotharr[date('Y-m-d',strtotime($ddata['User']['created_date']))] = $dmotharr[$ddata[0]['dmonth']]+1;
					}	

					
				}
				//print_r($dmotharr);
				$str .= "<graph caption='Donor Progress' subcaption='' xAxisName='Total Number of Donar: $totuser' yAxisMinValue='0'  yAxisName='No of Donors' decimalPrecision='0' formatNumberScale='0' numberPrefix='' showNames='0' showValues='0'  showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' >\n";
				//$str .='<chart caption="Donor Statistics" subCaption="Add To Favorites (% of unique visitors)" yAxisMaxValue="0" bgColor="406181, 6DA5DB" bgAlpha="100" baseFontColor="FFFFFF" canvasBgAlpha="0" canvasBorderColor="FFFFFF" divLineColor="FFFFFF" divLineAlpha="100" numVDivlines="10" vDivLineisDashed="1" showAlternateVGridColor="1" lineColor="BBDA00" anchorRadius="4" anchorBgColor="BBDA00" anchorBorderColor="FFFFFF" anchorBorderThickness="2" showValues="0" numberSuffix="%" toolTipBgColor="406181" toolTipBorderColor="406181" alternateHGridAlpha="5">';
				//print_r($dmotharr);
				if(!empty($getdonordata)){
					foreach($eachdatearr as $key=>$val){
									//$dt = explode(' ',$ddata['User']['created_date']);
									
									//$dtus = AppController::usdateformat($dt[0]);
	
								//$datetotarr[]]
							if(!isset($dmotharr[$key])){
								$dmotharr[$key] ='0';	
							}	
							$str .= "<set name = '".$val."' label='".$val."' value='".$dmotharr[$key]."' />\n";
						
					}

				}
					$str .= "</graph>";
				

			}
		
	
		
		//this is the path of XML file
		$fpath    = $_SERVER['DOCUMENT_ROOT']."/app/webroot/charts";		
		$filename = $fpath."/admin_week.xml";
		$fhandler=fopen($filename,"w+");
		$str = trim($str," ");
		fwrite($fhandler,$str);
	

		return true;				
									
	
	}
	

	function x_week_range($date) {
    		$ts = strtotime($date);
    		$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    		return array(date('Y-m-d', $start),
                date('Y-m-d', strtotime('next saturday', $start)));
	}
	
}

?>