<div class="midCont" id="cmplisttab">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <!-- top curv image starts -->
        <div>
            <span class="topLft_curv"></span>
            <span class="topRht_curv"></span>
            <div class="gryTop">
            	<div class="new_filter">   
                <script type='text/javascript'>
                    function setprojectid(projectid){
                        document.getElementById('projectid').value= projectid;
                        document.adminhome.submit();
                    }
                </script>
                
				<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                    ?> 
                </span>
				
                </div>
                </div>	
            <div class="clear"></div></div>
        <?php $i=1; ?>			
        <div class="tblData">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg">
                    <th align="center" valign="middle" style='width:1%'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:25%;'><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Non-Profit Name</th>
					<th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('non_profit_type_name',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'NonProfitType',null,' ',' '); ?></span>Non-Profit Type</th>
					<th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('location_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Location</th>
					<th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('location_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>#Members</th>					

                    <th align="center" valign="middle" style='width:13%'><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>City</th>

                    <th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>State</th>
                   
				   <th align="center" valign="middle" style='width:8%'><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
                </tr>
                <?php if($companydata){ 
                        $i=1;
                        foreach($companydata as $eachrow){
						    $recid = $eachrow['Company']['id'];
                            $modelname = "Company";
                            $redirectionurl = "playerslist";
                            $company_type_id = $eachrow['CompanyType']['company_type_name'];
                            $non_profit_type_name = $eachrow['NonProfitType']['non_profit_type_name'];
                            $company_name = $eachrow['Company']['company_name'];
                            $email = $eachrow['Company']['email'];
                            if($email)	$email = AppController::WordLimiter($email,27);
							$location_type = ($eachrow['Company']['location_type_id']=='0')?'HQ':'Branch';						
							$city = $eachrow['Company']['city'];
							$state = AppController::getstatename($eachrow['Company']['state']);
                        ?>

                        <tr <?php echo ($i%2 == 0)? 'class="altrow"':'';?> >
                                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', $company_name),
									array('controller'=>'players','action'=>'adddetail', 'nonprofit', $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							 <td align="left" valign="middle" class='newtblbrd'>
									<?php
									e($html->link(
									$html->tag('span', $non_profit_type_name),
									array('controller'=>'players','action'=>'adddetail', 'nonprofit', $recid),
									array('escape' => false)
									)
								);
							?>
								</td>
								 <td align="left" valign="middle" class='newtblbrd'>
									<?php
									e($html->link(
									$html->tag('span', $location_type),
									array('controller'=>'players','action'=>'adddetail', 'nonprofit', $recid),
									array('escape' => false)
									)
								);
							?>
								</td>
								<td align="left" valign="middle" class='newtblbrd'>
									<?php
									e($html->link(
									$html->tag('span', $company_type_id),
									array('controller'=>'players','action'=>'adddetail', 'nonprofit', $recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                             
                                <td align="left" valign="middle" class='newtblbrd'>

									<?php
									e($html->link(
									$html->tag('span',  $city),
									array('controller'=>'players','action'=>'adddetail', 'nonprofit', $recid),
									array('escape' => false)
									)
								);
								?>
								</td>
								  <td align="left" valign="middle" class='newtblbrd'>
									

									<?php
									e($html->link(
									$html->tag('span', $state),
									array('controller'=>'players','action'=>'adddetail', 'nonprofit', $recid),
									array('escape' => false)
									)
								);
								?>
								</td>
								  <td align="center" valign="middle" class='newtblbrd'>
										<?php 
										if($eachrow['Company']['active_status']=='1'){
											e($html->link(
												$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['Company']['company_name'])),
												array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus','nonprofit'),
												array('escape' => false),
												'Are you sure you want to Deactivate Non-Profit ?',
								                false
												)
											);
										} else {
											e($html->link(
												$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['Company']['company_name'])),
												array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus','nonprofit'),
												array('escape' => false),
												'Are you sure you want to Activate Non-Profit ?',
								                false
												)
											);
										}			
										?>
								</td>
                            </tr>
                            
                        <?php } }else{ ?>
                    <tr><td colspan="9" align="center">No Non-Profit Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <span class="botLft_curv"></span>
            <span class="botRht_curv"></span>
            <div class="gryBot"><?php if($companydata) { echo $this->renderElement('newpagination'); } ?>
            </div>
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->
        <?php echo $form->end();?>
    </div>  