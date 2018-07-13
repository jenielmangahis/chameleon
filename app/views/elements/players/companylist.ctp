   <div class="midCont" id="cmplisttab">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <!-- top curv image starts -->
        <div>
            <!--<span class="topLft_curv"></span>
            <span class="topRht_curv"></span>-->
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
            <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg">
                    <th align="center" valign="middle" style='width:1%'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:25%;'><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Name</th>
					<th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy('category_id',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Type</th>					
                    <th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>City</th>
                    <th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>State</th>
                    <th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy('phone', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Phone</th>
                    <th align="center" valign="middle" style='width:14%'><span class="right"><?php echo $pagination->sortBy('active', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Website</th>
                </tr>
                <?php if($companydata){ 
                        $i=1;
                        foreach($companydata as $eachrow){
						    $recid = $eachrow['Company']['id'];
                            $modelname = "Company";
                            $redirectionurl = "playerslist/companies";
                            $company_type_id = $eachrow['CompanyType']['company_type_name'];
                            $company_name = $eachrow['Company']['company_name'];
                            if($company_name) $company_name = AppController::WordLimiter($company_name,15);
                            $email = $eachrow['Company']['email'];
                            if($email)	$email = AppController::WordLimiter($email,27);
                            $phone = $eachrow['Company']['phone'];
                            $website = $eachrow['Company']['website'];
                            if($website) $website = AppController::WordLimiter($website,30);
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
									array('controller'=>'players','action'=>'adddetail', 'company', $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									
									e($html->link(
									$html->tag('span', $company_type_id),
									array('controller'=>'players','action'=>'adddetail', 'company', $recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                             
                                <td align="left" valign="middle" class='newtblbrd'>

									<?php
									e($html->link(
									$html->tag('span',  $city),
									array('controller'=>'players','action'=>'adddetail', 'company', $recid),
									array('escape' => false)
									)
								);
								?>
								</td>
								  <td align="left" valign="middle" class='newtblbrd'>
									

									<?php
									e($html->link(
									$html->tag('span', $state),
									array('controller'=>'players','action'=>'adddetail', 'company', $recid),
									array('escape' => false)
									)
								);
								?>
								</td>
								
								  <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',  $phone),
									array('controller'=>'players','action'=>'adddetail', 'company', $recid),
									array('escape' => false)
									)
								);
								?>
								</td>
								 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',  $website),
									array('controller'=>'players','action'=>'adddetail', 'company', $recid),
									array('escape' => false)
									)
								);
								?>
								</td>
                            </tr>
                            
                        <?php } }else{ ?>
                    <tr><td colspan="9" align="center">No Company Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <!--<span class="botLft_curv"></span>
            <span class="botRht_curv"></span>-->
            <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
            </div>
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->
        <?php echo $form->end();?>
    </div>  
   
