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
 <!--<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript" src="/js/tiny_mce/tiny_mce_src.js"></script>-->
</head>

<body >

<!--wrapper starts here  wrapper--><div id="popup_wrapper"> <img src="/img/popuptop.png" width="710" height="37" alt="" align="top" />
<a href="#" onclick="window.close();"><img src="/img/delete_32.png" width="32" height="32" alt="" class="close_btn right" /></a>

<?php //echo $this->renderElement('popup_header'); ?>

	<?php echo $content_for_layout ?>
	
<?php //echo $this->renderElement('footer'); ?>

</div>
</body>



</html>
