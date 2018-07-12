<?php ?>
<style type="text/css">
	.button{padding-bottom: 0px;}
</style>
<div class="titlCont"><div class="myclass">


<div align="center" id="toppanel" >
 <?php
		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '42'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   
  echo $this->renderElement('new_slider');  ?>



</div>


<span class="titlTxt">
Sponsor
</span>
	<?php echo $form->create("Company", array("action" => "projectsponsor",'type' => 'file','enctype'=>'multipart/form-data','name' => 'projectsponsor', 'id' => "projectsponsor", 'onsubmit' => 'return validatesponsor();'))?>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<!--<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>-->
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"><span> Cancel</span></button></li>
</ul>
</div>





<!-- <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear:both;">

<div id="tab-container-1">
	<ul id="tab-container-1-nav" class="topTabs2">
<li><a href="/companies/editprojectdtl"><span>Details</span></a></li>
              		<li><a href="/companies/coinsetlist"><span>Coinsets</span></a></li>
		<li><a href="/companies/projectsponsor" class="tabSelt"><span>Sponsor</span></a></li>
		<li><a href="/companies/companylist"><span>Companies</span></a></li>
		<li><a href="/companies/contactlist"><span>Contacts</span></a></li>
        <li><a href="/companies/projectcompanytypes"><span>Company Type</span></a></li>
        <li><a href="/companies/projectcontacttypes"><span>Contact Type</span></a></li>
		<li><a href="/companies/projectbackup"><span>Project Backup</span></a></li>   
		<li><a href="/companies/getstart"><span>Get Started</span></a></li>
    </ul>  -->
             <?php  $this->loginarea="companies";    
                    $this->subtabsel="projectsponsor";
                    echo $this->renderElement('project_submenus');  ?>   
