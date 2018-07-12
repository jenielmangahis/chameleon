<?php

# Logging in with Google accounts requires setting special identity, so this example shows how to do it.
	
require 'openid.php';
	
try {
	
    # Change 'localhost' to your domain name.
	
    $openid = new LightOpenID('localhost');
	
    if(!$openid->mode) {
	
        if(isset($_GET['login'])) {
	
            $openid->identity = 'https://www.google.com/accounts/o8/id';
	
			header('Location: ' . $openid->authUrl());
	
        }
	
?>
	
<form action="?login" method="post">
	
    <button>Login with Google</button>
	
</form>
	
<?php
	
    } elseif($openid->mode == 'cancel') {
	
        echo 'User has canceled authentication!';
	
    } else {
	
        //echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
		
		if($openid->validate()) {
	
			//User logged in
	
			$d = $openid->getAttributes();
	
			$first_name = $d['namePerson/first'];
	
			$last_name = $d['namePerson/last'];
	
			$email = $d['contact/email'];
	
			$language_code = $d['pref/language'];
	
			$country_code = $d['contact/country/home'];
	
			$data = array(
	
				'first_name' => $first_name ,
	
				'last_name' => $last_name ,
	
				'email' => $email ,
	
			);
			//now signup/login the user.
	
			//process_google_data($data);
			print_r($data);
			print_r($openid->getAttributes());
	
		} else {
	
			echo 'user is not logged in';
	
		}

	
    }
	
} catch(ErrorException $e) {
	
    echo $e->getMessage();
	
}