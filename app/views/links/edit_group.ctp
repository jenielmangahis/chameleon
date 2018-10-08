<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'links/groupslink';
?>
<?php 
	$editLink = "edit_group/".$id;
?>

<div class="container"> 
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
                <h2>Edit Group</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("links", array("action" => $editLink,'name' => 'Group', 'id' => "Group", 'class' => 'adduser'));
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
		<?php echo $form->input("Group.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
		<label class="boldlabel">Group Name <span style="color: red;">*</span>
		</label>
	</td>
	<td>
		<span class=" intp-Span">
				<?php echo $form->input("Group.groupname", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
		</span>
	</td>
</tr>

<tr>
	<td align="right">
		<label class="boldlabel">Group Description <span style="color: red;">*</span>
		</label>
	</td>
	<td>

		
		<span class="txtArea-top"> <span class="txtArea-bot"><?php echo $form->input("Group.discription", array('div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg form-control'));?>
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
