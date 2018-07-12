<!-- Body Panel starts -->
<?php
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
?>
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
 <script type="text/javascript">
    function setsubmittype(){   
        var is_submit=true;
        var is_email_change=$('#is_email_change').val();
        if(is_email_change==1){
            if(trim($('#email').val()) == '')
                {
                inlineMsg('email','<strong>Email required.</strong>',2);
                is_submit= false;
            }
            if(validemail($('#email').val()) == false){
                inlineMsg('email','<strong>Please enter valid email.</strong>',2);
                is_submit= false; 
            }
            if(tagValidate(trim($('#email').val())) == true){
                inlineMsg('email','<strong>Please dont use script tags.</strong>',2);
                is_submit= false; 
            } 
        }
        if(is_submit){      
            document.email_subscriptions.submit(); 
        }

    }
    
    function validemail(email) {
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
   
   
     if(email=="")
     {
         
         return false;
     }
     if(!email.match(emailRegex))
      {
       
        return false;
      }
     
    return true;
}
  
</script>
<div class="navigation">
    <div class="boxBg">
    </div>
</div>
<?php echo  $form->create('Holder',array('action'=>'/companies/email_subscriptions','enctype'=>'multipart/form-data','id'=>'email_subscriptions','name'=>'email_subscriptions','url'=>$this->here));
 echo $form->hidden('id',array('label'=>false,'div'=>false,'type'=>"text",'id'=>"id", 'value'=> $holderArray['Holder']['id'] )); ?>

