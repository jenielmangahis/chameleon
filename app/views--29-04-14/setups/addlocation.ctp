<!-- Body Panel starts -->
<?php $baseUrl = Configure::read('App.base_url'); 
$backUrl =$baseUrl.'setups/locationlist';
?>
<div class="titlCont">
<div class="myclass">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">
<?php 

	echo $form->create("setups", array("action" => "addlocation",'name' => 'addlocation', 'id' => "addlocation",'onsubmit'=>'return validatelocation();'));
	echo $form->hidden("Location.id");
	?>
	<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
 <?php  echo $this->renderElement('new_slider');  ?>	
</div>
	
<span class="titlTxt">Locations</span>
<div class="topTabs" style="height:25px;">
<?php /*?><ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
</ul><?php */?>
</div>

 <?php    $this->loginarea="setups";    $this->subtabsel="locationlist";
                    echo $this->renderElement('setup_submenus');  ?> 

</div></div>
<div class="centerPage" id="newsetttab">
<div class="">	
	
<!--Settings-->
<div id="Setting">
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar">
    
   </div>

   <table cellspacing="10" cellpadding="0" align="center" style="float:left; width:424px;">
	  
	   <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Location Name<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.location_name',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Addresss1<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.address1',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Addresss2<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.address2',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>

	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Country<span style="color: red;">*</span></label></td>
			<td width="70%">
			<span class="txtArea_top"><span class="txtArea_bot">
					<?php echo $form->select("Location.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;','onchange'=>'return getstateoptions(this.value,"Event")'),array('254'=>'United States')); ?>
					<?php echo $form->error('Location.country', array('class' => 'errormsg')); ?> 
			</span>
			</td>
	  </tr>

	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">State<span style="color: red;">*</span></label></td>
			<td width="70%">
			<span class="txtArea_top"><span class="txtArea_bot">
							<span id="statediv"><?php echo $form->select("Location.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;'),"---Select---"); ?></span> </span>
			</td>
	  </tr>
	  
	  
	    <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Zipcode<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.zipcode',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">City<span style="color: red;">*</span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.city',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  
	  </table>
	  <table cellspacing="10" cellpadding="0" align="center" style="float:left; width:514px;">
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Main Phone<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.phone',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	    <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Fax<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.fax',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	    <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Website<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.website',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Facebook Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.facebook',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Twitter Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.twitter',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Google+ Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.googleplus',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Linkedin Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.linkedin',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	  <tr>
		  <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Pinterest Page<span style="color: red;"></span></label></td>
			  <td width="70%"><span class="intpSpan"><?php echo $form->input('Location.pinterest',array('class'=>'inpt_txt_fld','div'=>false,'label'=>false)); ?></span></td>
	  </tr>
	       
	  </table>

	
      
	</div>
<!--settings end-->
<p>&nbsp;</p>
	
		<?php echo $form->end();?>
</div></div> </div>
 
<!--inner-container ends here-->

<div></div>
  
<div class="clear"></div>

  <!-- Body Panel ends --> 
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newsetttab").style.paddingTop = '24px';
	else
		document.getElementById("blck").style.paddingTop = '10px';
</script>
