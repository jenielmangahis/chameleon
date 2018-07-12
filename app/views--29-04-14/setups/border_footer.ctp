<script type="text/javascript">
$(document).ready(function() {
$('#conFiugure').removeClass("butBg");
$('#conFiugure').addClass("butBgSelt");
}); 
</script> 
<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'setups/border_footer_list';
?>
<?php
echo $javascript->link('ckeditor/ckeditor'); 
?>

<div class="container"> 	
<div class="titlCont">
<div class="myclass">
<?php echo $form->create("setups", array("action" => "border_footer",'name' => 'border_footer', 'id' => "border_footer", 'class' => 'adduser','onsubmit' => 'return validateBorderFooter();'))?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>

		<span class="titlTxt">Border Footer </span>
        <div class="topTabs">
                <ul class="dropdown">
                             <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                              <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                              <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
                    
                </ul>
        </div> 
		<div class="clear"></div>
        
         <?php $this->border_footer_list="tabSelt"; echo $this->renderElement('super_admin_config_types'); ?>   
</div></div>

<div class="midPadd" id="sndmail">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          
    
    <div id="addcomm" class="">  
        <!-- START:  Task Setup Design as per Requirement --> 
		
        <table cellspacing="10" cellpadding="0" align="center" width="100%">   
            <tbody>
                <tr>
                        <td>
						<?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('BorderFooter.border_footer_name', array('class' => 'errormsg'));
                        ?>
						</td>
                </tr>
				<tr>
				<td align="right">
					<div class="updat" style="width: 165px;">
					<label><b>Border Footer Name</b><span class="red">*</span></label></div>
				</td>
				<td width="auto">
					<span class="intpSpan">
						<label for="title"></label> 
						<?php
						echo $form->hidden("BorderFooter.id");
						echo $form->input("BorderFooter.border_footer_name", array('id' => 'border_footer_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
					</span>
				</td>
				<td align="right">
                        <!--
						<div class="updat">
                        <label class="boldlabel">Last Edit Date <span class="red">*</span></label></div>
						-->
				</td>
				<td width="auto">
					<?php /* ?>
					<span class="intpSpan">
						<label for="title"></label> 
						<?php
						$mdate = '';
						if(isset($this->data['BorderFooter']['modified']) && !empty($this->data['BorderFooter']['modified']))
						$mdate = date('d/m/Y',strtotime($this->data['BorderFooter']['modified']));
						echo $form->input("BorderFooter.mdate", array('id' => 'modified', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>$mdate));
						?>
					</span>
					<?php */ ?>
				</td>
				
				</tr>
				<tr>
					<td  width="100" align="right" style="padding-top: 5px;">
					<div class="updat" style="width: 165px;">
						<label><b>Default-New Projects</b></label>&nbsp;</div></td>
					<td valign="middle">
				<?php echo $form->input("BorderFooter.is_default", array('id' => 'is_default', 'div' => false, 'label' => '','type'=>'checkbox'));?>                             
				  </td>
				  <td colspan="2">&nbsp;</td>
				</tr>

                <tr>
                    <td colspan="4">   <?php    echo $form->textarea('BorderFooter.footer_content', array('id'=>'footer_content','class'=>'ckeditor'));  ?>    </td>
                </tr>       

                <tr><td colspan="4">&nbsp;</td></tr>

            </tbody>
        </table>
        
        <!-- END : Task Setup Design -->  
     
    </div>
	<div class="clear"></div>


</div>

<div class="clear"></div>

</div>

<!--inner-container ends here-->


<!--container ends here-->