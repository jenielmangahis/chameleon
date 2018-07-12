<?php echo $form->select("$modelname.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist','onchange' => 'changeval();'),"---Select---"); ?>
<script type="text/javascript">
  function changeval()
		{
			document.getElementById('newstate').value=document.getElementById('state').value;
			//alert(document.getElementById('newstate').value);
		}
</script>