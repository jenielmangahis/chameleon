<!--container starts here--> <!-- Body Panel starts -->
  <div class="container">
<div class="titlCont">
        <div style="width:960px; margin:0 auto;">
                <div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">	
                        <?php  echo $this->renderElement('new_slider');  ?>
        </div><span class="titlTxt1"><?php echo $project_name; ?>:&nbsp;</span><span class="titlTxt"> Dashboard </span><br /><br /><br><br><br><br><br>
</div>
</div>
<div class="midCont" id="newcmmtasktab">

 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class="">
				<?php
				e($html->link(
					$html->image('close.png',array('style'=>'margin-left: 945px; position: absolute; z-index: 11;','alt'=>'Close')),
					'javascript:void(0)',
					array('escape' => false,'onclick' => "hideDiv()")
					)
				);
				$session->flash();    
				?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>
<h1 style="text-align: center;">Selected Project : <?php echo $project_name; ?></h1>
<div class="clear"></div>
</div>  

</div><div class="clear"></div>
</div>
    

