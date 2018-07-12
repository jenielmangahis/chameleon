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
           <?php echo $form->create("Companies", array("action" => "memberpurchases/$recordid",'name' => 'memberpurchases', 'id' => "memberpurchases")) ?>      
            <span class="titlTxt">   Purchases </span>
  
            <div class="topTabs">
           <!--     <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>   -->
            </div>

           
                        <?php    $this->loginarea="companies";    $this->subtabsel="purchases";
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
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/memberpurchases/<?php echo $recordid;?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            

        </div><span class="topRht_curv"></span>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:5%">#</th>
              <!--  <th align="center" valign="middle" style="width:3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th> -->
                <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Register Date</th>
                <th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('serialnum', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Serial #</th>
                <th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('coinset_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Coinset #</th>

            </tr>
            <?php $i=1;?>
            <?php if($holdercoinlist){
                    $created="";     $i=1;         
                    foreach($holdercoinlist as $eachrow){
                      $recid = $eachrow['CoinsHolder']['id'];
                         if($eachrow['CoinsHolder']['created'] !='0000-00-00'){
                            $created =explode("," , AppController::usdateformat($eachrow['CoinsHolder']['created'],1)); 
                            $coin_date= $created[0]; 
                            $coin_time=$created[1]; 
                        }  
                        $serialnum = $eachrow['CoinsHolder']['serialnum'];  
                        $coinset_name = $eachrow['Coinset']['coinset_name'];
                        if(preg_match('/[A-Z]{3}/', $coinset_name)==1){
                            $coinsname= preg_split('/[A-Z]{3}/', $coinset_name);
                            $coinset_name=$coinsname[1];
                        }
                        $fullname = $eachrow['Holder']['screenname'];     
                     if($i%2 == 0 ){
                       $cls="altrow";        
                     } else{
                        $cls=""; 
                     }
                        
                    ?>
               <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $coin_date?$coin_date:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $serialnum?$serialnum:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $coinset_name?$coinset_name:"N/A";?></span></td>
                         
                          </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="4" align="center">No coins registered.</td></tr>
                <?php  } ?>

        </table>




    </div>
    <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($holdercoinlist) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->
  </div>
   <?php echo $form->end();?>
    <div class="clear"></div>
 </div>      