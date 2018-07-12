@charset "utf-8";



<?php
header("Content-type: text/css");
$white = '#fff';
$dkgray = '#333';
$dkgreen = '#008400';
?>

/* CSS Document */

*{
	margin:0;
	padding:0;
	border:0;
}

html, body{
	font-family:Arial, Helvetica, sans-serif, "Myriad Pro";
	font-size:12px;
	/*color:#333;*/color:#292828;
	font-weight:normal;
	   background: url("images/pageBg.jpg") repeat-x scroll left top #88B2DC;
	/*background:url(/img/testproject/bodyBg.jpg) repeat left top;*/
	/*background:url(images/pageBg.jpg) left top repeat-x #88b2dc;*/
}

ul, li {
	list-style:none;
}

a {
	text-decoration:none;
	color:#333;
}

a:hover {
	text-decoration:underline;
}


input, select, textarea{
	border:1px solid #b1b1b1;
}

input[type=radio], input[type=checkbox]{
	border:0;
}
.wrapper{
	width:982px;
	margin:0 auto;
}

.clear {
	clear:both;
	background:none;
}

.left {
	float:left;
}
.fright {
	float:right;
	width:0px;
}
.fleft {
	float:left;
	width:0px;
}

.right {
	float:right;
}

.middle {
	vertical-align:middle;
}

#container{
	width:959px;
	margin:0 auto;
	/*background: url("/img/testproject/contBg.png") repeat-y scroll left top transparent;*/
	background-color:#<?=$dkgreen?>;
	
}
.wrap2{
	width:960px;
	margin:0 auto;
	clear:both;
	/*background-color:#111c24;*/
	/*background:url(/img/testproject/footer.png) repeat-x left bottom;*/
}
.innWrap{
	width:939px;
	margin:0 auto;
	clear:both;
}
.navBg{
	background:url(/img/testproject/navBg.gif) repeat-x left center;
	float:left;
	height:41px;
	clear:both;
}

.header{
	height:141px;
	clear:both;
	background:url(images/headerBg.jpg) left top repeat-x;
}

.topNav{
	background-color: #111C24;
	height:34px;
	line-height:34px;
	clear:both;
	font-size:14px;
	color:#fefeff;
	padding:0 11px;
}

.topNav li{
	float:left;
	display:inline-block;
	padding:0 5px;
}

.topNav li a{
	color:#88b2dc;
	text-decoration:none;
}

.topNav li a:hover{
	text-decoration:underline;
}

.topNav li a.rhtNav{
	color:#88b2dc;
	text-decoration:none;
}
.topNav li a.active{
	color:white;
	text-decoration:none;
}

.topNav li a.rhtNav:hover{
	text-decoration:underline;
}

.bodyCont{
	width:938px; margin:0 auto; background-color:#fefeff;
}
.botCor{
	background:url(/img/testproject/footTxt.png) repeat-x left top; height:21px; clear:both;
}
.botCor p{
	text-align:center; font-size:11px; color:white; padding-top:4px;
}
.footer{
	height:31px; line-height:31px; background:url(images/footer.jpg) repeat-x left top; color:#fefeff; font-size:12px; text-align:center;
}

.lftTxt_box{
	padding:40px 30px; color:#111c24; line-height:24px; float:left; width:668px;
}

.lftTxt_box h1{
	font-size:28px; font-weight:normal; padding-bottom:8px;
}

.lftTxt_box h2{
	font-size:18px; font-weight:normal; padding-bottom:8px;
}

.lftTxt_box a{
	text-decoration:none;
	color:#111c24;
}

.lftTxt_box a:hover{
	text-decoration:underline;
}

.rhtBox{
	width:180px; padding-right:30px; float:left;
}

.regButton, .regButton:hover{
	background:url(/images/titlBg_rht.gif) right top no-repeat; display:inline-block; color:#fff; font-size:18px; text-decoration:none;
}

.regButton span{
	display:inline-block; cursor:pointer; padding:5px 61px;
}

.conConts{
	background:url(/images/boxBg.jpg) left top repeat-x #e8e8e8; border:solid 1px #d2d2d2; border-width:0 1px; padding:10px 0;
}
/**************************************************************************************************************************************************/
.navBg{
	background:url(/img/testproject/navBg.gif) repeat-x left center;
	float:left;
	height:41px;
	clear:both;
	margin:24px;
}


