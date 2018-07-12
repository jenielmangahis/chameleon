<?php
				$serUrl=explode('/',$_SERVER['REQUEST_URI']);
				$dsclass='';$reclass='';$viewclass='';$viewpclass='';$invclass='';$dseclass='';$updpclass='';$message='';

				if($serUrl['3']=='iframe_dashboard'){
					$dsclass="tabcheck";
				}else if($serUrl['3']=='register_coin'){
					$reclass="tabcheck";
				}else if($serUrl['3']=='view_registeredcoins'){
					$viewclass="tabcheck";
				}
			?>

<ul class="dash_menu" style="margin-left: 5px; margin-right: 5px; ">
<li  style="border-right:2px solid white;">
	<!--<a href="/companies/iframe_dashboard" class="<?php if( $_SERVER['REQUEST_URI']=="/companies/iframe_dashboard") echo "tabcheck"; ?>" ><span>Dashboard</span></a>-->

	<?php
				e($html->link(
					$html->tag('span', 'Dashboard'),
					array('controller'=>'companies','action'=>'iframe_dashboard'),
					array('escape' => false,'class'=>$dsclass)
					)
				);
?>
</li>
<li  style="border-right:2px solid white;">
	<!--<a href="/companies/register_coin" class="<?php if( $_SERVER['REQUEST_URI']=="/companies/register_coin") echo "tabcheck"; ?>" ><span>Register coin</span></a>-->

		<?php
				e($html->link(
					$html->tag('span', 'Register coin'),
					array('controller'=>'companies','action'=>'register_coin'),
					array('escape' => false,'class'=>$reclass)
					)
				);
?>
</li>
<li  style="border-right:2px solid white;">
<!--	<a href="/companies/view_registeredcoins" class="<?php if( $_SERVER['REQUEST_URI']=="/companies/view_registeredcoins" ) echo "tabcheck"; ?>" ><span>Coins & Comment</span></a>-->

	<?php
				e($html->link(
					$html->tag('span', 'Coins & Comment'),
					array('controller'=>'companies','action'=>'view_registeredcoins'),
					array('escape' => false,'class'=>$viewclass)
					)
				);
?>
</li>
<!--
<li  style="border-right:2px solid white;"><a href="/companies/invite_friends" class="<?php if( $_SERVER['REQUEST_URI']=="/companies/invite_friends") echo "tabcheck"; ?>" ><span>Invite</span></a></li>
<li  style="border-right:2px solid white;"><a href="/companies/update_profile" class="<?php if( $_SERVER['REQUEST_URI']=="/companies/update_profile") echo "tabcheck"; ?>" ><span>Edit Profile</span></a></li>
<li  style="border-right:2px solid white;"><a href="/companies/messages" class="<?php if( $_SERVER['REQUEST_URI']=="/companies/messages") echo "tabcheck"; ?>" ><span>Message</span></a></li>
-->
<li>
	<!--<a href="/companies/iframe_logout"><span>Logout</span></a></li>-->
<?php
				e($html->link(
					$html->tag('span', 'Logossut'),
					array('controller'=>'companies','action'=>'iframe_logout'),
					array('escape' => false)
					)
				);
?>

</ul>


