<?php  
 //echo $form->select("$modelname.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); 
      echo '<option value="">---Select---</option>';
  foreach($companytypedropdown as $key=>$type){
      $sel='';
      if($key== $selectedid){
          $sel='selected="selected"';
      }
      echo '<option value="'.$key.'" '.$sel.'>'.$type.'</option>';
  }
 
 ?>
 