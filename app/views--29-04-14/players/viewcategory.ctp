<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/types/category';
?> 

<div class="titlCont">
<div class="centerPage">
<div align="center" id="toppanel" >
	 <?php  echo $this->renderElement('new_slider');  ?>
</div>
            <span class="titlTxt1"><?php echo $project_name ;?>:&nbsp;</span>
<span class="titlTxt"> View  Category Detail</span>
<?php echo $form->create("admins", array("action" => "addcategories",'name' => 'addcategories', 'type' => 'file','enctype'=>'multipart/form-data', 'id' => "addcategories"))?>
<?php  echo $form->hidden("CategoryDetail.id", array('id' => 'categoryid'));?>
<div class="topTabs">
	<ul>
	<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
	</ul>
</div>

 <div class="clear"></div>
            
	         <?php    $this->loginarea="players";    $this->subtabsel= 'category';
                            echo $this->renderElement('players/player_type_submenus');  ?>   

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

<tr>
		<td width="15%"  align="right"><label class="boldlabel">Category Name <span style="color: red;">*</span></label></td>
			<td width="85%">
				<span class="txtArea_top" id="spancat"><span class="txtArea_bot"><span id="compdiv">
				
				<?php echo $form->select("CategoryDetail.category_id", $categorydropdown, $selectedcategory, array('id' => 'category_id','class'=>'multilist', 'disabled'=>'disabled'),"---Select---");?>
				</span></span></span>
	
			</td>
		</tr>    
		
	  
	<tr><td colspan="2">&nbsp;</td></tr> 
    
	<tr>
		<td width="15%"  align="right"><label class="boldlabel">Sub-Category Name </label></td>
			<td width="85%">
				<span class="txtArea_top" id="spansubcat"><span class="txtArea_bot"><span id="compdiv">
				<?php echo $form->select("CategoryDetail.sub_category_id", $subcategorydropdown, $selectedsubcategory, array('id' => 'sub_category_id','class'=>'multilist', 'disabled'=>'disabled'),"---Select---");?>
				</span></span></span>
			
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