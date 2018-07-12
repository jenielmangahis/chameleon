<!--container starts here-->
<?php 
$pagination->setPaging($paging);
//pr($projectdata);
?>
<div class="titlCont1"><div style="width:960px; margin:0 auto;">
       <div align="center" id="toppanel" >
      <?php  echo $this->renderElement('new_slider');  ?>
</div>
  <?php echo $form->create("Admins", array("action" => "ownerlist",'name' => 'adminhome', 'id' => "adminhome")) ?>
        <span class="newtitlTxt">Project Owners</span>
        <div class="topTabs">

                <ul class="dropdown">
				<li class=""><a href="javascript:void(0)" onclick="return viewprojectsponsor();"><span>View</span></a></li>
				<li class="">
					<a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
					<ul class="sub_menu" style="visibility: hidden;">
							<li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
							<li class="botCurv"></li>
					</ul>
				</li>
                </ul>
        </div>
</div></div>
<div class="midCont" id="indxpage">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
	    
<div style="float:left">
		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
		<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'ownerlist')" id="locaa"></span></div><div style="float:left">  <?php
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.sponsorid", array('id' => 'sponsorid'));
        ?></div>
	 </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
</div>
<div class="tblData">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		    <tr class="trBg">
			<th align="center" valign="middle" width="1%"># </th>
			<th align="center" valign="middle" width="2%">
				<input type="checkbox" id="checkall" name="checkall" value="">
			</th>
            <th align="center"  width="21%"><span style="float:right">
            <?php echo $pagination->sortBy('sponsor_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Project Owner
           </th>
           
			<th align="center" width="20%"><span style="float:right">
            <?php echo $pagination->sortBy('project_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			  </span>
				Project
    		 </th>
                 
	  		<th align="center" width="24%">
			<span style="float:right">
				<?php echo $pagination->sortBy('project_type_name',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			
			Project Type</th>
            
            <th align="center"  width="12%">
            <span style="float:right">
            <?php echo $pagination->sortBy('email',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Email
            </th>
            
			<th align="center" width="12%"><span style="float:right">
			<?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			City
			</th>


      		      <th align="center" width="8%">
			<span style="float:right">
			<?php echo $pagination->sortBy('state_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			State
			</th>

     			<!--  <th align="left" valign="middle">Coinsets</th>-->
    		<?php /* ?>
			<th align="center" valign="middle" width="10%">
			<span style="float:right">
			<?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			Status</th>
			<?php */ ?>
      		</tr>
   	<?php 
   	if($projectdata){ 
        
        $count=1;
   			foreach($projectdata as $eachrow){	//echo '<pre>';print_r($eachrow);
   			$recid = $eachrow['Company']['id'];
   			$pid = $eachrow['Project']['id'];
   			$modelname = "Company";
   			$redirectionurl = "ownerlist";
   			$proname = $eachrow['Project']['project_name'];
			if($proname) $proname = AppController::WordLimiter($proname,25);
   			$project_type_name = $eachrow['SiteType']['project_type_name'];
			$email = $eachrow['Company']['email'];
   			$sponsor_name = $eachrow['Company']['company_name'];
   			$city = $eachrow['Company']['city'];
			//$state = $eachrow['State']['state_name'];
			$state = $eachrow['State']['Code'];
			//$commentdate = AppController::usdateformat($crtdate,1);
   			//$companies = $this->requestAction("admins/getcompaniesbyprojectid/$recid");
			//if($companies) $companies = AppController::WordLimiter($companies,150);
   			//$coinsets = $this->requestAction("admins/getcoinsetsbyprojectid/$recid");
   			$rowCls = '';
			if($count%2 == 0) {
			$rowCls = 'altrow';
			}
   		?>
		<tr class='<?php echo $rowCls ?>'> <td align="center" valign="middle" class='newtblbrd'>
		<?php 
		//echo $form->text("companyProjectID".$recid.'_'.$pid, array('id' => 'companyProjectID','value'=>'cp_'.$recid.'_'.$pid));
		echo $count++ ?></td>
		<td align="left" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid" alt="<?php echo $pid; ?>"></td>
        <td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($sponsor_name)?$sponsor_name:'N/A (Need to add)'),
			'javascript:void(0)',
			array('escape' => false,'onclick' => "return sendToProjectDashboard($pid,'projectsponsor')")							
			)
		);
		?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($proname)?$proname:'N/A'),
			'javascript:void(0)',
			array('escape' => false,'onclick' => "return sendToProjectDashboard($pid,'projectsponsor')")							
			)
		);
		?>
		</td>
   		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($project_type_name)?$project_type_name:'N/A'),
			'javascript:void(0)',
			array('escape' => false,'onclick' => "return sendToProjectDashboard($pid,'projectsponsor')")							
			)
		);
		?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($email)?$email:'N/A'),
			'javascript:void(0)',
			array('escape' => false,'onclick' => "return sendToProjectDashboard($pid,'projectsponsor')")							
			)
		);
		?>
		</td>
		
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($city)?$city:'N/A'),
			'javascript:void(0)',
			array('escape' => false,'onclick' => "return sendToProjectDashboard($pid,'projectsponsor')")							
			)
		);
		?>
		</td>

		<td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $state?$state:"N/A"; ?></span></td>
		
		<?php if(!isset($sponsorid)) $sponsorid=""; ?>

	</tr>
	<?php } }else{ ?>
	<tr><td colspan="8" align="center">No Projects Found.</td></tr>
	<?php } ?>
	</table>
