<div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2">
             <li>
				<?php
						e($html->link(
							$html->tag('span', 'Active Tasks'),
							array('controller'=>'mailtasks','action'=>'activetasklist'),
							array('class'=> ($this->subtabsel=="activetasklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>    
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Task History'),
							array('controller'=>'mailtasks','action'=>'taskhistorylist'),
							array('class'=> ($this->subtabsel=="taskhistorylist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Templates'),
							array('controller'=>'mailtasks','action'=>'mailtemplatelist'),
							array('class'=> ($this->subtabsel=="mailtemplatelist")?'tabSelt':'','escape' => false)
							)
						);
					?>

			</li>
			<li>		
				<?php
						e($html->link(
							$html->tag('span', 'Responders'),
							array('controller'=>'mailtasks','action'=>'mailresponderlist'),
							array('class'=> ($this->subtabsel=="mailresponderlist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Mail Defaults'),
							array('controller'=>'mailtasks','action'=>'maildefaults'),
							array('class'=> ($this->subtabsel=="maildefaults")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>   
            <li>
					<?php
						e($html->link(
							$html->tag('span', 'Mail Footer'),
							array('controller'=>'mailtasks','action'=>'mail_footer'),
							array('class'=> ($this->subtabsel=="mail_footer")?'tabSelt':'','escape' => false)
							)
						);
					?>

				</li>          
				<li>
					<?php
						e($html->link(
							$html->tag('span','Opt-Out History'),
							array('controller'=>'mailtasks','action'=>'opt_out_history'),
							array('class'=> ($this->subtabsel=="opt_out_history")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
            </ul>