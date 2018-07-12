<script type="text/javascript">
$(document).ready(function() {
$('#EmailMnu').removeClass("butBg");
$('#EmailMnu').addClass("butBgSelt");
}); 
</script> 
<?php 	
$base_url = Configure::read('App.base_url');
?>
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
                        document.getElementById("linkedit").href=baseUrl+"mailtasks/editmailcontent/"+id; 
                        
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
                                                        window.location=baseUrl+"mailtasks/changestatus/"+id+"/EmailTemplate/1/eventresponders/cngstatus";
                                                        }else{
                                                        window.location=baseUrl+"mailtasks/changestatus/"+id+"/EmailTemplate/0/eventresponders/cngstatus";
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                                        window.location=baseUrl+"eventresponders/changestatus/"+id+"/EmailTemplate/0/eventautoresponders/delete";
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
<div class="titlCont"><div class="centerPage">
<div align="center" class="slider" id="toppanel">
     <?php  echo $this->renderElement('new_slider');  ?> 
</div>
 <?php echo $form->create("mailtasks", array("action" => "eventresponders",'type' => 'file','enctype'=>'multipart/form-data','name' => 'contentlist', 'id' => "eventresponders"))?>
<span class="titlTxt">Event AutoResponse </span>
<div class="topTabs">
<ul class="dropdown">
<li>
	<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'mailtasks','action'=>'addmailtemplate','event'),
					array('escape' => false)
					)
				);
?>
</li>
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


<div class="clear"></div>
  
          <?php   $this->eventresponders="tabSelt";
               echo $this->renderElement('superemail_submenu');  ?>
             
</div></div>

<!--inner-container starts here-->
                            <div class="midCont" id="newmailtemptab">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


                            <!-- top curv image starts -->
                            <div>
                            <span class="topLft_curv"></span>
							<span class="topRht_curv"></span>
                <div class="gryTop">
				<div class="new_filert">
                 <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                                
                        ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url ?>mailtasks/eventresponders')" id="locaa"></span>
              
                        </div> 
					</div>	
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="trBg">
    <th align="center" width="2%">#</th>
    <th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
    <th align="center" valign="middle" style="width:20%;"><span class="right"><?php echo $pagination->sortBy('email_template_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Template Name</th>
    <th align="center" valign="middle" style="width:20%;"><span class="right"><?php echo $pagination->sortBy('is_event_temp', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Template Type</th>
    <th align="center" valign="middle" style="width:28%;"><span class="right"><?php echo $pagination->sortBy('subject', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Subject</th>
    <th align="center" valign="middle" style="width:13%px;">Mail Content</th>
    <th align="center" valign="middle" style="width:12%px;"><span class="right"><?php echo $pagination->sortBy('is_sytem', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

      </tr>
        <?php if($emailtemplates){
       
                        foreach($emailtemplates as $eachrow){
                        $recid = $eachrow['EmailTemplate']['id'];
                        $modelname = "EmailTemplate";
                        $redirectionurl = "eventautoresponders";
                        $isdelflag = true;
                        $tempname = $eachrow['EmailTemplate']['email_template_name'];
                        if($tempname)   $tempname = AppController::WordLimiter($tempname,41);
                        $tempsubject = $eachrow['EmailTemplate']['subject'];
                        if($tempsubject)        $tempsubject = AppController::WordLimiter($tempsubject,41);
                        $cont1=   '<a href="javascript:void(0)"  title="Click here to view mail template." onclick="showcontentwindow('.$recid.');" ><span>Preview<span></a>';
                        
                        if($eachrow['EmailTemplate']['is_sytem']=='0'){
                                $isdelflag = false;
                        }       
                        
                        if($eachrow['EmailTemplate']['is_event_temp']=='1')
                            $temptype="RSVP";
                        else
                        if($eachrow['EmailTemplate']['is_event_temp']=='2')
                            $temptype="Waitlist";
                        else
                        if($eachrow['EmailTemplate']['is_event_temp']=='3')
                            $temptype="Invite";
                        
                        
                ?>
	<?php if($i%2 == 0) { ?>

        <tr class='altrow'>    
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle" class='newtblbrd'>				
					<?php
						e($html->link(
						$html->tag('span', ($tempname)?$tempname:"N/A"),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>

				</td>
                <td align="left" valign="middle" class='newtblbrd'>
					

					<?php
						e($html->link(
						$html->tag('span', ($temptype)?$temptype:"N/A"),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>
				</td>
                <td align="left" valign="middle" class='newtblbrd'>
					<?php
						e($html->link(
						$html->tag('span', ($tempsubject)?$tempsubject:"N/A"),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>

				</td>
                <td align="center" valign="middle"  class='newtblbrd' >
					<?php
						e($html->link(
						$html->tag('span', $cont1),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>
				</td>
                <?php //if($isdelflag==true){ ?>
                <td align="center" valign="middle" class='newtblbrd'>
				
				<?php if($eachrow['EmailTemplate']['active_status']=='1'){ 
				e($html->link(
								$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$current_project_name)),
								array('controller'=>'mailtasks','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
				}else{
						e($html->link(
								$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$tempname)),
								array('controller'=>'mailtasks','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
				}
				?>
		</td>
            
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
						$html->tag('span',  ($tempname)?$tempname:"N/A"),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>

				</td>
                <td align="left" valign="middle" class='newtblbrd'>
				<?php
						e($html->link(
						$html->tag('span',  ($temptype)?$temptype:"N/A"),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>

				</td>
                <td align="left" valign="middle">
					<?php
						e($html->link(
						$html->tag('span',  ($tempsubject)?$tempsubject:"N/A"),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>

				</td>
                <td align="center" valign="middle" >
				<?php
						e($html->link(
						$html->tag('span',  $cont1),
						array('controller'=>'mailtasks','action'=>'editmailcontent','edit',$recid),
						array('escape' => false)
						)
					);
				?>


				</td>
                <?php //if($isdelflag==true){ ?>
                <td align="center" valign="middle">
					<?php if($eachrow['EmailTemplate']['active_status']=='1'){ 
						e($html->link(
								$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$current_project_name)),
								array('controller'=>'mailtasks','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
				}else{
						e($html->link(
								$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$tempname)),
								array('controller'=>'mailtasks','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
				}
					?>
			</td>
            
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
<script language='javascript'>
        function showcontentwindow(id){
                var url = baseUrlAdmin+'showcontentwindow/'+id+'/EmailTemplate';          
                jQuery.facebox({ ajax: url });
        }
</script>
    </div>
    
        <div class="clear"></div>
</div>   
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newmailtemptab").className = "newmidCont";
	}	
</script>