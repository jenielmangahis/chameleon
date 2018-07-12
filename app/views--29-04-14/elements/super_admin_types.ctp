<ul class="topTabs2" id="tab-container-1-nav" style="padding-left: -40px;">
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Project'),
			array('controller'=>'admins','action'=>'projecttype'),
			array('class'=>(isset($this->projecttype) && $this->projecttype != "")?$this->projecttype:'','escape' => false)
			)
		);
		?>
		</li>
       
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Company'),
			array('controller'=>'admins','action'=>'companytype'),
			array('class'=>(isset($this->companytype) && $this->companytype != "")?$this->companytype:'','escape' => false)
			)
		);
		?>
		</li>
<!--        <li><a class="<?php echo (empty($this->commenttype)) ? '' : $this->commenttype; ?>" href="/admins/commenttype"><span>Comment Types</span></a></li>-->
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Contact'),
			array('controller'=>'admins','action'=>'contacttype'),
			array('class'=>(isset($this->contcattype) && $this->contcattype != "")?$this->contcattype:'','escape' => false)
			)
		);
		?>
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Shipping'),
			array('controller'=>'admins','action'=>'shippingtype'),
			array('class'=>(isset($this->shippingtype) && $this->shippingtype != "")?$this->shippingtype:'','escape' => false)
			)
		);
		?>
		</li>
		
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Non Profit'),
			array('controller'=>'admins','action'=>'nonprofittypelist'),
			array('class'=>(isset($this->nonprofittypelist) && $this->nonprofittypelist != "")?$this->nonprofittypelist:'','escape' => false)
			)
		);	?>
		</li>
		
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Form'),
			array('controller'=>'admins','action'=>'formtypes'),
			array('class'=>(isset($this->formtypes) && $this->formtypes != "")?$this->formtypes:'','escape' => false)
			)
		);
		?>
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Form Status'),
			array('controller'=>'admins','action'=>'sa_formstatustypelist'),
			array('class'=>(isset($this->sa_formstatustypelist) && $this->sa_formstatustypelist != "")?$this->sa_formstatustypelist:'','escape' => false)
			)
		);
		?>
		</li>
		
		
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Categories'),
			array('controller'=>'admins','action'=>'categorylist'),
			array('class'=>(isset($this->categorylist) && $this->categorylist != "")?$this->categorylist:'','escape' => false)
			)
		);
		?>
		</li>
		
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Overrides'),
			array('controller'=>'admins','action'=>'overrideslist'),
			array('class'=>(isset($this->overrideslist) && $this->overrideslist != "")?$this->overrideslist:'','escape' => false)
			)
		);
		?>
		
		<?php
		e($html->link(
			$html->tag('span', 'Donations'),
			array('controller'=>'admins','action'=>'donationlist'),
			array('class'=>(isset($this->donationlist) && $this->donationlist != "")?$this->donationlist:'','escape' => false)
			)
		);
		?>
		</li>
		 <li>
		<?php
		e($html->link(
			$html->tag('span', 'Comments'),
			array('controller'=>'admins','action'=>'commenttype'),
			array('class'=>(isset($this->commenttype) && $this->commenttype != "")?$this->commenttype:'','escape' => false)
			)
		);
		?> 
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Suggested'),
			array('controller'=>'admins','action'=>'sa_suggested_list'),
			array('class'=>(isset($this->sa_suggested_list) && $this->sa_suggested_list != "")?$this->sa_suggested_list:'','escape' => false)
			)
		);
		?> 
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Events'),
			array('controller'=>'admins','action'=>'sa_event_types'),
			array('class'=>(isset($this->sa_event_types) && $this->sa_event_types != "")?$this->sa_event_types:'','escape' => false)
			)
		);
		?> 
		</li>		
</ul>