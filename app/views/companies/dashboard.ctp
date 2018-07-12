<?php
$baseUrl = Configure::read('App.base_url');
?>
<Style>
.all-rounded {
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
-webkit-box-shadow: #666 0px 2px 3px;
-moz-box-shadow: #666 0px 2px 3px;
box-shadow: #666 0px 2px 3px;

}
 
.spacer {
    display: block;
}
 
#progress-bar {
    width: 250px;
    height: 23px;
    margin: 0 auto;
    background: #cccccc;
    border: 2px solid #f2f2f2;
}
 
#progress-bar-percentage {
    background:#509cd9;             /*#3063A5;*/
    padding: 5px 0px;
     color: #FFF;
     font-weight: bold;
     text-align: center;
     height:13px;
}

ul.list-style1,ul.list-style1 li{ list-style:none; margin:0; padding:0;}
ul.list-style1{height:65px; overflow:auto;}
</style>
      <script type="text/javascript">   
              $(document).ready(function() { 
               
                 var current_domain=$("#current_domain").val(); //"localhost:8080";
                  $('#eventinvitelist').hide();
                 $('#eventinvitelist').load('http://'+current_domain+'/companies/get_eventinvitations_by_ajax/0/10', function(){
                   //  $("#comment_start").val(0);
                      $('#eventinvitelist').slideDown(1000); 
                      eventinviteactions();
                 });
                 
                 function eventinviteactions(){
                   
                     $("input[id^='respondevent_']").click(function(){ 
                         var current_domain=$("#current_domain").val();      
                        var $this = $(this);
                        var idarr = $this.attr('id').split('_');
                        var event_id=idarr[1];             
                        var optname="invite_status_"+event_id;
                        var respond = $('input:radio[name='+optname+']:checked').val();
                      
                         $.ajax({
                            type : "POST",
                            dataType: "json",
                            url: "http://"+current_domain+"/companies/eventrespond/"+event_id+"/"+respond,
                            success : function(result){
                                if(result == 1)
                                    {
                                      alert("Responded successfully!");   
                                        $('#eventinvitelist').hide();
                                         $('#eventinvitelist').load('http://'+current_domain+'/companies/get_eventinvitations_by_ajax/0/10', function(){
                                           //  $("#comment_start").val(0);
                                              $('#eventinvitelist').slideDown(1000); 
                                              eventinviteactions();
                                         });       

                                }
                                else
                                    {
                                        alert("Oops! There seems to be some problem. Please try in some time."); 
                                }
                            } 
                        });

                   });  
                   
                    $("span[id^='viewfulldesc_']").click(function(){ 
                         var current_domain=$("#current_domain").val();      
                        var $this = $(this);
                        var idarr = $this.attr('id').split('_');
                        var event_id=idarr[1];
                        $("#viewfulldesc_"+event_id).hide(); 
                        $("#eventshortdesc_"+event_id).hide();
                        $("#eventfulldesc_"+event_id).slideDown();
                         $("#hidefulldesc_"+event_id).show();  
                         
                    
                        
                   });  
                   
                   $("span[id^='hidefulldesc_']").click(function(){ 
                         var current_domain=$("#current_domain").val();      
                        var $this = $(this);
                        var idarr = $this.attr('id').split('_');
                        var event_id=idarr[1]; 
                         $("#hidefulldesc_"+event_id).hide();     
                        $("#eventfulldesc_"+event_id).hide();
                        $("#eventshortdesc_"+event_id).slideDown();
                        $("#viewfulldesc_"+event_id).show();
                       
                        
                   });  
                               
                 }
                 
             });
      </script>

 <!-- Body Panel starts -->
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
//			$facebook_session = $facebook->getSession();

/*****FB******/

