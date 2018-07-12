<div class="header">
<div class="centerPage">
<ul class="logOut" style="margin-right: -41px;">
<?php if($session->read('projectwebsite_id') !='' && $session->read('projectwebsite_id') !='0'){ 
 if(!empty($dataprojects['Project']['url'])){
     $pos = strpos($dataprojects['Project']['url'],"http://");
     if ($pos === false) {
         $previewurl="http://".$dataprojects['Project']['url'];
     }else{
         $previewurl=$dataprojects['Project']['url'];
     }
     
   }
  else{
		 $previewurl="http://".$_SERVER['HTTP_HOST']."/".$dataprojects['Project']['project_name'];
  }?>  
  
<?php  }?>
<li>
	<a  href="<?php echo $previewurl; ?>" target="_blank"><span>Preview</span></a>


</li>
<li>
	<?php
		e($html->link(
			$html->tag('span', 'Logout'),
			array('controller'=>'companies','action'=>'logout'),
			array('escape' => false)
			)
		);
	?>

</li>
</ul>

<ul id="menu" >
<li>
	<!--<a class="butBg" id="dashbd"  href="/companies/dashboard"><span>Dashboard</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Dashboard'),
			array('controller'=>'companies','action'=>'dashboard'),
			array('escape' => false,'class' =>'butBg','id' =>'dashbd')
			)
		);
	?>

</li>
<li>
	<!--<a  class="butBg" id="memBrs"  href="/companies/memberlist"><span>Members</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Members'),
			array('controller'=>'companies','action'=>'memberlist'),
			array('escape' => false,'class'=>'butBg', 'id' => 'memBrs')
			)
		);
	?>
</li>
<li>
	<!--<a  class="butBg" id="contMnu" href="/companies/companylist"><span>Contacts</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Contacts'),
			array('controller'=>'companies','action'=>'companylist'),
			array('escape' => false,'class'=>'butBg', 'id' => 'contMnu')
			)
		);
	?>
</li>  
<li>
	<!--<a  class="butBg" id="donateMnu" href="/companies/coming_soon/donationlist"><span>Donations</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Donations'),
			array('controller'=>'companies','action'=>'coming_soon','donationlist'),
			array('escape' => false,'class'=>'butBg', 'id' => 'donateMnu')
			)
		);
	?>
</li>
<li>
	<!--<a  class="butBg" id="EventLst"  href="/companies/eventlist"><span>Events</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Events'),
			array('controller'=>'companies','action'=>'eventlist'),
			array('escape' => false,'class'=>'butBg', 'id' => 'EventLst')
			)
		);
	?>

</li>   
<li>
	<!--<a   class="butBg" id="EmailMnu"  href="/companies/sendtempmail"><span>Email<!-- Communication --><!--</span></a>-->
	<li>
<?php
	e($html->link(
				$html->tag('span', 'Players'),
				array('controller'=>'players','action'=>'playerslist','company'),
				array('class'=>'butBg','id'=>'playMnu','escape' => false)
				)
	);
?>
</li>
 
 <li>
<?php
	e($html->link(
				$html->tag('span', 'Prospect'),
				array('controller'=>'prospects','action'=>'projectmerchant'),
				array('class'=>'butBg','id'=>'prosMnu','escape' => false)
				)
	);
?>
</li>
<li>
<?php
	e($html->link(
				$html->tag('span', 'Offers'),
				array('controller'=>'offers','action'=>'offerlist'),
				array('class'=>'butBg','id'=>'OfferMnu','escape' => false)
				)
	);
?>
</li>


	<?php
		e($html->link(
			$html->tag('span', 'Email'),
			array('controller'=>'companies','action'=>'sendtempmail'),
			array('escape' => false,'class'=>'butBg', 'id' => 'EmailMnu')
			)
		);
	?>
</li>  
<li>
	<!--<a  class="butBg" id="commMnu"  href="/companies/messagelist"><span>Comments</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Comments'),
			array('controller'=>'companies','action'=>'messagelist'),
			array('escape' => false,'class'=>'butBg', 'id' => 'commMnu')
			)
		);
	?>

</li>  
<li>
	<!--<a class="butBg" id="FormtLst" href="/companies/formsubmitlist"><span>Forms</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Forms'),
			array('controller'=>'companies','action'=>'formsubmitlist'),
			array('escape' => false,'class'=>'butBg', 'id' => 'FormtLst')
			)
		);
	?>
</li>  
<li>
	<!--<a  class="butBg" id="projeCt"  href="/companies/editprojectdtl"><span>Project</span></a>-->
<?php
		e($html->link(
			$html->tag('span', 'Project'),
			array('controller'=>'companies','action'=>'editprojectdtl'),
			array('escape' => false,'class'=>'butBg', 'id' => 'projeCt')
			)
		);
	?>
</li>
<li>
	<!--<a  class="butBg" id="weB"  href="/companies/contentlist"><span>Website</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Website'),
			array('controller'=>'companies','action'=>'contentlist'),
			array('escape' => false,'class'=>'butBg', 'id' => 'weB')
			)
		);
	?>


</li>
<li>
	<!--<a  class="butBg" id="ConFigs"  href="/companies/settings"><span>Setup</span></a>-->
	<?php
		e($html->link(
			$html->tag('span', 'Setup'),
			array('controller'=>'companies','action'=>'settings'),
			array('escape' => false,'class'=>'butBg', 'id' => 'ConFigs')
			)
		);
	?>

</li>

<!-- <li><a  class="butBg" id="coiNs"  href="/companies/registercoinlist"><span>Coins</span></a></li> -->

</li>
<?php
$_SESSION['User']['User']['usertype'];
?>
<script type="text/javascript">



<?php

if($_SESSION['User']['User']['usertype']=="holder"){ ?>
  window.location="/";
  <?php
}
    ?>    var menu=new menu.dd("menu");
        menu.init("menu","menuhover");
        </script>
</div></div>