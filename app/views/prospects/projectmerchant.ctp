<!--container starts here-->
<script type="text/javascript">
$(document).ready(function() {
$('#prosMnu').removeClass("butBg");
$('#prosMnu').addClass("butBgSelt");
}); 
</script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#checkall').bind('change',function(){
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {
                $('.checkid').each(function()
                {
                    $(this).attr('checked',true);

                });


            }else{

                $('.checkid').each(function()
                {
                    $(this).attr('checked',false);

                });
            }		

        })

    });
    $(document).ready(function()
    {   
        $('.checkid').bind('change',function()
        {   
            //event.stopPropagation();
            var i=0;
            var j=0;
            $('.checkid').each(function(){
                i++;
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                    {			
                    j++;
                }


            });

            if(i==j)
                $('#checkall').attr('checked',true);
            else
                $('#checkall').attr('checked',false);
        });
    });
    function editholder()
    {	
        var counter=0;
        var id="";
        $('.checkid').each(function(){		
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {			
                id=$(this).val();
                counter=counter +1;
            }
        });	

        if(counter!=1)
            {
            alert("please select only one row  to edit");
            return false;
        }else{	
            document.getElementById("linkedit").href=baseUrl+"prospects/addmerchant/"+id+"/Marchant"; 

        }
    } 
    function activatecontents(act,op)
    {   
        var id="";
        var count=0;
        $('.checkid').each(function(){       
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {           
                if(id==""){
                    id=$(this).val();

                    ++count;
                }
                else
                    {
                    id=id + "*" + $(this).val();
                    ++count;
                }
            }
        });
        if(id !=""){

            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are you sure to delete the item ?"))
                    window.location=baseUrl+"prospects/changestatus/"+id+"/Company/0/projectmerchant/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>
<?php $pagination->setPaging($paging); ?> 
  <!-- Body Panel starts -->
<div class="container clearfix">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-3">
            	<h2>Prospects</h2>
            </div>
            
            <div class="slider-dashboard col-sm-9">
            	<div class="icon-big-container">
                	<?php echo $form->create("prospects", array("action" => "projectmerchant",'name' => 'projectmerchant', 'id' => "projectmerchant")) ?>      
					<script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>
                    <?php
                    $ids = $this->params['pass'][0]; 
                    e($html->link($html->image('call.png') . ' ' . __(''), array('controller'=>'admins','action'=>'call',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('email.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendtempmail',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('sms.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendsms','1'),array('escape' => false)));
                    
                    
                    e($html->link($html->image('message.png') . ' ' . __(''), array('controller'=>'admins','action'=>'messagenew',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('event.png') . ' ' . __(''), array('controller'=>'admins','action'=>'appointment',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('note.png') . ' ' . __(''), "../players/notelist/2",array('escape' => false)));
                    
                    e($html->link($html->image('take.png') . ' ' . __(''), array('controller'=>'admins','action'=>'coming_soon','task'),array('escape' => false)));
                    e($html->link($html->image('new.png') . ' ',array('controller'=>'prospects','action'=>'addmerchant'),array('escape' => false))); ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
                    <a href="javascript:void(0)" onclick="editholder();" id="linkedit"><?php e($html->image('edit.png')); ?></a>  
                    <?php echo $this->renderElement('new_slider'); ?>                  
                </div>
                
            </div>
            
            <?php /*?><?php if($usertype==trim('admin')){?>
			 <span class="titlTxt1">
				<?php echo $project['Project']['project_name'];  ?>&nbsp;</span>
				<span class="titlTxt">Prospects</span>
			<?php }else{ echo '<span class="titlTxt">Prospects List</span>';} ?><?php */?>
            
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                    <li>
					<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'prospects','action'=>'addmerchant'),
								array('escape' => false)
								)
							);
						?>
					</li>
                    <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                        <ul class="sub_menu">
                            <!--<li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                            <li class="botCurv"></li>-->
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                    
                </ul><?php */?>
            </div>
            
            <!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">			
	
            </div>-->
            
        </div>

</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="prospects";    $this->subtabsel="projectmerchant";

			if($this->params['pass'][0] === '0'){
			echo $this->renderElement('prospect_submenus');
			
			}
			elseif ($_GET['url'] === 'prospects/projectmerchant/1'){
			echo $this->renderElement('prospect_inner_submenu');
			}
			
			else{
			echo $this->renderElement('relationships_submenus'); 
			}
		
		?>   
    </div>
</div> 

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
        <div class="tblData table-responsive">
            <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg">
                    <th align="center" valign="middle" style='width:1%'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Prospect Name</th>
					 <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('company_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Type</th>
					<th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('company_name',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Category</th>					
                    <th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('location_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Location Type</th>
					
                    
                    <th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('phone', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Contact</th>
                    <th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>City</th>
                    <th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>State</th>
                    <th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

                </tr>
                <?php if($companydata){ 
                        $i=1;
                        foreach($companydata as $eachrow){
						
                            $recid = $eachrow['Company']['id'];
                            $modelname = "Company";
                            $redirectionurl = "projectmerchant";
                            $company_type_id = $eachrow['CompanyType']['company_type_name'];
                            $company_name = $eachrow['Company']['company_name'];
                            if($company_name) $company_name = AppController::WordLimiter($company_name,100);
                            $email = $eachrow['Company']['email'];
                            if($email)	$email = AppController::WordLimiter($email,27);
                            $phone = $eachrow['Company']['phone'];
                            $website = $eachrow['Company']['website'];
                            if($website) $website = AppController::WordLimiter($website,30);
							$location_type = ($eachrow['Company']['location_type_id']=='0')?'HQ':'Branch';
							
							$categoryarray = AppController::getMerchantCategories($recid);
							//pr($categoryarray);
							$categories ='';
							foreach($categoryarray as $category){
								if($categories !='')
									$categories .= ', ' ;
								$categories .= $category['Category']['category_name'];
							}
							
							$ein = $eachrow['Company']['ein'];
							$city = $eachrow['Company']['city'];
							$state = AppController::getstatename($eachrow['Company']['state']);
				
                        ?>

                        <?php if($i%2 == 0) { ?>
                            <tr class='altrow'>	

                                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', $company_name?$company_name:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
							?>
							
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>
									
								<?php
									e($html->link(
									$html->tag('span', $categories?$categories:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
								?>
							</td>
							 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									
									e($html->link(
									$html->tag('span', $location_type?$location_type:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
							?>
								</td>
                               <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',  $ein?$ein:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
								?>

								</td>
                                <td align="left" valign="middle" class='newtblbrd'>

									<?php
									e($html->link(
									$html->tag('span',  $city?$city:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
								?>
								</td>
								  <td align="left" valign="middle" class='newtblbrd'>
									

									<?php
									e($html->link(
									$html->tag('span', $state?$state:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
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
				array('controller'=>'prospects','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Deactivate Merchant ?',
                false
				)
			);
		} else {
			e($html->link(
				$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['Company']['company_name'])),
				array('controller'=>'prospects','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Activate Merchant ?',
                false
				)
			);
		}			
		?>
		</td>
                            </tr>
                            <?php } else { ?>

                            <tr>	

                                <td align="center"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="left" valign="middle">								
							<?php
									e($html->link(
									$html->tag('span', $company_name?$company_name:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
							?>
									
								</td>
								<td><?php echo $company_type_id ; ?> </td>
                                <td align="left" valign="middle">
									<?php
										e($html->link(
										$html->tag('span', $categories?$categories:'N/A'),
										array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
										array('escape' => false)
										)
									);
								?>


								</td>
                                <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span', $location_type?$location_type:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
								?>
								</td>
                                <td align="left" valign="middle">
									
									<?php
									e($html->link(
									$html->tag('span', $ein? $ein:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
								?>		
								</td>
                                <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span',  $city?$city:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
									array('escape' => false)
									)
								);
								?>
								</td>
								 <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span', $state?$state:'N/A'),
									array('controller'=>'prospects','action'=>'addmerchant',$recid,'Marchant'),
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
				array('controller'=>'prospects','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Deactivate Merchant ?',
                false
				)
			);
		} else {
			e($html->link(
				$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['Company']['company_name'])),
				array('controller'=>'prospects','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Activate Merchant ?',
                false
				)
			);
		}			
		?>
		</td>

                            </tr>


                            <?php } ?>	
                        <?php } }else{ ?>
                    <tr><td colspan="9" align="center">No Merchant Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <!--<span class="botLft_curv"></span>
			<span class="botRht_curv"></span>-->
            <div class="gryBot"><?php if($companydata) { echo $this->renderElement('newpagination'); } ?>
            </div>
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->

        <?php echo $form->end();?>

    </div>  

    <div class="clear"></div>    
</div>   
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {		
        document.getElementById("cmplisttab").className = "newmidCont";
    }	
</script>