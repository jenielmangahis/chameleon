<?php if($this->loginarea){
	if($this->loginarea=='coupons'){
		$tab='couponlist'; 
	} 
?>
  <div class="clear"></div>                                                                     
            <ul id="tab-container-1-nav" class="topTabs2">
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
                    <li>
						<?php
						if($_GET['url']==='admins/qrcodegenerate' || $_GET['url']==='coupons/couponlist'){
							e($html->link(
								$html->tag('span', 'Current'),
								array('controller'=>'coupons','action'=>'couponlist'),
								array('escape' => false,'class'=>'tabSelt')
							));
							}
							else{
							e($html->link(
								$html->tag('span', 'Current'),
								array('controller'=>'coupons','action'=>'couponlist'),
								array('escape' => false,'class'=>'')
							));
							}
						?>
					</li>
<?php

?>					
					 <li>
						<?php 
							e($html->link(
								$html->tag('span', 'Past Coupons'),
								array('controller'=>'coupons','action'=>'pastcouponlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="pastcouponlist")?'tabSelt':'')
							));
						?>
					</li>
<?php

?>					
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Calender'),
								array('controller'=>'coupons','action'=>'calendar'),
								array('escape' => false,'class'=> ($this->subtabsel=="calendar")?'tabSelt':'')
							));
						?>
					</li>
<?php

?>					
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Layouts'),
								array('controller'=>'coupons','action'=>'layout'),
								array('escape' => false,'class'=> ($this->subtabsel=="layouts")?'tabSelt':'')
							));
						?>
					</li>
				
            </ul>
           <div class="clear"></div> 
<?php }?>