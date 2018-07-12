<option selected="selected" value="0">-----Select-----</option>
<?php 
	if (count($commTypes) == 1) {
		$selected = 'selected="selected"';
	}
	else {
		$selected = '';
	}
	
	foreach ($commTypes as $key => $commType) : 
?>
<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $commType;?></option>
<?php endforeach;?>
