<?php 	
$base_url_admin = Configure::read('App.base_url_admin');
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
            document.getElementById("linkedit").href=baseUrlAdmin+"viewcategory/"+id; 
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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Offer/1/offerlist/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Offer/0/offerlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Offer/0/offerlist/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    } 
	
	$('#OfferMnu').removeClass("butBg");
		$('#OfferMnu').addClass("butBgSelt");

</script>
<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container">

   <div class="titlCont">
   <div class="myclass">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("offers", array("action" => "Category",'name' => 'Category', 'id' => "Category")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
<?php if($usertype==trim("admin")){ ?>
           <span class="titlTxt1"><?php echo $current_project_name;  ?>:&nbsp;</span>
		  <?php } ?> 
            <span class="titlTxt"> Offer Category  </span>
            
            <div class="topTabs">
                <ul class="dropdown">

                    <li><a href="javascript:void(0)" onclick="editoffer();" id="linkedit"><span>Edit</span></a></li>         
                </ul>
            </div>
           
           
          <?php    $this->loginarea="offers";    $this->subtabsel="category";
             echo $this->renderElement('offers_submenus');  ?>    
        </div>
        </div>


<div class="midCont">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>  
    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <span class="topRht_curv"></span>
        
        <div class="gryTop">
            <?php echo $form->create("offers", array("action" => "category",'name' => 'category', 'id' => "offerlist")) ?>
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
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>offerlist')" id="locaa"></span>

        </div>
        </div>	
        <div class="clear"></div></div>

    <?php $i=1; ?>			

    <div class="tblData">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" width="1%">#</th>
                <th align="center" valign="middle" width="2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
				
				<th align="center" valign="middle" width="6%">
		<span class="right"><?php echo $pagination->sortBy('category_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),Category,null,' ',' '); ?></span>Category</th>
		
				   <th align="center" valign="middle" width="5%"><span class="right"><?php echo $pagination->sortBy('auto_respond_offer_email', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Sub-Category</th>
				   
				   
				   <th align="center" valign="middle" width="8%"><span class="right"><?php echo $pagination->sortBy('offer_title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Offer Name</th>	   
				
				
                <th align="center" valign="middle" style="width:8%"> 
                <span class="right">
                <?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),Company,null,' ',' ');?>
                </span>
                Merchant Name</th>
 
 
                <th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('offer_type_template_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),OfferTypeTemplate,null,' ',' '); ?></span>Offer Type</th>
				
					
				
				
				
				
				<th align="center" valign="middle" width="6%"><span class="right"><?php echo $pagination->sortBy('starttime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Releated Event</th>
				
				
				
				<th align="center" valign="middle" width="4%"><span class="right"><?php echo $pagination->sortBy('endtime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Value</th>
				
				<th align="center" valign="middle" width="4%"><span class="right"><?php echo $pagination->sortBy('endtime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Cost</th>
				
				
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
                        $redirectionurl = "category";           
						$merchant_name = $eachrow['Company']['company_name'];
						$category_name = $eachrow['Category']['category_name'];
						$event_title = $eachrow['Event']['event_title'];
						$cid= $eachrow['Category']['id'];
						$coupon_cost = $eachrow['Offer']['coupon_cost'];
						$coupon_value = $eachrow['Offer']['coupon_value'];
						
						//get subcategory  
						$subCategoryData = $common->getSubCategoryName($cid);
						 $sub_category_name = $subCategoryData['0']['Category']['category_name'];
						
						
						$offer_type_name = $eachrow['OfferTypeTemplate']['offer_type_template_name'];											
                        $offer_name = $eachrow['Offer']['offer_title'];
                        if($offer_name) $offer_name = AppController::WordLimiter($offer_name,25); 
						$start_date = date('m/d/Y',strtotime($eachrow['Offer']['starttime']));
						$end_date = date('m/d/Y',strtotime($eachrow['Offer']['endtime']));						
						?>
                    <tr <?php echo $class;?>>	

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$category_name),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',($sub_category_name)?sub_category_name:'N/A'),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
								array('escape'=>false)
							)
						);
						?>
						</td>      
                        
                        <td align="center" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',($offer_name)?$offer_name:'N/A'),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
								array('escape'=>false)
							)
						);
						?>
						</td>  
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($merchant_name)?$merchant_name:'N/A'),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($offer_type_name)?$offer_type_name:'N/A'),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
								array('escape'=>false)
							)
						);
						?>
						</td>
							</td>
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($event_title)?$event_title:'N/A'),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
								array('escape'=>false)
							)
						);
						?>
						</td>
							</td>
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($coupon_value)?$coupon_value:'N/A'),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
								array('escape'=>false)
							)
						);
						?>
						</td>
							</td>
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($coupon_cost)?$coupon_cost:'N/A'),
								array('controller'=>'offers','action'=>'viewcategory',$cid),
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
                <tr><td colspan="9" align="center">No Offer Category Found.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <span class="botLft_curv"></span>
        <span class="botRht_curv"></span>
        <div class="gryBot"><?php echo $this->renderElement('newpagination');  ?>
        </div>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>

                    </div>

<div class="clear"></div>
