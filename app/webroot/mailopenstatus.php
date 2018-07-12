<?php
define('HTTP_PATH',$_SERVER['HTTP_HOST']);
//error_reporting(1);
//$groupid,$eventid,$userid,$recmail;
$recordid = base64_decode($_GET['rId']);
if(isset($_GET['gId']) && !empty($_GET['gId']))
	$groupid = base64_decode($_GET['gId']);
//$eventid = base64_decode($_GET['eId']);
$userid = base64_decode($_GET['uId']);
$recmail = base64_decode($_GET['rmail']);
$imgname="";
if(isset($groupid)){

	$link = mysql_connect("localhost", "abol", "abol") or die(mysql_error());
	$dbname = 'db_abol';
	mysql_select_db($dbname);
	$date  = Date('Y-m-d H:i:s');
	

	$sqlcheck = "SELECT group_logo FROM groups where id='".$groupid."'";
	
	$result = mysql_query($sqlcheck);
	$resnum =  mysql_num_rows($result);	
	if($resnum>0){
		$row= mysql_fetch_array($result);
		$imgname = $row['group_logo'];
	}
}


if(isset($groupid )){
	$homepage = file_get_contents('http://'.HTTP_PATH.'/img/thumbnail/'.$imgname);
	echo $homepage;
}else
{
	$homepage = file_get_contents('http://'.HTTP_PATH.'/img/abol_logo.jpg');
	echo $homepage;
}

if($userid && $recmail){
		//$sql = " update request_friends set view_status='1',open_date=now()  where id=".$recordid." and user_id=".$userid." and event_id=".$eventid." and friend_email='".$recmail."'";
		$sql = " update request_friends set view_status='1',open_date=now()  where id=".$recordid." and user_id=".$userid." and friend_email='".$recmail."'";
		
		
		$updval = mysql_query($sql);
	/*$num_rows = mysql_num_rows($retcheck);
	if(!$num_rows){
		$sql = "INSERT INTO email_open "."(custid,compid, date) ". "VALUES ". "('$custid','$campid','$date')";
	
		$retval = mysql_query($sql);
		if($retval){
			echo  "Ok greate";
		}
	}*/
	
}

?>

