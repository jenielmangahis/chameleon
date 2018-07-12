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



 	function viewmessage()
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
		document.getElementById("linkedit").href=baseUrl+"companies/messagenew/"+id; 
		
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
			window.location=baseUrl+"companies/changestatus/"+id+"/Message/0/messagelist/delete";
			}
	}else{
		alert('Please atleast one record should be select'); 
		return false;
	}
}
</script>	
<?php $pagination->setPaging($paging); ?>

 
 <!-- Body Panel starts -->
 <div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
     <?php  echo $this->renderElement('new_slider');  ?>



</div>

 <?php echo $form->create("Companies", array("action" => "messagelist",'enctype'=>'multipart/form-data','name' => 'messagelist', 'id' => "messagelist"))?>
 <script type='text/javascript'>
function setprojectid(projectid){
document.getElementById('projectid').value= projectid;
document.adminhome.submit();
}
</script>
<span class="titlTxt">
Messages
</span>
<div class="topTabs">
<ul class="dropdown">
 <li>
	
	<?php
		e($html->link(
			$html->tag('span', 'New'),
			array('controller'=>'companies','action'=>'messagenew'),
			array('escape' => false)
			)
		);
?>
</li>   
                <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">

                        <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)" onclick="viewmessage();" id="linkedit"><span>View</span></a></li>
</ul>
</div>
        
        <div class="clear"></div>

 
    <?php    $this->loginarea="companies";    $this->subtabsel="messagelist";
             echo $this->renderElement('comments_submenus');  ?>   




</div></div>
<div class="midCont">

 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class="">
				<a href="#." onclick="hideDiv();">
					<img src="/img/close.png" alt="" style="margin-left: 945px; position: absolute;z-index: 11;" />
				</a>
				<?php
						e($html->link(
						$html->image('close.png',array('style'=>'margin-left: 945px; position: absolute; z-index: 11;','alt'=>'Close')),
						'javascript:void ',
						array('escape' => false,'onclick' => "hideDiv()")
						)
						);	
				?>
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
<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/messagelist')" id="locaa"></span>
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
<th align="center" width="1%">#</th>
<th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
<th align="center" valign="middle" style="width:12%"><span class="right"><?php echo $pagination->sortBy('from_holdername', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>From</th>
<th align="center" valign="middle" style="width:23%"><span class="right"><?php echo $pagination->sortBy('to_holdername', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Sent To</th>
<th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('msg_subject', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Message</th>
<th align="center" valign="middle" style="width:12%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date</th>

 </tr>
        
<?php if($msglist){
$dispflag = false;
foreach($msglist as $eachrow){			
$recid = $eachrow['Message']['id'];
$modelname = "Message";
$redirectionurl = "messagelist";
$fromholdernames = ucfirst(str_replace($usr_name,"Me",$eachrow['Message']['from_holdername']));
$toholdernames = ucfirst(str_replace($usr_name,"Me",$eachrow['Message']['to_holdername']));
$message = $eachrow['Message']['msg_subject'];
$msgdate= date("M d, Y", strtotime($eachrow['Message']['created']));

/*if($this->requestAction("/companies/hascomment/$recid")){
$dispflag = true;
} */

?>
<tr>	
<td align="center"><a><span><?php echo $i++;?></a></span></td>
<td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>		
<td align="left" valign="middle"><a><span><?php echo $fromholdernames?$fromholdernames:"N/A"; ?></td>
<td align="left" valign="middle"><a><span><?php echo $toholdernames?$toholdernames:"N/A"; ?></td>
<td align="left" valign="middle"><a><span><?php echo $message?$message:"N/A"; ?></a></span></td>
<td align="left" valign="middle"><a><span><?php echo $msgdate?$msgdate:"N/A"; ?></a></span></td>

</tr>
<?php } }else{ ?>
<tr><td colspan="8" align="center">No Messages.</td></tr>
<?php  } ?>
</table>
  
</div>
    <!-- bot curv image starts -->
    <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if(!empty($coinlist)) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>
    </div>
    <!-- bot curv image ends -->

<!--inner-container ends here-->

<?php echo $form->end();?>
<div class="clear"></div>
</div>