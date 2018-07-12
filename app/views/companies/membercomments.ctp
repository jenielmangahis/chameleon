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
             <?php echo $form->create("Companies", array("action" => "membercomments/$recordid",'name' => 'membercomments', 'id' => "membercomments")) ?>      
          
              <span class="titlTxt">  Comments </span>
  
            <div class="topTabs">
            <!--    <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>        -->
            </div>

           
                        <?php    $this->loginarea="companies";    $this->subtabsel="comments";
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
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/membercomments/<?php echo $recordid;?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            

        </div><span class="topRht_curv"></span>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:3%">#</th>
              <!--  <th align="center" valign="middle" style="width:3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th> -->
                <th align="center" valign="middle" style="width:8%"><span class="right"><?php echo $pagination->sortBy('comment_date', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Date</th>
                <th align="center" valign="middle" style="width:8%"><span class="right"><?php echo $pagination->sortBy('comment_date', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Time</th>
                <th align="center" valign="middle" style="width:28%"><span class="right"><?php echo $pagination->sortBy('comment_type_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Type</th>
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('is_additional_allowed', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Suggested/Add'l</th>
                <th align="center" valign="middle" style="width:35%"><span class="right"><?php echo $pagination->sortBy('commentdata', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Comment</th>
               
            </tr>
            <?php $i=1;?>
            <?php if($holdercommentlist){
                    $created="";     $i=1;         
                    foreach($holdercommentlist as $eachrow){
                      $recid = $eachrow['Comments']['id'];
                         if($eachrow['Comments']['comment_date'] !='0000-00-00'){
                            $created =explode("," , AppController::usdateformat($eachrow['Comments']['comment_date'],1)); 
                            $comment_date= $created[0]; 
                            $comment_time=$created[1]; 
                        }  
                        $comment_type = $eachrow['Comments']['comment_type_name']; 
                        $is_additional = $eachrow['Comments']['is_additional_allowed']; 
                        $comment = $eachrow['Comments']['commentdata'];
                         if($is_additional=="1"){
                             $is_additional_val="Additional";
                         }else{
                              $is_additional_val="Suggested"; 
                         }
                     if($i%2 == 0 ){
                       $cls="altrow";        
                     } else{
                        $cls=""; 
                     }
                        
                    ?>
               <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            <!--<td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="< ?php echo $recid; ?>" /></span></a></td>-->
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $comment_date?$comment_date:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $comment_time?$comment_time:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $comment_type?$comment_type:"N/A"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $is_additional_val?$is_additional_val:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $comment?$comment:"N/A"; ?></span></td>
                          </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="6" align="center">No comments Found.</td></tr>
                <?php  } ?>

        </table>




    </div>     
    
         <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($holdercommentlist) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>

    </div> <!--inner-container ends here-->
  </div>   

    <?php echo $form->end();?>
    <div class="clear"></div>
 </div>      