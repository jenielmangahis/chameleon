<?php
header("Content-type: text/css");
$white = '#fff';
$dkgray = '#333';
$dkgreen = '#008400';
$pmode = $_GET['cssdata'];

echo "hello";
print_r($pmode);die();
echo ".topNav{
	background-color:".$dkgreen.";
	height:34px;
	line-height:34px;
	clear:both;
	font-size:14px;
	color:#fefeff;
	padding:0 11px;
}";

?>
