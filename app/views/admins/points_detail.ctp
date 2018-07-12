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
            document.getElementById("linkedit").href=baseUrlAdmin+"editholder/"+id; 

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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Holder/1/holderslist/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Holder/0/holderslist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Holder/0/holderslist/delete";
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
                    <h2>Points Awarded Detail</h2>
                </div>
                <div class="slider-dashboard col-sm-6">
                	<div class="icon-container">
						<?php echo $form->create("Admin", array("action" => "points_detail",'name' => 'points_detail', 'id' => "points_detail")) ?>
                        <script type='text/javascript'>
                            function setprojectid(projectid){
                                document.getElementById('projectid').value= projectid;
                                document.adminhome.submit();
                            }
                        </script>                    
                    </div>
                    <?php  echo $this->renderElement('new_slider');  ?>	
                </div>
           </div>
       
       <div style="width:960px; margin:0 auto;">
       
        <div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			


            
			
					
</div>
			<!--<span class="titlTxt1" style="padding-top:17px !important">&nbsp;</span>
            <span class="titlTxt">   Points Awarded Detail  </span>
			<span class="titlTxt1" style="padding-top:17px !important">&nbsp;</span>-->
            
           <!-- <div class="topTabs">
                <ul class="dropdown">
                        <li><a href="/admins/addholder"><span>New</span></a></li>
                <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                        <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                </ul>
            </div>-->


            <div class="clear"></div>
            
        </div>
        
  </div>
  
  
<div class="clearfix nav-submenu-container">
	<div class="midCont">
		<?php    $this->loginarea="admins";    $this->subtabsel="points_detail";
        echo $this->renderElement('memberlist_submenus');  ?>   
    </div>
</div>   
  
  
<div class="midCont" id="newhldtab">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <!--<span class="topLft_curv"></span>
		<span class="topRht_curv"></span>-->
        <div class="gryTop">
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<div class="new_filter">
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                    if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey'] !=""){
                        echo $form->submit("Reset", array('id' => 'searchkey', 'div' => false, 'label' => '','onclick'=>'document.getElementById("searchkey").value=""'));
                    }
                ?> 
                
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'points_detail')" id="locaa">&nbsp;&nbsp;  

            </span>
</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData">
        <table class="table table-striped table-bordered" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:1%">#</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Date</th>
                <th align="center" valign="middle" style="width:40%"><span class="right"><?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' ');
				 ?></span>Member Name</th>
                <th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('point_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Action Type</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Level</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('points', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Points</th>                
            </tr>
            <?php $i=1;?>
            <?php if($points_arr){
                //debugbreak();
                    $created="";
                    foreach($points_arr as $eachrow){
                        //$recid = $eachrow['Holder']['id'];
                        $point_id=$eachrow['PointArchiveUser']['point_id'];
                        $date=$eachrow['PointArchiveUser']['created'];
                        $userid = $eachrow['PointArchiveUser']['member_id'];
                        $points = $eachrow['PointArchiveUser']['points'];
                        $action_type = AppController::getpointname($eachrow['PointArchiveUser']['point_id']);
                        $modelname = "PointArchiveUser";
                        $othermodelname = "User";
                        $redirectionurl = "points_detail";
                        $member_name = AppController::getmembername($userid);
                        $level=0;
                       
                       
                       App::import("Model", "Point");
                       $this->Point =   & new Point();

                       $condition = "Point.project_id='".$project_id."' and  Point.point_id='".$point_id."' and point<=".$points;
                       $level_details = $this->Point->find('all', array('conditions' => $condition,'fields'=>array('Point.level_value'),'order'=>'Point.level_value desc'));
                       //$details = $this->Comment->query("select * from comments where project_id='".$project_id."' and coinset_id='0' and delete_status='0'");
                       
                       if($level_details) 
                        $level=$level_details[0]['Point']['level_value'];
                       else
                        $level=0;
                    ?>

                    <?php if($i%2 == 0) { ?>
                        <tr class='altrow'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            
                            <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $date?$date:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $member_name?$member_name:"N/A"; ?></span></a></td>
                             <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $action_type?$action_type:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $level?$level:"0"; ?></span></a></td>
                             <td align="left" valign="middle" class='newtblbrd'><a><span><?php echo $points?$points:"N/A"; ?></span></a></td>


                        </tr>
                        <?php } else { ?>

                        <tr>    
                            <td align="center"><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            <td align="left" valign="middle"><a><span><?php echo $date?$date:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle"><a><span><?php echo $member_name?$member_name:"N/A"; ?></span></a></td>
                             <td align="left" valign="middle"><a><span><?php echo $action_type?$action_type:"N/A"; ?></span></a></td>
                            <td align="left" valign="middle"><a><span><?php echo $level?$level:"0"; ?></span></a></td>
                             <td align="left" valign="middle"><a><span><?php echo $points?$points:"N/A"; ?></span></a></td>

                        </tr>



                        <?php } ?>    



                    <?php } 
                    }
                    else{ ?>
                <tr><td colspan="6" align="center">No Records Found.</td></tr>
                <?php  } ?>

        </table>




    </div>
    <div>
    <!--<span class="botLft_curv"></span>
    <span class="botRht_curv"></span>-->
    <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
    </div>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->




      </div>    
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {        
        document.getElementById("newhldtab").className = "newmidCont";
    }    
</script>
