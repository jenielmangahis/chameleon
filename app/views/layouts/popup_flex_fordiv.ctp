<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(!isset($metakeyword)){
$metakeyword ="";
}

echo $html->meta('keywords',"$metakeyword", array('type' => 'keywords'), false); ?>
<title>
<?php 
	echo $title_for_layout;

?>
</title>
<?php 
 echo $html->css('userstyles.css','stylesheet');
	 echo $javascript->link('chrome.js');
	echo $javascript->link('ajaxupload.js');
	  echo $javascript->link('user_validate.js');
	  echo $javascript->link('jquery-1.4.2.min.js');
	  echo $javascript->link('jquery.betterTooltip.js');
	  
?>
<script>
function closeclipartdiv(){
	 var parentobj=parent;
	 parentobj.document.getElementById("floatingdiv").style.display="none";	
	 parentobj.document.getElementById("tabs_floatingdiv").style.display="none";		
}
</script>
</head>

<body>
<table width="58%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="35"><a href="#"><img src="/img/lft_top.png" width="35" height="41" alt=""  border="0"/></a></td>
    <td class="pop-top">&nbsp;</td>
    <td width="35"><a href="#" onclick="closeclipartdiv();"><img src="/img/rt_top.png" width="42" height="41" alt="Close" title="Close"  /></a></td>
  </tr>
  <tr>
    <td class="pop-left">&nbsp;</td>
   
				<?php echo $content_for_layout ?>
	
    <td class="pop-right">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="/img/lft_bot.png" width="35" height="34" alt="" /></td>
    <td class="pop-btm">&nbsp;</td>
    <td><img src="/img/rt_bot.png" width="42" height="34" alt="" /></td>
  </tr>
</table>

</body>
</html>