 <ul class="topTabs2" id="tab-container-1-nav" style=" margin-top: 0px;padding-left: -40px;">
            <li>
			<?php
			e(
				$html->link(
					$html->tag('span','Project List'),
					array('controller'=>'admins','action'=>'projectlist'),
					array('class'=>(isset($this->proectlist) && $this->proectlist != "")?$this->proectlist:'','escape'=>false)
				)	
			);
			?>
			</li>
            <li>
			<?php
			e(
				$html->link(
					$html->tag('span','By Product'),
					array('controller'=>'admins','action'=>'projectlist_by_product'),
					array('class'=>(isset($this->projectlistbyproduct) && $this->projectlistbyproduct != "")?$this->projectlistbyproduct:'','escape'=>false)
				)	
			);
			?>
			</li>
            <!--<li>
			<?php
			e(
				$html->link(
					$html->tag('span','By System Price'),
					array('controller'=>'admins','action'=>'projectlist_by_sys_price'),
					array('class'=>(isset($this->projecttypebyprice) && $this->projecttypebyprice != "")?$this->projecttypebyprice:'','escape'=>false)
				)	
			);
			?>
			</li>-->
			<li>
		<?php
		e(
			$html->link(
				$html->tag('span','Billing/Status'),
				array('controller'=>'admins','action'=>'billing_status_list'),
				array('escape'=>false,'class'=>(empty($this->billing_status_list)) ? '' : $this->billing_status_list)
			)
		);
		?>
		</li>
		<li>
		<?php
		e(
			$html->link(
			$html->tag('span','Products'),
			array('controller'=>'setups','action'=>'producttype'),
			array('escape'=>false,'class'=>(empty($this->producttype)) ? '' : $this->producttype)
			)
		);	
		?>
		</li>		
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
		</li>  -->
		<li>
		<?php
		e(
			$html->link(
			$html->tag('span','Versions'),
			array('controller'=>'versions','action'=>'system_version_list'),
			array('escape'=>false,'class'=>(empty($this->system_version_list)) ? '' : $this->system_version_list)
			)
		);	
		?>
		</li>
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
		 <li>
		<?php
		e($html->link(
			$html->tag('span', 'Coin Prices'),
			array('controller'=>'admins','action'=>'pricingtype'),
			array('class'=>(isset($this->pricingtype) && $this->pricingtype != "")?$this->pricingtype:'','escape' => false)
			)
		);
		?> 
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'System Pricing'),
			array('controller'=>'admins','action'=>'system_pricing_list'),
			array('class'=>(isset($this->system_pricing_list) && $this->system_pricing_list != "")?$this->system_pricing_list:'','escape' => false)
			)
		);
		?> 
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Billing'),
			array('controller'=>'admins','action'=>'billingtype_list'),
			array('class'=>(isset($this->billingtype_list) && $this->billingtype_list != "")?$this->billingtype_list:'','escape' => false)
			)
		);
		?> 
		</li>
		<li>
		<?php
		e(
			$html->link(
				$html->tag('span','Status Types'),
				array('controller'=>'admins','action'=>'status_type_list'),
				array('escape'=>false,'class'=>(empty($this->status_type_list)) ? '' : $this->status_type_list)
			)
		);
		?>
		</li> 
    </ul>