 <!-- Body Panel starts -->
<?php
echo $html->css('general.css');
echo $javascript->link(array('coin_serial.js', 'popup.js'));
?>

<script type="text/javascript">
	var register = '<?php echo $registeruser;?>';

	var flagreq='<?php echo $project["ProjectType"]["coin_verification"];?>';
	if (register == 'register') {


		/*if (!confirm("Do You Have a Coin to Register?")) {

			if(flagreq!='1' && flagreq!='')
			{
				window.location = "companies/dashboard";
				console.log('test' + window.location);
			}
			else {
				console.log('test2' + window.location);
			}
			
		}*/
	}

</script>

<div class="boxBg">
		<!--   Arvind's code: starts  -->

		<div id="fb-root"></div>
		<!-- Arvind's code ends -->
	
	<div>
		
			<?php //if($status!='Verified') {  ?>
		<div class="coinBoxCenter">
		<!--<p class="coinBoxTop"><?php //echo $html->image('/img/'.$project_name.'/coinBox_RhtTop.gif', array('class'=>'right'));?></p>-->
		<p class="fortopCurv"><span></span></p>

			<div class="boxBor">
			<div class="blueBox_mid">
			
						<table><tr><td>
							<?php 
							if($project['Project']['serialdisplayside']=="A") $coindisplayside="sidea";
							if($project['Project']['serialdisplayside']=="B") $coindisplayside="sideb";
							if($coinsdetail['Coinset'][$coindisplayside]=="")
							echo $html->image('/img/'.$project_name.'/sideA.png', array('class'=>'','width'=>'107','height'=>'109'));
							else
							echo $html->image('/img/'.$project_name.'/uploads/'.$coinsdetail['Coinset'][$coindisplayside], array('class'=>'','width'=>'107','height'=>'109'));
							?>
						</td><td style="color:red;font-size:20px;valign:center">
						<?php echo $html->image('/img/'.$project_name.'/uploads/'.'/registerarrow.png', array('class'=>'','width'=>'','height'=>'')); ?>
						</td><td><p style="color:red;font-size:20px;font-weight: bolder;">Coin Serial #<?php if($project['Project']['coins_verificationshow']==1) { ?> & Verification Code <?php }?> </p></td></table>
			
			</div>
			</div>
