<?php


/* Example of Basic HTML Tags */

define('_MPDF_PATH','../');
include("../mpdf.php");
//
$timeo_start = microtime(true);
//


$html = '
<html><head>
<style>
table {
	font-family: sans-serif;
	border: 7mm solid aqua;
	border-collapse: collapse;
}
table.table2 {
	border: 2mm solid aqua;
	border-collapse: collapse;
}
table.layout {
	border: 0mm solid black;
	border-collapse: collapse;
}
td.layout {
	text-align: center;
	border: 0mm solid black;
}
td {
	padding: 3mm;
	border: 2mm solid blue;
	vertical-align: middle;
}
td.redcell {
	border: 3mm solid red;
}
td.redcell2 {
	border: 2mm solid red;
}





body{
  background:#ececec url(templates/yoursportstrainer/images/hedrbg.gif) repeat-x top;
  font-family:Arial, Helvetica, sans-serif;
  font-size:12px;
  margin:0;
  padding:0;
  line-height:normal;
  color:#000000;
  }

ul, li, p, h1, h2, h3, h4, h5, input, select{
  padding:0;
  margin:0;
  }
img{
  border:none;
  }
a{
  text-decoration:none;
  color:#14a5ef;
  border:none;
  outline:none;
  }

a:hover{
  text-decoration:underline;
  }
.clear{
  clear:both;
  }
.left{
  float:left;
  }
.right{
  float:right;
  }

#wrapper{
  width:949px;
  height:auto;
  background:none;
  margin:0 auto;
  padding:0;
  }

#header{
  width:949px;
  height:125px;
  }
#header a{
  color:#7d7d7d;
  font-size:10px;
  }
.logo{
  width:324px;
  height:62px;
  padding:0;
  margin-top:22px;
  }


  
.search{
  float:right;
  margin:73px 0 0 0;
  
  height:22px;
  }
.searchbg{
  background:url(templates/yoursportstrainer/images/serch_inpt_bg.gif) no-repeat top left;
  width:303px;
  height:18px;
  border:none;
  padding:2px;
  float:left;
  }
.searchbg img{
  margin:-2px 0 0 0;}
.search input{
  width:246px;
  height:18px;
  border:none;
  background:none;
  }
.search img{
  vertical-align:top;
  }
.banner{
  clear:both;
  background:url(templates/yoursportstrainer/images/banner.jpg) no-repeat top;
  width:949px;
  height:418px;
  }
*html .banner{
  clear:both;
  margin-top:-3px;
  background:url(templates/yoursportstrainer/images/banner.jpg) no-repeat top;
  width:949px;
  height:418px;
  }
.banner a{
  color:#fff;
  }
.banner p{
  padding:395px 0 0 15px;
  color:#fff;
  }

#content{
  width:949px;
  padding:0;
  clear:both;
  height:auto;
  padding:10px 0 0 0;
  }
.leftpanel{
  background: url(templates/yoursportstrainer/images/roundtop_white.gif) no-repeat top;
  float:left;
  width:637px;
  height:auto;
  font-size:12px;
  line-height:150%;
  padding:0;
  margin:0;
  min-height:187px;
  }
.leftpanel p{
  padding:15px;
  }
.leftpanel img{
  vertical-align:middle;
  }
  
.loginbox{
  background:url(templates/yoursportstrainer/images/login_top.gif) no-repeat top;
  width:301px;
  height:auto;
  float:right;
  }
.blu_bg{
  background:url(templates/yoursportstrainer/images/loginblu_bg.gif) no-repeat top;
  width:271px;
  height:157px;
  margin:10px auto;
  padding:5px;
  font-weight:bold;
  color:#fff;
  }
.blu_bg span{ 
  font-size:18px;
  font-weight:bold;
  color:#ffffff;
  padding:0 20px;
  }
.inpt{
  width:182px;
  height:19px;
  margin:10px 0 0 5px;
  padding:3px;
  }
.blu_bg label{
  width:70px;
  display:block;
  float:left;
  text-align:right;
  margin:15px 0 0 0;
  }
.blu_bg p{
  padding:5px;
  }
@-moz-document url-prefix(){
  .blu_bg p{
  padding:7px 5px 0 8px;
  }
  }
  
.footer{
  clear:both;
  background: url(templates/yoursportstrainer/images/footerbg.gif) no-repeat top;
  height:51px;
  color:#CCC;
  }
  
.footer a{
  color:#7d7d7d;
  }
.botmlnks{
  padding:15px 0 0 15px;
  }
.copyrite{
  float:right;
  padding:15px 15px 0 0;
  }
  

/*new class for navigation dropdown starts here*/
#navbar{
  margin:0;
  padding:0;
  list-style:none;
  font-weight:bold;
  background:none;
  width:100%;
  }

#navbar li{
  list-style:none;
  float:left;
  text-align:center;
  margin:0;
  height:26px;
  }

#navbar li a{
  background:none;
  text-align:center;
  font-size:14px;
  color:#ffffff;
  width:auto;
  padding:5px 10px 0 10px;
  }

#navbar li a span{
  color:#F00;
  font-style:italic;
  font-size:16px;
  }

#navbar a:hover, #navbar a:active, #navbar a.active{
  border:1px solid red;
  text-decoration:none;
  color:#CCC;
  }
  
  
  
  
#navbar ul {
  padding:0;
  margin:-10px 0 0 0;
  background:#759b98;
  width:auto;
  position:absolute;
  top:130px;
  
  visibility:hidden;
  border:1px dashed #333;
  z-index:999;
  } 
#navbar ul li {
  clear:both; 
  background:none;
  margin:0;
  padding:0;
  color:#fff;
  width:100%; 
  }
#navbar ul li a{
  /*height:20px;*/
  color:#000000;
  margin:0;
  padding:3px 20px 5px 20px;
  /*width:100px;*/
  width : auto;
  border-bottom:1px dashed #666;
  }
#navbar ul li a:hover{
  color:#ffffff;
  text-decoration:none;
  background:#445a59;
  }
#navbar li:hover ul,
#navbar li a:hover ul{
  visibility:visible;
  }

  
#navbar a, #navbar a:visited{
  display:block;
  } 
/*new class for navigation dropdown ends here*/







