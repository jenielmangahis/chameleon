<?php if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='players'){
		$tab='types';
	} 
?>   

    <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Company'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'company'),
								array('escape' => false,'class'=> ($this->subtabsel=="company")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Contact'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'contact'),
								array('escape' => false,'class'=> ($this->subtabsel=="contact")?'tabSelt':'')
								)
							);
						?>
					</li>
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Categories'),
								array('controller'=>$this->loginarea,'action'=>$tab,'category'),
								array('escape' => false,'class'=> ($this->subtabsel=="category")?'tabSelt':'')
								
								)
							);
						?>
					</li>
					  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Non-Profit'),
								array('controller'=>$this->loginarea,'action'=>$tab ,'nonprofit'),
								array('escape' => false,'class'=> ($this->subtabsel=="nonprofit")?'tabSelt':'')
								)
							);
						?>
					</li>
					
				
            </ul> 
<?php }?>