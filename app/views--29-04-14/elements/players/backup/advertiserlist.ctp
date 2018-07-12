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
            document.getElementById("linkedit").href=baseUrl+"players/addplayers/companies/"+id; 
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
                    	window.location=baseUrl+"players/changestatus/"+id+"/Company/0/playerslist/delete/nonprofits";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>
<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container">
         <div class="titlCont">
		  <div class="centerPage" >
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("players", array("action" => "playerslist",'name' => 'playerslist', 'id' => "playerslist")) ?>      
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>
            <span class="titlTxt">Company List</span>
            <div class="topTabs">
                <ul class="dropdown">
                    <li>
					<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'players','action'=>'adddetail','nonprofit'),
								array('escape' => false)
								)
							);
						?>
					</li>
                    <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                        <ul class="sub_menu">
                            <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                            <li class="botCurv"></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                    
                </ul>
            </div>
	         <?php    $this->loginarea="players";    $this->subtabsel="projectcompanies";
                            echo $this->renderElement('players/player_submenus');  ?>   
                            
        </div></div>

 

    <div class="midCont" id="cmplisttab">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <!-- top curv image starts -->
        <div>
            <span class="topLft_curv"></span>
            <div class="gryTop">
               
                <script type='text/javascript'>
                    function setprojectid(projectid){
                        document.getElementById('projectid').value= projectid;
                        document.adminhome.submit();
                    }
                </script>
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                    ?> 
                </span>
                </div>	<span class="topRht_curv"></span>
            <div class="clear"></div></div>
        <?php $i=1; ?>			
        <div class="tblData">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg">
                    <th align="center" valign="middle" style='width:1%'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:25%;'><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Non-Profit Name</th>
					<th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy('category_id',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Non-Profit Type</th>
					<th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy('location_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Location</th>
					<th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy('location_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>#Members</th>					
                    <th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>City</th>
                    <th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>State</th>
                    <th align="center" valign="middle" style='width:14%'><span class="right"><?php echo $pagination->sortBy('active', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
                </tr>
                <?php if($companydata){ 
                        $i=1;
                        foreach($companydata as $eachrow){
						    $recid = $eachrow['Company']['id'];
                            $modelname = "Company";
                            $redirectionurl = "playerslist/nonprofits";
                            $company_type_id = $eachrow['CompanyType']['company_type_name'];
                            $company_name = $eachrow['Company']['company_name'];
                            if($company_name) $company_name = AppController::WordLimiter($company_name,15);
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
												array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
												array('escape' => false),
												'Are you sure you want to Deactivate Merchant ?',
								                false
												)
											);
										} else {
											e($html->link(
												$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['Company']['company_name'])),
												array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
												array('escape' => false),
												'Are you sure you want to Activate Merchant ?',
								                false
												)
											);
										}			
										?>
								</td>
                            </tr>
                            
                        <?php } }else{ ?>
                    <tr><td colspan="9" align="center">No Company Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <span class="botLft_curv"></span>
            <div class="gryBot"><?php if($companydata) { echo $this->renderElement('newpagination'); } ?>
            </div><span class="botRht_curv"></span>
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->
        <?php echo $form->end();?>
    </div>  
    <div class="clear"></div>    
</div>   
