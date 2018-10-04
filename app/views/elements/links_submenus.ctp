<div class="clear"></div>
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

?>			
             <li>
				<?php
						e($html->link(
							$html->tag('span', 'Active'),
							array('controller'=>'links','action'=>'activelinklist'),
							array('class'=> ($this->subtabsel=="activelinklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>    
<?php
	
?>	
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'In-Active'),
							array('controller'=>'links','action'=>'inactivelinklist'),
							array('class'=> ($this->subtabsel=="inactivelinklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php	
	
?>				
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Address'),
							array('controller'=>'links','action'=>'addresslink'),
							array('class'=> ($this->subtabsel=="addresslink")?'tabSelt':'','escape' => false)
							)
						);
					?>

			</li>
<?php
	
?>
			<li>		
				<?php
						e($html->link(
							$html->tag('span', 'Placement'),
							array('controller'=>'links','action'=>'palcementlink'),
							array('class'=> ($this->subtabsel=="palcementlink")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php	

?>			
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Groups'),
							array('controller'=>'links','action'=>'groupslink'),
							array('class'=> ($this->subtabsel=="groupslink")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>   
<?php
	
?>
            <li>
					<?php
						e($html->link(
							$html->tag('span', 'Videos'),
							array('controller'=>'links','action'=>'videoslink'),
							array('class'=> ($this->subtabsel=="videoslink")?'tabSelt':'','escape' => false)
							)
						);
					?>

				</li>          
<?php	
	
?>
				<li>
					<?php
						e($html->link(
							$html->tag('span','History'),
							array('controller'=>'links','action'=>'history'),
							array('class'=> ($this->subtabsel=="history")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
<?php ?>

<?php
	
?>
				<li>
					<?php
						e($html->link(
							$html->tag('span','History Click'),
							array('controller'=>'links','action'=>'historyclick'),
							array('class'=> ($this->subtabsel=="historyclick")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
<?php  ?>				
            </ul>
</div>