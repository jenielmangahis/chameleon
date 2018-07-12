

<div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project['Project']['project_name'].'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
    <h2>Sign Up</h2>
<b>Any item with a</b>"<span class="red">*</span>"<b>requires an entry.</b>  
<div style="margin: 0pt auto; width: 500px;">
    <?php
		    if($session->check('Message.error')||$session->check('Message.success')){
		    ?>
			<!-- div for error message start--> 
		    <div class="msgdiv" align="center">                 
		    <?php
		    if($session->check('Message.error')){
		    ?>
		    <div class="msgcontainer error left" style="min-width:345px;margin-left:175px">        
		    <?php   
			    echo $html->image('exclam.gif');
			    $session->flash('error');                      
		    ?>       
		    <div class="clear"></div>
		    </div>
		    <?php
		    }
		    ?>
		    </div>
		    <!-- div for error message end--> 
    
		    <!-- div for success message start--> 
		    <div class="msgdiv" align="center">                 
		    <?php
		    if($session->check('Message.success')){
		    ?>
		    <div class="msgcontainer success left" style="min-width:345px;margin-left:175px">        
		    <?php   
			    echo $html->image('success.gif');
			    $session->flash('success');                      
		    ?>       
		    <div class="clear"></div>
		    </div>
		    <?php
		    }
		    ?>
		    </div><br /><br />	<br />	<br />	<br />	<br />	
		<?php }?>
 <div> <p>&nbsp;<span class="red">*</span> Marked fields are mandatory.</p>  </div>
<div style="display:<?php if($status=='Verified') echo"none"; else echo "block"; ?>" >
<?php echo  $form->create('Company',array('action'=>'/verify','id'=>'SignupForm'));?>

<p>&nbsp;</p>  
<div><lable class='lbl'>Serial #:<span class="red">*</span></lable> <?php echo $form->input('coinset',array('label'=>false,'div'=>false,'type'=>"text", 'size'=>'10','maxlength'=>'10' , 'class'=>'inptBox')) ?>&nbsp;<?php echo $form->submit('Verify', array('div'=>false,"class"=>"btn"));?>&nbsp;<span style="color:red"><?php echo $status; ?></span></div>
<?php echo $form->end();?>
</div>
<?php echo  $form->create('Holder',array('action'=>'/companies/signup','id'=>'SignupForm','url'=>$this->here));?>
<?php echo $form->input('coinstatus',array('value'=>$status,'type'=>"hidden", 'id'=>"coinstatus" )) ?>

