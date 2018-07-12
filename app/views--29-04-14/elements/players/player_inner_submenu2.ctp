<?php 
if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='players'){
		$tab='adddetail/'.$option;
		//$tab='adddetail/'.$option.$cmpid;
	} 
?>                                                                     

            <ul id="tab-container-1-nav" class="topTabs2">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Detail'),
								array('controller'=>$this->loginarea,'action'=>$tab,  $current_company),
								array('escape' => false,'class'=> ($this->subtabsel=="details")?'tabSelt':'')
								)
							);
						?>
					</li>
                      <li>
						<?php
							e($html->link(
								$html->tag('span', 'Notes'),
								array('controller'=>$this->loginarea,'action'=>'notelist', $option),
								array('escape' => false,'class'=> ($this->subtabsel=="notes")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>$this->loginarea,'action'=>'historylist', $option),
								array('escape' => false,'class'=> ($this->subtabsel=="histories")?'tabSelt':'')
								)
							);
						?>

					</li>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Send Mail'),
								array('controller'=>$this->loginarea,'action'=>'sendmail', $option),
								array('escape' => false,'class'=> ($this->subtabsel=="sendmail")?'tabSelt':'')
								)
							);
						?>

					</li>
            </ul>
              <div class="clear"></div> 
<?php }?>