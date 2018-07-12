<?php $lgrt = $session->read('newsortingby');
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'suggestedcomments';
?><?php ?>

<div class="titlCont">
<div style="width:960px;margin:0 auto">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:11px;right: -50px;width:545px !important; text-align:right;">	    
<?php echo $form->create("Admins", array("action" => "editcommenttype/$recid",'name' => 'editcommenttype', 'id' => "editcommenttype",'onsubmit' => 'return validatecommenttype("edit");'))?>
	   <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
		<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
		<button onclick="javascript:(window.location='<?php echo $backUrl;?>')" class="sendBut" id="saveForm" type="button"><?php e($html->image('cancle.png')); ?></button>
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php  echo $this->renderElement('project_name');  ?>
<span class="titlTxt">Edit Comment Type </span>
        <div class="topTabs">

        </div>
</div></div>
  <div class="top-bar" style="border-left:0px;">
        </div><br />
<div class="midPadd">
		<div style="height:300px;">

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
</div>
                                            <?php } ?>

<div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">
    
   </div>
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

		<table width="450px" align="left" cellpadding="1" cellspacing="10">
		
		<tr><td align="right" class="lbltxtarea"><label class="boldlabel">Comment Type<span class="red"> *</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("CommentType.comment_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
	        </tr>
		<tr><td class="lbltxtarea" align="right"><label class="boldlabel">Comment Type Purpose<span class="red"> &nbsp;</span></label></td>
				<td><span class="txtArea_top"><span class="newtxtArea_bot"><?php echo $form->input("CommentType.comment_type_purpose", array('id' => 'comment_type_purpose', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'5','cols'=>'26', 'style' => 'width:228px;'));?></span></span></td>
	        </tr>
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2"> <div class="top-bar" style="text-align: left; padding-top: 5px; ">
                            <?php  echo $this->renderElement('bottom_message');  ?>
 </div></td></tr>

	    </table>
<br>

<?php echo $form->end();?>


					
					<!-- ADD Sub Admin  FORM EOF -->

			</div>
</div><!--inner-container ends here-->

  







</div><!--container ends here-->

 <div class="clear"></div>

