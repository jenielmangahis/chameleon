<?php   
//pr($this->data);
//pr($socialicons);
//pr($page_content);

?>

<?php if($rightbar==1) {?>
	<div class="leftPanel">
<?php } else { ?>
	<div class="leftPanel" style="width:878px;padding:auto 15px">
<?php } ?>

  <!--<div class="clear">&nbsp;</div>-->
  <div class="editorTxt">
    <?php echo $page_content['Content']['content'];?>
  </div>
  
  </div>

  <script type="text/javascript">
  function saveClickInfo(str)
  {
    var currentUrl = "<?php echo $this->params['url']['url'];?>";
    if(currentUrl=="/")
    {
      currentUrl =  "<?php echo Router::url('/',true);?>";
    }  
    var urlToSend = "<?php echo Router::url('/',true);?>links/add_history/"+str;
    $.ajax({
    type: "POST",
    url: urlToSend,	
    data:{passUrl:currentUrl},
    success:  function(data){
         }
	});
  }
  </script>