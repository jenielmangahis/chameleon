<script type="text/javascript">
$(document).ready(function() {
$('#prosMnu').removeClass("butBg");
$('#prosMnu').addClass("butBgSelt");
}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'prospects/prospectnonprofit';
?>

<script type="text/javascript">
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
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">	
            	<?php  
					if(!empty($current_company_name)){
						echo '<h2>'.$current_company_name.'</h2>';     
					}else{
						echo $this->renderElement('project_name');  
					}	
				?>  
            		
                <h2>
                	<?php 
						if($this->data['Company']['id']){
							$act = 'edit';
							echo "Edit Non Profit Prospects"; 
						}else{
							$act = 'add';
							echo "Add Non Profit Prospects";
						}	
					?>
                </h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("prospects", array("action" => "addprospectnonprofit",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addprospectnonprofit', 'id' => "addprospectnonprofit","onsubmit"=>"return validatecompany('$act');"));
					 echo $form->hidden("Company.id", array('id' => 'companyid'));
					 echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
					 echo $form->hidden("projectid", array('id' => 'projectid','value'=>"$project_id"));
					 if(!empty($addtype)){
						echo $form->hidden("addtype", array('id' => 'addtype','value'=>"$addtype"));
					 }
					 if($hq_id > 0){
						echo $form->hidden("Company.hq_id", array('id' => 'hq_id','value'=>"$hq_id"));
					 }
					?>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><?php e($html->image('cancle.png')); ?></button>
					 <?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
        </div>
</div>


<div class="clearfix nav-submenu-container">
    <div class="midCont submenu-Cont">
    	<?php $this->loginarea="prospects";$this->subtabsel="projectmerchant";
       echo $this->renderElement('prospect_inner_submenu');  ?>
    </div>
</div>

	   
<div id="addcmp"  class="midCont">	


<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<div class="frmbox mgrt60">
<table cellspacing="5" cellpadding="0" width="90%">
		
  <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"><?php $session->flash(); 
      				//echo $form->error('Company.company_name', array('class' => 'msgTXt'));
      				//echo $form->error('Company.company_type_id', array('class' => 'msgTXt'));
      				
      	?></td>
    </tr>
    <?php }?>
  
  
  <tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Name <span style="color: red;">*</span></label></td>
			<td width="60%">
			<span class="intp-Span"><?php echo $form->input("Company.company_name", array('id' => 'company_name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span></td>
		</tr>


	<tr>
		<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Company Type <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="newtxtArea-bot">
					<span class="NewtxtArea-bot">
				<?php echo $form->select("Company.company_type_id",$nonprofitcompanytypedropdown,$selectedcompanytype,array('id' => 'company_type_id','class'=>'multi-list form-control'),"---Select---"); ?>
					
				</span>				</span></td>
		    </tr>	

		<tr>
		<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Non-Profit Type </label></td>
                            <td width="85%">
				<span class="newtxtArea-bot">
					<span class="NewtxtArea-bot">
					<?php echo $form->select("Company.non_profit_type_id",$nonprofittype,$selectednonprofittype,array('id' => 'non_profit_type_id','class'=>'multi-list form-control'),"---Select---"); ?>
					
				</span>				</span></td>
		    </tr>	
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Location Type</label></td>
			<td width="85%">
			<span class="radiolocation" >
			<?php 
			$options=array('0'=>'HQ','1'=>'Branch');

			if($addtype!=''){
					$location_type_id ='1';
					$attributes=array('legend'=>false, 'value'=>isset($location_type_id)?$location_type_id:0,'DISABLED' => 'DISABLED');
			}else{
			$attributes=array('legend'=>false, 'value'=>isset($location_type_id)?$location_type_id:0);
			}
			echo $form->radio('Company.location_type_id',$options,$attributes);
			?>
			
			</span></td>
		</tr>
			<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">EIN #</label></td>
			<td width="60%">
			<span class="intp-Span"><?php echo $form->input("Company.ein", array('id' => 'ein', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>
		</tr>
    
<tr>
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Address 1 <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>
		</tr>
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Address 2 <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>
		</tr>    
   
    

<tr>
		     	<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Country <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<span class="newtxtArea-bot">
					<span class="NewtxtArea-bot">
				<?php echo $form->select("Company.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multi-list form-control','onchange'=>'return getstateoptions(this.value,"Company")'),array('254'=>'United States')); ?>				</span>				</span></td>
		    </tr>	

   
<tr>
		     	<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">State <span style="color: red;">*</span></label></td>
                            <td width="85%">
                                   <span class="newtxtArea-bot">
                                <span class="txtArea_bot">
                                  <span id="statediv"> 
                <?php echo $form->select("Company.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multi-list form-control'),"---Select---"); ?></span>				</span>				</span></td>
		    </tr>    
    

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">City <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.city", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span></td>
		</tr>     

<tr>
		<td width="32%" align="right" class="lbltxtarea"><label class="boldlabel">Zip/Postal Code <span style="color: red;">*</span></label></td>
			<td width="68%">
			<span class="intp-Span"><?php echo $form->input("Company.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "10"));?></span></td>
		</tr>

  <tr>
  <tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Contacts</label></td>
			<td width="85%">
			<div>
				<span class="newtxtArea-bot">
					<span class="NewtxtArea-bot">
						<?php echo $form->select("Contact.contact_id",$contactdatadropdown,$companytocontact,array('id' => 'contact_id','class'=>'multi-list form-control','multiple'=>'multiple')); ?>					</span>				</span>				</div>
				<span style="margin-top:7px;" class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
			</td>
		</tr>	

 <tr><td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
                             <?php  echo $this->renderElement('bottom_message');  ?>
                            </td></tr>
 </table>
</div>

<div class="frmbox">
<table cellspacing="5" cellpadding="0" width="90%">


<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Notify Email <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>
		</tr>   

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Main Phone <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.phone", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "15"));?></span></td>
		</tr>       

    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Fax <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.fax", array('id' => 'fax', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "15"));?></span></td>
		</tr>

<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Website <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.website", array('id' => 'website', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
		</tr>    
   
    
<tr>
			<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Facebook Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.fbpage", array('id' => 'fbpage', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
		</tr>      
    
<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Twitter Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.twitterpage", array('id' => 'twitterp', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
		</tr>   
		
	<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Google+ Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.gpluspage", array('id' => 'gplus', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
		</tr>  
		
		<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Linkdin Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.linkdinpage", array('id' => 'linkdin', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
		</tr>  
		
		
		<tr>
<td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Pintrest Page <span style="color: red;"></span></label></td>
			<td width="85%">
			<span class="intp-Span"><?php echo $form->input("Company.pintrestpage", array('id' => 'pintrest', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
		</tr>   
		<!------------------------->
		<tr>			   	
				<td valign="top" align="right">
					<label class="boldlabel">Releated Projects<p class="subtext"> ( Existing projects <br />prospects is aligned with)</p></label>
				</td>
				<td>
					  <div class="large" >
					  	<span class="newtxtArea-bot">
					  		<span class="NewtxtArea-bot" style="font-size:10px; padding-bottom:5px; height:150px; overflow:scroll">
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
								foreach($projectdata as $projectdata):
								
echo '<tr><td><input type="checkbox" id="releatedproject'.$projectdata['Project']['id'].'" name="data[Project][ids]['.$projectdata['Project']['id'].']" value="'.$projectdata['Project']['id'].'" '; echo (!empty($relatedproductid) && in_array($projectdata['Project']['id'],$relatedproductid))?'checked="checked"' :''; echo	' />
</td> <td>'.$projectdata['Project']['project_name'].'</td><td>'.$projectdata['Sponsor']['city'].'</td><td>'. AppController::getstatename($projectdata['Sponsor']['state']).'</td></tr>';
									  endforeach; ?>
								</table>
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
			
				<span style="margin-top:7px;" class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewEmailTempforRSVP();"  /></span>
				</td></tr>
			  
			   <!----------------------------->
			   
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
