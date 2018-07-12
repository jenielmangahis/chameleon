<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'links/videoslink';
?>

<div class="container"> 
<div class="titlCont">


<div class="myclass">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">
<?php echo $form->create("links", array("action" => "add_video",'name' => 'Video', 'id' => "Video", 'class' => 'adduser','enctype'=>'multipart/form-data'));
?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png')); ?>	</button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
</button>
	<?php  echo $this->renderElement('new_slider');  ?>
</div>

<span class="titlTxt">Add Video</span>
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
		<label class="boldlabel">Video Name <span style="color: red;">*</span>
		</label>
	</td>
	<td>
		<span class="intpSpan">
				<?php echo $form->input("Video.video_name", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
		</span>
	</td>
</tr>					
					
<tr>
<td align="right">
		<?php echo $form->input("Video.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>

<label class="boldlabel">Video Link Address<span
style="color: red;">*</span>
</label></td>

<td>
		<span class="intpSpan">
				<?php echo $form->input("Video.video_link_address", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
		</span>
</td>
</tr>


<tr>
	<td align="right">
		<label class="boldlabel">Video File <span style="color: red;">*</span>
		</label>
	</td>
	<td>
		<span class="intpSpan">
				<?php echo $form->input("Video.video_file", array('div' => false, 'label' => '',"class"=>"inpt_file_fld fileUpload",'type'=>'file'));?>
				<?php echo $form->input("videoUpload", array('div' => false, 'label' => '','name'=>'videoUpload', 'style' =>'width:200px;',"class"=>"inpt_txt_fld fileUploadtext","maxlength" => "250","readonly"=>"readonly","value" => $this->data['Video']['video_file']));?>
				<span class="btnLft addBut"><input type="button"  name="Add" value="Add" class="btnRht">
							</span>
		</span>
	</td>
</tr>

<tr>
	<td align="right">
		<label class="boldlabel">Video Description <span style="color: red;">*</span>
		</label>
	</td>
	<td>

		
		<span class="txtArea_top"> <span class="txtArea_bot"><?php echo $form->input("Video.description", array('div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg'));?>
								</span>
							</span>
	</td>
</tr>

	</tbody>
</table>
<div class="clear"></div>
</div>
<script type="text/javascript">
$("document").ready(function(){
    $("#VideoVideoFile").change(function() {
    			var fileName = $('#VideoVideoFile').val();
    			$('#linksVideoUpload').removeAttr("readonly");
    			$('#linksVideoUpload').val(fileName);
    			$('#linksVideoUpload').attr("readonly",true);
            });
});
</script>