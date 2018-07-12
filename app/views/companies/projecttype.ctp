
<script type="text/javascript">

$(document).ready(function() {
 
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 

</script>
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container">


<!--rightpanel starts here--><div class="leftpanel">

 <?php echo $this->element("leftmenubar");?>  
</div><!--rightpanel ends here-->


<!--inner-container starts here--><div class="rightpanel">
<div id="center-column">
	<div class="top-bar" style="border-left:0px;">
		<h1> Project Types</h1>
		</div><br />
	<?php if($session->check('Message.flash')){ ?> 
	<div align="center"><?php $session->flash(); ?></div> <?php } ?>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
	
	<tr>
     <th align="left" valign="middle"><span class="right"><?php echo $pagination->sortBy('project_type_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Project Type</th>
     <th align="left" valign="middle">Note</th>
     <th align="left" valign="middle">Status</th>
 <th align="left" valign="middle">Edit</th>
	<th align="left" valign="middle">Delete</th>
      </tr>
   	<?php if($projecttypedata){ 
   			foreach($projecttypedata as $eachrow){
   			$recid = $eachrow['ProjectType']['id'];
   			$modelname = "ProjectType";
   			$redirectionurl = "projecttype";
   			$notetext = "";
   			if($eachrow['ProjectType']['notes']){
   				$notetext = AppController::WordLimiter($eachrow['ProjectType']['notes'],10);
   			}
   			
   		?>
   	<tr>	
		<td align="left" valign="middle"><?php echo $eachrow['ProjectType']['project_type_name']; ?></td>
		<td align="left" valign="middle"><?php echo $notetext?$notetext:"N/A"; ?></td>
		<td align="left" valign="middle"><?php if($eachrow['ProjectType']['active_status']=='1'){ ?><a href="/admins/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/active.gif" alt="" title="Click here to deactivate <?php echo $eachrow['ProjectType']['project_type_name']; ?>" /></a><?php }else{ ?><a href="/admins/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/deactive.gif" alt=""  title="Click here to activate <?php echo $eachrow['ProjectType']['project_type_name']; ?>" /></a><?php } ?></td>
		<td align="left" valign="middle"><a href="/admins/editprojecttype/<?php echo $recid; ?>"><img src="/img/edit.png" alt="" title="Click here to Edit <?php echo $eachrow['ProjectType']['project_type_name']; ?>" /></a></td>
        <td align="left" valign="middle"><a onclick="return delete_record();" href="/admins/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/delete'?>"><img src="/img/delete.png" alt="" title="Click here to delete <?php echo $eachrow['ProjectType']['project_type_name']; ?>" /></a></td>
		</tr>
	<?php } }else{ ?>
	<tr><td colspan="4" align="center">No Project Type Found.</td></tr>
	<?php } ?>
	</table>
	<?php if($projecttypedata) { echo $this->renderElement('pagination'); } ?>

</div>
</div><!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->

