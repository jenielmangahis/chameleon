<?php 
//$cmpid = $this->Session->Read("current_company");
//$cmpid = ($this->data['Company']['id'])?'/'.$this->data['Company']['id']:'';
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
								array('controller'=>$this->loginarea,'action'=>$tab),
								//array('controller'=>$this->loginarea,'action'=>$tab,  $current_company),
								array('escape' => false,'class'=> ($this->subtabsel=="details")?'tabSelt':'')
								)
							);
						?>
					</li>
					
					<?php 
					if($option !='company' ) { ?>
					 <li id="branchli">
						<?php
							e($html->link(
								$html->tag('span', 'Branches'),
								array('controller'=>$this->loginarea,'action'=>'branchlist', $option),
								//array('controller'=>$this->loginarea,'action'=>'branchlist', $option, $current_company),
								array('escape' => false,'class'=> ($this->subtabsel=="branches")?'tabSelt':'')
								)
							);
						?>
					</li>
					<?php } ?>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Graphics'),
								array('controller'=>$this->loginarea,'action'=>'addgraphic', $option),
								//array('controller'=>$this->loginarea,'action'=>'addgraphic', $option, $current_company),
								array('escape' => false,'class'=> ($this->subtabsel=="graphics")?'tabSelt':'')
								)
							);
						?>
					</li>
					<li>
						<?php 
							e($html->link(
								$html->tag('span', 'Webpage'),
								array('controller'=>$this->loginarea,'action'=>'addwebpage', $option),
								//array('controller'=>$this->loginarea,'action'=>'addwebpage', $option, $current_company),
								array('escape' => false,'class'=> ($this->subtabsel=="webpages")?'tabSelt':'')
								)
							);
						?>
					</li>
					<?php if($option !='company') { ?>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Offers'),
								array('controller'=>$this->loginarea,'action'=>'offerlist', $option),
								//array('controller'=>$this->loginarea,'action'=>'offerlist', $option,$current_company),
								array('escape' => false,'class'=> ($this->subtabsel=="offers")?'tabSelt':'')
								)
							);
						?>
					</li>
				   <?php } ?>
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
								array('controller'=>'admins','action'=>'sendtempmail', $option),
								array('escape' => false,'class'=> ($this->subtabsel=="sendmail")?'tabSelt':'')
								)
							);
						?>

					</li>
					
					
					
					
				
				   
            </ul>
       
    
       <div class="clear"></div> 
<?php }?>