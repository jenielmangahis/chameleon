<div id='pagination'>
<?php
    if($pagination->setPaging($paging)) {
  		$leftArrow = 'Previous';
		$rightArrow = 'Next';
		$prev = $pagination->prevPage($leftArrow,false);
		$first = $pagination->firstPage('First | ',false);

		$last = $pagination->lastPage(' | Last',false);

		$prev = $prev?$prev:$leftArrow;
		$next = $pagination->nextPage($rightArrow,false);
		$next = $next?$next:$rightArrow;

		$pages = $pagination->pageNumbers(" | ");
		
		echo "<table border='0' width='100%'><tr><td style='border-left:0px;border-right:0px;border-bottom:0px;'>".$pagination->result()."</td><td align ='right' style='border-left:0px;border-right:0px;border-bottom:0px;'>".$first."".$prev." | ".$next.$last." </td></tr></table>";
	}
?>
</div>
