/*
 * Function name   : isCharsInBag()
 * Description     : This function for common validation
 * Created On      : 01-07-2010 (11:20am)
 *
 */
function isCharsInBag (s, bag)
  {
    var i;
    // Search through string's characters one by one.
    // If character is in bag, append to returnString.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) return false;
    }
    return true;
 }

/*
 * Function name   : validateemail()
 * Description     : This function for email validation
 * Created On      : 01-07-2010 (11:49am)
 *
 */
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

/*
 * Function name   : isUserName()
 * Description     : This function for UserName validation
 * Created On      : 01-07-2010 (11:49am)
 *
 */

function isUserName(s){
    return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_@.");
}
/*
 * Function name   : isFirstName()
 * Description     : This function for FirstName validation
 * Created On      : 01-07-2010 (11:49am)
 *
 */
function isFirstName(s){
	s=trim(s);
	return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ");
}
/*
 * Function name   : isCity()
 * Description     : This function for City validation
 * Created On      : 01-07-2010 (11:49am)
 *
 */
function isCity(s){
	s=trim(s);
	return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ");
}
/*
 * Function name   : isnumerice()
 * Description     : This function for numeric field validation
 * Created On      : 01-07-2010 (11:49am)
 *
 */
function isnumerice(s){
	s=trim(s);
	return isCharsInBag (s, "0123456789");
}

function isalphanumerice(s){
	s=trim(s);
	return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
}

//end
/*
 * Function name   : ParseUSNumber()
 * Description     : This function for phone number validation 
 * Created On      : 29-06-2010 (12:52pm)
 *
 */
function ParseUSNumber(PhoneNumberInitialString)
  {
    var FmtStr="";
    var index = 0;
    var LimitCheck;

    LimitCheck = PhoneNumberInitialString.length;
    while (index != LimitCheck)
      {
        if (isNaN(parseInt(PhoneNumberInitialString.charAt(index))))
          { }
        else
          { FmtStr = FmtStr + PhoneNumberInitialString.charAt(index); }
        index = index + 1;
      }
    if (FmtStr.length == 10)
      {
        FmtStr = "(" + FmtStr.substring(0,3) + ") " + FmtStr.substring(3,6) + "-" + FmtStr.substring(6,10);
      }
    else
      {
        FmtStr=PhoneNumberInitialString;
        return false;
      }
    return true;
  }

function defaultfocus()
{
	$(document).ready(function() {
	    $('form:first *:input[type!=hidden]:first').focus();
	});
}


var commonPasswords = new Array('password', 'pass', '1234', '1246'); 
 
var numbers = "0123456789"; 
var lowercase = "abcdefghijklmnopqrstuvwxyz"; 
var uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
var punctuation = "!.@$£#*()%~<>{}[]"; 
 
function checkPassword(password) { 
    
    var combinations = 0; 
  
    if (contains(password, numbers) > 0) { 
        combinations += 10; 
    } 
 
    if (contains(password, lowercase) > 0) { 
        combinations += 26; 
    } 
 
    if (contains(password, uppercase) > 0) { 
        combinations += 26; 
    } 
 
    if (contains(password, punctuation) > 0) { 
        combinations += punctuation.length; 
    } 
 
    // work out the total combinations 
    var totalCombinations = Math.pow(combinations, password.length); 
 
    // if the password is a common password, then everthing changes... 
    if (isCommonPassword(password)) { 
        totalCombinations = 75000 // about the size of the dictionary 
    } 
 
    // work out how long it would take to crack this (@ 200 attempts per second) 
    var timeInSeconds = (totalCombinations / 200) / 2; 
 
    // this is how many days? (there are 86,400 seconds in a day. 
    var timeInDays = timeInSeconds / 86400 
 
    // how long we want it to last 
    var lifetime = 365; 
 
    // how close is the time to the projected time? 
    var percentage = timeInDays / lifetime; 
 
    var friendlyPercentage = cap(Math.round(percentage * 100), 100); 
    if (totalCombinations != 75000 && friendlyPercentage < (password.length * 5)) { 
        friendlyPercentage += password.length * 5; 
    } 
 
    var progressBar = document.getElementById("progressBar"); 
    progressBar.style.width = friendlyPercentage + "%"; 
 
    if (percentage > 1) { 
        // strong password 
        progressBar.style.backgroundColor = "#3bce08"; 
        return; 
    } 
 
    if (percentage > 0.5) { 
        // reasonable password 
        progressBar.style.backgroundColor = "#ffd801"; 
        return; 
    } 
 
    if (percentage > 0.10) { 
        // weak password 
        progressBar.style.backgroundColor = "orange"; 
        return; 
    } 
 
    // useless password! 
    if (percentage <= 0.10) { 
        // weak password 
        progressBar.style.backgroundColor = "red"; 
        return; 
    } 
 
 
} 
 
function cap(number, max) { 
    if (number > max) { 
        return max; 
    } else { 
        return number; 
    } 
} 
 
function isCommonPassword(password) { 
 
    for (i = 0; i < commonPasswords.length; i++) { 
        var commonPassword = commonPasswords[i]; 
        if (password == commonPassword) { 
            return true; 
        } 
    } 
 
    return false; 
 
} 
 
function contains(password, validChars) { 
 
   var count = 0; 
   var i;
    for (i = 0; i < password.length; i++) { 
        var char = password.charAt(i); 
        if (validChars.indexOf(char) > -1) { 
            count++; 
        } 
    } 
 
    return count; 
} 
 
 

/*
 * Function name   : passwordChanged()
 * Description     : This function for change the password 
 * Created On      : 17-02-10 (12:15am)
 *
 */	
 
 
function passwordChanged() {
var strength = document.getElementById('strength');
var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).*$", "g");
var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
var enoughRegex = new RegExp("(?=.{6,}).*", "g");
var pwd = document.getElementById("password");
if (pwd.value.length==0) {
strength.innerHTML = 'Type Password';
} else if (false == enoughRegex.test(pwd.value)) {
strength.innerHTML = 'More Characters';
} else if (strongRegex.test(pwd.value)) {
strength.innerHTML = '<span style="color:green">Strong!</span>';
} else if (mediumRegex.test(pwd.value)) {
strength.innerHTML = '<span style="color:orange">Medium!</span>';
} else {
strength.innerHTML = '<span style="color:red">Weak!</span>';
}
}

/*
 * Function name   : passwordChanged()
 * Description     : This function for check  the hasWhiteSpace 
 * Created On      : 17-02-10 (12:15am)
 *
 */	
 

function hasWhiteSpace(strg) 
{
	var whiteSpaceExp=/^\s+$/;
	if (whiteSpaceExp.test(strg))
	return true;
	else
	return false;
}
function tagValidate(strg)
{
var tagexp =/([\<])([^\>]{1,})*([\>])/i;
if (tagexp.test(strg)) {
	return true;
}
	else {
	return false;
}
}


//START OF MESSAGE SCRIPT //

var MSGTIMER = 20;
var MSGSPEED = 5;
var MSGOFFSET = 3;
var MSGHIDE = 3;

// build out the divs, set attributes and call the fade function //
function inlineMsg(target,string,autohide) {
  var msg;
  var msgcontent;
  if(!document.getElementById('msg')) {
    msg = document.createElement('div');
    msg.id = 'msg';
    msgcontent = document.createElement('div');
    msgcontent.id = 'msgcontent';
    document.body.appendChild(msg);
    msg.appendChild(msgcontent);
    msg.style.filter = 'alpha(opacity=0)';
    msg.style.opacity = 0;
    msg.alpha = 0;
  } else {
    msg = document.getElementById('msg');
    msgcontent = document.getElementById('msgcontent');
  }
  msgcontent.innerHTML = string;
  msg.style.display = 'block';
  var msgheight = msg.offsetHeight;

  var targetdiv = document.getElementById(target);
  targetdiv.focus();
  var targetheight = targetdiv.offsetHeight;
  var targetwidth = targetdiv.offsetWidth;
  var topposition = topPosition(targetdiv) - ((msgheight - targetheight) / 2);
  var leftposition = leftPosition(targetdiv) + targetwidth + MSGOFFSET;
  msg.style.top = topposition + 'px';
  msg.style.left = leftposition + 'px';
  clearInterval(msg.timer);
  msg.timer = setInterval("fadeMsg(1)", MSGTIMER);
  if(!autohide) {
    autohide = MSGHIDE;  
  }
  window.setTimeout("hideMsg()", (autohide * 1000));
}

// hide the form alert //
function hideMsg(msg) {
  var msg = document.getElementById('msg');
  if(!msg.timer) {
    msg.timer = setInterval("fadeMsg(0)", MSGTIMER);
  }
}

// face the message box //
function fadeMsg(flag) {
  if(flag == null) {
    flag = 1;
  }
  var msg = document.getElementById('msg');
  var value;
  if(flag == 1) {
    value = msg.alpha + MSGSPEED;
  } else {
    value = msg.alpha - MSGSPEED;
  }
  msg.alpha = value;
  msg.style.opacity = (value / 100);
  msg.style.filter = 'alpha(opacity=' + value + ')';
  if(value >= 99) {
    clearInterval(msg.timer);
    msg.timer = null;
  } else if(value <= 1) {
    msg.style.display = "none";
    clearInterval(msg.timer);
  }
}

// calculate the position of the element in relation to the left of the browser //
function leftPosition(target) {
  var left = 0;
  if(target.offsetParent) {
    while(1) {
      left += target.offsetLeft;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.x) {
    left += target.x;
  }
  return left;
}

// calculate the position of the element in relation to the top of the browser window //
function topPosition(target) {
  var top = 0;
  if(target.offsetParent) {
    while(1) {
      top += target.offsetTop;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.y) {
    top += target.y;
  }
  return top;
}

// preload the arrow //
if(document.images) {
  arrow = new Image(7,80); 
  arrow.src = "/img/msg_arrow.gif"; 
}


/*
 * Function name   : showDiv()
 * Description     : This function for show and hide the fields according to the user 
 * Created On      : 17-02-10 (12:15am)
 *
 */	

function showDiv(val) {
	//alert(val);
	if(val == '2'){
		document.getElementById("showRow1").style.display = "";
		document.getElementById("showRow2").style.display = "";
		document.getElementById("showRow3").style.display = "";
		document.getElementById("showRow4").style.display = "";
	}else{
		document.getElementById("showRow1").style.display = "none";
		document.getElementById("showRow2").style.display = "none";
		document.getElementById("showRow3").style.display = "none";
		document.getElementById("showRow4").style.display = "none";
		
	}
}
/*
 * Function name   : trim()
 * Description     : This function for trim the white space 
 * Created On      : 17-02-10 (12:15am)
 *
 */	
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 

function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}


function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}


/*
 * Function name   : checkadminpasswordform()
 * Description     : This function for check the admin password 
 * Created On      : 15-02-11 (11:00pm)
 *
 */	
