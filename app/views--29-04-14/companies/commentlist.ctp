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
		document.getElementById("linkedit").href=baseUrl+"companies/verifycommentlist/"+id; 
		
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
					window.location=baseUrl+"companies/changestatus/"+id+"/Comment/1/commentlist/cngstatus";
					}else{
					window.location=baseUrl+"companies/changestatus/"+id+"/Comment/0/commentlist/cngstatus";
					}
			}
			if(op=="del"){
					if(confirm("You have selected "+count+" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
			window.location=baseUrl+"companies/changestatus/"+id+"/Comment/0/commentlist/delete";
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
	 <?php  echo $this->renderElement('new_slider');  ?>
 </div>
         <?php echo $form->create("Company", array("action" => "commentlist",'name' => 'commentlist', 'id' => "commentlist")) ?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
        </script>
<span class="titlTxt">
Comments
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


 <?php    $this->loginarea="companies";    $this->subtabsel="commentlist";
             echo $this->renderElement('comments_submenus');  ?>   
</div></div>

    <div class="midCont" id="newcmmtab">
 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <!-- top curv image starts -->
    <div>
    <span class="topLft_curv"></span>
    <div class="gryTop">

					<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                                                        
                                                        ?> 
                                                            </span>
								<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/commentlist')" id="locaa"></span>
		
		
                    </div>	<span class="topRht_curv"></span>
                    <div class="clear"></div></div>

<?php $i=1; ?>			
		
                    <div class="tblData">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr class="trBg">
	  <th align="center" width="10px">#</th>
          <th align="center" width="10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th>	 
	  <th align="center" valign="middle"  style="width:10%"><span style="float:right"><?php echo $pagination->sortBy('serialnum', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Coin #</th>
	  <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('comment', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Comment </th>
	  <th align="center" valign="middle" style="width:25%" ><span class="right"><?php echo $pagination->sortBy('comment_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Type</th>
	  <th align="center" valign="middle" style="width:18%"><span class="right"><?php echo $pagination->sortBy('comment_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Screen Name</th>    
          <th align="center" valign="middle" style="width:14%" ><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date</th>
     <!--     <th align="center" valign="middle" style="width:70px;" ><span class="right">< ?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Verified </th> -->

      
      </tr> 
   		<?php if($commentlist){
   	   	
   			foreach($commentlist as $eachrow){
   			$recid = $eachrow['Comment']['id'];   		
			$modelname = "Comment";
   			$redirectionurl = "commentlist";	
   			$comment = $eachrow['Comment']['comment'];
   			$active_status = $eachrow['Comment']['active_status'];
   			if($comment)$commentnew = AppController::WordLimiter($comment,30);
   			
   			$commentdate =  $eachrow['Comment']['created'];		 
			$coinno = $eachrow['CoinsHolder']['serialnum'];
			if(preg_match('/[A-Z]{3}/', $coinno)==1){
			$coinsname= preg_split('/[A-Z]{3}/', $coinno);
			$coinno=$coinsname[1];
   			}
			$coinsetname = $eachrow['Coinset']['coinset_name'];
			if(preg_match('/[A-Z]{3}/', $coinsetname)==1){
			$coinsname= preg_split('/[A-Z]{3}/', $coinsetname);
			$coinsetname=$coinsname[1];
   			}
   			$commentdate = AppController::usdateformat($commentdate);
   			//$firstname = $eachrow['Holder']['firstname'];
   			//$lastnameshow = $eachrow['Holder']['lastnameshow'];
   			$fullname = $eachrow['Holder']['screenname'];  //$firstname.' '.$lastnameshow;
			if($fullname)	$fullname = AppController::WordLimiter($fullname,20);
   			
			$commenttypename="";
			if($eachrow['Comment']['comment_type_id']>0)
			$commenttypename=AppController::getcommenttypename($eachrow['Comment']['comment_type_id']);
   		?>   		
 		
 <?php if($i%2 == 0) { ?>
   	<tr class='altrow'>	
		<td align="center" class='newtblbrd'><span><?php echo $i++;?></span></td>
		<td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
   		<td align="left" valign="middle" class='newtblbrd'>
		<?php
				e($html->link(
					$html->tag('span', ($coinno)?$coinno:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			
			<?php
				e($html->link(
					$html->tag('span', ($commentnew)?$commentnew:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			<?php
				e($html->link(
					$html->tag('span', ($commenttypename)?$commenttypename:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
		<?php
				e($html->link(
					$html->tag('span', ($fullname)?$fullname:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'><span><?php echo $commentdate?$commentdate:"N/A"; ?></span></td>
	<!--	<td align="center" valign="middle" class='newtblbrd'>< ?php if($active_status=='1'){ ?><a href="/companies/changestatus/< ?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate " /></a>< ?php }else{ ?><a href="/companies/changestatus/< ?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/< ?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate " /></a>< ?php } ?></td>    -->
		
		
		</tr>
		
<?php } else { ?>
 					<tr class='altrow'>	
		<td align="center" class='newtblbrd'><span><?php echo $i++;?></span></td>
		<td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
   		<td align="left" valign="middle" class='newtblbrd'>
		<?php
				e($html->link(
					$html->tag('span', ($coinno)?$coinno:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			
			<?php
				e($html->link(
					$html->tag('span', ($commentnew)?$commentnew:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			<?php
				e($html->link(
					$html->tag('span', ($commenttypename)?$commenttypename:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
		<?php
				e($html->link(
					$html->tag('span', ($fullname)?$fullname:"N/A"),
					array('controller'=>'companies','action'=>'verifycommentlist',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'><span><?php echo $commentdate?$commentdate:"N/A"; ?></span></td>
	</tr>
<?php } ?>
<?php } }else{ ?>	 
	<tr>
		<td colspan='7' align="center">No Comments Found.</td>
	</tr>
	<?php  } ?>
	</table>
 </div>
                    <div>
                    <span class="botLft_curv"></span>
<div class="gryBot"><?php if($commentlist) { echo $this->renderElement('newpagination'); } ?>
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
	document.getElementById("newcmmtab").className = "newmidCont";
	}	
</script>