<?php  
 //echo $form->select("$modelname.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); 
      echo '<option value="">---Select---</option>';
  foreach($templatedropdown as $template){
      $sel='';
      if($template['EmailTemplate']['id']== $selectedid){
          $sel='selected="selected"';
      }
      echo '<option value="'.$template['EmailTemplate']['id'].'" '.$sel.'>'.$template['EmailTemplate']['email_template_name'].'</option>';
  }
 
 ?>