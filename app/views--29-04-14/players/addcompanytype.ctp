<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/types/company';
?> 
<div class="titlCont1">
<div class="centerPage">
                <?php echo $form->create("players", array("action" => "addcompanytype",'name' => 'addcompanytype', 'id' => "addcompanytype",'onsubmit' => 'return validatecompanytype("add");'));
                echo $form->hidden("CompanyType.id", array('id' => 'companytypeid')); ?>
				
       <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <span class="titlTxt1"><?php  echo $project_name; echo ($project_name !='')? ' : ' :'';  ?></span>&nbsp;
  <span class="titlTxt">Add Company Type </span>
        <div class="topTabs">
                <ul>
				<?php if(isset($usertype) &&  $usertype == 'admin') { ?>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<?php } ?>
                <li><a href="<?php echo $backUrl ?>"><span>Cancel</span></a></li>
                </ul>
        </div>
</div>  </div> 

	
<div class="midPadd">
		<div id="addcmp" style="height:300px;">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		<!-- ADD Sub Admin FORM BOF -->
                  
		<table width="" align="" cellpadding="1" cellspacing="1">
		
	
		 
		<tr><td colspan="2">&nbsp;</td></tr>
		
		
		<tr>
		<td width="15%"  align="right"><label class="boldlabel">Category Type <span style="color: red;">*</span></label></td>
			<td width="85%">
				<span class="txtArea_top" id="spancat"><span class="txtArea_bot"><span id="compdiv">
				<?php echo $form->select("CompanyTypeCategory.company_type_category_name", $companytypecategorydropdown, $selectedcompanytypecategory, array('id' => 'company_type_category_name','class'=>'multilist'),"---Select---");?>
				</span></span></span>
			<span class="intpSpan" id="spancattext" style="display:none" >
				<?php echo $form->input("CompanyTypeCategory.company_type_category_name_text", array('id' => 'company_type_category_name_text', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>	
			</span>
				<input type="hidden" id="hidctc" name="data[CompanyTypeCategory][hidctc]" value="company_type_category_name" />
			</td>
		</tr>    
		
		<tr>
			<td width="15%"  align="right"></td>
			<td width="85%" height="45px" >&nbsp;&nbsp;
			 <?php if(isset($this->data['CompanyType']['id']) && false){ ?>
			<button type="button" value="add" class="button" id="btnedit"  >
				<span>Edit</span>
			</button>
			<button type="button" value="save" class="button"  id="btnupdate" style="display:none">
				<span>Update</span>
			</button>
			<button type="button" value="cancel" class="button"  id="btneditcancel"  style="display:none">
				<span>Cancel</span>
			</button>
			<?php }else{ ?>
			<button type="button" value="add" class="button" id="btnadd"  >
				<span>ADD</span>
			</button>
			<button type="button" value="save" class="button"  id="btnsave" style="display:none">
				<span>Save</span>
			</button>
			<button type="button" value="cancel" class="button"  id="btncancel"  style="display:none">
				<span>Cancel</span>
			</button>
			
			<?php } ?>
			
		</td>
	</tr>    
	
	
		<tr><td colspan="2">&nbsp;</td></tr>
		
	   
		<tr>
			<td align="right" width="15%"><label class="boldlabel">3rd Party</label>&nbsp;</td>
			<td width="85%">&nbsp;&nbsp;
				<?php echo $form->input('CompanyType.is_3rdparty', array('id' => 'is_3rdparty','type'=>'checkbox','div' => false, 'label' => '')); ?>
			</td>
		</tr>
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
       
		<tr><td colspan="2">&nbsp;</td></tr>
		
		
		
		
		<tr>
		<td width="15%"  align="right"><label class="boldlabel">Company Type Status </label></td>
			<td width="85%">
				<span class="txtArea_top" id="spansubcat"><span class="txtArea_bot"><span id="compdiv">
				<?php echo $form->select("CompanyType.company_type_status_name", $companytypestatusdropdown, $selectedcompanytypestatus, array('id' => 'company_type_status_name','class'=>'multilist'),"---Select---");?>
				</span></span>	</span>
			<span class="intpSpan" id="spansubcattext" style="display:none" >
			<?php echo $form->input("CompanyTypeStatus.company_type_status_name_text", array('id' => 'company_type_status_name_text', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
			</span>
				<input type="hidden" id="hidcts" name="data[CompanyTypeStatus][hidcts]" value="company_type_status_name" />
			</td>
		</tr>    
		
		<tr>
			<td width="15%"  align="right">
				
			</td>
			<td width="85%" height="45px" >&nbsp;&nbsp;
			
				 <?php if(isset($this->data['CompanyType']['id']) && false){ ?>
										<button type="button" value="add" class="button" id="btnsubedit"  >
					<span>Edit</span>
				</button>
				<button type="button" value="save" class="button"  id="btnsubupdate" style="display:none">
					<span>Update</span>
				</button>
				<button type="button" value="cancel" class="button"  id="btnsubeditcancel"  style="display:none">
					<span>Cancel</span>
				</button>				
				
				<?php }else { ?>

				
				<button type="button" value="add" class="button" id="btnsubadd"  >
					<span>ADD</span>
				</button>
				<button type="button" value="save" class="button"  id="btnsubsave" style="display:none">
					<span>Save</span>
				</button>
				<button type="button" value="cancel" class="button"  id="btnsubcancel"  style="display:none">
					<span>Cancel</span>
				</button>
			 	<?php } ?>
			</td>
			
		</tr>  
		
		<tr><td colspan="2">&nbsp;</td></tr>
		
	
	    </table> 
<?php echo $form->end();?>

					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div>  <div class="top-bar" style="text-align: left; padding: 5px 0px 20px 5px; ">
                          		<?php  echo $this->renderElement('bottom_message');  ?>	 

                            </div> </div></div><div>
<!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->

<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>

<script type="text/javascript">
				
					
					$('#btnadd').live('click', function(){
						$('#spancattext').css('display','inline-block');
						$('#hidctc').val('company_type_category_name_text');
						$('#company_type_category_name_text').val('');
						$('#spancat').css('display','none');
						$('#btnadd').css('display','none');
						$('#btnsave').css('display','inline-block');
						$('#btncancel').css('display','inline-block');
					});
					
					$('#btncancel').live('click', function(){
						$('#spancattext').css('display','none');
						$('#spancat').css('display','inline-block');
						$('#hidctc').val('company_type_category_name');
						$('#btnadd').css('display','inline-block');
						$('#btnsave').css('display','none');
						$('#btncancel').css('display','none');
					});
					
					$('#btnsave').live('click', function(){
					
						var url=baseUrlAdmin+'ajax_add_company_type_category/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'ctcn='+$('#company_type_category_name_text').val(),
							dataType: "html",
							success: function(data){
								$('#company_type_category_name').html(data);
							}
						});
						
						$('#spancattext').css('display','none');
						$('#spancat').css('display','inline-block');
						$('#hidctc').val('company_type_category_name');
						$('#btnadd').css('display','inline-block');
						$('#btnsave').css('display','none');
						$('#btncancel').css('display','none');
					});
					
					
					/* --------------------------- */
					$('#btnedit').live('click', function(){
						$('#spancattext').css('display','inline-block');
						$('#spancattext').find('input[type="text"]').val($('#category_id option:selected').text());
						$('#hidctc').val('category_name_text');
						$('#spancat').css('display','none');
						$('#btnedit').css('display','none');
						$('#btnupdate').css('display','inline-block');
						$('#btneditcancel').css('display','inline-block');
					});
					
					$('#btneditcancel').live('click', function(){
						$('#spancattext').css('display','none');
						$('#spancat').css('display','inline-block');
						$('#hidctc').val('category_id');
						$('#btnedit').css('display','inline-block');
						$('#btnupdate').css('display','none');
						$('#btneditcancel').css('display','none');
					});
					
					$('#btnupdate').live('click', function(){
					//category_id
						var url=baseUrlAdmin+'ajax_edit_category/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'category_name='+$('#category_name_text').val()+'&category_id='+$('#category_id option:selected').val(),
							dataType: "html",
							success: function(data){
								var selected1 = $('#category_id option:selected').val();
								$('#category_id').html(data);
								$("#category_id option[value='"+selected1+"']").attr("selected", "selected");
							}
						});
						
						$('#spancattext').css('display','none');
						$('#spancat').css('display','inline-block');
						$('#hidctc').val('category_id');
						$('#btnedit').css('display','inline-block');
						$('#btnupdate').css('display','none');
						$('#btneditcancel').css('display','none');
					});
					
					/* ---------------------*/
					
				
					$('#btnsubadd').live('click', function(){
						$('#spansubcattext').css('display','inline-block');
						$('#hidcts').val('company_type_status_name_text');
						$('#company_type_status_name_text').val('');
						$('#spansubcat').css('display','none');
						$('#btnsubadd').css('display','none');
						$('#btnsubsave').css('display','inline-block');
						$('#btnsubcancel').css('display','inline-block');
					});
					
					$('#btnsubcancel').live('click', function(){
						$('#spansubcattext').css('display','none');
						$('#spansubcat').css('display','inline-block');
						$('#hidcts').val('company_type_status_name');
						$('#btnsubadd').css('display','inline-block');
						$('#btnsubsave').css('display','none');
						$('#btnsubcancel').css('display','none');
					});
					
					$('#btnsubsave').live('click', function(){
					
						var url=baseUrlAdmin+'ajax_add_company_type_status/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'ctsn='+$('#company_type_status_name_text').val(),
							dataType: "html",
							success: function(data){
								$('#company_type_status_name').html(data);
							}
						});
						
						$('#spansubcattext').css('display','none');
						$('#spansubcat').css('display','inline-block');
						$('#hidcts').val('company_type_status_name');
						$('#btnsubadd').css('display','inline-block');
						$('#btnsubsave').css('display','none');
						$('#btnsubcancel').css('display','none');
					});
					
					
					/* ----------------------- */
					
					$('#btnsubedit').live('click', function(){
						$('#spansubcattext').css('display','inline-block');
						$('#spansubcattext').find('input[type="text"]').val($('#sub_category_id option:selected').text());
						$('#hidcts').val('sub_category_name_text');
						$('#spansubcat').css('display','none');
						$('#btnsubedit').css('display','none');
						$('#btnsubupdate').css('display','inline-block');
						$('#btnsubeditcancel').css('display','inline-block');
					});
					
					$('#btnsubeditcancel').live('click', function(){
						$('#spansubcattext').css('display','none');
						$('#spansubcat').css('display','inline-block');
						$('#hidcts').val('sub_category_id');
						$('#btnsubedit').css('display','inline-block');
						$('#btnsubupdate').css('display','none');
						$('#btnsubeditcancel').css('display','none');
					});
					
					$('#btnsubupdate').live('click', function(){
					
						var url=baseUrlAdmin+'ajax_edit_sub_category/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'sub_category_name='+$('#sub_category_name_text').val()+'&category_id='+$('#category_id').val()+'&sub_category_id='+$('#sub_category_id').val(),
							dataType: "html",
							success: function(data){
								var selected2 = $('#sub_category_id option:selected').val();
								$('#sub_category_id').html(data);
								$("#sub_category_id option[value='"+selected2+"']").attr("selected", "selected");
							}
						});
						
						$('#spansubcattext').css('display','none');
						$('#spansubcat').css('display','inline-block');
						$('#hidcts').val('sub_category_id');
						$('#btnsubedit').css('display','inline-block');
						$('#btnsubupdate').css('display','none');
						$('#btnsubeditcancel').css('display','none');
					});
					/* ---------------------- */
					
				</script>