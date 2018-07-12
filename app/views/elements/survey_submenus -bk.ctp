<?php if($this->loginarea){?>                                                                     
    <div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2">
                <li>
					
					<?php
					e($html->link(
								$html->tag('span', 'Survey History'),
								array('controller'=>'surveys','action'=>'survey_history'),
								array('class'=>($this->subtabsel=="survey_history")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li>
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Survey Setup'),
								array('controller'=>$this->loginarea,'action'=>'surveylist'),
								array('class'=>($this->subtabsel=="surveylist")?'tabSelt':'','escape' => false)
								)
							);
						?>
					</li>
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Survey Action'),
								array('controller'=>$this->loginarea,'action'=>'surveyactionlist'),
								array('class'=>($this->subtabsel=="surveyactionlist")?'tabSelt':'','escape' => false)
								)
							);
						?>

					</li> 
            </ul>
    <div class="clear"></div> 
    <?php }?>