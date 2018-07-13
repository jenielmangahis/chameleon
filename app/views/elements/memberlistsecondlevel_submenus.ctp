<?php if($this->loginarea){?>

<!-- <div class="clear"></div>
<div id="tab-container-1">
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
?>
    <li>
      <?php
	  			$id=$this->params['pass'][0];
				$cid=$this->params['pass'][1];
				$cuid=$this->params['pass'][2];
	  				if(($this->params['controller']==='admins' && $this->params['action']==='editnonholder'|| $_GET['url']==='admins/nonholderslist') || ($this->params['controller']==='admins' && $this->params['action']==='editholder'|| $_GET['url']==='admins/holderslist') || $_GET['url']==='admins/memberlist/secondlevel' || (($this->params['controller']==='contacts' || $this->params['controller']==='relationships') && ($this->params['action']==='sa_addcompany'|| $this->params['action']==='sa_addcontacts' ||  $this->params['action']==='editlos' ||$this->params['action']==='addlos' ||  $this->params['action']==='addcorrespondent')) ||($this->params['controller']==='prospects' && $this->params['action']==='addmerchant')){
						if((($this->params['controller']==='contacts') && $this->params['action']==='sa_addcompany')){
						
						e($html->link(
									$html->tag('span', 'Details'),
									array('controller'=>'contacts','action'=>'sa_addcompany',$id),
									//'/'.$this->loginarea.'/memberlist/secondlevel',
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						elseif((($this->params['controller']==='contacts') && $this->params['action']==='sa_addcontacts')){
						
						e($html->link(
									$html->tag('span', 'Details'),
									array('controller'=>'contacts','action'=>'sa_addcontacts',$id,$cid,$cuid),
									//'/'.$this->loginarea.'/memberlist/secondlevel',
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						
						elseif((($this->params['controller']==='prospects') && $this->params['action']==='addmerchant')){
						
						e($html->link(
									$html->tag('span', 'Details'),
									array('controller'=>'prospects','action'=>'addmerchant',$id,$cid,$cuid),
									//'/'.$this->loginarea.'/memberlist/secondlevel',
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						
						else{
						e($html->link(
									$html->tag('span', 'Details'),
									array('controller'=>'admins','action'=>'memberlist','secondlevel'),
									//'/'.$this->loginarea.'/memberlist/secondlevel',
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						}
						else{
						e($html->link(
									$html->tag('span', 'Details'),
									array('controller'=>'admins','action'=>'memberlist','secondlevel'),
									//'/'.$this->loginarea.'/memberlist/secondlevel',
									array('class'=>'','escape' => false )
									)
						);
						}
					?>
    </li>
	
	
	 <li>
      <?php
	  				$ids = $this->params['pass'][0]; 
	  				if(($this->params['controller']==='admins' && $this->params['action']==='call'))
					{
						if($this->params['action']==='editholder')
						{
							e($html->link(
										$html->tag('span', 'Calls'),
										array('controller'=>'admins','action'=>'call/h',$ids),
										//'/'.$this->loginarea.'/messagelist',
										array('class'=>'tabSelt','escape' => false )
										)
							);
						}
						elseif($this->params['action']==='editnonholder')
						{
							e($html->link(
										$html->tag('span', 'Calls'),
										array('controller'=>'admins','action'=>'call/n',$ids),
										//'/'.$this->loginarea.'/messagelist',
										array('class'=>'tabSelt','escape' => false )
										)
							);
						}
						else
						{
							e($html->link(
										$html->tag('span', 'Calls'),
										array('controller'=>'admins','action'=>'call'),
										//'/'.$this->loginarea.'/messagelist',
										array('class'=>'tabSelt','escape' => false )
										)
							);
						}
					}
					else
					{
						if($this->params['action']==='editholder')
						{
							e($html->link(
										$html->tag('span', 'Calls'),
										array('controller'=>'admins','action'=>'call/h',$ids),
										//'/'.$this->loginarea.'/messagelist',
										array('class'=>'','escape' => false )
										)
							);
						}
						elseif($this->params['action']==='editnonholder')
						{
							e($html->link(
										$html->tag('span', 'Calls'),
										array('controller'=>'admins','action'=>'call/n',$ids),
										//'/'.$this->loginarea.'/messagelist',
										array('class'=>'','escape' => false )
										)
							);
						}
						else
						{
							e($html->link(
										$html->tag('span', 'Calls'),
										array('controller'=>'admins','action'=>'call'),
										//'/'.$this->loginarea.'/messagelist',
										array('class'=>'','escape' => false )
										)
							);
						}
					}
					?>
    </li>
	
    <li>
      <?php
						if($_GET['url']==='mailtasks/activetasklist/2'){
						e($html->link(
									$html->tag('span', 'Emails'),
									array('controller'=>'mailtasks','action'=>'activetasklist' ,'2'),
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						else{
						e($html->link(
									$html->tag('span', 'Emails'),
									array('controller'=>'mailtasks','action'=>'activetasklist' ,'2'),
									array('class'=>'','escape' => false )
									)
						);
						}
					?>
    </li>
	
	
	<li>
      <?php
						if($_GET['url']==='admins/sendsms/1'){
						e($html->link(
									$html->tag('span', 'SMS'),
									array('controller'=>'admins','action'=>'sendsms' ,'1'),
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						else{
						e($html->link(
									$html->tag('span', 'SMS'),
									array('controller'=>'admins','action'=>'sendsms' ,'1'),
									array('class'=>'','escape' => false )
									)
						);
						}
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
	  				if($_GET['url']==='admins/messagelist/1'){
						e($html->link(
									$html->tag('span', 'Messages'),
									array('controller'=>'admins','action'=>'messagelist','1'),
									//'/'.$this->loginarea.'/messagelist',
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						else{
						e($html->link(
									$html->tag('span', 'Messages'),
									array('controller'=>'admins','action'=>'messagelist','1'),
									//'/'.$this->loginarea.'/messagelist',
									array('class'=>'','escape' => false )
									)
						);
						}
					?>
    </li>
    <?php
//				
//$checkSubMenu = "Comment";					
//$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
//if($flagSubHideMenuPermission)
//{	
?>
    <li>
      <?php
						e($html->link(
									$html->tag('span', 'Comments'),
									array('controller'=>'admins','action'=>'commentlist','1'),
									//'#',
									array('class'=> ($this->subtabsel=="commentlist")?'tabSelt':'','escape' => false )
									)
						);
					?>
    </li>
   
    <?php } 
$checkSubMenu = "Current Event";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
    <li>
      <?php	
					if($_GET['url']==='admins/eventlist/1'){
						e($html->link(
									$html->tag('span', 'Events'),
									array('controller'=>'admins','action'=>'eventlist'),
									//'/'.$this->loginarea.'/eventlist',
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						else{
						e($html->link(
									$html->tag('span', 'Events'),
									array('controller'=>'admins','action'=>'eventlist'),
									//'/'.$this->loginarea.'/eventlist',
									array('class'=>'','escape' => false )
									)
						);
						}
					?>
    </li>
    <?php } 
	//
//	$checkSubMenu = "Current Event";					
//$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
//if($flagSubHideMenuPermission)
//{	
?>
    <li>
      <?php
	  				if($_GET['url']==='players/notelist/2'){
						e($html->link(
									$html->tag('span', 'Notes'),
									array('controller'=>'players','action'=>'notelist','2'),
									//'/'.$this->loginarea.'/eventlist',
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						else{
						e($html->link(
									$html->tag('span', 'Notes'),
									array('controller'=>'players','action'=>'notelist','2'),
									//'/'.$this->loginarea.'/eventlist',
									array('class'=>'','escape' => false )
									)
						);
						}
					?>
    </li>
    <?php //}
		
?>
    <li>
      <?php
						e($html->link(
									$html->tag('span', 'Tasks'),
									array('controller'=>'offers','action'=>'tasklist'),
									//'/'.$this->loginarea.'/eventlist',
									array('class'=> ($this->subtabsel=="top_points")?'tabSelt':'','escape' => false )
									)
						);
					?>
    </li>
    <?php 
	
//$checkSubMenu = "Points Detail";					
//$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
//if($flagSubHideMenuPermission)
//{	
?>
    <li>
      <?php
						e($html->link(
									$html->tag('span', 'Offers'),
									array('controller'=>'offers','action'=>'offerlist'),
									//'/'.$this->loginarea.'/offers/offerlist',
									array('class'=> ($this->subtabsel=="points_detail")?'tabSelt':'','escape' => false )
									)
						);
					?>
    </li>
    <?php //} 
$checkSubMenu = "Points Setup";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>
    <li>
      <?php
						e($html->link(
									$html->tag('span', 'Points'),
									array('controller'=>'admins','action'=>'points'),
									//'/'.$this->loginarea.'/points',
									array('class'=> ($this->subtabsel=="points")?'tabSelt':'','escape' => false )
									)
						);
					?>
    </li>
    <?php } 
	
?>
    <li>
      <?php
	  				if($_GET['url']==='admins/donation'){						
					e($html->link(
									$html->tag('span', 'Donations'),
									array('controller'=>'admins','action'=>'donation'),
									//'/'.$this->loginarea.'/coming_soon/donationlist',
									array('class'=> 'tabSelt','escape' => false )
									)
						);
						}
						else{
						e($html->link(
									$html->tag('span', 'Donations'),
									array('controller'=>'admins','action'=>'donation'),
									//'/'.$this->loginarea.'/coming_soon/donationlist',
									array('class'=>'','escape' => false )
									)
						);
						}
					?>
    </li>
    <?php  
//$checkSubMenu = "Level Setup";					
//$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
//if($flagSubHideMenuPermission)
//{	
?>
    <li>
      <?php
	  if($_GET['url']==='admins/memberhistory/1'){
						e($html->link(
									$html->tag('span', 'History'),
									array('controller'=>'admins','action'=>'memberhistory','1'),
									array('class'=>'tabSelt','escape' => false )
									)
						);
						}
						else{
						e($html->link(
									$html->tag('span', 'History'),
									array('controller'=>'admins','action'=>'memberhistory','1'),
									array('class'=>'','escape' => false )
									)
						);
						//}
					?>
    </li>
    <?php }
 ?>
 <!--  </ul>
</div> -->

 
<?php }?>
</ul>
                    
                  </div>
                </div> <!--------END OF DIV------------>