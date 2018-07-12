
 <!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">
 
  <div class="boxBor">
  <div class="boxPad">
 
  <?php echo $this->element("leftmenubar");?>  
   <p>&nbsp;</p>
  </div>
  </div>


  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg">

  <div class="boxBor1">
  <div class="boxPad1" style="width:747px;;">
   <div class="right">

  <?php

if($coinsdetail['Coinset']['sidea']=="")
echo $html->image('/img/'.$project_name.'/sideA.png', array('class'=>'','width'=>'150','height'=>'150'));
else
//<!--'width'=>'107','height'=>'109'-->
echo $html->image('/img/'.$project_name.'/uploads/'.$coinsdetail['Coinset']['sidea'], array('class'=>'','width'=>'145','height'=>'145'));
?><?php // echo $html->image('/img/'.$project_name.'/spacer.gif', array('width'=>'20','height'=>'1'));?><?php
if($coinsdetail['Coinset']['sideb']=="")
echo $html->image('/img/'.$project_name.'/sideB.png', array('class'=>'','width'=>'150','height'=>'150'));
else
echo $html->image('/img/'.$project_name.'/uploads/'.$coinsdetail['Coinset']['sideb'], array('class'=>'','width'=>'145','height'=>'145'));
?>

  </div>
    <h2>Add Comments</h2>
     <b> <span style="color:red">* </span>Required Field.</b>
     <p class=""><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<?php echo  $form->create('Coinset',array('action'=>'/companies/add_comments','id'=>'','url'=>$this->here,'onsubmit' => 'return validatecomment("add");','AUTOCOMPLETE' => 'off'
));?>
<?php echo $form->input('coinset',array('value'=>$coinset,'type'=>"hidden", 'id'=>"coinset" )) ?>

<?php if(empty($allcoin_details)){   echo $form->input('coin_holder_id',array('value'=>$coinholderid,'type'=>"hidden", 'id'=>"coinset" )); } ?>
<?php //echo $form->input('comment_type_id',array('value'=>$comment_type_id,'type'=>"hidden", 'id'=>"comment_type_id" )) ?>


<div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>

<div><lable class='lbl'>Coin Serial Number</lable> <?php 

if(count($allcoin_details) <= 1){

					if(preg_match('/[A-Z]{3}/', $coinserial)==1){
					$coinsname= preg_split('/[A-Z]{3}/', $coinserial);
					$coinserial=$coinsname[1];
					}



echo $form->input('coinserial',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"coinserial",'value'=>$coinserial,'readonly'=>'readonly', 'class'=>'inptBox1')) ;
}
else
{
	foreach($allcoin_details as $details){

		

		$coinsholderid=$details['CoinsHolder']['id'];
					App::import("Model", "Comment");
		            $this->Comment =   & new Comment();	

					$noofcomments = $this->Comment->find('count',array('conditions' => "Comment.project_id='".$project['Project']['id']."'  and  Comment.coin_holder_id =
".$coinsholderid." and  Comment.active_status='1' and Comment.delete_status='0' "));


  			if($project['ProjectType']['maxnumbercomment']>=$noofcomments){
                $serialnum = $details['CoinsHolder']['serialnum'];
					if(preg_match('/[A-Z]{3}/', $serialnum)==1){
					$coinsname= preg_split('/[A-Z]{3}/', $serialnum);
					$serialnum=$coinsname[1];
					}
				$options[$details['CoinsHolder']['id']]=$serialnum;
						
				}
}

	if (count($options) == 1) {
		$optkeys = array_keys($options);
		$selected = $optkeys[0];
		
		/*
		$conditions = array('CommentType.project_id' => $project['Project']['id'], 'CommentType.active_status' => '1', 'CommentType.delete_status' => '0');
		$commTypes = ClassRegistry::init('CommentType')->find('list', array('conditions' => $conditions, 'fields' => array('comment_type_name')));
		*/
	}
	else {
		$selected = '0';
	}
	 echo $form->select("id",$options,$selected,array('id' => 'coinserial','style'=>'width:169px'),array('0'=>'-----Select-----'),false); 
}
$conditions = array('ProjectType.project_id' => $project['Project']['id'], 'ProjectType.active_status' => '1', 'ProjectType.delete_status' => '0');
$additionalComment = ClassRegistry::init('ProjectType')->find('first', compact('conditions'));
if ($additionalComment['ProjectType']['additional_comment'] == '1') {
	$addComm = $additionalComment['ProjectType']['additionalcomment'];
}
else {
	$addComm = 0;
}

$commtypes = array_keys($commenttypedropdown);
if (count($allcoin_details) <= 1) {
	$commented = ClassRegistry::init('Comment')->find('list', array('conditions' => array('Comment.coin_holder_id' => $coin_holder_id, 'Comment.comment_type_id' => $commtypes), 'fields' => array('comment_type_id')));
	//print_r($commenttypedropdown);
	//print_r($commented);
	foreach ($commented as $commtypeid) {
		if ($commtypeid != $addComm) {
			unset($commenttypedropdown[$commtypeid]);
		}
	}
}


?></div>
<p class=""><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<?php 
	if ($maxnumbercomment>=1) {
		$commTypeCount = count($commenttypedropdown);
		if ($commTypeCount == 1) {
			$keys = array_keys($commenttypedropdown);
			$selectedCommType = $keys[0];
		}
		else {
			$selectedCommType = 0;
		}
		
?>
<div><lable class='lbl'>Comment Type</lable> <?php echo $form->select("comment_type_id",$commenttypedropdown,$selectedCommType,array('id' => 'comment_type_id','class'=>'dRopcom','onchange'=>'return getcommenttypepurpose(this.value)'),array('0'=>'-----Select-----'),false); ?></div>
<p class=""><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<div><lable class='lbl'>Comment Type Purpose</lable> <div id="commenttypepurpose"></div></div>
<p class=""><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<?php }?>
<?php if($project['ProjectType']['is_rsvp']==1) {?>
<div><lable class=''>Are you going to attend this event?:</lable> <?php echo $form->input('rsvp', array('type'=>'checkbox','div' => false, 'label' => '')); ?></div>
<p class=""><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<?php }?>
<div><table><tbody><tr><td style="vertical-align: top;"><lable class='lbl'>Comments<span style="color:red">*</span></lable></td> <td> <?php echo $form->textarea("comments", array('id' => 'comments', 'div' => false, 'label' => '','cols' => '50', 'rows' => '4', 'class'=>'top','style'=>'border:1px solid #BEDAE5;'));?> </td></tr></table></div>
<p class=""><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<div><lable style="width:150px; margin-right:5px;display:inline-block;">&nbsp;</lable> <?php echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?> &nbsp;<?php echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'javascript:location.href="/companies/view_registeredcoins"'));?>
</div>
	
