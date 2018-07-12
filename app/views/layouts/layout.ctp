<?php 
$actionsArray = array(
		'login' => 'Login',
		'registeruser' => 'Register',
		'dashboard' => 'Dashboard',
		'comments' => 'Comments',
		'register_coin' => 'Coin Register',
		'view_registeredcoins' => 'View Coins',
		'update_profile' => 'Update Profile' ,
		'changeuserpassword' => 'Change Password',
		'index' => 'Home'
	);
    
if ($this->params["controller"] == 'companies' && $this->params["action"] != 'pages') {
    $meta_title = $actionsArray[$this->params["action"]];   
}else{ 
       $isindemeta='index';
       $isfollowmeta='follow'; 
       if($meta_isindex=='0'){
              $isindemeta='noindex'; 
        }
        
        if($meta_isfollow=='0'){
              $isfollowmeta='nofollow'; 
        } 
}
 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php if(!empty($meta_description)) echo $meta_description; else{echo $dataprojects['Project']['sitemetadescription'];} ?>" />
<meta name="Keywords" content="<?php if(!empty($meta_keyword))  echo $meta_keyword; else{echo $dataprojects['Project']['sitemetakeyword'];} ?>" />
<?php if(isset($isindemeta) && !empty($isindemeta) && isset($isfollowmeta) && !empty($isfollowmeta)) { ?>
 <meta name="robots" content="<?php echo $isindemeta.",".$isfollowmeta; ?>"/>
  <?php } ?>
<link rel="canonical" href="<?php if(!empty($dataprojects['Project']['canonicalurl'])) echo 'http://'.$dataprojects['Project']['canonicalurl']; ?>"/>
<meta name="geo.position" content="<?php if(!empty($dataprojects['Project']['longitude']) && !empty($dataprojects['Project']['latitude'])) echo $dataprojects['Project']['longitude'].';'.$dataprojects['Project']['latitude']; ?>" />
<meta name="ICBM" content="<?php if(!empty($dataprojects['Project']['longitude']) && !empty($dataprojects['Project']['latitude'])) echo $dataprojects['Project']['longitude'].','.$dataprojects['Project']['latitude']; ?>" />
<meta name="robots" content="NOYDIR,NOODP" />
<title><?php echo $dataprojects['Project']['project_name'];?> :: <?php if(!empty($page_title))  echo $page_title; ?></title> 
<?php echo $google_metatag; ?>
<?php echo $yahoo_metatag; ?>
<?php echo $bing_metatag; ?>		
<?php     
	//$project_name_default=$dataprojects['Project']['project_name'];
	$project_name_default="default";
	echo $html->css('/css/'.$project_name_default.'/styles');
	echo $html->css('/css/'.$project_name_default.'/facebox');
	// echo $javascript->link('/js/'.$project_name.'/DD_belatedPNG.js');
	echo $javascript->link('/js/'.$project_name_default.'/jquery-1.4.2.min.js');
    echo $javascript->link('/js/'.$project_name_default.'/user_validate.js');
  	echo $javascript->link('/js/'.$project_name_default.'/facebox.js');
	echo $javascript->link('/js/jquery.dropdownPlain.js');
	//echo $javascript->link('flashdetect.js');		    
    echo $javascript->link('jquery.blockUI.js');
?>
<script type="text/javascript">
var switchTo5x=true;
</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:'1de6e26d-5291-498f-b1e6-92111f624d70'});</script>
<?php  

if(!empty($dataprojects['Project']['favicon']))
			 echo $html->meta('icon',"img/".$dataprojects['Project']['project_name']."/uploads/".$dataprojects['Project']['favicon'], array('type' =>'icon')); 
		?>
<style type="text/css">
.float_div_chat{
-moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
   
    list-style: none outside none;
    padding: 8px 1px;
    position: fixed;
    right: 0;
    top: 233px;
    width: 24px;
    z-index: 5;
}
</style>


<!-- //////////////////////////////from index.ctp/////////////////////////////////// -->

<style type="text/css">
h1 {
    line-height: 24px;    
    background:none;    
    font-size: 28px;
    font-weight: normal;
    padding-bottom: 8px;
    padding-left:0;
    font-family: arial;
   text-transform: capitalize;
}
h2 {    
    background:none;    
    font-size: 24px;
    font-weight: normal;
    padding-bottom: 8px;
    padding-left:0;
    font-family: arial;
   text-transform: capitalize;
}
h3 {
    font-size: 18px;
    font-weight: normal;
    padding-bottom: 8px;
}
</style>

<!-- //////////////////////////////from index.ctp/////////////////////////////////// -->

