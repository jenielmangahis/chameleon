<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'links/videoslink';
?>
<?php 
	$editLink = "edit_video/".$id;
?>

<div class="container"> 
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
                <h2>Add Video</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("links", array("action" => $editLink,'name' => 'Video', 'id' => "Video", 'class' => 'adduser','enctype'=>'multipart/form-data'));
					?>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png')); ?></button>
					
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
					</button>
					<?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
        </div>

<?php $this->mail_tasks="tabSelt"; ?>  
</div>


<div class="midCont" id="addcmp">

<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          

<br />

<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
<table cellspacing="0" cellpadding="0" align="left" width="90%">
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
		<span class="intp-Span">
				<?php echo $form->input("Video.video_name", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
		</span>
	</td>
</tr>					
					
<tr>
<td align="right">
		<?php echo $form->input("Video.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>

<label class="boldlabel">Video Link Address<span
style="color: red;">*</span>
</label></td>
<td>
		<span class="intp-Span">
				<?php echo $form->input("Video.video_link_address", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
		</span>
 </td>
</tr>


<tr>
	<td align="right">
		<label class="boldlabel">Video File <span style="color: red;">*</span>
		</label>
	</td>
	<td>
		<span class="intp-Span">
				<?php echo $form->input("Video.video_file", array('div' => false, 'label' => '',"class"=>"inpt-file-fld file-Upload",'type'=>'file'));?>
				<?php echo $form->input("videoUpload", array('div' => false, 'label' => '','name'=>'videoUpload', 'style' =>'width:100%; margin:10px 0;',"class"=>"inpt-txt-fld form-control fileUpload-text","maxlength" => "250","readonly"=>"readonly","value" => $this->data['Video']['video_file']));?>
				<span class="btn-Lft "><input type="button"  name="Add" value="Add" class="btn-Rht btn btn-primary btn-sm">
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

		
		<span class="txtArea-top"> <span class="txtArea-bot"><?php echo $form->input("Video.description", array('div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg form-control'));?>
								</span>
							</span>
	</td>
</tr>

	</tbody>
</table>

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