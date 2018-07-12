<?php $url = 'url(http://'.$_SERVER['HTTP_HOST'].'/gosocialcms/img/'.$dataprojects['Project']['project_name'].'/btn-shedow.png) repeat scroll 0 0 #'.$background;  ?>
<style type="text/css" >
.buttonRegis{
	background: <?php echo $url ?>;
	display:block;
	width:150px 
}
.buttonRegis span{
	 cursor: pointer;
     display: inline-block;
	 padding: 5px 50px;
}
</style>
<script type="text/javascript" >
	function funredirect(){
		alert(document.getElementById('registerbtn').href);
		window.top.location.href= document.getElementById('registerbtn').href;
	}
</script>
<?php
if(empty($_SESSION['User']['User']['id'])){ 
	
 echo $form->create("Company", array("action" => "comments",'id'=>'comments', 'name' => 'comments','onclick' => "return funredirect();" ))?>
	

	<?php
				e($html->link(
					$html->tag('span', 'Register'),
					array('controller'=>'companies','action'=>'registeruser'),
					array('escape' => false, 'class'=>'buttonRegis','id'=>'registerbtn')
					)
				);
?>

	
		
	<?php 	echo $form->end();
	}
	?>