<!--<p class="coinBoxBot"><?php //echo $html->image('/img/'.$project_name.'/coinBox_RhtBot.gif', array('class'=>'right'));?></p>-->
<p class="forbotCurv"><span></span></p>

		</div>





			<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
			<?php //}?>


				
				<div style="margin:0 auto;width:400px;display:block<?php //if($status=='Verified') echo "none"; else echo "block";?>" >
						<?php echo  $form->create('Coinset',array('url'=> array('controller' => 'companies', 'action' => 'coinregister'),'id'=>'SignupForm' ,'onsubmit' => 'return validateserial("add");'));?>
						<p>&nbsp;</p>
							<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
							<span><div ><lable class='lbl' style=" width: 115px; margin-left: -24px;">Coin Serial #:<span class="red">*</span></lable> <?php echo $form->input('coinserial',array('label'=>false,'id'=>'coinserial','div'=>false,'type'=>"text", 'size'=>'10','maxlength'=>'10' , 'class'=>'inptBox')) ?>
							</div> <div id="ajaxloader" style="display:none; margin-left: 100px;"><img src="../../img/ajaxloader.gif" /></div><span>
							<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
							
							<div id="verify" style="width:535px;display:none;">
							<lable class='lbl' style=" width: 115px; margin-left: -24px;">Verification Code:<span class="red">*</span></lable> <?php echo $form->input('code',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"code",'size'=>'40','maxlength'=>'3', 'class'=>'inptBox' )) ?>
							<label for="code"></label>
							<label for="code"></label>
							<div><lable style=" width: 115px; margin-left: -24px;" class="lbl">&nbsp;</lable><span style="color: LightSlateGray; font-size: 11px; font-style: italic;">(3 Character code under serial #)</span><p class="clear"><img width="1" height="15" src="/img/testproject/spacer.gif" alt=""></p></div>
							
							</div>
						
								<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
								
								<div id="butdiv" style="display:none">

								<lable style="width:91px; margin-right:5px;display:inline-block;">&nbsp;</lable> <?php echo $form->submit('Verify', array('div'=>false,"class"=>"btn",'style'=>"width:91px"));?>
								</div>
				
						<?php echo $form->end();?>
				</div><br/><br/><b style="margin-left:240px;"></b><span class="red">*</span><b>Required Field</b>	

			<div class="clear"></div>
	

 </div>

	 

<script language='javascript'>


	function showterms(){
 	
		var url = '/companies/show_terms/Terms';			
			jQuery.facebox({ ajax: url });
	}

</script>


<script src="/js/jquery.alerts.js" type="text/javascript"></script>
<link href="/css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<?php
//if($status1=="ok")
{?>
<script language='javascript'>

 function updateCoin()
 {
// jConfirm('Do you have a coin to register?', 'Confirmation Dialog', function(r) { })
 if(trim($('#screenname').val()) == '')
	 {
		 inlineMsg('screenname','<strong>Screen Name required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#screenname').val()) == true){
		 inlineMsg('screenname','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
    	if(trim($('#email').val()) == '')
	 {
		 inlineMsg('email','<strong>Email required.</strong>',2);
		 return false;
	 }
	if(!validateemail($('#email').val()))
		 {
			 inlineMsg('email','<strong>Please enter valid email address.</strong>',2);
			 return false;
		 }
	 if(tagValidate(trim($('#email').val())) == true){
		 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	if(trim($('#revemail').val()) == '')
	 {
		 inlineMsg('revemail','<strong>Confirm Email required.</strong>',2);
		 return false;
	 }
	if(trim($('#email').val())!= trim($('#revemail').val()))
	 {
		 inlineMsg('revemail','<strong>confirm Email not matched.</strong>',2);
		 return false;
	 }
	if(trim($('#password').val()) == '')
	 {
		 inlineMsg('password','<strong>Password required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#password').val())) == true){
		 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	/* if(trim($('#password_confirm').val()) == '')
	 {
		 inlineMsg('password_confirm','<strong>Confirm Password required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#password_confirm').val())) == true){
		 inlineMsg('password_confirm','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } */
 
	
	if($('#country').val() == '')
	 {
		 inlineMsg('country','<strong>Country required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#country').val()) == true){
		 inlineMsg('country','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 	
	if(trim($('#zipcode').val()) == '')
	 {
		 inlineMsg('zipcode','<strong>Zip required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#zipcode').val())) == true){
		 inlineMsg('zipcode','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 }
	 

if(document.getElementById("termsofservice").checked==false)
	{
	
	alert("confirm to the terms and conditions");
	return false;
	}


	
	
	return true;
}

function validateemail(email) { 
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
   
    
     if(email=="")
     {
         
         return false;
     }
     if(!email.match(emailRegex))
      {
       
        return false;
      }
     
    return true;
}
//  var doIt=confirm('Do you have a coin to register?'); 
// if(doIt){window.location.href = "/companies/register_coin"}
</script>


<?php }?>
	<!--<link rel="stylesheet" href="/css/general.css" type="text/css" media="screen" />-->
	
<div id="popupContact">
<div style="font-size: 1.4em;margin-left:80px">Do You Have a Coin to Register?</div>

<div style="margin-top: 40px;margin-left:80px">
<button class="btn" onclick="closepopup();">yes</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button class="btn" id="nocoin">no</button>
</div>
</div>
	<div id="backgroundPopup"></div>

<script type="text/javascript">
var baseurl = "<?php echo $_SERVER['HTTP_HOST'];?>";

$(document).ready(function() {
	if (register == 'register') {
		centerPopup();
		loadPopup();

		$("#nocoin").click(function() {
			if(flagreq!='1' && flagreq!='') {
				window.location = 'http://'+ baseurl + "/companies/coinregister/nocoinreq"
			}
			else {
				window.location = 'http://'+ baseurl + "/companies/coinregister/nocoin"
			}
		});

	}


});

	function closepopup(){
		disablePopup();
	}
</script>
