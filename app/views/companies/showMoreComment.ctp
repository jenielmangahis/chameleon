<?php
if(sizeof($comments)==0){
?>
 <tr><td colspan="4" class="forName">No comment posted.</td></tr>
<?php	

}
else 
{
	foreach($comments as $convalue){

	##import holder model for processing
		App::import("Model", "Holder");
      		$this->Holder =   & new Holder();
		$condition = "id = '".$convalue['Comment']['holder_id']."' and  project_id='".$project_id."' and active_status='1' and delete_status='0'";
		$holderdetails = $this->Holder->find('first', array('conditions' => $condition));
		$holder_details="";
		$holder_details.=$holderdetails['Holder']['firstname'];
		if($holderdetails['Holder']['shownamelast']=="1") $holder_details.=" ,".$holderdetails['Holder']['lastnameshow'];
		$holder_details.="(";

		$holder_details.= AppController::getcountryname($holderdetails['Holder']['country']).",".AppController::getstatename($holderdetails['Holder']['state']);
		if($holderdetails['Holder']['showcity']=="1") $holder_details.=" ,".$holderdetails['Holder']['city'];
		if($holderdetails['Holder']['address1']!="" ){
			if($holderdetails['Holder']['showaddress1']=="1") $holder_details.=" ,".$holderdetails['Holder']['address1'];
		}
		if($holderdetails['Holder']['address2']!="" ){
			if($holderdetails['Holder']['showaddress2']=="1") $holder_details.=" ,".$holderdetails['Holder']['address2'];
		}
		$holder_details.=")";		
		
?>
<tr>
    <td class="forName frmTitles" style="width:60%"><?php echo $holder_details;?></td>
    <td class="forName frmTitles" style="width:40%"><?php echo AppController::usdateformat($convalue['Comment']['created'],1)  ; ?></td>
  </tr>
 <tr> 
    <td class="forDate" style="width:100%" colspan=2><?php echo $convalue['Comment']['comment']; ?> </td>    
  </tr>
<?php }
}?>
 