<?php  	
$base_url= Configure::read('App.base_url');
$csvUrl = $base_url.'/coupons/download_coupon_list/past';
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
            document.getElementById("linkedit").href=baseUrl+"coupons/addcoupon/"+id; 
        }
    } 

    function invitetooffer()
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
        if(counter!=1){
            alert("please select only one offer  to invite");
            return false;
        }else{    
            document.getElementById("linkinvite").href=baseUrlAdmin+"couponinvitation/"+id; 
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
                }else{
                    id=id + "*" + $(this).val();
                    ++count;
                }
            }
        });
        if(id !=""){
            if(op=="change"){       
                if(act=="active"){
                    window.location=baseUrl+"/coupons/changestatus/"+id+"/Coupon/1/pastcouponlist/cngstatus";
                }else{
                    window.location=baseUrl+"/coupons/changestatus/"+id+"/Coupon/0/pastcouponlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrl+"/coupons/changestatus/"+id+"/Coupon/0/pastcouponlist/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    } 

	$('#CouponMenu').removeClass("butBg");
	$('#CouponMenu').addClass("butBgSelt");

</script>
<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
            	<h2>Past Coupons</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("coupons", array("action" => "pastcouponlist",'name' => 'pastcouponlist', 'id' => "pastcouponlist")) ?>
						<script type='text/javascript'>
                            function setprojectid(projectid){
                                document.getElementById('projectid').value= projectid;
                                document.adminhome.submit();
                            }
                        </script>
                    <?php
                    e($html->link($html->image('new.png', array('alt' => 'New')) . ' ',array('controller'=>'coupons','action'=>'addcoupon'),array('escape' => false)));
                    
                    ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
                    <a href="javascript:void(0)" onclick="editoffer();" id="linkedit"><?php e($html->image('edit.png')); ?></a>
                    <?php  echo $this->renderElement('new_slider');  ?>			
                </div>
                
            </div>
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                      <li>
						<?php
						e($html->link(
									$html->tag('span', 'New'),
									array('controller'=>'coupons','action'=>'addcoupon'),
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
                </ul><?php */?>
            </div>
        </div>
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="coupons";    $this->subtabsel="pastcouponlist";
             echo $this->renderElement('coupons_submenus');  ?>
    </div>
</div> 

<div class="midCont">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>  
    <!-- top curv image starts -->
    <div>
        <!--<span class="topLft_curv"></span>
        <span class="topRht_curv"></span>-->
        
        <div class="gryTop">
            <?php echo $form->create("Coupon", array("action" => "pastcouponlist",'name' => 'pastcouponlist', 'id' => "pastcouponlist")) ?>
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
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url ?>/coupons/pastcouponlist')" id="locaa"></span>
			
			<span class="srchBg2"><input type="button" value="CSV File Download" label="" onclick="javascript:(window.location='<?php echo $csvUrl ?>')" id="locaa"></span>

        </div>
        </div>	
        <div class="clear"></div></div>

    <?php $i=1; ?>			

    <div class="tblData table-responsive">

        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" width="1%">#</th>
                <th align="center" valign="middle" width="2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('starttime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Start Date</th>
				<th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('endtime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>End Date</th>
   				<th align="center" valign="middle" width="17%"><span class="right"><?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Coupon Name</th>
 				<th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('frequency', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Frequency</th>
				<th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('coupon_cost', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Cost $</th>
				<th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('coupon_value', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Value $</th>
				<th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('location', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Locations</th>
                <th align="center" valign="middle" width="8%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
            </tr>
            <?php if($coupondata){ 
                    $alt=0;
                    $i=1;
                    foreach($coupondata as $eachrow){
						$class = ($alt%2==0)? "style='background-color:#FFF;'":  
                        $alt++;
                        $recid = $eachrow['Coupon']['id'];
                        $modelname = "Coupon";
                        $redirectionurl = "pastcouponlist";           
						$coupon_name =  $eachrow['Coupon']['title'];
						if($coupon_name) $coupon_name = AppController::WordLimiter($coupon_name,25);
						$cost =  $eachrow['Coupon']['coupon_cost'];
						$value =  $eachrow['Coupon']['coupon_value'];
                      
						$start_date = date('m/d/Y',strtotime($eachrow['Coupon']['starttime']));
						if($eachrow['Coupon']['coupon_end_by_date']!="0000-00-00"){
							$end_date = date('m/d/Y',strtotime($eachrow['Coupon']['coupon_end_by_date']));						
						}else{ $end_date ="N/A";}	
						
						?>
                    	<tr <?php echo $class;?>>	

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$start_date),
								array('controller'=>'coupons','action'=>'addcoupon',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$end_date),
								array('controller'=>'coupons','action'=>'addcoupon',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>      
                        
                        <td align="center" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$coupon_name),
								array('controller'=>'coupons','action'=>'addcoupon',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>  
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span', 'N/A'),
								array('controller'=>'coupons','action'=>'addcoupon',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',$cost),
								array('controller'=>'coupons','action'=>'addcoupon',$recid),
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
								$html->tag('span', $value),
								array('controller'=>'coupons','action'=>'addcoupon',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
						 <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span', 'N/A'),
								array('controller'=>'coupons','action'=>'addcoupon',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
							
                        <td align="center" valign="middle">
						
						<?php 
						if($eachrow['Coupon']['active_status']=='1'){
							e(
								$html->link(
									$html->image('active.gif',array('title'=>'Click here to deactivate '.$coupon_name)),
									array('controller'=>'coupons','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}else {

							e(
								$html->link(
									$html->image('deactive.gif',array('title'=>'Click here to activate '.$coupon_name)),
									array('controller'=>'coupons','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}
						?>
						</td>
                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="9" align="center">No Past Coupons Found.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <!--<span class="botLft_curv"></span>
        <span class="botRht_curv"></span>-->
        <div class="gryBot"><?php  echo $this->renderElement('newpagination'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>

                    </div>

<div class="clear"></div>
