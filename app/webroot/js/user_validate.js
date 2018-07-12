
function checkprevouspage(e){
	if(!window.onLoad){
		window.onbeforeunload = function () {
			   return "You have not saved your document yet.  If you continue, your work will not be saved."
			}
	}
}

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


function newgetstates(countryid,modelname) {
	document.getElementById("state").value ='';   
	if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: baseUrl+'companies/newselectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
		document.getElementById("d1").style.display="none";
		document.getElementById("d2").style.display="block";
                     jQuery('#statediv1').html(rText);
             }
     });
	  
}

/* Function to get state options only 
*/

function getstateoptions(countryid,modelname) {   
       if(countryid==""){
          return false;
       }

       jQuery.ajax({
             type: "GET",
             url: baseUrl+'companies/selectstateoptions/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                   
                     jQuery('#state').html(rText);
             }
     });
      
}

function isAlphaNumeric(s){
    return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
}
function isAlpha(s){
    return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
}
function isAlphaNumericSpace(s){
    return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ");
}
function isUserName(s){
    return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_@.");
}
function isFirstName(s){
	s=trim(s," ");
	return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ");
}
function isCity(s){
	s=trim(s);
	return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ");
}
function isnumerice(s){
	s=trim(s);
	return isCharsInBag (s, "0123456789");
}