/*new classes for login page stats here*/
  
  
.logo2{
  width:324px;
  height:62px;
  padding:0;
  padding-top:37px;
  }
.banner_login{
  clear:both;
  background:url(templates/yoursportstrainer/images/login_banner.jpg) no-repeat top;
  width:949px;
  height:173px;
  }

/*.banner_login ul{
  padding:142px 0 0 5px;
  color:#fff;
  margin:0;
  }
.banner_login ul li{
  float:left;
  list-style:none;
  margin:0 0 -5px 0;
  }
.banner_login ul li a{
  background:url(templates/yoursportstrainer/images/li_active.gif) no-repeat top;
  width:92px;
  height:15px;
  display:block;
  padding:8px 0;
  margin:0 3px 0 0;
  text-align:center;
  color:#ffffff;
  font-weight:bold;
  font-size:14px;
  }
.banner_login ul li a:hover, .banner_login ul li a.active, .banner_login ul li a:active{
  background:url(templates/yoursportstrainer/images/li_bg.gif) no-repeat top;
  color:#002e3d;
  text-decoration:none;
  }*/
  
#content2{
  width:949px;
  padding:0;
  clear:both;
  height:auto;
  padding:0;
  }
.leftpanel2{
  background: url(templates/yoursportstrainer/images/roundtop_white.gif) no-repeat top;
  float:left;
  width:637px;
  height:auto;
  font-size:12px;
  line-height:150%;
  padding:0;
  margin:0;
  } 
.leftpanel2 p{
  padding:10px;
  }
.leftpanel2 img{
  vertical-align:middle;
  }
.loginbox{
  background:url(templates/yoursportstrainer/images/login_top.gif) no-repeat top;
  width:301px;
  height:auto;
  float:right;
  /*margin:-4px 0 0 0;*/
  }
.logn_acc{
  border:1px solid #7d7d7d;
  margin:20px auto 0 auto;
  padding:0;
  }
.logn_acc td{
  padding:5px 5px 5px 10px;
  }
h2{
  font-size:18px;
  font-weight:bold;
  color:#00a651;
  }
.inpt2{
  width:194px;
  height:18px;
  margin:10px 0 0 5px;
  padding:3px;
  border:1px solid #000000;
  }
.lbl{
  width:125px;
  display:block;
  float:left;
  text-align:right;
  font-size:14px;
  margin:10px 0 0 0;
  }
  
.subscrb{
  background:#f3f3f3;
  width:145px;
  height:35px;
  text-align:center;
  margin:20px auto;
  padding:15px 0;
  }
  
  
.footer2{
  clear:both;
  height:51px;
  color:#7d7d7d;
  }
  
.footer2 a{
  color:#7d7d7d;
  }
  
  
/*new classes for login page ends here*/  



h4{
  font-size:12px;
  font-weight:bold;
  color:#00a651;
  }
h3{
  font-size:18px;
  font-weight:bold;
  color:#000000;
  margin:25px 5px 5px 5px;
  }
.logn_acc2{
  border:1px solid #7d7d7d;
  margin:5px auto 0 auto;
  padding:0;
  }
.logn_acc2 td{
  padding:5px 5px 5px 10px;
  font-size:12px;
  }
.actvte_acc{
  width:160px;
  height:35px;
  text-align:center;
  margin:20px auto;
  padding:15px 0;
  }
.lbl2{
  width:170px;
  display:block;
  float:left;
  text-align:left;
  font-size:12px;
  font-weight:bold;
  margin:10px 0 0 0;
  }

.slct{
  margin:10px 0 10px 5px;
  border:1px solid #cfcfcf;
  }
.inpt3{
  width:250px;
  height:18px;
  margin:10px 0 10px 5px;
  padding:3px;
  border:1px solid #cfcfcf;
  background:#eeeeee;
  }
.inpt5{
  width:115px;
  height:18px;
  margin:10px 0 10px 5px;
  padding:3px;
  border:1px solid #cfcfcf;
  background:#eeeeee;
  color:#cccccc;
  }
.inpt4{
  width:135px;
  height:18px;
  margin:10px 0 10px 5px;
  padding:3px;
  border:1px solid #cfcfcf;
  background:none;
  }
.slct2{
  width:220px;
  margin:10px 0 10px 5px;
  border:1px solid #cfcfcf;
  }
  
  
.lblgrey{
  width:140px;
  display:block;
  float:left;
  text-align:left;
  font-size:14px;
  margin:0 0 0 20px;
  color:#7d7d7d;
font-weight:normal;
  }

.llblblack{
  width:140px;
  display:block;
  float:left;
  text-align:left;
  font-size:14px;
  margin:0 0 0 20px;
  color:#000;
font-weight:normal;
  }

.lblblack{
  width:100px;
  text-align:left;
  font-size:14px;
  margin:0 0 0 0;
font-weight:normal;
  }
.biling_info{
  float:right;
  width:250px;
  line-height:120%;
  }
.biling_infosmall{
  font-size:11px;
  color:#000;
  }
  
  
  
.logn_acc4{
  border:1px solid #c2c2c2;
  margin:15px auto 0 auto;
  padding:5px 0 5px 10px;
  width:610px;
  }
h6{
  font-size:14px;
  font-weight:bold;
  color:#00a651;
  border-bottom:1px solid #c2c2c2;
  margin:0 0 0 0;
  }
h5{
  font-size:18px;
  font-weight:bold;
  color:#00a651;
  border-bottom:1px solid #c2c2c2;
  margin:0 0 0 0;
  }
  
  


/*new classes added on 1/07/09 starts here*/

.inptbig{
  width:250px;
  height:50px;
  margin:10px 0 10px 5px;
  padding:3px;
  border:1px solid #cfcfcf;
  background:#eeeeee;
  }
.banner_sports{
  clear:both;
  background:url(templates/yoursportstrainer/images/login_banner.jpg) no-repeat top;
  width:949px;
  height:173px;
  color:#fff;
  }
