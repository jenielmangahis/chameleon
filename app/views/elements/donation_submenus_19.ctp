<?php if($this->loginarea){?>                                                                     
    <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
    <div style="height: 30px; clear:both;">
        <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">

	           	
                    <li>
						<!--<a href="/<?php echo $this->loginarea;?>/coming_soon/donationlist/donation" <?php if($this->subtabsel=="donationlist") {?> class="tabSelt" <?php } ?> ><span>Donations</span></a>-->

						<?php
							e($html->link(
								$html->tag('span', 'Donations'),
								array('controller'=>$this->loginarea,'action'=>'coming_soon','donationlist','donation'),
								array('escape' => false,'class'=> ($this->subtabsel=="donationlist")?'tabSelt':'')
								)
							);
						?>
					</li> 
					
                    <li>
						<!--<a href="/<?php echo $this->loginarea;?>/coming_soon/donationuploadlist/donation" <?php if($this->subtabsel=="donationuploadlist") {?> class="tabSelt" <?php } ?> ><span>Uploads</span></a>-->
						
						<?php
							e($html->link(
								$html->tag('span', 'Uploads'),
								array('controller'=>$this->loginarea,'action'=>'coming_soon','donationuploadlist','donation'),
								array('escape' => false,'class'=> ($this->subtabsel=="donationuploadlist")?'tabSelt':'')
								)
							);
						?>
					</li> 

						
                    <li>
						<!--<a href="/<?php echo $this->loginarea;?>/coming_soon/donationbyeventlist/donation" <?php if($this->subtabsel=="donationbyeventlist") {?> class="tabSelt" <?php } ?> ><span>By Event</span></a>-->
						
						<?php
							e($html->link(
								$html->tag('span', 'By Event'),
								array('controller'=>$this->loginarea,'action'=>'coming_soon','donationbyeventlist','donation'),
								array('escape' => false,'class'=> ($this->subtabsel=="donationbyeventlist")?'tabSelt':'')
								)
							);
						?>

					</li> 
					
                    <li>
						<!--<a href="/<?php echo $this->loginarea;?>/topdonatorslist" <?php if($this->subtabsel=="topdonatorslist") {?> class="tabSelt" <?php } ?> ><span>Top Donators</span></a>-->
						
						<?php
							e($html->link(
								$html->tag('span', 'Top Donators'),
								array('controller'=>$this->loginarea,'action'=>'topdonatorslist'),
								array('escape' => false,'class'=> ($this->subtabsel=="topdonatorslist")?'tabSelt':'')
								)
							);
						?>

					</li> 
					
                    <li>
						<!--<a href="/<?php echo $this->loginarea;?>/coming_soon/donationtypes/donation" <?php if($this->subtabsel=="donationtypes") {?> class="tabSelt" <?php } ?> ><span>Donation Types</span></a>-->
						
						<?php
							e($html->link(
								$html->tag('span', 'Donation Types'),
								array('controller'=>$this->loginarea,'action'=>'coming_soon','donationtypes','donation'),
								array('escape' => false,'class'=> ($this->subtabsel=="donationtypes")?'tabSelt':'')
								)
							);
						?>

					</li> 
              <li>
						<!--<a href="/<?php echo $this->loginarea;?>/projectdonatelevels" <?php if($this->subtabsel=="projectdonatelevels") {?> class="tabSelt" <?php } ?>><span>Donate Levels</span></a>-->
						<?php
							e($html->link(
								$html->tag('span', 'Donate Levels'),
								array('controller'=>$this->loginarea,'action'=>'projectdonatelevels'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectdonatelevels")?'tabSelt':'')
								)
							);
						?>

					</li>
					
                    <li>
						<!--<a href="/<?php echo $this->loginarea;?>/registercoinlist" <?php if($this->subtabsel=="registercoinlist") {?> class="tabSelt" <?php } ?>><span>Coins</span></a>-->
						
						<?php
							e($html->link(
								$html->tag('span', 'Coins'),
								array('controller'=>$this->loginarea,'action'=>'registercoinlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="registercoinlist")?'tabSelt':'')
								)
							);
						?>

					</li>

            </ul>
        </div>
    </div>  
    
       <div class="clear"></div> 
<?php }?>