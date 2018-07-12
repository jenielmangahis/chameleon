<?php if($this->loginarea){
	if($this->loginarea=='coupons'){
		$tab='couponlist'; 
	} 
?>
  <div class="clear"></div>                                                                     
            <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Current'),
								array('controller'=>$this->loginarea,'action'=>$tab),
								array('escape' => false,'class'=> ($this->subtabsel=="couponlist")?'tabSelt':'')
							));
						?>
					</li>
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Past Coupons'),
								array('controller'=>$this->loginarea,'action'=>'pastcouponlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="pastcouponlist")?'tabSelt':'')
							));
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Calender'),
								array('controller'=>$this->loginarea,'action'=>'calendar'),
								array('escape' => false,'class'=> ($this->subtabsel=="calendar")?'tabSelt':'')
							));
						?>
					</li>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Layouts'),
								array('controller'=>$this->loginarea,'action'=>'layout'),
								array('escape' => false,'class'=> ($this->subtabsel=="layouts")?'tabSelt':'')
							));
						?>
					</li>
            </ul>
           <div class="clear"></div> 
<?php }?>