<?php

	/*bodycolor 	bodybgcolor 	headerseperator 	footerseprator 	menucolor 	menuspecial 	bodytextcolor 	copyrighttextcolor 	headercolor1 	headercolor2 	headercolor3 	linkcolor*/

$data1=$styledata;

/* Background Color */ 
$backcolor='#'.$data1['Theme']['backcolor'];
$pagewidth = $data1['Theme']['pagewidth'].'px';
$ispageborder = $data1['Theme']['ispageborder']; 
$bordercolor = '#'.$data1['Theme']['bordercolor']; 
$borderwidth = $data1['Theme']['borderwidth'].'px';
$menuheight = $data1['Theme']['menuheight'].'px';
$menubgcolor='#'.$data1['Theme']['menubgcolor'];

/* Coins Register and Comment */ 
$bgaroundcoins='#'.$data1['Theme']['bgaroundcoins']; 
$bgregisterbtn = $data1['Theme']['bgregisterbtn']; 
$bgcommentbtn = $data1['Theme']['bgcommentbtn']; 


/* Header & Footer Color */
$no_header_img = $data1['Theme']['no_header_img'];
$headercolor='#'.$data1['Theme']['headercolor'];
$headerseperator='#'.$data1['Theme']['headerseperator'];
$footerseprator='#'.$data1['Theme']['footerseprator'];


/* Page Text */
$pagefont='#'.$data1['Theme']['pagefont'];
$bodytextcolor='#'.$data1['Theme']['bodytextcolor'];
$linkcolor='#'.$data1['Theme']['linkcolor'];
$headercolor1='#'.$data1['Theme']['headercolor1'];
$headercolor2='#'.$data1['Theme']['headercolor2'];  
$headercolor3='#'.$data1['Theme']['headercolor3'];  


 /* Menu Text */
$menufont= $data1['Theme']['menufont'];
$fontsize= $data1['Theme']['fontsize'];
$boldtext= $data1['Theme']['boldtext'];
$italictext= $data1['Theme']['italictext'];
$menucolor='#'.$data1['Theme']['menucolor'];
$menuhover='#'.$data1['Theme']['menuhover'];
$menuactive='#'.$data1['Theme']['menuactive'];
$menuspecial='#'.$data1['Theme']['menuspecial'];


 /* Background Color */
$backgroundimage='#'.$data1['Theme']['backgroundimage']; 
$bodybgcolor='#'.$data1['Theme']['bodybgcolor'];
$pagebgimage='#'.$data1['Theme']['pagebgimage']; 
$bodycolor='#'.$data1['Theme']['bodycolor'];
$formscolor='#'.$data1['Theme']['formscolor'];


/* For Register and Login Page */
$labeltextcolor='#'.$data1['Theme']['labeltextcolor']; 
$systemtextcolor='#'.$data1['Theme']['systemtextcolor'];
$systemlinkcolor='#'.$data1['Theme']['systemlinkcolor'];

/*  Member Dashboard & Pages */ 
$copyrighttextcolor='#'.$data1['Theme']['copyrighttextcolor'];
$dropdowntextcolor='#'.$data1['Theme']['dropdowntextcolor'];
$dashboardlabelcolor='#'.$data1['Theme']['dashboardlabelcolor']; 
$dashboardspecialtextcolor='#'.$data1['Theme']['dashboardspecialtextcolor'];
$dashboardlinkcolor='#'.$data1['Theme']['dashboardlinkcolor'];
$dashboardmenutextcolor='#'.$data1['Theme']['dashboardmenutextcolor']; 
$dashboardmenubgcolor='#'.$data1['Theme']['dashboardmenubgcolor'];
$dashboardmenuhovercolor='#'.$data1['Theme']['dashboardmenuhovercolor'];
$dashboardselectmenucolor='#'.$data1['Theme']['dashboardselectmenucolor']; 
$dashboardmenuseparatorcolor='#'.$data1['Theme']['dashboardmenuseparatorcolor'];
$progressbarcolor='#'.$data1['Theme']['progressbarcolor']; 
$saveapplybg='#'.$data1['Theme']['saveapplybg'];
$saveapplyhover='#'.$data1['Theme']['saveapplyhover'];
$saveapplyseparator='#'.$data1['Theme']['saveapplyseparator']; 
$saveapplytextcolor='#'.$data1['Theme']['saveapplytextcolor']; 
?>

<script type="text/javascript">

<?php if((isset($data1['Theme']['bodybgcolor']) && $data1['Theme']['bodybgcolor'] !='' ) || $data1['Theme']['backgroundimage'] !=''){ ?>
//	$('.header2').css('background','none');
//	$('html').css('background','none');
<?php } ?> 

$('body').css('color','<?php echo  $bodytextcolor; ?>');
$('body').css('font-family:','<?php echo '"'.$pagefont.'"'; ?>');
$('a').css('color','<?php echo  $bodytextcolor; ?>');
'<?php echo $linkcolor ?>'
$('html, body, table').css('color','<?php echo  $bodytextcolor; ?>');
$('.lftTxt_box').css('color','<?php echo  $bodytextcolor; ?>');

