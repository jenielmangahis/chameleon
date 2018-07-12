<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


  <?php if (isset($metakeyword) && !empty($metakeyword)) {
	echo $html->meta('keywords',"$metakeyword");
	echo $html->meta('description',"$metakeyword");
  }
  echo $html->meta('favicon.ico','app/webroot/favicon.ico', array('type' =>'icon')); 
 ?>

<title>
<?php 
	echo SITENAME.' :: '.$title_for_layout;

?>
</title>

<?php 

	 echo $html->css('userstyle_for8_donorsignup.css','stylesheet');
	 echo $javascript->link('chrome.js');
	echo $javascript->link('ajaxupload.js');
	  echo $javascript->link('user_validate.js');
	  echo $javascript->link('jquery-1.4.2.min.js');
	  echo $javascript->link('jquery.betterTooltip.js');
	  
	 
	  
?>

 <script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript" src="/js/tiny_mce/tiny_mce_src.js"></script>
 
</head>

<body >
<div id='pageloadingimgdiv'></div>
<!--wrapper starts here--><div id="wrapper">
<script type="text/javascript">EnablePageLoading();</script>  
<span id='warningMessage' style='display:none; background-color: red; color: white;'>your session going to expire due to an extended period of inactivity.</span>
<?php 
$groupheader = $this->requestAction('/groups/group_header/');
 
if($groupheader){
	echo $this->renderElement('group_header');

}else{
	echo $this->renderElement('header');
}
 ?>

	<?php echo $content_for_layout ?>
	
<?php echo $this->renderElement('footer'); ?>
</div>

</body>



</html>
