<?php
error_reporting(1);



			$message = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src='http://192.168.1.225:8117/emailchecking.php?custID=123& campID=234'/><br/>";
			$message.= "Dear Brijesh Pant<br><br>";
			
			$message .= "This message is a mail for mail compaining <br/>";
			
			
			$subject = "Email Templates for compaining";
			  
			
			$to = "brijeshp@smartdatainc.net";
			
			$headers  = "From: " . strip_tags('admin@adbookonline.com') . "\r\n";
			$headers .= "Reply-To: ". strip_tags('admin@adbookonline.com') . "\r\n";
			$headers  .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= "$useremail" . "\r\n";
			//$headers .= ADMIN_SUPPORT_MAIL . "\r\n";
			if(mail($to,$subject, $message, $headers)){
				echo "Ok";
			}else{
				echo "false";
			}	

			
			 
			
		

?>





