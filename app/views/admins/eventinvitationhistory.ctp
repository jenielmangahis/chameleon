<?php $pagination->setPaging($paging);
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');    
$base_url_admin = Configure::read('App.base_url_admin');
$base_url = Configure::read('App.base_url');
 ?>  
 <link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">             
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
                document.getElementById("linkedit").href=baseUrlAdmin+"editcommtask/"+id;                
               }
        } 


function activatecontents(act,op)
{   
    var id="";
        var count=0;
    var receventid=$("#receventid").val();
    
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
                                                        window.location=baseUrlAdmin+"changestatus/"+id+"/EventInvitation/1/eventinvitationhistory/cngstatus/0/"+receventid;
                                                        }else{
                                                        window.location=baseUrlAdmin+"changestatus/"+id+"/EventInvitation/0/eventinvitationhistory/cngstatus/0/"+receventid;
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/EventInvitation/0/eventinvitationhistory/delete/0/"+receventid;
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
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">            	
                <h2>Invites List</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Admins", array("action" => "eventinvitationhistory",'name' => 'eventinvitationhistory', 'id' => "eventinvitationhistory")) ?>
						<script type='text/javascript'>
                                function setprojectid(projectid){
                                                document.getElementById('projectid').value= projectid;
                                                document.adminhome.submit();
                                        }
                        </script> 
                        <?php e($html->link($html->image('cancle.png',array('alt'=>'Cancle')),array('controller'=>'admins','action'=>'eventlist'),array('escape' => false,'id' =>'linkedit'))); ?>
                        <?php  echo $this->renderElement('new_slider');  ?>
                </div>                
            </div>
            <div class="topTabs" style="height:25px;">
<?php /*?><ul class="dropdown">
<li>
	
	<?php
		e($html->link(
			$html->tag('span', 'Cancel'),
			array('controller'=>'admins','action'=>'eventlist'),
			array('escape' => false,'id' =>'linkedit')
			)
		);
	?>
</li>  
</ul><?php */?>
</div>
			<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
        </div>


</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="admins"; $this->subtabsel="eventinvitationhistory";
			echo $this->renderElement('events_submenus');
		?>    
    </div>
</div>


<div class="midCont" id="newcmmtasktab">
<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
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
               <div class="new_filter">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200",'value'=>(isset($key))?$key:''));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>''));
                        ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ; ?>eventinvitationhistory')" id="locaa"></span>
                </div>
                        </div> 
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData table-responsive">
        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
        <th align="center" style="width:2%;">#</th>
        <th align="center" style="width:3%;"><input type="checkbox" value="" name="checkall" id="checkall" /> <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">                                    </th>   
        <th align="center" valign="middle" style="width:18%;"><span class="right"><?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),Holder,null,' ',' '); ?></span>Last Name</th>         
        <th align="center" valign="middle" style="width:18%;"><span class="right"><?php echo $pagination->sortBy('lastnameshow', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),Holder,null,' ',' '); ?></span>First Name</th>      
        <th align="center" valign="middle" style="width:18%;"><span class="right"><?php echo $pagination->sortBy('member_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),MemberType,null,' ',' ');?></span>Member Type</th>              
        <th align="center" valign="middle"style="width:15%;"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Invite Date</th>  
		<th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('in_rsvp', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>RSVP</th>          
        <th align="center" valign="middle" style="width:50px;"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th> 

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
                        
                        $recid = $eachrow['EventInvitation']['id'];
                        $taskid = $eachrow['EventInvitation']['task_id'];
                        $projectid = $eachrow['EventInvitation']['project_id'];
                        $modelname = "EventInvitation";
                        $redirectionurl = "eventinvitationhistory";
                        $holder_id = $eachrow['EventInvitation']['invite_to_holder_id'];                        
                        $holder_name=AppController::getholdernamebyid($holder_id);
                        
                        App::import("Model", "Holder");
                        $this->Holder =  & new Holder();   
                        
                        $condition= "Holder.id = '".$holder_id."'";
                        $holder_data = $this->Holder->find('first',array("conditions"=>$condition));
                        $userid = $holder_data['Holder']['id'];
                        $first_name=$holder_data['Holder']['firstname'];
                        $last_name=$holder_data['Holder']['lastnameshow'];
                        $invite_date=$eachrow['EventInvitation']['created'];
                        $member_type=$eachrow['MemberType']['member_type'];
						$rsvp = $eachrow['EventInvitation']['in_rsvp'];
						if($rsvp == '0'){
							$rsvp = 'No';
						}else{
							$rsvp = 'Yes';
						}
                        

                ?>

 <tr <?php echo $class;?>>       
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></td>
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span',$last_name?$last_name:"N/A"),
							array('controller'=>'admins','action'=>'editholder',$userid),
							array('escape' => false)
							)
						);
						?>
						
					
				</td>   
                <td align="left" valign="middle" class='newtblbrd'>
				
					<?php
						e($html->link(
							$html->tag('span', $first_name?$first_name:"N/A"),
							array('controller'=>'admins','action'=>'editholder',$userid),
							array('escape' => false)
							)
						);
						?>

				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $member_type?$member_type:"N/A"),
							array(),
							array('escape' => false)
							)
						);
						?>

				</td>  
          
                <td align="center" valign="middle" align="center" class='newtblbrd'>
					
					<?php
						e($html->link(
							$html->tag('span', $invite_date),
							array(),
							array('escape' => false)
							)
						);
						?>

				</td>              
				      <td align="center" valign="middle" class='newtblbrd'>
			
						<?php
						e($html->link(
							$html->tag('span', $rsvp?$rsvp:"N/A"),
							array(),
							array('escape' => false)
							)
						);
						?>

				</td>
                 <td align="center" valign="middle" class='newtblbrd'><a><span><?php if($eachrow['EventInvitation']['active_status']=='1'){
					e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$coinsetname)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus','0',$coinsetname),
									array('escape' => false)
									)
								);
							} else {
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$coinsetname)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus','0',$coinsetname),
									array('escape' => false)
									)
								);
							}		
					?>
					</td>       
                </tr>
			<?php  

         } } else{ ?>
        <tr><td colspan="9" align="center">No Invite History Found.</td></tr>
        <?php } ?>
        </table>
        
           

  </div>

      <div>
      <!--<span class="botLft_curv"></span>
      <span class="botRht_curv"></span>-->
      <div class="gryBot"><?php echo $this->renderElement('newpagination'); ?>
      </div>
      <!--inner-container ends here-->
        

      
      
       <div id="taskhistoryreport" title="Task History Report">
                <p>This is a list of all sent members or contacts of selected Task History.</p>
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
