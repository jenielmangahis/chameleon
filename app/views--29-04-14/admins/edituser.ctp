
<script type="text/javascript">
$(document).ready(function() {
$('#LinkMnu').removeClass("butBg");
$('#LinkMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/userslist';
?>


</script>
<?php 
	$editLink = "edituser/".$id;
?>

<div class="container"> 
<div class="titlCont">
<div class="myclass">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">	
<?php echo $form->create("Admin", array("action" => "edituser",'name' => 'Admin', 'id' => "Admin", 'class' => 'adduser')); ?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png')); ?>	</button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
</button>
<?php  echo $this->renderElement('new_slider');  ?>
</div>
<div class="topTabs" style="height:25px;"></div>
<span class="titlTxt">Edit User</span> 
<div class="clear"></div>
<?php $this->mail_tasks="tabSelt"; ?>  
<?php    $this->loginarea="setups";    $this->subtabsel="userslist";
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
	<td align="right"><label class="boldlabel">User Type<span
									style="color: red;">*</span>
							</label></td>
							<td>
			<span class="txtArea_top"> 
				<span class="txtArea_bot"> 
<?php
$utselected = $oldData['Admin']['user_type'];
echo $form->select("user_type",$formtypedata,$utselected,array('id' => 'user_type','class'=>'multilist'),array('0'=>'--Select--'));?>
								</span>
							</span></td>
						</tr>

	<tr>
		<td align="right">
			<label class="boldlabel">First Name<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input("firstname", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	
	
	
	
	
	<tr>
		<td align="right">
			<label class="boldlabel">Last Name<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input("lastname", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	
	<tr>
		<td align="right">
			<label class="boldlabel">User Name<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input("username", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>


<tr>
		<td align="right">
			<label class="boldlabel">Email Address<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input("email", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	


<tr>
		<td align="right">
			<label class="boldlabel">Phone Number<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input("phone", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	
<tr>
		<td align="right">
			<label class="boldlabel">Old Password<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input('oldpassword',array('label'=>'',"class" => "inpt_txt_fld",'div'=>false,'type'=>"password", 'id'=>"oldpassword",'size'=>'40','value'=>'',  )) ?>
			</span>
		</td>	
	</tr>
	
	
	
<tr>
		<td align="right">
			<label class="boldlabel">New Password<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input('password',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"password",'size'=>'40','value'=>'', "class" => "inpt_txt_fld" )) ?>
			</span>
		</td>	
	</tr>
	
	
	<tr>
		<td align="right">
			<label class="boldlabel">Confirm Password<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intpSpan">
					<?php echo $form->input('confirm_password',array('label'=>'','div'=>false,'type'=>"password", 'id'=>"confirm_password",'size'=>'40','value'=>'', "class" => "inpt_txt_fld" )) ?>
			</span>
		</td>	
	</tr>
	
	
	

	
					<?php
					
				/*	foreach ($getmenu as $key => $value) {
					
					
					
					
					 $menu_id = $value['Menu']['id'];
					//echo $menu_name = $value['Menu']['name']."<br>sunil";
				
$query = mysql_query("SELECT * FROM `iteams` WHERE pid = '".$menu_id."'");

$i = 0 ;
while($row = mysql_fetch_assoc($query))
  {
  	$i++ ;
  if($menu_id === $row['pid']){
  	echo "<pre>";
  	print_r($row['name']);
  	echo $i." = ".$form->input('checkbox_field', array('type'=>'checkbox'));
  }
  echo "_______________";
  }

					}

				*/			
					?>
	

	</tbody>
</table>
<div class="clear"></div>
</div>
