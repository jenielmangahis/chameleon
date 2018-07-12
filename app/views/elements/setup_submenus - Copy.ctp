<?php if($this->loginarea){?>                                                                     
    <div class="clear">
	
	<img src="../../img/spacer.gif" width="1" height="12px;" /></div>
    <div style="height: 30px; clear:both;">
        <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">
                <li>
					<!--<a href="/<?php echo $this->loginarea;?>/settings" <?php if($this->subtabsel=="settings") {?> class="tabSelt" <?php }?> ><span>Settings</span></a>-->
					
					<?php

						$className = $this->subtabsel=="settings" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Settings'),
						array('controller'=>'admins','action'=>'settings'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>

				</li>
                <li>
					<!--<a href="/<?php echo $this->loginarea;?>/coinsetlist" <?php if($this->subtabsel=="coinsetlist") {?> class="tabSelt" <?php } ?>><span>Coinsets</span></a>-->
					<?php

						$className = $this->subtabsel=="coinsetlist" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Coinsets'),
						array('controller'=>'admins','action'=>'coinsetlist'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>

				</li>  
                <li>
					<!--<a href="/<?php echo $this->loginarea;?>/loginterms" <?php if($this->subtabsel=="loginterms") {?> class="tabSelt" <?php } ?> ><span>Terms &amp; Privacy</span></a>-->

						<?php
						$className = $this->subtabsel=="loginterms" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Terms & Privacy'),
						array('controller'=>'admins','action'=>'loginterms'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>
                
				<?php 
					
					//echo $this->subtabsel;
					if (!empty($project['Project']['url']) || $this->subtabsel=="iframes" ) {?> 
                    <li>
					<!--<a href="/<?php echo $this->loginarea;?>/iframes" <?php if($this->subtabsel=="iframes") {?> class="tabSelt" <?php } ?> ><span>iFrames</span></a>-->
					<?php
						$className = $this->subtabsel=="iframes" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'iFrames'),
						array('controller'=>'admins','action'=>'iframes'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
					
					</li> 
                    <?php } ?>
             <!--   <li>

					

					<?php
						$className = $this->subtabsel=="projectcontrols" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Controls'),
						array('controller'=>'admins','action'=>'projectcontrols'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
				</li>-->
				
				
                <?php if(!empty($project['Project']['is_shoppingcartenabled']) && $project['Project']['is_shoppingcartenabled']=="1"){ ?>
                <li>
					<!--<a href="/<?php echo $this->loginarea;?>/projectshoppingcart" <?php if($this->subtabsel=="projectshoppingcart") {?> class="tabSelt" <?php } ?> ><span>Shopping Cart</span></a>-->
					<?php
						$className = $this->subtabsel=="projectshoppingcart" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Shopping Cart'),
						array('controller'=>'admins','action'=>'projectshoppingcart'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>

				</li>
                <?php } ?>
                <li>
				<!--	<a href="/<?php echo $this->loginarea;?>/change_password" <?php if($this->subtabsel=="change_password") {?> class="tabSelt" <?php } ?> ><span>Change Password</span></a>-->
					<?php
						$className = $this->subtabsel=="change_password" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Change Password'),
						array('controller'=>'admins','action'=>'change_password'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>

				</li>
                <li>
				
					<!--<a href="/<?php echo $this->loginarea;?>/getstart" <?php if($this->subtabsel=="getstart") {?> class="tabSelt" <?php } ?>><span>Get Started</span></a>-->
					<?php
						$className = $this->subtabsel=="getstart" ? 'tabSelt' : '';	
						e($html->link(
						$html->tag('span', 'Get Started'),
						array('controller'=>'admins','action'=>'getstart'),
						array('escape' => false,'class' => $className)
						)
					  );
					?>
			
				</li>    
            </ul>
    </div> </div>
    <div class="clear"></div>
    <?php }?>