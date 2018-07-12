<?php ?><div class="titlCont">
<div style="width:960px; margin:0 auto; height:330px">

<div align="center" id="toppanel" >
	 <?php  echo $this->renderElement('new_slider');  ?>



</div>


<span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>
<span class="titlTxt">
Sponsor
</span>
	<?php echo $form->create("Admin", array("action" => "projectuser",'type' => 'file','enctype'=>'multipart/form-data','name' => 'projectuser', 'id' => "projectuser"))?>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/editprojectdtl')"><span> Cancel</span></button></li>
</ul>
</div>





<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear:both;">

<div id="tab-container-1">
	<ul id="tab-container-1-nav" class="topTabs2">
		<?php if(isset($project['Project']['sponsor_id']) && $project['Project']['sponsor_id'] > 0) {?>
        	<li><a href="/admins/editprojectdtl"><span>Details</span></a></li>
		<li><a href="/admins/coinsetlist"><span>Coinsets</span></a></li>
        	<!--<li><a href="/admins/projectimages"><span>Images</span></a></li>
		<li><a href="/admins/projecttracking"><span>Tracking</span></a></li>-->
		<?php } ?>
		<li><a href="/admins/projectsponsor"><span>Sponsor</span></a></li>
		<?php if(isset($project['Project']['sponsor_id']) && $project['Project']['sponsor_id'] > 0) {?>
		<li><a href="/admins/companylist"><span>Companies</span></a></li>
		<li><a href="/admins/contactlist"><span>Contacts</span></a></li>
		<li><a href="/admins/projectcontrols"><span>Controls</span></a></li>		
		<li><a href="/admins/projectuser" class="tabSelt"><span>User</span></a></li>
		<li><a href="/admins/change_password"><span>Change Password</span></a></li>
		<li><a href="/admins/getstart"><span>Get Started</span></a></li>      
		<?php } ?>
    </ul>
</div>   </div>


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?> 	
    <div id="Sponsor">

		

    <div class="left" style="min-height:300px">
    
   		<table cellspacing="1" cellpadding="1" align="center" width="500px">

			<?php echo $form->hidden("User.id") ?>
				<?php if($session->check('Message.flash')){ ?> 
			<tr><td colspan="3" align="center">
					<?php $session->flash(); ?> 
			</td>
			</tr>
			<tr><td colspan="3" align="center">&nbsp;</td></tr>
			<?php } ?>
			<tr>
				<?php if($userid) { ?>
				<td width="" align="right" width="15%"><label class="boldlabel">User name </label></td>
				<td width=""><label for="project_name"></label>
					<?php echo $form->hidden("User.id") ?>
					<span class="intpSpan"><?php echo $form->input("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150","readonly"=>"readonly"));?></span></td>
				<?php }else{ ?>
				<td width="" align="right"><label class="boldlabel">User name </label></td>
				<td width=""><label for="project_name"></label>
				<span class="intpSpan"><?php echo $form->input("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
				<?php }?>
				
			</tr>
				
			<tr>
				<?php if($userid) { ?>
				<td width="" align="right"><label class="boldlabel">Password </label></td>
				<?php }else{ ?>
				<td width="" align="right"><label class="boldlabel">Password <span style="color:red">*</span></label></td>
				<?php }?>
				<td width=""><label for="project_name"></label>
					<span class="intpSpan"><?php echo $form->password("User.password", array('id' => 'password', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150",'value'=>'password'));?></span></td>
				
			</tr>
			
			
		</table>
    
    

    
    
    </div>
    
   
    </div>
    
    <?php echo $form->end();?>
</div>



  <div class="clear"></div>
 <script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("Sponsor").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>