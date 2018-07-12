<!--container starts here-->
<?php $pagination->setPaging($paging); ?>  
<div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
                <?php echo $form->create("Companies", array("action" => "suggestedcomments",'name' => 'commenttype', 'id' => "commenttype")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
 
            <span class="titlTxt">   Comment Types  </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                      <li>
					<?php
						e($html->link(
							$html->tag('span', 'New'),
							array('controller'=>'companies','action'=>'addcommenttype'),
							array('escape' => false)
							)
						);
					?>
					</li>  
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                    <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
                </ul>
            </div>


          <?php    $this->loginarea="companies";    $this->subtabsel="suggestedcomments";
             echo $this->renderElement('comments_submenus');  ?>   
        </div></div>

        
<div class="midCont" id="newsggtab">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/suggestedcomments')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php 
    if(!isset($selectedprojectid)) $selectedprojectid="";	
      echo $form->hidden("Companies.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));?>
</div> 
 <div class="clear"></div>
 </span>
</div> <span class="topRht_curv"></span>
<div class="clear"></div>
</div> 
<div class="tblData">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="trBg">
     <th align="center" valign="middle" style="width:1%">#</th>
	 <th align="center" valign="middle"  style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
     <th align="center" valign="middle" style="width:40%"><span class="right"><?php echo $pagination->sortBy('comment_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Comment Type</th>
     <th align="center" valign="middle" style="width:40%"><span class="right"><?php echo $pagination->sortBy('comment_type_purpose', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Description</th>
     <th align="center" valign="middle" style="width:17%;"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
    </tr>
   	<?php if($commenttypedata){  $i=1;
   			foreach($commenttypedata as $eachrow){
   			$recid = $eachrow['CommentType']['id'];		
   			$modelname = "CommentType";
   			$redirectionurl = "suggestedcomments";		 			
   			
   		?>
<?php if($i%2 == 0) { ?>
   	<tr class='altrow'>	
		<td align="center" valign="middle" class='newtblbrd'><span><?php echo $i++ ?></span></td><td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" valign="middle" class='newtblbrd'>
		<?php
				e($html->link(
					$html->tag('span', ($eachrow['CommentType']['comment_type_name'])?$eachrow['CommentType']['comment_type_name']:"N/A"),
					array('controller'=>'companies','action'=>'editcommenttype',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			 <?php
				e($html->link(
					$html->tag('span', $eachrow['CommentType']['comment_type_purpose']),
					array('controller'=>'companies','action'=>'editcommenttype',$recid),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="center" valign="middle" class='newtblbrd'>
			<?php if($eachrow['CommentType']['active_status']=='1'){ 
			e($html->link(
					$html->image('active.gif',array('title'=>'Click here to deactivate '.$eachrow['CommentType']['comment_type_name'])),
					array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
					array('escape'=>false)
				)
			);
			}else {
				e(
					$html->link(
						$html->image('deactive.gif',array('title'=>'Click here to activate '.$eachrow['CommentType']['comment_type_name'])),
						array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
						array('escape'=>false)
					)
				);
			}
			?>

		</td>
	
	</tr>
<?php } else { ?>

	<tr>	
		<td align="center" valign="middle"><span style="color:#4d4d4d;" ><?php echo $i++ ?></span></td><td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', ($eachrow['CommentType']['comment_type_name'])?$eachrow['CommentType']['comment_type_name']:"N/A"),
					array('controller'=>'companies','action'=>'editcommenttype',$recid),
					array('escape' => false)
					)
				);
	?>

		</td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', ($eachrow['CommentType']['comment_type_purpose'])?$eachrow['CommentType']['comment_type_purpose']:"N/A"),
					array('controller'=>'companies','action'=>'editcommenttype',$recid),
					array('escape' => false)
					)
				);
		?>

		</td>
		<td align="center" valign="middle">
			<?php if($eachrow['CommentType']['active_status']=='1'){ 
				e($html->link(
					$html->image('active.gif',array('title'=>'Click here to deactivate '.$eachrow['CommentType']['comment_type_name'])),
					array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
					array('escape'=>false)
				)
			);
			}else {
				e(
					$html->link(
						$html->image('deactive.gif',array('title'=>'Click here to activate '.$eachrow['CommentType']['comment_type_name'])),
						array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
						array('escape'=>false)
					)
				);
			}			
			?></td>
	</tr>		   
<?php } ?>		   	
	<?php } }else{ ?>
	<tr><td colspan="7" align="center">No Comment Type Found.</td></tr>
	<?php } ?>
	</table>	   	
</div><!--inner-container ends here-->	
   <div>
		<span class="botLft_curv"></span>		
		<div class="gryBot">		
		 <?php if($commenttypedata) { echo $this->renderElement('newpagination'); } ?>
    </div>	
	<span class="botRht_curv"></span>
	<div class="clear"></div>
	</div>
	<div class="clear"></div>
  </div>              
 <script type="text/javascript">
$(document).ready(function()
{
	$('#checkall').bind('change',function(){
	var check = $(this).attr('checked')?1:0;
	if(check ==1){
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
		document.getElementById("linkedit").href=baseUrl+"companies/editcommenttype/"+id; 
		
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
                                        window.location=baseUrl+"companies/changestatus/"+id+"/CommentType/1/suggestedcomments/cngstatus";
                                        }else{
                                        window.location=baseUrl+"companies/changestatus/"+id+"/CommentType/0/suggestedcomments/cngstatus";
                                        }
                        }
                        if(op=="del"){
if(confirm("You have selected "+count+" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                        window.location=baseUrl+"companies/changestatus/"+id+"/CommentType/0/suggestedcomments/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newsggtab").className = "newmidCont";
	}	
</script>