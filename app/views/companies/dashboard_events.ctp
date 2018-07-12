 <script type="text/javascript">   
              $(document).ready(function() { 
               
                 var current_domain=$("#current_domain").val(); //"localhost:8080";
                  $('#eventinvitelist').hide();
                 $('#eventinvitelist').load(baseUrl+'companies/get_eventinvitations_by_ajax/0/10', function(){
                   //  $("#comment_start").val(0);
                      $('#eventinvitelist').slideDown(1000); 
                      eventinviteactions();
                 });
                 
                 function eventinviteactions(){
                   
                     $("input[id^='respondevent_']").click(function(){ 
                         var current_domain=$("#current_domain").val();      
                        var $this = $(this);
                        var idarr = $this.attr('id').split('_');
                        var event_id=idarr[1];             
                        var optname="invite_status_"+event_id;
                        var respond = $('input:radio[name='+optname+']:checked').val();
                      
                         $.ajax({
                            type : "POST",
                            dataType: "json",
                            url: baseUrl+"companies/eventrespond/"+event_id+"/"+respond,
                            success : function(result){
                                if(result == 1)
                                    {
                                      alert("Responded successfully!");   
                                        $('#eventinvitelist').hide();
                                         $('#eventinvitelist').load(baseUrl+'companies/get_eventinvitations_by_ajax/0/10', function(){
                                           //  $("#comment_start").val(0);
                                              $('#eventinvitelist').slideDown(1000); 
                                              eventinviteactions();
                                         });       

                                }
                                else
                                    {
                                        alert("Oops! There seems to be some problem. Please try in some time."); 
                                }
                            } 
                        });

                   });  
                   
                    $("span[id^='viewfulldesc_']").click(function(){ 
                         var current_domain=$("#current_domain").val();      
                        var $this = $(this);
                        var idarr = $this.attr('id').split('_');
                        var event_id=idarr[1];
                        $("#viewfulldesc_"+event_id).hide(); 
                        $("#eventshortdesc_"+event_id).hide();
                        $("#eventfulldesc_"+event_id).slideDown();
                         $("#hidefulldesc_"+event_id).show();  
                         
                    
                        
                   });  
                   
                   $("span[id^='hidefulldesc_']").click(function(){ 
                         var current_domain=$("#current_domain").val();      
                        var $this = $(this);
                        var idarr = $this.attr('id').split('_');
                        var event_id=idarr[1]; 
                         $("#hidefulldesc_"+event_id).hide();     
                        $("#eventfulldesc_"+event_id).hide();
                        $("#eventshortdesc_"+event_id).slideDown();
                        $("#viewfulldesc_"+event_id).show();
                       
                        
                   });  
                               
                 }
                 
             });
      </script>

      
<!-- Body Panel starts -->
 <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>">

<div class="navigation">
    <div class="boxBg">

       
    </div>
</div>
<div class="bdyCont">
    <div class="boxBg1">

        <div class="boxBor1">
            <div class="boxPad">
                <h2 style="float:left;">Events</h2>

                <div style="float: left; position: relative;width: 700px;margin-left:198px; margin-top:-30px;">     
                    <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow" id="leftmenubar_bg">

                        <?php
                        if(isset($_SESSION['iframe_session']))
                            echo $this->element("iframe_menubar"); 
                        else
                            echo $this->element("leftmenubar");
                        
                        ?>  
                    </div>

                </div>
             
                
                <div style="margin: 0pt auto; width: 460px; padding-top: 50px;">

                 <div id="eventinvitelist">
                 <!-- load event inivitations -->  
                 </div>   
                   
                </div>
                
            </div>
           
        </div>


    </div>
</div>

<div class="clear"></div>
<!-- Body Panel ends --> 



