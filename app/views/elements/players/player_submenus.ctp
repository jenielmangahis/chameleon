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

<div id="tab-container-1" class="dropdown-button-container">
	<div class="dropdown">
    
    <button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	Select Sub-Menu List
    </button>


    						<!--<ul id="tab-container-1-nav" class="topTabs2"> OLD -->
    <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
<?php 
$checkSubMenu = "Companies";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>    	
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Companies'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'company'),
								array('escape' => false,'class'=> ($this->subtabsel=="companylist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>

<?php 
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
								array('controller'=>$this->loginarea,'action'=>$tab ,'merchant'),
								array('escape' => false,'class'=> ($this->subtabsel=="merchantlist")?'tabSelt dropdown-item':'')
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
								array('controller'=>$this->loginarea,'action'=>$tab ,'nonprofit'),
								array('escape' => false,'class'=> ($this->subtabsel=="nonprofitlist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Vender";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Vendors'),
								array('controller'=>$this->loginarea,'action'=>$tab,'vendor'),
								array('escape' => false,'class'=> ($this->subtabsel=="vendorlist")?'tabSelt dropdown-item':'')
								
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
								array('controller'=>$this->loginarea,'action'=>$tab,'sale'),
								array('escape' => false,'class'=> ($this->subtabsel=="salelist")?'tabSelt dropdown-item':'') 
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
								$html->tag('span', 'Advertisers'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'advertiser', '0' ),
								array('escape' => false,'class'=> ($this->subtabsel=="advertiserlist")?'tabSelt dropdown-item':'')
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
								array('controller'=>$this->loginarea,'action'=>$tab ,'other'),
								array('escape' => false,'class'=> ($this->subtabsel=="otherlist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Contact";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Contacts'),
								array('controller'=>$this->loginarea,'action'=>'contactlist', 'contacts'  ),
								array('escape' => false,'class'=> ($this->subtabsel=="contact")?'tabSelt dropdown-item':'')
								)
							);
						?>

					</li>
<?php 
}
$checkSubMenu = "Type";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Types'),
								array('controller'=>$this->loginarea,'action'=>'types', 'company'  ),
								array('escape' => false,'class'=> ($this->subtabsel=="types")?'tabSelt dropdown-item':'')
								)
							);
						?>

					</li>
<?php 
}
$checkSubMenu = "Email";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Email'),
								array('controller'=>$this->loginarea,'action'=>'tasklist' ),
								array('escape' => false,'class'=> ($this->subtabsel=="tasklist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
<?php } ?>				


            </ul> 
	</div>            
</div>            
            
<?php }?>

<script type="text/javascript">
	$('#dropdownMenuButton').on('show.bs.dropdown', function () {
	  $('.dropdown-toggle').dropdown();
	});
</script>