<style>
.rightbotimg{
background: none repeat scroll 0 0 transparent;
}
.rightbotimg li{
float: left; padding:7px;
}
.ulclass{
list-style:none;
}
</style>
<div class="rightbotimg" style="background: none repeat scroll 0% 0% rgb(255, 255, 255);">
<?php 
	  $project_name=$project_na[0]['Project']['project_name'];
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
	  <li><a href="<?php echo $graphic['ProjectGraphic']['address']?>" target="new"><?php echo $html->image('/img/'.$project_name.'/uploads/'.$graphic['ProjectGraphic']['imagename'], array('style' => 'border: none;'));?></a></li>
	  <?php }else { ?>
	  <li><a href="http://<?php echo $graphic['ProjectGraphic']['address']?>" target="new"><?php echo $html->image('/img/'.$project_name.'/uploads/'.$graphic['ProjectGraphic']['imagename'], array('style' => 'border: none;'));?></a></li>
	  <?php }?>
	  <?php } 
	  }
	  ?>
	  </ul>
	  <div class="clear"></div>
	  </div>
	  <?php 
}?>
</div>
