<?php //print_r($styledata);?>
<!--menucolor -->

<div class="footer" id="termsprivacy" >
  <?php echo $html->image('/img/'.$project_name.'/botRht.jpg', array('class'=>'fright rhtMar'));
echo $html->image('/img/'.$project_name.'/botLft.jpg', array('class'=>'fleft'));
?>
<?php /* ?>
<p><font color="#<?php echo $styledata['Theme']['menucolor'] ? $styledata['Theme']['menucolor'] : 'FFFFFF';?>">
	<?php echo COPYRIGHTTXTSPONSOR; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a style="color:inherit;" href="/companies/show_terms/Terms">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a style="color:inherit;" href="/companies/show_terms/Policy">Privacy Statement</a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <a style="color:inherit;" href="/companies/sitemap">Sitemap</a>
</font>
</p>
<?php */ ?>
	<?php echo $project_border_footer_content; ?> 

     <?php //echo $this->element("bottomchatbar");?>       
</div>
