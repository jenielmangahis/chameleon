<?php
$baseUrl = Configure::read('App.base_url');

?>
<style>

.tablescroll
{ font: 12px normal Tahoma, Geneva, "Helvetica Neue", Helvetica, Arial, sans-serif; background-color:#fff; }

.tablescroll td, 
.tablescroll_wrapper,
.tablescroll_head,
.tablescroll_foot
{ border:1px solid #ccc; }

.tablescroll td
{ padding:3px 5px; }

.tablescroll_wrapper
{ border-left:0; }

.tablescroll_head
{ font-size:11px; font-weight:bold; background-color:#eee; border-left:0; border-top:0; margin-bottom:3px; }

.tablescroll thead td
{ border-right:0; border-bottom:0; }

.tablescroll tbody td
{ border-right:0; border-bottom:0; }

.tablescroll tbody tr.first td
{ border-top:0; }

.tablescroll_foot
{ font-weight:bold; background-color:#eee; border-left:0; border-top:0; margin-top:3px; }

.tablescroll tfoot td
{ border-right:0; border-bottom:0; }

</style>


<style>
    .email_align{
        float: left; position: relative; width: 500px; margin-left: 100px; 
    }
</style>

<?php
ini_set('max_execution_time',120);
echo $javascript->link('/js/thickbox.js');
echo $html->css('/css/thickbox.css');

if(!empty($_SESSION['email_provider'])=="gmail")
{
    ?>
    <script type='text/javascript'>
     $(document).ready(function(){
         
        $('#provider_img_invite_list').attr({ src: baseUrl+'images/gmail_thumb.png'});  
          
     });
    </script>
    
    <?php
    $_SESSION['email_provider']="";
}/*
else
if($_SESSION['email_provider']=="yahoo")
{
    ?>
    <script type='text/javascript'>
     $(document).ready(function(){
         
        $('#provider_img_invite_list').attr({ src: '/images/yahoo_thumb.png'});  
          
     });
    </script>
    
    <?php
    $_SESSION['email_provider']="";
}*/
else
if(!empty($_SESSION['email_provider'])=="aol")
{
    ?>
    <script type='text/javascript'>
     $(document).ready(function(){
         
        $('#provider_img_invite_list').attr({ src: baseUrl+'images/aol_thumb.png'});  
          
     });
    </script>
    
    <?php
    $_SESSION['email_provider']="";
}
else
if(!empty($_SESSION['email_provider'])=="msn")
{
    ?>
    <script type='text/javascript'>
     $(document).ready(function(){
         
        $('#provider_img_invite_list').attr({ src: baseUrl+'images/msn_thumb.png'});  
          
     });
    </script>
    
    <?php
    $_SESSION['email_provider']="";
}
else
if(!empty($_SESSION['email_provider'])=="hotmail")
{
    ?>
    <script type='text/javascript'>
     $(document).ready(function(){
         
        $('#provider_img_invite_list').attr({ src: baseUrl+'images/windowslive_thumb.png'});  
          
     });
    </script>
    
    <?php
    $_SESSION['email_provider']="";
}
/*
else
if($_SESSION['email_provider']=="twitter")
{
    ?>
    <script type='text/javascript'>
     $(document).ready(function(){
         
        $('#provider_img_invite_list').attr({ src: '/images/twitter_thumb.png'});  
          
     });
    </script>
    
    <?php
    $_SESSION['email_provider']="";
}
*/

?>

<script type='text/javascript'>
    function toggleAll(element) 
    {
        //alert(element);
        var form = document.forms.invite, z = 0;
        for(z=0; z<form.length;z++)
            {
            if(form[z].type == 'checkbox')
                form[z].checked = element.checked;
        }
    }
    
    
    function check_toggle() 
    {
        
        var form = document.forms.invite, z = 0;
        var ch=0;
        for(z=0; z<form.length;z++)
            {
            //if(form[z].type == 'checkbox')
                if(form[z].checked ==false)
                    ch++;             
            }
            ch++;
              
            if(ch==form.length)
            {
                alert("Please choose atleast 1 contact to send invitation");
                return false;
            }
            return true;
    }
    
    function check_tweet() 
    {
        
        var tweet = document.invite_friends.tweet.value;
        if(tweet=="")
        {
            alert("Please post a tweet");
            return false;
        }
        return true;
       
    }
    
</script>

<script type="text/javascript"> 
    $(document).ready(function(){

        $("#login_content").hide();
        
    

        $("#gmail").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("gmail");
            $("#provider_img").attr({ src: baseUrl+"images/gmail_thumb.png"});
            $("#id_change").html("Email ID");

        });
        /*
        $("#yahoo").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("yahoo");
            $("#provider_img").attr({ src: "/images/yahoo_thumb.png"});
            $("#id_change").html("Email ID");

        });
        */
        $("#linkedin").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("linkedln");
            $("#provider_img").attr({ src: baseUrl+"images/linkedin_thumb.png"});
            $("#id_change").html("Email ID");

        });
        
        $("#aol").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("aol");
            $("#provider_img").attr({ src: baseUrl+"images/aol_thumb.png"});
            $("#id_change").html("Email ID");

        });
        
        $("#msn").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("msn");
            $("#provider_img").attr({ src: baseUrl+"images/msn_thumb.png"});
            $("#id_change").html("Email ID");

        });
        
        $("#windowslive").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("hotmail");
            $("#provider_img").attr({ src: baseUrl+"images/windowslive_thumb.png"});
            $("#id_change").html("Email ID");

        });
        
   /*     $("#twitter").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("twitter");
             $("#provider_img").attr({ src: "/images/twitter_thumb.png"});
             
             $("#id_change").html("Username");

        });
    */    
        $("#facebook").click(function(){
          /*  $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("facebook");*/

        });

        $("#cancel").click(function(){
            $("#login_content").hide();
            $("#contact_list").hide();
            $("#email_list").show();
        });


    });
