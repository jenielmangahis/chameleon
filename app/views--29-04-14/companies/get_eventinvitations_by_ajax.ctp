<?php  echo $this->element("admin_css"); ?>
       <table width="100%" cellpadding="3" cellspacing="3" style="line-height: 20px; font-size: 12px; font-family: arial;" >    
            <?php
              if(sizeof($eventinvitationsArray) > 0){
             foreach($eventinvitationsArray as $eachEvent){ ?>
                
            
            
            <tr>
            <td width="15%" valign="top">
            <img src="/img/<?php echo $project_name; ?>/uploads/<?php echo $eachEvent['Event']['small_pic'];?>" alt="" height="60px" width="60px">
            </td>
            <td width="60%" valign="top">
             <span class="orangeTextBold"><?php echo $eachEvent['Event']['title'];?></span><br/>
            <span class="grayText" style="font-size: 11px;"> At <?php echo ucfirst($eachEvent['Event']['location']);?> On <?php echo date("l, F j, g.ia", strtotime($eachEvent['Event']['starttime']));
             //AppController::usdateformat($eachEvent['Event']['starttime']);?>  </span><br/>
            <span id="eventshortdesc_<?php echo $eachEvent['Event']['id'];?>"><?php //echo $eachEvent['Event']['eventdescription'];
              $eventdescription = $eachEvent['Event']['eventdescription'];
                 if($eventdescription) $eventdescription = AppController::WordLimiter($eventdescription,25);
             echo $eventdescription."...";
            
            ?></span><span  id="viewfulldesc_<?php echo $eachEvent['Event']['id'];?>" style="float: right; margin-right: 2px; font-size: 11px;">
            <a href="javascript:void(0);" class="grayText">View Details</a></span>
            <span id="eventfulldesc_<?php echo $eachEvent['Event']['id'];?>" style="display: none;">
                  <?php echo $eachEvent['Event']['eventdescription'];    ?>
            </span><span id="hidefulldesc_<?php echo $eachEvent['Event']['id'];?>" class="grayText" style="display: none; float: right; margin-right: 2px; font-size: 11px;">
            <a href="javascript:void(0);" class="grayText">Hide Details</a></span>
             <br/>
            
            </td>
            <!--<td width="25%">
         
            <input type="radio" id="invite_status" name="invite_status_<?php echo $eachEvent['Event']['id'];?>" value="1" <?php if($eachEvent['EventInvitation']['invite_status']==1){ echo 'checked="checked"';}?>  /> Attending      <br/>
            <input type="radio" id="invite_status" name="invite_status_<?php echo $eachEvent['Event']['id'];?>" value="2" <?php if($eachEvent['EventInvitation']['invite_status']==2){ echo 'checked="checked"';}?> /> May Be Attending <br/>
            <input type="radio" id="invite_status" name="invite_status_<?php echo $eachEvent['Event']['id'];?>" value="3" <?php if($eachEvent['EventInvitation']['invite_status']==3){ echo 'checked="checked"';}?> /> Not Attending   <br/>
           <span class="flx_button_lft ">
                <input type="button" class="flx_flexible_btn" name="respondevent_<?php echo $eachEvent['Event']['id'];?>" id="respondevent_<?php echo $eachEvent['Event']['id'];?>" value="Respond">                                                
           </span>
            </td>-->
            </tr>
            <tr><td class="line" colspan="3"><img alt="" src="/img/<?php echo $project_name; ?>/spacer.gif"></td></tr>
            <?php }
              }else{ ?>
               <tr><td  colspan="3">No event invitations pending.</td></tr>     
           <?php   }
            ?>
            </table>