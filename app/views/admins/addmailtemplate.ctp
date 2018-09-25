<?php $lgrt = $session->read('newsortingby');
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'mailtemplatelist';

?>

<!-- Body Panel starts -->
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Email Template Add/Edit</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php 

					echo $javascript->link('ckeditor/ckeditor'); 
					echo $form->create("Admins", array("action" => "addmailtemplate",'name' => 'addmailtemplate', 'id' => "addmailtemplate","onsubmit"=>"return validatemailcontent('add');")); 
					if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
					if($extra){ echo $form->hidden("Admins.extra", array('id' => 'extra', 'value'=>$extra)); }
					if($closeit=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }
				
				?>
						
				<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('action.png')); ?></button>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
				<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')" ><?php e($html->image('cancle.png')); ?></button>
				<?php  echo $this->renderElement('new_slider');  ?>	
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
            <?php /*?><ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')" ><span> Cancel</span></button></li>
            </ul><?php */?>
        </div>
    </div>
</div>
    
    
<div class="clearfix nav-submenu-container">
	<div class="midCont">
	   <?php    $this->loginarea="admins";    $this->subtabsel="mailtemplatelist";
             echo $this->renderElement('emails_submenus');  ?> 
    </div>
</div>    

<div class="midPadd" id="mailtmp">

    <div class="boxBor1">

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <div class="clear"></div>
    </div>
        <div class="clearfix">
            <div class="frmbox">
                <table cellspacing="5" cellpadding="0" align="center" width="100%">
                                    <tbody>
                                 
                                        <tr>
                                            <td width="25%" align="right"><label class="boldlabel">Template Name <span class="red">*</span></label></td>
                                            <td width="75%"><span class="intp-Span"><?php echo $form->input("EmailTemplate.email_template_name", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:100%;',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
                                        </tr>
        
                                        <tr>
                                            <td width="25%" align="right"><label class="boldlabel">Subject <span class="red">*</span></label></td>
                                            <td width="75%"><span class="intp-Span"><?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:100%;',"class" => "inpt-txt-fld form-control","maxlength" => "250"));?></span></td>
                                        </tr>
                                        <tr>
                                            <td  align="right"><label class="boldlabel">Sender <span class="red">*</span></label></td>
                                            <td ><span class="intp-Span"><?php echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:100%;',"class" => "inpt-txt-fld form-control","maxlength" => "250", "value"=>$project['Sponsor']['email']));?></span></td>
                                        </tr>
        
                                      
                                    </tbody>
                                </table>
            </div>
            <div class="frmbox2">
                <table cellspacing="10" cellpadding="0" align="center" width="100%">
                                    <tbody>
        
                                        <tr>
                                            <td align="left" style="vertical-align: middle;">
                                                <label class="boldlabel">CC Email To</label>
                                            </td>
                                        </tr>
                                        <tr><td>                            
                                                <span class="txtArea-top">
                                                    <span class="newtxtArea-bot">
                                                        <?php echo $form->input("EmailTemplate.send_cc_email_to", array('id' => 'send_cc_email_to', 'div' => false, 'label' => '','rows'=>'3','cols'=>'65','style' =>'width:100%;',"class" => "form-control noBg"));?>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
            </div>
            
        </div>    
        
    <br/>
    <div class="boxBor1">
        <?php    echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));  ?>
        <div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
        <?php  echo $this->renderElement('bottom_message');  ?>   </div>

    </div>
  </div> 
</div>

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