.navBg li{
	display:inline-block;
	float:left;
	font-size:13px;
	font-weight:bold;
	background:url(/img/testproject/divider.gif) right top no-repeat;
	text-transform:uppercase;
}

.navBg li a{
    margin-right:2px;
    text-decoration:none;
    display:inline-block;
}

.navBg li a span{
    padding:12px 20px 13px;
    display:inline-block;
}

.navBg li a:hover{   
    display:inline-block;
    color:white;
    background:url(/img/testproject/nav_over_Rht.gif) right top no-repeat;
    text-decoration:none;
    margin-right:2px;
}

.navBg li a:hover span{
    background:url(/img/testproject/nav_over_Lft.gif) left top no-repeat;
    display:inline-block;
    cursor:pointer;
    padding:12px 20px 13px;
}


.navBg li a.active{   
    display:inline-block;
    color:white;
    background:url(/img/testproject/nav_over_Rht.gif) right top no-repeat;
    text-decoration:none;
    margin-right:2px;
}

.navBg li a.active span{
    background:url(/img/testproject/nav_over_Lft.gif) left top no-repeat;
    display:inline-block;
    cursor:pointer;
    padding:12px 20px 13px;
}

.leftPanel{
	width:670px; margin-right:20px; float:left; clear:right; line-height:18px;
}

.rightPanel{
	width:195px; float:left; clear:right;
}

.boxTop{
	background:url(/img/testproject/lftBox_top.gif) left top no-repeat; height:15px;
}

.boxBot{
	background:url(/img/testproject/lftBox_bot.gif) left top no-repeat; height:15px;
}

/*.boxBor{
	border-left:1px solid #a8d7ea; border-right:1px solid #a8d7ea;
}*/

.boxTxt{
	font-size:13px; color:#0b83b3;
}

.boxPad{
	padding:0 16px;
}

.boxDiv{
	background:url(/img/testproject/divider2.png) center no-repeat; height:3px;
}

.boxBg{
	/*background:url(/img/testproject/boxBg.gif) left bottom repeat-x;*/
}

h1{
	font-family:calibri; font-size:14px; color:#0b83b3; background:url(/img/testproject/pointer.png) left 7px no-repeat; padding-left:28px; text-transform:uppercase;
}

.paddBot{
	padding-bottom:8px;
}

.inptBox{
	width:194px; border:1px solid #bedae5; 
}

h1.comm{
	text-transform:none; font-size:16px;
}

h2{
	font-family:calibri; font-size:22px; color:#0b83b3; background:url(/img/testproject/arrow.png) left top no-repeat; padding-left:28px; padding-bottom:7px; height:23px;
}
.spnDetails{

    margin-right: 20px;

    width: 300px;

    clear: right;

    float: left;

}
.SponsorlogoBox{
 	 clear:right; float:left; margin-right:20px; 
}
.coinBox{
	width:270px; clear:right; float:left; margin-right:20px;
}

.coinBoxCenter{
	margin: 0 auto;    	width: 270px;
}
.coinBoxTop{
	background:url(/img/testproject/coinBox_LftTop.gif) left top no-repeat; height:14px;
}

.coinBoxBot{
	background:url(/img/testproject/coinBox_LftBot.gif) left top no-repeat; height:14px;
}


.shortDescrp{
	width:420px; clear:right; float:left;
}


.footerLnks {
    clear: both;
    color: #FFFFFF;
    font-size: 11px;
    height: 22px;
    padding-top: 45px;
    text-align: center;
}

.topLnks{
	list-style:none;
	float:right;
	margin-top:36px;
	
	
}

.topLnks li{
	display:inline-block;
	float:left;
	margin-left:7px;
	height:36px;
	background:red;
	font-size:16px;
	
}

.topLnks li a, .topLnks li a:hover{
	display:inline-block;
	background:url(/img/testproject/topLiRht.jpg) right top no-repeat;
	color:white;
	text-decoration:none;
}

.topLnks li a span, .topLnks li a:hover span{
	display:inline-block;
	padding:9px 20px 0;
	background:url(/img/testproject/topLiLft.jpg) left top no-repeat;
	color:white;
	height:27px;
	text-decoration:none;
	cursor:pointer;
}

.paddLft{
	padding-left:47px
}
.lbl{
width:150px;
margin-right:5px;
display:inline-block;
/*margin-bottom:12px;*/
}

 #msg {
 	display:none;
	position:absolute;
	z-index:200;
	background:url(/img/testproject/msg_arrow.gif) left center no-repeat;
	padding-left:7px
	}
