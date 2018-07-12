<?php if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='players'){
		$tab='playerslist';
	} 
?>   
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
?>	                                                              
    <ul id="tab-container-1-nav" class="topTabs2">
<?php 
$checkSubMenu = "Player Types Company";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>    	
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Company'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'company'),
								array('escape' => false,'class'=> ($this->subtabsel=="companylist")?'tabSelt':'')
								)
							);
						?>
					</li>

<?php 
}
$checkSubMenu = "Player Types Contact";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Contact'),
								array('controller'=>$this->loginarea,'action'=>'contact' ,'contact'),
								array('escape' => false,'class'=> ($this->subtabsel=="merchantlist")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Player Types Category";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
					  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Categories'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'category'),
								array('escape' => false,'class'=> ($this->subtabsel=="nonprofitlist")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Player Types Nonprofit";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Non-Profit'),
								array('controller'=>$this->loginarea,'action'=>$tab,'vendor'),
								array('escape' => false,'class'=> ($this->subtabsel=="vendorlist")?'tabSelt':'')
								
								)
							);
						?>
					</li>
<?php 
}
?>					
            </ul> 
            
<?php }?>