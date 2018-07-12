<?php if($this->loginarea){
	if($this->loginarea=='companies'){
		 $tab='companylist'; 
	}else if($this->loginarea=='offers'){
		$tab='offerlist'; 
	} 
?>
  <div class="clear"></div>                                                                     
            <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Current'),
								array('controller'=>$this->loginarea,'action'=>'offeremail'),
								array('escape' => false,'class'=> ($this->subtabsel=="currentofferlist" || $this->subtabsel=="offerlist")?'tabSelt':'')
								)
							);
						?>
					</li>
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'tasks'),
								array('controller'=>$this->loginarea,'action'=>'tasklist'),
								array('escape' => false,'class'=> ($this->subtabsel=="tasklist")?'tabSelt':'')
								)
							);
						?>
					</li>
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Templates'),
								array('controller'=>$this->loginarea,'action'=>'offertemplatelist'),
								array('escape' => false,'class'=> ($this->subtabsel=="offertemplatelist")?'tabSelt':'')
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
								array('controller'=>$this->loginarea,'action'=>'offertaskhistory'),
								array('escape' => false,'class'=> ($this->subtabsel=="offertaskhistory")?'tabSelt':'')
								)
							);
						?>
					</li>
					  <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Responders'),
								array('controller'=>$this->loginarea,'action'=>'offerresponderlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="offerresponder")?'tabSelt':'')
								)
							);
						?>
					</li>
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Responders History'),
								array('controller'=>$this->loginarea,'action'=>'responderhistory'),
								array('escape' => false,'class'=> ($this->subtabsel=="responderhistory")? 'tabSelt':'')
								)
							);
						?>
					</li> 
				
				   
            </ul>
           <div class="clear"></div> 
<?php }?>