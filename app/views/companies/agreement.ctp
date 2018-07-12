<?php
$baseUrl = Configure::read('App.base_url');
?>

<div class="boxBg">
  <div id="fb-root"></div>
  <?php      
	echo  $form->create('Company',array('controller'=>'companies','action'=>'do_agree','id'=>'SignupForm'));
	echo $form->hidden('User.id',array('value'=>$Agreeemnt_user_id))
	?>
	<style>
	.clsTableBorder td{
	background:#FFFFFF; padding: 5px 10px;
	}
	.tdCheckClass label{padding:0px 10px;}
	td label {width:455px;float:left;margin-bottom: 5px;}
	.chkLableAgree {float:left;position:relative; top:4px;}
	</style>
	<div style="padding:20px;">
  <table cellpadding="0" cellspacing="4" class="clsTableBorder" style="background-color:#4F9BD9;" width="100%" align="center">
    <tr>
      <td style="padding:0px;"><div style="background-color:#4F9BD9; padding: 10px;"><strong>License Agreement</strong></div></td>
    </tr>
    <tr>
      <td><p>To continue, please review and accept the terms of your License Agreement. If you fail to accept the terms of agreement you WILL NOT be able to continue.</p></td>
    </tr>
	<tr>
      <td>
	  <div style="min-height:350px;">
	  <p><?php echo $agreementData; ?></p>
	  </div>
	  </td>
    </tr>
	<tr>
      <td class="tdCheckClass">
	  <div style="width:500px; float:left">
	  <?php  
	  $opt = array('1'=>'I accept the terms of license agreement','0'=>'I DO NOT accept the terms of license agreement');
	  echo $form->radio("User.acceptation", $opt, array('default'=>'1','id'=>'relation_type', 'legend'=>false,'class'=>'chkLableAgree')); 			
	  ?>
	  </div>
	  <div style="float:right;padding-top: 12px;">	  
	  <span class="flx_button_lft ">
	  <?php echo $form->submit('Accept', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
	  </span>
	  <span class="flx_button_lft ">
	  <?php echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"flx_flexible_btn"));?>
	  </span>
	  </div>
      </td>
    </tr>
  </table>
  	</div>
  <?php echo $form->end();?>
</div>
