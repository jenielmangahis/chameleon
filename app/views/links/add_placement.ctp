<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'links/palcementlink';
?>
<?php 
$actionRedirect ="add_placement";
if($redirect!='')
{
	$actionRedirect ="add_placement/".$redirect;
}
?>
<div class="container"> 
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
                <h2>Add Placement</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("links", array("action" =>$actionRedirect,'name' => 'Placement', 'id' => "Placement", 'class' => 'adduser'));
					 ?>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?>	</button>
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
<table cellspacing="0" cellpadding="0" align="left" width="100%">
	<tbody>
		<tr>
			<td width="50%" valign="top">
				<table cellspacing="10" cellpadding="0" align="left" width="90%">
					<tbody>



<tr>
	<td align="right">
		<label class="boldlabel">Link Placement Name <span style="color: red;">*</span>
		</label>
	</td>
	<td>
		<span class="intp-Span">
				<?php echo $form->input("Placement.place_name", array('div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
				
						<?php echo $form->input("Placement.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
		</span>
	</td>
</tr>


<tr>
	<td align="right">
		<label class="boldlabel">Placement Description 
		</label>
	</td>
	<td>

		
		<span class="txtArea-top "> <span class="txtArea-bot"><?php echo $form->input("Placement.description", array('div' => false, 'label' => '','rows'=>'8','cols'=>'36','class' =>'noBg form-control'));?>
								</span>
							</span>
	</td>
</tr>

	</tbody>
</table>
<div class="clear"></div>
</div>

<script type="text/javascript">

 function addpalcementType() {   
             $('#email_template_id').focus();
 //            var resWindow=  window.open (baseUrl+'links/placement_type');
 //            resWindow.focus();
 				window.location = baseUrl+'links/placement_type/@';
           }

</script>