</script>
<!-- Body Panel starts -->
<?php 

    if(!empty($contacts))
    {
    ?>    

    <script type='text/javascript'> 
        $(document).ready(function(){
            $('#login_content').hide();
            $("#contact_list").show();
            $('#email_list').hide();

        });
    </script>
    <?php
    }

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
                            <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow" id="leftmenubar_bg">

                                <?php echo $this->element("leftmenubar");?>  
                            </div>

                        </div>


                        <div class="clear"></div>
                        <br /><br /><br />

                        <div style="width: 100%; margin-top: 5px; margin-left: 122px;"><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>



                        <div class="email_align" align="center"> 
<?php

    if(isset($twitterInfo)=='')
    {
        $appid = "s.j3JSnIkY1XiLzW07tcJYDSJ6McY9K5GW0S";  // my application ID, obtained at registration 
        $appdata = "foobar";                             // my optional, arbitrary url-encoded data 
        $ts = time();                                    // seconds since Jan 1, 1970 GMT
        $secret = "5538215eb931972ef695fd43731304d1"; // my shared secret, obtained at registration 

        $sig = md5( "/WSLogin/V1/wslogin?appid=$appid&appdata=$appdata&ts=$ts" . "$secret" );
        $yahoo_url = "https://api.login.yahoo.com/WSLogin/V1/wslogin?appid=$appid&appdata=$appdata&ts=$ts&sig=$sig";
?>
                            <table border="0" align="center" style="width:400px;" id="email_list">

                                <tr>
                                    <td>
                             <a id="gmail" href="javascript: void(0);"><img src="<?php echo $baseUrl ?>images/gmail_thumb.png"></a>
                                    </td>
                                    <td>
                                        <a id="yahoo" href="<?php echo $yahoo_url;?>" target="blank"><img src="<?php echo $baseUrl ?>images/yahoo_thumb.png"></a>
                                    </td>
                                    <!--<td>
                                        <a id="linkedin" href="javascript: void(0);"><img src="/images/linkedin_thumb.png"></a>
                                    </td>-->
                                    <td>
                                        <a id="msn" href="javascript: void(0);"><img src="<?php echo $baseUrl ?>images/msn_thumb.png"></a>
                                    </td>
                                    <td>
                                        <a id="windowslive" href="javascript: void(0);"><img src="<?php echo $baseUrl ?>images/windowslive_thumb.png"></a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <!--<td>
                                        <a id="windowslive" href="javascript: void(0);"><img src="/images/windowslive_thumb.png"></a>
                                    </td>-->
                                    <td>
                                        <a id="aol" href="javascript: void(0);"><img src="<?php echo $baseUrl ?>images/aol_thumb.png"></a>
                                    </td>
                                <?php
                                if(isset($oauth_token) == '')
                                {
                                    
                                    $url = $twitterObj->getAuthorizationUrl('http://'.$twitter_redirect);
                                ?>
                                    <td>
                                        <a id="twitter" href="<?php echo $url;?>"><img src="<?php echo $baseUrl ?>images/twitter_thumb.png"></a>
                                    </td>
                                    <?php 
                                }
                                    if(!empty( $project['Project']['facebookappkey'])&& !empty($project['Project']['facebooksecretkey']))
                                    {  ?>
                                    <td>
                                        <a id="facebook" href="invite_fbfriends"><img src="<?php echo $baseUrl ?>images/facebook_thumb.png"></a>
                                    </td>
                                    <?php } ?>
                                </tr>

                            </table>  
                            
<?php
    }
    else
    {
        ?>
        <?php echo  $form->create('invite_friends',array('action'=>'','url'=>'invite_friends','id'=>'invite','name'=>'invite_friends','onsubmit'=>'return check_tweet();'));?>
        <table border="0" align="center" style="width:400px;" cellspacing="5">
        <?php $_SESSION['twitter_profile']; ?>
        <?php echo $form->hidden("twitter_ot", array('id' => 'twitter_ot','name'=>'twitter_ot', 'value'=>$twitter_ot));
        echo $form->hidden("twitter_ots", array('id' => 'twitter_ots','name'=>'twitter_ots', 'value'=>$twitter_ots));
        ?>
        <tr>
        <td align="left"><b>Username:&nbsp;</b><?php echo $t_username;?></td>      
        </tr>
        <!--<tr>
        <td align="left"><b>Profile Picture:&nbsp;&nbsp;&nbsp;&nbsp;</b><img src="<?php // echo $profilepic;?>" width="40" height="40"</td>
        </tr>-->
        <tr>
        <td align="left"><b>Update Twitter Timeline</b></td>
        </tr>
        <tr>
        <td align="left"><textarea  name="tweet" cols="50" rows="5" id="tweet" >Join us on <?php echo $project_home_url."?register_redirect=1&invite_id=".$invite_id;?> to become a member of <?php echo $project_name;?> team.
        </textarea></td>
        </tr>
        <tr>
        <td align="left"><input type='submit' value='Tweet' name='submit' id='submit' /></td>
        </tr>
        
        </table>
        <?php echo $form->end(); ?> 
        <?php
        
    }
    ?>

                            <?php 
                                if(empty($contacts))
                                {
                                    echo  $form->create('invite',array('action'=>'','id'=>'invite','url'=>$this->here ,'onsubmit' => '','name'=>'invite'));?>
                                    <table border="0" align="center" style="width:600px;" id="login_content">
                                       <tr>
                                        <td width="150px;" valign="top">
                                           <img id="provider_img" src="">
                                        </td>
                                        <td width="450px;" valign="top">
                                             <table border="0" align="center" style="width:400px;" id="login_content">


                                    <tr>
                                        <td>
                                            <label class="frmLbls frmLbl2"><span id="id_change">Email ID</span></label>
                                        </td>
                                        <td><!--<input type="text" name="email_id">-->
                                            <span class="intpSpan"> 
                                                <?php echo $form->input('email_id',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"email_id",'size'=>'40', 'class'=>'inptBox' )) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="frmLbls frmLbl2">Password  </label> 
                                        </td>
                                        <td><!--<input type="text" name="password">-->
                                            <span class="intpSpan"> 
                                                <?php echo $form->input('email_password',array('label'=>false,'div'=>false,'type'=>"password", 'id'=>"email_password",'size'=>'40', 'class'=>'inptBox' )) ?>
                                            </span>
                                        </td>
                                    </tr>
                                   
                                           
                                                <?php echo $form->input('email_provider',array('label'=>false,'div'=>false,'type'=>"hidden", 'id'=>"e_p",'size'=>'40')) ?>

                                     
                                    <tr>
                                        <td>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" align="center"> <span class="">
                                                <span class="flx_button_lft ">
                                                    <?php echo $form->submit('Submit', array('div'=>false,"class"=>"flx_flexible_btn "));?> 
                                                </span>
                                            </span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="">
                                                <span class="flx_button_lft ">
                                                    <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'cancel'));?> 
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                               </table>  
                                         </td>
                                         </tr>
                                    </table>   
                                    <?php echo $form->end(); }?> 
                    </div> 
                                <?php
                                    if(!empty($contacts))
                                    {
                                       
                                        asort($contacts);
                                    ?>
                                    <div align="left" style=" position: relative; float: left; width: 100%;">
                                    
                                        <div style="position: relative; float: left; width: 20%;">
                                            <img id="provider_img_invite_list" src="" height="70px" width="140px">
                                        </div>
                                         <div style="position: relative; float: left; padding-left: 0px; width: 80%;">
                                            
                                                  <?php echo  $form->create('send_invite',array('action'=>'','url'=>'/companies/send_invites','id'=>'invite','name'=>'send_invite','onsubmit'=>'return check_toggle();'));?>
                                                    <div class="tablescroll">
                                                    
                                                    <table id="contact_list" width="600px" cellspacing="0">
                                                    
                                                        <thead>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td><input type='checkbox' onClick='toggleAll(this)' name='toggle_all' title='Select/Deselect all'></td>
                                                            <td><font size="2">Name</font></td>
                                                            <td><font size="2">Email</font></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>  
                                                        
                                                        
                                                    <?php
                                                            $cnt=1;
                                                            $alt=0;
                                                            foreach ($contacts as $email=>$name)
                                                            {
                                                                if($alt%2==0)
                                                                    $class="style='background-color:#FFF;'";
                                                                else
                                                                    $class="style='background-color:#e4e2e2;'";

                                                                $alt++;
                                                                
                                                                $name=str_replace('.','',$name);
                                                                
                                                                $pos=strpos($name,'@');
                                                                if($pos !== false)
                                                                {
                                                                    $name=substr($name,0,$pos);
                                                                    
                                                                }
                                                                
                                                                if($cnt==1)
                                                                    $class="class='first'";
                                                            ?>
                                                            <tr <?php echo $class;?> >
                                                                <td><?php echo $cnt;?></td>
                        <td><?php echo $form->checkbox($name, array('label'=>false,'div'=>false,'value'=>$email));?> </td>
                                                                <td><?php echo $name;?></td>
                                                                <td><?php echo $email;?></td>
                                                            </tr>
                                                            <?php
                                                                $cnt++;
                                                            }
                                                        ?>
                                                      </tbody>
                                                      <tfoot>
                                                        <tr align="center">
                                                            <td colspan="4">
                                                                <span class="">
                                                                    <span class="flx_button_lft ">
                                                                        <a href="http://<?php echo $current_domain;?>/invite_popup.html?height=220&width=350&modal=true" class="thickbox">
                                                                        <?php echo $form->button('Send Invites', array('div'=>false,"class"=>"flx_flexible_btn"));?>
                                                                        </a>
                                                                        
                                                                    </span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                      </table>
                                                    </div>
                                                     <?php 
                                                    echo $form->hidden("default_msg", array('id' => 'default_msg','name'=>'default_msg', 'value'=>$msgbody));
                                                    echo $form->hidden("user_msg", array('id'=>'user_msg'));?>
                                                    <?php echo $form->end();?>  

                                                    
                                               
                                        </div>
                                    </div>
                                <?php
                                        }
                                    ?>

                    </div>

                </div>
            </div>   


        </div>
    </div>
    <div></div>
    <div class="clear"></div>
    <!-- Body Panel ends --> 

    <?php } 
