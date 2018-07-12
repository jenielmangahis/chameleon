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
								$html->tag('span', 'Offer Pages'),
								array('controller'=>$this->loginarea,'action'=>'offerpages', 'all'),
								array('escape' => false,'class'=> ($this->subtabsel=="offerpages")?'tabSelt':'')
								)
							);
						 ?>

				</li>
                    
				 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Merchant Page'),
								array('controller'=>$this->loginarea,'action'=>'otherpages', 'merchant'),
								array('escape' => false,'class'=> ($this->subtabsel=="merchant")?'tabSelt':'')
								)
							);
						 ?>

				</li>
			
				
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Inquiry Page'),
								array('controller'=>$this->loginarea,'action'=>'otherpages', 'inquiry'),
								array('escape' => false,'class'=> ($this->subtabsel=="inquiry")?'tabSelt':'')
								)
							);
						?>

				</li>
				
				
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Event Page'),
								array('controller'=>$this->loginarea,'action'=>'otherpages', 'event'),
								array('escape' => false,'class'=> ($this->subtabsel=="event")?'tabSelt':'')
								)
							);
						?>

				</li>
				   
            </ul>
           <div class="clear"></div> 
<?php }?>