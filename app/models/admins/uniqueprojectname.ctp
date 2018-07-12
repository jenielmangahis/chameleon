<div class="errormsg">
<?php if($err==1) { ?>
Project Name should be alphanumeric and contain no spaces.
<?php } else { ?>
Project with same name already exists.
<?php } ?>
</div>
<?php echo $form->hidden('projectalready', array( 'value' => $errormsg,'id' => 'projectalready') );?>