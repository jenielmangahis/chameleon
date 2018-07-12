<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
<script type="text/javascript">
$(document).ready(function()
{
			$('#checkall').bind('change',function(){
			var check = $(this).attr('checked')?1:0;
			if(check ==1)
			{
					$('.checkid').each(function()
					{
							$(this).attr('checked',true);

					});


			}else{

					$('.checkid').each(function()
					{
							$(this).attr('checked',false);

					});
			}		

	})

});
$(document).ready(function()
{   
	$('.checkid').bind('change',function()
	{   
		//event.stopPropagation();
		var i=0;
		var j=0;
		$('.checkid').each(function(){
			i++;
			var check = $(this).attr('checked')?1:0;
			if(check ==1)
			{			
				j++;
			}


		});
		
		if(i==j)
			$('#checkall').attr('checked',true);
		else
			$('#checkall').attr('checked',false);
	});
});



 function editcontent()
	{	
	var counter=0;
	var id="";
	$('.checkid').each(function(){		
		var check = $(this).attr('checked')?1:0;
		if(check ==1)
		{			
			id=$(this).val();
			counter=counter +1;
		}
   	});	
	
	if(counter!=1)
	{
		alert("please select only one row  to edit");
		return false;
		}else{	
		document.getElementById("linkedit").href="/companies/editcommtask/"+id; 
		
		}
	} 


	function activatecontents(act,op)
		{	
			var id="";
			$('.checkid').each(function(){		
				var check = $(this).attr('checked')?1:0;
				if(check ==1)
				{			
					if(id=="")
						id=$(this).val();
					else
						id=id + "*" + $(this).val();
				}
		});
			if(id !=""){
					if(op=="change"){	
						if(act=="active"){
							window.location="/companies/changestatus/"+id+"/CommunicationTask/1/commtasklist/cngstatus";
							}else{
							window.location="/companies/changestatus/"+id+"/CommunicationTask/0/commtasklist/cngstatus";
							}
					}
					if(op=="del"){
					window.location="/companies/changestatus/"+id+"/CommunicationTask/0/commtasklist/delete";
					}
			}else{
				alert('Please atleast one record should be select'); 
				return false;
			}
		}
</script>



<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container">
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

<span class="titlTxt">
Templates 
</span>

<div class="topTabs">
<ul class="dropdown">
<li><a href="/companies/addcommtask"><span>New</span></a></li>
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
        			 <!--li><a href="javascript:void(0)">Copy</a></li-->
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
        		</ul>
</li>
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
</ul>
</div>

</div>
                            <div class="midCont">

                            <!-- top curv image starts -->
                            <div>
                            <span class="topLft_curv"></span>
		
		<div class="gryTop">
		<?php echo $form->create("Company", array("action" => "commtasklist",'name' => 'commtasklist', 'id' => "commtasklist")) ?>
		<script type='text/javascript'>
			function setprojectid(projectid){
					document.getElementById('projectid').value= projectid;
					document.adminhome.submit();
				}
		</script>
		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200",'value'=>$key));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>'btn'));
			?> 
		</span>
		<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/commtasklist')" id="locaa"></span>
		<span class="spnFilt">
		 <?php if($session->check('Message.flash')){ ?> 
	
		<?php $session->flash(); } ?>
                    </span>
                        </div> <span class="topRht_curv"></span>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="trBg">
	<th align="center" width="3%">#</th>
         <th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>	  
      	<th align="left" valign="middle"><?php echo $pagination->sortBy('task_name', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>Communication Task Name</th>      
 	<th align="left" valign="middle">Status</th>
      	<th align="left" valign="middle">Edit</th>
        <th align="left" valign="middle">Delete</th>
      	</tr>
   	<?php
		if($taskdata){
   			foreach($taskdata as $eachrow){
   			$recid = $eachrow['CommunicationTask']['id'];
   			$modelname = "CommunicationTask";
   			$redirectionurl = "commtasklist";
   			$company_task_id = $eachrow['CommunicationTask']['id'];
   			$task_name= $eachrow['CommunicationTask']['task_name'];
			if($task_name)   $task_name = AppController::WordLimiter($task_name,70);
   			
   		?>
   	<tr>	
		<td align="center"><a><span><?php echo $i++;?></a></span></td>
		<td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $task_name; ?><a></span></td>		
		<td align="left" valign="middle"><a><span><?php if($eachrow['CommunicationTask']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate <?php echo $coinsetname; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate <?php echo $coinsetname; ?>" /></a><?php } ?></td>
		<td align="left" valign="middle"><a href="/companies/editcommtask/<?php echo $recid; ?>"><img src="/img/<?php echo $project_name?>/edit.png" alt="" title="Click here to View <?php echo $eachrow['CommunicationTask']['task_name']; ?>" /></a></td>
        <td align="left" valign="middle"><a onclick="return delete_record();" href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/delete'?>"><img src="/img/<?php echo $project_name?>/delete.png" alt="" title="Click here to delete <?php echo $eachrow['CommunicationTask']['task_name']; ?>" /></a></td>
		</tr>
	<?php } } else{ ?>
	<tr><td colspan="3" align="center">No Task Found.</td></tr>
	<?php } ?>
	</table>
	
    
<?php if($taskdata) { echo $this->renderElement('newpagination'); } ?>
  </div>

      <div>
      <span class="botLft_curv"></span>
      
      <div class="gryBot">
      </div>
      <!--inner-container ends here-->
        

      <span class="botRht_curv"></span>
      <div class="clear"></div>
      </div>
      <?php echo $form->end();?>




<div class="clear"></div>
    </div>
