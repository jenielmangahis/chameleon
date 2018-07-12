<?php 
//$project_name=$project['Project']['project_name'];
$filepath =  'backup' . DS .$filename.".zip" ;      
//header('Content-disposition: attachment; filename='.$filepath);
//header('Content-Type: application/sql');
  // Set headers
     header("Cache-Control: public");
     header("Content-Description: File Transfer");
     header('Content-disposition: attachment; filename='.$filepath);   
      header("Content-Type: application/zip");
     header("Content-Transfer-Encoding: binary");
readfile($filepath);
?>