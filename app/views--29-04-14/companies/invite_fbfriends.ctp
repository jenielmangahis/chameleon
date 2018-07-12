<style>
    .email_align{
        float: left; position: relative; width: 700px; margin-left: 100px; 
    }
</style>




<!-- Body Panel starts -->
<?php 
   if($_SESSION['User']['User']['usertype']=="holder"){ 

  
    ?>
    <div class="navigation">
        <div class="boxBg">
            <!--<p class="boxTop"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p> -->

            <!--<div class="boxBor">
            <div class="boxPad">
            <?php //echo $this->element("leftmenubar");?>  

            <p>&nbsp;</p>
            </div>
            </div>  
            <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p> -->

        </div>
    </div>
    <div class="bdyCont">
        <div class="boxBg">
            <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p> -->
            <div class="boxBor">
                <div class="boxPad">
                    <div style="height:auto !important;height:200px;min-height:200px;">
                        <h2 style="float:left;">Invite</h2>

                        <div style="float: left; position: relative;width: 700px;margin-left:198px; margin-top:-30px;">     
                            <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow">

                                <?php echo $this->element("leftmenubar");?>  
                            </div>

                        </div>


                        <div class="clear"></div>
                        <br />

                        <div style="width: 100%; margin-top: 5px; margin-left: 122px;"><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>

<?php 
//DebugBreak();

if(!empty( $project['Project']['facebookappkey'])&& !empty($project['Project']['facebooksecretkey']))
                    {
                        
                        function get_facebook_cookie($app_id, $app_secret) {
                              $args = array();
                              parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
                              ksort($args);
                              $payload = '';
                              foreach ($args as $key => $value) {
                                if ($key != 'sig') {
                                  $payload .= $key . '=' . $value;
                                }
                              }
                              if (md5($payload . $app_secret) != $args['sig']) {
                                return null;
                              }
                              return $args;
                        }

                        $cookie = get_facebook_cookie($project['Project']['facebookappkey'], $project['Project']['facebooksecretkey']);
                        
                       // $user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token=' .$cookie['access_token']));
                        
                 ?>   
                 <div class="email_align" align="center"> 
         
                    <div id='fb-root'></div>
                    <script>
                    var graphApiInitialized = false;
                      window.fbAsyncInit = function() {
                        FB.init({
                          appId  : '<?php echo  $project['Project']['facebookappkey'];?>',
                          status : true, // check login status
                          cookie : true, // enable cookies to allow the server to access the session
                          xfbml  : true  // parse XFBML
                        });
                            FB.Event.subscribe('auth.login', function(response) {
                                    login();
                                });

                        FB.getLoginStatus(function(response) {
                                    if (response.session) { 
                                      //  greet();
                                     //  document.getElementById('fblogin_div').display="none";
                                     //  document.getElementById('fblogout_link').display="block";
                                    }else{
                                      //    document.getElementById('fblogin_div').display="block";
                                      // document.getElementById('fblogout_link').display="none";
                                    }
                                });
                                graphApiInitialized = true;
                      };
                      (function() {
                        var e = document.createElement('script');
                        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                        e.async = true;
                        document.getElementById('fb-root').appendChild(e);
                      }());
                      function login(){
                                FB.api('/me', function(response) {
                                    //  document.getElementById('fblogin_div').display="none";
                                     //  document.getElementById('fblogout_link').display="block";
                                });
                                 window.location.reload();
                            }
                      function logout(){
                          FB.logout(function(){ 
                                  // document.getElementById('fblogin_div').display="block";
                                 //      document.getElementById('fblogout_link').display="none";
                                 //  window.location = 'http://< ?php echo $_SERVER['HTTP_HOST'];?>/companies/invite_friends'; 
                          });
                           window.location = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/invite_friends'; 
                      }
                    </script>
                      <table border="0" align="center" cellpadding="5px" cellspacing="5px" style="width:100%;" id="fb_content" >
                          <tr>

                          </tr>
                          <tr>
                          <td>
                              <span style="font-size: 15px; font-weight: bold; float: left;"> Invite Facebook  Friends</span>
                              <span class="" style="float: right;">
                                                <span class="flx_button_lft ">
                                                    <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'cancel', 'onclick'=>'logout()'));?> 
                                                </span>
                                            </span>
                          </td>
                          </tr>
                          
                          <tr><td align="right">&nbsp; 
                          </td></tr>
                          <?php if ($cookie) { ?>
                          <tr><td align="left">
                              <span style="font-size: 14px;">   Please select your facebook friends and send invitation. </span>
                                <a class="fb_button fb_button_medium" id="fb_logout" onclick="logout();"><span class="fb_button_text">Logout from Facebook</span></a>
                                 
                           </td></tr>         
                             <?php } else { ?>
                            <tr><td align="left" >  
                            <span style="font-size: 14px; float: left;"> To get your facebook friends,please login on Facebook with login button located below.</span></td></tr> 
                              <tr><td align="right">&nbsp;</td></tr>
                                <tr><td align="left">  
                                   <div style="float: left;" id="fblogin_div" class="fb-login-button" data-perms="email,user_checkins">
                                    Login with Facebook
                             </div>
                             </td></tr>
                                 <?php } ?>
                                 
                          
                          
                          <tr><td>&nbsp;</td></tr>
                          <tr><td>   <fb:serverfbml width='760' >
<script type='text/fbml'>
<div style='' class='' >
<fb:fbml>
<fb:request-form  method="GET" target="_top" action="http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/invite_fbfriends" content="This is invitations to visit <?php echo $project['Project']['system_name']; ?>.
<fb:req-choice url='http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $project['Project']['project_name']; ?>' label='Accept' />"
 type="<?php echo $project['Project']['system_name']; ?>" invite="true">
<fb:multi-friend-selector target="_top" condensed="false" exclude_ids=""  actiontext="Invite Facebook Friends" showborder="true" rows="5" email_invite="true" import_external_friends="true" />
</fb:request-form>
</fb:fbml>
</div></script>
</fb:serverfbml>
<br/><br/></td></tr>
   </table>
         </div> 

<?php  }else{
    ?>
    Sorry,to use this functionality please set your facebook application Id and Key.
    <?php 
} ?>

                    </div>

                </div>
            </div>   


        </div>
    </div>
    <div></div>
    <div class="clear"></div>
    <!-- Body Panel ends --> 

    <?php }  ?>








