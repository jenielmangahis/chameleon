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
									array('controller'=>'players','action'=>'playerslist' ,'advertiser/0'),
								array('escape' => false,'class'=> ($f_name=="playerslist")?'tabSelt':'')
								)
							);
						?>
					</li>
					
					
					
				
					
				
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Notes'),
								array('controller'=>'players','action'=>'notelist','advertiser/0'),
								array('escape' => false,'class'=> ($f_name=="notelist")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>$this->loginarea,'action'=>'historylist','advertiser/0'),
								array('escape' => false,'class'=> ($f_name=="historylist")?'tabSelt':'')
								)
							);
						?>

					</li>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Send Mail'),
								array('controller'=>'admins','action'=>'sendtempmail','0'),
								array('escape' => false,'class'=> ($f_name=="sendtempmail")?'tabSelt':'')
								)
							);
						?>

					</li>
					
					
					
					
				
				   
            </ul>
       
    
       <div class="clear"></div> 
<?php }?>