function organizationname(s){
    return isCharsInBag (s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' .(){}&");
}



function checkcreditcard(ccNumb) {  // v2.0
	var valid = "0123456789"  // Valid digits in a credit card number
	var len = ccNumb.length;  // The length of the submitted cc number
	var iCCN = parseInt(ccNumb);  // integer of ccNumb
	var sCCN = ccNumb.toString();  // string of ccNumb
	sCCN = sCCN.replace (/^\s+|\s+$/g,'');  // strip spaces
	var iTotal = 0;  // integer total set at zero
	var bNum = true;  // by default assume it is a number
	var bResult = false;  // by default assume it is NOT a valid cc
	var temp;  // temp variable for parsing string
	var calc;  // used for calculation of each digit

	// Determine if the ccNumb is in fact all numbers
	for (var j=0; j<len; j++) {
	  temp = "" + sCCN.substring(j, j+1);
	  if (valid.indexOf(temp) == "-1"){bNum = false;}
	}

	// if it is NOT a number, you can either alert to the fact, or just pass a failure
	if(!bNum){
	  /*alert("Not a Number");*/bResult = false;
	}

	// Determine if it is the proper length 
	if((len == 0)&&(bResult)){  // nothing, field is blank AND passed above # check
	  bResult = false;
	} else{  // ccNumb is a number and the proper length - let's see if it is a valid card number
	  if(len >= 15){  // 15 or 16 for Amex or V/MC
	    for(var i=len;i>0;i--){  // LOOP throught the digits of the card
	      calc = parseInt(iCCN) % 10;  // right most digit
	      calc = parseInt(calc);  // assure it is an integer
	      iTotal += calc;  // running total of the card number as we loop - Do Nothing to first digit
	      i--;  // decrement the count - move to the next digit in the card
	      iCCN = iCCN / 10;                               // subtracts right most digit from ccNumb
	      calc = parseInt(iCCN) % 10 ;    // NEXT right most digit
	      calc = calc *2;                                 // multiply the digit by two
	      // Instead of some screwy method of converting 16 to a string and then parsing 1 and 6 and then adding them to make 7,
	      // I use a simple switch statement to change the value of calc2 to 7 if 16 is the multiple.
	      switch(calc){
	        case 10: calc = 1; break;       //5*2=10 & 1+0 = 1
	        case 12: calc = 3; break;       //6*2=12 & 1+2 = 3
	        case 14: calc = 5; break;       //7*2=14 & 1+4 = 5
	        case 16: calc = 7; break;       //8*2=16 & 1+6 = 7
	        case 18: calc = 9; break;       //9*2=18 & 1+8 = 9
	        default: calc = calc;           //4*2= 8 &   8 = 8  -same for all lower numbers
	      }                                               
	    iCCN = iCCN / 10;  // subtracts right most digit from ccNum
	    iTotal += calc;  // running total of the card number as we loop
	  }  // END OF LOOP
	  if ((iTotal%10)==0){  // check to see if the sum Mod 10 is zero
	    bResult = true;  // This IS (or could be) a valid credit card number.
	  } else {
	    bResult = false;  // This could NOT be a valid credit card number
	    }
	  }
	}
	// change alert to on-page display or other indication as needed.
	if(bResult) {
	 return true;
	}
	if(!bResult){
		return false;
	}
	 
	}
	


function defaultfocus()
{
	$(document).ready(function() {
	    $('form:first *:input[type!=hidden]:first').focus();
	});
}

function IsNumeric(sText)

{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;

   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
   
   }




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

// PASSWORD STRENGTH CODE

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




// END FOR PASSWORD STRENGTH CODE

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
if (tagexp.test(strg))
	return true;
	else
	return false;
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
function ajaxemailcheck(email){
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	
	
	if(!email.match(emailRegex)) 
	  {
		 document.getElementById("markimg").innerHTML ="";
		 document.getElementById("markimg").innerHTML = "<span class='tTip' title='Not a valid email id.'><img src='/img/red_cross_mark.jpg'></span>";
	   
	    return false;
	  }else{
		  
			$.ajax({
				type: "GET",
				cache: false,
				url: '/groups/ajaxemailcheck/'+email,
				success: function(obj){
			//alert(obj);
					if(obj=='already exists'){
						//alert(obj);
						document.getElementById("markimg").innerHTML ="";
						document.getElementById("markimg").innerHTML = "<span class='tTip' title='This email id already in use. Please try another.'><img src='/img/red_cross_mark.jpg'></span>";
						return false;
					}else{
						  document.getElementById("markimg").innerHTML ="";
						  document.getElementById("markimg").innerHTML = "<img src='/img/tick_16.png' width='16' height='16' alt=''>";
						
						 return true;
					}
					
				
						
					
				}	
			});

		
	  }
	


 }

/*
 * Function name          : validateAdbookpricingstructure()
 * Description            : This function is used to validate Free form page
 * Parameters 			  : N/A
 * Created On             : 06-07-10 (05:10pm)                          
 */

function validateAdbookpricingstructure(){
	
	 if($('#gold').val()=="")
	 {
		 inlineMsg('gold','<strong> Please enter Full Gold price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#gold').val())){
			inlineMsg('gold','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	if(!isnumerice($('#gold').val()))
	 {
		 inlineMsg('gold','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	
	
	 if($('#silver').val()=="")
	 {
		 inlineMsg('silver','<strong> Please enter Full Silver price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#silver').val())){
			inlineMsg('silver','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(!isnumerice($('#silver').val()))
	 {
		 inlineMsg('silver','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	
	 
	 if($('#sponsor').val()=="")
	 {
		 inlineMsg('sponsor','<strong> Please enter Full Sponsor price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#sponsor').val())){
			inlineMsg('sponsor','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 
	 if(!isnumerice($('#sponsor').val()))
	 {
		 inlineMsg('sponsor','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	/*
	 if($('#half_gold').val()=="")
	 {
		 inlineMsg('half_gold','<strong> Please enter Half Gold price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#half_gold').val())){
			inlineMsg('half_gold','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(!isnumerice($('#half_gold').val()))
	 {
		 inlineMsg('half_gold','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	
	 
	 if($('#half_silver').val()=="")
	 {
		 inlineMsg('half_silver','<strong> Please enter Half Silver price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#half_silver').val())){
			inlineMsg('half_silver','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(!isnumerice($('#half_silver').val()))
	 {
		 inlineMsg('half_silver','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	 */
	 if($('#half_sponsor').val()=="")
	 {
		 inlineMsg('half_sponsor','<strong> Please enter Half Sponsor price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#half_sponsor').val())){
			inlineMsg('half_sponsor','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(!isnumerice($('#half_sponsor').val()))
	 {
		 inlineMsg('half_sponsor','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	 
	 if($('#quarter').val()=="")
	 {
		 inlineMsg('quarter','<strong> Please enter 1/4 Sponsor price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#quarter').val())){
			inlineMsg('quarter','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(!isnumerice($('#quarter').val()))
	 {
		 inlineMsg('quarter','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	 
	 if($('#biz').val()=="")
	 {
		 inlineMsg('biz','<strong> Please enter Business price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#biz').val())){
			inlineMsg('biz','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(!isnumerice($('#biz').val()))
	 {
		 inlineMsg('biz','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	 
	 if($('#messagefield').val()=="")
	 {
		 inlineMsg('messagefield','<strong> Please enter Message price.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation($('#messagefield').val())){
			inlineMsg('messagefield','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(!isnumerice($('#messagefield').val()))
	 {
		 inlineMsg('messagefield','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	 
	 return true;
	
	
}



/*
 * Function name          : validatefreeform()
 * Description            : This function is used to validate Free form page
 * Parameters 			  : N/A
 * Created On             : 06-07-10 (05:10pm)                          
 */


function validatefreeform()
{
	
	 
		 
		 if($('#groupname').val()=="")
		 {
			 inlineMsg('groupname','<strong> Please enter group name.</strong>',2);
			 return false;
		 }
		 
		 if($('#groupname').val().length < 3 )
		 {
			 inlineMsg('groupname','<strong>Minimum length for Group name is 3.</strong>',2);
			 return false;
		 }
		if(!isAlphaNumericSpace($('#groupname').val()))
		 {
			 inlineMsg('groupname','<strong>Only allowed Alpha numeric character with space.</strong>',2);
			 return false;
		 }
		
		if($('#eventname').val()=="")
		 {
			 inlineMsg('eventname','<strong> Please enter Event name.</strong>',2);
			 return false;
		 }
		
		 if($('#eventname').val().length < 3 )
		 {
			 inlineMsg('eventname','<strong>Minimum length for Event name is 3.</strong>',2);
			 return false;
		 }
		if(!isAlphaNumericSpace($('#eventname').val()))
		 {
			 inlineMsg('eventname','<strong>Only allowed Alpha numeric character with space.</strong>',2);
			 return false;
		 }
	 
		 
		 if($('#address').val()=="")
		 {
			 inlineMsg('address','<strong> Please enter address.</strong>',2);
			 return false;
		 }
		 
		 
		 
		 if($('#city').val() =="")
		 {
			 inlineMsg('city','<strong>Please enter city.</strong>',2);
			 return false;
		 }
		if(!isCity($('#city').val()))
		 {
			 inlineMsg('city','<strong>Only allowed Alphabets with space.</strong>',2);
			 return false;
		 }
		if($('#state').val() =="")
		 {
			 inlineMsg('state','<strong>Please select State Name.</strong>',2);
			 return false;
		 }
		
		if($('#zipcode').val() =="")
		 {
			 inlineMsg('zipcode','<strong>Please enter Zipcode.</strong>',2);
			 return false;
		 }
		
		if(!isnumerice($('#zipcode').val()))
		 {
			 inlineMsg('zipcode','<strong>Only allowed numeric value.</strong>',2);
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
		
		if($('#phone').val() =="")
		 {
			 inlineMsg('phone','<strong>Please enter phone number.</strong>',2);
			 return false;
		 }
		if(!ParseUSNumber($('#phone').val()))
		 {
			 inlineMsg('phone','<strong>Phone number must be like xxx-xxx-xxxx format.</strong>',2);
			 return false;
		 }
		if(!ParseUSNumber($('#fax').val()) && $('#fax').val() !="")
		 {
			 inlineMsg('fax','<strong>Fax number must be like xxx-xxx-xxxx format.</strong>',2);
			 return false;
		 }
		
		if($('#email').val() =="")
		 {
			 inlineMsg('email','<strong>Please enter email address.</strong>',2);
			 return false;
		 }
		if(!validateemail($('#email').val()))
		 {
			 inlineMsg('email','<strong>Please enter valid email address.</strong>',2);
			 return false;
		 }
		 
	

	
		 if($('#groupnote').val() !="" && $('#groupnote').val().length >30)
		 {
			 inlineMsg('groupnote','<strong> Max length for this field is 30.</strong>',2);
			 return false;
		 }
		 
		 if($('#grouplogo').val() =="")
		 {
			 inlineMsg('grouplogo','<strong>Please provide Group logo.</strong>',2);
			 return false;
		 }
		 
		 if($('#typelogo').val() =="")
		 {
			 inlineMsg('typelogo','<strong>Please select Group type logo.</strong>',2);
			 return false;
		 }
		 
		 if($('#fundgoal').val() =="")
		 {
			 inlineMsg('fundgoal','<strong> Please enter fund raising goal.</strong>',2);
			 return false;
		 }
		 if(!isnumerice($('#fundgoal').val()))
		 {
			 inlineMsg('fundgoal','<strong> Only numeric value allowed.</strong>',2);
			 return false;
		 }
		 
		 //validate addbook pricing entery
		 
		 if(validateAdbookpricingstructure()==false){
			 return false;
		 }
	 
	 return true;
}



function blank()
{
	//alert(document.form1.login.value)
	var usn = document.getElementById('searchkeyword');
	if(usn.value=="search keyword")
	{
		usn.value="";
	}
}
function fill()
{
	var usn = document.getElementById('searchkeyword');
	if(usn.value=="")
	{
		usn.value="search keyword";
	}
}

function showonlinedirectoryInfo(divid,action,show)
{
	
	document.getElementById(divid).style.display=action;
	if(action=='inline')
		document.getElementById(show).checked=true;

}

function checkreadiovalue(val)
{
	if(document.getElementById('ano')!=null){
		document.getElementById('ano').checked = false;
		document.getElementById('anoamount').value= '';
	}
	document.getElementById("hiddenpricing").value=val;
	textlimit();
}
/*
 * Function name   : checkuserscredintials()
 * Description     : This function for check the admin password 
 * Created On      : 15-06-10 (07:15pm)
 *
 */	
function checkuserscredintials() {
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var email = document.getElementById('email');
	var password = document.getElementById('password');
	 if(email.value =="")
	 {
		 inlineMsg('email','<strong> You must enter your Email-ID</strong>',2);
		 return false;
	 }
	 if(!email.value.match(emailRegex)) 
	  {
	    inlineMsg('email','<strong> Invalid Email.</strong>',2);
	    return false;
	  }
	 if(password.value =="")
	 {
		 inlineMsg('password','<strong> You must enter your Password</strong>',2);
		 return false;
	 }
	 if(password.value.length < 6){
			inlineMsg('password','<strong>Minimum length for Password is 6</strong>',2);
			return false;   
			}
	return true;
}

/*
 * Function name   : forgotpassword()
 * Description     : This function is used to check forgot password page validation
 * Created On      : 15-07-10 (05:30pm)
 *
 */	

function forgotpassword(){

	 if($('#email').val()=="")
	 {
		 inlineMsg('email','<strong> You must enter your Username/Email :</strong>',2);
		 return false;
	 }
	 if(($('#email').val().length < 4)){
			inlineMsg('email','<strong>Minimum length for Username/Email is 4</strong>',2);
			return false;   
			}

	}

/*
 * Function name   : checkmainloginwithusernameandemailid()
 * Description     : This function for check the admin login with username and password 
 * Created On      : 15-07-10 (05:30pm)
 *
 */	
function checkmainloginwithusernameandemailid() {
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var email = document.getElementById('email');
	var password = document.getElementById('password');
	 if(email.value =="")
	 {
		 inlineMsg('email','<strong> You must enter your Username/Email-ID</strong>',2);
		 return false;
	 }
	 if(email.value.length < 4){
			inlineMsg('email','<strong>Minimum length for Username/Email is 4</strong>',2);
			return false;   
			}
	/*if(!email.value.match(emailRegex)) 
	  {
	    inlineMsg('email','<strong> Invalid Email.</strong>',2);
	    return false;
	  }*/
	 if(password.value =="")
	 {
		 inlineMsg('password','<strong> You must enter your Password</strong>',2);
		 return false;
	 }
	 if(password.value.length < 6){
			inlineMsg('password','<strong>Minimum length for Password is 6</strong>',2);
			return false;   
			}
	return true;
}

/*
 * Function name   : showbilldiv()
 * Description     : This function to display bill information div
 * Created On      : 16-06-10 (11:55am)
 *
 */	
function showbilldiv(){
	var val =  $('#infoasbilling:checked').val(); 
	//var val = document.getElementById("infoasbilling").checked;

	if(val!=1){
		
		//document.getElementById("hidbillinginfo").style.display="inline";
		document.getElementById("bill_firstname").value='';
		document.getElementById("bill_middlename").value='';
		document.getElementById("bill_lastname").value='';
		document.getElementById("bill_street1").value='';
		document.getElementById("bill_street2").value='';
		document.getElementById("bill_city").value='';
		document.getElementById("bill_country").value='';
		document.getElementById("bill_state").value='';
		document.getElementById("bill_zipcode").value='';
		document.getElementById("bill_email").value='';	
	}else{
		document.getElementById("bill_firstname").value=document.getElementById("firstname").value;
		document.getElementById("bill_middlename").value=document.getElementById("middlename").value;
		document.getElementById("bill_lastname").value=document.getElementById("lastname").value;
		document.getElementById("bill_street1").value=document.getElementById("street1").value;
		document.getElementById("bill_street2").value=document.getElementById("street2").value;
		document.getElementById("bill_city").value=document.getElementById("city").value;
		
		
		document.getElementById("bill_zipcode").value=document.getElementById("zipcode").value;
		document.getElementById("bill_email").value=document.getElementById("email").value;
		
		document.getElementById("bill_country").value=document.getElementById("country").value;
		var state = document.getElementById("state").type;
	
		if(state=='select-one'){ 
			
			
			
				    	jQuery.ajax({
			                type: "POST",
			              url: baseUrl+'groups/selectstate/'+$('#country').val()+'/billingsection',
			                cache: false,
			                success: function(rText){
			                        //alert(rText);
			                        jQuery('#statebill').html(rText);
			                       
			                        document.getElementById("bill_state").value=document.getElementById("state").value;
			                }
				    	 });		
		}else{

			//$('#statebill').html("<input type ='text' value="+$('#state').val()+" id='bill_state' name='data[donors][bill_state]' class='inpt' maxlength ='150'>");
			$('#statebill').html("<input type ='text' value='"+$('#state').val()+"' id=bill_state name='data[donors][bill_state]' class='inpt' maxlength ='150'>");
			
			 
		}
		
		 // document.getElementById("bill_state").value=document.getElementById("state").value;
		//alert('aa'+document.getElementById("bill_state").value);
	}
}

/*
 * Function name   : checkbillinginfo()
 * Description     : This function to check billing info same as user infor
 * Created On      : 16-06-10 (001:05pm)
 *
 */

function checkbillinginfo(){

}
/*
 * Function name   : checkpaymentinfo()
 * Description     : This function to validate paymentinfo page of donor
 * Created On      : 16-06-10 (001:05pm)
 *
 */
function checkpaymentinfo(ifuser)
{
	 var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	 
	 var firstname = document.getElementById("firstname").value;
	 var lastname = document.getElementById("lastname").value;
	 var street1 = document.getElementById("street1").value;
	 var country = document.getElementById("country").value;
	 var city = document.getElementById("city").value;
	 var state = document.getElementById("state");
	 var zipcode = document.getElementById("zipcode").value;
	 var middlename = document.getElementById("middlename").value;
	 var email = document.getElementById("email").value;
	creditcard = document.getElementById("creditcard");
	 
	 if(ifuser=='0'){
		 var password = document.getElementById("password").value;
	 }
	 var infoasbilling = document.getElementById("infoasbilling").checked;
	 
	 var cardnumber = document.getElementById("cardnumber").value;
	 var cvvno = document.getElementById("cvvno").value;
	 var month = document.getElementById("month").value;
	 var year = document.getElementById("year").value;
	 
	 
	
	
	 
	 //return false;
	 
	// var phone = document.getElementById("phone").value;
	
	
	
	 if(firstname =="")
	 {
		 inlineMsg('firstname','<strong> Please enter First Name.</strong>',2);
		 return false;
	 }
	
	if(!isFirstName(firstname))
	 {
		 inlineMsg('firstname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	 if(!spaceValidation(firstname)){
		inlineMsg('firstname','<strong> Blank space not allowed.</strong>',2);
			 return false;
	 }
	
	 
	
	if(middlename!=''){  
		if(!spaceValidation(middlename)){
			inlineMsg('middlename','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
		 
		if(!isFirstName(middlename))
		{
			inlineMsg('middlename','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}
	} 
	if(lastname =="")
	 {
		 inlineMsg('lastname','<strong> Please enter Last Name.</strong>',2);
		 return false;
	 }
	 if(!isFirstName(lastname))
	 {
		 inlineMsg('lastname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }	
	 if(!spaceValidation(lastname)){
			inlineMsg('lastname','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 if(street1 =="")
	 {
		 inlineMsg('street1','<strong> Please enter Street Address.</strong>',2);
		 return false;
	 }
	if(!spaceValidation(street1)){
			inlineMsg('street1','<strong> Blank space not allowed.</strong>',2);
				return false;
	}
	
	if(country==""){
		 inlineMsg('country','<strong> Please select Country.</strong>',2);
		 return false;
	}
	if(state.value ==""){
		 inlineMsg('state','<strong> Please enter State.</strong>',2);
		 return false;
	}
	 if(state.type=='text')
	 {
		
		if(!spaceValidation(state.value)){
			inlineMsg('state','<strong> Blank space not allowed.</strong>',2);
			return false;
		}
	
		if(!isFirstName(state.value))
		{ 
			inlineMsg('state','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}	
	 }
	 
	 if(city =="")
	 {
		 inlineMsg('city','<strong> Please enter City.</strong>',2);
		 return false;
	 }
	if(!isFirstName(city))
	{
		inlineMsg('city','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}
	if(!spaceValidation(city)){
			inlineMsg('city','<strong> Blank space not allowed.</strong>',2);
				return false;
	}
	
	
	 if(zipcode =="")
	 {
		 inlineMsg('zipcode','<strong> Please enter ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	if(!spaceValidation(zipcode)){
		inlineMsg('zipcode','<strong> Blank space not allowed.</strong>',2);
		return false;
	}
	
	 if(zipcode.length < 5)
	 {
		 inlineMsg('zipcode','<strong> ZIP/Postal Code should greater then 4.</strong>',2);
		 return false;
	 }
	 if(isNaN(zipcode))
	 {
		 inlineMsg('zipcode','<strong> Please enter valid ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	 
	 
	 if(email =="")
	 {
		 inlineMsg('email','<strong> Please enter E-mail Id.</strong>',2);
		 return false;
	 }
	 if(!email.match(emailRegex)) 
	  {
	    inlineMsg('email','<strong> Invalid E-mail Id.</strong>',2);
	    return false;
	  }
	 
	 if(ifuser=='0'){
		 if(password =="")
		 {
			 inlineMsg('password','<strong>Please enter Password.</strong>',2);
			 return false;
		 }
		 if(password.length < 6){
				inlineMsg('password','<strong>Minimum length for Password is 6</strong>',2);
				return false;   
				}
	 }

	 if(infoasbilling ==false || infoasbilling ==true )
	 {
		 
		 var bill_firstname = document.getElementById("bill_firstname").value;
		 var bill_lastname = document.getElementById("bill_lastname").value;
		 var bill_street1 = document.getElementById("bill_street1").value;
		 var bill_city = document.getElementById("bill_city").value;
		 var bill_state = document.getElementById("bill_state");
		 var bill_zipcode = document.getElementById("bill_zipcode").value;
		 var bill_email = document.getElementById("bill_email").value;
		 var bill_country = document.getElementById("bill_country").value;
		 var bill_middlename = document.getElementById("bill_middlename").value;
		 if(bill_firstname =="")
		 {
			 inlineMsg('bill_firstname','<strong> Please enter First Name.</strong>',2);
			 return false;
		 }
		if(!spaceValidation(bill_firstname)){
			inlineMsg('bill_firstname','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
		if(!isFirstName(bill_firstname))
		{
			inlineMsg('bill_firstname','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}
			
			
		if(bill_middlename!=''){
			if(!isFirstName(bill_middlename))
			{
				inlineMsg('bill_middlename','<strong>Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(bill_middlename)){
				inlineMsg('bill_middlename','<strong> Blank space not allowed.</strong>',2);
				return false;
			}
		}
 		if(bill_lastname =="")
		 {
			 inlineMsg('bill_lastname','<strong> Please enter Last Name.</strong>',2);
			 return false;
		 }
		if(!isFirstName(bill_lastname)){
			inlineMsg('bill_lastname','<strong> Please enter Last Name.</strong>',2);
			 return false;
		 }
		if(!spaceValidation(bill_lastname)){
			inlineMsg('bill_lastname','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
		 if(bill_street1 =="")
		 {
			 inlineMsg('bill_street1','<strong> Please enter Street address.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(bill_street1)){
				inlineMsg('bill_street1','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
		 
		 if(bill_country==""){
			 inlineMsg('bill_country','<strong> Please select Country.</strong>',2);
			 return false;
		}
		
		 if(bill_state.type=='text' && bill_state.value =="")
		 {
			 inlineMsg('bill_state','<strong> Please enter State.</strong>',2);
			 return false;
		 }
		 
		 if(bill_state.value =="")
		 {
			 inlineMsg('bill_state','<strong> Please select State.</strong>',2);
			 return false;
		 }

		 
		if(!spaceValidation(bill_state.value)){
				inlineMsg('bill_state','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
		if(isNaN(bill_state.value) && !isFirstName(bill_state.value))
		{
			inlineMsg('bill_state','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}	
			
		 if(bill_city =="")
		 {
			 inlineMsg('bill_city','<strong> Please enter City.</strong>',2);
			 return false;
		 }
		 if(!isFirstName(bill_city))
		{
			inlineMsg('bill_city','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}
		if(!spaceValidation(bill_city)){
				inlineMsg('bill_city','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
		
		 if(bill_zipcode =="")
		 {
			 inlineMsg('bill_zipcode','<strong> Please enter ZIP/Postal Code.</strong>',2);
			 return false;
		 }
		
		 if(bill_zipcode.length < 5)
		 {
			 inlineMsg('bill_zipcode','<strong> ZIP/Postal Code should greater then 4.</strong>',2);
			 return false;
		 }
		 if(isNaN(bill_zipcode))
		 {
			 inlineMsg('bill_zipcode','<strong> Please enter valid ZIP/Postal Code.</strong>',2);
			 return false;
		 }
		 if(bill_email =="")
		 {
			 inlineMsg('bill_email','<strong> Please enter E-mail Id.</strong>',2);
			 return false;
		 }
		 if(!bill_email.match(emailRegex)) 
		  {
		    inlineMsg('bill_email','<strong> Invalid E-mail Id.</strong>',2);
		    return false;
		  }
		 
		
	 }
	 var cardtype = document.getElementById("DonorsCardTypeAmex");
	 var cardnumber = document.getElementById("cardnumber").value;
	 var cvvno = document.getElementById("cvvno").value;
	 var month = document.getElementById("month").value;
	 var year = document.getElementById("year").value;
	 
	 var date = new Date();
	
	 var m = date.getMonth() + 1;
	 var monthjs = (m < 10) ? '0' + m : m;
	 var yy = date.getYear();
	 var yearjs = (yy < 1000) ? yy + 1900 : yy;
	 
	 
	if(creditcard.checked ==true){
		
		if(cardnumber =="")
		{
			inlineMsg('cardnumber','<strong> Please enter Credit Card Number.</strong>',2);
			return false;
		}
	
		if(checkcreditcard(cardnumber) ==false)
		{
			inlineMsg('cardnumber','<strong> Please enter valid Credit Card Number.</strong>',2);
			return false;
		}
		if(cardnumber < 12)
		{
			inlineMsg('cardnumber','<strong> Credit Card Number should greater then 11.</strong>',2);
			return false;
		}
		if(cvvno =="")
		{
			inlineMsg('cvvno','<strong> Please enter CVV Number.</strong>',2);
			return false;
		}
		
		if(cardtype.checked==true && cvvno.length <=3)
		{
			
				inlineMsg('cvvno','<strong> Please enter 4 digit CVV Number for Amarican Express.</strong>',2);
				return false; 
			
		}
		
		if(month =="")
		{
			inlineMsg('year','<strong> Please select Expiration Month.</strong>',2);
			return false;
		}
		
		if(month < monthjs && year <= yearjs)
		{
			inlineMsg('year','<strong> Please select valid Expiration Month.</strong>',2);
			return false;
		}
		if(year =="")
		{
			inlineMsg('year','<strong> Please select Expiration Year.</strong>',2);
			return false;
		}
		if(year < yearjs)
		{
			inlineMsg('year','<strong> Please select valid Expiration Year.</strong>',2);
			return false;
		}
	}	
	 
	 return true;
}


/*
 * Function name          : checksearch()
 * Description            : This function is used to check search page validation
 * Parameters 			  : N/A
 * Created On             : 28-06-10 (10:50am)                          
 */
function checksearchfind(sec){
	
	 var searchkeyword = document.getElementById("searchkeyword").value;
	 if(sec == "onlyfind"){
		 
		 if((searchkeyword=='search keyword' || searchkeyword==""))
		 {
			 //inlineMsg('searchkeyword','<strong>Please enter keyword.</strong>',2);
			 //return false;
			 document.getElementById("searchkeyword").value="";
		 }
		
	 }
	 
	 if(sec == "findall"){
		document.getElementById("searchkeyword").value="";		
	 }	
	return true;
}

/*
 * Function name          : validateregisterpage()
 * Description            : This function is used to validate the group registration process one page
 * Parameters 			  : N/A
 * Created On             : 06-07-10 (11:55am)                          
 */


function validateregisterpage(){
	
	
	//Validation for username
	
	if($('#user_name').val() =="")
	 {
		 inlineMsg('user_name','<strong>Please enter Username/UserId.</strong>',2);
		 return false;
	 }
	if($('#user_name').val().length < 4 || $('#user_name').val().length >20)
	 {
		 inlineMsg('user_name','<strong>Maximum length of Username/UserId is 20 and Minimum is 4.</strong>',2);
		 return false;
	 }
	if(!isUserName($('#user_name').val()))
	 {
		 inlineMsg('user_name','<strong>Only allowed Alpha numeric character with (@,.).</strong>',2);
		 return false;
	 }
	//end Validation of username
	
	if($('#password').val() =="")
	 {
		 inlineMsg('password','<strong>Please enter password.</strong>',2);
		 return false;
	 }
	if($('#password').val().length < 6 || $('#password').val().length >20)
	 {
		 inlineMsg('password','<strong>Maximum length of password is 20 and Minimum is 6.</strong>',2);
		 return false;
	 }
	if($('#vpassword').val() =="")
	 {
		 inlineMsg('vpassword','<strong>Please enter verify password.</strong>',2);
		 return false;
	 }
	
	if($('#password').val() !== $('#vpassword').val())
	 {
		 inlineMsg('vpassword','<strong>Password and verify password does not match.</strong>',2);
		 return false;
	 }
	
	
	if($('#email').val() =="")
	 {
		 inlineMsg('email','<strong>Please enter email address.</strong>',2);
		 return false;
	 }
	if(!validateemail($('#email').val()))
	 {
		 inlineMsg('email','<strong>Please enter valid email address.</strong>',2);
		 return false;
	 }
	if($('#vemail').val() =="")
	 {
		 inlineMsg('vemail','<strong>Please enter verify E-mail.</strong>',2);
		 return false;
	 }
	if($('#email').val() !== $('#vemail').val())
	 {
		 inlineMsg('vemail','<strong>E-mail and Verify E-mail does not match.</strong>',2);
		 return false;
	 }
	
	
	if($('#securityquestion').val() =="")
	 {
		 inlineMsg('securityquestion','<strong>Please select Security Question.</strong>',2);
		 return false;
	 }
	
	if($('#securityanswer').val() =="")
	 {
		 inlineMsg('securityanswer','<strong>Please enter Security Answer.</strong>',2);
		 return false;
	 }
	if(!organizationname($('#securityanswer').val()))
	 {
		 inlineMsg('securityanswer','<strong>Only allowed Alpha numeric character with space.</strong>',2);
		 return false;
	 }
	
	
}



/*
 * Function name          : validategroupinfopage()
 * Description            : This function is used to validate the group information page
 * Parameters 			  : N/A
 * Created On             : 30-06-10 (11:20am)                          
 */
function validategroupinfopage(){
	
	
	/*Group Registration section*/
	
	
//Validation for username
	
	if($('#user_name').val() =="")
	 {
		 inlineMsg('user_name','<strong>Please enter Username/UserId.</strong>',2);
		 return false;
	 }
	if($('#user_name').val().length < 4 || $('#user_name').val().length >20)
	 {
		 inlineMsg('user_name','<strong>Maximum length of Username/UserId is 20 and Minimum is 4.</strong>',2);
		 return false;
	 }
	if(!isUserName($('#user_name').val()))
	 {
		 inlineMsg('user_name','<strong>Only allowed Alpha numeric character with (@,.).</strong>',2);
		 return false;
	 }
	//end Validation of username
	
	if($('#password').val() =="")
	 {
		 inlineMsg('password','<strong>Please enter password.</strong>',2);
		 return false;
	 }
	if($('#password').val().length < 6 || $('#password').val().length >20)
	 {
		 inlineMsg('password','<strong>Maximum length of password is 20 and Minimum is 6.</strong>',2);
		 return false;
	 }
	if($('#vpassword').val() =="")
	 {
		 inlineMsg('vpassword','<strong>Please enter verify password.</strong>',2);
		 return false;
	 }
	
	if($('#password').val() !== $('#vpassword').val())
	 {
		 inlineMsg('vpassword','<strong>Password and verify password does not match.</strong>',2);
		 return false;
	 }
	
	
	if($('#email').val() =="")
	 {
		 inlineMsg('email','<strong>Please enter email address.</strong>',2);
		 return false;
	 }
	if(!validateemail($('#email').val()))
	 {
		 inlineMsg('email','<strong>Please enter valid email address.</strong>',2);
		 return false;
	 }
	if($('#vemail').val() =="")
	 {
		 inlineMsg('vemail','<strong>Please enter verify E-mail.</strong>',2);
		 return false;
	 }
	if($('#email').val() !== $('#vemail').val())
	 {
		 inlineMsg('vemail','<strong>E-mail and Verify E-mail does not match.</strong>',2);
		 return false;
	 }
	
	
	if($('#securityquestion').val() =="")
	 {
		 inlineMsg('securityquestion','<strong>Please select Security Question.</strong>',2);
		 return false;
	 }
	
	if($('#securityanswer').val() =="")
	 {
		 inlineMsg('securityanswer','<strong>Please enter Security Answer.</strong>',2);
		 return false;
	 }
	if(!organizationname($('#securityanswer').val()))
	 {
		 inlineMsg('securityanswer','<strong>Only allowed Alpha numeric character with space.</strong>',2);
		 return false;
	 }
	
	
	
	/*================End Group Registration======================*/
	
	if($('#first_name').val() =="")
	 {
		 inlineMsg('first_name','<strong>Please enter Administrator First Name.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#first_name').val()))
	 {
		 inlineMsg('first_name','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#first_name').val())){
		inlineMsg('first_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	if($('#middle_name').val() !="")
	 {
		if(!isFirstName($('#middle_name').val()))
		 {
			 inlineMsg('middle_name','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		if(!spaceValidation($('#middle_name').val())){
			inlineMsg('middle_name','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	 }
	
	
	
	if($('#last_name').val() =="")
	 {
		 inlineMsg('last_name','<strong>Please enter Administrator Last Name.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#last_name').val()))
	 {
		 inlineMsg('last_name','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#last_name').val())){
		inlineMsg('last_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	if($('#group_name').val() =="")
	 {
		 inlineMsg('group_name','<strong>Please enter Organization Name.</strong>',2);
		 return false;
	 }
	if($('#group_name').val().length < 3 )
	 {
		 inlineMsg('group_name','<strong>Minimum length for Organization name is 3.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#group_name').val())){
		inlineMsg('group_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	if(!organizationname($('#group_name').val()))
	 {
		 inlineMsg('group_name','<strong>Only allowed Alpha numeric character with space.</strong>',2);
		 return false;
	 }
	
	if($('#street1').val() =="")
	 {
		 inlineMsg('street1','<strong>Please enter Street.</strong>',2);
		 return false;
	 }
	if($('#street1').val().length < 6)
	 {
		 inlineMsg('street1','<strong>Minimum length for Street  is 6.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#street1').val())){
		inlineMsg('street1','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	if($('#country').val()==""){
		 inlineMsg('country','<strong> Please select Country.</strong>',2);
		 return false;
	}
	
	 if($('#city').val() =="")
	 {
		 inlineMsg('city','<strong> Please enter City.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#city').val()))
	{
		inlineMsg('city','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}
	if(!spaceValidation($('#city').val())){
			inlineMsg('city','<strong> Blank space not allowed.</strong>',2);
				return false;
	}
	
	
	 if($('#state').type=='text')
	 {
		 
		 if($('#state').val() ==""){
			 inlineMsg('state','<strong> Please enter State.</strong>',2);
			 return false;
		}	
		
		if(!spaceValidation($('#state').val())){
			inlineMsg('state','<strong> Blank space not allowed.</strong>',2);
			return false;
		}

		if(!isFirstName($('#state').val()))
		{ 
			inlineMsg('state','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}	
	 }else{
		 if($('#state').val() ==""){
			 inlineMsg('state','<strong> Please Select State.</strong>',2);
			 return false;
		}	
		 
	 }


	 if($('#zipcode').val() =="")
	 {
		 inlineMsg('zipcode','<strong> Please enter ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#zipcode').val())){
		inlineMsg('zipcode','<strong> Blank space not allowed.</strong>',2);
		return false;
	}

	 if($('#zipcode').val().length < 5)
	 {
		 inlineMsg('zipcode','<strong> ZIP/Postal Code should greater then 4.</strong>',2);
		 return false;
	 }
	 if(isNaN($('#zipcode').val()))
	 {
		 inlineMsg('zipcode','<strong> Please enter valid ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	
		
	if($('#phone').val() =="")
	 {
		 inlineMsg('phone','<strong>Please enter phone number.</strong>',2);
		 return false;
	 }
	if(!ParseUSNumber($('#phone').val()))
	 {
		 inlineMsg('phone','<strong>Phone number must be like xxx-xxx-xxxx format.</strong>',2);
		 return false;
	 }
	if(!ParseUSNumber($('#fax').val()) && $('#fax').val() !="")
	 {
		 inlineMsg('fax','<strong>Fax number must be like xxx-xxx-xxxx format.</strong>',2);
		 return false;
	 }
	
	if($('#grouptype').val() =="")
	 {
		 inlineMsg('grouptype','<strong>Please Select Organization Type.</strong>',2);
		 return false;
	 }
	
	if($('#group_subtype').val() =="")
	 {
		 inlineMsg('group_subtype','<strong>Please Select Organization Sub Type.</strong>',2);
		 return false;
	 }
	
	if($('#taxtype').val() =="")
	 {
		 inlineMsg('taxtype','<strong>Please select Tax type.</strong>',2);
		 return false;
	 }
	

		if($('#magiccode').val() =="" || !$('#magiccode').val())
		 {
			 inlineMsg('upload_area','<strong>Please Upload Logo for an Organization.</strong>',2);
			 return false;
		 }
	

	
	if($('#group_description').val() =="")
	 {
		 inlineMsg('group_description','<strong>Please enter Group Mission.</strong>',2);
		 return false;
	 }
	
	
	
	 
	 if(validateadbookstructure()==false){
		 return false;
	 }
	 
	 if(validatepaymentinfo()==false){
		 return false;
	 }
	
	
	/*end AdBook Pricing*/
	
	document.getElementById('groupinfo').action = '';
	document.getElementById('groupinfo').target = '';
	return true;
	 
}


/*
 * Function name          : validateeditgroupinformationpage()
 * Description            : This function is used to validate the group information page
 * Parameters 			  : N/A
 * Created On             : 14-07-10 (04:50pm)                          
 */


function validateeditgroupinformationpage(){
	
	
	
//Validation for username
	
	if($('#user_name').val() =="")
	 {
		 inlineMsg('user_name','<strong>Please enter Username/UserId.</strong>',2);
		 return false;
	 }
	if($('#user_name').val().length < 4 || $('#user_name').val().length >20)
	 {
		 inlineMsg('user_name','<strong>Maximum length of Username/UserId is 20 and Minimum is 4.</strong>',2);
		 return false;
	 }
	if(!isUserName($('#user_name').val()))
	 {
		 inlineMsg('user_name','<strong>Only allowed Alpha numeric character with (@,.).</strong>',2);
		 return false;
	 }
	
	
	//end Validation of username
	if($('#changep:checked').val()=='checked'){
		
		
		if($('#oldpassword').val() =="")
		 {
			 inlineMsg('oldpassword','<strong>Please Old Password.</strong>',2);
			 return false;
		 }
		if($('#oldpassword').val().length < 6 || $('#oldpassword').val().length >20)
		 {
			 inlineMsg('oldpassword','<strong>Maximum length of Old Password is 20 and Minimum is 6.</strong>',2);
			 return false;
		 }
		
		if($('#newpassword').val() =="")
		 {
			 inlineMsg('newpassword','<strong>Please New Password.</strong>',2);
			 return false;
		 }
		if($('#newpassword').val().length < 6 || $('#newpassword').val().length >20)
		 {
			 inlineMsg('newpassword','<strong>Maximum length of New Password is 20 and Minimum is 6.</strong>',2);
			 return false;
		 }
		if($('#vpassword').val() =="")
		 {
			 inlineMsg('vpassword','<strong>Please enter verify password.</strong>',2);
			 return false;
		 }
		
		if($('#newpassword').val() !== $('#vpassword').val())
		 {
			 inlineMsg('vpassword','<strong>Password and verify password does not match.</strong>',2);
			 return false;
		 }
		
		return true;
		
	}
	
	
	
	if($('#email').val() =="")
	 {
		 inlineMsg('email','<strong>Please enter email address.</strong>',2);
		 return false;
	 }
	if(!validateemail($('#email').val()))
	 {
		 inlineMsg('email','<strong>Please enter valid email address.</strong>',2);
		 return false;
	 }
	
	
	
	if($('#securityquestion').val() =="")
	 {
		 inlineMsg('securityquestion','<strong>Please select Security Question.</strong>',2);
		 return false;
	 }
	
	if($('#securityanswer').val() =="")
	 {
		 inlineMsg('securityanswer','<strong>Please enter Security Answer.</strong>',2);
		 return false;
	 }
	if(!organizationname($('#securityanswer').val()))
	 {
		 inlineMsg('securityanswer','<strong>Only allowed Alpha numeric character with space.</strong>',2);
		 return false;
	 }
	
	
	if($('#first_name').val() =="")
	 {
		 inlineMsg('first_name','<strong>Please enter Administrator First Name.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#first_name').val()))
	 {
		 inlineMsg('first_name','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#first_name').val())){
		inlineMsg('first_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	if($('#last_name').val() =="")
	 {
		 inlineMsg('last_name','<strong>Please enter Administrator Last Name.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#last_name').val()))
	 {
		 inlineMsg('last_name','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#last_name').val())){
		inlineMsg('last_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	if($('#group_name').val() =="")
	 {
		 inlineMsg('group_name','<strong>Please enter Organization Name.</strong>',2);
		 return false;
	 }
	if($('#group_name').val().length < 3 )
	 {
		 inlineMsg('group_name','<strong>Minimum length for Organization name is 3.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#group_name').val())){
		inlineMsg('group_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	if(!organizationname($('#group_name').val()))
	 {
		 inlineMsg('group_name','<strong>Only allowed Alpha numeric character with space.</strong>',2);
		 return false;
	 }
	
	if($('#street1').val() =="")
	 {
		 inlineMsg('street1','<strong>Please enter Street.</strong>',2);
		 return false;
	 }
	if($('#street1').val().length < 6)
	 {
		 inlineMsg('street1','<strong>Minimum length for Street  is 6.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#street1').val())){
		inlineMsg('street1','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	if($('#country').val()==""){
		 inlineMsg('country','<strong> Please select Country.</strong>',2);
		 return false;
	}
	
	 if($('#city').val() =="")
	 {
		 inlineMsg('city','<strong> Please enter City.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#city').val()))
	{
		inlineMsg('city','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}
	if(!spaceValidation($('#city').val())){
			inlineMsg('city','<strong> Blank space not allowed.</strong>',2);
				return false;
	}
	
	
	 if($('#state').type=='text')
	 {
		 
		 if($('#state').val() ==""){
			 inlineMsg('state','<strong> Please enter State.</strong>',2);
			 return false;
		}	
		
		if(!spaceValidation($('#state').val())){
			inlineMsg('state','<strong> Blank space not allowed.</strong>',2);
			return false;
		}

		if(!isFirstName($('#state').val()))
		{ 
			inlineMsg('state','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}	
	 }else{
		 if($('#state').val() ==""){
			 inlineMsg('state','<strong> Please Select State.</strong>',2);
			 return false;
		}	
		 
	 }
	 if($('#zipcode').val() =="")
	 {
		 inlineMsg('zipcode','<strong> Please enter ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#zipcode').val())){
		inlineMsg('zipcode','<strong> Blank space not allowed.</strong>',2);
		return false;
	}

	 if($('#zipcode').val().length < 5)
	 {
		 inlineMsg('zipcode','<strong> ZIP/Postal Code should greater then 4.</strong>',2);
		 return false;
	 }
	 if(isNaN($('#zipcode').val()))
	 {
		 inlineMsg('zipcode','<strong> Please enter valid ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	
		
	if($('#phone').val() =="")
	 {
		 inlineMsg('phone','<strong>Please enter phone number.</strong>',2);
		 return false;
	 }
	if(!ParseUSNumber($('#phone').val()))
	 {
		 inlineMsg('phone','<strong>Phone number must be like xxx-xxx-xxxx format.</strong>',2);
		 return false;
	 }
	if(!ParseUSNumber($('#fax').val()) && $('#fax').val() !="")
	 {
		 inlineMsg('fax','<strong>Fax number must be like xxx-xxx-xxxx format.</strong>',2);
		 return false;
	 }
	
	if($('#grouptype').val() =="")
	 {
		 inlineMsg('grouptype','<strong>Please Select Organization Type.</strong>',2);
		 return false;
	 }
	
	if($('#group_subtype').val() =="")
	 {
		 inlineMsg('group_subtype','<strong>Please Select Organization Sub Type.</strong>',2);
		 return false;
	 }
	
	if($('#taxtype').val() =="")
	 {
		 inlineMsg('taxtype','<strong>Please select Tax type.</strong>',2);
		 return false;
	 }
	
	
		if($('#magiccode').val() =="" || !$('#magiccode').val())
		 {
			 inlineMsg('upload_area','<strong>Please Upload Logo for an Organization.</strong>',2);
			 return false;
		 }
	

	
	if($('#group_description').val() =="")
	 {
		 inlineMsg('group_description','<strong>Please enter Group Mission.</strong>',2);
		 return false;
	 }
	document.getElementById('editgroupinfo').action = '';
	document.getElementById('editgroupinfo').target = '';
	return true;	 
}
/*
 * Function name          : validateadbookstructure()
 * Description            : This function is used to validate the adbookpricing page
 * Parameters 			  : N/A
 * Created On             : 01-07-10 (09:55am)                          
 */
function validateadbookstructure(){
	
		//validate addbook pricing entery
		 
		 if(validateAdbookpricingstructure()==false){
			 return false;
		 }

		 if($('#onlinediryes:checked').val() =='1'){
			 
						
					 if($('#odamount').val()=="")
					 {
						 inlineMsg('odamount','<strong> Please enter Online Directory Amount.</strong>',2);
						 return false;
					 }
					if(!isnumerice($('#odamount').val()))
					 {
						 inlineMsg('odamount','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
						 return false;
					 }
					
					
					return true;
		 }else{
			 
			 document.getElementById("odamount").value='';
			
				return true;		
		 }
		
		return true;

}



/*
 * Function name          : validatepaymentinfo()
 * Description            : This function is used to validate the group payment information page
 * Parameters 			  : N/A
 * Created On             : 01-07-10 (05:10pm)                          
 */
function validatepaymentinfo(){
	
	
	if($('#paymentmediumcheque:checked').val() =='1'){
	
					if($('#check_name').val() =="")
					 {
						 inlineMsg('check_name','<strong>Please enter Name on cheque.</strong>',2);
						 return false;
					 }
					if(!isFirstName($('#check_name').val()))
					 {
						 inlineMsg('check_name','<strong>Only Alphabets, single quote and space allowed.</strong>',2);
						 return false;
					 }
					
					if($('#check_address').val() =="")
					 {
						 inlineMsg('check_address','<strong>Please enter Address.</strong>',2);
						 return false;
					 }
					if(!spaceValidation($('#check_address').val()))
					 {
						 inlineMsg('check_address','<strong> Blank space not allowed.</strong>',2);
						 return false;
					 }
					
					
					if($('#check_city').val() =="")
					 {
						 inlineMsg('check_city','<strong> Please enter City.</strong>',2);
						 return false;
					 }
					if(!isFirstName($('#check_city').val()))
					{
						inlineMsg('check_city','<strong>Only alphabets, single quote and space allowed.</strong>',2);
						return false;
					}
					if(!spaceValidation($('#check_city').val())){
							inlineMsg('check_city','<strong> Blank space not allowed.</strong>',2);
								return false;
					}
					
					if($('#check_state').val() ==""){
						 inlineMsg('check_state','<strong> Please Select State.</strong>',2);
						 return false;
					}	
					
					if($('#check_zipcode').val() =="")
					 {
						 inlineMsg('check_zipcode','<strong> Please enter Zipcode Code.</strong>',2);
						 return false;
					 }
					if(!spaceValidation($('#check_zipcode').val())){
						inlineMsg('check_zipcode','<strong> Blank space not allowed.</strong>',2);
						return false;
					}
			
					 if($('#check_zipcode').val().length < 5)
					 {
						 inlineMsg('check_zipcode','<strong> Zipcode Code should greater then 4.</strong>',2);
						 return false;
					 }
					 if(isNaN($('#check_zipcode').val()))
					 {
						 inlineMsg('check_zipcode','<strong> Please enter valid Zipcode.</strong>',2);
						 return false;
					 }
					
					
	
	}else{
		
					if($('#eft_actname').val() =="")
					 {
						 inlineMsg('eft_actname','<strong>Please enter Account Name.</strong>',2);
						 return false;
					 }
					if(!spaceValidation($('#eft_actname').val())){
						inlineMsg('eft_actname','<strong> Blank space not allowed.</strong>',2);
						return false;
					}
					if(!isFirstName($('#eft_actname').val()))
					 {
						 inlineMsg('eft_actname','<strong>Only Alphabets, single quote and space allowed.</strong>',2);
						 return false;
					 }
					if($('#eft_actnumber').val() =="")
					 {
						 inlineMsg('eft_actnumber','<strong> Please enter Account Number.</strong>',2);
						 return false;
					 }
					if(!spaceValidation($('#eft_actnumber').val())){
						inlineMsg('eft_actnumber','<strong> Blank space not allowed.</strong>',2);
						return false;
					}
					if(!isnumerice($('#eft_actnumber').val())){
						inlineMsg('eft_actnumber','<strong> Only numeric value allowed.</strong>',2);
						return false;
					}
					
					if($('#eft_rotnumber').val() =="")
					 {
						 inlineMsg('eft_rotnumber','<strong> Please enter Routing number.</strong>',2);
						 return false;
					 }
					if(!spaceValidation($('#eft_rotnumber').val())){
						inlineMsg('eft_rotnumber','<strong> Blank space not allowed.</strong>',2);
						return false;
					}
					if(!isnumerice($('#eft_rotnumber').val())){
						inlineMsg('eft_rotnumber','<strong> Only numeric value allowed.</strong>',2);
						return false;
					}
					
	}
	return true;
		

}


/*
 * Function name          : showhidepaymentmedium()
 * Description            : This function is used to validate the group payment information page
 * Parameters 			  : N/A
 * Created On             : 01-07-10 (05:10pm)                          
 */
function showhidepaymentmedium(act)
{
	
	var e = document.getElementById("electronicpayment");
	var e2 = document.getElementById("checkpayment");
	
	if(act ==1){
		
		e.style.display = 'none'	
			e2.style.display = 'block';
		
			document.getElementById("eft_actname").value='';
		    document.getElementById("eft_actnumber").value='';
		    document.getElementById("eft_rotnumber").value='';
			
			
	}else{
		e.style.display = 'block'	
		e2.style.display = 'none';
			document.getElementById("check_name").value='';
			document.getElementById("check_address").value='';
			document.getElementById("check_city").value='';
			document.getElementById("check_state").value='';
			document.getElementById("check_zipcode").value='';
		
	}
	return true;
	
}


function showchangepwddiv(divid,checkid){
    if(document.getElementById(checkid).checked==true){
        document.getElementById(divid).style.display='inline';
    }
    else{
        document.getElementById(divid).style.display='none';
    }
}
function validatedonorprofile(){

	
	var email = document.getElementById('email').value
	
	if(document.getElementById('first').value==""){
		inlineMsg('first','<strong>Please enter First Name</strong>',2);
		return false;
	}

	if(!isFirstName(document.getElementById('first').value)){
		inlineMsg('first','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}

	if(!spaceValidation(document.getElementById('first').value)){
		inlineMsg('first','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	if(document.getElementById('middle').value!=""){
		if(!isFirstName(document.getElementById('middle').value)){
			inlineMsg('middle','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}
	
		if(!spaceValidation(document.getElementById('middle').value)){
			inlineMsg('middle','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
	}
	
	if(document.getElementById('last').value==""){
		inlineMsg('last','<strong>Please enter Last Name</strong>',2);
		return false;
	}
	if(!isFirstName(document.getElementById('last').value)){
		inlineMsg('last','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}
	if(!spaceValidation(document.getElementById('last').value)){
		inlineMsg('last','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	if(document.getElementById('street1').value==""){
		inlineMsg('street1','<strong>Please enter Street 1 Address</strong>',2);
		return false;
	}
	if(!spaceValidation(document.getElementById('street1').value)){
		inlineMsg('street1','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	if(document.getElementById('country').value==""){
		inlineMsg('country','<strong>Please select Country</strong>',2);
		return false;
	}
	if(document.getElementById('state').value==""){
		inlineMsg('state','<strong>Please enter State</strong>',2);
		return false;
	}
	if(document.getElementById('state').type=='text'){
		if(!isFirstName(document.getElementById('state').value)){
			inlineMsg('state','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}
	
		if(!spaceValidation(document.getElementById('state').value)){
			inlineMsg('state','<strong> Blank space not allowed.</strong>',2);
			return false;
		}
	}
	
	if(document.getElementById('city').value==""){
		inlineMsg('city','<strong>Please enter City</strong>',2);
		return false;
	}
	if(!isFirstName(document.getElementById('city').value)){
		inlineMsg('city','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}
	if(!spaceValidation(document.getElementById('city').value)){
		inlineMsg('city','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	if(document.getElementById('zipcode').value==""){
		inlineMsg('zipcode','<strong>Please enter ZIP/Postal Code</strong>',2);
		return false;
	}
	if(document.getElementById('zipcode').value.length < 5)
	{
		inlineMsg('zipcode','<strong>ZIP/Postal Code should greater then 4.</strong>',2);
		return false;
	}
	/*if(isEmpty(document.getElementById('zipcode').value)){
		inlineMsg('zipcode','<strong> Blank space not allowed.</strong>',2);
		return false;
	}*/
	if(isNaN(document.getElementById('zipcode').value))
	{
		inlineMsg('zipcode','<strong>Please enter valid ZIP/Postal Code.</strong>',2);
		return false;
	}
	
	
	if(email==""){
		inlineMsg('email','<strong>You must enter your Email</strong>',2);
		return false;
	}
	if(!validateemail(email)){
		inlineMsg('email','<strong>Invalid Email.</strong>',2);
		return false;
	}
	if(document.getElementById('changep').checked==true){
		if(document.getElementById('opassword').value==""){
		inlineMsg('opassword','<strong>Please enter Old Password.</strong>',2);
		return false;   
		}
		if(document.getElementById('opassword').value.length < 6){
			inlineMsg('opassword','<strong>Minimum length for Old Password is 6</strong>',2);
			return false;   
			}
		if(document.getElementById('npassword').value==""){
		inlineMsg('npassword','<strong>Please enter New Password.</strong>',2);
		return false;   
		}
		if(document.getElementById('npassword').value.length < 6){
			inlineMsg('npassword','<strong>Minimum length for New Password is 6</strong>',2);
			return false;   
			}
		if(document.getElementById('cpassword').value==""){
		inlineMsg('cpassword','<strong>Please enter Confirm Password.</strong>',2);
		return false;   
		}
		
		if(document.getElementById('cpassword').value != document.getElementById('npassword').value){
		inlineMsg('cpassword','<strong>New entered password and confirm password does not match</strong>',2);
		return false;   
		}
	}
	
	return true;


}

function containsAlphabets(checkString) {
        var tempString="";
        var regExp = /^[A-Za-z]$/;
        if(checkString != null && checkString != "")
        {
          for(var i = 0; i < checkString.length; i++)
          {
            if (!checkString.charAt(i).match(regExp))
            {
              return false;
            }
          }
        }else{

          return false;

        }

        return true;

}

function textlimit(e){



	if($('#hiddenpricing').val()=="1_Gold" || $('#hiddenpricing').val()=="1_Silver" || $('#hiddenpricing').val()=="1_Sponsor"){
		var maxtext = "1000";
		var filtype = "Full";
	}
	if($('#hiddenpricing').val()=="2_Gold" || $('#hiddenpricing').val()=="2_Silver" || $('#hiddenpricing').val()=="2_Sponsor"){
		var maxtext = "500";
		var filtype = "Half";
	}
	if($('#hiddenpricing').val()=="3_Sponsor"){
		var maxtext = "300";	
		var filtype = "Quator";
		}
	if($('#hiddenpricing').val()=="4_Sponsor"){
		var maxtext = "200";	
		var filtype = "Business";
	}
	if($('#hiddenpricing').val()=="6_Sponsor"){
		var maxtext = "150";	
		var filtype = "Message";
	}
	if($('#hiddenpricing').val()=="1"){ 
		var maxtext = "150";	
		var filtype = "Message";
	}
	if(e){
	if(e.type=='keydown' || e.type=='keyup' ||  e.type=='keypress'){
		if(textcounterforad(maxtext,filtype) == false){
			return false;
		}
		
	}
	}else{
		if(textcounterforad(maxtext,filtype) == false){
			 inlineMsg('mce_editor_0','<strong>Max limit for '+filtype+' is '+maxtext+'',2);
		        return false;
		}
	}
	return true;
	
}

function textcounterforad(maxlimit,leveltype){
	
	tinyMCE.triggerSave(true,true);
	var mytextarea = tinyMCE.activeEditor.getContent();
	  txt = mytextarea.replace(/(<([^>]+)>)/ig,"");
      txt = mytextarea.replace(/&nbsp;/g,"");
      
	if (txt.length > maxlimit){ // if too long...trim it!
		
		var str = txt.substr(0,maxlimit);
		 tinyMCE.execCommand('mceSetContent',false,txt);
		    
	     return false;
			
	}// otherwise, update 'characters left' counter
	else{
		document.getElementById('maxlentxt').value = maxlimit - txt.length;
	}
}




function validatedonation(){

	tinyMCE.triggerSave(true,true);
    	var mytextarea = tinyMCE.activeEditor.getContent();

	if($('#ano:checked').val()=='1'){
		var anoamt = $('#anoamount').val();
		if(anoamt==''){
			inlineMsg('anoamount','<strong>Please enter Donation Amount.</strong>',2);
	    		return false;	
		}
		if(isNaN(anoamt)){
			inlineMsg('anoamount','<strong>Please enter valid Donation Amount.</strong>',2);
	    		return false;	
		}
		if(parseFloat(anoamt) < parseFloat(document.getElementById('userfor').value)){
			inlineMsg('anoamount','<strong>Current amount should greater than or equal to previous donation amount.</strong>',2);
	    		return false;	
		}
	}	
    	
	 if (mytextarea != '' && document.getElementById('magiccode') !=null)
	    {
		 document.getElementById('magiccode').value='';
		 inlineMsg('mce_editor_0_tbl','<strong>Either upload image or enter content in editor.</strong>',2);
	        return false;
	    }

	if (mytextarea != '' && document.getElementById('adimage').value !='')
	    {
		
		 inlineMsg('adimage','<strong>Either upload image or enter content in editor.</strong>',2);
	        return false;
	    }	
	if (mytextarea == '' && document.getElementById('magiccode') ==null && document.getElementById('adimage').value =='')
	    {
		 inlineMsg('mce_editor_0_tbl','<strong>Either upload image or enter content in editor.</strong>',2);
	        return false;
	    }
	if (mytextarea != '' && !spaceValidation(mytextarea))
	    {
		 inlineMsg('mce_editor_0_tbl','<strong>Blank space not allowed</strong>',2);
	        return false;
	    }
	
	 if (mytextarea != '' && document.getElementById('magiccode') ==null)
	    {
		
			        if(textlimit()==false){
			        	return false;
			        }
	    }
	
	
	if(document.getElementById('onlinedir').checked==true){
		//fname = trim(document.getElementById('fname').value," ")
		if($('#fname').val() =="")
		{
			inlineMsg('fname','<strong>Please enter First Name.</strong>',2);
			return false;
		}
		if(!spaceValidation($('#fname').val())){
			inlineMsg('fname','<strong> Blank space not allowed.</strong>',2);
			return false;
	 	}
	 
		if(!isFirstName($('#fname').val()))
	 	{	
			 inlineMsg('fname','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		}
		if($('#lname').val() =="")
		 {
			 inlineMsg('lname','<strong>Please enter Last Name.</strong>',2);
			 return false;
		 }
		if(!isFirstName($('#lname').val()))
	 	{	
			 inlineMsg('lname','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		}
		if(!spaceValidation($('#lname').val())){
			inlineMsg('lname','<strong> Blank space not allowed.</strong>',2);
			return false;
	 	}

		if($('#email').val()!=''){
			if(!validateemail($('#email').val())){
				inlineMsg('email','<strong>Invalid Email.</strong>',2);
				return false;
			}
		}
		if($('#phone').val()!='' && ($('#phone').val().length>12 || $('#phone').val().length <10)){
			inlineMsg('phone','<strong>Please enter valid phone number.</strong>',2);
			return false;
		}
		if($('#phone').val()!=''){
			if(!ParseUSNumber($('#phone').val())){
				inlineMsg('phone','<strong>Phone number must be like xxx-xxx-xxxx format.</strong>',2);
				return false;
			}
		}	

			
	}
	
	return true;


}

/*
 * Function name          : invitationmail()
 * Description            : This function is used to validate invitataion status page

 * Parameters 			  : value decide whther to search or send mail button ,group id, event id 
 * Created On             : 07-07-10 (5:41pm)                          
 */

function invitationmail(val,groupid,eventid){
	max = document.getElementById('max').value;
	//alert(val);
	faction='';
	tcnt=0;
	if(val!='search')
	{
		for(cnt=1;cnt<=max;cnt++){
			
			if(document.getElementById('DonorEmails'+cnt).checked ==false){
				tcnt++;
			}
		}
		
		if(tcnt==max && val=='selected'){ 
			inlineMsg('selected','<strong>Select at least one email to send mail</strong>',2);
			return false;
		}
		if(max ==0 && val=='all'){ 
			inlineMsg('allid','<strong>Email Id not available in list.</strong>',2);
			return false;
		}
		if(groupid!='')
		faction = "/donors/sendinvitationmail/"+groupid;
		else if(groupid!='' && eventid!='')
		faction = "/donors/sendinvitationmail/"+groupid+"/"+eventid;
		else
		faction = "/donors/sendinvitationmail/";
		document.getElementById('cmail').action = faction ;// '/donors/sendinvitationmail/1/1/'
	}else{
		
	}
	document.getElementById('to').value =val;
	
	document.getElementById('cmail').submit();
}	


/*
 * Function name          : selecall()
 * Description            : This function is used to check all checkbox/uncheck all checkbox
 * Parameters 			  : N/A
 * Created On             : 07-07-10 (5:41pm)                          
 */
function selectall(id){ 
	var cnt ; 
	
	var max = document.getElementById('max').value;
	var flag; 
	
	
	
	if($('#'+id+':checked').val() =='1'){
		flag = true;
		
	}else{
		flag = false;
	}
	for(cnt=1;cnt<=max;cnt++){
		document.getElementById('DonorEmails'+cnt).checked =flag;
	}
}

/*
 * Function name          : addemail()
 * Description            : This function is used to add selected email into textarea
 * Parameters 			  : total counter
 
 */

function addemail(cnt){
	
	//var str=opener.document.getElementById('emails').value.split(",");
	
	//$('#'+id+':checked').val()
	//document.getElementById('emailchk_'+cnt).checked==true
	opener.document.getElementById('emails').value ='';
	var chk='';
	for(i=1;i<=cnt;i++){	
		if($('#emailchk_'+i+':checked').val()==1)
		{	
			opener.document.getElementById('emails').value = opener.document.getElementById('emails').value+document.getElementById('emailidchk_'+i).value+","; 
			chk='set'
		
		}
	 
	}
	if(chk==''){
		inlineMsg('emailchk_1','<strong>Please select at least one Email Id.</strong>',3);
				
	}else{
		window.close();
	}
}

//FUNCTION USED TO CHECK BLANK SPACE 
function isEmpty(str){
     strRE = new RegExp( );
     strRE.compile( '^[\s ]*$', 'gi' );
     
     return strRE.test(str);
 }

/*
 * Function name          : spaceValidation()
 * Description            : This function is used to check for blank space validation
 * Parameters 			  : N/A
 * Created On             : 07-07-10 (10:00am)                          
 */

function spaceValidation(str){
		var value = str;
		    value = value.replace(/^\s+|\s+$/, '');
		 
		if(value.length == 0  ){
			//alert('Please enter name');
			return false ; 
		}
		return true;
	}


/*
 * Function name          : opennewwindow()
 * Description            : This function is used to display the abol supplied logos
 * Parameters 			  : N/A
 * Created On             : 06-07-10 (05:10pm)                          
 */

<!--  
function opennewwindow(url)
{
// Fudge factors for window decoration space.
 // In my tests these work well on all platforms & browsers.
	w =450;
	h=300;
w += 32;
h += 96;
 var win = window.open(url,name,'width=' + w + ', height=' + h + ', top=200 , left=500 ,' +'location=no, menubar=no, ' +'status=no, toolbar=no, scrollbars=no, resizable=yes');
 win.resizeTo(w, h);
 win.focus();
}
// -->

function hideMessage(){
	document.getElementById("flashMessage").style.display='none';
}

function toggle_visibility(id,act) {
				var e = document.getElementById(id);
				if(act ==1){
					e.style.display = 'block'	
						
						
				}else{

					e.style.display = 'none';
					document.getElementById("odamount").value='';
					
				}
				return true;
	}



/*
 * Function name          : validatesubgroupadmin()
 * Description            : This function is used to validate groupsubadmin
 * Parameters 			  : N/A
 * Created On             : 13-07-10 (12:10am)                          
 */

function validatesubgroupadmin(cnt){
var first = document.getElementById('first').value;
var last= document.getElementById('last').value;
var email= document.getElementById('email').value;


var username= document.getElementById('username').value;


	if(!spaceValidation(username)){
		inlineMsg('username','<strong> Please enter Username/UserId.</strong>',2);
		return false;
	}
	if(username.length<6){
		inlineMsg('username','<strong> Username should greater than 5 characters</strong>',2);
		return false;
	}

	if(first==""){
		inlineMsg('first','<strong>Please enter First Name</strong>',2);
		return false;
	}

	if(!isFirstName(first)){
		inlineMsg('first','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}

	if(!spaceValidation(first)){
		inlineMsg('first','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	if(last==""){
		inlineMsg('last','<strong>Please enter Last Name</strong>',2);
		return false;
	}

	if(!isFirstName(last)){
		inlineMsg('last','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}

	if(!spaceValidation(last)){
		inlineMsg('last','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	if(email==""){
		inlineMsg('email','<strong>Please enter Email</strong>',2);
		return false;
	}
	if(!validateemail(email)){
		inlineMsg('email','<strong>Invalid Email.</strong>',2);
		return false;
	}
	if(document.getElementById('changep')!=null && document.getElementById('changep').checked==true){
		var opass= document.getElementById('opassword').value;
		var pass= document.getElementById('password').value;
		var cpass= document.getElementById('cpassword').value;
		if(!spaceValidation(opass)){
			inlineMsg('opassword','<strong>Please enter Old Password</strong>',2);
			return false;
		}
		if(!spaceValidation(pass)){
			inlineMsg('password','<strong>Please enter new password</strong>',2);
			return false;
		}
		if(pass.length<6){
			inlineMsg('password','<strong>Password should greater than 5 characters</strong>',2);
			return false;
		}
		if(!spaceValidation(cpass)){
			inlineMsg('cpassword','<strong>Please enter verify password</strong>',2);
			return false;
		}
		if(pass != cpass){
			inlineMsg('cpassword','<strong>Verify password not match with password.</strong>',2);
			return false;
	
		}
	}else if(document.getElementById('changep')==null){ 
		
		var pass= document.getElementById('password').value;
		var cpass= document.getElementById('cpassword').value;
		if(!spaceValidation(pass)){
			inlineMsg('password','<strong>Please enter Password</strong>',2);
			return false;
		}
		if(pass.length<6){
			inlineMsg('password','<strong>Password should greater than 5 characters</strong>',2);
			return false;
		}
		if(!spaceValidation(cpass)){
			inlineMsg('cpassword','<strong>Please enter verify password</strong>',2);
			return false;
		}
		if(pass != cpass){
			inlineMsg('cpassword','<strong>Verify password not match with password.</strong>',2);
			return false;
	
		}
	}
	//if($('#'+id+':checked').val() =='1'){
	var chk ='';	
	for(i=1;i<=cnt;i++){
		
		if(document.getElementById('privilegeid_'+i) != null && document.getElementById('privilegeid_'+i).checked==true){
			chk = 'set';	
		}
	}
	if(chk ==''){
		inlineMsg('privilegeid_1','<strong>Please select atleast one permission.</strong>',2);
		return false;	
	}
			
	if(document.getElementById('privilegeid_4').checked==true && document.getElementById('privilegeid_3').checked==false){
			
			inlineMsg('privilegeid_3','<strong>Please also assign Email permission to user if he has Followups permission.</strong>',2);
			return false;	

	}
		
	return true;
}



/*
 * Function name          : validateaddeditevents()
 * Description            : This function is used to validate addevent form
 * Parameters 			  : N/A
 * Created On             : 17-07-10 (02:50pm)                          
 */

function validateaddeditevents(){
	
	 if($('#eventname').val() =="")
	 {
		 inlineMsg('eventname','<strong> Please enter event name.</strong>',2);
		 return false;
	 }
	 if(!isFirstName($('#eventname').val())){
			inlineMsg('eventname','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}

		if(!spaceValidation($('#eventname').val())){
			inlineMsg('eventname','<strong> Blank space not allowed.</strong>',2);
				return false;
		}
		if($('#eventname').val().length < 4)
		 {
			 inlineMsg('eventname','<strong> Minimum length of event name is 4.</strong>',2);
			 return false;
		 }
	
	 if($('#eventday').val() =="")
	 {
		 inlineMsg('eventday','<strong> Please select event day.</strong>',2);
		 return false;
	 }
	 if($('#eventmonth').val() =="")
	 {
		 inlineMsg('eventmonth','<strong> Please select event month.</strong>',2);
		 return false;
	 }
	 if($('#eventyear').val() =="")
	 {
		 inlineMsg('eventyear','<strong> Please select event year.</strong>',2);
		 return false;
	 }
	    var myDate=new Date(); 
	    myday = $('#eventday').val();
		mymonth = $('#eventmonth').val();
		myyear = $('#eventyear').val();
		myDate.setFullYear(myyear,mymonth-1,myday);
		var today = new Date();
	 
	 if(myDate < today)
	 {
		 inlineMsg('eventyear','<strong> Please select valid event date.</strong>',2);
		 return false;
	 }
	 
	 if($('#eventgoal_set').val() =="")
	 {
		 inlineMsg('eventgoal_set','<strong> Please enter monetary goal.</strong>',2);
		 return false;
	 }
	 if(!isnumerice($('#eventgoal_set').val()))
	 {
		 inlineMsg('eventgoal_set','<strong> Please enter valid amount ie.500,800,1000 etc..</strong>',2);
		 return false;
	 }
	
	 return true;
	
}

/*
 * Function name          : textCounter()
 * Description            : This function is used to enter valid amount of characters
 * Parameters 			  : N/A
 * Created On             : 19-07-10 (10:20pm)                          
 */

function textCounter(maxlimit) {
	
	if ($("#group_description").val().length > maxlimit) // if too long...trim it!
		document.getElementById('group_description').value = $("#group_description").val().substring(0, maxlimit);
	// otherwise, update 'characters left' counter
	else
		document.getElementById('remLen2').value = maxlimit - $("#group_description").val().length;
		
	}

/*
 * Function name          : showthermometer()
 * Description            : This function is used to display thermometer
 * Parameters 			  : N/A
 * Created On             : 20-07-10 (07:30pm)                          
 */

function showthermometer(eventid){

	$.ajax({
		type: "GET",
		cache: false,
		url: '/groups/getupdatedthermometer/'+eventid,
		success: function(obj){
				$("#replace_thermometer").html(obj);
		}	
	});

	
}

/*
 * Function name          : validatedonationoffline()
 * Description            : This function is used to validate Offline donation page
 * Parameters 			  : N/A
 * Created On             : 21-07-10 (12:45pm)                          
 */
function validatedonationoffline(){
	
	
	if($('#first_name').val() =="")
	 {
		 inlineMsg('first_name','<strong>Please enter Donor First Name.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#first_name').val()))
	 {
		 inlineMsg('first_name','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#first_name').val())){
		inlineMsg('first_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	if($('#last_name').val() =="")
	 {
		 inlineMsg('last_name','<strong>Please enter Donor Last Name.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#last_name').val()))
	 {
		 inlineMsg('last_name','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#last_name').val())){
		inlineMsg('last_name','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	if($('#email').val()!=''){
		if(!validateemail($('#email').val())){
			inlineMsg('email','<strong>Invalid Email.</strong>',2);
			return false;
		}
	}

	
	if($('#street1').val() =="")
	 {
		 inlineMsg('street1','<strong>Please enter Street.</strong>',2);
		 return false;
	 }
	if($('#street1').val().length < 6)
	 {
		 inlineMsg('street1','<strong>Minimum length for Street  is 6.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#street1').val())){
		inlineMsg('street1','<strong> Blank space not allowed.</strong>',2);
			return false;
	}
	
	
	
	if($('#country').val()==""){
		 inlineMsg('country','<strong> Please select Country.</strong>',2);
		 return false;
	}
	
	 if($('#city').val() =="")
	 {
		 inlineMsg('city','<strong> Please enter City.</strong>',2);
		 return false;
	 }
	if(!isFirstName($('#city').val()))
	{
		inlineMsg('city','<strong>Only alphabets, single quote and space allowed.</strong>',2);
		return false;
	}
	if(!spaceValidation($('#city').val())){
			inlineMsg('city','<strong> Blank space not allowed.</strong>',2);
				return false;
	}
	
	
	 if($('#state').type=='text')
	 {
		 
		 if($('#state').val() ==""){
			 inlineMsg('state','<strong> Please enter State.</strong>',2);
			 return false;
		}	
		
		if(!spaceValidation($('#state').val())){
			inlineMsg('state','<strong> Blank space not allowed.</strong>',2);
			return false;
		}

		if(!isFirstName($('#state').val()))
		{ 
			inlineMsg('state','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			return false;
		}	
	 }else{
		 if($('#state').val() ==""){
			 inlineMsg('state','<strong> Please Select State.</strong>',2);
			 return false;
		}	
		 
	 }

	 

	 if($('#zipcode').val() =="")
	 {
		 inlineMsg('zipcode','<strong> Please enter ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	if(!spaceValidation($('#zipcode').val())){
		inlineMsg('zipcode','<strong> Blank space not allowed.</strong>',2);
		return false;
	}

	 if($('#zipcode').val().length < 5)
	 {
		 inlineMsg('zipcode','<strong> ZIP/Postal Code should greater then 4.</strong>',2);
		 return false;
	 }
	 if(isNaN($('#zipcode').val()))
	 {
		 inlineMsg('zipcode','<strong> Please enter valid ZIP/Postal Code.</strong>',2);
		 return false;
	 }
	 
	 if($('#event_id').val()=="")
	 {
		 inlineMsg('event_id','<strong> Please select Donation Event.</strong>',2);
		 return false;
	 }
	 
	 /**********credit card validation for online payment****************/
	creditcard = document.getElementById("online");	
	//var cardtype = document.getElementById("DonorsCardTypeAmex");
	
	 
	if(creditcard.checked ==true){
		 var cardnumber = document.getElementById("cardnumber").value;
		var cvvno = document.getElementById("cvvno").value;
		var month = document.getElementById("month").value;
		var year = document.getElementById("year").value;
		var nameoncard = document.getElementById("nameoncard").value;
		var date = new Date();
		
		var m = date.getMonth() + 1;
		var monthjs = (m < 10) ? '0' + m : m;
		var yy = date.getYear();
		var yearjs = (yy < 1000) ? yy + 1900 : yy;
	 
		if(nameoncard =="")
		{
			inlineMsg('nameoncard','<strong> Please enter name on card.</strong>',2);
			return false;
		}
		if(!isFirstName($('#nameoncard').val()))
	 	{	
			 inlineMsg('nameoncard','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		}
		if(!spaceValidation($('#nameoncard').val())){
			inlineMsg('nameoncard','<strong> Blank space not allowed.</strong>',2);
			return false;
	 	}

		
		if(cardnumber =="")
		{
			inlineMsg('cardnumber','<strong> Please enter Credit Card Number.</strong>',2);
			return false;
		}
	
		if(checkcreditcard(cardnumber) ==false)
		{
			inlineMsg('cardnumber','<strong> Please enter valid Credit Card Number.</strong>',2);
			return false;
		}
		if(cardnumber < 12)
		{
			inlineMsg('cardnumber','<strong> Credit Card Number should greater then 11.</strong>',2);
			return false;
		}
		if(cvvno =="")
		{
			inlineMsg('cvvno','<strong> Please enter CVV Number.</strong>',2);
			return false;
		}
		
		/*if(cvvno.length <=3)
		{
			
				inlineMsg('cvvno','<strong> Please enter 4 digit CVV Number for Amarican Express.</strong>',2);
				return false; 
			
		}*/
		
		if(month =="")
		{
			inlineMsg('year','<strong> Please select Expiration Month.</strong>',2);
			return false;
		}
		
		if(month < monthjs && year <= yearjs)
		{
			inlineMsg('year','<strong> Please select valid Expiration Month.</strong>',2);
			return false;
		}
		if(year =="")
		{
			inlineMsg('year','<strong> Please select Expiration Year.</strong>',2);
			return false;
		}
		if(year < yearjs)
		{
			inlineMsg('year','<strong> Please select valid Expiration Year.</strong>',2);
			return false;
		}	
	}
	/*************************/	
	if($('#ano:checked').val()=='1'){
		var anoamt = $('#anoamount').val();
		if(anoamt==''){
			inlineMsg('anoamount','<strong>Please enter Donation Amount.</strong>',2);
	    		return false;	
		}
		if(isNaN(anoamt)){
			inlineMsg('anoamount','<strong>Please enter valid Donation Amount.</strong>',2);
	    		return false;	
		}
		
	}		
	 tinyMCE.triggerSave(true,true);
 	var mytextarea = tinyMCE.activeEditor.getContent();
	 if (mytextarea != '' && $('#magiccode').val() !=null)
	    {
		 $('#magiccode').val() = '';
		 inlineMsg('mce_editor_0_tbl','<strong>Either upload image or enter content in editor.</strong>',2);
	        return false;
	    }
	if (mytextarea == '' && $('#magiccode').val() ==null)
	    {
		 inlineMsg('mce_editor_0_tbl','<strong>Either upload image or enter content in editor.</strong>',2);
	        return false;
	    }
	if (mytextarea != '' && !spaceValidation(mytextarea))
	    {
		 inlineMsg('mce_editor_0_tbl','<strong>Blank space not allowed</strong>',2);
	        return false;
	    }


	if(document.getElementById('onlinedir').checked==true){
		//fname = trim(document.getElementById('fname').value," ")
		if($('#fname').val() =="")
		{
			inlineMsg('fname','<strong>Please enter First Name.</strong>',2);
			return false;
		}
		if(!spaceValidation($('#fname').val())){
			inlineMsg('fname','<strong> Blank space not allowed.</strong>',2);
			return false;
	 	}
	 
		if(!isFirstName($('#fname').val()))
	 	{	
			 inlineMsg('fname','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		}
		if($('#lname').val() =="")
		 {
			 inlineMsg('lname','<strong>Please enter Last Name.</strong>',2);
			 return false;
		 }
		if(!isFirstName($('#lname').val()))
	 	{	
			 inlineMsg('lname','<strong>Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		}
		if(!spaceValidation($('#lname').val())){
			inlineMsg('lname','<strong> Blank space not allowed.</strong>',2);
			return false;
	 	}

		if($('#email').val()!=''){
			if(!validateemail($('#email').val())){
				inlineMsg('email','<strong>Invalid Email.</strong>',2);
				return false;
			}
		}
		if($('#phone').val()!='' && ($('#phone').val().length>12 || $('#phone').val().length <10)){
			inlineMsg('phone','<strong>Please enter valid phone number.</strong>',2);
			return false;
		}
		if($('#phone').val()!=''){
			if(!ParseUSNumber($('#phone').val())){
				inlineMsg('phone','<strong>Phone number must be like xxx-xxx-xxxx format.</strong>',2);
				return false;
			}
		}	

			
	}
	
	
	document.getElementById('donationoffline').action = '';
	document.getElementById('donationoffline').target = '';
	return true;
}


/*
 * Function name          : showeventprogress()
 * Description            : This function is used to call event progress data
 * Parameters 			  : N/A
 * Created On             : 22-07-10 (11:30am)                          
 */
function showeventprogress(eventid){
	if(eventid ==""){
					window.location.reload( true );
		}else{

					$.ajax({
						type: "GET",
						cache: false,
						url: '/groups/eventprogress/'+eventid,
						success: function(obj){
								$("#replacebyevents").html(obj);
						}	
					});

			}
}
/*
 * Function name          : validateemailtemplate()
 * Description            : This function is used to validate new template entry
 * Parameters 			  : N/A
 * Created On             : 20-07-10 (11:30am)                          
 */

function validateemailtemplate(){
	name =  document.getElementById('name').value;
	subject =  document.getElementById('subject').value;
	tinyMCE.triggerSave(true,true);
    	var mytextarea = tinyMCE.activeEditor.getContent();
	if(!spaceValidation(name)){
		inlineMsg('name','<strong> Please Enter Name.</strong>',2);
			 return false;
	 }
	if(!isFirstName(name))
	 {
		 inlineMsg('name','<strong> Only alphabets, single quote and space allowed.</strong>',2);
		 return false;
	 }
	if(!spaceValidation(subject)){
		inlineMsg('subject','<strong> Please Enter Subject.</strong>',2);
			 return false;
	 }
	if(!spaceValidation(mytextarea)){
		inlineMsg('mce_editor_0_tbl','<strong> Please Enter Email Content.</strong>',2);
			 return false;
	 }
	return true;	
	 

}

/*
 * Function name          : validate_sendmail()
 * Description            : This function is used to validate send mail
 * Parameters 			  : N/A
 * Created On             : 20-07-10 (03:30pm)                          
 */

function validate_sendmail(){
	tinyMCE.triggerSave(true,true);
    	var mytextarea = tinyMCE.activeEditor.getContent();
	var email = document.getElementById('email').value
	if(email==""){
		inlineMsg('email','<strong>You must enter your Email</strong>',2);
		return false;
	}
	if(!validateemail(email)){
		inlineMsg('email','<strong>Invalid Email.</strong>',2);
		return false;
	}
	var emailids = trim(document.getElementById('emails').value,",");
	if(document.getElementById('emails').value==""){
		inlineMsg('emails','<strong>You must enter email list</strong>',2);
		return false;
	}
	
	if(!spaceValidation(document.getElementById('subject').value)){
		inlineMsg('subject','<strong>Please enter Subject.</strong>',2);
		return false;
	}
	emailarr = emailids.split(",");
	
	if(emailarr.length<1){
		emailarr[0] =document.getElementById('emails').value; 	
	}
	for(cnt=0;cnt<emailarr.length;cnt++)
	{
		
		femail = emailarr[cnt].split("<");
		
		if(femail.length<2){
			vemail = emailarr[cnt];
			
		}else{
			lastemail = femail[1].split(">");
			vemail = lastemail[0];
			
		}
			
		
		if(!validateemail(vemail)){
			inlineMsg('emails','<strong>Invalid Email Present in send to list.</strong>',2);
			return false;
		}
	}
	if(!spaceValidation(mytextarea)){
		inlineMsg('mce_editor_0_tbl','<strong> Please Enter Email Content.</strong>',2);
			 return false;
	 }
	document.getElementById('baction').value = 'send';
	document.getElementById('cmail').submit();
	
	
}

/*
 * Function name          : copycontacts()
 * Description            : This function is used to copy email id from dropdown to text area
 * Parameters 			  : N/A
 * Created On             : 21-07-10 (12:30pm)                          
 */

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
/*
function copycontacts(){ 
		dropdown = document.getElementById('addressbook');
	
 			var existlist = document.getElementById('emails').value;
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
			document.getElementById('emails').value = trim(trim(document.getElementById('emails').value,',')+","+str,",");

}
*/
/*
 * Function name          : ShowHideDiv()
 * Description            : This function is used to show and hide the group profile page content
 * Parameters 			  : N/A
 * Created On             : 03-08-10 (12:05pm)                          
 */
function ShowHideDiv(){
	var more = document.getElementById('more_less');
	var showhide = document.getElementById('show_me');
	  if(more.style.display == 'inline'){
	     document.getElementById('more_less').style.display = 'none';
		 //document.getElementById('show_me').value = 'Show me more';
		 showhide.innerHTML = showhide.innerHTML.replace(/less/,"more");	 
	  }else{
	     document.getElementById('more_less').style.display = 'inline';
		 showhide.innerHTML = showhide.innerHTML.replace(/more/,"less");
	  }
	}

/*
 * Function name          : validateGroupPhoto()
 * Description            : This function is used to validate grpup profile image
 * Parameters 			  : N/A
 * Created On             : 03-08-10 (12:02pm)                          
 */
/*other controller functions*/
function validateGroupPhoto(){

		if($('#adimage').val() =="")
		{
			inlineMsg('adimage','<strong>Please upload group profile photo.</strong>',4);
			return false;
		}else{
		ajaxUploadImg('editprofilegroup','/groups/ajaxuploadgroupprofile/?filename=data[GroupProfileContent][adimage]&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://<?php echo HTTP_PATH ?>/img/docs/groups/&amp;relPath=../groups/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;
		
		}
}

/*
 * Function name          : validateGroupEdit()
 * Description            : This function is used to validate editgroup profile page
 * Parameters 			  : N/A
 * Created On             : 03-08-10 (12:00pm)                          
 */
/*other controller functions*/
function validateGroupEdit(){

	tinyMCE.triggerSave(true,true);
    	var mytextarea = tinyMCE.activeEditor.getContent();
		
		if($('#gtheme').val() =="")
		{
			inlineMsg('gtheme','<strong>Please select theme.</strong>',4);
			return false;
		}
		
		if($('#gdescription').val() =="")
		{
			inlineMsg('gdescription','<strong>Please enter group description.</strong>',4);
			return false;
		}
		if(tagValidate($('#gdescription').val())  ==true)
		{
			inlineMsg('gdescription','<strong>Please avoid HTML Tags.</strong>',4);
			return false;
		}
		
		
		if(!spaceValidation($('#gdescription').val())){
			inlineMsg('gdescription','<strong>Please enter group description.</strong>',4);
			return false;
	 	}
				
		
		if($('#gbeneficiary').val() =="")
		{
			inlineMsg('gbeneficiary','<strong>Please enter group beneficiary statement.</strong>',4);
			return false;
		}
		if(tagValidate($('#gbeneficiary').val())  ==true)
		{
			inlineMsg('gbeneficiary','<strong>Please avoid HTML Tags.</strong>',4);
			return false;
		}
		
		if(!spaceValidation($('#gbeneficiary').val())){
			inlineMsg('gbeneficiary','<strong>Please enter group beneficiary statement.</strong>',4);
			return false;
	 	}
		
		
		if($('#photo_caption').val() =="")
		{
			inlineMsg('photo_caption','<strong>Please enter group photo caption.</strong>',4);
			return false;
		}	
		
		if(!spaceValidation($('#photo_caption').val())){
			inlineMsg('photo_caption','<strong>Please enter group photo caption.</strong>',4);
			return false;
	 	}
		
	
	if (mytextarea != '' && !spaceValidation(mytextarea))
	    {
		 inlineMsg('mce_editor_0_tbl','<strong>Please enter group professional affiliation.</strong>',4);
		 document.getElementById('mce_editor_0').focus();
	       return false;
	    }
		
		
		if (mytextarea == '')
	    {
		 inlineMsg('mce_editor_0_tbl','<strong>Please enter group professional affiliation.</strong>',4);
		 document.getElementById('mce_editor_0').focus();
	        return false;
	    }	
		

		document.getElementById('editprofilegroup').action = '';
		document.getElementById('editprofilegroup').target = '';
		
		return true;
}



/*
 * Function name          : validateeditdonation()
 * Description            : This function is used to validate edit donation detail page
 * Parameters 			  : N/A
 * Created On             : 23-08-10 (04:10pm)                          
 */


function validateeditdonation(){
	 //return true;
		
		var fname = document.getElementById("fname").value;
		var lname = document.getElementById("lname").value;
		var zipcode = document.getElementById("zipcode").value;
		var companyname = document.getElementById("companyname").value;
		var address = document.getElementById("address").value;
		var state = document.getElementById("state").value;
		var city = document.getElementById("city").value;
		var country = document.getElementById("country").value;
		var anmdonation = document.getElementById("anoamount").value;

		tinyMCE.triggerSave(true,true);
	    	var mytextarea = tinyMCE.activeEditor.getContent();
	    	if(document.getElementById('donationplan_8').checked==true){
			if(anmdonation==''){
				inlineMsg('anoamount','<strong>Please enter Donation Amount.</strong>',2);
		         	return false;

			}
			if(isNaN(anmdonation)){
				inlineMsg('anoamount','<strong>Please enter valid Donation Amount.</strong>',2);
		         	return false;

			}
			
			if(parseFloat(anmdonation)=='0'){
				inlineMsg('anoamount','<strong>Please enter amount greater than 0 .</strong>',2);
		         	return false;
			}
		}
		 if (mytextarea == '' && document.getElementById('adimage').value =='')
		    {
			
			 inlineMsg('adcontent_tbl','<strong>Please enter Ad content or upload image.</strong>',2);
		         return false;
		    }
		    	
		 if (mytextarea != '' && document.getElementById('adimage').value !='')
		    {
			 
			 inlineMsg('adcontent_tbl','<strong>Either upload image or enter content in editor.</strong>',2);
		        return false;
		    }
		
		if (document.getElementById('onlinedir').checked == true){

			var ofname = document.getElementById("onlinefname").value;	
			var olname = document.getElementById("onlinelname").value;
			var oprofession= document.getElementById("onlineprofession").value;
			var ocompany = document.getElementById("onlinecomapnyname").value;
			var oemail = document.getElementById("oemail").value;
			var ophone= document.getElementById("onlinephone").value;
			if(ofname =="")
			{
				inlineMsg('onlinefname','<strong> Please enter First Name.</strong>',2);
				return false;
			}
			
			if(!isFirstName(ofname))
			{
				inlineMsg('onlinefname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(ofname)){
				inlineMsg('onlinefname','<strong> Blank space not allowed.</strong>',2);
					return false;
			}
			if(olname =="")
			{
				inlineMsg('onlinelname','<strong> Please enter Last Name.</strong>',2);
				return false;
			}
			
			if(!isFirstName(olname))
			{
				inlineMsg('onlinelname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(olname)){
				inlineMsg('onlinelname','<strong> Blank space not allowed.</strong>',2);
					return false;
			}

			if(oprofession =="")
			{
				inlineMsg('onlineprofession','<strong> Please enter Profession.</strong>',2);
				return false;
			}
			
			if(!isFirstName(oprofession))
			{
				inlineMsg('onlineprofession','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(oprofession)){
				inlineMsg('onlineprofession','<strong> Blank space not allowed.</strong>',2);
					return false;
			}

			if(oemail!='' && !validateemail(oemail)){
				inlineMsg('oemail','<strong> Please enter valide Email.</strong>',2);
					return false;
			}
			if(ophone != '' && !ParseUSNumber(ophone))
			 {
				 inlineMsg('onlinephone','<strong>Phone number must be like xxx-xxx-xxxx format.</strong>',2);
				 return false;
			 }
			
		}	

		 if(fname =="")
		 {
			 inlineMsg('fname','<strong> Please enter First Name.</strong>',2);
			 return false;
		 }
		
		if(!isFirstName(fname))
		 {
			 inlineMsg('fname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(fname)){
			inlineMsg('fname','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }
		if(lname =="")
		 {
			 inlineMsg('lname','<strong> Please enter Last Name.</strong>',2);
			 return false;
		 }
		
		if(!isFirstName(lname))
		 {
			 inlineMsg('lname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(lname)){
			inlineMsg('lname','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }

		if(companyname =="")
		 {
			 inlineMsg('companyname','<strong> Please enter Company Name.</strong>',2);
			 return false;
		 }
		
		 if(!spaceValidation(companyname)){
			inlineMsg('companyname','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }

		if(address =="")
		 {
			 inlineMsg('address','<strong> Please enter Address.</strong>',2);
			 return false;
		 }
		
		 if(!spaceValidation(address)){
			inlineMsg('address','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }


		if(country =="")
		 {
			 inlineMsg('country','<strong> Please enter Country.</strong>',2);
			 return false;
		 }

		if(city =="")
		 {
			 inlineMsg('city','<strong> Please enter City.</strong>',2);
			 return false;
		 }
		
		if(!isFirstName(city))
		 {
			 inlineMsg('city','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(city)){
			inlineMsg('city','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }


		if(state =="")
		 {
			 inlineMsg('state','<strong> Please enter State.</strong>',2);
			 return false;
		 }
		
		if(document.getElementById('state').type=='text' && !isFirstName(state))
		 {
			 inlineMsg('state','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(state)){
			inlineMsg('state','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }


		if(zipcode =="")
		 {
			 inlineMsg('zipcode','<strong> Please enter ZIP/Postal Code.</strong>',2);
			 return false;
		 }
		if(!spaceValidation(zipcode)){
			inlineMsg('zipcode','<strong> Blank space not allowed.</strong>',2);
			return false;
		}
		
		 if(zipcode.length < 5)
		 {
			 inlineMsg('zipcode','<strong> ZIP/Postal Code should greater then 4.</strong>',2);
			 return false;
		 }
		 if(isNaN(zipcode))
		 {
			 inlineMsg('zipcode','<strong> Please enter valid ZIP/Postal Code.</strong>',2);
			 return false;
		 }
		//if(document.getElementById('creditcard').checked==true){
		var pregrossamt = document.getElementById('pregrossamt').value;
		var curplanamt = document.getElementById('curplanamt').value;
		var curdiramt = document.getElementById('curdiramt').value;
		//alert('pre gamt '+pregrossamt);
		//alert('cur  pamt '+curplanamt);
		//alert('cur  damt '+curdiramt);
		if(curdiramt==''){
			curdiramt=0;
		}
		var tottaxper =document.getElementById('tottaxper').value;
		var taxdedamt = (parseFloat(curplanamt)+parseFloat(curdiramt))* parseFloat(tottaxper)/100;
		var curgrossamt = (parseFloat(curplanamt)+parseFloat(curdiramt)+parseFloat(taxdedamt));
		//alert(pregrossamt);
		//alert(curgrossamt);
		if(parseFloat(curgrossamt)>parseFloat(pregrossamt)){
			var nameoncard =document.getElementById("nameoncard").value;
			var cardnumber = document.getElementById("cardnumber").value;
			var month = document.getElementById("month").value;
			var year = document.getElementById("year").value;
			var date = new Date();
		
			var m = date.getMonth() + 1;
			var monthjs = (m < 10) ? '0' + m : m;
			var yy = date.getYear();
			var yearjs = (yy < 1000) ? yy + 1900 : yy;	
		
			var cvvno =document.getElementById("cvvno").value;
			if(nameoncard =="")
			{
				inlineMsg('nameoncard','<strong> Please enter Name.</strong>',2);
				return false;
			}
			
			if(!isFirstName(nameoncard))
			{
				inlineMsg('nameoncard','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(nameoncard)){
				inlineMsg('nameoncard','<strong> Blank space not allowed.</strong>',2);
					return false;
			}
			if(cardnumber =="")
			{
				inlineMsg('cardnumber','<strong> Please enter Credit Card Number.</strong>',2);
				return false;
			}
		
			if(checkcreditcard(cardnumber) ==false)
			{
				inlineMsg('cardnumber','<strong> Please enter valid Credit Card Number.</strong>',2);
				return false;
			}
			if(cardnumber < 12)
			{
				inlineMsg('cardnumber','<strong> Credit Card Number should greater then 11.</strong>',2);
				return false;
			}
			
			
			/*if(cardtype.checked==true && cvvno.length <=3)
			{
				
					inlineMsg('cvvno','<strong> Please enter 4 digit CVV Number for Amarican Express.</strong>',2);
					return false; 
				
			}*/
			if(month =="")
			{
				inlineMsg('year','<strong> Please select Expiration Month.</strong>',2);
				return false;
			}
			
			if(month < monthjs && year <= yearjs)
			{
				inlineMsg('year','<strong> Please select valid Expiration Month.</strong>',2);
				return false;
			}
			if(year =="")
			{
				inlineMsg('year','<strong> Please select Expiration Year.</strong>',2);
				return false;
			}
			if(year < yearjs)
			{
				inlineMsg('year','<strong> Please select valid Expiration Year.</strong>',2);
				
			}
			if(cvvno =="")
			{
				inlineMsg('cvvno','<strong> Please enter CVV Number.</strong>',2);
				return false;
			}
			if(cvvno.length < 3 || cvvno.length > 4)
			{
				
				inlineMsg('cvvno','<strong> CVV Number should greater than 3 and less than 5 digit.</strong>',2);
				return false; 
				
			}
			if(!isnumerice(cvvno))
			{
				inlineMsg('cvvno','<strong> Please enter valid CVV Number.</strong>',2);
				return false;
			}
		}
		//}
		if(document.getElementById('agree').checked==false){
			inlineMsg('agree','<strong>Please check on terms and condition.</strong>',2);
		         return false;
		}

	
}

/*
 * Function name          : validatedonorsignup()
 * Description            : This function is used to new design donor registration
 * Parameters 			  : N/A
 * Created On             : 06-08-10 (11:10am)                          
 */


function validatedonorsignup(){

	 //return true;
		
		var fname = document.getElementById("fname").value;
		var lname = document.getElementById("lname").value;
		var zipcode = document.getElementById("zipcode").value;
		var companyname = document.getElementById("companyname").value;
		var address = document.getElementById("address").value;
		var state = document.getElementById("state").value;
		var city = document.getElementById("city").value;
		var country = document.getElementById("country").value;
		var anmdonation = document.getElementById("anoamount").value;

		tinyMCE.triggerSave(true,true);
	    	var mytextarea = tinyMCE.activeEditor.getContent();
	    	if(document.getElementById('donationplan_10').checked==true){
			if(anmdonation==''){
				inlineMsg('anoamount','<strong>Please enter Donation Amount.</strong>',2);
		         	return false;

			}
			if(isNaN(anmdonation)){
				inlineMsg('anoamount','<strong>Please enter valid Donation Amount.</strong>',2);
		         	return false;

			}
			
			if(parseFloat(anmdonation)=='0'){
				inlineMsg('anoamount','<strong>Please enter amount greater than 0 .</strong>',2);
		         	return false;
			}
		}
		 if (mytextarea == '' && document.getElementById('adimage').value =='')
		    {
			
			 inlineMsg('adcontent_tbl','<strong>Please enter Ad content or upload image.</strong>',2);
		         return false;
		    }
		    	
		 if (mytextarea != '' && document.getElementById('adimage').value !='')
		    {
			 
			 inlineMsg('adcontent_tbl','<strong>Either upload image or enter content in editor.</strong>',2);
		        return false;
		    }
		
		if (document.getElementById('onlinedir').checked == true){

			var ofname = document.getElementById("onlinefname").value;	
			var olname = document.getElementById("onlinelname").value;
			var oprofession= document.getElementById("onlineprofession").value;
			var ocompany = document.getElementById("onlinecomapnyname").value;
			var oemail = document.getElementById("oemail").value;
			var ophone= document.getElementById("onlinephone").value;
			if(ofname =="")
			{
				inlineMsg('onlinefname','<strong> Please enter First Name.</strong>',2);
				return false;
			}
			
			if(!isFirstName(ofname))
			{
				inlineMsg('onlinefname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(ofname)){
				inlineMsg('onlinefname','<strong> Blank space not allowed.</strong>',2);
					return false;
			}
			if(olname =="")
			{
				inlineMsg('onlinelname','<strong> Please enter Last Name.</strong>',2);
				return false;
			}
			
			if(!isFirstName(olname))
			{
				inlineMsg('onlinelname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(olname)){
				inlineMsg('onlinelname','<strong> Blank space not allowed.</strong>',2);
					return false;
			}

			if(oprofession =="")
			{
				inlineMsg('onlineprofession','<strong> Please enter Profession.</strong>',2);
				return false;
			}
			
			if(!isFirstName(oprofession))
			{
				inlineMsg('onlineprofession','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(oprofession)){
				inlineMsg('onlineprofession','<strong> Blank space not allowed.</strong>',2);
					return false;
			}

			if(oemail!='' && !validateemail(oemail)){
				inlineMsg('oemail','<strong> Please enter valide Email.</strong>',2);
					return false;
			}
			if(ophone != '' && !ParseUSNumber(ophone))
			 {
				 inlineMsg('onlinephone','<strong>Phone number must be like xxx-xxx-xxxx format.</strong>',2);
				 return false;
			 }
			
		}	

		 if(fname =="")
		 {
			 inlineMsg('fname','<strong> Please enter First Name.</strong>',2);
			 return false;
		 }
		
		if(!isFirstName(fname))
		 {
			 inlineMsg('fname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(fname)){
			inlineMsg('fname','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }
		if(lname =="")
		 {
			 inlineMsg('lname','<strong> Please enter Last Name.</strong>',2);
			 return false;
		 }
		
		if(!isFirstName(lname))
		 {
			 inlineMsg('lname','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(lname)){
			inlineMsg('lname','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }

		if(companyname =="")
		 {
			 inlineMsg('companyname','<strong> Please enter Company Name.</strong>',2);
			 return false;
		 }
		
		 if(!spaceValidation(companyname)){
			inlineMsg('companyname','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }

		if(address =="")
		 {
			 inlineMsg('address','<strong> Please enter Address.</strong>',2);
			 return false;
		 }
		
		 if(!spaceValidation(address)){
			inlineMsg('address','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }


		if(country =="")
		 {
			 inlineMsg('country','<strong> Please enter Country.</strong>',2);
			 return false;
		 }

		if(city =="")
		 {
			 inlineMsg('city','<strong> Please enter City.</strong>',2);
			 return false;
		 }
		
		if(!isFirstName(city))
		 {
			 inlineMsg('city','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(city)){
			inlineMsg('city','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }


		if(state =="")
		 {
			 inlineMsg('state','<strong> Please enter State.</strong>',2);
			 return false;
		 }
		
		if(document.getElementById('state').type=='text' && !isFirstName(state))
		 {
			 inlineMsg('state','<strong> Only alphabets, single quote and space allowed.</strong>',2);
			 return false;
		 }
		 if(!spaceValidation(state)){
			inlineMsg('state','<strong> Blank space not allowed.</strong>',2);
				 return false;
		 }


		if(zipcode =="")
		 {
			 inlineMsg('zipcode','<strong> Please enter ZIP/Postal Code.</strong>',2);
			 return false;
		 }
		if(!spaceValidation(zipcode)){
			inlineMsg('zipcode','<strong> Blank space not allowed.</strong>',2);
			return false;
		}
		
		 if(zipcode.length < 5)
		 {
			 inlineMsg('zipcode','<strong> ZIP/Postal Code should greater then 4.</strong>',2);
			 return false;
		 }
		 if(isNaN(zipcode))
		 {
			 inlineMsg('zipcode','<strong> Please enter valid ZIP/Postal Code.</strong>',2);
			 return false;
		 }
		//if(document.getElementById('creditcard').checked==true){
			var nameoncard =document.getElementById("nameoncard").value;
			var cardnumber = document.getElementById("cardnumber").value;
			var month = document.getElementById("month").value;
			var year = document.getElementById("year").value;
			var date = new Date();
		
			var m = date.getMonth() + 1;
			var monthjs = (m < 10) ? '0' + m : m;
			var yy = date.getYear();
			var yearjs = (yy < 1000) ? yy + 1900 : yy;	
		
			var cvvno =document.getElementById("cvvno").value;
			if(nameoncard =="")
			{
				inlineMsg('nameoncard','<strong> Please enter Name.</strong>',2);
				return false;
			}
			
			if(!isFirstName(nameoncard))
			{
				inlineMsg('nameoncard','<strong> Only alphabets, single quote and space allowed.</strong>',2);
				return false;
			}
			if(!spaceValidation(nameoncard)){
				inlineMsg('nameoncard','<strong> Blank space not allowed.</strong>',2);
					return false;
			}
			if(cardnumber =="")
			{
				inlineMsg('cardnumber','<strong> Please enter Credit Card Number.</strong>',2);
				return false;
			}
		
			if(checkcreditcard(cardnumber) ==false)
			{
				inlineMsg('cardnumber','<strong> Please enter valid Credit Card Number.</strong>',2);
				return false;
			}
			if(cardnumber < 12)
			{
				inlineMsg('cardnumber','<strong> Credit Card Number should greater then 11.</strong>',2);
				return false;
			}
			
			
			/*if(cardtype.checked==true && cvvno.length <=3)
			{
				
					inlineMsg('cvvno','<strong> Please enter 4 digit CVV Number for Amarican Express.</strong>',2);
					return false; 
				
			}*/
			if(month =="")
			{
				inlineMsg('year','<strong> Please select Expiration Month.</strong>',2);
				return false;
			}
			
			if(month < monthjs && year <= yearjs)
			{
				inlineMsg('year','<strong> Please select valid Expiration Month.</strong>',2);
				return false;
			}
			if(year =="")
			{
				inlineMsg('year','<strong> Please select Expiration Year.</strong>',2);
				return false;
			}
			if(year < yearjs)
			{
				inlineMsg('year','<strong> Please select valid Expiration Year.</strong>',2);
				
			}
			if(cvvno =="")
			{
				inlineMsg('cvvno','<strong> Please enter CVV Number.</strong>',2);
				return false;
			}
			if(cvvno.length < 3 || cvvno.length > 4)
			{
				
				inlineMsg('cvvno','<strong> CVV Number should greater than 3 and less than 5 digit.</strong>',2);
				return false; 
				
			}
			if(!isnumerice(cvvno))
			{
				inlineMsg('cvvno','<strong> Please enter valid CVV Number.</strong>',2);
				return false;
			}

		//}
		if(document.getElementById('agree').checked==false){
			inlineMsg('agree','<strong>Please check on terms and condition.</strong>',2);
		         return false;
		}

		//document.getElementbyId('donation1').submit();

	}


function editonlinedircheck(){
	if(document.getElementById('onlinedir').checked==true){
		document.getElementById('curdiramt').value = document.getElementById('DonationOnlineDAmount').value;
	}else{
		document.getElementById('curdiramt').value = '';
	}

}


function singleplanedit(id){
	
	
	max = document.getElementById('maxval').value
	
	for(i =1; i <= max; i++){
		if(document.getElementById('donationplan_'+i).checked==true){
			document.getElementById('donationplan_'+i).checked =false;
		}
		document.getElementById(id).checked =true;
	}
	var val = document.getElementById(id).value;
	
	listarr = val.split("_");
	if(listarr[0]!=null && listarr[2]){
		
		document.getElementById('hiddenpricing').value = listarr[0]+'_'+listarr[2];
		document.getElementById('hidpart').value = listarr[0]+'_'+listarr[2];
		document.getElementById('curplanamt').value = listarr[1];

	}else{
			
		document.getElementById('hiddenpricing').value = 1;
		document.getElementById('hidpart').value = 1;
		document.getElementById('curplanamt').value = document.getElementById('anoamount').value;	
	}
		textlimit();

}





function singleplan(id){
	
	
	max = document.getElementById('maxval').value
	
	for(i =1; i <= max; i++){
		if(document.getElementById('donationplan_'+i).checked==true){
			document.getElementById('donationplan_'+i).checked =false;
		}
		document.getElementById(id).checked =true;
	}
	var val = document.getElementById(id).value;
	
	listarr = val.split("_");
	if(listarr[0]!=null && listarr[2]){
		
		document.getElementById('hiddenpricing').value = listarr[0]+'_'+listarr[2];
		document.getElementById('hidpart').value = listarr[0]+'_'+listarr[2];

	}else{
			
		document.getElementById('hiddenpricing').value = 1;
		document.getElementById('hidpart').value = 1;
	}
		textlimit();

}

/*
 * Function name          : printPartOfPage()
 * Description            : This function is used for print document
 * Parameters 			  : N/A
 * Created On             : 06-08-10 (11:10am)                          
 */


function printPartOfPage(elementId,groupid)
{

	
 	var windowUrl = baseUrl+'donors/donationformprint/'+elementId+'/'+groupid;
		
 	var uniqueName = new Date();
 	var windowName = 'Print' + uniqueName.getTime();
 	var printWindow = window.open(windowUrl, windowName,"width=850px, scrollbars=yes");
 	printWindow.document.close();
 	printWindow.focus();
 	//printWindow.print();
 	//printWindow.close();
	
}	


/*
 * Function name          : customprivew()
 * Description            : This function is used to display custom preview of donor ad
 * Parameters 			  : N/A
 * Created On             : 06-08-10 (11:10am)                          
 */


function customprivew(){
	
	tinyMCE.triggerSave(true,true);
	var mytextarea = tinyMCE.activeEditor.getContent();
	var part= document.getElementById('hidpart').value;

	txt = mytextarea.replace(/(<([^>]+)>)/ig,"");
    txt = mytextarea.replace(/&nbsp;/g,"");


    				
				

			    var string  ="<html>";
			    	string +="<head>";
			
			    	string +="<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>";
			    	string +="<title>::..ABOL..::</title>";
			    	string +="<body >";
			    	string +="<table >";
			    	string +="<tr>";


			    	if(part == '1_Gold' || part == '1_Silver' || part == '1_Sponsor'){
			    		maxtext = "1000";
				    	
			    		 string +="<td style='width:413px; height:584px; border:1px solid #ccc'>"+txt;
			    		 string +="</td>";
			    		}
			    		 string +="</tr >";


			    		if(part == '2_Gold' || part == '2_Silver' || part == '2_Sponsor'){

			    			maxtext = "500";
			    			 if (txt.length > maxtext){ // if too long...trim it!

				    				
			    				  txt = txt.substr(0,maxtext);
			    				  
			    			 }
			    			 
			    			 txt = txt.replace(/<img /g,'<img width="100" height="100" ');	

			    			
			    		 string +="<tr >";
			    		 string +="<td style='width:413px; height:292px; border:2px solid #ccc'>"+txt;
			    		 string +="</td >";
			    		 string +="</tr >";
			    		}


			    		 string +="<tr >";
			    		if(part == '3_Sponsor'){

			    			 maxtext = "300";

			    			 if (txt.length > maxtext){ // if too long...trim it!

				    				
			    				  txt = txt.substr(0,maxtext);
			    				  
			    			 }
			    			 
			    			 txt = txt.replace(/<img /g,'<img width="100" height="100" ');	

			    		 string +="<td style='width:137px; height:292px; border:1px solid #ccc'>"+txt;
			    		 string +="</td>";

			    		}

			    		if(part == '4_Sponsor'){

			    			 maxtext = "200";	
			    			 if (txt.length > maxtext){ // if too long...trim it!

			    				
			    				  txt = txt.substr(0,maxtext);
			    				  
			    			 }
			    			 txt = txt.replace(/<img /g,'<img width="40px" height="40px" ');
			    			 
				    		 string +="<tr >";
				    		 string +="<td style='width:137px; height:146px; border:2px solid #ccc'>"+txt;
				    		 string +="</td >";
				    		 string +="</tr >";
				    		}


				    		 string +="<tr >";

				    		 if(part == '6_Sponsor'){
				    			 maxtext = "150";

						    			 var ind =  txt.indexOf("<img title=");
					    					if(ind >= 0){
						    							alert('No image for Message.');
						    							return false;
						    					}
				    			 
							    			 if (txt.length > maxtext){ // if too long...trim it!
			
								    				
							    				  txt = txt.substr(0,maxtext);
							    				  
							    			 }
				    					
				    			 var str = txt.substr(0,'50');
				    			
					    		 string +="<tr >";
					    		 string +="<td style='width:137px;  height:40px; overflow:hidden;  border:2px solid #ccc'>"+str;
					    		 string +="</td >";
					    		 string +="</tr >";
					    		}
				    		 
				    		 
				    		 if(part == '1'){
						    			 maxtext = "500";
						    			 if (txt.length > maxtext){ // if too long...trim it!
		
							    				
						    				  txt = txt.substr(0,maxtext);
						    				  
						    			 }
						    			 
						    			 txt = txt.replace(/<img /g,'<img width="100" height="100" ');	
		
						    			
						    		 string +="<tr >";
						    		 string +="<td style='width:413px; height:292px; border:2px solid #ccc'>"+txt;
						    		 string +="</td >";
						    		 string +="</tr >";
					    		}
				    		 
				    		 


			    	string +="</tr>";

			    	string +="</table >";

			    	string +="</body >";
			    	string +="</html >";

			    	
    

			
    		
  
			OpenWindow=window.open("", "Preview", "height=600, width=450,top=200 , left=300, toolbar=no,scrollbars="+scroll+",menubar=no");
			OpenWindow.document.write("<TITLE>Preview Ad</TITLE>")
			OpenWindow.document.write("<BODY>")
			//OpenWindow.document.write(txt)
			OpenWindow.document.write(string)
			
			OpenWindow.document.write("</BODY>")
			OpenWindow.document.write("</HTML>")
			
			OpenWindow.document.close()
			self.name="main"
   
	
	     return false;
	
}
	
function showonlinedirectoryInfoedit(id,tax,odamt){

	if(document.getElementById(id).checked==true){
		document.getElementById('dircur').value=odamt;
		
		document.getElementById("curamt").innerHTML =' $'+ ((parseFloat(document.getElementById("pagecur").value))+parseFloat(odamt));

		var  total = ((parseFloat(document.getElementById("pagecur").value))+parseFloat(odamt));
		var taxdedamt = total*tax/100;
		document.getElementById("taxamount").innerHTML = ' + Tax Amt $'+taxdedamt;
		document.getElementById("onlinedirectorydiv").style.display = 'inline';

	}else{

		document.getElementById('dircur').value="0";
		document.getElementById("curamt").innerHTML =' $'+ (parseFloat(document.getElementById("pagecur").value));
		var  total = parseFloat(document.getElementById("pagecur").value);
		var taxdedamt = total*tax/100;
		document.getElementById("taxamount").innerHTML = ' + Tax Amt $'+taxdedamt;
		document.getElementById("onlinedirectorydiv").style.display = 'none';
	}

	
	
}


function anonoymiaschk(id, tax){
	if($('#ano:checked').val()=='1'){
		var curamt1 = document.getElementById(id).value;
		if(curamt1!=''){
		document.getElementById("pagecur").value = curamt1;
		var total1 = (parseFloat(document.getElementById('dircur').value) +parseFloat(curamt1));
		var taxdedamt1 = total1*tax/100;
		document.getElementById("taxamount").innerHTML = ' + Tax Amt $'+taxdedamt1;
		document.getElementById("curamt").innerHTML = ' $'+(parseFloat(document.getElementById('dircur').value) +parseFloat(curamt1));
		}
	}

}

function checkreadiovalueedit(val,tax){
	
	document.getElementById('ano').checked = false;
	document.getElementById('anoamount').value= '';
	document.getElementById("hiddenpricing").value=val;
	
	
	var curamt = $('#plan_'+val+'').val();

	document.getElementById("pagecur").value = curamt;
	
	var  total = (parseFloat(document.getElementById('dircur').value) +parseFloat(curamt));
	var taxdedamt = total*tax/100;
	document.getElementById("taxamount").innerHTML = ' + Tax Amt $'+taxdedamt;
	document.getElementById("curamt").innerHTML = ' $'+(parseFloat(document.getElementById('dircur').value) +parseFloat(curamt));

	document.getElementById('hidpart').value = val;
	textlimit();
	
}

function curamountedit(val,tax){
	chkid =document.getElementById(val).value; 
	
	onlinediramt = document.getElementById('sel_'+chkid).value;
	document.getElementById('dircur').value = onlinediramt;
	document.getElementById("curamt").innerHTML =' $'+ (parseFloat(document.getElementById("pagecur").value) +parseFloat(onlinediramt));
	var  total =(parseFloat(document.getElementById("pagecur").value) +parseFloat(onlinediramt));
	var taxdedamt = total*tax/100;
	document.getElementById("taxamount").innerHTML = ' + Tax Amount $'+taxdedamt;
}


function uncheckradio(tax){
	if($('#ano:checked').val()=='1'){
		document.getElementById('DonorsHiddenpricing6Sponsor').checked = false;
		document.getElementById('DonorsHiddenpricing4Sponsor').checked = false;
		document.getElementById('DonorsHiddenpricing3Sponsor').checked = false;			
		document.getElementById('DonorsHiddenpricing2Sponsor').checked = false;
		document.getElementById('DonorsHiddenpricing1Sponsor').checked = false;		
		document.getElementById('DonorsHiddenpricing2Silver').checked = false;
		document.getElementById('DonorsHiddenpricing1Silver').checked = false;
		document.getElementById('DonorsHiddenpricing2Gold').checked = false;
		document.getElementById('DonorsHiddenpricing1Gold').checked = false;	
		document.getElementById('hiddenpricing').value ='1';
		document.getElementById('hidpart').value = '1';		
		textlimit();	
	}else{
		document.getElementById('DonorsHiddenpricing1Gold').checked = true;
		document.getElementById("hiddenpricing").value ='1_Gold';
		checkreadiovalueedit('1_Gold',parseFloat(tax))
		textlimit();
	}

}


function deleteuploadedimage(repdiv){
//alert(donationid);
	dname = document.getElementById('magiccode').value;
	 jQuery.ajax({
                type: "POST",
              url: baseUrl+'donors/deleteuploadimg/'+dname+'/',
                cache: false,
                success: function(rText){
                        //alert(rText);
                        jQuery('#'+repdiv).html(rText);
                }
        });
}


/*
 * Function name          : validateusersignup()
 * Description            : This function is used to validate new donor registration 
 * Parameters 			  : N/A
 * Created On             : 06-08-10 (11:10am)                          
 */

function validateusersignup(){
	

	var email= document.getElementById('email').value;
	var vemail= document.getElementById('vemail').value;
	var pass= document.getElementById('password').value;
	var cpass= document.getElementById('vpassword').value;
	var username= document.getElementById('user_name').value;
	var securityquestion= document.getElementById('securityquestion').value;
	var securityanswer= document.getElementById('securityanswer').value;
		if(!spaceValidation(username)){
			inlineMsg('user_name','<strong> Please enter Username.</strong>',2);
			return false;
		}
		if(username.length<6){
			inlineMsg('user_name','<strong> Username should greater than 5 characters</strong>',2);
			return false;
		}

		
		

		if(!spaceValidation(pass)){
			inlineMsg('password','<strong>Please enter Password</strong>',2);
			return false;
		}
		if(pass.length<6){
			inlineMsg('password','<strong>Password should greater than 6 characters</strong>',2);
			return false;
		}
		if(!spaceValidation(cpass)){
			inlineMsg('vpassword','<strong>Please enter Confirm Password</strong>',2);
			return false;
		}
		if(pass != cpass){
			inlineMsg('vpassword','<strong>Verify password not match with password.</strong>',2);
			return false;

		}

		if(email==""){
			inlineMsg('email','<strong>Please enter Email</strong>',2);
			return false;
		}
		if(!validateemail(email)){
			inlineMsg('email','<strong>Invalid Email.</strong>',2);
			return false;
		}
		if(email==""){
			inlineMsg('vemail','<strong>Please enter Verify Email</strong>',2);
			return false;
		}
		
		if(email != vemail){
			inlineMsg('vemail','<strong>Verify email not match with email.</strong>',2);
			return false;

		}
		if(securityquestion==""){
			inlineMsg('securityquestion','<strong>Please enter Security Question</strong>',2);
			return false;
		}
		if(securityanswer==""){
			inlineMsg('securityanswer','<strong>Please enter Answer</strong>',2);
			return false;
		}

		if(!spaceValidation(securityanswer)){
			inlineMsg('securityanswer','<strong>Please enter Answer</strong>',2);
			return false;
		}
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


function validateregister(part){

alert("hi");
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

	 /* if(!(document.getElementById('agree').checked))
	 {
		 inlineMsg('agree','<strong>Please agree terms and conditions.</strong>',2);
		 return false;
	 } */
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
	if($('#phone').val() !=''  && ParseUSNumber($('#phone').val())==false){
			inlineMsg('phone','<strong>Please use valid phone format.</strong>',2);
			 return false; 
		}
	 return true;
	}
	



}


function validateholder(part){
   
	if(part=="add"){

    	if(trim($('#email').val()) == '')
	 {
		 inlineMsg('email','<strong>Email required.</strong>',2);
		 return false;
	 }
	if(validateemail($('#email').val()) == false){
			 inlineMsg('email','<strong>Please enter valid email.</strong>',2);
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
	if($('#password').val().length<5)
	 {
		 inlineMsg('password','<strong>Password length should be greater then 4.</strong>',2);
		 return false;
	 }	
	 if(tagValidate(trim($('#password').val())) == true){
		 inlineMsg('password','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 }
	 if(trim($('#screenname').val()) == '')
	 {
		 inlineMsg('screenname','<strong>Screen Name required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#screenname').val()) == true){
		 inlineMsg('screenname','<strong>Please dont use script tags.</strong>',2);
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

	 /* if(!(document.getElementById('agree').checked))
	 {
		 inlineMsg('agree','<strong>Please agree terms and conditions.</strong>',2);
		 return false;
	 } */
	 return true;
	}
	if($('#phone').val() !=''  && ParseUSNumber($('#phone').val())==false){
			inlineMsg('phone','<strong>Please use valid phone format.</strong>',2);
			 return false; 
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
	if($('#phone').val() !=''  && ParseUSNumber($('#phone').val())==false){
			inlineMsg('phone','<strong>Please use valid phone format.</strong>',2);
			 return false; 
		}
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
 * Function name   : validatecontentpage()
 * Description     : This function is used for validation of Content page (add/edit)
 * Created On      : 03-06-2011 (02:10am)
 *
 */

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
		 inlineMsg('metatitle','<strong>Please provide Metatitle</strong>',2);
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


/*
 * Function name   : validatepassword()
 * Description     : This function is used for validation of password 
 * Created On      : 03-06-2011 (05:50am)
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
 * Function name   : validatesugbox()
 * Description     : This function is used for validation of password 
 * Created On      : 03-06-2011 (05:50am)
 *
 */

function validatesugbox(){	

	if($('#username').val() == '')
	 {
		 inlineMsg('username','<strong> Username required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#username').val()) == true){
		 inlineMsg('username','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
	if($('#suggestion').val() == '')
	 {
		 inlineMsg('suggestion','<strong>Suggestion required.</strong>',2);
		 return false;
	 }
	 if(tagValidate($('#suggestion').val()) == true){
		 inlineMsg('suggestion','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 
return true; 
}

function findgetstates(countryid,modelname) {
	   if(countryid==""){
	      return false;
	   }

       jQuery.ajax({
             type: "GET",
             url: baseUrl+'admins/findselectstate/'+countryid+'/'+modelname,
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
             url: baseUrl+'companies/selectstate/'+countryid+'/'+modelname,
             cache: false,
             success: function(rText){
                  //alert(rText);
                     jQuery('#statediv').html(rText);
             }
     });
	  
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
/**
* Funtion to get email template details by id
*/
function showselecttemplate(id){
	// location = "/companies/sendtempmail/"+id;
      var current_domain=$("#current_domain").val();  
      $.ajax({
                    url: baseUrl+'companies/get_email_template_details_by_ajax/'+id,
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
function getprojecttypedays(projectypeid) {
	   
	 document.getElementById("projecttypevalue").value = "";
   jQuery.ajax({
         type: "GET",
         url: baseUrl+'companies/getprojecttypedays/'+projectypeid,
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

function getcompanyaddress(companyid) {
	
   jQuery.ajax({
         type: "GET",
         url: baseUrl+'companies/getcompanyaddressbyid/'+companyid,
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
			var a=document.getElementById("companyaddress1");
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

function getshippingdays(shippingid) {
	   
	 document.getElementById("shippingvalue").value = "";
    jQuery.ajax({
          type: "GET",
          url: baseUrl+'companies/getshipdays/'+shippingid,
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


var checkcoinset=false;
var flag=true;

/*function validatecoinset(part){
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
		if(($('#serialprefix').val() != '') && ($('#serialprefix').val().length != 3))
		{
			inlineMsg('serialprefix','<strong>Serial Prefix Must Heve 3 Character.</strong>',3);
			return false;
		}
		 
		if($('#units').val() == '')
		{
			inlineMsg('units','<strong>Please provide # of Units.</strong>',2);
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
		if(isnumerice($('#serialprefix').val()) == true && $('#serialprefix').val() != '' ){
			inlineMsg('serialprefix','<strong>Serial # Start should be character only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#serialprefix').val()) == true && $('#serialprefix').val() != ''){
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
		if(isnumerice($('#serialprefix').val()) == true && $('#serialprefix').val() != '' ){
			inlineMsg('serialprefix','<strong>Serial # Start should be character only.</strong>',2);
			return false; 
		}
		if(tagValidate($('#serialprefix').val()) == true && $('#serialprefix').val() != ''){
			inlineMsg('serialprefix','<strong>Please dont use script tags.</strong>',2);
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
	 }* /
	 
	 
	 
}  */


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


function getshippingdays(shippingid) {
       
     document.getElementById("shippingvalue").value = "";
    jQuery.ajax({
          type: "GET",
          url: baseUrl+'admins/getshipdays/'+shippingid,
          cache: false,
          success: function(rText){
                    if(rText){
                //alert(rText);
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
         url: baseUrl+'admins/getprojecttypedays/'+projectypeid,
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
         url: baseUrl+'admins/getproducttypedays/'+pricetypeoptionsid,
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
    //alert(shippingvalue);    //var shippingvalue = document.getElementById("shippingvalue").value;
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



function trimNumber(s) {
	  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
	  return s;
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
        url_text=baseUrl+'companies/getemailtemplatesbyajax/'+projectid+'/'+selectedid+'/'+extra
       else
        url_text=baseUrl+'companies/getemailtemplatesbyajax/'+projectid+'/'+selectedid;

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
             url: baseUrl+'companies/getcompanytypesbyajax/'+projectid+'/'+selectedid,
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
             url: baseUrl+'companies/getcontacttypesbyajax/'+projectid+'/'+selectedid,
             cache: false,
             success: function(rText){
                    jQuery('#'+eleid).html(rText);
             }
     });
}
/*
 * Function name   : validatecompanytype()
 * Description     : This function is used for validation of company type (add/edit)
 * Created On      :9th dec 2011
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
 * Function name   : validatecontacttype()
 * Description     : This function is used for validation of contact type (add/edit)
 * Created On      : 9th dec 2011 
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