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

?>    	
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Detail'),
								array('controller'=>'players','action'=>'playerslist' ,'merchant'),
								//array('controller'=>$this->loginarea,'action'=>'playerslist' ,'merchant'),
								array('escape' => false,'class'=> ($f_name=="playerslist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>

<?php 

$checkSubMenu = "Merchants";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
                    <li>
						<?php
						
						if($_GET['url'] === 'players/branchlist/company' || ($this->params['controller']==='players' && ($this->params['action']==='branchlist') && ($this->params['pass'][0]==='company' || $this->params['pass'][0]==='vendor' || $this->params['pass'][0]==='sale'|| $this->params['pass'][0]==='merchant'|| $this->params['pass'][0]==='nonprofit' || $this->params['pass'][0]==='advertiser'))){
							e($html->link(
								$html->tag('span', 'Branches'),
								array('controller'=>'players','action'=>'branchlist' ,'company'),
							//array('controller'=>$this->loginarea,'action'=>'branchlist' ,'company'),
							array('escape' => false,'class'=> 'tabSelt dropdown-item')								
								)
							);
							}else{
						
							e($html->link(
								$html->tag('span', 'Branches'),
								array('controller'=>'players','action'=>'branchlist' ,'company'),
							//array('controller'=>$this->loginarea,'action'=>'branchlist' ,'company'),
							array('escape' => false,'class'=> '')	
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
						if(($this->params['controller']==='players' && ($this->params['action']==='addgraphic') && ($this->params['pass'][0]==='company' || $this->params['pass'][0]==='vendor' || $this->params['pass'][0]==='sale'|| $this->params['pass'][0]==='merchant'|| $this->params['pass'][0]==='nonprofit'|| $this->params['pass'][0]==='advertiser'))){
							e($html->link(
								$html->tag('span', 'Graphics'),
								array('controller'=>'players','action'=>'addgraphic' ,'company'),
								//array('controller'=>$this->loginarea,'action'=>'addgraphic' ,'company'),
							array('escape' => false,'class'=> 'tabSelt dropdown-item')	
								)
							);
							}else{
							
							e($html->link(
								$html->tag('span', 'Graphics'),
								array('controller'=>'players','action'=>'addgraphic' ,'company'),
								//array('controller'=>$this->loginarea,'action'=>'addgraphic' ,'company'),
							array('escape' => false,'class'=> '')	
								)
							);
							}
						?>
					</li>
<?php 

?>					
					 <li>
						<?php
						
						if(($this->params['controller']==='players' && ($this->params['action']==='addwebpage') && ($this->params['pass'][0]==='company' || $this->params['pass'][0]==='vendor' || $this->params['pass'][0]==='sale'|| $this->params['pass'][0]==='merchant'|| $this->params['pass'][0]==='nonprofit'|| $this->params['pass'][0]==='advertiser'))){
							e($html->link(
								$html->tag('span', 'Webpage'),
								array('controller'=>'players','action'=>'addwebpage','company'),
								//array('controller'=>$this->loginarea,'action'=>'addwebpage','company'),
							array('escape' => false,'class'=> 'tabSelt dropdown-item')	
								)
							);
							}else{
							e($html->link(
								$html->tag('span', 'Webpage'),
								array('controller'=>'players','action'=>'addwebpage','company'),
								//array('controller'=>$this->loginarea,'action'=>'addwebpage','company'),
							array('escape' => false,'class'=> '')
								
								)
							);
							}
						?>
					</li>
<?php 


?>					
					 <li>
						<?php
						
						if(($this->params['controller']==='players' && ($this->params['action']==='offerlist') && ($this->params['pass'][0]==='company' || $this->params['pass'][0]==='vendor' || $this->params['pass'][0]==='sale'|| $this->params['pass'][0]==='merchant'|| $this->params['pass'][0]==='nonprofit'|| $this->params['pass'][0]==='advertiser'))){
							e($html->link(
								$html->tag('span', 'Offers'),
								array('controller'=>'players','action'=>'offerlist','company'),
							//array('controller'=>$this->loginarea,'action'=>'offerlist','company'),
							array('escape' => false,'class'=> 'tabSelt dropdown-item')	
								)
							);
							}else{		
							
							e($html->link(
								$html->tag('span', 'Offers'),
								array('controller'=>'players','action'=>'offerlist','company'),
								//array('controller'=>$this->loginarea,'action'=>'offerlist','company'),
								array('escape' => false,'class'=> '')	
								)
							);
							}
						?>
					</li>
<?php 

$checkSubMenu = "Player Notes";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
                    <li>
						<?php
							
							if($_GET['url'] === 'players/notelist/company' || $_GET['url'] === ''){
							e($html->link(
								$html->tag('span', 'Notes'),
								array('controller'=>'players','action'=>'addnote' ,'company' ),
								//array('controller'=>$this->loginarea,'action'=>'addnote' ,'company' ),
								array('escape' => false,'class'=> 'tabSelt dropdown-item')	
								)
							);
							}else{
							e($html->link(
								$html->tag('span', 'Notes'),
								array('controller'=>'players','action'=>'addnote' ,'company' ),
								//array('controller'=>$this->loginarea,'action'=>'addnote' ,'company' ),
								array('escape' => false,'class'=> '')	
								)
							);	
							
							}
						?>
					</li>
<?php 
}

?>					
            
<?php 

?>
					<li>
						<?php
						if($_GET['url'] === 'players/notelist/0' || $_GET['url']==='players/notelist/company' || ($this->params['controller']==='players' && $this->params['action']==='addnote') || ($this->params['controller']==='players' && ($this->params['action']==='notelist' || $this->params['action']==='addnote') && ($this->params['pass'][0]==='company' || $this->params['pass'][0]==='vendor' || $this->params['pass'][0]==='sale'|| $this->params['pass'][0]==='merchant'|| $this->params['pass'][0]==='nonprofit'|| $this->params['pass'][0]==='advertiser'))){
							e($html->link(
								$html->tag('span', 'Note'),
								array('controller'=>'players','action'=>'notelist' ,'0' ),
								array('escape' => false,'class'=> 'tabSelt dropdown-item')
								)
							);
							}else{
							e($html->link(
								$html->tag('span', 'Note'),
								array('controller'=>'players','action'=>'notelist' ,'0' ),
								array('escape' => false,'class'=> '')
								)
							);
							
							}
						?>
					</li>
					
					<li>
						<?php
						if($_GET['url'] === 'players/historylist/company' || ($this->params['controller']==='players' && ($this->params['action']==='historylist') && ($this->params['pass'][0]==='company' || $this->params['pass'][0]==='vendor' || $this->params['pass'][0]==='sale'|| $this->params['pass'][0]==='merchant'|| $this->params['pass'][0]==='nonprofit'|| $this->params['pass'][0]==='advertiser'))){						
						e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>'players','action'=>'historylist' ,'company'),
								//array('controller'=>$this->loginarea,'action'=>'historylist' ,'company'),
								array('escape' => false,'class'=>'tabSelt dropdown-item')
								)
							);
	}else{
	
			e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>'players','action'=>'historylist' ,'company'),
								//array('controller'=>$this->loginarea,'action'=>'historylist' ,'company'),
								array('escape' => false,'class'=>'')
								)
							);
	
	}						
						?>
					</li>
<?php
$checkSubMenu = "Email";					
$flagSubHideMenuPermission = $common->checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name);
if($flagSubHideMenuPermission)
{	
?>					
					<li>
						<?php
						
if($_GET['url'] === 'admins/sendtempmail/company'){
						e($html->link(
								$html->tag('span', 'Send Mail'),
								array('controller'=>'admins','action'=>'sendtempmail', 'company'  ),
								array('escape' => false,'class'=> 'tabSelt dropdown-item')
								)
							);
}else{
						e($html->link(
								$html->tag('span', 'Send Mail'),
								array('controller'=>'admins','action'=>'sendtempmail', 'company'  ),
								array('escape' => false,'class'=> '')
								)
							);



}							
						?>

					</li>
<?php 
}
?>		

				
            </ul> 

	</div>
</div>            
<?php }?>

<script type="text/javascript">
	$('#dropdownMenuButton').on('show.bs.dropdown', function () {
	  $('.dropdown-toggle').dropdown();
	});
</script>