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
                document.getElementById("linkedit").href=baseUrl+"mailtasks/addmailtask/edit/"+id; 
                
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
                                                        window.location=+"changestatus/"+id+"/CommunicationTask/1/commtasklist/cngstatus";
                                                        }else{
                                                        window.location=+"changestatus/"+id+"/CommunicationTask/0/commtasklist/cngstatus";
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                                        window.location="changestatus/"+id+"/CommunicationTask/0/commtasklist/delete";
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
            <h2>Active Email Tasks</h2>
        </div>
        
        <div class=" slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Mailtasks", array("action" => "activetasklist",'name' => 'activetasklist', 'id' => "activetasklist")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
                            
				<?php
                e($html->link($html->image('new.png') . ' ','addmailtask',array('escape' => false)));
                ?>
                <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"> <?php e($html->image('action.png')) ?></a>
                <a href="javascript:void(0)" onclick="editcontent();" id="linkedit">
                <?php e($html->image('edit.png')) ?></a>                
            </div>
            <?php echo $this->renderElement('new_slider');?>
        </div>
        
        <div class="topTabs" style="height:25px;">
			<?php /*?><ul class="dropdown">
            <li>
            <?php
                //e($html->link(
            //		$html->tag('span', 'New'),
            //		array('controller'=>'mailtasks','action'=>'addmailtask'),
            //		array('escape' => false)
            //		)
            //	);
            
            
            ?>
            
            </li>
            <li><a href="javascript:void(0)" class="tab2"> <span>Actions</span></a>
            <ul class="sub_menu">
                                             <!--li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                             <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li-->
                                             <!--li><a href="javascript:void(0)">Copy</a></li-->
                                             <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                                 <li class="botCurv"></li>
                                    </ul>
            </li>
            <li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
            </ul><?php */?>
        </div>
        
    </div>

</div>
    
    
    
<div class="clearfix nav-submenu-container">
    <div class="midCont">
	 <?php    $this->loginarea="mailtasks";    $this->subtabsel="activetasklist";

            if($this->params['pass'][0] === '0'){
                echo $this->renderElement('emails_submenus'); 
            }
            elseif($_GET['url'] === 'mailtasks/activetasklist/2'){
             echo $this->renderElement('memberlistsecondlevel_submenus');  
            }
            else{
                        echo $this->renderElement('email_menu'); 
            }
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
               	<div class="new_filter" >
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>'btn'));
                        ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'mailtasks/activetasklist')" id="locaa"></span>
                
                        </div> </div>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
        <table class="table table-striped table-bordered" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
        <th align="center" style="width:2%;">#</th>
        <th align="center" style="width:3%;"><input type="checkbox" value="" name="checkall" id="checkall" /></th>      
        <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('task_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Mail Tasks</th>      
        <th align="center" valign="middle" style="width:16%;"><span class="right"><?php echo $pagination->sortBy('email_template_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Related Template</th>      
        <th align="center" valign="middle" style="width:30%;"><span class="right"><?php echo $pagination->sortBy('recur_pattern', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Recur Pattern</th>      
        <th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('task_next_execution_date', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Next Send</th>      
        <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('task_last_execution_date', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Last Sent</th>      
        <th align="center" valign="middle"style="width:8%;"><span class="right"><?php echo $pagination->sortBy('task_execution_count', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Sent #</th>      
        <!-- <th align="center" valign="middle" style="width:70px;"><span class="right">< ?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Status</th> -->

        </tr>
        <?php
                if($taskdata){
                        foreach($taskdata as $eachrow){
                        $recid = $eachrow['CommunicationTask']['id'];
                        $modelname = "CommunicationTask";
                        $redirectionurl = "commtasklist";
                        $company_task_id = $eachrow['CommunicationTask']['id'];
                        $task_name= $eachrow['CommunicationTask']['task_name'];
                        $task_email_tempname= $eachrow['EmailTemplate']['email_template_name'];
                        $task_recur_pattern= $eachrow['CommunicationTask']['recur_pattern'];
                        $recurOn="";
                        $templatetypearrary = array('0'=>'Member','1'=>'Player','2'=>'players','3'=>'Offer');
                        $templatetype = $templatetypearrary[$eachrow['CommunicationTask']['email_template_type']];
                        $modified = date("m-d-Y", strtotime($eachrow['CommunicationTask']['modified']));
                        if($task_recur_pattern=="Daily"){
                              $recurOn =" Occurs every ";
                              if($eachrow['CommunicationTask']['daily_pattern']=="everyday"){
                                    $recurOn.=$eachrow['CommunicationTask']['daily_every_noof_days']." days";   
                              }else{
                                    $recurOn.="weekday"; 
                              }
                        }else if($task_recur_pattern=="Weekly"){
                            $recurOn =" Occurs every ".$eachrow['CommunicationTask']['weekly_every_noof_weeks']." week(s) on ";
                            $recurOnday="";
                            if($eachrow['CommunicationTask']['weekly_monday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                    $recurOnday.="Mon";
                            }
                             if($eachrow['CommunicationTask']['weekly_tuesday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                    $recurOnday.="Tue";
                            }
                             if($eachrow['CommunicationTask']['weekly_wednesday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                    $recurOnday.="Wed";
                            }
                             if($eachrow['CommunicationTask']['weekly_thursday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                    $recurOnday.="Thu";
                            }
                             if($eachrow['CommunicationTask']['weekly_friday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                    $recurOnday.="Fri";
                            }
                            
                            if($eachrow['CommunicationTask']['weekly_saturday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                    $recurOnday.="Sat";
                            }
                            
                            if($eachrow['CommunicationTask']['weekly_sunday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                    $recurOnday.="Sun";
                            }
                            $recurOn .=$recurOnday;
                            
                            
                            
                        }else if($task_recur_pattern=="Monthly"){
                               if($eachrow['CommunicationTask']['monthly_pattern']=="dayofeverymonth"){
                                    $recurOn.=" Occurs every day ".$eachrow['CommunicationTask']['monthly_onof_day']." of every ".$eachrow['CommunicationTask']['monthly_every_noof_months']." months";   
                              }else{
                                    $recurOn.=" Occurs every the ".$eachrow['CommunicationTask']['monthly_weeknumber']." ".$eachrow['CommunicationTask']['monthly_weekday']." of every ".$eachrow['CommunicationTask']['monthly_weekof_noof_months']." months";    
                              }                                                                           
                        }else if($task_recur_pattern=="Yearly"){
                              if($eachrow['CommunicationTask']['yearly_pattern']=="everynoofmonths"){
                                    $recurOn.=" Occurs every ".$eachrow['CommunicationTask']['yearly_everymonth']." ".$eachrow['CommunicationTask']['yearly_everymonth_date'];
                              }else{
                                    $recurOn.=" Occurs every the ".$eachrow['CommunicationTask']['yearly_weeknumber']." ".$eachrow['CommunicationTask']['yearly_weekday']." of ".$eachrow['CommunicationTask']['yearly_weekof_month'];    
                              }                                                                           
                        }
                        
                        $recurOn.=" effective from ".date("m-d-Y", strtotime($eachrow['CommunicationTask']['task_startdate']));
                        if($eachrow['CommunicationTask']['task_next_execution_date']=="0000-00-00 00:00:00" || $eachrow['CommunicationTask']['task_next_execution_date']==""){
                             $task_next_send= "NA"; //"00-00-0000";  
                        }else{
                             $task_next_send= date("m-d-Y", strtotime($eachrow['CommunicationTask']['task_next_execution_date']));     
                        }
                       
                        if($eachrow['CommunicationTask']['task_last_execution_date']=="0000-00-00 00:00:00" || $eachrow['CommunicationTask']['task_last_execution_date']==""){
                             $task_last_sent= "NA"; //"00-00-0000";  
                        }else{
                             $task_last_sent= date("m-d-Y", strtotime($eachrow['CommunicationTask']['task_last_execution_date']));  
                        }
                        
                        $task_sent_count= $eachrow['CommunicationTask']['task_execution_count'];
                        if($task_name)   $task_name = AppController::WordLimiter($task_name,70);
                        
                        if($eachrow['CommunicationTask']['task_is_done']=="1"){
                              $task_next_send="Completed";
                        }
                ?>
	<?php if($i%2 == 0) { ?>
        <tr class='altrow'>    
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle" class='newtblbrd'>
				<?php
						e($html->link(
							$html->tag('span', $task_name),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $task_email_tempname),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
				<?php
						e($html->link(
							$html->tag('span', $task_recur_pattern.": ".$recurOn),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					<?php
						e($html->link(
							$html->tag('span', $task_next_send),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $task_last_sent),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
                <td align="center" valign="middle" align="center" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $task_sent_count),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
               <!--  <td align="center" valign="middle" class='newtblbrd'><a><span>< ?php if($eachrow['CommunicationTask']['active_status']=='1'){ ?><a href="/mailtasks/changestatus/< ?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/< ?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate < ?php echo $coinsetname; ?>" /></a>< ?php }else{ ?><a href="/mailtasks/changestatus/< ?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/< ?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate < ?php echo $coinsetname; ?>" /></a>< ?php } ?></td>-->
                
        
                </tr>
	<?php } else { ?>

	<tr>    
                <td align="center"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle">

					<?php
						e($html->link(
							$html->tag('span', $task_name),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>

				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $task_email_tempname),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $task_recur_pattern.": ".$recurOn),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>

				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $task_next_send),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					<?php
						e($html->link(
							$html->tag('span', $task_last_sent),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
					
				</td>              
                <td align="center" valign="middle" align="center" class='newtblbrd'>
					<?php
						e($html->link(
							$html->tag('span', $task_sent_count),
							array('controller'=>'mailtasks','action'=>'addmailtask','edit',$recid),
							array('escape' => false)
							)
						);
				?>
					

				</td>              
               <!--  <td align="center" valign="middle" class='newtblbrd'><a><span>< ?php if($eachrow['CommunicationTask']['active_status']=='1'){ ?><a href="/mailtasks/changestatus/< ?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/< ?php echo $project_name?>/active.gif" alt="" title="Click here to deactivate < ?php echo $coinsetname; ?>" /></a>< ?php }else{ ?><a href="/mailtasks/changestatus/< ?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/< ?php echo $project_name?>/deactive.gif" alt=""  title="Click here to activate < ?php echo $coinsetname; ?>" /></a>< ?php } ?></td>-->
                
        
                </tr>


	

	<?php } ?>	

        <?php } } else{ ?>
        <tr><td colspan="9" align="center">No Task Found.</td></tr>
        <?php } ?>
        </table>
        
    

  </div>

      <div>
      <!--<span class="botLft_curv"></span>
      <span class="botRht_curv"></span>-->
      <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
      </div>
      
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