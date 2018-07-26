<?php 
//$companyId = $this->params['pass']['0'];
if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='prospects'){
		$tab='projectmerchant';
	} 
?>                                                                     
  <div class="clear"></div> 
  
<div id="tab-container-1" class="dropdown-button-container">
    <div class="dropdown">
        
        <button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select Sub-Menu List
        </button>  
          
            						<!--<ul id="tab-container-1-nav" class="topTabs2">OLD-->
            <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
						<?php
							$addtye = ($addtype == "Marchant")? "addmerchant" : "addprospectnonprofit" ;	

						if($_GET['url']==='prospects/projectmerchant/1' || $_GET['url']==='prospects/prospectnonprofit'){
							e($html->link(

								$html->tag('span', 'Detail'),
								array('controller'=>'prospects','action'=>'projectmerchant','1'),
								array('escape' => false,'class'=> 'tabSelt dropdown-item')
								)
							);
							}
							else{
							e($html->link(

								$html->tag('span', 'Detail'),
								array('controller'=>'prospects','action'=>'projectmerchant','1'),
								array('escape' => false,'class'=>'')
								)
							);
							}
						?>
					</li>
					
					  <li>
						<?php
					
							e($html->link(
								$html->tag('span', 'Branches'),
								array('controller'=>$this->loginarea,'action'=>'branchlist',$cid,$addtype),
								array('escape' => false,'class'=> ($this->subtabsel=="brancheslist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
					
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Graphics'),
								array('controller'=>$this->loginarea,'action'=>'addgraphic',$cid,$addtype),
								array('escape' => false,'class'=> ($this->subtabsel=="graphics" || $this->subtabsel=="graphics")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
					
					 <li>
						<?php
						if($_GET['url'] ==='prospects/prospectemaillist'){
							e($html->link(
								$html->tag('span', 'Email'),
								array('controller'=>'prospects','action'=>'prospectemaillist'),
								array('escape' => false,'class'=> 'tabSelt dropdown-item')
								)
							);
							}else{
							e($html->link(
								$html->tag('span', 'Email'),
								array('controller'=>'prospects','action'=>'prospectemaillist'),
								array('escape' => false,'class'=> '')
								)
							);
							
							}
						?>
					</li>
					
					
					
					
                  
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Notes'),
								array('controller'=>$this->loginarea,'action'=>'notelist',$cid,$addtype),
								array('escape' => false,'class'=> ($this->subtabsel=="notelist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>$this->loginarea,'action'=>'history',$cid,$addtype),
								array('escape' => false,'class'=> ($this->subtabsel=="history")?'tabSelt dropdown-item':'')
								)
							);
						?>

					</li>
					
					
					
					
				
				   
            </ul>
     
       <div class="clear"></div>
	</div>        
</div>    
<?php }?>

<script type="text/javascript">
	$('#dropdownMenuButton').on('show.bs.dropdown', function () {
	  $('.dropdown-toggle').dropdown();
	});
</script>