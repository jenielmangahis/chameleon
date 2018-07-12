<?php 
	$urlarray = explode('/',$_REQUEST['url']);
	  $urlshow =  $urlarray['1'];
	if($urlshow == 'changePassword') {
	 	    $maindev = 'changepasswordid';
	}else if($urlshow == 'projecttype' || $urlshow == 'addprojecttype' || $urlshow == 'editprojecttype') {
	 	    $maindev = 'projecttypeid';
	}

?>
<style type="text/css">

.donor_lnks li.sub,
.donor_lnks li.top{display:block; float:left; height:24px; line-height:24px; width:190px; color:#000; background:#f8f8f8; text-decoration:none;border-bottom:1px solid #fff; text-indent:20px; overflow:hidden; cursor:pointer;}

.donor_lnks li.sub {
/*background:#eee url(arrows/out.gif) no-repeat 5px 8px;*/
background:none repeat scroll 0 0 transparent;
border-bottom:medium none;
color:#000000;
font-size:15px;
margin:15px 0 0;
width:200px;
}

.donor_lnks li.top a {text-decoration:none; color:#000; display:block; }
.donor_lnks li.top a:hover {color:#069; background:#f8f8f8;}

.donor_lnks li.clicked {color:#800;}

/* #slide li.sub div height = (maximum sub lines * sub line height) + top level link height(variable fY in jQuery) */
.donor_lnks li.sub div {background:#fff; height:142px; width:200px; padding:0 15px; line-height:1.2em; font-family: verdana, sans-serif; text-indent:0;}

.donor_lnks li div ul {padding:0; margin:0; list-style:none;}
.donor_lnks li div ul li {float:left; height:29px; width:100%;}
.donor_lnks li div ul li a {padding:0; margin:0;color:#888; text-decoration:none; background:#fff; font-size:12px; display:block; border-bottom:1px solid #ddd; height:20px; line-height:20px; width:100%; text-indent:10px;}
.donor_lnks div ul li a:hover {color:#069; background:#fff;}


.liststylenone{
	list-style:none outside none;
}

</style>


<ul  class="donor_lnks">

		<li class='headdonorlink' ><a href="/admins/index">Dashboard</a></li>
		<li class='headdonorlink'> </li>
		
		<?php if($session->read('sessionprojectid') =='' || $session->read('sessionprojectid') =='0'){  ?>
					
					<li class="liststylenone" id="projectlistid">Manage Project
						<div>
							<ul >
								<li><a  href="/admins/index">View Projects</a></li>
								<li><a  href="/admins/addproject">Add New Project</a></li>
							</ul>
						</div>
					</li>
					
			 		 <li class="liststylenone" id="changepasswordid">Change Password
						<div>
							<ul >
								<li><a href="/admins/changePassword">Change Password</a></li>
							</ul>
						</div>
					</li>
			
					<li class="liststylenone" id="projecttypeid">Manage Project Type
						<div>
							<ul >
								<li><a  href="/admins/projecttype">View Project Type</a></li>
								<li><a  href="/admins/addprojecttype">Add Project Type</a></li>
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="companytype">Manage Company Type
						<div>
							<ul >
								<li><a  href="/admins/companytype">View Company Type</a></li>
								<li><a  href="/admins/addcompanytype">Add Company Type</a></li>
							</ul>
						</div>
					</li>
					<!--<li class="liststylenone" id="commenttype">Manage Comment Type
						<div>
							<ul >
								<li><a  href="/admins/commenttype">View Comment Type</a></li>
								<li><a  href="/admins/addcommenttype">Add Comment Type</a></li>
							</ul>
						</div>
					</li>-->
					
					<li class="liststylenone" id="contacttype">Manage Contact Type
						<div>
							<ul >
								<li><a  href="/admins/contacttype">View Contact Type</a></li>
								<li><a  href="/admins/addcontacttype">Add Contact Type</a></li>
							</ul>
						</div>
					</li>
					
					
					<li class="liststylenone" id="shippingtypeid">Manage Shipping Type
						<div>
							<ul >
								<li><a  href="/admins/shippingtype">View Shipping Type</a></li>
								<li><a  href="/admins/addshippingtype">Add Shipping Type</a></li>
							</ul>
						</div>
					</li>
					<li class="liststylenone" id="companylist">Manage Companies
						<div>

							<ul >
								<li><a  href="/admins/companylist1">View Companies</a></li>
								<li><a  href="/admins/addcompany1">Add Company</a></li>
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="contactlist">Manage Contacts
						<div>

							<ul >
								<li><a  href="/admins/contactlist1">View Contacts</a></li>
								<li><a  href="/admins/addcontacts1">Add Contacts</a></li>
							</ul>
						</div>
					</li>
                    <li class="liststylenone" id="contentlist">Login Terms / Privacy
						<div>
							<ul >
								<li><a  href="/admins/loginterms">Edit Terms / Privacy</a></li>

							</ul>
						</div>
					</li>
					
			<?php }else{  ?>
			
					<li class="liststylenone" id="editprojectdtl"> Project Detail
						<div>
							<ul >
								<li><a  href="/admins/editprojectdtl">Edit Project Detail</a></li>
								<!-- li><a  href="/admins/editprojectdesc">Edit Project Descriptions</a></li-->
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="coinsetlist"> Coinsets
						<div>						
							<ul >
								<li><a  href="/admins/coinsetlist">View Coinsets</a></li>
								<li><a  href="/admins/addcoinset">Add Coinset</a></li>
							</ul>
						</div>
					</li>
					
					<!--<li class="liststylenone" id="editsponsordtl"> Sponsor
						<div>						
							<ul >
								<li><a  href="/admins/editsponsordtl"> Edit Sponsor Detail </a></li>
							</ul>
						</div>
					</li>-->
					
					
					<li class="liststylenone" id="companylist"> Companies
						<div>

							<ul >
								<li><a  href="/admins/companylist">View Companies</a></li>
								<li><a  href="/admins/addcompany">Add Company</a></li>
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="contactlist"> Contacts
						<div>

							<ul >
								<li><a  href="/admins/contactlist">View Contacts</a></li>
								<li><a  href="/admins/addcontacts">Add Contacts</a></li>
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="holderslist"> Members
						<div>
							<ul >							
								<li><a  href="/admins/holderslist">View Coin Holders</a></li>
								<li><a  href="/admins/nonholderslist">View Non Holders</a></li>
								<li><a  href="/admins/addholder">Add New Registration</a></li>
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="holderslist"> Coins
						<div>
							<ul >
								<li><a  href="/admins/registercoinlist">View Registered Coins</a></li>
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="commenttype">Manage Comment Type
						<div>
							<ul >
								<li><a  href="/admins/commenttype">View Comment Type</a></li>
								<li><a  href="/admins/addcommenttype">Add Comment Type</a></li>
							</ul>
						</div>
					</li>

					
					<li class="liststylenone" id="holderslist"> Comments
						<div>
							<ul >
								<li><a  href="/admins/commentlist">View Comments</a></li>
								<li><a  href="/admins/commentreplylist">View Comment Reply</a></li>
							</ul>
						</div>
					</li>
					<?php		
					$contentdtlarr = AppController::getprojectdetails($session->read('sessionprojectid'));
					if($contentdtlarr['ProjectType']['is_rsvp']=="1"){
					?>
					<li class="liststylenone" id="holderslist"> RSVP
						<div>
							<ul >
								<li><a  href="/admins/rsvplist">View RSVP</a></li>
							</ul>
						</div>
					</li>
					<?php }?>
					<li class="liststylenone" id="mailtemplatelist"> Communication
						<div>
							<ul >
								<li><a  href="/admins/mailtemplatelist">View Email Templates</a></li>
								<li><a  href="/admins/addmailtemplate">Add Custom Email Template</a></li>
								<li><a  href="/admins/sendtempmail">Communication</a></li>
								<li><a  href="/admins/commtasklist">View Communication Task</a></li>
								<li><a  href="/admins/addcommtask">Add Communication Task</a></li>
							</ul>
						</div>
					</li>
					<li class="liststylenone" id="contentlist">Web Content
						<div>
							<ul >
								<li><a  href="/admins/contentlist">View Content</a></li>
								<li><a  href="/admins/addcontentpage">Add Content</a></li>
							</ul>
						</div>
					</li>
					
					<li class="liststylenone" id="contentlist">Login Terms / Privacy
						<div>
							<ul >
								<li><a  href="/admins/loginterms">Edit Terms / Privacy</a></li>
							
							</ul>
						</div>
					</li>
					
					

			<?php } ?>

</ul>


<p>&nbsp;</p>


<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>



<script type="text/javascript" language="JavaScript">
/* CONFIG */
	/* set start (sY) and finish (fY) heights for the list items */

	nsY = 24; /* height of li.sub */
	nfY = 165; /* height of maximum sub lines * sub line height */
	/* end CONFIG */

	function animatenew(pY) {
	$('.clicked').animate({"height": pY + "px"}, 100);
	}


	if(document.getElementById("<?php echo $urlshow; ?>")){

	  $('#<?php echo $maindev; ?>').show(function(){

			animatenew(nsY);
			$('.clicked')	.removeClass('clicked')
							.css("background", "#f8f8f8")
							.css("color", "#000");
			$(this)			.addClass('clicked');
			//animatenew(nfY);

	  });
         $('#<?php echo $urlshow; ?>').css('color','#069').css('background','#fff');
	}
</script>