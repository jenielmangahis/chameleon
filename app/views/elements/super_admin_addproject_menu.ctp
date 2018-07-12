<ul class="topTabs2" id="tab-container-1-nav" style="padding-left: -40px;">
       <!-- <li>
		<?php
		e(
			$html->link(
				$html->tag('span','Project List'),
				array('controller'=>'admins','action'=>'projectlist'),
				array('escape'=>false,'class'=>(empty($this->projectlist)) ? '' : $this->projectlist)
			)
		);
		?>
		</li>-->
		<!--<li>
		<?php
		e(
			$html->link(
				$html->tag('span','Billing/Status'),
				array('controller'=>'admins','action'=>'billing_status_list'),
				array('escape'=>false,'class'=>(empty($this->billing_status_list)) ? '' : $this->billing_status_list)
			)
		);
		?>
		</li>-->
		<li>
		<!--<?php
		e(
			$html->link(
				$html->tag('span','Products'),
				array('controller'=>'setups','action'=>'producttype'),
				array('escape'=>false)
			)
		);
		?>
		</li>-->
       <!-- <li>
		<?php
		e(
			$html->link(
				$html->tag('span','System Price'),
				'#',
				array('escape'=>false)
			)
		);
		?>
		</li> --> 
        <!--<li>
		<?php
		e(
			$html->link(
				$html->tag('span','Email Uploads'),
				array('controller'=>'admins','action'=>'email_uploads_list'),
				array('escape'=>false,'class'=>(empty($this->email_uploads_list)) ? '' : $this->email_uploads_list)
			)
		);
		?>
		</li>-->
		<!--<li>
		<?php
		e(
			$html->link(
				$html->tag('span','Status Types'),
				array('controller'=>'admins','action'=>'status_type_list'),
				array('escape'=>false,'class'=>(empty($this->status_type_list)) ? '' : $this->status_type_list)
			)
		);
		?>
		</li> -->
</ul>