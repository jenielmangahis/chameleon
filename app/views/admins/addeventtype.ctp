<?php $lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'event_types';
?>
<div class="container">
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
                <h2>
					<?php if($event_type_id!="") $head="Edit"; else $head="Add"; ?>
                	<?php echo $head;?> Event Types
                </h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Admins", array("action" => "addeventtype",'name' => 'addeventtype', 'id' => "addeventtype",'onsubmit' => 'return validateeventtype();'))?>
					<?php  echo $form->hidden("EventType.id", array('id' => 'id','value'=>$event_type_id)); ?>		
                    <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
                    <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                    <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
                    <?php  echo $this->renderElement('new_slider');  ?>	
                </div>
            </div>
        </div>
</div>
    
<div class="clearfix nav-submenu-container">
	<div class="midCont">
	  <?php    $this->loginarea="admins";    $this->subtabsel="event_types";
             echo $this->renderElement('events_submenus');  ?> 
    </div>
</div>     
    
<div class="boxBor1 midCont">
    <div class="boxPad">
        <div class="clearfix">
             <div id="addprjtype" class="centePage">     
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
                
	<?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('EventType.event_type', array('class' => 'errormsg'));  ?>
					
	<div class="frmbox">
    	<table>
            <tr>
                <td align="right">
                    <div class="updat">
                        <label class="boldlabel">Event Type <span class="red">*</span>
                        </label>
                    </div>
                </td>
                <td>
                    <span class="intp-Span">
                        <?php echo $form->input("EventType.event_type", array('id' => 'event_type', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?>
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
                    <span class="txtArea-top"> 
                        <span class="newtxtArea-bot"><?php echo $form->textarea("EventType.event_type_desp", array('id' => 'event_type_desp', 'div' => false, 'label' => '','cols' => '27', 'rows' => '4',"class" => "form-control noBg",'style'=>'width:225px;'));?></span>
                    </span>
                </td>
            </tr>
        </table>
        <div class="top-bar">
			<?php  echo $this->renderElement('bottom_message');  ?>
        </div>
    </div>
    <div class="frmbox2">
    	<table>
            <tr>
                <td align="left">
                    <div class="updat">
                        <label class="boldlabel">Show Map </label>&nbsp;
                    </div>
                </td>
                <td align="left">
                    <?php echo $form->input("EventType.show_map", array('id' => 'show_map', 'div' => false, 'label' => '','type'=>'checkbox'));?>
                </td>
            </tr>
        </table>
    </div>
    
    

					<!-- ADD Sub Admin  FORM EOF -->

            </div></div></div></div>


<!--inner-container ends here-->

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

