
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$base_url = Configure::read('App.base_url');
   // $server_path=$_SERVER['REQUEST_URI'];
 //   $server_para=explode('/',$server_path);
	$server_para=$this->params['pass'];
	
	  if(isset($server_para['0'])=="detail")
    {
        $head="Event Pages";
        $detail_tab_select="class='tabSelt'";
    }
    if(isset($server_para['0'])=="sponsor")
    {
        $head="Sponsor Pages";
        $sponsor_tab_select="class='tabSelt'";
    }
    if(isset($server_para['0'])=="inquiry")
    {
        $head="Inquiry Pages";
        $inquiry_tab_select="class='tabSelt'";
    }
    
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



    function editevent()
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
            document.getElementById("linkedit").href=baseUrlAdmin+"edit_event/"+id; 

        }
    } 

    function invitetoevent()
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
            alert("please select only one event  to invite");
            return false;
        }else{    
            document.getElementById("linkinvite").href=baseUrlAdmin+"eventinvitation/"+id; 

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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/RecurringEvent/1/event_pages/cngstatus/0/<?php echo $server_para[3];?>";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/RecurringEvent/0/event_pages/cngstatus/0/<?php echo $server_para[3];?>";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/RecurringEvent/0/event_pages/delete/0/<?php echo $server_para[3];?>";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    } 

</script>
<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container clearfix">
   <div class="titlCont">
   		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">            	
                <h2><?php echo ucwords($pageTitle);?></h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Admin", array("action" => "contactlist",'name' => 'contactlist', 'id' => "contactlist")) ?>
					<script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script> 
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
                    <a href="javascript:void(0)" onclick="editevent();" id="linkedit"><?php e($html->image('edit.png')); ?></a>                    
                </div>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">
            </div>
           <?php  //echo $this->renderElement('project_name');  ?> 
            <span class="titlTxt"><?php //echo ucwords($pageTitle);?> </span>-->
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                      <!--<li><a href="/admins/addcontentpage/<?php // echo $server_para[3];?>"><span>New</span></a></li>   -->
                      <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                                           <!--<li><a href="javascript:void(0)" onclick="invitetoevent();" id="linkinvite">Invite</a></li>  -->
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                            <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                                         <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                                         <li class="botCurv"></li>
                                    </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editevent();" id="linkedit"><span>Edit</span></a></li>         
                </ul><?php */?>
            </div>
            <div class="clear">
            	<img src="<?php echo $base_url ?>img/spacer.gif" width="1" height="12px;" />
            </div>
        </div>
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php $this->loginarea="admins";    $this->subtabsel="event_pages";
			 echo $this->renderElement('events_submenus');  ?> 
    </div>
</div>

<div class="midCont">

    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>	
    <!-- top curv image starts -->
    <div>
        <!--<span class="topLft_curv"></span>
		 <span class="topRht_curv"></span>-->
        <div class="gryTop">
            <?php echo $form->create("Admin", array("action" => "eventlist",'name' => 'eventlist', 'id' => "eventlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<div class="new_filter">
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                ?> 
            </span>
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>event_pages/<?php echo $server_para['0']?>')" id="locaa"></span>

        </div>   
		</div>
        <div class="clear"></div></div>

    <?php $i=1; ?>            

    <div class="tblData">

        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" width="2%">#</th>
                <th align="center" valign="middle" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" style="width: 17%"> 
                <span class="right">
                <?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                </span>
                Event Page Name</th>
                <th align="center" valign="middle" width="10%"> <span class="right"><?php echo $pagination->sortBy('event_title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Event Name</th>
                <th align="center" valign="middle" width="12%"> <span class="right"><?php echo $pagination->sortBy('start_date', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Event Date</th>
                <th align="center" valign="middle" width="8%"><span class="right"><?php echo $pagination->sortBy('starttime', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Start Time</th>
                <th align="center" valign="middle" width="10%"><span class="right"><?php echo $pagination->sortBy('show_to_invitees_only', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Invite Only</th>
                <th align="center" valign="middle" width="7%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>


            </tr>
            <?php if($eventdata){ 
                    $alt=0;
                    $i=1;
                    foreach($eventdata as $eachrow){
					//	echo '<pre>';print_r($eachrow);
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                        //debugbreak();
                        $recid = $eachrow['RecurringEvent']['id'];
                        //$event_id = $eachrow['RecurringEvent']['event_id'];
                        
                        $modelname = "RecurringEvent";
                        $redirectionurl = "event_pages";
                        //    $company_type_id = $eachrow['CompanyType']['company_type_name'];
                        $event_name = $eachrow['RecurringEvent']['event_title'];
                        if($event_name) $event_name = AppController::WordLimiter($event_name,25);         
                        
                        $event_page_name=$eachrow['Content']['title'];
                        $content_id=$eachrow['Content']['id'];
                        
                        $start_date = date('m-d-Y', strtotime($eachrow['RecurringEvent']['start_date']));
                        //$starttime = AppController::usdateformat($starttime,1);
                         
                        $starttime =date("g:i a", strtotime($eachrow['RecurringEvent']['starttime'])); 
                        
                        if($eachrow['RecurringEvent']['show_to_invitees_only']==1)
                            $invites_only="Yes";
                        else
                            $invites_only="No";

                    ?>
                    <tr <?php echo $class;?>>    

                        <td align="center"><a><span><?php echo $i++;?></span></a></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                        <td align="left" valign="middle">														
						<?php
								e($html->link(
								$html->tag('span',  $event_page_name),
								array('controller'=>'admins','action'=>'editcontent',$content_id),
								array('escape' => false)
								)
							);
						?>

						</td>
                        <td align="left" valign="middle">
							<?php
								e($html->link(
								$html->tag('span',  $event_name),
								array('controller'=>'admins','action'=>'edit_event',$recid),
								array('escape' => false)
								)
							);
						?>
						</td>      
                        <td align="left" valign="middle">
							<?php
								e($html->link(
								$html->tag('span',  $start_date),
								array('controller'=>'admins','action'=>'edit_event',$recid),
								array('escape' => false)
								)
							);
						?>
						</td>  
                        <td align="center" valign="middle">
							<?php
								e($html->link(
								$html->tag('span',  $starttime),
								array('controller'=>'admins','action'=>'edit_event',$recid),
								array('escape' => false)
								)
							);
						?>
						</td>  
                        <td align="center" valign="middle" >
							
							<?php
								e($html->link(
								$html->tag('span',  ($invites_only)?$invites_only:'N/A'),
								array('controller'=>'admins','action'=>'edit_event',$recid),
								array('escape' => false)
								)
							);
						?>
							
						</td>
                        <td align="center" valign="middle">

						
						<?php if($eachrow['RecurringEvent']['active_status']=='1'){
						e($html->link(
								$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$event_name)),
								array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus','0',$para_val),
								array('escape' => false)
								)
							);
						}else{
									e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$event_name)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus','0',$para_val),
									array('escape' => false)
									)
								);
							}		
							
						?>
					</td>
                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="8" align="center">No Event Page Found.</td></tr>
                <?php } ?>
        </table> 


    </div>
    <div>
        <!--<span class="botLft_curv"></span>
		<span class="botRht_curv"></span>-->
        <div class="gryBot"><?php //if($eventdata) { 
		echo $this->renderElement('newpagination'); //} ?>
        </div>
        <div class="clear"></div>
    </div>
    <!--inner-container ends here-->

    <?php echo $form->end();?>

                    </div>

<div class="clear"></div>
