<!-- <div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2"> -->



<div class="clear"></div>
<div id="tab-container-1" class="dropdown-button-container">

	<div class="dropdown">
    
    <button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	Select Menu List
    </button>

                    <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton"> <!--old class = topTabs2-->


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
$checkSubMenu = "Companies";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>			
             <li>
				<?php
				if($_GET['url']==='relationships' || ($this->params['controller']==='contacts' && $this->params['action']==='sa_addcompany'))
				{
						e($html->link(
							$html->tag('span', 'Companies'),
							array('controller'=>'contacts','action'=>'sa_companylist'),
							array('class'=>'tabSelt','escape' => false)
							)
						);
						}
						else{
						e($html->link(
							$html->tag('span', 'Companies'),
							array('controller'=>'contacts','action'=>'sa_companylist'),
							array('class'=>'','escape' => false)
							)
						);
						}
				?>
			</li>    
<?php
}					
$checkSubMenu = "Contacts";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>	
            <li>
				<?php
						if($_GET['url']==='relationships/sa_contactlist' || ($this->params['controller']==='relationships' && $this->params['action']==='sa_addcontacts' && ($this->params['pass'][2]==='contact' || $this->params['pass'][0]==='contact')))
				{
						e($html->link(
							$html->tag('span', 'Contacts'),
							array('controller'=>'contacts','action'=>'sa_contactlist'),
							array('class'=>'tabSelt','escape' => false)
							)
						);
						}
						else{
						e($html->link(
							$html->tag('span', 'Contacts'),
							array('controller'=>'contacts','action'=>'sa_contactlist'),
							array('class'=>'','escape' => false)
							)
						);
						}
				?>
			</li>
<?php	
}			
$checkSubMenu = "Customers";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>				
            <li>
				<?php
						if(($this->params['controller']==='relationships' && $this->params['action']==='sa_addcontacts' && $this->params['pass'][0]==='cutomer') || $_GET['url']==='relationships/customers' || ($this->params['controller']==='contacts' && $this->params['action']==='sa_addcontacts' && $this->params['pass'][2]==='customer'))
						{
						e($html->link(
							$html->tag('span', 'Customers'),
							array('controller'=>'relationships','action'=>'customers'),
							array('class'=>'tabSelt','escape' => false)
							)
						);
						}
						else{
						e($html->link(
							$html->tag('span', 'Customers'),
							array('controller'=>'relationships','action'=>'customers'),
							array('class'=> '','escape' => false)
							)
						);
						}
					?>

			</li>
<?php
}					
$checkSubMenu = "Prospects";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
			<li>		
				<?php
						e($html->link(
							$html->tag('span', 'Prospects'),
							array('controller'=>'prospects','action'=>'projectmerchant'),
							array('class'=> ($this->subtabsel=="projectmerchant")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php	
}				
$checkSubMenu = "Branches";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>			
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Branches'),
							array('controller'=>'relationships','action'=>'branches'),
							array('class'=> ($this->subtabsel=="branches")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>   
<?php
}					
$checkSubMenu = "LO's";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
            <li>
					<?php
						e($html->link(
							$html->tag('span', "LO's"),
							array('controller'=>'relationships','action'=>'los'),
							array('class'=> ($this->subtabsel=="los")?'tabSelt':'','escape' => false)
							)
						);
					?>

				</li>          
<?php	
}				
$checkSubMenu = "Employees";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
				<li>
					<?php
						e($html->link(
							$html->tag('span','Employees'),
							array('controller'=>'relationships','action'=>'employees'),
							array('class'=> ($this->subtabsel=="employees")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
<?php } ?>

<?php
$checkSubMenu = "Correspondents";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
				<li>
					<?php
						e($html->link(
							$html->tag('span','Correspondents'),
							array('controller'=>'relationships','action'=>'correspondents'),
							array('class'=> ($this->subtabsel=="correspondents")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
<?php } ?>	


<?php
$checkSubMenu = "Brokers";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
				<li>
					<?php
						e($html->link(
							$html->tag('span','Brokers'),
							array('controller'=>'relationships','action'=>'brokers'),
							array('class'=> ($this->subtabsel=="brokers")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
<?php } ?>	

<?php
$checkSubMenu = "Others";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
				<li>
					<?php
						e($html->link(
							$html->tag('span','Others'),
							array('controller'=>'relationships','action'=>'others'),
							array('class'=> ($this->subtabsel=="others")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
<?php } ?>	


<?php
$checkSubMenu = "Maps";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
				<li>
					<?php
						e($html->link(
							$html->tag('span','Maps'),
							array('controller'=>'relationships','action'=>'maps'),
							array('class'=> ($this->subtabsel=="maps")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
<?php } ?>	


<?php
$checkSubMenu = "Send Mail";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
				<li>
					<?php
					if($_GET['url']==='admins/sendtempmail/sendmail'){
						e($html->link(
							$html->tag('span','Send Mail'),
							array('controller'=>'admins','action'=>'sendtempmail','sendmail'),
							array('class'=>'tabSelt','escape' => false)
							)
						);
						}
						else{
						e($html->link(
							$html->tag('span','Send Mail'),
							array('controller'=>'admins','action'=>'sendtempmail','sendmail'),
							array('class'=>'','escape' => false)
							)
						);
						}
					?>
				</li> 
<?php } ?>	

   </ul>
</div>
                    
                  </div>
                </div> <!--------END OF DIV------------>

      <!--       </ul>
			<div class="clear"></div> -->