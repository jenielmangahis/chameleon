<?php if($this->loginarea){?>
<div class="clear"></div>
<div id="tab-container-1">
                    <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						
					<?php
						e($html->link(
									$html->tag('span', 'Members'),
									'/'.$this->loginarea.'/memberlist',
									array('class'=> ($this->subtabsel=="memberlist")?'tabSelt':'','escape' => false )
									)
						);
					?>					
					</li>
					<li>
						
					<?php
						e($html->link(
									$html->tag('span', 'Message'),
									'/'.$this->loginarea.'/messagelist',
									array('class'=> ($this->subtabsel=="messagelist")?'tabSelt':'','escape' => false )
									)
						);
					?>
					
					</li>
					<li>
						<?php
						e($html->link(
									$html->tag('span', 'Map'),
									'/'.$this->loginarea.'/map',
									array('class'=> ($this->subtabsel=="map")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
					<li>
						
					<?php
						e($html->link(
									$html->tag('span', 'Types'),
									'/'.$this->loginarea.'/membertypes',
									array('class'=> ($this->subtabsel=="membertypes")?'tabSelt':'','escape' => false )
									)
						);
					?>
					
					</li>
					<!--<li>
						
					<?php
						e($html->link(
									$html->tag('span', 'Company Types'),
									'/'.$this->loginarea.'/companytype',
									array('class'=> ($this->subtabsel=="companytypes")?'tabSelt':'','escape' => false )
									)
						);
					?>
					
					</li>-->		
                   <!--<li>
						<?php
						e($html->link(
									$html->tag('span', 'Type'),
									'/'.$this->loginarea.'/membertypes',
									array('class'=> ($this->subtabsel=="membertypes")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>-->
					 <li>
					<?php
						e($html->link(
									$html->tag('span', 'Top Points'),
									'/'.$this->loginarea.'/top_points',
									array('class'=> ($this->subtabsel=="top_points")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li> 
                    <li>					
						<?php
						e($html->link(
									$html->tag('span', 'Points Detail'),
									'/'.$this->loginarea.'/points_detail',
									array('class'=> ($this->subtabsel=="points_detail")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>  
                    <li>					
						<?php
						e($html->link(
									$html->tag('span', 'Points Setup'),
									'/'.$this->loginarea.'/points',
									array('class'=> ($this->subtabsel=="points")?'tabSelt':'','escape' => false )
									)
						);
					?>

					</li> 
					<li>					
						<?php
						e($html->link(
									$html->tag('span', 'By Levels'),
									'/'.$this->loginarea.'/membersbylevel',
									array('class'=> ($this->subtabsel=="level")?'tabSelt':'','escape' => false )
									)
						);
					?>

					</li>
					<li>					
						<?php
						e($html->link(
									$html->tag('span', 'Level Setup'),
									'/'.$this->loginarea.'/memberlevels',
									array('class'=> ($this->subtabsel=="levelsetup")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
					<li>					
						<?php
						e($html->link(
									$html->tag('span', 'Coin Holders'),
									'/'.$this->loginarea.'/coinholderslist',
									array('class'=> ($this->subtabsel=="coinholderslist")?'tabSelt':'','escape' => false )
									)
						);
					?>
					</li>
					     
                    </ul>
                </div>
<?php }?>