<?php if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='prospects'){
		$tab='prospectemaillist';
	} 
?>                                                                     
<div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Tasks'),
								array('controller'=>$this->loginarea,'action'=>$tab),
								array('escape' => false,'class'=> ($this->subtabsel=="prospectemails" || $this->subtabsel=="projectmerchantlist")?'tabSelt':'')
								)
							);
						?>
					</li>
					  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Templates'),
								array('controller'=>$this->loginarea,'action'=>'prospectemailtemplate'),
								array('escape' => false,'class'=> ($this->subtabsel=="emailtemplate")?'tabSelt':'')
								)
							);
						?>
					</li>
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Active'),
								array('controller'=>$this->loginarea,'action'=>'activetask'),
								array('escape' => false,'class'=> ($this->subtabsel=="activetask")?'tabSelt':'')
								
								)
							);
						?>
					</li>
					
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Task History'),
								array('controller'=>$this->loginarea,'action'=>'taskhistory'),
									
								array('escape' => false,'class'=> ($this->subtabsel=="taskhistory")?'tabSelt':'') 
								)
							);
						?>
					</li>
					
                  
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Responders'),
								array('controller'=>$this->loginarea,'action'=>'responders'),
								array('escape' => false,'class'=> ($this->subtabsel=="responders")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Responder History'),
								array('controller'=>$this->loginarea,'action'=>'responderhistory'),
								array('escape' => false,'class'=> ($this->subtabsel=="responder_history")?'tabSelt':'')
								)
							);
						?>

					</li>
					
            </ul>
       <div class="clear"></div> 
<?php }?>