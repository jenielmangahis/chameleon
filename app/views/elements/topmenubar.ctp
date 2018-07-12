<ul class="right" id="menu" >
<?php 


$globalcondition="";	

$base_url = Configure::read('App.base_url');

if(empty($_SESSION['User']['User']['id'])) $globalcondition="and Content.is_global='1'";
$showcommenttab="";

$show_web_only="and (Content.type='' or Content.type='web' or Content.type is NULL)";

App::import("Model", "Content");
App::import("Model", "RecurringEvent");

$this->Content =   & new Content();
$this->RecurringEvent =   & new RecurringEvent();

$contentcount = $this->Content->find('count', array('conditions' => "Content.active_status='1' and parent_id='0' and Content.delete_status='0' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' and Content.internal_alias !='home_page' and Content.internal_alias !='home-page' and Content.internal_alias !='contact' ".$show_web_only." ".$globalcondition." ".$showcommenttab,'fields'=>'id'));
$url= Configure::read('App.base_url');


// By Suman Singh
$hostURL = Configure::read('SITE_HTTP_HOST');
if($_SERVER['HTTP_HOST']== $hostURL || $_SERVER['HTTP_HOST'] == $hostURL) {
$url= Configure::read('App.base_url').$project_name;
}

	// For Home menu link
	 $conditionhome = " Content.active_status='1' and Content.delete_status='0' and Content.parent_id ='0' and (Content.internal_alias ='home_page' or Content.internal_alias ='home-page') ".$show_web_only." ".$globalcondition." ".$showcommenttab;
		$homedetails = $this->Content->find('first', array('conditions' => $conditionhome)); 

?>

	<li>
		<a href="<?php echo $url; ?>"
			<?php if(isset($page_url)=="home_page" || isset($page_url)=="home-page") echo 'class="active"' ;  ?>>
		<span><?php echo $titlehome =$homedetails['Content']['title'];
			if($titlehome){$titlehome =AppController::WordLimiter($titlehome,20);}		
		?></span></a>
	</li>
	<li>|</li>
	<?php 	
	
 $condition = "Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and (is_sytem!='2') and `Content`.`internal_alias` !='home-page' ".$show_web_only."  ".$globalcondition." ".$showcommenttab;
		$contentdetails = $this->Content->find('all', array('conditions' => $condition,'order'=>'file_sequence'));
