<div class="clear"></div>
            <ul id="tab-container-1-nav" class="topTabs2">
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
							$html->tag('span', 'Active Tasks'),
							array('controller'=>'mailtasks','action'=>'activetasklist','0'),
							array('class'=> ($this->subtabsel=="activetasklist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php

?>			    
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Task History'),
							array('controller'=>'mailtasks','action'=>'taskhistorylist'),
							array('class'=> ($this->subtabsel=="taskhistorylist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php

?>			
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Templates'),
							array('controller'=>'mailtasks','action'=>'mailtemplatelist'),
							array('class'=> ($this->subtabsel=="mailtemplatelist")?'tabSelt':'','escape' => false)
							)
						);
					?>

			</li>
<?php
	
?>			
			<li>		
				<?php
						e($html->link(
							$html->tag('span', 'Responders'),
							array('controller'=>'mailtasks','action'=>'mailresponderlist'),
							array('class'=> ($this->subtabsel=="mailresponderlist")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li>
<?php

?>			
            <li>
				<?php
						e($html->link(
							$html->tag('span', 'Mail Defaults'),
							array('controller'=>'mailtasks','action'=>'maildefaults'),
							array('class'=> ($this->subtabsel=="maildefaults")?'tabSelt':'','escape' => false)
							)
						);
				?>
			</li> 
<?php
	
?>			  
            <li>
					<?php
						e($html->link(
							$html->tag('span', 'Mail Footer'),
							array('controller'=>'mailtasks','action'=>'mail_footer'),
							array('class'=> ($this->subtabsel=="mail_footer")?'tabSelt':'','escape' => false)
							)
						);
					?>

				</li>  
<?php

?>				        
				<li>
					<?php
						e($html->link(
							$html->tag('span','Opt-Out History'),
							array('controller'=>'mailtasks','action'=>'opt_out_history'),
							array('class'=> ($this->subtabsel=="opt_out_history")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li>
<?php 
?>				        
				<li>
				
					<?php
						e($html->link(
							$html->tag('span','Send Mail'),
							array('controller'=>'admins','action'=>'sendtempmail','sendemail'),
							array('class'=> ($this->subtabsel=="sendtempmail")?'tabSelt':'','escape' => false)
							)
						);
					?>
				
				</li>
<?php 
?>				        
				<li>
					<?php
						e($html->link(
							$html->tag('span','Spam Policy'),
							array('controller'=>'admins','action'=>'spam_policy_project'),
							array('class'=> ($this->subtabsel=="spam_policy_project")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li>
<?php 

 ?>		

	        
				<li>
					<?php
						e($html->link(
							$html->tag('span','Page Footer'),
							array('controller'=>'admins','action'=>'page_footer','0'),
							array('class'=> ($this->subtabsel=="page_footer")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
				<li>
					<?php
						e($html->link(
							$html->tag('span','Upload'),
							array('controller'=>'#','action'=>'#'),
							array('class'=> ($this->subtabsel=="#")?'tabSelt':'','escape' => false)
							)
						);
					?>
				</li> 
            </ul>