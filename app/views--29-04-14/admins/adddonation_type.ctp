<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/typelist';
?>

<div class="container"> 
<div class="titlCont">
<div class="myclass">

<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right">	
<?php 
$actionRedirect ="adddonation_type";
if($redirect!='')
{
	$actionRedirect ="adddonation_type/".$redirect;
}
echo $form->create("admins", array("action" =>$actionRedirect,'name' => 'adddonation_type', 'id' => "adddonation_type", 'class' => 'adduser'));
     ?>		
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
<?php e($html->image('save.png', array('alt' => 'Save'))); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')">
<?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?>
</button>
<?php  echo $this->renderElement('new_slider');  ?>		
</div>
<span class="titlTxt">Add Donation Type</span>
<div class="topTabs" style="height:25px;">
<?php /*?><ul class="dropdown">
<li>
<button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"> <span> Save </span>	</button>
</li>
<li>
<button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span>
</button>
</li>

</ul><?php */?>
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
		<input type="hidden" id="current_domain" name="current_domain" value="">
		<?php 
		 echo $form->input("DonationType.project_id", array('id' => 'project_id','type'=>'hidden','value'=>'1',  'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));
		
		
		echo $form->input("Link.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
		
		<label class="boldlabel">Type 
		</label>
	</td>
	<td>
	<span class="intpSpan"><?php echo $form->input("DonationType.type", array('id' => 'type', 'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
	</span>
	</td>
</tr>
			
								
						<tr>
							<td align="right"><label class="boldlabel">Note<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="intpSpan" style="vertical-align: top"> 
							<?php echo $form->input("DonationType.note", array('id' => 'note', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?>
							</span>
							</td>
						</tr>
						
						
						
			
				
		
		

	</tbody>
</table>
<div class="clear"></div>
</div>
