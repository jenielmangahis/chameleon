<?php 
$this->subtabsel='';
//$extra='';
 $actions=$this->params["action"]; 
 if(!empty($this->params["pass"]['1'])){
	  $extra=$this->params["pass"]['1'];
 }
 if(!empty($this->params["pass"]['0'])){
	  $extra0=$this->params["pass"]['0'];
 }
?>
  
<?php if($actions=="dashboard"){ ?>

<script type="text/javascript">

$(document).ready(function() {
 
$('#dashbd').removeClass("butBg");
$('#dashbd').addClass("butBgSelt");
}); 

</script> 

<?php }else if($actions=="memberlist" || $actions=="holderslist" || $actions=="nonholderslist" || $actions=="nonmemberslist" || $actions=="editholder"  || $actions=="editnonholder"  || $actions=="addholder" ||  $actions=="top_points" || $actions=="points_detail" || $actions=="points" || $actions=="projectmembertypes" || $actions=="projectmembertypes_add" || $actions=="membercomments"  || $actions=="memberemails" || $actions=="membermessages"  || $actions=="memberevents" || $actions=="memberpoints"  || $actions=="memberpurchases"  || $actions=="memberhistory") { ?>
<script type="text/javascript">

$(document).ready(function() {
 
$('#memBrs').removeClass("butBg");
$('#memBrs').addClass("butBgSelt");
}); 

</script> 
<?php }else if($actions=="sendtempmail" || $actions=="mailtemplatelist" || $actions=="editmailcontent" || $actions=="addmailtemplate" || $actions=="mailautoresponderlist" || $actions=="commtasklist" || $actions=="commtaskhistorylist" || $actions=="editcommtask" || $actions=="addcommtask" || $actions== "spam_policy_project")
{
    if(isset($extra)=="event" || isset($extra0)=="event")
    {
        ?>
        <script type="text/javascript">

        $(document).ready(function() {
        $('#EventLst').removeClass("butBg");
        $('#EventLst').addClass("butBgSelt");
        });

        </script>
        <?php

    }
    else
    {
    ?>
<script type="text/javascript">
                                                                                                                                      
$(document).ready(function() {                                                                                                                                                                        
 
$('#EmailMnu').removeClass("butBg");
$('#EmailMnu').addClass("butBgSelt");
}); 

</script>

<?php
    }
}else if( $actions=="messagelist" || $actions=="messagenew" || $actions=="commentlist" || $actions=="verifycommentlist"||$actions=="commentreplylist" ||  $actions=="actionreply" ||  $actions=="suggestedlist"  || $actions=="suggestedcomments" ||  $actions=="editcommenttype" || $actions=="addcommenttype" || $actions=="rsvplist" ){ ?>
<script type="text/javascript">

$(document).ready(function() {
 
$('#commMnu').removeClass("butBg");
$('#commMnu').addClass("butBgSelt");
}); 

</script>

<?php }else if($actions=="editprojectdtl" || $actions=="projectsponsor" || $actions=="projectuser" ||  $actions=="projectbackup"   || $this->subtabsel=="useragreement" ||  $this->subtabsel=="coinpricing" || $this->subtabsel=="systempricing" || $this->subtabsel=="spampolicy" || $this->subtabsel=="user_agreement_project" || $this->subtabsel=="spam_policy_project"   ){ ?>

<script type="text/javascript">

$(document).ready(function() {
 
$('#projeCt').removeClass("butBg");
$('#projeCt').addClass("butBgSelt");
}); 

</script>

<?php }else 
if( $actions=="companylist" ||   $actions=="addcompany" ||   $actions=="contactlist" || $actions=="addcontacts" ||       $actions=="projectcompanytypes" || $actions=="projectcompanytypes_add" ||  $actions=="projectcontacttypes" ||  $actions=="projectcontacttypes_add" )
{ ?>
                        
<script type="text/javascript">
                                                                                                                 
$(document).ready(function() {
 
$('#contMnu').removeClass("butBg");
$('#contMnu').addClass("butBgSelt");
}); 

</script>

<?php }else 
if( $this->subtabsel=="donationlist" || $this->subtabsel=="donationuploadlist" || $this->subtabsel=="donationbyeventlist" || $this->subtabsel=="donationtypes" || $actions=="topdonatorslist" || $actions=="projectdonatelevels" || $actions=="projectdonatelevels_add" ||  $actions=="registercoinlist" || $actions=="viewcomments"  )
{ ?>
                        
<script type="text/javascript">
                                                                                                                 
$(document).ready(function() {
 
$('#donateMnu').removeClass("butBg");
$('#donateMnu').addClass("butBgSelt");
}); 

</script>

<?php }else if($actions=="contentlist" || $actions=="systemlist" || $actions=="addcontent" || $actions=="editcontent" ||  $actions=="socialnetwork" || $actions=="settingthemes" ||  $actions=="page_footer" || $actions=="fbfeeds" || $actions=="qrcodegenerate" || $actions=="bloglist" || $actions=="blogadd"){ ?>

<?php
if($extra=="detail" || $extra=="sponsor" || $extra=="inquiry")
{ ?>


<script type="text/javascript">

$(document).ready(function() {
$('#EventLst').removeClass("butBg");
$('#EventLst').addClass("butBgSelt");
});

</script>
<?php
}
else
{
?>


<script type="text/javascript">

$(document).ready(function() {    
alert("fsag  ")         
$('#weB').removeClass("butBg");
$('#weB').addClass("butBgSelt");
});

</script>

<?php
}
?>



<?php }else if($actions=="messagelist" || $actions=="messagenew" ){ ?>


<script type="text/javascript">

$(document).ready(function() {
$('#MsgLst').removeClass("butBg");
$('#MsgLst').addClass("butBgSelt");
});

</script>





<?php }else 
if( $actions=="eventlist" || $actions=="eventcreate" || $actions=="edit_event" || $actions=="rsvp" || $actions=="waitlist" || $actions=="send_invite" || $actions=="eventtasklist" || $actions=="event_task" || $actions=="eventinvitationhistory" || $actions=="event_donations" || $actions=="event_volunteers" || $actions=="eventinvitation" || $actions=="eventattending" || $actions=="eventmayattending" || $actions=="eventpending" || $actions=="pasteventlist" || $actions=="pasteventcreated" || $actions=="calendarlist" || $actions=="eventautoresponders" || $actions=="event_pages" || $actions=="event_types" || $actions=="addeventtype" || isset($extra) && ($extra=="detail" || $extra=="sponsor" || $extra=="inquiry") ){ ?>

<script type="text/javascript">

$(document).ready(function() {
$('#EventLst').removeClass("butBg");
$('#EventLst').addClass("butBgSelt");
});

</script>





<?php }else if( $actions=="loginterms" || $actions=="settings" || $actions=="coinsetlist"||  $actions=="addcoinset"||  $actions=="editcoinset" || $actions=="change_password" || $actions=="iframes" ||  $actions=="getstart" || $actions=="projectcontrols" ){ ?>


<script type="text/javascript">

$(document).ready(function() {
$('#ConFigs').removeClass("butBg");
$('#ConFigs').addClass("butBgSelt");
});

</script>





<?php }else 
if( $actions=="formtypelist" || $actions=="formtype_add"  || $actions=="formsubmitlist" || $actions=="formsubmitted" || $actions=="formstatustypelist" || $actions=="formstatustype_add"){ ?>


<script type="text/javascript">

$(document).ready(function() {
$('#FormtLst').removeClass("butBg");
$('#FormtLst').addClass("butBgSelt");
});

</script>





<?php }else{ }



 ?>



