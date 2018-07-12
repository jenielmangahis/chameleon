<?php  $base_url = Configure::read('App.base_url');	$backUrl = $base_url.'offers/category'; ?>
<div class="titlCont1">
<div class="centerPage">
<div align="center" id="toppanel" >
	 <?php  echo $this->renderElement('new_slider');  ?>
</div>

<?php echo $form->create("admins", array("action" => "addcategories",'name' => 'addcategories', 'type' => 'file','enctype'=>'multipart/form-data', 'id' => "addcategories","onsubmit"=>"return validatecategories('$act');"))?>
<?php  echo $form->hidden("CategoryDetail.id", array('id' => 'categoryid'));?>
<div class="topTabs">
	<ul>
	<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
	</ul>
</div>
</div>

</div><!--rightpanel ends here-->

                            <!--inner-container starts here-->
<div id="addcnt" >    
	<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

<div class="">	
	 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message');  } ?>
	 
<table cellspacing="5" cellpadding="0" align="left" width="815px" style="margin-left: 50px;">
  <tbody>
    <?php if($session->check('Message.flash')){ ?>	
    <tr>
      <td colspan="5"><?php      $session->flash(); 
      				 echo $form->error('CategoryDetail.category_id', array('class' => 'msgTXt')); 
      				 echo $form->error('CategoryDetail.description', array('class' => 'msgTXt'));
					 echo $form->error('CategoryDetail.square_graphic', array('class' => 'msgTXt'));      
					 echo $form->error('CategoryDetail.wide_graphic', array('class' => 'msgTXt'));      
					 echo $form->error('CategoryDetail.tall_graphic', array('class' => 'msgTXt'));            				
      	?>	
      </td>
    </tr>
    <?php }?>	
