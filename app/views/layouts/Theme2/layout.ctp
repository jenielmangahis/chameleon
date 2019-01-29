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
</head>

<body>
    <div class="container">
        <?php echo $this->element("menuhil");?> 
        <?php echo $content_for_layout ?>
    </div>
</body>
</html>
