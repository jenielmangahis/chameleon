<?php
	$base_url = Configure::read('App.base_url');
	$lgrt = $base_url.$session->read('newsortingby');?>
<?php 
$paging='';
$pagination->setPaging($paging); ?> 
<?php 
	echo $form->create("Companies", array("action" => "editcommenttype",'name' => 'editcommenttype', 'id' => "editcommenttype",'onsubmit' => 'return validatecommenttype("edit");'));
	echo $form->hidden("CommentType.id", array('id' => 'typeid'));
?>
 <!-- Body Panel starts -->

<div class="titlCont1">
<div style="width:960px; margin:0 auto;"><div align="center" id="toppanel" >
	 <?php
		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '50'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   
  echo $this->renderElement('new_slider');  ?>


</div>

<span class="titlTxt">
Edit Comment Type 
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $lgrt;?>')"><span> Cancel</span></button></li>
</ul>
</div>
</div>


</div>
</div>
<div style=" height:300px" class=""><br />

<div class="midPadd">

<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar">
    
   </div>
					<table width="450px" align="center" cellpadding="1" cellspacing="10" style="margin-top:-10px;">
					<tr>
						<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
											echo $form->error('CommentType.comment_type_name', array('class' => 'errormsg'));
										
									?></td>
					</tr>
					<tr><td align="right" class="lbltxtarea"><label class="boldlabel">Comment Type <span class="red">*</span></label></td>
							<td><span class="intpSpan"><?php echo $form->input("CommentType.comment_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></td>
					</tr>
					<tr><td class="lbltxtarea" align="right"><label class="boldlabel">Comment Type Purpose </label>&nbsp;</td>
							<td><span class="txtArea_top"><span class="newtxtArea_bot"><?php echo $form->input("CommentType.comment_type_purpose", array('id' => 'comment_type_purpose', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'5','cols'=>'26', 'style' => 'width:228px;'));?></span></span></td>
					</tr>
					<!-- ADD FIELD EOF -->  	
					<!-- BUTTON SECTION BOF -->  
				<tr><td colspan="2" align="right">&nbsp;</td></tr>

				</table>
				
				<?php echo $form->end();?>
		
				</div>
					<!-- ADD Sub Admin  FORM EOF -->

				<div class="top-bar" style="text-align: left;  padding: 20px 5px 5px 60px; ">
 <?php  echo $this->renderElement('bottom_message'); ?> </div><br>
			</div></div> </div>
				
 
<!--inner-container ends here-->

  
<div class="clear"></div>
