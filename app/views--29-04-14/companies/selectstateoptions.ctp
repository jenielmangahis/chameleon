<?php  // DebugBreak();
 //echo $form->select("$modelname.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); 
      echo '<option value="">---Select---</option>';
  foreach($statedropdown as $key=>$state){
      echo '<option value="'.$key.'">'.$state.'</option>';
  }
 
 ?>