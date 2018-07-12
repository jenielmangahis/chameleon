<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script> 
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'billingtype_list';
?>
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>     
<div class="titlCont"><div style="width:960px;margin:0 auto">
       
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php echo $form->create("Admins", array("action" => "billingtype_list",'name' => 'system_pricing_list', 'id' => "system_pricing_list"))?> 
<span class="newtitlTxt">Billing Types List</span>
<div class="topTabs" style="margin-left: -40px;">
        <ul class="dropdown">
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'addbillingtype'),
					array('escape' => false)
					)
				);
				?>
				</li>
                
				<li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                <ul class="sub_menu">
                        <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
				
        </ul>
        </div>
            <div class="clear"></div>
            <?php $this->billingtype_list="tabSelt";echo $this->renderElement('project_list_submenu'); ?>

</div></div>     
<div class="midCont" id="newprttype">
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                <?php echo $form->create("Admins", array("action" => "billingtype_list",'name' => 'billingtype_list', 'id' => "billingtype_list")) ?>
                <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("BillingType.searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2">
				<?php echo $form->submit("Go", array('id' => 'sss', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                      <?php $session->flash(); ?> <?php } 
                        ?></div> 
               <div class="clear"></div>
         </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
</div>

<div class="tblData">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg"> 
			<th align="center" valign="middle" width="1%">#</th>
			<th align="center" valign="middle" width="2%">
                <input type="checkbox" id="checkall" name="checkall" value="">
            </th>
			<th align="center" valign="middle" width="19%">
				<span class="right">
					<?php echo $pagination->sortBy('system_pricing_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
				</span>Billing Type
			</th>
            <th align="center" valign="middle" width="10%">
                <span class="right">
                    <?php echo $pagination->sortBy('system_version_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>Pay Type
            </th>
            <th align="center" valign="middle" width="13%">
                <span class="right">
                     <?php echo $pagination->sortBy('system_version_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>Bill Period
            </th>
			<th align="center" valign="middle" width="12%">
                <span class="right">
                     <?php echo $pagination->sortBy('system_version_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>Day of Mo.
            </th>
            
    		<th align="center" valign="middle" width="13%">
			    <span class="right">
				    <?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			    </span>Default CC
			</th>
     		<th align="center" valign="middle" width="14%">
			    <span class="right">
			    <?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			    </span>Project Name
			</th>
			<th align="center" valign="middle" width="30%">
			    <span class="right">
			    <?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			    </span>Notes
			</th>
      </tr>
   	<?php 
	
	if($billingtype_list){ $i=1;
   			foreach($billingtype_list as $eachrow){
                
   			$recid = $eachrow['BillingType']['id'];
   			
   			$notetext = "";
   			if($eachrow['BillingType']['notes']){
   				$notetext = AppController::WordLimiter($eachrow['BillingType']['notes'],47);
   			}
			
			if($i%2 == 0)
			$cName = 'altrow';
			else
			$cName = '';
			
        ?>
	<tr class='<?php echo $cName ?>'>	
		  <td align="center" valign="middle" class='newtblbrd'>
		  <span style="color:#4d4d4d;"><?php echo $i++ ?></span></td>
		  <td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		  <td align="left" valign="middle" class='newtblbrd'>
			<?php
			e($html->link(
				$html->tag('span', $eachrow['BillingType']['billing_type']),
				array('controller'=>'admins','action'=>'addbillingtype',$recid),
				array('escape' => false)
				)
			);
			?>
		  </td>
          <td align="center" valign="middle" class='newtblbrd'>
			<?php
			e($html->link(
				$html->tag('span', $eachrow['BillingType']['payment_type']),
				array('controller'=>'admins','action'=>'addbillingtype',$recid),
				array('escape' => false)
				)
			);
			?>
		  </td>
          <td align="center" valign="middle" class='newtblbrd'>
			<?php
			e($html->link(
				$html->tag('span', $eachrow['BillingType']['billing_period']),
				array('controller'=>'admins','action'=>'addbillingtype',$recid),
				array('escape' => false)
				)
			);
			?>
		  </td>
          <td align="center" valign="middle" class='newtblbrd'>
			<?php
			e($html->link(
				$html->tag('span', $eachrow['BillingType']['month_billing_day']),
				array('controller'=>'admins','action'=>'addbillingtype',$recid),
				array('escape' => false)
				)
			);
			?>
		  </td>
		  <td align="center" valign="middle" class='newtblbrd'>
			<?php
			$defaultCC = ($eachrow['BillingType']['default_cc'])?'Yes':'No';
			e($html->link(
				$html->tag('span', $defaultCC),
				array('controller'=>'admins','action'=>'addbillingtype',$recid),
				array('escape' => false)
				)
			);
			?>
		  </td>
		  <td align="left" valign="middle" class='newtblbrd'>
			<?php
			$btypeId = $recid;
			e($html->link(
				$html->tag('span', 'View Projects'),
				array('controller'=>'admins','action'=>'projectlist_by_btype',$btypeId),
				array('escape' => false)
				)
			);
			?>
		  </td>
		  <td align="left" valign="middle" class='newtblbrd'>
			<?php
			e($html->link(
				$html->tag('span', $notetext),
				array('controller'=>'admins','action'=>'addbillingtype',$recid),
				array('escape' => false)
				)
			);
			?>
		  </td>
		</tr>
<?php } } else{ ?>
	<tr><td colspan="8" align="center">No Billing Type Found.</td></tr>
	<?php } ?>
	</table>
	


</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if(isset($billingtype_list) && !empty($billingtype_list)) { echo $this->renderElement('newpagination'); } ?>
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
			document.getElementById("linkedit").href = baseUrlAdmin+"addbillingtype/"+id; 
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
					window.location="/admins/changestatus/"+id+"/SystemPricing/1/system_pricing_list/cngstatus";
					}else{
					window.location="/admins/changestatus/"+id+"/SystemPricing/0/system_pricing_list/cngstatus";
					}
			}
			if(op=="del"){
			if(confirm("Are ou ure to delete the item ?"))
			window.location=baseUrlAdmin+"billing_type_delete/"+id;
			}
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newprttype").className = "newmidCont";
	}	
</script>

<!--container ends here-->
