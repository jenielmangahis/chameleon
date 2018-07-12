 <?php  
 echo $this->element("admin_css"); 
                 if(isset($folder)=='sent')  {
                     $usrtitle="To";
                             $getusrid= "to_id";
                          }else{
                               $usrtitle="From";   
                              $getusrid= "from_id";      
                          }
                ?>
 <!-- <div width="100%" style="width: 100%;">
  <span class="< ?php if($msgfolder=='inbox'){ echo "msgFolderActive"; }else{ echo "msgFolder"; }?>" ><a href="javascript: void(0);" id="inboxlink" >Inbox</a></span>
  <span class="< ?php if($msgfolder=='sent'){ echo "msgFolderActive"; }else{ echo "msgFolder"; }?>" ><a href="javascript: void(0);" id="sentboxlink">Sent</a></span>
 </div> -->
 <input type="hidden" id="totalmsg" value="<?php echo $totalmsgcount['totalmsg'];?>"/> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border_shadow">
                    <tr>
                      <!--  <td width="5%" class="forName frmTitles" ></td>   -->
                        <td width="15%" class="forName frmTitles">From</td> 
                        <td width="23%" class="forName frmTitles">Sent To</td> 
                        <td width="50%" class="forName frmTitles">Message</td> 
                        <td width="12%" class="forName frmTitles">Date</td> 
                  </tr>
                    <?php  
                        if($msgArray){ 
                            $alt=0;  
                        foreach($msgArray as $msg){
                           if($alt%2==0)
                                $class="style='background-color:#FFF;'";
                           else
                                $class="style='background-color:#E8E8E8;'"; 
                             $alt++;     
                        if($msg['MessageHolder']['is_new']=='1'){
                            $readclass="unreadMsg";
                        }else{
                            $readclass="readMsg";
                        } 

                        ?>
                         <tr <?php echo $class; ?> class="<?php echo $readclass;?>">
                      <!--  <td  class="forName " ><input type="checkbox" name="msgid[]" value="< ?php echo $msg['Message']['id']; ?>"> < ?php //echo $msg['Message']['id']; ?></td> -->
                        <td class="forName ">
							<?php echo substr(ucfirst(str_replace($holder_name,"Me",$msg['Message']['from_holdername'])),0,20);?>
						</td> 
                        <td class="forName ">
							<?php echo substr(ucfirst(str_replace($holder_name,"Me",$msg['Message']['to_holdername'])),0,25);?>
						</td> 
                        <td  class="forName ">
							<a href="messages_view/<?php echo $msg['Message']['id']; ?>" id="viewmsg_<?php echo $msg['Message']['id']; ?>"> 
								<?php echo stripslashes($msg['Message']['msg_subject']); ?>
							 <span class="grayText readMsg" > - <?php 
							 $msg_content =str_replace("<br />", "", str_replace('\n',"",$msg['Message']['msg_content']));
						  echo stripslashes($msg_content);
                        /*echo substr( str_replace("<br />", "", str_replace('\n',"",$msg['Message']['msg_content'])), 0 ,50)."..."; ****/
						   ?> </span>
						  </a>
					</td> 
                        <td  class="forName "><?php echo date("M d, Y", strtotime($msg['Message']['created']));?></td> 
                        </tr>
                         <tr><td colspan="4" class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr>     
                        <?php    }   
                        }else {

                        ?>
                            <tr><td colspan="4" class="forName" align=center>There are no messages to display.</td></tr>

                    
                        <?php }?>
                </table>
                <div width="100%" align="right" class="margin8px">
               <?php if($msg_start > 0) {?> <a href="javascript: void(0);" id="prevmsg" style="font-size: 11px; font-weight: bold;"> &larr; Prev </a>  <?php } ?>
                <?php if(($msg_start+$msg_offset) < $totalmsgcount['totalmsg']) {?> <a  href="javascript: void(0);" id="nextmsg"style="font-size: 11px; font-weight: bold;">  Next &rarr; </a>  <?php } ?> 
                </div>
<script type="text/javascript" language="javascript">



/* $(document).ready(function() {    

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


}); */
</script>