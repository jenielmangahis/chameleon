<script type="text/javascript">
$(document).ready(function() {
$('#EmailMnu').removeClass("butBg");
$('#EmailMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$lgrt = $session->read('newsortingby');
	$base_url = Configure::read('App.base_url');
	$backUrl = $base_url.'mailtasks/mailresponderlist';
?>
<?php 
   echo $javascript->link('ckeditor/ckeditor'); 
?>

<!-- Body Panel starts -->
<div class="titlCont1"  style="height: 90px;">

	<div class="myclass">
        <div align="center" class="slider" id="toppanel">
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>
      	
        <?php 
        $action = (isset($templateid))? "/edit/".$templateid : "/add";
        $vaction = ($templateid)?'edit':'add';
        echo $form->create("mailtasks", array("action" => "responders".$action,'name' => 'responders', 'id' => "responders","onsubmit" =>"return validate_responder('$vaction');"));
 ?>
        
           
          <span class="titlTxt"> Email Responder <?php echo ucfirst($vaction); ?> </span>
        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
            </ul>
        </div>
 <div class="clear"></div>
       
           <?php   
				
           	 $this->mailresponderlist="tabSelt";
           	 $this->subtabsel="mailresponderlist";
             echo $this->renderElement('emails_submenus');  ?>  
       
    </div>
     </div>
     
<div class="midPadd">
    <div class="boxBor1">

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <div class="clear"></div>
    </div>
    <br/>
    <div class="boxBor1">
        <table cellspacing="10" cellpadding="0" align="center" width="100%">   
            <tbody>
                <tr>
                    <td width="60%">
                        <table cellspacing="10" cellpadding="0" align="center" width="100%">
                            <tbody>
                            
                                    <tr>
                                        <td width="25%" align="right" style="vertical-align: middle;"><label class="boldlabel">Template Name </label>&nbsp;</td>
                                        <td width="75%"><?php echo $form->input("EmailTemplate.email_template_name.", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></td>
                                    </tr>
                            
     
                                <tr>
                                    <td  align="right" ><label class="boldlabel">Subject <span class="red">*</span></label></td>
                                    <td  ><?php echo $form->hidden("EmailTemplate.id", array('id' => 'templateid'));    ?>
                                        <span class="intpSpan">
                                        <?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250")); ?>
                                        </span>
                                    </td>    
                                </tr>
                                
                                <tr>
                                    <td  align="right"><label class="boldlabel">Sender <span class="red">*</span></label></td>
                                    <td ><span class="intpSpan">
                                    	<?php if($templateid)
                                    		 	echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250" ));
                                    		  else 	
                                    		  	echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250", "value"=>$adminemail ));
                                    		 ?>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                    <td width="40%">
                        <table cellspacing="10" cellpadding="0" align="center" width="100%">
                            <tbody>
	
                               <tr>
                                    <td align="left" style="vertical-align: middle;">
                                        <label class="boldlabel">CC Email To</label>
                                    </td>
                               <td>                            
                                        <span class="txtArea_top">
                                            <span class="newtxtArea_bot">
                                                <?php echo $form->input("EmailTemplate.send_cc_email_to", array('id' => 'send_cc_email_to', 'div' => false, 'label' => '','rows'=>'3','cols'=>'65','style' =>'width:230px;',"class" => "noBg"));?>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                </tr>

                <tr>
                    <td width="100%" style="vertical-align: top;" colspan="2"><!--<label class="boldlabel">Content: </label></td><td>-->        
                        <?php   flush();
                            echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));
                        ?>
                    </td>
                </tr>       

                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td >&nbsp;</td>
                    <td >
                        <!--     <button type="submit" id="Submit" class="button"><span>  Save</span>  </button>&nbsp;
                        <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/mailtemplatelist')"><span> Cancel</span></button>-->
                    </td>
                </tr>  
            </tbody>
        </table>

        <?php echo $form->end();?>
        <div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
        <?php  echo $this->renderElement('bottom_message');  ?>   </div>

    </div></div> </div>
 
<!--inner-container ends here-->

  
<div class="clear"></div>
  <!-- Body Panel ends -->
        <?php echo $form->end();?>

<div class="clear"></div> 



