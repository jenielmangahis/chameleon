<?php
define('HTTP_PATH',$_SERVER['HTTP_HOST']);

if(isset($_GET['mId']) && !empty($_GET['mId'])){
 $mId = $_GET['mId'];
 }

if(isset($mId)){

	$link = mysql_connect("localhost", "abol", "abol") or die(mysql_error());
	$dbname = 'db_abol';
	mysql_select_db($dbname);
	$date  = Date('Y-m-d H:i:s');
}


$homepage = file_get_contents('http://'.HTTP_PATH.'/img/logo.gif');
echo $homepage;


if($mId){
		
		$sql = "update admin_mails set open_status ='1',open_date=now()  where id=".$mId."";
		
		$updval = mysql_query($sql);
}

?>