function checkadminpasswordform() {
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var email = document.getElementById('Field1');
	 if(email.value =="")
	 {
		 inlineMsg('Field1','<strong>You must enter your Email-ID</strong>',2);
		 return false;
	 }
	 if(!email.value.match(emailRegex)) 
	  {
	    inlineMsg('Field1','<strong>Invalid Email.</strong>',2);
	    return false;
	  }
	return true;
}



/*
 * Function name   : ajaxpwdcheck()
 * Description     : This function for check the password 
 * Created On      : 15-02-11 (11:20pm)
 *
 */	
function ajaxpwdcheck(pwd){
	document.getElementById("Submit").disabled=false;
	document.getElementById("Submit1").disabled=false;
	document.getElementById("loadingdivimg").style.display="block";	
	$.ajax({
			type: "GET",
			cache: false,
			url: baseUrl+'setups/ajaxpwdcheck/'+pwd,
			success: function(updatediv1){
			document.getElementById("loadingdivimg").style.display="none";
				if(updatediv1==0){
					inlineMsg('Opassword','<strong>Opps! Old password not matched </strong>',2);
					 return false;
				}
				
				/*document.getElementById("updatediv1").innerHTML="";
				document.getElementById("updatediv1").style.display = 'none';
				$("#updatediv1").html(trim(updatediv1));
				document.getElementById("loadingdivimg").style.display="none";
				if(document.getElementById('pswd') && document.getElementById('pswd').value == 0)
				{
					document.getElementById("updatediv1").style.display = 'block';
					document.getElementById("Submit").disabled=true;
					document.getElementById("Submit1").disabled=true;	
					return false;
				}*/
				
			}	
		});
 }

/*
 * Function name   : validatepassword()
 * Description     : This function for validate the users password 
 * Created On      : 15-02-11 (11:30p)
 *
 */	
function validatepassword()
{
	 var Opassword = document.getElementById("Opassword").value;
	 var password = document.getElementById("password").value;
	 var Cpassword = document.getElementById("Cpassword").value;
	 
	 if(Opassword =="")
	 {
		 inlineMsg('Opassword','<strong>You must enter old password</strong>',2);
		 return false;
	 }
	 
	 if(password =="")
	 {
		 inlineMsg('password','<strong>You must enter new password</strong>',2);
		 return false;
	 }
	 if(Cpassword =="")
	 {
		 inlineMsg('Cpassword','<strong>You must enter confirm password</strong>',2);
		 return false;
	 }
	 if(password!=Cpassword)
	 {
		 inlineMsg('Cpassword','<strong>New password and confirm password does not match</strong>',2);
		 return false; 
	 }
	 return true;
}
/*
 * Function name   : validate Change password()
 * Description     : This function for validate the users password 
 * Created On      : 29-07-11 (11:30p)
 *
 */	
function validatechangepass()
{
	 var Opassword = document.getElementById("oldpassword").value;
	 var password = document.getElementById("password").value;
	 var Cpassword = document.getElementById("confirm_password").value;
	 if(document.getElementById("reset_password").checked==false)
     {
     
	     if(Opassword =="")
	     {
		     inlineMsg('oldpassword','<strong>You must enter old password</strong>',2);
		     return false;
	     }
	     
	     if(password =="")
	     {
		     inlineMsg('password','<strong>You must enter new password</strong>',2);
		     return false;
	     }
	     if(Cpassword =="")
	     {
		     inlineMsg('confirm_password','<strong>You must enter confirm password</strong>',2);
		     return false;
	     }
	     if(password!=Cpassword)
	     {
		     inlineMsg('confirm_password','<strong>New password and confirm password does not match</strong>',2);
		     return false; 
	     }
         
         }
	 return true;
}
/*
 * Function name   : validateprojecttype()
 * Description     : This function is used for validation of project type (add/edit)
 * Created On      : 16-02-2011 (02:10am)
 *
 */

