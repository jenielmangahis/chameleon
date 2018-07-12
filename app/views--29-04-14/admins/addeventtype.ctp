<?php $lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'event_types';
?>
<div class="container">
<div class="titlCont">
<div class="centerPage">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">	
<?php echo $form->create("Admins", array("action" => "addeventtype",'name' => 'addeventtype', 'id' => "addeventtype",'onsubmit' => 'return validateeventtype();'))?>
        <?php  echo $form->hidden("EventType.id", array('id' => 'id','value'=>$event_type_id)); ?>		
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
<?php  echo $this->renderElement('new_slider');  ?>			
</div>
        <?php if($event_type_id!="") $head="Edit"; else $head="Add"; ?>
        <span class="titlTxt"><?php echo $head;?> Event Types </span>
 <div class="topTabs" style="height:25px;">
               
            </div>

          
          <?php    $this->loginarea="admins";    $this->subtabsel="event_types";
             echo $this->renderElement('events_submenus');  ?>  
    </div></div>
<div class="boxBor1">
    <div class="boxPad">
        <div class="" height="300">
             <div id="addprjtype" class="centePage">     
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

					<table	width="30%" cellpadding="1" cellspacing="1" >
						<tr>
							<td colspan='2'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('EventType.event_type', array('class' => 'errormsg'));  ?>
                           </td>
						</tr>
						<tr>
							<td style="vertical-align: top" >
								<table>
									<tr>
										<td align="right">
											<div class="updat">
												<label class="boldlabel">Event Type <span class="red">*</span>
												</label>
											</div>
										</td>
										<td>
											<span class="intpSpan">
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
												<span class="newtxtArea_bot"><?php echo $form->textarea("EventType.event_type_desp", array('id' => 'event_type_desp', 'div' => false, 'label' => '','cols' => '27', 'rows' => '4',"class" => "noBg",'style'=>'width:225px;'));?></span>
											</span>
										</td>
									</tr>
								</table>
							</td>
							<td style="vertical-align: top">
								<table width="50%">
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
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="top-bar">
									<?php  echo $this->renderElement('bottom_message');  ?>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2"></td>
						</tr>
					</table>


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

