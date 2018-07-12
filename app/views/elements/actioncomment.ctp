<?php ?><!--container starts here-->
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
<?php echo $form->create("Company", array("action" => "actioncomment/$recordid/$coin_holder_id",'type' => 'file','name' => 'actioncomment', 'id' => "actioncomment"))?>
<span class="titlTxt">
Comment Detail
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/viewcomments/<?php echo $coin_holder_id; ?>')"><span> Cancel</span></button></li>
</ul>
</div>

</div>

<!--inner-container starts here--><div class="rightpanel">

<div class="midPadd">
		<div class="">
		 
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
      <td width="20%"><label class="boldlabel">Serial #:</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("serial", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "200",'readonly'=>'readonly'));?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
   <?php if($commenttypename!=""){?>
      <tr>
      <td width="20%"><label class="boldlabel">Type:</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $commenttypename; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
<?php }?>
<?php if($commenttypepurpose!=""){?>
 <tr>
      <td width="20%" valign="top"><label class="boldlabel">Description:</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $commenttypepurpose; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
<?php }?>
    <tr>
      <td width="20%"  valign='top'><label class="boldlabel">Comment: *</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input("Comment.comment", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "contactInput",'rows'=>'15','cols'=>'50'));?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%"><label class="boldlabel">Verified:</label></td>
      <td width="30%"><label for="project_name"></label>
       <?php echo $form->input('Comment.active_status', array('type'=>'checkbox', 'label' => '')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%"><label class="boldlabel">Offensive:</label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input('Comment.offensive', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%"><label class="boldlabel">Locked:</label></td>
      <td width="30%"><label for="project_name"></label>
         <?php echo $form->input('Comment.locked', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
  
    <tr><td colspan='5'>&nbsp;</td></tr>
    <tr><td colspan='5'>
  
    			 <button type="submit" id="Submit" class="btn">  Save  </button>&nbsp;		
    			 <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/registercoinlist')"> Cancel </button>&nbsp;
    		     <button type="button" id="button" class="btn" onClick="history.go(-1);return true;">  Back  </button>&nbsp;
    		 
	</td></tr>
  </tbody>
</table>
		
                            <div class="top-bar" style="text-align: left; padding-top: 5px; ">
                            <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
                            </div>
		<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>