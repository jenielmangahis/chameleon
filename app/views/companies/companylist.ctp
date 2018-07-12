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
		document.getElementById("linkedit").href=baseUrl+"companies/addcompany/"+id; 
		
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
			
			if(op=="del"){
			if(confirm("You have selected "+count+" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
			window.location=baseUrl+"companies/changestatus/"+id+"/Company/0/companylist/delete";
			}
	}else{
		alert('Please atleast one record should be select'); 
		return false;
	}
}
</script>
<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
   <div class="container">
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php
		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '41'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   
  echo $this->renderElement('new_slider');  ?>


</div>
  <?php echo $form->create("Company", array("action" => "companylist",'name' => 'companylist', 'id' => "companylist")) ?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
        </script>
<span class="titlTxt">
Companies
</span>
<div class="topTabs">
<ul class="dropdown">
<li>
<?php
	e($html->link(
		$html->tag('span', 'New'),
		array('controller'=>'companies','action'=>'addcompany'),
		array('escape' => false)
		)
	);
?>
</li>
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
        			 <!--li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li-->
        			 <!--li><a href="javascript:void(0)">Copy</a></li-->
        			 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
        		</ul>
</li>
<li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
</ul>
</div>
<?php  $this->loginarea="companies";    
$this->subtabsel="companylist";
echo $this->renderElement('contact_submenus');  ?>   
</div></div>
    <div class="midCont" id="newcmptab">
	 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <!-- top curv image starts -->
    <div>
    <span class="topLft_curv"></span>
    <div class="gryTop">		
				   <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                    ?> 
                </span>
								<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/companylist')" id="locaa"></span>		
		
                    </div>	<span class="topRht_curv"></span>
                    <div class="clear"></div></div>

<?php $i=1; ?>					
     <div class="tblData">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
	<th align="center" valign="middle" style='width:1%'>#</th>
	<th align="center" valign="middle" style='width:2%'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
	<th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('company_type_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Type</th>
        <th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Name</th>
        <th align="center" valign="middle" style='width:20%'><span class="right"><?php echo $pagination->sortBy('email', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Email</th>
        <th align="center" valign="middle" style='width:15%'><span class="right"><?php echo $pagination->sortBy('phone', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Phone</th>
        <th align="center" valign="middle" style='width:20%'><span class="right"><?php echo $pagination->sortBy('website', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Website</th>   
      </tr>
   	<?php if($companydata){ 
		$i=1;
   			foreach($companydata as $eachrow){
   			$recid = $eachrow['Company']['id'];
   			$modelname = "Company";
   			$redirectionurl = "companylist";
   			$company_type_id = $eachrow['CompanyType']['company_type_name'];
   			$company_name = $eachrow['Company']['company_name'];
			if($company_name) $company_name = AppController::WordLimiter($company_name,15);
   			$email = $eachrow['Company']['email'];
			if($email)	$email = AppController::WordLimiter($email,27);
   			$phone = $eachrow['Company']['phone'];
   			$website = $eachrow['Company']['website'];
			if($website) $website = AppController::WordLimiter($website,15);
   		?>

<?php if($i%2 == 0) { ?>
   	<tr class='altrow'>	
			
		<td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
		<td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'>
			<?php
					e($html->link(
					$html->tag('span', $company_type_id),
					array('controller'=>'companies','action'=>'addcompany',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			<?php
					e($html->link(
					$html->tag('span', $company_name),
					array('controller'=>'companies','action'=>'addcompany',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			<?php
				e($html->link(
				$html->tag('span', ($email)?$email:'N/A'),
				array('controller'=>'companies','action'=>'addcompany',$recid),
				array('escape' => false)
				)
			);
			?>
			
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			<?php
				e($html->link(
				$html->tag('span', ($phone)?$phone:'N/A'),
				array('controller'=>'companies','action'=>'addcompany',$recid),
				array('escape' => false)
				)
			);
			?>
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			<?php
				e($html->link(
				$html->tag('span', ($website)?$website:'N/A'),
				array('controller'=>'companies','action'=>'addcompany',$recid),
				array('escape' => false)
				)
			  );
			?>
		</td>
		
		</tr>
<?php } else { ?>
	<tr>	

                                <td align="left"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="left"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="left" valign="middle">								
							<?php
									e($html->link(
									$html->tag('span', $company_type_id),
									array('controller'=>'companies','action'=>'addcompany',$recid),
									array('escape' => false)
									)
								);
							?>
									
								</td>
                                <td align="left" valign="middle">
									<?php
										e($html->link(
										$html->tag('span', $company_name),
										array('controller'=>'companies','action'=>'addcompany',$recid),
										array('escape' => false)
										)
									);
								?>


								</td>
                                <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span', ($email)?$email:'N/A'),
									array('controller'=>'companies','action'=>'addcompany',$recid),
									array('escape' => false)
									)
								);
								?>
								</td>
                                <td align="left" valign="middle">
									
									<?php
									e($html->link(
									$html->tag('span', ($phone)?$phone:'N/A'),
									array('controller'=>'companies','action'=>'addcompany',$recid),
									array('escape' => false)
									)
								);
								?>		
								</td>
                                <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span', ($website)?$website:'N/A'),
									array('controller'=>'companies','action'=>'addcompany',$recid),
									array('escape' => false)
									)
								);
								?>
								</td>

                            </tr>



<?php } ?>


	<?php } }else{ ?>
	<tr><td colspan="6" align="center">No Company Found.</td></tr>
	<?php } ?>
	</table> 
    
			
 </div>
                    <div>
                    <span class="botLft_curv"></span>
<div class="gryBot"><?php if($companydata) { echo $this->renderElement('newpagination'); } ?>
                    </div><span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->

<?php echo $form->end();?>

                    </div>

<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newcmptab").className = "newmidCont";
	}	
</script>