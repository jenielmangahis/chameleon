<?php 
	$base_url = Configure::read('App.base_url');
	 $lgrt = $base_url.$session->read('newsortingby');
?>
<?php 
    echo $javascript->link('ckeditor/ckeditor'); 
?>

<!-- Body Panel starts -->
<div class="titlCont1"><div class="myclass">
        <div align="center" class="slider" id="toppanel">
            <?php  echo $this->renderElement('new_slider');  ?>



        </div>
        <?php echo $form->create("Company", array("action" => "editmailcontent",'name' => 'editmailcontent', 'id' => "editmailcontent","onsubmit" =>"return validatemailcontent('edit');")); 
            echo $form->hidden("EmailTemplate.id", array('id' => 'templateid'));
        ?>
        <?php if($extra){ echo $form->hidden("extra", array('id' => 'extra', 'value'=>$extra)); }
           
            if($this->data['EmailTemplate']['is_event_temp']==1)
                $rsvp="Checked='yes'";
            if($this->data['EmailTemplate']['is_event_temp']==2)
                $waitlist="Checked='yes'";
            if($this->data['EmailTemplate']['is_event_temp']==3)
                $invite="Checked='yes'";
             ?>
        <span class="titlTxt">
            Edit Template
        </span>
        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $lgrt;?>')"><span> Cancel</span></button></li>
            </ul>
        </div>

        <div class="topTabs">
            <ul>

            </ul>
        </div>
    </div></div>
<div class="midPadd" id="editmailcnt">
    <div class="boxBor1">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <div class="clear"></div>
    </div>
    <br/>
    <div class="boxBor1">

        <div class="tblData" style="border:none;">
            <table cellspacing="10" cellpadding="0" align="center" width="100%">   
                <tbody>
                    <tr>
                        <td width="65%">
                            <table cellspacing="5" cellpadding="0" align="center" width="100%">
                                <tbody>
                                    <?php
                                    if(!empty($returnurl)=="event" || !empty($extra)=="event")
                                    {
                                        
                                    ?>
                                    <tr>
                                            <td width="25%" align="right"><label class="boldlabel">Template Type <span class="red">*</span></label></td>
                                            <td width="75%">
                                            <input type="radio" name="data[EmailTemplate][is_event_temp]" id="is_event_temp_1" value="1" <?php echo isset($rsvp)?$rsvp:'';?> > &nbsp;RSVP&nbsp;
                                            <input type="radio" name="data[EmailTemplate][is_event_temp]" id="is_event_temp_2" value="2" <?php echo isset($waitlist)?$waitlist:'';?>> &nbsp;Waitlist&nbsp;
                                            <input type="radio" name="data[EmailTemplate][is_event_temp]" id="is_event_temp_3" value="3" <?php echo isset($invite)?$invite:'';?>> &nbsp;Invite&nbsp;
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <?php if(($isreadonly)=='1'){ ?>
                                        <tr>
                                            <td width="25%"><label class="boldlabel">Template Name </label>&nbsp;</td>
                                            <td width="75%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.email_template_name.", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                                        </tr>
                                        <?php }else{ ?>
                                        <tr>
                                            <td width="25%"  align="right"><label class="boldlabel">Template Name  </label></td>
                                            <td width="75%"><?php echo $form->input("EmailTemplate.email_template_name.", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250",'readonly'=>true));?></td>
                                        </tr>
                                        <?php } ?>
                                    <tr>
                                        <td   align="right"><label class="boldlabel">Subject <span class="red">*</span></label></td>
                                        <td ><span class="intpSpan"><?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                                    </tr>
                                    <tr>
                                        <td  align="right"><label class="boldlabel">Sender <span class="red">*</span></label></td>
                                        <td ><span class="intpSpan"><?php echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?>
                                            </span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>  
                        <td width="35%">
                            <table cellspacing="10" cellpadding="0" align="center" width="100%">
                                <tbody>

                                    <tr>
                                        <td align="left" style="vertical-align: middle;">
                                            <label class="boldlabel">CC Email To</label>
                                        </td>
                                    </tr>
                                    <tr><td>                            
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
                        <td colspan="2"> <?php	echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));		?>   </td>
                    </tr>	

                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td >&nbsp;</td>
                        <td >
                            <!--	 <button type="submit" id="Submit" class="button"><span>  Save</span>  </button>&nbsp;
                            <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/mailtemplatelist')"><span> Cancel</span></button>-->
                        </td>
                    </tr>	
                </tbody>
            </table>

            <?php echo $form->end();?>
            <div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
                <?php  echo $this->renderElement('bottom_message');  ?>
            </div>

    </div></div> </div>

<!--inner-container ends here-->


<div class="clear"></div>
<!-- Body Panel ends -->
<?php echo $form->end();?>

<div class="clear"></div> 
<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("editmailcnt").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	
</script>