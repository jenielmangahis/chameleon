<script type="text/javascript">
$(document).ready(function() {
		$('#memBrs').removeClass("butBg");
		$('#memBrs').addClass("butBgSelt");
		});
</script>
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'messagelist';
?>
<style type="">
    .line {
        background: none repeat scroll 0 0 #BDBCBD;
        clear: both;
    }
    .grayText {
        color: #777777;
    }

    .forName {
        border-right: 1px solid white;
        font-size: 12px;
        padding: 5px 12px;
        vertical-align: top;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() { 

        var current_domain=$("#current_domain").val();
        var msgid=$("#getmsgid").val();
              
        if(msgid >0 ){
            $.ajax({
                                url: base_url_admin+'message_reply_by_ajax/'+msgid,
                                cache: false,
                                success: function(html){
                                $('#msgreplylist').html(html);
                                }
                                });

        }


        $("#sendreplylink").click(function(){
            $('#rely').val('');  
            $('#sendreplylink').hide();    
         //   $('#msgdetails').hide();    
            $('#sendreplybox').slideDown(1000);    
        });  

        $("#cancelsendreplybox").click(function(){
            $('#rely').val('');  
            $('#sendreplybox').slideUp(1000);
          //  $('#msgdetails').slideDown(1000);
            $('#sendreplylink').show();        
        });  

        $("#sendreply").click(function(){  
            var msgid=$("#getmsgid").val();   
            var current_domain=$("#current_domain").val();    

            if(trim($('#reply').val()) == '')
                {
                inlineMsg('reply','<strong>Message reply required.</strong>',2);
                return false;
            }
            if(tagValidate($('#reply').val()) == true){
                inlineMsg('reply','<strong>Please dont use script tags.</strong>',2);
                return false; 
            } 

            // document.form_comment_add.submit();  
            $.ajax({
                type:'post',
                dataType:'json',
                cache: false,
                data:$("#form_message_reply").serialize(),
                url : 'http://'+current_domain+'/admins/message_sendreply',
                success : function(res){
                    if(res==1)
                        {
                              $.ajax({
                                url: base_url_admin+'message_reply_by_ajax/'+msgid,
                                cache: false,
                                success: function(html){
                                $('#msgreplylist').html(html);
                                }
                                });
                
                        $('#reply').val('');  
                        $('#sendreplybox').show();                        
                        $('#sendreplybox').slideUp(1000);  
                        $('#sendreplylink').show();   
                        return true;  
                    }
                    else     
                        {  alert("done");    
                          $('#reply').val('');  
                          $('#sendreplylink').show();        
                        setTimeout( "$('#flashMessage').fadeOut();", 2000);            
                        return false;  
                    }
                }
            });


            return false;  
        }); 

    });

    function validatemsg(){
        //alert("validateevent");
        /*  if(trim($('#title').val()) == '')
        {
        inlineMsg('title','<strong>Evnet title required.</strong>',2);
        return false;
        }
        if(tagValidate($('#title').val()) == true){
        inlineMsg('title','<strong>Please dont use script tags.</strong>',2);
        return false; 
        }   */
		
		//alert(document.messagenew.recevier_id.value);
		if ( document.messagenew.recevier_id.value == "" ) {
			inlineMsg('recevier_id','<strong>Please select at least one holder.</strong>',2);     
			return false;  
		}

        if(trim($('#subject').val()) == '') {
            inlineMsg('subject','<strong>Message subject required.</strong>',2);
            return false;
        }
        if(tagValidate($('#subject').val()) == true){
            inlineMsg('subject','<strong>Please dont use script tags.</strong>',2);
            return false; 
        } 

        if(trim($('#message').val()) == '') {
            inlineMsg('message','<strong>Message required.</strong>',2);
            return false;
        }
        if(tagValidate($('#message').val()) == true){
            inlineMsg('message','<strong>Please dont use script tags.</strong>',2);
            return false; 
        } 

        return true;
    }

</script>
<div class="titlCont">
<div style="width:960px; margin:0 auto;">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">			
	
<?php if($msgholder){  ?>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>membermessages/<?php echo $msgholder;?>')">
				<?php e($html->image('cancle.png', array('width' => '42', 'height' => '41'))) ?></button>
            <?php }else{ ?>
            <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>')">
			<?php e($html->image('cancle.png', array('width' => '42', 'height' => '41'))) ?>
			</button>   
          <?php  }?>
		  <?php echo $this->renderElement('new_slider'); ?>		
