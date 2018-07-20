<?php if($this->loginarea){?>                                                                     
    <div class="clear"></div>
    	<div class="dropdown">
    	<button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    		Select Menu List
   		</button>
            <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
                <!--<li>
					
					<?php
					e($html->link(
								$html->tag('span', 'Submitted'),
								array('controller'=>'admins','action'=>'formsubmitlist'),
								array('class'=>($this->subtabsel=="formsubmitlist")?'tabSelt':'','escape' => false)
								)
					);
				?>
				</li>-->
				<?php
				if(!isset($hideSubMenuPermission))		
				{
					$hideSubMenuPermission = "";
				}
				if(!isset($c_name))		
				{
					$c_name = "";
				}
				if(!isset($f_name))		
				{
					$f_name = "";
				}

				?>  				
				 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Inquiries-New'),
								array('controller'=>$this->loginarea,'action'=>'inquirylist','new'),
								array('escape' => false,'class'=> ($this->subtabsel=="newinquiry")?'tabSelt':'')
								)
							);
						?>

					</li>
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Inquiries-Open'),
								array('controller'=>$this->loginarea,'action'=>'inquirylist','open'),
								array('escape' => false,'class'=> ($this->subtabsel=="openinquiry")?'tabSelt':'')
								)
							);
						?>

					</li>
<?php
/*
?>  					
					 <li>
						<?php
							e($html->link(
								$html->tag('span', 'Inquiries-History'),
								array('controller'=>$this->loginarea,'action'=>'inquirylist','history'),
								array('escape' => false,'class'=> ($this->subtabsel=="historylist")?'tabSelt':'')
								)
							);
						?>

					</li>    

<?php
	*/
?>                
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
				</li> 
            </ul>
        </div>
    <div class="clear"></div> 
    <Br />
    <?php }?>