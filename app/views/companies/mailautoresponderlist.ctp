<?php $pagination->setPaging($paging); ?> 
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
			return false;
			}else{	
			document.getElementById("linkedit").href=baseUrl+"companies/editmailcontent/edit/"+id;  		
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
							window.location=baseUrl+"companies/changestatus/"+id+"/EmailTemplate/1/mailautoresponderlist/cngstatus";
							}else{
							window.location=baseUrl+"companies/changestatus/"+id+"/EmailTemplate/0/mailautoresponderlist/cngstatus";
							}
					}
					if(op=="del"){
					if(confirm("You have selected "+count+" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
					window.location=baseUrl+"companies/changestatus/"+id+"/EmailTemplate/0/mailautoresponderlist/delete";
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
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>
 </div>
        <?php echo $form->create("Company", array("action" => "mailautoresponderlist",'type' => 'file','enctype'=>'multipart/form-data','name' => 'contentlist', 'id' => "mailautoresponderlist"))?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
        </script>
<span class="titlTxt">
Auto Responders
</span>

<div class="topTabs">
<ul class="dropdown">
<!-- <li><a href="/companies/addmailtemplate"><span>New</span></a></li> -->
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
        			 <!--li><a href="javascript:void(0)">Copy</a></li-->
        			 <!-- <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li> -->
                     <li class="botCurv"></li>
        		</ul>
</li>
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
</ul>
</div>


     <?php    $this->loginarea="companies";    $this->subtabsel="mailautoresponderlist";
             echo $this->renderElement('emails_submenus');  ?>   
</div></div>

<!--inner-container starts here-->
                            <div class="midCont" id="newmaillisttab">

  <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


                            <!-- top curv image starts -->
                            <div>
                            <span class="topLft_curv"></span>
		<div class="gryTop">

		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
				
			?> 
		</span>
		<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/mailautoresponderlist')" id="locaa"></span>
		
                        </div> <span class="topRht_curv"></span>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr class="trBg">
   <th align="center" width="1%">#</th>
   <th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
   <th align="center" valign="middle" style="width:25%;"><span class="right"><?php echo $pagination->sortBy('email_template_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Template Name</th>
   <th align="center" valign="middle" style="width:25%;"><span class="right"><?php echo $pagination->sortBy('subject', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Subject</th>
   <th align="center" valign="middle" style="width:10%;">Mail Content</th>
   <th align="center" valign="middle" style="width:8%;"><span class="right"><?php echo $pagination->sortBy('is_sytem', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Status</th>
   </tr>
   	<?php if($emailtemplates){
   	
   			foreach($emailtemplates as $eachrow){
   			$recid = $eachrow['EmailTemplate']['id'];
   			$modelname = "EmailTemplate";
   			$redirectionurl = "mailautoresponderlist";
   			$isdelflag = true;
   			$tempname = $eachrow['EmailTemplate']['email_template_name'];
			if($tempname)	$tempname = AppController::WordLimiter($tempname,41);
   			$tempsubject = $eachrow['EmailTemplate']['subject'];
			if($tempsubject)	$tempsubject = AppController::WordLimiter($tempsubject,41);
   			
   			
			$cont1=   '<a href="javascript:void(0)"  title="Click here to view mail template." onclick="showcontentwindow('.$recid.');" ><span>Preview<span></a>';
			
			if($eachrow['EmailTemplate']['is_sytem']=='0'){
				$isdelflag = false;
			}	
			
   		?>
	<?php if($i%2 == 0) { ?>
   	 <tr class='altrow'>    
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', ($tempname)?$tempname:"N/A"),
							array('controller'=>'companies','action'=>'editmailcontent','edit',$recid),
							array('escape' => false)
							)
						);
						?>

				</td>
                <td align="left" valign="middle" class='newtblbrd'>
				
					
					<?php
						e($html->link(
							$html->tag('span', ($tempsubject)?$tempsubject:"N/A"),
							array('controller'=>'companies','action'=>'editmailcontent','edit',$recid),
							array('escape' => false)
							)
						);
						?>
				</td>
                <td align="center" valign="middle"  class='newtblbrd' >
				
					<?php
						e($html->link(
							$html->tag('span', $cont1),
							array('controller'=>'companies','action'=>'editmailcontent','edit',$recid),
							array('escape' => false)
							)
						);
						?>
				</td>
                <?php //if($isdelflag==true){ ?>
                <td align="center" valign="middle" class='newtblbrd'>
					<?php if($eachrow['EmailTemplate']['active_status']=='1'){
							e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$tempname)),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}else{
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$tempname)),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
									array('escape' => false)
									)
								);
							}
					?></td>
            
                <?php //}else{ ?>
                <!-- td align="center" valign="middle" class='newtblbrd'><a><span>System</a></span></td> -->
        
                </tr>
	<?php } else { ?>

	<tr>    
                <td align="center"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle">
					
					<?php
						e($html->link(
							$html->tag('span', ($tempname)?$tempname:"N/A"),
							array('controller'=>'companies','action'=>'editmailcontent','edit',$recid),
							array('escape' => false)
							)
						);
						?>
				</td>
                <td align="left" valign="middle">
				
					<?php
						e($html->link(
							$html->tag('span', ($tempsubject)?$tempsubject:"N/A"),
							array('controller'=>'companies','action'=>'editmailcontent','edit',$recid),
							array('escape' => false)
							)
						);
						?>

				</td>
                <td align="center" valign="middle" >
					<?php
						e($html->link(
							$html->tag('span', $cont1),
							array('controller'=>'companies','action'=>'editmailcontent','edit',$recid),
							array('escape' => false)
							)
						);
						?>
				</td>
                <?php //if($isdelflag==true){ ?>
                <td align="center" valign="middle">
					<?php if($eachrow['EmailTemplate']['active_status']=='1'){
						e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$tempname)),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}else{
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$tempname)),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
									array('escape' => false)
									)
								);
							}
					?></td>
            
                <?php //}else{ ?>
                <!-- td align="center" valign="middle"><a><span>System</a></span></td> -->
            

                <?php // } ?>
                </tr>



	<?php } ?>
	 <?php } }else{ ?>
	<tr><td colspan="7" align="center">No Mail Template Found.</td></tr>
	<?php  } ?>
	</table>
	
	
 </div>
     <div>
     <span class="botLft_curv"></span>
<div class="gryBot">
<?php if($emailtemplates) { echo $this->renderElement('newpagination'); } ?>
     </div>  <span class="botRht_curv"></span>
     <div class="clear"></div>
     </div>
<!--inner-container ends here-->
<?php echo $form->end();?>




<div class="clear"></div>
  <!-- Body Panel ends --> 
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newmaillisttab").className = "newmidCont";
	}	
</script>
<script language='javascript'>
	function showcontentwindow(id){

		var url = baseUrl+'companies/showcontentwindow/'+id+'/EmailTemplate';		
		jQuery.facebox({ajax:url });
	}
</script>
    </div>