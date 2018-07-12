<?php 
$lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'prospects/prospectemailtemplate';
?>

<!-- Body Panel starts -->
<div class="titlCont"><div class="myclass">
       <div style="width:960px; margin:0 auto;">
		<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
		<?php 

    echo $javascript->link('ckeditor/ckeditor'); 
    echo $form->create("prospects", array("action" => "addprospectmailtmp",'name' => 'addprospectmailtmp', 'id' => "addprospectmailtmp","onsubmit"=>"return validatemailcontent('add');")); 
    if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
    if($extra){ echo $form->hidden("prospects.extra", array('id' => 'extra', 'value'=>$extra)); }
    if($closeit=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }
	echo $form->hidden("EmailTemplate.id");
	
?>
		 <?php if(!isset($isreadonly) || !$isreadonly) { ?> 
            <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
             <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                <?php } ?>
             <button type="button" id="saveForm" class="sendBut"  <?php if($returnurl && $returnurl!="event"){  echo "onclick='closemywindow();'"; }else{?>ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')" <?php } ?>><?php e($html->image('cancle.png')); ?></button>
            <?php  echo $this->renderElement('new_slider');  ?>


</div>
        </div>
        <?php  if($addtype==trim("admin")){ echo $this->renderElement('project_name'); } ?>
        <span class="titlTxt">Add New Template
        </span>


        <div class="topTabs" style="height:25px;">
            <?php /*?><ul>
            <?php if(!isset($isreadonly) || !$isreadonly) { ?> 
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <?php } ?>
                <li><button type="button" id="saveForm" class="button"  <?php if($returnurl && $returnurl!="event"){  echo "onclick='closemywindow();'"; }else{?>ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')" <?php } ?>><span> Cancel</span></button></li>
            </ul><?php */?>
        </div>
		  <?php $this->loginarea="prospects";    $this->subtabsel="emailtemplate";
                    echo $this->renderElement('prospect_email_submenus'); ?>  

    </div></div>

<div class="midPadd" id="mailtmp">

    <div class="boxBor1">

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <div class="clear"></div>
    </div>
    <br/>
    <div class="boxBor1">
        <table cellspacing="10" cellpadding="0" align="center" width="100%">   
            <tbody>
                <tr>
                    <td width="65%">
                        <table cellspacing="5" cellpadding="0" align="center" width="100%">
                            <tbody>
							     <tr>
                                    <td width="25%" align="right"><label class="boldlabel">Template Name <span class="red">*</span></label></td>
                                    <td width="75%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.email_template_name", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                                </tr>

                                <tr>
                                    <td width="25%" align="right"><label class="boldlabel">Subject <span class="red">*</span></label></td>
                                    <td width="75%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                                </tr>
                                <tr>
                                    <td  align="right"><label class="boldlabel">Sender <span class="red">*</span></label></td>
                                    <td ><span class="intpSpan"><?php echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250", "value"=>$project['Sponsor']['email']));?></span></td>
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
                    <td colspan="2">   <?php    echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));  ?>    </td>
                </tr>       

                <tr><td colspan="2">&nbsp;</td></tr>

            </tbody>
        </table>
        <div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
        <?php  echo $this->renderElement('bottom_message');  ?>   </div>

    </div></div> </div>

<!--inner-container ends here-->


<div class="clear"></div>
<!-- Body Panel ends -->
<?php echo $form->end();?>

<div class="clear"></div> 
<script type="text/javascript">
    $(document).ready(function(){

        if($("#closeit")){
            isclose=$("#closeit").val();
            if(isclose=="yes"){
                // This function from `Parent window i.e formtype_add`
                window.opener.GetEmailTempRefresh();
                window.close();
            }
        }
    });

    function closemywindow(){
        window.opener.GetEmailTempRefresh();
        window.close();
    }

    if(document.getElementById("flashMessage")==null)
        document.getElementById("mailtmp").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	
</script>


