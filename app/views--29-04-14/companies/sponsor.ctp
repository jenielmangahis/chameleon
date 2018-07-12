<div >
  <div class="SponsorlogoBox">
  <p class="coinBoxTop"><?php echo $html->image('/img/'.$project_name.'/coinBox_RhtTop.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">

  	<?php 
	if($sponsorDetails['Sponsor']['logo']=="") $splogopath='/img/'.$project_name.'/noimage.png'; else $splogopath='/img/'.$project_name.'/uploads/'.$sponsorDetails['Sponsor']['logo'];
	echo $html->image($splogopath, array('width'=>'100px','height'=>'100px'));
	?>
  </div>
  </div>
  <p class="coinBoxBot"><?php echo $html->image('/img/'.$project_name.'/coinBox_RhtBot.gif', array('class'=>'right'));?></p>
  </div>
<div class="spnDetails">
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
 <h2><?php echo "Sponsor Details"; ?></h2>
    <table width="300">
<tr>
<td width="20%"><b>Name</b></td>
<td ><?php  if(!empty($sponsorDetails['Sponsor']['sponsor_name']))  echo $sponsorDetails['Sponsor']['sponsor_name'];?></td>
</tr>
<tr>
<td width="20%"><b>Email</b></td>
<td width="80%"><?php if(!empty($sponsorDetails['Sponsor']['email'])) echo $sponsorDetails['Sponsor']['email'];?></td>
</tr>
</tr>
<td width="20%" valign="top"><b>Address</b></td>
<td width="80%"><?php if(!empty($sponsorDetails['Sponsor']['address1'])) echo $sponsorDetails['Sponsor']['address1'];
if(!empty($sponsorDetails['Sponsor']['address2'])) echo "<br>".$sponsorDetails['Sponsor']['address2'];?></td>

</tr>
<tr>
<td width="20%"><b>City</b></td>
<td width="80%"><?php  if(!empty($sponsorDetails['Sponsor']['city'])) echo $sponsorDetails['Sponsor']['city'];?></td>
</tr>
<tr>
<td width="20%"><b>Zip</b></td>
<td width="80%"><?php  if(!empty($sponsorDetails['Sponsor']['zipcode'])) echo $sponsorDetails['Sponsor']['zipcode'];?></td>
</tr>
<tr>
<td width="20%"><b>State</b></td>
<td width="80%"><?php if(!empty($sponsorDetails['Sponsor']['state'])) echo  AppController::getstatename($sponsorDetails['Sponsor']['state']);?></td>
</tr>
<tr>
<td width="20%"><b>Country</b></td>
<td width="80%"><?php  if(!empty($sponsorDetails['Sponsor']['country'])) echo AppController::getcountryname($sponsorDetails['Sponsor']['country']);?></td>
</tr>
</table>
  </div>
  </div><p class="boxBot">
<?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
 </p>
  </div>
  </div>

 <div class="shortDescrp">
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
    <h2><?php if(empty($sponsorDetails['Sponsor']['titleshortdescription'])) echo "No Title"; else echo $sponsorDetails['Sponsor']['titleshortdescription']; ?></h2>
    <p><?php if(empty($sponsorDetails['Sponsor']['infoshort'])) echo "<center>No Description..</center>"; else  echo $sponsorDetails['Sponsor']['infoshort'];?></p>
    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot">
<?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
 </p>
  </div>
  </div>
  
  <div class="clear">&nbsp;</div>
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
    <h2><?php if(empty($sponsorDetails['Sponsor']['titlelongdescription'])) echo "No Title.."; else echo $sponsorDetails['Sponsor']['titlelongdescription']; ?></h2>
    <p><?php if(empty($sponsorDetails['Sponsor']['infolong'])) echo "<center>No Description..</center>"; else  echo $sponsorDetails['Sponsor']['infolong'];?></p>
  </div>
  </div><p class="boxBot">
 <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>
<div class="clear">&nbsp;</div>
  
  
<?php if(!empty($companylist)) {?>
  <div class="boxBg">
  <p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor">
  <div class="boxPad">
    <h2>Related Companies</h2>
 	<p>&nbsp;</p>
<div>
	<?php
	 foreach($companylist as $company) {
	?>
	<div class='compLogo'>
	<?php
	if($company['Company']['logo']=="") $logopath='/img/'.$project_name.'/noimage.png'; else $logopath='/img/'.$project_name.'/uploads/'.$company['Company']['logo'];
	 echo $html->image($logopath, array('width'=>'150px','height'=>'150px','title'=>$company['Company']['company_name']));
	?>
	<div class='clear'></div>	
	<h4><?php echo $company['Company']['company_name'];?></h4>
	<div class='clear'></div>	
	</div>
	<?php } ?>
	<div class='clear'>&nbsp;</div>	
</div>
<div class='clear'>&nbsp;</div>	
  </div>
  </div><p class="boxBot">
 <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
    </div>
<?php }?>
  </div>


