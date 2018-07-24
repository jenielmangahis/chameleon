<?php if($this->loginarea){?>                                                                     
    
   <div id="tab-container-1" class="dropdown-button-container">

	<div class="dropdown">
    
    <button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	Select Menu List
    </button>  
            <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">

	           	
                    <li>
						<?php
							if($_GET['url']==='admins/donation' ||($this->params['controller']==='admins' && $this->params['action']==='edit_donation')|| ($this->params['controller']==='admins' && $this->params['action']==='adddonations'))
							{
							e($html->link(
								$html->tag('span', 'Donations'),
								array('controller'=>'admins','action'=>'donation'),
								array('escape' => false,'class'=> 'tabSelt')
								)
							);
							}
							else{
								e($html->link(
								$html->tag('span', 'Donations'),
								array('controller'=>'admins','action'=>'donation'),
								array('escape' => false,'class'=>'')
								)
							);
							}
						?>
					</li> 
					  <li>
						
						<?php
						
						if($this->params['controller']==='admins' && ($this->params['action']==='donationupload'|| $this->params['action']==='adddonationsuploade' || $this->params['action']==='edit_donationuploade'))
						{
							e($html->link(
								$html->tag('span', 'Uploads'),
								array('controller'=>'admins','action'=>'donationupload'),
								array('escape' => false,'class'=>'tabSelt')
								)
							);
						}
						else{
						e($html->link(
								$html->tag('span', 'Uploads'),
								array('controller'=>'admins','action'=>'donationupload'),
								array('escape' => false,'class'=>'')
								)
							);
							}
						?>
					</li>
					<li>
						
						<?php
						if($_GET['url']==='admins/by_event')
						{
							e($html->link(
								$html->tag('span', 'By Event'),
								array('controller'=>'admins','action'=>'by_event'),
								array('escape' => false,'class'=> 'tabSelt')
								)
							);
							}
							else
							{
							e($html->link(
								$html->tag('span', 'By Event'),
								array('controller'=>'admins','action'=>'by_event'),
								array('escape' => false,'class'=>'')
								)
							);
							}
						?>

					</li> 
					
                   <?php /*?> <li>
						<?php
							e($html->link(
								$html->tag('span', 'Coins'),
								array('controller'=>'admins','action'=>'registercoinlist'),
								array('escape' => false,'class'=> ($this->subtabsel=="registercoinlist")?'tabSelt':'')
								)
							);
						?>

					</li>
                   <li>
						<!--<a href="/<?php echo $this->loginarea;?>/topdonatorslist" <?php if($this->subtabsel=="topdonatorslist") {?> class="tabSelt" <?php } ?> ><span>Top Donators</span></a>-->
						
						<?php
							e($html->link(
								$html->tag('span', 'Top Donators'),
								array('controller'=>$this->loginarea,'action'=>'topdonatorslist'),
								array('escape' => false,'class'=> ($this->subtabsel=="topdonatorslist")?'tabSelt':'')
								)
							);
						?>

					</li> <?php */?>
					
                    <li>
						
						<?php
						if($_GET['url']==='admins/typelist'){
							e($html->link(
								$html->tag('span', 'Donation Types'),
								array('controller'=>'admins','action'=>'typelist'),
								array('escape' => false,'class'=>'tabSelt')
								)
							);
							}
							else{
							e($html->link(
								$html->tag('span', 'Donation Types'),
								array('controller'=>'admins','action'=>'typelist'),
								array('escape' => false,'class'=>'')
								)
							);
							}
						?>

					</li>
					  
             <?php /*?> 
					
                   
<?php */?>
            </ul>
        </div>
    </div>  
    
       <div class="clear"></div> 
<?php }?>