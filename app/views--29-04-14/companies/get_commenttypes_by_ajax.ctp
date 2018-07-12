<?php  
if($commentTypeArray){
    

       foreach($commentTypeArray as $commenttype){
           $comm_type_id= $commenttype['CommentType']['id'];
           $comm_type_name= $commenttype['CommentType']['comment_type_name']; ?>
           
           <option value="<?php echo $comm_type_id; ?>"><?php echo $comm_type_name; ?></option>
   <?php } 
}else{
    ?>
     <option value="">Suggested comments not available.</option>
    <?php 
}?>