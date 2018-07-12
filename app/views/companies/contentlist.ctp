<?php
/******FB******/
//include('facebook.php');// this file is in webroot
//$facebook_session = $facebook->getSession();
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
	alert("please select only one row  to edit");
		}else{	
		document.getElementById("linkedit").href="/companies/editcontent/"+id; 
		
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
					window.location="/companies/changestatus/"+id+"/Content/1/contentlist/cngstatus";
					}else{
					window.location="/companies/changestatus/"+id+"/Content/0/contentlist/cngstatus";
					}
			}
			if(op=="del"){
					if(confirm("You have selected "+count+" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
			window.location="/companies/deletecontent/"+id;
			}
	}else{
		alert('Please atleast one record should be select'); 
		return false;class='newtblbrd'
	}
}   
 
</script>



<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container">
<div class="titlCont">
<div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>


</div>
          <?php echo $form->create("Company", array("action" => "contentlist",'type' => 'file','enctype'=>'multipart/form-data','name' => 'contentlist', 'id' => "contentlist"))?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
        </script>
<span class="titlTxt">
Webpages
</span>
<div class="topTabs">
<ul class="dropdown">
<li><a href="/companies/addcontentpage"><span>New</span></a></li>
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


  <?php    $this->loginarea="companies";    $this->subtabsel="contentlist";
             echo $this->renderElement('websites_submenus');  ?>  
</div>
</div>


<script language='javascript'>
	function showcontentwindow(id){
		var url = '/companies/showcontentwindow/'+id+'/Content';
		//window.open(url,'mywindow','status=no,toolbar=no, height=800,width=800,top=200 , left=500, scrollbars=yes');
		jQuery.facebox({ ajax: url });
	}
</script>

