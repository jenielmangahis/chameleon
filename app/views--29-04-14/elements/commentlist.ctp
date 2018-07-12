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
		document.getElementById("linkedit").href="/companies/verifycommentlist/"+id; 
		
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
					window.location="/companies/changestatus/"+id+"/Comment/1/commentlist/cngstatus";
					}else{
					window.location="/companies/changestatus/"+id+"/Comment/0/commentlist/cngstatus";
					}
			}
			if(op=="del"){
			window.location="/companies/changestatus/"+id+"/Comment/0/commentlist/delete";
			}
	}else{
		alert('Please atleast one record should be select'); 
		return false;
	}
}   
 

</script>









<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
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
Comment List
</span>
<div class="topTabs">
<ul class="dropdown">
<!--li><a href="/companies/addcontentpage"><span>New</span></a></li-->
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
        			 <!--li><a href="javascript:void(0)">Copy</a></li-->
        			 <!--li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li-->
                     <li class="botCurv"></li>
        		</ul>
</li>
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Detail</span></a></li>
</ul>
</div>
</div>

    <div class="midCont">

    <!-- top curv image starts -->
    <div>
    <span class="topLft_curv"></span>
    <div class="gryTop">
		<?php echo $form->create("Company", array("action" => "commentlist",'name' => 'commentlist', 'id' => "commentlist")) ?>
		<script type='text/javascript'>
			function setprojectid(projectid){
					document.getElementById('projectid').value= projectid;
					document.adminhome.submit();
				}
		</script>
					<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                                                        
                                                        ?> 
                                                            </span>
								<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/commentlist')" id="locaa"></span>
		
		<span class="spnFilt">
		 <?php if($session->check('Message.flash')){ ?> 
	
		<?php $session->flash(); } ?>
		</span>
                    </div>	<span class="topRht_curv"></span>
                    <div class="clear"></div></div>

<?php $i=1; ?>			
		
                    <div class="tblData">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="trBg">
	  <th align="center" width="3%">#</th>
         <th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>	 
	  <th align="left" valign="middle"  width="width:14%"><?php echo $pagination->sortBy('serialnum', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Coin # </th>
	  <th align="left" valign="middle" style="width:20%">Comment </th>
	  <th align="left" valign="middle" style="width:15%" >Type</th>
	  <th align="left" valign="middle" style="width:10%">Posted By</th>    
       <th align="left" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Date</th>
       <th align="left" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('active_status', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Verified Status</th>

      <th align="left" valign="middle" style="width:10%">Action</th>
      </tr> 
   		<?php if($commentlist){
   	   	
   			foreach($commentlist as $eachrow){
   			$recid = $eachrow['Comment']['id'];   		
			$modelname = "Comment";
   			$redirectionurl = "commentlist";	
   			$comment = $eachrow['Comment']['comment'];
   			$active_status = $eachrow['Comment']['active_status'];
   			if($comment)   				$commentnew = AppController::WordLimiter($comment,15);
   			
   			$commentdate = $eachrow['Comment']['created'];
   			$coinno = $eachrow['CoinsHolder']['serialnum'];
   			$commentdate = AppController::usdateformat($commentdate,1);
   			$firstname = $eachrow['Holder']['firstname'];
   			$lastnameshow = $eachrow['Holder']['lastnameshow'];
   			$fullname = $firstname.' '.$lastnameshow;
			if($fullname)	$fullname = AppController::WordLimiter($fullname,10);
   			
			$commenttypename="";
			if($eachrow['Comment']['comment_type_id']>0)
			$commenttypename=AppController::getcommenttypename($eachrow['Comment']['comment_type_id']);
   		?>   		
 		
   		
   	<tr>	
		<td align="center"><a><span><?php echo $i++;?></a></span></td>
		<td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
   		<td align="left" valign="middle"><a><span><?php echo $coinno?$coinno:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $commentnew?$commentnew:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $commenttypename?$commenttypename:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo  $fullname?$fullname:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><a><span><?php echo $commentdate?$commentdate:"N/A"; ?></a></span></td>
		<td align="left" valign="middle"><?php if($active_status=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate " /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate " /></a><?php } ?></td>
		<td align="left" valign="middle"><a title="Click here to view detail of this comment"  href="/companies/verifycommentlist/<?php echo $recid; ?>"> Detail </a></td>
		
		</tr>
		
	 <?php } }else{ ?>	 
	<tr><td  colspan=7>No Comments Found.</td></tr>
	<?php  } ?>
	</table>
	<?php echo $form->end();?>
    
<?php if($commentlist) { echo $this->renderElement('newpagination'); } ?>
 </div>
                    <div>
                    <span class="botLft_curv"></span>
<div class="gryBot">
                    </div><span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->

<?php echo $form->end();?>

                    </div>

<div class="clear"></div>
