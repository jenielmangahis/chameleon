<?php
// multiple recipients
			$to  = 'mytestid01@gmail.com';
			// subject
			$subject = 'subject';
			// message
			$message = 'this is test';
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= 'To:  <mytestid01@gmail.com>' . "\r\n";
			$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
			
			// Mail it
			if(mail($to, $subject, $message, $headers)) 
			echo "sent";
			else echo "not sent";

?>