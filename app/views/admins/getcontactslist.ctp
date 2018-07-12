<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'contacttype';
$backUrl = $base_url_admin.'contacttype';
?>
<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script>  

<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
        <?php echo $form->create("Admins", array("action" => "contacttype",'name' => 'contacttype', 'id' => "contacttype")); ?>
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt"><?php if(!empty($contactdata[0]['ContactType']['contact_type_name'])) echo $contactdata[0]['ContactType']['contact_type_name']; ?>: Contacts
</span>
<div class="topTabs">
        <ul class="dropdown">
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
				<li><a id="linkedit" href="<?php echo $backUrl ?>"><span>Cancel</span></a></li>
        </ul>
        </div>  <div class="clear"></div>
            <?php $this->contcattype="tabSelt";echo $this->renderElement('super_admin_types'); ?>
</div></div>
<div class="midCont" id="newcnttab">	

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                <?php echo $form->create("Admins", array("action" => "contacttype",'name' => 'contacttype', 'id' => "contacttype")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>     <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
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
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="trBg">
      <th style="width:1%" align="center" valign="middle">#</th>
      <th  style="width:2%" align="center" valign="middle"><input type="checkbox" id="checkall" name="checkall" value=""></th>
      <th align="left" valign="middle"><span class="right"><?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>First Name</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('lastname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Last Name</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Name</th>
<!--      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('contact_type_name', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Contact Type</th>-->
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('email', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Email</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('mobile', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Mobile</th>

      </tr>
   	<?php if($contactdata){ $i=1;
   	//echo "<pre>"; 
   	//print_r($contactdata);
   			foreach($contactdata as $eachrow){
   			$recid = $eachrow['Contact']['id'];
   			$modelname = "Contact";
   			$redirectionurl = "contactlist1";
   			$fname = $eachrow['Contact']['firstname'];
			if($fname) $fname = AppController::WordLimiter($fname,15);
   			$lname = $eachrow['Contact']['lastname'];
			if($lname) $lname = AppController::WordLimiter($lname,15);
   			
   			$companyname = $eachrow['Company']['company_name'];
			if($companyname) $companyname = AppController::WordLimiter($companyname,33);   			
			$contacttype = $eachrow['ContactType']['contact_type_name'];
   			$contacttype_id=$eachrow['ContactType']['id'];
   			$email = $eachrow['Contact']['email'];
			if($email) $email = AppController::WordLimiter($email,33);   			
			$mobile = $eachrow['Contact']['mobile'];
   			
   		?>

<?php if($i%2 == 0) { ?>	

<tr class='altrow'>    <td align="center" class='newtblbrd' valign="middle"><?php echo $i++ ?></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" class='newtblbrd' valign="middle" >
		<?php
		e($html->link(
			$html->tag('span', $fname ),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">

		<?php
		e($html->link(
			$html->tag('span', $lname ),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>
				
		</td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', $companyname ),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($email)?$email:'N/A'),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($mobile)?$mobile:'N/A'),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>	
		</td>
		</tr>
<?php } else { ?>

<tr>    <td align="center" valign="middle"><?php echo $i++ ?></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" valign="middle">
			
		<?php
		e($html->link(
			$html->tag('span', $fname ),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" valign="middle">
			
			<?php
		e($html->link(
			$html->tag('span', $lname ),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" valign="middle">	
		<?php
		e($html->link(
			$html->tag('span', $companyname ),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>
		</td>
		<td align="left" valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($email)?$email:'N/A'),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>

		</td>
		<td align="left" valign="middle">
		<?php
		e($html->link(
			$html->tag('span', ($mobile)?$mobile:'N/A'),
			array('controller'=>'admins','action'=>'editcontacttype',$contacttype_id),
			array('escape' => false)
			)
		);
		?>	
		</td>	
		</tr>
<?php } ?>	


	<?php } }else{  ?>
	<tr><td colspan="7" align="center">No Contacts Found.</td></tr>
	<?php } ?>
	</table>
	</table>
        
</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($contactdata) { echo $this->renderElement('newpagination'); } ?>
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
        if(counter !=1)
        {
                alert("please select only one row  to edit");
                return false;
                }else{
                document.getElementById("linkedit").href=baseUrlAdmin+"editcontacttype/<?php if(!empty($contactdata[0]['ContactType']['id'])) echo $contactdata[0]['ContactType']['id']; ?>";

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
                                        window.location="/admins/changestatus/"+id+"/CommentType/1/contactlist1/cngstatus";
                                        }else{
                                        window.location="/admins/changestatus/"+id+"/CommentType/0/contactlist1/cngstatus";
                                        }
                        }
                        if(op=="del"){
			if(confirm("Are you sure to delete the item ?"))
                        window.location="/admins/changestatus/"+id+"/Contact/0/contactlist1/delete";
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
	document.getElementById("newcnttab").className = "newmidCont";
	}	
</script>
