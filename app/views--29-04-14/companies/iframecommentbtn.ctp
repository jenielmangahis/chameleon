<?php $url = 'url(http://'.$_SERVER['HTTP_HOST'].'/gosocialcms/img/'.$dataprojects['Project']['project_name'].'/btn-shedow.png) repeat scroll 0 0 #'.$background;  ?>
<style type="text/css" >
.commentBtn{
	background: <?php echo $url; ?>;
	display:block;
	width:150px 
}
.commentBtn span{
	 cursor: pointer;
     display: inline-block;
	 padding: 5px 50px;
}
</style>
<script type="text/javascript" >
	function funredirect(noofcomments){
		if(noofcomments ==0)
		{
			 inlineMsg('gmap','<strong>No Data Available.</strong>',2);
			 return false;
		}
		window.top.location.href= document.getElementById('commentBtn').href;
	}
</script>
<?php
if(empty($_SESSION['User']['User']['id'])){ 	
 echo $form->create("Company", array("action" => "comments",'id'=>'comments', 'name' => 'comments','onsubmit' => "return funredirect(".$noofcomments.");" ))?>

<?php
				e($html->link(
					$html->tag('span', 'Comment'),
					array('controller'=>'companies','action'=>'comments'),
					array('escape' => false, 'class'=>'buttonRegis', 'class'=>'commentBtn')
					)
				);
?>
	<?php 	echo $form->end();
	
	}
	?>

