<?php if($this->loginarea){?>                                                                     
    <div class="clear"></div>
    <div id="tab-container-1" class="dropdown-button-container">

	<div class="dropdown">
    
    <button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	Select Menu List
    </button>

            <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
<?php
if(!isset($hideSubMenuPermission))		
{
	$hideSubMenuPermission = "";
}
if(!isset($c_name))		
{
	$c_name = "";
}
if(!isset($f_name))		
{
	$f_name = "";
}

				
$checkSubMenu = "Networks";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>				
<li>
<?php
$className = $this->subtabsel=="socialnetwork" ? 'tabSelt' : '';	
if($_GET['url']==='admins/socialnetwork'){
e($html->link(
$html->tag('span', 'Networks'),
array('controller'=>'admins','action'=>'socialnetwork'),
array('escape' => false,'class' => $className)
)
);
}
else{
e($html->link(
$html->tag('span', 'Networks'),
array('controller'=>'admins','action'=>'socialnetwork'),
array('escape' => false,'class' => '')
)
);
}
?>			
</li>    
<?php
}
$checkSubMenu = "Facebook";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
	
?>
                <li>
					<?php
					$className = $this->subtabsel=="fbfeeds" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Facebook'),
						array('controller'=>'admins','action'=>'fbfeeds'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li> 
<?php
}
$checkSubMenu = "Blogs";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{		
?>				
                <li>	
					<?php
						$className = $this->subtabsel=="bloglist" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Blogs'),
						array('controller'=>'admins','action'=>'bloglist'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li> 
<?php
}
$checkSubMenu = "IFrames";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>				
				
			   
                <li>
					<?php
						$className = $this->subtabsel=="iframes" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Iframes'),
						array('controller'=>'admins','action'=>'iframes'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
<?php
}
$checkSubMenu = "WebPages";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>				
				<li>
					<?php
						$className = $this->subtabsel=="contentlist" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Webpages'),
						array('controller'=>'admins','action'=>'contentlist'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
<?php
}
$checkSubMenu = "SystemPages";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>			
				<li>
					<?php
						$className = $this->subtabsel=="systemlist" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'System Pages'),
						array('controller'=>'admins','action'=>'systemlist'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
				
<?php
}
$checkSubMenu = "Themes";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>				
				<li>
					<?php
						$className = $this->subtabsel=="settingthemes" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Themes'),
						array('controller'=>'admins','action'=>'settingthemes'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
<?php
}
$checkSubMenu = "Controls";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>				
					<li>
					<?php
						$className = $this->subtabsel=="projectcontrols" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Controls'),
						array('controller'=>'admins','action'=>'projectcontrols'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
	<?php
	}
$checkSubMenu = "Page Footer";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
	?>
	<?php /*?><li>
					<?php
						$className = $this->subtabsel=="page_footer" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Page Footer'),
						array('controller'=>'admins','action'=>'page_footer'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li><?php */?>
<?php
}
$checkSubMenu = "Border Footer";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>
				<li>
					<?php
						$className = $this->subtabsel=="project_border_footer" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Border Footer'),
						array('controller'=>'admins','action'=>'project_border_footer'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
<?php
}
$checkSubMenu = "Shopping Cart";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>				
				<li>
					<?php
						$className = $this->subtabsel=="projectshoppingcart" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Shopping Cart'),
						array('controller'=>'admins','action'=>'projectshoppingcart','0'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>

<?php
}
?>
				</ul>
			</div>
		</div>

    <?php }?>