?>

<script language="javascript">
function setmsg(msg)
{
   
    $('#user_msg').val(msg);
    //alert($('#user_msg').val());
    if(check_toggle())   
        document.send_invite.submit();
}
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script type="text/javascript">

/*

Copyright (c) 2009 Dimas Begunoff, http://www.farinspace.com

Licensed under the MIT license
http://en.wikipedia.org/wiki/MIT_License

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/

;(function($){

    var scrollbarWidth = 0;

    // http://jdsharp.us/jQuery/minute/calculate-scrollbar-width.php
    function getScrollbarWidth() 
    {
        if (scrollbarWidth) return scrollbarWidth;
        var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div></div>'); 
        $('body').append(div); 
        var w1 = $('div', div).innerWidth(); 
        div.css('overflow-y', 'auto'); 
        var w2 = $('div', div).innerWidth(); 
        $(div).remove(); 
        scrollbarWidth = (w1 - w2);
        return scrollbarWidth;
    }
    
    $.fn.tableScroll = function(options)
    {
        if (options == 'undo')
        {
            var container = $(this).parent().parent();
            if (container.hasClass('tablescroll_wrapper')) 
            {
                container.find('.tablescroll_head thead').prependTo(this);
                container.find('.tablescroll_foot tfoot').appendTo(this);
                container.before(this);
                container.empty();
            }
            return;
        }

        var settings = $.extend({},$.fn.tableScroll.defaults,options);
        
        // Bail out if there's no vertical overflow
        //if ($(this).height() <= settings.height)
        //{
        //  return this;
        //}

        settings.scrollbarWidth = getScrollbarWidth();

        this.each(function()
        {
            var flush = settings.flush;
            
            var tb = $(this).addClass('tablescroll_body');

            // find or create the wrapper div (allows tableScroll to be re-applied)
            var wrapper;
            if (tb.parent().hasClass('tablescroll_wrapper')) {
                wrapper = tb.parent();
            }
            else {
                wrapper = $('<div class="tablescroll_wrapper"></div>').insertBefore(tb).append(tb);
            }

            // check for a predefined container
            if (!wrapper.parent('div').hasClass(settings.containerClass))
            {
                $('<div></div>').addClass(settings.containerClass).insertBefore(wrapper).append(wrapper);
            }

            var width = settings.width ? settings.width : tb.outerWidth();

            wrapper.css
            ({
                'width': width+'px',
                'height': settings.height+'px',
                'overflow': 'auto'
            });

            tb.css('width',width+'px');

            // with border difference
            var wrapper_width = wrapper.outerWidth();
            var diff = wrapper_width-width;

            // assume table will scroll
            wrapper.css({width:((width-diff)+settings.scrollbarWidth)+'px'});
            tb.css('width',(width-diff)+'px');

            if (tb.outerHeight() <= settings.height)
            {
                wrapper.css({height:'auto',width:(width-diff)+'px'});
                flush = false;
            }

            // using wrap does not put wrapper in the DOM right 
            // away making it unavailable for use during runtime
            // tb.wrap(wrapper);

            // possible speed enhancements
            var has_thead = $('thead',tb).length ? true : false ;
            var has_tfoot = $('tfoot',tb).length ? true : false ;
            var thead_tr_first = $('thead tr:first',tb);
            var tbody_tr_first = $('tbody tr:first',tb);
            var tfoot_tr_first = $('tfoot tr:first',tb);

            // remember width of last cell
            var w = 0;

            $('th, td',thead_tr_first).each(function(i)
            {
                w = $(this).width();

                $('th:eq('+i+'), td:eq('+i+')',thead_tr_first).css('width',w+'px');
                $('th:eq('+i+'), td:eq('+i+')',tbody_tr_first).css('width',w+'px');
                if (has_tfoot) $('th:eq('+i+'), td:eq('+i+')',tfoot_tr_first).css('width',w+'px');
            });

            if (has_thead) 
            {
                var tbh = $('<table class="tablescroll_head" cellspacing="0"></table>').insertBefore(wrapper).prepend($('thead',tb));
            }

            if (has_tfoot) 
            {
                var tbf = $('<table class="tablescroll_foot" cellspacing="0"></table>').insertAfter(wrapper).prepend($('tfoot',tb));
            }

            if (tbh != undefined)
            {
                tbh.css('width',width+'px');
                
                if (flush)
                {
                    $('tr:first th:last, tr:first td:last',tbh).css('width',(w+settings.scrollbarWidth)+'px');
                    tbh.css('width',wrapper.outerWidth() + 'px');
                }
            }

            if (tbf != undefined)
            {
                tbf.css('width',width+'px');

                if (flush)
                {
                    $('tr:first th:last, tr:first td:last',tbf).css('width',(w+settings.scrollbarWidth)+'px');
                    tbf.css('width',wrapper.outerWidth() + 'px');
                }
            }
        });

        return this;
    };

    // public
    $.fn.tableScroll.defaults =
    {
        flush: true, // makes the last thead and tbody column flush with the scrollbar
        width: null, // width of the table (head, body and foot), null defaults to the tables natural width
        height: 100, // height of the scrollable area
        containerClass: 'tablescroll' // the plugin wraps the table in a div with this css class
    };

})(jQuery);


</script>

<script>
/*<![CDATA[*/

jQuery(document).ready(function($)
{
    //$('#thetable').tableScroll({height:150});
   
    $('#contact_list').tableScroll({height:300});
});

/*]]>*/
</script>