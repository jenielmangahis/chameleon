<?php  
echo $javascript->link('ckeditor/ckeditor');
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'project_border_footer';
?>

<!--container starts here-->

<div class="container">
<div class="titlCont">
<div class="myclass">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
<?php echo $form->create("Admins", array("action" => "project_border_footer",'name' => 'project_border_footer', 'id' => "project_border_footer"))?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
<?php  echo $this->renderElement('new_slider');  ?>
</div>

        <?php  echo $this->renderElement('project_name');  ?> 
        <span class="titlTxt">
            Border Footer
        </span> 
        <?php    
			$this->loginarea="admins";
			$this->subtabsel="project_border_footer";
            echo $this->renderElement('setting_submenus');
		?>   
    </div></div>
    
    
    <?php    //if($session->check('Message.flash')){ ?><div style="width:400px;margin:0 auto;"><?php //$session->flash();?></div><?php //}?>
<div class="clear"></div>


        
<div class="rightpanel">


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

<div id="center-column">
            
        <!-- ADD USER FORM -->
    
        <table width="100%" align="center" cellpadding="1" cellspacing="1">
        <tr>
              <td width="100%" colspan=2 style="vertical-align:top" >
            <?php    
                    echo $form->hidden('ProjectBorderFooter.id',array('id'=>'id','value'=>$page_footer_id));
            
                        echo $form->textarea('ProjectBorderFooter.page_footer_content', array('id'=>'mailfooter','class'=>'ckeditor','value'=>$page_footer_content));                        
                        
                ?>
            </td>
            </tr>
          
        
        
    <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>    


                    
                    
                </table>
                
            </div>

 
</div><!--inner-container ends here-->

  

<?php echo $form->end();?>


<div class="clear"></div>


</div><!--container ends here-->


