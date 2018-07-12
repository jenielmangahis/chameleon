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
    <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Tasks'),
								array('controller'=>'offers','action'=>'tasklist' ,'Tasks'),
								array('escape' => false,'class'=> ($this->subtabsel=="companylist")?'tabSelt':'')
								)
							);
						?>
					</li>

                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Templates'),
								array('controller'=>'offers','action'=>'offertemplatelist' ,'Templates'),
								array('escape' => false,'class'=> ($this->subtabsel=="merchantlist")?'tabSelt':'')
								)
							);
						?>
					</li>

					  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Active'),
								array('controller'=>'offers','action'=>'activetask' ,'Active'),
								array('escape' => false,'class'=> ($this->subtabsel=="nonprofitlist")?'tabSelt':'')
								)
							);
						?>
					</li>
				
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Task History'),
								array('controller'=>'offers','action'=>'offertaskhistory','Task History'),
								array('escape' => false,'class'=> ($this->subtabsel=="vendorlist")?'tabSelt':'')
								
								)
							);
						?>
					</li>
	
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Responders'),
								array('controller'=>'offers','action'=>'offerresponderlist','Responders'),
								array('escape' => false,'class'=> ($this->subtabsel=="salelist")?'tabSelt':'') 
								)
							);
						?>
					</li>
	
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Respond History'),
								array('controller'=>'offers','action'=>'responderhistory' ,'Respond History' ),
								array('escape' => false,'class'=> ($this->subtabsel=="advertiserlist")?'tabSelt':'')
								)
							);
						?>
					</li>
					
            </ul> 
            
<?php }?>