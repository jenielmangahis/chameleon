<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
<?php 
	if(isset($title_layout)){
		echo $title_layout;
	}else{
		echo SITENAME.': Admin Panel';
	}

?>
</title>

<?php 
	
    echo $javascript->link('jquery.js');
    echo $javascript->link('admin_validate.js');
    echo $javascript->link('ckfinder/ckfinder');
    echo $html->css('form.css','stylesheet'); 
    echo $javascript->link('facebox.js');
	//echo $_SERVER['REQUEST_URI'];
   //if($_SERVER['REQUEST_URI'] == '/admins/login' || $_SERVER['REQUEST_URI'] == '/admins/forgotpassword/') {
		echo $html->css('structure.css','stylesheet');
   //}
	//echo $html->css('theme.css','stylesheet');
	echo $html->css('all.css','stylesheet');
	echo $html->css('facebox.css','stylesheet');
	
?>
</head>

<body id="public" onload="defaultfocus();">
<div id="main">
<?php echo $this->renderElement('admin_header'); ?>

	<?php echo $content_for_layout ?>

</div>

</body>
</html>