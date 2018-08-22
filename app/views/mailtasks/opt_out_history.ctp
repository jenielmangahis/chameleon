<?php $pagination->setPaging($paging);
$base_url_admin = Configure::read('App.base_url_admin');
echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
?>
<link
	rel="stylesheet" type="text/css"
	href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
<!-- Body Panel starts -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#checkall').bind('change',function(){
			var check = $(this).attr('checked')?1:0;
			if(check ==1){
                $('.checkid').each(function(){
					$(this).attr('checked',true);
                });
            }else{
                $('.checkid').each(function(){
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
                document.getElementById("linkedit").href=baseUrl+"mailtasks/opt_out_history/"+id; 
                
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
                                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommunicationTaskHistory/1/opt_out_history/cngstatus";
                                                        }else{
                                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommunicationTaskHistory/0/opt_out_history/cngstatus";
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommunicationTaskHistory/0/opt_out_history/delete";
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
                <h2>Opt-Out History</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("mail", array("action" => "opt_out_history",'name' => 'opt_out_history', 'id' => "opt_out_history")) ?>
					<script type='text/javascript'>
                                function setprojectid(projectid){
                                                document.getElementById('projectid').value= projectid;
                                                document.adminhome.submit();
                                        }
                        </script>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>		
                    <?php  echo $this->renderElement('new_slider');  ?>	
                </div>
            </div>
            <div class="topTabs" style="height:25px;">
				<?php /*?><ul class="dropdown">
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
				</ul><?php */?>
			</div>
        </div>
    
		
	</div>
    
<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		 <?php    $this->loginarea="admins";    $this->subtabsel="opt_out_history";
             echo $this->renderElement('emails_submenus');  ?>
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
			<!--<span class="topLft_curv"></span> <span class="topRht_curv"></span>-->
			<div class="gryTop">

				<div class="new_filter">
					<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?>
					</span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>''));
					?> </span> <span class="srchBg2"><input type="button" value="Reset"
						label=""
						onclick="javascript:(window.location='<?php echo $base_url_admin ?>commopt_out_history')"
						id="locaa"> </span>

				</div>
			</div>
			<div class="clear"></div>
		</div>
 
		<?php $i=1; ?> 
		<div class="tblData table-responsive">
			<table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0"> 
				<tr class="trBg">
					<th align="center" style="width: 1%;">#</th>
					<th align="center" style="width: 2%;"><input type="checkbox"
						value="" name="checkall" id="checkall" /> <input type="hidden"
						id="current_domain" name="current_domain"
						value="<?php echo $current_domain;?>"> 
					</th>
					<th align="center" valign="middle" style="width: 10%;"><span
						class="right"><?php echo $pagination->sortBy('dateoptout', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' '); ?>
					</span>Opt-Out Date</th>
					<th align="center" valign="middle" style="width: 15%;"><span
						class="right"><?php echo $pagination->sortBy('lastnameshow', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' '); ?>
					</span>Last Name</th>
					<th align="center" valign="middle" style="width: 15%;"><span
						class="right"><?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' '); ?>
					</span>First Name</th>
					<th align="center" valign="middle" style="width: 27%;"><span
						class="right"><?php echo $pagination->sortBy('subcription_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' '); ?>
					</span>Subscriptions Opt-Out</th>
					<th align="center" valign="middle" style="width: 10%;"><span
						class="right"><?php echo $pagination->sortBy('created',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' '); ?>
					</span>Join Date</th>
					<th align="center" valign="middle" style="width: 10%;"><span
						class="right"><?php echo $pagination->sortBy('member_type',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'MemberType',null,' ',' '); ?>
					</span>Member Type</th>
					<!-- <th align="center" valign="middle" style="width:70px;"><span class="right">< ?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Status</th> -->

				</tr>
				<?php
				if($optoutdata){
                        foreach($optoutdata as $eachrow){
                        $recid = $eachrow['Holder']['id'];
                        $firstname = $eachrow['Holder']['firstname'];
                        $lastnameshow = $eachrow['Holder']['lastnameshow'];
                        $subcription_type = '';//$eachrow['Holder']['subcription_type'];
                        $optout_created = date('Y-m-d', strtotime($eachrow['Holder']['dateoptout']));
                        $member_type = $eachrow['MemberType']['member_type'];
                        $member_created = date('Y-m-d', strtotime($eachrow['Holder']['created']));
                        $modelname = "Holder";
                        $redirectionurl = "opt_out_history";
                 ?>
				
				<tr <?php echo ($i%2 == 0) ? "class='altrow'" :""; ?>>
					<td align="center" class='newtblbrd'><span style="color: #4d4d4d;"><?php echo $i++;?>
					</span></td>
					<td align="center" class='newtblbrd'><a><span><input
								type="checkbox" class="checkid" name="checkid[]"
								value="<?php echo $recid; ?>" />
					
					</a></span></td>
					<td align="left" valign="middle" class='newtblbrd'>
						<a	href="javascript:void(0);" class="showSentHistory">
							<span>
								<?php echo $optout_created; ?>
							</span>
							</a>
					</td>
					
					<td align="left" valign="middle" class='newtblbrd'>
						<a href="javascript:void(0);" class="showSentHistory"></a>
					<span><?php echo $lastnameshow; ?></span>
					</td>
					<td align="left" valign="middle" class='newtblbrd'>
						<a href="javascript:void(0);" class="showSentHistory" >
						<span><?php echo $firstname; ?>
						</span></a>
					
					</td>
					
					<td align="left" valign="middle" class='newtblbrd'>
						<a href="javascript:void(0);" class="showSentHistory" >
						<span><?php echo $subcription_type; ?>
						</span></a>
					
					</td>
					
					<td align="left" valign="middle" class='newtblbrd'>
						<a href="javascript:void(0);" class="showSentHistory" >
						<span><?php echo $member_created; ?>
						</span></a>
					
					</td>
					
					<td align="left" valign="middle" class='newtblbrd'>
						<a href="javascript:void(0);" class="showSentHistory" >
						<span><?php echo $member_type; ?>
						</span></a>
					
					</td>
				</tr>
				<?php } 
} else{ ?>
				<tr>
					<td colspan="8" align="center">No Opt-Out History Found.</td>
				</tr>
				<?php } ?>
			</table>



		</div>

		<div>
			<!--<span class="botLft_curv"></span> <span class="botRht_curv"></span>-->
			<div class="gryBot">
				<?php echo $this->renderElement('newpagination');  ?>
			</div>
			<!--inner-container ends here-->




			<div id="optouthistoryreport" title="Opt-Out History Report">
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
        $( "#optouthistoryreport" ).dialog({
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
                                      $("#optouthistoryreport").html(result); 
                                      $( "#optouthistoryreport" ).dialog( "open" );
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