<p>&nbsp;</p>  
<div style="display:<?php if($status=='Verified') echo"block"; else echo "none"; ?>" >
<div><lable class='lbl'>Username:<span class="red">*</span></lable> <?php echo $form->input('username',array('label'=>false,'div'=>false,'type'=>"text", 'size'=>'40','maxlength'=>'150' , 'class'=>'inptBox')) ?><span style="color:red"></span></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Email:<span class="red">*</span></lable>  <?php echo $form->input('email',array('label'=>false,'div'=>false,'type'=>"text", 'size'=>'40','maxlength'=>'200', 'class'=>'inptBox' )) ?><span style="color:red"></span></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Password:<span class="red">*</span></lable> <?php echo $form->input('password',array('label'=>false,'div'=>false,'type'=>"password", 'id'=>"password",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Confirm Password:<span class="red">*</span></lable> <?php echo $form->input('password_confirm',array('label'=>false,'div'=>false,'type'=>"password", 'id'=>"password_confirm",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>First Name:<span class="red">*</span></lable>  <?php echo $form->input('firstname',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"firstname",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Last Name(Public):<span class="red">*</span></lable>  <?php echo $form->input('lastnameshow',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"lastnameshow",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Last Name(Private):</lable>  <?php echo $form->input('lastnameprivate',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"lastnameprivate",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Address1:</lable>  <?php echo $form->input('address1',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"address1",'size'=>'40','maxlength'=>'200', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Address2:</lable>  <?php echo $form->input('address2',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"address2",'size'=>'40','maxlength'=>'200', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>City:<span class="red">*</span></lable>  <?php echo $form->input('city',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"city",'size'=>'40','maxlength'=>'150', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Zip:<span class="red">*</span></lable>  <?php echo $form->input('zipcode',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"zipcode",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>State:<span class="red">*</span></lable> <?php echo $form->input('state',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"state",'size'=>'40','maxlength'=>'150', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Country:<span class="red">*</span></lable>  <?php		
			 echo $form->select('country',$countrylist,'254',array('id'=>'country','div'=>false,'error'=>true,'label'=>false, 'empty'=>'--Select Country--','style'=>'width:200px; border:1px solid #BEDAE5;'),false);
		?> </div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Phone:</lable>  <?php echo $form->input('phone',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"phone",'size'=>'40','maxlength'=>'15', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Birthday:</lable><?php echo $form->input('birthday',array('id'=>'birthday','label' => false,'div'=>false,'error'=>false,'size'=>'20','maxlength'=>'20','readonly'=>'readonly','class'=>'inpt','type'=>'text','onclick'=>'showCalendarControl(\'birthday\')','style'=>'width:170px;cursor:pointer;border:1px solid #BEDAE5;')); ?><?php echo $html->image('/img/'.$project['Project']['project_name'].'/cal.gif',array('onclick'=>'showCalendarControl(\'birthday\')','style'=>'width:16px;cursor:pointer;')); ?>
</div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Facebook:</lable>  <?php echo $form->input('facebook',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"facebook",'size'=>'40','maxlength'=>'200', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Twitter:</lable>  <?php echo $form->input('twitter',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"twitter",'size'=>'40','maxlength'=>'200', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Show Last name:</lable>  <?php echo $form->input('shownamelast',array('label'=>false,'div'=>false,'type'=>"checkbox", 'id'=>"shownamelast",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Show City:</lable>  <?php echo $form->input('showcity',array('label'=>false,'div'=>false,'type'=>"checkbox", 'id'=>"showcity" )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Show Address1:</lable>  <?php echo $form->input('showaddress1',array('label'=>false,'div'=>false,'type'=>"checkbox", 'id'=>"showaddress1",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Show Address2:</lable>  <?php echo $form->input('showaddress2',array('label'=>false,'div'=>false,'type'=>"checkbox", 'id'=>"showaddress2",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Eligible to win gifts and prizes :</lable>  <?php echo $form->input('eligible_for_gift',array('label'=>false,'div'=>false,'type'=>"checkbox", 'id'=>"eligible_for_gift",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Informed by email :</lable>  <?php echo $form->input('inform_by_email',array('label'=>false,'div'=>false,'type'=>"checkbox", 'id'=>"inform_by_email",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable class='lbl'>Receive your Newsletter :</lable>  <?php echo $form->input('newsletter_subscription',array('label'=>false,'div'=>false,'type'=>"checkbox", 'id'=>"newsletter_subscription",'size'=>'40', 'class'=>'inptBox' )) ?></div>
<div class="clear">&nbsp;</div>
<div><lable style="width:150px; margin-right:5px;display:inline-block;">&nbsp;</lable> <?php echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?> <?php  echo $form->button('Reset', array('type'=>'reset','div'=>false,"class"=>"btn"));?>
</div>
</div>
	<?php echo $form->end();?>
</div>
    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot">
  <?php echo $html->image('/img/'.$project['Project']['project_name'].'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

 <script type="text/javascript"> 
/*jQuery.noConflict();
    $(document).ready(function() { 
      $("#SignupForm").validate({ 
        rules: { 
 	  "data[Holder][username]": "required",
          "data[Holder][firstname]": "required",// simple rule, converted to {required:true} 
	  "data[Holder][lastnameshow]": "required",
          "data[Holder][email]": {// compound rule 
          required: true, 
          email: true 
        }, 	
	"data[Holder][zipcode]": "required",
	"data[Holder][password]":	{	
	 checkpassword: true        
	},
     	"data[Holder][country]": { 
        selectNone: true 
      	}, 	
    	"data[Holder][password_confirm]": {
      	equalTo: "#password"
    	}
 
        }, 
       	messages: { 
          "data[Holder][country]": "Please select country."
        }  
      }); 
    }); 

jQuery.validator.addMethod( 
  "selectNone", 
  function(value, element) { 
    if (element.value == "") 
    { 
      return false; 
    } 
    else return true; 
  } 
); 
jQuery.validator.addMethod("checkpassword", function( value, element ) {
		if (element.value == "") 
		{ 
			return false; 
		}	 
		else{
		var result = this.optional(element) || value.length >= 6 && /\d/.test(value) && /[a-z]/i.test(value);		
		return result;
		}
	}, "Your password must be at least 6 characters long and contain at least one number and one character.");

*/
  </script> 
