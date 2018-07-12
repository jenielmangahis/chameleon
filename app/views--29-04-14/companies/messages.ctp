<?php $pagination->setPaging($paging); ?> 
<?php //echo $this->Html->script('jquery-1.4.2.min',false);   ?>
<?php echo "<pre><!-- USER ID-";echo ($uid); echo "--></pre>"; ?>
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
                <div style="float: left; position: relative;width: 700px;margin-left:198px; margin-top:-30px;">     
                    <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow" id="leftmenubar_bg">
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
                <p class=""><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></p>
                
                <div style="width: 100%;">
                <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>"/>
                <input type="hidden" id="folder" value="<?php echo $folder;?>"/>
                <input type="hidden" id="msg_offset" value="<?php echo $msg_offset;?>"/>
                <input type="hidden" id="msg_start" value="0"/>
                <div style="width: 100%;" align='right' id="sendmsglink"><a href="javascript:void(0);"  class="orangeTextBold"> New Message</a> </div>
                <div id="sendmsgbox" style="width: 100%; display: none;" >
                        <!--<form action="message_send" method="post" id="form_message_send" name="form_message_send">-->
						 <?php echo $form->create("Companies", array("action" => "message_send",'id'=>'form_message_send', 'name' => 'form_message_send'))?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <!--  <tr><td width="25%" >&nbsp; </td>    
                                <td width="75%" class="forName">
                                <span id="errormsg" style="display: none; font-size: 11px; color: red;"></span></td></tr> -->
                                <tr> <td valign="top">
                                        <div class="updat" style="vertical-align: top;">
                                            <label class="boldlabel">Members <span style="color: red;">*</span></label>
                                        </div>
                                        <span class="txtArea_top" style="margin-bottom: 12px;">
                                            <span class="txtArea_bot">
                                                <select class="multilist noBg" empty="" size="7" id="recevier_id" name="recevier_id[]" multiple="multiple" >  
                                                    <option value="" style="font-weight: bold;" class="multilistoptions">Send To</option> 
                                                    <?php if($sponsordetails){ ?>
                                                        <option value="<?php echo $sponsordetails['Sponsor']['id']."-".$sponsordetails['Sponsor']['sponsor_name']."-sponsor";?>" class="multilistoptions"><?php echo "Project Manager - ".$sponsordetails['Sponsor']['sponsor_name'];?></option>  
                                                    <?php } ?>
                                                    <?php if($holderlist){
                                                            foreach($holderlist as $holderdata){
                                                            ?>
                                                            <option value="<?php echo $holderdata['Holder']['id']."-".$holderdata['Holder']['screenname']."-holder";?>" class="multilistoptions" ><?php echo $holderdata['Holder']['screenname'];?></option> 
                                                            <?php     } }else{ ?>
                                                        <option value="" class="multilistoptions">No holders</option>  
                                                        <?php     }?>
                                                </select>
                                            </span></span>

                                    </td>
                                </tr>   

                                <tr>
                                    <td valign="top">
                                        <div class="updat" style="vertical-align: top;">
                                            <label class="boldlabel">Subject <span style="color: red;">*</span></label>
                                        </div>
                                        <span class="intpSpan" style="vertical-align: top;">
                                            <input type="text"  name="subject" id="subject"  class="inpt_txt_fld"/>  
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top">
                                        <div class="updat" style="vertical-align: top;">
                                            <label class="boldlabel">Message <span style="color: red;">*</span></label>
                                        </div>
                                        <span class="txtArea_top">   <span class="txtArea_bot"> 
                                                <textarea cols="35" rows="3" name="message" id="message"  class="noBg" ></textarea>  
                                            </span>
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="updat">
                                            <label class="boldlabel">&nbsp;</label>
                                        </div>
                                        <span class="flx_button_lft " id="sendmessage">
                                            <?php echo $form->button('Send', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'share_commnet'));?>
                                        </span>
                                        <span class="flx_button_lft " id="cancelsendmsgbox">
                                            <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'share_commnet'));?>
                                        </span>
                                    </td>

                                </tr>
                            </table>
                       <?php 	echo $form->end();?>
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
        var url = baseUrl+'show_request/'+holder_id+'/'+project_id+'/'+coin_serial;            
        jQuery.facebox({ ajax: url });
    }

    function closewindow(){
        jQuery(document).trigger('close.facebox');
    }
    $(document).ready(function() { 

        // var country_data = $(this).val();
         var current_domain=$("#current_domain").val();
         var folder=$("#folder").val();
         var msg_start=parseInt($("#msg_start").val()); 
         var msg_offset= parseInt($("#msg_offset").val());
          $('#messagelist').fadeOut();
           $.ajax({
                                url: baseUrl+'companies/messages_get_by_ajax/'+msg_start+'/'+msg_offset+'/'+folder,
                                cache: false,
                                success: function(html){
                                        $('#messagelist').html(html);
                                        $("#msg_start").val(0);
                                        $('#messagelist').fadeIn(); 
                                         messageAction();
                                }
                                });

          
       $("#sendmsglink").click(function(){
               $('#sendmsglink').hide();    
               $('#sendmsgbox').slideDown(1000);    
        });  
        
         $("#cancelsendmsgbox").click(function(){
                 $('#sendmsgbox').slideUp(1000);
                 $('#sendmsglink').show();        
        });  
        
       $("#sendmessage").click(function(){  
              
                var current_domain=$("#current_domain").val();    
              var chk= validatemsg();
              if(chk==true){
                  // document.form_comment_add.submit();  
                   $.ajax({
                    type:'post',
                    dataType:'json',
                    cache:false,
                    data:$("#form_message_send").serialize(),
                    url : baseUrl+'companies/message_send',
                    success : function(res){
                        if(res==1)
                            {         $('#subject').val('');  
                                      $('#message').val('');  
                                      $('#sendmsglink').show();    
                                      $('#sendmsgbox').slideUp(1000);  
                                      $("#flashMessage").addClass("successmsg");
                                      $("#flashMessage").html("Your message sent successfully!</strong>");
                                      $("#flashMessage").show();
                                      setTimeout( "$('#flashMessage').hide();", 2000);
                                                                       
                                      var folder=$("#folder").val();
                                     var msg_start=parseInt($("#msg_start").val()); 
                                     var msg_offset= parseInt($("#msg_offset").val());
                                     
                                      
                                        $.ajax({
                                        url: baseUrl+'companies/messages_get_by_ajax/'+msg_start+'/'+msg_offset+'/'+folder,
                                        cache: false,
                                        success: function(html){
                                              $('#messagelist').hide();
                                               $('#messagelist').html(html);
                                               $("#msg_start").val(msg_start);
                                               $('#messagelist').slideDown(1000); 
                                               messageAction();
                                        }
                                        });
                                
                                     
          
                                      return true;  
                        }
                        else
                            {    $('#message').val('');  
                                 $("#flashMessage").addClass("errormsg");
                                 $("#flashMessage").html("Oops! There seems to be some problem. Please try in some time.");
                                 $("#flashMessage").show();  
                                 setTimeout( "$('#flashMessage').fadeOut();", 2000);           
                                 return false;  
                        }
                    }
                });
              }
       

        
             return false;  
         }); 
         
       function messageAction(){
           
       $("#inboxlink").unbind('click'); 
       $("#inboxlink").click(function(){
                var current_domain=$("#current_domain").val();
                 var folder='inbox';
                 $("#folder").val(folder);
                 var msg_start=0; 
                 var msg_offset= parseInt($("#msg_offset").val());
                 $('#messagelist').fadeOut();
                 $.ajax({
                                url: baseUrl+'companies/messages_get_by_ajax/'+msg_start+'/'+msg_offset+'/'+folder,
                                cache: false,
                                success: function(html){
                                        $('#messagelist').html(html);
                                         $("#msg_start").val(msg_start);
                                        $('#messagelist').fadeIn(); 
                                         messageAction();
                                }
                                });
                                
                 
        });   
         
         $("#sentboxlink").unbind('click');
         $("#sentboxlink").click(function(){
                var current_domain=$("#current_domain").val();
                 var folder='sent';
                 $("#folder").val(folder);
                 var msg_start=0; 
                 var msg_offset= parseInt($("#msg_offset").val());
                 $('#messagelist').fadeOut();
                  $.ajax({
                                url: baseUrl+'companies/messages_get_by_ajax/'+msg_start+'/'+msg_offset+'/'+folder,
                                cache: false,
                                success: function(html){
                                        $('#messagelist').html(html);
                                         $("#msg_start").val(msg_start);
                                        $('#messagelist').fadeIn(); 
                                         messageAction();
                                }
                                });
                  
        }); 
        
         $("#prevmsg").unbind('click'); 
       $("#prevmsg").click(function(){
                var current_domain=$("#current_domain").val();
                 var folder=$("#folder").val();
                 var msg_offset= parseInt($("#msg_offset").val());
                 var msg_start=parseInt($("#msg_start").val()) - msg_offset;
                 if(msg_start >=0) {
                     $('#messagelist').fadeOut();
                      $.ajax({
                                url: baseUrl+'companies/messages_get_by_ajax/'+msg_start+'/'+msg_offset+'/'+folder,
                                cache: false,
                                success: function(html){
                                        $('#messagelist').html(html);
                                         $("#msg_start").val(msg_start);
                                        $('#messagelist').fadeIn(); 
                                         messageAction();
                                }
                                });
                                
                    
                 } 
        });   
        
       $("#nextmsg").unbind('click'); 
       $("#nextmsg").click(function(){
                var current_domain=$("#current_domain").val();
                 var folder=$("#folder").val();
                 $("#folder").val(folder);
                  var totalmsg= parseInt($("#totalmsg").val());
                  var msg_offset= parseInt($("#msg_offset").val());
                 var msg_start=parseInt($("#msg_start").val()) + msg_offset;
                   if(msg_start < totalmsg) {  
                         $('#messagelist').fadeOut();
                          $.ajax({
                                url: baseUrl+'companies/messages_get_by_ajax/'+msg_start+'/'+msg_offset+'/'+folder,
                                cache: false,
                                success: function(html){
                                        $('#messagelist').html(html);
                                         $("#msg_start").val(msg_start);
                                        $('#messagelist').fadeIn(); 
                                         messageAction();
                                }
                                });
                         
                   }    
        }); 
        
     
      } 
      
       function validatemsg(){
                         
              if(trim($('#subject').val()) == '')
             {
                 inlineMsg('subject','<strong>Message subject required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#subject').val()) == true){
                 inlineMsg('subject','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
             
              if(trim($('#message').val()) == '')
             {
                 inlineMsg('message','<strong>Message required.</strong>',2);
                 return false;
             }
             if(tagValidate($('#message').val()) == true){
                 inlineMsg('message','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
              
             
           return true;
       }
      
    });
</script>
