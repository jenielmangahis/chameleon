<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
?>

<?php  echo $javascript->link('ckeditor/ckeditor'); ?>
<!-- Body Panel starts -->
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">	
<?php echo $form->create("Admins", array("action" => "loginterms",'name' => 'loginterms', 'id' => "loginterms")); 
echo $form->hidden("Term.id", array('id' => 'termid'));
?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>?projectdashboard')"><?php e($html->image('cancle.png')); ?></button>
<?php  echo $this->renderElement('new_slider');  ?>			
			</div>    
<span class="titlTxt1"><?php echo $project_name;  ?>&nbsp;</span>    
<span class="titlTxt">
Terms &amp; Privacy
</span>
<div class="topTabs" style="height:25px;">
<?php /*?><ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>?projectdashboard')"><span> Cancel</span></button></li>
</ul><?php */?>
</div>
<!--
<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
     <div style="height: 30px; clear:both;">
     <div id="tab-container-1">
         <ul id="tab-container-1-nav" class="topTabs2">
        <li><a href="/admins/settingthemes" ><span>Themes</span></a></li>
            <li><a href="/admins/settings"><span>Settings</span></a></li>
            <li><a href="/admins/loginterms"  class="tabSelt"><span>Terms &amp; Privacy</span></a></li>
            < ?php if($project['Project']['url']!="" || $project['Project']['url']!=null ) {?> <li><a href="/admins/iframes"><span>iFrames</span></a></li>  < ?php } ?>
            <li><a href="/admins/projectcontrols" ><span>Controls</span></a></li>       
            <li><a href="/admins/change_password"><span>Change Password</span></a></li>
           </ul>
</div> </div>
<div class="clear"></div>  -->
    <?php    $this->loginarea="admins";    $this->subtabsel="loginterms";
                    echo $this->renderElement('setup_submenus');  ?> 
</div></div>
<div class="midPadd" id="logintab">
 <!-- <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
<div>	



			 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<!-- <div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">-->
    
   </div>
		<table cellspacing="5" cellpadding="0" align="center" width="100%">
		  <tbody>
			<?php
				
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
		      <td width="100%" colspan=2 style="vertical-align:top" ><!--<label class="boldlabel">Content: <span style="color: red;">*</span></label>-->
			<?php //echo $form->textarea("Term.termscontent", array('id' => 'termscontent', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>
			<?php	
						/*echo $form->create('Term');  
						echo $form->input('termscontent', array('cols' => '50', 'rows' => '100','label'=>false,'div'=>false,'class'=>'contactInput','style'=>"width:400px")); 
						echo $fck->load('Term/termscontent','540','600'); 
						echo $form->input('id', array('type'=>'hidden'));*/
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
		      <td width="100%" colspan=2 style="vertical-align:top"><!--<label class="boldlabel">Content: <span style="color: red;">*</span></label>-->
		      <?php //echo $form->textarea("Term.privacycontent", array('id' => 'privacycontent', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>
<?php	
					
						echo $form->textarea('Term.privacycontent', array('id'=>'privacycontent','class'=>'ckeditor'));					
						
				?>
			</td>
		    </tr>	
		    <tr><td colspan="2">&nbsp;</td></tr>
    		<tr>
    		 <td colspan='5' style="border-left: 0px none; text-align: left; padding-top: 5px; " class="top-bar">
 
   </td>

    		 </tr>	
		</tbody>
		</table>
	
		<?php echo $form->end();?><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>
</div></div> </div>
 
<!--inner-container ends here-->

<div></div>
  
<div class="clear"></div>

  <!-- Body Panel ends --> 
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("logintab").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
