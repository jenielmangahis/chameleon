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
	document.getElementById("loadingdivimg").style.display="block";	
	$.ajax({
			type: "GET",
			cache: false,
			url: '/admins/ajaxpwdcheck/'+pwd,
			success: function(updatediv1){
				document.getElementById("updatediv1").innerHTML="";
				document.getElementById("updatediv1").style.display = 'none';
				$("#updatediv1").html(trim(updatediv1));
				document.getElementById("loadingdivimg").style.display="none";
				if(document.getElementById('pswd') && document.getElementById('pswd').value == 0)
				{
					document.getElementById("updatediv1").style.display = 'block';
					document.getElementById("Submit").disabled=true;
					return false;
				}
				
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
 * Function name   : validateprojecttype()
 * Description     : This function is used for validation of project type (add/edit)
 * Created On      : 16-02-2011 (02:10am)
 *
 */

function validateprojecttype(part){
   
	
     if($('#typename').val() == '')
	 {
		 inlineMsg('typename','<strong>Please provide Project Type</strong>',2);
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

	if($('#email_template_id').val() == '0')
	 {
		 inlineMsg('email_template_id','<strong>Please provide  Email Template</strong>',2);
		 return false;
	 }

	 if(tagValidate($('#task_name').val()) == true){
		 inlineMsg('task_name','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
     
	 if($('#startdate').val() == '')
	 {
		 inlineMsg('startdate','<strong>Please provide Start date</strong>',2);
		 return false;
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
		if(isalphanumerice($('#project_name').val()) == false){
			 inlineMsg('project_name','<strong>Project Name should alphanumeric only.</strong>',2);
			 return false; 
		 }
		 if(tagValidate($('#project_name').val()) == true){
			 inlineMsg('project_name','<strong>Please dont use script tags.</strong>',2);
			 return false; 
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
		 
		 if($('#project_type_id').val() == '')
		 {
			 inlineMsg('project_type_id','<strong>Please provide Project Type.</strong>',2);
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
	document.getElementById("Submit").disabled=false;
	document.getElementById("loadingdivimg").style.display="block";	
	$.ajax({
			type: "GET",
			cache: false,
			url: '/admins/uniqueprojectname/'+projectname,
			success: function(updatediv1){ 
				document.getElementById("updatediv1").innerHTML="";
				document.getElementById("updatediv1").style.display = 'none';
				$("#updatediv1").html(trim(updatediv1));
				document.getElementById("loadingdivimg").style.display="none";
				if(document.getElementById('projectalready') && document.getElementById('projectalready').value > 0)
				{	
					document.getElementById("updatediv1").style.display = 'block';
					document.getElementById("Submit").disabled=true;
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
			url: '/admins/uniqueprojectprefix/'+prefixname,
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


function getstates(countryid,modelname) {
	   if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: '/admins/selectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                    //alert(rText);
                     jQuery('#statediv').html(rText);
             }
     });
	  
}

function showselecttemplate(id){
	
	location = "/admins/sendtempmail/"+id;

	}


function validatecoinset(part){
	 //alert($('startser').val());
	
	if(part=="add")
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
		if($('#verifycode').val() == '')
		{
			inlineMsg('verifycode','<strong>Please provide Verification Code.</strong>',2);
			return false;
		}
		if(isnumerice($('#verifycode').val()) == false){
			inlineMsg('verifycode','<strong>Verification Code should be numeric only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#verifycode').val()) == true){
			inlineMsg('verifycode','<strong>Please dont use script tags.</strong>',2);
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
          url: '/admins/getshipdays/'+shippingid,
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
         url: '/admins/getprojecttypedays/'+projectypeid,
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

function makeestimatedshippingdate(){
	
		var orderchipcodate = document.getElementById("datesubmitchipco").value;
		var shippingvalue = document.getElementById("projecttypevalue").value;
		//var shippingvalue = document.getElementById("shippingvalue").value;
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

function calculateestdeliverydate(){
	
	var orderchipcodate = document.getElementById("datesubmitchipco").value;
	var shippingvalue = parseInt(document.getElementById("projecttypevalue").value)+parseInt(document.getElementById("shippingvalue").value);
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
         url: '/admins/getcompanyaddressbyid/'+companyid,
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
			
			if($('#serialprefix').val() == '')
			 {
				 inlineMsg('serialprefix','<strong>Please provide Serial # Prefix.</strong>',2);
				 return false; 
			 }
			if(hasWhiteSpace($('#serialprefix').val()) == true){
				 inlineMsg('serialprefix','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
			if(isalphanumerice($('#serialprefix').val()) == false){
				 inlineMsg('serialprefix','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
			if($('#serialprefix').val().length < 3 || $('#serialprefix').val().length > 3)
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
			
			
		}

		// For User and Sponsor Validation
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

function validatesponsordtl(actionfor){
		if(actionfor=='add'){
			
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
	
	
	
	
	
	if($('#busphone').val() !=''  && ParseUSNumber($('#busphone').val())==false){
		inlineMsg('busphone','<strong>Please use valid phone format.</strong>',2);
		 return false; 
	}
	if($('#fax').val() !=''  && ParseUSNumber($('#fax').val())==false){
		inlineMsg('fax','<strong>Please use valid fax format.</strong>',2);
		 return false; 
	}
	if($('#mobile').val() !=''  && ParseUSNumber($('#mobile').val())==false){
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
	
	
	return true;
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
			alert("haha");
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


//========================================================================================//
//================================End=====================================================//
//========================================================================================//