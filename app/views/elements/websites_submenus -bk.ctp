<?php if($this->loginarea){?>                                                                     
    <div class="clear">
	<?php
		e( 	$html->image('spacer.gif',array('width'=>1,'height'=>'12px'))	);
	?>
	</div>
    <div style="height: 30px; clear:both;">
        <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'Web Pages'),
						array('controller'=>'admins','action'=>'contentlist'),
						array('class'=>($this->subtabsel=="contentlist")?'tabSelt':'','escape' => false)
						)
					);
					?>
					</li>
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'System Pages'),
						array('controller'=>'admins','action'=>'systemlist'),
						array('class'=>($this->subtabsel=="systemlist")?'tabSelt':'','escape' => false)
						)
					);
					?>
					</li> 
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'Themes'),
						array('controller'=>'admins','action'=>'settingthemes'),
						array('class'=>($this->subtabsel=="settingthemes")?'tabSelt':'','escape' => false)
						)
					);
					?> 
					</li>
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'Page Footer'),
						array('controller'=>'admins','action'=>'page_footer'),
						array('class'=>($this->subtabsel=="page_footer")?'tabSelt':'','escape' => false)
						)
					);
					?> 
					</li>
					<li>
					<?php
					e($html->link(
						$html->tag('span', 'Border Footer'),
						array('controller'=>'admins','action'=>'project_border_footer'),
						array('class'=>($this->subtabsel=="project_border_footer")?'tabSelt':'','escape' => false)
						)
					);
					?> 
					</li>
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'Networks'),
						array('controller'=>'admins','action'=>'socialnetwork'),
						array('class'=>($this->subtabsel=="socialnetwork")?'tabSelt':'','escape' => false)
						)
					);
					?>
					</li>
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'Facebook'),
						array('controller'=>'admins','action'=>'fbfeeds'),
						array('class'=>($this->subtabsel=="fbfeeds")?'tabSelt':'','escape' => false)
						)
					);
					?>
					</li>    
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'Blogs'),
						array('controller'=>'admins','action'=>'bloglist'),
						array('class'=>($this->subtabsel=="bloglist")?'tabSelt':'','escape' => false)
						)
					);
					?>
					</li>
                    <li>
					<?php
					e($html->link(
						$html->tag('span', 'QR Codes'),
						array('controller'=>'admins','action'=>'qrcodegenerate'),
						array('class'=>($this->subtabsel=="qrcodegenerate")?'tabSelt':'','escape' => false)
						)
					);
					?>
					</li>
					 <li>
					<?php
					e($html->link(
						$html->tag('span', 'Iframe'),
						array('controller'=>'admins','action'=>'iframes'),
						array('class'=>($this->subtabsel=="iframes")?'tabSelt':'','escape' => false)
						)
					);
					?>
					</li>
					
			 <!--	<li>		
					<?php
					e($html->link(
								$html->tag('span', 'Forms Submitted'),
								array('controller'=>'admins','action'=>'formsubmitlist'),
								array('class'=>($this->subtabsel=="formsubmitlist")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li>    
                <li>
					<?php
					e($html->link(
								$html->tag('span', 'Forms List'),
								array('controller'=>'admins','action'=>'formtypelist'),
								array('class'=>($this->subtabsel=="formtypelist")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li>
                <li>
					<?php
					e($html->link(
								$html->tag('span', 'Status Types'),
								array('controller'=>'admins','action'=>'formstatustypelist'),
								array('class'=>($this->subtabsel=="formstatustypelist")?'tabSelt':'','escape' => false)
								)
					);
				?>

				</li>    -->
            </ul>
        </div>
    </div>  
    
       <div class="clear"></div> 
<?php }?>