<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
    newwindow=window.open(url,'name','height=600,width=650');
    if (window.focus) {newwindow.focus()}
    return false;
}
// -->
</script>
<?php
$base_url = Configure::read('App.base_url');
?>
<div class="boxBg1">

    <div style="padding-left: 20px;"><!--<a href="/companies/login">Become a Member</a>-->
    <?php
     if($username==""){ 
         if(empty($eventdata)) {?>
    <span class="flx_button_lft ">
     <?php
      echo $form->button('Become a Member', array('div'=>false,"class"=>"flx_flexible_btn",'style'=>'font-size:12px;','onclick'=>'javascript:window.location="'.$base_url.'companies/login"'));
      ?> 
     </span>
     <?php
     }
    }
     
     {
         ?>
         <div style="font-weight:bold; font-size: 20px;">
        <?php		
        if(isset($eventdata['RecurringEvent']['event_title']) && !empty($eventdata['RecurringEvent']['event_title']))
		echo $eventdata['RecurringEvent']['event_title']; 
        ?>
        </div>
        <?php
     }
	?>
    
    
    </div>

  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    <!--&nbsp;&nbsp;&nbsp;<font size="+2" color="black"><?php // echo ucfirst($project_name)."'s";?> Events</font><br />-->

            <table width="100%" >
                <tr>
                    <td width="100%" valign="top">    <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain; ?>" />  
                        <div style="float:left;margin: 0pt auto; width: 100%;height:auto !important;height:200px;min-height:200px;">
                           
                            <div id="blog" class="">
                                <?php 
                                    if(isset($eventdata)){
                                        
                                             App::import("Model", "Holder");
                                            $this->Holder =  & new Holder();   
                                        
                                        //sometimes show event to only event invitees
                                            App::import("Model", "EventInvitation");
                                            $this->EventInvitation =  & new EventInvitation();   
            
                                        if(sizeof($eventdata) > 0){
                                          foreach ($eventdata as $eachrow) {
                                                
                                            if($eachrow['RecurringEvent']['show_to_invitees_only']==1)
                                            {
                                                $match_found=0;
                                                $condition = "EventInvitation.project_id = '".$eachrow['RecurringEvent']['project_id']."' and  EventInvitation.rec_event_id='".$eachrow['RecurringEvent']['id']."' and EventInvitation.active_status='1' and EventInvitation.delete_status='0' and EventInvitation.invite_to_holder_id='".$holder_id."'";
                                                $event_inv_data = $this->EventInvitation->find('first',array("conditions"=>$condition));
                                                if($username)
                                                {
                                                    if(!empty($event_inv_data))
                                                    {
                                                        $match_found=1;
                                                    }
                                                }
                                            }
                                            
                                          //check member type
                                        $member_type=$eachrow['RecurringEvent']['member_type'];
                                        /*
                                        if($holder_id!="")
                                        {
                                        if($member_type=="coin_holders")
                                            {
                                              $condition = "Holder.project_id = '".$eachrow['RecurringEvent']['project_id']."' AND Holder.delete_status='0' and Holder.id='".$holder_id."' and  Holder.id In(select holder_id from coins_holders where project_id=".$eachrow['RecurringEvent']['project_id']." and active_status='1' and delete_status='0')";   
                                            }
                                            else
                                            if($member_type=="non_coin_holders")
                                            {
                                                                  
                                                $condition = "Holder.project_id = '".$eachrow['RecurringEvent']['project_id']."' AND Holder.delete_status='0' and Holder.id='".$holder_id."' and Holder.id NOT In(select holder_id from coins_holders where project_id=".$eachrow['RecurringEvent']['project_id']." and active_status='1' and delete_status='0')";       
                                            }
                                            else
                                            if($member_type=="non_members")
                                            {
                                                                 
                                                $condition = "Holder.project_id = '".$eachrow['RecurringEvent']['project_id']."' AND Holder.delete_status='0' AND Holder.active_status='0' and Holder.id='".$holder_id."'";  
                                                
                                            }
                                            $show_to_member_type = $this->Holder->find('first',array("conditions"=>$condition));
                                            
                                            if(!empty($show_to_member_type) || $member_type=="all")
                                                $show_to_member_type=1;
                                        }
                                         else
                                         if($member_type=="all")
                                                $show_to_member_type=1;
                                         else
                                            $show_to_member_type=0;
                                          */
                                          
                                         $session_member_type = $session->read('User.Holder.member_type');
                                         
                                         if($member_type==$session_member_type || $member_type=="0")
                                            $show_to_member_type=1;
                                         else
                                            $show_to_member_type=0;  
                                               
                                           if($show_to_member_type==1)
                                           {
                                            
                                            if( ($eachrow['RecurringEvent']['show_to_invitees_only']==1 && $match_found==1) || $eachrow['RecurringEvent']['show_to_invitees_only']==0)
                                            {
                                             ?>
                                            <div class="blogarticle margin4px">
                                                <div class="blogtitle margin4px"><a href="/companies/pastevents/0/<?php echo $eachrow['RecurringEvent']['id']; ?>" title="<?php echo $eachrow['RecurringEvent']['event_title'] ?>" id="blogtitle">  
                                                    <?php echo  $eachrow['RecurringEvent']['event_title'] ?> </a> 
                                                </div>

                                                <div class="grayText margin4px">At <?php echo $eachrow['RecurringEvent']['location']; ?> on <?php echo date("F d, Y", strtotime($eachrow['RecurringEvent']['start_date'])); ?> | <?php echo $eachrow[0]['commentcount']; ?> Comments</div>
                                                <div class="margin4px">
                                                    <span><?php echo $eachrow['RecurringEvent']['eventdescription']; ?> </span>
                                                    <span  style="float: right;"> 
                                                    <a href="/companies/pastevents/0/<?php echo$eachrow['RecurringEvent']['id']; ?>" title="<?php echo $eachrow['RecurringEvent']['event_title']; ?>" class="orangeText" style="font-size: 11px;"> Read More</a>   </span>
                                                </div>
                                                <div class="line margin4px"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?> </div>
                                            </div>
                                            <?php 
                                             }
                                           }
                                            }
                                            if(count($eventdata)>=$eventlimit)
                                            {
                                        ?>
                                        <div style="float: right;"><a href="/companies/pastevents/<?php echo $eventlimit+$eventoffset; ?>" id="morecomment" >More Events</a> </div>
                                        <?php
                                            }
                                        }
                                        else{
                                        ?>
                                        <div class="blogarticle margin8px" style="text-align: center;">
                                            No events found!    
                                        </div>
                                        <?php
                                        }
                                    }
                                    else{    
                                        if($eventrow){ 
                                            
                                        App::import("Model", "Event");
                                        $this->Event =  & new Event();   
                                      
                                        //get profile pic
                                        $condition = "Event.id = '".$eventrow['RecurringEvent']['event_id']."'";
                                        $event_data = $this->Event->find('first',array("conditions"=>$condition)); 
                                            
                                        $event_details_page=AppController::getcontentsbyid($eventrow['RecurringEvent']['event_detail_page']);
                                        $sponsor_details_page=AppController::getcontentsbyid($eventrow['RecurringEvent']['sponsor_detail_page']);
                                        $inquiry_details_page=AppController::getcontentsbyid($eventrow['RecurringEvent']['inquiry_detail_page']);
                                        
                                        $event_details_page=str_replace(" ",".",$event_details_page);
                                        $sponsor_details_page=str_replace(" ",".",$sponsor_details_page);
                                        $inquiry_details_page=str_replace(" ",".",$inquiry_details_page);
                                        
                                          ?>
                                             <div class="margin4px" style="float: left; position: relative; width: 900px; height: auto;"> 
                                            <div style="float: left; position: relative; width: 215px;"><?php // echo $eventrow['RecurringEvent']['event_title']; ?>
                                            &nbsp;
                                            <?php if($username)
                                            {
                                                ?>
                                       
                                                    <a style="cursor: pointer;" id="comment_click"><img src="/img/comment_pop.png" width="25" height="15">Comment</a> &nbsp;
                                                    <a href=""><span class='st_sharethis' displayText='Share'></span></a>
                                        <?php
                                            }
                                            ?>
                                            </div>
                                            
                                            <div style="float: left; position: relative; margin-left: 28px;width: 300px;font-size: 18px;">
                                            <?php //echo $eventrow['RecurringEvent']['event_type']; 
                                                $event_type_data=AppController::geteventtypedetails($eventrow['RecurringEvent']['event_type']);
                                                echo $event_type_data['event_type'];
                                            ?> </div>
                                            <?php
                                            if($event_details_page!="")
                                            {
                                            ?>
                                             <div style="float: left; position: relative; margin-left: 30px;width: auto;">
                                             <span class="flx_button_lft_blue ">
                                             <?php echo $form->button('Details/Photos', array('div'=>false,"class"=>"flx_flexible_btn_blue",'style'=>'font-size:12px;','onclick'=>"return popitup('/".$event_details_page."')"));?> 
                                             </span>
                                             </div>
                                             <?php
                                             }
                                             ?>
                                             <?php
                                            if($sponsor_details_page!="")
                                            {
                                            ?>
                                              <div style="float: left; position: relative; margin-left: 10px;width: auto;">
                                             <span class="flx_button_lft ">
                                              <?php echo $form->button('Sponsor Info', array('div'=>false,"class"=>"flx_flexible_btn",'style'=>'font-size:12px;','onclick'=>"return popitup('/".$sponsor_details_page."')"));?> 
                                             </span>
                                             </div>
                                              <?php
                                             }
                                             ?>
                                             <?php
                                            if($inquiry_details_page!="")
                                            {
                                            ?>
                                             <div style="float: left; position: relative; margin-left: 10px;width: auto;">
                                             <span class="flx_button_lft_red ">
                                             <?php echo $form->button('Inquiry', array('div'=>false,"class"=>"flx_flexible_btn_red",'style'=>'font-size:12px;','onclick'=>"return popitup('/".$inquiry_details_page."')"));?> 
                                             </span>
                                             </div>
                                              <?php
                                             }
                                             ?>
                                       </div>
                                       <br /><br />
                                        
                                        <div class="margin4px" style="float: left; position: relative; width: 25%;"> 
                                        <?php
                                                    if($eventrow['RecurringEvent']['small_pic'] !=''){  ?> 
                                                    <img src="/img/<?php echo $project_name.'/uploads/'.$event_data['Event']['small_pic']; ?>" align="top"> <?php }else { ?>
                                                    <img src='/img/<?php echo $project_name; ?>/nologo.jpg' width="150px" height="150px" align="top"><?php } ?>
                                                    <div class="margin4px">
                                                    <b>Description:</b>
                                                        <?php echo  $eventrow['RecurringEvent']['eventdescription']; ?> 
                                                    </div>
                                        </div>
                                        
                                        <div class="blogarticle margin4px" style="float: left; position: relative; width: 35%;">
                                            <!--<div class="blogtitle margin4px"><a id="blogtitle">  
                                                <?php // echo  "Event Type:".$eventrow['Event']['event_type']; ?> </a> 
                                            </div>
                                            -->
                                            <?php
                                            
                                            if($eventrow['RecurringEvent']['member_price']=='' || $eventrow['RecurringEvent']['member_price']=='0')
                                                    {
                                                        $member_price="00.00";
                                                        $head="RSVP";
                                                    }
                                                else
                                                    {
                                                        $member_price=(float) $eventrow['RecurringEvent']['member_price'];
                                                        $head="Buy Now";
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
                                                    
                                                   if($username=="") 
                                                   {
                                                       ?>
                                                       <div class="margin4px" style="padding-bottom: 5px;">
                                                         <span class="flx_button_lft ">
                                                         <?php
                                                          echo $form->button('Become a Member', array('div'=>false,"class"=>"flx_flexible_btn",'style'=>'font-size:12px;','onclick'=>"javascript:window.location='/companies/login'"));
                                                          ?> 
                                                         </span>
                                                         </div>
                                                       <?php
                                                     
                                                   }
                                            
                                            ?>
                                             
                                              <div class="margin4px"><div style="padding-left: 30px;"><b>Member Price:</b>&nbsp;&nbsp;$<?php echo $member_price; ?>
                                             </div></div>
                                              <div class="margin4px"><div style="padding-left: 5px;"><b>Non-Member Price:</b>&nbsp;&nbsp;$<?php echo $non_member_price; ?> </div></div>

                                             <div class="margin4px"><div style="padding-left: 62px;"><b>Location:</b>&nbsp;&nbsp;<?php echo $eventrow['RecurringEvent']['location']; ?>  </div></div>
                                              <div class="margin4px"><div style="padding-left: 62px;"><b>Address:</b>&nbsp;&nbsp;<?php echo $eventrow['RecurringEvent']['address']; ?>  </div></div>
                                             <?php
                                             if($eventrow['RecurringEvent']['state'] && $eventrow['RecurringEvent']['city'])
                                             {
                                             ?>
                                             <div class="margin4px"><div style=" margin-left: 111px;">&nbsp;&nbsp;
<?php echo $eventrow['RecurringEvent']['city'].",".AppController::getstatename($eventrow['RecurringEvent']['state']).",".$eventrow['RecurringEvent']['zipcode']; ?>
                                             </div>
                                             </div>
                                             <?php
                                             }
                                            ?>
                                             <div class="margin4px"><div style="padding-left: 42px;"><b>Date & Time:</b>&nbsp;&nbsp;<?php echo date("F j, Y", strtotime($eventrow['RecurringEvent']['start_date'])); ?> </div></div>
                                            <div class="margin4px"><div style=" margin-left: 113px;">&nbsp;&nbsp;<?php echo date("g:i a", strtotime($eventrow['RecurringEvent']['starttime'])); ?> To <?php echo date("g:i a", strtotime($eventrow['RecurringEvent']['endtime'])); ?></div>
                                             </div>
                                             <!--<div class="margin4px"><b>End Time: &nbsp;</b><?php // echo date("F j, Y, g:i a", strtotime($eventrow['Event']['endtime'])); ?> <br /></div>-->
                                             
                                             <div class="margin4px"><div style="padding-left: 23px;"><b>Max. Attendees:</b>&nbsp;&nbsp;<?php echo $eventrow['RecurringEvent']['max_attendees']; ?> &nbsp;&nbsp;<b># Attending:</b> <?php echo $max_attendees_start; ?>  </div>  </div>
                                             <div class="margin4px"><div style="padding-left: 24px;"><b>RSVP Required:</b>&nbsp;&nbsp;<?php if($eventrow['RecurringEvent']['rsvp_required']==1) echo"Yes"; else echo "No"; ?>  </div> </div>
                                            
                                              <?php if($username){
                                                  
                                              ?>
                                              <div id="leavecomment">
                                                      <form action="/companies/event_savecomment" method="post" id="event_comment_add" name="event_comment_add"> 
                                                    <div>
                                                        <label class="boldlabel">&nbsp;&nbsp;&nbsp;Leave a comment </label>
                                                        <input type="hidden" id="event_id" name="event_id" value="<?php echo  $eventrow['Event']['id']; ?>"/>
                                                    </div>
                                                    <br />
                                                    &nbsp;&nbsp;
                                                       <span class="txtArea_top">
                                                            <span class="txtArea_bot"><?php echo $form->textarea("comment", array('id' => 'comment',  'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>
                                                             </span>
                                                       </span>
                                                    <div>&nbsp;&nbsp;&nbsp;<span class="flx_button_lft" id="savecomment">
                                                            <?php echo $form->button('Submit', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
                                                        </span>
                                                        <?php // echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/'.$project_name.'"'));?>
                                                    </div>
                                                     </form>  
                                                </div>
                                                <?php 
                                                
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" id="event_id" name="event_id" value="<?php echo  $eventrow['Event']['id']; ?>"/>  
                                             <?php   }?>
                                                
                                                 
                                        </div>
                                        
                                         <div id="event_map" style="float: left; position: relative; width: 36%; height: auto;">
                                         
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
                                         <br />
                                         <div class="margin8px" id="eventcommentlist" style="float: left; position: relative; width: 560px;">
                                                    <!-- Event Comment listing here -->
                                                 </div>
                                        
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="blogarticle margin8px" style="text-align: center;">
                                            No such event data found!    
                                        </div>
                                        <?php  
                                } } ?>
                            </div>
                        </div>
                    </td>

                </tr>
            </table>

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
  <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

<script type="text/javascript">


$(document).ready(function()
{
        var a_color=$('#comment_click').css("color");
        
        $('span.sharethis').css("color",a_color);
        $('.st_sharethis').css("color",a_color);
        var current_domain=$("#current_domain").val();
        var event_id=$("#event_id").val();
        $.ajax({
                   url: 'http://'+current_domain+'/companies/event_comments_by_ajax/'+event_id,
                   cache: false,
                   success: function(html){
                        $('#eventcommentlist').html(html);
                  }
        });
        
       $('#leavecomment').hide();
        
        $('#comment_click').click(function(){
        
            $('#leavecomment').show();    
        });
        
        
        $('#savecomment').click(function(){
            var current_domain=$("#current_domain").val();   
            if(trim($('#comment').val()) == '')
                {
                inlineMsg('comment','&lt;strong&gt;Please enter comment.&lt;/strong&gt;',2);
                return false;
            }else{
                   $.ajax({
                    type:'post',
                    dataType:'json',
                    cache: false,
                    data:$("#event_comment_add").serialize(),
                    url : 'http://'+current_domain + '/companies/events_savecomment',
                    success : function(res){
                        if(res= 1)
                            {    $('#eventcommentlist').hide();
                                 var event_id= $("#event_id").val();
                                  $.ajax({
                                           url: 'http://'+current_domain+'/companies/event_comments_by_ajax/'+event_id,
                                           cache: false,
                                           success: function(html){
                                                $('#eventcommentlist').html(html);
                                                $('#comment').val('');
                                                $('#eventcommentlist').slideDown(1000); 
                                                 $('#leavecomment').hide(); 
                                          }
                                });
                        }
                        else
                            {     $('#comment').val('');  
                                  $("#errormsg").html("&lt;strong&gt;Oops! There seems to be some problem. Please try in some time.&lt;/strong&gt;");
                        }
                    }
                });
            }

        });

});
</script>
