<div class="header2">
<div class="headerLogo">
<a href="<?php echo Configure::read('App.base_url'); ?>">
<pre>
<?php
if($no_header_img != 1){
if(isset($page_content['Content']['header_image'])!="")
{
    echo"<img src=".$page_content['Content']['header_image'].">";
}
else
{  		
    if($project['Project']['logo']=="") {

        echo $html->image('/img/logo.jpg', array());
    } else if(is_file($this->webroot.'img'.$project_name.'/uploads/'.$project['Project']['logo'])) {
        echo $html->image('/img/'.$project_name.'/uploads/'.$project['Project']['logo'], array('style'=>'width:960px;'));
	}
}
}
?></a>
</div>
<div  id="headerseperator" style="height: 3px;"></div><div class="clear"></div>

<div class="topNav menu "> <!-- Top Navigation starts -->
					
					
					<?php  echo $this->element("topmenubar");?>
                    
					
					<div class="clear"></div>
				</div> <!-- Top Navigation ends -->


<!--
<ul class="navTop">
  
  </ul> -->
</div> 
<!--margin-left:-9px; margin-top: -7px; -->
 <!-- Header section ends -->