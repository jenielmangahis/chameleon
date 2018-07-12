



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
		}else{	
		document.getElementById("link").href="/companies/editcoinset/"+id; 
		
		}
	} 



</script>



















<?php $pagination->setPaging($paging); ?>

<div class="titlCont">
<div align="center" class="slider">
<div class="slidBox"><a href="#."><span>Click Here for Help</span></a></div>
</div>
<span class="titlTxt">
Coinset List
</span>
<div class="topTabs">
<ul>
<li><a href="/companies/addcoinset"><span>New</span></a></li>
<li><a href="#." class="tab2"><span>Actions</span></a></li>
<li><a href="#" onclick="editcontent();" id="link"><span>Edit</span></a></li>
</ul>
</div>
</div>

   <div class="midPadd">
		
		<div class="gryTop">
		<?php echo $form->create("Admins", array("action" => "contentlist",'type' => 'file','enctype'=>'multipart/form-data','name' => 'contentlist', 'id' => "contentlist"))?>
		<script type='text/javascript'>
			function setprojectid(projectid){
					document.getElementById('projectid').value= projectid;
					document.adminhome.submit();
				}
		</script>
		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Search", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
				if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey'] !=""){
					echo $form->submit("Reset", array('id' => 'searchkey', 'div' => false, 'label' => '','onclick'=>'document.getElementById("searchkey").value=""'));
				}
			?> 
		</span>
		<span class="spnFilt">
		 <?php if($session->check('Message.flash')){ ?> 
	
		<?php $session->flash(); } ?>
		</span>
		</div>	

	
  <?php $i=0; ?>			
		
	<div class="tblData">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
	
	<tr>
		<th align="center" width="3%">#</th>
    <th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
	  <th align="left" valign="middle"><span class="right"><?php echo $pagination->sortBy('coinset_name', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Coinset Name</th>
      <th align="left" valign="middle">Verification Code</th>
      <th align="left" valign="middle"># of Units</th>
      <th align="left" valign="middle"><span class="right"><?php echo $pagination->sortBy('startserialnum', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Start Serial #</th>
      <th align="left" valign="middle"><span class="right"><?php echo $pagination->sortBy('endserialnum', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>End Serial #</th>
     
      <th align="left" valign="middle">Status</th>
      <th align="left" valign="middle">Edit</th>
      <th align="left" valign="middle">Delete</th>
      </tr>
   		<?php if($coinsetdetail){
   	
   			foreach($coinsetdetail as $eachrow){
   			$recid = $eachrow['Coinset']['id'];
   			$modelname = "Coinset";
   			$redirectionurl = "coinsetlist";
   			
   			$verifycode = $eachrow['Coinset']['verifycode'];
   			
   			$coinsetname = $eachrow['Coinset']['coinset_name'];
   			
   			$numunits = $eachrow['Coinset']['numunits'];
   			$startser = $eachrow['Coinset']['startserialnum'];
   			$endser = $eachrow['Coinset']['endserialnum'];
   			
   			$datesubmitchipco = $eachrow['Coinset']['datesubmitchipco'];
   			$dateestship = $eachrow['Coinset']['dateestship'];
   			$dateestdelivery = $eachrow['Coinset']['dateestdelivery'];
   			
   			
			
   		?>
   	<tr>	
		
		<td  align="center" valign="middle"><a><span><?php echo $i++;?></td></a></span>
		<td  align="center" valign="middle"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid ?>" /></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $coinsetname?$coinsetname:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $verifycode?$verifycode:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $numunits?$numunits:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $startser?$startser:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $endser?$endser:"N/A"; ?></a></span></td>
		
		
		
		<td align="left" valign="middle"><?php if($eachrow['Coinset']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $coinsetname; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $coinsetname; ?>" /></a><?php } ?></td>
		
		<td align="left" valign="middle"><a href="/companies/editcoinset/<?php echo $recid; ?>"><img src="/img/<?php echo $project_name; ?>/edit.png" alt="" title="Click here to Edit <?php echo $coinsetname; ?>" /></a></td>
        <td align="left" valign="middle"><a onclick="return delete_record();" href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/delete'?>"><img src="/img/<?php echo $project_name; ?>/delete.png" alt="" title="Click here to delete <?php echo $coinsetname; ?>" /></a></td>
		
		</tr>
	 <?php } }else{ ?>
	<tr><td colspan="9" align="center">No Coinsets Found.</td></tr>
	<?php  } ?>
	</table>    
   
<?php if($coinsetdetail) { echo $this->renderElement('pagination'); } ?>
  </div>

<div class="gryBot">
Display # <select name="s3" style="vertical-align:middle; border:1px solid #333; width:60px;"><option selected="selected">100</option></select>
</div>
<!--inner-container ends here-->
<?php echo $form->end();?>




<div class="clear"></div>


