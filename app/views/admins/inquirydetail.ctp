<script type="text/javascript">
$(document).ready(function() {
$('#FormtLst').removeClass("butBg");
$('#FormtLst').addClass("butBgSelt");
}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url_admin');
$backUrl=$base_url.'inquirylist/'.$enqtype;
echo $javascript->link('jqdialog');
echo $html->css('jqdialog');
?>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
        <div class="center-Page col-sm-6">
            <h2>Submitted inquries : <?php    echo ucfirst($enqtype); ?></h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php 
                # set help condition
                App::import("Model", "HelpContent");
                $this->HelpContent =  & new HelpContent();
                $condition = "HelpContent.id = '47'";  
                $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
                $this->set("hlpdata",$hlpdata);
                # set help condition   
               
           		 ?>
            
            
            	<?php echo $form->create("admins", array("action" => "inquirydetail",$enqtype => 'file','enctype'=>'multipart/form-data','name' => 'formtype_add', 'id' => "formtype_add"));  
	
				echo $form->hidden("FormSubmit.id", array('id' => 'formtype_id', 'div' => false, 'label' => '', "class" => "inpt-txt-fld form-control","maxlength" => "200"));
				
				echo $form->hidden("enqtype", array('id' => 'enqtype','value'=>$enqtype));
				echo $form->hidden("is_editable", array('id' => 'is_editable','value'=>'0'));	
				if($nochange){
				echo $form->hidden("nochange", array('id' => 'nochange','value'=>'1'));	
				}		
				?>
				<?php if($enqtype!='history'){?>
				<button id="btndailog" type="button" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
				   <button id="btndailog" type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
				
				<?php } ?>
				<?php  echo $this->renderElement('new_slider'); ?>

            </div>
        </div>
    </div>
</div>
<!--titlCont1 ends here-->


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		 <?php
				if($enqtype ==trim('new')){
					$subtabsel = "newinquiry";
				}else if($enqtype ==trim('open')){
					$subtabsel = "openinquiry";
				}else{
					$subtabsel = "historylist";
				}
				$this->loginarea="admins";    $this->subtabsel=$subtabsel;
				echo $this->renderElement('forms_submenus');  
		?>
    </div>
</div> 

<!--inner-container starts here-->
<div class="midCont clearfix">
   <div class="inquiry-detail">    
        <div class="clearfix">
            <div class="top-bar" style="border-left:0px;">  </div>
            <div class=" clearfix">	
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>       
                <div class="clear"></div>
            </div>
                <div class="clearfix" style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar" id="addcnttab"></div>
           
                    
                 <div class="frmbox">
                 	<?php if($session->check('Message.flash')){ $session->flash(); } ?>
                 	<table  cellpadding="5" cellspacing="8" align="center" width="90%" >
                                <tbody>
                                    <tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Name of Form</label>   </td>
                                        <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("formtype_name", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200", "value" => $this->data['FormType']['formtype_name']));?></span> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">Current Status</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea-top">
                                            <span class="txtArea-bot">
<?php 

echo $form->select('FormSubmit.statustype_id',$formstatustypedropdown, $selectedstatustype,array('id'=>'current_status','empty'=>false,'class'=>'multi-list form-control'),"--Status Types--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
									
									<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">First name</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_firstname.", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
                                    
									<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Last name</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_lastname.", array('id' => 'lastname', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
										<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Title</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_title.", array('id' => 'title', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
									
										<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Company</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_company.", array('id' => 'company', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
											<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Phone</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_phone.", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
								<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Email</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_email.", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>

<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Address1</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_address1.", array('id' => 'Address1', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>

<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">Address2</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_address2.", array('id' => 'Address2', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>

<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">City</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_city.", array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">ST/Province</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea-top">
                                            <span class="txtArea-bot">
                                            <?php echo $form->select('FormSubmit.fld_stprovince',$statedropdown, $selectedstate,array('id'=>'state','empty'=>false ,'class'=>'multi-list form-control'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
									
<tr>
                                        <td valign="top" align="right" style="padding-top: 2px;"> <label class="boldlabel">ZIP/Postal Code</label>   </td>
                                  <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("FormSubmit.fld_zippostalcode.", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span> </td>
								  
                                    </tr>
									
									
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">Country</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea-top">
                                            <span class="txtArea-bot">
      <?php if(!isset($this->data['FormSubmit']['fld_country']))
	  		{$countrydropdown = '--Select--';} echo $form->select('FormSubmit.fld_country',$countrydropdown,$selectedcountry,array('id'=>'country','empty'=>false , 'class'=>'multi-list form-control'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
                                    
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">How Did You Find Us</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea-top">
                                            <span class="txtArea-bot">
                                            <?php $formstatustypedropdown = array(); echo $form->select('FormSubmit.fld_country',$formstatustypedropdown, $selectedstatustype,array('id'=>'hdufu','empty'=>false,'class'=>'multi-list form-control'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
									
									<tr>
                                        <td  valign="top" align="right" style="padding-top: 4px;"> <label class="boldlabel">How Can We Help You</label>   </td>
                                        <td  valign="top" align="left"> 
                                        <span class="txtArea-top">
                                            <span class="txtArea-bot">
                                            <?php $formstatustypedropdown = array(); echo $form->select('FormSubmit.fld_country',$formstatustypedropdown, $selectedstatustype,array('id'=>'hcwhy','empty'=>false,'class'=>'multi-list form-control'),"--Select--"); ?>          
                                                </span>     </span>  
                                        </td>
                                    </tr>
                                    
<tr>	 
		<td valign='top' align="right"><label class="boldlabel">Message<span style="color:red">*</span></label></td>
		<td>
			<div class="large">
			<span class="txtArea-top">
				<span class="newtxtArea-bot">
					<?php echo $form->textarea("FormSubmit.fld_message", array('id' => 'message', 'div' => false, 'label' => '',
							'cols' => '35', 'rows' => '4',"class" => "multi-list form-control", 'style'=>'width:100%'));?>
				</span>
			</span>
			</div>
		</td>
	</tr>

                 
                                </table>
                 </div>
                 <div class="frmbox2">
                 	<table border="1"  cellpadding="5" cellspacing="8" align="center" width="90%" >
    <tbody>
         <tr>
            <td valign="top" align="right"  style="padding-top: 2px;"> <label class="boldlabel">Date Submitted</label>   </td>
            <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("submit_created_show", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control",'DISABLED'=>'DISABLED',"maxlength" => "200","value" => date("m-d-Y H:i:s",strtotime($this->data['FormSubmit']['created'])) ));?></span> </td>
        </tr>
        
         <tr>
            <td valign="top" align="right"  style="padding-top: 2px;"> <label class="boldlabel">Date of Status</label>   </td>
            <td valign="top" align="left"> <span class="intp-Span"><?php echo $form->input("status_modified_show", array('id' => 'formtype_name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control",'DISABLED'=>'DISABLED',"maxlength" => "200","value" => date("m-d-Y H:i:s",strtotime($this->data['FormSubmit']['modified']))));?></span> </td>
        </tr>                                    
        <tr>
<td  align="right" valign="top"  style="padding-top: 4px;"> <label class="boldlabel">Company Type</label></td>
<td >
          <span class="txtArea-top">
    <span class="txtArea-bot">
          <?php echo $form->select('company_type',$companytypedropdown, $selectedcompanytype,array('id'=>'company_type','empty'=>false,'class'=>'multi-list form-control'), "-- Select --");?>
    </span>     </span>  &nbsp;
</td>

</tr>

<tr>
<td  align="right" valign="top"  style="padding-top: 4px;"> <label class="boldlabel">Contact Type</label></td>
<td  >
          <span class="txtArea-top">
    <span class="txtArea-bot">
          <?php echo $form->select('contact_type',$contacttypedropdown, $selectedcontacttype,array('id'=>'contact_type','empty'=>false,'class'=>'multi-list form-control'), "-- Select --");?>
    </span>     </span> &nbsp;
</td>

</tr>
<tr>	 
<td valign='top' align="right"><label class="boldlabel">Inquiry Notes<span style="color:red">*</span></label></td>
<td>
<div class="large">
<span class="txtArea-top-enq">
<span class="newtxtArea-bot">
<?php echo $form->textarea("FormSubmit.fld_notes", array('id' => 'note', 'div' => false, 'label' => '',
'cols' => '75', 'rows' => '7',"class" => "multi-list form-control", "style" =>"width:100%;"));?>
</span>
</span>
<div  style="margin-top:7px;">
<span class="btn-Lft"><input type="button" value="Enter Date & time" tabindex=14 id="enterdate" class="btn-Rht btn btn-primary btn-sm" name="enterdate" onclick="enterCurrentDate();"  /></span>
</div>
</div>
</td>
</tr>
        
    </tbody>
    </table>
                 </div>
                    
               <!-- ADD Sub Admin  FORM EOF -->

        </div>
        

<!--inner-container ends here-->

<?php echo $form->end();?>

<div class="top-bar" style="margin-bottom: 10px; text-align: left; padding-top: 5px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>

  
<div class="clear"></div>
</div></div>


<div class="clear"></div>
<script type="text/javascript">
  function getformstateoptions(countryid,modelname) {   
       
        countryid=$("#countrykey").val();
        modelname="Sponsor";
       var statekey=$("#statekey").val();
       jQuery.ajax({
             type: "GET",
             url: '/companies/selectstateoptions/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                   
                     jQuery('#state').html(rText);
                     $("#state option[value='"+statekey+"']").attr('selected', 'selected');
             }
     });
      
}
   
   function enterCurrentDate(){
   		var now = new Date();
		    dateStr = now.toDateString()+' '+now.getHours()+' : '+now.getMinutes();
		$("#note").val($("#note").val()+dateStr+'\n');

   }
 //getformstateoptions('254',"Sponsor");  
 var status = $('#is_editable').val();
 $('#formtype_name,#firstname,#lastname,#title,#company,#phone,#email,#Address1,#Address2,#city,#state,#zipcode,#current_status,#state,#country,#hdufu,#hcwhy,#message,#company_type,#contact_type,#note').change(function() {
  $('#is_editable').val('1');
 });

$("#btndailog").click(function() {
var enqtype = $('#enqtype').val(); 
var isedit = $('#is_editable').val(); 
 if(isedit == '0'){
 	//var status = confirm("Did you forget to change the Current Status?");
	$.jqDialog.confirm("Did you forget to change the Current Status?",
			function() { 
				return false;
			 },		// callback function for 'YES' button
			function() { 
				location.href = baseUrl+"admins/inquirylist/"+enqtype;
			 }, 1		// callback function for 'NO' button
		);	
}
else{
		//alert('Do you really want to change data');
			$.jqDialog.confirm("Do you really want to change data?",
			function() { 
				//location.href = baseUrl+"prospects/inquirydetail/";
				$('#formtype_add').submit();
				//return false;
			 },		// callback function for 'YES' button
			function() { 
				return false;
			 },2		// callback function for 'NO' button
		);	
 }
});
 </script>