/*.banner_login ul{
  padding:142px 0 0 5px;
  color:#fff;
  margin:0;
  }
.banner_login ul li{
  float:left;
  list-style:none;
  margin:0 0 -5px 0;
  }
.banner_login ul li a{
  background:url(templates/yoursportstrainer/images/li_active.gif) no-repeat top;
  width:92px;
  height:15px;
  display:block;
  padding:8px 0;
  margin:0 3px 0 0;
  text-align:center;
  color:#ffffff;
  font-weight:bold;
  font-size:14px;
  }
.banner_login ul li a:hover, .banner_login ul li a.active, .banner_login ul li a:active{
  background:url(templates/yoursportstrainer/images/li_bg.gif) no-repeat top;
  color:#002e3d;
  text-decoration:none;
  }*/

/*new classes added on 1/07/09 ends here*/

  
/*new classes added on 2/07/09 starts here*/  
#menubar{
  
  color:#fff;

position:absolute;
margin-top:-31px;

  }

#menubar li{
  float:left;
  list-style:none;
  margin:0 3px -5px 0;
  
  }
#menubar li a{
  background:url(templates/yoursportstrainer/images/lnkbg_right_corner.gif) no-repeat right;
  color:#ffffff;
  font-weight:bold;
  font-size:14px;
  padding:0 0 0 0;
  text-decoration:none;
  display:inline-block;
  height:31px;

  width:auto;
  }
#menubar li a span{
  background:url(templates/yoursportstrainer/images/lnkbg_left_corner.gif) no-repeat left top;
  padding:5px 20px 0 20px;
  width:auto;
  height:26px;
  display:inline-block;
  cursor:pointer;
  }
#menubar li a span:hover, #menubar li a span:active, #menubar li a span.active{
  background:url(templates/yoursportstrainer/images/lnk_hoverbg_left_corner.gif) no-repeat left top;
  color:#002e3d;
  }
    
#menubar li a:hover, #menubar li a:active, #menubar li a.active{
  background:url(templates/yoursportstrainer/images/lnk_hoverbg_right_corner.gif) no-repeat right top;
  color:#002e3d;
  }


#menubar li.selected a{
  background:url(templates/yoursportstrainer/images/lnk_hoverbg_right_corner.gif) no-repeat right;
  color:#0f4070;
  padding:0 0 0 0;
  text-decoration:none;
  display:inline-block;
  height:31px;
  }
  
#menubar li.selected a span{
  background:url(templates/yoursportstrainer/images/lnk_hoverbg_left_corner.gif) no-repeat left top;
  padding:5px 20px 0 20px;
  width:auto;
  height:25px;
  display:inline-block;
  cursor:pointer;
  } 
/*new classes added on 2/07/09 ends here*/



/*new classes added on 3/07/09 starts here*/  

.banner_football{
  clear:both;
  background:url(templates/yoursportstrainer/images/football_banner.jpg) no-repeat top;
  width:949px;
  height:173px;
  color:#fff;
  }
  
h1{
  font-size:24px;
  font-weight:bold;
  color:#000000;
  padding:0;
  margin:20px 0;
  }
.middle{
  vertical-align:middle;
  }

.icon_div{
  color:#999999;
  font-size:11px;
  margin:5px 10px;
  }
.icon_div a{
  color:#999999;
  text-decoration:none;
  }
.icon_div a:hover{
  color:#999999;
  text-decoration:underline;
  }
.icon_div img{
  vertical-align:middle;
  margin:0 0 0 10px;
  }
.ppading{
  padding:10px;
  line-height:130%;
  font-size:12px;
  } 
.ppading a{
  color:#000;
  }
.ppading a:hover, .ppading a.active, .ppading a:active {
  color:#00a651;
  text-decoration:underline;
  }



.divider{
  background:#e6e6e6;
  height:6px;
  clear:both;
  }

.myprofile_banner{
  clear:both;
  background:url(templates/yoursportstrainer/images/myprofile_banner.jpg) no-repeat top;
  width:949px;
  height:173px;
  color:#fff;
  }
  
.leftpanel3{
  background: url(templates/yoursportstrainer/images/roundtop_white_big.gif) no-repeat top;
  float:left;
  width:949px;
  height:auto;
  font-size:14px;
  line-height:150%;
  padding:0;
  margin:0;
  } 
.leftpanel3 p{
  padding:10px;
  }
.leftpanel3 img{
  vertical-align:middle;
  }
  
.welcomeback{
  width:389px;
  min-height:250px;
  float:left;
  padding:10px;
  }
.lblbold{
  width:75px;
  float:left;
  display:block;
  margin:0 0 0 10px;
  font-size:12px;
  color:#292623;
  text-align:left;
  font-weight:bold;
  height:15px;
  }
.lbl3{
  width:140px;
  float:left;
  display:block;
  margin:0 0 0 5px;
  font-size:12px;
  color:#292623;
  text-align:left ;
  
  }
.mymsg{
  width:520px;
  border-left:1px solid #cecece;
  border-bottom:1px solid #cecece;
  float:left;
  margin:15px 0;
  } 
.mymsg td{
  border-right:1px solid #cecece;
  border-top:1px solid #cecece;
  padding:5px;
  font-size:12px; 
  }
.mymsg th{
  border-right:1px solid #cecece;
  border-top:1px solid #cecece;
  padding:5px;
  } 
.mymsg span{
  color:grey;
  }
  
  
.logn_accflex{
  border:1px solid #c2c2c2;
  margin:15px 5px;
  padding:5px 0 5px 10px;
  float:left;
  width:300px;
  } 
.measurments{
  border-left:1px solid #cecece;
  border-bottom:1px solid #cecece;
  margin:15px auto;
  }
.measurments td{
  border-right:1px solid #cecece;
  border-top:1px solid #cecece;
  padding:2px;
  }
.measurments span{
  color:#F00;
  }
  
  
/*new classes added on 3/07/09 ends here*/  
  



/*new classes added on 06/07/09 starts here*/
  
.lbl2_full{
  width:100%;
  display:block;
  float:left;
  text-align:left;
  font-size:14px;
  font-weight:bold;
  margin:10px 0 0 0;
  border-bottom:1px solid #c2c2c2;
  }
.logn_accflex p{
  font-size:11px;
  width:280px;
  margin:0 0 10px 20px;
  padding:0;
  }
.redtxt{
  color:#F00;
  float:none;
  }
