<Style>



.all-rounded {
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
-webkit-box-shadow: #666 0px 2px 3px;
-moz-box-shadow: #666 0px 2px 3px;
box-shadow: #666 0px 2px 3px;

}
 
.spacer {
    display: block;
}
 
#progress-bar {
    width: 250px;
    height: 23px;
    margin: 0 auto;
    background: #cccccc;
    border: 2px solid #f2f2f2;
}
 
#progress-bar-percentage {
    background:#509cd9;             /*#3063A5;*/
    padding: 5px 0px;
     color: #FFF;
     font-weight: bold;
     text-align: center;
     height:13px;
}

</style>
      <script type="text/javascript">   
              $(document).ready(function() { 
               
                 var current_domain=$("#current_domain").val(); //"localhost:8080";
                  $('#eventinvitelist').hide();
                 $('#eventinvitelist').load('http://'+current_domain+'/companies/get_eventinvitations_by_ajax/0/10', function(){
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
                            url: "http://"+current_domain+"/companies/eventrespond/"+event_id+"/"+respond,
                            success : function(result){
                                if(result == 1)
                                    {
                                      alert("Responded successfully!");   
                                        $('#eventinvitelist').hide();
                                         $('#eventinvitelist').load('http://'+current_domain+'/companies/get_eventinvitations_by_ajax/0/10', function(){
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
<?php 
            $site_logoutUrl='/companies/logout/';
          

if($_SESSION['User']['User']['usertype']=="holder"){ 

    
    function progressBar($percentage)
     {
    print "<div id=\"progress-bar\" class=\"all-rounded\">\n";
    print "<div id=\"progress-bar-percentage\" class=\"all-rounded\" style=\"width: $percentage%\">";
        if ($percentage > 5) {print "$percentage%";} else {print "<div class=\"spacer\">&nbsp;</div>";}
    print "</div></div>";
    }


?>
  <div class="navigation">
  <div class="boxBg">
 
  
  
  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg">
  <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p> -->
  <div class="boxBor">
  <div class="boxPad">
<div style="height:auto !important;height:200px;min-height:200px;">
<h2 style="float:left;">Welcome <?php 
 if($_SESSION['User']['User']['usertype']=="holder")

    { 
    $firstnam=$screenname;
    echo  $firstnam;
    }
    else 
    {
     echo $username;
     }    ?> !</h2>
     
<div style="float:left; position: relative;width:650px;margin-left:198px; margin-top:-30px;">     
<div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow">

    <?php  echo $this->element("iframe_menubar");?>  
    
</div>

</div>


     
<?php echo  $form->create('Holder',array('action'=>'','id'=>'dashboard','url'=>$this->here ,'onsubmit' => ''));?>
 <div class="clear"></div>
<?php if($_SESSION['User']['User']['usertype']=="holder"){ ?>
<br />
<br />
 <table width="100%" >
    <tr>
           <td width="62%" valign="top"> 
           <table align="right" border="1" style="border:2px solid #999999;" cellspacing="5"  width="100%" class="border_shadow">
    <tr>
            <td>
            <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>">
            <b>Event Invitations </b></font></td>
    </tr>
    <tr>
            <td>
            <div id="eventinvitelist">
                 <!-- load event inivitations -->  
            </div>
            </td>
            </tr>
            </table>
           
           </td>
           <td width="37%">
          
<table align="right" border="1" style="border:2px solid #999999; width: 300px;" cellspacing="5" class="border_shadow">
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#4F4F4F" size="2"><b> Profile is <?php echo $pro_complete[per];?>% done </b></font></td>
</tr>

<tr>
<td><?php progressBar($pro_complete[per]); ?></td>
</tr>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#42C712" size="2"><b> Complete it now.. </b></font></td>
</tr>

</table>
<br /><br /><br /><br /><br /><br /><br />

<table align="right" border="1" style="border:2px solid #999999; width: 300px;" cellspacing="0" class="border_shadow">
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>


<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#4F4F4F" size="2"><b>You have</b> </font> <font color="#42C712" size="2"><b> <?php echo $waiting_comments; ?> Comment(s) to Respond to.   </b></font></td>
</tr>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>

</table>

<br /><br /><br /><br /><br /><br />


<table align="right" border="1" style="border:2px solid #999999; width: 300px;" cellspacing="0" class="border_shadow">
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>

<?php
    if($member_points[points]==NULL)
        $member_points[points]=0;
?>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color="#4F4F4F" size="2">
<strong>You have  <font color="#42C712" size="2"> <?php echo $member_points[points];?> </font> total points.  
</strong></font></td>
</tr>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>

</table>

<br /><br /><br /><br /><br /><br />



<table align="right" border="1" style="width: 300px;border:2px solid #999999;" cellspacing="5" class="border_shadow">
<?php
//debugbreak();
 $create_date=date('m-d-Y', strtotime($creatdate)); 
 $last_login=date('m-d-Y', strtotime($last_login));         //$dateoflogin
 
 if($coincreatdate!="" || $coincreatdate!=null)
    $coincreat_date=date('m-d-Y', strtotime($coincreatdate)); 
 else
    $coincreat_date="No";
    if($lastcommenteddate!="" || $lastcommenteddate!=null)
    $lastcommenteddate=date('m-d-Y', strtotime($lastcommenteddate)); 
 else
    $lastcommenteddate="No";

?>

    <tr style='background-color:#FFF;'>
        <td>Member Since</td>
        <td><label><?php echo $create_date; ?></label></td>
    </tr>
    <tr style='background-color:#f8f8f8;'>
        <td>Coin Registered</td>
        <td><label><?php echo $coincreat_date; ?></label></td>
    </tr>
    <tr style='background-color:#FFF;'>
        <td>Coins Registered</td>
        <td><label><?php echo $noofcoins; ?></td>
    </tr>
    <tr style='background-color:#f8f8f8;'>
        <td>Comments made</td>
        <td><label><?php echo $ncomment; ?></td>
    </tr>
    <tr style='background-color:#FFF;'>
        <td>Last login</td>
        <td><label><?php echo $last_login; ?></td>
    </tr>
    <tr style='background-color:#f8f8f8;'>
        <td>Last comment</td>
        <td><label><?php echo $lastcommenteddate; ?></td>
    </tr>
</table>
</td>
      </tr>
  </table>  
<?php } ?>
</div>

  </div>
  </div>   
    <!--<p class="boxBot"><?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>-->
  
  </div>
  </div>
<div></div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 

<?php }  else{ ?>



<div class="container">
<div class="titlCont"><div class="myclass">
        <div align="center" id="toppanel" >
            <?php  echo $this->renderElement('new_slider');  ?>

        </div>

<span class="titlTxt">
Dashboard
</span>
<div class="topTabs">
<ul>

</ul>
</div>
</div></div>

 <div class="midPadd">
        <br>
        
        
         <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
                    <?php  $session->flash();    ?> 
                </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
        </div>
</div>
                                            <?php } ?>

            



<div class=""  style="height:350px;">



<h2 style="backgroun:none; text-align:center;">Welcome <?php if($_SESSION['User']['User']['usertype']=="holder")

    { 
    $firstnam=$screenname;
    echo  $firstnam;
    }
    else 
    {
     echo $username;
     }    ?> !</h2></center>
<?php echo  $form->create('Holder',array('action'=>'','id'=>'dashboard','url'=>$this->here ,'onsubmit' => ''));?>

</div>  </div>


<!--inner-container ends here-->
<?php echo $form->end();?>


<div></div>

<div class="clear"></div>

<?php } ?>