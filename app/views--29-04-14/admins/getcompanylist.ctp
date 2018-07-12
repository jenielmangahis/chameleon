<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'getcompanylist/'.$company_type_id;
$backUrl = $base_url_admin.'companytype';
?>
<script type="text/javascript">

$(document).ready(function() {
 
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 

</script>  
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
                    <?php echo $form->create("Admins", array("action" => "getcompanylist/".$company_type_id,'name' => 'getcompanylist', 'id' => "getcompanylist")) ?>   
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
<span class="titlTxt1"><?php if(!empty($companydata[0])) { echo $companydata[0]['CompanyType']['company_type_name']; }else{ echo $company_type_name; }?>:</span><span class="titlTxt"> Companies</span>
<div class="topTabs">
        <ul class="dropdown">
               <!-- <li class=""><a href="/admins/addcompanytype"><span>New</span></a></li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                        <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                </ul></li>-->
                <li><a id="linkedit" onclick="editcompanytype();" href="javascript:void(0)"><span>Edit</span></a></li>
				<li><a id="linkedit" href="<?php echo $backUrl ?>"><span>Cancel</span></a></li>
        </ul>
        </div><div class="clear"></div>
            <?php $this->companytype="tabSelt";echo $this->renderElement('super_admin_types'); ?>
</div></div>
<div class="midCont" id="newcmptab">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>         		
       
        <div class="gryTop">

                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
                  <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl; ?>')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                        <?php $session->flash(); ?> <?php } 
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
      <th align="center" valign="middle" style="width:10px;">#</th>
      <th align="center" valign="middle" style="width:10px;"><input type="checkbox" id="checkall" name="checkall" value=""></th>
<!--      <th align="center" valign="middle" style="width:150px;"><span class="right"><?php echo $pagination->sortBy('company_type_id', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Company Type</th>-->
      <th align="center" valign="middle" style="width:150px;"><span class="right"><?php echo $pagination->sortBy('company_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Company Name</th>
      <th align="center" valign="middle" style="width:150px;"><span class="right"><?php echo $pagination->sortBy('email', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Email</th>
      <th align="center" valign="middle" style="width:150px;"><span class="right"><?php echo $pagination->sortBy('phone', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Phone</th>
      <th align="center" valign="middle" style="width:150px;"><span class="right"><?php echo $pagination->sortBy('website', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Website</th>

      </tr>
   	<?php if($companydata){ $i=1;
   			foreach($companydata as $eachrow){
   			$recid = $eachrow['Company']['id'];
   			$modelname = "Company";
   			$redirectionurl = "getcompanylist";
   			$company_type_name = $eachrow['CompanyType']['company_type_name'];
   			$company_name = $eachrow['Company']['company_name'];
			if($company_name) $company_name = AppController::WordLimiter($company_name,25);
   			$email = $eachrow['Company']['email'];
			$company_typeid=$eachrow['Company']['company_type_id'];
			if($email) $email = AppController::WordLimiter($email,35);
   			$phone = $eachrow['Company']['phone'];
   			$website = $eachrow['Company']['website'];
			if($website) $website = AppController::WordLimiter($website,38);
   		?>

	<?php if($i%2 == 0) { ?>
        <tr class='altrow'>    <td align="center" class='newtblbrd' valign="middle"><span style="color:#4d4d4d;"><?php echo $i++ ?></span></td>
		<td align="center" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
<!--		<td align="left" valign="middle" class='newtblbrd'><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $company_type_name; ?></span></a></td>-->
		<td align="left" valign="middle" class='newtblbrd'><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $company_name; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $email?$email:'N/A'; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $phone?$phone:'N/A'; ?></span></a></td>
		<td align="left" valign="middle" class='newtblbrd'><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $website?$website:'N/A'; ?></span></a></td>
	
		</tr>

	<?php } else { ?>

		<tr>    <td align="center" valign="middle"><span style="color:#4d4d4d;"><?php echo $i++ ?></span></td><td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
<!--		<td align="left" valign="middle"><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $company_type_name; ?></span></a></td>-->
		<td align="left" valign="middle"><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $company_name; ?></span></a></td>
		<td align="left" valign="middle"><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $email?$email:'N/A'; ?></span></a></td>
		<td align="left" valign="middle"><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $phone?$phone:'N/A'; ?></span></a></td>
		<td align="left" valign="middle"><a href='/admins/editcompanytype/<?php echo $company_typeid;?>'><span><?php echo $website?$website:'N/A'; ?></span></a></td>
	
		</tr>

	<?php } ?>	
	<?php } }else{ ?>
	<tr><td colspan="6" align="center">No Company Found.</td></tr>
	<?php } ?>
</table>
        
</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
        <?php if($companydata) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>

	</table>


</div>
</div><!--inner-container ends here-->

  




<div class="clear"></div>


</div>    <script type="text/javascript">
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



        function editcompanytype()
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
        
        if(counter > 1)
        {
                alert("please select only one row  to edit");
                return false;
                }else{  
                document.getElementById("linkedit").href=baseUrlAdmin+"editcompanytype/<?php echo $company_type_id; ?>"; 
                
                }
        } 


function activatecontents(act,op)
{       
        var id="";
        $('.checkid').each(function(){
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                {
                        if(id=="")
                                id=$(this).val();
                        else
                                id=id + "*" + $(this).val();
                }
   });
        if(id !=""){
                        if(op=="change"){
                                if(act=="active"){
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommentType/1/getcompanylist/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommentType/0/getcompanylist/cngstatus";
                                        }
                        }
                        if(op=="del"){
						if(confirm("Are you sure to delete the item ?"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/Company/0/getcompanylist/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  


<!--container ends here-->
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newcmptab").className = "newmidCont";
	}	
</script>
