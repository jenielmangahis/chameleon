<?php
//$opr = '';
$id = null;
//$opr = $this->params['pass']['0'];


//if(isset($this->params['pass']['1']) && !empty($this->params['pass']['1']))
//$id = $this->params['pass']['1'];

//print_r($para);
//echo '<pre>';print_r($para);
$id = $this->data['SpamPolicy']['id'];
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'setups/super_admin_changepassword';
?>
<?php  echo $javascript->link('ckeditor/ckeditor'); ?>

<script type="text/javascript">

function validate(){
   
    
     if($('#agreement_name').val() == '')
     {
         inlineMsg('agreement_name','<strong>Please Agreement name</strong>',2);
         return false;
     }
    
    
     return true;
}
</script>


<div class="container">

<div class="titlCont"><div style="width:960px;margin:0 auto">
    
          <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
    <?php echo $form->create("legals", array("action" => "spam_policy/edit/".$id,'name' => 'spam_policy', 'id' => "spam_policy"))?>
         <span class="titlTxt">Spam Policy </span>
        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
            </ul>
            </ul>
        </div>
        <div class="clear"></div>
        <ul class="topTabs2" id="tab-container-1-nav" style="padding-left: -40px;">
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Agreements by Project'),
			array('controller'=>'legals','action'=>'user_agreement_list_by_project'),
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'User Agreement'),
			array('controller'=>'legals','action'=>'user_agreement_list'),
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Agree History'),
			array('controller'=>'legals','action'=>'user_agreehistory'),
			array('escape' => false,'class'=>'user_agreehistory')
			)
		);
		?>
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Spam Policy'),
			$spam_policy_url,
			array('escape' => false,'class'=>'tabSelt')
			)
		);
		?>
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Terms & Privacy'),
			$terms_url,
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
        </ul>
    </div></div>
<div class="boxBor1">
    <br>
    <div class="boxPad">
            <div style="width: 960px; min-height:230px; margin: 0pt auto; align:left;">     

                <?php if($session->check('Message.flash')){ ?> 
                    <div id="blck"> 
                        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
                        <div class="msgBoxBg">
						<div class="">
						        <?php
								e($html->link(
									$html->image('close.png',array('style'=>'margin-left: 945px;position: absolute;z-index: 11;')),
									'javascript:void(0)',
									array('escape' => false,'onclick'=>'hideDiv()')
									)
								);
								$session->flash();
								?> 
                        </div>
                            <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
                        </div>
                    </div>
                    <?php } ?>


                <br /><br />


                <table width="100%" cellpadding="1" cellspacing="1">
                    <tr>
                        <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('SpamPolicy.policy_content', array('class' => 'errormsg'));
                        ?></td>
                    </tr>

                                       
                    <tr>
                    <td width="100%" colspan="5">
                    <?php    
                        echo $form->textarea('SpamPolicy.policy_content', array('id'=>'policy_content','class'=>'ckeditor'));  
						echo $form->hidden('SpamPolicy.id');
                     ?>
                    </td>
                    </tr>


                    <tr><td>&nbsp;</td></tr>

                    <!-- ADD FIELD EOF -->      
                    <!-- BUTTON SECTION BOF -->  
                    <tr><td colspan="2">"<span class="red">*</span>"  <b>Required field.</b> 
                        </td></tr>
                    <tr><td>&nbsp;</td></tr>

                </table>
                
               

                <?php echo $form->end();?>
                <!-- ADD Sub Admin  FORM EOF -->

            </div></div></div>

  
            <!--inner-container ends here-->


<div class="clear"></div>


<!--container ends here-->

