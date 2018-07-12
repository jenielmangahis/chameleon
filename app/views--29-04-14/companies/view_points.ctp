<script language="javascript">
function setURL(key, value) {
  // set up the url separators
  var separator = {
    // site.url/controller/action/key1:value1/key2:value2
    'key': '?',
    'value': '='
  }
 
  // get the current url
  var url = window.location.href;
  // check if the specified key already exists
  var exists = url.indexOf(separator.key + key + separator.value);
 
  // if it does
  if (exists > -1) {
    // find the next separator.key
    var last = url.indexOf(separator.key, exists + 1);
 
    // if there is one
    if (last > -1) {
      // replcae the existing value with the one passed
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value) + url.substr(last);
 
    // if not
    } else {
      // just append it
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value);
    }
 
  // if it's not already in there
  } else {
    // if the URL doesn't end with a separator.key
    if (url.substr(-1) != separator.key) {
      // append it
      url += separator.key;
    }
 
    // append the value
    url += key + separator.value + escape(value);
    
    
  }

  // set the url
  window.location.href = url;

}
</script>



<?php $pagination->setPaging($paging); ?> 
<?php //echo $this->Html->script('jquery-1.4.2.min',false);   ?>
<?php echo "<pre><!-- USER ID-";echo ($uid); echo "--></pre>"; ?>
<script type="javascript/text" language="javascript" src="js/jquery-1.4.2.min.js"> </script>
<!-- Body Panel starts -->
<div class="navigation">
    <div class="boxBg">
     
    </div>
</div>
<div class="bdyCont">
    <div class="boxBg1">
        <div class="boxBor1">
            <div class="boxPad">
                <h2 style="float:left;">Points Earned</h2>
                <div style="float: left; position: relative;width: 700px;margin-left:198px; margin-top:-30px;">     
                    <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow" id="leftmenubar_bg">
                        <?php echo $this->element("leftmenubar");?>  
                    </div>
                </div>   
                <br />
                <br />
                <br /> 
                <div class="clear"></div>
                <br />
                <div><span align='center'> <div id="flashMessage" style="display: none;"></div>
                <?php //if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
                <p class=""><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></p>
                
                
                <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>"/>
                <input type="hidden" id="folder" value="<?php echo $folder;?>"/>
                <input type="hidden" id="msg_offset" value="<?php echo $msg_offset;?>"/>
                <input type="hidden" id="msg_start" value="0"/>
          


                <br/>
                
                <div style="float: right; font-size: 15px;"></font><b>Total Points Earned:</b> <?php echo $total_points;?></div>
                <br /><br />
                
                <div width="100%" id="pointlist">
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border_shadow">
                    <tr>
                      <!--  <td width="5%" class="forName frmTitles" ></td>   -->
                      <td width="5%" class="forName frmTitles">#</td> 
                        <td width="25%" class="forName frmTitles">Date of Award</td> 
                        <td width="30%" class="forName frmTitles">Action Type</td> 
                        <td width="30%" class="forName frmTitles">Level</td> 
                        <td width="10%" class="forName frmTitles">Points</td> 
                  </tr>
                    <?php  
                        if($points_arr){ 
                            $alt=0;  
                        foreach($points_arr as $point){
                           if($alt%2==0)
                                $class="style='background-color:#FFF;'";
                           else
                                $class="style='background-color:#E8E8E8;'"; 
                             $alt++;     
                        
                        
                        $point_id=$point['PointArchiveUser']['point_id'];
                        $points=$point['PointArchiveUser']['points'];
                        
                        App::import("Model", "Point");
                       $this->Point =   & new Point();

                       $condition = "Point.project_id='".$project_id."' and  Point.point_id='".$point_id."' and point<=".$points;
                       $level_details = $this->Point->find('all', array('conditions' => $condition,'fields'=>array('Point.level_value'),'order'=>'Point.level_value desc'));
                       //$details = $this->Comment->query("select * from comments where project_id='".$project_id."' and coinset_id='0' and delete_status='0'");
                       
                       if($level_details) 
                        $level=$level_details[0]['Point']['level_value'];
                       else
                        $level=0;
                                              
                        $create_date=date('m-d-Y', strtotime($point['PointArchiveUser']['created']));

                        ?>
                        <tr <?php echo $class; ?> class="<?php echo $readclass;?>">
                        <td class="forName"><?php echo $alt;?></td>                      
                        <td class="forName"><?php echo $create_date;?></td> 
                        <td class="forName"><?php echo AppController::getpointname($point['PointArchiveUser']['point_id']);?></td> 
                        <td class="forName"><?php echo $level ; ?></td> 
                        <td class="forName"><?php echo $point['PointArchiveUser']['points'];?></td> 
                        </tr>
                            
                        <?php    }   
                        }else {

                        ?>
                            <tr><td colspan="4" class="forName" align=center>No Points Earned.</td></tr>

                    
                        <?php }?>
                </table>
                </div>
                <?php if($points_arr) { echo $this->renderElement('newpagination'); } ?>

                <p class="clear"></p>

                <p class="margin8px" ></p>   
            </div>
        </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
        </p>

    </div>
</div>
<div class="clear"></div>
<!-- Body Panel ends --> 

