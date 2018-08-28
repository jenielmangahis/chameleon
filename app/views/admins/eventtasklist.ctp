<?php $pagination->setPaging($paging);
$base_url = Configure::read('App.base_url');
$base_url_admin = Configure::read('App.base_url_admin');
?> 
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
                document.getElementById("linkedit").href=baseUrlAdmin+"event_task/<?php echo $rec_event_id;?>/"+id; 
                
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
                                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommunicationTask/1/eventtasklist/cngstatus/0/<?php echo $rec_event_id;?>";
                                                        }else{
                                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommunicationTask/0/eventtasklist/cngstatus/0/<?php echo $rec_event_id;?>";
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommunicationTask/0/eventtasklist/delete/0/<?php echo $rec_event_id;?>";
                                        }
                        }else{
                                alert('Please atleast one record should be select'); 
                                return false;
                        }
                }
</script>



<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container clearfix">
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">            	
                <h2>Event Email Tasks List</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Admins", array("action" => "eventtasklist",'name' => 'eventtasklist', 'id' => "eventtasklist")) ?>
					<script type='text/javascript'>
                            function setprojectid(projectid){
                                            document.getElementById('projectid').value= projectid;
                                            document.adminhome.submit();
                                    }
                    </script>
                    <?php e($html->link($html->image('new.png') . ' ',array('controller'=>'admins','action'=>'event_task',$rec_event_id),array('escape' => false))); ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
                    <a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><?php e($html->image('edit.png')); ?></a>   
                    <?php  echo $this->renderElement('new_slider');  ?>                 
                </div>
                
            </div>
            <div class="topTabs" style="height:25px;">
<?php /*?><ul class="dropdown">
<li>

	<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'event_task',$rec_event_id),
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
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
                        </ul>
</li>
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
</ul><?php */?>
</div>
			<div class="clear"><img src="<?php echo $base_url ?>img/spacer.gif" width="1" height="12px;" /></div>
        </div>
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="admins";    $this->subtabsel="eventtasklist";
		echo $this->renderElement('events_submenus');
		?>   
    </div>
</div>

<div class="midCont" id="newcmmtasktab">
<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;  position: absolute;   z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>

                            <!-- top curv image starts -->
                            <div>
                            <!--<span class="topLft_curv"></span>
                            <span class="topRht_curv"></span>-->
                
                <div class="gryTop">
               
               <div class="new_filter ">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200",'value'=>(isset($key))?$key:''));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>'btn'));
                        ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>eventtasklist/<?php echo $rec_event_id;?>')" id="locaa"></span>
                
                        </div> 
                        <div class="clear"></div>
                        </div></div>

                        <?php $i=1; ?>  
                        <div class="tblData table-responsive">
        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
        <th align="center" style="width:2%;">#</th>
        <th align="center" style="width:3%;"><input type="checkbox" value="" name="checkall" id="checkall" /></th>      
        <th align="center" valign="middle" style="width:16%;"><span class="right"><?php echo $pagination->sortBy('task_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Task Name</th> 
        <th align="center" valign="middle" style="width:16%;"><span class="right"><?php echo $pagination->sortBy('rec_event_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Event Name</th>           
        <th align="center" valign="middle" style="width:16%;"><span class="right"><?php echo $pagination->sortBy('email_template_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Email Template</th>      
        <th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('recur_pattern', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date Sent</th>      
        <th align="center" valign="middle" style="width:10%;"><span class="right"><?php echo $pagination->sortBy('task_next_execution_date', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Time Sent</th>      
              
        <th align="center" valign="middle" style="width:10%;"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th> 

        </tr>
        <?php
                if($taskdata){
                    $alt=0;
                        foreach($taskdata as $eachrow){
                            if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                        $recid = $eachrow['CommunicationTask']['id'];
                        $rec_event_id=$eachrow['CommunicationTask']['rec_event_id'];
                        $modelname = "CommunicationTask";
                        $redirectionurl = "eventtasklist";
                        $company_task_id = $eachrow['CommunicationTask']['id'];
                        $task_name= $eachrow['CommunicationTask']['task_name'];
                        $task_email_tempname= $eachrow['EmailTemplate']['email_template_name'];
                        $date_sent=date('m-d-Y',strtotime($eachrow['CommunicationTask']['task_startdate']));    
                        $time_sent=date('h:m a',strtotime($eachrow['CommunicationTask']['task_startdate']));
                        $event_name=$eachrow['Event']['title'];                   

                ?>
                <tr <?php echo $class;?>>  
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle" class='newtblbrd'>
						<?php
								e($html->link(
									$html->tag('span', $task_name),
									array('controller'=>'admins','action'=>'event_task',$rec_event_id,$recid),
									array('escape' => false)
									)
								);
						?>
				</td>   
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
								e($html->link(
									$html->tag('span', $event_name),
									array('controller'=>'admins','action'=>'event_task',$rec_event_id,$recid),
									array('escape' => false)
									)
								);
						?>

				</td>            
                <td align="left" valign="middle" class='newtblbrd'>
					<?php
							e($html->link(
								$html->tag('span', $task_email_tempname),
								array('controller'=>'admins','action'=>'event_task',$rec_event_id,$recid),
								array('escape' => false)
								)
							);
						?>

				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					<?php
							e($html->link(
								$html->tag('span', $date_sent),
								array('controller'=>'admins','action'=>'event_task',$rec_event_id,$recid),
								array('escape' => false)
								)
							);
						?>

				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					<?php
							e($html->link(
								$html->tag('span', $time_sent),
								array('controller'=>'admins','action'=>'event_task',$rec_event_id,$recid),
								array('escape' => false)
								)
							);
						?>

				</td>              
                             
               <td align="center" valign="middle" class='newtblbrd'>
				<a><span><?php if($eachrow['CommunicationTask']['active_status']=='1'){ 
				 e(
								$html->link(
									$html->image('active.gif',array('title'=>'Click here to deactivate '.$task_name)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus','0',$rec_event_id),
									array('escape'=>false)
								)
							);
						}else {

						e(
							$html->link(
									$html->image('deactive.gif',array('title'=>'Click here to activate '.$coinsetname)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus','0',$rec_event_id),
									array('escape'=>false)
								)
							);
						}  
					?>
				 </td>       
                </tr>
	<?php 

         } } else{ ?>
        <tr><td colspan="9" align="center">No Event Task Found.</td></tr>
        <?php } ?>
        </table>
        
    

  </div>

      <div>
      <!--<span class="botLft_curv"></span>
       <span class="botRht_curv"></span>-->
      <div class="gryBot"><?php echo $this->renderElement('newpagination');  ?>
      </div>
      <!--inner-container ends here-->
        

     
      <div class="clear"></div>
      </div>
      <?php echo $form->end();?>




<div class="clear"></div>
    </div>
    
         <div class="clear"></div>
</div>      
    
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newcmmtasktab").className = "newmidCont";
	}	
</script>