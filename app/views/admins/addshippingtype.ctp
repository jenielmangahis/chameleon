<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'shippingtype';
?>

<div class="titlCont1"><div style="width:960px;  margin:0 auto">
<?php echo $form->create("Admins", array("action" => "addshippingtype",'name' => 'addshippingtype', 'id' => "addshippingtype",'onsubmit' => 'return validateshippingtype("add");'))?>
       <div align="center" id="toppanel" >
        <?php  //echo $this->renderElement('new_slider');  ?>
</div>
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important;">			
<?php
e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));

?>			
</div>
  <span class="titlTxt">Add Shipping Type </span>
        <div class="topTabs">
                <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><a href="<?php echo $backUrl;?>"><span>Cancel</span></a></li>
                </ul>
        </div> </div>
</div><div style="width: 960px; height:300px; margin: 0pt auto;" id="addship">
<div id="center-column">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

		<div class="table">
		

		
		<table width="450px" height="230px" align="left" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
								   echo $form->error('ShippingType.shipping_type_name', array('class' => 'errormsg'));
								  echo $form->error('ShippingType.shipdays', array('class' => 'errormsg'));
						
						?></td>
		</tr>
		<tr><td align="right"><label class="boldlabel">Shipping Type <span class="red">*</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("ShippingType.shipping_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
	        </tr>
	        
	        <tr><td align="right"><label class="boldlabel">Shipping shipdays <span class="red">*</span></label></span></td>
				<td><span class="intpSpan"><?php echo $form->input("ShippingType.shipdays", array('id' => 'shipdays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3"));?></span></td>
	        </tr>
	        
	        <tr><td valign='top' align="right"><label class="boldlabel">Note </label>&nbsp;&nbsp;</td>
				<td><span class="txtArea_top">
			  <span class="newtxtArea_bot"><?php echo $form->textarea("ShippingType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "multilist"));?></span></span></td>
	       </tr>

		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2">&nbsp;  	</td></tr> <tr><td colspan="2">&nbsp;  	</td></tr> <tr><td colspan="2">&nbsp;  	</td></tr>
		
	<tr><td colspan="2">   <div class="top-bar" style="text-align: left; padding: 5px 0px 0px 5px; ">
                                  <?php  echo $this->renderElement('bottom_message');  ?>     

                            </div>		</td></tr>
		
	    </table>

<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

	    	
			</div></div>
 
</div><!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addship").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
