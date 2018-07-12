<?php  $base_url = Configure::read('App.base_url');
		$lgrt = $base_url.$session->read('newsortingby');
?>
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
		alert("please select only one row  to view");
		return false;
		}else{	
		document.getElementById("linkedit").href=baseUrl+"companies/viewcomments/"+id; 
		
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
			if(op=="del"){
						if(confirm("You have selected "+count+" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
			window.location=baseUrl+"companies/changestatus/"+id+"/CoinsHolder/0/registercoinlist/delete";
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
  <div class="titlCont"><div style="width:960px; margin:0 auto;">              

<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php echo $form->create("Companies", array("action" => "registercoinlist",'enctype'=>'multipart/form-data','name' => 'registercoinlist', 'id' => "registercoinlist"))?>
<script type='text/javascript'>
	function setprojectid(projectid){
	document.getElementById('projectid').value= projectid;
	document.adminhome.submit();
}
</script>
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
  <?php    $this->loginarea="companies";    $this->subtabsel="registercoinlist";
             echo $this->renderElement('donation_submenus');  ?>
</div></div>
<div class="midCont">

 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
<?php } ?>
<!-- top curv image starts -->
<div>
<span class="topLft_curv"></span>
	<div class="gryTop">

	<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
	if(isset($this->data['Company']['searchkey']) && $this->data['Company']['searchkey'] !=""){
	echo $form->submit("Reset", array('id' => 'searchkey', 'div' => false, 'label' => '','onclick'=>'document.getElementById("searchkey").value=""'));
	}
	?> 
	</span>
	<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/registercoinlist')" id="locaa"></span>
	<span class="srchBg2"><input type="button" value="Csv file download" label="" onclick="javascript:(window.location=baseUrl+'companies/downloadregcoinlist')" > </span>
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
<th align="center" width="10px">#</th>
<th align="center" width="10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
<th align="center" valign="middle" style="width:313px;"><span class="right"><?php echo $pagination->sortBy('serialnum', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Serial #</th>
<th align="center" valign="middle" style="width:314px;"><span class="right"><?php echo $pagination->sortBy('coinset_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Coinset</th>
<th align="center" valign="middle" style="width:313px;"><span class="right"><?php echo $pagination->sortBy('holder_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Holder</th>

</tr>
<?php if($coinlist){
$dispflag = false;
foreach($coinlist as $eachrow){

$recid = $eachrow['CoinsHolder']['id'];
$modelname = "CoinsHolder";
$redirectionurl = "registercoinlist";

$serialnum = $eachrow['CoinsHolder']['serialnum'];


$coinset_name = $eachrow['Coinset']['coinset_name'];
			if(preg_match('/[A-Z]{3}/', $coinset_name)==1){
			$coinsname= preg_split('/[A-Z]{3}/', $coinset_name);
			$coinset_name=$coinsname[1];
   			}
$firstname = $eachrow['Holder']['firstname'];
$lastnameshow = $eachrow['Holder']['lastnameshow'];
if(!empty($firstname) || !empty($lastnameshow))
{
     $fullname = $firstname.' '.$lastnameshow;   
}else{
      $fullname = $eachrow['Holder']['screenname'];   
 }
$namechk=$firstname;
if($this->requestAction($base_url+"companies/hascomment/$recid")){
$dispflag = true;
}

?>
<?php if($i%2 == 0) { ?>
<tr class='altrow'>	
<td align="center" class='newtblbrd'><span style="color:#4d4d4d"><?php echo $i++;?></span></td>
<td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>		
<td align="left" valign="middle" class='newtblbrd'>

	
	<?php
				e($html->link(
					$html->tag('span', ($serialnum)?$serialnum:"N/A"),
					array('controller'=>'companies','action'=>'viewcomments',$recid),
					array('escape' => false)
					)
				);
?>
</td>
<td align="left" valign="middle" class='newtblbrd'>

		<?php
		e($html->link(
					$html->tag('span', ($coinset_name)?$coinset_name:"N/A"),
					array('controller'=>'companies','action'=>'viewcomments',$recid),
					array('escape' => false)
					)
				);
?>
</td>
<td align="left" valign="middle" class='newtblbrd'>
	
	<?php
		e($html->link(
					$html->tag('span', ($fullname)?$fullname:"N/A"),
					array('controller'=>'companies','action'=>'viewcomments',$recid),
					array('escape' => false)
					)
				);
?>
</td>
<?php if($dispflag==true) { ?>

<?php }else{ ?>

<?php } ?>
</tr>
<?php } else { ?>
<tr>	
<td align="center"><span style="color:#4d4d4d"><?php echo $i++;?></span></td>
<td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>		
<td align="left" valign="middle">
	
	<?php
		e($html->link(
					$html->tag('span', ($serialnum)?$serialnum:"N/A"),
					array('controller'=>'companies','action'=>'viewcomments',$recid),
					array('escape' => false)
					)
				);
?>
</td>
<td align="left" valign="middle">
	
		<?php
		e($html->link(
					$html->tag('span', ($coinset_name)?$coinset_name:"N/A"),
					array('controller'=>'companies','action'=>'viewcomments',$recid),
					array('escape' => false)
					)
				);
?>
</td>
<td align="left" valign="middle">
	
	<?php
		e($html->link(
					$html->tag('span', ($fullname)?$fullname:"N/A"),
					array('controller'=>'companies','action'=>'viewcomments',$recid),
					array('escape' => false)
					)
				);
?>
</td>
<?php if($dispflag==true) { ?>

<?php }else{ ?>

<?php } ?>
</tr>
<?php } ?>	
<?php } }else{ ?>
<tr><td colspan="4" align="center">No Registered Coins Found.</td></tr>
<?php  } ?>
</table>
  
</div>
    <!-- bot curv image starts -->
    <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($coinlist) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>
    </div>
    <!-- bot curv image ends -->

<!--inner-container ends here-->

<?php echo $form->end();?>



<div class="clear"></div>
</div>