
<?php // echo "<pre>"; print_r($commentTypeArray); echo "</pre>"; echo "<pre>"; print_r($coinholderArray); echo "</pre>"; exit;?>

  <!--<option value="">Select suggested comments</option>
  <option value="0">Misc. Comments</option>-->
<?php  
if($commentTypeArray){
    

       foreach($commentTypeArray as $commenttype){
           $comm_type_id= $commenttype['CommentType']['id'];
           $comm_type_name= $commenttype['CommentType']['comment_type_name'];
           echo '<option value="'.$comm_type_id.'">'.$comm_type_name.'</option>'."\n";
    } 
}else{
    ?>
     <option value="">No suggested comments added.</option>
    <?php 
}?>