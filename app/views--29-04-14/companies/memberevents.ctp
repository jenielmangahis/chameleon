<?php $lgrt = $session->read('newsortingby');
    $coinHolder = $this->params['pass'][0];
    //echo $javascript->codeBlock("var coinHolder = $coinHolder");
?>   
  
<style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>


<!--container starts here-->
<?php $pagination->setPaging($paging); ?>  
    <div class="titlCont">
        <div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel" style="height: 20px;">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
           <?php 
               echo $form->create("Companies", array("action" => "memberevents/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'memberevents', 'id' => "memberevents"));
           ?>      

            <span class="titlTxt">  Events </span>
  
            <div class="topTabs">
         <!--       <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>          -->
            </div>

           
                        <?php    $this->loginarea="companies";    $this->subtabsel="events";
                            echo $this->renderElement('member_submenus');  ?>   
                   

        </div>
    </div>




  <div class="midCont" id="newhldtab">



    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <div class="gryTop">
    
            <span class="spnFilt">Filter:</span><span class="srchBg">
                    <?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                    <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));   ?>  
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/memberevents/<?php echo $recordid;?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            

        </div><span class="topRht_curv"></span>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:3%">#</th>
              <!--  <th align="center" valign="middle" style="width:10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th> -->
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('start_date', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Date & Start Time</th>
                <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('event_title', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Event Name</th>
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('location', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Location</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('invite_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>RSVP</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('tickets_booked', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span># Tickets</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('tickets_booked', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span># Attended</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('member_price', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Total $ Paid</th>
               
            </tr>
            <?php $i=1;?>
            <?php if($holdereventlist){
                    $created="";         $i=1;         
                    foreach($holdereventlist as $eachrow){
                       $recid= $eachrow['EventInvitation']['id'];
                        if($eachrow['RecurringEvent']['start_date'] !='0000-00-00'){
                            $started =explode("," , AppController::usdateformat($eachrow['RecurringEvent']['start_date'],1)); 
                            $startdate= $started[0]; 
                            $starttm =explode("," , AppController::usdateformat($eachrow['RecurringEvent']['starttime'],1)); 
                            $starttime=$starttm[1]; 
                            $startdatetime=$startdate.", ".$starttime;
                        }
                          $eventname=$eachrow['RecurringEvent']['event_title'];    
                          $eventlocation=$eachrow['RecurringEvent']['location'];    
                          $eventrsvp=$eachrow['EventInvitation']['invite_status']; 
                          if($eventrsvp=="1") $rsvp="Attending";  elseif($eventrsvp=="2") $rsvp="May Be attending"; elseif($eventrsvp=="3") $rsvp="Not attending"; else $rsvp="No Responce";
                          $eventtickets=$eachrow['EventInvitation']['tickets_booked'];    
                          $eventattending=$eachrow['EventInvitation']['tickets_booked'];    
                          $eventpricepaid=round($eachrow['RecurringEvent']['member_price'] * $eventtickets);    
                          
                         if($i%2 == 0 ){
                       $cls="altrow";        
                     } else{
                        $cls=""; 
                     }
                    ?>
                        <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                           <!--<td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="< ?php echo $recid; ?>" /></span></a></td>-->
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $startdatetime?$startdatetime:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $eventname?$eventname:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $eventlocation?$eventlocation:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $rsvp?$rsvp:"No Responce"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $eventtickets?$eventtickets:"0"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $eventattending?$eventattending:"0"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo "$"; echo $eventpricepaid?$eventpricepaid:"0"; ?></span></td>
                          </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="8" align="center">No events found.</td></tr>
                <?php  } ?>

        </table>




    </div>     
         <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($holdereventlist) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>

    </div>
     <!--inner-container ends here-->
  </div>   


    <div class="clear"></div>
 </div>      