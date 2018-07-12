<?php 
$project_name=$project['Project']['project_name'];
$filepath =  'img' . DS . $project_name . DS.'uploads'. DS.'qrcode.png' ;      
header('Content-disposition: attachment; filename='.$filepath);
header('Content-Type: image/png');
readfile($filepath);
?>