<script type="text/javascript" language="javascript">
//<![CDATA[ 
var menu=function(){
    var t=15,z=50,s=6,a;
    function dd(n){this.n=n; this.h=[]; this.c=[]}
    dd.prototype.init=function(p,c){
        a=c; var w=document.getElementById(p), s=w.getElementsByTagName('ul'),i=0;
        var llen=s.length;
        for(i=0;i<llen;i++){
            var h=s[i].parentNode; this.h[i]=h; this.c[i]=s[i];
            h.onmouseover=new Function(this.n+'.st('+i+',true)');
            h.onmouseout=new Function(this.n+'.st('+i+')');
        }
    }
    dd.prototype.st=function(x,f){
        var c=this.c[x], h=this.h[x], p=h.getElementsByTagName('a')[0];
        clearInterval(c.t); c.style.overflow='hidden';
        if(f){
            p.className+=' '+a;
            if(!c.mh){c.style.display='block'; c.style.height=''; c.mh=c.offsetHeight; c.style.height=0}
            if(c.mh==c.offsetHeight){c.style.overflow='visible'}
            else{c.style.zIndex=z; z++; c.t=setInterval(function(){sl(c,1)},t)}
        }else{p.className=p.className.replace(a,''); c.t=setInterval(function(){sl(c,-1)},t)}
    }
    function sl(c,f){
        var h=c.offsetHeight;
        if((h<=0 && f!=1)||(h>=c.mh && f==1)){
            if(f==1){c.style.filter=''; c.style.opacity=1; c.style.overflow='visible'}
            clearInterval(c.t); return
        }
        var d=(f==1)?Math.ceil((c.mh-h)/s):Math.ceil(h/s), o=h/c.mh;
        c.style.opacity=o; c.style.filter='alpha(opacity='+(o*100)+')';
        c.style.height=h+(d*f)+'px'

    }
    return{dd:dd}
}();
//]]> 
</script>



</head>

<body>
<?php
    if ($this->params["controller"] == 'companies' && $this->params["action"] != 'chat')
    {
?>
<script type="text/javascript" language="javascript">

$(document).ajaxStart(function() {
    $.blockUI({ message: '<img src="../img/loader_light_blue.gif" align="middle" />' });    
     });
$(document).ajaxStop($.unblockUI);
     
//$(document).ajaxStart($.blockUI);

//$(document).ajaxStop($.unblockUI);
</script>
<?php
    }
?>

<table id="loading_image" width="100%"><tr style="height: 540px;"><td align="center">
<?php
echo $html->image('ajax-pageloader.gif',array('alt'=>'imagecoins'));
?>
</td></tr></table>
<!-- Container starts -->
<div class="wrapper" id="main-page-load" style="display:none">
  	<?php echo $this->element("layout_header");?>  
	<div id="container">
		<div class="bodyCont"> <!-- Body Contents starts -->
				<div class="right">
						<?php
						echo $html->image('body_box_rht_top.gif');
						?>
					</div>
				<div class="left">
						<?php
						echo $html->image('body_box_lft_top.gif');
						?>
					</div>
				
					<!--<?php //echo $this->element("topmenubar");?>  -->
						<?php echo $this->element("menuhil");?> 
						<?php echo $content_for_layout ?>
					
				<!-- code for chat button-->
				<?php 
				//pr($_SESSION);
				if($_SESSION['projectwebsite_id']==74 || $_SESSION['projectwebsite_name']=="testproject"){ ?>
				<div style="text-align:center;width:120px;" class="float_div_chat">
                <a href="javascript:void(window.open('http://imagecoins.com/livezilla/chat.php','','width=590,height=610,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))">
                <img src="http://imagecoins.com/livezilla/image.php?id=01&amp;type=inlay" width="120" height="30" border="0" alt="LiveZilla Live Help" /></a><div style="margin-top:2px;"><a href="http://www.livezilla.net" target="_blank" title="LiveZilla Live Chat" style="font-size:10px;color:#bfbfbf;text-decoration:none;font-family:verdana,arial,tahoma;"></a></div></div><!-- http://www.LiveZilla.net Chat Button Link Code --><!-- LiveZilla Tracking Code (ALWAYS PLACE IN BODY ELEMENT) --><div id="livezilla_tracking" style="display:none"></div><script type="text/javascript">

var script = document.createElement("script");script.type="text/javascript";var src = "http://imagecoins.com/livezilla/server.php?request=track&output=jcrpt&nse="+Math.random();setTimeout("script.src=src;document.getElementById('livezilla_tracking').appendChild(script)",1);</script><noscript><img src="http://imagecoins.com/livezilla/server.php?request=track&amp;output=nojcrpt" width="0" height="0" style="visibility:hidden;" alt="LiveZilla Live Help" /></noscript>

					<?php } ?> 
					
					<div id="botprob">
						<div class="right">
							<?php echo $html->image('body_box_rht_bot.gif'); ?>
						</div>
						<div class="left">
							<?php echo $html->image('body_box_lft_bot.gif'); ?>
						</div>
						<div class="clear"></div>
					</div>				
                    <div style="clear:both">
                                <?php
                                    if($page_content['Content']['page_footer']==1)
                                    {
                                         ?>
                                        <div style="margin-top: 20px; margin-bottom: 5px;">
                                            <?php echo $page_footer_content ?>
                                        </div>
                                        <?php 
                                    } 
                                    ?>
                    </div>
                    
                    
                    <div class="clear"></div>
								
		
	
			</div>
		<div class="clear"></div>	
<!-- Footer starts -->
<?php echo $this->element("bottommenubar");?>
		<?php
			if(!empty($super_footer_content))
			{
		?>
		<div class="" style="color:#fff;text-align:center"><?php echo $super_footer_content ?></div> 
		<?php } ?>
<!-- Footer ends -->
<div class="clear"></div> 
			<div id="footerseperator" style="height: 3px;"></div>
			<div class="clear"></div> 
</div>


<!-- Container ends -->
<div class="clear"></div>

<?php  echo $this->element("admin_css");?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount','<?php echo $dataprojects['Project']['googleanalytics']; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">
    var menu=new menu.dd("menu");
    menu.init("menu","menuhover");
</script>

</body>
</html>