.links{
  width:85px;
  float:right;
  font-size:11px;
  display:block;
  color:#14A5EF;
  text-align:right;
  margin-right:10px;
  }
.links2{
  width:265px;
  font-size:12px;
  font-style:italic;
  color:#14A5EF;
  display:block;
  }

.logn_accflex strong{
  clear:both;
  margin:0 0 0 10px;
  }
.editlnk{
  font-size:12px;
  font-weight:bold;
  float:right;
  margin-right:25px;
  }
  
.table_goals{
  font-size:12px;
  }
.greentxt{
  color:#00a651;
  }
.plcholder{
  width:137px;
  height:180px;
  text-align:center;
  font-weight:bold;
  float:left;
  margin:0 5px 0 5px;
  }

.plcholder img{
  vertical-align:top;
  }
.calender{
  background:url(templates/yoursportstrainer/images/calender.gif) no-repeat top;
  width:278px;
  height:215px;
  float:left;
  margin:15px 0 0 10px;
  }
.yrstxt{
  font-size:36px;
  text-align:center;
  margin:0;
  padding:15px 0 0 0;
  width:auto;
  }
.date{
  font-size:120px;
  text-align:center;
  margin:-20px auto 0 auto;
  padding:0;
  width:215px;
  line-height:50%;
  }
@-moz-document url-prefix(){
.date{
  font-size:120px;
  text-align:center;
  margin:5px auto 0 auto;
  padding:0;
  height:118px;
  width:215px;
  line-height:60%;
  }
  }

.workout{
  font-weight:bold;
  font-size:12px;
  width:210px;
  margin:-25px auto 0 auto;
  text-align:center;
  }
.workout a{
  color:#F00;
  float:right;
  }
  
.lftarow{
  float:left;
  display:inline-block;
  vertical-align:top;
  margin:0;
  padding:0;
  }
.ritearow{
  display:inline-block;
  float:right;
  vertical-align:top;
  margin:0;
  padding:0;
  } 
  
.mymsg span a{
  color:#F00;
  }
/*new classes added on 06/07/09 ends here*/ 
  
  
  
/*new classes added on 07/07/09 starts here*/ 


  
.logn_accflex2{
  border:1px solid #c2c2c2;
  margin:15px 3px 15px 0;
  padding:5px 0 5px 5px;
  float:left;
  width:308px;
  font-size:11px;
  } 


.logn_accflex2 strong{
  margin:0;
  padding:0;
  font-size:12px;
  }

.logn_accflex2 p{
  font-size:11px;
  margin:0 5px 0 0;
  padding:0;
  }



.links3{
  width:50px;
  float:right;
  font-size:11px;
  display:block;
  text-align:right;
  margin-right:10px;
  }




.links3 a{
  font-size:11px;
  color:#14A5EF;
  }

.redbig{
  color:#ff3600;
  font-size:18px;
  margin:20px 0;
  }

.zipinput{
  width:50px;
  height:14px;
  font-size:10px;
  border:1px solid #818181;
  padding:2px;
  }
.blu_bg2{
  background:url(templates/yoursportstrainer/images/loginblu_bg2.gif) no-repeat top;
  width:271px;
  height:183px;
  margin:10px auto;
  padding:5px;
  font-weight:bold;
  color:#fff;
  }
.blu_bg2 span{  
  font-size:18px;
  font-weight:bold;
  color:#ffffff;
  padding:0 20px;
  }
.blu_bg2 label{
  width:70px;
  display:block;
  float:left;
  text-align:right;
  margin:15px 0 0 0;
  }
.blu_bg2 p{
  padding:5px;
  }

.blu_bg2 a{
  font-size:11px;
  color:#fff;
  font-weight:normal;
  }
.banner_baseball{
  clear:both;
  background:url(templates/yoursportstrainer/images/baseball_banner.jpg) no-repeat top;
  width:949px;
  height:173px;
  color:#fff;
  }
.green_patch{
  background:url(templates/yoursportstrainer/images/green_patch.gif) no-repeat top;
  width:137px;
  height:57px;
  padding:10px;
  }
.green_patch label{
  width:45px;
  display:block;
  float:left;
  text-align:right;
  margin:0 5px 0 0;
  }
.loginbox2{
  background:url(templates/yoursportstrainer/images/login_top.gif) no-repeat top;
  width:301px;
  height:auto;
  float:right;
  margin:1px 0 0 0;
  }
.stepcontner{
  border-bottom:1px solid #cecece; 
  margin:0 10px 5px 0;
  padding:15px 10px;
  }
  
.blu_bg3{
  background:url(templates/yoursportstrainer/images/loginblu_bg2.gif) no-repeat top;
  width:271px;
  height:183px;
  margin:10px auto;
  padding:3px 5px 5px 5px;
  font-weight:bold;
  color:#fff;
  }
.blu_bg3 span{  
  font-size:18px;
  font-weight:bold;
  color:#F00;
  padding:0 20px 0 0;
  }
.blu_bg3 label{
  width:70px;
  display:block;
  float:left;
  text-align:right;
  margin:15px 0 0 0;
  }
.blu_bg3 p{
  padding:5px;
  }

.blu_bg3 a{
  color:#000000;
  font-size:18px;
  font-weight:normal;
  }
.blu_bg3 a:hover{
  text-decoration:none;
  }
.white{
  background:#fff;
  color:#000;
  font-size:12px;
  padding:10px;
  width:250px;
  }
.white span{
  color:#00a651;
  margin:0;
  padding:0;
  font-size:12px;
  }
.round_green{
  background:url(templates/yoursportstrainer/images/12.gif) no-repeat top;
  width:104px;
  height:106px;
  float:right;
  text-align:center;
  }
/*new classes added on 07/07/09 ends here*/ 




/*new classes added on 13/07/09 starts here*/ 

.green_patch2{
  background:url(/templates/yoursportstrainer/images/green_patch2.gif) no-repeat top;
  width:139px;
  height:71px;
  padding:10px;
  }
.green_patch2 label{
  width:55px;
  display:block;
  float:left;
  text-align:left;
  margin:0 3px 0 0;
  font-weight:bold;
  }
.phase1{
  background:url(templates/yoursportstrainer/images/phase1.gif) no-repeat top;
  margin:15px auto 0 auto;
  padding:5px 0 5px 10px;
  width:610px;
  }
