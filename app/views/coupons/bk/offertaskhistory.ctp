<script type="text/javascript">
$(document).ready(function() {
$('#OfferMnu').removeClass("butBg");
$('#OfferMnu').addClass("butBgSelt");
}); 
</script>
<?php $pagination->setPaging($paging);
$base_url_admin = Configure::read('App.base_url_admin');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'prospects/taskhistory';
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
?>
<link
	rel="stylesheet" type="text/css"
	href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
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
                document.getElementById("linkedit").href=baseUrl+"offers/offertaskhistory/"+id;                 
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
                                                        window.location=baseUrl+"offers/changestatus/"+id+"/CommunicationTaskHistory/1/taskhistory/cngstatus";
                                                        }else{
                                                        window.location=baseUrl+"offers/changestatus/"+id+"/CommunicationTaskHistory/0/taskhistory/cngstatus";
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                                        window.location=baseUrl+"prospects/changestatus/"+id+"/CommunicationTaskHistory/0/taskhistory/delete";
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
	<div class="titlCont">
		<div class="myclass">
			<div align="center" class="slider" id="toppanel">
				<?php  echo $this->renderElement('new_slider');  ?>

			</div>
			<?php echo $form->create("offers", array("action" => "offertaskhistory",'name' => 'offertaskhistory', 'id' => "offertaskhistory")) ?>
			<script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
			<?php if($usertype==trim("admin")){ echo $this->renderElement('project_name'); } ?>
			<span class="titlTxt">Email Tasks History </span>

			<div class="topTabs">
				<ul class="dropdown">
					<!-- <li><a href="/admins/addcommtask"><span>New</span></a></li>-->
					<li><a href="javascript:void(0)" class="tab2"><span>Actions</span>
					</a>
						<ul class="sub_menu">
							<!--li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li-->
							<!--li><a href="javascript:void(0)">Copy</a></li-->
							<li><a href="javascript:void(0)"
								onclick="return activatecontents('asd','del');">Trash</a></li>
							<li class="botCurv"></li>
						</ul>
					</li>
					<!--li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li-->
				</ul>
			</div>
			<?php    $this->loginarea="offers";    $this->subtabsel="offertaskhistory";
            echo $this->renderElement('offer_email_submenus');  ?>
		</div>
	</div>
	<div class="midCont" id="newcmmtasktab">


		<?php if($session->check('Message.flash')){ ?>
		<div id="blck">
			<div class="msgBoxTopLft">
				<div class="msgBoxTopRht">
					<div class="msgBoxTopBg"></div>
				</div>
			</div>
			<div class="msgBoxBg">
				<div class="">
					<a href="#." onclick="hideDiv();"><img src="/img/close.png" alt=""
						style="margin-left: 945px; position: absolute; z-index: 11;" /> </a>
					<?php  $session->flash();    ?>
				</div>
				<div class="msgBoxBotLft">
					<div class="msgBoxBotRht">
						<div class="msgBoxBotBg"></div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

		<!-- top curv image starts -->
		<div>
			<span class="topLft_curv"></span><span class="topRht_curv"></span>
			<div class="gryTop">
				<div class="new_filter">
				<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?>
				</span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>'btn'));
				?> </span> <span class="srchBg2"><input type="button" value="Reset"
					label=""
					onclick="javascript:(window.location='<?php echo $base_url_admin ?>commtaskhistorylist')"
					id="locaa"> </span>

			</div>
			</div>
			<div class="clear"></div>
		</div>

		<?php $i=1; ?>
		<div class="tblData">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr class="trBg">
					<th align="center" style="width: 2%;">#</th>
					<th align="center" style="width: 3%;"><input type="checkbox"
						value="" name="checkall" id="checkall" /> <input type="hidden"
						id="current_domain" name="current_domain"
						value="<?php echo $current_domain;?>">
					</th>
					<th align="center" valign="middle" style="width: 10%;"><span
						class="right"><?php echo $pagination->sortBy('task_execution_date', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
					</span>Date Sent</th>
					<th align="center" valign="middle" style="width: 18%;"><span
						class="right"><?php echo $pagination->sortBy('task_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
					</span>Task Name</th>
					<th align="center" valign="middle" style="width: 18%;"><span
						class="right"><?php echo $pagination->sortBy('email_template_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
					</span>Related Template</th>
					<th align="center" valign="middle" style="width: 40%;"><span
						class="right"><?php echo $pagination->sortBy('recur_pattern', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
					</span>Recur Pattern</th>
					<th align="center" valign="middle" style="width: 8%;"><span
						class="right"><?php echo $pagination->sortBy('task_execution_count',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
					</span># Sent</th>
					<!-- <th align="center" valign="middle" style="width:70px;"><span class="right">< ?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Status</th> -->

				</tr>
				<?php
				if($taskdata){
                        foreach($taskdata as $eachrow){
                        $recid = $eachrow['CommunicationTaskHistory']['id'];
                        $taskid = $eachrow['CommunicationTaskHistory']['task_id'];
                        $projectid = $eachrow['CommunicationTaskHistory']['project_id'];
                        $modelname = "CommunicationTaskHistory";
                        $redirectionurl = "commtaskhistorylist";
                        $company_task_id = $eachrow['CommunicationTaskHistory']['id'];
                        $task_name= $eachrow['CommunicationTaskHistory']['task_name'];
                        $task_email_tempname= $eachrow['EmailTemplate']['email_template_name'];
                        $task_recur_pattern= $eachrow['CommunicationTaskHistory']['recur_pattern'];
                        $recurOn="";
                        if($task_recur_pattern=="Daily"){
                              $recurOn =" Occurs every ";
                              if($eachrow['CommunicationTaskHistory']['daily_pattern']=="everyday"){
                                    $recurOn.=$eachrow['CommunicationTaskHistory']['daily_every_noof_days']." days";
                              }else{
                                    $recurOn.="weekday";
                              }
                        }else if($task_recur_pattern=="Weekly"){
                            $recurOn =" Occurs every ".$eachrow['CommunicationTaskHistory']['weekly_every_noof_weeks']." week(s) on ";
                            $recurOnday="";
                            if($eachrow['CommunicationTaskHistory']['weekly_monday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                $recurOnday.="Mon";
                            }
                            if($eachrow['CommunicationTaskHistory']['weekly_tuesday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                $recurOnday.="Tue";
                            }
                            if($eachrow['CommunicationTaskHistory']['weekly_wednesday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                $recurOnday.="Wed";
                            }
                            if($eachrow['CommunicationTaskHistory']['weekly_thursday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                $recurOnday.="Thu";
                            }
                            if($eachrow['CommunicationTaskHistory']['weekly_friday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                $recurOnday.="Fri";
                            }

                            if($eachrow['CommunicationTaskHistory']['weekly_saturday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                $recurOnday.="Sat";
                            }

                            if($eachrow['CommunicationTaskHistory']['weekly_sunday']=='1')  {
                                if($recurOnday!=""){
                                    $recurOnday.=",";
                                }
                                $recurOnday.="Sun";
                            }
                            $recurOn .=$recurOnday;



                        }else if($task_recur_pattern=="Monthly"){
                               if($eachrow['CommunicationTaskHistory']['monthly_pattern']=="dayofeverymonth"){
                                    $recurOn.=" Occurs every day ".$eachrow['CommunicationTaskHistory']['monthly_onof_day']." of every ".$eachrow['CommunicationTaskHistory']['monthly_every_noof_months']." months";
                              }else{
                                    $recurOn.=" Occurs every the ".$eachrow['CommunicationTaskHistory']['monthly_weeknumber']." ".$eachrow['CommunicationTaskHistory']['monthly_weekday']." of every ".$eachrow['CommunicationTaskHistory']['monthly_weekof_noof_months']." months";
                              }
                        }else if($task_recur_pattern=="Yearly"){
                              if($eachrow['CommunicationTaskHistory']['yearly_pattern']=="everynoofmonths"){
                                    $recurOn.=" Occurs every ".$eachrow['CommunicationTaskHistory']['yearly_everymonth']." ".$eachrow['CommunicationTaskHistory']['yearly_everymonth_date'];
                              }else{
                                    $recurOn.=" Occurs every the ".$eachrow['CommunicationTaskHistory']['yearly_weeknumber']." ".$eachrow['CommunicationTaskHistory']['yearly_weekday']." of ".$eachrow['CommunicationTaskHistory']['yearly_weekof_month'];
                              }
                        }

                        $recurOn.=" effective from ".date("m-d-Y", strtotime($eachrow['CommunicationTaskHistory']['task_startdate']));
                        if($eachrow['CommunicationTaskHistory']['task_execution_date']=="0000-00-00 00:00:00" || $eachrow['CommunicationTaskHistory']['task_execution_date']==""){
                             $task_sent_date= "NA"; //"00-00-0000";
                        }else{
                             $task_sent_date= date("m-d-Y", strtotime($eachrow['CommunicationTaskHistory']['task_execution_date']));
                        }
                         

                        $task_sent_count= $eachrow['CommunicationTaskHistory']['task_sent_count'];

                        if($task_name)   $task_name = AppController::WordLimiter($task_name,70);

                        if(isset($eachrow['CommunicationTaskHistory']['task_is_done'])=="1"){
                              $task_next_send="Completed";
                        }
                        ?>
				<tr <?php echo ($i%2 == 0)? "class='altrow'": "" ; ?>>
					<td align="center" class='newtblbrd'><span style="color: #4d4d4d;"><?php echo $i++;?>
					</span></td>
					<td align="center" class='newtblbrd'><a><span><input
								type="checkbox" class="checkid" name="checkid[]"
								value="<?php echo $recid; ?>" />
					
					</a></span></td>
					<td align="left" valign="middle" class='newtblbrd'><a
						href="javascript:void(0);" class="showSentHistory"
						id="date_<?php echo $recid;?>_<?php echo $taskid;?>_<?php echo $projectid;?>"><span><?php echo $task_sent_date; ?><a>
						
						</span>
					
					</td>
					<td align="left" valign="middle" class='newtblbrd'><a
						href="javascript:void(0);" class="showSentHistory"
						id="emailtemp_<?php echo $recid;?>_<?php echo $taskid;?>_<?php echo $projectid;?>"><span><?php echo $task_name; ?><a>
						
						</span>
					
					</td>
					<td align="left" valign="middle" class='newtblbrd'><a
						href="javascript:void(0);" class="showSentHistory"
						id="recur_<?php echo $recid;?>_<?php echo $taskid;?>_<?php echo $projectid;?>"><span><?php echo $task_email_tempname; ?><a>
						
						</span>
					
					</td>
					<td align="left" valign="middle" class='newtblbrd'><a
						href="javascript:void(0);" class="showSentHistory"
						id="sentcnt_<?php echo $recid;?>_<?php echo $taskid;?>_<?php echo $projectid;?>"><span><?php echo $task_recur_pattern.": ".$recurOn; ?><a>
						
						</span>
					
					</td>
					<td align="center" valign="middle" align="center" class='newtblbrd'><a
						href="javascript:void(0);" class="showSentHistory"
						id="taskname_<?php echo $recid;?>_<?php echo $taskid;?>_<?php echo $projectid;?>"><span><?php echo $task_sent_count; ?><a>
						
						</span>
					
					</td>
				</tr>
				<?php } 
} else{ ?>
				<tr>
					<td colspan="9" align="center">No Task History Found.</td>
				</tr>
				<?php } ?>
			</table>



		</div>

		<div>
			<span class="botLft_curv"></span>
<span class="botRht_curv"></span>
			<div class="gryBot">
				<?php  echo $this->renderElement('newpagination'); ?>
			</div>
			<!--inner-container ends here-->


			

			<div id="taskhistoryreport" title="Task History Report">
				<p>This is a list of all sent members or contacts of selected Task
					History.</p>
			</div>

			<div class="clear"></div>
		</div>
		<?php echo $form->end();?>




		<div class="clear"></div>
	</div>

	<div class="clear"></div>
</div>
<script type="text/javascript">
    // increase the default animation speed to exaggerate the effect
    $.fx.speeds._default = 1000;
    $(function() {
        $( "#taskhistoryreport" ).dialog({
            autoOpen: false,
            modal: true,
            width: 560,
            show: "blind",
            hide: "blind"
        });

       $( ".showSentHistory" ).click(function() {  // runTaskReport();
            var current_domain=$("#current_domain").val(); 
            var history= $(this).attr('id').split('_');
          //  alert(history);
            var history_id=history[1];
            var task_id=history[2];
           
            $.ajax({
                            type: "GET",  
                            url: 'http://'+current_domain+'/admins/commtask_get_history_sentitem_list_by_ajax/'+history_id+'/'+task_id,
                            cache: false,
                            success: function(result){    
                                      $("#taskhistoryreport").html(result); 
                                      $( "#taskhistoryreport" ).dialog( "open" );
                                      return false; 
                            }
              });
           
          
        });
    });

    
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newcmmtasktab").className = "newmidCont";
	}	
</script>
