<?php 
echo $javascript->link('ckeditor/ckeditor'); 
 ?>

<!-- Body Panel starts -->
    <div class="titlCont">
<div align="center" class="slider" id="toppanel">
	<div id="panel">
			<div class="content clearfix">
				<H1> Help</h1>
				<p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
							</div>
			
	</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li id="toggle">
            <a id="open" class="open" href="#."><span>Click Here to Open Help Box</span></a>

				<a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>		
			</li>
		</ul> 
	</div>



</div>
<?php echo $form->create("Company", array("action" => "editmailcontent",'name' => 'editmailcontent', 'id' => "editmailcontent","onsubmit" =>"return validatemailcontent('edit');")); ?>
<span class="titlTxt">
Edit Template
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/mailtemplatelist')"><span> Cancel</span></button></li>
</ul>
</div>

<div class="topTabs">
<ul>

</ul>
</div>
</div>
<div class="midPadd">
	<div class="boxBor1">
  		
	 	<div class="tblData">
		 
		<table cellspacing="10" cellpadding="0" align="center" width="815px">
		  <tbody>
		    <tr>
		      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); }
		      				echo $form->error('EmailTemplate.email_template_name', array('class' => 'errormsg'));
      				    	 	echo $form->error('EmailTemplate.content', array('class' => 'errormsg'));
						echo $form->hidden("EmailTemplate.id", array('id' => 'templateid'));
 						echo $form->error('EmailTemplate.sender', array('class' => 'errormsg'));
		      		?></td>
		    </tr>
		    <?php if($isreadonly=='1'){ ?>
		    <tr>
			 <td width="15%"><label class="boldlabel">Template Name: <span class="red">*</span></label></td>
                                    <td width="85%"><span class="intpSpan"><?php echo $form->input("email_template_name", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    <?php }else{ ?>
		    <tr>
		     <td width="15%"><label class="boldlabel">Template Name: </label></td>
		     <td width="85%"><?php echo $this->data['EmailTemplate']['email_template_name']; ?></td>
		    </tr>
		    <?php } ?>
		    <tr>
		     <td width="15%"><label class="boldlabel">Subject: <span class="red">*</span></label></td>
		     <td width="85%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
			 <tr>
		     <td width="15%"><label class="boldlabel">Sender: <span class="red">*</span></label></td>
		     <td width="85%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    <tr>
		      <td width="15%" style="vertical-align:top"><label class="boldlabel">Content: </label></td>	
		      <td width="85%">
			<?php //echo $form->textarea("EmailTemplate.content", array('id' => 'content', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>
			<?php	
						/*echo $form->create('EmailTemplate');  
						echo $form->input('content', array('cols' => '50', 'rows' => '100','size'=>'200','label'=>false,'div'=>false,'class'=>'contactInput','style'=>"width:400px")); 
						echo $fck->load('EmailTemplate/content','550','600'); 
						echo $form->input('id', array('type'=>'hidden'));*/						
						echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));
			?>
			</td>
		    </tr>	
		   	
		    <tr><td colspan="2">&nbsp;</td></tr>
    		<tr>
    		<td >&nbsp;</td>
    		<td >
    		<!--	 <button type="submit" id="Submit" class="button"><span>  Save</span>  </button>&nbsp;
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/mailtemplatelist')"><span> Cancel</span></button>-->
    		 </td>
    		 </tr>	
		</tbody>
		</table>
	
		<?php echo $form->end();?>
<div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
    <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
   </div>

</div></div> </div>
 
<!--inner-container ends here-->

  
<div class="clear"></div>
  <!-- Body Panel ends -->
	<?php echo $form->end();?>

<div class="clear"></div> 



