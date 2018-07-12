<?php 
$privilegeIds = $session->read('Admin.privilege_id');
$privilegeArray = explode(',',$privilegeIds);
$adminType = $session->read('Admin.admin_type');
if($adminType == 'A'){
$none = '';
} else if($adminType == 'SA'){
$none = 'none';
}
?>
	<div id="left-column">
			<span id="5" style="display:<?=$none?>">
				<h3>Group communication</h3>
				<ul class="nav">
					<li><a href="/admins/mailbox">Send Mail</a></li>
					<li><a href="/admins/groupcommunicationlist">Communicate With Groups</a></li>
					<li><a href="/admins/donorcommunicationlist">Communicate With Donors</a></li>
					<li><a href="/admins/addemailtemplate">Add Email Templates</a></li>
					<li><a href="/admins/emailtemplatelist">View Email Templates</a></li>
				</ul>
			</span>
                        <span id="7" style="display:<?=$none?>"> 
			<h3>Manage Sub Admin</h3>
				<ul class="nav">
					<li><a href="/admins/addsubadmin">Add Sub Admin</a></li>
					<li><a href="/admins/subadminlist">View Sub Admin</a></li>
				
				</ul>
			</span>
                        <span id="2" style="display:<?=$none?>">
		                <h3>Manage Groups</h3>
				<ul class="nav">
					<li><a href="/admins/grouplist">View Groups</a></li>
				</ul>
			</span>
                        <span id="3" style="display:<?=$none?>">
				<h3>Manage Group Type</h3>
				<ul class="nav">
					<li><a href="/admins/addgrouptype">Add Group Type</a></li>
					<li><a href="/admins/viewgrouptype">View Group Type</a></li>
				
				</ul>
			</span>
                        <span id="4" style="display:<?=$none?>">
				<h3>Manage Event Type</h3>
				<ul class="nav">
					<li><a href="/admins/addeventtype">Add Event Type</a></li>
					<li><a href="/admins/vieweventtype">View Event Type</a></li>
				
				</ul>
			</span>
			 <span id="16" style="display:<?=$none?>">
				<h3>Manage Payment System</h3>
				<ul class="nav">
					<li><a href="/admins/searchpaymentrecord">Search Payment record</a></li>
					<li><a href="/admins/searchpaymentrecord">Batch Payments Days</a></li>
				
				</ul>
			</span>
                        <span id="1" style="display:<?=$none?>">
				<h3>Manage Content</h3>
				<ul class="nav">
					<!--li><a href="/admins/addcontent">Add Content</a></li-->
					<li><a href="/admins/viewcontents">View Content</a></li>
				
				</ul>
			</span>
                        <span id="6" style="display:<?=$none?>">
				<h3>Manage Printers</h3>
				<ul class="nav">
					<li><a href="/admins/printerlist">View Printers</a></li>
					<li><a href="/admins/addprinter">Add Printers</a></li>
				</ul>
			</span>
                        <span id="8" style="display:<?=$none?>">
				<h3>Change Password</h3>
				<ul class="nav">
					<li><a href="/admins/changePassword">Change Password</a></li>
				</ul>
			</span>
			<span id="9" style="display:<?=$none?>">
				<h3>Manage Logos</h3>
				<ul class="nav">
					<li><a href="/admins/uploadlogolist">View Logos</a></li>
					<li><a href="/admins/uploadlogo">Upload Logo</a></li>
				</ul>
			</span>
                        <span>
				<h3>Logout</h3>
				<ul class="nav">
					<li><a href="/admins/logout">Logout</a></li>
				</ul>
                        </span>
			<!--<a href="#" class="link">Link here</a>
			<a href="#" class="link">Link here</a>
		--></div>
<?foreach($privilegeArray as $privId){?>
<script type="text/javascript" language="JavaScript">
$('#<?=$privId?>').show();
</script>
<? } ?>
