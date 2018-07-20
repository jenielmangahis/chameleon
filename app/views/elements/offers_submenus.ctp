<?php if($this->loginarea){
	if($this->loginarea=='companies'){
		 $tab='companylist'; 
	}else if($this->loginarea=='offers'){
		$tab='offerlist'; 
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
  <div class="clear"></div>          
  <div id="tab-container-1" class="dropdown-button-container">

	<div class="dropdown">
    
    <button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	Select Menu List
    </button>

                    <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton"> <!--old class = topTabs2-->
<?php 
$checkSubMenu = "Current";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>				
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Current'),
								'/'.$this->loginarea.'/bymember',
								array('escape' => false,'class'=> ($this->subtabsel=="bymember" || $this->subtabsel=="offerlist")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Taken";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>						
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Taken'),
								array('controller'=>$this->loginarea,'action'=>'taken'),
								array('escape' => false,'class'=> ($this->subtabsel=="taken")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Used-Unpaid";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>						
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Used-UnPaid'),
								array('controller'=>$this->loginarea,'action'=>'used_unpaid'),
								array('escape' => false,'class'=> ($this->subtabsel=="used_unpaid")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Used-Paid";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>						
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Used-Paid'),
								array('controller'=>$this->loginarea,'action'=>'used_paid'),
								array('escape' => false,'class'=> ($this->subtabsel=="used_paid")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php 
}
$checkSubMenu = "Expired";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>						
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Expired'),
								array('controller'=>$this->loginarea,'action'=>'expired'),
								array('escape' => false,'class'=> ($this->subtabsel=="expired")?'tabSelt':'')
								)
							);
						?>
					</li>
<?php
}
$checkSubMenu = "Calendar";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>					
					  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Offer Calendar'),
								array('controller'=>'offers','action'=>'calendar','1'),
								array('escape' => false,'class'=> ($this->subtabsel=="calendar")?'tabSelt':'')
								)
							);
						?>

					</li>
<?php 
}



$checkSubMenu = "Categories";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>						
				<li>
						<?php
							e($html->link(
								$html->tag('span', 'Categories'),
								array('controller'=>'offers','action'=>'category'),
								array('escape' => false,'class'=> ($this->subtabsel=="category")?'tabSelt':'')
								)
							);
						?>

					</li>
<?php 
}
$checkSubMenu = "Emails";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>						
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Offer Email'),
								array('controller'=>$this->loginarea,'action'=>'offeremail'),
								array('escape' => false,'class'=> ($this->subtabsel=="currentofferlist")?'tabSelt':'')
								)
							);
						?>

					</li>
<?php 
}

$checkSubMenu = "Offer Pages";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{


?>						
					
				  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Offer Page'),
								array('controller'=>$this->loginarea,'action'=>'offerpages'),
								array('escape' => false,'class'=> ($this->subtabsel=="offerpages")?'tabSelt':'')
								)
							);
						?>

					</li>
					
					<?php
					}
					?>
				
				<!--   	
				
				 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Merchant Page'),
								array('controller'=>$this->loginarea,'action'=>'offertypelist'),
								array('escape' => false,'class'=> ($this->subtabsel=="offertypelist")?'tabSelt':'')
								)
							);
						 ?>

				</li>
			
				
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Inquiry Page'),
								array('controller'=>$this->loginarea,'action'=>'offerlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="offerlist")?'tabSelt':'')
								)
							);
						?>

				</li>
				
				
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Event Page'),
								array('controller'=>$this->loginarea,'action'=>'offerlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="offerlist")?'tabSelt':'')
								)
							);
						?>

				</li>
                   
                 -->  
				   
            </ul>
           <div class="clear"></div> 
<?php }?>