<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 
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



    function editevent()
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
            document.getElementById("linkedit").href=baseUrlAdmin+"sa_addeventtype/"+id; 

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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/EventType/1/sa_event_types/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/EventType/0/sa_event_types/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/EventType/0/sa_event_types/delete";
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
   <div class="cneterPage">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("Admin", array("action" => "sa_event_types",'name' => 'sa_event_types', 'id' => "sa_event_types")) ?>
           <span class="titlTxt">Event Types</span>
            
            <div class="topTabs">
                <ul class="dropdown">
                      <li>
						
						<?php
							e($html->link(
							$html->tag('span', 'New'),
							array('controller'=>'admins','action'=>'sa_addeventtype'),
							array('escape' => false)
							)
						);
					?>

					</li>   
                      <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                                         <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                                         <li class="botCurv"></li>
                                    </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editevent();" id="linkedit"><span>Edit</span></a></li>         
                </ul>
            </div>
           <div class="clear"></div>
          <?php $this->sa_event_types="tabSelt";
             echo $this->renderElement('super_admin_types');  ?>    

        </div>
        </div>
<div class="midCont">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
			<span class="topRht_curv"></span>
        <div class="gryTop">
		<div class="new_filter">
            <?php echo $form->create("Admin", array("action" => "sa_event_type",'name' => 'eventlist', 'id' => "eventlist")) ?>
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
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>sa_event_types')" id="locaa"></span>

        </div>	
		</div>
		</div>
        <div class="clear"></div></div>

    <?php $i=1; ?>			

    <div class="tblData">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg" style="width: 100%;">
                <th align="center" valign="middle" width="3%">#</th>
                <th align="center" valign="middle" width="5%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" width="35%"> 
                <span class="right">
                <?php echo $pagination->sortBy('event_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>
                Event Type</th>
                <th align="center" valign="middle" width="42%"> <span class="right"><?php echo $pagination->sortBy('event_type_desp', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Description</th>
                
                <th align="center" valign="middle" width="15%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

            </tr>
            <?php if($eventtypedata){ 
                    $alt=0;
                    $i=1;
                    foreach($eventtypedata as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                        //debugbreak();
						
                        $recid = $eachrow['EventType']['id'];
                        $event_type = $eachrow['EventType']['event_type'];
                        $event_type_desp = $eachrow['EventType']['event_type_desp'];

                        
                        $modelname = "EventType";
                        $redirectionurl = "sa_event_types";

                    ?>
                    <tr <?php echo $class;?>>	

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <td align="left" valign="middle">
							
							<?php
								e($html->link(
									$html->tag('span', $event_type),
									array('controller'=>'admins','action'=>'sa_addeventtype',$recid),
									array('escape' => false)
									)
								);
							?>
						</td>
                        <td align="left" valign="middle">
							
							<?php
								e($html->link(
									$html->tag('span', $event_type_desp),
									array('controller'=>'admins','action'=>'sa_addeventtype',$recid),
									array('escape' => false)
									)
								);
							?>
						</td>                       
                        <td align="center" valign="middle">
							<?php if($eachrow['EventType']['active_status']=='1'){ 
								e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$event_type)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}
							else{

								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'dfdd','title'=>'Click here to activate '.$event_type)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
									array('escape' => false)
									)
								);
							}	
							?>
						</td>

                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="5" align="center">No Event Types Found.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <span class="botLft_curv"></span>
		<span class="botRht_curv"></span>
        <div class="gryBot"><?php if(isset($eventtypedata)) { echo $this->renderElement('newpagination'); } ?>
        </div>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>
	</div> 
<div class="clear"></div>
</div>