<p class=""><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
  <div >     
    <p ><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>


<?php if(empty($allcoin_details)) { ?>
<center><span id="success_msg"></span></center>
    <p><b>Previous Comments</b></p>

<span id="gridTable">
</span>
	 <table border="0" width='100%' class="olderPost"  cellspacing="0" cellpadding="0">
							<tr>
								<td align="right" colspan="3" valign="middle" width="50%">
									<input id="snCounter" type="hidden" value="2" > 
									<input id="coin_holder_id" type="hidden" value="<?php echo $coin_holder_id ?>" > 
									<input type="hidden" name="hidden" id="startLimit" value="0"/>
									<input type="hidden" name="hidden" id="endLimit" value="2"/>
									<a id="olderPost" href="javascript:void(0);"><img src="/img/<?php echo $project_name?>/down-arrow.png" border="0" valign="middle" width="11" height="5"> <b>More</b></a>
								</td>
								<td width="50%" align="left">
									<img id="indicator" style="display:none" src="/img/<?php echo $project_name?>/loader.gif" >
								</td>
							</tr>
						</table>

<?php } ?>
<?php echo $form->end();?>

 <p class="clear"></p>
    </div>
  </div>

  </div>
  
  </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 

<script type="text/javascript">
 $(document).ready(function() {
var startLimit= parseInt($("#startLimit").val())+2;
        var counter= $("#snCounter").val();	
	 var coin_holder_id= $("#coin_holder_id").val();	
	jQuery.ajax({
             type: "GET",
             url: '/companies/ajaxmorecomment/'+startLimit+'/'+coin_holder_id,
             cache: false,
             success: function(rText){
                    //alert(rText);
                     jQuery('#gridTable').html(rText);			
             }
     });
$("#startLimit").val(startLimit);
 
<?php if($maxnumbercomment>1) {?>
getcommenttypepurpose($('#comment_type_id').val());
<?php }?>

$('#coinserial').change(function() {
	 var coinHolderId = $("#coinserial").val();
	jQuery.ajax({
             type: "GET",
             url: '/companies/commenttypedropdown/'+ coinHolderId,
             cache: false,
             success: function(response){
                     //jQuery('#gridTable').html(rText);
                     $('#comment_type_id').html(response);
                     
             }
     });

});

});
$("#olderPost").click(function (){ 
      $("#indicator").show();
        var startLimit= parseInt($("#startLimit").val())+2;
        var counter= $("#snCounter").val();	
	 var coin_holder_id= $("#coin_holder_id").val();
	jQuery.ajax({
             type: "GET",
             url: '/companies/ajaxmorecomment/'+startLimit+'/'+coin_holder_id,
             cache: false,
             success: function(rText){
                   ///alert(rText);
                     jQuery('#gridTable').html(rText);			
             }
     });
$("#startLimit").val(startLimit); 
$("#indicator").hide();
    });

function getcommenttypepurpose(comment_type_id){
jQuery.ajax({
             type: "GET",
             url: '/companies/commenttypepurpose/'+comment_type_id,
             cache: false,
             success: function(rText){
                    //alert(rText);
                     jQuery('#commenttypepurpose').html("<lable class='lbl'>&nbsp;</lable>"+rText);			
             }
     });
}

function showcontentwindow(coin_holder_id,comment_id,user_id,project_id){
	var url = '/companies/report_popup/'+coin_holder_id+'/'+comment_id+'/'+user_id+'/'+project_id;			
		jQuery.facebox({ ajax: url });
}
function closewindow(){
 jQuery(document).trigger('close.facebox');
}

function validatemessage(){	

    	 if($('#comments12').val() == '')
	 {
		 inlineMsg('comments12','<strong>Comments required.</strong>',2);
		 return false;
	 }
	if(hasWhiteSpace($('#comments12').val()) == true){
				 inlineMsg('comments','<strong>Only alpha numeric character allowed.</strong>',2);
				 return false; 
			}
	 if(tagValidate($('#comments12').val()) == true){
		 inlineMsg('comments12','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	 } 

 return true; 
}

function submitdata(){


if(validatemessage())
{
$("#indicator1").show();
var coin_holder_id = $("#coin_holder_id").val();
var comment_id =  $("#comment_id").val(); 
var user_id = $("#user_id").val();
var project_id =  $("#project_id").val();
var comments1 = $("#comments12").val();
  
jQuery.ajax({
             type: "GET",
             url: '/companies/report_popup1/'+coin_holder_id+'/'+comment_id+'/'+user_id+'/'+project_id+'/'+comments1,
             cache: false,
             success: function(rText){
 		jQuery(document).trigger('close.facebox');
                    // jQuery('#gridTable').html(rText);			
             }
     });
$("#indicator1").hide();

}

}
</script>
