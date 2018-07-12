<?php $lgrt = $session->read('newsortingby');?>
<?php ?><!--container starts here-->
<div class="titlCont1"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php
App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '48'";//'34'";  
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);

  echo $this->renderElement('new_slider');  ?>



</div>
<?php echo $form->create("Company", array("action" => "verifycommentlist",'type' => 'file','enctype'=>'multipart/form-data','name' => 'verifycommentlist', 'id' => "verifycommentlist"))?>
<?php 				echo $form->hidden("Comment.id", array('id' => 'commentid'));
      				 echo $form->hidden("emailid", array('id' => 'emailid'));
      				 echo $form->hidden("nameemailid", array('id' => 'nameemailid'));
?>
<span class="titlTxt">
Comment Detail
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/<?php echo $lgrt;?>')"><span> Cancel</span></button></li>
</ul>
</div>

</div></div>

<!--inner-container starts here-->
<div>

<div class="midPadd" id="vercomment">
		<div class="">

 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="" onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>

		 
<table cellspacing="5" cellpadding="0" align="center" width="815px" style="margin-top:-10px">
  <tbody>
     <?php if($session->check('Message.flash')){ ?>
   <tr>
      <td colspan="5"><?php  $session->flash();  
      				 
      				 echo $form->error('Comment.comment', array('class' => 'errormsg'));
      	?></td>
    </tr>
   <?php }?>	
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Serial #</label></td>
      <td width="30%">
       <span class="intpSpan"> <?php echo $form->input("serial", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    <?php if($commenttypename!=""){?>
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Type </label>&nbsp;</td>
      <td width="30%">
        <?php echo $commenttypename; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>Verified 
    </tr>
<?php }?>
<?php if($commenttypepurpose!=""){?>
 <tr>
      <td width="20%" valign="top" align="right"><label class="boldlabel">Description:</label>&nbsp;</td>
      <td width="30%">
        <?php echo $commenttypepurpose; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
<?php }?>
    <tr>
      <td width="20%"  valign='top' align="right"><label class="boldlabel">Comment <span class="red">*</span></label></td>
      <td width="30%">
        <span class="socialtxttop"><span class="socialSpan"><?php echo $form->input("Comment.comment", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'8','cols'=>'50','style'=> 'width:515px'));?></span></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Verified </label></td>
      <td width="30%">
       <?php echo $form->input('Comment.active_status', array('type'=>'checkbox', 'label' => '')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Offensive </label></td>
      <td width="30%">
        <?php echo $form->input('Comment.offensive', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Locked </label></td>
      <td width="30%">
         <?php echo $form->input('Comment.locked', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
  <tr>
      <td width="20%" align="right" colspan="5"></td>
      
    </tr>
   
  </tbody>
</table>
		
 <div class="top-bar" style="text-align: left; padding: 5px 5px 0 70px; ">
 <?php  echo $this->renderElement('bottom_message');  ?>                             </div>
		<?php echo $form->end();?>
					
			<br />		<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("vercomment").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>                        

