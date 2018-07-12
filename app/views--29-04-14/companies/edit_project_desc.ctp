<?php echo $javascript->link('tiny_mce/tiny_mce.js'); ?>
<?php echo $javascript->link('tiny_mce/tiny_mce_src.js'); ?>

<script type="text/javascript">
				tinyMCE.init({
				        // General options
				        mode : "textareas",
				        theme : "advanced",
				        plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
				
				        // Theme options
				        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,forecolor",
				        theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,code,|,insertdate,inserttime,preview,backcolor,advhr,|,print,|fullscreen",
				        theme_advanced_buttons3 : "",
				        theme_advanced_buttons4 : "",
				        theme_advanced_toolbar_location : "top",
				        theme_advanced_toolbar_align : "left",
				        theme_advanced_statusbar_location : "bottom",
				        theme_advanced_resizing : true,
				        width : 500,
				        height : 300
				});
				</script> 

<!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p>
  <div class="boxBor">
  <div class="boxPad">
  <?php echo $this->element("leftmenubar");?>  


    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
 <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg1">
  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    <h2>Edit Project Description </h2>
<b>Any item with a</b>"<span class="red">*</span>"<b>requires an entry.</b>  

		
<?php echo $form->create("Company", array("action" => "edit_project_desc",'name' => 'edit_project_desc', 'id' => "edit_project_desc",'onsubmit'=>'return validateprojectdetail("editdesc")')); ?>

		<table cellspacing="10" cellpadding="0" align="left" width="100%">
		  <tbody>
		    <tr>
		      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } ?></td>
		    </tr>
		    <tr>
		      <td colspan='2'><label class="boldlabel"> Short: </label></td>
		      <td >&nbsp;</td>
		    </tr>	
		    <tr>
		     <td width="10%"><label class="boldlabel">Title: <span class="red">*</span></label></td>
		     <td width="90%"><?php echo $form->input("Project.titleshortdescription", array('id' => 'titleshortdescription', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inptBox","maxlength" => "250"));?></td>
		    </tr>
		    <tr>
		      <td width="10%" valign='top'><label class="boldlabel">Content: </label></td>	
		      <td width="90%">
			<?php echo $form->textarea("Project.descriptionshort", array('id' => 'descriptionshort', 'div' => false, 'label' => '','cols' => '20', 'rows' => '4',"class" => "contactInput"));?>

			</td>
		    </tr>	
		    
		    
		    <tr>
		      <td > <label class="boldlabel">Long: </label></td>
		    </tr>	
		    <tr>
		     <td width="10%"><label class="boldlabel">Title: <span class="red">*</span></label></td>
		     <td  width="90%">
		    	<?php echo $form->input("Project.titlelongdescription", array('id' => 'titlelongdescription', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inptBox","maxlength" => "250"));?></td></tr>
		     <tr>
		      <td width="10%" valign='top'><label class="boldlabel">Content: </label></td>	
		      <td width="90%">
		      <?php echo $form->textarea("Project.descriptionlong", array('id' => 'descriptionlong', 'div' => false, 'label' => '','cols' => '20', 'rows' => '4',"class" => "contactInput"));?>
			</td>
		    </tr>	
		    <tr><td colspan="2">&nbsp;</td></tr>
    		<tr>
    		<td >&nbsp;</td>
    		<td >
    			 <button type="submit" id="Submit" class="btn">  Save  </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button>&nbsp;
    		     <button type="button" id="saveForm" class="btn"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"> Go to Project Detail Page</button>
    		 </td>
    		 </tr>	
		</tbody>
		</table>
	
		<?php echo $form->end();?>
<div class="clear"></div>
  </div>
  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 


