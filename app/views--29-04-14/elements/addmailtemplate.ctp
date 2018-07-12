<?php 
 echo $javascript->link('ckeditor/ckeditor'); 
 echo $form->create("Company", array("action" => "addmailtemplate",'name' => 'addmailtemplate', 'id' => "addmailtemplate","onsubmit"=>"return validatemailcontent('add');")); ?>
<!-- Body Panel starts -->
   <div class="titlCont">
<div align="center" id="toppanel" style="left:0;">
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

<span class="titlTxt">
Add New Template
</span>


<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/mailtemplatelist')"><span> Cancel</span></button></li>
</ul>
</div>
</div>
<div class="midPadd">

	<br />

  <div class="boxBor1">
  		
	 	<div class="">	


		
		<table cellspacing="10" cellpadding="0" align="center" width="815px">
		  <tbody>
		    <tr>
		      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } 
		      			echo $form->error('EmailTemplate.email_template_name', array('class' => 'errormsg'));
      				    echo $form->error('EmailTemplate.content', array('class' => 'errormsg'));
 				echo $form->error('EmailTemplate.sender', array('class' => 'errormsg'));
		      		?></td>
		    </tr>
		    <tr>
		     <td width="15%"><label class="boldlabel">Template Name: <span class="red">*</span></label></td>
                                    <td width="85%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.email_template_name", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		   
		    <tr>
		     <td width="15%"><label class="boldlabel">Subject: <span class="red">*</span></label></td>
		     <td width="85%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		   <tr>
		     <td width="15%"><label class="boldlabel">Sender: <span class="red">*</span></label></td>
		     <td width="85%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    <tr>
		      <td width="15%" style="vertical-align:top;"><label class="boldlabel">Content: </label></td>	
		      <td width="85%">
			<?php //echo $form->textarea("EmailTemplate.content", array('id' => 'content', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inpt_txt_fld"));?>
			<?php	
						/*echo $form->create('EmailTemplate');  
						echo $form->input('content', array('cols' => '100', 'rows' => '100','label'=>false,'div'=>false,'class'=>'inpt_txt_fld','style'=>"width:400px")); 
						echo $fck->load('EmailTemplate/content','490','600'); 
						echo $form->input('id', array('type'=>'hidden'));*/						
						echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));
			?>

			</td>
		    </tr>	
		   	
		    <tr><td colspan="2">&nbsp;</td></tr>
    		
		</tbody>
		</table>
	<div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
    <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
   </div>

</div></div> </div>
 
<!--inner-container ends here-->

  
<div class="clear"></div>
  <!-- Body Panel ends -->
	<?php echo $form->end();?>

<div class="clear"></div> 



