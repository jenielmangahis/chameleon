<?php $lgrt = $session->read('newsortingby');
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'registercoinlist';
?>
<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
  <div class="container">
<div class="titlCont1"><div style="width:960px; margin:0 auto;">


<div align="center" class="slider width960" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>


</div>

<?php echo $form->create("Admin", array("action" => "viewcomments/$coin_holder_id",'type' => 'file','enctype'=>'multipart/form-data','name' => 'viewcomments', 'id' => "contentlist"))?>



 <?php  echo $this->renderElement('project_name');  ?>
<span class="titlTxt"> Comment on  #<?php echo $coinserial; ?> <!-- <input type='button' class='right btn' value='Back' onClick="history.go(-1);return true;">-->
</span>
<div class="topTabs">
<ul>
<!--li><a href="/companies/addholder"><span>New</span></a></li>
<li><a href="#." class="tab2"><span>Actions</span></a></li-->
<!--li><a href="/companies/actioncomment/<?php //echo $coin_holder_id; ?>"><span>Detail</span></a></li-->
<li><a href="<?php echo $backUrl;?>"><span>Cancel</span></a></li>
</ul>
</div>
</div></div>
	<div class="midCont">


	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		
		<div>
<span class="topLft_curv"></span>
		<div class="gryTop">
	  
		<script type='text/javascript'>
		function setprojectid(projectid){
	  document.getElementById('projectid').value= projectid;
	document.adminhome.submit();
}
	</script>
		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
	?> 
		</span>
<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'viewcomments/<?php echo $coin_holder_id; ?>')" id="locaa">
<input type="hidden" name="data[CoinHolder][id]" value="<?php echo $coin_holder_id; ?>">
</span>
		<span class="spnFilt">
		<?php if($session->check('Message.flash')){ ?> 

	  <?php $session->flash(); } ?>
		  </span>
			  </div>  <span class="topRht_curv"></span>
<div class="clear"></div></div>

	

  <div class="tblData">

 <table width="100%" border="0" cellspacing="0" cellpadding="0" >  
<tr class="trBg">
	  	  <th align="left" valign="middle" width="4%"># </th>
		 <th align="left" valign="middle" >Comment Posted By </th>
		  <th align="left" valign="middle">Comment </th>
	 
          <th align="left" valign="middle" >Date</th>
          <th align="left" valign="middle" width="6%" >Action</th>
</tr>  		
   		
   	
<?php $i=1; ?>
			<?php if($commentlist){
				
						foreach($commentlist as $eachrow){
						
						$recid = $eachrow['Comment']['id'];
						
						$comment = $eachrow['Comment']['comment'];
						/*if($comment){
							$commentnew = AppController::WordLimiter($comment,15);
						}*/

						$commentdate = $eachrow['Comment']['created'];
						$commentdate = AppController::usdateformat($commentdate,1);
						$firstname = $eachrow['Holder']['firstname'];
						$lastnameshow = $eachrow['Holder']['lastnameshow'];
						$fullname = $firstname." ".$lastnameshow;
                        if($fullname=="" || $fullname==" "){
                            $fullname=  $firstname = $eachrow['Holder']['screenname']; 
                        }
						
					?>

	
		<tr>
		<td align="left" valign="middle"><?php echo $i++; ?></td>
		<td align="left" valign="middle"><?php echo $fullname?$fullname:"N/A"; ?></td>
		<td align="left" valign="middle"><?php echo $comment?$comment:"N/A"; ?></td>
		<td align="left" valign="middle"><?php echo $commentdate?$commentdate:"N/A"; ?></td>
		
		<td align="left" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', 'Detail'),
					array('controller'=>'admins','action'=>'actioncomment',$recid,$coin_holder_id),
					array('escape' => false,'title'=>'Click here to view detail of this comment')
					)
				);
			?>
		</td>
		
		</tr>
		
	 <?php } ?>
	</table>
      <?php }else{ ?>
	<table><tr><td colspan="3" align="center">No Comments Found.</td></tr></table>
	<?php  } ?>
    

 </div>
    <!-- bot curv image starts -->
    <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($commentlist) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>
    </div>
    <!-- bot curv image ends -->

<!--inner-container ends here-->

<?php echo $form->end();?>



<div class="clear"></div>
</div>
