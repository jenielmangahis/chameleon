<?php 
$emailval=$dt[0]['Project']['fromemail'];
 echo $javascript->link('ckeditor/ckeditor'); 
?>

<script language="javascript">
function loadMemberEmails()
        {
        
            var current_domain=$("#current_domain").val();
            $('#contactemails').load('http://'+current_domain+'/companies/get_members_details_by_ajax/', function(){
                    //  $("#comment_start").val(commnet_offset);
                    $('#contactemails').fadeIn(1000); 

            }); 
        
        }
</script>
    

<div class="titlCont"><div class="myclass">
<div align="center" id="toppanel">
 <?php  echo $this->renderElement('new_slider');  ?>    
</div>
    <?php echo $form->create("Company", array("action" => "send_invite",'name' => 'send_invite', 'id' => "send_invite")); ?>  
<span class="titlTxt">
Send Mail
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Send</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/eventlist/'.<?php echo $rec_event_id;?>)"><span> Cancel</span></button></li>
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both;">
<ul class="topTabs2">
 <!--<li><a href="/companies/eventcreate/<?php// echo $this->data['RecurringEvent']['id']; ?>" class="tabSelt"><span>Edit RecurringEvent</span></a></li>-->
                  <li><a href="/companies/rsvp_sponsor/<?php echo $rec_event_id; ?>"><span>RSVP</span></a></li>
                  <?php
                   if($waiting_list==1)  
                   {
                    ?>
                  <li><a href="/companies/waitlist/<?php echo $rec_event_id; ?>"><span>Wait List</span></a></li>
                  <?php
                   }
                    ?>
                    <li><a href="/companies/send_invite/<?php // echo $this->data['RecurringEvent']['id']; ?>" ><span>Send Invite</span></a></li>
                   <li><a href="/companies/eventtasklist/<?php echo $rec_event_id; ?>"><span>Event Task</span></a></li>
                   <li><a href="/companies/eventinvitationhistory/<?php echo $rec_event_id; ?>"><span>Invites</span></a></li>
                    <li><a href="/companies/event_donations/<?php echo $rec_event_id; ?>" class="tabSelt"><span>Donations</span></a></li>
                   <li><a href="/companies/event_volunteers/<?php echo $rec_event_id; ?>"><span>Volunteers</span></a></li>
</ul>
</div>
<div class="clear"></div>

</div></div>


<div class="midPadd" id="sendtempmailtab">
 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>   
 
 <div class="" style="border:none;">    


 


                          <!-- START: New Design for send mail as per Requirement --> 
            <?php  echo $this->renderElement('coming_soon');  ?>  
           <!-- END : New Design for send mail as per Requirement -->  

        <div class="top-bar" style="text-align: left; padding-top: 5px; ">
   <?php  echo $this->renderElement('bottom_message');  ?>

                            </div>

            

 </div>
<div class="clear"></div>
 
 
  </div>
<?php echo $form->end();?>

      
            </div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>

