<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
?>
<div class="container clearfix">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
			   <?php  //echo $this->renderElement('project_name');  ?>
                <h2>Change Password</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php $this->changePassword="tabSelt";
					echo $form->create("Admins", array("action" => "admin_changePassword",'name' => 'adduser', 'id' => "adduser", 'class' => 'adduser', 'enctype' => "multipart/form-data",'onsubmit' => 'return validatepassword();'))?>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>projectdashboard')"><?php e($html->image('cancle.png')); ?></button>					
                    <?php  echo $this->renderElement('new_slider');  ?>
                </div>
                	
            </div>
            <div class="topTabs" style="height:25px;">
</div>
        </div>
    
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="admins";    $this->subtabsel="change_password";
			echo $this->renderElement('setup_submenus');  ?> 
    </div>
</div> 

 <!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">
  <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p>-->
  <div class="boxBor">
  <div class="boxPad">
  <?php //echo $this->element("leftmenubar");?>  


  <!--  <p>&nbsp;</p>-->
  </div>
  </div><!--<p class="boxBot1">
 <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  -->
  </div>
  </div>
  <div id="chpd">
  <div class="boxBg1">
  <!--<p class="boxTop1"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
  <div class="boxBor1">
  <div class="boxPad">
  <div class="">
		 
<!--<div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar">
    
   </div>
<div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">
    
   </div>-->

<!--<div class="midCont" style="width: 960px; height:300px; margin: 0pt auto; align:left;">--> 
<div class="midCont">   
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<div class="clear"></div>


<div style="height:300px;">
<div id="userslisttab" class="midCont">
<table width="70%" align='left'>
		
		
		<?php 
		/*    SERVER SIDE VALIDATION MESSAGES */
		
	
	   echo $form->error('Admin.Opassword', 'Old Password is required', array('class' => 'errormsg'));
	    
	   echo $form->error('Admin.password', 'New Password is required', array('class' => 'errormsg'));
	     
	  echo $form->error('Admin.Cpassword', 'Please confirm Password', array('class' => 'errormsg'));
	   
	
		if($session->check('Message.flash')){ $session->flash();}

		/*   END  SERVER SIDE VALIDATION MESSAGES */

		?>
		
		<tr> 
		<td align="right" width="22%" style="padding-bottom: 10px;"><label class="boldlabel">Old Password <span style="color: red;">*</span></label>		
		</td>
		<td>
            <span class="intp-Span"><?php echo $form->input("Admin.Opassword", array('id' => 'Opassword', 'div' => false, 'label' => '', 'type' => 'password', "class" => "inpt-txt-fld form-control",'onchange' => 'ajaxpwdcheck(this.value)')); ?>
			</td><td><span id="updatediv1"></span><div id="loadingdivimg" style="display:none">Loading..<img src="img/ajax-loader.gif"></div></td>
		</tr>	
		
	  	
		<tr> 
		<td align="right" style="padding-bottom: 10px;"><label class="boldlabel">New Password <span style="color: red;">*</span></label></td>
			<td><span class="intp-Span"><?php echo $form->input("Admin.password", array('id' => 'password', 'div' => false, 'label' => '','value' => '', 'type' => 'password', "class" => "inpt-txt-fld form-control")); ?>
			
			</td>
		</tr>	
		
		<tr> 
			<td align="right" style="padding-bottom: 10px;"><label class="boldlabel">Confirm Password <span style="color: red;">*</span></label></td>
			<td><span class="intp-Span"><?php echo $form->input("Admin.Cpassword", array('id' => 'Cpassword', 'div' => false, 'label' => '', 'type' => 'password', "class" => "inpt-txt-fld form-control")); ?>
			
			</td>
		</tr>	
				
		
	<tr> 
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>	
<tr>
<td width="110px">&nbsp;</td>
<td>

	</td></tr>
<tr><td colspan='5' style="border-left: 0px none; text-align: left; padding-top: 5px; " class="top-bar">
   </td></tr>
</table>
<div class="clear"></div>
<b> <span style="color: red;">*</span>  Required item </b>
  </div>
  </div>
  </div>
  </div>
  </div><!--<p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>-->
  
  </div>
  </div><?php echo $form->end();?>    

<br/><br/>
<div >
	
	</div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 

<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("changesuper").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>