
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

<div class="container"> 
<div class="titlCont">
<div class="myclass">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;"><?php echo $form->create("admin", array("action" => "add_role",'name' => 'Admin', 'id' => "Admin", 'class' => 'adduser')); ?>	
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
</button>		
<?php  echo $this->renderElement('new_slider');  ?>			
</div>
<div class="topTabs" style="height:25px;"></div>
<span class="titlTxt">Add User</span> 
<div class="clear"></div>
<?php $this->mail_tasks="tabSelt"; ?>
<?php    $this->loginarea="setups";    $this->subtabsel="rolle_list";
                    echo $this->renderElement('setup_submenus');  ?>    
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
		<td align="right">
			<label class="boldlabel">User Type<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input("title", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>

<tr>
<td align="right"><label class="boldlabel">Users in Type
</label></td>
<td><span class="txtArea_top"> <span class="txtArea_bot"> <?php 
$option = array();
foreach ($this->data as $row) {
				if(count($row['Admin']))
				{
					foreach ($row['Admin'] as $row) {
						$option[$row['id']] = $row['username'].' ' . $row['firstname'] . ' '. $row['lastname'];	
					}
				}
}

echo $form->select("admin.user_id",$option,$option,array('id' => 'admin_users','class'=>'multilist','multiple' => true),array('0'=>'Username  First Name Last Name')); ?>
</span>
</span> </td>
</tr>
<tr>
<?php 
$loopCounter = 1;
foreach ($menu as $key => $value) {
	$submenu = $common->getCustomSubMenu($key);
	if(count($submenu))
	{
?>
<td>
<label class="boldlabel"><?php echo  $value;?></label><br>
<span class="txtArea_top"> 
<span class="txtArea_bot"> <?php 
$option = $submenu;
$accessKey = "admin.".str_replace(" ", "_", $value)."_item_id";
echo $form->select($accessKey,$option,$option,array('id' => 'admin_users','class'=>'multilist','multiple' => 'checkbox')); ?>
</span>
</span> </td>

<?php
		if($loopCounter%4==0)
		{
			echo "</tr><tr>";
		}
	} 
	$loopCounter++;
} 
?>
</tr>	
	

	</tbody>
</table>
<div class="clear"></div>
</div>
