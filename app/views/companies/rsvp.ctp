 <script type='text/javascript'> 
 function on_exit()
 {
     var status=check_tickets_cnt();
     if(status)
     document.rsvp_form.submit();
     //window.close();
 }
 </script>
 
 <style>
 select option {
    font-size: 11px;
    width: auto;
}
 </style>
 
 <?php

    $server_path=$_SERVER['REQUEST_URI'];
    $server_para=explode('/',$server_path);
    if($server_para[3]=="exit")
    {
        echo" <script type='text/javascript'> alert('Your Response has been saved.'); window.close();</script>";
    }
?>
 
 <!--<form action="/companies/rsvp/<?php echo $eventrow['RecurringEvent']['id'];?>" method="post" id="rsvp_form" name="rsvp_form"> -->
	<?php echo $form->create("companies", array("action" => "rsvp/".$eventrow['RecurringEvent']['id'],'name' => 'rsvp_form', 'id' => "rsvp_form")) ?>
 
 <?php echo $form->hidden("RecurringEvent.id", array('id' => 'rec_eventid','value'=>$rec_eventid)); ?>
  <?php echo $form->hidden("RecurringEvent.event_id", array('id' => 'event_id','value'=>$event_id)); ?>
 <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
 
 <?php if($session->check('Message.flash')){ $session->flash(); } ?>
 
 <div class="blogarticle margin8px" style="float: left; position: relative; width: 50%;">
                                            
                                            <div class="margin8px">
                                            <font size="3"><b>Hello</b> <?php echo $screenname;?></font>
                                            </div>
                                            
                                            <div class="margin8px">
                                            <font size="3"><b><?php echo $eventrow['RecurringEvent']['event_title']; ?></b> 
                                            <br />
                                            <b>Event Type:</b>
                                            <?php // echo $eventrow['RecurringEvent']['event_type']; 
                                            $event_type_data=AppController::geteventtypedetails($eventrow['RecurringEvent']['event_type']);
                                            echo $event_type_data['event_type'];
                                            ?></font>
                                            </div>
                                            <div class="margin8px">
                                            <?php // echo $form->input("attend", array('type'=>'checkbox','id' => 'attend','label'=>false,'div'=>false));?>
                                            <!--<font size="2"><b>Yes I will Attend</b></font></div>-->
                                            <b>Choose RSVP:</b>
                                            <?php 
                                            echo $form->select("attend",$rsvp_arr,0, array('id' => 'attend', 'div' => false, 'label' => '','style' =>'width:130px;height:23px',"class" =>"","maxlength" => "250"),"---Select---");

                                            ?>     
                                            
                                            <?php
                                                if($eventrow['RecurringEvent']['member_price']=='' || $eventrow['RecurringEvent']['member_price']=='0')
                                                    {
                                                        $member_price="00.00";
                                                        //$head="RSVP";
                                                    }
                                                else
                                                    {
                                                        $member_price=(float) $eventrow['RecurringEvent']['member_price'];
                                                       // $head="Buy Now";
                                                    }
                                                    
                                                if($eventrow['RecurringEvent']['non_member_price']=='' || $eventrow['RecurringEvent']['non_member_price']=='0')
                                                   {
                                                     $non_member_price="00.00";
                                                     //$head="RSVP";
                                                   }
                                                else
                                                    {
                                                        $non_member_price=(float) $eventrow['RecurringEvent']['non_member_price'];    
                                                        //$head="Buy Now";
                                                    }
                                            ?>                                       
                                             
                                             <div class="margin8px"><b>Price Per Ticket:</b>&nbsp;&nbsp;$<?php echo $member_price; ?> </div>
                                             <div class="margin8px" id="div_request"><b>Number of tickets you are requesting?:</b>
                                             <?php if($max_tickets==0) 
                                             {
                                                echo $form->input("tickets_request", array('id' => 'tickets_request','value'=>'1', 'div' => false, 'label' => '','style'=>' width:30px;'));                          
                                             }
                                            else
                                            {
                                                echo $form->select("tickets_request",$max_tickets,0,array('id' => 'tickets_request','style'=>'width:50px;'),false);
                                            }
                                              ?>  
                                             <?php /*
                                             if(!empty($future_dates))
                                             {
                                             ?>
                                             <br /><b>Select Date:</b>
                                             <?php echo $form->select("tickets_booked_date",$future_dates,0,array('id' => 'tickets_booked_date','style'=>'width:150px;'),false); ?></span></span></span>
                                             <?php
                                             }
                                             */
                                             ?>
                                              </div>

                                             <div class="margin8px"><b>Location:</b> <?php echo $eventrow['RecurringEvent']['location']; ?>  </div>
                                             <div class="margin8px"><b>Address:</b> <?php echo $eventrow['RecurringEvent']['address']; ?>  </div>
                                             <div id="change_event_info">
                                             <div class="margin8px"><b>Date & Time:</b> <?php echo date("F j, Y", strtotime($eventrow['RecurringEvent']['start_date'])); ?> </div>
                                             <div class="margin8px"><div style=" margin-left: 72px;"><?php echo date("g:i a", strtotime($eventrow['RecurringEvent']['starttime'])); ?> To <?php echo date("g:i a", strtotime($eventrow['RecurringEvent']['endtime'])); ?></div>
                                             </div>
                                                 <!--<div class="margin8px"><b>End Time: &nbsp;</b><?php // echo date("F j, Y, g:i a", strtotime($eventrow['Event']['endtime'])); ?> <br /></div>-->                                            
                                                <div class="margin8px"><b>Max. Attendees:</b> <?php echo $eventrow['RecurringEvent']['max_attendees']; ?> &nbsp;&nbsp;<b># Attending:</b> <?php echo $max_attendees_start ?>  </div> 
                                             </div>
                                             
                                             <div class="margin8px"><b>Invitees:</b> <?php if($eventrow['RecurringEvent']['show_to_invitees_only']==1) echo"Members Only"; else echo "Everyone"; ?> </div>
                                             <div class="margin8px"><b>RSVP:</b>
                                             
                                             <?php if($eventrow['RecurringEvent']['rsvp_required']==1) echo"Yes"; else echo "No"; ?> 
                                             </div> 
                                             <!--<div class="margin8px"><b>Coin Required:</b> 
                                             <?php //if($eventrow['RecurringEvent']['coin_required']==1) echo"Yes"; else echo "No"; ?> 
                                             </div>-->
                                            
                                            <span class="flx_button_lft ">
                                            <?php echo $form->button('Submit', array('div'=>false,"class"=>"flx_flexible_btn",'onclick'=>'on_exit();'));?> 
                                             </span>
                                             </div>
                                             
                                                
                                                 
                                        </div>
                                        
                                         <div id="event_map" style="float: left; position: relative; width: 40%; height: auto;">
                                         <br /><br />
                                        <?php 
                                        if($event_type_data['show_map']==1)
                                        {
                                            if($gmkey)
                                            {
                                                 echo $gm->GmapsKey(); 
                                                 echo $gm->MapHolder(); 
                                                 echo $gm->InitJs(); 
                                                 //echo $gm->GetSideClick(); 
                                                 echo $gm->UnloadMap(); 
                                            }
                                        }
                                        ?>
                                         </div>
                                        
