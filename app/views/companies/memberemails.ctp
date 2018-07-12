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
               echo $form->create("Companies", array("action" => "memberemails/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'memberemails', 'id' => "memberemails"));
            ?>
            <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>
            <span class="titlTxt">   Emails/SMS </span>
  
            <div class="topTabs">
             <!--   <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>    -->
            </div>

           
                        <?php    $this->loginarea="companies";    $this->subtabsel="emails";
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
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/memberemails/<?php echo $recordid;?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            

        </div><span class="topRht_curv"></span>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:3%">#</th>
              <!--   <th align="center" valign="middle" style="width:10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th> -->
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Date Sent</th>
                <th align="center" valign="middle" style="width:7%"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Time</th>
                <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('task', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Task Name</th>
                <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('template', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Template Name</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Open(YorN)</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Link(YorN)</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Buy(YorN)</th>
               
            </tr>
            <?php $i=1;?>
            <?php if($holderemaillist){
                    $created="";  $i=1;
                    foreach($holderemaillist as $eachrow){
                        if($i%2 == 0 ){
                       $cls="altrow";        
                     } else{
                        $cls=""; 
                     }
                        $recid= $eachrow['CommunicationTaskExecutionReport']['id'];
                        if($eachrow['CommunicationTaskExecutionReport']['created'] !='0000-00-00'){
                            $created =explode("," , AppController::usdateformat($eachrow['CommunicationTaskExecutionReport']['created'],1)); 
                            $datesent= $created[0]; 
                            $timesent=$created[1]; 
                        }
                       // $datesent=date("m-d-Y", strtotime($eachrow['CommunicationTaskExecutionReport']['created']));
                       // $timesent=date("h:s", strtotime($eachrow['CommunicationTaskExecutionReport']['created']));
                        $taskname=$eachrow['CommunicationTaskHistory']['task_name'];
                        $templatename=$eachrow['EmailTemplate']['email_template_name'];
                        $emailsent=$eachrow['CommunicationTaskExecutionReport']['email_open'];
                        $emaillink=$eachrow['CommunicationTaskExecutionReport']['email_link'];
                        $emailbuy=$eachrow['CommunicationTaskExecutionReport']['email_buy'];
                    ?>
                <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                         <!--   <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="< ?php echo $recid; ?>" /></span></a></td>-->
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $datesent?$datesent:"N/A"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $timesent?$timesent:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $taskname?$taskname:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $templatename?$templatename:"N/A"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $created=="1"?"Y":"N"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $emaillink=="1"?"Y":"N"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $emailbuy=="1"?"Y":"N"; ?></span></td>
                          </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="8" align="center">No emails found.</td></tr>
                <?php  } ?>

        </table>




    </div>
    
         <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($holderemaillist) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>

    </div>
     <!--inner-container ends here-->
  </div>   


    <div class="clear"></div>
 </div>      