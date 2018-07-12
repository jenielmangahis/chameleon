<div class="rhtBox">


<?php
if( $dataprojects['Project']['is_showcoins']==1)
	echo "<br/><br/><br/>";

if($project['ProjectType']['coin_verification']=="0"){
	if(empty($_SESSION['User']['User']['id'])){ ?>
	<?php echo  $form->create('Company',array('action'=>'/signup','id'=>'SignupForm'));?>
			<?php 	echo $form->end();?>
	<?php }	
} ?>

		<?php echo $form->create("Company", array("action" => "comments",'id'=>'comments', 'name' => 'comments','onsubmit' => "return validatemap(".$noofcomments.");" ))?>
<?php if($project['ProjectType']['showcommentbutton']=="1") {?>
  

<?php
				e($html->link(
					$html->tag('span', 'Comment'),
					array('controller'=>'companies','action'=>'comments'),
					array('escape' => false, 'class'=>'buttonRegis')
					)
				);
?>



	<div class="clear">&nbsp;</div>
<?php } ?>

<?php if($project['ProjectType']['registrationbox_verification']=="1") {?>
  
	

	<?php
				e($html->link(
					$html->tag('span', 'register'),
					array('controller'=>'companies','action'=>'registeruser'),
					array('escape' => false, 'class'=>'buttonRegis')
					)
				);
?>

	<div class="clear">&nbsp;</div>
<?php } ?>

	
		
	<?php 	echo $form->end();?>
    </div>
	<div class="clear"></div>


<?php  
if($dataprojects['Project']['is_showcoins']==1)
{

                                     
?>
<?php if(!empty($coinsdetail['Coinset']['sidea']) && !empty($coinsdetail['Coinset']['sideb'])) {?>
<div >
<p><img alt="" src="<?php echo '/img/'.$project_name ?>/box_top.png" /></p>
<div align="center" class="conConts" >
	<a href="<?php echo $href_coin_image; ?>" ><img  width="177" height="177"  src="img/<?php echo $dataprojects['Project']['project_name'].'/uploads/'.$coinsdetail['Coinset']['sidea']; ?>" alt="" /></a><br /><br />
	<a href="<?php echo $href_coin_image; ?>" ><img  width="177" height="177"  src="img/<?php echo $dataprojects['Project']['project_name'].'/uploads/'.$coinsdetail['Coinset']['sideb']; ?>" alt="" /></a><br/>
</div>
<p><img alt="" src="<?php echo '/img/'.$project_name ?>/box_bottom.png" /></p>
</div>

<?php }?>





<?php   }?>








<?php

//print_r($socialicons);
if(count($socialicons)>0)
{
?>
<div class="rightbotimg">
<ul class="ulclass">
<?php 	
foreach($socialicons as $graphic){
if(!empty($graphic['ProjectGraphic']['imagename'])){
?>
<?php 
$arr=explode(":",$graphic['ProjectGraphic']['address']);
if($arr[0]=="http"){?>
<li><a href="<?php echo $graphic['ProjectGraphic']['address']?>" target="new"><?php echo $html->image('/img/'.$project_name.'/uploads/'.$graphic['ProjectGraphic']['imagename']);?></a></li>
<?php }else { ?>
<li><a href="http://<?php echo $graphic['ProjectGraphic']['address']?>" target="new"><?php echo $html->image('/img/'.$project_name.'/uploads/'.$graphic['ProjectGraphic']['imagename']);?></a></li>
<?php }?>
<?php } 
}
?>
</ul>
<div class="clear"></div>
</div>
<?php }?>


<!-- </div>-->
