<?php $pagination->setPaging($paging); ?> 
<?php //echo $this->Html->script('jquery-1.4.2.min',false); 
$base_url = Configure::read('App.base_url');
?>
<?php 

?>
<script type="javascript/text" language="javascript" src="js/jquery-1.4.2.min.js"> </script>
<!-- Body Panel starts -->
<div class="navigation">
    <div class="boxBg">
     
    </div>
</div>
<div class="bdyCont">
    <div class="boxBg1">
        <div class="boxBor1">
            <div class="boxPad">
                <h2 style="float:left;">Messages</h2>
                <div style="float: left; position: relative;width: 650px;margin-left:198px; margin-top:-30px;">     
                    <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow">
                        <?php echo $this->element("leftmenubar");?>  
                    </div>
                </div>   
                <br />
                <br />
                <br /> 
                <div class="clear"></div>
                <br />
                <div><span align='center'> <div id="flashMessage" style="display: none;"></div>
                <?php //if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
                <p class=""><?php echo $html->image('../img/'.$project_name.'/spacer.gif');?></p>
                 <div class="clear"></div>      
                <div style="width: 100%;">
                <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>"/>
                <input type="hidden" id="folder" value="<?php // if($this->data['Message']['folder_id']==1){ echo "inbox"; }else{ echo "sent"; };?>"/>
                 <div id="blog">
                    <div class="blogarticle margin4px">
                        <div class="blogtitle margin4px"> 
                        
							

							<?php
								e($html->link(
									stripslashes($msgInfo['Message']['msg_subject']),
									array('controller'=>'companies','action'=>'messages_view',$msgInfo['Message']['id']),
									array('escape' => false,'id'=>'blogtitle','title'=>stripslashes($msgInfo['Message']['msg_subject']))
									)
								);
							?>


						</div>

                        <div class="grayText margin4px">By <?php echo str_replace($holder_name,"Me",$msgInfo['Message']['from_holdername']);?> | Sent on <?php echo date("M d, Y", strtotime($msgInfo['Message']['created']));?> </div>
                        <div class="margin4px">
                            <span><?php echo stripslashes($msgInfo['Message']['msg_content']);?> </span>
                            <span style="float: right;" id="sendreplylink"><a href="javascript:void(0);"  class="orangeTextBold"> Reply</a> </span> 
                        </div>
                        <!-- <div class="line margin4px"><img alt="" src="/img/WolfTest/spacer.gif"> </div> -->
                    </div>    
               </div>
                
                <br/>
               
                <div id="sendreplybox" style="width: 100%; display: none;" >
                       <!-- <form action="message_replysend" method="post" id="form_message_reply" name="form_message_reply">-->

						 <?php echo $form->create("Companies", array("action" => "message_replysend",'id'=>'form_message_reply', 'name' => 'form_message_reply'))?>

                            <div>
                                <label class="boldlabel">&nbsp;&nbsp;&nbsp;Reply Message </label>
                                <input type="hidden" id="msgid" name="msgid" value="<?php echo $msgInfo['Message']['id'];?>"/>  
                            </div>
                            <br />
                            &nbsp;&nbsp;
                            <span class="txtArea_top">
                                <span class="txtArea_bot"><?php echo $form->textarea("reply", array('id' => 'reply',  'div' => false, 'label' => '','cols' => '35', 'rows' => '5',"class" => "noBg"));?>
                                </span>
                            </span>
                            <div>&nbsp;&nbsp;&nbsp;              
                                    <span class="flx_button_lft " id="sendreply">
                                          <?php echo $form->button('Send', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'share_commnet'));?>
                                    </span>
                                                
                                    <span class="flx_button_lft " id="cancelsendreplybox">
                                          <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'share_commnet'));?>
                                     </span>
                                <?php // echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/'.$project_name.'"'));?>
                            </div>
                     <!--</form> -->
					 	<?php 	echo $form->end();?>

                </div>
                      <br/>
               
                 <div id="msgreplylist" style="width: 100%;" >    
                    <!--  Message replies comes here -->
                 </div>
                  <div class="clear"></div>      
                </div>

                <br/>
                <div width="100%" id="messagelist">
                <!-- Message list here -->
                </div>

                <p class="clear"></p>

                <p class="margin8px" ></p>   
            </div>
        </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
        </p>

    </div>
</div>
<div class="clear"></div>
<!-- Body Panel ends --> 

<script language='javascript'>
    function showrequestwindow(holder_id,project_id,coin_serial){
        var url = baseUrl+'companies/show_request/'+holder_id+'/'+project_id+'/'+coin_serial;            
        jQuery.facebox({ ajax: url });
    }

    function closewindow(){
        jQuery(document).trigger('close.facebox');
    }
    $(document).ready(function() { 

         var current_domain=$("#current_domain").val();
         var msgid=$("#msgid").val();

         $('#msgreplylist').load(baseUrl+'companies/message_reply_by_ajax/'+msgid);
        
         $("#sendreplylink").click(function(){
               $('#rely').val('');  
               $('#sendreplylink').hide();    
               $('#msgdetails').hide();    
               $('#sendreplybox').slideDown(1000);    
        });  
        
         $("#cancelsendreplybox").click(function(){
                 $('#rely').val('');  
                 $('#sendreplybox').slideUp(1000);
                 $('#msgdetails').slideDown(1000);
                 $('#sendreplylink').show();        
        });  
        
        $("#sendreply").click(function(){  
            
                var current_domain=$("#current_domain").val();    
           
       // document.form_comment_add.submit();  
                   $.ajax({
                    type:'post',
                    dataType:'json',
                    data:$("#form_message_reply").serialize(),
                    url : baseUrl+'companies/message_sendreply',
                    success : function(res){
                        if(res==1)
                            {        
                                      $('#rely').val('');  
                                      $('#sendreplybox').show();    
                                      $('#msgdetails').show();    
                                      $('#sendreplybox').slideUp(1000);  
                                      $("#flashMessage").addClass("successmsg");
                                      $("#flashMessage").html("Your reply sent successfully!");
                                      $("#flashMessage").show();
                                      setTimeout( "$('#flashMessage').fadeOut();", 2000);     
                                        
                                      var msgid=$("#msgid").val();
                                      $('#msgreplylist').load(baseUrl+'companies/message_reply_by_ajax/'+msgid);
                                      return true;  
                        }
                        else
                            {    $('#reply').val('');  
                                 $("#flashMessage").addClass("errormsg");
                                 $("#flashMessage").html("Oops! There seems to be some problem. Please try in some time.");
                                 $("#flashMessage").show(); 
                                  setTimeout( "$('#flashMessage').fadeOut();", 2000);            
                                 return false;  
                        }
                    }
                });

        
             return false;  
         }); 
      
    });

  


</script>
