<?php 
	$strOption='';
	foreach($companydata as $companyarr){
		$strOption.="<option value='".$companyarr['Company']['id']."'>".$companyarr['Company']['company_name']."</option>";
	}
	echo $strOption;
				  
?>