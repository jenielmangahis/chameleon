<?php 
//$cmpid = $this->Session->Read("current_company");
//$cmpid = ($this->data['Company']['id'])?'/'.$this->data['Company']['id']:'';
if($this->loginarea){
		if($this->loginarea=='companies'){
		$tab='companylist';
	}else if($this->loginarea=='players'){
		$tab='adddetail/'.$option;
		//$tab='adddetail/'.$option.$cmpid;
	} 
?>       

<div id="tab-container-1" class="dropdown-button-container">
    <div class="dropdown">
        
        <button class="btn btn-secondary btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select Sub-Menu List
        </button>                                                              
   
            			<!--<ul id="tab-container-1-nav" class="topTabs2"> OLD-->
            <ul id="tab-container-1-nav" class="nav nav-pills dropdown-menu" aria-labelledby="dropdownMenuButton">
					

					
					  <li>
						<?php
							e($html->link(
								$html->tag('span', 'Detail'),
									array('controller'=>'players','action'=>'playerslist' ,'advertiser/0'),
								array('escape' => false,'class'=> ($f_name=="playerslist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
					
					
					
				
					
				
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'Notes'),
								array('controller'=>'players','action'=>'notelist','advertiser/0'),
								array('escape' => false,'class'=> ($f_name=="notelist")?'tabSelt dropdown-item':'')
								)
							);
						?>
					</li>
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'History'),
								array('controller'=>$this->loginarea,'action'=>'historylist','advertiser/0'),
								array('escape' => false,'class'=> ($f_name=="historylist")?'tabSelt dropdown-item':'')
								)
							);
						?>

					</li>
					<li>
						<?php
							e($html->link(
								$html->tag('span', 'Send Mail'),
								array('controller'=>'admins','action'=>'sendtempmail','0'),
								array('escape' => false,'class'=> ($f_name=="sendtempmail")?'tabSelt dropdown-item':'')
								)
							);
						?>

					</li>
					
					
					
					
				
				   
            </ul>
       
    
       <div class="clear"></div> 
       
	</div>
</div>       
<?php }?>

<script type="text/javascript">
	$('#dropdownMenuButton').on('show.bs.dropdown', function () {
	  $('.dropdown-toggle').dropdown();
	});
</script>