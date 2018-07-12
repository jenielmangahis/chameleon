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
            document.getElementById("linkedit").href=baseUrl+"companies/eventcreate/"+id; 

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
            document.getElementById("linkinvite").href=baseUrl+"companies/eventinvitation/"+id; 

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
                    window.location=baseUrl+"companies/changestatus/"+id+"/RecurringEvent/1/eventlist/cngstatus";
                }else{
                    window.location=baseUrl+"companies/changestatus/"+id+"/RecurringEvent/0/eventlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrl+"companies/changestatus/"+id+"/RecurringEvent/0/eventlist/delete";
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
<div class="titlCont"><div class="myclass">

<div align="center" class="slider" id="toppanel">
     <?php  echo $this->renderElement('new_slider');  ?>

</div>
               <?php echo $form->create("Company", array("action" => "eventlist",'name' => 'eventlist', 'id' => "eventlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
<span class="titlTxt">  Events</span>
<div class="topTabs">
<ul class="dropdown">
   <li>
	<?php
		e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'companies','action'=>'eventcreate'),
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
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both;">
<ul class="topTabs2">
                  <!--<li><a href="companies/eventlist" class="tabSelt"><span>Current Events</span></a></li>    
                  <li><a href="companies/pasteventlist" ><span>Past Events</span></a></li>
                  <li><a href="companies/calendarlist"  ><span>Calendar</span></a></li>    
                  <li><a href="companies/eventautoresponders"  ><span>AutoResponse</span></a></li>    
                  <li><a href="companies/event_pages/detail"><span>Event Pages</span></a></li>    
                  <li><a href="companies/event_pages/sponsor"><span>Sponsor Pages</span></a></li>    
                  <li><a href="companies/event_pages/inquiry"><span>Inquiry Pages</span></a></li>   
                  <li><a href="companies/event_types" ><span>Types</span></a></li>-->
				  <?php	$this->loginarea="companies";    $this->subtabsel="eventlist";
						echo $this->renderElement('events_submenus');
					?>			  
</div>
<div class="clear"></div>		    
</div>
</div>
<div class="midCont">			      
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <div class="gryTop">

            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                ?> 
            </span>
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/eventlist')" id="locaa"></span>

        </div>	<span class="topRht_curv"></span>
        <div class="clear"></div></div>

    <?php $i=1; ?>			

    <div class="tblData">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="trBg">
                <th align="center" valign="middle" width="1%">#</th>
                <th align="center" valign="middle" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" style="width: 15%"> 
                <span class="right">
                 <?php echo $pagination->sortBy('start_date', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?>
                </span>
                Date & Start Time</th>
                <th align="center" valign="middle" width="18%"> <span class="right"><?php echo $pagination->sortBy('event_title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');  ?></span>Event Name</th>
                <th align="center" valign="middle" width="15%"> <span class="right"><?php echo $pagination->sortBy('location', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');  ?></span>Location</th>
                <th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('rsvp_required', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');  ?></span>RSVP</th>
                <th align="center" valign="middle" width="12%8%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');  ?></span>Member</th>
                <th align="center" valign="middle" width="8%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');  ?></span>Holder</th>
                <th align="center" valign="middle" width="7%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');  ?></span>Status</th>

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
                        $recid = $eachrow['RecurringEvent']['id'];
                        $event_id = $eachrow['RecurringEvent']['event_id'];
                        
                        $modelname = "RecurringEvent";
                        $redirectionurl = "eventlist";
                        //    $company_type_id = $eachrow['CompanyType']['company_type_name'];
                        $event_name = $eachrow['RecurringEvent']['event_title'];
                        if($event_name) $event_name = AppController::WordLimiter($event_name,25);

                        $event_description = $eachrow['RecurringEvent']['eventdescription'];
                        if($event_description) $event_description = AppController::WordLimiter($event_description,30);

                        $location = $eachrow['RecurringEvent']['location'];
                        if($location) $location = AppController::WordLimiter($location,28);

                        $start_date = date('m-d-Y', strtotime($eachrow['RecurringEvent']['start_date']));
                        //$starttime = AppController::usdateformat($starttime,1);
                         
                        $start_time =$start_date.",".date("g:i a", strtotime($eachrow['RecurringEvent']['starttime'])); 
                        if($eachrow['RecurringEvent']['rsvp_required']==1)
                            $rsvp="Yes";
                        else
                            $rsvp="No";

                        //$endtime = $eachrow['RecurringEvent']['end_date'];
                        //$endtime = AppController::usdateformat($endtime,1);
                        //debugbreak();
                        App::import("Model", "Event");
                        $this->Event =  & new Event();   
                        
                        $condition = "Event.project_id = '".$eachrow['RecurringEvent']['project_id']."' and  Event.id='".$eachrow['RecurringEvent']['event_id']."' and Event.active_status='1' and Event.delete_status='0'";
                        
                        $event_data= $this->Event->find('first',array("conditions"=>$condition));
                        
                        $project_id = $eachrow['RecurringEvent']['project_id'];
                        $member_type_for_non_member=AppController::getMemberTypeIdByTypeName("Non Member",$project_id);
                        $member_type_for_holder=AppController::getMemberTypeIdByTypeName("Holder",$project_id);

                        if($eachrow['RecurringEvent']['member_type']==$member_type_for_non_member['MemberType']['id'] || $eachrow['RecurringEvent']['member_type']=="0")
                            $members_only="No";
                        else
                            $members_only="Yes";
                        
                        if($eachrow['RecurringEvent']['member_type']==$member_type_for_holder['MemberType']['id'])
                            $holders_only="Yes";     
                        else
                            $holders_only="No";
                        

                    ?>
                    <tr <?php echo $class;?>>	

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$start_time),
								array('controller'=>'companies','action'=>'edit_event',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e(
							$html->link(
								$html->tag('span',$event_name),
								array('controller'=>'companies','action'=>'edit_event',$recid),
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
								array('controller'=>'companies','action'=>'edit_event',$recid),
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
								array('controller'=>'companies','action'=>'edit_event',$recid),
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
								array('controller'=>'companies','action'=>'edit_event',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="center" valign="middle" >
						<?php
						e(
							$html->link(
								$html->tag('span',($holders_only)?$holders_only:'N/A'),
								array('controller'=>'companies','action'=>'edit_event',$recid),
								array('escape'=>false)
							)
						);
						?>
						</td>
                        <td align="center" valign="middle">
						
						<?php 
						if($eachrow['RecurringEvent']['active_status']=='1'){
							e(
								$html->link(
									$html->image('active.gif',array('title'=>'Click here to deactivate '.$event_name)),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}else {

							e(
								$html->link(
									$html->image('deactive.gif',array('title'=>'Click here to activate '.$event_name)),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}
						?>
						</td>
                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="8" align="center">No Event Found.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <span class="botLft_curv"></span>
        <div class="gryBot"><?php if($eventdata) { echo $this->renderElement('newpagination'); } ?>
        </div><span class="botRht_curv"></span>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>

                    </div>

<div class="clear"></div>
