
<script type="text/javascript">
$(document).ready(function() {
$('#LinkMnu').removeClass("butBg");
$('#LinkMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'links/addresslink';
?>


<div class="container"> 
<div class="titlCont">
<div class="myclass">
    <div align="center" class="slider" id="toppanel" style="height: 20px; top:11px;right: -50px;width:545px !important; text-align:right;"> 
<?php
$actionRedirect ="add_address";
if($redirect!='')
{
	$actionRedirect ="add_address/".$redirect;
}
echo $form->create("links", array("action" => $actionRedirect,'name' => 'LinkAddress', 'id' => "LinkAddress", 'class' => 'adduser'));
     
 ?>
 <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
</button>
<?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt">Add Address</span>
<div class="topTabs">
</div> 
<div class="clear"></div>
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
	<td align="right">
		<?php echo $form->input("LinkAddress.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
		
		<label class="boldlabel">Link Address <span style="color: red;">*</span>
		</label>
	</td>
	<td>
		<span class="intpSpan">
				<?php echo $form->input("LinkAddress.link_address", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
		</span>
	</td>
</tr>
<tr>
	<td align="right">
		<label class="boldlabel">Link Description <span style="color: red;">*</span>
		</label>
	</td>
	<td>

		
		<span class="txtArea_top"> <span class="txtArea_bot"><?php echo $form->input("LinkAddress.description", array('div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg'));?>
								</span>
							</span>
	</td>
</tr>

	</tbody>
</table>
<div class="clear"></div>
</div>
