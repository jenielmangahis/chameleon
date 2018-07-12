<!--   Arvind's code: starts  -->
                   
    <?php

    $site_logoutUrl='/companies/logout/';
                        include('facebook.php');// this  file is in webroot
                        // Create our Application instance (replace this with your appId and secret).
                        
    if($_SERVER['HTTP_HOST']=="192.168.1.225:8219"){
  $facebook = new Facebook(array(
  'appId' => '204621259574670',
  'secret' => 'e9cef786f12e1d0bd14141bedef9383d',
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
  'appId' => '218874101473898',
  'secret' => '6c50b162c383f2fdefc5fbed34464fdc',
  'cookie' => true,
                                ));
}
                        // We may or may not have this data based on a $_GET or $_COOKIE based session.
    //
                        // If we get a session here, it means we found a correctly signed session using
                        // the Application Secret only Facebook and the Application know. We dont know
                        // if it is still valid until we make an API call using the session. A session
                        // can become invalid if it has already expired (should not be getting the
                        // session back in this case) or if the user logged out of Facebook.
    $facebook_session = $facebook->getSession();
                        $me = null;
                        //print_r($facebook_session);
                        //Session based API call.
                           
                         
                            if ($facebook_session && empty($fb_auth_user)  )
{       unset($_SESSION['fbCounter']);
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
                                                echo '<script type="text/javascript">window.location="/companies/facebook_login/";</script>';   
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
                                    FB.Event.subscribe('auth.login', function() {
                             
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

                    <!-- Arvind's code ends -->     