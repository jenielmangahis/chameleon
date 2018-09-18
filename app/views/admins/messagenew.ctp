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
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Send A Message</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php if($msgholder){  ?>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>membermessages/<?php echo $msgholder;?>')">
                <?php e($html->image('cancle.png')) ?></button>
                <?php }else{ ?>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>')">
                <?php e($html->image('cancle.png')) ?>
                </button>   
                <?php  }?>
                <?php echo $this->renderElement('new_slider'); ?>		
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
            <?php /*?><ul>
            <?php if($msgholder){  ?>
                  <li><button type="button" id="saveForm" class="btn btn-primary btn-sm"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>membermessages/<?php echo $msgholder;?>')"><span> Cancel</span></button></li>
            <?php }else{ ?>
            <li><button type="button" id="saveForm" class="btn btn-primary btn-sm"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>')"><span> Cancel</span></button></li>    
          <?php  }?>
                
            </ul><?php */?>
        </div>
    </div>
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
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
    </div>
</div>


<div class="midCont table-responsive" >	


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
        <?php echo $form->create("admins", array("action" => "messagenew",'type' => 'file','enctype'=>'multipart/form-data','name' => 'messagenew', 'id' => "messagenew","onsubmit"=>"return validatemsg();"))?>

            <table class="table table-borderless" width="100%" border="0" cellspacing="0" cellpadding="0">


                <tr> <td valign="top" width="140px">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Members <span style="color: red;">*</span></label>
							
							<div  style="margin-top:7px;">
				<span  class="btn-Lft">
				<?php
					e($html->link(
								$html->tag('span', 'Add'),
								array('controller'=>'admins','action'=>'addmember'),
								array('class'=>'btn-Rht btn btn-primary btn-sm','escape' => false)
								)
					);
				?>
				<?php /*?><a href="../addmember" target="_blank" >
				<input type="button" value="Add" name="Add" tabindex=15 class="btn-Rht btn btn-primary btn-sm" /></a><?php */?>
				</span>	</div>
				
                        </div>  </td>   <td valign="top">
                        <span class="txtArea-top" style="margin-bottom: 12px;">
                            <span class="txtArea-bot">
                                <select class="multilist form-control noBg" empty="" size="7" id="recevier_id" name="recevier_id[]" multiple="multiple" >
                                <option value="0">Select All </option>   
                                    <?php if($holderlist){
                                            foreach($holderlist as $holderdata){
											echo "<pre>";
											print_r($holderdata);
											
                                            ?>
                                            <option value="<?php echo $holderdata['Holder']['user_id']."-".$holderdata['Holder']['firstname'];?>" <?php echo ($holderdata['Holder']['id'] === $this->params['pass'][0])?"selected":"" ?>><?php echo $holderdata['Holder']['firstname']." ".$holderdata['Holder']['lastnameshow']; ?></option> 
											
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
                        <span class="intp-Span" style="vertical-align: top;">
                            <input type="text"  name="subject" id="subject"  class="inpt-txt-fld form-control"/>  
                        </span>
                    </td>
                </tr>

                <tr>
                    <td valign="top">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Message <span style="color: red;">*</span></label>
                        </div> </td>
                        <td valign="top">
                      <!--  <span class="txtArea-top" style="width: 300px; background-image: none; padding-top: 0px;  background-color: #EBEBEB;">   
                            <span class="txtArea-bot" style="background-image: none;"> 
                                <textarea cols="41" rows="7" name="message" id="message"  class="form-control noBg" style="border: 1px solid #B1B1B1" ></textarea>  
                            </span>
                        </span> -->
                        
                          <span class="txtArea-top">
                                <span class="txtArea-bot">
                                 <textarea cols="35" rows="4" name="message" id="message"  class="form-control noBg"  ></textarea>
                                 </span>
                            </span>
                    </td>
                </tr>

                <tr>
                    <td >&nbsp;  </td>
                    <td align="left">
                          <button  class="btn btn-primary btn-sm" id="sendmessage" type="submit"><span> Send</span></button>
                    </td>
                </tr>
            </table>
            
              <br />
             <div class="top-bar" style="text-align: left; padding-top: 5px; ">
                <b><span style="color: red;">*</span> Required Field</b>
            </div>
            
            <?php
                echo $form->end();
           ?>
          


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
	
	function addnewcontact(){
	 resWindow1=  window.open (baseUrl+'admins/addmember', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
}
</script>