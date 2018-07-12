<?php 
$paging='';
	$pagination->setPaging($paging); ?> 
<?php //echo $this->Html->script('jquery-1.4.2.min',false);   ?>
<?php echo "<pre><!-- USER ID-";echo ($uid); echo "--></pre>"; ?>
<script type="javascript/text" language="javascript" src="js/jquery-1.4.2.min.js"> </script>
<!-- Body Panel starts -->
<div class="navigation">
    <div class="boxBg">

        <!--<div class="boxBor">
        <div class="boxPad">
        <?php //echo $this->element("leftmenubar");?>  

        <p>&nbsp;</p>
        </div>
        </div><p class="boxBot1">
        <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>-->

    </div>
</div>
<div class="bdyCont">
    <div class="boxBg1">
        <div class="boxBor1">
            <div class="boxPad">
                <h2 style="float:left;">Coins & Comments</h2>
                <div style="float: left; position: relative;width: 700px;margin-left:198px; margin-top:-30px;">     
                    <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow" id="leftmenubar_bg">
                            <?php
                               if(isset($_SESSION['iframe_session'])){
                                    echo $this->element("iframe_menubar"); 
									}
                                else
								{
								  echo $this->element("leftmenubar");
								}
                          ?>  
                    </div>
                </div>
                <br />
                <br />
                <br /> 
                <div class="clear"></div>
                <br />
                <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
                <p class=""><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></p>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border_shadow">
                     <tr>
                        <!-- Left Side - Coin listing column -->
                            <td  width="17%" class="new_forName  borderRightGray" valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">      
                                    <tr><td class="new_forName " width="100%" align="center"> <span class="boldlabel remaining_text" style="font-size: 13px;"> Relate Your <br/>Comment To <br/> A Coin? </span>
                                     <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain; ?>">
                                     <input type="hidden" id="comment_start" name="comment_start" value="0">
                                     <input type="hidden" id="comment_offset" name="comment_offset" value="<?php echo $comment_offset; ?>"></td></tr>   
                                   
                                     <tr><td class="new_forName " width="100%" align="center">
                                     <span id="coin_0" class="orangeTextBold coinseriallist">No Coin</span></td></tr>
                                    
                                    <tr><td class="new_forName orangeTextBold" width="100%" align="center">Your Coins</td></tr>
                                    <?php 
                                    if(sizeof($coinholderArray)> 0){
                                    foreach($coinholderArray as $convalue){ 
                                            $serialnum = $convalue['CoinsHolder']['serialnum'];
                                            if(preg_match('/[A-Z]{3}/', $serialnum)==1){
                                                $coinsname= preg_split('/[A-Z]{3}/', $serialnum);
                                                $serialnum=$coinsname[1];
                                               } ?>
                                        <tr><td class="new_forName boldlabel grayText coinlist" align="center"><span class="coinseriallist" id="coin_<?php echo $convalue['CoinsHolder']['id'];?>"><?php echo $serialnum; ?></span></td></tr>
                                        <?php }
                                        } else{
                                        ?>
                                        <tr><td class="new_forName grayText coinlist" align="center"> NA </td></tr>
                                        <?php
                                        }
                                        ?>
                                         <tr><td class="new_forName orangeTextBold" width="100%" align="center">Other Coins</td></tr> 
                                          <?php 
                                           if(sizeof($otherCoinsArray)> 0){
                                          foreach($otherCoinsArray as $othercoin){ 
                                            $otherserialnum = $othercoin['CoinsHolder']['serialnum'];
                                            if(preg_match('/[A-Z]{3}/', $otherserialnum)==1){
                                                $othercoinsname= preg_split('/[A-Z]{3}/', $otherserialnum);
                                                $otherserialnum=$othercoinsname[1];
                                        } ?>    
                                         <tr><td class="new_forName boldlabel grayText coinlist" align="center"><span class="coinseriallist" id="coin_<?php echo $othercoin['CoinsHolder']['id'];?>"><?php echo $otherserialnum; ?></span></td></tr>
                                         <?php }
                                        } else{
                                        ?>
                                        <tr><td class="new_forName grayText coinlist" align="center"> NA </td></tr>
                                        <?php
                                        }
                                        ?>  
                                </table>
                            </td>
                        
                        <!-- Right side - Coin comments and replys -->
                            <td  width="83%" class="new_forName" valign="top" > 
                             
                               <!-- START : Comment Sharing form --> 
                                
                                <form action="save_comment" method="post" id="form_comment_add" name="form_comment_add">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><td width="65%" >&nbsp; </td>    <td width="35%" class="new_forName">
                                        <span id="errormsg" style="display: none; font-size: 11px; color: red;"></span>
                                        </td></tr> 
                                        <tr>
                                            <td  class="new_forName orangeTextBold"  align="right">Comment Related to :</td>
                                            <td  class="new_forName orangeTextBold" id="selected_coin">
                                            <small class="grayText">Pick a coin by clicking on coin serial under your coins section</small></td>
                                        </tr>                                                                                                                                                       
                                        <tr>
                                            <td width="25%" class="new_forName orangeTextBold" align="right">Choose Suggested Comment Below :</td>
                                            <td width="75%" class="new_forName orangeTextBold" >Please Comment </td>
                                        </tr>
                                        <tr>
                                            <td  class="new_forName" style="width:320px;"> 
                                                    <input type="hidden" name="coin_holder_id" id="coin_holder_id" value="">
                                                    <input type="hidden" name="comment_id" id="comment_id" value="">
                                                    <span class="intpSpan" style="width:320px;">
                                                    <select id="comment_type_id" name="comment_type_id" class="inpt_commenttype_fld dropdown_class" style="max-width: 320px;">
                                                       <!--<option value="">Select suggested comments</option> 
                                                        <option value="0">Misc. Comments</option>-->
                                                </select> </span></td>
                                            <td  class="new_forName" >
                                                <span class="txtArea_top">   <span class="txtArea_bot"> 
                                                        <textarea cols="35" rows="4" name="comment" id="comment"  class="noBg" >Share your thought...</textarea>  
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="new_forName orangeTextBold" >&nbsp;</td>
                                            <td  class="new_forName orangeTextBold"  align="right">
                                                <span class="flx_button_lft ">
                                                    <?php echo $form->button('Share', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'share_commnet'));?>
                                                </span>
                                            </td>
                                        </tr>
                                        </table>
                                </form> 
                                 <!-- END : Comment Sharing form -->   
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">        
                                    <tr>      
                                        <td>&nbsp;</td>
                                    </tr>

                                     <tr>      
                                        <td width="100%"> 
                                           <div width="100%" id="comment_list">
                                           <!--  load comments by ajax -->
                                           </div>
                                           
                                        </td>
                                    </tr>
                                     <tr>      
                                        <td width="100%" align="right">   &nbsp;</td>
                                    </tr>
                                      <tr>      
                                        <td width="100%" align="right">   <span id="morecomment" class="orangeTextBold coinseriallist" >See More</span></td>
                                    </tr>
                                </table>

                            </td>   

                        </tr>
                        <?php  // }?>
                </table>

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

        loadcommnettype();
        // var country_data = $(this).val();
         var current_domain=$("#current_domain").val();
         var comment_start=parseInt($("#comment_start").val()); 
         var commnet_offset= parseInt($("#comment_offset").val());
          $('#comment_list').hide();
          
           $.ajax({
                        url: baseUrl+'companies/get_registeredcoin_comments_by_ajax/'+comment_start+'/'+commnet_offset,
                        cache: false,
                        success: function(html){
                             $('#comment_list').html(html);
                             $("#comment_start").val(commnet_offset);
                             $('#comment_list').slideDown(1000); 
                              commentactions();
                        }
                    });
                                           
        
        
        $("#morecomment").click(function(){

                 var commnet_offset= parseInt($("#comment_offset").val());
                 var comments=parseInt($("#comment_start").val())+commnet_offset; 
                
                 $.ajax({
                        url: baseUrl+'companies/get_registeredcoin_comments_by_ajax/0/'+comments,
                        cache: false,
                        success: function(html){
                            $("#comment_start").val(comments);
                             $('#comment_list').html(html);
                              $('#comment_list').slideDown(1000); 
                        commentactions();
                        }
                    });
                   
        });
        
         $("#comment").focus(function(){
            if($("#comment").val() == "Share your thought...")
            {
                $("#comment").val("");
            }
        }).blur(function(){
            if($("#comment").val() == "")
            {
                $("#comment").val("Share your thought...");
            }
        });
      
      function commentactions()  {
        $("#share_commnet").unbind("click");
        $("#share_commnet").click(function(){
        //   alert("share_commnet");
           updatecomment();
        });
        $("span[id^='coin_']").unbind("click");
        $("span[id^='coin_']").click(function(){

            var $this = $(this);
            var idarr = $this.attr('id').split('_');
            $('#coin_holder_id').val(idarr[1]);
            // $('#coinset_id').val(idarr[2]);
            $(".coinlist").removeClass("grayText coinlist");     
            $("#selected_coin").html($this.html());
            $this.addClass("grayText coinlist")   
       //     var country_data = $(this).val();
            var current_domain=$("#current_domain").val();
             $.ajax({
                        url: baseUrl+'companies/get_commenttypes_by_ajax/'+idarr[1],
                        cache: false,
                        success: function(html){
                             $('#comment_type_id').html(html);
                              commentactions();
                        }
                    });
            
        });
        
        /**
        * Reply to comment
        */
        $("span[id^='replycomment_']").unbind("click");   
        $("span[id^='replycomment_']").click(function(){

            var $this = $(this);
            var idarr = $this.attr('id').split('_');
            $this.hide();
            $("#replyto_"+idarr[1]+"_"+idarr[2]).slideDown();
       });
       
           $("textarea[id^='reply_']").focus(function(){
               
            var $this = $(this);
            if($this.val() == "Reply to comment...")
               $this.val(''); 
            
           
        }).blur(function(){
            var $this = $(this);
            if($this.val() == "")
                $this.val("Reply to comment...");
            
        });
     
          $("span[id^='savereply_']").unbind("click");
          $("span[id^='savereply_']").click(function(){

            var $this = $(this);
            var idarr = $this.attr('id').split('_');
            var frmname="replyform_"+idarr[1]+"_"+idarr[2];
            $.ajax({
                    type:'post',
                    dataType:'json',
                    cache: false,
                    data:$("#replyform_"+idarr[1]+"_"+idarr[2]).serialize(),
                    url : baseUrl+'companies/save_comment_reply',
                    success : function(res){
                        if(res= 1)
                            {          var comment_start=0; 
                                       var commnet_offset= parseInt($("#comment_offset").val());
                                         $.ajax({
                                            url: baseUrl+'companies/get_registeredcoin_comments_by_ajax/'+comment_start+'/'+commnet_offset,
                                            cache: false,
                                            success: function(html){
                                                  $('#comment_list').html(html);
                                                  $("#comment_start").val(0);
                                                  $('#comment_list').slideDown(1000); 
                                                        $("#errormsg").html('<span style="color: green;"><strong>Thank you for giving reply.</strong>');
                                                  $("#errormsg").slideDown(1000);
                                                  setTimeout( function() {
                                                        jQuery('#errormsg').hide(1000);
                                                        }, 2000 );
                                                  commentactions();
                                            }
                                        });
                                        
                        }
                        else
                            {     //$('#comment').val('');  
                                 $("#errormsg").html("<strong>Oops! There seems to be some problem. Please try in some time.</strong>");
                                 $("#errormsg").slideDown(1000);
                                 setTimeout( function() {
                                                jQuery('#errormsg').hide(1000);
                                                }, 2000 );
                        }
                    }
                });  
    });
   
         $("span[id^='cancelreply_']").unbind("click");
         $("span[id^='cancelreply_']").click(function(){
            var $this = $(this);
            var idarr = $this.attr('id').split('_');
          
           $("#replyto_"+idarr[1]+"_"+idarr[2]).slideUp();
           $("#replycomment_"+idarr[1]+"_"+idarr[2]).show(); 
     });
     
     
     /**
     *  Follow and Unfollow comments
     */
          $("a[id^='followcomment_']").unbind("click");
          $("a[id^='followcomment_']").click(function(){
              
               var $this = $(this);
               var idarr = $this.attr('id').split('_');
                
               if(idarr[1]) {
                     $("#favorite_"+idarr[1]).hide();
           
                    $.ajax({
                        type:'post',
                        dataType:'json',
                        cache: false,
                        data: {commentid : idarr[1]},
                        url : baseUrl+'companies/view_registercoin_comment_follow',
                        success : function(res){
                            if(res= 1)
                                {   //    alert("done");
                                      var newfavhtml='<a href="javascript:void(0);" title="Unfollow Comment" id="unfollowcomment_'+idarr[1]+'"class="orangeTextBold">Unfollow</a>'; 
                                        $("#favorite_"+idarr[1]).html(newfavhtml);
                                        $("#favorite_"+idarr[1]).show();  
                                        commentactions();  
                                }
                            else
                                {   
                                     alert("error");
                                     $("#favorite_"+idarr[1]).show();    
                                   //  $("#errormsg").html("<strong>Oops! There seems to be some problem. Please try in some time.</strong>");
                            }
                        }
                    });   
              }
           }); 
           
            $("a[id^='unfollowcomment_']").unbind("click");
            $("a[id^='unfollowcomment_']").click(function(){
               var $this = $(this);
               var idarr = $this.attr('id').split('_');
               
               if(idarr[1]) {
                      $("#favorite_"+idarr[1]).hide();
           
                    $.ajax({
                        type:'post',
                        dataType:'json',
                        cache: false,
                        data: {commentid : idarr[1]},
                        url : baseUrl+'companies/view_registercoin_comment_unfollow',
                        success : function(res){
                            if(res= 1)
                                {   //    alert("done");
                                      var newfavhtml='<a href="javascript:void(0);" title="Follow Comment" id="followcomment_'+idarr[1]+'" class="orangeTextBold">Follow</a>';
                                       $("#favorite_"+idarr[1]).html(newfavhtml);     
                                        $("#favorite_"+idarr[1]).show(); 
                                        commentactions();   
                                }
                            else
                                {   
                                     alert("error");
                                     $("#favorite_"+idarr[1]).show();    
                                   //  $("#errormsg").html("<strong>Oops! There seems to be some problem. Please try in some time.</strong>");
                            }
                        }
                    });   
              }
           }); 
           
           
         /**
         * Update comments      
         */
         
          $("a[id^='editcomment_']").unbind("dblclick");   
          $("a[id^='editcomment_']").dblclick(function(){

            var $this = $(this);
            var idarr = $this.attr('id').split('_');
            $this.hide();
            $("#updatecommenttdesc_"+idarr[1]).slideDown();

        });
        
         $("span[id^='cancelupdate_']").unbind("click");
         $("span[id^='cancelupdate_']").click(function(){
            var $this = $(this);
            var idarr = $this.attr('id').split('_');
          
           $("#updatecommenttdesc_"+idarr[1]).slideUp();
           $("#editcomment_"+idarr[1]).show(); 
        });
       
       
              $("span[id^='updatecomment_']").unbind("click");
              $("span[id^='updatecomment_']").click(function(){

                var $this = $(this);
                var idarr = $this.attr('id').split('_');
                var frmname="upcommentform_"+idarr[1];
                $.ajax({
                        type:'post',
                        dataType:'json',
                        cache: false,
                        data:$("#upcommentform_"+idarr[1]).serialize(),
                        url : baseUrl+'companies/save_comment',
                        success : function(res){
                            if(res= 1)
                                {          var comment_start=0; 
                                           var commnet_offset= parseInt($("#comment_offset").val());
                                            $.ajax({
                                                    url: baseUrl+'companies/get_registeredcoin_comments_by_ajax/'+comment_start+'/'+commnet_offset,
                                                    cache: false,
                                                    success: function(html){
                                                    $('#comment_list').html(html);
                                                    //  $('#comment').val('');
                                                      $("#comment_start").val(0);
                                                      $('#comment_list').slideDown(1000); 
                                                     // $("#errormsg").html("<strong>Thank you for giving reply.</strong>");
                                                      commentactions();
                                                    }
                                                });
                                           
                                        /*   $('#comment_list').load('http://'+current_domain+'/companies/get_registeredcoin_comments_by_ajax/'+comment_start+'/'+commnet_offset, function(){
                                            
                                          });*/
                                   
                            }
                            else
                                {     //$('#comment').val('');  
                                     $("#errormsg").html("<strong>Oops! There seems to be some problem. Please try in some time.</strong>");
                            }
                        }
                    });  
                });
      
      }
      
      function  loadcommnettype(){
           var $this = $("#coin_0");
            var idarr = $this.attr('id').split('_');
            $('#coin_holder_id').val(idarr[1]);
            // $('#coinset_id').val(idarr[2]);
            $(".coinlist").removeClass("grayText coinlist");     
            $("#selected_coin").html($this.html());
            $this.addClass("grayText coinlist")   
       //     var country_data = $(this).val();
            var current_domain=$("#current_domain").val();
              $.ajax({
                        url: baseUrl+'companies/get_commenttypes_by_ajax/'+idarr[1],
                        cache: false,
                        success: function(html){
                             $('#comment_type_id').html(html);
                         commentactions();
                        }
                    });
            
      }
          
       function updatecomment()
    {
        $("#errormsg").hide();
        $("#errormsg").html("");
       
        if(trim($('#coin_holder_id').val()) == '')
            {     $("#errormsg").html("<strong>Please select coin to comment.</strong>");
                  $("#errormsg").show();
                  // inlineMsg('coin_holder_id','<strong>Please select coin to comment.</strong>',2);
                  return false;
            }

        if(trim($('#comment_type_id').val()) == '')
            {   $("#errormsg").html("<strong>Please select suggested comment.</strong>");
            $("#errormsg").show();
            //inlineMsg('comment_type_id','<strong>Please select suggested comment.</strong>',2);
            return false;
        }

        if(trim($('#comment').val()) == '')
            {
            $("#errormsg").html("<strong>Please share your comment..</strong>");
            $("#errormsg").show();
            //inlineMsg('comment','<strong>Please share your comment.</strong>',2);
            return false;
        }


        if(tagValidate($('#comment').val()) == true){
            inlineMsg('comment','<strong>Please dont use script tags.</strong>',2);
            return false; 
        } 
        
           var current_domain=$("#current_domain").val();   
       // document.form_comment_add.submit();  
                   $.ajax({
                    type:'post',
                    dataType:'json',
                    cache: false,
                    data:$("#form_comment_add").serialize(),
                    url : baseUrl+'companies/save_comment',
                    success : function(res){
                        if(res= 1)
                            {          var comment_start=0; 
                                       var commnet_offset= parseInt($("#comment_offset").val());
                                       
                                        $.ajax({
                                            url: baseUrl+'companies/get_registeredcoin_comments_by_ajax/'+comment_start+'/'+commnet_offset,
                                            cache: false,
                                            success: function(html){
                                                 $('#comment_list').html(html);
                                                     var coin_holder_id=$('#coin_holder_id').val()
                                                   $('#comment_type_id').load(baseUrl+'companies/get_commenttypes_by_ajax/'+coin_holder_id);
                                                  
                                                  $('#comment').val('');
                                                  $("#comment_start").val(0);
                                                  $('#comment_list').slideDown(1000); 
                                                  $("#errormsg").html('<span style="color: green;"><strong>Thank you for adding comment.</strong>');
                                                  $("#errormsg").slideDown(1000);
                                                  setTimeout( function() {
                                                        jQuery('#errormsg').hide(1000);
                                                        }, 2000 );
                                                  commentactions();
                                            }
                                        });
  
                        }
                        else
                            {     $('#comment').val('');  
                                 $("#errormsg").html("<strong>Oops! There seems to be some problem. Please try in some time.</strong>");
                                   $("#errormsg").slideDown(1000);
                                   setTimeout( function() {
                                                jQuery('#errormsg').fadeOut(1000);
                                                }, 2000 );
                        }
                    }
                });

        return true;
    }               
      
    });
</script>
