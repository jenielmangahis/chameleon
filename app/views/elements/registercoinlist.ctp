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
		document.getElementById("linkedit").href="/companies/viewcomments/"+id; 
		
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
			if(op=="del"){
			window.location="/companies/changestatus/"+id+"/CoinsHolder/0/registercoinlist/delete";
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
Registered Coin List
</span>
<div class="topTabs">
<ul class="dropdown">
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
        			 
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
        		</ul>
</li>
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>View</span></a></li>
</ul>
</div>

</div>
<div class="midCont">
<!-- top curv image starts -->
<div>
<span class="topLft_curv"></span>
                                                            <div class="gryTop">
                                                            <?php echo $form->create("Companies", array("action" => "registercoinlist",'enctype'=>'multipart/form-data','name' => 'registercoinlist', 'id' => "registercoinlist"))?>
                                                            <script type='text/javascript'>
                                                            function setprojectid(projectid){
                                                          document.getElementById('projectid').value= projectid;
                                                        document.adminhome.submit();
}
                                                        </script>
                                                            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                                                        ?> 
                                                            </span>
								<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/registercoinlist')" id="locaa"></span>
                                                            <span class="spnFilt">
                                                            <?php if($session->check('Message.flash')){ ?> 
        
                                                          <?php $session->flash(); } ?>
                                                              </span>
                                                                  </div>  <span class="topRht_curv"></span>
<div class="clear"></div></div>
<!-- top curv image ends -->
		
		

<?php $i=1; ?>			
<div class="tblData">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="trBg">
<th align="center" width="3%">#</th>
<th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
<th align="left" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('serialnum', '<img src="/img/'.$project_name.'/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Serial #</th>
<th align="left" valign="middle" style="width:20%">Coinset</th>
<th align="left" valign="middle" style="width:30%">Holder</th>
<th align="left" valign="middle">Edit</th>
<th align="left" valign="middle">Delete</th>
</tr>
<?php if($coinlist){
$dispflag = false;
foreach($coinlist as $eachrow){

$recid = $eachrow['CoinsHolder']['id'];
$modelname = "CoinsHolder";
$redirectionurl = "registercoinlist";

$serialnum = $eachrow['CoinsHolder']['serialnum'];
$coinset_name = $eachrow['Coinset']['coinset_name'];
$firstname = $eachrow['Holder']['firstname'];
$lastnameshow = $eachrow['Holder']['lastnameshow'];
$fullname = $firstname.' '.$lastnameshow;

if($this->requestAction("/companies/hascomment/$recid")){
$dispflag = true;
}

?>
<tr>	
<td align="center"><a><span><?php echo $i++;?></a></span></td>
<td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>		
<td align="left" valign="middle"><a><span><?php echo $serialnum?$serialnum:"N/A"; ?></td>
<td align="left" valign="middle"><a><span><?php echo $coinset_name?$coinset_name:"N/A"; ?></a></span></td>
<td align="left" valign="middle"><a><span><?php echo $fullname?$fullname:"N/A"; ?></a></span></td>
<?php if($dispflag==true) { ?>
<td align="left" valign="middle"><a title="Click here to view comments on <?php echo $serialnum; ?>"  href="/companies/viewcomments/<?php echo $recid; ?>">View Comments</a></td>
<td align="left" valign="middle"><a onclick="return confirm('Do you want to delete this record.');" href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/delete'?>"><img src="/img/<?php echo $project_name?>/delete.png" alt="" title="Click here to delete <?php echo $serialnum; ?>" /></a></td>
<?php }else{ ?>
<td align="left" valign="middle">No Comments </td>
<td align="left" valign="middle"><a onclick="return delete_record();" href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/delete'?>"><img src="/img/<?php echo $project_name?>/delete.png" alt="" title="Click here to delete <?php echo $serialnum; ?>" /></a></td>
<?php } ?>
</tr>
<?php } }else{ ?>
<tr><td colspan="4" align="center">No Registered Coins Found.</td></tr>
<?php  } ?>
</table>

<?php if($coinlist) { echo $this->renderElement('newpagination'); } ?>
  
</div>
    <!-- bot curv image starts -->
    <div>
    <span class="botLft_curv"></span>
    <div class="gryBot">
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>
    </div>
    <!-- bot curv image ends -->

<!--inner-container ends here-->

<?php echo $form->end();?>



<div class="clear"></div>
</div>