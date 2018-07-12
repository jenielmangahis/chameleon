
<?php if(!empty($coinsdetail['Coinset']['sidea']) && !empty($coinsdetail['Coinset']['sideb'])) {?>
<div style="background-color:<?php echo $background; ?>" >
<p><img alt="" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/img/' ?>box_top.png"  /></p>
<div align="center" class="conConts" >
	<a href="<?php echo $href_coin_image; ?>" onclick="window.top.location.href = this.href" ><img  width="177" height="177"  src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/img/<?php echo $dataprojects['Project']['project_name'].'/uploads/'.$coinsdetail['Coinset']['sidea']; ?>" alt="" /></a><br /><br />
	<a href="<?php echo $href_coin_image; ?>" onclick="window.top.location.href = this.href" ><img  width="177" height="177"  src="<?php echo $dataprojects['Project']['project_name'].'/uploads/'.$coinsdetail['Coinset']['sideb']; ?>" alt="" /></a><br/>
</div>
<p><img alt="" src="<?php echo '/img/'.$project_name ?>/box_bottom.png" /></p>
</div>
<?php }?>