<!--inner-container starts here-->

    <div class="midCont" id="newcnttanpage">
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



    <!-- top curv image starts -->
    <div>
    <span class="topLft_curv"></span>
		
		<div class="gryTop">

		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200",'value'=>$key));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>'btn'));
			?> 
		</span>
		<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/contentlist')" id="locaa"></span>
		<span class="srchBg2"><input type="submit"  value="Update Sequence" id="Submit"></span>
		
                    </div> <span class="topRht_curv"></span>
                    <div class="clear"></div></div>

                    <?php $i=1; ?>  
                    <div class="tblData">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr class="trBg">
   <th align="center" width="10px">#</th>
   <th align="center" width="10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
   <th align="center" width="150px"><span class="right"><?php echo $pagination->sortBy('title', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Title</th>
   <th align="center" width="150px"><span class="right"><?php echo $pagination->sortBy('alias', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span><a> Alias </a></th>
   <th  valign="middle" width="165px"><span class="right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Created Date</th>
   <th  valign="middle" width="165px"><span class="right"><?php echo $pagination->sortBy('modified', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Last Modified Date</th> 
   <th  valign="middle" width="80px">Content</th>
   <th valign="middle" width="70px"><span class="right"><?php echo $pagination->sortBy('file_sequence', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Parent</th>
   <th valign="middle" width="70px"><span class="right"><?php echo $pagination->sortBy('file_sequence', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Child</th>
   <th  valign="middle" width="70px" ><span class="right"><?php echo $pagination->sortBy('modified', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Status</th>
  </tr>
   	<?php if($contentdata){
  
   		foreach($contentdata as $eachrow){
            if($eachrow['Content']['parent_id']==0){
            $recid = $eachrow['Content']['id'];
	
   			$modelname = "Content";
   			$redirectionurl = "contentlist";
   			$isdelflag = true;
   			$issequence = true;
   			$title = $eachrow['Content']['title'];
			if($title){$title =AppController::WordLimiter($title,10);}
   			$alias = $eachrow['Content']['alias'];
			if($eachrow['Content']['parent_id']==0){
   			$file_sequence = $eachrow['Content']['file_sequence'];$file_sequence_child = "N/A";}
			else{$file_sequence_child = $eachrow['Content']['file_sequence'];$file_sequence = "N/A";}
   			$metakeyword='';
   			$metadescription='';
			$createddate=$eachrow['Content']['created'];
			$createddate = AppController::usdateformat($createddate,1);  
			$lastupdated=$eachrow['Content']['modified'];
			$lastupdated = AppController::usdateformat($lastupdated,1);  
  
   			if($eachrow['Content']['metakeyword']){
   				$metakeyword = AppController::WordLimiter($eachrow['Content']['metakeyword'],9);
   			}
			if($eachrow['Content']['parent_id']==0){
    				$type = "Parent";
			}
			else
			{
				$type = "Child";
			}

//    			if($eachrow['Content']['metadescription']){
//    				$metadescription = AppController::WordLimiter($eachrow['Content']['metadescription'],9);
//    			}
   			/*if($eachrow['Content']['content']){
   				$content = AppController::WordLimiter(htmlentities($eachrow['Content']['content']),10);
   			}*/
			$cont1=   '<a href="javascript:void(0)"  title="Click here to view Content." onclick="showcontentwindow('.$recid.');" >Preview</a>';

   			if($eachrow['Content']['is_sytem']=='0'){
				$isdelflag = false;
			}
   			if($eachrow['Content']['alias']=='privacy' || $eachrow['Content']['alias']=='terms'){
				$issequence = false;
			}

   if($alias=="register" || $alias=="login" || $alias=="logout" ||  $alias=="dashboard"  )
                            {
                                continue;
                            }
                            else
                            { 
   		?>
	<?php if($i%2 == 0) { ?>
   	<tr class='altrow'>	
		<td align="center" class='newtblbrd'><?php echo $i++;?></td>
		<td align="center" class='newtblbrd'>
		
			<input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" />
		
		</td>
		<td  align="left"  valign="middle" class='newtblbrd'><a href="/companies/editcontent/<?php echo $recid; ?>"><span><?php if($eachrow['Content']['parent_id']==0){echo $title?$title:"N/A";}else{echo $title?"      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$title:"N/A";} ?></a></span></td>
		<td  align="left" valign="middle" class='newtblbrd'><a href="/companies/editcontent/<?php echo $recid; ?>"><span><?php echo $alias?$alias:"N/A"; ?></a></span></td>
		<!--<td  align="center" valign="middle"><a><span><?php //echo $createddate?$createddate:"N/A"; ?></a></span></td>-->
		<!--<td  align="center" valign="middle"><a><span><?php //echo $type?$type:"N/A"; ?></a></span></td>-->
		<td  align="center" valign="middle" class='newtblbrd'><span><?php echo $createddate?$createddate:"N/A"; ?></span></td>
		<td  align="center" valign="middle" class='newtblbrd'><span><?php echo $lastupdated?$lastupdated:"N/A"; ?></span></td>
		<td  align="center" valign="middle" class='newtblbrd'><?php echo $cont1; ?></td>
		<?php if($issequence==true) {
		if($eachrow['Content']['alias']=='home_page') $readonly="readonly"; else $readonly="";?>
			<?php if($eachrow['Content']['parent_id']==0){ $seq=$file_sequence; ?>
			<td class='newtblbrd' align='center'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly)); 
             echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow['Content']['modified'],'readonly'=>$readonly)); ?>
			</td>
			<td class='newtblbrd' align='center'>
			<?php echo"";echo $form->input("nam1", array('id' => "temp1", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<?php }else{$seq=$file_sequence_child; ?>
			<td class='newtblbrd' align='center'>
			<?php echo"";echo $form->input("nam2", array('id' => "temp2", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<td class='newtblbrd' align='center'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly)); 
             echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow['Content']['modified'],'readonly'=>$readonly));
            }?>
			</td>

		<?php }else{ ?>
		<td class='newtblbrd'>&nbsp;</td>
		<td class='newtblbrd'>&nbsp;</td>

		<?php } if($isdelflag==true){ ?>

		<td align="center" class='newtblbrd' valign="middle"><?php if($eachrow['Content']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $title; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $title; ?>" /></a><?php } ?>
		</td>
		
		<?php }else{  if($eachrow['Content']['alias']!='home_page' && $eachrow['Content']['alias']!='home-page' ){?>
			
		<td align="center" class='newtblbrd' valign="middle"><?php if($eachrow['Content']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $title; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $title; ?>" /></a><?php }?>
		</td>
		<?php } else{ ?>
		<td>&nbsp;</td>
	        <?php } ?>
 		



		<?php } ?>
		</tr>


<?php } else { ?>

	
   	<tr>	
		<td align="center"><?php echo $i++;?></td>
		<td align="center" class='newtblbrd'>
		
			<input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" />
		
		</td>
		<td  align="left"  valign="middle"><a href="/companies/editcontent/<?php echo $recid; ?>"><span><?php if($eachrow['Content']['parent_id']==0){echo $title?$title:"N/A";}else{echo $title?"      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$title:"N/A";} ?></a></span></td>
		<td  align="left" valign="middle"><a href="/companies/editcontent/<?php echo $recid; ?>"><span><?php echo $alias?$alias:"N/A"; ?></a></span></td>
		<!--<td  align="center" valign="middle"><a><span><?php //echo $createddate?$createddate:"N/A"; ?></a></span></td>-->
		<!--<td  align="center" valign="middle"><a><span><?php //echo $type?$type:"N/A"; ?></a></span></td>-->
		<td  align="center" valign="middle"><span><?php echo $createddate?$createddate:"N/A"; ?></span></td>
		<td  align="center" valign="middle"><span><?php echo $lastupdated?$lastupdated:"N/A"; ?></span></td>
		<td  align="center" valign="middle"><?php echo $cont1; ?></td>
		<?php if($issequence==true) {
		if($eachrow['Content']['alias']=='home_page') $readonly="readonly"; else $readonly="";?>
			<?php if($eachrow['Content']['parent_id']==0){ $seq=$file_sequence; ?>
			<td align='center'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly)); 
             echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow['Content']['modified'],'readonly'=>$readonly));  ?>
			</td>
			<td align='center'>
			<?php echo"";echo $form->input("nam1", array('id' => "temp1", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<?php }else{$seq=$file_sequence_child; ?>
			<td align='center'>
			<?php echo"";echo $form->input("nam2", array('id' => "temp2", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<td align='center'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'align:center;width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly)); 
                       echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow['Content']['modified'],'readonly'=>$readonly));
            }?>
			</td>

		<?php }else{ ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>

		<?php } if($isdelflag==true){ ?>

		<td align="center"  valign="middle"><?php if($eachrow['Content']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $title; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $title; ?>" /></a><?php } ?>
		</td>
		
		<?php }else{  if($eachrow['Content']['alias']!='home_page' && $eachrow['Content']['alias']!='home-page' ){?>
			
		<td align="center"  valign="middle"><?php if($eachrow['Content']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $title; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $title; ?>" /></a><?php }?>
		</td>
		<?php } else{ ?>
		<td>&nbsp;</td>
	        <?php } ?>
 		



		<?php } ?>
		</tr>

<?php } 
       }
            }?>


	 <?php
              foreach($contentdata as $eachrow2){
                if($eachrow['Content']['id'] == $eachrow2['Content']['parent_id'])
                {

                    //echo $eachrow['Content']['title'];
            $recid = $eachrow2['Content']['id'];
   			$modelname = "Content";
   			$redirectionurl = "contentlist";
   			$isdelflag = true;
   			$issequence = true;
   			$title = $eachrow2['Content']['title'];
			if($title){$title =AppController::WordLimiter($title,10);}
   			$alias = $eachrow2['Content']['alias'];
			if($eachrow2['Content']['parent_id']==0){
   			$file_sequence = $eachrow2['Content']['file_sequence'];$file_sequence_child = "N/A";}
			else{$file_sequence_child = $eachrow2['Content']['file_sequence'];$file_sequence = "N/A";}
			$createddate=$eachrow2['Content']['created'];
			$createddate = AppController::usdateformat($createddate,1); 
			$lastupdated=$eachrow2['Content']['modified'];
   			$lastupdated = AppController::usdateformat($lastupdated,1);
			$metakeyword='';
   			$metadescription='';
   			if($eachrow2['Content']['metakeyword']){
   				$metakeyword = AppController::WordLimiter($eachrow2['Content']['metakeyword'],9);
   			}
			if($eachrow2['Content']['parent_id']==0){
    				$type = "Parent";
			}
			else
			{
				$type = "Child";
			}

//    			if($eachrow['Content']['metadescription']){
//    				$metadescription = AppController::WordLimiter($eachrow['Content']['metadescription'],9);
//    			}
   			/*if($eachrow['Content']['content']){
   				$content = AppController::WordLimiter(htmlentities($eachrow['Content']['content']),10);
   			}*/
			$cont1=   '<a href="javascript:void(0)"  title="Click here to view Content." onclick="showcontentwindow('.$recid.');" >Preview</a>';

   			if($eachrow2['Content']['is_sytem']=='0'){
				$isdelflag = false;
			}
   			if($eachrow2['Content']['alias']=='privacy' || $eachrow2['Content']['alias']=='terms'){
				$issequence = false;
			}

   		?>
	<?php if($i%2 == 0) { ?>
   	<tr class='altrow'>
   		<td  align="center" valign="middle" class='newtblbrd'><?php echo $i++;?></td>
		<td  align="center" valign="middle" class='newtblbrd'><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid ?>" /></td>
		<td   align="left" valign="middle" class='newtblbrd'><a href="/companies/editcontent/<?php echo $recid; ?>"><span class="for_SubCat"><?php if($eachrow2['Content']['parent_id']==0){echo $title?$title:"N/A";}else{echo $title?$title:"N/A";} ?></a></span></td>
		<td   align="left" valign="middle" class='newtblbrd'><a href="/companies/editcontent/<?php echo $recid; ?>"><span><?php echo $alias?$alias:"N/A"; ?></a></span></td>
		<!--<td   align="center" valign="middle"><a><span><?php //echo $metakeyword?$metakeyword:"N/A"; ?></a></span></td>-->
		<!--<td   align="center" valign="middle"><a><span><?php //echo $type?$type:"N/A"; ?></a></span></td>-->
		<td  align="center" valign="middle" class='newtblbrd'><span><?php echo $createddate?$createddate:"N/A"; ?></span></td>
		<td  align="center" valign="middle" class='newtblbrd'><span><?php echo $lastupdated?$lastupdated:"N/A"; ?></span></td>
		<td   align="center" valign="middle" class='newtblbrd'><?php echo $cont1; ?></td>
		<?php if($issequence==true) {
		if($eachrow2['Content']['alias']=='home_page') $readonly="readonly"; else $readonly="";?>
			<?php if($eachrow2['Content']['parent_id']==0){ $seq=$file_sequence; ?>
			<td align='center'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "align:'center';contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly)); 
             echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow2['Content']['modified'],'readonly'=>$readonly));
            ?>
			</td>
			<td align='center' class='newtblbrd'>
			<?php echo"";echo $form->input("nam1", array('id' => "temp1", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<?php }else{$seq=$file_sequence_child; ?>
			<td align='center' class='newtblbrd'>
			<?php echo"";echo $form->input("nam2", array('id' => "temp2", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<td align='center' class='newtblbrd'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly));
             echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow2['Content']['modified'],'readonly'=>$readonly));
            }?>
			</td>
		<?php }else{ ?>
		<td>&nbsp;</td>
		<?php } if($isdelflag==true){ ?>

		<td align="center" valign="middle" class='newtblbrd'><?php if($eachrow2['Content']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $title; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $title; ?>" /></a><?php } ?>
		</td>
		
		<?php }else{ ?>
		<td  valign="middle">System</td>
		<td  valign="middle">
		<?php
		if($eachrow2['Content']['title']!='COMMENTS'){
		?>
		
		<?php }?>
		</td>

		<?php } ?>
		</tr>

		<?php }else{ ?>
		<tr>
   		<td  align="center" valign="middle"><?php echo $i++;?></td>
		<td  align="center" valign="middle" class='newtblbrd'><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid ?>" /></td>
		<td   align="left" valign="middle"><a href="/companies/editcontent/<?php echo $recid; ?>"><span class="for_SubCat"><?php if($eachrow2['Content']['parent_id']==0){echo $title?$title:"N/A";}else{echo $title?$title:"N/A";} ?></a></span></td>
		<td   align="left" valign="middle"><a href="/companies/editcontent/<?php echo $recid; ?>"><span><?php echo $alias?$alias:"N/A"; ?></a></span></td>
		<!--<td   align="center" valign="middle"><a><span><?php //echo $metakeyword?$metakeyword:"N/A"; ?></a></span></td>-->
		<!--<td   align="center" valign="middle"><a><span><?php //echo $type?$type:"N/A"; ?></a></span></td>-->
		<td  align="center" valign="middle"><span><?php echo $createddate?$createddate:"N/A"; ?></span></td>
		<td  align="center" valign="middle"><span><?php echo $lastupdated?$lastupdated:"N/A"; ?></span></td>
		<td   align="center" valign="middle"><?php echo $cont1; ?></td>
		<?php if($issequence==true) {
		if($eachrow2['Content']['alias']=='home_page') $readonly="readonly"; else $readonly="";?>
			<?php if($eachrow2['Content']['parent_id']==0){ $seq=$file_sequence; ?>
			<td align='center'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "align:'center';contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly)); 
             echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow2['Content']['modified'],'readonly'=>$readonly));
            ?>
			</td>
			<td align='center'>
			<?php echo"";echo $form->input("nam1", array('id' => "temp1", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<?php }else{$seq=$file_sequence_child; ?>
			<td align='center'>
			<?php echo"";echo $form->input("nam2", array('id' => "temp2", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"",'readonly'=>'readonly')); ?>
			</td>
			<td align='center'>
			<?php echo $form->input("$recid", array('id' => "dispanysec_$recid", 'div' => false, 'label' => '','style'=>'width:20px;',"class" => "contactInput","maxlength" => "2",'value'=>"$seq",'readonly'=>$readonly)); 
             echo $form->hidden("mdate_$recid", array('id' => "mdate_$recid", 'div' => false, 'label' => '','value'=>$eachrow2['Content']['modified'],'readonly'=>$readonly));
            }?>
			</td>

		<?php }else{ ?>
		<td>&nbsp;</td>
		<?php } if($isdelflag==true){ ?>

		<td align="center" valign="middle"><?php if($eachrow2['Content']['active_status']=='1'){ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/<?php echo $project_name; ?>/active.gif" alt="" title="Click here to deactivate <?php echo $title; ?>" /></a><?php }else{ ?><a href="/companies/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/<?php echo $project_name; ?>/deactive.gif" alt=""  title="Click here to activate <?php echo $title; ?>" /></a><?php } ?>
		</td>
		
		<?php }else{ ?>
		<td  valign="middle">System</td>
		<td  valign="middle">
		<?php
		if($eachrow2['Content']['title']!='COMMENTS'){
		?>
		
		<?php }?>
		</td>

		<?php } ?>
		</tr>

		<?php }?>
               <?php }?>

           <?php }
 } ?>
	 <tr><td colspan='8'>&nbsp;</td></tr>
	 <?php  }else{ ?>
	<tr><td colspan="7" align="center">No Contacts Found.</td></tr>
	<?php  } ?>
	</table>
	

</div>

                    <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot"><?php if($contentdata) { echo $this->renderElement('newpagination'); } ?>
                    </div>
                    <!--inner-container ends here-->
        

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->
<?php echo $form->end();?>




<div class="clear"></div><!--container ends here-->
                    </div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newcnttanpage").className = "newmidCont";
	}	
</script>
