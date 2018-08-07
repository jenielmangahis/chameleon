<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php 
	echo SITENAME.' :: '.$title_for_layout;
?>
</title>
<?php 
	
	 echo $javascript->link('jquery.js');
     echo $javascript->link('admin_validate.js');
     echo $javascript->link('jquery.autocomplete.pack.js');     
     echo $html->css('jquery.autocomplete.css','stylesheet');
     echo $javascript->link('facebox.js');
	 echo $javascript->link('common.js');
     echo $html->css('facebox.css','stylesheet');
     echo $html->css('css/slide.css','stylesheet');
     echo $html->css('css/style.css','stylesheet');
	 echo $html->css('bootstrap/css/bootstrap.css','stylesheet');
	 echo $html->css('newadmintemplate.css','stylesheet');
     echo $javascript->link('slide.js');   
     $project_name_default='default';
     echo $html->css('/css/'.$project_name_default.'/chat');


   if($_SERVER['REQUEST_URI'] == '/admins/login'|| $_SERVER['REQUEST_URI'] == '/admins/forgotpassword/') {
			//echo $html->css('structure.css','stylesheet');
   }
	        echo $javascript->link('jquery.dropdownPlain.js'); 

?>

<script type="text/javascript">
// Add By Suman
var baseUrl = '<?php echo Configure::read('App.base_url'); ?>';
var baseUrlAdmin = '<?php echo Configure::read('App.base_url_admin'); ?>';

  function show()
      {
	document.getElementById("blck").style.display ="block";
      }
    //$(document).ready(function() {
      //document.getElementById("blck").style.display ="none";
      //var t=setTimeout("hideDiv1()",3000);
    //}) 

  function hideDiv1(){
  		$('#ablck').fadeOut('slow');  
  }  
  function hideDiv(){
		$('#blck').fadeOut('slow');  
  }	
</script>
<?php
    echo $html->css('fullcalendar.css','stylesheet');
    echo $html->css('fullcalendar.print.css','stylesheet', array('media'=>'print'));
    echo $javascript->link('jquery-1.5.2.min.js');
    echo $javascript->link('jquery-ui-1.8.11.custom.min.js');
    echo $javascript->link('fullcalendar.min.js');
    $pageactname=end(explode("/",$_SERVER["REQUEST_URI"]));
?>
</head>
<body <?php if($pageactname=="addcommtask"){ ?>onload="init();" <?php } ?> class="clearfix" >
<!-- header starts -->
<?php  echo $this->renderElement('new_admin_header'); ?>
<!-- header starts -->

<?php echo $this->element("menuhil");?> 
<?php echo $content_for_layout ?>	
<?php echo $this->renderElement('new_admin_footer'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>



</html>
