<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script> 
<!--container starts here-->
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'pricingtype';
?>
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
       
         <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php echo $form->create("Admins", array("action" => "pricingtype",'name' => 'pricingtype', 'id' => "pricingtype"))?>    
         <span class="titlTxt">Pricing Types </span>
        <div class="topTabs" style="margin-left: -40px;">
            <ul class="dropdown">
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'addpricingtype'),
					array('escape' => false)
					)
				);
				?>
				</li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                    <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                        <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <?php $this->pricingtype="tabSelt";echo $this->renderElement('project_list_submenu'); ?>

    </div></div>
<div class="midCont">


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
            <?php echo $form->create("Admins", array("action" => "index",'name' => 'adminhome', 'id' => "adminhome")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>       <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl?>')" id="locaa"></span>
            </div>
            <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 

                    <?php $session->flash(); ?> <?php } 
                    if(!isset($selectedprojectid)) $selectedprojectid="";

                    echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
            ?></div> 
            <div class="clear"></div>
            </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
    </div>

    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg"> <th align="left" valign="middle" style="width:10px">#</th><th align="left" valign="middle" style="width:15px"><input type="checkbox" id="checkall" name="checkall" value=""></th>
                <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('pricing_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Pricing Type</th>
                <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('product_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Product Type</th>
                <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('relation_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Relation Type</th>
                <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('waive_setup', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Waive Setup</th>
                <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('count_quantity', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Count Quantity</th>
                <th align="center" valign="middle" ><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
            </tr>
            <?php if($pricingtypedata){ 
					$i=1;
					// Start of Record no, custmization
					$pagerL = Configure::read('Pagging.limit');	 
					if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
					$i= $i+($pagerL*($this->params['url']['page']-1));
					}
					// End
                    $alt=0;

                    foreach($pricingtypedata as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;

                        $recid = $eachrow['PricingType']['id'];
                        $pricing_type_name = $eachrow['PricingType']['pricing_type_name'];
                        $product_id = $eachrow['PricingType']['product_id'];
                        $product_name=$eachrow['ProductType']['product_type_name']; 
                        //getproductname($product_id);
                        $relation_type = $eachrow['PricingType']['relation_type'];
                        $waive_setup = $eachrow['PricingType']['waive_setup'];
                        $count_quantity = $eachrow['PricingType']['count_quantity'];
                        $modelname = "PricingType";
                        $redirectionurl = "pricingtype";
                        $notetext = "";
                        if($eachrow['PricingType']['notes']){
                            $notetext = AppController::WordLimiter($eachrow['PricingType']['notes'],60);
                        }
                        if($notetext==" ")
                            $notetext= $eachrow['PricingType']['notes'];

                    ?>
                    <tr <?php echo $class;?>>    
                        <td align="center" valign="middle"><a><span><?php echo $i++ ?></span></a></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                        <td align="left" valign="middle"  width="18%">
						<?php
							e($html->link(
								$html->tag('span', $pricing_type_name),
								array('controller'=>'admins','action'=>'editpricingtype',$recid),
								array('escape' => false)
								)
							);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
							e($html->link(
								$html->tag('span', $product_name),
								array('controller'=>'admins','action'=>'editpricingtype',$recid),
								array('escape' => false)
								)
							);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
							e($html->link(
								$html->tag('span', $relation_type),
								array('controller'=>'admins','action'=>'editpricingtype',$recid),
								array('escape' => false)
								)
							);
						?>
						</td>
                        <td align="center" valign="middle"><span><?php if($waive_setup==1) $check="true"; else $check="false"; ?>
                        <?php echo $form->input("PricingType.waive_setup", array('id' => 'waive_setup', 'div' => false, 'label' => '','type'=>'checkbox','checked'=>$check,'disabled'=>true));?>   
                        </span></td>           
                        <td align="center" valign="middle"><span><?php if($count_quantity==1) $check="true"; else $check="false"; ?>
                        <?php echo $form->input("PricingType.count_quantity", array('id' => 'count_quantity', 'div' => false, 'label' => '','type'=>'checkbox','checked'=>$check,'disabled'=>true));?>   </span></td>                 
                        <td align="center" valign="middle">
                            <?php 
								if($eachrow['PricingType']['active_status']=='1'){
									e($html->link(
										$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['PricingType']['pricing_type_name'])),
										array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
										array('escape' => false)
										)
									);
								} else {
									e($html->link(
										$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['PricingType']['pricing_type_name'])),
										array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
										array('escape' => false)
										)
									);
								}			
							?>
                        </td>

                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="4" align="center">No Pricing Type Found.</td></tr>
                <?php } ?>
        </table>



    </div><!--inner-container ends here-->

    <div>
        <span class="botLft_curv"></span>

        <div class="gryBot">

            <?php if(isset($pricingtypedata) && !empty($pricingtypedata)) { echo $this->renderElement('newpagination'); } ?>
        </div>

        <span class="botRht_curv"></span>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
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
            document.getElementById("linkedit").href=baseUrlAdmin+"editpricingtype/"+id; 

        }
    } 


    function activatecontents(act,op)
    {       
        var id="";
        $('.checkid').each(function(){          
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {                       
                if(id=="")
                    id=$(this).val();
                else
                    id=id + "*" + $(this).val();
            }
        });
        if(id !=""){
            if(op=="change"){       
                if(act=="active"){
                    window.location=baseUrlAdmin+"changestatus/"+id+"/PricingType/1/pricingtype/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/PricingType/0/pricingtype/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("Are you sure to delete the item ?"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/PricingType/0/pricingtype/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>  
<!--container ends here-->