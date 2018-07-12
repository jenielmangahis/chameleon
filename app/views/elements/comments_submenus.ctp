<?php if($this->loginarea){?>                                                                     
    <div class="clear">
		<?php e($html->image('spacer.gif',array('width'=>'1px','height'=>'12px')));?>
	</div>
    <div style="height: 30px; clear:both;">
        <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">
                 <li>
						
						<?php
						e($html->link(
							$html->tag('span', 'Messages'),
							array('controller'=>$this->loginarea,'action'=>'messagelist'),
							array('class'=> ($this->subtabsel=="messagelist")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li>
                        <li>
								
								<?php
						e($html->link(
							$html->tag('span', 'Comments'),
							array('controller'=>$this->loginarea,'action'=>'commentlist'),
							array('class'=> ($this->subtabsel=="commentlist")?'tabSelt':'','escape' => false)
							)
						);
					?>
						</li>
                        <li>
							<?php
								e($html->link(
								$html->tag('span', 'Replies'),
								array('controller'=>$this->loginarea,'action'=>'commentreplylist'),
								array('class'=> ($this->subtabsel=="commentreplylist")?'tabSelt':'','escape' => false)
								)
							);
						?>
						</li>
                        <li>
							<?php
								e($html->link(
									$html->tag('span', 'Suggested Comments'),
									array('controller'=>$this->loginarea,'action'=>'suggestedlist'),
									array('class'=> ($this->subtabsel=="suggestedlist")?'tabSelt':'','escape' => false)
									)
								);
							?>
						</li>
                        <li>
								
								<?php
						e($html->link(
							$html->tag('span', 'Comment Types'),
							array('controller'=>$this->loginarea,'action'=>'suggestedcomments'),
							array('class'=> ($this->subtabsel=="suggestedcomments")?'tabSelt':'','escape' => false)
							)
						);
					?>
						</li>
                       <!-- <li><a href="/< ?php echo $this->loginarea;?>/rsvplist" < ?php if($this->subtabsel=="rsvplist") {?> class="tabSelt" < ?php } ?>><span>RSVP</span></a></li>   -->
            </ul>
        </div>
    </div>  

    <div class="clear"></div> 
    <?php }?>