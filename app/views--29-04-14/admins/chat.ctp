  <style type="">
  /* Classes */
   
  </style>
  <?php 
    $project_name_default='default';
    echo $javascript->link('/js/'.$project_name_default.'/chatpage.js'); ?>
<div class="boxBg1">
  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black"><?php 
     if($project['Project']['system_name']!=""){
              echo ucfirst($project['Project']['system_name'])."'s";  
            }else{
              echo ucfirst($project['Project']['project_name'])."'s";    
            } ?> Chat</font><br />

            <?php if($userid){
               ?> 
                   <table width="100%">
            <tr> <td colspan="2">&nbsp;
            <input type="hidden" id="msg_sending" value="0">
            <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>">
            <input type="hidden" id="current_domainurl" name="current_domainurl" value="<?php echo $current_domain;?>">
            <input type="hidden" id="chatmsg_offset" name="chatmsg_offset" value="0">
            <input type="hidden" id="pre_chatmsg_offset" name="chatmsg_offset" value="0">
            </td></tr>
            <tr>
                    <td width="25%" valign="top" id="onlinememberlist">
                    <!-- Online member list -->
                    </td>
                    
                    <td width="75%" valign="top" >
                          <table width="100%" style="border: 2px solid #E8E8E8;">
                              <tr>
                                      <td width="70%">

                                                     <div id="chat_window" style="padding: 5px;"> 
                                                     
                                                    <script language='javascript'>
                                                        chatWith("Chat"); 
                                                        //chatJoin();
                                                    </script>
                                                     <?php if($username && $user_is_chatjoined=='1'){ ?>
                                                          <script language='javascript'>
                                                        //chatWith("Chat"); 
                                                        chatJoin();
                                                    </script>
                                                    <?php   } ?>
                                                </div>

                                                <div class="forName">
                                                        <?php if($username){ ?>
                                                        <input type="button" id="join_chat" value="Join Chat" class="btn" <?php if($user_is_chatjoined=='1'){ echo 'style="display: none;"'; } ?>>
                                                        <input type="button" id="leave_chat" value="Leave Chat" class="btn"  <?php if($user_is_chatjoined=='0'){ echo 'style="display: none;"'; } ?>>
                                                        <?php  } ?>
                                                </div>
                                      </td>
                                      <td width="29%" class="paddBot" valign="top" id="chatmemberlist">
                                      <!-- Online member list -->
                                       </td>
                              </tr>
                          </table>

                    </td>
                    
                  
               </tr>
            </table>
            
                    <script type="text/javascript">


    $(document).ready(function()
    {
        
         // var country_data = $(this).val();
         var current_domain=$("#current_domain").val();
         loadChatMembers();
         
       
   
        $("#join_chat").click(function(){ 
            var current_domain=$("#current_domain").val();      

            $.ajax({
                type : "POST",
                dataType: "json",
                cache: false,
                url: "http://"+current_domain+"/companies/chat_join",
                success : function(result){
                    if(result == 1)
                        {
                        //alert("Responded successfully!");   
                        $('#join_chat').hide();
                        $('#leave_chat').show();
                        chatJoin();
                        loadChatMembers();
                        /* $('#eventinvitelist').load('http://'+current_domain+'/companies/get_eventinvitations_by_ajax/0/10', function(){
                        //  $("#comment_start").val(0);
                        $('#eventinvitelist').slideDown(1000); 
                        eventinviteactions();
                        });  */     

                    }
                    else
                        {
                        alert("Oops! There seems to be some problem. Please try in some time."); 
                    }
                } 
            });

        }); 


        $("#leave_chat").click(function(){ 
            var current_domain=$("#current_domain").val();      

            $.ajax({
                type : "POST",
                dataType: "json",
                cache: false,
                url: "http://"+current_domain+"/companies/chat_leave",
                success : function(result){
                    if(result == 1)
                        {
                        //alert("Responded successfully!");   
                        $('#leave_chat').hide();
                        $('#join_chat').show();
                        chatLeave();
                      loadChatMembers();

                    }
                    else
                        {
                        alert("Oops! There seems to be some problem. Please try in some time."); 
                    }
                } 
            });

        }); 

    });
    
     function loadChatMembers(){
         var timer_is_on=0;
        var c=0;
         var current_domain=$("#current_domain").val();
           c=c+1;
            if(c>10){
                c=0;
            }
              $.ajax({
                        url:'http://'+current_domain+'/companies/chat_onlinememberlist',
                        cache: false,
                        success: function(html){
                             $('#onlinememberlist').html(html);
                           
                        }
                    }); 
            
         // $('#onlinememberlist').load('http://'+current_domain+'/companies/chat_onlinememberlist', function(){ });
         
           $.ajax({
                        url:'http://'+current_domain+'/companies/chat_joinedmemberlist',
                        cache: false,
                        success: function(html){
                             $('#chatmemberlist').html(html);
                           
                        }
                    }); 
        //  $('#chatmemberlist').load('http://'+current_domain+'/companies/chat_joinedmemberlist', function(){ });
          t=setTimeout("loadChatMembers();",60000*2); 
        } 
        
</script>
            <?php }else { ?>
             <table width="100%">
                    <tr> <td>&nbsp;</td></tr>
                    <tr> <td align="center"> <strong> You Must Register and Become a Member to View Live Chat. </strong> </td></tr>
                    <tr> <td>&nbsp;</td></tr>
            </table>
                
           <?php }?>
    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
  <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

  
