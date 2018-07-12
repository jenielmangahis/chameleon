<!--container starts here-->
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'projectlist_by_btype';
$backUrl = $base_url_admin.'billingtype_list';
$this->proectlist="tabSelt";
?>
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px; margin:0 auto;">
       <div align="center" id="toppanel" >
      <?php  echo $this->renderElement('new_slider');  ?>
</div>
        <span class="newtitlTxt">Projects</span>
        <div class="topTabs">
			<ul class="dropdown">
                <li class="">
				<?php
				e(
					$html->link(
						$html->tag('span','New'),
						array('controller'=>'admins','action'=>'addproject'),
						array('escape'=>false)
					)	
				);
				?>
				</li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
				<li><a id="linkedit" href="<?php echo $backUrl ?>"><span>Cancel</span></a></li>
            </ul>
        </div>
        
        <div class="clear"></div>
           <?php  echo $this->renderElement('project_list_submenu');  ?>
</div></div>
<div class="midCont" id="indxpage">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
	    <?php echo $form->create("Admins", array("action" => "projectlist",'name' => 'adminhome', 'id' => "adminhome")) ?>
		<script type='text/javascript'>
			function setprojectid(projectid){
					document.getElementById('projectid').value= projectid;
					document.adminhome.submit();
				}
		</script>
		<div style="float:left">
		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
		<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span></div><div style="float:left">  <?php
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div>
	 </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
</div>
<div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		    <tr class="trBg">
				<th align="center" valign="middle" width="1%">#</th>
				<th align="center" valign="middle" width="1%">
				<input type="checkbox" id="checkall" name="checkall" value="">
				</th>
				<th align="center" width="7%"><span style="float:right"><?php echo $pagination->sortBy('project_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
				</span>
				Project
    			 </th>
	  		<th align="center" width="11%">
			<span style="float:right">
				<?php echo $pagination->sortBy('project_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			
			Project Type
			
			</th>
			<th align="center" width="13%"><span style="float:right">
			<?php echo $pagination->sortBy('url', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			Website URL
			</th>

 		      <th align="center"  width="9%"><span style="float:right">
			<?php echo $pagination->sortBy('sponsor_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			Sponsor
			
		      </th>
      		<th align="center"  width="12%">
			<span style="float:right">
			<?php echo $pagination->sortBy('numunits', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			# of Coins
			
		      </th>
    		<th align="center"  width="12%">
			<span style="float:right">
			<?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			Create Date
			</th>
     			<!--  <th align="left" valign="middle">Coinsets</th>-->
    		<th align="center" valign="middle" width="8%">
			<span style="float:right">
			<?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>
			Status</th>
			<th align="center" valign="middle" width="6%">
			Action</th>
		     <!--<th align="center" valign="middle" width="60px">&nbsp;</th>-->
      		</tr>
   	

   	<?php 
   	//pr($projectdata);	
	if($projectdata){ 
        
        $count=1;
   			foreach($projectdata as $eachrow){
   			$recid = $eachrow['Project']['id'];
   			$modelname = "Project";
   			$redirectionurl = "projectlist";
   			$proname = $eachrow['Project']['project_name'];
			if($proname) $proname = AppController::WordLimiter($proname,25);
   			//echo $eachrow['Project']['project_type_id'];
			$project_type_name = $eachrow['SiteType']['project_type_name'];
			$url = $eachrow['Project']['url'];
   			$sponsor_name = $eachrow['Sponsor']['sponsor_name'];
   			$numunits = $eachrow['Project']['numunits'];
			$crtdate = $eachrow['Project']['created'];
			$commentdate = AppController::usdateformat($crtdate,0);
   			$companies = $this->requestAction("admins/getcompaniesbyprojectid/$recid");
			if($companies) $companies = AppController::WordLimiter($companies,150);
   			$coinsets = $this->requestAction("admins/getcoinsetsbyprojectid/$recid");
   			
			$clsName = '';
			if($count%2 == 0) { $clsName = 'altrow';}
			
   		?>
		<tr class='<?php echo $clsName ?>'>
		<td align="center" valign="middle" class='newtblbrd'><?php echo $count++ ?></td>
		<td align="left" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', $proname),
			array('controller'=>'admins','action'=>'editproject',$recid),
			array('escape' => false)
			)
		);
		?>
		</td>
   		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', $project_type_name?$project_type_name:"N/A"),
			array('controller'=>'admins','action'=>'editproject',$recid),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', $url?$url:"N/A"),
			array('controller'=>'admins','action'=>'editproject',$recid),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', $sponsor_name?$sponsor_name:"N/A (Need to add)"),
			array('controller'=>'admins','action'=>'editproject',$recid),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="center" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', $numunits?$numunits:'0'),
			array('controller'=>'admins','action'=>'editproject',$recid),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $commentdate?$commentdate:'N/A'; ?></span></td>
		<td align="center" valign="middle" class='newtblbrd'>
		<?php 
		if($eachrow['Project']['active_status']=='1'){
			e($html->link(
				$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['Project']['project_name'])),
				array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Deactivate Project ?',
                false
				)
			);
		} else {
			e($html->link(
				$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['Project']['project_name'])),
				array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Activate Project ?',
                false
				)
			);
		}			
		?>
		</td>
		<td align="center" valign="middle">
		<?php
		e($html->link(
			$html->tag('span', 'View'),
			'javascript:void(0)',
			array('escape' => false,'onclick' => "return setprojectid($recid)",'title'=>'Project Detail View' )
			)
		);
		?>
		</td>
		
		</tr>
       	
	<?php } 
}else{ ?>
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
			document.getElementById("linkedit").href=baseUrlAdmin+"editproject/"+id; 
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
                                        if(confirm("Are you sure you want to Activate project(s)?"))   {
                                             window.location=baseUrlAdmin+"changestatus/"+id+"/Project/1/projectlist/cngstatus";      
                                        } 
                                        
                                        }else{
                                            if(confirm("Are you sure you want to Deactivate project(s)?"))   { 
                                                window.location=baseUrlAdmin+"changestatus/"+id+"/Project/0/projectlist/cngstatus";
                                            }
                                        }
                        }
                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))
			if(confirm("Are You Sure to delete the item"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/Project/0/projectlist/delete";
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