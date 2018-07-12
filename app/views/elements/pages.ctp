<div class="boxBg">
  
  <div class="boxBor">
  <div class="boxPad">
<div class="editorTxt">
<style type="text/css">
html, body,table{
	font-family:Arial, Helvetica, sans-serif, "Myriad Pro";
	font-size:12px;
	color:#292828;
	font-weight:normal;
}
h1 {
    line-height: 24px;	
    background:none;	
    font-size: 28px;
    font-weight: normal;
    padding-bottom: 8px;
    padding-left:0;
    font-family: arial;
   text-transform: capitalize;
}
h2 {
    background:none;	
    font-size: 24px;
    font-weight: normal;
    padding-bottom: 8px;
    padding-left:0;
    font-family: arial;
   text-transform: capitalize;
}
h3 {
    font-size: 18px;
    font-weight: normal;
    padding-bottom: 8px;
}
</style>
<?php 
$showpage="no";

 if($page_content['Content']['is_global']=="0"){
if(!empty($_SESSION['User']['User']['id'])) $showpage="yes";
 } 
else  $showpage="yes";

if($showpage=="yes")
{
	if(empty($page_content['Content']['content'])) echo "<center>No Description..</center>"; else echo $page_content['Content']['content'];  
}
?>



</div>
<div class="clear">&nbsp;</div>
  </div>
  </div>  
  </div>