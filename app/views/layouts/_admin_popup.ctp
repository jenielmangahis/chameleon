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
     echo $javascript->link('jquery.autocomplete.pack.js');
     echo $html->css('newadmintemplate.css','stylesheet');
     echo $html->css('jquery.autocomplete.css','stylesheet');
     echo $javascript->link('facebox.js');
        echo $html->css('facebox.css','stylesheet');
     echo $html->css('css/slide.css','stylesheet');
        echo $html->css('css/style.css','stylesheet');
        echo $javascript->link('slide.js');   
        $project_name_default='default';
    echo $html->css('/css/'.$project_name_default.'/chat');
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
    //$(document).ready(function() {
      //document.getElementById("blck").style.display ="none";
      //var t=setTimeout("hideDiv1()",3000);
    //}) 

  function hideDiv1()
     {
    $('#ablck').fadeOut('slow');  

     }  
  function hideDiv()
     {
    $('#blck').fadeOut('slow');  
     }


    /*var classStr = '';
    $(document).ready(function() {
        $("div").click(function() {
            //console.log($(this).attr('class'));
            
            if ($(this).attr('class')) {
                classStr += $(this).attr('class');
                if (classStr.indexOf('ui-widget-content')==-1) {
                    console.log('done');
                }
            }
            
        });
    });*/
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
<!-- header starts -->
<?php // echo $this->renderElement('new_admin_header'); ?>

<!-- header starts -->


    <?php // echo $this->element("menuhil");?> 
<?php echo $content_for_layout ?>

    
<?php echo $this->renderElement('new_admin_footer'); ?>



</body>



</html>