</form>


<script type="text/javascript">
     $(document).ready(function() {
         
         $('#div_request').hide(); 
         $('#change_event_info').hide(); 
         
         set_event_info();
     
     $("#attend").change(function(){
            
              if($(this).val()==1)
                $('#div_request').show();
              else
                $('#div_request').hide();
     }); 
     
     $("#tickets_booked_date").change(function(){
        
            set_event_info();
               
     }); 
     function set_event_info()
     {
         
        var date=$("#tickets_booked_date").val();
        var rec_eventid=$('#rec_eventid').val();
        //alert(rec_eventid);
        var eventid=$('#event_id').val();
        var current_domain=$("#current_domain").val();
             
        $.ajax({
                url: baseUrl+'companies/update_event_info/',
                cache: false,
                type:'POST',
                data:"rec_eventid="+rec_eventid+"&date="+date+"&event_id="+eventid,
                success: function(html){
                        $('#change_event_info').html(html);
                        $('#change_event_info').show(); 
                        $('#change_event_info').fadeIn(1000); 
                        //$('form#rsvp_form').append('<input type="text" id="test" value="test"/>');
                }
                });
     }
     
    }); 
    
    
    function check_tickets_cnt()
    {
        
        var max_att=Number($('#max_att').val());
        var request_tickets=Number($('#tickets_request').val());
        
        if(request_tickets > max_att)
        {
            alert("Requested tickets are more than maximum atttendees.");
            return false
        }
        return true;
    }
    
</script> 