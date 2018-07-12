<?php                        
 //echo $form->select("$modelname.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); 
      echo '<option value="">---Select---</option>';
  foreach($contentpages as $eachpage){
      $sel='';
      $key=$eachpage['Content']['id'];
      $val=$eachpage['Content']['title'];     
      if($key== $selectedid){
          $sel='selected="selected"';
      }
      echo '<option value="'.$key.'" '.$sel.'>'.$val.'</option>';
  }
 
 ?>