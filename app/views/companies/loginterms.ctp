<?php //echo $javascript->link('tiny_mce/tiny_mce.js'); ?>
<?php //echo $javascript->link('tiny_mce/tiny_mce_src.js'); 
 echo $javascript->link('ckeditor/ckeditor'); 
?>
<script type="text/javascript">
			
				</script>

<!-- Body Panel starts -->
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>



</div>
<?php echo $form->create("Company", array("action" => "loginterms",'name' => 'loginterms', 'id' => "loginterms")); ?>
<span class="titlTxt">
Terms &amp; Privacy
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/dashboard')"><span> Cancel</span></button></li>
</ul>
</div>

<!--<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both;">
<ul class="topTabs2">

<li><a href="/companies/settingthemes"><span>Themes</span></a></li>
<li><a href="/companies/settings"><span>Settings</span></a></li>
<li><a href="/companies/loginterms"  class="tabSelt"><span>Terms &amp; Privacy</span></a></li>
< ?php if($project['Project']['url']!="" || $project['Project']['url']!=null ) {?> <li><a href="/companies/iframes"><span>iFrames</span></a></li>  < ?php } ?>
<li><a href="/companies/projectcontrols"><span>Controls</span></a></li>
<li><a href="/companies/change_password" ><span>Change Password</span></a></li>     
</ul>
</div>
<div class="clear"></div> -->
  <?php  $this->loginarea="companies";    
        $this->subtabsel="loginterms";
        echo $this->renderElement('setup_submenus');  ?> 
</div></div>

<div class="midPadd" id="newlgntrm">
 <!-- <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
<div class="">	
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

		<table cellspacing="10" cellpadding="0" align="center" width="100%">
		  <tbody>
			<?php
				echo $form->hidden("Term.id", array('id' => 'termid'));
			 if($session->check('Message.flash')){ ?> 
			<tr><td colspan="2" align="center">
					<?php $session->flash(); ?> 
			</td>
			</tr>
			<tr><td colspan="2" align="center">&nbsp;</td></tr>
			<?php } ?>
		  
		    <tr>
		      <td colspan='2'><b> Terms </b></td>

		    </tr>





	
		    <tr>
		     <td width="10%" align="right"><label class="boldlabel">Title <span style="color: red;">*</span></label></td>
		     <td width="90%"><span class="intpSpan"><?php echo $form->input("Term.termstitle", array('id' => 'termstitle', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    <tr>
		           <td colspan=2 >
			<?php 
						echo $form->textarea('Term.termscontent', array('id'=>'termscontent','class'=>'ckeditor'));						
						
				?>
			</td>
		    </tr>	
		    
		    
		    <tr>
		      <td ><b> Privacy </b></td>
		    </tr>	
		    <tr>
		     <td width="10%" align="right"><label class="boldlabel">Title <span style="color: red;">*</span></label></td>
		     <td  width="90%"><span class="intpSpan">
		    	<?php echo $form->input("Term.privacytitle", array('id' => 'privacytitle', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td></tr>
		     <tr>
		      <td colspan=2 >
		      <?php 
						echo $form->textarea('Term.privacycontent', array('id'=>'privacycontent','class'=>'ckeditor'));					
						
				?>
			</td>
		    </tr>	
		    <tr><td colspan="2">&nbsp;</td></tr>
    		<tr>
    		 <td colspan='5' style="border-left: 0px none; text-align: left; padding-top: 5px; " class="top-bar">
                 <?php  echo $this->renderElement('bottom_message');  ?>

   </td>

    		 </tr>	
		</tbody>
		</table>
	
		<?php echo $form->end();?>
</div></div> </div>
 
<!--inner-container ends here-->

<div></div>
  
<div class="clear"></div>

  <!-- Body Panel ends --> 
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newlgntrm").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
