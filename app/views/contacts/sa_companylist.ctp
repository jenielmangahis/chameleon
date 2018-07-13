<script type="text/javascript">
$(document).ready(function() {
$('#compAnies').removeClass("butBg");
$('#compAnies').addClass("butBgSelt");
}); 
</script>
<?php
$base_url = Configure::read('App.base_url');
$resetUrl = $base_url.'contacts/sa_companylist';
?>


<!--container starts here-->
<?php $pagination->setPaging($paging); ?>

<div class="container">
<div class="titlCont">

<div class="centerPage">
 <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
 <?php echo $form->create("contacts", array("action" => "sa_companylist",'name' => 'companylist1', 'id' => "companylist1"))?>
      
         <?php 
		 
		 $ids = $this->params['pass'][0]; 
e($html->link($html->image('call.png') . ' ' . __(''), array('controller'=>'admins','action'=>'call',$ids),array('escape' => false)));

e($html->link($html->image('email.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendtempmail',$ids),array('escape' => false)));

e($html->link($html->image('sms.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendsms','1'),array('escape' => false)));


e($html->link($html->image('message.png') . ' ' . __(''), array('controller'=>'admins','action'=>'messagenew',$ids),array('escape' => false)));

e($html->link($html->image('event.png') . ' ' . __(''), array('controller'=>'admins','action'=>'appointment',$ids),array('escape' => false)));

e($html->link($html->image('note.png') . ' ' . __(''), "../players/notelist/2",array('escape' => false)));

e($html->link($html->image('take.png') . ' ' . __(''), array('controller'=>'admins','action'=>'coming_soon','task'),array('escape' => false)));
		 e($html->link($html->image('new.png') . ' ' . __(''), array('controller'=>'contacts','action'=>'sa_addcompany'),array('escape' => false)));?>
		 <a onclick="return activatecompanycontents('asd','del');" href="javascript:void(0)">
		 <?php e($html->image('action.png')) ?>
		 </a>
		 <a id="linkedit" onclick="editholder();" href="javascript:void(0)">
		  <?php e($html->image('edit.png')) ?>
		 </a>
		 <?php  echo $this->renderElement('new_slider');  ?>

</div>



<span class="titlTxt">Company List  </span>

<div class="topTabs" style="height:25px;">

        <?php /*?><ul class="dropdown">
                <li class="">
				<?php
						e($html->link(
						$html->tag('span', 'New'),
						array('controller'=>'contacts','action'=>'sa_addcompany'),
						array('escape' => false)
						)
					  );
					?>
				</li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                <ul class="sub_menu">
                  
                        <li><a onclick="return activatecompanycontents('asd','del');" href="javascript:void(0)">Trash</a></li>

                        <li class="botCurv"></li>
                </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
        </ul><?php */?>
        </div>
		
				   <?php    $this->loginarea="contacts";    $this->subtabsel="sa_companylist";
                      echo $this->renderElement('relationships_submenus');  ?> 
		

			 
</div>
</div>

<div class="midCont" id="newcmptab">
<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;  position: absolute;   z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>
											
											

        <div>
                            <span class="topLft_curv"></span>
                            <span class="topRht_curv"></span>
	
        <div class="gryTop">
		 	<div class="new_filter" >
			
                <?php echo $form->create("contacts", array("action" => "sa_companylist",'name' => 'companylist1', 'id' => "companylist1")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>  
				<div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("contacts.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div> 
               <div class="clear"></div>
         </span>
        </div>
        <div class="clear"></div>
</div>

<div class="tblData">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="trBg"> 
      <th align="center" valign="middle" style="width:1%;">#</th>
      <th align="center" valign="middle" style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
      
	    <th align="center" valign="middle" style="width:21%"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Name</th>
		
		
	  <th align="center" valign="middle" style="width:20%;"><span class="right"><?php echo $pagination->sortBy('company_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Type</th>
      
	  <th align="center" valign="middle" style="width:20%;"><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>City</th>
	  
	   <th align="center" valign="middle" style="width:20%;"><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>ST</th>
      
	  
      
	  <th align="center" valign="middle" style="width:17%"><span class="right"><?php echo $pagination->sortBy('phone', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Phone</th>
      
	  <th align="center" valign="middle" style="width:17%"><span class="right"><?php echo $pagination->sortBy('website',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Website</th>

      </tr>
   	<?php if($companydata){ 
			$i=1;
			// Start of Record no, custmization
   			$pagerL = Configure::read('Pagging.limit');	 
			if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
			$i= $i+($pagerL*($this->params['url']['page']-1));
			}
			// End
			
   			foreach($companydata as $eachrow){
			//echo "<pre>";
		//	print_r($eachrow);
			
   			$recid = $eachrow['Company']['id'];
   			$modelname = "Company";
   			$redirectionurl = "sa_companylist";
   			$company_type_id = $eachrow['CompanyType']['company_type_name'];
			$city = $eachrow['Company']['city'];
			$state = AppController::getstatename($eachrow['Company']['state']);
   			$company_name = $eachrow['Company']['company_name'];
			if($company_name) $company_name = AppController::WordLimiter($company_name,25);
   			$email = $eachrow['Company']['email'];
			if($email) $email = AppController::WordLimiter($email,35);
   			$phone = $eachrow['Company']['phone'];
   			$website = $eachrow['Company']['website'];
			if($website) $website = AppController::WordLimiter($website,38);
			
			//state
   		?>

	<?php if($i%2 == 0) { ?>
        <tr class='altrow'>    <td align="center" class='newtblbrd' valign="middle"><span style="color:#4d4d4d;"><?php echo $i++ ?></span></td>
		<td align="center" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		
		<td align="left" valign="middle" class='newtblbrd'>
			
			<?php
				e($html->link(
					$html->tag('span', $company_name),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>		
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			
			<?php
				e($html->link(
					$html->tag('span', $company_type_id),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>		
		</td>
			<td align="left" valign="middle" class='newtblbrd'>
		
		<?php
				e($html->link(
					$html->tag('span', $city),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>	
				
		</td>	
		
			<td align="left" valign="middle" class='newtblbrd'>
		
		<?php
				e($html->link(
					$html->tag('span', $state),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>	
				
		</td>	
		
		
			
	

		<td align="left" valign="middle" class='newtblbrd'>
			<?php
				e($html->link(
					$html->tag('span', $phone?$phone:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>		
		</td>
		<td align="left" valign="middle" class='newtblbrd'>
			
			<?php
				e($html->link(
					$html->tag('span', $website?$website:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>		
		</td>
	
		</tr>

	<?php } else { ?>

		<tr><td align="center" valign="middle"><span style="color:#4d4d4d;"><?php echo $i++ ?></span></td><td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $company_name),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>		
		</td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $company_type_id),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>	
		</td>
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $city),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>	
		</td>
		
			<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $state),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>	
		</td>
		
		
	
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $phone?$phone:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
					array('escape' => false)
					)
				);
				?>	
		</td>
		<td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $website?$website:'N/A'),
					array('controller'=>'contacts','action'=>'sa_addcompany',$recid),
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
        
</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      <span class="botRht_curv"></span>
                    <div class="gryBot">
                    
        <?php if($companydata) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>
                    
                    
                    
	</table>


</div>
</div><!--inner-container ends here-->
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
        
        if(counter!=1)
        {
                alert("please select only one row  to edit");
                return false;
                }else{  
                document.getElementById("linkedit").href=baseUrl+"contacts/sa_addcompany/"+id; 
                
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