#msgcontent {
	display:block;
	background:#f3e6e6; 
	border:2px solid #924949; 
	border-left:none; padding:5px; 
	min-width:150px; 
	max-width:250px
	} 
.msgcontainer {
  border-style:solid;
  border-width:1px;
  padding:3px;
  min-width:445px;
  text-align:center;
}
.msgcontainer img{
  height:14px;
  margin-right:10px
}
.error {
  /*background-color:#FFEBE8;*/
  border-color:#DD3C10;

}
.success {
  /*background-color:#EEFFE0;*/
  border-color:#36BD4D;

}
.errormsg {
background:no-repeat scroll left center #FFEBE8;
border:1px solid #DD3C10;
font-family:Arial;
font-size:11px;
font-weight:bold;
margin:2px 2px 5px;
overflow:hidden;
padding:5px 2px 5px 20px;
text-align:left;
text-decoration:none;
width:180px;
}
.error-message{
display:none;	
	
}
.successmsg  {
background: no-repeat scroll left center #E8FCDF;
border:1px solid #4CA009;
float:left;
font-family:Arial;
font-size:11px;
font-weight:bold;
margin:2px 2px 5px;
overflow:hidden;
padding:5px 2px 5px 20px;
text-align:left;
text-decoration:none;
}
#flashMessage.success{
	border:1px solid green;
	padding:10px 5px 10px 5px;
	color:black;
	font-weight:normal;
	margin: 5px 0 5px 0 ;
}
#flashMessage.error{
	border:1px solid red;
	padding:10px 5px 10px 5px;
	color:black;
	font-weight:normal;
	margin: 5px 0 5px 0 ;
}
#flashMessage.warning{
	border:1px solid yellow;
	padding:10px 5px 10px 5px;
	color:black;
	font-weight:normal;
	margin: 5px 0 5px 0 ;
}


#setFlashMessage.success{
color:red;
font-weight:normal;
}

/* styles added on 17/02/2011 */

.bdyCont {
    clear: right;
    float: left;
    line-height: 18px;
    width: 670px;
}


.navigation{
    clear: right;
    float: left;
    width: 230px;
	margin-right:20px;
}


.navigation li{
	background: url(/img/testproject/Nav_divider.png) no-repeat scroll center bottom transparent;
    font-size: 13px;
    font-weight: bold;
    line-height: 30px;
    padding-left: 5px;
}

.navigation li a{
	color:#04709b;
	text-decoration:none;
}


.navigation li a.actNav{
	color:#303030;
	text-decoration:none;
}

/* ******* END ********** */
/* styles added on 21/02/2011 */

/*.forIds{
	 border-right:1px solid #bdbcbd; padding:3px 12px; vertical-align:top;
}*/

.forName{
	 border-right:1px solid #bdbcbd; padding:3px 12px; vertical-align:top; font-size:12px;
}


.forDate{
	 padding:3px 12px; vertical-align:top;font-size:12px;
}

.line{
	background:#bdbcbd; clear:both;
}

.frmTitles{
	font-size:12px; padding:3px 12px; font-weight:bold;  color:#056991; background:#a0d8ef;
}


.proDetail{
	width:330px;
	clear:right;
	float:left;
}

label.lblProDet{
	width:117px;
	clear:right;
	float:left;
}

span.spnProDet{
	width:213px;
	float:left;
	clear:right;
}

.btn {
   	background: none repeat scroll 0 0 #1282AF;
    border: 1px solid #656565;
    color: #FFFFFF;
    cursor: pointer;
    padding: 2px 9px;
}

.seltBox{
    border: 1px solid #BEDAE5;
    width: 196px;
	}
	
.boxMgr{
	margin-right:16px;
}

/*
.commTitle{
	font-size:13px; font-weight:bold; color:#056991; background:#a0d8ef; padding:3px 15px; border:1px solid #bdbcbd; border-bottom-width:0;
}

.commtBox{
	border:1px solid #bdbcbd; padding:5px 15px 10px;
}*/

/* ********** END *********** */
/* styles added on 01/03/2011 */

