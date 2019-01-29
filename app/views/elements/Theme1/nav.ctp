<?php 
$globalcondition = "";
$base_url = Configure::read('App.base_url');

if(empty($_SESSION['User']['User']['id'])) $globalcondition="and Content.is_global='1'";
$showcommenttab="";

$show_web_only="and (Content.type='' or Content.type='web' or Content.type is NULL)";

App::import("Model", "Content");
App::import("Model", "RecurringEvent");

$this->Content =   & new Content();
$this->RecurringEvent =   & new RecurringEvent();

$contentcount = $this->Content->find('count', array('conditions' => "Content.active_status='1' and parent_id='0' and Content.delete_status='0' and Content.internal_alias !='privacy' and Content.internal_alias !='terms' and Content.internal_alias !='register' and Content.internal_alias !='login' and Content.internal_alias !='dashboard' and Content.internal_alias !='logout' and Content.internal_alias !='home_page' and Content.internal_alias !='home-page' and Content.internal_alias !='contact' ".$show_web_only." ".$globalcondition." ".$showcommenttab,'fields'=>'id'));
$url= Configure::read('App.base_url');


// By Suman Singh
$hostURL = Configure::read('SITE_HTTP_HOST');
if($_SERVER['HTTP_HOST']== $hostURL || $_SERVER['HTTP_HOST'] == $hostURL) {
  $url= Configure::read('App.base_url').$project_name;
}

  // For Home menu link
   $conditionhome = " Content.active_status='1' and Content.delete_status='0' and Content.parent_id ='0' and (Content.internal_alias ='home_page' or Content.internal_alias ='home-page') ".$show_web_only." ".$globalcondition." ".$showcommenttab;
    $homedetails = $this->Content->find('first', array('conditions' => $conditionhome)); 

$condition = "Content.project_id =" . $project['Project']['id'] . " and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and (is_sytem!='2') and `Content`.`internal_alias` !='home-page' ".$show_web_only."  ".$globalcondition." ".$showcommenttab;
$contentdetails = $this->Content->find('all', array('conditions' => $condition,'order'=>'file_sequence'));
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap1</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?php echo $url; ?>"><?= $homedetails['Content']['title'] ?></a>
        </li>
        <?php foreach($contentdetails as $convalue){ ?>
          <?php 
            if($convalue['Content']['alias'] == "shopping-cart" ){
                $menulink = "companies/shoppingcart/".$convalue['Content']['alias'];
            }else if($convalue['Content']['alias']=="events" || $convalue['Content']['alias']=="chat" || $convalue['Content']['alias']=="blogs"){
                $menulink = "companies/".$convalue['Content']['alias'];
            }else{
                 $menulink = $convalue['Content']['alias'];
            }

            $title = $convalue['Content']['title'];
            if($title){$title =AppController::WordLimiter($title,20);}

            $menulink = $base_url.$menulink;
          ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="<?= $menulink; ?>"><?= $title; ?></a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>