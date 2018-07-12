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
		document.getElementById("linkedit").href="/companies/editcoinset/"+id; 
		
		}
	} 


function activatecontents(act,op)
{   
    var id="";
        var count=0;
    $('.checkid').each(function(){       
        var check = $(this).attr('checked')?1:0;
        if(check ==1)
        {           
            if(id==""){
                id=$(this).val();
               
                ++count;
                }
                else
                {
                id=id + "*" + $(this).val();
                ++count;
                }
        }
   });
	if(id !=""){
			if(op=="change"){	
				if(act=="active"){
					window.location="/companies/changestatus/"+id+"/Coinset/1/coinsetlist/cngstatus";
					}else{
					window.location="/companies/changestatus/"+id+"/Coinset/0/coinsetlist/cngstatus";
					}
			}
			if(op=="del"){
						if(confirm("You have selected "+count+" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
			window.location="/companies/changestatus/"+id+"/Coinset/0/coinsetlist/delete";
			
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
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php
		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '43'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   
  echo $this->renderElement('new_slider');  ?>



</div>
      <?php echo $form->create("Company", array("action" => "coinsetlist",'name' => 'coinsetlist', 'id' => "coinsetlist")) ?>    
<span class="titlTxt">
Coinsets
</span>
<div class="topTabs">
<ul class="dropdown">
<li><a href="/companies/addcoinset"><span>New</span></a></li>
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

<!-- <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; ">
<ul class="topTabs2">
<li><a href="/companies/editprojectdtl"><span>Details</span></a></li>
        	
		<li><a href="/companies/coinsetlist" class="tabSelt"><span>Coinsets</span></a></li>
		<li><a href="/companies/projectsponsor"><span>Sponsor</span></a></li>
		<li><a href="/companies/companylist"><span>Companies</span></a></li>
		<li><a href="/companies/contactlist"><span>Contacts</span></a></li>
        <li><a href="/companies/projectcompanytypes"><span>Company Type</span></a></li>
        <li><a href="/companies/projectcontacttypes"><span>Contact Type</span></a></li>
		<li><a href="/companies/projectbackup"><span>Project Backup</span></a></li>   
		<li><a href="/companies/getstart"><span>Get Started</span></a></li>
</ul>
</div>
<div class="clear"></div>  --> 
  <?php  $this->loginarea="companies";    
        $this->subtabsel="coinsetlist";
        echo $this->renderElement('setup_submenus');  ?> 
</div></div>

    <div class="midCont" id="newcnsettab">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



    <!-- top curv image starts -->
    <div>
    <span class="topLft_curv"></span>
    <div class="gryTop">
	
		<script type='text/javascript'>
			function setprojectid(projectid){
					document.getElementById('projectid').value= projectid;
					document.adminhome.submit();
				}
		</script>
					<span class="spnFilt">Filter:</span>
                    <span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                    <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '')); ?>   </span>
                    <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/coinsetlist')" id="locaa"></span>
	 </div>	<span class="topRht_curv"></span>
     <div class="clear"></div></div>

<?php $i=1; ?>			
		
                    <div class="tblData">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
    <tr class="trBg">
     <th align="center" valign="middle" style='width:10px;'>#</th>
     <th align="center" valign="middle" style='width:10px;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
     <th align="center" valign="middle" style='width:130px;'><span class="right"><?php echo $pagination->sortBy('coinset_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Coinset Name</th>
     <th align="center" valign="middle" style='width:150px;'><span class="right"><?php echo $pagination->sortBy('verifycode', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Verification Code</th>
     <th align="center" valign="middle" style="width: 55px;"><span class="right" ><?php echo $pagination->sortBy('serialprefix', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Prefix</th>
     <th align="center" valign="middle" style='width:100px;'><span class="right"><?php echo $pagination->sortBy('numunits', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span># of Units</th>
     <th align="center" valign="middle" style='width:140px;'><span class="right"><?php echo $pagination->sortBy('startserialnum', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Start Serial #</th>
     <th align="center" valign="middle" style='width:140px;'><span class="right"><?php echo $pagination->sortBy('endserialnum', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>End Serial #</th>
     <th align="center" valign="middle" style="width: 155px;"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Date & Time</th>
     <th align="center" valign="middle" style='width:70px;'><span class="right"><?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Status</th>
     
      </tr>
   		<?php 
			
			if($coinsetdetail){
   	$i=1;
   			foreach($coinsetdetail as $eachrow){
   			$recid = $eachrow['Coinset']['id'];
   			$modelname = "Coinset";
   			$redirectionurl = "coinsetlist";
   			
   			$verifycode = $eachrow['Coinset']['verifycode'];
   			
   			$coinsetname = $eachrow['Coinset']['coinset_name'];
			if(preg_match('/[A-Z]{3}/', $coinsetname)==1){
			$coinsname= preg_split('/[A-Z]{3}/', $coinsetname);
			$coinsetname=$coinsname[1];
   			}
   			$numunits = $eachrow['Coinset']['numunits'];
   			$startser = $eachrow['Coinset']['startserialnum'];
   			$endser = $eachrow['Coinset']['endserialnum'];
   			
   			$datesubmitchipco = $eachrow['Coinset']['datesubmitchipco'];
   			$dateestship = $eachrow['Coinset']['dateestship'];
   			$dateestdelivery = $eachrow['Coinset']['dateestdelivery'];
   			$serialprefix = $eachrow['Coinset']['serialprefix'];
   			$cretd = $eachrow['Coinset']['created'];
			$cretd = AppController::usdateformat($cretd,1);
			
   		?>


<?php if($i%2 == 0) { ?>
		<tr class='altrow'>
 

   		
		<td align="left" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
		<td align="left" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $coinsetname?$coinsetname:"N/A"; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $verifycode?$verifycode:"N/A"; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $serialprefix?$serialprefix:"N/A"; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $numunits?$numunits:"N/A"; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $startser?$startser:"N/A"; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $endser?$endser:"N/A"; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $cretd?$cretd:"N/A"; ?></span></td>
		
		
		<td align="center" valign="middle" class='newtblbrd'><?php if($eachrow['Coinset']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $coinsetname; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $coinsetname; ?>" /></a><?php } ?></td>
		
		
		
		</tr>
<?php } else { ?>

<tr>
    		
		<td align="left"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
		<td align="left"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
		<td align="left" valign="middle"><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $coinsetname?$coinsetname:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $verifycode?$verifycode:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $serialprefix?$serialprefix:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $numunits?$numunits:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $startser?$startser:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><a href='editcoinset/<?php echo $recid; ?>'><span><?php echo $endser?$endser:"N/A"; ?></span></a></td>
		<td align="left" valign="middle"><span style="color:#4d4d4d;"><?php echo $cretd?$cretd:"N/A"; ?></span></td>
		
		
		<td align="center" valign="middle"><?php if($eachrow['Coinset']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $coinsetname; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $coinsetname; ?>" /></a><?php } ?></td>
		
		
		
		</tr>
<?php } ?>	








	 <?php } }else{ ?>
	<tr><td colspan="9" align="center">No Coinsets Found.</td></tr>
	<?php  } ?>
	</table>    
                      </div>
                    
                    <div>
                    <span class="botLft_curv"></span>
<div class="gryBot"><?php if($coinsetdetail) { echo $this->renderElement('newpagination'); } ?>
                    </div><span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->

<?php echo $form->end();?>

                    </div>

<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newcnsettab").className = "newmidCont";
	}	
</script>