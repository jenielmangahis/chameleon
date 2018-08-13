<!--container starts here-->
<script type="text/javascript">
$(document).ready(function() {
$('#coNtact').removeClass("butBg");
$('#coNtact').addClass("butBgSelt");
}); 
</script>
<?php 
$baseUrlAdmin = Configure::read('App.base_url_admin');
$baseUrl = Configure::read('App.base_url');
?>
<?php $pagination->setPaging($paging); ?>
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-3">
            	<h2>Contact List</h2>
            </div>
            <div class="slider-dashboard col-sm-9">
            	<div class="icon-big-container">
                	<?php echo $form->create("contacts", array("action" => "sa_contactlist",'name' => 'contactlist1', 'id' => "contactlist1"))?>	
					<?php
                    $ids = $this->params['pass'][0]; 
                    e($html->link($html->image('call.png') . ' ' . __(''), array('controller'=>'admins','action'=>'call',$ids),array('escape' => false)));
                    e($html->link($html->image('email.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendtempmail',$ids),array('escape' => false)));
                    e($html->link($html->image('sms.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendsms','1'),array('escape' => false)));
                    e($html->link($html->image('message.png') . ' ' . __(''), array('controller'=>'admins','action'=>'messagenew',$ids),array('escape' => false)));
                    e($html->link($html->image('event.png') . ' ' . __(''), array('controller'=>'admins','action'=>'appointment',$ids),array('escape' => false)));
                    e($html->link($html->image('note.png') . ' ' . __(''), "../players/notelist/2",array('escape' => false)));
                    e($html->link($html->image('take.png') . ' ' . __(''), array('controller'=>'admins','action'=>'coming_soon','task'),array('escape' => false)));
                    e($html->link($html->image('new.png') . ' ', $base_url.'sa_addcontacts',array('escape' => false)));?>
                    <a onclick="return activatecontents('asd','del');" href="javascript:void(0)"><?php e($html->image('action.png')); ?></a>
                    <a id="linkedit" onclick="editholder();" href="javascript:void(0)"><?php e($html->image('edit.png')); ?></a>
                    <?php echo $this->renderElement('new_slider');?>
                </div>
                
            </div>
            <!--<span class="titlTxt">Contact List</span>-->
            <div class="topTabs" style="height:25px;">
        <?php /*?><ul class="dropdown">
                <li class="">
					<?php
						e($html->link(
						$html->tag('span', 'New'),
						array('controller'=>'contacts','action'=>'sa_addcontacts'),
						array('escape' => false)
						)
					  );
					?>
				</li>
                <li>
					<a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
						 <ul class="sub_menu">                
						    <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
							  <li class="botCurv"></li>
						</ul>
				</li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
        </ul><?php */?>
        </div>
        	<!--<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">		 
			</div>-->
        </div>
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="contacts";    $this->subtabsel="sa_contactlist";
             echo $this->renderElement('relationships_submenus');  ?>  
    </div>
</div>

<div class="midCont" id="newcnttab">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


    <div>
    <!--<span class="topLft_curv"></span>  
    <span class="topRht_curv"></span>-->             
        <div class="gryTop">
                <?php echo $form->create("contacts", array("action" => "sa_contactlist",'name' => 'contactlist1', 'id' => "contactlist1")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>       <div class="new_filter">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'contacts/sa_contactlist')" id="locaa"></span>
                </div>
  <div style="float:left">   <?php 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div> 
               <div class="clear"></div>
         </span>
        </div>
       

