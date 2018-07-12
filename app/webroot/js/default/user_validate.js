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
function showselecttemplate(id){
	
	location = "/companies/sendtempmail/"+id;

	}
function copycontacts(){ 

	dropdown = document.getElementById('emaillists');

			var existlist = document.getElementById('toid').value;
alert(existlist);
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
	
	return true;
	
}

function validatecoinset(part){
		
	if($('#ship_type_id').val() == '')
	 {
		 inlineMsg('ship_type_id','<strong>Please Select Shipping Type.</strong>',3);
		 return false;
	 }
	if($('#units').val() == '')
	 {
		 inlineMsg('units','<strong>Please proive # of Units.</strong>',2);
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
		 inlineMsg('name','<strong>Please proive Coinset Name.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#name').val()) == true){
		 inlineMsg('name','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 }

	if($('#startser').val() == '')
	{
		 inlineMsg('startser','<strong>Please proive Serial # Start.</strong>',2);
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
		 inlineMsg('ending','<strong>Please proive Serial # End.</strong>',2);
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
          url: '/companies/getshipdays/'+shippingid,
          cache: false,
          success: function(rText){
                	if(rText){
                		document.getElementById("shippingvalue").value = rText;
                		
                	}else{
                		document.getElementById("shippingvalue").value = "";
                	}
                	makeestimatedshippingdate();
          }
  });
	  
}
function getprojecttypedays(projectypeid) {
	   
	 document.getElementById("projecttypevalue").value = "";
   jQuery.ajax({
         type: "GET",
         url: '/companies/getprojecttypedays/'+projectypeid,
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
		var shippingvalue = document.getElementById("shippingvalue").value;
		if(shippingvalue && orderchipcodate){
			var splarr = orderchipcodate.split("-");
			var spldate = splarr[0]+"-"+splarr[1]+"-"+splarr[2];
			
			var totalDate = new Date()
			totalDate.setYear(splarr[0]);
			totalDate.setMonth(splarr[1]);
			totalDate.setDate(splarr[2]);
			totalDate.setDate(totalDate.getDate()+parseInt(shippingvalue));
			
			var now = new Date(totalDate);

			var curr_date = now.getDate();
				if(curr_date < 10){
					var curr_month = '0'+curr_date;
				}
			var curr_month = (now.getMonth());
				if(curr_month < 10){
					var curr_month = '0'+curr_month;
				}
			var curr_year = now.getFullYear()


			document.getElementById("dateestship").value = curr_year+'-'+curr_month+'-'+curr_date;
		}else{
			document.getElementById("dateestship").value = '';
			return false;
		}
	
}
function validatesponsordtl(actionfor){
		
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
			 inlineMsg('city','<strong>Please select City.</strong>',2);
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

function getcompanyaddress(companyid) {
	
   jQuery.ajax({
         type: "GET",
         url: '/companies/getcompanyaddressbyid/'+companyid,
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
function showmsg(part,msg){	
inlineMsg(part,'<strong>'+msg+'</strong>',5);
}
/*
 * Function name   : validatecomment()
 * Description     : This function is used for validation of comment 
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validatecomment(part){	

    	 if($('#comments').val() == '')
	 {
		 inlineMsg('comments','<strong>Comments required.</strong>',2);
		 return false;
	 }
	if(hasWhiteSpace($('#comments').val()) == true){
				 inlineMsg('comments','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
	 if(tagValidate($('#comments').val()) == true){
		 inlineMsg('comments','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 

	


 return true; 
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

/*
 * Function name   : validatepassword()
 * Description     : This function is used for validation of password 
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validatepassword(part){	

	if($('#oldpassword').val() == '')
	 {
		 inlineMsg('oldpassword','<strong>Old Password required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#oldpassword').val()) == true){
		 inlineMsg('oldpassword','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	if($('#password').val() == '')
	 {
		 inlineMsg('password','<strong>Password required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#password').val()) == true){
		 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	if($('#confirm_password').val() == '')
	 {
		 inlineMsg('confirm_password','<strong>Confirm Password required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#confirm_password').val()) == true){
		 inlineMsg('confirm_password','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 }

    	
 return true; 
}
/*
 * Function name   : validateemail()
 * Description     : This function is used for validation of email 
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validateemail(part){	

	if($('#email').val() == '')
	 {
		 inlineMsg('email','<strong>Email required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#email').val()) == true){
		 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 

    	
 return true; 
}

function validatemap(noofcomments){
 if(noofcomments ==0)
	 {
		 inlineMsg('gmap','<strong>No Data Available.</strong>',2);
		 return false;
	 }
 return true; 
}
/*
 * Function name   : validatelogin()
 * Description     : This function is used for validation of loginame & password 
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validatelogin(part){	

	 if($('#username').val() == '')
	 {
		 inlineMsg('username','<strong>Username required.</strong>',2);
		 return false;
	 }
	if(hasWhiteSpace($('#username').val()) == true){
				 inlineMsg('username','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
	 if(tagValidate($('#username').val()) == true){
		 inlineMsg('username','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	if($('#password').val() == '')
	 {
		 inlineMsg('password','<strong>Password required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#password').val()) == true){
		 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 

    	
 return true; 
}
/*
 * Function name   : validateserial()
 * Description     : This function is used for validation of serial 
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validateserial(part){	

    	 if($('#coinset').val() == '')
	 {
		 inlineMsg('coinset','<strong>Serial required.</strong>',2);
		 return false;
	 }
	if(hasWhiteSpace($('#coinset').val()) == true){
				 inlineMsg('coinset','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
	 if(tagValidate($('#coinset').val()) == true){
		 inlineMsg('coinset','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 


 return true; 
}
/*
 * Function name   : validatecoinserial()
 * Description     : This function is used for validation of coin serail 
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validatecoinserial(part){	

    	 if($('#coinserial').val() == '')
	 {
		 inlineMsg('coinserial','<strong>Coin Serial required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#coinserial').val()) == true){
		 inlineMsg('coinserial','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 

	 if($('#code').val() == '')
	 {
		 inlineMsg('code','<strong>Code required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#code').val()) == true){
		 inlineMsg('code','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 


 return true; 
}

/*
 * Function name   : validateholder()
 * Description     : This function is used for validation of holder (add/edit)
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function validateholder(part){
   
	if(part=="add"){

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
	 if(tagValidate(trim($('#email').val())) == true){
		 inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
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
	if(trim($('#password_confirm').val()) == '')
	 {
		 inlineMsg('password_confirm','<strong>Confirm Password required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#password_confirm').val())) == true){
		 inlineMsg('password_confirm','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 }
 	if(trim($('#firstname').val()) == '')
	 {
		 inlineMsg('firstname','<strong>Firstname required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#firstname').val())) == true){
		 inlineMsg('firstname','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	if(trim($('#lastnameshow').val()) == '')
	 {
		 inlineMsg('lastnameshow','<strong>Lastname required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#lastnameshow').val())) == true){
		 inlineMsg('lastnameshow','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	
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

	if(!(document.getElementById('agree').checked))
	 {
		 inlineMsg('agree','<strong>Please agree terms and conditions.</strong>',2);
		 return false;
	 }
	 return true;
	}
	if(part=="edit"){

 	if(trim($('#screenname').val()) == '')
	 {
		 inlineMsg('screenname','<strong>Screen Name required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#screenname').val())) == true){
		 inlineMsg('screenname','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 }     	
 	if(trim($('#firstname').val()) == '')
	 {
		 inlineMsg('firstname','<strong>Firstname required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#firstname').val())) == true){
		 inlineMsg('firstname','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	if(trim($('#lastnameshow').val()) == '')
	 {
		 inlineMsg('lastnameshow','<strong>Lastname required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#lastnameshow').val())) == true){
		 inlineMsg('lastnameshow','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	
	if($('#country').val() == '')
	 {
		 inlineMsg('country','<strong>Country required.</strong>',2);
		 return false;
	 }
	 if(tagValidate(trim($('#country').val())) == true){
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
	 return true;
	}
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

function calculateestdeliverydate(){
	
	var orderchipcodate = document.getElementById("datesubmitchipco").value;
	var shippingvalue = document.getElementById("shippingvalue").value;
	if(shippingvalue && orderchipcodate){
		var splarr = orderchipcodate.split("-");
		var spldate = splarr[0]+"-"+splarr[1]+"-"+splarr[2];
		
		var totalDate = new Date()
		totalDate.setYear(splarr[0]);
		totalDate.setMonth(splarr[1]);
		totalDate.setDate(splarr[2]);
		totalDate.setDate(totalDate.getDate()+parseInt(shippingvalue));
		
		var now = new Date(totalDate);

		var curr_date = now.getDate();
			if(curr_date < 10){
				var curr_date = '0'+curr_date;
			}
		var curr_month = (now.getMonth());
			if(curr_month < 10){
				var curr_month = '0'+curr_month;
			}
		var curr_year = now.getFullYear()


		document.getElementById("dateestdelivery").value = curr_year+'-'+curr_month+'-'+curr_date;
	}else{
		document.getElementById("dateestdelivery").value = '';
		return false;
	}
}



function getstateoptions(countryid,modelname) {   
       if(countryid==""){
          return false;
       }

       jQuery.ajax({
             type: "GET",
             url: '/companies/selectstateoptions/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                   
                     jQuery('#state').html(rText);
             }
     });
      
}

function getstates(countryid,modelname) {
	   if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: '/companies/selectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                    //alert(rText);
                     jQuery('#statediv').html(rText);
             }
     });
	  
}
/*
 * Function name   : reportoffensive()
 * Description     : This function is used for validation of password 
 * Created On      : 16-02-2011 (05:50am)
 *
 */

function reportoffensive(id,user_id,project_id){	

 jQuery.ajax({
             type: "GET",
             url: '/companies/report_popup/'+user_id+'/'+project_id+'/'+id,
             cache: false,
             success: function(rText){                    
                   //  jQuery('#'+id).html(rText);
             }
     });
 inlineMsg(id,'<strong>Thanks for Reporting Offensive!</strong>',2);
		
	
}

































//========================================================================================//
//================================End=====================================================//
//========================================================================================//