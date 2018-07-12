<?php $lgrt = $session->read('newsortingby');?>
<?php
    //echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
    echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
    echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');
?>
<?php
echo $html->css('general.css');
echo $javascript->link(array('coin_serial.js', 'popup.js'));
?>
	<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
	<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">	
	<script type="text/javascript">
	 /* <![CDATA[ */
		$(function() {
				  $('#datesubmitchipcoBP').datetime({
									  userLang : 'en',
									  americanMode: false, 
								});	
				//  $( '#datesubmitchipcoBP ).datepicker({ yearRange: '2000:2010' });
							
			});
	  /* ]]> */

	
		
	</script>

  <div class="titlCont1">
		<div style="width:960px; margin:0 auto;">
			      <?php echo $form->create("Admin", array("action" => "addcoinset",'type' => 'file','name' => 'addcoinset', 'id' => "addcoinset",'onsubmit'=>'return validatecoinset("add")'))?>
			<div align="center" id="toppanel" >
					    <?php  echo $this->renderElement('new_slider');  ?>
			</div>
					
					<span class="titlTxt">
	                                    <strong><?php echo $data['Project']['project_name'];?>:&nbsp;</strong>Add Coinset
					    </span>
					    <div class="topTabs">
					    <ul>
						<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
						<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
						<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/<?php echo $lgrt;?>')"><span> Cancel</span></button></li>
					    </ul>
					  </div>

		  </div>
    </div>

</div><!--rightpanel ends here-->

                            <!--inner-container starts here-->


<div style="width:960px; margin:0 auto;" id="addcoinssets">
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<!--<div class="">

<div class="">-->
	
		<div class="top-bar" style="border-left:0px;">
	
	
		</div>
		
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

<!--<div class="">	-->
<div style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar"> </div>
 <div style="float: right;">
<table width="425px" class="left" cellspacing="5" style="margin-top:-5px;">
	      <tbody>
		<tr>
		    <td width="30%" valign="top" align="right" class="lbltxtarea"><label class="boldlabel">Side A Image </label></td>
		    <td width="70%">
				    <input type="file" value="" class="inpt_txt_fld" id="sidea" name="data[Coinset][coinsidea]"><br>
				    <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
				    <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>
				    <!--<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Click over the image for Original view.</span>-->
				  	&nbsp;
			  </td>		
	     </tr>	
	     <tr>
		<td valign="top" align="right" class="lbltxtarea"><label class="boldlabel">Side B Image </label></td>
				<td><input type="file" value="" class="inpt_txt_fld" id="sideb" name="data[Coinset][coinsideb]"><br>
					<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
					<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>	
					<!--<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Click over the image for Original view.</span>-->
					&nbsp;
					 <?php if(!empty($this->data['Coinset']['sideb'])){?> 
					 <span id="divimagecoina" >
					
				    <div align="left"><img src="<?php echo "/img/".$project['Project']['project_name']."/uploads/". $this->data['Coinset']['sideb'] ;?>"></div> 
				    </span>

					<?php }else{ ?>
				   
		  </td>			<?php } ?>
	    </tr>
	    <tr>
				<td valign="top" align="right"  class="lbltxtarea"><label class="boldlabel">Edge Image </label></td>
					<td valign="top"><input type="file" value="" class="inpt_txt_fld" id="coinedge" name="data[Coinset][coinedge]"><br>
					<span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 300x12.</span>
					<br>&nbsp; </td> 
	    </tr>
	    <tr>
				<td valign="" align="right" class="lbltxtarea"><label class="boldlabel">Serial # on Side </label></td>
					<td><span style="width: 0px;" class="txtArea_top">
					<span class="txtArea_bot"><select style="width: 200px; border: 1px solid rgb(190, 218, 229);" id="serialdisplayside" label="" name="data[Coinset][serialdisplayside]">
<option value="A">Side A</option>
<option value="B">Side B</option>
</select></span></span></td>
	
	    </tr>

    </tbody></table>
