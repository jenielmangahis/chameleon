<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php 
	echo SITENAME.' :: '.$title_for_layout;	  
?>
</title>
<?php 									
	 echo $javascript->link('jquery.js');
     echo $javascript->link('admin_validate.js');
     echo $html->css('newadmintemplate.css','stylesheet');
     echo $javascript->link('facebox.js');
    	echo $html->css('facebox.css','stylesheet');
   if($_SERVER['REQUEST_URI'] == '/admins/login'|| $_SERVER['REQUEST_URI'] == '/admins/forgotpassword/') {
			//echo $html->css('structure.css','stylesheet');
   }	
?>
</head>	   
<body >
<!-- header starts -->
<?php echo $this->renderElement('new_sponsor_header'); ?> 
<!-- header starts -->



<?php echo $content_for_layout ?>

	
<?php echo $this->renderElement('new_admin_footer'); ?>



</body>



</html>