.phasecontner{
  margin:3px 10px 5px 70px;
  padding:15px 10px;
  }
.grd{
  margin:0;
  font-size:12px;
  line-height:120%;
  margin:0 0 5px 0;
  }
.grd td{
  padding:0;
  }
.phase2{
  background:url(templates/yoursportstrainer/images/phase2.gif) no-repeat top;
  margin:15px auto 0 auto;
  padding:5px 0 5px 10px;
  width:610px;
  }
.phasecontner span{ 
  font-size:12px; 
  color:#14A5EF;
  }

.week1{
  background:url(templates/yoursportstrainer/images/week1.gif) no-repeat top;
  margin:15px auto 0 auto;
  padding:5px 0 5px 76px;
  width:544px;
  }
.week2{
  background:url(templates/yoursportstrainer/images/week2.gif) no-repeat top;
  margin:15px auto 0 auto;
  padding:5px 0 5px 76px;
  width:544px;
  }
.weekcontner{
  margin:3px 0 0 0;
  padding:5px 10px 0 10px;
  width:230px;
  float:left;
  background:none;
  line-height:120%;
  font-size:13px;
  font-weight:bold;
  }
@-moz-document url-prefix(){
  .weekcontner{
  margin:1px 0 0 0;
  padding:5px 10px 0 10px;
  width:230px;
  float:left;
  background:none;
  line-height:120%;
  font-size:13px;
  font-weight:bold;
  } 
  }
*html .weekcontner{
  margin:3px 0 0 0;
  padding:5px 10px 0 10px;
  width:230px;
  float:left;
  background:none;
  line-height:120%;
  font-size:13px;
  font-weight:bold;
  }
.weekcontner label{
  width:70px;
  display:block;
  float:left;
  text-align:left;
  margin:0 3px 0 0;
  line-height:100%;
  
  }
.weekcontner span{
  color:#00A651;
  }
.weekcontner span a{
  color:#FF0000;
  text-align:right;
  display:block;
  }
  
.weekcontner2{
  margin:3px 0 0 36px;
  padding:5px 10px 0 10px;
  width:230px;
  float:left;
  background:none;
  line-height:120%;
  font-size:13px;
  font-weight:bold;
  }
  
@-moz-document url-prefix(){
  .weekcontner2{
  margin:1px 0 0 36px;
  padding:5px 10px 0 10px;
  width:230px;
  float:left;
  background:none;
  line-height:120%;
  font-size:13px;
  font-weight:bold;
  }
  }
  
  
*html .weekcontner2{
  margin:3px 0 0 36px;
  padding:5px 10px 0 10px;
  width:230px;
  float:left;
  background:none;
  line-height:120%;
  font-size:13px;
  font-weight:bold;
  }
.weekcontner2 label{
  width:70px;
  display:block;
  float:left;
  text-align:left;
  margin:0 3px 0 0;
  line-height:100%;
  
  }
.weekcontner2 span{
  color:#00A651;
  } 
.weekcontner2 span a{
  color:#FF0000;
  text-align:right;
  display:block;
  }

/*new classes added on 13/07/09 ends here*/ 

.cb_field{

width:400px;
float:right;


}

.inptbx {
border:1px solid #cfcfcf;
background:#eeeeee;
}

.inputbox{
  width:250px;
  
  margin:10px 0 10px 5px;
  padding:3px;
  border:1px solid #cfcfcf;
  background:#eeeeee;}

.paginbox{
 
 margin:10px 0 10px 5px;
  padding:3px;
  border:1px solid #cfcfcf;
  background:#eeeeee;
}
#cb_dateofbirth_Month_ID,#cb_dateofbirth_Day_ID,#cb_dateofbirth_Year_ID,#cb_gender,#cb_country{
 
  border:1px solid #cfcfcf;
  
width:auto;
height:auto;
}

label{
  width:170px;
  display:block;
  float:left;
  text-align:left;
  font-size:12px;
  font-weight:bold;
  
}


.titlecell label{
  width:170px;
  display:block;
  float:left;
  text-align:left;
  font-size:12px;
  font-weight:bold;
 
}
/*new classes added on 13/07/09 ends here*/ 

.weekdiv{
line-height:120%;
font-size:13px;
  font-weight:bold;
margin-left:0px;
}
.exercisediv{
font-size:12px;
line-height:120%;
}
.error{
border:1px solid #666;
margin:5px;
padding:5px;
font-weight:bold;
color:#00A651;

}

#navbar #current a{
color:#FF0000;
font-size:16px;
font-style:italic;
}
#navbar li ul li a span  {
color:#000;
font-size:14px;
font-style:none;
}

#navbar li ul li #current{
border:1px solid red;
color:red;
}

.parent active {
color:red;
}

.wrldrlldesc p {
padding:2px;

}
.mpading{
  
  line-height:130%;
  font-size:12px;
  margin:5px 0px 15px 0px;
  } 
.mpading a{
  color:#000;
  }
.mpading a:hover, .ppading a.active, .mpading a:active {
  color:#00a651;
  text-decoration:underline;
  }
.buttoncalc{
background:url("/templates/system/images/calendar.png" );
}
.bannertxt{
  font-size:50px;
  color:#00a651;
  font-weight:bold;
 font-family:Times New Roman;
  font-style:italic;
float:right;
  }
.bannertxt p{
  font-size:40px;
  color:#fff;
  font-weight:bold;
  font-style:italic;
  margin-right:15px;
  margin-top:124px;
  font-family:Times New Roman;
  padding:0;
  }
h2.contentheading{
color:#00A651;
font-size:16px;
font-weight:bold;
padding:13px
}

.articlediv{
padding :15px;
}
.articlediv div{
padding-bottom:10px;
}
.articlediv p{
padding:0px 0px 15px 0px;
}
#searchForm {
padding-left:15px;
}
#searchForm label{
display:inline;
float:none;
width:auto;

}
.list-footer{
padding-left:5px;
}
td.boldGold{
border:1px solid red;
}

.green_patch_new{
  background:#bde8d2 url(templates/yoursportstrainer/images/green_patch_top.gif) no-repeat top;
  height:auto;
  width:157px;
  }