</div>
<div class="frmbox mgrt115">
<table cellspacing="0" cellpadding="0" align="center" align="center" width="500px" class="left">
  <tbody>
    <?php echo $form->hidden("shippingvalue", array('id' => 'shippingvalue'));
			   echo $form->hidden("projecttypevalue", array('id' => 'projecttypevalue'));
			   if($selectedprojecttype){
				echo "<script>getprojecttypedays('$selectedprojecttype'); </script>";
			}   
    ?>

	<tr>
		     <td width="30%" align="right" class="lbltxtarea"><label class="boldlabel">Coinset Name </label></td>
                           <td width="70%" style="padding-bottom:12px;">
				<span class="intpSpan"><?php echo $form->input("Coinset.coinset_name", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$coinsetname,'readonly'=>'readonly'));?></span></td>
		      
	  </tr>
	<!--<tr>
		     <td width="15%"><label class="boldlabel">Serial # Prefix<span style="color: red;">*</span></label></td>
                            <td width="85%">
				<?php //echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  ?>
				<span class="intpSpan"><?php //echo $form->input("Coinset.serialprefix", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
			  
	</tr>
	--><tr>
		     <td align="right" class="lbltxtarea"><label class="boldlabel">Verification Code </label></td>
                            <td style=" padding-bottom: 12px;">
				<span class="intpSpan"><?php echo $form->input("Coinset.verifycode", array('id' => 'verifycode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "7"));?></span></td>
	</tr>


	


		<tr>
		     <td width="40%" align="right" class="lbltxtarea"><label class="boldlabel">Custom Prefix </label></td>
                           <td width="70%" style=" padding-bottom: 12px;">
				<span class="intpSpan"><?php echo $form->input("Coinset.serialprefix", array('id' => 'serialprefix', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3"));?></span></td>
		      
	  </tr>

	<!--<tr>
		     <td width="15%"><label class="boldlabel">Project Type <span style="color: red;">*</span></label></td>
                            <td width="85%">
				<?php //echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  ?>
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php// echo $form->select("project_type_id",$projectypedropdown,$selectedprojecttype,array('id' => 'project_type_id','class'=>'multilist'/*,'disabled'=>'disabled'*/),"---Select---");//pr($selectedprojecttype);  ?>
				</span>
				</span></td>
		    </tr>-->

	<tr>
		     <td align="right" class="lbltxtarea"><label class="boldlabel"># of Units <span style="color: red;">*</span></label></td>
                            <td  style=" padding-bottom: 12px;">
				
				<span class="intpSpan"><?php echo $form->input("Coinset.numunits", array('id' => 'units', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "7",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();'));?></span></td>
		    </tr>

	
	<tr>
		  <td align="right" class="lbltxtarea"><label class="boldlabel">Serial # Start <span style="color: red;">*</span></label></td>
		<?php if($totalreccount > 1){ ?>
                            <td style="padding-bottom: 12px;" ></span><span class="intpSpan"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>"$lastserno",'readonly'=>'readonly'));?></span></td>

   		 <?php }else{ ?>
			 <td style="padding-bottom: 12px;" ><span class="intpSpan"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>"$lastserno",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();'));?></span></td>
		<?php } ?>
		</tr>

	<tr>
		     <td align="right"class="lbltxtarea"><label class="boldlabel">Serial # End <span style="color: red;">*</span></label></td>
                             <td style="padding-bottom: 12px;" ><span class="intpSpan"><?php echo $form->input("Coinset.endserialnum", array('id' => 'ending', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>"$lastserno",'readonly'=>'readonly'));?></span></td>
		    </tr>
    
   	<tr>
		      <td align="right" class="lbltxtarea"><label class="boldlabel">Order Date <span style="color: red;">*</span></label></td>
                            <td  style=" padding-bottom: 12px;">
				<span class="intpSpan middle"><?php echo $form->text("Coinset.datesubmitchipco", array('id' => 'datesubmitchipco', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span>&nbsp; <input type="button" class="calendarcls" id="datesubmitchipcoBP"></td>
		    </tr>
    
	<tr>
		    <td align="right" class="lbltxtarea"><label class="boldlabel">Shipping Type <span style="color: red;">*</span></label></td>
                            <td style=" padding-bottom: 2px;">
				<span class="txtArea_top">
					<span class="txtArea_bot">
					<?php echo $form->select("Coinset.ship_type_id",$shippingdropdown,$selectedshippingtype,array('id' => 'ship_type_id','class'=>'multilist',"onchange"=>"getshippingdays(this.value);"),"---Select---"); ?>
				</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				
				
		    </tr>
    
      <tr>
		     <td  align="right"class="lbltxtarea"><label class="boldlabel">Est Ship Date </label></td>
                            <td style=" padding-bottom: 12px;">
				<span class="intpSpan"><?php echo $form->text("Coinset.dateestship", array('id' => 'dateestship', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span><br>
      <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">&nbsp;Auto calculated</span></td>
		    </tr>
	
    <tr>
		     <td align="right" class="lbltxtarea"><label class="boldlabel">Est Deliver Date </label></td>
                            <td  style=" padding-bottom: 12px;">
				<span class="intpSpan"><?php echo $form->text("Coinset.dateestdelivery", array('id' => 'dateestdelivery', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span><br>
      <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">&nbsp;Auto calculated</span></td>
		    </tr>
    
     
   
  </tbody>
</table>
</div>
<div class="clear"></div> 

		
<div class="top-bar" style="margin-bottom: 10px; text-align: left; padding: 20px 5px 5px 60px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div>			
					<!-- ADD Sub Admin  FORM EOF -->

			</div></div></div></div>

 
<!--inner-container ends here-->

<?php echo $form->end();?>

  
<div class="clear"></div>



<div id="popupContact">
<div style="font-size: 1.4em;margin-left:80px">Are you Sure you dont want to offer the verification code ?</div>

<div style="margin-top: 40px;margin-left:80px">
<button class="btn" onclick="noact();">yes</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button class="btn" onclick="yesact();">no</button>
</div>
</div>
	<div id="backgroundPopup"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcoinssets").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
