<?php  echo $javascript->link('ckeditor/ckeditor'); ?>
<div class="container">
<!-- Body Panel starts -->
 <div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div> 
            <?php echo $form->create("company", array("action" => "points",'name' => 'points', 'id' => "points",'enctype'=>'multipart/form-data')); ?> 
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>

            
            <span class="titlTxt">   Points </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                  
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location=baseUrl+'companies/holderslist')"><span> Cancel</span></button></li> 
                </ul>
            </div>

            <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>

                    <?php    $this->loginarea="companies";    $this->subtabsel="points";
             echo $this->renderElement('memberlist_submenus');  ?>      
        </div></div>
    
<div class="midPadd">
    <!-- <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
    <div class="">    
        <br>


        <?php if($session->check('Message.flash')){ ?> 
            <div id="blck"> 
                <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
                <div class="msgBoxBg">
                    <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
                                position: absolute;
                                z-index: 11;" /></a>
                        <?php  $session->flash();    ?> 
                    </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
                </div>
            </div> <?php } ?>
        <div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">

        </div>
        <table cellspacing="10" cellpadding="0" align="center" width="100%">
            
                <?php
                    // echo $form->hidden("Term.id", array('id' => 'termid'));
                    if($session->check('Message.flash')){ ?> 
                    <tr><td colspan="4" align="center">
                            <?php $session->flash(); ?> 
                        </td>
                    </tr>
                    <tr><td colspan="4" align="center">&nbsp;</td></tr>
                    <?php } ?>

                <tr>
                
                <td width="40%" >
                <table cellspacing="10" cellpadding="0">
                <tr>
                    <td width="2%"><b>Use</b></td>
                    <td width="2%"><b>Points</b></td>
                    <td width="2%"><b>Bonus Level</b></td>
                    <td width="40%"><b>Action Type</b></td>
                </tr>
                <?php


                    
                    for($i=0;$i<count($points_info);$i++)
                    {

                        if($points_info[$i]['points']['is_active']==1)
                            $checked="true";
                        else
                            $checked="false";
                    ?>

                    <tr>
                        <td ><?php echo $form->input("check_".$points_info[$i]['master_points']['point_id'],array('label'=>false,'type'=>'checkbox','value'=>$points_info[$i]['master_points']['point_id'],'checked'=>$checked)) ?>

                        <td >
                            <?php echo $form->input("point_".$points_info[$i]['master_points']['point_id'],array('label'=>false,'type'=>'text','value'=>$points_info[$i]['points']['point'],'size'=>'4','style'=>'border: 1px solid #026789;')) ?>


                        </td>
                        <td >
                            <?php
                                if($points_info[$i]['master_points']['is_level']==1)
                                {

                                    echo $form->input("level_".$points_info[$i]['master_points']['point_id'],array('label'=>false,'type'=>'text','value'=>$points_info[$i]['points']['level_value'],'size'=>'4','style'=>'border: 1px solid #026789;')) ;

                                }
                                else
                                    echo "&nbsp;";
                            ?>

                        </td>
                        <td ><?php echo $points_info[$i]['master_points']['Point_Name'];?></td>
                    </tr>
                    <?php
                    }
                ?>
                
                </table>
                </td>

                
                
                <td width="60%" valign="top">
                <table cellspacing="5" cellpadding="0">
                
                <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>Points Required</b></td>
                <td><b>Related Images</b></td> 
                <td>&nbsp;</td> 
                </tr>
                
                <?php
                $j=0; 
                
                 for($i=1;$i<=10;$i++)
                 {

                     if(!empty($points_awards_info[$j]['points_awards']['is_active'])==1)
                        $checked="true";
                        else
                        $checked="false";
                        
                ?>
                
                <tr>
                <td>
                <?php echo $form->input("check_award_".$i,array('id'=>'check_award_'.$i,'label'=>false,'type'=>'checkbox','value'=>"",'checked'=>$checked,
                'onclick'=>'enablenext('.$i.')')) ?></td>
                <td style="width: 200px;">Level <?php echo $i;?> Award Points Required</td>
                <td><?php echo $form->input("point_award_".$i,array('label'=>false,'type'=>'text','value'=>(!empty($points_awards_info[$j]['points_awards']['points_required'])),'size'=>'6   ','style'=>'border: 1px solid #026789;')) ?></td>
                <td><?php echo $form->input("award_image_".$i,array('label'=>false,'type'=>'file','value'=>"")) ?></td> 
                <td>
                <?php
                if(!empty($points_awards_info[$j]['points_awards']['related_image']))
                {
?>
                <img src="/<?php echo $points_awards_info[$j]['points_awards']['related_image'];?>" height="25" width="25">
                <?php
                }
?>
                </td> 
                </tr>
                
                <?php
                $j++;
                 }
?>
                
                
                </table>
                
                </td>
                </tr>
                


        </table>

        <?php echo $form->end();?>
    </div>
    </div>
  
 
<!--inner-container ends here-->


  
<div class="clear"></div>
</div>
  <!-- Body Panel ends --> 
  
  
  
<script language="javascript">

document.getElementById("check_award_2").disabled=true; 
document.getElementById("check_award_3").disabled=true;
document.getElementById("check_award_4").disabled=true;
document.getElementById("check_award_5").disabled=true;
document.getElementById("check_award_6").disabled=true;
document.getElementById("check_award_7").disabled=true;
document.getElementById("check_award_8").disabled=true;
document.getElementById("check_award_9").disabled=true;
document.getElementById("check_award_10").disabled=true;


for(i=1;i<=10;i++)
{
    if(document.getElementById("check_award_"+i).checked==true)
    {
        document.getElementById("check_award_"+i).disabled=false;
        var j=i+1;
        document.getElementById("check_award_"+j).disabled=false;
    }
    
}

</script>
  
  
<script language="javascript">


function enablenext(cnt)
{
    if(document.getElementById("check_award_"+cnt).checked==true)
    {
        var no=cnt+1;
        document.getElementById("check_award_"+no).disabled=false; 
    }
    
    
    
        if(document.getElementById("check_award_"+cnt).checked==false)
        {
            
                var j=cnt+1;
                for(i=j;i<=10;i++)
                {
                    document.getElementById("check_award_"+i).checked=false;
                    document.getElementById("check_award_"+i).disabled=true; 
                }
        }
}

</script>