<?php
//pr($this->data);die;
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'editprojectdtl';
?>
<!-- Body Panel starts -->
<div class="container">
        <div class="titlCont">
        <div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
    <?php echo $form->create("Admin", array("action" => "projectsponsor",'type' => 'file','enctype'=>'multipart/form-data','name' => 'projectsponsor', 'id' => "projectsponsor",'onsubmit' => 'return validatesponsor();'))?>
            <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>&nbsp;</span>
            <span class="titlTxt"> Edit Project Owner </span>

            <div class="topTabs">
                <ul class="dropdown">
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
                </ul>
            </div>

           <?php    
				$this->loginarea="admins";
				$this->subtabsel="projectsponsor";
             //   echo $this->renderElement('project_submenus');  
			  echo $this->renderElement('setup_submenus');
			?>   
        </div>
        </div>
        
    <div class="midCont" id="cmplisttab"> 

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <div id="Sponsor">
            <div class="left newtab">
                <table width="800px" align="center" cellpadding="1" cellspacing="1">
                    <?php echo $form->hidden('Sponsor.user_id') ?>
					 <?php echo $form->hidden('Company.id',array('value' => $cid)) ?>
                    <?php echo $form->hidden("Sponsor.id") ?>
                    <?php if($session->check('Message.flash')){ ?> 
                        <tr><td colspan="3" align="center">
                                <?php $session->flash(); ?> 
                            </td>
                        </tr>
                        <tr><td colspan="3" align="center">&nbsp;</td></tr>
                        <?php } ?>
                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Owner Name  <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label>
                            <?php echo $form->hidden("Sponsor.id") ?>
                            <span class="intpSpan"><?php echo $form->input("Sponsor.sponsor_name", array('id' => 'sponsor_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld",'tabindex'=>1,"maxlength" => "150",'readonly' => true));?></span></td>
                        <td rowspan="10">
                            <table class='left' width="361px">
                                <tr>
                                    <td  valign='top' align="right" width="50%" class="lbltxtarea"><label class="boldlabel">Company </label></td>
                                    <td>
                                        <div>
                                            <span class="txtArea_top">
                                                <span class="newtxtArea_bot"><?php echo $form->select('Sponsor.companies',$companies, null,array('multiple'=>'multiple','id'=>'companies','size'=>'7','empty'=>false,'class'=>'multilist multi','tabindex'=>10));?></span></span>
                                        </div>
                                        <?php /*if($spondtl['Sponsor']['id']==0)*/ { ?>

                                            <!--<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added companies</span>-->

                                            <span class="btnLft"><input type="button" value="View" tabindex=11 class="btnRht" id="view_company" name="view"  /></span><span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button" value="Add" name="Add" tabindex=12 class="btnRht" ONCLICK="javascript:(window.location=baseUrl+'contacts/addcompany')" /></span>
                                            <br/>
                                            <?php echo $form->select('companies1',$companies, null,array('multiple'=>'multiple','id'=>'companies1','size'=>'7','empty'=>false,'style'=>'width:186px;display:none;'));?>      
                                            <?php }?>  
                                    </td>
                                </tr>

                                <tr><td colspan='2'></td></tr>
                                <tr>	
                                    <td  valign='top' align="right" class="lbltxtarea"><label class="boldlabel">Contacts </label></td>
                                    <td>
                                        <div >
                                            <span class="txtArea_top">
                                                <span class="newtxtArea_bot">
                                                <?php echo $form->select('Sponsor.contacts',$pcontacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','empty'=>false,'class'=>'multilist multi','tabindex'=>13));?></span></span>
                                        </div>
                                        <?php /*if($spondtl['Sponsor']['id']==0)*/ { ?>

                                            <!--<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Please don't click on added contacts</span>-->

                                            <span class="btnLft"><input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view"  /></span><span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button" value="Add" name="Add" tabindex=15 class="btnRht" ONCLICK="javascript:(window.location=baseUrl+'contacts/addcontacts')"  /></span>
                                            <br/>			
                                            <?php }?><span id="gridTable"></span>
                                    </td>
                                </tr>
                                <tr><td colspan='2'>&nbsp;</td></tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Owner Email  <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label><span class="intpSpan">
                            <?php echo $form->input("Company.email", array('id' => 'email', 'div' => false, 'label' => '','tabindex'=>2,"class" => "inpt_txt_fld","maxlength" => "150",'value' => $email));?></span></td>

                    </tr>
                   
	<!----			   <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Login ID  <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label><span class="intpSpan">
                            <?php echo $form->input("Sponsor.sponsor_login_id", array('id' => 'sponsor_login_id', 'div' => false, 'label' => '','tabindex'=>2,"class" => "inpt_txt_fld","maxlength" => "150",'readonly' => true,'value' => $username));?></span></td>

                    </tr>
---->
                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Address 1 <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label><span class="intpSpan">
                            <?php echo $form->input("Company.address1", array('id' => 'address1', 'div' => false,'tabindex'=>3,'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value' => $address1));?></span></td>

                    </tr>

                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Address 2 </label>&nbsp;</td>
                        <td width=""><label for="project_name"></label><span class="intpSpan">
                            <?php echo $form->input("Company.address2", array('id' => 'address2', 'div' => false, 'label' => '','tabindex'=>4,"class" => "inpt_txt_fld","maxlength" => "200",'value' => $address2));?></span></td>

                    </tr>

                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Country <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label>
                            <span class="txtArea_top">
                                <span class="txtArea_bot">
                                    <span id="countrydiv">
                                        <?php 
										//$selectedcountry = $this->data['Sponsor']['country'];
										echo $form->select("Company.country",$countrydropdown,$selectedcountry,array('id' => 'country','tabindex'=>5,'class'=>"multilist",'onchange'=>'return getstateoptions(this.value,"Sponsor")'),array('254'=>'United States')); ?>
                                    </span>
                                </span>
                            </span>
                        </td>

                    </tr>


                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">State <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label>
					<?php 
					//print_r($this->data);die;
					echo $form->hidden("stateid",array('id' => 'stateid', 'value'=>$this->data['Sponsor']['state'])); ?> 
                      <div id="d1">
                        <span class="txtArea_top">
                           <span class="txtArea_bot">
                              <span id="sttdiv">
                                <?php 	
								//$sslectedstate = $this->data['Sponsor']['state'];
								//print_r($statedropdown);
								//var_dump($selectedstate);

								echo $form->select("Company.state",$statedropdown,$selectedstate,array('id' => 'state','tabindex'=>6,'class'=>'multilist'));?>
                                </span>
                                    </span>
                                </span>
                            </div>

                        </td>
                        
                               
                        <?php echo $form->hidden("Sponsor.newstate",array('id' => 'newstate')); ?>
                    </tr>	

                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">City <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label>
                            <span class="intpSpan"><?php echo $form->input("Company.city",array('id' => 'city', 'div' => false, 'label' => '','tabindex'=>7,"class" => "inpt_txt_fld","maxlength" => "150",'value' => $city)); ?></span></td>

                    </tr>

                    <tr>
                        <td width="" align="right" class="lbltxtarea"><label class="boldlabel">Zip/Postal Code <span style="color:red">*</span></label></td>
                        <td width=""><label for="project_name"></label><span class="intpSpan">
                            <?php echo $form->input("Company.zipcode", array('id' => 'zipcode', 'div' => false,'tabindex'=>8, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10",'value'=> $zipcode));?></span></td>

                    </tr>
                    <!--<tr><td colspan='2'></td></tr>-->
                    <tr>
                        <td  valign='top' align="right" class="lbltxtarea"><label class="boldlabel">Sponsor Logo </label>&nbsp;</td>
                        <td valign='top'><span class="intpSpan"> <?php  echo $form->file('Sponsor.sponlogo',array('id'=> 'logo','tabindex'=>9,"class" => "inpt_txt_fld"));?></span><br>
                            <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250 Pixels</span><br>
                            <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2" align="right">
						<?php 
						if($spondtl['Sponsor']['logo'] !=''){
							echo $html->image($projectname.'/uploads/'.$this->data['Sponsor']['logo']);
						}
						?></td>
                    </tr>
                    <tr><td colspan="2"  align="left" style="padding:20px 0px 20px 10px;"> <?php  echo $this->renderElement('bottom_message');  ?> </td><td>&nbsp;</td><td>&nbsp;</td></tr>




                </table>
            </div></div>
    </div>
    <div class="clear"></div>
    <?php echo $form->end();?> 
</div>   

<script language='javascript'>    
 /*
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
 */
 
    $("#view_contact").click(function(){   
        var current_domain=$("#current_domain").val();
        var contactid=$("#contacts").val();
        if(contactid==null || contactid==""){
            return false;
        }else{
            var url=baseUrl+"contacts/addcontacts/"+contactid;
            window.location=url;
        }


    });
    
    
    $("#view_company").click(function(){   
        var current_domain=$("#current_domain").val();
        var companiesid=$("#companies").val();
        if(companiesid==null || companiesid==""){
            return false;
        }else{
            var url=baseUrl+"contacts/addcompany/"+companiesid;
            window.location=url;
        }
    });

</script>
