<?php if($this->loginarea){?>                                                                     

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


$checkSubMenu = "Setups";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>
<li>
<?php
$className = $this->subtabsel=="editprojectdtl" ? 'tabSelt' : '';	
e($html->link(
$html->tag('span', 'Setup'),
array('controller'=>'admins','action'=>'editprojectdtl'),
array('escape' => false,'class' => $className)
)
);
?>
</li>	
<?php
}
$checkSubMenu = "Locations";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{


?>             
<li>
<?php
$className = $this->subtabsel=="locationlist" ? 'tabSelt' : '';	
e($html->link(
$html->tag('span', 'Locations'),
array('controller'=>'setups','action'=>'locationlist'),
array('escape' => false,'class' => $className)
)
);
?>			
</li>  
<?php
}
$checkSubMenu = "Backup";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>  

    <li>	
		<?php
			$className = $this->subtabsel=="backup" ? 'tabSelt' : '';	
			e($html->link(
				$html->tag('span', 'Backup'),
				array('controller'=>'setups','action'=>'backup'),
				array('escape' => false,'class' => $className)
				)
			  );
		?>
		</li> 
<?php
}
$checkSubMenu = "Users";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>

		<li>
					<?php
						$className = $this->subtabsel=="userslist" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Users'),
						array('controller'=>'admins','action'=>'userslist','0'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
<?php
}
$checkSubMenu = "User Type";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>
	<li>
					<?php
						$className = $this->subtabsel=="rolle_list" ? 'tabSelt' : '';	
						if(($this->params['controller']==='admins' && ($this->params['action']==='rolle_list' || $this->params['action']==='editusertype' || $this->params['action']==='add_role')))
						{
						e($html->link(
						$html->tag('span', 'User Type'),
						array('controller'=>'admins','action'=>'rolle_list'),
						array('escape' => false,'class' => 'tabSelt')
						)
					  );
					  }
					  else{
					  e($html->link(
						$html->tag('span', 'User Type'),
						array('controller'=>'admins','action'=>'rolle_list'),
						array('escape' => false,'class' => '')
						)
					  );
					  }
					?>
				</li>


<?php
}
?>


		
				
<?php

$checkSubMenu = "Coinsets";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>				
  <li>
					<?php
						$className = $this->subtabsel=="coinsetlist" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Coinsets'),
						array('controller'=>'setups','action'=>'coinsetlist'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li> 
<?php
}

$checkSubMenu = "Coin Pricing";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>
				
				 <li>
					<?php
						$className = $this->subtabsel=="coming_soon" ? 'tabSelt' : '';
						if($_GET['url']==='admins/coming_soon/coinpricing/project')
						{	
						e($html->link(
						$html->tag('span', 'Coin Pricing'),
						array('controller'=>'admins','action'=>'coming_soon','coinpricing','project'),
						array('escape' => false,'class' => 'tabSelt')
						)
					  );
					  }
					  else
					  {
					  	e($html->link(
						$html->tag('span', 'Coin Pricing'),
						array('controller'=>'admins','action'=>'coming_soon','coinpricing','project'),
						array('escape' => false,'class' => '')
						)
					  );
					  }
					?>
				</li> 
<?php
}
$checkSubMenu = "System Pricing";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>				
				<li>
					<?php
						$className = $this->subtabsel=="coming_soon" ? 'tabSelt' : '';	
						if($_GET['url']==='admins/coming_soon/systempricing/project')
						{
						e($html->link(
						$html->tag('span', 'System Pricing'),
						array('controller'=>'admins','action'=>'coming_soon','systempricing','project'),
						array('escape' => false,'class' => 'tabSelt')
						)
					  );
					  }
					  else
					  {
					  	e($html->link(
						$html->tag('span', 'System Pricing'),
						array('controller'=>'admins','action'=>'coming_soon','systempricing','project'),
						array('escape' => false,'class' => '')
						)
					  );
					  }
					?>
				</li> 
<?php
}
$checkSubMenu = "Terms & Privacy";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>				
				<li>
					<?php
						$className = $this->subtabsel=="loginterms" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Terms & Privacy'),
						array('controller'=>'admins','action'=>'loginterms'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li> 
<?php
}
$checkSubMenu = "Agreement";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>
				<li>
					<?php
						$className = $this->subtabsel=="user_agreement_project" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Agreement'),
						array('controller'=>'admins','action'=>'user_agreement_project'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li> 
 
 <?php
 }
 ?>
 

				
				
<?php

?>		

<li>
					<?php
						$className = $this->subtabsel=="projectshoppingcart" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Shopping Cart'),
						array('controller'=>'admins','action'=>'projectshoppingcart'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>	
						   
                <li>
					<?php
						$className = $this->subtabsel=="change_password" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Password'),
						array('controller'=>'admins','action'=>'change_password'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
<?php
$checkSubMenu = "Get Started";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>

 <li>
					<?php
						$className = $this->subtabsel=="getstart" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', ' Get Started'),
						array('controller'=>'admins','action'=>'getstart'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
</li>
<?php } ?> 
						
            </ul>
    <?php }?>
	
	</div>
</div>    
    