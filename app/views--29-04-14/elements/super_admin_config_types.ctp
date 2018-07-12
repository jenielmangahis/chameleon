
<ul class="topTabs2" id="tab-container-1-nav" style="padding-left: -40px;">
      
       <li>
		<?php
		e(
			$html->link(
			$html->tag('span','SPAM Footer'),
			array('controller'=>'setups','action'=>'mail_footer'),
			array('escape'=>false,'class'=>(empty($this->mail_footer)) ? '' : $this->mail_footer)
			)
		);	
		?>
		</li> 
		<li>
		<?php
		e(
			$html->link(
			$html->tag('span','Border Footer'), 
			array('controller'=>'setups','action'=>'border_footer_list'),
			array('escape'=>false,'class'=>(empty($this->border_footer_list)) ? '' : $this->border_footer_list)
			)
		);	
		?>
		</li>
		<li>
		<?php
		e(
			$html->link(
			$html->tag('span','Legal'),
			array('controller'=>'legals','action'=>'user_agreement_list_by_project'),
			array('escape'=>false,'class'=>(empty($this->user_agreement_list)) ? '' : $this->user_agreement_list)
			)
		);	
		?>
		</li>
        <li>
		<?php
		e(
			$html->link(
			$html->tag('span','Help List'),
			array('controller'=>'setups','action'=>'help_list'),
			array('escape'=>false,'class'=>(empty($this->help_list)) ? '' : $this->help_list)
			)
		);	
		?>
		</li>
        
        		
        <li>
		<?php
		e(
			$html->link(
			$html->tag('span','Get Started'),
			array('controller'=>'setups','action'=>'getstarted'),
			array('escape'=>false,'class'=>(empty($this->getstarted)) ? '' : $this->getstarted)
			)
		);	
		?>		
		</li>
        
		<li>
		<?php
		e(
			$html->link(
			$html->tag('span','Password'),
			array('controller'=>'setups','action'=>'super_admin_changepassword'),
			array('escape'=>false,'class'=>(empty($this->changePassword)) ? '' : $this->changePassword)
			)
		);	
		?>
		</li>
</ul>