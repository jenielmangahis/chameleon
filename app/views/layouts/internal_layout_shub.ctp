<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="description" content="<?php if(!empty($meta_description)) echo $meta_description; ?>">
<meta http-equiv="keyword" content="<?php if(!empty($meta_keyword))  echo $meta_keyword; ?>">
<meta http-equiv="title" content="<?php if(!empty($meta_title))  echo $meta_title; ?>">
<title>Image Coins LLC :: <?php if(!empty($page_title))  echo $page_title; ?></title>
<title><?php echo $title_for_layout; ?></title>
<?php 
	echo $html->css('/css/'.$project_name.'/styles');
	echo $html->css('/css/'.$project_name.'/facebox');	
	echo $html->css('/css/'.$project_name.'/CalendarControl');
	echo $javascript->link('/js/'.$project_name.'/DD_belatedPNG.js');
	echo $javascript->link('/js/'.$project_name.'/CalendarControl.js');
    	echo $javascript->link('/js/'.$project_name.'/jquery.js');
    	echo $javascript->link('/js/'.$project_name.'/user_validate.js');
  	echo $javascript->link('/js/'.$project_name.'/facebox.js');


?>

<script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'1de6e26d-5291-498f-b1e6-92111f624d70'});</script>
</head>
<body>
<div class="wrapper">
  	<?php echo $this->element("layout_header");?>  
	<div id="container">
		<div class="wrap2">
 		
 		<!-- Middle body section starts -->
			<div class="innWrap">
  			<!-- Navigation starts -->
  				
				<div class="bodyCont"> <!-- Body Contents starts -->
					<div class="right"><img src="img/body_box_rht_top.gif" alt="" /></div>
					<div class="left"><img src="img/body_box_lft_top.gif" alt="" /></div>
					<div class="clear"></div>
					<!-- Left panel starts -->
					<!--<?php //echo $this->element("topmenubar");?>  -->
					<div class="clear">&nbsp;</div>
					<?php echo $content_for_layout ?>
					<div class="clear">&nbsp;
					</div> <!-- Left panel ends -->
					
								<p><img src="img/box_top.jpg" alt="" /></p>
					
								<p><img src="img/box_bottom.jpg" alt="" /></p>
										<div class="clear">&nbsp;</div>
			
				</div>
				
			</div>
							<div class="clear">&nbsp;</div>
			<div>
				<!--<a href="#."><img src="img/fBook.gif" alt="" /></a> &nbsp; <a href="#."><img src="img/twitter.gif" alt="" /></a> &nbsp; <a href="#."><img src="img/in.gif" alt="" /></a>-->
			</div>
		</div>

		
	
	</div>

		<div class="clear"></div> 
<!-- Footer starts -->
<?php echo $this->element("bottommenubar");?>
	<div class="clear"></div> 
<?php echo $this->element("layout_footer");?> 
<!-- Footer ends -->
</div>

</html>