</div></div>
    <div class='newtab' id="Sponsor">

	 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

	
   
    
    <table width="800px" align="center" cellpadding="1" cellspacing="1">
							<?php echo $form->hidden('Sponsor.user_id',array('value'=>$userid)) ?>
							<?php echo $form->hidden("Sponsor.id",array('value'=>$spondtl['Sponsor']['id'])) ?>
							 <?php if($session->check('Message.flash')){ ?> 
							<tr><td colspan="3" align="center">
									<?php $session->flash(); ?> 
							</td>
							</tr>
							<tr><td colspan="3" align="center">&nbsp;</td></tr>
							<?php } ?>
							<tr>
								<td  align="right" width="20%" class="lbltxtarea"><label class="boldlabel">Sponsor Name <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
									<?php echo $form->hidden("Sponsor.id",array('value'=>$spondtl['Sponsor']['id'])) ?>
									<span class="intpSpan"><?php echo $form->input("Sponsor.sponsor_name", array('id' => 'sponsor_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'tabindex'=>1,"maxlength" => "150",'value'=>$spondtl['Sponsor']['sponsor_name']));?></span></td>
								<td rowspan="10">
									<table class='left' width="361px">
										<tr>
											<td  valign='top' align="right" width="50%" class='lbltxtarea'><label class="boldlabel">Company </label></td>
											<td>
												<div>
													<span class="txtArea_top">
													<span class="newtxtArea_bot"><?php echo $form->select('Sponsor.companies',$companies, null,array('multiple'=>'multiple','tabindex'=>10,'id'=>'companies','size'=>'7','empty'=>false,'class'=>'multilist multi'));?></span></span>
												</div>
												
													<!--<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added companies</span>-->
													<span class="btnLft"><input type="button" tabindex=11 value="View" class="btnRht" name="view"  id="view_company" /></span><span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button" tabindex=12 value="Add" name="Add" class="btnRht" ONCLICK="javascript:(window.location='/companies/addcompany')"  /></span>
													<br/>
													<?php echo $form->select('companies1',$companies1, null,array('multiple'=>'multiple','id'=>'companies1','size'=>'7','empty'=>false,'style'=>'width:186px;display:none;'));?>      
												
											</td>
										</tr>
										<tr>
										<tr><td colspan='2' ></td></tr>
											<td  valign='top' align="right" width="" class='lbltxtarea'><label class="boldlabel">Contacts </label></td>
											<td>
												<div >
													<span class="txtArea_top">
													<span class="newtxtArea_bot"><?php echo $form->select('Sponsor.contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','tabindex'=>13,'empty'=>false,'class'=>'multilist multi'));?></span></span>
												</div>
												
													<!--<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added contacts</span>-->

													<span class="btnLft"><input type="button" value="View" tabindex=14 class="btnRht" name="view" id="view_contact" /></span><span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button" value="Add" name="Add" tabindex=15 class="btnRht" ONCLICK="javascript:(window.location='/companies/addcontacts')"  /></span>
													<br/>			
												<span id="gridTable"></span>
											</td>
										</tr>
										<tr><td colspan='2'>&nbsp;</td></tr>
									</table>
								</td>
							</tr>
								
							<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">Sponsor Email  <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.email", array('id' => 'email', 'div' => false, 'label' => '','tabindex'=>2,"class" => "inpt_txt_fld","maxlength" => "150",'value'=>$spondtl['Sponsor']['email']));?></span></td>
								
							</tr>
                            <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Sponsor Login ID  <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label><span class="intpSpan">
                            <?php echo $form->input("Sponsor.sponsor_login_id", array('id' => 'sponsor_login_id', 'div' => false, 'label' => '','tabindex'=>2,"class" => "inpt_txt_fld","maxlength" => "150",'value'=>$sponsor_login_id));?></span></td>

                    </tr>
								
							<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">Address 1  <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.address1", array('id' => 'address1', 'div' => false, 'label' => '','tabindex'=>3,"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$spondtl['Sponsor']['address1']));?></span></td>
								
							</tr>
								
							<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">Address 2</label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.address2", array('id' => 'address2', 'div' => false, 'label' => '','tabindex'=>4,"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$spondtl['Sponsor']['address2']));?></span></td>
								
							</tr>
								
							<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">Country <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
									<span class="txtArea_top">
													<span class="txtArea_bot"><?php echo $form->select("Sponsor.country",$countrydropdown,$selectedcountry,array('id' => 'country','tabindex'=>5,'class'=>"multilist",'onchange'=>'return getstateoptions(this.value,"Sponsor")'),"---Select---"); ?></span></span></td>
								
							</tr>



							<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">State <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>  <?php echo $form->hidden("stateid",array('id' => 'stateid', 'value'=>$this->data['Sponsor']['state'])); ?> 
								<span class="txtArea_top">
										<span class="txtArea_bot"><span id="statediv">
                                              <?php echo $form->select("Sponsor.state",$statedropdown,$selectedstate,array('id' => 'state','tabindex'=>6,'class'=>'multilist'),"---Select---");?>
								</span></span></span></td>
								
							</tr>

							                            <!--<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">State <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
								<div id="d1">	<span class="txtArea_top">
													<span class="txtArea_bot"><span id="statediv"><?php echo $form->select("Sponsor.state",$statedropdown,$selectedstate,array('id' => 'state','tabindex'=>6,'class'=>'multilist'),"---Select---");?></span></span>
													</span></div>
								<div id="d2" style="display: none;">	
								<span class="intpSpan" id="statediv1"></span>	
								</div>
								</td>
								<?php echo $form->hidden("Sponsor.newstate",array('id' => 'newstate')); ?>
							</tr>	  -->  
								
							<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">City <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label>
									<span class="intpSpan"><?php echo $form->input("Sponsor.city",array('id' => 'city', 'div' => false, 'label' => '','tabindex'=>7,"class" => "inpt_txt_fld","maxlength" => "150",'value'=>$spondtl['Sponsor']['city'])); ?></span></td>
								
							</tr>
								
							<tr>
								<td width="" align="right" class="lbltxtarea"><label class="boldlabel">Zip/Postal Code  <span style="color:red">*</span></label></td>
								<td width=""><label for="project_name"></label><span class="intpSpan">
									<?php echo $form->input("Sponsor.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '','tabindex'=>8,"class" => "inpt_txt_fld","maxlength" => "10",'value'=>$spondtl['Sponsor']['zipcode']));?></span></td>
								
							</tr>
							<!--<tr><td colspan='2'></td></tr>-->
							<tr>
								<td  valign='top' align="right" class="lbltxtarea"><label class="boldlabel">Sponsor Logo </label></td>
								<td valign='top'><?php  echo $form->file('Sponsor.sponlogo',array('id'=> 'logo','tabindex'=>9,"class" => "inpt_txt_fld"));?><br>
								<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250 Pixels</span>
										      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span>

								<br /></td>
												
							</tr>
							<tr>
								<td colspan="2"  align="right"><?php if($spondtl['Sponsor']['logo'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$spondtl['Sponsor']['logo']; ?>"> <?php } ?></td>
							</tr>
<tr>
								<td colspan="2"  align="left" style="padding:20px 0px 20px 10px;"> <?php  echo $this->renderElement('bottom_message');  ?> </td><td>&nbsp;</td>
							</tr>
						</table>


  </div>
    
    <?php echo $form->end();?>







</div>



<div class="clear"></div>
  <!-- Body Panel ends --> 
<script language='javascript'>    
 $(document).ready(function() {    

        var stateid=$("#stateid").val();
        var countryid=$("#country").val();
         if(!stateid || stateid=="undefined")   { 
            if(countryid!=""){
               getstateoptions(countryid,"Sponsor"); 
            }else{
                getstateoptions('254',"Sponsor");      // States for United Staes
            }
             
        }
        
 });
 
   $("#view_contact").click(function(){   
        var current_domain=$("#current_domain").val();
        var contactid=$("#contacts").val();
        if(contactid==null || contactid==""){
            return false;
        }else{
            var url="/companies/addcontacts/"+contactid;
            window.location=url;
        }


    });
    
    
    $("#view_company").click(function(){   
        var current_domain=$("#current_domain").val();
        var companiesid=$("#companies").val();
        if(companiesid==null || companiesid==""){
            return false;
        }else{
            var url="/companies/addcompany/"+companiesid;
            window.location=url;
        }


    });


</script>
