<?php if($this->loginarea){?>                                                                     
    <div class="clear">
	<?php
	e(
		$html->image('spacer.gif',array('width'=>'1','height'=>'12','alt'=>''))
	);
	?>
	</div>
    <div style="height: 30px; clear:both;">
        <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">
                <?php /*if(isset($project['Project']['sponsor_id']) && $project['Project']['sponsor_id'] > 0 ) {*/?>
                    <li>
					<?php
					$clName = '';
					if($this->subtabsel=="editprojectdtl") {
					$clName = 'tabSelt';
					}
					
					e(
						$html->link(
							$html->tag('span','Details'),
							array('controller'=>'admins','action'=>'editprojectdtl'),
							array('class'=>$clName,'escape'=>false)
						)	
					);
					?>
					</li>
                    <li>
					<?php
					$clName = '';
					if($this->subtabsel=="projectsponsor") {
					$clName = 'tabSelt';
					}
					e(
						$html->link(
							$html->tag('span','Owner'),
							array('controller'=>'admins','action'=>'projectsponsor'),
							array('class'=>$clName,'escape'=>false)
						)	
					);
					?>
					</li>
                    <li>
					<?php
					$clName = '';
					if($this->subtabsel=="projectbackup") {
					$clName = 'tabSelt';
					}
					e(
						$html->link(
							$html->tag('span','Backup'),
							array('controller'=>'admins','action'=>'projectbackup'),
							array('class'=>$clName,'escape'=>false)
						)	
					);
					?>
					</li>
                    <li>
					<?php
					$clName = '';
					if($this->subtabsel=="user_agreement_project") {
					$clName = 'tabSelt';
					}
					e(
						$html->link(
							$html->tag('span','User Agreement'),
							array('controller'=>'admins','action'=>'user_agreement_project'),
							array('class'=>$clName,'escape'=>false)
						)	
					);
					?>
					</li>
                    <li>
					<?php
					$clName = '';
					if($this->subtabsel=="coinpricing") {
					$clName = 'tabSelt';
					}
					e(
						$html->link(
							$html->tag('span','Coin Pricing'),
							array('controller'=>'admins','action'=>'coming_soon','coinpricing','project'),
							array('class'=>$clName,'escape'=>false)
						)	
					);
					?>
					</li>
					<li>
					<?php
					$clName = '';
					if($this->subtabsel=="systempricing") {
					$clName = 'tabSelt';
					}
					e(
						$html->link(
							$html->tag('span','System Pricing'),
							array('controller'=>'admins','action'=>'coming_soon','systempricing','project'),
							array('class'=>$clName,'escape'=>false)
						)	
					);
					?>
					</li>
                    
					<?php
					/*
					$clName = '';
					if($this->subtabsel=="spam_policy_project") {
					$clName = 'tabSelt';
					}
					e(
						$html->link(
							$html->tag('span','Spam Policy'),
							array('controller'=>'admins','action'=>'spam_policy_project'),
							array('class'=>$clName,'escape'=>false)
						)	
					);
					*/
					?>
				
               
                    <?php /* }else{*/ ?>
                    
                    <?php  /* } */?>
					
			 <li>	<?php
						$className = $this->subtabsel=="projectcontrols" ? 'tabSelt' : '';	
						e($html->link(
					$html->tag('span', 'Controls'),
					array('controller'=>'admins','action'=>'projectcontrols'),
					array('escape' => false,'class' => $className)
					)
			  );
			?>
		</li>
            </ul>
        </div>
    </div>  
    
       <div class="clear"></div> 
<?php }?>