<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 
<?php $lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'sa_event_types';
?>
<div class="container">

<div class="titlCont1"><div style="width:960px;margin:0 auto">
        <?php echo $form->create("Admins", array("action" => "sa_addeventtype",'name' => 'sa_addeventtype', 'id' => "sa_addeventtype",'onsubmit' => 'return validateeventtype();'))?>
        <?php  echo $form->hidden("EventType.id", array('id' => 'id','value'=>$event_type_id)); ?>
        <div align="center" id="toppanel" >
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>
        <?php if($event_type_id!="") $head="Edit"; else $head="Edit"; ?>
        <span class="titlTxt"><?php echo $head;?> Event Types </span>
        <div class="topTabs">

            <ul>


                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
            </ul>
            </ul>
        </div>
    </div></div>
<div class="boxBor1">
    <div class="boxPad">
        <div class="" height="300">
             <div id="addprjtype" style="width: 960px; height:300px; margin: 0pt auto;" align="left">     
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
                <table width="600px" height="250px" align="left" cellpadding="1" cellspacing="1">
                    <tr>
                        <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('EventType.event_type', array('class' => 'errormsg'));
                        ?></td>
                    </tr>
                    <tr><td align="right">
                    <div class="updat">
                    <label class="boldlabel" style="margin-bottom: 5px;">Event Type <span class="red">*</span></label>
                    </div>
                    </td>
                        <td>
                            <span class="intpSpan"><label for="title"></label> 
                            <?php echo $form->input("EventType.event_type", array('id' => 'event_type', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                             </span>

                        </td>
                    </tr>

                    <tr>
                    <td align="right">
                    <div class="updat">
                    <label class="boldlabel">Description </label>&nbsp;
                    </div>
                    </td>
                        <td>
                            <span class="txtArea_top">
                                <span class="newtxtArea_bot"><?php echo $form->textarea("EventType.event_type_desp", array('id' => 'event_type_desp', 'div' => false, 'label' => '','cols' => '27', 'rows' => '4',"class" => "noBg",'style'=>'width:225px;'));?>

                                </span></span>           
                        </td>
                    </tr>
                    
                    <tr><td valign='top' align="right">
                    <div class="updat">
                    <label class="boldlabel">Show Map </label>&nbsp;
                    </div>
                    </td>
                        <td style="padding-bottom:14px;">

                        <?php echo $form->input("EventType.show_map", array('id' => 'show_map', 'div' => false, 'label' => '','type'=>'checkbox'));?>

        
                        </td>
                    </tr>

                    </tr><tr><td><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
                                <?php  echo $this->renderElement('bottom_message');  ?>
                            </div></td></tr>

                    <!-- ADD FIELD EOF -->  	
                    <!-- BUTTON SECTION BOF -->  
                    <tr><td colspan="2">
                        </td></tr>
                    <tr><td>&nbsp;</td></tr>



                </table>


                <!-- ADD Sub Admin  FORM EOF -->

            </div></div></div></div>


<!--inner-container ends here-->
<?php echo $form->end();?>  
<div class="clear"></div>

<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("addprjtype").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	
    
    
    function validateeventtype()
    {
        if($("#event_type").val()=="")
        {
            inlineMsg('event_type','<strong>Event Type is required.</strong>',2);
            return false; 
        }
        
        return true;
    }
    
</script>
<!--container ends here-->

