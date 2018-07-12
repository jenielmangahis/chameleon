<?php $pagination->setPaging($paging); ?> 
<?php // echo "<pre>"; print_r($commentTypeArray); echo "</pre>"; echo "<pre>"; print_r($coinholderArray); echo "</pre>"; exit;?>
<?php echo "<pre><!-- USER ID-";echo ($uid); echo "--></pre>"; ?>
 <!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">

  <!--<div class="boxBor">
  <div class="boxPad">
  <?php //echo $this->element("leftmenubar");?>  

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
 <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>-->

  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg1">

  <div class="boxBor1">
  <div class="boxPad">
  
  <h2 style="float:left;">Coins & Comments</h2>
    <div style="float: left; position: relative;width: 650px;margin-left:198px; margin-top:-30px;">     
<div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow">

    <?php echo $this->element("leftmenubar");?>  
</div>

</div>
<br />
<br />
<br /> 
  
<a href="/companies/register_coin" class="btn right"><span>  Add New Coin  </span></a>
&nbsp;
<a href="/companies/add_comments/<?php echo $coinholderArray[0]['CoinsHolder']['id'];?>/multi" class="btn right"><span>Add New Comment</span></a>
    <!--<h2>Coins & Comments</h2>-->
 <div class="clear"></div>
 <br />
 


<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>


    <p class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></p>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border_shadow">
<tr>
<td> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10%" class="forName frmTitles" >Coins</td>
    <td width="10%" class="forName frmTitles" > Registered<?php // echo $pagination->sortBy('created','Date Of Registration','CoinsHolder');?></td>
    <td width="10%" class="forName frmTitles" >Commented </td> 
    <td width="20%" class="forName frmTitles" >Suggestion </td> 
    <td width="40%" class="forName frmTitles" >View Comment </td>    
</tr>
</table>
	<!--<td class="forName frmTitles" style="width:23%">Add Comment</td>-->    <!--forDate frmTitles-->
  </td> </tr>
<?php 
if(sizeof($coinholderArray)==0){
?>
 <tr><td colspan="5" class="forName" align=center>No coin registered.</td></tr>

<?php	}else {

?><?php  foreach($coinholderArray as $convalue){ 
$serialnum = $convalue['CoinsHolder']['serialnum'];
                    if(preg_match('/[A-Z]{3}/', $serialnum)==1){
                    $coinsname= preg_split('/[A-Z]{3}/', $serialnum);
                    $serialnum=$coinsname[1];
                    } 
   ?>
   <tr>
<td id="coinholder_<?php echo $convalue['CoinsHolder']['id'];?>"> 
<?php echo "<script language='javascript' type='text/javascript'>
   $(document).ready(function() {     
         $.ajax({
             type: 'GET',
             url: '/companies/view_registeredcoin_comments/".$convalue['CoinsHolder']['id']."',
             cache: false,
             success: function(rText){
                alert(rText);
                //$('#coinholder_".$convalue['CoinsHolder']['id']."').html(rText);  
             }
     });
   });
</script>"; ?>

    <!--<td class="forName frmTitles" style="width:23%">Add Comment</td>-->    <!--forDate frmTitles-->
  </td> </tr>
  
 <tr><td  class="line"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?></td></tr>
<?php  
}
}?>
</table>
    <p class="clear"></p>
    
<p><?php if(sizeof($coinholderArray)>0) echo $this->renderElement('pagination');?></p>   
  </div>
  </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 

<script language='javascript'>
	function showrequestwindow(holder_id,project_id,coin_serial){
		var url = '/companies/show_request/'+holder_id+'/'+project_id+'/'+coin_serial;			
			jQuery.facebox({ ajax: url });
	}
function closewindow(){
 jQuery(document).trigger('close.facebox');
}

 $(document).ready(function() {   //  alert("dom");
     // loadcoinholder("61");
 function loadcoinholder(coinholderid){
     //alert(coinholderid);
     $('#coinholder_'+coinholderid).load('/companies/view_registeredcoin_comments/'+coinholderid);
 }
   /* $("a[id^='plzcomment_']").dblclick(function(){

  alert('Handler for .dblclick() called.');
  var $this = $(this);
  var idarr = $this.attr('id').split('_');
  var commentbox="addcomment_"+idarr[1]+"_"+idarr[2];
   $this.hide();
   $("#"+commentbox).show();
}); */

/* $("input[id^='cancelcomment_']").click(function(){ 
      var $this = $(this);
      var idarr = $this.attr('id').split('_');
      var commentbox=idarr[1]+"_"+idarr[2];
      $("#addcomment_"+commentbox).hide();
       $("#plzcomment_"+commentbox).show();   

 });  */
 /*
  $("input[id^='savecomment_']").click(function(){ 
      var $this = $(this);
      var idarr = $this.attr('id').split('_');
      var commentbox=idarr[1]+"_"+idarr[2];
      
      var comment = $("#comment_"+commentbox).val();
      var coin_holder_id =  idarr[1]; 
      var comment_type = idarr[2];
      
      ajax({
             type: "GET",
             url: '/companies/save_comment/'+coin_holder_id+'/'+comment_type+'/'+comment,
             cache: false,
             success: function(rText){
               $("#addcomment_"+commentbox).hide();
                $("#plzcomment_"+commentbox).show();   
             }
     });
        

 });     */

});
</script>
