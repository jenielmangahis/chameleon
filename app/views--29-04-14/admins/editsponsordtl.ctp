<!--container starts here-->
<div class="container">

<!--rightpanel starts here--><div class="leftpanel">

<?php echo $this->renderElement('new_admin_leftpanel'); ?>

</div><!--rightpanel ends here-->

<!--inner-container starts here--><div class="rightpanel">

<div id="center-column">
	<div class="top-bar" style="border-left:0px;">
		<h1> Sponsor Detail </h1>
		<b>Any item with a  "<span style="color:red">*</span>"  requires an entry.</b>
		</div><br />
		
		<div class="left">
		
		<!-- ADD Sub Admin FORM BOF -->

                     <!-- ADD FIELD BOF -->
         <?php if($userid) { 
         		$act = "edit";
         	}else{
         		$act = "add";
         	}
       	 echo $form->create("Admins", array("action" => "editsponsordtl",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editsponsordtl', 'id' => "editsponsordtl",'onsubmit'=>"return validatesponsordtl('$act');"))?>
<div class='left' style="width:816px;">		
		<table cellspacing="10" cellpadding="0" align="center" width="455px" class='left'>
  <tbody>
   <tr>
      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } 
      				
      				echo $form->error('User.username', array('class' => 'errormsg'));
      				echo $form->error('User.password', array('class' => 'errormsg'));
      				echo $form->error('Sponsor.sponsor_name', array('class' => 'errormsg'));
      				echo $form->error('Sponsor.email', array('class' => 'errormsg'));
      				echo $form->hidden("Sponsor.id", array('id' => 'sponsorid'));
      				echo $form->hidden("User.id", array('id' => 'userid','value'=>"$userid"));
      				echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
      	?></td>
    </tr>
    <tr>
      <?php if($userid) { ?>
      <td width=""><label class="boldlabel">User name:</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150","value"=>"$username","readonly"=>"readonly"));?></td>
      <?php }else{ ?>
      <td width=""><label class="boldlabel">User name: </label></td>
      <td width=""><label for="project_name"></label>
      <?php echo $form->input("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      <?php }?>
      
    </tr>
    
    <tr>
    <?php if($userid) { ?>
      <td width=""><label class="boldlabel">Password:</label></td>
       <?php }else{ ?>
      <td width=""><label class="boldlabel">Password: <span style="color:red">*</span></label></td>
       <?php }?>
      <td width=""><label for="project_name"></label>
        <?php echo $form->password("User.password", array('id' => 'password', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
     
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Sponsor Name: <span style="color:red">*</span></label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.sponsor_name", array('id' => 'sponsor_name', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
      
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Sponsor Email: <span style="color:red">*</span></label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150"));?></td>
    
    </tr>
    
   	<tr>
      <td width=""><label class="boldlabel">Address 1: <span style="color:red">*</span></label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "200"));?></td>
       
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Address 2:</label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "200"));?></td>
     
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">Country : <span style="color:red">*</span></label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->select("Sponsor.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'width:186px','onchange'=>'return getstates(this.value,"Sponsor")'),"---Select---"); ?></td>
      
    </tr>
    
    
     <tr>
      <td width=""><label class="boldlabel">State : <span style="color:red">*</span></label></td>
      <td width=""><label for="project_name"></label>
        <span id="statediv"><?php echo $form->select("Sponsor.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'width:186px'),"---Select---"); ?></span></td>
      
    </tr>
    
    <tr>
      <td width=""><label class="boldlabel">City : <span style="color:red">*</span></label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "150")); ?></td>
    
    </tr>
    
     <tr>
      <td width=""><label class="boldlabel">Zip/Postal Code : <span style="color:red">*</span></label></td>
      <td width=""><label for="project_name"></label>
        <?php echo $form->input("Sponsor.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "10"));?></td>
     
    </tr>
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr>
		        	<td  valign='top'><label class="boldlabel">Sponsor Logo:</label></td>
				      <td><?php  echo $form->file('Sponsor.sponlogo',array('id'=> 'logo',"class" => "contactInput"));?><br>
				      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250.</span>
				        <br /><br />&nbsp; <?php if($this->data['Sponsor']['logo'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Sponsor']['logo']; ?>"> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/nologo.jpg'><?php } ?></td>
		        	
		        </tr>
   
   
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr><td colspan='2'>
  
    			 <button type="submit" id="Submit" class="button">  Save  </button>&nbsp;
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/index')"> Cancel </button>&nbsp;
    		      
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/editprojectdtl')"> Project Detail </button>
    		
	</td></tr>
  </tbody>
</table>

<table class='left' width="361px">
				<tr>
				<td  valign='top'><label class="boldlabel">Company:</label></td>
		       <td>
		       <div style="width:186px; overflow:auto">
		       	<?php echo $form->select('Sponsor.companies',$companies, null,array('multiple'=>'multiple','id'=>'companies','size'=>'7','empty'=>false,'style'=>'width:200px;'));?>
			</div>
			<?php if($this->data['Sponsor']['id']==0) { ?>
		       	<br />
			<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added companies</span>
			<br />
		        <input type="button" value="View" name="view" ONCLICK="viewcompanys()" />
		        &nbsp;&nbsp;
		        <input type="button" value="Add" name="Add" ONCLICK="copycompanys()"  />
			<br/>
			<?php echo $form->select('companies1',$companies1, null,array('multiple'=>'multiple','id'=>'companies1','size'=>'7','empty'=>false,'style'=>'width:200px;display:none;'));?>      
			<?php }?>  
			</td>
		        </tr>
		        <tr>
		         <tr><td colspan='2'>&nbsp;</td></tr>
		         <td  valign='top'><label class="boldlabel">Contacts:</label></td>
			      <td>
			      <div style="width:186px; overflow:auto">
			      	<?php echo $form->select('Sponsor.contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','empty'=>false,'style'=>'width:200px;'));?>
			        </div>
				<?php if($this->data['Sponsor']['id']==0) { ?>
				<br />
				<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added contacts</span>
			      	<br />
			          <input type="button" value="View" name="view" ONCLICK="viewcontact()" />
		        &nbsp;&nbsp;
		        <input type="button" value="Add" name="Add" ONCLICK="copycontact()"  />
				<br/>			
			<?php }?>  <span id="gridTable"></span>
			</td>
		        </tr>
		         <tr><td colspan='2'>&nbsp;</td></tr>
			</table>
</div>
<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>


</div><!--container ends here-->

<script language="javascript">
function viewcompanys(){
document.getElementById('companies1').style.display="block";
}
function copycompanys(){ 
	dropdown = document.getElementById('companies1');
	var existlist = document.getElementById('companies').value;
var alreadyexist=false;
for(var i=0; i<dropdown.length; i++){

				if(dropdown[i].selected == true){ 

var optn = document.createElement("OPTION");
optn.text = dropdown[i].text;
optn.value = dropdown[i].value;
for(var j=0; j<document.getElementById('companies').options.length; j++){
	if(document.getElementById('companies').options[j].value==dropdown[i].value)
	{
		alreadyexist=true;
		break;
	}
}
if(alreadyexist==false) document.getElementById('companies').options.add(optn);

for(var j=0; j<document.getElementById('companies').options.length; j++){
document.getElementById('companies').options[j].selected=true;
}
}
}
}

function viewcontact(){
	
	if(document.getElementById('companies').options.length==0)
	{
		alert("Please add company");
	}
	else{
	var selectedcompany = new Array(); 
	for (var i = 0; i < document.getElementById('companies').options.length; i++) 
	selectedcompany.push(document.getElementById('companies').options[i].value);
	}
	
	jQuery.ajax({
		type: "GET",
		url: '/admins/getcontacts/'+selectedcompany,
		cache: false,
		success: function(rText){	
			    jQuery('#gridTable').html(rText);			
		}
	});
	//document.getElementById('contacts1').style.display="block";
}
function copycontact(){ 
	dropdown = document.getElementById('contacts1');
	var existlist = document.getElementById('contacts').value;
var alreadyexist=false;
for(var i=0; i<dropdown.length; i++){
				if(dropdown[i].selected == true){ 
var optn = document.createElement("OPTION");
optn.text = dropdown[i].text;
optn.value = dropdown[i].value;

for(var j=0; j<document.getElementById('contacts').options.length; j++){
	if(document.getElementById('contacts').options[j].value==dropdown[i].value)
	{
		alreadyexist=true;
		break;
	}
}
if(alreadyexist==false) document.getElementById('contacts').options.add(optn);

for(var j=0; j<document.getElementById('contacts').options.length; j++){
document.getElementById('contacts').options[j].selected=true;
}
}
}
}
</script>
