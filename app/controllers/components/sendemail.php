<?php
	class SendemailComponent
	{
		/**
		 * function : genratepassword()
		 * description : Generate temporary password for user.
		 */
		function genratepassword() {
			$temppasswd='';
			for($i=1;$i<=2;$i++) {
				$small=range('a', 'z');
				$caps=range('A' ,'Z');
				shuffle($caps);
				shuffle($small);
				$num=rand(1,25);
				$temppasswd.=$caps[$num];
				$temppasswd.=rand()%10;
				$temppasswd.=$small[$num];
				$temppasswd.=rand()%100;
			}
			return $temppasswd;
		}
		
		/**
		 * function : sendmail()
		 * params   : $uName : User full name.
		 * params   : $uEmail : User email address to send password.
		 * params   : $newpassword : New temporary password.
		 * description : This function is use to format mail for user.
		 */
		function sendmail($uName, $uEmail, $newpassword,$first_name, $last_name){

			$message = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='http://".$_SERVER['HTTP_HOST']."/img/logo.jpg' /><br/>";
			$message.= "Dear ". ucwords($first_name).','."<br><br>";
			$message .= "Forgot your password?<br/>";
			$message .= "This message is a response to the Forgot Password request made by you at <a href='http://".$_SERVER['HTTP_HOST']."'>".SITE_DOMAIN."</a> <br/>";
			
			$message .= "Below is the Username and Password for your ".SITE_DOMAIN." account:<br/><br/>";
			$message .= "Username : <b>\"".$uName . "\"</b><br/>";
			$message .= "Password: <b>\"".$newpassword . "\"</b><br />";
			
			
			$message .= "<br>Sincerely, <br> ";
			$message .= "The ".SITE_DOMAIN." team <br>";
			$message .= "<a href='http://".$_SERVER['HTTP_HOST']."'>".SITE_DOMAIN."</a> <br>";
			$message .= "<br><br/>";
			
			$message .="<br /><br/>";


			$message .='</body></html>';
			$subject = "Forgot Password - ".SITE_DOMAIN;
			  
			$from = SITE_EMAIL;
			$to = $uEmail;
				
			$ifsend = $this->sendMailContent($uEmail,$from,$subject,$message);
			
			 
			if($ifsend == true){
			   return true;
			}else{
			
			   return false;
			}
		}
		
		
		
		
	/**
		 * function : forgotpassword()
		 * params   : $donorname
		 * params   : $newpassword
		 * params   : $emailid
		 * description : This function is use to format mail for user.
		 */
		function forgotpassword($donorname,$newpassword,$emailid){
			$httppath ='http://'.$_SERVER['HTTP_HOST'];
			$message = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='$httppath/img/logo.gif' /><br/>";
			$message.= "Dear ". ucwords($donorname).','."<br><br>";
			$message .= "Forgot your password?<br/>";
			$message .= "This message is a response to the Forgot Password request made by you at <a href='$httppath'>ad book online.</a> <br/>";
			
			$message .= "Below is the your new Password for your ad book online account:<br/>";
			
			$message .= "Password: <b>$newpassword</b><br />";
			
			
			$message .= "<br>Sincerely, <br> ";
			$message .= "The ad book online team <br>";
			$message .= "<a href='$httppath'>www.adbookonline.com</a> <br>";
			$message .= "<br><br/>";
			
			$message .="<br /><br/>";


			$message .='</body></html>';
			
			
			$subject = "Forgot Password - addbookonline";
			  
			$from = 'admin@adbookonline.com';
			
			
			
			$ifsend = $this->sendMailContent($emailid,$from,$subject,$message);
			 
			if($ifsend == true){
			   return true;
			}else{
			
			   return false;
			}
		}


		/**
		 * function : confirm_registration()
		 * params   : $name : name of user.
		 * params   : $username : login name of user.
		 * params   : $password : password of user.
		 * params   : $memberid : user id.
		 * params   : $useremail : email address of user.
		 * description : Send confirmation mail to user before it get log-in.
		 */
		
		function confirm_registration($username, $password, $memberid, $useremail) {
			$message  ='<html><title>Registration Email Confirmation</title><head></head><body>';
			//$message .= "Hello ".$name."<br><br>";
			$message .= "Thank you for registering at eduspy! <br/>";  
			$message .= "To confirm your registration, please click on following link : <br/>";
			$message .= "<a href='".SITE_NAME_FEEDBACK."/users/update_confirmation/".base64_encode($memberid)."' target='_blank'>Confirm Registration</a>"; 
			$message .= "<br/><br/>Here are the details you provided during sign-up! <br/>Username : $username <br/> Password : $password";
			$message .= "<br/><br/>Thanks & Regards, <br/>The ".DOMAIN_NAME." Team<br/>";
			$message .='</body></html>';
			$subject  = "Registration Email Confirmation";
			  
			$from = ADMIN_SUPPORT_MAIL;
			$to = $useremail;
		
			$headers  = "From: " . strip_tags(ADMIN_SUPPORT_MAIL) . "\r\n";
			$headers .= "Reply-To: ". strip_tags(ADMIN_SUPPORT_MAIL) . "\r\n";
			$headers  .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= "$useremail" . "\r\n";
			//$headers .= ADMIN_SUPPORT_MAIL . "\r\n";
			$ifsend = mail($useremail,$subject, $message, $headers);
			
			//$ifsend = $this->sendMailContent($to,$from,$subject,$message);
			 
			if($ifsend){
			   return true;
			}else{
			   return false;
			}
		}
		
		/**
		 * function : emailad()
		 * description : Send product detail to friend.
		 */		
			
			function email_ad($email, $products)
			{
				//pr($products);
				$message='<html><head>
				<style>#gallery ul {
				list-style-image:none;
				list-style-position:outside;
				list-style-type:none;
				}
				#gallery ul li {
				display:inline;
				}
				a {
				border:medium none;
				color:#555555;
				outline-color:-moz-use-text-color;
				outline-style:none;
				outline-width:medium;
				text-decoration:none;
				}
				.lnks {
				background:#FFFFFF none repeat scroll 0 0;
				border:1px solid #CCCCCC;
				margin:15px;
				padding:10px 0 10px 35px;
				}
				.lnks ul {
				list-style-image:none;
				list-style-position:outside;
				list-style-type:none;
				margin:0;
				padding:0;
				}
				.lnks ul li {
				display:block;
				float:left;
				margin:0 20px 0 0;
				padding:0;
				width:280px;
				}
				.lnks h2 {
				border-bottom:1px solid #C3C3C3;
				color:#555555;
				font-size:16px;
				font-weight:bold;
				margin:0 0 10px;
				padding:0 0 5px;
				}
				.clear {
				clear:both;
				}
				#gallery ul img {
				border-color:#F0F0F0;
				border-style:solid;
				border-width:5px 5px 20px;
				}
				.images img {
				margin:0 20px;
				}
				img {
				border:medium none;
				}
				</style>
				<title>Product Detials - eduspy.com</title></head><body>';
				$message.='<div class="listing_panel2">
				<div class="descrptn_contnr">';
				if(!empty($products)){
				$message .= "Hi, <br> Here below are the product details for category ".ucfirst($products['Category']['category_name']) ." > ".ucfirst($products['Subcategory']['subcategory_name']) ."<br><br>"; 
				$message.='<h2>'.  ucfirst($products['Product']['title']).'<span>&nbsp;,&nbsp;'. ucfirst($products['Country']['country_name']). '</span></h2>';
				$message .= '<strong>Location:</strong>'. ucfirst($products['Country']['country_name']).', '.ucfirst($products['State']['state_name']).', '.ucfirst($products['Product']['city']).'<br />
				<strong>Price:</strong> ';
				if($products['Product']['price']!='') {
				  $message .= "$".$products['Product']['price'];
				  } else {
				 $message .=  "Free"; 
				}

				$message .= '<br /><div style="border-top:1px solid #CCCCCC;margin:10px 0;padding:10px 0;">'.  $products['Product']['descr'] .'</div>
				<div class="images" id="gallery" style="background-color:#FFFFFF;padding:10px;width:520px;"><ul>';
							for($j=0;$j<count($products['Image']);$j++){
							$prd_image = !empty($products['Image'][$j]['image_name'])?$products['Image'][$j]['image_name']:'noimage.png';
							$message.='<li><a href="/img/uploads/'.  $prd_image.'"><img src="'.SITE_NAME.'/img/uploads/'.  $prd_image.'" width="68" height="80" alt="" /></a></li>';
							} 
				$message.='</ul></div><div class="lnks"><ul><li><h2>User Information</h2>
				<img src="'.SITE_NAME.'/img/business_user.png" width="24" height="24" alt="" />'.  ucfirst($products['User']['username']).'<img src="'.SITE_NAME.'/img/telephone.png" width="24" height="24" alt="" />';
				 if($products['Product']['contact']!=""){ 
				   $message .= $products['Product']['contact'];
				 }else{
				 $message .=  "Not provided";
				}
				$message .= '</li>';
				$message.='</ul>';
				}
				$message.='<div class="clear">&nbsp;</div></div><div class="clear">&nbsp;</div>
				</div>
				<a href="http://eduspy.com/users/adsdetail/'.$products['Product']['id'].'">Click here</a> to view the detail page at eduspy.com<br/><br/></div>';
				$message.= 'Thanks <br>'.ucfirst($products['User']['username']).'<br/>eduspy.com';
				$message.= '</body></html>';

				$subject  = "eduspy.com - Product Details";
			  
			$from = $products['User']['email'];
			$to = $email;

			$headers  = "From: " . strip_tags(ADMIN_SUPPORT_MAIL) . "\r\n";
			$headers .= "Reply-To: ". strip_tags(ADMIN_SUPPORT_MAIL) . "\r\n";
			$headers  .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= "$useremail" . "\r\n";
			//$headers .= ADMIN_SUPPORT_MAIL . "\r\n";
			$ifsend = mail($email,$subject, $message, $headers);	
			
			//echo 'I am here : '.$message;die;
			//$ifsend = $this->sendMailContent($to,$from,$subject,$message);
			 
			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}
		/**
		 * function : new_user_email()
		 * params   : $name : name of user.
		 * description : Send email to admin to notify about new user.
		 */
		function new_user_notification($name, $username, $useremail) {
			$message  ='<html><title>New User Notification</title><head></head><body>';
			$message .= "Hi, <br/>";
			$message .= "New user has activated an account on your site with following details : <br/>";  
			$message .= "Name : $name <br/> Username : $username <br/> Email : $useremail <br/>";
			$message .= "<br/><br/>Thanks & Regards,<br/>The ".DOMAIN_NAME." Team<br/>";
			$message .='</body></html>';
			$subject  = "New User Notification";
			  
			$from = DOMAIN_NAME; 
			$to = ADMIN_SUPPORT_MAIL;

			
			$headers  = "From: " . strip_tags(ADMIN_SUPPORT_MAIL) . "\r\n";
			$headers .= "Reply-To: ". strip_tags(ADMIN_SUPPORT_MAIL) . "\r\n";
			$headers  .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= "$useremail" . "\r\n";
			//$headers .= ADMIN_SUPPORT_MAIL . "\r\n";
			$ifsend = mail($to,$from, $subject, $message, $headers);	
			//$ifsend = $this->sendMailContent($to,$from,$subject,$message);
			 
			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}
		
		
		/**
		 * function : sendMailContent()
		 * params   : $userEmail : User full name.
		 * params   : $senderEmail : Sender email address.
		 * params   : $subject : Subject line for email.
		 * params   : $message : Actual contents to send to user.
		 * description : This function is use to send mail to user.
		 */

		function sendMailContent($userEmail,$senderEmail,$subject,$message,$sendername='null'){
		
			//App::import('Vendor', 'phpmailer', array('file' =>'phpmailer'.DS.'class.phpmailer.php'));
			require_once('../vendors/phpmailer/class.phpmailer.php');
			
			//echo $userEmail.'Useremail '.$senderEmail.'sender Useremail '.$subject.'subject ';
			//exit;
			
			//$this->Sendemail->sendMailContent($emailid[$cnt],$from,$subject,$message)
			if($sendername=='null' ||$sendername=="" ||$sendername==''){
                $sendername = $senderEmail;
            }
				
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->From = $senderEmail;
			$mail->FromName = $sendername;
			$mail->Sender = $userEmail;
			$mail->AddAddress($userEmail,$userEmail);
			$mail->Subject = $subject;
			$mail->Body    = $message;
			$mail->WordWrap = 100;
			$mail->IsHTML(true);
			
			if ($mail->Send()) {
				return true;
			}else {
				return false;
			}
		}
        
        /**
        * Fucntion to send email to $userEmail and having $ccEmailArray in CC
        * 
        * @param mixed $userEmail        - email to user email
        * @param mixed $senderEmail      - email sender email
        * @param mixed $subject          - email subject 
        * @param mixed $message          - email messahe
        * @param mixed $sendername       - email sender name 
        * @param mixed $ccEmailArray     - comma separated cc email ids 
        */
        function sendMailContentWithCC($userEmail,$senderEmail,$subject,$message,$sendername='null', $ccEmailList='null'){
        
            //App::import('Vendor', 'phpmailer', array('file' =>'phpmailer'.DS.'class.phpmailer.php'));
            require_once('../vendors/phpmailer/class.phpmailer.php');
            
            //echo $userEmail.'Useremail '.$senderEmail.'sender Useremail '.$subject.'subject ';
            //exit;
            
            //$this->Sendemail->sendMailContent($emailid[$cnt],$from,$subject,$message)
            if($sendername=='null' ||$sendername=="" ||$sendername==''){
                $sendername = $senderEmail;
            }
            //3rd March 2012: SET Email Sent By email address        
           $message= str_replace("[[SENT_BY_EMAIL]]", $senderEmail,$message);
            
            $mail = new PHPMailer();
           
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->From = $senderEmail;
            $mail->FromName = $sendername;
            $mail->Sender = $userEmail;
            $mail->AddAddress($userEmail,$userEmail);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->WordWrap = 100;
            $mail->IsHTML(true);

            if($ccEmailList!='null' &&  $ccEmailList!="" && $ccEmailList!=''){
                $ccemailtoids = explode(",",$ccEmailList); 
                foreach($ccemailtoids as $eachccid){  
                   $mail->AddCC($eachccid,$eachccid);
                } 
            }            
            if ($mail->Send()) {
                return true;
            }else {
                return false;
            }
        }
		
		
	/**
		 * function : sendmailtotempuser()
		 * params   : $postarray : array of freeform full name.
		 * description : This function is use to send the mail to temprary user
		 */
		function sendmailtotempuser($postarray){
		//echo "<pre>";
	//	print_r($postarray); exit;
		

			$message = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='http://".$_SERVER['HTTP_HOST']."/img/logo.gif' /><br/>";
			$message.= "Hello ". ucwords($postarray['groups']['group_name']).','."<br><br>";
			$message .= "<strong>You have send us request to get Free Form </strong><br/><br/>";
			$message .= "This message is a response to get Free Form from adbookonline<a href='".$_SERVER['HTTP_HOST']."'> Ad book online.</a> <br/>";
			
			$message .= "Below are the detail you have entered:<br/><br/>";
			$message .= "Group Name : <b>\"".$postarray['Freeform']['group_name'] . "\"</b><br/>";
			$message .= "Event Name : <b>\"".$postarray['Freeform']['eventname'] . "\"</b><br/>";
			$message .= "Address    : <b>\"".$postarray['Freeform']['address'] . "\"</b><br/>";
			$message .= "City : <b>\"".$postarray['Freeform']['city'] . "\"</b><br/>";
			$message .= "State : <b>\"".$postarray['Freeform']['state'] . "\"</b><br/>";
			$message .= "Zipcode : <b>\"".$postarray['Freeform']['zipcode'] . "\"</b><br/>";
			$message .= "Phone : <b>\"".$postarray['Freeform']['phone'] . "\"</b><br/>";
			if($postarray['Freeform']['fax']){
			$message .= "Fax : <b>\"".$postarray['Freeform']['fax'] . "\"</b><br/>";
			}
			$message .= "Email : <b>\"".$postarray['Freeform']['email'] . "\"</b><br/>";
			if($postarray['Freeform']['groupnote']){
			$message .= "Group Note : <b>\"".$postarray['Freeform']['groupnote'] . "\"</b><br/>";
			}
			$message .= "Fund Goal: <b>\"".$postarray['Freeform']['fundgoal'] . "\"</b><br/>";
			$message .= "Group pricing : <b>\"".$postarray['Freeform']['grouppprice'] . "\"</b><br/>";
			if($postarray['Freeform']['gold']){
			$message .= "Gold  : <b>\"".$postarray['Freeform']['gold'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['silver']){
			$message .= "Silver : <b>\"".$postarray['Freeform']['silver'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['paper']){
			$message .= "Paper : <b>\"".$postarray['Freeform']['paper'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['half']){
			$message .= "Half : <b>\"".$postarray['Freeform']['half'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['biz']){
			$message .= "Business card Name : <b>\"".$postarray['Freeform']['biz'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['quarter']){
			$message .= "Quarter area : <b>\"".$postarray['Freeform']['quarter'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['listfield']){
			$message .= "List area : <b>\"".$postarray['Freeform']['listfield'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['messagefield']){
			$message .= "Message area : <b>\"".$postarray['Freeform']['messagefield'] . "\"</b><br/>";
			}
			if($postarray['Freeform']['anonymousamount']){
			$message .= "Anonymous Amount Name : <b>\"".$postarray['Freeform']['anonymousamount'] . "\"</b><br/>";
			}
			
			
			$message .="<br/><br/>The Terms The User Aggreed to by Submitting this Form: Notice & Agreement: <br/>
						By filling out this form and proceeding to view our demo, you understand and <br/>
						agree to be bound by this agreement that the information contained is confidential<br/>
						and proprietary. You will not disclose or use this information without the expressed<br/>
						 written permission You are allowed to view our site demo in order to consider a business<br/>
						  opportunity with us and that this opportunity is good and valuable consideration in acceptance <br/>
						  with the terms of this confidentiality agreement. You also represent that the information in this<br/>
						   form is materially true and correct. By submitting this form you indicate your acceptance.<br/>
						    (c) 2000 - 2008 All Rights Reserved!";
			
			$message .= "<br/><br/><br/>Sincerely,<br/> ";
$message .= "The Adbook online team <br>";
$message .= "<a href='".$_SERVER['HTTP_HOST']."'>www.".SITENAME."</a> <br/>";
$message .= "<br/><br/>";

$message .="<br /><br/>";


			$message .='</body></html>';
			
			
			
			$subject = "Get Free Form - adbookonline";
			  
			$from = SITE_EMAIL;
			$to = $postarray['Freeform']['email'];
			
			$headers  = "From: " .$from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers  .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);	

			//$ifsend = $this->sendMailContent($to,$from,$subject,$message);
			 
			if($ifsend == true){
			   return true;
			}else{
			
			   return false;
			}
		}
		
		
		/**
		 * function : Fromsendbymail()
		 * params   : $data : array of sendbymail fields
		 * description : This function is use to send the free form  to new group user
		 */
		function Fromsendbymail($data){

					$mids =$data['groups']['emailids'];
					$expmids = explode(',',$mids);
					
						$gname = $data['groups']['hiddname'];
						
						$pdfname = $data['groups']['hiddpdfname'];
						$description = nl2br($data['groups']['description']);
					    $httppath ='http://'.$_SERVER['HTTP_HOST'].'/freeformpdf/'.$pdfname;
						$to='';
						$messagecontent='';
						$subject='';
					for($i=0;$i < count($expmids);$i++){
						//echo $i.'<br>';
	
								$messagecontent = "Ad Book Form<br><br>
													".SITENAME." sent you this adbook form on behalf of <strong>$gname</strong>. Here is the invitation from <strong>$gname:</strong><br>
													
													$description
													<br><br>
													<a href='$httppath'>Click here to get your adbook form </a><br><br>
													Or copy and past the link below to your browser<br>
													$httppath
													";
													
													
													
													$subject = "Ad book Free Form - adbookonline";
			  
													$from = SITE_EMAIL;
													$to = "$expmids[$i]";
													
													if($to){
														if($this->sendMailContent($to,$from,$subject,$messagecontent)){
														$ok = 'ok';
														}
													}else{
														$ok = '';
													}
						
					}
					//exit;
					if($ok=='ok'){
							return 'send';
					}else{
							return 'notsend';
					}
					
					
				
					
		}
		
		/**
		 * function : groupregistrationmail()
		 * params   : $groupname ,$email
		 * description : This function is use to send the group registration mail
		 */
		function groupregistrationmail($username,$groupname,$email){
				$httppath ='http://'.$_SERVER['HTTP_HOST'];
		
				$message  ='<html><title>Group Registration</title><head></head><body>';
				$message .= "Hi $groupname, <br/><br/>";
				$message .= "Thanks for registered with adbookonline.com. <br/>";
				$message .= "Below are the login details of your account. <br/>";  
				$message .= "User Name : $username <br/> ";

				$message .= "<br>Sincerely, <br> ";
				$message .= "The ad book online team <br>";
				$message .= "<a href='$httppath'>www.".SITENAME."</a> <br>";
				$message .= "<br><br/>";
			
			    $message .="<br /><br/>";
				$message .='</body></html>';
				$subject  = "Thanks for Registration";
		
				
				$from = SITE_EMAIL;
				$ifsend = $this->sendMailContent($email,$from,$subject,$message);
					 
					if($ifsend == true){
					   return true;
					}else{
					
					   return false;
					}
					
					true;
		
		}
		
		
		
		
		
	}
		
	
?>
