<?php
$baseUrlAdmin = Configure::read('App.base_url_admin');
?>
<script type="text/javascript">

$(document).ready(function() {
 
$('#orDer').removeClass("butBg");
$('#orDer').addClass("butBgSelt");
}); 

</script>  
<!--container starts here-->
<?php $pagination->setPaging($paging);  ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
       
         <div align="center" id="toppanel" >
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>
           <?php echo $form->create("Admins", array("action" => "coinset_orders",'name' => 'coinset_orders', 'id' => "coinset_orders"))?>       
         <span class="titlTxt">Orders Approved </span>
<div class="topTabs" style="margin-left: -40px;">
        <ul class="dropdown">
                <!--<li class=""><a href="/admins/addprojecttype"><span>New</span></a></li>-->
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
            <ul class="topTabs2" id="tab-container-1-nav" style=" margin-top: 0px;padding-left: -40px;">
            <li><?php
				e($html->link(
					$html->tag('span', 'Orders Submitted'),
					array('controller'=>'admins','action'=>'coinset_orders'),
					array('escape' => false)

					)
				);
				?></li>
            <li><?php
				e($html->link(
					$html->tag('span', 'Orders Approved'),
					array('controller'=>'admins','action'=>'coinset_orders_approved'),
					array('escape' => false,'class'=>'tabSelt')

					)
				);
				?></li>
            <li><?php
				e($html->link(
					$html->tag('span', 'Orders Approved with Changes'),
					array('controller'=>'admins','action'=>'coinset_orders_approved_changes'),
					array('escape' => false)

					)
				);
				?></li>
            
            </ul>
        </div></div>
<div class="midCont">


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                <?php echo $form->create("Admins", array("action" => "coinset_orders",'name' => 'adminhome', 'id' => "adminhome")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>       <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'coinset_orders')" id="locaa"></span>
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
     <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('project_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Project Name</th>
     <th align="center" valign="middle"><span class="right">
		<?php echo $pagination->sortBy('coinset_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Coinset #
	 </th>
     <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('numunits', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span># of units</th>
     <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('datesubmitchipco', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Order Date</th>
     <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('dateestship', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Ship Date</th>
     <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('dateestdelivery', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Received Date</th>
     <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('active_status',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Status</th>
      </tr>
       <?php if($coinset_orders){ $i=1;
    $alt=0;
               foreach($coinset_orders as $eachrow){
				   //echo '<pre>';print_r($eachrow);
                //alternate color rows
            if($alt%2==0)
                $class="style='background-color:#FFF;'";
            else
                $class="style='background-color:#f8f8f8;'";
                
                $alt++;
                
               $recid = $eachrow['Coinset']['id'];
               $modelname = "Coinset";
               $redirectionurl = "coinset_orders_approved";
               $notetext = "";
               
               
           ?>
       <tr <?php echo $class;?>>    
        <td align="left" valign="middle"><a><span><?php echo $i++ ?></span></a></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                <td align="left" valign="middle"  width="18%"><a href="<?php echo $baseUrlAdmin."editcoinset_order/".$eachrow['Coinset']['id'] ;?>"><span><?php echo $eachrow['Coinset']['project_name']; ?></span></a></td>
                <td align="left" valign="middle"><a><span><?php echo $eachrow['Coinset']['coinset_name']; ?></span></a></td>
                <td align="left" valign="middle"><a><span><?php echo $eachrow['Coinset']['numunits']; ?></span></a></td>
                <td align="left" valign="middle"><a><span><?php echo $eachrow['Coinset']['datesubmitchipco']; ?></span></a></td>
                <td align="left" valign="middle"><a><span><?php echo $eachrow['Coinset']['dateestship']; ?></span></a></td>
                <td align="left" valign="middle"><a><span><?php echo $eachrow['Coinset']['dateestdelivery']; ?></span></a></td>
        <td align="left" valign="middle">		
		<?php 
						if($eachrow['Coinset']['active_status']=='1'){
							e($html->link(
								$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['Coinset']['coinset_name'])),
								array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
						} else {
							e($html->link(
								$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['Coinset']['coinset_name'])),
								array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
						}			
						?>
		
		
		</td>
        
        </tr>
    <?php } }else{ ?>
    <tr><td colspan="4" align="center">No Coinset List Found.</td></tr>
    <?php } ?>
    </table>
    


</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($coinset_orders) { echo $this->renderElement('newpagination'); } ?>
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
                document.getElementById("linkedit").href=baseUrlAdmin+"editcoinset_order/"+id; 
                
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
                                        window.location="/admins/changestatus/"+id+"/Coinset/1/coinset_orders_approved/cngstatus";
                                        }else{
                                        window.location="/admins/changestatus/"+id+"/Coinset/0/coinset_orders_approved/cngstatus";
                                        }
                        }
                        if(op=="del"){
            if(confirm("Are ou ure to delete the item ?"))
                        window.location="/admins/changestatus/"+id+"/Coinset/0/coinset_orders_approved/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  
<!--container ends here-->