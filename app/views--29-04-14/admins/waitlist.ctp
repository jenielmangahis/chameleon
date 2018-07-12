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
                    window.location="/admins/changestatus/"+id+"/Event/1/eventlist/cngstatus";
                }else{
                    window.location="/admins/changestatus/"+id+"/Event/0/eventlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location="/admins/changestatus/"+id+"/Event/0/eventlist/delete";
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
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("Admin", array("action" => "contactlist",'name' => 'contactlist', 'id' => "contactlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>            <span class="titlTxt">   Wait List : Event Name  </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                     
                    <li><a href="/admins/eventlist" id="linkedit"><span>Cancel</span></a></li>         
                </ul>
            </div>
            <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
        <div style="height: 30px; clear: both;">
           <?php    $this->loginarea="admins";    $this->subtabsel="waitlist";
                    echo $this->renderElement('eventlist_submenus');  ?>
        </div>

        <div class="clear"></div>
        

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
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/admins/eventlist')" id="locaa"></span>
            <!--<span class="srchBg2"><input type="button" value="Csv file download" label="" onclick="jjavascript:(window.location='/admins/downloadrsvp')" > </span>-->

        </div>    </div>
        <div class="clear"></div></div>

    <?php $i=1; ?>            

    <div class="tblData">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr class="trBg">
                <th align="center" valign="middle" width="2%">#</th>
                <th align="center" valign="middle" width="3%">
					<input type="checkbox" value="" name="checkall" id="checkall" /></th>
                
                 <th align="center" valign="middle" width="9%"><span class="right"><?php echo $pagination->sortBy('lastnameshow', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Event Name</th>
				<th align="center" valign="middle" width="9%"><span class="right"><?php echo $pagination->sortBy('lastnameshow', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Event Type</th>
				<th align="center" valign="middle" width="9%"><span class="right"><?php echo $pagination->sortBy('lastnameshow', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Last Name</th>
                <th align="center" valign="middle" width="9%"> <span class="right"><?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>First Name</th>
                <th align="center" valign="middle" width="12%"><span class="right"><?php echo $pagination->sortBy('member_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Member Type</th>
                <th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Wait Date</th>
                <th align="center" valign="middle" width="8%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span># of Tickets</th>


            </tr>            <?php if($eventdata){ 
                    $alt=0;
                    $i=1;
                    foreach($eventdata as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                        $recid = $eachrow['EventInvitation']['id'];
                        $modelname = "EventInvitation";
                        $redirectionurl = "rsvp";
                        
                        $event_id = $eachrow['EventInvitation']['event_id'];
                        //debugbreak();
                        //$event_name = AppController::geteventnamebyid($event_id);
                        
                        $event_name = $eachrow['Event']['title'];
                        //$starttime = date('F j, Y, g:i a', strtotime($eachrow['Event']['starttime'])); 
                        $starttime = date('F j, Y, ', strtotime($eachrow['EventInvitation']['tickets_booked_date'])); 
                        $starttime = $starttime. date('g:i a', strtotime($eachrow['Event']['starttime'])); 
                        
                        
                        $holder_id = $eachrow['EventInvitation']['invite_to_holder_id'];
                        $holder_name=AppController::getholdernamebyid($holder_id);
                        
                        App::import("Model", "Holder");
                        $this->Holder =  & new Holder();   
                        
                        $condition= "Holder.id = '".$holder_id."'";
                        $holder_data = $this->Holder->find('first',array("conditions"=>$condition));
                        
                        $first_name=$holder_data['Holder']['firstname'];
                        $last_name=$holder_data['Holder']['lastnameshow'];
                        
                        $holder_city=$holder_data['Holder']['city'];
                        $holder_state=AppController::getstatename($holder_data['Holder']['state']);
                        $holder_country=AppController::getcountryname($holder_data['Holder']['country']);
                        
                         if($holder_city=="")
                            $holder_city="NA";

                        if($holder_state=="")
                            $holder_state="NA";
                        
                        $rsvp_date = $eachrow['EventInvitation']['created'];
                        $no_of_tickets = $eachrow['EventInvitation']['waitlist_tickets'];
                        $rsvp_status = $eachrow['EventInvitation']['invite_status'];
                        
                        if($rsvp_status==0)
                           $rsvp_status="Pending" ;
                        if($rsvp_status==1)
                           $rsvp_status="Attending" ;
                        if($rsvp_status==2)
                           $rsvp_status="May be Attending" ;
                         if($rsvp_status==3)
                           $rsvp_status="Not Attending" ;
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

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <!--<td align="left" valign="middle"><span><?php // echo $starttime; ?></span></td>-->
                        <td align="left" valign="middle"><span><?php echo $last_name?$last_name:'N/A'; ?></span></td>
                        <td align="left" valign="middle"><span><?php echo $first_name?$first_name:'N/A'; ?></span></td>    
                        <td align="left" valign="middle"><span><?php echo $member_type?$member_type:'N/A';  ?></span></td>  
                        <td align="center" valign="middle"><span style="color: #4d4d4d"><?php echo $donator_level?$donator_level:'N/A';  ?></span></td>
                        <td align="left" valign="middle"><span><?php echo $rsvp_date?$rsvp_date:'N/A'; ?></span></td>  
                        <td align="left" valign="middle" style="text-align: center;"><span><?php echo $no_of_tickets; ?></span></td> 
                        <td align="left" valign="middle"><span><?php echo $rsvp_status; ?></span></td> 

                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="9" align="center">Waiting List is Empty.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <span class="botLft_curv"></span><span class="botRht_curv"></span>
        <div class="gryBot"><?php echo $this->renderElement('newpagination');  ?>
        </div>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>

                    </div>

<div class="clear"></div>
