<!--container starts here-->
<div class="container">

<!--rightpanel starts here--><div class="leftpanel">

<?php echo $this->renderElement('new_admin_leftpanel'); ?>

</div><!--rightpanel ends here-->
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
				        width : 600,
				        height : 300
				});
				</script>

<!--inner-container starts here--><div class="rightpanel">

<div id="center-column">
	<div class="top-bar" style="border-left:0px;">
		<h1> Sponsor Description </h1>
		<b>Any item with a  "<span style="color:red">*</span>"  requires an entry.</b>
		</div><br />
		
		<div class="left">
		<?php echo $form->create("Admins", array("action" => "editsponsordesc",'name' => 'editsponsordesc', 'id' => "editsponsordesc",'onsubmit'=>'return validatesponsordescription();')); ?>
		<table cellspacing="10" cellpadding="0" align="center" width="815px">
		  <tbody>
		    <tr>
		      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); }
					 echo $form->hidden("Sponsor.id", array('id' => 'sponsorid'));
		      		?></td>
		    </tr>
		    <tr>
		      <td colspan='2'><h1> Short: </h1></td>
		      <td >&nbsp;</td>
		    </tr>	
		    <tr>
		      <td width="10%"><label class="boldlabel">Title: <span style="color:red">*</span></label></td>
		     <td width="90%"><?php echo $form->input("Sponsor.titleshortdescription", array('id' => 'titleshortdescription', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "contactInput","maxlength" => "250"));?></td>
		    </tr>
		    <tr>
		      <td width="10%"  valign='top'><label class="boldlabel">Content: </label></td>	
		      <td width="90%">
			<?php echo $form->textarea("Sponsor.infoshort", array('id' => 'infoshort', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>

			</td>
		    </tr>	
		    
		    
		    <tr>
		      <td ><h1> Long: </h1></td>
		    </tr>	
		    <tr>
		      <td width="10%"><label class="boldlabel">Title: <span style="color:red">*</span></label></td>
		     <td  width="90%">
		    	<?php echo $form->input("Sponsor.titlelongdescription", array('id' => 'titlelongdescription', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "contactInput","maxlength" => "250"));?></td></tr>
		     <tr>
		     <tr>
		      <td width="10%"  valign='top'><label class="boldlabel">Content: </label></td>	
		      <td width="90%">
		      <?php echo $form->textarea("Sponsor.infolong", array('id' => 'infolong', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>
			</td>
		    </tr>	
		    <tr><td colspan="2">&nbsp;</td></tr>
    		<tr>
    		<td >&nbsp;</td>
    		<td >
    			 <button type="submit" id="Submit" class="button">  Save  </button>&nbsp;
    			 <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/index')">Cancel</button>&nbsp;
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/editsponsordtl')"> Sponsor Detail Page </button>&nbsp;
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/editprojectdtl')">  Project Detail </button>
    		 </td>
    		 </tr>	
		</tbody>
		</table>
	
		<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>


</div><!--container ends here-->
