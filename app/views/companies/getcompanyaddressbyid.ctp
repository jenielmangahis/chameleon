<?php  
echo $form->hidden("companyaddress1", array('id' => 'companyaddress1','value'=>"$varaddress1"));
echo $form->hidden("companyaddress2", array('id' => 'companyaddress2','value'=>"$varaddress2"));
echo $form->hidden("companycity", array('id' => 'companycity','value'=>"$varcity"));
echo $form->hidden("companystate", array('id' => 'companystate','value'=>"$varstate"));
echo $form->hidden("companycountry", array('id' => 'companycountry','value'=>"$varcountry"));
echo $form->hidden("companyzipcode", array('id' => 'companyzipcode','value'=>"$varzipcode")); 


echo $form->hidden("tempaddress1", array('id' => 'tempaddress1'));
echo $form->hidden("tempaddress2", array('id' => 'tempaddress2'));
echo $form->hidden("tempcity", array('id' => 'tempcity'));
echo $form->hidden("tempstate", array('id' => 'tempstate'));
echo $form->hidden("tempcountry", array('id' => 'tempcountry'));
echo $form->hidden("tempzipcode", array('id' => 'tempzipcode')); 
?>