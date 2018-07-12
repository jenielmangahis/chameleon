<style>
.rightbotimg{
background: none repeat scroll 0% 0% rgb(255, 255, 255); text-align: center; padding: 10px 0;
}
.rightbotimg li{
float: left; padding:7px;
}
.ulclass{
list-style:none;
}
</style>


<div style=" min-height: 35px; "> 
<?php 
	  $project_name=$project_na[0]['Project']['project_name'];

      if(isset($project_name) && $project_name!="") {
          
     
	   if(count($socialicons)>0)
	  {
	  ?>

	  <?php 	
	  foreach($socialicons as $graphic){
	  if(!empty($graphic['ProjectGraphic']['imagename'])){
	  ?>
	  <?php 
	  $arr=explode(":",$graphic['ProjectGraphic']['address']);
	   if($arr[0]=="http"){?>
                    <a style="height: 33px; width: 33px;" href="<?php echo $graphic['ProjectGraphic']['address']?>" target="new">
                    <?php echo $html->image('/img/'.$project_name.'/uploads/'.$graphic['ProjectGraphic']['imagename'], array('style' => 'border: none;'));?></a>
                    <?php }else { ?>
                    <a target="new" href="http://<?php echo $graphic['ProjectGraphic']['address']?>" >
                    <?php echo $html->image('/img/'.$project_name.'/uploads/'.$graphic['ProjectGraphic']['imagename'], array('style' => 'border: none;'));?></a>
                    <?php }?>
	  <?php } 
	  }
	  ?>

	  <?php 
} } ?>
</div>
