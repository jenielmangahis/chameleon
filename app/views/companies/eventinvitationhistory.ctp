<?php $pagination->setPaging($paging);
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');    
 ?> 
 <?php
    $arr = explode("/",$_SERVER['REQUEST_URI']); 
    
    if($arr[4]=="pastevent")
        $hide_menu=1;
    else
        $hide_menu=0;
        
    $receventid=$arr[3];
?>
 
 <link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">             
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
                document.getElementById("linkedit").href="/companies/editcommtask/"+id; 
                
                }
        } 


function activatecontents(act,op)
{   
    var id="";
        var count=0;
        
    var receventid=$("#receventid").val();    
    
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
                                                        window.location="/companies/changestatus/"+id+"/EventInvitation/1/eventinvitationhistory/cngstatus/0/"+receventid;
                                                        }else{
                                                        window.location="/companies/changestatus/"+id+"/EventInvitation/0/eventinvitationhistory/cngstatus/0/"+receventid;
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

            if(confirm("Are you sure to delete the item ?"))
                                        window.location="/companies/changestatus/"+id+"/EventInvitation/0/eventinvitationhistory/delete/0/"+receventid;
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
   <?php echo $form->create("Companies", array("action" => "commtaskhistorylist",'name' => 'commtaskhistorylist', 'id' => "commtaskhistorylist")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
 <?php //  echo $this->renderElement('project_name');  ?>
   <input type="hidden" id="receventid" name="receventid" value="<?php echo $receventid;?>">  
<span class="titlTxt">Invites History </span>

<div class="topTabs">
<ul class="dropdown">
<!-- <li><a href="/companies/addcommtask"><span>New</span></a></li>
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                                 <li><a href="javascript:void(0)">Copy</a></li>
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
                        </ul>
</li>-->
<!--li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li-->
<li><a href="/companies/eventlist" id="linkedit"><span>Cancel</span></a></li>  
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; padding-left: 40px;">
<ul class="topTabs2" style="margin-left: -40px;">
 <li><a href="/companies/rsvp_sponsor/<?php echo $rec_event_id;if($hide_menu==1) echo "/pastevent"; ?>"><span>RSVP</span></a></li>
                  <?php
     if($waiting_list==1)  
                   {
                    ?>
                  <li><a href="/companies/waitlist/<?php echo $rec_event_id; if($hide_menu==1) echo "/pastevent";?>"><span>Wait List</span></a></li>
                  <?php
                   }
                   ?>
                    <?php
                   if($hide_menu==0)
                   {
                   ?>
                   <li><a href="/companies/send_invite/<?php // echo $rec_event_id; ?>" ><span>Send Invite</span></a></li>
                   <li><a href="/companies/eventtasklist/<?php echo $rec_event_id; ?>"><span>Event Task</span></a></li>
                    <?php
                   }
                    ?>
                   <li><a href="/companies/eventinvitationhistory/<?php echo $rec_event_id; if($hide_menu==1) echo "/pastevent";?>" class="tabSelt"><span>Invites</span></a></li>
                   <?php
                   if($hide_menu==0)
                   {
                   ?>
                    <li><a href="/companies/event_donations/<?php echo $this->data['RecurringEvent']['id'];; ?>" ><span>Donations</span></a></li>
                   <li><a href="/companies/event_volunteers/<?php echo $this->data['RecurringEvent']['id'];; ?>"><span>Volunteers</span></a></li>
                    <?php
                   }
                    ?>
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
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
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
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/commtaskhistorylist')" id="locaa"></span>
                
                        </div> <span class="topRht_curv"></span>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
        <th align="center" style="width:2%;">#</th>
        <th align="center" style="width:3%;"><input type="checkbox" value="" name="checkall" id="checkall" /> <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">                                    </th>   
        <th align="center" valign="middle" style="width:20%;"><span class="right"><?php echo $pagination->sortBy('task_execution_date', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Last Name</th>         
        <th align="center" valign="middle" style="width:20%;"><span class="right"><?php echo $pagination->sortBy('task_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>First Name</th>      
        <th align="center" valign="middle" style="width:18%;"><span class="right"><?php echo $pagination->sortBy('email_template_id', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Member Type</th>      
        <th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('recur_pattern', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Donator Level</th>      
        <th align="center" valign="middle"style="width:15%;"><span class="right"><?php echo $pagination->sortBy('task_execution_count', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Invite Date</th>      
        <th align="center" valign="middle" style="width:50px;"><span class="right"><?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Status</th> 

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
                        
                        $recid = $eachrow['EventInvitation']['id'];
                        //$taskid = $eachrow['CommunicationTaskHistory']['task_id'];
                        $projectid = $eachrow['EventInvitation']['project_id'];
                        $modelname = "EventInvitation";
                        $redirectionurl = "eventinvitationhistory";
                        //$company_task_id = $eachrow['CommunicationTaskHistory']['id'];
                        //$task_name= $eachrow['CommunicationTaskHistory']['task_name'];
                        //$task_email_tempname= $eachrow['EmailTemplate']['email_template_name'];
                     
                        $holder_id = $eachrow['EventInvitation']['invite_to_holder_id'];
                        
                        $holder_name=AppController::getholdernamebyid($holder_id);
                        
                        App::import("Model", "Holder");
                        $this->Holder =  & new Holder();   
                        
                        $condition= "Holder.id = '".$holder_id."'";
                        $holder_data = $this->Holder->find('first',array("conditions"=>$condition));
                        
                        $first_name=$holder_data['Holder']['firstname'];
                        $last_name=$holder_data['Holder']['lastnameshow'];
                        
                        $invite_date=$eachrow['EventInvitation']['created'];
                        /*
                        if($holder_id!="")
                        {
                        
                            {
                              $condition1 = "Holder.project_id = '".$eachrow['EventInvitation']['project_id']."' AND Holder.delete_status='0' and Holder.id='".$holder_id."' and  Holder.id In(select holder_id from coins_holders where project_id=".$eachrow['EventInvitation']['project_id']." and active_status='1' and delete_status='0')";   
                              //$member_type="Coin Holder";
                            }
                          
                            {                                                  
                                $condition2 = "Holder.project_id = '".$eachrow['EventInvitation']['project_id']."' AND Holder.delete_status='0' and Holder.id='".$holder_id."' and Holder.id NOT In(select holder_id from coins_holders where project_id=".$eachrow['EventInvitation']['project_id']." and active_status='1' and delete_status='0')";       
                                //$member_type="Non Coin Holder";
                            }
                            
                            {                                               
                                $condition3 = "Holder.project_id = '".$eachrow['EventInvitation']['project_id']."' AND Holder.delete_status='0' AND Holder.active_status='0' and Holder.id='".$holder_id."'";  
                               //$member_type="Non Member";                               
                            }
                                                      
                            $coin_holder= $this->Holder->find('first',array("conditions"=>$condition1));
                                                                                   
                            if(!empty($coin_holder))
                                $member_type="Coin Holder";
                            else
                            if(empty($coin_holder))
                            {
                                $non_coin_holder = $this->Holder->find('first',array("conditions"=>$condition2));
                                if(!empty($non_coin_holder))
                                    $member_type="Non Coin Holder";
                            }
                            else
                            {
                                $non_member = $this->Holder->find('first',array("conditions"=>$condition3));
                                if(!empty($non_member))
                                    $member_type="Non Member";
                            }
                            
                            
                             
                        }
                        */
                        
                        $member_type=$eachrow['MemberType']['member_type'];
                        $donator_level=$eachrow['DonationLevel']['level_name'];
                ?>

 <tr <?php echo $class;?>>       
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $last_name?$last_name:'N/A'; ?></a></span></td>   
                <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $first_name?$first_name:'N/A'; ?></a></span></td>              
                <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $member_type?$member_type:'N/A';  ?></span></a></td>  
                <td align="center" valign="middle" class='newtblbrd'><a><span><?php echo $donator_level?$donator_level:'N/A';  ?></span></a></td>
                <td align="center" valign="middle" align="center" class='newtblbrd'><a><span><?php echo $invite_date; ?></a></span></td>              
                 <td align="center" valign="middle" class='newtblbrd'><a><span><?php if($eachrow['EventInvitation']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus/0/'.$receventid;?>"><img src="/img/<?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate <?php echo $coinsetname; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl.'/cngstatus/0/'.$receventid;?>"><img src="/img/<?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate <?php echo $coinsetname; ?>" /></a><?php } ?></td>
                
        
                </tr>
    <?php  

         } } else{ ?>
        <tr><td colspan="9" align="center">No Invite History Found.</td></tr>
        <?php } ?>
        </table>
        
           

  </div>

      <div>
      <span class="botLft_curv"></span>
      
      <div class="gryBot"><?php if($taskdata) { echo $this->renderElement('newpagination'); } ?>
      </div>
      <!--inner-container ends here-->
        

      <span class="botRht_curv"></span>
      
       <div id="taskhistoryreport" title="Task History Report">
                <p>This is a list of all sent members or contacts of selected Task History.</p>
            </div>
            
      <div class="clear"></div>
      </div>
      <?php echo $form->end();?>




<div class="clear"></div>
    </div>
    
         <div class="clear"></div>
</div>      
  <script type="text/javascript">
    // increase the default animation speed to exaggerate the effect
    $.fx.speeds._default = 1000;
    $(function() {
        $( "#taskhistoryreport" ).dialog({
            autoOpen: false,
            modal: true,
            width: 560,
            show: "blind",
            hide: "blind"
        });

       $( ".showSentHistory" ).click(function() {  // runTaskReport();
            var current_domain=$("#current_domain").val(); 
            var history= $(this).attr('id').split('_');
          //  alert(history);
            var history_id=history[1];
            var task_id=history[2];
           
            $.ajax({
                            type: "GET",  
                            url: 'http://'+current_domain+'/companies/commtask_get_history_sentitem_list_by_ajax/'+history_id+'/'+task_id,
                            cache: false,
                            success: function(result){    
                                      $("#taskhistoryreport").html(result); 
                                      $( "#taskhistoryreport" ).dialog( "open" );
                                      return false; 
                            }
              });
           
          
        });
    });

    
    if(document.getElementById("flashMessage")!=null)
    {        
    document.getElementById("newcmmtasktab").className = "newmidCont";
    }    
</script>