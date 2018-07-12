<?php
	
	if($this->loginarea){?>
           <div class="clear">

			<?php
			e($html->image('spacer.gif',array('width'=>'1','height'=>'12px')));
			?>
		</div>
            <div style="height: 30px; clear:both; float:left;">
                <div id="tab-container-1">
                    <ul id="tab-container-1-nav" class="topTabs2">
                        <li>
							<?php
									e($html->link(
									$html->tag('span', 'Details'),
									array('controller'=>$this->loginarea,'action'=>'editholder',$recordid),
									array('class'=> ($this->subtabsel=="details")?'tabSelt':'','escape' => false )
									)
								);
							?>
						</li>
                       
                        <li>
							<?php
									e($html->link(
									$html->tag('span', 'Emails'),
									array('controller'=>$this->loginarea,'action'=>'memberemails',$recordid),
									array('class'=> ($this->subtabsel=="emails")?'tabSelt':'','escape' => false )
									)
								);
							?>		
						</li> 
                        
                        <li>
							<?php
									e($html->link(
									$html->tag('span', 'Events'),
									array('controller'=>$this->loginarea,'action'=>'memberevents',$recordid),
									array('class'=> ($this->subtabsel=="events")?'tabSelt':'','escape' => false )
									)
								);
							?>	

						</li> 
						      
						    <li>
							<?php
									e($html->link(
									$html->tag('span', 'Coupons'),
									array('controller'=>$this->loginarea,'action'=>'membercoupon',$recordid),
									array('class'=> ($this->subtabsel=="membercoupon")?'tabSelt':'','escape' => false )
									)
								);
							?>
						</li>
						 <li>
							<?php
									e($html->link(
									$html->tag('span', 'Surveys'),
									array('controller'=>$this->loginarea,'action'=>'membersurvey',$recordid),
									array('class'=> ($this->subtabsel=="membersurveylist")?'tabSelt':'','escape' => false )
									)
								);
							?>
						</li>	
						<li>
							<?php
									e($html->link(
									$html->tag('span', 'Points'),
									array('controller'=>$this->loginarea,'action'=>'memberpoints',$recordid),
									array('class'=> ($this->subtabsel=="memberpoints")?'tabSelt':'','escape' => false )
									)
								);
							?>
						</li>	
                        
                        <li>
							<?php
									e($html->link(
									$html->tag('span', 'History'),
									array('controller'=>$this->loginarea,'action'=>'memberhistory',$recordid),
									array('class'=> ($this->subtabsel=="memberhistory")?'tabSelt':'','escape' => false )
									)
								);
							?>
						</li> 
                   </ul>
                </div>
            </div>  
            <div class="clear"></div>
<?php }?>