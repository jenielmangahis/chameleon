<?php 
$lgrt = $session->read('newsortingby'); ?>
<!--container starts here-->
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$base_url = Configure::read('App.base_url');
$ProjectOwnerAddUrl = $base_url.'contacts/sa_addcompany';
$ProjectContactsAddUrl = $base_url.'contacts/sa_addcontacts';
//pr($this->data);
?>
<?php echo $form->create("Admins", array("action" => "editproject",'name' => 'editproject', 'id' => "editproject",'onsubmit' => 'return validateproject("add");'))?>
<div class="titlCont"><div class="myclass">

       <div id="toppanel" >
               <?php  echo $this->renderElement('new_slider');  ?>

</div>

		<span class="titlTxt">
		<?php
		echo (isset($this->data['Project']['id']))?"Edit Project":"Add Project";
		?>
		</span>
        <div class="topTabs">
                <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li>
				<?php
				e(
					$html->link(
						$html->tag('span','Cancel'),
						array('controller'=>'admins','action'=>'projectlist'),
						array('escape'=>false)
					)
				);
				?>
				</li>
                </ul>
        </div>
		<div class="clear"></div>
		<?php $this->projectlist="tabSelt"; echo $this->renderElement('project_list_submenu'); ?>
</div>
</div>
<!--inner-container starts here--><div style="width:1000px; margin: 0pt auto; min-height: 450px;">     
<div id="center-column">
	<div class="top-bar" style="border-left:0px;">
        </div><br />
        <div class="table" style="height: 350px;">
            <?php if($session->check('Message.flash')){ ?> 
                <div id="blck"> 
                    <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
                    <div class="msgBoxBg">
                        <div class="">
						<?php
						e($html->link(
							$html->image('close.png',array('style'=>'margin-left: 945px; position: absolute; z-index: 11;','alt'=>'Close')),
							'javascript:void(0)',
							array('escape' => false,'onclick' => "hideDiv()")
							)
						);
						$session->flash();
						?> 
		</div>
                        <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
                    </div>
                </div> <?php } ?>
		
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

		
        <table width="450px" align="left" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
								   echo $form->error('Project.project_name', array('class' => 'msgTXt'));
								   echo $form->error('Project.serialprefix', array('class' => 'msgTXt'));
								   //echo $form->error('Project.project_type_id', array('class' => 'msgTXt'));
									echo $form->hidden("Project.id", array('id' => 'projectid'));

						
						?><span id="updatediv1"></span><span id="updatediv2"></span></td>
		</tr>

                <tr>
                    <td align="right" width="150px"> <label class="boldlabel">Project Name <span class="red">*</span></label></td>
                    <td><span class="intpSpan"><label for="title"></label>   <?php echo $form->input("Project.project_name", array('id' => 'project_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?>
                    </span>
                     </td>
				</tr>
                <tr>
                    <td align="right"> <label class="boldlabel">System Project Name <span class="red">*</span></label></td>
                    <td><span class="intpSpan"><label for="title"></label>   <?php echo $form->input("Project.system_name", array('id' => 'system_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?>
                        </span>
                    </td>
                </tr>

                <tr>
				<td colspan='2'><div id="loadingdivimg" style="display:none">Loading..
				<?php
				e(
					$html->image('ajax-loader.gif')
				);
				?>
				</div>
				</td>
				</tr>
                <tr><td align="right"><label class="boldlabel">Project Type <span class="red">*</span></label></td>
                    <td><span class="txtArea_top"><span class="txtArea_bot">
                                <?php 
								//echo $this->data['Project']['project_type_id'];
								//pr($projectypedropdown);
								
								echo $form->hidden("ProjectType.id");
								echo $form->select("Project.project_type_id",isset($projectypedropdown)?$projectypedropdown:'',null,array('id' => 'project_type_id',"class"=>"multilist" ),"---Select---"); ?>

                        </span>   </span>

                    </td>
                    <td>&nbsp;</td>
                </tr>


                <tr>
                    <td align="right"> <label class="boldlabel">Relation Type <span class="red">*</span></label></td>
                   <style>
					   .tdCheckClass label{padding:0px 10px;}
					</style>
					<td class="tdCheckClass">
					<?php  echo $form->radio("Project.relation_type", array('Direct'=>'Direct','3rd Party'=>'3rd Party'), array('default'=>'Direct','id'=>'relation_type', 'legend'=>false,'class'=>'change_rel_type')); ?>     
                    </td>
                </tr> 
			<?php if(isset($this->data['Project']['id'])){
				$arraycoinset=array();
				if(!empty($coinsetsdisplay)){
					foreach($coinsetsdisplay as $key=>$value ) {
					   $coinsetname = $value;
					   if(preg_match('/[A-Z]{3}/', $coinsetname)==1){
							$coinsname= preg_split('/[A-Z]{3}/', $coinsetname);
							$coinsetname=$coinsname[1];
					   
						}
						$arraycoinset[$key]=$coinsetname;
					}
				}
				$pid=$this->data['Project']['id'];
			?>
			<tr>
				<td valign="top" align="right" class="lbltxtarea"><label class="boldlabel">Project Coinsets </label></td>
				<td>
					<div class="txtArea_top">
						<span class="newtxtArea_bot">
							<?php 
							echo $form->select('coinsetsdisplay',$arraycoinset, null,array('multiple'=>'multiple','id'=>'emaillists','size'=>'7','empty'=>false,'class'=>'multilist multi'));?>
						</span>
					</div>
					<span class="btnLft"><input type="button" class="btnRht" value="View" name="view" id="view_coinset"/></span><span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button" class="btnRht" value="Add" name="Add" id="addCoinSet" title="<?php echo $this->data['Project']['id'] ?>"  /></span>
				</td> 
			</tr> 

			<?php } ?> 
			<tr id="distributor_content">
                    <td align="right"> <label class="boldlabel">Distributor </label></td>
                    <td><br /><span class="intpSpan"><?php echo $form->input("Project.distributor", array('id' => 'distributor', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
             </span>
                    </td>
                </tr> 

                <tr>
                    <td align="right" valign="top"> <label class="boldlabel">Coin Prices</label>&nbsp;&nbsp;</td>
                    <td valign="top">
                        
                            <span class="txtArea_bot"><?php //echo $form->select("PricingType.pricing_types",$product_types,0,array('label'=>'','id' => 'pricing_types','class'=>'inpt_sel_fld','style'=>"margin-left: 20px;",'MULTIPLE'=>'Yes','size'=>'5'),'Select One'); ?>
                            
                            <div id="contactemails" style=" background: none repeat scroll 0 0 #EBEBEB;  border: 1px solid #D3D3D3; display: block; font-size: 13px; height: 113px; overflow: auto; width: 100%;" >
                            <table width="100%">
                            <tr>
                            <th width="6%">Select</th>
                            <th width="47%">Product Type</th>
                            <th width="47%">Pricing Type Name</th>
                            </tr>
                            
                            <tr>
                            <td colspan="3"><hr style="background-color: black;"></td>
                            </tr>
                           
                            <?php 
							//pr($product_type_names);	
						    for($i=0;$i<count($product_type_names);$i++)
                            {
								if($selected_options[$i]==1)
                                                        $check="checked";
                                                    else
                                                        $check="";
                                ?>
                                    <tr align="center">
                                    <td width="6%"><?php echo $form->input("price_type_options.$i", array('id' => 'price_type_options'.$i, 'div' => false, 'label' => '','type'=>'checkbox','checked'=>$check));?></td>
                                    <td width="47%"><?php echo  $product_type_names[$i]; ?></td>
                                    <td width="47%"><?php echo  $pricing_type_names[$i]; ?></td>
                                    </tr>
                                <?php
                            }
                            
                            ?>
                            
                            </table>            
                            </div>
                            

                        </span>

                    </td>
                </tr> 
                
                <tr><td>&nbsp;</td><td colspan='2'>&nbsp;</td></tr>
                <tr><td align="right"><label class="boldlabel">System Price </label></td>
                    <td><span class="txtArea_top"><span class="txtArea_bot">
                                <?php echo $form->select("Project.system_pricing_id",$sys_pri_data,null,array('id' => 'system_pricing_id',"class"=>"multilist" ),"---Select---"); ?>
                        </span></span>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                
                <tr style="height: 22px;">
                        <td  align="right" style="padding-bottom: 10px; width: 165px;" ><label class="boldlabel">Shopping Cart Enabled</label></td>
                        <td style="padding-bottom: 10px;"><?php echo $form->input('Project.is_shoppingcartenabled', array('type'=>'checkbox', 'label' => '','id'=>'is_shoppingcartenabled', 'value'=>'1')); ?>  </td>
                </tr>
				<tr style="height: 22px;">
                        <td  align="right" style="padding-bottom: 10px; width: 165px;" ><label class="boldlabel">Super Footer Enabled</label></td>
                        <td style="padding-bottom: 10px;"><?php echo $form->input('Project.is_superfooterenabled', array('type'=>'checkbox', 'label' => '','id'=>'is_superfooterenabled', 'value'=>'1')); ?>  </td>
                </tr>
				<tr><td align="right"><label class="boldlabel">Super Footer<span class="red">*</span></label></td>
                    <td><span class="txtArea_top"><span class="txtArea_bot">
                                <?php 
								if(isset($this->data['Project']['border_footer_id']) && !empty($this->data['Project']['border_footer_id']))
								$selItemBorder = $this->data['Project']['border_footer_id'];
								else
								$selItemBorder = $defaultborderFooter;
								
								
								echo $form->select("Project.border_footer_id",$super_borderFooter_list,$selItemBorder,array('id' => 'border_footer_id',"class"=>"multilist" ),"---Select---"); ?>
                        </span></span>
                    </td>
                    <td>&nbsp;</td>
                </tr>
				<tr style="height: 22px;">
                        <td  align="right" style="padding-bottom: 10px; width: 165px;" ><label class="boldlabel">Include Non Members</label></td>
                        <td style="padding-bottom: 10px;"><?php echo $form->input('Project.include_NonMembers', array('type'=>'checkbox', 'label' => '','id'=>'include_NonMembers', 'value'=>'1')); ?>  </td>
                </tr>
				<style>
				.rightAlignNumber {
				display:block;
				width: 50px;
				text-align: right;
				float: left;
				}
				</style>
				<tr style="height: 22px;">
                        <td  align="right" style="padding-bottom: 10px; width: 165px;" ><label class="boldlabel">Waive Setup Fee</label></td>
                        <td style="padding-bottom: 10px;"><?php echo $form->input('Project.waive_setup_fee', array('type'=>'checkbox', 'label' => '','id'=>'waive_setup_fee', 'value'=>'1')); ?>  </td>
                </tr>
<?php if(isset($this->data['Project']['id'])){ ?>
<tr>
                    <td align="right" width="150px"> <label class="boldlabel"># of Coins <span class="red">*</span></label></td>
                    <td><span class="rightAlignNumber"><?php echo $totalnumunits; ?></span></td>
				</tr>
<?php } ?>

<?php if(isset($this->data['Project']['id'])){ ?>
<tr>
                        <td  align="right"><label class="boldlabel"># of Members</label></td>
						 <td>
						 <span class="rightAlignNumber">
						 <?php 
						 echo $members_cnt;
						 //echo $form->input("projects.members_cnt", array('id' => 'billing_cnt', 'div' => false, 'label' => '','type'=>'text','value'=>$members_cnt));?>
						</span>				
						 </td>
                </tr>
<?php } ?>

<?php if(isset($this->data['Project']['id'])){ ?>
 <tr>
	<td align="right"><label class="boldlabel"># of Non-Members</label></td>
	<td align="left">
	<span class="rightAlignNumber"><?php echo $non_members_cnt; ?></span>
		&nbsp;&nbsp;&nbsp;&nbsp;
	<div style="float:left; width: 145px;padding-left: 17px;">
	<?php 
	echo $form->input("Project.inc_non_members_in_charge", array('id' => 'inc_pricing', 'div' => false, 'label' => '','type'=>'checkbox'));?>
	Include in Pricing
	</div>
	</td>
</tr>
<?php } ?>
<?php if(isset($this->data['Project']['id'])){ ?>
<tr style="height: 22px;">
                        <td  align="right" style="padding-bottom: 10px; width: 165px;" ><label class="boldlabel">Total # for Billing</label></td>
						 <td><span class="rightAlignNumber"><?php echo $total_billing_cnt; ?></span></td>
				
                </tr>
<?php } ?>


				<?php if(isset($this->data['Project']['id']) && !empty($this->data['Project']['id'])) {?>
				<tr>
                    <td align="right" width="170"> <label class="boldlabel">Current Monthly Charge</label></td>
                    <td><span class="intpSpan"><label for="title"></label>   <?php echo $form->input("Project.system_monthly_charge", array('id' => 'system_monthly_charge', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                    </span>
                     </td>
				</tr>
				<?php } else { ?>
				<tr>
                    <td align="right" width="170"> <label class="boldlabel">Starting Monthly Charge</label></td>
                    <td><span class="intpSpan"><label for="title"></label>   <?php echo $form->input("Project.system_monthly_charge", array('id' => 'system_monthly_charge', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                    </span>
                     </td>
				</tr>
				<?php } ?>
				<tr><td align="right"><label class="boldlabel">
				<?php echo ($this->data['Project']['id'])?'Current ':'';?>
				Billing Type </label></td>
                    <td><span class="txtArea_top"><span class="txtArea_bot">
                                <?php 
								echo $form->select("Project.billing_type_id",$billingType_list,null,array('id' => 'billing_type_id',"class"=>"multilist" ),"---Select---"); ?>
                        </span></span>
                    </td>
                    <td>&nbsp;</td>
                </tr>
				<?php if(isset($this->data['Project']['id']) && !empty($this->data['Project']['id'])) {?>
				<tr>
                    <td align="right" width="150px"> <label class="boldlabel">Next Billing Date</label></td>
                    <td><span class="intpSpan"><label for="title"></label>   <?php 
					//echo $this->data['Project']['billing_type_id'];
					echo $form->input("Project.start_billing_date", array('id' => 'start_billing_date', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                    </span>
                     </td>
				</tr>
				<?php } else { ?>
				<tr>
                    <td align="right" width="150px"> <label class="boldlabel">Start Billing Date</label></td>
                    <td><span class="intpSpan"><label for="title"></label>   <?php echo $form->input("Project.start_billing_date", array('id' => 'start_billing_date', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>date("Y-m-d")));?>
                    </span>
                     </td>
				</tr>
				<?php } ?>
				<tr><td align="right"><label class="boldlabel">User Agreement</label></td>
                    <td><span class="txtArea_top"><span class="txtArea_bot">
                                <?php 
								if(!isset($this->data['Project']['user_agreement_id']) && empty($this->data['Project']['user_agreement_id']))
								$selectedagreementId = $selectedagreement;
								else
								$selectedagreementId = $this->data['Project']['user_agreement_id'];
								
								echo $form->select("Project.user_agreement_id",$agreementdropdown,$selectedagreementId,array('id' => 'user_agreement_id',"class"=>"multilist" ),"---Select---"); ?>
                        </span></span>
                    </td>
                    <td>&nbsp;</td>
                </tr>
	        <!--<tr><td><label class="boldlabel">Serial # Prefix </label></td>
				<td><span class="intpSpan"><label for="title"></label>   <?php //echo $form->input("Project.serialprefix", array('id' => 'serialprefix', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3"));?>
                                                    
                                                  </span>
                                                      
                                                      
                                                     </td>
	       		<td></td>
	        </tr>-->
	        <tr><td>&nbsp;</td><td colspan='2'><div id="loadingdivimg" style="display:none">Loading..<img src="/img/ajax-loader.gif"></div></td></tr>
	       

		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
<tr><td colspan="2">&nbsp;  </td></tr>
                <tr><td colspan="2"><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
            </div></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2">&nbsp;  </td></tr>
	<tr><td colspan="2">&nbsp;  </td></tr>
	<tr><td colspan="2">&nbsp;  </td></tr>

	    </table>
            
             <table width="510px" align="right" cellpadding="1" cellspacing="1"  >
             <tr>
             <td valign="top" align="right" width="32%"><label class="boldlabel">Current Status <span class="red">*</span></label></td>
             <td>
			 <div style="width:192px; line-height: 30px;">
				<span class="txtArea_top"><span class="txtArea_bot">
			 <?php 
			 if(isset($this->data['Project']['status_type_id']) && !empty($this->data['Project']['status_type_id']))
			 $selItem = $this->data['Project']['status_type_id'];
			 else
			 $selItem = $defaulProjectStatus;
				echo $form->select("Project.status_type_id",$projectStatusTypes,$selItem,array('id' => 'status_type_id',"class"=>"multilist" ),"---Select---");
			?>
				</span></span>
			 </div>
			 </td>
             </tr>


			 <?php if(isset($this->data['Project']['id'])){ ?>
<tr style="height: 22px;">
                        <td  align="right" style="padding-bottom: 10px; width: 165px;" ><label class="boldlabel">Date Entered</label></td>
						 <td>
						 <span class="intpSpan"><label for="title"></label>
						 <?php 
						 $cdate = '';
						 if(isset($this->data['Project']['created']) && !empty($this->data['Project']['created'])) {
						 //$cdate = date('d-m-Y',strtotime($this->data['Project']['created']));
						 $cdate = $this->data['Project']['created'];
						 echo $form->input("Project.created1", array('id' => 'system_monthly_charge', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$cdate,'readonly'=>'readonly'));
						 } else {
						 echo $form->input("Project.created", array('id' => 'system_monthly_charge', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));
						 }
						 ?>
                    </span>
                     </td>
				
                </tr>
<?php } ?>




			 <tr>
             <td valign="top" align="right" class="lbltxtarea"><label class="boldlabel">Project Owner <span class="red">*</span></label></td>
             <td>
				<div>
				 <span class="txtArea_top">
                 <span class="newtxtArea_bot"><?php 
				 //print_r($ownersIds);
				 echo $form->select('ProjectOwner.owners',$companies, null,array('multiple'=>'multiple','id'=>'companies_bb','size'=>'3','empty'=>false,'class'=>'multilist multi','tabindex'=>10,'default'=>$ownersIds));?></span></span>
				</div>
				<!--<span class="btnLft">
					<input type="button" value="View" class="btnRht" name="view" id="view_company"/></span><span style="display:inline-block;width:8px">
				</span><span class="btnLft">
				
				<input type="button" value="Add"   class="btnRht" name="Add"  ONCLICK="javascript:(window.open('<?php echo $ProjectOwnerAddUrl ?>'))" /></span>  -->
			 </td>
             </tr>
			 <tr>
             <td valign="top" align="right" class="lbltxtarea" style="width: 130px;"><label class="boldlabel">Project Administrator <span class="red">*</span></label></td>
             <td>
							<div >
                                <span class="txtArea_top">
									<?php
									//print_r($contects);
									?>
									<span class="newtxtArea_bot" id="newContects">
									<?php echo $form->select('Project.project_contact_admin_id',$contects, null,array('id'=>'contacts','size'=>'1','empty'=>false,'class'=>'multilist multi','default'=>$contactsIds));?>
									</span>
								</span>
                            </div>
                            
							<!--<span class="btnLft"><input type="button"  class="btnRht" value="View" name="view" id="view_contact"/></span>
							<span style="display:inline-block;width:8px"></span>
							<span class="btnLft"><input type="button" class="btnRht" value="Add" name="Add" id="projectContectAdd" /></span>
							-->
							
			 </td>
             </tr>
			 <tr>
             <td valign="top" align="right" class="lbltxtarea" style="width: 130px;"><label class="boldlabel">Project Contacts</label></td>
             <td>
							<div >
                                <span class="txtArea_top">
									<span class="newtxtArea_bot" id="newContects">
									<?php echo $form->select('ProjectOwner.contacts',$contects, null,array('multiple'=>'multiple','id'=>'ProjectContacts','size'=>'4','empty'=>false,'class'=>'multilist multi','default'=>$contactsIds));?>
									</span>
								</span>
                            </div>
                            
							<span class="btnLft"><input type="button"  class="btnRht" value="View" name="view" id="view_contact"/></span>
							<span style="display:inline-block;width:8px"></span>
							<span class="btnLft"><input type="button" class="btnRht" value="Add" name="Add" id="projectContectAdd" /></span>
							
			 </td>
             </tr>
			
			 <?php echo $form->hidden("Sponsor.username", array('id' => 'sponsor_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
             <?php 
			 echo $form->hidden("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));
			 ?>
			 <?php echo $form->hidden("pa_contacts", array('id' => 'pa_contacts', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
             <?php if(!isset($this->data['Project']['id']) && empty($this->data['Project']['id'])) {?>
             <tr>
             <td align="right"><label class="boldlabel">Temp Password <span class="red">*</span></label></td>
             <td><span class="intpSpan"><?php echo $form->password("Sponsor.password", array('id' => 'password', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>     
             </tr>
			 <?php } ?>
             
             <tr>
             <td align="right"><label class="boldlabel">Notification Email <span class="red">*</span></label></td>
             <td><span class="intpSpan"><?php echo $form->input("Sponsor.email", array('id' => 'notificationEmail', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150","value"=>isset($SponserName)?$SponserName:''));?>
             </span></td>
             </tr>
             
             <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             </tr>
             
             <tr>
             <td valign="top" align="right"><label class="boldlabel">Notes </label></td>
             <td><span class="txtArea_top">
                                    <span class="newtxtArea_bot"><?php echo $form->textarea("Project.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '27', 'rows' => '8',"class" => "noBg"));?></span></span>
				  </td>
             </tr>
             
             </table>
            
   

					<!-- ADD Sub Admin  FORM EOF -->
			</div></div>

  
</div><!--inner-container ends here-->


<div class="clear"></div>

<?php echo $form->end();?>     


<script>
	
    $("#distributor_content").hide();
    
    $(".change_rel_type").change(function () {
        
      if($(this).val()=="3rd Party") 
      {
        $("#distributor_content").show();
        get_all_information($(this).val());
      }
      if($(this).val()=="Direct") 
      {
        $("#distributor_content").hide();
        get_all_information($(this).val());
      }
    });
    
	
	
	// By Suman
	$('#is_superfooterenabled').click (function () {
		//var thisCheck = $(this);
		if ($('#is_superfooterenabled').is (':checked')) {
		$('#border_footer_id').attr("disabled", false);
		} else {
		$('#border_footer_id').attr("disabled", true);
		}
	});
	
	if ( ! $('#is_superfooterenabled').is (':checked')) {
		$('#border_footer_id').attr("disabled", true);
	}
	
	$('#project_name').bind('keyup keypress blur', function() {  
		$('#username').val($(this).val()); 
	});
	
	$("#companies_bb").change(function () {
		var str;
		$("#companies_bb option:selected").each(function () {
			str = $("#companies_bb").val();
        });
		   $("select#contacts").attr('disabled',false);
		//alert(str);
		loadCompanyNames(str,'');
		
	});
	
	/*
	$("#contacts").change(function () {
		var str;
		$("#contacts option:selected").each(function () {
			str = $("#contacts").val();
        });
		//alert(str);
		checkContactsForProjectLead(str);
	});
	*/
    
	$("#view_company").click(function(){   
        var companiesid;
		$('select#companies_bb :selected').each(function() {
            //alert($(this).val());
			companiesid = $(this).val();
			return false;
        });
		
		if(companiesid==null || companiesid==""){
            alert("Please select a company");
            return false;
        }else{
            var url=baseUrl+"contacts/sa_addcompany/"+companiesid;
            window.open(url);
        }
    });
	
    $("#projectContectAdd").click(function(){   
        var companiesid;
		var url
		$('select#companies_bb :selected').each(function() {
            //alert($(this).val());
			companiesid = $(this).val();
			return false;
        });
		
		if(companiesid==null || companiesid==""){
            url = baseUrl+"contacts/sa_addcontacts/";
        }else{
            url = baseUrl+"contacts/sa_addcontacts/0/"+companiesid;
        }
		window.open(url);
    });
    
	$("#view_contact").click(function(){   
        //var contactsid=$("#contacts").val();
        var contactsid;
		$('select#contacts :selected').each(function() {
            //alert($(this).val());
			contactsid = $(this).val();
			return false;
        });
		if(contactsid==null || contactsid==""){
            alert("Please select a contacts");
            return false;
        }else{
            var url=baseUrl+"contacts/sa_addcontacts/"+contactsid;
            window.open(url);
        }
    });
    
	function loadCompanyNames(str,str2,str3) {
		//alert(str3);
		var cid = {id : str,selectedOption : str2};
        $.ajax({
				type:"POST",
				url: baseUrlAdmin+"getcontactsbycompanyid_ajax",
				cache:false,
				data:cid,
				success: function(output){
					//alert(output);
					$("#contacts").html(output);
					//$("#aaaaa").val(output);
					ownreText = '';
					$('select#companies_bb :selected').each(function() {
						//alert($(this).val());
						ownreText = $(this).text();
						return false;
					});
					$("#sponsor_name").val(ownreText);
					var cid = {id : str,selectedOption : str3};
					loadProjectContacts(cid);
					//alert(ownreText);
				}
            });
	}
	
	function loadProjectContacts(cid) {
		$.ajax({
				type:"POST",
				url: baseUrlAdmin+"getcontactsbycompanyid_ajax_edit",
				cache:false,
				data:cid,
				success: function(output){
					//alert(output);
					$("#ProjectContacts").html(output);
					//$("#aaaaa").val(output);
				}
            });
	}
	
	
	function checkContactsForProjectLead(str) {
		//alert(str);
		var cid = {id : str};
        $.ajax({
				type:"POST",
				url: baseUrlAdmin+"getprojectLeadEmai_ajax",
				cache:false,
				data:cid,
				success: function(output){
					//alert(output);
					if(output != '') {
					$("#notificationEmail").val(output);
					}
				}
            });
	}
	
	
	    
</script>

<script language="javascript">
function get_all_information(rel_type){
    var type=1;
    if(rel_type=="Direct")
       type=1;
    else
        type=2;
	$('#contactemails').load(baseUrlAdmin+'get_product_details/'+type, function(){
	   //  $("#comment_start").val(commnet_offset);
		  $('#contactemails').fadeIn(1000); 
		
	}); 
}

	// For edit case
	var radio_button_val = $("input[name='data[Project][relation_type]']:checked").val();
	if ( radio_button_val == '3rd Party') {
		get_all_information(2);
	}
        
    $("#system_pricing_id").change(function(){
       get_sys_pricing_info(this.value); 
        
    });    
        

	$("#view_coinset").click(function(){   
        var current_domain=$("#current_domain").val();
        var coinsetid=$("#emaillists").val();
       
        if(coinsetid==null || coinsetid==""){
            alert("Please select a coinset");
            return false;
        }else{
            var url=baseUrlAdmin+"editcoinset/"+coinsetid;
            window.location=url;
        }


    });
        
    function get_sys_pricing_info(sys_pri_id,check)
    {
        $("#system_monthly_charge").val('');
		var path = baseUrlAdmin+"get_sys_pricing_charge";
        var members=0;
        var non_members=0;
              

        var postdata = {id : sys_pri_id,mem:members,non_mem:non_members,check:check};
        $.ajax({
                    type:"POST",
                    url: path,
                    cache:false,
                    data:postdata,
                    dataType:'json',
                    success: function(output){
                        //alert(output);
                                                
                        
						$("#system_monthly_charge").val(output.monthly_charge);
						/*
						if(output.shopping_cart!="")
                        {
                            var shopping_cart=output.shopping_cart;
                            
                            if(shopping_cart==1)
                            {
                                $("#is_shoppingcartenabled").attr("checked","checked");
                            }
                            else
                            {
                                $("#is_shoppingcartenabled").attr("checked","");
                            } 
                        }
						*/	

                    }
                });
    }

	$("#addCoinSet").click(function(){
		var id = $(this).attr('title');
		setProjectSession(id);
		window.open(baseUrlAdmin + "addcoinset");
	})

	function setProjectSession(projectid){
	//document.getElementById('projectid').value= projectid;
	//document.adminhome.submit();
	if(projectid == 'undefined' || projectid == '' || projectid == null )
	return false;
	var redirectionURL = baseUrlAdmin+"project_redirection";
	$.ajax({
	  type: "POST",
	  url: redirectionURL,
	  data: {id : projectid},
	  success: function(data) {
		//window.location = baseUrlAdmin + "projectdashboard";
	  }
	});
}
	
</script>

<?php 
	$ownersIds_str = '';
	$conIds_str = '';
	
	if(isset($ownersIds) && !empty($ownersIds))
	$ownersIds_str = implode(',',$ownersIds);
	if(isset($contactsIds) && !empty($contactsIds))
	$conIds_str = implode(',',$contactsIds);
	$projectAdminContact = $this->data['Project']['project_contact_admin_id'];	
?>
<script>
	var alreadyStr = '<?php echo $ownersIds_str ?>';
	//var alreadyConStr = '<?php echo $conIds_str ?>';
	var alreadyConStr = '<?php echo $conIds_str ?>'; 	
	var projectAdminContact = '<?php echo $projectAdminContact ?>';
	var alreadyCid = {id : alreadyStr};
	loadCompanyNames(alreadyCid,projectAdminContact,alreadyConStr);
	$("select#contacts").attr('disabled',true);
	$("select#contacts").attr('title','edit');
</script>

