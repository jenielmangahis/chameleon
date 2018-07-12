<script type="text/javascript">

$(document).ready(function() {
 
$('#hoMe').removeClass("butBg");
$('#hoMe').addClass("butBgSelt");
}); 

</script>  

<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
        <?php echo $form->create("Admins", array("action" => "projecttype",'name' => 'projecttype', 'id' => "projecttype"))?>
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
<span class="newtitlTxt"><?php echo $projectdata[0]['ProjectType']['project_type_name'];?>: Projects</span>
<div class="topTabs" style="margin-left: -40px;">
        <ul class="dropdown">
                <li class=""><a href="/admins/addprojecttype"><span>New</span></a></li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                        <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
        </ul>
        </div>
            <div class="clear"></div>
            <?php $this->projecttype="tabSelt";echo $this->renderElement('super_admin_types'); ?>

</div></div>
<div class="midCont" id="newprttype">


	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                <?php echo $form->create("Admins", array("action" => "index",'name' => 'adminhome', 'id' => "adminhome")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>       <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/admins/projecttype')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                      <?php $session->flash(); ?> <?php } 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div> 
               <div class="clear"></div>
         </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
</div>
<div class="tblData">
                      <table width="960" border="0" cellspacing="0" cellpadding="0">
  		      <tr class="trBg">
			 <th align="center" valign="middle" width="10px">#
			</th>
			<th align="center" valign="middle" width="10px">
				<input type="checkbox" id="checkall" name="checkall" value="">
			</th>
			<th align="center" width="135px"><span style="float:right"><?php echo $pagination->sortBy('project_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt=""  />',null,null,' ',' '); ?>
			  </span>
				Project
    			 </th>
	  		<th align="center" width="150px">
			<span style="float:right">
				<?php echo $pagination->sortBy('project_type_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>
			</span>
			
			Project Type
			
			</th>
			<th align="center" width="180px"><span style="float:right">
			<?php echo $pagination->sortBy('url', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>
			</span>
			Website URL
			</th>

 		      <th align="center"  width="120px"><span style="float:right">
			<?php echo $pagination->sortBy('sponsor_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?>
			</span>
			Sponsor
			
		      </th>
      		      <th align="center"  width="110px">
			<span style="float:right">
			<?php echo $pagination->sortBy('numunits', '<img src="/img/sorting_arow.png" width="10" height="13" alt=""   />',null,null,' ',' '); ?>
			</span>
			# of Coins
			
		      </th>
    		      <th align="center"  width="175px">
			<span style="float:right">
			<?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt=""   />',null,null,' ',' '); ?>
			</span>
			Create Date
			</th>
     			<!--  <th align="left" valign="middle">Coinsets</th>-->
    		     <th align="center" valign="middle" width="70px">
			<span style="float:right">
			<?php echo $pagination->sortBy('active_status', '<img src="/img/sorting_arow.png" width="10" height="13" alt=""   />',null,null,' ',' '); ?>
			</span>
			Status</th>
		     <!--<th align="center" valign="middle" width="60px">&nbsp;</th>-->
      		  </tr>
   	

   	<?php  
   	if($projectdata){ $count=1;
   			foreach($projectdata as $eachrow){//print_r($eachrow['Project']); echo "<br>";
   			$recid = $eachrow['Project']['id'];
   			$modelname = "Project";
   			$redirectionurl = "projectlist";
   			$proname = $eachrow['Project']['project_name'];
			if($proname) $proname = AppController::WordLimiter($proname,25);
   			$project_type_name = $eachrow['ProjectType']['project_type_name'];
			$url = $eachrow['Project']['url'];
   			$sponsor_name = $eachrow['Sponsor']['sponsor_name'];
   			$numunits = $eachrow['Project']['numunits'];
			$crtdate = $eachrow['Project']['created'];
			$commentdate = AppController::usdateformat($crtdate,1);
   			$companies = $this->requestAction("admins/getcompaniesbyprojectid/$recid");
			if($companies) $companies = AppController::WordLimiter($companies,150);
   			$coinsets = $this->requestAction("admins/getcoinsetsbyprojectid/$recid");
   			$site_id=$eachrow['ProjectType']['site_type_id'];
   		?>

		<?php if($count%2 == 0) { ?>


		<tr class='altrow'> <td align="center" valign="middle" class='newtblbrd'><?php echo $count++ ?></td><td align="left" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" class='newtblbrd' valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $proname; ?><a><span></td>
   		<td align="left" class='newtblbrd' valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $project_type_name?$project_type_name:"N/A"; ?></a></span></td>
		<td align="left" class='newtblbrd' valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $url?$url:"N/A"; ?></a></span></td>
		<td align="left" class='newtblbrd' valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $sponsor_name?$sponsor_name:"N/A (Need to add)"; ?></a></span></td>
		<td align="left" class='newtblbrd' valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $numunits?$numunits:'0'; ?></a></span></td>


		<!--<?php $companies1=explode(",", $companies);$length = strlen($companies);?>
		<td align="left" valign="middle"><?php if($length>6){
		$length=6;
			
		}else if($length==0){ ?>
		<a><span>N/A (Need to add)</a></span><br /><?php
		}?>
						
						<?php for($i=0;$i<=$length;$i++) {?>
						<a><span><?php echo $companies1[$i];?></a></span><br />
						<?php } ?>
		</td>-->
		<td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $commentdate?$commentdate:'N/A'; ?></span></td>
		<td align="center" valign="middle" class='newtblbrd'><?php if($eachrow['Project']['active_status']=='1'){ ?><a href="/admins/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/active.gif" alt="" title="Click here to deactivate <?php echo $eachrow['Project']['project_name']; ?>" /></a><?php }else{ ?><a href="/admins/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/deactive.gif" alt=""  title="Click here to activate <?php echo $eachrow['Project']['project_name']; ?>" /></a><?php }; ?></td>
		<?php if(!isset($sponsorid)) $sponsorid=""; ?>
		
		
		<!--<td align="left" valign="middle" class='newtblbrd'><button class="button" id="Submit" type="button" name="Select" href="/editprojecttype/<?php echo $site_id ?>"><span>Select Project</span> </button>-->
	</tr>
       	<?php } else { ?>

		<tr>    <td align="center" valign="middle"><?php echo $count++ ?></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $proname; ?><a><span></td>
   		<td align="left" valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $project_type_name?$project_type_name:"N/A"; ?></a></span></td>

		<td align="left" class='newtblbrd' valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id;?>"><span><?php echo $url?$url:"N/A"; ?></a></span></td>
		
		<td align="left" valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $sponsor_name?$sponsor_name:"N/A (Need to add)"; ?></a></span></td>
		<td align="left" valign="middle"><a href="/admins/editprojecttype/<?php echo $site_id; ?>"><span><?php echo $numunits?$numunits:'0'; ?></a></span></td>


		<!--<?php $companies1=explode(",", $companies);$length = strlen($companies);?>
		<td align="left" valign="middle"><?php if($length>6){
		$length=6;
			
		}else if($length==0){ ?>
		<a><span>N/A (Need to add)</a></span><br /><?php
		}?>
						
						<?php for($i=0;$i<=$length;$i++) {?>
						<a><span><?php echo $companies1[$i];?></a></span><br />
						<?php } ?>
		</td>-->
		<td align="center" valign="middle"><span style='color:#4d4d4d;'><?php echo $commentdate?$commentdate:'N/A'; ?></span></td>
		<td align="center" valign="middle"><?php if($eachrow['Project']['active_status']=='1'){ ?><a href="/admins/changestatus/<?php echo $recid.'/'.$modelname.'/'.'0/'.$redirectionurl.'/cngstatus'?>"><img src="/img/active.gif" alt="" title="Click here to deactivate <?php echo $eachrow['Project']['project_name']; ?>" /></a><?php }else{ ?><a href="/admins/changestatus/<?php echo $recid.'/'.$modelname.'/'.'1/'.$redirectionurl?>"><img src="/img/deactive.gif" alt=""  title="Click here to activate <?php echo $eachrow['Project']['project_name']; ?>" /></a><?php }; ?></td>
		<?php if(!isset($sponsorid)) $sponsorid=""; ?>
		
		
		<!--<td align="left" valign="middle"><button class="button" id="Submit" type="button" name="Select" href="/editprojecttype/<?php echo $site_id ?>"><span>Select Project</span> </button>-->
	</tr>	


	<?php } ?>	















	<?php } 
}else{ ?>
	<tr><td colspan="8" align="center">No Projects Found.</td></tr>
	<?php } ?>
	</table>
	

</div>



<!--inner-container ends here-->

                     <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($projectdata) { echo $this->renderElement('newpagination'); } ?>
        </div>
        <?php echo $form->end();?>

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>  <script type="text/javascript">
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
                document.getElementById("linkedit").href="/admins/editprojecttype/"+id; 
                
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
                                        window.location="/admins/changestatus/"+id+"/Project/1/index/cngstatus";
                                        }else{
                                        window.location="/admins/changestatus/"+id+"/Project/0/index/cngstatus";
                                        }
                        }
                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))
			if(confirm("Are You Sure to delete the item"))
                        window.location="/admins/changestatus/"+id+"/Project/0/index/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("indxpage").className = "newmidCont";
	}	
</script>