.green_patch_new p{
  padding:10px;
  margin:0;
  }

/*
//components/com_sports/views/workouts/tmpl*/





.chromestyle{
width: 100%;
font-weight: bold;
}

.chromestyle:after{ /*Add margin between menu and rest of content in Firefox*/
content: "."; 
display: block; 
height: 0; 
clear: both; 
visibility: hidden;
}

.chromestyle li a span {
color:#fff;
font-size:14px;

}

.chromestyle ul{
width: 100%;
background: none;
padding: 4px 0;
margin: 0;
text-align: left; 
}

.chromestyle ul li{
display: inline;
text-align:center;
margin-right:20px;

}

.chromestyle ul li a{
color: #ffffff;
font-size:14px;
padding: 2px 7px 0 7px;
margin: 0;
text-decoration: none;

height:18px;
display:inline-block;

}

.chromestyle ul li a:hover, .chromestyle ul li a.selected{ /*script dynamically adds a class of "selected" to the current active menu item*/
background:url(templates/yoursportstrainer/images/li_hover.gif) no-repeat right;/**/

/* border-left:1px solid green; */
text-decoration:none;/*THEME CHANGE HERE*/

}

/* ######### Style for Drop Down Menu ######### */

.dropmenudiv{
position:absolute;
top: 0;
border-right: 1px solid #61807e; 
border-left: 1px solid #61807e; 
border-bottom: 1px solid #61807e; 
font:normal 12px Verdana;
line-height:18px;
z-index:100;
background-color: white;
width:auto;
visibility: hidden;
background:#bbd5d3;
margin-top:-1px;

padding:10px;
}


.dropmenudiv a{
width: auto;
display: block;
text-indent: 3px;
border-bottom: 1px solid #BBB; 
padding:2px 10px 2px 10px;
text-decoration: none;
font-weight: bold;
color: black;
}

* html .dropmenudiv a{ /*IE only hack*/
width: 100%;
}

.dropmenudiv a:hover{ /*THEME CHANGE HERE*/
background-color: #F0F0F0;
}



.dropmenudiv_big{
position:absolute;
top: 0;
border-right: 1px solid #61807e; 
border-left: 1px solid #61807e; 
border-bottom: 1px solid #61807e; 
font:normal 14px;
line-height:18px;
z-index:100;
background-color: white;
width:auto;
visibility: hidden;
background:#759B98;
margin-top:-1px;
padding:0;
}


.dropmenudiv_big a{
width: auto;
display: block;
text-indent: 3px;
padding: 2px 0;
text-decoration: none;
font-weight: bold;
color: black;
}

* html .dropmenudiv_big a{ /*IE only hack*/
width: 100%;
}
#chromemenu .dropmenudiv_big div a{ /*THEME CHANGE HERE*/
color:#000;
font-size:11px;
}


.dropmenudiv_big a:hover{ /*THEME CHANGE HERE*/
background-color: #F0F0F0;
}
.dropmenudiv_big div{
  width:180px;
  float:left;
  border-right:1px solid #61807e;
  padding:10px;
  }
.dropmenudiv_big div.last{
  width:180px;
  float:left;
  border-right:none;
  padding:10px;
  }
.dropmenudiv_big div a{
  padding:2px 0 2px 10px;
  border-bottom: 1px solid #000;
color: #000;
  }

#smalllinks_a{
  color:#7d7d7d;
  font-size:10px;
  }




/*new classes added on 24/10/09 starts here*/


  
.my_stat_h3{
  font-size:18px;
  font-weight:bold;
  color:#00a651;
  margin:25px 5px 5px 5px;
  } 
.body_measurments{
  color:#000;
  font-size:14px;
  }
.body_measurments span{
  color:#00a651;
  font-size:14px;
  } 
  
.bordr_top{
  border-top:1px solid #666565;
  }
.bordr_top_bg{
  border-top:1px solid #666565;
  background:#b7e5cd;
  }
.green_bg{
  background:#b7e5cd;
/*padding-left:5px;*/
  }
.br_drkgreen{
  background:#9bc9b2;
/*  padding-left:5px;*/
  }
.grey_bg{
  background:#d7d7d7;
  }


.bordr_bot{
  border-bottom:1px solid #666565;
  }
.bordr_top td{
  border-right:1px solid #cfcfce;
  padding:0 10px;
  }
.bordr_lft{
  /*background:url(images/lft_brdr.gif) repeat-y left;*/
  background:url(templates/yoursportstrainer/images/top_lft_cornr.gif) no-repeat top left;
  }
.goal_bg{
  background:#a5dfc1;
  }
  
.add_entry{
  margin:20px 10px;
  } 
.add_entry a{
  margin:0 0 0 20px;
  font-size:18px;
  }
.goal_img{
  background:url(templates/yoursportstrainer/images/percent_goal.gif) no-repeat right;
  }
.grid_green_txt{
  font-size:14px;
  color:#00a651;
  font-weight:bold;
  }
.grid_inpt{
  width:60px;
  height:14px;
  border:1px solid #919191;
  background:#eeeeee;
  vertical-align:middle;
 /* float:left;
  margin:0 5px 0 0; */
  font-size:11px;
  }
/*new classes added on 24/10/09 starts here*/ 
  .menu li ul{
display:none;
}


/*new classes added on 29/10/09 starts here*/

.myhpoto{
  background:url(templates/yoursportstrainer/images/myphoto_hed_bg.gif) no-repeat top;
  width:593px;
  margin-bottom:15px;
  }
.myhpoto p{
  padding:2px;
  margin:0;
  text-align:center;
  }
.myhpoto p span{
  font-size:14px;
  }
.myhpoto img{
  margin-top:10px;
  margin-bottom:10px;
  margin-right:24px;
  }
.myhpoto img.last{
  margin-right:0;
  margin-left:
  } 
.pad{
  padding:13px;
  }
.big_lnk{
  font-size:13px;
/*   font-weight:bold; */
  float:right;
  }
.big_h2{
  font-size:18px;
font-weight:bold;
  }
.myphoto_scroll{
  overflow:auto;
  height:700px;
  }

.myhpoto_edit{
  background:url(templates/yoursportstrainer/images/myphoto_hed_bg.gif) no-repeat top;
  width:593px;
  margin-bottom:15px;
  }
