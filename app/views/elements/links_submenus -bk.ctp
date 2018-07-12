<div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2">
             <li>
				<?php
						e($html->link(
							$html->tag('span', 'Active'),
							array('controller'=>'links','action'=>'activelinklist'),
							array('class'=> ($this->subtabsel=="activelinklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>    
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'In-Active'),
							array('controller'=>'links','action'=>'inactivelinklist'),
							array('class'=> ($this->subtabsel=="inactivelinklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Address'),
							array('controller'=>'links','action'=>'addresslink'),
							array('class'=> ($this->subtabsel=="addresslink")?'tabSelt':'','escape' => false)
							)
						);
					?>

			</li>
			<li>		
				<?php
						e($html->link(
							$html->tag('span', 'Placement'),
							array('controller'=>'links','action'=>'palcementlink'),
							array('class'=> ($this->subtabsel=="palcementlink")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Groups'),
							array('controller'=>'links','action'=>'groupslink'),
							array('class'=> ($this->subtabsel=="groupslink")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>   
            <li>
					<?php
						e($html->link(
							$html->tag('span', 'Videos'),
							array('controller'=>'links','action'=>'videoslink'),
							array('class'=> ($this->subtabsel=="videoslink")?'tabSelt':'','escape' => false)
							)
						);
					?>

				</li>          
				<li>
					<?php
						e($html->link(
							$html->tag('span','History'),
							array('controller'=>'admins','action'=>'#'),
							array('class'=> ($this->subtabsel=="#")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
            </ul>