.commTitle{
	/*font-size:13px; font-weight:bold; color:#056991; background:#a0d8ef; padding:3px 15px; border:1px solid #bdbcbd; border-bottom-width:0;*/
	line-height: 24px;
    margin-bottom: 10px;
    padding: 3px 15px;
	color: #E57919;
    font-size: 13px;
	border-bottom: 1px dotted #BDBCBD;
}

.dateSpn{
	color: #0572BF;
    font-size: 12px;
}

.postedby{
	color:#303030;
font-size:9px;
font-style:italic;
font-weight:normal;
}

.commtBox{
	/*border:1px solid #bdbcbd; padding:5px 15px 10px;*/
	border-bottom: 1px dotted #AB7713;
    color: #666666;
    line-height: 18px;
    margin-bottom: 20px;
    padding: 5px 15px 20px;
}
.subcommtBox{
	/*border:1px solid #bdbcbd; padding:5px 15px 10px;*/
	border-bottom: 1px dotted #CCC;
    color: #666666;
    line-height: 18px;
    margin-bottom: 10px;
    margin-left: 40px;
    padding: 5px 15px 20px;
}

.srNo{
	color: #CC0000;
    font-weight: bold;
    padding-left: 15px;
}

/* ******** END *********** */
/* styles added on 03/03/2011 */
.compLogo {
    background:url(/img/testproject/companybg.png) no-repeat left top;
	width:160px;
	height:160px;
	float:left;
	margin-right:20px;
	padding-top: 1px;
	padding-left: 1px;
}
/* ******** END *********** */
.compLogo h4{
color: #FA1900;
    font-size: 14px;
    padding: 10px 0;
    text-align: center;
    text-transform: capitalize;
}

/* table select */
div.table .select {
	float:right;
	margin:2px 1px 0 0;
	width:176px;
	height:25px;
	background:#9097A9 url(/img/testproject/bg-select.gif);
	color:#fff;
	}
div.table .select strong {
	float:left;
	padding:5px 0 0 5px;
	}	
div.table .select select {
	float:right;
	width:78px;
	margin:2px 3px 0 0;
	text-align:right;	
	}
	
	
	.admgrid{
	clear:both;
	border-left:1px solid #e9e8e8;
	color: #222222;
    font-size: 12px;
	}
	
	
	
.admgrid td{
	border:none;
	padding:5px 10px;
	border:1px solid #e9e8e8;
	border-top:none;
	border-left:none;
	}
.admgrid td .bg2{
	background:url(/img/testproject/td_bg2.gif) repeat-x bottom;
	}
.admgrid td span{
	display:inline-block;
	}
.admgrid td a{
	text-decoration:none;
	}
.admgrid td.last{
	background:none;
	font-weight:bold;
	}
.admgrid th{
	border-top:none;
	border-left:none;
	border-right:1px solid #e9e8e8;
	border-bottom:1px solid #e9e8e8;
	border-top:1px solid #e9e8e8;
	height:30px;
	padding:0 5px;
	font-size:12px;
	font-weight:bold;
	color:#056991;
	/*background:url(/img/testproject/th_bg.jpg) repeat-x bottom left;*/
	background-color:#a0d8ef;
	vertical-align:middle;
	
	}
.admgrid th a{
	color:#565656;
	vertical-align:middle;
	}
.admgrid th a img{
	vertical-align:middle;
	}
.admgrid th a:hover{
	color:#268bc1;
	}


/* ******** styles added on 08/03/2011 ******** */
.header2 {
    background: url("/img/testproject/headerNew.png") no-repeat scroll -11px bottom transparent;
    clear: both;
    height: auto !important;
    margin: 0 auto;
    /*min-height: 107px;*/
    padding: 0px 0px 0px 0px;
     width: 960px;
}
/*.header2{
	background: url("/img/testproject/headerNew.png") no-repeat scroll left bottom transparent;
	clear: both;
	height: 100px;
	margin: 0 auto;
	padding: 20px 20px 0;
	width: 980px;
}*/


/*.navTop {
float: right;
    list-style: none outside none;
    margin-left: 833px;
    margin-top: -36px;
    position: absolute;
    z-index: 101;
	/*list-style: none outside none;
    margin-left: 783px;
    margin-top: 56px;
    position: absolute;
    z-index: 101;*/
/*}*/
.navTop {
    float: right;
    list-style: none outside none;
    margin-top: -27px;
    padding-right: 10px;
    position: absolute;
    text-align: right;
    width: 957px;
    z-index: 101;
}
.navTop li {
    display: inline-block;
    font-size: 16px;
    height: 36px;
    margin-right: 3px;
}

