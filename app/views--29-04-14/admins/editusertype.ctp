
<script type="text/javascript">
$(document).ready(function() {
$('#LinkMnu').removeClass("butBg");
$('#LinkMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/rolle_list';
?>


</script>
<style>
.txtArea_bot select option:first-child{ font-weight:bold;} 
</style>
<?php 
	$editLink = "editusertype/".$id;
?>

<div class="container"> 
<div class="titlCont">
<div class="myclass">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
<?php echo $form->create("admin", array("action" => $editLink,'name' => 'Role', 'id' => "Role", 'class' => 'adduser'));
?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
</button>
<?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt">Edit User Type</span>
<div class="topTabs" style="height:25px;">
<?php /*?><ul class="dropdown">
<li>

</li>

</ul><?php */?>
</div> 



  <?php    	
		$this->loginarea="admins";
				$this->subtabsel="editusertype";	
			echo $this->renderElement('setup_submenus');  ?>   
	
	
	

<?php $this->mail_tasks="tabSelt"; ?>   
</div>

</div>
<div class="midPadd" id="addcmp">

<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          

<br />

<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
<table cellspacing="0" cellpadding="0" align="left" width="100%">
	<tbody>
		<tr>
			<td width="50%" valign="top">
				<table cellspacing="10" cellpadding="0" align="left" width="100%">
					<tbody>
	



	<tr>
		<td align="left" valign="top">
			<label class="boldlabel">User Type<span style="color: red;">*</span></label>
		</td>
		<td colspan="3">
			<span class="intpSpan">
					<?php echo $form->input("title", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250","value"=>$this->data['Role']['title']));?>
			</span>
		</td>	
	</tr>

<tr>
<td align="left" valign="top"><label class="boldlabel">Users in Type
</label></td>
<td colspan="3"><span class="txtArea_top"> <span class="txtArea_bot"> <?php 
$option = array();
				if(count($this->data['Admin']))
				{
					foreach ($this->data['Admin'] as $row) {
						$option[$row['id']] = $row['username'];	
					}
				}
echo $form->select("admin.user_id",$option,$option,array('id' => 'admin_users','class'=>'multilist','multiple' => true),array('0'=>'User Name')); ?>
</span>
</span> </td>
</tr>
<tr>
<td></td>
<td valign="top">
<table><tbody>
<?php 
$loopCounter = 1;
$vbCounter = (int)(count($menu)/4);
$vbCounter = $vbCounter+1;
//echo "<pre>";
//print_r($menu);
foreach ($menu as $key => $value) {
	$submenu = $common->getCustomSubMenu($key);
	if(count($submenu))
	{
?>
<tr>
<td valign="top">
<label class="boldlabel"><?php echo  $value;?>
</label><br>
<span class="txtArea_top"> <span class="txtArea_bot"> <?php 
$option = $submenu;
$accessKey = "admin.".str_replace(" ", "_", $value)."_item_id";
echo $form->select($accessKey,$option,$previousChecked,array('id' => 'admin_users','class'=>'multilist','multiple' => 'checkbox')); ?>
</span>
</span> 
</td>
</tr>
<?php
		if($loopCounter%$vbCounter==0)
		{
			echo "</tbody></table></td><td valign='top'><table><tbody>";
		}
	} 
	$loopCounter++;
} 
?>
</tbody></table></td>
</tr>
	</tbody>
</table>
<div class="clear"></div>
</div>
