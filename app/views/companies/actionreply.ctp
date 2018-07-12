<?php $lgrt = $session->read('newsortingby');?>
<?php ?><!--container starts here-->
<div class="titlCont1"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php 
App::import("Model", "HelpContent");
		$this->HelpContent =  & new HelpContent();
		$condition = "HelpContent.id = '35'";  
		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
		$this->set("hlpdata",$hlpdata);

 echo $this->renderElement('new_slider');  ?>

</div>
<?php echo $form->create("Company", array("action" => "actionreply",'type' => 'file','name' => 'actionreply', 'id' => "actionreply"))?>
<span class="titlTxt">
Comment Reply Detail 
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
<div class="rightpanel">
<div class="midPadd" >
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

		 
			<table cellspacing="10" cellpadding="0" align="center" width="815px">
  <tbody>
    <tr>
      <td colspan="5"><?php if($session->check('Message.flash')){ $session->flash(); } 
      				 echo $form->hidden("Subcomment.id", array('id' => 'commentid'));
      				 echo $form->error('Subcomment.comment', array('class' => 'errormsg'));
      	?></td>
    </tr>
    <tr>
      <td width="20%" align="right" class="lbltxtarea"><label class="boldlabel">Serial #</label>&nbsp;</td>
      <td width="30%"><span class="intpSpan">
        <?php echo $form->input("serial", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>

      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>




	<tr>
      <td width="20%" align="right" class="lbltxtarea"><label class="boldlabel">Comment</label>&nbsp</td>
      <td width="30%">
<span class="socialtxttop">
<span class="socialSpan">
        <?php echo $form->input("Comment.comment", array('id' => 'repcomment', 'div' => false, 'label' => '',"class" => "multilist","maxlength" => "200",'readonly'=>'readonly','rows'=>'6','cols'=>'55', 'style' => 'width:515px;'));?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>


    <tr>
      <td width="20%" align="right" class="lbltxtarea"><label class="boldlabel">Reply <span class="red">*</span></label></td>
      <td width="30%">
<span class="socialtxttop">
<span class="socialSpan">
        <?php echo $form->input("Subcomment.comment", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'8','cols'=>'55', 'style' => 'width:515px;'));?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>    
     <tr>
      <td width="20%" align="right"><label class="boldlabel" for="active_status">Verified</label>&nbsp;</td>
      <td width="30%">
       <?php echo $form->input('Subcomment.active_status', array('type'=>'checkbox', 'label' => '', 'id' => 'active_status')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
 
  </tbody>
</table>
		
                            <div class="top-bar" style="text-align: left;  padding: 20px 5px 5px 60px; ">
 <?php  echo $this->renderElement('bottom_message');  ?>                                </div>
		<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				<br />
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newacttab").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>                        
