<?php $lgrt = $session->read('newsortingby');
    $coinHolder = $this->params['pass'][0];
    //echo $javascript->codeBlock("var coinHolder = $coinHolder");
?>   
  
<style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>

   <?php $pagination->setPaging($paging); ?>      
<div class="container">    
    <div class="titlCont">
        <div style="width:960px; margin:0 auto;">
            
			<div class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			

            <?php 
                echo $form->create("Admins", array("action" => "memberevents/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'memberevents', 'id' => "memberevents"));
            ?>
<?php
echo $this->renderElement('new_slider'); 
?>			
</div>
          <span class="titlTxt1" style="padding-top:17px !important">&nbsp;</span>
            <span class="titlTxt">Events </span>
			<span class="titlTxt1" style="padding-top:17px !important">&nbsp;</span>

            <div class="topTabs" style="height:25px;">
              <!--  <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>   -->
            </div>

           
                        <?php    $this->loginarea="admins";    $this->subtabsel="events";
                            echo $this->renderElement('member_submenus');  ?>   
                  

        </div>
    </div>



  <div class="midCont" id="newhldtab">



    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span><span class="topRht_curv"></span>
        <div class="gryTop">
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<div class="new_filter">
            <span class="spnFilt">Filter:</span><span class="srchBg">
                    <?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                    <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));   ?>  
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='/admins/memberevents/<?php echo $recordid;?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            
</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:3%">#</th>
              <!--  <th align="center" valign="middle" style="width:10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th> -->
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('starttime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Date & Start Time</th>
                <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('event_title',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Event Name</th>
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('location', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Location</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('rsvp_required', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>RSVP</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('tickets_booked', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'EventInvitation',null,' ',' ');?></span># Tickets</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('tickets_booked', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'EventInvitation',null,' ',' ');?></span># Attended</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('member_price', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'EventInvitation',null,' ',' '); ?></span>Total $ Paid</th>
               
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
                            $startdatetime= $startdate.", ".$starttime;
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
    <span class="botRht_curv"></span>
    <div class="gryBot"><?php  echo $this->renderElement('newpagination'); ?>
    </div>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->
  </div>   



    <div class="clear"></div>
 </div>      