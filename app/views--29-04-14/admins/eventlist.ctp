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
            document.getElementById("linkedit").href=baseUrlAdmin+"eventcreate/"+id; 
        }
    } 

    function invitetoevent()
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
            alert("please select only one event  to invite");
            return false;
        }else{    
            document.getElementById("linkinvite").href=baseUrlAdmin+"eventinvitation/"+id; 

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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Event/1/eventlist/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Event/0/eventlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Event/0/eventlist/delete";
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
            
        <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
 <?php echo $form->create("Admin", array("action" => "eventlist",'name' => 'eventlist', 'id' => "eventlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<?php e($html->link($html->image('new.png') . ' ',array('controller'=>'admins','action'=>'eventcreate'),array('escape' => false))); ?>
			<a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
			<a href="javascript:void(0)" onclick="editevent();" id="linkedit"><?php e($html->image('edit.png')); ?></a>
			 <?php echo $this->renderElement('new_slider');  ?>
			 </div>
            <span class="titlTxt"> Current Events  </span>
            
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                      <li>
						<?php
						e($html->link(
									$html->tag('span', 'New'),
									array('controller'=>'admins','action'=>'eventcreate'),
									array('escape' => false)
									)
						);
						?>
					  </li>   
                      <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                                           <!--<li><a href="javascript:void(0)" onclick="invitetoevent();" id="linkinvite">Invite</a></li>  -->
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                                         <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                                         <li class="botCurv"></li>
                                    </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editevent();" id="linkedit"><span>Edit</span></a></li>         
                </ul><?php */?>
            </div>
           
           
          <?php    $this->loginarea="admins";    $this->subtabsel="eventlist";
		 
			if($_GET['url'] === 'admins/eventlist/1'){
             echo $this->renderElement('memberlistsecondlevel_submenus');
				}
				else{
				
             echo $this->renderElement('events_submenus'); } ?>    
        </div>
        </div>


<div class="midCont">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>  
    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <span class="topRht_curv"></span>
        <div class="gryTop">
            <?php echo $form->create("Admin", array("action" => "eventlist",'name' => 'eventlist', 'id' => "eventlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <div class="new_filter" >
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                ?> 
            </span>
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>eventlist')" id="locaa"></span>

        </div>	
        </div>
        <div class="clear"></div></div>
    <?php $i=1; ?>			
    <div class="tblData">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:1%">#</th>
                <th align="center" valign="middle"style="width:3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" style="width: 13%"> 
                <span class="right">
                <?php echo $pagination->sortBy('starttime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span> Date & Start Time</th>
                <th align="center" valign="middle" style ="width:15%"> <span class="right"><?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Event Name</th>
                <th align="center" valign="middle"style ="width:15%"> <span class="right"><?php echo $pagination->sortBy('location', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Location</th>
                <th align="center" valign="middle" style ="width:6%"><span class="right"><?php echo $pagination->sortBy('rsvp_required', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>RSVP</th>
                <th align="center" valign="middle" style ="width:15%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Member Only</th>
                
                <th align="center" valign="middle" style ="width:6%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

            </tr>
            <?php if($eventdata){ 
                    $alt=0;
                    $i=1;
                    foreach($eventdata as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                        //debugbreak();
                        $recid = $eachrow['Event']['id'];
						$starddata_time = $eachrow['Event']['starttime'];
                        $title = $eachrow['Event']['title'];
						if($title) $event_name = AppController::WordLimiter($title,25);
                        $location = $eachrow['Event']['location'];
						$members_only = $eachrow['MemberType']['member_type'];			
                        $modelname = "Event";
                        $redirectionurl = "eventlist";           
                                             
                        if($eachrow['Event']['rsvp_required']==1)
                            $rsvp="Yes";
                        else
                            $rsvp="No";                       
                        
                    ?>
                    <tr <?php echo $class;?>>	

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$starddata_time),
								array('controller'=>'admins','action'=>'eventcreate',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$title),
								array('controller'=>'admins','action'=>'eventcreate',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>      
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$location),
								array('controller'=>'admins','action'=>'eventcreate',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>  
                        <td align="center" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$rsvp),
								array('controller'=>'admins','action'=>'eventcreate',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>  
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($members_only)?$members_only:'N/A'),
								array('controller'=>'admins','action'=>'eventcreate',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                       
                        <td align="center" valign="middle">
						
						<?php 
						if($eachrow['Event']['active_status']=='1'){
							e(
								$html->link(
									$html->image('active.gif',array('title'=>'Click here to deactivate '.$event_name)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}else {

							e(
								$html->link(
									$html->image('deactive.gif',array('title'=>'Click here to activate '.$event_name)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}
						?>
						</td>
                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="9" align="center">No Event Found.</td></tr>
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
