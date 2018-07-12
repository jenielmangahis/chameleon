<?php 				 
$actions	=	($this->params["action"])?$this->params["action"]:'';
$extra		=	(isset($this->params["pass"][1]))?$this->params["pass"][1]:'';
$extra0	=	(isset($this->params["pass"][0]))?$this->params["pass"][0]:'';
if(!isset($this->subtabsel) || empty($this->subtabsel))
	$this->subtabsel = '';


if($actions=="editshippingtype" || $actions=="addshippingtype" || $actions=="shippingtype" ||$actions=="addprojecttype"|| $actions== "editprojecttype"||$actions=="projecttype"|| $actions=="editcompanytype" || $actions=="addcompanytype" ||$actions=="companytype"||$actions=="editcontacttype" || $actions=="addcontacttype" ||$actions=="contacttype" || $actions=="system_pricing_list" || $actions=="system_pricing" || $actions=="addnonprofittypes" || $actions=="nonprofittypelist" ){
	?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#type').removeClass("butBg");
		$('#type').addClass("butBgSelt");
	}); 
</script>

<?php } else if($actions=="projectlist" || $actions== "addproject"|| $actions== "editproject" || $actions== "projectlist_by_product" || $actions== "projectlist_by_sys_price") { ?>


<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script>

<?php }  else if($actions=="projectmerchant"){?>
<script type="text/javascript">
$(document).ready(function() {
$('#prosMnu').removeClass("butBg");
$('#prosMnu').addClass("butBgSelt");
}); 
</script>
<?php }else if($actions=="ownerlist") { ?>

<script type="text/javascript">
$(document).ready(function() {
$('#sponMng').removeClass("butBg");
$('#sponMng').addClass("butBgSelt");
}); 
</script>

<?php }else if($actions=="companylist1" || $actions== "addcompany1" || $actions=="company1") { ?>

<script type="text/javascript">
$(document).ready(function() {
$('#compAnies').removeClass("butBg");
$('#compAnies').addClass("butBgSelt");
}); 
</script>

<?php }else if ($actions=="contactlist1" || $actions== "addcontacts1"){ ?>

<script type="text/javascript">
$(document).ready(function() {
$('#coNtact').removeClass("butBg");
$('#coNtact').addClass("butBgSelt");
}); 
</script>
<?php }else if($actions=="super_admin_changepassword" || $actions=="help_list" ||  $actions== "getstarted" || $actions== "user_agreement_list" || $actions== "spam_policy" || $actions== "terms_by_admin"){ ?>
<script type="text/javascript">
$(document).ready(function() {
$('#conFiugure').removeClass("butBg");
$('#conFiugure').addClass("butBgSelt");
});
</script>
<?php }else{} 




?>
<?php if($actions=="projectdashboard"){ ?>
<script type="text/javascript">
$(document).ready(function() {
$('#dashbd').removeClass("butBg");
$('#dashbd').addClass("butBgSelt");
}); 
</script>

<?php }else 
	if($actions=="memberlist" || $actions=="holderslist" || $actions=="coinholderslist" || $actions=="nonholderslist" || $actions=="nonmemberslist" || $actions=="editholder" || $actions=="editnonholder" || $actions=="addholder" || $actions=="top_points" || $actions=="points_detail" || $actions=="points" || $actions=="projectmembertypes" || $actions=="projectmembertypes_add" || $actions=="membercomments"  || $actions=="memberemails" || $actions=="membermessages"  || $actions=="memberevents" || $actions=="memberpoints"  || $actions=="memberpurchases"  || $actions=="sendtempmail" || $actions=="memberhistory" || $actions=="map" || $actions=="membertypes" || $actions=="memberlevels" || $actions=="membersbylevel" || $actions=="memberlevels_add" )
{ ?>
<script type="text/javascript">
$(document).ready(function() {
$('#memBrs').removeClass("butBg");
$('#memBrs').addClass("butBgSelt");
}); 
</script>
<?php }else if( $actions=="mailtemplatelist" || $actions=="editmailcontent" || $actions=="addmailtemplate" || $actions=="mailautoresponderlist" || $actions=="commtasklist" ||  $actions=="commtaskhistorylist" || $actions=="editcommtask" || $actions=="addcommtask" || $actions=="activetasklist" || $actions=="taskhistorylist" || $actions=="opt_out_history" )
	{
		if($extra=="event" || $extra0=="event")
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
	} else if($actions=="messagelist" || $actions=="messagenew" || $actions=="commentlist" || $actions=="verifycommentlist"||$actions=="commentreplylist" ||  $actions=="actionreply" ||  $actions=="suggestedlist"  || $actions=="suggestedcomments" ||  $actions=="editcommenttype" || $actions=="addcommenttype" || $actions=="rsvplist" )
{ ?>
<script type="text/javascript">
$(document).ready(function() {
$('#CommMnu').removeClass("butBg");
$('#CommMnu').addClass("butBgSelt");
}); 
</script>

<?php }else 
	if($actions=="editprojectdtl" ||  $actions=="projectsponsor"  ||  $actions=="projectbackup"  || $this->subtabsel=="useragreement" ||  $this->subtabsel=="coinpricing" || $this->subtabsel=="systempricing" || $this->subtabsel=="spampolicy" || $this->subtabsel=="user_agreement_project" )
{ ?>

<script type="text/javascript">
$(document).ready(function() {
$('#projeCt').removeClass("butBg");
$('#projeCt').addClass("butBgSelt");
}); 
</script>

<?php } else if( $actions=="companylist" ||   $actions=="addcompany" ||   $actions=="contactlist" || $actions=="addcontacts" ||       $actions=="projectcompanytypes" || $actions=="projectcompanytypes_add" ||  $actions=="projectcontacttypes" ||  $actions=="projectcontacttypes_add" ||  $actions=="projectmerchantlist"  ||  $actions=="projectnonprofitlist" ||  $actions=="categorylist")
{ ?>

<script type="text/javascript">
$(document).ready(function() {
$('#playMnu').removeClass("butBg");
$('#playMnu').addClass("butBgSelt");
}); 
</script>

<?php }else 
	if(   $this->subtabsel=="donationlist" || $this->subtabsel=="donationuploadlist" || $this->subtabsel=="donationbyeventlist" || $this->subtabsel=="donationtypes" || $actions=="topdonatorslist" || $actions=="projectdonatelevels" || $actions=="projectdonatelevels_add" ||  $actions=="registercoinlist" || $actions=="viewcomments"  )
{ ?>

<script type="text/javascript">
$(document).ready(function() {
$('#donateMnu').removeClass("butBg");
$('#donateMnu').addClass("butBgSelt");
}); 
</script>

<?php }else 
	if($actions=="contentlist" || $actions=="systemlist" || $actions=="addcontentpage" || $actions=="editcontent" || $actions=="settingthemes" || $actions=="page_footer" || $actions=="socialnetwork" || $actions=="fbfeeds" || $actions=="qrcodegenerate" || $actions=="bloglist" || $actions=="blogadd" ||    $actions=="formsubmitted")
	{
		if($extra=="detail" || $extra=="sponsor" || $extra=="inquiry"){
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
$('#weB').removeClass("butBg");
$('#weB').addClass("butBgSelt");
});
</script>