<div class="bdyCont">
    <div class="boxBg1">
        <div class="boxBor1">
            <div class="boxPad">
            <?php if($pagetype=="thankyou") {  ?>
               <h2 > <img src="<?php echo $this->webroot."img/imagecoins/active.gif"; ?>">  Thank You </h2> 
               
             
                
                <div style="margin-left: 25px;">
                    <label class="boldlabel" style="margin-left: 50px;"> <em>Your email address and/or subscription preferences <br/>have been updated. Please allow up to 1 day for any changes <br/>to take effect. </em></label> 
                </div>
                  <br/>
                  <br/>                   
                
                
                  <div class="clear"></div>  
                <h2 >Your Email Address</h2> 
                
                <div class="boxBor1">
                    <div class="boxPad" style="margin-left: 25px;">
                        
                        <table width="100%" cellpadding="10" cellspacing="10">
                            <tbody>
                                <tr>
                                    <td> 
                                    <div>
                                    <label class="boldlabel" style="margin-left: 5px;"> <?php echo $holderArray['Holder']['email'];?> </label> 
                                     </div>
                                    
                                    </td>
                                </tr> 
                                 <tr> <td> &nbsp; </td></tr>

                                 <tr> <td> <a href="/companies/email_subscriptions" id="email_subscription"> Your email address and subscription preferences </a> </td></tr>
                                 <tr> <td> 
                                <?php
                                if(!empty($project['Project']['url'])){
                                     $pos = strpos($project['Project']['url'],"http://");
                                     if ($pos === false) {
                                         $projecturl="http://".$project['Project']['url'];
                                     }else{
                                         $projecturl=$project['Project']['url'];
                                     }
                                     
                                   }
                                  else{
                                       $projecturl="http://".$_SERVER['HTTP_HOST']."/".$project['Project']['project_name'];
                                  } 
                                ?> 
                                 <a href="<?php echo $projecturl;?>" id="change_email"> Go to <?php echo  $projecturl; ?> </a> </td></tr>
                              
                            </tbody>
                        </table>
                        
                     
                    </div>
                </div>   
              
                  <div class="clear"></div>  
                          
           <?php  }else{?>
                <h2 style="float:left;">Email Subscription Settings</h2>
                
                <div style="float: left; position: relative;width: auto;margin-left:727px; margin-top:-30px;">  
                        <div style="float:right;height: 30px;position:relative;background-color:#209f20; width: auto;" class="border_shadow" id="save_apply_bg">
                            <ul class="dash_menu_opp" style="margin-left: 5px; margin-right: 3px;"> 
                                <li style="border-right:2px solid white;"><a onclick="return setsubmittype('save');"><span>Save</span></a></li>
                                <li><a href="/companies/update_profile"><span>Cancel</span></a></li>    
                            </ul>  
                        </div>
                    </div>
                
                <div class="clear"></div>
                <div><label class='lbl'>&nbsp;<span style="color:red">&nbsp;</span></label>
                    <?php if($session->check('Message.flash')){ $session->flash(); } ?>
                </div>
                <div class="clear"></div>

                <div class="boxBor1">
                    <div class="boxPad" style="margin-left: 25px;">
                        <!--<h4>Current Subscriptions  </h4>-->
                        <table width="100%" cellpadding="5" cellspacing="10">
                            <tbody>
                               <!--  <tr>
                                    <td><input type="checkbox" id="is_direct_email"  name="data[Holder][is_direct_email]" value="1" < ?php if($holderArray['Holder']['is_direct_email']=="1") echo 'checked="checked" '; ?> > <label class="boldlabel" style="margin-left: 5px;"> Direct Mail Only</label>
                                    <br/><em> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note:You will no longer receive any promotional group emails. You will only receive emails directed to you.</em>
                                    </td>
                                 </tr>
                                        
                                         <tr>
                                            <td align="center"> <label class="boldlabel" style="margin-left: 5px;"> - OR - </label></td>
                                        </tr>  -->
                                <?php 
                                    $selectedTypes=array();
                                    $selectedTypes=explode(",", $holderArray['Holder']['subscription_type_id']);

                                    if($userSubscriptionTypes){     
                                        foreach($userSubscriptionTypes as $subscriptionType){
                                                  $typeid=$subscriptionType['UserSubscriptionType']['id'];
                                                  $type=$subscriptionType['UserSubscriptionType']['subscription_type'];
                                                  if($subscriptionType['UserSubscriptionType']['type_description']!=""){
                                                     $type.=" (<span style='font-size: 11px;'>".$subscriptionType['UserSubscriptionType']['type_description']."</span>)";
                                                  }
                                                  
                                            if(in_array($typeid, $selectedTypes)){
                                                $chk='checked="checked" ';
                                            }else{
                                                $chk='';
                                            }
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" class="subscription_type_checks" <?php echo $chk;?> name="data[Holder][subscription_type_id][]" value="<?php echo $typeid;?>" > <label class="boldlabel" style="margin-left: 5px;"> <?php echo $type;  ?></label></td>
                                        </tr>
                                        <?php } 
                                    } ?>
                            </tbody>
                        </table>
                        
                     
                    </div>
                </div>
                 <div class="clear"></div>  
                <h2 >Your current email address</h2>  
                <div class="boxBor1">
                    <div class="boxPad" style="margin-left: 25px;">
                        
                        <table width="100%" cellpadding="10" cellspacing="10">
                            <tbody>
                                <tr>
                                    <td> 
                                    <div id="div_change_email">
                                    <label class="boldlabel" style="margin-left: 5px;"> <?php echo $holderArray['Holder']['email'];?> </label>  
                                    <br/>   <br/>    
                                  <!--  <span class="flx_button_lft ">
                                            <input type="button" id="change_email" value="Change Email Address" class="flx_flexible_btn"> 
                                        </span>  <br/>-->
                                      <a href="javascript:void(0);" id="change_email"> Change your email address</a>
                                    </div>
                                    
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td> 
                                    <div id="show_change_email" style="display: none;"> 
                                        <div class="updat"  style="width: auto;">
                                            <label class="boldlabel">Email </label>
                                        </div>
                                         <span class="intpSpan">
                                            <?php echo $form->input('email',array('label'=>false,'div'=>false,'type'=>"text",'id'=>"email",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox', 'value'=> $holderArray['Holder']['email'] )); ?>
                                        </span>
                                           <?php echo $form->hidden('is_email_change',array('label'=>false,'div'=>false,'id'=>"is_email_change",'value'=> "0" )); ?>
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                     
                    </div>
                </div> 
                
                 <div class="clear"></div>   
                <div id="dialog-confirm" title="Change email address?">
                    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>The changed email will be your new login email.Do you want to change email?</p>
                </div>
                
                <?php } ?>               
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>
<!-- Body Panel ends --> 

<script type="text/javascript">


$(document).ready(function()
{
            
        $('#show_change_email').hide();
        $('#is_email_change').val("0");
        
       /*  if($('#is_direct_email').is(":checked"))  {  
                    $(".subscription_type_checks").removeAttr("checked");
                    $(".subscription_type_checks").attr("disabled", true); 
         }else{       
                    $(".subscription_type_checks").removeAttr("disabled");   
         } */
        
     /*   $('#change_email').click(function(){
        
            $('#show_change_email').show();    
            $('#div_change_email').hide();    
            $('#is_email_change').val("1");    
        });*/
        
     /*   $('#is_direct_email').click(function(){
               
               if($(this).is(":checked"))  {  
                    $(".subscription_type_checks").removeAttr("checked");
                    $(".subscription_type_checks").attr("disabled", true); 
               }else{       
                    $(".subscription_type_checks").removeAttr("disabled");   
               }
                
       });  */
       
      /*  $('#goto_email_subscription').click(function(){
        
            window.location="/companies/email_subscriptions";
            $('#show_change_email').show();    
            $('#div_change_email').hide();    
            $('#is_email_change').val("1");  
        });
                                        */  
});


  $(function() {
        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
       // $( "#dialog:ui-dialog" ).dialog( "destroy" );
      /*  $( "#dialog-confirm" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "blind"
        });
           */
      $("#dialog-confirm").dialog({
      autoOpen: false,
      modal: true
    });
        $( "#change_email" ).click(function() {
            
            $( "#dialog-confirm" ).dialog({
            resizable: false,
            width:385,
            height:140,
            modal: true,
            buttons: {
                 "Cancel" : function() {
                    $( this ).dialog( "close" );
                },
                "Change Email Address" : function() {
                    $( this ).dialog( "close" );
                     $('#show_change_email').show();    
                     $('#div_change_email').hide();    
                     $('#is_email_change').val("1");    
                }
               
            }      
        });
        
         $("#dialog-confirm").dialog("open");
         
            return false;
        });
        
       
    });
    
</script>          
        
<script language='javascript'>
    function hidemessage(){
        if(document.getElementById("flashMessage")!=null)
            document.getElementById("flashMessage").style.display="none";

    }
</script>

