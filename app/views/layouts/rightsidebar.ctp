<?php if(count($socialicons)>0) || $dataprojects['Project']['is_showcoins']==1 ){ ?>

<div class="rhtBox">


<?php
if($project['ProjectType']['coin_verification']=="0" || $dataprojects['Project']['is_showcoins']==1)
	echo "<br><br><br>";

if($project['ProjectType']['coin_verification']=="0"){
if(empty($_SESSION['User']['User']['id'])){
?>
<?php echo  $form->create('Company',array('action'=>'/signup','id'=>'SignupForm'));?>

		<?php 	echo $form->end();?>
		<?php }
		}
		?>

		<?php echo $form->create("Company", array("action" => "comments",'id'=>'comments', 'name' => 'comments','onsubmit' => "return validatemap(".$noofcomments.");" ))?>
<?php if($project['ProjectType'][showcommentbutton]=="1"){ ?>
<p>&nbsp;</p>
<?php if($project['ProjectType']['registrationbox_verification']=="1") {?>
    <p class="boxDiv"></p>
<?php } ?>

 <p>&nbsp;</p>
	
<?php } ?>		
	<?php 	echo $form->end();?>
    </div>
	<div class="clear"></div>


<?php  
if($dataprojects['Project']['is_showcoins']==1)
{
                                  
?>
<?php if(!empty($dataprojects['Project']['sidea']) && !empty($dataprojects['Project']['sideb'])) {?>
<div >
<p><img alt="" src="<?php echo '/img/'.$project_name ?>/box_top.png"></p>
<div align="center" class="conConts" >
	<a href="#."><img src="img/<?php echo $dataprojects['Project']['project_name'].'/uploads/'.$dataprojects['Project']['sidea']; ?>" alt="" /></a><br /><br />
	<a href="#."><img src="img/<?php echo $dataprojects['Project']['project_name'].'/uploads/'.$dataprojects['Project']['sideb']; ?>" alt="" /></a><br>
</div>
<p><img alt="" src="<?php echo '/img/'.$project_name ?>/box_bottom.png"></p>
</div>

<?php }?>
<?php }
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


 </div>
<?php } ?>