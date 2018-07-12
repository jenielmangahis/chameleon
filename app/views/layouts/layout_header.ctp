<div class="header2">

<div class="headerLogo">
<a href="/<?php echo $project_name ?>"><?php 
if(!empty($page_content['Content']['header_image'])!="")
{
    echo $html->image($page_content['Content']['header_image'], array());
}
else
{
if($project['Project']['logo']=="")
echo $html->image('/img/'.$project_name.'/logo.gif', array());
else
echo $html->image('/img/'.$project_name.'/uploads/'.$project['Project']['logo'], array('style'=>'width:960px;'));
?></a>
</div>
<div  id="headerseperator" style="height: 5px;"></div><div class="clear"></div>

<div class="topNav menu "> <!-- Top Navigation starts -->
					<ul class="right" id="menu">
					<!--<li><a href="#.">home</a></li>
					<li>|</li>
					<li><a href="#.">about</a></li>
					<li>|</li>
					<li><a href="#.">faq</a></li>
					<li>|</li>
					<li><a href="#.">comments</a></li>
					<li>|</li>
					<li><a href="#.">coin types</a></li>
					<li>|</li>
					<li><a href="#.">contact</a></li>
					<li>|</li>-->
				<!--	<li><a href="#." class="rhtNav">register</a></li>
					<li>|</li>
					<li><a href="#." class="rhtNav">login</a></li>-->
					<?php echo $this->element("topmenubar");?>
					 <?php if(empty($_SESSION['User']['User']['id'])){?>
					<li><a href="/companies/signup" class="rhtNav"><span>Register</span></a></li>
					<li>|</li>
					<li><a href="/companies/login" class="rhtNav"><span>Login</span></a></li>
					
					<?php } else {?>
					<li><a href="/companies/dashboard" class="rhtNav"><span>Dashboard</span></a></li>
					<li>|</li>
					<li><a href="/companies/logout" class="rhtNav"><span>Logout</span></a></li>
					<?php }?>
					</ul>
					<div class="clear"></div>
				</div> <!-- Top Navigation ends -->

<ul class="navTop">
  
  </ul>
</div> 
<!--margin-left:-9px; margin-top: -7px; -->
 <!-- Header section ends -->