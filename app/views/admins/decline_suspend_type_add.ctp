<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 
<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'decline_suspend_list';
?>
  <script type="text/javascript">
        var clip = null;
        
        function init() {
           /* clip = new ZeroClipboard.Client();
            clip.setHandCursor( true );
            clip.addEventListener('load', function (client) {
            debugstr("Flash movie loaded and ready.");
            });
            clip.addEventListener('mouseOver', function (client) {
            // update the text on mouse over
            clip.setText( $('codeval').value );
            });
            clip.addEventListener('complete', function (client, text) {
            debugstr("Copied text to clipboard: " + text );
            });
            clip.glue( 'd_clip_button', 'd_clip_container' );  */
            }
 
    </script>
<div class="titlCont1">
    <div class="myclass">
        <div align="center" id="toppanel" >
            <?php 
                # set help condition
                App::import("Model", "HelpContent");
                $this->HelpContent =  & new HelpContent();
                $condition = "HelpContent.id = '47'";  
                $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));
                $this->set("hlpdata",$hlpdata);
                # set help condition   
                echo $this->renderElement('new_slider'); 
            ?>
        </div>

        <span class="titlTxt">
            <?php if(isset($this->data['DeclineSuspendType']['id'])){
                    $act = 'edit';
                    echo "Decline/Suspend Type Edit";
                }else{
                    $act = 'add';
                    echo "Decline/Suspend Type Add";
                }     

            ?>
        </span>

        <?php echo $form->create("Admins", array("action" => "decline_suspend_type_add",'type' => 'file','enctype'=>'multipart/form-data','name' => 'decline_suspend_type_add', 'id' => "decline_suspend_type_add",'onsubmit' => 'return validateDeclineSuspendType();' ));  //
       
            echo $form->hidden("DeclineSuspendType.id");
		?>

        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
            </ul>
        </div>

    </div>

</div>
<!--titlCont1 ends here-->

<div class="boxBor1">
    <div class="boxPad">
        <div class="" height="300">
             <div id="addprjtype" style="width: 960px; height:300px; margin: 0pt auto;" align="left">     
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
                <table align="left" cellpadding="1" cellspacing="1" width="75%">
                    <tr><td colspan="2">&nbsp;</td></tr>
					<tr>
                        <td colspan='2'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('DeclineSuspendType.type_name', array('class' => 'errormsg'));
                                echo $form->error('DeclineSuspendType.type_category', array('class' => 'errormsg'));
                        ?></td>
                    </tr>
                    <tr><td align="left"><label class="boldlabel">Decline/Suspend Type <span class="red">*</span></label></td>
                        <td>
                            <span class="intpSpan"><label for="title"></label> 
                            <?php echo $form->input("DeclineSuspendType.type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                             </span>

                        </td>
                    </tr>
					 <tr><td align="left"><label class="boldlabel">Decline/Suspend Category <span class="red">*</span></label></td>
                        <td>
                           
                            <?php 
							$options=array('Decline'=>'Decline','Suspend'=>'Suspended');
							$attributes=array('legend'=>false,'style'=>'margin-left:15px; margin-right:15px;');
							echo $form->radio('DeclineSuspendType.type_category',$options,$attributes);
							?>
                           

                        </td>
                    </tr>
					<tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td valign='top' align="left"><label class="boldlabel">Note </label>&nbsp;</td>
                        <td>
                            <span class="txtArea_top">
                                <span class="newtxtArea_bot"><?php echo $form->textarea("DeclineSuspendType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>

                                </span></span>           
                        </td>
                                  
                    </tr><tr><td colspan="2"><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
                                <?php  echo $this->renderElement('bottom_message');  ?>
                            </div></td></tr>

                    <!-- ADD FIELD EOF -->  	
                    <!-- BUTTON SECTION BOF -->  
                    <tr><td colspan="2">
                        </td></tr>
                </table>
                <!-- ADD Sub Admin  FORM EOF -->

            </div></div></div></div>

