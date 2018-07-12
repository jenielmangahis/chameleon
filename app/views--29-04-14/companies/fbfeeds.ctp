<?php
/******FB******/

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
					
			}
			else {

		       if ($_SERVER['HTTP_HOST']=="192.168.1.225:8219"){
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
			<?php
			}
			$facebook_session = $facebook->getSession();

/*****FB******/
?>

<!-- Body Panel starts -->
<div class="titlCont">
	<div class="myclass">
		<div align="center" class="slider" id="toppanel">
		<?php echo $this->renderElement('new_slider'); ?>

		</div>
             <?php echo $form->create("Company",  array("action" => "fbfeeds",'name' => 'fbfeeds', 'id' => "fbfeeds")) ?>    
		<span class="titlTxt">Settings</span>


            <?php    $this->loginarea="companies";    $this->subtabsel="fbfeeds";
             echo $this->renderElement('websites_submenus');  ?>   
	</div>
</div>

<div class="newtab">
 <!--<p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
	<div class="">
		<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

		<!--FB Activity Feeds-->
		<div id="fbfeeds">

		<?php if($session->check('Message.flash')){ $session->flash(); } ?>

			<fieldset style="border: 1px solid rgb(204, 204, 204); padding: 10px;">
				<legend style=" font-weight: bold; padding: 0pt 5px;">Facebook Activities</legend>
				<fb:activity site="" width="940" height="400" header="true" font="" border_color="" recommendations="false"></fb:activity>
			</fieldset>

			<div class="clear">&nbsp;</div>

		</div>
		<!--FB Activity Feeds end-->
		<p>&nbsp;</p>

	</div>
</div>

<!--inner-container ends here-->

<div class="clear"></div>
<!-- Body Panel ends -->

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
</script>
