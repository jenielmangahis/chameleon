<?php ?><!--container starts here-->
<div class="titlCont1"><div style="width:960px; margin:0 auto;">
<div align="center" class="slider" id="toppanel">
	 <?php  //echo $this->renderElement('new_slider');  ?>


</div>
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important;">			
<?php
e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));

?>			
</div>

<?php echo $form->create("Admins", array("action" => "actioncomment/$recordid/$coin_holder_id",'type' => 'file','name' => 'actioncomment', 'id' => "actioncomment"))?>
 <?php  echo $this->renderElement('project_name');  ?>
<span class="titlTxt">
Comment Detail
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/viewcomments/<?php echo $coin_holder_id; ?>')"><span> Cancel</span></button></li>
</ul>
</div>

</div></div>

<!--inner-container starts here--><div class="rightpanel">

<div class="midPadd">
		<div class="">

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

		 
			<table cellspacing="10" cellpadding="0" align="center" width="815px">
  <tbody>
    <tr>
      <td colspan="5"><?php if($session->check('Message.flash')){ $session->flash(); } 
      				 echo $form->hidden("Comment.id", array('id' => 'commentid'));
      				 echo $form->hidden("emailid", array('id' => 'emailid'));
      				 echo $form->hidden("nameemailid", array('id' => 'nameemailid'));
      				 echo $form->error('Comment.comment', array('class' => 'errormsg'));
      	?></td>
    </tr>
    <tr>
      <td width="20%" align="right" class="lbltxtarea"><label class="boldlabel">Serial #</label></td>
      <td width="30%"><label for="project_name"></label><span class="intpSpan">
        <?php echo $form->input("Comment.serial", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly' , 'value'=>$coinserialnumber));?></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
   <?php if($commenttypename!=""){?>
      <tr>
      <td width="20%" align="right"><label class="boldlabel">Type</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $commenttypename; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
<?php }?>
<?php if($commenttypepurpose!=""){?>
 <tr>
      <td width="20%" align="right" class="lbltxtarea"><label class="boldlabel">Description</label></td>
      <td width="30%" style="padding:5px 0 5px 0;"><label for="project_name"></label>
        <?php echo $commenttypepurpose; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
<?php }?>
    <tr>
      <td width="20%" align="right" class="lbltxtarea"><label class="boldlabel">Comment <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label><span class="socialtxttop">
<span class="socialSpan">
        <?php echo $form->input("Comment.comment", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'10','cols'=>'50', 'style' => 'width:515px;'));?></span></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Verified</label></td>
      <td width="30%"><label for="project_name"></label>
       <?php echo $form->input('Comment.active_status', array('type'=>'checkbox', 'label' => '')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Offensive</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input('Comment.offensive', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Locked</label></td>
      <td width="30%"><label for="project_name"></label>
         <?php echo $form->input('Comment.locked', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
  
    <tr><td colspan='5'>&nbsp;</td></tr>

  </tbody>
</table>
		
<div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
</div><br>
		<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>