if($_SESSION['User']['User']['usertype']=="holder"){ 

    function progressBar($percentage)
     {
    print "<div id=\"progress-bar\" class=\"all-rounded\">\n";
    print "<div id=\"progress-bar-percentage\" class=\"all-rounded\" style=\"width: $percentage%\">";
        if ($percentage > 5) {print "$percentage%";} else {print "<div class=\"spacer\">&nbsp;</div>";}
    print "</div></div>";
    }


?>
  
  <div class="navigation">
  <div class="boxBg">
  <!--<p class="boxTop"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p> -->
  
  <!--<div class="boxBor">
  <div class="boxPad">
  	<?php //echo $this->element("leftmenubar");?>  

    <p>&nbsp;</p>
	<?php if ($facebook_session) { ?>
	<fb:login-button show-faces="true" width="200" max-rows="4" perms="email,user_birthday,status_update,publish_stream"></fb:login-button>
	<p>&nbsp;</p>
	<fb:activity site="" width="200" height="300" header="true" font="" border_color="" recommendations="false"></fb:activity>
	<?php } ?>
  </div>
  </div>  
<?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p> -->
  
  </div>
  </div>
  <div class="bodyCont">
  <div class="boxBg">
  <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p> -->
  <div class="boxBor">
  
  
  <div class="boxPad">
<div style="height:auto !important;height:200px;min-height:200px;">
<div style="float:left;width:220px;vertical-align: top;padding:0;">
 <?php 
	//pr($_SESSION['User']['User']);
	if(!empty($_SESSION['User']['User']['avatar_url']))
	echo $html->image('/'.$_SESSION['User']['User']['avatar_url'], array('width'=>'70','height'=>'70','style'=>'vertical-align: top;text-align: left;margin-right:5px; border:1px solid #ccc;float: left;'));
	else
	echo $html->image('noimg.jpg', array('width'=>'70','height'=>'70','style'=>'vertical-align: top;text-align: left; margin-right:5px; border:1px solid #ccc;float: left;'));
	
	echo "<p style='display: block; float: left; font-size:12px; font-weight:bold;'>";
	echo "Welcome !<br />";
	if(isset($_SESSION['User']['User']['usertype'])=="holder") { 
	echo (isset($screenname) && !empty($screenname))?$screenname:$username;
	} 	else  	{
	 echo $username;
	}
	echo "</p>";
	?></div>
     
<div style="float:right;position:relative; width: auto;">     
<div style="" class="border_shadow" id="leftmenubar_bg">
    <?php echo $this->element("leftmenubar");?>  
	<div class="clear"></div>
</div>
<?php if(!empty($todayMessage)) { ?>
<div style="margin:10px 0">
<p  style="width: 130px; float:left;padding-top: 24px;"><b>Today's Message</b></p>
<div style="width: 478px; height: 51px; border:1px solid #ccc; float:left;padding:5px;">
<?php echo $todayMessage; ?>
</div>
<div class="clear"></div>
</div>
<?php } ?>
</div>
<div class="clear"></div>

     
<?php echo  $form->create('Holder',array('action'=>'','id'=>'dashboard','url'=>$this->here ,'onsubmit' => ''));?>
 <div class="clear"></div>
<?php if($_SESSION['User']['User']['usertype']=="holder"){ ?>

<input type="hidden" id="current_domain" value="<?php echo $current_domain;?>">
 <table width="100%" >
	<tr>
           <td width="62%" valign="top"> 
           
		   <table align="right" border="0" style="border:2px solid #999999;margin-bottom: 10px;" cellspacing="5"  width="100%" class="border_shadow">
	       <tr>
            <td style=" background:#f65b08; padding:3px 5px; color:#fff;" >          
            <b>My Event</b>
            </td>
	        </tr>
	        <tr><td style="padding:0 20px;">
				<ul class='list-style1'>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
				</ul>
			</td></tr>
            </table>
            
			<table align="right" border="0" style="border:2px solid #999999;margin-bottom: 10px;" cellspacing="5"  width="100%" class="border_shadow">
	       <tr>
            <td style=" background:#02940f; padding:3px 5px; color:#fff;" >          
            <b>You have 4 Comments to Respond to!</b>
            </td>
	        </tr>
	        <tr><td style="padding:0 20px;">
				<ul class='list-style1'>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
				</ul>
			</td></tr>
            </table>
			
			<table align="right" border="0" style="border:2px solid #999999;margin-bottom: 10px;" cellspacing="5"  width="100%" class="border_shadow">
	       <tr>
            <td style=" background:#0a31fa; padding:3px 5px; color:#fff;" >          
            <b>You have 4 Replies to Respond to!</b>
            </td>
	        </tr>
	        <tr><td style="padding:0 20px;">
				<ul class='list-style1'>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
				</ul>
			</td></tr>
            </table>
			
			<table align="right" border="0" style="border:2px solid #999999;margin-bottom: 10px;" cellspacing="5"  width="100%" class="border_shadow">
	       <tr>
            <td style=" background:#ef0a35; padding:3px 5px; color:#fff;" >          
            <b>You have 4 Messages!</b>
            </td>
	        </tr>
	        <tr><td style="padding:0 20px;">
				<ul class='list-style1'>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
					<li>aaaa</li>
				</ul>
			</td></tr>
            </table>
            
           
           </td>
           <td width="37%" valign="top">
          
<table align="right" border="0" style="border:2px solid #999999; width: 300px;margin-bottom: 15px;" cellspacing="5" class="border_shadow">
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="2"><b> Profile is <?php echo $pro_complete['profile'];?>% done </b></font></td>
</tr>

<tr>
<td><?php progressBar($pro_complete['profile']); ?></td>
</tr>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $baseUrl ?>companies/update_profile" style="text-decoration: none;"><font size="2"><b> Complete it now.. </b></font></a></td>
</tr>

</table>


<table align="right" border="0" style="border:2px solid #999999; width: 300px;margin-bottom: 15px;" cellspacing="0" class="border_shadow">
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>


<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $baseUrl ?>companies/view_registeredcoins" style="text-decoration: none;"><font  size="2"><b>You have</b> </font> <font  size="2"><b> <?php echo $waiting_comments; ?> Comments to Respond to.  </b></font></a></td>
</tr>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>

</table>



<table align="right" border="0" style="border:2px solid #999999; width: 300px;margin-bottom: 15px;" cellspacing="0" class="border_shadow">
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>

<?php
    if($member_points['points']==NULL)
        $member_points['points']=0;
?>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font size="2">
<strong>You have  <font  size="3"> <b><?php echo $member_points['points'];?></b> </font> total points.  
</strong></font></td>
</tr>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>

</table>




<table align="right" border="0" style="width: 300px;border:2px solid #999999;margin-bottom: 15px;" cellspacing="5" class="border_shadow">
<?php
//debugbreak();
 $create_date=date('m-d-Y', strtotime($creatdate)); 
 $last_login=date('m-d-Y', strtotime($last_login));         //$dateoflogin
 
 if(isset($coincreatdate)!="" || isset($coincreatdate)!=null)
    $coincreat_date=date('m-d-Y', strtotime($coincreatdate)); 
 else
    $coincreat_date="No";
    if($lastcommenteddate!="" || $lastcommenteddate!=null)
    $lastcommenteddate=date('m-d-Y', strtotime($lastcommenteddate)); 
 else
    $lastcommenteddate="No";

?>

	<tr>
		<td>Member Since</td>
		<td><?php echo $create_date; ?></td>
	</tr>
	<tr>
		<td>Coin Registered</td>
		<td><?php echo $coincreat_date; ?></td>
	</tr>
	<tr>
		<td>Coins Registered</td>
		<td><?php echo $noofcoins; ?></td>
	</tr>
	<tr>
		<td>Comments made</td>
		<td><?php echo $ncomment; ?></td>
	</tr>
	<tr >
		<td>Last login</td>
		<td><?php echo $last_login; ?></td>
	</tr>
	<tr >
		<td>Last comment</td>
		<td><?php echo $lastcommenteddate; ?></td>
	</tr>
</table>
</td>
      </tr>
  </table>  
<?php } ?>
</div>

  </div>
  
  
  </div>   
	<!--<p class="boxBot"><?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>-->
  
  </div>
  </div>
<div></div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 

<?php }  else{ ?>



<div class="container">
<div class="titlCont"><div class="myclass">
        <div align="center" id="toppanel" >
	        <?php  echo $this->renderElement('new_slider');  ?>

        </div>

<span class="titlTxt">
Dashboard
</span>
<div class="topTabs">
<ul>

</ul>
</div>
</div></div>

 <div class="midPadd">
		<br>
		
		
		 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
 <?php } ?>
<div class=""  style="height:350px;">
<h2 style="backgroun:none; text-align:center;">Welcome <?php
 if($_SESSION['User']['User']['usertype']=="holder")
	{ 
	$firstnam=$screenname;
	echo  $firstnam;
	} else  {
	 echo $username;
	}	?> !</h2></center>
<?php echo  $form->create('Holder',array('action'=>'','id'=>'dashboard','url'=>$this->here ,'onsubmit' => ''));?>

</div>  </div>


<!--inner-container ends here-->
<?php echo $form->end();?>
<div></div>
<div class="clear"></div>
<?php } ?>
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