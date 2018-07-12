<div id='pagination'>
<?php 
	if($pagination->setPaging($paging)):
		$leftArrow = 'Previous';
		$rightArrow = 'Next';
		$prev = $pagination->prevPage($leftArrow,false);
		$first = $pagination->firstPage('First | ',false);

		$last = $pagination->lastPage(' | Last',false);

		$prev = $prev?$prev:$leftArrow;
		$next = $pagination->nextPage($rightArrow,false);
		$next = $next?$next:$rightArrow;

		$pages = $pagination->pageNumbers(" | ");

	//$str = str_replace('Results','Records',$pagination->result());

	$str = "<table border='0' width='100%'><tr><td style='border-left:0px;border-right:0px;border-bottom:0px;'>&nbsp;</td><td align ='right' style='border-left:0px;border-right:0px;border-bottom:0px;'>".$first."".$prev." | ".$next.$last." </td></tr></table>";
	 
	$resper = $pagination->resultsPerPage(NULL, ' ');

$perpage = $pagination->resultsPerPage(NULL, ' ');


$perpagearr = array(20,50,100,500);

?>
<!-- Items per page: -->
<table border='0' width='100%'><tr><td style='width:25%;border-left:0px;border-right:0px;border-bottom:0px;height:25px;'>
<?php echo $pagination->result(); ?>&nbsp;&nbsp;

Display #
<select onchange="setURL('show', this.value)" class="slct50">
<?php

 for($i=0;$i<count($perpagearr);$i++){

if(isset($_REQUEST['show']) && $perpagearr[$i]==$_REQUEST['show']){
$selected = 'selected';

}else{
$selected ='';
}
if(!isset($_REQUEST['show']) && $perpagearr[$i]==20)
$selected = 'selected';


?> 
 <option value="<?php echo $perpagearr[$i];?>" <?php echo $selected;?>><?php echo $perpagearr[$i];?></option>

<?php  } ?>
</select>
 </td>
<td style='text-align:right;width:25%; border-left:0px;border-right:0px;border-bottom:0px;'> <?php echo $str; ?> </td>
</tr>
</table>

<?php
    endif;
?>
</div>