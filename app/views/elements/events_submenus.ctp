<?php if($this->loginarea){
	$controller = $this->loginarea; 
$paramArrar=$this->params['pass'];
if(!empty($paramArrar['0'])){
	$page_arg=$paramArrar['0'];
}else{
	$page_arg='';
}
?>                                                                     
       <div class="clear"></div>
       
<div class="dropdown-button-container"> 
	<div class="dropdown">
     
     	<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select Sub Menu List
        </button> 
     	
            <ul id="tab-container-1-nav" class="top-Tabs2 nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
            
            
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
$checkSubMenu = "Current Event";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>				
                <li>
				<?php
					e($html->link(
								$html->tag('span', 'Current'),
								array('controller'=>$controller,'action'=>'eventlist'),
								array('class'=>($this->subtabsel=="eventlist")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li> 
<?php
}					
$checkSubMenu = "Past Events";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					   
                <li>
				<?php
					e($html->link(
								$html->tag('span', 'Past Events'),
								array('controller'=>$controller,'action'=>'pasteventlist'),
								array('class'=>($this->subtabsel=="pasteventlist")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li>
<?php
}					
$checkSubMenu = "Event Calendar";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
                <li>
				<?php
					e($html->link(
								$html->tag('span', 'Calendar'),
								array('controller'=>$controller,'action'=>'calendar'),
								array('class'=>($this->subtabsel=="calendar")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li> 
<?php
}					


$checkSubMenu = "AutoReponse";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					   
                                <li>
				<?php
					e($html->link(
								$html->tag('span', 'AutoReponse'),
								array('controller'=>$controller,'action'=>'eventautoresponders'),
								array('class'=>($this->subtabsel=="eventautoresponders")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li> 
<?php
}


$checkSubMenu = "Event Pages";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					   
                                <li>
				<?php
				if($_GET['url']==='admins/event_pages/detail'){
				e($html->link(
								$html->tag('span', 'Event Pages'),
								array('controller'=>$controller,'action'=>'event_pages/detail' ),
								array('escape' => false,'class'=> 'tabSelt')
								)
							);
				}
				else{
				e($html->link(
								$html->tag('span', 'Event Pages'),
								array('controller'=>$controller,'action'=>'event_pages' ,'detail' ),
								array('escape' => false,'class'=> '')
								)
							);
				}

				?>
				</li> 
<?php
}

					
$checkSubMenu = "Sponsor Pages";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					   
                                <li>
				<?php
				if($_GET['url']==='admins/event_pages/sponsor'){
					e($html->link(
								$html->tag('span', 'Sponsor Pages'),
								array('controller'=>$controller,'action'=>'event_pages' ,'sponsor' ),
								array('escape' => false,'class'=> 'tabSelt')
								)
							);
				}
				else{
				e($html->link(
								$html->tag('span', 'Sponsor Pages'),
								array('controller'=>$controller,'action'=>'event_pages' ,'sponsor' ),
								array('escape' => false,'class'=> '')
								)
							);
							}

				?>
				</li> 
<?php
}

$checkSubMenu = "Inquiry Pages";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					   
                                <li>
				<?php
				
				if($_GET['url']==='admins/event_pages/inquiry'){
				e($html->link(
								$html->tag('span', 'Inquiry Pages'),
								array('controller'=>$controller,'action'=>'event_pages/inquiry'),
								array('escape' => false,'class'=> 'tabSelt')
								
								)
					);
					}
					else{
					
								e($html->link(
								$html->tag('span', 'Inquiry Pages'),
								array('controller'=>$controller,'action'=>'event_pages/inquiry'),
								array('escape' => false,'class'=> '')
								
								)
					);
				}

				?>
				</li> 
<?php
}

$checkSubMenu = "Event Types";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					   
                                <li>
				<?php
				
					e($html->link(
								$html->tag('span', 'Types'),
								array('controller'=>$controller,'action'=>'event_types'),
								array('class'=>($this->subtabsel=="event_types")?'tabSelt dropdown-item':'','escape' => false)
								)
					);
				?>
				</li> 
				<?php
}
$checkSubMenu = "RSVP";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>

<li>
				<?php
					e($html->link(
								$html->tag('span', 'RSVP'),
								array('controller'=>$controller,'action'=>'rsvp'),
								array('class'=>($this->subtabsel=="rsvp")?'tabSelt dropdown-item':'','escape' => false)
								)
					);
				?>
</li>
<?php
}					

$checkSubMenu = "Send Invite";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>

     <li>
				<?php
				if($_GET['url']==='admins/send_invite'){
				e($html->link(
								$html->tag('span', 'Send Invite'),
								array('controller'=>$controller,'action'=>'send_invite'),
								array('escape' => false,'class'=> 'tabSelt dropdown-item')
								)
					);
				}
				else{
						e($html->link(
								$html->tag('span', 'Send Invite'),
								array('controller'=>$controller,'action'=>'send_invite'),
								array('escape' => false,'class'=> '')
								)
					);
				}
				

				?>
				</li> 
 
				
				
<?php
}
$checkSubMenu = "Event Task";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{
?>				
	<li>
		<?php
			e($html->link(
				$html->tag('span', 'Event Task'),
				array('controller'=>$controller,'action'=>'eventtasklist'),
				array('class'=>($this->subtabsel=="eventtasklist")?'tabSelt dropdown-item':'','escape' => false)
				)
			);
		?>
	</li> 
	
	<?php
	}
$checkSubMenu = "Invites";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{

	?>
				   <li>
				<?php
				if($_GET['url']==='admins/eventinvitationhistory'){
					e($html->link(
								$html->tag('span', 'Invites'),
								array('controller'=>$controller,'action'=>'eventinvitationhistory'),
								array('class'=>($this->subtabsel=="eventinvitationhistory")?'tabSelt dropdown-item':'','escape' => false)
								)
					);
					}
					else
					{
						e($html->link(
								$html->tag('span', 'Invites'),
								array('controller'=>$controller,'action'=>'eventinvitationhistory'),
								array('class'=>'','escape' => false)
								)
					);
					}
				?>
				</li> 
<?php
}
?>				
				
				
			<li>					
						<?php
						e($html->link(
									$html->tag('span', 'Donations'),
									//'/admins/donationlist',
									//'admins/donation',
									array('controller'=>'admins','action'=>'donation'),
									array('class'=> ($this->subtabsel=="donationlist")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
					?>

					</li> 
					
				

<?php


				
?>
				<li>					
						<?php
						if($_GET['url']==='admins/projectshoppingcart'){
						e($html->link(
									$html->tag('span', 'Volunteers'),
									'/admins/projectshoppingcart',
									array('class'=> ($this->subtabsel=="eventinvitationhistory")?'tabSelt dropdown-item':'','escape' => false )
									)
						);
						}
						else{
								e($html->link(
									$html->tag('span', 'Volunteers'),
									'/admins/projectshoppingcart',
									array('class'=> '','escape' => false )
									)
						);
						}
					?>

					</li> 	
				
				
				


					   
            </ul>
          
    <?php }?>


	</div>	
</div>  

<script type="text/javascript">
	$('#dropdownMenuButton').on('show.bs.dropdown', function () {
	  $('.dropdown-toggle').dropdown();
	});
</script>  