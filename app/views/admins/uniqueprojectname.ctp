<div id="blck"> 
<div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
<div class="msgBoxBg">
<div class=""><a href="" onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;position: absolute;z-index: 11;"/></a>
<div class="msgTXt">
<?php if($err==1) { ?>
Project Name should be alphanumeric and contain no spaces.
<?php } else { ?>
Project with same name already exists.
<?php } ?>
</div>
<?php echo $form->hidden('projectalready', array( 'value' => $errormsg,'id' => 'projectalready') );?>
</div>
</div>
<div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
</div>
