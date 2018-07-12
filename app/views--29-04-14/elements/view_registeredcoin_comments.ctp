
<?php 
 // $coinholderid=62;     

  $coinholderArray=  $this->requestAction('/companies/get_coindetails/'.$coinholderid);    
  $commentTypeArray = $this->requestAction('/companies/view_registeredcoin_commenttypes/'.$coinholderid);
      $serialnum = $coinholderArray['CoinsHolder']['serialnum'];
                    if(preg_match('/[A-Z]{3}/', $serialnum)==1){
                    $coinsname= preg_split('/[A-Z]{3}/', $serialnum);
                    $serialnum=$coinsname[1];
                    }
        
  //echo "Hello element content is...<pre>"; print_r($commentTypeArray); echo "</pre>";  exit; 

  //echo "<pre>"; print_r($coinholderArray); echo "</pre>";
    $default_comment_array=array("CommentType"=> array(
    "id"=>0,
    "comment_type_name"=> "Whatever you like",
    "comment_type_purpose"=> "Please enter whatever you like"
    
    )
    );
    array_push($commentTypeArray, $default_comment_array);
?>
        

<?php      $cnt=0;
       foreach($commentTypeArray as $commenttype){
           $comm_type_id= $commenttype['CommentType']['id'];
           $comm_type_name= $commenttype['CommentType']['comment_type_name'];
             // DebugBreak();
               $commentArray = $this->requestAction('/companies/view_registeredcoin_comments/'.$coinholderid."/".$comm_type_id); 
               $cls_bg="";
               if($commentArray['Comment']['comment']!=""){
                $cls_bg="";   
               }else{
                     $cls_bg="bgLightBlueColor";    
               }
    ?>

        <table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
    <td width="10%" class="forName " ><?php if($cnt==0) echo $serialnum; ?></td>
    <td width="10%" class="forName " > <?php if($cnt==0)  echo date("m-d-Y", strtotime($coinholderArray['CoinsHolder']['created']));  ?></td>
    <td width="10%" class="forName " ><?php if($commentArray['Comment']['created']!=""){ echo date("m-d-Y", strtotime($commentArray['Comment']['created'])); }?> </td> 
    <td width="20%" class="forName <?php echo $cls_bg;?>" ><?php echo $comm_type_name;?> </td> 
    <td width="39%" class="forName <?php echo $cls_bg;?>"  >
    <?php if($commentArray['Comment']['comment']!=""){ 
              $comment_id= $commentArray['Comment']['id'];    
               if($commentArray['Comment']['locked']!="0"){  echo $commentArray['Comment']['comment']; }else{    ?>
       <a href="javascript:void(0);" title="double click to update comment" id="plzcomment_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>" ><?php echo $commentArray['Comment']['comment'];?></a>  
       <?php    }?> 
       <input type="hidden" id="comment_purpose_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>" value="<?php  echo $commentArray['Comment']['comment'];?>"/>          
    <?php }else{ $comment_id= 0;        ?>
           <a href="javascript:void(0);" title="double click to add comment" id="plzcomment_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>" >Please Comment&nbsp;</a> 
           <input type="hidden" id="comment_purpose_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>" value="<?php  echo $commenttype['CommentType']['comment_type_purpose'];?>">          
    <?php }?>
             <form action="/companies/save_comment" method="post" id="form_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>">
     
       <div width="100%" id="addcomment_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>" style="display: none;">
       <input type="hidden" name="comment_type_id" value="<?php  echo $commenttype['CommentType']['id'];?>"/>
       <input type="hidden" name="comment_id" value="<?php  echo $comment_id;?>"/> 
       <input type="hidden" name="coin_holder_id" value="<?php  echo $coinholderArray['CoinsHolder']['id'];?>"/>   
       <input type="hidden" name="coinset_id" value="<?php  echo $coinholderArray['CoinsHolder']['coinset_id'];?>"/>   
       <textarea name="comment" id="comment_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>"  rows="5" cols="38" class="margin8px"> </textarea>
       <br/>
       <span class="flx_button_comment" class="margin8px">
       <span class="flx_button_lft"  class="marginRight4px">
       <input type="submit" class="flx_flexible_btn" id="savecomment_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>" value="Save"> 
      </span>
        <span class="flx_button_lft ">
          <input type="button" class="flx_flexible_btn" id="cancelcomment_<?php echo $coinholderArray['CoinsHolder']['id'];?>_<?php  echo $commenttype['CommentType']['id'];?>" value="Cancel">  
       </span>
        </span>
       </div> 
       </form>
     </td>    
</tr>
 <tr><td colspan="5" class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr> 
</table>

<?php  $cnt=1;} ?>

<script type="text/javascript" language="javascript">
 $(document).ready(function() {    

    $("a[id^='plzcomment_']").dblclick(function(){

  
  var $this = $(this);
  var idarr = $this.attr('id').split('_');
 
  var commentbox="addcomment_"+idarr[1]+"_"+idarr[2];
   var default_comment = $("#comment_purpose_"+idarr[1]+"_"+idarr[2]).val();

   $("#comment_"+idarr[1]+"_"+idarr[2]).val(default_comment);
   $this.hide();
   $("#"+commentbox).show();
});

 $("input[id^='cancelcomment_']").click(function(){ 
      var $this = $(this);
      var idarr = $this.attr('id').split('_');
      var commentbox=idarr[1]+"_"+idarr[2];
      $("#comment_"+idarr[1]+"_"+idarr[2]).val(''); 
      $("#addcomment_"+commentbox).hide();
       $("#plzcomment_"+commentbox).show();   

 });  


});
</script>