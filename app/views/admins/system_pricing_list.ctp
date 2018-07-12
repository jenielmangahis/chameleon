<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'system_pricing_list';
?>
<script type="text/javascript">

$(document).ready(function() {
 
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 

</script> 
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>     
<div class="titlCont"><div style="width:960px;margin:0 auto">
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php echo $form->create("Admins", array("action" => "system_pricing_list",'name' => 'system_pricing_list', 'id' => "system_pricing_list"))?> 
<span class="newtitlTxt">System Prices </span>
<div class="topTabs" style="margin-left: -40px;">
        <ul class="dropdown">
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'system_pricing','add'),
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
            <?php $this->system_pricing_list="tabSelt";echo $this->renderElement('project_list_submenu'); ?>

</div></div>     
<div class="midCont" id="newprttype">
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                <?php echo $form->create("Admins", array("action" => "system_pricing_list",'name' => 'system_pricing_list', 'id' => "system_pricing_list")) ?>
                <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
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
     		<th align="center" valign="middle" width="31%">
				<span class="right">
					<?php echo $pagination->sortBy('system_pricing_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
				</span>Price Type
			</th>
            <th align="center" valign="middle" width="10%">
                <span class="right">
                    <?php echo $pagination->sortBy('system_version_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>Version
            </th>
            <th align="center" valign="middle" width="16%">
                <span class="right">
                     <?php echo $pagination->sortBy('system_version_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>Relation Type
            </th>
			<th align="center" valign="middle" width="14%">
                <span class="right">
                     <?php echo $pagination->sortBy('system_version_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>Non-Members
            </th>
            
    		<th align="center" valign="middle" width="12%">
			    <span class="right">
				    <?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			    </span>Shop Cart
			</th>
     			<th align="center" valign="middle" width="14%">
			    <span class="right">
			    <?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			    </span>Super Footer
			</th>
      </tr>
   	<?php 
	//pr($sys_pri_data);
	if($sys_pri_data){ 
			$i=1;
			// Start of Record no, custmization
   			$pagerL = Configure::read('Pagging.limit');	 
			if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
			$i= $i+($pagerL*($this->params['url']['page']-1));
			}
			// End
			
   			foreach($sys_pri_data as $eachrow){
                
   			$recid = $eachrow['SystemPricing']['id'];
   			$modelname = "SystemPricing";
   			$redirectionurl = "system_pricing_list";
   			$notetext = "";
   			if($eachrow['SystemPricing']['note']){
   				$notetext = AppController::WordLimiter($eachrow['SystemPricing']['note'],47);
   			}
            
            $sys_ver_name=AppController::getsystemversionnamebyID($eachrow['SystemPricing']['system_version_id']);
   			$clsName = '';
			if($i%2 == 0) { 
			$clsName = 'altrow';
			}
   		?>
	
   	<tr class='<?php echo $clsName?>'>	
		<td align="center" valign="middle" class='newtblbrd'>
		  <span style="color:#4d4d4d;"><?php echo $i++ ?></span></td>
		  <td align="center" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
          
		  <td align="left" valign="middle" class='newtblbrd'>
		  <?php
			e($html->link(
				$html->tag('span', $eachrow['SystemPricing']['system_pricing_name']),
				array('controller'=>'admins','action'=>'system_pricing','edit',$recid),
				array('escape' => false)
				)
			);
		  ?>
		  </td>
          
          <td align="center" valign="middle" class='newtblbrd'>
		  <?php
			e($html->link(
				$html->tag('span', $sys_ver_name),
				array('controller'=>'admins','action'=>'system_pricing','edit',$recid),
				array('escape' => false)
				)
			);
		  ?>
		  </td>
          <td align="center" valign="middle" class='newtblbrd'>
		  <?php
			$relation_type = ($eachrow['SystemPricing']['relation_type'])?$eachrow['SystemPricing']['relation_type']:'N/A';
			e($html->link(
				$html->tag('span', $relation_type),
				array('controller'=>'admins','action'=>'system_pricing','edit',$recid),
				array('escape' => false)
				)
			);
		  ?>
		  </td>
          <td align="center" valign="middle" class='newtblbrd'>
		  <?php
			e($html->link(
				$html->tag('span', $eachrow['SystemPricing']['inc_non_members']),
				array('controller'=>'admins','action'=>'system_pricing','edit',$recid),
				array('escape' => false)
				)
			);
		  ?>
		  </td>
		  <td align="center" valign="middle" class='newtblbrd'>
		  <?php
			$shopCart = ($eachrow['SystemPricing']['shopping_cart'])?'Yes':'No';
			e($html->link(
				$html->tag('span', $shopCart),
				array('controller'=>'admins','action'=>'system_pricing','edit',$recid),
				array('escape' => false)
				)
			);
		  ?>
		  </td>
		 <td align="center" valign="middle" class='newtblbrd'>
		 <?php
			$superFooter = ($eachrow['SystemPricing']['super_footer'])?'Yes':'No';
			e($html->link(
				$html->tag('span', $superFooter),
				array('controller'=>'admins','action'=>'system_pricing','edit',$recid),
				array('escape' => false)
				)
			);
		  ?>
		 </td>
		</tr>
	
	<?php } }else{ ?>
	<tr><td colspan="4" align="center">No System Pricing Type Found.</td></tr>
	<?php } ?>
	</table>
	


</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if(isset($sys_pri_data) && !empty($sys_pri_data)) { echo $this->renderElement('newpagination'); } ?>
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
                document.getElementById("linkedit").href=baseUrlAdmin+"system_pricing/edit/"+id; 
                
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
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/SystemPricing/1/system_pricing_list/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/SystemPricing/0/system_pricing_list/cngstatus";
                                        }
                        }
                        if(op=="del"){
			if(confirm("Are ou ure to delete the item ?"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/SystemPricing/0/system_pricing_list/delete";
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