</div>
			          
        <span class="titlTxt">
           Send A Message
        </span>


        <div class="topTabs" style="height:25px;">
            <?php /*?><ul>
            <?php if($msgholder){  ?>
                  <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>membermessages/<?php echo $msgholder;?>')"><span> Cancel</span></button></li>
            <?php }else{ ?>
            <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>')"><span> Cancel</span></button></li>    
          <?php  }?>
                
            </ul><?php */?>
        </div>
		
		
		 <?php    $this->loginarea="admins";    $this->subtabsel="messagelist";
			
			if($_GET['url'] === 'admins/messagelist/0'){
             echo $this->renderElement('survey_submenus');
				}
				else
			if($_GET['url'] === 'admins/messagelist/1'){
             echo $this->renderElement('memberlistsecondlevel_submenus');
				}
				else{
			echo $this->renderElement('memberlist_submenus');
				
				
				}?>    
    </div></div>


<div class="midCont" >	


    <?php if($session->check('Message.flash')){ ?>
        <div id="blck"> 
            <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;position: absolute; z-index: 11;" /></a>

                    <?php  $session->flash(); 
                        echo $form->error('Event.title', array('class' => 'msgTXt'));
                        //	echo $form->error('Event.company_type_id', array('class' => 'msgTXt'));  ?> 
                </div>
                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
            </div>
        </div>
        <?php }?>


       
        <input type="hidden" id="getmsgid" value="<?php if($msgid==null) {echo "0";}else{ echo $msgid;}?>"/>                                                 
        <?php 
		
		


                echo $form->create("admins", array("action" => "messagenew",'type' => 'file','enctype'=>'multipart/form-data','name' => 'messagenew', 'id' => "messagenew","onsubmit"=>"return validatemsg();"))?>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">


                <tr> <td valign="top" width="140px">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Members <span style="color: red;">*</span></label>
                        </div>  </td>   <td valign="top">
                        <span class="txtArea_top" style="margin-bottom: 12px;">
                            <span class="txtArea_bot">
                                <select class="multilist noBg" empty="" size="7" id="recevier_id" name="recevier_id[]" multiple="multiple" >
                                <option value="0">Dashboard</option>   
                                    <?php if($holderlist){
                                            foreach($holderlist as $holderdata){
                                            ?>
                                            <option value="<?php echo $holderdata['Holder']['user_id']."-".$holderdata['Holder']['firstname'];?>"><?php echo $holderdata['Holder']['firstname'];?></option> 
                                            <?php     } }?>
                                        
                                </select>
                            </span></span>

                    </td>
                </tr> 

                <tr>
                    <td valign="top">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Subject <span style="color: red;">*</span></label>
                        </div>  </td>
                        <td valign="top">
                        <span class="intpSpan" style="vertical-align: top;">
                            <input type="text"  name="subject" id="subject"  class="inpt_txt_fld"/>  
                        </span>
                    </td>
                </tr>

                <tr>
                    <td valign="top">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Message <span style="color: red;">*</span></label>
                        </div> </td>
                        <td valign="top">
                      <!--  <span class="txtArea_top" style="width: 300px; background-image: none; padding-top: 0px;  background-color: #EBEBEB;">   
                            <span class="txtArea_bot" style="background-image: none;"> 
                                <textarea cols="41" rows="7" name="message" id="message"  class="noBg" style="border: 1px solid #B1B1B1" ></textarea>  
                            </span>
                        </span> -->
                        
                          <span class="txtArea_top">
                                <span class="txtArea_bot">
                                 <textarea cols="35" rows="4" name="message" id="message"  class="noBg"  ></textarea>
                                 </span>
                            </span>
                    </td>
                </tr>

                <tr>
                    <td >&nbsp;  </td>
                    <td align="left">
                          <button  class="button" id="sendmessage" type="submit"><span> Send</span></button>
                    </td>
                </tr>
            </table>
            
              <br />
             <div class="top-bar" style="text-align: left; padding-top: 5px; ">
                <b><span style="color: red;">*</span> Required Field</b>
            </div>
            
            <?php
                echo $form->end();
            
            if($msgid==null){<?php /*?>


                echo $form->create("admins", array("action" => "messagenew",'type' => 'file','enctype'=>'multipart/form-data','name' => 'messagenew', 'id' => "messagenew","onsubmit"=>"return validatemsg();"))?>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">


                <tr> <td valign="top" width="140px">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Members <span style="color: red;">*</span></label>
                        </div>  </td>   <td valign="top">
                        <span class="txtArea_top" style="margin-bottom: 12px;">
                            <span class="txtArea_bot">
                                <select class="multilist noBg" empty="" size="7" id="recevier_id" name="recevier_id[]" multiple="multiple" >
                                <option value="0">Dashboard</option>   
                                    <?php if($holderlist){
                                            foreach($holderlist as $holderdata){
                                            ?>
                                            <option value="<?php echo $holderdata['Holder']['user_id']."-".$holderdata['Holder']['firstname'];?>"><?php echo $holderdata['Holder']['firstname'];?></option> 
                                            <?php     } }?>
                                        
                                </select>
                            </span></span>

                    </td>
                </tr> 

                <tr>
                    <td valign="top">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Subject <span style="color: red;">*</span></label>
                        </div>  </td>
                        <td valign="top">
                        <span class="intpSpan" style="vertical-align: top;">
                            <input type="text"  name="subject" id="subject"  class="inpt_txt_fld"/>  
                        </span>
                    </td>
                </tr>

                <tr>
                    <td valign="top">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Message <span style="color: red;">*</span></label>
                        </div> </td>
                        <td valign="top">
                      <!--  <span class="txtArea_top" style="width: 300px; background-image: none; padding-top: 0px;  background-color: #EBEBEB;">   
                            <span class="txtArea_bot" style="background-image: none;"> 
                                <textarea cols="41" rows="7" name="message" id="message"  class="noBg" style="border: 1px solid #B1B1B1" ></textarea>  
                            </span>
                        </span> -->
                        
                          <span class="txtArea_top">
                                <span class="txtArea_bot">
                                 <textarea cols="35" rows="4" name="message" id="message"  class="noBg"  ></textarea>
                                 </span>
                            </span>
                    </td>
                </tr>

                <tr>
                    <td >&nbsp;  </td>
                    <td align="left">
                          <button  class="button" id="sendmessage" type="submit"><span> Send</span></button>
                    </td>
                </tr>
            </table>
            
              <br />
             <div class="top-bar" style="text-align: left; padding-top: 5px; ">
                <b><span style="color: red;">*</span> Required Field</b>
            </div>
            
            <?php
                echo $form->end();
            <?php */?>}else{  ?>
           <?php /*?> <div id="message"  style="width:100%;">
                <div class="blogarticle margin4px">
                    <div class="" style=" margin: 4px;"> 
                        <a style=" font-size: 14px;     padding-left: 0;    text-decoration: none;" id="blogtitle" title="<?php echo $msgInfo['Message']['msg_subject'];?> " href="/admins/messagesnew/<?php echo $msgInfo['Message']['id'];?> "> 
                    <?php echo $msgInfo['Message']['msg_subject'];?>     </a> </div>

                    <div class="grayText margin4px" style=" margin: 4px;">  By <?php echo $msgInfo['Message']['from_holdername'];?> | Sent on <?php echo date("M d, Y", strtotime($msgInfo['Message']['created']));?> </div>
                    <div style=" margin: 4px;">  
                        <span ><?php echo $msgInfo['Message']['msg_content'];?> </span>
                        <span class="srchBg2" style="float: right;" id="sendreplylink">
                            <?php echo $form->button('Reply', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'Reply'));?> 
                        </span> 
                    </div>
                   
                </div>    
            </div>

            <br/>

            <div id="sendreplybox" style="width: 100%; display: none;" >
                <form action="/admins/message_replysend" method="post" id="form_message_reply" name="form_message_reply">
                    <div>
                        <label class="boldlabel"><strong> Reply Message </strong>  </label>
                        <input type="hidden" id="msgid" name="msgid" value="<?php echo $msgInfo['Message']['id'];?>"/>  
                    </div>
                    <br />
                    &nbsp;&nbsp;
                    <span class="txtArea_top">
                        <span class="txtArea_bot"><?php echo $form->textarea("reply", array('id' => 'reply',  'div' => false, 'label' => '','cols' => '35', 'rows' => '5',"class" => "noBg"));?>
                        </span>
                    </span>
                    <div>&nbsp;&nbsp;&nbsp;              
                        <button  class="button" id="sendreply" type="button"><span>Send</span></button>      
                        <button  class="button" id="cancelsendreplybox" type="button"><span>Cancel</span></button>      
                    </div>
                </form> 
            </div>
                                <br/>
               
                 
       <div id="msgreplylist" style="width: 100%;" >    
                    
      </div><?php */?>       
    

            

            <?php }?>
          


    <!--inner-container ends here-->

</div>
</div>
<div class="clear"></div>
<script>
	$("#recevier_id").change(function(){
		var dashboard = false;
		$('select#recevier_id :selected').each(function() {
            //alert($(this).val());
			contactsid = $(this).val();
			//alert(contactsid);
			if(contactsid == 0) {
				dashboard = true;
				return false; 
			}
        });
		
		if(dashboard == true) {
			$("#recevier_id").each(function(){
				$("#recevier_id option").attr("selected","selected");
			});
		}
		
	});  
</script>