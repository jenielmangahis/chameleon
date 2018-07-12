<img id="loader"  />

<div style="width: 600px; border: 1px solid rgb(102, 102, 102); margin: 0pt auto;">
<table width="60%" border="0" cellspacing="0" cellpadding="0">
<tr>    
    <td  style="width: 50%; padding:5px 20px;"> <b style="color:#04709B; font-size:13px;">Name</b></td>
    <td style="width: 50%; padding:5px 20px;"><b style="color:#04709B; font-size:13px;">Actions</b> </td>    
  </tr>
<?php
if(sizeof($cointranferrequest)==0){
?>
 <tr><td colspan="2" class="forName">No request.</td></tr>
<?php	

}else {

foreach($cointranferrequest as $convalue){

?>
<tr>
    <td  style="width: 50%; padding:5px 20px;"><?php echo $convalue['Holder']['firstname']." ".$convalue['Holder']['lastnameshow'] ?></td>   
    <td style="width: 50%; padding:5px 20px;"><a href="javascript:void('0');" onclick="acceptrequest('<?php echo $convalue['CoinTransferRequest']['id']; ?>');">Accept</a> | <a href="javascript:void('0');" onclick="denyrequest('<?php echo $convalue['CoinTransferRequest']['id']; ?>');">Deny</a></td>    

  </tr>
<?php }
}
?>

</table>
</div>
<script type="text/javascript">
function acceptrequest(id){

document.getElementById('loader').src="/img/<?php echo $project_name?>/loading.gif"; 
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   
 	//document.getElementById("success_msg").innerHTML=xmlhttp.responseText;
	closewindow();
    }
  }
xmlhttp.open("GET",'/companies/acceptrequest/'+id,true);
xmlhttp.send();

}
function denyrequest(id){

document.getElementById('loader').src="/img/<?php echo $project_name?>/loading.gif"; 
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  //  document.getElementById("success_msg").innerHTML=xmlhttp.responseText;
	closewindow();
    }
  }
xmlhttp.open("GET",'/companies/denyrequest/'+id,true);
xmlhttp.send();

}


</script>