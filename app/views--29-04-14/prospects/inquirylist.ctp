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
		var enqtype = $('#enqtype').val();
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
            document.getElementById("linkedit").href=baseUrl+"prospects/inquirydetail/"+id+"/"+enqtype; 

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
          <?php echo $form->create("prospects", array("action" => "inquirylist",'name' => 'inquirylist', 'id' => "inquirylist")) ;
		  			echo $form->hidden("enqtype", array('id' => 'enqtype','value'=>$enqtype));
		       ?> 	  
			    <!-- <span class="titlTxt1"><?php //echo $project['Project']['project_name'];  ?></span>-->
			<?php if($enqtype ==trim('new')){
						$titleshow = "Inquries submitted ";
					}else {
						$titleshow = "Inquries";
					} ?>
            <span class="titlTxt"><?php echo $titleshow.': '. ucfirst($enqtype) ?></span>
			
            
            <div class="topTabs">
                <ul class="dropdown">
                    <!--<li>
					<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'prospects','action'=>'addprospect'),
								array('escape' => false)
								)
							);
						?>
					</li>-->
                    <!--<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                        <ul class="sub_menu">
                            <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                            <li class="botCurv"></li>
                        </ul>
                    </li>-->
                    <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                    
                </ul>
            </div>
	        <?php
			 		if($enqtype ==trim('new')){
						$subtabsel = "newinquiry";
					}else if($enqtype ==trim('open')){
						$subtabsel = "openinquiry";
					}else{
						$subtabsel = "historylist";
					}
					$this->loginarea="prospects";    $this->subtabsel=$subtabsel;
                    echo $this->renderElement('prospect_submenus');  
			?>                               
        </div></div>

 

    <div class="midCont" id="cmplisttab">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <!-- top curv image starts -->
        <div>
            <span class="topLft_curv"></span>
			<span class="topRht_curv"></span>
            <div class="gryTop">
			<div class="new_filter">
               
                <!--<script type='text/javascript'>
                    function setprojectid(projectid){
                        document.getElementById('projectid').value= projectid;
                        document.adminhome.submit();
                    }
                </script>-->
				
                <span class="spnFilt">Filter:</span><span class="srchBg">
					<?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2">
		<?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

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
               <?php  if($enqtype=='new'){ $dateField = "Date"; $sortby = "created";}else{$dateField = "Submited"; $sortby = "modified";} ?>
			   <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy($sortby, $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span><?php echo $dateField; ?></th>
<th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('releation_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Relationship</th>										
                    
<th align="center" valign="middle" style='width:20%'><span class="right"><?php echo $pagination->sortBy('fld_company', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Name</th>
		<th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('fld_firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>First Name</th>
	
	<th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('fld_lastname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Last Name</th>
	<?php  if($enqtype=='new'){?>
	<th align="center" valign="middle" style='width:10%'><span class="right"><?php echo $pagination->sortBy('fld_city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>City</th>
                   
                    <th align="center" valign="middle" style='width:12%'><span class="right"><?php echo $pagination->sortBy(' 	fld_stprovince', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>State</th>
<?php }else{?>
		<th align="center" valign="middle" style='width:25%'><span class="right"><?php echo $pagination->sortBy('fld_notes', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Notes</th>
<?php } ?>                    
                </tr>
                <?php if($newinquirydata){ 
                        $i=1;
                        foreach($newinquirydata as $eachrow){
						   
						    $recid = $eachrow['FormSubmit']['id'];
                            $modelname = "FormSubmit";
							if($eachrow['FormSubmit']['statustype_id']=='0'){
								$date = date("m-d-Y", strtotime($eachrow['FormSubmit']['created']));
							}else{
								$date = date("m-d-Y", strtotime($eachrow['FormSubmit']['modified']));
							}
							$releation_type = $eachrow['FormSubmit']['releation_type'];
							if($releation_type > 0){
								$relationtype =  $common->getrelationshiptype($releation_type,'list');	
							}
							$company_name =   $eachrow['FormSubmit']['fld_company'];  
							$first_name	  =   $eachrow['FormSubmit']['fld_firstname'];  
							$last_name    =   $eachrow['FormSubmit']['fld_lastname'];  
							$city_name    =   $eachrow['FormSubmit']['fld_city'];            
							$notes 		  =   $eachrow['FormSubmit']['fld_notes'];   
							$state	  =   AppController::getstatename($eachrow['FormSubmit']['fld_stprovince']); 
						
                        ?>

                        <?php if($i%2 == 0) { ?>
                            <tr class='altrow'>	

                                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', $date),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									
									e($html->link(
									$html->tag('span', $relationtype),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
							?>
								</td>
                               <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',  $company_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>

								</td>
                                <td align="left" valign="middle" class='newtblbrd'>

									<?php
									e($html->link(
									$html->tag('span',  $first_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								</td>
								  <td align="left" valign="middle" class='newtblbrd'>
									

									<?php
									e($html->link(
									$html->tag('span', $last_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								</td>
								<?php if($enqtype==trim("new")){?>
								 <td align="left" valign="middle" class='newtblbrd'>
									

									<?php								
									e($html->link(
									$html->tag('span', $city_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								</td>
								 <td align="left" valign="middle" class='newtblbrd'>
									

									<?php
									e($html->link(
									$html->tag('span', $state),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								</td>
								<?php }else{ ?> 
								 <td align="left" valign="middle" class='newtblbrd'>
									

									<?php								
									e($html->link(
									$html->tag('span', $notes),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								</td>
								<?php } ?>
                            </tr>
                            <?php } else { ?>

                            <tr>	

                                <td align="center"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="left" valign="middle">								
							<?php
									e($html->link(
									$html->tag('span', $date),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
							?>
									
								</td>
                                <td align="left" valign="middle">
									<?php
										e($html->link(
										$html->tag('span', $relationtype),
										array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
										array('escape' => false)
										)
									);
								?>


								</td>
                                
                                <td align="left" valign="middle">
									
									<?php
									e($html->link(
									$html->tag('span', $company_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>		
								</td>
                                <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span',  $first_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								</td>
								 <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span', $last_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								<?php if($enqtype ==trim("new")){ ?>
								</td>
								 <td align="left" valign="middle">
									

									<?php
									e($html->link(
									$html->tag('span', $city_name),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
								</td>
								 <td align="left" valign="middle">
									

									<?php
									e($html->link(
									$html->tag('span', $state),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
							</td>
							<?php } else{ ?>
								 <td align="left" valign="middle">
									

									<?php
									e($html->link(
									$html->tag('span', $notes),
									array('controller'=>'prospects','action'=>'inquirydetail',$recid,$enqtype),
									array('escape' => false)
									)
								);
								?>
							</td>
							
                            </tr>
<?php } ?>

                            <?php } ?>	
                        <?php } }else{ ?>
                    <tr><td colspan="9" align="center">No Inquiries with "<?php echo ucfirst($enqtype);?>" Status Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <span class="botLft_curv"></span><span class="botRht_curv"></span>
            <div class="gryBot"><?php if($newinquirydata) { echo $this->renderElement('newpagination'); } ?>
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