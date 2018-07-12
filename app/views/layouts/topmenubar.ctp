<script type="text/javascript">
var menu=function(){
	var t=15,z=50,s=6,a;
	function dd(n){this.n=n; this.h=[]; this.c=[]}
	dd.prototype.init=function(p,c){
		a=c; var w=document.getElementById(p), s=w.getElementsByTagName('ul'), l=s.length, i=0;
		for(i;i<l;i++){
			var h=s[i].parentNode; this.h[i]=h; this.c[i]=s[i];
			h.onmouseover=new Function(this.n+'.st('+i+',true)');
			h.onmouseout=new Function(this.n+'.st('+i+')');
		}
	}
	dd.prototype.st=function(x,f){
		var c=this.c[x], h=this.h[x], p=h.getElementsByTagName('a')[0];
		clearInterval(c.t); c.style.overflow='hidden';
		if(f){
			p.className+=' '+a;
			if(!c.mh){c.style.display='block'; c.style.height=''; c.mh=c.offsetHeight; c.style.height=0}
			if(c.mh==c.offsetHeight){c.style.overflow='visible'}
			else{c.style.zIndex=z; z++; c.t=setInterval(function(){sl(c,1)},t)}
		}else{p.className=p.className.replace(a,''); c.t=setInterval(function(){sl(c,-1)},t)}
	}
	function sl(c,f){
		var h=c.offsetHeight;
		if((h<=0&&f!=1)||(h>=c.mh&&f==1)){
			if(f==1){c.style.filter=''; c.style.opacity=1; c.style.overflow='visible'}
			clearInterval(c.t); return
		}
		var d=(f==1)?Math.ceil((c.mh-h)/s):Math.ceil(h/s), o=h/c.mh;
		c.style.opacity=o; c.style.filter='alpha(opacity='+(o*100)+')';
		c.style.height=h+(d*f)+'px'

	}
	return{dd:dd}
}();
</script>

<?php 
$globalcondition="";	

if(empty($_SESSION['User']['User']['id'])) $globalcondition="and Content.is_global='1'";

$showcommenttab="";
if($project['ProjectType']['coin_verification']=="1")
{
	if($project['ProjectType']['showcommentbutton']=="1")
		{		$showcommenttab="";	}
	else{
		if(empty($_SESSION['User']['User']['id'])) 
		$showcommenttab="and Content.alias !='comments'";
		else
		{
			if(AppController::iscoinholder($_SESSION['User']['User']['id'])=="false")
			{			
				$showcommenttab="and Content.alias !='comments'";
			}	
		}
	}
}
else
{
	if($project['ProjectType']['showcommentbutton']=="1")
	{		$showcommenttab="";	}
	else
	{		$showcommenttab="";	}
} 

