<?php  echo $javascript->link('ckeditor/ckeditor');  ?>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Mail Footer on Opt-Out Notice</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("mailtasks", array("action" => "mail_footer",'name' => 'mail_footer', 'id' => "mail_footer", 'class' => 'adduser'))?>		
                <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location=baseUrl+'mailtasks/mail_footer')"><?php e($html->image('cancle.png')); ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>	
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
		        <?php /*?><ul>
		        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		        <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location=baseUrlAdmin+'/index')"><span> Cancel</span></button></li>  
				</ul><?php */?>
	     	</div>
    </div>

</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		 <?php 	$this->mail_footer="tabSelt"; $this->subtabsel="mail_footer"; echo $this->renderElement('emails_submenus'); ?>
    </div>
</div>

<div  class="centerPage" >
<div class="clear"></div>        
<div class="rightpanel">
<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
		 <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
         <div class="msgBoxBg">
             <div class="">
             	<a href="#" onclick="hideDiv();">
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

<div class="table-responsive">
            
        <!-- ADD USER FORM -->
    
        <table class="table" width="100%" align="center" cellpadding="1" cellspacing="1">
        <tr>
              <td width="100%" colspan=2 style="vertical-align:top" >
            <?php    
                        echo $form->textarea('MailFooter.footer_content', array('id'=>'content','class'=>'ckeditor','value'=>$footer_content));                        
                        
                ?>
            </td>
            </tr>
          
        
        
    <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>    

<?php echo $form->end();?>
                    
                    
                </table>
                
</div>

 
</div><!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->


