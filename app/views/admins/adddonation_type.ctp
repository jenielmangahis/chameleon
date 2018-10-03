<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/typelist';
?>

<div class="container"> 
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
                <h2>Add Donation Type</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
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
            </div>
        </div>


<!--<div class="myclass">

<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right">	
		
</div>
<span class="titlTxt"></span>
 
<div class="clear"></div>
   
</div>-->

<?php $this->mail_tasks="tabSelt"; ?>
</div>
<div class="midPadd clearfix" id="addcmp">

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
		<input type="hidden" id="current_domain" name="current_domain" value="">
		<?php 
		 echo $form->input("DonationType.project_id", array('id' => 'project_id','type'=>'hidden','value'=>'1',  'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control"));
		
		
		echo $form->input("Link.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
		
		<label class="boldlabel">Type 
		</label>
	</td>
	<td>
	<span class="intp-Span"><?php echo $form->input("DonationType.type", array('id' => 'type', 'div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
	</span>
	</td>
</tr>
			
								
						<tr>
							<td align="right"><label class="boldlabel">Note<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="intp-Span" style="vertical-align: top"> 
							<?php echo $form->input("DonationType.note", array('id' => 'note', 'div' => false, 'label' => '','style' =>'width:100%;',"class" => "inpt-txt-fld form-control"));?>
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
