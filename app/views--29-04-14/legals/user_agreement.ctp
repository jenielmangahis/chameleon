<script type="text/javascript">
$(document).ready(function() {
$('#conFiugure').removeClass("butBg");
$('#conFiugure').addClass("butBgSelt");
}); 
</script> 
<?php 
$baseUrl = Configure::read('App.base_url');
$backurl = $baseUrl.'legals/user_agreement_list_by_project';
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

<div class="titlCont1"><div style="width:960px;margin:0 auto">
    
          <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
    <?php echo $form->create("legals", array("action" => "user_agreement/".$opr."/".$id,'name' => 'user_agreement', 'id' => "user_agreement",'onsubmit' => 'return validate();'))?>
         <span class="titlTxt">User Agreement Add </span>
        <div class="topTabs">

            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backurl ?>')"><span> Cancel</span></button></li>
            </ul>
            </ul>
        </div>
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
                                echo $form->error('UserAgreement.agreement_name', array('class' => 'errormsg'));
                        ?></td>
                    </tr>

                    <tr>
                        <td align="right">
                        <div class="updat">
                        <label class="boldlabel">Agreement Name <span class="red">*</span></label></div></td>
                        <td width="auto">
                            <span class="intpSpan">
                                <label for="title"></label> 
                                <?php echo $form->input("UserAgreement.agreement_name", array('id' => 'agreement_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                            </span>
                        </td>
                        <td align="right">
                        <div class="updat">
                        <label class="boldlabel">Last Edit Date <span class="red">*</span></label></div></td>
                        <td width="auto">
                            <span class="intpSpan">
                                <label for="title"></label> 
                                <?php
                                if($opr=="add")
                                    $modified="N/A";
                                else
                                {
                                    $modified=$data['UserAgreement']['modified']; 
                                    $modified=date('m-d-Y',strtotime($modified));
                                }
                                      
                                 echo $form->input("UserAgreement.mod", array('id' => 'modified', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$modified,'readonly'=>'readonly'));?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td  width="100" align="right" style="padding-top: 5px;">
                        <div class="updat" style="width: 160px;">
                            <label class="boldlabel">Default-New Projects </label>&nbsp;</div></td>
                        <td valign="middle">
                    <?php echo $form->input("UserAgreement.default_new_projects", array('id' => 'default_new_projects', 'div' => false, 'label' => '','type'=>'checkbox'));?>                             
                      </td>
                    </tr>
                    
                    <tr>
                    <td width="100%" colspan="5">
                    <?php    
                       echo $form->textarea('UserAgreement.agreement_content', array('id'=>'agreement_content','class'=>'ckeditor','value'=>$data['UserAgreement']['agreement_content']));
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

