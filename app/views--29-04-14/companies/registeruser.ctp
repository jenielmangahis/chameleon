<?php
$base_url = Configure::read('App.base_url');
echo $javascript->link('jquery.alerts');
echo $javascript->link('coin_serial');
require 'openid.php';   // for google login
App::import('Vendor', 'google', array('file' => 'Google_Client.php'));
App::import('Vendor', 'google/contrib', array('file' => 'Google_PlusService.php'));
?>

<script type="text/javascript" src="<?php echo $base_url ?>js/myiFrame.js"></script>
<iframe id='surveyiframe' scrolling='no' frameborder='0' src='<?php echo $base_url ?>companies/iframesurvey/12' style='border:none; width:900px;' onload="adjustMyFrameHeight('surveyiframe'); " ></iframe>
<div class="boxBg">
        <!--   Arvind's code: starts  -->
             <?php
            $site_logoutUrl='/companies/logout/';
            require('facebook.php');// this  file is in webroot
            // Create our Application instance (replace this with your appId and secret).
        if(!empty( $project['Project']['facebookappkey'])&& !empty($project['Project']['facebooksecretkey']))
        {
        
        $facebook = new Facebook(array(
                        'appId' => $project['Project']['facebookappkey'],
                        'secret' => $project['Project']['facebooksecretkey'],
                        'cookie' => true,
                        ));
        
        }
        else{
			if($_SERVER['HTTP_HOST']=="122.170.114.242:8082"){
                $facebook = new Facebook(array(
                'appId' => '231884786849919',
                'secret' => 'af71ea3ddf91f1cc5c0aaa6140eadc10',
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
}            // We may or may not have this data based on a $_GET or $_COOKIE based session.
            //
            // If we get a session here, it means we found a correctly signed session using
            // the Application Secret only Facebook and the Application know. We dont know
            // if it is still valid until we make an API call using the session. A session
            // can become invalid if it has already expired (should not be getting the
            // session back in this case) or if the user logged out of Facebook
                        

            if (isset($_SESSION['facbooklogoutcheck'])||isset($_SESSION['facbooklogoutduesignup']) ) {
                                 $logoutUrl = $facebook->getLogoutUrl();
                        unset($_SESSION['facbooklogoutcheck']);
                        unset($_SESSION['facbooklogoutduesignup']);
                    ?>
                        
                         <script type='text/javascript'> window.location='<?php echo $logoutUrl; ?>';</script>  

                    <?php    }        
    
//            $facebook_session = $facebook->getSession();
            $me = null;
            //print_r($facebook_session);
            //Session based API call.

            if ($facebook_session)
            {    unset($_SESSION['fbCounter']);
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

        

                <!-- Facebook Login --> 
                <?php
                    //$btnvar = '<fb:login-button onlogin="window.location.reload();">Login with Facebook</fb:login-button>';
                ?>
                
        <!-- Arvind's code ends -->
    
    
    <div>

            <?php if(!empty($status) && $status!='Verified') {  ?>
        <div class="coinBoxCenter">
            <div class="boxBor">
             <div align="right" style="margin-left: 500px;">
                        <span class="flx_button_lft">
                            <?php echo $form->button('Save', array('div'=>false,"class"=>"flx_flexible_btn",'onclick'=>'javascript:document.verify_frm.submit()'));?>   
                         </span>                 
            </div>
            
            <div class="boxPad" style="padding-left: 80px;">
            <br /><br />
                        <table><tr><td>
                            <?php 
                            
                            if($project['Project']['serialdisplayside']=="A") $coindisplayside="sidea";
                            if($project['Project']['serialdisplayside']=="B") $coindisplayside="sideb";
                            if($coinsdetail['Coinset'][$coindisplayside]=="")
                            echo $html->image('/img/cckiller/sideA.png', array('class'=>'','width'=>'107','height'=>'109'));
                            else
                            echo $html->image('/img/'.$project_name.'/uploads/'.$coinsdetail['Coinset'][$coindisplayside], array('class'=>'','width'=>'107','height'=>'109'));
                            ?>
                        </td>
                        </table>          
            </div>
            </div>
        </div>

            <p><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
            <?php }?>

                <p><?php if($session->check('Message.flash')){ $session->flash(); } ?> </p>  
                
                <div style="margin:0 auto;width:400px;display:<?php if($status=='Verified') echo "none"; else echo "block";?>" >
                        <?php echo  $form->create('Company',array('action'=>'registeruser','name'=>'verify_frm','id'=>'CoinRegForm' ,'onsubmit' => 'return validateserial("add");'));?>                       
                            
                         <div class="updat">
                            <label class="boldlabel">Coin Serial<span style="color: red;">*</span></label>
                            </div>
                            <span class="intpSpan">
                            <?php echo $form->input('coinset',array('label'=>false,'id'=>'coinserial','div'=>false,'type'=>"text", 'size'=>'10','maxlength'=>'10' , 'class'=>'inptBox')) ?>
                            </span>
                            
                            <?php if($project['Project']['coins_verificationshow']==1){?>
                            
                            <div class="updat">
                            <label class="boldlabel">Verification Code<span style="color: red;">*</span></label>
                            </div> 
                            <span class="intpSpan"><?php echo $form->input('code',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"code",'size'=>'40','maxlength'=>'3', 'class'=>'inptBox' )) ?></span>
                            <label for="code"></label>
                            <label for="code"></label>
                            
                            
                            </div>
                            <?php } ?>
                                
                                
                
                        <?php echo $form->end();?>
                </div>
                <!--<b style="margin-left: 240px;">Any item with a</b><span class="red">*</span><b>requires an entry.</b>-->

            <?php if($session->check('Message.flash')){ $session->flash(); } ?> 
   </div>    

         <div class="page_note" align="center"><?php echo $page_content['Content']['content']; ?>  </div>          
       <div style="display:<?php if($status=='Verified') echo 'block'; else echo 'none'; ?>" >
     
        <div class="rhtFrmCont " style="width:395px;">

        
            <h1 style="margin-left: 150px;">Become a New Member</h1>
            <?php
			
			echo  $form->create('Holder',array('name'=> 'frmreg', 'action'=>'registeruser','id'=>'SignupForm','url'=>'registeruser' ,'onsubmit' => 'return validateregister("add");'));?>
            <?php echo $form->input('coinstatus',array('value'=>$status,'type'=>"hidden", 'id'=>"coinstatus" )) ?>
            <?php echo $form->input('tempserial',array('value'=>isset($tempserial)?$tempserial:'','type'=>"hidden", 'id'=>"tempserial" )) ?>
            <?php echo $form->input('tempkey',array('value'=>isset($tempkey)?$tempkey:'','type'=>"hidden", 'id'=>"tempkey" )) ?>
            <?php echo $form->input('num_coinset',array('value'=>$numunites_count,'type'=>"hidden", 'id'=>"num_coinset" )) ?> 
            <?php echo $form->input('havecoin',array('value'=>'0','type'=>"hidden", 'id'=>"havecoin" )) ?> 
            <label class="frmLbls frmLbl2" style="width:137px;">Create Screen Name</label><span class="intpSpan"><?php echo $form->input('screenname',array('label'=>'','div'=>false,'type'=>"text",'id'=>'screenname' , 'class'=>'inpt_txt_fld','value'=>isset($screenName)?$screenName:'')); // ,'onblur'=>'return error_name();' updateCoin ?></span><br />

       <label class="frmLbls frmLbl2" style="width:137px;">Your Email</label><span class="intpSpan">
	   <?php echo $form->input('email',array('label'=>'','div'=>false,'type'=>"text",'id'=>'email' , 'class'=>'inpt_txt_fld','value'=>isset($email)?$email:''));?></span><br />

                <label class="frmLbls frmLbl2" style="width:137px;">Re-enter Email</label><span class="intpSpan"><?php echo $form->input('revemail',array('label'=>'','div'=>false,'type'=>"text",'id'=>'revemail', 'class'=>'inpt_txt_fld' )); // ,'onblur'=>'return error_confirm_email();' ?></span><br />

                <label class="frmLbls frmLbl2" style="width:137px;">New Password</label><span class="intpSpan"><?php echo $form->input('password',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"password", 'class'=>'inpt_txt_fld')); //,'onblur'=>'return error_pass();' ?></span><br />

                <label class="frmLbls frmLbl2" style="width:137px;">Country</label><span class="intpSpan"><span class="inptSpn_rht"><?php echo $form->select("country",$countrydropdown,0,array('id' => 'country','class'=>'inpt_sel_fld dropdown_class'),array('254'=>'United States')); ?></span></span><br />

                <label class="frmLbls frmLbl2" style="width:137px;">Zip/Postal Code</label><span class="intpSpan"> <?php echo $form->input('zipcode',array('label'=>'','div'=>false,'type'=>"text", 'id'=>"zipcode", 'class'=>'inpt_txt_fld' ,'value'=>isset($holder_data['Holder']['zipcode'])?$holder_data['Holder']['zipcode']:'')); //'onblur'=>'return error_zip();', ?></span><br /> 
                
                <label class="frmLbls frmLbl2" style="width:137px;"><input type="checkbox" name="termsofservice" id="termsofservice" value="" class="middle" /></label><span class="chkTxt">I agree with all the <a href="#" onclick="showterms();" >Terms of Use</a></span><br />
                <span class="for_reg_but ">
                    <span class="flx_btn_contnr ">
                    
                    <span class="border_shadow">
                    <span class="flx_button_lft ">
                        <?php echo $form->button('Register', array("class"=>"flx_flexible_btn",'onclick'=>'return updateCoin();'));?>
                     </span>
                </span>
                </span></span>
            <br />
            <br />
            
           <span class="chkTxt" style='float:right;margin-right:50px;'>I already have a password:

			<?php
				e($html->link(
					$html->tag('span', 'Login'),
					array('controller'=>'companies','action'=>'login'),
					array('escape' => false,'class'=>'chkTxt')
					)
				);
		?>
           </span> 
            <?php echo $form->end();?>   
        </div>
        
         <div >
        <div class="lftReg_box " style="display:<?php if($status=='Verified') echo 'block'; else echo 'none'; ?>;  width:387px;">
            
            <h1>Become a New Member Using One <br/> of Your Social Network Accounts</h1>
            <p>Pick the Social Network Account You would like to use to Become a New Member. <br/>

If you are logged into your social network, you will automatically be logged into Member Account 
</p><br />

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
                
            <!--<fb:login-button perms="email,user_checkins" size="xlarge" class="border_shadow"> Facebook</fb:login-button>-->
			<a href="<?php echo $base_url ?>companies/facebooklogin" target="_parent"> Facebook</a>
            <br /><br />
            <p><a href="<?php echo $twitter_url; ?>"><img src="/images/twitter_login.png" alt="Twitter Sign up!" />Twitter</a></p>
            <br/>
            <br/>
           
            
            
        </div>
        <div class="midORBox"> - OR -   </div>
        
    </div>
                       <div class="clear"></div>
                       <div class="spacer"></div>
                       
         </div>
        

 </div>
  

<script language='javascript' type="text/javascript">
    function showterms(){
     
        var url = '/companies/show_terms/Terms';            
            jQuery.facebox({ ajax: url });
    }
</script>

<?php
//if($status1=="ok")
{?>
<script language='javascript' type="text/javascript">


function error_name()
{
    if(trim($('#screenname').val()) == '')
     { 
         inlineMsg('screenname','<strong>Screen Name required.<strong/>',2);
         return false;
     }
     return true;
}

function error_email()
{
    if(trim($('#email').val()) == '')
     {
         inlineMsg('email','<strong>Email required.<strong/>',2);
         return false;
     }
     else
     if(!validateemail($('#email').val()))
         {
             inlineMsg('email','<strong>Please enter valid email address.<strong/>',2);
             return false;
         }
         
     return true;
}

function error_confirm_email()
{
    if(trim($('#revemail').val()) == '')
     {
         inlineMsg('revemail',"<strong>Confirm Email required.<strong/>",2);
         return false;
     }
     else
     if(trim($('#email').val())!= trim($('#revemail').val()))
     {
         inlineMsg('revemail',"<strong>confirm Email not matched.<strong/>",2);
         return false;
     }
     
     return true;
}

function error_pass()
{
   if(trim($('#password').val()) == '')
     {
         inlineMsg('password',"<strong>Password required.<strong/>",2);
         return false;
     }
     return true;
}

function error_zip()
{
    if(trim($('#zipcode').val()) == '')
     {
         inlineMsg('zipcode',"<strong>Zip required.<strong/>",2);
         return false;
     }
     return true;
}

 function updateCoin()
 {
    
 if(trim($('#screenname').val()) == '')
     { 
         inlineMsg('screenname','<strong>Screen Name required.</strong>',2);
         return false;
     }
     if(tagValidate($('#screenname').val()) == true){
         inlineMsg('screenname',"<strong>Please dont use script tags.<strong/>",2);
         return false; 
     } 
        if(trim($('#email').val()) == '')
     {
         inlineMsg('email',"<strong>Email required.<strong/>",2);
         return false;
     }
    if(!validateemail($('#email').val()))
         {
             inlineMsg('email',"<strong>Please enter valid email address.<strong/>",2);
             return false;
         }
     if(tagValidate(trim($('#email').val())) == true){
         inlineMsg('email',"<strong>Please dont use script tags.<strong/>",2);
         return false; 
     } 
    if(trim($('#revemail').val()) == '')
     {
         inlineMsg('revemail',"<strong>Confirm Email required.<strong/>",2);
         return false;
     }
    if(trim($('#email').val())!= trim($('#revemail').val()))
     {
         inlineMsg('revemail',"<strong>confirm Email not matched.<strong/>",2);
         return false;
     }
    if(trim($('#password').val()) == '')
     {
         inlineMsg('password',"<strong>Password required.<strong/>",2);
         return false;
     }
     if(tagValidate(trim($('#password').val())) == true){
         inlineMsg('password',"<strong>Please dont use script tags.<strong/>",2);
         return false; 
     } 
      
    if($('#country').val() == '')
     {
         inlineMsg('country',"<strong>Country required.<strong/>",2);
         return false;
     }
     if(tagValidate($('#country').val()) == true){
         inlineMsg('country',"<strong>Please dont use script tags.<strong/>",2);
         return false; 
     }     
    if(trim($('#zipcode').val()) == '')
     {
         inlineMsg('zipcode',"<strong>Zip required.<strong/>",2);
         return false;
     }
     if(tagValidate(trim($('#zipcode').val())) == true){
         inlineMsg('zipcode',"<strong>Please dont use script tags.<strong/>",2);
         return false; 
     }
     

if(document.getElementById("termsofservice").checked==false)
    {
    
    alert("confirm to the terms and conditions");
    return false;
    }
    // check project has coinset defined
    if( $('#num_coinset').val()> 0 )
    {
         jConfirm('Do you have a coin to register?', 'Confirmation Dialog', function(r){
         
           if(r){
               $('#havecoin').val('1');
                document.frmreg.submit();
           }else{
               $('#havecoin').val('0');
                document.frmreg.submit();
           }
            
        });    
        
    }else{
          $('#havecoin').val('0');
          document.frmreg.submit();
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

//  var doIt=confirm('Do you have a coin to register?'); 
// if(doIt){window.location.href = "/companies/register_coin"}


</script>


<?php }?>
