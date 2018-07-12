	<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'links/palcementlink';
?>
<?php 
$actionRedirect ="placement_type";
if($redirect!='')
{
	$actionRedirect ="placement_type/".$redirect;
}
echo $form->create("links", array("action" =>$actionRedirect,'name' => 'PlacementType', 'id' => "PlacementType", 'class' => 'adduser'));
     ?>
<div class="container"> 
<div class="titlCont">


<div class="myclass">
<div align="center" id="toppanel" >
	<?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt">Add Placement Type</span>
<div class="topTabs">
<ul class="dropdown">
<li>
<button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"> <span> Save </span>	</button>
</li>
<li>
<button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span>
</button>
</li>

</ul>
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
		<label class="boldlabel">Placement Type Name <span style="color: red;">*</span>
		</label>
	</td>
	<td>
		<span class="intpSpan">
				<?php echo $form->input("PlacementType.name", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
		</span>
	</td>
</tr>




	</tbody>
</table>
<div class="clear"></div>
</div>
