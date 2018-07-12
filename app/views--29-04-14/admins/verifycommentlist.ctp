<?php $lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'commentlist';
?><?php ?><!--container starts here-->
<div class="titlCont1"><div class="myclass">
<div align="center" class="slider" id="toppanel">
         <?php  echo $this->renderElement('new_slider');  ?>



</div>
<?php echo $form->create("Admins", array("action" => "verifycommentlist",'type' => 'file','enctype'=>'multipart/form-data','name' => 'verifycommentlist', 'id' => "verifycommentlist"))?>

 <?php  echo $this->renderElement('project_name');  ?>
<span class="titlTxt"> Comment Detail
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
</ul>
</div>

</div></div>

<!--inner-container starts here--><div class="rightpanel">

<div class="midPadd">
                <div class="">
                 
                        <table cellspacing="10" cellpadding="0" align="center" width="815px">
  <tbody>
    <tr>
      <td colspan="5" align="right"><?php if($session->check('Message.flash')){ $session->flash(); } 
                                 echo $form->hidden("Comment.id", array('id' => 'commentid'));
                                 echo $form->hidden("emailid", array('id' => 'emailid'));
                                 echo $form->hidden("nameemailid", array('id' => 'nameemailid'));
                                 echo $form->error('Comment.comment', array('class' => 'errormsg'));
        ?></td>
    </tr>
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Serial # </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
       <span class="intpSpan"> <?php echo $form->input("serial", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    <?php if($commenttypename!=""){?>
    <tr>
      <td width="20%" align="right"><label class="boldlabel">Type </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $commenttypename; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
<?php }?>
<?php if($commenttypepurpose!=""){?>
 <tr>
      <td width="20%" valign="top" align="right"><label class="boldlabel">Description </label></td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $commenttypepurpose; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
<?php }?>
    <tr>
      <td width="20%"  valign='top' align="right"><label class="boldlabel">Comment <span class="red">*</span></label></td>
      <td width="30%"><label for="project_name"></label>
        <span class="socialtxttop"><span class="socialSpan"><?php echo $form->input("Comment.comment", array('id' => 'serial', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'8','cols'=>'50','style'=> 'width:515px;'));?></span></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Verified </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
       <?php echo $form->input('Comment.active_status', array('type'=>'checkbox', 'label' => '')); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%" align="right"><label class="boldlabel">Offensive </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
        <?php echo $form->input('Comment.offensive', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    
     <tr>
      <td width="20%"  align="right"><label class="boldlabel">Locked </label>&nbsp;</td>
      <td width="30%"><label for="project_name"></label>
         <?php echo $form->input('Comment.locked', array('type'=>'checkbox', 'label' => '')); ?></td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
  
   
  </tbody>
</table>
                
                            <div class="top-bar" style="text-align: left; padding:  15px 5px 5px 50px; ">
                                <?php  echo $this->renderElement('bottom_message');  ?>
                            </div>
                <?php echo $form->end();?>
                                        
                        <br />          <!-- ADD Sub Admin  FORM EOF -->

                                
                        </div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>
