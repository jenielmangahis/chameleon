<?php echo $form->create('CoinsHolder',array('action'=>'/companies/register_coin','id'=>'','url'=>$this->here));
$coinHolder = $this->params['pass'][0];
?>
<div class="titlCont1"><div style="width:960px; margin:0 auto;">
  <div align="center" id="toppanel" >
     <?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt1"><?php //echo $data['Project']['project_name'];?>&nbsp;</span>
<span class="titlTxt">Register Coin</span>
    <div class="topTabs">
	  <ul>
		<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/editholder/<?php echo $coinHolder;?>')"><span> Cancel</span></button></li>
	  </ul>
	</div>
  </div>
</div>
<div class="top-bar" style="border-left:0px;"></div><br />
<div class="midPadd">
  <div class="" style="height:220px;">
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
  <div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">
  </div>
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->
  <table width="450px" align="center" cellpadding="1" cellspacing="1">
	  <tr>
		<td colspan='3'>
		  <?php if($session->check('Message.flash')){ $session->flash(); }
			echo $form->error('CommentType.comment_type_name', array('class' => 'errormsg'));?>
		</td>
	  </tr>
	  <tr>
		<td align="right" class="lbltxtarea">
		  <lable class='boldlabel'>Coin Serial #<span class="red"> *</span>
		  </lable><span class="intpSpan" style = "vertical-align: middle;"><?php echo $form->input('coinserial',array('label'=>'','div'=>false,'type'=>"text", 'id'=>"coinserial",'size'=>'40','maxlength'=>'10', 'class'=>'inpt_txt_fld', 'style'=>'vertical-align: bottom;')) ?></span>
		 </td>
	  </tr>
	  <tr>
		<td class="lbltxtarea" align="right"><lable class='boldlabel' style=" width: 115px; margin-left: -34px;">Verification Code<span class="red"> *</span></lable>
		<span class="intpSpan" style="vertical-align:middle;"> <?php echo $form->input('code',array('label'=>'','div'=>false,'type'=>"text", 'id'=>"code",'size'=>'40','maxlength'=>'3', 'class'=>'inpt_txt_fld' )) ?></span></td>
	  </tr>
	       <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
      <tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	    </table>


<?php echo $form->end();?>


					
					<!-- ADD Sub Admin  FORM EOF -->

			</div>
<div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>
</div><!--inner-container ends here-->
</div><!--container ends here-->

 <div class="clear"></div>
