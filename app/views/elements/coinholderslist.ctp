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



 	function editholder()
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
		document.getElementById("linkedit").href="/companies/editholder/"+id; 
		
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
					window.location="/companies/changestatus/"+id+"/Holder/1/holderslist/cngstatus";
					}else{
					window.location="/companies/changestatus/"+id+"/Holder/0/holderslist/cngstatus";
					}
			}
			if(op=="del"){
			window.location="/companies/changestatus/"+id+"/Holder/0/holderslist/delete";
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

<div align="center" id="toppanel" style="left:0;">
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
Registered Coin Holders 
</span>

<div class="topTabs">
<ul class="dropdown">
<li><a href="/companies/addholder"><span>New</span></a></li>
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
        			 <!--li><a href="javascript:void(0)">Copy</a></li-->
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
        		</ul>
</li>
<li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
</ul>
</div>

</div>
    <div class="midCont">
    <!-- top curv image starts -->
    <div>
    <span class="topLft_curv"></span>
		<div class="gryTop">
		<?php echo $form->create("Companies", array("action" => "holderslist",'type' => 'file','enctype'=>'multipart/form-data','name' => 'contentlist', 'id' => "contentlist"))?>
		<script type='text/javascript'>
			function setprojectid(projectid){
					document.getElementById('projectid').value= projectid;
					document.adminhome.submit();
				}
		</script>
		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
				if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey'] !=""){
					echo $form->submit("Reset", array('id' => 'searchkey', 'div' => false, 'label' => '','onclick'=>'document.getElementById("searchkey").value=""'));
				}
			?> 
	      <!--<button type="button" name="download" onclick="javascript:(window.location='/companies/holderslist')"><span>Reset</span> </button>-->
		</span>
		<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/holderslist')" id="locaa"></span>
		<span class="spnFilt">
		 <?php if($session->check('Message.flash')){ ?> 
	
		<?php $session->flash(); } ?>
		</span>
                    </div><span class="topRht_curv"></span>
                    <div class="clear"></div></div>
                    <div class="tblData">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="trBg">
	  <th align="left" valign="middle">#</th>
	   <th align="left" valign="middle" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
	  <th align="left" valign="middle"><?php echo $pagination->sortBy('email', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>Email</th>
	  <th align="left" valign="middle"><?php echo $pagination->sortBy('firstname', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>First Name</th>
	  <th align="left" valign="middle"><?php echo $pagination->sortBy('firstname', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>Last Name</th>
	  <th align="left" valign="middle"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>Register Date</th>
      <th align="left" valign="middle">Status</th>
  <th align="left" valign="middle">Edit</th>
	<th align="left" valign="middle">Delete</th>
      </tr>
 <?php $i=1;?>
  		<?php if($holderlist){
   			$created="";
   			foreach($holderlist as $eachrow){
   			$recid = $eachrow['Holder']['id'];
   			$userid = $eachrow['Holder']['user_id'];
   			$modelname = "Holder";
   			$othermodelname = "User";
   			$redirectionurl = "holderslist";
   			$firstname = $eachrow['Holder']['firstname'];
			if($firstname) $firstname = AppController::WordLimiter($firstname,25);
   			$lastnameshow = $eachrow['Holder']['lastnameshow'];
			if($lastnameshow) $lastnameshow = AppController::WordLimiter($lastnameshow,25);
   			$email = $eachrow['Holder']['email'];
			if($email) $email = AppController::WordLimiter($email,30);
   			$created = $eachrow['Holder']['created'];
   			if($eachrow['Holder']['created'] !='0000-00-00'){
   				$created = AppController::usdateformat($eachrow['Holder']['created']);
   			}
   			
   		?>
   	<tr>	
		<td align="left"><a><span><?php echo $i++;?></span></a></td>
		<td align="left"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
		<td align="left" valign="middle"><a><span><?php echo $email?$email:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a><span><?php echo $firstname?$firstname:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a><span><?php echo $lastnameshow?$lastnameshow:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a><span><?php echo $created?$created:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><?php if($eachrow['Holder']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus/'.$othermodelname.'/'.$userid; ?>"><img src="/img/active.gif" alt="" title="Click here to deactivate <?php echo $firstname; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl.'/cngstatus/'.$othermodelname.'/'.$userid; ?>"><img src="/img/deactive.gif" alt=""  title="Click here to activate <?php echo $firstname; ?>" /></a><?php } ?></td>
		
		<td align="left" valign="middle"><a href="/companies/editholder/<?php echo $recid; ?>"><img src="/img/edit.png" alt="" title="Click here to Edit <?php echo $firstname; ?>" /></a></td>
        <td align="left" valign="middle"><a onclick="return delete_record();" href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/delete/'.$othermodelname.'/'.$userid; ?>"><img src="/img/delete.png" alt="" title="Click here to delete <?php echo $coinsetname; ?>" /></a></td>
		
		</tr>
	 <?php } }else{ ?>
	<tr><td colspan="9" align="center">No Holders Found.</td></tr>
	<?php  } ?>
	
	</table>
	<?php if($holderlist) { echo $this->renderElement('newpagination'); } ?>



</div>
                    <div>
                    <span class="botLft_curv"></span>
<div class="gryBot">
                    <?php echo $form->end();?>   &nbsp;&nbsp;&nbsp;&nbsp;<button ONCLICK="javascript:(window.location='/companies/downloadholder')" class="button" name="download" type="button"><span>Csv file download</span> </button></div><span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>      </div>
<!--inner-container ends here-->

  




<div class="clear"></div>