<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'status_type_list';
$csvUrl = $base_url_admin.'download_status_type_list';
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
<?php echo $form->create("Admins", array("action" => "status_type_list",'name' => 'status_type_list', 'id' => "status_type_list"))?>
  <span class="titlTxt">Status Type List</span>
        <div class="topTabs">
			<ul class="dropdown">
			<li class="">
			<?php
			e(
				$html->link(
					$html->tag('span','New'),
					array('controller'=>'admins','action'=>'status_type'),
					array('escape'=>false)
				)	
			);
			?>
			</li>
			<li class="">
			<a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
				<ul class="sub_menu" style="visibility: hidden;">
						<li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
						<li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
						<li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
						<li class="botCurv"></li>
				</ul>
			</li>
			</ul>
        </div>
		<div style="clear:both;"></div>
		<?php $this->status_type_list="tabSelt"; echo $this->renderElement('project_list_submenu'); ?>
</div>
</div>
<div class="midCont" id="indxpage" style="min-height:auto;">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
            <?php echo $form->create("Admins", array("action" => "status_type_list",'name' => 'status_type_list', 'id' => "status_type_list")) ?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                
                    document.getElementById('projectid').value= projectid;
                    document.projectlist_by_product.submit();
                }
        </script><div style="float:left">
        <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("StatusType.searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
        <span class="srchBg2">
		<input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
        </div>
               
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
            <th align="center" width="17%">
            <span style="float:right">
                <?php echo $pagination->sortBy('coinset_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Status Type
            </th>
			<th align="center" width="15%"><span style="float:right"><?php echo $pagination->sortBy('project_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
              </span>
                Project Default
            </th>
            <th align="center" width="55%">
            <span style="float:right">
                <?php echo $pagination->sortBy('price_type_options_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            
            Note
            
            </th>
            <th align="center" width="10%">
            <span style="float:right">
                <?php echo $pagination->sortBy('grand_total', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Status
            </th>
            </tr>
       

       <?php 
       if($status_type_list){ 
        $i=1;
		$alt=0;
        $count=1;
               foreach($status_type_list as $eachrow){
                   
               if($alt%2==0)
                $class="style='background-color:#FFF;'";
				else
                $class="style='background-color:#f8f8f8;'";
                
                $alt++;
                
               $recid = $eachrow['StatusType']['id'];
               $modelname = "StatusType";
               $redirectionurl = "status_type_list";
               $notetext = "";
               
               $notetext=($eachrow['StatusType']['notes'])?$eachrow['StatusType']['notes']:'';
            ?>

			<tr <?php echo $class;?>>    
				<td align="left" valign="middle"><a><span><?php echo $i++ ?></span></a></td>
				<td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                <td align="left" valign="middle"  width="18%">
				<?php
				e($html->link(
					$html->tag('span', $eachrow['StatusType']['status_type']),
					array('controller'=>'admins','action'=>'status_type',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
				</td>
                <td align="left" valign="middle">
				<?php 
				if($eachrow['StatusType']['default']=='1'){
					e($html->link(
						$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['StatusType']['status_type'])),
						array('controller'=>'admins','action'=>'status_setAsDefault',$recid),
						array('escape' => false)
						)
					);
				} else {
					e($html->link(
						$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['StatusType']['status_type'])),
						array('controller'=>'admins','action'=>'status_setAsDefault',$recid),
						array('escape' => false)
						)
					);
				}			
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $notetext),
					array('controller'=>'admins','action'=>'status_type',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php 
				if($eachrow['StatusType']['active_status']=='1'){
					e($html->link(
						$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['StatusType']['status_type'])),
						array('controller'=>'admins','action'=>'setup_changestatus',$recid,'2'),
						array('escape' => false)
						)
					);
				} else {
					e($html->link(
						$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['StatusType']['status_type'])),
						array('controller'=>'admins','action'=>'setup_changestatus',$recid,'1'),
						array('escape' => false)
						)
					);
				}			
				?>
				</td>
        </tr>
		<?php } } else{ ?>
    <tr><td colspan="6" align="center">No Projects found.</td></tr>
    <?php } ?>
    </table>
</div>

<!--inner-container ends here-->
<?php echo $form->end();?>
                     <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($status_type_list) { echo $this->renderElement('newpagination'); } ?>
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
									if(confirm("Are you sure you want to Activate project(s)?"))   {
										 window.location=baseUrlAdmin+"changestatus/"+id+"/StatusType/1/status_type_list/cngstatus";      
									} 
                                        
                                }else{
									if(confirm("Are you sure you want to Deactivate project(s)?"))   { 
										window.location=baseUrlAdmin+"changestatus/"+id+"/StatusType/0/status_type_list/cngstatus";
									}
                                }
                        }
						
						if(op=="del"){
						if(confirm("You have selected "+count +" items to delete ?"))

						if(confirm("Are you sure to delete the item ?"))
						//alert("yess");
                        window.location=baseUrlAdmin+"status_type_delete/"+id+"/delete";
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
    document.getElementById("indxpage").className = "newmidCont";
    }    
</script>