function validateBillingtype() {
    

	if($('#billing_type').val() == '') {
		 inlineMsg('billing_type','<strong>Please provide Billing type</strong>',2);
		 return false;
	}
	if(tagValidate($('#billing_type').val()) == true){
		 inlineMsg('billing_type','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	} 
	if ($("input[name='data[BillingType][payment_type]']:checked").length == 0){
		inlineMsg('BillingTypePaymentTypeOther','<strong>Please select Payment Type.</strong>',2);
		 return false;
	}
	
	
	
    return true;
}


function validateproducttype(part){
   
    
     if($('#typename').val() == '')
     {
         inlineMsg('typename','<strong>Please provide Product Type</strong>',2);
         return false;
     }
     if(tagValidate($('#typename').val()) == true){
         inlineMsg('typename','<strong>Please dont use script tags.</strong>',2);
         return false; 
     } 
     
     if($('#size_inch').val() == '')
     {
         inlineMsg('size_inch','<strong>Please provide size(inch) </strong>',2);
         return false;
     }
     
     if (isNaN($('#size_inch').val()))
     {
         inlineMsg('size_inch','<strong>Please type numbers in size(inch) </strong>',2);
         return false;
     }
     
     if($('#size_mm').val() == '')
     {
         inlineMsg('size_mm','<strong>Please provide size(mm) </strong>',2);
         return false;
     }
     
     if (isNaN($('#size_mm').val()))
     {
         inlineMsg('size_mm','<strong>Please type numbers in size(mm) </strong>',2);
         return false;
     }
     
     if($('#delivery_days').val() == '')
     {
         inlineMsg('delivery_days','<strong>Please provide delivery days</strong>',2);
         return false;
     }
     
     if($('#notes').val() != '')
     {
         if(tagValidate($('#notes').val()) == true){
             inlineMsg('notes','<strong>Please dont use script tags.</strong>',2);
             return false; 
         }
     }
     return true;
}


function validatepricingtype(part){
     
    if($('#product_id').val() == '' || $('#product_id').val() == 'Select One')
     {
         inlineMsg('product_id','<strong>Please provide Product Type</strong>',2);
         return false;
     }
            
     if($('#typename').val() == '')
     {
         inlineMsg('typename','<strong>Please provide Pricing Type</strong>',2);
         return false;
     }
     if(tagValidate($('#typename').val()) == true){
         inlineMsg('typename','<strong>Please dont use script tags.</strong>',2);
         return false; 
     } 
    
 
     if($('#notes').val() != '')
     {
         if(tagValidate($('#notes').val()) == true){
             inlineMsg('notes','<strong>Please dont use script tags.</strong>',2);
             return false; 
         }
     }
     return true;
}



/*
 * Function name   : validatecommtask()
 * Description     : This function is used for validation of project type (add/edit)
 * Created On      : 16-02-2011 (02:10am)
 *
 */

function validatecommtask(){
     if($('#task_name').val() == '')
	 {
		 inlineMsg('task_name','<strong>Please provide Task Name</strong>',2);
		 return false;
	 }
     
     if(tagValidate($('#task_name').val()) == true){
         inlineMsg('task_name','<strong>Please dont use script tags.</strong>',2);
         return false; 
     } 
     
	if($('#email_template_id').val() == '0')
	 {
		 inlineMsg('email_template_id','<strong>Please provide  Email Template</strong>',2);
		 return false;
	 }

	 if($('#email_subject').val() == '')
     {
         inlineMsg('email_subject','<strong>Please provide email subject</strong>',2);
         return false;
     }
     
     if(tagValidate($('#email_subject').val()) == true){
         inlineMsg('email_subject','<strong>Please dont use script tags.</strong>',2);
         return false; 
     } 
     
      if($('#email_from').val() == '')
     {
         inlineMsg('email_from','<strong>Please provide email from</strong>',2);
         return false;
     } else{
             //alert("ch1");
             var email=$('#email_from').val();
             if(validateemail(email)== false)
             {
                 //alert("ch2");
                 inlineMsg('email_from','<strong>Please provide valid email from</strong>',2);
                 return false;
             }
    }
    
     if($('#member_agefrom').val() != '00-00-0000' || $('#member_ageto').val() != '00-00-0000')
     {
        if($('#member_agefrom').val() == '00-00-0000' &&  $('#member_ageto').val() != '00-00-0000'){
              inlineMsg('member_agefrom','<strong>Please provide age range from date</strong>',2);
              return false;
        }
        
         if($('#member_agefrom').val() != '00-00-0000' &&  $('#member_ageto').val() == '00-00-0000'){
              inlineMsg('member_ageto','<strong>Please provide age range to date</strong>',2);
              return false;
        }
        
           /* if($('#member_agefrom').val() != '00-00-0000' && $('#member_ageto').val() != '00-00-0000')
          {
               if($('#member_agefrom').val() == '00-00-0000' >  $('#member_ageto').val() != '00-00-0000'){
                    inlineMsg('member_ageto','<strong>Please provide age range from shoube be less than age range to date</strong>',2);
                    return false;
               }
              
          } */
         
     }
     
     if($('#member_days_since').val() != '')
     {
                if($('#member_noof_days_since').val() == '')
             {
                 inlineMsg('member_noof_days_since','<strong>Please provide number of days since</strong>',2);
                 return false;
             }
     }
     
     if($('#country').val() == '254' || $('#country').val() == '113')
     {
                   if($('#member_zipcode_from').val() != '' || $('#member_zipcode_to').val() != '')
                   {
                        if($('#member_zipcode_from').val() == '' &&  $('#member_zipcode_to').val() != ''){
                              inlineMsg('member_zipcode_from','<strong>Please provide zip code range from</strong>',2);
                              return false;
                        }
                        
                         if($('#member_zipcode_from').val() != '' &&  $('#member_zipcode_to').val() == ''){
                              inlineMsg('member_zipcode_to','<strong>Please provide  zip code range to</strong>',2);
                              return false;
                        }
                   }
     }
     
      if($('#member_points_rangefrom').val() != '' || $('#member_points_rangeto').val() != '')
      {
            if($('#member_points_rangefrom').val() == '' &&  $('#member_points_rangeto').val() != ''){
                  inlineMsg('member_points_rangefrom','<strong>Please provide points range from</strong>',2);
                  return false;
            }
            
             if($('#member_points_rangefrom').val() != '' &&  $('#member_points_rangeto').val() == ''){
                  inlineMsg('member_points_rangeto','<strong>Please provide  points range to</strong>',2);
                  return false;
            }
            
            if($('#member_points_rangefrom').val()  >=  $('#member_points_rangeto').val()){
                    inlineMsg('member_points_rangeto','<strong>Please provide points range from shoube be less than points range to </strong>',2);
                    return false;
               }
      }
      
       if($('#recur_pattern').val() == 'Yearly' )
     {                                             
             if($('#everynoofmonths').attr('checked')===true) { 
                  if($('#yearly_everymonth').val() == '')
                 {
                     inlineMsg('yearly_everymonth','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }
                 
                  if($('#yearly_everymonth_date').val() == ''  )
                 {
                     inlineMsg('yearly_everymonth_date','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }else if( $('#yearly_everymonth_date').val() < 1 ||  $('#yearly_everymonth_date').val() > 31) 
                 {
                     inlineMsg('yearly_everymonth_date','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }
             }
             
              if($('#theweekofmonths').attr('checked')===true) { 
                 // alert("theweekofmonths");
             }
                 
     }else if($('#recur_pattern').val() == 'Monthly' )
     {                                                  
            if($('#dayofeverymonth').attr('checked')===true) { 
                  if($('#monthly_onof_day').val() == '' || ( $('#monthly_onof_day').val() < 1 ||  $('#monthly_onof_day').val() > 31) )
                 {
                     inlineMsg('monthly_onof_day','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }
                 
                  if($('#monthly_every_noof_months').val() == ''  )
                 {
                     inlineMsg('monthly_every_noof_months','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }else if ( $('#monthly_every_noof_months').val() < 1 ||  $('#monthly_every_noof_months').val() > 99)
                 {
                     inlineMsg('monthly_every_noof_months','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }
                 
             }
             
              if($('#weekdayofeverymonth').attr('checked')===true) { 
                  if($('#monthly_weekof_noof_months').val() == '' )
                 {
                     inlineMsg('monthly_weekof_noof_months','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }else if( $('#monthly_weekof_noof_months').val() < 1 ||  $('#monthly_weekof_noof_months').val() > 99) 
                 {
                     inlineMsg('monthly_weekof_noof_months','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }
             }
         
     }else if($('#recur_pattern').val() == 'Weekly' )
     {                                                 
             if($('#weekly_every_noof_weeks').val() == ''  )
                 {
                     inlineMsg('weekly_every_noof_weeks','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }else if ($('#weekly_every_noof_weeks').val() < 1 ||  $('#weekly_every_noof_weeks').val() > 99) 
                 {
                     inlineMsg('weekly_every_noof_weeks','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }
         
         
     }else if($('#recur_pattern').val() == 'Daily' )
     {                                              
          if($('#daily_every_noof_days').val() == '' )
                 {
                     inlineMsg('daily_every_noof_days','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }else if($('#daily_every_noof_days').val() < 1  ||  $('#daily_every_noof_days').val() > 999)
                 {
                     inlineMsg('daily_every_noof_days','<strong>The recurrence pattern is not valid</strong>',2);
                     return false;
                 }
     }
     
    if($('#task_startdate').val() == '')
	 {
		 inlineMsg('task_startdate','<strong>Please provide Start date</strong>',2);
		 return false;
	 }           
    
     if($('#after_accurrences').attr('checked')===true) {    
              if($('#task_end_after_occurrences').val() == '')
             {
                 inlineMsg('task_end_after_occurrences','<strong>Please provide task end after number of occurrences</strong>',2);
                 return false;
             }
     }
     
     if($('#by_date').attr('checked')===true) {    
              if($('#task_end_by_date').val() == '')
             {
                 inlineMsg('task_end_by_date','<strong>Please provide task end by date </strong>',2);
                 return false;
             }
     }
     
	 return true;
}


/*
 * Function name   : validatecompanytype()
 * Description     : This function is used for validation of company type (add/edit)
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validatecompanytype(part){
   
	
     if($('#typename').val() == '')
	 {
		 inlineMsg('typename','<strong>Please provide Company Type</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#typename').val()) == true){
		 inlineMsg('typename','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
   
	 return true;
}

/*
 * Function name   : validatecommenttype()
 * Description     : This function is used for validation of comment type (add/edit)
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validatecommenttype(part){
   
	
     if($('#typename').val() == '')
	 {
		 inlineMsg('typename','<strong>Please provide Comment Type</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#typename').val()) == true){
		 inlineMsg('typename','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
   
	 return true;
}

/*
 * Function name   : validatecontacttype()
 * Description     : This function is used for validation of contact type (add/edit)
 * Created On      : 16-02-2011 (06:40am)
 *
 */

function validatecontacttype(part){
   
	
     if($('#typename').val() == '')
	 {
		 inlineMsg('typename','<strong>Please provide Contact Type</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#typename').val()) == true){
		 inlineMsg('typename','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
   
	 return true;
}

/*
 * Function name   : validateshippingtype()
 * Description     : This function is used for validation of shipping type (add/edit)
 * Created On      : 16-02-2011 (08:25pm)
 *
 */

function validateshippingtype(part){
   
	
	 if($('#typename').val() == '')
	 {
		 inlineMsg('typename','<strong>Please provide Shipping Type</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#typename').val()) == true){
		 inlineMsg('typename','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	 
	 if($('#shipdays').val() == '')
	 {
		 inlineMsg('shipdays','<strong>Please provide Shipping Days</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#shipdays').val()) == true){
		 inlineMsg('shipdays','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	 if(isnumerice($('#shipdays').val()) == false){
		 inlineMsg('shipdays','<strong>Only numeric value allowed.</strong>',2);
		 return false; 
	 } 

	 if($('#notes').val() != '')
	 {
		 if(tagValidate($('#notes').val()) == true){
			 inlineMsg('notes','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		 }
	 }
	 return true;
}

/*
 * Function name   : validatelogin()
 * Description     : This function is used for validation of login Page
 * Created On      : 27-07-2011 (08:25pm)
 *
 */

function validatelogin(){
   
		if($('#Field1').val() == '')
		 {
			 inlineMsg('Field1','<strong>Please provide User Name</strong>',2);
			 return false;
		 }
		
		 if($('#Field2').val() == '')
		 {
			 inlineMsg('Field2','<strong>Please provide Password.</strong>',2);
			 return false;
		 } 
}
/*
 * Function name   : validateshippingtype()
 * Description     : This function is used for validation of shipping type (add/edit)
 * Created On      : 16-02-2011 (08:25pm)
 *
 */

function validateproject(part){
   
	if(part == "add"){
		if($('#project_name').val() == '')
		 {
			 inlineMsg('project_name','<strong>Please provide Project Name</strong>',2);
			 return false;
		 }
	/*	if(isalphanumerice($('#project_name').val()) == false){
			 inlineMsg('project_name','<strong>Project Name should alphanumeric only.</strong>',2);
			 return false; 
		 }
         
    */
		 if(tagValidate($('#project_name').val()) == true){
			 inlineMsg('project_name','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		 }
         
         if($('#system_name').val() == '')
		 {
			 inlineMsg('system_name','<strong>Please provide System Name</strong>',2);
			 return false;
		 }
		 
		 if( isalphanumerice($('#system_name').val()) == false){
             inlineMsg('system_name','<strong>System Name should be alphanumeric only.</strong>',2);
             return false; 
         }
         
         
		 if($('#project_type_id').val() == '')
		 {
			 inlineMsg('project_type_id','<strong>Please provide Project Type.</strong>',2);
			 return false;
		 } 
         
		 if($('#is_superfooterenabled').is(':checked') && $('#border_footer_id').val() == '') 
		 {
			 inlineMsg('border_footer_id','<strong>Please provide border footer type.</strong>',2);
			 return false;
		 } 
		 
		 if($('#status_type_id').val() == '')
		 {
			 inlineMsg('status_type_id','<strong>Please provide status type.</strong>',2);
			 return false;
		 }
		 
		 if($('#companies_bb').val() == '' || $('#companies_bb').val() == 0 || $('#companies_bb').val() == null)
		 {
			 inlineMsg('companies_bb','<strong>Please select Project Owner.</strong>',2);
			 return false;
		 }
		 
         if($('#contacts').val() == '' || $('#contacts').val() == 0 || $('#contacts').val() == null)
		 {
			 inlineMsg('contacts','<strong>Please select Contacts.</strong>',2);
			 return false;
		 }
         
		 /*
		 if($('#sponsor_name').val() == '')
         {
             inlineMsg('sponsor_name','<strong>Please provide System Owner name</strong>',2);
             return false;
         }
		*/ 
         if($('#username').val() == '')
         {
             inlineMsg('username','<strong>Please provide Username</strong>',2);
             return false;
         }
         
         if($('#password').val() == '')
         {
             inlineMsg('password','<strong>Please provide Password</strong>',2);
             return false;
         }
        
         if($('#notificationEmail').val() == '')
         {
             inlineMsg('notificationEmail','<strong>Please provide Notification Email</strong>',2);
             return false;
         }
         else  
         {
             //alert("ch1");
             var email=$('#notificationEmail').val();
             if(validateemail(email)== false)
             {
                 //alert("ch2");
                 inlineMsg('notificationEmail','<strong>Please provide correct Notification Email</strong>',2);
                 return false;
             }
         }
		 
		/* if($('#serialprefix').val() == '')
		 {
			 inlineMsg('serialprefix','<strong>Please provide Serial Prefix.</strong>',2);
			 return false;
		 }*/
		 if(isalphanumerice($('#serialprefix').val()) == false){
			 inlineMsg('serialprefix','<strong>Serial Prefix should alphanumeric only.</strong>',2);
			 return false; 
		 }
		 if(tagValidate($('#serialprefix').val()) == true){
			 inlineMsg('serialprefix','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		 }
		
		
		
	}else if (part == "edit"){
		
		
	}else{
		return false;
	}
}

/*
 * Function name   : ajaxuniqueprojectname()
 * Description     : This function for check unique project name
 * Created On      : 17-02-11 (001:10am)
 *
 */	
function ajaxuniqueprojectname(projectname){	
	//document.getElementById("Submit").disabled=false;
	document.getElementById("loadingdivimg").style.display="block";	
	$.ajax({
			type: "GET",
			cache: false,
			url: baseUrlAdmin+'uniquesystemname/'+projectname,
			success: function(output){
         	document.getElementById("loadingdivimg").style.display="none";  
				//alert(output);
                if(output>0)
                {
                    inlineMsg('project_name','<strong>Project name already exists</strong>',2);
                    $('#project_name').val("");
                    return false;
                }
			}	
		});
 }

 function ajaxuniquesystemname(systemname){    
    //document.getElementById("Submit").disabled=false;
    document.getElementById("loadingdivimg").style.display="block";    
    $.ajax({
            type: "GET",
            cache: false,
            url: baseUrlAdmin+'uniqueprojectname/'+systemname,
            success: function(output){ 
            document.getElementById("loadingdivimg").style.display="none"; 
            //alert(output);
                if(output>0)
                {
                    inlineMsg('system_name','<strong>System name already exists</strong>',2);
                    $('#system_name').val("");
                    return false;
                }
            
            }    
        });
 }
 
 
 function ajaxuniquesponsorname(sponsorname){    
    //document.getElementById("Submit").disabled=false;
    document.getElementById("loadingdivimg").style.display="block";    
    $.ajax({
            type: "GET",
            cache: false,
            url: baseUrlAdmin+'uniquesponsorusername/'+sponsorname,
            success: function(output){ 
            document.getElementById("loadingdivimg").style.display="none"; 
            //alert(output);
                if(output>0)
                {
                    inlineMsg('username','<strong>Username already exists</strong>',2);
                    $('#username').val("");
                    return false;
                }
            
            }    
        });
 }
 
 
 
 
/*
 * Function name   : ajaxuniqueprojectname()
 * Description     : This function for check unique project name
 * Created On      : 17-02-11 (001:10am)
 *
 */	
function ajaxuniqueprojectprefix(prefixname){
	
	document.getElementById("Submit").disabled=false;
	document.getElementById("loadingdivimg").style.display="block";	
	$.ajax({
			type: "GET",
			cache: false,
			url: baseUrlAdmin+'uniqueprojectprefix/'+prefixname,
			success: function(updatediv2){ 
				document.getElementById("updatediv2").innerHTML="";
				document.getElementById("updatediv2").style.display = 'none';
				$("#updatediv2").html(trim(updatediv2));
				document.getElementById("loadingdivimg").style.display="none";
				if(document.getElementById('prefixname') && document.getElementById('prefixname').value > 0)
				{	
					document.getElementById("updatediv2").style.display = 'block';
					document.getElementById("Submit").disabled=true;
					return false;
				}
				
			}	
		});
 }
 function validatecontentpage(){
     if($('#title').val() == '')
	 {
		 inlineMsg('title','<strong>Please provide Title</strong>',2);
		 return false;
	 }
	
	if($('#alias').val() == '')
	 {
		 inlineMsg('alias','<strong>Please provide alias</strong>',2);
		 return false;
	 }
    var inputalise=trim($('#alias').val());
     var chk= isCharsInBag(inputalise, "abcdefghijklmnopqrstuvwxyz0123456789-");
     if(chk == false){
           inlineMsg('alias','<strong>Alise must contain lower case alpha-numeric characters(a to z, 0 to 9,-)</strong>',2);
             return false; 
         }
         
         
	if($('#metatitle').val() == '')
	 {
		 inlineMsg('metatitle','<strong>Please provide Page Tilte</strong>',2);
		 return false;
	 }

	
	/*
	 if($('#metakeyword').val() == ''){
		 inlineMsg('metakeyword','<strong>Please provide Metakeyword.</strong>',2);
		 return false; 
	 } 
     
	 if($('#metadescription').val() == '')
	 {
		 inlineMsg('metadescription','<strong>Please provide metadescription</strong>',2);
		 return false;
	 }

	*/
	  
	 /* if($('#cke_content').val() == '')
	 {
		 inlineMsg('cke_content','<strong>Please provide Content</strong>',2);
		 return false;
	 }*/


	 return true;
}

function findgetstates(countryid,modelname) {
	   if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: baseUrlAdmin+'findselectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                    //alert(rText);		     	
                     jQuery('#statediv').html(rText);
             }
     });
	  
}


function getstates(countryid,modelname) {        
	   
	   if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: baseUrlAdmin+'selectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                    //alert(rText);
		     	
                     jQuery('#statediv').html(rText);
             }
     });
	  
}



function getstateoptions(countryid,modelname) {    
       if(countryid==""){
          return false;
       }

       jQuery.ajax({
             type: "GET",
             url: baseUrlAdmin+'selectstateoptions/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){

                     jQuery('#state').html(rText);
             }
     });
      
}

function projectstates(countryid,modelname) {
	   if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: baseUrlAdmin+'projectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                    //alert(rText);
                     jQuery('#statediv').html(rText);
             }
     });
	  
}

function newgetstates(countryid,modelname) {  
	   if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: baseUrlAdmin+'newselectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
		document.getElementById("d1").style.display="none";
                    //alert(rText);
		document.getElementById("d2").style.display="block";
                     jQuery('#statediv1').html(rText);
             }
     });
	  
}





function showselecttemplate(id){
	       $.ajax({
                    url: baseUrlAdmin+'get_email_template_details_by_ajax/'+id,
                    dataType:'json',
                    cache: false,
                    success: function(result){
                            
                              $("#subject").val(result.subject);
                              $("#fromid").val(result.sender);
                              var oEditor = CKEDITOR.instances.content ;
                              //alert( oEditor.getData() ) ; 
                              oEditor.setData( result.content ) ;
                                    
                    }
      });

}



function validatesponsor(){
	 //alert($('startser').val());
 

		if($('#sponsor_name').val() == '')
		{
			inlineMsg('sponsor_name','<strong>Please Provide Sponsor Name.</strong>',3);
			return false;
		}
		if($('#email').val() == '')
		{
			inlineMsg('email','<strong>Please provide Email.</strong>',2);
			return false;
		}
		if(validateemail($('#email').val()) == false){
			 inlineMsg('email',"<strong>Please enter valid email.</strong>",2);
			 return false; 
		}
		if($('#address1').val() == '')
		{
			inlineMsg('address1','<strong>Please provide Address 1.</strong>',2);
			return false;
		}
		
		if($('#country').val() == '')
		{
			inlineMsg('country','<strong>Please select Country.</strong>',2);
			return false;
		}
		if($('#newst').val() == '')
		{
			inlineMsg('newst','<strong>Please select State.</strong>',2);
			return false;
		}
		if($('#city').val() == '')
		{
			inlineMsg('city','<strong>Please provide city name .</strong>',2);
			return false;
		}

		if($('#zipcode').val() == '')
		{
			inlineMsg('zipcode','<strong>Please provide zipcode .</strong>',2);
			return false;
		}
 
		if($('#zipcode').val().length < 5)
		 {
			 inlineMsg('zipcode','<strong>Zip Code must have five digits.</strong>',2);
			 return false;
					 
		 }
		else
                 {
				var zipCodePattern = /^\d{5}$|^\d{5}-\d{4}$/;
				var ziptest=zipCodePattern.test($('#zipcode').val());
				if($('#country').val()==254 && ziptest==false)
				{
							
	
					inlineMsg('zipcode','<strong>Please provide US Zip Code.</strong>',2);
					return false;	
				}
				if($('#zipcode').val().length > 9){
				 inlineMsg('zipcode','<strong>Zip Code not have more than Nine digits.</strong>',2);
				 return false;
				 }
		}
  }

var checkcoinset=false;
var flag=true;

function validatecoinset(part){
	 //alert($('startser').val());
 

	if(part=="add")
	{

		if($('#units').val() == '')
		{
			inlineMsg('units','<strong>Please provide # of Units.</strong>',2);
			return false;
		}
        
        if($('#use_pre_artwork').attr("checked") == false || $('#use_pre_artwork').val() == undefined)
        {
        
            if($('#sidea').val() == '')
            {
                inlineMsg('sidea','<strong>Please provide Side A Image.</strong>',2);
                return false;
            }
            
            if($('#sideb').val() == '')
            {
                inlineMsg('sideb','<strong>Please provide Side B Image.</strong>',2);
                return false;
            }
            
            if($('#coinedge').val() == '')
            {
                inlineMsg('coinedge','<strong>Please provide Edge Image.</strong>',2);
                return false;
            }
            
        }
        
        if($('#ship_type_id').val() == '')
        {
            inlineMsg('ship_type_id','<strong>Please Select Shipping Type.</strong>',3);
            return false;
        }
        
        if($('#project_type_id').val() == '')
        {
            inlineMsg('project_type_id','<strong>Please Select Project Type.</strong>',3);
            return false;
        }
        if(($('#serialprefix').val() != '') && ($('#serialprefix').val().length != 3))
        {
            inlineMsg('serialprefix','<strong>Serial Prefix Must Heve 3 Character.</strong>',3);
            return false;
        }
        
		if($('#datesubmitchipco').val() == ''){
		 inlineMsg('datesubmitchipco','<strong>Please Provide Order date.</strong>',3);
		 return false; 
	 	}
		if($('#datesubmitchipco').val() != '')
		{
			var d = new Date();
			//var dateval=
			var curr_date = d.getDate();
  			var curr_month = d.getMonth() + 1; //months are zero based
  			var curr_year = d.getFullYear();
			var splitvar = ($('#datesubmitchipco').val()).split('-');
			if(splitvar[2] <= curr_year){
			if( splitvar[0]<curr_month ){			
					if(splitvar[1]<31){
					inlineMsg('datesubmitchipco','<strong>Order Date not exist in past.</strong>',2);
					return false;
					}
			}
			else if(splitvar[0]==curr_month )
			{
					if(splitvar[1]<curr_date)
					{
					inlineMsg('datesubmitchipco','<strong>Order Date not exist in past.</strong>',2);
					return false;	
					}	
			}
			else
			{
					var curr_date = d.getDate();
			}
             	}
		}
		
		if(isnumerice($('#units').val()) == false){
			inlineMsg('units','<strong>Units should be numeric only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#units').val()) == true){
			inlineMsg('units','<strong>Please dont use script tags.</strong>',2);
			return false; 
		} 
		
		if($('#name').val() == '')
		{
			inlineMsg('name','<strong>Please provide Coinset Name.</strong>',2);
			return false;
		}
		if(tagValidate($('#name').val()) == true){
			inlineMsg('name','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		
		if($('#startser').val() == '')
		{
			inlineMsg('startser','<strong>Please provide Serial # Start.</strong>',2);
			return false;
		}
		if(isnumerice($('#startser').val()) == false){
			inlineMsg('startser','<strong>Serial # Start should be numeric only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#startser').val()) == true){
			inlineMsg('startser','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		if($('#ending').val() == '')
		{
			inlineMsg('ending','<strong>Please provide Serial # End.</strong>',2);
			return false;
		}
		if(isnumerice($('#ending').val()) == false){
			inlineMsg('ending','<strong>Serial # End should be numeric only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#ending').val()) == true){
			inlineMsg('ending','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		if(isnumerice($('#serialprefix').val()) == true && $('#serialprefix').val() != '' ){
			inlineMsg('serialprefix','<strong>Serial # Start should be character only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#serialprefix').val()) == true && $('#serialprefix').val() != ''){
			inlineMsg('serialprefix','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		if(isnumerice($('#serialprefix').val()) == true && $('#serialprefix').val() != '' ){
			inlineMsg('serialprefix','<strong>Serial # Start should be character only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#serialprefix').val()) == true && $('#serialprefix').val() != ''){
			inlineMsg('serialprefix','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}

		 if($('#verifycode').val() == ''){
                if(flag){
					centerPopup();
                  loadPopup();
				return  false;
								}
              if(checkcoinset)
	          {
   				

					inlineMsg('verifycode','<strong>Please provide Verification Code.</strong>',2);
					return false;

				}else{
					return true;
				}
	 
		 }else{

			if(isnumerice($('#verifycode').val()) == false){
					inlineMsg('verifycode','<strong>Verification Code should be numeric only.</strong>',2);
					return false; 
						}
			if(tagValidate($('#verifycode').val()) == true){
					inlineMsg('verifycode','<strong>Please dont use script tags.</strong>',2);
					return false; 
				} 




		}

  }

	if(part=="edit")
	{
		if($('#ship_type_id').val() == '')
		{
			inlineMsg('ship_type_id','<strong>Please Select Shipping Type.</strong>',3);
			return false;
		}
		if($('#project_type_id').val() == '')
		{
			inlineMsg('project_type_id','<strong>Please Select Project Type.</strong>',3);
			return false;
		}		
		if($('#units').val() == '')
		{
			inlineMsg('units','<strong>Please provide # of Units.</strong>',2);
			return false;
		}
		if($('#datesubmitchipco').val() == ''){
		 inlineMsg('ending','<strong>Please Provide Order date.</strong>',3);
		 return false; 
	 	}
		if(isnumerice($('#units').val()) == false){
			inlineMsg('units','<strong>Units should be numeric only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#units').val()) == true){
			inlineMsg('units','<strong>Please dont use script tags.</strong>',2);
			return false; 
		} 
		
		if($('#name').val() == '')
		{
			inlineMsg('name','<strong>Please provide Coinset Name.</strong>',2);
			return false;
		}
		if(tagValidate($('#name').val()) == true){
			inlineMsg('name','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
	
		if($('#startser').val() == '')
		{
			inlineMsg('startser','<strong>Please provide Serial # Start.</strong>',2);
			return false;
		}
		if(isnumerice($('#startser').val()) == false){
			inlineMsg('startser','<strong>Serial # Start should be numeric only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#startser').val()) == true){
			inlineMsg('startser','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		if($('#ending').val() == '')
		{
			inlineMsg('ending','<strong>Please provide Serial # End.</strong>',2);
			return false;
		}
		if(isnumerice($('#ending').val()) == false){
			inlineMsg('ending','<strong>Serial # End should be numeric only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#ending').val()) == true){
			inlineMsg('ending','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		if(isnumerice($('#serialprefix').val()) == true && $('#serialprefix').val() != '' ){
			inlineMsg('serialprefix','<strong>Serial # Start should be character only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#serialprefix').val()) == true && $('#serialprefix').val() != ''){
			inlineMsg('serialprefix','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		 if($('#verifycode').val() == ''){
              if(confirm('Are you Sure you dont want to offer the verification code ?'))
	          {
   

					inlineMsg('verifycode','<strong>Please provide Verification Code.</strong>',2);
					return false;

				}else{
					return true;
				}
	 
		 }else{

			if(isnumerice($('#verifycode').val()) == false){
					inlineMsg('verifycode','<strong>Verification Code should be numeric only.</strong>',2);
					return false; 
						}
						if(tagValidate($('#verifycode').val()) == true){
					inlineMsg('verifycode','<strong>Please dont use script tags.</strong>',2);
					return false; 
				} 




		}




	 
	 }
	 /*if($('#datesubmitchipco').val() == '')
	 {
		 inlineMsg('datesubmitchipco','<strong>Please provide Order to Chipco Date.</strong>',2);
		 return false;
	 }
	 if($('#dateestship').val() == '')
	 {
		 inlineMsg('dateestship','<strong>Please provide Est Ship Date.</strong>',2);
		 return false;
	 }
	 if($('#dateestdelivery').val() == '')
	 {
		 inlineMsg('dateestdelivery','<strong>Please provide Est Deliver Date.</strong>',2);
		 return false;
	 }
	 
	 if(part=='edit'){
		 
		 if($('#dateship').val() == '' || $('#dateship').val() == '0000-00-00')
		 {
			 inlineMsg('dateship','<strong>Please provide Actual Ship Date.</strong>',2);
			 return false;
		 }
		 if($('#dateactualdelivery').val() == '' || $('#dateactualdelivery').val() == '0000-00-00')
		 {
			 inlineMsg('dateactualdelivery','<strong>Please provide Actual Deliver Date.</strong>',2);
			 return false;
		 }
	 }*/
	
}

function setcoinsetinfo(){
	if($('#units').val() != '')
	 {
		if(isnumerice($('#units').val()) == true){
			
			if($('#units').val() > 0)
			 {
				var unitval="";
				var startval="";
					document.getElementById("ending").value ="";
					unitval = document.getElementById("units").value;
					startval = trimNumber(document.getElementById("startser").value);
					
					var res =  ((parseInt(unitval) + parseInt(startval))-1);
					document.getElementById("ending").value = res;
					var resstr =  document.getElementById("ending").value.length;
					var looplen = 7 -  parseInt(resstr);
					var finalres="";
					for(var i=0; i < looplen; i++){
						finalres = "0"+finalres;
					}
					document.getElementById("ending").value = finalres+res;
			 }else{
				 document.getElementById("ending").value ="";
			 }
			
		 }else{
			 document.getElementById("ending").value ="";
		 }
		
	 }else{
		 document.getElementById("ending").value ="";
	 }	
}

function trimNumber(s) {
	  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
	  return s;
	}

function getshippingdays(shippingid) {
	   
	 document.getElementById("shippingvalue").value = "";
    jQuery.ajax({
          type: "GET",
          url: baseUrlAdmin+'getshipdays/'+shippingid,
          cache: false,
          success: function(rText){
					if(rText){
				
                		document.getElementById("shippingvalue").value = rText;
                		
                	}else{
                		document.getElementById("shippingvalue").value = 0;
                	}
                	
                	makeestimatedshippingdate();
			calculateestdeliverydate();
          }
  });
	  
}


function getprojecttypedays(projectypeid) {
	   
	 document.getElementById("projecttypevalue").value = "";
	  jQuery.ajax({
         type: "GET",
         url: baseUrlAdmin+'getprojecttypedays/'+projectypeid,
         cache: false,
         success: function(rText){
               	if(rText){
               		document.getElementById("projecttypevalue").value = rText;
               		
               	}else{
               		document.getElementById("projecttypevalue").value = "";
               	}
               	//makeestimatedshippingdate();
         }
 });
	  
}


function getproducttypedays(pricetypeoptionsid) {
   
     document.getElementById("producttypedeliverydays").value = "";
      jQuery.ajax({
         type: "GET",
         url: baseUrlAdmin+'getproducttypedays/'+pricetypeoptionsid,
         cache: false,
         success: function(rText){

				   if(rText){
					    document.getElementById("producttypedeliverydays").value = rText;
                        makeestimatedshippingdate();
                        calculateestdeliverydate();
                   }else{
                       document.getElementById("producttypedeliverydays").value = "";
                   }
                   //makeestimatedshippingdate();
         }
 });
      
}

/**
* Fucntion to calculate Est Ship Date based on Order date + selected produts default delivery days
*/
function makeestimatedshippingdate(){
	
		var orderchipcodate = document.getElementById("datesubmitchipco").value;
	//alert(orderchipcodate);
		var shippingvalue = document.getElementById("producttypedeliverydays").value;
	//alert(shippingvalue);	//var shippingvalue = document.getElementById("shippingvalue").value;
		if(shippingvalue && orderchipcodate){
			var splarr = orderchipcodate.split("-");
			var spldate = splarr[0]+"-"+splarr[1]+"-"+splarr[2];
			
			var totalDate = new Date();
			totalDate.setYear(splarr[2]);
			totalDate.setMonth(splarr[0]-1);
			totalDate.setDate(splarr[1]);
			totalDate.setDate(totalDate.getDate()+parseInt(shippingvalue));			
			var now = new Date(totalDate);
			var curr_date = now.getDate();
				if(curr_date < 10){
					var curr_date = '0'+curr_date;
				}
			var curr_month = (now.getMonth()+1);

				if(curr_month < 10){
					var curr_month = '0'+curr_month;
				}
			var curr_year = now.getFullYear()
			document.getElementById("dateestship").value = curr_month+'-'+curr_date+'-'+curr_year;
		}else{
			document.getElementById("dateestship").value = '';
			return false;
		}
	
}

/**
* Fucntion to calculate Est Delivery Date based on Order date + selected produts default delivery days + Shipping days
*/
function calculateestdeliverydate(){
	
	var orderchipcodate = document.getElementById("datesubmitchipco").value;
	var shippingvalue = parseInt(document.getElementById("producttypedeliverydays").value)+parseInt(document.getElementById("shippingvalue").value);
	if(shippingvalue && orderchipcodate){
		var splarr = orderchipcodate.split("-");
		var spldate = splarr[0]+"-"+splarr[1]+"-"+splarr[2];
		
			var totalDate = new Date();
			totalDate.setYear(splarr[2]);
			totalDate.setMonth(splarr[0]-1);
			totalDate.setDate(splarr[1]);
		totalDate.setDate(totalDate.getDate()+parseInt(shippingvalue));
		
		var now = new Date(totalDate);

		var curr_date = now.getDate();
			if(curr_date < 10){
				var curr_date = '0'+curr_date;
			}
		var curr_month = (now.getMonth()+1);
			if(curr_month < 10){
				var curr_month = '0'+curr_month;
			}
		var curr_year = now.getFullYear()


		document.getElementById("dateestdelivery").value = curr_month+'-'+curr_date+'-'+curr_year;
	}else{
		document.getElementById("dateestdelivery").value = '';
		return false;
	}
}

function copycontacts(){ 
	dropdown = document.getElementById('emaillists');

			var existlist = document.getElementById('toid').value;
		var existlistarr = existlist.split(",");
			var str ='';
		var chk = '';
			for(var i=0; i<dropdown.length; i++){
				if(dropdown[i].selected == true){ 
				chk = '';		
				for(j=0;j<existlistarr.length;j++){
					
					if(existlistarr[j]==dropdown[i].value){
						chk ='set'; 
						break;
					}
				}
				
				if(chk!=''){
					continue;	
				}else{
						str += dropdown[i].value+',';	
				}
					
				}
			}
			
		str = trim(str,",");
		document.getElementById('toid').value = trim(trim(document.getElementById('toid').value,',')+","+str,",");

}

function getcompanyaddress(companyid) {

   jQuery.ajax({
         type: "GET",
         url: baseUrlAdmin+'getcompanyaddressbyid/'+companyid,
         cache: false,
         success: function(rText){

				if(rText){
               			document.getElementById("companydata").innerHTML = rText;
            
               	}else{
               		
               	}
               
         }
 });
	  
}

function putcountryaddress(){

	if(document.getElementById("sameascompany").checked==true){

		if(document.getElementById("tempaddress1")){
			document.getElementById("tempaddress1").value = document.getElementById("address1").value;
		}
		if(document.getElementById("tempcity")){
			document.getElementById("tempcity").value = document.getElementById("city").value;
		}
		if(document.getElementById("tempstate")){
			document.getElementById("tempstate").value = document.getElementById("state").value;
		}
		if(document.getElementById("tempcountry")){
			document.getElementById("tempcountry").value = document.getElementById("country").value;
		}
		if(document.getElementById("tempzipcode")){
			document.getElementById("tempzipcode").value = document.getElementById("zipcode").value;
		}	
		
		if(document.getElementById("companyaddress1")){
			document.getElementById("address1").value = document.getElementById("companyaddress1").value;
		}
		if(document.getElementById("companycity")){
			document.getElementById("city").value = document.getElementById("companycity").value;
		}
		if(document.getElementById("companystate")){
			document.getElementById("state").value = document.getElementById("companystate").value;
		}
		if(document.getElementById("companycountry")){
			document.getElementById("country").value = document.getElementById("companycountry").value;
		}
		if(document.getElementById("companyzipcode")){
			document.getElementById("zipcode").value = document.getElementById("companyzipcode").value;
		}
	}else{
		
		
		if(document.getElementById("tempaddress1")){
			document.getElementById("address1").value = document.getElementById("tempaddress1").value;
		}
		if(document.getElementById("tempcity")){
			document.getElementById("city").value = document.getElementById("tempcity").value;
		}
		if(document.getElementById("tempstate")){
			document.getElementById("state").value = document.getElementById("tempstate").value;
		}
		if(document.getElementById("tempcountry")){
			document.getElementById("country").value = document.getElementById("tempcountry").value;
		}
		if(document.getElementById("tempzipcode")){
			document.getElementById("zipcode").value = document.getElementById("tempzipcode").value;
		
		}
		
	}
}

function validateprojectdetail(tabsection){
		if(tabsection=='0'){
			
			/*if($('#serialprefix').val() == '')
			 {
				 inlineMsg('serialprefix','<strong>Please provide Serial # Prefix.</strong>',2);
				 return false; 
			 }*/
			if(hasWhiteSpace($('#serialprefix').val()) == true){
				 inlineMsg('serialprefix','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
			if(isalphanumerice($('#serialprefix').val()) == false){
				 inlineMsg('serialprefix','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
			if($('#serialprefix').val() != '' && $('#serialprefix').val().length < 3 || $('#serialprefix').val().length > 3)
			 {
				 inlineMsg('serialprefix','<strong>Minimum/Maximum 3 alpha numeric character allowed.</strong>',2);
				 return false; 
			 }
			if(tagValidate($('#serialprefix').val()) == true){
				 inlineMsg('serialprefix','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			if(tagValidate($('#url').val()) == true){
				 inlineMsg('url','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			if(tagValidate($('#notes').val()) == true){
				 inlineMsg('notes','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			return true;
		}
		if(tabsection=='1'){
			
			if($('#sidea').val() !=''  && validateimageuploading($('#sidea').val())==false){
				inlineMsg('sidea','<strong> Please upload image file type (jpg,jpeg,gif,png).</strong>',2);
				$('#sidea').val("");
				 return false; 
			}
			if($('#sideb').val() !=''  && validateimageuploading($('#sideb').val())==false){
				inlineMsg('sideb','<strong> Please upload image file type (jpg,jpeg,gif,png).</strong>',2);
				$('#sideb').val("");
				 return false; 
			}
			if($('#logo').val() !=''  && validateimageuploading($('#logo').val())==false){
				inlineMsg('logo','<strong> Please upload image file type (jpg,jpeg,gif,png).</strong>',2);
				$('#logo').val("");
				 return false; 
			}
			
			if(tagValidate($('#sideadesc').val()) == true){
				 inlineMsg('sideadesc','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			if(tagValidate($('#sidebdesc').val()) == true){
				 inlineMsg('sidebdesc','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			if(tagValidate($('#edgedesc').val()) == true){
				 inlineMsg('edgedesc','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			return true;
		}
		if(tabsection=='editdesc'){
			
			
			if($('#titleshortdescription').val() == '')
			 {
				 inlineMsg('titleshortdescription','<strong>Please provide Title.</strong>',2);
				 return false; 
			 }
			if(hasWhiteSpace($('#titleshortdescription').val()) == true){
				 inlineMsg('titleshortdescription','<strong>Please dont use blank space.</strong>',2);
				 return false; 
			}
			if(tagValidate($('#titleshortdescription').val()) == true){
				 inlineMsg('titleshortdescription','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			
			if($('#titlelongdescription').val() == '')
			 {
				 inlineMsg('titlelongdescription','<strong>Please provide Title.</strong>',2);
				 return false; 
			 }
			if(hasWhiteSpace($('#titlelongdescription').val()) == true){
				 inlineMsg('titleshortdescription','<strong>Please dont use blank space.</strong>',2);
				 return false; 
			}
			if(tagValidate($('#titlelongdescription').val()) == true){
				 inlineMsg('titleshortdescription','<strong>Please dont use script tags.</strong>',2);
				 return false; 
			}
			
			return true;
		}
		
		
}

function validateimageuploading(elementvalue){
	 
	var imagePath = elementvalue;
	var pathLength = imagePath.length;
	var lastDot = imagePath.lastIndexOf(".");
	var fileType = imagePath.substring(lastDot,pathLength);

	var ext = new Array('.jpg','.jpeg','.gif','.png');
	var set = '';
	for(i=0;i<ext.length;i++){
		if(fileType.toLowerCase()==ext[i]){
			set='valid';
		}
	}
	if(set==''){
		return false;
	}
	return true;
}

function validateuserdetail()
{
	if($('#username').val() == '')
	{
		inlineMsg('username','<strong>Please provide User name.</strong>',2);
		return false; 
	}
	if(hasWhiteSpace($('#username').val()) == true){
		inlineMsg('username','<strong>Please dont use of blank space.</strong>',2);
		return false; 
	}
	if($('#username').val().length <= 4)
	{
		inlineMsg('username','<strong>User name length should be greater then 4.</strong>',2);
		return false; 
	}
	if(tagValidate($('#username').val()) == true){
		inlineMsg('username','<strong>Please dont use script tags.</strong>',2);
		return false; 
	}

	
	if($('#password').val() == '')
	{
		inlineMsg('password','<strong>Please provide Password.</strong>',2);
		return false; 
	}
	if(hasWhiteSpace($('#password').val()) == true){
		inlineMsg('password','<strong>Please dont use of blank space.</strong>',2);
		return false; 
	}
	if($('#password').val().length <= 4)
	{
		inlineMsg('password','<strong>Password length should be greater then 4.</strong>',2);
		return false; 
	}
	if(tagValidate($('#password').val()) == true){
		inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
		return false; 
	}
	return true;
}

function validatesponsordtl(actionfor){
// 		if(actionfor=='add'){
// 			
// 			if($('#username').val() == '')
// 			 {
// 				 inlineMsg('username','<strong>Please provide User name.</strong>',2);
// 				 return false; 
// 			 }
// 			if(hasWhiteSpace($('#username').val()) == true){
// 				 inlineMsg('username','<strong>Please dont use of blank space.</strong>',2);
// 				 return false; 
// 			}
// 			if($('#username').val().length <= 4)
// 			 {
// 				 inlineMsg('username','<strong>User name length should be greater then 4.</strong>',2);
// 				 return false; 
// 			 }
// 			if(tagValidate($('#username').val()) == true){
// 				 inlineMsg('username','<strong>Please dont use script tags.</strong>',2);
// 				 return false; 
// 			}
// 
// 			
// 			if($('#password').val() == '')
// 			 {
// 				 inlineMsg('password','<strong>Please provide Password.</strong>',2);
// 				 return false; 
// 			 }
// 			if(hasWhiteSpace($('#password').val()) == true){
// 				 inlineMsg('password','<strong>Please dont use of blank space.</strong>',2);
// 				 return false; 
// 			}
// 			if($('#password').val().length <= 4)
// 			 {
// 				 inlineMsg('password','<strong>Password length should be greater then 4.</strong>',2);
// 				 return false; 
// 			 }
// 			if(tagValidate($('#password').val()) == true){
// 				 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
// 				 return false; 
// 			}
// 			
// 			
// 			if($('#sponsor_name').val() == '')
// 			 {
// 				 inlineMsg('sponsor_name','<strong>Please provide Sponsor Name.</strong>',2);
// 				 return false; 
// 			 }
// 			if(hasWhiteSpace($('#sponsor_name').val()) == true){
// 				 inlineMsg('sponsor_name','<strong>Please dont use of blank space.</strong>',2);
// 				 return false; 
// 			}
// 			if(tagValidate($('#sponsor_name').val()) == true){
// 				 inlineMsg('sponsor_name','<strong>Please dont use script tags.</strong>',2);
// 				 return false; 
// 			}
// 			
// 		}
// 		if(actionfor=='edit'){
// 			
// 			if($('#password').val() != ''){
// 				
// 					if(hasWhiteSpace($('#password').val()) == true){
// 						 inlineMsg('password',"<strong>Please dont use of blank space.</strong>",2);
// 						 return false; 
// 					}
// 					if($('#password').val().length <= 4)
// 					 {
// 						 inlineMsg('password','<strong>Password length should be greater then 4.</strong>',2);
// 						 return false; 
// 					 }
// 					if(tagValidate($('#password').val()) == true){
// 						 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
// 						 return false; 
// 					}
// 			}	
// 			
// 		}

		if($('#sponsor_name').val() == '')
		{
			inlineMsg('sponsor_name','<strong>Please provide Sponsor Name.</strong>',2);
			return false; 
		}
		if(hasWhiteSpace($('#sponsor_name').val()) == true){
			inlineMsg('sponsor_name','<strong>Please dont use of blank space.</strong>',2);
			return false; 
		}
		if(tagValidate($('#sponsor_name').val()) == true){
			inlineMsg('sponsor_name','<strong>Please dont use script tags.</strong>',2);
			return false; 
		}
		
		if($('#email').val() == '')
		 {
			 inlineMsg('email','<strong>Please provide Sponsor Email.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#email').val()) == true){
			 inlineMsg('email',"<strong>Please dont use blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#email').val()) == true){
			 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		if(validateemail($('#email').val()) == false){
			 inlineMsg('email',"<strong>Please enter valid email.</strong>",2);
			 return false; 
		}
		
		if($('#address1').val() == '')
		 {
			 inlineMsg('address1','<strong>Please provide Address 1.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#address1').val()) == true){
			 inlineMsg('address1',"<strong>Please dont use of blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#address1').val()) == true){
			 inlineMsg('address1','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		
		if($('#country').val() == '')
		 {
			 inlineMsg('country','<strong>Please select Country.</strong>',2);
			 return false; 
		 }
		if($('#state').val() == '')
		 {
			 inlineMsg('state','<strong>Please select State.</strong>',2);
			 return false; 
		 }
		if($('#city').val() == '')
		 {
			 inlineMsg('city','<strong>Please enter City.</strong>',2);
			 return false; 
		 }
		if($('#zipcode').val() == '')
		 {
			 inlineMsg('zipcode','<strong>Please provide Zip/Postal Code.</strong>',2);
			 return false; 
		 }
		
		if($('#logo').val() !=''  && validateimageuploading($('#logo').val())==false){
			inlineMsg('logo','<strong> Please upload image file type (jpg,jpeg,gif,png).</strong>',2);
			$('#logo').val("");
			 return false; 
		}
		
		return true;
}

function validatesponsordescription(){
	
	if($('#titleshortdescription').val() == '')
	 {
		 inlineMsg('titleshortdescription','<strong>Please provide Title.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#titleshortdescription').val()) == true){
		 inlineMsg('titleshortdescription','<strong>Please dont use blank space.</strong>',2);
		 return false; 
	}
	if(tagValidate($('#titleshortdescription').val()) == true){
		 inlineMsg('titleshortdescription','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	
	if($('#titlelongdescription').val() == '')
	 {
		 inlineMsg('titlelongdescription','<strong>Please provide Title.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#titlelongdescription').val()) == true){
		 inlineMsg('titleshortdescription','<strong>Please dont use blank space.</strong>',2);
		 return false; 
	}
	if(tagValidate($('#titlelongdescription').val()) == true){
		 inlineMsg('titleshortdescription','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	
	return true;
}

function validatecompany(actionfor){
	
		
		if($('#company_type_id').val() == '')
		 {
			 inlineMsg('company_type_id','<strong>Please select Company Type.</strong>',2);
			 return false; 
		 }
		
		if($('#company_name').val() == '')
		 {
			 inlineMsg('company_name','<strong>Please provide Company Name.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#company_name').val()) == true){
			 inlineMsg('company_name',"<strong>Please dont use of blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#company_name').val()) == true){
			 inlineMsg('company_name','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		
		
		if($('#address1').val() == '')
		 {
			 inlineMsg('address1','<strong>Please provide Address 1.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#address1').val()) == true){
			 inlineMsg('address1',"<strong>Please dont use of blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#address1').val()) == true){
			 inlineMsg('address1','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		
		if($('#country').val() == '')
		 {
	
			 inlineMsg('country','<strong>Please select Country.</strong>',2);
			 return false; 
		 }
		if($('#state').val() == '')
		 {
			 //alert($('#country').val());
			 inlineMsg('state','<strong>Please select State.</strong>',2);
			 return false; 
		 }
		if($('#city').val() == '')
		 {
			 inlineMsg('city','<strong>Please select City.</strong>',2);
			 return false; 
		 }
		if($('#zipcode').val() == '')
		 {
			 inlineMsg('zipcode','<strong>Please provide Zip/Postal Code.</strong>',2);
			 return false; 
		 }
		
		if($('#zipcode').val().length < 5)
		 {
			 inlineMsg('zipcode','<strong>Zip Code must have five digits.</strong>',2);
			 return false;
			
		 }
		else
                 {
				var zipCodePattern = /^\d{5}$|^\d{5}-\d{4}$/;
				var ziptest=zipCodePattern.test($('#zipcode').val());
				if($('#country').val()==254 && ziptest==false)
				{
							
	
					inlineMsg('zipcode','<strong>Please provide US Zip Code.</strong>',2);
					return false;	
				}
				if($('#zipcode').val().length > 9){
				 inlineMsg('zipcode','<strong>Zip Code not have more than Nine digits.</strong>',2);
				 return false;
				 }
		}
		if($('#email').val() == '')
		 {
			 inlineMsg('email','<strong>Please provide Sponsor Email.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#email').val()) == true){
			 inlineMsg('email',"<strong>Please dont use blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#email').val()) == true){
			 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		if(validateemail($('#email').val()) == false){
			 inlineMsg('email',"<strong>Please enter valid email.</strong>",2);
			 return false; 
		}
		
		
		if($('#phone').val() !=''  && ParseUSNumber($('#phone').val())==false){
			inlineMsg('phone','<strong>Please use valid phone format.</strong>',2);
			 return false; 
		}
		if($('#fax').val() !=''  && ParseUSNumber($('#fax').val())==false){
			inlineMsg('fax','<strong>Please use valid fax format.</strong>',2);
			 return false; 
		}
		
		if($('#logo').val() !=''  && validateimageuploading($('#logo').val())==false){
			inlineMsg('logo','<strong> Please upload image file type (jpg,jpeg,gif,png).</strong>',2);
			$('#logo').val("");
			 return false; 
		}
		
		return true;
}

function validatecontacts(actionfor){
	
	
	if($('#company_id').val() == '')
	 {
		 inlineMsg('company_id','<strong>Please select Company.</strong>',2);
		 return false; 
	 }
	if($('#contact_type_id').val() == '')
	 {
		 inlineMsg('contact_type_id','<strong>Please select Contact Type.</strong>',2);
		 return false; 
	 }
	if($('#jobtitle').val() == '')
	 {
		 inlineMsg('jobtitle','<strong>Please provide Title.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#jobtitle').val()) == true){
		 inlineMsg('jobtitle',"<strong>Please dont use of blank space.</strong>",2);
		 return false; 
	}
	if(tagValidate($('#jobtitle').val()) == true){
		 inlineMsg('jobtitle','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	
	if($('#firstname').val() == '')
	 {
		 inlineMsg('firstname','<strong>Please provide First Name.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#firstname').val()) == true){
		 inlineMsg('firstname',"<strong>Please dont use of blank space.</strong>",2);
		 return false; 
	}
	if(tagValidate($('#firstname').val()) == true){
		 inlineMsg('firstname','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	
	if($('#lastname').val() == '')
	 {
		 inlineMsg('lastname','<strong>Please provide Last Name.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#lastname').val()) == true){
		 inlineMsg('lastname',"<strong>Please dont use of blank space.</strong>",2);
		 return false; 
	}
	if(tagValidate($('#lastname').val()) == true){
		 inlineMsg('lastname','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	var oRex = /^\(?([0-9]{3})+\)?[\-\s]?([0-9]{3})+[\-\s]?([0-9]{4})+$/; 
	if($('#busphone').val() !=''  && oRex.test($('#busphone').val())==false){
		inlineMsg('busphone','<strong>Please use valid phone format.</strong>',2);
		 return false; 
	}
	if($('#fax').val() !=''  && oRex.test($('#fax').val())==false){
		inlineMsg('fax','<strong>Please use valid fax format.</strong>',2);
		 return false; 
	}
	if($('#mobile').val() !=''  && oRex.test($('#mobile').val())==false){
		inlineMsg('mobile','<strong>Please use valid Cell Phone number format.</strong>',2);
		 return false; 
	}
	
	

	if($('#email').val() == '')
	 {
		 inlineMsg('email','<strong>Please provide Sponsor Email.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#email').val()) == true){
		 inlineMsg('email',"<strong>Please dont use blank space.</strong>",2);
		 return false; 
	}
	if(tagValidate($('#email').val()) == true){
		 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	if(validateemail($('#email').val()) == false){
		 inlineMsg('email',"<strong>Please enter valid email.</strong>",2);
		 return false; 
	}
	
	if($('#address1').val() == '')
	 {
		 inlineMsg('address1','<strong>Please provide Address 1.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#address1').val()) == true){
		 inlineMsg('address1',"<strong>Please dont use of blank space.</strong>",2);
		 return false; 
	}
	if(tagValidate($('#address1').val()) == true){
		 inlineMsg('address1','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	
	if($('#country').val() == '')
	 {
		 inlineMsg('country','<strong>Please select Country.</strong>',2);
		 return false; 
	 }
	if($('#state').val() == '')
	 {
		 inlineMsg('state','<strong>Please select State.</strong>',2);
		 return false; 
	 }
	if($('#city').val() == '')
	 {
		 inlineMsg('city','<strong>Please select City.</strong>',2);
		 return false; 
	 }
	if($('#zipcode').val() == '')
	 {
		 inlineMsg('zipcode','<strong>Please provide Zip/Postal Code.</strong>',2);
		 return false; 
	 }
	
		if($('#zipcode').val().length < 5)
		 {
			 inlineMsg('zipcode','<strong>Zip Code must have five digits.</strong>',2);
			 return false;
					 
		 }
		else
                 {
				var zipCodePattern = /^\d{5}$|^\d{5}-\d{4}$/;
				var ziptest=zipCodePattern.test($('#zipcode').val());
				if($('#country').val()==254 && ziptest==false)
				{
							
	
					inlineMsg('zipcode','<strong>Please provide US Zip Code.</strong>',2);
					return false;	
				}
				if($('#zipcode').val().length > 9){
				 inlineMsg('zipcode','<strong>Zip Code not have more than Nine digits.</strong>',2);
				 return false;
				 }
		}
	
	return true;
}


function validateholders()
{
	if($('#email').val() == '')
	 {
		 inlineMsg('email','<strong>Please provide Sponsor Email.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#email').val()) == true){
		 inlineMsg('email',"<strong>Please dont use blank space.</strong>",2);
		 return false; 
	}
	if(tagValidate($('#email').val()) == true){
		 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	if(validateemail($('#email').val()) == false){
		 inlineMsg('email','<strong>Please enter valid email.</strong>',2);
		 return false; 
	}
	if($('#password').val() == '')
	 {
		 inlineMsg('password','<strong>Please provide Password.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#password').val()) == true){
		 inlineMsg('password','<strong>Please dont use of blank space.</strong>',2);
		 return false; 
	}
	if($('#password').val().length <= 4)
	 {
		 inlineMsg('password','<strong>Password length should be greater then 4.</strong>',2);
		 return false; 
	 }
	if(tagValidate($('#password').val()) == true){
		 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}	
	if($('#screenname').val() == '')
	{
		 inlineMsg('screenname','<strong>Please provide Screen Name.</strong>',2);
		 return false; 
	}
	if(hasWhiteSpace($('#screenname').val()) == true){
		 inlineMsg('screenname','<strong>Please dont use of blank space.</strong>',2);
		 return false; 
	}
	if($('#firstname').val() == '')
	{
		 inlineMsg('firstname','<strong>Please provide First Name.</strong>',2);
		 return false; 
	}
	if(hasWhiteSpace($('#firstname').val()) == true){
		 inlineMsg('firstname','<strong>Please dont use of blank space.</strong>',2);
		 return false; 
	}
	if($('#lastnameshow').val() == '')
	{
		 inlineMsg('lastnameshow','<strong>Please provide Last Name.</strong>',2);
		 return false; 
	}
	if(hasWhiteSpace($('#lastnameshow').val()) == true){
		 inlineMsg('lastnameshow','<strong>Please dont use of blank space.</strong>',2);
		 return false; 
	}
	if($('#zipcode').val() == '')
	{
		 inlineMsg('zipcode','<strong>Please provide Zip/Postal Code.</strong>',2);
		 return false; 
	}
	if($('#zipcode').val().length < 5)
	 {
			 inlineMsg('zipcode','<strong>Zip Code must have five digits.</strong>',2);
			 return false;
					 
	 }
	else
            {
				var zipCodePattern = /^\d{5}$|^\d{5}-\d{4}$/;
				var ziptest=zipCodePattern.test($('#zipcode').val());
				if($('#country').val()==254 && ziptest==false)
				{
							
	
					inlineMsg('zipcode','<strong>Please provide US Zip Code.</strong>',2);
					return false;	
				}
				if($('#zipcode').val().length > 9){
				 inlineMsg('zipcode','<strong>Zip Code not have more than Nine digits.</strong>',2);
				 return false;
				 }
		}
	if($('#birthday').val() != '')
	{
		var d = new Date();
		//var dateval=
		var curr_date = d.getDate();
		var curr_month = d.getMonth() + 1; //months are zero based
		var curr_year = d.getFullYear();
		var splitvar = ($('#birthday').val()).split('-');
		if(splitvar[2] >= curr_year){
		if( splitvar[0]>=curr_month ){
		if(splitvar[1]>=curr_date)
		{
		inlineMsg('birthday','<strong>Birthday Date not exist in Future.</strong>',2);
		return false;
		}
		}
		}
	}	
	
	

}
function validateholder(actionfor){

	if(actionfor=='add'){
		
		if($('#username').val() == '')
		 {
			 inlineMsg('username','<strong>Please provide User name.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#username').val()) == true){
			 inlineMsg('username',"<strong>Please dont use of blank space.</strong>",2);
			 return false; 
		}
		if($('#username').val().length <= 4)
		 {
			 inlineMsg('username','<strong>User name length should be greater then 4.</strong>',2);
			 return false; 
		 }
		if(tagValidate($('#username').val()) == true){
			 inlineMsg('username','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}

		
		if($('#password').val() == '')
		 {
			 inlineMsg('password','<strong>Please provide Password.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#password').val()) == true){
			 inlineMsg('password',"<strong>Please dont use of blank space.</strong>",2);
			 return false; 
		}
		if($('#password').val().length <= 4)
		 {
			 inlineMsg('password','<strong>Password length should be greater then 4.</strong>',2);
			 return false; 
		 }
		if(tagValidate($('#password').val()) == true){
			 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		
	}
		
		if(actionfor=='edit'){
			
			if($('#password').val() != ''){
				
					if(hasWhiteSpace($('#password').val()) == true){
						 inlineMsg('password',"<strong>Please dont use of blank space.</strong>",2);
						 return false; 
					}
					if($('#password').val().length <= 4)
					 {
						 inlineMsg('password','<strong>Password length should be greater then 4.</strong>',2);
						 return false; 
					 }
					if(tagValidate($('#password').val()) == true){
						 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
						 return false; 
					}
			}
		
			
		}
		
		
		if($('#email').val() == '')
		 {
			 inlineMsg('email','<strong>Please provide Sponsor Email.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#email').val()) == true){
			 inlineMsg('email',"<strong>Please dont use blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#email').val()) == true){
			 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		if(validateemail($('#email').val()) == false){
			 inlineMsg('email',"<strong>Please enter valid email.</strong>",2);
			 return false; 
		}
		
		
		if($('#firstname').val() == '')
		 {
			 inlineMsg('firstname','<strong>Please provide First Name.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#firstname').val()) == true){
			 inlineMsg('firstname',"<strong>Please dont use of blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#firstname').val()) == true){
			 inlineMsg('firstname','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		
		if($('#lastnameshow').val() == '')
		 {
			 inlineMsg('lastnameshow','<strong>Please provide Last Name.</strong>',2);
			 return false; 
		 }
		if(hasWhiteSpace($('#lastnameshow').val()) == true){
			 inlineMsg('lastnameshow',"<strong>Please dont use of blank space.</strong>",2);
			 return false; 
		}
		if(tagValidate($('#lastnameshow').val()) == true){
			 inlineMsg('lastnameshow','<strong>Please dont use script tags.</strong>',2);
			 return false; 
		}
		
		
		
		if($('#country').val() == '')
		 {
			 inlineMsg('country','<strong>Please select Country.</strong>',2);
			 return false; 
		 }
		if($('#state').val() == '')
		 {
			 inlineMsg('state','<strong>Please select State.</strong>',2);
			 return false; 
		 }
		if($('#city').val() == '')
		 {
			 inlineMsg('city','<strong>Please select City.</strong>',2);
			 return false; 
		 }
		if($('#zipcode').val() == '')
		 {
			 inlineMsg('zipcode','<strong>Please provide Zip/Postal Code.</strong>',2);
			 return false; 
		 }
		if(ParseUSNumber($('#phone').val())==false){
			inlineMsg('phone','<strong>Please use valid phone format.</strong>',2);
			//alert("haha");
			 return false; 
		}
		
		
		return true;
}

function validatemailcontent(actionfor){

	
	if($('#email_template_name').val() == '')
	 {
		 inlineMsg('email_template_name','<strong>Please provide Template Name.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#email_template_name').val()) == true){
		 inlineMsg('email_template_name','<strong>Please dont use blank space.</strong>',2);
		 return false; 
	}
	if(tagValidate($('#email_template_name').val()) == true){
		 inlineMsg('email_template_name','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	
	if($('#subject').val() == '')
	 {
		 inlineMsg('subject','<strong>Please provide Subject.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#subject').val()) == true){
		 inlineMsg('subject','<strong>Please dont use blank space.</strong>',2);
		 return false; 
	}
	if(tagValidate($('#subject').val()) == true){
		 inlineMsg('subject','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}

	if($('#sender').val() == '')
	 {
		 inlineMsg('sender','<strong>Please provide Sender.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#sender').val()) == true){
		 inlineMsg('sender','<strong>Please dont use blank space.</strong>',2);
		 return false; 
	}
	if(tagValidate($('#sender').val()) == true){
		 inlineMsg('sender','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
    if(validateemail($('#sender').val()) == false){
             inlineMsg('sender',"<strong>Please enter valid sender email.</strong>",2);
             return false; 
    }
    
    if($('#send_cc_email_to').val() != '')
     {
          var emails=$('#send_cc_email_to').val();
          var result = emails.split(","); 
          for(var i = 0;i < result.length;i++){
                if(validateemail(result[i])== false){
                    inlineMsg('send_cc_email_to','<strong>Please provide valid comma separated cc emails.</strong>',2);
                    return false;
                } 
                   
          } 
    }
        
	
	return true;
	
}
// delete record confirmation msg.
function delete_record()
{
    doIt=confirm('Do you want to delete this record.');  
    if(doIt){
                   return confirm('This record will be PERMANENTLY deleted.  Are you sure you want to delete this record?');
                  
            }
    return doIt;

    
}

function setURL(key, value) {
  // set up the url separators
  var separator = {
    // site.url/controller/action/key1:value1/key2:value2
    'key': '&',
    'value': '='
  }
 
  // get the current url
  var url = window.location.href;
  // check if the specified key already exists
  var exists = url.indexOf(separator.key + key + separator.value);
 
  // if it does
  if (exists > -1) {
    // find the next separator.key
    var last = url.indexOf(separator.key, exists + 1);
 
    // if there is one
    if (last > -1) {
      // replcae the existing value with the one passed
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value) + url.substr(last);
 
    // if not
    } else {
      // just append it
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value);
    }
 
  // if it's not already in there
  } else {
    // if the URL doesn't end with a separator.key
    if (url.substr(-1) != separator.key) {
      // append it
      url += separator.key;
    }
 
    // append the value
    url += key + separator.value + escape(value);
  }
  
  // set the url
  window.location.href = url;

}


function yesact()
{
disablePopup();

checkcoinset=true;
flag=false;
validatecoinset('add');
}
function noact()
{
disablePopup();
this.document.getElementById('addcoinset').submit();
//alert("submitted");
}


function getemailtemplatesbyajax(projectid,eleid, selectedid,extra) {    
       if(projectid==""){
          return false;
       }
       var url_text="";
       
       if(selectedid==""){
          selectedid=0;
       }

       if(extra)
        url_text=baseUrlAdmin+'getemailtemplatesbyajax/'+projectid+'/'+selectedid+'/'+extra
       else
        url_text=baseUrlAdmin+'getemailtemplatesbyajax/'+projectid+'/'+selectedid;
      
       jQuery.ajax({
             type: "GET",
             url: url_text,
             cache: false,
             success: function(rText){
                    jQuery('#'+eleid).html(rText);
             }
     });
      
}

function getcompanytypesbyajax(projectid,eleid, selectedid) {    
       if(projectid==""){
          return false;
       }

       jQuery.ajax({
             type: "GET",
             url: '/admins/getcompanytypesbyajax/'+projectid+'/'+selectedid,
             cache: false,
             success: function(rText){
                    jQuery('#'+eleid).html(rText);
             }
     });
      
}

function getcontacttypesbyajax(projectid,eleid, selectedid) {    
       if(projectid==""){
          return false;
       }

       jQuery.ajax({
             type: "GET",
             url: '/admins/getcontacttypesbyajax/'+projectid+'/'+selectedid,
             cache: false,
             success: function(rText){
                    jQuery('#'+eleid).html(rText);
             }
     });
      
}

//========================================================================================//
//================================End=====================================================//
//========================================================================================//
 

 
function validateStatusType(type){
   
	if(type == "add"){
		if($('#status_type').val() == '')
		 {
			 inlineMsg('status_type','<strong>Please provide status type</strong>',2);
			 return false;
		 }
	}else if (part == "edit"){
		
		
	}else{
		return false;
	}
}

function validateDeclineSuspendType(){
	if($('#typename').val() == '') {
		 inlineMsg('typename','<strong>Please enter decline/suspend type name</strong>',2);
		 return false;
	}
	//$('#Decline').is(':checked');
	//$('#Suspend').is(':checked')== false )
	if ( ( $('#DeclineSuspendTypeTypeCategoryDecline').is(':checked') == false ) && ( $('#DeclineSuspendTypeTypeCategorySuspend').is(':checked') == false ) ) {
		inlineMsg('DeclineSuspendTypeTypeCategorySuspend','<strong>Please select one category</strong>',2);
		return false;
	}
}

function validateBorderFooter(){
	if($('#border_footer_name').val() == '') {
		 inlineMsg('border_footer_name','<strong>Please enter border footer name</strong>',2);
		 return false;
	}
	
	var dmod = $('#modified').val();
	// regular expression to match required date format
    re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
	if(dmod == '') {
		inlineMsg('modified','<strong>Please enter date</strong>',2);
		return false;
	} else if(dmod != '' && !dmod.match(re)) {
		inlineMsg('modified','<strong>Please enter valid date format(dd/mm/yyyy)</strong>',2);
		return false;
	}
}

function validateVersionAdd(){
	if($('#system_version_name').val() == '') {
		 inlineMsg('system_version_name','<strong>Please enter border footer name</strong>',2);
		 return false;
	}
}

function sendToProjectDashboard(projectid){
	//document.getElementById('projectid').value= projectid;
	//document.adminhome.submit();
	if(projectid == 'undefined' || projectid == '' || projectid == null )
	return false;
	var redirectionURL = baseUrlAdmin+"project_redirection";
	$.ajax({
	  type: "POST",
	  url: redirectionURL,
	  data: {id : projectid},
	  success: function(data) {
		window.location = baseUrlAdmin + "projectdashboard";
	  }
	});
}

