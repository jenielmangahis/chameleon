<?php 	
//$base_url= Configure::read('App.base_url');
//$csvUrl = $base_url.'/offers/download_offer_list';
?>
<script type="text/javascript">
$('#OfferMnu').removeClass("butBg");
		$('#OfferMnu').addClass("butBgSelt");
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
            document.getElementById("linkedit").href=baseUrl+"offers/addoffer/"+id; 
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
                    window.location=baseUrl+"/offers/changestatus/"+id+"/Offer/1/offerlist/cngstatus";
                }else{
                    window.location=baseUrl+"/offers/changestatus/"+id+"/Offer/0/offerlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrl+"/offers/changestatus/"+id+"/Offer/0/offerlist/delete";
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
   <div class="myclass">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("offers", array("action" => "offerpages",'name' => 'offerpages', 'id' => "offerpages")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>

          <?php if($usertype==trim("admin")){ ?>
		   <span class="titlTxt1"><?php echo $current_project_name;  ?>:&nbsp;</span>
		  <?php } ?> 
            <span class="titlTxt"> Offer Pages </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                    <!--  <li>
						<?php
						e($html->link(
									$html->tag('span', 'New'),
									array('controller'=>'offers','action'=>'addoffer'),
									array('escape' => false)
									)
						);
						?>
					  </li>   -->
                      <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                                           <!--<li><a href="javascript:void(0)" onclick="invitetooffer();" id="linkinvite">Invite</a></li>  -->
                                            <li><a href="javascript:void(0)" onClick="return activatecontents('active','change');">Publish</a></li>
                                            <li><a href="javascript:void(0)" onClick="return activatecontents('deactive','change');">Unpublish</a></li>
                                         <li><a href="javascript:void(0)" onClick="return activatecontents('asd','del');">Trash</a></li>
                                         <li class="botCurv"></li>
                                    </ul>
                    </li>
                    <li><a href="javascript:void(0)" onClick="editoffer();" id="linkedit"><span>Edit</span></a></li>         
                </ul>
            </div>
           
           
          <?php    $this->loginarea="offers";    $this->subtabsel="offerpages";
             echo $this->renderElement('offers_pages_submenus');  ?>    
        </div>
        </div>


<div class="midCont">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>  
    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <span class="topRht_curv"></span>
        
        <div class="gryTop">
            <?php echo $form->create("Offer", array("action" => "offerpages",'name' => 'offerpages', 'id' => "offerpages")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <div class="new_filter">
            <span class="spnFilt">Filter:</span>
				<span class="srchBg">
					<?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                ?> 
            </span>
            <span class="srchBg2"><input type="button" value="Reset" label="" onClick="javascript:(window.location='<?php echo $base_url ?>/offers/offerpages')" id="locaa"></span>
			
			<!--<span class="srchBg2"><input type="button" value="CSV File Download" label="" onclick="javascript:(window.location='<?php echo $csvUrl ?>')" id="locaa"></span>-->

        </div>
        </div>	
        <div class="clear"></div></div>

    <?php $i=1; ?>			

    <div class="tblData">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" width="1%">#</th>
                <th align="center" width="2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" width="20%"><span class="right"><?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span><?php echo ($extra=='all')?'Offer':ucfirst($extra); ?> Page Name</th>
                <th width="20%"><a href="#"> </a><span class="right"><?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Offer Name</th>
                <th valign="middle" width="15%"><span class="right"><?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Merchant</th>
                <th valign="middle" width="15%"><span class="right"><?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Controlled By</th> 
                <th valign="middle" width="20%"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),Company,null,' ',' '); ?></span>Related Non Profit</th>
                <th valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
            </tr>
            <?php if($contentdata){ 
                    $alt=0;
                    $i=1;
					
                    foreach($contentdata as $eachrow){
                             if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";
                        $alt++;                       
                        $recid = $eachrow['Offer']['id'];
                        $modelname = "Offer";
                        $redirectionurl = "offerpages";           
						$flag =0;
						$merchant_name = $eachrow['Company']['company_name'];
						$offer_title = $eachrow['Offer']['offer_title'];   
						$controlled_by = $eachrow['Offer']['controlled_by'];	
							if($controlled_by=='0'){
								$controlled_by = "Member";
							}else if($controlled_by=='1'){
								$controlled_by = "Merchant";
							}else if($controlled_by=='2'){
								$controlled_by = "Non Profit";
							}
							//Get Non Profit basis of company id
							$merchantId = $eachrow['Company']['id'];     
							$nonprofitname = $common->getNonProfitName($merchantId);
							
						$testArr = array();
					
$testArr[] = array('0' =>$eachrow['Offer']['merchant_detail_page'],'1'=>$eachrow['Offer']['event_detail_page'],'2'=>$eachrow['Offer']['offer_inquiry_page']);
					//Remove Empty elememnt in array
						$testArr = array_values(array_filter($testArr['0']));
						
						foreach($testArr as $key=>$val){
						$offerpagename = $common->getSofferpagename($val);
						$pageName = $offerpagename['0']['Content']['title'];
						
					?>
					
						
                    <tr <?php echo $class;?>>	

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$pageName),
								array('controller'=>'offers','action'=>'addoffer',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$offer_title),
								array('controller'=>'offers','action'=>'addoffer',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>      
                        
                        <td align="center" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$merchant_name),
								array('controller'=>'offers','action'=>'addoffer',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>  
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($controlled_by)?$controlled_by:'N/A'),
								array('controller'=>'offers','action'=>'addoffer',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($nonprofitname)?$nonprofitname:'N/A'),
								array('controller'=>'offers','action'=>'addoffer',$recid),
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
                    <?php } } }  else{ ?>
                <tr><td colspan="9" align="center">No Offer Pages Found.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <span class="botLft_curv"></span>
        <span class="botRht_curv"></span>
        <div class="gryBot"><?php  echo $this->renderElement('newpagination'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>

                    </div>

<div class="clear"></div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