</div>



<!--inner-container ends here-->
<?php echo $form->end();?>
                     <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($projectdata) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>  
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
        function viewprojectsponsor()
        {       
        var counter=0;
        var id="";
        $('.checkid').each(function(){          
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                {               
				   id=$(this).val();
				   counter=counter+1;         
                               
                }
        });     
        
        if(counter!=1)
        {
                alert("please select only one row  to edit");
                return false;
                }else{  
                    
                      gotosponsorpage(id);
                           /*  document.getElementById('sponsorid').value= id;
                                document.adminhome.submit();   */
                               
                
                }
        } 
		
		function activatecontents(act,op) {
			var id="";
			var pid="";
			
			var count=0;
			$('.checkid').each(function(){
				var check = $(this).attr('checked')?1:0;
				if(check ==1)
				{
					if(id==""){
						id=$(this).val();
						pid=$(this).attr('alt');
						++count;
					}
					else {
						id = id + "*" + $(this).val();
						pid = pid + "*" + $(this).attr('alt');
						++count;
					}
				}
		   });
		   // alert(id+'       '+pid);   return false;
			if(id !=""){
						if(op=="change"){       
								if(act=="active"){
									if(confirm("Are you sure you want to Activate project(s)?"))   {
										 window.location=baseUrlAdmin+"changestatus/"+id+"/StatusType/1/status_type_list/cngstatus";      
									} 
										
								}else{
									if(confirm("Are you sure you want to Deactivate project(s)?"))   { 
										window.location=baseUrlAdmin+"changestatus/"+id+"/StatusType/0/status_type_list/cngstatus";
									}
								}
						}
						
						if(op=="del"){
						if(confirm("You have selected "+count +" items to delete ?"))

						if(confirm("Are you sure to delete the item ?"))
						//alert(id+'       '+pid);
						//alert("yess");
						window.location=baseUrlAdmin+"sponsor_delete/"+id+'/'+pid;
						}
							
			}else{
					alert('Please atleast one record should be select'); 
					return false;
			}
		}

        function gotosponsorpage(sponsorid){
                     document.getElementById('sponsorid').value= sponsorid;
                     document.adminhome.submit();
                }
</script>  
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("indxpage").className = "newmidCont";
	}	
</script>