$('body').css('background-color','<?php echo $bodybgcolor;  ?>');
$('body').css('font-size',13);

<?php if(isset($data1['Theme']['backgroundimage']) && $data1['Theme']['backgroundimage'] !=''){ ?>


$('body').css('background-image', 'url(img/<?php echo $dataprojects['Project']['project_name'].'/uploads/siteBackground_images/'.$data1['Theme']['backgroundimage'] ?>)');
$('body').css('background-repeat','repeat');

<?php } ?>

$('.wrapper').css('width','<?php echo $pagewidth; ?>');
$('#container').css('width','<?php echo $pagewidth; ?>');
$('.header2').css('width','<?php echo $pagewidth; ?>');
$('.bodyCont').css('width','auto');
$('.leftPanel').removeClass('leftPanel');

<?php if($pagebgimage != '') { ?>
$('.wrapper').css('background-image', 'url(/img/<?php echo $dataprojects['Project']['project_name'].'/uploads/pageBackground_images/'.$data1['Theme']['pagebgimage'] ?>)');
<?php }else{ ?>
	$('.wrapper').css('background-color', '<?php echo $bodycolor ?>');
<?php } ?>

<?php if($ispageborder !='0'){ ?>  
	$('.wrapper').css('border-left','<?php echo $borderwidth; ?> solid <?php echo $bordercolor; ?>');
	$('.wrapper').css('border-right','<?php echo $borderwidth; ?> solid <?php echo $bordercolor; ?>');
<?php } ?>


<?php if($no_header_img ==1) { ?>
	$('.headerLogo').css('display','none');
<?php } ?>
$('.headerLogo').css('background-color','<?php echo $headercolor; ?>');

$('.conConts').css('background-color','<?php echo $bgaroundcoins; ?>');         //bgcolor for coins on home page

$('#container').css('background-color','<?php echo $backcolor; ?>');

$('.topNav').css('background-color','<?php echo $menubgcolor; ?>');
$('#menu ul').css('background-color','<?php echo $menubgcolor; ?>');
$('.topNav').css('font-family','<?php echo  '"'.$menufont.'"'; ?>');


$('.topNav').css('font-size','<?php echo  '"'.($fontsize+8).'px"'; ?>');
<?php if($boldtext=='1'){ ?>
	$('.topNav').css('font-weight','bold');
<?php } ?>
<?php if($italictext=='1'){ ?>
	$('.topNav').css('font-style','italic');
<?php } ?>



$('.topNav').css('height','<?php echo $menuheight; ?>');
$('#menu ul').css('top','<?php echo $menuheight; ?>');

$('.topNav li a').css('color','<?php echo  $menucolor; ?>');
$(".topNav li a").hover('color', '<?php echo $menuhover; ?>' );

$('.topNav ul li ul li.sub').css('background-color','<?php echo $menubgcolor; ?>');


<?php if(isset($data1['Theme']['bodycolor']) && $data1['Theme']['bodycolor'] !=''){ ?>
$('.rightbotimg').css('background','<?php echo $bodycolor; ?>');
$('.rhtBox').css('background','<?php echo $bodycolor; ?>');
$('#botprob').css('background','<?php echo $bodycolor; ?>');

$('.lftTxt_box').css('background','<?php echo $bodycolor; ?>');

<?php } ?>
<?php if( !empty($data1['Theme']['bodycolor']) && $data1['Theme']['bodycolor'] !='' ) { ?>
 $('.bodyCont').css('background','<?php echo $bodycolor; ?>');
<?php }?>

$('.lftTxt_box ').css('color','<?php echo $bodytextcolor; ?>');
$('.lftTxt_box a').css('color','<?php echo $linkcolor ?>');
$('.boxPad a').css('color','<?php echo $linkcolor ?>');
$('.topNav li a.rhtNav').css('color','<?php echo $menuspecial; ?>');
$('#copyrighttext').css('color','<?php echo $copyrighttextcolor; ?>');

////////////////////////dropdown options////////////////////////

$('.dropdown_class').css('background-color','<?php echo $copyrighttextcolor; ?>');
$('.dropdown_class').css('color','<?php echo $dropdowntextcolor; ?>');


////////////////////////dropdown options////////////////////////

//$('#menu ul li a').mouseover(function(){
	$('#menu ul li a').css('background-color','<?php echo $copyrighttextcolor; ?>');
//});

//$('#menu ul li a').mouseout(function(){
//	$('#menu ul li a').css('background-color','<?php echo  $backcolor; ?>');
//});

$('#headerseperator').css('background-color','<?php echo $headerseperator; ?>');
$('#footerseperator').css('background-color','<?php echo $footerseprator; ?>');
$('.footer').css('color','<?php echo $copyrighttextcolor ?>');
$('h1').css('color','<?php echo $headercolor1; ?>');
$('h2').css('color','<?php echo $headercolor2; ?>');
$('h3').css('color','<?php echo $headercolor3; ?>');
$('.topNav li a.active').css('color','<?php echo $menuactive; ?>');