/*.navTop li{
	display:inline-block;
	float:left;
	margin-left:7px;
	height:36px;
	font-size:16px;
	
}*/

.navTop li a, .navTop li a:hover{


	display:inline-block;
	background:url(/img/testproject/topNavBg.gif) right top repeat-x;
	color:#88b2dc;
	text-decoration:none;
}

.navTop li a span, .navTop li a:hover span{



	display:inline-block;
	padding:3px 10px;
	/*background:url(images/topLiLft.jpg) left top no-repeat;*/
	color:white;
	height:21px;
	text-decoration:none;
	cursor:pointer;
}
.headerLogo {
   /* height: 92px;
    width: 980px;
*/
}
/*.headerLogo{
	height:92px; width:980px;
}*/

/* ****** END ******* */

.otherh1 h1{
padding:5px 0;
background:none;
}
.rightbotimg{
background: none repeat scroll 0% 0% rgb(255, 255, 255); text-align: center; padding: 10px 0;
}
.rightbotimg li{
float: left; padding:10px;
}
.lftMgrn{
    margin-left:22px;
}
 .contactInput {
border:1px solid #7F9DB9;
color:#5A5A5A;
font-size:11px;
margin:1px 0;
padding:2px;
width:150px;
}


select{
 border:1px solid #bedae5;
}
.boldlabel{
	font-weight: bold;
	color:#4F4F4F;
}	
select optgroup{
			font-style: normal;
			padding-bottom:6px;
			font-size: 11px;
		}
select option{
			font-size: 11px;
}
.otherjquery .ui-tabs .ui-tabs-panel {
padding:0;
}

.ui-tabs-panel {padding:6px !important;}

.calendarcls{
    background:url('/img/testproject/calendar_new.png') left top no-repeat; 
	height:22px; 
	width:22px; 
	cursor:pointer;
}
.dashboard{
width:auto !important;
width:80px;
min-width:80px;

}
h3{
padding:10px 0 0; color:#ff6d15; font-size:15px;
}

.noPadd{
	padding:0;
}

.editorTxt{
	height:auto !important;
	min-height:200px;
}

.editorTxt p, .editorTxt ul, .editorTxt ol, .editorTxt li{
	margin:0 !important;
	padding: !important;
}
span.red {color:red;font-weight:bold}

/********* styles added for drop down menu *************/

#menu{
	list-style-type:none;
}
#menu li{
	float:left;
		position:relative;
}

#menu ul {position:absolute; top:42px; left:0; background:#fcd979; display:none; opacity:0; list-style:none; background-image:none; }
#menu ul li {position:relative; margin:0; padding:0; width:150px; font-size:12px; font-weight:normal; display:inline-block; background:none;}
#menu ul li a {display:block; padding:5px 10px; color:#000000; font-weight:bold; margin:0;}
#menu ul li a:hover {text-decoration:none; background:url(/img/testproject/nav_over_Rht.gif) right center no-repeat; color:#ffffff; font-weight:bold;}
#menu ul ul {left:151px; top:0px;}

ul.menu ul ul {left:151px; top:0px}

#menu ul li{
	display:inline-block;
	float:left;
}

ul.menu li a{
	color:#000000;
	text-decoration:none;
	display:inline-block;
}

ul.menu li a span{
	padding:12px 20px 13px;
	display:inline-block;
	cursor:pointer;
}

ul.menu li a:hover{
	background:url(/img/testproject/nav_over_Rht.gif) right 0 no-repeat;
	text-decoration:none;
	color:#ffffff;
}

ul.menu li a:hover span{
	display:inline-block;
	padding:12px 20px 13px;
	background:url(/img/testproject/nav_over_Lft.gif) left 0 no-repeat;
	cursor:pointer;
}

ul.menu li a.active{	
	display:inline-block;
	color:white;
	background:url(/img/testproject/nav_over_Rht.gif) right top no-repeat;
	text-decoration:none;
	margin-right:2px;
}

ul.menu li a.active span{
	background:url(/img/testproject/nav_over_Lft.gif) left top no-repeat;
	display:inline-block;
	cursor:pointer;
	padding:12px 20px 13px;
}

ul.menu .sub {background:url(/img/testproject/arrow.gif) 136px 8px no-repeat}

/* ********* END ************* */