<tr>
		<td width="15%"  align="right"><label class="boldlabel">Category Name <span style="color: red;">*</span></label></td>
			<td width="85%">
				<span class="txtArea_top" id="spancat"><span class="txtArea_bot"><span id="compdiv">
				
				<?php echo $form->select("CategoryDetail.category_id", $categorydropdown, $selectedcategory, array('id' => 'category_id','class'=>'multilist'),"---Select---");?>
				</span></span></span>
			<span class="intpSpan" id="spancattext" style="display:none" ><?php echo $form->input("Category.category_name_text", array('id' => 'category_name_text', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span>
				<input type="hidden" id="hidcatname" name="hidcatname" value="category_id" />
			</td>
		</tr>    
		
		<tr>
			<td width="15%"  align="right"></td>
			<td width="85%">&nbsp;&nbsp;
			 <?php if(isset($this->data['CategoryDetail']['id'])){ ?>
			<!-- <button type="button" value="add" class="button" id="btnedit"  >
				<span>Edit</span>
			</button>
			<button type="button" value="save" class="button"  id="btnupdate" style="display:none">
				<span>Update</span>
			</button>
			<button type="button" value="cancel" class="button"  id="btneditcancel"  style="display:none">
				<span>Cancel</span>
			</button> -->
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
		<td width="15%"  align="right"><label class="boldlabel">Sub-Category Name </label></td>
			<td width="85%">
				<span class="txtArea_top" id="spansubcat"><span class="txtArea_bot"><span id="compdiv">
				<?php echo $form->select("CategoryDetail.sub_category_id", $subcategorydropdown, $selectedsubcategory, array('id' => 'sub_category_id','class'=>'multilist'),"---Select---");?>
				</span></span></span>
			<span class="intpSpan" id="spansubcattext" style="display:none" ><?php echo $form->input("Category.sub_category_name_text", array('id' => 'sub_category_name_text', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span>
				<input type="hidden" id="hidsubcatname" name="hidsubcatname"  value="sub_category_id" />
			</td>
		</tr>    
		
		<tr>
			<td width="15%"  align="right">
				<script type="text/javascript">
				
					$(function(){
						/*var url=baseUrlAdmin+'ajax_add_sub_category/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'category_id='+$('#category_id').val(),
							dataType: "html",
							success: function(data){
								$('#sub_category_id').html(data);
							}
						});*/
					});
				
					$('#category_id').live('change', function(){
						var url=baseUrlAdmin+'ajax_add_sub_category/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'category_id='+$(this).val(),
							dataType: "html",
							success: function(data){
								$('#sub_category_id').html(data);
							}
						});
					});
					
					$('#btnadd').live('click', function(){
						$('#spancattext').css('display','table-cell');
						$('#hidcatname').val('category_name_text');
						$('#spancat').css('display','none');
						$('#btnadd').css('display','none');
						$('#btnsave').css('display','inline-block');
						$('#btncancel').css('display','inline-block');
					});
					
					$('#btncancel').live('click', function(){
						$('#spancattext').css('display','none');
						$('#spancat').css('display','table-cell');
						$('#hidcatname').val('category_id');
						$('#btnadd').css('display','inline-block');
						$('#btnsave').css('display','none');
						$('#btncancel').css('display','none');
					});
					
					$('#btnsave').live('click', function(){
					
						var url=baseUrlAdmin+'ajax_add_category/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'category_name='+$('#category_name_text').val(),
							dataType: "html",
							success: function(data){
								$('#category_id').html(data);
							}
						});
						
						$('#spancattext').css('display','none');
						$('#spancat').css('display','table-cell');
						$('#hidcatname').val('category_id');
						$('#btnadd').css('display','inline-block');
						$('#btnsave').css('display','none');
						$('#btncancel').css('display','none');
					});
				
					/* --------------------------- */
					$('#btnedit').live('click', function(){
						$('#spancattext').css('display','table-cell');
						$('#spancattext').find('input[type="text"]').val($('#category_id option:selected').text());
						$('#hidcatname').val('category_name_text');
						$('#spancat').css('display','none');
						$('#btnedit').css('display','none');
						$('#btnupdate').css('display','inline-block');
						$('#btneditcancel').css('display','inline-block');
					});
					
					$('#btneditcancel').live('click', function(){
						$('#spancattext').css('display','none');
						$('#spancat').css('display','table-cell');
						$('#hidcatname').val('category_id');
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
						$('#spancat').css('display','table-cell');
						$('#hidcatname').val('category_id');
						$('#btnedit').css('display','inline-block');
						$('#btnupdate').css('display','none');
						$('#btneditcancel').css('display','none');
					});
					
					/* ---------------------*/
					
				
					$('#btnsubadd').live('click', function(){
						$('#spansubcattext').css('display','table-cell');
						$('#hidsubcatname').val('sub_category_name_text');
						$('#spansubcat').css('display','none');
						$('#btnsubadd').css('display','none');
						$('#btnsubsave').css('display','inline-block');
						$('#btnsubcancel').css('display','inline-block');
					});
					
					$('#btnsubcancel').live('click', function(){
						$('#spansubcattext').css('display','none');
						$('#spansubcat').css('display','table-cell');
						$('#hidsubcatname').val('sub_category_id');
						$('#btnsubadd').css('display','inline-block');
						$('#btnsubsave').css('display','none');
						$('#btnsubcancel').css('display','none');
					});
					
					$('#btnsubsave').live('click', function(){
					
						var url=baseUrlAdmin+'ajax_add_sub_category/';
						$.ajax({
							type: 'GET',
							url: url,
							data: 'sub_category_name='+$('#sub_category_name_text').val()+'&category_id='+$('#category_id').val(),
							dataType: "html",
							success: function(data){
								$('#sub_category_id').html(data);
							}
						});
						
						$('#spansubcattext').css('display','none');
						$('#spansubcat').css('display','table-cell');
						$('#hidsubcatname').val('sub_category_id');
						$('#btnsubadd').css('display','inline-block');
						$('#btnsubsave').css('display','none');
						$('#btnsubcancel').css('display','none');
					});
					
					
					/* ----------------------- */
					
					$('#btnsubedit').live('click', function(){
						$('#spansubcattext').css('display','table-cell');
						$('#spansubcattext').find('input[type="text"]').val($('#sub_category_id option:selected').text());
						$('#hidsubcatname').val('sub_category_name_text');
						$('#spansubcat').css('display','none');
						$('#btnsubedit').css('display','none');
						$('#btnsubupdate').css('display','inline-block');
						$('#btnsubeditcancel').css('display','inline-block');
					});
					
					$('#btnsubeditcancel').live('click', function(){
						$('#spansubcattext').css('display','none');
						$('#spansubcat').css('display','table-cell');
						$('#hidsubcatname').val('sub_category_id');
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
						$('#spansubcat').css('display','table-cell');
						$('#hidsubcatname').val('sub_category_id');
						$('#btnsubedit').css('display','inline-block');
						$('#btnsubupdate').css('display','none');
						$('#btnsubeditcancel').css('display','none');
					});
					/* ---------------------- */
					
				</script>
			</td>
			<td width="85%">&nbsp;&nbsp;
			
				 <?php if(isset($this->data['CategoryDetail']['id'])){ ?>
						<!-- 					<button type="button" value="add" class="button" id="btnsubedit"  >
				<span>Edit</span>
				</button>
				<button type="button" value="save" class="button"  id="btnsubupdate" style="display:none">
					<span>Update</span>
				</button>
				<button type="button" value="cancel" class="button"  id="btnsubeditcancel"  style="display:none">
					<span>Cancel</span>
				</button>  -->				
				
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
	
<tr>
		<td width="15% " align="right" ><label class="boldlabel">Description <span style="color: red;">*</span></label></td>
			<td width="85%">&nbsp;&nbsp;&nbsp;			
				  <span class="txtArea_top"><span class="txtArea_bot"><?php echo $form->textarea("CategoryDetail.description", array('id' => 'description', 'div' => false, 'label' => '','cols' => '36', 'rows' => '4',"class" => "noBg"));?></span></span>
		</td>
		</tr>    
    
	<tr><td colspan="2">&nbsp;</td></tr>
	
	<tr>
				 
				  <td valign='top' align="right"><label class="boldlabel">Square Graphic</label></td>
				  <td>
				  &nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $form->file('CategoryDetail.square_graphic',array('id'=> 'square_graphic',"class" => "contactInput"));?><br>
				  &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Used for 210X210 formats of image formatted appropriately.</span>
				   <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				   <?php 
				   if(isset($this->data['CategoryDetail']['square_graphic']) && $this->data['CategoryDetail']['square_graphic'] !='')
					echo $html->image('categories/square/'.$this->data['CategoryDetail']['square_graphic'],array('width'=>'210','height'=>'210','alt'=>''));
				   else
					echo $html->image('categories/square/210X210.png');
				   ?> 
				   </td>
				 
				 </tr>
		       
			   
	
	<tr>
				 
				  <td valign='top' align="right"><label class="boldlabel">Wide Graphic</label></td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $form->file('CategoryDetail.wide_graphic',array('id'=> 'wide_graphic',"class" => "contactInput"));?><br>
				  &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Used for 350X210 formats of image formatted appropriately.</span>
				   <br />&nbsp;&nbsp;&nbsp;&nbsp;
				   <?php 
				   if(isset($this->data['CategoryDetail']['wide_graphic']) && $this->data['CategoryDetail']['wide_graphic'] !='')
					echo $html->image('categories/wide/'.$this->data['CategoryDetail']['wide_graphic'],array('width'=>'350','height'=>'210','alt'=>''));
				   else{
				  	echo $html->image('categories/wide/350X220.png'); 
				 
				   }
				   ?> 
				   </td>
				 
				 </tr>
		       
			   
			   <tr>
				 
				  <td valign='top' align="right"><label class="boldlabel">Tall Graphic</label></td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $form->file('CategoryDetail.tall_graphic',array('id'=> 'tall_graphic',"class" => "contactInput"));?><br>
				 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Used for 210X350 formats of image formatted appropriately.</span>
				   <br />&nbsp;&nbsp;&nbsp;&nbsp;
				   <?php 
				   if(isset($this->data['CategoryDetail']['tall_graphic']) && $this->data['CategoryDetail']['tall_graphic'] !='')
					echo $html->image('categories/tall/'.$this->data['CategoryDetail']['tall_graphic'],array('width'=>'210','height'=>'350','alt'=>''));
				   else
					echo $html->image('categories/tall/210X336.png');
				   ?> 
				   </td>
				 
				 </tr>
		       
	
	
     <tr>
        <td width="40%" >   

    <div class="top-bar" style="margin-bottom: 10px; text-align: left; padding: 20px 5px 5px 60px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div>
       </td>
    </tr>
  </tbody>
</table>

					
					<!-- ADD Sub Admin  FORM EOF -->

			

 
<!--inner-container ends here-->

<?php echo $form->end();?>

		
<br>

  </div></div></div></div>
<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcnt").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
