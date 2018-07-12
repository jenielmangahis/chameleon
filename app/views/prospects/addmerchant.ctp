<script type="text/javascript">
$(document).ready(function() {
$('#prosMnu').removeClass("butBg");
$('#prosMnu').addClass("butBgSelt");
}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'prospects/projectmerchant';
?>

<script type="text/javascript" >
	var viewotherid =0;
	$('.otherlocationclass').live('click', function(){
			viewotherid = $(this).attr('id');
			$(this).parent().find('tr.otherlocationclass').css({'background':'#EBEBEB', 'color':'#000'});
			$(this).css({'background':'#3399FF', 'color':'#FFF'});
	});
	
var h=screen.height;
var w=screen.width;
 /**
         * Funtion addnew email template in pop-up
         */
		 var resWindow1 = null;var cid,pid;
function viewEmailTempforRSVP() {   
		 			 cid = $('#contact_id').val();	
					 pid = $('#projectid').val();
					$('#addmerchant').focus();
             resWindow1=  window.open (baseUrl+'players/addcontacts/'+cid+'/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
             resWindow1.focus();
           }
		   
		   //$(resWindow1).focus(function() {
		   $(resWindow1).live('unload', function() {

			//if(resWindow1!=null && resWindow1.closed){
				resWindow1=null; 
					$.ajax({
						type: "GET",
						url: baseUrl+'prospects/getlatestcontactbypros/'+pid,
						complete: function(response){
						$('#contact_id').html(response.responseText); 				
						}
				});
			//}
			
		 });
function addnewcontact(){
	 resWindow1=  window.open (baseUrl+'players/addcontacts/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
}
</script>

   <!-- Body Panel starts -->
<div class="container">
<div class="titlCont" style="height:90px;">
<div class="centerPage">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
<?php echo $form->create("prospects", array("action" => "addmerchant",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addmerchant', 'id' => "addmerchant","onsubmit"=>"return validatecompany('$act');"));
	 echo $form->hidden("Company.id", array('id' => 'companyid'));
	 echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
	 echo $form->hidden("projectid", array('id' => 'projectid','value'=>"$project_id"));
	 echo $form->hidden("addtype", array('id' => 'addtype','value'=>"$addtype"));
 
	 if($hq_id > 0){
	 	echo $form->hidden("Company.hq_id", array('id' => 'hq_id','value'=>"$hq_id"));
	 }
	?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png')) ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"> <?php e($html->image('apply.png')) ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"> <?php e($html->image('cancle.png')) ?></button>
	 <?php  echo $this->renderElement('new_slider');  ?>
</div>

<?php  
if(!empty($current_company_name)){
	//echo '<span class="titlTxt1">'.$current_company_name.' :&nbsp;</span>';     
}else{	
	if($usertype=="admin"){
		//echo $this->renderElement('project_name');  
	}else{
		
	}
}
	?>     
<span class="titlTxt">
		<?php 
			if($addtype!=''){
				$type = ucfirst($addtype);
			}else{
				$type ='Merchant';
			}

			if($this->data['Company']['id'] && !empty($company_name) && !empty($edit)){	
			//echo " Edit ".$type. " Detail"; 
			echo " Edit Merchant Detail";
			}
			else if($this->data['Company']['id'] && !empty($company_name)){	
			//echo " Add ".$type. " Detail"; 
			echo " Add Merchant Detail";
			}
			else if($this->data['Company']['id']){
				$act = 'edit';
				//echo " Edit ".$type. " Detail"; 
				echo " Edit Merchant Detail";
			}
			
			else{
				$act = 'add';
				echo " Add New Branch ";
			}
		
		?>
	</span>
	

	<div class="topTabs" style="height:25px;">
		<?php /*?><ul class="dropdown">   
		<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
		</ul><?php */?>
	</div>
	<div class="clear"></div>    
	 <div>
	 <?php    $this->loginarea="prospects";    $this->subtabsel="projectmerchant";

			 if($this->params['pass'][0] === '0'){
			 echo $this->renderElement('prospect_submenus');
			 
			 }
			 elseif ($_GET['url'] === 'prospects/projectmerchant/1'){
			  echo $this->renderElement('prospect_inner_submenu');
			 }
			 
			 else{
			  //echo $this->renderElement('relationships_submenus'); 
			         echo $this->renderElement('memberlistsecondlevel_submenus'); 
				}
			?> 
 		</div>
</div>

	   
</div>


<div id="addcmp"  class="midCont">	


<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<div class="frmbox">
<table cellspacing="10" cellpadding="0">  
  <tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Name <span style="color: red;">*</span></label></td>
			<td width="60%">
			<span class="intpSpan"><?php echo $form->input("Company.company_name", array('id' => 'company_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>


	<tr>
		<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Type <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
					<?php echo $form->select("Company.company_type_id",$merchantcompanytypedropdown,$selectedcompanytype,array('id' => 'company_type_id','class'=>'multilist'),"---Select---"); ?>
					<!--<input type="hidden" name="data[Company][company_type_id]" id="company_type_id" value="<?php echo $selectedcompanytype; ?> " />-->
				</span>				</span></td>
		 </tr>	
			
		<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Categories<span style="color: red;">*</span></label></td>
			<td width="85%">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
						<?php echo $form->select("Category.category_id",$categorydropdown,$selectedcategory,array('id' => 'category_id','class'=>'multilist','multiple'=>'multiple'),"---Select---"); ?>					</span>				</span>			</td>
		</tr>	
	
	
	
	
	<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">EIN # </label></td>
			<td width="60%">
			<span class="intpSpan"><?php echo $form->input("Company.ein", array('id' => 'ein', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Location Type</label></td>
			<td width="85%">
			<span class="radiolocation" >
			<?php 
			
			$options=array('0'=>'HQ','1'=>'Branch');
			//echo $addtype;
			if($addtypecat=='add'){
					$location_type_id ='1';
					$attributes=array('legend'=>false, 'value'=>isset($location_type_id)?$location_type_id:0,'DISABLED' => 'DISABLED');
			}else {
				$attributes=array('legend'=>false, 'value'=>isset($location_type_id)?$location_type_id:0);
				}
			
			echo $form->radio('Company.location_type_id',$options,$attributes);
			?>
			<input type="hidden" name="data[Company][hq_id]" id="hq_id" value="<?php echo (isset($hq_id) && $hq_id)? $hq_id :'0'; ?>" />
			</span></td>
		</tr>
    
<tr>
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Address 1 <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Address 2 <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>    
   
    

<tr>
		     	<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Country <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
				<?php echo $form->select("Company.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return getstateoptions(this.value,"Company")'),array('254'=>'United States')); ?>				</span>				</span></td>
		    </tr>	

   
<tr>
		     	<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">State <span style="color: red;">*</span></label></td>
                            <td width="85%">
                                   <span class="txtArea_top">
                                <span class="txtArea_bot">
                                  <span id="statediv"> 
                <?php echo $form->select("Company.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); ?></span>				</span>				</span></td>
		    </tr>    
    

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">City <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.city", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
		</tr>     

<tr>
		<td width="32%" align="right" class="lbltxtarea"><label class="boldlabel">Zip/Postal Code <span style="color: red;">*</span></label></td>
			<td width="68%">
			<span class="intpSpan"><?php echo $form->input("Company.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
		</tr>

  <tr>
  <tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Contacts</label></td>
			<td width="85%">
			<div>
				<span class="txtArea_top">
					<span class="newtxtArea_bot">
						<?php echo $form->select("Contact.id",$contactdatadropdown,$companytocontact,array('id' => 'contact_id','class'=>'multilist','multiple'=>'multiple')); ?>					</span>				</span>				</div>
				<div  style="margin-top:7px;"><span class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
				<span  class="btnLft"><input type="button" value="Add" name="Add" tabindex=15 class="btnRht" ONCLICK="addnewcontact()"/>
				</span>	</div>		</td>
		</tr>	
  


 <tr><td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
                             <?php  echo $this->renderElement('bottom_message');  ?>
                            </td></tr>
 </table>
</div>

<div class="frmbox2">
<table cellspacing="10" cellpadding="0">


<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Notify Email <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>   

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Main Phone <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.phone", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>       

    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Fax <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "15"));?></span></td>
		</tr>

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Website <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.website", array('id' => 'website', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>    
   
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Facebook Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.fbpage", array('id' => 'fbpage', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>      
    
<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Twitter Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.twitterpage", array('id' => 'twitterp', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>   
		
	<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Google+ Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.gpluspage", array('id' => 'gplus', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>  
		
		<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Linkedin Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.linkdinpage", array('id' => 'linkdin', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>  
		
		
		<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Pinterest Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("Company.pintrestpage", array('id' => 'pintrest', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		</tr>   
		<!------------------------->
		<tr>			   	
				<td valign="top" align="right">
					<label class="boldlabel">Targeted Projects<p class="subtext"> ( Existing projects <br />for target prospects)</p></label>
				</td>
				<td>
					  <div class="large" >
					  	<span class="txtArea_top">
					  		<span class="newtxtArea_bot">
					  			<div class="scrolldown">
								<table cellpadding="5" cellspacing="5" width="100%" >
									<tr align="left">
										<th width="10%">
											<input type="checkbox" id="targetprojectcheckall" />
										</th>
										<th width="40%">
											Name
										</th>
										<th width="25%">
											City
										</th>
									    <th width="25%">
											State
										</th>
									 </tr>
								<?php 									
											foreach($targetProject as $projectdata):																
					   				  		echo '<tr><td><input type="checkbox" id="targetprojectcheck'.$projectdata['Project']['id'].'" name="data[Project][ids][]" value="'.$projectdata['Project']['id'].'" ';
											
echo (!empty($checkedrelproject) && in_array($projectdata['Project']['id'],$checkedrelproject))?'checked="checked"' :'';											
										
										 echo	' /></td> <td>'.$projectdata['Project']['project_name'].'</td><td>'.$projectdata['Sponsor']['city'].'</td><td>'. AppController::getstatename($projectdata['Sponsor']['state']).'</td></tr>';
									  endforeach; ?>
								</table>
								</div>
							</span>
						</span>
						</div> 
				</td>
				
			   </tr>
			   <tr>
			   <td>
			   </td>
			   <td width="85%">
			<div>
			
				<span  class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
						</td></tr>
			  
			   <!----------------------------->
		
	
		
		
		   <tr>			   	
				<td valign="top" align="right">
					<label class="boldlabel">Related Non-Profits<p class="subtext">(Existing Non-Profits Prospects is aligned with)</p></label>
				</td>
				<td>
					  <div class="large" >
					  	<span class="txtArea_top">
					  		<span class="newtxtArea_bot">
							
								<div class="scrolldown">
					  			<table cellpadding="5" cellspacing="5" width="100%" >
									<tr align="left">
										<th width="10%">
											<input type="checkbox" id="nonprofitcheckall" />
										</th>
										<th width="40%">
											Name
										</th>
										<th width="25%">
											City
										</th>
									    <th width="25%">
											State
										</th>
									 </tr>
								<?php 
									//print_r($releatednonprofit);
								foreach($releatednonprofit as $nonprofit):
					   				  		echo '<tr><td><input type="checkbox" id="nonprofitcheck'.$nonprofit['CompanyType']['id'].'" name="data[RelatedNonProfit][ids][]" value="'.$nonprofit['Company']['id'].'" ';
echo (!empty($relatednonprofitid) && in_array($nonprofit['Company']['id'],$relatednonprofitid))?'checked="checked"' :'';					 echo	' /></td> <td>'.$nonprofit['Company']['company_name'].'</td><td>'.$nonprofit['Company']['city'].'</td><td>'. AppController::getstatename($nonprofit['Company']['state']).'</td></tr>';
									  endforeach; ?>
								</table>
								</div>
							</span>
						</span>
						</div> 
				</td>
			   </tr>
			   <tr>
			   <td>
			   </td>
			   <td width="85%">
			<div>
			
				<span  class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
						</td></tr>
			    <tr>			   	
				<td valign="top" align="right">
					<label class="boldlabel">Prospects Non-Profits <p class="subtext">(Existing Non-Profits Merchant is aligned with)</p></label>
				</td>
				<td>
					  <div class="large">
					  	<span class="txtArea_top">
					  		<span class="newtxtArea_bot" >
							<div class="scrolldown">
					  			<table cellpadding="5" cellspacing="5" width="100%" >
									<tr align="left">
										<th width="10%">
											<input type="checkbox" id="prospectnonprofitcheckall" />
										</th>
										<th width="40%">
											Name
										</th>
										<th width="25%">
											City
										</th>
									    <th width="25%">
											State
										</th>
									 </tr>
								<?php 
									
								foreach($prospectnonprofit as $prospectnonprofit):
					   				  		echo '<tr><td><input type="checkbox" id="prospectnonprofitcheck'.$prospectnonprofit['Company']['id'].'" name="data[ProspectNonProfit][ids][]" value="'.$prospectnonprofit['Company']['id'].'" ';
echo (!empty($prospectnonprofitid) && in_array($prospectnonprofit['Company']['id'],$prospectnonprofitid))?'checked="checked"' :'';											
										
										
										 echo	' /></td> <td>'.$prospectnonprofit['Company']['company_name'].'</td><td>'.$prospectnonprofit['Company']['city'].'</td><td>'. AppController::getstatename($prospectnonprofit['Company']['state']).'</td></tr>';
									  endforeach; ?>
								</table>
								</div>
							</span>
						</span>
						</div> 
				</td>
			   </tr>
			   
			   
			   
			   <tr>
					<td>&nbsp;</td>
					<td>
						<span class="btnLft">
							 <input type="button" class="btnRht" value="Add" name="Addpnp" id="Addpnp" />  
                        </span>
					    <span style="display:inline-block;width:8px"></span>		
					</td>
				</tr>
			</table>
	<!-- ADD Sub Admin  FORM EOF -->

<!--inner-container ends here-->

<?php echo $form->end();?>

</div>
</div>
  

<script language='javascript'>
<?php if(!($this->data['Company']['id'])) { ?>
getstateoptions('254',"Company"); 
<?php } ?>
</script>

<div class="clear"></div>
  </div>    
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
        $("#view_contact").click(function(){   
        var current_domain=$("#current_domain").val();
            var contactid=$("#contacts").val();
            if(contactid==null || contactid==""){
                return false;
            }else{
                var url=baseUrl+"players/addcontacts/"+contactid;
                window.location=url;
        	} 
		});
		
	   $("#view_others").click(function(){   
        var current_domain=$("#current_domain").val();
            if(viewotherid==0){
                return false;
            }else{
                var url=baseUrl+"players/addmerchant/"+viewotherid;
                window.location=url;
        	} 
		});
		
		$("#view_nonprofit").click(function(){
		
		   $('input[id^="nonprofitcheck"]').each( function(){
		  			 if($(this).is(':checked')){
						 var url=baseUrl+"players/addnonprofit/"+$(this).val();
		                //window.location=url;	
					    window.open(url);
						return false;
					}
			});
		});
		
		 $("#view_project").click(function(){ 
		 	$('input[id^="projectcheck"]').each( function(){
					if($(this).is(':checked')){
						var url=baseUrl+"admins/editproject/"+$(this).val();
		                //window.location=url;	
					    window.open(url);
						return false;
					}
			});
		});

		$('input[id="projectcheckall"]').live('change', function(){
			if($(this).is(':checked')){
				$('input[id^="projectcheck"]').each( function(){
					$(this).attr('checked',true);
				});
			}else{
				$('input[id^="projectcheck"]').each( function(){
					$(this).attr('checked',false);
				});
			}
		})
		
		$('input[id="nonprofitcheckall"]').live('change', function(){
			if($(this).is(':checked')){
				$('input[id^="nonprofitcheck"]').each( function(){
					$(this).attr('checked',true);
				});
			}else{
				$('input[id^="nonprofitcheck"]').each( function(){
					$(this).attr('checked',false);
				});
			}
		})
		
		$('input[id="targetprojectcheckall"]').live('change', function(){
			if($(this).is(':checked')){
				$('input[id^="targetprojectcheck"]').each( function(){
					$(this).attr('checked',true);
				});
			}else{
				$('input[id^="targetprojectcheck"]').each( function(){
					$(this).attr('checked',false);
				});
			}
		})
		
		$('input[id="prospectnonprofitcheckall"]').live('change', function(){
			if($(this).is(':checked')){
				$('input[id^="prospectnonprofitcheck"]').each( function(){
					$(this).attr('checked',true);
				});
			}else{
				$('input[id^="prospectnonprofitcheck"]').each( function(){
					$(this).attr('checked',false);
				});
			}
		})
		

</script>