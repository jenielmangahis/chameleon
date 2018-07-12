<script language="javascript">
function setURL(key, value) {
  // set up the url separators
  var separator = {
    // site.url/controller/action/key1:value1/key2:value2
    'key': '?',
    'value': '='
  }
 
  // get the current url
  var url = window.location.href;
  // check if the specified key already exists
  var exists = url.indexOf(separator.key + key + separator.value);
 
  // if it does
  if (exists > -1) {
    // find the next separator.key
    var last = url.indexOf(separator.key, exists + 1);
 
    // if there is one
    if (last > -1) {
      // replcae the existing value with the one passed
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value) + url.substr(last);
 
    // if not
    } else {
      // just append it
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value);
    }
 
  // if it's not already in there
  } else {
    // if the URL doesn't end with a separator.key
    if (url.substr(-1) != separator.key) {
      // append it
      url += separator.key;
    }
 
    // append the value
    url += key + separator.value + escape(value);
    
    
  }

  // set the url
  window.location.href = url;

}
</script>


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
            document.getElementById("linkedit").href=baseUrl+"companies/editholder/"+id; 

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
                    window.location=baseUrl+"companies/changestatus/"+id+"/Holder/1/holderslist/cngstatus";
                }else{
                    window.location="/admins/changestatus/"+id+"/Holder/0/holderslist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrl+"companies/changestatus/"+id+"/Holder/0/holderslist/delete";
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
       <div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
        
            <?php echo $form->create("Companies", array("action" => "points_detail",'name' => 'points_detail', 'id' => "points_detail")) ?>
            <span class="titlTxt">   Points Detail  </span>
            
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


               <?php    $this->loginarea="companies";    $this->subtabsel="points_detail";
             echo $this->renderElement('memberlist_submenus');  ?>      

        </div></div>
        
<div class="midCont" id="newhldtab">

    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <div class="gryTop">
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                    if(isset($this->data['Companies']['searchkey']) && $this->data['Companies']['searchkey'] !=""){
                        echo $form->submit("Reset", array('id' => 'searchkey', 'div' => false, 'label' => '','onclick'=>'document.getElementById("searchkey").value=""'));
                    }
                ?> 
                
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/points_detail')" id="locaa">&nbsp;&nbsp;  

            </span>

        </div><span class="topRht_curv"></span>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:10px">#</th>
                <th align="center" valign="middle" style="width:150px"><span class="right"><?php echo $pagination->sortBy('date', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date</th>
                <th align="center" valign="middle" style="width:150px"><span class="right"><?php echo $pagination->sortBy('member_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Member Name</th>
                <th align="center" valign="middle" style="width:150px"><span class="right"><?php echo $pagination->sortBy('action_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Action Type</th>
                <th align="center" valign="middle" style="width:150px"><span class="right"><?php echo $pagination->sortBy('level', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Level</th>
                <th align="center" valign="middle" style="width:150px"><span class="right"><?php echo $pagination->sortBy('points', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Points</th>
                
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
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($points_arr) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
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
