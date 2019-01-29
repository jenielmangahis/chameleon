<?php
$baseUrl = Configure::read('App.base_url');
require 'openid.php';   // for google login
App::import('Vendor', 'google', array('file' => 'Google_Client.php'));
App::import('Vendor', 'google/contrib', array('file' => 'Google_PlusService.php'));
?>
<div class="boxBg">
		<!--   Arvind's code: starts  -->

 			<?php

			$site_logoutUrl='/companies/logout/';
			include('facebook.php');// this  file is in webroot
			// Create our Application instance (replace this with your appId and secret).
			if(!empty( $project['Project']['facebookappkey'])&& !empty($project['Project']['facebooksecretkey']))
					{
					
					$facebook = new Facebook(array(
									'appId' => $project['Project']['facebookappkey'],
									'secret' => $project['Project']['facebooksecretkey'],
									'cookie' => true,
									));
					
					}else{			
			

		       if($_SERVER['HTTP_HOST']=="122.170.114.241:8082" ){
				$facebook = new Facebook(array(
				'appId' => '231884786849919',
				'secret' => '1b8ab5eccaa9f2281c7fec5e0093d525',
				'cookie' => true,
				));
					}
            else
            if($_SERVER['HTTP_HOST']=="quad.imagecoins.com" ){
				$facebook = new Facebook(array(
                'appId' => '135078346584339',
                'secret' => 'b472c926fac30ed27733eb2242481aa5',
				'cookie' => true,
				));
			}
			else if($_SERVER['HTTP_HOST']=="75.125.190.162:9085"){
				$facebook = new Facebook(array(
				'appId' => '207213385987168',
				'secret' => '788d922865a9f34c43d7b5012089b16d',
				'cookie' => true,
				));
			}else{
				$facebook = new Facebook(array(
				'appId' => '226611220716399',
				'secret' => '7945fd4d730cb0e3d288e9ffe1d5312c',
				'cookie' => true,
				));
			}
			}
			
			// We may or may not have this data based on a $_GET or $_COOKIE based session.
			//
			// If we get a session here, it means we found a correctly signed session using
			// the Application Secret only Facebook and the Application know. We dont know
			// if it is still valid until we make an API call using the session. A session
			// can become invalid if it has already expired (should not be getting the
			// session back in this case) or if the user logged out of Facebook.
			if (isset($_SESSION['facbooklogoutcheck'])) {
 				                $logoutUrl = $facebook->getLogoutUrl();
						unset($_SESSION['facbooklogoutcheck']);
					?>
						
						<script type='text/javascript'> window.location='<?php echo $logoutUrl; ?>';</script> 

					<?php	}
			//$facebook_session = $facebook->getSession();
			$me = null;
			//print_r($facebook_session);
			//Session based API call.

			if ($facebook_session)
			{	unset($_SESSION['fbCounter']);
				try
				{ 
					$uid = $facebook->getUser();
					$me = $facebook->api('/me');
					//$this->Session->write('FacebookUser', serialize($me));
					$_SESSION['FacebookUser']=$me;
					
					
					/*if(!isset($_SESSION['counter']) && !isset($_SESSION['fbCounter']) && $_SESSION['FacebookUser'])
					{
						$_SESSION['counter']=1;
					}
					if($_SESSION['counter']==1)
					{	
						$_SESSION['counter']=$_SESSION['counter']+1;*/
						//print_r($_SESSION['FacebookUser']);
					//exit;
						echo '<script type="text/javascript">window.location=baseUrl+"companies/facebook_login/";</script>';	
						//header("location:/companies/facebook_login/");					
					//} 
				}
				catch (FacebookApiException $e)
				{
					error_log($e);
				}
			}
		?>

		<div id="fb-root"></div>
		<script type="text/javascript">
			window.fbAsyncInit = function() {
				FB.init({
				appId : '<?php echo $facebook->getAppId(); ?>',
				session : <?php echo json_encode($facebook_session); ?>, // don't refetch the session when PHP already has it
				status : true, // check login status
				cookie : true, // enable cookies to allow the server to access the session
				xfbml : true // parse XFBML
				});
	
				// whenever the user logs in, we refresh the page
				FB.Event.subscribe('auth.login', function(response) {
					window.location.reload();
				});
				FB.Event.subscribe('auth.logout', function() {
					window.location.reload();
				});
			};

			(function() {

			var e = document.createElement('script');

			e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';

			e.async = true;

			document.getElementById('fb-root').appendChild(e);

			}());
		/*************************************************************************

			* Function Name: site_sign_out

			* Function Arguments: N/A

			* Function Return: N/A.

			* Purpose: To logout for a user from application and, if user logged in through facebook then also it logout from facebook.

			* Created on :Feb23, 2011

		*************************************************************************/

			function site_sign_out()

			{

				<?php if($me) // this will work if user login through facebook.

				{

					$logoutUrl = $facebook->getLogoutUrl(); //facebook logout url

					

					$application_logout_url = $site_logoutUrl; // this code is for our application logout function.

					$application_logout_url =str_replace('/','%2F',$application_logout_url); // replace '/' with '%2F' 



					// This code for change logout url.

					$domain_ip = split('next=',$logoutUrl);//split facebook current logout url and add our own logout url

					$domain_org_dip = split('&access_token=',$domain_ip[1]);

					

					$server_out = 'http://'.$_SERVER['HTTP_HOST'].$application_logout_url;

					$server_out = str_replace(array(':','/'), array('%3A','%2F'), $server_out);

					

					$site_logoutUrl = $domain_ip[0].'next='.$server_out.'&access_token='.$domain_org_dip[1];

				}
				?>	
				window.location.href="<?php echo $site_logoutUrl; ?>";
			}
		</script> 
		<!-- Facebook Login --> 
				<?php
					//$btnvar = '<fb:login-button onlogin="window.location.reload();">Login with Facebook</fb:login-button>';
				?>
				
		<!-- Arvind's code ends -->	
        
        <div class="page_note" align="center"><?php echo $page_content['Content']['content']; ?>  </div>          

	            <!-- Right Side Div -->
             <div class="rhtFrmCont" style="min-height: 300px;" > 
              <div style="width: 100%; margin-top: 5px; margin-left:32px;"><span style="text-align: center;"><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
             <h1 style="padding-top :15px; margin-left: 70px;">Login With Your Account</h1> 
             
                        
				<?php      
                     if(isset($redirecttopage)){
                           $page_action=$base_url.'/companies/login?redirecttopage='.$redirecttopage;
                     }else if(isset($show_comment)){
                           $page_action=$base_url.'/companies/login?show_comment_link=1';
                     }else{
                          $page_action=$baseUrl.'/companies/login';
                     }
                     
                 echo  $form->create('User',array('action'=>$page_action,'id'=>'SignupForm','url'=>$page_action ,'onsubmit' => 'return validatelogin("add");'));?>
                
             <label class="frmLbls frmLbl2">Email</label>
             <span class="intpSpan"><?php echo $form->input('username',array('label'=>false,'id'=>'username','div'=>false,'type'=>"text", 'size'=>'40','maxlength'=>'150' , 'class'=>'inptBox')) ?></span><span style="color:red"></span>
             <br />   
         
             <label class="frmLbls frmLbl2">Password  </label> 
             <span class="intpSpan"> <?php echo $form->input('password',array('label'=>false,'div'=>false,'type'=>"password", 'id'=>"password",'size'=>'40', 'class'=>'inptBox' )) ?></span>
             <br/>
             <div align="center" style="text-align: center; width: 300px;">
               <label class="frmLbls frmLbl2">&nbsp;  </label>
             <span>
                 <span class="flx_button_lft ">
                 <?php echo $form->submit('Login', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
                 </span>
                 <!-- <span class="flx_button_lft">
                 <?php  //echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"flx_flexible_btn",'onclick'=>'window.location="/'.$project_name.'"'));?>
                  </span>    -->
             </span>
             <br/>
             <label class="frmLbls frmLbl2">&nbsp;  </label>
             <span class="chkTxt"><a href="<?php echo $baseUrl ?>'companies/forgot_password"><span>Forgot your password?</span></a></span>
             <br/>
             
             </div>
             <span style="font-family: calibri; font-size: 14px;padding-left: 115px; "> I do not have an account yet: <span class="chkTxt"><a href="/companies/registeruser">Register</a></span></span>
             <br/>
           
				<?php echo $form->end();?>
             
			</div>
             <!-- LEFT Side Div --> 
             <div >
                <div class="lftReg_box " style="min-height: 300px;"> 
               <h1>Use Your Social Account</h1>
                <p>Sign in using your account with:</p>
                <br />
                
				<p>
             <?php  

$client = new Google_Client();
$client->setApplicationName("Google+ PHP Starter Application");
$plus = new Google_PlusService($client);
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;
  $authUrl = $client->createAuthUrl();
  print "<a class='border_shadow' href='$authUrl'><img src='/images/google_sigup.png' alt='Google Sign up!' /></a>";

?>
            
            <!-- <a href="/companies/google_login?login" class="border_shadow"><img src="/images/google_sigup.png" alt="Google Sign up!" /></a> -->
            
            </p>
                 
				 <br /> 
                <fb:login-button perms="email,user_checkins" size="xlarge" class="border_shadow"> Facebook</fb:login-button>
                <br /><br />
                <p><a href="<?php echo $baseUrl ?>companies/twitter_login?oauth_token"><img src="<?php echo $baseUrl ?>images/twitter_login.png" alt="Twitter Login" /></a></p>
                
            
		</div>
        <div class="midORBox"> - OR -   </div>
        
	</div>
	
   </div>
 