//echo "<pre>"; print_r($contentdetails); 
	foreach($contentdetails as $convalue)
	{
		// DebugBreak();
			if($convalue['Content']['alias']=="shopping-cart" ){
                $menulink="companies/shoppingcart/".$convalue['Content']['alias'];
            }else if($convalue['Content']['alias']=="events" || $convalue['Content']['alias']=="chat" || $convalue['Content']['alias']=="blogs"){
                $menulink="companies/".$convalue['Content']['alias'];
            }else{
                 $menulink=$convalue['Content']['alias'];
            }
			$menulink = $base_url.$menulink;
			//echo '<pre>';print_r($menulink);die;

?>       
	<li>
		<a href="<?php echo $menulink;?>" <?php if(isset($page_url)== $convalue['Content']['alias']) echo 'class="active"' ;  ?>> 
		<span><?php
		 $title =$convalue['Content']['title'];
		if($title){$title =AppController::WordLimiter($title,20);}
		echo $title;
		?></span></a>
       
		
		<?php $parentid=$convalue['Content']['id'];  
		//$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
		$condition2 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$parentid' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='home_page' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' ".$globalcondition." ".$showcommenttab;
		$submenus = $this->Content->find('all', array('conditions' =>$condition2,'order'=>'file_sequence'));
		//print_r($submenus);
		if ($submenus && $submenus!="" && !empty($submenus))
			{
		?>	
            <ul>
				<?php foreach($submenus as $submenu)
				{
                    $submenulink = $submenu['Content']['alias'];
					
					if($submenu['Content']['alias']=="pastevents" || $submenu['Content']['alias']=="calendar" ){
						$submenulink = "companies/".$submenu['Content']['alias'];
					}
					/*
						@Auther			Suman Singh
						@Type			Modified
						@Email			suman.singh@dotsqares.com				
						@Date			April 12, 2012
						@Description	To remove the past events link from submenus
					*/
					
					if($submenu['Content']['alias']=="pastevents") {
						$condition_eve = "RecurringEvent.project_id = '".$submenu['Content']['project_id']."' and  RecurringEvent.active_status='1' and RecurringEvent.delete_status='0' and (DATE(RecurringEvent.start_date) < CURRENT_DATE() )";
						$pastEvents = $this->RecurringEvent->find('count',array("conditions"=>$condition_eve));
						if($pastEvents == 0)
						continue;
					}
					
					$submenulink = $base_url.$submenulink;
                 ?> 
				
					<li  class="sub">
					<a href="<?php echo $submenulink;?>" <?php if($page_url== $submenu['Content']['alias']) echo 'class="active"' ;  ?>><?php 
					$title1=$submenu['Content']['title'];
					if($title1){$title1 =AppController::WordLimiter($title1,20);}
		 			echo $title1;
					?></a>
	
					<?php $subparentid=$submenu['Content']['id'];  
					//$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
					$condition3 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$subparentid' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='home_page' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' ".$globalcondition." ".$showcommenttab;
					$subsubmenus = $this->Content->find('all', array('conditions' =>$condition3,'order'=>'file_sequence'));
					if ($subsubmenus && $subsubmenus!="" && !empty($subsubmenus)) {
					?>	
						<ul>
									<?php foreach($subsubmenus as $subsubmenu)
									{ ?>
											<li>
<a href="/<?php echo $subsubmenu['Content']['alias'];?>" <?php if($page_url== $subsubmenu['Content']['alias']) echo 'class="active"' ;  ?>><?php $title2=$subsubmenu['Content']['title'];
												if($title2){$title2 =AppController::WordLimiter($title2,20);}
												echo $title2;
												?></a>
											</li>
											
									<?php } ?>
						</ul>
					<?php
					} ?>
					</li>
				
				<?php }?>
			</ul>
			<?php 
			} ?>
	</li>
	<li>|</li>
	<?php 
	} 
	?>

	<?php if(empty($_SESSION['User']['User']['id'])){?>
	<?php
	// For Register menu link
	$conditionreg = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and Content.internal_alias ='register' ".$globalcondition." ".$showcommenttab;
		$regdetails = $this->Content->find('first', array('conditions' => $conditionreg));

	if(is_array($regdetails))
	{     //user_register
		?>
		<li>
		<a  class="rhtNav" href="<?php echo Configure::read('App.base_url');?>companies/registeruser" <?php if(isset($page_url)=="signup") echo 'class="active"' ;  ?> ><span><?php
		 $titlereg =$regdetails['Content']['title'];
		if($titlereg){$titlereg =AppController::WordLimiter($titlereg,20);}
		 echo $titlereg;
		?></span></a>
		</li>
		<li>|</li>
		<?php
	}?>
	
	<?php
	// For Login menu link
	$conditionlogin = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and Content.internal_alias ='login' ".$globalcondition." ".$showcommenttab;
		$logdetails = $this->Content->find('first', array('conditions' => $conditionlogin));
		//pr($logdetails);
	if(is_array($logdetails))
	{
		?>
		<li><a  class="rhtNav" href="<?php echo Configure::read('App.base_url');?>companies/login" <?php if(isset($page_url)=="login") echo 'class="active"' ;  ?> ><span><?php
		 $titlelog =$logdetails['Content']['title'];
		if($titlelog){$titlelog =AppController::WordLimiter($titlelog,20);}
		 echo $titlelog;
		?></span></a></li>
		<?php
	}?>

	<?php } else {?>

	<?php
	// For Dashboard menu link
	$conditiondash = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and Content.internal_alias ='dashboard' ".$globalcondition." ".$showcommenttab;
		$dashdetails = $this->Content->find('first', array('conditions' => $conditiondash));

	if(is_array($dashdetails))
	{
		?>
		<li><a href="<?php echo Configure::read('App.base_url');?>companies/dashboard" class="rhtNav" <?php if($page_url=="dashboard") echo 'class="active"' ;  ?> ><span><?php
		 $titledash =$dashdetails['Content']['title'];
		if($titledash){$titledash =AppController::WordLimiter($titledash,20);}
		 echo $titledash;
		?></span></a></li><li>|</li>
		<?php
	}?>
    
	<?php
	// For Logout menu link
	$conditionlogout = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and Content.internal_alias ='logout' ".$globalcondition." ".$showcommenttab;
		$logoutdetails = $this->Content->find('first', array('conditions' => $conditionlogout));
	if(is_array($logoutdetails))
	{
		$logoutalias = $session->read("logouturl");
		?>
		<li><a href="<?php echo Configure::read('App.base_url');?>companies/logout/<?php echo $logoutalias;?>"  class="rhtNav" <?php if($page_url=="logout") echo 'class="active"' ;  ?> ><span><?php
		 $titlelogout =$logoutdetails['Content']['title'];
		if($titlelogout){$titlelogout =AppController::WordLimiter($titlelogout,20);}
		 echo $titlelogout;
		?></span></a></li>
		<?php
	}?>
	<?php }?>
</ul>