<?php
}
?>

<?php }else
if( $actions=="loginterms" || $actions=="settings"  || $actions=="iframes" || $actions=="backup"|| $actions=="locationlist" || $actions=="coinsetlist"||  $actions=="addcoinset"||  $actions=="editcoinset" || $actions=="points" || $actions=="fbfeeds"  || $actions=="projectshoppingcart" || $actions=="getstart" || $actions=="change_password" ){ ?>


<script type="text/javascript">
$(document).ready(function() {
$('#ConFigs').removeClass("butBg");
$('#ConFigs').addClass("butBgSelt");
});
</script>

<?php }else 
if( $actions=="eventlist" || $actions=="eventcreate" || $actions=="edit_event" || $actions=="rsvp" || $actions=="waitlist" || $actions=="send_invite" || $actions=="eventtasklist" || $actions=="event_task" || $actions=="eventinvitationhistory" || $actions=="event_donations" || $actions=="event_volunteers" || $actions=="eventinvitation" || $actions=="eventattending" || $actions=="eventmayattending" || $actions=="eventpending" || $actions=="pasteventlist" || $actions=="pasteventcreated" || $actions=="eventautoresponders" || $actions=="event_pages" || $actions=="addeventtype" || $actions=="event_types" || $extra=="detail" || $extra=="sponsor" || $extra=="inquiry"){ ?>


<script type="text/javascript">
$(document).ready(function() {
$('#EventLst').removeClass("butBg");
$('#EventLst').addClass("butBgSelt");
});
</script>

<?php }else 
if( $actions=="formtypelist" || $actions=="formtype_add" || $actions=="formsubmitlist" || $actions=="formsubmitted"  || $actions=="formstatustypelist" || $actions=="formstatustype_add"){ ?>

<script type="text/javascript">
$(document).ready(function() {
$('#FormtLst').removeClass("butBg");
$('#FormtLst').addClass("butBgSelt");
});
</script>

<?php }else if( ($actions=="offerlist" && $extra=="" ) ||  $actions=="addoffer" || $actions=="category" || $actions=="expired" || $actions=="bymember" || $actions=="bymerchant" || $actions=="by_pledge_discount" || $actions=="coupons" || $actions=="offeremail"  || $actions=="offerpages" ){ ?>

<script type="text/javascript">
$(document).ready(function() {
$('#OfferMnu').removeClass("butBg");
$('#OfferMnu').addClass("butBgSelt");
});
</script>


<?php  } else if( $actions== "supermailtemplatelist" || $actions== "mailtask_list" || $actions== "mail_footer" ){ ?>
<script type="text/javascript">
		$(document).ready(function() {
			$('#EmailMnu').removeClass("butBg");
			$('#EmailMnu').addClass("butBgSelt");
		});
	</script>
<?php  } ?>