<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("sendtempmailtab").style.paddingTop = '24px';
    else
    {
            document.getElementById("blck").style.paddingTop = '10px';
    }    
    
    
    $(document).ready(function() { 

      loadMemberEmails();  
          $("#member_type").change(function(){
            
            loadMemberEmails();  
        }); 

       $("#companytypeid").change(function(){
              loadContactEmails();  
      });
      
      $("#contactypeid").change(function(){
              loadContactEmails();  
      });
      
      $("#addrecipients").click(function(){
              addrecipients();  
      });
      
      
        function loadMemberEmails()
        {
        
            var current_domain=$("#current_domain").val();
            var member_type=$("#member_type").val();
            var companytypeid=$("#companytypeid").val();
            var contactypeid=$("#contactypeid").val();
            var iscompandcontact=$("#iscompandcontact").val();  
             
              if(companytypeid=="" && contactypeid=="" && member_type==""){      
                  $("#member_type").removeAttr('disabled');    
                  $("#companytypeid").removeAttr('disabled');    
                  $("#contactypeid").removeAttr('disabled');    
                  
            }else if(member_type!="" ){
                $("#companytypeid").val("");
                $("#companytypeid").attr("disabled","disabled");
                $("#contactypeid").val("");
                $("#contactypeid").attr("disabled","disabled");
                
                var current_domain=$("#current_domain").val();
                  $.ajax({
                                url: 'http://'+current_domain+'/companies/get_members_details_by_ajax/'+member_type,
                                cache: false,
                                success: function(html){ 
                                        $('#contactemails').hide();
                                        $('#contactemails').html(html);
                                        $('#contactemails').fadeIn(1000);   
                                        loadCheckFunction(); 
                                }
                   });
                 

            }else{
                 if(iscompandcontact=="no"){
                   //   $("#member_type").val("all");   
                }else{
                    $("#companytypeid").val("");
                    $("#companytypeid").removeAttr('disabled');
                    $("#contactypeid").val("");
                    $("#contactypeid").removeAttr('disabled');
                    $("#member_type").val("");
                    $("#member_type").attr("disabled","disabled");
                }
            }
           
        
        }

        function loadContactEmails(){
            // var country_data = $(this).val();
            var current_domain=$("#current_domain").val();
            var member_type=$("#member_type").val();
            var companytypeid=$("#companytypeid").val();
            var contactypeid=$("#contactypeid").val();
            
            if(companytypeid=="" && contactypeid=="" && member_type==""){      
                  $("#member_type").removeAttr('disabled');    
                  $("#companytypeid").removeAttr('disabled');    
                  $("#contactypeid").removeAttr('disabled');    
                  
            }else if(companytypeid!="" || contactypeid!=""){
                $("#member_type").val("");
                $("#member_type").attr("disabled","disabled");
                var companytypeid=parseInt($("#companytypeid").val()); 
                if(isNaN(companytypeid)) { companytypeid=0;}    
                var contactypeid=parseInt($("#contactypeid").val()); 
                if(isNaN(contactypeid)) { contactypeid=0;}    

              //  alert(" P id"+" comp id "+companytypeid+" contact id "+contactypeid);
                //   var commnet_offset= parseInt($("#comment_offset").val());
                $('#contactemails').hide();
                  $.ajax({
                                url: 'http://'+current_domain+'/companies/get_company_contacts_by_ajax/'+companytypeid+'/'+contactypeid,
                                cache: false,
                                success: function(html){
                                        $('#contactemails').html(html);
                                          $('#contactemails').fadeIn(1000);  
                                          loadCheckFunction(); 
                                         
                                }
                   });
                 
                
           }else{
                $("#companytypeid").val("");
                $("#companytypeid").attr("disabled","disabled"); 
                $("#contactypeid").val("");
                $("#contactypeid").attr("disabled","disabled"); 
                $("#member_type").val("");
                $("#member_type").removeAttr('disabled');
           }
           
        } 
        
        
      function loadCheckFunction(){  
            $("#checkall").click(function(){
                if( $('#checkall').is(':checked')==true){
                    $('.checkid').attr('checked','checked');
                }else{
                    $('.checkid').removeAttr('checked','checked');    
                }
            });
        }



         $(document).ready(function()
         {
            $('#checkall').bind('change',function(){
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
            {
                    $('.checkid').each(function()
                    {
                            $(this).attr('checked',true);

                    });


            }else{

                    $('.checkid').each(function()
                    {
                            $(this).attr('checked',false);

                    });
            }        

    });
    


});

        $(document).ready(function()
        {   
    $('.checkid').bind('change',function()
    {   
        //event.stopPropagation();
        var i=0;
        var j=0;
        $('.checkid').each(function(){
            i++;
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
            {            
                j++;
            }


        });
        
        if(i==j)
            $('#checkall').attr('checked',true);
        else
            $('#checkall').attr('checked',false);
    });
});

         
         function addrecipients()
        {    
              var counter=0;
              var existlist = document.getElementById('toid').value;
              var existlistarr = existlist.split(",");
              var str ='';
              var chk = '';
              
            var id="";
            $('.checkid').each(function(){        
                var check = $(this).attr('checked')?1:0;
              
                if(check ==1)
                {            
                                        
                    var title = $(this).attr("id");
                     //alert(title);
                     $('#send_invite').append(
                     $('<input/>')
                    .attr('type', 'hidden')
                    .attr('name', 'data[id_list][]')
                    .val(title)
                    );
                    
                       chk = ''; 
                       id=$(this).val(); 
                      
                        for(j=0;j<existlistarr.length;j++){
                            
                            if(existlistarr[j]==id){
                                chk ='set'; 
                                break;
                            }
                        }
                        
                        if(chk==''){
                                str += id+',';    
                        }
                        counter=counter +1;
                }
           });    
            
            if(counter==0)
            {
                alert("Please select at least one recipient");
                 return false;
            }else{    
                str = trim(str,",");
                document.getElementById('toid').value = trim(trim(document.getElementById('toid').value,',')+","+str,","); 
                
            }
        } 
        

         
        }); 
        
</script>
