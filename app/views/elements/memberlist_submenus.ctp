<?php if($this->loginarea){?>

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
			
//$checkSubMenu = "Members";					
//$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
//if($flagSubHideMenuPermission)
//{	
?>					
                    <li>
						
					<?php
						e($html->link(
									$html->tag('span', 'Members'),
									array('controller'=>'admins','action'=>'memberlist','secondlevel'),
									//'/admins/memberlist/secondlevel',
									array('class'=> ($this->subtabsel=="memberlist")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
					?>					
					</li>
<?php
//}
//$checkSubMenu = "Members";					
//$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
//if($flagSubHideMenuPermission)
//{
?>
  <li>
<?php


	e($html->link(
		$html->tag('span', 'Holders'),
		array('controller'=>'admins','action'=>'holderslist'),
					//'/admins/holderslist',
						array('class'=> ($this->subtabsel=="holderslist")?'tabSelt dropdown-item':'','escape' => false )
					)
			);
		?>					
		</li>
		<?php

		//}
$checkSubMenu = "Non-Holders";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
					<li>					
						<?php
						e($html->link(
									$html->tag('span', 'Non-Holders'),
										array('controller'=>'admins','action'=>'nonholderslist'),
									//'/admins/nonholderslist',
									array('class'=> ($this->subtabsel=="nonholderslist")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
					?>
					</li>
					
					
<?php  } 
 ?>	

 
    <li>
						
					<?php
						e($html->link(
									$html->tag('span', ' Non-Members'),
									array('controller'=>'admins','action'=>'nonmemberslist'),
									//'/admins/nonmemberslist ',
									array('class'=> ($this->subtabsel=="nonmemberslist")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
					?>					
					</li>
					
		<?php
$checkSubMenu = "Message";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
		
<li>
						
					<?php
						e($html->link(
									$html->tag('span', ' Message'),
									array('controller'=>'admins','action'=>'messagelist'),
									//'/admins/messagelist ',
									array('class'=> ($this->subtabsel=="messagelist")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
					?>					
					</li>
	<?php
	}
$checkSubMenu = "By Levels";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
					<li>					
						<?php
						e($html->link(
									$html->tag('span', 'Spending'),
									array('controller'=>'admins','action'=>'membersbylevel'),
									//'/admins/membersbylevel',
									array('class'=> ($this->subtabsel=="level")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
					?>

					</li>
<?php } 

$checkSubMenu = "Top Points";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
					 <li>
					<?php
						e($html->link(
									$html->tag('span', 'Top Points'),
									array('controller'=>'admins','action'=>'top_points'),
									//'/admins/top_points',
									array('class'=> ($this->subtabsel=="top_points")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
					?>
					</li> 
<?php } 
?>	
					
					
					
					
					
					<?php
			
		

$checkSubMenu = "Map";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>	
					<li>
						<?php
						e($html->link(
									$html->tag('span', 'Map'),
									array('controller'=>'admins','action'=>'map'),
									//'/admins/map',
									array('class'=> ($this->subtabsel=="map")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
<?php } 

$checkSubMenu = "Points Detail";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
                    <li>					
						<?php
						e($html->link(
									$html->tag('span', 'Points Detail'),
									array('controller'=>'admins','action'=>'points_detail'),
									//'/admins/points_detail',
									array('class'=> ($this->subtabsel=="points_detail")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>  
 <?php } 
 
 
$checkSubMenu = "Points Setup";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
                    <li>					
						<?php
						e($html->link(
									$html->tag('span', 'Points Setup'),
									array('controller'=>'admins','action'=>'points'),
									//'/admins/points',
									array('class'=> ($this->subtabsel=="points")?'tabSelt':'','escape' => false )
									)
						);
					?>

					</li> 
<?php } 

 
$checkSubMenu = "Types";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	

?>
 <li>
<?php
						e($html->link(
									$html->tag('span', 'Member Type'),
									array('controller'=>'admins','action'=>'membertypes'),
									//'/admins/membertypes',
									array('class'=> ($this->subtabsel=="membertypes")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
<?php
}

$checkSubMenu = "Level Setup";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
					<li>					
						<?php
						e($html->link(
									$html->tag('span', 'Level Setup'),
									array('controller'=>'admins','action'=>'memberlevels'),
									//'/admins/memberlevels',
									array('class'=> ($this->subtabsel=="levelsetup")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
<?php } 


?>				     
                    </ul>
                    
                  </div>
                </div> <!--------END OF DIV------------>
<?php }?>

<script type="text/javascript">
	$('#dropdownMenuButton').on('show.bs.dropdown', function () {
	  $('.dropdown-toggle').dropdown();
	});
</script>