
<ul class="topTabs2" id="tab-container-1-nav" style="padding-left: -40px;">
   
		<li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Templates'),
			array('controller'=>'mailtasks','action'=>'supermailtemplatelist'),
			array('escape'=>false,'class'=>(empty($this->mailtempaltes)) ? '' : $this->mailtempaltes)
			)
		);	
		?>
		</li>
		<li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Tasks'),
			array('controller'=>'mailtasks','action'=>'mailtask_list'),
			array('escape'=>false,'class'=>(empty($this->mail_tasks)) ? '' : $this->mail_tasks)
			)
		);	
		?>
		</li>    	
		<li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Member Responders'),
			array('controller'=>'mailtasks','action'=>'responderslist', 'member'),
			array('escape'=>false,'class'=>(empty($this->responders_member)) ? '' : $this->responders_member)
			)
		);	
		?>
		</li>    
		<li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Event Responders'),
			array('controller'=>'mailtasks','action'=>'responderslist', 'event'),
			array('escape'=>false,'class'=>(empty($this->responders_event)) ? '' : $this->responders_event)
			)
		);	
		?>
		</li>
		<li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Player Responders'),
			array('controller'=>'mailtasks','action'=>'responderslist', 'player'),
			array('escape'=>false,'class'=>(empty($this->responders_player)) ? '' : $this->responders_player)
			)
		);	
		?>
		</li>
		<li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Prospects Responders'),
			array('controller'=>'mailtasks','action'=>'responderslist', 'prospect'),
			array('escape'=>false,'class'=>(empty($this->responders_prospect)) ? '' : $this->responders_prospect)
			)
		);	
		?>
		</li>  
		    
		<!-- <li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Non-Profit Responders'),
			array('controller'=>'mailtasks','action'=>'responderslist', 'nonprofit'),
			array('escape'=>false,'class'=>(empty($this->responders_nonprofit)) ? '' : $this->responders_nonprofit)
			)
		);	
		?>
		</li>  -->    
		<li>   
		<?php
		e(
			$html->link(
			$html->tag('span','Offer Responders'),
			array('controller'=>'mailtasks','action'=>'responderslist', 'offer'),
			array('escape'=>false,'class'=>(empty($this->responders_offer)) ? '' : $this->responders_offer)
			)
		);	
		?>
		</li>     			
</ul>