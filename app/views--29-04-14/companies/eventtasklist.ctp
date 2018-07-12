<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
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



 function editcontent()
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
                document.getElementById("linkedit").href="/companies/event_task/<?php echo $rec_event_id;?>/"+id; 
                
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
                                                        window.location="/companies/changestatus/"+id+"/CommunicationTask/1/eventtasklist/cngstatus/0/<?php echo $rec_event_id;?>";
                                                        }else{
                                                        window.location="/companies/changestatus/"+id+"/CommunicationTask/0/eventtasklist/cngstatus/0/<?php echo $rec_event_id;?>";
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

            if(confirm("Are you sure to delete the item ?"))
                                        window.location="/companies/changestatus/"+id+"/CommunicationTask/0/eventtasklist/delete/0/<?php echo $rec_event_id;?>";
                                        }
                        }else{
                                alert('Please atleast one record should be select'); 
                                return false;
                        }
                }
</script>



<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container">
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
         <?php  echo $this->renderElement('new_slider');  ?>

</div>
   <?php echo $form->create("Companies", array("action" => "eventtasklist",'name' => 'eventtasklist', 'id' => "eventtasklist")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
 <?php // echo $this->renderElement('project_name');  ?>
<span class="titlTxt"> Event Tasks  </span>

<div class="topTabs">
<ul class="dropdown">
<li><a href="/companies/event_task/<?php echo $rec_event_id; ?>"><span>New</span></a></li>
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                                 <!--li><a href="javascript:void(0)">Copy</a></li-->
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
                        </ul>
</li>
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; padding-left: 40px;">
<ul class="topTabs2" style="margin-left: -40px;">
 <li><a href="/companies/rsvp_sponsor/<?php echo $rec_event_id; ?>"><span>RSVP</span></a></li>
                  <?php
     if($waiting_list==1)  
                   {
                    ?>
                  <li><a href="/companies/waitlist/<?php echo $rec_event_id; ?>"><span>Wait List</span></a></li>
                  <?php
                   }
                   ?>
                   <li><a href="/companies/send_invite/<?php // echo $rec_event_id; ?>" ><span>Send Invite</span></a></li>
                   <li><a href="/companies/event_task/<?php echo $rec_event_id; ?>" class="tabSelt"><span>Event Task</span></a></li>
                   <li><a href="/companies/eventinvitationhistory/<?php echo $rec_event_id; ?>"><span>Invites</span></a></li>
                    <li><a href="/companies/event_donations/<?php echo $this->data['RecurringEvent']['id'];; ?>" ><span>Donations</span></a></li>
                   <li><a href="/companies/event_volunteers/<?php echo $this->data['RecurringEvent']['id'];; ?>"><span>Volunteers</span></a></li>
</ul>
</div>
<div class="clear"></div>

</div>
</div>
                            <div class="midCont" id="newcmmtasktab">


<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;  position: absolute;   z-index: 11;" /></a>
                    <?php  $session->flash();    ?> 
                </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
        </div>
</div>
                                            <?php } ?>

                            <!-- top curv image starts -->
                            <div>
                            <span class="topLft_curv"></span>
                
                <div class="gryTop">
               
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200",'value'=>$key));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>'btn'));
                        ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/eventtasklist/<?php echo $rec_event_id;?>')" id="locaa"></span>
                
                        </div> <span class="topRht_curv"></span>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
        <th align="center" style="width:2%;">#</th>
        <th align="center" style="width:3%;"><input type="checkbox" value="" name="checkall" id="checkall" /></th>      
        <th align="center" valign="middle" style="width:16%;"><span class="right"><?php echo $pagination->sortBy('task_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Task Name</th> 
        <th align="center" valign="middle" style="width:16%;"><span class="right"><?php echo $pagination->sortBy('rec_event_id', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Event Name</th>           
        <th align="center" valign="middle" style="width:16%;"><span class="right"><?php echo $pagination->sortBy('email_template_id', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Email Template</th>      
        <th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('recur_pattern', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Date Sent</th>      
        <th align="center" valign="middle" style="width:10%;"><span class="right"><?php echo $pagination->sortBy('task_next_execution_date', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Time Sent</th>      
              
        <th align="center" valign="middle" style="width:10%;"><span class="right"><?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Status</th> 

        </tr>
        <?php
                if($taskdata){
                    $alt=0;
                        foreach($taskdata as $eachrow){
                            if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                        $recid = $eachrow['CommunicationTask']['id'];
                        $rec_event_id=$eachrow['CommunicationTask']['rec_event_id'];
                        $modelname = "CommunicationTask";
                        $redirectionurl = "eventtasklist";
                        $company_task_id = $eachrow['CommunicationTask']['id'];
                        $task_name= $eachrow['CommunicationTask']['task_name'];
                        $task_email_tempname= $eachrow['EmailTemplate']['email_template_name'];
                        $date_sent=date('m-d-Y',strtotime($eachrow['CommunicationTask']['task_startdate']));        
                        $event_name=$eachrow['RecurringEvent']['event_title'];                   

                ?>
                <tr <?php echo $class;?>>  
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle" class='newtblbrd'><a href='/companies/event_task/<?php echo $rec_event_id.'/'.$recid;?>'><span><?php echo $task_name; ?><a></span></td>   
                <td align="left" valign="middle" class='newtblbrd'><a href='/companies/event_task/<?php echo $rec_event_id.'/'.$recid;?>'><span><?php echo $event_name; ?><a></span></td>            
                <td align="left" valign="middle" class='newtblbrd'><a href='/companies/event_task/<?php echo $rec_event_id.'/'.$recid;?>'><span><?php echo $task_email_tempname; ?><a></span></td>              
                <td align="left" valign="middle" class='newtblbrd'><a href='/companies/event_task/<?php echo $rec_event_id.'/'.$recid;?>'><span><?php echo $date_sent;?><a></span></td>              
                <td align="left" valign="middle" class='newtblbrd'><a href='/companies/event_task/<?php echo $rec_event_id.'/'.$recid;?>'><span><?php echo $time_sent; ?><a></span></td>              
                             
               <td align="center" valign="middle" class='newtblbrd'><a><span><?php if($eachrow['CommunicationTask']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus/0/'.$rec_event_id;?>"><img src="/img/<?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate <?php echo $coinsetname; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl.'/cngstatus/0/'.$rec_event_id;?>"><img src="/img/<?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate <?php echo $coinsetname; ?>" /></a><?php } ?></td>
                
        
                </tr>
    <?php 

         } } else{ ?>
        <tr><td colspan="9" align="center">No Event Task Found.</td></tr>
        <?php } ?>
        </table>
        
    

  </div>

      <div>
      <span class="botLft_curv"></span>
      
      <div class="gryBot"><?php if($taskdata) { echo $this->renderElement('newpagination'); } ?>
      </div>
      <!--inner-container ends here-->
        

      <span class="botRht_curv"></span>
      <div class="clear"></div>
      </div>
      <?php echo $form->end();?>




<div class="clear"></div>
    </div>
    
         <div class="clear"></div>
</div>      
    
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
    {        
    document.getElementById("newcmmtasktab").className = "newmidCont";
    }    
</script>