<?php if($this->loginarea){?>                                                                     
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
					e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>'surveys','action'=>'survey_history'),
								array('class'=>($this->subtabsel=="survey_history")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li>
<?php
	
?>				
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Setup'),
								array('controller'=>$this->loginarea,'action'=>'surveylist'),
								array('class'=>($this->subtabsel=="surveylist")?'tabSelt':'','escape' => false)
								)
							);
						?>
					</li>
<?php

?>					
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Action'),
								array('controller'=>'surveys','action'=>'surveyactionlist'),
								array('class'=>($this->subtabsel=="surveyactionlist")?'tabSelt':'','escape' => false)
								)
							);
						?>

					</li> 
<?php  ?>			

				<li>
						<?php
							e($html->link(
								$html->tag('span', 'Messages'),
								array('controller'=>'admins','action'=>'messagelist','0'),
								array('class'=>($this->subtabsel=="messagelist")?'tabSelt':'','escape' => false)
								)
							);
						?>

					</li> 
					
				<li>
						<?php
							e($html->link(
								$html->tag('span', 'Comments'),
								array('controller'=>'admins','action'=>'commentlist','0'),
								array('class'=>($this->subtabsel=="commentlist")?'tabSelt':'','escape' => false)
								)
							);
						?>

					</li> 
				<li>
						<?php
							e($html->link(
								$html->tag('span', 'Replies'),
								array('controller'=>'admins','action'=>'commentreplylist','0'),
								array('class'=>($this->subtabsel=="commentreplylist")?'tabSelt':'','escape' => false)
								)
							);
						?>

					</li>

				<li>
						<?php
							e($html->link(
								$html->tag('span', 'Suggested Comments'),
								array('controller'=>'admins','action'=>'suggestedlist','0'),
								array('class'=>($this->subtabsel=="suggestedlist")?'tabSelt':'','escape' => false)
								)
							);
						?>

					</li>  	

					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Comment Types'),
								array('controller'=>'admins','action'=>'suggestedcomments','0'),
								array('class'=>($this->subtabsel=="suggestedcomments")?'tabSelt':'','escape' => false)
								)
							);
						?>

					</li>  							

		
            </ul>
    <div class="clear"></div> 
    <?php }?>