<?php if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='prospects'){
		$tab='projectvendorslist';
	} 
?>                                                                     
    <!--<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>-->
    
    <div class="dropdown">
    	<button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    		Select Menu List
   		</button>
        <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
						<?php
						//echo $cid;
						if($cid){
							$action = 'addprospect/'.$params.'/'.$cid;
						}else{
							$action = 'addprospect/'.$params;
						}
							e($html->link(
								$html->tag('span', 'Detail'),
								array('controller'=>$this->loginarea,'action'=>$action),
								array('escape' => false,'class'=> ($this->subtabsel=="projectvendorslist" || $this->subtabsel=="projectmerchantlist")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Notes'),
								array('controller'=>$this->loginarea,'action'=>'notelists' ,$cid,$params),
								array('escape' => false,'class'=> ($this->subtabsel=="notelists")?'tabSelt':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>$this->loginarea,'action'=>'historylist',$cid,$params),
								array('escape' => false,'class'=> ($this->subtabsel=="historylist")?'tabSelt':'')
								)
							);
						?>

					</li>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Email'),
								array('controller'=>$this->loginarea,'action'=>'sendmailcat',$cid,$params),
								array('escape' => false,'class'=> ($this->subtabsel=="sendmailcat")?'tabSelt':'')
								)
							);
						?>
					</li>
					
					
					
					
				
				   
            </ul>
        </div>  
    
       <div class="clear"></div> 
<?php }?>