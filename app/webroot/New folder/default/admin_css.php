<?php
header("Content-type: text/css");
$white = '#fff';
$dkgray = '#333';
$dkgreen = '#008400';

$styledata=$Session->read("styledata");	
print_r($styledata);

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
