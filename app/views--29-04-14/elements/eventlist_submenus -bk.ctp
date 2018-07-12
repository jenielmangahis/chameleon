<?php if($this->loginarea){?>
           
               <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
				<div style="height: 30px; clear:both; float:left;">
                <div id="tab-container-1">
                    <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						<!--<a href="/<?php echo $this->loginarea;?>/memberlist" <?php if($this->subtabsel=="memberlist") {?> class="tabSelt" <?php } ?> ><span>Members</span></a>-->
						<?php
						e($html->link(
									$html->tag('span', 'Detail'),
									'/'.$this->loginarea.'/eventcreate',
									array('class'=> ($this->subtabsel=="eventlist")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
					<li>
						<?php
						e($html->link(
									$html->tag('span', 'RSVP'),
									'/'.$this->loginarea.'/rsvp',
									array('class'=> ($this->subtabsel=="rsvp")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
                    <li>
						<?php
						e($html->link(
									$html->tag('span', 'Wait List'),
									'/'.$this->loginarea.'/waitlist',
									array('class'=> ($this->subtabsel=="waitlist")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
					 <li>
					<?php
						e($html->link(
									$html->tag('span', 'Send Invite'),
									'/'.$this->loginarea.'/send_invite',
									array('class'=> ($this->subtabsel=="sendInvite")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li> 
                    <li>					
						<?php
						e($html->link(
									$html->tag('span', 'Event Task'),
									'/'.$this->loginarea.'/eventtasklist',
									array('class'=> ($this->subtabsel=="eventtasklist")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>  
                    <li>					
						<?php
						e($html->link(
									$html->tag('span', 'Invite'),
									'/'.$this->loginarea.'/eventinvitationhistory',
									array('class'=> ($this->subtabsel=="eventinvitationhistory")?'tabSelt':'','escape' => false )
									)
						);
					?>

					</li> 
					
                    </ul>
                </div>
            </div>  
            <div class="clear"></div>
<?php }?>