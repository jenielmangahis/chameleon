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
            <div align="center" class="slider" id="toppanel" style="height: 20px;">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php 
                echo $form->create("Admins", array("action" => "membermessages/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'membermessages', 'id' => "membermessages"));
            ?>

            <?php  echo $this->renderElement('project_name');  ?>   
            <span class="titlTxt">Messages </span>

            <div class="topTabs">
               <!-- <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>    -->
            </div>

           
                        <?php    $this->loginarea="admins";    $this->subtabsel="messages";
                            echo $this->renderElement('member_submenus');  ?>   
                  

        </div>
    </div>



  <div class="midCont" id="newhldtab">



    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <div class="gryTop">
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <span class="spnFilt">Filter:</span><span class="srchBg">
                    <?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                    <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));   ?>  
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='/admins/membermessages/<?php echo $recordid;?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            

        </div><span class="topRht_curv"></span>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:10px">#</th>
            <!--    <th align="center" valign="middle" style="width:10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th> -->
                <th align="center" valign="middle" style="width:100px"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date Sent</th>
                <th align="center" valign="middle" style="width:80px"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Time</th>
                <th align="center" valign="middle" style="width:200px"><span class="right"><?php echo $pagination->sortBy('to_holdername', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Message To</th>
                <th align="center" valign="middle" style="width:200px"><span class="right"><?php echo $pagination->sortBy('from_holdername', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Message From</th>
                <th align="center" valign="middle" style="width:280px"><span class="right"><?php echo $pagination->sortBy('msg_subject', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Message</th>
               
            </tr>
            <?php $i=1;?>
            <?php if($holdermessagelist){
                    $created="";   $i=1;
                    foreach($holdermessagelist as $eachrow){
                        
                        $recid = $eachrow['MessageHolder']['id'];
                        $msgid = $eachrow['Message']['id'];  
                        if($eachrow['Message']['created'] !='0000-00-00'){
                            $created =explode("," , AppController::usdateformat($eachrow['Message']['created'],1)); 
                            $message_date= $created[0]; 
                            $message_time=$created[1]; 
                        }  
                       
                        $message_to=$eachrow['Message']['to_holdername'];
                        $message_from=$eachrow['Message']['from_holdername'];
                        $message_subject=stripslashes($eachrow['Message']['msg_subject']);  
                        $message_content=stripslashes(str_replace("<br />", "", str_replace('\n',"",$eachrow['Message']['msg_content'])));

                            if($i%2 == 0 ){
                                $cls="altrow";        
                            } else{
                                $cls=""; 
                            }
                    ?>
                 <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                          <!--  <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="< ?php echo $recid; ?>" /></span></a></td> -->
                            <td align="left" valign="middle" class='newtblbrd'><a href='/admins/messagenew/<?php echo $msgid."/".$recordid;?>'><span><?php echo $message_date?$message_date:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle" class='newtblbrd'><a href='/admins/messagenew/<?php echo $msgid."/".$recordid;?>'><span><?php echo $message_time?$message_time:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle" class='newtblbrd'><a href='/admins/messagenew/<?php echo $msgid."/".$recordid;?>'><span><?php echo $message_to?$message_to:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle" class='newtblbrd'><a href='/admins/messagenew/<?php echo $msgid."/".$recordid;?>'><span><?php echo $message_from?$message_from:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle" class='newtblbrd'><a href='/admins/messagenew/<?php echo $msgid."/".$recordid;?>'><span style='color:#4d4d4d;'><?php echo $message_subject?$message_subject:"N/A"; ?></a></span></td>
                          </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="6" align="center">No message(s) found.</td></tr>
                <?php  } ?>

        </table>




    </div>
    <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($holdermessagelist) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->
  </div>   



    <div class="clear"></div>
 </div>      