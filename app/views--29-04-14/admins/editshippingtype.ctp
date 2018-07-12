<?php
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'shippingtype';
?>
<div class="titlCont1"><div style="width:960px;margin:0 auto">
<?php echo $form->create("Admins", array("action" => "editshippingtype",'name' => 'editshippingtype', 'id' => "editshippingtype",'onsubmit' => 'return validateshippingtype("edit");'))?>
       <div align="center" id="toppanel" >
 <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt">Edit Shipping Type </span>
        <div class="topTabs">
                <ul>
                <li><button type="submit" valuenote="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><a href="<?php echo $backUrl;?>"><span>Cancel</span></a></li>
                </ul>
        </div>   </div>
</div><div style="width: 960px; margin: 0pt auto;" id="newshp">
<div id="center-column">
<div class="table">


<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="" onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>
		
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

		
		<table width="450px" align="left" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
								echo $form->error('ShippingType.shipping_type_name', array('class' => 'errormsg'));
								echo $form->error('ShippingType.shipdays', array('class' => 'errormsg'));
							    echo $form->hidden("ShippingType.id", array('id' => 'typeid'));
						?></td>
		</tr>
		<tr><td  align="right"><label class="boldlabel">Shipping Type <span style="color:red">*</span></label></td>
				<td> <span class="intpSpan"><?php echo $form->input("ShippingType.shipping_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
	        </tr>
	        
	        <tr><td  align="right"><label class="boldlabel">Shipping shipdays <span style="color:red">*</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("ShippingType.shipdays", array('id' => 'shipdays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3"));?></span></td>
	        </tr>
	        
	        <tr><td valign='top' align="right"><label class="boldlabel">Note</label></td>
				<td>   <span class="txtArea_top">
<span class="newtxtArea_bot"> <?php echo $form->textarea("ShippingType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?></span></span></td>
	       </tr>
	       
	        
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF --> 

        <tr><td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?>	 </td></tr>
 
        <tr><td colspan="2">&nbsp;</td></tr>
		

	    </table>

<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

			</div></div>	


<div style="text-align: left; padding-top: 5px;" class="top-bar">
                         
                            </div>	

 
</div><!--inner-container ends here-->

  




<div class="clear"></div>



</div><!--container ends here-->
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newshp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
