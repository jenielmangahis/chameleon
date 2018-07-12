<?php echo $form->input('coin_holder_id',array('type'=>"hidden",'value'=>$coin_holder_id, 'id'=>"coin_holder_id" )); ?>
<?php echo $form->input('comment_id',array('type'=>"hidden",'value'=>$comment_id, 'id'=>"comment_id" )); ?>
 <?php echo $form->input('user_id',array('type'=>"hidden",'value'=>$user_id, 'id'=>"user_id" )); ?>
 <?php echo $form->input('project_id',array('type'=>"hidden",'value'=>$project_id, 'id'=>"project_id" )); ?>
<img id="indicator1" style="display:none" src="/img/<?php echo $project_name?>/loader.gif" >
<div><lable class='lbl'>Comment:<b><span style="color:red">*</span></b></lable> 
<?php echo $form->textarea("comments", array('id' => 'comments', 'div' => false, 'label' => '','cols' => '50', 'rows' => '4', 'class'=>'top','style'=>'border:1px solid #BEDAE5;'));?>
</div>
<p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>
<div><lable style="width:150px; margin-right:5px;display:inline-block;">&nbsp;</lable> <?php echo $form->button('Submit', array('div'=>false,"class"=>"btn","onclick"=>"return submitdata();"));?> 
</div>
<?php echo $form->end();?>