<div class="tblData table-responsive">
                      <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="trBg">
      <th style="width:1%" align="center" valign="middle">#</th>
      <th  style="width:2%" align="center" valign="middle"><input type="checkbox" id="checkall" name="checkall" value=""></th>
      <th align="center" valign="middle" style="width:13%"><span class="right">
	  <?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>First Name</th>
      <th align="center" valign="middle" style="width:13%"><span class="right"><?php echo $pagination->sortBy('lastname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Last Name</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Company Name</th>
      <th align="center" valign="middle"style="width:15%"><span class="right"><?php echo $pagination->sortBy('contact_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Contact Type</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('email',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Email</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('mobile', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Mobile</th>

      </tr>
   	<?php if($contactdata){ 
			$i=1;
			// Start of Record no, custmization
   			$pagerL = Configure::read('Pagging.limit');	 
			if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
			$i= $i+($pagerL*($this->params['url']['page']-1));
			}
			// End
			
   			foreach($contactdata as $eachrow){
			$companyID=$eachrow['Company']['id'];
			if(empty($companyID))
			{
				$companyID='null';
			}
   			$recid = $eachrow['Contact']['id'];
   			$modelname = "Contact";
   			$redirectionurl = "sa_contactlist";
   			$fname = $eachrow['Contact']['firstname'];
			if($fname) $fname = AppController::WordLimiter($fname,15);
   			$lname = $eachrow['Contact']['lastname'];
			if($lname) $lname = AppController::WordLimiter($lname,15);
   			
   			$companyname = $eachrow['Company']['company_name'];
			if($companyname) $companyname = AppController::WordLimiter($companyname,33);   			
			$contacttype = $eachrow['ContactType']['contact_type_name'];
   			
   			$email = $eachrow['Contact']['email'];
			if($email) $email = AppController::WordLimiter($email,33);   			
			$mobile = $eachrow['Contact']['mobile'];
   			
   		?>

<?php if($i%2 == 0) { ?>	

<tr class='altrow'> <td align="center" class='newtblbrd' valign="middle"><?php echo $i++ ?></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" class='newtblbrd' valign="middle" >
		<?php
				e($html->link(
					$html->tag('span', $fname),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" class='newtblbrd' valign="middle">
			
			<?php
				e($html->link(
					$html->tag('span', $lname),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" class='newtblbrd' valign="middle">
			
			<?php
				e($html->link(
					$html->tag('span', $companyname),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" class='newtblbrd' valign="middle">

			<?php
				e($html->link(
					$html->tag('span', $contacttype?$contacttype:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" class='newtblbrd' valign="middle">
			
				<?php
				e($html->link(
					$html->tag('span', $email?$email:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>

		</td>
		<td align="left" class='newtblbrd' valign="middle">
			
			<?php
				e($html->link(
					$html->tag('span', $mobile?$mobile:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>

		</td>
		
	
		</tr>
<?php } else { ?>

		<tr>
			<td align="center" valign="middle"><?php echo $i++ ?></td>
			<td align="left" valign="middle"><input type="checkbox"	value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $fname),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>
			
		</td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $lname),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle">
			
				<?php
				e($html->link(
					$html->tag('span', $companyname),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $contacttype?$contacttype:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $email?$email:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $mobile?$mobile:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcontacts',$recid,$companyID,'contact'),
					array('escape' => false)
					)
				);
			?>
			
		</td>
		
	
		</tr>
<?php } ?>	


	<?php } }else{ ?>
	<tr><td colspan="7" align="center">No Contacts Found.</td></tr>
	<?php } ?>
	</table>
	
</div>
   <div>
                    <!--<span class="botLft_curv"></span>
      				<span class="botRht_curv"></span>-->
                    <div class="gryBot">
                    
                  <?php if($contactdata) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>
					</div>



        
</div><!--inner-container ends here-->
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
                document.getElementById("linkedit").href=baseUrl+"contacts/sa_addcontacts/"+id; 
                
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
                                        window.location=baseUrl+"contacts/changestatus/"+id+"/CommentType/1/sa_contactlist/cngstatus";
                                        }else{
                                        window.location=baseUrl+"contacts/changestatus/"+id+"/CommentType/0/sa_contactlist/cngstatus";
                                        }
                        }
                        if(op=="del"){
			if(confirm("Are you sure to delete the item ?"))
                        window.location=baseUrl+"contacts/changestatus/"+id+"/Contact/0/sa_contactlist/delete";
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