.myhpoto_edit p{
  padding:0;
  margin:0;
  text-align:left;
  }
.myhpoto_edit table td span{
  font-size:15px;
  margin:5px 0 0 0;
  display:block;
  font-weight:bold;
  }
  
.myhpoto_edit a{
  color:#14A5EF;
  font-weight:normal;
  }
.myhpoto_edit img{
  margin-top:0;
  margin-bottom:10px;
  margin-right:0;
  }
.date2{
  font-size:15px;
  float:right;
  margin-top:40px;
  }
.date_inpt{
  width:108px;
  height:16px;
  background:#bfbfbf;
  vertical-align:middle;
  }
.big_h2 span{
  font-size:16px;
  color:#000000;
  padding:0 0 0 20px;
  }
.placeholder{
  border:1px solid #333;
  width:263px;
  height:271px;
  float:right;
  margin:0 20px 0 0;
  __margin:0 10px 0 0;
  }
.tips{
  font-size:18px;
  font-weight:bold;
  float:left;
  }
/*new classes added on 29/10/09 ends here*/ 


#containerup {
  margin: auto;
  width: 400px;
  border-top-width: 0px;
  border-right-width: 1px;
  border-bottom-width: 1px;
  border-left-width: 1px;
  border-top-style: solid;
  border-right-style: solid;
  border-bottom-style: solid;
  border-left-style: solid;
  border-top-color: #000033;
  border-right-color: #000033;
  border-bottom-color: #000033;
  border-left-color: #000033;
  background-color: #FFFFFF;
}
#containerup #headerup #header_left {
  float: left;
  background-image: url(images/header_left.gif);
  background-repeat: no-repeat;
  height: 42px;
  width: 45px;
}
#containerup #headerup #header_right {
  background-image: url(images/header_right.gif);
  background-repeat: no-repeat;
  height: 42px;
  width: 6px;
  float: right;
}

#containerup #contentup {
  padding: 5px;
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 12px;
  font-weight: normal;
  color: #666666;
}
#containerup #footerup {
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 12px;
  color: #999999;
  text-align: right;
  border-top-width: 1px;
  border-right-width: 1px;
  border-bottom-width: 1px;
  border-left-width: 1px;
  border-top-style: solid;
  border-top-color: #999999;
  border-right-color: #000033;
  border-bottom-color: #000033;
  border-left-color: #000033;
  padding-top: 5px;
  padding-right: 10px;
  padding-bottom: 5px;
  padding-left: 5px;
}
#containerup #footerup a {
  color: #999999;
  text-decoration: none;
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 10px;
}

#containerup #headerup #header_main {
  float: left;
  padding: 5px;
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 12px;
  font-weight: bold;
  color: #FFFFFF;
  margin-top: 5px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
}
.sbtn    {
  background-image: url(images/button.gif);
  border: 1px solid #000033;
  height: 22px;
  width: 82px;
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 12px;
  color: #FFFFFF;
  font-weight: bold;
  background-position: center;
  padding: 0px;
  margin-top: 20px;
  margin-right: 20px;
  margin-bottom: 0px;
  margin-left: 20px;
}

#containerup #contentup #form1up legend {
  padding: 5px;
  margin: auto;
}







#containerup #headerup {
  padding: 0px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  background-image: url(images/header_bg.gif);
  background-repeat: repeat-x;
  height: 42px;
}


.msgup {
  text-align:left;
  color:#666;
  background-repeat: no-repeat;
  margin-left:30px;
   margin-right:30px;
  padding:5px;
   padding-left:30px;
}

.emsg {
  text-align:left;
  margin-left:30px;
   margin-right:30px;
  color:#666;
  background-repeat: no-repeat;
  padding:5px;
   padding-left:30px;
}

#loader{
   visibility:hidden;
}

#f1_upload_form{
   
}

#f1_error{
   font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 12px;
   font-weight:bold;
   color:#FF0000;
}

#f1_ok{
   font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 12px;
   font-weight:bold;
   color:#00FF00;

}

#f1_upload_form {
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size: 12px;
  font-weight: normal;
  color: #666666;
}

#f1_upload_process{
   z-index:100;
   visibility:hidden;
   position:absolute;
   text-align:center;
   width:400px;
}
</style>
</head>
<body>
<div id="wrapper">
  <div class="leftpanel">

  
  

<div class="ppading">

<h3>Basics of Strength Training for Volleyball</h3>
<div class="left"><img src="/administrator/components/com_sports/images/" width="150" height="149" alt="" /></div>
<div style="float:left; width:300px; padding:0 5px;">

 <p>A workout for volleyball must contain <strong>strength training</strong>. Like almost all sports, strength is a vital component to being successful in volleyball. <br /><br /> Research has shown that resistance training can improve players\' maximal force and power production, reduce the incidence of injury, and contribute to faster injury recovery times, thereby minimizing the number of missed practice sessions and competitions (1).</p>



  <p><strong>Instructions:</strong><br /><p>A workout for volleyball must contain <strong>strength training</strong>. Like almost all sports, strength is a vital component to being successful in volleyball. <br /><br /> Research has shown that resistance training can improve players\' maximal force and power production, reduce the incidence of injury, and contribute to faster injury recovery times, thereby minimizing the number of missed practice sessions and competitions (1).</p>
</div>
<div style="float:right; width:157px;"><div class="green_patch2" style="background:url(http://70.84.182.98:8423/templates/yoursportstrainer/images/green_patch2.gif) no-repeat top;text-align="center"">

  <label>Skill:</label> Basic <br />
  <label>Time:</label> 30 mins<br />  
  <label>Body:</label> Shoulders<br />

</div>
 

<div align="center"><br />
 <a onclick="window.open(); return false;return false"  href="/index.php?option=com_sports&amp;sports_id=4&amp;view=workouts&amp;workout_id=24&amp;task=details&amp;tmpl=component&amp;Itemid=62"><img src="/components/com_sports/images/print_workout_btn.gif" alt="" width="113" height="22" vspace="5" /></a>

