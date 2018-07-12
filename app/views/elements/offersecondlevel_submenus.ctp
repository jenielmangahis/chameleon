<?php if($this->loginarea){
	if($this->loginarea=='companies'){
		 $tab='companylist'; 
	}else if($this->loginarea=='offers'){
		$tab='offerlist'; 
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
  <div class="clear"></div>                                                                     
            <ul id="tab-container-1-nav" class="topTabs2">
					  <li>
						<?php 
							e($html->link(
								$html->tag('span', 'By Member'),
								array('controller'=>$this->loginarea,'action'=>'bymember'),
								array('escape' => false,'class'=> ($this->subtabsel=="bymember")?'tabSelt':'')
								)
							);
						?>
					</li>
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'By Merchants'),
								array('controller'=>$this->loginarea,'action'=>'bymerchant'),
								array('escape' => false,'class'=> ($this->subtabsel=="bymerchant")? 'tabSelt':'')
								)
							);
						?>
					</li>

					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Pledges/Discount'),
								array('controller'=>$this->loginarea,'action'=>'by_pledge_discount'),
								array('escape' => false,'class'=> ($this->subtabsel=="by_pledge_discount")?'tabSelt':'')
								)
							);
						?>
					</li>

                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Coupons'),
								array('controller'=>$this->loginarea,'action'=>'coupons'),
								array('escape' => false,'class'=> ($this->subtabsel=="coupons")?'tabSelt':'')
								)
							);
						?>
					</li>

                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Offer Calendar'),
								array('controller'=>'offers','action'=>'calendar'),
								array('escape' => false,'class'=> ($this->subtabsel=="calendar")?'tabSelt':'')
								)
							);
						?>

					</li>

				   
            </ul>
           <div class="clear"></div> 
<?php }?>