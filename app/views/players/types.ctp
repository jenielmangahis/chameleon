<script type="text/javascript">
$(document).ready(function() {
$('#playMnu').removeClass("butBg");
$('#playMnu').addClass("butBgSelt");
}); 
</script>
<?php  
 	switch($option){
		case 'contact':
			echo $this->renderElement('players/contacttype');
			break;
		case 'category':
			echo $this->renderElement('players/categorytype');
			break;
		case 'nonprofit':
			echo $this->renderElement('players/nonprofittype');
			break;
		default:
			echo $this->renderElement('players/companytype');
			break;
 	}
 ?>     