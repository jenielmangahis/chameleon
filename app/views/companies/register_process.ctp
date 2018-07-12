
<div class="boxBg1">
  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
  
 <?php if($process_type=="reg_done") {
     
 ?>
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Register Comfirmed</font><br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
&nbsp;&nbsp;&nbsp;Your account has been created, please click the Login menu item above to login. <br /><br />
  <?php  }else if($process_type=="reg_email") {
     
 ?>
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Register Comfirmation</font><br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
<strong>Almost there... you will be receiving an e-mail shortly, to complete  your Registration process you will need to open this e-mail and click the activate link to activate your account. Thank you and welcome to our community!</strong> <br /><br />
  <?php  }else if($process_type=="coin_req") {
     
 ?>
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Coin Registration Required</font><br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
&nbsp;&nbsp;&nbsp;You must register a coin to cointinue. <br /><br />
  <?php  }else if($process_type=="coin_reg") {
     
 ?>
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Coin Register Comfirmation</font><br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
&nbsp;&nbsp;&nbsp; Your account has been created.Thanks for registering coin. <br /><br />
  <?php  }else if($process_type=="reg_email_coin") {
     
 ?>
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Register Comfirmation</font><br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
<strong> Almost there... you will be receiving an e-mail shortly, to complete  your Registration process you will need to open this e-mail and click the activate link to activate your account. Thank you for registering coin and welcome to our community!</strong> <br /><br />
  <?php  } 
  else{ ?>
         &nbsp;&nbsp;&nbsp;<font size="+2" color="black">Registration Process</font><br /><br /><br />
    
<!--<b>Any item with a</b>"<span class="red">*</span><b>requires an entry.</b>  -->
&nbsp;&nbsp;&nbsp; There might be some problem. Please try again. <br /><br />
  <?php      
  } ?>
    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
  
  </div>
