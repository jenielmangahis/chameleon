<?php if($this->loginarea){?>                                                                     
    <div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2">
                <li>
					
					<?php
					e($html->link(
								$html->tag('span', 'Surveys'),
								array('controller'=>'surveys','action'=>'survey_response',$survey_id),
								array('class'=>($this->subtabsel=="survey_response")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li>
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'By Action'),
								array('controller'=>$this->loginarea,'action'=>'surveybyaction',$survey_id),
								array('class'=>($this->subtabsel=="surveybyaction")?'tabSelt':'','escape' => false)
								)
							);
						?>
				</li>
					
            </ul>
    <div class="clear"></div> 
    <?php }?>