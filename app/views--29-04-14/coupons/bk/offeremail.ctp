<?php 	
$base_url = Configure::read('App.base_url');
$csvUrl = $base_url.'/offers/download_offer_email_list';
?>
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
            //offer.stopPropagation();
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



    function editoffer()
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
            document.getElementById("linkedit").href=baseUrl+"offers/addoffer/"+id+"/email"; 
        }
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
            if(op=="change"){       
                if(act=="active"){
                    window.location=baseUrl+"changestatus/"+id+"/Offer/1/offeremail/cngstatus";
                }else{
                    window.location=baseUrl+"changestatus/"+id+"/Offer/0/offeremail/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrl+"changestatus/"+id+"/Offer/0/offeremail/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    } 
	$('#OfferMnu').removeClass("butBg");
		$('#OfferMnu').addClass("butBgSelt")

</script>
<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container">

   <div class="titlCont">
   <div class="myclass">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("Offer", array("action" => "offeremail",'name' => 'offeremail', 'id' => "offeremail")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>

          <!--<span class="titlTxt1"><?php echo $current_project_name;  ?>:&nbsp;</span>-->
            <span class="titlTxt"> Current Offer Emails  </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                      <li>
						<?php
						e($html->link(
									$html->tag('span', 'New'),
									array('controller'=>'offers','action'=>'addoffer'),
									array('escape' => false)
									)
						);
						?>
					  </li>   
                      <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                                           <!--<li><a href="javascript:void(0)" onclick="invitetooffer();" id="linkinvite">Invite</a></li>  -->
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                                         <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                                         <li class="botCurv"></li>
                                    </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editoffer();" id="linkedit"><span>Edit</span></a></li>         
                </ul>
            </div>
           
           
          <?php    $this->loginarea="offers";    $this->subtabsel="currentofferlist";
             echo $this->renderElement('offer_email_submenus');  ?>    
        </div>
        </div>


<div class="midCont">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>  
    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <span class="topRht_curv"></span>
        
        <div class="gryTop">
            <?php echo $form->create("Offer", array("action" => "offeremail",'name' => 'offeremail', 'id' => "offeremail")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <div class="new_filter">
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                ?> 
            </span>
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url; ?>/offers/offeremail')" id="locaa"></span>
			<span class="srchBg2"><input type="button" value="CSV File Download" label="" onclick="javascript:(window.location='<?php echo $csvUrl ?>')" id="locaa"></span>

        </div>
        </div>	
        <div class="clear"></div></div>

    <?php $i=1; ?>			

    <div class="tblData">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" width="1%">#</th>
                <th align="center" valign="middle" width="2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" width= "6%"> 
                <span class="right">
                <?php echo $pagination->sortBy('offer_title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?>
                </span>
                Offer Name</th>
               
			    <th align="center" valign="middle" width="10%">
		<span class="right"><?php echo $pagination->sortBy('email_template_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'EmailTemplate',null,' ',' '); ?></span>Email Template Name</th>
   <th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Company',null,' ',' '); ?></span>Merchant</th>
 <th align="center" valign="middle" width="6%">
 <span class="right"><?php echo $pagination->sortBy('Subject', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'EmailTemplate',null,' ',' '); ?></span>Subject</th>
                <th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('sender', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'EmailTemplate',null,' ',' '); ?></span>Sender</th>
<th align="center" valign="middle" width="3%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
				
				
				
		 </tr>
            <?php if($offerdata){ 
                    $alt=0;
                    $i=1;
                    foreach($offerdata as $eachrow){
                             if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                       
                        $recid = $eachrow['Offer']['id'];
                        $modelname = "Offer";
                        $redirectionurl = "offeremail";           
						$merchant_name = $eachrow['Company']['company_name'];
						$offer_type_name = $eachrow['OfferTypeTemplate']['offer_type_template_name'];											
                        $offer_name = $eachrow['Offer']['offer_title'];
                        if($offer_name) $offer_name = AppController::WordLimiter($offer_name,25); 
						$email_temp_name = $eachrow['EmailTemplate']['email_template_name'];
						$email_subject = $eachrow['EmailTemplate']['subject'];
						$email_sender  = $eachrow['EmailTemplate']['sender'];
						?>
                    <tr <?php echo $class;?>>	

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
						<td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($offer_name)?$offer_name:'N/A'),
								array('controller'=>'offers','action'=>'addoffer',$recid,'email'),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$email_temp_name),
								array('controller'=>'offers','action'=>'addoffer',$recid,'email'),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$merchant_name),
								array('controller'=>'offers','action'=>'addoffer',$recid,'email'),
								array('escape'=>false)
							)
						);
						?>
						</td>      
                        
                        <td align="center" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',($email_subject)?$email_subject:'N/A'),
								array('controller'=>'offers','action'=>'addoffer',$recid,'email'),
								array('escape'=>false)
							)
						);
						?>
						</td>  
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($email_sender)?$email_sender:'N/A'),
								array('controller'=>'offers','action'=>'addoffer',$recid,'email'),
								array('escape'=>false)
							)
						);
						?>
						</td>
                                 
                        <td align="center" valign="middle">
						
						<?php 
						if($eachrow['Offer']['active_status']=='1'){
							e(
								$html->link(
									$html->image('active.gif',array('title'=>'Click here to deactivate '.$offer_name)),
									array('controller'=>'offers','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}else {

							e(
								$html->link(
									$html->image('deactive.gif',array('title'=>'Click here to activate '.$offer_name)),
									array('controller'=>'offers','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}
						?>
						</td>
                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="9" align="center">No Current Offer Email Found.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <span class="botLft_curv"></span>
        <span class="botRht_curv"></span>
        <div class="gryBot"><?php echo $this->renderElement('newpagination'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>

                    </div>

<div class="clear"></div>
