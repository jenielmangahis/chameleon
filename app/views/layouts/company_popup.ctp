<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php 
    echo $dataprojects['Project']['project_name'].' :: '.$title_for_layout;

?>
</title>
<?php 
     

     echo $javascript->link('jquery.js');
      $project_name_default='default';
    echo $html->css('/css/'.$project_name_default.'/chat');
    //echo $javascript->link('admin_validate.js');
    echo $html->css('newadmintemplate.css','stylesheet');
    echo $html->css('css/slide.css','stylesheet');
    echo $html->css('css/style.css','stylesheet');
    //echo $javascript->link('/js/'.$project_name.'/facebox.js'); 
    echo $javascript->link('user_validate.js');
    echo $javascript->link('style.js');
    echo $javascript->link('jquery-1.3.2.min.js');
    echo $javascript->link('slide.js');
    echo $html->css('/css/'.$project_name_default.'/facebox');
    //echo $html->css('/css/'.$project_name.'/styles');
     echo $javascript->link('facebox.js');
        //echo $html->css('facebox.css','stylesheet');
    if($_SERVER['REQUEST_URI'] == '/admins/login'|| $_SERVER['REQUEST_URI'] == '/admins/forgotpassword/') {
            //echo $html->css('structure.css','stylesheet');
      }
    echo $javascript->link('jquery.dropdownPlain.js');
?>


<script type="text/javascript">
  function show()
      {
    document.getElementById("blck").style.display ="block";
      }
  $(document).ready(function() {
      //document.getElementById("blck").style.display ="none";
      var t=setTimeout("hideDiv1()",3000);
    }) 

  function hideDiv1()
     {
    $('#ablck').fadeOut('slow');  

     }  
  function hideDiv()
     {
    $('#blck').fadeOut('slow');  
     } 
</script>

<?php
    echo $html->css('fullcalendar.css','stylesheet');
    echo $html->css('fullcalendar.print.css','stylesheet', array('media'=>'print'));
    echo $javascript->link('jquery-1.5.2.min.js');
    echo $javascript->link('jquery-ui-1.8.11.custom.min.js');
    echo $javascript->link('fullcalendar.min.js');
?>

</head>

<body >
<div >
<!-- header starts -->
<?php // echo $this->renderElement('new_sponsor_header'); ?>

<!-- header starts -->


<?php // echo $this->renderElement('spnsr_menu_highlite'); ?>
<?php echo $content_for_layout; ?>

    
<?php echo $this->renderElement('new_admin_footer'); ?>


</div>
</body>



</html>
