<div >
  <div class="coinBoxCenter">
  <p class="coinBoxTop"><?php echo $html->image('/img/'.$project_name.'/coinBox_RhtTop.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
    <h2>Our Coin</h2>
   <a href="#."><?php 
if($project['Project']['sidea']=="")
echo $html->image('/img/'.$project_name.'/sideA.png', array('class'=>''));
else
echo $html->image('/img/'.$project_name.'/uploads/'.$project['Project']['sidea'], array('class'=>''));
?></a><?php echo $html->image('/img/'.$project_name.'/spacer.gif', array('width'=>'20','heigth'=>'1'));?><a href="#."><?php 
if($project['Project']['sideb']=="")
echo $html->image('/img/'.$project_name.'/sideB.png', array('class'=>''));
else
echo $html->image('/img/'.$project_name.'/uploads/'.$project['Project']['sideb'], array('class'=>''));
?></a>
  </div>
  </div>
  <p class="coinBoxBot"><?php echo $html->image('/img/'.$project_name.'/coinBox_RhtBot.gif', array('class'=>'right'));?></p>
  </div>
  

  <div class="clear">&nbsp;</div>
<div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
     <h2>Side A Description</h2>
    <p><?php if(empty($project['Project']['sideadesc'])) echo "<center>No Description..</center>"; else echo $project['Project']['sideadesc'];?></p>
  </div>
  </div><p class="boxBot">
   <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

<div class="clear">&nbsp;</div>
<div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
     <h2>Side B Description</h2>
    <p><?php if(empty($project['Project']['sidebdesc'])) echo "<center>No Description..</center>"; else echo $project['Project']['sidebdesc'];?></p>
  </div>
  </div><p class="boxBot">
   <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
<div class="clear">&nbsp;</div>
<div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
     <h2>Edge Description</h2>
    <p><?php if(empty($project['Project']['edgedesc'])) echo "<center>No Description..</center>"; else echo $project['Project']['edgedesc'];?></p>
  </div>
  </div><p class="boxBot">
   <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

  </div>