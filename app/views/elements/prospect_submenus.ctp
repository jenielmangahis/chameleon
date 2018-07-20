<?php if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='prospects'){
		$tab='projectmerchant';
	} 
?>                                                                     
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


$checkSubMenu = "Merchants";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?> 
					
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Merchants'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'1'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectmerchant" || $this->subtabsel=="projectmerchantlist")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php
}

$checkSubMenu = "Non-Profit";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>	
					
					  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Non-Profit'),
								array('controller'=>$this->loginarea,'action'=>'prospectnonprofit'),
								array('escape' => false,'class'=> ($this->subtabsel=="nonprofitlist")?'tabSelt':'')
								)
							);
						?>
					</li>
					
					<?php
					}

$checkSubMenu = "Venders";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
					?>
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Vendors'),
								array('controller'=>$this->loginarea,'action'=>'prospectlist','Vendor'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectvendors")?'tabSelt':'')
								
								)
							);
						?>
					</li>
<?php
}
$checkSubMenu = "Sales";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>					
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Sales'),
								array('controller'=>$this->loginarea,'action'=>'prospectlist','Sales'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectsales")?'tabSelt':'') 
								)
							);
						?>
					</li>
					
<?php
}





$checkSubMenu = "Advertisers";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>					
					
					
                  
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Advertiser'),
								array('controller'=>$this->loginarea,'action'=>'prospectlist','Advertiser'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectcAdvertiser")?'tabSelt':'')
								)
							);
						?>
					</li>
					
<?php
}




$checkSubMenu = "Other";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>					
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Other'),
								array('controller'=>$this->loginarea,'action'=>'prospectlist','Other'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectother")?'tabSelt':'')
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
      
       <div class="clear"></div> 
<?php }?>