<br />
<img src="/components/com_sports/images/already_added.gif" alt="" width="113" height="22" />
<!--<span style="color:Green;font-weight: bold">Already Added</span>-->
<br />
  <a href="#"><img src="/components/com_sports/images/viewlog.gif" width="113" height="22" alt="" vspace="5" /></a>
<!--<a href="#" style="color:#DA342E;font-weight: bold">View Log</a>--> 
</div>
</div>



<div class="clear"></div>
</div>



<div style="border: 0px solid red; background: rgb(0, 84, 165) none repeat scroll 0% 0%; margin-left: 9px; margin-right: 9px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
  <div style="border: 0px solid red; margin: 25px 0px 8px 24px; width: 130px; float: left;">
   <img src="/templates/yoursportstrainer/images/P1.gif" alt="" />
  </div>
<div style="border-top: 8px solid rgb(0, 84, 165); margin: 12px 8px 8px 0px; padding: 3px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; font-size: 11px; line-height: 120%; width: 440px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; float: right;"><p>Phase 1 Instructions</p></div>
<div class="clear"/>

<div style="border: 0px solid red; background: rgb(255, 255, 255) none repeat scroll 0% 0%; width: 592px; margin-left: 27px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">

    <!-- main day div -->
    <div style="border-bottom: 4px solid #cfcfcf; width: 591px; float: left;">
      <div align="center" style="border: 0px solid red; background: rgb(127, 168, 209) none repeat scroll 0% 0%; padding-top: 2px; width: 58px; float: left; height: 84px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
       <img w="" alt="" src="/templates/yoursportstrainer/images/excs_1.png"/><br/>
      </div>
      <div align="center" style="border: 0px solid red; margin: 16px 0px 2px; width: 70px; float: left; height: auto;">
        <img width="65" height="65" alt="" src="/administrator/components/com_sports/images/No-image-available.jpg"/><br/>
      </div>
      <div class="exercisediv" style="margin: 7px 1px 2px 0px; float: right; width: 460px;">
           <strong style="font-size: 14px;">Exercise 1 Now -</strong>
<span>
<a href="/index.php?option=com_sports&amp;view=sports&amp;sports_id=1&amp;view=workouts&amp;task=exercise&amp;workout_id=3&amp;exercise_id=1&amp;Itemid=34">Video</a>
|
<a href="/index.php?option=com_sports&amp;view=sports&amp;sports_id=1&amp;view=workouts&amp;task=exercise&amp;workout_id=3&amp;exercise_id=1&amp;Itemid=34">Details</a>
</span>
<div style="border: 2px solid rgb(255, 255, 255);"/>



            <span>Reps</span><span style="margin: 0px 25px 0px 62px;">=</span>2<br/>
            <span>RBS</span> <span style="margin: 0px 25px 0px 62px;">=</span>4<br/>
            <span>Equipment</span>  <span style="margin: 0px 25px 0px 28px;">=</span>   Exercise Bikes, Barbell<br/>
            <span>Muscle Group</span><span style="margin: 0px 25px 0px 14px;">=</span>Chest      </div>
    </div>
<!-- main day div -->
    <!-- main day div -->
    <div style="border-bottom: 4px solid rgb(183, 183, 183); width: 591px; float: left;">
      <div align="center" style="border: 0px solid red; background: rgb(127, 168, 209) none repeat scroll 0% 0%; padding-top: 2px; width: 58px; float: left; height: 84px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
       <img w="" alt="" src="/templates/yoursportstrainer/images/excs_2.png"/><br/>
      </div>
      <div align="center" style="border: 0px solid red; margin: 16px 0px 2px; width: 70px; float: left; height: auto;">
        <img width="65" height="65" alt="" src="/administrator/components/com_sports/images/131998.gif"/><br/>
      </div>
      <div class="exercisediv" style="margin: 7px 1px 2px 0px; float: right; width: 460px;">
           <strong style="font-size: 14px;">Bench Press -</strong>
<span>
<a href="/index.php?option=com_sports&amp;view=sports&amp;sports_id=1&amp;view=workouts&amp;task=exercise&amp;workout_id=3&amp;exercise_id=2&amp;Itemid=34">Video</a>
|
<a href="/index.php?option=com_sports&amp;view=sports&amp;sports_id=1&amp;view=workouts&amp;task=exercise&amp;workout_id=3&amp;exercise_id=2&amp;Itemid=34">Details</a>
</span>
<div style="border: 2px solid rgb(255, 255, 255);"/>



            <span>Reps</span><span style="margin: 0px 25px 0px 62px;">=</span>2<br/>
            <span>RBS</span> <span style="margin: 0px 25px 0px 62px;">=</span>1<br/>
            <span>Equipment</span>  <span style="margin: 0px 25px 0px 28px;">=</span>   Barbell, Dumbell, Bench<br/>
            <span>Muscle Group</span><span style="margin: 0px 25px 0px 14px;">=</span>Chest      </div>
    </div>
<div class="clear"/>
<!-- main day div -->






  </div>
</div>
<br/>
// <br/><div class="clear"></div>
<!-- main day div -->





  </div></div></div></div>
















</body>
</html>
';

//==============================================================
//==============================================================
//==============================================================
if ($_REQUEST['html']) { echo '<html><head><style>'.file_get_contents('mpdfstyletables.css').'</style></head><body>'.$html.'</body></html>'; exit; }

if ($_REQUEST['source']) { 
	$file = __FILE__;
	header("Content-Type: text/plain");
	header("Content-Length: ". filesize($file));
	header("Content-Disposition: attachment; filename='".$file."'");
	readfile($file);
	exit; 
}
//==============================================================
//==============================================================
//==============================================================

$mpdf=new mPDF('en-GB','A4','','',10,10,10,10,6,3); 

	$mpdf->use_embeddedfonts_1252 = true;	// false is default

	$mpdf->SetDisplayMode('fullpage');

	$mpdf->SetTitle('mPDF Example - Borders');

	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

//==============================================================

	// LOAD a stylesheet
	$stylesheet = file_get_contents('mpdfstyletables.css');
	$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

	$mpdf->WriteHTML($html);

//	$mpdf->WriteHTML('<div class="infobox">Generated in '.sprintf('%.2f',(microtime(true) - $timeo_start)).' seconds</div>',2);
	$mpdf->Output('mpdf.pdf','I');
	exit;


?>