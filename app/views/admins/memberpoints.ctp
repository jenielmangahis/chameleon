<?php $lgrt = $session->read('newsortingby');
 $coinHolder = $this->params['pass'][0];
$base_url_admin = Configure::read('App.base_url_admin');

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
                echo $form->create("Admins", array("action" => "memberpoints/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'memberpoints', 'id' => "memberpoints"));
            ?><?php  echo $this->renderElement('new_slider');  ?>		
</div>

 <span class="titlTxt1" style="padding-top:17px !important">&nbsp;</span>
            <span class="titlTxt">Points </span>
			
<span class="titlTxt1" style="padding-top:17px !important">&nbsp;</span>
            <div class="topTabs">
             <!--   <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>    -->
            </div>


                        <?php    $this->loginarea="admins";    $this->subtabsel="memberpoints";
                            echo $this->renderElement('member_submenus');  ?>   
                  

        </div>
    </div>


  <div class="midCont" id="newhldtab">



    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span><span class="topRht_curv"></span>
        <div class="gryTop">
		<div class="new_filter">
             <span class="spnFilt">Filter:</span><span class="srchBg">
                    <?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                    <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));   ?>  
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>memberpoints/<?php echo $recordid;?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            
		</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:3%">#</th>
              <!--  <th align="center" valign="middle" style="width:10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th>-->
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Date & Time</th>
                <th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('Point_Name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Action Type</th>
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('is_level', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Bonus(Y or N)</th>
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('points', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Points Awared</th>
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('point_level', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Level Achieved</th>
               
            </tr>
            <?php $i=1;?>
            <?php if($holderpointlist){
                    $created="";     $i=1;         
                    foreach($holderpointlist as $eachrow){
                         $recid = $eachrow['PointArchiveUser']['id'];
						if($eachrow['PointArchiveUser']['created'] !='0000-00-00'){
                            $action_date= AppController::usdateformat($eachrow['PointArchiveUser']['created'],1); 
                        }  
                       
                         $points = $eachrow['PointArchiveUser']['points'];
                         $action_name=$eachrow['MasterPoint']['Point_Name'];    
                         $action_level="Level 0";
                         if($eachrow['0']['point_level']!="" && $eachrow['0']['point_level']!=null){
                               $level=explode("_", $eachrow['0']['point_level']);
                               $action_level=  ucfirst($level[0])." ".$level[1];
                         }
                         $action_bonus="N";
                          if($eachrow['MasterPoint']['is_level']=="1"){
                                $action_bonus="Y";  
                          }  
                            if($i%2 == 0 ){
                                $cls="altrow";        
                            } else{
                                $cls=""; 
                            }             
                    ?>
                     <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            <!-- <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="< ?php echo $recid; ?>" /></span></a></td> -->
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $action_date?$action_date:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $action_name?$action_name:"N/A"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $action_bonus?$action_bonus:"N/A"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $points?$points:"0"; ?></span></a></td>
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $action_level?$action_level:"Level 0"; ?></span></td>
                          </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="6" align="center">No points found.</td></tr>
                <?php  } ?>

        </table>
    </div>
	
    <div>
    <span class="botLft_curv"></span>
	<span class="botRht_curv"></span>
	
    <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
    </div>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->
  </div>   


    <div class="clear"></div>
 </div>      