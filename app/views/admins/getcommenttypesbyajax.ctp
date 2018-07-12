<?php       
 //echo $form->select("$modelname.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); 
      echo '<option value="">---Select---</option>';
  foreach($commenttypedropdown as $key=>$template){
      $sel='';
      if($key== $selectedid){
          $sel='selected="selected"';
      }
      echo '<option value="'.$key.'" '.$sel.'>'.$template.'</option>';
  }
 
 ?>