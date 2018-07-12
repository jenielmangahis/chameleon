<?php
if(sizeof($comments)==0){
?>

   <div class="commtBox">
    <p><b>No comment found.</b></p>
    </div>
<?php	
}
else 
{
?>
<?php foreach($comments as $convalue){?> 
<?php 	
		App::import("Model", "Holder");
      		$this->Holder =   & new Holder();
		$condition = "id = '".$convalue['Comment']['holder_id']."' and  project_id='".$project_id."' and active_status='1' and delete_status='0'";
		$holderdetails = $this->Holder->find('first', array('conditions' => $condition));
		$holder_details="";
		
		
		$holder_details.=$holderdetails['Holder']['screenname'].' ';

		//if($holderdetails['Holder']['shownamelast']=="1") $holder_details.= $holderdetails['Holder']['lastnameshow'];

		$holder_details.="(";
		
		if($holderdetails['Holder']['address1']!="" ){
			if($holderdetails['Holder']['showaddress1']=="1") $holder_details.= $holderdetails['Holder']['address1'].', ';
		}
		if($holderdetails['Holder']['address2']!="" ){
			if($holderdetails['Holder']['showaddress2']=="1") $holder_details.=$holderdetails['Holder']['address2'].', ';
		}
		if($holderdetails['Holder']['city']!="" ){
			if($holderdetails['Holder']['showcity']=="1") $holder_details.=$holderdetails['Holder']['city'].', ';
		}
		
		if($holderdetails['Holder']['state']!="" ){
		if($holderdetails['Holder']['state']!="0" ){
			 $holder_details.=AppController::getstatename($holderdetails['Holder']['state']).', ';
		}
		}
		
		$holder_details .= AppController::getcountryname($holderdetails['Holder']['country']);

		$holder_details.=" ".$holderdetails['Holder']['zipcode'];
		
		
		$holder_details.=")";

		$holder_user_id=$holderdetails['Holder']['user_id'];

		$comment_type_name="";		
		if($convalue['Comment']['comment_type_id']>0)
		 $comment_type_name=AppController::getcommenttypename($convalue['Comment']['comment_type_id']); 

$rsvp="I am not going to attend event";
if($convalue['Comment']['rsvp']=="1") $rsvp="I am going to attend event";
?>

<h3 class="commTitle">
    <span class="postedby">Posted by:</span> <?php echo  $holder_details;	?><br />
<span class="dateSpn"><?php echo AppController::usdateformat($convalue['Comment']['created'],1)  ; ?></span>
<?php if($project['ProjectType']['maxnumbercomment']>1) { ?>
<br/><span class="dateSpn"><?php  echo $comment_type_name; ?></span>
<?php } ?>
<?php  if($project['ProjectType']['is_rsvp']=="1") { ?>
<br/><span class="dateSpn"><?php echo $rsvp; ?></span>
<?php } ?>
   </h3>
    <div class="commtBox">
    <p><?php echo $convalue['Comment']['comment']; ?></p>
<?php if($holder_user_id!=$_SESSION['User']['User']['id']) { ?>
<p><span class="right" ><a ahref="javascript:void(0);" onclick="showcontentwindow('<?php echo $convalue['Comment']['coin_holder_id']; ?>','<?php echo $convalue['Comment']['id']; ?>','<?php echo $user_id;?>','<?php echo $project_id;?>')" style="cursor:pointer;">report offensive comment</a></span></p>
<?php }?>
    </div>
 
<?php }
 } ?>