App::import("Model", "Content");
$this->Content =   & new Content();
$contentcount = $this->Content->find('count', array('conditions' => "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and parent_id='0' and Content.delete_status='0' and Content.alias !='privacy' and Content.alias !='terms' and Content.alias !='home_page' ".$globalcondition." ".$showcommenttab,'fields'=>'id'));
?>
<!--<div>&nbsp;</div>
<div class="navBg" >-->
	<!--<?php echo $html->image('/img/'.$project_name.'/navRht.gif', array('class'=>'right'));
	echo $html->image('/img/'.$project_name.'/navLft.gif', array('class'=>'left'));
	?>-->
	<!--<ul class="left menu" id="menu">-->
	<li><a href="<?php echo '/'.$project_name ?>" <?php if($page_url=="home_page") echo 'class=active' ;  ?>><span>Home</span></a></li>
	<?php 	
		$condition = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='0' and Content.alias !='privacy' and Content.alias !='terms' and Content.alias !='home_page' ".$globalcondition." ".$showcommenttab;
		$contentdetails = $this->Content->find('all', array('conditions' => $condition,'order'=>'file_sequence','limit'=>'0,7'));

	foreach($contentdetails as $convalue)
	{
{?>
		<li><a href="/companies/<?php echo $convalue['Content']['alias'];?>" <?php if($page_url== $convalue['Content']['alias']) echo 'class=active' ;  ?>><span><?php
		 $title =$convalue['Content']['title'];
		if($title){$title =AppController::WordLimiter($title,20);}
		 echo $title;
		?></span></a><ul>
		<?php } ?>
		<?php $parentid=$convalue['Content']['id'];  
		//$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
		$condition2 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$parentid' and Content.alias !='privacy' and Content.alias !='terms' and Content.alias !='home_page' ".$globalcondition." ".$showcommenttab;
		$submenus = $this->Content->find('all', array('conditions' =>$condition2,'order'=>'file_sequence','limit'=>'0,7'));
		if ($submenus!="")
			{?>	
				<?php foreach($submenus as $submenu)
				{ ?> 
				
					<li  class="sub" >
					<a href="/companies/<?php echo $submenu['Content']['alias'];?>" <?php if($page_url== $submenu['Content']['alias']) echo 'class=active' ;  ?>><?php 
					$title1=$submenu['Content']['title'];
					if($title1){$title1 =AppController::WordLimiter($title1,20);}
		 			echo $title1;
					?></a>


					<ul>
<?php $subparentid=$submenu['Content']['id'];  
//$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
$condition3 = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and parent_id ='$subparentid' and Content.alias !='privacy' and Content.alias !='terms' and Content.alias !='home_page' ".$globalcondition." ".$showcommenttab;
$subsubmenus = $this->Content->find('all', array('conditions' =>$condition3,'order'=>'file_sequence','limit'=>'0,7'));
if ($subsubmenus!="")
{?>	
			<?php foreach($subsubmenus as $subsubmenu)
			{ ?>
					<li>
						<a href="/companies/<?php echo $subsubmenu['Content']['alias'];?>" <?php if($page_url== $subsubmenu['Content']['alias']) echo 'class=active' ;  ?>><?php $title2=$subsubmenu['Content']['title'];
						if($title2){$title2 =AppController::WordLimiter($title2,20);}
		 				echo $title2;
						?></a>
					<li>
			<?php }} ?>

</ul>





					</li>
				
				<?php }?>
				 
			<?php } ?>
			
	
			</ul>
		</li>
	<?php 
	} 
	
	?>
	
	<!--</ul>-->
 <!--<div class="clear"></div>-->
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>
<!--</div>-->
<?php if($contentcount>7 )
{?>
<!--<div class="clear">--> <?php  echo $html->image('/img/'.$project_name.'/spacer.gif', array());?><!--</div>-->
<!--<div class="navBg lftMgrn"> 
<ul class="left" id="menu">-->
<?php 	
$condition = "Content.project_id='".$project['Project']['id']."' and Content.active_status='1' and Content.delete_status='0' and Content.alias !='privacy' and Content.alias !='terms' and Content.alias !='home_page' ".$globalcondition." ".$showcommenttab;
$contentdetails = $this->Content->find('all', array('conditions' => $condition,'order'=>'file_sequence','limit'=>'7,'.$contentcount));

foreach($contentdetails as $convalue)
{


?>

  	<li><a href="/companies/<?php echo $convalue['Content']['alias'];?>" <?php if($page_url== $convalue['Content']['alias']) echo 'class=active' ;  ?>><span><?php echo $convalue['Content']['title'];?></span></a>
	
	<?php $parentid=$convalue['Content']['id'];  
	$condition2="Content.project_id='".$project['Project']['id']."' and Content.parent_id='".$parentid."'";
	$submenus = $this->Content->find('all', array('conditions' =>$condition2));
	if ($submenus!="")
		{
			foreach($submenus as $submenu)
			{ ?> 
			<ul>
				<li>
				<a href="/companies/<?php echo $submenu['Content']['alias'];?>" <?php if($page_url== $submenu['Content']['alias']) echo 'class=active' ;  ?>><span><?php echo $submenu['Content']['title'];?></span></a>
				</li>
			</ul>
			<?php } } ?>
		


	</li>
		<?php 
		} ?>

<!--</ul>-->
<!--</div> --> 
<?php } 
?>
<!--<div class="clear">&nbsp;</div>-->