//code is to stop ajax loading

jQuery('#loading_image').hide();
jQuery('#main-page-load').show();
// FOr Chat
$('.chatboxhead').css('background-color','<?php echo $backcolor; ?>');
$('.chatboxhead').css('border','1px solid <?php echo $backcolor; ?>');
$('.chatboxtextareaselected').css('border','2px solid <?php echo $backcolor; ?>');
//$('.chatboxcontent').css('border','1px solid <?php echo $backcolor; ?>');
$('.chatboxtitle').css('color','<?php echo $menucolor; ?>');
$('#join_chat').css('background-color','<?php echo $backcolor; ?>');
$('#join_chat').css('color','<?php echo $menucolor; ?>');
$('#leave_chat').css('background-color','<?php echo $backcolor; ?>');
$('#leave_chat').css('color','<?php echo $menucolor; ?>');
// document.getElementById('loading_image').style.display='none';
// document.getElementById('main-page-load').style.display='block';

$('form').css('background-color','<?php echo $formscolor; ?>');

$('.rhtFrmCont label').css('color','<?php echo $labeltextcolor; ?>');
$('.rhtFrmCont').css('color','<?php echo $systemtextcolor; ?>');
$('.lftReg_box').css('color','<?php echo $systemtextcolor; ?>');
$('.midORBox').css('color','<?php echo $systemtextcolor; ?>');
$('.frmLbls').css('color','<?php echo $labeltextcolor; ?>');

$('.rhtFrmCont a').css('color','<?php echo $systemlinkcolor; ?>');
$('.lftReg_box a').css('color','<?php echo $systemlinkcolor; ?>');


$('.boxPad label').css('color','<?php echo $dashboardlabelcolor;?>');

$('.orangeTextBold').css('color','<?php echo $dashboardspecialtextcolor;?>');
$('.grayText').css('color','<?php echo $dashboardspecialtextcolor;?>');
$('.remaining_text').css('color','<?php echo $dashboardlabelcolor;?>');


$('.boxPad a').css('color','<?php echo $dashboardlinkcolor;?>');


$('.update_profile_header').css('color','<?php echo $headercolor1;?>');     //update profile header color



$('.dash_menu li').css('background-color','<?php echo $dashboardmenubgcolor;?>');
$('#leftmenubar_bg').css('background-color','<?php echo $dashboardmenubgcolor;?>');


$(".dash_menu li a").hover(
  function () {
    
    $(this).css("background", "<?php echo $dashboardmenuhovercolor;?>");
  }, 
  function () {
    
      $(this).css("background", "<?php echo $dashboardmenubgcolor;?>");
  }
   
);

$(".dash_menu li a span").hover(
  function () {
    
    $(this).css("background", "<?php echo $dashboardmenuhovercolor;?>");
  }, 
  function () {
    
      $(this).css("background", "<?php echo $dashboardmenubgcolor;?>");
  }
);


$('.dash_menu li a.tabcheck').css('background-color','<?php echo $dashboardselectmenucolor;?>');
$('.dash_menu li span').css('color','<?php echo $dashboardmenutextcolor;?>');




$('.dash_menu li').css('border-right-color','<?php echo $dashboardmenuseparatorcolor;?>');

$('#progress-bar-percentage').css('background','<?php echo $progressbarcolor;?>');

$('.dash_menu_opp li').css('background','<?php echo $saveapplybg;?>');
$('.dash_menu_opp li span').css('background','<?php echo $saveapplybg;?>');
$('#save_apply_bg').css('background','<?php echo $saveapplybg;?>');

$('.dash_menu_opp li span').css('color','<?php echo $saveapplytextcolor;?>');

$('.dash_menu_opp li').css('border-right-color','<?php echo $saveapplyseparator;?>');

$(".dash_menu_opp li span").hover(
  function () {
    
    $(this).css("background", "<?php echo $saveapplyhover;?>");
  }, 
  function () {
    
      $(this).css("background", "<?php echo $saveapplybg;?>");
  }
   
);


//adjust table header background in points tab,view_registercoins,messages tab,etc to its menu color
$('.frmTitles').css('background','<?php echo $dashboardmenubgcolor;?>');        
$('.frmTitles').css('color','<?php echo $dashboardmenutextcolor;?>');
$('.forName').css('border-right-color','<?php echo $dashboardmenuseparatorcolor;?>');
//adjust table header background in points tab,view_registercoins,messages tab,etc to its menu color


//comments page settings
$('.postedby').css('color','<?php echo $dashboardlabelcolor;?>');
$('.st_sharethis').css('color','<?php echo $dashboardlabelcolor;?>');
$('.commtBox').css('color','<?php echo $systemtextcolor;?>');



//$bgcommentbtn 
</script>
