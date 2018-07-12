<div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2">
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

$checkSubMenu = "Emails";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>			
             <li>
				<?php
						e($html->link(
							$html->tag('span', 'Email'),
							array('controller'=>'mailtasks','action'=>'activetasklist','0'),
							array('class'=> ($this->subtabsel=="activetasklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php
	}			
$checkSubMenu = "Links";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>			    
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Links'),
							array('controller'=>'links','action'=>'activelinklist'),
							array('class'=> ($this->subtabsel=="activelinklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
 <?php
 }
$checkSubMenu = "Forms";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
 ?>
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Forms'),
							array('controller'=>'admins','action'=>'inquirylist' ,'new'),
							array('class'=> ($this->subtabsel=="inquirylist")?'tabSelt':'','escape' => false)
							)
						);
					?>

			</li>
<?php
}
$checkSubMenu = "Surveys";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>			
			<li>		
				<?php
						e($html->link(
							$html->tag('span', 'Surveys'),
							array('controller'=>'surveys','action'=>'survey_history'),
							array('class'=> ($this->subtabsel=="survey_history")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php
}
$checkSubMenu = "Coupons";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

?>			
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Coupons'),
							array('controller'=>'coupons','action'=>'couponlist'),
							array('class'=> ($this->subtabsel=="couponlist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li> 
<?php
}
$checkSubMenu = "QR-Codes";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>			 
			     <li>
				<?php
						e($html->link(
							$html->tag('span', 'QR Codes'),
							array('controller'=>'admins','action'=>'qrcodegenerate'),
							array('class'=> ($this->subtabsel=="qrcodegenerate")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li> 
			<?php
			}
			?>
            </ul>