<?php if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='players'){
		$tab='tasklist';
	} 
?>     

<div class="clear"></div>
	<div class="dropdown">
    	<button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    		Select Menu List
   		</button>
        <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Tasks'),
								array('controller'=>$this->loginarea,'action'=>$tab),
								array('escape' => false,'class'=> ($this->subtabsel=="tasklist")?'tabSelt':'')
								)
							);
						?>
					</li>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Templates'),
								array('controller'=>$this->loginarea,'action'=>'templatelist'),
								array('escape' => false,'class'=> ($this->subtabsel=="templatelist")?'tabSelt':'')
								)
							);
						?>
					</li>
					<li>
						<?php 
							e($html->link(
								$html->tag('span', 'Active'),
								array('controller'=>$this->loginarea,'action'=>'activelist'),
								array('escape' => false,'class'=> ($this->subtabsel=="activelist")?'tabSelt':'')
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
								$html->tag('span', 'Responders History'),
								array('controller'=>$this->loginarea,'action'=>'responderhistory'),
								array('escape' => false,'class'=> ($this->subtabsel=="responder_history")?'tabSelt':'')
								)
							);
						?>
					</li>
            </ul>
</div>
            
           <div class="clear"></div> 
<?php }?>