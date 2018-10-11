<!-- Body Panel starts -->
<?php $baseUrl = Configure::read('App.base_url'); 
$backUrl =$baseUrl.'setups/locationlist';
?>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
        	<h2>Locations</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
				<?php 
                
                echo $form->create("setups", array("action" => "addlocation",'name' => 'addlocation', 'id' => "addlocation",'onsubmit'=>'return validatelocation();'));
                echo $form->hidden("Location.id");
                ?>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
        </div>
    </div>
</div>



<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		 <?php    $this->loginarea="setups";    $this->subtabsel="locationlist";
                    echo $this->renderElement('setup_submenus');  ?> 
    </div>
</div>


<div class="midCont" id="newsetttab">
<div class="clearfix">	
	
<!--Settings-->
<div id="Setting">
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

	<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar"></div>

    <div class="frmbox">
        <table cellspacing="10" cellpadding="0" align="center" width="90%">
      
       <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Location Name<span style="color: red;">*</span></label></td>
              <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.location_name',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
      </tr>
      
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Addresss1<span style="color: red;">*</span></label></td>
              <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.address1',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
      </tr>
      
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Addresss2<span style="color: red;"></span></label></td>
              <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.address2',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
      </tr>
    
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Country<span style="color: red;">*</span></label></td>
            <td width="70%">
            <span class="txtArea-top"><span class="txtArea-bot">
                    <?php echo $form->select("Location.country",$countrydropdown,$selectedcountry,array('id' => 'country','style'=>' margin-bottom: 6px; width:100%;','class'=>'form-control','onchange'=>'return getstateoptions(this.value,"Event")'),array('254'=>'United States')); ?>
                    <?php echo $form->error('Location.country', array('class' => 'errormsg')); ?> 
            </span>
            </td>
      </tr>
    
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">State<span style="color: red;">*</span></label></td>
            <td width="70%">
            <span class="txtArea-top"><span class="txtArea-bot">
                            <span id="statediv"><?php echo $form->select("Location.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'form-control','style'=>' margin-bottom: 6px; width:100%;'),"---Select---"); ?></span> </span>
            </td>
      </tr>
      
      
        <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Zipcode<span style="color: red;">*</span></label></td>
              <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.zipcode',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
      </tr>
      
      <tr>
          <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">City<span style="color: red;">*</span></label></td>
              <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.city',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
      </tr>
      
      
      </table>	
    </div>
    
      
    <div class="frmbox">
        <table cellspacing="10" cellpadding="0" align="center" width="90%">
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Main Phone<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.phone',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
    
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Fax<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.fax',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
    
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Website<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.website',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
    
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Facebook Page<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.facebook',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
    
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Twitter Page<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.twitter',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Google+ Page<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.googleplus',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Linkedin Page<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.linkedin',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
    <tr>
      <td width="30%" class="lbltxtarea" align="right"><label class="boldlabel">Pinterest Page<span style="color: red;"></span></label></td>
          <td width="70%"><span class="intp-Span"><?php echo $form->input('Location.pinterest',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false)); ?></span></td>
    </tr>
       
    </table>
    </div>  

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
