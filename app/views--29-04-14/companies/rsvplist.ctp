<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->

<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
	 <?php  echo $this->renderElement('new_slider');  ?>
 </div>
   <?php echo $form->create("Company", array("action" => "rsvplist",'name' => 'rsvplist', 'id' => "rsvplist")) ?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
        </script>
<span class="titlTxt">
RSVP List
</span>
<div class="topTabs">
        </div>  <div class="clear"></div>
	
	<div class="clear"></div>
       <?php    $this->loginarea="admins";    $this->subtabsel="rsvplist";
             echo $this->renderElement('comments_submenus');  ?>   
            <?php // $this->commenttype="tabSelt";echo $this->renderElement('super_admin_types'); ?>
</div></div>
                            <div class="midCont">

                            <!-- top curv image starts -->
                            <div>
                            <span class="topLft_curv"></span>
		
		<div class="gryTop">
		
		<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
				
			?> 
		</span>
		<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='/companies/rsvplist')" id="locaa"></span>
		<span class="spnFilt">
		 <?php if($session->check('Message.flash')){ ?> 
	
		<?php $session->flash(); } ?>
                    </span>
                        </div> <span class="topRht_curv"></span>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr class="trBg"> 
	<th align="center" width="3%" width="10px">#</th>  
	<th align="center" valign="middle" style="width: 120px;"><span style="float:right"><?php echo $pagination->sortBy('serialnum', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Coin #</th>
 	<th align="center" valign="middle" style="width: 60px;"><span style="float:right"><?php echo $pagination->sortBy('rsvp', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>RSVP</th>
	<th align="center" valign="middle" style="width: 300px;"><span class="right"><?php echo $pagination->sortBy('comment', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Comment</th>
	<th align="center" valign="middle" style="width: 200px;"><span class="right"><?php echo $pagination->sortBy('comment_type_id', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span><a>Comment Type</a></th>
        <th align="center" valign="middle" style="width: 150px;"><span class="right"><?php echo $pagination->sortBy('comment_type_id', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span><a>Posted By</a></th>    
        <th align="center" valign="middle" style="width: 160px;"><span style="float:right"><?php echo $pagination->sortBy('created', '<img src="/img/sorting_arow.png" width="10" height="13" alt="" />',null,null,' ',' '); ?></span>Date</th>       
      </tr> 
   		<?php if($commentlist){
   	   	
   			foreach($commentlist as $eachrow){
   			$recid = $eachrow['Comment']['id'];   	
			$rsvp = $eachrow['Comment']['rsvp'];		
   			$comment = $eachrow['Comment']['comment'];
   			$active_status = $eachrow['Comment']['active_status'];
   			if($comment){
   				$commentnew = AppController::WordLimiter($comment,35);
   			}
   			$commentdate = $eachrow['Comment']['created'];
   			$coinno = $eachrow['CoinsHolder']['serialnum'];
   			$commentdate = AppController::usdateformat($commentdate,1);
   			$firstname = $eachrow['Holder']['firstname'];
   			$lastnameshow = $eachrow['Holder']['lastnameshow'];
   			$fullname = $firstname.' '.$lastnameshow;
			$fullnamechkd=$firstname.$lastnameshow;
			if($fullname)  				$fullname = AppController::WordLimiter($fullname,15);
   			
			$commenttypename="";
			if($eachrow['Comment']['comment_type_id']>0)
			$commenttypename=AppController::getcommenttypename($eachrow['Comment']['comment_type_id']);
   			
   		?>
	<?php if($i%2 == 0) { ?>
   	<tr class='altrow'>	
   		<td align="center" class='newtblbrd'><span><?php echo $i++;?></span></td>
		<td align="left" valign="middle" class='newtblbrd'><span><?php echo $coinno?$coinno:"N/A"; ?></span></td>
		<td align="left" valign="middle" class='newtblbrd'><span><?php echo ($rsvp=="1")?"<font color=green><b>Yes</b></font>":"No";   ?></span></td>
		<td align="left" valign="middle" class='newtblbrd'><span><?php echo $commentnew?$commentnew:"N/A"; ?></span></td>
		<td align="left" valign="middle" class='newtblbrd' ><span><?php echo $commenttypename?$commenttypename:"N/A"; ?></span></td>
		<td align="left" valign="middle" class='newtblbrd'><span><?php echo  $fullnamechkd?$fullname:"N/A"; ?></span></td>
		<td align="left" valign="middle" class='newtblbrd'><span><?php echo $commentdate?$commentdate:"N/A"; ?></span></td>			
		</tr>
	<?php } else { ?>
	<tr>
		<td align="center"><span><?php echo $i++;?></span></td>
		<td align="left" valign="middle"><span><?php echo $coinno?$coinno:"N/A"; ?></span></td>
		<td align="left" valign="middle"><span><?php echo ($rsvp=="1")?"<font color=green><b>Yes</b></font>":"No";   ?></span></td>
		<td align="left" valign="middle"><span><?php echo $commentnew?$commentnew:"N/A"; ?></span></td>
		<td align="left" valign="middle" ><span><?php echo $commenttypename?$commenttypename:"N/A"; ?></span></td>
		<td align="left" valign="middle"><span><?php echo  $fullnamechkd?$fullname:"N/A"; ?></span></td>
		<td align="left" valign="middle"><span><?php echo $commentdate?$commentdate:"N/A"; ?></span></td>			
		</tr>



	<?php } ?>


		
	 <?php } }else{ ?>	 
	<tr><td colspan=6><a><span>No RSVP Found.</a></span></td></tr>
	<?php  } ?>
	</table>
	


  </div>
      <div>
      <span class="botLft_curv"></span>
<div class="gryBot"><?php if($commentlist) { echo $this->renderElement('newpagination'); } ?>
      </div><span class="botRht_curv"></span>
      <div class="clear"></div>
      </div>
<!--inner-container ends here-->
<?php echo $form->end();?>




<div class="clear"></div><!--container ends here-->
    </div>
  <!-- Body Panel ends --> 


