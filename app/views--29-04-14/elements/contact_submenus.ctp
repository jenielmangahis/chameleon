<?php if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='contacts'){
		$tab='projectcompanylist';
	}
?>                                                                     
    <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
    <div style="height: 30px; clear:both;">
        <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">
                
                    <li>
						
						<?php
							e($html->link(
								$html->tag('span', 'Companies'),
								array('controller'=>$this->loginarea,'action'=>$tab),
								array('escape' => false,'class'=> ($this->subtabsel=="projectcompanylist" || $this->subtabsel=="companylist")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Contacts'),
								array('controller'=>$this->loginarea,'action'=>'contactlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="contactlist")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Company Type'),
								array('controller'=>$this->loginarea,'action'=>'projectcompanytypes'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectcompanytypes")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Contact Type'),
								array('controller'=>$this->loginarea,'action'=>'projectcontacttypes'),
								array('escape' => false,'class'=> ($this->subtabsel=="projectcontacttypes")?'tabSelt':'')
								)
							);
						?>

					</li>
                   
            </ul>
        </div>
    </div>  
    
       <div class="clear"></div> 
<?php }?>